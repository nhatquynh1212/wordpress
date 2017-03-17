<?php
	$post_id = shopme_post_id();

	list($footer_row_top_show, $footer_row_middle_show, $footer_row_bottom_show, $get_sidebars_top_widgets, $get_sidebars_middle_widgets, $get_sidebars_bottom_widgets, $footer_row_top_columns_variations, $footer_row_middle_columns_variations, $footer_row_bottom_columns_variations) = SHOPME_WIDGETS_META_BOX::get_settings_from_post_meta($post_id);

	if (empty($footer_row_top_show)) {
		$footer_row_top_show = (shopme_custom_get_option('show_row_top_widgets') != '0') ? 'yes' : 'no';
	}
	if (empty($footer_row_middle_show)) {
		$footer_row_middle_show = (shopme_custom_get_option('show_row_middle_widgets') != '0') ? 'yes' : 'no';
	}
	if (empty($footer_row_bottom_show)) {
		$footer_row_bottom_show = (shopme_custom_get_option('show_row_bottom_widgets') != '0') ? 'yes' : 'no';
	}

	if (empty($footer_row_top_columns_variations)) {
		$footer_row_top_columns_variations = shopme_custom_get_option('footer_row_top_columns_variations');
	}
	if (empty($footer_row_middle_columns_variations)) {
		$footer_row_middle_columns_variations = shopme_custom_get_option('footer_row_middle_columns_variations');
	}
	if (empty($footer_row_bottom_columns_variations)) {
		$footer_row_bottom_columns_variations = shopme_custom_get_option('footer_row_bottom_columns_variations');
	}

	if (shopme_is_product() || shopme_is_product_category() || shopme_is_product_tag() || is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product')) {
		$post_id = shopme_custom_get_option('shop_get_widgets_page_id');
		list($footer_row_top_show, $footer_row_middle_show, $footer_row_bottom_show, $get_sidebars_top_widgets, $get_sidebars_middle_widgets, $get_sidebars_bottom_widgets, $footer_row_top_columns_variations, $footer_row_middle_columns_variations, $footer_row_bottom_columns_variations) = SHOPME_WIDGETS_META_BOX::get_settings_from_post_meta($post_id);
	}

	if (empty($get_sidebars_top_widgets)) {
		$get_sidebars_top_widgets = array(
			'Footer Row - widget 1',
			'Footer Row - widget 2',
			'Footer Row - widget 3',
			'Footer Row - widget 4',
			'Footer Row - widget 5'
		);
	}

	if (empty($get_sidebars_middle_widgets)) {
		$get_sidebars_middle_widgets = array(
			'Footer Row - widget 11',
			'Footer Row - widget 12',
			'Footer Row - widget 13',
			'Footer Row - widget 14',
			'Footer Row - widget 15'
		);
	}

	if (empty($get_sidebars_bottom_widgets)) {
		$get_sidebars_bottom_widgets = array(
			'Footer Row - widget 6',
			'Footer Row - widget 7',
			'Footer Row - widget 8',
			'Footer Row - widget 9',
			'Footer Row - widget 10'
		);
	}

?>

<?php if ($footer_row_top_show == 'yes' || $footer_row_middle_show == 'yes' || $footer_row_bottom_show == 'yes'): ?>

		<?php if ($footer_row_top_show == 'yes'): ?>

			<section class="footer_section">

				<div class="container">
					<div class="row">

						<?php if (!empty($footer_row_top_columns_variations)):
							$number_of_top_columns = key( json_decode( html_entity_decode ( $footer_row_top_columns_variations ), true));
							$columns_top_array = json_decode( html_entity_decode ( $footer_row_top_columns_variations ), true );
							?>

							<?php for ($i = 1; $i <= $number_of_top_columns; $i++): ?>

								<div class="col-sm-<?php echo esc_attr($columns_top_array[$number_of_top_columns][0][$i-1]); ?>">
									<?php if ( !dynamic_sidebar($get_sidebars_top_widgets[$i-1]) ) : endif; ?>
								</div>

							<?php endfor; ?>

						<?php endif; ?>

					</div><!--/ .row-->
				</div><!--/ .container-->

			</section><!--/ .footer_section-->

		<?php endif; ?>

		<?php if ($footer_row_middle_show == 'yes'): ?>

			<hr/>

			<section class="footer_section_2">

				<div class="container">
					<div class="row">

						<?php if (!empty($footer_row_middle_columns_variations)):
							$number_of_middle_columns = key( json_decode( html_entity_decode ( $footer_row_middle_columns_variations ), true));
							$columns_middle_array = json_decode( html_entity_decode ( $footer_row_middle_columns_variations ), true );
							?>

							<?php for ($i = 1; $i <= $number_of_middle_columns; $i++): ?>

							<div class="col-sm-<?php echo esc_attr($columns_middle_array[$number_of_middle_columns][0][$i-1]); ?>">
								<?php if ( !dynamic_sidebar($get_sidebars_middle_widgets[$i-1]) ) : endif; ?>
							</div>

						<?php endfor; ?>

						<?php endif; ?>

					</div><!--/ .row-->
				</div><!--/ .container-->

			</section>

<!--			<hr/>-->

		<?php endif; ?>

		<?php if ($footer_row_bottom_show == 'yes'): ?>

			<hr />

			<section class="footer_section">

				<div class="container">
					<div class="row">

						<?php if (!empty($footer_row_bottom_columns_variations)):
							$number_of_bottom_columns = key( json_decode( html_entity_decode ( $footer_row_bottom_columns_variations ), true));
							$columns_bottom_array = json_decode( html_entity_decode ( $footer_row_bottom_columns_variations ), true );
							?>

							<?php for ($i = 1; $i <= $number_of_bottom_columns; $i++): ?>

								<div class="col-sm-<?php echo esc_attr($columns_bottom_array[$number_of_bottom_columns][0][$i-1]); ?>">
									<?php if ( !dynamic_sidebar($get_sidebars_bottom_widgets[$i-1]) ) : endif; ?>
								</div>

							<?php endfor; ?>

						<?php endif; ?>

					</div><!--/ .row-->
				</div><!--/ .container-->

			</section><!--/ .footer_section-->

		<?php endif; ?>

<?php endif; ?>