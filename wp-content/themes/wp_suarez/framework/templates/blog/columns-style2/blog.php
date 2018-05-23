<?php
/**
 * @package cshero
 */
global $cs_span,$masonry_filter;
$class='cs-masonry-layout-item '.$cs_span.' ';
if($masonry_filter){
	global $cs_cat_class;
	$class .= "category-".$cs_cat_class;
}
?>
<?php global $smof_data; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<div class="cs-blog">
		<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
			<div class="cs-blog-media">
				<div class="cs-blog-thumbnail">
					<?php the_post_thumbnail('masonry-thumb'); ?>
				</div><!-- .entry-thumbnail -->
				<?php echo cshero_title_render(); ?>
				<div class="overlay from-center">
					<div class="overlay-content">
						<div class="cs-blog-header">
							<?php echo cshero_info_bar_blog_render('date','categories'); echo cshero_title_render(); ?>
						</div>
						<div class="cs-blog-content clearfix">
							<?php cshero_content_render(); ?>
						</div><!-- .entry-content -->
					</div>
				</div>
			</div>
		<?php else: ?>
			<div class="cs-blog-nothumb">
				<div class="cs-blog-header">
					<?php echo cshero_title_render(); ?>
				</div>
				<div class="cs-blog-content clearfix">
					<?php cshero_content_render(); ?>
				</div><!-- .entry-content -->	
			</div>
		<?php endif; ?>
	</div>
</article><!-- #post-## -->
