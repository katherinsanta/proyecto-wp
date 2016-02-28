<?php 
/**
* Check if WooCommerce is active
**/

if ( class_exists( 'WooCommerce' ) ) {
    global $woocommerce;

?>

<!---->

<div class="gbtr_dynamic_shopping_bag">

    <div class="gbtr_little_shopping_bag_wrapper">
        <div class="gbtr_little_shopping_bag">
            <div class="overview"><a class="goto-cart" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><i class="icon-cart"></i></a><span class="minicart_items <?php if($woocommerce->cart->cart_contents_count == 0){ echo 'no-items'; } ?> "><?php echo sprintf(_n('<i>%d</i> item', '<i>%d</i> items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count); ?></span><?php echo $woocommerce->cart->get_cart_total(); ?> </div>
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
                        
                <li class="minicart_total_checkout">                                        
                    <div><?php _e('Cart subtotal', 'cosmotheme'); ?></div><span><?php echo $woocommerce->cart->get_cart_total(); ?></span>                                   
                </li>
                <li class="clr">
                    <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="button gbtr_minicart_cart_but"><?php _e('View Cart', 'cosmotheme'); ?></a>   
                    
                    <a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="button gbtr_minicart_checkout_but"><?php _e('Checkout', 'cosmotheme'); ?></a>
                </li>
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

<?php } ?>