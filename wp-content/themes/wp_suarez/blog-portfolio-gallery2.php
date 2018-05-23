<?php
/*
Template Name: Blog Portfolio Gallery (no Space)
*/
get_header(); ?>
<?php global $post,$breadcrumb,$masonry_filter; ?>
<?php
    $category = get_post_meta(get_the_ID(),'cs_portfolio_category',true);
    if(is_array($category)){
        $category =  implode(',', $category);
    }
    $limit = get_post_meta(get_the_ID(),'cs_page_limit',true);
    $masonry_filter = (get_post_meta(get_the_ID(),'cs_page_masonry_filter',true)=='yes')?true:false;
    $masonry_columns = get_post_meta(get_the_ID(),'cs_page_masonry_columns',true);
    $masonry_loadmore = (get_post_meta(get_the_ID(),'cs_page_masonry_loadmore',true)=='yes')?true:false;
    if(empty($limit)) $limit=10;
    if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
    elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
    else { $paged = 1; }
    global $cs_span,$cs_cat_class;
    $cs_span = "col-xs-12 col-sm-12 col-md-6 col-lg-6 nopaddingall";
    switch ($masonry_columns) {
        case 1:
            $cs_span = "col-xs-12 col-sm-12 col-md-12 col-lg-12 nopaddingall";
            break;
        case 2:
            $cs_span = "col-xs-12 col-sm-12 col-md-6 col-lg-6 nopaddingall";
            break;
        case 3:
            $cs_span = "col-xs-12 col-sm-12 col-md-4 col-lg-4 nopaddingall";
            break;
        case 4:
            $cs_span = "col-xs-12 col-sm-12 col-md-3 col-lg-3 nopaddingall";
            break;
        case 6:
            $cs_span = "col-xs-12 col-sm-12 col-md-2 col-lg-2 nopaddingall";
            break;
        default:
            $cs_span = "col-xs-12 col-sm-12 col-md-6 col-lg-6 nopaddingall";
    }
    /*script*/
    wp_enqueue_script('jquery-isotope-min-js', get_template_directory_uri() . "/js/jquery.isotope.min.js",array(),"2.0.0");
    wp_enqueue_script('jquery-imagesloaded-js', get_template_directory_uri() . "/js/jquery.imagesloaded.js",array(),"2.1.0");

?>
<?php $layout = cshero_generetor_layout();?>
    <section id="primary" class="content-area blog-portfolio-gallery blog-portfolio-gallery2 <?php if($breadcrumb == '0'){ echo ' no_breadcrumb_page'; }; ?><?php echo esc_attr($layout->class); ?>">
        <div class="<?php if(get_post_meta($post->ID, 'cs_layout', true) == "1"){ echo "no-container";} else { echo "container"; } ?>">
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
                        <div class="cshero-page-content">
                            <?php 
                            if(have_posts()) the_post();
                            the_content();
                            wp_reset_query();
                            wp_reset_postdata();
                            ?>
                        </div>
                        <?php
                        if($masonry_filter){
                            get_template_part( 'framework/templates/blog/portfolio/masonry','filter');
                        }
                        ?>
                        <?php 
                            global $wp_query;
                            $params = array(
                            'post_type' => 'portfolio',
                            'showposts' => $limit,
                            'paged' => $paged,
                            'tax_query' => array(
                                    array(
                                    'taxonomy' => 'portfolio_category',
                                    'field' => 'term_id',
                                    'terms' => explode(',', $category),
                                    ),
                                )
                            );
                            $wp_query = new WP_Query($params);?>
                        <?php 
                        global $wp_query;
                        $wp_query = new WP_Query('post_type=portfolio&post_status=publish&paged='. $paged . '&recordings=' . $category .'&posts_per_page=' . $limit );?>
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
                            <div class="cshero-masonry-post cs-masonry-layout cshero-shortcode  clearfix">
                            <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                            <?php
                            $categories = get_the_terms($post->ID,'portfolio_category');
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
                                get_template_part( 'framework/templates/blog/portfolio/blog','gallery');
                                ?>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                        <?php else : ?>

                            <?php get_template_part( 'framework/templates/blog/blog', 'none' ); ?>

                        <?php endif; ?>
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