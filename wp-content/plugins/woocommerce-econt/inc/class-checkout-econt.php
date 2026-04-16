<?php
if (!defined('ABSPATH')) exit;
 // Exit if accessed directly

if (!class_exists('Econt_Order')) {
    
    class Econt_Order
    {
        
        function __construct() {

            //hide not needed econt fields in checkout
            add_filter( 'woocommerce_checkout_fields', array($this, 'econt_hide_checkout_fields'), 10, 1 );
            //reorder billing fields in checkout
            add_filter( 'woocommerce_default_address_fields', array($this, 'econt_reorder_checkout_billing_fields'), 10, 1 );
            //add econt offices fields to checkout
            add_action('woocommerce_before_order_notes', array($this, 'econt_offices_checkout_fields'), 30, 1);
            
            //validate econt offices fields in checkout
            add_action('woocommerce_checkout_process', array($this, 'econt_offices_checkout_field_process'));
            
            //save econt office field to the order
            add_action('woocommerce_checkout_update_order_meta', array($this, 'econt_offices_checkout_field_update_order_meta'));
            
            //filter COD payment gateway if nesesery
            add_filter('woocommerce_available_payment_gateways',array($this, 'filter_cod_gateway'),1);
            
            //add message about econt offices in thank you and order pages
            add_action('woocommerce_thankyou', array($this, 'econt_offices_display_order_data'), 20);

            //return shipments from the customer
            add_action('woocommerce_view_order', array($this, 'econt_offices_display_order_data'), 20);
            
            //add econt fields to order emails.
            add_action('woocommerce_email_after_order_table', array($this, 'econt_email_details'), 10, 3);
            //remove "(optional)" from our non required fields introduced in Woo 3.4
            add_filter( 'woocommerce_form_field' , array($this, 'econt_remove_checkout_optional_fields_label'), 10, 4 );
            //add label "( to be calculated )" before the shipping price is calculated i checkout and cart.
            add_filter( 'woocommerce_cart_shipping_method_full_label', array($this, 'econt_shipping_price_to_be_calculated_label'), 10, 2 );

            //modify billing and shipping address data
            add_action( 'woocommerce_checkout_order_processed', array($this, 'econt_modify_billing_and_shipping_address_data'),  1, 1  );

            //Hide Shipping description in cart page
            add_action( 'woocommerce_before_cart', array($this, 'econt_hide_cart_shipping_descr'), 10 );
            
            //Edit user accont address
            add_action( 'woocommerce_after_edit_account_address_form', array($this, 'econt_edit_user_account_address'), 10 );

            //Shipping method title image
            add_filter( 'woocommerce_cart_shipping_method_full_label', array($this, 'econt_filter_woocommerce_cart_shipping_method_label'), 10, 2 );

        }


        public function woo_cart_has_virtual_product() {
            global $woocommerce;
            // By default, no virtual product
            $has_virtual_products = false;
            // Default virtual products number
            $virtual_products = 0;
        
            if(isset($woocommerce->cart)){
                // Get all products in cart
                $products = $woocommerce->cart->get_cart();
                // Loop through cart products
                foreach( $products as $product ) {
                    // Get product ID and '_virtual' post meta
                    $product_id = $product['product_id'];
                    $product_id = ( empty($product['variation_id']) ) ? $product['product_id'] : $product['variation_id'];
                    if (version_compare(WOOCOMMERCE_VERSION, '2.2', '>=')) {
                        $_product = wc_get_product( $product_id );
                        $is_virtual = $_product->is_virtual('yes');
                    }

                    // Update $has_virtual_product if product is virtual
                    if( $is_virtual ){
                        $virtual_products += 1;
                    }
                }
                if( count($products) == $virtual_products ){
                    $has_virtual_products = true;
                }
            }

            return $has_virtual_products;
        }

        public function econt_hide_checkout_fields( $fields ) {
            $econt_options = get_option('econt_shipping_method_options');

            if( $this->woo_cart_has_virtual_product() == false && $econt_options['enabled'] == 'yes' ){

                $hide_fields = array( 
                    array('type' => 'billing', 'name' => 'billing_address_1'),
                    array('type' => 'billing', 'name' => 'billing_address_2'),
                    array('type' => 'billing', 'name' => 'billing_country'),
                    array('type' => 'billing', 'name' => 'billing_city'),
                    array('type' => 'billing', 'name' => 'billing_state'),
                    array('type' => 'billing', 'name' => 'billing_postcode'), 
                    array('type' => 'shipping', 'name' => 'shipping_first_name'),
                    array('type' => 'shipping', 'name' => 'shipping_last_name'),
                    array('type' => 'shipping', 'name' => 'shipping_company'),
                    array('type' => 'shipping', 'name' => 'shipping_address_1'),
                    array('type' => 'shipping', 'name' => 'shipping_address_2'),
                    array('type' => 'shipping', 'name' => 'shipping_city'),
                    array('type' => 'shipping', 'name' => 'shipping_postcode'),
                    array('type' => 'shipping', 'name' => 'shipping_country'),
                    array('type' => 'shipping', 'name' => 'shipping_state'),
                );

                if(!empty($econt_options['show_checkout_country_field'])){
                    $fields['billing']['billing_first_name']['priority'] = 10;
                    $fields['billing']['billing_last_name']['priority'] = 20;
                    $fields['billing']['billing_company']['priority'] = 30;
                    $fields['billing']['billing_email']['priority'] = 40;
                    $fields['billing']['billing_phone']['priority'] = 50;
                    $fields['billing']['billing_country']['priority'] = 60;
                    $fields['billing']['billing_state']['priority'] = 70;
                    $fields['billing']['billing_city']['priority']= 80;
                    $fields['billing']['billing_postcode']['priority'] = 90;
                    $fields['billing']['billing_address_1']['priority'] = 100;
                    $fields['billing']['billing_address_2']['priority'] = 110;

                }

                $chosen_shipping = '';
                if(isset(WC()->session)){
                    $chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
                    if( isset($chosen_methods[0]) ){
                        $chosen_shipping = $chosen_methods[0];
                    }
                }

                foreach($hide_fields as $key => $field ) {

                    if( !empty($econt_options['show_checkout_country_field']) && $field['type'] == 'billing' && $field['name'] == 'billing_country' ){
                        continue;
                    }
                    
                    if ( $chosen_shipping == 'econt_shipping_method' ) {
                        $fields[$field['type']][$field['name']]['required'] = false;
                        $fields[$field['type']][$field['name']]['class'][] = 'econt_hide';
                    }
                    $fields[$field['type']][$field['name']]['class'][] = 'econt_dynamic_fields';
                }

                
            }
            return $fields;
        }

        public function econt_reorder_checkout_billing_fields( $fields ) {
            $econt_options = get_option('econt_shipping_method_options');

            if( $this->woo_cart_has_virtual_product() == false && $econt_options['enabled'] == 'yes' && $econt_options['show_checkout_country_field'] == 'yes'){
                $fields['state']['priority'] = 70;
                $fields['address_1']['priority'] = 100;
                $fields['address_2']['priority'] = 110;
            }

            return $fields;
        }

        /**
         * Add the  econt offices fields to the checkout
         */
        
        public function econt_offices_checkout_fields($checkout) {
        $chosen_shipping = '';
        if(isset(WC()->session)){
            $chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
            if( isset($chosen_methods[0]) ){
                $chosen_shipping = $chosen_methods[0];
            }
        }
        $econt_options = get_option('econt_shipping_method_options');
        
            if( $this->woo_cart_has_virtual_product() == false && $econt_options['enabled'] == 'yes'){
            include_once( ECONT_PLUGIN_DIR . '/inc/view/html-checkout-user-view.php' ); //registered user saved address
            echo '<div id="econtLoader" ></div><div id="econt_custom_checkout_field">';
            if($econt_options['title_type'] == 'image'){
                echo '<img id="econt-title-image" src=' . $econt_options['title_image'] . '>';
            }else{
                echo '<h3 id="econt-title-text">' . $econt_options['title'] . '</h3>'; 
            }
            if(!empty($econt_options['description'])){
                echo '<p>'. $econt_options['description'] .'</p>';
            }
            
            $econt_mysql = new Econt_mySQL;
            
            //express city courier
            if( (int)$econt_options['city_courier'] == 1 && $econt_options['send_from'] == 'DOOR'){
            $sender_address = explode(';',$econt_options['address']);
            
            if( isset($sender_address[0]) ){
            $sender_city_id = $econt_mysql->getCityIdByCityPostCode($sender_address[0]);
            }else{
            $sender_city_id = $econt_mysql->getCityIdByCityPostCode($econt_options['office_postcode']); 

            }            
            
            echo '<script type="text/javascript"> var sender_city_id = "' . $sender_city_id .'";</script>'; //define sender city for express city courier 
            }else{

            echo '<script type="text/javascript"> var sender_city_id = ""; </script>'; //define sender city for express city courier 
            }
            //end of city courier

            //office locator in colorbox jquery
            //$office_locator = 'https://www.bgmaps.com/templates/econt?office_type=to_office_courier&shop_url=' . get_site_url(); //HTTPS_SERVER;
            //$office_locator_domain = 'https://www.bgmaps.com';
            //end of office locator

            //delivery days
            if((int)$econt_options['delivery_days'] == 1){
            $delivery_days = $econt_mysql->delivery_days($econt_options['username'], $econt_options['password'], $econt_options['live']);
            }

            $econt_shipping_to = array();
            $econt_shipping_to[0] = __('please select...', 'woocommerce-econt');
            if($econt_options['send_to_door'] == 1){
             $econt_shipping_to['DOOR'] = __('to door', 'woocommerce-econt');   
            }
            if($econt_options['send_to_office'] == 1){
             $econt_shipping_to['OFFICE'] = __('to office', 'woocommerce-econt');              
            }
            if($econt_options['send_to_machine'] == 1){
             $econt_shipping_to['MACHINE'] = __('to APS', 'woocommerce-econt');              
            }
            $econt_shipping_to_buttons = $econt_shipping_to;
            unset($econt_shipping_to_buttons[0]);
            $hide_shipping_to_select = '';

            if($econt_options['shipping_to_style'] == 'buttons' || $econt_options['shipping_to_style'] == 'icons'){
                woocommerce_form_field(
                'econt_shipping_to_buttons', array('type' => 'radio', 'required' => true, 'class' => array('econt_shipping_to form-row-wide'), 'input_class' => array('econt_shipping_to_input'), 'label' => __('Shipping to', 'woocommerce-econt'), 'placeholder' => __('Shipping to', 'woocommerce-econt'), 'options' => $econt_shipping_to_buttons), $checkout->get_value('econt_shipping_to_buttons'));
                $hide_shipping_to_select = 'econt_hide';
            }

            woocommerce_form_field(
            'econt_shipping_to', array('type' => 'select', 'required' => true, 'class' => array('econt_shipping_to ' . $hide_shipping_to_select . ' form-row-wide'), 'label' => __('Shipping to', 'woocommerce-econt'), 'placeholder' => __('Shipping to', 'woocommerce-econt'), 'options' => $econt_shipping_to), $checkout->get_value('econt_shipping_to'));

            //To office
            if( $econt_options['send_to_office'] == 1 ){

            woocommerce_form_field(
            'econt_offices_town', array('type' => 'select', 'required' => true, 'class' => array('econt_shipping_to_office form-row-wide'),'label' => __('Town (Please, start typing and select from results.)', 'woocommerce-econt'), 'placeholder' => __('Enter your town', 'woocommerce-econt'), 'options' => array('0' => __('Enter your town', 'woocommerce-econt'))), $checkout->get_value('econt_offices_town'));
            
            woocommerce_form_field(
            'econt_offices_postcode', array('type' => 'text', 'required' => true, 'class' => array('econt_shipping_post_code form-row-wide'), 'label' => __('p.c.', 'woocommerce-econt'), 'placeholder' => __('p.c.', 'woocommerce-econt'),), $checkout->get_value('econt_offices_postcode'));

            woocommerce_form_field(
            'econt_offices', array('type' => 'select', 'required' => true, 'class' => array('econt_shipping_to_office form-row-wide'), 'label' => __('Office', 'woocommerce-econt'), 'placeholder' => __('Select office', 'woocommerce-econt'), 'options' => array('0' => __('please select...', 'woocommerce-econt'))), $checkout->get_value('econt_offices'));

            ?>
            <div class="econt_office_locator_map" id="econt_offices_map" style="height: 400px;"></div>
            <script type="text/javascript">
                jQuery(document).ready(function() {
                jQuery('.econt_shipping_to_door').hide();
                jQuery('.econt_shipping_to_office').hide();
                jQuery('.econt_shipping_to_machine').hide();
                jQuery('.econt_shipping_cost').hide();
                jQuery('#econt_city_courier_field').hide();
                jQuery('.econt_shipping_post_code').hide();
                jQuery('.econt_office_locator_map').hide(); 

                });
            </script>
            <?php
            
            if($econt_options['partial_delivery'] == 1){
            echo '<div class="econt_shipping_to_office">' . __('We offer our customers partial delivery.', 'woocommerce-econt') . '</div>';    
            }

            }

            //To Machine
            if( $econt_options['send_to_machine'] == 1 ){


            woocommerce_form_field(
            'econt_machines_town', array('type' => 'select', 'required' => true, 'class' => array('econt_shipping_to_machine form-row-wide'),'label' => __('Town (Please, start typing and select from results.)', 'woocommerce-econt'), 'placeholder' => __('Enter your town', 'woocommerce-econt'), 'options' => array('0' => __('Enter your town', 'woocommerce-econt'))), $checkout->get_value('econt_machines_town'));
            
            woocommerce_form_field(
            'econt_machines_postcode', array('type' => 'text', 'required' => true, 'class' => array('econt_shipping_post_code form-row-wide'), 'label' => __('p.c.', 'woocommerce-econt'), 'placeholder' => __('p.c.', 'woocommerce-econt'),), $checkout->get_value('econt_offices_postcode'));

            woocommerce_form_field(
            'econt_machines', array('type' => 'select', 'required' => true, 'class' => array('econt_shipping_to_machine form-row-wide'), 'label' => __('APS', 'woocommerce-econt'), 'placeholder' => __('Select APS', 'woocommerce-econt'), 'options' => array('0' => __('please select...', 'woocommerce-econt'))), $checkout->get_value('econt_offices'));
            ?>
            <div class="econt_office_locator_map" id="econt_machines_map" style="height: 400px;"></div>
            <?php

            if( $econt_options['send_to_office'] == 0 )
            echo '<script type="text/javascript">jQuery(".econt_shipping_to_machine").slideToggle();</script>';
            

            }

            //to door
            if( $econt_options['send_to_door'] == 1 ){


            woocommerce_form_field(
            'econt_door_town', array('type' => 'select', 'required' => true, 'class' => array('econt_shipping_to_door form-row-wide'),'label' => __('Town (Please, start typing and select from results.)', 'woocommerce-econt'), 'placeholder' => __('Enter your town', 'woocommerce-econt'), 'options' => array('0' => __('Enter your town', 'woocommerce-econt'))), $checkout->get_value('econt_door_town'));
            
            woocommerce_form_field(
            'econt_door_postcode', array('type' => 'text', 'required' => true, 'class' => array('econt_shipping_post_code form-row-wide'), 'label' => __('p.c.', 'woocommerce-econt'), 'placeholder' => __('p.c.', 'woocommerce-econt'),), $checkout->get_value('econt_door_postcode'));

            woocommerce_form_field(
            'econt_door_street', array('type' => 'select', 'required' => true, 'class' => array('econt_shipping_to_door form-row-first'),'label' => __('Street (Please, start typing and select from results.)', 'woocommerce-econt'), 'placeholder' => __('Enter your street', 'woocommerce-econt'), 'options' => array('0' => __('Enter your street', 'woocommerce-econt'))), $checkout->get_value('econt_door_street'));

            woocommerce_form_field(
            'econt_door_street_intl', array('type' => 'text', 'required' => true, 'class' => array('econt_shipping_to_door form-row-first'), 'label' => __('Street name', 'woocommerce-econt'), 'placeholder' => __('Enter your street name', 'woocommerce-econt'),), $checkout->get_value('econt_door_street_intl'));

            woocommerce_form_field(
            'econt_door_street_num', array('type' => 'text', 'class' => array('econt_shipping_to_door form-row-last'), 'label' => __('str. num.', 'woocommerce-econt'), 'placeholder' => __('street num', 'woocommerce-econt'),), $checkout->get_value('econt_door_street_num'));
            
            woocommerce_form_field(
            'econt_door_quarter', array('type' => 'select', 'required' => false, 'class' => array('econt_shipping_to_door form-row-first'),'label' => __('Quarter (Please, start typing and select from results.)', 'woocommerce-econt'), 'placeholder' => __('Enter your quarter', 'woocommerce-econt'), 'options' => array('0' => __('Enter your quarter', 'woocommerce-econt'))), $checkout->get_value('econt_door_quarter'));

            woocommerce_form_field(
            'econt_door_quarter_intl', array('type' => 'text', 'required' => false, 'class' => array('econt_shipping_to_door form-row-first'), 'label' => __('Quarter name', 'woocommerce-econt'), 'placeholder' => __('Enter your quarter name', 'woocommerce-econt'),), $checkout->get_value('econt_door_quarter_intl'));
            
            woocommerce_form_field(
            'econt_door_street_bl', array('type' => 'text', 'class' => array('econt_shipping_to_door form-row-last'), 'label' => __('bl. num.', 'woocommerce-econt'), 'placeholder' => __('blok num', 'woocommerce-econt'),), $checkout->get_value('econt_door_street_bl'));

            
            woocommerce_form_field(
            'econt_door_street_vh', array('type' => 'text', 'class' => array('econt_shipping_to_door form-row-first'), 'label' => __('entr. num.', 'woocommerce-econt'), 'placeholder' => __('entr. num', 'woocommerce-econt'),), $checkout->get_value('econt_door_street_vh'));
            
            woocommerce_form_field(
            'econt_door_street_et', array('type' => 'text', 'class' => array('econt_shipping_to_door form-row-last'), 'label' => __('fl. num.', 'woocommerce-econt'), 'placeholder' => __('fl. num', 'woocommerce-econt'),), $checkout->get_value('econt_door_street_et'));
            
            woocommerce_form_field(
            'econt_door_street_ap', array('type' => 'text', 'class' => array('econt_shipping_to_door form-row-last'), 'label' => __('ap. num.', 'woocommerce-econt'), 'placeholder' => __('ap. num', 'woocommerce-econt'),), $checkout->get_value('econt_door_street_ap'));
            woocommerce_form_field(
            'econt_door_other', array('type' => 'text', 'class' => array('econt_shipping_to_door form-row-wide'), 'label' => __('If your address is not in the list please type it here:', 'woocommerce-econt'), 'placeholder' => __('Enter other adress info', 'woocommerce-econt'),), $checkout->get_value('econt_door_other'));
            if( (int)$econt_options['delivery_days'] == 1 && !empty($delivery_days)){
            woocommerce_form_field(
            'econt_delivery_days', array('type' => 'select', 'class' => array('econt_shipping_to_door form-row-wide'), 'label' => __('Delivery Days', 'woocommerce-econt'), 'placeholder' => __('', 'woocommerce-econt'), 'options' => $delivery_days), $checkout->get_value('econt_delivery_days'));    
            }
            if( $econt_options['city_courier'] == 1 ){
            woocommerce_form_field(
            'econt_city_courier', array('type' => 'select', 'class' => array('econt_city_courier form-row-wide'), 'label' => __('Express city courier', 'woocommerce-econt'), 'placeholder' => __('', 'woocommerce-econt'), 'options' => array('0' => __('please select...', 'woocommerce-econt'), 'e1' => __('up to 60 minutes', 'woocommerce-econt'), 'e2' => __('up to 90 minutes', 'woocommerce-econt'), 'e3' => __('up to 120 minutes', 'woocommerce-econt'))), $checkout->get_value('econt_city_courier'));
            }
            if($econt_options['partial_delivery'] == 1){
            echo '<div class="econt_shipping_to_door">' . __('We offer our customers partial delivery.', 'woocommerce-econt') . '</div>';    
            }

            if( $econt_options['priority_time'] == 1 ){
                //Priority time
                woocommerce_form_field(
                'econt_priority_time_type', array('type' => 'select', 'class' => array('econt_shipping_to_door form-row-first'), 'label' => __('Priority time type', 'woocommerce-econt'), 'placeholder' => __('', 'woocommerce-econt'), 'options' => array('' => __('please select...', 'woocommerce-econt'), 'BEFORE' => __('before', 'woocommerce-econt'), 'IN' => __('in', 'woocommerce-econt'), 'AFTER' => __('after', 'woocommerce-econt') )), $checkout->get_value('econt_priority_time_type'));

                woocommerce_form_field(
                'econt_priority_time_hour', array('type' => 'select', 'class' => array('econt_shipping_to_door form-row-last'), 'label' => __('Priority time hour', 'woocommerce-econt'), 'placeholder' => __('', 'woocommerce-econt'), 'options' => array('' => __('please select...', 'woocommerce-econt'))), $checkout->get_value('econt_priority_time_hour'));    

            }

            }

            woocommerce_form_field(
            'econt_customer_shipping_cost', array('type' => 'text', 'class' => array('econt_shipping_cost form-row-wide'), 'label' => __('Econt Customer Shipping Cost', 'woocommerce-econt'), 'placeholder' => __('Enter Customer Shipping Cost', 'woocommerce-econt'), 'default' => '',), $checkout->get_value('econt_customer_shipping_cost'));
            woocommerce_form_field(
            'econt_total_shipping_cost', array('type' => 'text', 'class' => array('econt_shipping_cost form-row-wide'), 'label' => __('Econt Total Shipping Cost:', 'woocommerce-econt'), 'placeholder' => __('Econt Total Shipping Cost', 'woocommerce-econt'), 'default' => '',), $checkout->get_value('econt_total_shipping_cost'));

              
            /*echo '<p id="calculate_loading" style="display: block;">
            <input class="button" id="button_calculate_loading" value="'.__('Calculate Loading','woocommerce-econt').'" type="button"></p></div><div class="econt_clear"></div>';*/
            echo '</div><div class="econt_clear"></div>';

            }
            
           

        }
        
        public function econt_offices_checkout_field_process() {
          
            // Check if set, if its not set add an error.
            $chosen_shipping = '';
            if(isset(WC()->session)){
                $chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
                if( isset($chosen_methods[0]) ){
                    $chosen_shipping = $chosen_methods[0];
                }
            }
            $econt_options = get_option('econt_shipping_method_options');
            $econt_mysql = new Econt_mySQL;

            if( $this->woo_cart_has_virtual_product() == false && $chosen_shipping == 'econt_shipping_method' && $econt_options['enabled'] == 'yes' ){
                $validation = $econt_mysql->receiver_address_validation($_POST);
                if($validation['valid']  === false){
                    if ( function_exists( 'wc_add_notice' ) ) {
                    wc_add_notice($validation['msg'], 'error');
                    }else{
                        $woocommerce->add_error(sprintf($validation['msg']));
                    }
                }

            }
           
        }
        
        public function econt_offices_checkout_field_update_order_meta($order_id) {
           
           $econt_mysql = new Econt_mySQL;
           
           $econt_mysql->shipping_field_update_order_meta($order_id, $_POST);
           
           $user_id = get_current_user_id();
           
           if($user_id){
                $econt_mysql->shipping_field_update_user_meta($user_id, $_POST); 
           }

        }
        
        public function econt_offices_display_order_data($order_id) {

        global $wpdb;
        $orders = wc_get_order($order_id);
        $intl_delivery = ($orders->get_billing_country() == 'RO' || $orders->get_billing_country() == 'GR') ? true : false;
        $econt_options = get_option('econt_shipping_method_options');


        $shipping_items = $orders->get_items( 'shipping' );
        foreach($shipping_items as $el){
            $order_shipping_method_id = $el['method_id'];
        }

        if($order_shipping_method_id == 'econt_shipping_method'){

            $econt_mysql = new Econt_mySQL;

            $office_code = $orders->get_meta( 'Econt_Office', true );
            $office = $econt_mysql->getOfficeByOfficeCode($office_code);

            $machine_code = $orders->get_meta( 'Econt_Machine', true );
            $machine = $econt_mysql->getOfficeByOfficeCode($machine_code);

            $loading = $econt_mysql->getLoading($order_id);

            if($econt_options['title_type'] == 'image'){
                echo '<img id="econt-title-image" src="' . $econt_options['title_image'] . '">';
            }else{
                echo '<h3 id="econt-title-text">' . $econt_options['title'] . '</h3>';
            }
        ?>
            <table class="econt-table">
                <thead>
                    <tr>
                        <th scope="col" colspan="2"><?php _e('The goods will be shipped to:', 'woocommerce-econt'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                    if ($orders->get_meta( 'Econt_Shipping_To', true ) == 'OFFICE') { ?>
                    
                    <tr>
                        <td data-label=""><strong><?php
                        _e('Econt Town:', 'woocommerce-econt'); ?></strong></td>
                        <td data-label=""><?php
                        echo $orders->get_meta( 'Econt_Office_Town', true ); ?></td>
                    </tr>
                    <tr>
                        <td data-label=""><strong><?php
                        _e('Econt office:', 'woocommerce-econt'); ?></strong></td>
                        <td data-label=""><?php
                        echo $office['name'] . __(' address: ', 'woocommerce-econt') . $office['address']; ?></td>
                         </tr>
                    <?php
                    } 
                    elseif ($orders->get_meta( 'Econt_Shipping_To', true ) == 'MACHINE') { ?>
                        <tr>
                        <td data-label=""><strong><?php
                        _e('Econt Town:', 'woocommerce-econt'); ?></strong></td>
                        <td data-label=""><?php
                        echo $orders->get_meta( 'Econt_Machine_Town', true ); ?></td>
                    </tr>
                    <tr>
                        <td data-label=""><strong><?php
                        _e('Econt APS:', 'woocommerce-econt'); ?></strong></td>
                        <td data-label=""><?php
                        echo $machine['name'] . __(' address: ', 'woocommerce-econt') . $machine['address']; ?></td>
                         </tr>

                    
                    <?php
                    } 
                    elseif ($orders->get_meta( 'Econt_Shipping_To', true ) == 'DOOR') { ?>
                        <tr>
                        <td data-label=""><strong><?php
                        _e('Econt Town:', 'woocommerce-econt'); ?></strong></td>
                        <td data-label=""><?php
                        echo $orders->get_meta( 'Econt_Door_Town', true ); ?></td>
                    </tr>
                    <tr>
                        <td data-label=""><strong><?php
                        _e('Econt Postcode:', 'woocommerce-econt'); ?></strong></td>
                        <td data-label=""><?php
                        echo $orders->get_meta( 'Econt_Door_Postcode', true ); ?></td>
                    </tr>
                    </tr>
                    <?php if(!empty($orders->get_meta( 'Econt_Door_Quarter', true )) || !empty($orders->get_meta( 'Econt_Door_Quarter_Intl', true ))){ ?>
                    <tr>
                        <td data-label=""><strong><?php
                        _e('Econt Quarter:', 'woocommerce-econt'); ?></strong></td>
                        <td data-label=""><?php
                        echo ($intl_delivery == true) ? $orders->get_meta( 'Econt_Door_Quarter_Intl', true ) : $orders->get_meta( 'Econt_Door_Quarter', true ); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(!empty($orders->get_meta( 'Econt_Door_building_num', true ))){ ?>
                    <tr>
                        <td data-label=""><strong><?php
                        _e('Econt Building Num.:', 'woocommerce-econt'); ?></strong></td>
                        <td data-label=""><?php
                        echo $orders->get_meta( 'Econt_Door_building_num', true ); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(!empty($orders->get_meta( 'Econt_Door_Street', true )) || !empty($orders->get_meta( 'Econt_Door_Street_Intl', true ))){ ?>
                    <tr>
                        <td data-label=""><strong><?php
                        _e('Econt Street:', 'woocommerce-econt'); ?></strong></td>
                        <td data-label=""><?php
                        echo ($intl_delivery == true) ? $orders->get_meta( 'Econt_Door_Street_Intl', true ) : $orders->get_meta( 'Econt_Door_Street', true ); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(!empty($orders->get_meta( 'Econt_Door_street_num', true ))){ ?>
                     <tr>
                        <td data-label=""><strong><?php
                        _e('Econt Street Num.:', 'woocommerce-econt'); ?></strong></td>
                        <td data-label=""><?php
                        echo $orders->get_meta( 'Econt_Door_street_num', true ); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(!empty($orders->get_meta( 'Econt_Door_Entrance_num', true ))){ ?>
                    <tr>
                        <td data-label=""><strong><?php
                        _e('Econt Entrance:', 'woocommerce-econt'); ?></strong></td>
                        <td data-label=""><?php
                        echo $orders->get_meta( 'Econt_Door_Entrance_num', true ); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(!empty($orders->get_meta( 'Econt_Door_Floor_num', true ))){ ?>
                    <tr>
                        <td data-label=""><strong><?php
                        _e('Econt Floor:', 'woocommerce-econt'); ?></strong></td>
                        <td data-label=""><?php
                        echo $orders->get_meta( 'Econt_Door_Floor_num', true ); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(!empty($orders->get_meta( 'Econt_Door_Apartment_num', true ))){ ?>
                     <tr>
                        <td data-label=""><strong><?php
                        _e('Econt Apartment:', 'woocommerce-econt'); ?></strong></td>
                        <td data-label=""><?php
                        echo $orders->get_meta( 'Econt_Door_Apartment_num', true ); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(!empty($orders->get_meta( 'Econt_Door_Other', true ))){ ?>
                    <tr>
                        <td data-label=""><strong><?php
                        _e('Econt Other:', 'woocommerce-econt'); ?></strong></td>
                        <td data-label=""><?php
                        echo $orders->get_meta( 'Econt_Door_Other', true ); ?></td>
                    </tr>
                    <?php } ?>
                    <?php
                    } ?>
                     <tr>
                        <td data-label=""><strong><?php
                        _e('Econt Shipping Cost:', 'woocommerce-econt'); ?></strong></td>
                        <td data-label=""><?php                         
                        if(is_numeric( $orders->get_meta( 'Econt_Customer_Shipping_Cost', true ) )){
                            echo number_format($orders->get_meta( 'Econt_Customer_Shipping_Cost', true ), 2, '.', '') . get_woocommerce_currency_symbol();
                        }else{
                            echo $orders->get_meta( 'Econt_Customer_Shipping_Cost', true );
                        }
                        ?></td>
                    </tr>
                    <?php  

                    if($loading != false){ 
                    //tuk e shipment tracking linka
                        ?>
                    <tr>
                        <td data-label=""><strong><?php
                        _e('Shipment tracking details:', 'woocommerce-econt'); ?></strong></td>
                        <td data-label=""><a href="https://www.econt.com/services/track-shipment/<?php echo $loading['loading_num']; ?>" class="button" target="_blank"><?php _e('Shipment tracking', 'woocommerce-econt'); ?></a></td>
                    </tr>
                    <?php  } 
                    if((int)$econt_options['return_item'] == 1 && $loading != false){ 
                    //tuk sa usloviqta za generirane na tovaritelnica za vrushtane na poruchka
                        ?>
                    <tr>
                        <td data-label=""><strong><?php
                        _e('Generate loading to return the received order:', 'woocommerce-econt'); ?></strong></td>
                        <td data-label=""><a href="https://delivery.econt.com/return_shipment.php?return_shipment_num=<?php echo $loading['loading_num']; ?>&return_shipment_phone=<?php echo $orders->get_billing_phone(); ?>" class="button" target="_blank"><?php _e('Generate return loading', 'woocommerce-econt'); ?></a></td>
                    </tr>
                    <?php  } ?>
                </tbody>
            </table>
        <?php
     
     }      
    
    }

    public function econt_display_email_data($order_id) {

        $orders = wc_get_order($order_id);
        $intl_delivery = ($orders->get_billing_country() == 'RO' || $orders->get_billing_country() == 'GR') ? true : false;
        $econt_options = get_option('econt_shipping_method_options');

        $shipping_items = $orders->get_items( 'shipping' );
        foreach($shipping_items as $el){
            $order_shipping_method_id = $el['method_id'] ;
        }

        if($order_shipping_method_id == 'econt_shipping_method'){

            $econt_mysql = new Econt_mySQL;

            $office_code = $orders->get_meta( 'Econt_Office', true );
            $office = $econt_mysql->getOfficeByOfficeCode($office_code);

            $machine_code = $orders->get_meta( 'Econt_Machine', true );
            $machine = $econt_mysql->getOfficeByOfficeCode($machine_code);

        ?>


<table id="addresses" cellspacing="0" cellpadding="0" style="width: 100%; vertical-align: top; margin-bottom: 40px; padding:0;" border="0">
    <tr>
        <td style="text-align:left; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; border:0; padding:0;" valign="top" width="50%">
            <?php
            if($econt_options['title_type'] == 'image'){
                echo '<img id="econt-title-image" src=' . $econt_options['title_image'] . '>';
            }else{
                echo '<h2 id="econt-title-text">' . $econt_options['title'] . '</h2>'; 
            }
            ?>
            <address class="address">

            <?php
                if ($orders->get_meta( 'Econt_Shipping_To', true ) == 'OFFICE') { ?>
                <strong><?php esc_html_e('Econt Town:', 'woocommerce-econt'); ?></strong>
                <?php echo $orders->get_meta( 'Econt_Office_Town', true ); ?>
                <br/>
                <strong><?php esc_html_e('Econt Postcode:', 'woocommerce-econt'); ?></strong>
                <?php echo $orders->get_meta( 'Econt_Office_Postcode', true ); ?>
                <br/>
                <strong><?php esc_html_e('Econt office:', 'woocommerce-econt'); ?></strong>
                <?php echo $office['name'] . __(' address: ', 'woocommerce-econt') . $office['address']; ?>
                <br/>
            <?php
            } 
            elseif ($orders->get_meta( 'Econt_Shipping_To', true ) == 'MACHINE') { ?>

                <strong><?php esc_html_e('Econt Town:', 'woocommerce-econt'); ?></strong>
                <?php echo $orders->get_meta( 'Econt_Machine_Town', true ); ?>
                <br/>
                <strong><?php esc_html_e('Econt Postcode:', 'woocommerce-econt'); ?></strong>
                <?php echo $orders->get_meta( 'Econt_Machine_Postcode', true ); ?>
                <br/>
                <strong><?php esc_html_e('Econt APS:', 'woocommerce-econt'); ?></strong>
                <?php echo $machine['name'] . __(' address: ', 'woocommerce-econt') . $machine['address']; ?>
                <br/>
            <?php
            } 
            elseif ($orders->get_meta( 'Econt_Shipping_To', true ) == 'DOOR') { ?>
                <strong><?php esc_html_e('Econt Town:', 'woocommerce-econt'); ?></strong>
                <?php echo $orders->get_meta( 'Econt_Door_Town', true ); ?>
                <br/>
                <strong><?php esc_html_e('Econt Postcode:', 'woocommerce-econt'); ?></strong>
                <?php echo $orders->get_meta( 'Econt_Door_Postcode', true ); ?>
                <br/>
                <?php if(!empty($orders->get_meta( 'Econt_Door_Quarter', true )) || !empty($orders->get_meta( 'Econt_Door_Quarter_Intl', true ))){ ?>
                <strong><?php esc_html_e('Econt Quarter:', 'woocommerce-econt'); ?></strong>
                <?php echo ($intl_delivery == true) ? $orders->get_meta( 'Econt_Door_Quarter_Intl', true ) : $orders->get_meta( 'Econt_Door_Quarter', true ); ?>
                <br/>
                <?php } ?>
                <?php if(!empty($orders->get_meta( 'Econt_Door_building_num', true ))){ ?>
                <strong><?php esc_html_e('Econt Building Num.:', 'woocommerce-econt'); ?></strong>
                <?php echo $orders->get_meta( 'Econt_Door_building_num', true ); ?>
                <br/>
                <?php } ?>
                <?php if(!empty($orders->get_meta( 'Econt_Door_Street', true )) || !empty($orders->get_meta( 'Econt_Door_Street_Intl', true ))){ ?>
                <strong><?php esc_html_e('Econt Street:', 'woocommerce-econt'); ?></strong>
                <?php echo ($intl_delivery == true) ? $orders->get_meta( 'Econt_Door_Street_Intl', true ) : $orders->get_meta( 'Econt_Door_Street', true ); ?>
                <br/>
                <?php } ?>
                <?php if(!empty($orders->get_meta( 'Econt_Door_street_num', true ))){ ?>
                <strong><?php esc_html_e('Econt Street Num.:', 'woocommerce-econt'); ?></strong>
                <?php echo $orders->get_meta( 'Econt_Door_street_num', true ); ?>
                <br/>
                <?php } ?>
                <?php if(!empty($orders->get_meta( 'Econt_Door_Entrance_num', true ))){ ?>
                <strong><?php esc_html_e('Econt Entrance:', 'woocommerce-econt'); ?></strong>
                <?php echo $orders->get_meta( 'Econt_Door_Entrance_num', true ); ?>
                <br/>
                <?php } ?>
                <?php if(!empty($orders->get_meta( 'Econt_Door_Floor_num', true ))){ ?>
                <strong><?php esc_html_e('Econt Floor:', 'woocommerce-econt'); ?></strong>
                <?php echo $orders->get_meta( 'Econt_Door_Floor_num', true ); ?>
                <br/>
                <?php } ?>
                <?php if(!empty($orders->get_meta( 'Econt_Door_Apartment_num', true ))){ ?>
                <strong><?php esc_html_e('Econt Apartment:', 'woocommerce-econt'); ?></strong>
                <?php echo $orders->get_meta( 'Econt_Door_Apartment_num', true ); ?>
                <br/>
                <?php } ?>
                <?php if(!empty($orders->get_meta( 'Econt_Door_Other', true ))){ ?>
                <strong><?php esc_html_e('Econt Other:', 'woocommerce-econt'); ?></strong>
                <?php echo $orders->get_meta( 'Econt_Door_Other', true ); ?>
                <br/>
                <?php } ?>
                <?php } ?>
                <strong><?php esc_html_e('Econt Shipping Cost:', 'woocommerce-econt'); ?></strong>
                <?php
                        if(is_numeric( $orders->get_meta( 'Econt_Customer_Shipping_Cost', true ) )){
                            echo number_format($orders->get_meta( 'Econt_Customer_Shipping_Cost', true ), 2, '.', '') . get_woocommerce_currency_symbol();
                        }else{
                            echo $orders->get_meta( 'Econt_Customer_Shipping_Cost', true );
                        }
                        ?>
            </address>
        </td>
    </tr>
</table>

        <?php
     
     }      
    
    }
        
        
        //econt email
        public function econt_email_details($order, $sent_to_admin, $plain_text = false) {
           if (version_compare(WOOCOMMERCE_VERSION, '2.2', '>=')) {
            $shipping_items = $order->get_items('shipping');
            $shipping_method_id = '';
            
            foreach ($shipping_items as $key => $value) {
                
                $shipping_method_id = $value['method_id'];

           }
            
            if ('econt_shipping_method' === $shipping_method_id) {
                
                $this->econt_display_email_data($order->get_id());
            }
        
            }else{
             $this->econt_display_email_data($order->get_id());   
            }

         }
    
        public function filter_cod_gateway($gateways){
            if ( is_admin() ) return $gateways; //don't exexute in admin area
            $chosen_shipping = '';
            if(isset(WC()->session)){
                $chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
                if( isset($chosen_methods[0]) ){
                    $chosen_shipping = $chosen_methods[0];
                }
            }
            $econt_options = get_option('econt_shipping_method_options');

            if( $this->woo_cart_has_virtual_product() == false && $chosen_shipping == 'econt_shipping_method' && $econt_options['enabled'] == 'yes' ){
            
                if($econt_options['cd'] != 1){
                    unset($gateways['cod']);
                }       

            }
            
            return $gateways;

        }


        public function econt_remove_checkout_optional_fields_label( $field, $key, $args, $value ) {
            // Only on checkout page
            if( ! ( is_checkout() && ! is_wc_endpoint_url() ) ){
                return $field;
            }

            $optional = '&nbsp;<span class="optional">(' . esc_html__( 'optional', 'woocommerce' ) . ')</span>';
            $keys = array( 'econt_door_street', 'econt_door_quarter', 'econt_door_street_num', 'econt_door_street_bl', 'econt_door_street_vh', 'econt_door_street_et', 'econt_door_street_ap', 'econt_door_other', 'econt_delivery_days', 'econt_city_courier', 'econt_priority_time_type', 'econt_priority_time_hour' );

            if( in_array($key, $keys) ){
                return str_replace( $optional, '', $field );
            }else{
                return $field;
            }
        }


        public function econt_shipping_price_to_be_calculated_label($label, $method){

            if ( $method->id == 'econt_shipping_method' ) {

                //if( !isset($_SESSION) ){ 
                //    session_start(); 
                //}  

                if( isset($_SESSION) && !array_key_exists ( 'econt_shipping_cost' , $_SESSION) ){
                    $label .= '<span id="econt-shipping-price-to-be-calculated">' . __( ' (to be calculated)', 'woocommerce-econt' ) . '</span>';
                }

            }

            return $label;
        }

        public function econt_modify_billing_and_shipping_address_data($order_id){

            $econt_mysql = new Econt_mySQL;
            $econt_mysql->modify_billing_and_shipping_address_data($order_id);
        
        }
 
        public function econt_hide_cart_shipping_descr() {
            $econt_options = get_option('econt_shipping_method_options');
            $hide_cart_shipping_descr = '';
            if ( isset($econt_options['hide_cart_shipping_descr']) ){
                $hide_cart_shipping_descr = $econt_options['hide_cart_shipping_descr'];

            }
            if($hide_cart_shipping_descr == 1){
                echo '<style>.woocommerce-shipping-destination{display:none}</style>';
            }
        }

        

        public function econt_edit_user_account_address(){
            include_once( ECONT_PLUGIN_DIR . '/inc/view/html-my-account-address-view.php' );   

        }

        public function econt_filter_woocommerce_cart_shipping_method_label($label, $method){
            $econt_options = get_option('econt_shipping_method_options');

            if($econt_options['title_type'] == 'image'){
                    
                    
                if($method->method_id == "econt_shipping_method"){
                    $l = explode('<span', $label);
                    $style = ' style="display:inline-block; vertical-align:middle;"';
                    if(isset($l[1]) && isset($l[2])){
                        $label = '<img src="' . $econt_options['title_image'] . '"' . $style . '>  <span' . $l[1] . '<span' . $l[2];
                    }else{
                        if(isset($l[1])){
                            $label = '<img src="' . $econt_options['title_image'] . '"' . $style . '>  <span' . $l[1];
                        }else{
                            $label = '<img src="' . $econt_options['title_image'] . '"' . $style . '>'; 
                        }
                           
                    }
                }
            }
            
           return $label; 
        }
    }
}


$Econt_Order = new Econt_Order();