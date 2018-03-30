<?php
namespace Bridge\Shortcodes\MultiDeviceShowcase;

use Bridge\Shortcodes\Lib\ShortcodeInterface;

class MultiDeviceShowcase implements ShortcodeInterface {

    private $base;

    function __construct() {
        $this->base = 'qode_multi_device_showcase';
		add_action('qode_vc_map', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
                'name' => esc_html__('Multi-Device Showcase','qode'),
                'base' => $this->base,
                'icon' => 'icon-wpb-multi-device-showcase extended-custom-icon-qode',
                'category' => esc_html__('by QODE','qode'),
                'params' => array(
                	array(
                		'type' => 'textfield',
                		'heading' => esc_html__( 'Title', 'qode' ),
                		'param_name' => 'title',
                	),
                	array(
                		'type' => 'textfield',
                		'heading' => esc_html__( 'Subtitle', 'qode' ),
                		'param_name' => 'subtitle',
                	),
                	array(
                		'type' => 'dropdown',
                		'heading' => esc_html__('Button Usage', 'qode'),
                		'param_name' => 'button_usage',
                		'value'       => array( 
                			esc_html__('None', 'qode')	=> '',
                			esc_html__('Custom Link', 'qode')	=> 'custom_link',
                			esc_html__('Scroll Below', 'qode')	=> 'scroll_below',
                		),
                	),
                	array(
                	    'type'        => 'textfield',
                	    'heading'     => 'Button Text',
                	    'param_name'  => 'button_text',
                	    'admin_label' => true,
                	    'dependency' => array( 'element' => 'button_usage', 'not_empty' => true )
                	),
                	array(
                	    'type'        => 'textfield',
                	    'heading'     => 'Button Link',
                	    'param_name'  => 'button_link',
                	    'admin_label' => true,
                	    'dependency' => array( 'element' => 'button_usage', 'value' => array('custom_link') )
                	),
                	array(
                	    'type'        => 'dropdown',
                	    'heading'     => 'Link target',
                	    'param_name'  => 'button_link_target',
						'value'      => array_flip( qode_get_link_target_array() ),
                	    'dependency' => array( 'element' => 'button_link', 'not_empty' => true )
                	),
					array(
						'type' => 'param_group',
						'heading' => esc_html__( 'Laptop Slides', 'qode' ),
						'param_name' => 'laptop_slides',
						'params' => array(
							array(
								'type' => 'attach_image',
								'heading' => esc_html__( 'Slide Image', 'qode' ),
								'param_name' => 'slide_image',
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Slide Link', 'qode' ),
								'param_name' => 'slide_link',
							)
						),
						'group' => esc_html__('Laptop Slider', 'qode' )
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__( 'Tablet Slides', 'qode' ),
						'param_name' => 'tablet_slides',
						'params' => array(
							array(
								'type' => 'attach_image',
								'heading' => esc_html__( 'Slide Image', 'qode' ),
								'param_name' => 'slide_image',
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Slide Link', 'qode' ),
								'param_name' => 'slide_link',
							)
						),
						'group' => esc_html__('Tablet Slider', 'qode' )
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__( 'Phone Slides', 'qode' ),
						'param_name' => 'phone_slides',
						'params' => array(
							array(
								'type' => 'attach_image',
								'heading' => esc_html__( 'Slide Image', 'qode' ),
								'param_name' => 'slide_image',
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Slide Link', 'qode' ),
								'param_name' => 'slide_link',
							)
						),
						'group' => esc_html__('Phone Slider', 'qode' )
					),
					array(
						'type' => 'attach_image',
						'heading' => esc_html__( 'Additional Laptop Image', 'qode' ),
						'param_name' => 'additional_laptop_image',
						'group' => esc_html__('Additional Images', 'qode' )
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__( 'Additional Tablet Portrait Images', 'qode' ),
						'param_name' => 'additional_tablet_portrait_images',
						'params' => array(
							array(
								'type' => 'attach_image',
								'heading' => esc_html__( 'Additional Image', 'qode' ),
								'param_name' => 'additional_image',
							),
						),
						'description' => esc_html__( 'Up to 3 additional tablet portrait oriented images supported.', 'qode' ),
						'group' => esc_html__('Additional Images', 'qode' )
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__( 'Additional Tablet Landscape Images', 'qode' ),
						'param_name' => 'additional_tablet_landscape_images',
						'params' => array(
							array(
								'type' => 'attach_image',
								'heading' => esc_html__( 'Additional Image', 'qode' ),
								'param_name' => 'additional_image',
							),
						),
						'description' => esc_html__( 'Up to 2 additional tablet landscape oriented images supported.', 'qode' ),
						'group' => esc_html__('Additional Images', 'qode' )
					),
					array(
						'type' => 'attach_image',
						'heading' => esc_html__( 'Additional Phone Portrait Image', 'qode' ),
						'param_name' => 'additional_phone_portrait_image',
						'group' => esc_html__('Additional Images', 'qode' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Animate On Appear', 'qode'),
						'param_name' => 'animate_on_appear',
						'value'       => array_flip( qode_get_yes_no_select_array( false, true ) ),
                        'admin_label' => true,
						'group' => esc_html__('Layout and Behavior', 'qode' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('One Scroll To Content', 'qode'),
						'param_name' => 'one_scroll_to_content',
						'value'       => array_flip( qode_get_yes_no_select_array( false, true ) ),
						'description' => esc_html__( 'Scroll below Multi-Device Showcase on first scroll.', 'qode' ),
                        'admin_label' => true,
						'group' => esc_html__('Layout and Behavior', 'qode' )
					),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Hide Content Overflow', 'qode'),
                        'param_name' => 'hide_content_overflow',
                        'value'       => array_flip( qode_get_yes_no_select_array( false, true ) ),
                        'admin_label' => true,
                        'group' => esc_html__('Layout and Behavior', 'qode' )
                    ),
                )
            )
        );
    }

