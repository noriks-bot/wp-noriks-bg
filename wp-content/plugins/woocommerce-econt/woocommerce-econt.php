<?php
/*
 * Plugin Name: Econt Express WooCommerce shipping method
 * Plugin URI: https://mreja.net/produkt/woocommerce-econt-express-shipping-plugin/
 * Description: Integrate Econt Express in WooCommerce and ship your goods.
 * Author: MrejaNet
 * Author URI: https://mreja.net
 * Version: 1.6.5
 * Text Domain: woocommerce-econt
 * Domain Path: /languages
 * Tags: woocommerce, econt express, shipping method
 * Requires at least: 4.0.0
 * Tested up to: 6.6.2
 * WC requires at least: 3.0.0
 * WC tested up to: 9.3.3
 * License: Proprietary license
 * License URI: https://mreja.net/software-license-agreement/
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


global $wpdb;

if (!defined('ECONT_PLUGIN_DIR'))
    define( 'ECONT_PLUGIN_DIR', dirname(__FILE__) );

if (!defined('ECONT_PLUGIN_ROOT_PHP'))
    define( 'ECONT_PLUGIN_ROOT_PHP', dirname(__FILE__).'/'.basename(__FILE__)  );

if (!defined('ECONT_PLUGIN_ADMIN_DIR'))
    define( 'ECONT_PLUGIN_ADMIN_DIR', dirname(__FILE__) . '/admin' );

if (!defined('ECONT_PLUGIN_URL'))
    define( 'ECONT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

if (!defined('ECONT_VERSION_KEY'))
    define('ECONT_VERSION_KEY', 'woocommerce-econt_version');

if (!defined('ECONT_VERSION_NUM'))
    define('ECONT_VERSION_NUM', '1.6.5');

if (!defined('ECONT_LICENSE_SERVER'))
    define('ECONT_LICENSE_SERVER', 'http://licensing.mreja.net/license_check.php');

if (!defined('ECONT_RESOURCES_SERVER'))
    define('ECONT_RESOURCES_SERVER', 'http://resources.mreja.net/api/');


if( !class_exists('Econt_Express') ) {

	class Econt_Express {

		public function __construct() {
			if ( $this->is_woocommerce_active() ) {
				$this->init();
			}
		}
		public function init(){
			add_action( 'plugins_loaded', array( &$this,'plugins_loaded' ) );
			require_once ECONT_PLUGIN_ADMIN_DIR.'/class-sm-econt.php'; //adds shipping method econt to woocommerce settings 
			require_once ECONT_PLUGIN_ADMIN_DIR.'/class-pm-econt.php'; //adds payment method econt to woocommerce settings
			require_once ECONT_PLUGIN_DIR.'/inc/class-mysql-econt.php'; //create econt tables and do all mysql queries
			require_once ECONT_PLUGIN_DIR.'/inc/class-ajax-econt.php'; 
			require_once ECONT_PLUGIN_DIR.'/inc/class-checkout-econt.php'; //class s funkcii dobavqshti meta poleta za econt v checkout
			require_once ECONT_PLUGIN_DIR.'/inc/class-onupdate-econt.php'; //class davasht instrukcii na potrebitelia sled upgrade na plugina
			require_once ECONT_PLUGIN_ADMIN_DIR.'/class-order-econt.php'; //order details create loading (ot tuk zarejdam i js i css scriptovete)
			require_once ECONT_PLUGIN_DIR.'/lib/plugin-update-checker/plugin-update-checker.php'; //updates checker

			register_activation_hook( __FILE__, array( 'Econt_mySQL', 'createTables' ) );
			register_activation_hook(__FILE__, array('Econt_mySQL', 'plugin_activation'));
			$econtUpdateChecker = Puc_v4_Factory::buildUpdateChecker('http://wpus.mreja.net/updater/?action=get_metadata&slug=woocommerce-econt',__FILE__,'woocommerce-econt');
			add_action( 'before_woocommerce_init', array( $this,'econt_hpos_compatibility' ) );
		}

		private function is_woocommerce_active() {
            $is_woocommerce_active = in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );

            if($is_woocommerce_active === false){
            	add_action( 'admin_notices', function() {
		        $message = sprintf( esc_html__( 'Econt Express WooCommerce shipping method requires WooCommerce. Please activate WooCommerce.', 'woocommerce-econt' ) );
		        echo wp_kses_post( sprintf( '<div class="error">%s</div>', wpautop( $message ) ) );
		        } );
            }

            return $is_woocommerce_active;
        }

		public function plugins_loaded() {

			load_plugin_textdomain( 'woocommerce-econt', false, dirname( plugin_basename( __FILE__ ) ). '/languages/' );

			if( !is_admin() ) {
				//require_once(ECONT_PLUGIN_DIR.'/inc/class-debug.php');
			}

		}
		
		public function econt_hpos_compatibility() {
			if ( class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
				\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
			}
		}

	}
}

new Econt_express();