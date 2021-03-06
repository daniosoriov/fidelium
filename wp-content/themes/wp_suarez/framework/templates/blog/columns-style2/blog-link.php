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

		<?php if (has_post_thumbnail() && ! post_password_required() && ! is_attachment()): ?>
			<div class="cs-blog-media">
				<div class="cs-blog-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div><!-- .entry-thumbnail -->
			</div>
		<?php endif; ?>
		
		<header class="cs-blog-header">
			<div class="cs-blog-meta cs-itemBlog-meta">
				<?php echo cshero_title_render(); ?>
				<?php echo cshero_info_bar_render('detail_category'); ?>
			</div>
		</header><!-- .entry-header -->
		<div class="cs-blog-content clearfix">
			<?php cshero_content_render(false); ?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->

