<?php

// -----------------------  Single Format ------------------------- //

add_filter( 'shopme-entry-format-single', 'shopme_single_post_filter', 11, 1 );

// ----------------------- Template Post Format ------------------------- //

add_filter( 'shopme-entry-format-template', 'shopme_template_post_filter', 11, 1 );

// ----------------------- Standard Post Format ------------------------- //

add_filter( 'shopme-entry-format-standard', 'shopme_standard_post_filter', 11, 1 );

// ------------------------ Gallery Post Format ------------------------- //

add_filter( 'shopme-entry-format-gallery', 'shopme_gallery_post_filter', 11, 1 );

// ------------------------- Video Post Format -------------------------- //

add_filter( 'shopme-entry-format-video', 'shopme_video_post_filter', 11, 1 );

// ------------------------- Audio Post Format -------------------------- //

add_filter( 'shopme-entry-format-audio', 'shopme_audio_post_filter', 11, 1 );

// ------------------------- Quote Post Format -------------------------- //

add_filter( 'shopme-entry-format-quote', 'shopme_quote_post_filter', 11, 1 );

//  Single Post Filter									//
// ==================================================== //

if (!function_exists('shopme_single_post_filter')) {

	function shopme_single_post_filter ($this_post) {

		preg_match("!\[(?:)?gallery.+?\]!", $this_post['content'], $match_gallery);

		if (!empty($match_gallery)) {

			$gallery = $match_gallery[0];

			if (strpos($gallery, 'vc_') === false) {
				$gallery = str_replace("gallery", 'shopme_gallery', $gallery);
			}

			$this_post['content'] = str_replace($match_gallery[0], $gallery, $this_post['content']);
		}
		return $this_post;
	}
}

//  Template Filter										//
// ==================================================== //

if (!function_exists('shopme_template_post_filter')) {

	function shopme_template_post_filter($this_post) {
		$thumbnail = $before = '';
		$this_id = $this_post['post_id'];
		$image_size = $this_post['image_size'];

		$thumbnail_atts = array(
			'class'	=> "tr_all_long_hover",
			'alt'	=> trim(strip_tags(get_the_excerpt())),
			'title'	=> trim(strip_tags(get_the_title()))
		);

		if (has_post_thumbnail($this_id)) {
			$thumbnail = SHOPME_HELPER::get_the_post_thumbnail($this_id, $image_size, true, $thumbnail_atts);
			$before = $thumbnail;
		} else {
			$image = shopme_regex($this_post['content'], 'image', "");
			if (is_array($image)) {
				$get_image = $image[0];
				$before = $get_image;
			} else {
				$image = shopme_regex($this_post['content'], '<img />', "");
				if (is_array($image)) {
					$before = $image[0];
				}
			}
		}

		if (is_string($before) && !empty($before)) {
			if ($thumbnail){
				$this_post['content'] = str_replace($thumbnail, "", $this_post['content']);
			}
			$this_post['before_content'] = $before;
		}
		$this_post['content'] = apply_filters('the_content', $this_post['content']);
		return $this_post;
	}
}

//  Standard Filter										//
// ==================================================== //

if (!function_exists('shopme_standard_post_filter')) {

	function shopme_standard_post_filter($this_post) {
		$before = '';
		$this_id = $this_post['post_id'];
		$image_size = $this_post['image_size'];

		$thumbnail_atts = array(
			'alt'	=> trim(strip_tags(get_the_excerpt())),
			'title'	=> trim(strip_tags(get_the_title()))
		);

		if (is_single()) {
			$link = SHOPME_HELPER::get_post_featured_image($this_id, '');
		} else {
			$link = $this_post['url'];
		}

		$link = esc_url($link);

		if (has_post_thumbnail($this_id)) {
			$thumbnail = SHOPME_HELPER::get_the_post_thumbnail($this_id, $image_size, true, $thumbnail_atts);
			$before = "<a href='{$link}' title='". sprintf(esc_attr__('%s', 'shopme'), get_the_title($this_id)) ."' class='lightbox-added'>{$thumbnail}</a>";
		}

		if (is_string($before) && !empty($before)) {
			$this_post['before_content'] = $before;
		}
		return $this_post;
	}
}

//  Gallery Post Filter									//
// ==================================================== //

