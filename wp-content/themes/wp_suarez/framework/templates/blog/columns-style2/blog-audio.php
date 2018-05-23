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
<?php
	wp_enqueue_style( 'media-audio', get_template_directory_uri().'/css/media-audio.css',array(),'2.14.1');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<div class="cs-blog">
		<?php
			$audio_type = get_post_meta($post->ID, 'cs_post_audio_type', true);
			$audio_url = get_post_meta($post->ID, 'cs_post_audio_url', true);
		if($audio_type):
			?>
			<div class="cs-blog-media">
			<div class="cs-blog-thumbnail">
			<?php
			if ($audio_type == 'content'){
				$shortcode = cshero_get_shortcode_from_content('playlist');
				if(!$shortcode){
					$shortcode = cshero_get_shortcode_from_content('audio');
				}
				if($shortcode):
					echo do_shortcode($shortcode);
				endif;
			} elseif ($audio_type == 'ogg' || $audio_type == 'mp3' || $audio_type == 'wav'){
				if($audio_url){
					echo do_shortcode('[audio '.$audio_type.'="'.$audio_url.'"][/audio]');
				}
			}
			?>
			</div>
			</div>
		<?php elseif (has_post_thumbnail() && ! post_password_required() && ! is_attachment()): ?>
			<div class="cs-blog-media">
    			<div class="cs-blog-thumbnail">
    				<?php the_post_thumbnail(); ?>
    			</div><!-- .entry-thumbnail -->
    			<?php echo  cshero_read_more_render(); ?>
			</div>
		<?php endif; ?>

		<header class="cs-blog-header">
			<div class="cs-blog-meta cs-itemBlog-meta">
				<?php echo cshero_title_render(); ?>
				<?php echo cshero_info_bar_render('detail_category'); ?>
			</div>
			<h6 style="display:none;">&nbsp;</h6><?php /* this element for fix validator warning */ ?>
		</header><!-- .entry-header -->
		<div class="cs-blog-content clearfix">
			<?php cshero_content_render(false); ?>
		</div><!-- .entry-content -->
		<div class="cs-blog-share">
        	<?php
        	$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
        	$img = esc_attr($attachment_image[0]);
        	$title = get_the_title();
        	echo cs_socials_share(get_the_permalink(),$img, $title,get_comments_link($post->ID));
        	?>
        </div>
	</div>
</article><!-- #post-## -->
