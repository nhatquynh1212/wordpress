<?php

class WPBakeryShortCode_VC_mad_products_cards extends WPBakeryShortCode {

	public $atts = array();
	public $products = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' 	 => '',
			'type' 		 => 'grid_style',
			'categories' => '',
			'items' 	 => 18,
			'highlight_product' => 0,
			'product_id' => '',
			'orderby' => '',
			'order' => '',
			'show' => '',
			'taxonomy' => 'product_cat'
		), $atts, 'vc_mad_products_cards');

		global $woocommerce;
		if (!is_object($woocommerce) || !is_object($woocommerce->query)) return;

		$this->query();
		return $this->html();
	}

	protected function stringToArray( $value ) {
		$valid_values = array();
		$list = preg_split( '/\,[\s]*/', $value );
		foreach ( $list as $v ) {
			if ( strlen( $v ) > 0 ) {
				$valid_values[] = $v;
			}
		}
		return $valid_values;
	}

	public function query() {
		global $woocommerce;

		$params = $this->atts;
		$number = $params['items'];

		if ( $params['type'] == 'grid_style' ) {
			$number = 4;
		}

		$orderby = sanitize_title( $params['orderby'] );
		$order = sanitize_title( $params['order'] );
		$show = $params['show'];

		// Meta query
		$meta_query = $tax_query = array();
		$meta_query[] = $woocommerce->query->visibility_meta_query();
		$meta_query[] = $woocommerce->query->stock_status_meta_query();
		$meta_query = array_filter($meta_query);

		if ( !empty($params['categories']) ) {

			$categories = $this->stringToArray($params['categories']);

			$tax_query = array(
				'relation' => 'AND',
					array(
						'taxonomy' => 'product_cat',
						'field' => 'id',
						'terms' => $categories[0]
					)
			);
		}

		$query = array(
			'post_type' 	 => 'product',
			'post_status' 	 => 'publish',
			'ignore_sticky_posts' => 1,
			'order'   		 => $order == 'asc' ? 'asc' : 'desc',
			'meta_query' 	 => $meta_query,
			'tax_query' 	 => $tax_query,
			'posts_per_page' => $number
		);

		if ( $orderby != '' ) {
			switch ( $orderby ) {
				case 'price' :
					$query['meta_key'] = '_price';
					$query['orderby']  = 'meta_value_num';
					break;
				case 'rand' :
					$query['orderby']  = 'rand';
					break;
				case 'sales' :
					$query['meta_key'] = 'total_sales';
					$query['orderby']  = 'meta_value_num';
					break;
				default :
					$query['orderby']  = $params['orderby'];
					break;
			}
		} else {
			$query['orderby'] = get_option('woocommerce_default_catalog_orderby');
		}

		switch ( $show ) {
			case 'featured' :
				$query['meta_query'][] = array(
					'key'   => '_featured',
					'value' => 'yes'
				);
				break;
			case 'onsale' :
				$product_ids_on_sale    = wc_get_product_ids_on_sale();
				$product_ids_on_sale[]  = 0;
				$query['post__in'] = $product_ids_on_sale;
				break;
			case 'bestselling':
				$query['ignore_sticky_posts'] = 1;
				$query['meta_key'] = 'total_sales';
				$query['orderby'] = 'meta_value_num';
				break;
			case 'toprated' :
				$query['ignore_sticky_posts'] = 1;
				$query['no_found_rows'] = 1;
				break;
			case 'new':
				add_filter( 'posts_where', array(&$this, 'filter_where') );
				break;
		}

		if ( $show == 'toprated' ) {
			add_filter( 'posts_clauses', array( WC()->query , 'order_by_rating_post_clauses' ) );
		}

		$query = apply_filters( 'shopme_wc_products_cards', $query );
		$this->products = new WP_Query( $query );

		if ( $show == 'new' ) {
			remove_filter( 'posts_where', array(&$this, 'filter_where') );
		}

		global $woocommerce_loop;
		$woocommerce_loop['loop'] = 0;

		if ( $show == 'toprated' ) {
			remove_filter( 'posts_clauses', array( WC()->query , 'order_by_rating_post_clauses' ) );
		}
	}

	public function filter_where( $where = '' ) {
		$newness = get_option( 'wc_nb_newness' );
		$where .= " AND post_date > '" . date('Y-m-d', strtotime('-'. $newness .' days')) . "'";
		return $where;
	}

	protected function entry_title($title) {
		if ( empty($title) ) return '';
		return "<h3 class='product-title'>". esc_html($title) ."</h3>";
	}

	protected function sort_cat_links($products, $params) {

		$get_categories = get_categories(array(
			'taxonomy'	 => $params['taxonomy'],
			'hide_empty' => 0
		));

		$current_cats = $current_parents = array();

		foreach ( $products->posts as $entry ) {

			if ( $current_item_cats = get_the_terms( $entry->ID, $params['taxonomy'] ) ) {

				if (isset($current_item_cats) && !empty($current_item_cats)) {
					foreach ($current_item_cats as $current_item_cat) {
						if (!empty($params['categories'])) {

							$categories = explode(',', $params['categories']);

							if (is_array($categories)) {
								$categories = $categories;
							} else {
								$categories = array($params['categories']);
							}

							if (in_array($current_item_cat->parent, $categories)) {
								$current_parents[$current_item_cat->term_id] = $current_item_cat->term_id;
							}

							if (in_array($current_item_cat->term_id, $categories)) {
								$current_cats[$current_item_cat->term_id] = $current_item_cat->term_id;
							}

						} else {
							$current_cats[$current_item_cat->term_id] = $current_item_cat->term_id;
						}

					}
				}
			}

		}

		$current_cats = array_merge($current_cats, $current_parents);

		ob_start(); ?>

		<ul class="product-filter">

			<?php $i = 0; ?>

			<?php foreach ( $get_categories as $category ):

				if ( in_array($category->term_id, $current_cats) ):

					if ( $i == 0 ) { $css_class = 'class=active'; } else { $css_class = ''; } ?>

					<li <?php echo esc_attr($css_class) ?>><a href="<?php echo get_category_link($category->term_id) ?>"><?php echo esc_html(trim($category->cat_name)) ?></a></li>

					<?php $i++; ?>

				<?php endif; ?>

			<?php endforeach; ?>

		</ul><!--/ .product-filter-->

		<?php return ob_get_clean();
	}

	public function create_data_string($data = array()) {
		$data_string = "";

		foreach ($data as $key => $value) {
			if (is_array($value)) $value = implode(", ", $value);
			$data_string .= " data-$key={$value} ";
		}
		return $data_string;
	}

	protected function html() {

		if ( empty($this->products) || empty($this->products->posts) ) return;

		$title = $type = $highlight_product = $product_id = $columns = '';
		$products = $this->products;
		$params = $this->atts;
		extract($params);

		$css_classes = array(
			'product-cards-carousel',
			'view-grid',
			'type_4',
			'filter_style_1',
			$type
		);

		if ( $highlight_product ) {
			$css_classes[] = 'with_main_product';
		}

		if ( $type == 'owl_carousel' ) {
			$css_classes[] = 'shop-columns-3';
		} elseif( $type == 'grid_style' ) {
			$css_classes[] = 'shop-columns-2';
		}

		ob_start();

		if ( $products->have_posts() ) : ?>

			<div class="<?php echo esc_attr( implode( ' ', array_filter( $css_classes ) ) ); ?>">

				<div class="product-holder">

					<?php echo $this->entry_title($title); ?>

					<?php if ( !empty($categories) ): ?>
						<?php echo $this->sort_cat_links( $products, $params ); ?>
					<?php endif; ?>

				</div>

				<div class="products-wrap">

					<?php if ( $type == 'grid_style' ): ?>

						<?php if ( $highlight_product ): ?>

							<?php if ( is_numeric($product_id) ): $main_product = new WC_Product_Simple( $product_id ); ?>

								<?php if ( $main_product ): ?>

									<div class="main_product product">

										<div class="product-inner">

											<div class="product-image">
												<a href="<?php echo esc_url($main_product->get_permalink()) ?>">
													<?php echo $main_product->get_image($product_id); ?>
												</a>
											</div>

											<a class="product-title" href="<?php echo esc_url($main_product->get_permalink()) ?>"><?php echo $main_product->get_title(); ?></a>

											<div class="clearfix product_info">
												<?php echo $main_product->get_price_html(); ?>
											</div>

											<?php shopme_wc_template_loop_add_to_cart($main_product); ?>
											<div class="clear"></div>
											<?php do_action( 'shopme-product-actions-before', $main_product->get_id() ); ?>
											<?php do_action( 'shopme-product-actions-after', $main_product->get_id() ); ?>

										</div>

									</div><!--/ .main_product-->

								<?php endif; ?>

							<?php endif; ?>

						<?php endif; ?>

						<?php if ( $highlight_product ): ?>
							<div class="main_product_column">
						<?php endif; ?>

							<?php woocommerce_product_loop_start(); ?>

							<?php
								$shop_catalog = wc_get_image_size( 'shop_catalog' );
							?>

							<?php while ( $products->have_posts() ) : $products->the_post(); ?>

								<div <?php post_class('product_item') ?>>

									<div class="product-inner">

										<a href="<?php esc_url(the_permalink()); ?>" class="media-left">
											<?php
											$thumb_image = SHOPME_HELPER::get_the_post_thumbnail( get_the_ID(), $shop_catalog['width'] . '*' . $shop_catalog['height'], $shop_catalog['crop'], array('class' => '', 'alt' => get_the_title()) );
											if ( !$thumb_image ) {
												$thumb_image = wc_placeholder_img( 'shop_catalog' );
											}
											echo $thumb_image;
											?>
										</a>

										<div class="media-body">

											<a class="product-title" href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo shopme_string_truncate(get_the_title(), shopme_custom_get_option('excerpt_count_product_title', 100)) ?></a>

											<div class="clearfix product_info">
												<?php woocommerce_template_loop_price(); ?>
											</div>

											<div class="buttons_row clearfix">
												<?php woocommerce_template_loop_add_to_cart(); ?>
												<div class="clear"></div>
												<?php do_action('shopme-product-actions-before'); ?>
												<?php do_action('shopme-product-actions-after'); ?>
											</div>

										</div>

									</div><!--/ .product-inner-->

								</div>

							<?php endwhile; // end of the loop. ?>

							<?php woocommerce_product_loop_end(); ?>

						<?php if ( $highlight_product ): ?>
							</div>
						<?php endif; ?>

					<?php elseif ( $type == 'owl_carousel' ): ?>

						<?php $i = 1; $j = 0; ?>

						<?php while ( $products->have_posts() ) : $products->the_post(); ?>

							<?php if ( $j == 0 ): ?>
								<?php woocommerce_product_loop_start(); ?>
							<?php endif; ?>

							<div <?php post_class('product_item') ?>>

								<div class="product-inner">

									<a href="<?php echo esc_url(get_the_permalink()); ?>" class="media-left">
										<?php
										$thumb_image = SHOPME_HELPER::get_the_post_thumbnail(get_the_ID(), '150*150', true, array('class' => '', 'alt' => get_the_title()));
										if ( !$thumb_image ) {
											$thumb_image = wc_placeholder_img( 'shop_catalog' );
										}
										echo $thumb_image;
										?>
									</a>

									<div class="media-body">

										<a class="product-title" href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo shopme_string_truncate(get_the_title(), shopme_custom_get_option('excerpt_count_product_title', 100)) ?></a>

										<div class="clearfix product_info">
											<?php woocommerce_template_loop_price(); ?>
										</div>

										<div class="buttons_row clearfix">
											<?php woocommerce_template_loop_add_to_cart(); ?>
											<div class="clear"></div>
											<?php do_action('shopme-product-actions-before'); ?>
											<?php do_action('shopme-product-actions-after'); ?>
										</div>

									</div>

								</div><!--/ .product-inner-->

							</div>

							<?php if ( ($i % 6) == 0 ): ?>
								<?php woocommerce_product_loop_end(); ?>
								<?php $i = $j = 0; ?>
							<?php else: ?>
								<?php $j++; ?>
							<?php endif; ?>

							<?php $i++; ?>

						<?php endwhile; // end of the loop. ?>

						<?php if ( $i > 1 ): ?>
							<?php woocommerce_product_loop_end(); ?>
							<?php $j = 0; ?>
						<?php endif; ?>

					<?php endif; ?>

				</div><!--/ .products-wrap-->

			</div>

		<?php else: ?>

			<?php if ( !woocommerce_product_subcategories(array('before' => '<ul class="products">', 'after' => '</ul>' )) ) : ?>
				<div class="woocommerce-error">
					<div class="messagebox_text">
						<p><?php esc_html_e( 'No products found which match your selection.', 'shopme' ) ?></p>
					</div><!--/ .messagebox_text-->
				</div><!--/ .woocommerce-error-->
			<?php endif; ?>

		<?php endif; ?>

		<?php woocommerce_reset_loop(); wp_reset_postdata(); ?>

		<?php return ob_get_clean();
	}

}