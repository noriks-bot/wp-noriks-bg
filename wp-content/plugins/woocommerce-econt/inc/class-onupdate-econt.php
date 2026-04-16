<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if(!class_exists('Econt_OnUpdate')) {
class Econt_OnUpdate {


  function __construct(){
    
    add_action( 'upgrader_process_complete', array( $this, 'woo_econt_upgrade_completed' ), 10, 2 );
  
    add_action( 'admin_notices', array( $this, 'woo_econt_display_update_notice' ));
  
    add_action( 'admin_notices', array( $this, 'woo_econt_display_install_notice' ));
    
    register_activation_hook( ECONT_PLUGIN_DIR . '/woocommerce-econt.php', array($this, 'woo_econt_activate') );
    
  }


/**
 * This function runs when WordPress completes its upgrade process
 * It iterates through each plugin updated to see if ours is included
 * @param $upgrader_object Array
 * @param $options Array
 */
  public function woo_econt_upgrade_completed( $upgrader_object, $options ) {
   // The path to our plugin's main file
   $our_plugin = plugin_basename( __FILE__ );
   // If an update has taken place and the updated type is plugins and the plugins element exists
   if( $options['action'] == 'update' && $options['type'] == 'plugin' && isset( $options['plugins'] ) ) {
    // Iterate through the plugins being updated and check if ours is there
    foreach( $options['plugins'] as $plugin ) {
     if( $plugin == $our_plugin ) {
      // Set a transient to record that our plugin has just been updated
      set_transient( 'woo_econt_updated', 1 );
     }
    }
   }
  }


  /**
   * Show a notice to anyone who has just updated this plugin
   * This notice shouldn't display to anyone who has just installed the plugin for the first time
   */
  public function woo_econt_display_update_notice() {
   // Check the transient to see if we've just updated the plugin
   if( get_transient( 'woo_econt_updated' ) ) {
    echo '<div class="notice notice-success">' . __( 'Thanks for updating WooCommerce Econt Shipping Plugin, please read the <a href="https://mreja.net/plugin_info.php?plugin=wooecont&type=update&ver=1.1.0&lang=en" target="_blank">upgrade notes</a> before you continue.', 'woocommerce-econt' ) . '</div>';
    delete_transient( 'woo_econt_updated' );
   }
  }


    /**
     * Show a notice to anyone who has just installed the plugin for the first time
     * This notice shouldn't display to anyone who has just updated this plugin
     */
  public function woo_econt_display_install_notice() {
   // Check the transient to see if we've just activated the plugin
   if( get_transient( 'woo_econt_activated' ) ) {
    echo '<div class="notice notice-success">' . __( 'Thanks for installing WooCommerce Econt Shipping Plugin, please read the <a href="https://mreja.net/plugin_info.php?plugin=wooecont&type=install&ver=1.1.0&lang=en" target="_blank">configuration instructions</a> before you continue.', 'woocommerce-econt' ) . '</div>';
    // Delete the transient so we don't keep displaying the activation message
   delete_transient( 'woo_econt_activated' );
   }
  }


  /**
   * Run this on activation
   * Set a transient so that we know we've just activated the plugin
   */
  public function woo_econt_activate() {
   set_transient( 'woo_econt_activated', 1 );
  }

}
}

$Econt_OnUpdate = new Econt_OnUpdate;