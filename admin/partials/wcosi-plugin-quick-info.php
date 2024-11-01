<?php
// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
$plugin_name = 'Custom Order Status Per Product for WooCommerce';
$plugin_version = '1.6.1';
?>
<div class="wcpoa-section-left">
    <div class="wcpoa-table-main res-cl">
        <h2><?php esc_html_e('Quick Info',  'woo-order-status-per-product') ?></h2>
        <table class="wcpoa-tableouter">
            <tbody>
                <tr>
                    <td class="fr-1"><?php esc_html_e('Product Type',  'woo-order-status-per-product') ?></td>
                    <td class="fr-2"><?php esc_html_e('WordPress Plugin',  'woo-order-status-per-product') ?></td>
                </tr>
                <tr>
                    <td class="fr-1"><?php esc_html_e('Product Name',  'woo-order-status-per-product') ?></td>
                    <td class="fr-2"><?php echo esc_html($plugin_name); ?></td>
                </tr>
                <tr>
                    <td class="fr-1"><?php esc_html_e('Installed Version',  'woo-order-status-per-product') ?></td>
                    <td class="fr-2"><?php echo esc_html('Free version '.$plugin_version); ?></td>
                </tr>
                <tr>
                    <td class="fr-1"><?php esc_html_e('License & Terms of use',  'woo-order-status-per-product') ?></td>
                    <td class="fr-2"><a href="#"><?php esc_html_e('Click here',  'woo-order-status-per-product') ?></a><?php esc_html_e(' to view license and terms of use.',  'woo-order-status-per-product') ?></td>
                </tr>
                <tr>
                    <td class="fr-1"><?php esc_html_e('Help & Support',  'woo-order-status-per-product') ?></td>
                    <td class="fr-2">
                        <ul class="help-support">
                            <li><a target="_blank" href="<?php echo esc_url(site_url('wp-admin/admin.php?page=woo_order_status_per_product&tab=wcosi-plugin-getting-started')); ?>"><?php esc_html_e('Quick Start Guide',  'woo-order-status-per-product') ?></a></li>
                            <li><a target="_blank" href="<?php echo esc_url('https://wordpress.org/plugins/woo-order-status-per-product/'); ?>"><?php esc_html_e('Documentation',  'woo-order-status-per-product') ?></a>
                            </li>
                            <li><a target="_blank" href="https://www.thedotstore.com/dotstore-support-panel/"><?php esc_html_e('Support Forum',  'woo-order-status-per-product') ?></a></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td class="fr-1"><?php esc_html_e('Localization',  'woo-order-status-per-product') ?></td>
                    <td class="fr-2"><?php esc_html_e('English',  'woo-order-status-per-product') ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>