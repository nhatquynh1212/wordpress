<?php

global $shopme_config;

$shopme_icons_arr = array(
	esc_html__( 'None', 'shopme' ) => 'none',
	esc_html__( 'Pencil', 'shopme' ) => 'fa-pencil',
	esc_html__( 'Shopping Cart', 'shopme' ) => 'fa-shopping-cart',
	esc_html__( 'Info', 'shopme' ) => 'fa-info-circle',
	esc_html__( 'Check', 'shopme' ) => 'fa-check',
	esc_html__( 'Warning', 'shopme' ) => 'fa-warning',
	esc_html__( 'Flash', 'shopme' ) => 'fa-flash',
	esc_html__( 'Refresh', 'shopme' ) => 'fa-refresh',
	esc_html__( 'Times', 'shopme' ) => 'fa-times'
);

$shopme_target_arr = array(
	esc_html__( 'Same window', 'shopme' ) => '_self',
	esc_html__( 'New window', 'shopme' ) => "_blank"
);

$shopme_colors_arr = array(
	esc_html__( 'Default', 'shopme' ) => 'btn-orange',
	esc_html__( 'Grey', 'shopme' ) => 'btn-grey',
	esc_html__( 'Blue', 'shopme' ) => 'btn-blue',
	esc_html__( 'Navy Blue', 'shopme' ) => 'btn-navy-blue',
	esc_html__( 'Green', 'shopme' ) => 'btn-green',
	esc_html__( 'Yellow', 'shopme' ) => 'btn-yellow',
	esc_html__( 'Transparent', 'shopme' ) => 'btn-transparent'
);

$shopme_size_arr = array(
	esc_html__( 'Large', 'shopme' ) => 'btn-large',
	esc_html__( 'Medium', 'shopme' ) => 'btn-medium',
	esc_html__( 'Small', 'shopme' ) => "btn-small",
	esc_html__( 'Mini', 'shopme' ) => "btn-mini"
);

$shopme_list_unordered_styles = array(
	esc_html__( 'Type 1', 'shopme' ) => 'list_type_1',
	esc_html__( 'Type 2', 'shopme' ) => 'list_type_2',
	esc_html__( 'Type 3', 'shopme' ) => 'list_type_3',
	esc_html__( 'Type 4', 'shopme' ) => 'list_type_4',
	esc_html__( 'Type 5', 'shopme' ) => 'list_type_5',
	esc_html__( 'Type 6', 'shopme' ) => 'list_type_6'
);

$shopme_list_ordered_styles = array(
	esc_html__( 'Upper roman', 'shopme' ) => 'upper-roman',
	esc_html__( 'Decimal', 'shopme' ) => 'decimal',
	esc_html__( 'Upper latin', 'shopme' ) => 'upper-latin',
	esc_html__( 'Bordered Square', 'shopme' ) => 'bordered',
	esc_html__( 'Fill Square', 'shopme' ) => 'fill'
);

$shopme_add_css_animation = array(
	'type' => 'dropdown',
	'heading' => esc_html__( 'CSS Animation', 'shopme' ),
	'param_name' => 'css_animation',
	'admin_label' => true,
	'value' => array(
		esc_html__( 'No', 'shopme' ) => '',
		esc_html__( 'Fade In Down', 'shopme' ) => "fadeInDown"
	),
	'group' => esc_html__( 'Animations', 'shopme' ),
	'description' => esc_html__( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'shopme' )
);

$shopme_add_animation_delay = array(
	'type' => 'number',
	'heading' => esc_html__( 'Animation delay', 'shopme' ),
	'param_name' => 'animation_delay',
	'admin_label' => true,
	'description' => esc_html__( 'Animation delay', 'shopme' ),
	'value' => 0,
	'dependency' => array(
		'element' => 'css_animation',
		'value' => array( 'fadeInDown' )
	),
	'group' => esc_html__( 'Animations', 'shopme' )
);

$shopme_short_css_animation = array(
	'type' => 'dropdown',
	'heading' => esc_html__( 'CSS Animation', 'shopme' ),
	'param_name' => 'css_animation',
	'admin_label' => true,
	'value' => array(
		esc_html__( 'No', 'shopme' ) => '',
		esc_html__( 'Yes', 'shopme' ) => 'yes'
	),
	'group' => esc_html__( 'Animations', 'shopme' ),
	'description' => esc_html__( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'shopme' )
);

$vc_is_wp_version_3_6_more = version_compare( preg_replace( '/^([\d\.]+)(\-.*$)/', '$1', get_bloginfo( 'version' ) ), '3.6' ) >= 0;

/* Default Custom Shortcodes
/* --------------------------------------------------------------------- */

/* Row
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Row', 'shopme' ),
	'base' => 'vc_row',
	'is_container' => true,
	'icon' => 'icon-wpb-row',
	'show_settings_on_create' => false,
	'category' => esc_html__( 'Content', 'shopme' ),
	'description' => esc_html__( 'Place content elements inside the row', 'shopme' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Row stretch', 'shopme' ),
			'param_name' => 'full_width',
			'value' => array(
				esc_html__('Default', 'shopme') => '',
				esc_html__('Stretch row', 'shopme') => 'stretch_row',
				esc_html__('Stretch row and content', 'shopme') => 'stretch_row_content',
				esc_html__('Stretch row and content without spaces', 'shopme') => 'stretch_row_content_no_spaces',
			),
			'description' => esc_html__( 'Select stretching options for row and content. Stretched row overlay sidebar and may not work if parent container has overflow: hidden css property.', 'shopme' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Full height row?', 'shopme' ),
			'param_name' => 'full_height',
			'description' => esc_html__( 'If checked row will be set to full height.', 'shopme' ),
			'value' => array( esc_html__( 'Yes', 'shopme' ) => 'yes' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Content position', 'shopme' ),
			'param_name' => 'content_placement',
			'value' => array(
				esc_html__( 'Middle', 'shopme' ) => 'middle',
				esc_html__( 'Top', 'shopme' ) => 'top',
			),
			'description' => esc_html__( 'Select content position within row.', 'shopme' ),
			'dependency' => array(
				'element' => 'full_height',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Use video background?', 'shopme' ),
			'param_name' => 'video_bg',
			'description' => esc_html__( 'If checked, video will be used as row background.', 'shopme' ),
			'value' => array( esc_html__( 'Yes', 'shopme' ) => 'yes' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'YouTube link', 'shopme' ),
			'param_name' => 'video_bg_url',
			'description' => esc_html__( 'Add YouTube link.', 'shopme' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Parallax', 'shopme' ),
			'param_name' => 'video_bg_parallax',
			'value' => array(
				esc_html__( 'None', 'shopme' ) => '',
				esc_html__( 'Simple', 'shopme' ) => 'content-moving',
				esc_html__( 'With fade', 'shopme' ) => 'content-moving-fade',
			),
			'description' => esc_html__( 'Add parallax type background for row.', 'shopme' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Parallax', 'shopme' ),
			'param_name' => 'parallax',
			'value' => array(
				esc_html__( 'None', 'shopme' ) => '',
				esc_html__( 'Simple', 'shopme' ) => 'content-moving',
				esc_html__( 'With fade', 'shopme' ) => 'content-moving-fade',
			),
			'description' => esc_html__( 'Add parallax type background for row (Note: If no image is specified, parallax will use background image from Design Options).', 'shopme' ),
			'dependency' => array(
				'element' => 'video_bg',
				'is_empty' => true,
			),
		),
		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Image', 'shopme' ),
			'param_name' => 'parallax_image',
			'value' => '',
			'description' => esc_html__( 'Select image from media library.', 'shopme' ),
			'dependency' => array(
				'element' => 'parallax',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'el_id',
			'heading' => esc_html__( 'Row ID', 'shopme' ),
			'param_name' => 'el_id',
			'description' => sprintf( wp_kses(__( 'Enter row ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'shopme' ), array('a' => array('href' => array(), 'target' => array()))), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Disable row', 'shopme' ),
			'param_name' => 'disable_element', // Inner param name.
			'description' => esc_html__( 'If checked the row won\'t be visible on the public side of your website. You can switch it back any time.', 'shopme' ),
			'value' => array( esc_html__( 'Yes', 'shopme' ) => 'yes' ),
		),
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( 'Add wrapper', 'shopme' ),
			"param_name" => "theme_box",
			"description" => esc_html__('Adds wrapper container with background-color white and border.', 'shopme'),
			"value" => array(
				esc_html__( 'Yes, please', 'shopme' ) => 'theme_box'
			)
		),
		$shopme_add_css_animation,
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'shopme' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'shopme' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'Css', 'shopme' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design options', 'shopme' )
		)
	),
	'js_view' => 'VcRowView'
) );

/* Text Block
---------------------------------------------------------- */
vc_map( array(
	'name' => esc_html__( 'Text Block', 'shopme' ),
	'base' => 'vc_column_text',
	'icon' => 'icon-wpb-layer-shape-text',
	'wrapper_class' => 'clearfix',
	'category' => esc_html__( 'Content', 'shopme' ),
	'description' => esc_html__( 'A block of text with WYSIWYG editor', 'shopme' ),
	'params' => array(
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => esc_html__( 'Text', 'shopme' ),
			'param_name' => 'content',
			'value' => wp_kses(__( '<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'shopme' ), array('p' => array()) )
		),
		array(
			"type" => 'checkbox',
			"heading" => esc_html__( 'Add wrapper', 'shopme' ),
			"param_name" => "theme_box",
			"description" => esc_html__('Adds wrapper container with background-color white and border.', 'shopme'),
			"value" => array(
				esc_html__( 'Yes, please', 'shopme' ) => 'theme_box'
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'shopme' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'shopme' )
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', 'shopme' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design Options', 'shopme' )
		)
	)
) );

