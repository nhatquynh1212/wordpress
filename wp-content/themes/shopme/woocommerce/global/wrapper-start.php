<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	global $woocommerce_loop, $shopme_config;

	$wrapper_classes = array();

	$woocommerce_columns = $shopme_config['shop_overview_column_count'];
	$overview_column_count = shopme_get_meta_value('overview_column_count');

	if (!empty($overview_column_count) ) { $woocommerce_columns = $overview_column_count; }

	$product_view = shopme_custom_get_option('shop-view');
	if (empty($product_view)) { $product_view = 'type_1'; }

	$shop_view = shopme_get_meta_value('shop_view');
	if (empty($shop_view)) { $shop_view = 'view-grid'; }
	if (!empty( $shop_view ) ) { $wrapper_classes[] = $shop_view; }

	if ( !shopme_is_product() ) {
		if (!empty( $woocommerce_columns ) ) { $wrapper_classes[] = 'shop-columns-' . $woocommerce_columns; }
		if (!empty( $product_view ) ) 		 { $wrapper_classes[] = $product_view; }
	}

?>

<div class="products-container clearfix <?php echo implode( ' ', $wrapper_classes ) ?>">