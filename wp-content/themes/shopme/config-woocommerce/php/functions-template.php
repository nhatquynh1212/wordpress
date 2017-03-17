<?php

/* ---------------------------------------------------------------------- */
/*	Template: Woocommerce
/* ---------------------------------------------------------------------- */

if ( ! function_exists('shopme_wc_get_template') ) {
	function shopme_wc_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
		if ( function_exists( 'wc_get_template' ) ) {
			wc_get_template( $template_name, $args, $template_path, $default_path );
		} else {
			woocommerce_get_template( $template_name, $args, $template_path, $default_path );
		}
	}
}

if ( ! function_exists('shopme_woocommerce_product_custom_tab') ) {

	function shopme_woocommerce_product_custom_tab($key) {
		global $post;

		$shopme_title_product_tab = $shopme_content_product_tab = '';
		$custom_tabs_array = get_post_meta($post->ID, 'shopme_custom_tabs', true);
		$custom_tab = $custom_tabs_array[$key];

		extract($custom_tab);

		if ($shopme_title_product_tab != '') {

			preg_match("!\[embed.+?\]|\[video.+?\]!", $shopme_content_product_tab, $match_video);
			preg_match("!\[(?:)?gallery.+?\]!", $shopme_content_product_tab, $match_gallery);
			$zoom_image = shopme_custom_get_option('zoom_image', '');

			if (!empty($match_video)) {

				global $wp_embed;

				$video = $match_video[0];
				$before = "<div class='image-overlay ". esc_attr($zoom_image) ."'>";
				$before .= "<div class='entry-media photoframe'>";
				$before .= do_shortcode($wp_embed->run_shortcode($video));
				$before .= "</div>";
				$before .= "</div>";
				$before = apply_filters('the_content', $before);
				echo $before;

			} elseif (!empty($match_gallery)) {

				$gallery = $match_gallery[0];
				if (strpos($gallery, 'vc_') === false) {
					$gallery = str_replace("gallery", 'shopme_gallery image_size="848*370"', $gallery);
				}
				$before = apply_filters('the_content', $gallery);
				echo do_shortcode($before);

			} else {
				echo do_shortcode($shopme_content_product_tab);
			}

		}

	}
}

if (!function_exists('shopme_woocommerce_show_product_loop_out_of_sale_flash')) {
	function shopme_woocommerce_show_product_loop_out_of_sale_flash() {
		shopme_wc_get_template( 'loop/out-of-stock-flash.php' );
	}
}

if ( ! function_exists('shopme_woocommerce_other_products') ) {
	function shopme_woocommerce_other_products() {
		shopme_wc_get_template( 'single-product/other-products.php' );
	}
}

if (!function_exists('shopme_woocommerce_content_top')) {
	function shopme_woocommerce_content_top() {
		shopme_wc_get_template( 'content-top.php' );
	}
}

if (!function_exists('shopme_woocommerce_single_variation_add_to_cart_button')) {
	function shopme_woocommerce_single_variation_add_to_cart_button() {
		global $product;
		?>
		<div class="variations_button">

			<table class="description-table">
				<tbody>
				<tr>
					<td><?php esc_html_e('Qty:', 'shopme'); ?></td>
					<td class="product-quantity">
						<?php woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) ); ?>
					</td>
				</tr>
				</tbody>
			</table><!--/ .description-table-->

			<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
			<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

			<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->id ); ?>" />
			<input type="hidden" name="product_id" value="<?php echo absint( $product->id ); ?>" />
			<input type="hidden" name="variation_id" class="variation_id" value="" />
		</div>
		<?php
	}
}

if (!function_exists('shopme_overwrite_catalog_ordering')) {

	function shopme_overwrite_catalog_ordering($args) {

		global $shopme_config;

		$keys = array('product_order', 'product_count', 'product_sort');
		if (empty($shopme_config['woocommerce'])) $shopme_config['woocommerce'] = array();

		foreach ($keys as $key) {
			if (isset($_GET[$key]) ) {
				$_SESSION['shopme_woocommerce'][$key] = esc_attr($_GET[$key]);
			}
			if (isset($_SESSION['shopme_woocommerce'][$key]) ) {
				$shopme_config['woocommerce'][$key] = $_SESSION['shopme_woocommerce'][$key];
			}
		}

		if(isset($_GET['product_order']) && !isset($_GET['product_sort']) && isset($_SESSION['shopme_woocommerce']['product_sort']))
		{
			unset($_SESSION['shopme_woocommerce']['product_sort'], $shopme_config['woocommerce']['product_sort']);
		}

		if (!isset($_GET['product_count'])) {
			unset($_SESSION['shopme_woocommerce']['product_count']);
		}

		extract($shopme_config['woocommerce']);

		if (isset($product_order) && !empty($product_order)) {
			switch ( $product_order ) {
				case 'title' : $orderby = 'title'; $order = 'asc'; $meta_key = ''; break;
				case 'price' : $orderby = 'meta_value_num'; $order = 'asc'; $meta_key = '_price'; break;
				case 'date'  : $orderby = 'date'; $order = 'desc'; $meta_key = '';  break;
				case 'popularity' : $orderby = 'meta_value_num'; $order = 'desc'; $meta_key = 'total_sales'; break;
				case 'menu_order':
				default : $orderby = 'menu_order title'; $order = 'asc'; $meta_key = ''; break;
			}
		}

		if(!empty($product_count) && is_numeric($product_count)) {
			$shopme_config['shop_overview_product_count'] = (int) $product_count;
		}

		if (!empty($product_sort)) {
			switch ( $product_sort ) {
				case 'desc' : $order = 'desc'; break;
				case 'asc' : $order = 'asc'; break;
				default : $order = 'asc'; break;
			}
		}

		if (isset($orderby)) $args['orderby'] = $orderby;
		if (isset($order)) 	$args['order'] = $order;

		if (!empty($meta_key)) {
			$args['meta_key'] = $meta_key;
		}

		$shopme_config['woocommerce']['product_sort'] = $args['order'];

		return $args;
	}

	add_action( 'woocommerce_get_catalog_ordering_args', 'shopme_overwrite_catalog_ordering');

}


