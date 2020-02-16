<?php

if(!function_exists('qode_add_interest_rate_calculator_shortcodes')) {
	function qode_add_interest_rate_calculator_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'Bridge\Shortcodes\InterestRateCalculator\InterestRateCalculator'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('qode_add_vc_shortcode', 'qode_add_interest_rate_calculator_shortcodes');
}