<?php

class WPBakeryShortCode_VC_mad_products_page_carousel extends WPBakeryShortCode {

	public $atts = array();
	public $products = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' 	 => '&nbsp;',
			'title_color' => '',
			'items' 	 => 6,
			'show' => '',
			'orderby' => '',
			'order' => '',
			'by_id' => '',
			'categories' => '',
			'link' => '',
			'css_animation' => ''
		), $atts, 'vc_mad_products_page_carousel');

		global $woocommerce;
		if (!is_object($woocommerce) || !is_object($woocommerce->query)) return;

		$this->query();

		remove_action('woocommerce_before_single_product', 'wc_print_notices', 10);
		remove_action('woocommerce_after_single_product_summary', 'shopme_woocommerce_output_product_content', 25);
		remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 27);
		remove_action('woocommerce_after_single_product_summary', 'shopme_woocommerce_output_product_data_tabs', 26);
		remove_action('woocommerce_after_single_product_summary', 'shopme_woocommerce_output_related_products', 28);
		remove_action('woocommerce_after_single_product_summary', 'shopme_woocommerce_other_products', 29);
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

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
		$orderby = sanitize_title ( $params['orderby'] );
		$order = sanitize_title( $params['order'] );
		$show = $params['show'];

		// Meta query
		$meta_query = $tax_query = array();
		$meta_query[] = $woocommerce->query->visibility_meta_query();
		$meta_query[] = $woocommerce->query->stock_status_meta_query();
		$meta_query = array_filter($meta_query);

		if (!empty($params['categories'])) {
			$categories = explode(',', $params['categories']);

			if (is_array($categories)) {
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
			'order'   		 => $order == 'asc' ? 'asc' : 'desc',
			'meta_query' 	 => $meta_query,
			'tax_query' 	 => $tax_query,
			'posts_per_page' => $number
		);

		if (!empty($params['by_id'])) {
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
					$query['orderby']  = 'date';
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

		if ($show == 'toprated')
			add_filter( 'posts_clauses', array( WC()->query , 'order_by_rating_post_clauses' ) );

		$this->single_product = new WP_Query( $query );

		if ($show == 'new')
			remove_filter( 'posts_where', array(&$this, 'filter_where') );

		global $woocommerce_loop;
		$woocommerce_loop['loop'] = 0;

		if ($show == 'toprated')
			remove_filter( 'posts_clauses', array( WC()->query , 'order_by_rating_post_clauses' ) );
	}

	public function filter_where( $where = '' ) {
		$newness = get_option( 'wc_nb_newness' );
		$where .= " AND post_date > '" . date('Y-m-d', strtotime('-'. $newness .' days')) . "'";
		return $where;
	}

	protected function entry_title($title, $title_color) {
		$style = '';

		if (!empty($title_color)) {
			$style = "style='color: {$title_color};'";
		}

		return "<h3 ". $style ." class='product-title'>". esc_html($title) ."</h3>";
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

	public function create_data_string($data = array()) {
		$data_string = "";

		foreach ($data as $key => $value) {
			if (is_array($value)) $value = implode(", ", $value);
			$data_string .= " data-$key={$value} ";
		}
		return $data_string;
	}

	protected function html() {

		if (empty($this->single_product) || empty($this->single_product->posts)) return;

		$single_product = $this->single_product;
		$params = $this->atts;
		$atts = array();

		$title = $title_color = $link = $animation_class = $css_animation = $animation_delay = '';

		extract($params);

		$link = ($link == '||') ? '' : $link;
		$link = vc_build_link($link);
		$a_href = $link['url'];
		$a_title = $link['title'];
		($link['target'] != '') ? $a_target = $link['target'] : $a_target = '_self';

		$atts['sidebar'] = SHOPME_HELPER::template_layout_class('sidebar_position');

		ob_start();

		if ( $single_product->have_posts() ) :

			wp_enqueue_script( 'wc-single-product' );
			?>

			<?php
				if ($css_animation != '') {
					$atts['animation'] = $css_animation;
					$animation_class = $this->getExtraClass('animated');
					if (!empty($animation_delay)) {
						$atts['animation-delay'] = $animation_delay;
					}
				}

				$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'products-container type_1 ' . $animation_class, $this->settings['base'], $params );
			?>

			<div <?php echo esc_attr($this->create_data_string($atts)); ?> class="<?php echo esc_attr($css_class) ?>">

				<div class="products-wrap">

					<div class="product-holder">

						<?php if (!empty($title)): ?>
							<?php echo $this->entry_title($title, $title_color); ?>
						<?php endif; ?>

					</div><!--/ .product-holder-->

					<div class="products_page_carousel">

						<?php while ( $single_product->have_posts() ) : $single_product->the_post(); ?>

							<div class="theme_box clearfix">

								<?php wc_get_template_part( 'content', 'single-product' ); ?>

							</div><!--/ .theme_box-->

						<?php endwhile; // end of the loop.

						wp_reset_postdata(); ?>

					</div><!--/ .products_page_carousel-->

					<?php if (!empty($a_href)): ?>
						<footer class="bottom_box">
							<a href="<?php echo esc_url($a_href) ?>" target="<?php echo esc_attr($a_target) ?>" class="button_grey middle_btn"><?php echo esc_html($a_title) ?></a>
						</footer>
					<?php endif; ?>

				</div><!--/ .products-wrap-->

			</div><!--/ .widgets_carousel-->

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