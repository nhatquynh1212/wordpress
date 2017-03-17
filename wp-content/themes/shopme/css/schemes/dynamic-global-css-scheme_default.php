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

	.button_blue,
	.theme_button:hover,
	.button_grey_2:hover,
	.back_to_top:hover,
	.open_categories_sticky,
	.options_list > li > a:hover,
	.options_list > li > a.selected,
	.options_list > li.chosen > a,
	.site_settings li:not(:first-child) a::after,
	form.search_form .options_list li:not(:first-child) a::after,
	.options_list > li:not(:first-child) > a::after,
	form.search_form .options_list li:hover a,
	.site_setting_list a:hover,
	.widget_search .submit-search,
	.infoblock.type_1 .infoblock-content:hover,
	.infoblock.type_2 .infoblock-content:hover,
	.infoblock.type_3 .infoblock-content:hover,
	.infoblock.type_4 .infoblock-content:hover,
	ul.page-numbers > li:not(:last-child) > a::after,
	ul.page-numbers > li .current,
	ul.page-numbers > li .selected,
	ul.page-numbers > li > a:hover,
	.progress_bar > .pb_inner,
	.call_to_action.type_2,
	.page-nav > [class|=page]:hover,
	.owl-nav > [class^=owl]:hover,
	.post-prev-button,
	.post-next-button,
	.cwallowcookies.button,
	.type-product span.new-badge,
	.added_to_cart,
	.add_to_cart_button,
	.product_type_simple,
	.woocommerce #respond input#submit,
	.woocommerce a.button:not(.compare),
	.woocommerce button.button,
	.woocommerce input.button,
	.order-param-button a:hover,
	.scroll-wrapper > .scroll-element .scroll-bar,
	.single_add_to_cart_button,
	.qty button:hover,
	.widget_product_search button[type=submit],
	.woocommerce.widget .price_slider_amount .button,
	.vc_btn3.vc_btn3-color-primary,
	.vc_btn3.vc_btn3-color-primary.vc_btn3-style-flat,
	.vc_general.vc_cta3.vc_cta3-color-blue.vc_cta3-style-flat,
	.vc_progress_bar .vc_single_bar.bar_blue .vc_bar,
	.page-links > a:hover
	{
		background-color: $primary_color;
	}

	.woocommerce.widget .ui-slider .ui-slider-range { background: $primary_color; }

";

$output .= "

	 a:hover,
	 .compare_button,
	 .wishlist_button,
	 .theme_button:hover,
	 .button_grey_2:hover,
	 #open_shopping_cart::before,
	 .main_product .title a,
	 .small_link > [class|=icon],
	 #open_shopping_cart::before,
	 [class*=c_info_]:not(ul)::after,
	 .login_box::before,
	 #header ul.social_links > li > a:hover,
	 .product_item .product-title h4:hover
	{
		color: $primary_color;
	}

";

$output .= "

	form.search_form > *,
	form.search_form > *:first-child,
	form.search_form > *:last-child,
	form.search_form > button:hover,
	.button_blue,
	.theme_button:hover,
	.button_grey_2:hover,
	.back_to_top:hover,
	.options_list > li > a:hover,
	.options_list > li > a.selected,
	.options_list > li.chosen > a,
	form.search_form .options_list li a,
	form.search_form .options_list li:last-child a,
	form.search_form .options_list li:hover a,
	.site_setting_list a:hover,
	.widget_categories select,
	.widget_archive select,
	.widget_search input[type='text'],
	ul.page-numbers > li .current,
	ul.page-numbers > li .selected,
	ul.page-numbers > li > a:hover,
	.page-nav > [class|=page]:hover,
	.owl-nav > [class^=owl]:hover,
	.added_to_cart,
	.add_to_cart_button,
	.product_type_simple,
	.order-param-button a:hover,
	.single_add_to_cart_button,
	.qty button:hover,
	.widget_layered_nav select,
	.widget_product_search input[type=search],
	.woocommerce.widget .price_slider_amount .button,
	.widget_product_categories select,
	.vc_btn3.vc_btn3-color-primary,
	.vc_btn3.vc_btn3-color-primary.vc_btn3-style-flat,
	.page-links > a:hover
	{
		border-color: $primary_color;
	}

	.search_category .chosen-container .chosen-drop,
	.search_category, form.search_form > input[type=search],
	form.search_form > input[type=search]:first-child,
	form.search_form > button[type=submit],
	.autocomplete-suggestions
	{
		border-color: $primary_color !important;
	}

	.chosen-container .chosen-results li.chosen,
	.chosen-container .chosen-results li.highlighted { background-color: $primary_color !important; }

	@media only screen and (max-width: 767px) {
		#header .nav_item form.search_form .search_category,
		#header .main_header_row form.search_form .search_category
		{
			border-color: $primary_color;
		}
	}

