<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$plugin_txt_domain = 'woo-order-status-per-product';
$plugin_url = plugins_url().'/woo-order-status-per-product/';
$image_url         = $plugin_url.'admin/images/right_click.png';

?>
<div class="dotstore_plugin_sidebar">
<?php 
    $review_url = '';
    $plugin_at  = '';
	$review_url = esc_url( 'https://wordpress.org/plugins/woo-order-status-per-product/#reviews' );
	$plugin_at  = 'WP.org';
    ?>
    <div class="dotstore-important-link">
        <div class="image_box">
            <img src="<?php echo esc_url( plugin_dir_url( dirname( __FILE__, 2 ) ) . 'images/rate-us.png' ); ?>" alt="<?php esc_attr_e( 'Rate us', 'woo-order-status-per-product' ); ?> ">
        </div>
        <div class="content_box">
            <h3>Like This Plugin?</h3>
            <p>Your Review is very important to us as it helps us to grow more.</p>
            <a class="btn_style" href="<?php echo $review_url;?>" target="_blank">Review Us on <?php echo $plugin_at; ?></a>
        </div>
    </div>
	<div class="dotstore-important-link">
		<h2><span class="dotstore-important-link-title"><?php esc_html_e( 'Important link', 'woo-order-status-per-product' ); ?></span></h2>
		<div class="video-detail important-link">
			<ul>
				<li>
					<img src="<?php echo esc_url( $image_url ); ?>">
					<a target="_blank"
					   href="<?php echo esc_url( "https://www.thedotstore.com/support/" ); ?>"><?php esc_html_e( 'Support platform', 'woo-order-status-per-product' ); ?></a>
				</li>
				<li>
					<img src="<?php echo esc_url( $image_url ); ?>">
					<a target="_blank"
					   href="<?php echo esc_url( "https://www.thedotstore.com/suggest-a-feature/" ); ?>"><?php esc_html_e( 'Suggest A Feature', 'woo-order-status-per-product' ); ?></a>
				</li>
				<li>
					<img src="<?php echo esc_url( $image_url ); ?>">
					<a target="_blank"
					   href="<?php echo esc_url( "https://wordpress.org/plugins/woo-order-status-per-product/#developers" ); ?>"><?php esc_html_e( 'Changelog', 'woo-order-status-per-product' ); ?></a>
				</li>
			</ul>
		</div>
	</div>

    <!-- html for popular plugin !-->

    <div class="dotstore-important-link">
        <h2>
            <span class="dotstore-important-link-title">
                <?php esc_html_e( 'Our Popular plugins', 'woo-order-status-per-product' ); ?>
            </span>
        </h2>
        <div class="video-detail important-link">
            <ul>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php echo esc_url(plugins_url('/images/advance-flat-rate.png', dirname(dirname(__FILE__)))); ?>">
                    <a target="_blank" href="<?php echo esc_url('https://www.thedotstore.com/flat-rate-shipping-plugin-for-woocommerce/'); ?> "><?php esc_html_e('Flat Rate Shipping Plugin for WC', 'woo-order-status-per-product'); ?></a>
                </li> 
                <li>
                    <img class="sidebar_plugin_icone" src="<?php echo esc_url(plugins_url('/images/woo-conditional-product-fees-for-checkout.png', dirname(dirname(__FILE__)))); ?>">
                    <a  target="_blank" href="<?php echo esc_url('https://www.thedotstore.com/product/woocommerce-extra-fees-plugin/'); ?>"><?php esc_html_e('Extra Fees Plugin for WC', 'woo-order-status-per-product'); ?></a>
                </li>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php echo esc_url(plugins_url('/images/woo-advanced-product-size-chart.png', dirname(dirname(__FILE__)))); ?>">
                    <a  target="_blank" href="<?php echo esc_url('https://www.thedotstore.com/woocommerce-advanced-product-size-charts/'); ?>"><?php esc_html_e('Product Size Charts Plugin for WC', 'woo-order-status-per-product'); ?></a>
                </li>
                <li>
                    <img  class="sidebar_plugin_icone" src="<?php echo esc_url(plugins_url('/images/woo-blocker-lite-prevent-fake-orders-and-blacklist-fraud-customers.png', dirname(dirname(__FILE__)))); ?>">
                    <a target="_blank" href="<?php echo esc_url('https://www.thedotstore.com/woocommerce-anti-fraud'); ?>"><?php esc_html_e('Fraud Prevention Plugin for WC', 'woo-order-status-per-product'); ?></a>
                </li>
                <li>
                    <img  class="sidebar_plugin_icone" src="<?php echo esc_url(plugins_url('/images/hide-shipping-method-for-woocommerce.png', dirname(dirname(__FILE__)))); ?>">
                    <a target="_blank" href="<?php echo esc_url('https://www.thedotstore.com/hide-shipping-method-for-woocommerce'); ?>"><?php esc_html_e('Hide Shipping Method For WC', 'woo-order-status-per-product'); ?></a>
                </li>
                </br>
            </ul>    
        </div>
        <div class="view-button">
            <a class="view_button_dotstore" href="<?php echo esc_url( "http://www.thedotstore.com/plugins/" ); ?>"  target="_blank"><?php esc_html_e( 'View All', 'woo-order-status-per-product' ); ?></a>
        </div>
    </div>
</div>
</div>
</body>
</html>