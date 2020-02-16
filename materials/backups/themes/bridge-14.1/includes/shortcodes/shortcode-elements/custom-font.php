<?php
/* Custom font shortcode */
if (!function_exists('custom_font')) {
    function custom_font($atts, $content = null) {
        $args = array(
            "font_family"       => "",
            "font_size"         => "",
            "line_height"       => "",
            "font_style"        => "",
            "font_weight"       => "",
            "color"             => "",
            "text_decoration"   => "",
            "text_shadow"       => "",
            "letter_spacing"    => "",
            "background_color"  => "",
            "padding"           => "",
            "margin"            => "",
            "border_color"		=> "",
            "border_width"		=> "",
            "text_align"        => "left",
			'type_out_effect'		=> 'no',
			'type_out_position'		=> '',
			'typed_color'			=> '',
			'typed_endings'			=> ''
        );

		$params = shortcode_atts($args, $atts);
        extract($params);

        $html = '';
        $html .= '<div class="custom_font_holder" style="';
        if($font_family != "") {
            $html .= 'font-family: '.$font_family.';';
        }

        if($font_size != "") {
            $html .= ' font-size: '.$font_size.'px;';
        }

        if($line_height != "") {
            $html .= ' line-height: '.$line_height.'px;';
        }

        if($font_style != "") {
            $html .= ' font-style: '.$font_style.';';
        }

        if($font_weight != "") {
            $html .= ' font-weight: '.$font_weight.';';
        }

        if($color != ""){
            $html .= ' color: '.$color.';';
        }

        if($text_decoration != "") {
            $html .= ' text-decoration: '.$text_decoration.';';
        }

        if($text_shadow == "yes") {
            $html .= ' text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);';
        }

        if($letter_spacing != "") {
            $html .= ' letter-spacing: '.$letter_spacing.'px;';
        }

        if($background_color != "") {
            $html .= ' background-color: '.$background_color.';';
        }

        if($padding != "") {
            $html .= ' padding: '.$padding.';';
        }

        if($margin != "") {
            $html .= ' margin: '.$margin.';';
        }

        $border = '';
        if($border_color != '') {
            $border .= 'border: 1px solid '.$border_color.';';

            if($border_width != '') {
                $border .= 'border-width: '.$border_width.'px;';
            }
        } elseif($border_width != '') {
            $border .= 'border: '.$border_width.'px solid;';
        }

        $html .= $border;
        $html .= ' text-align: ' . $text_align . ';';
        $html .= '">' . qode_get_custom_font_modified_title($params, $content) . '</div>';
        return $html;
    }
    add_shortcode('custom_font', 'custom_font');
}
function qode_get_custom_font_modified_title( $params, $content ) {
	$type_out_effect   = $params['type_out_effect'];
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	$type_out_position = str_replace( ' ', '', $params['type_out_position'] );

	if ( ! empty( $content ) && ( $type_out_effect === 'yes' ) ) {
		$split_title = explode( ' ', $content );


		$first_regex = '/<[a-zA-Z]+\d*>/';
		$first_str = $split_title[0];

		preg_match_all($first_regex, $first_str, $matches, PREG_SET_ORDER, 0);

		if(!empty($matches[0][0])) {
			$opened_tag = $matches[0][0];
		} else {
			$opened_tag = '';
		}

		$last_regex = '/<\/[a-zA-Z]+\d*>/';
		$last_str = $split_title[count($split_title) - 1];

		preg_match_all($last_regex, $last_str, $second_matches, PREG_SET_ORDER, 0);
		if(!empty($second_matches[0][0])) {
			$closed_tag = $second_matches[0][0];
		} else {
			$closed_tag = '';
		}
		$split_title[0] = str_replace($opened_tag , '', $split_title[0]);
		$split_title[count($split_title) - 1] = str_replace($closed_tag , '', $split_title[count($split_title) - 1]);

		if ( $type_out_effect === 'yes' && ! empty( $type_out_position ) ) {
			$typed_styles   = qode_get_custom_font_typed_styles( $params );
			$typed_endings = json_decode(urldecode($params['typed_endings']), true);

			$typed_html = '<span class="qode-cf-typed-wrap" ' . qode_get_inline_style( $typed_styles ) . '><span class="qode-cf-typed">';
			if ( is_array($typed_endings) && count($typed_endings) > 0 ) {
				foreach ($typed_endings as $typed_ending){
					$typed_html .= '<span class="qode-cf-typed">' . esc_html( $typed_ending['typed_ending'] ) . '</span>';
				}
			}

			$typed_html .= '</span></span>';

			if ( ! empty( $split_title[ $type_out_position - 1 ] ) ) {
				$split_title[ $type_out_position - 1 ] = $split_title[ $type_out_position - 1 ] . ' ' . $typed_html;
			}
		}

		$title = implode( ' ', $split_title );
		$title = $opened_tag . $title . $closed_tag;
	} else {
		$title = $content;
	}

	return $title;
}

function qode_get_custom_font_typed_styles( $params ) {
	$styles = array();

	if ( ! empty( $params['typed_color'] ) ) {
		$styles[] = 'color: ' . $params['typed_color'];
	}

	return implode( ';', $styles );
}