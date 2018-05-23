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
		<header class="cs-blog-header">
			<?php
			$audio_type = get_post_meta($post->ID, 'cs_post_audio_type', true);
			$audio_url = get_post_meta($post->ID, 'cs_post_audio_url', true);
			if($audio_type):
				?>
				<div class="cs-blog-media">
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
			<?php elseif (has_post_thumbnail() && ! post_password_required() && ! is_attachment()): ?>
    			<div class="cs-blog-thumbnail">
    				<?php the_post_thumbnail(); ?>
    			</div><!-- .entry-thumbnail -->
			<?php endif; ?>
		</header><!-- .entry-header -->
		<div class="cs-blog-content">
			<header class="cs-blog-header">
				<div class="cs-blog-meta cs-itemBlog-meta">					
					<?php echo cshero_info_bar_render(); ?>
					<?php echo cshero_title_render(); ?>
				</div>
			</header><!-- .entry-header -->
			<div class="cs-blog-content">
				<?php cshero_content_render(); ?>
			</div><!-- .entry-content -->
			<div class="cs-meta-bottom-wrap">
				<?php echo cshero_info_footer_render(); ?>
			</div>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->
