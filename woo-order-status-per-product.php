<?php

/**
 *
 * Plugin Name:       Custom Order Status Per Product for WooCommerce
 * Plugin URI:        https://wordpress.org/plugins/woo-order-status-per-product/
 * Description:       Easily add custom order status for each product into the default WooCommerce. you can create unlimited custom statuses as per your business needs.
 * Version:           1.6.1
 * Author:            theDotstore
 * Author URI:        https://www.thedotstore.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-order-status-per-product
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
    die;
}

if ( function_exists( 'wospp_fs' ) ) {
    wospp_fs()->set_basename( false, __FILE__ );
    return;
}

add_action( 'plugins_loaded', 'wcosp_plugin_init' );
$wc_active = in_array( 'woocommerce/woocommerce.php', get_option( 'active_plugins' ), true );

if ( true === $wc_active ) {
    
    if ( !function_exists( 'wospp_fs' ) ) {
        // Create a helper function for easy SDK access.
        function wospp_fs()
        {
            global  $wospp_fs ;
            
            if ( !isset( $wospp_fs ) ) {
                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/freemius/start.php';
                $wospp_fs = fs_dynamic_init( array(
                    'id'             => '5003',
                    'slug'           => 'woo-order-status-per-product',
                    'type'           => 'plugin',
                    'public_key'     => 'pk_344458492b0636adf299d8dd5cf48',
                    'is_premium'     => false,
                    'premium_suffix' => 'Pro',
                    'has_addons'     => false,
                    'has_paid_plans' => false,
                    'menu'           => array(
                    'slug'       => 'woo_order_status_per_product',
                    'first-path' => 'admin.php?page=woo_order_status_per_product&tab=wcosi-plugin-getting-started',
                    'support'    => false,
                ),
                    'is_live'        => true,
                ) );
            }
            
            return $wospp_fs;
        }
        
        // Init Freemius.
        wospp_fs();
        // Signal that SDK was initiated.
        do_action( 'wospp_fs_loaded' );
        wospp_fs()->add_action( 'after_uninstall', 'wospp_fs_uninstall_cleanup' );
    }
    
    /**
     * The code that runs during plugin activation.
     * This action is documented in includes/class-woo-order-status-for-items-activator.php
     */
    function wcosp_activate_woo_order_status_per_product()
    {
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-order-status-for-items-activator.php';
        WCOSP_Woo_Order_Status_For_Items_Activator::activate();
    }
    
    /**
     * The code that runs during plugin deactivation.
     * This action is documented in includes/class-woo-order-status-for-items-deactivator.php
     */
    function wcosp_deactivate_woo_order_status_per_product()
    {
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-order-status-for-items-deactivator.php';
        WCOSP_Woo_Order_Status_For_Items_Deactivator::deactivate();
    }
    
    register_activation_hook( __FILE__, 'wcosp_activate_woo_order_status_per_product' );
    register_deactivation_hook( __FILE__, 'wcosp_deactivate_woo_order_status_per_product' );
    /**
     * The core plugin class that is used to define internationalization,
     * admin-specific hooks, and public-facing site hooks.
     */
    require plugin_dir_path( __FILE__ ) . 'includes/class-woo-order-status-for-items.php';
    /**
     * Begins execution of the plugin.
     *
     * Since everything within the plugin is registered via hooks,
     * then kicking off the plugin from this point in the file does
     * not affect the page life cycle.
     *
     * @since    1.0.0
     */
    function wcosp_run_woo_order_status_per_product()
    {
        $plugin = new WCOSP_Woo_Order_Status_For_Items();
        $plugin->wcosp_run();
    }

}

/**
 * Check plugin requirement on plugins loaded
 * this plugin requires WooCommerce to be installed and active
 */
function wcosp_plugin_init()
{
    $wc_active = in_array( 'woocommerce/woocommerce.php', get_option( 'active_plugins' ), true );
    
    if ( current_user_can( 'activate_plugins' ) && $wc_active !== true || $wc_active !== true ) {
        add_action( 'admin_notices', 'wcosp_plugin_admin_notice' );
    } else {
        wcosp_run_woo_order_status_per_product();
    }

}

/**
 * Show admin notice in case of WooCommerce plguin is missing
 */
function wcosp_plugin_admin_notice()
{
    $vpe_plugin = esc_html__( 'Custom Order Status Per Product for WooCommerce', 'woo-order-status-per-product' );
    $wc_plugin = esc_html__( 'WooCommerce', 'woo-order-status-per-product' );
    ?>
    <div class="error">
        <p>
            <?php 
                echo  sprintf( esc_html__( '%1$s requires %2$s to be installed & activated!', 'woocommerce-product-attachment' ), '<strong>' . esc_html( $vpe_plugin ) . '</strong>', '<a href="'. esc_url('https://wordpress.org/plugins/woocommerce/').'" target="_blank"><strong>' . esc_html( $wc_plugin ) . '</strong></a>' ) ;
            ?>
        </p>
    </div>
    <?php 
}



