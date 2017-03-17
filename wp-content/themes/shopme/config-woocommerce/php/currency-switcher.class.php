<?php

if (!class_exists('SHOPME_WC_CURRENCY_SWITCHER')) {

	class SHOPME_WC_CURRENCY_SWITCHER extends SHOPME_WOOCOMMERCE_CONFIG {

		public $base;
		public $currency;
		public $rates;
		public $settings;

		function __construct() {

			$this->settings = array(
				array( 'name' => esc_html__( 'Currency Codes', 'shopme' ), 'type' => 'title', 'desc' => '', 'id' => 'wc_currency_code' ),
				array(
					'name' => esc_html__('Codes', 'shopme'),
					'desc' 		=> '',
					'id' 		=> 'wc_currency_codes',
					'css'     => 'width:25%; height: 65px;',
					'type' 		=> 'textarea',
					'std'		=> ''
				),
				array( 'type' => 'sectionend', 'id' => 'wc_currency_code' ),
				array( 'name' => esc_html__( 'Open Exchange Rate API', 'shopme' ), 'type' => 'title', 'desc' => '', 'id' => 'product_enquiry' ),
				array(
					'name' => esc_html__('App Key', 'shopme'),
					'desc' 		=> sprintf( wp_kses(__('(optional) If you have an <a href="%s">Open Exchange Rate API app ID</a>, enter it here.', 'shopme'), array('a' => array('href' => array()))), 'https://openexchangerates.org/signup' ),
					'id' 		=> 'wc_currency_converter_app_id',
					'type' 		=> 'text',
					'std'		=> ''
				),
				array( 'type' => 'sectionend', 'id' => 'product_enquiry')
			);


			if ( false === ( $rates = get_transient( 'woocommerce_currency_converter_rates' ) ) ) {
				$app_id = get_option( 'wc_currency_converter_app_id' ) ? get_option( 'wc_currency_converter_app_id' ) : 'e65018798d4a4585a8e2c41359cc7f3c';
				$rates = wp_remote_retrieve_body( wp_remote_get( 'http://openexchangerates.org/api/latest.json?app_id=' . $app_id ) );

				// Cache for 12 hours
				if ( $rates ) {
					set_transient( 'woocommerce_currency_converter_rates', $rates, 60*60*12 );
				}
			}

			$rates = json_decode( $rates );
			if ( $rates ) {
				$this->base	 = $rates->base;
				$this->rates = $rates->rates;
			}

			// Hooks Actions
			add_action('wp_enqueue_scripts', array( &$this, 'enqueue_currency_js'), 10);
			add_action('woocommerce_checkout_update_order_meta', array( &$this, 'update_order_meta'));

			// Set
			add_action('woocommerce_settings_general_options_after', array(&$this, 'admin_settings'));
			add_action('woocommerce_update_options_general', array(&$this, 'save_admin_settings'));
		}

		function admin_settings() {
			woocommerce_admin_fields( $this->settings );
		}

		function save_admin_settings() {
			woocommerce_update_options( $this->settings );
		}

		public function enqueue_currency_js() {

			if (is_admin()) return;

			$assets_js_url = self::$pathes['BASE_URI'] . self::$pathes['ASSETS_DIR_NAME'] . '/js/';

			wp_enqueue_script( SHOPME_PREFIX . 'money_js', $assets_js_url . 'money.min.js', array( 'jquery', SHOPME_PREFIX . 'woocommerce-mod' ), '', true );
			wp_enqueue_script( SHOPME_PREFIX . 'accountingjs', $assets_js_url . 'accounting.min.js', array( 'jquery', SHOPME_PREFIX . 'woocommerce-mod' ), '', true );
			wp_enqueue_script( SHOPME_PREFIX . 'converter_js', $assets_js_url . 'converter.js', array( 'jquery', SHOPME_PREFIX . 'woocommerce-mod', SHOPME_PREFIX . 'money_js', SHOPME_PREFIX . 'accountingjs' ), '', true );

			$symbols = array();
			if ( function_exists( 'get_woocommerce_currencies' ) ) {
				$currencies = get_woocommerce_currencies();
				foreach ( $currencies as $code => $name ) {
					$symbols[$code] = get_woocommerce_currency_symbol( $code );
				}
			}

			$zero_replace = '.';
			for ( $i = 0; $i < absint( get_option( 'woocommerce_price_num_decimals' ) ); $i++ ) {
				$zero_replace .= '0';
			}

			wp_localize_script( SHOPME_PREFIX . 'woocommerce-mod', 'wc_currency_converter_params', array(
				'current_currency' => isset( $_COOKIE['woocommerce_current_currency'] ) ? $_COOKIE['woocommerce_current_currency'] : '',
				'currencies'       => json_encode( $symbols ),
				'rates'            => $this->rates,
				'base'             => $this->base,
				'currency'         => get_option( 'woocommerce_currency' ),
				'currency_pos'     => get_option( 'woocommerce_currency_pos' ),
				'num_decimals'     => absint( get_option( 'woocommerce_price_num_decimals' ) ),
				'trim_zeros'       => get_option( 'woocommerce_price_trim_zeros' ) == 'yes' ? true : false,
				'thousand_sep'     => get_option( 'woocommerce_price_thousand_sep' ),
				'decimal_sep'      => get_option( 'woocommerce_price_decimal_sep' ),
				'i18n_oprice'      => esc_html__( 'Original price:', 'shopme'),
				'zero_replace'     => $zero_replace
			));
		}

		public static function output_switcher_html() {
			$currency = '';

			if (function_exists( 'get_woocommerce_currency' )) {
				$currency = get_woocommerce_currency();
			}

			$rotate_transform = shopme_custom_get_option('header_rotate_transform', 1);

			ob_start() ?>

			<?php if (!empty($currency)): ?>

				<div class="alignright site_settings currency">

					<div class="dropdown-list">

						<span class="current open_">
							<?php
							if (isset( $_COOKIE['woocommerce_current_currency'] ) && $_COOKIE['woocommerce_current_currency'] != '') {
								$currency = $_COOKIE['woocommerce_current_currency'];
							}
							echo $currency;
							?>
						</span>

						<?php if (get_option('wc_currency_codes') !== ''): ?>
							<?php $currencies = array_map('trim', explode("\n", get_option('wc_currency_codes'))); ?>
						<?php else: ?>
							<?php $currencies = array(); ?>
						<?php endif; ?>

						<?php if (!empty($currencies)): ?>

							<ul class="currency-switcher dropdown site_setting_list <?php if (!$rotate_transform): ?>off_rotate_transform<?php endif; ?>">

								<?php foreach( $currencies as $currency ): $class = ""; ?>

									<?php if ( $currency == get_option('woocommerce_currency')): ?>
										<?php $class = 'default'; ?>
									<?php endif; ?>

									<li class="animated_item">
										<a class="<?php echo esc_attr($class) ?>" href="#" data-currency-code="<?php echo esc_attr( $currency ) ?>">
											<?php echo $currency ?>
										</a>
									</li>

								<?php endforeach; ?>

							</ul><!--/ .currency-switcher-->

						<?php endif; ?>

					</div>

				</div><!--/ .alignright.site_settings.currency-->

			<?php endif; ?>

			<?php return ob_get_clean();
		}

		function update_order_meta( $order_id ) {
			global $woocommerce;

			if (isset($_COOKIE['woocommerce_current_currency']) && $_COOKIE['woocommerce_current_currency']) {

				update_post_meta( $order_id, 'Viewed Currency', $_COOKIE['woocommerce_current_currency'] );

				$order_total = number_format($woocommerce->cart->total, 2, '.', '');

				$store_currency = get_option('woocommerce_currency');
				$target_currency = $_COOKIE['woocommerce_current_currency'];

				if ($store_currency && $target_currency && $this->rates->$target_currency && $this->rates->$store_currency) {
					$new_order_total = ( $order_total / $this->rates->$store_currency ) * $this->rates->$target_currency;
					$new_order_total = round($new_order_total, 2) . ' ' . $target_currency;
					update_post_meta( $order_id, 'Converted Order Total', $new_order_total );
				}

			}
		}

	}

	new SHOPME_WC_CURRENCY_SWITCHER();

}
