<?php
/*
Plugin Name: Econt Shipping plugin
Plugin URI: https://mreja.net
Description: Mreja.net's Econt shipping method plugin
Version: 1.6.5
Author: Mreja.Net
Author URI: https://mreja.net
*/
 
/**
 * Check if WooCommerce is active
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
 
	function econt_shipping_method_init() {
		if ( ! class_exists( 'WC_Econt_Shipping_Method' ) ) {
			class WC_Econt_Shipping_Method extends WC_Shipping_Method {
				/**
				 * Constructor for your shipping class
				 *
				 * @access public
				 * @return void
				 */
                private $properties = [];

                public function __construct($instance_id = 0) {
                //public function __construct( $instance_id = 0 ) {
                    $this->instance_id                          = absint($instance_id); // Unique instance ID of the method (zones can contain multiple instances of a single shipping method). This ID is stored in the database.
					$this->id                                   = 'econt_shipping_method'; // Id for your shipping method. Should be uunique.
					//$this->instance_id              = absint( $instance_id ); //for shipping zones
                    $this->method_title                         = __( 'Econt Shipping Method', 'woocommerce-econt' );  // Title shown in admin
					$this->method_description                   = __( 'Ship you goods with Econt Express', 'woocommerce-econt' ); // Description shown in admin
                    
                    if( !empty($this->get_option('shipping_zones_support')) ){
                        $this->supports = array(
                            'shipping-zones',
                            'settings',
                        );
                    }

					$this->enabled                              = $this->get_option( 'enabled' );
					$this->title_type                           = $this->get_option( 'title_type' );
                    $this->title                                = $this->get_option( 'title' );
                    $this->title_image                          = $this->get_option( 'title_image' );
                    $this->description                          = $this->get_option( 'description' );	
 					$this->username                             = $this->get_option( 'username' );
					$this->password                             = $this->get_option( 'password' );
					$this->live 				                = $this->get_option( 'live' );    
					$this->company 				                = $this->get_option( 'company');
					$this->name 	                            = $this->get_option( 'name' );
					$this->phone 	                            = $this->get_option( 'phone' );
                    $this->email                                = $this->get_option( 'email' );
					$this->address 				                = $this->get_option( 'address');
                    $this->office_town                          = $this->get_option( 'office_town' );
					$this->office_postcode                      = $this->get_option( 'office_postcode' );
                    $this->office_code                          = $this->get_option( 'office_code' );
                    $this->machine_town                         = $this->get_option( 'machine_town' );
                    $this->machine_postcode                     = $this->get_option( 'machine_postcode' );
                    $this->machine_code                         = $this->get_option( 'machine_code' );
                    $this->payment_side                         = $this->get_option( 'payment_side' );
					$this->client_payment_type	                = $this->get_option( 'client_payment_type' );
					$this->client_voucher	 	                = $this->get_option( 'client_voucher' );
					$this->client_bonus_points	                = $this->get_option( 'client_bonus_points' );
                    $this->cd                                   = $this->get_option( 'cd' );
					$this->client_cd_num 	                    = $this->get_option( 'client_cd_num' );
                    $this->free_shipping_to_office              = $this->get_option( 'free_shipping_to_office');
                    $this->free_shipping_sum                    = get_option( 'econt_free_shipping_sum');
                    $this->free_shipping_sum_to_office          = get_option( 'econt_free_shipping_sum_to_office');
                    $this->free_shipping_weight                 = $this->get_option( 'free_shipping_weight');
                    $this->free_shipping_count                  = $this->get_option( 'free_shipping_count');
 					$this->oc					                = $this->get_option( 'oc');
					$this->partial_delivery		                = $this->get_option( 'partial_delivery' );
					$this->send_from 			                = $this->get_option( 'send_from' );
                    $this->send_to_door                         = $this->get_option( 'send_to_door' );
                    $this->send_to_office                       = $this->get_option( 'send_to_office' );
                    $this->send_to_machine                      = $this->get_option( 'send_to_machine' );
                    $this->city_courier                         = $this->get_option( 'city_courier' );
                    $this->dc                                   = $this->get_option( 'dc' );
                    $this->dc_cp                                = $this->get_option( 'dc_cp' );
                    $this->sms_notification                     = $this->get_option( 'sms_notification' );
                    $this->sms_no                               = $this->get_option( 'sms_no' );
                    $this->invoice                              = $this->get_option( 'invoice' );
                    $this->pay_after                            = $this->get_option( 'pay_after' );

                    $this->instruction_returns                  = '0';
                    $this->priority_time                        = $this->get_option( 'priority_time' );
                    $this->delivery_days                        = $this->get_option( 'delivery_days' );
                    $this->inventory                            = $this->get_option( 'inventory' );
                    $this->return_item                          = $this->get_option( 'return_item' );
                    $this->instructions_take                    = $this->get_option( 'instructions_take' );
                    $this->instructions_give                    = $this->get_option( 'instructions_give' );
                    $this->instructions_return                  = $this->get_option( 'instructions_return' );
                    $this->instructions_services                = $this->get_option( 'instructions_services' );
                    $this->inc_shipping_cost                    = $this->get_option( 'inc_shipping_cost' );
                    $this->hide_cart_shipping_descr             = $this->get_option( 'hide_cart_shipping_descr' );
                    $this->send_tracking_email                  = $this->get_option( 'send_tracking_email' );
                    $this->tracking_email_from_address          = $this->get_option( 'tracking_email_from_address' );
                    $this->tracking_email_from_name             = $this->get_option( 'tracking_email_from_name' );
                    $this->auto_refreshdata                     = $this->get_option( 'auto_refreshdata' );
                    $this->auto_refreshdata_intl                = $this->get_option( 'auto_refreshdata_intl' );
                    $this->shipping_to_style                    = $this->get_option( 'shipping_to_style' );
                    $this->open_layers_maps_office_locator      = $this->get_option( 'open_layers_maps_office_locator' );
                    $this->checkout_tooltips                    = $this->get_option( 'checkout_tooltips' );
                    $this->optimize_scripts_loading             = $this->get_option( 'optimize_scripts_loading' );
                    $this->fast_ajax                            = $this->get_option( 'fast_ajax' );
                    $this->autocomplete_ajax_delay              = $this->get_option( 'autocomplete_ajax_delay' );
                    $this->local_storage                        = $this->get_option( 'local_storage' );
                    $this->shipping_payments                    = get_option( 'econt_shipping_payments');
                    $this->hide_quarter_fields                  = $this->get_option( 'hide_quarter_fields' );
                    $this->shipping_zone_support                = $this->get_option( 'shipping_zone_support' );
                    $this->show_checkout_country_field          = $this->get_option( 'show_checkout_country_field' );

					$this->init();
					
					
				}

                public function __set($name, $value) {
                    $this->properties[$name] = $value;
                }

                public function __get($name) {
                    return $this->properties[$name] ?? null;
                }
 
				/**
				 * Init your settings
				 *
				 * @access public
				 * @return void
				 */
				function init() {
					// Load the settings API
					$this->init_form_fields(); // This is part of the settings API. Override the method to add your own settings
					$this->init_settings(); // This is part of the settings API. Loads settings you previously init.
 					$this->init_options(); // Save all options to WP option. 

					// Save settings in admin if you have any defined
					add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
				}


                public function init_options(){
                    $options = array('enabled', 'title_type', 'title', 'title_image', 'description', 'username','password','live', 'company', 'name', 'phone', 'email', 'address', 'office_town', 'office_postcode', 'office_code', 'machine_town', 'machine_postcode', 'machine_code', 'payment_side', 'client_payment_type', 'client_voucher', 'client_bonus_points', 'cd', 'client_cd_num', 'free_shipping_to_office', 'free_shipping_sum', 'free_shipping_sum_to_office', 'free_shipping_weight', 'free_shipping_count', 'oc', 'partial_delivery', 'send_from', 'send_to_door', 'send_to_office', 'send_to_machine', 'city_courier', 'dc', 'dc_cp', 'sms_notification', 'sms_no', 'invoice', 'pay_after', 'instruction_returns', 'priority_time', 'delivery_days', 'inventory', 'return_item', 'instructions_take', 'instructions_give', 'instructions_return', 'instructions_services', 'inc_shipping_cost', 'hide_cart_shipping_descr', 'send_tracking_email', 'tracking_email_from_address', 'tracking_email_from_name', 'auto_refreshdata', 'auto_refreshdata_intl', 'shipping_to_style', 'open_layers_maps_office_locator', 'checkout_tooltips', 'optimize_scripts_loading', 'fast_ajax', 'autocomplete_ajax_delay', 'local_storage', 'shipping_payments', 'hide_quarter_fields', 'shipping_zone_support', 'show_checkout_country_field');
                    $options2 = array(
                        'econt_free_shipping_sum' => 'free_shipping_sum',
                        'econt_free_shipping_sum_to_office' => 'free_shipping_sum_to_office',
                        'econt_shipping_payments' => 'shipping_payments',
                    );
                    $econt_options = array();

                    foreach ($options as $option) {
                        $econt_options[$option] = $this->get_option($option);
                    }
                    foreach ($options2 as $key => $option) {
                        $econt_options[$option] = get_option($key);
                    }
                    $econt_profile = get_option('econt_profile');
                    if(get_option('econt_profile') != false && !array_key_exists('error', $econt_profile)){
                        if(empty($econt_options['company'])){
                            $econt_options['company'] = isset($econt_profile['client_info']['name']) ? $econt_profile['client_info']['name'] : '';
                        }
                        if(empty($econt_options['phone'])){
                            $econt_options['phone'] = isset($econt_profile['client_info']['business_phone']) ? $econt_profile['client_info']['business_phone']: '';
                        }
                        if(empty($econt_options['email'])){
                            $econt_options['email'] = isset($econt_profile['client_info']['business_email']) ? $econt_profile['client_info']['business_email'] : '';
                        }
                        if(empty($econt_options['name'])){
                            $econt_options['name'] = isset($econt_profile['client_info']['mol']) ? $econt_profile['client_info']['mol'] : '';
                        }
                    }
                    update_option('econt_shipping_method_options', $econt_options);
                }
            				

				public function init_form_fields(){ 

					$cd_agreement_nums 		= array();
					$cd_agreement_nums[0] 	= __('please select', 'woocommerce-econt');

					$key_words 		   		= array();
					$key_words['CASH']		= __('Cash', 'woocommerce-econt');
                    
                    $instructions_give      = array();
                    $instructions_take      = array();
                    $instructions_return    = array();
                    $instructions_services  = array();

					
					$sender_addresses  		= array();
					$sender_addresses[0] 	= __('please select', 'woocommerce-econt');


					$name 					= '';
					$phone 					= '';
                    $email                  = '';
                    $mol                    = '';


					if($this->username && $this->password){ 
						
						if(class_exists('Econt_mySQL')){
						$econt_mysql = new Econt_mySQL;	
						}

                        if(get_option('econt_profile') == false){
                            $profile_xml    = $econt_mysql->getProfile($this->username, $this->password, $this->live);
                            $profile        = Econt_mySQL::xml2array($profile_xml);
                            update_option('econt_profile', $profile);
                        }else{
                            $profile = get_option('econt_profile');
						}

                        if(!array_key_exists('error', $profile)){
                            if(empty($this->company)){
						      $name = $profile['client_info']['name'];
                              $this->company = $name;
                            }
                            if(empty($this->phone)){
                              $phone = $profile['client_info']['business_phone'];
                              $this->phone = $phone;
                            }
                            if(empty($this->email)){
                                $email = $profile['client_info']['business_email'];
                                $this->email = $email;
                            }
                            if(empty($this->name)){
                                $mol = $profile['client_info']['mol'];
                                $this->name = $mol;
                            }
						}
					
                        if(get_option('econt_access_clients') == false){
                            $access_clients_xml    = $econt_mysql->getClients($this->username, $this->password, $this->live);
                            $access_clients        = Econt_mySQL::xml2array($access_clients_xml);
                            //update_option('econt_profile', $profile);
                            update_option('econt_access_clients', $profile);
                        }else{
                            $access_clients = get_option('econt_access_clients');
                            
                        }

						$cd_agreement_nums[0] = __('No', 'woocommerce-econt');
						if(isset($access_clients['cd_agreement_nums'])){
						foreach ($access_clients['cd_agreement_nums'] as $key => $value) {
							$cd_agreement_nums[$value] = $value;
						}
						}
						
						if(isset($access_clients['key_words'])){
						foreach ($access_clients['key_words'] as $key => $value) {
							$key_words[$value] = $value;
						}
						}
                        $key_words['VOUCHER']   = __('Voucher', 'woocommerce-econt');
                        $key_words['BONUS']     = __('Bonus points', 'woocommerce-econt');

                        $instructions_take[0] = __('No', 'woocommerce-econt');
                        if(isset($access_clients['instructions']['take'])){
                        foreach ($access_clients['instructions']['take'] as $key => $value) {
                            $instructions_take[$value] = $value;
                        }
                        }

                        $instructions_give[0] = __('No', 'woocommerce-econt');
                        if(isset($access_clients['instructions']['give'])){
                        foreach ($access_clients['instructions']['give'] as $key => $value) {
                            $instructions_give[$value] = $value;
                        }
                        }

                        $instructions_return[0] = __('No', 'woocommerce-econt');
                        if(isset($access_clients['instructions']['return'])){
                        foreach ($access_clients['instructions']['return'] as $key => $value) {
                            $instructions_return[$value] = $value;
                        }
                        }

                        $instructions_services[0] = __('No', 'woocommerce-econt');
                        if(isset($access_clients['instructions']['services'])){
                        foreach ($access_clients['instructions']['services'] as $key => $value) {
                            $instructions_services[$value] = $value;
                        }
                        }

                        if(isset($profile['addresses'])){
                            
                            $address_ready = array();
                            $address_components = array('city_post_code', 'city', 'quarter', 'street', 'street_num', 'other', 'city_id');
    						
                            foreach ($profile['addresses'] as $key => $value) {

                                
                                foreach ($address_components as $address_component) {
                                    if(array_key_exists ( $address_component , $value )){
                                    if(is_array($value[$address_component])){
                                        $address_ready[$address_component] = implode(', ', array_map(
                                            function ($v, $k) { return sprintf("%s: %s", $k, $v); },
                                                $value[$address_component],
                                                array_keys($value[$address_component])
                                        ));
                                    }else{
                                        if(isset($value[$address_component])){
                                            $address_ready[$address_component] = $value[$address_component];
                                        }else{
                                            $address_ready[$address_component] = '';
                                        }
                                    }
                                }

                                    
                                }

                                $sender_addresses[implode(";", $address_ready)] = __('p.c. ', 'woocommerce-econt').$address_ready['city_post_code'].__(', t./v. ', 'woocommerce-econt').$address_ready['city'].__(', q.: ', 'woocommerce-econt').$address_ready['quarter'].', '.$address_ready['street'].', №: '.$address_ready['street_num'].__(', other: ', 'woocommerce-econt').$address_ready['other'];
                                  
    						}
                        }

                        if( get_option('econt_auto_refreshdata') != $this->auto_refreshdata){
                                update_option('econt_auto_refreshdata', $this->auto_refreshdata);
                        }
                        if( get_option('econt_auto_refreshdata_intl') != $this->auto_refreshdata_intl){
                                update_option('econt_auto_refreshdata_intl', $this->auto_refreshdata_intl);
                        }
                                  
					}
        
        $plugin_images_dir = ECONT_PLUGIN_URL . 'inc/css/images';

		$this->form_fields = array(
			'enabled' => array(
			'title' => __( 'Enable/Disable', 'woocommerce-econt' ),
			'type' => 'checkbox',
			'label' => __( 'Enable Econt Express Shipping Method', 'woocommerce-econt' ),
			'default' => 'yes'
			),

            'title_type' => array(
            'title' => __( 'Title type', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array('text' => __('text', 'woocommerce-econt'), 'image' => __('image', 'woocommerce-econt')),
            'description' => __('This setting controls the type of title (text or image) which the user sees during checkout.', 'woocommerce-econt'),
            ),

			'title' => array(
			'title' => __( 'Title', 'woocommerce-econt' ),
			'type' => 'text',
			'description' => __( 'This controls the title which the user sees during checkout.', 'woocommerce-econt' ),
			'default' => __( 'Econt Express Shipping Method', 'woocommerce-econt' ),
			//'desc_tip'      => true,
			),

            'title_image' => array(
            'title' => __( 'Title image', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array($plugin_images_dir . '/econt_shipping_logo_dark.png' => __('Dark', 'woocommerce-econt'), $plugin_images_dir . '/econt_shipping_logo_light.png' => __('Light', 'woocommerce-econt')),
            'description' => __('Chose title image style.', 'woocommerce-econt'),
            ),

			'description' => array(
			'title' => __( 'Customer Message', 'woocommerce-econt' ),
			'type' => 'textarea',
			'description' => __( 'Checkout description', 'woocommerce-econt' ),
			'default' => __( 'Shipping your goods with Econt Express.', 'woocommerce-econt' ),
			),
            'live' => array(
            'title' => __( 'Live or test?', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(1 => __('live', 'woocommerce-econt'), 0 => __('test', 'woocommerce-econt')),
            'description' => '<div id="woocommerce_econt_shipping_method_live_description"></div>',
            ),

			'username' => array(
            'title' => __( 'username', 'woocommerce-econt' ),
            'type' => 'text',
            'description' => __( 'Econt Express username. I do not have username in e-Econt, I want to <a href="https://ee.econt.com/load_direct.php?target=Register" target="_blank">register</a>.' , 'woocommerce-econt' )
            ),
            
            'password' => array(
            'title' => __( 'Password', 'woocommerce-econt' ),
            'type' => 'password',
            'description' =>  __( 'Econt Express password.', 'woocommerce-econt' ),
            ),
            );

            $form_fileds2 = array(
            'refreshdata' => array(
            'title' => __( 'Refresh Data', 'woocommerce-econt' ),
            'type' => 'button',
            'default' => __('Refresh', 'woocommerce-econt'),
            'description' =>  __( 'Refresh Econt Express Ofices, Cities, Streets.', 'woocommerce-econt' ),
            ),
            'refreshdata_intl' => array(
            'title' => __( 'Refresh Data International', 'woocommerce-econt' ),
            'type' => 'button',
            'default' => __('Refresh', 'woocommerce-econt'),
            'description' =>  __( 'Refresh Econt Express Cities in Romania and Greece.', 'woocommerce-econt' ),
            ),
            'refreshprofile' => array(
            'title' => __( 'Refresh Profile', 'woocommerce-econt' ),
            'type' => 'button',
            'default' => __('Refresh Profile', 'woocommerce-econt'),
            'description' =>  __( 'Sync customer profile settings with Econt Express API.', 'woocommerce-econt' ),
            ),

            'company' => array(
            'title' => __( 'Name of sender company ot person', 'woocommerce-econt' ),
            'type' => 'text',
            'description' => __( 'Please fill the details with which you subscribe in Econt Express system. Personal name or company name.', 'woocommerce-econt' ),
            'default' => $name,
            ),

            'name' => array(
            'title' => __( 'Contact Person', 'woocommerce-econt' ),
            'type' => 'text',
            'description' => __( 'Your Name', 'woocommerce-econt' ),
            'default' => $mol,
            ),
            
            'phone' => array(
            'title' => __( 'phone', 'woocommerce-econt' ),
            'type' => 'text',
            'description' => __( 'Your Phone registered in Econt Express account', 'woocommerce-econt' ),
            'default' => $phone,
            ),

            'email' => array(
            'title' => __( 'email', 'woocommerce-econt' ),
            'type' => 'text',
            'description' => __( 'Your email address', 'woocommerce-econt' ),
            'default' => $email,
            ),
            
            'address' => array(
            'title' => __( 'Sender Address', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => $sender_addresses,
            'description' => __('The addresses are taken from your Econt Express profile at http://ee.econt.com. Choose one if you want to be able to send from your door.', 'woocommerce-econt'),
            ),

            'office_postcode' => array(
            'type' => 'office_postcode',
            ),

            'office_town' => array(
            'type' => 'office_town',
            ),
			
			/*'office_postcode' => array(
            'title' => __( 'Econt Express Office Postcode', 'woocommerce-econt' ),
            'type' => 'text',
            'description' => __( 'Choose Econt Express office town postcode if you want to be able to send from office', 'woocommerce-econt' )
            ),*/

            

            'office_code' => array(
            'type' => 'office_code',
            ),

            'machine_postcode' => array(
            'type' => 'machine_postcode',
            ),

            'machine_town' => array(
            'type' => 'machine_town',
            ),
            
            /*'machine_postcode' => array(
            'title' => __( 'Econt Express APS Postcode', 'woocommerce-econt' ),
            'type' => 'text',
            'description' => __( 'Choose Econt Express APS town postcode if you want to be able to send from office', 'woocommerce-econt' )
            ),*/

            'machine_code' => array(
            'type' => 'machine_code',
            ),
            
            'payment_side' => array(
            'title' => __( 'Payment side', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array('RECEIVER' => __('Receiver', 'woocommerce-econt'), 'SENDER' => __('Sender', 'woocommerce-econt')),
            'description' => __('Payment side', 'woocommerce-econt'),
            ),

            'client_payment_type' => array(
            'title' => __( 'Choose the way you pay.', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => $key_words,
            'description' => __('When the shipping is payed by the sender if you pay on credit please chose your client number or Cash, Bonus points and Voucher', 'woocommerce-econt'),
            ),

            'cd' => array(
            'title' => __( 'Will you allow Cash on delivery', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(1 => __('Yes', 'woocommerce-econt'), 0 => __('No', 'woocommerce-econt')),
            'description' => __('Will you allow Cash on delivery', 'woocommerce-econt'),
            ),

            'client_cd_num' => array(
            'title' => __( 'Are you going to use an agreement for CD', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => $cd_agreement_nums,
            'description' => __('If you are going to use and agreement for collecting your cashe on delivery please select it.', 'woocommerce-econt'),
            ),

            'free_shipping_to_office' => array(
            'title' => __( 'Free shipping to Econt Office and APS', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(0 => __('No', 'woocommerce-econt'), 1 => __('Yes', 'woocommerce-econt')),
            'description' => __('Offer your customers free shipping to Econt Office and APS.', 'woocommerce-econt'),
            ),

            'free_shipping_sum' => array(
            'type' => 'free_shipping_sum',
            ),

            'free_shipping_count' => array(
            'title' => __( 'Free shipping above this count of items', 'woocommerce-econt' ),
            'type' => 'text',
            'default' => 0,
            'description' => __( 'Free shipping for orders above this count of items if you whrite down 0 there will be no free shipping.', 'woocommerce-econt' )
            ),

            'free_shipping_weight' => array(
            'title' => __( 'Free shipping above this weight', 'woocommerce-econt' ),
            'type' => 'text',
            'default' => 0,
            'description' => __( 'Free shipping for orders above this weight in kg if you whrite down 0 there will be no free shipping.', 'woocommerce-econt' )
            ),

            'oc' => array(
            'title' => __( 'Declared Value', 'woocommerce-econt' ),
            'type' => 'text',
            'default' => 0,
            'description' => __( '0 = no "DV", 1 = Always "DV", 2...n =  The cost above which "DV" will be enabled', 'woocommerce-econt' )
            ),

            'send_from' => array(
            'title' => __( 'Default send from', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array('OFFICE' => __('Office', 'woocommerce-econt'), 'DOOR' => __('Door', 'woocommerce-econt'), 'MACHINE' => __('Machine', 'woocommerce-econt')),
            'description' => __('Chose from where you will send your goods by default: Econt Office or your address.', 'woocommerce-econt'),
            ),
            //new
            'send_to_door' => array(
            'title' => __( 'Offer your clients delivery to door', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(1 => __('Yes', 'woocommerce-econt'), 0 => __('No', 'woocommerce-econt')),
            'description' => __('Offer your clients delivery to door', 'woocommerce-econt'),
            ),

            'send_to_office' => array(
            'title' => __( 'Offer your clients delivery to Econt offices', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(1 => __('Yes', 'woocommerce-econt'), 0 => __('No', 'woocommerce-econt')),
            'description' => __('Offer your clients delivery to Econt offices', 'woocommerce-econt'),
            ),

            'send_to_machine' => array(
            'title' => __( 'Offer your clients delivery to Econt machine offices', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(1 => __('Yes', 'woocommerce-econt'), 0 => __('No', 'woocommerce-econt')),
            'description' => __('"24 часа Еконт - Автоматична пощенска станция" (АПС) е устройство, с което сами изпращате и получавате пратки денонощно, без почивен ден.  Научете повече на: <a href="http://www.econt.com/24-chasa-econt-aps/" target="_blank">http://www.econt.com/24-chasa-econt-aps/</a>', 'woocommerce-econt'),
            ),

            'city_courier' => array(
            'title' => __( 'Offer your customers express city courier delivery up to 60, 90 or 120 minutes', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(0 => __('No', 'woocommerce-econt'), 1 => __('Yes', 'woocommerce-econt')),
            'description' => __('Offer your customers express city courier delivery up to 60, 90 or 120 minutes', 'woocommerce-econt'),
            ),

			'dc' => array(
            'title' => __( 'Attach a service acknowledgment', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(0 => __('No', 'woocommerce-econt'), 1 => __('Yes', 'woocommerce-econt')),
            'description' => __('Attach a service acknowledgment', 'woocommerce-econt'),
            ),

			'dc_cp' => array(
            'title' => __( 'Attach a service acknowledgment/bill of goods', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(0 => __('No', 'woocommerce-econt'), 1 => __('Yes', 'woocommerce-econt')),
            'description' => __('Attach a service acknowledgment/bill of goods', 'woocommerce-econt'),
            ),

            'sms_notification' => array(
            'title' => __( 'SMS notification', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(0 => __('No', 'woocommerce-econt'), 1 => __('Yes', 'woocommerce-econt')),
            'description' => __('Send SMS to receiver\'s phone number when the shipment has arrived at the office from which it has to be taken or the shipment is taken by a courier for delivery when the shipping is to address.', 'woocommerce-econt'),
            ),

            'sms_no' => array(
            'title' => __( 'SMS on delivery', 'woocommerce-econt' ),
            'type' => 'text',
            'default' => '',
            'description' => __( 'If you want to receive sms notification when the shipment is delivered to the recipient please write down the phone number to which the SMS is going to be send. If you leave this field blank this service wont be activated.', 'woocommerce-econt' )
            ),

			'invoice' => array(
            'title' => __( 'To add the service of delivering an invoice before paying cash on delivery', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(0 => __('No', 'woocommerce-econt'), 1 => __('Yes', 'woocommerce-econt')),
            'description' => __('To add the service of delivering an invoice before paying cash on delivery:', 'woocommerce-econt'),
            ),

            'pay_after' => array(
            'title' => __( 'Customer can pay after accepting or testing the goods', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(0 => __('None', 'woocommerce-econt'), 'accept' => __('Accept', 'woocommerce-econt'), 'test' => __('Test', 'woocommerce-econt')),
            'description' => __('Customer can pay after accepting or testing the goods', 'woocommerce-econt'),
            ),

            'priority_time' => array(
            'title' => __( 'Attach a time priority', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(0 => __('No', 'woocommerce-econt'), 1 => __('Yes', 'woocommerce-econt')),
            'description' => __('Attach a time priority', 'woocommerce-econt'),
            ),

            'delivery_days' => array(
            'title' => __( 'offer the customer a choice of day for delivery', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(0 => __('No', 'woocommerce-econt'), 1 => __('Yes', 'woocommerce-econt')),
            'description' => __('offer the customer a choice of day for delivery', 'woocommerce-econt'),
            ),

            'partial_delivery' => array(
            'title' => __( 'offer the customer partial delivery', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(0 => __('No', 'woocommerce-econt'), 1 => __('Yes', 'woocommerce-econt')),
            'description' => __('offer the customer partial delivery', 'woocommerce-econt'),
            ),

            'inventory' => array(
            'title' => __( 'Submission of packing list', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(0 => __('No', 'woocommerce-econt'), 'DIGITAL' => __('Digital', 'woocommerce-econt'), 'LOADING' => __('Attached to the parcel', 'woocommerce-econt')),
            'description' => __('Submission of packing list', 'woocommerce-econt'),
            ),

            'return_item' => array(
            'title' => __( 'Ability to return the item already purchased', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(0 => __('No', 'woocommerce-econt'), 1 => __('Yes', 'woocommerce-econt')),
            'description' => __('Ability to return the item already purchased:', 'woocommerce-econt'),
            ),

            'instructions_take' => array(
            'title' => __( 'Choose take custom instructions', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => $instructions_take,
            'description' => __('Chose take custom instructions', 'woocommerce-econt'),
            ),

            'instructions_give' => array(
            'title' => __( 'Choose give custom instructions', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => $instructions_give,
            'description' => __('Chose give custom instructions', 'woocommerce-econt'),
            ),

            'instructions_return' => array(
            'title' => __( 'Choose return custom instructions', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => $instructions_return,
            'description' => __('Chose return custom instructions', 'woocommerce-econt'),
            ),

            'instructions_services' => array(
            'title' => __( 'Choose custom instructions for services', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => $instructions_services,
            'description' => __('Chose custom instructions for services', 'woocommerce-econt'),
            ),

            'inc_shipping_cost' => array(
            'title' => __( 'Include Shipping Cost to Total', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(1 => __('Yes', 'woocommerce-econt'), 0 => __('No', 'woocommerce-econt')),
            'description' => __('Include Shipping Cost to Total', 'woocommerce-econt'),
            ),

            'hide_cart_shipping_descr' => array(
            'title' => __( 'Hide Shipping description in cart page', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(0 => __('No', 'woocommerce-econt'), 1 => __('Yes', 'woocommerce-econt')),
            'default' => 1,
            'description' => __('Hide Shipping description in cart page', 'woocommerce-econt'),
            ),
            'send_tracking_email' => array(
            'title' => __( 'Send tracking email', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(0 => __('No', 'woocommerce-econt'), 1 => __('Yes', 'woocommerce-econt')),
            'description' => __('Send tracking email when the way-bill is created.', 'woocommerce-econt'),
            ),
            'tracking_email_from_name' => array(
            'title' => __( 'Tracking email "From" name', 'woocommerce-econt' ),
            'type' => 'text',
            'description' => __( 'The name of the tracking email sender.', 'woocommerce-econt' )
            ),
            'tracking_email_from_address' => array(
            'title' => __( 'Tracking email "From" address', 'woocommerce-econt' ),
            'type' => 'text',
            'description' => __( 'The email address of the tracking email sender.', 'woocommerce-econt' )
            ),
            'auto_refreshdata' => array(
            'title' => __( 'Auto Refresh Data', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(0 => __('No', 'woocommerce-econt'), 1 => __('Yes', 'woocommerce-econt')),
            'description' => __('Automatically Refresh Econt Express Ofices, Cities, Streets once a day. WP Cron must be enabled.', 'woocommerce-econt'),
            ),
            'auto_refreshdata_intl' => array(
            'title' => __( 'Auto Refresh Data International', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(0 => __('No', 'woocommerce-econt'), 1 => __('Yes', 'woocommerce-econt')),
            'description' => __('Automatically Refresh Econt Express Cities in Romania and Greece.', 'woocommerce-econt'),
            ),
            'shipping_to_style' => array(
            'title' => __( 'Checkout "shipping to" style', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array('dropdown' => __('dropdown', 'woocommerce-econt'), 'buttons' => __('radio buttons', 'woocommerce-econt'), 'icons' => __('icons', 'woocommerce-econt')),
            'description' => __('Checkout "shipping to" field style', 'woocommerce-econt'),
            ),
            'open_layers_maps_office_locator' => array(
            'title' => __( 'Office locator', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(1 => __('Yes', 'woocommerce-econt'), 0 => __('No', 'woocommerce-econt')),
            'description' => __('Show map with offices and APTs in Checkout for easy selection.', 'woocommerce-econt'),
            ),
            'checkout_tooltips' => array(
            'title' => __( 'Checkout Tooltips', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(1 => __('Yes', 'woocommerce-econt'), 0 => __('No', 'woocommerce-econt')),
            'description' => __('Show informational Tooltips on hover shipping fileds in Checkout page.', 'woocommerce-econt'),
            ),
            'optimize_scripts_loading' => array(
            'title' => __( 'Optimize Scripts Loading', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(0 => __('No', 'woocommerce-econt'), 1 => __('Yes', 'woocommerce-econt')),
            'description' => __('Restrict the loading of plugin\'s scripts and styles website wide and allow them to load only in Checkout, Cart, My Account and backend pages.', 'woocommerce-econt'),
            ),
            'local_storage' => array(
            'title' => __( 'Save last entered address', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(1 => __('Yes', 'woocommerce-econt'), 2 => __('No', 'woocommerce-econt')),
            'description' => __('Save last entered address in browser local storage.', 'woocommerce-econt'),
            ),
            'fast_ajax' => array(
            'title' => __( 'Fast AJAX', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(0 => __('No', 'woocommerce-econt'), 1 => __('Yes', 'woocommerce-econt')),
            'description' => __('Make addresses searches faster by executing AJAX request directly. Some hosting providers may restict this method and additional configuration to be required.', 'woocommerce-econt'),
            ),
            'autocomplete_ajax_delay' => array(
            'title' => __( 'Autocomplete AJAX delay', 'woocommerce-econt' ),
            'type' => 'number',
            'default' => 0,
            'description' => __( 'The delay in miliseconds of AJAX requests in Checkout autocomplete fields. This setting is usefull for stores hosted on hosting servers with limited resources and load restrictions but if it is too heigh it can affect negative the Checkout User Exprerience. If you are not sure leave blank or enter 250', 'woocommerce-econt' )
            ),
            'hide_quarter_fields' => array(
            'title' => __( 'Hide Quarter Fields in Checkout', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(0 => __('No', 'woocommerce-econt'), 1 => __('Yes', 'woocommerce-econt')),
            'description' => __('Hide quarter fields in the shipping to address form in Checkout.', 'woocommerce-econt'),
            ),

            'shipping_zones_support' => array(
            'title' => __( 'Enable shipping zones support', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(0 => __('No', 'woocommerce-econt'), 1 => __('Yes', 'woocommerce-econt')),
            'description' => __('Enable shipping zones support. If you choose "Yes" after saving the changes, be sure to create Shipping Zones from "WooCommerce>Settings>Shipping" and add the Econt delivery method to the Shipping Zones in which you want to deliver with Econt.', 'woocommerce-econt'),
            ),

            'show_checkout_country_field' => array(
            'title' => __( 'Show country field in Checkout', 'woocommerce-econt' ),
            'type' => 'select',
            'options' => array(0 => __('No', 'woocommerce-econt'), 1 => __('Yes', 'woocommerce-econt')),
            'description' => __('Show billing country field in Checkout.', 'woocommerce-econt'),
            ),

            'shipping_payments' => array(
            'type' => 'shipping_payments',

            ),

		);
		if($this->username && $this->password){
         $this->form_fields =   array_merge($this->form_fields, $form_fileds2);
        }

	}

    public function admin_options() {
        parent::admin_options();

        ob_start() ;
        if ( version_compare( WC_VERSION, '8.4', '>=' ) && version_compare( WC_VERSION, '8.5', '<=' ) ) { 
        ?>
        <style type="text/css">
            #<?php echo $this->plugin_id . $this->id . '_title_image_style'; ?> {
                display: block;
                padding-top: 10px;
            }
            #<?php echo $this->plugin_id . $this->id . '_title_image_style'; ?>.hide {
                display: none;
            }

            .hide {
                display: none;
            }
            .wc-shipping-zone-method-fields {
                display: none;
            }
            .wc-backbone-modal-shipping-method-settings .wc-shipping-zone-method-fields>label {
                font-weight: 700;
            }
            #free_shipping_sum {
                width: 100px;
            }

        </style>
        <script type="text/javascript">
            
            jQuery(document).ready(function($){
                $('.wc-shipping-zone-method-fields').wrapAll( '<div class="wc-backbone-modal-shipping-method-settings" style="max-width:600px"></div>' );
                 
                 $(".wc-backbone-modal-shipping-method-settings").before('<iframe width="688" height="387" style="padding-bottom: 20px;" src="https://www.youtube.com/embed/0FZ9OXyk-5Q?&start=108&rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>');
                                                                             
                (function(){
                    if(jQuery('#<?php echo $this->plugin_id . $this->id . '_send_tracking_email'; ?>').val() == '0'){
                        jQuery("#<?php echo $this->plugin_id . $this->id . '_tracking_email_from_name'; ?>").closest('fieldset').hide();
                        jQuery("#<?php echo $this->plugin_id . $this->id . '_tracking_email_from_address'; ?>").closest('fieldset').hide();
                        jQuery("label[for='<?php echo $this->plugin_id . $this->id . '_tracking_email_from_name'; ?>']").hide();
                        jQuery("label[for='<?php echo $this->plugin_id . $this->id . '_tracking_email_from_address'; ?>']").hide();
                    }else{
                        jQuery("#<?php echo $this->plugin_id . $this->id . '_tracking_email_from_name'; ?>").closest('fieldset').show();
                        jQuery("#<?php echo $this->plugin_id . $this->id . '_tracking_email_from_address'; ?>").closest('fieldset').show();
                        jQuery("label[for='<?php echo $this->plugin_id . $this->id . '_tracking_email_from_name'; ?>']").show();
                        jQuery("label[for='<?php echo $this->plugin_id . $this->id . '_tracking_email_from_address'; ?>']").show();
                    }
                }());

                jQuery('#<?php echo $this->plugin_id . $this->id . '_send_tracking_email'; ?>').on('change', function () {
                    if(this.value == '0'){
                        jQuery("#<?php echo $this->plugin_id . $this->id . '_tracking_email_from_name'; ?>").closest('fieldset').hide();
                        jQuery("#<?php echo $this->plugin_id . $this->id . '_tracking_email_from_address'; ?>").closest('fieldset').hide();
                        jQuery("label[for='<?php echo $this->plugin_id . $this->id . '_tracking_email_from_name'; ?>']").hide();
                        jQuery("label[for='<?php echo $this->plugin_id . $this->id . '_tracking_email_from_address'; ?>']").hide();
                    }else{
                        jQuery("#<?php echo $this->plugin_id . $this->id . '_tracking_email_from_name'; ?>").closest('fieldset').show();
                        jQuery("label[for='<?php echo $this->plugin_id . $this->id . '_tracking_email_from_name'; ?>']").show();
                        jQuery("#<?php echo $this->plugin_id . $this->id . '_tracking_email_from_address'; ?>").closest('fieldset').show();
                        jQuery("label[for='<?php echo $this->plugin_id . $this->id . '_tracking_email_from_address'; ?>']").show();
                    }
                });

                $('.wc-shipping-zone-method-fields').show();

            });

            document.addEventListener('DOMContentLoaded', function() {
                function iconFieldChange() {
                    if (!icon) {
                        icon = document.createElement('img');
                        icon.setAttribute('id', '<?php echo $this->plugin_id . $this->id . '_title_image_style'; ?>')
                        iconField.parentNode.insertBefore(icon, iconField.nextSibling);
                    }

                    let selectedIndexValue = iconField.options[iconField.selectedIndex].value;
                    if (selectedIndexValue === '') icon.classList.add('hide');
                    else {
                        icon.setAttribute('src', selectedIndexValue);
                        icon.classList.remove('hide');
                    }
                }
                function titleFieldChange() {
                    
                    let titleTextfieldset = document.querySelector('#<?php echo $this->plugin_id . $this->id . '_title'; ?>').closest('fieldset');
                    let titleImagefieldset = document.querySelector('#<?php echo $this->plugin_id . $this->id . '_title_image'; ?>').closest('fieldset');
                    let titleTextlabel = document.querySelector("label[for='<?php echo $this->plugin_id . $this->id . '_title'; ?>']");
                    let titleImagelabel = document.querySelector("label[for='<?php echo $this->plugin_id . $this->id . '_title_image'; ?>']");

                    let selectedIndexValue = titleField.options[titleField.selectedIndex].value;
                    if (selectedIndexValue === 'image'){ //icon.classList.add('hide');
                        titleImagefieldset.classList.remove('hide');
                        titleImagelabel.classList.remove('hide');
                        titleTextfieldset.classList.add('hide');
                        titleTextlabel.classList.add('hide');
                    }else {
                        titleTextfieldset.classList.remove('hide');
                        titleTextlabel.classList.remove('hide');
                        titleImagefieldset.classList.add('hide');
                        titleImagelabel.classList.add('hide');
                    }
                }

                let icon;
                let iconField = document.querySelector('#<?php echo $this->plugin_id . $this->id . '_title_image'; ?>');
                let titleField = document.querySelector('#<?php echo $this->plugin_id . $this->id . '_title_type'; ?>');

               iconField.addEventListener('change', iconFieldChange);
               titleField.addEventListener('change', titleFieldChange);
               iconFieldChange();
               titleFieldChange();
            });
            </script>
            <?php }else{ ?>
            <style type="text/css">
            #<?php echo $this->plugin_id . $this->id . '_title_image_style'; ?> {
                display: block;
                padding-top: 10px;
            }
            #<?php echo $this->plugin_id . $this->id . '_title_image_style'; ?>.hide {
                display: none;
            }

            .hide {
                display: none;
            }
            .wc-shipping-zone-method-fields {
                display: none;
            }
        </style>
        <script type="text/javascript">

            jQuery(".form-table").before('<iframe width="688" height="387" style="padding-bottom: 20px;" src="https://www.youtube.com/embed/0FZ9OXyk-5Q?&start=108&rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>');

            document.addEventListener('DOMContentLoaded', function() {
                function iconFieldChange() {
                    if (!icon) {
                        icon = document.createElement('img');
                        icon.setAttribute('id', '<?php echo $this->plugin_id . $this->id . '_title_image_style'; ?>')
                        iconField.parentNode.insertBefore(icon, iconField.nextSibling);
                    }

                    let selectedIndexValue = iconField.options[iconField.selectedIndex].value;
                    if (selectedIndexValue === '') icon.classList.add('hide');
                    else {
                        icon.setAttribute('src', selectedIndexValue);
                        icon.classList.remove('hide');
                    }
                }
                function titleFieldChange() {
                    
                    let titleTextFieldtr = document.querySelector('#<?php echo $this->plugin_id . $this->id . '_title'; ?>').closest('tr');
                    let titleImageFieldtr = document.querySelector('#<?php echo $this->plugin_id . $this->id . '_title_image'; ?>').closest('tr'); 

                    let selectedIndexValue = titleField.options[titleField.selectedIndex].value;
                    if (selectedIndexValue === 'image'){ //icon.classList.add('hide');
                        titleImageFieldtr.classList.remove('hide');
                        titleTextFieldtr.classList.add('hide');
                    }else {
                        titleTextFieldtr.classList.remove('hide');
                        titleImageFieldtr.classList.add('hide');
                    }
                }
                let icon;
                let iconField = document.querySelector('#<?php echo $this->plugin_id . $this->id . '_title_image'; ?>')
                let titleField = document.querySelector('#<?php echo $this->plugin_id . $this->id . '_title_type'; ?>')
               iconField.addEventListener('change', iconFieldChange);
                titleField.addEventListener('change', titleFieldChange);
                iconFieldChange();
                titleFieldChange();
            });

                (function(){
                  if(jQuery('#<?php echo $this->plugin_id . $this->id . '_send_tracking_email'; ?>').val() == '0'){
                    jQuery("#<?php echo $this->plugin_id . $this->id . '_tracking_email_from_name'; ?>").closest('tr').hide();
                    jQuery("#<?php echo $this->plugin_id . $this->id . '_tracking_email_from_address'; ?>").closest('tr').hide();
                  }else{
                    jQuery("#<?php echo $this->plugin_id . $this->id . '_tracking_email_from_name'; ?>").closest('tr').show();
                    jQuery("#<?php echo $this->plugin_id . $this->id . '_tracking_email_from_address'; ?>").closest('tr').show();
                  }
                }());

                jQuery('#<?php echo $this->plugin_id . $this->id . '_send_tracking_email'; ?>').on('change', function () {
                  if(this.value == '0'){
                    jQuery("#<?php echo $this->plugin_id . $this->id . '_tracking_email_from_name'; ?>").closest('tr').hide();
                    jQuery("#<?php echo $this->plugin_id . $this->id . '_tracking_email_from_address'; ?>").closest('tr').hide();
                  }else{
                    jQuery("#<?php echo $this->plugin_id . $this->id . '_tracking_email_from_name'; ?>").closest('tr').show();
                    jQuery("#<?php echo $this->plugin_id . $this->id . '_tracking_email_from_address'; ?>").closest('tr').show();
                  }
                });
        </script>    
        <?php
        }
        $outputOther = ob_get_contents();
        ob_end_clean();

        echo $outputOther;
    }

    public function generate_shipping_payments_html() {
        ob_start();
        $this->shipping_payments = get_option( 'econt_shipping_payments');
        $types = array(
            'shared' => __('Shared', 'woocommerce-econt'),
            'incod' => __('In COD', 'woocommerce-econt'),
        );
        $countries = array(
            'BGR' => __('Bulgaria', 'woocommerce-econt'),
            'GRC' => __('Greece', 'woocommerce-econt'),
            'ROU' => __('Romania', 'woocommerce-econt'),
        );
        if ( version_compare( WC_VERSION, '8.4', '>=' ) && version_compare( WC_VERSION, '8.5', '<=' ) ) {
        ?>
            <label for="shipping_payments"><?php _e( 'Shipping Payments', 'woocommerce-econt' ); ?></label>
            <fieldset class="forminp" id="shipping_payments">
        <?php }else{ ?>
            <tr valign="top">
            <th scope="row" class="titledesc"><?php _e( 'Shipping Payments', 'woocommerce-econt' ); ?>:</th>
            <td class="forminp" id="shipping_payments">
        <?php } ?>
            
                <table id="tblLocations" class="widefat wc_input_table sortable" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width:5%;white-space:break-spaces;" class="sort">&nbsp;</th>
                            <th style="width:19%;white-space:break-spaces;"><?php _e( 'Order Cost Above:', 'woocommerce-econt' ); ?></th>
                            <th style="width:19%;white-space:break-spaces;"><?php _e( 'The customer will pay for shipping to door:', 'woocommerce-econt' ); ?></th>
                            <th style="width:19%;white-space:break-spaces;"><?php _e( 'The customer will pay for shipping to office or APS', 'woocommerce-econt' ); ?></th>
                            <th style="width:19%;white-space:break-spaces;"><?php _e( 'Type', 'woocommerce-econt' ); ?></th>
                            <th style="width:19%;white-space:break-spaces;"><?php _e( 'Country', 'woocommerce-econt' ); ?></th>
                        </tr>
                    </thead>
                    <tbody class="shipping_payment">
                        <?php
                        $i = -1;
                        if ( $this->shipping_payments ) {
                            foreach ( $this->shipping_payments as $shipping_payment ) {
                                $i++;
                                echo '<tr class="shipping_payment">
                                    <td class="sort"></td>
                                    <td><input type="text" value="' . esc_attr( $shipping_payment['order_amount'] ) . '" name="shipping_payments[' . $i . '][order_amount]" /></td>
                                    <td><input type="text" value="' . esc_attr( $shipping_payment['receiver_amount'] ) . '" name="shipping_payments[' . $i . '][receiver_amount]" /></td>
                                    <td><input type="text" value="' . esc_attr( $shipping_payment['receiver_amount_office'] ) . '" name="shipping_payments[' . $i . '][receiver_amount_office]" /></td>';
                                ?>
                                <td>
                                    <select name="shipping_payments[<?php echo $i; ?>][type]">
                                        <?php foreach ($types as $id => $name) { ?>
                                        <option value="<?php echo $id; ?>" <?php echo ( $shipping_payment['type'] == $id ) ? 'selected' : ''; ?>><?php echo $name; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="shipping_payments[<?php echo $i; ?>][country_id]">
                                        <option value="0"><?php _e('All', 'woocommerce-econt'); ?></option>
                                        <?php foreach ($countries as $id => $name) { ?>
                                        <option value="<?php echo $id; ?>" <?php echo ( $shipping_payment['country_id'] == $id ) ? 'selected' : ''; ?>><?php echo $name; ?></option>
                                        <?php } ?>
                                    </select>
                                </td></tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="7"><a href="#" class="add button"><?php _e( '+ Add Row', 'woocommerce-econt' ); ?></a> <a href="#" class="remove_rows button"><?php _e( 'Remove selected Row(s)', 'woocommerce-econt' ); ?></a></th>
                        </tr>
                    </tfoot>
                </table>
            <?php if ( version_compare( WC_VERSION, '8.4', '>=' ) && version_compare( WC_VERSION, '8.5', '<=' ) ) { ?>
            </fieldset>
            <?php }else{ ?>
                </td>
            </tr>
            <?php } ?>
            
                <script type="text/javascript">
                jQuery(function() {
                    jQuery('#shipping_payments').on( 'click', 'a.add', function(){
                        var size = jQuery('#shipping_payments tbody .shipping_payment').size();
                        jQuery('<tr class="shipping_payment">\
                                    <td class="sort"></td>\
                                    <td><input type="text" name="shipping_payments[' + size + '][order_amount]" /></td>\
                                    <td><input type="text" name="shipping_payments[' + size + '][receiver_amount]" /></td>\
                                    <td><input type="text" name="shipping_payments[' + size + '][receiver_amount_office]" /></td>\
                                    <td><select name="shipping_payments[' + size + '][type]">\
                                        <?php foreach ($types as $id => $name) { ?>\
                                        <option value="<?php echo $id; ?>"><?php echo $name; ?></option>\
                                        <?php } ?>\
                                    </select></td>\
                                    <td><select name="shipping_payments[' + size + '][country_id]">\
                                    <option value="0"><?php _e('All', 'woocommerce-econt'); ?></option>\
                                        <?php foreach ($countries as $id => $name) { ?>\
                                        <option value="<?php echo $id; ?>"><?php echo $name; ?></option>\
                                        <?php } ?>\
                                    </select></td>\
                                </tr>').appendTo('#shipping_payments table tbody');

                        return false;
                    });
                    jQuery(document).on('click', 'a.remove_rows', function(e){
                        e.preventDefault();
                        jQuery('.last_selected').remove();
                        jQuery('tr').removeClass('.last_selected');
                    });
                    jQuery(document).on('focus', '#shipping_payments table tbody > tr > td > input', function(e){
                        jQuery('tr').removeClass('last_selected');
                        jQuery(this).parent().parent().addClass('last_selected');
                    });
                            
                    jQuery(function () {
                        jQuery("#tblLocations").sortable({
                            items: 'tr',
                            cursor: 'pointer',
                            axis: 'y',
                            dropOnEmpty: false,
                            start: function (e, ui) {
                            },
                            stop: function (e, ui) {
                                jQuery(this).find("tr").each(function (index) {
                                    if (index > 0) {
                                    }
                                });
                            }
                        });
                    });
                });
                </script>
        <?php
        return ob_get_clean();

    }

    public function generate_free_shipping_sum_html() {
            ob_start();
            $this->free_shipping_sum = get_option( 'econt_free_shipping_sum');
            $this->free_shipping_sum_to_office = get_option( 'econt_free_shipping_sum_to_office');
            ?>
            <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="woocommerce_econt_shipping_method_free_shipping_sum"><?php _e( 'Free shipping above this sum', 'woocommerce-econt' ); ?></label>
            </th>
            <td class="forminp">
                <fieldset>
                    <legend class="screen-reader-text"><span><?php _e( 'Free shipping above this sum', 'woocommerce-econt' ); ?></span></legend>
                    <input type="text" name="free_shipping_sum" id="free_shipping_sum" value="<?php echo $this->free_shipping_sum; ?>"/>
                    <span id="econt-to-office-only"><?php _e( 'to office only', 'woocommerce-econt' ); ?>
                <input type="checkbox" name="free_shipping_sum_to_office" id="free_shipping_sum_to_office" <?php echo ($this->free_shipping_sum_to_office) ? 'checked': ''; ?>/></span>
                    <p class="description"><?php _e( 'Free shipping for orders above this sum if you whrite down 0 there will be no free shipping.', 'woocommerce-econt' ); ?></p>
                </fieldset>
            </td>
        </tr>
            <?php
            return ob_get_clean();
        
    }

    public function generate_office_town_html() {
            ob_start();
            if(!empty(get_option('econt_sender_office_town'))){
                $this->office_town = get_option('econt_sender_office_town');
            }
            $office_town          = array();
            $office_town[0]       = __('please select', 'woocommerce-econt');
            $office_office        = array();
            $office_office[0]     = __('please select', 'woocommerce-econt');
            if($this->office_postcode && $this->office_town){
                if(class_exists('Econt_mySQL')){
                    $econt_mysql = new Econt_mySQL; 
                }
                unset($office_town[0]);
                $office_town[$this->office_town] = $this->office_town;

                $city_id = $econt_mysql->getCityIdByCityPostCode($this->office_postcode);
                $offices = $econt_mysql->getOfficesByCityId($city_id, '');

                if($city_id > 0){
                    unset($office_office[0]);  
                    foreach ($offices as $row) {

                        $office_office[$row['office_code']] = $row['name'].' ['.$row['address'].']';
                                
                    }
                }

                update_option('econt_sender_office_office', $office_office);

            }

            ?>
            <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="woocommerce_econt_shipping_method_office_town"><?php _e( 'Office Town', 'woocommerce-econt' ); ?></label>
            </th>
            <td class="forminp">
                <fieldset>
                    <legend class="screen-reader-text"><span><?php _e( 'Office Town', 'woocommerce-econt' ); ?></span></legend>
                    <span><select class="select" name="woocommerce_econt_shipping_method_office_town" id="woocommerce_econt_shipping_method_office_town" style="" tabindex="-1" aria-hidden="true" autocomplete="off">
                    <?php
                    foreach ($office_town as $key => $value) {
                    ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php
                    }
                    ?>
                    </select></span>
                    <p class="description"><?php _e( 'Choose Econt Express office town if you want to be able to send from office', 'woocommerce-econt' ); ?></p>
                </fieldset>
            </td>
        </tr>
            <?php
            return ob_get_clean();
        
    }

    public function generate_office_postcode_html() {
            ob_start();
            if(!empty(get_option('econt_sender_office_postcode'))){
                $this->office_postcode = get_option('econt_sender_office_postcode');
            }
            ?>
            <tr valign="top" style="display:none;">
            <th scope="row" class="titledesc">
                <label for="woocommerce_econt_shipping_method_office_postcode"><?php _e( 'Econt Express Office Postcode', 'woocommerce-econt' ); ?></label>
            </th>
            <td class="forminp">
                <fieldset>
                    <legend class="screen-reader-text"><span><?php _e( 'Econt Express Office Postcode', 'woocommerce-econt' ); ?></span></legend>
                    <span><input type="text" name="woocommerce_econt_shipping_method_office_postcode" id="woocommerce_econt_shipping_method_office_postcode" value="<?php echo $this->office_postcode; ?>"/></span>
                    <p class="description"><?php _e( 'Choose Econt Express office town postcode if you want to be able to send from office', 'woocommerce-econt' ); ?></p>
                </fieldset>
            </td>
        </tr>
            <?php
            return ob_get_clean();
        
    }

    public function generate_office_code_html() {
            ob_start();
            if(!empty(get_option('econt_sender_office_code'))){
                $this->office_code = get_option('econt_sender_office_code');
            }
            $office_office = get_option('econt_sender_office_office');
            if( empty($office_office) ){
                $office_office          = array();
                $office_office[0]       = __('please select', 'woocommerce-econt'); 
            }
            ?>
            <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="woocommerce_econt_shipping_method_office_code"><?php _e( 'Econt Express Office', 'woocommerce-econt' ); ?></label>
            </th>
            <td class="forminp">
                <fieldset>
                    <legend class="screen-reader-text"><span><?php _e( 'Econt Express Office', 'woocommerce-econt' ); ?></span></legend>
                    <span><select class="select" name="woocommerce_econt_shipping_method_office_code" id="woocommerce_econt_shipping_method_office_code" style="" tabindex="-1" aria-hidden="true" autocomplete="off">
                    <?php
                    foreach ($office_office as $key => $value) {
                    ?>
                    <option value="<?php echo $key; ?>" <?php echo ($key == $this->office_code) ? 'selected' : ''; ?> ><?php echo $value; ?></option>
                    <?php
                    }
                    ?>
                    </select></span>
                    <p class="description"><?php _e('Choose Econt Express office if you want to be able to send from office', 'woocommerce-econt'); ?></p>
                </fieldset>
            </td>
        </tr>
            <?php
            return ob_get_clean();
        
    }


        public function generate_machine_town_html() {
            ob_start();
            if(!empty(get_option('econt_sender_machine_town'))){
                $this->machine_town = get_option('econt_sender_machine_town');
            }
            $machine_town          = array();
            $machine_town[0]       = __('please select', 'woocommerce-econt');
            $machine_machine       = array();
            $machine_machine[0]    = __('please select', 'woocommerce-econt');
            if($this->machine_town && $this->machine_postcode){
                if(class_exists('Econt_mySQL')){
                    $econt_mysql = new Econt_mySQL; 
                }
                unset($machine_town[0]);
                $machine_town[$this->machine_town] = $this->machine_town;
                $this->office_town = get_option('econt_sender_machine_town');

                $city_id = $econt_mysql->getCityIdByCityPostCode($this->machine_postcode);
                $is_machine = 1;
                $machines = $econt_mysql->getOfficesByCityId($city_id, $is_machine);
                if($city_id > 0){
                    unset($machine_machine[0]);
                    foreach ($machines as $row) {

                        $machine_machine[$row['office_code']] = $row['name'].' ['.$row['address'].']';
                                
                    }
                }
                update_option('econt_sender_machine_machine', $machine_machine);
            
            }

            ?>
            <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="woocommerce_econt_shipping_method_machine_town"><?php _e( 'APS Town', 'woocommerce-econt' ); ?></label>
            </th>
            <td class="forminp">
                <fieldset>
                    <legend class="screen-reader-text"><span><?php _e( 'APS Town', 'woocommerce-econt' ); ?></span></legend>
                    <span><select class="select" name="woocommerce_econt_shipping_method_machine_town" id="woocommerce_econt_shipping_method_machine_town" style="" tabindex="-1" aria-hidden="true" autocomplete="off">
                    <?php
                    foreach ($machine_town as $key => $value) {
                    ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php
                    }
                    ?>
                    </select></span>
                    <p class="description"><?php _e( 'Choose Econt Express office town if you want to be able to send from APS', 'woocommerce-econt' ); ?></p>
                </fieldset>
            </td>
        </tr>
            <?php
            return ob_get_clean();
        
    }

    public function generate_machine_postcode_html() {
            ob_start();
            if(!empty(get_option('econt_sender_machine_postcode'))){
                $this->machine_postcode = get_option('econt_sender_machine_postcode');
            }
            ?>
            <tr valign="top" style="display: none;">
            <th scope="row" class="titledesc">
                <label for="woocommerce_econt_shipping_method_machine_postcode"><?php _e( 'Econt Express APS Postcode', 'woocommerce-econt' ); ?></label>
            </th>
            <td class="forminp">
                <fieldset>
                    <legend class="screen-reader-text"><span><?php _e( 'Econt Express APS Postcode', 'woocommerce-econt' ); ?></span></legend>
                    <span><input type="text" name="woocommerce_econt_shipping_method_machine_postcode" id="woocommerce_econt_shipping_method_machine_postcode" value="<?php echo $this->machine_postcode; ?>"/></span>
                    <p class="description"><?php _e( 'Choose Econt Express APS town postcode if you want to be able to send from APS', 'woocommerce-econt' ); ?></p>
                </fieldset>
            </td>
        </tr>
            <?php
            return ob_get_clean();
        
    }

    public function generate_machine_code_html() {
            ob_start();
            if(!empty(get_option('econt_sender_machine_code'))){
                $this->machine_code = get_option('econt_sender_machine_code');
            }
            $machine_machine = get_option('econt_sender_machine_machine');
            if( empty($machine_machine) ){
                $machine_machine          = array();
                $machine_machine[0]       = __('please select', 'woocommerce-econt'); 
            }
            ?>
            <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="woocommerce_econt_shipping_method_machine_code"><?php _e( 'Econt Express APS', 'woocommerce-econt' ); ?></label>
            </th>
            <td class="forminp">
                <fieldset>
                    <legend class="screen-reader-text"><span><?php _e( 'Econt Express APS', 'woocommerce-econt' ); ?></span></legend>
                    <span><select class="select" name="woocommerce_econt_shipping_method_machine_code" id="woocommerce_econt_shipping_method_machine_code" style="" tabindex="-1" aria-hidden="true" autocomplete="off">
                    <?php
                    foreach ($machine_machine as $key => $value) {
                    ?>
                    <option value="<?php echo $key; ?>" <?php echo ($key == $this->machine_code) ? 'selected' : ''; ?> ><?php echo $value; ?></option>
                    <?php
                    }
                    ?>
                    </select></span>
                    <p class="description"><?php _e('Choose Econt Express APS if you want to be able to send from APS', 'woocommerce-econt'); ?></p>
                </fieldset>
            </td>
        </tr>
            <?php
            return ob_get_clean();
        
    }


    public function process_admin_options() {

        $shipping_payments = array();
        $free_shipping_sum = '';
        $free_shipping_sum_to_office = '';
        $office_town = '';
        $office_postcode = '';
        $office_code = '';
        $machine_town = '';
        $machine_postcode = '';
        $machine_code = '';

        if ( isset( $_POST['shipping_payments'] ) ) {

            $shipping_payments = $_POST['shipping_payments'];
        }

        if ( isset( $_POST['free_shipping_sum'] ) ) {

            $free_shipping_sum = $_POST['free_shipping_sum'];
        }

        if ( isset( $_POST['free_shipping_sum_to_office'] ) ) {

            $free_shipping_sum_to_office = $_POST['free_shipping_sum_to_office'];
        }

        if ( isset( $_POST['woocommerce_econt_shipping_method_office_town'] ) ) {

            $office_town = $_POST['woocommerce_econt_shipping_method_office_town'];
        }

        if ( isset( $_POST['woocommerce_econt_shipping_method_office_postcode'] ) ) {

            $office_postcode = $_POST['woocommerce_econt_shipping_method_office_postcode'];
        }

        if ( isset( $_POST['woocommerce_econt_shipping_method_office_code'] ) ) {

            $office_code = $_POST['woocommerce_econt_shipping_method_office_code'];
        }

        if ( isset( $_POST['woocommerce_econt_shipping_method_machine_town'] ) ) {

            $machine_town = $_POST['woocommerce_econt_shipping_method_machine_town'];
        }

        if ( isset( $_POST['woocommerce_econt_shipping_method_machine_postcode'] ) ) {

            $machine_postcode = $_POST['woocommerce_econt_shipping_method_machine_postcode'];
        }

        if ( isset( $_POST['woocommerce_econt_shipping_method_machine_code'] ) ) {

            $machine_code = $_POST['woocommerce_econt_shipping_method_machine_code'];
        }

        update_option( 'econt_shipping_payments', $shipping_payments );
        update_option( 'econt_free_shipping_sum', $free_shipping_sum );
        update_option( 'econt_free_shipping_sum_to_office', $free_shipping_sum_to_office );
        update_option( 'econt_sender_office_town', $office_town );
        update_option( 'econt_sender_office_postcode', $office_postcode );
        update_option( 'econt_sender_office_code', $office_code );
        update_option( 'econt_sender_machine_town', $machine_town );
        update_option( 'econt_sender_machine_postcode', $machine_postcode );
        update_option( 'econt_sender_machine_code', $machine_code );

        parent::process_admin_options();
        

    }

 
    /**
     * calculate_shipping function.
     * @param array $package (default: array())
     */
    public function calculate_shipping( $package = array() ) {
        // Register the rate
        $cost = (array_key_exists('econt_customer_shipping_cost', $package)) ? $package['econt_customer_shipping_cost'] : 0;
        if(wc_tax_enabled() && class_exists('Econt_mySQL')){
            $cost = Econt_mySQL::remove_vat_from_shipping_price($cost);
        }
        $this->add_rate( array(
          'id'    => $this->id,
          'label' => $this->title,
          //'cost'  => 0,
          'cost'  => $cost,
        ) );
    }


			}
		}
	}
 
	add_action( 'woocommerce_shipping_init', 'econt_shipping_method_init' );
 
	function add_econt_shipping_method( $methods ) {
		$methods['econt_shipping_method'] = 'WC_Econt_Shipping_Method';
		return $methods;
	}


	add_filter( 'woocommerce_shipping_methods', 'add_econt_shipping_method' );
	

}
