<?php

/* General */
/*---------------------------------*/

$output = "

	::selection {
		background-color: $highlight_bg_color;
		color: $highlight_text_color;
	}

	::-moz-selection {
		background-color: $highlight_bg_color;
		color: $highlight_text_color;
	}

	 ::-webkit-scrollbar-thumb {
		background-color: $secondary_color;
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

/* Logo */
/*---------------------------------*/

$output .= "
	#header .logo {
		font-size: $logo_font_size;
	}

		#header .logo a {
			color: $logo_font_color;
		}
";

/* Headings */
/*---------------------------------*/

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

/*---------------------------------*/
/* Primary Color */
/*---------------------------------*/

$output .= "

	.added_to_cart,
	.add_to_cart_button,
	.product_type_simple,
	.woocommerce #respond input#submit,
	.woocommerce a.button:not(.compare),
	.woocommerce button.button, .woocommerce input.button,
	form.search_form > button:hover,
	.compare_button[data-amount]::after,
	.wishlist_button[data-amount]::after,
	#open_shopping_cart[data-amount]::after,
	.type-product span.onfeatured,
	.button_blue,
	.theme_button:hover,
	.button_grey_2:hover,
	.back_to_top:hover,
	.deal-progress .progress-bar,
	.woocommerce.widget .price_slider_amount .button,
	.infoblock.type_2 .infoblock-content:hover [class*=button]
	{
		background-color: $primary_color;
	}

	body .chosen-container .chosen-results li.chosen,
	body .chosen-container .chosen-results li.highlighted { background-color: $primary_color !important; }

";

$output .= "

	 a:hover,
	.call_us b,
	.entry_title a:hover,
	.top_part .link-logout:hover,
	.top_part .to-login:hover,
	.top_part .to-register:hover,
	.infoblock i[class|=icon],
	.wishlist_link.small_link:hover > [class|=icon],
	.compare.small_link:hover > [class|=icon],
	.full_width_nav #mega_main_menu.fullwidth .mega_dropdown > li > span.item_link:hover *,
	.full_width_nav #mega_main_menu.fullwidth .mega_dropdown > li > span.item_link *,
	#footer .latest-tweets a:hover,
	#open_shopping_cart.active::before,
	#header ul.social_links > li > a:hover,
	#footer .widget_meta a:hover,
	#footer .widget_links a:hover,
	#footer .widget_archive a:hover,
	#footer .widget_categories a:hover,
	#footer .widget_pages a:hover,
	#footer .widget_popular_posts a:hover,
	#footer .widget_recent_entries a:hover,
	#footer .widget_recent_comments a:hover,
	#footer .widget_products a:hover,
	#footer .widget .product_list_widget li a:hover
	{
		color: $primary_color;
	}

";

$output .= "

	form.search_form > button:hover
	{
		border-color: $primary_color;
	}

";

/* Navigation Primary Color */
/*---------------------------------*/

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

";

/* Navigation Primary Color */
/*---------------------------------*/

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
			background-color: $secondary_color;
		}

	}

";

$output .= "

	.vc_btn3.vc_btn3-color-grey:hover,
	.vc_btn3.vc_btn3-color-grey.vc_btn3-style-flat:hover,
	.vc_btn3.vc_btn3-color-grey:focus,
	.vc_btn3.vc_btn3-color-grey.vc_btn3-style-flat:focus
	{
		background-color: $secondary_color;
	}

	.vc_btn3.vc_btn3-color-primary:hover,
	.vc_btn3.vc_btn3-color-primary.vc_btn3-style-flat:hover,
	.vc_btn3.vc_btn3-color-primary:focus,
	.vc_btn3.vc_btn3-color-primary.vc_btn3-style-flat:focus
	{
		background-color: $primary_color;
		border-color: $primary_color;
	}

	.vc_btn3.vc_btn3-color-grey,
	.vc_btn3.vc_btn3-color-grey.vc_btn3-style-flat,
	.vc_btn3.vc_btn3-color-white:hover,
	.vc_btn3.vc_btn3-color-white.vc_btn3-style-flat:hover,
	.vc_btn3.vc_btn3-color-white:focus,
	.vc_btn3.vc_btn3-color-white.vc_btn3-style-flat:focus
	{
		color: $secondary_color;
	}

";

/*---------------------------------*/
/* Secondary Color */
/*---------------------------------*/

