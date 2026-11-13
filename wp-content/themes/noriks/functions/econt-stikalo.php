<?php
/**
 * Stikalo za prevzemna mesta Econt (BG).
 *
 * Tu je edino mesto, kjer se moznost prizge ali ugasne. Ko je ugasnjena, se
 * modul `econt.php` sploh ne nalozi: nacin dostave se ne registrira, blagajna
 * je natanko taka kot pred nadgradnjo (samo dostava na naslov).
 *
 * Vrednosti:
 *   true                      — vklopljeno povsod
 *   false                     — izklopljeno povsod
 *   array( 'devbg.noriks.com' ) — vklopljeno samo na nastetih gostiteljih
 *
 * Zacetni "www." se odreze, zato ni treba nastevati obeh oblik.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

$noriks_econt_stikalo = array( 'devbg.noriks.com' );

if ( ! function_exists( 'noriks_econt_vklopljen' ) ) {
	/**
	 * @return bool Ali so prevzemna mesta Econt na tem gostitelju vklopljena.
	 */
	function noriks_econt_vklopljen() {
		global $noriks_econt_stikalo;
		$s = $noriks_econt_stikalo;

		if ( is_bool( $s ) ) { return $s; }
		if ( ! is_array( $s ) ) { return false; }

		$gostitelj = isset( $_SERVER['HTTP_HOST'] ) ? strtolower( (string) $_SERVER['HTTP_HOST'] ) : '';
		if ( $gostitelj === '' ) {
			$gostitelj = strtolower( (string) wp_parse_url( home_url(), PHP_URL_HOST ) );
		}
		$gostitelj = preg_replace( '/:\d+$/', '', $gostitelj );
		$gostitelj = preg_replace( '/^www\./', '', $gostitelj );

		foreach ( $s as $dovoljen ) {
			$dovoljen = preg_replace( '/^www\./', '', strtolower( trim( (string) $dovoljen ) ) );
			if ( $dovoljen !== '' && $dovoljen === $gostitelj ) { return true; }
		}
		return false;
	}
}
