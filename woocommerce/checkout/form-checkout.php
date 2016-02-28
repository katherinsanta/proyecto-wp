<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}


//check if we need or not to show shipping tab at checkout 
if (get_option('woocommerce_enable_order_comments')=='no'){  // if order_comments are disabled we need to check if we have non virtual items in the cart

	//check if we have in cart other items beside virtual products 
	$only_virtual_prod = true;
	if (sizeof($WC->cart->cart_contents)>0) : 
		foreach ($WC->cart->cart_contents as $cart_item_key => $cart_item) : //iterate through cart items
	      
	        $cart_item  = get_product( $cart_item['product_id']);         // get the current product info

	    	if(!$cart_item -> is_virtual()){ 
	    		$only_virtual_prod = false; // as soon as we find a non virtual item, we set $only_virtual_prod to false and exit the loop
	    		break;
	    	}
	          
	    endforeach;
	endif; 

	if($only_virtual_prod){
		$show_shipping_tab = false;	
	}else{
		$show_shipping_tab = true;
	}
	
}else{ // if order_comments are enabled, then we automatically show shipping tab, because it contains order notes
	$show_shipping_tab = true;
}


// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>

<!-- custom view for checkout -->
<div class="checkout-control-wrapper">
	<ul>
		<li class="active">
			<div class="checkout-button checkout_billing">
				Billing
				<span class="icon-container">
					<i class="icon-billing"></i>
				</span>
			</div>
		</li>
		<?php if($show_shipping_tab){  //output this tab only if there are non virtual items, or if order comments are enabled   ?>
		<li>
			<div class="checkout-button checkout_shipping">
				Shipping
				<span class="icon-container">
					<i class="icon-shipping"></i>
				</span>
			</div>
		</li>
		<?php } ?>
		<li>
			<div class="checkout-button checkout_order_review">
				Your order
				<span class="icon-container">
					<i class="icon-cart"></i>
				</span>
			</div>
		</li>
	</ul>
</div>



<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">

	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

			<div class="checkout_billing checkout_tabber">

				<?php do_action( 'woocommerce_checkout_billing' ); ?>
				<div class="woo-delimiter"></div>
				<div class="checkout-continue button blue"><?php _e( 'Continue', 'woocommerce' ) ?></div>

			</div>

			<?php if($show_shipping_tab){  //output this tab only if there are non virtual items, or if order comments are enabled   ?>
				<div class="checkout_shipping checkout_tabber">

					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
					<div class="woo-delimiter"></div>
					<div class="checkout-continue button blue"><?php _e( 'Continue', 'woocommerce' ) ?></div>
				</div>
			<?php } ?>


		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>

	<div id="order_review" class="checkout_order_review checkout_tabber woocommerce-checkout-review-order">
		<h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>