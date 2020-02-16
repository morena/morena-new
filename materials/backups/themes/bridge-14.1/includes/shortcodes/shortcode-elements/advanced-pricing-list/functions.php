<?php

if(!function_exists('qode_add_advanced_pricing_list_shortcodes')) {
	function qode_add_advanced_pricing_list_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'Bridge\Shortcodes\AdvancedPricingList\AdvancedPricingList',
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('qode_add_vc_shortcode', 'qode_add_advanced_pricing_list_shortcodes');
}