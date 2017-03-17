<?php

if (!class_exists('SHOPME_WC_WPML_CONFIG')) {

	class SHOPME_WC_WPML_CONFIG {

		public $paths = array();

		protected function path($name, $file = '') {
			return $this->paths[$name] . (strlen($file) > 0 ? '/' . preg_replace('/^\//', '', $file) : '');
		}
		protected function assetUrl($file) {
			return $this->paths['BASE_URI'] . $this->path('ASSETS_DIR_NAME', $file);
		}

		function __construct() {
			$dir = dirname(__FILE__);

			$this->paths = array(
				'PHP' => $dir . '/' . trailingslashit('php'),
				'ASSETS_DIR_NAME' => 'assets',
				'BASE_URI' => SHOPME_BASE_URI . trailingslashit('config-wpml')
			);

			add_filter('wpml_active_languages', array($this, 'active_languages'));
		}

		public function active_languages($languages) {
			return $languages;
		}

		public static function wpml_header_languages_list() {
			$languages = array();

			if (function_exists( 'icl_get_languages' )){
				$languages = icl_get_languages('skip_missing=0&orderby=code');
			}

			$rotate_transform = shopme_custom_get_option('header_rotate_transform', 1);
			$rotate_transform_class = (!$rotate_transform) ? 'off_rotate_transform' : '';

			if ( !empty($languages) ) { ?>

				<div class="alignright site_settings">

					<div class="dropdown-list">

						<span class="current open_">
							<?php
							foreach( $languages as $l ) {
								if ( $l['active'] ) {
									if ( $l['country_flag_url'] ) {
										echo '<img src="'. esc_url($l['country_flag_url']) .'" height="12" alt="'. esc_attr($l['language_code']) .'" width="18" />';
									}
									echo icl_disp_language($l['native_name'], $l['translated_name']);
								}
							}
							?>
						</span>

						<?php
						if ( function_exists('icl_get_languages') ) {
							if( !empty($languages) ) {
								echo '<ul class="dropdown site_setting_list language ' . $rotate_transform_class . '">';
								foreach( $languages as $l ) {
									if ( $l['active'] ) continue;
									echo '<li class="animated_item">';
									if ( !$l['active'] ) echo '<a href="'. esc_url($l['url']) .'">';
									echo '<img src="' . esc_attr($l['country_flag_url']) . '" alt="' . esc_attr($l['language_code']) . '" />';
									echo $l['native_name'];
									if ( !$l['active'] ) echo '</a>';
									echo '</li>';
								}
								echo '</ul>';
							}
						}
						?>

					</div>

				</div>

			<?php
			}
		}

	}

	new SHOPME_WC_WPML_CONFIG();

}


