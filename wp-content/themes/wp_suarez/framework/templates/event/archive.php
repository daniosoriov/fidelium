<?php
/**
 * @package cshero
 */
?>  
<?php global $smof_data; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="cs-blog cs-blog-item cs-event-item">
		<?php if ($smof_data['post_featured_images'] == '1' ) : ?>
			<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
				<div class="cs-blog-thumbnail">
					<?php the_post_thumbnail('full'); ?>
				</div><!-- .entry-thumbnail -->
			<?php endif; ?>
		<?php endif; ?>
		<div class="cs-event-content-wrap">
			<header class="cs-blog-header">
				<div class="cs-blog-meta cs-itemBlog-meta">
					<?php if($smof_data['show_post_title'] == '1'): ?>
                    <?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
					
					<?php endif; ?>
					<!-- .info-bar -->
					<div>
					    <div class="event-date primary-color">
                            <p><strong><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;<?php echo esc_html__('Start date time: ','wp_suarez'); ?></strong><span class="date"><?php the_cmsevent_start_datetime(); ?></span></p>
                            <p><strong><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;<?php echo esc_html__('End date time: ','wp_suarez'); ?></strong><span class="date"><?php the_cmsevent_end_datetime(); ?></span></p>
    	                     
					    </div>
                         
					</div>
				</div>
			</header><!-- .entry-header -->
			 
			<?php cshero_paging_nav(); ?> 
	    </div>
	</div>
</article><!-- #post-## -->