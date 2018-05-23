<?php
/*
Template Name: Blog Masonry
*/
get_header(); ?>
<?php global $post,$breadcrumb,$masonry_filter; ?>
<?php
    $category = get_post_meta(get_the_ID(),'cs_page_category',true);
    if(is_array($category)){
        $category =  implode(',', $category);
    }
    $limit = get_post_meta(get_the_ID(),'cs_page_limit',true);
    $masonry_filter = (get_post_meta(get_the_ID(),'cs_page_masonry_filter',true)=='yes')?true:false;
    $masonry_columns = get_post_meta(get_the_ID(),'cs_page_masonry_columns',true);
    $masonry_loadmore = (get_post_meta(get_the_ID(),'cs_page_masonry_loadmore',true)=='yes')?true:false;
    if(empty($limit)) $limit=5;
    if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
    elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
    else { $paged = 1; }
    global $cs_span,$cs_cat_class;
    $cs_span = "col3";
    switch ($masonry_columns) {
        case 1:
            $cs_span = "col1";
            break;
        case 2:
            $cs_span = "col2";
            break;
        case 3:
            $cs_span = "col3";
            break;
        case 4:
            $cs_span = "col4";
            break;
        default:
            $cs_span = "col3";
    }
    /*script*/
    wp_enqueue_script('jquery-isotope-min-js', get_template_directory_uri() . "/js/jquery.isotope.min.js",array(),"2.0.0");
    wp_enqueue_script('jquery-imagesloaded-js', get_template_directory_uri() . "/js/jquery.imagesloaded.js",array(),"2.1.0");

?>
<?php $layout = cshero_generetor_layout();?>
    <section id="primary" class="content-area blog-masonry<?php if($breadcrumb == '0'){ echo ' no_breadcrumb_page'; }; ?><?php echo esc_attr($layout->class); ?> blog-grid-wrap">
        <h6 style="display:none;">&nbsp;</h6><?php /* this element for fix validator warning */ ?>
        <div class="<?php if(get_post_meta($post->ID, 'cs_blog_layout', true) == "full"){ echo "no-container";} else { echo "container"; } ?>">
            <div class="row">
                <?php if($layout->left1_col):?>
                    <div class="left-wrap <?php echo esc_attr($layout->left1_col); ?>">
                         <div id="secondary" class="widget-area" role="complementary">
                            <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                                <?php dynamic_sidebar($layout->left1_sidebar); ?>
                            </div>
                         </div>
                    </div>
                <?php endif; ?>
                <div class="content-wrap <?php echo esc_attr($layout->blog); ?>">
                    <main id="main" class="site-main" role="main">
                        <div class="sidebar-custom-button-wrap">
                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Custom Button Action")):
                            endif;
                            ?>
                        </div>
                        <?php
                        if($masonry_filter){
                            get_template_part( 'framework/templates/blog/masonry','filter');
                        }
                        ?>
                        <?php 
                            global $wp_query;
                            $wp_query = new WP_Query('post_type=post&paged='. $paged . '&post_status=publish&cat=' . $category .'&posts_per_page=' . $limit );?>
                        <?php if ( $wp_query->have_posts() ) : ?>
                            <?php
                                if($masonry_loadmore){
                                    /*ajax media*/
                                    wp_enqueue_style( 'wp-mediaelement' );
                                    wp_enqueue_script( 'wp-mediaelement' );
                                    global $wp_query;
                                    /* js, css for load more */
                                    wp_register_script( 'cshero-load-more-js', get_template_directory_uri().'/js/cshero_loadmore.js', array('jquery') ,'1.0',true);
                                    // What page are we on? And what is the pages limit?
                                    $max = $wp_query->max_num_pages;
                                    $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;

                                    // Add some parameters for the JS.
                                    wp_localize_script(
                                        'cshero-load-more-js',
                                        'cs_more_obj',
                                        array(
                                            'startPage' => $paged,
                                            'maxPages' => $max,
                                            'total' => $wp_query->found_posts,
                                            'perpage' => $limit,
                                            'nextLink' => next_posts($max, false),
                                            'ajaxType' => 'Button',
                                            'masonry' => 'masonry'
                                        )
                                    );
                                    wp_enqueue_script( 'cshero-load-more-js' );
                                }

                                ?>
                            <?php /* Start the Loop */ ?>
                            <div class="cshero-masonry-post cs-masonry-layout ">
                            <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                            <?php
                            $categories = get_the_category($post->ID);
                            $cs_cat_class='';
                            if($categories && is_array($categories) && count($categories) > 0)  
                            foreach($categories as $category){
                                $cs_cat_class .= $category->slug;
                            }
                            ?>
                                <?php
                                /* Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part( 'framework/templates/blog/masonry/blog',get_post_format());
                                ?>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                        <?php
                            if($masonry_loadmore){
                                echo '<div class="cs_pagination"></div>';
                            }
                            else{
                                cshero_paging_nav();
                            }
                            wp_reset_postdata();
                            wp_reset_query();
                        ?>
                        <?php else : ?>

                            <?php get_template_part( 'framework/templates/blog/blog', 'none' ); ?>

                        <?php endif; ?>
                    </main><!-- #main -->
                </div>
                <?php if($layout->right1_col):?>
                    <div class="right-wrap <?php echo esc_attr($layout->right1_col); ?>">
                         <div id="secondary" class="widget-area" role="complementary">
                            <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                                <?php dynamic_sidebar($layout->right1_sidebar); ?>
                            </div>
                         </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </section><!-- #primary -->
<?php get_footer(); ?>