if (!function_exists('shopme_woocommerce_output_product_content')) {
	function shopme_woocommerce_output_product_content() {
		echo '<section class="section_offset">';
			echo do_shortcode(str_replace(']]>', ']]&gt;', apply_filters('the_content', get_the_content())));
		echo '</section>';
	}
}

if (!function_exists('shopme_woocommerce_output_product_data_tabs')) {
	function shopme_woocommerce_output_product_data_tabs() {
		echo '<div class="clear"></div>';
		woocommerce_output_product_data_tabs();
	}
}

if (!function_exists('shopme_woocommerce_output_related_products')) {
	function shopme_woocommerce_output_related_products() {
		global $shopme_config;

		$shopme_config['shop_single_column'] = ($shopme_config['sidebar_position'] != 'no_sidebar') ? 4 : 5; // columns for related products
		$shopme_config['shop_single_column_items'] = shopme_custom_get_option('shop_single_column_items'); // number of items for related products

		ob_start();

		woocommerce_related_products(
			array(
				'columns' => $shopme_config['shop_single_column'],
				'posts_per_page' => $shopme_config['shop_single_column_items']
			)
		);

		$content = ob_get_clean(); ?>

		<?php if ($content): ?>
			<?php echo $content; ?>
		<?php endif;
	}
}

if ( !function_exists('shopme_wc_template_loop_add_to_cart') ) {
	function shopme_wc_template_loop_add_to_cart( $product, $args = array() ) {
		if ( $product ) {
			$defaults = array(
				'quantity' => 1,
				'class'    => implode( ' ', array_filter( array(
					'button',
					'product_type_' . $product->product_type,
					$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
					$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : ''
				) ) )
			);

			$args = wp_parse_args( $args, $defaults );

			extract($args);

			echo sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( isset( $quantity ) ? $quantity : 1 ),
				esc_attr( $product->id ),
				esc_attr( $product->get_sku() ),
				esc_attr( isset( $class ) ? $class : 'button' ),
				esc_html( $product->add_to_cart_text() )
			);

		}
	}

}

