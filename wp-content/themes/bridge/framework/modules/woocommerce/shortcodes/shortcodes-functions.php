<?php

if(!function_exists('qode_include_woocommerce_shortcodes')) {
	function qode_include_woocommerce_shortcodes() {
		foreach(glob(QODE_FRAMEWORK_MODULES_ROOT_DIR.'/woocommerce/shortcodes/*/load.php') as $shortcode_load) {
			include_once $shortcode_load;
		}

	}

	add_action('qode_include_shortcodes_file', 'qode_include_woocommerce_shortcodes');
}