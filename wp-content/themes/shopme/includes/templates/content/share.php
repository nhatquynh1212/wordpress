<?php

if (!shopme_custom_get_option('share-posts-enable'))
	return;

// Social Share Page
$image = esc_url(wp_get_attachment_url( get_post_thumbnail_id() ));
$permalink = esc_url( apply_filters( 'the_permalink', get_permalink() ) );
$title = esc_attr(get_the_title());
$extra_attr = 'target="_blank" ';
?>

<div class="share-links-wrapper v_centered">

	<span class="title"><?php esc_html_e('Share this', 'shopme') ?>:</span>

	<div class="share-links">

		<?php if (shopme_custom_get_option('share-posts-facebook')): ?>
			<a href="http://www.facebook.com/sharer.php?m2w&amp;s=100&amp;p&#091;url&#093;=<?php echo $permalink ?>&amp;p&#091;images&#093;&#091;0&#093;=<?php echo $image ?>&amp;p&#091;title&#093;=<?php echo $title ?>" <?php echo $extra_attr ?> title="<?php esc_html_e('Facebook', 'shopme') ?>" class="share-facebook"><?php esc_html_e('Facebook', 'shopme') ?></a>
		<?php endif; ?>

		<?php if (shopme_custom_get_option('share-posts-twitter')): ?>
			<a href="https://twitter.com/intent/tweet?text=<?php echo $title ?>&amp;url=<?php echo $permalink ?>" <?php echo $extra_attr ?> title="<?php _e('Twitter', 'shopme') ?>" class="share-twitter"><?php esc_html_e('Twitter', 'shopme') ?></a>
		<?php endif; ?>

		<?php if (shopme_custom_get_option('share-posts-linkedin')): ?>
			<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $permalink ?>&amp;title=<?php echo $title ?>" <?php echo $extra_attr ?> title="<?php esc_html_e('LinkedIn', 'shopme') ?>" class="share-linkedin"><?php esc_html_e('LinkedIn', 'shopme') ?></a>
		<?php endif; ?>

		<?php if (shopme_custom_get_option('share-posts-googleplus')): ?>
			<a href="https://plus.google.com/share?url=<?php echo $permalink ?>" <?php echo $extra_attr ?> title="<?php esc_html_e('Google +', 'shopme') ?>" class="share-googleplus"><?php esc_html_e('Google +', 'shopme') ?></a>
		<?php endif; ?>

		<?php if (shopme_custom_get_option('share-posts-pinterest')): ?>
			<a href="https://pinterest.com/pin/create/link/?url=<?php echo $permalink ?>&amp;media=<?php echo $image ?>" <?php echo $extra_attr ?> title="<?php esc_html_e('Pinterest', 'shopme') ?>" class="share-pinterest"><?php esc_html_e('Pinterest', 'shopme') ?></a>
		<?php endif; ?>

		<?php if (shopme_custom_get_option('share-posts-vk')): ?>
			<a href="https://vk.com/share.php?url=<?php echo $permalink ?>&amp;title=<?php echo $title ?>&amp;image=<?php echo $image ?>&amp;noparse=true" <?php echo $extra_attr ?> title="<?php esc_html_e('VK', 'shopme') ?>" class="share-vk"><?php esc_html_e('VK', 'shopme') ?></a>
		<?php endif; ?>

		<?php if (shopme_custom_get_option('share-posts-tumblr')): ?>
			<a href="http://www.tumblr.com/share/link?url=<?php echo $permalink ?>&amp;name=<?php echo urlencode($title) ?>&amp;description=<?php echo urlencode(get_the_excerpt()) ?>" <?php echo $extra_attr ?> title="<?php esc_html_e('Tumblr', 'shopme') ?>" class="share-tumblr"><?php esc_html_e('Tumblr', 'shopme') ?></a>
		<?php endif; ?>

		<?php if (shopme_custom_get_option('share-posts-reddit')): ?>
			<a href="http://www.reddit.com/submit?url=<?php echo $permalink ?>&amp;title=<?php echo $title ?>" <?php echo $extra_attr ?> title="<?php esc_html_e('Reddit', 'shopme') ?>" class="share-reddit"><?php esc_html_e('Reddit', 'shopme') ?></a>
		<?php endif; ?>

		<?php if (shopme_custom_get_option('share-posts-xing')): ?>
			<a href="https://www.xing-share.com/app/user?op=share;sc_p=xing-share;url=<?php echo $permalink ?>" <?php echo $extra_attr ?> title="<?php esc_html_e('Xing', 'shopme') ?>" class="share-xing"><?php esc_html_e('Xing', 'shopme') ?></a>
		<?php endif; ?>

	</div><!--/ .share-links-->

</div><!--/ .share-links-wrapper-->

