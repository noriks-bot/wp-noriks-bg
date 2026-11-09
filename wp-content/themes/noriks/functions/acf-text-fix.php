<?php
/**
 * Popravki besedil, ki so shranjena v ACF nastavitvah.
 *
 * Do ACF moznosti prek REST API-ja ni dostopa, zato besedilo popravimo ob izpisu.
 * Deluje samo, dokler je v bazi staro besedilo — ko ga Dejan popravi v wp-adminu,
 * funkcija nima vec kaj zamenjati.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'noriks_no_free_exchange' ) ) {
    /**
     * Odstrani besedo "brezplacno" SAMO tam, kjer se navezuje na zamenjavo izdelka
     * (Dejan, 25. 8. 2026: zamenjave niso brezplacne, povratno postnino placa kupec).
     * Brezplacna DOSTAVA ostane nedotaknjena.
     */
    function noriks_no_free_exchange( $txt ) {
        if ( ! is_string( $txt ) || $txt === '' ) { return $txt; }
        $free = 'besplatn\w*|brezplačn\w*|bezplatn\w*|bezpłatn\w*|darmow\w*|gratuit\w*|δωρεάν|kostenlos\w*|ingyenes|free';
        $exch = 'zamjen\w*|zamenjav\w*|výmen\w*|výměn\w*|wymian\w*|schimb\w*|ανταλλαγ\w*|αλλαγ\w*|Umtausch\w*|cseré\w*|csere|cambi\w*|exchange\w*';
        $txt = preg_replace( '/\b(?:' . $free . ')\s+(' . $exch . ')/iu', '$1', $txt );
        $txt = preg_replace( '/\b(' . $exch . ')\s+(?:' . $free . ')\b/iu', '$1', $txt );
        return preg_replace( '/\s{2,}/u', ' ', $txt );
    }
}

if ( ! function_exists( 'noriks_strip_free' ) ) {
    function noriks_strip_free( $txt ) { return noriks_no_free_exchange( $txt ); }
}

if ( ! function_exists( 'noriks_fix_days' ) ) {
    function noriks_fix_days( $txt ) {
        if ( ! is_string( $txt ) || $txt === '' ) { return $txt; }
        return $txt;
    }
}
