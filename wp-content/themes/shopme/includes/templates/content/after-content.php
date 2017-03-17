<?php

$shopme_post_id = shopme_post_id();
$shopme_after_content = mad_meta('shopme_after_content', '', $shopme_post_id); ?>

<?php if ($shopme_after_content && $shopme_after_content > 0): ?>

	<?php
		$shopme_page = get_pages(array(
			'include' => $shopme_after_content
		));
	?>

	<?php if (!empty($shopme_page)): ?>
		<div class="after-content-holder">
			<div class="container">
				<?php echo do_shortcode($shopme_page[0]->post_content); ?>
			</div>
		</div>
	<?php endif; ?>

<?php endif; ?>
