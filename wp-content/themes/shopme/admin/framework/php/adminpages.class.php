<?php

if (!class_exists('SHOPME_ADMIN_PAGES')) {

	class SHOPME_ADMIN_PAGES extends SHOPME_FRAMEWORK {

		public $globalObject;

		function __construct(&$globalObject) {

			if ( is_admin() ) {
				$this->globalObject = $globalObject;

				add_action('admin_menu', array(&$this, 'admin_menu'));
				add_action('admin_head', array(&$this, 'admin_head'), 1);
				add_action('admin_bar_menu', array(&$this, 'admin_bar_menu'), 102);
			} else {
				add_action('admin_bar_menu', array(&$this, 'admin_bar_menu'), 102);
			}

		}

		function admin_head() {
			echo "<link rel='stylesheet' id='shopme-google-webfont' href='//fonts.googleapis.com/css?family=Roboto:300,400,700' type='text/css' media='all'/> \n";
		}

		function admin_menu() {

			if (!isset($this->globalObject->option_pages)) return;

			foreach ($this->globalObject->option_pages as $key => $data_set) {

				if ($key === 0) {
					$the_title = $this->globalObject->theme_data['title'];
					$page = add_menu_page( $the_title, $the_title, 'manage_options', 'shopme', array(&$this, 'create_page'));
				}

				if (!empty($page)) {
					add_action('admin_enqueue_scripts', array(&$this, 'required_scripts'));
					add_action('admin_enqueue_scripts', array(&$this, 'required_styles'));
				}

			}

		}

		function admin_bar_menu () {

			if (!current_user_can('manage_options')) return;

			global $wp_admin_bar, $shopme_global_data;

			if (empty($shopme_global_data->option_pages)) return;

			$admin_url = admin_url('admin.php');

			foreach ($shopme_global_data->option_pages as $page) {
				$slug = $page['slug'];

				$menu = array(
					'id' => $slug,
					'title' => strip_tags($page['title']),
					'href' => $admin_url."?page=". $slug,
					'meta' => array('target' => 'blank')
				);

				if ($page['slug'] != $page['parent'] ) {
					$menu['parent'] = $page['parent'];
					$menu['href'] = $admin_url . "?page=". $page['parent'] . "#to_" . $slug;
				}
				if (is_admin()) $menu['meta'] = array('onclick' => 'self.location.replace(encodeURI("'.$menu['href'].'")); window.location.reload(true);  ');

				$wp_admin_bar->add_menu($menu);
			}
		}

		function create_page() {
			$slug = $_GET['page'];
			$this->globalObject->page_slug = $slug;
			$option_pages = $this->globalObject->option_pages;

			$html = new SHOPME_HTML_BUILD($this->globalObject);

			echo $html->page_header($option_pages);
			foreach ($option_pages as $option_page) {
				echo $html->create_container($option_page);
			}
			echo $html->page_footer();
		}

		function required_scripts($hook) {

			if ('toplevel_page_shopme' != $hook) return;

			wp_enqueue_script('thickbox');
			wp_enqueue_script('jquery-ui');
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('media-upload');
			wp_enqueue_script('wp-color-picker');

			if (function_exists('wp_enqueue_media') && (isset($_REQUEST['page']) && $_REQUEST['page'] == 'shopme')) {
				wp_enqueue_media();
			}
			wp_enqueue_script( SHOPME_PREFIX . 'upload', self::$path['assetsJsURL'] . 'upload-media.js', array('jquery', 'media-upload'), self::SHOPME_FRAMEWORK_VERSION);
			wp_enqueue_script( SHOPME_PREFIX . 'modernizr', self::$path['assetsJsURL'] . 'modernizr.custom.js', array('jquery'), self::SHOPME_FRAMEWORK_VERSION);
			wp_enqueue_script( SHOPME_PREFIX . 'options-behavior', self::$path['assetsJsURL'] . 'options-behavior.js', array('jquery'), self::SHOPME_FRAMEWORK_VERSION);

			$this->localize_popup_text();
		}

		function required_styles($hook) {

			if ('toplevel_page_shopme' != $hook) return;

			wp_enqueue_style('thickbox');
			wp_enqueue_style('wp-color-picker');

			wp_enqueue_style( SHOPME_PREFIX . 'admin_options_styles', self::$path['assetsCssURL'] . 'framework-styles.css');

			if (is_rtl()) {
				wp_enqueue_style( SHOPME_PREFIX . 'admin_options_styles-rtl',  self::$path['assetsCssURL'] . 'rtl.css', array( SHOPME_PREFIX . 'admin_options_styles' ), '1', 'all' );
			}

			wp_enqueue_style( SHOPME_PREFIX . 'admin_fontello', self::$path['assetsCssURL'] . 'fontello.css' );
		}

		public function localize_popup_text() {
			wp_localize_script(SHOPME_PREFIX . 'modernizr', 'shopmeLocalize', array(
				'errorText' => esc_html__('Data is not preserved!', 'shopme'),
				'successText' => esc_html__('All options are saved successfully!', 'shopme'),
				'importsuccessText' => esc_html__('Import demo successfully!', 'shopme'),
				'importsuccessOptions' => esc_html__('Import options successfully!', 'shopme'),
				'resetText' => esc_html__('Are you sure you want to delete all of the options?', 'shopme'),
				'importText' => esc_html__('By importing the dummy data all your current theme option settings will be overwritten. Continue anyway?', 'shopme')
			));
		}

	}

}
