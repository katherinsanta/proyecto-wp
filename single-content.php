<?php
    global $post;
    $post_id = $post -> ID;
                    
    $s = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , 'full' );
    
    if(!options::logic( 'blog_post' , 'meta' ) || !meta::logic( $post , 'settings' , 'meta' )){
        $no_meta_class = ' no-meta ';
    }else{
        $no_meta_class = ' ';
    }
?>
<article class="post single-post <?php echo $no_meta_class; ?>">
    

    <?php  
        if(get_post_type($post -> ID) == 'post'){
            $cat_tax = 'category';    
        } elseif(get_post_type( $post -> ID) == 'gallery') {
            $cat_tax = 'gallery-category';   
        } elseif(get_post_type( $post -> ID) == 'testimonial') {
            $cat_tax = '';
        } elseif(get_post_type( $post -> ID) == 'page') {
            $cat_tax = '';
        }
        $the_categories = post::get_post_categories($post->ID, $only_first_cat = false, $taxonomy = $cat_tax, $margin_elem_start = ' <li>', $margin_elem_end = '</li>', $delimiter = ''); 
    ?> 
    
    <?php 

    if(options::logic( 'likes' , 'enb_likes' ) ){
         $meta = meta::get_meta( $post -> ID, 'settings' );

        if ( isset( $meta['love'] ) && $meta['love'] == 'yes') { ?>
            <div class="single-like-container">
                <?php like::content($post->ID,$return = false, $show_icon = true, $show_label = false);  ?>
            </div>
            <?php 
        } 
    }
    if ( ! meta::logic( $post , 'settings' , 'show_title' ) ) {
    ?> 
        <h1 class="post-title">
            <?php the_title(); ?>
        </h1>

    <?php }
    if((get_post_type() == 'page' && options::logic( 'blog_post' , 'page_meta' )) || (get_post_type() == 'post' && options::logic( 'blog_post' , 'meta' ))){ 
        if( meta::logic( $post , 'settings' , 'meta' ) ){
            echo '    <div class="meta-details">';
            include_once('entry-meta.php'); 
            echo '</div>';
        }
    } ?>
    <div class="excerpt">
        <?php         
            if( get_post_format( $post -> ID ) == 'audio' ){
                echo do_shortcode( post::get_audio_file( $post -> ID ) );
            }
        
            //-------------------------
            if( get_post_format( $post -> ID ) == 'video' ){

                $video_format = meta::get_meta( $post -> ID , 'format' );
            ?>
                
            <div class="embedded_videos">    
                            
                <?php    

                if(isset($video_format['video_ids']) && !empty($video_format['video_ids'])){
                    foreach($video_format["video_ids"] as $videoid)
                    {
                        if( isset( $video_format[ 'video_urls' ][ $videoid ] ) ){
                            $video_url = $video_format[ 'video_urls' ][ $videoid ];
                            if( post::get_youtube_video_id($video_url) != "0" ){
                                echo post::get_embeded_video( post::get_youtube_video_id( $video_url ), "youtube" );
                            }else if( post::get_vimeo_video_id( $video_url ) != "0" ){
                                echo post::get_embeded_video( post::get_vimeo_video_id( $video_url ) , "vimeo" );
                            }
                        }else{
                            echo post::get_local_video( urlencode(wp_get_attachment_url($videoid)));
                        }
                    }
                }
                   
            ?>
            </div>
            <?php                                     
            }

            //---------------------------
            
            if(get_post_format($post->ID)=="image" && !(isset($single_slideshow) && strlen($single_slideshow)) )
            {
                $image_format = meta::get_meta( $post -> ID , 'format' );

                if(isset($image_format['images']) && is_array($image_format['images']))
                {
                    echo "<div class=\"attached-image-gallery\">";
                    echo '<div class="row">';
                    if ( ! post_password_required() ) {
                        foreach($image_format['images'] as $index=>$img_id)
                        {
                            //$thumbnail= wp_get_attachment_image_src( $img_id, 't_attached_gallery');
                            $full_image=wp_get_attachment_url($img_id);

                            $size = 'image_format';     
                                
                            $img_url = wp_get_attachment_url( $img_id ,'full'); //get img URL
                       
                            $thumbnail = aq_resize( $img_url, get_aqua_size($size), get_aqua_size($size, 'height'), true, false); //crop img


                            $url=$thumbnail[0];
                            $width=$thumbnail[1];
                            $height=$thumbnail[2];
                            echo '<div class="three columns mobile-one">';
                            echo "<div class=\"attached-image-gallery-elem\">";
                            echo "<a title=\"\" data-rel=\"prettyPhoto[".get_the_ID()."]\" href=\"".$full_image."\">";

                            if($height<150)
                            {
                                $vertical_align_style="style=\"margin-top:".((150-$height)/2)."px;\"";
                            }
                            else
                            {
                                $vertical_align_style="";
                            }

                            echo "<img alt=\"\" src=\"$url\" $vertical_align_style>";
                            echo "</a>";
                            echo "</div>";
                            echo "</div>";
                        }
                    };
                    echo "</div>";  
                    echo "</div>";   
                }
                
            }

            the_content();
            
        ?>
        <div class="pagenumbers">
        <?php wp_link_pages(array('before' => '<p>Pages:','after' => '</p>', 'next_or_number' => 'number'));  ?>
        </div>
        <?php
            if( get_post_format( $post -> ID ) == 'link' ){
                echo post::get_attached_file( $post -> ID );
            }

        ?>
        
        <?php
            $tags = wp_get_post_terms($post->ID, 'post_tag');

            if (!empty($tags)) {
            ?>
            <div class="tabs-container clear single-tags">
                    <?php
                    foreach ($tags as $tag) {
                        $t = get_tag($tag);
                        echo '<a href="' . get_tag_link($tag) . '" rel="tag" class="tag">' . $t->name . '</a>';
                    }
                    ?>
                    
            </div>
            <?php
            }
            ?>

            <?php 
                if (options::get_value( 'blog_post' , 'post_sharing' ) == 'yes' && meta::logic( $post , 'settings' , 'sharing' )) {
                    /*Add here social sharing*/ 
                    get_template_part('social-sharing');
                }
            ?>            

    </div> 
    <?php
    if(is_singular()){

        /*related posts*/
        if(is_single()){
            get_template_part('related-posts');
        }
        
        /*comments*/
        if( comments_open() ){
    ?>
        <div class="row">
            <div class="cosmo-comments twelve columns">            
    <?php        
            if( options::logic( 'general' , 'fb_comments' ) ){
                ?>
                    <h3 id="reply-title">
                        <span>
                        <?php 
                            $comments_label = sprintf(__('Leave a comment','cosmotheme'));
                            echo $comments_label;
                        ?>
                        </span>
                    </h3>    

                   <script>
                    var url_cosmo_coment = "<?php the_permalink(); ?>";
                    jQuery('<fb:comments href="' + url_cosmo_coment + '" num_posts="5" width="' + jQuery('.cosmo-comments').width() + '" height="120" reverse="true" class="single-facebook-comments"></fb:comments>').appendTo('.cosmo-comments');
                    FB.XFBML.parse();
                    </script>
                    
                <?php
            }else{
                comments_template( '', true );
            }
    ?>   
            </div>     
        </div>         
    <?php    
        }
    }
    
?>
</article>
