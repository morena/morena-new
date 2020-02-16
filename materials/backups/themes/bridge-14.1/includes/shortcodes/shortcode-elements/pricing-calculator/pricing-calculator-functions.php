<?php

if(!function_exists('qode_check_is_pricing_calculator_item_checked')) {
	function qode_check_is_pricing_calculator_item_checked($value) {

		if($value === 'yes') {
			return 'checked';
		}

		return '';
	}
}

if(!function_exists('qode_add_pricing_calculator_shortcodes')) {
	function qode_add_pricing_calculator_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'Bridge\Shortcodes\PricingCalculator\PricingCalculator'
		);

		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

		return $shortcodes_class_name;
	}

	add_filter('qode_add_vc_shortcode', 'qode_add_pricing_calculator_shortcodes');
}