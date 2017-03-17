<?php

if (!class_exists('SHOPME_CUSTOM_TABS')) {

	class SHOPME_CUSTOM_TABS {

		public $paths = array();

		public function path($name, $file = '') {
			return $this->paths[$name] . (strlen($file) > 0 ? '/' . preg_replace('/^\//', '', $file) : '');
		}

		public function assetUrl($file)  {
			return $this->paths['BASE_URI'] . $this->path('ASSETS_DIR_NAME', $file);
		}

		function __construct() {

			$this->paths = array(
				'BASE_URI' => SHOPME_BASE_URI . trailingslashit('config-woocommerce'),
				'ASSETS_DIR_NAME' => 'assets'
			);

			if (is_admin()) {
				add_action('add_meta_boxes', array(&$this, 'dynamic_add_custom_tab'));

				add_action('load-post.php', array($this, 'add_assets') , 4);
				add_action('load-post-new.php', array($this, 'add_assets') , 4 );

				/* Do something with the data entered */
				add_action('save_post', array(&$this, 'dynamic_save_postdata') );
			} else {
				add_action('init', array(&$this, 'init'));
			}

		}

		function init() {
			add_filter('woocommerce_product_tabs', array(&$this, 'product_custom_tabs'));
		}

		function product_custom_tabs ($tabs) {
			global $post;

			$custom_tabs = get_post_meta($post->ID, 'shopme_custom_tabs', true);
			$priority = apply_filters('shopme_wc_product_custom_tab_priority', 50);

			if (!shopme_custom_get_option('show_review_tab')) {
				unset($tabs['reviews']);
			}

			if (isset($custom_tabs) && !empty($custom_tabs) && count($custom_tabs) > 0) {
				foreach(@$custom_tabs as $id => $tab) {
					if (isset($tab['shopme_title_product_tab']) && $tab['shopme_title_product_tab'] != '' && isset($tab['shopme_content_product_tab'])) {
						$tabs[$id] = array(
							'title' => $tab['shopme_title_product_tab'],
							'priority' => $priority,
							'callback' => 'shopme_woocommerce_product_custom_tab'
						);
					}
					$priority = $priority + 1;
				}
			}
			return $tabs;
		}

		function add_assets() {
			add_action('print_media_templates', array(&$this, 'add_tmpl') );
			wp_enqueue_script( SHOPME_PREFIX . 'custom_tab_js', $this->assetUrl('js/custom_tab.js'), array('jquery'));
			wp_enqueue_style( SHOPME_PREFIX . 'custom_tab_css', $this->assetUrl('css/custom_tab.css'));
		}

		public function add_tmpl() {

			$settings = array(
				'textarea_name' => 'shopme_custom_tabs[__REPLACE_SSS__][shopme_content_product_tab]',
				'textarea_rows' => 3,
				'quicktags' => true,
				'tinymce' => false
			);

			ob_start(); ?>

			<script type="text/html" id="tmpl-add-custom-tab">
				<li>
					<div class="handle-area"></div>
					<div class="item">
						<h3><?php esc_html_e('Title Custom Tab', 'shopme'); ?></h3>
						<input type="text" name="shopme_custom_tabs[__REPLACE_SSS__][shopme_title_product_tab]" value=""/>
						<p class="desc"><?php esc_html_e('Enter a title for the tab (required field)', 'shopme'); ?></p>
					</div>
					<div class="item wp-editor">
						<h3><?php esc_html_e('Content Custom Tab', 'shopme'); ?></h3>
						<?php wp_editor( '', '__REPLACE_SSS__', $settings ); ?>
					</div>
					<div class="item">
						<a href="javascript:void(0)" class="button button-secondary remove-custom-tab"><?php _e('Remove Custom Tab', 'shopme'); ?></a>
					</div>
				</li>
			</script>

			<?php echo ob_get_clean();
		}

		function dynamic_add_custom_tab() {
			add_meta_box('shopme_dynamic_custom_tab', esc_html__( 'Custom Tabs', 'shopme' ), array(&$this, 'dynamic_inner_custom_tab'), 'product', 'advanced', 'high');
		}

		/* Prints the box content */
		function dynamic_inner_custom_tab() {
			global $post;

			// Use nonce for verification
			wp_nonce_field( 'shopme-custom-tab', 'dynamicMeta_noncename' );
			?>

			<div id="meta_custom_tabs">

				<?php $custom_tabs = get_post_meta($post->ID, 'shopme_custom_tabs', true); ?>

				<ul class="custom-box-holder">

					<?php if (isset($custom_tabs) && !empty($custom_tabs) && count($custom_tabs) > 0): ?>

						<?php foreach($custom_tabs as $id => $tab): ?>

							<?php if (isset($tab['shopme_title_product_tab']) || isset($tab['shopme_content_product_tab'])): ?>

								<li>
									<div class="handle-area"></div>
									<div class="item">
										<h3><?php esc_html_e('Title Custom Tab', 'shopme'); ?></h3>
										<input type="text" name="shopme_custom_tabs[<?php echo esc_attr($id); ?>][shopme_title_product_tab]" value="<?php echo esc_attr($tab['shopme_title_product_tab']); ?>" />
										<p class="desc"><?php esc_html_e('Enter a title for the tab (required field)', 'shopme'); ?></p>
									</div>
									<div class="item wp-editor">
										<h3><?php esc_html_e('Content Custom Tab', 'shopme'); ?></h3>
										<?php wp_editor( $tab['shopme_content_product_tab'], esc_attr($id), array('textarea_name' => 'shopme_custom_tabs['. $id .'][shopme_content_product_tab]', 'textarea_rows' => 3, 'tinymce' => false) ); ?>
									</div>
									<div class="item">
										<a href="javascript:void(0)" class="button button-secondary remove-custom-tab"><?php esc_html_e('Remove Custom Tab', 'shopme'); ?></a>
									</div>
								</li>

							<?php endif; ?>

						<?php endforeach; ?>

					<?php endif; ?>

				</ul><!--/ .custom-tabs-->

				<a href="javascript:void(0);" class="button button-primary add-custom-tab"><?php esc_html_e('Add Custom Tab', 'shopme'); ?></a>

			</div><?php

		}

		/* When the post is saved, saves our custom data */
		function dynamic_save_postdata ($post_id) {

			// verify if this is an auto save routine.
			// If it is our form has not been submitted, so we dont want to do anything
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
				return;

			// verify this came from the our screen and with proper authorization,
			// because save_post can be triggered at other times
			if ( !isset( $_POST['dynamicMeta_noncename'] ) )
				return;

			if ( !wp_verify_nonce( $_POST['dynamicMeta_noncename'], 'shopme-custom-tab' ) )
				return;

			if ( !isset( $_POST['shopme_custom_tabs'] ) ) {
				$_POST['shopme_custom_tabs'] = '';
			}

			$tabs = $_POST['shopme_custom_tabs'];
			update_post_meta($post_id, 'shopme_custom_tabs', $tabs);
		}

	}

	new SHOPME_CUSTOM_TABS();
}

