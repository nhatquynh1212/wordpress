<?php
$this_id = get_the_ID();
$tag_ids = array();
$tags = wp_get_post_terms($this_id, 'post_tag');

if (!empty($tags) && is_array($tags)) {

	$post_count = shopme_custom_get_option('related_posts_count');

	$query = array(
		'post_type' => 'post',
		'numberposts' => $post_count,
		'ignore_sticky_posts'=> 1,
		'post__not_in' => array($this_id)
	);

	foreach ($tags as $tag) {
		$tag_ids[] = (int) $tag->term_id;
	}

	if (!empty($tag_ids)) {
		$query['tag__in'] = $tag_ids;

		$entries = get_posts($query);

		switch ($post_count) {
			case 3: $class_count = 'posts-count-3'; break;
			case 6: $class_count = 'posts-count-6'; break;
			case 9: $class_count = 'posts-count-9'; break;
			default:  $class_count = 'posts-count-3'; break;
		}
		?>

		<?php if ( !empty($entries) ): ?>

			<h3 class="row-title"><?php esc_html_e('Related Posts', 'shopme'); ?></h3>

			<div class="related_posts <?php echo esc_attr($class_count) ?>">

				<?php foreach($entries as $post): setup_postdata($post); ?>

					<?php
						$id = get_the_ID();
						$post_class = "entry";
						$comments_count = get_comments_number();
						$link = get_permalink();
						$title = get_the_title();

						global $shopme_loop;

						if ( empty( $shopme_loop['loop'] ) )
							$shopme_loop['loop'] = 0;

						if ( empty( $shopme_loop['columns'] ) )
							$shopme_loop['columns'] = 3;

						$shopme_loop['loop']++;

						$classes = array();
						if ( 0 == ( $shopme_loop['loop'] - 1 ) % $shopme_loop['columns'] || 1 == $shopme_loop['columns'] )
							$post_class .= ' first';
						if ( 0 == $shopme_loop['loop'] % $shopme_loop['columns'] )
							$post_class .= ' last';
					?>

					<article <?php post_class($post_class); ?> id="post-<?php the_ID(); ?>">

						<div class="entry_thumb">

							<?php if (has_post_thumbnail()):

								$thumbnail_atts = array(
									'alt'	=> trim(strip_tags(get_the_excerpt())),
									'title'	=> trim(strip_tags(get_the_title()))
								);
								$thumbnail = SHOPME_HELPER::get_the_post_thumbnail($id, '83*83', true, $thumbnail_atts);
								?>

								<a href="<?php esc_url(the_permalink()) ?>" title="<?php the_title(); ?>" class="lightbox-added">
									<?php echo $thumbnail ?>
									<div class="curtain-overlay overlay-type-link"><div class="box-curtain"><div class="in-front"></div><div class="in-back"></div></div></div>
								</a>

							<?php endif; ?>

						</div><!--/ .entry_thumb-->

						<div class="post-content">

							<h6 class="entry_title">
								<a title="<?php the_title(); ?>" href="<?php esc_url(the_permalink()) ?>">
									<?php echo shopme_string_truncate($title, 40 , " ", "…"); ?>
								</a>
							</h6>

							<!-- - - - - - - - - - - - - - Byline - - - - - - - - - - - - - - - - -->

							<div class="entry_meta">

								<span><i class="icon-calendar"></i> <?php echo get_the_time(get_option( 'date_format' ), $id); ?></span>

								<?php if ($comments_count != "0" || comments_open($id)): ?>
									<?php $link_to = $comments_count === "0" ? "#respond" : "#comments"; ?>
									<span><a href="<?php echo esc_url($link) . $link_to; ?>" class="comments"><i class="icon-comment"></i> <?php echo esc_html($comments_count); ?></a></span>
								<?php endif; ?>

							</div><!--/ .entry_meta-->

							<!-- - - - - - - - - - - - - - End of byline - - - - - - - - - - - - - - - - -->

						</div><!--/ .post-content-->

					</article><!--/ .entry-->

				<?php endforeach; ?>

			</div><!--/ .related_posts-->

			<?php wp_reset_postdata(); ?>

		<?php endif; ?>

	<?php
	}
}