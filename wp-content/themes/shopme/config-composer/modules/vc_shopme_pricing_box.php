<?php
if (!class_exists('shopme_pricing_box')) {

	class shopme_pricing_box {

		function __construct() {
			add_action('init', array($this, 'add_map_pricing_box'));
			add_shortcode( 'vc_mad_pricing_box', array($this, 'pricing_box') );
			add_shortcode( 'vc_mad_pricing_box_item', array($this, 'pricing_box_item') );
		}
		
		function add_map_pricing_box() {

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
					   "name" => esc_html__("Pricing Box", 'shopme' ),
					   "base" => "vc_mad_pricing_box",
					   "class" => "vc_mad_pricing_box",
					   "icon" => "icon-wpb-mad-pricing-box",
					   "category"  => esc_html__('Content', 'shopme'),
					   "description" => esc_html__('Styled pricing tables', 'shopme'),
					   "as_parent" => array('only' => 'vc_mad_pricing_box_item'),
					   "content_element" => true,
					   "show_settings_on_create" => true,
					   "params" => array(
						   	array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Title', 'shopme' ),
								'param_name' => 'title',
								'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'shopme' )
							),
							$add_css_animation,
							$add_animation_delay
						),
						"js_view" => 'VcColumnView'
					));

				vc_map(
					array(
					   "name" => esc_html__("Pricing Box Item", 'shopme'),
					   "base" => "vc_mad_pricing_box_item",
					   "class" => "vc_mad_pricing_box_item",
					   "icon" => "icon-wpb-mad-pricing-box",
					   "category" => esc_html__('Pricing Box', 'shopme'),
					   "content_element" => true,
					   "as_child" => array('only' => 'vc_mad_info_block'),
					   "is_container" => false,
					   "params" => array(
						   array(
							   "type" => "textfield",
							   "heading" => esc_html__( 'Package Name / Title', 'shopme' ),
							   "param_name" => "title",
							   "holder" => "h4",
							   "description" => esc_html__( 'Enter the package name or table heading.', 'shopme' ),
							   "value" => esc_html__( 'Free', 'shopme' ),
						   ),
						   array(
							   "type" => "textfield",
							   "heading" => esc_html__( 'Currency', 'shopme' ),
							   "param_name" => "currency",
							   "holder" => "span",
							   "description" => esc_html__( 'Enter currency symbol or text, e.g., $ or USD.', 'shopme' ),
							   "value" => '$'
						   ),
						   array(
							   "type" => "textfield",
							   "heading" => esc_html__( 'Package Price', 'shopme' ),
							   "param_name" => "price",
							   "holder" => "span",
							   "description" => esc_html__( 'Enter the price for this package', 'shopme' ),
							   "value" => '15'
						   ),
						   array(
							   "type" => "textfield",
							   "heading" => esc_html__( 'Price Unit', 'shopme' ),
							   "param_name" => "time",
							   "holder" => "span",
							   "description" => esc_html__( 'Enter the price unit for this package. e.g. per month', 'shopme' ),
							   "value" => esc_html__( 'per month', 'shopme' )
						   ),
						   array(
							   "type" => "textarea_html",
							   "heading" => esc_html__( 'Features', 'shopme' ),
							   "param_name" => "features",
							   "holder" => "span",
							   "description" => esc_html__( 'Create the features list using un-ordered list elements. Divide values with linebreaks (Enter). Example: Up to 50 users|Limited team members', 'shopme' ),
							   "value" => esc_html__( 'Up to 50 users | Limited team members | Limited disk space | Custom Domain | PayPal Integration', 'shopme' )
						   ),
						   array(
							   "type" => "vc_link",
							   "heading" => esc_html__( 'Add URL to the whole box (optional)', 'shopme' ),
							   "param_name" => "link",
						   ),
						   array(
							   "type" => "colorpicker",
							   "heading" => esc_html__( 'Header color', 'shopme' ),
							   "param_name" => "header_color",
							   "value" => "#018bc8",
							   "description" => esc_html__( 'Set color for pricing box header.', 'shopme' ),
							   "group" => esc_html__('Design', 'shopme')
						   ),
						   array(
								"type" => "dropdown",
								"heading" => esc_html__( 'Add label?', 'shopme' ),
								"param_name" => "add_label",
							    "group" => esc_html__('Label', 'shopme'),
								"value" => array(
									esc_html__('Yes', 'shopme') => 'yes',
									esc_html__('No', 'shopme') => 'no',
								),
							   "std" => 'no',
								"description" => esc_html__( 'Adds a nice label to your pricing box.', 'shopme' )
						   ),
						   array(
							   "type" => "textfield",
							   "heading" => esc_html__( 'Text for label', 'shopme' ),
							   "param_name" => "text_label",
							   "holder" => "span",
							   "group" => esc_html__('Label', 'shopme'),
							   "dependency" => array(
								   'element' => "add_label",
								   'value' => array('yes')
							   ),
							   "description" => esc_html__( 'Enter text form label, e.g., featured or popular.', 'shopme' ),
							   "value" => esc_html__( 'popular', 'shopme' )
						   ),
						   array(
							   "type" => "colorpicker",
							   "heading" => esc_html__( 'Background color label', 'shopme' ),
							   "param_name" => "bg_color_label",
							   "value" => "#ff8400",
							   "description" => esc_html__( 'Set background color for label.', 'shopme' ),
							   "dependency" => array(
								   'element' => "add_label",
								   'value' => array('yes')
							   ),
							   "group" => esc_html__('Label', 'shopme')
						   )
					    )
					) 
				);							

			}
		}

		function pricing_box($atts, $content = null) {

			$attr = array();
			$title = $animation_class = $css_animation = $animation_delay = '';

			extract(shortcode_atts(array(
				'title' => '',
				'css_animation' => '',
				'animation_delay' => ''
			), $atts));

			if ($css_animation != '') {
				$attr['animation'] = $css_animation;
				$animation_class = $this->getExtraClass('animated');
				if (!empty($animation_delay)) {
					$attr['animation-delay'] = $animation_delay;
				}
			}

			$css_class = 'pricing_tables_container ' . $animation_class;

			ob_start(); ?>

			<?php if (!empty($title)): ?>
				<?php echo $this->wpb_widget_title( array( 'title' => $title ) ); ?>
			<?php endif; ?>

			<div <?php echo esc_attr($this->create_data_string($attr)); ?> class="<?php echo esc_attr($css_class); ?>">
				<?php echo wpb_js_remove_wpautop($content, false) ?>
			</div><!--/ .pricing_tables_container-->

			<?php return ob_get_clean() ;
		}

		function pricing_box_item ($atts, $content = null) {

			$title = $currency = $price = $time = $features = $header_color = $add_label = $text_label = $bg_color_label = $link = "";

			extract(shortcode_atts(array(
				'title' => 'Free',
				'currency' => '$',
				'price' => '15',
				'time' => 'per month',
				'features' => 'Up to 50 users | Limited team members | Limited disk space | Custom Domain | PayPal Integration | Basecamp Integration',
				'link' => '',
				'header_color' => '#018bc8',
				'add_label' => 'no',
				'text_label' => 'popular',
				'bg_color_label' => '#ff8400'
			),$atts));

			$header_color = "style='color: {$header_color};'";
			$bg_color_label = "style='background-color: {$bg_color_label};'";

			$link = ($link == '||') ? '' : $link;
			$link = vc_build_link($link);
			$a_href = $link['url'];
			$a_title = $link['title'];
			($link['target'] != '') ? $a_target = $link['target'] : $a_target = '_self';

			ob_start(); ?>

			<div class="pricing_table">

				<header <?php echo $header_color; ?>>
					<?php echo esc_html($title); ?>

					<?php if ($add_label == 'yes'): ?>
						<div <?php echo $bg_color_label; ?> class="pricing_table_label"><?php echo esc_html($text_label) ?></div>
					<?php endif; ?>
				</header>

				<div <?php echo $header_color; ?> class="pt_price">
					<div class="price"><?php echo esc_html($currency . $price); ?></div>
					<?php echo esc_html($time); ?>
				</div>

				<ul class="pt_list">
					<?php if ($features != ''):
						$features = explode('|', $features);
						$feature_list = '';
						if (is_array($features)) {
							foreach ($features as $feature) {
								$feature_list .= "<li>{$feature}</li>";
							}
						}
					?>
					<?php echo $feature_list; ?>

					<?php endif; ?>
				</ul>

				<?php if (!empty($a_title)): ?>
					<footer>
						<a href="<?php echo esc_url($a_href); ?>" title="<?php echo esc_attr($a_title) ?>" target="<?php echo esc_attr($a_target) ?>" class="button_blue middle_btn"><?php echo esc_html($a_title); ?></a>
					</footer>
				<?php endif; ?>

			</div>

			<?php return ob_get_clean() ;
		}

		function wpb_widget_title( $params = array( 'title' => '' ) ) {
			if ( $params['title'] == '' ) {
				return '';
			}

			$extraclass = ( isset( $params['extraclass'] ) ) ? " " . $params['extraclass'] : "";
			$output = '<h3 class="wpb_heading' . $extraclass . '">' . $params['title'] . '</h3>';

			return apply_filters( 'wpb_widget_title', $output, $params );
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
		class WPBakeryShortCode_vc_mad_pricing_box extends WPBakeryShortCodesContainer {
		}
		class WPBakeryShortCode_vc_mad_pricing_box_item extends WPBakeryShortCode {
		}
	}

	$shopme_pricing_box = new shopme_pricing_box();
}