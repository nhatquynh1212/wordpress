<?php

/*  Register Widget Areas
/* ----------------------------------------------------------------- */

if (!function_exists('shopme_widgets_register')) {

	function shopme_widgets_register () {

		$before_widget = '<div id="%1$s" class="widget %2$s">';

		if ( shopme_custom_get_option('animate_widgets_pages') ) {
			$before_widget = '<div id="%1$s" data-animation="fadeInDown" class="widget animated %2$s">';
		}

		$widget_args = array(
			'before_widget' => $before_widget,
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		);

		// General Widget Area
		register_sidebar(array(
			'name' => 'General Widget Area',
			'id' => 'general-widget-area',
			'description'   => esc_html__('For all pages and posts.', 'shopme'),
			'before_widget' => $widget_args['before_widget'],
			'after_widget' => $widget_args['after_widget'],
			'before_title' => $widget_args['before_title'],
			'after_title' => $widget_args['after_title']
		));

		for ($i = 1; $i <= 25; $i++) {
			register_sidebar(array(
				'name' => 'Footer Row - widget ' . $i,
				'id' => 'footer-row-' . $i,
				'before_widget' => $widget_args['before_widget'],
				'after_widget' => $widget_args['after_widget'],
				'before_title' => $widget_args['before_title'],
				'after_title' => $widget_args['after_title']
			));
		}
	}
	add_action('widgets_init', 'shopme_widgets_register');
}

/*	Actions
/* ----------------------------------------------------------------- */

if (!function_exists('shopme_add_to_mailchimp_list')) {

	add_action('wp_ajax_add_to_mailchimp_list', 'shopme_add_to_mailchimp_list');
	add_action('wp_ajax_nopriv_add_to_mailchimp_list', 'shopme_add_to_mailchimp_list');

	function shopme_add_to_mailchimp_list() {

		check_ajax_referer('ajax-nonce', 'ajax_nonce');

		$_POST = array_map('stripslashes_deep', $_POST);
		$apikey = shopme_custom_get_option('mad_mailchimp_api');
		$dc = shopme_custom_get_option('mad_mailchimp_center');
		$list_id = shopme_custom_get_option('mad_mailchimp_id');
		$email = sanitize_email($_POST['email']);
		$name = sanitize_title($_POST['name']);

		if (empty($name) || $name == null) $name = '';

		$url = "https://$dc.api.mailchimp.com/2.0/lists/subscribe.json";
		$result = array();

		$request = wp_remote_post( $url, array(
			'body' => json_encode( array(
				'apikey' => $apikey,
				'id' => $list_id,
				'email' => array( 'email' => $email ),
				'merge_vars'        => array( 'FNAME' => $name )
			) )
		));

		$data = json_decode(wp_remote_retrieve_body( $request ));

		if (isset($data->error)) {
			$result['status'] = $data->status;
			$result['text'] = $data->error;
			echo json_encode($result);
			exit;
		}

		$result['status'] = 'success';
		$result['text']  = __('You\'ve been added to our sign-up list. We have sent an email, asking you to confirm the same.', 'shopme');

		echo json_encode($result);
		wp_die();
	}

}

/*	Include Widgets
/* ----------------------------------------------------------------- */

if (!function_exists('shopme_unregistered_widgets')) {
	function shopme_unregistered_widgets () {
		unregister_widget( 'LayerSlider_Widget' );
	}
	add_action('widgets_init', 'shopme_unregistered_widgets', 1);
}

/*	Widget Facebook Like Box
/* ----------------------------------------------------------------- */

