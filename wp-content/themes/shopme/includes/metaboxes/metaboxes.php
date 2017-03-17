<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/**
 * The Metaboxes class.
 */
class Shopme_Theme_Metaboxes {

	/**
	 * The settings.
	 *
	 * @access public
	 * @var array
	 */
	public $data;

	/**
	 * The class constructor.
	 *
	 * @access public
	 */
	public function __construct() {
		require_once get_template_directory() . '/includes/metaboxes/inc/loader.php';
		$loader = new MAD_Loader;
		$loader->init();

		add_filter( 'mad_meta_boxes', array(&$this, 'meta_boxes_array') );
	}

	public function meta_boxes_array($meta_boxes) {


		/*	Meta Box Definitions
		/* ---------------------------------------------------------------------- */

		$prefix = 'shopme_';

		/*	Post Format: Quote
		/* ---------------------------------------------------------------------- */

		$meta_boxes[] = array(
			'id'       => 'post-quote-settings',
			'title'    => esc_html__('Quote Settings', 'shopme'),
			'pages'    => array('post'),
			'context'  => 'normal',
			'priority' => 'high',
			'fields'   => array(
				array(
					'name' => esc_html__('The Quote', 'shopme'),
					'id'   => $prefix . 'quote',
					'type' => 'textarea',
					'std'  => '',
					'desc' => '',
					'cols' => '40',
					'rows' => '8'
				),
				array(
					'name' => esc_html__('The Author', 'shopme'),
					'id'   => $prefix . 'quote_author',
					'type' => 'text',
					'std'  => '',
					'desc' => esc_html__('(optional)', 'shopme')
				)
			)
		);

		/*	Layout Settings
		/* ---------------------------------------------------------------------- */

		$pages = get_pages('title_li=&orderby=name');
		$list_pages = array('' => 'None');
		foreach ($pages as $key => $entry) {
			$list_pages[$entry->ID] = $entry->post_title;
		}

		$registered_sidebars = SHOPME_HELPER::get_registered_sidebars(array("" => 'Default Sidebar'), array('General Widget Area'));
		$registered_custom_sidebars = array();

		foreach($registered_sidebars as $key => $value) {
			if (strpos($key, 'Footer Row') === false) {
				$registered_custom_sidebars[$key] = $value;
			}
		}

		$meta_boxes[] = array(
			'id'       => 'layout-settings',
			'title'    => esc_html__('Layout', 'shopme'),
			'pages'    => array('post', 'page', 'product', 'testimonials', 'team-members'),
			'context'  => 'normal',
			'priority' => 'default',
			'fields'   => array(
				array(
					'name'    => esc_html__('Header Layout', 'shopme'),
					'id'      => $prefix . 'header_layout',
					'type'    => 'select',
					'std'     => '',
					'desc'    => esc_html__('Choose header layout', 'shopme'),
					'options' => array(
						'' => esc_html__('Default', 'shopme'),
						'type_1' => esc_html__('Header 1', 'shopme'),
						'type_2' => esc_html__('Header 2', 'shopme'),
						'type_3' => esc_html__('Header 3', 'shopme'),
						'type_4' => esc_html__('Header 4', 'shopme'),
						'type_5' => esc_html__('Header 5', 'shopme'),
						'type_6' => esc_html__('Header 6', 'shopme')
					)
				),
				array(
					'name'    => esc_html__('Page Title', 'shopme'),
					'id'      => $prefix . 'page_title',
					'type'    => 'checkbox',
					'std'     => '0',
					'desc'    => esc_html__('Boolean: Hide page title', 'shopme'),
				),
				array(
					'name'    => esc_html__('Sidebar Position', 'shopme'),
					'id'      => $prefix . 'page_sidebar_position',
					'type'    => 'select',
					'std'     => '',
					'desc'    => esc_html__('Choose page sidebar position', 'shopme'),
					'options' => array(
						'' => esc_html__('Default Sidebar Position', 'shopme'),
						'no_sidebar' => esc_html__('No Sidebar', 'shopme'),
						'sbl' => esc_html__('Left Sidebar', 'shopme'),
						'sbr' => esc_html__('Right Sidebar', 'shopme')
					)
				),
				array(
					'name'    => esc_html__('Sidebar Setting', 'shopme'),
					'id'      => $prefix . 'page_sidebar',
					'type'    => 'select',
					'std'     => '',
					'desc'    => esc_html__('Choose a custom sidebar', 'shopme'),
					'options' => $registered_custom_sidebars
				),
				array(
					'name'    => esc_html__('Breadcrumb Navigation', 'shopme'),
					'id'      => $prefix . 'breadcrumb',
					'type'    => 'select',
					'std'     => 'breadcrumb',
					'desc'    => esc_html__('Display the Breadcrumb Navigation?', 'shopme'),
					'options' => array(
						'breadcrumb' => esc_html__('Display breadcrumbs', 'shopme'),
						'hide' => esc_html__('Hide', 'shopme')
					)
				),
				array(
					'name'    => esc_html__('Page Layout', 'shopme'),
					'id'      => $prefix . 'page_layout',
					'type'    => 'select',
					'std'     => '',
					'desc'    => esc_html__('Choose page layout style', 'shopme'),
					'options' => array(
						'' => esc_html__('Default Layout', 'shopme'),
						'boxed_layout' => esc_html__('Boxed Layout', 'shopme'),
						'wide_layout' => esc_html__('Wide Layout', 'shopme')
					)
				),
				array(
					'name'    => esc_html__('Animate Widgets', 'shopme'),
					'id'      => $prefix . 'animate_widgets',
					'type'    => 'checkbox',
					'std'     => '0',
					'desc'    => esc_html__('Boolean: Animate widgets in sidebar', 'shopme'),
				),
				array(
					'name'    => esc_html__('Before Content', 'shopme'),
					'id'      => $prefix . 'before_content',
					'type'    => 'select',
					'std'     => '',
					'desc'    => esc_html__('Display content before main content', 'shopme'),
					'options' => $list_pages
				),
				array(
					'name'    => esc_html__('After Content', 'shopme'),
					'id'      => $prefix . 'after_content',
					'type'    => 'select',
					'std'     => '',
					'desc'    => esc_html__('Display content after main content', 'shopme'),
					'options' => $list_pages
				)
			)
		);

		/*	Body Background
		/* ---------------------------------------------------------------------- */

		$meta_boxes[] = array(
			'id'       => 'body-background',
			'title'    => esc_html__('Body Background', 'shopme'),
			'pages'    => array('page'),
			'context'  => 'normal',
			'priority' => 'default',
			'fields'   => array(
				array(
					'name'    => esc_html__('Background color', 'shopme'),
					'id'      => $prefix . 'bg_color',
					'type'    => 'color',
					'std'     => '',
					'desc'    => esc_html__('Select the background color of the body', 'shopme')
				),
				array(
					'name'    => esc_html__('Background image', 'shopme'),
					'id'      => $prefix . 'bg_image',
					'type'    => 'thickbox_image',
					'std'     => '',
					'desc'    => esc_html__('Select the background image', 'shopme')
				),
				array(
					'name'    => esc_html__('Background repeat', 'shopme'),
					'id'      => $prefix . 'bg_image_repeat',
					'type'    => 'select',
					'std'     => '',
					'desc'    => esc_html__('Select the repeat mode for the background image', 'shopme'),
					'options' => array(
						'' => esc_html__('Default', 'shopme'),
						'repeat' => esc_html__('Repeat', 'shopme'),
						'no-repeat' => esc_html__('No Repeat', 'shopme'),
						'repeat-x' => esc_html__('Repeat Horizontally', 'shopme'),
						'repeat-y' => esc_html__('Repeat Vertically', 'shopme')
					)
				),
				array(
					'name'    => esc_html__('Background position', 'shopme'),
					'id'      => $prefix . 'bg_image_position',
					'type'    => 'select',
					'std'     => '',
					'desc'    => esc_html__('Select the position for the background image', 'shopme'),
					'options' => array(
						'' => esc_html__('Default', 'shopme'),
						'top left' => esc_html__('Top left', 'shopme'),
						'top center' => esc_html__('Top center', 'shopme'),
						'top right' => esc_html__('Top right', 'shopme'),
						'bottom left' => esc_html__('Bottom left', 'shopme'),
						'bottom center' => esc_html__('Bottom center', 'shopme'),
						'bottom right' => esc_html__('Bottom right', 'shopme')
					)
				),
				array(
					'name'    => esc_html__('Background attachment', 'shopme'),
					'id'      => $prefix . 'bg_image_attachment',
					'type'    => 'select',
					'std'     => '',
					'desc'    => esc_html__('Select the attachment for the background image ', 'shopme'),
					'options' => array(
						'' => esc_html__('Default', 'shopme'),
						'scroll' => esc_html__('Scroll', 'shopme'),
						'fixed' => esc_html__('Fixed', 'shopme')
					)
				),
			)
		);

		/*	Team Settings
		/* ---------------------------------------------------------------------- */

		$meta_boxes[] = array(
			'id'       => 'team-settings',
			'title'    => esc_html__('Team Settings', 'shopme'),
			'pages'    => array('team-members'),
			'context'  => 'normal',
			'priority' => 'high',
			'fields'   => array(
				array(
					'name' => esc_html__('Position', 'shopme'),
					'id'   => $prefix . 'tm_position',
					'type' => 'text',
					'std'  => '',
					'desc' => ''
				)
			)
		);

		$meta_boxes[] = array(
			'id'       => 'team-social-settings',
			'title'    => esc_html__('Team Social Links', 'shopme'),
			'pages'    => array('team-members'),
			'context'  => 'normal',
			'priority' => 'high',
			'fields'   => array(
				array(
					'name' => esc_html__('Facebook', 'shopme'),
					'id'   => $prefix . 'tm_facebook',
					'type' => 'text',
					'std'  => '',
					'desc' => ''
				),
				array(
					'name' => esc_html__('Twitter', 'shopme'),
					'id'   => $prefix . 'tm_twitter',
					'type' => 'text',
					'std'  => '',
					'desc' => ''
				),
				array(
					'name' => esc_html__('Google Plus', 'shopme'),
					'id'   => $prefix . 'tm_gplus',
					'type' => 'text',
					'std'  => '',
					'desc' => ''
				),
				array(
					'name' => esc_html__('Pinterest', 'shopme'),
					'id'   => $prefix . 'tm_pinterest',
					'type' => 'text',
					'std'  => '',
					'desc' => ''
				),
				array(
					'name' => esc_html__('Instagram', 'shopme'),
					'id'   => $prefix . 'tm_instagram',
					'type' => 'text',
					'std'  => '',
					'desc' => ''
				)
			)
		);

		/*	Testimonials Settings
		/* ---------------------------------------------------------------------- */

		$meta_boxes[] = array(
			'id'       => 'testimonials-settings',
			'title'    => esc_html__('Testimonials Settings', 'shopme'),
			'pages'    => array('testimonials'),
			'context'  => 'normal',
			'priority' => 'high',
			'fields'   => array(
				array(
					'name' => esc_html__('Place', 'shopme'),
					'id'   => $prefix . 'tm_place',
					'type' => 'text',
					'std'  => '',
					'desc' => ''
				)
			)
		);



		return $meta_boxes;
	}

}

new Shopme_Theme_Metaboxes;
