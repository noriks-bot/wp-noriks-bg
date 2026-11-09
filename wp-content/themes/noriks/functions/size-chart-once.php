<?php
/**
 * Tabela velikosti se sme izrisati SAMO enkrat na stran.
 *
 * Prej so jo vkljucevala tri mesta (functions.php, price.php, single_product_mods.php),
 * zato so na kompletih nastali podvojeni ID-ji #custom-size-chart-modal in klik na
 * spodnjo povezavo je odprl obe tabeli hkrati.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'noriks_size_chart_once' ) ) {
    function noriks_size_chart_once() {
        static $done = false;
        if ( $done ) { return; }
        $done = true;
        // NORIKS FIT Woman: zenska tablica po opsegu grudi i struka, ne muska po visini i tezini.
        if ( function_exists( 'noriks_is_type' ) && noriks_is_type( 'kompwom' ) ) {
            get_template_part( 'template_parts/size-chart-kompwom' );
            return;
        }
        // NORIKS Slim: tablica po opsegu struka.
        if ( function_exists( 'noriks_is_type' ) && noriks_is_type( 'slim' ) ) {
            get_template_part( 'template_parts/size-chart-slim' );
            return;
        }
        // NORIKS Tradesman: tablica po broju cipele (EU), muski / zenski.
        if ( function_exists( 'noriks_is_type' ) && noriks_is_type( 'tradesman' ) ) {
            get_template_part( 'template_parts/size-chart-tradesman' );
            return;
        }
        // NORIKS SlabProof: tablica po EU broju obuce (M–XL).
        if ( function_exists( 'noriks_is_type' ) && noriks_is_type( 'slabproof' ) ) {
            get_template_part( 'template_parts/size-chart-slabproof' );
            return;
        }
        // Cloud / Cloth / HYD nemaju velicina — modal s tablicom majica se ne ispisuje.
        if ( function_exists( 'noriks_is_type' ) && ( noriks_is_type( 'cloud' ) || noriks_is_type( 'cloath' ) || noriks_is_type( 'hyd' ) ) ) { return; }
        get_template_part( 'template_parts/size-chart-modal' );
    }
}

if ( ! function_exists( 'noriks_size_chart_secondary_once' ) ) {
    function noriks_size_chart_secondary_once() {
        static $done = false;
        if ( $done ) { return; }
        $done = true;
        get_template_part( 'template_parts/size-chart-secondary' );
    }
}
