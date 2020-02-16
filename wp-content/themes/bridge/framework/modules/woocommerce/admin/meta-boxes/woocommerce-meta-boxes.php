<?php

if(!function_exists('qode_map_woocommerce_meta')) {
    function qode_map_woocommerce_meta() {
        $woocommerce_meta_box = qode_add_meta_box(
            array(
                'scope' => array('product'),
                'title' => esc_html__('Qode General', 'qode'),
                'name' => 'product_general'
            )
        );

		qode_add_meta_box_field(array(
			'name'        => 'qode_product_list_masonry_layout',
			'type'        => 'selectblank',
			'label'       => esc_html__('Dimensions for Product List - Masonry', 'qode'),
			'description' => esc_html__('Choose image layout when it appears in Qode Product List - Masonry shortcode', 'qode'),
			'parent'      => $woocommerce_meta_box,
			'options'     => array(
				"default" => "Default",
				"large-width-height" => "Large Width"
			)
		));

		qode_add_meta_box_field(array(
			'name'        => 'qode_product_featured_image_size',
			'type'        => 'select',
			'label'       => esc_html__('Dimensions for Product List Shortcode', 'qode'),
			'description' => esc_html__('Choose image layout when it appears in Product List - Masonry layout shortcode', 'qode'),
			'parent'      => $woocommerce_meta_box,
			'options'     => array(
				'qode-woo-image-normal-width'		 => esc_html__('Default', 'qode'),
				'qode-woo-image-large-width'        => esc_html__('Large width', 'qode'),
				'qode-woo-image-large-height'       => esc_html__('Large height', 'qode'),
				'qode-woo-image-large-width-height' => esc_html__('Large width/height', 'qode'),
			)
		));


    }
	
    add_action('qode_meta_boxes_map', 'qode_map_woocommerce_meta', 99);
}