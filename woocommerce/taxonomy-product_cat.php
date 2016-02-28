<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template.
 *
 * Override this template by copying it to yourtheme/woocommerce/taxonomy-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//woocommerce_get_template( 'archive-product.php' );

?>

<?php get_header(); ?>


<?php
    $template = 'product_category';
?>

<section id="main">
    
    <div class="main-container">
       
        <?php
            $layout = new LBSidebarResizer( 'product_category' );
            $layout -> render_frontend();
        ?>
    </div>
</section>
<?php get_footer(); ?>
