<?php
	extract($args, EXTR_SKIP);
	$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
?>

<?php echo $before_widget; ?>

<?php if ($title !== ''): ?>
	<?php echo $before_title . $title . $after_title; ?>
<?php endif; ?>

<div class="theme_box">
	<?php
		if ( !empty($instance['mailchimp_intro']) ) {
			echo '<div id="mailchimp-sign-up" class="mailchimp-sign-up"><p class="form_caption">' . $instance['mailchimp_intro'] . '</p></div>';
		}
	?>
	<form class="newsletter" action="#" method="POST">
		<input id="s-email" type="email" name="email" placeholder="<?php esc_html_e('Enter your email address', 'shopme'); ?>">
		<button id="signup-submit" class="button_blue def_icon_btn" name="newsletter-submit" type="submit"></button>
	</form>
</div><!--/ .theme_box-->

<?php echo $after_widget; ?>