<?php
    global $current_gallery;

    if ( post_password_required() ) {
        $is_password_protected = true;
    }else{
        $is_password_protected = false;
    }
    wp_localize_script( 'functions', 'enb_Galleria', array(
        'gallery_enb'          => true,
        'password_protected'   => $is_password_protected
        )
    );

    if ( get_posts_gallery_type($post -> ID) == 'vertical-scroll') { 
       wp_enqueue_script( 'lazyload' , get_template_directory_uri() . '/js/jquery.lazyload.min.js' , array( 'jquery' ),false,true );
    }

    
    if(isset($current_gallery)){ /*this is available when a gallery is used in a template, for exanple when you want to show on hte front page a gallery*/
        global $wp_query;

        $wp_query = new WP_Query( array('p' => $current_gallery, 'post_type' => 'gallery' ) );

        $post_id = $post -> ID;
    }
    while( have_posts() ){ 
        the_post();
?>
        
        <?php
            } /*EOF while( have_posts () ) */
        ?>
<?php 
/*if the gallery is mosaic*/
if ( get_posts_gallery_type($post -> ID) == 'mosaic'  || get_posts_gallery_type($post -> ID) == 'vertical-scroll') { ?>
    <?php  if(options::logic( 'blog_post' , 'show_next_prev' )){ ?>
        <nav class="hotkeys-meta">
            <span class="nav-previous"><?php previous_post_link( '%link' , __('', 'cosmotheme') ); ?></span>
            <span class="nav-next"><?php next_post_link( '%link' , __('', 'cosmotheme') ); ?></span>
        </nav>
    <?php } ?>

    <div class="row" >
        <div class="twelve columns">

            <?php if(options::logic( 'likes' , 'enb_likes' )  ){ ?> 
                <div class="single-like-container">
                    <?php like::content($post->ID,$return = false, $show_icon = true, $show_label = false);  ?>
                </div>
            <?php } 
            if ( ! meta::logic( $post , 'gallerytype' , 'show_title' ) ) {
            ?>
            
            <h1 class="post-title">
                <?php the_title(); ?>
            </h1>

            <?php 
            } 
                        if(get_post_type($post -> ID) == 'post'){
                            $cat_tax = 'category';    
                        } elseif(get_post_type( $post -> ID) == 'gallery') {
                            $cat_tax = 'gallery-category';   
                        } elseif(get_post_type( $post -> ID) == 'page') {
                            $cat_tax = '';
                        }
                        $the_categories = post::get_post_categories($post->ID, $only_first_cat = false, $taxonomy = $cat_tax, $margin_elem_start = ' <li>', $margin_elem_end = '</li>', $delimiter = ''); 
                    ?> 

            <?php 
                   
                echo '    <div class="meta-details">';
                include_once('entry-meta.php'); 
                echo '</div>';
            ?>


     
            <?php if (!$is_password_protected) { ?>
                <div class="content">    
                    <?php the_content(); ?>
                </div>
        </div>
    </div>

    <?php }


} ?>

    <?php 
    $infostatus = '';
    if((options::logic( 'blog_post' , 'hide_gallery_info' ) && meta::logic( $post , 'gallerytype' , 'hide_gallery_info' )) || 
        meta::logic( $post , 'gallerytype' , 'hide_gallery_info' )) { 
        $infostatus = 'no-gallery-sidebar'; 

    };

    if ( 1 == meta::logic( $post , 'gallerytype' , 'show_collapse_btn' )){
        $infostatus .=' show-collapse';
        $collapse = 1;
    }

    ?>
    <div class="<?php echo $infostatus;  if( get_posts_gallery_type($post -> ID) == 'vertical-scroll' ){echo "vertical-scroll row";} ?>">

        <?php if( !post_password_required() && get_posts_gallery_type($post -> ID) != 'mosaic' && get_posts_gallery_type($post -> ID) != 'vertical-scroll'){ 

            if ( !options::logic( 'blog_post' , 'hide_gallery_info' ) && !meta::logic( $post , 'gallerytype' , 'hide_gallery_info' ) || (1 == meta::logic( $post , 'gallerytype' , 'show_collapse_btn' ) )   ) {

                    ?> 
                    <div class="gallery-info">
                        <?php
                        if ( ! meta::logic( $post , 'gallerytype' , 'show_title' ) ) { ?>
                        <h1 class="post-title">
                            <?php the_title();?>
                        </h1>

                        <?php 
                        } 
                        if(options::logic( 'likes' , 'enb_likes' )){ ?> 
                        <div class="single-like-container">
                            <?php like::content($post->ID,$return = false, $show_icon = true, $show_label = false);  ?>
                        </div>
                        <?php } ?>

                        <?php  
                            if(get_post_type($post -> ID) == 'post'){
                                $cat_tax = 'category';    
                            } elseif(get_post_type( $post -> ID) == 'gallery') {
                                $cat_tax = 'gallery-category';   
                            } elseif(get_post_type( $post -> ID) == 'page') {
                                $cat_tax = '';
                            }
                            $the_categories = post::get_post_categories($post->ID, $only_first_cat = false, $taxonomy = $cat_tax, $margin_elem_start = ' <li>', $margin_elem_end = '</li>', $delimiter = ''); 
                        ?> 
                        <?php
                            echo '<div class="meta-details">';
                            include_once('entry-meta.php'); 
                            echo '</div>';
                        ?>

                        <div class="content">    
                            <?php the_content(); ?>
                         
                        </div> 
                        <div>

                        <?php 
                            if (options::get_value( 'blog_post' , 'post_sharing' ) == 'yes' && meta::logic( $post , 'gallerytype' , 'sharing') ) {
                            /*Add here social sharing*/ 
                            get_template_part('social-sharing');
                            }
                        ?>  
                        </div>

                        <?php  if(options::logic( 'blog_post' , 'show_next_prev' )){ ?>
                        <nav class="hotkeys-meta">
                            <?php $portfolio_first_categ = post::get_post_categories($post->ID, $only_first_cat = true, $taxonomy = 'gallery-category', $margin_elem_start = '', $margin_elem_end = '', $delimiter = '', $a_class = 'icon-root', $show_cat_name = false);
                            ?>
                            <?php
                                $ppost = get_previous_post();
                                $npost = get_next_post();
                                if( !empty( $ppost ) ){
                                    echo '<span><a class="icon-prev" href="' . get_permalink( $ppost -> ID ) . '" title="'.$ppost -> post_title.'"></a></span>';
                                } 
                                if(strlen(trim($portfolio_first_categ) )){
                                    echo '<span>'.$portfolio_first_categ.'</span>';
                                }
                                    
                                if( !empty( $npost ) ){
                                    echo '<span><a class="icon-next" href="' . get_permalink( $npost -> ID ) . '" title="'.$npost -> post_title.'"></a></span>';
                                }
                            ?>

                        </nav>
                        <?php } ?>            
                    </div>
                        <?php if(options::logic( 'blog_post' , 'show_collapse_btn' ) && 1 == meta::logic( $post , 'gallerytype' , 'show_collapse_btn' ) ){ ?> 
                                 <?php if (!options::logic( 'blog_post' , 'hide_gallery_info' ) && !meta::logic( $post , 'gallerytype' , 'hide_gallery_info' )){ ?>
                                    <div class="collapse-btn">
                                        <i class="icon-prev "></i>
                                        <span><?php _e('Click to collapse', 'cosmotheme'); ?></span>
                                <?php } else { ?>
                                    <div class="collapse-btn collapsed">
                                        <i class="icon-next "></i>
                                        <span><?php _e('Click to display', 'cosmotheme'); ?></span>
                                <?php } ?>
                            </div>  
                        <?php } 
            }
        }
        ?> 
        
        <?php
            if ( !post_password_required() ) {
                if( get_posts_gallery_type($post -> ID) == 'sly'){
                    echo post::get_post_img_slideshow( $post -> ID, 'single_gallery' );
                }else if( get_posts_gallery_type($post -> ID) == 'image_flow' ){
                    echo post::get_post_img_flow_slide($post -> ID, $size="single_gallery");
                }else if( get_posts_gallery_type($post -> ID) == 'mosaic' ){
                    echo post::get_post_img_mosaic($post -> ID);
                }else if( get_posts_gallery_type($post -> ID) == 'vertical-scroll' ){
                    echo post::get_post_img_vertical_scroll( $post -> ID, 'single_gallery' );
                }else{
                    echo post::get_post_gallery_slide($post -> ID, $size="single_gallery");
                }                
            }else{
?>
                <div class="entry-header row">
                    <div class="password-center three columns">
                        <i class="icon-password"></i>
                    </div>
                    <div class="nine columns">
                        <?php if ( ! meta::logic( $post , 'gallerytype' , 'show_title' ) ) { ?>
                        <h1 class="post-title">
                            <?php the_title(); ?>
                        </h1>

                        <?php } 
                        if(options::logic( 'likes' , 'enb_likes' )){ ?> 
                        <div class="single-like-container">
                            <?php like::content($post->ID,$return = false, $show_icon = true, $show_label = false);  ?>
                        </div>
                        <?php } ?>

                        <?php  
                            if(get_post_type($post -> ID) == 'post'){
                                $cat_tax = 'category';    
                            } elseif(get_post_type( $post -> ID) == 'gallery') {
                                $cat_tax = 'gallery-category';   
                            } elseif(get_post_type( $post -> ID) == 'page') {
                                $cat_tax = '';
                            }
                            $the_categories = post::get_post_categories($post->ID, $only_first_cat = false, $taxonomy = $cat_tax, $margin_elem_start = ' <li>', $margin_elem_end = '</li>', $delimiter = ''); 
                        ?> 
                        <?php
                            echo '<div class="meta-details">';
                            include_once('entry-meta.php'); 
                            echo '</div>';
                        ?>
                        <div class="content">    
                            <?php the_content(); ?>
                        </div> 

                        <?php  if(options::logic( 'blog_post' , 'show_next_prev' )){ ?>
                        <nav class="hotkeys-meta">
                            <?php $portfolio_first_categ = post::get_post_categories($post->ID, $only_first_cat = true, $taxonomy = 'gallery-category', $margin_elem_start = '', $margin_elem_end = '', $delimiter = '', $a_class = 'icon-root', $show_cat_name = false);
                            ?>
                            <?php
                                $ppost = get_previous_post();
                                $npost = get_next_post();
                                if( !empty( $ppost ) ){
                                    echo '<span><a class="icon-prev" href="' . get_permalink( $ppost -> ID ) . '" title="'.$ppost -> post_title.'"></a></span>';
                                } 
                                if(strlen(trim($portfolio_first_categ) )){
                                    echo '<span>'.$portfolio_first_categ.'</span>';
                                }
                                    
                                if( !empty( $npost ) ){
                                    echo '<span><a class="icon-next" href="' . get_permalink( $npost -> ID ) . '" title="'.$npost -> post_title.'"></a></span>';
                                }
                            ?>

                        </nav>
                        <?php } ?>      
                    </div>
                </div>


                
<?php                
            }
        ?> 

    </div>

    <?php //var_dump( meta::logic( $post , 'gallerytype' , 'related' ) ); ?>

    <?php if( get_posts_gallery_type($post -> ID) != 'sly' && get_posts_gallery_type($post -> ID) !='image_flow' ){

        //related galleries 
        ?>
        <div class="row single-gallery-bottom">
            <div class="twelve columns">
                <?php get_template_part('related-posts');
                /*comments*/
                if( comments_open() ){ ?>
                    <div class="cosmo-comments">            
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
                <?php    
                } ?>
            </div>
        </div> 
    <?php
    }?>
            
