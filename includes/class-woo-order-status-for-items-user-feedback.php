<?php
/**
 * Plugin review class.
 * Prompts users to give a review of the plugin on WordPress.org after a period of usage.
 *
 * Heavily based on code by CoBlocks
 * https://github.com/coblocks/coblocks/blob/master/includes/admin/class-coblocks-feedback.php
 *
 * @package   WooOrderStatus
 * @author    theDotstore from WooOrderStatus
 * @link      https://editorsWooOrderStatus.com
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main Feedback Notice Class
 */

class WooOrderStatus_User_Feedback {

	/**
	 * Slug.
	 *
	 * @var string $slug
	 */
	private $slug;

	/**
	 * Name.
	 *
	 * @var string $name
	 */
	private $name;

	/**
	 * Time limit.
	 *
	 * @var string $time_limit
	 */
	private $time_limit;

	/**
	 * No Bug Option.
	 *
	 * @var string $nobug_option
	 */
	public $nobug_option;

	/**
	 * Activation Date Option.
	 *
	 * @var string $date_option
	 */
	public $date_option;

	/**
	 * Class constructor.
	 *
	 * @param string $args Arguments.
	 */
	public function __construct( $args ) {

		$this->slug = $args['slug'];
		$this->name = $args['name'];

		$this->date_option  = $this->slug . '_activation_date';
		$this->nobug_option = $this->slug . '_no_bug';

		if ( isset( $args['time_limit'] ) ) {
			$this->time_limit = $args['time_limit'];
		} else {
			$this->time_limit = WEEK_IN_SECONDS;
		}

		// Add actions.
		add_action( 'admin_init', array( $this, 'check_installation_date' ) );
		add_action( 'admin_init', array( $this, 'set_no_bug' ), 5 );
	}

	/**
	 * Seconds to words.
	 *
	 * @param string $seconds Seconds in time.
	 */
	public function seconds_to_words( $seconds ) {

		// Get the years.
		$years = ( intval( $seconds ) / YEAR_IN_SECONDS ) % 100;
		if ( $years > 1 ) {
			/* translators: Number of years */
			return sprintf( __( '%s years', 'woo-order-status-per-product' ), $years );
		} elseif ( $years > 0 ) {
			return __( 'a year', 'woo-order-status-per-product' );
		}

		// Get the weeks.
		$weeks = ( intval( $seconds ) / WEEK_IN_SECONDS ) % 52;
		if ( $weeks > 1 ) {
			/* translators: Number of weeks */
			return sprintf( __( '%s weeks', 'woo-order-status-per-product' ), $weeks );
		} elseif ( $weeks > 0 ) {
			return __( 'a week', 'woo-order-status-per-product' );
		}

		// Get the days.
		$days = ( intval( $seconds ) / DAY_IN_SECONDS ) % 7;
		if ( $days > 1 ) {
			/* translators: Number of days */
			return sprintf( __( '%s days', 'woo-order-status-per-product' ), $days );
		} elseif ( $days > 0 ) {
			return __( 'a day', 'woo-order-status-per-product' );
		}

		// Get the hours.
		$hours = ( intval( $seconds ) / HOUR_IN_SECONDS ) % 24;
		if ( $hours > 1 ) {
			/* translators: Number of hours */
			return sprintf( __( '%s hours', 'woo-order-status-per-product' ), $hours );
		} elseif ( $hours > 0 ) {
			return __( 'an hour', 'woo-order-status-per-product' );
		}

		// Get the minutes.
		$minutes = ( intval( $seconds ) / MINUTE_IN_SECONDS ) % 60;
		if ( $minutes > 1 ) {
			/* translators: Number of minutes */
			return sprintf( __( '%s minutes', 'woo-order-status-per-product' ), $minutes );
		} elseif ( $minutes > 0 ) {
			return __( 'a minute', 'woo-order-status-per-product' );
		}

		// Get the seconds.
		$seconds = intval( $seconds ) % 60;
		if ( $seconds > 1 ) {
			/* translators: Number of seconds */
			return sprintf( __( '%s seconds', 'woo-order-status-per-product' ), $seconds );
		} elseif ( $seconds > 0 ) {
			return __( 'a second', 'woo-order-status-per-product' );
		}
	}

