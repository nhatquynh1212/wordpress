<?php

if (!class_exists('SHOPME_PLUGINS_CONFIG')) {

	class SHOPME_PLUGINS_CONFIG {

		public $plugin_classes = array(
			'SHOPME_AJAX_SEARCH_MOD',
			'SHOPME_WISHLIST_MOD',
			'SHOPME_COMPARE_MOD',
			'SHOPME_FLASHSALE_MOD'
		);

		public $options;
		public $paths = array();
		public static $pathes = array();

		protected function path($name, $file = '') {
			return $this->paths[$name] . (strlen($file) > 0 ? '/' . preg_replace('/^\//', '', $file) : '');
		}

		protected static function assetExtendUrl($file, $folder) {
			return self::$pathes['BASE_URI'] . 'plugins/' . $folder . (strlen($file) > 0 ? '/' . preg_replace('/^\//', '', $file) : '');
		}

		function __construct() {

			$dir = dirname(__FILE__);

			$this->paths = array(
				'BASE_URI' => SHOPME_BASE_URI . trailingslashit('config-plugins'),
				'PLUGINS' => $dir . '/' . trailingslashit('plugins'),
				'WIDGETS_DIR' => $dir . '/' . trailingslashit('widgets')
			);

			self::$pathes = $this->paths;

			require($this->paths['PLUGINS'] . 'ajax_search/config.php');
			require($this->paths['PLUGINS'] . 'compare/config.php');
			require($this->paths['PLUGINS'] . 'wishlist/config.php');
			require($this->paths['PLUGINS'] . 'flashsale/config.php');

			foreach ($this->plugin_classes as $plugin) {
				if (class_exists($plugin)) new $plugin;
			}

			$this->other_vendors_plugins();

		}

		public function other_vendors_plugins() {

			if (defined('wcv_plugin_dir')) {
				remove_action( 'woocommerce_after_shop_loop_item', array('WCV_Vendor_Shop', 'template_loop_sold_by'), 9 );
				add_action( 'woocommerce_after_shop_loop_item_title', array('WCV_Vendor_Shop', 'template_loop_sold_by'), 9);
				add_action( 'shopme_woocommerce_append_actions', array('WCV_Vendor_Shop', 'template_loop_sold_by'), 9);
			}

		}


	}

	new SHOPME_PLUGINS_CONFIG();
}