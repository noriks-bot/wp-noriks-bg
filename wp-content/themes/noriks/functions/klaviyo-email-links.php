<?php
/**
 * Povezave iz Klaviyo mailov
 *
 * 1) Obnova košarice (?wck_rebuild_cart=): Klaviyo vtičnik obnovi košarico le, če se URL ujema z wc_get_cart_url();
 *    ta na Noriks trgih vrne domačo stran (stran košarice v WooCommerce ni izbrana), zato obnova nikoli ne steče. Tu košarico obnovimo
 *    sami, PRED Klaviyem, in primerjamo samo pot (/xx/cart/). Nato preusmerimo na čisto košarico (Klaviyo ne teče).
 * 2) Samodejni kupon (?coupon=KODA): koda se shrani v sejo in uveljavi, ko je v košarici vsaj en izdelek.
 * 3) Izbira kupca (paket, barva, velikost) potuje Z POVEZAVO: Klaviyo vtičnik v CartRebuildKey hrani le
 *    product_id/quantity/variation, zato smo prek uradnega kavlja kl_started_checkout dodali še naše
 *    _orto_* in _noriks_* podatke. Ob obnovi jih vrnemo kot peti parameter add_to_cart(), da kupec dobi
 *    natanko to, kar je imel. Če jih v povezavi ni (stari maili), kupca pošljemo na produktno stran.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'wp_loaded', 'noriks_email_cart_rebuild', 5 ); // pred Klaviyo wck_rebuild_cart (prioriteta 10)
function noriks_email_cart_rebuild() {
	if ( is_admin() || wp_doing_ajax() || empty( $_GET['wck_rebuild_cart'] ) || ! function_exists( 'WC' ) || ! WC()->cart || ! WC()->session ) {
		return;
	}
	// V WooCommerce ni izbrane strani košarice (wc_get_cart_url() vrne domačo stran), tema uporablja /xx/cart/.
	$cart_url  = home_url( '/cart/' );
	$wc_cart   = wc_get_cart_url();
	if ( untrailingslashit( $wc_cart ) !== untrailingslashit( home_url() ) ) {
		$cart_url = $wc_cart; // če bo stran košarice kdaj nastavljena, velja ta
	}
	$cart_path = untrailingslashit( (string) wp_parse_url( $cart_url, PHP_URL_PATH ) );
	$req_path  = untrailingslashit( (string) wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '', PHP_URL_PATH ) );
	if ( '' === $cart_path || $cart_path !== $req_path ) {
		return;
	}
	$data = json_decode( base64_decode( sanitize_text_field( wp_unslash( $_GET['wck_rebuild_cart'] ) ) ), true );
	if ( ! is_array( $data ) || empty( $data['normal_products'] ) || ! is_array( $data['normal_products'] ) ) {
		return;
	}
	if ( ! WC()->session->has_session() ) {
		WC()->session->set_customer_session_cookie( true );
	}
	if ( ! empty( $_GET['coupon'] ) ) { // kupon najprej v sejo, uveljavi se ob dodajanju izdelkov
		WC()->session->set( 'noriks_email_coupon', wc_format_coupon_code( wp_unslash( $_GET['coupon'] ) ) );
	}
	WC()->cart->empty_cart( true );
	$brez_izbire = array(); // izdelki s ponudbami, za katere v povezavi ni izbire
	foreach ( $data['normal_products'] as $p ) {
		if ( empty( $p['product_id'] ) ) {
			continue;
		}
		$pid    = absint( $p['product_id'] );
		$izbira = isset( $p['noriks_choice'] ) && is_array( $p['noriks_choice'] ) ? $p['noriks_choice'] : array();

		// Izdelek s ponudbami brez zapisane izbire ne sme tiho v kosarico - kupec bi narocil brez barve/velikosti.
		if ( ! noriks_has_choice( $izbira )
			&& function_exists( 'gck_is_orto_bundle_enabled' ) && gck_is_orto_bundle_enabled( $pid ) ) {
			$brez_izbire[] = $pid;
			continue;
		}

		WC()->cart->add_to_cart(
			$pid,
			max( 1, absint( isset( $p['quantity'] ) ? $p['quantity'] : 1 ) ),
			absint( isset( $p['variation_id'] ) ? $p['variation_id'] : 0 ),
			isset( $p['variation'] ) && is_array( $p['variation'] ) ? $p['variation'] : array(),
			$izbira
		);
	}
	noriks_email_coupon_apply();
	// UTM iz maila ohrani, da WooCommerce (in dash Origin) naročilo pripiše e-pošti, ne "Direct".
	$utm = array();
	foreach ( array( 'utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term' ) as $k ) {
		if ( isset( $_GET[ $k ] ) && '' !== $_GET[ $k ] ) {
			$utm[ $k ] = rawurlencode( sanitize_text_field( wp_unslash( $_GET[ $k ] ) ) );
		}
	}
	// Ce izbire ni bilo mogoce obnoviti, kupca posljemo na produktno stran, da jo izbere -
	// raje korak nazaj kot narocilo brez barve in velikosti. UTM-ji in kupon ostanejo.
	$cilj = $cart_url;
	if ( $brez_izbire ) {
		$link = get_permalink( $brez_izbire[0] );
		if ( $link ) {
			$cilj = $link;
			wc_add_notice( __( 'Vyberte balík a farbu/veľkosť, aby sme mohli pokračovať s vašou objednávkou.', 'noriks' ), 'notice' );
		}
	}
	wp_safe_redirect( $utm ? add_query_arg( $utm, $cilj ) : $cilj );
	exit;
}

// Stran košarice (/xx/cart/) se NIKOLI ne predpomni. V WooCommerce ni izbrane strani košarice, zato je LiteSpeed ne
// prepozna kot košarico in jo je shranjeval javno – obiskovalci so videli tujo (ali prazno) košarico.
add_action( 'wp_loaded', 'noriks_cart_nocache', 1 );
function noriks_cart_nocache() {
	if ( is_admin() || wp_doing_ajax() ) {
		return;
	}
	$req_path = untrailingslashit( (string) wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '', PHP_URL_PATH ) );
	if ( untrailingslashit( (string) wp_parse_url( home_url( '/cart/' ), PHP_URL_PATH ) ) !== $req_path ) {
		return;
	}
	do_action( 'litespeed_control_set_nocache', 'noriks: stran košarice' );
	if ( ! defined( 'DONOTCACHEPAGE' ) ) {
		define( 'DONOTCACHEPAGE', true );
	}
	nocache_headers();
}

add_action( 'wp_loaded', 'noriks_email_coupon_capture', 20 );
function noriks_email_coupon_capture() {
	if ( is_admin() || wp_doing_ajax() || empty( $_GET['coupon'] ) || ! function_exists( 'WC' ) || ! WC()->session || ! WC()->cart ) {
		return;
	}
	$code = wc_format_coupon_code( wp_unslash( $_GET['coupon'] ) );
	if ( '' === $code ) {
		return;
	}
	if ( ! WC()->session->has_session() ) {
		WC()->session->set_customer_session_cookie( true );
	}
	WC()->session->set( 'noriks_email_coupon', $code );
	noriks_email_coupon_apply();
}

add_action( 'woocommerce_add_to_cart', 'noriks_email_coupon_apply', 20 );
add_action( 'woocommerce_before_cart', 'noriks_email_coupon_apply', 5 );
add_action( 'woocommerce_before_checkout_form', 'noriks_email_coupon_apply', 5 );
function noriks_email_coupon_apply() {
	if ( ! function_exists( 'WC' ) || ! WC()->session || ! WC()->cart ) {
		return;
	}
	$code = WC()->session->get( 'noriks_email_coupon' );
	if ( ! $code || WC()->cart->is_empty() ) {
		return;
	}
	WC()->session->set( 'noriks_email_coupon', null );
	if ( ! WC()->cart->has_discount( $code ) ) {
		WC()->cart->apply_coupon( $code );
	}
}

/* ------------------------------------------------------------------ *
 * Izbira kupca v Klaviyo povezavi
 * ------------------------------------------------------------------ */

