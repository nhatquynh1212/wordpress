<?php

if (!class_exists('SHOPME_CONFIG_MEGAMENU')) {

	class SHOPME_CONFIG_MEGAMENU {

		public $paths = array();

		protected function path($name, $file = '') {
			return $this->paths[$name] . (strlen($file) > 0 ? '/' . preg_replace('/^\//', '', $file) : '');
		}

		public function assetUrl($file) {
			return $this->paths['BASE_URI'] . $this->path('ASSETS_DIR_NAME', $file);
		}

		function __construct() {

			if (!is_admin()) {

				$this->paths = array(
					'BASE_URI' => SHOPME_BASE_URI . trailingslashit('config-megamenu'),
					'ASSETS_DIR_NAME' => 'assets'
				);

				$this->add_hooks();

			}

		}

		public function add_hooks() {
			add_action('wp_enqueue_scripts', array(&$this, 'front_init'), 1);
		}

		public function front_init() {
			$this->register_css();
		}

		public function register_css() {
			wp_enqueue_style( SHOPME_PREFIX . 'frontend_megamenu', $this->assetUrl('css/frontend-megamenu.css'), array('mmm_mega_main_menu') );
		}

	}

	new SHOPME_CONFIG_MEGAMENU();
}