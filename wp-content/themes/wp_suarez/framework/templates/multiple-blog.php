<?php
/*
 * Title
 */
function cshero_title_render(){
	global $smof_data;
	$post_style = !empty($smof_data['post_style']) ? $smof_data['post_style'] : '';
    $title_heading = isset($smof_data['blog_title_heading'])?$smof_data['blog_title_heading']:'h3';
	$show_post_title = '1';
	if(is_single()){
		$show_post_title = isset($smof_data['show_post_title'])?$smof_data['show_post_title']:'1';
	} else {
		$show_post_title = (isset($smof_data['archive_posts_title']))?$smof_data['archive_posts_title']:'1';
	}
	if($show_post_title == '1'){
		ob_start();
		?>
		<div class="cs-blog-title">
			<<?php echo esc_attr($title_heading);?> class="cs-blog-title-inner">
			    <?php if(is_sticky()){ echo "<i class='fa fa-thumb-tack'></i>"; } ?>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</<?php echo esc_attr($title_heading);?>>
		</div>
		<?php
		return  ob_get_clean();
		 
	}
}
/*
 * Info Bar
 */
function cshero_getCategories(){
    global $smof_data, $post;
    $post_type = get_post_type();
    $taxonomies = 'category';
    $arrTaxonomies = get_object_taxonomies(array('post_type' => $post_type), 'objects');
    foreach($arrTaxonomies as $key=>$objTax){
        if(is_taxonomy_hierarchical($objTax->name)){
            $taxonomies = $objTax->name;
            break;
        }
    }
    $categories = get_the_terms(0, $taxonomies);
    $separator = ', ';
    if(!empty($categories)):
        $k=0;
        foreach($categories as  $category) {
            if(is_object($category)){
                if($k>0){
                    echo $separator;
                }
                $k++;
                return '<a href="'.get_term_link( $category->term_id, $taxonomies ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'wp_suarez'), $category->name ) ) . '">'.$category->name.'</a>';
            }
        }
    endif;
}
function cshero_infobar_style2(){
    global $smof_data, $post;
    $post_type = get_post_type();
    $taxonomies = 'category';
    $archive_date = get_the_date($smof_data['archive_date_format']);
    $arrTaxonomies = get_object_taxonomies(array('post_type' => $post_type), 'objects');
    foreach($arrTaxonomies as $key=>$objTax){
        if(is_taxonomy_hierarchical($objTax->name)){
            $taxonomies = $objTax->name;
            break;
        }
    }
    ob_start();
    ?>
    <span class="cshero-info-bar">
        <?php echo __('By ','wp_suarez');
        the_author_posts_link();
        echo __(' in ','wp_suarez');
        $categories = get_the_terms(0, $taxonomies);
        $separator = ', ';
        $output = '';
        if(!empty($categories)):
            foreach($categories as $category) {
                if(is_object($category)){
                   $output .= '<a href="'.get_term_link( $category->term_id, $taxonomies ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'wp_suarez'), $category->name ) ) . '">'.$category->name.'</a>'.$separator;
                }
            }
        endif;
        echo trim($output, $separator);
        echo __(' Posted ','wp_suarez');
        ?>
        <a href="<?php echo get_day_link(get_the_time('Y'),get_the_time('m'),get_the_time('d')); ?>" title="<?php echo __( "View all posts date ",'wp_suarez').$archive_date; ?>"><?php echo esc_attr($archive_date); ?></a>
    </span>
    <?php
    return ob_get_clean();
}
function cshero_get_like_comment(){
    global $smof_data, $post;
    ob_start();
    ?>
    
    <?php if($smof_data['detail_detail']): ?>
    <?php if($smof_data['detail_like'] || $smof_data['detail_comments']): ?>
    <ul class="cshero-info-like">
        <?php if($smof_data['detail_like']): ?><li class="cs-blog-favorite"><?php if(function_exists('post_favorite')){ post_favorite();} ?></li><?php endif; ?>
        <?php if($smof_data['detail_comments']): ?><li class="cs-blog-comments"><a href="<?php echo get_comments_link(get_the_ID());?>"><span class="share-box"><i class="fa fa-comment"></i><?php comments_number(__('0','wp_suarez'),__('1','wp_suarez'),__('%','wp_suarez'));?></span></a></li><?php endif; ?>
    </ul>
    <?php endif; ?>
    <?php endif; ?>
    <?php
    return ob_get_clean();
}
function cshero_info_bar_render() {
    global $smof_data, $post;
    $author_id=$post->post_author;
    $vars = func_get_args();
    //$cs_date='date',$cs_author='author',$cs_categories='categories',$cs_tag='tags',$cs_comment='comment',$cs_like='like',$cs_social='social'
    if(count($vars) == 0){
        $vars = array('date','author','categories','tags','comment','like','social','link');
    }
    $post_type = get_post_type();

    $taxonomies = 'category';
    $arrTaxonomies = get_object_taxonomies(array('post_type' => $post_type), 'objects');
    foreach($arrTaxonomies as $key=>$objTax){
        if(is_taxonomy_hierarchical($objTax->name)){
            $taxonomies = $objTax->name;
            break;
        }
    }
    if( !empty($smof_data['detail_detail']) && $smof_data['detail_detail'] == '1'){
        ob_start();
        ?>
        <div class="cs-blog-info">
            <ul class="unliststyle">
                <?php if($smof_data['detail_author'] == '1' and in_array('author',$vars)): ?>
                    <li class="cs-blog-author">
                        <?php printf('By <a href="%1$s">%2$s</a>',esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ), get_the_author_meta( 'display_name', $author_id )); ?>
                    </li>
                <?php endif; ?>

                <?php
                if($smof_data['detail_category'] == '1' and in_array('categories',$vars)):
                    $categories = get_the_terms(0, $taxonomies);
                    $separator = ', ';
                    $output = ''; ?>
                    <?php if(!empty($categories)): ?>
                    <li class="cs-blog-cats">
                        <?php
                            echo 'In ';
                            foreach($categories as $category) {
                                if(is_object($category)){
                                   $output .= '<a href="'.get_term_link( $category->term_id, $taxonomies ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'wp_suarez'), $category->name ) ) . '">'.$category->name.'</a>'.$separator;
                                }
                            }
                            echo trim($output, $separator);
                        ?>
                    </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php
                if($smof_data['detail_date'] == '1' and in_array('date',$vars)):
                    $archive_date = get_the_date($smof_data['archive_date_format']);?>
                    <li class="cs-blog-date">
                        <?php _e('Posted', 'wp_suarez'); ?> <a href="<?php echo get_day_link(get_the_time('Y'),get_the_time('m'),get_the_time('d')); ?>" title="<?php echo __( "View all posts date ",'wp_suarez').$archive_date; ?>"><?php echo esc_attr($archive_date); ?></a>
                    </li>
                <?php endif; ?>
                <?php if($smof_data['detail_tags'] && in_array('tags',$vars)):
                   $tags = get_the_tags($post->ID);
                   $separator = ', ';
                   $output = '';?>
                   <?php if(!empty($tags)): ?>
                   <li class="cs-blog-tags"><i class="fa fa-tags"></i>
                   <?php
                   foreach($tags as $tag) {
                       if(is_object($tag)){
                           $output .= '<a href="'.get_tag_link( $tag->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in tag %s",'wp_suarez'), $tag->name ) ) . '">'.$tag->name.'</a>'.$separator;
                       }
                   }
                   echo trim($output, $separator);
                   ?>
                   </li>
                   <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
        <?php
        return  ob_get_clean();
        
    }
}

