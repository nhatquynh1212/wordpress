<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php if (is_product()): ?>

	<h1 itemprop="name" class="offset_title"><?php the_title(); ?></h1>

<?php else: ?>

	<h1 itemprop="name" class="offset_title">
		<a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a>
	</h1>

<?php endif; ?>

<?php
$next_post = get_next_post();
$prev_post = get_previous_post();
$next_post_url = $prev_post_url = $next_post_id = $prev_post_id = "";

if (is_object($next_post)) {
	$next_post_id = $next_post->ID;
	$next_post_url = get_permalink($next_post_id);
}
if (is_object($prev_post)) {
	$prev_post_id = $prev_post->ID;
	$prev_post_url = get_permalink($prev_post_id);
}
?>

<?php if (!empty($prev_post_url) || !empty($next_post_url)): ?>

	<div class="page-nav">

		<?php if (!empty($prev_post_url)): ?>
			<a href="<?php echo esc_url($prev_post_url) ?>" data-id="<?php echo esc_attr($prev_post_id); ?>" class="page-nav-link page-prev"></a>
		<?php endif; ?>

		<?php if (!empty($next_post_url)): ?>
			<a href="<?php echo esc_url($next_post_url) ?>" data-id="<?php echo esc_attr($next_post_id); ?>" class="page-nav-link page-next"></a>
		<?php endif; ?>

	</div><!--/ .page-nav-->

<?php endif; ?>
