<?php

namespace Codemanas\ZoomWooCommerceAddon\Admin;

use DateTime;
use DateTimeZone;

/**
 * Class WooCommerceZoomConnection
 *
 * @package Codemanas\ZoomWooCommerceAddon\Admin
 * @since   1.0.2
 */
class WooCommerceZoomConnection {

	/**
	 * Instance property
	 *
	 * @var null
	 */
	public static $instance = null;

	/**
	 * Instance object
	 *
	 * @return WooCommerceZoomConnection|null
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * WooCommerceZoomConnection constructor.
	 */
	public function __construct() {
		//Admin Panels
		add_filter( 'woocommerce_product_data_tabs', [ $this, 'add_product_tab' ], 10 );
		add_action( 'woocommerce_product_data_panels', [ $this, 'connection_tab_content' ] );
		//Save Meta
		add_action( 'woocommerce_process_product_meta', [ $this, 'save_meta' ], 20 );
		//Enqueue styles and scripts
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts_and_styles' ] );
		//Ajax handler
		add_action( 'wp_ajax_vczapi_zoom_woocommerce_link', [ $this, 'link_with_zoom_meeting' ] );
		//Validate Cart
		add_filter( 'woocommerce_add_to_cart_validation', [ $this, 'validate_on_add_to_cart' ], 10, 3 );
		add_filter( 'woocommerce_update_cart_validation', [ $this, 'validate_on_update_card' ], 1, 4 );
		//Front end add tab
		add_filter( 'woocommerce_product_tabs', [ $this, 'frontend_product_tab' ] );

		add_action( 'before_delete_post', [ $this, 'remove_zoom_meeting_link' ] );
		//hide meetings for users who don't have sufficient access
		add_action( 'pre_get_posts', [ $this, 'show_only_authors_own_meetings' ] );
		add_filter( 'vczapi_wc_ajax_search_query_args', [ $this, 'only_show_own_created_meetings' ] );
	}

	/**
	 * Add meeting details Tab
	 *
	 * @param $tabs
	 *
	 * @return mixed
	 */
	public function frontend_product_tab( $tabs ) {
		global $post;
		$meeting_id = get_post_meta( $post->ID, '_vczapi_zoom_post_id', true );
		$enabled    = get_post_meta( $post->ID, '_vczapi_enable_zoom_link', true );
		if ( ! empty( $meeting_id ) && ! empty( $enabled ) ) {
			$tabs['zoom-meeting-details'] = array(
				'title'    => __( 'Meeting Details', 'vczapi-woocommerce-addon' ),
				'priority' => 50,
				'callback' => array( $this, 'frontend_product_tab_content' )
			);
		}


		return $tabs;
	}

	/**
	 * Generate frontend product tab
	 */
	public function frontend_product_tab_content() {
		$product_id   = get_the_ID();
		$zoom_post_id = get_post_meta( $product_id, '_vczapi_zoom_post_id', true );
		echo $this->get_meeting_details( $zoom_post_id );
	}


	/**
	 * Enqueue Script required for WooCommerce Addon
	 */
	public function enqueue_scripts_and_styles() {
		$screen = get_current_screen();
		wp_register_script( 'vczapi-woocommerce', VZAPI_WOOCOMMERCE_ADDON_DIR_URI . '/assets/backend/js/woo-zoom.js', array( 'jquery' ), '1.0.2', true );

		if ( ! empty( $screen ) && property_exists( $screen, 'id' ) && ( $screen->id == 'product' || $screen->id == 'zoom-meetings' ) ) {
			wp_enqueue_style( 'video-conferencing-with-zoom-api-datable', ZVC_PLUGIN_VENDOR_ASSETS_URL . '/datatable/jquery.dataTables.min.css', false, '3.0.0' );
			wp_enqueue_script( 'vczapi-woocommerce' );
			wp_localize_script( 'vczapi-woocommerce', 'vczapiWC', array(
				'nonce' => wp_create_nonce( 'vczpai_verify_nonce' )
			) );
		}
	}

