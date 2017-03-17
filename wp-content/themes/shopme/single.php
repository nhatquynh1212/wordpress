<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Shopme
 * @since Shopme 1.0
 */
get_header(); ?>

<?php if ( have_posts() ): ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'loop/loop', 'single' ); ?>
	<?php endwhile ?>

<?php endif; ?>

<?php get_footer(); ?>