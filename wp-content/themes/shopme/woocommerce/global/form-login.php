<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( is_user_logged_in() ) 
	return;
?>

<form method="post" class="login" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>

	<div class="col-2">

		<?php do_action( 'woocommerce_login_form_start' ); ?>

		<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>

		<p class="form-row-wide form-row-first">
			<label for="username"><?php esc_html_e( 'Username or email', 'shopme' ); ?> <span class="required">*</span></label>
			<input type="text" class="input-text" name="username" id="username" />
		</p>
		<p class="form-row-wide form-row-last">
			<label for="password"><?php esc_html_e( 'Password', 'shopme' ); ?> <span class="required">*</span></label>
			<input class="input-text" type="password" name="password" id="password" />

			<span class="lost_password">
				<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'shopme' ); ?></a>
			</span>
		</p>

		<div class="clear"></div>

		<?php do_action( 'woocommerce_login_form' ); ?>

		<p class="form-row">
			<input name="rememberme" type="checkbox" id="rememberme" value="forever" />
			<label for="rememberme" class="inline"><?php esc_html_e( 'Remember me', 'shopme' ); ?></label>
		</p>

		<p class="form-row">
			<?php wp_nonce_field( 'woocommerce-login' ); ?>
			<input type="submit" class="button button_blue middle_btn" name="login" value="<?php esc_html_e( 'Login', 'shopme' ); ?>" />
			<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
		</p>

		<div class="clear"></div>

		<?php do_action( 'woocommerce_login_form_end' ); ?>

	</div><!--/ .col-2-->

</form>