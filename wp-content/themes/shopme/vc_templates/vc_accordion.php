<?php
wp_enqueue_script( 'jquery-ui-accordion' );
$output = $title = $interval = $el_class = $collapsible = $disable_keyboard = $active_tab = '';
//
extract( shortcode_atts( array(
	'title' => '',
	'interval' => 0,
	'el_class' => '',
	'collapsible' => 'no',
	'disable_keyboard' => 'no',
	'active_tab' => '1'
), $atts ) );

if (!function_exists('shopme_wpb_widget_title')) {
	function shopme_wpb_widget_title( $params = array( 'title' => '' ) ) {
		if ( $params['title'] == '' ) {
			return '';
		}

		$extraclass = ( isset( $params['extraclass'] ) ) ? " " . $params['extraclass'] : "";
		$output = '<h3 class="wpb_heading' . $extraclass . '">' . $params['title'] . '</h3>';

		return apply_filters( 'wpb_widget_title', $output, $params );
	}
}

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion wpb_content_element ' . $el_class . ' not-column-inherit', $this->settings['base'], $atts );

$output .= "\n\t" . '<div class="' . $css_class . '" data-collapsible="' . $collapsible . '" data-vc-disable-keydown="' . ( esc_attr( ( 'yes' == $disable_keyboard ? 'true' : 'false' ) ) ) . '" data-active-tab="' . $active_tab . '">'; //data-interval="'.$interval.'"
$output .= shopme_wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_accordion_heading' ) );
$output .= "\n\t\t" . '<div class="wpb_wrapper wpb_accordion_wrapper ui-accordion">';
$output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content );
$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div> ' . $this->endBlockComment( '.wpb_accordion' );

echo $output;