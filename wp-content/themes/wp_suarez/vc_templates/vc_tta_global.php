<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * @var $this WPBakeryShortCode_VC_Tta_Accordion|WPBakeryShortCode_VC_Tta_Tabs|WPBakeryShortCode_VC_Tta_Tour|WPBakeryShortCode_VC_Tta_Pageable
 */
$el_class = $css = $css_animation = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

$this->resetVariables( $atts, $content );
 
extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'style' => 'style1',
    'tab_color' => '#444',
    'tab_color_active' => '#444',
    'tab_background_color' => '',
    'tab_background_color_active' => '',
    'el_class' => ''
), $atts));


$this->setGlobalTtaInfo();

$this->enqueueTtaStyles();
$this->enqueueTtaScript();

// It is required to be before tabs-list-top/left/bottom/right for tabs/tours
$prepareContent = $this->getTemplateVariable( 'content' );

$class_to_filter = $this->getTtaGeneralClasses();
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
 
$tab_color = ($tab_color!='')?' color:'.$tab_color.'!important;':'';
$tab_color_active = ($tab_color_active!='')?' color:'.$tab_color_active.'!important;':'';
$tab_background_color = ($tab_background_color!='')?' background-color:'.$tab_background_color.'!important;':'';
$tab_background_color_active_tab = ($tab_background_color_active!='')?' background-color:'.$tab_background_color_active.'!important;':'';
$tab_border_color_active = ($tab_background_color_active!='')?' border-color: transparent transparent transparent '.$tab_background_color_active.'!important;':'';
    
$unique_id = uniqid().'_'.time();
$id  ="vc_tabs".$unique_id;

$output = '<div ' . $this->getWrapperAttributes() . '>';
$output .= $this->getTemplateVariable( 'title' );
$output .= '<div id="'.$id.'" class="' . esc_attr( $css_class ) . '">';
$output .= $this->getTemplateVariable( 'tabs-list-top' );
$output .= $this->getTemplateVariable( 'tabs-list-left' );
$output .= '<div class="vc_tta-panels-container">';
$output .= $this->getTemplateVariable( 'pagination-top' );
$output .= '<div class="vc_tta-panels">';
$output .= $prepareContent;
$output .= '</div>';
$output .= $this->getTemplateVariable( 'pagination-bottom' );
$output .= '</div>';
$output .= $this->getTemplateVariable( 'tabs-list-bottom' );
$output .= $this->getTemplateVariable( 'tabs-list-right' );
$output .= '</div>';
$output .= '</div>';

$custom_css = '#'.$id.'.vc_tta-tabs .vc_tta-tabs-container ul li.vc_active a,
              #'.$id.'.vc_tta-tabs .vc_tta-tabs-container ul li a:hover{
    '.$tab_color_active.$tab_background_color_active_tab.'
    }
    #'.$id.'.vc_tta-tabs.vc_tta-style-style3 .vc_tta-tabs-container ul li.vc_active a:before,
              #'.$id.'.vc_tta-tabs.vc_tta-style-style3 .vc_tta-tabs-container ul li a:hover:before{
    '.$tab_border_color_active.'
    }
    #'.$id.'.vc_tta-tabs .vc_tta-tabs-container ul li a{
    '.$tab_color.$tab_background_color.'
    }';

wp_suarez_inline_style($custom_css);
    
echo $output;