/**
 * @since 4.6 new TTA, tabs tours and accordions
 */
include_once "shortcode-vc-tta-tabs.php";
include_once "shortcode-vc-tta-tour.php";
include_once "shortcode-vc-tta-accordion.php";

/* Video element
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Video Player', 'shopme' ),
	'base' => 'vc_video',
	'icon' => 'icon-wpb-film-youtube',
	'category' => esc_html__( 'Content', 'shopme' ),
	'description' => esc_html__( 'Embed YouTube/Vimeo player', 'shopme' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'shopme' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'shopme' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Video link', 'shopme' ),
			'param_name' => 'link',
			'value' => 'http://vimeo.com/92033601',
			'admin_label' => true,
			'description' => sprintf( wp_kses(__( 'Enter link to video (Note: read more about available formats at WordPress <a href="%s" target="_blank">codex page</a>).', 'shopme' ), array('a' => array('href' => array(), 'target' => array()))), 'http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'shopme' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'shopme' )
		),
		$shopme_add_css_animation,
		$shopme_add_animation_delay,
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', 'shopme' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design Options', 'shopme' )
		)
	)
) );

/* Custom Heading element
----------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Custom Heading', 'shopme' ),
	'base' => 'vc_custom_heading',
	'icon' => 'icon-wpb-ui-custom_heading',
	'show_settings_on_create' => true,
	'category' => esc_html__( 'Content', 'shopme' ),
	'description' => esc_html__( 'Text with Google fonts', 'shopme' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Text source', 'shopme' ),
			'param_name' => 'source',
			'value' => array(
				esc_html__( 'Custom text', 'shopme' ) => '',
				esc_html__( 'Post or Page Title', 'shopme' ) => 'post_title'
			),
			'std' => '',
			'description' => esc_html__( 'Select text source.', 'shopme' )
		),
		array(
			'type' => 'textarea',
			'heading' => esc_html__( 'Text', 'shopme' ),
			'param_name' => 'text',
			'admin_label' => true,
			'value' => esc_html__( 'This is custom heading element with Google Fonts', 'shopme' ),
			'description' => esc_html__( 'Note: If you are using non-latin characters be sure to activate them under Settings/Visual Composer/General Settings.', 'shopme' ),
		),
		array(
			'type' => 'vc_link',
			'heading' => esc_html__( 'URL (Link)', 'shopme' ),
			'param_name' => 'link',
			'description' => esc_html__( 'Add link to custom heading.', 'shopme' ),
		),
		array(
			'type' => 'font_container',
			'param_name' => 'font_container',
			'value' => 'tag:h2|text_align:left',
			'settings' => array(
				'fields' => array(
					'tag' => 'h2', // default value h2
					'text_align',
					'font_size',
					'line_height',
					'color',
					'tag_description' => esc_html__( 'Select element tag.', 'shopme' ),
					'text_align_description' => esc_html__( 'Select text alignment.', 'shopme' ),
					'font_size_description' => esc_html__( 'Enter font size.', 'shopme' ),
					'line_height_description' => esc_html__( 'Enter line height.', 'shopme' ),
					'color_description' => esc_html__( 'Select heading color.', 'shopme' ),
				),
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Use theme default font family?', 'shopme' ),
			'param_name' => 'use_theme_fonts',
			'value' => array( esc_html__( 'Yes', 'shopme' ) => 'yes' ),
			'description' => esc_html__( 'Use font family from the theme.', 'shopme' ),
		),
		array(
			'type' => 'google_fonts',
			'param_name' => 'google_fonts',
			'value' => 'font_family:Roboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic%20Fatface%3A400|font_style:400%20regular%3A400%3Anormal',
			'settings' => array(
				'fields' => array(
					'font_family_description' => esc_html__( 'Select font family.', 'shopme' ),
					'font_style_description' => esc_html__( 'Select font styling.', 'shopme' )
				)
			),
			'dependency' => array(
				'element' => 'use_theme_fonts',
				'value_not_equal_to' => 'yes',
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'shopme' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'shopme' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', 'shopme' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design Options', 'shopme' )
		)
	),
) );

/* Theme Shortcodes
/* ---------------------------------------------------------------- */

/* Mega Menu
---------------------------------------------------------- */

if ( function_exists( 'mmm_mega_main_menu_shortcode' ) ) {

	$nav_menu = array();
	// Get menus
	$menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );

	if ($menus) {
		foreach( $menus as $menu ) {
			$nav_menu[$menu->term_id] = $menu->name;
		}
	}

	vc_map( array(
		'name' => esc_html__( 'Mega MainMenu', 'shopme' ),
		'base' => 'vc_mad_mega_main_menu',
		'class' => 'mega_main_menu',
		'category' => esc_html__( 'MegaMain Extensions', 'shopme' ),
		'params' => array(
			array(
				"type" => "textfield",
				"heading" => esc_html__( 'Title', 'shopme' ),
				"param_name" => "title",
				"holder" => "h4",
				"description" => ''
			),
			array(
				'heading' => esc_html__( 'Select Menu:', 'shopme' ),
				'description' => esc_html__( 'Select the menu.', 'shopme' ),
				'param_name' => 'nav_menu',
				'type' => 'dropdown',
				'value' => $nav_menu
			)
		)
	) );

}

/* List Styles
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'List Styles', 'shopme' ),
	'base' => 'vc_mad_list_styles',
	'icon' => 'icon-wpb-mad-list-styles',
	'category' => esc_html__( 'Content', 'shopme' ),
	'description' => esc_html__( 'List styles', 'shopme' ),
	'params' => array(
		array(
			"type" => "choose_icons",
			"heading" => esc_html__("Icon", 'shopme'),
			"param_name" => "icon",
			"value" => 'none',
			"description" => esc_html__( 'Select icon from library for you list styles.', 'shopme')
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => esc_html__( 'List Items', 'shopme' ),
			'param_name' => 'values',
			'description' => esc_html__( 'Input list items values. Divide values with linebreaks (Enter). Example: Development|Design', 'shopme' ),
			'value' => 'Aenean auctor|Et urna aliquam|Erat volutpat'
		)
	)
) );

/* Tables
---------------------------------------------------------- */

vc_map( array(
	"name"		=> esc_html__('Tables', 'shopme'),
	"base"		=> "vc_mad_tables",
	"icon"		=> "icon-wpb-mad-tables",
	"is_container" => true,
	"category"  => esc_html__('Content', 'shopme'),
	"description" => esc_html__('Tables', 'shopme'),
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => esc_html__( 'Title', 'shopme' ),
			"param_name" => "title",
			"holder" => "h4",
			"description" => ''
		),
		array(
			"type" => "table_number",
			"heading" => esc_html__("Columns", 'shopme'),
			"param_name" => "columns",
			"value" => ''
		),
		array(
			"type" => "table_number",
			"heading" => esc_html__( 'Rows', 'shopme' ),
			"param_name" => "rows",
			"description" => ''
		),
		array(
			"type" => "table_hidden",
			"param_name" => "data",
			"class" => "tables-hidden-data",
			"description" => ''
		)
	)
));


