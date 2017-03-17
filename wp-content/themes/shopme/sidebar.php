
<?php
// reset all previous queries
wp_reset_postdata();

$shopme_post_id = shopme_post_id();
$shopme_custom_sidebar = $shopme_animate_widgets = '';

if (is_singular() && !empty($shopme_post_id)) {
	$shopme_custom_sidebar = mad_meta('shopme_page_sidebar', '', $shopme_post_id);
	$shopme_animate_widgets = SHOPME_HELPER::check_animate_widgets($shopme_post_id);
}

if (empty($shopme_custom_sidebar)) {
	$shopme_custom_sidebar = shopme_custom_get_option('sidebar_setting_page');
}

if (is_post_type_archive('product') || shopme_is_product_category() || shopme_is_product_tag()) {

	$shopme_woo_shop_page_id = get_option('woocommerce_shop_page_id');

	if ($shopme_woo_shop_page_id) {
		$shopme_custom_sidebar = mad_meta('shopme_page_sidebar', '', $shopme_woo_shop_page_id);
	}

	if (shopme_is_product_category()) {
		$shopme_custom_sidebar = shopme_get_meta_value('sidebar');
	}

	if (empty($shopme_custom_sidebar)) {
		$shopme_custom_sidebar = shopme_custom_get_option('sidebar_setting_product');
	}

} elseif (shopme_is_product()) {

	if (!empty($shopme_post_id)) {
		$shopme_custom_sidebar = mad_meta('shopme_page_sidebar', '', $shopme_post_id);
	}

	if (empty($shopme_custom_sidebar)) {
		$shopme_custom_sidebar = shopme_custom_get_option('sidebar_setting_product');
	}

}

?>

<aside id="sidebar" class="col-sm-4 col-md-3 <?php echo esc_attr($shopme_animate_widgets) ? 'animate-widgets' : 'no-animate-widgets'; ?>">
	<?php

		if (!empty($shopme_custom_sidebar)) {
			dynamic_sidebar($shopme_custom_sidebar);
		} else {
			if (is_active_sidebar('general-widget-area')) {
				dynamic_sidebar('General Widget Area');
			} else {
			 ?>
				<div class="widget widget_archive">
					<h3 class="widget-title"><?php esc_html_e('Archives', 'shopme'); ?></h3>
					<ul>
						<?php wp_get_archives('type=monthly'); ?>
					</ul>
				</div><!--/ .widget -->

				<div class="widget widget_meta">
					<h3 class="widget-title"><?php esc_html_e('Meta', 'shopme'); ?></h3>
					<ul>
						<?php wp_register(); ?>
							<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</div><!--/ .widget -->
			<?php
			}
		}
	?>

</aside>


