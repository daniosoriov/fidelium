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

		<div class="cs-blog-content clearfix">
			<div class="cs-blog-content table">
				<div class="cs-content-text table-cell">
					<?php
						$quote_type = get_post_meta($post->ID, 'cs_post_quote_type', true);
						$quote_content = '';
						if($quote_type == 'custom') {
					?>
						<?php echo get_post_meta($post->ID, 'cs_post_quote', true); ?>
						<?php if(get_post_meta($post->ID, 'cs_post_author', true)): ?>
						<span class="author"><?php echo esc_attr(get_post_meta($post->ID, 'cs_post_author', true)); ?></span>
						<?php endif; ?>
					<?php } else {
						the_excerpt();
					}?>
				</div>
			</div>

			<?php cshero_content_render(); ?>
		</div><!-- .entry-content -->

	</div>
</article><!-- #post-## -->