if (!function_exists('shopme_dropdown_categories')) {

	function shopme_dropdown_categories( $args = '' ) {
		$defaults = array(
			'show_option_all' => '', 'show_option_none' => '',
			'orderby' => 'id', 'order' => 'ASC',
			'show_count' => 0,
			'hide_empty' => 1, 'child_of' => 0,
			'exclude' => '', 'echo' => 1,
			'selected' => 0, 'hierarchical' => 0,
			'name' => 'cat', 'id' => '',
			'class' => 'postform', 'depth' => 0,
			'tab_index' => 0, 'taxonomy' => 'category',
			'hide_if_empty' => false, 'option_none_value' => -1,
			'value_field' => 'term_id',
		);

		$defaults['selected'] = ( is_category() ) ? get_query_var( 'cat' ) : 0;

		// Back compat.
		if ( isset( $args['type'] ) && 'link' == $args['type'] ) {
			/* translators: 1: "type => link", 2: "taxonomy => link_category" alternative */
			_deprecated_argument( __FUNCTION__, '3.0',
				sprintf( __( '%1$s is deprecated. Use %2$s instead.' ),
					'<code>type => link</code>',
					'<code>taxonomy => link_category</code>'
				)
			);
			$args['taxonomy'] = 'link_category';
		}

		$r = wp_parse_args( $args, $defaults );
		$option_none_value = $r['option_none_value'];

		if ( ! isset( $r['pad_counts'] ) && $r['show_count'] && $r['hierarchical'] ) {
			$r['pad_counts'] = true;
		}

		$tab_index = $r['tab_index'];

		$tab_index_attribute = '';
		if ( (int) $tab_index > 0 ) {
			$tab_index_attribute = " tabindex=\"$tab_index\"";
		}

		$get_terms_args = $r;
		unset( $get_terms_args['name'] );
		$categories = get_terms( $r['taxonomy'], $get_terms_args );

		$name = esc_attr( $r['name'] );
		$class = esc_attr( $r['class'] );
		$id = $r['id'] ? esc_attr( $r['id'] ) : $name;

		if ( ! $r['hide_if_empty'] || ! empty( $categories ) ) {
			$output = "<select name='$name' id='$id' class='$class' $tab_index_attribute>\n";
		} else {
			$output = '';
		}
		if ( empty( $categories ) && ! $r['hide_if_empty'] && ! empty( $r['show_option_none'] ) ) {
			$show_option_none = apply_filters( 'list_cats', $r['show_option_none'] );
			$output .= "\t<option value='" . esc_attr( $option_none_value ) . "' selected='selected'>$show_option_none</option>\n";
		}

		if ( ! empty( $categories ) ) {

			if ( $r['show_option_all'] ) {

				/** This filter is documented in wp-includes/category-template.php */
				$show_option_all = apply_filters( 'list_cats', $r['show_option_all'] );
				$selected = ( '0' === strval($r['selected']) ) ? " selected='selected'" : '';
				$output .= "\t<option value=''$selected>$show_option_all</option>\n";
			}

			if ( $r['show_option_none'] ) {

				/** This filter is documented in wp-includes/category-template.php */
				$show_option_none = apply_filters( 'list_cats', $r['show_option_none'] );
				$selected = selected( $option_none_value, $r['selected'], false );
				$output .= "\t<option value='" . esc_attr( $option_none_value ) . "'$selected>$show_option_none</option>\n";
			}

			if ( $r['hierarchical'] ) {
				$depth = $r['depth'];  // Walk the full depth.
			} else {
				$depth = -1; // Flat.
			}
			$output .= walk_category_dropdown_tree( $categories, $depth, $r );
		}

		if ( ! $r['hide_if_empty'] || ! empty( $categories ) ) {
			$output .= "</select>\n";
		}

		$output = apply_filters( 'wp_dropdown_cats', $output, $r );

		if ( $r['echo'] ) {
			echo $output;
		}
		return $output;
	}

}

if ( !function_exists('shopme_get_terms') ) {
	function shopme_get_terms($taxonomy, $hide_empty = true, $get_childs = true, $selected = 0, $category_parent = 0) {

		$args = array(
			'orderby' => 'name',
			'order' => 'ASC',
			'style' => 'list',
			'show_count' => 0,
			'hide_empty' => $hide_empty,
			'use_desc_for_title' => 1,
			'child_of' => 0,
			'hierarchical' => true,
			'title_li' => '',
			'show_option_none' => '',
			'number' => '',
			'echo' => 0,
			'depth' => 0,
			'current_category' => $selected,
			'pad_counts' => 0,
			'taxonomy' => $taxonomy,
			'walker' => 'Walker_Category');

		$cats_objects = get_categories($args);

		$cats = array();
		if ( !empty($cats_objects) ) {
			foreach ( $cats_objects as $value ) {
				if ( is_object($value) AND $value->category_parent == $category_parent ) {
					$cats[$value->term_id] = array();
					$cats[$value->term_id]['term_id'] = $value->term_id;
					$cats[$value->term_id]['slug'] = $value->slug;
					$cats[$value->term_id]['taxonomy'] = $value->taxonomy;
					$cats[$value->term_id]['name'] = $value->name;
					$cats[$value->term_id]['count'] = $value->count;
					$cats[$value->term_id]['parent'] = $value->parent;

					if ( $get_childs ) {
						$cats[$value->term_id]['childs'] = shopme_assemble_terms_childs($cats_objects, $value->term_id);
					}
				}
			}
		}

		return $cats;
	}
}

if ( !function_exists('shopme_assemble_terms_childs') ) {

	function shopme_assemble_terms_childs($cats_objects, $parent_id) {

		$res = array();

		foreach ($cats_objects as $value) {

			if ($value->category_parent == $parent_id) {
				$res[$value->term_id]['term_id'] = $value->term_id;
				$res[$value->term_id]['name'] = $value->name;
				$res[$value->term_id]['slug'] = $value->slug;
				$res[$value->term_id]['count'] = $value->count;
				$res[$value->term_id]['taxonomy'] = $value->taxonomy;
				$res[$value->term_id]['parent'] = $value->parent;
				$res[$value->term_id]['childs'] = shopme_assemble_terms_childs($cats_objects, $value->term_id);
			}

		}

		return $res;
	}
}

if ( !function_exists('shopme_draw_select_childs') ) {

	function shopme_draw_select_childs($childs, $value, $level) {
		?>
		<?php foreach ( $childs as $term ) : ?>
			<option class="level-<?php echo esc_attr($level) ?>" value="<?php echo esc_attr($term['term_id']) ?>" <?php echo selected($term['term_id'], $value) ?>><?php echo esc_html($term['name']); echo sprintf(' (%s)', $term['count']); ?></option>
		<?php

		if ( !empty($term['childs']) ) {
			shopme_draw_select_childs( $term['childs'], $value, $level + 1 );
		}

		?>
	<?php endforeach;
	}

}



