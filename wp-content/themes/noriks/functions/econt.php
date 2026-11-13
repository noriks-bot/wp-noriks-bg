<?php
/**
 * Prevzemna mesta Econt na blagajni (BG) — po vzoru vigoshop.bg.
 *
 * Kupec na blagajni izbere med "офис на еконт" in "доставка до дома".
 * Pri prevzemnem mestu izbere pisarno ali Еконтомат iz iskalnega seznama,
 * polja naslova se skrijejo, naslov narocila pa se napolni z naslovom
 * prevzemnega mesta (sicer bi narocilo ostalo brez naslova).
 *
 * METAKOCKA (freshdesk 3000106381) — vrsta dostave gre v meto narocila
 * `Econt_Shipping_To` z vrednostjo DOOR / OFFICE / Machine, zraven pa pripadajoca
 * polja:
 *
 *   OFFICE   Econt_Office_Town, Econt_Office, Econt_Office_Postcode
 *   Machine  Econt_Machine_Town, Econt_Machine, Econt_Machine_Postcode
 *   DOOR     Econt_Door_Town, Econt_Door_Postcode, Econt_Door_Street,
 *            Econt_Door_street_num, Econt_Door_building_num,
 *            Econt_Door_Entrance_num, Econt_Door_Floor_num,
 *            Econt_Door_Apartment_num
 *
 * Metakocko je treba na to VNAPREJ opozoriti — na racunu morajo vklopiti
 * dodatno funkcionalnost za vec vrst dostave, sicer preslikava ne dela.
 *
 * Vklop/izklop: functions/econt-stikalo.php
 * Podatki o pisarnah: data/econt-ofisi.tsv (javni Econt Nomenclatures API)
 *
 * @package noriks
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/* Konstante morajo biti NAD stikalom: PHP vrhnje funkcije prevede tudi, ce
   datoteka prej naredi "return", zato bi klic iz form-checkout.php podrl
   blagajno, ce bi bile konstante pod stikalom. */

const NORIKS_ECONT_ID    = 'noriks_econt';
const NORIKS_ECONT_META  = '_econt';
/** Privzeti naziv nacina dostave (preslikava na vrsto dostave v Metakocki). */
const NORIKS_ECONT_NAZIV = 'Офис на Еконт';
/** Napis na kartici prevzemnega mesta (kupcu). */
const NORIKS_ECONT_NAPIS = 'офис на еконт';
/** Napis na kartici za dostavo na naslov. */
const NORIKS_ECONT_DOMA  = 'доставка до дома';
/** V Bolgariji vozi vse Econt, zato je logotip na obeh karticah enak. */
const NORIKS_ECONT_LOGO  = 'https://images.vigo-shop.com/general/curriers/econt.png';

/**
 * Katera kartica je privzeta, ko kupec se ni izbral: 'ofis' ali 'dom'.
 * vigoshop.bg ima privzeto pisarno Econt — zato enako.
 */
const NORIKS_ECONT_PRIVZETO = 'ofis';

/* Meta kljuci Metakocke — ne spreminjaj, zapisani so v njihovi dokumentaciji. */
const NORIKS_ECONT_MK_KAM = 'Econt_Shipping_To';

if ( ! function_exists( 'noriks_econt_vklopljen' ) || ! noriks_econt_vklopljen() ) { return; }


/* ------------------------------------------------------------------ *
 * 1) Podatki o pisarnah in avtomatih
 * ------------------------------------------------------------------ */

function noriks_econt_datoteka() {
	return get_template_directory() . '/data/econt-ofisi.tsv';
}

/** Razclenitev ene vrstice TSV v polje. */
function noriks_econt_vrstica( $vrstica ) {
	$d = explode( "\t", rtrim( $vrstica, "\r\n" ) );
	if ( count( $d ) < 11 ) { return null; }
	return array(
		'id'     => $d[0],   // sifra pisarne (to gre v Metakocko)
		'naziv'  => $d[1],
		'naslov' => $d[2],
		'tip'    => $d[3],   // Офис / Автомат / Мобилен офис
		'ure'    => $d[4],
		'lat'    => $d[5],
		'lon'    => $d[6],
		'ulica'  => $d[7],
		'kod'    => $d[8],
		'mesto'  => $d[9],
	);
}

/** Je to prevzemno mesto avtomat (Еконтомат)? Za Metakocko je to vrsta "Machine". */
function noriks_econt_je_avtomat( $m ) {
	return isset( $m['tip'] ) && mb_strpos( (string) $m['tip'], 'Автомат' ) !== false;
}

/** Iskanje po seznamu. Vrne najvec $limit zadetkov. */
function noriks_econt_isci( $q, $limit = 25 ) {
	$pot = noriks_econt_datoteka();
	if ( ! is_readable( $pot ) ) { return array(); }

	$q = trim( mb_strtolower( $q, 'UTF-8' ) );
	if ( $q === '' ) { return noriks_econt_prva( $limit ); }
	// vec besed: vse morajo biti v zadetku ("софия дружба", "1618 витоша" ...)
	$deli = preg_split( '/\s+/', $q, -1, PREG_SPLIT_NO_EMPTY );
	if ( ! $deli ) { return array(); }

	$ven = array();
	$f = @fopen( $pot, 'r' );
	if ( ! $f ) { return array(); }
	while ( ( $vrstica = fgets( $f ) ) !== false ) {
		$tab = strrpos( $vrstica, "\t" );
		if ( $tab === false ) { continue; }
		$iskalno = substr( $vrstica, $tab + 1 );   // zadnji stolpec = polje za iskanje
		$vse = true;
		foreach ( $deli as $del ) {
			if ( strpos( $iskalno, $del ) === false ) { $vse = false; break; }
		}
		if ( ! $vse ) { continue; }
		$m = noriks_econt_vrstica( $vrstica );
		if ( $m ) { $ven[] = $m; }
		if ( count( $ven ) >= $limit ) { break; }
	}
	fclose( $f );
	return $ven;
}

