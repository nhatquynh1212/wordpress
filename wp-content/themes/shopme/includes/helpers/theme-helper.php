<?php

if (!class_exists('SHOPME_HELPER')) {

	class SHOPME_HELPER {

		/*	Get Registered Sidebars
		/* ---------------------------------------------------------------------- */

		public static function get_registered_sidebars($sidebars = array(), $exclude = array()) {
			global $wp_registered_sidebars;

			foreach ($wp_registered_sidebars as $sidebar) {
				if (!in_array($sidebar['name'], $exclude)) {
					$sidebars[$sidebar['name']] = $sidebar['name'];
				}
			}
			return $sidebars;
		}

		/*	Check animate widgets
		/* ---------------------------------------------------------------------- */

		public static function check_animate_widgets($post_id) {

			$result = false;

			if (shopme_custom_get_option('animate_widgets_pages')) {
				$result = mad_meta('shopme_animate_widgets', '', $post_id);
			}

			return $result;

		}

		/*	Check page layout
		/* ---------------------------------------------------------------------- */

		public static function check_page_layout ($post_id = false) {
			global $shopme_config;

			$result = false;
			$sidebar_position = 'sidebar_archive_position';

			if (empty($post_id)) $post_id = shopme_post_id();

			if (is_page() || is_search() || is_attachment()) {
				$sidebar_position = 'sidebar_page_position';
			}
			if (is_archive()) {
				$sidebar_position = 'sidebar_archive_position';
			}
			if (is_single()) {
				$sidebar_position = 'sidebar_post_position';
			}
			if (is_singular()) {
				$result = mad_meta('shopme_page_sidebar_position', '', $post_id);
			}
			if (is_404()) {
				$result = 'no_sidebar';
			}
			if (is_post_type_archive('testimonials')) {
				$result = shopme_custom_get_option('sidebar_testimonials_archive_position');
			}
			if (is_post_type_archive('team-members')) {
				$result = shopme_custom_get_option('sidebar_team_members_archive_position');
			}

			if (shopme_is_shop_installed()) {

				if (shopme_is_product()) {
					$result_sidebar_position = mad_meta('shopme_page_sidebar_position', '', $post_id);
					if (empty($result_sidebar_position)) {
						$result = shopme_custom_get_option('sidebar_product_position');
					} else {
						$result = $result_sidebar_position;
					}
				}

				if (is_post_type_archive('product') || shopme_is_product_category() || shopme_is_product_tag()) {

					if (shopme_is_product_category()) {

						$result = shopme_get_meta_value('sidebar_position');

						if (empty($result)) {
							$result = shopme_custom_get_option('sidebar_product_archive_position');
						}

					} else {
						$result = shopme_custom_get_option('sidebar_product_archive_position');
					}

				}
			}

			if (!$result) {
				$result = shopme_custom_get_option($sidebar_position);
			}

			if (!$result) {
				$result = 'sbr';
			}

			if ($result) {
				$shopme_config['sidebar_position'] = $result;
			}
		}

		public static function template_layout_class($key, $echo = false) {
			global $shopme_config;

			if (!isset($shopme_config['sidebar_position'])) { self::check_page_layout(); }

			$return = $shopme_config[$key];

			if ($echo == true) {
				echo $return;
			} else {
				return $return;
			}
		}

		/*	Page type layout
		/* ---------------------------------------------------------------------- */

		public static function page_layout () {
			$post_id = shopme_post_id();

			@$page_layout = mad_meta('shopme_page_layout', '', $post_id);
			if (empty($page_layout)) {
				$page_layout = shopme_custom_get_option('page_layout');
			}
			if (is_post_type_archive('testimonials')) {
				$page_layout = shopme_custom_get_option('testimonials_archive_page_layout');
			}
			if (is_post_type_archive('team-members')) {
				$page_layout = shopme_custom_get_option('team_members_archive_page_layout');
			}
			if (shopme_is_shop_installed()) {

				if (is_post_type_archive('product') || shopme_is_product_category() || shopme_is_product_tag()) {

					if (shopme_is_product_category()) {

						$page_layout = shopme_get_meta_value('page_layout');

						if (empty($page_layout)) {
							$page_layout = shopme_custom_get_option('product_archive_page_layout');
						}

					} else {
						$page_layout = shopme_custom_get_option('product_archive_page_layout');
					}

				}
			}

			return $page_layout;
		}

		/*  Main Navigation
		/* ---------------------------------------------------------------------- */

		public static function main_navigation( $menu_class = 'menu', $theme_location = 'primary' ) {

			$defaults = array(
				'container' => '',
				'menu_class' => $menu_class,
				'theme_location' => $theme_location
			);

			if ( has_nav_menu($theme_location) ) {
				wp_nav_menu( $defaults );
			} else {
				echo '<ul>';
					wp_list_pages('title_li=');
				echo '</ul>';
			}
			echo '<div class="clear"></div>';
		}

		public static function output_widgets_html($view, $data = array()) {
			@extract($data);
			ob_start();
			include(SHOPME_INCLUDES_PATH . 'widgets/templates/' . $view . '.php');
			return ob_get_clean();
		}

		public static function create_atts_string ($data = array()) {
			$atts_string = "";

			foreach ($data as $key => $value) {
				if (is_array($value)) $value = implode(", ", $value);
				$atts_string .= " $key='$value' ";
			}
			return $atts_string;
		}

		public static function get_post_attachment_image($attachment_id, $dimensions, $crop = true) {
			$img_src = wp_get_attachment_image_src($attachment_id, $dimensions);
			$img_src = $img_src[0];
			return self::get_image($img_src, $dimensions, $crop);
		}

		public static function get_post_featured_image($post_id, $dimensions, $crop = true) {
			$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), '');
			$img_src = $img_src[0];
			return self::get_image($img_src, $dimensions, $crop);
		}

		public static function get_image($img_src, $dimensions, $crop = true) {
			if (empty($dimensions)) return $img_src;

			$sizes = explode('*', $dimensions);
			$src = aq_resize($img_src, $sizes[0], $sizes[1], $crop);

			if (!$src) {
				return $img_src;
			}
			return $src;
		}

		public static function get_the_post_thumbnail ($post_id, $dimensions, $crop = true, $thumbnail_atts = array()) {
			$atts = '';
			$sizes = array_filter(explode("*", $dimensions));
			if (is_array($sizes) && !empty($sizes)) {
				$atts = "width={$sizes[0]} height={$sizes[1]}";
			}
			return '<img '. esc_attr($atts) .' src="' . self::get_post_featured_image($post_id, $dimensions, $crop) . '" ' . self::create_atts_string($thumbnail_atts) . ' />';
		}

		public static function get_the_url ($url, $thumbnail_atts = array()) {
			return '<img src="' . esc_url($url) . '" ' . self::create_atts_string($thumbnail_atts) . ' />';
		}

		public static function get_the_thumbnail ($attach_id, $dimensions, $crop = true, $thumbnail_atts = array()) {
			$atts = '';
			$sizes = array_filter(explode("*", $dimensions));
			if (is_array($sizes) && !empty($sizes)) {
				$atts = "width={$sizes[0]} height={$sizes[1]}";
			}
			return '<img '. esc_attr($atts) .' src="' . self::get_post_attachment_image($attach_id, $dimensions, $crop) . '" ' . self::create_atts_string($thumbnail_atts) . ' />';
		}

	}

}

