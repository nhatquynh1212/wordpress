<?php

/*	Locate Template
/* ---------------------------------------------------------------------- */

if ( !function_exists('shopme_locate_template') ) {

    function shopme_locate_template( $template_name, $template_path = '', $default_path = ''  ) {
		if ( ! $template_path ) {
			$template_path = apply_filters( 'shopme_template_path', 'templates/' );
		}

		if ( ! $default_path ) {
			$default_path = SHOPME_INCLUDES_PATH . 'templates/';
		}

		// Look within passed path within the theme - this is priority.
		$template = locate_template(
			array(
				trailingslashit( $template_path ) . $template_name,
				$template_name
			)
		);

		// Get default template/
		if ( ! $template ) {
			$template = $default_path . $template_name;
		}

		// Return what we found.
		return apply_filters( 'shopme_locate_template', $template, $template_name, $template_path );
    }
}

/*	Get Template
/* ---------------------------------------------------------------------- */

if ( !function_exists('shopme_get_template') ) {

    function shopme_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {

        $located = shopme_locate_template( $template_name, $template_path, $default_path );

		if (empty( $located )) { return; }

        if ($args && is_array( $args )) { extract ( $args ); }

        include( $located );
    }
}

/*	String Truncate
/* ---------------------------------------------------------------------- */

if ( !function_exists('shopme_string_truncate')) {

	function shopme_string_truncate($string, $limit, $break=".", $pad="...", $stripClean = false, $excludetags = '<strong><em><span>', $safe_truncate = false) {

		if ($stripClean) {
			$string = strip_shortcodes(strip_tags($string, $excludetags));
		}

		if (strlen($string) <= $limit) return $string;

		if (false !== ($breakpoint = strpos($string, $break, $limit))) {
			if ($breakpoint < strlen($string) - 1) {
				if ($safe_truncate || is_rtl()) {
					$string = mb_strimwidth($string, 0, $breakpoint) . $pad;
				} else {
					$string = substr($string, 0, $breakpoint) . $pad;
				}
			}
		}

		// if there is no breakpoint an no tags we could accidentaly split split inside a word
		if (!$breakpoint && strlen(strip_tags($string)) == strlen($string)) {
			if($safe_truncate || is_rtl()) {
				$string = mb_strimwidth($string, 0, $limit) . $pad;
			} else {
				$string = substr($string, 0, $limit) . $pad;
			}
		}

		return $string;
	}
}

