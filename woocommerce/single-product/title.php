<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $post, $product;
                        
?>
<h1 itemprop="name" class="product_title entry-title"><?php the_title(); ?></h1>

<?php 

	//$product = get_product($post->ID);

	//Get rating
	$average = $product->get_average_rating();
	$count = $product->get_rating_count();
	if($count > 0){
	    echo '<div class="after_title_reviews woocommerce"><div class="star-rating" title="'.sprintf(__('Rated %s out of 5', 'woocommerce'), $average).'"><span style="width:'.($average*16).'px"><span itemprop="ratingValue" class="rating">'.$average.'</span> '.__('out of 5', 'woocommerce').'</span></div> <div itemprop="ratingCount" class="count">'.sprintf( _n('%s review', '%s reviews', $count, 'woocommerce'), $count ).'</div><div class="clr"></div></div>';
	}
?>