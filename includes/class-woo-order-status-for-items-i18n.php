<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 * @since      1.0.0
 * @package    WCOSP_Woo_Order_Status_For_Items
 * @subpackage WCOSP_Woo_Order_Status_For_Items/includes
 * @author     multidots
 */
// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
class WCOSP_Woo_Order_Status_For_Items_i18n {

    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain() {

        load_plugin_textdomain(
                'woo-order-status-per-product', false, dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );
    }
}