<?php
/**
 * ============================================================
 * NORIKS — Central product-type resolver (SK)
 * ------------------------------------------------------------
 * ONE place that decides which product categories map to which
 * "type". Everywhere in the theme use:
 *     noriks_is_type( 'bunion', $id )   // -> bool
 *     noriks_product_type( $id )        // -> string
 *
 * TYPE KEYS are identical across markets so shared templates work
 * unchanged; only the SLUG VALUES are Slovak (+ universal orto-*).
 * ============================================================
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'noriks_product_type_map' ) ) :

function noriks_product_type_map() : array {
    return array(
        // --- primary product types (order = resolution priority) ---
        'starter'   => array( 'startovaci-balicek', 'starter-paketi', 'orto-starter', 'orto-majica-bokserica' ),
        'majice'    => array( 'tricka', 'majice', 'orto-tricka', 'orto-majice' ),
        'bokserice' => array( 'boxerky', 'bokserice', 'orto-boxerky', 'orto-bokserice', 'bokserice-sastavi-paket' ),
        'carape'    => array( 'ponozky', 'orto-kompresijske-carape' ),

        // --- sub-variants / special buckets ---
        'kompresijske-nogavice'   => array( 'ponozky', 'orto-kompresijske-carape' ),
        'ortopas'                 => array( 'orto-ortopas', 'ortopas' ),
        // KneeFix ortopedska steznica za koljeno.
        'kneefix'                 => array( 'orto-kneefix' ),
        // ControlPro trener dna zdjelice (bez atributa).
        'controlpro'              => array( 'orto-controlpro', 'controlpro' ),
        'bunion'                  => array( 'orto-bunion', 'bunion' ),
        'fisiorest'               => array( 'orto-fisiorest', 'fisiorest' ),
        'norikshers'              => array( 'orto-norikshers', 'orto-noriks-hers', 'norikshers' ),
        'leakboxers'              => array( 'orto-leak-boxers', 'leak-boxers' ),
        'kompresijske-majice'     => array( 'orto-kompresijske-majice', 'kompresijske-majice' ),
        'kidsnest'                => array( 'orto-kidsnest', 'kidsnest' ), // detsky vankus pre spravne dychanie

        // ErgoSit orthopedic pillow (ortopedicky vankus na sedenie) — no colour/size, quantity-only bundle.
        'ortopedski-jastuk'       => array( 'orto-ortopedski-jastuk', 'ortopedski-jastuk' ),

        'majica-darila'           => array( 'orto-majica-darila', 'majica-darila' ),
        'majice-bokserice-paketi' => array( 'sady', 'kompleti', 'majice-i-bokserice-paketi' ),
        'black-friday'            => array( 'black-friday' ),
        // Polar NORIKS Cloth — krpa za ciscenje (bez atributa)
        'cloath'                  => array( 'orto-cloath' ),
        // NORIKS Cloud — ortopedski jastuk za koljena (bez atributa)
        'cloud'                   => array( 'orto-cloud' ),
        'red'                     => array( 'orto-red' ),
        'kneeheat'                => array( 'orto-kneeheat' ),
        'pal'                     => array( 'orto-pal' ),
        'bowl'                     => array( 'orto-bowl' ),
        'winecooler'               => array( 'orto-winecooler', 'winecooler' ),
        // NORIKS SlabProof — radne carape s jastucenjem za beton (boja + velicina).
        'slabproof'                => array( 'orto-slabproof', 'slabproof' ),
        // NORIKS Tradesman — radne carape s jastucenjem (boja + velicina).
        'tradesman'                => array( 'orto-tradesman' ),
        // NORIKS Slim — oblikujuce gacice visokog struka (boja + velicina).
        'mamafit'                     => array( 'orto-mamafit' ),
        'slim'                     => array( 'orto-slim', 'slim' ),
        'kompwom'                 => array( 'orto-kompwom' ),
        'snug'                    => array( 'orto-snug' ),
        // NORIKS HYD — boca za vodikovu vodu (bez atributa)
        'hyd'                     => array( 'orto-hyd' ),
        'orto'                    => array( 'orto' ),
    );
}

endif;

if ( ! function_exists( 'noriks_primary_types' ) ) :

function noriks_primary_types() : array {
    return array( 'starter', 'majice', 'bokserice', 'carape' );
}

endif;

if ( ! function_exists( 'noriks_resolve_product_id' ) ) :

function noriks_resolve_product_id( $product_id = null ) : int {
    if ( $product_id ) {
        return (int) $product_id;
    }
    if ( function_exists( 'is_product' ) && is_product() ) {
        return (int) get_queried_object_id();
    }
    return (int) get_the_ID();
}

endif;

if ( ! function_exists( 'noriks_is_type' ) ) :

function noriks_is_type( string $type, $product_id = null ) : bool {
    $map = noriks_product_type_map();
    if ( empty( $map[ $type ] ) ) {
        return false;
    }
    $product_id = noriks_resolve_product_id( $product_id );
    if ( ! $product_id ) {
        return false;
    }
    return has_term( $map[ $type ], 'product_cat', $product_id );
}

endif;

if ( ! function_exists( 'noriks_product_type' ) ) :

function noriks_product_type( $product_id = null ) : string {
    $product_id = noriks_resolve_product_id( $product_id );
    foreach ( noriks_primary_types() as $type ) {
        if ( noriks_is_type( $type, $product_id ) ) {
            return $type;
        }
    }
    return '';
}

endif;

if ( ! function_exists( 'noriks_is_black_friday' ) ) :

function noriks_is_black_friday( $product_id = null ) : bool {
    return noriks_is_type( 'black-friday', $product_id );
}

endif;

if ( ! function_exists( 'noriks_is_mixed_bundle' ) ) :

function noriks_is_mixed_bundle( $product_id = null ) : bool {
    return noriks_is_type( 'black-friday', $product_id )
        || noriks_is_type( 'majice-bokserice-paketi', $product_id )
        || noriks_is_type( 'starter', $product_id );
}

endif;

if ( ! function_exists( 'noriks_slabproof_sizes' ) ) {
    /** NORIKS SlabProof: velicine samo po EU broju obuce, brez crk (Dejan 2.11., isto kot Tradesman). */
    function noriks_slabproof_sizes() {
        return array(
            array( '39–42' ),
            array( '43–45' ),
            array( '46–49' ),
        );
    }
}

