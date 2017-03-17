<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( $order ) : ?>

	<?php if ( $order->has_status( 'failed' ) ) : ?>

		<p><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'shopme' ); ?></p>

		<p><?php
			if ( is_user_logged_in() )
				esc_html_e( 'Please attempt your purchase again or go to your account page.', 'shopme' );
			else
				esc_html_e( 'Please attempt your purchase again.', 'shopme' );
		?></p>

		<p>
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'shopme' ) ?></a>
			<?php if ( is_user_logged_in() ) : ?>
			<a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="button pay"><?php esc_html_e( 'My Account', 'shopme' ); ?></a>
			<?php endif; ?>
		</p>

	<?php else : ?>

		<p class="woocommerce-message"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'shopme' ), $order ); ?></p>

		<table class="shop_table order_details">
			<thead>
				<tr>
					<th><?php esc_html_e( 'Order:', 'shopme' ); ?></th>
					<th><?php echo $order->get_order_number(); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php esc_html_e( 'Date:', 'shopme' ); ?></td>
					<td><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></td>
				</tr>
				<tr>
					<td><?php esc_html_e( 'Total:', 'shopme' ); ?></td>
					<td><?php echo $order->get_formatted_order_total(); ?></td>
				</tr>
				<tr>
					<td><?php esc_html_e( 'Payment method:', 'shopme' ); ?></td>
					<td><?php echo $order->payment_method_title; ?></td>
				</tr>
			</tbody>
		</table>

		<div class="clear"></div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
	<?php do_action( 'woocommerce_thankyou', $order->id ); ?>

<?php else : ?>

	<p><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'shopme' ), null ); ?></p>

<?php endif; ?>