/*	Get Site Icon
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_get_site_icon_url')) {

	function shopme_get_site_icon_url( $size = 512, $url = '' ) {

		$site_icon_id = shopme_custom_get_option("favicon_upload");

		if ( $site_icon_id ) {
			if ( $size >= 512 ) {
				$size_data = 'full';
			} else {
				$size_data = array( $size, $size );
			}
			$url_data = wp_get_attachment_image_src( $site_icon_id, $size_data );
			if ( $url_data ) {
				$url = $url_data[0];
			}
		}

		return $url;
	}
}

/*	Site Icon
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_wp_site_icon')) {

	function shopme_wp_site_icon() {

		$shopme_favicon = shopme_custom_get_option("favicon_upload");
		if ( ! $shopme_favicon ) { return; }

		$meta_tags = array(
			sprintf( '<link rel="icon" href="%s" sizes="32x32" />', esc_url( shopme_get_site_icon_url( 32 ) ) ),
			sprintf( '<link rel="icon" href="%s" sizes="192x192" />', esc_url( shopme_get_site_icon_url( 192 ) ) ),
			sprintf( '<link rel="apple-touch-icon-precomposed" href="%s">', esc_url( shopme_get_site_icon_url( 180 ) ) ),
			sprintf( '<meta name="msapplication-TileImage" content="%s">', esc_url( shopme_get_site_icon_url( 270 ) ) ),
		);

		$meta_tags = array_filter( $meta_tags );

		foreach ( $meta_tags as $meta_tag ) {
			echo "$meta_tag\n";
		}

	}
}

/*	Search Form
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_search_form')) {

	function shopme_search_form() {

		SHOPME_BASE_FUNCTIONS::enqueue_script('chosen-drop-down');
		SHOPME_BASE_FUNCTIONS::enqueue_style('chosen-drop-down');

		ob_start();

		$search_type = shopme_custom_get_option('search-type');

		if (isset($search_type) && $search_type === 'product' && defined('YITH_WCAS' )) {
			echo do_shortcode('[yith_woocommerce_ajax_search]');
			return;
		}

		?>

		<form action="<?php echo home_url('/'); ?>" method="get" class="clearfix search_form">

			<input type="search"
				   value="<?php echo get_search_query() ?>"
				   name="s" id="s" autocomplete="off"
				   class="alignleft"
				   placeholder="<?php echo esc_html__('Search&hellip;', 'shopme'); ?>" />

			<?php if (isset($search_type) && ($search_type === 'post')) : ?>

				<div class="search_category alignleft">

					<?php
						$args = array(
							'show_option_all' => esc_html__( 'All Categories', 'shopme' ),
							'hierarchical' => 1,
							'class' => 'cat',
							'echo' => 0,
							'value_field' => 'slug',
							'selected' => 1
						);

						if ($search_type === 'product' && class_exists('WooCommerce')) {
							$args['taxonomy'] = 'product_cat';
							$args['name'] = 'product_cat';
						}

						$html =	wp_dropdown_categories($args);
						echo str_replace( '&nbsp;', '', $html );
					?>

				</div><!--/ .search_category-->

			<?php endif; ?>

			<button type="submit" class="button_blue def_icon_btn alignleft"></button>
			<input type="hidden" name="post_type" value="<?php echo esc_attr($search_type) ?>" />

		</form>

		<?php return ob_get_clean();
	}
}

if ( !function_exists('shopme_entry_date') ) {

	function shopme_entry_date($id) {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U', $id ) !== get_the_modified_time( 'U', $id ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( get_option( 'date_format' ), $id) ),
			get_the_date( get_option( 'date_format' ), $id ),
			esc_attr( get_the_modified_date( get_option( 'date_format' ), $id ) ),
			get_the_modified_date( get_option( 'date_format' ), $id )
		);

		printf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink($id) ),
			$time_string
		);

	}

}

/*	Blog Post Meta
/* ---------------------------------------------------------------------- */

