<?php

if (!class_exists('SHOPME_VC_CONFIG')) {

	class SHOPME_VC_CONFIG {

		public $paths = array();

		function __construct() {

			$dir = dirname(__FILE__);

			$this->paths = array(
				'APP_ROOT' => $dir,
				'APP_DIR' => basename( $dir ),
				'CONFIG_DIR' => $dir . '/config',
				'ASSETS_DIR_NAME' => 'assets',
				'BASE_URI' => SHOPME_BASE_URI . trailingslashit('config-composer'),
				'PARTS_VIEWS_DIR' => $dir . '/shortcodes/views/',
				'TEMPLATES_DIR' => $dir . '/shortcodes/templates/',
				'MODULES_DIR' => $dir . '/modules/'
			);

			// Add New param
			$this->add_shortcode_params();
			$this->add_hooks();

			// Load
			$this->autoloadLibraries($this->path('TEMPLATES_DIR'));
			$this->init();
		}

		public function init() {

			add_action('vc_build_admin_page', array(&$this, 'autoremoveElements'), 11);
			add_action('vc_load_shortcode', array(&$this, 'autoremoveElements'), 11);

			if ( is_admin() ) {
				add_action('load-post.php', array($this, 'admin_init') , 4);
				add_action('load-post-new.php', array($this, 'admin_init') , 4 );
			} else {
				add_action('wp_enqueue_scripts', array(&$this, 'front_init'), 1);
			}
		}

		public function add_hooks() {
			add_action('shopme_pre_import_hook', array(&$this, 'wpb_content_types'));
			add_action('vc_before_init', array(&$this, 'before_init'), 1);

			add_filter('vc_font_container_get_allowed_tags', array(&$this, 'font_container_get_allowed_tags'));
		}

		public function before_init() {
			require_once( $this->path('CONFIG_DIR', 'map.php') );
			$this->autoloadLibraries($this->path('MODULES_DIR'));
		}

		public $removeElements = array(
//			'vc_pie', 'vc_posts_grid', 'vc_single_image', 'vc_images_carousel',
//			'vc_posts_slider', 'vc_progress_bar', 'vc_carousel',
//			'vc_gmaps',

			'vc_gallery', 'vc_media_grid', 'vc_basic_grid',
			'mega_main_menu',

			'vc_masonry_media_grid', 'vc_masonry_grid',
			'vc_button2', 'vc_cta_button', 'vc_cta_button2',

			'products', 'product_attribute', 'recent_products', 'add_to_cart',
			'add_to_cart_url', 'product_category', 'product_categories', 'featured_products',
			'sale_products', 'best_selling_products', 'top_rated_products'
		);

		public function add_shortcode_params() {
			WpbakeryShortcodeParams::addField('choose_icons', array(&$this, 'param_icon_field'), $this->assetUrl('js/js_shortcode_param_icon.js'));
			WpbakeryShortcodeParams::addField('table_hidden', array(&$this, 'param_hidden_field'), $this->assetUrl('js/js_shortcode_tables.js'));
			WpbakeryShortcodeParams::addField('table_number', array(&$this, 'param_number_field'));
			WpbakeryShortcodeParams::addField('number', array(&$this, 'param_number_field'));
			WpbakeryShortcodeParams::addField('get_terms', array(&$this, 'param_woocommerce_terms'), $this->assetUrl('js/js_shortcode_products.js'));
			WpbakeryShortcodeParams::addField('get_by_id', array(&$this, 'param_woocommerce_get_by_id'), $this->assetUrl('js/js_shortcode_products.js'));
		}

		public function admin_init() {
			add_action('admin_enqueue_scripts', array(&$this, 'admin_extend_js_css'));
		}

		public function front_init() {
			$this->register_css();
			$this->front_js_register();
			$this->enqueue_styles();
			$this->front_extend_js_css();
		}

		public function admin_extend_js_css() {
			wp_enqueue_style( SHOPME_PREFIX . 'extend-admin', $this->assetUrl('css/js_composer_backend_editor.css'), false, WPB_VC_VERSION);
			wp_enqueue_style( SHOPME_PREFIX . 'fontello', $this->assetUrl('css/fontello.css'), false, WPB_VC_VERSION);
		}

		public function front_js_register() {
			wp_register_script( SHOPME_PREFIX . 'wpb_composer_front_js', $this->assetUrl('js/js_composer_front.js'), array( 'jquery' ), WPB_VC_VERSION, true );
		}

		public function front_extend_js_css() {
			wp_enqueue_script( SHOPME_PREFIX . 'wpb_composer_front_js' );
		}

		public function enqueue_styles() {
			wp_deregister_style('js_composer_front');
			wp_enqueue_style( SHOPME_PREFIX . 'css_composer_front');
		}

		public function register_css() {
			$front_css_file = $this->assetUrl('css/css_composer_front.css');
			wp_register_style(SHOPME_PREFIX . 'css_composer_front', $front_css_file, array(SHOPME_PREFIX . 'style'), WPB_VC_VERSION, 'all');
		}

		public function autoremoveElements() {
			$elements = $this->removeElements;

			foreach ($elements as $element) {
				vc_remove_element($element);
			}
		}

		protected function autoloadLibraries($path) {
			foreach (glob($path. '*.php') as $file) {
				require_once($file);
			}
		}

		public function assetUrl($file) {
			return $this->paths['BASE_URI'] . $this->path('ASSETS_DIR_NAME', $file);
		}

		public function path($name, $file = '') {
			$path = $this->paths[$name] . (strlen($file) > 0 ? '/' . preg_replace('/^\//', '', $file) : '');
			return apply_filters('vc_path_filter', $path);
		}

		function fieldAttachedImages( $att_ids = array() ) {
			$output = '';

			foreach ( $att_ids as $th_id ) {
				$thumb_src = wp_get_attachment_image_src( $th_id, 'thumbnail' );
				if ( $thumb_src ) {
					$thumb_src = $thumb_src[0];
					$output .= '
							<li class="added">
								<img rel="' . $th_id . '" src="' . $thumb_src . '" />
								<input type="text" name=""/>
								<a href="#" class="icon-remove"></a>
							</li>';
				}
			}
			if ( $output != '' ) {
				return $output;
			}
		}

		public function param_icon_field($settings, $value) {
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$icons = array('','icon-glass','icon-music','icon-search','icon-mail-alt','icon-camera','icon-camera-alt','icon-th-large','icon-th','icon-th-list','icon-help','icon-help-circled','icon-info-circled','icon-info','icon-home','icon-flag','icon-flag-empty','icon-flag-checkered','icon-thumbs-up','icon-thumbs-down','icon-share-squared','icon-pencil','icon-pencil-squared','icon-edit','icon-print','icon-trash','icon-doc','icon-docs','icon-doc-text','icon-doc-inv','icon-code','icon-retweet','icon-comment-1','icon-comment-alt','icon-left-open','icon-right-open','icon-down-circle','icon-left-circle','icon-progress-5','icon-progress-6','icon-progress-7','icon-font','icon-block','icon-resize-full','icon-resize-full-alt','icon-resize-small','icon-braille','icon-book','icon-adjust','icon-tint','icon-check','icon-check-empty','icon-asterisk','icon-gift','icon-fire','icon-magnet','icon-chart','icon-chart-circled','icon-credit-card','icon-megaphone','icon-clipboard','icon-hdd','icon-key','icon-certificate','icon-tasks','icon-filter','icon-gauge','icon-smiley','icon-smiley-circled','icon-address-book','icon-address-book-alt','icon-asl','icon-glasses','icon-hearing-impaired','icon-iphone-home','icon-person','icon-adult','icon-child','icon-blind','icon-guidedog','icon-accessibility','icon-universal-access','icon-male','icon-female','icon-behance','icon-blogger','icon-cc','icon-css','icon-delicious','icon-deviantart','icon-digg','icon-dribbble','icon-facebook','icon-flickr','icon-foursquare','icon-friendfeed','icon-friendfeed-rect','icon-github','icon-github-text','icon-googleplus','icon-instagram','icon-linkedin','icon-path','icon-picasa','icon-pinterest','icon-reddit','icon-skype-1','icon-slideshare','icon-stackoverflow','icon-stumbleupon','icon-twitter','icon-tumblr','icon-vimeo','icon-vkontakte','icon-w3c','icon-wordpress','icon-youtube-1','icon-music','icon-search-1','icon-mail-1','icon-heart','icon-star','icon-user','icon-videocam','icon-camera-1','icon-photo','icon-attach','icon-lock','icon-eye','icon-tag-1','icon-thumbs-up-1','icon-pencil-1','icon-comment','icon-location','icon-cup','icon-trash-1','icon-doc-1','icon-note','icon-cog','icon-params','icon-calendar','icon-sound','icon-clock','icon-lightbulb','icon-tv','icon-desktop','icon-mobile','icon-cd','icon-inbox','icon-globe','icon-cloud','icon-paper-plane','icon-fire-1','icon-graduation-cap','icon-megaphone-1','icon-database','icon-key-1','icon-beaker','icon-truck','icon-money','icon-food','icon-shop','icon-diamond','icon-t-shirt','icon-wallet','icon-search-2','icon-mail-2','icon-heart-1','icon-heart-empty','icon-star-1','icon-user-1','icon-video','icon-picture','icon-th-large-1','icon-th-1','icon-th-list-1','icon-ok','icon-ok-circle','icon-cancel','icon-cancel-circle','icon-plus-circle','icon-minus-circle','icon-link','icon-attach-1','icon-lock-1','icon-lock-open','icon-chat','icon-attention','icon-location-1','icon-doc-2','icon-docs-landscape','icon-folder','icon-archive','icon-rss','icon-rss-alt','icon-cog-1','icon-logout','icon-clock-1','icon-right-circle','icon-up-circle','icon-down-dir','icon-right-dir','icon-down-micro','icon-up-micro','icon-cw-circle','icon-arrows-cw','icon-updown-circle','icon-target','icon-signal','icon-progress-0','icon-list','icon-list-numbered','icon-indent-left','icon-indent-right','icon-cloud-1','icon-terminal','icon-facebook-rect','icon-twitter-bird','icon-vimeo-rect','icon-tumblr-rect','icon-googleplus-rect','icon-linkedin-rect','icon-resize-vertical','icon-resize-horizontal','icon-move','icon-zoom-in','icon-zoom-out','icon-down-open','icon-left-open-1','icon-right-open-1','icon-up-open','icon-down','icon-left','icon-right','icon-up','icon-down-circled','icon-left-circled','icon-right-circled','icon-up-circled','icon-down-hand','icon-left-hand','icon-right-hand','icon-up-hand','icon-cw','icon-cw-circled','icon-arrows-cw-1','icon-shuffle','icon-play','icon-play-circled','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');

			ob_start(); ?>

			<input type="hidden" name="<?php echo esc_attr($param_name) ?>" class="wpb_vc_param_value <?php echo esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) ?> " value="<?php echo esc_attr($value) ?>" id="mad-trace" />
			<div class="mad-icon-preview"><i class="<?php echo esc_attr($value) ?>"></i></div>
			<input class="mad-search" type="text" placeholder="Search icon" />
			<div id="mad-icon-dropdown">
				<ul class="mad-icon-list">

					<?php foreach ($icons as $icon): ?>
						<?php if (!empty($icon)): ?>
						<?php $selected = ($icon == $value) ? 'class="selected"' : ''; ?>
						<li <?php echo $selected ?> data-icon="<?php echo esc_attr($icon) ?>"><i class="mad-icon <?php echo esc_attr($icon) ?>"></i></li>
						<?php endif; ?>
					<?php endforeach; ?>

				</ul><!--/ .mad-icon-list-->
			</div><!--/ #mad-icon-dropdown-->

			<?php return ob_get_clean();
		}

		function param_hidden_field($settings, $value) {
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			ob_start(); ?>
			<input type="hidden" name="<?php echo esc_attr($param_name) ?>" class="wpb_vc_param_value wpb_el_type_table_hidden <?php echo $param_name . ' ' . $type . ' ' . $class ?>" value="<?php echo trim($value) ?>" />
			<?php return ob_get_clean();
		}

		function param_number_field($settings, $value) {
			ob_start(); ?>
			<div class="mad_number_block">
				<input id="<?php echo esc_attr($settings['param_name']) ?>" name="<?php echo esc_attr($settings['param_name']) ?>" class="wpb_vc_param_value wpb-number <?php echo esc_attr($settings['param_name']) . ' ' . esc_attr($settings['type']) . '_field'  ?>" type="number" value="<?php echo esc_attr($value) ?>"/>
			</div><!--/ .mad_number_block-->
			<?php return ob_get_clean();
		}

		function get_product_terms( $term_id, $tax, $inserted_vals ) {
			$html = $selected = '';
			$args = array( 'hide_empty' => 0, 'parent' => $term_id );
			$terms = get_terms($tax, $args);

			foreach ($terms as $term) {
				$html .= '<li><a ';

					if ( in_array($term->term_id, $inserted_vals) ) {
						$html .= ' class="selected"';
					}

					$html .= 'data-val="'. $term->term_id .'" title="'. $term->term_id .'" href="javascript:void(0);">' . $term->name . '</a>';

					if ( $list = $this->get_product_terms( $term->term_id, $tax, $inserted_vals )) {
						$html .= '<ul class="second_level">'. $list .'</ul>';
					}

				$html .= '</li>';
			}
			return $html;
		}

		function param_woocommerce_terms($settings, $value) {

			$html = '';
			$terms = get_terms($settings["term"], array( 'hide_empty' => 0, 'parent' => 0 ));
			$inserted_vals = explode(',', $value);

			ob_start(); ?>

			<input type="text" value="<?php echo esc_attr($value) ?>" name="<?php echo esc_attr($settings['param_name']) ?>" class="wpb_vc_param_value wpb-input mad-custom-val <?php echo esc_attr($settings['param_name']) . ' ' . esc_attr($settings['type']) ?>" id="<?php echo esc_attr($settings['param_name']); ?>">

			<div class="mad-custom-wrapper">

				<ul class="mad-custom">

					<?php

						foreach ($terms as $term) {
							$html .= '<li class="top_li">';

								$html .= '<a ';

								if ( in_array($term->term_id, $inserted_vals) ) {
									$html .= ' class="selected"';
								}

								$html .= 'data-val="'. $term->term_id .'" title="'. $term->term_id .'" href="javascript:void(0);">' . $term->name . '</a>';

								if ( $list = $this->get_product_terms( $term->term_id, $settings['term'], $inserted_vals )) {
									$html .= '<ul class="second_level">'. $list .'</ul>';
								}

							$html .= '</li>';
						}
						echo $html;
					?>

				</ul><!--/ .mad-custom-->

			</div><!--/ .mad-custom-wrapper-->

			<?php return ob_get_clean();
		}

		public function param_woocommerce_get_by_id($settings, $value) {

			$html = '';
			$inserted_vals = explode(',', $value);

			$args = array(
				'post_type' => $settings["post_type"],
				'numberposts' => -1
			);

			$posts = get_posts( $args );

			ob_start(); ?>

			<input type="text" value="<?php echo esc_attr($value) ?>" name="<?php echo esc_attr($settings['param_name']) ?>" class="wpb_vc_param_value wpb-input mad-custom-val <?php echo esc_attr($settings['param_name']) . ' ' . esc_attr($settings['type']) ?>" id="<?php echo esc_attr($settings['param_name']); ?>">

			<div class="mad-custom-wrapper">

				<ul class="mad-custom">

					<?php

					foreach ($posts as $post) {
						$html .= '<li class="top_li">';

						$html .= '<a ';

						if ( in_array($post->ID, $inserted_vals) ) {
							$html .= ' class="selected"';
						}

						$html .= 'data-val="'. $post->ID .'" title="'. $post->ID .'" href="javascript:void(0);">' . $post->post_title . '</a>';

						$html .= '</li>';
					}

					if ($html != '') { echo $html; }
					?>

				</ul><!--/ .mad-custom-->

			</div><!--/ .mad-custom-wrapper-->

			<?php return ob_get_clean();
		}

		public static function array_number($from = 0, $to = 50, $step = 1, $array = array()) {
			for ($i = $from; $i <= $to; $i += $step) {
				$array[$i] = $i;
			}
			return $array;
		}

		public static function get_order_sort_array() {
			return array('ID' => 'ID', 'date' => 'date', 'post_date' => 'post_date', 'title' => 'title',
				'post_title' => 'post_title', 'name' => 'name', 'post_name' => 'post_name', 'modified' => 'modified',
				'post_modified' => 'post_modified', 'modified_gmt' => 'modified_gmt', 'post_modified_gmt' => 'post_modified_gmt',
				'menu_order' => 'menu_order', 'parent' => 'parent', 'post_parent' => 'post_parent',
				'rand' => 'rand', 'comment_count' => 'comment_count', 'author' => 'author', 'post_author' => 'post_author');
		}

		public static function count_posts($type_post) {
			if (!isset($type_post)) {
				$type_post = 'post';
			}
			$count_posts = wp_count_posts($type_post);
			$published_posts = $count_posts->publish;
			return $published_posts;
		}

		public function font_container_get_allowed_tags($allowed_tags) {
			array_unshift($allowed_tags, 'h1');
			return $allowed_tags;
		}

		public function wpb_content_types() {
			$wpb_content_types = array( 'post', 'page', 'product', 'testimonials' );
			update_option('wpb_js_content_types', $wpb_content_types);
		}

		public static function create_data_string($data = array()) {
			$data_string = "";

			if (empty($data)) return;

			foreach ($data as $key => $value) {
				if (is_array($value)) $value = implode(", ", $value);
				$data_string .= " data-$key={$value} ";
			}
			return $data_string;
		}

	}

	new SHOPME_VC_CONFIG();
}