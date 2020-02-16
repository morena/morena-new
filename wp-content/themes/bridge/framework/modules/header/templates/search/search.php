<?php
if(qode_options()->getOptionValue('enable_search') == "yes"){
    if(($header_color_transparency_per_page == '' || $header_color_transparency_per_page == '1') &&
        qode_options()->getOptionValue('search_type') == "search_slides_from_header_bottom") {
		echo qode_get_module_template_part('templates/search/types/search', 'header', 'slides-from-header-bottom', $params);

	} else if(qode_options()->getOptionValue('search_type') == "search_covers_header") {
		echo qode_get_module_template_part('templates/search/types/search', 'header', 'covers-header', $params);
	} else {
        echo qode_get_module_template_part('templates/search/types/search', 'header', '', $params);
	}
}