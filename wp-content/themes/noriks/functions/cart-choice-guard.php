<?php
/**
 * Varovalka: izdelek s ponudbami ne sme v blagajno brez izbire kupca.
 *
 * Izbira (paket, barva, velikost) nastane samo ob oddaji obrazca na produktni strani -
 * gck_add_cart_item_data() v orto vticniku zahteva $_POST['bundle_option']. Vsaka druga pot v
 * kosarico (povezava ?add-to-cart=, obnova iz maila, programsko dodajanje) te izbire nima, zato
 * je naracilo prislo brez barve in velikosti. Ker so ti izdelki tipa "simple" (barva je navaden
 * atribut, ne variacija), WooCommerce sam nicesar ne preveri.
 *
 * Nasi lastni upselli izbiro zapisejo (_noriks_upsell, _noriks_pp_upsell), zato jih to ne ovira.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'woocommerce_check_cart_items', 'noriks_cart_choice_guard', 20 );
function noriks_cart_choice_guard() {
	if ( is_admin() && ! wp_doing_ajax() ) {
		return;
	}
	if ( ! function_exists( 'WC' ) || ! WC()->cart || ! function_exists( 'gck_is_orto_bundle_enabled' ) ) {
		return;
	}
	if ( ! function_exists( 'noriks_has_choice' ) ) {
		return; // pomozna funkcija zivi v klaviyo-email-links.php
	}
	foreach ( WC()->cart->get_cart() as $item ) {
		$pid = isset( $item['product_id'] ) ? absint( $item['product_id'] ) : 0;
		if ( ! $pid || ! gck_is_orto_bundle_enabled( $pid ) ) {
			continue;
		}
		if ( noriks_has_choice( $item ) ) {
			continue;
		}
		$ime  = get_the_title( $pid );
		$link = get_permalink( $pid );
		wc_add_notice(
			sprintf(
				/* translators: 1: ime izdelka, 2: povezava do izdelka */
				__( 'Pri produkte %1$s je potrebné vybrať balík a farbu/veľkosť. %2$s', 'noriks' ),
				esc_html( $ime ),
				$link ? '<a href="' . esc_url( $link ) . '">' . esc_html__( 'Vyberte tu', 'noriks' ) . '</a>' : ''
			),
			'error'
		);
	}
}
