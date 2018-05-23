<?php 
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package cshero
 */

global $smof_data;
$type = $smof_data['404_type'];
/* Redirect Home */
if($type == 'Redirect Home'){
    wp_redirect( esc_url(home_url('/') ) ); exit();
}
get_header();
?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="error-404 not-found container">
			    <?php if($smof_data['404_heading'] == '1'): ?>
				<header class="page-header">
					<h1 class="page-title">404</h1>
				</header><!-- .page-header -->
				<?php endif; ?>
				<div class="page-content">
				<?php
				if($type == 'From Page'){
				    if($smof_data['404_page_id']){
                        $error_page = get_post($smof_data['404_page_id']);
				        if(!empty($error_page)){
				            $content = apply_filters("the_content", $error_page->post_content);
				            echo $content;
				        } else {
				            cshero_404_page_default();
				        }
				    } else {
				        cshero_404_page_default();
				    }
				} else {
				    cshero_404_page_default();
				}
				?>
				<div class="popular-404">
				<h3><?php echo _e('HERE ARE SOME OTHER USEFUL POSTS','wp_suarez');?></h3>
				<ul class="list-checked">
				<?php 
				$posts = get_posts('orderby=rand&numberposts=5'); 
				   foreach($posts as $post) { ?>
				        <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
				        </li>
				   <?php } ?>
				</ul>
				</div>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>
