<?php
/**
 * @package cshero
 */
global $cs_span,$masonry_filter;
$class='cs-masonry-layout-item '.$cs_span.' ';
if($masonry_filter){
	global $cs_cat_class;
	$class = "category-".$cs_cat_class;
}
?>
<?php global $smof_data,$post; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<div class="cs-blog">
		<header class="cs-blog-header">
			<div class="cs-blog-media">
				<?php if (has_post_thumbnail() && ! post_password_required() && ! is_attachment()): ?>
	    			<div class="cs-blog-thumbnail">
	    				<?php the_post_thumbnail('masonry-thumb'); ?>
	    			</div><!-- .entry-thumbnail -->
				<?php endif; ?>
			</div>
			<div class="cs-blog-meta cs-itemBlog-meta">
				<div class="cs-blog-date">
					<i><?php echo get_the_date('j M Y'); ?></i>
				</div>
				<?php echo cshero_title_render(); ?>
			</div>
			<h6 style="display:none;">&nbsp;</h6><?php /* this element for fix validator warning */ ?>
		</header><!-- .entry-header -->
		<div class="cs-blog-content">
			<?php cshero_content_render(); ?>
		</div><!-- .entry-content -->
		<div class="cs-meta-bottom-wrap">
        	<?php echo cshero_get_like_comment(); ?>
        </div>
	</div>
</article><!-- #post-## -->

