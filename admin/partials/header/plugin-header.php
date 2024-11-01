<?php
/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$plugin_url         = plugin_dir_url(__FILE__);
$plugin_name        = 'Custom Order Status Per Product for WooCommerce';
$plugin_text_domain = 'woo-order-status-per-product';
?>

<div id="dotsstoremain">
	<div class="all-pad">
		<header class="dots-header">
			<div class="dots-logo-main">
				<img src="<?php echo esc_url( plugins_url() . '/woo-order-status-per-product/admin/images/woo-product-att-logo.png' ); ?>">
			</div>
			<div class="dots-header-right">
				<div class="logo-detail">
					<strong><?php echo wp_kses_post( $plugin_name ); ?></strong>
					<span><?php esc_html_e( 'Free Version ' ); ?><?php echo esc_html( '1.6.1' ) ?></span>
				</div>
				<div class="button-dots">
                    <span class="upgrade_pro_image" style="display: none; ">
                        <a target="_blank" href="<?php echo esc_url( 'http://thedotstore.com/woo-custom-order-status-per-product' ); ?>">
                            <img src="<?php echo esc_url( plugins_url() . '/woo-order-status-per-product/admin/images/upgrade_new.png' ); ?>">
                        </a>
                    </span>
					<span class="support_dotstore_image">
                        <a target="_blank" href="<?php echo esc_url( 'https://www.thedotstore.com/support' ); ?>">
                            <img src="<?php echo esc_url( plugins_url() . '/woo-order-status-per-product/admin/images/support_new.png' ); ?>">
                        </a>
                    </span>
				</div>
			</div>
			<?php
			$about_plugin_setting_menu_enable = '';
			$about_plugin_get_started         = '';
			$about_plugin_quick_info          = '';
			$dotstore_setting_menu_enable     = '';
			$wcosp_plugin_setting_page        = '';
			$wcosp_pro_details                = '';
			$custom_tab = filter_input(INPUT_GET,'tab',FILTER_SANITIZE_STRING);
			$custom_page = filter_input(INPUT_GET,'page',FILTER_SANITIZE_STRING);

			if ( ! empty( $custom_tab ) &&  'wcosp_plugin_setting_page' === $custom_tab ) {
				$wcosp_plugin_setting_page = "acitve";
			}
			if ( empty( $custom_tab ) &&  'woo_order_status_per_product' === $custom_page ) {
				$wcosp_plugin_setting_page = "acitve";
			}
			if ( ! empty( $custom_tab ) && 'wcpoa-pro-details-page' === $custom_tab ) {
				$wcosp_pro_details = "acitve";
			}
			if ( ! empty( $custom_tab ) && 'wcosi-plugin-getting-started' === $custom_tab ) {
				$about_plugin_setting_menu_enable = "acitve";
				$about_plugin_get_started         = "acitve";
			}
			if ( ! empty( $custom_tab ) && 'wcosi-plugin-quick-info' === $custom_tab ) {
				$about_plugin_setting_menu_enable = "acitve";
				$about_plugin_quick_info          = "acitve";
			}
			?>

			<div class="dots-menu-main">
				<nav>
					<ul>
						<li><a class="dotstore_plugin <?php echo esc_attr( $wcosp_plugin_setting_page ); ?>"
						       href="<?php echo esc_url( site_url( 'wp-admin/admin.php?page=woo_order_status_per_product&tab=wcosp_plugin_setting_page' ) ); ?>"><?php esc_html_e( 'Settings', 'woo-order-status-per-product' ) ?></a>
						</li>
						<li>
							<a class="dotstore_plugin <?php echo esc_attr( $about_plugin_setting_menu_enable ); ?>"
							   href="<?php echo esc_url( site_url( 'wp-admin/admin.php?page=woo_order_status_per_product&tab=wcosi-plugin-getting-started' ) ); ?>"><?php esc_html_e( 'About Plugin', 'woo-order-status-per-product' ) ?></a>
							<ul class="sub-menu">
								<li>
									<a class="dotstore_plugin <?php echo esc_attr( $about_plugin_get_started ); ?>"
									   href="<?php echo esc_url( site_url( 'wp-admin/admin.php?page=woo_order_status_per_product&tab=wcosi-plugin-getting-started' ) ); ?>"><?php esc_html_e( 'Getting Started', 'woo-order-status-per-product' ) ?></a>
								</li>
								<li>
									<a class="dotstore_plugin <?php echo esc_attr( $about_plugin_quick_info ); ?>"
									   href="<?php echo esc_url( site_url( 'wp-admin/admin.php?page=woo_order_status_per_product&tab=wcosi-plugin-quick-info' ) ); ?>"><?php esc_html_e( 'Quick Info', 'woo-order-status-per-product' ) ?></a>
								</li>
								<li><a target="_blank"
								       href="<?php echo esc_url( "https://www.thedotstore.com/suggest-a-feature/" ); ?>"><?php esc_html_e( 'Suggest A Feature', 'woo-order-status-per-product' ); ?></a>
								</li>
							</ul>
						</li>
						<li>
							<a class="dotstore_plugin <?php echo esc_attr( $dotstore_setting_menu_enable ); ?>"
							   href="#"><?php esc_html_e( 'Dotstore', 'woo-order-status-per-product' ); ?></a>
							<ul class="sub-menu">
								<li><a target="_blank"
								       href="<?php echo esc_url( "https://www.thedotstore.com/woocommerce-plugins/" ); ?>"><?php esc_html_e( 'WooCommerce Plugins', 'woo-order-status-per-product' ); ?></a>
								</li>
								<li><a target="_blank"
								       href="<?php echo esc_url( "https://www.thedotstore.com/wordpress-plugins/" ); ?>"><?php esc_html_e( 'Wordpress Plugins', 'woo-order-status-per-product' ); ?></a>
								</li>
								<li><a target="_blank"
								       href="<?php echo esc_url( "https://www.thedotstore.com/support/" ); ?>"><?php esc_html_e( 'Contact Support', 'woo-order-status-per-product' ); ?></a>
								</li>
							</ul>
						</li>
					</ul>
				</nav>
			</div>
		</header>