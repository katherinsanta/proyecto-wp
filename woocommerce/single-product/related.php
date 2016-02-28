<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $post, $current_template;

$related = $product->get_related();

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> $posts_per_page,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related,
	'post__not_in'			=> array($product->id)
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

$counter = 1; 

if ( $products->have_posts() ) : ?>

	<div class="related products">

		<h2 class="woo-heading"><?php _e( 'Related Products', 'woocommerce' ); ?></h2>

		<?php woocommerce_product_loop_start(); ?>
			<div class="row grid-view no-effect">
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php 

					if (isset($current_template) && ! $current_template-> layout_has_sidebars && sizeof( $related ) != 0){
						$classes = ' three columns ';
						
						if( ($counter % 4) == 1 ){
					        $additional_class = 'first-elem clear';
					    }else{
					    	$additional_class = '';
					    }

					}else{
						$classes = ' four columns ';
						$additional_class = '';
					}
					post::grid_view( $post, $classes, $additional_class, $show_excerpt = true, $show_meta = true, $element_type = 'article', $is_masonry = false  );

					//woocommerce_get_template_part( 'content', 'product' ); 
					$counter++;

				?>

			<?php endwhile; // end of the loop. ?>
			</div>
		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();
