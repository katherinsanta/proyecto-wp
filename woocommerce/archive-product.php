<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $current_template;
get_header('shop'); ?>

	
<section id="main">
	<div class="main-container">
		<?php
        function do_nothing( $sender ){}
        
        if(is_front_page()){
        	$template_name = 'front_page';
        }else{
        	$template_name = 'woo_shop';
        }

        $layout = new LBSidebarResizer( $template_name );
        $layout -> render_frontend( 'do_nothing' );
    ?>
	</div>
</section>
	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		if (!is_shop()) {
			do_action('woocommerce_after_main_content');
		}
		
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action('woocommerce_sidebar');
	?>

<?php get_footer('shop'); ?>