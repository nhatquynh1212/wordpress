<!-- - - - - - - - - - - - - - Bottom part - - - - - - - - - - - - - - - - -->

<div class="bottom_part">

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
								<a title="<?php bloginfo('description'); ?>"
								   href="<?php echo esc_url(home_url('/')); ?>">
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
								<img src="<?php echo esc_attr($logo_image); ?>"
									 alt="<?php bloginfo('description'); ?>"/>
							</a>

						<?php
						}

						break;
				}
				?>

				<!-- - - - - - - - - - - - - - End of logo - - - - - - - - - - - - - - - - -->

			</div><!--/ [col]-->

			<div class="col-lg-3 col-md-4 col-sm-5">

				<!-- - - - - - - - - - - - - - Call to action - - - - - - - - - - - - - - - - -->

				<div class="call_us">
					<div class="call-us-text">
						<?php echo shopme_custom_get_option('call_us', wp_kses(__('<span>Call us toll free:</span> <b>+1888 234 5678</b>', 'shopme'), array('span' => array(), 'b' => array())), true) ?>
					</div>
				</div><!--/ .call_us-->

				<!-- - - - - - - - - - - - - - End call to action - - - - - - - - - - - - - - - - -->

			</div><!--/ [col]-->

				<div class="col-lg-6 col-sm-5">

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

					<!-- - - - - - - - - - - - - - Navigation of shop - - - - - - - - - - - - - - - - -->

					<nav class="topbar align_right"><?php echo SHOPME_HELPER::main_navigation('', 'topbar'); ?></nav>

					<!-- - - - - - - - - - - - - - End navigation of shop - - - - - - - - - - - - - - - - -->

				</div><!--/ [col]-->

			</div><!--/ .main_header_row-->

		</div><!--/ .row-->

	</div><!--/ .container-->

</div><!--/ .bottom_part -->

<!-- - - - - - - - - - - - - - End of bottom part - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Main navigation wrapper - - - - - - - - - - - - - - - - -->

<?php $rotate_transform = shopme_custom_get_option('header_rotate_transform', 1); ?>

