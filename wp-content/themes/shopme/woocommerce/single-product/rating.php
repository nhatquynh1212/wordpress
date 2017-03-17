<?php
/**
 * Single Product Rating
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();
?>

<div class="description_section v_centered">

	<div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
		<div class="star-rating" title="<?php printf( esc_html__( 'Rated %s out of 5', 'shopme' ), $average ); ?>">
			<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
				<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( esc_html__( 'out of %s5%s', 'shopme' ), '<span itemprop="bestRating">', '</span>' ); ?>
				<?php printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'shopme' ), '<span itemprop="ratingCount" class="rating">' . $rating_count . '</span>' ); ?>
			</span>
		</div>
	</div>

	<ul class="top-bar">

		<?php if ( is_singular('product') ): ?>

			<?php if ( $rating_count > 0 ) : ?>

				<?php if ( comments_open() ) : ?>
					<li><a href="#reviews" class="woocommerce-review-link" rel="nofollow">
							<?php printf( _n( '%s Review', '%s Reviews', $review_count, 'shopme' ), '<span class="count">' . $review_count . '</span>' ); ?></a>
					</li>
					<li><a href="#commentform" class="woocommerce-write-review-link" rel="nofollow"><?php esc_html_e('Add Your Review', 'shopme') ?></a></li>
				<?php endif ?>

			<?php else: ?>

				<?php if ( comments_open() ) : ?>
					<li><a href="#commentform" class="woocommerce-write-review-link" rel="nofollow"><?php esc_html_e('Add Your Review', 'shopme') ?></a></li>
				<?php endif; ?>

			<?php endif; ?>

		<?php else: ?>

			<?php if ( $rating_count > 0 ) : ?>

				<?php if ( comments_open() ) : ?>
					<li><a href="<?php echo esc_url(get_the_permalink()) ?>#reviews" class="woocommerce-review-link" rel="nofollow">
							<?php printf( _n( '%s Review', '%s Reviews', $review_count, 'shopme' ), '<span class="count">' . $review_count . '</span>' ); ?></a>
					</li>
					<li><a href="<?php echo esc_url(get_the_permalink()) ?>#commentform" class="woocommerce-write-review-link" rel="nofollow"><?php esc_html_e('Add Your Review', 'shopme') ?></a></li>
				<?php endif ?>

			<?php else: ?>

				<?php if ( comments_open() ) : ?>
					<li><a href="<?php echo esc_url(get_the_permalink()) ?>#commentform" class="woocommerce-write-review-link" rel="nofollow"><?php esc_html_e('Add Your Review', 'shopme') ?></a></li>
				<?php endif; ?>

			<?php endif; ?>

		<?php endif; ?>

	</ul><!--/ .top-bar-->

</div>

