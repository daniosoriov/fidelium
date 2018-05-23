<?php
/**
 * @package cshero
 */
global $smof_data, $cs_span,$masonry_filter;
$class='cs-masonry-layout-item '.$cs_span.' text-center ';
if($masonry_filter){
	global $cs_cat_class;
	$class .= "category-".$cs_cat_class;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<div class="cs-portfolio-thumbnail">
		<?php if (has_post_thumbnail() && ! post_password_required() && ! is_attachment() && wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)) { ?>
			<?php //the_post_thumbnail('medium'); 
				$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
                $image_resize = mr_image_resize( $attachment_image[0], 570, 430, true, 'c', false );
                echo '<img alt="" class="" src="'. esc_url($image_resize)  .'"/>';
			?>
		<?php } else { 
			$no_image = get_template_directory_uri().'/assets/images/no-image.jpg';
    		$image_resize = mr_image_resize( $no_image, 570, 430, true,'c', false );
			?>
			<img alt="" src="<?php echo $image_resize; ;?>" />
		<?php } ?>
		<div class="overlay from-center">
			<div class="overlay-content">
				<?php /* if($portfolio_link) {?>
					<a class="portfolio-link" href="<?php echo $portfolio_link;?>" alt="" title=""><i class="fa fa-search"></i></a>
				<?php } else {?>
					<a class="portfolio-link" href="<?php the_permalink();?>" alt="" title=""><i class="fa fa-search"></i></a>
				<?php } */ ?>
				<div class="cs-portfolio-content-wrap">
					<header class="cs-portfolio-title">
						<?php echo cshero_title_render(); ?>
					</header>
					<content class="cs-portfolio-content">
						<?php echo cshero_getPortfolioCategory(); ?>
					</content>
				</div><!-- .entry-content -->
			</div>
		</div>
	</div><!-- .entry-thumbnail -->
</article><!-- #post-## -->

