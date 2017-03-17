<?php
/**
 * YITH WooCommerce Ajax Search template
 *
 * @author Yithemes
 * @package YITH WooCommerce Ajax Search
 * @version 1.1.1
 */

if ( !defined( 'YITH_WCAS' ) ) { exit; } // Exit if accessed directly
wp_enqueue_script('yith_wcas_frontend' );

$yith_wcas_search_input_label = get_option('yith_wcas_search_input_label');
if (empty($yith_wcas_search_input_label)) {
	$yith_wcas_search_input_label = esc_html__('Search for products', 'shopme');
}
?>

<div class="yith-ajaxsearchform-container">

    <form class="clearfix search_form" method="get" id="yith-ajaxsearchform" action="<?php echo esc_url( home_url( '/'  ) ) ?>">

		<?php if ( defined('YITH_WCAS_PREMIUM' ) ): ?>

			<?php $research_post_type = ( get_option('yith_wcas_default_research') ) ? get_option('yith_wcas_default_research') : 'product'; ?>

				<input type="search"
					   value="<?php echo get_search_query() ?>"
					   name="s"
					   id="yith-s"
					   class="yith-s alignleft"
					   placeholder="<?php echo get_option( 'yith_wcas_search_input_label' ) ?>"
					   data-loader-icon="<?php echo str_replace( '"', '', apply_filters( 'yith_wcas_ajax_search_icon', '' ) ) ?>"
					   data-min-chars="<?php echo get_option( 'yith_wcas_min_chars' ); ?>" />

				<div class="search_category alignleft">

					<input type="hidden" name="post_type" class="yit_wcas_post_type" id="yit_wcas_post_type" value="<?php echo $research_post_type ?>" />

					<?php
					if ( get_option( 'yith_wcas_show_category_list' ) == 'yes' ):

						$product_categories = yith_wcas_get_shop_categories( get_option( 'yith_wcas_show_category_list_all' ) == 'all' );
						$selected_category = ( isset( $_REQUEST['product_cat'] ) ) ? $_REQUEST['product_cat'] : '';

						if ( !empty( $product_categories ) ) : ?>
							<select class="search_categories selectbox" id="search_categories" name="product_cat">
								<option value="" <?php selected( '', $selected_category ) ?>><?php _e( 'All', 'shopme' ) ?></option>
								<?php foreach ( $product_categories as $cat ): ?>
									<option value="<?php echo $cat->slug ?>" <?php selected( $cat->slug, $selected_category ) ?>><?php echo $cat->name ?></option>
								<?php endforeach; ?>
							</select>
						<?php endif ?>

					<?php endif ?>

				</div>

				<button type="submit" class="button_blue def_icon_btn alignleft" id="yith-searchsubmit"></button>

			<?php do_action( 'wpml_add_language_form_field' ); ?>

		<?php else: ?>

			<input type="search"
				   value="<?php echo get_search_query() ?>"
				   name="s" id="yith-s"
				   class="yith-s alignleft"
				   placeholder="<?php echo esc_attr($yith_wcas_search_input_label); ?>"
				   data-loader-icon="<?php echo str_replace( '"', '', apply_filters('yith_wcas_ajax_search_icon', '') ) ?>"
				   data-min-chars="<?php echo get_option('yith_wcas_min_chars'); ?>" />

			<div class="search_category alignleft">

				<?php
					$args = array(
						'show_option_all' => esc_html__( 'All Categories', 'shopme' ),
						'hierarchical' => 1,
						'class' => 'cat',
						'echo' => 0,
						'selected' => 1,
						'value_field' => 'slug'
					);

					$args['taxonomy'] = 'product_cat';
					$args['name'] = 'product_cat';

					$html =	shopme_dropdown_categories($args);
					echo str_replace( '&nbsp;', '', $html );
				?>

			</div><!--/ .search_category-->

			<button type="submit" class="button_blue def_icon_btn alignleft"></button>
			<input type="hidden" name="post_type" value="product" />

			<?php if ( defined( 'ICL_LANGUAGE_CODE' ) ): ?>
				<input type="hidden" name="lang" value="<?php echo( ICL_LANGUAGE_CODE ); ?>" />
			<?php endif ?>

		<?php endif; ?>

    </form>

</div>