function cshero_info_bar_blog_render() {
    global $smof_data, $post;
    $author_id=$post->post_author;
    $vars = func_get_args();
    //$cs_date='date',$cs_author='author',$cs_categories='categories',$cs_tag='tags',$cs_comment='comment',$cs_like='like',$cs_social='social'
    if(count($vars) == 0){
        $vars = array('date','author','categories','tags','comment','like','social','link');
    }
    $post_type = get_post_type();

    $taxonomies = 'category';
    $arrTaxonomies = get_object_taxonomies(array('post_type' => $post_type), 'objects');
    foreach($arrTaxonomies as $key=>$objTax){
        if(is_taxonomy_hierarchical($objTax->name)){
            $taxonomies = $objTax->name;
            break;
        }
    }
    if($smof_data['detail_detail'] == '1'){
        ob_start();
        ?>
        <div class="">
            <ul class="list-unstyled list-inline">
                <?php if($smof_data['detail_author'] == '1' and in_array('author',$vars)): ?>
                    <li class="author">
                        <?php printf('By <a href="%1$s">%2$s</a>',esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ), get_the_author_meta( 'display_name', $author_id )); ?>
                    </li>
                <?php endif; ?>
                <?php
                if($smof_data['detail_date'] == '1' and in_array('date',$vars)):
                    $archive_date = get_the_date('d M Y');?>
                    <li class="date">
                        <a href="<?php echo get_day_link(get_the_time('Y'),get_the_time('m'),get_the_time('d')); ?>" title="<?php echo __( "View all posts date ",'wp_suarez').$archive_date; ?>"><?php echo esc_attr($archive_date); ?></a>,
                    </li>
                <?php endif; ?>
                <?php
                if($smof_data['detail_category'] == '1' and in_array('categories',$vars)):
                    $categories = get_the_terms(0, $taxonomies);
                    $separator = ', ';
                    $output = ''; ?>
                    <?php if(!empty($categories)): ?>
                    <li class="cats">
                        <?php
                            echo 'in ';
                            foreach($categories as $category) {
                                if(is_object($category)){
                                   $output .= '<a href="'.get_term_link( $category->term_id, $taxonomies ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'wp_suarez'), $category->name ) ) . '">'.$category->name.'</a>'.$separator;
                                }
                            }
                            echo trim($output, $separator);
                        ?>
                    </li>
                    <?php endif; ?>
                <?php endif; ?>              
            </ul>
        </div>
        <?php
        return  ob_get_clean();
         
    }
}
/*
 * Meta in footer
 */
