<?php

if (!class_exists('SHOPME_TEMPLATES_HOOKS')) {

	class SHOPME_TEMPLATES_HOOKS {

		function __construct() {
			$this->init();
		}

		public function init() {
			$this->add_hooks();
		}

		public function add_hooks() {

			add_action('shopme_header_layout', array(&$this, 'header_layout_hook'));

			if (shopme_custom_get_option('cookie_alert') == 'show') {
				if (!self::getcookie('cwallowcookies')) {
					add_action('wp_enqueue_scripts', array(&$this, 'cookie_alert_enqueue_scripts'), 1);
					add_action('wp_head', array(&$this, 'top_cookie_alert_localize'), 3);
					add_action('shopme_body_append', array(&$this, 'top_cookie_alert'));
				}
			}

			if (shopme_custom_get_option('query-loader')) {
				add_action('shopme_body_append', array(&$this, 'query_loader'));
			}

			add_action('shopme_header_after', 'shopme_header_after_breadcrumbs');
			add_action('shopme_before_content', 'shopme_before_content');
			add_action('shopme_after_content', 'shopme_after_content');

			add_action('shopme_footer_in_top_part', 'shopme_footer_in_top_part_widgets');
			add_action('shopme_footer_in_bottom_part', 'shopme_footer_in_bottom_part');
		}

		public function header_layout_hook($type) {
			shopme_get_template( "/header/header_{$type}.php" );
		}

		public function query_loader() {
			echo '<div class="mad__loader"></div>';
		}

		public function cookie_alert_enqueue_scripts() {
			wp_enqueue_script( SHOPME_PREFIX . 'cookiealert' );
		}

		public function top_cookie_alert_localize() {
			wp_localize_script('jquery', 'cwmessageObj', array(
				'cwmessage' => esc_html__("Please note this website requires cookies in order to function correctly, they do not store any specific information about you personally.", 'shopme'),
				'cwagree' => esc_html__("Accept Cookies", 'shopme'),
				'cwmoreinfo' => esc_html__("Read more...", 'shopme'),
				'cwmoreinfohref' => is_ssl() ? "https://" : "http://" . "www.cookielaw.org/the-cookie-law"
			));
		}

		public function top_cookie_alert() {

			$cookie_alert_message = shopme_custom_get_option('cookie_alert_message', esc_html__('Please note this website requires cookies in order to function correctly, they do not store any specific information about you personally.', 'shopme'));
			$cookie_alert_read_more_link = shopme_custom_get_option('cookie_alert_read_more_link');
			?>
			<script type="text/javascript">
				jQuery(document).ready(function () {

					var cwmessageObj = {
						cwmessage: "Please note this website requires cookies in order to function correctly, they do not store any specific information about you personally.",
						cwmoreinfohref: "http://www.cookielaw.org/the-cookie-law"
					}

					<?php if (!empty($cookie_alert_message)): ?>
						cwmessageObj['cwmessage'] = "<?php echo $cookie_alert_message; ?>";
					<?php endif; ?>

					<?php if (!empty($cookie_alert_read_more_link)): ?>
						cwmessageObj['cwmoreinfohref'] = "<?php echo $cookie_alert_read_more_link; ?>";
					<?php endif; ?>

					jQuery('body').cwAllowCookies(cwmessageObj);
				});
			</script>
		<?php
		}

		/* 	Get Cookie
		/* ---------------------------------------------------------------------- */

		public static function getcookie( $name ) {
			if ( isset( $_COOKIE[$name] ) )
				return maybe_unserialize( stripslashes( $_COOKIE[$name] ) );

			return array();
		}

	}

	new SHOPME_TEMPLATES_HOOKS();
}