if ( ! function_exists( 'noriks_tradesman_sizes' ) ) {
    /** NORIKS Tradesman: velicine samo po EU broju obuce, brez crk (Dejan 2.11., isto kot SlabProof). */
    function noriks_tradesman_sizes() {
        return array(
            array( '39–42' ),
            array( '43–45' ),
            array( '46–49' ),
        );
    }
}

if ( ! function_exists( 'noriks_slim_sizes' ) ) {
    /** NORIKS Slim: velicina, EU velicina, opseg struka — ena tabela za akordeon in modal. */
    function noriks_slim_sizes() {
        return array(
            array( 'XS',  '32 – 34',  '58 – 66 cm' ),
            array( 'S',   '34 – 36',  '67 – 75 cm' ),
            array( 'M',   '38 – 40',  '76 – 83 cm' ),
            array( 'L',   '42 – 44',  '84 – 93 cm' ),
            array( 'XL',  '46 – 48',  '94 – 103 cm' ),
            array( '2XL', '50 – 52',  '104 – 113 cm' ),
            array( '3XL', '54 – 56',  '114 – 126 cm' ),
        );
    }
}

if ( ! function_exists( 'noriks_velikost_oznake' ) ) {
    /**
     * Oznake velicin v izbirniku: crka + EU razpon ali mera ("S - 34 – 36"), brez US/UK.
     * Vrednost atributa ostane gola crka - nanjo visijo cene po velikosti, kosarica in narocila;
     * spremeni se samo prikazano besedilo. Podatki 1:1 s HR (Dejan 26.10.2026, 6.11.2026).
     */
    function noriks_velikost_oznake( $product_id = null ) {
        if ( ! function_exists( 'noriks_is_type' ) ) { return array(); }
        $o = array(
            'sculptleg'    => array( 'XS' => '32 – 34', 'S' => '34 – 36', 'M' => '38 – 40', 'L' => '42 – 44', 'XL' => '46 – 48', '2XL' => '50 – 52', '3XL' => '54 – 56', '4XL' => '58 – 60', '5XL' => '62 – 64' ),
            'mamafit'      => array( 'XS' => '32 – 34', 'S' => '34 – 36', 'M' => '38 – 40', 'L' => '42 – 44', 'XL' => '46 – 48', '2XL' => '50 – 52', '3XL' => '54 – 56' ),
            'gordura'      => array( 'S' => '36 – 38', 'M' => '38 – 40', 'L' => '40 – 42', 'XL' => '42 – 44', '2XL' => '44 – 46', '3XL' => '46 – 48' ),
            'insoles'      => array( 'XS' => '35 – 38', 'S' => '38,5 – 41,5', 'M' => '42 – 44', 'L' => '44,5 – 46,5', 'XL' => '47 – 48' ),
            'smartjacket'  => array( 'XS' => '34 – 36', 'S' => '36 – 38', 'M' => '38 – 40', 'L' => '40 – 42', 'XL' => '44 – 46', '2XL' => '46 – 48', '3XL' => '48 – 50', '4XL' => '50 – 52' ),
            'slim'         => array( 'XS' => '32 – 34', 'S' => '34 – 36', 'M' => '38 – 40', 'L' => '42 – 44', 'XL' => '46 – 48', '2XL' => '50 – 52', '3XL' => '54 – 56', '4XL' => '58 – 60', '5XL' => '62 – 64' ),
            'kompwom'      => array( 'S' => '30 – 34', 'M' => '36 – 38', 'L' => '40 – 42', 'XL' => '44', '2XL' => '46 – 48', '3XL' => '50' ),
            'leakbrief'    => array( 'XS' => '32 – 34', 'S' => '34 – 36', 'M' => '36 – 38', 'L' => '38 – 40', 'XL' => '40 – 42', '2XL' => '42 – 44', '3XL' => '44 – 46', '4XL' => '46 – 48' ),
            'kneewrap'     => array( 'XS' => 'obvod stehna 34,5 – 39 cm', 'S' => 'obvod stehna 39 – 44,5 cm', 'M' => 'obvod stehna 44,5 – 49 cm', 'L' => 'obvod stehna 49 – 53,5 cm', 'XL' => 'obvod stehna 53,5 – 59 cm', 'XXL' => 'obvod stehna 59 – 65,5 cm', 'XXXL' => 'obvod stehna 65,5 – 73,5 cm' ),
            'leggings'     => array( 'XS/S' => '40 – 63 kg', 'M/L' => '59 – 84 kg', 'L/XL' => '79 – 100 kg', '2XL/3XL' => '98 – 136 kg' ),
            'sheer'        => array( 'XS-S' => '30 – 34', 'S-M' => '36 – 38', 'L-XL' => '40 – 42', 'XXL' => '44 – 46' ),
            'tank'         => array( 'S' => 'obvod hrudníka 84 – 89 cm', 'M' => 'obvod hrudníka 89 – 97 cm', 'L' => 'obvod hrudníka 97 – 104 cm', 'XL' => 'obvod hrudníka 104 – 112 cm', '2XL' => 'obvod hrudníka 112 – 119 cm', '3XL' => 'obvod hrudníka 119 – 127 cm', '4XL' => 'obvod hrudníka 127 – 135 cm' ),
            'perfclogs'    => array( 'XS' => '39 – 39,5', 'S' => '40 – 40,5', 'M' => '41 – 42', 'L' => '42,5 – 43', 'XL' => '44 – 44,5', 'XXL' => '45 – 46' ),
            'nyslipper'    => array( 'S' => '36 – 37', 'M' => '38 – 39', 'L' => '40 – 41', 'XL' => '42 – 43' ),
            'gripsocks'    => array( 'XS' => '35 – 38', 'S' => '38,5 – 43', 'M' => '44 – 47', 'L' => '47,5 – 49' ),
            'dryseam'      => array( 'XS' => '32 – 34', 'S' => '34 – 36', 'M' => '36 – 38', 'L' => '38 – 40', 'XL' => '40 – 42', '2XL' => '42 – 44', '3XL' => '44 – 46', '4XL' => '46 – 48' ),
            'slipshort'    => array( 'S' => '34 – 36', 'M' => '38 – 40', 'L' => '40 – 42', 'XL' => '44 – 46', 'XXL' => '46 – 48' ),
            'seamthong'    => array( 'XS' => '30 – 32', 'S' => '32 – 34', 'M' => '34 – 38', 'L' => '38 – 40', 'XL' => '40 – 42' ),
            'kneesleeve'   => array( 'S' => 'obvod stehna 35 – 45 cm', 'M' => 'obvod stehna 46 – 50 cm', 'L' => 'obvod stehna 51 – 57 cm', 'XL' => 'obvod stehna 58 – 63 cm', '2XL' => 'obvod stehna 64 – 69 cm', '3XL' => 'obvod stehna 70 – 75 cm' ),
            'shiftclog'    => array( 'XS' => '36 – 37', 'S' => '38 – 39', 'M' => '40 – 41', 'L' => '42 – 43', 'XL' => '44 – 45', '2XL' => '46 – 47' ),
            'alpakacrew'   => array( 'S' => '35 – 37,5', 'M' => '39 – 42,5', 'L' => '43 – 46', 'XL' => '46,5 – 49,5' ),
            'shapeshorts'  => array( 'XS-S' => '64 – 76 cm', 'M-L' => '77 – 90 cm', 'XL-2XL' => '91 – 112 cm', '3XL' => '112 – 127 cm', '4XL' => '128 – 140 cm' ),
            'utilitypants' => array( 'S' => '78 – 82 cm', 'M' => '82 – 86 cm', 'L' => '86 – 91 cm', 'XL' => '91 – 96 cm', '2XL' => '96 – 102 cm', '3XL' => '102 – 107 cm' ),
            'bratank'      => array( 'S' => '76 – 80 cm', 'M' => '81 – 85 cm', 'L' => '86 – 91 cm', 'XL' => '92 – 97 cm', '2XL' => '98 – 103 cm', '3XL' => '104 – 109 cm', '4XL' => '110 – 115 cm' ),
            'brassiere'    => array( 'XS' => '77 – 83 cm', 'S' => '82 – 88 cm', 'M' => '87 – 93 cm', 'L' => '92 – 98 cm', 'XL' => '97 – 103 cm', '2XL' => '102 – 108 cm', '3XL' => '107 – 113 cm', '4XL' => '112 – 118 cm', '5XL' => '117 – 123 cm' ),
            'hands'        => array( 'S' => '17,8 – 19,1 cm', 'M' => '19,1 – 21,6 cm', 'L' => '21,6 – 22,9 cm' ),
            'celleg'       => array( 'XS' => '56 – 62 cm', 'S' => '62 – 68 cm', 'M' => '68 – 74 cm', 'L' => '74 – 82 cm', 'XL' => '82 – 90 cm', '2XL' => '90 – 98 cm', '3XL' => '98 – 106 cm', '4XL' => '106 – 116 cm', '5XL' => '116 – 126 cm' ),
            'relief'       => array( 'S' => '32 – 40 cm', 'M' => '40 – 48 cm', 'L' => '48 – 54 cm', 'XL' => '54 – 59 cm', '2XL' => '59 – 64 cm', '3XL' => '64 – 72 cm', '4XL' => '72 – 80 cm' ),
            'bra'          => array( 'S' => '65 – 75', 'M' => '65 – 80', 'L' => '75 – 90', 'XL' => '80 – 95', '2XL' => '80 – 100', '3XL' => '90 – 110', '4XL' => '100 – 110' ),
            'classics'     => array( 'XS-S' => '32 – 36', 'M-L' => '38 – 42', 'XL-2XL' => '44 – 48' ),
            'sr'           => array( 'S' => '59 – 68 kg', 'M' => '69 – 84 kg', 'L' => '84 – 95 kg', 'XL' => '96 – 113 kg', '2XL' => '114 – 129 kg', '3XL' => '130 – 150 kg' ),
            'boots'        => array( '37' => 'chodidlo do 22,8 cm', '38' => 'chodidlo do 23,4 cm', '39' => 'chodidlo do 24,0 cm', '40' => 'chodidlo do 24,6 cm', '41' => 'chodidlo do 25,2 cm', '42' => 'chodidlo do 25,8 cm', '43' => 'chodidlo do 26,4 cm', '44' => 'chodidlo do 27,0 cm', '45' => 'chodidlo do 27,6 cm', '46' => 'chodidlo do 28,2 cm', '47' => 'chodidlo do 28,8 cm', '48' => 'chodidlo do 29,4 cm' ),
            'diskret'      => array( 'S' => 'košíky AA – B', 'M' => 'košíky B – F', 'L' => 'košíky F – G' ),
            'buildshirt'   => array( 'XS' => 'do 86 cm', 'S' => '86 – 91 cm', 'M' => '91 – 97 cm', 'L' => '97 – 103 cm', 'XL' => '103 – 108 cm', '2XL' => '108 – 113 cm', '3XL' => '113 – 118 cm', '4XL' => '118 – 126 cm', '5XL' => '126 – 133 cm', '6XL' => '133 – 142 cm' ),
        );
        foreach ( $o as $tip => $m ) {
            if ( noriks_is_type( $tip, $product_id ) ) { return $m; }
        }
        return array();
    }
    function noriks_velikost_oznaka( $val, $product_id = null ) {
        $m = noriks_velikost_oznake( $product_id );
        $k = trim( (string) $val );
        return isset( $m[ $k ] ) ? $k . ' - ' . $m[ $k ] : $val;
    }
}
