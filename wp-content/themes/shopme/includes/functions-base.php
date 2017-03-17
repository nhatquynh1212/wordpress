<?php

/*  Base Function Class
/* ---------------------------------------------------------------------- */

if (!class_exists('SHOPME_BASE_FUNCTIONS')) {

	class SHOPME_BASE_FUNCTIONS {

		protected static $_instance = null;

		function __construct() {

			add_action('after_setup_theme', array(&$this, 'after_setup_theme'));

			$this->load_textdomain();
			$this->init();

			/*  Init Classes
			/* ---------------------------------------------------------------------- */
			new SHOPME_PAGE();

		}

		/* 	After Setup Theme
		/* ---------------------------------------------------------------------- */

		public function after_setup_theme() {

			// Post Formats Support
			add_theme_support('post-formats', array( 'gallery', 'quote', 'video', 'audio' ));

			// Post Thumbnails Support
			add_theme_support('post-thumbnails');

			// Add default posts and comments RSS feed links to head
			add_theme_support('automatic-feed-links');

			add_theme_support('title-tag');

			add_filter( 'widget_text', 'do_shortcode' );

			// This theme uses wp_nav_menu() in one location.
			register_nav_menu( 'primary', 'Primary Menu' );
			register_nav_menu( 'secondary', 'Secondary Menu' );
			register_nav_menu( 'fullwidth', 'Fullwidth Menu' );
			register_nav_menu( 'topbar', 'Topbar Menu' );

			// Load theme textdomain
			self::load_textdomain();

			// Theme Activation
			self::theme_activation();
		}

		/* 	Initialization
		/* ---------------------------------------------------------------------- */

		public function init() {

			if (!is_admin()) {
				add_action('wp_enqueue_scripts', array(&$this, 'enqueue_styles_scripts'), 1);
				add_filter('body_class', array(&$this, 'body_class'), 5);
			}

		}

		function body_class($classes) {

			if ( shopme_custom_get_option('animation') ) {
				$classes[] = 'animated-content';
			}

			if ( shopme_custom_get_option('query-loader') ) {
				$classes[] = 'mad__queryloader';
			}

			$scheme = shopme_custom_get_option('color_scheme');
			if ( $scheme == null ) { $scheme = 'scheme_default'; }
			if ( $scheme ) { $classes[] = $scheme; }

			$before_content = mad_meta('shopme_before_content', '', get_the_ID());
			if ( $before_content && $before_content > 0 ) {
				$classes[] = 'is_before_content_page';
			}

			return $classes;
		}

		public function enqueue_styles_scripts() {
			$this->register_styles();
			$this->register_scripts();

			$this->enqueue_styles();
			$this->enqueue_scripts();

			self::localize_script();

			global $shopme_theme_data;
			$prefix_name = sanitize_file_name($shopme_theme_data['name']);

			if (get_option('exists_stylesheet'. $prefix_name ) == true) {
				$upload_dir = wp_upload_dir();
				if (is_ssl()) {
					$upload_dir['baseurl'] = str_replace("http://", "https://", $upload_dir['baseurl']);
				}
				$version = get_option('stylesheet_version' . $prefix_name);
				if (empty($version)) $version = '1';
				wp_enqueue_style( SHOPME_PREFIX . 'dynamic-styles', $upload_dir['baseurl'] . '/dynamic_shopme_dir/' . $prefix_name . '.css', array( SHOPME_PREFIX . 'woocommerce-mod' ), $version, 'all' );
			}
		}

		/* 	Theme Activation
		/* ---------------------------------------------------------------------- */

		public static function theme_activation() {
			global $pagenow;
			if (is_admin() && 'themes.php' == $pagenow && isset($_GET['activated'])) {
				do_action('shopme_backend_theme_activation');
				wp_redirect(admin_url('admin.php?page=shopme'));
			}
		}

		/* 	Register Theme Styles
		/* ---------------------------------------------------------------------- */

		public function register_styles() {
			wp_register_style( SHOPME_PREFIX . 'chosen-drop-down', SHOPME_BASE_URI . 'js/chosen/chosen.css' );
		}

		/* 	Register Theme Scripts
		/* ---------------------------------------------------------------------- */

		public function register_scripts() {
			wp_register_script( SHOPME_PREFIX . 'cookiealert', SHOPME_BASE_URI . 'js/cookiealert.js', array('jquery') );
			wp_register_script( SHOPME_PREFIX . 'chosen-drop-down', SHOPME_BASE_URI . 'js/chosen/chosen.jquery.min.js', array('jquery') );
		}

		/* 	WP Print Styles
		/* ---------------------------------------------------------------------- */

		public function enqueue_styles() {
			wp_enqueue_style( SHOPME_PREFIX . 'animate', SHOPME_BASE_URI . 'css/animate.css' );
			wp_enqueue_style( SHOPME_PREFIX . 'fontello', SHOPME_BASE_URI . 'css/fontello.css' );
			wp_enqueue_style( SHOPME_PREFIX . 'bootstrap', SHOPME_BASE_URI . 'css/bootstrap.min.css' );
			wp_enqueue_style( SHOPME_PREFIX . 'style', get_stylesheet_uri() );
			wp_enqueue_style( SHOPME_PREFIX . 'layout', SHOPME_BASE_URI . 'css/layout.css' );
			wp_enqueue_style( SHOPME_PREFIX . 'owlcarousel', SHOPME_BASE_URI . 'js/owlcarousel/owl.carousel.css' );
			wp_enqueue_style( SHOPME_PREFIX . 'scrollbar', SHOPME_BASE_URI . 'js/scrollbar/jquery.scrollbar.css' );
			wp_enqueue_style( SHOPME_PREFIX . 'magnific', SHOPME_BASE_URI . 'js/magnific-popup/magnific-popup.css' );

			$scheme = shopme_custom_get_option('color_scheme');
			if ($scheme == null) {
				$scheme = 'scheme_default';
			}

			if ( '' != $scheme ) {
				wp_enqueue_style( SHOPME_PREFIX . 'scheme-style', SHOPME_BASE_URI . "css/schemes/{$scheme}.css", array(
					SHOPME_PREFIX . 'style',
					SHOPME_PREFIX . 'woocommerce-mod',
					SHOPME_PREFIX . 'css_composer_front'
				) );
			}

			if ( is_rtl() ) {
				wp_enqueue_style( SHOPME_PREFIX . 'rtl',  SHOPME_BASE_URI . "css/rtl.css", array( SHOPME_PREFIX . 'style', SHOPME_PREFIX . 'woocommerce-mod' ), '1', 'all' );
			}

			wp_enqueue_style( SHOPME_PREFIX . 'oldie', SHOPME_BASE_URI .'css/oldie.css' );
			wp_style_add_data( SHOPME_PREFIX . 'oldie', 'conditional', 'lte IE 9' );
		}

		/*  WP Footer Action
		/* ---------------------------------------------------------------------- */

		public function enqueue_scripts() {

			if ( shopme_custom_get_option('query-loader') ) {
				wp_enqueue_script( SHOPME_PREFIX . 'queryloader', SHOPME_BASE_URI . 'js/queryloader2.min.js', array('jquery'), '', true );
			}

			wp_enqueue_script( SHOPME_PREFIX . 'modernizr', SHOPME_BASE_URI . 'js/modernizr.js' );
			wp_enqueue_script( SHOPME_PREFIX . 'plugins', SHOPME_BASE_URI . 'js/theme.plugins' . (WP_DEBUG ? '':'.min') . '.js', array('jquery'), '', true );
			wp_enqueue_script( SHOPME_PREFIX . 'owlcarousel', SHOPME_BASE_URI . 'js/owlcarousel/owl.carousel.min.js', array('jquery'), '', true );
			wp_enqueue_script( SHOPME_PREFIX . 'magnific', SHOPME_BASE_URI . 'js/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), '', true );
			wp_enqueue_script( SHOPME_PREFIX . 'raty', SHOPME_BASE_URI . 'js/jquery.raty.min.js', array('jquery'), '', true );
			wp_enqueue_script( SHOPME_PREFIX . 'core', SHOPME_BASE_URI . 'js/theme.core' . (WP_DEBUG ? '':'.min') . '.js', array('jquery'), '', true );
		}

		/* 	Localize Scripts
		/* ---------------------------------------------------------------------- */

		public function localize_script() {
			wp_localize_script('jquery', 'shopme_global', array(
				'template_directory' => SHOPME_BASE_URI,
				'site_url' => SHOPME_HOME_URL,
				'ajax_nonce' => wp_create_nonce('ajax-nonce'),
				'ajaxurl' => admin_url('admin-ajax.php'),
				'paththeme' => get_template_directory_uri(),
				'ajax_loader_url' => SHOPME_BASE_URI . 'images/ajax-loader@2x.gif',
				'smoothScroll' => shopme_custom_get_option('smooth_scroll', 1),
				'placeholder_text' => esc_html__('Select an Option', 'shopme')
			));
		}

		/* 	Load Textdomain
		/* ---------------------------------------------------------------------- */

		public static function load_textdomain () {
			load_theme_textdomain('shopme', SHOPME_BASE_PATH  . 'lang');
		}

		/* 	Helpers enqueue style & script methods
		/* ---------------------------------------------------------------------- */

		public static function enqueue_style($style)   { wp_enqueue_style( SHOPME_PREFIX . $style );   }
		public static function enqueue_script($script) { wp_enqueue_script( SHOPME_PREFIX . $script ); }

		/* 	Instance
		/* ---------------------------------------------------------------------- */

		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

	}

}