<?php
/**
 * Created by PhpStorm.
 * User: FOX
 * Date: 2/23/2016
 * Time: 3:48 PM
 */

/* Include the TGM_Plugin_Activation class.*/
require_once ( get_template_directory() . '/inc/libs/class-tgm-plugin-activation.php' );

/* load list plugins */
require_once( get_template_directory() . '/inc/options/require.plugins.php' );

/* load demo data setting */
require_once( get_template_directory() . '/inc/demo-data.php' );

/* lip font-awesome */
require_once get_template_directory() . '/inc/libs/font-awesome.php';

/* load theme options. */
require_once( get_template_directory() . '/inc/options/function.options.php' );

/* load dynamic css*/
require_once( get_template_directory() . '/framework/dynamic/dynamic.main.php' );

/**
 * Function for Framework
 */
require get_template_directory().'/framework/functions.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php'; 

/* Woo commerce function */
if(class_exists('Woocommerce')){
    require get_template_directory() . '/woocommerce/wc-template-hooks.php';
}

