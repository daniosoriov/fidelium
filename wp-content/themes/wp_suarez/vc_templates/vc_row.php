<?php
$output = $el_class = $el_id = '';
extract(shortcode_atts(array(
            'el_id' => '',
            'el_class' => '',
            'type' => '',
            'css' => '',
            'row_responsive_large'=>'',
            'row_responsive_medium'=>'',
            'row_responsive_small'=>'',
            'row_responsive_extra_small'=>'',
            'font_color' => '',
            'row_link_color' => '',
            'row_head_color' => '',
            'row_link_color_hover' => '',
            'full_width' => false,

            'bg_attachment' => 'inherit',
            'bg_repeat' => 'inherit',
            
            'poster' => '',
            'autoplay' => false,
            'muted' => false,
            'loop' => false,
            'controls' => false,
            'show_btn' => false,
            'preload' => 'none',
            'height_row' => '500px',
            'same_height' => '',
            'bg_video_color' => 'transparent',
            'bg_video_src_mp4' => '',
            'bg_video_src_ogv' => '',
            'bg_video_src_webm' => '',
            'enable_row_engle' => false,
            'height_engle' => '',
            'engle_position' => '',
            'engle_color' => '',
            'animation' => '',
            'parallax_speed' => '',
            'enable_parallax' => '',
            'enable_row_engle' => '',
            'height_engle' => '',
            'engle_color' => '',
            'enable_engle_duplicate' => '',
            'engle_position_duplicate' => '',
            'enable_engle_style2' => '',
            'engle_position_style2' => '',
            'height_engle_style2' => '',
            'engle_color_style2' => ''
                ), $atts));
/* script */
wp_enqueue_style('js_composer_front');
wp_enqueue_script('wpb_composer_front_js');
wp_enqueue_style('js_composer_custom_css');

$img_info = $data_image_height = null;

/* one page id */
if($el_id){
    $el_id = " id='$el_id'";
}
    $el_class = $this->getExtraClass($el_class);
/* Responsive */
    $responsive = '';
    if($row_responsive_large){
        $responsive .= ' hidden-lg';
    }
    if($row_responsive_medium){
        $responsive .= ' hidden-md';
    }
    if($row_responsive_small){
        $responsive .= ' hidden-sm';
    }
    if($row_responsive_extra_small){
        $responsive .= ' hidden-xs';
    }
/* Full Container */
    global $post;
    $post_full_width = get_post_meta($post->ID, 'cs_blog_layout', true);
    $cl_full_width = 'no-container';
    $enable_container = '';
    $main_full_width = '';
    if(!$post_full_width){
        if ($full_width == 'true') {
            $cl_full_width = 'no-container';
        } else {
            $enable_container = $cl_full_width = 'container';
        }
    }
    if ($full_width == 'true') {
        $cl_full_width .= ' cs-row-fullwidth';
        $main_full_width = ' cs-row-fullwidth-wrap';
    } else {
        $cl_full_width .= ' cs-row-container';
        $main_full_width = ' cs-row-container-wrap';
    }
/* row class */
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'wpb_row clearfix ' . $el_class . $responsive . $main_full_width . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
/* Link Color */
    global $link_style;
    $uqid = uniqid();
    $class_link = vc_shortcode_custom_css_class( $css, '.' ).' .cshero_'.$uqid;
    if($row_link_color || $row_link_color_hover || $row_head_color){
        if($row_head_color){
            $link_style .= "".$class_link." h1,".$class_link." h2,".$class_link." h3,".$class_link." h4,".$class_link." h5,".$class_link." h6 {color: $row_head_color!important}";
            $link_style .= "".$class_link." .cs-header.dotted-bottom2:after, ".$class_link." .cs-header.dotted-bottom cs-title:after {background-color: $row_head_color!important}";
        }
    	if($row_link_color){
    		$link_style .= "".$class_link." a{color: $row_link_color!important}";
    	}
    	if($row_link_color_hover){
    		$link_style .= "".$class_link." a:hover{color: $row_link_color_hover!important}";
    	}
        wp_register_script( 'cshero_row_css', get_template_directory_uri().'/js/custom_row.js' );
        $translation_array = array( 'css' => $link_style );
        wp_localize_script( 'cshero_row_css', 'cshero_row_object', $translation_array );
        wp_enqueue_script( 'cshero_row_css' );
    }
/* Text Color */
    $style = "";
    if($font_color){
    	$style = " style='color: $font_color'";
    }
