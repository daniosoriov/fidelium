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
					<div class="cs-blog-title"><<?php echo $smof_data['detail_title_heading'];?>><?php the_title(); ?></<?php echo $smof_data['detail_title_heading'];?>></div>
					<?php endif; ?>
					<!-- .info-bar -->
					<div>
					    <div class="event-date primary-color">
                            <p><strong><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;<?php echo esc_html__('Start date time: ','wp_suarez'); ?></strong><span class="date"><?php the_cmsevent_start_datetime(); ?></span></p>
                            <p><strong><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;<?php echo esc_html__('End date time: ','wp_suarez'); ?></strong><span class="date"><?php the_cmsevent_end_datetime(); ?></span></p>
    	                    
					   
					    </div>
                       
					    <?php
	                     
                        $event_location_name = get_post_meta(get_the_ID(), 'cmsevent_location', true);
                        $event_address = get_post_meta(get_the_ID(), 'cmsevent_address', true);
                        $event_city = get_post_meta(get_the_ID(), 'cmsevent_city', true);
                         
                        if($event_location_name && $event_address && $event_city){
	                        $event_state = get_post_meta(get_the_ID(), 'cmsevent_state', true);
	                        $event_postcode = get_post_meta(get_the_ID(), 'cmsevent_postcode', true);
	                        $event_region = get_post_meta(get_the_ID(), 'cmsevent_region', true);
	                        $even_country = get_post_meta(get_the_ID(), 'cmsevent_country', true);
	                        echo '<div class="event-where"><strong>'.esc_html__('Place: ','wp_suarez').'</strong>';
	                        echo $event_location_name.',&nbsp;'.$event_address.',&nbsp;'.$event_city;
	                        if($event_state){ echo ',&nbsp;'.$event_state; }
	                        
	                        if($event_region){ echo ',&nbsp;'.$event_region; }
	                        if($even_country){ echo ',&nbsp;'.$even_country; }
	                        echo '</div>';
                            if($event_postcode){ 
                                echo '<p><strong>'.esc_html__('Postcode: ','wp_suarez').'</strong>'.$event_postcode.'</p>';
                            }
	                    }
	            	    ?>
                        
					</div>
				</div>
			</header><!-- .entry-header -->
			<div class="cs-blog-content">
				<?php
					the_content();
					wp_link_pages( array(
						'before'      => '<div class="pagination loop-pagination"><span class="page-links-title">' . __( 'Pages:','wp_suarez') . '</span>',
						'after'       => '</div>',
						'link_before' => '<span class="page-numbers">',
						'link_after'  => '</span>',
					) );
				?>
			</div><!-- .entry-content -->
			<?php if($smof_data['show_social_post']):?>
	        <div class="cs-blog-share">
	            <?php
	                $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
	                $img = esc_attr($attachment_image[0]);
	                $title = get_the_title();
	                echo cs_socials_share(get_the_permalink(),$img, $title,get_comments_link($post->ID));
	            ?>
	        </div>
	        <?php endif; ?>
	    </div>
	</div>
</article><!-- #post-## -->