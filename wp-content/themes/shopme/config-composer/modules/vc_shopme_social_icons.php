<?php
if (!class_exists('shopme_social_icons')) {

	class shopme_social_icons {

		function __construct() {
			add_action('init', array($this, 'add_map_social_icons'));
			add_shortcode( 'vc_mad_social_icons', array($this, 'social_icons') );
			add_shortcode( 'vc_mad_social_icons_item', array($this, 'social_icons_item') );
		}
		
		function add_map_social_icons() {

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
					   "name" => esc_html__("Social Icons", 'shopme' ),
					   "base" => "vc_mad_social_icons",
					   "class" => "vc_mad_social_icons",
					   "icon" => "icon-wpb-vc_icon",
					   "category"  => esc_html__('Content', 'shopme'),
					   "description" => esc_html__('Social Icons', 'shopme'),
					   "as_parent" => array('only' => 'vc_mad_social_icons_item'),
					   "content_element" => true,
					   "show_settings_on_create" => false,
					   "params" => array(
						   array(
							   "type" => "textfield",
							   "heading" => esc_html__( 'Title', 'shopme' ),
							   "param_name" => "title",
							   "holder" => "h4",
							   "description" => ''
						   ),
							$add_css_animation,
							$add_animation_delay
						),
						"js_view" => 'VcColumnView'
					));

				vc_map(
					array(
					   "name" => esc_html__("Social Icon Item", 'shopme'),
					   "base" => "vc_mad_social_icons_item",
					   "class" => "vc_mad_social_icons_item",
					   "icon" => "icon-wpb-vc_icon",
					   "category" => esc_html__('Social Icons', 'shopme'),
					   "content_element" => true,
					   "as_child" => array('only' => 'vc_mad_social_icons'),
					   "is_container" => false,
					   "params" => array(
						   array(
							   'type' => 'dropdown',
							   'heading' => esc_html__( 'Social Icon', 'shopme' ),
							   'param_name' => 'social_icon',
							   'value' => array(
								   esc_html__( 'Facebook', 'shopme' ) => 'social_facebook',
								   esc_html__( 'Twitter', 'shopme' ) => 'social_twitter',
								   esc_html__( 'Pinterest', 'shopme' ) => 'social_pinterest',
								   esc_html__( 'GooglePlus', 'shopme' ) => 'social_googleplus',
								   esc_html__( 'Flickr', 'shopme' ) => 'social_flickr',
								   esc_html__( 'Youtube', 'shopme' ) => 'social_youtube',
								   esc_html__( 'Vimeo', 'shopme' ) => 'social_vimeo',
								   esc_html__( 'Instagram', 'shopme' ) => 'social_instagram',
								   esc_html__( 'LinkedIn', 'shopme' ) => 'social_linkedin',
								   esc_html__( 'Dribbble', 'shopme' ) => 'social_dribbble',
								   esc_html__( 'Behance', 'shopme' ) => 'social_behance',
								   esc_html__( 'VK', 'shopme' ) => 'social_vk',
								   esc_html__( 'Tumblr', 'shopme' ) => 'social_tumblr',
								   esc_html__( 'RSS', 'shopme' ) => 'social_rss',
								   esc_html__( 'Dropbox', 'shopme' ) => 'social_dropbox',
								   esc_html__( 'GitHub', 'shopme' ) => 'social_github',
								   esc_html__( 'Delicious', 'shopme' ) => 'social_delicious',
								   esc_html__( 'Digg', 'shopme' ) => 'social_digg',
								   esc_html__( 'DeviantArt', 'shopme' ) => 'social_deviantart',
								   esc_html__( 'Skype', 'shopme' ) => 'social_skype',
								   esc_html__( 'Yahoo', 'shopme' ) => 'social_yahoo',
								   esc_html__( 'Reddit', 'shopme' ) => 'social_reddit',
								   esc_html__( 'Stumbleupon', 'shopme' ) => 'social_stumbleupon'
							   ),
							   'admin_label' => true,
							   'description' => esc_html__( 'Choose type for this social icon.', 'shopme' )
						   ),
						   array(
							   "type" => "vc_link",
							   "heading" => esc_html__( 'Add URL to the social icon', 'shopme' ),
							   "param_name" => "link",
						   )
					    )
					) 
				);							

			}
		}

		function social_icons ($atts, $content = null) {

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

			$css_class = 'social_btns ' . $animation_class;

			ob_start(); ?>

			<?php if (!empty($title)): ?>
				<?php echo $this->wpb_widget_title( array( 'title' => $title ) ); ?>
			<?php endif; ?>

			<ul <?php echo esc_attr($this->create_data_string($attr)); ?> class="<?php echo esc_attr($css_class) ?>">
				<?php echo wpb_js_remove_wpautop($content, false) ?>
			</ul><!--/ .social_btns-->

			<?php return ob_get_clean() ;
		}

		function social_icons_item ($atts, $content = null) {

			$link = $icon = $social_icon = '';

			extract(shortcode_atts(array(
				'social_icon' => 'social_facebook',
				'link' => ''
			),$atts));

			$link = ($link == '||') ? '' : $link;
			$link = vc_build_link($link);
			$a_href = $link['url'];
			$a_title = $link['title'];
			($link['target'] != '') ? $a_target = $link['target'] : $a_target = '_self';

			ob_start(); ?>

			<?php if (!empty($a_href)): ?>
				<li>
					<a class="icon_btn middle_btn <?php echo esc_attr($social_icon); ?> tooltip_container" title="<?php echo esc_attr($a_title) ?>" target="<?php echo esc_attr($a_target) ?>" href="<?php echo esc_url($a_href) ?>">
						<i class="<?php echo esc_attr($this->get_social_icon($social_icon)) ?>"></i><span class="tooltip top"><?php echo esc_html($a_title) ?></span>
					</a>
				</li>
			<?php endif; ?>

			<?php return ob_get_clean() ;
		}

		function get_social_icon($social_icon) {
			switch ($social_icon) {
				case 'social_facebook':	    $icon = 'icon-facebook-1'; break;
				case 'social_twitter' : 	$icon = 'icon-twitter'; break;
				case 'social_googleplus' :  $icon = 'icon-gplus-2'; break;
				case 'social_pinterest' :   $icon = 'icon-pinterest-3'; break;
				case 'social_flickr' :      $icon = 'icon-flickr-1'; break;
				case 'social_youtube' :     $icon = 'icon-youtube'; break;
				case 'social_vimeo' :       $icon = 'icon-vimeo-2'; break;
				case 'social_instagram' :   $icon = 'icon-instagram-4'; break;
				case 'social_linkedin' :    $icon = 'icon-linkedin-5'; break;
				case 'social_dribbble' :    $icon = 'icon-dribbble'; break;
				case 'social_behance' :     $icon = 'icon-behance-1'; break;
				case 'social_vk' :     	    $icon = 'icon-vk'; break;
				case 'social_tumblr' :     	$icon = 'icon-tumblr-1'; break;
				case 'social_rss' :     	$icon = 'icon-rss'; break;
				case 'social_dropbox' :     $icon = 'icon-dropbox'; break;
				case 'social_github' :      $icon = 'icon-github-1'; break;
				case 'social_delicious' :   $icon = 'icon-delicious-2'; break;
				case 'social_digg' :   		$icon = 'icon-digg-1'; break;
				case 'social_deviantart' :  $icon = 'icon-deviantart-2'; break;
				case 'social_skype' :  		$icon = 'icon-skype'; break;
				case 'social_yahoo' :  		$icon = 'icon-yahoo-1'; break;
				case 'social_reddit' :  	$icon = 'icon-reddit'; break;
				case 'social_stumbleupon' : $icon = 'icon-stumbleupon-1'; break;

				default: $icon = 'icon-facebook-1'; break;
			}
			return $icon;
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
		class WPBakeryShortCode_vc_mad_social_icons extends WPBakeryShortCodesContainer {
		}
		class WPBakeryShortCode_vc_mad_social_icons_item extends WPBakeryShortCode {
		}
	}

	$shopme_social_icons = new shopme_social_icons();
}