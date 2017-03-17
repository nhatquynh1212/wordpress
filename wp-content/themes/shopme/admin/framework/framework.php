<?php

if (!class_exists('SHOPME_FRAMEWORK')) {

	class SHOPME_FRAMEWORK {

		const SHOPME_FRAMEWORK_VERSION = '0.3';
		public static $path = array();
		public $paths;

		public function __construct() {
			$this->paths['frameworkPath'] = trailingslashit( dirname(__FILE__) );
			$this->paths['frameworkURL'] = SHOPME_BASE_URI . 'admin/' . trailingslashit('framework');
			$this->paths['frameworkPHP'] = $this->paths['frameworkPath'] . trailingslashit('php');

			$this->paths['assetsPath']	= trailingslashit( $this->paths['frameworkPath'] ) . 'assets/';
			$this->paths['assetsURL']	= trailingslashit( $this->paths['frameworkURL'] ) . 'assets/';

			$this->paths['assetsJsURL']	= $this->paths['assetsURL'] . 'js/';
			$this->paths['assetsCssURL'] = $this->paths['assetsURL'] . 'css/';

			$this->paths['imagesURL']	= trailingslashit( $this->paths['frameworkURL'] ) . 'images/';
			$this->paths['configPath']	= $this->paths['frameworkPath'] . 'config/';

			self::$path = $this->paths;
			$this->loadLibraries();
		}

		public function loadLibraries() {
			require_once($this->paths['frameworkPHP'] . 'functions-helper.php');
			require_once($this->paths['frameworkPHP'] . 'breadcrumb.class.php');
			require_once($this->paths['frameworkPHP'] . 'sidebar-generator.class.php');
			require_once($this->paths['frameworkPHP'] . 'global-object.class.php');
			require_once($this->paths['frameworkPHP'] . 'adminpages.class.php');
			require_once($this->paths['frameworkPHP'] . 'html-helper.class.php');
			require_once($this->paths['frameworkPHP'] . 'functions-ajax.php');
			require_once($this->paths['frameworkPHP'] . 'config-import-export/export-class.php');
			require_once($this->paths['frameworkPHP'] . 'dynamic-style-creator.class.php');
			require_once($this->paths['frameworkPHP'] . 'facebook-page-likebox.php');
			require_once($this->paths['frameworkPHP'] . 'class-pinterest-widgets.php');
			require_once($this->paths['frameworkPHP'] . 'admin-aside-panel.php');
			require_once($this->paths['frameworkPHP'] . 'wp-sitemap-page.php');
		}

		public function theme_data() {
			if (function_exists('wp_get_theme')) {
				$wp_theme_obj = wp_get_theme();
				$theme_data['title'] = $wp_theme_obj->get('Name');
				$theme_data['author'] = $wp_theme_obj->get('Author');
				$theme_data['name'] = strtolower($theme_data['title']);

				if (is_child_theme()) {
					$theme_data['name'] = strtolower($wp_theme_obj->get('Template'));
				}

				$theme_data['prefix'] = strtolower($theme_data['title']);
				$theme_data['version'] = strtolower($wp_theme_obj->get('Version'));
				return $theme_data;
			}
		}

	}

	$shopme_framework = new SHOPME_FRAMEWORK();
	$shopme_theme_data = $shopme_framework->theme_data();
	$shopme_global_data = new SHOPME_GLOBAL_OBJECT($shopme_theme_data);

}

?>