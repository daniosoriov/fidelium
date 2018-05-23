<?php
/**
 * @package cshero
 */
global $smof_data;
$has_thumb = has_post_thumbnail() && ! post_password_required() && ! is_attachment() ;
if($has_thumb) $cls = 'col-xs-12 col-sm-9 col-md-9 col-lg-9'; else $cls = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('cs-blog'); ?>>
	<div class="row">
		<?php if ($has_thumb) : ?>
		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
			<div class="cs-blog-media">
				<div class="cs-blog-thumbnail">
					<?php the_post_thumbnail('medium'); ?>
				</div><!-- .entry-thumbnail -->
			</div>
		</div><!-- .entry-header -->
		<?php endif; ?>
		<div class="cs-blog-content <?php echo $cls;?>">
			<div class="cs-blog-meta cs-itemBlog-meta">
				<?php
					echo cshero_title_render();
					echo cshero_info_bar_render();
				?>
			</div>
			<?php cshero_content_render(); ?>
		</div><!-- .entry-content -->
		
	</div>
</article><!-- #post-## -->
