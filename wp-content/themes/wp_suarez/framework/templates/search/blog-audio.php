<?php
/**
 * @package cshero
 */
global $smof_data,$post;
wp_enqueue_style( 'media-audio', get_template_directory_uri().'/css/media-audio.css',array(),'2.14.1');
$has_thumb = has_post_thumbnail() && ! post_password_required() && ! is_attachment() ;

$audio_type = get_post_meta($post->ID, 'cs_post_audio_type', true);
$audio_url = get_post_meta($post->ID, 'cs_post_audio_url', true);

if($has_thumb || $audio_type) $cls = 'col-xs-12 col-sm-9 col-md-9 col-lg-9'; else $cls = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cs-blog'); ?>>
	<div class="row">
		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
			<div class="cs-blog-media">
				<?php if($audio_type): ?>
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
							echo do_shortcode('[audio '.$audio_type.'="'.$audio_url.'" preload="metadata"][/audio]');
						}
					}
					?>
					
				<?php elseif (has_post_thumbnail() && ! post_password_required() && ! is_attachment()): ?>
	    			<div class="cs-blog-thumbnail">
	    				<?php the_post_thumbnail(); ?>
	    			</div><!-- .entry-thumbnail -->
				<?php endif; ?>
			</div>
		</div><!-- .entry-header -->
		<div class="cs-blog-content <?php echo $cls;?>">
			<div class="cs-blog-meta cs-itemBlog-meta">
				<?php echo cshero_title_render(); ?>
				<?php echo cshero_info_bar_render('detail_date'); ?>
			</div>
			<?php cshero_content_render(); ?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->
