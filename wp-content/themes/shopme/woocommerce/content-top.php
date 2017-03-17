<?php

$shopme_content_top = shopme_get_meta_value('content_top');

 if ($shopme_content_top && $shopme_content_top > 0): ?>

	<?php
	$shopme_page = get_pages(array(
		'include' => $shopme_content_top
	));
	?>

	<?php if (!empty($shopme_page)): ?>
		<?php echo do_shortcode($shopme_page[0]->post_content); ?>
	<?php endif; ?>

<?php endif; ?>
