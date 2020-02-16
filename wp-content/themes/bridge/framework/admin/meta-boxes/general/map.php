<?php
if(!function_exists('qode_map_general_meta_fields')) {

	function qode_map_general_meta_fields() {

		$qodeGeneralScopeArray = apply_filters('qode_general_scope_post_types', array('page', 'post', 'portfolio_page'));
		$qodeGeneral = qode_add_meta_box(
			array(
				'scope' => $qodeGeneralScopeArray,
				'title' => esc_html__('Qode General', 'qode'),
				'name' => 'page_general'
			)
		);

		$qode_page_background_color = new QodeMetaField("color","qode_page_background_color","","Page Background Color","Choose the page background (body) color");
		$qodeGeneral->addChild("qode_page_background_color",$qode_page_background_color);


        qode_add_meta_box_field(
            array(
                'name'          => 'qode_transparent_content_page',
                'type'          => 'selectblank',
                'label'         => esc_html__('Enable Uniform Page Background', 'qode'),
                'description'   => esc_html__('If enabled, content background on this page will be transparent (unless set otherwise) and the background you set here will show.', 'qode'),
                'parent'        => $qodeGeneral,
                'options'       => array(
                    'no' => 'No',
                    'yes' => 'Yes'
                ),
                'args'    => array(
                    'dependence' => true,
                    'hide'       => array(
                        ''       => '#qodef_qode_transparent_content_page_container',
                        'no'     => '#qodef_qode_transparent_content_page_container',
                        'yes'    => ''
                    ),
                    'show'       => array(  
                        ''       => '',
                        'no'     => '',                      
                        'yes'    => '#qodef_qode_transparent_content_page_container',
                    )
                )
            )
        );

        $qode_transparent_content_page_container = qode_add_admin_container(
            array(
                'parent'          => $qodeGeneral,
                'name'            => 'qode_transparent_content_page_container',
                'hidden_property' => 'qode_transparent_content_page',
                'hidden_values'    => array('none', 'no')
            )
        );

        qode_add_meta_box_field(
            array(
                'name'          => 'qode_page_background_image',
                'type'          => 'image',
                'label'         => esc_html__( 'Background Image', 'qode' ),
                'description'   => esc_html__( 'Choose page background image', 'qode' ),
                'parent'        => $qode_transparent_content_page_container
            )
        );

        qode_add_meta_box_field(
            array(
                'name'          => 'qode_page_background_image_fixed',
                'type'          => 'yesno',
                'label'         => esc_html__( 'Fixed Background Image', 'qode' ),
                'default_value' => 'yes',
                'description'   => esc_html__( 'Choose if you want to have fixed background image', 'qode' ),
                'parent'        => $qode_transparent_content_page_container
            )
        );

        qode_add_meta_box_field(
            array(
                'name'          => 'qode_page_background_pattern_image',
                'type'          => 'image',
                'label'         => esc_html__( 'Background Pattern Image', 'qode' ),
                'description'   => esc_html__( 'Choose page background pattern image', 'qode' ),
                'parent'        => $qode_transparent_content_page_container
            )
        );

		qode_add_meta_box_field(
            array(
                'name'          => 'qode_content_grid_lines_meta',
                'type'          => 'select',
                'label'         => esc_html__('Grid Lines in Page Background', 'qode'),
                'description'   => esc_html__('If you would like to enable a set of lines in the page background, choose how many lines you would like to display. The lines will be placed on the page grid.', 'qode'),
                'parent'        => $qodeGeneral,
                'options'       => array(
                    "" => "",
                    "none" => esc_html__("None", 'qode'),
                    "2" => "3 lines",
                    "3" => "4 lines",
                    "4" => "5 lines",
                    "5" => "6 lines",
                    "6" => "7 lines"
                ),
                'args'    => array(
                    'dependence' => true,
                    'hide'       => array(
                        ''    => '#qodef_lines_container_meta',
                        'none'  => '#qodef_lines_container_meta',
                        '2' => '',
                        '3' => '',
                        '4' => '',
                        '5' => '',
                        '6' => ''
                    ),
                    'show'       => array(
                        ''    => '',
                        'none'  => '',
                        '2' => '#qodef_lines_container_meta',
                        '3' => '#qodef_lines_container_meta',
                        '4' => '#qodef_lines_container_meta',
                        '5' => '#qodef_lines_container_meta',
                        '6' => '#qodef_lines_container_meta'
                    )
                )
            )
        );

        $lines_container_meta = qode_add_admin_container(
            array(
                'parent'          => $qodeGeneral,
                'name'            => 'lines_container_meta',
                'hidden_property' => 'qode_content_grid_lines_meta',
                'hidden_values'   => array(
                    '',
                    'none'
                )
            )
        );

        qode_add_meta_box_field(
            array(
                'name'          => 'qode_content_grid_lines_skin_meta',
                'type'          => 'select',
                'label'         => esc_html__( 'Grid Lines Skin', 'qode' ),
                'description'   => esc_html__( 'Choose skin for background grid lines', 'qode' ),
                'parent'        => $lines_container_meta,
                'options'       => array(
                    ''      => '',
                    'light'  => esc_html__( 'Light', 'qode' ),
                    'dark' => esc_html__( 'Dark', 'qode' )
                )
            )
        );


		$qode_show_animation = new QodeMetaField("selectblank", "qode_show-animation", "", "Page Transition", 'Choose a type of transition between loading pages.', array(
			"no_animation" => "No Animation",
			"updown" => "Up / Down",
			"fade" => "Fade",
			"updown_fade" => "Up/Down (In) / Fade (Out)",
			"leftright" => "Left / Right"
		), array(), "enable_grid_elements", array("yes"));
		$qodeGeneral->addChild("qode_show-animation", $qode_show_animation);

		$page_transitions_notice = new QodeNotice("Page Transition",'Choose a a type of transition between loading pages. In order for animation to work properly, you must choose "Post name" in permalinks settings', "AJAX Page transitions are disabled due to VC Grid Elements", "enable_grid_elements","no");
		$qodeGeneral->addChild("page_transitions_notice",$page_transitions_notice);

		$qode_revolution_slider = new QodeMetaField("text","qode_revolution-slider","","Layer Slider or Qode Slider Shortcode","Copy and paste your shortcode located in Qode Slider -> Slider");
		$qodeGeneral->addChild("qode_revolution-slider",$qode_revolution_slider);

		$qode_enable_content_top_margin = new QodeMetaField("selectblank","qode_enable_content_top_margin","","Always put content below header","Enabling this option always will put content below header", array(
			"no" => "No",
			"yes" => "Yes",
		));
		$qodeGeneral->addChild("qode_enable_content_top_margin",$qode_enable_content_top_margin);


	}

	add_action('qode_meta_boxes_map', 'qode_map_general_meta_fields');
}