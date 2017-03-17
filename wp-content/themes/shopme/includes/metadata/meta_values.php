<?php


if (!function_exists('shopme_cat_sidebars')) {

	function shopme_cat_sidebars() {

		$registered_sidebars = SHOPME_HELPER::get_registered_sidebars(array());
		$registered_custom_sidebars = array();

		if (!empty($registered_sidebars)) {
			foreach($registered_sidebars as $key => $value) {
				if (strpos($key, 'Footer Row') === false) {
					$registered_custom_sidebars[$key] = $value;
				}
			}
		}

		return $registered_custom_sidebars;

	}

}


if (!function_exists('shopme_cat_meta_view')) {

	function shopme_cat_meta_view() {

		$sidebar_options = shopme_cat_sidebars();

		return array(
			'content_top' => array(
				'name' => 'content_top',
				'title' => esc_html__('Content Top', 'shopme'),
				'desc' => esc_html__('Select the page that you want to take the content', 'shopme'),
				'type' => 'select',
				'default' => '',
				'options' => 'page'
			),
			'sidebar_position' => array(
				'name' => 'sidebar_position',
				'title' => esc_html__('Sidebar Position', 'shopme'),
				'desc' => esc_html__('Choose sidebar position', 'shopme'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Default Sidebar Position', 'shopme'),
					'no_sidebar' => esc_html__('No Sidebar', 'shopme'),
					'sbl' => esc_html__('Left Sidebar', 'shopme'),
					'sbr' => esc_html__('Right Sidebar', 'shopme')
				)
			),
			'sidebar' => array(
				'name' => 'sidebar',
				'title' => esc_html__('Sidebar Setting', 'shopme'),
				'desc' => esc_html__('Select the sidebar you would like to display.', 'shopme'),
				'type' => 'select',
				'default' => '',
				'options' => $sidebar_options
			),
			'page_layout' => array(
				'name' => 'page_layout',
				'title' => esc_html__('Page Layout', 'shopme'),
				'desc' => esc_html__('Choose page layout style', 'shopme'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Default Layout', 'shopme'),
					'boxed_layout' => esc_html__('Boxed Layout', 'shopme'),
					'wide_layout' => esc_html__('Wide Layout', 'shopme')
				)
			),
			'shop_view' => array(
				'name' => 'shop_view',
				'title' => esc_html__('Shop View', 'shopme'),
				'desc' => esc_html__('Choose shop view layout - grid or list', 'shopme'),
				'type' => 'select',
				'default' => 'view-grid',
				'options' => array(
					'view-grid' => esc_html__('Grid View', 'shopme'),
					'list_view_products' => esc_html__('List View', 'shopme')
				)
			),
			'overview_column_count' => array(
				'name' => 'overview_column_count',
				'title' => esc_html__('Column Count', 'shopme'),
				'desc' => esc_html__('This controls how many columns should be appeared on overview pages.', 'shopme'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Default', 'shopme'),
					3 => 3,
					4 => 4
				)
			)
		);

	}

}