/* Testimonials
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Testimonials', 'shopme' ),
	'base' => 'vc_mad_testimonials',
	'icon' => 'icon-wpb-mad-testimonials',
	'description' => esc_html__( 'Testimonials post type', 'shopme' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'shopme' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'shopme' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Testimonial Style', 'shopme' ),
			'param_name' => 'style',
			'value' => array(
				esc_html__( 'Grid', 'shopme' ) => 'tm-grid',
				esc_html__( 'List', 'shopme' ) => 'tm-list',
				esc_html__( 'Carousel', 'shopme' ) => 'widgets_carousel'
			),
			'description' => esc_html__( 'Here you can select how to display the testimonials. You can either create a testimonial grid with multiple columns or a testimonial list or testimonial carousel', 'shopme' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type', 'shopme' ),
			'param_name' => 'type',
			'value' => array(
				esc_html__( 'Type 1', 'shopme' ) => '',
				esc_html__( 'Type 2', 'shopme' ) => 'type_2'
			),
			'description' => esc_html__( 'Type style?', 'shopme' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Columns', 'shopme' ),
			'param_name' => 'columns',
			'value' => array(
				esc_html__( '3 Columns', 'shopme' ) => 3,
				esc_html__( '4 Columns', 'shopme' ) => 4
			),
			'description' => esc_html__( 'How many columns should be displayed?', 'shopme' ),
			'dependency' => array(
				'element' => 'style',
				'value' => array('tm-grid')
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Count Items', 'shopme' ),
			'param_name' => 'items',
			'value' => SHOPME_VC_CONFIG::array_number(1, 10, 1, array('All' => -1)),
			'std' => -1,
			'description' => esc_html__( 'How many items should be displayed per page?', 'shopme' )
		),
		array(
			"type" => "get_terms",
			"term" => "testimonials_category",
			'heading' => esc_html__( 'Which categories should be used for the testimonials?', 'shopme' ),
			"param_name" => "categories",
			"holder" => "div",
			'description' => esc_html__('The Page will then show testimonials from only those categories.', 'shopme'),
			'group' => esc_html__( 'Data Settings', 'shopme' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order By', 'shopme' ),
			'param_name' => 'orderby',
			'value' => SHOPME_VC_CONFIG::get_order_sort_array(),
			'description' => esc_html__( 'Sort retrieved items by parameter', 'shopme' ),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Data Settings', 'shopme' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order', 'shopme' ),
			'param_name' => 'order',
			'value' => array(
				esc_html__( 'DESC', 'shopme' ) => 'DESC',
				esc_html__( 'ASC', 'shopme' ) => 'ASC',
			),
			'description' => esc_html__( 'Direction Order', 'shopme' ),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Data Settings', 'shopme' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Add button \'View All Testimonials\'', 'shopme' ),
			'param_name' => 'view_all_button',
			'value' => array(
				esc_html__( 'No', 'shopme' ) => 'no',
				esc_html__( 'Yes', 'shopme' ) => 'yes'
			),
			'description' => esc_html__( 'Should a button be displayed?', 'shopme' ),
			'std' => 'no'
		),
		$shopme_add_css_animation,
		$shopme_add_animation_delay
	)
) );

/* Brands Logo
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Brands Logo', 'shopme' ),
	'base' => 'vc_mad_brands_logo',
	'icon' => 'icon-wpb-brands-logo',
	'description' => esc_html__( 'Brands logo', 'shopme' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'shopme' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'shopme' )
		),
		array(
			'type' => 'attach_images',
			'heading' => esc_html__( 'Images', 'shopme' ),
			'param_name' => 'images',
			'value' => '',
			'description' => esc_html__( 'Select images from media library.', 'shopme' )
		),
		array(
			"type" => "textarea",
			"heading" => esc_html__( 'Links', 'shopme' ),
			"param_name" => "links",
			"holder" => "span",
			"description" => esc_html__( 'Input links values. Divide values with linebreaks (|). Example: http://brand.com | http://brand2.com', 'shopme' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Autoplay', 'shopme' ),
			'param_name' => 'autoplay',
			'description' => esc_html__( 'Enables autoplay mode.', 'shopme' ),
			'value' => array( esc_html__( 'Yes, please', 'shopme' ) => 'yes' )
		),
		array(
			'type' => 'number',
			'heading' => esc_html__( 'Autoplay timeout', 'shopme' ),
			'param_name' => 'autoplaytimeout',
			'description' => esc_html__( 'Autoplay interval timeout', 'shopme' ),
			'value' => 5000,
			'dependency' => array(
				'element' => 'autoplay',
				'value' => array( 'yes' )
			)
		),
		$shopme_add_css_animation,
		$shopme_add_animation_delay
	)
) );

/* Blog Posts
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Blog Posts', 'shopme' ),
	'base' => 'vc_mad_blog_posts',
	'icon' => 'icon-wpb-application-icon-large',
	'description' => esc_html__( 'Blog posts', 'shopme' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'shopme' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'shopme' ),
			'edit_field_class' => 'vc_col-sm-6'
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Tag for title', 'shopme' ),
			'param_name' => 'tag_title',
			'value' => array(
				'h1' => 'h1',
				'h2' => 'h2',
				'h3' => 'h3'
			),
			'std' => 'h3',
			'edit_field_class' => 'vc_col-sm-6',
			'description' => esc_html__( 'Choose tag for title.', 'shopme' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Blog Style', 'shopme' ),
			'param_name' => 'blog_style',
			'value' => array(
				esc_html__( 'Blog Big', 'shopme' ) => 'blog-big',
				esc_html__( 'Blog List', 'shopme' ) => 'blog-list',
				esc_html__( 'Blog Grid', 'shopme' ) => 'blog-grid'
			),
			'std' => 'blog-big',
			'description' => esc_html__( 'Choose the default blog layout here.', 'shopme' )
		),
		array(
			"type" => "get_terms",
			"term" => "category",
			'heading' => esc_html__( 'Which categories should be used for the blog?', 'shopme' ),
			"param_name" => "category",
			"holder" => "div",
			'description' => esc_html__('The Page will then show entries from only those categories.', 'shopme'),
			'group' => esc_html__( 'Data Settings', 'shopme' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order By', 'shopme' ),
			'param_name' => 'orderby',
			'value' => SHOPME_VC_CONFIG::get_order_sort_array(),
			'std' => 'date',
			'description' => esc_html__( 'Sort retrieved posts by parameter', 'shopme' ),
			'group' => esc_html__( 'Data Settings', 'shopme' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order', 'shopme' ),
			'param_name' => 'order',
			'value' => array(
				esc_html__( 'DESC', 'shopme' ) => 'DESC',
				esc_html__( 'ASC', 'shopme' ) => 'ASC'
			),
			'description' => esc_html__( 'In what direction order?', 'shopme' ),
			'group' => esc_html__( 'Data Settings', 'shopme' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Display Style', 'shopme' ),
			'param_name' => 'display_style',
			'value' => array(
				esc_html__( 'Default grid', 'shopme' ) => '',
				esc_html__( 'Carousel', 'shopme' ) => 'owl_carousel',
			),
			'description' => esc_html__( 'Select display style for grid.', 'shopme' ),
			'dependency' => array(
				'element' => 'blog_style',
				'value' => array('blog-grid')
			),
			'group' => esc_html__( 'Blog Grid', 'shopme' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Columns', 'shopme' ),
			'param_name' => 'columns',
			'value' => array(
				esc_html__( '2 Columns', 'shopme' ) => 2,
				esc_html__( '3 Columns', 'shopme' ) => 3,
				esc_html__( '4 Columns', 'shopme' ) => 4
			),
			'description' => esc_html__( 'How many columns should be displayed?', 'shopme' ),
			'dependency' => array(
				'element' => 'blog_style',
				'value' => array('blog-grid')
			),
			'group' => __( 'Blog Grid', 'shopme' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type', 'shopme' ),
			'param_name' => 'type',
			'value' => array(
				esc_html__( 'Type 1', 'shopme' ) => 'type-1',
				esc_html__( 'Type 2', 'shopme' ) => 'type-2'
			),
			'description' => esc_html__( 'Type style?', 'shopme' ),
			'dependency' => array(
				'element' => 'blog_style',
				'value' => array('blog-grid')
			),
			'group' => esc_html__( 'Blog Grid', 'shopme' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Add button', 'shopme' ),
			'param_name' => 'add_button',
			'value' => array(
				esc_html__( 'Yes', 'shopme' ) => 'yes',
				esc_html__( 'No', 'shopme' ) => 'no'
			),
			'description' => esc_html__( 'Button with text', 'shopme' ),
			'dependency' => array(
				'element' => 'type',
				'value' => array('type-2')
			),
			'group' => esc_html__( 'Blog Grid', 'shopme' )
		),
		array(
			"type" => "vc_link",
			"heading" => esc_html__( 'Add URL to the button', 'shopme' ),
			"param_name" => "link",
			'dependency' => array(
				'element' => 'add_button',
				'value' => array('yes')
			),
			'group' => esc_html__( 'Blog Grid', 'shopme' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Posts Count', 'shopme' ),
			'param_name' => 'posts_per_page',
			'value' => SHOPME_VC_CONFIG::array_number(1, 50, 1, array('-1' => 'All')),
			'std' => 5,
			'description' => esc_html__( 'How many items should be displayed per page?', 'shopme' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Pagination', 'shopme' ),
			'param_name' => 'pagination',
			'value' => array(
				esc_html__( 'No', 'shopme' ) => 'no',
				esc_html__( 'Yes', 'shopme' ) => 'yes'
			),
			'description' => esc_html__( 'Should a pagination be displayed?', 'shopme' )
		),
		$shopme_add_css_animation,
		$shopme_add_animation_delay
	)
) );


/* Banners
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Banners', 'shopme' ),
	'base' => 'vc_mad_banners',
	'icon' => 'icon-wpb-mad-banners',
	'description' => esc_html__( 'banners', 'shopme' ),
	'params' => array(
		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Image', 'shopme' ),
			'param_name' => 'image',
			'value' => '',
			'description' => esc_html__( 'Select image from media library.', 'shopme' )
		),
		array(
			"type" => "vc_link",
			"heading" => esc_html__( 'Add URL to the button', 'shopme' ),
			"param_name" => "link"
		),
		$shopme_add_css_animation,
		$shopme_add_animation_delay
	)
) );

if (class_exists('WooCommerce')) {

	/* Product Grid
	---------------------------------------------------------- */

	vc_map( array(
		'name' => esc_html__( 'Products', 'shopme' ),
		'base' => 'vc_mad_products',
		'icon' => 'icon-wpb-mad-woocommerce',
		'category' => esc_html__( 'WooCommerce', 'shopme' ),
		'description' => esc_html__( 'Displayed for product grid', 'shopme' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', 'shopme' ),
				'param_name' => 'title',
				'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'shopme' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Grid or Carousel', 'shopme' ),
				'param_name' => 'type',
				'value' => array(
					esc_html__('Grid Style', 'shopme') => '',
					esc_html__('Carousel', 'shopme') => 'owl_carousel'
				),
				'std' => 'view-grid',
				'description' => esc_html__('Choose the type style.', 'shopme')
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Layout', 'shopme' ),
				'param_name' => 'layout',
				'value' => array(
					esc_html__('Type 1', 'shopme') => 'type_1',
					esc_html__('Type 2', 'shopme') => 'type_2',
					esc_html__('Type 3', 'shopme') => 'type_3',
					esc_html__('Type 4', 'shopme') => 'type_4'
				),
				'std' => 'type_2',
				'description' => esc_html__('Choose layout style.', 'shopme')
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Columns', 'shopme' ),
				'param_name' => 'columns',
				'value' => array(
					esc_html__( '3 Columns', 'shopme' ) => 3,
					esc_html__( '4 Columns', 'shopme' ) => 4,
					esc_html__( '5 Columns', 'shopme' ) => 5,
					esc_html__( '6 Columns', 'shopme' ) => 6
				),
				'description' => esc_html__( 'How many columns should be displayed?', 'shopme' ),
				'param_holder_class' => ''
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Count Items', 'shopme' ),
				'param_name' => 'items',
				'value' => SHOPME_VC_CONFIG::array_number(1, 40, 1, array('All' => -1)),
				'std' => 9,
				'description' => esc_html__( 'How many items should be displayed per page?', 'shopme' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Show', 'shopme' ),
				'param_name' => 'show',
				'value' => array(
					esc_html__( 'All Products', 'shopme' ) => '',
					esc_html__( 'Featured Products', 'shopme' ) => 'featured',
					esc_html__( 'On-sale Products', 'shopme' ) => 'onsale',
					esc_html__( 'Best Selling Products', 'shopme' ) => 'bestselling',
					esc_html__( 'Top Rated Products', 'shopme' ) => 'toprated',
					esc_html__( 'New', 'shopme' ) => 'new'
				),
				'description' => '',
				'std' => 'desc',
				'group' => esc_html__( 'Data Settings', 'shopme' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Order by', 'shopme' ),
				'param_name' => 'orderby',
				'value' => array(
					esc_html__('Default', 'shopme' ) => '',
					esc_html__('Date', 'shopme' ) => 'date',
					esc_html__('Price', 'shopme' ) => 'price',
					esc_html__('Random', 'shopme' ) => 'rand',
					esc_html__('Sales', 'shopme' ) => 'sales',
					esc_html__('Sort alphabetically', 'shopme' ) => 'title',
					esc_html__('Sort by popularity', 'shopme' ) => 'popularity'
				),
				'description' => esc_html__( 'Here you can choose how to display the products', 'shopme' ),
				'group' => esc_html__( 'Data Settings', 'shopme' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Sorting Order', 'shopme' ),
				'param_name' => 'order',
				'value' => array(
					esc_html__( 'ASC', 'shopme' ) => 'asc',
					esc_html__( 'DESC', 'shopme' ) => 'desc'
				),
				'description' => esc_html__( 'Here you can choose how to display the products', 'shopme' ),
				'std' => 'desc',
				'group' => esc_html__( 'Data Settings', 'shopme' )
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Highlight main product', 'shopme' ),
				'param_name' => 'highlight_product',
				'dependency' => array(
					'element' => 'type',
					'value' => array('')
				),
				'description' => esc_html__( 'Highlight the desired product on grid style', 'shopme' ),
				'value' => array( esc_html__( 'Yes', 'shopme' ) => true ),
				'group' => esc_html__( 'Highlight Product', 'shopme' )
			),
			array(
				'type' => 'autocomplete',
				'settings' => array(
					'multiple' => false,
					// is multiple values allowed? default false
					// 'sortable' => true, // is values are sortable? default false
					'min_length' => 2,
					// min length to start search -> default 2
					// 'no_hide' => true, // In UI after select doesn't hide an select list, default false
					'groups' => true,
					// In UI show results grouped by groups, default false
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend, default false
					'display_inline' => true,
					// In UI show results inline view, default false (each value in own line)
					'delay' => 500,
					// delay for search. default 500
					'auto_focus' => true,
					// auto focus input, default true
					// 'values' => $taxonomies_list,
				),
				'heading' => esc_html__( 'Select identificator', 'shopme' ),
				'param_name' => 'product_id',
				'admin_label' => true,
				'dependency' => array(
					'element' => 'highlight_product',
					'not_empty' => true
				),
				'group' => esc_html__( 'Highlight Product', 'shopme' ),
				'description' => esc_html__('Input product ID or product SKU or product title to see suggestions', 'shopme')
			),
			array(
				'type' => 'autocomplete',
				'settings' => array(
					'multiple' => true,
					// is multiple values allowed? default false
					// 'sortable' => true, // is values are sortable? default false
					'min_length' => 2,
					// min length to start search -> default 2
					// 'no_hide' => true, // In UI after select doesn't hide an select list, default false
					'groups' => true,
					// In UI show results grouped by groups, default false
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend, default false
					'display_inline' => true,
					// In UI show results inline view, default false (each value in own line)
					'delay' => 500,
					// delay for search. default 500
					'auto_focus' => true,
					// auto focus input, default true
					// 'values' => $taxonomies_list,
				),
				'heading' => esc_html__( 'Select identificators', 'shopme' ),
				'param_name' => 'by_id',
				'admin_label' => true,
				'group' => esc_html__( 'Data Settings', 'shopme' ),
				'description' => esc_html__('Input product ID or product SKU or product title to see suggestions', 'shopme')
			),
			array(
				"type" => "get_terms",
				"term" => "product_cat",
				'heading' => esc_html__( 'Which categories should be used for the products?', 'shopme' ),
				"param_name" => "categories",
				'admin_label' => true,
				'group' => esc_html__( 'Data Settings', 'shopme' ),
				'description' => esc_html__('The Page will then show products from only those categories.', 'shopme')
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Filter', 'shopme' ),
				'param_name' => 'filter',
				'value' => array(
					esc_html__( 'No', 'shopme' ) => '',
					esc_html__( 'Yes', 'shopme' ) => 'yes'
				),
				'std' => '',
				'description' => esc_html__( 'Should the filter options based on categories be displayed?', 'shopme' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Filter style', 'shopme' ),
				'param_name' => 'filter_style',
				'value' => array(
					esc_html__('Horizontal style', 'shopme') => 'filter_style_1',
					esc_html__('Vertical style', 'shopme') => 'filter_style_2'
				),
				'group' => esc_html__( 'Filter', 'shopme' ),
				'dependency' => array(
					'element' => 'filter',
					'value' => array('yes')
				),
				'description' => esc_html__('Choose layout style.', 'shopme')
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Filter by All', 'shopme' ),
				'param_name' => 'visible_all_item',
				'description' => esc_html__( 'Filter by All the selected categories', 'shopme' ),
				'group' => esc_html__( 'Filter', 'shopme' ),
				'value' => array( esc_html__( 'Yes', 'shopme' ) => true ),
				'dependency' => array(
					'element' => 'filter',
					'value' => array('yes')
				),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Filter by', 'shopme' ),
				'param_name' => 'filter_logic',
				'value' => array(
					esc_html__('Filter by Category', 'shopme') => 'filter_cat',
					esc_html__('Choose how to filter', 'shopme') => 'filter_choose'
				),
				'std' => 'filter_cat',
				'group' => esc_html__( 'Filter', 'shopme' ),
				'dependency' => array(
					'element' => 'filter',
					'value' => array('yes')
				),
				'description' => esc_html__('How to filter the product?', 'shopme')
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Add featured filter?', 'shopme' ),
				'param_name' => 'add_featured',
				'description' => esc_html__( 'Sort by featured', 'shopme' ),
				'group' => esc_html__( 'Filter', 'shopme' ),
				'value' => array( esc_html__( 'Yes', 'shopme' ) => true ),
				'dependency' => array(
					'element' => 'filter_logic',
					'value' => array('filter_choose'),
				),
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Add new filter?', 'shopme' ),
				'param_name' => 'add_new',
				'description' => esc_html__( 'Sort by newness', 'shopme' ),
				'group' => esc_html__( 'Filter', 'shopme' ),
				'value' => array( esc_html__( 'Yes', 'shopme' ) => true ),
				'dependency' => array(
					'element' => 'filter_logic',
					'value' => array('filter_choose'),
				),
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Add sale filter?', 'shopme' ),
				'param_name' => 'add_sale',
				'description' => __( 'Sort by price sale', 'shopme' ),
				'group' => esc_html__( 'Filter', 'shopme' ),
				'value' => array( esc_html__( 'Yes', 'shopme' ) => true ),
				'dependency' => array(
					'element' => 'filter_logic',
					'value' => array('filter_choose'),
				),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Pagination', 'shopme' ),
				'param_name' => 'pagination',
				'value' => array(
					esc_html__( 'No', 'shopme' ) => 'no',
					esc_html__( 'Yes', 'shopme' ) => 'yes'
				),
				'dependency' => array(
					'element' => 'type',
					'value' => array(''),
				),
				'description' => esc_html__( 'Should a pagination be displayed?', 'shopme' )
			),
			array(
				"type" => "vc_link",
				"heading" => esc_html__( 'Add URL to the product footer box (optional)', 'shopme' ),
				"param_name" => "link"
			),
			$shopme_add_css_animation,
			$shopme_add_animation_delay
		)
	) );

	$Vc_Vendor_Woocommerce = new Vc_Vendor_Woocommerce();

	//Filters For autocomplete param:
	//For suggestion: vc_autocomplete_[shortcode_name]_[param_name]_callback
	add_filter( 'vc_autocomplete_vc_mad_products_product_id_callback', array($Vc_Vendor_Woocommerce, 'productIdAutocompleteSuggester' ), 10, 1 );
	// Get suggestion(find). Must return an array
	add_filter( 'vc_autocomplete_vc_mad_products_product_id_render', array($Vc_Vendor_Woocommerce, 'productIdAutocompleteRender' ), 10, 1 );
	// Render exact product. Must return an array (label,value)
	//For param: ID default value filter
	add_filter( 'vc_form_fields_render_field_vc_mad_products_product_id_param_value', array($Vc_Vendor_Woocommerce, 'productIdDefaultValue' ), 10, 4 );
	// Defines default value for param if not provided. Takes from other param value.

	//Filters For autocomplete param:
	//For suggestion: vc_autocomplete_[shortcode_name]_[param_name]_callback
	add_filter( 'vc_autocomplete_vc_mad_products_by_id_callback', array($Vc_Vendor_Woocommerce, 'productIdAutocompleteSuggester' ), 10, 1 );
	// Get suggestion(find). Must return an array
	add_filter( 'vc_autocomplete_vc_mad_products_by_id_render', array($Vc_Vendor_Woocommerce, 'productIdAutocompleteRender' ), 10, 1 );
	// Render exact product. Must return an array (label,value)
	//For param: ID default value filter
	add_filter( 'vc_form_fields_render_field_vc_mad_products_by_id_param_value', array($Vc_Vendor_Woocommerce, 'productIdDefaultValue' ), 10, 4 );
	// Defines default value for param if not provided. Takes from other param value.

	/* Product Cards
	---------------------------------------------------------- */

	vc_map( array(
		'name' => esc_html__( 'Products Cards', 'shopme' ),
		'base' => 'vc_mad_products_cards',
		'icon' => 'icon-wpb-mad-woocommerce',
		'category' => esc_html__( 'WooCommerce', 'shopme' ),
		'description' => esc_html__( 'Displayed for product cards and carousel with category', 'shopme' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', 'shopme' ),
				'param_name' => 'title',
				'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'shopme' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Grid or Carousel', 'shopme' ),
				'param_name' => 'type',
				'value' => array(
					esc_html__('Grid Style', 'shopme') => 'grid_style',
					esc_html__('Carousel', 'shopme') => 'owl_carousel'
				),
				'std' => 'grid_style',
				'description' => esc_html__('Choose the type style.', 'shopme')
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Highlight main product', 'shopme' ),
				'param_name' => 'highlight_product',
				'dependency' => array(
					'element' => 'type',
					'value' => array('grid_style')
				),
				'description' => esc_html__( 'Highlight the desired product on grid style', 'shopme' ),
				'value' => array( esc_html__( 'Yes', 'shopme' ) => true ),
				'group' => esc_html__( 'Highlight Product', 'shopme' )
			),
			array(
				'type' => 'autocomplete',
				'settings' => array(
					'multiple' => false,
					// is multiple values allowed? default false
					// 'sortable' => true, // is values are sortable? default false
					'min_length' => 2,
					// min length to start search -> default 2
					// 'no_hide' => true, // In UI after select doesn't hide an select list, default false
					'groups' => true,
					// In UI show results grouped by groups, default false
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend, default false
					'display_inline' => true,
					// In UI show results inline view, default false (each value in own line)
					'delay' => 500,
					// delay for search. default 500
					'auto_focus' => true,
					// auto focus input, default true
					// 'values' => $taxonomies_list,
				),
				'heading' => esc_html__( 'Select identificator', 'shopme' ),
				'param_name' => 'product_id',
				'admin_label' => true,
				'dependency' => array(
					'element' => 'highlight_product',
					'not_empty' => true
				),
				'group' => esc_html__( 'Highlight Product', 'shopme' ),
				'description' => esc_html__('Input product ID or product SKU or product title to see suggestions', 'shopme')
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Count Items', 'shopme' ),
				'param_name' => 'items',
				'value' => SHOPME_VC_CONFIG::array_number(1, 100, 1, array('All' => -1)),
				'std' => 18,
				'dependency' => array(
					'element' => 'type',
					'value' => array('owl_carousel')
				),
				'description' => esc_html__( 'How many items should be displayed per page?', 'shopme' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Show', 'shopme' ),
				'param_name' => 'show',
				'value' => array(
					esc_html__( 'All Products', 'shopme' ) => '',
					esc_html__( 'Featured Products', 'shopme' ) => 'featured',
					esc_html__( 'On-sale Products', 'shopme' ) => 'onsale',
					esc_html__( 'Best Selling Products', 'shopme' ) => 'bestselling',
					esc_html__( 'Top Rated Products', 'shopme' ) => 'toprated',
					esc_html__( 'New', 'shopme' ) => 'new'
				),
				'description' => '',
				'std' => 'desc',
				'group' => esc_html__( 'Data Settings', 'shopme' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Order by', 'shopme' ),
				'param_name' => 'orderby',
				'value' => array(
					esc_html__('Default', 'shopme' ) => '',
					esc_html__('Date', 'shopme' ) => 'date',
					esc_html__('Price', 'shopme' ) => 'price',
					esc_html__('Random', 'shopme' ) => 'rand',
					esc_html__('Sales', 'shopme' ) => 'sales',
					esc_html__('Sort alphabetically', 'shopme' ) => 'title',
					esc_html__('Sort by popularity', 'shopme' ) => 'popularity'
				),
				'description' => esc_html__( 'Here you can choose how to display the products', 'shopme' ),
				'group' => esc_html__( 'Data Settings', 'shopme' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Sorting Order', 'shopme' ),
				'param_name' => 'order',
				'value' => array(
					esc_html__( 'ASC', 'shopme' ) => 'asc',
					esc_html__( 'DESC', 'shopme' ) => 'desc'
				),
				'description' => esc_html__( 'Here you can choose how to display the products', 'shopme' ),
				'std' => 'desc',
				'group' => esc_html__( 'Data Settings', 'shopme' )
			),
			array(
				"type" => "get_terms",
				"term" => "product_cat",
				'heading' => esc_html__( 'Which categories should be used for the products?', 'shopme' ),
				"param_name" => "categories",
				'admin_label' => true,
				'group' => esc_html__( 'Data Settings', 'shopme' ),
				'description' => esc_html__('The Page will then show products from only those categories.', 'shopme')
			),
		)
	) );

	//Filters For autocomplete param:
	//For suggestion: vc_autocomplete_[shortcode_name]_[param_name]_callback
	add_filter( 'vc_autocomplete_vc_mad_products_cards_product_id_callback', array($Vc_Vendor_Woocommerce, 'productIdAutocompleteSuggester' ), 10, 1 );
	// Get suggestion(find). Must return an array
	add_filter( 'vc_autocomplete_vc_mad_products_cards_product_id_render', array($Vc_Vendor_Woocommerce, 'productIdAutocompleteRender' ), 10, 1 );
	// Render exact product. Must return an array (label,value)
	//For param: ID default value filter
	add_filter( 'vc_form_fields_render_field_vc_mad_products_cards_product_id_param_value', array($Vc_Vendor_Woocommerce, 'productIdDefaultValue' ), 10, 4 );
	// Defines default value for param if not provided. Takes from other param value.


	/* Products Page Carousel
	---------------------------------------------------------- */

	vc_map( array(
		'name' => esc_html__( 'Products Page Carousel', 'shopme' ),
		'base' => 'vc_mad_products_page_carousel',
		'icon' => 'icon-wpb-mad-woocommerce',
		'category' => esc_html__( 'WooCommerce', 'shopme' ),
		'description' => esc_html__( 'Displayed for product page carousel', 'shopme' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', 'shopme' ),
				'param_name' => 'title',
				'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'shopme' )
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Title color', 'shopme' ),
				'param_name' => 'title_color',
				'description' => esc_html__( 'Select custom color for title.', 'shopme' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Count Items', 'shopme' ),
				'param_name' => 'items',
				'value' => SHOPME_VC_CONFIG::array_number(1, 30, 1, array('All' => -1)),
				'std' => 9,
				'description' => esc_html__( 'How many items should be displayed per page?', 'shopme' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Show', 'shopme' ),
				'param_name' => 'show',
				'value' => array(
					esc_html__( 'All Products', 'shopme' ) => '',
					esc_html__( 'Featured Products', 'shopme' ) => 'featured',
					esc_html__( 'On-sale Products', 'shopme' ) => 'onsale',
					esc_html__( 'Best Selling Products', 'shopme' ) => 'bestselling',
					esc_html__( 'Top Rated Products', 'shopme' ) => 'toprated',
					esc_html__( 'New', 'shopme' ) => 'new'
				),
				'description' => '',
				'std' => 'desc',
				'group' => esc_html__( 'Data Settings', 'shopme' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Order by', 'shopme' ),
				'param_name' => 'orderby',
				'value' => array(
					esc_html__('Default', 'shopme' ) => '',
					esc_html__('Date', 'shopme' ) => 'date',
					esc_html__('Price', 'shopme' ) => 'price',
					esc_html__('Random', 'shopme' ) => 'rand',
					esc_html__('Sales', 'shopme' ) => 'sales',
					esc_html__('Sort alphabetically', 'shopme' ) => 'title',
					esc_html__('Sort by popularity', 'shopme' ) => 'popularity'
				),
				'description' => esc_html__( 'Here you can choose how to display the products', 'shopme' ),
				'group' => esc_html__( 'Data Settings', 'shopme' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Sorting Order', 'shopme' ),
				'param_name' => 'order',
				'value' => array(
					esc_html__( 'ASC', 'shopme' ) => 'asc',
					esc_html__( 'DESC', 'shopme' ) => 'desc'
				),
				'description' => esc_html__( 'Here you can choose how to display the products', 'shopme' ),
				'std' => 'desc',
				'group' => esc_html__( 'Data Settings', 'shopme' )
			),
			array(
				'type' => 'autocomplete',
				'settings' => array(
					'multiple' => true,
					// is multiple values allowed? default false
					// 'sortable' => true, // is values are sortable? default false
					'min_length' => 2,
					// min length to start search -> default 2
					// 'no_hide' => true, // In UI after select doesn't hide an select list, default false
					'groups' => true,
					// In UI show results grouped by groups, default false
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend, default false
					'display_inline' => true,
					// In UI show results inline view, default false (each value in own line)
					'delay' => 500,
					// delay for search. default 500
					'auto_focus' => true,
					// auto focus input, default true
					// 'values' => $taxonomies_list,
				),
				'heading' => esc_html__( 'Select identificators', 'shopme' ),
				'param_name' => 'by_id',
				'admin_label' => true,
				'group' => esc_html__( 'Data Settings', 'shopme' ),
				'description' => esc_html__('Input product ID or product SKU or product title to see suggestions', 'shopme')
			),
			array(
				"type" => "get_terms",
				"term" => "product_cat",
				'heading' => esc_html__( 'Which categories should be used for the products?', 'shopme' ),
				"param_name" => "categories",
				'admin_label' => true,
				'group' => esc_html__( 'Data Settings', 'shopme' ),
				'description' => esc_html__('The Page will then show products from only those categories.', 'shopme')
			),
			array(
				"type" => "vc_link",
				"heading" => esc_html__( 'Add URL to the product footer box (optional)', 'shopme' ),
				"param_name" => "link",
			),
			$shopme_add_css_animation,
			$shopme_add_animation_delay
		)
	) );

	//Filters For autocomplete param:
	//For suggestion: vc_autocomplete_[shortcode_name]_[param_name]_callback
	add_filter( 'vc_autocomplete_vc_mad_products_page_carousel_by_id_callback', array($Vc_Vendor_Woocommerce, 'productIdAutocompleteSuggester' ), 10, 1 );
	 // Get suggestion(find). Must return an array
	add_filter( 'vc_autocomplete_vc_mad_products_page_carousel_by_id_render', array($Vc_Vendor_Woocommerce, 'productIdAutocompleteRender' ), 10, 1 );
	 // Render exact product. Must return an array (label,value)
	//For param: ID default value filter
	add_filter( 'vc_form_fields_render_field_vc_mad_products_page_carousel_by_id_param_value', array($Vc_Vendor_Woocommerce, 'productIdDefaultValue' ), 10, 4 );
	 // Defines default value for param if not provided. Takes from other param value.

	/* VC woocommerce order tracking */
	vc_map( array(
			"name" => esc_html__("Order Tracking", 'shopme'),
			"base" => "woocommerce_order_tracking",
			"icon" => 'icon-wpb-mad-woocommerce',
			"class" => "wp_woo",
			"category" => esc_html__('WooCommerce', 'shopme'),
			"show_settings_on_create" => false
		)
	);

	/* VC woocommerce cart */
	vc_map( array(
			"name" => esc_html__("Cart", 'shopme'),
			"base" => "woocommerce_cart",
			"icon" => 'icon-wpb-mad-woocommerce',
			"class" => "wp_woo",
			"category" => esc_html__('WooCommerce', 'shopme'),
			"show_settings_on_create" => false
		)
	);

	/* VC woocommerce checkout */
	vc_map( array(
			"name" => esc_html__("Checkout", 'shopme'),
			"base" => "woocommerce_checkout",
			"icon" => 'icon-wpb-mad-woocommerce',
			"category" => esc_html__('WooCommerce', 'shopme'),
			"show_settings_on_create" => false
		)
	);

	/* VC woocommerce my account */
	vc_map( array(
			"name" => esc_html__("My Account", 'shopme'),
			"base" => "woocommerce_my_account",
			"icon" => 'icon-wpb-mad-woocommerce',
			"category" => esc_html__('WooCommerce', 'shopme'),
			"show_settings_on_create" => false
		)
	);

	if (defined('YITH_WCWL')) {

		/* VC woocommerce my wishlist */
		vc_map( array(
				"name" => esc_html__("Wishlist", 'shopme'),
				"base" => "vc_mad_yith_wcwl_wishlist",
				"icon" => 'icon-wpb-mad-woocommerce',
				"category" => esc_html__('WooCommerce', 'shopme'),
				"params" => array(
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Pagination', 'shopme' ),
						'param_name' => 'pagination',
						'value' => array(
							esc_html__( 'No', 'shopme' ) => 'no',
							esc_html__( 'Yes', 'shopme' ) => 'yes'
						),
						'description' => esc_html__( 'Should a pagination be displayed?', 'shopme' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Count Items', 'shopme' ),
						'param_name' => 'per_page',
						'value' => SHOPME_VC_CONFIG::array_number(1, 51, 1, array('All' => '-1')),
						'std' => -1,
						'dependency' => array(
							'element' => 'pagination',
							'value' => array('yes')
						),
						'description' => esc_html__( 'A number of products on one page', 'shopme' ),
					)
				)
			)
		);

	}

}

/* Contact Information
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Contact Information', 'shopme' ),
	'base' => 'vc_mad_contact_info',
	'icon' => 'icon-wpb-map-pin',
	'category' => esc_html__( 'Content', 'shopme' ),
	'description' => esc_html__( 'Map block', 'shopme' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'shopme' ),
			'param_name' => 'title',
			'admin_label' => true,
			'description' => __( 'Enter text which will be used as title. Leave blank if no title is needed.', 'shopme' )
		),
		array(
			'type' => 'textarea_safe',
			'heading' => esc_html__( 'Map embed iframe', 'shopme' ),
			'param_name' => 'link',
			'group' => esc_html__( 'Map', 'shopme' ),
			'description' => sprintf( wp_kses(__( 'Visit %s to create your map. 1) Find location 2) Click "Share" and make sure map is public on the web 3) Click folder icon to reveal "Embed on my site" link 4) Copy iframe code and paste it here.', 'shopme' ), array('a' => array('href' => array(), 'target' => array()))), '<a href="https://mapsengine.google.com/" target="_blank">'. esc_html__('Google maps', 'shopme') .'</a>' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Map width', 'shopme' ),
			'param_name' => 'width',
			'admin_label' => true,
			'group' => esc_html__( 'Map', 'shopme' ),
			'description' => esc_html__( 'Enter map width in pixels. Example: 200 or leave it empty to make map responsive.', 'shopme' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Map height', 'shopme' ),
			'param_name' => 'height',
			'admin_label' => true,
			'group' => esc_html__( 'Map', 'shopme' ),
			'description' => esc_html__( 'Enter map height in pixels. Example: 200 or leave it empty to make map responsive.', 'shopme' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Map type', 'shopme' ),
			'param_name' => 'type',
			'value' => array( esc_html__( 'Map', 'shopme' ) => 'm', esc_html__( 'Satellite', 'shopme' ) => 'k', esc_html__( 'Map + Terrain', 'shopme' ) => "p" ),
			'description' => esc_html__( 'Select map type.', 'shopme' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Map Zoom', 'shopme' ),
			'param_name' => 'zoom',
			'group' => esc_html__( 'Map', 'shopme' ),
			'value' => array( esc_html__( '14 - Default', 'shopme' ) => 14, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 15, 16, 17, 18, 19, 20)
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Remove info bubble', 'shopme' ),
			'param_name' => 'bubble',
			'description' => __( 'If selected, information bubble will be hidden.', 'shopme' ),
			'group' => __( 'Map', 'shopme' ),
			'value' => array( __( 'Yes, please', 'shopme' ) => true),
		),
		array(
			'type' => 'textarea',
			'heading' => esc_html__( 'Text', 'shopme' ),
			'param_name' => 'text',
			'value'=> '',
			'group' => esc_html__( 'Text', 'shopme' ),
			'description' => esc_html__( 'Enter your text content.', 'shopme' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Location', 'shopme' ),
			'param_name' => 'info_location',
			'admin_label' => true,
			'group' => esc_html__( 'Information', 'shopme' ),
			'description' => esc_html__( 'Enter address.', 'shopme' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Phone', 'shopme' ),
			'param_name' => 'info_phone',
			'admin_label' => true,
			'group' => esc_html__( 'Information', 'shopme' ),
			'description' => esc_html__( 'Enter phone.', 'shopme' )
		),
		array(
			"type" => "vc_link",
			"param_name" => "info_mail",
			"heading" => esc_html__( 'Enter email.', 'shopme' ),
			'admin_label' => true,
			'group' => esc_html__( 'Information', 'shopme' ),
			'description' => esc_html__( 'Enter email.', 'shopme' )
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => esc_html__( 'Schedule', 'shopme' ),
			'param_name' => 'content',
			'admin_label' => true,
			'group' => esc_html__( 'Information', 'shopme' ),
			'description' => esc_html__( 'Enter schedule.', 'shopme' )
		),

	)
) );


/* Google maps element
---------------------------------------------------------- */
vc_map( array(
	'name' => esc_html__( 'Google Maps', 'shopme' ),
	'base' => 'vc_mad_gmaps',
	'icon' => 'icon-wpb-map-pin',
	'category' => esc_html__( 'Content', 'shopme' ),
	'description' => esc_html__( 'Map block', 'shopme' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'shopme' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'shopme' )
		),
		array(
			'type' => 'textarea_safe',
			'heading' => esc_html__( 'Map embed iframe', 'shopme' ),
			'param_name' => 'link',
			'description' => sprintf( wp_kses(__( 'Visit %s to create your map. 1) Find location 2) Click "Share" and make sure map is public on the web 3) Click folder icon to reveal "Embed on my site" link 4) Copy iframe code and paste it here.', 'shopme' ), array('a' => array('href' => array(), 'target' => array()))), '<a href="https://mapsengine.google.com/" target="_blank">'. esc_html__('Google maps', 'shopme') .'</a>' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Map align', 'shopme' ),
			'param_name' => 'align',
			'value' => array(
				esc_html__( 'None', 'shopme' ) => '',
				esc_html__( 'Left', 'shopme' ) => 'alignleft',
				esc_html__( 'Right', 'shopme' ) => 'alignright'
			),
			'description' => esc_html__( 'Choose the alignment of your map here', 'shopme' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Map width', 'shopme' ),
			'param_name' => 'width',
			'admin_label' => true,
			'description' => esc_html__( 'Enter map width in pixels. Example: 200 or leave it empty to make map responsive.', 'shopme' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Map height', 'shopme' ),
			'param_name' => 'height',
			'admin_label' => true,
			'description' => esc_html__( 'Enter map height in pixels. Example: 200 or leave it empty to make map responsive.', 'shopme' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Map type', 'shopme' ),
			'param_name' => 'type',
			'value' => array( esc_html__( 'Map', 'shopme' ) => 'm', esc_html__( 'Satellite', 'shopme' ) => 'k', esc_html__( 'Map + Terrain', 'shopme' ) => "p" ),
			'description' => esc_html__( 'Select map type.', 'shopme' )
  		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Map Zoom', 'shopme' ),
			'param_name' => 'zoom',
			'value' => array( esc_html__( '14 - Default', 'shopme' ) => 14, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 15, 16, 17, 18, 19, 20)
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Remove info bubble', 'shopme' ),
			'param_name' => 'bubble',
			'description' => esc_html__( 'If selected, information bubble will be hidden.', 'shopme' ),
			'value' => array( esc_html__( 'Yes, please', 'shopme' ) => true),
		)
	)
) );



/* Dropcap
---------------------------------------------------------- */
vc_map( array(
	'name' => esc_html__( 'Dropcap', 'shopme' ),
	'base' => 'vc_mad_dropcap',
	'icon' => 'icon-wpb-mad-dropcap',
	'category' => esc_html__( 'Content', 'shopme' ),
	'description' => esc_html__( 'Dropcap', 'shopme' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type', 'shopme' ),
			'param_name' => 'type',
			'value' => array(
				esc_html__('Type 1', 'shopme') => 'type_1',
				esc_html__('Type 2', 'shopme') => 'type_2'
			),
			'description' => esc_html__('Choose the first letter style.', 'shopme')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Letter', 'shopme' ),
			'param_name' => 'letter',
			'admin_label' => true,
			'description' => ''
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => esc_html__( 'Text', 'shopme' ),
			'param_name' => 'content',
			'value' => wp_kses(__( '<p>Click edit button to change this text.</p>', 'shopme' ), array('p' => array()) )
		),
	)
));


/*** Visual Composer Content elements refresh ***/
class shopmeVcSharedLibrary {
	// Here we will store plugin wise (shared) settings. Colors, Locations, Sizes, etc...
	/**
	 * @var array
	 */
	private static $colors = array(
		'Blue' => 'blue',
		'Turquoise' => 'turquoise',
		'Pink' => 'pink',
		'Violet' => 'violet',
		'Peacoc' => 'peacoc',
		'Chino' => 'chino',
		'Mulled Wine' => 'mulled_wine',
		'Vista Blue' => 'vista_blue',
		'Black' => 'black',
		'Grey' => 'grey',
		'Orange' => 'orange',
		'Sky' => 'sky',
		'Green' => 'green',
		'Juicy pink' => 'juicy_pink',
		'Sandy brown' => 'sandy_brown',
		'Purple' => 'purple',
		'White' => 'white'
	);

	/**
	 * @var array
	 */
	public static $icons = array(
		'Glass' => 'glass',
		'Music' => 'music',
		'Search' => 'search'
	);

	/**
	 * @var array
	 */
	public static $sizes = array(
		'Mini' => 'xs',
		'Small' => 'sm',
		'Normal' => 'md',
		'Large' => 'lg'
	);

	/**
	 * @var array
	 */
	public static $button_styles = array(
		'Rounded' => 'rounded',
		'Square' => 'square',
		'Round' => 'round',
		'Outlined' => 'outlined',
		'3D' => '3d',
		'Square Outlined' => 'square_outlined'
	);

	/**
	 * @var array
	 */
	public static $message_box_styles = array(
		'Standard' => 'standard',
		'Solid' => 'solid',
		'Solid icon' => 'solid-icon',
		'Outline' => 'outline',
		'3D' => '3d',
	);

	/**
	 * Toggle styles
	 * @var array
	 */
	public static $toggle_styles = array(
		'Default' => 'default',
		'Simple' => 'simple',
		'Round' => 'round',
		'Round Outline' => 'round_outline',
		'Rounded' => 'rounded',
		'Rounded Outline' => 'rounded_outline',
		'Square' => 'square',
		'Square Outline' => 'square_outline',
		'Arrow' => 'arrow',
		'Text Only' => 'text_only',
	);

	/**
	 * Animation styles
	 * @var array
	 */
	public static $animation_styles = array(
		'Bounce' => 'easeOutBounce',
		'Elastic' => 'easeOutElastic',
		'Back' => 'easeOutBack',
		'Cubic' => 'easeinOutCubic',
		'Quint' => 'easeinOutQuint',
		'Quart' => 'easeOutQuart',
		'Quad' => 'easeinQuad',
		'Sine' => 'easeOutSine'
	);

	/**
	 * @var array
	 */
	public static $cta_styles = array(
		'Rounded' => 'rounded',
		'Square' => 'square',
		'Round' => 'round',
		'Outlined' => 'outlined',
		'Square Outlined' => 'square_outlined'
	);

	/**
	 * @var array
	 */
	public static $txt_align = array(
		'Left' => 'left',
		'Right' => 'right',
		'Center' => 'center',
		'Justify' => 'justify'
	);

	/**
	 * @var array
	 */
	public static $el_widths = array(
		'100%' => '',
		'90%' => '90',
		'80%' => '80',
		'70%' => '70',
		'60%' => '60',
		'50%' => '50'
	);

	/**
	 * @var array
	 */
	public static $sep_widths = array(
		'1px' => '',
		'2px' => '2',
		'3px' => '3',
		'4px' => '4',
		'5px' => '5',
		'6px' => '6',
		'7px' => '7',
		'8px' => '8',
		'9px' => '9',
		'10px' => '10'
	);

	/**
	 * @var array
	 */
	public static $sep_styles = array(
		'Border' => '',
		'Dashed' => 'dashed',
		'Dotted' => 'dotted',
		'Double' => 'double'
	);

	/**
	 * @var array
	 */
	public static $box_styles = array(
		'Default' => '',
		'Rounded' => 'vc_box_rounded',
		'Border' => 'vc_box_border',
		'Outline' => 'vc_box_outline',
		'Shadow' => 'vc_box_shadow',
		'Bordered shadow' => 'vc_box_shadow_border',
		'3D Shadow' => 'vc_box_shadow_3d',
		'Round' => 'vc_box_circle', //new
		'Round Border' => 'vc_box_border_circle', //new
		'Round Outline' => 'vc_box_outline_circle', //new
		'Round Shadow' => 'vc_box_shadow_circle', //new
		'Round Border Shadow' => 'vc_box_shadow_border_circle', //new
		'Circle' => 'vc_box_circle_2', //new
		'Circle Border' => 'vc_box_border_circle_2', //new
		'Circle Outline' => 'vc_box_outline_circle_2', //new
		'Circle Shadow' => 'vc_box_shadow_circle_2', //new
		'Circle Border Shadow' => 'vc_box_shadow_border_circle_2' //new
	);

	/**
	 * @return array
	 */
	public static function getColors() {
		return self::$colors;
	}

	/**
	 * @return array
	 */
	public static function getIcons() {
		return self::$icons;
	}

	/**
	 * @return array
	 */
	public static function getSizes() {
		return self::$sizes;
	}

	/**
	 * @return array
	 */
	public static function getButtonStyles() {
		return self::$button_styles;
	}

	/**
	 * @return array
	 */
	public static function getMessageBoxStyles() {
		return self::$message_box_styles;
	}

	/**
	 * @return array
	 */
	public static function getToggleStyles() {
		return self::$toggle_styles;
	}

	/**
	 * @return array
	 */
	public static function getAnimationStyles() {
		return self::$animation_styles;
	}

	/**
	 * @return array
	 */
	public static function getCtaStyles() {
		return self::$cta_styles;
	}

	/**
	 * @return array
	 */
	public static function getTextAlign() {
		return self::$txt_align;
	}

	/**
	 * @return array
	 */
	public static function getBorderWidths() {
		return self::$sep_widths;
	}

	/**
	 * @return array
	 */
	public static function getElementWidths() {
		return self::$el_widths;
	}

	/**
	 * @return array
	 */
	public static function getSeparatorStyles() {
		return self::$sep_styles;
	}

	/**
	 * @return array
	 */
	public static function getBoxStyles() {
		return self::$box_styles;
	}

	public static function getColorsDashed() {
		$colors = array(
			esc_html__( 'Blue', 'shopme' ) => 'blue',
			esc_html__( 'Turquoise', 'shopme' ) => 'turquoise',
			esc_html__( 'Pink', 'shopme' ) => 'pink',
			esc_html__( 'Violet', 'shopme' ) => 'violet',
			esc_html__( 'Peacoc', 'shopme' ) => 'peacoc',
			esc_html__( 'Chino', 'shopme' ) => 'chino',
			esc_html__( 'Mulled Wine', 'shopme' ) => 'mulled-wine',
			esc_html__( 'Vista Blue', 'shopme' ) => 'vista-blue',
			esc_html__( 'Black', 'shopme' ) => 'black',
			esc_html__( 'Grey', 'shopme' ) => 'grey',
			esc_html__( 'Orange', 'shopme' ) => 'orange',
			esc_html__( 'Sky', 'shopme' ) => 'sky',
			esc_html__( 'Green', 'shopme' ) => 'green',
			esc_html__( 'Juicy pink', 'shopme' ) => 'juicy-pink',
			esc_html__( 'Sandy brown', 'shopme' ) => 'sandy-brown',
			esc_html__( 'Purple', 'shopme' ) => 'purple',
			esc_html__( 'White', 'shopme' ) => 'white'
		);

		return $colors;
	}
}

/**
 * @param string $asset
 *
 * @return array
 */
function shopmegetVcShared( $asset = '' ) {
	switch ( $asset ) {
		case 'colors':
			return shopmeVcSharedLibrary::getColors();
			break;

		case 'colors-dashed':
			return shopmeVcSharedLibrary::getColorsDashed();
			break;

		case 'icons':
			return shopmeVcSharedLibrary::getIcons();
			break;

		case 'sizes':
			return shopmeVcSharedLibrary::getSizes();
			break;

		case 'button styles':
		case 'alert styles':
			return shopmeVcSharedLibrary::getButtonStyles();
			break;
		case 'message_box_styles':
			return shopmeVcSharedLibrary::getMessageBoxStyles();
			break;
		case 'cta styles':
			return shopmeVcSharedLibrary::getCtaStyles();
			break;

		case 'text align':
			return shopmeVcSharedLibrary::getTextAlign();
			break;

		case 'cta widths':
		case 'separator widths':
			return shopmeVcSharedLibrary::getElementWidths();
			break;

		case 'separator styles':
			return shopmeVcSharedLibrary::getSeparatorStyles();
			break;

		case 'separator border widths':
			return shopmeVcSharedLibrary::getBorderWidths();
			break;

		case 'single image styles':
			return shopmeVcSharedLibrary::getBoxStyles();
			break;

		case 'toggle styles':
			return shopmeVcSharedLibrary::getToggleStyles();
			break;

		case 'animation styles':
			return shopmeVcSharedLibrary::getAnimationStyles();
			break;

		default:
			# code...
			break;
	}

	return '';
}