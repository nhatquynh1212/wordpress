<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Shopme for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'shopme_register_required_plugins' );

if (!function_exists('shopme_added_admin_action')) {

	function shopme_added_admin_action() {
		add_action( 'admin_enqueue_scripts', 'shopme_added_plugin_style' );
	}

	function shopme_added_plugin_style() {
		wp_enqueue_style( SHOPME_PREFIX . 'admin_plugins', SHOPME_BASE_URI . 'css/admin-plugin.css', array() );
	}

	add_action( 'load-plugins.php', 'shopme_added_admin_action', 1 );

}

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function shopme_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(


		array(
			'name'      => 'Social Login',
			'slug'      => 'oa-social-login',
			'required'           => false,
			'version'            => '',
			'force_activation'   => false,
			'force_deactivation' => false
		),

		array(
			'name'     => 'Woocommerce',
			'slug'     => 'woocommerce',
			'required' => false
		),

		array(
			'name'     => 'Yith Woocommerce Ajax Search',
			'slug'     => 'yith-woocommerce-ajax-search',
			'required' => false
		),

		array(
			'name'     => 'YITH WooCommerce Compare',
			'slug'     => 'yith-woocommerce-compare',
			'required' => false
		),

		array(
			'name'     => 'Yith WooCommerce Wishlist',
			'slug'     => 'yith-woocommerce-wishlist',
			'required' => false
		),

		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => false
		),

		array(
			'name'      => 'WC Vendors',
			'slug'      => 'wc-vendors',
			'required'  => false,
			'force_activation'   => false,
			'force_deactivation' => false
		),

		// This is an example of how to include a plugin from the WordPress Plugin Repository.

		array(
			'name'               => 'Shopme Content Types',
			'slug'               => 'shopme-content-types',
			'source'             => 'http://velikorodnov.com/wordpress/sample-data/shopme/pluginus2/shopme-content-types.zip',
			'required'           => false,
			'version'            => '1.0.4',
			'force_activation'   => false,
			'force_deactivation' => false
		),

		array(
			'name'               => 'Indeed Smart PopUp',
			'slug'               => 'indeed-smart-popup',
			'source'             => 'http://velikorodnov.com/wordpress/sample-data/shopme/pluginus2/indeed-smart-popup.zip',
			'required'           => false,
			'version'            => '4.6',
			'force_activation'   => false,
			'force_deactivation' => false
		),

		array(
			'name'               => 'LayerSlider WP',
			'slug'               => 'LayerSlider',
			'source'             => 'http://velikorodnov.com/wordpress/sample-data/shopme/pluginus2/LayerSlider.zip',
			'required'           => false,
			'version'            => '6.1.0',
			'force_activation'   => false,
			'force_deactivation' => false
		),

		array(
			'name'               => 'Slider Revolution',
			'slug'               => 'revslider',
			'source'             => 'http://velikorodnov.com/wordpress/sample-data/shopme/pluginus2/revslider.zip',
			'required'           => false,
			'version'            => '5.3.1.5',
			'force_activation'   => false,
			'force_deactivation' => false
		),

		array(
			'name'               => 'WOOF - WooCommerce Products Filter',
			'slug'               => 'woocommerce-products-filter',
			'source'             => 'http://velikorodnov.com/wordpress/sample-data/plugins/woocommerce-products-filter.zip',
			'required'           => false,
			'version'            => '2.1.6.1',
			'force_activation'   => false,
			'force_deactivation' => false
		),

		array(
			'name'               => 'Envato Wordpress Toolkit Master',
			'slug'               => 'envato-wordpress-toolkit-master',
			'source'             => 'http://velikorodnov.com/wordpress/sample-data/plugins/envato-wordpress-toolkit-master.zip',
			'required'           => false,
			'version'            => '1.7.3',
			'force_activation'   => false,
			'force_deactivation' => false
		),

		array(
			'name'               => 'Rich Snippets Wordpress Plugin',
			'slug'               => 'rich-snippets-wordpress-plugin',
			'source'             => 'http://velikorodnov.com/wordpress/sample-data/plugins/rich-snippets-wordpress-plugin.zip',
			'required'           => false,
			'version'            => '1.6.1',
			'force_activation'   => false,
			'force_deactivation' => false
		),

		array(
			'name'               => 'WooCommerce Prices By User Role',
			'slug'               => 'woocommerce-prices-by-user-role',
			'source'             => 'http://velikorodnov.com/wordpress/sample-data/plugins/woocommerce-prices-by-user-role.zip',
			'required'           => false,
			'version'            => '2.7.1',
			'force_activation'   => false,
			'force_deactivation' => false
		),

		array(
			'name'               => 'Woo Sale Revolution:Flash Sale + Dynamic Discounts',
			'slug'               => 'woo-sale-revolution-flashsale',
			'source'             => 'http://velikorodnov.com/wordpress/sample-data/plugins/woo-sale-revolution-flashsale.zip',
			'required'           => false,
			'version'            => '2.7',
			'force_activation'   => false,
			'force_deactivation' => false
		),

		array(
			'name'               => 'Mega Main Menu',
			'slug'               => 'mega-main-menu',
			'source'             => 'http://velikorodnov.com/wordpress/sample-data/plugins/mega_main_menu.zip',
			'required'           => false,
			'version'            => '2.1.2',
			'force_activation'   => false,
			'force_deactivation' => false
		),

		array(
			'name'               => 'WPBakery Visual Composer',
			'slug'               => 'js_composer',
			'source'             => 'http://velikorodnov.com/wordpress/sample-data/plugins/js_composer.zip',
			'required'           => false,
			'version'            => '5.0.1',
			'force_activation'   => false,
			'force_deactivation' => false
		),

		array(
			'name'               => 'Screets Chat X',
			'slug'               => 'screets-cx',
			'source'             => 'http://velikorodnov.com/wordpress/sample-data/plugins/screets-cx.zip',
			'required'           => false,
			'version'            => '2.2.6',
			'force_activation'   => false,
			'force_deactivation' => false
		),

		array(
			'name'               => 'Ultimate WooCommerce Brands Plugin',
			'slug'               => 'mgwoocommercebrands',
			'source'             => 'http://velikorodnov.com/wordpress/sample-data/plugins/mgwoocommercebrands.zip',
			'required'           => false,
			'version'            => '1.5',
			'force_activation'   => false,
			'force_deactivation' => false
		),

// 		array(
//			'name'               => 'WPML Multilingual CMS', // The plugin name.
//			'slug'               => 'sitepress-multilingual-cms', // The plugin slug (typically the folder name).
//			'source'             => 'http://velikorodnov.com/wordpress/sample-data/plugins/sitepress-multilingual-cms.zip', // The plugin source.
//			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
//			'version'            => '3.6.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
//			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
//			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
//			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
//		)

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'shopme',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'shopme' ),
			'menu_title'                      => __( 'Install Plugins', 'shopme' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'shopme' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'shopme' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'shopme' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'shopme'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'shopme'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'shopme'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'shopme'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'shopme'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'shopme'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'shopme'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'shopme'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'shopme'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'shopme' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'shopme' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'shopme' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'shopme' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'shopme' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'shopme' ),
			'dismiss'                         => __( 'Dismiss this notice', 'shopme' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'shopme' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'shopme' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );
}
