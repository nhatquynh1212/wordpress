<?php
	/**
	 * The template for displaying Search Results pages.
	 */
	get_header();

?>

	<?php $shopme_results = shopme_which_archive(); ?>
	<?php $shopme_blog_style = shopme_custom_get_option('blog_style_search'); ?>

	<div class="template-search">

		<?php if (!empty($shopme_results)): ?>
			<?php echo shopme_title(
				array(
					'title' => $shopme_results,
					'heading' => 'h1'
				)
			) ?>
		<?php endif; ?>

		<?php if (!empty($_GET['s']) || have_posts()): ?>

			<?php if (have_posts()): ?>

				<?php echo shopme_pagination('', array('tag' => 'header', 'class' => 'top_box')); ?>

				<ul class="list_of_entries type-1 <?php echo sanitize_html_class($shopme_blog_style) ?>">

					<?php
					// Start the loop.
					while ( have_posts() ) : the_post();
						get_template_part( 'loop/loop', 'index' );
					endwhile;
					?>

				</ul><!--/ .list_of_entries-->

				<?php echo shopme_pagination(); ?>

			<?php else: ?>

				<?php get_template_part('content', 'none'); ?>

			<?php endif; ?>

		<?php endif; ?>

		<?php wp_reset_postdata(); ?>

	</div><!--/ .template-search-->

<?php get_footer(); ?>
