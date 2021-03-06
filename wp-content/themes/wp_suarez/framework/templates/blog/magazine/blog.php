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
			<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
			<div class="cs-blog-media">
				<div class="cs-blog-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div><!-- .entry-thumbnail -->
			</div>
			<?php endif; ?>
			<div class="cs-blog-meta cs-itemBlog-meta">
				<?php
				echo cshero_info_bar_render('date');
				?>
			</div>
			<h6 style="display:none;">&nbsp;</h6><?php /* this element for fix validator warning */ ?>
		</header><!-- .entry-header -->
		<div class="cs-blog-content">
			<?php echo cshero_title_render();
			cshero_content_render();
			echo cshero_get_like_comment();
			?>
		</div><!-- .entry-content -->
	</div>
	<h6 style="display:none;">&nbsp;</h6><?php /* this element for fix validator warning */ ?>
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
