<?php global $smof_data, $woocommerce, $main_menu, $post;
    $c_pageID = null;
    if($post){
        $c_pageID = $post->ID;
    }
    /* object menu */
    $menus = wp_get_nav_menus();
    /* array menu id */
    $menus_id = array();
    if(!empty($menus)){
        foreach ($menus as $menu){
            $menus_id[] = $menu->term_id;
        }
    }
    /* menu location */
    $menu_locations = get_nav_menu_locations();
    $main_navigation = null;
    $sticky_navigation = null;
    if(!empty($menu_locations)){
        if(isset($menu_locations['main_navigation'])){
            $main_navigation = $menu_locations['main_navigation'];
        }
        if(isset($menu_locations['sticky_navigation'])){
            $sticky_navigation = $menu_locations['sticky_navigation'];
        }
    }
    /* show stiky */
    $show_sticky = get_post_meta($c_pageID, 'cs_show_sticky_header', true);
    if($show_sticky != ''){
        $smof_data['header_sticky'] = $show_sticky;
    }
?>
<div id="header-sticky" class="sticky-header">
    <div class="<?php echo ($smof_data['sticky_header_full_width'])?'no-container':'container';?>">
        <div class="header-sticky-full">

            <div class="sticky-menu-wrap menu-fw">
                <div class="clearfix">

                    <div class="cshero-logo logo-sticky logo-fw left">
                        <a href="<?php echo home_url(); ?>">
                            <img src="<?php echo $smof_data['logo_header_sticky']['url']; ?>" alt="<?php bloginfo('name'); ?>" class="sticky-logo" />
                        </a>
                    </div>

                    <div class="cshero-header-content-widget cshero-menu-mobile hidden-lg hidden-md right">
                        <div class="cshero-header-content-widget-inner">
                            <a class="btn-navbar" data-toggle="collapse" data-target="#cshero-main-menu-mobile" href="#" ><i class="fa fa-bars"></i></a>
                        </div>
                    </div>

                    <?php if(isset($smof_data['enable_hidden_sidebar']) && $smof_data['enable_hidden_sidebar']){ ?>
                        <div class="cshero-header-content-widget cshero-hidden-sidebar right">
                            <div class="cshero-hidden-sidebar-btn">
                                <a href="#"><i class="fa fa-sign-out cs_open"></i></a>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if($smof_data['header_content_widgets']): ?>
                    <?php if(is_active_sidebar('cshero-header-content-widget-1')){ ?>
                        <div class="cshero-header-content-widget cshero-header-content-widget1 right">
                            <div class="cshero-header-content-widget-inner">
                                <?php   if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Header Content Widget 1")): endif;?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if(is_active_sidebar('cshero-header-content-widget-2')){ ?>
                        <div class="cshero-header-content-widget cshero-header-content-widget-2 right">
                            <div class="cshero-header-content-widget-inner">
                                <?php   if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Header Content Widget 2")): endif;?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php endif; ?>
                    <nav id="sticky-nav-wrap" class="sticky-menu cs_mega_menu nav-holder cshero-menu-dropdown cshero-mobile <?php echo $smof_data["menu_position"]; ?>">
                        <?php
                        $megamenu = null;
                        if(class_exists('HeroMenuWalker')){
                            $megamenu = new HeroMenuWalker();
                        }
                        $custom_sticky_navigation = get_post_meta($c_pageID, 'cs_sticky_navigation', true);
                        if (in_array($sticky_navigation, $menus_id) || in_array($custom_sticky_navigation, $menus_id)) {
                            echo '<ul class="cshero-dropdown main-menu sticky-nav menu-item-padding">';
                            wp_nav_menu(array('theme_location' => 'sticky_navigation','menu'=>$custom_sticky_navigation, 'depth' => 5, 'container' => false, 'menu_id' => 'nav', 'items_wrap' => '%3$s', 'walker'=>$megamenu));
                            echo '</ul>';
                        } elseif (in_array($main_navigation, $menus_id)) {
                            echo '<ul class="cshero-dropdown sticky-nav menu-item-padding">';
                            wp_nav_menu(array('theme_location' => 'main_navigation', 'depth' => 5, 'container' => false, 'menu_id' => 'nav', 'items_wrap' => '%3$s', 'walker'=>$megamenu));
                            echo '</ul>';
                        } elseif (empty($menus_id)) {
                            echo '<div class="menu-pages">';
                            wp_nav_menu(array('depth' => 5, 'container' => false, 'menu_id' => 'nav', 'items_wrap' => '%3$s'));
                            echo '</div>';
                        } else {
                            echo '<ul class="cshero-dropdown sticky-nav menu-item-padding">';
                            wp_nav_menu(array('depth' => 5, 'container' => false, 'menu_id' => 'nav', 'items_wrap' => '%3$s', 'walker'=>$megamenu));
                            echo '</ul>';
                        }
                        ?>
                    </nav>
                </div>
            </div>
            <div id="cshero-sticky-menu-mobile" class="collapse navbar-collapse cshero-mmenu"></div>
        </div>
    </div>
</div>