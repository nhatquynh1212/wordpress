<?php global $post; ?>

<?php
	if ((!is_admin()) && is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
?>

<!-- - - - - - - - - - - - Comments - - - - - - - - - - - - - - -->

<?php if ( have_comments() ): ?>

	<section class="section_offset">

		<div id="comments">

			<h3><?php echo get_comments_number() . " " . esc_html__('Comments', 'shopme'); ?></h3>

			<ol class="comments-list">
				<?php wp_list_comments('avatar_size=80&callback=shopme_output_comments'); ?>
			</ol>

			<?php if (get_comment_pages_count() > 1 && get_option( 'page_comments' )): ?>
				<nav class="comments-pagination">
					<?php paginate_comments_links(); ?>
				</nav>
			<?php endif; ?>

			<?php if (! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' )): ?>
				<p class="nocomments"><?php esc_html_e('Comments are closed.', 'shopme'); ?></p>
			<?php endif; ?>

		</div><!--/ #comments-->

	</section><!--/ .section_offset-->

<?php endif; ?>

<!-- - - - - - - - - - - end Comments - - - - - - - - - - - - - -->


<!-- - - - - - - - - - - - Respond - - - - - - - - - - - - - - - -->

<?php if (comments_open()): ?>

	<section class="section_offset">
		<?php comment_form(); ?>
	</section><!--/ .section_offset-->

<?php elseif(get_comments_number()): ?>

	<section class="section_offset">
		<h3 class="commentsclosed"><?php esc_html_e( 'Comments are closed.', 'shopme' ) ?></h3>
	</section><!--/ .section_offset-->

<?php endif; ?>

<!-- - - - - - - - - - -/ end Respond - - - - - - - - - - - - - - -->
