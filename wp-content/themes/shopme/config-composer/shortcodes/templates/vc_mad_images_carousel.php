<?php
class WPBakeryShortCode_VC_mad_images_carousel extends WPBakeryShortCode {

	public $atts = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'onclick' => 'link_image',
			'custom_links' => '',
			'custom_links_target' => '',
			'images' => '',
			'el_class' => '',
			'autoplay' => '',
			'autoplaytimeout' => 5000,
			'speed' => 1000,
			'css_animation' => ''
		), $atts, 'vc_mad_images_carousel');

		return $this->html();
	}

	private function html() {

		$title = $onclick = $custom_links = $custom_links_target = $images = $el_class = $autoplay = $autoplaytimeout = $speed = $css_animation = '';

		extract($this->atts);

		$el_class = $this->getExtraClass( $el_class );

		if ( $images == '' ) $images = '-1,-2,-3';
			$images = explode( ',', $images );

		if ( $onclick == 'custom_link' ) {
			$custom_links = explode( ',', $custom_links );
		}

		$lightbox_random = $onclick == 'link_image' ? ' data-group="carousel-'. rand(). '"' : '';

		$i = - 1;
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_images_carousel wpb_content_element' . $el_class . ' vc_clearfix', $this->settings['base'], $this->atts );

	ob_start(); ?>

	<?php echo  wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_gallery_heading section-title' ) ) ?>

	<div class="<?php echo apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_class, $this->settings['base'], $this->atts ) ?>">

		<div data-speed="<?php echo esc_attr($speed) ?>"
			 data-autoplaytimeout="<?php echo esc_attr($autoplaytimeout) ?>"
			 data-autoplay="<?php echo esc_attr($autoplay) == 'yes' ? 'true' : 'false' ?>" class="images-carousel">

			<?php foreach ( $images as $attach_id ): ?>

				<div class="images-item">

					<?php
						$i ++;
						if ( $attach_id > 0 ) {
							$post_thumbnail = array();
							$thumbnail_atts = array(
								'class'	=> "tr_all_long_hover",
								'alt'	=> trim(get_the_title()),
								'title'	=> trim(get_the_title())
							);
							$post_thumbnail['thumbnail'] = SHOPME_HELPER::get_the_thumbnail($attach_id, '440*345', true, $thumbnail_atts);
							$post_thumbnail['img_large'] = SHOPME_HELPER::get_post_attachment_image($attach_id, '');
						} else {
							$post_thumbnail = array();
							$post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
							$post_thumbnail['img_large'] = vc_asset_url( 'vc/no_image.png' );
						}
						$thumbnail = $post_thumbnail['thumbnail'];
						$img_large = $post_thumbnail['img_large'];
					?>

					<div class="image-overlay">

						<div class="photoframe with-buttons">

							<?php echo $thumbnail; ?>

							<div class="open-buttons clearfix">

								<?php if ( $onclick == 'link_image' ): ?>

									<a href="<?php echo esc_url($img_large)  ?>" class="open-button lightbox-icon jackbox" <?php echo $lightbox_random ?>><span class="curtain"></span></a>

								<?php elseif ( $onclick == 'custom_link' && isset( $custom_links[$i] ) && $custom_links[$i] != '' ): ?>

									<a href="<?php echo esc_url($custom_links[$i]) ?>" <?php echo ( ! empty( $custom_links_target ) ? ' target="' . esc_attr($custom_links_target) . '"' : '' ) ?>
									   class="open-button link-icon"><span class="curtain"></span>
									</a>

								<?php endif; ?>

							</div><!--/ .open-buttons-->

						</div><!--/ .with-buttons-->

					</div><!--/ .image-overlay-->

				</div><?php echo $this->endBlockComment('/ .images-item') ?>

			<?php endforeach; ?>

		</div><?php echo $this->endBlockComment('/ .images-carousel') ?>

	</div><?php echo $this->endBlockComment( '/ .wpb_images_carousel' ) ?>

	<?php return ob_get_clean();
	}



}