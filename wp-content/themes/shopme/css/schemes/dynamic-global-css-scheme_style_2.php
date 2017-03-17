<?php

/* General
/*-----------------------------------------------------------*/

$output = "

	mark { background-color: $highlight_bg_color; }

	::selection {
		background-color: $highlight_bg_color;
		color: $highlight_text_color;
	}

	::-moz-selection {
		background-color: $highlight_bg_color;
		color: $highlight_text_color;
	}

	 ::-webkit-scrollbar-thumb {
		background-color: $primary_color;
	 }

	body {
		color: $general_font_color;
		font-size: $general_font_size;
	}

	body { background: $body_bg; }

	.page_wrapper { background-color: $page_wrapper_bg_color; }

	#header { background-color: $header_bg_color; }

	#footer { background-color: $footer_bg_color; }

";

/* Logo
/*-----------------------------------------------------------*/

$output .= "
	#header .logo {
		font-size: $logo_font_size;
	}

		#header .logo a {
			color: $logo_font_color;
		}
";

/* Headings
/*-----------------------------------------------------------*/

$output .= "
	h1 {
		color: $h1_font_color;
		font-size: $h1_font_size;
	}
	h2 {
		color: $h2_font_color;
		font-size: $h2_font_size;
	}
	h3 {
		color: $h3_font_color;
		font-size: $h3_font_size;
	}
	h4 {
		color: $h4_font_color;
		font-size: $h4_font_size;
	}
	h5 {
		color: $h5_font_color;
		font-size: $h5_font_size;
	}
	h6 {
		color: $h6_font_color;
		font-size: $h6_font_size;
	}
";

/* Primary Color
/*-----------------------------------------------------------*/

$output .= "

	.back_to_top,
	.open_categories_sticky,
	.open_categories_sticky.active,
	#open_shopping_cart.active,
	#open_shopping_cart.active::after,
	.button_grey:hover,
 	.button_grey.active,
	.added_to_cart,
	.comment-reply-link:hover,
	.tagcloud > a:hover,
	.box-curtain > div,
	.add_to_cart_button,
	.product_type_simple,
	.woocommerce #respond input#submit,
	.woocommerce a.button:not(.compare),
	.woocommerce button.button,
	.woocommerce input.button,
	input[type=submit]:hover,
	#sidebar .widget-title,
	.list-or-grid a:hover,
	.list-or-grid a.active,
	.type-product span.onfeatured,
	blockquote.type_2::after,
	.bottom_box .woof-reset-navigation:hover,
	.deal-progress .progress-bar,
	.infoblock.type_1 .infoblock-content:hover,
	.infoblock.type_2 .infoblock-content:hover,
	.infoblock.type_3 .infoblock-content:hover,
	.infoblock.type_4 .infoblock-content:hover,
	.woocommerce.widget .ui-slider .ui-slider-range,
	.scroll-wrapper > .scroll-element .scroll-bar,
	.vc_tta-color-blue.vc_tta-style-default .vc_tta-tab:hover > a,
	.vc_tta-color-blue.vc_tta-style-default .vc_tta-tab.vc_active > a,
	.vc_progress_bar.vc_progress-bar-color-bar_blue .vc_single_bar .vc_bar,
	.vc_btn3.vc_btn3-color-grey:hover, .vc_btn3.vc_btn3-color-grey.vc_btn3-style-flat:hover,
	.vc_btn3.vc_btn3-color-grey:focus, .vc_btn3.vc_btn3-color-grey.vc_btn3-style-flat:focus,
	.vc_toggle_size_md.vc_toggle_default:not(.vc_toggle_active) .vc_toggle_title:hover .vc_toggle_icon,
	.vc_tta.vc_tta-color-blue.vc_tta-style-default .vc_tta-panel:not(.vc_active) .vc_tta-panel-title:hover .vc_tta-controls-icon.vc_tta-controls-icon-plus
	{
		background-color: $primary_color;
	}

	body .chosen-container .chosen-results li.chosen,
	body .chosen-container .chosen-results li.highlighted { background-color: $primary_color !important; }

";

$output .= "

	a:hover,
	.call_us b,
	.mail_to,
	.total,
	.button_grey,
	.tagcloud > a,
	.list-or-grid a,
	ul.fl-countdown,
	.product_price,
	.product .price,
	.product_info ins,
	.infoblock .caption,
	input[type=submit],
	.main_product .title a,
	.infoblock i[class|=icon],
	.product_info > span.amount,
	#open_shopping_cart .title,
	#open_shopping_cart::before,
	.small_link > [class|=icon],
	[class*=c_info_]:not(ul)::after,
	.shop_table.wishlist_table td > span.amount,
	.shop_table.wishlist_table ins span.amount,
	.bottom_box .woof-reset-navigation,
	.filter_style_1 .product-filter li:hover > button,
	.filter_style_1 .product-filter li.active > button,
	.filter_style_1 .product-filter li:hover > a,
	.filter_style_1 .product-filter li.active > a,
	table.shop_table td.sub-td .amount,
	table.shop_table .order-total,
	.comment-reply-link,
	.vc_toggle_default .vc_toggle_icon::after,
	.vc_btn3.vc_btn3-color-grey,
	.vc_btn3.vc_btn3-color-grey.vc_btn3-style-flat,
	.pricing_table .pt_price,
	.vc_tta.vc_tta-color-blue.vc_tta-style-default .vc_tta-controls-icon.vc_tta-controls-icon-plus::after
	{
		color: $primary_color;
	}

