<?php
/**
 * @package cshero
 */
global $cs_span,$masonry_filter;
$class='cs-masonry-layout-item '.$cs_span.' ';
if($masonry_filter){
	global $cs_cat_class;
	$class .= "category-".$cs_cat_class;
}?>
<?php global $smof_data; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<div class="cs-blog row">
			
			<?php
			$gallery_ids = cshero_grab_ids_from_gallery()->ids;
		if(!empty($gallery_ids)):
		?>
		<div class="cs-blog-media">
			<div id="carousel-example-generic<?php echo $post->ID;?>" class="carousel slide" data-ride="carousel">
	                <div class="carousel-inner">
	                <?php $i = 0; ?>
	                <?php foreach ($gallery_ids as $image_id): ?>
					<?php
	                    $attachment_image = wp_get_attachment_image_src($image_id, 'full', false);
	                    if($attachment_image[0] != ''):?>
						<div class="item <?php if($i==0){ echo 'active'; } ?>">
	                    		<img style="width:100%;" data-src="holder.js" src="<?php echo esc_url($attachment_image[0]);?>" alt="" />
	                    	</div>
	                    <?php $i++; endif; ?>
	                <?php endforeach; ?>
	                </div>
                <a class="left carousel-control" href="#carousel-example-generic<?php echo $post->ID;?>" role="button" data-slide="prev">
				    <span class="ion-ios7-arrow-left"></span>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic<?php echo $post->ID;?>" role="button" data-slide="next">
				    <span class="ion-ios7-arrow-right"></span>
				</a>
			</div>
		</div>
		<?php elseif (has_post_thumbnail() && ! post_password_required() && ! is_attachment()): ?>
			<div class="cs-blog-media">
    			<div class="cs-blog-thumbnail">
    				<?php the_post_thumbnail('medium'); ?>
    			</div><!-- .entry-thumbnail -->
			</div>
		<?php endif; ?>
			
		<header class="cs-blog-header">
			<div class="cs-blog-meta cs-itemBlog-meta">
				<?php echo cshero_title_render(); ?>
			</div>
		</header><!-- .entry-header -->
	</div>
</article><!-- #post-## -->

