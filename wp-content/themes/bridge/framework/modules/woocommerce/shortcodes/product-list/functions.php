<?php
if(!function_exists('qode_add_product_list_shortcode')) {
	function qode_add_product_list_shortcode($shortcodes_class_name) {
		$shortcodes = array(
			'Bridge\Shortcodes\ProductList\ProductList',
		);

		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

		return $shortcodes_class_name;
	}


	add_filter('qode_add_vc_shortcode', 'qode_add_product_list_shortcode');

}