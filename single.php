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

    global $current_template, $the_gallery_id;

    $section_bg_color = '';
    if( isset($current_template) && is_object($current_template) && isset($current_template -> _rows ) ){

        foreach ($current_template -> _rows as $key => $value) {
            if(isset($value['is_additional']) && $value['is_additional'] && isset($value['row_bg_color']) && strlen($value['row_bg_color'])){
                $section_bg_color = ' background-color:'.$value['row_bg_color'].'; ';
            }
        }
    }

?>
<section id="main" style="<?php echo $section_bg_color; ?>" class="<?php echo get_posts_gallery_type($the_gallery_id); ?>">
    <?php get_template_part('featured_image'); ?>
    
    <div class="main-container <?php if ( get_post_type($the_gallery_id) == 'gallery' && post_password_required($the_gallery_id) ){ echo 'protected-gallery'; } ?>">
        <?php  if(options::logic( 'blog_post' , 'show_next_prev' )){ ?>
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
            $resizer = new LBPageResizer('single');
            $resizer -> render_frontend();
        ?>
    </div>
</section>    
 
<?php get_footer(); ?>
