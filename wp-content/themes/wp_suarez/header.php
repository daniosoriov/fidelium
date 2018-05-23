<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
    <?php global $smof_data, $post;?>
    <?php wp_head(); ?>
</head>
<?php
/** value */
$c_pageID = empty($post->ID)? null : $post->ID;
$body_class = $wrapper_class = '';
/** header setting */
global $header_setings;
$header_setings = cshero_generetor_header_setting();
$body_class = $header_setings->body_class;
/** site id */
$header_select = cshero_getHeader();
/** render options */
$smof_data['header_content_widgets1'] = '1';
$smof_data['header_content_widgets2'] = '1';
if(is_page()){
   
    if(get_post_meta($c_pageID, 'cs_body_custom_class', true)){
        $body_class .= ' '.get_post_meta($c_pageID, 'cs_body_custom_class', true);
    }
      
      
    $menu_position =  get_post_meta($c_pageID, 'cs_menu_position', true);
    if($menu_position != ''){ $smof_data['menu_position'] = $menu_position; }
 
    if(get_post_meta($page_id, 'cs_header_setting', true)){

        $header_full_width = get_post_meta($c_pageID, 'cs_header_full_width', true);
        if($header_full_width !='' ){ $smof_data['header_full_width'] = $header_full_width; }

        $header_position = get_post_meta($c_pageID, 'cs_header_position', true);
        if($header_position !='' ){ $smof_data['header_position'] = $header_position; }

        $bg_parallax = get_post_meta($c_pageID, 'cs_header_bg_parallax', true);
        $background_image = get_post_meta($c_pageID, 'cs_header_bg_image', true);
        $smof_data['header_fixed_top'] = get_post_meta($c_pageID, 'cs_header_fixed_top', true);

        if ($background_image) {
            $attachment_image = wp_get_attachment_metadata($background_image, 'full');
            if($attachment_image){
                $smof_data['background-header']['media']['height'] = $attachment_image['height'];
                $smof_data['background-header']['media']['width'] = $attachment_image['width'];
            }
        }
        if($bg_parallax != ''){
            $smof_data['header_bg_parallax'] = $bg_parallax;
        }

        $header_top_widgets = get_post_meta($c_pageID, 'cs_header_top_widgets', true);
        if($header_top_widgets != ''){ $smof_data['header_top_widgets'] = $header_top_widgets;}

        $header_top2_widgets = get_post_meta($c_pageID, 'cs_header_top2_widgets', true);
        if($header_top2_widgets != ''){ $smof_data['header_top2_widgets'] = $header_top2_widgets;}

        $header_content_widgets = get_post_meta($c_pageID, 'cs_header_content_widgets', true);
        if($header_content_widgets != ''){ $smof_data['header_content_widgets'] = $header_content_widgets;}

        $smof_data['header_content_widgets1'] = get_post_meta($c_pageID, 'cs_header_content_widgets1', true);
        $smof_data['header_content_widgets2'] = get_post_meta($c_pageID, 'cs_header_content_widgets2', true);
        $smof_data['header_fixed_content_widgets'] = get_post_meta($c_pageID, 'cs_header_fixed_content_widgets', true);

        $enable_hidden_sidebar =  get_post_meta($c_pageID, 'cs_enable_hidden_sidebar', true);
        if($enable_hidden_sidebar != ''){ $smof_data['enable_hidden_sidebar'] = $enable_hidden_sidebar;}

        $sticky_header_full_width = get_post_meta($c_pageID, 'cs_sticky_header_full_width', true);
        if($sticky_header_full_width !='' ){ $smof_data['sticky_header_full_width'] = $sticky_header_full_width; } 

        /* Custom page logo */
        $logo = get_post_meta($c_pageID, 'cs_header_logo_image', true);
        if($logo){ $smof_data['logo']['url'] = wp_get_attachment_url($logo);}

        $logo_alignment = get_post_meta($c_pageID, 'cs_logo_alignment', true);
        if($logo_alignment != ''){ $smof_data['logo_alignment'] = $logo_alignment;}

        $menu_first_level_text_uppecase =  get_post_meta($c_pageID, 'cs_menu_first_level_text_uppecase', true);
        if($menu_first_level_text_uppecase != ''){ $smof_data['menu_first_level_text_uppecase'] = $menu_first_level_text_uppecase; }
    }
}
if( !empty($smof_data['header_fixed_top']) && $smof_data['header_fixed_top']){ 
    $body_class .=' header-transparentFixed';
}
if(!empty($smof_data['header_position']) && $smof_data['header_position']){
    $body_class .= ' header-position-'.$smof_data['header_position'];
}
 
if(!empty($smof_data['header_fixed_menu_appear']) && $smof_data['header_fixed_menu_appear'] ){
    $body_class .= ' menu-appear-'.$smof_data['header_fixed_menu_appear'];
}
$hidden_class='';
if(isset($smof_data['enable_hidden_sidebar']) && $smof_data['enable_hidden_sidebar']){
    $hidden_class = 'meny-'.$smof_data['hidden_sidebar_position'];
}

?>

<body <?php body_class($body_class.' '.$hidden_class.' header-'.$header_select .' '.cshero_getCSSite()); ?> id="wp-suarez">
    <?php if( !empty($smof_data['page_loader']) && $smof_data['page_loader'] == '1'):?>
    <div id="cs_loader" style="height:100vh;width:100vw;background-color:#FFF"></div>
    <?php endif;?>
    <div id="wrapper"<?php if( !empty($smof_data['page_loader']) && $smof_data['page_loader'] == '1'):?> class="cs_hidden"<?php endif;?>>
        <div class="header-wrapper">
            <?php cshero_header(); ?>
        </div>
        <?php require_once 'framework/includes/page-title.php'; ?>