$output .= "

	::-webkit-scrollbar-thumb {
		background-color: $secondary_color;
	}

	mark,
	input[type=submit]:hover,
	.type-product span.new-badge,
	.filter_style_1 .product-filter li:hover > button,
	.filter_style_2 .product-filter li:hover > button,
	.filter_style_1 .product-filter li.active > button,
	.filter_style_2 .product-filter li.active > button,
	.button_grey:hover,
	.button_grey.active,
	.button_blue:hover,
	ul.product-categories > li:hover > a,
	ul.product-categories li.current-cat-parent > a,
	ul.product-categories > li.current-cat > a,
	.page-nav > [class|=page]:hover,
	.owl-nav > [class^=owl]:hover,
	.site_setting_list a:hover,
	.open_menu.active,
	.compare_button:hover,
	.wishlist_button:hover,
	.wishlist_button.active,
	.compare_button:hover::after,
	.wishlist_button:hover::after,
	.wishlist_button.active::after,
	.list-or-grid a:hover,
	.list-or-grid a.active,
	ul.page-numbers > li .current,
	ul.page-numbers > li .selected,
	ul.page-numbers > li > a:hover,
	.woocommerce.widget .price_slider_amount .button:hover,
	.woocommerce.widget .ui-slider .ui-slider-range,
	.page_wrapper .widget_categories > ul > li:hover,
	 #sidebar .widget_categories > ul > li:hover,
	 .qty button:hover,
	 .box-curtain > div,
	.tagcloud > a:hover,
	.open_categories_sticky,
	 .open_categories_sticky.active,
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
	 .comment-reply-link:hover,
	 .ts_nav > li.active > a,
	 .ts_nav > li:hover > a,
	 .tabs_nav > li.active > a,
	 .tabs_nav > li:hover > a,
	 blockquote.type_2::after,
	 .tabs-nav li:hover > a, .tabs-nav li.active a,
	 .shopping_cart .button_grey.button:hover,
	 .woocommerce .shopping_cart a.button_grey.button:hover,
	 .vc_progress_bar.vc_progress-bar-color-bar_blue .vc_single_bar .vc_bar,
	 .vc_tta-color-blue.vc_tta-style-default .vc_tta-tab:hover > a,
	 .vc_tta-color-blue.vc_tta-style-default .vc_tta-tab.vc_active > a,
	 .vc_toggle_size_md.vc_toggle_default:not(.vc_toggle_active) .vc_toggle_title:hover .vc_toggle_icon,
	 .vc_tta.vc_tta-color-blue.vc_tta-style-default .vc_tta-panel:not(.vc_active) .vc_tta-panel-title:hover .vc_tta-controls-icon.vc_tta-controls-icon-plus
	{
		background-color: $secondary_color;
	}

";

$output .= "

	input[type=submit],
	.button_grey,
	.total,
	.mail_to,
	a.product-title,
	a.product-title:hover,
	.list-or-grid a,
	.tagcloud > a,
	[class*=c_info_]:not(ul)::after,
	#footer .tagcloud > a,
	.login_box::before,
	.main_product .title a:hover,
	.comment-reply-link,
	.shop_table.wishlist_table td > span.amount,
	.shop_table.wishlist_table ins span.amount,
	table.shop_table .order-total,
	table.shop_table td.sub-td .amount,
	.main_product .title a,
	.sc_product .product_name,
	.shopping_cart .button_grey.button,
	.woocommerce .shopping_cart a.button_grey.button,
	.vc_toggle_default .vc_toggle_icon::after,
	.vc_btn3.vc_btn3-color-white, .vc_btn3.vc_btn3-color-white.vc_btn3-style-flat,
	.vc_tta.vc_tta-color-blue.vc_tta-style-default .vc_tta-controls-icon.vc_tta-controls-icon-plus::after
	{
		color: $secondary_color;
	}

";

$output .= "

	body .woof-reset-navigation {
		color: $secondary_color;
	}

	.vc_btn3.vc_btn3-color-primary,
	.vc_btn3.vc_btn3-color-primary.vc_btn3-style-flat,
	body .woof_list_label li .woof_label_term:hover,
	body .woof_list_label li .woof_label_term.checked,
	body .woof-reset-navigation:hover,
	.order-param-button a:hover,
	.options_list > li > a:hover,
	.options_list > li > a.selected,
	.options_list > li.chosen > a,
	.filter_style_1 .product-filter li:hover > a,
	.filter_style_1 .product-filter li.active > a,
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
		background-color: $secondary_color;
		border-color: $secondary_color;
	}

";

/* Navigation Secondary Color */
/*---------------------------------*/

$output .= "

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

	.secondary_navigation > ul > li:hover > a,
	.secondary_navigation > ul > li.current-menu-item > a,
	.secondary_navigation > ul > li.current-menu-parent > a,
	.secondary_navigation > ul > li.current-menu-ancestor > a,
	.secondary_navigation > ul > li.current_page_item > a,
	.secondary_navigation > ul > li.current_page_parent > a,
	.secondary_navigation > ul > li.current_page_ancestor > a,

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
		background-color: $secondary_color;
	}

	.secondary_navigation .sub-menu > li:hover > a,
	.secondary_navigation .children > li:hover > a { color: $secondary_color; }

";

/*---------------------------------*/
/* Additional Color */
/*---------------------------------*/

$output .= "

	.infoblock.type_1 .infoblock-content:hover,
	.infoblock.type_2 .infoblock-content:hover,
	.infoblock.type_3 .infoblock-content:hover,
	.infoblock.type_4 .infoblock-content:hover,
	.back_to_top
	{
		background-color: $additional_color;
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