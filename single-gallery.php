<?php
get_header(); 

$post_layout = meta::get_meta( $post -> ID , 'layout' ); 
    
    $no_feat_class = '';
    if( !options::logic( 'blog_post' , 'enb_featured' ) || !has_post_thumbnail( $post -> ID ) ){
        $no_feat_class = ' no_feat ';
    }
global $post_id;
    $post_id = $post -> ID;
                    
    /*---------------------*/
    $post_format = get_post_format( $post -> ID );
    if(!strlen($post_format)){ $post_format = 'standard';}

    $post_meta = meta::get_meta( $post -> ID, 'settings' );

    if ( post_password_required() && wp_is_mobile() ){ 
        $mobile_protected_styles = 'height:auto !important;';
    }else{
        $mobile_protected_styles = '';
    }
    
?>
<div class="header-collapser icon-bottom animated"></div>
<section id="main" class="<?php echo get_posts_gallery_type($post -> ID); ?>">
    
    <div class="main-container <?php if ( post_password_required() ){ echo 'protected-gallery'; } ?>" style="<?php echo $mobile_protected_styles; ?>">  

        <?php get_template_part( 'single-gallery-content' );     ?>
    </div>
</section>    

<?php get_footer(); ?>