if ( !function_exists('shopme_blog_post_meta') ) {

	function shopme_blog_post_meta($id = 0) {

		$comments_count = get_comments_number($id);
		$link = get_permalink($id);

		ob_start(); ?>

		<?php if (is_single()): ?>

			<div class="post_meta">
				<?php if (shopme_custom_get_option('blog-single-meta-date')): ?>
					<span><i class="icon-calendar"></i>
						<?php
						if ( in_array( get_post_type($id), array( 'post', 'attachment' ) ) ) {
							shopme_entry_date($id);
						}
						?>
					</span>
				<?php endif; ?>

				<?php if (shopme_custom_get_option('blog-single-meta-comment')): ?>
					<?php if ($comments_count != "0" || comments_open($id)): ?>
						<?php $link_to = $comments_count === "0" ? "#respond" : "#comments"; ?>
						<span><a href="<?php echo esc_url($link . $link_to); ?>" class="comments"><i class="icon-comment"></i> <?php echo esc_html($comments_count); ?></a></span>
					<?php endif; ?>
				<?php endif; ?>

				<?php if (shopme_custom_get_option('blog-single-meta-author')): ?>
					<span><i class="icon-user-8"></i> <?php esc_html_e('by', 'shopme') ?> <?php echo the_author_posts_link(); ?></span>
				<?php endif; ?>

				<?php if (shopme_custom_get_option('blog-single-meta-category')): ?>
					<span><i class="icon-folder-open-empty-1"></i> <?php echo get_the_category_list(", ", '', $id) ?></span>
				<?php endif; ?>
			</div><!--/ .post_meta-->

		<?php else: ?>

			<div class="post_meta">
				<?php if (shopme_custom_get_option('blog-listing-meta-date')): ?>
					<span><i class="icon-calendar"></i>
						<?php
						if ( in_array( get_post_type($id), array( 'post', 'attachment' ) ) ) {
							shopme_entry_date($id);
						}
						?>
					</span>
				<?php endif; ?>

				<?php if (shopme_custom_get_option('blog-listing-meta-comment')): ?>
					<?php if ($comments_count != "0" || comments_open($id)): ?>
						<?php $link_to = $comments_count === "0" ? "#respond" : "#comments"; ?>
						<span><a href="<?php echo esc_url($link . $link_to); ?>" class="comments"><i class="icon-comment"></i> <?php echo esc_html($comments_count); ?></a></span>
					<?php endif; ?>
				<?php endif; ?>

				<?php if (shopme_custom_get_option('blog-listing-meta-author')): ?>
					<span><i class="icon-user-8"></i> <?php esc_html_e('by', 'shopme') ?> <?php echo the_author_posts_link(); ?></span>
				<?php endif; ?>

				<?php if (shopme_custom_get_option('blog-listing-meta-category')): ?>
					<span><i class="icon-folder-open-empty-1"></i> <?php echo get_the_category_list(", ", '', $id) ?></span>
				<?php endif; ?>
			</div><!--/ .post_meta-->

		<?php endif; ?>

		<?php return ob_get_clean();
	}
}

/* 	Regex
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_regex')) {

	/*
	*	Regex for url: http://mathiasbynens.be/demo/url-regex
	*/
	function shopme_regex($string, $pattern = false, $start = "^", $end = "") {
		if (!$pattern) return false;

		if ($pattern == "url") {
			$pattern = "!$start((https?|ftp)://(-\.)?([^\s/?\.#-]+\.?)+(/[^\s]*)?)$end!";
		} else if ($pattern == "mail") {
			$pattern = "!$start\w[\w|\.|\-]+@\w[\w|\.|\-]+\.[a-zA-Z]{2,4}$end!";
		} else if ($pattern == "image") {
			$pattern = "!$start(https?(?://([^/?#]*))?([^?#]*?\.(?:jpg|gif|png)))$end!";
		} else if ($pattern == "mp4") {
			$pattern = "!$start(https?(?://([^/?#]*))?([^?#]*?\.(?:mp4)))$end!";
		} else if (strpos($pattern,"<") === 0) {
			$pattern = str_replace('<',"",$pattern);
			$pattern = str_replace('>',"",$pattern);

			if (strpos($pattern,"/") !== 0) { $close = "\/>"; $pattern = str_replace('/',"",$pattern); }
			$pattern = trim($pattern);
			if (!isset($close)) $close = "<\/".$pattern.">";

			$pattern = "!$start\<$pattern.+?$close!";
		}

		preg_match($pattern, $string, $result);

		if (empty($result[0])) {
			return false;
		} else {
			return $result;
		}
	}
}

/*	Tag Archive Page
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_tag_archive_page')) {

	function shopme_tag_archive_page($query) {
		$post_types = get_post_types();

		if (is_category() || is_tag()) {
			if (!is_admin() && $query->is_main_query()) {

				$post_type = get_query_var(get_post_type());

				if ($post_type) {
					$post_type = $post_type;
				} else {
					$post_type = $post_types;
				}
				$query->set('post_type', $post_type);
			}
		}
		return $query;
	}
	add_filter('pre_get_posts', 'shopme_tag_archive_page');
}

/*	Add Thumbnail Size
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_add_thumbnail_size')) {

	function shopme_add_thumbnail_size($themeImgSizes) {
		if (function_exists('add_theme_support')) {
			foreach ($themeImgSizes as $size_name => $size) {
				if (!isset($themeImgSizes[$size_name]['crop'])) {
					$themeImgSizes[$size_name]['crop'] = true;
				}
				add_image_size($size_name,
					$themeImgSizes[$size_name]['width'],
					$themeImgSizes[$size_name]['height'],
					$themeImgSizes[$size_name]['crop']
				);
			}
		}
	}
}

/* 	Filter Hook for Comments
/* --------------------------------------------------------------------- */