";

/* Navigation Primary Color */
/*---------------------------------*/

$output .= "

	.topbar ul ul li:hover > a,
	.topbar ul ul li.current-menu-item > a,
	.topbar ul ul li.current-menu-parent > a,
	.topbar ul ul li.current-menu-ancestor > a,
	.topbar ul ul li.current_page_item > a,
	.topbar ul ul li.current_page_parent > a,
	.topbar ul ul li.current_page_ancestor > a
	{
		background-color: $primary_color;
	}

	.topbar ul ul li:hover > a,
	.topbar ul ul li.current-menu-item > a,
	.topbar ul ul li.current-menu-parent > a,
	.topbar ul ul li.current-menu-ancestor > a,
	.topbar ul ul li.current_page_item > a,
	.topbar ul ul li.current_page_parent > a,
	.topbar ul ul li.current_page_ancestor > a,
	.topbar .sub-menu li > a::before
	{
		border-color: $primary_color;
	}

";

/* Responsive Primary Color */
/*---------------------------------*/

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

/*---------------------------------*/
/* Secondary Color */
/*---------------------------------*/

$output .= "

	mark,
	.dropcap_type_2::first-letter,
	blockquote.type_2::after,
	.button_grey:hover,
	.button_grey.active,
	.button_blue:hover,
	.open_menu.active,
	.compare_button:hover,
	.wishlist_button:hover,
	.wishlist_button.active,
	.compare_button:hover::after,
	.wishlist_button:hover::after,
	.wishlist_button.active::after,
	.open_categories_sticky.active,
	.color_btn.blue::before,
	.page_wrapper .widget_meta li:hover,
	.page_wrapper .widget_links li:hover,
	.page_wrapper .widget_archive li:hover,
	.page_wrapper .widget_pages li:hover,
	.page_wrapper .widget_tag_cloud li:hover,
	.page_wrapper .widget_recent_entries li:hover,
	.page_wrapper .widget_recent_comments li:hover,
	.page_wrapper .widget_rss li:hover,
	#sidebar .widget_pages .current_page_item,
	.page_wrapper .widget_categories > ul > li:hover,
	#sidebar .widget_categories > ul > li:hover,
	.widget_search .submit-search:hover,
	.infoblock.type_2 .infoblock-content:hover [class*=button],
	.box-curtain > div,
	.comment-reply-link:hover,
	.tagcloud > a:hover,
	.post-nav-left .post-prev-button:hover,
	.post-nav-right .post-next-button:hover,
	.cwallowcookies.button:hover,
	.list-or-grid a:hover,
	.list-or-grid a.active,
	.added_to_cart:hover,
	.add_to_cart_button:hover,
	.product_type_simple:hover,
	.woocommerce #respond input#submit:hover,
	.woocommerce a.button:not(.compare):hover,
	.woocommerce button.button:hover,
	.woocommerce input.button:hover,
	.tabs-nav li:hover > a,
	.tabs-nav li.active a,
	.scroll-wrapper > .scroll-element .scroll-bar:hover,
	.single_add_to_cart_button:hover,
	#sidebar .widget_layered_nav li > a:hover,
	#sidebar .widget_layered_nav li.chosen > a,
	.widget_layered_nav_filters li > a:hover,
	.widget_product_search button[type=submit]:hover,
	.woocommerce.widget .price_slider_amount .button:hover,
	ul.product-categories > li:hover > a,
	ul.product-categories > li.current-cat-parent > a,
	ul.product-categories > li.current-cat > a,
	#open_shopping_cart.active,
	#open_shopping_cart.active::after,
	.filter_style_1 .product-filter li:hover > button,
	.filter_style_2 .product-filter li:hover > button,
	.filter_style_1 .product-filter li.active > button,
	.filter_style_2 .product-filter li.active > button,
	.vc_toggle_size_md.vc_toggle_default:not(.vc_toggle_active) .vc_toggle_title:hover .vc_toggle_icon,
	.vc_btn3.vc_btn3-color-grey:hover,
	.vc_btn3.vc_btn3-color-grey.vc_btn3-style-flat:hover,
	.vc_btn3.vc_btn3-color-grey:focus,
	.vc_btn3.vc_btn3-color-grey.vc_btn3-style-flat:focus,
	.vc_btn3.vc_btn3-color-grey:active,
	.vc_btn3.vc_btn3-color-grey.vc_btn3-style-flat:active,
	.vc_btn3.vc_btn3-color-grey.active,
	.vc_btn3.vc_btn3-color-grey.vc_btn3-style-flat.active,
	.vc_btn3.vc_btn3-color-primary:hover,
	.vc_btn3.vc_btn3-color-primary.vc_btn3-style-flat:hover,
	.vc_btn3.vc_btn3-color-primary:focus,
	.vc_btn3.vc_btn3-color-primary.vc_btn3-style-flat:focus,
	.vc_btn3.vc_btn3-color-primary:active,
	.vc_btn3.vc_btn3-color-primary.vc_btn3-style-flat:active,
	.vc_btn3.vc_btn3-color-primary.active,
	.vc_btn3.vc_btn3-color-primary.vc_btn3-style-flat.active,
	.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header:hover .ui-icon,
	.wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon,
	.vc_tta-color-blue.vc_tta-style-default .vc_tta-tab:hover > a,
	.vc_tta-color-blue.vc_tta-style-default .vc_tta-tab.vc_active > a,
	.vc_tta.vc_tta-color-blue.vc_tta-style-default .vc_tta-panel:not(.vc_active) .vc_tta-panel-title:hover .vc_tta-controls-icon.vc_tta-controls-icon-plus
	{
		background-color: $secondary_color;
	}

