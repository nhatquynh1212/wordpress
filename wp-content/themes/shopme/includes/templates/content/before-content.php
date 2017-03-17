<?php

$shopme_post_id = shopme_post_id();
$shopme_before_content = mad_meta('shopme_before_content', '', $shopme_post_id); ?>

<?php if ($shopme_before_content && $shopme_before_content > 0): ?>

	<?php
		$shopme_page = get_pages(array(
			'include' => $shopme_before_content
		));
	?>

	<?php if (!empty($shopme_page)): ?>
		<div class="before_content">
			<?php echo do_shortcode($shopme_page[0]->post_content); ?>
		</div>
	<?php endif; ?>

<?php endif; ?>
