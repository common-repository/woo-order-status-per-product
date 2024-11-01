<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.multidots.com/
 * @since      1.0.0
 *
 * @package    WCOSP_Woo_Order_Status_For_Items
 * @subpackage WCOSP_Woo_Order_Status_For_Items/public
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

class WCOSP_Woo_Order_Status_For_Items_Public {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $plugin_name The name of the plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function wcosp_enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in WCOSP_Woo_Order_Status_For_Items_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The WCOSP_Woo_Order_Status_For_Items_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style($this->plugin_name.'aaa', plugin_dir_url(__FILE__) . 'css/woo-order-status-for-items-public.css', array(), $this->version, 'all');
    }


}