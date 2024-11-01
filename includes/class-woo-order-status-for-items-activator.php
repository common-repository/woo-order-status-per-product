<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.multidots.com/
 * @since      1.0.0
 *
 * @package    WCOSP_Woo_Order_Status_For_Items
 * @subpackage WCOSP_Woo_Order_Status_For_Items/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    WCOSP_Woo_Order_Status_For_Items
 * @subpackage WCOSP_Woo_Order_Status_For_Items/includes
 * @author     multidots
 */
// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
class WCOSP_Woo_Order_Status_For_Items_Activator {

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.
     */
    public static function activate() {
        set_transient( '_welcome_screen_activation_redirect_data', true, 30 );
        if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')),true) && !is_plugin_active_for_network('woocommerce/woocommerce.php')) {
	        add_action( 'admin_notices', 'wcosp_plugin_admin_notice' );
	        require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	        deactivate_plugins( plugin_basename( __FILE__ ) );

        }
    }
}