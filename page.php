<?php
get_header(); 

    $no_feat_class = '';
    if( !options::logic( 'blog_post' , 'enb_featured' ) || !has_post_thumbnail( $post -> ID ) ){
        $no_feat_class = ' no_feat ';
    }

    $post_id = $post -> ID;
                    
      
    /*---------------------*/
    $post_format = get_post_format( $post -> ID );
    if(!strlen($post_format)){ $post_format = 'standard';}
    global $the_gallery_id;
?>

<section id="main" class="<?php echo get_posts_gallery_type($the_gallery_id); ?>">
<?php get_template_part('featured_image'); ?>
    <div class="main-container <?php if ( get_post_type($the_gallery_id) == 'gallery' && post_password_required($the_gallery_id) ){ echo 'protected-gallery'; } ?> <?php echo $gallery_container_class; ?>">    
        <?php

            if(isset($is_gallery_used) && true == $is_gallery_used){
                function do_nothing( $sender ){}
                $layout = new LBSidebarResizer( 'front_page' );
                $layout -> render_frontend( 'do_nothing' );
            }else{
                while( have_posts () ){ 
                    the_post();
                    $meta = meta::get_meta( $post -> ID, 'settings' );
                    $meta_enb = options::logic( 'blog_post' , 'meta' );             
                } /*EOF while( have_posts () ) */   
                
                $resizer = new LBPageResizer('page');
            $resizer -> render_frontend(); 
            }
            
        ?>
        
    </div>
</section>    
 
<?php get_footer(); ?>
