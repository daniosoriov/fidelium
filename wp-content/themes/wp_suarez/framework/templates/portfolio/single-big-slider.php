<?php
	global $smof_data, $portfolio_category, $portfolio_layout, $portfolio_about_project, $portfolio_project_date, $portfolio_project_client, $link;
?>
<article id="cs_post_<?php the_ID(); ?>" <?php post_class('single-post format-gallery single-big-slider'); ?>>
		<div class="row">
			<div class="col-xs-12 col-sm-12 <?php if($smof_data['portfolio_show_date'] || $smof_data['portfolio_show_custom_field'] || $smof_data['portfolio_show_category']) echo 'col-md-8 col-lg-8'; else echo 'col-md-12 col-lg-12'; ?>">
				<div id="cs-portfolio-content" class="cs-portfolio-content">
					<div class="cs-portfolio-details">
						<?php echo cshero_title_render();?>
					</div>
				</div>
				<div class="cs-portfolio-sidebar">
					<?php if($smof_data['portfolio_show_share']) { ?>
					<div class="cs-portfolio-share">
					    <div class="social-details">
							<h6 class=""><?php _e('Share', 'wp_suarez'); ?></h6>
							<a
								href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"
								target="_blank"><i class="fa fa-facebook"></i></a> <a
								href="https://twitter.com/home?status=<?php the_permalink(); ?>"
								target="_blank"><i class="fa fa-twitter"></i></a> <a
								href="https://plus.google.com/share?url=<?php the_permalink(); ?>"
								target="_blank"><i class="fa fa-google-plus"></i></a> <a
								href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=&summary=&source="
								target="_blank"><i class="fa fa-linkedin"></i></a>
						</div>
					</div>
					<?php } ?>
					<?php if($smof_data['portfolio_show_subtitleription']) { ?>
					<div class="cs-portfolio-text">
					
						<h5 class="cs-portfolio-title-desc"><?php echo $smof_data['portfolio_about_title']; ?></h5>
						<?php the_content(); ?>
					
					</div>
					<?php } ?>
				</div>
			</div>
			<?php if($smof_data['portfolio_show_date'] || $smof_data['portfolio_show_custom_field'] || $smof_data['portfolio_show_category']){ ?>
			<div class="cs-portfolio-sidebar col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<div class="cs-portfolio-info">
					<?php if($smof_data['portfolio_show_date']){ echo '<div class="cs-portfolio-info-item"><h6><i class="'.$smof_data['portfolio_date_icon'].'"></i> '.$smof_data['portfolio_date_title'].'</h6>'.$portfolio_project_date.'</div>'; }?>

					<?php if($smof_data['portfolio_show_custom_field']){ echo '<div class="cs-portfolio-info-item"><h6><i class="'.$smof_data['portfolio_custom_field_icon'].'"></i> '.$smof_data['portfolio_custom_field_title'].'</h6>'.$portfolio_project_client.'</div>'; }?>
					
					<?php if($smof_data['portfolio_show_category']){ ?>
					<div class="cs-portfolio-info-item"><h6><?php _e('Category', 'wp_suarez'); ?></h6><?php the_terms( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?></div>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
		</div>
		<div class="">
			<?php  
	            get_template_part('framework/templates/portfolio/media');
	        ?>
	    </div>
</article>