if (!function_exists('shopme_gallery_post_filter')) {

	function shopme_gallery_post_filter ($this_post) {
		preg_match("!\[(?:)?gallery.+?\]!", $this_post['content'], $match_gallery);

		if (!empty($match_gallery)) {
			$gallery = $match_gallery[0];
            if (strpos($gallery, 'vc_') === false) {
				$gallery = str_replace("gallery", 'shopme_gallery image_size="'. $this_post['image_size'] .'" post_id="'. $this_post['post_id'] .'"', $gallery);
			}
            $this_post['before_content'] = do_shortcode($gallery);
			$this_post['content'] = str_replace($match_gallery[0], '', $this_post['content']);
			$this_post['content'] = apply_filters('the_content', $this_post['content']);
		}
		return $this_post;
	}
}

//  Audio Post Filter									//
// ==================================================== //

if (!function_exists('shopme_audio_post_filter')) {

	function shopme_audio_post_filter($this_post) {
		$this_post['content'] = preg_replace( '|^\s*(http?://[^\s"]+)\s*$|im', "[audio src='$1']", strip_tags($this_post['content']) );

//		preg_match("!\[audio.+?\]!", $this_post['content'], $match_audio);
//		preg_match("!\[embed.+?\]!", $this_post['content'], $match_embed);

//		if (!empty($match_embed) && strpos($match_embed[0], 'soundcloud.com') !== false) {
//			global $wp_embed;
//			$alias = $this_post['image_size'];
//			$embed = $match_embed[0];
//			$embed = str_replace('[embed]', '[embed width="'. $alias[0] .'" height="'. $alias[1] .'"]', $embed);
//
//			$this_post['before_content'] = "<div class='entry-media image-overlay'>";
//				$this_post['before_content'] .= $wp_embed->run_shortcode($embed);
//			$this_post['before_content'] .= "</div>";
//			$this_post['content'] = str_replace($match_embed[0], "", $this_post['content']);
//			return $this_post;
//		} else if (!empty($match_audio)) {
//			$this_post['before_content'] = "<div class='entry-media image-overlay'>";
//				$this_post['before_content'] .= do_shortcode($match_audio[0]);
//			$this_post['before_content'] .= "</div>";
//			$this_post['content'] = str_replace($match_audio[0], "", $this_post['content']);
//		}
		$this_post['content'] = apply_filters('the_content', $this_post['content']);
		return $this_post;
	}
}

//  Video Post Filter									//
// ==================================================== //

if (!function_exists('shopme_video_post_filter')) {

	function shopme_video_post_filter($this_post) {
		$this_post['content'] = preg_replace( '|^\s*(https?://[^\s"]+)\s*$|im', "[embed]$1[/embed]", strip_tags($this_post['content']));
//		preg_match("!\[embed.+?\]|\[video.+?\]!", $this_post['content'], $match_video);
//
//		if (!empty($match_video)) {
//			global $wp_embed;
//
//			$alias = $this_post['image_size'];
//			$video = $match_video[0];
//			$video = str_replace('[embed]', '[embed width="'. $alias[0] .'" height="'. $alias[1] .'"]', $video);
//
//			$this_post['before_content'] = "<div class='entry-media image-overlay'>";
//				$this_post['before_content'] .= do_shortcode($wp_embed->run_shortcode($video));
//			$this_post['before_content'] .= "</div>";
//			$this_post['content'] = str_replace($match_video[0], "", $this_post['content']);
//			$this_post['content'] = apply_filters('the_content', $this_post['content']);
//		}
		return $this_post;
	}
}

//  Quote Post Filter									//
// ==================================================== //

if (!function_exists('shopme_quote_post_filter')) {

	function shopme_quote_post_filter($this_post) {
		$post_id = $this_post['post_id'];

//		$output = '<div class="post-quote entry-media image-overlay">';
//			$output .= is_single() ? '' : '<a href="'. esc_url($this_post['url']) .'" class="whole-link" title="' . sprintf( esc_attr__('Permalink to %s', 'shopme'), the_title_attribute('echo=0') ) .'"></a>';
//			$output .= '<blockquote>'. mad_meta('shopme_quote', '', $post_id) .'</blockquote>';
//		$output .= '</div><!--/ .post-quote-->';
//
//		$this_post['before_content'] = $output;
//		$this_post['content'] = apply_filters('the_content', $this_post['content']);
		return $this_post;
	}
}