";

$output .= "

	.main_product .title a:hover,
	.dropcap_type_1::first-letter,
	.mail_to,
	.button_grey,
	.call_us b,
	.all, .total, .grandtotal,
	.infoblock .caption,
	.infoblock i[class|=icon],
	.call_to_action:not(.type_2) .title,
	.call_to_action.type_2 [class*=button],
	.pricing_table header,
	.pricing_table .pt_price,
	.comments:hover,
	.comment-reply-link,
	.tagcloud > a,
	.list-or-grid a,
	.special_price,
	.product_price,
	.product .price,
	table.shop_table td.sub-td .amount,
	table.shop_table .order-total,
	.cart-empty,
	.vc_color-alert-info.vc_message_box,
	.vc_color-alert-info.vc_message_box .vc_message_box-icon,
	.vc_toggle_default .vc_toggle_icon::after,
	.vc_btn3.vc_btn3-color-grey,
	.vc_btn3.vc_btn3-color-grey.vc_btn3-style-flat,
	.vc_btn3.vc_btn3-color-white,
	.vc_btn3.vc_btn3-color-white.vc_btn3-style-flat,
	.vc_btn3.vc_btn3-color-white:hover,
	.vc_btn3.vc_btn3-color-white.vc_btn3-style-flat:hover,
	.vc_btn3.vc_btn3-color-white:focus,
	.vc_btn3.vc_btn3-color-white.vc_btn3-style-flat:focus,
	.wpb_accordion .wpb_accordion_wrapper .ui-state-default .ui-icon,
	.vc_tta.vc_tta-color-blue.vc_tta-style-default .vc_tta-controls-icon.vc_tta-controls-icon-plus::after,
	.product_info > span.amount,
	.woocommerce .wishlist_table td > span.amount,
	.woocommerce .wishlist_table ins span.amount,
	.product_info ins
	{
		color: $secondary_color;
	}

