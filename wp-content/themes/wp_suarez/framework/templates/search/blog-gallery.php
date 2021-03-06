<?php
/**
 * @package cshero
 */
global $cs_span,$masonry_filter,$timeline;
$class='cs-masonry-layout-item '.$cs_span.' ';
if($masonry_filter){
	global $cs_cat_class;
	$class .= "category-".$cs_cat_class;
}?>
<?php global $smof_data; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<?php if($timeline=='timeline'):?>
		<div class="cs-timeline-date hidden-xs">
			<?php
			$archive_date = get_the_date($smof_data['archive_date_format']);?>
		    <span><i class="fa fa-clock-o"></i><a href="<?php echo get_day_link(get_the_time('Y'),get_the_time('m'),get_the_time('d')); ?>" title="<?php echo esc_attr($archive_date); ?>"><?php echo esc_attr($archive_date); ?></a></span>
		</div>
	<?php endif;?>
	<div class="cs-blog">
		<header class="cs-blog-header">
			<div class="cs-blog-media">
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
			</div>
			<div class="cs-blog-meta cs-itemBlog-meta">
				<?php echo cshero_title_render(); ?>
				<?php if($timeline!='timeline'){
					echo cshero_info_bar_render();
				}
				else{
					echo cshero_info_bar_render('detail_date');
				} ?>
			</div>
		</header><!-- .entry-header -->
		<div class="cs-blog-content">
			<?php cshero_content_render(); ?>
		</div><!-- .entry-content -->
		<div class="cs-meta-bottom-wrap">
			<?php echo cshero_info_footer_render(); ?>
		</div>
	</div>
</article><!-- #post-## -->

