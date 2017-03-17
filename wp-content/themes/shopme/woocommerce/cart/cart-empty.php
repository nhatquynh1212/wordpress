<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();

?>

<div class="row">

	<div class="col-sm-6">

		<p class="cart-empty"><?php esc_html_e( 'Your cart is currently empty.', 'shopme' ) ?></p>

		<?php do_action( 'woocommerce_cart_is_empty' ); ?>

		<p class="return-to-shop">
			<a class="button button_blue wc-backward" href="<?php echo esc_url(apply_filters( 'woocommerce_return_to_shop_redirect', get_permalink( wc_get_page_id( 'shop' ) ) )); ?>">
				<?php esc_html_e( 'Return To Shop', 'shopme' ) ?>
			</a>
		</p>

	</div>

</div><!--/ .row-->

