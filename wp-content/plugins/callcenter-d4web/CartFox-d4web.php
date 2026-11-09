<?php
/*
Plugin Name: Call center - abandon cart - D4web
Description: all center - abandon cart - D4web.
Author: D4web
Version: 1.0.0
*/

add_action('wp_footer', 'd4web_register_input_change'); 
function d4web_register_input_change() {
	$countries_obj   = new WC_Countries();
	$default_country = $countries_obj->get_base_country();

	$cm_options = get_option( 'cartfox_settings' );

    ?>
		<script type="text/javascript">
			var script_timeout = 0;
			if(document.getElementById("fc-wrapper")) script_timeout = 2000;
			setTimeout(function(){
				function setCookie(key, value, expiry) {
			        var expires = new Date();
			        expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
			        document.cookie = key + '=' + value + ';path=/;expires=' + expires.toUTCString();
			    }
			    
			    function getCookie(key) {
	                var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
	                return keyValue ? keyValue[2] : null;
	            }

				var cm_ajax_running = false;
				var cm_ajax_queue = false;

				var plugins_additional_selectors = ", .woocommerce-checkout input, .woocommerce-checkout select, .woocommerce-checkout textarea";

				<?php if(isset($cm_options["cartfox_special_checkout_fields"]) && $cm_options["cartfox_special_checkout_fields"] != ""): ?>
					plugins_additional_selectors += ", input, select, textarea";
    			<?php endif; ?>

				jQuery(function($){
					$('.woocommerce-billing-fields input, .woocommerce-billing-fields select, .woocommerce-billing-fields textarea' + plugins_additional_selectors).on('change', function () {
						var billing_inputs = $("input[name^=billing_], select[name^=billing_], input[name^=shipping_], select[name^=shipping_]");
						var cm_data = [];
						$.each(billing_inputs, function(i, e){

							if(e.name == "billing_cf_optin"){
								e.value = 0;
								if($(e).is(':checked')){
									e.value = 1;
								}
							}

							cm_data[i] = {"key": e.name, "value": e.value};
						});

					    var data = {
					        action: 'd4web_send_data',
					        cm_data: cm_data,
					    };

					    ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ) ?>';

					    if($("input[name=billing_phone]").val() != ""){
						    $.ajax({
								type: "POST",
								url: ajaxurl,
								data: data,
								beforeSend: function() {
									if(cm_ajax_running == true){
										console.log("d4web: Request already running");
										cm_ajax_queue = true;
										return false;
									}

									cm_ajax_running = true;
								},
								success: function(response) {
									console.log(response);						        	
								}
							});

						    //jQuery.post(ajaxurl, data, function(response) {
						    //    console.log(JSON.parse(response));
						    //});
						}
					});

					if(document.getElementById("fc-wrapper")){
						$("input[name=billing_phone]").trigger("change");
					}
				});
			}, script_timeout);
		</script>
	<?php 

}

