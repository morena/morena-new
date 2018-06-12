<?php
if(!function_exists('qode_map_footer_meta_fields')) {

	function qode_map_footer_meta_fields() {

		$qodeFooter = qode_add_meta_box(
			array(
				'scope' => array('page', 'portfolio_page', 'post'),
				'title' => esc_html__('Qode Footer', 'qode'),
				'name' => 'page_footer'
			)
		);

		qode_add_meta_box_field(
            array(
                'name'          => 'footer_top_per_page',
                'type'          => 'selectblank',
                'label'         => esc_html__('Show footer top', 'qode'),
                'description'   => esc_html__('Enabling this option will show footer top on this page', 'qode'),
                'parent'        => $qodeFooter,
                'options'       => array(
                    'no' => 'No',
                    'yes' => 'Yes'
                )
            )
        );

        qode_add_meta_box_field(
            array(
                'name'          => 'footer_bottom_per_page',
                'type'          => 'selectblank',
                'label'         => esc_html__('Show footer bottom', 'qode'),
                'description'   => esc_html__('Enabling this option will show footer bottom on this page', 'qode'),
                'parent'        => $qodeFooter,
                'options'       => array(
                    'no' => 'No',
                    'yes' => 'Yes'
                )
            )
        );

	}

	add_action('qode_meta_boxes_map', 'qode_map_footer_meta_fields');
}