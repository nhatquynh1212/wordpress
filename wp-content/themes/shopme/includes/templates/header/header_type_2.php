<!-- - - - - - - - - - - - - - Top part - - - - - - - - - - - - - - - - -->

<div class="bottom_part">

	<div class="sticky_part">

		<div class="container">

			<div class="row">

				<div class="main_header_row">

					<div class="col-sm-3">

						<!-- - - - - - - - - - - - - - Logo - - - - - - - - - - - - - - - - -->

						<?php $logo_type = shopme_custom_get_option('logo_type'); ?>

						<?php
						switch ($logo_type) {
							case 'text':
								$logo_text = shopme_custom_get_option('logo_text');

								if (empty($logo_text)) {
									$logo_text = get_bloginfo('name');
								}

								if (!empty($logo_text)): ?>

									<h1 id="logo" class="logo">
										<a title="<?php bloginfo('description'); ?>" href="<?php echo esc_url(home_url('/')); ?>">
											<?php echo html_entity_decode($logo_text); ?>
										</a>
									</h1>

								<?php endif;

								break;
							case 'upload':

								$logo_image = shopme_custom_get_option('logo_image');

								if (!empty($logo_image)) {
									?>

									<a id="logo" class="logo" title="<?php bloginfo('description'); ?>"
									   href="<?php echo esc_url(home_url('/')); ?>">
										<img src="<?php echo esc_attr($logo_image); ?>" alt="<?php bloginfo('description'); ?>"/>
									</a>

								<?php
								}

								break;
						}
						?>

						<!-- - - - - - - - - - - - - - End of logo - - - - - - - - - - - - - - - - -->

					</div><!--/ [col]-->

					<div class="col-lg-6 col-md-5 col-sm-6">

						<nav class="topbar"><?php echo SHOPME_HELPER::main_navigation('', 'topbar'); ?></nav>

						<?php if (shopme_custom_get_option('show_search')): ?>

							<!-- - - - - - - - - - - - - - Search form - - - - - - - - - - - - - - - - -->

							<?php echo shopme_search_form(); ?>

							<!-- - - - - - - - - - - - - - End search form - - - - - - - - - - - - - - - - -->

						<?php endif; ?>

					</div><!--/ [col]-->

					<div class="col-lg-3 col-md-4 col-sm-3">

						<div class="clearfix">

							<!-- - - - - - - - - - - - - - Language change - - - - - - - - - - - - - - - - -->

							<?php if (defined('ICL_LANGUAGE_CODE')): ?>
								<?php if (shopme_custom_get_option('show_language')): ?>
									<?php echo SHOPME_WC_WPML_CONFIG::wpml_header_languages_list(); ?>
								<?php endif; ?>
							<?php endif; ?>

							<!-- - - - - - - - - - - - - - End of language change - - - - - - - - - - - - - - - - -->

							<!-- - - - - - - - - - - - - - Currency change - - - - - - - - - - - - - - - - -->

							<?php if (shopme_custom_get_option('show_currency')): ?>
								<?php if (defined('SHOPME_WOO_CONFIG')): ?>
									<?php echo SHOPME_WC_CURRENCY_SWITCHER::output_switcher_html(); ?>
								<?php endif; ?>
							<?php endif; ?>

							<!-- - - - - - - - - - - - - - End of currency change - - - - - - - - - - - - - - - - -->

						</div><!--/ .clearfix-->

						<div class="align_right v_centered">

							<!-- - - - - - - - - - - - - - Wishlist & compare counters - - - - - - - - - - - - - - - - -->

							<ul class="shop_links_list">

								<?php if (shopme_custom_get_option('show_wishlist')): ?>

									<?php if (defined('YITH_WCWL') && defined('SHOPME_WOO_CONFIG')):
										$wishlist_page_id = get_option( 'yith_wcwl_wishlist_page_id' );
										$wishlist_count = YITH_WCWL()->count_products();
										$wishlist_active = '';

										if (is_page($wishlist_page_id)) $wishlist_active = 'active';
										?>

										<li><a href="<?php echo esc_url(get_permalink($wishlist_page_id)); ?>" class="wishlist_link small_link <?php echo esc_attr($wishlist_active); ?>"><i class="icon-heart-5"></i><?php esc_html_e('Wishlist', 'shopme'); ?> (<span><?php echo absint($wishlist_count) ?></span>)</a></li>

									<?php endif; ?>

								<?php endif; ?>


								<?php if (shopme_custom_get_option('show_compare')):
									$view_compare = '';
									$count_compare = 0;

									if (defined('YITH_WOOCOMPARE') && defined('SHOPME_WOO_CONFIG')):
										global $yith_woocompare;
										$count_compare = count($yith_woocompare->obj->products_list);
										?>

										<li class="product"><a href="<?php echo esc_url(add_query_arg( array( 'iframe' => 'true' ), $yith_woocompare->obj->view_table_url() )) ?>" class="count-compare compare added small_link"><i class="icon-resize-small"></i><?php esc_html_e('Compare', 'shopme') ?> (<span><?php echo absint($count_compare) ?></span>)</a></li>

									<?php endif; ?>

								<?php endif; ?>

							</ul><!--/ .align_right.shop_links-->

							<!-- - - - - - - - - - - - - - End of wishlist & compare counters - - - - - - - - - - - - - - - - -->


							<!-- - - - - - - - - - - - - - Shopping cart - - - - - - - - - - - - - - - - -->

							<?php if (defined('SHOPME_WOO_CONFIG')): ?>

								<?php if (shopme_custom_get_option('show_cart')): ?>

									<?php
										global $woocommerce;
										$count = count( $woocommerce->cart->get_cart() );
										$rotate_transform = shopme_custom_get_option('header_rotate_transform', 1);
									?>

									<div class="shopping_cart_wrap">

										<div class="dropdown-list">

											<button id="open_shopping_cart" class="open_button" data-amount="<?php echo esc_html($count); ?>">
												<b class="title"><?php esc_html_e('My Cart', 'shopme') ?></b>
												<b class="total_price"><?php echo WC()->cart->get_cart_subtotal(); ?></b>
											</button>

											<div class="shopping_cart dropdown <?php if (!$rotate_transform): ?>off_rotate_transform<?php endif; ?>">
												<div class="widget_shopping_cart_content"></div>
											</div><!--/ .shopping_cart.dropdown-->

										</div>

									</div><!--/ .shopping_cart_wrap.align_left-->

								<?php endif; ?>

							<?php endif; ?>

							<!-- - - - - - - - - - - - - - End of shopping cart - - - - - - - - - - - - - - - - -->

						</div><!--/ .align_right-->

					</div><!--/ [col]-->

				</div><!--/ .main_header_row-->

			</div><!--/ .row-->

		</div><!--/ .container-->

	</div>

</div><!--/ .bottom_part -->

<!-- - - - - - - - - - - - - - End of bottom part - - - - - - - - - - - - - - - - -->