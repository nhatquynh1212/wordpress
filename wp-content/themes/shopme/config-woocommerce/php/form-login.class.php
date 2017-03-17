<?php
if (!class_exists('SHOPME_FORM_LOGIN')) {

	class SHOPME_FORM_LOGIN {

		public $href;

		function __construct($href) {
			$this->href = $href;
		}

		public function html() {

			$accountPage = get_permalink( get_option('woocommerce_myaccount_page_id') );

			?>
			<div id="modal-login" class="modal-inner-content modal-login">
				<button class="close arcticmodal-close"></button>
				<div class="woocommerce custom-scrollbar">
					<a class="modal-button button_grey middle_btn" href="<?php echo esc_url($accountPage) ?>"><?php esc_html_e('Register', 'shopme'); ?></a>
					<?php echo do_shortcode('[woocommerce_my_account]'); ?>
				</div>
			</div>
		<?php
		}
	}

}