/**
 * Prvih $limit mest s seznama — kar kupec vidi, preden kaj natipka.
 * Datoteka je urejena po postni stevilki, zato je na vrhu Sofija.
 */
function noriks_econt_prva( $limit = 150 ) {
	$pot = noriks_econt_datoteka();
	if ( ! is_readable( $pot ) ) { return array(); }
	$ven = array();
	$f = @fopen( $pot, 'r' );
	if ( ! $f ) { return array(); }
	while ( ( $vrstica = fgets( $f ) ) !== false ) {
		$m = noriks_econt_vrstica( $vrstica );
		if ( $m ) { $ven[] = $m; }
		if ( count( $ven ) >= $limit ) { break; }
	}
	fclose( $f );
	return $ven;
}

/** Eno prevzemno mesto po sifri. */
function noriks_econt_mesto( $id ) {
	$pot = noriks_econt_datoteka();
	$id  = trim( (string) $id );
	if ( $id === '' || ! is_readable( $pot ) ) { return null; }
	$iskano = $id . "\t";
	$f = @fopen( $pot, 'r' );
	if ( ! $f ) { return null; }
	while ( ( $vrstica = fgets( $f ) ) !== false ) {
		if ( strncmp( $vrstica, $iskano, strlen( $iskano ) ) === 0 ) {
			fclose( $f );
			return noriks_econt_vrstica( $vrstica );
		}
	}
	fclose( $f );
	return null;
}

/* ------------------------------------------------------------------ *
 * 2) REST iskanje
 * ------------------------------------------------------------------ */

add_action( 'rest_api_init', function () {
	register_rest_route( 'noriks/v1', '/econt', array(
		'methods'             => 'GET',
		'permission_callback' => '__return_true',
		'callback'            => function ( $zahteva ) {
			$q = trim( (string) $zahteva->get_param( 'q' ) );
			if ( $q !== '' && mb_strlen( $q, 'UTF-8' ) < 2 ) { return rest_ensure_response( array() ); }
			$limit = ( $q === '' ) ? 150 : 25;
			$ven = array();
			foreach ( noriks_econt_isci( $q, $limit ) as $m ) {
				$ven[] = array(
					'id'     => $m['id'],
					'naziv'  => $m['naziv'],
					'naslov' => $m['naslov'],
					'tip'    => $m['tip'],
					'ure'    => $m['ure'],
					'ulica'  => $m['ulica'],
					'kod'    => $m['kod'],
					'mesto'  => $m['mesto'],
				);
			}
			return rest_ensure_response( $ven );
		},
	) );
} );

/* ------------------------------------------------------------------ *
 * 3) Nacin dostave
 * ------------------------------------------------------------------ */

add_action( 'woocommerce_shipping_init', function () {
	if ( class_exists( 'Noriks_Econt_Shipping' ) || ! class_exists( 'WC_Shipping_Method' ) ) { return; }

	class Noriks_Econt_Shipping extends WC_Shipping_Method {
		public function __construct( $instance_id = 0 ) {
			$this->id                 = NORIKS_ECONT_ID;
			$this->instance_id        = absint( $instance_id );
			$this->method_title       = 'Еконт — офиси и автомати';
			$this->method_description = 'Вземане от офис на Еконт или Еконтомат. Клиентът избира мястото в касата. В MetaKocka свържи това име с вид доставка Еконт.';
			$this->supports           = array( 'shipping-zones', 'instance-settings', 'instance-settings-modal' );
			$this->init();
		}
		public function init() {
			$this->instance_form_fields = array(
				'title' => array(
					'title'       => 'Име (MetaKocka)',
					'type'        => 'text',
					'default'     => NORIKS_ECONT_NAZIV,
					'description' => 'Под това име поръчката влиза в MetaKocka — трябва да е свързано с вид доставка Еконт.',
				),
				'cost' => array(
					'title'       => 'Цена (€)',
					'type'        => 'text',
					'default'     => '2.99',
					'description' => 'Цена на доставката. Празно = безплатно.',
				),
				'free_over' => array(
					'title'       => 'Безплатно над (€)',
					'type'        => 'text',
					'default'     => '70',
					'description' => 'Над тази стойност на количката доставката е безплатна. Празно = никога.',
				),
			);
			$this->title = $this->get_option( 'title' );
			if ( $this->title === '' ) { $this->title = NORIKS_ECONT_NAZIV; }
			add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
		}
		public function calculate_shipping( $package = array() ) {
			$cena      = $this->get_option( 'cost', '' );
			$free_over = $this->get_option( 'free_over', '' );
			$strosek   = ( $cena === '' ) ? 0 : (float) str_replace( ',', '.', $cena );
			if ( $free_over !== '' ) {
				$meja  = (float) str_replace( ',', '.', $free_over );
				$vsota = isset( $package['contents_cost'] ) ? (float) $package['contents_cost'] : 0;
				if ( $meja > 0 && $vsota >= $meja ) { $strosek = 0; }
			}
			$this->add_rate( array(
				'id'      => $this->id . ':' . $this->instance_id,
				'label'   => $this->title,
				'cost'    => $strosek,
				'package' => $package,
			) );
		}
	}
} );

add_filter( 'woocommerce_shipping_methods', function ( $nacini ) {
	$nacini[ NORIKS_ECONT_ID ] = 'Noriks_Econt_Shipping';
	return $nacini;
} );

/** Je ta kljuc ponudbe nacin Econt (prevzemno mesto)? */
function noriks_econt_je_kljuc( $kljuc ) {
	return strpos( (string) $kljuc, NORIKS_ECONT_ID ) === 0;
}

/**
 * Ali je izbrano prevzemno mesto? Gleda oddani obrazec (ob oddaji narocila je
 * merodajen POST, ker seja se ni osvezena) in nato sejo.
 */