    public function render($atts, $content = null) {

        $args = array(
            'title'								=> '',
            'subtitle'							=> '',
            'button_usage'						=> '',
            'button_text'						=> '',
            'button_link'						=> '',
            'button_link_target'				=> '',
            'laptop_slides'						=> '',
            'tablet_slides'						=> '',
            'phone_slides'						=> '',
            'additional_laptop_image'			=> '',
            'additional_tablet_portrait_images'	=> '',
            'additional_tablet_landscape_images'=> '',
            'additional_phone_portrait_image'	=> '',
            'animate_on_appear'					=> 'yes',
            'one_scroll_to_content'             => 'yes',
            'hide_content_overflow'				=> 'yes',
        );

        $params = shortcode_atts($args, $atts);

		extract($params);

		$params['content'] = $content;
		$params['laptop_slides'] = json_decode(urldecode($params['laptop_slides']), true);
		$params['tablet_slides'] = json_decode(urldecode($params['tablet_slides']), true);
		$params['phone_slides'] = json_decode(urldecode($params['phone_slides']), true);
		$params['additional_tablet_portrait_images'] = json_decode(urldecode($params['additional_tablet_portrait_images']), true);
		$params['additional_tablet_landscape_images'] = json_decode(urldecode($params['additional_tablet_landscape_images']), true);
        $params['holder_classes'] = $this->getHolderClasses($params);
		$params['global_slider_data'] = $this->getGlobalSliderData($params);
        $params['button_parameters'] = $this->getButtonParameters($params);

        $html = qode_get_shortcode_template_part('templates/multi-device-showcase-template', 'multi-device-showcase', '', $params);

        return $html;
    }

    /**
     * Returns classes for holder
     */
    private function getHolderClasses($params) {
        $params_array = array();

        if ($params['animate_on_appear'] == 'yes') {
            $params_array[] = 'qode-mds-appear-effect';
        }

        if ($params['one_scroll_to_content'] == 'yes') {
            $params_array[] = 'qode-mds-one-scroll-to-content';
        }

        if ($params['hide_content_overflow'] == 'yes') {
            $params_array[] = 'qode-mds-overflow-hidden';
        }

        if ($params['button_usage'] == 'scroll_below') {
            $params_array[] = 'qode-mds-btn-scroll-below';
        }

        return implode(' ',$params_array);
    }


    /**
     * Returns data for slider
     */
    private function getGlobalSliderData( $params ) {
    	$slider_data = array();
    		
    	$slider_data['data-start-delay'] = 2500;
    	$slider_data['data-slide-interval'] = 1500;

    	return $slider_data;
    }

    /**
     * Returns parameters for button shortcode
     */
    private function getButtonParameters($params) {
        $params_array = array();

        $params_array['text'] = $params['button_text'];
		$params_array['link'] = $params['button_usage'] == 'custom_link' ? $params['button_link'] : '';
		$params_array['target'] = $params['button_usage'] == 'custom_link' ? $params['button_link_target'] : '';

        return $params_array;
    }

}