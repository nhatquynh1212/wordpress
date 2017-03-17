<?php
$output = $el_class = $theme_box = '';

extract( shortcode_atts( array(
	'el_class' => '',
	'theme_box' => '',
	'css' => ''
), $atts ) );


$el_class = $this->getExtraClass( $el_class );
$theme_box = $this->getExtraClass( $theme_box );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_text_column wpb_content_element ' . $el_class . $theme_box . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$output .= "\n\t" . '<div class="' . esc_attr( $css_class ) . '">';
$output .= "\n\t\t" . '<div class="wpb_wrapper">';
$output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content, true );
$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div> ' . $this->endBlockComment( '.wpb_text_column' );

echo $output;