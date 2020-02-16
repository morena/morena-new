<?php
namespace Bridge\Shortcodes\EllipticalSlider;

use Bridge\Shortcodes\Lib\ShortcodeInterface;

class EllipticalSlider implements ShortcodeInterface {

    private $base;

    function __construct() {
        $this->base = 'qode_elliptical_slider';
		add_action('qode_vc_map', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
                'name' => esc_html__('Elliptical Slider','qode'),
                'base' => $this->base,
                'icon' => 'extended-custom-icon-qode icon-wpb-elliptical-slider',
                'category' => esc_html__('by QODE','qode'),
                'as_parent' => array('only' => 'qode_elliptical_slide'),
				'content_element'	=> true,
                'js_view' => 'VcColumnView',
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Animation speed','qode'),
                        'admin_label' => true,
                        'param_name' => 'animation_speed',
                        'value' => '',
                        'description' => esc_html__('Speed of slide animation in miliseconds','qode')
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Autoplay','qode'),
                        'admin_label' => true,
                        'param_name' => 'autoplay',
                        'value' => array(
                            'No' => 'no',
                            'Yes' => 'yes'
                        ),
                        'description' => esc_html__('Enable this option if you want to have autoplay Elliptical Slider ','qode')
                    )
                )
            )
        );
    }

    public function render($atts, $content = null) {

        $args = array(
            'animation_speed' => '',
            'autoplay'        => 'no'  
        );

        $params = shortcode_atts($args, $atts);
        extract($params);

        $html = '';
        $html .= '<div class="qode-elliptical-slider">';
        $html .= '<div class="qode-elliptical-slider-slides"';
        if(!empty($animation_speed)){
            $html .= ' data-animation-speed = ' . $animation_speed;
        }

        $html .= ' data-autoplay = ' . $autoplay . '>';
        	$html .= do_shortcode($content);
        $html.= '</div>';
        $html.= '</div>';

        return $html;
    }
    
}