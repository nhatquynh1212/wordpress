<?php

if (!class_exists('SHOPME_WISHLIST_MOD')) {

	class SHOPME_WISHLIST_MOD {

		function __construct() {

			if ( !defined( 'YITH_WCWL' ) ) return;

			if ( get_option( 'yith_wcwl_enabled' ) == 'yes' ) {
				add_action( 'shopme-product-actions-before', function ($product_id) {
					if ( $product_id ) {
						echo do_shortcode( "[yith_wcwl_add_to_wishlist product_id={$product_id}]" );
					} else {
						echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
					}
				} );
			}

			add_action( 'wp_ajax_shopme_add_count_products', array( $this, 'ajax_count_products' ) );
			add_action( 'wp_ajax_nopriv_shopme_add_count_products', array( $this, 'ajax_count_products' ) );

		}

		public function ajax_count_products() {
			echo YITH_WCWL()->count_products();
		}

	}

}