<?php

if (!class_exists('SHOPME_CATALOG_ORDERING')) {

	class SHOPME_CATALOG_ORDERING {

		public $filter = true;

		function __construct($filter) {

			$this->filter = $filter;

		}

		public function woo_build_query_string ($params = array(), $key, $value) {
			$params[$key] = $value;
			$paged = (array_key_exists('product_count', $params)) ? 'paged=1&' : '';
			return "?" . $paged . http_build_query($params);
		}

		public function woo_active_class($key1, $key2) {
			if ($key1 == $key2) return " class='selected'";
		}

		public function output_html_with_filter() {

			parse_str($_SERVER['QUERY_STRING'], $params);

			$per_page = shopme_custom_get_option('woocommerce_product_count');

			if (!$per_page) {
				$per_page = get_option('posts_per_page');
			}

			$product_order = array();
			$product_order['menu_order'] = esc_html__("Default", 'shopme');
			$product_order['popularity'] = esc_html__("Popularity", 'shopme');
			$product_order['rating'] 	 = esc_html__("Rating", 'shopme');
			$product_order['date'] 		 = esc_html__("Date", 'shopme');
			$product_order['price'] 	 = esc_html__("Price", 'shopme');

			$per_page_string = '<span class="products-per-page">'. esc_html__("Products per page", 'shopme') .'</span>';

			$product_order_key = !empty($params['orderby']) ? $params['orderby'] : 'menu_order';
			$product_count_key = !empty($params['product_count']) ? $params['product_count'] : $per_page;

			$product_sort_key =  !empty($params['product_sort']) ? $params['product_sort'] : 'ASC';
			$product_sort_key = strtolower($product_sort_key);

			$rotate_transform = shopme_custom_get_option('shop_rotate_transform', 1);

			ob_start(); ?>

			<div class="v_centered">

				<span><?php esc_html_e('Sort by', 'shopme') ?>:</span>

				<div class="dropdown-list sort-param sort-param-order">

					<span class="active_option open_select"><?php echo $product_order[$product_order_key] ?></span>

					<ul class="options_list dropdown <?php if (!$rotate_transform): ?>off_rotate_transform<?php endif; ?>">
						<li class="animated_item">
							<a <?php echo $this->woo_active_class($product_order_key, 'menu_order'); ?> data-order="menu_order" href="javascript:void(0)"><?php echo $product_order['menu_order'] ?></a>
						</li>
						<li class="animated_item">
							<a <?php echo $this->woo_active_class($product_order_key, 'popularity'); ?> data-order="popularity" href="javascript:void(0)"><?php echo $product_order['popularity'] ?></a>
						</li>

						<?php if ( get_option( 'woocommerce_enable_review_rating' ) != 'no' ): ?>
							<li class="animated_item">
								<a <?php echo $this->woo_active_class($product_order_key, 'rating'); ?> data-order="rating" href="javascript:void(0)"><?php echo $product_order['rating'] ?></a>
							</li>
						<?php endif; ?>

						<li class="animated_item">
							<a <?php echo $this->woo_active_class($product_order_key, 'date'); ?> data-order="date" href="javascript:void(0)"><?php echo $product_order['date'] ?></a>
						</li>
						<li class="animated_item">
							<a <?php echo $this->woo_active_class($product_order_key, 'price'); ?> data-order="price" href="javascript:void(0)"><?php echo $product_order['price'] ?></a>
						</li>

					</ul>

				</div><!--/ .sort-param-->

			</div>

			<div class="v_centered">

				<div class="sort-param order-param-button">
					<a title="<?php esc_html_e('Click to order products', 'shopme') ?>" data-sort="<?php echo esc_attr($product_sort_key) ?>" class="order-param-<?php echo sanitize_html_class($product_sort_key) ?>"  href="javascript:void(0)"></a>
				</div><!--/ .sort-param-->

			</div>

			<div class="v_centered">

				<span><?php esc_html_e('Show', 'shopme') ?>:</span>

				<div class="dropdown-list sort-param sort-param-count">

					<span class="active_option open_select"><?php echo esc_html($product_count_key) . ' ' . $per_page_string ?></span>

					<ul class="options_list dropdown <?php if (!$rotate_transform): ?>off_rotate_transform<?php endif; ?>">
						<li class="animated_item">
							<a <?php echo $this->woo_active_class($product_count_key, $per_page); ?> data-count="<?php echo esc_attr($per_page) ?>" href="javascript:void(0)"><?php echo (int) esc_html($per_page) . ' ' . $per_page_string ?></a>
						</li>
						<li class="animated_item">
							<a <?php echo $this->woo_active_class($product_count_key, $per_page * 2); ?> data-count="<?php echo esc_attr($per_page * 2) ?>" href="javascript:void(0)"><?php echo (int) esc_html($per_page * 2) . ' ' . $per_page_string ?></a>
						</li>
						<li class="animated_item">
							<a <?php echo $this->woo_active_class($product_count_key, $per_page * 3); ?> data-count="<?php echo esc_attr($per_page * 3) ?>" href="javascript:void(0)"><?php echo (int) esc_html($per_page * 3) . ' ' . $per_page_string ?></a>
						</li>
					</ul>

				</div><!--/ .sort-param-->

			</div>

			<?php return ob_get_clean();
		}

		public function output_html_without_filter() {

			global $shopme_config;
			parse_str($_SERVER['QUERY_STRING'], $params);

			$per_page = shopme_custom_get_option('woocommerce_product_count');

			if (!$per_page) {
				$per_page = get_option('posts_per_page');
			}

			$product_order = array();
			$product_order['menu_order'] = esc_html__("Default", 'shopme');
			$product_order['popularity'] = esc_html__("Popularity", 'shopme');
			$product_order['rating'] 	 = esc_html__("Rating", 'shopme');
			$product_order['date'] 		 = esc_html__("Date", 'shopme');
			$product_order['price'] 	 = esc_html__("Price", 'shopme');

			$product_sort['asc'] = __("Click to order products ascending",  'shopme');
			$product_sort['desc'] = __("Click to order products descending",  'shopme');

			$per_page_string = '<span class="products-per-page">'. esc_html__("Products per page", 'shopme') .'</span>';

			$product_order_key = !empty($shopme_config['woocommerce']['product_order']) ? $shopme_config['woocommerce']['product_order'] : 'menu_order';
			$product_sort_key = !empty($shopme_config['woocommerce']['product_sort'])  ? $shopme_config['woocommerce']['product_sort'] : 'asc';
			$product_count_key = !empty($shopme_config['woocommerce']['product_count']) ? $shopme_config['woocommerce']['product_count'] : $per_page;

			$product_sort_key = strtolower($product_sort_key);

			ob_start(); ?>

			<div class="v_centered">

				<span><?php esc_html_e('Sort by', 'shopme') ?>:</span>

				<div class="dropdown-list sort-param sort-param-order">

					<span class="active_option open_select"><?php echo $product_order[$product_order_key] ?></span>

					<ul class="options_list dropdown">
						<li class="animated_item">
							<a <?php echo $this->woo_active_class($product_order_key, 'menu_order'); ?> href="<?php echo $this->woo_build_query_string($params, 'product_order', 'menu_order') ?>"><?php echo $product_order['menu_order'] ?></a>
						</li>
						<li class="animated_item">
							<a <?php echo $this->woo_active_class($product_order_key, 'popularity'); ?> href="<?php echo $this->woo_build_query_string($params, 'product_order', 'popularity') ?>"><?php echo $product_order['popularity'] ?></a>
						</li>

						<?php if ( get_option( 'woocommerce_enable_review_rating' ) != 'no' ): ?>
							<li class="animated_item">
								<a <?php echo $this->woo_active_class($product_order_key, 'rating'); ?> href="<?php echo $this->woo_build_query_string($params, 'product_order', 'rating') ?>"><?php echo $product_order['rating'] ?></a>
							</li>
						<?php endif ?>

						<li class="animated_item">
							<a <?php echo $this->woo_active_class($product_order_key, 'date'); ?> href="<?php echo $this->woo_build_query_string($params, 'product_order', 'date') ?>"><?php echo $product_order['date'] ?></a>
						</li>
						<li class="animated_item">
							<a <?php echo $this->woo_active_class($product_order_key, 'price'); ?> href="<?php echo $this->woo_build_query_string($params, 'product_order', 'price') ?>"><?php echo $product_order['price'] ?></a>
						</li>
					</ul>

				</div><!--/ .sort-param-->

			</div>

			<div class="v_centered">

				<div class="sort-param order-param-button">

					<?php if ($product_sort_key == 'desc'): ?>
						<a title="<?php esc_attr_e($product_sort['asc']) ?>" class="order-param-asc"  href="<?php echo $this->woo_build_query_string($params, 'product_sort', 'asc') ?>"></a>
					<?php endif; ?>

					<?php if ($product_sort_key == 'asc'): ?>
						<a title="<?php esc_attr_e($product_sort['desc']) ?>" class="order-param-desc"  href="<?php echo $this->woo_build_query_string($params, 'product_sort', 'desc') ?>"></a>
					<?php endif; ?>

				</div><!--/ .sort-param-->

			</div>

			<div class="v_centered">

				<span><?php esc_html_e('Show', 'shopme') ?>:</span>

				<div class="dropdown-list sort-param sort-param-count">

					<span class="active_option open_select"><?php echo esc_html($product_count_key) . ' ' . $per_page_string ?></span>

					<ul class="options_list dropdown">
						<li class="animated_item">
							<a <?php echo $this->woo_active_class($product_count_key, $per_page); ?> href="<?php echo $this->woo_build_query_string($params, 'product_count', $per_page) ?>"><?php echo (int) esc_html($per_page) . ' ' . $per_page_string ?></a>
						</li>
						<li class="animated_item">
							<a <?php echo $this->woo_active_class($product_count_key, $per_page * 2); ?> href="<?php echo $this->woo_build_query_string($params, 'product_count', $per_page * 2) ?>"><?php echo (int) esc_html($per_page * 2) . ' ' . $per_page_string ?></a>
						</li>
						<li class="animated_item">
							<a <?php echo $this->woo_active_class($product_count_key, $per_page * 3); ?> href="<?php echo $this->woo_build_query_string($params, 'product_count', $per_page * 3) ?>"><?php echo (int) esc_html($per_page * 3) . ' ' . $per_page_string ?></a>
						</li>
					</ul>

				</div><!--/ .sort-param-->

			</div>

			<?php return ob_get_clean();
		}

		public function output() {

			ob_start(); ?>

			<header class="shop-page-meta top_box on_the_sides">

				<div class="left_side clearfix v_centered">
					<?php echo ($this->filter == true) ? $this->output_html_with_filter() : $this->output_html_without_filter(); ?>
				</div>

				<div class="right_side">

					<?php
						$shop_view = shopme_get_meta_value('shop_view');
						if (empty($shop_view)) { $shop_view = 'view-grid'; }
					?>

					<!-- - - - - - - - - - - - - - Product layout type - - - - - - - - - - - - - - - - -->

					<div class="layout_type list-or-grid">
						<a href="#" data-view="view-grid" class="<?php if ($shop_view == 'view-grid'): ?>active<?php endif ?> tooltip_container"><i class="icon-th"></i><span class="tooltip top"><?php esc_html_e('Grid View', 'shopme') ?></span></a>
						<a href="#" data-view="list_view_products" class="<?php if ($shop_view == 'list_view_products'): ?>active<?php endif ?> tooltip_container"><i class="icon-th-list"></i><span class="tooltip top"><?php esc_html_e('List View', 'shopme') ?></span></a>
					</div>

					<!-- - - - - - - - - - - - - - End of product layout type - - - - - - - - - - - - - - - - -->

				</div>

			</header><!--/ .shop-page-meta-->

			<?php return ob_get_clean();
		}

	}
}

?>
