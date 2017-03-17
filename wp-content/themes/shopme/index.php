<?php
/**
* The main template file
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* e.g., it puts together the home page when no home.php file exists.
*
* @package WordPress
* @subpackage Shopme
* @since Shopme 1.0
*/

get_header(); ?>

<?php if ( have_posts() ) : ?>

	<?php $shopme_blog_style = shopme_custom_get_option('blog_style'); ?>

	<div class="post-area">

		<?php echo shopme_pagination('', array('tag' => 'header', 'class' => 'top_box', 'blog_style' => $shopme_blog_style)); ?>

		<ul class="list_of_entries type-1 <?php echo sanitize_html_class($shopme_blog_style) ?>">

			<?php
				// Start the loop.
				while ( have_posts() ) : the_post();
					get_template_part( 'loop/loop', 'index' );
				endwhile;
			?>

		</ul><!--/ .list_of_entries-->

		<?php echo shopme_pagination(); ?>

	</div><!--/ .post-area-->

<?php else:

	// If no content, include the "No posts found" template.
	get_template_part( 'content', 'none' );

endif; ?>

<?php get_footer(); ?>