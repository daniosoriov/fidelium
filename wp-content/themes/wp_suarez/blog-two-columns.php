<?php
/*
Template Name: Blog Multiple Columns
*/
get_header(); ?>
<?php global $post,$breadcrumb; ?>
<?php
    $category = get_post_meta(get_the_ID(),'cs_page_category',true);
    if(is_array($category)){
        $category =  implode(',', $category);
    }

    $limit = get_post_meta(get_the_ID(),'cs_page_limit',true);
    if(empty($limit)) $limit = 9;
    $columns = get_post_meta(get_the_ID(),'cs_page_masonry_columns',true); 
    if(empty($columns))  $columns = 3;
    $masonry_filter = (get_post_meta(get_the_ID(),'cs_page_masonry_filter',true)=='yes')?true:false;
    $masonry_loadmore = (get_post_meta(get_the_ID(),'cs_page_masonry_loadmore',true)=='yes')?true:false;
    if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
    elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
    else { $paged = 1; }
    $span = 'col-lg-12 col-sm-6 col-md-6 col-xs-6';
    switch ($columns) {
        case '2':
            $span = 'col-lg-6 col-sm-6 col-md-6 col-xs-12';
            break;
        case '3':
            $span = 'col-lg-4 col-sm-4 col-md-4 col-xs-12';
            break;
        case '4':
            $span = 'col-lg-3 col-sm-3 col-md-3 col-xs-12';
            break;
        case '6':
            $span = 'col-lg-2 col-sm-2 col-md-2 col-xs-12';
            break;
        default:
            $span = 'col-lg-6 col-sm-6 col-md-6 col-xs-12';
            break;
    }
?>
<?php $layout = cshero_generetor_layout();?>
    <section id="primary" class="content-area<?php if($breadcrumb == '0'){ echo ' no_breadcrumb_page'; }; ?> blog-two-columns<?php echo esc_attr($layout->class); ?> blog-grid-wrap">
        <div class="container">
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
                    <main id="main" class="site-main blog-cols blog-cols2" role="main">
                        <?php 
                            global $wp_query;
                            $wp_query = new WP_Query('post_type=post&post_status=publish&paged='. $paged . '&cat=' . $category .'&posts_per_page=' . $limit );?>
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
                                            'masonry' => 'grid'
                                        )
                                    );
                                    wp_enqueue_script( 'cshero-load-more-js' );
                                }

                                ?>
                            <?php /* Start the Loop */ ?>
                            <?php
                            $index = 0;
                            $stickies = count(get_option( 'sticky_posts' ));
                            $limit = ($paged==1)?($limit+$stickies):$limit;
                            ?>
                            <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                            <?php
                            if($index%$columns==0){
                                ?><div class="cs-article row"><?php
                            }
                            ?>
                                <div class="<?php echo esc_attr($span);?>">
                                    <?php
                                    /* Include the Post-Format-specific template for the content.
                                     * If you want to override this in a child theme, then include a file
                                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                     */
                                    get_template_part( 'framework/templates/blog/columns-style1/blog',get_post_format());
                                    ?>
                                </div>
                            <?php
                            $index++;
                            if($index%$columns==0 || $index==$limit){
                                ?></div><?php
                            }
                            ?>
                            <?php endwhile; wp_reset_postdata();?>

                            <?php
                                if($masonry_loadmore){
                                    echo '<div class="cs_pagination"></div>';
                                }
                                else{
                                    cshero_paging_nav();
                                }
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