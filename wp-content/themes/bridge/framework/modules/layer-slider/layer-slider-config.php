<?php
if(!function_exists('qode_layer_slider_global_overrides')) {
	function qode_layer_slider_global_overrides()
	{
		// Disable auto-updates
		$GLOBALS['lsAutoUpdateBox'] = false;
	}
	add_action('layerslider_ready', 'qode_layer_slider_global_overrides');
}