if (!class_exists('shopme_like_box_facebook')) {

	class shopme_like_box_facebook extends WP_Widget {

		private static $id_of_like_box = 0;

		function __construct() {
			$widget_ops = array( 'classname' => 'like_box_facebook', 'description' => 'Like box Facebook ' ); // Widget Settings
			$control_ops = array( 'id_base' => 'like_box_facebook' ); // Widget Control Settings

			parent::__construct( 'like_box_facebook', 'Like box Facebook', $widget_ops, $control_ops ); // Create the widget
		}

		function widget($args, $instance) {
			self::$id_of_like_box++;
			extract( $args );
			$title = $instance['title'];
			$profile_id = $instance['profile_id'];
			$facebook_likebox_theme = $instance['facebook_likebox_theme'];
			$width = $instance['width'];
			$height = $instance['height'];
			$connections = $instance['connections'];
			$header = ($instance['header'] == 'yes') ? 'true' : 'false';

			// Before widget //
			echo $before_widget;

			// Title of widget //
			if ( $title ) { echo $before_title . $title . $after_title; }

			// Widget output //
			echo '<iframe id="like_box_widget_'. self::$id_of_like_box .'" src="https://www.facebook.com/plugins/likebox.php?href='. $profile_id .'&amp;colorscheme='. $facebook_likebox_theme .'&amp;width='. $width .'&amp;height='. $height .'&amp;connections='. $connections .'&amp;stream=false&amp;show_border=false&amp;header='. $header .'&amp;" scrolling="no" frameborder="0" allowTransparency="true" style="width:'. $width .'px; height:'. $height .'px;"></iframe>';

			echo $after_widget;
		}

		// Update Settings //
		function update ($new_instance, $old_instance) {
			$instance = $old_instance;

			$instance['title'] = strip_tags($new_instance['title']);
			$instance['profile_id'] = $new_instance['profile_id'];
			$instance['facebook_likebox_theme'] = $new_instance['facebook_likebox_theme'];
			$instance['width'] = $new_instance['width'];
			$instance['height'] = $new_instance['height'];
			$instance['connections'] = $new_instance['connections'];
			$instance['header'] =  $new_instance['header'];
			return $instance;
		}

		/* admin page opions */
		function form($instance) {

			$defaults = array(
				'title' => esc_html__('Like Us on Facebook', 'shopme'),
				'profile_id' => '',
				'facebook_likebox_theme' => 'light',
				'width' => '235',
				'height' => '345',
				'connections' => 10,
				'header' => 'yes'
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>

			<p class="flb_field">
				<label for="title"><?php esc_html_e('Title', 'shopme') ?>:</label><br>
				<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat">
			</p>

			<p class="flb_field">
				<label for="<?php echo $this->get_field_id('profile_id'); ?>"><?php esc_html_e('Page ID', 'shopme') ?>:</label><br>
				<input id="<?php echo $this->get_field_id('profile_id'); ?>" name="<?php echo $this->get_field_name('profile_id'); ?>" type="text" value="<?php echo $instance['profile_id']; ?>" class="widefat">
			</p>

			<p>
				<label><?php esc_html_e('Facebook Like box Theme', 'shopme'); ?>:</label><br>
				<select name="<?php echo $this->get_field_name('facebook_likebox_theme'); ?>">
					<option selected="selected" value="light"><?php esc_html_e('Light', 'shopme') ?></option>
					<option value="dark"><?php esc_html_e('Dark', 'shopme') ?></option>
				</select>
			</p>

			<p class="flb_field">
				<label for="<?php echo $this->get_field_id('width'); ?>"><?php esc_html_e('Like box Width', 'shopme') ?>:</label>
				<br>
				<input id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $instance['width']; ?>" class="" size="3">
				<small>(<?php esc_html_e('px', 'shopme') ?>)</small>
			</p>

			<p class="flb_field">
				<label for="<?php echo $this->get_field_id('height'); ?>"><?php esc_html_e("Like box Height", 'shopme') ?>:</label>
				<br>
				<input id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $instance['height']; ?>" class="" size="3">
				<small>(<?php esc_html_e('px', 'shopme') ?>)</small>
			</p>

			<p class="flb_field">
				<label for="<?php echo $this->get_field_id('connections'); ?>"><?php esc_html_e('Number of connections', 'shopme') ?>:</label>
				<br>
				<input id="<?php echo $this->get_field_id('connections'); ?>" name="<?php echo $this->get_field_name('connections'); ?>" type="text" value="<?php echo $instance['connections']; ?>" class="" size="3">
				<small>(<?php esc_html_e("Max. 100", 'shopme') ?>)</small>
			</p>

			<p class="flb_field">
				<label><?php esc_html_e('Show Header', 'shopme') ?>:</label><br>
				<input name="<?php echo $this->get_field_name('header'); ?>" type="radio" value="yes" <?php checked( $instance[ 'header' ], 'yes' ); ?>><?php esc_html_e("Yes", 'shopme') ?>
				<input name="<?php echo $this->get_field_name('header'); ?>" type="radio" value="no" <?php checked( $instance[ 'header' ], 'no'); ?>><?php esc_html_e("No", 'shopme') ?>
			</p>

			<?php
		}
	}

}

if (!class_exists('shopme_widget_popular_widget')) {

	class shopme_widget_popular_widget extends WP_Widget {

		public $defaults = array();
		public $version = "1.0.1";

		function __construct() {

			parent::__construct( 'popular-widget', SHOPME_THEMENAME .' '. esc_html__('Popular and Latest Posts', 'shopme'),
				array(
					'classname' => 'widget_popular_posts',
					'description' => esc_html__("Display most popular and latest posts", 'shopme')
				)
			);

			define('SHOPME_POPWIDGET_URL', SHOPME_INCLUDES_URI . 'widgets/popular-widget/');
			define('SHOPME_POPWIDGET_ABSPATH', str_replace("\\", "/", dirname(__FILE__) . '/widgets/popular-widget'));

			$this->defaults = array(
				'title' => '',
				'counter' => false,
				'excerptlength' => 5,
				'meta_key' => '_popular_views',
				'calculate' => 'visits',
				'limit' => 3,
				'thumb' => false,
				'excerpt' => false,
				'type' => 'popular'
			);

			add_action('admin_enqueue_scripts', array(&$this, 'load_admin_styles'));
			add_action('wp_enqueue_scripts', array(&$this, 'load_scripts_styles'), 1);
			add_action('wp_ajax_popwid_page_view_count', array(&$this, 'set_post_view'));
			add_action('wp_ajax_nopriv_popwid_page_view_count', array(&$this, 'set_post_view'));

		}

		function widget($args, $instance) {
			if (file_exists(SHOPME_POPWIDGET_ABSPATH . '/inc/widget.php')) {
				include(SHOPME_POPWIDGET_ABSPATH . '/inc/widget.php');
			}
		}

		function form($instance) {
			if (file_exists(SHOPME_POPWIDGET_ABSPATH . '/inc/form.php')) {
				include(SHOPME_POPWIDGET_ABSPATH . '/inc/form.php');
			}
		}

		function update($new_instance, $old_instance) {
			foreach ($new_instance as $key => $val) {
				if (is_array($val)) {
					$new_instance[$key] = $val;
				} elseif (in_array($key, array('limit', 'excerptlength'))) {
					$new_instance[$key] = intval($val);
				} elseif (in_array($key, array('calculate'))) {
					$new_instance[$key] = trim($val, ',');
				}
			}
			if (empty($new_instance['meta_key'])) {
				$new_instance['meta_key'] = $this->defaults['meta_key'];
			}
			return $new_instance;
		}

		function load_admin_styles() {
			global $pagenow;
			if ($pagenow != 'widgets.php' ) return;

			wp_enqueue_style( SHOPME_PREFIX . 'popular-admin', SHOPME_POPWIDGET_URL . 'css/admin.css', NULL, $this->version );
			wp_enqueue_script( SHOPME_PREFIX . 'popular-admin', SHOPME_POPWIDGET_URL . 'js/admin.js', array('jquery',), $this->version, true );
		}

		function load_scripts_styles(){

			if (! is_admin() || is_active_widget( false, false, $this->id_base, true )) {
				wp_enqueue_script( SHOPME_PREFIX . 'popular-widget', SHOPME_POPWIDGET_URL . 'js/pop-widget.js', array('jquery'), $this->version, true);
			}

			if (! is_singular() && ! apply_filters( 'pop_allow_page_view', false )) return;

			global $post;
			wp_localize_script ( SHOPME_PREFIX . 'popular-widget', 'popwid', apply_filters( 'pop_localize_script_variables', array(
				'postid' => $post->ID
			), $post ));
		}

		function field_id($field) {
			echo $this->get_field_id($field);
		}

		function field_name($field) {
			echo $this->get_field_name($field);
		}

		function limit_words($string, $word_limit) {
			$words = explode(" ", wp_strip_all_tags(strip_shortcodes($string)));

			if ($word_limit && (str_word_count($string) > $word_limit)) {
				return $output = implode(" ",array_splice( $words, 0, $word_limit )) ."...";
			} else if( $word_limit ) {
				return $output = implode(" ", array_splice( $words, 0, $word_limit ));
			} else {
				return $string;
			}
		}

		function get_post_image($post_id, $size) {

			if (has_post_thumbnail($post_id) && function_exists('has_post_thumbnail')) {
				return get_the_post_thumbnail($post_id, $size);
			}

			$images = get_children(array(
				'order' => 'ASC',
				'numberposts' => 1,
				'orderby' => 'menu_order',
				'post_parent' => $post_id,
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
			), $post_id, $size);

			if (empty($images)) return false;

			foreach($images as $image) {
				return wp_get_attachment_image($image->ID, $size);
			}
		}

		function set_post_view() {

			if (empty($_POST['postid'])) return;
			if (!apply_filters('pop_set_post_view', true)) return;

			global $wp_registered_widgets;

			$meta_key_old = false;
			$postid = (int) $_POST['postid'];
			$widgets = get_option($this->option_name);

			foreach ((array) $widgets as $number => $widget) {
				if (!isset($wp_registered_widgets["popular-widget-{$number}"])) continue;

				$instance = $wp_registered_widgets["popular-widget-{$number}"];
				$meta_key = isset( $instance['meta_key'] ) ? $instance['meta_key'] : '_popular_views';

				if ($meta_key_old == $meta_key) continue;

				do_action( 'pop_before_set_pos_view', $instance, $number );

				if (isset($instance['calculate']) && $instance['calculate'] == 'visits') {
					if (!isset( $_COOKIE['popular_views_'.COOKIEHASH])) {
						setcookie( 'popular_views_' . COOKIEHASH, "$postid|", 0, COOKIEPATH );
						update_post_meta( $postid, $meta_key, get_post_meta( $postid, $meta_key, true ) +1 );
					} else {
						$views = explode("|", $_COOKIE['popular_views_' . COOKIEHASH]);
						foreach( $views as $post_id ){
							if( $postid == $post_id ) {
								$exist = true;  break;
							}
						}
					}
					if (empty($exist)) {
						$views[] = $postid;
						setcookie( 'popular_views_' . COOKIEHASH, implode( "|", $views ), 0 , COOKIEPATH );
						update_post_meta( $postid, $meta_key, get_post_meta( $postid, $meta_key, true ) +1 );
					}
				} else {
					update_post_meta( $postid, $meta_key, get_post_meta( $postid, $meta_key, true ) +1 );
				}
				$meta_key_old = $meta_key;
				do_action( 'pop_after_set_pos_view', $instance, $number );
			}
			die();
		}

		function get_latest_posts() {
			extract($this->instance);
			$posts = wp_cache_get("pop_latest_{$number}", 'pop_cache');

			if ($posts == false) {
				$args = array(
					'suppress_fun' => true,
					'post_type' => 'post',
					'posts_per_page' => $limit
				);
				$posts = get_posts(apply_filters('pop_get_latest_posts_args', $args));
				wp_cache_set("pop_latest_{$number}", $posts, 'pop_cache');

			}
			return $this->display_posts($posts);
		}

		function get_most_viewed() {
			extract($this->instance);
			$viewed = wp_cache_get("pop_viewed_{$number}", 'pop_cache');

			if ($viewed == false) {
				global $wpdb;  $join = $where = '';
				$viewed = $wpdb->get_results( $wpdb->prepare( "SELECT SQL_CALC_FOUND_ROWS p.*, meta_value as views FROM $wpdb->posts p " .
					"JOIN $wpdb->postmeta pm ON p.ID = pm.post_id AND meta_key = %s AND meta_value != '' " .
					"WHERE 1=1 AND p.post_status = 'publish' AND post_date >= '{$this->time}' AND p.post_type IN ( 'post' )" .
					"GROUP BY p.ID ORDER BY ( meta_value+0 ) DESC LIMIT $limit", $meta_key));
				wp_cache_set( "pop_viewed_{$number}", $viewed, 'pop_cache');
			}

			return $this->display_posts($viewed);
		}

		function display_posts($posts) {
			if (empty ($posts) && !is_array($posts)) return;

			extract( $this->instance );

			ob_start(); ?>

			<?php foreach ($posts as $key => $post) : ?>

				<li><article class="entry">

						<?php if (!empty($thumb)): ?>

							<?php if (has_post_thumbnail($post->ID)): ?>

								<?php $image = SHOPME_HELPER::get_the_post_thumbnail($post->ID, '80*50', true, array('title' => esc_attr( $post->post_title ), 'alt' => esc_attr( $post->post_title ))); ?>

								<?php if (isset($image)): ?>
									<a class="entry_thumb" href="<?php echo esc_url( get_permalink( $post->ID ) ) ?>" title="<?php echo esc_attr( $post->post_title ); ?>">
										<?php echo $image; ?>
									</a>
								<?php endif; ?>

								<div class="wrapper">

									<h6 class="entry_title">
										<a href="<?php echo esc_url(get_permalink($post->ID)) ?>">
											<?php echo $post->post_title ?>
										</a>
									</h6>

									<div class="entry_meta">
										<span><i class="icon-calendar"></i> <?php echo get_the_time(get_option( 'date_format' ), $post->ID); ?></span>

										<?php if (!empty($counter) && isset($post->views)): ?>
											<span><i class="icon-eye-3"></i> <?php echo preg_replace( "/(?<=\d)(?=(\d{3})+(?!\d))/", ",", $post->views) ?></span>
										<?php endif; ?>
									</div><!--/ .entry_meta-->

									<?php if (!empty($excerpt)): ?>
										<?php if ($post->post_excerpt): ?>
											<p class="entry-post-summary"><?php echo $this->limit_words( ( $post->post_excerpt ), $excerptlength ); ?></p>
										<?php else: ?>
											<p class="entry-post-summary"><?php echo $this->limit_words( ( $post->post_content ), $excerptlength ); ?></p>
										<?php endif; ?>
									<?php endif; ?>

								</div><!--/ .wrapper-->

							<?php endif; ?>

						<?php endif; ?>

					</article></li>

			<?php endforeach; return ob_get_clean();
		}

	}
}


/*	Widget Social Links
/* ----------------------------------------------------------------- */

if (!class_exists('shopme_widget_social_links')) {

	class shopme_widget_social_links extends SHOPME_Widget {

		function __construct() {
			$this->widget_cssclass    = 'widget_social_links';
			$this->widget_description =  esc_html__('Displays website social links', 'shopme');
			$this->widget_id          = 'widget-social-links';
			$this->widget_name        = SHOPME_THEMENAME .' '. esc_html__('Social Links', 'shopme');
			$this->settings           = array(
				'title'  => array(
					'type'  => 'text',
					'label' => esc_html__( 'Title', 'shopme' ),
					'std'   => esc_html__( 'Social Links', 'shopme' )
				),
				'facebook_links'  => array(
					'type'  => 'text',
					'label' => esc_html__('Facebook Link', 'shopme'),
					'std'   => esc_html__( 'http://www.facebook.com', 'shopme' )
				),
				'twitter_links'  => array(
					'type'  => 'text',
					'label' => esc_html__('Twitter Link', 'shopme'),
					'std'   => esc_html__( 'https://twitter.com', 'shopme' )
				),
				'gplus_links'  => array(
					'type'  => 'text',
					'label' => esc_html__('Google Plus Link', 'shopme'),
					'std'   => esc_html__( 'http://plus.google.com/', 'shopme' )
				),
				'pinterest_links'  => array(
					'type'  => 'text',
					'label' => esc_html__('Pinterest Link', 'shopme'),
					'std'   => esc_html__( 'https://www.pinterest.com/', 'shopme' )
				),
				'instagram_links'  => array(
					'type'  => 'text',
					'label' => esc_html__('Instagram Link', 'shopme'),
					'std'   => esc_html__( 'http://instagram.com', 'shopme' )
				),
				'linkedin_links'  => array(
					'type'  => 'text',
					'label' => esc_html__('LinkedIn Link', 'shopme'),
					'std'   => esc_html__( 'http://linkedin.com/', 'shopme' )
				),
				'vimeo_links'  => array(
					'type'  => 'text',
					'label' => esc_html__('Vimeo Link', 'shopme'),
					'std'   => esc_html__( 'https://vimeo.com/', 'shopme' )
				),
				'youtube_links'  => array(
					'type'  => 'text',
					'label' => esc_html__('Youtube Link', 'shopme'),
					'std'   => esc_html__( 'https://youtube.com/', 'shopme' )
				),
				'flickr_links'  => array(
					'type'  => 'text',
					'label' => esc_html__('Pinterest Link', 'shopme'),
					'std'   => esc_html__( 'https://www.flickr.com/', 'shopme' )
				),
				'vk_links'  => array(
					'type'  => 'text',
					'label' => esc_html__('Vkontakte Link', 'shopme'),
					'std'   => esc_html__( 'https://www.vk.com/', 'shopme' )
				),
				'contact_us'  => array(
					'type'  => 'text',
					'label' => esc_html__('Contact us', 'shopme'),
					'std'   => esc_html__( 'your@mail.com', 'shopme' )
				),
			);
			parent::__construct();
		}

		function widget($args, $instance) {
			$data = array();
			$data['facebook_links'] = isset( $instance['facebook_links'] ) ? $instance['facebook_links'] : $this->settings['facebook_links']['std'];
			$data['twitter_links'] = isset( $instance['twitter_links'] ) ? $instance['twitter_links'] : $this->settings['twitter_links']['std'];
			$data['gplus_links'] = isset( $instance['gplus_links'] ) ? $instance['gplus_links'] : $this->settings['gplus_links']['std'];
			$data['pinterest_links'] = isset( $instance['pinterest_links'] ) ? $instance['pinterest_links'] : $this->settings['pinterest_links']['std'];
			$data['instagram_links'] = isset( $instance['instagram_links'] ) ? $instance['instagram_links'] : $this->settings['instagram_links']['std'];
			$data['linkedin_links'] = isset( $instance['linkedin_links'] ) ? $instance['linkedin_links'] : $this->settings['linkedin_links']['std'];
			$data['vimeo_links'] = isset( $instance['vimeo_links'] ) ? $instance['vimeo_links'] : $this->settings['vimeo_links']['std'];
			$data['youtube_links'] = isset( $instance['youtube_links'] ) ? $instance['youtube_links'] : $this->settings['youtube_links']['std'];
			$data['flickr_links'] = isset( $instance['flickr_links'] ) ? $instance['flickr_links'] : $this->settings['flickr_links']['std'];
			$data['vk_links'] = isset( $instance['vk_links'] ) ? $instance['vk_links'] : $this->settings['vk_links']['std'];
			$data['contact_us'] = isset( $instance['contact_us'] ) ? $instance['contact_us'] : $this->settings['contact_us']['std'];

			$this->widget_start( $args, $instance );
				echo SHOPME_HELPER::output_widgets_html('social_links', $data);
			$this->widget_end($args);
		}

	}
}

/*	Widget Advertising Area
/* ----------------------------------------------------------------- */

if (!class_exists('SHOPME_widget_advertising_area')) {

	class SHOPME_widget_advertising_area extends SHOPME_Widget {

		function __construct() {
			$this->widget_cssclass    = 'widget_advertising_area';
			$this->widget_description = esc_html__('An advertising widget that displays image', 'shopme');
			$this->widget_id          = __CLASS__;
			$this->widget_name        = SHOPME_THEMENAME.' '. esc_html__('Advertising Area', 'shopme');
			$this->settings           = array(
				'title'  => array(
					'type'  => 'text',
					'std'   => '',
					'label' => esc_html__( 'Title', 'shopme' )
				),
				'image_url'  => array(
					'type'  => 'text',
					'std'   => '',
					'label' => esc_html__( 'Image URL', 'shopme' )
				),
				'ref_url'  => array(
					'type'  => 'text',
					'std'   => '#',
					'label' => esc_html__( 'Referal URL', 'shopme' )
				),
			);

			parent::__construct();
		}

		function widget($args, $instance) {
			$title = isset( $instance['title'] ) ? $instance['title'] : $this->settings['title']['std'];
			$image_url = isset( $instance['image_url'] ) ? $instance['image_url'] : $this->settings['image_url']['std'];
			$ref_url = isset( $instance['ref_url'] ) ? $instance['ref_url'] : $this->settings['ref_url']['std'];

			if (empty($image_url)) {
				$image_url = '<span>'.esc_html__('Advertise here', 'shopme').'</span>';
			} else {
				$image_url = '<img class="advertise-image" src="' . esc_url($image_url) . '" title="" alt=""/>';
			}

			ob_start(); ?>

			<?php $this->widget_start( $args, $instance ); ?>
				<a target="_blank" href="<?php echo esc_url($ref_url); ?>"><?php echo $image_url; ?></a>
			<?php $this->widget_end($args);

			echo ob_get_clean();
		}

	}
}

/*	Widget Contact Us
/* ----------------------------------------------------------------- */

if (!class_exists('shopme_widget_contact_us')) {

	class shopme_widget_contact_us extends WP_Widget {

		function __construct() {
			$settings = array('classname' => 'widget_contact_us', 'description' => esc_html__('Displays contact us', 'shopme'));

			parent::__construct(__CLASS__, SHOPME_THEMENAME .' '. esc_html__('Contact Us', 'shopme'), $settings);
		}

		function widget($args, $instance) {
			extract($args, EXTR_SKIP);

			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			$address = empty($instance['address']) ? '' : $instance['address'];
			$phone = empty($instance['phone']) ? '' : $instance['phone'];
			$email = empty($instance['email']) ? '' : $instance['email'];
			$hours = empty($instance['hours']) ? '' : $instance['hours'];

			ob_start(); ?>

			<?php echo $before_widget; ?>

			<?php if ($title !== ''): ?>
				<?php echo $before_title . $title . $after_title; ?>
			<?php endif; ?>

			<ul class="c_info_list">

				<?php if (!empty($address)): ?>
					<li class="c_info_location">
						<?php echo $address ?>
					</li>
				<?php endif; ?>

				<?php if (!empty($phone)): ?>
					<li class="c_info_phone">
						<?php echo $phone ?>
					</li>
				<?php endif; ?>

				<?php if (!empty($email)): ?>
					<li class="c_info_mail">
						<a target="_blank" class="over" href="mailto:<?php echo antispambot($email, 1) ?>"><?php echo $email ?></a>
					</li>
				<?php endif; ?>

				<?php if (!empty($hours)): ?>
					<li class="c_info_schedule">
						<?php echo $hours ?>
					</li>
				<?php endif; ?>

			</ul><!--/ .c_info_list-->

			<?php echo $after_widget; ?>

			<?php echo ob_get_clean();
		}

		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			foreach($new_instance as $key => $value) {
				if ($key == 'hours') { $instance[$key] = $new_instance[$key]; continue; }
				$instance[$key]	= strip_tags($new_instance[$key]);
			}
			return $instance;
		}

		function form($instance) {
			$defaults = array(
				'title' => esc_html__('Contact Us', 'shopme'),
				'address' => esc_html__('8901 Marmora Road, Glasgow, D04 89GR.', 'shopme'),
				'phone' => '800-559-65-80',
				'email' => 'info@companyname.com',
				'hours' => wp_kses(__('Monday - Friday: 08.00-20.00 <br> Saturday: 09.00-15.00 <br> Sunday: closed', 'shopme'), array('br' => array()))
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>

			<p>
				<label><?php esc_html_e('Title', 'shopme');?>:
					<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
				</label>
			</p>

			<p>
				<label><?php esc_html_e('Address', 'shopme');?>:
					<input id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" value="<?php echo $instance['address']; ?>" class="widefat" type="text"/>
				</label>
			</p>

			<p>
				<label><?php esc_html_e('Phone', 'shopme');?>:
					<input id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" value="<?php echo $instance['phone']; ?>" class="widefat" type="text"/>
				</label>
			</p>

			<p>
				<label><?php esc_html_e('E-mail', 'shopme');?>:
					<input id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>" class="widefat" type="text"/>
				</label>
			</p>

			<p>
				<label><?php esc_html_e('Working hours', 'shopme');?>:
					<input id="<?php echo $this->get_field_id( 'hours' ); ?>" name="<?php echo $this->get_field_name( 'hours' ); ?>" value="<?php echo $instance['hours']; ?>" class="widefat" type="text"/>
				</label>
			</p>

		<?php
		}

	}
}


/*	Widget Testimonials
/* ----------------------------------------------------------------- */

if (!class_exists('SHOPME_widget_testimonials')) {

	class SHOPME_widget_testimonials extends SHOPME_Widget {

		public $entries = '';

		public function __construct() {
			$this->widget_cssclass    = 'widget_testimonials';
			$this->widget_description = esc_html__('Use this widget to add a testimonials to your site.', 'shopme');
			$this->widget_id          = 'widget-testimonials';
			$this->widget_name        = SHOPME_THEMENAME .' '. esc_html__('Testimonials', 'shopme');
			$this->settings           = array(
				'title'  => array(
					'type'  => 'text',
					'std'   => esc_html__( 'Testimonials', 'shopme' ),
					'label' => esc_html__( 'Title', 'shopme' )
				),
				'count' => array(
					'type'  => 'select',
					'std'   => '-1',
					'label' => esc_html__( 'Count', 'shopme' ),
					'options' => $this->array_number(1, 11, 1, array('-1' => 'All')),
					'desc' => esc_html__( 'How many items should be displayed per page?', 'shopme' )
				),
				'type' => array(
					'type'  => 'select',
					'std'   => 'list',
					'label' => esc_html__( 'Type', 'shopme' ),
					'options' => array(
						'widgets_list' => esc_html__('List', 'shopme'),
						'widgets_carousel' => esc_html__('Carousel', 'shopme')
					),
					'desc' => esc_html__( 'How many items should be displayed per page?', 'shopme' )
				),
				'orderby' => array(
					'type'  => 'select',
					'std'   => 'date',
					'label' => esc_html__( 'Order by', 'shopme' ),
					'options' => $this->get_order_sort_array()
				)
			);

			parent::__construct();
		}

		function widget($args, $instance) {
			$count = isset( $instance['count'] ) ? $instance['count'] : $this->settings['count']['std'];
			$type = isset( $instance['type'] ) ? $instance['type'] : $this->settings['type']['std'];
			$orderby = isset( $instance['orderby'] ) ? $instance['orderby'] : $this->settings['orderby']['std'];

			$query = array(
				'post_type' => 'testimonials',
				'orderby' => $orderby,
				'posts_per_page' => $count
			);

			$this->entries = new WP_Query($query);

			if (empty($this->entries) || empty($this->entries->posts)) return;

			$this->widget_start( $args, $instance ); ?>

			<div class="<?php echo esc_attr($type) ?>">

				<?php foreach ($this->entries->posts as $entry):
						$id = $entry->ID;
						$name = get_the_title($id);
						$link  = get_permalink($id);
						$place = mad_meta('shopme_tm_place', '', $id);
					?>
					<blockquote>
						<div class="author_info"><a href="<?php echo esc_url($link); ?>"><b><?php echo esc_html($name) ?>, <?php echo esc_html($place) ?></b></a></div>
						<p><?php echo $entry->post_content; ?></p>
					</blockquote>
				<?php endforeach; ?>

			</div><!--/ .widgets_carousel-->

			<footer class="bottom_box">
				<a href="<?php echo esc_url(get_post_type_archive_link('testimonials')); ?>" class="button_grey middle_btn">
					<?php esc_html_e('View All Testimonials', 'shopme') ?>
				</a>
			</footer><!--/ .bottom_box-->

			<?php $this->widget_end($args);
		}

		public function array_number($from = 0, $to = 50, $step = 1, $array = array()) {
			for ($i = $from; $i <= $to; $i += $step) {
				$array[$i] = $i;
			}
			return $array;
		}

		public function get_order_sort_array() {
			return array('ID' => 'ID', 'date' => 'date', 'post_date' => 'post_date', 'title' => 'title',
				'post_title' => 'post_title', 'name' => 'name', 'post_name' => 'post_name', 'modified' => 'modified',
				'post_modified' => 'post_modified', 'modified_gmt' => 'modified_gmt', 'post_modified_gmt' => 'post_modified_gmt',
				'menu_order' => 'menu_order', 'parent' => 'parent', 'post_parent' => 'post_parent',
				'rand' => 'rand', 'comment_count' => 'comment_count', 'author' => 'author', 'post_author' => 'post_author');
		}

	}
}

/*	Mailchimp Widget
/* ----------------------------------------------------------------- */

if (!class_exists('shopme_widget_mailchimp')) {

	class shopme_widget_mailchimp extends WP_Widget {

		public $data = '';
		public $version = '1.0';

		function __construct() {
			$settings = array('classname' => 'widget_zn_mailchimp', 'description' => esc_html__('Use this widget to add a mailchimp newsletter to your site.', 'shopme'));
			parent::__construct('widget-zn-mailchimp', SHOPME_THEMENAME .' '. esc_html__('Newsletter', 'shopme'), $settings);

			define('SHOPME_MAILCHIMP_URL', SHOPME_INCLUDES_URI . 'widgets/mailchimp/');
			define('SHOPME_MAILCHIMP_ABSPATH', str_replace("\\", "/", dirname(__FILE__) . '/widgets/mailchimp'));

			add_action('wp_enqueue_scripts', array(&$this, 'load_script'), 1);
		}

		function load_script() {
			wp_enqueue_script('jquery-form');

			if ( is_active_widget( false, false, 'widget-zn-mailchimp', true ) && ! is_admin() ) {
				wp_enqueue_script( SHOPME_PREFIX . 'newsletter-widget', SHOPME_MAILCHIMP_URL . 'js/newsletter.js', array('jquery'), $this->version, true );
			}
		}

		function widget($args, $instance) {
			if (file_exists(SHOPME_MAILCHIMP_ABSPATH . '/inc/widget.php')) {
				include(SHOPME_MAILCHIMP_ABSPATH . '/inc/widget.php');
			}
		}

		function update( $new_instance, $old_instance ) {
			$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
			$instance['mailchimp_intro'] =  stripslashes($new_instance['mailchimp_intro']) ;
			return $instance;
		}

		function form( $instance ) {
			if (file_exists(SHOPME_MAILCHIMP_ABSPATH . '/inc/form.php')) {
				include(SHOPME_MAILCHIMP_ABSPATH . '/inc/form.php');
			}
		}
	}
}

/*	Widget Flickr
/* ----------------------------------------------------------------- */

if (!class_exists('shopme_widget_flickr')) {

	class shopme_widget_flickr extends WP_Widget {

		function __construct() {
			$settings = array('classname' => 'widget_flickr', 'description' => esc_html__('Flickr feed widget', 'shopme'));
			parent::__construct(__CLASS__,  SHOPME_THEMENAME .' '. esc_html__('Flickr feed', 'shopme'), $settings);
		}

		function widget($args, $instance) {
			extract($args, EXTR_SKIP);

			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			$unique_id = rand(0, 300);

			SHOPME_BASE_FUNCTIONS::enqueue_script('jflickrfeed');

			echo $before_widget;

			if ($title !== '') {
				echo $before_title . $title . $after_title;
			}

			?>

			<ul id="flickr_feed_<?php echo $unique_id ?>" class="flickr-feed"></ul>

			<script type="text/javascript">
				jQuery(function () {
					jQuery('#flickr_feed_<?php echo $unique_id ?>').jflickrfeed({
						limit: <?php echo $instance['imagescount'] ?>,
						qstrings: { id: '<?php echo $instance['username'] ?>' },
						itemTemplate: '<li><a target="_blank" href="{{image_b}}"><img src="{{image_s}}" alt="{{title}}" /></a></li>'
					});
				});
			</script>

			<?php echo $after_widget;
		}

		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['username'] = $new_instance['username'];
			$instance['imagescount'] = (int) $new_instance['imagescount'];
			return $instance;
		}

		function form($instance) {
			$defaults = array(
				'title' => 'Flickr Feed',
				'username' => '76745153@N04',
				'imagescount' => '8',
			);
			$instance = wp_parse_args((array) $instance, $defaults); ?>

			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title', 'shopme') ?>:</label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('username'); ?>"><?php esc_html_e('Flickr Username', 'shopme') ?>:</label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" value="<?php echo $instance['username']; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('imagescount'); ?>"><?php esc_html_e('Number of images', 'shopme') ?>:</label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('imagescount'); ?>" name="<?php echo $this->get_field_name('imagescount'); ?>" value="<?php echo $instance['imagescount']; ?>" />
			</p>

		<?php
		}

	}
}

add_action('widgets_init', create_function('', 'return register_widget("shopme_widget_popular_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("shopme_widget_social_links");'));
add_action('widgets_init', create_function('', 'return register_widget("shopme_widget_advertising_area");'));
add_action('widgets_init', create_function('', 'return register_widget("shopme_widget_contact_us");'));
add_action('widgets_init', create_function('', 'return register_widget("shopme_widget_testimonials");'));
add_action('widgets_init', create_function('', 'return register_widget("shopme_widget_mailchimp");'));
add_action('widgets_init', create_function('', 'return register_widget("shopme_widget_flickr");'));
add_action('widgets_init', create_function('', 'return register_widget("shopme_like_box_facebook");'));

?>