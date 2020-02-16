<?php

if(!function_exists('qode_video_box_map')) {
    function qode_video_box_map() {

		$panel = qode_add_admin_panel(array(
            'title' => esc_html__('Video Box', 'qode'),
            'name'  => 'panel_video_box',
            'page'  => 'elementsPage'
        ));


        $color_group = qode_add_admin_group(array(
            'name'			=> 'color_group',
            'title'			=> esc_html__('Play Button Color Options', 'qode'),
            'description'	=> esc_html__('Setup colors for play button', 'qode'),
            'parent'		=> $panel
        ));

        $color_row = qode_add_admin_row(array(
            'name' => 'color_row',
            'next' => true,
            'parent' => $color_group
        ));

		qode_add_admin_field(array(
			'parent'        => $color_row,
			'type'          => 'colorsimple',
			'name'          => 'video_box_circle_color',
			'default_value' => '',
			'label'         => esc_html__('Circle Color', 'qode'),
			'description'   => ''
		));

        qode_add_admin_field(array(
            'parent'        => $color_row,
            'type'          => 'colorsimple',
            'name'          => 'video_box_circle_hover_color',
            'default_value' => '',
            'label'         => esc_html__('Circle Hover Color', 'qode')
        ));

        qode_add_admin_field(array(
            'parent'        => $color_row,
            'type'          => 'colorsimple',
            'name'          => 'video_box_icon_color',
            'default_value' => '',
            'label'         => esc_html__('Icon Color', 'qode')
        ));

        qode_add_admin_field(array(
            'parent'        => $color_row,
            'type'          => 'colorsimple',
            'name'          => 'video_box_icon_hover_color',
            'default_value' => '',
            'label'         => esc_html__('Icon Hover Color', 'qode')
        ));

        $border_group = qode_add_admin_group(array(
            'name'          => 'border_group',
            'title'         => esc_html__('Play Button Border Options', 'qode'),
            'description'   => esc_html__('Setup settings for play button border', 'qode'),
            'parent'        => $panel
        ));

        $border_row = qode_add_admin_row(array(
            'name' => 'border_row',
            'next' => true,
            'parent' => $border_group
        ));

        qode_add_admin_field(array(
            'parent'        => $border_row,
            'type'          => 'textsimple',
            'name'          => 'video_box_border_width',
            'default_value' => '',
            'label'         => esc_html__('Border Width', 'qode'),
            'description'   => ''
        ));

        qode_add_admin_field(array(
            'parent'        => $border_row,
            'type'          => 'colorsimple',
            'name'          => 'video_box_border_color',
            'default_value' => '',
            'label'         => esc_html__('Border Initial Color', 'qode'),
            'description'   => ''
        ));

        qode_add_admin_field(array(
            'parent'        => $border_row,
            'type'          => 'colorsimple',
            'name'          => 'video_box_border_hover_color',
            'default_value' => '',
            'label'         => esc_html__('Border Hover Color', 'qode'),
            'description'   => ''
        ));

        $size_group = qode_add_admin_group(array(
            'name'          => 'size_group',
            'title'         => esc_html__('Play Button Size Options', 'qode'),
            'description'   => esc_html__('Setup size for play button border', 'qode'),
            'parent'        => $panel
        ));

        $size_row = qode_add_admin_row(array(
            'name' => 'size_row',
            'next' => true,
            'parent' => $size_group
        ));

        qode_add_admin_field(array(
            'parent'        => $size_row,
            'type'          => 'textsimple',
            'name'          => 'video_box_height_width',
            'default_value' => '',
            'label'         => esc_html__('Play Button Height/Width', 'qode'),
            'description'   => ''
        ));
	}

    add_action('qode_options_elements_page_map', 'qode_video_box_map');
}