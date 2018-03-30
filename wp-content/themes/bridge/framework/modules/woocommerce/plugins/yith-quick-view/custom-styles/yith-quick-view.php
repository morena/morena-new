<?php

if(!function_exists('qode_yith_quickview_styles')) {

    function qode_yith_quickview_styles() {
		$first_color_selector = array(
			'#yith-quick-view-modal #yith-quick-view-content .summary .qode-single-product-share-wish .yith-wcwl-wishlistexistsbrowse a:after',
			'#yith-quick-view-modal #yith-quick-view-content .summary .qode-single-product-share-wish .yith-wcwl-wishlistaddedbrowse a:after',
			'.yith-quick-view.yith-modal #yith-quick-view-content .summary .qode-single-product-share-wish .yith-wcwl-wishlistexistsbrowse a:after',
			'.yith-quick-view.yith-modal #yith-quick-view-content .summary .qode-single-product-share-wish .yith-wcwl-wishlistaddedbrowse a:after',
			'#yith-quick-view-modal #yith-quick-view-content .summary .social_share_list_holder > span',
			'.yith-quick-view.yith-modal #yith-quick-view-content .summary .social_share_list_holder > span',
			'#yith-quick-view-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a',
			'#yith-quick-view-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a',
			'#yith-quick-view-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a',
			'.yith-quick-view.yith-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a',
			'.yith-quick-view.yith-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a',
			'.yith-quick-view.yith-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a',
			'#yith-quick-view-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a:after',
			'#yith-quick-view-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a:after',
			'#yith-quick-view-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a:after',
			'.yith-quick-view.yith-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a:after',
			'.yith-quick-view.yith-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a:after',
			'.yith-quick-view.yith-modal #yith-quick-view-content .summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a:after'
		);

		$first_color = qode_options()->getOptionValue('first_color');
		if(!empty($first_color)) {
			echo qode_dynamic_css($first_color_selector, array('color' => $first_color));
		}

    }

    add_action('qode_style_dynamic', 'qode_yith_quickview_styles');
}
