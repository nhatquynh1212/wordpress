<?php
if (!class_exists('shopme_info_block')) {

	class shopme_info_block {

		function __construct() {
			add_action('init', array($this, 'add_map_infoblock'));
			add_shortcode( 'vc_mad_info_block', array($this, 'info_block' ) );
			add_shortcode( 'vc_mad_info_block_item', array($this, 'info_block_item' ) );
		}
		
		function add_map_infoblock() {

			$add_css_animation = array(
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

			$add_animation_delay = array(
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

			if (function_exists('vc_map')) {

				vc_map(
					array(
					   "name" => esc_html__("Infoblock", 'shopme' ),
					   "base" => "vc_mad_info_block",
					   "class" => "vc_mad_info_block",
					   "icon" => "icon-wpb-mad-info-block",
					   "category"  => esc_html__('Content', 'shopme'),
					   "description" => esc_html__('Styled info blocks', 'shopme'),
					   "as_parent" => array('only' => 'vc_mad_info_block_item'),
					   "content_element" => true,
					   "show_settings_on_create" => false,
					   "params" => array(
							array(
								"type" => "dropdown",
								"heading" => esc_html__( 'Select type', 'shopme' ),
								"param_name" => "type",
								"value" => array(
									esc_html__('Type 1', 'shopme') => 'type_1',
									esc_html__('Type 2', 'shopme') => 'type_2',
									esc_html__('Type 3', 'shopme') => 'type_3',
									esc_html__('Type 4', 'shopme') => 'type_4',
									esc_html__('Type 5', 'shopme') => 'type_5'
								),
								"std" => 'type_1',
								"description" => esc_html__( 'Choose type for this info block.', 'shopme' )
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
							   "dependency" => array(
								   "element" => "type",
								   "value" => array("type_1", "type_2", "type_3", "type_4")
							   ),
							   'std' => 4,
							   'description' => esc_html__( 'How many columns should be displayed?', 'shopme' )
						   ),
							$add_css_animation,
							$add_animation_delay
						),
						"js_view" => 'VcColumnView'
					));

				vc_map(
					array(
					   "name" => esc_html__("Info Block Item", 'shopme'),
					   "base" => "vc_mad_info_block_item",
					   "class" => "vc_mad_info_block_item",
					   "icon" => "icon-wpb-mad-info-block",
					   "category" => esc_html__('Infoblock', 'shopme'),
					   "content_element" => true,
					   "as_child" => array('only' => 'vc_mad_info_block'),
					   "is_container" => false,
					   "params" => array(
						   array(
							   "type" => "textfield",
							   "heading" => esc_html__( 'Title', 'shopme' ),
							   "param_name" => "title",
							   "holder" => "h4",
							   "description" => ''
						   ),
						   array(
							   "type" => "choose_icons",
							   "heading" => esc_html__("Icon", 'shopme'),
							   "param_name" => "icon",
							   "value" => 'none',
							   "description" => esc_html__( 'Select icon from library.', 'shopme')
						   ),
						   array(
							   'type' => 'textarea_html',
							   'holder' => 'div',
							   'heading' => esc_html__( 'Text', 'shopme' ),
							   'param_name' => 'content',
							   'value' => wp_kses(__( '<p>Click edit button to change this text.</p>', 'shopme' ), array('p' => array()) )
						   ),
						   array(
							   "type" => "vc_link",
							   "heading" => esc_html__( 'Add URL to the whole box (optional)', 'shopme' ),
							   "param_name" => "link",
						   ),
					    )
					) 
				);							

			}
		}

		function info_block($atts, $content = null) {

			$attr = array();
			$type = $columns = $columns_class = $animation_class = $css_animation = $animation_delay = '';

			extract(shortcode_atts(array(
				'type' => 'type_1',
				'columns' => 4,
				'css_animation' => '',
				'animation_delay' => ''
			), $atts));

			if ($type != 'type_5') {
				$columns_class = 'infoblock-columns-' . $columns;
			}

			if ($css_animation != '') {
				$attr['animation'] = $css_animation;
				$animation_class = $this->getExtraClass('animated');
				if (!empty($animation_delay)) {
					$attr['animation-delay'] = $animation_delay;
				}
			}
			$type = $this->getExtraClass($type);
			$css_class = 'infoblock ' . $type . ' ' . $animation_class . ' ' . $columns_class;

			ob_start(); ?>

			<section <?php echo esc_attr($this->create_data_string($attr)); ?> class="<?php echo esc_attr($css_class); ?>">
				<?php echo wpb_js_remove_wpautop($content, false) ?>
			</section><!--/ .infoblock-->

			<?php return ob_get_clean() ;
		}

		function info_block_item ($atts, $content = null) {

			$title = $icon = $link = '';

			extract(shortcode_atts(array(
				'title' => '',
				'icon' => '',
				'link' => '',
			),$atts));

			$link = ($link == '||') ? '' : $link;
			$link = vc_build_link($link);
			$a_href = $link['url'];
			$a_title = $link['title'];
			($link['target'] != '') ? $a_target = $link['target'] : $a_target = '_self';

			ob_start(); ?>

			<div class="infoblock-item">
				<div class="infoblock-content">

					<?php if ($icon != ''): ?>
						<?php echo '<i class="'. sanitize_html_class($icon) .'"></i>'; ?>
					<?php endif; ?>

					<?php if (!empty($title)): ?>
						<h4 class="caption"><b><?php echo esc_html($title); ?></b></h4>
					<?php endif; ?>

					<div class="infoblock-text">
						<?php echo wpb_js_remove_wpautop($content, true) ?>
					</div>

					<?php if (!empty($a_href)): ?>
						<a class="button_dark_grey middle_btn" title="<?php echo esc_attr($a_title) ?>" target="<?php echo esc_attr($a_target) ?>" href="<?php echo esc_url($a_href) ?>">
							<?php echo esc_html($a_title) ?>
						</a>
					<?php endif; ?>

				</div><!--/ .infoblock-content-->
			</div><!--/ .infoblock-item-->

			<?php return ob_get_clean() ;
		}

		function getExtraClass( $el_class ) {
			$output = '';
			if ( $el_class != '' ) {
				$output = " " . str_replace( ".", "", $el_class );
			}
			return $output;
		}

		public function create_data_string($data = array()) {
			$data_string = "";

			if (empty($data)) return;

			foreach ($data as $key => $value) {
				if (is_array($value)) $value = implode(", ", $value);
				$data_string .= " data-$key={$value} ";
			}
			return $data_string;
		}

	}

	if (class_exists('WPBakeryShortCodesContainer')) {
		class WPBakeryShortCode_vc_mad_info_block extends WPBakeryShortCodesContainer {
		}
		class WPBakeryShortCode_vc_mad_info_block_item extends WPBakeryShortCode {
		}
	}

	$shopme_info_block = new shopme_info_block();
}