add_action('wp_ajax_nopriv_d4web_send_data', 'd4web_send_data_d4web');
add_action('wp_ajax_d4web_send_data', 'd4web_send_data_d4web');
function d4web_send_data_d4web() {

    global $wp, $wpdb, $woocommerce, $post, $post_id;
    $cm_options = get_option( 'cartfox_settings' );
   

    $contact_info = [];

    if(!isset($_REQUEST['cm_data'])){
    	echo json_encode("CartFox error: Form data could not be loaded.");
		wp_die();
    }

    foreach($_REQUEST['cm_data'] as $cd){
    	$cd = (object)$cd;

    	if($cd->key == "billing_email" || $cd->key == "shipping_email"){
			$contact_info[$cd->key] = sanitize_email($cd->value);
		} else {
			$contact_info[$cd->key] = sanitize_text_field($cd->value);
		}
    }

    $contact_info["name"] = $contact_info["billing_first_name"] . " " . $contact_info["billing_last_name"];
    $contact_info["phone"] = $contact_info["billing_phone"];
    $contact_info["email"] = $contact_info["billing_email"];
    $contact_info["address"] = $contact_info["billing_address_1"];
    $contact_info["house_number"] = $contact_info["billing_houseno"];
    $contact_info["city"] = $contact_info["billing_city"];
    $contact_info["post_number"] = $contact_info["billing_postcode"];
    $contact_info["country"] = $contact_info["billing_country"];

    if($contact_info["phone"] == ""){
    	echo json_encode("CartFox warning: data not sent - phone is empty");
		wp_die();
    }

    $cart_products = [];
    foreach ( WC()->cart->get_cart() as $cart_item ) {
        $product = $cart_item['data'];

        $line_price = $cart_item["new_price"];
        if(!$line_price || $line_price == 0){
        	$line_price = $cart_item["line_total"];
        }
		// link - > UP 
        if(!empty($product)){
            $cart_products[] = [
            	"id" => $product->get_sku(),
            	"name" => $product->get_title(),
            	"currency" => get_option('woocommerce_currency'),
            	"quantity" => $cart_item["quantity"],
            	"price" =>  $cart_item["line_total"],
            	"wp_product_id" => $cart_item["product_id"],
            	"wp_variation_id" => $cart_item["variation_id"],
				"link" => get_permalink($product->get_id()),
				"upsale" =>  isset($cart_item["upsPrice"]) ? $cart_item["upsPrice"] : false 
            ];
        }
    }


	$fees = [];
	foreach ( WC()->cart->get_fees() as $fee ){
		$fees[] =[
		 'id' => $fee->id,
		 'name' => $fee->get_name(),
		 'total' => $fee->get_total()
		];
	}

	global $woocommerce;
    $available_gateways = $woocommerce->payment_gateways->get_available_payment_gateways();
	$current_gateway = '';
    if ( ! empty( $available_gateways ) && !is_cart() ) {
           // Chosen Method
        if ( isset( $woocommerce->session->chosen_payment_method ) && isset( $available_gateways[ $woocommerce->session->chosen_payment_method ] ) ) {
            $current_gateway = $available_gateways[ $woocommerce->session->chosen_payment_method ];
        } elseif ( isset( $available_gateways[ get_option( 'woocommerce_default_gateway' ) ] ) ) {
            $current_gateway = $available_gateways[ get_option( 'woocommerce_default_gateway' ) ];
        } else {
            $current_gateway =  current( $available_gateways );

        }
    }
	if($current_gateway!='' ){        
        $current_gateway_id = $current_gateway->id;
		$extra_charges_id = 'woocommerce_'.$current_gateway_id.'_extra_charges';
		$extra_charges = (float)get_option( $extra_charges_id);
		$fees['my_payment']= [$current_gateway_id => $extra_charges];
	}
	if(!isset($fees['insurance'])){
		if(get_field("cena_zavarovanje","options")){
			$fees['insurance']= get_field("cena_zavarovanje","options");	
	   }
	}

	$addOns = [
		"shiping" => WC()->cart->get_shipping_total()
	];

	$total = WC()->cart->get_total('');
    $cm_default_country =  sanitize_text_field($cm_options["cartfox_default_country"]);


	if(isset($contact_info["country"])) $cm_default_country = $contact_info["country"];


	$cf_checkout_url = str_replace(get_site_url(), "", wc_get_checkout_url()) . '?cartfox_return_to_checkout=1';

    $config = [
    	"country" => $cm_default_country,
    	"autofill" => true,
    	"order_id" => "",
    	"checkout_url" => $cf_checkout_url,
    ]; 

	if(isset($_COOKIE['cf_sid'])) {
		$ses_id = sanitize_text_field($_COOKIE['cf_sid']);
	} else{
		$ses_id = false;
	}


	
    $payload = [
    	"domain_host" => get_site_url(),
    	"config" => $config,
    	"data" => $contact_info,
    	"sent_timestamp" => time(),
    	"session_id" => $ses_id,
    	"shopping_cart" => $cart_products,
		"fees" => $fees,
		"addOns" => $addOns,
		"total" => $total,
		"metadata" => []
    ];

	if (isset($_COOKIE['campaignID'])) {
        $payload['metadata']['campaignID'] = $_COOKIE['campaignID'];
    }
    if (isset($_COOKIE['adID'])) {
		$payload['metadata']['adID'] = $_COOKIE['adID'];
    }
    if (isset($_COOKIE['sku'])) {
        $payload['metadata']['sku'] = $_COOKIE['sku'];
    }
    if (isset($_COOKIE['adSetID'])) {
		$payload['metadata']['adSetID'] = $_COOKIE['adSetID'];
    }
    if (isset($_COOKIE['biznis'])) {
        $payload['metadata']['adSetID'] = $_COOKIE['biznis'];
    }
    if (isset($_COOKIE['myfbclid'])) {
		$payload['metadata']['myfbclid'] = $_COOKIE['myfbclid'];
    }	
    if (isset($_COOKIE['cartboss'])) {
        $payload['metadata']['myfbclid'] = $_COOKIE['myfbclid'];
    }	
    if (isset($_COOKIE['gklaviyo'])) {
        $payload['metadata']['gklaviyo'] = $_COOKIE['gklaviyo'];
    }
    if (isset($_COOKIE['utm_cookie_my'])) {
        $payload['metadata']['utm_cookie_my'] = $_COOKIE['utm_cookie_my'];
    }  
    if (isset($_COOKIE['shipping_rate_my'])) {
        $payload['metadata']['shipping_rate_my'] = $_COOKIE['shipping_rate_my'];
	}

    $payload = $payload;


    $cf_api_data = json_encode($payload);
	
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://avtomatika.d4web.eu/callcenter/event_reciver.php',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'PUT',
	  CURLOPT_POSTFIELDS =>$cf_api_data,
	  CURLOPT_HTTPHEADER => array(
		'Content-Type: application/json'
	  ),
	));
	
	$response = curl_exec($curl);
	
	curl_close($curl);
	echo $response;
    $cf_response = json_decode($response, false);

    if($cf_response->status == "success"){      
		
		setcookie('d4web_ab', sanitize_text_field($cf_response) , time()+86400);
        echo json_encode($cf_response);
		wp_die();
	} else {
		echo json_encode($cf_response);
		setcookie('d4web_ab', sanitize_text_field($cf_response) , time()+86400);
		wp_die();
	}

}

add_action( 'woocommerce_new_order', 'd4web_send_purchase_request');
add_action( 'woocommerce_checkout_order_processed', 'd4web_send_purchase_request');
function d4web_send_purchase_request( $order_id ) {	
	if(isset($_COOKIE['cf_sid'])){
		$order = wc_get_order( $order_id );
		$order->add_meta_data('my_session_id', $_COOKIE['cf_sid']);
		$order->save();
	} 	
}