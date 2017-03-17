<?php

if (!class_exists('shopme_wp_import')) {

	class shopme_wp_import extends WP_Import {

		function save_settings($option_file) {

			if ($option_file) @include_once($option_file);
			if (!isset($options)) { return false; }

			$options = unserialize(base64_decode($options));

			global $shopme_global_data;

			if (is_array($options)) {
				foreach($shopme_global_data->option_pages as $page) {
					$database_option[$page['parent']] = $this->import_values($options[$page['parent']]);
				}
			}

			if (!empty($database_option)) {
				update_option($shopme_global_data->option_prefix, $database_option);
			}

			if (!empty($widget_settings)) {
				$widget_settings = unserialize(base64_decode($widget_settings));
				if (!empty($widget_settings)) {
					foreach($widget_settings as $key => $setting) {
						update_option( $key, $setting );
					}
				}
			}

			if (!empty($sidebar_settings)) {
				$sidebar_settings = unserialize(base64_decode($sidebar_settings));
				if (!empty($sidebar_settings) && is_array($sidebar_settings)) {
					update_option('mad_sidebars', $sidebar_settings );
				}
			}

			if (!empty($meta_settings)) {
				$meta_settings = unserialize(base64_decode($meta_settings));
				if (!empty($meta_settings)) {
					$this->importMetaData($meta_settings);
				}
			}

			$this->twitter_api_config();

			if (strpos($option_file, 'electronics')) {
				update_option('page_on_front', 1743);
			} else {
				update_option('page_on_front', 15);
			}

			update_option('show_on_front', 'page');
			update_option('wc_nb_newness', 1000);
			update_option('yith_woocompare_compare_button_in_products_list', 'yes');
			update_option('yith_wcwl_button_position', 'shortcode');
		}

		public function importMetaData($meta_settings) {
			global $wpdb;

			$type = 'product_cat';
			$table_name = $wpdb->prefix . $type . 'meta';

			if (is_array($meta_settings)) {
				foreach($meta_settings as $meta) {
					$wpdb->insert($table_name, $meta, array('%d', '%d', '%s', '%s' ) );
				}
			}

		}

		public function importSliders($path) {

			if (defined('RS_PLUGIN_PATH')) {

				if ( strpos($path, 'electronics') ) {

					$sliders_needle_revolution = array(
						'home7.zip'
					);

					foreach ($sliders_needle_revolution as $zip_path) {
						$slider = new RevSlider();
						$slider->importSliderFromPost(true, true, RS_PLUGIN_PATH . 'demo/' . $zip_path);
					}

				} else {

					$sliders_needle_revolution = array(
						'homepage1.zip',
						'homepage-6.zip'
					);

				}

				foreach ($sliders_needle_revolution as $zip_path) {
					$slider = new RevSlider();
					$slider->importSliderFromPost(true, true, RS_PLUGIN_PATH . 'demo/' . $zip_path);
				}

			}

			if (defined('LS_ROOT_PATH')) {

				$sliders_needle = array();
				include LS_ROOT_PATH . '/classes/class.ls.importutil.php';

				if (strpos($path, 'default')) {
					$sliders_needle = array(
						'homepage-1',
						'homepage-3-slider',
						'homepage-4-full-width-slider',
						'homepage-6'
					);
				} elseif (strpos($path, 'furniture')) {
					$sliders_needle = array(
						'homepage-1-furniture',
						'homepage-3-furniture'
					);
				}

				if (!empty($sliders_needle)) {
					foreach ($sliders_needle as $slider) {
						if ($item = LS_Sources::getDemoSlider($slider)) {
							if (file_exists($item['file'])) {
								new LS_ImportUtil($item['file']);
							}
						}
					}
				}

			}

		}

		public function twitter_api_config() {
			$conf = array (
				'consumer_key' => '9JH7de9na8JnUjSADwpG0fJ65',
				'consumer_secret' => 'uamiAj41b46Razt38TJVgGKzBOIwOl07Pn8W53296uvReVni9N',
				'request_secret' => '',
				'access_key' => '308471286-eKRNX77anFKPKxUWbX0wRAT95GWgjnaGko5YGBpM',
				'access_secret' => 'VtRgip39ajULJ9R5oIiclxsG9Pu3F38kz3PLHeGM4fbRp'
			);

			foreach( $conf as $key => $val ) {
				update_option( 'twitter_api_' . $key, $val );
			}
		}

		public function import_values($elements) {

			$values = array();

			foreach ($elements as $element) {
				if (isset($element['id'])) {

					if (!isset($element['std'])) $element['std'] = "";

					if ($element['type'] == 'select' && !is_array($element['options'])) {
						$values[$element['id']] = $this->getSelectValues($element['options'], $element['std']);
					} else {
						$values[$element['id']] = $element['std'];
					}
				}
			}

			return $values;
		}

		public function getSelectValues($type, $name) {
			switch ($type) {
				case 'page':
				case 'post':
					$post_page = get_page_by_title($name, 'OBJECT', $type);
					if (isset($post_page->ID)) {
						return $post_page->ID;
					}
					break;
				case 'range':
					return $name;
					break;
			}
		}

		public function menu_install($mega_menu_file) {

			$get_menus = wp_get_nav_menus();

			if (!empty($get_menus)) {

				$nav_needle = array(
					'primary' => 'Primary Menu',
					'secondary' => 'Secondary Menu',
					'fullwidth' => 'Fullwidth Menu',
					'topbar' => 'Topbar Menu'
				);

				foreach ($get_menus as $menu) {
					if (is_object($menu) && in_array($menu->name, $nav_needle) ) {
						$key = array_search($menu->name, $nav_needle);
						if ($key) {
							$locations[$key] = $menu->term_id;
						}
					}
				}
			}

			set_theme_mod( 'nav_menu_locations', $locations );

			$this->mega_menu_options_backup($mega_menu_file);
		}

		public function mega_menu_options_backup($mega_menu_file) {
			global $mega_main_menu;
			$backup_file_content = mm_common::get_url_content( $mega_menu_file );

			if ( $backup_file_content !== false && ( $options_backup = json_decode( $backup_file_content, true ) ) ) {
				if ( isset( $options_backup['last_modified'] ) ) {
					$options_backup['last_modified'] = time() + 30;
					update_option( $mega_main_menu->constant[ 'MM_OPTIONS_NAME' ], $options_backup );
				}
			}
		}

	}

}