";

$output .= "

	.yith-ajaxsearchform-container .autocomplete-suggestions,
	.search_form .search_category,
	form.search_form > input[type=search],
	form.search_form > button[type=submit],
	form.search_form > input[type=search]:first-child,
	#header .search_category .chosen-container .chosen-drop,
	.filter_style_1 .product-filter li:hover > button:after,
	.filter_style_1 .product-filter li.active > button:after,
	.filter_style_1 .product-filter li:hover > a:after,
	.filter_style_1 .product-filter li.active > a:after
	{
		border-color: $primary_color;
	}

	.button_blue,
	.theme_button:hover,
	.button_grey_2:hover,
	.open_menu.active,
	.qty button:hover,
	.compare_button:hover,
	.wishlist_button:hover,
	.wishlist_button.active,
	.compare_button:hover::after,
	.wishlist_button:hover::after,
	.wishlist_button.active::after,
	.site_setting_list a:hover,
	ul.product-categories > li:hover > a,
	ul.product-categories li.current-cat-parent > a,
	ul.product-categories > li.current-cat > a,
	ul.page-numbers > li .current,
	ul.page-numbers > li .selected,
	ul.page-numbers > li > a:hover,
	.order-param-button a:hover,
	.options_list > li > a:hover,
	.options_list > li > a.selected,
	.options_list > li.chosen > a,
	.woocommerce.widget .price_slider_amount .button,
	.page_wrapper .widget_categories > ul > li:hover,
	#sidebar .widget_categories > ul > li:hover,
	.filter_style_2 .product-filter li:hover > button,
	.filter_style_2 .product-filter li.active > button,
	.filter_style_2 .product-filter li:hover > a,
	.filter_style_2 .product-filter li.active > a,
	#sidebar .widget_meta li:hover,
	#sidebar .widget_links li:hover,
	#sidebar .widget_archive li:hover,
	#sidebar .widget_pages li:hover,
	#sidebar .widget_tag_cloud li:hover,
	#sidebar .widget_recent_entries li:hover,
	#sidebar .widget_recent_comments li:hover,
	#sidebar .widget_rss li:hover,
	.page_wrapper .widget_meta li:hover,
	.page_wrapper .widget_links li:hover,
	.page_wrapper .widget_archive li:hover,
	.page_wrapper .widget_pages li:hover,
	.page_wrapper .widget_tag_cloud li:hover,
	.page_wrapper .widget_recent_entries li:hover,
	.page_wrapper .widget_recent_comments li:hover,
	.page_wrapper .widget_rss li:hover,
	.ts_nav > li.active > a,
	.ts_nav > li:hover > a,
	.tabs_nav > li.active > a,
	.tabs_nav > li:hover > a,
	body .woof_list_label li .woof_label_term:hover,
	body .woof_list_label li .woof_label_term.checked,
	.vc_btn3.vc_btn3-color-primary,
	.vc_btn3.vc_btn3-color-primary.vc_btn3-style-flat,
	.woocommerce-account .woocommerce-MyAccount-navigation li:hover > a,
	.woocommerce-account .woocommerce-MyAccount-navigation li.is-active > a
	{
		background-color: $primary_color;
		border-color: $primary_color;
	}

";

/* Navigation Primary Color
/*-----------------------------------------------------------*/