function noriks_econt_izbran() {
	if ( function_exists( 'noriks_econt_vklopljen' ) && ! noriks_econt_vklopljen() ) { return false; }
	if ( isset( $_POST['shipping_method'] ) ) {
		foreach ( (array) $_POST['shipping_method'] as $m ) {
			if ( noriks_econt_je_kljuc( sanitize_text_field( wp_unslash( $m ) ) ) ) { return true; }
		}
	}
	$wc = function_exists( 'WC' ) ? WC() : null;
	$izbrani = ( $wc && $wc->session ) ? $wc->session->get( 'chosen_shipping_methods' ) : array();
	if ( ! is_array( $izbrani ) ) { return false; }
	foreach ( $izbrani as $m ) {
		if ( noriks_econt_je_kljuc( $m ) ) { return true; }
	}
	return false;
}

/** Sifra mesta iz seje (prezivi AJAX osvezitev blagajne). */
function noriks_econt_seja_id() {
	$wc = function_exists( 'WC' ) ? WC() : null;
	if ( ! $wc || ! $wc->session ) { return ''; }
	return (string) $wc->session->get( NORIKS_ECONT_META . '_id' );
}

/* ------------------------------------------------------------------ *
 * 4) Blagajna
 *    Razporeditev sledi vigoshop.bg:
 *      telefon -> e-posta -> "Метод на доставка" (kartici levo/desno)
 *      -> ime/priimek -> izbirnik pisarne (ko je izbrano prevzemno mesto;
 *      takrat so polja naslova skrita) -> "Доставка" (datumi + cena).
 * ------------------------------------------------------------------ */

/** Ponudbe dostave, locene na "na dom" in "prevzemno mesto". */
function noriks_econt_ponudbe() {
	$ponudbe = array();
	$wc = function_exists( 'WC' ) ? WC() : null;
	if ( $wc && $wc->shipping() ) {
		$paketi = $wc->shipping()->get_packages();
		if ( isset( $paketi[0]['rates'] ) && is_array( $paketi[0]['rates'] ) ) {
			$ponudbe = $paketi[0]['rates'];
		}
	}
	$doma = array();
	$ofis = array();
	foreach ( $ponudbe as $kljuc => $p ) {
		if ( noriks_econt_je_kljuc( $kljuc ) ) { $ofis[ $kljuc ] = $p; } else { $doma[ $kljuc ] = $p; }
	}

	$izbrani  = ( $wc && $wc->session ) ? (array) $wc->session->get( 'chosen_shipping_methods' ) : array();
	$trenutni = isset( $izbrani[0] ) ? (string) $izbrani[0] : '';

	/* Na dom pokazemo eno samo kartico — najcenejso. Tako kupec nikoli ne vidi
	   placljive dostave, ce je brezplacna ze dosezena. */
	if ( $doma ) {
		$kljuc_doma = null;
		foreach ( $doma as $k => $r ) {
			if ( $kljuc_doma === null || (float) $r->get_cost() < (float) $doma[ $kljuc_doma ]->get_cost() ) {
				$kljuc_doma = $k;
			}
		}
		$doma = array( $kljuc_doma => $doma[ $kljuc_doma ] );
	}
	$vse = $doma + $ofis;
	if ( $trenutni === '' || ! isset( $vse[ $trenutni ] ) ) {
		/* Privzeto je pisarna Econt (kot na vigoshop.bg). Ce nacin ni na voljo,
		   pade nazaj na prvo ponudbo, torej na dostavo na naslov. */
		if ( NORIKS_ECONT_PRIVZETO === 'ofis' && $ofis ) {
			$trenutni = key( $ofis );
		} else {
			$kljuci   = array_keys( $vse );
			$trenutni = $kljuci ? $kljuci[0] : '';
		}
	}
	return array( 'doma' => $doma, 'ofis' => $ofis, 'vse' => $vse, 'izbran' => $trenutni );
}

/** Zelena kljukica na kartici dostave. */
function noriks_econt_kljukica() {
	return '<svg viewBox="0 0 19 14" fill="#3DBD00"><path fill-rule="evenodd" clip-rule="evenodd" d="M18.5725 3.40179L8.14482 13.5874C7.5815 14.1375 6.66839 14.1375 6.1056 13.5874L0.422493 8.03956C-0.140831 7.48994-0.140831 6.59748 0.422493 6.04707L1.44121 5.05126C2.00471 4.50094 2.91854 4.50094 3.48132 5.05126L7.12254 8.60835L15.5145 0.412609C16.078-0.137536 16.9909-0.137536 17.5537 0.412609L18.5733 1.40842C19.1424 1.95795 19.1424 2.8505 18.5725 3.40179Z"/></svg>';
}

/** "Метод на доставка" — kartici levo/desno, nad polji za ime in naslov. */
function noriks_econt_izbira() {
	$p = noriks_econt_ponudbe();
	if ( ! $p['ofis'] ) { return; }   // dokler nacin ni vklopljen, se blagajna ne spremeni

	$kljuc_doma = $p['doma'] ? key( $p['doma'] ) : '';
	$kljuc_ofis = key( $p['ofis'] );
	$je_ofis    = noriks_econt_je_kljuc( $p['izbran'] );
	?>
	<!-- necont 2026-11-13-a -->
	<div class="hs-delivery-type-container bg-econt">
		<div class="container__title">Метод на доставка</div>
		<div class="container__buttons">
			<div class="delivery-type hs-delivery-office enabled<?php echo $je_ofis ? ' active' : ''; ?>"
				data-rate="<?php echo esc_attr( $kljuc_ofis ); ?>" data-econt="1">
				<p><?php echo esc_html( NORIKS_ECONT_NAPIS ); ?></p>
				<img decoding="async" src="<?php echo esc_url( NORIKS_ECONT_LOGO ); ?>" alt="Еконт">
			</div>
			<?php if ( $kljuc_doma !== '' ) : ?>
			<div class="delivery-type hs-delivery-home enabled<?php echo $je_ofis ? '' : ' active'; ?>"
				data-rate="<?php echo esc_attr( $kljuc_doma ); ?>" data-econt="0">
				<p><?php echo esc_html( NORIKS_ECONT_DOMA ); ?></p>
				<img decoding="async" src="<?php echo esc_url( NORIKS_ECONT_LOGO ); ?>" alt="Еконт">
			</div>
			<?php endif; ?>
		</div>
		<input type="hidden" name="shipping_method[0]" id="necont_rate" value="<?php echo esc_attr( $p['izbran'] ); ?>">
	</div>
	<?php
}