	/**
	 *
	 * @param array $tabs
	 *
	 * @return mixed
	 */
	public function add_product_tab( $tabs ) {
		$tabs['zoom_connection'] = array(
			'label'  => __( 'Zoom Connection', 'vczapi-woocommerce-addon' ),
			'target' => 'vczapi_zoom_connection',
			'class'  => array(
				'hide_if_booking'
			),
		);

		return $tabs;
	}

	/**
	 * Render contents for the selected tab
	 *
	 * @since 1.0.2
	 */
	public function connection_tab_content() {
		global $post;
		$product_id = get_the_ID();
		?>
        <style>
            .vczapi-woocommerce {
                padding: 1em 1.5em;
            }
        </style>
        <div id='vczapi_zoom_connection' class='vczapi-woocommerce panel woocommerce_options_panel'>
            <input id="vczapi-product-id" type="hidden" value="<?php echo $post->ID; ?>"/>
			<?php
			$zoom_post_id     = get_post_meta( $product_id, '_vczapi_zoom_post_id', true );
			$enable_zoom_link = get_post_meta( $product_id, '_vczapi_enable_zoom_link', true );
			?>
            <h3><?php _e( 'Link to a Zoom Meeting :', 'vczapi-woocommerce-addon' ); ?></h3>
			<?php
			woocommerce_wp_checkbox( array(
				'id'          => '_vczapi_enable_zoom_link',
				'label'       => __( 'Enable Zoom Connection', 'vczapi-woocommerce-addon' ),
				'description' => __( 'Check this box, to link to product to a Zoom Meeting', 'vczapi-woocommerce-addon' ),
				'desc_tip'    => true
			) );
			?>
			<?php do_action( 'vczapi_woocommerce_after_zoom_connection_fields', $product_id ); ?>
            <div class="zoom-connection-enabled" style="<?php echo ( empty( $zoom_post_id ) && empty( $enable_zoom_link ) ) ? 'display:none' : ''; ?>">
                <p class="description">
					<?php _e( 'If you haven\'t created a Zoom Meeting - please do so first here', 'vczapi-woocommerce-addon' ); ?>
                    <a href="<?php echo admin_url( 'edit.php?post_type=zoom-meetings' ); ?>" target="_blank" rel="noopener noreferrer"><?php _e( 'New Meeting', 'vczapi-woocommerce-addon' ); ?></a> <?php _e( 'and refresh this product, you can then select from meetings already created below.', 'vczapi-woocommerce-addon' ); ?>
                </p>
                <p class="description"><?php _e( 'If you link a meeting here. Your Zoom Meeting Post will automatically be enrolled as a Buyable Meeting.', 'vczapi-woocommerce-addon' ); ?></p>
                <div class='options_group'>
                    <p class="form-field">
                        <label for="_vczapi_zoom_post_id">Zoom Meeting</label>
                        <select name="_vczapi_zoom_post_id" id="_vczapi_zoom_post_id" class="vczapi-zoom-connect select short" style="width:50%;">
							<?php if ( ! empty( $zoom_post_id ) ) {
								echo '<option value="' . absint( esc_attr( $zoom_post_id ) ) . '">' . esc_html( get_the_title( $zoom_post_id ) ) . '</option>';
							} ?>
                        </select>
                    </p>
                    <div class="vczapi-woocommerce--meeting-details">
                        <h3><?php _e( 'Meeting Details', 'vczapi-woocommerce-addon' ); ?></h3>
                        <div class="info">
							<?php echo $this->get_meeting_details( $zoom_post_id ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}

	/**
	 * Save product meta succesfully !
	 *
	 * @param $product_id
	 *
	 * @since 1.0.2
	 */
	public function save_meta( $product_id ) {
		/*
		 * if enable zoom connection is selected - zoom meeting can be linked.
		 * if zoom meeting is linked then zoom meeting should have product_id    listed so that meeting on
		 * example.com/zoom-meeeting/meeting-url does not show start / join meeting option
		 * if meeting is removed or enable zoom is disabled then meeting and product link should be severed
		 */
		$enable_zoom       = filter_input( INPUT_POST, '_vczapi_enable_zoom_link' );
		$prev_zoom_post_id = get_post_meta( $product_id, '_vczapi_zoom_post_id', true );
		$zoom_post_id      = absint( filter_input( INPUT_POST, '_vczapi_zoom_post_id' ) );
		if ( ! empty( $enable_zoom ) ) {
			update_post_meta( $product_id, '_vczapi_enable_zoom_link', $enable_zoom );

			if ( ! empty( $zoom_post_id ) && is_numeric( $zoom_post_id ) ) {
				$product  = wc_get_product( $product_id );
				$settings = array(
					'enable_woocommerce' => ( $enable_zoom == 'yes' ) ? 'on' : '',
					'cost'               => $product->get_regular_price()
				);
				update_post_meta( $zoom_post_id, '_meeting_fields_woocommerce', $settings );

				update_post_meta( $product_id, '_vczapi_zoom_post_id', $zoom_post_id );
				update_post_meta( $zoom_post_id, '_vczapi_zoom_product_id', $product_id );
				update_post_meta( $product_id, '_sold_individually', 'yes' );
			}
		} else {
			delete_post_meta( $product_id, '_vczapi_zoom_post_id' );
			delete_post_meta( $product_id, '_vczapi_enable_zoom_link' );
			delete_post_meta( $zoom_post_id, '_meeting_fields_woocommerce' );
		}

		if ( $prev_zoom_post_id != $zoom_post_id || $enable_zoom == false ) {
			$prev_zoom_post_linked_products = get_post_meta( $prev_zoom_post_id, '_vczapi_zoom_product_id', true );
			if ( ! empty( $prev_zoom_post_linked_products ) ) {
				delete_post_meta( $prev_zoom_post_id, '_vczapi_zoom_product_id' );
			}
		}
	}

	/**
	 * Ajax callback for zoom meeting connection
	 *
	 * @since 1.0.2
	 */
	public function link_with_zoom_meeting() {
		check_ajax_referer( 'vczpai_verify_nonce', 'security' );

		$meeting_args = apply_filters( 'vczapi_wc_ajax_search_query_args', [
			'post_type'      => 'zoom-meetings',
			'posts_status'   => 'publish',
			'posts_per_page' => 10,
			's'              => filter_input( INPUT_GET, 'search' ),
			'meta_query'     => array(
				'relation' => 'or',
				array(
					'key'     => '_vczapi_zoom_product_id',
					'value'   => array( '' ),
					'compare' => 'NOT LIKE',
				),
				array(
					'key'     => '_vczapi_zoom_product_id',
					'compare' => 'NOT EXISTS',
				)
			)
		] );

		$meetings    = get_posts( $meeting_args );
		$items       = array();
		$meetingData = array();
		foreach ( $meetings as $meeting ) {
			$items[]                     = array(
				'id'   => $meeting->ID,
				'text' => $meeting->post_title
			);
			$meetingData[ $meeting->ID ] = $this->get_meeting_details( $meeting->ID );

		}
		$data = array(
			'items'       => $items,
			'meetingData' => $meetingData
		);

		if ( ! empty( $data ) ) {
			return wp_send_json_success( $data );
		} else {
			return wp_send_json_error( array( 'message' => 'nothing found' ) );
		}
	}

	/**
	 * Get meeting details in Admin Interface
	 *
	 * @param $zoom_post_id
	 *
	 * @return bool|string|null
	 * @throws \Exception
	 */
	public function get_meeting_details( $zoom_post_id ) {
		if ( empty( $zoom_post_id ) ) {
			return null;
		}

		#$meeting_details = get_post_meta( $zoom_post_id, '_meeting_fields', true ); //OLD WAY
		$meeting_details      = get_post_meta( $zoom_post_id, '_meeting_zoom_details', true );
		$meeting_details_info = false;
		if ( ! empty( $meeting_details ) && is_object( $meeting_details ) ) {
			//IF INCASES THE MEETING IS A RECURRING MEETING TYPE 8 = NOT FIXED RECURRING, 3 = FIXED RECURRING MEETING
			if ( ( $meeting_details->type === 8 || $meeting_details->type === 3 ) && vczapi_recurring_addon_active() ) {
				$meeting_details->occurrences = ! empty( $meeting_details->occurrences ) ? $meeting_details->occurrences : false;
				$now                          = new DateTime( 'now' );
				$now->setTimezone( new DateTimeZone( $meeting_details->timezone ) );
				$next_occurence = false;
				if ( $meeting_details->type === 8 && ! empty( $meeting_details->occurrences ) ) {
					foreach ( $meeting_details->occurrences as $occurrence ) {
						if ( $occurrence->status === "available" ) {
							$start_date = new DateTime( $occurrence->start_time );
							$start_date->setTimezone( new DateTimeZone( $meeting_details->timezone ) );
							if ( $start_date >= $now ) {
								$next_occurence = $occurrence->start_time;
								break;
							}
						}
					}
				} else if ( $meeting_details->type === 3 ) {
					//No time fixed meeting
					$next_occurence = false;
				} else {
					//Set Past date
					$next_occurence = 'ended';
				}

				if ( ! $next_occurence ) {
					$next_occurence = __( 'No fixed time Meeting', 'vczapi-woocommerce-addon' );
				} else if ( $next_occurence === "ended" ) {
					$next_occurence = __( 'Meeting Ended', 'vczapi-woocommerce-addon' );
				} else {
					$next_occurence = vczapi_dateConverter( $next_occurence, $meeting_details->timezone, 'F j, Y, g:i a' );
				}

				$all_occurrences = '';
				if ( isset( $meeting_details->occurrences ) & ! empty( $meeting_details->occurrences ) ):
					ob_start();
					?>
                    <div class="dpn-zvc-sidebar-content-list zvc-all-occurrences">
                        <p>
                            <a href="#" class="zvc-all-occurrences__toggle-button"><?php _e( 'Click to See All Meeting Occurrences', 'vczapi-pro' ); ?></a>
                        </p>
                        <div class="zvc-all-occurrences__list">
                            <span><strong><?php _e( 'Timezone', 'vczapi-pro' ); ?>:</strong> <?php echo $meeting_details->timezone; ?></span>
                            <ul>
								<?php foreach ( $meeting_details->occurrences as $occurrence ): ?>
                                    <li><?php echo vczapi_dateConverter( $occurrence->start_time, $meeting_details->timezone, 'F j, Y @ g:i a' ); ?></li>
								<?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
					<?php
					$all_occurrences = ob_get_clean();
				endif;

				if ( current_user_can( 'edit_posts' ) ) {
					$meeting_details_info = sprintf(
						'<p><strong>' . __( 'Type', 'vczapi-woocommerce-addon' ) . ':</strong> ' . __( 'Recurring Meeting', 'vczapi-woocommerce-addon' ) . '</p><p><strong>' . __( 'Title', 'vczapi-woocommerce-addon' ) . ':</strong><br />%s</p><p style="margin-top:10px;"><strong>' . __( 'Next Occurrence', 'vczapi-woocommerce-addon' ) . ':</strong><br>%s</p>%s<p><strong>' . __( 'Timezone', 'vczapi-woocommerce-addon' ) . ':</strong><br>%s</p><p><a href="%s">' . __( 'Edit Meeting Post', 'vczapi-woocommerce-addon' ) . '</a></p>',
						esc_html( get_the_title( $zoom_post_id ) ),
						esc_html( $next_occurence ),
						$all_occurrences,
						esc_html( $meeting_details->timezone ),
						esc_html( get_edit_post_link( $zoom_post_id ) )
					);
				} else {
					$meeting_details_info = sprintf(
						'<p><strong>' . __( 'Type', 'vczapi-woocommerce-addon' ) . ':</strong> ' . __( 'Recurring Meeting', 'vczapi-woocommerce-addon' ) . '</p><p><strong>' . __( 'Title', 'vczapi-woocommerce-addon' ) . ':</strong><br />%s</p><p style="margin-top:10px;"><strong>' . __( 'Next Occurrence', 'vczapi-woocommerce-addon' ) . ':</strong><br>%s<br>%s</p><p><strong>' . __( 'Timezone', 'vczapi-woocommerce-addon' ) . ':</strong><br>%s</p>',
						esc_html( get_the_title( $zoom_post_id ) ),
						esc_html( $next_occurence ),
						$all_occurrences,
						esc_html( $meeting_details->timezone )
					);
				}
			} else {
				if ( $meeting_details->type === 8 || $meeting_details->type === 3 ) {
					$meeting_details->start_time = false; //JUST TO AVOID ERROR HERE
				}

				if ( current_user_can( 'edit_posts' ) ) {
					$meeting_details_info = sprintf(
						'<p><strong>' . __( 'Title', 'vczapi-woocommerce-addon' ) . ':</strong><br />%s</p><p style="margin-top:10px;"><strong>' . __( 'Time', 'vczapi-woocommerce-addon' ) . ':</strong><br>%s</p><p><strong>' . __( 'Timezone', 'vczapi-woocommerce-addon' ) . ':</strong><br>%s</p><p><a href="%s">' . __( 'Edit Meeting Post', 'vczapi-woocommerce-addon' ) . '</a></p>',
						esc_html( get_the_title( $zoom_post_id ) ),
						esc_html( vczapi_dateConverter( $meeting_details->start_time, $meeting_details->timezone, 'F j, Y, g:i a' ) ),
						esc_html( $meeting_details->timezone ),
						esc_html( get_edit_post_link( $zoom_post_id ) )
					);
				} else {
					$meeting_details_info = sprintf(
						'<p><strong>' . __( 'Title', 'vczapi-woocommerce-addon' ) . ':</strong><br />%s</p><p style="margin-top:10px;"><strong>' . __( 'Time', 'vczapi-woocommerce-addon' ) . ':</strong><br>%s</p><p><strong>' . __( 'Timezone', 'vczapi-woocommerce-addon' ) . ':</strong><br>%s</p>',
						esc_html( get_the_title( $zoom_post_id ) ),
						esc_html( vczapi_dateConverter( $meeting_details->start_time, $meeting_details->timezone, 'F j, Y, g:i a' ) ),
						esc_html( $meeting_details->timezone )
					);
				}
			}
		}

		return $meeting_details_info;
	}

	/**
	 * Validates product on add to cart - Zoom Connected Products should not be purchased with quantity greater than 1
	 *
	 * @param $passed
	 * @param $product_id
	 * @param $quantity
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public function validate_on_add_to_cart( $passed, $product_id, $quantity ) {
		$zoom_post_id = get_post_meta( $product_id, '_vczapi_zoom_post_id', true );
		if ( ! empty( $zoom_post_id ) ) {

			if ( $quantity > 1 ) {
				wc_add_notice( __( 'Zoom Meeting product quantity cannot be greater than 1 !', 'vczapi-woocommerce-addon' ), 'error' );
				$passed = false;
			}

			$check_valid_deadline = apply_filters( 'vczapi_wc_check_valid_deadline', true, $zoom_post_id );
			$is_deadline_crossed  = $this->check_deadline_crossed_for_meetings( $zoom_post_id );
			if ( $check_valid_deadline && ! $is_deadline_crossed['valid'] && $passed == true ) {
				wc_add_notice( $is_deadline_crossed['message'], 'error' );
				$passed = false;
			}

		}

		return $passed;
	}

	/**
	 * Validation for Deadline crossed or not !
	 *
	 * @param $meeting_id
	 *
	 * @return array
	 * @throws \Exception
	 */
	public function check_deadline_crossed_for_meetings( $meeting_id ) {
		$response = array( 'valid' => false, 'date' => '', 'message' => __( 'Valid zoom meeting required!', 'vczapi-woocommerce-addon' ) );
		if ( empty( $post_id ) && ! is_numeric( $meeting_id ) ) {
			return $response;
		}

		$meeting_post = get_post( $meeting_id );
		if ( $meeting_post->post_type != 'zoom-meetings' ) {
			return $response;
		}

		$meeting_details = get_post_meta( $meeting_id, '_meeting_zoom_details', true );
		if ( ! empty( $meeting_details ) && is_object( $meeting_details ) ) {
			if ( $meeting_details->type === 8 || $meeting_details->type === 3 ) {
				$meeting_details->start_time = false;
			}

			$meeting_date = vczapi_dateConverter( $meeting_details->start_time, $meeting_details->timezone, false );
			$meeting_date = apply_filters( 'vczapi_woocommerce_check_deadline_crossed_meeting_date', $meeting_date, $meeting_id );
			$current_date = vczapi_dateConverter( 'now', $meeting_details->timezone, false );
			if ( $current_date > $meeting_date ) {
				$response = array(
					'valid'   => false,
					'date'    => $meeting_date,
					'message' => sprintf( apply_filters( 'vczapi_woocommerce_time_passed_text', __( 'Valid zoom meeting required - Meeting time of %s has passed', 'vczapi-woocommerce-addon' ), $meeting_date ), $meeting_date->format( 'F j, Y, g:i a' ) )
				);
			} else {
				$response = array( 'valid' => true, 'date' => $meeting_date, 'message' => '' );
			}
		}

		$response = apply_filters( 'vczapi_woocommerce_check_deadline_crossed_response', $response, $meeting_id );

		return $response;
	}

	/**
	 * Validates cart update - Zoom Connected Products should not be purchased with quantity greater than 1
	 *
	 * @param $passed
	 * @param $cart_item_key
	 * @param $values
	 * @param $quantity
	 *
	 * @return bool
	 */
	public function validate_on_update_card( $passed, $cart_item_key, $values, $quantity ) {
		$product_id   = $values['product_id'];
		$zoom_post_id = get_post_meta( $product_id, '_vczapi_zoom_post_id', true );
		if ( ! empty( $zoom_post_id ) && $quantity > 1 ) {
			wc_add_notice( __( 'Zoom Meeting product quantity cannot be greater than 1 !', 'vczapi-woocommerce-addon' ), 'error' );
			$passed = false;
		}

		return $passed;
	}

	/**
	 * @param $post_id
	 */
	public function remove_zoom_meeting_link( $post_id ) {
		$post = get_post( $post_id );
		if ( empty( $post ) ) {
			return;
		}
		if ( ! $post->post_type == 'product' ) {
			return;
		}
		$meeting_id = get_post_meta( $post_id, '_vczapi_zoom_post_id', true );
		if ( empty( $meeting_id ) ) {
			return;
		}
		//maintain one to one relationship
		delete_post_meta( $meeting_id, '_meeting_fields_woocommerce' );
		delete_post_meta( $meeting_id, '_vczapi_zoom_product_id' );
	}

	/**
	 * @param \WP_Query $query
	 *
	 * @return mixed
	 */
	public function show_only_authors_own_meetings( $query ) {
		global $pagenow;

		if ( 'edit.php' != $pagenow || ! $query->is_admin ) {
			return false;
		}

		if ( $query->is_main_query() && $query->get( 'post_type' ) == 'zoom-meetings' ) {
			$user             = wp_get_current_user();
			$privileged_roles = $this->get_priviliged_roles();

			if ( ! empty( array_intersect( $user->roles, $privileged_roles ) ) ) {
				return false;
			}

			add_filter( 'views_edit-zoom-meetings', [ $this, 'zoom_meeting_views' ], 11 );
			$query->set( 'author', $user->ID );

		}
	}

	public function zoom_meeting_views( $views ) {
		foreach ( $views as $k => $v ) {
			$new_views[ $k ] = preg_replace( '/\(\d+\)/', '', $v );
		}

		$views = $new_views;

		// remove trash status
		unset( $views['mine'] );

		return $views;
	}

	/**
	 * Search for created meetings
	 *
	 * @param $search_query
	 *
	 * @return bool
	 */
	public function only_show_own_created_meetings( $search_query ) {

		if ( ! is_user_logged_in() ) {
			return $search_query;
		}
		$user             = wp_get_current_user();
		$privileged_roles = $this->get_priviliged_roles();

		//this is restricting different from function  show_only_authors_own_posts which is used to on meetings listing page
		if ( empty( array_intersect( $user->roles, $privileged_roles ) ) ) {
			$search_query['author'] = $user->ID;
		}

		return $search_query;
	}

	/**
	 * @return mixed|void
	 */
	private function get_priviliged_roles() {
		return apply_filters( 'vczapi_wc_privileged_roles', [ 'administrator', 'shop_manager' ] );
	}


}