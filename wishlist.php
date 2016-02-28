<?php
/**
* Template Name: Wishlist
*
* @package WordPress
*/
 
 
 get_header(); 


 global $woocommerce, $product, $post;

?>


<section id="main">
    <div class="main-container woocommerce">    
        <div class="row">
        	<div class="twelve columns">
		        <?php 
		        	wc_print_notices();
		        ?>
				<h2 class="post-title"><?php _e('My wishlist', 'cosmotheme'); ?> </h2>
				<div class=" cart wishlist_table tabble-responsive vertical-align" >
					<div class="row table-header">
							<div class="column two product-thumbnail">&nbsp;</div>
							<div class="column three product-name"><span class="nobr"><?php _e('Product Name', 'cosmotheme'); ?></span></div>
							<div class="column two product-price"><span class="nobr"><?php _e('Unit Price', 'cosmotheme'); ?></span></div>
							<div class="column two stock-status"><span class="nobr"><?php _e('Stock Status', 'cosmotheme'); ?></span></div>
							<div class="column two product-actions"><span class="nobr"><?php _e('Actions', 'cosmotheme'); ?></span></div>
							<div class="column one product-remove">&nbsp;</div>
					</div>
					<div class="table-content">
						<?php
						//global $wp_query;
						if (isset($_COOKIE['cookie_products']) && $_COOKIE['cookie_products'] != '') {
							$cookies = explode(",", $_COOKIE['cookie_products']);
							foreach ($cookies as $index => $value){
								$cookies[$index] = (int)$value; 
							}					    

						$wp_query = new WP_Query(array('post_status' => 'any', 'post_type' => 'product', 'post__in' => $cookies ));

						if ( $wp_query->have_posts()) {
							while ( $wp_query->have_posts() ) :
								$wp_query->the_post();
								$product = get_product($post->ID);

								$product_info = $product->post;	
 
                        		$img_url = wp_get_attachment_url( get_post_thumbnail_id( $post -> ID )  ,'full'); //get img URL
                        		$img_src = aq_resize( $img_url, 720, 720, true, false); //crop img
							//	deb::e($img_src);
									?>
									<div id="rowid_<?php echo $product_info -> ID; ?>" class="row">
										<div class="product-thumbnail column two">
											<a href="<?php echo esc_url( get_permalink(apply_filters('woocommerce_in_cart_product', $product->ID)) ); ?>">
											<img src="<?php echo $img_src[0] ?>" >
											<?php 
									//			echo $product->get_image();
											?>
											</a>
										</div>
										<div class="product-name column three">
											<span class="nobr only-mobile"><?php _e('Product Name', 'cosmotheme'); ?>:</span>
											<a href="<?php echo esc_url( get_permalink(apply_filters('woocommerce_in_cart_product', $product->ID)) ); ?>"><?php echo $product_info -> post_title; ?></a>
										</div>
										<div class="product-price column two ">
											<span class="nobr only-mobile"><?php _e('Unit Price', 'cosmotheme'); ?>:</span>
				                                <?php
												
												if (get_option('woocommerce_display_cart_prices_excluding_tax')==true) :
													$price = apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $proproducdivuct_obj->get_price_excluding_tax() ), $product, '' ); 
												else :
													$price = apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $product->get_price() ), $product, '' ); 
												endif;

										        if($price){
													echo $price; 
												}
											?>
										</div>
										<div class="stock-status column two ">
											<span class="nobr only-mobile"><?php _e('Stock Status', 'cosmotheme'); ?>:</span>
											<?php
											$availability = $product->get_availability();
											$stock_status = $availability['class'];
											
											if($stock_status == 'out-of-stock' ) {
												$stock_status="Out";
												_e('Out Of Stock', 'cosmotheme');
											} else {
												$stock_status="In";
													_e('In Stock', 'cosmotheme');
											}
											
											?>
										</div>
										<div class="product-actions column two ">	
											<span class="nobr only-mobile"><?php _e('Actions', 'cosmotheme'); ?>:</span>
											<?php get_template_part('/woocommerce/loop/add-to-cart'); ?>
											<div class="product-remove only-mobile">
												<div class="ajax-loading-img"></div>
												<a href="javascript:void(0)" onClick="remove_from_wishlist('<?php echo $product_info -> ID; ?>');" class="remove product_<?php echo $product_info -> ID; ?>" title="<?php _e('Remove this item', 'cosmotheme'); ?>">&times;</a>
											</div>

										</div>
										<div class="product-remove column one">
											<div class="ajax-loading-img"></div>
											<a href="javascript:void(0)" onClick="remove_from_wishlist('<?php echo $product_info -> ID; ?>');" class="remove product_<?php echo $product_info -> ID; ?>" title="<?php _e('Remove this item', 'cosmotheme'); ?>">&times;</a>
										</div>
									</div>
				   						
					  		<?php endwhile; ?>
					  	<?php } else { 
							  		if (get_page_by_title( 'shop' )) {
					                    $shop_page = get_page_by_title( 'shop' );
					                    $url = __('Browse the ', 'cosmotheme') .'<a href="'. get_permalink( $shop_page -> ID) .'">'. __('shop page', 'cosmotheme').'</a>'; 
					                }else{
					                    $url = '';
					                }
					  		?>
								<div class="row twelve">
									<div class="columns twelve"><center><?php _e('No products were added to wish list. ' , 'cosmotheme'); echo $url; ?></center></div>
								</div>	
					  	<?php } 
					  	} else { 						
						  		if (get_page_by_title( 'shop' )) {
				                    $shop_page = get_page_by_title( 'shop' );
				                    $url = __('Browse the ', 'cosmotheme') .'<a href="'. get_permalink( $shop_page -> ID) .'">'. __('shop page', 'cosmotheme').'</a>'; 
				                }else{
				                    $url = '';
				                }
						?>
								<div>
									<div colspan="6"><center><?php _e('No products were added to wish list. ' , 'cosmotheme'); echo $url; ?></center></div>
								</div>						  	
					  	<?php } ?>
					</div>
				</div>
			</div>
		</div>
    </div>
</section>  

<?php get_footer(); ?>