<?php

if(!function_exists('qode_breadcrumbs_map')) {
    function qode_breadcrumbs_map() {

		$panel = qode_add_admin_panel(array(
            'title' => esc_html__('Breadcrumbs', 'qode'),
            'name'  => 'panel_breadcrumbs',
            'page'  => 'fonts'
        ));

        $text_group = qode_add_admin_group(array(
            'name'			=> 'text_group',
            'title'			=> esc_html__('Breadcrumbs style', 'qode'),
            'description'	=> esc_html__('Define breadcrumbs style', 'qode'),
            'parent'		=> $panel
        ));

        $text_row_1 = qode_add_admin_row(array(
            'name' => 'text_row_1',
            'next' => true,
            'parent' => $text_group
        ));

		qode_add_admin_field(array(
			'parent'        => $text_row_1,
			'type'          => 'textsimple',
			'name'          => 'breadcrumbs_font_size',
			'default_value' => '',
			'label'         => esc_html__('Font Size', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $text_row_1,
			'type'          => 'textsimple',
			'name'          => 'breadcrumbs_line_height',
			'default_value' => '',
			'label'         => esc_html__('Line Height', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $text_row_1,
			'type'          => 'selectblanksimple',
			'name'          => 'breadcrumbs_transform',
			'options'		=> qode_get_text_transform_array(),
			'default_value' => '',
			'label'         => esc_html__('Text Transform', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $text_row_1,
			'type'          => 'fontsimple',
			'name'          => 'breadcrumbs_font_family',
			'default_value' => '',
			'label'         => esc_html__('Font Family', 'qode')
		));

		$text_row_2 = qode_add_admin_row(array(
            'name' => 'text_row_2',
            'next' => true,
            'parent' => $text_group
        ));

        
		qode_add_admin_field(array(
			'parent'        => $text_row_2,
			'type'          => 'selectblanksimple',
			'name'          => 'breadcrumbs_font_style',
			'options'		=> qode_get_font_style_array(),
			'default_value' => '',
			'label'         => esc_html__('Font Style', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $text_row_2,
			'type'          => 'selectblanksimple',
			'name'          => 'breadcrumbs_font_weight',
			'default_value' => '',
			'options'		=> qode_get_font_weight_array(),
			'label'         => esc_html__('Font Weight', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $text_row_2,
			'type'          => 'textsimple',
			'name'          => 'breadcrumbs_letter_spacing',
			'default_value' => '',
			'label'         => esc_html__('Letter Spacing', 'qode')
		));

		/*$delimiter_group = qode_add_admin_group(array(
            'name'			=> 'delimiter_group',
            'title'			=> esc_html__('Breadcrumbs delimiter', 'qode'),
            'description'	=> esc_html__('Insert desired breadcrumbs delimiter', 'qode'),
            'parent'		=> $panel
        ));

        $delimiter_row = qode_add_admin_row(array(
            'name' => 'delimiter_row',
            'next' => true,
            'parent' => $delimiter_group
        ));*/

		qode_add_admin_field(array(
			'parent'        => $panel,
			'type'          => 'text',
			'name'          => 'breadcrumbs_delimiter_sign',
			'default_value' => '',
			'label'			=> esc_html__('Breadcrumbs delimiter', 'qode'),
			'description'   => esc_html__('Insert desired breadcrumbs delimiter', 'qode')
		));
		
	}

    add_action('qode_options_elements_page_map', 'qode_breadcrumbs_map');
}