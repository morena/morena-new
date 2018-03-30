<?php
namespace Bridge\Shortcodes\InterestRateCalculator;

use Bridge\Shortcodes\Lib\ShortcodeInterface;

class InterestRateCalculator implements ShortcodeInterface {

    private $base;

    function __construct() {
        $this->base = 'qode_interest_rate_calculator';
		add_action('qode_vc_map', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
                'name' => esc_html__('Interest Rate Calculator','qode'),
                'base' => $this->base,
                'icon' => 'icon-wpb-interest-rate-calculator extended-custom-icon-qode',
                'category' => esc_html__('by QODE','qode'),
                'params' => array(
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Interest Rate Title','qode'),
						'param_name'	=> 'irt_title'
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__('Interest Rate Title Tag','qode'),
						'param_name'	=> 'irt_title_tag',
						'value' => array(
							''   => '',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
						),
						'dependency' => array('element' => 'irt_title', 'not_empty' => true)
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Interest Rate','qode'),
						'description'	=> esc_html__('Insert interest rate in percents','qode'),
						'param_name'	=> 'irt_rate'
					),
					array(
						'type'	=> 'textfield',
						'heading' => esc_html__('Loan Minimum Value','qode'),
						'param_name'	=> 'irt_loan_min_value',
						'description'	=> esc_html__('Please insert minimum value for the loan slider','qode')
					),
					array(
						'type'	=> 'textfield',
						'heading' => esc_html__('Loan Maximum Value','qode'),
						'param_name'	=> 'irt_loan_max_value',
						'description'	=> esc_html__('Please insert maximum value for the loan slider','qode')
					),
					array(
						'type'	=> 'textfield',
						'heading' => esc_html__('Loan Slider Step','qode'),
						'param_name'	=> 'irt_loan_step'
					),
					array(
						'type'	=> 'textfield',
						'heading' => esc_html__('Minimum Loan Period','qode'),
						'param_name'	=> 'irt_loan_min_period',
						'description'	=> esc_html__('Please insert minimum value for the period slider, other than 0','qode')
					),
					array(
						'type'	=> 'textfield',
						'heading' => esc_html__('Maximum Loan Period','qode'),
						'param_name'	=> 'irt_loan_max_period',
						'description'	=> esc_html__('Please insert maximum value for the period slider','qode')
					),
					array(
						'type'	=> 'textfield',
						'heading' => esc_html__('Period Slider Step','qode'),
						'param_name'	=> 'irt_period_step'
					),
					array(
						'type'	=> 'textfield',
						'heading' => esc_html__('Currency','qode'),
						'param_name'	=> 'irt_currency'
					),
					array(
						'type'	=> 'textfield',
						'heading' => esc_html__('Period label','qode'),
						'param_name'	=> 'irt_period_label'
					),
					array(
						'type'	=> 'dropdown',
						'heading' => esc_html__('Enable Button','qode'),
						'param_name'	=> 'irt_button',
						'value'	=> array(
							esc_html__('No','qode')	=> 'no',
							esc_html__('Yes','qode')	=> 'yes'
						)
					),
					array(
						'type'	=> 'textfield',
						'heading' => esc_html__('Button Text','qode'),
						'param_name'	=> 'irt_button_text',
						'dependency' => array('element' => 'irt_button', 'value' => 'yes')
					),
					array(
						'type'	=> 'textfield',
						'heading' => esc_html__('Button Link','qode'),
						'param_name'	=> 'irt_button_link',
						'dependency' => array('element' => 'irt_button', 'value' => 'yes')
					),
					array(
						'type'	=> 'dropdown',
						'heading' => esc_html__('Button Target','qode'),
						'param_name'	=> 'irt_button_target',
						'value'	=> array(
							''		=> '',
							'Blank'	=> '_blank',
							'Self'	=> '_self'
						),
						'dependency' => array('element' => 'irt_button', 'value' => 'yes')
					),
					array(
						'type'	=> 'colorpicker',
						'heading'	=> esc_html__('Background Color','qode'),
						'param_name'	=> 'irt_background_color',
						'group'	=> 'Style'
					),
					array(
						'type'	=> 'colorpicker',
						'heading'	=> esc_html__('Active Color','qode'),
						'param_name'	=> 'irt_active_color',
						'group'	=> 'Style',
						'description'	=> esc_html__('Choose color of the current value, current period and sliders')
					),
					array(
						'type'	=> 'colorpicker',
						'heading'	=> esc_html__('Loan and Period Values Color','qode'),
						'param_name'	=> 'irt_values_color',
						'group'	=> 'Style'
					),
					array(
						'type'	=> 'textfield',
						'heading'	=> esc_html__('Loan and Period Values Font Size','qode'),
						'param_name'	=> 'irt_values_font',
						'group'	=> 'Style'
					),
					array(
						'type'	=> 'colorpicker',
						'heading'	=> esc_html__('Labels Color','qode'),
						'param_name'	=> 'irt_labels_color',
						'group'	=> 'Style'
					),
					array(
						'type'	=> 'textfield',
						'heading'	=> esc_html__('Labels Font Size','qode'),
						'param_name'	=> 'irt_labels_font',
						'group'	=> 'Style'
					),
					array(
						'type'	=> 'colorpicker',
						'heading'	=> esc_html__('Labels Separator Color','qode'),
						'param_name'	=> 'irt_labels_border_color',
						'group'	=> 'Style'
					),
					array(
						'type'	=> 'colorpicker',
						'heading'	=> esc_html__('Results Color','qode'),
						'param_name'	=> 'irt_results_color',
						'group'	=> 'Style'
					),
					array(
						'type'	=> 'textfield',
						'heading'	=> esc_html__('Results Font Size','qode'),
						'param_name'	=> 'irt_results_font',
						'group'	=> 'Style'
					),
                )
            )
        );
    }

    public function render($atts, $content = null) {

        $args = array(
            'irt_title'	=> '',
            'irt_title_tag'	=> 'h3',
            'irt_rate'	=> '',
            'irt_loan_min_value'	=> '1',
            'irt_loan_max_value'	=> '1000',
            'irt_loan_step'			=> '1',
            'irt_loan_min_period'	=> '1',
            'irt_loan_max_period'	=> '12',
            'irt_period_step'		=> '1',
            'irt_currency'			=> '',
            'irt_period_label'		=> '',
            'irt_button'			=> '',
            'irt_button_text'		=> '',
            'irt_button_link'		=> '',
            'irt_button_target'		=> '',
            'irt_background_color'	=> '',
            'irt_active_color'		=> '',
            'irt_values_color'		=> '',
            'irt_values_font'		=> '',
            'irt_labels_color'		=> '',
            'irt_labels_font'		=> '',
            'irt_labels_border_color'	=> '',
            'irt_results_color'		=> '',
            'irt_results_font'		=> ''
        );

        $params = shortcode_atts($args, $atts);

        $params['irc_data'] = $this->getIrcDataAttr($params);
        $params['irc_active_color'] = $this->getIrcActiveColor($params);
        $params['irc_active_slider'] = $this->getIrcActiveSlider($params);
        $params['irt_background_color'] = $this->getIrcBackgroundStyle($params);
        $params['irc_values_style'] = $this->getIrcValuesStyle($params);
        $params['irc_labels_style'] = $this->getIrcLabelsStyle($params);
        $params['irc_labels_border_style'] = $this->getIrcLabelsBorderStyle($params);
        $params['irc_results_style'] = $this->getIrcResultsStyle($params);

		extract($params);

        $html = qode_get_shortcode_template_part('templates/interest-rate-calculator-template', 'interest-rate-calculator', '', $params);

        return $html;
    }

    private function getIrcDataAttr($params){
    	$data = array();

		if(!empty($params['irt_rate'])) {
			$data['data-rate'] = $params['irt_rate'];
		}

		if(!empty($params['irt_active_color'])){
    		$data['data-active-color'] = $params['irt_active_color'];
    	}

		return $data;
    }

    private function getIrcActiveColor($params){
    	$styles = array();

    	if(!empty($params['irt_active_color'])){
    		$styles[] = 'color: '.$params['irt_active_color'];
    	}

    	return $styles;
    }

    private function getIrcActiveSlider($params){
    	$styles = array();

    	if(!empty($params['irt_active_color'])){
    		$styles[] = 'background-color: '.$params['irt_active_color'];
    	}

    	return $styles;
    }

    private function getIrcBackgroundStyle($params){
    	$styles = array();

    	if(!empty($params['irt_background_color'])){
    		$styles[] = 'background-color: '.$params['irt_background_color'];
    	}

    	return $styles;
    }

    private function getIrcValuesStyle($params){
    	$styles = array();

    	if(!empty($params['irt_values_color'])){
    		$styles[] = 'color: '.$params['irt_values_color'];
    	}

    	if(!empty($params['irt_values_font'])){
    		$styles[] = 'font-size: '.$params['irt_values_font'].'px';
    	}

    	return $styles;
    }

    private function getIrcLabelsStyle($params){
    	$styles = array();

    	if(!empty($params['irt_labels_color'])){
    		$styles[] = 'color: '.$params['irt_labels_color'];
    	}

    	if(!empty($params['irt_labels_font'])){
    		$styles[] = 'font-size: '.$params['irt_labels_font'].'px';
    	}

    	return $styles;
    }

    private function getIrcResultsStyle($params){
    	$styles = array();

    	if(!empty($params['irt_results_color'])){
    		$styles[] = 'color: '.$params['irt_results_color'];
    	}

    	if(!empty($params['irt_results_font'])){
    		$styles[] = 'font-size: '.$params['irt_results_font'].'px';
    	}

    	return $styles;
    }

    private function getIrcLabelsBorderStyle($params){
    	$styles = array();

    	if(!empty($params['irt_labels_border_color'])){
    		$styles[] = 'border-bottom-color: '.$params['irt_labels_border_color'];
    	}

    	return $styles;
    }


}