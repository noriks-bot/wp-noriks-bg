<?php
/**
 * Plugin Name: NORIKS — ugasnjen vticnik Econt
 * Description: Ne nalozi placljivega vticnika "Доставка с Еконт Експрес". V dostavni coni se ne uporablja, brez licence pa v administraciji neprenehoma javlja "Няма активен лиценз". Prevzemna mesta Econt so narejena v temi (functions/econt.php).
 * Version: 1.0
 * Author: NORIKS
 *
 * Zakaj mu-plugin in ne tema: WordPress nalozi vticnike PRED temo, zato filter
 * iz functions.php pride prepozno. Datoteke v mu-plugins se nalozijo prve.
 *
 * Kako ugasniti to ugasnitev (ce bi licenco kdaj kupili): izbrisi to datoteko
 * ali nastavi NORIKS_ECONT_UGASNI_VTICNIK na false.
 *
 * V bazi vticnik ostane zapisan kot aktiven — nic ni unicenega, samo ne tece.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! defined( 'NORIKS_ECONT_UGASNI_VTICNIK' ) ) {
	define( 'NORIKS_ECONT_UGASNI_VTICNIK', true );
}

/** Deli poti vticnikov, ki jih ne nalozimo. */
function noriks_econt_vticniki_ven() {
	return array( 'econt' );
}

add_filter( 'option_active_plugins', function ( $aktivni ) {
	if ( ! NORIKS_ECONT_UGASNI_VTICNIK || ! is_array( $aktivni ) ) { return $aktivni; }

	$ven      = noriks_econt_vticniki_ven();
	$ostanejo = array();
	foreach ( $aktivni as $pot ) {
		$izloci = false;
		foreach ( $ven as $delec ) {
			if ( stripos( (string) $pot, $delec ) !== false ) { $izloci = true; break; }
		}
		if ( ! $izloci ) { $ostanejo[] = $pot; }
	}
	return array_values( $ostanejo );
} );

/**
 * Da ni tiho: na seznamu vticnikov povemo, zakaj Econtov vticnik ne tece —
 * sicer bi kdo iskal, zakaj se je sam ugasnil.
 */
add_action( 'admin_notices', function () {
	if ( ! NORIKS_ECONT_UGASNI_VTICNIK ) { return; }
	$zaslon = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( ! $zaslon || $zaslon->id !== 'plugins' ) { return; }
	if ( ! current_user_can( 'activate_plugins' ) ) { return; }
	echo '<div class="notice notice-info"><p>Vtičnik <strong>Доставка с Еконт Експрес</strong> '
	   . 'namenoma ne teče — prevzemna mesta Econt so narejena v temi '
	   . '(<code>functions/econt.php</code>). Ureja se v '
	   . '<code>wp-content/mu-plugins/noriks-econt-vticnik-ugasnjen.php</code>.</p></div>';
} );
