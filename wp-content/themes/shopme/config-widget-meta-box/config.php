<?php

if (!class_exists('SHOPME_WIDGETS_META_BOX')) {

	class SHOPME_WIDGETS_META_BOX {

		public $paths = array();

		public function path($name, $file = '') {
			return $this->paths[$name] . (strlen($file) > 0 ? '/' . preg_replace('/^\//', '', $file) : '');
		}

		public function assetUrl($file)  {
			return $this->paths['BASE_URI'] . $this->path('ASSETS_DIR_NAME', $file);
		}

		function __construct () {
			$dir = dirname(__FILE__);

			$this->paths = array(
				'PHP' => $dir . '/' . trailingslashit('php'),
				'ASSETS_DIR_NAME' => 'assets',
				'BASE_URI' => SHOPME_BASE_URI . trailingslashit('config-widget-meta-box')
			);

			$this->init();
		}

		public function init() {
			if (is_admin()) {
				add_action('add_meta_boxes', array(&$this, 'add_meta_box') );
				add_action('save_post', array(&$this, 'save_post'));
				add_action('load-post.php', array($this, 'admin_enqueue_scripts'));
				add_action('load-post-new.php', array($this, 'admin_enqueue_scripts'));
				add_action('admin_enqueue_scripts', array(&$this, 'add_json') );
			} else {

			}
		}

		public function admin_enqueue_scripts() {
			$css_file = $this->assetUrl('css/widget-meta-box.css');
			$js_file = $this->assetUrl('js/widget-meta-box.js');

			wp_enqueue_style( SHOPME_PREFIX . 'widget-meta-box', $css_file );
			wp_enqueue_script( SHOPME_PREFIX . 'widget-meta-box', $js_file, array('jquery'), 1, true );
		}

		public function add_meta_box() {
			add_meta_box("shopme_widets_footer_meta_box", esc_html__("Widgets Row Footer", 'shopme'), array(&$this, 'draw_widgets_meta_box' ), "page", "normal", "low");
		}

		public function add_json() {
			$output = "\n<script type='text/html' id='tmpl-options-hidden'>";
			$output .= json_encode($this->columns_grid());
			$output .= "\n</script>\n";
			echo $output;
		}

		public function columns_grid() {
			return array( "1" => array( array( "12" ) ) ,
						  "2" => array( array( "6", "6" ) ) ,
						  "3" => array( array( "4", "4", "4" ) , array( "3", "6", "3") ) ,
						  "4" => array( array( "3", "3", "3", "3" ), array( "5", "3", "2", "2" ) ),
						  "5" => array( array( "3", "2", "2", "2", "3" ) )
			);
		}

		public static function get_settings_from_post_meta($post_id) {

			$footer_row_top_show = get_post_meta($post_id, 'footer_row_top_show', true);
			$footer_row_middle_show = get_post_meta($post_id, 'footer_row_middle_show', true);
			$footer_row_bottom_show = get_post_meta($post_id, 'footer_row_bottom_show', true);

			$get_sidebars_top_widgets = get_post_meta($post_id, 'get_sidebars_top_widgets', true);
			$get_sidebars_middle_widgets = get_post_meta($post_id, 'get_sidebars_middle_widgets', true);
			$get_sidebars_bottom_widgets = get_post_meta($post_id, 'get_sidebars_bottom_widgets', true);

			$footer_row_top_columns_variations = get_post_meta($post_id, 'footer_row_top_columns_variations', true);
			$footer_row_middle_columns_variations = get_post_meta($post_id, 'footer_row_middle_columns_variations', true);
			$footer_row_bottom_columns_variations = get_post_meta($post_id, 'footer_row_bottom_columns_variations', true);

			return array($footer_row_top_show, $footer_row_middle_show, $footer_row_bottom_show, $get_sidebars_top_widgets, $get_sidebars_middle_widgets, $get_sidebars_bottom_widgets, $footer_row_top_columns_variations, $footer_row_middle_columns_variations, $footer_row_bottom_columns_variations);
		}

		public function get_page_settings($post_id) {
			$custom = get_post_custom($post_id);

			$data = array();

			$data['columns_variations'] = $this->columns_grid();

			$data['footer_row_top_show'] = @$custom["footer_row_top_show"][0];
			$data['footer_row_middle_show'] = @$custom["footer_row_middle_show"][0];
			$data['footer_row_bottom_show'] = @$custom["footer_row_bottom_show"][0];

			$data['footer_row_top_columns_variations'] = @$custom["footer_row_top_columns_variations"][0];
			$data['footer_row_middle_columns_variations'] = @$custom["footer_row_middle_columns_variations"][0];
			$data['footer_row_bottom_columns_variations'] = @$custom["footer_row_bottom_columns_variations"][0];

			$data['get_sidebars_top_widgets'] = @$custom["get_sidebars_top_widgets"][0];
			$data['get_sidebars_middle_widgets'] = @$custom["get_sidebars_middle_widgets"][0];
			$data['get_sidebars_bottom_widgets'] = @$custom["get_sidebars_bottom_widgets"][0];

			if ($data['footer_row_top_columns_variations'] == null) {
				$data['footer_row_top_columns_variations'] = shopme_custom_get_option('footer_row_top_columns_variations');
			}

			if ($data['footer_row_middle_columns_variations'] == null) {
				$data['footer_row_middle_columns_variations'] = shopme_custom_get_option('footer_row_middle_columns_variations');
			}

			if ($data['footer_row_bottom_columns_variations'] == null) {
				$data['footer_row_bottom_columns_variations'] = shopme_custom_get_option('footer_row_bottom_columns_variations');
			}

			$footer_row_top_show = (shopme_custom_get_option('show_row_top_widgets') != '0') ? 'yes' : 'no';
			$footer_row_middle_show = (shopme_custom_get_option('show_row_middle_widgets') != '0') ? 'yes' : 'no';
			$footer_row_bottom_show = (shopme_custom_get_option('show_row_bottom_widgets') != '0') ? 'yes' : 'no';

			if ($data["footer_row_top_show"] == null) {
				$data['footer_row_top_show'] = $footer_row_top_show;
			}

			if ($data["footer_row_middle_show"] == null) {
				$data['footer_row_middle_show'] = $footer_row_middle_show;
			}

			if ($data["footer_row_bottom_show"] == null) {
				$data['footer_row_bottom_show'] = $footer_row_bottom_show;
			}

			if ($data['get_sidebars_top_widgets'] == null) {
				$data['get_sidebars_top_widgets'] = 'a:5:{i:0;s:21:"Footer Row - widget 1";i:1;s:21:"Footer Row - widget 2";i:2;s:21:"Footer Row - widget 3";i:3;s:21:"Footer Row - widget 4";i:4;s:21:"Footer Row - widget 5";}';
			}

			if ($data['get_sidebars_middle_widgets'] == null) {
				$data['get_sidebars_middle_widgets'] = 'a:5:{i:0;s:22:"Footer Row - widget 17";i:1;s:21:"Footer Row - widget 9";i:2;s:21:"Footer Row - widget 1";i:3;s:21:"Footer Row - widget 1";i:4;s:21:"Footer Row - widget 1";}';
			}

			if ($data['get_sidebars_middle_widgets'] == null) {
				$data['get_sidebars_bottom_widgets'] = 'a:5:{i:0;s:21:"Footer Row - widget 6";i:1;s:21:"Footer Row - widget 7";i:2;s:21:"Footer Row - widget 8";i:3;s:21:"Footer Row - widget 9";i:4;s:22:"Footer Row - widget 10";}';
			}

			$data['get_sidebars'] = $this->get_registered_sidebars();
			$data['columns'] = 5;
			return $data;
		}

		public function get_registered_sidebars() {
			$registered_sidebars = SHOPME_HELPER::get_registered_sidebars();
			$registered_footer_sidebars = array();

			foreach($registered_sidebars as $key => $value) {
				if (strpos($key, 'Footer Row') !== false) {
					$registered_footer_sidebars[$key] = $value;
				}
			}
			return $registered_footer_sidebars;
		}

		public function draw_widgets_meta_box() {
			global $post;

			// Use nonce for verification
			wp_nonce_field( 'shopme-post-meta-box', 'shopme-post-meta-box-nonce' );

			$data = $this->get_page_settings($post->ID);
			echo $this->draw_page($this->path('PHP', 'meta_box.php'), $data);
		}

		public function save_post($post_id) {
			global $post;

			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
				return;

			if ( !isset( $_POST['shopme-post-meta-box-nonce'] ) )
				return;

			if ( !wp_verify_nonce( $_POST['shopme-post-meta-box-nonce'], 'shopme-post-meta-box' ) )
				return;

			if (is_object($post) AND !empty($_POST)) {
				update_post_meta($post_id, "footer_row_top_show", @$_POST["footer_row_top_show"]);
				update_post_meta($post_id, "footer_row_middle_show", @$_POST["footer_row_middle_show"]);
				update_post_meta($post_id, "footer_row_bottom_show", @$_POST["footer_row_bottom_show"]);

				update_post_meta($post_id, "footer_row_top_columns_variations", @$_POST["footer_row_top_columns_variations"]);
				update_post_meta($post_id, "footer_row_middle_columns_variations", @$_POST["footer_row_middle_columns_variations"]);
				update_post_meta($post_id, "footer_row_bottom_columns_variations", @$_POST["footer_row_bottom_columns_variations"]);

				update_post_meta($post_id, "get_sidebars_top_widgets", @$_POST["get_sidebars_top_widgets"]);
				update_post_meta($post_id, "get_sidebars_middle_widgets", @$_POST["get_sidebars_middle_widgets"]);
				update_post_meta($post_id, "get_sidebars_bottom_widgets", @$_POST["get_sidebars_bottom_widgets"]);
			}
		}

		public function draw_page($pagepath, $data = array()) {
			@extract($data);
			ob_start();
			include $pagepath;
			return ob_get_clean();
		}

	}

	new SHOPME_WIDGETS_META_BOX();

}