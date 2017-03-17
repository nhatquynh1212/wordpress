<?php
if (!class_exists('SHOPME_ADMIN_ASIDE_PANEL')) {

	class SHOPME_ADMIN_ASIDE_PANEL extends SHOPME_FRAMEWORK {

		function __construct() {

			add_action('init', array(&$this, 'init'));

			add_action('wp_ajax_send_contact_form', array(&$this, 'ajax_send_contact_form'));
			add_action('wp_ajax_nopriv_send_contact_form', array(&$this, 'ajax_send_contact_form'));
		}

		function init() {

			if ( is_admin() ) {

			} else {

				if (shopme_custom_get_option('show_admin_panel') == 'show_admin_panel') {

					$show_pinterest = shopme_custom_get_option('show_pinterest');
					if ($show_pinterest) {
						Shopme_Pinterest_Aside_Panel::get_instance();
					}

					$show_facebook_box = shopme_custom_get_option('show_facebook_box');
					if ($show_facebook_box) {
						Shopme_FacebookPageLikebox::get_instance();
					}

					add_action('shopme_body_append', array(&$this, 'output_panel'));
				}

			}
		}

		public function ajax_send_contact_form() {

			check_ajax_referer('send_contact_form');

			header( "Content-Type: application/json" );

			$required_fields = array("name", "email", "message");
			$data = $errors = array();
			parse_str($_POST['values'], $data);
			$result = array( 'text' => array('Sending mail error') );

			if (!empty($data)) {

				$emailto = $messages = '';
				$headers = "Content-Type: text/html; charset=\"" . get_option('blog_charset') . "\"\r\n";

				foreach ($data as $key => $value) {
					$name = strtolower(trim($key));
					if (in_array($name, $required_fields)) {
						if (empty($value)) {
							if ($name == "name") {
								$errors[$name] = esc_html__('Please enter your name before sending', 'shopme');
							}
							if ($name == "email") {
								if (!$this->isValidEmail($value)) {
									$errors[$name] = esc_html__('Please enter your email before sending', 'shopme');
								}
							}
							if ($name == "message") {
								$errors[$name] = esc_html__('Please enter your message', 'shopme');
							}
						}
					}
				}

				if (!empty($errors)) {
					$result['status'] = 'error';
					$result['text'] = $errors;
					echo json_encode($result);
					exit;
				}

				if (isset($data['email'])) {
					$from = trim($data['email']);
					$headers .= 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" ;
				}

				foreach ($data as $field => $text) {
					if (!empty($text)) {
						$ucfield = ucfirst($field);
						$text = nl2br($text);
						if (in_array($field, array('name', 'email', 'message'))) {
							$messages .= "<br><strong>{$ucfield}</strong> : {$text}";
						}
					}
				}

				$name = stripslashes($data['name']);
				$emailto = get_option('admin_email');

				if ($emailto) {
					$mail = wp_mail($emailto, $name, $messages, $headers);
					if ($mail) {
						$result = array(
							'status' => 'success',
							'text' => esc_html__('Your message has been sent successfully!', 'shopme')
						);
					} else {
						$result['status'] = 'error';
					}
				}
			}

			echo json_encode($result);
			exit();
		}

		public function isValidEmail($email) {
			return filter_var($email, FILTER_VALIDATE_EMAIL);
		}

		public function vk_output() {

			$show_vk_box = shopme_custom_get_option('show_vk_box');

			if ($show_vk_box):
				$vk_title = htmlspecialchars(shopme_custom_get_option('vk_title', esc_html__('Join Us on VK', 'shopme')));
				$vk_widget_community = shopme_custom_get_option('vk_widget_community', '', true);
			?>
				<li>

					<div class="dropdown-list">

						<button class="icon_btn middle_btn social_vk open_"><i class="icon-vk"></i></button>

						<section class="dropdown">

							<?php if (!empty($vk_title)): ?>
								<div class="animated_item"><h3 class="title"><?php echo esc_html($vk_title); ?></h3></div>
							<?php endif; ?>

							<?php if (strpos($vk_widget_community, 'vk.com/js/api/')) {
								echo '<div class="animated_item">';
								echo $vk_widget_community;
								echo '</div>';
							} ?>

						</section><!--/ .dropdown-->

					</div>

				</li>
			<?php endif;
		}

		public function facebook_output() {

			$show_facebook_box = shopme_custom_get_option('show_facebook_box');

			if ($show_facebook_box):
				$facebook_title = htmlspecialchars(shopme_custom_get_option('facebook_title', esc_html__('Join Us on Facebook', 'shopme')));
				$page_name = shopme_custom_get_option('facebook_page_name');
				$hide_cover = shopme_custom_get_option('facebook_hide_cover') ? 'true' : 'false';
				$show_facespile = shopme_custom_get_option('facebook_show_facespile') ? 'true' : 'false';
				$show_posts = shopme_custom_get_option('facebook_show_posts') ? 'true' : 'false';
				?>

				<li>

					<div class="dropdown-list">

						<button class="icon_btn middle_btn social_facebook open_"><i class="icon-facebook-1"></i></button>

						<section class="dropdown">

							<?php if (!empty($facebook_title)): ?>
								<div class="animated_item"><h3 class="title"><?php echo esc_html($facebook_title); ?></h3></div>
							<?php endif; ?>

							<?php if ($page_name): ?>
								<div class="animated_item">
									<?php echo do_shortcode('[mad_facebook_page_likebox page_name="'. $page_name .'" hide_cover="'. $hide_cover .'" show_facespile="'. $show_facespile .'" show_posts="'. $show_posts .'"]') ?>
								</div>
							<?php endif; ?>

						</section><!--/ .dropdown-->

					</div>

				</li>

			<?php endif;
		}

		public function latest_tweets_output() {

			$show_latest_tweets = shopme_custom_get_option('show_latest_tweets');

			if ($show_latest_tweets):
				SHOPME_BASE_FUNCTIONS::enqueue_script('tweet');
				$show_follow_button = shopme_custom_get_option('show_follow_button');
				$latest_tweets_title = htmlspecialchars(shopme_custom_get_option('latest_tweets_title', esc_html__('Latest Tweets', 'shopme')));
				$latest_tweets_username = shopme_custom_get_option('latest_tweets_username');
				$latest_tweets_count = shopme_custom_get_option('latest_tweets_count');

				if (empty($latest_tweets_count))
					$latest_tweets_count = 2;
			?>

				<li>

					<div class="dropdown-list">

						<button class="icon_btn middle_btn social_twitter open_"><i class="icon-twitter"></i></button>

						<section class="dropdown <?php if ($show_follow_button != 'show_follow_button') { echo 'no-follow-button'; } ?>">

							<?php if (!empty($latest_tweets_title)): ?>
								<div class="animated_item"><h3 class="title"><?php echo esc_html($latest_tweets_title); ?></h3></div>
							<?php endif; ?>

							<div class="tweet_list_wrap">
								<?php if ($latest_tweets_username): ?>
									<?php echo do_shortcode('[tweets max="'. esc_attr($latest_tweets_count) .'" user="'. esc_attr($latest_tweets_username) .'"]') ?>
								<?php endif; ?>
							</div>

							<?php if ($show_follow_button == 'show_follow_button' && !empty($latest_tweets_username)): ?>
								<footer class="animated_item bottom_box">
									<a target="_blank" href="https://twitter.com/<?php echo $latest_tweets_username ?>" class="button_grey middle_btn twitter_follow"><?php esc_html_e('Follow Us', 'shopme') ?></a>
								</footer><!--/ .animated_item-->
							<?php endif; ?>

						</section><!--/ .dropdown-->

					</div>

				</li>
			<?php endif;
		}

		public function contact_us_output() {

			$show_contact_us = shopme_custom_get_option('show_contact_us');

			if ($show_contact_us):
				$contact_us_title = htmlspecialchars(shopme_custom_get_option('contact_us_title', esc_html__('Contact Us', 'shopme')));
				$contact_us_short_text = htmlspecialchars(shopme_custom_get_option('contact_us_short_text', esc_html__('Lorem ipsum dolor sit amet, consectetuer adipis mauris', 'shopme')));
			?>
				<li>

					<div class="dropdown-list">

						<button class="icon_btn middle_btn social_contact open_"><i class="icon-mail-8"></i></button>

						<section class="dropdown">

							<?php if (!empty($contact_us_title)): ?>
								<div class="animated_item"><h3 class="title"><?php echo esc_html($contact_us_title); ?></h3></div>
							<?php endif; ?>

							<div class="animated_item">

								<p class="form_caption"><?php echo esc_html($contact_us_short_text); ?></p>

								<form id="contactform" data-nonce="<?php echo esc_attr(wp_create_nonce('send_contact_form')) ?>" method="post" class="contactform" >
									<ul>
										<li class="row">
											<div class="col-xs-12">
												<input type="text" required title="<?php esc_html_e('Name', 'shopme') ?>" name="name" placeholder="<?php esc_html_e('Your name', 'shopme') ?>">
											</div>
										</li>
										<li class="row">
											<div class="col-xs-12">
												<input type="email" required title="<?php esc_html_e('Email', 'shopme') ?>" name="email" placeholder="<?php esc_html_e('Your address', 'shopme') ?>">
											</div>
										</li>
										<li class="row">
											<div class="col-xs-12">
												<textarea placeholder="<?php esc_html_e('Message', 'shopme') ?>" required title="<?php esc_html_e('Message', 'shopme') ?>" name="message" rows="6"></textarea>
											</div>
										</li>
										<li class="row">
											<div class="col-xs-12">
												<button type="submit" class="button_grey middle_btn"><?php esc_html_e('Send', 'shopme'); ?></button>
											</div>
										</li>
									</ul>
								</form><!--/ .contactform-->

							</div>

						</section><!--/ .dropdown-->

					</div>

				</li>
			<?php endif;
		}

		public function store_location_output() {

			$show_store_location = shopme_custom_get_option('show_store_location');

			if ($show_store_location):
				$store_location_title = htmlspecialchars(shopme_custom_get_option('store_location_title', esc_html__('Store Location', 'shopme')));
				$store_location_address = htmlspecialchars(shopme_custom_get_option('store_location_address', esc_html__('8901 Marmora Road, Glasgow, D04 89GR.', 'shopme')));

				$store_location_embed_iframe = wp_kses(
					shopme_custom_get_option('store_location_embed_iframe', '', true), array(
						'iframe' => array(
							'src' => array(),
							'width' => array(),
							'height' => array(),
							'style' => array())
					)
				);
				$store_location_phone = htmlspecialchars(shopme_custom_get_option('store_location_phone'));
				$store_location_email = htmlspecialchars(shopme_custom_get_option('store_location_email'));
				$store_location_opening_hours = nl2br(shopme_custom_get_option('store_location_opening_hours'));
			?>
				<li>

					<div class="dropdown-list">

						<button class="icon_btn middle_btn social_gmap open_"><i class="icon-location-4"></i></button>

						<section class="dropdown">

							<?php if (!empty($store_location_title)): ?>
								<div class="animated_item"><h3 class="title"><?php echo esc_html($store_location_title); ?></h3></div>
							<?php endif; ?>

							<div class="animated_item">

								<p class="c_info_location"><?php echo esc_html($store_location_address); ?></p>

								<?php if (!empty($store_location_embed_iframe) && preg_match('/^\<iframe/', $store_location_embed_iframe)): ?>
									<div class="proportional_frame">
										<?php echo $store_location_embed_iframe; ?>
									</div>
								<?php endif; ?>

								<ul class="c_info_list">

									<?php if (!empty($store_location_phone)): ?>
										<li class="c_info_phone"><?php echo esc_html($store_location_phone) ?></li>
									<?php endif; ?>

									<?php if (!empty($store_location_email)): ?>
										<li class="c_info_mail">
											<a href="mailto:<?php echo $store_location_email; ?>"><?php echo esc_html($store_location_email); ?></a>
										</li>
									<?php endif; ?>

									<?php if (!empty($store_location_opening_hours)): ?>
										<li class="c_info_schedule">
											<?php echo $store_location_opening_hours; ?>
										</li>
									<?php endif; ?>

								</ul><!--/ .c_info_list-->

							</div>

						</section><!--/ .dropdown-->

					</div>

				</li>
			<?php endif;

		}

		public function instagram_output() {

			$show_instagram = shopme_custom_get_option('show_instagram');

			if ($show_instagram):
				$instagram_title = htmlspecialchars(shopme_custom_get_option('instagram_title', esc_html__('Instagram', 'shopme')));
				$instagram_iframe = wp_kses(
					shopme_custom_get_option('instagram_iframe', '', true), array(
						'iframe' => array(
							'src' => array(),
							'class' => array(),
							'title' => array(),
							'style' => array())
					)
				);
			?>
				<li>

					<div class="dropdown-list">

						<button class="icon_btn middle_btn social_instagram open_"><i class="icon-instagram-4"></i></button>

						<section class="dropdown">

							<?php if (!empty($instagram_title)): ?>
								<div class="animated_item"><h3 class="title"><?php echo esc_html($instagram_title); ?></h3></div>
							<?php endif; ?>

							<?php if (!empty($instagram_iframe) && preg_match('/^\<iframe/', $instagram_iframe)): ?>
								<div class="animated_item">
									<?php echo $instagram_iframe; ?>
								</div>
							<?php endif; ?>

						</section>

					</div>

				</li>
			<?php endif;
		}

		public function pinterest_output() {

			$show_pinterest = shopme_custom_get_option('show_pinterest');

			if ($show_pinterest):
				$pinterest_title = htmlspecialchars(shopme_custom_get_option('pinterest_title', esc_html__('Pinterest', 'shopme')));
				$pinterest_username = shopme_custom_get_option('pinterest_username');
				?>

				<li>

					<div class="dropdown-list">

						<button class="icon_btn middle_btn social_pinterest open_"><i class="icon-pinterest-1"></i></button>

						<section class="dropdown">

							<?php if (!empty($pinterest_title)): ?>
								<div class="animated_item"><h3 class="title"><?php echo esc_html($pinterest_title); ?></h3></div>
							<?php endif; ?>

							<?php if ($pinterest_username): ?>
								<div class="animated_item">
									<?php echo do_shortcode('[mad_pin_profile username="'. $pinterest_username .'" size="square"]') ?>
								</div>
							<?php endif; ?>

						</section><!--/ .dropdown-->

					</div>

				</li>

			<?php endif;
		}

		public function output_panel() {

			ob_start(); ?>

			<ul class="social_feeds">
				<?php $this->vk_output(); ?>
				<?php $this->pinterest_output(); ?>
				<?php $this->facebook_output(); ?>
				<?php $this->latest_tweets_output(); ?>
				<?php $this->contact_us_output(); ?>
				<?php $this->store_location_output(); ?>
				<?php $this->instagram_output(); ?>
			</ul>

			<?php echo ob_get_clean();
		}

	}

	new SHOPME_ADMIN_ASIDE_PANEL();

}