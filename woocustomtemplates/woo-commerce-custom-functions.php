<?php

	/*overwrite the default sidebar for shop page with nothing, because in this theme, the sidebar can be added via template builder*/
	function woocommerce_get_sidebar(){
		
	}

	add_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

	//add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
	//add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

	/*function my_theme_wrapper_start() {
	
		if (is_single()) {

			global $current_template;

		    $section_bg_color = '';
		    $section_bg_image = '';
		    if( isset($current_template) && is_object($current_template) && isset($current_template -> _rows ) ){

		        foreach ($current_template -> _rows as $key => $value) {
		            if(isset($value['is_additional']) && $value['is_additional'] && isset($value['row_bg_color']) && strlen($value['row_bg_color'])){
		                $section_bg_color = ' background-color:'.$value['row_bg_color'].'; ';
		            }
		            if(isset($value['is_additional']) && $value['is_additional'] && isset($value['row_bg_image']) && strlen($value['row_bg_image'])){
		                $section_bg_image = ' background-color: url('.$value['row_bg_image'].'); ';
		            }
		        }
		    }
		}else{
			$section_bg_color = '';
			$section_bg_image = '';
		}
	 	echo '<section id="main" style="'.$section_bg_color . ' ' . $section_bg_image.'" >
    		    <div class="main-container">
			    	<div class="row"> 
			    		<div class="twelve columns">';
	}

	function my_theme_wrapper_end() {
		echo '			</div>
					</div>
				</div>
	  		</section>';
	}*/

	add_theme_support( 'woocommerce' );


	// Handle cart in header fragment for ajax add to cart
	add_filter('add_to_cart_fragments', 'woocommerceframework_header_add_to_cart_fragment');
	if (!function_exists('woocommerceframework_header_add_to_cart_fragment')) {
		function woocommerceframework_header_add_to_cart_fragment( $fragments ) {		
			global $woocommerce;		
			ob_start();
			?>
			
	        <!---->
	                    
	        <div class="gbtr_dynamic_shopping_bag">

	            <div class="gbtr_little_shopping_bag_wrapper">
	                <div class="gbtr_little_shopping_bag">
	                    <div class="overview"><a class="goto-cart" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><i class="icon-cart"></i></a><span class="minicart_items <?php if($woocommerce->cart->cart_contents_count == 0){ echo 'no-items'; } ?>"><?php echo sprintf(_n('<i>%d</i> item', '<i>%d</i> items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count); ?></span><?php echo $woocommerce->cart->get_cart_total(); ?> </div>
	                </div>
	                <div class="gbtr_minicart_wrapper">
	                	<h4><?php _e('My shopping basket', 'cosmotheme'); ?></h4>
	                    <div class="gbtr_minicart">
	                    <?php                                    
	                    echo '<ul class="cart_list">';                                        
	                        if (sizeof($woocommerce->cart->cart_contents)>0) : foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
	                        
	                            $_product = $cart_item['data'];                                            
	                            if ($_product->exists() && $cart_item['quantity']>0) :                                            
	                                echo '<li class="cart_list_product">';
	                                    echo '<a class="cart_list_product_img" href="'.get_permalink($cart_item['product_id']).'">' . $_product->get_image().'</a>';                                                    
	                                    echo '<div class="cart_list_product_title">';
	                                        //echo '<a href="'.get_permalink($cart_item['product_id']).'">' . $_product->get_categories( '', ''.__('', 'woocommerce').' ', '') . '</a>';
	                                        $gbtr_product_title = $_product->get_title();
	                                        $gbtr_short_product_title = (strlen($gbtr_product_title) > 28) ? substr($gbtr_product_title, 0, 25) . '...' : $gbtr_product_title;
	                                        echo '<a href="'.get_permalink($cart_item['product_id']).'">' . apply_filters('woocommerce_cart_widget_product_title', $gbtr_short_product_title, $_product) . '</a>';
	                                    echo '</div>';
	                                    echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'woocommerce') ), $cart_item_key );
	                                    echo '<div class="cart_list_product_quantity">'.$cart_item['quantity'].'</div>';
	                                    echo '<div class="cart_list_product_price">'.woocommerce_price($_product->get_price()).'</div>';
	                                    echo '<div class="clr"></div>';                                                
	                                echo '</li>';                                         
	                            endif;                                        
	                        endforeach;
	                        ?>
	                                
	                        <div class="minicart_total_checkout">                                        
	                            <div><?php _e('Cart subtotal', 'cosmotheme'); ?></div><span><?php echo $woocommerce->cart->get_cart_total(); ?></span>                                   
	                        </div>
	                        <div class="clr">
		                        <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="button gbtr_minicart_cart_but"><?php _e('View Cart', 'cosmotheme'); ?></a>   
		                        
		                        <a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="button gbtr_minicart_checkout_but"><?php _e('Checkout', 'cosmotheme'); ?></a>
	                        </div>
	                        <?php                                        
	                        else: echo '<li class="empty">'.__('No products in the cart.','cosmotheme').'</li>'; endif;                                    
	                    echo '</ul>';                                    
	                    ?>                                                                        

	                    </div>
	                </div>
	                
	            </div>
	            
	            <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="gbtr_little_shopping_bag_wrapper_mobiles"><span><?php echo $woocommerce->cart->cart_contents_count; ?></span></a>

	        </div>
	        
	        <!---->

			<?php		
			$fragments['.gbtr_dynamic_shopping_bag'] = ob_get_clean();		
			return $fragments;
		}
	}


	/**
	 * OVEWRITE THE DEFAULT BREADCRUMBS
	 * Output the WooCommerce Breadcrumb
	 *
	 * @access public
	 * @return void
	 */
	function woocommerce_breadcrumb( $args = array() ) {

		$defaults = apply_filters( 'woocommerce_breadcrumb_defaults', array(
			'delimiter'   => ' ',
			'wrap_before' => '<div class="breadcrumbs woo-breadcrumbs" ><ul>',
			'wrap_after'  => '</ul></div>',
			'before'      => '<li>',
			'after'       => '</li>',
			'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
		) );

		$args = wp_parse_args( $args, $defaults );

		woocommerce_get_template( 'shop/breadcrumb.php', $args );
	}

	/*overwrite defaul WooCommerce function, in this one we use bigger thumbnails*/
	function woocommerce_subcategory_thumbnail( $category ) {
		global $woocommerce;

		/*$size = 'tlist'; 
		$small_thumbnail_size  	= apply_filters( 'single_product_small_thumbnail_size', $size );*/
		$small_thumbnail_size  	= apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' );
		
		//$dimensions    			= $woocommerce->get_image_size( $small_thumbnail_size );
		$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

		if ( $thumbnail_id ) {
			$image = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size  );
			$image = $image[0];
		} else {
			$image = woocommerce_placeholder_img_src();
		}

		if ( $image )
			echo '<img src="' . $image . '" alt="' . $category->name . '" />';
	}


    function wishlist_btn( $product_id, $margin_elem_start = '', $margin_elem_end = '' ){ 
        if(options::logic( 'blog_post' , 'enb_wish_btn' )){
            if (isset($_COOKIE['cookie_products']) && $_COOKIE['cookie_products'] != '') {
                $cookies = explode(",", $_COOKIE['cookie_products']);
                foreach ($cookies as $index => $value){
                    $cookies[$index] = (int)$value; 
                }  
            } 
            if (options::get_value( 'blog_post' , 'wish_page' ) != 0) {
                $url = get_permalink(options::get_value( 'blog_post' , 'wish_page' ));
            }else{
                $url = 'javascript:void(0)';
            }
            echo $margin_elem_start;
        ?>  
            <div class="safe-for-later">
                <div class="ajax-loading-img"></div>
                <a onClick="add_to_wishlist('<?php echo $product_id; ?>');" class="save-product <?php echo 'product_'.$product_id; ?>" data-id=<?php echo $product_id; ?> <?php if(isset($cookies) && in_array($product_id, $cookies)) { echo 'style="display:none;"'; } ?> href="javascript:void(0);" title="<?php _e('click to add to wish list','cosmotheme') ?>"><?php _e('[ + ] Wishlist', 'cosmotheme'); ?></a>
                <span class="browse_wishlist" <?php if(!isset($cookies) || !in_array($product_id, $cookies)) { echo 'style="display:none;"'; } ?>> <a href="<?php echo $url; ?>" title="<?php _e('added to wish list','cosmotheme') ?>"><?php _e('[ &#10003; ] Added', 'cosmotheme'); ?></a></span>
            </div> 
    <?php 
            echo $margin_elem_end;
        }
    }
    

?>