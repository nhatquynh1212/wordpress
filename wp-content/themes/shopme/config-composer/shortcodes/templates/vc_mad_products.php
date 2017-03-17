<?php

class WPBakeryShortCode_VC_mad_products extends WPBakeryShortCode {

	public $atts = array();
	public $products = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' 	 => '',
			'type' 		 => 'view-grid',
			'layout' 	 => 'type_2',
			'categories' => '',
			'add_featured' => '',
			'add_bestsellers' => '',
			'add_new' => '',
			'add_sale' => '',
			'columns' 	 => 3,
			'items' 	 => 6,
			'sort' 		 => '',
			'highlight_product' => 0,
			'orderby' => '',
			'order' => 'desc',
			'product_id' => '',
			'by_id' => '',
			'show' => '',
			'taxonomy' => 'product_cat',
			'filter' 	 => '',
			'filter_style' => 'filter_style_1',
			'visible_all_item' => 0,
			'filter_logic' => 'filter_cat',
			'pagination' => 'no',
			'link' => '',
			'css_animation' => '',
			'operator' => 'IN'
		), $atts, 'vc_mad_products');

		global $woocommerce;
		if ( !is_object($woocommerce) || !is_object($woocommerce->query) ) return;

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

		$params = $this->atts;
		$number = $params['items'];
		$orderby = $params['orderby'];
		$order = $params['order'];
		$show = $params['show'];

		// Meta query
		$tax_query = array();
		$meta_query = WC()->query->get_meta_query();

		if ( !empty($params['categories']) ) {

			$categories = explode(',', $params['categories']);

			if ( is_array($categories) ) {
				$categories = $categories;
			} else {
				$categories = array($categories);
			}

			$tax_query = array(
				'relation' => 'AND',
					array(
						'taxonomy' => 'product_cat',
						'field' => 'id',
						'terms' => $categories
					)
			);
		}

		$query = array(
			'post_type' 	 => 'product',
			'post_status' 	 => 'publish',
			'ignore_sticky_posts'	=> 1,
			'posts_per_page' => $number,
			'order'   		 => $order == 'asc' ? 'asc' : 'desc',
			'meta_query' 	 => $meta_query,
			'tax_query' 	 => $tax_query
		);
