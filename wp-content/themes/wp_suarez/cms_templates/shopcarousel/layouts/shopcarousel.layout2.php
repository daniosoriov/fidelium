
                        <div class="cshero-carousel-item">
                            <?php do_action('woocommerce_before_shop_loop_item'); ?>
                            <?php if($show_image) :?>
                                <div class="product-image" >
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                            if($crop_image){
                                                if (has_post_thumbnail() and wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)){
                                                    $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
                                                    
                                                    $image_resize = mr_image_resize( $attachment_image[0], $width_image, $height_image, true, 'c', false );
                                                    echo  '<img alt=""  src="'. $image_resize .'" />';
                                                    
                                                } else {
                                                    $attachment_image = CSCORE_PLUGIN_URL.'assets/images/no-image.jpg';
                                                    
                                                    $image_resize = mr_image_resize( $attachment_image, $width_image, $height_image, true, false );
                                                    echo  '<img alt="" src="'. $image_resize .'" />';
                                                } 
                                            } else {
                                                do_action('woocommerce_before_shop_loop_item_title');
                                            }
                                        ?>
                                    </a>
                                </div>
                                <div class="overlay" <?php echo $overlay_style;?>>
                                    <div class="overlay-content product-content" <?php echo $content_style;?>>
                                        <?php if ( $show_category): ?>
                                            <div class="product-category">
                                                <?php
                                                    $postid = get_the_ID();
                                                    $categories = get_the_term_list($postid, 'product_cat', '', ', ', '');
                                                ?>
                                                <?php print_r($categories); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($show_title) { ?>
                                            <div class="product-title">
                                            <<?php echo $item_heading_size; ?> class="cshero-title product-title">
                                                <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" rel="" style="color: <?php echo esc_attr($item_title_color); ?>;">
                                                    <?php the_title(); ?>
                                                </a>
                                            </<?php echo $item_heading_size; ?>>
                                            </div>
                                        <?php } ?>
                                        <?php if($show_description): ?>
                                        <div class="product-description">
                                            <span>
                                            <?php echo cshero_content_max_charlength(strip_tags(strip_shortcodes(get_the_content())), $excerpt_length); ?>
                                            </span>
                                        </div>
                                        <?php endif; ?>

                                        <?php if ( $show_price): ?>
                                        <div class="product-price">
                                            <?php
                                            do_action('woocommerce_after_shop_loop_item_title');
                                            ?>
                                        </div>
                                        <?php endif; ?>
                                        <?php if ($show_add_to_cart || $show_details_btn): ?>
                                        <div class="product-button <?php echo $button_type; ?>">
                                            <?php if ($show_add_to_cart): ?>
                                                <span class="product-add-to-cart">
                                                    <?php do_action( 'woocommerce_after_shop_loop_item' );   ?>
                                                </span>
                                            <?php endif; ?>
                                            <?php if ($show_details_btn): ?>   
                                            <span class="product-view-detail">
                                                <a class="btn btn-default" rel="" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span><?php echo $view_details_btn_text;?></span></a>
                                            </span> 
                                            <?php endif; ?>
                                        </div>
                                        <?php endif; ?>
                                        <?php if ( $show_date): ?>
                                        <div class="product-date">
                                            <?php echo get_the_date($date_format); ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php else : ?>    
                                <div class="product-content" <?php echo $content_style;?>>
                                    <?php if ( $show_category): ?>
                                    <div class="product-category">
                                            <?php
                                                $postid = get_the_ID();
                                                $categories = get_the_term_list($postid, 'product_cat', '', ', ', '');
                                            ?>
                                            <?php print_r($categories); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($show_title) { ?>
                                        <div class="product-title">
                                        <<?php echo $item_heading_size; ?> class="cshero-title product-title">
                                            <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" rel="" style="color: <?php echo esc_attr($item_title_color); ?>;">
                                                <?php the_title(); ?>
                                            </a>
                                        </<?php echo $item_heading_size; ?>>
                                        </div>
                                    <?php } ?>
                                    <?php if($show_description): ?>
                                    <div class="product-description">
                                        <span>
                                        <?php echo cshero_content_max_charlength(strip_tags(strip_shortcodes(get_the_content())), $excerpt_length); ?>
                                        </span>
                                    </div>
                                    <?php endif; ?>
                                    <?php if ( $show_price): ?>
                                    <div class="product-price">
                                        <?php
                                        do_action('woocommerce_after_shop_loop_item_title');
                                        ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php if ($show_add_to_cart || $show_details_btn): ?>
                                    <div class="product-button <?php echo $button_type; ?>">
                                        <?php if ($show_add_to_cart): ?>
                                            <div class="product-add-to-cart">
                                                <?php do_action( 'woocommerce_after_shop_loop_item' );   ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($show_details_btn): ?>   
                                        <div class="product-view-detail">
                                            <a class="btn btn-default" rel="" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span><?php echo $view_details_btn_text;?></span></a>
                                        </div> 
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php if ( $show_date): ?>
                                    <div class="product-date">
                                        <?php echo get_the_date($date_format); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    
