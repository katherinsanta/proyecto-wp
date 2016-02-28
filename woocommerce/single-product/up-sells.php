<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce, $woocommerce_loop, $post, $current_template;

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) return;

$meta_query = $woocommerce->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->id ),
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

$counter = 1; 

if (! $current_template-> layout_has_sidebars && sizeof( $upsells ) != 0){
	$classes = ' six columns ';
}else{
	$classes = ' three columns ';
}

if ( $products->have_posts() ) : ?>

	<div class="upsells products">

		<h2 class="woo-heading"><?php _e( 'You may also like&hellip;', 'woocommerce' ) ?></h2>

		<?php woocommerce_product_loop_start(); ?>
			<div class="row grid-view no-effect">
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php 

					if (! $current_template-> layout_has_sidebars && sizeof( $upsells ) != 0){
						$classes = ' three columns ';
						
						if( ($counter % 4) == 1 ){
					        $additional_class = 'first-elem';
					    }else{
					    	$additional_class = '';
					    }

					}else{
						$classes = ' four columns ';
						$additional_class = '';
					}

					post::grid_view( $post, $classes, $additional_class, $show_excerpt = true, $show_meta = true, $element_type = 'article', $is_masonry = false  );

					$counter++;
					//woocommerce_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>
			</div>
		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();