//
//		if ( $params['type'] == 'owl_carousel' ) {
//			if ( $params['filter'] == 'yes' ) {
//				if ( isset($params['categories']) && !empty($params['categories']) && is_string($params['categories']) ) {
//					$array_cats = $this->stringToArray( $params['categories'] );
//					if ( is_array($array_cats) ) {
//
//						$count = count($array_cats);
//
//						if (absint($count)) {
//							$query['posts_per_page'] = $number * $count;
//						}
//					}
//				}
//			}
//		}

		if ( !empty($params['by_id']) ) {
			$in = $not_in = array();
			$by_ids = $params['by_id'];
			$ids = $this->stringToArray( $by_ids );

			foreach ( $ids as $id ) {
				$id = (int) $id;
				if ( $id < 0 ) {
					$not_in[] = abs( $id );
				} else {
					$in[] = $id;
				}
			}
			$query['post__in'] = $in;
			$query['post__not_in'] = $not_in;
		}

		if ( $params['pagination'] == 'yes' ) {
			$paged = get_query_var( 'page' ) ? get_query_var( 'page' ) : ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 );
			$query['paged'] = $paged;
		}

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
			case 'toprated':
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
		if (empty($title)) return '';
		return "<h3 class='product-title'>". esc_html($title) ."</h3>";
	}

	protected function sort_cat_links($products, $params) {

		$get_categories = get_categories(array(
			'taxonomy'	 => $params['taxonomy'],
			'hide_empty' => 0
		));

		$current_cats = $current_parents = array();

		foreach ($products->posts as $entry) {
			if ($current_item_cats = get_the_terms( $entry->ID, $params['taxonomy'] )) {

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

			<?php if ($params['visible_all_item']): ?>
				<li class="active"><button class="all-filter" data-filter="*" value="All"><?php esc_html_e('All', 'shopme') ?></button></li>
			<?php endif; ?>

			<?php foreach ($get_categories as $category):

				$nicename = str_replace('%', '', $category->category_nicename); ?>

				<?php if (in_array($category->term_id, $current_cats)): ?>
					<li><button data-filter="<?php echo esc_attr($nicename) ?>"><?php echo esc_html(trim($category->cat_name)) ?></button></li>
				<?php endif; ?>

			<?php endforeach; ?>

		</ul><!--/ .product-filter-->

		<?php return ob_get_clean();
	}

	protected function sort_choose_links($params) {

		ob_start() ?>

		<ul class="product-filter type-2 clearfix">

			<li class="active"><button class="all-filter" data-filter="*" value="All"><?php esc_html_e('All', 'shopme') ?></button></li>

			<?php if ($params['add_featured']): ?>
				<li><button data-filter="featured"><?php esc_html_e('Featured', 'shopme'); ?></button></li>
			<?php endif; ?>

			<?php if ($params['add_new']): ?>
				<li><button data-filter="new-badge"><?php esc_html_e('New', 'shopme'); ?></button></li>
			<?php endif; ?>

			<?php if ($params['add_sale']): ?>
				<li><button data-filter="sale"><?php esc_html_e('Sale', 'shopme'); ?></button></li>
			<?php endif; ?>

		</ul><!--/ .product-filter-->

		<?php return ob_get_clean();
	}

	public function add_filter_classes($params) {
		if ($params['filter'] == 'yes') {
			add_filter('post_class', array(&$this, 'post_class_filter'));

			if ($params['add_new'] == 'yes') {
				add_filter('post_class', array(&$this, 'post_new_filter'));
			}
		}
	}

	public function post_class_filter($classes) {
		$classes[] = str_replace('%', '', self::getTermsCat(get_the_ID()));
		return $classes;
	}

	public function post_new_filter($classes) {
		$postdate 		= get_the_time( get_option( 'date_format' ) );			// Post date
		$postdatestamp 	= strtotime( $postdate );			// Timestamped post date
		$newness 		= get_option( 'wc_nb_newness' ); 	// Newness in days as defined by option
		if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) {
			$classes[] = 'new-badge';
		}
		return $classes;
	}

	public function getTermsCat($id) {
		$classes = "";
		$item_categories = get_the_terms($id, 'product_cat');
		if (is_object($item_categories) || is_array($item_categories)) {
			foreach ($item_categories as $cat) {
				$classes .= $cat->slug . ' ';
			}
		}
		return $classes;
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

		if (empty($this->products) || empty($this->products->posts)) return;

		$products = $this->products;
		$params = $this->atts;
		$atts = array();

		$title = $type = $layout = $columns = $highlight_product = $product_id = $filter = $filter_style = $filter_logic = $pagination = $link = $animation_class = $highlight_class = $pagination_class = $filter_style_class = $bottom_box_class = $css_animation = $animation_delay = '';

		extract($params);

		$shop_columns = 'shop-columns-' . $columns;
		$atts['columns'] = $columns;

		if ($filter == 'yes')
			$filter_style_class = $this->getExtraClass($filter_style);

		$link = ($link == '||') ? '' : $link;
		$link = vc_build_link($link);
		$a_href = $link['url'];
		$a_title = $link['title'];
		($link['target'] != '') ? $a_target = $link['target'] : $a_target = '_self';

		if ($type == 'owl_carousel') {
			$atts['sidebar'] = SHOPME_HELPER::template_layout_class('sidebar_position');
		}

		ob_start();

		if ( $products->have_posts() ) : ?>

			<?php
				if ($css_animation != '') {
					$atts['animation'] = $css_animation;
					$animation_class = $this->getExtraClass('animated');
					if (!empty($animation_delay)) {
						$atts['animation-delay'] = $animation_delay;
					}
				}

				if ($highlight_product)
					$highlight_class = 'with_main_product';

				if ($pagination == 'yes')
					$pagination_class = 'with-pagination';

				if (!empty($a_href))
					$bottom_box_class = 'has_bottom_box';

				$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'products-container view-grid ' . $shop_columns . ' ' . $type . ' ' . $layout . ' ' . $highlight_class . ' ' . $pagination_class . ' '  . $bottom_box_class . ' ' . $filter_style_class . $animation_class, $this->settings['base'], $params );
			?>

			<div <?php echo esc_attr($this->create_data_string($atts)); ?> class="<?php echo esc_attr($css_class) ?>">

				<?php if ($filter_style == 'filter_style_2'): ?>
					<?php echo $this->entry_title($title); ?>
				<?php endif; ?>

				<div class="products-wrap">

					<div class="product-holder">

						<?php if ( $filter_style == 'filter_style_1' ): ?>
							<?php echo $this->entry_title($title); ?>
						<?php endif; ?>

						<?php if ( $filter == 'yes' ): ?>

							<?php if ($filter_logic == 'filter_cat'): ?>
								<?php echo $this->sort_cat_links($products, $params); ?>
							<?php endif; ?>

							<?php if ($filter_logic == 'filter_choose'): ?>
								<?php echo $this->sort_choose_links($params); ?>
							<?php endif; ?>

						<?php endif; ?>

					</div><!--/ .product-holder-->

					<?php if ($highlight_product): ?>

						<?php if (is_numeric($product_id)): $main_product = new WC_Product($product_id); ?>

							<?php if ( $main_product ): ?>

								<div class="clear"></div>

								<div class="main_product">

									<div class="product-inner">

										<h3 class="title">
											<a href="<?php echo esc_url(get_the_permalink($main_product->id)) ?>"><b><?php echo $main_product->get_title(); ?></b></a>
										</h3>

										<div class="product_tags">
											<?php echo $main_product->get_categories(); ?>
										</div>

										<div class="main_product_image">
											<?php echo $main_product->get_image($product_id); ?>
										</div>

										<div class="main_product_excerpt">
											<?php if (has_excerpt($product_id)): ?>
												<p><?php echo shopme_string_truncate($main_product->post->post_excerpt, 100, " ", "..."); ?></p>
											<?php endif; ?>

											<?php if (!empty($a_href)): ?>
												<a href="<?php echo esc_url($a_href) ?>" target="<?php echo esc_attr($a_target) ?>" class="button_blue middle_btn"><?php echo esc_html($a_title) ?></a>
											<?php endif; ?>
										</div>

										<div class="clear"></div>

									</div>

								</div><!--/ .main_product-->

							<?php endif; ?>

						<?php endif; ?>

					<?php endif; ?>

					<?php if ($highlight_product): ?>
						<div class="main_product_column">
					<?php endif; ?>

						<?php woocommerce_product_loop_start(); ?>

						<?php while ( $products->have_posts() ) : $products->the_post(); ?>

							<?php $this->add_filter_classes($params); ?>
							<?php wc_get_template('content-product.php', $params) ?>

						<?php endwhile; // end of the loop. ?>

						<?php woocommerce_product_loop_end(); ?>

					<?php if ($highlight_product): ?>
						</div>
					<?php endif; ?>

					<?php if ($highlight_product): ?>
						<div class="clear"></div>
					<?php endif; ?>

					<?php if (!$highlight_product): ?>

						<?php if (!empty($a_href)): ?>
							<footer class="bottom_box">
								<a href="<?php echo esc_url($a_href) ?>" target="<?php echo esc_attr($a_target) ?>" class="button_grey middle_btn"><?php echo esc_html($a_title) ?></a>
							</footer>
						<?php endif; ?>

					<?php endif; ?>

				</div><!--/ .products-wrap-->

				<?php if ( $pagination == 'yes' && $filter == '' ): ?>
					<?php echo shopme_pagination($this->products); ?>
				<?php endif; ?>

			</div><!--/ .products-container-->

		<?php else : ?>

			<?php if (!woocommerce_product_subcategories(array('before' => '<ul class="products">', 'after' => '</ul>' ))) : ?>
				<div class="woocommerce-error">
					<div class="messagebox_text">
						<p><?php esc_html_e( 'No products found which match your selection.', 'shopme' ) ?></p>
					</div><!--/ .messagebox_text-->
				</div><!--/ .woocommerce-error-->
			<?php endif; ?>

		<?php endif; ?>

		<?php
			woocommerce_reset_loop();
			wp_reset_postdata();
		?>

		<?php return ob_get_clean();
	}

}