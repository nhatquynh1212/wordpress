<?php

vc_map( array(
	'name' => esc_html__( 'Accordion', 'shopme' ),
	'base' => 'vc_tta_accordion',
	'icon' => 'icon-wpb-ui-accordion',
	'is_container' => true,
	'show_settings_on_create' => false,
	'as_parent' => array(
		'only' => 'vc_tta_section'
	),
	'category' => esc_html__( 'Content', 'shopme' ),
	'description' => esc_html__( 'Collapsible content panels', 'shopme' ),
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
			'description' => esc_html__( 'Select accordion display style.', 'shopme' ),
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
			'description' => esc_html__( 'Select accordion shape.', 'shopme' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'color',
			'value' => shopmegetVcShared( 'colors-dashed' ),
			'std' => 'grey',
			'heading' => esc_html__( 'Color', 'shopme' ),
			'description' => esc_html__( 'Select accordion color.', 'shopme' ),
			'param_holder_class' => 'vc_colored-dropdown',
		),
		array(
			'type' => 'checkbox',
			'param_name' => 'no_fill',
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
			'description' => esc_html__( 'Select accordion spacing.', 'shopme' ),
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
			'description' => esc_html__( 'Select accordion gap.', 'shopme' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'c_align',
			'value' => array(
				esc_html__( 'Left', 'shopme' ) => 'left',
				esc_html__( 'Right', 'shopme' ) => 'right',
				esc_html__( 'Center', 'shopme' ) => 'center',
			),
			'heading' => esc_html__( 'Alignment', 'shopme' ),
			'description' => esc_html__( 'Select accordion section title alignment.', 'shopme' ),
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
			'description' => esc_html__( 'Select auto rotate for accordion in seconds (Note: disabled by default).', 'shopme' ),
		),
		array(
			'type' => 'checkbox',
			'param_name' => 'collapsible_all',
			'heading' => esc_html__( 'Allow collapse all?', 'shopme' ),
			'description' => esc_html__( 'Allow collapse all accordion sections.', 'shopme' ),
		),
		// Control Icons
		array(
			'type' => 'dropdown',
			'param_name' => 'c_icon',
			'value' => array(
				esc_html__( 'None', 'shopme' ) => '',
				esc_html__( 'Chevron', 'shopme' ) => 'chevron',
				esc_html__( 'Plus', 'shopme' ) => 'plus',
				esc_html__( 'Triangle', 'shopme' ) => 'triangle',
			),
			'std' => 'plus',
			'heading' => esc_html__( 'Icon', 'shopme' ),
			'description' => esc_html__( 'Select accordion navigation icon.', 'shopme' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'c_position',
			'value' => array(
				esc_html__( 'Left', 'shopme' ) => 'left',
				esc_html__( 'Right', 'shopme' ) => 'right',
			),
			'dependency' => array(
				'element' => 'c_icon',
				'not_empty' => true,
			),
			'heading' => esc_html__( 'Position', 'shopme' ),
			'description' => esc_html__( 'Select accordion navigation icon position.', 'shopme' ),
		),
		// Control Icons END
		array(
			'type' => 'textfield',
			'param_name' => 'active_section',
			'heading' => esc_html__( 'Active section', 'shopme' ),
			'value' => 1,
			'description' => esc_html__( 'Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'shopme' ),
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
	'js_view' => 'VcBackendTtaAccordionView',
	'custom_markup' => '
<div class="vc_tta-container" data-vc-action="collapseAll">
	<div class="vc_general vc_tta vc_tta-accordion vc_tta-color-backend-accordion-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-o-shape-group vc_tta-controls-align-left vc_tta-gap-2">
	   <div class="vc_tta-panels vc_clearfix {{container-class}}">
	      {{ content }}
	      <div class="vc_tta-panel vc_tta-section-append">
	         <div class="vc_tta-panel-heading">
	            <h4 class="vc_tta-panel-title vc_tta-controls-icon-position-left">
	               <a href="javascript:;" aria-expanded="false" class="vc_tta-backend-add-control">
	                   <span class="vc_tta-title-text">' . esc_html__( 'Add Section', 'shopme' ) . '</span>
	                    <i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i>
					</a>
	            </h4>
	         </div>
	      </div>
	   </div>
	</div>
</div>',
	'default_content' => '
[vc_tta_section title="' . sprintf( "%s %d", esc_html__( 'Section', 'shopme' ), 1 ) . '"][/vc_tta_section]
[vc_tta_section title="' . sprintf( "%s %d", esc_html__( 'Section', 'shopme' ), 2 ) . '"][/vc_tta_section]
	',
	'admin_enqueue_js' => vc_asset_url( 'lib/vc_accordion/vc-accordion.js' ),
) );
