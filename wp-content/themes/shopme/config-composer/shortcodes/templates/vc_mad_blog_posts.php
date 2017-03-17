<?php

class WPBakeryShortCode_VC_mad_blog_posts extends WPBakeryShortCode {

	public $atts = array();
	public $entries = '';
	protected $query = false;
	protected $loop_args = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'tag_title' => 'h3',
			'category' => '',
			'orderby' => '',
			'order' => '',
			'posts_per_page' => 5,
			'blog_style' => 'blog-big',
			'columns' => 2,
			'type' => 'type-1',
			'pagination' => 'no',
			'display_style' => '',
			'link' => "",
			'css_animation' => '',
			'animation_delay' => ''
		), $atts, 'vc_mad_blog_posts');

		$this->query_entries();
		$html = $this->html();

		return $html;
	}

	public function query_entries() {
		$params = $this->atts;

		$query = array(
			'post_type' => 'post',
			'orderby' => $params['orderby'],
			'order' => $params['order'],
			'ignore_sticky_posts'=> 1,
			'post_status' => array('publish')
		);

		if (!empty($params['category'])) {
			$categories = explode(',', $params['category']);
			$query['category__in'] = $categories;
		}

		$query['paged'] = (get_query_var('paged')) ? get_query_var('paged') : get_query_var('page');

		if (!empty($params['posts_per_page'])) {
			$query['posts_per_page'] = $params['posts_per_page'];
		}

		$this->entries = new WP_Query($query);
	}

	protected function entry_title($title, $tag_title) {
		return "<{$tag_title} class='offset_title'>". esc_html($title) ."</{$tag_title}>";
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

		$entries = $this->entries;
		$title = !empty($this->atts['title']) ? $this->atts['title'] : '';
		$tag_title = !empty($this->atts['tag_title']) ? $this->atts['tag_title'] : '';

		$atts = array();
		$blog_style = $columns = $blog_columns = $type = $pagination = $before_content = $display_style = $link = $animation_class = $css_animation = $animation_delay = '';

		extract($this->atts);

		$link = ($link == '||') ? '' : $link;
		$link = vc_build_link($link);
		$a_href = $link['url'];
		$a_title = $link['title'];
		($link['target'] != '') ? $a_target = $link['target'] : $a_target = '_self';

		switch ($blog_style) {
			case 'blog-big':
				$excerpt_count = shopme_custom_get_option('excerpt_count_blog_big_post');
				$blog_view = 'big_view';
				break;
			case 'blog-list':
				$excerpt_count = shopme_custom_get_option('excerpt_count_blog_list_post');
				$blog_view = 'list_view';
				break;
			case 'blog-grid':
				$excerpt_count = shopme_custom_get_option('excerpt_count_blog_grid_post');
				$blog_view = 'grid_view';
				$blog_columns = 'blog-columns-' . $columns;
				$atts['columns'] = $columns;
				if ($type == 'type-2') $excerpt_count = 100;
				break;
		}

		if ($css_animation != '') {
			$atts['animation'] = $css_animation;
			$animation_class = $this->getExtraClass('animated');
			if (!empty($animation_delay)) {
				$atts['animation-delay'] = $animation_delay;
			}
		}

		$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'list_of_entries ' . $blog_view . ' ' . $blog_columns . ' ' . $type . ' ' . $display_style, $this->settings['base']);

		ob_start(); ?>

		<div <?php echo esc_attr($this->create_data_string($atts)); ?> class="post-area <?php echo esc_attr($animation_class); ?>">

			<?php if (!empty($title)): ?>
				<?php echo $this->entry_title($title, $tag_title); ?>
			<?php endif; ?>

			<?php if ($pagination == 'yes'): ?>
				<?php echo shopme_pagination($entries, array('tag' => 'header', 'class' => 'top_box', 'blog_style' => $blog_view)); ?>
			<?php endif; ?>

				<ul class="<?php echo esc_attr($css_class); ?>">

					<?php foreach ( $entries->posts as $entry ):

						$this_post = array();
						$this_post['post_id'] = $id = $entry->ID;
						$this_post['url'] = $link = get_permalink($id);
						$this_post['title'] = $title = $entry->post_title;
						$this_post['post_format'] = $format = get_post_format($id) ? get_post_format($id) : 'standard';
						$this_post['image_size'] = shopme_blog_alias($format, '', $blog_style);
						$this_post['content'] = !empty($entry->post_excerpt) ? $entry->post_excerpt : $entry->post_content;

						$this_post = apply_filters('shopme-entry-format-'. $format, $this_post);
						$post_class = "entry entry-{$blog_style}";

						$post_content = !empty($entry->post_excerpt) ? shopme_string_truncate($entry->post_excerpt, $excerpt_count, " ", "…") : shopme_string_truncate($entry->post_content, $excerpt_count, " ", "…");
						extract($this_post);

						global $shopme_loop;

						if ( empty( $shopme_loop['loop'] ) )
							$shopme_loop['loop'] = 0;

						if ( empty( $shopme_loop['columns'] ) )
							$shopme_loop['columns'] = $columns;

						$shopme_loop['loop']++;

						$classes = array();
						if ( 0 == ( $shopme_loop['loop'] - 1 ) % $shopme_loop['columns'] || 1 == $shopme_loop['columns'] )
							$classes[] = 'first';
						if ( 0 == $shopme_loop['loop'] % $shopme_loop['columns'] )
							$classes[] = 'last';
						?>

						<li class="<?php echo implode($classes) ?>"><article <?php post_class($post_class, $id) ?>>

							<?php if (is_sticky($id)): ?>
								<?php printf( '<span class="sticky-post">%s</span>', esc_html__( 'Featured', 'shopme' ) ); ?>
							<?php endif; ?>

							<?php echo (!empty($before_content)) ? $before_content : ''; ?>

							<div class="post-content">

								<?php if ($type == 'type-2'): ?>
									<h5 class="entry-title"><a href="<?php echo esc_url($link) ?>"><b><?php echo esc_html($title) ?></b></a></h5>
								<?php else: ?>
									<h4 class="entry-title"><a href="<?php echo esc_url($link) ?>"><?php echo esc_html($title) ?></a></h4>
								<?php endif; ?>

								<div class="entry_meta">

									<?php if ($type !== 'type-2'): ?>

										<div class="alignleft">
											<?php echo shopme_blog_post_meta($id, $entry); ?>
										</div>

										<div class="alignright">
											<?php if (shopme_custom_get_option('blog-listing-meta-ratings')): ?>
												<div class="rating-box">
													<span class="rate-desc"><?php esc_html_e( 'rate this item', 'shopme' ); ?></span>
													<div class="rating readonly-rating" data-score="<?php echo esc_attr($entry->rating); ?>"></div>
													<span>(<?php printf(_n('%d vote', '%d votes', $entry->votes), $entry->votes); ?>)</span>
												</div>
											<?php endif; ?>
										</div>

									<?php else: ?>

										<?php $comments_count = get_comments_number($id); ?>

										<?php if (shopme_custom_get_option('blog-listing-meta-date')): ?>
											<span><i class="icon-calendar"></i> <?php echo get_the_time(get_option( 'date_format' ), $id); ?></span>
										<?php endif; ?>

										<?php if (shopme_custom_get_option('blog-listing-meta-comment')): ?>
											<?php if ($comments_count != "0" || comments_open($id)): ?>
												<?php $link_to = $comments_count === "0" ? "#respond" : "#comments"; ?>
												<span><a href="<?php echo esc_url($link . $link_to); ?>" class="comments"><i class="icon-comment"></i> <?php echo esc_html($comments_count); ?></a></span>
											<?php endif; ?>
										<?php endif; ?>

									<?php endif; ?>

								</div><!--/ .entry_meta-->

								<?php echo ($post_content != '') ? "<p>{$post_content}</p>" : ''; ?>

								<?php if ($type !== 'type-2'): ?>
									<a href="<?php echo esc_url($link); ?>" class="button_grey middle_btn">
										<?php esc_html_e('Read More', 'shopme'); ?>
									</a>
								<?php endif; ?>

							</div>

						</article></li><!--/ .entry-->

					<?php endforeach; ?>

					<?php wp_reset_postdata(); ?>

				</ul><!--/ .list_of_entries-->

			<?php if ($pagination == "yes"): ?>
				<?php echo shopme_pagination($entries); ?>
			<?php endif; ?>

			<?php if (!empty($a_href) && $type == 'type-2'): ?>
				<footer class="bottom_box">
					<a class="button_grey middle_btn" title="<?php echo esc_attr($a_title) ?>" target="<?php echo esc_attr($a_target) ?>" href="<?php echo esc_url($a_href) ?>"><?php echo esc_html($a_title) ?></a>
				</footer>
			<?php endif; ?>

		</div><!--/ .post-area-->

		<?php return ob_get_clean();
	}

}