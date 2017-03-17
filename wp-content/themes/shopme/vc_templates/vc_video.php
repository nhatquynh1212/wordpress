<?php

$attr = array();
$output = $title = $link = $size = $el_class = $animation_class = $animation_delay = $css_animation = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( $link == '' ) {
	return null;
}

$el_class = $this->getExtraClass( $el_class );

if ($css_animation != '') {
	$attr['animation'] = SHOPME_VC_CONFIG::getAnimation($css_animation);
	$animation_class = $this->getExtraClass('animated');
	if (!empty($animation_delay)) {
		$attr['animation-delay'] = $animation_delay;
	}
}

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

$video_w = ( isset( $content_width ) ) ? $content_width : 500;
$video_h = $video_w / 1.61; //1.61 golden ratio
/** @var WP_Embed $wp_embed  */
global $wp_embed;
$embed = $wp_embed->run_shortcode( '[embed width="' . $video_w . '" height="' . $video_h . '"]' . $link . '[/embed]' );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_video_widget wpb_content_element' . $el_class . ' ' . $animation_class . ' ' . $el_class . ' ' . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$output .= "\n\t" . '<div ' . esc_attr(SHOPME_VC_CONFIG::create_data_string($attr)) . ' class="' . $css_class . '">';
$output .= "\n\t\t" . '<div class="wpb_wrapper">';
$output .= shopme_wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_video_heading' ) );
$output .= '<div class="wpb_video_wrapper">' . $embed . '</div>';
$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div> ' . $this->endBlockComment( '.wpb_video_widget' );

echo $output;