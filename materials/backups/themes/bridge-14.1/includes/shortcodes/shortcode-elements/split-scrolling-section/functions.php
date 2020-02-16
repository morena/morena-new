<?php
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Qode_Split_Scrolling_Section extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Qode_Split_Scrolling_Section_Left_Panel extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Qode_Split_Scrolling_Section_Right_Panel extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Qode_Split_Scrolling_Section_Content_Item extends WPBakeryShortCodesContainer {}
}

if(!function_exists('qode_add_split_scrolling_section_shortcodes')) {
	function qode_add_split_scrolling_section_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'Bridge\Shortcodes\SplitScrollingSection\SplitScrollingSection',
			'Bridge\Shortcodes\SplitScrollingSectionContentItem\SplitScrollingSectionContentItem',
			'Bridge\Shortcodes\SplitScrollingSectionLeftPanel\SplitScrollingSectionLeftPanel',
			'Bridge\Shortcodes\SplitScrollingSectionRightPanel\SplitScrollingSectionRightPanel'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('qode_add_vc_shortcode', 'qode_add_split_scrolling_section_shortcodes');
}