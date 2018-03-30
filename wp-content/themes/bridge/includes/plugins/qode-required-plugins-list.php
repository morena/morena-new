<?php

function qode_get_required_plugins_links($demo){
	$plugins = array();
	$html = '';

	$importObject = Qode_Import::getInstance();

	$demos   = $importObject->demos_import_list();
	$plugins  = qode_plugins_list($demos[$demo]['required-plugins']);

	$tgmpa = $GLOBALS['tgmpa'];
	$tgmpa->config(array('menu'=>'install-required-plugins'));

	if(!empty($plugins)) {
		$required_demo_plugins = array();

		$html .= "<p>".esc_html__('Following plugins should be installed and activated before demo import:', 'qode')."</p>";
		foreach ($plugins as $key => $value) {

			$tgmpa->register(array('slug'=>$key, 'name'=>$value));

			$is_plugin_active = $tgmpa->is_plugin_active($key);
			$is_plugin_installed = $tgmpa->is_plugin_installed($key);

			if(!$is_plugin_active){
				$status = $is_plugin_installed ? 'activate' : 'install';
				$link_text = $is_plugin_installed ? esc_html__('Activate', 'qode') : esc_html__('Install', 'qode');

				$status = "<a class='qode-demo-plugin-install-link' href='".$tgmpa->get_tgmpa_status_url($status) ."'>".$link_text."</a>";
			}else{
				$status = "<span>".esc_html__('Activated', 'qode')."</span>";
			}

			$html .= "<p>".$value." - ".$status."<span class='spinner'></span></p>";

			array_push($required_demo_plugins, $key);
		}
		$html .= "<span style='visibility:hidden;' data-required-demo-plugins='".json_encode($required_demo_plugins)."' class='qode-required-demo-plugins-list'></span>";
	}

	return $html;
}