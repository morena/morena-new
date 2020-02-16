<?php
if(!function_exists('qode_envato_toolkit_notice')) {
	/**
	 * Function that outputs admin notice if theme has update
	 */
	function qode_envato_toolkit_notice()
	{
		//is Envato WordPress Toolkit plugin installed?
		if (qode_envato_wordpress_toolkit_installed()) {
			$options = get_option(EWPT_PLUGIN_SLUG);
			$current_page = get_current_screen();

			//don't show update notification on envato wordpress toolkit plugin page
			if ($current_page->parent_base !== 'envato-wordpress-toolkit') {
				if (is_array($options) && !empty($options['api_key']) && !empty($options['user_name'])) {
					$envato_api = new Envato_Protected_API($options['user_name'], $options['api_key']);

					//get current theme info
					$theme_version = qode_get_theme_info_item('Version');
					$theme_name = qode_get_theme_info_item('Name');
					$theme_author = qode_get_theme_info_item('Author');

					//get all user's themes
					$premium_themes = $envato_api->wp_list_themes();
					$qode_envato_item = new stdClass();

					if (is_array($premium_themes) && count($premium_themes)) {
						foreach ($premium_themes as $premium_theme) {
							//check if premium theme is current theme
							if ($premium_theme->theme_name == $theme_name && $premium_theme->author_name == $theme_author) {
								$qode_envato_item = $premium_theme;
								break;
							}
						}
					}

					if (property_exists($qode_envato_item, 'version')) {
						//is version if currently installed theme lower than latest version?
						$need_update = version_compare($theme_version, $qode_envato_item->version, '<') ? TRUE : FALSE;

						if ($need_update && current_user_can('update_themes')) {
							echo '<div class="updated"><p>' . __('There is a new version of ' . $theme_name . ' available. You can view it\'s details <a href="' . network_admin_url('admin.php?page=' . EWPT_PLUGIN_SLUG . '&tab=themes') . '">here</a>', 'qode') . '</p></div>';
						}
					}

				}
			}
		}
	}

	add_action('admin_notices', 'qode_envato_toolkit_notice');
}