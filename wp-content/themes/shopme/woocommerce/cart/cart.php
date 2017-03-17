<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form class="section_offset" action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

	<section class="section_offset">

		<div class="table_wrap">

				<?php do_action( 'woocommerce_before_cart_table' ); ?>

				<table class="table_type_1 shopping_cart_table shop_table cart" cellspacing="0">

					<thead>
						<tr>
							<th class="product_image_col"><?php esc_html_e('Product Image', 'shopme') ?></th>
							<th class="product_title_col"><?php esc_html_e('Product Name', 'shopme') ?></th>
							<th><?php esc_html_e('SKU', 'shopme'); ?></th>
							<th><?php esc_html_e('Price', 'shopme'); ?></th>
							<th class="product_qty_col"><?php esc_html_e('Quantity', 'shopme') ?></th>
							<th><?php esc_html_e('Total', 'shopme') ?></th>
							<th class="product_actions_col"><?php esc_html_e('Action', 'shopme') ?></th>
						</tr>
					</thead>

					<tbody>
					<?php do_action( 'woocommerce_before_cart_contents' ); ?>

					<?php
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							?>
							<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

								<td class="product_image_col" data-title="<?php esc_html_e('Product Image', 'shopme') ?>">
									<?php
									$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(array(80, 80)), $cart_item, $cart_item_key );

									if ( ! $_product->is_visible() )
										echo $thumbnail;
									else
										printf( '<a href="%s">%s</a>', esc_url($_product->get_permalink( $cart_item )), $thumbnail );
									?>
								</td>

								<td data-title="<?php esc_html_e('Product Name', 'shopme') ?>">

									<?php
									if ( ! $_product->is_visible() )
										echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
									else
										echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a class="product_title" href="%s">%s </a>', esc_url($_product->get_permalink( $cart_item )), $_product->get_title() ), $cart_item, $cart_item_key );

									// Meta data
									echo WC()->cart->get_item_data( $cart_item );

									// Backorder notification
									if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
										echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'shopme' ) . '</p>';
									?>

								</td>

								<td data-title="<?php esc_html_e('SKU', 'shopme') ?>">
									<?php echo ($sku = $_product->get_sku()) ? $sku : esc_html__('N/A', 'shopme'); ?>
								</td>

								<td class="subtotal" data-title="<?php esc_html_e('Price', 'shopme') ?>">
									<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
								</td>

								<td data-title="<?php esc_html_e('Quantity', 'shopme') ?>">

									<?php
									if ( $_product->is_sold_individually() ) {
										$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
									} else {
										$product_quantity = woocommerce_quantity_input( array(
											'input_name'  => "cart[{$cart_item_key}][qty]",
											'input_value' => $cart_item['quantity'],
											'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
											'min_value'   => '0'
										), $_product, false );
									}

									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
									?>
								</td>

								<td class="total" data-title="<?php esc_html_e('Total', 'shopme') ?>">
									<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
								</td>

								<td data-title="Action">
									<button title="<?php esc_html_e('Update Cart', 'shopme') ?>" type="submit" class="button_dark_grey icon_btn edit_product" value="update_cart" name="update_cart"><i class="icon-loop"></i></button>
									<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="button_dark_grey icon_btn remove_product remove" title="%s"><i class="icon-cancel-2"></i></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'shopme' ) ), $cart_item_key ); ?>
								</td>

							</tr>
						<?php
						}
					}

					do_action( 'woocommerce_cart_contents' ); ?>

					<?php do_action( 'woocommerce_after_cart_contents' ); ?>

					</tbody>
				</table>

				<?php do_action( 'woocommerce_after_cart_table' ); ?>

		</div><!--/ .table_wrap-->

		<footer class="bottom_box on_the_sides">

			<div class="left_side">
				<a target="_blank" href="<?php echo esc_url(get_post_type_archive_link('product')) ?>" class="button_blue middle_btn"><?php esc_html_e('Continue Shopping', 'shopme') ?></a>
			</div>

			<div class="right_side">
				<?php echo apply_filters( 'woocommerce_cart_clear_shopping', sprintf( '<a href="%s" class="button_grey middle_btn">%s</a>', esc_url( WC()->cart->get_cart_url() . '?empty-cart' ), esc_html__('Clear Shopping Cart', 'shopme') ) ); ?>
			</div>

		</footer><!--/ .bottom_box -->

	</section><!--/ .section_offset-->

	<section class="section_offset">

		<div class="row">

			<div class="col-sm-6">

				<h3 class="row-title"><?php esc_html_e('Discount Codes', 'shopme'); ?></h3>

				<div class="theme_box">

					<p class="form_caption"><?php esc_html_e('Enter your coupon code if you have one.', 'shopme') ?></p>

					<form id="discount_code">

						<ul>

							<li class="row">

								<div class="col-xs-12">

									<?php if ( WC()->cart->coupons_enabled() ) { ?>

										<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_html_e( 'Coupon code', 'shopme' ); ?>" />

										<?php do_action( 'woocommerce_cart_coupon' ); ?>
									<?php } ?>

									<?php do_action( 'woocommerce_cart_actions' ); ?>

									<?php wp_nonce_field( 'woocommerce-cart' ); ?>

								</div>

							</li>

						</ul>

					</form>

				</div><!--/ .theme_box -->

				<footer class="bottom_box">
					<input type="submit" class="button button_grey middle_btn" name="apply_coupon" value="<?php esc_html_e( 'Apply Coupon', 'shopme' ); ?>" />
				</footer>

			</div>

			<div class="col-sm-6">

				<?php do_action( 'woocommerce_cart_collaterals' ); ?>

			</div>

		</div>

	</section><!--/ .section_offset-->

</form>

<?php do_action( 'woocommerce_after_cart' ); ?>