";

$output .= "

	.open_menu.active,
	.compare_button:hover,
	.wishlist_button:hover,
	.wishlist_button.active,
	.compare_button:hover::after,
	.wishlist_button:hover::after,
	.wishlist_button.active::after,
	form input:not([type=submit]).info,
	form.search_form > button:hover,
	.page_wrapper .widget_meta li:hover,
	.page_wrapper .widget_links li:hover,
	.page_wrapper .widget_archive li:hover,
	.page_wrapper .widget_pages li:hover,
	.page_wrapper .widget_tag_cloud li:hover,
	.page_wrapper .widget_recent_entries li:hover,
	.page_wrapper .widget_recent_comments li:hover,
	.page_wrapper .widget_rss li:hover,
	#sidebar .widget_pages .current_page_item,
	.page_wrapper .widget_categories > ul > li:hover,
	#sidebar .widget_categories > ul > li:hover,
	.cart-empty,
	#sidebar .widget_layered_nav li > a:hover,
	#sidebar .widget_layered_nav li.chosen > a,
	ul.product-categories > li:hover > a,
	ul.product-categories > li.current-cat-parent > a,
	ul.product-categories > li.current-cat > a,
	#open_shopping_cart.active,
	#open_shopping_cart.active::after,
	.filter_style_1 .product-filter li:hover > button,
	.filter_style_2 .product-filter li:hover > button,
	.filter_style_1 .product-filter li.active > button,
	.filter_style_2 .product-filter li.active > button,
	.vc_btn3.vc_btn3-color-primary:hover,
	.vc_btn3.vc_btn3-color-primary.vc_btn3-style-flat:hover,
	.vc_btn3.vc_btn3-color-primary:focus,
	.vc_btn3.vc_btn3-color-primary.vc_btn3-style-flat:focus,
	.vc_btn3.vc_btn3-color-primary:active,
	.vc_btn3.vc_btn3-color-primary.vc_btn3-style-flat:active,
	.vc_btn3.vc_btn3-color-primary.active,
	.vc_btn3.vc_btn3-color-primary.vc_btn3-style-flat.active
	{
		border-color: $secondary_color;
	}

";

$output .= "

	body .woof-reset-navigation {
		color: $secondary_color;
	}

	.ts_nav > li.active > a,
	.ts_nav > li:hover > a,
	.tabs_nav > li.active > a,
	.tabs_nav > li:hover > a,
	body .woof_list_label li .woof_label_term:hover,
	body .woof_list_label li .woof_label_term.checked,
	body .woof-reset-navigation:hover,
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
		color: $secondary_color;
	}

	.main_navigation > ul ul li > a::before,
	.full_width_nav > ul ul li > a::before,

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
	.widget_nav_menu .menu > li.current_page_ancestor > a
	{
		border-color: $secondary_color;
	}

";

/* Responsive Secondary Color */
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
			background-color: $secondary_color;
		}

		.mobile-advanced ul ul li > a:before {
			color: $secondary_color;
		}

		#advanced-menu-hide { background-color: $secondary_color; }

	}

";

if (defined('DOKAN_LOAD_STYLE')) {

	/* Responsive Secondary Color */
	/*---------------------------------*/

	$output .= "
	.dokan-theme-shopme .dokan-category-menu li:hover > a {
		border-color: $secondary_color;
		background-color: $secondary_color;
	}
	";

}

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