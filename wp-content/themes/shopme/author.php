<?php
/**
 * The template for displaying Author archive pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Shopme
 * @since Shopme 1.0
 */
get_header(); ?>

<?php if ( have_posts() ) : ?>

	<?php $shopme_results = shopme_which_archive(); ?>

	<?php if (!empty($shopme_results)): ?>
		<?php echo shopme_title(
			array(
				'title' => $shopme_results,
				'heading' => 'h1'
			)
		) ?>
	<?php endif; ?>

	<div class="template-box">

		<?php
			$id = get_query_var('author');
			$name  =  get_the_author_meta('display_name', $id);
			$email =  get_the_author_meta('email', $id);
			$heading      = esc_html__("About", 'shopme') ." ". $name;
			$description  = get_the_author_meta('description', $id);

			if (current_user_can('edit_users') || get_current_user_id() == $id) {
				$description .= " <a href='" . esc_url(admin_url( 'profile.php?user_id=' . $id )) . "'>". esc_html__( '[ Edit the profile ]', 'shopme' ) ."</a>";
			}
		?>

		<div class="template-image-format">
			<?php echo get_avatar($email, '90', '', esc_html($name)); ?>
		</div><!--/ .template-image-format-->

		<div class="template-description">
			<h3 class="template-title"><?php echo esc_html($heading); ?></h3>
			<div class="template-text"><?php echo $description; ?></div><!--/ .template-text-->
		</div><!--/ .template-description-->

		<div class="clear"></div>

	</div><!--/ .template-box-->

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