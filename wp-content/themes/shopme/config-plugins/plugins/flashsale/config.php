<?php

if (!class_exists('SHOPME_FLASHSALE_MOD')) {

	class SHOPME_FLASHSALE_MOD extends SHOPME_PLUGINS_CONFIG {

		public $options;

		function __construct() {

			if (!defined('RC_TC_BASE_FILE') && !class_exists('WooCommerce')) return;

			$this->add_hooks();
		}

		public function add_hooks() {

			add_action('wp_enqueue_scripts', array(&$this, 'enqueue_styles_scripts'));

			if (is_admin()) {
				$this->options = $this->woocommerce_brands_plugin_options();
				add_filter( 'woocommerce_settings_tabs_array', array( $this, 'woocommerce_flash_sale_add_tab_woocommerce' ), 60);
				add_action( 'woocommerce_update_options_flash_sale', array( $this, 'woocommerce_flash_sale_update_options' ) );
				add_action( 'woocommerce_settings_tabs_flash_sale', array( $this, 'woocommerce_flash_sale_print_plugin_options' ) );
			}
		}

		public function enqueue_styles_scripts() {

			if (!is_admin()) {
				$basedir = basename(dirname(__FILE__));
				$frontend_css = self::assetExtendUrl('css/jquery.countdown.css', $basedir);

				wp_deregister_style('flipclock-master-cssss');
				wp_enqueue_style('flipclock-master-cssss', $frontend_css);
			}

		}

		public function woocommerce_flash_sale_add_tab_woocommerce ($tabs) {
			unset($tabs['pw_flash_sale']);
			$tabs['flash_sale'] = esc_html__('Flash Sale', 'shopme');
			return $tabs;
		}

		public function woocommerce_brands_plugin_options() {
			$options['general_settings'] = array(
				array(
					'name' => esc_html__( 'General Settings', 'shopme' ),
					'type' => 'title',
					'desc' => '',
					'id' => 'pw_woocommerce_brands_general_settings'
				),
				array(
					'name'      => esc_html__( 'Show Count Down Single', 'shopme' ),
					'desc'      => esc_html__( 'Show Count Down Single.', 'shopme'),
					'id'        => 'pw_woocommerce_flashsale_single_countdown',
					'std' 		=> 'yes',         // for woocommerce < 2.0
					'default' 	=> 'yes',         // for woocommerce >= 2.0
					'type'      => 'checkbox'
				),
				array(
					'name'      => esc_html__( 'Show Count Down Archive', 'shopme' ),
					'desc'      => esc_html__( 'Show Count Down Archive', 'shopme'),
					'id'        => 'pw_woocommerce_flashsale_archive_countdown',
					'std' 		=> 'yes',         // for woocommerce < 2.0
					'default' 	=> 'yes',         // for woocommerce >= 2.0
					'type'      => 'checkbox'
				),
				array(
					'type' => 'sectionend',
					'id' => 'pw_woocommerce_brands_image_settings'
				)
			);

			return apply_filters( 'pw_woocommerce_brands_tab_options', $options );
		}


		public function woocommerce_flash_sale_update_options() {
			global $wp_rewrite;
			foreach( $this->options as $option ) {
				woocommerce_update_options( $option );
			}
			$wp_rewrite->flush_rules();
		}

		public function woocommerce_flash_sale_print_plugin_options() {
			?>
			<div class="subsubsub_section">
				<br class="clear" />
				<?php foreach( $this->options as $id => $tab ) : ?>
					<div class="section" id="woocommerce_brands_<?php echo esc_attr($id) ?>">
						<?php woocommerce_admin_fields( $this->options[$id] ) ;?>
					</div>
				<?php endforeach;?>
			</div>
			<?php
		}

		public static function on_price_percentage() {

			global $product;

			if (!defined('RC_TC_BASE_FILE')) return;

			$tax_display_mode = get_option( 'woocommerce_tax_display_shop' );
			$base_price = $tax_display_mode == 'incl' ? $product->get_price_including_tax() : $product->get_price_excluding_tax();
			$num_decimals = apply_filters( 'woocommerce_wc_pricing_get_decimals', (int) get_option( 'woocommerce_price_num_decimals' ) );

			$arr = $pw_discount = $result = $timer = "";
			$query_meta_query = array('relation' => 'AND');
			$query_meta_query[] = array(
				'key' =>'status',
				'value' => "active",
				'compare' => '=',
			);

			$matched_products = get_posts(
				array(
					'post_type' 	=> 'flash_sale',
					'numberposts' 	=> -1,
					'post_status' 	=> 'publish',
					'fields' 		=> 'ids',
					'orderby' => 'modified',
					'no_found_rows' => true,
					'meta_query' => $query_meta_query,
				)
			);

			$id = $product->id;

			foreach ($matched_products as $pr) {
				$arr = $type = "";
				$resultr = 0;
				$pw_type = get_post_meta($pr,'pw_type',true);
				$pw_cart_roles = get_post_meta($pr,'pw_cart_roles',true);

				if(($pw_cart_roles == 'roles' && empty($pw_roles )) || ($pw_cart_roles == 'capabilities' && empty($pw_capabilities )) || ($pw_cart_roles == 'users' && empty($pw_users )))
					$resultr = 1;

				//For Check Roles
				if ($pw_cart_roles == 'roles' && isset($pw_roles) && is_array($pw_roles)) {
					if (is_user_logged_in()) {
						foreach ($pw_roles as $role) {
							if (current_user_can($role)) {
								$resultr = 1;
								break;
							}
						}
					}
				}

				//For Check capabilities
				if ($pw_cart_roles == 'capabilities' && isset($pw_capabilities) && is_array($pw_capabilities)) {
					if (is_user_logged_in()) {
						foreach ($pw_capabilities as $capabilities) {
							if (current_user_can($capabilities)) {
								$resultr = 1;
								break;
							}
						}
					}
				}

				//For Check User's
				if ($pw_cart_roles == 'users' && isset($pw_users) && is_array($pw_users)) {
					if (is_user_logged_in()) {
						if (in_array(get_current_user_id(), $pw_users)){
							$resultr = 1;
						}
					}
				}


				if ($resultr == 1 || $pw_cart_roles == 'everyone') {

					$pw_to = strtotime(get_post_meta($pr, 'pw_to', true));
					$pw_from = strtotime(get_post_meta($pr, 'pw_from', true));
					$arr = get_post_meta($pr ,'pw_array', true);
					$blogtime = strtotime(current_time( 'mysql' ));

					if ($pw_to == "" && ($pw_type == "quantity" || $pw_type == "special")) {
						$pw_from = $blogtime - 1000;
						$pw_to = $blogtime + 1000;
					}

					if ($blogtime < $pw_to && $blogtime > $pw_from) {

						if (is_array($arr) && in_array($id, $arr)) {

							$pw_matched = get_post_meta($pr, 'pw_matched', true);

							if ($pw_type == "flashsale") {

								$pw_type_discount= get_post_meta($pr, 'pw_type_discount', true);

								if ($pw_matched == "only") {

									$pw_dis = get_post_meta($pr, 'pw_discount', true);

									if ( $pw_type_discount == "percent") {
										$pw_discount += calculate_modifiera( $pw_dis, $base_price );
									} else {
										$pw_discount += $pw_dis;
									}

									$timer = get_post_meta($pr, 'pw_to', true);

								} elseif ($pw_matched == "all") {
									$pw_dis = get_post_meta($pr, 'pw_discount', true);
									if ( $pw_type_discount=="percent" ) {
										$pw_discount += calculate_modifiera( $pw_dis, $base_price );
									} else {
										$pw_discount +=$pw_dis;
									}

									$timer = get_post_meta($pr, 'pw_to', true);

								}
							}

						}
					}
				}
			}

			if ($pw_discount != "") {

				if ( false !== strpos( $pw_discount, '%' ) ) {
					$max_discount = calculate_discount_modifiera( $pw_discount, $base_price );
					$result = round( floatval( $base_price ) - ( floatval( $max_discount  )), (int) $num_decimals );
				} else {
					$result = $base_price - $pw_discount;
				}


				$discount_price = $result;

				$percentage = '';

				if ($base_price) {
					$percentage = round( ( ( $base_price - $discount_price ) / $base_price ) * 100 );
				}

				return $percentage;

			}

		}

	}

}