<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package cshero
 */

get_header(); ?>
<?php
    global $smof_data,$breadcrumb;
    $blog_layout = cshero_generetor_blog_layout();
?>
	<section id="primary" class="content-area<?php if($breadcrumb == '0'){ echo ' no_breadcrumb';} ?><?php echo esc_attr($blog_layout->class); ?> search-php">
        <div class="container">
            <div class="row">
                <?php if ( is_active_sidebar( 'cshero-blog-sidebar' ) && $smof_data['blog_layout'] == 'left-fixed' ): ?>
                <div class="left-wrap col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <?php get_sidebar(); ?>
                </div>
                <?php endif; ?>
                <div class="content-wrap <?php if (!is_active_sidebar( 'cshero-blog-sidebar' ) || $smof_data['blog_layout'] == 'full-fixed'){ echo "col-md-12"; }else { echo "col-xs-12 col-sm-9 col-md-9 col-lg-9"; } ?>">
                    <main id="main" class="site-main" role="main">
                        <div class="content-search-results">
                            <?php if ( have_posts() ) : ?>
                                <?php if($smof_data["search_heading"] == '1'): ?>
                                <header class="page-header text-right">
                                    <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'wp_suarez' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                                </header><!-- .page-header -->
                                <?php endif; ?>
                                <?php /* Start the Loop */ ?>
                                <?php while ( have_posts() ) : the_post(); ?>

                                    <?php
                                    /**
                                     * Run the loop for the search to output the results.
                                     * If you want to overload this in a child theme then include a file
                                     * called content-search.php and that will be used instead.
                                     */
                                    get_template_part( 'framework/templates/search/blog',get_post_format());
                                    ?>

                                <?php endwhile; ?>
                        </div><!-- .content-search-results -->
                                <?php cshero_paging_nav(); ?>

                            <?php else : ?>

                                <?php get_template_part( 'framework/templates/blog/blog', 'none' ); ?>

                            <?php endif; ?>
                        
                    </main><!-- #main -->
                </div>
                <?php if ( is_active_sidebar( 'cshero-blog-sidebar' ) && $smof_data['blog_layout'] == 'right-fixed' ): ?>
                <div class="right-wrap col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <?php get_sidebar(); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

	</section><!-- #primary -->
<?php get_footer(); ?>
