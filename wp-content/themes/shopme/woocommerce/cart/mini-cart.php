<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

	<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
		<?php $i = 0;

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
				$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(array(60, 60)), $cart_item, $cart_item_key );
				$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
				?>
				<div class="animated_item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">

					<?php if ($i == 0): ?>
						<p class="title"><?php esc_html_e('Recently added item(s)', 'shopme') ?></p>
					<?php endif; ?>

					<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

					<div class="clearfix sc_product">

						<?php if ( ! $_product->is_visible() ) : ?>
							<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
						<?php else : ?>
							<a class="product_thumb" href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>">
								<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
							</a>
						<?php endif; ?>

						<div class="product_text">
							<a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>" class="product_name"><?php echo $product_name; ?></a>

							<p>
								<?php echo WC()->cart->get_item_data( $cart_item ); ?>
								<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
							</p>
						</div>

						<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="close remove-product" title="%s" data-cart_id="%s" data-product_id="'.$product_id.'"></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), esc_html__('Remove this item', 'shopme'), $cart_item_key ), $cart_item_key ); ?>

					</div><!--/ .clearfix.sc_product-->

					<!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

				</div>
			<?php
			}
			$i++;
		}
		?>

	<?php else : ?>

		<div class="animated_item empty"><?php esc_html_e( 'No products in the cart.', 'shopme' ); ?></div>

	<?php endif; ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>

	<div class="animated_item cart-item">

		<ul class="total_info">

			<?php if (wc_tax_enabled()): ?>
				<li><span class="price"><?php esc_html_e( 'Tax', 'shopme') ?>:</span> <?php wc_cart_totals_taxes_total_html() ?></li>
			<?php endif; ?>

			<?php foreach ( WC()->cart->get_coupons( 'order' ) as $code => $coupon ) : ?>
				<li class="order-discount coupon-<?php echo esc_attr( $code ); ?>">
					<?php wc_cart_totals_coupon_label( $coupon ); ?>
					<?php wc_cart_totals_coupon_html( $coupon ); ?>
				</li>
			<?php endforeach; ?>
			<li class="total"><b><span class="price"><?php esc_html_e( 'Total', 'shopme' ); ?>:</span> <?php echo WC()->cart->get_cart_subtotal(); ?></b></li>
		</ul>

	</div>

	<div class="animated_item">

		<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button_grey button wc-forward"><?php esc_html_e( 'View Cart', 'shopme' ); ?></a>
		<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button_blue button checkout wc-forward"><?php esc_html_e( 'Checkout', 'shopme' ); ?></a>

	</div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
