<?php

$defaults = array(
	'title' => esc_html__('Sign Up to Our Newsletter', 'shopme'),
	'mailchimp_intro' => esc_html__('Sign up our newsletter and get exclusive deals you will not find anywhere else straight to your inbox!', 'shopme'),
);

$instance = wp_parse_args( (array) $instance, $defaults );
$mailchimp_intro = isset( $instance['mailchimp_intro'] ) ? $instance['mailchimp_intro'] : '';
$data_mailchimp_api = shopme_custom_get_option('mad_mailchimp_api');

if ( $data_mailchimp_api == '' ) {
	echo esc_html__('Please enter your MailChimp API KEY in the theme options panel prior of using this widget.', 'shopme');
	return;
}

?>
<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', 'shopme') ?></label>
	<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title'] ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id('mailchimp_intro'); ?>"><?php esc_html_e('Intro Text :', 'shopme'); ?></label>
	<textarea class="widefat" id="<?php echo $this->get_field_id('mailchimp_intro'); ?>" name="<?php echo $this->get_field_name('mailchimp_intro'); ?>" cols="35" rows="5"><?php echo esc_textarea($mailchimp_intro); ?></textarea>
</p>