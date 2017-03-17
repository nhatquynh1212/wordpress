<?php

if (!class_exists('SHOPME_COMPARE_MOD')) {

	class SHOPME_COMPARE_MOD extends SHOPME_PLUGINS_CONFIG {

		public $action_recount = 'action_recount';
		public $action_recount_after_remove = 'action_recount_after_remove';
		public $cookie_name = 'yith_woocompare_list';

		public $products_list = array();

		function __construct() {

			global $woocommerce;

			if ( ! isset( $woocommerce ) || ! function_exists( 'WC' ) ) {
				return;
			}

			if ( !defined( 'YITH_WOOCOMPARE' ) || !class_exists('YITH_Woocompare_Frontend') ) return;

			if ( $this->is_frontend() ) {

				$frontend = new YITH_Woocompare_Frontend();

				remove_action('woocommerce_single_product_summary', array($frontend, 'add_compare_link'), 35);
				remove_action('woocommerce_after_shop_loop_item', array($frontend, 'add_compare_link'), 20);

				if ( get_option('yith_woocompare_compare_button_in_products_list') == 'yes' ) {
					add_action('shopme-product-actions-after', function($product_id) {

						if ( $product_id ) {
							echo do_shortcode( "[yith_compare_button product='{$product_id}' container='']" );
						} else {
							echo do_shortcode( "[yith_compare_button container='']" );
						}

					} );
				}

			}

			define('SHOPME_COMPARE_URI', SHOPME_BASE_URI . 'config-plugins/plugins/compare/css');

			require( self::$pathes['PLUGINS'] . 'compare/widgets/class.yith-woocompare-widget.php' );

			add_action('widgets_init', array($this, 'compare_widgets_init'));
			add_action('wp_enqueue_scripts', array( $this, 'enqueue_scripts_and_styles' ), 1 );

			$this->products_list = isset( $_COOKIE[ $this->cookie_name ] ) ? json_decode( maybe_unserialize( $_COOKIE[ $this->cookie_name ] ) ) : array();

			add_action( 'wp_ajax_' . $this->action_recount, array( $this, 'refresh_recount' ) );
			add_action( 'wp_ajax_nopriv_' . $this->action_recount, array( $this, 'refresh_recount' ) );

			add_action( 'wp_ajax_' . $this->action_recount_after_remove, array( $this, 'refresh_recount_after_remove' ) );
			add_action( 'wp_ajax_nopriv_' . $this->action_recount_after_remove, array( $this, 'refresh_recount_after_remove' ) );
		}

		public function is_frontend() {
			$is_ajax = ( defined( 'DOING_AJAX' ) && DOING_AJAX );
			$context_check = isset( $_REQUEST['context'] ) && $_REQUEST['context'] == 'frontend';
			$actions_to_check = array( 'woof_draw_products' );
			$action_check = isset( $_REQUEST['action'] ) && in_array( $_REQUEST['action'], $actions_to_check );

			return (bool) ( ! is_admin() || ( $is_ajax && ( $context_check || $action_check ) ) );
		}

		public function compare_widgets_init() {
			unregister_widget( 'YITH_Woocompare_Widget' );
			register_widget( 'MOD_YITH_Woocompare_Widget' );
		}

		public function enqueue_scripts_and_styles() {

			$widget_css = self::assetExtendUrl('css/widget.css', basename(dirname(__FILE__)));
			$woocompare_js = self::assetExtendUrl('js/woocompare-mod.js', basename(dirname(__FILE__)));

			// widget
			if ( is_active_widget( false, false, 'mad-yith-woocompare-widget', true ) && ! is_admin() ) {
				wp_deregister_style( 'yith-woocompare-widget' );
				wp_enqueue_style( 'yith-woocompare-widget', $widget_css );

				wp_enqueue_script( SHOPME_PREFIX . 'wcas_frontend', $woocompare_js, array('jquery', 'yith-woocompare-main'), '', true );
				wp_localize_script( SHOPME_PREFIX . 'wcas_frontend', 'yith_woocompare_mod', array(
					'action_recount' => $this->action_recount,
					'action_recount_after_remove' => $this->action_recount_after_remove,
				));
			}

		}

		public function get_products_list() {
			$products_list = isset( $_COOKIE[ $this->cookie_name ] ) && !empty($_COOKIE[ $this->cookie_name ]) ? maybe_unserialize( $_COOKIE[ $this->cookie_name ] ) : array();
			return $products_list;
		}

		public function output_count() {
			$products_list = $this->products_list;

			if (!empty($products_list) && $products_list > 0) {
				echo count($products_list);
			} else {
				echo '0';
			}
		}

		public function refresh_recount() {
			echo $this->recount();
			die();
		}

		public function recount() {
			$this->output_count();
		}

		public function refresh_recount_after_remove() {
			echo $this->recount_after_remove();
			die();
		}

		public function recount_after_remove() {

			if ( ! isset( $_REQUEST['id'] ) ) die();

			if ( $_REQUEST['id'] == 'all' ) {
				$products = $this->products_list;
				foreach ( $products as $product_id ) {
					$this->remove_product_from_compare( intval( $product_id ) );
				}
			} else {
				$this->remove_product_from_compare( intval( $_REQUEST['id'] ) );
			}

			$this->output_count();

		}

		public function remove_product_from_compare( $product_id ) {
			foreach ( $this->products_list as $k => $id ) {
				if ( $product_id == $id ) unset( $this->products_list[$k] );
			}
			setcookie( $this->cookie_name, serialize( $this->products_list ), 0, COOKIEPATH, COOKIE_DOMAIN, false, true );
		}

	}

}