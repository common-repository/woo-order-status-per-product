<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://www.multidots.com/
 * @since      1.0.0
 *
 * @package    WCOSP_Woo_Order_Status_For_Items
 * @subpackage WCOSP_Woo_Order_Status_For_Items/includes
 * @author     Thedotstore
 */
// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
class WCOSP_Woo_Order_Status_For_Items
{
    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      WCOSP_Woo_Order_Status_For_Items_Loader $loader Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $plugin_name The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $version The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        $this->plugin_name = 'woo-order-status-per-product';
        $this->version = '1.0.0';

        $this->wcosp_load_dependencies();
        $this->wcosp_set_locale();
        $this->wcosp_define_admin_hooks();
        $this->wcosp_define_public_hooks();
        $prefix = is_network_admin() ? 'network_admin_' : '';
	    $file_path = 'woo-order-status-per-product/woo-order-status-per-product.php';
	    add_filter( "{$prefix}plugin_action_links_" . $file_path, array( $this, 'wcosp_plugin_action_links' ), 10, 4 );

    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - WCOSP_Woo_Order_Status_For_Items_Loader. Orchestrates the hooks of the plugin.
     * - WCOSP_Woo_Order_Status_For_Items_i18n. Defines internationalization functionality.
     * - WCOSP_Woo_Order_Status_For_Items_Admin. Defines all hooks for the admin area.
     * - WCOSP_Woo_Order_Status_For_Items_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function wcosp_load_dependencies()
    {
        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-woo-order-status-for-items-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-woo-order-status-for-items-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-woo-order-status-for-items-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-woo-order-status-for-items-public.php';
	    /**
	     * The class responsible for defining all actions that occur in the admin function-facing
	     * side of the site.
	     */
	    require_once plugin_dir_path(dirname(__FILE__)) . 'includes/woo-order-status-admin-functions.php';

        /**
         * Admin side review block
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-woo-order-status-for-items-user-feedback.php';


        $this->loader = new WCOSP_Woo_Order_Status_For_Items_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the WCOSP_Woo_Order_Status_For_Items_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function wcosp_set_locale()
    {
        $plugin_i18n = new WCOSP_Woo_Order_Status_For_Items_i18n();
        $this->loader->wcosp_add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function wcosp_define_admin_hooks()
    {
        $plugin_admin = new WCOSP_Woo_Order_Status_For_Items_Admin($this->wcosp_get_plugin_name(), $this->wcosp_get_version());
        $this->loader->wcosp_add_action('admin_enqueue_scripts', $plugin_admin, 'wcosp_enqueue_styles');
        if (empty($GLOBALS['admin_page_hooks']['dots_store'])) {
            $this->loader->wcosp_add_action('admin_menu', $plugin_admin, 'dot_store_menu');
        }
        $this->loader->wcosp_add_action('admin_menu', $plugin_admin, 'wcosp_plugin_menu');
        $this->loader->wcosp_add_action('admin_wcpoa_setting_page', $plugin_admin, 'wcpoa_setting_page');
	    $this->loader->wcosp_add_action('init', $plugin_admin, 'wcosp_activate_woo_status_functionality');
	    $custom_page = filter_input(INPUT_GET,'page',FILTER_SANITIZE_STRING);
	    if((isset($custom_page) && ! empty($custom_page)) && ( 'woo_order_status_per_product' === $custom_page)){
		    $this->loader->wcosp_add_action('admin_init', $plugin_admin, 'dotstore_wocs_update_checker');
	    }

    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function wcosp_get_plugin_name()
    {
        return $this->plugin_name;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function wcosp_get_version()
    {
        return $this->version;
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function wcosp_define_public_hooks()
    {
        $plugin_public = new WCOSP_Woo_Order_Status_For_Items_Public($this->wcosp_get_plugin_name(), $this->wcosp_get_version());
        $this->loader->wcosp_add_action('wp_enqueue_scripts', $plugin_public, 'wcosp_enqueue_styles');
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function wcosp_run()
    {
        $this->loader->wcosp_run();
    }

    /**
     * Return the plugin action links.  This will only be called if the plugin
     * is active.
     *
     * @since 1.0.0
     * @param array $actions associative array of action names to anchor tags
     * @return array associative array of plugin action links
     */
    public function wcosp_plugin_action_links($actions, $plugin_file, $plugin_data, $context)
    {
        $custom_actions = array(
            'configure' => sprintf('<a href="%s">%s</a>', admin_url('admin.php?page=woo_order_status_per_product'), __('Settings', $this->plugin_name)),
        );
        return array_merge($custom_actions, $actions);
    }
}