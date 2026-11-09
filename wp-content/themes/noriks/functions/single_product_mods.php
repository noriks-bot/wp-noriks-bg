<?php 


// Append plain-text price to the single Add to Cart button (works for simple + variable).

add_filter( 'woocommerce_product_single_add_to_cart_text', 'my_add_price_to_button_text', 99, 2 );

function my_add_price_to_button_text( $text, $prod = null ) {

    // Fallback to global $product if the filter didn't pass it
    if ( ! $prod || ! is_a( $prod, 'WC_Product' ) ) {
        global $product;
        if ( $product instanceof WC_Product ) {
            $prod = $product;
        } else {
            return $text;
        }
    }

    // If product is in category "orto", return default text (unchanged)
    if ( has_term( 'orto', 'product_cat', $prod->get_id() ) ) {
        return $text;
    }

    $price_text = '';

    if ( $prod->is_type( 'simple' ) ) {
        // Display price (respects tax settings & sale price)
        $display_price = wc_get_price_to_display( $prod );
        if ( $display_price !== '' && $display_price !== null ) {
            $price_text = wp_strip_all_tags( wc_price( $display_price ) );
        }

    } elseif ( $prod->is_type( 'variable' ) ) {
        // Show the MIN variation price (clean text)
        $min_var_price = $prod->get_variation_price( 'min', true );
        $display_min   = wc_get_price_to_display( $prod, array( 'price' => $min_var_price ) );
        $price_text    = wp_strip_all_tags( wc_price( $display_min ) );

    } else {
        // Leave other product types unchanged
        return $text;
    }

    if ( $price_text ) {
        // Remove any previous " - …" to avoid duplication from other filters
        $base_text = preg_replace( '/\s*-\s*.*$/', '', $text );
        return trim( $base_text ) . ' - ' . $price_text;
    }

    return $text;
}





// Change only the sticky bar button (text + href) on single product pages.
add_action( 'wp_footer', function () {
	if ( ! is_product() ) return; ?>
	<script>
	document.addEventListener('DOMContentLoaded', function () {
	  var btn = document.querySelector('.storefront-sticky-add-to-cart__content-button');
	  if (!btn) return;
	  btn.textContent = 'Späť na výber';
	  btn.setAttribute('href', '#title-buy-now'); // put your desired URL here
	});
	</script>
<?php
} );





add_action( 'woocommerce_before_variations_form', function() {
    noriks_size_chart_once();
    noriks_size_chart_secondary_once();
});



add_action( 'after_setup_theme', 'remove_storefront_product_image_zoom', 99 );
function remove_storefront_product_image_zoom() {
    remove_theme_support( 'wc-product-gallery-zoom' );
}




// Hide the FlexSlider prev/next arrows natively (don't render them at all)
add_filter( 'woocommerce_single_product_carousel_options', function ( $options ) {
    $options['directionNav'] = false; // no prev/next arrows

    return $options;
} );


/**
 * ControlPro: kartica jedne recenzije neposredno ispod ADD TO CART gumba.
 */
add_action( 'woocommerce_after_add_to_cart_button', 'noriks_controlpro_atc_testimonial', 25 );
function noriks_controlpro_atc_testimonial() {
    if ( ! function_exists( 'noriks_is_type' ) || ! noriks_is_type( 'controlpro' ) ) {
        return;
    }
    $avatar = get_template_directory_uri() . '/img/controlpro/10-kupac-avatar.jpg';
    ?>
    <div class="cpr-atc-rev">
        <img class="cpr-atc-avatar" src="<?php echo esc_url( $avatar ); ?>" alt="Spokojný zákazník NORIKS ControlPro" loading="lazy">
        <div class="cpr-atc-body">
            <p class="cpr-atc-text">„Po operácii prostaty som dva roky pravidelne robil Kegelove cviky a nevidel som väčší pokrok. Myslel som, že budem do konca života nosiť vložky. Štyri týždne s týmto prístrojom a z 5 vložiek denne som klesol na nulu."</p>
            <div class="cpr-atc-foot">
                <span class="cpr-atc-name">Robert T. 73</span>
                <span class="cpr-atc-stars">★★★★★</span>
            </div>
        </div>
    </div>
    <style>
        .cpr-atc-rev { display: flex; gap: 14px; align-items: flex-start; margin: 16px 0 6px; clear: both;
                       background: #f6f6f6; border-radius: 12px; padding: 16px 18px; }
        .cpr-atc-avatar { width: 56px; height: 56px; border-radius: 50%; object-fit: cover; flex: 0 0 56px; display: block; margin: 2px 0 0; }
        .cpr-atc-body { flex: 1 1 auto; min-width: 0; }
        .cpr-atc-text { font-size: 14.5px; line-height: 1.5; font-style: italic; color: #222; margin: 0 0 8px; }
        .cpr-atc-foot { display: flex; align-items: center; gap: 12px; border-top: 1px solid #e2e2e2; padding-top: 8px; }
        .cpr-atc-name { font-size: 13.5px; font-style: italic; color: #7a7a7a; }
        .cpr-atc-stars { color: #f5b301; font-size: 15px; letter-spacing: 1px; }
        @media (max-width: 600px) {
            .cpr-atc-rev { gap: 10px; padding: 13px 14px; border-radius: 10px; }
            .cpr-atc-avatar { width: 46px; height: 46px; flex: 0 0 46px; }
            .cpr-atc-text { font-size: 13.5px; }
        }
    </style>
    <?php
}
