<?php

if (!class_exists('SHOPME_WOOCOMMERCE_CONFIG')) {

	class SHOPME_WOOCOMMERCE_CONFIG {

		protected static $_instance = null;

		public $action_quick_view = 'shopme_action_add_product_popup';
		public $action_login = 'shopme_action_login_popup';
		public $paths = array();
		public static $pathes = array();

		public function path($name, $file = '') {
			return $this->paths[$name] . (strlen($file) > 0 ? '/' . preg_replace('/^\//', '', $file) : '');
		}

		public function assetUrl($file) {
			return $this->paths['BASE_URI'] . $this->path('ASSETS_DIR_NAME', $file);
		}

		function __construct() {

			// Woocommerce support
			add_theme_support('woocommerce');

			$dir = dirname(__FILE__);

			define('SHOPME_WOO_CONFIG', true);

			$this->paths = array(
				'PHP' => $dir . '/' . trailingslashit('php'),
				'TEMPLATES' => $dir . '/' . trailingslashit('templates'),
				'ASSETS_DIR_NAME' => 'assets',
				'WIDGETS_DIR' => $dir . '/' . trailingslashit('widgets'),
				'BASE_URI' => SHOPME_BASE_URI . trailingslashit('config-woocommerce')
			);
			self::$pathes = $this->paths;

			include( $this->paths['PHP'] . 'functions-template.php' );
			include( $this->paths['PHP'] . 'templates-hooks.php' );
			include( $this->paths['PHP'] . 'ordering.class.php' );
			include( $this->paths['PHP'] . 'new-badge.class.php' );
			include( $this->paths['PHP'] . 'common-tab.class.php' );

			include( $this->paths['PHP'] . 'dropdown-cart.class.php' );
			include( $this->paths['PHP'] . 'quick-view.class.php' );
			include( $this->paths['PHP'] . 'form-login.class.php' );
			include( $this->paths['WIDGETS_DIR'] . 'class-wc-widget-products-specials.php' );

			$this->global_config();
			$this->remove_actions();
			$this->add_filters();
			$this->add_actions();

			add_action('admin_init', array(&$this, 'admin_init'));
			add_action('widgets_init', array(&$this, 'include_widgets'));
			add_action('wp_enqueue_scripts', array(&$this, 'add_enqueue_scripts'));

			include( $this->paths['PHP'] . 'currency-switcher.class.php' );

			add_action('shopme_backend_theme_activation', array(&$this, 'woocommerce_set_defaults'));
			add_action('shopme_pre_import_hook', array(&$this, 'woo_product_settings_update'));
		}

		public function admin_init() {
			add_filter("manage_product_posts_columns", array(&$this, "manage_columns"));
		}

		public function include_widgets() {
			register_widget('Shopme_WC_Widget_Products_Specials');
		}

		public function custom_get_option($key = false, $default = "") {

			$result = get_option('shopme_options');

			if (is_array($key)) {
				$result = $result[$key[0]];
			} else {
				$result = $result['shopme'];
			}

			if ($key === false) {
			} else if(isset($result[$key])) {
				$result = $result[$key];
			} else {
				$result = $default;
			}

			if ($result == "") { $result = $default; }
			return $result;
		}

		public function global_config() {
			global $shopme_config;

			$shopme_config['shop_overview_column_count']  = $this->custom_get_option('woocommerce_column_count');
			$shopme_config['shop_overview_product_count'] = $this->custom_get_option('woocommerce_product_count');

			if (empty($shopme_config['shop_overview_column_count']))
				$shopme_config['shop_overview_column_count'] = 3;

			if (empty($shopme_config['shop_overview_product_count']))
				$shopme_config['shop_overview_product_count'] = 12;

			// Add Image Size
			if (function_exists('add_image_size')) {
				$shop_thumbnail = wc_get_image_size( 'shop_thumbnail' );
				$shop_catalog	= wc_get_image_size( 'shop_catalog' );
				$shop_single	= wc_get_image_size( 'shop_single' );

				add_image_size( 'shop_thumbnail', $shop_thumbnail['width'], $shop_thumbnail['height'], $shop_thumbnail['crop'] );
				add_image_size( 'shop_catalog', $shop_catalog['width'], $shop_catalog['height'], $shop_catalog['crop'] );
				add_image_size( 'shop_single', $shop_single['width'], $shop_single['height'], $shop_single['crop'] );
			}

		}

		public function add_filters() {
			add_filter('woocommerce_enqueue_styles', '__return_empty_array');

			add_filter('woocommerce_general_settings', array(&$this, 'woocommerce_general_settings_filter'));
			add_filter('woocommerce_page_settings', array(&$this, 'woocommerce_general_settings_filter'));
			add_filter('woocommerce_catalog_settings', array(&$this, 'woocommerce_general_settings_filter'));
			add_filter('woocommerce_inventory_settings', array(&$this, 'woocommerce_general_settings_filter'));
			add_filter('woocommerce_shipping_settings', array(&$this, 'woocommerce_general_settings_filter'));
			add_filter('woocommerce_tax_settings', array(&$this, 'woocommerce_general_settings_filter'));
			add_filter('woocommerce_product_settings', array(&$this, 'woocommerce_general_settings_filter'));

			add_filter('woocommerce_available_variation', array($this, 'woocommerce_available_variation'), 10, 3);

			add_filter( 'wp_ajax_shopme_mode_theme_update_mini_cart', array(&$this, 'update_mini_cart') );
			add_filter( 'wp_ajax_nopriv_shopme_mode_theme_update_mini_cart', array(&$this, 'update_mini_cart') );

			add_filter('loop_shop_columns', array(&$this, 'woocommerce_loop_columns'));
			add_filter('loop_shop_per_page', array(&$this, 'woocommerce_product_count'));
		}

		public function remove_actions() {

			remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );

			remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open');
			remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail');
			remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title');
			remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
			remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
			remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
			remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

			remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
			remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

			remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');

			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
//			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

			remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
			remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
			remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

			remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
			remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

			remove_action('woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20);
			remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
			remove_action('woocommerce_product_tabs', 'woocommerce_default_product_tabs');
		}

		public function add_actions() {

			add_action( 'init', array(&$this, 'woocommerce_clear_cart_url'));

			/* Archive Hooks */

			add_action('woocommerce_after_add_to_cart_button', array(&$this, 'buttons_actions_to_cart_button'), 14);
			add_action('woocommerce_proceed_to_checkout', array(&$this, 'woocommerce_button_proceed_to_checkout'), 20);
			add_action('woocommerce_product_tabs', array(&$this, 'woocommerce_default_product_tabs'));

			add_action('woocommerce_after_shop_loop', array(&$this, 'after_shop_woocommerce_pagination'));

			add_action('woocommerce_archive_description', array(&$this, 'woocommerce_category_image'), 2);
			add_action('woocommerce_archive_description', array(&$this, 'woocommerce_ordering_products'));

			add_action('woocommerce_before_single_product_summary', 'shopme_woocommerce_show_product_loop_out_of_sale_flash');
			add_action('woocommerce_before_single_product_summary', 'shopme_share_product_this', 20);

			add_action('woocommerce_after_cart', 'woocommerce_cross_sell_display');

			/* Content Product Hooks */

			add_action('woocommerce_before_shop_loop_item_title', array(&$this, 'woocommerce_before_shop_loop_item_title'));
			add_action('woocommerce_shop_loop_item_title', array(&$this, 'woocommerce_template_loop_product_title'));
			add_action('woocommerce_after_shop_loop_item_title', array(&$this, 'woocommerce_after_shop_loop_item_title'));

			/* Single Product Hooks */

			add_action( 'woocommerce_single_variation', 'shopme_woocommerce_single_variation_add_to_cart_button', 20 );

			add_action('woocommerce_single_product_summary', array(&$this, 'woocommerce_template_single_meta'), 11);
			add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 12);
			add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 13);

			add_action('woocommerce_after_single_product_summary', 'shopme_woocommerce_output_product_content', 25);
			add_action('woocommerce_after_single_product_summary', 'shopme_woocommerce_output_product_data_tabs', 26);
			add_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 27);
			add_action('woocommerce_after_single_product_summary', 'shopme_woocommerce_output_related_products', 28);

			if (shopme_custom_get_option('show_other_products')) {
				add_action('woocommerce_after_single_product_summary', 'shopme_woocommerce_other_products', 29);
			}

			add_action('woocommerce_after_subcategory', array(&$this, 'woocommerce_after_subcategory'));

			// Ajax
			if ( version_compare( WC()->version, '2.4', '>=' ) ) {
				add_action('wc_ajax_' . $this->action_quick_view, array($this, 'ajax_product_popup'));
				add_action('wc_ajax_' . $this->action_login, array(&$this, 'ajax_form_login'), 30);
			} else {
				add_action('wp_ajax_' . $this->action_quick_view, array(&$this, 'ajax_product_popup'), 30);
				add_action('wp_ajax_nopriv_' . $this->action_quick_view, array(&$this, 'ajax_product_popup'), 30);
				add_action('wp_ajax_nopriv_' . $this->action_login, array(&$this, 'ajax_form_login'), 30);
			}

		}

		public function woocommerce_before_shop_loop_item_title() {
			shopme_woocommerce_show_product_loop_out_of_sale_flash();
			$this->woocommerce_before_thumbnail();
			$this->woocommerce_shop_before_hidden();
		}

		public function woocommerce_template_loop_product_title() {
			echo '<a class="product-title" href="'. esc_url(get_the_permalink()) .'">' . shopme_string_truncate(get_the_title(), shopme_custom_get_option('excerpt_count_product_title', 100)) . '</a>';
		}

		public function woocommerce_after_shop_loop_item_title() {
			$this->woocommerce_shop_before_clearfix();
			woocommerce_template_loop_price();
			woocommerce_template_loop_rating();
			$this->woocommerce_shop_after_clearfix();
			$this->woocommerce_shop_after_hidden();
			$this->wc_product_sold_count();
			$this->buttons_actions();
			$this->product_list_view();
		}

		public function wc_product_sold_count() {
			global $product; ?>

			<?php if ( $product->managing_stock() ):
				$units_sold = get_post_meta( $product->id, 'total_sales', true );
				$stock_quantity = $product->get_stock_quantity();
				$stock_sold = sprintf( __( 'Already Sold: %s', 'shopme' ), $units_sold );
				$stock_available = sprintf( __('Available: %s', 'shopme' ), $stock_quantity );
				$percentage = 0;

				if ( absint($stock_quantity) && $stock_quantity > 0 ) {
					$percentage = round( ( $units_sold * 100 ) / absint($stock_quantity) );
				}
			?>

			<div class="deal-progress">
				<div class="deal-stock">
					<span class="stock-sold"><?php echo esc_html($stock_sold) ?></span>
					<span class="stock-available"><?php echo esc_html($stock_available) ?></span>
				</div>

				<div class="progress">
					<?php if ( absint($percentage) > 0 ): ?>
						<span class="progress-bar" style="width: <?php echo absint($percentage) ?>%"></span>
					<?php endif; ?>
				</div>
			</div>

			<?php endif;
		}

		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		public function manage_columns($columns) {
			unset($columns['wpseo-title']);
			unset($columns['wpseo-metadesc']);
			unset($columns['wpseo-focuskw']);

			return $columns;
		}

		function woocommerce_available_variation($variations, $product, $variation) {

			if ( has_post_thumbnail( $variation->get_variation_id() ) ) {
				$attachment_id = get_post_thumbnail_id( $variation->get_variation_id() );

				$image_thumb_link = wp_get_attachment_image_src($attachment_id, 'shop_thumbnail');
				$variations = array_merge( $variations, array( 'image_thumb' => $image_thumb_link[0] ) );

				$image_thumb_link = wp_get_attachment_image_src($attachment_id, 'shop_single');
				$variations = array_merge( $variations, array( 'image_src' => $image_thumb_link[0] ) );
			} else if ( has_post_thumbnail() ) {
				$attachment_id = get_post_thumbnail_id();

				$image_thumb_link = wp_get_attachment_image_src($attachment_id, 'shop_thumbnail');
				$variations = array_merge( $variations, array( 'image_thumb' => $image_thumb_link[0] ) );

				$image_thumb_link = wp_get_attachment_image_src($attachment_id, 'shop_single');
				$variations = array_merge( $variations, array( 'image_src' => $image_thumb_link[0] ) );
			}
			return $variations;
		}

		public function update_mini_cart() {
			echo wc_get_template( 'cart/mini-cart.php' );
			die();
		}

		public function woocommerce_loop_columns() {
			global $shopme_config;

			$woocommerce_columns = $shopme_config['shop_overview_column_count'];
			$overview_column_count = shopme_get_meta_value('overview_column_count');

			if (!empty($overview_column_count) ) { $woocommerce_columns = $overview_column_count; }

			return $woocommerce_columns;
		}

		public function woocommerce_product_count() {
			global $shopme_config;
			return $shopme_config['shop_overview_product_count'];
		}

		public function woocommerce_clear_cart_url() {
			global $woocommerce;

			if ( isset( $_GET['empty-cart'] ) ) {
				$woocommerce->cart->empty_cart();
			}
		}

		public function woocommerce_button_proceed_to_checkout() { ?>
			<a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="checkout-button button_blue middle_btn"><?php esc_html_e( 'Proceed to Checkout', 'shopme' ); ?></a>
		<?php
		}

		public function ajax_product_popup() {
			check_ajax_referer($this->action_quick_view);

			$quickview = new SHOPME_QUICK_VIEW(absint($_POST['id']));
			echo $quickview->html();
			wp_die('exit');
		}

		public function ajax_form_login() {
			check_ajax_referer($this->action_login);

			$form = new SHOPME_FORM_LOGIN($_POST['href']);
			echo $form->html();
			wp_die('exit');
		}

		public function woocommerce_set_defaults() {
			global $shopme_config;

			$shopme_config['themeImgSizes']['shop_thumbnail'] = array( 'width' => 90, 'height' => 90, 'crop' => true );
			$shopme_config['themeImgSizes']['shop_catalog']   = array( 'width' => 350, 'height' => 350, 'crop' => true );
			$shopme_config['themeImgSizes']['shop_single']    = array( 'width'=> 500, 'height'=> 500, 'crop' => true );

			update_option('shop_thumbnail_image_size', $shopme_config['themeImgSizes']['shop_thumbnail']);
			update_option('shop_catalog_image_size', $shopme_config['themeImgSizes']['shop_catalog']);
			update_option('shop_single_image_size', $shopme_config['themeImgSizes']['shop_single']);

			$disabled_options = array('woocommerce_enable_lightbox', 'woocommerce_frontend_css');

			foreach ($disabled_options as $option) {
				update_option($option, false);
			}

		}

		public function add_enqueue_scripts() {

			$css_file = $this->assetUrl('css/woocommerce-mod.css');
			$woo_mod_file = $this->assetUrl('js/woocommerce-mod' . (WP_DEBUG ? '' : '.min') . '.js');
			$woo_zoom_file = $this->assetUrl('js/elevatezoom.min.js');
			$woo_variation_file = $this->assetUrl('js/manage-variation-selection.js');

			wp_enqueue_style( SHOPME_PREFIX . 'woocommerce-mod', $css_file );
			wp_enqueue_script( SHOPME_PREFIX . 'woocommerce-mod', $woo_mod_file, array('jquery', SHOPME_PREFIX . 'plugins', SHOPME_PREFIX . 'core'), 1, true );
			wp_register_script( SHOPME_PREFIX . 'elevate-zoom', $woo_zoom_file, array('jquery', SHOPME_PREFIX . 'woocommerce-mod') );

			$goahead = 1;
			$agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] :'';

			if ( preg_match('/(?i)msie [5-8]/', $agent) ) { $goahead = 0; }

			if ($goahead == 1) {
				wp_deregister_script('wc-add-to-cart-variation');
				wp_dequeue_script('wc-add-to-cart-variation');
				wp_enqueue_script('wc-add-to-cart-variation', $woo_variation_file , array('jquery'), 1, true );
			} else {
				wp_enqueue_script('wc-add-to-cart-variation');
			}

			wp_localize_script(SHOPME_PREFIX . 'woocommerce-mod', 'woocommerce_mod', array(
				'ajaxurl' => version_compare( WC()->version, '2.4', '>=' ) ? WC_AJAX::get_endpoint( "%%endpoint%%" ) : admin_url( 'admin-ajax.php', 'relative' ),
				'nonce_quick_view_popup' => wp_create_nonce( $this->action_quick_view ),
				'nonce_login_popup' => wp_create_nonce( $this->action_login ),
				'nonce_cart_item_remove' => wp_create_nonce( 'cart_item_remove' ),
				'action_quick_view' => $this->action_quick_view,
				'action_login' => $this->action_login
			));
		}

		public static function enqueue_script($script) {
			wp_enqueue_script( SHOPME_PREFIX . $script );
		}

		public function after_shop_woocommerce_pagination() {
			echo shopme_shop_corenavi('', '', array('tag' => 'footer', 'class' => 'bottom_box'));
		}

		public function woocommerce_ordering_products() {

			$filter = false;

			$ordering = new SHOPME_CATALOG_ORDERING($filter);
			echo $ordering->output();
		}

		public function woocommerce_before_thumbnail () {

			$data = $this->create_data_string(array(
				'id' => get_the_ID()
			));
			$active_hover = $this->custom_get_option('product_hover');
			$has_thumb = ($this->woocommerce_second_thumbnail() != '' && $active_hover) ? 'has-second-thumb' : '';
			$shop_catalog = wc_get_image_size( 'shop_catalog' );
			?>

			<div class="image_wrap <?php echo esc_attr($has_thumb) ?>">

				<a href="<?php esc_url(the_permalink()); ?>">

					<div class="front">
						<?php

						if ( has_post_thumbnail() ) {

							if ( defined('FIFU_PLUGIN_DIR') ) {
								$url = get_post_meta(get_the_ID(), 'fifu_image_url', true);

								if ( $url ) {
									echo SHOPME_HELPER::get_the_url($url, array( 'class' => '', 'alt' => get_the_title() ));
								} else {
									echo SHOPME_HELPER::get_the_post_thumbnail(get_the_ID(), $shop_catalog['width'] . '*' . $shop_catalog['height'], $shop_catalog['crop'], array('class' => '', 'alt' => get_the_title()));
								}
							} else {
								echo SHOPME_HELPER::get_the_post_thumbnail(get_the_ID(), $shop_catalog['width'] . '*' . $shop_catalog['height'], $shop_catalog['crop'], array('class' => '', 'alt' => get_the_title()));
							}

						} else {
							echo wc_placeholder_img( 'shop_catalog' );
						}
						?>
					</div>

					<?php if ( $has_thumb ): ?>
						<div class="back"><?php echo $this->woocommerce_second_thumbnail(); ?></div>
					<?php endif; ?>

				</a>

				<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

				<div class="actions_wrap">

					<div class="centered_buttons">

						<a href="<?php echo esc_url(get_the_permalink()) ?>" class="actions-product-link"></a>

						<?php if (shopme_custom_get_option('quick_view')): ?>
							<a href="#" <?php echo esc_attr($data) ?> class="button_dark_grey quick-view"><?php esc_html_e('Quick View', 'shopme') ?></a>
						<?php endif; ?>
						<?php woocommerce_template_loop_add_to_cart(); ?>
					</div><!--/ .centered_buttons -->

					<?php do_action('shopme-product-actions-before'); ?>
					<?php do_action('shopme-product-actions-after'); ?>

					<?php if (shopme_custom_get_option('quick_view')): ?>
						<a href="#" <?php echo esc_attr($data) ?> class="def_icon_btn tooltip_container quick-view"><span class="tooltip top"><?php esc_html_e('Quick View', 'shopme') ?></span></a>
					<?php endif; ?>
					<?php echo $this->woocommerce_loop_add_to_cart_link(); ?>

				</div><!--/ .actions_wrap-->

			<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

			</div><!--/. image_wrap-->

			<?php do_action('woocommerce_after_thumbnail'); ?>

		<?php
		}

		public function woocommerce_second_thumbnail() {
			$id = shopme_post_id();
			$shop_catalog = wc_get_image_size('shop_catalog');

			$product_gallery = get_post_meta( $id, '_product_image_gallery', true );

			if (!empty($product_gallery)) {
				$gallery  = explode(',',$product_gallery);
				$image_id = $gallery[0];

				$image = SHOPME_HELPER::get_the_thumbnail($image_id, $shop_catalog['width'] . '*' . $shop_catalog['height'], $shop_catalog['crop'], array('class' => 'attachment-shop_catalog product-hover', 'alt' => ''));

				if (!empty($image)) return $image;
			}

		}

		function woocommerce_loop_add_to_cart_link() {
			global $product;

			if ( $product ) {
				$defaults = array(
					'quantity' => 1,
					'class'    => implode( ' ', array_filter( array(
						'button',
						'product_type_' . $product->product_type,
						$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
						$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : ''
					) ) )
				);

				extract($defaults);

				echo sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="button_blue def_icon_btn middle_btn add_to_cart tooltip_container alignright %s" title="%s"></a>',
						esc_url( $product->add_to_cart_url() ),
						esc_attr( isset( $quantity ) ? $quantity : 1 ),
						esc_attr( $product->id ),
						esc_attr( $product->get_sku() ),
						esc_attr( isset( $class ) ? $class : 'button' ),
						esc_html( $product->add_to_cart_text() )
					);

			}

		}

		function woocommerce_general_settings_filter($options) {
			$delete = array('woocommerce_enable_lightbox');

			foreach ($options as $key => $option) {
				if (isset($option['id']) && in_array($option['id'], $delete)) {
					unset($options[$key]);
				}
			}
			return $options;
		}

		public static function content_truncate($string, $limit, $break = ".", $pad = "...") {
			if (strlen($string) <= $limit) { return $string; }

			if (false !== ($breakpoint = strpos($string, $break, $limit))) {
				if ($breakpoint < strlen($string) - 1) {
					$string = substr($string, 0, $breakpoint) . $pad;
				}
			}
			if (!$breakpoint && strlen(strip_tags($string)) == strlen($string)) {
				$string = substr($string, 0, $limit) . $pad;
			}
			return $string;
		}

		public static function create_data_string($data = array()) {
			$data_string = "";

			foreach($data as $key => $value) {
				if (is_array($value)) $value = implode(", ", $value);
				$data_string .= " data-$key={$value} ";
			}
			return $data_string;
		}

		function woocommerce_template_single_meta () {
			global $product;
			$post_content = !empty($product->post->post_excerpt) ? $product->post->post_excerpt : '';
			$post_content = apply_filters('the_excerpt', $post_content);
			$post_content = str_replace(']]>', ']]&gt;', $post_content);
			?>

			<?php if (!empty($post_content)): ?>
				<div class="product_short_description">
					<hr/>
					<div class="description_section">
						<?php echo $post_content; ?>
					</div><!--/ .description_section-->
				</div>
			<?php endif; ?>

		<?php
		}

		public function buttons_actions() {
			?>
				<div class="buttons_row clearfix">
					<?php woocommerce_template_loop_add_to_cart(); ?>
					<div class="clear"></div>
					<?php do_action('shopme-product-actions-before'); ?>
					<?php do_action('shopme-product-actions-after'); ?>
				</div><!--/ .buttons_row-->
			<?php
		}

		public function buttons_actions_to_cart_button() {
			?>
			<div class="buttons_actions type_2 view-grid">
				<div class="buttons_row clearfix">
					<?php do_action('shopme-product-actions-before'); ?>
					<?php do_action('shopme-product-actions-after'); ?>
				</div><!--/ .buttons_row-->
			</div>
		<?php
		}

		public function product_list_view() {

			global $post, $product;

			$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
			$rating_count = $product->get_rating_count();
			$review_count = $product->get_review_count();
			$post_excerpt = has_excerpt() ? get_the_excerpt() : '';
			$post_excerpt = apply_filters('the_excerpt', $post_excerpt);
			$post_excerpt = str_replace(']]>', ']]&gt;', $post_excerpt);
			?>

			<div class="full_description">

				<a href="<?php esc_url(the_permalink()); ?>" class="product_title"><?php the_title(); ?></a>

				<?php echo $product->get_categories( ', ', '<span class="product_category">' . _n( '', '', $cat_count, 'shopme' ) . ' ', '.</span>' ); ?>

				<div class="v_centered product_reviews">

					<!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

					<?php woocommerce_template_loop_rating(); ?>

					<!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

					<!-- - - - - - - - - - - - - - Reviews menu - - - - - - - - - - - - - - - - -->

					<ul class="top-bar">

						<?php if ( $rating_count > 0 ) : ?>

							<?php if ( comments_open() ) : ?>
								<li><a href="<?php esc_url(the_permalink()) ?>#reviews" class="woocommerce-review-link" rel="nofollow">
									<?php printf( _n( '%s Review', '%s Reviews', $review_count, 'shopme' ), '<span class="count">' . $review_count . '</span>' ); ?></a>
								</li>
								<li><a href="<?php esc_url(the_permalink()) ?>#commentform" class="woocommerce-write-review-link" rel="nofollow"><?php esc_html_e('Add Your Review', 'shopme') ?></a></li>
							<?php endif ?>

						<?php else: ?>

							<?php if ( comments_open() ) : ?>
								<li><a href="<?php esc_url(the_permalink()) ?>#commentform" class="woocommerce-write-review-link" rel="nofollow"><?php esc_html_e('Add Your Review', 'shopme') ?></a></li>
							<?php endif; ?>

						<?php endif; ?>

					</ul><!--/ .top-bar-->

					<!-- - - - - - - - - - - - - - End of reviews menu - - - - - - - - - - - - - - - - -->

				</div>

				<?php if (!empty($post_excerpt)): ?>
					<?php echo apply_filters( 'woocommerce_short_description', $post_excerpt ) ?>

					<a href="<?php esc_url(the_permalink()); ?>" class="learn_more"><?php esc_html_e('Learn More', 'shopme') ?></a>
				<?php endif; ?>

			</div>

			<div class="actions">

				<?php woocommerce_template_loop_price(); ?>

				<ul class="seller_stats">
					<li>
						<?php if ('yes' == get_option('woocommerce_manage_stock')): ?>
							<?php if ($product->is_in_stock()): ?>
								<?php $availability = sprintf(esc_html__('%s in stock', 'shopme'), $product->get_total_stock()); ?>
								<?php esc_html_e('Availability:', 'shopme'); ?>
								<span class="stock in-stock"><?php echo $availability; ?></span>
							<?php else: ?>
								<?php esc_html_e('Availability:', 'shopme'); ?>
								<span class="stock out-stock"><?php esc_html_e('out of stock', 'shopme') ?></span>
							<?php endif; ?>
						<?php endif; ?>
					</li>
				</ul>

				<ul class="buttons_col">
					<li><?php woocommerce_template_loop_add_to_cart(); ?></li>
					<li><?php do_action('shopme-product-actions-before'); ?></li>
					<li><?php do_action('shopme-product-actions-after'); ?></li>
				</ul><!--/ .buttons_col-->

				<?php do_action('shopme_woocommerce_append_actions'); ?>

			</div><!--/ .actions-->

			<?php
		}

		function woocommerce_category_image() {
			if ( is_product_category() ) {
				global $wp_query;
				$cat = $wp_query->get_queried_object();
				$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
				$image = wp_get_attachment_image_src($thumbnail_id, 'shop_catalog');
				$img_src = $image[0];
				if ( $img_src ) {
					echo '<div class="term-image">';
						echo '<img src="' . $img_src . '" alt="" />';
					echo '</div>';
				}
			}
		}

		function woocommerce_default_product_tabs( $tabs = array() ) {
			global $product, $post;

			// Description tab - shows product content
			if ( $post->post_excerpt ) {
				$tabs['description'] = array(
					'title'    => esc_html__( 'Description', 'shopme' ),
					'priority' => 10,
					'callback' => 'woocommerce_product_description_tab'
				);
			}

			// Additional information tab - shows attributes
			if ( $product && ( $product->has_attributes() || ( $product->enable_dimensions_display() && ( $product->has_dimensions() || $product->has_weight() ) ) ) ) {
				$tabs['additional_information'] = array(
					'title'    => esc_html__( 'Additional Information', 'shopme' ),
					'priority' => 20,
					'callback' => 'woocommerce_product_additional_information_tab'
				);
			}

			// Reviews tab - shows comments
			if ( comments_open() ) {
				$tabs['reviews'] = array(
					'title'    => sprintf( esc_html__( 'Reviews (%d)', 'shopme' ), $product->get_review_count() ),
					'priority' => 30,
					'callback' => 'comments_template'
				);
			}

			return $tabs;
		}

		function woocommerce_shop_before_hidden()   { echo '<div class="description">'; }
		function woocommerce_shop_after_hidden()    { echo '</div>'; }
		function woocommerce_shop_before_clearfix() { echo '<div class="clearfix product_info">'; }
		function woocommerce_shop_after_clearfix()  { echo '</div>'; }

		public function woocommerce_after_subcategory($category) {
			?>
			<div class="full_description">

				<a class="product-title" href="<?php echo esc_url(get_term_link( $category->slug, 'product_cat' )); ?>">
					<h4>
						<?php echo $category->name;

						if ( $category->count > 0 )
							echo apply_filters( 'woocommerce_subcategory_count_html', ' <span class="count">(' . $category->count . ')</span>', $category );
						?>
					</h4>
				</a>

				<?php
					$description = $category->description;

					if ( $description ) {
						echo '<div class="term-description">' . $description . '</div>';
					}
				?>
			</div>
			<?php
		}

		public function woo_product_settings_update() {

			$wc_product_settings = array(
				'woocommerce_default_country' => 'US:CA',
				'wc_currency_codes' => 'USD
				EUR
				GBP',
				'woocommerce_default_catalog_orderby' => 'menu_order',
				'woocommerce_currency' => 'USD',
				'woocommerce_shop_page_id' => '8',
				'woocommerce_cart_page_id' => '9',
				'woocommerce_checkout_page_id' => '10',
				'woocommerce_terms_page_id' => '866',
				'woocommerce_myaccount_page_id' => '11',
				'yith_wcwl_wishlist_page_id' => '250',
				'woocommerce_enable_myaccount_registration' => 1
			);

			foreach ($wc_product_settings as $key => $option) {
				update_option($key, $option);
			}

			$notices = array_diff( get_option( 'woocommerce_admin_notices', array() ), array( 'install', 'update' ) );
			update_option( 'woocommerce_admin_notices', $notices );
			delete_option( '_wc_needs_pages' );
			delete_transient( '_wc_activation_redirect' );

		}

	}

}