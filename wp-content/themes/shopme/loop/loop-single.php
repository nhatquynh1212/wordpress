<?php
$this_post = array();
$this_post['post_id'] = $this_id = get_the_ID();
$this_post['content'] = get_the_content();
$this_post['url'] = $link = get_permalink();
$this_post = apply_filters('shopme-entry-format-single', $this_post);

extract($this_post);
?>

<h1 class="single-post-title"><?php the_title() ?></h1>

<section class="list_of_entries section_offset">

	<article <?php post_class('entry single'); ?>>

		<div class="entry_meta">

			<?php if (is_sticky($this_id)): ?>
				<?php printf( '<span class="sticky-post">%s</span>', esc_html__( 'Featured', 'shopme' ) ); ?>
			<?php endif; ?>

			<div class="row">

				<div class="col-sm-7 col-md-8">
					<?php echo shopme_blog_post_meta($this_id); ?>
				</div>

				<div class="col-sm-5 col-md-4">
					<?php if (shopme_custom_get_option('blog-single-meta-ratings')): ?>
						<?php if (PostRatings()->getControl($this_id, true)) { ?>
							<div class="rating-box">
								<?php echo PostRatings()->getControl($this_id, true); ?>
							</div>
						<?php } ?>
					<?php endif; ?>
				</div>

			</div><!--/ .row-->

		</div><!--/ .entry_meta-->

		<p><?php echo apply_filters('the_content', $content); ?></p>

		<div class="clear"></div>

		<?php shopme_share_post_this(); ?>

	</article><!--/ .single-->

	<?php if (is_single() && has_tag() && !post_password_required()): ?>
		<footer class="post_bottom_box">
			<div class="tags-tax-list">
				<?php the_tags( esc_html__('Tags: ', 'shopme'), ', ', '' ); ?>
			</div>
		</footer>
	<?php endif; ?>

</section><!--/ .section_offset-->

<?php if (shopme_custom_get_option('blog-single-related-posts')): ?>
	<section class="section_offset">
		<?php get_template_part('loop/single', 'related-posts'); ?>
	</section><!--/ .section_offset-->
<?php endif; ?>

<?php if (comments_open() || '0' != get_comments_number()): ?>
	<?php comments_template(); ?>
<?php endif; ?>