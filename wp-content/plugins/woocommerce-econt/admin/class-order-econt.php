<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if(!class_exists('Econt_Admin_Order')) {

	class Econt_Admin_Order {
		private $data;

		public function __construct() {
			//add meta box to order details
			add_action( 'add_meta_boxes', array( &$this, 'add_meta_boxes' ) );
			
			//add my css and js scripts 
			add_action( 'wp_enqueue_scripts', array( &$this,'econt_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( &$this,'econt_scripts' ) );

			//add orders overview econt column
			add_filter( 'manage_edit-shop_order_columns', array(&$this, 'econt_add_orders_overview_columns') );
			//HPOS
			add_filter( 'manage_woocommerce_page_wc-orders_columns', array(&$this, 'econt_add_orders_overview_columns') );

			//orders overview econt column values
			add_action( 'manage_shop_order_posts_custom_column', array(&$this, 'econt_orders_overview_columns_values'), 10, 2 );
			add_action( 'manage_woocommerce_page_wc-orders_custom_column', array( $this, 'econt_orders_overview_columns_values' ), 10, 2 );

			//show chosen econt office in admin panel - order
            add_action('woocommerce_admin_order_data_after_billing_address', array($this, 'econt_offices_checkout_field_display_admin_order_meta'), 10, 1);
            if( get_option('econt_auto_refreshdata') == 1 ){
	            //auto update Econt addresses and offices
	            add_filter( 'cron_schedules', array( $this, 'econt_custom_cron_schedule') );
				//Schedule an action if it's not already scheduled
				if ( ! wp_next_scheduled( 'econt_cron_refreshdata_hook' ) ) {
				    wp_schedule_event( time(), 'every_24_hours', 'econt_cron_refreshdata_hook' );
				}
				
				//Hook into that action that'll fire every 24 hours
			 	add_action( 'econt_cron_refreshdata_hook',  array( $this, 'econt_auto_refreshdata') );
		 	}
		 	if( get_option('econt_auto_refreshdata_intl') == 1 ){
	            //auto update Econt addresses and offices
	            add_filter( 'cron_schedules', array( $this, 'econt_custom_cron_schedule_intl') );
				//Schedule an action if it's not already scheduled
				if ( ! wp_next_scheduled( 'econt_cron_refreshdata_intl_hook' ) ) {
				    wp_schedule_event( time(), 'monthly', 'econt_cron_refreshdata_intl_hook' );
				}
				
				//Hook into that action that'll fire every month
			 	add_action( 'econt_cron_refreshdata_intl_hook',  array( $this, 'econt_auto_refreshdata_intl') );
		 	}
		 	//Add settings link in plugins list
		 	add_filter('plugin_action_links', array($this, 'plugin_link_setting'), 10, 2);
		 	
		 	//Calculate and add shipping cost if it is not calculated  and added on Checkout
		 	add_action( 'woocommerce_checkout_order_processed', array($this, 'check_shipping_cost'),  1, 1  );

		 	// Adding to admin order list bulk dropdown a custom action 'create_econt_loadings'
		 	add_filter( 'bulk_actions-edit-shop_order', array($this, 'create_loadings_bulk_actions'), 20, 1 );
			//HPOS
			add_filter( 'bulk_actions-woocommerce_page_wc-orders', array($this, 'create_loadings_bulk_actions'), 20, 1 );

			// Bulk create loadings for selected orders
			//add_filter( 'handle_bulk_actions-edit-shop_order', array($this, 'create_loadings_handle_bulk_action_edit_shop_order'), 10, 3 );
			//HPOS
			add_filter( 'woocommerce_bulk_action_ids', array($this, 'create_loadings_handle_bulk_action_edit_shop_order'), 10, 2 );
			
			// The results notice from bulk action on orders
			//add_action( 'admin_notices', array($this, 'create_loadings_bulk_action_admin_notice') );

			//Add Econt delivery address to Woo API Order object. 
			add_filter( 'woocommerce_rest_prepare_shop_order_object', array($this, 'get_order_add_econt_fields'), 10, 3 );
 
		
		}

		public function add_meta_boxes() {

			add_meta_box( 'econt-order', __( 'Econt Express - Order Viewer', 'woocommerce-econt' ), array( &$this, 'econt_product_order'), 'shop_order', 'normal', 'default' );
			//HPOS
			add_meta_box( 'econt-order', __( 'Econt Express - Order Viewer', 'woocommerce-econt' ), array( &$this, 'econt_product_order'), 'woocommerce_page_wc-orders', 'normal', 'default' );

		}

		public function add_order_item_header() {

			?>
			<th class="econt-express"><?php _e( 'Econt Express Woocommerce', 'woocommerce-econt' ); ?></th>
			<?php

		}


		//add econt panel to order post
	   public function econt_product_order( $order ) {

			if ( ! is_a( $order, 'WC_Order' ) ) {
				$order = wc_get_order( $order );
			}	

			include_once( ECONT_PLUGIN_DIR.'/admin/view/html-order-view.php' );

		}


		public function econt_order_products($order_id) {
				
			$the_order = wc_get_order( $order_id );	
			$econt_options = get_option('econt_shipping_method_options');
			$result = array();

				$weight = 0;
				$price 	= 0;
				$count 	= 0;
				$refund = 0;
				$length = 0;
     			$width  = 0;
     			$volume_weight = 0;
     			$height = 0;
				
				if ( sizeof( $the_order->get_items() ) > 0 ) {
					$i = 0;
					foreach( $the_order->get_items() as $item_id => $item ) {
						if ( $item->get_product_id() > 0 ) {
							$_product =  $item->get_product();

							if ( ! $_product->is_virtual() ) {
								if($_product->get_weight() <= 0){
									$result['no_weight'][$i]['name'] = $item->get_name();
									$result['no_weight'][$i]['product_id'] = $item->get_product_id();
								
								}

								$result['product_name'][$i] = $item->get_name();

								$result['products'][$i]['product_id'] = $item->get_product_id();
								$result['products'][$i]['name'] = $item->get_name();
								$result['products'][$i]['qty'] = $item->get_quantity();
								$result['products'][$i]['weight'] = (float)$_product->get_weight() * $item->get_quantity();
								$result['products'][$i]['price'] = number_format($the_order->get_item_total( $item, true, false ) * $item->get_quantity() - (float)$the_order->get_total_refunded_for_item( $item_id ), 2, ".", "");

								$count  += $item->get_quantity();

								$length = ($_product->get_length() > $length) ? $_product->get_length() : $length;
            					$width = ($_product->get_width() > $width) ? $_product->get_width() : $width;
            					$height += (float)$_product->get_height() * $item->get_quantity();
            					$volume_weight += Econt_mySQL::volume_weight_calc((float)$_product->get_length(), (float)$_product->get_width(), (float)$_product->get_height()) * $item->get_quantity();
            					$weight += (float)$_product->get_weight() * $item->get_quantity();
							}
						}
					 $i++;
					 $refund += (float)$the_order->get_total_refunded_for_item( $item_id );
					}

					if ( sizeof( $the_order->get_items( 'shipping' ) ) > 0 ) {
					foreach( $the_order->get_items( 'shipping' ) as $item_id => $item ){
						//ако fee e 0 го пропускаме
                		if(empty((float)$item->get_total()))
                        	continue;

						$result['products'][$i]['product_id'] = -1;
						$result['products'][$i]['name'] = $item->get_name();
						$result['products'][$i]['qty'] = $item->get_quantity();
						$result['products'][$i]['weight'] = 0.00;
						$result['products'][$i]['price'] = number_format($the_order->get_item_total( $item, true, false ) * $item->get_quantity() - (float)$the_order->get_total_refunded_for_item( $item_id, 'shipping' ), 2, ".", "");
						$i++;
						$refund += (float)$the_order->get_total_refunded_for_item( $item_id, 'shipping' );
					}
				}

		            foreach( $the_order->get_items( 'fee' ) as $item_id => $fee_item_obj ){

		                //ако fee e 0 го пропускаме
		                if(empty((float)$fee_item_obj->get_total()))
		                        continue;
		                
						$result['product_name'][$i] = $fee_item_obj->get_name();

						$result['products'][$i]['product_id'] = 'fee';
						$result['products'][$i]['name'] = $fee_item_obj->get_name();
						$result['products'][$i]['qty'] = $fee_item_obj->get_quantity();
						$result['products'][$i]['weight'] = 0.00;
						$result['products'][$i]['price'] = number_format($the_order->get_item_total( $item, true, false ) * $item->get_quantity() - (float)$the_order->get_total_refunded_for_item( $item_id, 'fee' ), 2, ".", "");

		                $i++;
		                $refund += (float)$the_order->get_total_refunded_for_item( $item_id, 'fee' );

		            }
		        
				}

				$result['weight'] = $weight;

				$result['price'] = number_format((float)$the_order->get_total() - ((float)$the_order->get_total_shipping() + (float)$the_order->get_shipping_tax() + (float)$refund), 2, ".", "");
				$result['total_price'] = number_format((float)$the_order->get_total() - (float)$refund, 2, ".", "");
				$result['shipping_price'] = number_format((float)$the_order->get_shipping_tax() + (float)$the_order->get_shipping_tax(), 2, ".", "");
				$result['shipping_tax'] = number_format((float)$the_order->get_shipping_tax(), 2, ".", "");
				$result['count'] = $count;
				$result['size_under_60cm'] = ( max($length, $width, $height) < 60 ) ? 1 : 0;
				$result['length'] = $length;
				$result['width'] = $width;
				$result['height'] = $height;

				$result['currency'] = $the_order->get_currency();
				$result['currency_symbol'] = get_woocommerce_currency_symbol($result['currency']);
				$result['payment_method'] = $the_order->get_payment_method();
				$result['billing_country'] = $the_order->get_billing_country();
				if(Econt_mySQL::fixed_price_incod($result['total_price'], $the_order, $econt_options) == true){
					$result['price'] = $result['total_price'];
				}else{
					foreach ($result['products'] as $key => $product) {
						if($product['product_id'] == -1){
							unset($result['products'][$key]);
							break;
						}
					}
				}
				if(isset($result['products']) && is_array($result['products'])){
					$result['products'] = array_values($result['products']);
				}
				$result = apply_filters( 'econt_order_products', $result, $the_order );
				
				return $result;
		}


		function econt_add_orders_overview_columns($columns){
			$new_columns = array();

    		foreach ( $columns as $column_name => $column_info ) {

        		$new_columns[ $column_name ] = $column_info;

        		if ( 'order_total' === $column_name ) {
            		$new_columns['econt_loading'] = __('Econt Loading', 'woocommerce-econt');
        		}
    		}

    		return $new_columns;

		}

		function econt_orders_overview_columns_values($column_id, $order){

			if ( ! is_a( $order, 'WC_Order' ) ) {
				$order = wc_get_order( $order );
			}

	        $econt_mysql = new Econt_mySQL;
	        $order_shipping_method_id = '';
	        
	        $shipping_items = $order->get_items( 'shipping' );
	        foreach($shipping_items as $el){
	            $order_shipping_method_id = $el['method_id'] ;
	        }

	        if($order_shipping_method_id == 'econt_shipping_method'){

	    		if ($column_id == 'econt_loading') {
	    			$loading = $econt_mysql->getLoading($order->get_id());
	    			if($loading !== false){
	    			echo '<button class="econt_pdf_loading econt_wc_orders_list" href="' . $loading['pdf_url'] . '" target="_blank">' . $loading['loading_num'] . '</button>  <button class="econt_wc_orders_list" href="" onclick="$econt_aiaks(\'loading_tracking\', ' . $loading['loading_num'] . ');return false;" target="_blank">' . __('tracking', 'woocommerce-econt') . '</button><div id="econtLoader" style="display:none;"></div><!-- loading spinner -->';
	    			}else{
	    			echo '<button href="' . $order->get_id() . '" id="econt_fast_create_loading_' . $order->get_id() . '" class="econt_fast_create_loading econt_wc_orders_list">' . __('create loading', 'woocommerce-econt') . '</button> <button href="" class="econt_fast_create_loading_form econt_wc_orders_list" onclick="$econt_flf(' . $order->get_id() . ', this);return false;" target="_blank">' . __('loading form', 'woocommerce-econt') . '</button><div id="econtLoader" style="display:none;"></div><!-- loading spinner -->';
	    			}
	    		}
	    	}	
		}

        function econt_offices_checkout_field_display_admin_order_meta($order) {
        $econt_options = get_option('econt_shipping_method_options');
        $intl_delivery = ($order->get_billing_country() == 'RO' || $order->get_billing_country() == 'GR') ? true : false;
        //$econt_mysql = new Econt_mySQL;

        $shipping_items = $order->get_items( 'shipping' );
        foreach($shipping_items as $el){
            $order_shipping_method_id = $el['method_id'] ;
        }

        //if($order_shipping_method_id == 'econt_shipping_method'){

            
            $getoffice = new Econt_mySQL;
            $office_code = $order->get_meta( 'Econt_Office', true );
            $office = $getoffice->getOfficeByOfficeCode($office_code);
                
            $machine_code = $order->get_meta( 'Econt_Machine', true );
            $machine = $getoffice->getOfficeByOfficeCode($machine_code);

            //get loading details from sql
			$loading = $getoffice->getLoading($order->get_id());
			$loading_is_imported = '0';
			if(is_array( $loading ) && array_key_exists( 'is_imported' , $loading )){
				$loading_is_imported = $loading['is_imported'];
			}
            include_once( ECONT_PLUGIN_DIR.'/admin/view/html-order-edit-address-view.php' );
            //}

        }

        function econt_auto_refreshdata(){
			if ( class_exists( 'Econt_mySQL' ) ){
			 	$econt_mysql = new Econt_mySQL;
				$results = $econt_mysql->refreshData();

			}	
        }

        function econt_auto_refreshdata_intl(){
			if ( class_exists( 'Econt_mySQL' ) ){
			 	$econt_mysql = new Econt_mySQL;
				$results = $econt_mysql->refreshDataIntl();

			}	
        }

        public function econt_custom_cron_schedule( $schedules ) {
		    $schedules['every_24_hours'] = array(
		        'interval' => 86400, // Every 24 hours 86400
		        'display'  => __( 'Every 24 hours' ),
		    );
		    return $schedules;
		}

		public function econt_custom_cron_schedule_intl( $schedules ) {
		    $schedules['monthly'] = array(
		        'interval' => 2635200, // Every 24 hours 86400
		        'display'  => __( 'Every month' ),
		    );
		    return $schedules;
		}

		function econt_scripts() {
			 $inc_shipping_cost = '';
			 $hide_cart_shipping_descr = '';
			 $shipping_method_title = '';
			 $hide_quarter_fields = '';
			 $open_layers_maps_office_locator = '';
			 $checkout_tooltips = '';
			 $user_address = '';
			 $title_type = '';
			 $autocomplete_ajax_delay = 0;
			 $optimize_scripts_loading = 0;
			 $local_storage = 1;
			 $fast_ajax = 0;
			 $shipping_to_icons = false;
			 $ajax_url = admin_url( 'admin-ajax.php' );
			 $econt_options = get_option('econt_shipping_method_options');

			 if ( isset($econt_options) && is_array($econt_options) ){
			 	$inc_shipping_cost = $econt_options['inc_shipping_cost'];
			 	$hide_cart_shipping_descr = $econt_options['hide_cart_shipping_descr'];
			 	$title_type = $econt_options['title_type'];
			 	$autocomplete_ajax_delay = empty($econt_options['autocomplete_ajax_delay']) ? 0 : (int)$econt_options['autocomplete_ajax_delay'];
			 	if($econt_options['title_type'] == 'image'){
			 		$shipping_method_title = '<img id="econt-title-image" src="' . $econt_options['title_image'] . '" style="display:inline-block; vertical-align:middle;">';
			 	}else{
			 		$shipping_method_title = $econt_options['title'];
			 	}
			 	$hide_quarter_fields = $econt_options['hide_quarter_fields'];
			 	$open_layers_maps_office_locator = $econt_options['open_layers_maps_office_locator'];
			 	$checkout_tooltips = $econt_options['checkout_tooltips'];
			 	$optimize_scripts_loading = $econt_options['optimize_scripts_loading'];
			 	$local_storage = $econt_options['local_storage'] == 2 ? 0 : 1;
			 	$fast_ajax = $econt_options['fast_ajax'];
			 	if($fast_ajax == 1){
			 		$ajax_url = ECONT_PLUGIN_URL . 'inc/fast-ajax/class-fast-ajax-econt.php';
			 	}
			 	$user_id = get_current_user_id();

			 	if(get_user_meta($user_id, 'Econt_Shipping_To', true)){
			 		$user_address = '1';
			 	}
			 	if($econt_options['shipping_to_style'] == 'icons'){
			 		$shipping_to_icons = true;
			 	}
			 }

			 $disable_scripts = false;
			 if($optimize_scripts_loading == 1){
			 	$enable_scripts = false;
				 if(is_account_page() || is_checkout() || is_cart() || is_admin()){
				 	$enable_scripts = true;
				 }
				 if($enable_scripts == false){
				 	$disable_scripts = true;
				 }
			 }
			 if($disable_scripts == false){
			 $license = Econt_mySQL::license_check();
			 //wp_enqueue_style( 'style-jquery-ui', '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css'); //za fon na autocomplete v checkout
			 wp_enqueue_script('jquery');
       		 wp_enqueue_script('jquery-ui-core');
       		 wp_enqueue_script('jquery-ui-autocomplete', '', array('jquery-ui-widget', 'jquery-ui-position'), '1.8.6');
       		 if($license->licensed == 'no' || Econt_mySQL::lamers_check() == true){
       		 	if ( is_admin() ) {
       		 		wp_enqueue_script( 'econt_js', ECONT_PLUGIN_URL . 'inc/js/econt2.js', array( 'jquery' ), ECONT_VERSION_NUM, true );
       		 	}
       		 }else{
        	 	wp_enqueue_script( 'econt_js', ECONT_PLUGIN_URL . 'inc/js/econt.js', array( 'jquery' ), ECONT_VERSION_NUM, true );
        	 	wp_enqueue_script( 'select2_js', ECONT_PLUGIN_URL . 'inc/js/select2.min.js', array( 'jquery' ), '4.0.13', true );
        	 }
        	 //colorbox for office locator map
        	 wp_enqueue_script( 'colorbox_js', ECONT_PLUGIN_URL . 'inc/js/colorbox/jquery.colorbox-min.js', array( 'jquery' ), '1.6.1', true );
        	 wp_enqueue_style( 'colorbox_style', ECONT_PLUGIN_URL . 'inc/css/colorbox.css', array(), '1.6.1', 'all');
        	 //tooltipster for checkout fields
        	 wp_enqueue_script( 'tooltipster_js', ECONT_PLUGIN_URL . 'inc/js/tooltipster.bundle.min.js', array( 'jquery' ), '1.6.1', true );
        	 wp_enqueue_style( 'tooltipster_style', ECONT_PLUGIN_URL . 'inc/css/tooltipster.bundle.min.css', array(), '1.6.1', 'all');
        	 
        	 wp_enqueue_style( 'econt_style', ECONT_PLUGIN_URL . 'inc/css/econt.css', array(), ECONT_VERSION_NUM, 'all');
        	 if($shipping_to_icons == true){
        		wp_enqueue_style( 'econt_shpping_to_icons_style', ECONT_PLUGIN_URL . 'inc/css/econt-shipping-to-icons.css', array(), ECONT_VERSION_NUM, 'all');
        	 }
        	 wp_enqueue_style( 'select2_style', ECONT_PLUGIN_URL . 'inc/css/select2.min.css', array(), '4.0.13', 'all');

        	 //OpenLayer maps api
        	 if( !is_numeric($open_layers_maps_office_locator) || $open_layers_maps_office_locator == 1 ){
	        	 wp_enqueue_style( 'open_layers_maps_style', ECONT_PLUGIN_URL . 'inc/css/openlayers/ol.css', array(), '5.3.0', 'all');
	        	 wp_enqueue_style( 'open_layers_maps_ext_style', ECONT_PLUGIN_URL . 'inc/css/openlayers/ol-ext.css', array(), '5.3.0', 'all');
	        	 wp_enqueue_script( 'open_layers_js', ECONT_PLUGIN_URL . 'inc/js/openlayers/ol.js', array( 'jquery' ), '5.3.0', true );
	        	 wp_enqueue_script( 'open_layers_ext_js', ECONT_PLUGIN_URL . 'inc/js/openlayers/ol-ext.min.js', array( 'jquery' ), '5.3.0', true );
        	 }

        	 $dataToBePassed = array(
                'refreshWaitText'       		=> __('Loading... Please, wait.','woocommerce-econt'),
                'refreshText'            		=> __('Refresh','woocommerce-econt'),
                'apsAlertText'					=> __('When sending by APS and activate the service payment on delivery (COD) is required can use the agreement to collect cash!', 'woocommerce-econt'),
                'apsAlertText2'					=> __('services that you can use when sending by APS are: \n- cash (when using the agreement to collect COD) \n- receipt \n- bidirectional shipment \n- Hour priority (when sending to address) \n- Review  \n- View and test \n- review, test and choice', 'woocommerce-econt'),
                'incShippingCost'				=> $inc_shipping_cost,
                'shippingMethodTitle'			=> $shipping_method_title,
                'shippingMethodTitleType'		=> $title_type,
                'autocompleteAjaxDelay'			=> $autocomplete_ajax_delay,
                'localStorage'					=> $local_storage,
                'ajaxURL'						=> $ajax_url,
                'htmlLiveText'					=> __('The default is set to live work environment, enter your: <br> -Username to access e-Econt; <br> -Password to access e-Econt; <br> -Click on the button "Update information" and wait until downloaded the necessary information from servers Econt. New fields with different settings of the module will appear.','woocommerce-econt'),
                'htmlTestText'					=> __('Test environment (If you choose a test environment, all requests will be sent to the test system ECONT); <br> NOTE: User names and passwords on both systems are different, so if you do not have a username and password for the test system - choose "live" from the dropdown menu.','woocommerce-econt'),
				'totalShippingCostText' 		=> __('Total Shipping Cost:','woocommerce-econt'),
				'totalShippingCustomerCostText' => __('Total Shipping Cost to be paid by customer:','woocommerce-econt'),
				'loadingPdfLinkText' 			=> __('Loading PDF link:','woocommerce-econt'),
				'loadingNumberText' 			=> __('Loading number:','woocommerce-econt'),
				//'shippingPriceText' 			=> __('Econt Express shipping price:','woocommerce-econt'),
				'license' 						=> $license,
				'hostname'						=> $_SERVER['HTTP_HOST'],
				'shippingCostText'				=> __('Shipping Cost:','woocommerce-econt'),
				'calculateShippingCostText'		=> __('Calculate Shipping Cost.','woocommerce-econt'),
				'isCheckout' => is_checkout(),
            	'isCart' => is_cart(),
            	'hideCardShippingDescr' => $hide_cart_shipping_descr,
            	'hideQuarterFields' => $hide_quarter_fields,
            	'openLayersMapsOfficeLocator' => $open_layers_maps_office_locator,
            	'checkoutTooltips' => $checkout_tooltips, 
            	'openLayersMapsOfficeIcon' => ECONT_PLUGIN_URL . 'inc/css/images/econt_maps_icon.png',
            	'userAddress'	=> $user_address,
            	'tooltipTownText' => __('Please fill in the name of your locality and select from the results below.', 'woocommerce-econt'),
            	'tooltipQuarterText' => __('Please fill in the name of your quarter and select from the results below.', 'woocommerce-econt'),
            	'tooltipStreetText' => __('Please fill in the name of your street or boulevard and select from the results below.', 'woocommerce-econt'),
            	'tooltipUserCheckoutText' => __('If you want to edit the address click the pencil on the right', 'woocommerce-econt'),
            	'selectStartTypingText' => __('Start typing…', 'woocommerce-econt'),
            	'selectNRFText' => __('No results found', 'woocommerce-econt'),
            	'selectSearchOfficeText' => __('Searching for an office...', 'woocommerce-econt'),
            	'selectSelectResultsText' => __('Start typing and select from the results', 'woocommerce-econt'),
            	'selectSearchPlaceText' => __('Searching for a locality...', 'woocommerce-econt'),
            	'selectSearchAPSText' => __('Searching for APS…', 'woocommerce-econt'),
            	'selectStreetSearchText' => __('Street Search…', 'woocommerce-econt'),
            	'selectSearchNeighborhoodText' => __('Searching for a neighborhood...', 'woocommerce-econt'),
            	'trackingTxt' => __('tracking', 'woocommerce-econt'),
            	'pleaseSelectText' => __('please select...', 'woocommerce-econt'),
            	''
                
             );

             wp_localize_script( 'econt_js', 'econt_php_vars', $dataToBePassed );
            }

		}

		//loading tracking event translation
		public function tracking_event_text($event){
			$eventTxt = '';
			switch ($event) {
				case "client":
					$eventTxt = __( 'transmission to a client', 'woocommerce-econt' );
					break;
				case "courier":
					$eventTxt = __( 'transmission to courier', 'woocommerce-econt' );
					break;
				case "courier_direction":
					$eventTxt = __( 'transmission to a route line', 'woocommerce-econt' );
					        break;
				case "office":
					$eventTxt = __( 'transfer to an office', 'woocommerce-econt' );
					break;
				case "instruction":
					 $eventTxt = __( 'disposition for change of shipping conditions', 'woocommerce-econt' );
					break;
				case "redirect":
					$eventTxt = __( 'forwarding the shipment', 'woocommerce-econt' );
					break;
				case "return":
					$eventTxt = __( 'return the shipment', 'woocommerce-econt' );
					break;
				case "destroy":
					$eventTxt = __( 'destroying the shipment', 'woocommerce-econt' );
					break;
				case "failed_delivery":
					$eventTxt = __( 'unsuccessful delivery attempt', 'woocommerce-econt' );
					break;
				default:
					$eventTxt = __('tracking event', 'woocommerce-econt');
			}
			return $eventTxt;
		}

		/**
	     * Plugin settings link in Admin. Plugins menu
	     */
	    public function plugin_link_setting($links, $file) {
	        $this_plugin = 'woocommerce-econt/woocommerce-econt.php';
	        if ($file == $this_plugin) {
	            $settings_link1 = '<a href="admin.php?page=wc-settings&tab=shipping&section=econt_shipping_method">' . __('Settings', 'woocommerce-econt') . '</a>';
	            array_unshift($links, $settings_link1);
	        }
	        return $links;
	    }

	    function create_loadings_bulk_actions( $actions ) {
		    $actions['create_econt_loadings'] = __( 'Create Econt loadings', 'woocommerce-econt' );
		    return $actions;
		}

		function create_loadings_handle_bulk_action_edit_shop_order( $order_ids, $action ) {

		    if ( $action !== 'create_econt_loadings' )
		        return $order_ids; // Exit

		    $econt_mysql = new Econt_mySQL;

		    foreach ( $order_ids as $order_id ) {
		        // Create loading for each selected order
		        $order = wc_get_order( $order_id );
		        foreach( $order->get_items( 'shipping' ) as $item_id => $item ){
					if( $item->get_method_id() === 'econt_shipping_method' ) {
		        		if( $econt_mysql->getLoading( $order_id ) == false ){
					        $loading_data = $econt_mysql->default_loading_data( $order_id );
					        $loading_data['action'] = 'econt_handle_ajax';
					        $loading_data['action2'] = 'create_loading';

							$url = get_bloginfo('wpurl') . '/wp-admin/admin-ajax.php';

							$result = wp_remote_post(
								$url,
								array(
									'body'    => $loading_data,
								)
							);
							if ( is_wp_error( $result )  || wp_remote_retrieve_response_code( $result ) != 200 ) {
								$error_message = $result->get_error_message();
								// response received from child site.
								$response = array(
									'status'   => 'request_error',
									'error'    => $error_message,
								);
							} else {
			      				$body = wp_remote_retrieve_body( $result );
			      				$response = json_decode( $body );
							}
						}
					}
		        
		    	}
			}

		    return $order_ids;
		}

	    public static function check_shipping_cost($order_id){
	    	
	    	$order = wc_get_order( $order_id );

	    	if( ! $order->meta_exists('Econt_Total_Shipping_Cost') ){
	
	    		foreach( $order->get_items( 'shipping' ) as $item_id => $item ){

					if( $item->get_method_id() === 'econt_shipping_method' ) {

		        		$econt_mysql = new Econt_mySQL;
		        		$loading_data = array();
		        		$intl_delivery = ($order->get_billing_country() == 'RO' || $order->get_billing_country() == 'GR') ? true : false;
		        		$loading_data['receiver_city'] = '';
		        		$loading_data['receiver_post_code'] = '';
		        		$loading_data['order_id'] = $order_id;
		        		//$loading_data['order_cd'] = 0;
		        		$loading_data['payment_method'] = $order->get_payment_method();
						$loading_data['order_cd'] = ($loading_data['payment_method'] == 'cod' || $loading_data['payment_method'] == 'econt_payment') ? 1 : 0;
                
	                	if($order->get_meta( 'Econt_Door_Town', true )){
	                    
	                    	$loading_data['receiver_city'] = $order->get_meta( 'Econt_Door_Town', true );
	                    
	                	}elseif($order->get_meta( 'Econt_Office_Town', true )){
	                    
	                    	$loading_data['receiver_city'] = $order->get_meta( 'Econt_Office_Town', true );
	                    
	                	}elseif($order->get_meta( 'Econt_Machine_Town', true )){

	                    	$loading_data['receiver_city'] = $order->get_meta( 'Econt_Machine_Town', true );
	                	}
	                    
	                	if($order->get_meta( 'Econt_Door_Postcode', true )){
	                        
	                    	$loading_data['receiver_post_code'] = $order->get_meta( 'Econt_Door_Postcode', true );
	                    
	                	}elseif($order->get_meta( 'Econt_Office_Postcode', true )){

	                    	$loading_data['receiver_post_code'] = $order->get_meta( 'Econt_Office_Postcode', true );
	                    
	                	}elseif($order->get_meta( 'Econt_Machine_Postcode', true )){

	                    	$loading_data['receiver_post_code'] = $order->get_meta( 'Econt_Machine_Postcode', true );
	                	}
	                	$loading_data['receiver_office_code'] = '';
	                	if($order->get_meta( 'Econt_Office', true )){

	                    	$loading_data['receiver_office_code'] = $order->get_meta( 'Econt_Office', true );
	                    
	                	}elseif($order->get_meta( 'Econt_Machine', true )){

	                    	$loading_data['receiver_office_code'] = $order->get_meta( 'Econt_Machine', true );
	                	}

	                	if( $order->get_billing_company() ) { 
	                    
	                    	$loading_data['receiver_name'] = $order->get_billing_company();
	                    
	                	}else{
	                    
	                    	$loading_data['receiver_name'] = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name();

	                	}
	                    
		                $loading_data['receiver_name_person'] = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name();
		                $loading_data['receiver_email'] =$order->get_billing_email();
		                $loading_data['receiver_street'] = ($intl_delivery == true) ? $order->get_meta( 'Econt_Door_Street_Intl', true ) : $order->get_meta( 'Econt_Door_Street', true );
		                $loading_data['receiver_quarter'] = ($intl_delivery == true) ? $order->get_meta( 'Econt_Door_Quarter_Intl', true ) : $order->get_meta( 'Econt_Door_Quarter', true );
		                $loading_data['receiver_street_num'] = $order->get_meta( 'Econt_Door_street_num', true );
		                $loading_data['receiver_street_bl'] = $order->get_meta( 'Econt_Door_building_num', true );
		                $loading_data['receiver_street_vh'] = $order->get_meta( 'Econt_Door_Entrance_num', true );
		                $loading_data['receiver_street_et'] = $order->get_meta( 'Econt_Door_Floor_num', true );
		                $loading_data['receiver_street_ap'] = $order->get_meta( 'Econt_Door_Apartment_num', true );
		                $loading_data['receiver_street_other'] = $order->get_meta( 'Econt_Door_Other', true );
		                $loading_data['receiver_phone_num'] = $order->get_billing_phone();
		                $loading_data['receiver_shipping_to'] = $order->get_meta( 'Econt_Shipping_To', true );

		                $loading_data['currency'] = $order->get_currency();
						$loading_data['currency_symbol'] = get_woocommerce_currency_symbol($loading_data['currency']);

                		if(!empty($loading_data['receiver_city'])){
                   			$result = $econt_mysql->create_loading($loading_data, 1);
	                   		//if($loading != false){
                   			if(! array_key_exists('warning', $result)){
	                   		$econt_options = get_option('econt_shipping_method_options');
	                   		if( !empty($econt_options['inc_shipping_cost']) ){
	                        	//update shipping cost
						        $econt_total = (wc_tax_enabled()) ? Econt_mySQL::remove_vat_from_shipping_price($result['customer_shipping_cost']) : $result['customer_shipping_cost'];
	                   			$item->set_total( $result['customer_shipping_cost'] );
	                   			//$item->set_total( 9.81 );
				            	$item->save();

				            	$order->calculate_totals();
				        	}

							$order->update_meta_data( 'Econt_Customer_Shipping_Cost', sanitize_text_field($result['customer_shipping_cost']) );
							$order->update_meta_data( 'Econt_Total_Shipping_Cost', sanitize_text_field($result['total_shipping_cost']) );
							$order->save();

							}
				            break; // stop the loop

                		}   
            		}
        		}
        	}        
    	}


    	public function get_order_add_econt_fields( $response, $order, $request ) {

		    if( empty( $response->data ) )
		        return $response;
		    //econt
		    $getoffice = new Econt_mySQL;
		    $office_code = $order->get_meta('Econt_Office');
		    $office = $getoffice->getOfficeByOfficeCode($office_code);
		    $machine_code = $order->get_meta('Econt_Machine');
		    $machine = $getoffice->getOfficeByOfficeCode($machine_code);
		    $loading = $getoffice->getLoading($order->get_id());
		       
		    // Get the custom order post_meta data and add it to the order_data array.
		    $response->data['econt']['Econt_Shipping_To'] = $order->get_meta('Econt_Shipping_To');

		    $response->data['econt']['Econt_Office_Town'] = $order->get_meta('Econt_Office_Town');
		    $response->data['econt']['Econt_Office_Name'] = '';
		    if($order->get_meta('Econt_Shipping_To') == 'OFFICE'){
		        $response->data['econt']['Econt_Office_Name'] = isset($office['address']) ? $office['address'] : '';
		    }
		    $response->data['econt']['Econt_Office'] = $order->get_meta('Econt_Office');
		    $response->data['econt']['Econt_Office_Postcode'] = $order->get_meta('Econt_Office_Postcode');

		    $response->data['econt']['Econt_Machine_Town'] = $order->get_meta('Econt_Machine_Town');
		    $response->data['econt']['Econt_Machine_Name'] = ''; 
		    if($order->get_meta('Econt_Shipping_To') == 'MACHINE'){
		        $response->data['econt']['Econt_Machine_Name'] = isset($machine['address']) ? $machine['address'] : '';
		    }
		    $response->data['econt']['Econt_Machine'] = $order->get_meta('Econt_Machine');
		    $response->data['econt']['Econt_Machine_Postcode'] = $order->get_meta('Econt_Machine_Postcode');

		    $response->data['econt']['Econt_Door_Town'] = $order->get_meta('Econt_Door_Town');
		    $response->data['econt']['Econt_Door_Postcode'] = $order->get_meta('Econt_Door_Postcode');
		    $response->data['econt']['Econt_Door_Street'] = $order->get_meta('Econt_Door_Street');
		    $response->data['econt']['Econt_Door_Quarter'] = $order->get_meta('Econt_Door_Quarter');
		    $response->data['econt']['Econt_Door_street_num'] = $order->get_meta('Econt_Door_street_num');
		    $response->data['econt']['Econt_Door_building_num'] = $order->get_meta('Econt_Door_building_num');
		    $response->data['econt']['Econt_Door_Entrance_num'] = $order->get_meta('Econt_Door_Entrance_num');
		    $response->data['econt']['Econt_Door_Floor_num'] = $order->get_meta('Econt_Door_Floor_num');
		    $response->data['econt']['Econt_Door_Apartment_num'] = $order->get_meta('Econt_Door_Apartment_num');
		    $response->data['econt']['Econt_Door_Other'] = $order->get_meta('Econt_Door_Other');

		    $response->data['econt']['Econt_City_Courier'] = $order->get_meta('Econt_City_Courier');
		    $response->data['econt']['Econt_Delivery_Days'] = $order->get_meta('Econt_Delivery_Days');
		    $response->data['econt']['Econt_Priority_Time_Type'] = $order->get_meta('Econt_Priority_Time_Type');
		    $response->data['econt']['Econt_Priority_Time_Hour'] = $order->get_meta('Econt_Priority_Time_Hour');

		    $response->data['econt']['Econt_Total_Shipping_Cost'] = $order->get_meta('Econt_Total_Shipping_Cost');
		    $response->data['econt']['Econt_Customer_Shipping_Cost'] = $order->get_meta('Econt_Customer_Shipping_Cost');
		    //$response->data['econt']['Econt_Loading_Number'] = isset($loading['loading_num']) ? $loading['loading_num'] : ''; 
		    return $response;
		} 



	}

}

$Econt_Admin_Order = new Econt_Admin_Order();