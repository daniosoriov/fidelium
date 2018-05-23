<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, CMS Event already
 * has for Event Tag archives, Event Category archives.
 *
 * @link https://github.com/vianhtu/cmsevents
 *
 * @package CMS Event
 * @version 1.0.0
 */

get_header(); ?>
 
<?php global $smof_data,$breadcrumb; $layout = cshero_generetor_layout(); ?>  
	<div id="primary" class="content-area<?php if($breadcrumb == '0'){ echo ' no_breadcrumb'; }; ?> single-event-php"> 
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
                    <main id="main" class="site-main" role="main">
                        <?php
            			/* Start the Loop */
            			while ( have_posts() ) : the_post();
            
            				get_template_part( 'framework/templates/event/archive'); 
            			  
            			endwhile;
            
            			wp_link_pages( array(
                			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'wp_suarez' ) . '</span>',
                			'after'       => '</div>',
                			'link_before' => '<span>',
                			'link_after'  => '</span>',
                			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'wp_suarez') . ' </span>%',
                			'separator'   => '<span class="screen-reader-text">, </span>',
            			) );
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
	</div><!-- #primary -->
<?php get_footer(); ?>

 