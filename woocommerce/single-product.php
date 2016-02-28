<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	$post_format = get_post_format( $post -> ID );
    if(!strlen($post_format)){ $post_format = 'standard';}

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

get_header( 'shop' ); ?>
<section id="main" style="<?php echo $section_bg_color . ' ' . $section_bg_image; ?>" >
    
    <div class="main-container">
        <?php  if(options::logic( 'blog_post' , 'show_next_prev' ) && (is_single())){ ?>
        <nav class="hotkeys-meta">
            <span class="nav-previous"><?php previous_post_link( '%link' , __('', 'cosmotheme') ); ?></span>
            <span class="nav-next"><?php next_post_link( '%link' , __('', 'cosmotheme') ); ?></span>
        </nav>
        <?php } ?>
        <?php
            while( have_posts () ){ 
                the_post();
                $meta = meta::get_meta( $post -> ID, 'settings' );
                $meta_enb = options::logic( 'blog_post' , 'meta' );             
            } /*EOF while( have_posts () ) */
        ?>

		<?php	            
            $resizer = new LBPageResizer('product');            
            $resizer -> render_frontend();
        ?>
	
	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action('woocommerce_sidebar');
	?>
	</div>
</section>   
<?php get_footer(); ?>