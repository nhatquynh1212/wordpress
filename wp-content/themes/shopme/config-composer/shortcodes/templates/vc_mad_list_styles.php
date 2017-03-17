<?php

class WPBakeryShortCode_VC_mad_list_styles extends WPBakeryShortCode {

	public $atts = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'icon' => '',
			'values' => 'Aenean auctor|Et urna aliquam|Erat volutpat',
		), $atts, 'vc_mad_list_styles');

		return $this->html();
	}

	public function html() {

	 	$icon = $list_items = $list_styles = $values = '';

		extract($this->atts);

		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_list_styles wpb_content_element', $this->settings['base'], $this->atts );

		ob_start(); ?>

		<?php if (!empty($values)): ?>

			<?php $values = explode('|', $values); ?>

			<?php if (is_array($values)): ?>

				<?php if ($icon != ''): ?>
					<?php $icon = '<i class="'. sanitize_html_class($icon) .'"></i>'; ?>
				<?php endif; ?>

				<?php foreach($values as $value) {
					$list_items .= "<li>{$icon}{$value}</li>";
				} ?>

			<?php endif; ?>

			<div class="<?php echo esc_attr($css_class); ?>">
				<ul class="list-styles"><?php echo $list_items ?></ul>
			</div><!--/ .wpb_list_styles-->

		<?php endif; ?>

		<?php return ob_get_clean();
	}

}