/** Izbirnik pisarne + povzetek izbranega mesta. */
function noriks_econt_izbirnik() {
	$p = noriks_econt_ponudbe();
	if ( ! $p['ofis'] ) { return; }

	$je_ofis  = noriks_econt_je_kljuc( $p['izbran'] );
	$shranjen = noriks_econt_seja_id();
	$mesto    = $shranjen !== '' ? noriks_econt_mesto( $shranjen ) : null;
	?>
	<div class="form-row form-row-wide col-xs-12 necont-row" id="necont_field"<?php echo $je_ofis ? '' : ' style="display:none"'; ?>>
		<span class="woocommerce-input-wrapper">
			<select name="necont_id" id="necont_select" class="select form-input"
				data-placeholder="Изберете офис или Еконтомат">
				<option value=""></option>
				<?php if ( $mesto ) : ?>
					<option value="<?php echo esc_attr( $mesto['id'] ); ?>" selected="selected"><?php
						echo esc_html( $mesto['naziv'] . ' ' . $mesto['naslov'] );
					?></option>
				<?php endif; ?>
			</select>
			<input type="text" id="necont_q" class="necont-q" autocomplete="off" hidden
				placeholder="Изберете офис или Еконтомат">
			<ul id="necont_list" class="necont-list" hidden></ul>
		</span>
		<span id="necont_napaka" class="necont-napaka" hidden>Моля, изберете офис на Еконт.</span>
	</div>

	<div id="necont_izbrano" class="necont-sel"<?php echo ( $je_ofis && $mesto ) ? '' : ' style="display:none"'; ?>>
		<div class="necont-sel-h">Място за получаване:</div>
		<table class="necont-tab">
			<tr><th>Име:</th>    <td id="necont_naziv"><?php echo $mesto ? esc_html( $mesto['naziv'] ) : ''; ?></td></tr>
			<tr><th>Адрес:</th>  <td id="necont_naslov"><?php echo $mesto ? esc_html( $mesto['naslov'] ) : ''; ?></td></tr>
			<tr><th>Вид:</th>    <td id="necont_tip"><?php echo $mesto ? esc_html( $mesto['tip'] ) : ''; ?></td></tr>
			<tr><th>Работно време:</th>
				<td id="necont_ure"><?php echo $mesto ? esc_html( $mesto['ure'] ) : ''; ?></td></tr>
		</table>
	</div>
	<?php
	noriks_econt_slog_in_skripta();
}

/** Blok "Доставка" v drugem stolpcu: datumi, cena, logotip prevoznika. */
function noriks_econt_nacini() {
	$p = noriks_econt_ponudbe();
	/* Izklopljeno (nacina Econt ni v coni) ali brez ponudb: izrisemo natanko
	   tisto kartico, kot je bila na blagajni pred to nadgradnjo. */
	if ( ! $p['vse'] || ! $p['ofis'] ) { noriks_econt_rezervna_kartica(); return; }

	$ponudba = $p['vse'][ $p['izbran'] ];
	noriks_econt_kartica( (float) $ponudba->get_cost() );
}

/** Ko WooCommerce ne vrne ponudb: ista kartica kot prej. */
function noriks_econt_rezervna_kartica() {
	$wc   = function_exists( 'WC' ) ? WC() : null;
	$cena = ( $wc && $wc->cart ) ? (float) $wc->cart->get_shipping_total() : 0;
	noriks_econt_kartica( $cena, true );
}

function noriks_econt_kartica( $cena, $kot_prej = false ) {
	?>
	<ul class="shipping_method_custom">
		<li class="standard-shipping shipping-tab<?php echo $kot_prej ? '' : ' is-on'; ?>">
			<?php if ( $kot_prej ) : ?>
			<input name="shipping_method[0]" data-index="0" id="shipping_method_0_standard_custom"
				value="standard" class="shipping_method shipping_method_field" type="radio" checked>
			<?php endif; ?>
			<label<?php echo $kot_prej ? ' for="shipping_method_0_standard_custom"' : ''; ?> class="checkedlabel">
				<?php echo noriks_econt_kljukica(); ?>
				<div class="outer-wrapper">
					<div class="inner-wrapper-dates">
						<strong class="hs-custom-date js-delivery-dates" id="js-delivery-dates"></strong>
					</div>
					<div class="inner-wrapper-img">
						<span class="shipping_method_delivery_price tag tag--red"><?php
							echo $cena > 0 ? esc_html( number_format( $cena, 2, ',', ' ' ) . ' €' ) : 'Безплатно';
						?></span>
						<span class="delivery_img"><img decoding="async" class="econt standard"
							id="necont_logo" alt="Еконт"
							src="<?php echo esc_url( NORIKS_ECONT_LOGO ); ?>"/></span>
					</div>
				</div>
			</label>
		</li>
	</ul>
	<?php
}

/* Vrivanje v obrazec: kartici nad imenom, izbirnik pod priimkom. */
add_filter( 'woocommerce_form_field', function ( $polje, $kljuc ) {
	if ( ! is_checkout() ) { return $polje; }
	if ( $kljuc === 'billing_first_name' ) {
		ob_start(); noriks_econt_izbira(); return ob_get_clean() . $polje;
	}
	if ( $kljuc === 'billing_last_name' ) {
		ob_start(); noriks_econt_izbirnik(); return $polje . ob_get_clean();
	}
	return $polje;
}, 10, 2 );

/**
 * Slog izbirnika (enkrat) + prijava skripte v nogo.
 * Skripta mora v nogo: v obrazcu bi tekla, preden WooCommerce nalozi
 * jQuery.selectWoo, in izbirnik bi padel na rezervno besedilno polje.
 */
