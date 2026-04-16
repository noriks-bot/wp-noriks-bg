<?php
/*
Plugin Name: Econt payment gateway plugin
Plugin URI: https://mreja.net
Description: Mreja.net's Econt payment gateway plugin
Version: 1.6.5
Author: Mreja.Net
Author URI: https://mreja.net
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
add_action('plugins_loaded', 'woocommerce_econt_payment_init', 0);
function woocommerce_econt_payment_init() {
    if (!class_exists('WC_Payment_Gateway')) return;
class Econt_Payment extends WC_Payment_Gateway {

    private $properties = [];
	
    public function __construct() {
        $this->id = 'econt_payment';
        $this->has_fields = false;
        $this->method_title = __("EcontPay", 'woocommerce-econt');
        $this->method_description = __("Redirects to Econt online payment form", 'woocommerce-econt');
        $demo_description = '';
        $econt_options = get_option('econt_shipping_method_options');
        if(isset($econt_options) && is_array($econt_options)){
            if(empty($econt_options['live'])){
                $demo_description = ' ' . __('DEMO MODE ENABLED. In demo mode, you can use the card number 4341792000000044 with any CVC, a valid expiration date and dynamic password 111111.', 'woocommerce-econt');
            } 
        }
        
        $this->supports = array(
            'products'
        );

        $this->init_form_fields();
        $this->init_settings();
        $this->init_options();

        $this->title = $this->get_option('title');
	    $this->icon = $this->get_option('icon');
        $this->description = $this->get_option('description') . $demo_description;
        $this->enabled = $this->get_option('enabled');

        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
    }

    public function __set($name, $value) {
        $this->properties[$name] = $value;
    }

    public function __get($name) {
        return $this->properties[$name] ?? null;
    }

    public function init_options(){
        $options = array('enabled', 'title', 'icon', 'description');

        $econt_options = array();

        foreach ($options as $option) {
            $econt_options[$option] = $this->get_option($option);
        }

        update_option('econt_payment_method_options', $econt_options);
    }

    public function init_form_fields() {
        $default_description = __('Card payment in which the amount is saved in your account. It will only be withdrawn when you accept your shipment. If you refuse or return it immediately, the amount of the imposed payment will be released and will be at your disposal again.', 'woocommerce-econt');
        
        $plugin_images_dir = ECONT_PLUGIN_URL . '/inc/css/images';
        $this->form_fields = array(
            'enabled' => array(
                'title' => __('Enable/Disable', 'woocommerce-econt'),
                'label' => __('Enable Pay with Econt', 'woocommerce-econt'),
                'type' => 'checkbox',
                'description' => '',
                'default' => 'no'
            ),
            'title' => array(
                'title' => __('Title', 'woocommerce-econt'),
                'type' => 'text',
                'default' => __('EcontPay', 'woocommerce-econt'),
                'desc_tip' => true
            ),
            'icon' => array(
	            'title' => __('Logo', 'woocommerce-econt'),
	            'type' => 'select',
	            'default' => 'light',
	            'desc_tip' => true,
	            'options' => array(
                    '' => __('please select', 'woocommerce-econt'),
		            $plugin_images_dir . '/econt_payment_logo_dark.png' => __('Dark', 'woocommerce-econt'),
		            $plugin_images_dir . '/econt_payment_logo_light.png' => __('Light', 'woocommerce-econt'),
	            ),
            ),
            'description' => array(
                'title' => __('Description', 'woocommerce-econt'),
                'type' => 'textarea',
                'desc_tip' => true,
                'default' => $default_description,
            )
        );
    }
    public function admin_options() {
	    parent::admin_options();

	    ob_start() ;?>
	    <style>
            #<?php echo $this->plugin_id . $this->id . '_icon_image'; ?> {
                display: block;
            }
            #<?php echo $this->plugin_id . $this->id . '_icon_image'; ?>.hide {
                display: none;
            }
	    </style>
	    <script>
			document.addEventListener('DOMContentLoaded', function() {
                function iconFieldChange() {
                    if (!icon) {
                        icon = document.createElement('img');
                        icon.setAttribute('id', '<?php echo $this->plugin_id . $this->id . '_icon_image'; ?>')
                        iconField.parentNode.insertBefore(icon, iconField.nextSibling);
                    }

                    let selectedIndexValue = iconField.options[iconField.selectedIndex].value;
                    if (selectedIndexValue === '') icon.classList.add('hide');
                    else {
                        icon.setAttribute('src', selectedIndexValue);
                        icon.classList.remove('hide');
                    }
                }
			    let icon;
                let iconField = document.querySelector('#<?php echo $this->plugin_id . $this->id . '_icon'; ?>')
                iconField.addEventListener('change', iconFieldChange);
                iconFieldChange();
            });
	    </script>
	    <?php $outputOther = ob_get_contents();
	    ob_end_clean();

	    echo $outputOther;
    }

	public function process_payment($order_id) {
        $order = wc_get_order($order_id);
        if(!isset($_SESSION)){ 
            session_start(); 
        }  
        if(array_key_exists ( 'econt_payment_url' , $_SESSION )){
            $econt_payment_url = $_SESSION['econt_payment_url'];
        }

        $args = [
            'successUrl' => esc_url_raw(add_query_arg(['utm_nooverride' => '1', 'order_id' => $order->get_id()], $this->get_return_url( $order ))),
            'failUrl' => esc_url_raw($order->get_cancel_order_url_raw()),
            'eMail' => $order->get_billing_email(),
        ];

        return [
            'result' => 'success',
            'redirect' => $econt_payment_url . '&' . http_build_query($args, '', '&')
        ];
    }

}
}

function add_econt_payment_class($methods) {
    
    $econt_payment = new Econt_Payment;
    $methods[] = 'Econt_Payment';
    return $methods;
}

add_filter('woocommerce_payment_gateways', 'add_econt_payment_class');

//  Disable gateway based on country
function econt_payment_gateway_disable( $available_gateways ) {

    $econt_options = get_option('econt_shipping_method_options');
    $chosen_shipping = '';
    
    if(isset(WC()->session)){
        $chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
        if( isset($chosen_methods[0]) ){
            $chosen_shipping = $chosen_methods[0];
        }
    }

    if( $chosen_shipping != 'econt_shipping_method' || $econt_options['enabled'] != 'yes' || get_woocommerce_currency() != "BGN" ){
        unset(  $available_gateways['econt_payment'] );
    }
    return $available_gateways;
}
add_filter( 'woocommerce_available_payment_gateways', 'econt_payment_gateway_disable' );


function process_successful_payment($order_id) {
    $order = wc_get_order($order_id);

    if( 'econt_payment' === $order->get_payment_method() && $_GET['order_id'] == $order_id && $_GET['paymentToken'] ) {
        /* translators: payment token  */
        $order->add_order_note(sprintf(__('Pay with Econt successful<br/>Unnique payment token from Econt:  %1$s', 'woocommerce-econt'), $_GET['paymentToken']));
        $order->payment_complete($_GET['paymentToken']);
    }
}

add_action('woocommerce_before_thankyou', 'process_successful_payment', 10, 1);