/*	Blog alias
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_blog_alias')) {

	function shopme_blog_alias ($format = 'standard', $image_size = array(), $blog_layout = '') {
		global $shopme_config;
		$sidebar_position = $shopme_config['sidebar_position'];

		if (is_array($image_size) && !empty($image_size)) {
			$alias = $format == 'audio' || $format == 'video' ? $image_size[1] : $image_size[0];
			return $alias;
		}

//		if (is_singular()) {

			switch ($blog_layout) {
				case 'blog-big':
				case 'big_view':
					switch ($format) {
						case 'standard':
						case 'gallery':
							$alias = ($sidebar_position == 'no_sidebar') ? '1140*495' : '805*510';
							break;
						case 'audio':
						case 'video':
							$alias = ($sidebar_position == 'no_sidebar') ? array(1140, 495) : array(805, 510);
							break;
						default:
							$alias = '805*510';
							break;
					}
					return $alias;
				break;
				case 'blog-list':
				case 'list_view':
				case 'blog-grid':
				case 'grid_view':
					switch ($format) {
						case 'standard':
						case 'gallery':
							$alias = ($sidebar_position == 'no_sidebar') ? '380*240' : '380*240';
						break;
						case 'audio':
						case 'video':
							$alias = ($sidebar_position == 'no_sidebar') ? array(380, 240) : array(380, 240);
						break;
						default:
							$alias = '380*240';
							break;
					}
					return $alias;
				break;
			}

//		}

	}
}

/*	Debug function print_r
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_print_r')) {
	function shopme_print_r( $arr ) {
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}
}

/* 	Pagination
/* ---------------------------------------------------------------------- */