if ( !function_exists('shopme_output_comments')) {

	function shopme_output_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>

		<li class="comment" id="comment-<?php echo comment_ID() ?>">

			<article>

				<!-- - - - - - - - - - - - - - Avatar - - - - - - - - - - - - - - - - -->

				<div class="gravatar">
					<?php
						$gravatar_alt = esc_html(get_comment_author());
						echo get_avatar($comment, 80, '', $gravatar_alt);
					?>
				</div>

				<!-- - - - - - - - - - - - - - End of avatar - - - - - - - - - - - - - - - - -->

				<!-- - - - - - - - - - - - - - Comment body - - - - - - - - - - - - - - - - -->

				<div class="comment-body">

					<header class="comment-meta">
						<h6 class="comment-author">
							<?php
								$author = '<span>' . get_comment_author() . '</span>';
								$link = get_comment_author_url();
								if (!empty($link)) {
									$author = '<a href="' . esc_url($link) . '">' . $author . '</a>';
								}
								echo $author;
							?>
						</h6>, <?php comment_date('Y-m-d') ?>
					</header>

					<p><?php comment_text(); ?></p>

				</div><!--/ .comment-body-->

				<!-- - - - - - - - - - - - - - End of comment body - - - - - - - - - - - - - - - - -->

				<?php echo get_comment_reply_link(array_merge(
					array('reply_text' => esc_html__('Quote', 'shopme')),
					array('depth' => $depth, 'max_depth' => $args['max_depth'])
				));
				?>

			</article>

		</li>

	<?php
	}
}

/* 	Filter Hooks for Respond
/* ---------------------------------------------------------------------- */

if ( !function_exists('shopme_comments_form_hook')) {

	function shopme_comments_form_hook ($defaults) {

		$commenter = wp_get_current_commenter();

		$req      = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$html_req = ( $req ? " required='required'" : '' );
		$required_text = sprintf( ' ' . esc_html__('Required fields are marked %s', 'shopme'), '<span class="required"></span>' );

		$defaults['fields']['author'] = '<div class="row"><div class="col-sm-6"><p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Name', 'shopme' ) . ( $req ? '<span class="required"></span>' : '' ) . '</label> ' .
				'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></p></div>';

		$defaults['fields']['email'] = '<div class="col-sm-6"><p class="comment-form-email"><label for="email">' . esc_html__( 'Email Address', 'shopme' ) . ( $req ? '<span class="required"></span>' : '' ) . '</label> ' .
				'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p></div></div>';

		$defaults['fields']['url'] = '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website URL', 'shopme' ) . '</label> ' .
				'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';

		$defaults['comment_notes_before'] = '<p class="comment-notes"><span id="email-notes">' . esc_html__( 'Your email address will not be published.', 'shopme' ) . '</span>'. ( $req ? $required_text : '' ) . '</p>';

		$defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment', 'shopme' ) . ( $req ? '<span class="required"></span>' : '' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" aria-describedby="form-allowed-tags" aria-required="true" required="required"></textarea></p>';

		$defaults['cancel_reply_link'] = ' - ' . esc_html__('Cancel quote', 'shopme');

		return $defaults;
	}
	add_filter('comment_form_defaults', 'shopme_comments_form_hook');
}

/*	Analytics Tracking Code
/* ---------------------------------------------------------------------- */

