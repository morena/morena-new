<?php

if(!function_exists('qode_is_yith_wishlist_installed')) {
	function qode_is_yith_wishlist_installed() {
		return defined('YITH_WCWL');
	}
}

if(!function_exists('qode_woocommerce_wishlist_shortcode')) {
	function qode_woocommerce_wishlist_shortcode() {

		if(qode_is_yith_wishlist_installed()) {
			echo do_shortcode('[yith_wcwl_add_to_wishlist]');
		}
	}
}

if(!function_exists('qode_product_ajax_wishlist')) {
	function qode_product_ajax_wishlist(){

		$data = array(
			'wishlist_count_products' => class_exists('YITH_WCWL') ? yith_wcwl_count_products() : 0
		);
		wp_send_json($data); exit;
	}

	add_action('wp_ajax_qode_product_ajax_wishlist', 'qode_product_ajax_wishlist');
	add_action('wp_ajax_nopriv_qode_product_ajax_wishlist', 'qode_product_ajax_wishlist');
}

