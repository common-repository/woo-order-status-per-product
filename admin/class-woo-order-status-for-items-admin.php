<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WCOSP_Woo_Order_Status_For_Items
 * @subpackage WCOSP_Woo_Order_Status_For_Items/admin
 * @author     multidots
 */
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WCOSP_Woo_Order_Status_For_Items_Admin {

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
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 *
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function wcosp_enqueue_styles($hook) {
	    global $typenow;


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
		if ( isset( $hook ) && ! empty( $hook ) && ( "dotstore-plugins_page_woo_order_status_per_product" === $hook ) || ! empty( $typenow ) && ( 'product' === $typenow ) ) {

			wp_enqueue_style( 'thickbox' );
			wp_enqueue_style( $this->plugin_name . '-wcosi-main-style', plugin_dir_url( __FILE__ ) . 'css/style.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woo-order-status-for-items-admin.css', array(), $this->version, 'all' );
		}
	}
	/**
	 *
	 * dotsstore menu add
	 */
	public function dot_store_menu() {
		global $GLOBALS;

		if ( empty( $GLOBALS['admin_page_hooks']['dots_store'] ) ) {
			add_menu_page(
				'DotStore Plugins', __( 'DotStore Plugins', 'woo-order-status-per-product' ), 'NULL', 'dots_store', array(
				$this,
				'dot_store_menu_page',
			), plugin_dir_url( __FILE__ ) . 'images/menu-icon.png', 25
			);
		}
	}

	/**
	 *
	 * WooCommerce Custom Order Status Per Product menu add
	 */
	public function wcosp_plugin_menu() {
		add_submenu_page( "dots_store", __( 'WooCommerce Custom Order Status Per Product', 'woo-order-status-per-product' ), "WooCommerce Custom Order Status Per Product",
		"manage_options", "woo_order_status_per_product", array(
			$this,
			"wcosp_options_page",
		));
	}

	/**
	 * WooCommerce Custom Order Status Per Product Option Page HTML
	 *
	 */
	public function wcosp_options_page() {
		$file_dir_path = 'partials/header/plugin-header.php';
		if ( file_exists( plugin_dir_path( __FILE__ ) . $file_dir_path ) ) {
			include_once( plugin_dir_path( __FILE__ ) . $file_dir_path );
		}

		$custom_tab = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_STRING );
		if ( ! empty( $custom_tab ) ) {
			if ( "wcosp_plugin_setting_page" === $custom_tab ) {
				self::wcosp_setting_page();
			}
			if ( "wcosi-plugin-getting-started" === $custom_tab ) {
				self::wcosp_get_started_dots_about_plugin_settings();
			}
			if ( "wcosi-plugin-quick-info" === $custom_tab ) {
				self::wcosp_dotstore_about_plugin_store_pro();
			}
		} else {
			self::wcosp_setting_page();
		}
		?>
        <!-- end here !-->
		<?php

		$file_dir_path = 'partials/header/plugin-sidebar.php';
		if ( file_exists( plugin_dir_path( __FILE__ ) . $file_dir_path ) ) {
			include_once( plugin_dir_path( __FILE__ ) . $file_dir_path );
		}


	}

	/**
	 * Function to return Setting Page HTML
	 */
	public function wcosp_setting_page() {
		$wcosp_status_list   = filter_input( INPUT_POST, 'wcosp_status_list', FILTER_SANITIZE_STRING );
		$wcosp_active_status = filter_input( INPUT_POST, 'wcosp_active_status', FILTER_SANITIZE_STRING );
		$wcosp_status_list   = isset( $wcosp_status_list ) && ! empty( $wcosp_status_list ) ? $wcosp_status_list : '';
		$wcosp_active_status = isset( $wcosp_active_status ) && ! empty( $wcosp_active_status ) ? $wcosp_active_status : '';
		//save on database two tab value
		$btn_submit                     = filter_input( INPUT_POST, 'submit', FILTER_SANITIZE_STRING );
		$custom_page                    = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING );
		$wcosp_attachment_setting_nonce = filter_input( INPUT_POST, 'wcosp_attachment_setting_nonce', FILTER_SANITIZE_STRING );
		if ( isset( $btn_submit ) && isset( $custom_page ) && 'woo_order_status_per_product' === $custom_page ) {
			// verify nonce
			if ( ! isset( $wcosp_attachment_setting_nonce ) || ! wp_verify_nonce( $wcosp_attachment_setting_nonce, basename( __FILE__ ) ) ) {
				die( 'Failed security check' );
			}
			$single_setting_array = array(
			        'wcosp_status_list' => $wcosp_status_list,
                    'wcosp_active_status' => $wcosp_active_status
            );
			$single_setting_array = wp_json_encode($single_setting_array);
			update_option( 'wcos_setting_array', $single_setting_array );
		}
		//store value in variable
		$retrive_single_setting_array = get_option( 'wcos_setting_array' );
		$retrive_single_setting_array = json_decode( $retrive_single_setting_array, true );
		$wcosp_active_status = $retrive_single_setting_array['wcosp_active_status'];
		$wcosp_status_list = $retrive_single_setting_array['wcosp_status_list'];
		?>
        <div class="wcpoa-section-left">
            <div class="wcpoa-table-main">
                <form method="post" action="">
					<?php wp_nonce_field( basename( __FILE__ ), 'wcosp_attachment_setting_nonce' ); ?>
                    <table class="wcpoa-tableouter">
                        <tbody>
                        <tr>
                            <th>
                                <label class="wcpoa-name" for="wcosp_active_status"><?php esc_html_e( 'Active custom order status enable?', 'woo-order-status-per-product' ) ?></label>
                            </th>
                            <td class="">
                                <div class="wcpoa-name-txtbox">
                                    <select name="wcosp_active_status" class="wcosp_active_status"
                                            data-type="" data-key="" id="wcosp_active_status">
                                        <option name="yes"
                                                value="<?php echo esc_attr('yes');?>" <?php selected( $wcosp_active_status, 'yes' ); ?>><?php esc_html_e( 'Yes', 'woo-order-status-per-product' )
											?></option>
                                        <option name="no" value="<?php echo esc_attr('no'); ?>"
                                                class="" <?php selected( $wcosp_active_status, 'no' ); ?>><?php esc_html_e( 'No', 'woo-order-status-per-product' )
											?></option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label class="wcpoa-name" for="wcosp_status_list"><?php esc_html_e( 'Add Status to display', 'woo-order-status-per-product' ) ?></label>
                            </th>
                            <td class="">
                                <div class="wcpoa-name-txtbox">
		                            <textarea id="wcosp_status_list" name="wcosp_status_list" row="25" cols="20"
                                              placeholder="Open, In process, Closed"><?php echo wp_kses_post
			                            ( $wcosp_status_list );
			                            ?></textarea>
                                    <p class="note"><?php esc_html_e( 'Eg. Open, In process, Closed' ); ?> </p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="wcpoa-setting-btn">
								<?php submit_button(); ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
		<?php
	}

	/**
	 * function for custom get started page
	 *
	 */
	function wcosp_get_started_dots_about_plugin_settings() {
		$file_dir_path = 'partials/wcosi-plugin-get-started.php';
		if ( file_exists( plugin_dir_path( __FILE__ ) . $file_dir_path ) ) {
			require_once( plugin_dir_path( __FILE__ ) . $file_dir_path );
		}

	}

	/**
	 * Custom menu html for information about plugin
	 *
	 */
	function wcosp_dotstore_about_plugin_store_pro() {
		$file_dir_path = 'partials/wcosi-plugin-quick-info.php';
		if ( file_exists( plugin_dir_path( __FILE__ ) . $file_dir_path ) ) {
			require_once( plugin_dir_path( __FILE__ ) . $file_dir_path );
		}

	}

	/**
	 * Activate the order status
	 */
	function wcosp_activate_woo_status_functionality() {
		add_action( 'woocommerce_after_order_itemmeta', 'wocs_item_status_fun', 3, 20 );
		function wocs_item_status_fun( $item_id, $item, $product ) {
			$retrive_single_setting_array = get_option( 'wcos_setting_array' );
			$retrive_single_setting_array = json_decode( $retrive_single_setting_array, true );
			$wcosp_active_status = $retrive_single_setting_array['wcosp_active_status'];
			if ( 'yes' === $wcosp_active_status ) {

				$status_list_string = $retrive_single_setting_array['wcosp_status_list'];

				$default_select_option = apply_filters('default_select_option_title',esc_html__('-- Select item status --','woo-order-status-per-product'));
				$status_list_string = ( '' !== $status_list_string ) ? $status_list_string : '';

				$status_list = explode( ',', $status_list_string );
                if(isset($status_list_string) && ! empty($status_list_string)) {
	                if ( isset( $status_list ) && is_array( $status_list ) ) {
		                if ( ! empty( $product ) && isset( $product ) ) {
			                $post_type = $product->post_type;
			                if ( ! empty( $post_type ) && ( 'product' === $post_type || 'product_variation' === $post_type ) ) :
								
								$order_id = get_the_ID();
								$item_status = get_post_meta( $order_id, 'item_status_'.$item_id, true );
                                
				                $allow_html = wocs_get_allow_html_in_escaping();
				                echo wp_kses('<div class="wc-order-item-sku"><strong>' . esc_html__( 'Item status: ', 'woo-order-status-per-product' ) . '</strong><select id="item_status_' . esc_attr__( $item_id ) . '" name="item_status_' .
											 esc_attr__( $item_id ) . '">',$allow_html);
								echo wp_kses('<option value="">'. esc_attr__( $default_select_option ) . '</option>',$allow_html);
								
								foreach ( $status_list as $index => $status ) {
					                $item_status     = $item_status;
					                $selected_option = ( '' != $item_status && $item_status == $index ) ? wp_kses('<option value="' .esc_attr($index)  . '" '. selected($index, $index).'>' . esc_attr__( $status ) . '</option>',$allow_html) : wp_kses('<option value="' . esc_attr__( $index ) . '">' . esc_attr__( $status ) . '</option>',$allow_html);
					                $option_args     = array(
						                'option' => array(
							                'value'    => true,
							                'selected' => true,

						                )
					                );
					                echo wp_kses( $selected_option, $option_args );
				                }
				                echo wp_kses('</select></div>',$allow_html);
			                endif;
		                }
	                } else {
		                echo sprintf(wp_kses_post( '%1$sItem status:%2$s' ),'<div class="wc-order-item-sku"><strong>','</strong> - </div>');
	                }
                }

			}
		}

		/**
		 * Function to save setting data while order placed from backend
		 */
		add_action( 'save_post', 'wocs_process_offline_order', 3, 20 );
		function wocs_process_offline_order( $post_id, $post, $update ) {
			$retrive_single_setting_array = get_option( 'wcos_setting_array' );
			$retrive_single_setting_array = json_decode( $retrive_single_setting_array, true );
			$wcosp_active_status = $retrive_single_setting_array['wcosp_active_status'];
			if ( 'yes' === $wcosp_active_status ) {
				if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
					return $post_id;
				} // Exit if it's an autosave
				$custom_action    =  $_POST['action'];
				$custom_post_type = (isset($_POST['post_type']))?$_POST['post_type']: '';
				$order_item_id    = $_POST;
				$order_item_id    = ( isset( $order_item_id['order_item_id'] ) && ! empty( $order_item_id['order_item_id'] ) ) ? $order_item_id['order_item_id'] : array();
				if ( 'editpost' === $custom_action && 'shop_order' === $custom_post_type ) {
					if ( isset( $order_item_id ) && is_array( $order_item_id ) ) {

						
						foreach ( $order_item_id as $item_id ) {
							$item_status     = get_post_meta( $post_id, 'item_status_'.$item_id, true );
							$item_statu_data = $_POST['item_status_' . $item_id];

							if ( $item_status !== $item_statu_data ) {
								$date_format = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );
								update_post_meta( $post_id, 'item_status_'.$item_id, $item_statu_data );
								update_post_meta( $post_id, 'item_status_date_'.$item_id, date( $date_format, current_time( 'timestamp', 0 ) ) );
							}
						}
					}
				}
			}
		}

		/**
		 * Display status and date from my account page in order view
		 */
		add_action( 'woocommerce_order_item_meta_end', 'wocs_item_meta_custom', 10, 4 );
		function wocs_item_meta_custom( $item_id, $item, $order, $flag = false ) {
			
			$order_id = $order->get_id();
			$retrive_single_setting_array = get_option( 'wcos_setting_array' );
			$retrive_single_setting_array = json_decode( $retrive_single_setting_array, true );
			$wcosp_active_status = $retrive_single_setting_array['wcosp_active_status'];
			if ( 'yes' === $wcosp_active_status ) {
				$item_status      = get_post_meta( $order_id, 'item_status_'.$item_id, true );
				$item_status_date = get_post_meta( $order_id, 'item_status_date_'.$item_id, true );
				$status_list_string = $retrive_single_setting_array['wcosp_status_list'];
				$status_list_string = ( '' !== $status_list_string ) ? $status_list_string : '';

				$status_list = explode( ',', $status_list_string );
				$status_text = esc_html__('Status: ','woo-order-status-per-product');
				$date_text = esc_html__('Date: ','woo-order-status-per-product');
				if ( '' !== $item_status && is_array( $status_list ) && ! empty( $status_list[ $item_status ] ) && isset( $status_list[ $item_status ] ) ) {

					echo sprintf(wp_kses_post('%1$s%2$s %3$s%4$s'),'<span class="order_status"><strong>'.$status_text,'</strong>',wp_kses_post( $status_list[ $item_status ]),'</span>');
					if ( '' !== $item_status_date ) {
					    echo sprintf(wp_kses_post('%1$s%2$s %3$s%4$s'),'<span class="order_status"><strong>'.$date_text,'</strong>',wp_kses_post( $item_status_date ),'</span>');
					}
				} else {

					$default_status = apply_filters('default_custom_staus_title', esc_html__('Unfulfilled','woo-order-status-per-product'));
					echo sprintf(wp_kses_post('%1$s%2$s %3$s%4$s'),'<span class="order_status"><strong>','</strong>',wp_kses_post( $default_status ),'</span>');

				}
			}
		}
	}

	/**
	 * Function to return update option setting value ehile update plugin with new code.
	 */
	function dotstore_wocs_update_checker() {
		$wocs_version = get_option( 'wocs_version' );
		if ( empty( $wocs_version ) ) {
			update_option( 'wocs_version', '1.0' );
		}
		$retrive_single_setting_array = get_option( 'wcos_setting_array' );
		$retrive_single_setting_array = json_decode( $retrive_single_setting_array, true );
		$single_setting_array         = array();
		if ( '1.0' === $wocs_version || empty( $wocs_version ) ) {
			$wcosp_status_list   = get_option( 'wcosp_status_list' );
			$wcosp_active_status = get_option( 'wcosp_active_status' );
			if ( ( isset( $wcosp_status_list ) && ! empty( $wcosp_status_list ) && ( empty( $retrive_single_setting_array ) ) ) ) {
				$single_setting_array['wcosp_status_list'] = $wcosp_status_list;
			} else {
				$single_setting_array['wcosp_status_list'] = $retrive_single_setting_array['wcosp_status_list'];
			}
			if ( isset( $wcosp_active_status ) && ! empty( $wcosp_active_status ) && ( empty( $retrive_single_setting_array ) ) ) {
				$single_setting_array['wcosp_active_status'] = $wcosp_active_status;
			} else {
				$single_setting_array['wcosp_active_status'] = $retrive_single_setting_array['wcosp_active_status'];
			}
			$single_setting_array = wp_json_encode( $single_setting_array );
			update_option( 'wcos_setting_array', $single_setting_array );
			update_option( 'wocs_version', '2.0' );
			delete_option( 'wcosp_status_list' );
			delete_option( 'wcosp_active_status' );

		}
		// if no activation redirect
		if ( ! get_transient( '_welcome_screen_activation_redirect_data' ) ) {
			return;
		}

		// Delete the redirect transient
		delete_transient( '_welcome_screen_activation_redirect_data' );

		// if activating from network, or bulk
		$activation_multi = filter_input( INPUT_GET, 'activate-multi', FILTER_SANITIZE_STRING );
		if ( is_network_admin() || isset( $activation_multi ) ) {
			return;
		}
		// Redirect to extra cost welcome  page
		wp_safe_redirect( add_query_arg( array( 'page' => 'woo_order_status_per_product&tab=wcosi-plugin-getting-started' ), admin_url( 'admin.php' ) ) );
		exit;
	}
}