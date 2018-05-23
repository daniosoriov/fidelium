<article <?php post_class('text-'.$content_align.''); ?>>
    <div class="cshero-carousel-container">
        <?php if($show_image) { ?>
            <div class="cshero-carousel-image clearfix" <?php echo $crop_image_size;?>>
                <?php
                if (has_post_thumbnail() and wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)){
                   $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
                    if($crop_image){
                        $image_resize = mr_image_resize( $attachment_image[0], $width_image, $height_image, true, 'c', false );
                        echo '<img alt=""  src="'. $image_resize .'" '.$image_style.' />';
                    }else{
                       echo '<img alt src="'. esc_attr($attachment_image[0]) .'"   '.$image_style.'  />';
                    }
                } else {
                    $attachment_image = CSCORE_PLUGIN_URL.'assets/images/no-image.jpg';
                    if($crop_image == '1'){
                        $image_resize = mr_image_resize( $attachment_image, $width_image, $height_image, true, false );
                        echo '<img alt="" src="'. $image_resize .'"   '.$image_style.' />';
                    }else{
                        echo '<img alt="" src="'. $attachment_image .'"  '.$image_style.' />';
                    }

                } ?>
                <?php if($show_date) :?>
                    <div class="cshero-carousel-post-date" <?php echo $date_style;?>><span class="date-month"><?php echo get_the_date('d M'); ?></span><span class="year"><?php echo get_the_date('Y'); ?></span></div>
                <?php endif; ?>
                <?php if($show_read_more || $show_popup): ?>
                    <div class="overlay <?php echo $overlay_appear;?>" <?php echo $overlay_style; ?>>
                        <div class="overlay-content">
                            <?php if($show_read_more) echo $readmore_link;?>
                            <?php if($show_popup) echo $popup_link; ?> 
                        </div>
                    </div>
                <?php endif; ?>   
            </div>
            <div class="cshero-carousel-body" <?php echo $content_style;?>>
                <div class="cshero-carousel-inner clearfix">
                    <?php if ($show_title == '1') { ?>
                        <<?php echo $item_heading_size; ?> class="cshero-carousel-title clearfix">
                            <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" rel="" style="color: <?php echo esc_attr($item_title_color); ?>">
                                <?php the_title(); ?>
                            </a>
                        </<?php echo $item_heading_size; ?>>
                    <?php } ?>
                    <?php if ($show_category) : ?>
                        <div class="cshero-carousel-post-category">
                            <?php echo strip_tags (get_the_term_list($post->ID, 'category', '', ', ', '')); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($show_description == '1') { ?>
                    <div class="cshero-carousel-post-description" style="color: <?php echo esc_attr($content_color); ?>">
                        <?php if ($excerpt_length != -1) { ?>
                            <p><?php echo cshero_content_max_charlength(strip_tags(strip_shortcodes(get_the_content())), $excerpt_length); ?></p>
                        <?php } else { ?>
                            <p><?php the_content(); ?></p>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
                <?php if($show_comment || $show_author): ?>
                <div class="cshero-carousel-meta clearfix">
                    
                    <?php if($show_comment) :?>
                    <span class="cshero-carousel-comment"><i class="fa fa-comment-o"></i>
                        <?php
                        $comments = (int)get_comments_number();
                        if($comments > 0){
                            echo $comments." Comments";
                        }
                        else {
                            echo _e("No Comments",'wp_suarez');
                        }
                        ?>
                    </span>
                    <?php endif; ?>
                    <?php if($show_author) :?>
                    <span><i class="fa fa-pencil"></i> <?php the_author(); ?></span>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        <?php } else { ?>
            <div class="cshero-carousel-body" <?php echo $content_style;?>>
                <div class="cshero-carousel-inner clearfix">
                    <?php if ($show_title == '1') { ?>
                        <<?php echo $item_heading_size; ?> class="cshero-carousel-title clearfix">
                            <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" rel="" style="color: <?php echo esc_attr($item_title_color); ?>">
                                <?php the_title(); ?>
                            </a>
                        </<?php echo $item_heading_size; ?>>
                    <?php } ?>
                    <?php if ($show_category) : ?>
                        <div class="cshero-carousel-post-category">
                            <?php echo strip_tags (get_the_term_list($post->ID, 'category', '', ', ', '')); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($show_description == '1') { ?>
                    <div class="cshero-carousel-post-description" style="color: <?php echo esc_attr($content_color); ?>">
                        <?php if ($excerpt_length != -1) { ?>
                            <p><?php echo cshero_content_max_charlength(strip_tags(strip_shortcodes(get_the_content())), $excerpt_length); ?></p>
                        <?php } else { ?>
                            <p><?php the_content(); ?></p>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
                <?php if($show_comment || $show_author): ?>
                <div class="cshero-carousel-meta clearfix">
                    
                    <?php if($show_comment) :?>
                    <span class="cshero-carousel-comment"><i class="fa fa-comment-o"></i>
                        <?php
                        $comments = (int)get_comments_number();
                        if($comments > 0){
                            echo $comments." Comments";
                        }
                        else {
                            echo _e("No Comments",'wp_suarez');
                        }
                        ?>
                    </span>
                    <?php endif; ?>
                    <?php if($show_author) :?>
                    <span><i class="fa fa-pencil"></i> <?php the_author(); ?></span>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php if($show_read_more || $show_popup): ?>
                <div class="overlay" <?php echo $overlay_style; ?>>
                    <div class="overlay-content">
                        <?php if($show_read_more) echo $readmore_link;?>
                        <?php if($show_popup) echo $popup_link; ?> 
                    </div>
                </div>
            <?php endif; ?>
        <?php } ?>        
    </div>
    <h6 style="display:none;">&nbsp;</h6><?php /* this element for fix validator warning */ ?>
</article>
