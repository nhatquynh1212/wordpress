<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
global $product;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

if ( ! comments_open() )
	return;
?>

<div id="reviews" class="section_offset">
	<div id="comments">

		<h3><?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) )
				printf( _n( '%s review for %s', '%s reviews for %s', $count, 'shopme' ), $count, get_the_title() );
			else
				_e( 'Reviews', 'shopme' );
			?></h3>

		<?php if ( have_comments() ) : ?>

			<ol id="reviews" class="reviews">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'shopme' ); ?></p>

		<?php endif; ?>

	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

				<?php
				$commenter = wp_get_current_commenter();

				$comment_form = array(
					'title_reply'          => have_comments() ? esc_html__( 'Write Your Own Review', 'shopme' ) : sprintf( __( 'Be the first to review &ldquo;%s&rdquo;', 'shopme' ), get_the_title() ),
					'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'shopme' ),
					'comment_notes_before' => '',
					'comment_notes_after'  => '',
					'fields'               => array(
						'author' => '<p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Nickname', 'shopme' ) . ' <span class="required"></span></label> ' .
							'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
						'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'shopme' ) . ' <span class="required"></span></label> ' .
							'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
					),
					'label_submit'  => esc_html__( 'Submit Review', 'shopme' ),
					'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s button_dark_grey middle_btn" value="%4$s" />',
					'logged_in_as'  => '',
					'comment_field' => ''
				);

				$comment_form['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your Review', 'shopme' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';

				if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {

					$comment_form['comment_field'] .= '<p class="comment-form-desc">'. sprintf( esc_html__('You\'re reviewing: %s . How do you rate this product? *', 'shopme'), get_the_title() ) .'</p>';

					$comment_form['comment_field'] .= '<p class="comment-form-rating"><select name="rating" id="rating">
							<option value="">' . esc_html__( 'Rate&hellip;', 'shopme' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'shopme' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'shopme' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'shopme' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'shopme' ) . '</option>
							<option value="1">' . esc_html__( 'Very Poor', 'shopme' ) . '</option>
						</select></p>';
				}

				comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'shopme' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>