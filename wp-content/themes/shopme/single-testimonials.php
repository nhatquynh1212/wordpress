<?php
/**
 * The template for displaying single testimonials.
 *
 * @package WordPress
 * @subpackage Shopme
 * @since Shopme 1.0
 */
get_header(); ?>

<?php if ( have_posts() ): ?>

	<div class="template-single">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php

			global $post;
			$this_post = array();
			$this_post['post_id'] = get_the_ID();
			$this_post['content'] = apply_filters('the_content', get_the_content());
			$this_post['image_size'] = '90*90';
			$this_post = apply_filters('shopme-entry-format-template', $this_post);

			$comments_count = get_comments_number();
			$link = get_permalink($id);

			extract($this_post); ?>

			<div class="section-line">

				<div class="meta-holder">

					<h2 class="section-title"><?php the_title() ?></h2>

					<div class="post_meta">

						<span><i class="icon-calendar"></i> <?php echo get_the_time(get_option( 'date_format' ), $id); ?></span>

						<?php if ($comments_count != "0" || comments_open($id)): ?>
							<?php $link_to = $comments_count === "0" ? "#respond" : "#comments"; ?>
							<span><a href="<?php echo esc_url($link . $link_to); ?>" class="comments"><i class="icon-comment"></i> <?php echo esc_html($comments_count); ?></a></span>
						<?php endif; ?>

						<span><i class="icon-user-8"></i> <?php esc_html_e('by', 'shopme') ?> <?php echo the_author_posts_link(); ?></span>

						<?php $terms = get_terms("testimonials_category"); ?>

						<?php if (!empty($terms)): ?>
							<span><i class="icon-folder-open-empty-1"></i> <?php echo get_the_term_list($id, 'testimonials_category', '', ', ') ?></span>
						<?php endif; ?>

					</div><!--/ .post_meta-->

				</div><!--/ .meta-holder-->

			</div><!--/ .section-line-->

			<div class="template-box">

				<?php if (has_post_thumbnail()): ?>

					<div class="template-image-format">
						<?php echo (!empty($before_content)) ? $before_content : ""; ?>
					</div><!--/ .template-image-format-->

				<?php endif; ?>

				<div class="template-description">
					<?php echo do_shortcode($content); ?>
				</div><!--/ .template-description-->

				<div class="clear"></div>

			</div><!--/ .template-box-->

			<?php get_template_part('loop/single', 'link-pages'); ?>

		<?php endwhile ?>

	</div><!--/ .template-single-->

<?php endif; ?>

<?php get_footer(); ?>