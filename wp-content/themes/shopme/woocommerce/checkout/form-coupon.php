<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! wc_coupons_enabled() ) {
	return;
}

if ( empty( WC()->cart->applied_coupons ) ) {
	$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'shopme' ) . ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'shopme' ) . '</a>' );
	wc_print_notice( $info_message, 'notice' );
}
?>

<div class="section_offset">

	<form class="checkout_coupon" method="post" style="display: none; ">

		<div class="theme_box">

			<p class="form_caption"><?php esc_html_e('Enter your coupon code if you have one.', 'shopme') ?></p>

			<ul>
				<li class="row">
					<div class="col-xs-12">
						<p class="form-row form-row-first">
							<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_html_e( 'Coupon code', 'shopme' ); ?>" id="coupon_code" value="" />
						</p>
					</div>
				</li>
			</ul>

		</div><!--/ .theme_box-->

		<footer class="bottom_box">
			<input type="submit" class="button button_grey middle_btn" name="apply_coupon" value="<?php esc_html_e( 'Apply Coupon', 'shopme' ); ?>" />
		</footer><!--/ .bottom_box-->

	</form>

</div><!--/ .section_offset-->