<div id="main_navigation_wrap">

	<div class="container">

		<div class="row">

			<div class="col-xs-12">

				<div class="sticky_inner">

				<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->

				<div class="nav_item size_1 dropdown-list">

					<button class="open_menu"></button>

					<!-- - - - - - - - - - - - - - Main navigation - - - - - - - - - - - - - - - - -->

					<div class="secondary_navigation dropdown <?php if (!$rotate_transform): ?>off_rotate_transform<?php endif; ?>">
						<?php echo SHOPME_HELPER::main_navigation('', 'secondary'); ?>
					</div>

					<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->

				</div><!--/ .nav_item-->

				<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->

				<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->

				<div class="nav_item inner_offset">

					<?php if (shopme_custom_get_option('show_search')): ?>

						<!-- - - - - - - - - - - - - - Search form - - - - - - - - - - - - - - - - -->

						<?php echo shopme_search_form(); ?>

						<!-- - - - - - - - - - - - - - End search form - - - - - - - - - - - - - - - - -->

					<?php endif; ?>

				</div><!--/ .nav_item-->

				<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->


				<!-- - - - - - - - - - - - - - Show Wishlist - - - - - - - - - - - - - - - - -->

				<?php if (shopme_custom_get_option('show_wishlist')): ?>

					<?php if (defined('YITH_WCWL') && defined('SHOPME_WOO_CONFIG')):
						$wishlist_page_id = get_option( 'yith_wcwl_wishlist_page_id' );
						$wishlist_count = YITH_WCWL()->count_products();
						$wishlist_active = '';

						if (is_page($wishlist_page_id)) $wishlist_active = 'active';
						?>

						<div class="nav_item size_1">
							<a href="<?php echo esc_url(get_permalink($wishlist_page_id)); ?>" class="wishlist_button <?php echo esc_attr($wishlist_active); ?>" data-amount="<?php echo absint($wishlist_count) ?>"></a>
						</div><!--/ .nav_item-->

					<?php endif; ?>

				<?php endif; ?>

				<!-- - - - - - - - - - - - - End Show Wishlist - - - - - - - - - - - - - - - -->


				<!-- - - - - - - - - - - - - - Show Compare - - - - - - - - - - - - - - - - -->

				<?php if (shopme_custom_get_option('show_compare')):
					$view_compare = '';
					$count_compare = 0;

					if (defined('YITH_WOOCOMPARE') && defined('SHOPME_WOO_CONFIG')):
						global $yith_woocompare;
						$count_compare = count($yith_woocompare->obj->products_list);
						?>

						<div class="nav_item size_1 product">
							<a href="<?php echo esc_url(add_query_arg( array( 'iframe' => 'true' ), $yith_woocompare->obj->view_table_url() )) ?>" class="compare added compare_button" data-amount="<?php echo absint($count_compare) ?>"></a>
						</div><!--/ .nav_item-->

					<?php endif; ?>

				<?php endif; ?>

				<!-- - - - - - - - - - - - - End Show Compare - - - - - - - - - - - - - - - -->

				<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->

				<div class="nav_item size_2">

					<div class="login_box"><div class="login_box_inner">

							<!-- - - - - - - - - - - - - - Login - - - - - - - - - - - - - - - - -->

							<?php if (shopme_is_shop_installed()): ?>

								<?php $accountPage = get_permalink(get_option('woocommerce_myaccount_page_id')); ?>

								<?php if (is_user_logged_in()): ?>

									<?php
									$current_user = wp_get_current_user();
									$user_name = shopme_get_user_name($current_user);
									?>

									<div class="<?php if(strlen($user_name) > 10): ?>small_text<?php endif; ?>">
										<span class="welcome_username"><?php echo esc_html_e('Welcome', 'shopme') . ', ' . $user_name ?></span>
										<a class="link-logout" href="<?php echo wp_logout_url(esc_url(home_url('/'))) ?>"><?php esc_html_e('Logout', 'shopme') ?></a>
									</div>

								<?php else: ?>

									<div class="bar-login">
										<a class="to-login" data-href="<?php echo esc_url($accountPage) ?>"
										   href="<?php echo esc_url($accountPage); ?>"><?php esc_html_e('Login', 'shopme'); ?></a>
										<span> / </span>
										<a class="to-register" href="<?php echo esc_url($accountPage); ?>"><?php esc_html_e('Register', 'shopme'); ?></a>
									</div>

								<?php endif; ?>

							<?php else: ?>

								<?php if (is_user_logged_in()): ?>

									<?php
									$current_user = wp_get_current_user();
									$user_name = shopme_get_user_name($current_user);
									?>

									<div class="<?php if(strlen($user_name) > 10): ?>small_text<?php endif; ?>">
										<span class="welcome_username"><?php echo esc_html_e('Welcome', 'shopme') . ', ' . $user_name ?></span>
										<a class="link-logout" href="<?php echo wp_logout_url(esc_url(home_url('/'))) ?>"><?php esc_html_e('Logout', 'shopme') ?></a>
									</div>

								<?php else: ?>

									<a href="<?php echo esc_url(wp_login_url()); ?>"><?php esc_html_e('Login', 'shopme') ?></a>
									<?php echo wp_register('', '', false); ?>

								<?php endif; ?>

							<?php endif; ?>

							<!-- - - - - - - - - - - - - - End login - - - - - - - - - - - - - - - - -->

						</div></div><!--/ .login_box-->

				</div><!--/ .nav_item-->

				<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->

					<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->

					<?php if (defined('SHOPME_WOO_CONFIG')): ?>

						<div class="nav_item dropdown-list size_2">

							<!-- - - - - - - - - - - - - - Shopping cart - - - - - - - - - - - - - - - - -->

							<?php if (shopme_custom_get_option('show_cart')): ?>

								<?php
									global $woocommerce;
									$count = count( $woocommerce->cart->get_cart() );
								?>

								<button id="open_shopping_cart" class="open_button" data-amount="<?php echo esc_html($count); ?>">
									<b class="title"><?php esc_html_e('My Cart', 'shopme') ?></b>
									<b class="total_price"><?php echo WC()->cart->get_cart_subtotal(); ?></b>
								</button>

								<div class="shopping_cart dropdown <?php if (!$rotate_transform): ?>off_rotate_transform<?php endif; ?>">
									<div class="widget_shopping_cart_content"></div>
								</div><!--/ .shopping_cart.dropdown-->

							<?php endif; ?>

							<!-- - - - - - - - - - - - - - End of shopping cart - - - - - - - - - - - - - - - - -->

						</div><!--/ .nav_item-->

					<?php endif; ?>

					<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->

				</div><!--/ .main_navigation-->

			</div><!--/ [col]-->

		</div><!--/ .row-->

	</div><!--/ .container-->

</div><!--/ .main_navigation_wrap-->

<!-- - - - - - - - - - - - - - End of main navigation wrapper - - - - - - - - - - - - - - - - -->