
<div class="footer_section_3 align_center">

	<div class="container">

		<!-- - - - - - - - - - - - - - Payments - - - - - - - - - - - - - - - - -->

		<div class="row">

			<ul class="payments">
				<?php if (shopme_custom_get_option('payment_1') != ''): ?>
					<li>
						<img src="<?php echo shopme_custom_get_option('payment_1') ?>" alt=""/>
					</li>
				<?php endif; ?>
				<?php if (shopme_custom_get_option('payment_2') != ''): ?>
					<li>
						<img src="<?php echo shopme_custom_get_option('payment_2') ?>" alt=""/>
					</li>
				<?php endif; ?>
				<?php if (shopme_custom_get_option('payment_3') != ''): ?>
					<li>
						<img src="<?php echo shopme_custom_get_option('payment_3') ?>" alt=""/>
					</li>
				<?php endif; ?>
				<?php if (shopme_custom_get_option('payment_4') != ''): ?>
					<li>
						<img src="<?php echo shopme_custom_get_option('payment_4') ?>" alt=""/>
					</li>
				<?php endif; ?>
				<?php if (shopme_custom_get_option('payment_5') != ''): ?>
					<li>
						<img src="<?php echo shopme_custom_get_option('payment_5') ?>" alt=""/>
					</li>
				<?php endif; ?>
				<?php if (shopme_custom_get_option('payment_6') != ''): ?>
					<li>
						<img src="<?php echo shopme_custom_get_option('payment_6') ?>" alt=""/>
					</li>
				<?php endif; ?>
				<?php if (shopme_custom_get_option('payment_7') != ''): ?>
					<li>
						<img src="<?php echo shopme_custom_get_option('payment_7') ?>" alt=""/>
					</li>
				<?php endif; ?>
				<?php if (shopme_custom_get_option('payment_8') != ''): ?>
					<li>
						<img src="<?php echo shopme_custom_get_option('payment_8') ?>" alt=""/>
					</li>
				<?php endif; ?>
				<?php if (shopme_custom_get_option('payment_9') != ''): ?>
					<li>
						<img src="<?php echo shopme_custom_get_option('payment_9') ?>" alt=""/>
					</li>
				<?php endif; ?>
				<?php if (shopme_custom_get_option('payment_10') != ''): ?>
					<li>
						<img src="<?php echo shopme_custom_get_option('payment_10') ?>" alt=""/>
					</li>
				<?php endif; ?>
				<?php if (shopme_custom_get_option('payment_11') != ''): ?>
					<li>
						<img src="<?php echo shopme_custom_get_option('payment_11') ?>" alt=""/>
					</li>
				<?php endif; ?>
				<?php if (shopme_custom_get_option('payment_12') != ''): ?>
					<li>
						<img src="<?php echo shopme_custom_get_option('payment_12') ?>" alt=""/>
					</li>
				<?php endif; ?>
				<?php if (shopme_custom_get_option('payment_13') != ''): ?>
					<li>
						<img src="<?php echo shopme_custom_get_option('payment_13') ?>" alt=""/>
					</li>
				<?php endif; ?>
				<?php if (shopme_custom_get_option('payment_14') != ''): ?>
					<li>
						<img src="<?php echo shopme_custom_get_option('payment_14') ?>" alt=""/>
					</li>
				<?php endif; ?>
				<?php if (shopme_custom_get_option('payment_15') != ''): ?>
					<li>
						<img src="<?php echo shopme_custom_get_option('payment_15') ?>" alt=""/>
					</li>
				<?php endif; ?>
			</ul><!--/ .payments-->

		</div><!--/ .row-->

		<!-- - - - - - - - - - - - - - End of payments - - - - - - - - - - - - - - - - -->

		<?php if (shopme_custom_get_option('show_product_categories')): ?>

		<!-- - - - - - - - - - - - - - Footer navigation - - - - - - - - - - - - - - - - -->

		<div class="row">
			<nav class="footer_nav">

				<?php
					$shopme_product_args = array(
						'hierarchical' => false,
						'hide_empty' => true
					);
					$shopme_parent_id = shopme_custom_get_option('product_categories_parent_id');

					if (!empty($shopme_parent_id) && is_numeric($shopme_parent_id)) {
						$shopme_product_args['parent'] = $shopme_parent_id;
					}
					$shopme_product_categories = get_terms( 'product_cat', $shopme_product_args );
					$shopme_count_cat = count($shopme_product_categories);
				?>

				<?php if ( $shopme_count_cat > 0 ): ?>

					<ul class="bottombar">
						<?php foreach ( $shopme_product_categories as $product_category ): ?>
							<li><a href="<?php echo esc_url(get_term_link( $product_category )) ?>"><?php echo esc_html($product_category->name) ?></a></li>
						<?php endforeach; ?>
					</ul><!--/ .bottombar-->

				<?php endif; ?>

			</nav><!--/ .footer_nav-->
		</div><!--/ .row-->

		<!-- - - - - - - - - - - - - - End of footer navigation - - - - - - - - - - - - - - - - -->

		<?php endif; ?>

		<div class="row">

			<?php $copyright = shopme_custom_get_option('copyright'); ?>

			<?php if (empty($copyright)): ?>
				<?php echo shopme_custom_get_option('copyright', "&copy; 2016 " . "<span><a href='" . esc_url( home_url('/') ) . "'>" . get_bloginfo('name') . "</a></span> " . esc_html__('All Rights Reserved.', 'shopme')) ?>
			<?php else: ?>
				<?php echo html_entity_decode(shopme_custom_get_option('copyright'), ENT_QUOTES, get_option('blog_charset')); ?>
			<?php endif; ?>

		</div><!--/ .row-->

	</div><!--/ .container-->

</div><!--/ .footer_section_3-->