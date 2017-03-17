<?php

/**
 * @param array $params
 *
 * @since 4.2
 * vc_filter: vc_wpb_getimagesize - to override output of this function
 * @return array|bool
 */
if (!function_exists('shopme_wpb_getImageBySize')) {
	function shopme_wpb_getImageBySize(
		$params = array(
			'post_id' => null,
			'attach_id' => null,
			'thumb_size' => 'thumbnail',
			'class' => ''
		)
	) {
		//array( 'post_id' => $post_id, 'thumb_size' => $grid_thumb_size )
		if ( ( ! isset( $params['attach_id'] ) || $params['attach_id'] == null ) && ( ! isset( $params['post_id'] ) || $params['post_id'] == null ) ) {
			return false;
		}
		$post_id = isset( $params['post_id'] ) ? $params['post_id'] : 0;

		if ( $post_id ) {
			$attach_id = get_post_thumbnail_id( $post_id );
		} else {
			$attach_id = $params['attach_id'];
		}

		$thumb_size = $params['thumb_size'];
		$thumb_class = ( isset( $params['class'] ) && $params['class'] != '' ) ? $params['class'] . ' ' : '';

		global $_wp_additional_image_sizes;
		$thumbnail = '';

		if ( is_string( $thumb_size ) && ( ( ! empty( $_wp_additional_image_sizes[ $thumb_size ] ) && is_array( $_wp_additional_image_sizes[ $thumb_size ] ) ) || in_array( $thumb_size, array(
					'thumbnail',
					'thumb',
					'medium',
					'large',
					'full'
				) ) )
		) {
			$attributes = array( 'class' => $thumb_class . 'attachment-' . $thumb_size );
			$thumbnail = wp_get_attachment_image( $attach_id, $thumb_size, false, $attributes );
		} elseif ( $attach_id ) {
			if ( is_string( $thumb_size ) ) {
				preg_match_all( '/\d+/', $thumb_size, $thumb_matches );
				if ( isset( $thumb_matches[0] ) ) {
					$thumb_size = array();
					if ( count( $thumb_matches[0] ) > 1 ) {
						$thumb_size[] = $thumb_matches[0][0]; // width
						$thumb_size[] = $thumb_matches[0][1]; // height
					} elseif ( count( $thumb_matches[0] ) > 0 && count( $thumb_matches[0] ) < 2 ) {
						$thumb_size[] = $thumb_matches[0][0]; // width
						$thumb_size[] = $thumb_matches[0][0]; // height
					} else {
						$thumb_size = false;
					}
				}
			}
			if ( is_array( $thumb_size ) ) {
				// Resize image to custom size
				$p_img = wpb_resize( $attach_id, null, $thumb_size[0], $thumb_size[1], true );
				$alt = trim( strip_tags( get_post_meta( $attach_id, '_wp_attachment_image_alt', true ) ) );
				$attachment = get_post( $attach_id );
				if ( ! empty( $attachment ) ) {
					$title = trim( strip_tags( $attachment->post_title ) );

					if ( empty( $alt ) ) {
						$alt = trim( strip_tags( $attachment->post_excerpt ) ); // If not, Use the Caption
					}
					if ( empty( $alt ) ) {
						$alt = $title;
					} // Finally, use the title
					if ( $p_img ) {

						$attributes = array(
							'class' => $thumb_class,
							'src' => $p_img['url'],
							'width' => $p_img['width'],
							'height' => $p_img['height'],
							'alt' => $alt,
							'title' => $title,
						);

						$thumbnail = '<img ' . vc_convert_atts_to_string( $attributes ) . ' />';
					}
				}
			}
		}

		$p_img_large = wp_get_attachment_image_src( $attach_id, 'large' );

		return apply_filters( 'vc_wpb_getimagesize', array(
			'thumbnail' => $thumbnail,
			'p_img_large' => $p_img_large
		), $attach_id, $params );
	}
}

class WPBakeryShortCode_VC_mad_brands_logo extends WPBakeryShortCode {

	public $atts = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'twin' => 'no',
			'images' => '',
			'links' => '',
			'autoplay' => '',
			'autoplaytimeout' => 5000,
			'css_animation' => ''
		), $atts, 'vc_mad_brands_logo');

		return $this->html();
	}

	protected function entry_title($title) {
		return "<h3 class='offset_title'>". $title ."</h3>";
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

	public function html() {

		$atts = array();
		$images = $twin = $autoplay = $autoplaytimeout = $animation_class = $css_animation = $links = '';
		extract($this->atts);

		$links = str_replace('<br />', ' ', $links);
		$links = !empty($links) ? explode('|', $links) : '';
		$images = explode( ',', $images);

		if ($css_animation != '') {
			$atts['animation'] = $css_animation;
			$animation_class = $this->getExtraClass('animated');
			if (!empty($animation_delay)) {
				$atts['animation-delay'] = $animation_delay;
			}
		}

		$atts['sidebar'] = SHOPME_HELPER::template_layout_class('sidebar_position');
		$atts['autoplay'] = ($autoplay == 'yes') ? 'true' : 'false';
		$atts['autoplaytimeout'] = $autoplaytimeout;

		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'owl_carousel brands_carousel', $this->settings['base'], $this->atts );

		ob_start(); ?>

		<div <?php echo esc_attr($this->create_data_string($atts)); ?> class="brands-logo-area <?php echo esc_attr($animation_class); ?>">

			<?php echo (!empty($title)) ? $this->entry_title($title) : $this->entry_title('&nbsp;'); ?>

			<ul class="<?php echo esc_attr($css_class) ?>">

				<?php $i = 0; ?>

				<?php foreach ($images as $id => $attach_id): ?>

					<li>

						<?php if ($attach_id > 0): ?>

							<?php
								$post_thumbnail = shopme_wpb_getImageBySize(
									array(
										'attach_id' => $attach_id,
										'thumb_size' => array(179, 109),
										'class' => ($css_animation) ? $css_animation : ''
									)
								);
							?>

						<?php else: ?>

							<?php
								$post_thumbnail = array();
								$post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
							?>

						<?php endif; ?>

						<?php $thumbnail = $post_thumbnail['thumbnail']; ?>
						<?php $link = (isset($links[$i]) && !empty($links[$i])) ? trim($links[$i]) : ''; ?>

						<?php if (isset($link) && !empty($link)): ?>
							<a target="_blank" href="<?php echo esc_url($link) ?>" class="<?php echo esc_attr($css_animation) ?>">
						<?php endif; ?>
								<?php echo $thumbnail; ?>
						<?php if (isset($link) && !empty($link)): ?>
							</a>
						<?php endif; ?>

						<?php $i++; ?>

					</li>

				<?php endforeach; ?>

			</ul>

		</div>

		<?php return ob_get_clean();
	}

}