$output .= "

	.topbar > ul > li:hover > a,
	.topbar > ul > li.current-menu-item > a,
	.topbar > ul > li.current-menu-parent > a,
	.topbar > ul > li.current-menu-ancestor > a,
	.topbar > ul > li.current_page_item > a,
	.topbar > ul > li.current_page_parent > a,
	.topbar > ul > li.current_page_ancestor > a,
	.topbar > ul > li.menu-item-has-children:hover > a,
	.topbar > ul > li.current-menu-item > a::after,
	.topbar > ul > li.current-menu-parent > a::after,
	.topbar > ul > li.current-menu-ancestor > a::after,
	.topbar > ul > li.current_page_item > a::after,
	.topbar > ul > li.current_page_parent > a::after,
	.topbar > ul > li.current_page_ancestor > a::after,
	.topbar > ul > li.menu-item-has-children:hover > a::after
	{
		color: $primary_color;
	}

	.topbar ul ul li:hover > a,
	.topbar ul ul li.current-menu-item > a,
	.topbar ul ul li.current-menu-parent > a,
	.topbar ul ul li.current-menu-ancestor > a,
	.topbar ul ul li.current_page_item > a,
	.topbar ul ul li.current_page_parent > a,
	.topbar ul ul li.current_page_ancestor > a,

	.main_navigation li:hover > a,
	.main_navigation li.current-menu-item > a,
	.main_navigation li.current-menu-parent > a,
	.main_navigation li.current-menu-ancestor > a,
	.main_navigation li.current_page_item > a,
	.main_navigation li.current_page_parent > a,
	.main_navigation li.current_page_ancestor > a,

	.full_width_nav li:hover > a,
	.full_width_nav li.current-menu-item > a,
	.full_width_nav li.current-menu-parent > a,
	.full_width_nav li.current-menu-ancestor > a,
	.full_width_nav li.current_page_item > a,
	.full_width_nav li.current_page_parent > a,
	.full_width_nav li.current_page_ancestor > a,

	.main_navigation > ul > li:hover > a,
	.main_navigation > ul > li.current-menu-item > a,
	.main_navigation > ul > li.current-menu-parent > a,
	.main_navigation > ul > li.current-menu-ancestor > a,
	.main_navigation > ul > li.current_page_item > a,
	.main_navigation > ul > li.current_page_parent > a,
	.main_navigation > ul > li.current_page_ancestor > a,

	.full_width_nav > ul > li:hover > a,
	.full_width_nav > ul > li.current-menu-item > a,
	.full_width_nav > ul > li.current-menu-parent > a,
	.full_width_nav > ul > li.current-menu-ancestor > a,
	.full_width_nav > ul > li.current_page_item > a,
	.full_width_nav > ul > li.current_page_parent > a,
	.full_width_nav > ul > li.current_page_ancestor > a,

	.widget_nav_menu .menu > li > a:hover,
	.widget_nav_menu .menu > li.current-menu-item > a,
	.widget_nav_menu .menu > li.current-menu-parent > a,
	.widget_nav_menu .menu > li.current-menu-ancestor > a,
	.widget_nav_menu .menu > li.current_page_item > a,
	.widget_nav_menu .menu > li.current_page_parent > a,
	.widget_nav_menu .menu > li.current_page_ancestor > a,

	.mobile-advanced #mega_main_menu > .menu_holder > .menu_inner > ul > li:hover > .item_link,
	.mobile-advanced #mega_main_menu > .menu_holder > .menu_inner > ul > li > .item_link:hover,
	.mobile-advanced #mega_main_menu > .menu_holder > .menu_inner > ul > li > .item_link:focus,
	.mobile-advanced #mega_main_menu > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link,
	.mobile-advanced #mega_main_menu > .menu_holder > .menu_inner > ul > li.current-page-ancestor > .item_link,
	.mobile-advanced #mega_main_menu > .menu_holder > .menu_inner > ul > li.current-post-ancestor > .item_link,
	.mobile-advanced #mega_main_menu > .menu_holder > .menu_inner > ul > li.current-menu-item > .item_link
	{
		background-color: $primary_color;
	}

	.secondary_navigation > ul > li:hover > a,
	.secondary_navigation > ul > li.current-menu-item > a,
	.secondary_navigation > ul > li.current-menu-parent > a,
	.secondary_navigation > ul > li.current-menu-ancestor > a,
	.secondary_navigation > ul > li.current_page_item > a,
	.secondary_navigation > ul > li.current_page_parent > a,
	.secondary_navigation > ul > li.current_page_ancestor > a
	{
		background-color: $primary_color;
		border-color: $primary_color;
	}

";


$output .= "

	@media only screen and (max-width: 992px) {

		.mobile-advanced > ul > li.current-menu-item > a,
		.mobile-advanced > ul > li.current-menu-parent > a,
		.mobile-advanced > ul > li.current-menu-ancestor > a,
		.mobile-advanced > ul > li.current_page_item > a,
		.mobile-advanced > ul > li.current_page_parent > a,
		.mobile-advanced > ul > li.current_page_ancestor > a
		{
			background-color: $primary_color;
		}

		.mobile-advanced ul ul li > a:before {
			color: $primary_color;
		}

		#advanced-menu-hide { background-color: $primary_color; }

	}

";

