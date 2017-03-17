<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $comment;
?>

<li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

	<div id="comment-<?php comment_ID(); ?>" class="comment_container">

		<ul class="review-rates">

			<li class="v_centered">
				<?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '80' ), '' ); ?>
			</li>

			<li class="v_centered">

				<?php $rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

				if ( $rating && get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) : ?>

				<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf( esc_attr__( 'Rated %d out of 5', 'shopme' ), esc_attr( $rating ) ) ?>">
					<span style="width:<?php echo ( esc_attr( $rating ) / 5 ) * 100; ?>%"><strong itemprop="ratingValue"><?php echo esc_attr( $rating ); ?></strong> <?php esc_attr_e( 'out of 5', 'shopme' ); ?></span>
				</div>

				<?php endif; ?>

			</li>

		</ul><!--/ .review-rates-->

		<div class="review-body">

			<div itemprop="itemReviewed" itemscope itemtype="http://schema.org/Product">
				<span itemprop="name"><?php echo get_the_title() ?></span>
			</div>

			<div class="review-meta">

				<?php $verified = wc_review_is_from_verified_owner( $comment->comment_ID );

				if ( '0' === $comment->comment_approved ) { ?>

				<p class="meta"><em><?php esc_attr_e( 'Your comment is awaiting approval', 'shopme' ); ?></em></p>

				<?php } else { ?>

					<p class="meta">
						<strong itemprop="author"><?php comment_author(); ?></strong> <?php

						if ( 'yes' === get_option( 'woocommerce_review_rating_verification_label' ) && $verified ) {
							echo '<em class="verified">(' . esc_attr__( 'verified owner', 'shopme' ) . ')</em> ';
						}

						?>&ndash; <time itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( wc_date_format() ); ?></time>
					</p>

				<?php } ?>

				<?php do_action( 'woocommerce_review_before_comment_text', $comment ); ?>

				<div itemprop="description" class="description"><?php comment_text(); ?></div>

				<?php do_action( 'woocommerce_review_after_comment_text', $comment ); ?>

			</div><!--/ .review-meta-->

		</div><!--/ .review-body-->

	</div><!--/ .comment_container-->