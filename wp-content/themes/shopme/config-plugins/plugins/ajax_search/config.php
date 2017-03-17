<?php

if (!class_exists('SHOPME_AJAX_SEARCH_MOD')) {

	class SHOPME_AJAX_SEARCH_MOD extends SHOPME_PLUGINS_CONFIG {

		function __construct() {

			if ( !defined( 'YITH_WCAS' ) ) { return; }

			if ( ! defined( 'SHOPME_ASSETS_IMAGES_URL' ) ) {
				define( 'SHOPME_ASSETS_IMAGES_URL', SHOPME_BASE_URI. 'images/' );
			}

			add_filter('yith_wcas_suggestion', array($this, 'wcas_suggestion'), 10, 2);
			add_action('wp_enqueue_scripts', array(&$this, 'ajax_search_enqueue_styles_scripts'), 1);

		}

		public function wcas_suggestion($values, $product) {
			$values['thumbnail'] = $product->get_image(array(45, 45));
			$values['sku'] = $product->get_sku();
			return $values;
		}

		public function ajax_search_enqueue_styles_scripts() {

			$basedir = basename(dirname(__FILE__));

			$frontend_css = self::assetExtendUrl('css/yith_wcas_ajax_search.css', $basedir);
			wp_deregister_style('yith_wcas_frontend');
			wp_deregister_script('yith_wcas_frontend');
			wp_enqueue_style( 'yith_wcas_frontend', $frontend_css );

		}

	}

}