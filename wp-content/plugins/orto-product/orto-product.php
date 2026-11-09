
<?php
/*
Plugin Name: Orto Bundle Selector
Description: Custom bundle radio buttons for Orto products (multiple pairs, supports 2 or 4+ custom attributes like 2 colors + 2 sizes).
Version: 3.3
Author: Ante
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ============================================================
// OFFERS (ACF repeater)
// ============================================================

/**
 * Build bundle offers dynamically from ACF repeater _singlepp_orto_pairs.
 * Uses:
 *  - cena_1 = regular price
 *  - cena_2 = sale price (actual price)
 * Also reads:
 *  - p1, p2 (labels for 4-attribute UI headings + cart meta grouping)
 *  - tip (mixed|majica|bokserica|empty) -> controls which selectors appear in 4-attr products
 */
function gck_get_bundle_offers( $product_id = null ) : array {

    if ( ! $product_id ) {
        $product_id = get_the_ID();
    }
    if ( ! $product_id ) {
        return [];
    }

    $rows = get_field('_singlepp_orto_pairs', $product_id);
    if ( empty($rows) || ! is_array($rows) ) {
        return [];
    }

    $offers = [];
    $idx    = 0;

    foreach ( $rows as $row ) {
        $idx++;

        $qty = isset($row['qty']) ? (int) $row['qty'] : 0;
        if ( $qty <= 0 ) continue;

        $tekst1 = trim((string)($row['tekst_1'] ?? ''));
        $title  = trim($tekst1 . ' ');

        $regular = isset($row['cena_1']) ? (float) $row['cena_1'] : 0;
        $sale    = isset($row['cena_2']) ? (float) $row['cena_2'] : 0;
        if ( $sale <= 0 ) continue;

        $saving_amount = $regular - $sale;
        $saving_text   = "Celková úspora " . number_format($saving_amount, 2, '.', '') . "€";

        $p1  = trim((string)($row['p1'] ?? ''));
        $p2  = trim((string)($row['p2'] ?? ''));
        $tip = trim((string)($row['tip'] ?? '')); // NEW

        // unique offer id per row
        $offer_id = $qty . '__' . $idx;

        // qty=1 exact
        if ( $qty === 1 ) {
            $offers[$offer_id] = [
                "id"     => $offer_id,
                "qty"    => $qty,
                "title"  => $title,
                "per"    => number_format($sale, 2, '.', ''),
                "total"  => number_format($sale, 2, '.', ''),
                "regular" => number_format($regular, 2, '.', ''), // cena_1
                "saving" => $saving_text,
                "p1"     => $p1,
                "p2"     => $p2,
                "tip"    => $tip,
            ];
            continue;
        }

        // multi-item: floor down per item to 2 decimals
        $per_item       = $sale / $qty;
        $per_item_fixed = floor($per_item * 100) / 100;

        $offers[$offer_id] = [
            "id"     => $offer_id,
            "qty"    => $qty,
            "title"  => $title,
            "per"    => number_format($per_item_fixed, 2, '.', ''),
            "total"  => number_format($sale, 2, '.', ''),
            "regular" => number_format($regular, 2, '.', ''), // cena_1
            "saving" => $saving_text,
            "p1"     => $p1,
            "p2"     => $p2,
            "tip"    => $tip,
        ];
    }

    return $offers;
}

function gck_is_orto_bundle_enabled( $product_id ) : bool {
    if ( ! $product_id ) return false;
    $flag = get_post_meta( $product_id, '_singlepp_orto_ison', true );
    return ! empty( $flag );
}

// ============================================================
// ATTRIBUTE HELPERS (supports 2 attrs OR 4 attrs)
// ============================================================

function gck_get_custom_attributes_in_order( $product ) : array {
    $attributes   = $product->get_attributes();
    $custom_attrs = [];

    foreach ( $attributes as $key => $attr ) {
        if ( $attr && ! $attr->is_taxonomy() ) {
            $custom_attrs[ $key ] = $attr;
        }
    }
    return $custom_attrs;
}

function gck_split_attrs_color_size( array $custom_attrs ) : array {
    $colors = [];
    $sizes  = [];
    $others = [];

    foreach ( $custom_attrs as $key => $attr ) {
        $label = method_exists($attr, 'get_name') ? (string) $attr->get_name() : (string) $key;

        $hay = strtolower( $key . ' ' . $label );

        $is_color = ( strpos($hay, 'strana') !== false || strpos($hay, 'boja') !== false || strpos($hay, 'barva') !== false || strpos($hay, 'farb') !== false || strpos($hay, 'culoare') !== false || strpos($hay, 'color') !== false || strpos($hay, 'colour') !== false || strpos($hay, 'colore') !== false || strpos($hay, 'kolor') !== false || strpos($hay, 'szín') !== false || strpos($hay, 'szin') !== false || strpos($hay, 'ρώμ') !== false || strpos($hay, 'цвят') !== false );
        $is_size = ( strpos($hay, 'veľkos') !== false || strpos($hay, 'velkos') !== false || strpos($hay, 'vel') !== false || strpos($hay, 'size') !== false || strpos($hay, 'marime') !== false || strpos($hay, 'mărime') !== false || strpos($hay, 'rozmiar') !== false || strpos($hay, 'taglia') !== false || strpos($hay, 'größe') !== false || strpos($hay, 'grosse') !== false || strpos($hay, 'groesse') !== false || strpos($hay, 'meret') !== false || strpos($hay, 'méret') !== false || strpos($hay, 'εγεθ') !== false || strpos($hay, 'азмер') !== false || strpos($hay, 'размер') !== false );

        $values = $attr->get_options();
        if ( ! is_array($values) ) $values = [];

        $item = [
            'key'       => $key,
            'label'     => $label,
            'field_key' => 'attribute_' . $key,
            'values'    => $values,
        ];

        if ( $is_color && ! $is_size ) {
            $colors[] = $item;
        } elseif ( $is_size && ! $is_color ) {
            $sizes[] = $item;
        } else {
            $others[] = $item;
        }
    }

    // fallback to old behavior if not detected
    if ( empty($colors) && empty($sizes) && count($custom_attrs) >= 2 ) {
        $keys = array_keys($custom_attrs);

        $first  = $custom_attrs[$keys[0]];
        $second = $custom_attrs[$keys[1]];

        $colors[] = [
            'key'       => $keys[0],
            'label'     => (string) $first->get_name(),
            'field_key' => 'attribute_' . $keys[0],
            'values'    => (array) $first->get_options(),
        ];
        $sizes[] = [
            'key'       => $keys[1],
            'label'     => (string) $second->get_name(),
            'field_key' => 'attribute_' . $keys[1],
            'values'    => (array) $second->get_options(),
        ];

        for ( $i = 2; $i < count($keys); $i++ ) {
            $a = $custom_attrs[$keys[$i]];
            $others[] = [
                'key'       => $keys[$i],
                'label'     => (string) $a->get_name(),
                'field_key' => 'attribute_' . $keys[$i],
                'values'    => (array) $a->get_options(),
            ];
        }
    }

    return [
        'colors' => $colors,
        'sizes'  => $sizes,
        'others' => $others,
    ];
}

function gck_attr_group_token( string $label, string $type ) : string {
    $l = strtolower( trim( $label ) );

    if ( $type === 'color' ) {
        $l = str_replace(['farba', 'color', 'colour', ':'], ' ', $l);
    } else {
        $l = str_replace(['Veľkosť', 'velkost', 'velkost', 'veľkosť', ':'], ' ', $l);
    }

    $l = trim( preg_replace('/\s+/', ' ', $l) );
    return sanitize_title( $l );
}

/**
 * Pair color + size into logical rows:
 * Prefer matching tokens, fallback by index.
 */
function gck_pair_color_size_groups( array $colors, array $sizes ) : array {
    $groups = [];

    $sizes_by_token = [];
    $sizes_used     = [];

    foreach ( $sizes as $i => $s ) {
        $tok = gck_attr_group_token( (string)($s['label'] ?? ''), 'size' );
        if ( $tok !== '' ) {
            $sizes_by_token[$tok][] = $i;
        }
    }

    foreach ( $colors as $ci => $c ) {
        $ctok = gck_attr_group_token( (string)($c['label'] ?? ''), 'color' );

        $matched_si = null;

        if ( $ctok !== '' && ! empty($sizes_by_token[$ctok]) ) {
            foreach ( $sizes_by_token[$ctok] as $candidate_si ) {
                if ( empty($sizes_used[$candidate_si]) ) {
                    $matched_si = $candidate_si;
                    break;
                }
            }
        }

        if ( $matched_si === null && isset($sizes[$ci]) && empty($sizes_used[$ci]) ) {
            $matched_si = $ci;
        }

        if ( $matched_si === null ) {
            foreach ( $sizes as $si => $_s ) {
                if ( empty($sizes_used[$si]) ) {
                    $matched_si = $si;
                    break;
                }
            }
        }

        $size_item = null;
        if ( $matched_si !== null && isset($sizes[$matched_si]) ) {
            $size_item = $sizes[$matched_si];
            $sizes_used[$matched_si] = true;
        }

        $groups[] = [
            'token' => $ctok,
            'color' => $c,
            'size'  => $size_item,
        ];
    }

    foreach ( $sizes as $si => $s ) {
        if ( empty($sizes_used[$si]) ) {
            $stok = gck_attr_group_token( (string)($s['label'] ?? ''), 'size' );
            $groups[] = [
                'token' => $stok,
                'color' => null,
                'size'  => $s,
            ];
        }
    }

    return $groups;
}

// ============================================================
// RENDER UI
// ============================================================

// ============================================================
// COUNTDOWN / SCARCITY FIELDS (registered in code)
// ============================================================
add_action( 'acf/init', 'gck_register_orto_countdown_fields' );
function gck_register_orto_countdown_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }
    acf_add_local_field_group( array(
        'key'    => 'group_orto_countdown_options',
        'title'  => 'Orto Bundle – countdown',
        'fields' => array(
            array(
                'key'          => 'field_orto_precheck_second',
                'label'        => 'Pre-check 2nd offer by default',
                'name'         => 'orto_precheck_second',
                'type'         => 'true_false',
                'instructions' => 'If enabled, the SECOND offer is pre-selected on page load instead of the first. Applies only to this product.',
                'ui'           => 1,
            ),
            array(
                'key'          => 'field_orto_show_gratis_labels',
                'label'        => 'Show "free t-shirt" section labels',
                'name'         => 'orto_show_gratis_labels',
                'type'         => 'true_false',
                'instructions' => 'Adds section labels above the color/size selectors. The number of free pieces is parsed from the offer title, e.g. "2+2".',
                'ui'           => 1,
            ),
            array(
                'key'          => 'field_orto_alt_dropdowns',
                'label'        => 'Alternativni izbornici (Veličina + Boja kao dropdown)',
                'name'         => 'orto_alt_dropdowns',
                'type'         => 'true_false',
                'instructions' => 'Umjesto trake krugova s bojama prikazuje dva prilagođena izbornika: prvo VELIČINA, zatim BOJA (s uzorkom boje uz svaki naziv). Vrijedi samo za ovaj proizvod.',
                'ui'           => 1,
            ),
            array(
                'key'          => 'field_orto_show_price_highlights',
                'label'        => 'Show price highlights (price/pc + discount)',
                'name'         => 'orto_show_price_highlights',
                'type'         => 'true_false',
                'instructions' => 'Adds a per-piece price chip (struck-through regular price/pc) and a green discount badge on each offer. Applies only to this product.',
                'ui'           => 1,
            ),
            array(
                'key'          => 'field_orto_show_countdown',
                'label'        => 'Show countdown (scarcity bar)',
                'name'         => 'orto_show_countdown',
                'type'         => 'true_false',
                'instructions' => 'Shows a scarcity/urgency bar with an evergreen per-visitor countdown above the offers. Applies only to this product.',
                'ui'           => 1,
            ),
            array(
                'key'               => 'field_orto_countdown_minutes',
                'label'             => 'Countdown duration (minutes)',
                'name'              => 'orto_countdown_minutes',
                'type'              => 'number',
                'instructions'      => 'How many minutes the countdown runs per visitor. Default 10. Resets discreetly on the next visit once it expires.',
                'default_value'     => 10,
                'min'               => 1,
                'max'               => 1440,
                'append'            => 'min',
                'conditional_logic' => array(
                    array(
                        array( 'field' => 'field_orto_show_countdown', 'operator' => '==', 'value' => '1' ),
                    ),
                ),
            ),
            array(
                'key'               => 'field_orto_countdown_stock',
                'label'             => 'Remaining stock (pieces)',
                'name'              => 'orto_countdown_stock',
                'type'              => 'number',
                'instructions'      => 'Number shown in the bar ("Only X left"). Set 0 or leave empty to hide it.',
                'default_value'     => 27,
                'min'               => 0,
                'max'               => 9999,
                'append'            => 'pcs',
                'conditional_logic' => array(
                    array(
                        array( 'field' => 'field_orto_show_countdown', 'operator' => '==', 'value' => '1' ),
                    ),
                ),
            ),
        ),
        'location'   => array(
            array(
                array( 'param' => 'post_type', 'operator' => '==', 'value' => 'product' ),
            ),
        ),
        'menu_order' => 0,
        'position'   => 'normal',
        'style'      => 'default',
        'active'     => true,
    ) );
}

function gck_sk_majice_phrase( int $n, bool $free = false, string $type = 'majica' ) : string {
    if ( $type === 'steznica' ) {
        $m100 = $n % 100;
        if ( $n === 1 ) { $noun = 'ortézu'; }
        elseif ( in_array( $n % 10, array( 2, 3, 4 ), true ) && ! in_array( $m100, array( 12, 13, 14 ), true ) ) { $noun = 'ortézy'; }
        else { $noun = 'ortéz'; }
        return $free ? ( $noun . ' zadarmo' ) : $noun;
    }
    $m100  = $n % 100;
    $is1   = ( $n === 1 );
    $is234 = ( in_array( $n % 10, array( 2, 3, 4 ), true ) && ! in_array( $m100, array( 12, 13, 14 ), true ) );

    if ( $type === 'bokserica' ) {
        $noun = ( $is1 || $is234 ) ? 'boxerky' : 'boxeriek';
    } elseif ( $type === 'carapa' ) {
        // Compression socks: sock noun, never the shirt one.
        $noun = ( $is1 || $is234 ) ? 'ponožky' : 'ponožiek';
    } else {
        if ( $is1 ) {
            $noun = 'tričko';
        } elseif ( $is234 ) {
            $noun = 'trička';
        } else {
            $noun = 'tričiek';
        }
    }
    return $free ? ( $noun . ' zadarmo' ) : $noun;
}



add_action( 'woocommerce_before_add_to_cart_button', 'gck_render_bundle_selector', 5 );