	/**
	 * Check date on admin initiation and add to admin notice if it was more than the time limit.
	 */
	public function check_installation_date() {

		
		if ( ! get_site_option( $this->nobug_option ) || false === get_site_option( $this->nobug_option ) ) {

			add_site_option( $this->date_option, time() );

			// Retrieve the activation date.
			$install_date = get_site_option( $this->date_option );
			
			// If difference between install date and now is greater than time limit, then display notice.
			if ( ( time() - $install_date ) > $this->time_limit ) {
				add_action( 'admin_notices', array( $this, 'display_admin_notice' ) );
			}
		}
	}

	/**
	 * Display the admin notice.
	 */
	public function display_admin_notice() {

		$screen = get_current_screen();
		if ( isset( $screen->base ) && ( 'plugins' === $screen->base || 'dotstore-plugins_page_woo_order_status_per_product' === $screen->base )) {
			$no_bug_url = wp_nonce_url( admin_url( 'plugins.php?' . $this->nobug_option . '=true' ), 'editorsWooOrderStatus-feedback-nounce' );
			$time       = $this->seconds_to_words( time() - get_site_option( $this->date_option ) );
			?>

			<style>
			.notice.editorsWooOrderStatus-notice {
				border-left-color: #272c51 !important;
				padding: 20px;
			}
			.rtl .notice.editorsWooOrderStatus-notice {
				border-right-color: #272c51 !important;
			}
			.notice.notice.editorsWooOrderStatus-notice .editorsWooOrderStatus-notice-inner {
				display: table;
				width: 100%;
			}
			.notice.editorsWooOrderStatus-notice .editorsWooOrderStatus-notice-inner .editorsWooOrderStatus-notice-icon,
			.notice.editorsWooOrderStatus-notice .editorsWooOrderStatus-notice-inner .editorsWooOrderStatus-notice-content,
			.notice.editorsWooOrderStatus-notice .editorsWooOrderStatus-notice-inner .editorsWooOrderStatus-install-now {
				display: table-cell;
				vertical-align: middle;
			}
			.notice.editorsWooOrderStatus-notice .editorsWooOrderStatus-notice-icon {
				color: #509ed2;
				font-size: 13px;
				width: 60px;
			}
			.notice.editorsWooOrderStatus-notice .editorsWooOrderStatus-notice-icon img {
				width: 64px;
			}
			.notice.editorsWooOrderStatus-notice .editorsWooOrderStatus-notice-content {
				padding: 0 40px 0 20px;
			}
			.notice.editorsWooOrderStatus-notice p {
				padding: 0;
				margin: 0;
			}
			.notice.editorsWooOrderStatus-notice h3 {
				margin: 0 0 5px;
			}
			.notice.editorsWooOrderStatus-notice .editorsWooOrderStatus-install-now {
				text-align: center;
			}
			.notice.editorsWooOrderStatus-notice .editorsWooOrderStatus-install-now .editorsWooOrderStatus-install-button {
				padding: 6px 50px;
				height: auto;
				line-height: 20px;
				background: #32396a;
				border-color: #272c51 #0f153e #040823;
				box-shadow: 0 1px 0 #0d1f82;
				text-shadow: 0 -1px 1px #272c51, 1px 0 1px #171b3e, 0 1px 1px #0a1035, -1px 0 1px #040721;
			}
			.notice.editorsWooOrderStatus-notice .editorsWooOrderStatus-install-now .editorsWooOrderStatus-install-button:hover {
				background: #272c51;
			}
			.notice.editorsWooOrderStatus-notice a.no-thanks {
				display: block;
				margin-top: 10px;
				color: #72777c;
				text-decoration: none;
			}

			.notice.editorsWooOrderStatus-notice a.no-thanks:hover {
				color: #444;
			}

			@media (max-width: 767px) {

				.notice.notice.editorsWooOrderStatus-notice .editorsWooOrderStatus-notice-inner {
					display: block;
				}
				.notice.editorsWooOrderStatus-notice {
					padding: 20px !important;
				}
				.notice.editorsWooOrderStatus-noticee .editorsWooOrderStatus-notice-inner {
					display: block;
				}
				.notice.editorsWooOrderStatus-notice .editorsWooOrderStatus-notice-inner .editorsWooOrderStatus-notice-content {
					display: block;
					padding: 0;
				}
				.notice.editorsWooOrderStatus-notice .editorsWooOrderStatus-notice-inner .editorsWooOrderStatus-notice-icon {
					display: none;
				}

				.notice.editorsWooOrderStatus-notice .editorsWooOrderStatus-notice-inner .editorsWooOrderStatus-install-now {
					margin-top: 20px;
					display: block;
					text-align: left;
				}

				.notice.editorsWooOrderStatus-notice .editorsWooOrderStatus-notice-inner .no-thanks {
					display: inline-block;
					margin-left: 15px;
				}
			}
			</style>
			<div class="notice updated editorsWooOrderStatus-notice">
				<div class="editorsWooOrderStatus-notice-inner">
					<div class="editorsWooOrderStatus-notice-icon">
						<?php /* translators: 1. Name */ ?>
						<img src="<?php echo esc_url( plugins_url( 'admin/images/woo-product-att-logo.png', dirname( __FILE__ ))); ?>" alt="<?php printf( esc_attr__( '%s WordPress Plugin', 'woo-order-status-per-product' ), esc_attr( $this->name ) ); ?>" />
					</div>
					<div class="editorsWooOrderStatus-notice-content">
						<?php /* translators: 1. Name */ ?>
						<h3><?php printf( esc_html__( 'Are you enjoying %s Plugin?', 'woo-order-status-per-product' ), esc_html( $this->name ) ); ?></h3>
						<p>
							<?php /* translators: 1. Name, 2. Time */ ?>
							<?php printf( esc_html__( 'You have been using %1$s for %2$s now. Mind leaving a review to let us know know what you think? We\'d really appreciate it!', 'woo-order-status-per-product' ), esc_html( $this->name ), esc_html( $time ) ); ?>
						</p>
					</div>
					<div class="editorsWooOrderStatus-install-now">
						<?php 
							$review_url = '';
							$review_url = esc_url( 'https://wordpress.org/plugins/woo-order-status-per-product/#reviews' );
							printf( '<a href="%1$s" class="button button-primary editorsWooOrderStatus-install-button" target="_blank">%2$s</a>', esc_url( $review_url ), esc_html__( 'Leave a Review', 'woo-order-status-per-product' ) ); 
						?>
						<a href="<?php echo esc_url( $no_bug_url ); ?>" class="no-thanks"><?php echo esc_html__( 'No thanks / I already have', 'woo-order-status-per-product' ); ?></a>
					</div>
				</div>
			</div>
			<?php
		}
	}

	/**
	 * Set the plugin to no longer bug users if user asks not to be.
	 */
	public function set_no_bug() {

		// Bail out if not on correct page.
		// phpcs:ignore
		if ( ! isset( $_GET['_wpnonce'] ) || ( ! wp_verify_nonce( $_GET['_wpnonce'], 'editorsWooOrderStatus-feedback-nounce' ) || ! is_admin() || ! isset( $_GET[ $this->nobug_option ] ) || ! current_user_can( 'manage_options' ) ) ) {
			return;
		}

		add_site_option( $this->nobug_option, true );
	}
}

/*
* Instantiate the WooOrderStatus_User_Feedback class.
*/
new WooOrderStatus_User_Feedback(
	array(
		'slug'       => 'editorswoo_order_status_plugin_feedback',
		'name'       => __( 'Custom Order Status Per Product for WooCommerce', 'woo-order-status-per-product' ),
		'time_limit' => WEEK_IN_SECONDS,
	)
);
