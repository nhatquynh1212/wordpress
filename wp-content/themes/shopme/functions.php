<?php
/**
 * Shopme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @since Shopme 1.0
 */

/* 	Basic Settings
/* ---------------------------------------------------------------------- */

define('SHOPME_THEMENAME', 'Shopme');
define('SHOPME_THEME_VERSION', '1.1.7');
define('SHOPME_PREFIX', 'shopme-');

define('SHOPME_HOME_URL', get_home_url('/'));
define('SHOPME_BASE_URI', trailingslashit(get_template_directory_uri()));
define('SHOPME_BASE_PATH', trailingslashit(get_template_directory()));
define('SHOPME_ADMIN_PATH', SHOPME_BASE_PATH . trailingslashit('admin'));
define('SHOPME_FRAMEWORK_PATH', SHOPME_ADMIN_PATH . trailingslashit('framework'));

define('SHOPME_INC_PATH', SHOPME_BASE_PATH . trailingslashit('inc'));
define('SHOPME_INC_URI', SHOPME_BASE_URI . trailingslashit('inc'));

define('SHOPME_INC_PLUGINS_PATH', SHOPME_INC_PATH . 'plugins/');
define('SHOPME_INC_PLUGINS_URI', SHOPME_INC_URI . 'plugins/');

define('SHOPME_INCLUDES_URI', SHOPME_BASE_URI . trailingslashit('includes'));
define('SHOPME_INCLUDES_PATH', SHOPME_BASE_PATH . trailingslashit('includes'));

define('SHOPME_INCLUDE_CLASSES_PATH', trailingslashit(SHOPME_INCLUDES_PATH) . trailingslashit('classes'));
define('SHOPME_BASE_HELPERS', SHOPME_INCLUDES_PATH . trailingslashit('helpers'));

define('SHOPME_INCLUDES_METABOXES_PATH', SHOPME_INCLUDES_PATH . trailingslashit('meta-box'));
define('SHOPME_INCLUDES_METABOXES_URI', SHOPME_INCLUDES_URI . trailingslashit('meta-box'));

if ( !isset( $content_width ) ) $content_width = 1140;

/*  Add Widgets
/* ---------------------------------------------------------------------- */

include( SHOPME_INCLUDES_PATH . 'widgets/latest-tweets-widget/latest-tweets.php');
require_once( SHOPME_INCLUDES_PATH . 'widgets/abstract-widget.php' );
require_once( SHOPME_INCLUDES_PATH . 'widgets.php' );

/* Load Theme Helpers
/* ---------------------------------------------------------------------- */
require_once( SHOPME_BASE_HELPERS . 'aq_resizer.php' );
require_once( SHOPME_BASE_HELPERS . 'nav-walker.php' );
require_once( SHOPME_BASE_HELPERS . 'theme-helper.php' );
require_once( SHOPME_BASE_HELPERS . 'post-format-helper.php' );

/*  Load Classes
/* ---------------------------------------------------------------------- */

if ( ! function_exists('shopme_base_functions') ) {

	function shopme_base_functions() {
		// Load required classes and functions
		require_once( SHOPME_INCLUDE_CLASSES_PATH . 'register-page.class.php' );
		require_once( SHOPME_INCLUDES_PATH . 'functions-base.php' );
		return SHOPME_BASE_FUNCTIONS::instance();
	}

}

/**
 * Instance main plugin class
 */
global $shopme_base_functions;
$shopme_base_functions = shopme_base_functions();

/*  Load Functions Files
/* ---------------------------------------------------------------------- */
require_once( SHOPME_INCLUDES_PATH . 'functions-core.php' );
require_once( SHOPME_INCLUDES_PATH . 'functions-template.php' );

/*  Metadata
/* ---------------------------------------------------------------------- */
require_once( SHOPME_INCLUDES_PATH . 'functions-metadata.php' );

/*  Include Framework
/* ---------------------------------------------------------------------- */
require_once( SHOPME_FRAMEWORK_PATH . 'framework.php' );

/*  Load hooks
/* ---------------------------------------------------------------------- */
if (!is_admin()) {
	require_once( SHOPME_INCLUDES_PATH . 'templates-hooks.php' );
}

/*  Include Plugins
/* ---------------------------------------------------------------------- */
require_once( SHOPME_BASE_PATH . 'admin/plugin-bundle.php' );
require_once( SHOPME_BASE_PATH . 'config-plugins/config.php');
require_once( SHOPME_INC_PLUGINS_PATH . 'plugins.php' );

/*  Add Meta Boxes
/* ---------------------------------------------------------------------- */
require_once( get_template_directory() . '/includes/metaboxes/metaboxes.php' );

/*  Include Config Widget Meta Box
/* ---------------------------------------------------------------------- */

require_once( SHOPME_BASE_PATH . 'config-widget-meta-box/config.php' );

/*  Include Config Composer
/* ---------------------------------------------------------------------- */

