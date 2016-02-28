<?php
/**
 * Cross-sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $post, $current_template;

$crosssells = WC()->cart->get_cross_sells();

if ( sizeof( $crosssells ) == 0 ) return;

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', $posts_per_page ),
	'orderby'             => $orderby,
	'post__in'            => $crosssells,
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$counter = 1; 

$woocommerce_loop['columns'] = apply_filters( 'woocommerce_cross_sells_columns', $columns );

if ( $products->have_posts() ) : ?>

	<div class="cross-sells">

		<h2><?php _e( 'You may be interested in&hellip;', 'woocommerce' ) ?></h2>

		<?php woocommerce_product_loop_start(); ?>


		<div class="row grid-view no-effect">

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php 

					if (! $current_template-> layout_has_sidebars){
						$classes = ' cart_totals  ';
						
						if( ($counter % 6) == 1 ){
					        $additional_class = 'first-elem';
					    }else{
					    	$additional_class = '';
					    }

					}else{
						$classes = 'three columns ';
						$additional_class = '';
					}

					post::grid_view( $post, $classes, $additional_class, $show_excerpt = true, $show_meta = true, $element_type = 'article', $is_masonry = false, $is_carousel = false, $is_cross_sells = true );

					$counter++;
					//woocommerce_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		</div>

		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_query();