if ( !function_exists('shopme_get_tracking_code') ) {

	function shopme_get_tracking_code() {
		global $shopme_config;

		$shopme_config['analytics_code'] = shopme_custom_get_option('analytics');
		if (empty($shopme_config['analytics_code'])) return;

		if (strpos($shopme_config['analytics_code'],'UA-') === 0) {
			$shopme_config['analytics_code'] = "
			<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

				ga('create', '". $shopme_config['analytics_code'] ."', 'auto');
				ga('send', 'pageview');
			</script>";
		}
		add_action('wp_head', 'shopme_print_tracking_code');
	}

	add_action('init', 'shopme_get_tracking_code');

	function shopme_print_tracking_code() {
		global $shopme_config;
		if (!empty($shopme_config['analytics_code'])) {
			echo $shopme_config['analytics_code'];
		}
	}

}

/*	Array to data string
/* ---------------------------------------------------------------------- */

if ( !function_exists('shopme_create_data_string') ) {
	function shopme_create_data_string($data = array()) {
		$data_string = "";

		foreach ($data as $key => $value) {
			if (is_array($value)) $value = implode(", ", $value);
			$data_string .= " data-$key={$value} ";
		}
		return $data_string;
	}
}

/*	Gallery Shortcode
/* ---------------------------------------------------------------------- */

if ( !function_exists('shopme_gallery_shortcode') ) {

	function shopme_gallery_shortcode($atts) {
		$columns = $size = $ids = '';

		extract(shortcode_atts(array(
			'columns' => 5,
			'size'    => '',
			'ids'     => '',
		), $atts));

		$attachments = get_posts(array(
			'include' => $ids,
			'orderby' => 'post__in',
			'post_status' => 'inherit',
			'post_type' => 'attachment',
			'post_mime_type' => 'image'
		));

		$rand = rand(10, 25);

		ob_start(); ?>

		<?php if (!empty($attachments) && is_array($attachments)): ?>

			<?php
			switch ($columns) {
				case 2: $size = '450*300'; break;
				case 3: $size = '300*300'; break;
				case 4: $size = '200*160'; break;
				case 5: $size = '150*150'; break;
				default: $size = '150*150'; break;
			}
			?>

			<ul class="lightbox_list lightbox-columns-<?php echo esc_attr($columns) ?>">

				<?php foreach ($attachments as $attachment): ?>

					<?php
						$attachment_id = $attachment->ID;
						$title = get_the_title($attachment_id);
						$permalink = SHOPME_HELPER::get_post_attachment_image($attachment_id, '');
					?>

					<li>
						<a class="fancybox_item helper_list_icon" data-rel="group_<?php echo $rand; ?>" href="<?php echo esc_url($permalink) ?>" title="<?php echo esc_attr($title) ?>">
							<?php echo SHOPME_HELPER::get_the_thumbnail($attachment_id, $size, true, array( 'class' => '') ) ?>
							<span class="helper_icon">
								<span class="helper_left"></span>
								<span class="helper_right"></span>
							</span>
						</a>
					</li>

				<?php endforeach; ?>

			</ul><!--/ .lightbox_list-->

		<?php endif; return ob_get_clean();

	}
	add_shortcode('shopme_gallery', 'shopme_gallery_shortcode');
}

