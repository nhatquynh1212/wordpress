
<!-- - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - -->

<?php if (is_page()): ?>

	<?php if (shopme_custom_get_option('page_breadcrumbs') == 'yes'): ?>

		<?php
		$shopme_post_id = shopme_post_id();
		$shopme_breadcrumb = mad_meta('shopme_breadcrumb', '', $shopme_post_id);
		?>

		<?php if ($shopme_breadcrumb == 'breadcrumb'): ?>

			<div class="breadcrumbs">
				<div class="container">
					<div class="shopme-breadcrumbs">
						<?php echo shopme_breadcrumbs(array(
							'separator' => '/'
						)); ?>
					</div>
				</div><!--/ .container-->
			</div><!--/ .breadcrumbs-->

		<?php endif; ?>

	<?php endif; ?>

<?php elseif (is_post_type_archive('product') || shopme_is_product_category() || shopme_is_product_tag() || is_singular('product')): ?>

	<?php if (shopme_custom_get_option('shop_breadcrumbs')): ?>

		<?php if (is_post_type_archive('product') || shopme_is_product_category() || shopme_is_product_tag()): ?>

			<div class="breadcrumbs">
				<div class="container">
					<div class="shopme-breadcrumbs">
						<?php woocommerce_breadcrumb(array(
							'delimiter' => '/'
						)); ?>
					</div>
				</div><!--/ .container-->
			</div><!--/ .breadcrumbs-->

		<?php elseif ( is_singular('product') ): ?>

			<?php
			$shopme_post_id = shopme_post_id();
			$shopme_breadcrumb = mad_meta('shopme_breadcrumb', '', $shopme_post_id);
			?>

			<?php if ( $shopme_breadcrumb != 'hide' ): ?>

				<div class="breadcrumbs">
					<div class="container">
						<div class="shopme-breadcrumbs">
							<?php woocommerce_breadcrumb(array(
								'delimiter' => '/'
							)); ?>
						</div>
					</div><!--/ .container-->
				</div><!--/ .breadcrumbs-->

			<?php endif; ?>

		<?php endif; ?>

	<?php endif; ?>

<?php else: ?>

	<?php if (shopme_custom_get_option('single_breadcrumbs') == 'yes'): ?>

		<?php $shopme_breadcrumb = mad_meta('shopme_breadcrumb'); ?>

		<?php if ($shopme_breadcrumb == 'breadcrumb'): ?>

			<div class="breadcrumbs">
				<div class="container">
					<div class="shopme-breadcrumbs">
						<?php echo shopme_breadcrumbs(array(
							'separator' => '/'
						)); ?>
					</div>
				</div><!--/ .container-->
			</div><!--/ .breadcrumbs-->

		<?php endif; ?>

	<?php endif; ?>

<?php endif; ?>

<!-- - - - - - - - - - - - - / Breadcrumbs - - - - - - - - - - - - -->