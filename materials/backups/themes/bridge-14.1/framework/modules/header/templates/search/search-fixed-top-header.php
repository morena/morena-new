<?php
if(qode_options()->getOptionValue('enable_search') == "yes"){
	echo qode_get_module_template_part('templates/search/types/search', 'header', 'covers-header', $params);
}