function noriks_econt_slog_in_skripta() {
	static $enkrat = false;
	if ( $enkrat ) { return; }
	$enkrat = true;
	add_action( 'wp_footer', 'noriks_econt_skripta', 99 );
	?>
	<style>
	/* Kartici nacina dostave — enak slog kot na CZ in PL.
	   Osnovo (razporeditev, barve, mobilno) da vgrajeni CSS blagajne, tu samo
	   poenotimo visino, logotip in napis, da se daljsi napis ne prelije cez rob
	   in da sta kartici enako visoki. */
	.hs-delivery-type-container .container__buttons { align-items: stretch; }
	/* Sredinjenje zapisemo sami in ne racunamo na vgrajeni CSS — ta je vezan na
	   razrede posameznih trgov in se drugace obnasa. */
	.hs-delivery-type-container .delivery-type {
		display: flex !important; flex-direction: column-reverse !important;
		justify-content: center !important; align-items: center !important;
		text-align: center !important;
		height: auto !important; min-height: 69px; padding: 8px !important;
		box-sizing: border-box; }
	/* Tema da odstavku "display: flex", zato text-align nanj ne vpliva in
	   besedilo ostane levo. Zato ga vrnemo v navaden blok. */
	.hs-delivery-type-container .delivery-type p {
		display: block !important; justify-content: center !important;
		font-size: 14px !important; line-height: 18px !important; margin: 4px 0 0 !important;
		width: 100%; text-align: center !important; }
	.hs-delivery-type-container .delivery-type img {
		display: block !important; max-width: 72px !important; max-height: 32px !important;
		width: auto !important; padding: 3px !important; margin: 0 auto !important;
		object-fit: contain; }

	/* kljukica v bloku "Доставка" (CSS teme jo meri prek "label svg") */
	#custom_shipping .checkedlabel svg { width: 19px !important; height: 14px !important;
		flex: 0 0 19px !important; margin-right: 10px !important; }

	/* Izbirnik pisarne — mere so vzete iz nasih polj na blagajni
	   (visina 60px, pisava 18px, obroba 1,5px #c9c9c9, zaobljenost 4px),
	   da stoji v vrsti enako kot ostala polja. */
	.necont-row { margin: 0 0 10px !important; position: relative; }
	.necont-row .select2-container { width: 100% !important; }
	.necont-row .select2-container--default .select2-selection--single {
		height: 60px !important; border: 1.5px solid #c9c9c9 !important;
		border-radius: 4px !important; background: #fff !important; outline: none !important; }
	.necont-row .select2-container--default .select2-selection--single .select2-selection__rendered {
		line-height: 57px !important; font-size: 18px !important; color: #333 !important;
		padding: 0 34px 0 18px !important; }
	.necont-row .select2-container--default .select2-selection--single .select2-selection__placeholder {
		color: #8a8a8a !important; font-size: 18px !important; }
	.necont-row .select2-container--default .select2-selection--single .select2-selection__arrow {
		height: 57px !important; right: 12px !important; }
	.necont-row.is-filled .select2-container--default .select2-selection--single {
		border-color: #47b426 !important; background: #f2feee !important; }
	.select2-dropdown { border: 1.5px solid #c9c9c9 !important; border-radius: 4px !important; }
	.select2-container--default .select2-results__option { font-size: 15px !important; line-height: 1.35 !important; }
	.select2-container--default .select2-search--dropdown .select2-search__field {
		height: 44px !important; font-size: 16px !important; padding: 0 12px !important;
		border: 1.5px solid #c9c9c9 !important; border-radius: 4px !important; }
	/* rezervno polje (ce selectWoo ni na voljo) — enake mere kot ostala polja */
	.necont-q { width: 100%; height: 60px; padding: 0 18px; border: 1.5px solid #c9c9c9; border-radius: 4px;
		font-size: 18px; box-sizing: border-box; }
	.necont-list { position: absolute; z-index: 30; left: 0; right: 0; margin: 2px 0 0; padding: 0; list-style: none;
		background: #fff; border: 1.5px solid #c9c9c9; border-radius: 4px; max-height: 320px; overflow: auto;
		box-shadow: 0 10px 28px rgba(0,0,0,.12); }
	.necont-list li { padding: 10px 14px; cursor: pointer; font-size: 15px; line-height: 1.35; border-bottom: 1px solid #f0f0f0; }
	.necont-list li:last-child { border-bottom: 0; }
	.necont-list li:hover { background: #1f6fbf; color: #fff; }
	.necont-napaka { color: #c0392b; font-size: 13.5px; display: block; margin-top: 6px; }

	/* povzetek izbranega mesta */
	.necont-sel { margin: 4px 0 14px; }
	.necont-sel-h { font-size: 19.6px; font-weight: 700; margin: 0 0 9.8px; }
	.necont-tab { width: 100%; border-collapse: collapse; font-size: 14px; border: 1px solid #e3e3e3; }
	.necont-tab th { text-align: left; font-weight: 400; color: #555; padding: 10px 12px; vertical-align: top; width: 150px;
		border-bottom: 1px solid #ededed; }
	.necont-tab td { padding: 10px 12px; font-weight: 700; border-bottom: 1px solid #ededed; }
	.necont-tab tr:last-child th, .necont-tab tr:last-child td { border-bottom: 0; }
	</style>
	<?php
}

/** Skripta izbirnika — v nogi, ko sta jQuery in selectWoo ze nalozena. */
function noriks_econt_skripta() {
	?>
	<script>
	(function(){
	  var koren = <?php echo wp_json_encode( esc_url_raw( rest_url( 'noriks/v1/econt' ) ) ); ?>;
	  /* WooCommerce nalozi selectWoo z "defer", zato ga ob zagonu te skripte se
	     ni. Pocakamo nanj, sicer pade izbirnik na rezervno polje. */
	  function zazeni(){
	  var $ = window.jQuery;
	  function el(id){ return document.getElementById(id); }

	  var kartice = document.querySelectorAll('.hs-delivery-type-container .delivery-type');
	  var rate    = el('necont_rate');
	  var polje   = el('necont_field');
	  var okvir   = el('necont_izbrano');
	  var napaka  = el('necont_napaka');
	  var sel     = el('necont_select');
	  if (!kartice.length || !rate) return;

	  /* Skripta blagajne po nalaganju prestavi vse .form-row na konec ovoja,
	     zato nase bloke po tem postavimo na pravo mesto. */
	  function postavi(){
	    var kart = document.querySelector('.hs-delivery-type-container');
	    var ime  = el('billing_first_name_field');
	    var prii = el('billing_last_name_field');
	    if (kart && ime && kart.nextElementSibling !== ime) { ime.parentNode.insertBefore(kart, ime); }
	    if (prii && polje && prii.nextElementSibling !== polje) { prii.parentNode.insertBefore(polje, prii.nextElementSibling); }
	    if (polje && okvir && polje.nextElementSibling !== okvir) { polje.parentNode.insertBefore(okvir, polje.nextElementSibling); }
	  }
	  postavi();
	  [60, 300, 900, 2000].forEach(function(t){ setTimeout(postavi, t); });
	  if ($) $(document.body).on('updated_checkout country_to_state_changed', function(){ postavi(); osvezi(); });

	  function vrsticeNaslova(){
	    var v = [];
	    ['billing_address_1_field','billing_address_2_field','billing_postcode_field','billing_city_field']
	      .forEach(function(id){ var e = el(id); if (e) v.push(e); });
	    var prva = el('billing_address_1_field');
	    if (prva && prva.previousElementSibling &&
	        prva.previousElementSibling.classList.contains('form-row')) { v.push(prva.previousElementSibling); }
	    return v;
	  }

	  function jeOfis(){
	    var a = document.querySelector('.hs-delivery-type-container .delivery-type.active');
	    return !!a && a.getAttribute('data-econt') === '1';
	  }

	  /* Skrita polja naslova napolnimo z naslovom prevzemnega mesta (tako
	     narocilo ni brez naslova in preverjanje hisne stevilke uspe), a si
	     kupcev naslov zapomnimo in ga vrnemo, ce se premisli. */
	  var imenaNaslova = ['billing_address_1','billing_address_2','billing_postcode','billing_city'];
	  var shranjenNaslov = null;

	  function napolniNaslov(m){
	    if (!m) { return; }
	    if (shranjenNaslov === null) {
	      shranjenNaslov = imenaNaslova.map(function(id){ var e = el(id); return e ? e.value : ''; });
	    }
	    var v = {billing_address_1: m.ulica || m.naslov, billing_address_2: 'BB',
	             billing_postcode: m.kod || '', billing_city: m.mesto || ''};
	    Object.keys(v).forEach(function(id){
	      var e = el(id); if (e && v[id]) { e.value = v[id]; e.dispatchEvent(new Event('change', {bubbles:true})); }
	    });
	  }

	  function vrniNaslov(){
	    if (shranjenNaslov === null) { return; }
	    imenaNaslova.forEach(function(id, i){
	      var e = el(id);
	      if (e) { e.value = shranjenNaslov[i]; e.dispatchEvent(new Event('change', {bubbles:true})); }
	    });
	    shranjenNaslov = null;
	  }

	  function osvezi(){
	    var ofis = jeOfis();
	    vrsticeNaslova().forEach(function(e){ e.style.display = ofis ? 'none' : ''; });
	    if ( ! ofis ) { vrniNaslov(); }
	    if (polje) polje.style.display = ofis ? '' : 'none';
	    if (okvir) okvir.style.display = (ofis && sel && sel.value) ? '' : 'none';
	    if (napaka) napaka.hidden = true;
	    if (polje) polje.classList.toggle('is-filled', !!(sel && sel.value));
	  }

	  kartice.forEach(function(k){
	    k.addEventListener('click', function(){
	      kartice.forEach(function(x){ x.classList.remove('active'); });
	      k.classList.add('active');
	      rate.value = k.getAttribute('data-rate');
	      osvezi();
	      if ($) $(document.body).trigger('update_checkout');
	    });
	  });

	  function izbrano(m){
	    napolniNaslov(m);
	    el('necont_naziv').textContent  = m.naziv;
	    el('necont_naslov').textContent = m.naslov;
	    el('necont_tip').textContent    = m.tip;
	    el('necont_ure').textContent    = m.ure || '';
	    if (okvir) okvir.style.display = '';
	    if (polje) polje.classList.add('is-filled');
	    if (napaka) napaka.hidden = true;
	    if ($) $(document.body).trigger('update_checkout');
	  }

	  if ($ && $.fn.selectWoo && sel) {
	    $(sel).selectWoo({
	      placeholder: 'Изберете офис или Еконтомат',
	      width: '100%',
	      minimumInputLength: 0,
	      language: {
	        inputTooShort: function(){ return 'Въведете град, улица или пощенски код…'; },
	        searching:     function(){ return 'Търся…'; },
	        noResults:     function(){ return 'Няма намерени резултати.'; }
	      },
	      ajax: {
	        url: koren, dataType: 'json', delay: 220,
	        data: function(p){ return { q: p.term }; },
	        processResults: function(d){
	          return { results: (d || []).map(function(m){
	            return { id: m.id, text: m.naziv + ' — ' + m.naslov, mesto: m };
	          }) };
	        }
	      }
	    });
	    $(sel).on('select2:select', function(e){ izbrano(e.params.data.mesto); });
	  } else if (sel) {
	    sel.hidden = true;
	    var q = el('necont_q'), lista = el('necont_list'), cas;
	    if (q) {
	      q.hidden = false;
	      q.addEventListener('input', function(){
	        clearTimeout(cas);
	        var v = q.value.trim();
	        if (v.length < 2) { lista.hidden = true; lista.innerHTML = ''; return; }
	        cas = setTimeout(function(){
	          fetch(koren + '?q=' + encodeURIComponent(v)).then(function(r){ return r.json(); })
	            .then(function(d){
	              lista.innerHTML = '';
	              if (!d || !d.length) { lista.innerHTML = '<li>Няма намерени резултати.</li>'; }
	              else d.forEach(function(m){
	                var li = document.createElement('li');
	                li.textContent = m.naziv + ' — ' + m.naslov;
	                li.addEventListener('click', function(){
	                  sel.innerHTML = '<option value="' + m.id + '" selected></option>';
	                  sel.options[0].textContent = m.naziv + ' ' + m.naslov;
	                  q.value = m.naziv + ', ' + m.naslov;
	                  lista.hidden = true;
	                  izbrano(m);
	                });
	                lista.appendChild(li);
	              });
	              lista.hidden = false;
	            }).catch(function(){ lista.hidden = true; });
	        }, 220);
	      });
	      document.addEventListener('click', function(e){
	        if (lista && !lista.hidden && !lista.contains(e.target) && e.target !== q) { lista.hidden = true; }
	      });
	    }
	  }

	  if ($) $('form.checkout').on('checkout_place_order', function(){
	    if (jeOfis() && (!sel || !sel.value)) {
	      if (napaka) napaka.hidden = false;
	      if (polje) polje.scrollIntoView({ behavior: 'smooth', block: 'center' });
	      return false;
	    }
	    return true;
	  });

	  osvezi();
	  }
	  var cakam = 0;
	  (function cakaj(){
	    if ( ( window.jQuery && window.jQuery.fn && window.jQuery.fn.selectWoo ) || ++cakam > 60 ) { zazeni(); }
	    else { setTimeout( cakaj, 100 ); }
	  })();
	})();
	</script>
	<?php
}

/* Izbrano mesto shrani v sejo, da prezivi osvezitev blagajne. */
add_action( 'woocommerce_checkout_update_order_review', function ( $podatki ) {
	parse_str( $podatki, $p );
	$wc = function_exists( 'WC' ) ? WC() : null;
	if ( ! $wc || ! $wc->session ) { return; }
	if ( isset( $p['necont_id'] ) ) {
		$wc->session->set( NORIKS_ECONT_META . '_id', sanitize_text_field( $p['necont_id'] ) );
	}
	if ( isset( $p['shipping_method'][0] ) ) {
		$nacin = sanitize_text_field( $p['shipping_method'][0] );
		$wc->session->set( NORIKS_ECONT_META . '_nacin', $nacin );
		/* Ta razlicica WooCommerca pri osvezitvi blagajne bere nacin dostave
		   samo iz vrhnjega polja zahteve, ne iz post_data — izmerjeno na PL.
		   Ker kartice posiljajo izbiro v obrazcu, jo moramo uveljaviti sami,
		   sicer bi izbira ostala na prejsnjem nacinu. */
		$izbrani = (array) $wc->session->get( 'chosen_shipping_methods' );
		if ( ! isset( $izbrani[0] ) || $izbrani[0] !== $nacin ) {
			$izbrani[0] = $nacin;
			$wc->session->set( 'chosen_shipping_methods', $izbrani );
		}
	}
} );

/* Pri prevzemnem mestu ulica, hisna stevilka, postna stevilka in mesto niso obvezni. */
add_filter( 'woocommerce_checkout_fields', function ( $polja ) {
	if ( ! noriks_econt_izbran() ) { return $polja; }
	foreach ( array( 'billing_address_1', 'billing_address_2', 'billing_postcode', 'billing_city' ) as $k ) {
		if ( isset( $polja['billing'][ $k ] ) ) { $polja['billing'][ $k ]['required'] = false; }
	}
	return $polja;
}, 20 );

/* Obnovi izbrani nacin dostave ob nalaganju blagajne. */
add_action( 'woocommerce_before_calculate_totals', 'noriks_econt_obnovi_izbiro', 5 );
function noriks_econt_obnovi_izbiro() {
	if ( is_admin() && ! wp_doing_ajax() ) { return; }
	/* Obnovimo samo pri navadnem nalaganju strani. Ce zahteva ze nosi izbrani
	   nacin (oddaja narocila ali osvezitev blagajne prek post_data), je ta
	   mocnejsi — sicer bi povozili kupcev pravkar izbrani nacin. */
	if ( isset( $_POST['shipping_method'] ) ) { return; }
	if ( isset( $_POST['post_data'] ) ) {
		parse_str( wp_unslash( $_POST['post_data'] ), $pd );
		if ( isset( $pd['shipping_method'] ) ) { return; }
	}
	$wc = function_exists( 'WC' ) ? WC() : null;
	if ( ! $wc || ! $wc->session ) { return; }

	$nacin = (string) $wc->session->get( NORIKS_ECONT_META . '_nacin' );
	if ( $nacin === '' || ! noriks_econt_je_kljuc( $nacin ) ) { return; }

	$izbrani = (array) $wc->session->get( 'chosen_shipping_methods' );
	if ( isset( $izbrani[0] ) && $izbrani[0] === $nacin ) { return; }

	$izbrani[0] = $nacin;
	$wc->session->set( 'chosen_shipping_methods', $izbrani );
}

/* ------------------------------------------------------------------ *
 * 5) Preverjanje in shranjevanje k narocilu
 * ------------------------------------------------------------------ */

function noriks_econt_poslan_id() {
	$id = isset( $_POST['necont_id'] ) ? sanitize_text_field( wp_unslash( $_POST['necont_id'] ) ) : '';
	if ( $id === '' ) { $id = noriks_econt_seja_id(); }
	return $id;
}

add_action( 'woocommerce_checkout_process', function () {
	if ( ! noriks_econt_izbran() ) { return; }
	$id = noriks_econt_poslan_id();
	if ( $id === '' || ! noriks_econt_mesto( $id ) ) {
		wc_add_notice( 'Моля, изберете офис на Еконт.', 'error' );
	}
}, 5 );

/**
 * Naslov narocila nastavi na izbrano prevzemno mesto — polja na blagajni so
 * skrita, sicer bi naslov ostal prazen.
 * Izklop: add_filter( 'noriks_econt_naslov_mesta', '__return_false' );
 */
function noriks_econt_naslov( $narocilo, $m ) {
	if ( ! apply_filters( 'noriks_econt_naslov_mesta', true, $narocilo, $m ) ) { return; }
	foreach ( array( 'billing', 'shipping' ) as $kaj ) {
		$narocilo->{'set_' . $kaj . '_address_1'}( $m['ulica'] !== '' ? $m['ulica'] : $m['naslov'] );
		$narocilo->{'set_' . $kaj . '_address_2'}( '' );
		$narocilo->{'set_' . $kaj . '_postcode'}( $m['kod'] );
		$narocilo->{'set_' . $kaj . '_city'}( $m['mesto'] );
	}
}

/**
 * Metakockina polja. Pri prevzemnem mestu OFFICE oziroma Machine, sicer DOOR z
 * naslovom kupca. Kljuci so iz njihove dokumentacije (3000106381).
 */
function noriks_econt_meta_mk( $narocilo, $m = null ) {
	if ( $m ) {
		$avtomat = noriks_econt_je_avtomat( $m );
		$narocilo->update_meta_data( NORIKS_ECONT_MK_KAM, $avtomat ? 'Machine' : 'OFFICE' );
		$p = $avtomat ? 'Econt_Machine' : 'Econt_Office';
		$narocilo->update_meta_data( $p . '_Town',     $m['mesto'] );
		$narocilo->update_meta_data( $p,               $m['id'] );
		$narocilo->update_meta_data( $p . '_Postcode', $m['kod'] );
		return;
	}
	$narocilo->update_meta_data( NORIKS_ECONT_MK_KAM, 'DOOR' );
	$narocilo->update_meta_data( 'Econt_Door_Town',       $narocilo->get_billing_city() );
	$narocilo->update_meta_data( 'Econt_Door_Postcode',   $narocilo->get_billing_postcode() );
	$narocilo->update_meta_data( 'Econt_Door_Street',     $narocilo->get_billing_address_1() );
	$narocilo->update_meta_data( 'Econt_Door_street_num', $narocilo->get_billing_address_2() );
	/* Blok, vhod, nadstropje in stanovanje na nasi blagajni (se) nimamo —
	   polja posljemo prazna, da je zapis poln in predvidljiv. */
	foreach ( array( 'building_num', 'Entrance_num', 'Floor_num', 'Apartment_num' ) as $k ) {
		$narocilo->update_meta_data( 'Econt_Door_' . $k, '' );
	}
}

add_action( 'woocommerce_checkout_create_order', function ( $narocilo ) {
	if ( ! noriks_econt_izbran() ) {
		noriks_econt_meta_mk( $narocilo );   // dostava na naslov
		return;
	}
	$m = noriks_econt_mesto( noriks_econt_poslan_id() );
	if ( ! $m ) { return; }

	noriks_econt_naslov( $narocilo, $m );
	noriks_econt_meta_mk( $narocilo, $m );

	$narocilo->update_meta_data( NORIKS_ECONT_META . '_id',     $m['id'] );
	$narocilo->update_meta_data( NORIKS_ECONT_META . '_naziv',  $m['naziv'] );
	$narocilo->update_meta_data( NORIKS_ECONT_META . '_adres',  $m['naslov'] );
	$narocilo->update_meta_data( NORIKS_ECONT_META . '_vid',    $m['tip'] );
}, 10, 1 );

add_action( 'woocommerce_checkout_order_created', function ( $narocilo ) {
	$m = noriks_econt_iz_narocila( $narocilo );
	if ( ! $m ) { return; }
	$narocilo->add_order_note( sprintf( 'Еконт (%s): %s, %s — код %s',
		$m['tip'], $m['naziv'], $m['naslov'], $m['id'] ) );
}, 10, 1 );

/* ------------------------------------------------------------------ *
 * 6) Prikaz izbranega mesta
 * ------------------------------------------------------------------ */

function noriks_econt_iz_narocila( $narocilo ) {
	if ( ! $narocilo || ! is_a( $narocilo, 'WC_Order' ) ) { return null; }
	$id = $narocilo->get_meta( NORIKS_ECONT_META . '_id' );
	if ( ! $id ) { return null; }
	return array(
		'id'     => $id,
		'naziv'  => $narocilo->get_meta( NORIKS_ECONT_META . '_naziv' ),
		'naslov' => $narocilo->get_meta( NORIKS_ECONT_META . '_adres' ),
		'tip'    => $narocilo->get_meta( NORIKS_ECONT_META . '_vid' ),
	);
}

add_action( 'woocommerce_admin_order_data_after_shipping_address', function ( $narocilo ) {
	$m = noriks_econt_iz_narocila( $narocilo );
	if ( ! $m ) { return; }
	echo '<p><strong>Еконт:</strong><br>' . esc_html( $m['naziv'] ) . '<br>'
	   . esc_html( $m['naslov'] ) . '<br><small>' . esc_html( $m['tip'] )
	   . ' · код ' . esc_html( $m['id'] ) . '</small></p>';
}, 10, 1 );

add_action( 'woocommerce_email_after_order_table', function ( $narocilo ) {
	$m = noriks_econt_iz_narocila( $narocilo );
	if ( ! $m ) { return; }
	echo '<h2>Място за получаване</h2><p>' . esc_html( $m['naziv'] ) . '<br>'
	   . esc_html( $m['naslov'] ) . '<br>' . esc_html( $m['tip'] ) . '</p>';
}, 15, 1 );

add_action( 'woocommerce_thankyou', function ( $id_narocila ) {
	$m = noriks_econt_iz_narocila( wc_get_order( $id_narocila ) );
	if ( ! $m ) { return; }
	echo '<section class="necont-ty"><h2>Място за получаване</h2><p><strong>'
	   . esc_html( $m['naziv'] ) . '</strong><br>' . esc_html( $m['naslov'] ) . '</p></section>';
}, 15, 1 );

add_action( 'admin_notices', function () {
	if ( ! current_user_can( 'manage_woocommerce' ) ) { return; }
	if ( is_readable( noriks_econt_datoteka() ) ) { return; }
	echo '<div class="notice notice-warning"><p><strong>Еконт:</strong> manjka '
	   . '<code>data/econt-ofisi.tsv</code>, zato izbirnik pisarn ne dela.</p></div>';
} );
