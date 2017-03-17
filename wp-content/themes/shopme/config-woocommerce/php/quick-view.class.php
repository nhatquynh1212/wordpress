<?php

if (!class_exists('SHOPME_QUICK_VIEW')) {

	class SHOPME_QUICK_VIEW {

		protected $id;

		function __construct($id) {
			$this->id = $id;
			$this->add_hooks();
		}

		public function add_hooks() {

			remove_action('woocommerce_before_single_product', 'wc_print_notices', 10);
			remove_action('woocommerce_after_single_product_summary', 'shopme_woocommerce_output_product_content', 25);
			remove_action('woocommerce_after_single_product_summary', 'shopme_woocommerce_output_product_data_tabs', 26);
			remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 27);
			remove_action('woocommerce_after_single_product_summary', 'shopme_woocommerce_output_related_products', 28);
			remove_action('woocommerce_after_single_product_summary', 'shopme_woocommerce_other_products', 29);

			if ( defined( 'YITH_WOOCOMPARE' ) ) {

				$frontend = new YITH_Woocompare_Frontend();

				remove_action('woocommerce_single_product_summary', array($frontend, 'add_compare_link'), 35);
				remove_action('woocommerce_after_shop_loop_item', array($frontend, 'add_compare_link'), 20);

			}

		}

		public function html() {
			$query = array(
				'post_type' => 'product',
				'post__in' => array($this->id)
			);
			$the_query = new WP_Query( $query );
			?>

			<div id="modal-<?php echo $this->id ?>" class="modal-inner-content">
				<button class="close arcticmodal-close"></button>
				<div class="woocommerce custom-scrollbar clearfix">

					<?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>
						<?php wc_get_template_part( 'content', 'single-product' ); ?>
					<?php endwhile; ?>

					<?php wp_reset_postdata(); ?>

				</div><!--/ .clearfix-->
			</div><!--/ .modal-inner-content-->

		<?php
		}
	}

}
