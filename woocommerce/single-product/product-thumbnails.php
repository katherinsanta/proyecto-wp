<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();


if (has_post_thumbnail($post->ID)) {
	
	$the_thumbnail_id = get_post_thumbnail_id( $post->ID );
	$feat_img = array( $the_thumbnail_id ); 

	if( !in_array($the_thumbnail_id, $attachment_ids) ){
		$attachment_ids = array_merge($feat_img,$attachment_ids);	
	}

}



if ( $attachment_ids && count($attachment_ids) > 1 ) {
	?>
	
	<div id="carousel" class="flexslider product-thumb-carousel">
      
	    <div class="flex-viewport" style="overflow: hidden; position: relative;">
	    	<ul class="slides">
		<?php

		$loop = 0;
		$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array( 'zoom' );

			$image_link = wp_get_attachment_url( $attachment_id );

			if ( ! $image_link )
				continue;

			$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
			$image_class = esc_attr( implode( ' ', $classes ) );
			$image_title = esc_attr( get_the_title( $attachment_id ) );

			$img_elem = '<li >'.$image.'</li>';
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $img_elem , $attachment_id, $post->ID, $image_class );


			$loop++;
		}

	?>
			</ul>
		</div>
		
	</div>
	<?php
}