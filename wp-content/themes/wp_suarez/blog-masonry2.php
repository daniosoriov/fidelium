<?php
/*
Template Name: Blog Masonry Layout2
*/
get_header(); ?>
<?php global $post,$breadcrumb,$masonry_filter; ?>
<?php
    $category = get_post_meta(get_the_ID(),'cs_page_category',true);
    if(is_array($category)){
        $category =  implode(',', $category);
    }
    $limit = get_post_meta(get_the_ID(),'cs_page_limit',true);
    if(empty($limit)) $limit=6;
    $masonry_columns = get_post_meta(get_the_ID(),'cs_page_masonry_columns',true); 
    if(empty($masonry_columns))  $masonry_columns = 3;

    $masonry_filter = (get_post_meta(get_the_ID(),'cs_page_masonry_filter',true)=='yes')?true:false;
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
the_post();
?>
<?php $layout = cshero_generetor_layout();?>

    <section id="primary" class="content-area clearfix">
        <h6 style="display:none;">&nbsp;</h6><?php /* this element for fix validator warning */ ?>
        <div class="container">
            <div class="row">
                <div class="content-wrap content-builder-wrap">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
        
        <div class="content-wrap <?php echo esc_attr($layout->blog); ?> blog-grid-wrap">
            <main id="main" class="site-main" role="main">
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
                    <div class="cshero-masonry-post cs-masonry-layout cs-masonry-layout-2 cshero-shortcode">
                    <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                    <?php
                    $categories = get_the_category($post->ID);
                    $cs_cat_class='';
                    foreach($categories as $category){
                        $cs_cat_class .= $category->slug;
                    }
                    ?>
                        <?php
                        /* Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'framework/templates/blog/columns-style2/blog',get_post_format());
                        ?>
                    <?php endwhile; ?>
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

    </section>
                
                
            
<?php get_footer(); ?>