/*	Post ID
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_post_id')) {

	function shopme_post_id() {
		global $post, $shopme_config;
		$post_id = 0;
		if (isset( $post->ID )) {
			$post_id = $post->ID;
			$shopme_config['post_id'] = $post_id;
		} else {
			return get_the_ID();
		}
		return $post_id;
	}
}

/*	Body Background
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_body_background')) {

	function shopme_body_background() {
		$post_id = shopme_post_id();

		$color = mad_meta('shopme_bg_color', '', $post_id);
		$image = mad_meta('shopme_bg_image', '', $post_id);

		if (!empty($image) && $image > 0) {
			$image = wp_get_attachment_image_src($image, '');
			if (is_array($image) && isset($image[0])) {
				$image = $image[0];
			}
		}

		$image_repeat     = mad_meta('shopme_bg_image_repeat', '', $post_id);
		$image_position   = mad_meta('shopme_bg_image_position', '', $post_id);
		$image_attachment = mad_meta('shopme_bg_image_attachment', '', $post_id);

		$css = array();

		if (!empty( $image ) && !empty( $image_attachment )) { $css[] = "background-attachment: $image_attachment;"; }
		if (!empty( $image ) && !empty( $image_position ))   { $css[] = "background-position: $image_position;"; }
		if (!empty( $image ) && !empty( $image_repeat ))     { $css[] = "background-repeat: $image_repeat;"; }

		if (!empty( $color ))                     			 { $css[] = "background-color: $color;"; }
		if (!empty( $image ) && $image != 'none') 			 { $css[] = "background-image: url('$image');"; }

		if (empty( $css )) return;
		?>
		<style type="text/css">body { <?php echo implode( ' ', $css ) ?> } </style>

	<?php
	}

	add_filter('wp_head', 'shopme_body_background');
}


/*	Title
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_title')) {

	function shopme_title($args = false, $id = false) {

		if (!$id) $id = shopme_post_id();

		$defaults = array(
			'title' 	  => get_the_title($id),
			'subtitle'    => "",
			'output_html' => "<div class='extra-heading {class}'><{heading} class='extra-title'>{title}</{heading}>{additions}</div>",
			'class'		  => '',
			'heading'	  => 'h2',
			'additions'	  => ""
		);

		$args = wp_parse_args($args, $defaults);
		extract($args, EXTR_SKIP);

		if (!empty($subtitle)) {
			$class .= ' with-subtitle';
			$additions .= "<div class='title-meta'>" . do_shortcode(wpautop($subtitle)) . "</div>";
		}

		$output_html = str_replace('{class}', $class, $output_html);
		$output_html = str_replace('{heading}', $heading, $output_html);
		$output_html = str_replace('{title}', $title, $output_html);
		$output_html = str_replace('{additions}', $additions, $output_html);
		return $output_html;
	}
}

/*	Which Archive
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_which_archive')) {

	function shopme_which_archive() {

		ob_start(); ?>

		<?php if (is_category()): ?>

			<?php echo esc_html__('Archive for Category:', 'shopme') . " " . single_cat_title('', false); ?>

		<?php elseif (is_day()): ?>

			<?php echo esc_html__('Daily Archives:', 'shopme') . " " . get_the_time( __('F jS, Y', 'shopme')); ?>

		<?php elseif (is_month()): ?>

			<?php echo esc_html__('Monthly Archives:', 'shopme') . " " . get_the_time( __('F, Y', 'shopme')); ?>

		<?php elseif (is_year()): ?>

			<?php echo esc_html__('Yearly Archives:', 'shopme') . " " . get_the_time( __('Y', 'shopme')); ?>

		<?php elseif (is_search()): global $wp_query; ?>

			<?php if (!empty($wp_query->found_posts)): ?>

				<?php if ($wp_query->found_posts > 1): ?>

					<?php echo esc_html__('Search results for:', 'shopme')." " . esc_attr(get_search_query()) . " (". $wp_query->found_posts .")"; ?>

				<?php else: ?>

					<?php echo esc_html__('Search result for:', 'shopme')." " . esc_attr(get_search_query()) . " (". $wp_query->found_posts .")"; ?>

				<?php endif; ?>

			<?php else: ?>

				<?php if (!empty($_GET['s'])): ?>

					<?php echo esc_html__('Search results for:', 'shopme') . " " . esc_attr(get_search_query()); ?>

				<?php else: ?>

					<?php echo esc_html__('To search the site please enter a valid term', 'shopme'); ?>

				<?php endif; ?>

			<?php endif; ?>

		<?php elseif (is_author()): ?>

			<?php $auth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author')); ?>

			<?php if (isset($auth->nickname) && isset($auth->ID)): ?>

				<?php $name = $auth->nickname; ?>

				<?php echo esc_html__('Author Archive', 'shopme'); ?>
				<?php echo esc_html__('for:', 'shopme') . " " . $name; ?>

			<?php endif; ?>

		<?php elseif (is_tag()): ?>

			<?php echo esc_html__('Posts tagged &ldquo;', 'shopme') . " " . single_tag_title('', false) . '&rdquo;'; ?>

			<?php
			$term_description = term_description();
			if ( ! empty( $term_description ) ) {
				printf( '<div class="taxonomy-description">%s</div>', $term_description );
			}
			?>

		<?php elseif (is_tax()): ?>

			<?php $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); ?>

			<?php if (shopme_is_product_tag()): ?>
				<?php echo esc_html__('Products by:', 'shopme') . ' "' . $term->name . '" tag'; ?>
			<?php elseif(shopme_is_product_category()): ?>
				<?php echo esc_html__('Archive for category:', 'shopme') . " " . single_cat_title('', false); ?>
			<?php else: ?>
				<?php echo esc_html__('Archive for:', 'shopme') . " " . $term->name; ?>
			<?php endif; ?>

		<?php else: ?>

			<?php if (is_post_type_archive()): ?>
				<?php echo esc_html__('Archive ' . get_query_var('post_type'), 'shopme'); ?>
			<?php else: ?>
				<?php echo esc_html__('Archive', 'shopme'); ?>
			<?php endif; ?>

		<?php endif; ?>

		<?php return ob_get_clean();
	}
}

/*	Header Social Links
/* ---------------------------------------------------------------------- */