/* Custom BG */
switch ($type) {
    case 'ww-custom':
        $stripe_classes = array();
        if(is_numeric($poster)) {
            $image_src = wp_get_attachment_url( $poster );
        }else {
            $image_src = $poster;
        }
        $stripe_classes[] = $type;
        /* class same height */
        if ($same_height != false && $same_height != 1) {
            $stripe_classes[] = 'same-height';
        }
        /* video BG */
        $bg_video = '';
        $bg_video_args = array();
        if ($bg_video_src_mp4) {
            $bg_video_args['mp4'] = $bg_video_src_mp4;
        }
        if ($bg_video_src_ogv) {
            $bg_video_args['ogv'] = $bg_video_src_ogv;
        }
        if ($bg_video_src_webm) {
            $bg_video_args['webm'] = $bg_video_src_webm;
        }
        $uniqid = uniqid('video');
        $css_height = 'auto';
        if (!empty($bg_video_args)) {
            $css_height = $height_row;
            $attr_strings = array(
                'id="'.$uniqid.'"',
                'data-id="'.$uniqid.'"',
            );
            if (!empty($image_src)) {
                $attr_strings[] = 'poster="'.$image_src.'"';
            }
            if ($autoplay==true) {
                $attr_strings[] = 'autoplay';
            }
            if ($muted==true) {
                $attr_strings[] = 'muted';
            }
            if ($loop==true) {
                $attr_strings[] = 'loop';
            }
            if ($controls==true) {
                $attr_strings[] = 'controls="controls"';
            }
            if ($preload) {
                $attr_strings[] = 'preload="'.$preload.'"';
            }
            $bg_video .= sprintf('<div class="stripe-video-bg"><video data-ratio="1.7777777777777777" onloadeddata="javascript:{jQuery(this).attr(\'data-ratio\',this.videoWidth/this.videoHeight)}" class="video-parallax" %s>', join(' ', $attr_strings));
            $source = '<source type="%s" src="%s" />';
            foreach ($bg_video_args as $video_type => $video_src) {
                $video_type = wp_check_filetype($video_src, wp_get_mime_types());
                $bg_video .= sprintf($source, $video_type['type'], esc_url($video_src));
            }
            $bg_video .= '</video></div>';
            $bg_video .= '<div class="ww-video-bg" style="background:'.$bg_video_color.' ;"></div>';

            $stripe_classes[] = 'stripe-video-wrap';
        }
        $data_attr = 'data-height-row="'.$css_height.'"';
        if ($enable_parallax) {
            $parallax_speed = floatval($parallax_speed);
            if (!$parallax_speed) {
                $parallax_speed = 0.5;
            }
            $stripe_classes[] = 'stripe-parallax-bg';
            //$data_attr = ' data-stellar-background-ratio="' . $parallax_speed . '"';
            $data_attr = ' data-stellar-background-ratio="' . $parallax_speed . '" '.$data_image_height;
        }
        if (!empty($css_class)) {
            $stripe_classes[] = $css_class;
        }
        $output .= '<div'.$el_id.' class="' . esc_attr(implode(' ', $stripe_classes)) . '"' . $data_attr  . ' style="background-attachment:'.$bg_attachment.'; background-repeat:'.$bg_repeat.'">';
        $output .= $bg_video;
        break;
    case 'full-screen':
        $stripe_classes = array();
        
        $stripe_classes[] = 'cshero_row_full_screen';

        if (!empty($css_class)) {
            $stripe_classes[] = $css_class;
        }
        $output .= "<div$el_id";
        if (count($stripe_classes) > 0) {
            $output .= ' class="' . esc_attr(implode(' ', $stripe_classes)) . '"';
        }
        $output .= ' style="background-attachment:'.$bg_attachment.'; background-repeat:'.$bg_repeat.'">';
        break;
    case 'row-flex':
        $stripe_classes = array();
        
        $stripe_classes[] = 'cshero_row_flex';

        if (!empty($css_class)) {
            $stripe_classes[] = $css_class;
        }
        $output .= "<div$el_id";
        if (count($stripe_classes) > 0) {
            $output .= ' class="' . esc_attr(implode(' ', $stripe_classes)) . '"';
        }
        $output .= ' style="background-attachment:'.$bg_attachment.'; background-repeat:'.$bg_repeat.'">';
        break;
    default:
        $stripe_classes = array();
        if ($same_height != false && $same_height != 1) {
            $stripe_classes[] = 'ww-same-height';
        }
        if (!empty($css_class)) {
            $stripe_classes[] = $css_class;
        }
        $output .= "<div$el_id";
        if (count($stripe_classes) > 0) {
            $output .= ' class="' . esc_attr(implode(' ', $stripe_classes)) . '"';
        }
        $output .= ' style="background-attachment:'.$bg_attachment.'; background-repeat:'.$bg_repeat.'">';
        break;
}

/* class animation for row */
if ($animation) {
    wp_enqueue_script('waypoints');
    $animation .= '  wpb_animate_when_almost_visible wpb_'.$animation;
}


$strip_video = ($bg_video_src_ogv!='' || $bg_video_src_mp4!='' || $bg_video_src_webm!='')?'stripe-video-content':'';
/* div parallax */
if($enable_parallax) {$output .= '<div class="ww-parallax-bg" style="background:'.$bg_video_color.' ;"></div>';}

$output .= '<div class="'. esc_attr($cl_full_width) .' cshero_'. $uqid. ' '.$strip_video.' " '.$style.'>';
/* add div row if rows = container*/
if($enable_container == 'container'){ $output .= '<div class="row">'; }
/* content */
$btn_html = '<div class="exp-videobg-control-btn control-btn-circle exp-mbot"><i class="fa exp-icon fa-play"></i></div>';
if($show_btn) $content = $btn_html.$content;
$output .= wpb_js_remove_wpautop($content);
/* end div row */
if($enable_container == 'container'){ $output .= '</div>'; }

$output .= '</div>';
$output .= '</div>' . $this->endBlockComment('row');
echo $output;
