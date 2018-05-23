<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     20.4.7
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
		$wrap_class = (is_active_sidebar('woocommerce_sidebar'))?'col-lg-9 col-md-9 col-xs-12 col-sm-12':'col-lg-12 col-md-12 col-xs-12 col-sm-12';
	?>
	<div class="row">
		<?php if(is_active_sidebar('woocommerce_sidebar')):?>
		<div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
            <div id="secondary" class="widget-area" role="complementary">
                <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                        <?php
                        /**
                         * woocommerce_sidebar hook
                         *
                         * @hooked woocommerce_get_sidebar - 10
                         */
                        dynamic_sidebar('woocommerce_sidebar');
                        ?>
                </div>
            </div>
		</div>
		<?php endif;?>
		<div class="<?php echo $wrap_class?>">
		<?php if ( apply_filters( 'woocommerce_show_page_title', false ) ) : ?>
			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
		<?php endif; ?>

		<div class="woocommerce_archive_description clearfix">
			<?php do_action( 'woocommerce_archive_description' ); ?>
		</div>
		<?php if ( have_posts() ) : ?>
			<div class="woocommerce_before_shop_loop clearfix">
			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>
			</div>
			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>
		</div>
	</div>	
	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

<?php get_footer( 'shop' ); ?>