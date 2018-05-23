<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
 
/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * @var $this WPBakeryShortCode_VC_Tta_Section
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract(shortcode_atts(array(
    'title' => __("Section", "wp_suarez"),
    'icon' => '',
    'title_color' => '',
    'background_tab' => '',
    'background_content' => '',
    'title_active_color' => '',
    'background_tab_active' => '',
), $atts));

$unique_id = uniqid().'_'.time();
$uniqid  ="accordion_".$unique_id;
 
$this->resetVariables( $atts, $content );
WPBakeryShortCode_VC_Tta_Section::$self_count ++;
WPBakeryShortCode_VC_Tta_Section::$section_info[] = $atts;
$isPageEditable = vc_is_page_editable();
    
$output = '';
$custom_css = '.vc_tta-accordion .vc_tta-panel.'.$uniqid.'.vc_active .vc_tta-panel-heading .vc_tta-panel-title a{
        color:'.$title_active_color.' !important;
        background:'.$background_tab_active.' !important;
    } .'.$uniqid.' .vc_tta-panel-body{
        background:'.$background_content.' !important;
    } .vc_tta-accordion .'.$uniqid.' .vc_tta-panel-heading .vc_tta-panel-title a{
        background-color:'.$background_tab.' !important;
        color:'.$title_color.' !important;
    }';

wp_suarez_inline_style($custom_css);

$output .= '<div class="' . esc_attr( $this->getElementClasses() ) . ' '.$uniqid.'"';
$output .= ' id="' . esc_attr( $this->getTemplateVariable( 'tab_id' ) ) . '"';

$output .= ' data-vc-content=".vc_tta-panel-body">';

$output .= '<div class="vc_tta-panel-heading">';
$output .= $this->getTemplateVariable( 'heading' );
$output .= '</div>';
$output .= '<div class="vc_tta-panel-body">';
if ( $isPageEditable ) {
	$output .= '<div data-js-panel-body>'; // fix for fe - shortcodes container, not required in b.e.
}
$output .= $this->getTemplateVariable( 'content' );
if ( $isPageEditable ) {
	$output .= '</div>';
}
$output .= '</div>';

$output .= '</div>';

echo $output;
