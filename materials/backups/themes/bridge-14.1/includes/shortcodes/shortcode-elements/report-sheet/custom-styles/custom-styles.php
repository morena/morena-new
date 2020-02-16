<?php

if(!function_exists('qode_report_sheet_styles')) {

    function qode_report_sheet_styles() {

		$border_selector = '.qode-report-sheet .qode-rs-table .qode-rs-table-content .qode-rs-table-row, .qode-report-sheet .qode-rs-table .qode-rs-table-header';

        $border_color = qode_options()->getOptionValue('report_sheet_border_color');
        if(!empty($border_color)) {
			echo qode_dynamic_css($border_selector, array('border-color' => $border_color));
        }

        $report_sheet_header_bckg_color = qode_options()->getOptionValue('rs_header_bckg_color');
		if(!empty($report_sheet_header_bckg_color)) {
			echo qode_dynamic_css('.qode-report-sheet .qode-rs-table .qode-rs-table-header', array('background-color' => $report_sheet_header_bckg_color));
		}

		$report_sheet_odd_bckg_color = qode_options()->getOptionValue('rs_odd_bckg_color');
		if(!empty($report_sheet_odd_bckg_color)) {
			echo qode_dynamic_css('.qode-report-sheet .qode-rs-table .qode-rs-table-row:nth-child(odd)', array('background-color' => $report_sheet_odd_bckg_color));
		}

		$report_sheet_even_bckg_color = qode_options()->getOptionValue('rs_even_bckg_color');
		if(!empty($report_sheet_even_bckg_color)) {
			echo qode_dynamic_css('.qode-report-sheet .qode-rs-table .qode-rs-table-row:nth-child(even)', array('background-color' => $report_sheet_even_bckg_color));
		}

		$rs_button_style = array();

		$report_sheet_btn_font_family = qode_options()->getOptionValue('rs_btn_font_family');
		if(qode_is_font_option_valid($report_sheet_btn_font_family)) {
			$rs_button_style['font-family'] = qode_get_font_option_val($report_sheet_btn_font_family);
		}

		$report_sheet_btn_font_size = qode_options()->getOptionValue('report_sheet_btn_font_size');
		if(!empty($report_sheet_btn_font_size)) {
			$rs_button_style['font-size'] = $report_sheet_btn_font_size.'px';
		}

		$report_sheet_btn_font_weight = qode_options()->getOptionValue('rs_btn_font_weight');
		if(!empty($report_sheet_btn_font_weight)) {
			$rs_button_style['font-weight'] = $report_sheet_btn_font_weight;
		}

		$report_sheet_btn_font_style = qode_options()->getOptionValue('rs_btn_font_style');
		if(!empty($report_sheet_btn_font_style)) {
			$rs_button_style['font-style'] = $report_sheet_btn_font_style;
		}

		$report_sheet_btn_text_transform = qode_options()->getOptionValue('rs_btn_text_transform');
		if(!empty($report_sheet_btn_text_transform)) {
			$rs_button_style['text-transform'] = $report_sheet_btn_text_transform;
		}

		$report_sheet_btn_letter_spacing = qode_options()->getOptionValue('rs_table_btn_letter_spacing');
		if($report_sheet_btn_letter_spacing != '') {
			$rs_button_style['letter-spacing'] = $report_sheet_btn_letter_spacing.'px';
		}

		$report_sheet_table_btn_color = qode_options()->getOptionValue('rs_btn_color');
		if(!empty($report_sheet_table_btn_color)) {
			$rs_button_style['color'] = $report_sheet_table_btn_color;
		}

		echo qode_dynamic_css('.qode-report-sheet .qode-rs-button-holder a', $rs_button_style);

		$report_sheet_btn_hover_color = qode_options()->getOptionValue('rs_btn_hover_color');
		if(!empty($report_sheet_btn_hover_color)) {
			echo qode_dynamic_css('.qode-report-sheet .qode-rs-button-holder a:hover', array('color' => $report_sheet_btn_hover_color));
		}

    }

    add_action('qode_style_dynamic', 'qode_report_sheet_styles');
}
