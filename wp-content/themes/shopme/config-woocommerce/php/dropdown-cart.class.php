<?php

if (!class_exists('SHOPME_DROPDOWN_CART')) {

	class SHOPME_DROPDOWN_CART {

		public $action_cart_item_remove = 'cart_item_remove';
		public $action_refresh_cart_fragment = 'refresh_cart_fragment';

		function __construct() {
			$this->add_actions();
			$this->add_filters();
		}

		public function add_actions() {

			add_action('wp_ajax_' . $this->action_cart_item_remove, array(&$this, 'cart_item_remove'));
			add_action('wp_ajax_nopriv_' . $this->action_cart_item_remove, array(&$this, 'cart_item_remove'));

			add_action( 'wp_ajax_' . $this->action_refresh_cart_fragment, array(&$this, 'refresh_cart_fragment'));
			add_action( 'wp_ajax_nopriv_' . $this->action_refresh_cart_fragment, array(&$this, 'refresh_cart_fragment'));

		}

		public function add_filters() {
			add_filter('woocommerce_add_to_cart_fragments', array(&$this, 'add_to_cart_success_ajax'));
		}

		public function cart_item_remove() {

			check_ajax_referer($this->action_cart_item_remove);

			$cart = WC()->instance()->cart;
			$cart_id = $_POST['cart_id'];
			$cart_item_id = $cart->find_product_in_cart($cart_id);

			if ($cart_item_id) {
				$cart->set_quantity($cart_item_id, 0);
			}

			$this->refresh_cart_fragment();

			exit();
		}

		public function refresh_cart_fragment() {
			$cart_ajax = new WC_AJAX();
			$cart_ajax->get_refreshed_fragments();
			exit();
		}

		public function add_to_cart_success_ajax( $data ) {

			list( $cart_items, $cart_subtotal ) = self::get_current_cart_info();

			$data['count'] = $cart_items;
			$data['subtotal'] = $cart_subtotal;

			return $data;
		}

		public function get_current_cart_info() {
			global $woocommerce;

			$subtotal = WC()->cart->get_cart_subtotal();
			$items = count( $woocommerce->cart->get_cart() );

			return array(
				$items,
				$subtotal
			);
		}

	}

	new SHOPME_DROPDOWN_CART();

}