if (class_exists('Vc_Manager')) {
	require_once( SHOPME_BASE_PATH . 'config-composer/config.php');
}

/*  Include Config DHVC Forms
/* ---------------------------------------------------------------------- */

if (defined('WPCF7_VERSION')) {
	require_once( SHOPME_BASE_PATH . 'config-contact-form-7/config.php' );
}

/*  Include Config WooCommerce
/* ---------------------------------------------------------------------- */

if (class_exists('WooCommerce')) {

	if ( ! function_exists('shopme_woo_config') ) {

		function shopme_woo_config() {
			// Load required classes and functions
			shopme_get_template( 'config-woocommerce/config.php' );
			return SHOPME_WOOCOMMERCE_CONFIG::instance();
		}

		/**
		 * Instance main plugin class
		 */
		shopme_woo_config();

	}
}

/*  Include Config Mega Menu
/* ---------------------------------------------------------------------- */

if ( class_exists('mega_main_init') ) {
	if ( shopme_custom_get_option('compatible_with_mega_menu') ) {
		require_once( SHOPME_BASE_PATH . 'config-megamenu/config.php' );
	}
}

/*  Include Config WPML
/* ---------------------------------------------------------------------- */

if ( defined('ICL_SITEPRESS_VERSION') ) {
	require_once( SHOPME_BASE_PATH . 'config-wpml/config.php' );
}

/*  Is shop installed
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_is_shop_installed')) {
	function shopme_is_shop_installed() {
		global $woocommerce;
		if ( isset( $woocommerce ) ) {
			return true;
		} else {
			return false;
		}
	}
}

/*  Is product
/* ---------------------------------------------------------------------- */

if ( ! function_exists('shopme_is_product') ) {
	function shopme_is_product() {
		return is_singular( array( 'product' ) );
	}
}

/*  Is product category
/* ---------------------------------------------------------------------- */

if ( ! function_exists('shopme_is_product_category') ) {
	function shopme_is_product_category( $term = '' ) {
		return is_tax( 'product_cat', $term );
	}
}

/*  Is product tag
/* ---------------------------------------------------------------------- */

if ( ! function_exists('shopme_is_product_tag') ) {
	function shopme_is_product_tag( $term = '' ) {
		return is_tax( 'product_tag', $term );
	}
}

/*  Get user name
/* ---------------------------------------------------------------------- */

if (!function_exists("shopme_get_user_name")) {
	function shopme_get_user_name($current_user) {

		if (!$current_user->user_firstname && !$current_user->user_lastname) {

			if (shopme_is_shop_installed()) {

				$firstname_billing = get_user_meta($current_user->ID, "billing_first_name", true);
				$lastname_billing = get_user_meta($current_user->ID, "billing_last_name", true);

				if (!$firstname_billing && !$lastname_billing) {
					$user_name = $current_user->user_nicename;
				} else {
					$user_name = $firstname_billing . ' ' . $lastname_billing;
				}

			} else {
				$user_name = $current_user->user_nicename;
			}

		} else {
			$user_name = $current_user->user_firstname . ' ' . $current_user->user_lastname;
		}

		return $user_name;
	}
}

/*  Generate Dynamic Styles
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_dynamic_styles')) {
	function shopme_dynamic_styles() {
		require_once( SHOPME_FRAMEWORK::$path['frameworkPHP'] . 'register-dynamic-styles.php' );
		shopme_pre_dynamic_stylesheet();
	}
	add_action('init', 'shopme_dynamic_styles', 15);
	add_action('admin_init', 'shopme_dynamic_styles', 15);
}

if (!function_exists('shopme_generate_styles')) {

	function shopme_generate_styles() {
		$globalObject = $GLOBALS['shopme_global_data'];
		$globalObject->reset_options();
		$prefix_name = sanitize_file_name($globalObject->theme_data['name']);

		shopme_pre_dynamic_stylesheet();
		$generate_styles = new SHOPME_DYNAMIC_STYLES(false);
		$styles = $generate_styles->create_styles();

		$wp_upload_dir = wp_upload_dir();
		$stylesheet_dynamic_dir = $wp_upload_dir['basedir'] . '/dynamic_shopme_dir';
		$stylesheet_dynamic_dir = str_replace('\\', '/', $stylesheet_dynamic_dir);
		shopme_backend_create_folder($stylesheet_dynamic_dir);

		$stylesheet = trailingslashit($stylesheet_dynamic_dir) . $prefix_name.'.css';
		$create = shopme_write_to_file($stylesheet, $styles, true);

		if ($create === true) {
			update_option('exists_stylesheet' . $prefix_name, true);
			update_option('stylesheet_version' . $prefix_name, uniqid());
		}
	}

	add_action('shopme_ajax_after_save_options_page', 'shopme_generate_styles', 25);
	add_action('shopme_after_import_hook', 'shopme_generate_styles', 28);

}