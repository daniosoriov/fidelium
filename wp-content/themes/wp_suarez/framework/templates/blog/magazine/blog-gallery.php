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
			$gallery_ids = cshero_grab_ids_from_gallery()->ids;
			if(!empty($gallery_ids)):
			?>
				<div id="carousel-example-generic<?php the_ID(); ?>" class="carousel slide" data-ride="carousel">
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
                    <a class="left carousel-control" href="#carousel-example-generic<?php the_ID(); ?>" role="button" data-slide="prev">
					    <span class="ion-ios7-arrow-left"></span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic<?php the_ID(); ?>" role="button" data-slide="next">
					    <span class="ion-ios7-arrow-right"></span>
					</a>
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