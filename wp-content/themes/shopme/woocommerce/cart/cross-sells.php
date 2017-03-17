<?php
/**
 * Cross-sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$crosssells = WC()->cart->get_cross_sells();

if ( sizeof( $crosssells ) == 0 ) return;

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', $posts_per_page ),
	'orderby'             => $orderby,
	'post__in'            => $crosssells,
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

global $shopme_config;
$shopme_config['shop_single_cross_sells_column'] = ($shopme_config['sidebar_position'] != 'no_sidebar') ? 4 : 6;

$woocommerce_loop['columns'] = apply_filters( 'woocommerce_cross_sells_columns', $columns );

if ( $products->have_posts() ) : ?>

	<section class="section_offset">

		<div class="cross-sells">

			<h3 class="offset_title"><?php esc_html_e( 'You May Be Interested in&hellip;', 'shopme' ) ?></h3>

			<div data-sidebar="<?php echo esc_attr($shopme_config['sidebar_position']); ?>" data-columns="<?php echo $shopme_config['shop_single_cross_sells_column']; ?>" class="products-container view-grid owl_carousel type_1 filter_style_1 <?php echo 'shop-columns-' . $shopme_config['shop_single_cross_sells_column'] ?>">

				<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>
					<?php wc_get_template_part( 'content', 'product' ); ?>
				<?php endwhile; // end of the loop. ?>

				<?php woocommerce_product_loop_end(); ?>

			</div>

		</div>

	</section><!--/ .section_offset-->

<?php endif;

wp_reset_postdata();