function gck_render_bundle_selector() {

    global $product;

    if ( ! is_product() || ! $product || ! gck_is_orto_bundle_enabled( $product->get_id() ) ) return;

    $product_id = $product->get_id();

    $offers = gck_get_bundle_offers( $product_id );
    if ( empty( $offers ) ) return;

    // Countdown / scarcity element (registered in code, per-product toggle).
    $precheck_second       = (bool) get_field( 'orto_precheck_second', $product_id );
    $show_gratis           = (bool) get_field( 'orto_show_gratis_labels', $product_id );
    $show_price_highlights = (bool) get_field( 'orto_show_price_highlights', $product_id );
    // Alternativni izbornici (Velicina + Boja kao dropdown) — ukljucuje se po proizvodu.
    $gck_alt_dropdowns     = function_exists( 'get_field' )
        ? (bool) get_field( 'orto_alt_dropdowns', $product_id )
        : (bool) get_post_meta( $product_id, 'orto_alt_dropdowns', true );

    // Garment type for gratis labels: "bokserica" (boxers), "carapa"
    // (compression socks) vs default "majica" (t-shirt).
    $gck_garment = 'majica';
    if (
        has_term( array( 'orto-bokserice', 'orto-bokserice2' ), 'product_cat', $product_id )
        || ( stripos( (string) $product->get_slug(), 'bokseric' ) !== false )
        || ( stripos( (string) $product->get_name(), 'bokseric' ) !== false )
    ) {
        $gck_garment = 'bokserica';
    } elseif (
        has_term( array( 'orto-kompresijske-carape' ), 'product_cat', $product_id )
        || ( stripos( (string) $product->get_slug(), 'ponozk' ) !== false )
        || ( stripos( (string) $product->get_slug(), 'carap' ) !== false )
        || ( stripos( (string) $product->get_name(), 'ponožk' ) !== false )
        || ( stripos( (string) $product->get_name(), 'čarap' ) !== false )
    ) {
        // Compression SOCKS only. Note: the compression TRIČKO (orto-kompresijske-majice)
        // must NOT match here — it keeps the default "majica" noun.
        $gck_garment = 'carapa';
    } elseif (
        has_term( array( 'orto-kneefix' ), 'product_cat', $product_id )
        || ( stripos( (string) $product->get_slug(), 'kneefix' ) !== false )
        || ( stripos( (string) $product->get_name(), 'kneefix' ) !== false )
    ) {
        // KneeFix je steznica za koljeno, ne majica.
        $gck_garment = 'steznica';
    }

    $show_countdown    = (bool) get_field( 'orto_show_countdown', $product_id );
    $countdown_minutes = (int) get_field( 'orto_countdown_minutes', $product_id );
    if ( $countdown_minutes < 1 || $countdown_minutes > 1440 ) {
        $countdown_minutes = 10;
    }
    $countdown_stock = (int) get_field( 'orto_countdown_stock', $product_id );
    if ( $countdown_stock < 0 ) {
        $countdown_stock = 0;
    }

    $custom_attrs = gck_get_custom_attributes_in_order( $product );

    // Special orto products that don't use the standard colour + size selectors:
    //  - orto-bunion / orto-fisiorest : quantity-only bundle, NO colour and NO size selectors.
    //  - orto-ortopas                 : single "Veľkosť" attribute, no colour (size selector only).
    // Podnaslov ponudbe in kartus nad kartico — samo Polar NORIKS Cloth in Cloud.
    if ( has_term( array( 'orto-cloath' ), 'product_cat', $product_id ) ) {
        $gck_offer_subs = array( 'Set do kúpeľne', 'Balík pre celý dom', 'Balík pre rodinu a priateľov' );
    } else {
        $gck_offer_subs = array();
    }
    $gck_offer_badges = has_term( array( 'orto-cloath', 'orto-cloud' ), 'product_cat', $product_id )
        ? array( 1 => 'NAJPREDÁVANEJŠIE', 2 => 'NAJLEPŠIA CENA' )
        : array();
    $gck_no_attrs    = has_term( array( 'orto-red', 'orto-kneeheat', 'orto-pal', 'orto-bowl', 'orto-winecooler', 'orto-cloath', 'orto-hyd', 'orto-cloud', 'orto-controlpro', 'orto-bunion', 'orto-fisiorest', 'orto-norikshers', 'orto-noriks-hers', 'orto-ortopedski-jastuk' ), 'product_cat', $product_id );
    $gck_single_size = has_term( array( 'orto-ortopas', 'orto-kidsnest' ), 'product_cat', $product_id );
    // Samo boja (brez velicine): NORIKS Snug — sicer bi pogoj "manj kot dve lastnosti" izbirnik zavrnil.
    $gck_single_color = has_term( array( 'orto-snug' ), 'product_cat', $product_id );

    // SHGIFTS (orto-majica-darila): the SAME split-garment selector as SHBOX,
    // extended to 3 garment groups (4 tričko + 1 boxerky + 1 ponožky). Gated
    // strictly to this category. This site's save/sync collapses product
    // attributes to a single Farba/Veľkosť, so the 3 groups' colour/size options
    // are sourced from hardcoded arrays fed into the EXACT SHBOX swatch/select
    // markup + CSS (see the render branch below). Detected early and bypasses the
    // attribute guards so it always renders regardless of product attributes.
    $gck_shgifts = has_term( 'orto-majica-darila', 'product_cat', $product_id );

    // KneeFix: dva izbornika (Velicina + Stranica) umjesto swatcheva boje.
    $gck_side_select = has_term( 'orto-kneefix', 'product_cat', $product_id );

    if ( ! $gck_no_attrs && ! $gck_single_size && ! $gck_single_color && ! $gck_shgifts && count( $custom_attrs ) < 2 ) return;

    $split  = gck_split_attrs_color_size( $custom_attrs );
    $colors = $split['colors'];
    $sizes  = $split['sizes'];

    // KneeFix (dva izbornika): ne oslanjaj se na prepoznavanje naziva atributa.
    // Ako je uključen side-select, a podjela nije uspjela, uzmi redom:
    // prvi atribut = veličina, drugi = strana. Radi na svim tržištima bez obzira na jezik.
    if ( $gck_side_select && ( empty($colors) || empty($sizes) ) && count($custom_attrs) >= 2 ) {
        $vals = array_values( $split['colors'] );
        $all  = array();
        foreach ( $custom_attrs as $k => $a ) {
            $all[] = array(
                'key'       => $k,
                'label'     => method_exists($a,'get_name') ? (string) $a->get_name() : (string) $k,
                'field_key' => 'attribute_' . $k,
                'values'    => is_array($a->get_options()) ? $a->get_options() : array(),
            );
        }
        $sizes  = array( $all[0] );
        $colors = array( $all[1] );
    }

    if ( $gck_single_color ) {

        // Samo boja, prikazana kot krogci (brez selecta) — NORIKS Snug.

        $sizes = array();

        if ( empty( $colors ) && ! empty( $custom_attrs ) ) {

            $k = array_key_first( $custom_attrs );

            $a = $custom_attrs[ $k ];

            $colors = array( array( 'key' => $k, 'label' => (string) $a->get_name(),

                                    'field_key' => 'attribute_' . $k, 'values' => (array) $a->get_options() ) );

        }

    } elseif ( $gck_no_attrs ) {
        $colors = array();
        $sizes  = array();
    } elseif ( $gck_single_size ) {
        if ( empty($sizes) ) return;
    } elseif ( ! $gck_shgifts ) {
        if ( empty($colors) || empty($sizes) ) return;
    }

    $attr_groups = gck_pair_color_size_groups( $colors, $sizes );

    // "4-attribute case" in your implementation means we have 2 selector groups (majica + bokserica)
    $show_group_titles = ( count($attr_groups) > 1 );
    $gck_split_garments = ( strtoupper( (string) $product->get_sku() ) === 'NORIKS-ORTO-SHBOX' && count( $attr_groups ) >= 2 );

    ?>
    <style>
      .single_add_to_cart_button {
          font-family: 'Roboto', sans-serif;
          height: 60px;
          width: 100%;
          background: #c00 !important;
          letter-spacing: -0.5px !important;
          border-radius: 8px;
          font-size: 17px !important;
          letter-spacing: 0.2px !important;
          color: white;
          text-transform: uppercase  !important;
      }
      body.single-product .quantity { display: none; }

      .bundle-box { margin: 0 0 15px 0 }
      .bundle-option {
         display: block;
         border: 2px solid #939393;
         background: #f4f4f4b0;
         border-radius: 8px;
         padding: 10px 5px 10px 15px;
         margin-bottom: 12px;
         cursor: pointer;
         position: relative;
         box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
      }
      .bundle-option-title {
          font-weight: 600;
          color: black;
          letter-spacing: 0.3px;
      }
      .bundle-option.active { border-color: #f39c12; background: #f39c1217; }
      .bundle-pairs { margin-top: 10px; padding-top: 10px; border-top: 1px solid #969696; }

      .bundle-pair { display: flex; flex-direction: column; gap: 8px; margin-bottom: 12px; }
      .bundle-attr-row{ display: flex; align-items: center; flex-wrap: wrap; gap: 8px; }

      .gck-group-title{
          width: 100%;
          font-weight: 800;
          font-size: 14px;
          color: #111;
          margin: 2px 0 0 0;
          letter-spacing: .2px;
      }

      .gck-pair-label{
          width: 100%;
          font-weight: 800;
          font-size: 15px;
          color: #111;
          margin: 2px 0 5px 0;
          letter-spacing: .2px;
          line-height: 1.2;
      }
      .gck-pair-label.is-gratis{ color: #c00; margin-top: 12px; }

      .gck-per-chip{
          display: inline-flex;
          align-items: center;
          gap: 6px;
          background: #c00;
          border-radius: 4px;
          padding: 6px 9px;
          margin-left: 4px;
          font-size: 14px;
          font-weight: 600;
          line-height: 1;
          vertical-align: middle;
      }
      .gck-per-old{ color: rgba(255,255,255,0.85); text-decoration: line-through; font-weight: 600; }
      .gck-per-new{ color: #fff; font-weight: 800; }
      .gck-discount-badge{
          display: inline-flex;
          align-items: center;
          margin-left: 6px;
          background: #2e7d32;
          color: #fff;
          font-size: 13px;
          font-weight: 800;
          padding: 6px 9px;
          border-radius: 4px;
          line-height: 1;
          vertical-align: middle;
      }
      .gck-hl-break{ display: none; }

      .bundle-total-line { margin-top: 0px; text-align: right; font-weight: 600; color: black; }
      small { color: black; }

      .hidden { visibility: hidden !important; height: 0 !important; overflow: hidden !important; opacity: 0 !important; pointer-events: none !important; display: none; }

      .color-swatches { display: flex; gap: 2px; align-items: center; }
      .color-swatches .swatch {
          width: 33px; height: 34px;
          border-radius: 4px;
          border: 2px solid #ddd;
          cursor: pointer;
          display: flex;
          justify-content: center;
          align-items: center;
          transition: all .15s;
      }
      .color-swatches .swatch.active { border-color: #ff6d2e; transform: scale(1.08); }
      .swatch-circle { width: 27px; height: 27px; border-radius: 50%; }

      .color-black, .color-cierna { background: #000; } .color-crna { background: #000; }
      .color-blue  { background: #203240; } .color-modra { background: #203240; } .color-plava { background: #203240; }
      .color-green  { background: #294d3b; } .color-zelena { background: #294d3b; }
      .color-gray { background: #706d78; } .color-siva { background: #706d78; }
      .color-crvena, .color-cervena { background: #ba212f; }
      .color-white { background: #fff; border: 1px solid #ccc; }
      .color-bela, .color-biela  { background: #fff; border: 1px solid #ccc; }
      .color-bijela{ background: #fff; border: 1px solid #ccc; }
      .color-bez,  .color-bezova{ background: #e4e0cf; }
      .color-smeda, .color-hneda { background: #9f6f4e; }
      .color-zelena { background: #65633c; }
      .color-tamnoplava, .color-tmave-modra { background: #2a3262; }

      .bundle-option input[type="radio"] {
          -webkit-appearance: none;
          appearance: none;
          margin: -2px 2px 0 2px;
          width: 16px; height: 16px;
          border-radius: 50%;
          border: 2px solid #ff6d2e;
          background: #fff;
          position: relative;
          cursor: pointer;
          vertical-align: middle;
          outline: none;
          box-shadow: none;
          accent-color: initial;
      }
      .bundle-option input[type="radio"]::before {
          content: '';
          position: absolute;
          inset: 3px;
          border-radius: 50%;
          background: #ff6d2e;
          transform: scale(0);
          transition: transform 0.15s ease;
      }
      .bundle-option input[type="radio"]:checked::before { transform: scale(1); }

      .bundle-box select {
          flex: 0 0 auto;
          max-width: 150px;
          min-width: 69px;
          padding: 1px 10px;
          border-radius: 4px;
          border: 2px solid #ff6d2e;
          background: #ffffff;
          font-size: 18px;
          font-weight: 600;
          color: #333;
          appearance: none;
          background-image: linear-gradient(45deg, transparent 50%, #444 50%),
                            linear-gradient(135deg, #444 50%, transparent 50%);
          background-position: calc(100% - 13px) 50%, calc(100% - 8px) 50%;
          background-size: 6px 6px, 6px 6px;
          background-repeat: no-repeat;
          margin-left: -2px;
      }

      .gck-popular-badge,
      .gck-popular-badge-2 {
          

        display: none !important;
                          
                  
          transform: rotate(3deg);
          position: absolute;
          top: -18px;
          right: -15px;
          background: #000;
          color: #fff;
          font-size: 13px;
          padding: 3px 17px;
          border-radius: 8px;
          font-weight: 600;
          z-index: 10;
          box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
          white-space: nowrap;
      }

      .gck-top-banner-wrap { margin-bottom: 0px; }
      .gck-divider { display:flex; align-items:center; justify-content:center; margin: 8px 0 4px; }
      .gck-divider span { font-size: 15px; font-weight: 600; color: black; padding: 0 12px; text-transform: uppercase; }
      .gck-divider:before, .gck-divider:after { content:""; flex:1; height:2px; background:#f39c12; max-width:400px; }

      .gck-timer-bar { background: #f39c12; color: #fff; padding: 4px 14px; border-radius: 4px; text-align: center; font-weight: 600; font-size: 15px; }
      .gck-benefits-box { margin-top:-15px; color: #000; }
      .gck-benefits-list { list-style:none; margin:0 0 8px; padding:0; margin-top:-25px !important; }
      .gck-benefits-list li { font-size:15px; line-height:1.6; margin:0 0 4px; display:flex; align-items:flex-start; }
      .gck-check { margin-right:6px; font-size:14px; }

      .gck-size-link {
          display: inline-flex;
          align-items: center;
          font-size: 14px;
          text-decoration: underline;
          color: #000;
          margin-left: -5px;
          font-weight: bold;
          text-transform: uppercase;
          margin-top: 10px;
      }
      .features { display: none !important; }
      
      
      
      @media (max-width: 490px) {
         .gck-divider span { 
             }
         
      }
      
      
      @media (max-width: 767px) {
          .gck-pair-label { font-size: 14px; margin: 1px 0 4px 0; }
          .gck-pair-label.is-gratis { margin-top: 8px; }
          .gck-hl-break { display: block; }
          .gck-per-chip { margin-left: 0; margin-top: 4px; }
          .gck-discount-badge { margin-top: 4px; margin-left: 6px; }
      }

      .gck-regular-price{
  color:#c00;
  text-decoration: line-through;
  font-weight:700;
  margin-right:6px;
}
    </style>
    
    
    
    

    <?php
    // Your extra conditional style block (kept)
    if (  !has_term( array( 'orto-red', 'orto-kneeheat', 'orto-pal', 'orto-bowl', 'orto-winecooler', 'orto-slabproof', 'orto-tradesman', 'orto-kompwom', 'orto-slim', 'orto-snug', 'orto-cloath', 'orto-hyd', 'orto-cloud', 'orto-starter', 'orto-majice', 'orto-bokserice', 'orto-kompresijske-carape', 'orto-ortopas', 'orto-kneefix', 'orto-controlpro', 'orto-bunion', 'orto-fisiorest', 'orto-norikshers', 'orto-noriks-hers', 'orto-majica-darila', 'orto-leak-boxers', 'orto-kompresijske-majice', 'orto-ortopedski-jastuk', 'orto-kidsnest' ), 'product_cat', $product_id )  )   :
    ?>
        <style>
          .bundle-option { border: 2px solid #ededed; background: #f4f4f4b0  !important; border-radius: 4px; }
          .bundle-option.active { border-color: #969696 !important;  background: #62626217  !important; border: none !important; }
          .color-swatches .swatch.active { border-color: black  !important; }
          .bundle-box select { border: 2px solid black !important; }
        </style>
    <?php endif; ?>

    <?php
    // SHGIFTS: the ponožky size labels ("39-43" …) are wider than shirt/boxer sizes,
    // so widen just that one size-select so the value isn't clipped/overlapped.
    if ( $gck_shgifts ) :
    ?>
        <style>
          #bundle-selector .gck-size-select[data-size-key="carapa_size"] {
              max-width: 130px !important;
              min-width: 96px !important;
              padding-right: 26px !important;
          }
        </style>
    <?php endif; ?>

    <?php if ( has_term( array( 'orto-kompresijske-carape' ), 'product_cat', $product_id ) ) : // wider size select for compression socks ?>
        <style>
          .bundle-box select { max-width: 195px !important; min-width: 92px !important; padding-right: 26px !important; }
        </style>
    <?php endif; ?>
    
    
    
        <?php
    // Your extra conditional style block (kept)
    if (  has_term( array( 'orto-starter'), 'product_cat', $product_id )  )   :
    ?>
        <style>
          
          
            .price ins {
                   
                   font-size: 25px !important;
                   font-weight: bold;
               
               }
               
                 .price del {
                   
                   font-size: 25px !important;
               
               }
               
               .price-badge {
                   
                   font-size: 17px !important;
                   margin-top: -7px !important;
               }
               
               
                  .gck-divider span {
        font-size: 17px;
        font-weight: 600;
        color: black;
        padding: 0 12px;
        text-transform: uppercase;
        letter-spacing: -0.2px;
        text-align: center !important;
        line-height: 1.3;
    }
          
           @media (max-width: 991px) {
               
               
                   .gck-divider span {
        font-size: 17px;
        font-weight: 600;
        color: black;
        padding: 0 12px;
        text-transform: uppercase;
        letter-spacing: -0.2px;
        text-align: center !important;
        line-height: 1.3;
    }
               
               #title-buy-now  {
                       font-size: 35px !important;
                       letter-spacing: 0.1px !important;
               
               }
               
               
               
             
               
           }
          
           @media (min-width: 992px) {
               .why-section img {
               
               float: right;
               max-width: 70%;
               }
               
               .why-content{
               
               padding-right: 30px;
               
               }
           }
          
        </style>
    <?php endif; ?>
    
    

    <div class="gck-benefits-box">
        <?php if ( ! has_term( array( 'orto-red', 'orto-kneeheat', 'orto-pal', 'orto-bowl', 'orto-winecooler', 'orto-slabproof', 'orto-tradesman', 'orto-kompwom', 'orto-slim', 'orto-snug', 'orto-cloath', 'orto-hyd', 'orto-cloud', 'orto-ortopas', 'orto-kneefix', 'orto-controlpro', 'orto-bunion', 'orto-fisiorest', 'orto-norikshers', 'orto-noriks-hers', 'orto-leak-boxers', 'orto-kompresijske-majice', 'orto-ortopedski-jastuk', 'orto-kidsnest' ), 'product_cat', $product_id ) ) : // hide benefits list for back belt + bunion + fisiorest + leak boxers + kompresijske majice + orthopedic pillow + kidsnest ?>
        <ul class="gck-benefits-list">
            <?php if ( !has_term( array( 'orto-bokserice', 'orto-bokserice2', 'starter-paketi' ), 'product_cat', $product_id ) ) : ?>
                <li><span class="gck-check">✔</span> <strong>Perfektné padnutie</strong></li>
            <?php endif; ?>

            <li><strong>✔ Prémiové materiály</strong></li>
            <li><strong>✔ Pohodlie bez kompromisov</strong></li>

            <?php if ( has_term( array( 'orto-starter' ), 'product_cat', $product_id ) ) : ?>
                <li style="color: #c00;"><strong>✔ Štartovací balíček je k dispozícii iba raz na osobuv</strong></li>
                <li style="color: #c00;"><strong>✔ Limitované na 1.000 balení </strong></li>
            <?php endif; ?>
        </ul>
        <?php endif; ?>

        <?php if ( ! $show_countdown && ! $gck_no_attrs && ! $gck_single_size && ! has_term( array( 'orto-red', 'orto-kneeheat', 'orto-pal', 'orto-bowl', 'orto-winecooler', 'orto-snug', 'orto-kneefix', 'orto-controlpro', 'orto-leak-boxers', 'orto-kompresijske-majice' ), 'product_cat', $product_id ) ) : ?>
        <a id="open-size-chartCustom" href="#size-chart" class="gck-size-link">
            <svg style="margin-right: 5px; width: 23px; height: 23px; display: inline-block; vertical-align: middle;" xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
                <path d="M11.4124 2.58464L2.08525 11.9118C1.86558 12.1315 1.86558 12.4876 2.08525 12.7073L5.78977 16.4118C6.00944 16.6315 6.3656 16.6315 6.58527 16.4118L15.9124 7.08466C16.1321 6.86499 16.1321 6.50883 15.9124 6.28916L12.2079 2.58464C11.9883 2.36497 11.6321 2.36497 11.4124 2.58464Z" stroke="#111213" stroke-width="0.84375"></path>
                <path d="M9.28125 4.71875L11.5312 6.96875M6.75 7.25L9 9.5M4.21875 9.78125L6.46875 12.0312" stroke="#111213" stroke-width="0.84375"></path>
            </svg>
            Tabuľky veľkostí
        </a>
        <?php endif; ?>
    </div>

    <div class="gck-top-banner-wrap">
        <?php if ( has_term( array( 'orto-starter' ), 'product_cat', $product_id ) ) : ?>
            <!-- divider/timer removed in your current code -->
            
            <div class="gck-divider">
           <!-- <span>Više komada, veća ušteda!</span>-->
           <span>Uzmite svoj ekskluzivni<br/> starter paket</span>
        </div>
        
        
        <?php endif; ?>
    </div>

    <?php if ( has_term( array( 'orto-starter' ), 'product_cat', $product_id ) ) : ?>
        <div class="dev-banner" data-total="1000" data-sold="354">
            <div class="dev-banner__text">
                <span class="dev-banner__icon">📦</span>
                <span>Obmedzené množstvo <b class="sold">0</b> / <b class="total">0</b> (Ešte <b class="remain">0</b> kusov)</span>
            </div>
            <div class="dev-banner__bar" aria-label="Sales progress">
                <div class="dev-banner__fill"></div>
            </div>
        </div>
    <?php elseif ( ! $show_countdown ) : ?>
        <div style="height: 10px;"></div>
    <?php endif; ?>

    <style>
      .dev-banner{   font-size: 14px; color: black; max-width: 100%; margin-bottom: 12px; margin-top: 7px; }
      .dev-banner__text{ display: flex; align-items: center; gap: 8px; margin-bottom: 0px; padding-top: 10px; background: #e9f7f0; padding-bottom: 10px; justify-content: center; border-radius: 3px 0 0 3px; }
      .dev-banner__text b{ color:#333; font-weight:700; }
      .dev-banner__icon{ font-size: 14px; }
      .dev-banner__bar{ height: 12px; border-radius: 3px; overflow: hidden; background: repeating-linear-gradient(135deg,#efefef 0px,#efefef 10px,#e6e6e6 10px,#e6e6e6 20px); }
      .dev-banner__fill{ height: 100%; width: 0%; background: #2e7d32; border-radius: 3px 0 0 3px; }
    </style>

    <script>
      (function () {
        const el = document.querySelector(".dev-banner");
        if (!el) return;
        const total = Number(el.dataset.total) || 1;
        const sold = Math.min(Math.max(Number(el.dataset.sold) || 0, 0), total);
        const remaining = total - sold;
        const pct = (sold / total) * 100;

        el.querySelector(".sold").textContent = sold;
        el.querySelector(".total").textContent = total;
        el.querySelector(".remain").textContent = remaining;
        el.querySelector(".dev-banner__fill").style.width = pct + "%";
      })();
    </script>

    <?php if ( $show_countdown ) : ?>
        <style>
          .gck-countdown{
              background:#fdeeee;
              border:1px solid #f3c9c9;
              border-left:5px solid #c00;
              border-radius:4px; padding:14px 16px; margin:14px 0;
              font-family:'Roboto', sans-serif; color:#333; text-align:left;
          }
          .gck-countdown__head{
              display:flex; align-items:center; gap:8px;
              color:#c00; font-weight:800; font-size:16px;
              margin-bottom:6px; line-height:1.2;
          }
          .gck-countdown__icon{ font-size:18px; line-height:1; animation:gckCdPulse 1.3s ease-in-out infinite; }
          .gck-countdown__body{ font-size:14px; line-height:1.45; color:#333; }
          .gck-countdown__body strong{ color:#c00; font-weight:800; }
          .gck-countdown__timer{ font-weight:800; color:#c00; font-variant-numeric:tabular-nums; white-space:nowrap; }
          @keyframes gckCdPulse{ 0%,100%{ transform:scale(1); } 50%{ transform:scale(1.18); } }
          @media (prefers-reduced-motion: reduce){ .gck-countdown__icon{ animation:none; } }
          @media (max-width: 767px){
              .gck-countdown{ padding:12px 13px; margin:11px 0; }
              .gck-countdown__head{ font-size:15px; }
              .gck-countdown__icon{ font-size:16px; }
              .gck-countdown__body{ font-size:13px; }
          }
        </style>
        <div class="gck-countdown" id="gck-countdown"
             data-minutes="<?php echo esc_attr( $countdown_minutes ); ?>"
             data-key="gck_cd_<?php echo esc_attr( $product_id ); ?>">
            <div class="gck-countdown__head">
                <span class="gck-countdown__icon">🔥</span>
                Obmedzená zásoba
            </div>
            <div class="gck-countdown__body">
                Akcia platí len dnes — ešte <span class="gck-countdown__timer" aria-live="polite">--:--</span>.<?php
                if ( $countdown_stock > 0 ) :
                    ?> Zostáva len <strong><?php echo esc_html( $countdown_stock ); ?> ks</strong>.<?php
                endif; ?> <strong>Ponáhľajte sa, kým sa nevypredá!</strong>
            </div>
        </div>
        <script>
          (function(){
              var el = document.getElementById('gck-countdown');
              if (!el) return;
              var minutes = parseInt(el.getAttribute('data-minutes'), 10) || 10;
              var key = el.getAttribute('data-key') || 'gck_cd_default';
              var timerEl = el.querySelector('.gck-countdown__timer');
              var durationMs = minutes * 60 * 1000;
              var now = Date.now();
              var end;
              try {
                  var stored = window.localStorage.getItem(key);
                  end = stored ? parseInt(stored, 10) : 0;
                  if (!end || isNaN(end) || end <= now) {
                      end = now + durationMs;
                      window.localStorage.setItem(key, String(end));
                  }
              } catch (e) {
                  end = now + durationMs;
              }
              function pad(n){ return (n < 10 ? '0' : '') + n; }
              function tick(){
                  var diff = end - Date.now();
                  if (diff <= 0){
                      end = Date.now() + durationMs;
                      try { window.localStorage.setItem(key, String(end)); } catch (e) {}
                      diff = durationMs;
                  }
                  var totalSec = Math.floor(diff / 1000);
                  var h = Math.floor(totalSec / 3600);
                  var m = Math.floor((totalSec % 3600) / 60);
                  var s = totalSec % 60;
                  timerEl.textContent = h > 0
                      ? (pad(h) + ':' + pad(m) + ':' + pad(s))
                      : (pad(m) + ':' + pad(s));
              }
              tick();
              setInterval(tick, 1000);
          })();
        </script>
    <?php endif; ?>

    <?php if ( $show_countdown && ! $gck_no_attrs && ! $gck_single_size && ! has_term( array( 'orto-red', 'orto-kneeheat', 'orto-pal', 'orto-bowl', 'orto-winecooler', 'orto-snug', 'orto-kneefix', 'orto-controlpro', 'orto-leak-boxers', 'orto-kompresijske-majice' ), 'product_cat', $product_id ) ) : ?>
    <div class="gck-size-link-wrap" style="text-align:right; margin:0 0 8px 0;">
        <a id="open-size-chartCustom" href="#size-chart" class="gck-size-link">
            <svg style="margin-right: 5px; width: 23px; height: 23px; display: inline-block; vertical-align: middle;" xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
                <path d="M11.4124 2.58464L2.08525 11.9118C1.86558 12.1315 1.86558 12.4876 2.08525 12.7073L5.78977 16.4118C6.00944 16.6315 6.3656 16.6315 6.58527 16.4118L15.9124 7.08466C16.1321 6.86499 16.1321 6.50883 15.9124 6.28916L12.2079 2.58464C11.9883 2.36497 11.6321 2.36497 11.4124 2.58464Z" stroke="#111213" stroke-width="0.84375"></path>
                <path d="M9.28125 4.71875L11.5312 6.96875M6.75 7.25L9 9.5M4.21875 9.78125L6.46875 12.0312" stroke="#111213" stroke-width="0.84375"></path>
            </svg>
            Tabuľky veľkostí
        </a>
    </div>
    <?php endif; ?>

    <?php if ( $gck_single_size ) : ?>
    <style>
      #bundle-selector.is-single-size .bundle-pairs,
      #bundle-selector.is-single-size .bundle-pair,
      #bundle-selector.is-single-size .bundle-attr-row { width: 100% !important; display: block !important; }
      #bundle-selector.is-single-size .gck-size-select {
          display: block !important;
          width: 50% !important;        /* desktop: 50% */
          max-width: 50% !important;    /* pobijedi bazni .bundle-box select { max-width:150px } */
          min-width: 0 !important;
          flex: 0 0 auto !important;
          box-sizing: border-box;
          font-size: 12px;
          padding: 11px 30px 11px 12px;
          white-space: nowrap;
          text-overflow: ellipsis;
          overflow: hidden;
      }
      @media (max-width: 767px) {
          #bundle-selector.is-single-size .gck-size-select { width: 80% !important; max-width: 80% !important; }
      }
    </style>
    <?php endif; ?>
    <?php if ( $gck_no_attrs ) : ?>
    <style>
      #bundle-selector.is-no-attrs .bundle-pairs { border-top: 0 !important; padding-top: 0 !important; margin-top: 0 !important; }
      /* Brez atributov v .bundle-pairs ni kaj prikazati — prazne vrstice so samo
         dvigale visino izbrane kartice. */
      #bundle-selector.is-no-attrs .bundle-pairs { display: none !important; }
    </style>
    <?php endif; ?>
    <?php // Leak boxers + kompresijske majice: size-chart link top-right, directly above the bundle buttons.
    if ( has_term( array( 'orto-leak-boxers', 'orto-kompresijske-majice' ), 'product_cat', $product_id ) ) : ?>
    <div class="gck-size-link-wrap" style="text-align:right; margin:0 0 10px 0;">
        <a id="open-size-chartCustom" href="#size-chart" class="gck-size-link">
            <svg style="margin-right:5px;width:20px;height:20px;display:inline-block;vertical-align:middle;" xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none"><path d="M11.4124 2.58464L2.08525 11.9118C1.86558 12.1315 1.86558 12.4876 2.08525 12.7073L5.78977 16.4118C6.00944 16.6315 6.3656 16.6315 6.58527 16.4118L15.9124 7.08466C16.1321 6.86499 16.1321 6.50883 15.9124 6.28916L12.2079 2.58464C11.9883 2.36497 11.6321 2.36497 11.4124 2.58464Z" stroke="#111213" stroke-width="0.84375"></path></svg>
            Tabuľky veľkostí
        </a>
    </div>
    <?php endif; ?>
    <?php
    // Polar NORIKS Cloth: kartica ponude kao na referenci — naslov i naziv paketa lijevo,
    // cijena desno u istom redu, precrtana stara cijena ispod nje.
    if ( has_term( array( 'orto-cloath' ), 'product_cat', $product_id ) ) :
    ?>
        <style>
          #bundle-selector .bundle-option {
              display: grid !important;
              grid-template-columns: auto minmax(0,1fr) auto;
              grid-template-rows: auto auto;
              column-gap: 10px;
              row-gap: 0;
              align-items: center;
              padding: 14px 16px !important;
          }
          #bundle-selector .bundle-option > input[type="radio"] { grid-column: 1; grid-row: 1 / span 2; }
          #bundle-selector .bundle-option .gck-offer-head { grid-column: 2; grid-row: 1; display: flex; align-items: center; gap: 8px; flex-wrap: wrap; line-height: 1.15; }
          #bundle-selector .bundle-option .bundle-option-title { font-size: 17px; font-weight: 800; letter-spacing: -.01em; line-height: 1.15; }
          #bundle-selector .bundle-option .gck-offer-sub { grid-column: 2; grid-row: 2; margin: 1px 0 0 !important; font-size: 13px; line-height: 1.25; color: #6b6b6b; }
          #bundle-selector .bundle-option .gck-offer-prices { display: inline-flex; align-items: center; gap: 8px; position: relative; top: -2px; }
          #bundle-selector .bundle-option .gck-per-chip,
          #bundle-selector .bundle-option .gck-discount-badge { margin: 0 !important; }
          #bundle-selector .bundle-option .bundle-total-line {
              grid-column: 3; grid-row: 1 / span 2;
              display: flex !important; flex-direction: column; align-items: flex-end; gap: 2px;
              margin: 0 !important; text-align: right;
          }
          #bundle-selector .bundle-option .bundle-total-line .line-total { font-size: 20px; font-weight: 800; color: #141414; order: 1; }
          #bundle-selector .bundle-option .bundle-total-line .gck-regular-price { font-size: 14px; margin: 0 !important; order: 2; }
          /* referenca nema "Ukupno:", ni cijene po komadu ni postotka u kartici */
          #bundle-selector .bundle-option .bundle-total-line > span:not(.line-total):not(.gck-regular-price) { display: none !important; }
          #bundle-selector .bundle-option br { display: none !important; }
          #bundle-selector .gck-offer-tag {
              display: inline-block; margin-left: 8px; background: #ececec; color: #333;
              font-size: 12px; font-weight: 700; padding: 2px 9px; border-radius: 999px; vertical-align: middle;
          }
          #bundle-selector .gck-popular-badge--offer { display: inline-block !important; }
          #bundle-selector .gck-popular-badge { top: -13px; right: 10px; transform: none; border-radius: 8px; font-size: 12px; font-weight: 800; letter-spacing: .02em; padding: 4px 14px; }
          @media (max-width: 520px) {
              #bundle-selector .bundle-option { padding: 12px 8px !important; column-gap: 6px; }
              #bundle-selector .bundle-option .bundle-option-title { font-size: 15.5px; }
              #bundle-selector .bundle-option .gck-offer-sub { font-size: 12.5px; }
              #bundle-selector .bundle-option .bundle-total-line .line-total { font-size: 15.5px; }
              #bundle-selector .bundle-option .bundle-total-line .gck-regular-price { font-size: 12px; margin: 0 !important; }
              #bundle-selector .gck-popular-badge { right: 8px; font-size: 11px; padding: 2px 10px; }
          }
        </style>
    <?php endif; ?>

    <?php
    // NORIKS KneeHeat: iste kartice ponuda kao Cloud, u bojama proizvoda.
    if ( has_term( array( 'orto-kneeheat' ), 'product_cat', $product_id ) ) :
    ?>
        <style>
          /* Kartica ponude 1:1 po referenci: slicica lijevo, naslov, podnaslov + postotak,
             pa cijena i precrtana stara cijena — sve lijevo poravnato. Radio je skriven. */
          #bundle-selector .bundle-option {
              display: grid !important;
              grid-template-columns: auto minmax(0,1fr) auto;
              column-gap: 12px; row-gap: 3px;
              align-items: center;
              padding: 13px 16px !important;
              border: 1px solid #e3e6ea !important;
              border-radius: 10px !important;
              background-color: #fff !important;
              background-image: none !important;
          }
          #bundle-selector .bundle-option.active { border-color: #a8500f !important; background-color: #fdf3ec !important; }
          #bundle-selector .bundle-option > input[type="radio"] { grid-column: 1; grid-row: 1 / span 2; margin: 0 !important; }
          /* naslov i cijena po komadu u ISTOM redu */
          #bundle-selector .bundle-option .gck-offer-head {
              grid-column: 2; grid-row: 1 / span 2; align-self: center;
              display: flex; align-items: center; gap: 8px; flex-wrap: nowrap; line-height: 1.2; min-width: 0;
          }
          #bundle-selector .bundle-option .bundle-option-title {
              font-size: 15.5px; font-weight: 700; color: #141414; line-height: 1.25;
          }
          #bundle-selector .bundle-option .gck-offer-sub { display: none !important; }
          #bundle-selector .bundle-option .gck-offer-prices { display: inline-flex; align-items: center; gap: 6px; flex-wrap: nowrap; white-space: nowrap; }
          #bundle-selector .bundle-option .bundle-option-title { white-space: nowrap; }
          #bundle-selector .bundle-option .bundle-total-line {
              grid-column: 3; grid-row: 1 / span 2; align-self: center;
              display: flex !important; flex-direction: column; align-items: flex-end; gap: 1px;
              margin: 0 !important; text-align: right; white-space: nowrap;
          }
          #bundle-selector .bundle-option .bundle-total-line .line-total { font-size: 18px; font-weight: 800; color: #141414; order: 1; }
          #bundle-selector .bundle-option .bundle-total-line .gck-regular-price { font-size: 13.5px; color: #9aa3ad; margin: 0 !important; order: 2; }
          #bundle-selector .bundle-option .bundle-total-line > span:not(.line-total):not(.gck-regular-price) { display: none !important; }
          #bundle-selector .bundle-option br { display: none !important; }

          /* svijetli cipovi, kao na referenci */
          /* samo cijena po komadu — bez precrtane stare cijene i bez postotka */
          #bundle-selector .gck-per-chip {
              background: #fbe7d8 !important; padding: 5px 11px !important;
              border-radius: 4px !important; margin: 0 !important;
          }
          #bundle-selector .gck-per-chip .gck-per-old { display: none !important; }
          #bundle-selector .gck-per-chip .gck-per-new {
              color: #a8500f !important; font-size: 12.5px !important; font-weight: 700 !important;
              text-decoration: none !important; opacity: 1 !important;
          }
          /* mali zeleni cip s popustom, kao na referenci */
          #bundle-selector .gck-discount-badge {
              display: inline-block !important;
              background: #e3f4e8 !important; color: #1e6b3f !important;
              font-size: 12.5px !important; font-weight: 700 !important; padding: 5px 11px !important;
              border-radius: 4px !important; margin: 0 !important; border: 0 !important;
          }
          #bundle-selector .bundle-option input[type="radio"] { border-color: #a8500f !important; accent-color: #a8500f !important; }
          #bundle-selector .bundle-option input[type="radio"]::before { background: #a8500f !important; }
          #bundle-selector .bundle-pairs { border-top-color: #f0dccb !important; }

          /* crni kartus iznad kartice, desno — kao na referenci */
          #bundle-selector .gck-popular-badge {
              background: #a8500f !important; color: #fff !important;
              top: -12px !important; right: 10px !important; left: auto !important; transform: none !important;
              border-radius: 6px !important; font-size: 11.5px !important; font-weight: 800 !important;
              letter-spacing: .04em !important; padding: 4px 12px !important;
          }



          /* traka "Ogranicena zaliha": svijetlo plava umjesto crvene */
          .gck-countdown { background: #eef4fb !important; border-color: #f0dccb !important; border-left-color: #2f6fd0 !important; }
          .gck-countdown__head, .gck-countdown__head * { color: #a8500f !important; }
          .gck-countdown__body, .gck-countdown__body strong,
          .gck-countdown__timer { color: #2f6fd0 !important; }

          @media (max-width: 520px) {
              #bundle-selector .bundle-option { padding: 12px 10px !important; column-gap: 8px; }
              #bundle-selector .bundle-option .bundle-option-title { font-size: 14.5px; }
              #bundle-selector .bundle-option .gck-offer-sub { font-size: 12.5px; }
              #bundle-selector .gck-per-chip, #bundle-selector .gck-discount-badge { font-size: 11px !important; padding: 4px 8px !important; }
          }
        </style>
    <?php endif; ?>

    <?php if ( has_term( array( 'orto-red', 'orto-slabproof', 'orto-tradesman' ), 'product_cat', $product_id ) ) : ?>
    <style>
      /* NORIKS RedRelief: razmak izmedu kartica mora biti jednak izmedu svih ponuda.
         Inline margin-top: 25px na drugoj kartici radio je veci razmak 1-2 nego 2-3. */
      #bundle-selector label.bundle-option { margin-top: 0 !important; margin-bottom: 14px !important; }
      #bundle-selector label.bundle-option:last-of-type { margin-bottom: 0 !important; }
    </style>
    <?php endif; ?>

    <?php if ( has_term( array( 'orto-snug', 'orto-kompwom', 'orto-slim', 'orto-pal', 'orto-bowl', 'orto-winecooler', 'orto-slabproof', 'orto-tradesman' ), 'product_cat', $product_id ) ) :
    ?>
    <style>
      /* rijec "Ukupno:" ne treba — cijena govori sama za sebe */
      #bundle-selector .bundle-option .bundle-total-line > span:not(.line-total):not(.gck-regular-price) { display: none !important; }
      #bundle-selector .bundle-option .bundle-total-line { display: flex !important; align-items: baseline; justify-content: flex-end; gap: 8px; }
      #bundle-selector .bundle-option .bundle-total-line .gck-regular-price { order: 1; font-size: 14px; color: #9aa3ad; margin: 0 !important; }
      #bundle-selector .bundle-option .bundle-total-line .line-total { order: 2; font-size: 19px; font-weight: 800; color: #141414; }
      /* kod jednog komada je cijena po komadu ista kao ukupna — suvisna je */
      #bundle-selector label.bundle-option:first-of-type .gck-per-chip { display: none !important; }
      /* u cipu ide samo konacna cijena po komadu, bez precrtane */
      #bundle-selector .bundle-option .gck-per-chip .gck-per-old { display: none !important; }
      #bundle-selector .bundle-option br { display: none !important; }
    </style>
    <?php endif; ?>

    <?php if ( has_term( array( 'orto-snug' ), 'product_cat', $product_id ) ) :
    ?>
    <style>
      #bundle-selector .color-swatches { display: flex !important; gap: 10px; flex-wrap: wrap; width: fit-content !important; }
      #bundle-selector .color-swatches .swatch { width: 46px !important; height: 46px !important; border-radius: 50% !important;
          border: 2px solid #dfe3e8 !important; background: #fff; }
      #bundle-selector .color-swatches .swatch.active { border-color: #ff6d2e !important; transform: scale(1.06); }
      #bundle-selector .color-swatches .swatch-circle { width: 34px !important; height: 34px !important; border-radius: 50% !important;
          box-shadow: inset 0 0 0 1px rgba(0,0,0,.08); }
      /* stvarne nijanse jastuka — globalne boje su za bokserice, ovdje su drukcije */
      #bundle-selector .swatch-circle.color-plava      { background: #b7c4e6 !important; }
      #bundle-selector .swatch-circle.color-roza       { background: #e6a8b8 !important; }
      #bundle-selector .swatch-circle.color-siva       { background: #c9c2ba !important; }
      #bundle-selector .swatch-circle.color-zelena     { background: #b3bf9a !important; }
      #bundle-selector .swatch-circle.color-ljubicasta { background: #b48fc4 !important; }
      #bundle-selector .swatch-circle.color-tamnoplava { background: #2b3a63 !important; }
      /* lokalizirane barve SK */
      #bundle-selector .swatch-circle.color-modra { background: #b7c4e6 !important; }
      #bundle-selector .swatch-circle.color-ruzova { background: #e6a8b8 !important; }
      #bundle-selector .swatch-circle.color-fialova { background: #b48fc4 !important; }
      #bundle-selector .swatch-circle.color-tmavomodra { background: #2b3a63 !important; }
      @media (max-width: 560px) {
        #bundle-selector .color-swatches { gap: 8px; width: 100% !important; }
        #bundle-selector .color-swatches .swatch { width: 42px !important; height: 42px !important; }
        #bundle-selector .color-swatches .swatch-circle { width: 30px !important; height: 30px !important; }
      }
    </style>
    <?php endif; ?>

    <?php
    // NORIKS Slim: boja + velicina, krugovi u stvarnim nijansama gacica, magenta paleta stranice.
    if ( has_term( array( 'orto-slim' ), 'product_cat', $product_id ) ) :
    ?>
    <style>
      #bundle-selector .color-swatches { display: flex !important; gap: 10px; flex-wrap: wrap; }
      #bundle-selector .color-swatches .swatch { width: 44px !important; height: 44px !important; border-radius: 50% !important;
          border: 2px solid #efdfe7 !important; background: #fff; }
      #bundle-selector .color-swatches .swatch.active { border-color: #a3336b !important; transform: scale(1.06); }
      #bundle-selector .color-swatches .swatch-circle { width: 32px !important; height: 32px !important; border-radius: 50% !important;
          box-shadow: inset 0 0 0 1px rgba(0,0,0,.10); }
      /* nijanse sa slika gacica (sanitize_title lokaliziranih imen barv na trgu) */
      #bundle-selector .swatch-circle.color-cierna { background: #17161a !important; }
      #bundle-selector .swatch-circle.color-telova { background: #ecd9bd !important; }
      #bundle-selector .swatch-circle.color-tmavomodra { background: #232b52 !important; }
      #bundle-selector .swatch-circle.color-fialova { background: #d8c1ee !important; }
      #bundle-selector .swatch-circle.color-fuchsiova { background: #d81b72 !important; }
      #bundle-selector .swatch-circle.color-slivkova { background: #5b2147 !important; }

      #bundle-selector .bundle-option {
          border: 2px solid #efdfe7 !important; background: #fdf9fb !important;
          box-shadow: 0 1px 2px rgba(58,20,40,.10), 0 2px 6px 2px rgba(58,20,40,.06) !important; }
      #bundle-selector .bundle-option.active { border-color: #a3336b !important; background: #fbf1f6 !important; }
      #bundle-selector .bundle-option-title { color: #2b1622 !important; }
      #bundle-selector .bundle-option input[type="radio"] { border-color: #a3336b !important; }
      #bundle-selector .bundle-option input[type="radio"]::before { background: #a3336b !important; }
      #bundle-selector .bundle-option .gck-per-chip { background: #c00 !important; }
      #bundle-selector .bundle-option .gck-discount-badge { background: #2e7d32 !important; }
      #bundle-selector .bundle-pairs { border-top-color: #f1e3ea !important; }
      #bundle-selector .bundle-total-line .line-total { color: #a3336b !important; }
      #bundle-selector .bundle-total-line .gck-regular-price { color: #a38b97 !important; }
      #bundle-selector .gck-offer-sub { color: #7d6572 !important; }
      #bundle-selector .bundle-pair select,
      #bundle-selector .bundle-pair .gck-extra-select { border-color: #a3336b !important; color: #2b1622 !important; }
      .gck-size-link { color: #a3336b !important; }
    </style>
    <?php endif; ?>

    <?php if ( has_term( array( 'orto-tradesman' ), 'product_cat', $product_id ) ) : ?>
    <style>
      /* NORIKS Tradesman: barva crna/bela (barve originala) kot krogci + velikost (M-XL po stevilki cevlja). */
      .swatch-circle.color-biela, #bundle-selector .swatch-circle.color-biela { background: #f4f4f2 !important; border: 1px solid #cfcfcf !important; }
      .swatch-circle.color-cierna, #bundle-selector .swatch-circle.color-cierna { background: #1c1c1e !important; }
    </style>
    <?php endif; ?>

    <?php if ( has_term( array( 'orto-slabproof' ), 'product_cat', $product_id ) ) : ?>
    <style>
      /* izbornik boje cita nijansu s probnog elementa IZVAN #bundle-selector,
         zato ista pravila moraju postojati i bez prefiksa (inace ostane osnovna tamna boja). */
      .swatch-circle.color-cierna                 { background: #1b1916 !important; }

      #bundle-selector .color-swatches { display: flex !important; gap: 10px; flex-wrap: wrap; }
      #bundle-selector .color-swatches .swatch { width: 44px !important; height: 44px !important; border-radius: 50% !important;
          border: 2px solid #e4decf !important; background: #fff; }
      #bundle-selector .color-swatches .swatch.active { border-color: #d2632e !important; transform: scale(1.06); }
      #bundle-selector .color-swatches .swatch-circle { width: 32px !important; height: 32px !important; border-radius: 50% !important;
          box-shadow: inset 0 0 0 1px rgba(0,0,0,.10); }
      #bundle-selector .swatch-circle.color-cierna                 { background: #1b1916 !important; }
      #bundle-selector .bundle-option {
          border: 2px solid #e4decf !important; background: #faf7f0 !important;
          box-shadow: 0 1px 2px rgba(20,25,40,.10), 0 2px 6px 2px rgba(20,25,40,.06) !important; }
      #bundle-selector .bundle-option.active { border-color: #d2632e !important; background: #fbf1ea !important; }
      #bundle-selector .bundle-option-title { color: #15140f !important; }
      #bundle-selector .bundle-option input[type="radio"] { border-color: #d2632e !important; }
      #bundle-selector .bundle-option input[type="radio"]::before { background: #d2632e !important; }
      #bundle-selector .bundle-option .gck-per-chip { background: #c00 !important; }
      #bundle-selector .bundle-option .gck-discount-badge { background: #2e7d32 !important; }
      #bundle-selector .bundle-pairs { border-top-color: #e4decf !important; }
      #bundle-selector .bundle-total-line .line-total { color: #d2632e !important; }
      #bundle-selector .bundle-total-line .gck-regular-price { color: #8a877f !important; }
      #bundle-selector .gck-offer-sub { color: #8a877f !important; }
      #bundle-selector .bundle-pair select,
      #bundle-selector .bundle-pair .gck-extra-select { border-color: #d2632e !important; color: #15140f !important; }
      .gck-size-link { color: #d2632e !important; }
    </style>
    <?php endif; ?>


    <?php if ( has_term( array( 'orto-kompwom' ), 'product_cat', $product_id ) ) :
    ?>
    <style>
      #bundle-selector .color-swatches { display: flex !important; gap: 10px; flex-wrap: wrap; }
      #bundle-selector .color-swatches .swatch { width: 44px !important; height: 44px !important; border-radius: 50% !important;
          border: 2px solid #e7dde1 !important; background: #fff; }
      #bundle-selector .color-swatches .swatch.active { border-color: #a8536b !important; transform: scale(1.06); }
      #bundle-selector .color-swatches .swatch-circle { width: 32px !important; height: 32px !important; border-radius: 50% !important;
          box-shadow: inset 0 0 0 1px rgba(0,0,0,.10); }
      #bundle-selector .swatch-circle.color-crna      { background: #17161a !important; }
      #bundle-selector .swatch-circle.color-tamnosiva { background: #4a4a4f !important; }
      #bundle-selector .swatch-circle.color-roza      { background: #e28ba4 !important; }
      /* lokalizirane barve SK */
      #bundle-selector .swatch-circle.color-cierna { background: #17161a !important; }
      #bundle-selector .swatch-circle.color-tmavosiva { background: #4a4a4f !important; }
      #bundle-selector .swatch-circle.color-ruzova { background: #e28ba4 !important; }

      /* Cijeli izbornik ponuda u roza/bordo paleti stranice (#a8536b / #5c2331 / #fbf3f4).
         Gumb "Dodaj u kosaricu" ostaje nepromijenjen. */
      #bundle-selector .bundle-option {
          border: 2px solid #e7dde1 !important; background: #fdfafb !important;
          box-shadow: 0 1px 2px rgba(36,28,34,.10), 0 2px 6px 2px rgba(36,28,34,.06) !important; }
      #bundle-selector .bundle-option.active { border-color: #a8536b !important; background: #fbf3f4 !important; }
      #bundle-selector .bundle-option-title { color: #241c22 !important; }
      #bundle-selector .bundle-option input[type="radio"] { border-color: #a8536b !important; }
      #bundle-selector .bundle-option input[type="radio"]::before { background: #a8536b !important; }
      /* Cijena po komadu i znacka popusta ostaju u izvornim bojama. */
      #bundle-selector .bundle-option .gck-per-chip { background: #c00 !important; }
      #bundle-selector .bundle-option .gck-discount-badge { background: #2e7d32 !important; }
      #bundle-selector .bundle-pairs { border-top-color: #efe2e6 !important; }
      #bundle-selector .bundle-total-line .line-total { color: #a8536b !important; }
      #bundle-selector .bundle-total-line .gck-regular-price { color: #a08d95 !important; }
      #bundle-selector .gck-offer-sub { color: #7b6d73 !important; }
      #bundle-selector .bundle-pair select,
      #bundle-selector .bundle-pair .gck-extra-select { border-color: #a8536b !important; color: #241c22 !important; }
      .gck-size-link { color: #a8536b !important; }
    </style>
    <?php endif; ?>


    <?php
    if ( has_term( array( 'orto-cloud', 'orto-snore' ), 'product_cat', $product_id ) ) :
    ?>
        <style>
          /* Kartica ponude 1:1 po referenci: slicica lijevo, naslov, podnaslov + postotak,
             pa cijena i precrtana stara cijena — sve lijevo poravnato. Radio je skriven. */
          #bundle-selector .bundle-option {
              display: grid !important;
              grid-template-columns: auto minmax(0,1fr) auto;
              column-gap: 12px; row-gap: 3px;
              align-items: center;
              padding: 13px 16px !important;
              border: 1px solid #e3e6ea !important;
              border-radius: 10px !important;
              background-color: #fff !important;
              background-image: none !important;
          }
          #bundle-selector .bundle-option.active { border-color: #12233b !important; background-color: #f2f6fb !important; }
          #bundle-selector .bundle-option > input[type="radio"] { grid-column: 1; grid-row: 1 / span 2; margin: 0 !important; }
          /* naslov i cijena po komadu u ISTOM redu */
          #bundle-selector .bundle-option .gck-offer-head {
              grid-column: 2; grid-row: 1 / span 2; align-self: center;
              display: flex; align-items: center; gap: 8px; flex-wrap: nowrap; line-height: 1.2; min-width: 0;
          }
          #bundle-selector .bundle-option .bundle-option-title {
              font-size: 15.5px; font-weight: 700; color: #141414; line-height: 1.25;
          }
          #bundle-selector .bundle-option .gck-offer-sub { display: none !important; }
          #bundle-selector .bundle-option .gck-offer-prices { display: inline-flex; align-items: center; gap: 6px; flex-wrap: nowrap; white-space: nowrap; }
          #bundle-selector .bundle-option .bundle-option-title { white-space: nowrap; }
          #bundle-selector .bundle-option .bundle-total-line {
              grid-column: 3; grid-row: 1 / span 2; align-self: center;
              display: flex !important; flex-direction: column; align-items: flex-end; gap: 1px;
              margin: 0 !important; text-align: right; white-space: nowrap;
          }
          #bundle-selector .bundle-option .bundle-total-line .line-total { font-size: 18px; font-weight: 800; color: #141414; order: 1; }
          #bundle-selector .bundle-option .bundle-total-line .gck-regular-price { font-size: 13.5px; color: #9aa3ad; margin: 0 !important; order: 2; }
          #bundle-selector .bundle-option .bundle-total-line > span:not(.line-total):not(.gck-regular-price) { display: none !important; }
          #bundle-selector .bundle-option br { display: none !important; }

          /* svijetli cipovi, kao na referenci */
          /* samo cijena po komadu — bez precrtane stare cijene i bez postotka */
          #bundle-selector .gck-per-chip {
              background: #e6effb !important; padding: 5px 11px !important;
              border-radius: 4px !important; margin: 0 !important;
          }
          #bundle-selector .gck-per-chip .gck-per-old { display: none !important; }
          #bundle-selector .gck-per-chip .gck-per-new {
              color: #12233b !important; font-size: 12.5px !important; font-weight: 700 !important;
              text-decoration: none !important; opacity: 1 !important;
          }
          /* mali zeleni cip s popustom, kao na referenci */
          #bundle-selector .gck-discount-badge {
              display: inline-block !important;
              background: #e3f4e8 !important; color: #1e6b3f !important;
              font-size: 12.5px !important; font-weight: 700 !important; padding: 5px 11px !important;
              border-radius: 4px !important; margin: 0 !important; border: 0 !important;
          }
          #bundle-selector .bundle-option input[type="radio"] { border-color: #12233b !important; accent-color: #12233b !important; }
          #bundle-selector .bundle-option input[type="radio"]::before { background: #12233b !important; }
          #bundle-selector .bundle-pairs { border-top-color: #d5e1f0 !important; }

          /* crni kartus iznad kartice, desno — kao na referenci */
          #bundle-selector .gck-popular-badge {
              background: #12233b !important; color: #fff !important;
              top: -12px !important; right: 10px !important; left: auto !important; transform: none !important;
              border-radius: 6px !important; font-size: 11.5px !important; font-weight: 800 !important;
              letter-spacing: .04em !important; padding: 4px 12px !important;
          }



          /* traka "Ogranicena zaliha": svijetlo plava umjesto crvene */
          .gck-countdown { background: #eef4fb !important; border-color: #d5e1f0 !important; border-left-color: #2f6fd0 !important; }
          .gck-countdown__head, .gck-countdown__head * { color: #12233b !important; }
          .gck-countdown__body, .gck-countdown__body strong,
          .gck-countdown__timer { color: #2f6fd0 !important; }

          @media (max-width: 520px) {
              #bundle-selector .bundle-option { padding: 12px 10px !important; column-gap: 8px; }
              #bundle-selector .bundle-option .bundle-option-title { font-size: 14.5px; }
              #bundle-selector .bundle-option .gck-offer-sub { font-size: 12.5px; }
              #bundle-selector .gck-per-chip, #bundle-selector .gck-discount-badge { font-size: 11px !important; padding: 4px 8px !important; }
          }
        </style>
    <?php endif; ?>

    <?php
    if ( has_term( array( 'orto-hyd' ), 'product_cat', $product_id ) ) :
    ?>
        <style>
          #bundle-selector .bundle-option.active { border-color: #2e7fd4 !important; background: #2e7fd414 !important; }
          #bundle-selector .bundle-option input[type="radio"] { border-color: #2e7fd4 !important; }
          #bundle-selector .bundle-option input[type="radio"]::before { background: #2e7fd4 !important; }
          #bundle-selector .gck-per-chip { background: #0f2f5c !important; }
          #bundle-selector .gck-discount-badge { background: #2e7fd4 !important; }
          #bundle-selector .bundle-pairs { border-top-color: #cfe0f0 !important; }
        </style>
        <style>
          /* Traka ogranicene zalihe: svijetlo plava umjesto crvene. */
          .gck-countdown { background: #eef5fc !important; border-color: #cfe0f0 !important; border-left-color: #2e7fd4 !important; }
          .gck-countdown__head { color: #0f2f5c !important; }
          .gck-countdown__body strong,
          .gck-countdown__timer { color: #2e7fd4 !important; }
        </style>
    <?php endif; ?>

    <?php // Alternativni izbornici: umjesto trake swatcheva -> DVA prilagodena dropdowna
          // (prvo Velicina, zatim Boja s uzorkom boje), isti stil kao na HairMagic+.
          // Ukljucuje se PO PROIZVODU preko ACF prekidaca "Alternativni izbornici"
          // (Orto Bundle – countdown), pa svi ostali proizvodi ostaju nepromijenjeni.
    if ( $gck_alt_dropdowns ) : ?>
    <style>
      #bundle-selector .gck-dd-list::-webkit-scrollbar { width: 8px; }
      #bundle-selector .gck-dd-list::-webkit-scrollbar-thumb { background: #d8d8d8; border-radius: 8px; }
    </style>
    <script>
    (function(){
      var ORANGE = '#ff6d2e';
      var BORDER = <?php echo has_term( array( 'orto-kompwom' ), 'product_cat', $product_id ) ? "'#a8536b'" : ( has_term( array( 'orto-slim' ), 'product_cat', $product_id ) ? "'#a3336b'" : ( has_term( array( 'orto-slabproof' ), 'product_cat', $product_id ) ? "'#d2632e'" : "'#111111'" ) ); ?>;   /* okvir izbornika: crn */
      function css(el, o){ if(!el) return; for(var k in o){ el.style.setProperty(k, o[k], 'important'); } }

      /* Jedan prilagodeni dropdown. items = [{value, label, color|null, pick()}] */
      function makeDD(opts){
        var wrap = document.createElement('span');
        wrap.className = 'gck-dd';
        /* fiksne sirine — izbornik boje se NE rasteze preko cijele kartice.
           Na uskim zaslonima red se prelomi (flex-wrap), pa nista ne ispada. */
        css(wrap, {'position':'relative','display':'inline-block','flex':'0 0 auto',
                   'width':opts.width,'min-width':(opts.minWidth || '0'),'max-width':'100%','vertical-align':'middle'});

        var btn = document.createElement('button');
        btn.type = 'button'; btn.className = 'gck-dd-btn';
        btn.setAttribute('aria-haspopup','listbox'); btn.setAttribute('aria-expanded','false');
        /* isti stil kao stari <select>, samo s CRNIM okvirom: 1px, radius 4px, 18px/600 */
        css(btn, {'display':'flex','align-items':'center','gap':'8px','width':'100%','box-sizing':'border-box',
                  'border':'1px solid ' + BORDER,'border-radius':'4px','background':'#fff','cursor':'pointer',
                  'padding':'4px 26px 4px 10px','font-size':'18px','font-weight':'600','color':'#333',
                  'text-align':'left','min-height':'38px','line-height':'1.3','white-space':'nowrap'});
        var sw = document.createElement('span');
        css(sw, {'flex':'0 0 20px','width':'20px','height':'20px','border-radius':'4px',
                 'border':'1px solid rgba(0,0,0,.2)','display':opts.hasColor ? 'block' : 'none'});
        var lab = document.createElement('span');
        css(lab, {'flex':'1 1 auto','overflow':'hidden','text-overflow':'ellipsis','white-space':'nowrap','line-height':'1.2'});
        btn.appendChild(sw); btn.appendChild(lab);

        var car = document.createElement('span');
        css(car, {'position':'absolute','right':'10px','top':'50%','transform':'translateY(-50%)','pointer-events':'none',
                  'width':'0','height':'0','border-left':'5px solid transparent','border-right':'5px solid transparent',
                  'border-top':'6px solid #444'});

        var list = document.createElement('div');
        list.className = 'gck-dd-list'; list.setAttribute('role','listbox');
        css(list, {'display':'none','position':'absolute','left':'0','top':'calc(100% + 4px)','z-index':'60',
                   'width':'max-content','min-width':'100%','max-height':'268px','overflow-y':'auto','background':'#fff',
                   'border':'1px solid #e0e0e0','border-radius':'8px','box-shadow':'0 10px 26px rgba(0,0,0,.16)','padding':'4px'});

        wrap.appendChild(btn); wrap.appendChild(car); wrap.appendChild(list);

        function close(){ css(list, {'display':'none'}); btn.setAttribute('aria-expanded','false'); css(btn, {'border-color':BORDER}); }
        function open(){
          document.querySelectorAll('#bundle-selector .gck-dd-list').forEach(function(o){ o.style.setProperty('display','none','important'); });
          css(list, {'display':'block'}); btn.setAttribute('aria-expanded','true'); css(btn, {'border-color':BORDER});
        }
        btn.addEventListener('click', function(e){ e.preventDefault(); e.stopPropagation(); (list.style.display === 'block') ? close() : open(); });
        document.addEventListener('click', function(e){ if(!wrap.contains(e.target)) close(); });
        document.addEventListener('keydown', function(e){ if(e.key === 'Escape') close(); });

        var items = [];
        opts.items.forEach(function(o){
          var it = document.createElement('div');
          it.setAttribute('role','option'); it.dataset.val = o.value;
          css(it, {'display':'flex','align-items':'center','gap':'10px','padding':'8px 12px 8px 10px','border-radius':'4px',
                   'cursor':'pointer','font-size':'16px','font-weight':'600','color':'#333','line-height':'1.25','white-space':'nowrap'});
          if(o.color){
            var c = document.createElement('span');
            css(c, {'flex':'0 0 20px','width':'20px','height':'20px','border-radius':'4px','border':'1px solid rgba(0,0,0,.15)'});
            c.style.setProperty('background', o.color, 'important');
            it.appendChild(c);
          }
          var tx = document.createElement('span'); tx.textContent = o.label; it.appendChild(tx);
          it.addEventListener('mouseenter', function(){ if(it.dataset.val !== wrap.dataset.val) css(it, {'background':'#f6f6f6'}); });
          it.addEventListener('mouseleave', function(){ if(it.dataset.val !== wrap.dataset.val) css(it, {'background':'transparent'}); });
          it.addEventListener('click', function(e){ e.preventDefault(); e.stopPropagation(); o.pick(); setCurrent(o); close(); });
          list.appendChild(it); items.push({ o: o, el: it });
        });

        function setCurrent(o){
          wrap.dataset.val = o.value;
          lab.textContent = o.label;
          if(o.color) sw.style.setProperty('background', o.color, 'important');
          items.forEach(function(x){
            var on = x.o.value === o.value;
            x.el.setAttribute('aria-selected', on ? 'true' : 'false');
            css(x.el, {'background': on ? '#fff1e9' : 'transparent', 'font-weight': on ? '700' : '500'});
          });
        }
        wrap.setCurrent = setCurrent;
        return wrap;
      }

      /* registar svih izbornika velicine — osnovni skript sinkronizira velicine
         tako da drugim <select>-ima postavi .value BEZ 'change' dogadaja, pa
         gumbe moramo osvjeziti sami. */
      var sizeRegs = [];
      function syncAllSizes(){
        sizeRegs.forEach(function(r){
          var cur = r.items.filter(function(i){ return i.value === r.sel.value; })[0];
          if(cur) r.dd.setCurrent(cur);
        });
      }

      function build(){
        var box = document.getElementById('bundle-selector');
        if(!box || box.dataset.gckDdDone) return;
        box.dataset.gckDdDone = '1';

        box.querySelectorAll('.bundle-attr-row').forEach(function(row){
          if(row.querySelector('.gck-dd') || row.querySelector('.hgm-selwrap')) return;
          var sel   = row.querySelector('.gck-size-select');
          var swGrp = row.querySelector('.color-swatches');
          if(!sel && !swGrp) return;

          css(row, {'display':'flex','align-items':'center','gap':'8px','flex-wrap':'wrap','width':'100%'});

          /* 1) VELICINA */
          if(sel){
            var sizeItems = Array.prototype.map.call(sel.options, function(o){
              return { value: o.value, label: o.text.trim(), color: null,
                       pick: function(){ sel.value = o.value; sel.dispatchEvent(new Event('change', { bubbles: true })); } };
            });
            var sizeDD = makeDD({ items: sizeItems, width: 'auto', minWidth: '96px', hasColor: false, grow: false });
            row.insertBefore(sizeDD, row.firstChild);
            css(sel, {'display':'none'});
            var cur = sizeItems.filter(function(i){ return i.value === sel.value; })[0] || sizeItems[0];
            if(cur) sizeDD.setCurrent(cur);
            sizeRegs.push({ sel: sel, dd: sizeDD, items: sizeItems });
            sel.addEventListener('change', function(){
              var c = sizeItems.filter(function(i){ return i.value === sel.value; })[0];
              if(c) sizeDD.setCurrent(c);
            });
          }

          /* 2) BOJA — uzorci se citaju iz postojecih .swatch-circle elemenata */
          if(swGrp){
            var swatches = Array.prototype.slice.call(swGrp.querySelectorAll('.swatch'));
            if(swatches.length){
              var colorItems = swatches.map(function(sw){
                var circle = sw.querySelector('.swatch-circle');
                var bg = circle ? getComputedStyle(circle).backgroundColor : '';
                if(!bg || bg === 'rgba(0, 0, 0, 0)') bg = '#cccccc';
                return { value: sw.dataset.value || '', label: sw.dataset.value || sw.title || '', color: bg,
                         /* NE sw.click(): klik bi doplovio do <label class="bundle-option">
                            i prebacio odabranu ponudu. Ne-bubbling klik pokrece samo
                            slusac na swatchu (postavi hidden input + .active). */
                         pick: function(){ sw.dispatchEvent(new MouseEvent('click', { bubbles: false })); } };
              });
              var colorDD = makeDD({ items: colorItems, width: 'auto', minWidth: '176px', hasColor: true, grow: false });
              /* boja ide ODMAH IZA velicine */
              var sizeEl = row.querySelector('.gck-dd');
              if(sizeEl && sizeEl.nextSibling) row.insertBefore(colorDD, sizeEl.nextSibling);
              else if(sizeEl) row.appendChild(colorDD);
              else row.insertBefore(colorDD, row.firstChild);
              css(swGrp, {'display':'none'});
              var active = swGrp.querySelector('.swatch.active') || swatches[0];
              var cc = colorItems.filter(function(i){ return i.value === (active.dataset.value || ''); })[0] || colorItems[0];
              if(cc){ cc.pick(); colorDD.setCurrent(cc); }
            }
          }
        });

        /* promjena velicine u 1. redu -> osnovni skript prepise ostale selectove:
           nakon toga osvjezimo sve gumbe (u sljedecem tick-u). */
        box.addEventListener('change', function(e){
          var t = e.target;
          if(t && t.classList && t.classList.contains('gck-size-select')) setTimeout(syncAllSizes, 0);
        }, true);
        box.querySelectorAll('input[name="bundle_option"]').forEach(function(r){
          r.addEventListener('change', function(){ setTimeout(syncAllSizes, 60); });
        });
      }
      /* radi tek kad je osnovni skript vec postavio pocetne swatcheve */
      if(document.readyState === 'loading'){ document.addEventListener('DOMContentLoaded', function(){ setTimeout(build, 0); }); }
      else { setTimeout(build, 0); }
    })();
    </script>
    <?php endif; ?>
    <?php if ( $gck_side_select ) : ?>
    <style>
      /* KneeFix: Veličina + Stranica jedan uz drugi u istom redu, s brojem komada. */
      #bundle-selector .bundle-pairs { counter-reset: kfxpair; }
      #bundle-selector .bundle-pair  { counter-increment: kfxpair; }
      #bundle-selector .bundle-pair .bundle-attr-row {
          display: flex !important;
          flex-wrap: nowrap !important;
          align-items: center;
          justify-content: flex-start;
          gap: 8px;
          width: 100%;
      }
      /* Fiksna sirina broja da se izbornici u svim redovima poravnaju. */
      #bundle-selector .bundle-pair .bundle-attr-row:before {
          content: "#" counter(kfxpair);
          flex: 0 0 24px;
          text-align: right;
          font-size: 13px; font-weight: 700; color: #6b6b6b;
          font-variant-numeric: tabular-nums;
      }
      /* Veličina prva, Stranica druga — kao na referenci; oba uska (širina po sadržaju). */
      #bundle-selector .bundle-pair .gck-size-select {
          order: 1;
          flex: 0 1 auto;
          display: inline-block !important;
          width: auto !important;
          max-width: 60% !important;
          min-width: 0 !important;
          font-size: 14px;
          padding: 9px 26px 9px 10px;
          text-overflow: ellipsis;
      }
      #bundle-selector .bundle-pair .gck-side-select {
          order: 2;
          flex: 0 0 auto;
          display: inline-block !important;
          width: auto !important;
          max-width: 40% !important;
          min-width: 0 !important;
          font-size: 14px;
          padding: 9px 26px 9px 10px;
      }
      @media (max-width: 600px) {
          #bundle-selector .bundle-pair .bundle-attr-row { gap: 6px; }
          #bundle-selector .bundle-pair .gck-side-select,
          #bundle-selector .bundle-pair .gck-size-select { font-size: 13px; padding: 9px 22px 9px 8px; }
      }
    </style>
    <?php endif; ?>
    <div id="bundle-selector" class="bundle-box<?php echo $gck_single_size ? ' is-single-size' : ''; ?><?php echo $gck_no_attrs ? ' is-no-attrs' : ''; ?>" data-split-garments="<?php echo $gck_split_garments ? '1' : '0'; ?>">
        <?php
        $default_index = ( $precheck_second && count( $offers ) > 2 ) ? 2 : 0;
        $loop_index    = 0;

        foreach ( $offers as $offer_id => $data ) :
            // SHGIFTS is a single fixed set (4+1+1); render only the first offer row
            // even if the bundle meta happens to carry more than one.
            if ( $gck_shgifts && $loop_index > 0 ) break;

            $pairs = (int) ( $data['qty'] ?? 0 );
            if ( $pairs <= 0 ) continue;

            $is_default = ( $loop_index === $default_index );

            $offer_p1 = trim((string)($data['p1'] ?? ''));
            $offer_p2 = trim((string)($data['p2'] ?? ''));
            $offer_tip = strtolower(trim((string)($data['tip'] ?? ''))); // NEW

            // Decide which selector OPTIONS to show for each group in 4-attr case.
            // IMPORTANT: we keep group field keys as-is so values do NOT overwrite.
            // - mixed (or empty) => group0 uses group0 options, group1 uses group1 options
            // - majica => BOTH groups show majica options (source group 0), but group1 keeps its own field keys
            // - bokserica => BOTH groups show bokserica options (source group 1), but group0 keeps its own field keys
            $force_source_group = null; // null = normal
            if ( $show_group_titles ) {
                if ( $offer_tip === 'majica' ) {
                    $force_source_group = 0;
                } elseif ( $offer_tip === 'bokserica' || $offer_tip === 'bokserice' ) {
                    $force_source_group = 1;
                } // mixed or empty => null
            }

            // Price highlights: per-piece regular price + discount %.
            // SHBOX split: real piece count is pairs * 2 (majice + bokserice).
            // SHGIFTS: real piece count is 6 (4 tričko + 1 boxerky + 1 ponožky),
            // so per-piece pricing reads sensibly, same idea as the SHBOX split.
            $gck_pieces   = $gck_split_garments ? ( $pairs * 2 ) : ( $gck_shgifts ? 6 : $pairs );
            $per_regular  = ( $gck_pieces > 0 ) ? ( (float) $data['regular'] / $gck_pieces ) : 0;
            $gck_per_new  = ( $gck_split_garments || $gck_shgifts )
                ? ( ( $gck_pieces > 0 ) ? ( floor( ( (float) $data['total'] / $gck_pieces ) * 100 ) / 100 ) : 0 )
                : (float) $data['per'];
            $discount_pct = ( (float) $data['regular'] > 0 )
                ? (int) round( ( ( (float) $data['regular'] - (float) $data['total'] ) / (float) $data['regular'] ) * 100 )
                : 0;
        ?>
            <label style="position: relative; <?php if ( ( ( $loop_index == 1 || $loop_index == 3 ) && ! $show_group_titles ) || ( ! empty( $gck_offer_badges ) && isset( $gck_offer_badges[ $loop_index ] ) ) ) : ?> margin-top: 25px;  <?php endif; ?>"
                   class="bundle-option<?php echo $is_default ? ' active' : ''; ?>">

                <?php if ( ! empty( $gck_offer_badges ) && isset( $gck_offer_badges[ $loop_index ] ) ) : ?>
                    <div class="gck-popular-badge gck-popular-badge--offer"><?php echo esc_html( $gck_offer_badges[ $loop_index ] ); ?></div>
                <?php endif; ?>

                <?php if ( ! $show_group_titles ) : ?>
                    <?php if ( $loop_index == 1 ) : ?>
                        <div class="gck-popular-badge">Najobľúbenejšie 🔥</div>
                    <?php endif; ?>

                    <?php if ( $loop_index == 3 ) : ?>
                        <div class="gck-popular-badge-2">Najnižšia cena 🔥</div>
                    <?php endif; ?>
                <?php endif; ?>

                <input type="radio"
                    required
                    name="bundle_option"
                    value="<?php echo esc_attr( $offer_id ); ?>"
                    data-total="<?php echo esc_attr( $data['total'] ); ?>"
                    data-qty="<?php echo esc_attr( $pairs ); ?>"
                    <?php checked( $is_default ); ?>>
                    
                    
                    
  

                <span class="gck-offer-head"><span class="bundle-option-title"><?php echo esc_html( $data['title'] ); ?></span>
                
                  <?php

    if (  !has_term( array( 'orto-starter' ), 'product_cat', $product_id ) 
    
    && !has_term( array( 'starter-paketi' ), 'product_cat', $product_id ) 
    
    )  :  ?>
                <?php if ( $show_price_highlights ) : ?>
                    <br class="gck-hl-break">
                    <span class="gck-offer-prices">
                    <span class="gck-per-chip">
                        <?php if ( $per_regular > (float) $data['per'] ) : ?>
                            <span class="gck-per-old"><?php echo number_format( $per_regular, 2 ); ?>€</span>
                        <?php endif; ?>
                        <span class="gck-per-new"><?php echo number_format( $gck_per_new, 2 ); ?>€ / ks</span>
                    </span>
                    <?php if ( $discount_pct > 0 ) : ?>
                        <span class="gck-discount-badge">−<?php echo (int) $discount_pct; ?>%</span>
                    <?php endif; ?>
                    </span><!-- /.gck-offer-prices -->
                <?php else : ?>
                    — <span class="bundle-option-title"><?php echo number_format( $gck_per_new, 2 ); ?>€ / ks</span>
                <?php endif; ?>
                
                
                <?php endif; ?>
                </span><!-- /.gck-offer-head -->

                <?php if ( ! empty( $gck_offer_subs ) && isset( $gck_offer_subs[ $loop_index ] ) ) : ?>
                  <span class="gck-offer-sub"><?php echo esc_html( $gck_offer_subs[ $loop_index ] ); ?></span>
                <?php endif; ?>
                

                <br/>

                <!--
                <div class="bundle-total-line">
                    <span style="font-weight:normal;">Ukupno:</span>
                    <span class="line-total"><?php echo number_format( (float) $data['total'], 2 ); ?>€</span>
                </div>

-->

<div class="bundle-total-line">
    <span style="font-weight:normal;">Celkom:</span>

    <?php if ( ! empty($data['regular']) && (float)$data['regular'] > (float)$data['total'] ) : ?>
        <span class="gck-regular-price">
            <?php echo number_format( (float) $data['regular'], 2 ); ?>€
        </span>
    <?php endif; ?>

    <span class="line-total"><?php echo number_format( (float) $data['total'], 2 ); ?>€</span>
</div>



                <div class="bundle-pairs <?php echo $is_default ? '' : 'hidden'; ?>"
                     data-offer-id="<?php echo esc_attr( $offer_id ); ?>"
                     data-qty="<?php echo esc_attr( $pairs ); ?>">

                    <?php
                    // Gratis labels: parse "X+Y" from offer title (X = paid, Y = gratis).
                    $gck_paid = 0;
                    $gck_free = 0;
                    if ( $show_gratis && preg_match( '/(\d+)\s*\+\s*(\d+)/u', (string) ( $data['title'] ?? '' ), $gck_m ) ) {
                        $gck_paid = (int) $gck_m[1];
                        $gck_free = (int) $gck_m[2];
                    }
                    $gck_show_sections = ( $show_gratis && ! $show_group_titles && ( $gck_paid + $gck_free ) > 0 && ! $gck_no_attrs );
                    ?>
                    <?php if ( $gck_shgifts ) : ?>
                    <?php
                    // ---- SHGIFTS: SHBOX-style split-garment selector, 3 groups (4+1+1) ----
                    // SAME markup/CSS as the SHBOX split path (.gck-pair-label section
                    // headers + .bundle-pair rows with .color-swatches + .gck-size-select).
                    // Colour/size OPTIONS come from the product's REAL (admin-managed)
                    // attributes — "Farba trička"/"Veľkosť trička", "Farba boxeriek"/
                    // "Veľkosť boxeriek", "Farba ponožiek"/"Veľkosť ponožiek" — grouped by
                    // the garment word via the same helper SHBOX uses ($attr_groups).
                    // Form field names stay stable (majica_color …) so cart/label capture
                    // and the socks-width CSS are unaffected. Falls back to hardcoded
                    // options if a garment group can't be resolved, so it never breaks.
                    // Each item gets its own pair index so all 6 selections reach the cart.
                    $gck_sections = array(
                        array(
                            'label'   => 'Vyber 4 tričká',
                            'gratis'  => false, 'count' => 4, 'gg' => 0, 'garment' => 'majica',
                            'ckey'    => 'majica_color', 'skey' => 'majica_size',
                            'colors'  => array( 'Čierna', 'Biela', 'Sivá', 'Béžová', 'Modrá', 'Hnedá', 'Zelená' ),
                            'sizes'   => array( 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL' ),
                        ),
                        array(
                            'label'   => 'Vyber 1 boxerky zdarma',
                            'gratis'  => true, 'count' => 1, 'gg' => 1, 'garment' => 'bokserica',
                            'ckey'    => 'bokserica_color', 'skey' => 'bokserica_size',
                            'colors'  => array( 'Čierna', 'Modrá', 'Sivá', 'Zelená', 'Červená' ),
                            'sizes'   => array( 'S', 'M', 'L', 'XL', '2XL', '3XL', '4XL' ),
                        ),
                        array(
                            'label'   => 'Vyber farbu ponožiek (5 párov)',
                            'gratis'  => true, 'count' => 1, 'gg' => 2, 'garment' => 'carapa',
                            'ckey'    => 'carapa_color', 'skey' => 'carapa_size',
                            'colors'  => array( 'Čierna', 'Biela' ),
                            'sizes'   => array( '39-43', '43-46' ),
                        ),
                    );

                    // Real, admin-managed option lists per garment from the grouped
                    // attributes ($attr_groups was built earlier with the SHBOX helper).
                    $gck_real = array();
                    foreach ( (array) $attr_groups as $grp ) {
                        $c   = $grp['color'] ?? null;
                        $s   = $grp['size'] ?? null;
                        $hay = strtolower(
                            (string) ( $c['label'] ?? '' ) . ' ' . (string) ( $c['key'] ?? '' ) . ' ' .
                            (string) ( $s['label'] ?? '' ) . ' ' . (string) ( $s['key'] ?? '' ) . ' ' .
                            (string) ( $grp['token'] ?? '' )
                        );
                        $cv = $c ? array_values( array_filter( array_map( 'strval', (array) ( $c['values'] ?? array() ) ), 'strlen' ) ) : array();
                        $sv = $s ? array_values( array_filter( array_map( 'strval', (array) ( $s['values'] ?? array() ) ), 'strlen' ) ) : array();
                        if ( strpos( $hay, 'majic' ) !== false )        { $gck_real['majica']    = array( 'colors' => $cv, 'sizes' => $sv ); }
                        elseif ( strpos( $hay, 'bokseric' ) !== false ) { $gck_real['bokserica'] = array( 'colors' => $cv, 'sizes' => $sv ); }
                        elseif ( strpos( $hay, 'carap' ) !== false )    { $gck_real['carapa']    = array( 'colors' => $cv, 'sizes' => $sv ); }
                    }

                    $gck_run = 0;
                    ?>
                    <?php foreach ( $gck_sections as $sec ) :
                        $garment    = (string) $sec['garment'];
                        // Prefer real attribute options; fall back to hardcoded per group.
                        $colors_use = ( ! empty( $gck_real[ $garment ]['colors'] ) ) ? $gck_real[ $garment ]['colors'] : $sec['colors'];
                        $sizes_use  = ( ! empty( $gck_real[ $garment ]['sizes'] ) )  ? $gck_real[ $garment ]['sizes']  : $sec['sizes'];
                    ?>
                        <div class="gck-pair-label<?php echo $sec['gratis'] ? ' is-gratis' : ''; ?>"><?php echo esc_html( $sec['label'] ); ?></div>
                        <?php for ( $k = 1; $k <= (int) $sec['count']; $k++ ) : $gck_run++; ?>
                        <div class="bundle-pair">
                            <div class="bundle-attr-row">
                                <?php if ( ! empty( $colors_use ) && $sec['ckey'] !== '' ) : ?>
                                    <div class="color-swatches"
                                         data-attr-key="<?php echo esc_attr( $sec['ckey'] ); ?>"
                                         data-name="pairs[<?php echo esc_attr( $offer_id ); ?>][<?php echo (int) $gck_run; ?>][<?php echo esc_attr( $sec['ckey'] ); ?>]">
                                        <?php foreach ( $colors_use as $val ) : $slug = sanitize_title( $val ); ?>
                                            <div class="swatch" data-value="<?php echo esc_attr( $val ); ?>" title="<?php echo esc_attr( $val ); ?>">
                                                <span class="swatch-circle color-<?php echo esc_attr( $slug ); ?>"></span>
                                            </div>
                                        <?php endforeach; ?>
                                        <input type="hidden" class="swatch-input"
                                               data-attr-key="<?php echo esc_attr( $sec['ckey'] ); ?>"
                                               name="pairs[<?php echo esc_attr( $offer_id ); ?>][<?php echo (int) $gck_run; ?>][<?php echo esc_attr( $sec['ckey'] ); ?>]"
                                               value="">
                                    </div>
                                <?php endif; ?>
                                <?php if ( ! empty( $sizes_use ) && $sec['skey'] !== '' ) : ?>
                                    <select class="gck-size-select"
                                            data-size-key="<?php echo esc_attr( $sec['skey'] ); ?>"
                                            data-garment-group="<?php echo (int) $sec['gg']; ?>"
                                            name="pairs[<?php echo esc_attr( $offer_id ); ?>][<?php echo (int) $gck_run; ?>][<?php echo esc_attr( $sec['skey'] ); ?>]">
                                        <?php foreach ( $sizes_use as $val ) : ?>
                                            <option value="<?php echo esc_attr( $val ); ?>"><?php echo esc_html( $val ); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endfor; ?>
                    <?php endforeach; ?>
                    <?php else : ?>
                    <?php
                    if ( $gck_split_garments ) {
                        $gck_passes = array(
                            array( 'group' => 0, 'label' => 'Vyber ' . (int) $pairs . ' ' . gck_sk_majice_phrase( $pairs, false, 'majica' ), 'gratis' => false ),
                            array( 'group' => 1, 'label' => 'Vyber ešte ' . (int) $pairs . ' ' . gck_sk_majice_phrase( $pairs, true, 'bokserica' ), 'gratis' => true ),
                        );
                    } else {
                        $gck_passes = array( array( 'group' => null, 'label' => null, 'gratis' => false ) );
                    }
                    ?>
                    <?php foreach ( $gck_passes as $gck_pass ) : ?>
                        <?php if ( $gck_pass['label'] !== null ) : ?>
                            <div class="gck-pair-label<?php echo $gck_pass['gratis'] ? ' is-gratis' : ''; ?>"><?php echo esc_html( $gck_pass['label'] ); ?></div>
                        <?php endif; ?>
                    <?php for ( $i = 1; $i <= $pairs; $i++ ) : ?>
                        <?php if ( $gck_pass['group'] === null && $gck_show_sections && $gck_paid > 0 && $i === 1 ) : ?>
                            <div class="gck-pair-label">Vyber <?php echo (int) $gck_paid; ?> <?php echo esc_html( gck_sk_majice_phrase( $gck_paid, false, $gck_garment ) ); ?></div>
                        <?php endif; ?>
                        <?php if ( $gck_pass['group'] === null && $gck_show_sections && $gck_free > 0 && $i === ( $gck_paid + 1 ) ) : ?>
                            <div class="gck-pair-label is-gratis">Vyber ešte <?php echo (int) $gck_free; ?> <?php echo esc_html( gck_sk_majice_phrase( $gck_free, true, $gck_garment ) ); ?></div>
                        <?php endif; ?>
                        <div class="bundle-pair">
                            <?php foreach ( $attr_groups as $g_index => $group ) :
                                if ( $gck_pass['group'] !== null && $g_index !== $gck_pass['group'] ) continue;

                                // Target group (field keys used for saving)
                                $target_c = $group['color'] ?? null;
                                $target_s = $group['size'] ?? null;

                                $target_color_field_key = $target_c ? (string)($target_c['field_key'] ?? '') : '';
                                $target_color_attr_key  = $target_c ? (string)($target_c['key'] ?? '') : '';
                                $target_size_field_key  = $target_s ? (string)($target_s['field_key'] ?? '') : '';
                                $target_size_attr_key   = $target_s ? (string)($target_s['key'] ?? '') : '';

                                // Source group (options shown to user)
                                $source_index = $g_index;
                                if ( $force_source_group !== null && isset($attr_groups[$force_source_group]) ) {
                                    $source_index = (int)$force_source_group;
                                }

                                $source_group = $attr_groups[$source_index] ?? $group;
                                $source_c = $source_group['color'] ?? null;
                                $source_s = $source_group['size'] ?? null;

                                $color_values = $source_c ? (array)($source_c['values'] ?? []) : [];
                                $size_values  = $source_s ? (array)($source_s['values'] ?? []) : [];

                                if ( empty($color_values) && empty($size_values) ) continue;

                                // Headings (p1/p2) in 4-attr case:
                                $group_title = '';
                                if ( $show_group_titles ) {
                                    if ( $g_index === 0 && $offer_p1 !== '' ) $group_title = $offer_p1;
                                    if ( $g_index === 1 && $offer_p2 !== '' ) $group_title = $offer_p2;
                                }
                            ?>
                                <?php if ( $show_group_titles && ! $gck_split_garments && $group_title !== '' ) : ?>
                                    <div class="gck-group-title"><?php echo esc_html($group_title); ?></div>
                                <?php endif; ?>

                                <div class="bundle-attr-row">

                                    <?php if ( ! empty($color_values) && $target_color_field_key !== '' && $gck_side_select ) : ?>
                                        <select class="gck-size-select gck-side-select"
                                                data-size-key="<?php echo esc_attr($target_color_attr_key); ?>"
                                                name="pairs[<?php echo esc_attr( $offer_id ); ?>][<?php echo $i; ?>][<?php echo esc_attr( $target_color_field_key ); ?>]">
                                            <?php foreach ( $color_values as $val ) : ?>
                                                <option value="<?php echo esc_attr( $val ); ?>"><?php echo esc_html( $val ); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php elseif ( ! empty($color_values) && $target_color_field_key !== '' ) : ?>
                                        <div class="color-swatches"
                                             data-attr-key="<?php echo esc_attr($target_color_attr_key); ?>"
                                             data-name="pairs[<?php echo esc_attr( $offer_id ); ?>][<?php echo $i; ?>][<?php echo esc_attr( $target_color_field_key ); ?>]">

                                            <?php foreach ( $color_values as $val ) :
                                                $slug = sanitize_title( $val ); ?>
                                                <div class="swatch" data-value="<?php echo esc_attr( $val ); ?>" title="<?php echo esc_attr( $val ); ?>">
                                                    <span class="swatch-circle color-<?php echo esc_attr( $slug ); ?>"></span>
                                                </div>
                                            <?php endforeach; ?>

                                            <input type="hidden"
                                                   class="swatch-input"
                                                   data-attr-key="<?php echo esc_attr($target_color_attr_key); ?>"
                                                   name="pairs[<?php echo esc_attr( $offer_id ); ?>][<?php echo $i; ?>][<?php echo esc_attr( $target_color_field_key ); ?>]"
                                                   value="">
                                        </div>
                                    <?php endif; ?>

                                    <?php if ( ! empty($size_values) && $target_size_field_key !== '' ) : ?>
                                        <select
                                            class="gck-size-select"
                                            data-size-key="<?php echo esc_attr($target_size_attr_key); ?>"
                                            name="pairs[<?php echo esc_attr( $offer_id ); ?>][<?php echo $i; ?>][<?php echo esc_attr( $target_size_field_key ); ?>]">
                                            <?php foreach ( $size_values as $val ) : ?>
                                                <option value="<?php echo esc_attr( $val ); ?>">
                                                    <?php // Oznaka „S - 34 – 36" (crka + EU razpon / mera), vrednost ostane gola crka.
                                                    echo esc_html( function_exists( 'noriks_velikost_oznaka' ) ? noriks_velikost_oznaka( $val, $product_id ) : $val ); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php endif; ?>

                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endfor; ?>
                    <?php endforeach; ?>
                    <?php endif; /* $gck_shgifts vs SHBOX/normal render */ ?>

                    <?php if ( ! $gck_no_attrs ) : ?>
                    <small style="display: block; line-height: 1;"><?php esc_html_e( 'Ponúkame 30 dní na vrátenie peňazí alebo výmenu – bezstarostný nákup!', 'gift-card-kompetentnost' ); ?></small>
                    <?php endif; ?>
                </div>
            </label>
        <?php
        $loop_index++;
        endforeach;
        ?>

        <input type="hidden" id="bundle_quantity" name="quantity" value="1">
    </div>

    <?php
    // Tablica velicina smije se izrisati SAMO jednom po stranici — inace nastanu
    // dupli ID-jevi #custom-size-chart-modal i klik otvori obje tablice.
    // noriks_size_chart_once() ujedno bira zensku tablicu za NORIKS FIT Woman.
    if ( function_exists( 'noriks_size_chart_once' ) ) {
        noriks_size_chart_once();
    } else {
        get_template_part( 'template_parts/size-chart-modal' );
    }
}

// ============================================================
// FRONTEND JS
// ============================================================

add_action( 'wp_footer', 'gck_bundle_js' );
function gck_bundle_js() {
    if ( ! is_product() ) return;

    global $post;
    if ( ! $post || $post->post_type !== 'product' ) return;
    if ( ! gck_is_orto_bundle_enabled( $post->ID ) ) return;
    ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const modal   = document.getElementById("custom-size-chart-modal");
    const openBtn = document.getElementById("open-size-chartCustom");
    const closeX  = document.getElementById("close-size-chart-x");
    if (!modal) return;

    openBtn?.addEventListener("click", function (e) { e.preventDefault(); modal.classList.add("show"); });
    closeX?.addEventListener("click", function () { modal.classList.remove("show"); });

    modal.addEventListener("click", function (e) {
        if (e.target === modal) modal.classList.remove("show");
    });

    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") modal.classList.remove("show");
    });
});

document.addEventListener('DOMContentLoaded', function () {

    // default color + size
    document.querySelectorAll('.bundle-pairs').forEach(wrap => {
        wrap.querySelectorAll('.bundle-pair').forEach(pair => {
            pair.querySelectorAll('.color-swatches').forEach(swGroup => {
                const firstSwatch = swGroup.querySelector('.swatch');
                const hidden      = swGroup.querySelector('.swatch-input');
                if (firstSwatch && hidden) {
                    swGroup.querySelectorAll('.swatch').forEach(s => s.classList.remove('active'));
                    firstSwatch.classList.add('active');
                    hidden.value = firstSwatch.dataset.value || '';
                }
            });
            pair.querySelectorAll('select').forEach(sel => {
                const firstOpt = sel.querySelector('option:nth-child(1)');
                if (firstOpt) sel.value = firstOpt.value;
            });
        });
    });

    const selector = document.getElementById('bundle-selector');
    if (!selector) return;

    const radios   = selector.querySelectorAll('input[name="bundle_option"]');
    const qtyField = document.getElementById('bundle_quantity');

    function updateBundleUI(selectedRadio) {
        const selectedOfferId = selectedRadio.value;

        selector.querySelectorAll('.bundle-option').forEach(card => card.classList.remove('active'));
        selectedRadio.closest('.bundle-option')?.classList.add('active');

        selector.querySelectorAll('.bundle-pairs').forEach(wrap => {
            const oid = wrap.getAttribute('data-offer-id');
            wrap.classList.toggle('hidden', oid !== selectedOfferId);
        });

        if (qtyField) qtyField.value = 1;

        const total = selectedRadio.dataset.total;
        const priceElem = document.querySelector('.cart .summary .price .woocommerce-Price-amount');
        if (priceElem && total) {
            priceElem.innerHTML = total.replace('.', ',') + ' €';
        }
    }

    radios.forEach(radio => {
        radio.addEventListener('change', function () { updateBundleUI(this); });
        if (radio.checked) updateBundleUI(radio);
    });

    // validation
    const form = document.querySelector('form.cart');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        const selectedRadio = selector.querySelector('input[name="bundle_option"]:checked');
        if (!selectedRadio) return;

        const offerId = selectedRadio.value;
        const wrap  = selector.querySelector('.bundle-pairs[data-offer-id="' + offerId + '"]');
        if (!wrap) return;

        let valid = true;

        wrap.querySelectorAll('.bundle-pair').forEach(pair => {
            pair.querySelectorAll('select').forEach(sel => {
                if (!sel.value) { valid = false; sel.classList.add('woocommerce-invalid'); }
                else sel.classList.remove('woocommerce-invalid');
            });

            pair.querySelectorAll('.swatch-input').forEach(hidden => {
                if (!hidden.value) { valid = false; hidden.classList.add('woocommerce-invalid'); }
                else hidden.classList.remove('woocommerce-invalid');
            });
        });

        if (!valid) {
            e.preventDefault();
            alert('Prosimo, izberite boju/barvu i veličinu za svaki set.');
        }
    });

    // swatches
    document.querySelectorAll('.color-swatches').forEach(swWrap => {
        const hidden = swWrap.querySelector('.swatch-input');
        if (!hidden) return;

        swWrap.querySelectorAll('.swatch').forEach(swatch => {
            swatch.addEventListener('click', () => {
                swWrap.querySelectorAll('.swatch').forEach(s => s.classList.remove('active'));
                swatch.classList.add('active');
                hidden.value = swatch.dataset.value || '';
                hidden.classList.remove('woocommerce-invalid');
            });
        });
    });

});

/* Size sync per size attribute */
document.addEventListener("DOMContentLoaded", function () {
    function activateSizeSync() {
        const selectorEl = document.getElementById('bundle-selector');
        const splitMode  = !!(selectorEl && selectorEl.dataset.splitGarments === '1');

        document.querySelectorAll('.bundle-pairs').forEach(pairBlock => {
            const scope = splitMode ? pairBlock : pairBlock.querySelector('.bundle-pair');
            if (!scope) return;

            scope.querySelectorAll('select.gck-size-select').forEach(firstSelect => {
                const sizeKey = firstSelect.dataset.sizeKey || '';
                if (!sizeKey) return;

                if (firstSelect.dataset.gckBound === '1') return;
                firstSelect.dataset.gckBound = '1';

                firstSelect.addEventListener('change', function () {
                    const newSize  = this.value;
                    const selector = document.getElementById('bundle-selector');
                    if (!selector) return;

                    const sel = splitMode
                        ? 'select.gck-size-select'
                        : 'select.gck-size-select[data-size-key="' + CSS.escape(sizeKey) + '"]';

                    selector
                        .querySelectorAll(sel)
                        .forEach(s => { if (s !== this) s.value = newSize; });
                });
            });
        });
    }

    activateSizeSync();

    document.querySelectorAll('#bundle-selector input[name="bundle_option"]').forEach(radio => {
        radio.addEventListener('change', function () {
            setTimeout(activateSizeSync, 50);
        });
    });
});
</script>
<?php
}

// ============================================================
// CART / ORDER LOGIC
// ============================================================

/**
 * Build cart/order lines.
 *
 * ✅ 2-attribute case: returns "Crna - L"
 * ✅ 4-attribute case: uses offer p1/p2 and returns TWO lines per pair:
 *   "P1: X - Y"
 *   "P2: X - Y"
 *
 * NOTE: It assumes post order is:
 *   color1, size1, color2, size2
 * (this remains TRUE even when tip=majica/bokserica because we kept distinct field keys)
 */
function gck_build_pair_lines( array $pairs_data, string $p1 = '', string $p2 = '' ) : array {
    $lines = [];

    foreach ( $pairs_data as $index => $attrs ) {
        if ( ! is_array( $attrs ) ) continue;

        $values = array_values( $attrs );
        $clean  = [];

        foreach ( $values as $v ) {
            $v = trim((string)$v);
            if ( $v !== '' ) $clean[] = $v;
        }

        if ( empty($clean) ) continue;

        if ( $p1 !== '' && $p2 !== '' && count($clean) >= 4 ) {
            $g1 = array_slice($clean, 0, 2);
            $g2 = array_slice($clean, 2, 2);

            $lines[] = $p1 . ': ' . implode(' - ', $g1);
            $lines[] = $p2 . ': ' . implode(' - ', $g2);
            continue;
        }

        $lines[] = implode(' - ', $clean);
    }

    return $lines;
}

/**
 * SHGIFTS (orto-majica-darila) line builder.
 *
 * The SHBOX-style 4+1+1 selector submits ONE pair index per chosen item — six in
 * total: tričko 1-4 (colour+size), boxerky (colour+size), ponožky (colour+size).
 * Each line is labelled by inspecting its field keys so the cart / order clearly
 * shows which garment was picked, e.g. "Tričko: Čierna - L", "Boxerky: Modrá - M",
 * "Ponožky: Čierna - 39-43".
 */
function gck_build_shgifts_lines( array $pairs_data ) : array {
    $lines = [];

    foreach ( $pairs_data as $attrs ) {
        if ( ! is_array( $attrs ) ) continue;

        $label = '';
        foreach ( array_keys( $attrs ) as $k ) {
            $kl = strtolower( (string) $k );
            if ( strpos( $kl, 'majic' ) !== false )    { $label = 'Tričko';  break; }
            if ( strpos( $kl, 'bokseric' ) !== false ) { $label = 'Boxerky'; break; }
            if ( strpos( $kl, 'carap' ) !== false )    { $label = 'Ponožky'; break; }
        }

        $clean = [];
        foreach ( $attrs as $v ) {
            $v = trim( (string) $v );
            if ( $v !== '' ) $clean[] = $v;
        }
        if ( empty( $clean ) ) continue;

        $line    = implode( ' - ', $clean );
        $lines[] = ( $label !== '' ) ? ( $label . ': ' . $line ) : $line;
    }

    return $lines;
}

add_filter( 'woocommerce_add_cart_item_data', 'gck_add_cart_item_data', 10, 3 );
function gck_add_cart_item_data( $cart_item_data, $product_id, $variation_id ) {

    $offer_id = isset( $_POST['bundle_option'] ) ? sanitize_text_field( wp_unslash( $_POST['bundle_option'] ) ) : '';

    if ( ! gck_is_orto_bundle_enabled( $product_id ) || $offer_id === '' ) {
        return $cart_item_data;
    }

    $offers = gck_get_bundle_offers( $product_id );
    if ( empty( $offers ) || ! isset( $offers[ $offer_id ] ) ) {
        return $cart_item_data;
    }

    $offer          = $offers[ $offer_id ];
    $pairs_selected = (int) ( $offer['qty'] ?? 0 );
    if ( $pairs_selected <= 0 ) {
        return $cart_item_data;
    }

    $p1 = trim((string)($offer['p1'] ?? ''));
    $p2 = trim((string)($offer['p2'] ?? ''));

    $pairs_all  = isset( $_POST['pairs'] ) ? (array) $_POST['pairs'] : [];
    $pairs_data = isset( $pairs_all[ $offer_id ] ) ? (array) $pairs_all[ $offer_id ] : [];

    // SHGIFTS (orto-majica-darila): 6 items (4 tričko + 1 boxerky + 1 ponožky),
    // each under its own pair index, labelled by garment. Strictly gated to that
    // category; SHBOX and every other product keep the original p1/p2 builder.
    if ( has_term( 'orto-majica-darila', 'product_cat', $product_id ) ) {
        $lines = gck_build_shgifts_lines( $pairs_data );
    } else {
        $lines = gck_build_pair_lines( $pairs_data, $p1, $p2 );
    }

    $total      = (float) $offer['total'];
    $unit_price = $total;

    $cart_item_data['_orto_offer_id']          = $offer_id;
    $cart_item_data['_orto_offer_title']       = (string) ( $offer['title'] ?? '' );
    $cart_item_data['_orto_bundle_pairs']      = $pairs_selected;
    $cart_item_data['_orto_bundle_total']      = $total;
    $cart_item_data['_orto_bundle_unit_price'] = $unit_price;
    $cart_item_data['_orto_pairs_json']        = wp_json_encode( $pairs_data );
    $cart_item_data['_orto_lines']             = $lines;

    $cart_item_data['_orto_p1'] = $p1;
    $cart_item_data['_orto_p2'] = $p2;

    $cart_item_data['orto_unique_key'] = md5( microtime( true ) . wp_rand() . serialize( $cart_item_data ) );

    return $cart_item_data;
}

function gck_apply_price_to_cart_item( $cart_item ) {
    if ( isset( $cart_item['_orto_bundle_unit_price'] ) && $cart_item['data'] instanceof WC_Product ) {
        $price = (float) $cart_item['_orto_bundle_unit_price'];
        if ( $price > 0 ) {
            $cart_item['data']->set_price( $price );
        }
    }
    return $cart_item;
}

add_filter( 'woocommerce_add_cart_item', 'gck_add_cart_item_apply_price', 20, 2 );
function gck_add_cart_item_apply_price( $cart_item, $cart_item_key ) {
    return gck_apply_price_to_cart_item( $cart_item );
}

add_filter( 'woocommerce_get_cart_item_from_session', 'gck_session_cart_item_apply_price', 20, 2 );
function gck_session_cart_item_apply_price( $cart_item, $values ) {
    if ( isset( $values['_orto_bundle_unit_price'] ) ) $cart_item['_orto_bundle_unit_price'] = $values['_orto_bundle_unit_price'];
    if ( isset( $values['_orto_lines'] ) ) $cart_item['_orto_lines'] = $values['_orto_lines'];
    if ( isset( $values['_orto_offer_id'] ) ) $cart_item['_orto_offer_id'] = $values['_orto_offer_id'];
    if ( isset( $values['_orto_offer_title'] ) ) $cart_item['_orto_offer_title'] = $values['_orto_offer_title'];
    if ( isset( $values['_orto_p1'] ) ) $cart_item['_orto_p1'] = $values['_orto_p1'];
    if ( isset( $values['_orto_p2'] ) ) $cart_item['_orto_p2'] = $values['_orto_p2'];
    return gck_apply_price_to_cart_item( $cart_item );
}

add_action( 'woocommerce_before_calculate_totals', 'gck_adjust_bundle_price', 9999 );
function gck_adjust_bundle_price( $cart ) {
    if ( ! $cart instanceof WC_Cart ) return;
    foreach ( $cart->get_cart() as $key => &$item ) {
        $item = gck_apply_price_to_cart_item( $item );
    }
}

add_filter( 'woocommerce_get_item_data', 'gck_display_item_data', 10, 2 );
function gck_display_item_data( $item_data, $cart_item ) {

    if ( empty( $cart_item['_orto_lines'] ) || ! is_array( $cart_item['_orto_lines'] ) ) {
        return $item_data;
    }

    $lines     = array_values( $cart_item['_orto_lines'] );
    $numbered  = [];
    foreach ( $lines as $i => $line ) {
        $numbered[] = ( $i + 1 ) . ': ' . $line;
    }

    $value = implode( '<br>', array_map( 'esc_html', $numbered ) );

    $item_data[] = array(
        'name'    => false,
        'display' => $value,
    );

    return $item_data;
}

add_action( 'woocommerce_checkout_create_order_line_item', 'gck_order_item_meta', 10, 4 );
function gck_order_item_meta( $item, $cart_item_key, $values, $order ) {

    // Proizvodi S atributima: jedan redak meta po komadu (velicina/boja).
    if ( ! empty( $values['_orto_lines'] ) && is_array( $values['_orto_lines'] ) ) {
        $lines = array_values( $values['_orto_lines'] );
        foreach ( $lines as $i => $line ) {
            $item->add_meta_data( (string) ( $i + 1 ), sanitize_text_field( $line ), true );
        }
    } elseif ( ! empty( $values['_orto_bundle_pairs'] ) ) {
        // Proizvodi BEZ atributa (bunion, fisiorest, ControlPro ...): nema izbora
        // velicine/boje, pa se broj komada nigdje ne bi vidio (kolicina retka ostaje 1
        // jer je cijena paketna). Zapisi ISTI oblik mete kao kod proizvoda s atributima
        // — jedan numerirani redak po komadu.
        $qty_pairs = (int) $values['_orto_bundle_pairs'];
        $item_name = '';
        if ( isset( $values['data'] ) && $values['data'] instanceof WC_Product ) {
            $item_name = $values['data']->get_name();
        }
        if ( $item_name === '' ) {
            $item_name = $item->get_name();
        }
        for ( $i = 1; $i <= $qty_pairs; $i++ ) {
            $item->add_meta_data( (string) $i, sanitize_text_field( $item_name ), true );
        }
    }
    // Skrivena meta (izvjestaji) — uvijek, neovisno o atributima.
    if ( ! empty( $values['_orto_bundle_pairs'] ) ) {
        $item->add_meta_data( '_bundle_pairs', (int) $values['_orto_bundle_pairs'], true );
    }

    if ( ! empty( $values['_orto_offer_id'] ) ) {
        $item->add_meta_data( '_offer_id', sanitize_text_field( $values['_orto_offer_id'] ), true );
    }
}

// ============================================================
// SHGIFTS FREE-GIFTS INFO STRIP (display only, orto-majica-darila)
// ============================================================
/**
 * Purely informational "free gifts" strip shown UNDER the add-to-cart button on
 * the SHGIFTS product (category orto-majica-darila). It only DISPLAYS what comes
 * free with the purchase — no inputs, no selects, no swatches, no JS, no cart
 * interaction. Completely self-contained and does not touch the bundle selector
 * or cart logic. Strictly gated to the orto-majica-darila category.
 */
add_action( 'woocommerce_after_add_to_cart_button', 'gck_shgifts_free_gifts_notice', 20 );
function gck_shgifts_free_gifts_notice() {

    if ( ! function_exists( 'is_product' ) || ! is_product() ) {
        return;
    }

    global $product;
    if ( ! $product instanceof WC_Product ) {
        return;
    }
    if ( ! has_term( 'orto-majica-darila', 'product_cat', $product->get_id() ) ) {
        return;
    }

    // Gifts shown: 1x boxerky + 5x pár ponožiek. Images + crossed-out reference
    // prices are editable placeholders — adjust to real photos/prices.
    $boxer_img = 'https://noriks.com/hr/wp-content/uploads/2026/01/StarterPack_2xcrnaboksarica.png';
    $socks_img = 'https://noriks.com/hr/wp-content/uploads/2025/11/stumfi_crni3942-683x1024.jpg.webp';

    $gifts = array(
        array( 'label' => '1x boxerky', 'img' => $boxer_img, 'price' => '19,99 €' ),
    );
    for ( $i = 0; $i < 5; $i++ ) {
        $gifts[] = array( 'label' => '1x pár ponožiek', 'img' => $socks_img, 'price' => '12,99 €' );
    }
    ?>
    <style>
      .gck-fg{
          margin:16px 0 6px;
          background:#f4f4f4;
          border:1px solid #e2e2e2;
          border-radius:9px;
          overflow:hidden;
      }
      .gck-fg__head{
          background:linear-gradient(90deg,#111 0%,#2b2b2b 55%,#3d3d3d 100%);
          color:#fff;
          font-weight:700;
          font-size:15px;
          text-align:center;
          letter-spacing:.3px;
          padding:12px 14px;
      }
      .gck-fg__grid{
          display:flex;
          flex-wrap:nowrap;
          gap:8px;
          justify-content:center;
          padding:18px 12px 14px;
      }
      .gck-fg__card{
          flex:1 1 0;
          min-width:0;
          box-sizing:border-box;
          background:#fff;
          border:1.5px dashed #c9c9c9;
          border-radius:4px;
          padding:16px 6px 9px;
          text-align:center;
          position:relative;
      }
      .gck-fg__badge{
          position:absolute;
          top:-10px; left:50%; transform:translateX(-50%);
          background:#111;
          color:#fff;
          font-size:10px;
          font-weight:800;
          letter-spacing:1px;
          padding:3px 10px;
          border-radius:4px;
          text-transform:uppercase;
          white-space:nowrap;
          box-shadow:0 1px 2px rgba(0,0,0,.18);
      }
      .gck-fg__img{
          width:100%;
          max-width:100%;
          height:74px;
          object-fit:contain;
          margin:6px auto 8px;
          display:block;
      }
      .gck-fg__label{ font-weight:600; font-size:13px; color:#222; }
      .gck-fg__price{ font-size:12px; margin-top:2px; }
      .gck-fg__price s{ color:#8c8c8c; }
      @media (max-width:600px){
          .gck-fg__grid{ flex-wrap:wrap; }
          .gck-fg__card{ flex:1 1 28%; min-width:88px; }
          .gck-fg__img{ height:60px; }
      }
    </style>
    <div class="gck-fg">
        <div class="gck-fg__head">6 tovarov ZADARMO ku každému nákupu</div>
        <div class="gck-fg__grid">
            <?php foreach ( $gifts as $g ) : ?>
                <div class="gck-fg__card">
                    <span class="gck-fg__badge">Zadarmo</span>
                    <img class="gck-fg__img" src="<?php echo esc_url( $g['img'] ); ?>" alt="<?php echo esc_attr( $g['label'] ); ?>" loading="lazy">
                    <div class="gck-fg__label"><?php echo esc_html( $g['label'] ); ?></div>
                    <div class="gck-fg__price"><s><?php echo esc_html( $g['price'] ); ?></s></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}
