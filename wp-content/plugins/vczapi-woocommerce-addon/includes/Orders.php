<?php

namespace Codemanas\ZoomWooCommerceAddon;

use Codemanas\ZoomWooCommerceAddon\DataStore as DataStore;

/**
 * Class Orders
 *
 * Handle WooCommerce Order Operations
 *
 * @author  Deepen Bajracharya, CodeManas, 2020. All Rights reserved.
 * @since   1.1.0
 * @package Codemanas\ZoomWooCommerceAddon
 */
class Orders {

	/**
	 * @var string
	 */
	private $column;

	private $hide_recordings;

	/**
	 * @var null
	 */
	public static $instance = null;

	/**
	 * @return Orders|null
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Orders constructor.
	 */
	public function __construct() {
		$this->column          = array( 'wc-zoom-meetings', 'wc-zoom-recordings' );
		$this->hide_recordings = get_option( 'vczapi_wc_hide_purchased_recordings' );
		$plugin_settings       = get_option( '_vczapi_settings' );
		if ( ! Helper::check_is_booking_addon_active() || ! empty( $plugin_settings['disable_meetings_tab'] ) ) {
			add_action( 'init', array( $this, 'add_meeting_link_endpoint' ) );
			add_filter( 'query_vars', array( $this, 'meeting_link_query_vars' ), 0 );
			add_filter( 'woocommerce_account_menu_items', array( $this, 'meeting_link' ), 5 );
			add_action( 'woocommerce_account_' . $this->column[0] . '_endpoint', array( $this, 'show_purchased_meetings' ) );
			if ( empty( $this->hide_recordings ) ) {
				add_action( 'woocommerce_account_' . $this->column[1] . '_endpoint', array( $this, 'show_purchased_recordings' ) );
			}
		}

		//WooCommerce Order Template End
		add_action( 'woocommerce_order_item_meta_end', array( $this, 'email_meeting_details' ), 20, 3 );
	}

	/**
	 * Add endpoint to wc-zoom-meetings
	 */
	public function add_meeting_link_endpoint() {
		add_rewrite_endpoint( 'wc-zoom-meetings', EP_ROOT | EP_PAGES );
		add_rewrite_endpoint( 'wc-zoom-recordings', EP_ROOT | EP_PAGES );
	}

	/**
	 * Define Vars
	 *
	 * @param $vars
	 *
	 * @return array
	 */
	public function meeting_link_query_vars( $vars ) {
		foreach ( $this->column as $column ) {
			$vars[] = $column;
		}

		return $vars;
	}

	/**
	 * Add new link into my-account section in WooCommerce
	 *
	 * @param $items
	 *
	 * @return mixed
	 */
	public function meeting_link( $items ) {
		$items[ $this->column[0] ] = __( 'Meetings', 'vczapi-woocommerce-addon' );
		if ( empty( $this->hide_recordings ) ) {
			$items[ $this->column[1] ] = __( 'Recordings', 'vczapi-woocommerce-addon' );
		}

		return $items;
	}

	public function show_purchased_recordings() {
		echo do_shortcode( '[vczapi_wc_show_purchased_recordings]' );
	}

	/**
	 * Display links
	 */
	public function show_purchased_meetings() {
		$this->show_purchased_meetings_list_data();
	}

	/**
	 * Display Column data for zoom link
	 *
	 * @author Deepen Bajracharya
	 * @since  1.1.0
	 */
	public function show_purchased_meetings_list_data() {
		// Get 10 most recent order ids in date descending order.
		TemplateOverrides::get_template( [ 'frontend/meeting-list.php' ], true );
	}

	/**
	 * No orders text
	 */
	public static function output_no_order_text() {
		?>
        <tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-processing order">
            <td colspan="4"><?php _e( 'No meeting orders received yet.', 'vczapi-woocommerce-addon' ); ?></td>
        </tr>
		<?php
	}

	/**
	 * Show in order details
	 *
	 * @param           $item_id
	 * @param           $item
	 * @param \WC_Order $order
	 */
	public function email_meeting_details( $item_id, $item, $order ) {
		if ( $order->get_status() === "completed" || $order->get_status() === "processing" ) {
			$product_id = $item['product_id'];
			$post_id    = get_post_meta( $product_id, '_vczapi_zoom_post_id', true );
			if ( ! empty( $post_id ) ) {
				$fields          = get_post_meta( $post_id, '_meeting_fields_woocommerce', true );
				$meeting_details = get_post_meta( $post_id, '_meeting_zoom_details', true );
				if ( ! empty( $meeting_details ) && ! empty( $fields['enable_woocommerce'] ) ) {
					do_action( 'vczapi_woocommerce_before_meeting_details' );
					$disabled = get_option( '_vczapi_woocommerce_disable_browser_join' );
					$content  = apply_filters( 'vczapi_woocommerce_order_item_meta', '', $item_id, $item, $order );
					if ( ! empty( $content ) ) {
						echo $content;
					} else {
						ob_start();
						?>
                        <ul class="vczapi-woocommerce-email-mtg-details">
                            <li class="vczapi-woocommerce-email-mtg-details--list1"><strong><?php _e( 'Meeting Details', 'vczapi-woocommerce-addon' ); ?>
                                    :</strong></li>
                            <li class="vczapi-woocommerce-email-mtg-details--list2"><strong><?php _e( 'Topic', 'vczapi-woocommerce-addon' ); ?>
                                    :</strong> <?php echo $meeting_details->topic; ?></li>
                            <li class="vczapi-woocommerce-email-mtg-details--list3"><strong><?php _e( 'Start Time', 'vczapi-woocommerce-addon' ); ?>
                                    :</strong>
								<?php
								echo vczapi_dateConverter( $meeting_details->start_time, $meeting_details->timezone, 'F j, Y @ g:i a' );
								?></li>
                            <li class="vczapi-woocommerce-email-mtg-details--list3"><strong><?php _e( 'Timezone', 'vczapi-woocommerce-addon' ); ?>
                                    :</strong>
								<?php
								echo $meeting_details->timezone;
								?></li>
                            <li class="vczapi-woocommerce-email-mtg-details--list4">
                                <a target="_blank" rel="nofollow" href="<?php echo esc_url( $meeting_details->join_url ); ?>"><?php echo apply_filters( 'vczapi_woocommerce_join_via_app_text', __( 'Join via App', 'vczapi-woocommerce-addon' ) ); ?></a>
                            </li>
							<?php if ( empty( $disabled ) && ! empty( $meeting_details->password ) ) { ?>
                                <li class="vczapi-woocommerce-email-mtg-details--list5">
									<?php echo DataStore::get_browser_join_link( $post_id, $meeting_details->password, $meeting_details->id ); ?>
                                </li>
							<?php } ?>
                        </ul>
						<?php
						$content .= ob_get_clean();
						echo $content;
					}

					do_action( 'vczapi_woocommerce_after_meeting_details' );
				}
			}
		}
	}
}