<?php
/**
 * The template for displaying Testimonials Archive area.
 */

get_header(); ?>

<?php if (have_posts()): ?>

	<?php $shopme_results = shopme_which_archive(); ?>

	<div class="template-area">

		<?php if (!empty($shopme_results)): ?>
			<?php echo shopme_title(array('title' => $shopme_results)) ?>
		<?php endif; ?>

		<?php $shopme_columns_count = shopme_custom_get_option('testimonials_archive_column_count'); ?>

		<div class="testimonials-area <?php echo 'tm-columns-' . $shopme_columns_count; ?>">

			<div class="tm-grid">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php
					$id = get_the_ID();
					$thumbnail_atts = array(
						'alt'	=> trim(get_the_excerpt()),
						'title'	=> trim(get_the_title()),
					);
					$content = str_replace(']]>', ']]&gt;', apply_filters('the_content', get_the_content()));
					?>

					<div class="tm-item">
						<blockquote class="tm-blockquote">

							<div class="author_info">
								<a href="<?php echo esc_url(get_permalink()); ?>"><b><?php echo get_the_title(); ?></b></a>, <?php echo mad_meta('shopme_tm_place', '', $id); ?>
							</div>

							<?php echo do_shortcode($content); ?>

						</blockquote>
					</div><!--/ .tm-item-->

				<?php endwhile; // end of the loop. ?>

			</div><!--/ .tm-grid-->

			<?php echo shopme_pagination(); ?>

		</div><!--/ .testimonials-area-->

	</div><!--/ .template-area-->

<?php endif; ?>

<?php get_footer(); ?>