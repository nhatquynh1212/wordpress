<?php
    $shopme_next_post = get_next_post();
    $shopme_prev_post = get_previous_post();
    $shopme_next_post_url = $shopme_prev_post_url = "";
	$shopme_next_post_title = $shopme_prev_post_title = "";

    if (is_object($shopme_next_post)) {
        $shopme_next_post_url = get_permalink($shopme_next_post->ID);
        $shopme_next_post_title = $shopme_next_post->post_title;
    }
    if (is_object($shopme_prev_post)) {
        $shopme_prev_post_url = get_permalink($shopme_prev_post->ID);
		$shopme_prev_post_title = $shopme_prev_post->post_title;
    }
?>

<?php if (!empty($shopme_prev_post_url) || !empty($shopme_next_post_url)): ?>

    <div class="post-link-pages">

		<div class="post-nav-left">
			<?php if (!empty($shopme_prev_post_url)): ?>
				<a class="post-prev-button" href="<?php echo esc_url($shopme_prev_post_url) ?>" title="">
					<?php esc_html_e('Previous Post', 'shopme') ?>
				</a>
				<span><?php echo esc_html($shopme_prev_post_title); ?></span>
			<?php endif; ?>
		</div><!--/ .post-nav-left-->

		<div class="post-nav-right">
			<?php if (!empty($shopme_next_post_url)): ?>
				<a class="post-next-button" href="<?php echo esc_url($shopme_next_post_url) ?>" title="">
					<?php esc_html_e('Next Post', 'shopme') ?>
				</a>
				<span><?php echo esc_html($shopme_next_post_title); ?></span>
			<?php endif; ?>
		</div><!--/ .post-nav-right-->

    </div><!--/ .post-link-pages-->

<?php endif; ?>