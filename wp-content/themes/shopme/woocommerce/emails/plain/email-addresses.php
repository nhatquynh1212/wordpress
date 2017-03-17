<?php
/**
 * Email Addresses (plain)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails/Plain
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

echo "\n" . strtoupper( esc_html__( 'Billing address', 'shopme' ) ) . "\n\n";
echo preg_replace( '#<br\s*/?>#i', "\n", $order->get_formatted_billing_address() ) . "\n";

if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && ( $shipping = $order->get_formatted_shipping_address() ) ) {
	echo "\n" . strtoupper( esc_html__( 'Shipping address', 'shopme' ) ) . "\n\n";
	echo preg_replace( '#<br\s*/?>#i', "\n\t", $shipping ) . "\n";
}
