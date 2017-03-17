<?php

vc_map( array(
	'name' => esc_html__( 'Tabs', 'shopme' ),
	'base' => 'vc_tta_tabs',
	'icon' => 'icon-wpb-ui-tab-content',
	'is_container' => true,
	'show_settings_on_create' => false,
	'as_parent' => array(
		'only' => 'vc_tta_section'
	),
	'category' => esc_html__( 'Content', 'shopme' ),
	'description' => esc_html__( 'Tabbed content', 'shopme' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'param_name' => 'title',
			'heading' => esc_html__( 'Widget title', 'shopme' ),
			'description' => esc_html__( 'Enter text used as widget title (Note: located above content element).', 'shopme' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'style',
			'value' => array(
				esc_html__( 'Default', 'shopme' ) => 'default',
				esc_html__( 'Classic', 'shopme' ) => 'classic',
				esc_html__( 'Modern', 'shopme' ) => 'modern',
				esc_html__( 'Flat', 'shopme' ) => 'flat',
				esc_html__( 'Outline', 'shopme' ) => 'outline',
			),
			'heading' => esc_html__( 'Style', 'shopme' ),
			'description' => esc_html__( 'Select tabs display style.', 'shopme' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'shape',
			'value' => array(
				esc_html__( 'Rounded', 'shopme' ) => 'rounded',
				esc_html__( 'Square', 'shopme' ) => 'square',
				esc_html__( 'Round', 'shopme' ) => 'round',
			),
			'heading' => esc_html__( 'Shape', 'shopme' ),
			'description' => esc_html__( 'Select tabs shape.', 'shopme' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'color',
			'heading' => esc_html__( 'Color', 'shopme' ),
			'description' => esc_html__( 'Select tabs color.', 'shopme' ),
			'value' => shopmegetVcShared( 'colors-dashed' ),
			'std' => 'grey',
			'param_holder_class' => 'vc_colored-dropdown',
		),
		array(
			'type' => 'checkbox',
			'param_name' => 'no_fill_content_area',
			'heading' => esc_html__( 'Do not fill content area?', 'shopme' ),
			'description' => esc_html__( 'Do not fill content area with color.', 'shopme' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'spacing',
			'value' => array(
				esc_html__( 'None', 'shopme' ) => '',
				esc_html__( '1px', 'shopme' ) => '1',
				esc_html__( '2px', 'shopme' ) => '2',
				esc_html__( '3px', 'shopme' ) => '3',
				esc_html__( '4px', 'shopme' ) => '4',
				esc_html__( '5px', 'shopme' ) => '5',
				esc_html__( '10px', 'shopme' ) => '10',
				esc_html__( '15px', 'shopme' ) => '15',
				esc_html__( '20px', 'shopme' ) => '20',
				esc_html__( '25px', 'shopme' ) => '25',
				esc_html__( '30px', 'shopme' ) => '30',
				esc_html__( '35px', 'shopme' ) => '35',
			),
			'heading' => esc_html__( 'Spacing', 'shopme' ),
			'description' => esc_html__( 'Select tabs spacing.', 'shopme' ),
			'std' => '1'
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'gap',
			'value' => array(
				esc_html__( 'None', 'shopme' ) => '',
				esc_html__( '1px', 'shopme' ) => '1',
				esc_html__( '2px', 'shopme' ) => '2',
				esc_html__( '3px', 'shopme' ) => '3',
				esc_html__( '4px', 'shopme' ) => '4',
				esc_html__( '5px', 'shopme' ) => '5',
				esc_html__( '10px', 'shopme' ) => '10',
				esc_html__( '15px', 'shopme' ) => '15',
				esc_html__( '20px', 'shopme' ) => '20',
				esc_html__( '25px', 'shopme' ) => '25',
				esc_html__( '30px', 'shopme' ) => '30',
				esc_html__( '35px', 'shopme' ) => '35',
			),
			'heading' => esc_html__( 'Gap', 'shopme' ),
			'description' => esc_html__( 'Select tabs gap.', 'shopme' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'tab_position',
			'value' => array(
				esc_html__( 'Top', 'shopme' ) => 'top',
				esc_html__( 'Bottom', 'shopme' ) => 'bottom',
			),
			'heading' => esc_html__( 'Position', 'shopme' ),
			'description' => esc_html__( 'Select tabs navigation position.', 'shopme' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'alignment',
			'value' => array(
				esc_html__( 'Left', 'shopme' ) => 'left',
				esc_html__( 'Right', 'shopme' ) => 'right',
				esc_html__( 'Center', 'shopme' ) => 'center',
			),
			'heading' => esc_html__( 'Alignment', 'shopme' ),
			'description' => esc_html__( 'Select tabs section title alignment.', 'shopme' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'autoplay',
			'value' => array(
				esc_html__( 'None', 'shopme' ) => 'none',
				esc_html__( '1', 'shopme' ) => '1',
				esc_html__( '2', 'shopme' ) => '2',
				esc_html__( '3', 'shopme' ) => '3',
				esc_html__( '4', 'shopme' ) => '4',
				esc_html__( '5', 'shopme' ) => '5',
				esc_html__( '10', 'shopme' ) => '10',
				esc_html__( '20', 'shopme' ) => '20',
				esc_html__( '30', 'shopme' ) => '30',
				esc_html__( '40', 'shopme' ) => '40',
				esc_html__( '50', 'shopme' ) => '50',
				esc_html__( '60', 'shopme' ) => '60',
			),
			'std' => 'none',
			'heading' => esc_html__( 'Autoplay', 'shopme' ),
			'description' => esc_html__( 'Select auto rotate for tabs in seconds (Note: disabled by default).', 'shopme' ),
		),
		array(
			'type' => 'textfield',
			'param_name' => 'active_section',
			'heading' => esc_html__( 'Active section', 'shopme' ),
			'value' => 1,
			'description' => esc_html__( 'Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'shopme' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'pagination_style',
			'value' => array(
				esc_html__( 'None', 'shopme' ) => '',
				esc_html__( 'Square Dots', 'shopme' ) => 'outline-square',
				esc_html__( 'Radio Dots', 'shopme' ) => 'outline-round',
				esc_html__( 'Point Dots', 'shopme' ) => 'flat-round',
				esc_html__( 'Fill Square Dots', 'shopme' ) => 'flat-square',
				esc_html__( 'Rounded Fill Square Dots', 'shopme' ) => 'flat-rounded',
			),
			'heading' => esc_html__( 'Pagination style', 'shopme' ),
			'description' => esc_html__( 'Select pagination style.', 'shopme' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'pagination_color',
			'value' => shopmegetVcShared( 'colors-dashed' ),
			'heading' => esc_html__( 'Pagination color', 'shopme' ),
			'description' => esc_html__( 'Select pagination color.', 'shopme' ),
			'param_holder_class' => 'vc_colored-dropdown',
			'std' => 'grey',
			'dependency' => array(
				'element' => 'pagination_style',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'shopme' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'shopme' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', 'shopme' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design Options', 'shopme' )
		)
	),
	'js_view' => 'VcBackendTtaTabsView',
	'custom_markup' => '
<div class="vc_tta-container" data-vc-action="collapse">
	<div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
		<div class="vc_tta-tabs-container">'
		. '<ul class="vc_tta-tabs-list">'
		. '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="vc_tta_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">{{ section_title }}</span></a></li>'
		. '</ul>
		</div>
		<div class="vc_tta-panels vc_clearfix {{container-class}}">
		  {{ content }}
		</div>
	</div>
</div>',
	'default_content' => '
[vc_tta_section title="' . sprintf( "%s %d", esc_html__( 'Tab', 'shopme' ), 1 ) . '"][/vc_tta_section]
[vc_tta_section title="' . sprintf( "%s %d", esc_html__( 'Tab', 'shopme' ), 2 ) . '"][/vc_tta_section]
	',
	'admin_enqueue_js' => array(
		vc_asset_url( 'lib/vc_accordion/vc-accordion.js' ),
		vc_asset_url( 'lib/vc_tabs/vc-tabs.js' ),
	),
) );