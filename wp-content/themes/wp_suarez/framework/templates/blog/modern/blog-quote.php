<?php
/**
 * @package cshero
 */
global $cs_span,$masonry_filter,$timeline;
$class='cs-masonry-layout-item '.$cs_span.' ';
if($masonry_filter){
	global $cs_cat_class;
	$class .= "category-".$cs_cat_class;
}
?>
<?php global $smof_data,$post; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<?php if($timeline=='timeline'):?>
		<div class="cs-timeline-date hidden-xs">
			<?php
			$archive_date = get_the_date($smof_data['archive_date_format']);?>
		    <span><i class="fa fa-clock-o"></i><a href="<?php echo get_day_link(get_the_time('Y'),get_the_time('m'),get_the_time('d')); ?>" title="<?php echo $archive_date; ?>"><?php echo $archive_date; ?></a></span>
		</div>
	<?php endif;?>
	<div class="cs-blog">
		<div class="cs-blog-meta cs-itemBlog-meta">
			<?php
			echo cshero_title_render();
			echo cshero_info_bar_render();
			echo cshero_get_like_comment();
			?>
		</div>
		<header class="cs-blog-header">
			<div class="cs-blog-content cs-blog-quote">
					<div class="cs-content-text">
						<?php $quote_type = get_post_meta($post->ID, 'cs_post_quote_type', true);
						$quote_content = '';
						if($quote_type == 'custom'){
						?>
							<?php echo get_post_meta($post->ID, 'cs_post_quote', true); ?>
							<?php if(get_post_meta($post->ID, 'cs_post_author', true)): ?>
							<div class="author"><span><?php echo esc_attr(get_post_meta($post->ID, 'cs_post_author', true)); ?></span></div>
							<?php endif; ?>
						<?php } else {
							echo get_the_excerpt();
						}?>
					</div>

			</div>
		</header><!-- .entry-header -->
		<div class="cs-blog-content">
			<?php cshero_content_render(); ?>
		</div><!-- .entry-content -->
		<div class="social-share">
			<?php
				$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
	        	$img = esc_attr($attachment_image[0]);
	        	$title = get_the_title();
	        	echo cs_socials_share(get_the_permalink(),$img, $title);
			?>
		</div>
	</div>
</article><!-- #post-## -->
