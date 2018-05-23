<?php
extract( shortcode_atts( array(
	'letter_spacing' => ''
), $atts ) );
$output = $text = $google_fonts = $font_container = $el_class = $css = $google_fonts_data = $font_container_data = '';
extract( $this->getAttributes( $atts ) );
extract( $this->getStyles( $el_class, $css, $google_fonts_data, $font_container_data, $atts ) );
$settings = get_option( 'wpb_js_google_fonts_subsets' );
$subsets  = '';
if ( is_array( $settings ) && ! empty( $settings ) ) {
	$subsets = '&subset=' . implode( ',', $settings );
}
wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );

if ( ! empty( $link ) ) {
	$link = vc_build_link( $link );
	$text = '<a href="' . esc_attr( $link['url'] ) . '"'
		. ( $link['target'] ? ' target="' . esc_attr( $link['target'] ) . '"' : '' )
		. ( $link['rel'] ? ' rel="' . esc_attr( $link['rel'] ) . '"' : '' )
		. ( $link['title'] ? ' title="' . esc_attr( $link['title'] ) . '"' : '' )
		. '>' . $text . '</a>';
}

$output .= '<div class="' . $css_class . '" >';
$output .= '<' . $font_container_data['values']['tag'] . ' style="letter-spacing:'.$letter_spacing.';' . implode( ';', $styles ) . '">';
$output .= $text;
$output .= '</' . $font_container_data['values']['tag'] . '>';
$output .= '</div>';

echo $output; 