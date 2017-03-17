<?php

// Include Google Webfonts
include('register-google-webfonts.php');

// Include Color Schemes
include('register-color-schemes.php');

/* ---------------------------------------------------------------------- */
/*	Pages Elements
/* ---------------------------------------------------------------------- */

$shopme_pages = array(
	array(
		'title' =>  esc_html__('Theme Options', 'shopme'),
		'slug' => 'shopme',
		'class' => 'admin-icon-general',
		'parent'=> 'shopme',
	),
	array(
		'title' =>  esc_html__('Styling Options', 'shopme'),
		'slug' => 'styling',
		'class' => 'admin-icon-styling',
		'parent'=> 'shopme',
	),
	array(
		'title' =>  esc_html__('Header', 'shopme'),
		'slug' => 'header',
		'class' => 'admin-icon-header',
		'parent'=> 'shopme',
	),
	array(
		'title' =>  esc_html__('Pages', 'shopme'),
		'slug' => 'page',
		'class' => 'admin-icon-header',
		'parent'=> 'shopme',
	),
	array(
		'title' =>  esc_html__('Sidebar', 'shopme'),
		'slug' => 'sidebar',
		'class' => 'admin-icon-sidebar',
		'parent'=> 'shopme',
	),
	array(
		'title' =>  esc_html__('Blog', 'shopme'),
		'slug' => 'blog',
		'class' => 'admin-icon-blog',
		'parent'=> 'shopme',
	),
	array(
		'title' =>  esc_html__('Testimonials', 'shopme'),
		'slug' => 'testimonials',
		'class' => 'admin-icon-testimonials',
		'parent'=> 'shopme',
	),
	array(
		'title' =>  esc_html__('Footer', 'shopme'),
		'slug' => 'footer',
		'class' => 'admin-icon-footer',
		'parent'=> 'shopme',
	),
	array(
		'title' =>  esc_html__('Shop', 'shopme'),
		'slug' => 'shop',
		'class' => 'admin-icon-shop',
		'parent'=> 'shopme',
	),
	array(
		'title' =>  esc_html__('Side Tabbed Panel', 'shopme'),
		'slug' => 'admin',
		'class' => 'admin-icon-panel',
		'parent'=> 'shopme',
	),
	array(
		'title' =>  esc_html__('Sitemap', 'shopme'),
		'slug' => 'sitemap',
		'class' => 'admin-icon-sitemap',
		'parent'=> 'shopme',
	),
	array(
		'title' =>  esc_html__('Import / Export', 'shopme'),
		'slug' => 'import',
		'class' => 'admin-icon-import',
		'parent'=> 'shopme',
	)
);

/* ---------------------------------------------------------------------- */
/*	General Elements
/* ---------------------------------------------------------------------- */

$shopme_elements[] = array(
	"slug"	=> "shopme",
	"type" 	=> "hidden",
	"id" 	=> "favicon_upload",
	"desc" 	=> '',
	"std" => '1513',
	"dependence" => 'favicon'
);

