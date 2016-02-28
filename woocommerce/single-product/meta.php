<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>
<?php
	if (is_single() && get_post_type( $post -> id ) == 'product') {
		echo '<div class="meta-delimiter"></div>';
	}
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( $product->is_type( array( 'simple', 'variable' ) ) && get_option( 'woocommerce_enable_sku' ) == 'yes' && $product->get_sku() ) : ?>
		<span itemprop="productID" class="sku_wrapper"><span class="label"><?php _e( 'SKU:', 'woocommerce' ); ?></span> <span class="sku"><?php echo $product->get_sku(); ?></span></span>
	<?php endif; ?>

	<?php
		$size = sizeof( get_the_terms( $product->ID, 'product_cat' ) );
		echo $product->get_categories( ', ', '<span class="posted_in">' . '<span class="label">' . _n( 'Category:', 'Categories:', $size, 'woocommerce' ). '</span><span class="meta-c">' . ' ', '</span></span>' );
	?>

	<?php
		$size = sizeof( get_the_terms( $product->ID, 'product_tag' ) );
		echo $product->get_tags( ', ', '<span class="tagged_as">' . '<span class="label">' . _n( 'Tag:', 'Tags:', $size, 'woocommerce' ) . '</span><span class="meta-c">' . ' ', '</span></span>' );
	?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>