/** Ključi iz podatkov košarice, ki nosijo izbiro in jih je vredno prenesti. */
function noriks_cart_choice_keys() {
	return array(
		'_orto_offer_id', '_orto_offer_title', '_orto_bundle_pairs', '_orto_bundle_total',
		'_orto_bundle_unit_price', '_orto_pairs_json', '_orto_lines', '_orto_p1', '_orto_p2',
		'_noriks_upsell', '_noriks_pp_upsell', '_noriks_pp_upsell_unit', '_noriks_pp_upsell_qty',
	);
}

/** Ali je v vrstici košarice (ali v zapisu iz povezave) zapisana izbira kupca. */
function noriks_has_choice( $data ) {
	if ( ! is_array( $data ) ) {
		return false;
	}
	foreach ( noriks_cart_choice_keys() as $k ) {
		if ( isset( $data[ $k ] ) && '' !== $data[ $k ] && array() !== $data[ $k ] ) {
			return true;
		}
	}
	return false;
}

/**
 * Klaviyo v CartRebuildKey shrani samo product_id/quantity/variation_id/variation
 * (normalize_normal_product v wck-cart-rebuild.php). Tu dopolnimo še izbiro kupca.
 * normal_products so indeksirani po cart_item_key, zato je ujemanje natančno.
 */
add_filter( 'kl_started_checkout', 'noriks_kl_add_choice_to_payload', 10, 2 );
function noriks_kl_add_choice_to_payload( $event_data, $cart ) {
	if ( empty( $event_data['$extra']['CartRebuildKey'] ) || ! $cart ) {
		return $event_data;
	}
	$kl = json_decode( base64_decode( $event_data['$extra']['CartRebuildKey'] ), true );
	if ( ! is_array( $kl ) || empty( $kl['normal_products'] ) || ! is_array( $kl['normal_products'] ) ) {
		return $event_data;
	}
	$items = $cart->get_cart();
	$keys  = noriks_cart_choice_keys();
	foreach ( $kl['normal_products'] as $cart_item_key => $p ) {
		if ( ! isset( $items[ $cart_item_key ] ) ) {
			continue;
		}
		$izbira = array();
		foreach ( $keys as $k ) {
			if ( isset( $items[ $cart_item_key ][ $k ] ) ) {
				$izbira[ $k ] = $items[ $cart_item_key ][ $k ];
			}
		}
		if ( $izbira ) {
			$kl['normal_products'][ $cart_item_key ]['noriks_choice'] = $izbira;
		}
	}
	$encoded = base64_encode( wp_json_encode( $kl ) );
	// Predolga povezava bi se v mailih in strežnikih lomila; takrat raje pustimo izvirni zapis
	// in se ob obnovi zanesemo na fallback na produktno stran.
	if ( strlen( $encoded ) > 3500 ) {
		return $event_data;
	}
	$event_data['$extra']['CartRebuildKey'] = $encoded;
	return $event_data;
}