if( !function_exists( 'shopme_pagination' ) ) {

	function shopme_pagination( $entries = '', $args = array(), $range = 10 ) {

		global $wp_query;

		if (empty($args['tag'])) $args['tag'] = 'footer';
		if (empty($args['class'])) $args['class'] = 'bottom_box';

		$paged = (get_query_var('paged')) ? get_query_var('paged') : false;

		if ( $paged === false ) $paged = (get_query_var('page')) ? get_query_var('page') : false;
		if ( $paged === false ) $paged = 1;

		if ($entries == '') {

			if ( isset( $wp_query->max_num_pages ) )
				$pages = $wp_query->max_num_pages;

			if( !$pages )
				$pages = 1;

		} else {
			$pages = $entries->max_num_pages;
		}

		if ( 1 != $pages ) { ob_start(); ?>

			<<?php echo $args['tag'] ?> class="<?php echo esc_attr($args['class']); ?> on_the_sides">

				<div class="left_side v_centered">

					<?php if (isset($args['blog_style'])): ?>

						<?php if ($args['blog_style'] == 'grid_view' || $args['blog_style'] == 'list_view'): ?>
							<div class="layout_type buttons_row">
								<a href="javascript:void(0)" data-table-layout="grid_view" class="button_grey middle_btn icon_btn <?php if ($args['blog_style'] == 'grid_view') { ?>active<?php } ?> tooltip_container"><i class="icon-th"></i><span class="tooltip top"><?php esc_html_e('Grid View', 'shopme') ?></span></a>
								<a href="javascript:void(0)" data-table-layout="list_view" class="button_grey middle_btn icon_btn <?php if ($args['blog_style'] == 'list_view') { ?>active<?php } ?> tooltip_container"><i class="icon-th-list"></i><span class="tooltip top"><?php esc_html_e('List View', 'shopme') ?></span></a>
							</div>
						<?php endif; ?>

					<?php endif; ?>

					<?php if ($pages > 1): ?>
						<p>
							<?php if ($entries == '') : ?>

								<?php
									$paged    = max( 1, $wp_query->get( 'paged' ) );
									$per_page = $wp_query->get( 'posts_per_page' );
									$total    = $wp_query->found_posts;
									$first    = ( $per_page * $paged ) - $per_page + 1;
									$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

									if ( 1 == $total ) {
										esc_html_e( 'Showing the single result', 'shopme' );
									} elseif ( $total <= $per_page || -1 == $per_page ) {
										printf( __( 'Showing all %d results', 'shopme' ), $total );
									} else {
										printf( __( 'Showing %d&ndash; %d of %d results', 'shopme' ), $first, $last, $total );
									}
								?>

							<?php else: ?>

								<?php
									$per_page = $entries->query['posts_per_page'];
									$total    = $entries->found_posts;
									$first    = ( $per_page * $paged ) - $per_page + 1;
									$last     = min( $total, $entries->query['posts_per_page'] * $paged );

									if ( 1 == $total ) {
										esc_html_e( 'Showing the single result', 'shopme' );
									} elseif ( $total <= $per_page || -1 == $per_page ) {
										printf( __( 'Showing all %d results', 'shopme' ), $total );
									} else {
										printf( __( 'Showing %d&ndash; %d of %d results', 'shopme' ), $first, $last, $total );
									}
								?>

							<?php endif; ?>
						</p>
					<?php endif; ?>
				</div>

				<div class="right_side">
					<div class="pagination">
						<nav>
							<ul class="page-numbers">
								<?php if( $paged > 1 ):  ?>
									<li><a class='prev' href='<?php echo esc_url(get_pagenum_link( $paged - 1 )) ?>'></a></li>
								<?php endif; ?>

								<?php for( $i=1; $i <= $pages; $i++ ): ?>
									<?php if ( 1 != $pages &&( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $range ) ): ?>
										<?php $class = ( $paged == $i ) ? " class='selected'" : ''; ?>
										<li><a href='<?php echo esc_url(get_pagenum_link( $i )) ?>'<?php echo $class ?> ><?php echo $i ?></a></li>
									<?php endif; ?>
								<?php endfor; ?>

								<?php if ( $paged < $pages ):  ?>
									<li><a class='next' href='<?php echo esc_url(get_pagenum_link( $paged + 1 )) ?>'></a></li>
								<?php endif; ?>
							</ul>
						</nav>
					</div><!--/ .pagination-->
				</div>

			</<?php echo $args['tag'] ?>>

		<?php return ob_get_clean(); }
	}
}

/* Shop Corenavi
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_shop_corenavi')) {

	function shopme_shop_corenavi($pages = "", $a = array(), $args = array()) {
		global $wp_query;

		if (empty($args['tag'])) $args['tag'] = 'footer';
		if (empty($args['class'])) $args['class'] = 'bottom_box';

		if ($pages == '') {
			$max = $wp_query->max_num_pages;
		} else {
			$max = $pages;
		}

		ob_start(); ?>

		<?php if ($max > 1): ?>

			<div class="woocommerce-pagination">

				<<?php echo $args['tag'] ?> class="<?php echo esc_attr($args['class']); ?> on_the_sides">

				<div class="left_side">
					<?php woocommerce_result_count(); ?>
				</div><!--/ .left_side-->

				<div class="right_side">
					<div class="pagination">
						<?php echo woocommerce_pagination(); ?>
					</div><!--/ .pagination-->
				</div><!--/ .right_side-->

				</<?php echo $args['tag'] ?>>

			</div>

		<?php endif;

		return ob_get_clean();
	}

}