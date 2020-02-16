<?php

if(!function_exists('qode_testimonial_carousel_map')) {
    function qode_testimonial_carousel_map() {

		$panel = qode_add_admin_panel(array(
            'title' => esc_html__('Testimonial Carousel', 'qode'),
            'name'  => 'panel_testimonial_carousel',
            'page'  => 'elementsPage'
        ));


        $style_group = qode_add_admin_group(array(
            'name'			=> 'style_group',
            'title'			=> esc_html__('Testimonials Carousel Style', 'qode'),
            'description'	=> esc_html__('Define Testimonials Carousel style', 'qode'),
            'parent'		=> $panel
        ));

        $style_row = qode_add_admin_row(array(
            'name' => 'style_row',
            'next' => true,
            'parent' => $style_group
        ));

		qode_add_admin_field(array(
			'parent'        => $style_row,
			'type'          => 'textsimple',
			'name'          => 'testimonial_carousel_border_radius',
			'default_value' => '',
			'label'         => esc_html__('Navigation Border radius (px)', 'qode'),
			'description'   => ''
		));

		$background_group = qode_add_admin_group(array(
            'name'			=> 'background_group',
            'title'			=> esc_html__('Testimonials Carousel Background Color', 'qode'),
            'description'	=> esc_html__('Set up Testimonials Carousel background color', 'qode'),
            'parent'		=> $panel
        ));

        $background_row = qode_add_admin_row(array(
            'name' => 'background_row',
            'next' => true,
            'parent' => $background_group
        ));

        qode_add_admin_field(array(
			'parent'        => $background_row,
			'type'          => 'colorsimple',
			'name'          => 'testimonial_carousel_background_color',
			'label'         => esc_html__('Choose Background Color', 'qode'),
			'description'   => ''
		));

        $text_group = qode_add_admin_group(array(
            'name'			=> 'text_group',
            'title'			=> esc_html__('Testimonials Carousel Text Style', 'qode'),
            'description'	=> esc_html__('Define Testimonials Carousel text style', 'qode'),
            'parent'		=> $panel
        ));

        $text_row_1 = qode_add_admin_row(array(
            'name' => 'text_row_1',
            'next' => true,
            'parent' => $text_group
        ));

        qode_add_admin_field(array(
			'parent'        => $text_row_1,
			'type'          => 'colorsimple',
			'name'          => 'tc_text_color',
			'default_value' => '',
			'label'         => esc_html__('Text Color', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $text_row_1,
			'type'          => 'textsimple',
			'name'          => 'tc_text_font_size',
			'default_value' => '',
			'label'         => esc_html__('Font Size', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $text_row_1,
			'type'          => 'textsimple',
			'name'          => 'tc_text_line_height',
			'default_value' => '',
			'label'         => esc_html__('Line Height', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $text_row_1,
			'type'          => 'selectblanksimple',
			'name'          => 'tc_text_transform',
			'options'		=> qode_get_text_transform_array(),
			'default_value' => '',
			'label'         => esc_html__('Text Transform', 'qode')
		));

		$text_row_2 = qode_add_admin_row(array(
            'name' => 'text_row_2',
            'next' => true,
            'parent' => $text_group
        ));

        qode_add_admin_field(array(
			'parent'        => $text_row_2,
			'type'          => 'fontsimple',
			'name'          => 'tc_text_font_family',
			'default_value' => '',
			'label'         => esc_html__('Font Family', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $text_row_2,
			'type'          => 'selectblanksimple',
			'name'          => 'tc_text_font_style',
			'options'		=> qode_get_font_style_array(),
			'default_value' => '',
			'label'         => esc_html__('Font Style', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $text_row_2,
			'type'          => 'selectblanksimple',
			'name'          => 'tc_text_font_weight',
			'default_value' => '',
			'options'		=> qode_get_font_weight_array(),
			'label'         => esc_html__('Font Weight', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $text_row_2,
			'type'          => 'textsimple',
			'name'          => 'tc_text_letter_spacing',
			'default_value' => '',
			'label'         => esc_html__('Letter Spacing', 'qode')
		));

		$author_group = qode_add_admin_group(array(
            'name'			=> 'author_group',
            'title'			=> esc_html__('Testimonials Carousel Author Style', 'qode'),
            'description'	=> esc_html__('Define Testimonials Carousel author style', 'qode'),
            'parent'		=> $panel
        ));

        $author_row_1 = qode_add_admin_row(array(
            'name' => 'author_row_1',
            'next' => true,
            'parent' => $author_group
        ));

        qode_add_admin_field(array(
			'parent'        => $author_row_1,
			'type'          => 'colorsimple',
			'name'          => 'tc_author_color',
			'default_value' => '',
			'label'         => esc_html__('Text Color', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $author_row_1,
			'type'          => 'textsimple',
			'name'          => 'tc_author_font_size',
			'default_value' => '',
			'label'         => esc_html__('Font Size', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $author_row_1,
			'type'          => 'textsimple',
			'name'          => 'tc_author_line_height',
			'default_value' => '',
			'label'         => esc_html__('Line Height', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $author_row_1,
			'type'          => 'selectblanksimple',
			'name'          => 'tc_author_transform',
			'options'		=> qode_get_text_transform_array(),
			'default_value' => '',
			'label'         => esc_html__('Text Transform', 'qode')
		));

		$author_row_2 = qode_add_admin_row(array(
            'name' => 'text_row_2',
            'next' => true,
            'parent' => $author_group
        ));

        qode_add_admin_field(array(
			'parent'        => $author_row_2,
			'type'          => 'fontsimple',
			'name'          => 'tc_author_font_family',
			'default_value' => '',
			'label'         => esc_html__('Font Family', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $author_row_2,
			'type'          => 'selectblanksimple',
			'name'          => 'tc_author_font_style',
			'options'		=> qode_get_font_style_array(),
			'default_value' => '',
			'label'         => esc_html__('Font Style', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $author_row_2,
			'type'          => 'selectblanksimple',
			'name'          => 'tc_author_font_weight',
			'default_value' => '',
			'options'		=> qode_get_font_weight_array(),
			'label'         => esc_html__('Font Weight', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $author_row_2,
			'type'          => 'textsimple',
			'name'          => 'tc_author_letter_spacing',
			'default_value' => '',
			'label'         => esc_html__('Letter Spacing', 'qode')
		));
		
	}

    add_action('qode_options_elements_page_map', 'qode_testimonial_carousel_map');
}