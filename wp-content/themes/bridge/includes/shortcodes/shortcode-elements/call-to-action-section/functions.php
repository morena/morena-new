<?php

if(!function_exists('qode_add_call_to_action_section_shortcodes')) {
	function qode_add_call_to_action_section_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'Bridge\Shortcodes\CallToActionSection\CallToActionSection'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('qode_add_vc_shortcode', 'qode_add_call_to_action_section_shortcodes');
}