<?php
if (!class_exists('shopme_image_video_gallery')) {

	class shopme_image_video_gallery {

		function __construct() {
			add_action('init', array($this, 'add_map_image_video_gallery'));
			add_shortcode( 'vc_mad_image_video_gallery', array($this, 'image_video_gallery') );
			add_shortcode( 'vc_mad_image_video_gallery_item', array($this, 'image_video_gallery_item') );
		}
		
		function add_map_image_video_gallery() {

			$target_arr = array(
				esc_html__( 'Same window', 'shopme' ) => '_self',
				esc_html__( 'New window', 'shopme' ) => "_blank"
			);

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
					   "name" => esc_html__("Image/Video Gallery", 'shopme' ),
					   "base" => "vc_mad_image_video_gallery",
					   "class" => "vc_mad_image_video_gallery",
					   "icon" => "icon-wpb-images-stack",
					   "category"  => esc_html__('Content', 'shopme'),
					   "description" => esc_html__('Responsive image/video gallery', 'shopme'),
					   "as_parent" => array('only' => 'vc_mad_image_video_gallery_item'),
					   "content_element" => true,
					   "show_settings_on_create" => false,
					   "params" => array(
						   array(
							   'type' => 'textfield',
							   'heading' => esc_html__( 'Widget title', 'shopme' ),
							   'param_name' => 'title',
							   'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'shopme' )
						   ),
						   $add_css_animation,
						   $add_animation_delay
						),
						"js_view" => 'VcColumnView'
					));

				vc_map(
					array(
					   "name" => esc_html__("Gallery Item", 'shopme'),
					   "base" => "vc_mad_image_video_gallery_item",
					   "class" => "vc_mad_image_video_gallery_item",
					   "icon" => "icon-wpb-images-stack",
					   "category" => esc_html__('Image/Video Gallery', 'shopme'),
					   "content_element" => true,
					   "as_child" => array('only' => 'vc_mad_image_video_gallery'),
					   "is_container" => false,
					   "params" => array(
							array(
								'type' => 'attach_image',
								'heading' => esc_html__( 'Image', 'shopme' ),
								'param_name' => 'image',
								'value' => '',
								'description' => esc_html__( 'Select image from media library.', 'shopme' )
							),
						   array(
							   'type' => 'dropdown',
							   'heading' => esc_html__( 'On click', 'shopme' ),
							   'param_name' => 'onclick',
							   'value' => array(
								   esc_html__( 'Open Lightbox', 'shopme' ) => 'link_image',
								   esc_html__( 'Do nothing', 'shopme' ) => 'link_no',
								   esc_html__( 'Open custom link', 'shopme' ) => 'custom_link'
							   ),
							   'description' => esc_html__( 'Define action for onclick event if needed.', 'shopme' )
						   ),
						   array(
							   'type' => 'exploded_textarea',
							   'heading' => esc_html__( 'Custom link', 'shopme' ),
							   'param_name' => 'custom_link',
							   'description' => esc_html__('Enter link.', 'shopme' ),
							   'dependency' => array(
								   'element' => 'onclick',
								   'value' => array( 'custom_link' )
							   )
						   ),
						   array(
							   'type' => 'dropdown',
							   'heading' => esc_html__( 'Custom link target', 'shopme' ),
							   'param_name' => 'custom_link_target',
							   'description' => esc_html__( 'Select where to open custom link.', 'shopme' ),
							   'dependency' => array(
								   'element' => 'onclick',
								   'value' => array( 'custom_link' )
							   ),
							   'value' => $target_arr
						   ),
					    )
					)
				);

			}
		}

		function image_video_gallery ($atts, $content = null) {

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

			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'lightbox_list wpb_content_element', $atts );

			ob_start(); ?>

			<div <?php echo esc_attr($this->create_data_string($attr)); ?> class="wpb_lightbox_list <?php echo esc_attr($animation_class); ?>">

				<?php if (!empty($title)): ?>
					<?php echo $this->wpb_widget_title(array( 'title' => $title )); ?>
				<?php endif; ?>

				<ul class="<?php echo esc_attr($css_class) ?>"><?php echo wpb_js_remove_wpautop($content, false) ?></ul>

			</div><!--/ .wpb_lightbox_list-->

			<?php return ob_get_clean() ;
		}

		function image_video_gallery_item ($atts, $content = null) {

			$image = $onclick = $custom_link = $custom_link_target = $service = '';

			extract(shortcode_atts(array(
				'image' => '',
				'onclick' => 'link_image',
				'custom_link' => '',
				'custom_link_target' => ''
			),$atts));

			ob_start(); ?>

			<?php if (isset($image) && $image > 0):
				$post_thumbnail = array();

				$alt = trim(strip_tags(get_post_meta($image, '_wp_attachment_image_alt', true)));
				if (empty($alt)) {
					$attachment = get_post($image);
					$alt = trim(strip_tags($attachment->post_title));
				}

				$thumbnail_atts = array( 'alt' => $alt );

				$post_thumbnail['thumbnail'] = SHOPME_HELPER::get_the_thumbnail($image, '150*150', true, $thumbnail_atts);
				$post_thumbnail['p_img_large'] = SHOPME_HELPER::get_post_attachment_image($image, '');

				$thumbnail = $post_thumbnail['thumbnail'];
				$p_img_large = $post_thumbnail['p_img_large'];

				if (isset($custom_link) && $custom_link != '') {
					$service = $this->which_video_service($custom_link);
				}

				?>

				<li>

					<?php if ($onclick == 'link_image'): ?>

						<a href="<?php echo esc_url($p_img_large); ?>" class="fancybox_item helper_list_icon" title="<?php echo esc_attr($alt) ?>">
							<?php echo $thumbnail; ?>
							<span class="helper_icon"><span class="helper_left"></span><span class="helper_right"></span></span>
						</a>

					<?php elseif ($onclick == 'custom_link' && isset($custom_link) && $custom_link != '' && !empty($service)): ?>

						<a href="<?php echo esc_url($custom_link); ?>" <?php echo (!empty($custom_link_target) ? ' target="' . esc_attr($custom_link_target) . '"' : '' ) ?> class="fancybox_item_iframe helper_list_icon">
							<?php echo $thumbnail; ?>
							<span class="helper_icon"><span class="helper_left"></span><span class="helper_right"></span></span>
						</a>

					<?php elseif ($onclick == 'custom_link' && isset($custom_link) && $custom_link != ''): ?>

						<a href="<?php echo esc_url($custom_link); ?>" <?php echo (!empty($custom_link_target) ? ' target="' . esc_attr($custom_link_target) . '"' : '' ) ?> class="helper_list_icon">
							<?php echo $thumbnail; ?>
							<span class="helper_icon"><span class="helper_left"></span><span class="helper_right"></span></span>
						</a>

					<?php else: ?>

						<a class="helper_list_icon">
							<?php echo $thumbnail; ?>
							<span class="helper_icon"><span class="helper_left"></span><span class="helper_right"></span></span>
						</a>

					<?php endif; ?>

				</li>

			<?php endif; ?>

			<?php return ob_get_clean() ;
		}

		public function which_video_service($video_url) {
			$service = "";

			if (strpos($video_url, 'youtube.com/watch') !== false || strpos($video_url, 'youtu.be/') !== false) {
				$service = "youtube";
			} else if (strpos($video_url, 'vimeo.com') !== false) {
				$service = "vimeo";
			} else if (strpos($video_url, 'maps.google.com') !== false) {
				$service = "google";
			}

			return $service;
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
		class WPBakeryShortCode_vc_mad_image_video_gallery extends WPBakeryShortCodesContainer {
		}
		class WPBakeryShortCode_vc_mad_image_video_gallery_item extends WPBakeryShortCode {
		}
	}

	$shopme_image_video_gallery = new shopme_image_video_gallery();
}