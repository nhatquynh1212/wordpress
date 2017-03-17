<?php

$excerpt_count = '';
$this_post = array();
$this_post['post_id'] = $id = get_the_ID();
$this_post['url'] = $link = get_permalink();
$this_post['title'] = $title = get_the_title();
$this_post['content'] = has_excerpt($id) ? get_the_excerpt() : get_the_content();
$this_post['post_format'] = $format = get_post_format() ? get_post_format() : 'standard';
$this_post['image_size'] = shopme_blog_alias($format, '', shopme_custom_get_option('blog_style'));

switch (shopme_custom_get_option('blog_style')) {
	case 'big_view':
		$excerpt_count = shopme_custom_get_option('excerpt_count_blog_big_post');
		break;
	case 'grid_view':
		$excerpt_count = shopme_custom_get_option('excerpt_count_blog_grid_post');
		break;
	case 'list_view':
		$excerpt_count = shopme_custom_get_option('excerpt_count_blog_list_post');
		break;
}

extract($this_post);

$this_post = apply_filters('shopme-entry-format-'. $format, $this_post);

extract($this_post);

global $shopme_loop;

if ( empty( $shopme_loop['loop'] ) )
	$shopme_loop['loop'] = 0;

if ( empty( $shopme_loop['columns'] ) )
	$shopme_loop['columns'] = 2;

$shopme_loop['loop']++;

$classes = array();
if ( 0 == ( $shopme_loop['loop'] - 1 ) % $shopme_loop['columns'] || 1 == $shopme_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $shopme_loop['loop'] % $shopme_loop['columns'] )
	$classes[] = 'last';
?>

<li class="<?php echo implode($classes); ?>" id="post-<?php the_ID(); ?>">

	<article <?php post_class('entry') ?>>

		<?php if (is_sticky()): ?>
			<?php printf( '<span class="sticky-post">%s</span>', esc_html__( 'Featured', 'shopme' ) ); ?>
		<?php endif; ?>

		<?php echo (!empty($before_content)) ? $before_content : ''; ?>

		<div class="post-content">

			<h4 class="entry-title"><a href="<?php esc_url(the_permalink()) ?>"><?php the_title() ?></a></h4>

			<div class="entry_meta">

				<div class="alignleft">
					<?php echo shopme_blog_post_meta($id); ?>
				</div>

				<div class="alignright">
					<?php if (shopme_custom_get_option('blog-listing-meta-ratings')): ?>
						<?php if (PostRatings()->getControl($id, true)) { ?>
							<div class="rating-box">
								<?php echo PostRatings()->getControl($id, true); ?>
							</div>
						<?php } ?>
					<?php endif; ?>
				</div>

			</div><!--/ .entry_meta-->

			<?php
			if ( has_excerpt($id) ) {
				$post_content = get_the_excerpt();
			} else {
				$post_content = get_the_content(sprintf(
					esc_html__( 'Continue reading %s', 'shopme' ),
					the_title( '<span class="screen-reader-text">', '</span>', false )
				));
			}
			?>

			<?php if ( !empty($post_content) ): ?>
				<div class="entry-content">
					<?php echo shopme_string_truncate( $post_content, $excerpt_count, " ", "...", true, '' ); ?>
				</div>
			<?php endif; ?>

			<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'shopme') . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'shopme') . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
			?>

			<a href="<?php esc_url(the_permalink()) ?>" class="read-more-button button_grey middle_btn">
				<?php esc_html_e('Read More', 'shopme'); ?>
			</a>

			<?php edit_post_link( esc_html__( '[ Edit ]', 'shopme' ), '<div class="edit-link">', '</div>' ); ?>

		</div><!--/ .post-content-->

	</article>

</li>