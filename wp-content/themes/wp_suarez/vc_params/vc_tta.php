<?php


vc_remove_param( "vc_tta_accordion", "style" );
vc_remove_param( "vc_tta_accordion", "shape" );
vc_remove_param( "vc_tta_accordion", "color" );

vc_remove_param( "vc_tta_tabs", "style" );
vc_remove_param( "vc_tta_tabs", "shape" );
vc_remove_param( "vc_tta_tabs", "color" );
 
vc_add_param("vc_tta_section", array(
    "type" => "colorpicker",
    "class" => "",
    "heading" => __("Title Color", 'wp_suarez'),
    "param_name" => "title_color"
));
vc_add_param("vc_tta_section", array(
    "type" => "colorpicker",
    "class" => "",
    "heading" => __("Background Tab", 'wp_suarez'),
    "param_name" => "background_tab"
));
vc_add_param("vc_tta_section", array(
    "type" => "colorpicker",
    "class" => "",
    "heading" => __("Background Content", 'wp_suarez'),
    "param_name" => "background_content"
));
vc_add_param("vc_tta_section", array(
    "type" => "colorpicker",
    "class" => "",
    "heading" => __("Title Active Color", 'wp_suarez'),
    "param_name" => "title_active_color"
));
vc_add_param("vc_tta_section", array(
    "type" => "colorpicker",
    "class" => "",
    "heading" => __("Background Tab Active", 'wp_suarez'),
    "param_name" => "background_tab_active"
));

vc_add_param("vc_tta_tabs", array(
    'type' => 'dropdown',
    'heading' => __('Auto rotate tabs', 'wp_suarez'),
    'param_name' => 'interval',
    'value' => array(
        __('Disable', 'wp_suarez') => 0,
        3,
        5,
        10,
        15
    ),
    'std' => 0,
    'description' => __('Auto rotate tabs each X seconds.', 'wp_suarez')
));
vc_add_param("vc_tta_tabs", array(
    'type' => 'colorpicker',
    'heading' => __('Tab Color', 'wp_suarez'),
    'param_name' => 'tab_color',
    'std' => '#444'
));
vc_add_param("vc_tta_tabs", array(
     'type' => 'colorpicker',
    'heading' => __('Tab Color Active', 'wp_suarez'),
    'param_name' => 'tab_color_active',
    'std' => '#444'
));
vc_add_param("vc_tta_tabs", array(
     'type' => 'colorpicker',
    'heading' => __('Tab Background Color', 'wp_suarez'),
    'param_name' => 'tab_background_color'
));
vc_add_param("vc_tta_tabs", array(
    'type' => 'colorpicker',
    'heading' => __('Tab Background Color Active', 'wp_suarez'),
    'param_name' => 'tab_background_color_active'
));
vc_add_param("vc_tta_tabs", array(
    'type' => 'dropdown',
    'param_name' => 'style',
    'heading' => __('Style', 'wp_suarez'),
    'value' => array(
        "Style 1" => "style1",
        "Style 2" => "style2",
        "Style 3" => "style3"
    ),
    'std' => 'style1'
));
 
