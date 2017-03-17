<?php
/**
 * Order Customer Details
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<header><h4 class="row-title"><?php esc_html_e( 'Customer Details', 'shopme' ); ?></h4></header>

<table class="shop_table shop_table_responsive customer_details">
	<?php if ( $order->customer_note ) : ?>
		<tr>
			<th><?php esc_html_e( 'Note:', 'shopme' ); ?></th>
			<td><?php echo wptexturize( $order->customer_note ); ?></td>
		</tr>
	<?php endif; ?>

	<?php if ( $order->billing_email ) : ?>
		<tr>
			<th><?php esc_html_e( 'Email:', 'shopme' ); ?></th>
			<td><?php echo esc_html( $order->billing_email ); ?></td>
		</tr>
	<?php endif; ?>

	<?php if ( $order->billing_phone ) : ?>
		<tr>
			<th><?php esc_html_e( 'Telephone:', 'shopme' ); ?></th>
			<td><?php echo esc_html( $order->billing_phone ); ?></td>
		</tr>
	<?php endif; ?>

	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>
</table>

<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>

<div class="col2-set addresses">

	<div class="col-1">

		<?php endif; ?>

		<header class="title">
			<h4 class="row-title"><?php esc_html_e( 'Billing Address', 'shopme' ); ?></h4>
		</header>

		<address class="col-address">
			<?php echo ( $address = $order->get_formatted_billing_address() ) ? $address : esc_html__( 'N/A', 'shopme' ); ?>
		</address>

		<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>

	</div><!-- /.col-1 -->

	<div class="col-2">

		<header class="title">
			<h4 class="offset_title"><?php esc_html_e( 'Shipping Address', 'shopme' ); ?></h4>
		</header>

		<address class="col-address">
			<?php echo ( $address = $order->get_formatted_shipping_address() ) ? $address : esc_html__( 'N/A', 'shopme' ); ?>
		</address>

	</div><!-- /.col-2 -->

</div><!-- /.col2-set -->

<?php endif; ?>
