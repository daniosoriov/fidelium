<div class="<?php echo $_col; ?> cs-categories-woo">
    <div class="cs-categories-woo-wrap">
        <div class="cs-categories-woo-image">
            <img alt="" src="<?php echo $image_resize; ?>">
            
            <div class="overlay" <?php echo $overlay_style;?>>
                <div class="overlay-content">
                    <a class="btn btn-white" href="<?php echo get_term_link($term->term_id, 'product_cat'); ?>" style="color: <?php echo $title_categories_color; ?>; "><?php echo __('Shop ','wp_suarez').$term->name; ?></a>
                </div>
            </div>
        </div>
        <<?php echo $title_categories_size; ?> class="cs-categories-woo-title">
            <a href="<?php echo get_term_link($term->term_id, 'product_cat'); ?>" style="color: <?php echo $title_categories_color; ?>; "><?php echo $term->name; ?></a>
        </<?php echo $title_categories_size; ?>>
        <?php if($number_items) : ?>
            <div class="cs-categories-woo-meta">
                <a href="<?php echo get_term_link($term->term_id, 'product_cat'); ?>"><?php if($number_items) echo $term->count.' items' ?></a>
            </div>
        <?php endif; ?>
    </div>
</div>