$output .= "

	@media only screen and (max-width: 992px) {

		.mobile-advanced ul ul li.current-menu-item > a,
		.mobile-advanced ul ul li.current-menu-parent > a,
		.mobile-advanced ul ul li.current-menu-ancestor > a,
		.mobile-advanced ul ul li.current_page_item > a,
		.mobile-advanced ul ul li.current_page_parent > a,
		.mobile-advanced ul ul li.current_page_ancestor > a
		{
			color: $primary_color;
		}

		.mobile-advanced > ul > li > a,
		.mobile-advanced #mega_main_menu > .menu_holder > .menu_inner > ul > li > .item_link,
		.mobile-advanced #mega_main_menu.fullwidth.primary_style-buttons > .menu_holder > .menu_inner > .nav_logo > .mobile_toggle,
		.mobile-advanced #mega_main_menu.fullwidth > .menu_holder > .menu_inner > ul > li > .item_link,
		.mobile-advanced #mega_main_menu.primary.primary_style-buttons > .menu_holder > .menu_inner > .nav_logo > .mobile_toggle,
		.mobile-advanced #mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link
		{
			background-color: $primary_color;
		}

	}

";

/* Secondary Color
/*-----------------------------------------------------------*/

$output .= "

	.back_to_top:hover,
  	.button_blue:hover,
  	.added_to_cart:hover,
	.add_to_cart_button:hover,
	.product_type_simple:hover,
	.woocommerce #respond input#submit:hover,
	.woocommerce a.button:not(.compare):hover,
	.woocommerce button.button:hover,
	.woocommerce input.button:hover,
	form.search_form > button:hover,
	.woocommerce.widget .price_slider_amount .button:hover,
	.infoblock.type_2 .infoblock-content:hover [class*=button],
	.scroll-wrapper > .scroll-element .scroll-bar:hover
	{
		background-color: $secondary_color;
	}

	.vc_btn3.vc_btn3-color-primary:hover,
	.vc_btn3.vc_btn3-color-primary.vc_btn3-style-flat:hover,
	.vc_btn3.vc_btn3-color-primary:focus,
	.vc_btn3.vc_btn3-color-primary.vc_btn3-style-flat:focus
	{
		border-color: $secondary_color;
		background-color: $secondary_color;
	}

	.woocommerce-account .woocommerce-MyAccount-navigation li:hover > a,
	.woocommerce-account .woocommerce-MyAccount-navigation li.is-active > a,
	#sidebar .widget_meta li:hover, #sidebar .widget_links li:hover,
	#sidebar .widget_archive li:hover, #sidebar .widget_pages li:hover,
	#sidebar .widget_tag_cloud li:hover, #sidebar .widget_recent_entries li:hover,
	#sidebar .widget_recent_comments li:hover, #sidebar .widget_rss li:hover,
	.page_wrapper .widget_meta li:hover, .page_wrapper .widget_links li:hover,
	.page_wrapper .widget_archive li:hover, .page_wrapper .widget_pages li:hover,
	.page_wrapper .widget_tag_cloud li:hover, .page_wrapper .widget_recent_entries li:hover,
	.page_wrapper .widget_recent_comments li:hover, .page_wrapper .widget_rss li:hover
	{
		border-color: $secondary_color;
		background-color: $secondary_color;
	}

";

$output .= "

	.main_product .title a:hover
	{
		color: $secondary_color;
	}

";

$output .= "

	form.search_form > button:hover
	{
		border-color: $secondary_color;
	}

";

global $shopme_config;
$shopme_config['styles'] = array(

	array(
		'commenting' => esc_html__('Dynamic Styles', 'shopme'),
		'values' => array(
			'returnValue' => $output
		)
	),

	array(
		'elements' => 'body',
		'values' => array(
			'google_webfonts' => shopme_custom_get_option('general_google_webfont')
		)
	),
	array(
		'elements' => '#header .logo',
		'values' => array(
			'google_webfonts' => shopme_custom_get_option('styles-logo_font_family')
		)
	),

	// Heading H1
	array(
		'elements' => 'h1',
		'values' => array(
			'google_webfonts' => shopme_custom_get_option('styles-h1_font_family')
		)
	),
	// Heading H2
	array(
		'elements' => 'h2',
		'values' => array(
			'google_webfonts' => shopme_custom_get_option('styles-h2_font_family')
		)
	),
	// Heading H3
	array(
		'elements' => 'h3',
		'values' => array(
			'google_webfonts' => shopme_custom_get_option('styles-h3_font_family')
		)
	),
	// Heading H4
	array(
		'elements' => 'h4',
		'values' => array(
			'google_webfonts' => shopme_custom_get_option('styles-h4_font_family')
		)
	),
	// Heading H5
	array(
		'elements' => 'h5',
		'values' => array(
			'google_webfonts' => shopme_custom_get_option('styles-h5_font_family')
		)
	),
	// Heading H6
	array(
		'elements' => 'h6',
		'values' => array(
			'google_webfonts' => shopme_custom_get_option('styles-h6_font_family')
		)
	),

	// The Quick Custom CSS
	array(
		'commenting' => 'Custom Styles',
		'values' => array(
			'returnValue' => shopme_custom_get_option('custom_quick_css')
		)
	)
);