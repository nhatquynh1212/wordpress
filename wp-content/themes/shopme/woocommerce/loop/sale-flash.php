<?php
/**
 * Product loop sale flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>

<?php if (shopme_custom_get_option('product_sale')): ?>

	<?php
		$percentage = 0;
		$flash_sale_percentage = '';

		if (class_exists('SHOPME_FLASHSALE_MOD')) {
			$flash_sale_percentage = SHOPME_FLASHSALE_MOD::on_price_percentage();
		}
	?>

	<?php if ( $product->is_on_sale() || !empty($flash_sale_percentage) ) : ?>

		<?php

		if ($product->regular_price) {
			$percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
		}

		if (!empty($flash_sale_percentage)) {
			$percentage = $flash_sale_percentage;
		}

		if (shopme_custom_get_option('product_sale_percent') && $percentage) {
			$sales_html = '<span class="label_offer_percentage"><span>' . $percentage . '%</span>' . esc_html__('OFF', 'shopme') . '</span>';
		} else {
			$sales_html = apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'shopme' ) . '</span>', $post, $product );
		}
		?>

		<?php echo $sales_html; ?>

	<?php endif; ?>

<?php endif; ?>

<?php if (shopme_custom_get_option('product_featured')): ?>

	<?php if ( $product->is_featured() ) : ?>
		<?php echo apply_filters( 'woocommerce_featured_flash', '<span class="onfeatured">' . esc_html__( 'Featured!', 'shopme' ) . '</span>', $post, $product ); ?>
	<?php endif; ?>

<?php endif; ?>
