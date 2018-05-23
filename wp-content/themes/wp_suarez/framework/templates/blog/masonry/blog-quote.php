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
<?php global $smof_data,$post; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<div class="cs-blog">
		<header class="cs-blog-header cs-blog-quote">
			<div class="cs-blog-content table">
				<span class="icon-left table-cell"></span>
					<div class="cs-content-text table-cell">
						<?php $quote_type = get_post_meta($post->ID, 'cs_post_quote_type', true);
						$quote_content = '';
						if($quote_type == 'custom'){
						?>
							<?php echo get_post_meta($post->ID, 'cs_post_quote', true); ?>
							<?php if(get_post_meta($post->ID, 'cs_post_author', true)): ?>
							<span class="author"><?php echo esc_attr(get_post_meta($post->ID, 'cs_post_author', true)); ?></span>
							<?php endif; ?>
						<?php } else {
							the_excerpt();
						}?>
					</div>
				<span class="icon-right table-cell"></span>
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
