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
<?php global $smof_data; ?>
<?php if(is_sticky($post->ID)):?>
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
						echo do_shortcode('[audio '.$audio_type.'="'.$audio_url.'" preload="metadata"][/audio]');
					}
				}
				?>
				</div>
			<?php elseif (has_post_thumbnail() && ! post_password_required() && ! is_attachment()): ?>
    			<div class="cs-blog-thumbnail">
    				<?php the_post_thumbnail(); ?>
    			</div><!-- .entry-thumbnail -->
			<?php endif; ?>
			<div class="cs-blog-meta cs-itemBlog-meta">
				<?php
				echo cshero_info_bar_render('date');
				?>
			</div>
		</header><!-- .entry-header -->
		<div class="cs-blog-content">
			<?php echo cshero_title_render();
			cshero_content_render();
			echo cshero_get_like_comment();
			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->
<?php else:?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<div class="cs-blog">
		<div class="row">
			<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
				<div class="cshero-post-img col-xs-12 col-lg-2 col-sm-2 col-md-2">
					<div class="cs-blog-media">
						<div class="cs-blog-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div><!-- .entry-thumbnail -->
					</div>
				</div>
			<?php endif; ?>
			<div class="cs-blog-meta cs-itemBlog-meta col-xs-12 col-lg-10 col-sm-10 col-md-10">
				<?php
				echo cshero_title_render();
				echo cshero_info_bar_render();
				?>
			</div>
		</div>
	</div>
</article>
<?php endif;?>