<?php
/**
 * Add column params
 * 
 * @author Knight
 * @since 1.0.0
 */

    vc_remove_param( "vc_btn", "style" );
    vc_remove_param( "vc_btn", "gradient_color_1" );
    vc_remove_param( "vc_btn", "gradient_color_2" );
    vc_remove_param( "vc_btn", "gradient_custom_color_1" );
    vc_remove_param( "vc_btn", "gradient_custom_color_2" );
    vc_remove_param( "vc_btn", "gradient_text_color" );
    vc_remove_param( "vc_btn", "custom_background" );
    vc_remove_param( "vc_btn", "custom_text" );
    vc_remove_param( "vc_btn", "outline_custom_color" );
    vc_remove_param( "vc_btn", "outline_custom_hover_background" );
    vc_remove_param( "vc_btn", "outline_custom_hover_text" );
    
    vc_remove_param( "vc_btn", "shape" );
    vc_remove_param( "vc_btn", "color" );
    
    $button_type = array(
            __('Button Default', 'wp_suarez') => 'btn btn-default',
            __('Button Default Alt', 'wp_suarez') => 'btn btn-default-alt',
            __('Button Default White', 'wp_suarez') => 'btn btn-white',
            __('Button Border', 'wp_suarez') => 'btn btn-border',
            __('Button Border White', 'wp_suarez') => 'btn btn-border-white',
            __('Button Primary', 'wp_suarez') => 'btn btn-primary',
            __('Button Primary Alt', 'wp_suarez') => 'btn btn-primary-alt',
            __('Button Primary Alt White', 'wp_suarez') => 'btn btn-primary-alt btn-white',
            __('Button Warning', 'wp_suarez') => 'btn btn-warning',
            __('Button Danger', 'wp_suarez') => 'btn btn-danger',
            __('Button Success', 'wp_suarez') => 'btn btn-success',
            __('Button Info', 'wp_suarez') => 'btn btn-info',
            __('Button Inverse', 'wp_suarez') => 'btn btn-inverse' 
        );
        vc_add_param("vc_btn", array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Button Type", 'wp_suarez'),
            "param_name" => "type",
            "value" => $button_type
        ));
        $size_arr = array(
            __('Default', 'wp_suarez') => 'btn btn-default',
            __('Large', 'wp_suarez') => 'btn-lg btn-large',
            __('Medium', 'wp_suarez') => 'btn-md btn-medium',
            __('Small', 'wp_suarez') => 'btn-sm btn-small',
            __('Mini', 'wp_suarez') => "btn-xs btn-mini"
        );
        vc_add_param("vc_btn", array(
            'type' => 'dropdown',
            'heading' => __('Size', 'wp_suarez'),
            'param_name' => 'size',
            'value' => $size_arr,
            'description' => __('Button size.', 'wp_suarez')
        ));
         
 
     
  