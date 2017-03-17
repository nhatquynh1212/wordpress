<?php

class WPBakeryShortCode_VC_mad_testimonials extends WPBakeryShortCode {

	public $atts = array();
	public $entries = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'orderby' => 'date',
			'order' => 'DESC',
			'items' => 6,
			'style' => 'tm-grid',
			'type' => '',
			'columns' => 4,
			'categories' => array(),
			'view_all_button' => 'yes',
			'css_animation' => '',
			'pagination' => '',
			'animation_delay' => ''
		), $atts, 'vc_mad_testimonials');

		$this->query_entries();
		return $this->html();
	}

	public function query_entries() {
		$params = $this->atts;
		$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
		if (!$page || $params['pagination'] == 'no') $page = 1;

		$tax_query = array();

		if (!empty($params['categories'])) {
			$categories = explode(',', $params['categories']);
			$tax_query = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'testimonials_category',
					'field' => 'id',
					'terms' => $categories
				)
			);
		}

		$query = array(
			'orderby' => $params['orderby'],
			'order' => $params['order'],
			'paged' => $page,
			'post_type' => 'testimonials',
			'posts_per_page' => $params['items']
		);

		if (!empty($tax_query)) {
			$query['tax_query'] = $tax_query;
		}

		$this->entries = new WP_Query($query);
	}

	protected function entry_title($title) {
		return "<h3 class='offset_title'>". esc_html($title) ."</h3>";
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

		if (empty($this->entries) || empty($this->entries->posts)) return;

		$atts = array();
		$style = $columns = $items = $type = $animation_class = $view_all_button = $css_animation = $animation_delay = '';

		extract($this->atts);

		$atts['columns'] = $columns;
		$columns = 'tm-columns-' . $columns;

		if ($css_animation != '') {
			$atts['animation'] = $css_animation;
			$animation_class = $this->getExtraClass('animated');
			if (!empty($animation_delay)) {
				$atts['animation-delay'] = $animation_delay;
			}
		}

		$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'testimonials-area ' . $animation_class . ' ' . $columns, $this->settings['base']);

		ob_start(); ?>

		<div <?php echo esc_attr($this->create_data_string($atts)) ?> class="<?php echo esc_attr($css_class); ?>">

			<?php echo (!empty($title)) ? $this->entry_title($title) : ""; ?>

			<div class="<?php echo sanitize_html_class($style) ?>">

				<?php foreach ($this->entries->posts as $entry):
					$id = $entry->ID;
					$name = get_the_title($id);
					$link  = get_permalink($id);
					$place = mad_meta('shopme_tm_place', '', $id);
					$content = has_excerpt($id) ? apply_filters('the_excerpt', $entry->post_excerpt) : apply_filters('the_content', $entry->post_content);
					?>

					<div class="tm-item">
						<blockquote class="tm-blockquote <?php echo esc_attr($type); ?>">
							<?php if ($type != 'type_2'): ?>
								<div class="author_info">
									<a href="<?php echo esc_url($link) ?>"><b><?php echo $name; ?></b></a>, <?php echo $place; ?>
								</div>
							<?php endif; ?>

							<?php echo do_shortcode($content); ?>

							<?php if ($type == 'type_2'): ?>
								<div class="author_info">
									<a href="<?php echo esc_url($link) ?>"><b><?php echo $name; ?></b></a>, <?php echo $place; ?>
								</div>
							<?php endif ?>
						</blockquote>
					</div><!--/ .tm-item-->

				<?php endforeach; ?>

			</div>

			<?php if ($view_all_button == 'yes'): ?>
				<footer class="bottom_box">
					<a target="_blank" href="<?php echo esc_url(get_post_type_archive_link('testimonials')) ?>" class="button_grey middle_btn"><?php esc_html_e('View All Testimonials', 'shopme') ?></a>
				</footer>
			<?php endif; ?>

		</div><!--/ .testimonials-area-->

		<?php //if ($pagination == "yes"): ?>
			<?php //echo mad_corenavi($this->entries->max_num_pages); ?>
		<?php //endif; ?>

		<?php return ob_get_clean();
	}

}