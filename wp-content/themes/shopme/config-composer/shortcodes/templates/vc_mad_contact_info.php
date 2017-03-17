<?php

class WPBakeryShortCode_VC_mad_contact_info extends WPBakeryShortCode {

	public $atts = array();
	public $content = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'link' => 'https://maps.google.com/maps?q=New+York&hl=en&sll=40.686236,-73.995409&sspn=0.038009,0.078192',
			'align' => '',
			'link' => '',
			'width' => '',
			'height' => '',
			'zoom' => 14, //depreceated from 4.0.2
			'type' => 'm', //depreceated from 4.0.2
			'bubble' => '', //depreceated from 4.0.2

			'text' => '',
			'info_location' => '',
			'info_phone' => '',
			'info_mail' => ''
		), $atts, 'vc_mad_contact_info');

		$this->content = $content;

		return $this->html();
	}

	public function html() {

		$title = $link = $width = $height = $zoom = $type = $bubble = $text = $info_location = $info_phone = $info_mail = '';

		extract($this->atts);

		if ($link == '') { return null; }

		$link = trim(vc_value_from_safe($link));
		$bubble = ( $bubble != '' && $bubble != '0' ) ? '&amp;iwloc=near' : '';
		$width = str_replace(array( '%', 'px' ), array( '', '' ), $width);
		$height = str_replace(array( '%', 'px' ), array( '', '' ), $height);

		$info_mail = ($info_mail == '||') ? '' : $info_mail;
		$info_mail = vc_build_link($info_mail);
		$a_href = $info_mail['url'];
		$a_title = $info_mail['title'];
		($info_mail['target'] != '') ? $a_target = $info_mail['target'] : $a_target = '_self';

		$el_class = ($height == '') ? ' vc_map_responsive' : '';

		if (is_numeric($width)) {
			$link = preg_replace('/width="[0-9]*"/', 'height="' . $width . '"', $link);
		}

		if (empty($width)) $width = '100%';

		if (is_numeric($height)) {
			$link = preg_replace('/height="[0-9]*"/', 'height="' . $height . '"', $link);
		}

		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_mad_contact_info wpb_content_element' . $el_class, $this->settings['base'], $this->atts );

		ob_start(); ?>

		<div class="<?php echo $css_class ?>">

			<?php if (!empty($title)): ?>
				<h3 class="offset_title"><?php echo esc_html($title) ?></h3>
			<?php endif; ?>

			<div class="theme_box">

				<div class="row">

					<div class="col-sm-5">

						<?php if (preg_match('/^\<iframe/', $link)): ?>
							<?php echo $link; ?>
						<?php else: ?>
							<iframe width="<?php echo $width ?>" height="<?php echo $height ?>" src="<?php echo $link ?>&amp;t=<?php echo $type ?>&amp;z=<?php echo $zoom ?>&amp;output=embed<?php echo $bubble ?>"></iframe>
						<?php endif; ?>

					</div>

					<div class="col-sm-7">

						<p><?php echo esc_html($text); ?></p>

						<ul class="c_info_list">

							<?php if (!empty($info_location)): ?>
								<li class="c_info_location"><?php echo esc_html($info_location) ?></li>
							<?php endif; ?>

							<?php if (!empty($info_phone)): ?>
								<li class="c_info_phone"><?php echo esc_html($info_phone) ?></li>
							<?php endif; ?>

							<?php if (!empty($a_href)): ?>
								<li class="c_info_mail">
									<a title="<?php echo esc_attr($a_title) ?>" target="<?php echo $a_target ?>" href="<?php echo $a_href ?>"><?php echo $a_title ?></a>
								</li>
							<?php endif; ?>

							<?php if (!empty($this->content)): ?>
								<li class="c_info_schedule"><?php echo wpb_js_remove_wpautop($this->content, true) ?></li>
							<?php endif; ?>

						</ul><!--/ .c_info_list-->

					</div>

				</div><!--/ .row-->

			</div><!--/ .theme_box-->

		</div>

		<?php return ob_get_clean();
	}

}