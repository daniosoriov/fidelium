<?php
/**
 * demo data.
 *
 * config.
 */

 
function wp_suarez_set_home_page(){

    $home_page = 'Corporate 1';

    $page = get_page_by_title($home_page);

    if(!isset($page->ID))
        return ;

    update_option('show_on_front', 'page');
    update_option('page_on_front', $page->ID);
}

add_action('ef3-import-finish', 'wp_suarez_set_home_page');

 
function wp_suarez_set_menu_location(){

    $setting = array(
        'Main Menu' => 'main_navigation',
        'Menu Left' => 'left_navigation',
        'Menu Right' => 'right_navigation',
    );

    $navs = wp_get_nav_menus();

    $new_setting = array();

    foreach ($navs as $nav){

        if(!isset($setting[$nav->name]))
            continue;

        $id = $nav->term_id;
        $location = $setting[$nav->name];

        $new_setting[$location] = $id;
    }

    set_theme_mod('nav_menu_locations', $new_setting);
}

function wp_suarez_set_woo_page(){
    
    $woo_pages = array(
        'woocommerce_shop_page_id' => 'Shop',
        'woocommerce_cart_page_id' => 'Cart',
        'woocommerce_checkout_page_id' => 'Checkout'
    );
    
    foreach ($woo_pages as $key => $woo_page){
    
        $page = get_page_by_title($woo_page);
    
        if(!isset($page->ID))
            return ;
             
        update_option($key, $page->ID);
    
    }
}

add_action('ef3-import-finish', 'wp_suarez_set_woo_page');

add_action('ef3-import-finish', 'wp_suarez_set_menu_location');
 
add_filter('ef3-theme-options-opt-name', 'wp_suarez_set_demo_opt_name');

function wp_suarez_set_demo_opt_name(){
    return 'smof_data';
}

add_filter('ef3-replace-content', 'wp_suarez_replace_content', 10 , 2);

function wp_suarez_replace_content($replaces, $attachment){
    return array(
        //'/image="(.+?)"/' => 'image="'.$attachment.'"',
        '/tax_query:/' => 'remove_query:',
        '/categories:/' => 'remove_query:',
        //'/src="(.+?)"/' => 'src="'.ef3_import_export()->acess_url.'ef3-placeholder-image.jpg"'
    );
}

add_filter('ef3-replace-theme-options', 'wp_suarez_replace_theme_options');

function wp_suarez_replace_theme_options(){
    return array(
        'dev_mode' => 0,
    );
}
add_filter('ef3-enable-create-demo', 'wp_suarez_enable_create_demo');

function wp_suarez_enable_create_demo(){
    return false;
}