$shopme_elements[] = array(
	"name" 	=> esc_html__('Favicon', 'shopme'),
	"slug"	=> "shopme",
	"type" 	=> "upload",
	"data" 	=> array(
		'title' => esc_html__('Upload Favicon', 'shopme'),
		'text' => esc_html__('Upload', 'shopme')
	),
	"id" 	=> "favicon",
	"desc" 	=> esc_html__('Display site icon meta tags.', 'shopme'),
	"std" => SHOPME_BASE_URI . 'images/fav_icon.png'
);

	/* ---------------------------------------------------------------------- */
	/*	Logo
	/* ---------------------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Logo Settings', 'shopme'),
		"slug"	=> "shopme",
		"type" 	=> "heading",
		"desc" 	=> "",
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Type Logo', 'shopme'),
		"slug"	=> "shopme",
		"type" 	=> "buttons_set",
		"id" 	=> "logo_type",
		"options" => array(
			'text' => esc_html__('Text Logo', 'shopme'),
			'upload' => esc_html__('Upload Logo', 'shopme')
		),
		"std"	=> 'upload',
		"desc" 	=> esc_html__('Choose type logo text or image', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Text Logo', 'shopme'),
		"slug"	=> "shopme",
		"type" 	=> "editor",
		"id" 	=> "logo_text",
		"desc" 	=> esc_html__("If you don't have logo image, write Your Text logo. All Logo text settings you can find in Styling Options Section", 'shopme'),
		"required" => array("logo_type", 'text'),
		"std"	=> 'shopme'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Upload Logo', 'shopme'),
		"slug"	=> "shopme",
		"type" 	=> "upload",
		"id" 	=> "logo_image",
		"desc" 	=> esc_html__('Upload your logo image. Your logo image width must be no more than 266px', 'shopme'),
		"required" => array("logo_type", 'upload'),
		"std"   => SHOPME_BASE_URI . 'images/logo.png'
	);

	/* --------------------------------------------------------- */
	/* Mailchimp Api Settings
	/* --------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Mailchimp Api Settings', 'shopme'),
		"slug"	=> "shopme",
		"type" 	=> "heading",
		"desc" 	=> "",
	);

	$shopme_elements[] =	array(
		"name" 	=> esc_html__('Enter your Mailchimp Api', 'shopme'),
		"slug"	=> "shopme",
		"type" 	=> "text",
		"id" 	=> "mad_mailchimp_api",
		"std"   => "47a1e8e482153a3a553b5f20a2660db7-us4",
		"desc" 	=> wp_kses(__("Please enter your MailChimp API Key. The API Key allows your WordPress site to communicate with your MailChimp account. For help, visit the MailChimp Support article : <a target='_blank' href='http://kb.mailchimp.com/article/where-can-i-find-my-api-key'>Where can I find my API Key?</a>", 'shopme'), array('a' => array('href' => array(), 'target' => array())))
	);

	$shopme_elements[] =	array(
		"name" 	=> esc_html__('Enter your Mailchimp Id', 'shopme'),
		"slug"	=> "shopme",
		"type" 	=> "text",
		"id" 	=> "mad_mailchimp_id",
		"std"   => "5b95a7c729",
		"desc" 	=> wp_kses(__("<a target='_blank' href='http://kb.mailchimp.com/article/how-can-i-find-my-list-id'>Where can I find List ID?</a>", 'shopme'), array('a' => array('href' => array(), 'target' => array())))
	);

	$shopme_elements[] =	array(
		"name" 	=> __('Enter your Mailchimp data center(e.g. us4)', 'shopme'),
		"slug"	=> "shopme",
		"type" 	=> "text",
		"id" 	=> "mad_mailchimp_center",
		"desc" 	=> " ",
		"std" => 'us4'
	);

	/* --------------------------------------------------------- */
	/* Analytics Tracking Code
	/* --------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Google Analytics Tracking Code', 'shopme'),
		"slug"	=> "shopme",
		"type" 	=> "textarea",
		"id" 	=> "analytics",
		"desc" 	=> esc_html__('Enter your Google analytics tracking code here. Tracking ID UA - .......', 'shopme'),
	);

	/* --------------------------------------------------------- */
	/* Google Maps API
	/* --------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Google Maps', 'shopme'),
		"slug"	=> 'shopme',
		"type" 	=> "heading",
		"desc" 	=> esc_html__('Google recently changed the way their map service works. New pages which want to use Google Maps need to register an API key for their website. Older pages should  work fine without this API key. If the google map elements of this theme do not work properly you need to register a new API key.', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Google Maps API Key', 'shopme'),
		"slug"	=> 'shopme',
		"type" 	=> "textarea",
		"id" 	=> "api-key-google-maps",
		"desc" 	=> esc_html__('Enter a valid Google Maps API Key to use all map related theme functions.', 'shopme'),
		"std"   => ""
	);

	/* --------------------------------------------------------- */
	/* Cookie Alert Settings
	/* --------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Cookie Alert Settings', 'shopme'),
		"slug"	=> "shopme",
		"type" 	=> "heading",
		"desc" 	=> "",
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Show Cookie Alert?', 'shopme'),
		"slug"	=> "shopme",
		"type" 	=> "buttons_set",
		"id" 	=> "cookie_alert",
		"options" => array(
			'show'  => esc_html__('Show', 'shopme'),
			'hide' => esc_html__('Hide', 'shopme')
		),
		"std" => 'hide',
		"desc" 	=> esc_html__('Show or hide cookie alert', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Cookie Alert Message', 'shopme'),
		"slug"	=> "shopme",
		"type" 	=> "textarea",
		"id" 	=> "cookie_alert_message",
		"desc" 	=> esc_html__('Message for cookie alert', 'shopme'),
		"std"   => esc_html__('Please note this website requires cookies in order to function correctly, they do not store any specific information about you personally.', 'shopme')
	);

	$shopme_elements[] =	array(
		"name" 	=> esc_html__('Button Read More Link', 'shopme'),
		"slug"	=> "shopme",
		"type" 	=> "text",
		"id" 	=> "cookie_alert_read_more_link",
		"desc" 	=> esc_html__('Input link for button read more', 'shopme'),
		"std" => 'http://www.cookielaw.org/the-cookie-law'
	);

	/* --------------------------------------------------------- */
	/* 404 Page Options
	/* --------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('404 Page Options', 'shopme'),
		"slug"	=> "shopme",
		"type" 	=> "heading",
		"desc" 	=> " ",
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('404 Content', 'shopme'),
		"slug"	=> "shopme",
		"type" 	=> "editor",
		"rows"  => 10,
		"id" 	=> "440_content",
		"std"   => "<h1>404</h1>
			<h3>" . esc_html__('Page Not Found!', 'shopme') ."</h3>
			<p>" . esc_html__('We\'re sorry, but we can\'t find the page you were looking for. It\'s probably some thing we\'ve done wrong but now we know about it and we\'ll try to fix it. In the meantime, try one of these options:', 'shopme') . "</p>",
		"desc" 	=> esc_html__("Enter your text for 404 page", 'shopme'),
	);

	/* --------------------------------------------------------- */
	/* Other Options
	/* --------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Other Theme Options', 'shopme'),
		"slug"	=> "shopme",
		"type" 	=> "heading",
		"desc" 	=> " ",
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Show query loader', 'shopme'),
		"slug"	=> "shopme",
		"type" 	=> "switch_set",
		"id" 	=> "query-loader",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"std" => '0',
		"desc" 	=> esc_html__('Show query loader on pages', 'shopme'),
	);

/* ---------------------------------------------------------------------- */
/*	Styling Elements
/* ---------------------------------------------------------------------- */

	/* --------------------------------------------------------- */
	/*	Styling Tabs
	/* --------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('General Styling', 'shopme'),
		"slug"	=> "styling",
		"type" 	=> "heading",
		"desc" 	=> esc_html__('Change the theme style settings', 'shopme'),
	);

	$shopme_elements[] =	array(
		"slug"	=> "styling",
		"name" 	=> esc_html__("Select a color scheme", 'shopme'),
		"desc" 	=> esc_html__("Choose a color scheme here.", 'shopme'),
		"id" 	=> "color_scheme",
		"type" 	=> "color_schemes",
		"std" 	=> "scheme_default",
		"options" => $shopme_color_schemes
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Additional Color', 'shopme'),
		"slug"	=> "styling",
		"type" 	=> "color",
		"id" 	=> "styles-additional_color",
		"std" 	=> "#49c684",
		"default" 	=> "#49c684",
		"required" => array("color_scheme", 'scheme_style_1'),
		"desc" 	=> esc_html__('Color for additional elements', 'shopme'),
	);

	// start tab container
	$shopme_elements[] = array(
		"slug"	=> "styling",
		"type" => "tab_group_start",
		"id" => "styling_tab_container",
		"class" => 'mad-tab-container',
		"desc" => false
	);

		// start 1 tab
		$shopme_elements[] = array(
			'name'=> esc_html__('General', 'shopme'),
			"slug"	=> "styling",
			"type" => "tab_group_start",
			"id" => "styling_tab_1",
			"class" => "mad_tab",
			"desc" => false
		);

			$shopme_elements[] =	array(
				"name" 	=> esc_html__('General Background Color', 'shopme'),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-general_body_bg_color",
				"std" 	=> "#004969",
				"default" 	=> "#004969",
				"desc" 	=> esc_html__('General background color', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('General Background Image', 'shopme'),
				"slug"	=> "styling",
				"type" 	=> "select",
				"id" 	=> "styles-bg_img",
				"options" => array(
					'' => esc_html__('No Background Image', 'shopme'),
					'custom' => esc_html__('Upload Image', 'shopme')
				),
				"desc" 	=> esc_html__('The background image of your Body', 'shopme')
			);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('Upload Background Image', 'shopme'),
				"slug"	=> "styling",
				"type" 	=> "upload",
				"id" 	=> "styles-body_bg_image",
				"desc" 	=> esc_html__('Upload background image of your body', 'shopme'),
				"required" => array("styles-bg_img", 'custom'),
				"std"   => ''
			);

			$shopme_elements[] = array(
				"name" => esc_html__('Repeat', 'shopme'),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-body_repeat",
				"options" => array(
					'no-repeat' => esc_html__('No Repeat', 'shopme'),
					'repeat' => esc_html__('Repeat', 'shopme'),
					'repeat-x' => esc_html__('Repeat Horizontally', 'shopme'),
					'repeat-y' => esc_html__('Repeat Vertically', 'shopme')
				),
				"std" => 'no-repeat',
				"required" => array("styles-bg_img", 'custom'),
				"desc" 	=> esc_html__('Select the repeat mode for the background image', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" => esc_html__('Position', 'shopme'),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-body_position",
				"options" => array(
					'top center' => esc_html__('Top center', 'shopme'),
					'top left' => esc_html__('Top left', 'shopme'),
					'top right' => esc_html__('Top right', 'shopme'),
					'bottom left' => esc_html__('Bottom left', 'shopme'),
					'bottom center' => esc_html__('Bottom center', 'shopme'),
					'bottom right' => esc_html__('Bottom right', 'shopme')
				),
				"std" => 'top center',
				"required" => array("styles-bg_img", 'custom'),
				"desc" 	=> esc_html__('Select the position for the background image', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" => esc_html__('Attachment', 'shopme'),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-body_attachment",
				"options" => array(
					'fixed' => esc_html__('Fixed', 'shopme'),
					'scroll' => esc_html__('Scroll', 'shopme')
				),
				"std" => 'yes',
				"required" => array("styles-bg_img", 'custom'),
				"desc" 	=> esc_html__('Select the attachment for the background image', 'shopme'),
			);


			$shopme_elements[] = array(
				"name" 	=> esc_html__('General Font Color', 'shopme'),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-general_font_color",
				"std" 	=> "#777",
				"default" 	=> "#777",
				"desc" 	=> esc_html__('General font color', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" => esc_html__("General Font Size", 'shopme'),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-general_font_size",
				"options" => "range",
				"range" => "12-30",
				"std" => "14px",
				"desc" => esc_html__('General font size', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" => esc_html__('General Font Family', 'shopme'),
				"slug" => "styling",
				"type" => "select",
				"id" => "general_google_webfont",
				"options" => $shopme_google_webfonts,
				"std" => "Roboto:300,300italic,400,400italic,500,700,700italic,900,900italic",
				"desc" => esc_html__('General font family', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('Primary Color', 'shopme'),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-primary_color",
				"std" 	=> "#4ac4fa",
				"default" 	=> "#4ac4fa",
				"desc" 	=> esc_html__('Key color', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('Secondary Color', 'shopme'),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-secondary_color",
				"std" 	=> "#018bc8",
				"default" 	=> "#018bc8",
				"desc" 	=> esc_html__('Color for link hover and other', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('Selection Background Color', 'shopme'),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-highlight_bg_color",
				"std" 	=> "#018bc8",
				"default" 	=> "#018bc8",
				"desc" 	=> esc_html__('Highlight and selection background color', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('Selection Text Color', 'shopme'),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-highlight_text_color",
				"std" 	=> "#fff",
				"default" 	=> "#fff",
				"desc" 	=> esc_html__('Highlight and selection text color', 'shopme'),
			);

		// end 1 tab
		$shopme_elements[] = array(
			"slug"	=> "styling",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 2 tab
		$shopme_elements[] = array(
			'name'=> esc_html__('Content', 'shopme'),
			"slug"	=> "styling",
			"type" => "tab_group_start",
			"id" => "styling_tab_2",
			"class" => "mad_tab",
			"desc" => false
		);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('Content Background Color', 'shopme'),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-page_wrapper_bg_color",
				"std" 	=> "#f8f8f8",
				"default" 	=> "#f8f8f8",
				"desc" 	=> esc_html__('Content background color', 'shopme'),
			);

		// end 2 tab
		$shopme_elements[] = array(
			"slug"	=> "styling",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 3 tab
		$shopme_elements[] = array(
			'name'=> esc_html__('Header', 'shopme'),
			"slug"	=> "styling",
			"type" => "tab_group_start",
			"id" => "styling_tab_3",
			"class" => "mad_tab",
			"desc" => false
		);

			$shopme_elements[] =	array(
				"name" 	=> esc_html__('Header Background Color', 'shopme'),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-header_bg_color",
				"std" 	=> "#ffffff",
				"default" 	=> "#ffffff",
				"desc" 	=> esc_html__('Header background color', 'shopme'),
			);

		// end 3 tab
		$shopme_elements[] = array(
			"slug"	=> "styling",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 4 tab
		$shopme_elements[] = array(
			'name'=> esc_html__('Logo', 'shopme'),
			"slug"	=> "styling",
			"type" => "tab_group_start",
			"id" => "styling_tab_4",
			"class" => "mad_tab",
			"desc" => false
		);

			$shopme_elements[] =	array(
				"name" 	=> esc_html__('Logo Text Color', 'shopme'),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-logo_font_color",
				"std" 	=> "#018bc8",
				"default" 	=> "#018bc8",
				"desc" 	=> esc_html__('Logo text color', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" => esc_html__('Logo Font Size', 'shopme'),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-logo_font_size",
				"options" => "range",
				"range" => "40-65",
				"std" => "50px",
				"desc" => esc_html__('Logo Font size', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" => esc_html__('Logo Font Family', 'shopme'),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-logo_font_family",
				"options" => $shopme_google_webfonts,
				"std" => "Roboto:300,300italic,400,400italic,500,700,700italic,900,900italic",
				"desc" => esc_html__('Logo Font Family', 'shopme'),
			);

		// end 4 tab
		$shopme_elements[] = array(
			"slug"	=> "styling",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 5 tab
		$shopme_elements[] = array(
			'name'=> esc_html__('Footer', 'shopme'),
			"slug"	=> "styling",
			"type" => "tab_group_start",
			"id" => "styling_tab_5",
			"class" => "mad_tab",
			"desc" => false
		);

			$shopme_elements[] =	array(
				"name" 	=> esc_html__('Footer Background Color', 'shopme'),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-footer_bg_color",
				"std" 	=> "#ffffff",
				"default" 	=> "#ffffff",
				"desc" 	=> esc_html__('Footer background color', 'shopme'),
			);

		// end 5 tab
		$shopme_elements[] = array(
			"slug"	=> "styling",
			"type" => "tab_group_end",
			"desc" => false
		);

	// end tab container
	$shopme_elements[] = array(
		"slug"	=> "styling",
		"type" => "tab_group_end",
		"desc" => false
	);

	/* --------------------------------------------------------- */
	/*	All Headings Styling
	/* --------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('All Headings (H1-H6)', 'shopme'),
		"slug"	=> "styling",
		"type" 	=> "heading",
		"desc" 	=> esc_html__('Change All Headings style settings', 'shopme'),
	);

	// start tab container
	$shopme_elements[] = array(
		"slug"	=> "styling",
		"type" => "tab_group_start",
		"id" => "headings_tab_container",
		"class" => 'mad-tab-container',
		"desc" => false
	);

		// start 1 tab
		$shopme_elements[] = array(
			'name'=> esc_html__('H1', 'shopme'),
			"slug"	=> "styling",
			"type" => "tab_group_start",
			"id" => "h1_tab_1",
			"class" => "mad_tab",
			"desc" => false
		);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('Font Color', 'shopme'),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-h1_font_color",
				"std" 	=> "#333",
				"default" 	=> "#333",
				"desc" 	=> esc_html__('Heading Color', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" => esc_html__('Font Size', 'shopme'),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h1_font_size",
				"options" => "range",
				"range" => "30-40",
				"unit" => 'px',
				"std" => "30px",
				"desc" => esc_html__('Font size', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" => esc_html__('Font Family', 'shopme'),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h1_font_family",
				"options" => $shopme_google_webfonts,
				"std" => "Roboto:300,300italic,400,400italic,500,700,700italic,900,900italic",
				"desc" => esc_html__('Choose Font Family', 'shopme'),
			);

		// end 1 tab
		$shopme_elements[] = array(
			"slug"	=> "styling",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 2 tab
		$shopme_elements[] = array(
			'name'=> esc_html__('H2', 'shopme'),
			"slug"	=> "styling",
			"type" => "tab_group_start",
			"id" => "h2_tab_2",
			"class" => "mad_tab",
			"desc" => false
		);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('Font Color', 'shopme'),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-h2_font_color",
				"std" 	=> "#333",
				"default" 	=> "#333",
				"desc" 	=> esc_html__('Heading Color', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" => esc_html__('Font Size', 'shopme'),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h2_font_size",
				"options" => "range",
				"range" => "22-30",
				"unit" => 'px',
				"std" => "24px",
				"desc" => esc_html__('Font size', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" => esc_html__('Font Family', 'shopme'),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h2_font_family",
				"options" => $shopme_google_webfonts,
				"std" => "Roboto:300,300italic,400,400italic,500,700,700italic,900,900italic",
				"desc" => esc_html__('Choose Font Family', 'shopme'),
			);

		// end 2 tab
		$shopme_elements[] = array(
			"slug"	=> "styling",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 3 tab
		$shopme_elements[] = array(
			'name'=> esc_html__('H3', 'shopme'),
			"slug"	=> "styling",
			"type" => "tab_group_start",
			"id" => "h3_tab_3",
			"class" => "mad_tab",
			"desc" => false
		);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('Font Color', 'shopme'),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-h3_font_color",
				"std" 	=> "#333",
				"default" 	=> "#333",
				"desc" 	=> esc_html__('Heading Color', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" => esc_html__('Font Size', 'shopme'),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h3_font_size",
				"options" => "range",
				"range" => "18-24",
				"unit" => 'px',
				"std" => "22px",
				"desc" => esc_html__('Font size', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" => esc_html__('Font Family', 'shopme'),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h3_font_family",
				"options" => $shopme_google_webfonts,
				"std" => "Roboto:300,300italic,400,400italic,500,700,700italic,900,900italic",
				"desc" => esc_html__('Choose Font Family', 'shopme'),
			);

		// end 3 tab
		$shopme_elements[] = array(
			"slug"	=> "styling",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 4 tab
		$shopme_elements[] = array(
			'name'=> esc_html__('H4', 'shopme'),
			"slug"	=> "styling",
			"type" => "tab_group_start",
			"id" => "h4_tab_4",
			"class" => "mad_tab",
			"desc" => false
		);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('Font Color', 'shopme'),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-h4_font_color",
				"std" 	=> "#333",
				"default" 	=> "#333",
				"desc" 	=> esc_html__('Heading Color', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" => esc_html__('Font Size', 'shopme'),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h4_font_size",
				"options" => "range",
				"range" => "16-22",
				"unit" => 'px',
				"std" => "18px",
				"desc" => esc_html__('Font size', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" => esc_html__('Font Family', 'shopme'),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h4_font_family",
				"options" => $shopme_google_webfonts,
				"std" => "Roboto:300,300italic,400,400italic,500,700,700italic,900,900italic",
				"desc" => esc_html__('Choose Font Family', 'shopme'),
			);

		// end 4 tab
		$shopme_elements[] = array(
			"slug"	=> "styling",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 5 tab
		$shopme_elements[] = array(
			'name'=> esc_html__('H5', 'shopme'),
			"slug"	=> "styling",
			"type" => "tab_group_start",
			"id" => "h5_tab_5",
			"class" => "mad_tab",
			"desc" => false
		);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('Font Color', 'shopme'),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-h5_font_color",
				"std" 	=> "#333",
				"default" 	=> "#333",
				"desc" 	=> esc_html__('Heading Color', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" => esc_html__('Font Size', 'shopme'),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h5_font_size",
				"options" => "range",
				"unit" => 'px',
				"range" => "14-20",
				"std" => "16px",
				"desc" => esc_html__('Font size', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" => esc_html__('Font Family', 'shopme'),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h5_font_family",
				"options" => $shopme_google_webfonts,
				"std" => "Roboto:300,300italic,400,400italic,500,700,700italic,900,900italic",
				"desc" => esc_html__('Choose Font Family', 'shopme'),
			);

		// end 5 tab
		$shopme_elements[] = array(
			"slug"	=> "styling",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 6 tab
		$shopme_elements[] = array(
			'name'=> esc_html__('H6', 'shopme'),
			"slug"	=> "styling",
			"type" => "tab_group_start",
			"id" => "h6_tab_6",
			"class" => "mad_tab",
			"desc" => false
		);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('Font Color', 'shopme'),
				"slug"	=> "styling",
				"type" 	=> "color",
				"id" 	=> "styles-h6_font_color",
				"std" 	=> "#333",
				"default" 	=> "#333",
				"desc" 	=> esc_html__('Heading Color', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" => esc_html__('Font Size', 'shopme'),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h6_font_size",
				"options" => "range",
				"range" => "12-18",
				"unit" => 'px',
				"std" => "14px",
				"desc" => esc_html__('Font size', 'shopme'),
			);

			$shopme_elements[] = array(
				"name" => esc_html__('Font Family', 'shopme'),
				"slug" => "styling",
				"type" => "select",
				"id" => "styles-h6_font_family",
				"options" => $shopme_google_webfonts,
				"std" => "Roboto:300,300italic,400,400italic,500,700,700italic,900,900italic",
				"desc" => esc_html__('Choose Font Family', 'shopme'),
			);

		// end 6 tab
		$shopme_elements[] = array(
			"slug"	=> "styling",
			"type" => "tab_group_end",
			"desc" => false
		);

	// end tab container
	$shopme_elements[] = array(
		"slug"	=> "styling",
		"type" => "tab_group_end",
		"desc" => false
	);

	/* --------------------------------------------------------- */
	/*	Custom Quick CSS
	/* --------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Custom Quick CSS', 'shopme'),
		"slug"	=> "styling",
		"type" 	=> "textarea",
		"id" 	=> "custom_quick_css",
		"desc" 	=> esc_html__('Here you can make some quick changes in CSS', 'shopme'),
	);

/* ---------------------------------------------------------------------- */
/*	Header Elements
/* ---------------------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Header Layout', 'shopme'),
		"slug"	=> "header",
		"type" 	=> "select",
		"id" 	=> "header_layout",
		"options" => array(
			'type_1' => esc_html__('Header 1', 'shopme'),
			'type_2' => esc_html__('Header 2', 'shopme'),
			'type_3' => esc_html__('Header 3', 'shopme'),
			'type_4' => esc_html__('Header 4', 'shopme'),
			'type_5' => esc_html__('Header 5', 'shopme'),
			'type_6' => esc_html__('Header 6', 'shopme')
		),
		"std" => 'type_6',
		"desc" 	=> esc_html__('Choose your default header style', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Mega Main Menu', 'shopme'),
		"slug"	=> "header",
		"type" 	=> "switch_set",
		"id" 	=> "compatible_with_mega_menu",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"std" => true,
		"desc" 	=> esc_html__('Used compatible with theme', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Sticky Navigation', 'shopme'),
		"slug"	=> "header",
		"type" 	=> "switch_set",
		"id" 	=> "sticky_navigation",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"std" => true,
		"desc" 	=> esc_html__('The sticky navigation menu is a vital part of a website, helping users move between pages and find desired information.', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Hide top menu on mobile devices', 'shopme'),
		"slug"	=> "header",
		"type" 	=> "switch_set",
		"id" 	=> "hide_top_menu_mobile",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"std" => false,
		"desc" 	=> esc_html__('Hide top menu on mobile devices ( for header type 1 )', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" => esc_html__('Search Content Type', 'shopme'),
		"slug" => "header",
		"type" => "buttons_set",
		"id" => "search-type",
		"options" => array(
			'all' => esc_html__('All', 'shopme'),
			'post' => esc_html__('Post', 'shopme'),
			'product' => esc_html__('Product', 'shopme')
		),
		"std" => 'product',
		"desc" 	=> esc_html__('Choose search content type in search form', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Show search, wishlist, compare, currency, language, cart in header', 'shopme'),
		"slug"	=> "header",
		"type" 	=> "heading",
		"heading" => "h4",
		"desc" 	=> esc_html__('Header parameters', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Show Search', 'shopme'),
		"slug"	=> "header",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "show_search",
		"desc" 	=> " ",
		"label" => esc_html__('If checked show', 'shopme'),
		"class" => 'mad_4col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Show Language', 'shopme'),
		"slug"	=> "header",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "show_language",
		"desc" 	=> " ",
		"label" => esc_html__('If checked show', 'shopme'),
		"class" => 'mad_4col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Show Currency', 'shopme'),
		"slug"	=> "header",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "show_currency",
		"desc" 	=> " ",
		"label" => esc_html__('If checked show', 'shopme'),
		"class" => 'mad_4col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Show Cart', 'shopme'),
		"slug"	=> "header",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "show_cart",
		"desc" 	=> " ",
		"label" => esc_html__('If checked show', 'shopme'),
		"class" => 'mad_4col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Rotate transform', 'shopme'),
		"slug"	=> "header",
		"type" 	=> "switch_set",
		"id" 	=> "header_rotate_transform",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"std" => true,
		"desc" 	=> esc_html__('If yes to enable rotate transform in header', 'shopme')
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Visible dropdown', 'shopme'),
		"slug"	=> "header",
		"type" 	=> "switch_set",
		"id" 	=> "header_visible_dropdown",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"std" => false,
		"desc" 	=> esc_html__('If yes to visible dropdown in secondary navigation', 'shopme')
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Feedback phone number', 'shopme'),
		"slug"	=> "header",
		"type" 	=> "textarea",
		"id" 	=> "call_us",
		"std"	=> "",
		"desc" 	=> esc_html__('Enter your phone number for feedback', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Facebook Link', 'shopme'),
		"slug"	=> "header",
		"type" 	=> "text",
		"id" 	=> "facebook_link",
		"desc" 	=> " ",
		"std" => "http://www.facebook.com",
		"class" => 'mad_2col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Twitter Link', 'shopme'),
		"slug"	=> "header",
		"type" 	=> "text",
		"id" 	=> "twitter_link",
		"desc" 	=> " ",
		"std" => "https://twitter.com",
		"class" => 'mad_2col',
		"clear" => 'both'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Google Plus Link ', 'shopme'),
		"slug"	=> "header",
		"type" 	=> "text",
		"id" 	=> "gplus_link",
		"desc" 	=> " ",
		"std" => "https://plus.google.com/",
		"class" => 'mad_2col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Pinterest Link', 'shopme'),
		"slug"	=> "header",
		"type" 	=> "text",
		"id" 	=> "pinterest_link",
		"desc" 	=> " ",
		"std" => "https://www.pinterest.com/",
		"class" => 'mad_2col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Instagram Link', 'shopme'),
		"slug"	=> "header",
		"type" 	=> "text",
		"id" 	=> "instagram_link",
		"desc" 	=> " ",
		"std" => "https://instagram.com",
		"class" => 'mad_2col',
		'clear' => 'both'
	);

/* ---------------------------------------------------------------------- */
/*	Page Elements
/* ---------------------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Page Layout', 'shopme'),
		"slug"	=> "page",
		"type" 	=> "buttons_set",
		"id" 	=> "page_layout",
		"options" => array(
			'wide_layout' => esc_html__('Wide Layout', 'shopme'),
			'boxed_layout' => esc_html__('Boxed Layout', 'shopme')
		),
		"std" => 'wide_layout',
		"desc" 	=> esc_html__('Choose a default page layout style', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Breadcrumbs on page', 'shopme'),
		"slug"	=> "page",
		"type" 	=> "switch_set",
		"id" 	=> "page_breadcrumbs",
		"options" => array(
			'on' => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"std" => true,
		"desc" 	=> esc_html__('Show or hide breadcrumbs by default on page', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Breadcrumbs on single page', 'shopme'),
		"slug"	=> "page",
		"type" 	=> "switch_set",
		"id" 	=> "single_breadcrumbs",
		"options" => array(
			'on' => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"std" => true,
		"desc" 	=> esc_html__('Show or hide breadcrumbs by default on single page', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Animation on Pages', 'shopme'),
		"slug"	=> "page",
		"type" 	=> "switch_set",
		"id" 	=> "animation",
		"options" => array(
			'on' => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme'),
		),
		"std" => true,
		"desc" 	=> esc_html__('Choose yes for shortcodes animation', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Smooth Scroll', 'shopme'),
		"slug"	=> "page",
		"type" 	=> "switch_set",
		"id" 	=> "smooth_scroll",
		"options" => array(
			'on' => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme'),
		),
		"std" => true,
		"desc" 	=> esc_html__('Choose yes to enable smooth scrolling in the browser chrome', 'shopme'),
	);

/* ---------------------------------------------------------------------- */
/*	Sidebar Elements
/* ---------------------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Sidebar Settings', 'shopme'),
		"slug"	=> "sidebar",
		"type" 	=> "heading",
		"heading" => "h4",
		"desc" 	=> esc_html__('Parameters for sidebar', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Sidebar on Pages', 'shopme'),
		"slug"	=> "sidebar",
		"type" 	=> "buttons_set",
		"id" 	=> "sidebar_page_position",
		"options" => array(
			'sbl' => esc_html__('Left', 'shopme'),
			'sbr' => esc_html__('Right', 'shopme'),
			'no_sidebar' => esc_html__('No Sidebar', 'shopme')
		),
		"std" => 'sbl',
		"desc" 	=> esc_html__('Choose the default page sidebar position', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Sidebar on Archive Pages', 'shopme'),
		"slug"	=> "sidebar",
		"type" 	=> "buttons_set",
		"id" 	=> "C",
		"options" => array(
			'sbl' => esc_html__('Left', 'shopme'),
			'sbr' => esc_html__('Right', 'shopme'),
			'no_sidebar' => esc_html__('No Sidebar', 'shopme')
		),
		"std" => 'sbr',
		"desc" 	=> esc_html__('Choose the archive sidebar position', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Position Sidebar for mobile devices', 'shopme'),
		"slug"	=> "sidebar",
		"type" 	=> "buttons_set",
		"id" 	=> "position_sidebar_mobile",
		"options" => array(
			'top' => esc_html__('Top', 'shopme'),
			'bottom' => esc_html__('Bottom', 'shopme')
		),
		"std" => 'top',
		"desc" 	=> esc_html__('Position Sidebar for mobile devices', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Animate Widgets in Sidebar on pages', 'shopme'),
		"slug"	=> "sidebar",
		"type" 	=> "switch_set",
		"id" 	=> "animate_widgets_pages",
		"options" => array(
			'on' => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"std" => true,
		"desc" 	=> esc_html__('If you choose Yes, to enable animations', 'shopme'),
	);

/* ---------------------------------------------------------------------- */
/*	Blog Elements
/* ---------------------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Post List Settings', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "heading",
		"heading" => "h4",
		"desc" 	=> esc_html__('Parameters for posts list on blog page', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Excerpt count for Blog Big', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "number",
		"id" 	=> "excerpt_count_blog_big_post",
		"min" => 100,
		"max" => 1000,
		"std"   => 500,
		"desc" 	=> esc_html__('Excerpt count ( min-100, max-1000 symbols)', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=>  esc_html__('Excerpt count for Blog List', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "number",
		"id" 	=> "excerpt_count_blog_list_post",
		"min" => 100,
		"max" => 1000,
		"std"   => 200,
		"desc" 	=> esc_html__('Excerpt count ( min-100, max-1000 symbols)', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Excerpt count for Blog Grid', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "number",
		"id" 	=> "excerpt_count_blog_grid_post",
		"min" => 100,
		"max" => 1000,
		"std"   => 250,
		"desc" 	=> esc_html__('Excerpt count ( min-100, max-1000 symbols)', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Blog Post Date', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-listing-meta-date",
		"label" => esc_html__('If checked show', 'shopme'),
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Blog Post Comment', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-listing-meta-comment",
		"label" => esc_html__('If checked show', 'shopme'),
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Blog Post Category', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-listing-meta-category",
		"label" => esc_html__('If checked show', 'shopme'),
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Blog Post Ratings', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-listing-meta-ratings",
		"label" => __("If checked show", 'shopme'),
		"desc" 	=> __(" ", 'shopme'),
		"class" => 'mad_2col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Blog Post Author', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-listing-meta-author",
		"label" => esc_html__('If checked show', 'shopme'),
		"desc" 	=> " ",
		"class" => 'mad_2col',
		"clear" => 'both'
	);

$shopme_elements[] = array(
	"name" 	=> esc_html__('Single Post Settings', 'shopme'),
	"slug"	=> "blog",
	"type" 	=> "heading",
	"heading" => "h4",
	"desc" 	=> esc_html__('Parameters for standart elements on Post page', 'shopme'),
);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Sidebar on Single Post Pages', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "buttons_set",
		"id" 	=> "sidebar_post_position",
		"options" => array(
			'sbl' => esc_html__('Left', 'shopme'),
			'sbr' => esc_html__('Right', 'shopme'),
			'no_sidebar' => esc_html__('No Sidebar', 'shopme')
		),
		"std" => 'sbr',
		"desc" 	=> esc_html__('Choose the blog post sidebar position', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Sidebar Setting', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "select",
		"id" 	=> "sidebar_setting_page",
		"options" => 'custom_sidebars',
		'std' => '',
		"desc" 	=> esc_html__('Choose the page sidebar setting', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Blog Post Date', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-single-meta-date",
		"label" => esc_html__('If checked show', 'shopme'),
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Blog Post Comment', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-single-meta-comment",
		"label" => esc_html__('If checked show', 'shopme'),
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Blog Post Category', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-single-meta-category",
		"label" => esc_html__('If checked show', 'shopme'),
		"desc" 	=> " ",
		"clear" => 'both',
		"class" => 'mad_3col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Blog Post Ratings', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-single-meta-ratings",
		"label" => esc_html__('If checked show', 'shopme'),
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Blog Post Author', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-single-meta-author",
		"label" => esc_html__('If checked show', 'shopme'),
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Related Posts', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "blog-single-related-posts",
		"label" => esc_html__('If checked show', 'shopme'),
		"desc" 	=> " ",
		"clear" => 'both',
		"class" => 'mad_3col'
	);


$shopme_elements[] = array(
	"name" 	=> esc_html__('Related Posts Settings', 'shopme'),
	"slug"	=> "blog",
	"type" 	=> "heading",
	"heading" => "h4",
	"desc" 	=> "",
);

	$shopme_elements[] = array(
		"name" 	=> esc_html__("Post's Count", 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "buttons_set",
		"id" 	=> "related_posts_count",
		"options" => array(
			3 => '3',
			6 => '6',
			9 => '9'
		),
		"std" => 3,
		"desc" 	=> esc_html__('Show to display count items', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Archive Posts Settings', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "heading",
		"heading" => "h4",
		"desc" 	=> esc_html__('Parameters for posts on archive page', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Blog Style for archive', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "buttons_set",
		"id" 	=> "blog_style",
		"options" => array(
			'big_view' => esc_html__('Big View', 'shopme'),
			'grid_view' => esc_html__('Grid View', 'shopme'),
			'list_view' => esc_html__('List View', 'shopme'),
		),
		"std" => 'big_view',
		"desc" 	=> esc_html__('Choose the default blog layout here for archive', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Blog Style for category', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "buttons_set",
		"id" 	=> "blog_style_category",
		"options" => array(
			'big_view' => esc_html__('Big View', 'shopme'),
			'grid_view' => esc_html__('Grid View', 'shopme'),
			'list_view' => esc_html__('List View', 'shopme'),
		),
		"std" => 'list_view',
		"desc" 	=> esc_html__('Choose the default blog layout here for category', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Blog Style for search', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "buttons_set",
		"id" 	=> "blog_style_search",
		"options" => array(
			'big_view' => esc_html__('Big View', 'shopme'),
			'grid_view' => esc_html__('Grid View', 'shopme'),
			'list_view' => esc_html__('List View', 'shopme'),
		),
		"std" => 'list_view',
		"desc" 	=> esc_html__('Choose the default blog layout here for search', 'shopme'),
	);

/* --------------------------------------------------------- */
/*	Share Posts Settings
/* --------------------------------------------------------- */

