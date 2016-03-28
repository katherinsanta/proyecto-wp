<?php
$zoom = false; 

if( options::logic( 'blog_post' , 'enb_featured' ) ){
    if ( has_post_thumbnail( $post -> ID ) && get_post_format( $post -> ID ) != 'video' ) {
        $src        = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , 'full' );
        $src_       = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , 'full' );
        $caption    = image::caption( $post -> ID );
        $zoom       = true;
    }
}

if( get_post_format($post->ID)=="gallery" ){
    /* for gallery posts we will show a slidedhow if there are more than 1 images  */
    $size = 'gallery_format_slider'; 
    ob_start();
    ob_clean();
    post::get_post_img_slideshow( $post -> ID, $size );
    $single_slideshow = ob_get_clean();
}

                        

if (options::logic( 'blog_post' , 'enb_cropp_img' )) {
    $cropp_img_class = ' cropped-img ';
}else{
    $cropp_img_class = ' resized-img ';
}    
if( (options::logic( 'blog_post' , 'enb_featured' ) && ( has_post_thumbnail( $post -> ID ) ) ) || (get_post_format($post->ID)=="gallery" && isset($single_slideshow) && strlen($single_slideshow) ) ){
    if (get_post_type() == 'page' || ( (get_post_type() == 'post' || get_post_type() == 'gallery') && meta::logic( $post , 'settings' , 'featured' ) || !sizeof(meta::get_meta( $post -> ID , 'settings' )) )) {

?>
<?php 

if (get_post_format($post->ID)=="gallery" && isset($single_slideshow) && strlen($single_slideshow) ) { 
    $height_slider = options::get_value( 'imagesizes' , 'gallery_format_slider_height');
    ?>

    <style>
    .single-format-gallery .frame{
        height: <?php echo $height_slider + 10; ?>px;
    }

    .single-format-gallery #main >.featimg {
        max-height: <?php echo $height_slider + 10; ?>px;

    }
    </style>
<?php }

    if (!options::logic( 'blog_post' , 'enb_cropp_img' )) { 
        /*if resized image is used we want to have this row to make the width of the image the same size as set in the theme option*/
?>
<div class="row element">
<?php } ?>
<?php if ( !post_password_required() ) { ?>
    <div class="featimg <?php echo $cropp_img_class. ' '; if(get_post_format( $post -> ID ) == 'video'){ echo 'video-post'; } ?>">
        <?php 
        if (options::logic( 'blog_post' , 'enb_featmask' ) && options::logic( 'blog_post' , 'enb_cropp_img' ) && get_post_format( $post -> ID ) != 'gallery' && get_post_type() != 'page' ) { 
            wp_localize_script('functions', 'featmask_enb', array(true) );
            ?>
        <?php } else {
            wp_localize_script('functions', 'featmask_enb', array(true) );

}
         ?>
        <?php if(get_post_format( $post -> ID ) != 'video' && get_post_format( $post -> ID ) != 'gallery') echo '<div class="featbg '.$cropp_img_class.' ">'; ?>
                <?php $caption = get_post(get_post_thumbnail_id($post -> ID))->post_excerpt; ?>

                <?php if ( ( has_post_thumbnail( $post -> ID ) || get_post_format($post->ID)=="gallery" ) && get_post_format( $post -> ID ) != 'video' ) {
                        $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , 'full' );
                        
                        $img_url = wp_get_attachment_url( get_post_thumbnail_id( $post -> ID )  ,'full'); //get img URL

                        if (options::logic( 'blog_post' , 'enb_cropp_img' )) {
                            $featimg_src = aq_resize( $img_url, get_aqua_size('single_cropped'), get_aqua_size('single_cropped', 'height'), true ); //crop img
                        }else{
                            $featimg_src = aq_resize( $img_url, get_aqua_size('single_resized'), get_aqua_size('single_resized', 'height'), false ); //resize img
                        }
                        
                        
                       

                        $size = 'gallery_format_slider'; 


                        if(isset($single_slideshow) && strlen($single_slideshow)){
                            echo $single_slideshow;
                        }else{ /*we show featured image only when */
                ?>          
                        

                                <?php
                                    echo '<img src="' . $featimg_src . '" alt="' . $caption . '" />';
                                ?>

                                <?php if($zoom && options::logic( 'blog_post' , 'enb_lightbox' )){ ?>
                                    <div class="zoom-image">
                                        <a href="<?php echo $src_[0]; ?>" data-rel="prettyPhoto-<?php echo $post -> ID; ?>" title="<?php echo  $caption;  ?>">&nbsp;</a>
                                    </div>
                                <?php } ?>    

                                <div class="format">&nbsp;</div>
                                <?php if (options::logic('styling', 'stripes')) { ?>
                                    <div class="stripes">&nbsp;</div>
                                <?php } ?>
                            
                               
                        
                <?php
                        } /*EOF if exists single slideshow*/
                    }else if(get_post_format( $post -> ID ) == 'video'){

                        render_featured_video($post);
                        
                    }
            ?> 
        <?php
            if(isset($caption) && strlen($caption) && (get_post_format( $post -> ID ) != 'gallery' && get_post_format( $post -> ID ) != 'video' ) ){
                echo '<div class="post-caption">'.$caption.'</div>';
            }
        ?>       
        <?php if(get_post_format( $post -> ID ) != 'video' && get_post_format( $post -> ID ) != 'gallery') echo '</div>'; ?>
    </div>
    <?php } else {?>
        <div class="entry-header ">
                    <div class="password-center">
                        <i class="icon-password"></i>
                    </div>
                </div>
                
    <?php } ?>

<?php 
    if (!options::logic( 'blog_post' , 'enb_cropp_img' )) { 
        /*if resized image is used we want to have this row to make the width of the image the same size as set in the theme option*/
?>
</div>
<?php } ?>
<?php
    }
}else if(get_post_format( $post -> ID ) == 'video'){
    /*this is the case when featurem image does not exist or is disable but there still is featured video*/

    render_featured_video($post);
}


function render_featured_video($post){
    $video_format = meta::get_meta( $post -> ID , 'format' );

      
    $format=$video_format;

    if( isset( $format['video'] ) && !empty( $format['video'] ) && post::isValidURL( $format['video'] ) ){
        $vimeo_id = post::get_vimeo_video_id( $format['video'] );
        $youtube_id = post::get_youtube_video_id( $format['video'] );
        $video_type = '';
        if( $vimeo_id != '0' ){
            $video_type = 'vimeo';
            $video_id = $vimeo_id;
        }

        if( $youtube_id != '0' ){
            $video_type = 'youtube';
            $video_id = $youtube_id;
        }

        if( !empty( $video_type ) ){
            echo post::get_embeded_video( $video_id , $video_type );
        }

    }else if( isset( $video_format["feat_url"] ) && strlen($video_format["feat_url"])>1){

          $video_url=$video_format["feat_url"];
          if(post::get_youtube_video_id($video_url)!="0")
            {
              echo post::get_embeded_video(post::get_youtube_video_id($video_url),"youtube");
            }
          else if(post::get_vimeo_video_id($video_url)!="0")
            {
              echo post::get_embeded_video(post::get_vimeo_video_id($video_url),"vimeo");
            }
    }else if(isset( $video_format["feat_id"] ) && strlen($video_format["feat_id"])>1){
        echo do_shortcode('[video mp4="'.wp_get_attachment_url($video_format["feat_id"]).'" width="610" height="443"]');
        //echo post::get_local_video( urlencode(wp_get_attachment_url($video_format["feat_id"])));
    }
}
?>