function cshero_info_footer_render() {
    global $smof_data, $post;
    $vars = func_get_args();
    if(count($vars)==0){
        $vars = array('date','author','categories','tags','comment','like','social','link');
    }
    if( !empty($smof_data['detail_detail']) && $smof_data['detail_detail'] == '1') {
        ob_start();
    ?>
        <ul>
            <?php if($smof_data['detail_like'] == '1' && in_array('like',$vars) and function_exists('post_favorite')): ?>
            <li class="cs-blog-favorite"><?php post_favorite(); ?></li>
            <?php endif; ?>

            <?php if ( $smof_data['detail_comments'] == '1' && in_array('comment',$vars) ): ?>
                <li class="cs-blog-comments">
                    <i class="fa fa-comments"></i>
                    <a href="<?php echo get_the_permalink(); ?>" title="<?php _e('View all Comments', 'wp_suarez'); ?>"><?php comments_number(__('0','wp_suarez'),__('1','wp_suarez'),__('%','wp_suarez')); ?></a>
                </li>
            <?php endif; ?>

            <?php if($smof_data['detail_tags'] && in_array('tags',$vars)):
               $tags = get_the_tags($post->ID);
               $separator = ', ';
               $output = '';?>
               <?php if(!empty($tags)): ?>
               <li class="cs-blog-tags"><i class="fa fa-tags"></i>
               <?php
               foreach($tags as $tag) {
                   if(is_object($tag)){
                       $output .= '<a href="'.get_tag_link( $tag->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in tag %s",'wp_suarez'), $tag->name ) ) . '">'.$tag->name.'</a>'.$separator;
                   }
               }
               echo trim($output, $separator);
               ?>
               </li>
               <?php endif; ?>
            <?php endif; ?>

            <?php if($smof_data['detail_social'] == '1' and in_array('social',$vars) and function_exists('cs_socials_share')): ?>
            <li class="cs-blog-social">
                <?php //cshero_social_sharing_render('',true,false); ?>
                <div class="social-share">
                    <?php
                        $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
                        $img = esc_attr($attachment_image[0]);
                        $title = get_the_title();
                        echo cs_socials_share(get_the_permalink(),$img, $title);
                    ?>
                </div>
            </li>
            <?php endif; ?>

            <?php if(get_post_format() == 'link' && get_post_meta($post->ID, 'cs_post_link', true) and in_array('link',$vars) ): ?>
            <li class="cs-blog-link">
                <a href="<?php echo get_post_meta(get_the_ID(), 'cs_post_link', true); ?>"><?php if(get_post_meta(get_the_ID(), 'cs_post_link_text', true)){ echo get_post_meta(get_the_ID(), 'cs_post_link_text', true);} else { echo get_post_meta(get_the_ID(), 'cs_post_link', true); } ?></a>
            </li>
            <?php endif; ?>
        </ul>        
    <?php
        return ob_get_clean();
    }
}

function cshero_content_render($readmore = true){
    global $smof_data;
    $content_type = cshero_posts_full_content();
    if($content_type == '1'){
        if(get_the_excerpt() !=''){
           echo '<div class="cs-blog-introtext cleafix">'.cshero_string_limit_words(strip_tags(strip_shortcodes(get_the_excerpt())), $smof_data['introtext_length']).'</div>';
           if($readmore){
                echo cshero_read_more_render();
            }
        } else{
            echo '<div class="cs-blog-introtext cleafix">'.cshero_string_limit_words(strip_tags(strip_shortcodes(get_the_excerpt())), $smof_data['introtext_length']).'</div>';
            if($readmore){
                echo cshero_read_more_render();
            }
        }
    } elseif ($content_type == '2'){
        echo cshero_string_limit_words(strip_tags(strip_shortcodes(get_the_excerpt())), $smof_data['introtext_length']);
    } else {
        the_content();
        wp_link_pages( array(
        'before'      => '<div class="pagination loop-pagination"><span class="page-links-title">' . __( 'Pages:','wp_suarez') . '</span>',
        'after'       => '</div>',
        'link_before' => '<span class="page-numbers">',
        'link_after'  => '</span>',
        ) );
    }
}
/*
 * Read More
 */
 function cshero_read_more_render(){
	ob_start();
	?>
	<div class="readmore"><a href="<?php echo esc_url( get_permalink()); ?>" class="btn btn-default"><?php echo __('READ MORE','wp_suarez'); ?></a></div>
	<?php
	return  ob_get_clean();
}

/* Portfolio Category */
function cshero_getPortfolioCategory() {
    global $smof_data, $post;
    $author_id=$post->post_author;
    $vars = func_get_args();
    //$cs_date='date',$cs_author='author',$cs_categories='categories',$cs_tag='tags',$cs_comment='comment',$cs_like='like',$cs_social='social'
    if(count($vars) == 0){
        $vars = array('date','author','categories','tags','comment','like','social','link');
    }
    $post_type = get_post_type();

    $taxonomies = 'category';
    $arrTaxonomies = get_object_taxonomies(array('post_type' => $post_type), 'objects');
    foreach($arrTaxonomies as $key=>$objTax){
        if(is_taxonomy_hierarchical($objTax->name)){
            $taxonomies = $objTax->name;
            break;
        }
    }
        ob_start();
        ?>
        
            <?php
            
            $categories = get_the_terms(0, $taxonomies);
            $separator = ', ';
            $output = ''; ?>
            <?php if(!empty($categories)): ?>
                <div class="portfolio-categories">
                <?php //echo _e('in ','wp_suarez'); ?>
                <?php
                    foreach($categories as $category) {
                        if(is_object($category)){
                           $output .= '<a href="'.get_term_link( $category->term_id, $taxonomies ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'wp_suarez'), $category->name ) ) . '">'.$category->name.'</a>'.$separator;
                        }
                    }
                    echo trim($output, $separator);
                ?>
                </div>
            <?php endif; ?>
        <?php
        return  ob_get_clean();
         
}