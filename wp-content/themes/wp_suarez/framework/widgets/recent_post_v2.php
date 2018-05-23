<?php
add_action('widgets_init', 'cs_recent_post_widgets');

function cs_recent_post_widgets() {
    register_widget('CS_Recent_Post_Widget_V2');
}

class CS_Recent_Post_Widget_V2 extends WP_Widget {

    function __construct() {
        parent::__construct(
                'cs_recent_post_v2', __('CS Recent Posts V2','wp_suarez'), array('description' => __('Recent Posts Widget.', 'wp_suarez'),)
        );
    }

    function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'wp_suarez' ) : $instance['title'], $instance, $this->id_base);
        $show_date = (int) $instance['show_date'];
        $show_decs = (int) $instance['show_decs'];
        $number = (int) $instance['number'];

        $sticky = get_option('sticky_posts');
        $args = array(
            'posts_per_page' => $number,
            'post_type' => 'post',
            'post_status' => 'publish',
            'post__not_in'  => $sticky,
            'orderby' => 'date',
            'order' => 'DESC',
            'paged' => 1
        );
        $wp_query = new WP_Query($args);
        $extra_class = !empty($instance['extra_class']) ? $instance['extra_class'] : "";

        // no 'class' attribute - add one with the value of width
        if( strpos($before_widget, 'class') === false ) {
            $before_widget = str_replace('>', 'class="'. $extra_class . '"', $before_widget);
        }
        // there is 'class' attribute - append width value to it
        else {
            $before_widget = str_replace('class="', 'class="'. $extra_class . ' ', $before_widget);
        }

        echo $before_widget;
        ?>
        <div class="heading">
        <?php echo $before_title . cshero_custom_title_widget($title) . $after_title; ?>
        </div>
        <?php if ($wp_query->have_posts()){ ?>
                <div class="cs-recent-post">
                    <ul class="news-list cs-popular">
                        <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>
							<li>
								<?php if (has_post_thumbnail()) : ?>
								<div class="cs-media">  
								   <div class="image">
									   <a class="post-featured-img" href="<?php the_permalink(); ?>">
										  <?php the_post_thumbnail('thumbnail'); ?>
									   </a>
									</div>	   
								 </div>
								<?php endif; ?> 
								<div class="cs-details">
									<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <?php if ($show_date) { ?>
									<div class="date">  
									<span><?php echo get_the_date('M jS'); ?></span> <span><?php echo get_the_date('Y'); ?></span>
									</div>
                                    <?php }?>
									<?php if ($show_decs) { ?>
										<div class="description"><?php echo cshero_string_limit_words( strip_tags( get_the_excerpt() ),10)."..."; ?></div>
									<?php  } ?>
								</div>
							</li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            <?php } else { ?>
                <span class="notfound">No post found!</span>
            <?php
            }
        echo $after_widget;
        wp_reset_postdata();
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = $new_instance['title'];
        $instance['show_date'] = $new_instance['show_date'];
        $instance['show_decs'] = $new_instance['show_decs'];
        $instance['number'] = (int) $new_instance['number'];
        $instance['extra_class'] = $new_instance['extra_class'];

        return $instance;
    }

    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $show_date = isset($instance['show_date']) ? esc_attr($instance['show_date']) : '';
        $show_decs = isset($instance['show_decs']) ? esc_attr($instance['show_decs']) : '';
        if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
                     $number = 5;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'woocommerce' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e( 'Show date:', 'wp_suarez' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('show_date') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_date') ); ?>" <?php if($show_date!='') echo 'checked="checked";' ?> type="checkbox" value="1"  />
        </p>
		<p>
            <label for="<?php echo $this->get_field_id('show_decs'); ?>"><?php _e( 'Show Description:', 'wp_suarez' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('show_decs') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_decs') ); ?>" <?php if($show_decs!='') echo 'checked="checked";' ?> type="checkbox" value="1" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of products to show:', 'woocommerce' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id('number') ); ?>" name="<?php echo esc_attr( $this->get_field_name('number') ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('extra_class'); ?>">Extra Class:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('extra_class'); ?>" name="<?php echo esc_attr($this->get_field_name('extra_class')); ?>" value="<?php if(isset($instance['extra_class'])){echo esc_attr($instance['extra_class']);} ?>" />
        </p>
        <?php
    }
}
?>