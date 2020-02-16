<?php

if(!function_exists('qode_woocommerce_styles')) {

    function qode_woocommerce_styles() {
		$first_color_selector = array(
			'.qode-pl-holder .qode-prl-loading .qode-prl-loading-msg',
			'.qode-pl-holder .qode-pl-categories ul li a:hover, .qode-pl-holder .qode-pl-categories ul li a.active',
			'.qode-pl-holder .qode-pli .qode-pli-rating',
			'.qode-pl-holder.qode-info-on-image:not(.qode-product-info-light) .qode-pli-category',
			'.qode-pl-holder.qode-info-on-image:not(.qode-product-info-light) .qode-pli-excerpt',
			'.qode-pl-holder.qode-info-on-image:not(.qode-product-info-light) .qode-pli-price',
			'.qode-pl-holder.qode-info-on-image:not(.qode-product-info-light) .qode-pli-rating',
			'.qode-pl-holder.qode-info-below-image .qode-pli .qode-pli-text-wrapper .qode-pli-add-to-cart a:hover'
		);

		$first_color = qode_options()->getOptionValue('first_color');
		if(!empty($first_color)) {
			echo qode_dynamic_css($first_color_selector, array('color' => $first_color));
		}

    }

    add_action('qode_style_dynamic', 'qode_woocommerce_styles');
}