$shopme_elements[] = array(
	"name" 	=> esc_html__('Share Posts Settings', 'shopme'),
	"slug"	=> "blog",
	"type" 	=> "heading",
	"heading" => "h4",
	"desc" 	=> esc_html__('Parameters for social links on posts', 'shopme'),
);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Show social links', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "switch_set",
		"id" 	=> "share-posts-enable",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"std" => true,
		"desc" 	=> esc_html__('Show social links in product pages', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Enable Facebook Share', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "switch_set",
		"id" 	=> "share-posts-facebook",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"required" => array('share-posts-enable', true),
		"std" => true,
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Enable Twitter Share', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "switch_set",
		"id" 	=> "share-posts-twitter",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"required" => array('share-posts-enable', true),
		"std" => true,
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Enable LinedIn Share', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "switch_set",
		"id" 	=> "share-posts-linkedin",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"required" => array('share-posts-enable', true),
		"std" => true,
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Enable Google + Share', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "switch_set",
		"id" 	=> "share-posts-googleplus",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"required" => array('share-posts-enable', true),
		"std" => true,
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Enable Pinterest Share', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "switch_set",
		"id" 	=> "share-posts-pinterest",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"required" => array('share-posts-enable', true),
		"std" => true,
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Enable VK Share', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "switch_set",
		"id" 	=> "share-posts-vk",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"required" => array('share-posts-enable', true),
		"std" => '0',
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);


	$shopme_elements[] = array(
		"name" 	=> esc_html__('Enable Tumblr Share', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "switch_set",
		"id" 	=> "share-posts-tumblr",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"required" => array('share-posts-enable', true),
		"std" => true,
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Enable Reddit Share', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "switch_set",
		"id" 	=> "share-posts-reddit",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"required" => array('share-posts-enable', true),
		"std" => '0',
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Enable Xing Share', 'shopme'),
		"slug"	=> "blog",
		"type" 	=> "switch_set",
		"id" 	=> "share-posts-xing",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"required" => array('share-posts-enable', true),
		"std" => '0',
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

/* ---------------------------------------------------------------------- */
/*	Testimonials Elements
/* ---------------------------------------------------------------------- */

$shopme_elements[] = array(
	"name" 	=> esc_html__('Archive Page Layout', 'shopme'),
	"slug"	=> "testimonials",
	"type" 	=> "buttons_set",
	"id" 	=> "testimonials_archive_page_layout",
	"options" => array(
		'wide_layout' => esc_html__('Wide Layout', 'shopme'),
		'boxed_layout' => esc_html__('Boxed Layout', 'shopme')
	),
	"std" => 'wide_layout',
	"desc" 	=> esc_html__('Choose a page layout style for the testimonials archive', 'shopme'),
);

$shopme_elements[] = array(
	"name" 	=> esc_html__('Sidebar on Archive page', 'shopme'),
	"slug"	=> "testimonials",
	"type" 	=> "buttons_set",
	"id" 	=> "sidebar_testimonials_archive_position",
	"options" => array(
		'sbl' => esc_html__('Left', 'shopme'),
		'sbr' => esc_html__('Right', 'shopme'),
		'no_sidebar' => esc_html__('No Sidebar', 'shopme')
	),
	"std" => 'sbl',
	"desc" 	=> esc_html__('Choose the testimonials archive sidebar position', 'shopme'),
);

/* ---------------------------------------------------------------------- */
/*	Footer Elements
/* ---------------------------------------------------------------------- */

	/* --------------------------------------------------------- */
	/* Row Widgets for pages
	/* --------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" => esc_html__('Show Footer Row Top widgets ?', 'shopme'),
		"slug"	=> "footer",
		"type" => "checkbox",
		"std" => 1,
		"id" => "show_row_top_widgets",
		"desc" => " ",
		"label" => esc_html__('Show it if the checkbox is checked', 'shopme')
	);

	$shopme_elements[] = array(
		"name" => esc_html__('Footer Row Top Widget positions', 'shopme'),
		"slug"	=> "footer",
		"type" => "widget_positions",
		"std" => '{"4":[["3","3","3","3"]]}',
		"id" => "footer_row_top_columns_variations",
		"desc" => esc_html__('Here you can select how your footer row top widgets will be displayed.', 'shopme'),
		"columns" => 5,
		"selectname" => 'get_sidebars_top_widgets'
	);

	$shopme_elements[] = array(
		"name" => esc_html__('Show Footer Row Middle widgets ?', 'shopme'),
		"slug"	=> "footer",
		"type" => "checkbox",
		"std" => 0,
		"id" => "show_row_middle_widgets",
		"desc" => " ",
		"label" => esc_html__('Show it if the checkbox is checked', 'shopme')
	);

	$shopme_elements[] = array(
		"name" => esc_html__('Footer Row Middle Widget positions', 'shopme'),
		"slug"	=> "footer",
		"type" => "widget_positions",
		"std" => '{"2":[["6","6"]]}',
		"id" => "footer_row_middle_columns_variations",
		"desc" => esc_html__('Here you can select how your footer row middle widgets will be displayed.', 'shopme'),
		"columns" => 5,
		"selectname" => 'get_sidebars_middle_widgets'
	);

	$shopme_elements[] = array(
		"name" => esc_html__('Show Footer Row Bottom widgets ?', 'shopme'),
		"slug"	=> "footer",
		"type" => "checkbox",
		"std" => 0,
		"id" => "show_row_bottom_widgets",
		"desc" => " ",
		"label" => esc_html__('Show it if the checkbox is checked', 'shopme')
	);

	$shopme_elements[] = array(
		"name" => esc_html__('Footer Row Bottom Widget positions', 'shopme'),
		"slug"	=> "footer",
		"type" => "widget_positions",
		"std" => '{"4":[["3","3","3","3"]]}',
		"id" => "footer_row_bottom_columns_variations",
		"desc" => esc_html__('Here you can select how your footer row bottom widgets will be displayed.', 'shopme'),
		"columns" => 5,
		"selectname" => 'get_sidebars_bottom_widgets'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Copyright', 'shopme'),
		"slug"	=> "footer",
		"type" 	=> "textarea",
		"id" 	=> "copyright",
		"std"   => '',
		"desc" 	=> esc_html__('Write your copyright text for the footer', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" => esc_html__('Show product categories in footer ?', 'shopme'),
		"slug"	=> "footer",
		"type" => "checkbox",
		"std" => 0,
		"id" => "show_product_categories",
		"desc" => " ",
		"label" => esc_html__('Show it if the checkbox is checked', 'shopme')
	);

	$shopme_elements[] =	array(
		"name" 	=> esc_html__('Product categories parent ID', 'shopme'),
		"slug"	=> "footer",
		"type" 	=> "text",
		"id" 	=> "product_categories_parent_id",
		"std"   => 51,
		"desc" 	=> esc_html__('Get direct children of this term (only terms whose explicit parent is this value).', 'shopme')
	);

	/* --------------------------------------------------------- */
	/* Type Payment
	/* --------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Payment in Footer', 'shopme'),
		"slug"	=> "footer",
		"type" 	=> "heading",
		"heading" => "h4",
		"desc" 	=> "",
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Upload Payment 1', 'shopme'),
		"slug"	=> "footer",
		"type" 	=> "upload",
		"id" 	=> "payment_1",
		"desc" 	=> esc_html__('Upload a payment image. Payment Dimension: 38px * 24px', 'shopme'),
		"std"   => SHOPME_BASE_URI . 'images/payment_img_1.png'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Upload Payment 2', 'shopme'),
		"slug"	=> "footer",
		"type" 	=> "upload",
		"id" 	=> "payment_2",
		"desc" 	=> esc_html__('Upload a payment image. Payment Dimension: 38px * 24px', 'shopme'),
		"std"   => SHOPME_BASE_URI . 'images/payment_img_2.png'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Upload Payment 3', 'shopme'),
		"slug"	=> "footer",
		"type" 	=> "upload",
		"id" 	=> "payment_3",
		"desc" 	=> esc_html__('Upload a payment image. Payment Dimension: 38px * 24px', 'shopme'),
		"std"   => SHOPME_BASE_URI . 'images/payment_img_3.png'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Upload Payment 4', 'shopme'),
		"slug"	=> "footer",
		"type" 	=> "upload",
		"id" 	=> "payment_4",
		"desc" 	=> esc_html__('Upload a payment image. Payment Dimension: 38px * 24px', 'shopme'),
		"std"   => SHOPME_BASE_URI . 'images/payment_img_4.png'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Upload Payment 5', 'shopme'),
		"slug"	=> "footer",
		"type" 	=> "upload",
		"id" 	=> "payment_5",
		"desc" 	=> esc_html__('Upload a payment image. Payment Dimension: 38px * 24px', 'shopme'),
		"std"   => SHOPME_BASE_URI . 'images/payment_img_5.png'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Upload Payment 6', 'shopme'),
		"slug"	=> "footer",
		"type" 	=> "upload",
		"id" 	=> "payment_5",
		"desc" 	=> esc_html__('Upload a payment image. Payment Dimension: 38px * 24px', 'shopme'),
		"std"   => SHOPME_BASE_URI . 'images/payment_img_6.png'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Upload Payment 7', 'shopme'),
		"slug"	=> "footer",
		"type" 	=> "upload",
		"id" 	=> "payment_7",
		"desc" 	=> esc_html__('Upload a payment image. Payment Dimension: 38px * 24px', 'shopme'),
		"std"   => SHOPME_BASE_URI . 'images/payment_img_7.png'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Upload Payment 8', 'shopme'),
		"slug"	=> "footer",
		"type" 	=> "upload",
		"id" 	=> "payment_8",
		"desc" 	=> esc_html__('Upload a payment image. Payment Dimension: 38px * 24px', 'shopme'),
		"std"   => SHOPME_BASE_URI . 'images/payment_img_8.png'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Upload Payment 9', 'shopme'),
		"slug"	=> "footer",
		"type" 	=> "upload",
		"id" 	=> "payment_9",
		"desc" 	=> esc_html__('Upload a payment image. Payment Dimension: 38px * 24px', 'shopme'),
		"std"   => ''
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Upload Payment 10', 'shopme'),
		"slug"	=> "footer",
		"type" 	=> "upload",
		"id" 	=> "payment_10",
		"desc" 	=> esc_html__('Upload a payment image. Payment Dimension: 38px * 24px', 'shopme'),
		"std"   => ''
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Upload Payment 11', 'shopme'),
		"slug"	=> "footer",
		"type" 	=> "upload",
		"id" 	=> "payment_11",
		"desc" 	=> esc_html__('Upload a payment image. Payment Dimension: 38px * 24px', 'shopme'),
		"std"   => ''
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Upload Payment 12', 'shopme'),
		"slug"	=> "footer",
		"type" 	=> "upload",
		"id" 	=> "payment_12",
		"desc" 	=> esc_html__('Upload a payment image. Payment Dimension: 38px * 24px', 'shopme'),
		"std"   => ''
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Upload Payment 13', 'shopme'),
		"slug"	=> "footer",
		"type" 	=> "upload",
		"id" 	=> "payment_13",
		"desc" 	=> esc_html__('Upload a payment image. Payment Dimension: 38px * 24px', 'shopme'),
		"std"   => ''
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Upload Payment 14', 'shopme'),
		"slug"	=> "footer",
		"type" 	=> "upload",
		"id" 	=> "payment_14",
		"desc" 	=> esc_html__('Upload a payment image. Payment Dimension: 38px * 24px', 'shopme'),
		"std"   => ''
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Upload Payment 15', 'shopme'),
		"slug"	=> "footer",
		"type" 	=> "upload",
		"id" 	=> "payment_15",
		"desc" 	=> esc_html__('Upload a payment image. Payment Dimension: 38px * 24px', 'shopme'),
		"std"   => ''
	);

/* ---------------------------------------------------------------------- */
/*	Shop Elements
/* ---------------------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Page Layout', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "buttons_set",
		"id" 	=> "product_archive_page_layout",
		"options" => array(
			'wide_layout' => esc_html__('Wide Layout', 'shopme'),
			'boxed_layout' => esc_html__('Boxed Layout', 'shopme')
		),
		"std" => 'wide_layout',
		"desc" 	=> esc_html__('Choose the page style layout for the product archive', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Breadcrumbs on Shop Pages', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "switch_set",
		"id" 	=> "shop_breadcrumbs",
		"options" => array(
			'on' => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"std" => true,
		"desc" 	=> esc_html__('Show or hide breadcrumbs by default on shop page', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Sidebar on Archive Pages', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "buttons_set",
		"id" 	=> "sidebar_product_archive_position",
		"options" => array(
			'sbl' => esc_html__('Left', 'shopme'),
			'sbr' => esc_html__('Right', 'shopme'),
			'no_sidebar' => esc_html__('No Sidebar', 'shopme')
		),
		"std" => 'sbr',
		"desc" 	=> esc_html__('Choose the sidebar position for product archive', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Sidebar on Single Product', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "buttons_set",
		"id" 	=> "sidebar_product_position",
		"options" => array(
			'sbl' => esc_html__('Left', 'shopme'),
			'sbr' => esc_html__('Right', 'shopme'),
			'no_sidebar' => esc_html__('No Sidebar', 'shopme')
		),
		"std" => 'sbr',
		"desc" 	=> esc_html__('Choose the single product sidebar position', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Sidebar Setting', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "select",
		"id" 	=> "sidebar_setting_product",
		"options" => 'custom_sidebars',
		'std' => '',
		"desc" 	=> esc_html__('Choose the product pages sidebar setting', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Show review tab on single product', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "switch_set",
		"id" 	=> "show_review_tab",
		"options" => array(
			'on' => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"std" => true,
		"desc" 	=> esc_html__('If you choose Yes, you will see reviews tab on single product', 'shopme'),
	);


	$shopme_elements[] = array(
		"name" 	=> esc_html__('Show other products on single product', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "switch_set",
		"id" 	=> "show_other_products",
		"options" => array(
			'on' => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"std" => true,
		"desc" 	=> esc_html__('If you choose Yes, you will see other products on single product', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Shop View', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "buttons_set",
		"id" 	=> "shop-view",
		"options" => array(
			'type_1' => esc_html__('Type 1', 'shopme'),
			'type_2' => esc_html__('Type 2', 'shopme'),
			'type_3' => esc_html__('Type 3', 'shopme'),
			'type_4' => esc_html__('Type 4', 'shopme')
		),
		"std" => 'type_1',
		"desc" 	=> esc_html__('Choose default style view for the Shop page', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=>  esc_html__('Excerpt count product title', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "number",
		"id" 	=> "excerpt_count_product_title",
		"min" => 10,
		"max" => 300,
		"std"   => 100,
		"desc" 	=> esc_html__('Excerpt count ( min-10, max-300 symbols)', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Show lightbox in product image', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "switch_set",
		"id" 	=> "lightbox_on_product_image",
		"options" => array(
			'on' => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"std" => true,
		"desc" 	=> esc_html__('If you choose Yes, you will see lightbox in the product image on single product', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Show zoom on product image', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "switch_set",
		"id" 	=> "zoom_on_product_image",
		"options" => array(
			'on' => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"std" => true,
		"desc" 	=> esc_html__('If you choose Yes, you will see zoom in the product image on single product', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Show "Sale" Label', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "switch_set",
		"id" 	=> "product_sale",
		"options" => array(
			'on' => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"std" => true,
		"desc" 	=> " ",
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Show saved sale price percentage', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "switch_set",
		"id" 	=> "product_sale_percent",
		"options" => array(
			'on' => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"std" => true,
		"desc" 	=> " ",
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Show "Featured" Label', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "switch_set",
		"id" 	=> "product_featured",
		"options" => array(
			'on' => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"std" => true,
		"desc" 	=> " ",
	);

	$shopme_elements[] = array(
		"name" 	=> __("Quick View", 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "switch_set",
		"id" 	=> "quick_view",
		"options" => array(
			'on' => __('Yes', 'shopme'),
			'off' => __('No', 'shopme')
		),
		"std" => true,
		"desc" 	=> __("If you choose Yes, you will see quick view on the product box", 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Product Hover', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "switch_set",
		"id" 	=> "product_hover",
		"options" => array(
			'on' => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"std" => true,
		"desc" 	=> esc_html__('If you choose Yes, you will see the first image from gallery on product hover', 'shopme'),
	);

	/* --------------------------------------------------------- */
	/*	Products Filter Plugin Settings
	/* --------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Rotate transform on archive shop', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "switch_set",
		"id" 	=> "shop_rotate_transform",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"std" => true,
		"desc" 	=> esc_html__('If yes to enable rotate transform on archive shop', 'shopme')
	);

	/* --------------------------------------------------------- */
	/*	Wishlist and Compare Plugin Settings
	/* --------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Wishlist and Compare', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "heading",
		"heading" => 'h4',
		"desc" 	=> " "
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Show Wishlist', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "show_wishlist",
		"desc" 	=> " ",
		"label" => esc_html__('If checked show', 'shopme'),
		"class" => 'mad_2col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Show Compare', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "checkbox",
		"std"   => 1,
		"id" 	=> "show_compare",
		"desc" 	=> " ",
		"label" => esc_html__('If checked show', 'shopme'),
		"class" => 'mad_2col',
		"clear" => 'both'
	);

	/* --------------------------------------------------------- */
	/*	Column and Product Settings
	/* --------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Column and Product Count', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "heading",
		"heading" => 'h4',
		"desc" 	=> esc_html__('The following settings allow you to choose how many columns and items should be appeared on your default shop overview page and on your product archive pages.', 'shopme')
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Column Count', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "select",
		"id" 	=> "woocommerce_column_count",
		"options" => array(
			3 => '3',
			4 => '4',
			5 => '5'
		),
		"std" => 3,
		"desc" 	=> esc_html__('This controls how many columns should be appeared on overview pages.', 'shopme'),
	);

	$itemcount = array();
	for ($i = 3; $i < 51; $i++) {
		$itemcount[$i] = $i;
	}

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Product Count', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "select",
		"id" 	=> "woocommerce_product_count",
		"options" => $itemcount,
		"std" => 12,
		"desc" 	=> esc_html__('This controls how many products should be appeared on overview pages.', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Product Count of items for related products', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "select",
		"id" 	=> "shop_single_column_items",
		"options" => $itemcount,
		"std" => 6,
		"desc" 	=> esc_html__('Number of items for related products', 'shopme'),
	);

	/* --------------------------------------------------------- */
	/*	Row Widgets for shop pages
	/* --------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Footer Settings', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "heading",
		"heading" => "h4",
		"desc" 	=> esc_html__('Editor widgets in the footer for shop pages', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Get widgets for footer from page', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "select",
		"id" 	=> "shop_get_widgets_page_id",
		"options" => 'page',
		"desc" 	=> esc_html__('Get widgets for footer from page on shop pages. You can model the footer of any page and then use it to the product pages', 'shopme'),
	);

	/* --------------------------------------------------------- */
	/*	Share Product Settings
	/* --------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Share Product Settings', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "heading",
		"heading" => "h4",
		"desc" 	=> esc_html__('Parameters for social links on product page', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Show social links', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "switch_set",
		"id" 	=> "share-product-enable",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"std" => true,
		"desc" 	=> esc_html__('Show social links in product pages', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Enable Facebook Share', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "switch_set",
		"id" 	=> "share-product-facebook",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"required" => array('share-product-enable', true),
		"std" => true,
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Enable Twitter Share', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "switch_set",
		"id" 	=> "share-product-twitter",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"required" => array('share-product-enable', true),
		"std" => true,
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Enable LinedIn Share', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "switch_set",
		"id" 	=> "share-product-linkedin",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"required" => array('share-product-enable', true),
		"std" => true,
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Enable Google + Share', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "switch_set",
		"id" 	=> "share-product-googleplus",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"required" => array('share-product-enable', true),
		"std" => true,
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Enable Pinterest Share', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "switch_set",
		"id" 	=> "share-product-pinterest",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"required" => array('share-product-enable', true),
		"std" => true,
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Enable VK Share', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "switch_set",
		"id" 	=> "share-product-vk",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"required" => array('share-product-enable', true),
		"std" => '0',
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);


	$shopme_elements[] = array(
		"name" 	=> esc_html__('Enable Tumblr Share', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "switch_set",
		"id" 	=> "share-product-tumblr",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"required" => array('share-product-enable', true),
		"std" => true,
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Enable Reddit Share', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "switch_set",
		"id" 	=> "share-product-reddit",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"required" => array('share-product-enable', true),
		"std" => '0',
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Enable Xing Share', 'shopme'),
		"slug"	=> "shop",
		"type" 	=> "switch_set",
		"id" 	=> "share-product-xing",
		"options" => array(
			'on'  => esc_html__('Yes', 'shopme'),
			'off' => esc_html__('No', 'shopme')
		),
		"required" => array('share-product-enable', true),
		"std" => '0',
		"desc" 	=> " ",
		"class" => 'mad_3col'
	);

/* ---------------------------------------------------------------------- */
/*	Tabbed Panel
/* ---------------------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Show Side Tabbed Panel?', 'shopme'),
		"slug"	=> "admin",
		"type" 	=> "checkbox",
		"std"   => 0,
		"id" 	=> "show_admin_panel",
		"desc" 	=> " ",
		"label" => esc_html__('Show it if the checkbox is checked', 'shopme')
	);

	/* --------------------------------------------------------- */
	/*	Admin Panel Items
	/* --------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Side Tabbed Panel', 'shopme'),
		"slug"	=> "admin",
		"type" 	=> "heading",
		"desc" 	=> esc_html__('Change the side tabbed panel', 'shopme'),
	);

	// start tab container
	$shopme_elements[] = array(
		"slug"	=> "admin",
		"type" => "tab_group_start",
		"id" => "admin_panel_tab_container",
		"class" => 'mad-tab-container',
		"desc" => false
	);

		// start 1 tab
		$shopme_elements[] = array(
			'name'=> esc_html__('Join Us on VK', 'shopme'),
			"slug"	=> "admin",
			"type" => "tab_group_start",
			"id" => "aside_admin_panel_1",
			"class" => "mad_tab",
			"desc" => false
		);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('Show VK Widget Community', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "checkbox",
				"std"   => 0,
				"id" 	=> "show_vk_box",
				"desc" 	=> " ",
				"label" => esc_html__('Show it if the checkbox is checked', 'shopme')
			);

			$shopme_elements[] =	array(
				"name" 	=> esc_html__('Title', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "text",
				"id" 	=> "vk_title",
				"desc" 	=> " ",
				"std" => esc_html__('Join Us on VK', 'shopme')
			);

			$shopme_elements[] =	array(
				"name" 	=> esc_html__('Widget Community', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "textarea",
				"id" 	=> "vk_widget_community",
				"desc" 	=> wp_kses(__("How to create widget community see instruction: <a target='_blank' href='https://vk.com/dev/Community'>https://vk.com/dev/Community</a>", 'shopme'), array('a' => array('href' => array(), 'target' => array()))),
				"std" => '<script type="text/javascript" src="//vk.com/js/api/openapi.js?116"></script><div id="vk_groups"></div><script type="text/javascript">VK.Widgets.Group("vk_groups", {mode: 0, width: "220", height: "400", color1: "FFFFFF", color2: "2B587A", color3: "5B7FA6"}, 20003922);</script>'
			);

		// end 1 tab
		$shopme_elements[] = array(
			"slug"	=> "admin",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 2 tab
		$shopme_elements[] = array(
			'name'=> esc_html__('Join Us on Facebook', 'shopme'),
			"slug"	=> "admin",
			"type" => "tab_group_start",
			"id" => "aside_admin_panel_2",
			"class" => "mad_tab",
			"desc" => false
		);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('Show Facebook Box', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "checkbox",
				"std"   => 1,
				"id" 	=> "show_facebook_box",
				"desc" 	=> wp_kses(__("See: <a target='_blank' href='https://developers.facebook.com/docs/plugins/page-plugin'>https://developers.facebook.com/docs/plugins/page-plugin</a>", 'shopme'), array('a' => array('href' => array(), 'target' => array()))),
				"label" => esc_html__('Show it if the checkbox is checked', 'shopme')
			);

			$shopme_elements[] =	array(
				"name" 	=> esc_html__('Title', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "text",
				"id" 	=> "facebook_title",
				"desc" 	=>  " ",
				"std" => esc_html__('Join Us on Facebook', 'shopme')
			);

			$shopme_elements[] =	array(
				"name" 	=> esc_html__('Facebook Page Name', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "text",
				"id" 	=> "facebook_page_name",
				"desc" 	=> " ",
				"std"   => 'https://www.facebook.com/WordPress'
			);

			$shopme_elements[] =	array(
				"name" 	=> esc_html__('Hide Cover?', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "switch_set",
				"id" 	=> "facebook_hide_cover",
				"options" => array(
					'on' => esc_html__('Yes', 'shopme'),
					'off' => esc_html__('No', 'shopme')
				),
				"std"   => '0',
				"desc" 	=> " "
			);

			$shopme_elements[] =	array(
				"name" 	=> esc_html__('Show Facespile?', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "switch_set",
				"id" 	=> "facebook_show_facespile",
				"options" => array(
					'on' => esc_html__('Yes', 'shopme'),
					'off' => esc_html__('No', 'shopme')
				),
				"std"   => true,
				"desc" 	=> " "
			);

			$shopme_elements[] =	array(
				"name" 	=> esc_html__('Show Posts?', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "switch_set",
				"id" 	=> "facebook_show_posts",
				"options" => array(
					'on' => esc_html__('Yes', 'shopme'),
					'off' => esc_html__('No', 'shopme')
				),
				"std"   => true,
				"desc" 	=> " "
			);

		// end 2 tab
		$shopme_elements[] = array(
			"slug"	=> "admin",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 3 tab
		$shopme_elements[] = array(
			'name'=> esc_html__('Latest Tweets', 'shopme'),
			"slug"	=> "admin",
			"type" => "tab_group_start",
			"id" => "aside_admin_panel_3",
			"class" => "mad_tab",
			"desc" => false
		);

			$shopme_elements[] = array(
				"name" 	=> esc_html__("Show Latest Tweets", 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "checkbox",
				"std"   => 1,
				"id" 	=> "show_latest_tweets",
				"desc" 	=> " ",
				"label" => esc_html__("Show it if the checkbox is checked", 'shopme')
			);

			$shopme_elements[] = array(
				"name" 	=> esc_html__("Show Follow Button", 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "checkbox",
				"std"   => 1,
				"id" 	=> "show_follow_button",
				"desc" 	=> " ",
				"label" => esc_html__("Show it if the checkbox is checked", 'shopme')
			);

			$shopme_elements[] =	array(
				"name" 	=> esc_html__("Title", 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "text",
				"id" 	=> "latest_tweets_title",
				"desc" 	=> " ",
				"std" => esc_html__("Latest Tweets", 'shopme')
			);

			$shopme_elements[] =	array(
				"name" 	=> esc_html__("Username", 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "text",
				"id" 	=> "latest_tweets_username",
				"desc" 	=> "",
				"std" => "fanfbmltemplate"
			);

			$shopme_elements[] = array(
				"name" 	=> esc_html__("Count", 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "number",
				"id" 	=> "latest_tweets_count",
				"min" => 1,
				"max" => 5,
				"std"   => 2,
				"desc" 	=> esc_html__("Count tweets", 'shopme'),
			);

		// end 3 tab
		$shopme_elements[] = array(
			"slug"	=> "admin",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 4 tab
		$shopme_elements[] = array(
			'name'=> esc_html__('Contact Us', 'shopme'),
			"slug"	=> "admin",
			"type" => "tab_group_start",
			"id" => "aside_admin_panel_4",
			"class" => "mad_tab",
			"desc" => false
		);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('Show Contact Us', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "checkbox",
				"std"   => 1,
				"id" 	=> "show_contact_us",
				"desc" 	=> " ",
				"label" => esc_html__('Show it if the checkbox is checked', 'shopme')
			);

			$shopme_elements[] =	array(
				"name" 	=> esc_html__('Title', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "text",
				"id" 	=> "contact_us_title",
				"desc" 	=> " ",
				"std" => esc_html__('Contact Us', 'shopme')
			);

			$shopme_elements[] =	array(
				"name" 	=> esc_html__('Short text', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "textarea",
				"id" 	=> "contact_us_short_text",
				"desc" 	=> " ",
				"std" => esc_html__('Lorem ipsum dolor sit amet, consectetuer adipis mauris', 'shopme')
			);

		// end 4 tab
		$shopme_elements[] = array(
			"slug"	=> "admin",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 5 tab
		$shopme_elements[] = array(
			'name'=> esc_html__('Store Location', 'shopme'),
			"slug"	=> "admin",
			"type" => "tab_group_start",
			"id" => "aside_admin_panel_5",
			"class" => "mad_tab",
			"desc" => false
		);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('Show Store Location', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "checkbox",
				"std"   => 1,
				"id" 	=> "show_store_location",
				"desc" 	=> " ",
				"label" => esc_html__('Show it if the checkbox is checked', 'shopme')
			);

			$shopme_elements[] =	array(
				"name" 	=> esc_html__('Title', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "text",
				"id" 	=> "store_location_title",
				"desc" 	=> " ",
				"std" => esc_html__('Store Location', 'shopme')
			);

			$shopme_elements[] =	array(
				"name" 	=> esc_html__('Adress', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "textarea",
				"id" 	=> "store_location_address",
				"desc" 	=> " ",
				"std" => esc_html__('8901 Marmora Road, Glasgow, D04 89GR.', 'shopme')
			);

			$shopme_elements[] =	array(
				"name" 	=> esc_html__('Map embed iframe', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "textarea",
				"id" 	=> "store_location_embed_iframe",
				"desc" 	=> wp_kses(__("How to create map see instruction for Embed map: <a target='_blank' href='https://support.google.com/maps/answer/3544418?hl=en'>https://support.google.com/maps/answer/3544418?hl=en</a>", 'shopme'), array('a' => array('href' => array(), 'target' => array()))),
				"std" => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193578.74109040972!2d-73.97968099999999!3d40.703312749999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2z0J3RjNGOLdCZ0L7RgNC6LCDQodCo0JA!5e0!3m2!1sru!2sua!4v1424385645246" width="400" height="300" style="border:0"></iframe>'
			);

			$shopme_elements[] =	array(
				"name" 	=> esc_html__('Phone', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "text",
				"id" 	=> "store_location_phone",
				"desc" 	=> " ",
				"std" => esc_html__('800-559-65-80', 'shopme')
			);

			$shopme_elements[] =	array(
				"name" 	=> esc_html__('Email', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "text",
				"id" 	=> "store_location_email",
				"desc" 	=> " ",
				"std" => "info@companyname.com"
			);

			$shopme_elements[] =	array(
				"name" 	=> esc_html__('Opening Hours', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "textarea",
				"id" 	=> "store_location_opening_hours",
				"desc" 	=> " ",
				"std" => esc_html__("Monday - Friday: 08.00-20.00 \n Saturday: 09.00-15.00 \n Sunday: closed", 'shopme')
			);

		// end 5 tab
		$shopme_elements[] = array(
			"slug"	=> "admin",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 6 tab
		$shopme_elements[] = array(
			'name'=> esc_html__('Instagram', 'shopme'),
			"slug"	=> "admin",
			"type" => "tab_group_start",
			"id" => "aside_admin_panel_6",
			"class" => "mad_tab",
			"desc" => false
		);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('Show Instagram', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "checkbox",
				"std"   => 1,
				"id" 	=> "show_instagram",
				"desc" 	=> " ",
				"label" => esc_html__('Show it if the checkbox is checked', 'shopme')
			);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('Title', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "text",
				"id" 	=> "instagram_title",
				"desc" 	=> " ",
				"std" => esc_html__('Instagram', 'shopme')
			);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('Iframe', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "textarea",
				"id" 	=> "instagram_iframe",
				"desc" 	=> wp_kses(__("How to create instagram widget see instruction: <a target='_blank' href='http://snapwidget.com/'>http://snapwidget.com</a>", 'shopme'), array('a' => array('href' => array(), 'target' => array()))),
				"std" => '<iframe src="http://snapwidget.com/in/?h=YW1hemluZ3xpbnw1NXw0fDR8fG5vfDJ8bm9uZXxvblN0YXJ0fHllc3xubw==&ve=300415" title="Instagram Widget" class="snapwidget-widget" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:228px; height:228px"></iframe>'
			);

		// end 6 tab
		$shopme_elements[] = array(
			"slug"	=> "admin",
			"type" => "tab_group_end",
			"desc" => false
		);

		// start 7 tab
		$shopme_elements[] = array(
			'name'=> esc_html__('Pinterest', 'shopme'),
			"slug"	=> "admin",
			"type" => "tab_group_start",
			"id" => "aside_admin_panel_7",
			"class" => "mad_tab",
			"desc" => false
		);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('Show Pinterest', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "checkbox",
				"std"   => 1,
				"id" 	=> "show_pinterest",
				"desc" 	=> " ",
				"label" => esc_html__('Show it if the checkbox is checked', 'shopme')
			);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('Title', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "text",
				"id" 	=> "pinterest_title",
				"desc" 	=> " ",
				"std" => esc_html__('Pinterest', 'shopme')
			);

			$shopme_elements[] = array(
				"name" 	=> esc_html__('Pinterest Username', 'shopme'),
				"slug"	=> "admin",
				"type" 	=> "text",
				"id" 	=> "pinterest_username",
				"desc" 	=> " ",
				"std" => esc_html__('pinterest', 'shopme')
			);

		// end 7 tab
		$shopme_elements[] = array(
			"slug"	=> "admin",
			"type" => "tab_group_end",
			"desc" => false
		);

	// end tab container
	$shopme_elements[] = array(
		"slug"	=> "admin",
		"type" => "tab_group_end",
		"desc" => false
	);

/* ---------------------------------------------------------------------- */
/*	Sitemap Elements
/* ---------------------------------------------------------------------- */

$shopme_elements[] = array(
	"name" 	=> esc_html__('Sitemap Settings', 'shopme'),
	"slug"	=> "sitemap",
	"type" 	=> "heading",
	"desc" 	=> esc_html__('You can use any of the following shortcodes in the content of your pages (or posts) to display a dynamic sitemap.', 'shopme'),
);

$shopme_elements[] = array(
	"name" 	=> esc_html__('Shortcodes', 'shopme'),
	"slug"	=> "sitemap",
	"desc"  => " ",
	"type" 	=> "sitemap"
);

/* ---------------------------------------------------------------------- */
/*	Import Elements
/* ---------------------------------------------------------------------- */

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Import demo files', 'shopme'),
		"slug"	=> "import",
		"type" 	=> "heading",
		"desc" 	=> esc_html__('If you are Wordpress newbie or want to get the theme look like one of our demos, then you can make import dummy posts and pages here. It will help you to understand how everything is organized.', 'shopme'),
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Import Default Content', 'shopme'),
		"slug"	=> "import",
		"desc" 	=> wp_kses(__("<p>
			<strong>View demo:</strong>
			<a target='_blank' href='http://velikorodnov.com/wordpress/shopme/'>View Demo Online</a>
			</p> You can import default content dummy posts and pages here </br> </br>
			<strong>Before Import Data install you must install and activate the following plugins: </strong>
			<ul>
				<li>Shopme Content Types</li>
				<li>WPBakery Visual Composer</li>
				<li>LayerSlider WP</li>
				<li>Mega Main Menu</li>
				<li>WPML Multilingual CMS</li>
				<li><a target='_blank' href='https://wordpress.org/plugins/woocommerce/'>Woocommerce</a></li>
				<li><a target='_blank' href='https://wordpress.org/plugins/yith-woocommerce-ajax-search/'>YITH WooCommerce Ajax Search</a></li>
				<li><a target='_blank' href='https://wordpress.org/plugins/yith-woocommerce-compare/'>YITH WooCommerce Compare</a></li>
				<li><a target='_blank' href='https://wordpress.org/plugins/yith-woocommerce-wishlist/'>YITH WooCommerce Wishlist</a></li>
				<li><a target='_blank' href='https://wordpress.org/plugins/contact-form-7/'>Contact Form 7</a></li>
			</ul>", 'shopme'), array('p' => array(), 'strong' => array(), 'a' => array('href' => array(), 'target' => array()), 'strong' => array(), 'ul' => array(), 'li' => array(), 'br')),
		"id" 	=> "import_default",
		"type" 	=> "import",
		"path" => "admin/demo/default/default",
		"source" => "admin/demo/default",
		"image" => "admin/demo/default/default.jpg"
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__("Import Furniture Content", 'shopme'),
		"slug"	=> "import",
		"desc" 	=> wp_kses(__("<p>
					<strong>View demo:</strong>
					<a target='_blank' href='http://velikorodnov.com/wordpress/shopmewp/furniture/'>View Demo Online</a>
					</p> You can import default content dummy posts and pages here </br> </br>
					<strong>Before Import Data install you must install and activate the following plugins: </strong>
					<ul>
						<li>Shopme Content Types</li>
						<li>WPBakery Visual Composer</li>
						<li>LayerSlider WP</li>
						<li>Mega Main Menu</li>
						<li>WPML Multilingual CMS</li>
						<li><a target='_blank' href='https://wordpress.org/plugins/woocommerce/'>Woocommerce</a></li>
						<li><a target='_blank' href='https://wordpress.org/plugins/yith-woocommerce-ajax-search/'>YITH WooCommerce Ajax Search</a></li>
						<li><a target='_blank' href='https://wordpress.org/plugins/yith-woocommerce-compare/'>YITH WooCommerce Compare</a></li>
						<li><a target='_blank' href='https://wordpress.org/plugins/yith-woocommerce-wishlist/'>YITH WooCommerce Wishlist</a></li>
						<li><a target='_blank' href='https://wordpress.org/plugins/contact-form-7/'>Contact Form 7</a></li>
					</ul>", 'shopme'), array('p' => array(), 'strong' => array(), 'a' => array('href' => array(), 'target' => array()), 'strong' => array(), 'ul' => array(), 'li' => array(), 'br')),
		"id" 	=> "import_furniture",
		"type" 	=> "import",
		"path" => "admin/demo/furniture/furniture",
		"source" => "admin/demo/furniture",
		"image" => "admin/demo/furniture/furniture.jpg"
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__("Import Electronics Content", 'shopme'),
		"slug"	=> "import",
		"desc" 	=> wp_kses(__("<p>
						<strong>View demo:</strong>
						<a target='_blank' href='http://velikorodnov.com/wordpress/shopmewp/electronics/'>View Demo Online</a>
						</p> You can import default content dummy posts and pages here </br> </br>
						<strong>Before Import Data install you must install and activate the following plugins: </strong>
						<ul>
							<li>Shopme Content Types</li>
							<li>WPBakery Visual Composer</li>
							<li>Revolution Slider</li>
							<li>Mega Main Menu</li>
							<li>WPML Multilingual CMS</li>
							<li><a target='_blank' href='https://wordpress.org/plugins/woocommerce/'>Woocommerce</a></li>
							<li><a target='_blank' href='https://wordpress.org/plugins/yith-woocommerce-ajax-search/'>YITH WooCommerce Ajax Search</a></li>
							<li><a target='_blank' href='https://wordpress.org/plugins/yith-woocommerce-compare/'>YITH WooCommerce Compare</a></li>
							<li><a target='_blank' href='https://wordpress.org/plugins/yith-woocommerce-wishlist/'>YITH WooCommerce Wishlist</a></li>
							<li><a target='_blank' href='https://wordpress.org/plugins/contact-form-7/'>Contact Form 7</a></li>
						</ul>", 'shopme'), array('p' => array(), 'strong' => array(), 'a' => array('href' => array(), 'target' => array()), 'strong' => array(), 'ul' => array(), 'li' => array(), 'br')),
		"id" 	=> "import_electronics",
		"type" 	=> "import",
		"path" => "admin/demo/electronics/electronics",
		"source" => "admin/demo/electronics",
		"image" => "admin/demo/electronics/electronics.jpg"
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Export Theme Settings', 'shopme'),
		"slug"	=> "import",
		"desc" 	=> esc_html__('Export a theme configuration file here.', 'shopme'),
		"id" 	=> "export_config_file",
		"type" 	=> "export_config_file"
	);

	$shopme_elements[] = array(
		"name" 	=> esc_html__('Import Theme Settings', 'shopme'),
		"slug"	=> "import",
		"desc" 	=> esc_html__('Upload a theme configuration file here.', 'shopme'),
		"id" 	=> "import_config_file",
		"type" 	=> "import_config_file"
	);