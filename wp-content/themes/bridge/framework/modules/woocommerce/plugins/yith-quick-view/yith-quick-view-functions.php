<?php

if(!function_exists('qode_woocommerce_quickview_link')) {
	/**
	 * Function that returns quick view link
	 */
	function qode_woocommerce_quickview_link(){
		global $product;

		if ( version_compare( WOOCOMMERCE_VERSION, '3.0' ) >= 0 ) {
			$product_id = $product->get_id();
		} else {
			$product_id = $product->ID;
		}

		print '<div class="qode-yith-wcqv-holder"><a href="#" class="yith-wcqv-button" data-product_id="'.$product_id.'"></a></div>';

	}
	add_action('qode_woocommerce_info_below_image_hover', 'qode_woocommerce_quickview_link',1);
}

if(!function_exists('qode_woocommerce_disable_yith_pretty_photo')) {
	/**
	 * Function that disable YITH Quick View pretty photo style
	 */
	function qode_woocommerce_disable_yith_pretty_photo() {
		//is woocommerce installed?
		if(qode_is_woocommerce_installed() && qode_is_yith_wcqv_install()) {

			wp_deregister_style('woocommerce_prettyPhoto_css');
		}
	}

	add_action('wp_footer', 'qode_woocommerce_disable_yith_pretty_photo');
}

