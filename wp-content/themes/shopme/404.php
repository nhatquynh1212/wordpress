<?php get_header(); ?>

	<div class="template-404">

		<div class="container_404">

			<?php echo html_entity_decode(shopme_custom_get_option('440_content')); ?>

			<a href="javascript:javascript:history.go(-1)" class="button-404"><?php esc_html_e('Go to Previous Page', 'shopme') ?></a>
			<a href="<?php echo esc_url(SHOPME_HOME_URL); ?>" class="button-404"><?php esc_html_e('Go to Homepage', 'shopme'); ?></a>

			<?php echo shopme_search_form(); ?>

		</div><!--/ .align_center -->

	</div><!--/ .template-404-->

<?php get_footer(); ?>