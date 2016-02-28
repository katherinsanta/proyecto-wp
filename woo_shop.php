<?php
	/**
	 * woocommerce_before_main_content hook
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked woocommerce_breadcrumb - 20
	 */
	//do_action('woocommerce_before_main_content'); 
	global $that;

	//deb::e($that);
?>

<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

	<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

<?php endif; ?>

<?php do_action( 'woocommerce_archive_description' ); ?>

<?php if ( have_posts() ) : ?>

	<?php
		/**
		 * woocommerce_before_shop_loop hook
		 *
		 * @hooked woocommerce_result_count - 20
		 * @hooked woocommerce_catalog_ordering - 30
		 */
		do_action( 'woocommerce_before_shop_loop' );
	?>

	<?php woocommerce_product_loop_start(); ?>
<ul class="row">
		<?php woocommerce_product_subcategories(); ?>
</ul>
		<?php 
			$counter = 0; 
			$number_columns =  $that -> columns ;

			if($that -> view == 'list_view'){
				$view_class = "list-view";
			}else{
				$view_class = "grid-view";
			}

			$ul_id = mt_rand(1,9999);
			if($that -> view == 'list_view'){
    			$masonry = ' ' ;
    		}else{
    			
    			if($that -> enb_masonry == 'yes'){ 
    				$is_masonry = true; 
    				$masonry = ' masonry ' ;
    			}else{ 
    				$is_masonry = false; 
    				$masonry = ' ' ;
    			}
    		}
            echo '<div class="row' . $masonry . ' '.$view_class.' " id="ul-'.$ul_id.'">';
            if($that -> view == 'list_view'){ echo '<div class="twelve columns" id="div-'.$ul_id.'">'; }

            
		?>
		<?php while ( have_posts() ) : the_post(); ?>

			
			<?php 

				if(isset($that -> view)){
					if($that -> view == 'list_view'){
						
						$additional_hidden_class_for_load_more = 'element';
			            if($that -> list_view_excerpt == 'excerpt'){$show_full_content = false;}else{$show_full_content = true;}
			            if($that -> enb_hide_excerpt == 'yes'){$hide_excerpt = true;}else{$hide_excerpt = false;}
			            
			        	post::list_view_products($post, $additional_hidden_class_for_load_more,  $show_full_content, $hide_excerpt );
                		?>  <?php  
					}else{
						
						if( ($counter % $number_columns) == 0 ){
			                $additional_class = 'first-elem';
			            }else{
			            	$additional_class = '';
			            }

						post::grid_view( $post, $that -> columns_arabic_to_word( $that -> columns ) . ' columns', $additional_class, $show_excerpt = true, $show_meta = true, $element_type = 'article', $is_masonry = $is_masonry  );
					
					}
				}
						
				//	woocommerce_get_template_part( 'content', 'product' ); 

				$counter++;
			?>

		<?php endwhile; // end of the loop. 
				
			if($that -> view == 'list_view'){ echo '</div>'; }
			echo '</div>';
			//get_template_part( 'pagination' );
		
		?>

	<?php woocommerce_product_loop_end(); ?>

	<?php
		/**
		 * woocommerce_after_shop_loop hook
		 *
		 * @hooked woocommerce_pagination - 10
		 */
		do_action( 'woocommerce_after_shop_loop' );
	?>

<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

	<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>

<?php endif; ?>