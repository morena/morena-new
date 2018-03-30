<?php
if(!function_exists('qode_get_blog_single_params')) {
	function qode_get_blog_single_params() {
		global $qode_options_proya;
		$params = array();

		$id = qode_get_page_id();

		$chosen_sidebar = get_post_meta($id, "qode_show-sidebar", true);
		$default_array = array('default', '');

		if(!in_array($chosen_sidebar, $default_array)){
			$params['sidebar'] = get_post_meta($id, "qode_show-sidebar", true);
		}else{
			$params['sidebar'] = $qode_options_proya['blog_single_sidebar'];
		}

		$params['blog_hide_comments'] = "";
		if (isset($qode_options_proya['blog_hide_comments']))
			$params['blog_hide_comments'] = $qode_options_proya['blog_hide_comments'];

		if(get_post_meta($id, "qode_page_background_color", true) != ""){
			$params['background_color'] = get_post_meta($id, "qode_page_background_color", true);
		}else{
			$params['background_color'] = "";
		}

		$params['content_style_spacing'] = "";
		if(get_post_meta($id, "qode_margin_after_title", true) != ""){
			if(get_post_meta($id, "qode_margin_after_title_mobile", true) == 'yes'){
				$params['content_style_spacing'] = "padding-top:".esc_attr(get_post_meta($id, "qode_margin_after_title", true))."px !important";
			}else{
				$params['content_style_spacing'] = "padding-top:".esc_attr(get_post_meta($id, "qode_margin_after_title", true))."px";
			}
		}
		$params['single_type'] = qode_get_meta_field_intersect('blog_single_type');
		$params['single_loop'] = 'blog_single';
		$params['single_grid'] = 'yes';
		$params['single_class'] = array('blog_single', 'blog_holder');
		if($params['single_type'] == 'image-title-post'){
			$params['single_loop'] = 'blog-single-image-title-post';
			$params['single_grid'] = 'no';
			$params['single_class'][] = 'single_image_title_post';
		}

		return $params;
	}
}

if ( ! function_exists( 'qode_return_post_format' ) ) {
	/**
	 * Function return all parts on single.php page
	 */
	function qode_return_post_format() {
		$post_format            = get_post_format();
		$supported_post_formats = array( 'audio', 'video', 'link', 'quote', 'gallery' );
		$post_format            = in_array( $post_format, $supported_post_formats ) ? $post_format : 'standard';

		return $post_format;
	}
}