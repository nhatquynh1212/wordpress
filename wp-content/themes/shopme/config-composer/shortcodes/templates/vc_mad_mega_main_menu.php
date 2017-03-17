<?php

class WPBakeryShortCode_VC_mad_mega_main_menu extends WPBakeryShortCode {

	public $atts = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'nav_menu' => '',
		), $atts, 'vc_mad_mega_main_menu');

		return $this->html();
	}

	protected function entry_title($title) {
		return "<h3>" . apply_filters( 'widget_title', empty( $title ) ? '' : $title ) . "</h3>";
	}

	public function html() {

		$title = $nav_menu = '';

		extract($this->atts);

		ob_start();

		$nav_menu = ! empty( $nav_menu ) ? wp_get_nav_menu_object( $nav_menu ) : false;

		if ( !$nav_menu ) { return; }

		if (!empty($title)) {
			echo $this->entry_title($title);
		}

		$get_options = get_option('mega_main_menu_options');
		$get_locations = $get_options['mega_menu_locations'];

		if (in_array('mega_main_sidebar_menu', $get_locations)) {
			wp_nav_menu( array( 'theme_location' => 'mega_main_sidebar_menu', 'menu' => $nav_menu ) );
		} else {
			echo '<div class="widget_nav_menu">';
			wp_nav_menu( array( 'theme_location' => 'secondary', 'menu' => $nav_menu ) );
			echo '</div>';
		}

		return ob_get_clean();
	}

}