<?php

class WPBakeryShortCode_VC_mad_banners extends WPBakeryShortCode {

	public $atts = array();
	public $content = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'type' => 'type-1',
			'bg_color' => '',
			'image' => '',
			'link' => "",
			'css_animation' => '',
			'animation_delay' => ''
		), $atts, 'vc_mad_banners');

		$this->content = $content;

		return $this->html();
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
		$image = $link = $animation_class = $css_animation = $animation_delay = '';

		extract($this->atts);

		if ($css_animation != '') {
			$atts['animation'] = $css_animation;
			$animation_class = $this->getExtraClass('animated');
			if (!empty($animation_delay)) {
				$atts['animation-delay'] = $animation_delay;
			}
		}

		$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_content_element ' . $animation_class, $this->settings['base']);

		$attach_id = preg_replace('/[^\d]/', '', $image);
		$alt = trim( strip_tags( get_post_meta( $attach_id, '_wp_attachment_image_alt', true ) ) );
		$img = wpb_getImageBySize(array(
			'attach_id' => $attach_id,
			'thumb_size' => '',
		));

		if ($img['p_img_large'] == null) {
			$img_large = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
		} else {
			$img_large = '<img alt="' . esc_attr($alt) . '" src="' . esc_attr($img['p_img_large'][0]) . '" />';
		}

		$link = ($link == '||') ? '' : $link;
		$link = vc_build_link($link);
		$a_href = $link['url'];
		$a_title = $link['title'];
		($link['target'] != '') ? $a_target = $link['target'] : $a_target = '_self';

		ob_start(); ?>

		<div <?php echo esc_attr($this->create_data_string($atts)); ?> class="banner-area <?php echo esc_attr($css_class) ?>">

			<?php if ($img_large != ''): ?>

				<?php if ( !empty($a_href) ): ?>
					<a class="banner-button" title="<?php echo esc_attr($a_title) ?>" target="<?php echo esc_attr($a_target) ?>" href="<?php echo esc_url($a_href) ?>">
				<?php endif; ?>

					<div class="banner-image">
						<?php echo $img_large; ?>
					</div><!--/ .banner-image-->

				<?php if ( !empty($a_href) ): ?>
					</a>
				<?php endif; ?>

			<?php endif; ?>

		</div><!--/ .banner-area-->

		<?php return ob_get_clean();
	}

}