if (!function_exists('shopme_header_social_links')) {

	function shopme_header_social_links() {
		?>
		<ul class="social_links">

			<?php if ($facebook_link = shopme_custom_get_option('facebook_link')): ?>
				<li><a target="_blank" href="<?php echo esc_url($facebook_link) ?>"><i class="icon-facebook-1"></i></a></li>
			<?php endif; ?>

			<?php if ($twitter_link = shopme_custom_get_option('twitter_link')): ?>
				<li><a target="_blank" href="<?php echo esc_url($twitter_link) ?>"><i class="icon-twitter"></i></a></li>
			<?php endif; ?>

			<?php if ($gplus_link = shopme_custom_get_option('gplus_link')): ?>
				<li><a target="_blank" href="<?php echo esc_url($gplus_link) ?>"><i class="icon-gplus-2"></i></a></li>
			<?php endif; ?>

			<?php if ($pinterest_link = shopme_custom_get_option('pinterest_link')): ?>
				<li><a target="_blank" href="<?php echo esc_url($pinterest_link) ?>"><i class="icon-pinterest-1"></i></a></li>
			<?php endif; ?>

			<?php if ($instagram_link = shopme_custom_get_option('instagram_link')): ?>
				<li><a target="_blank" href="<?php echo esc_url($instagram_link) ?>"><i class="icon-instagram-4"></i></a></li>
			<?php endif; ?>

		</ul>
		<?php
	}

}

if (!function_exists('shopme_maps_key_for_plugins')) {

	add_filter( 'script_loader_src', 'shopme_maps_key_for_plugins', 10 , 99, 2 );

	function shopme_maps_key_for_plugins ( $url, $handle  ) {

		$key = shopme_custom_get_option( 'api-key-google-maps' );

		if ( ! $key ) { return $url; }

		if ( strpos( $url, "maps.google.com/maps/api/js" ) !== false || strpos( $url, "maps.googleapis.com/maps/api/js" ) !== false ) {
			if ( strpos( $url, "key=" ) === false ) {
				$url = "http://maps.google.com/maps/api/js?v=3.24";
				$url = esc_url( add_query_arg( 'key', $key, $url) );
			}
		}

		return $url;
	}
}