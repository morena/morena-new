<?php
if(!function_exists('qode_get_title')) {
	function qode_get_title() {

		$page_id              = qode_get_page_id();
		$show_title_area_meta = true;
		$show_title_area      = apply_filters( 'qode_show_title_area', $show_title_area_meta );
		if($show_title_area){
			get_template_part( 'title' );
		}
	}
}
