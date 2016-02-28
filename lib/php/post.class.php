<?php

class post {
    static $post_id = 0;
    static function get_my_posts( $author){
        $wp_query = new WP_Query( array('post_status' => 'any', 'post_type' => 'post' , 'author' => $author ) );
        if( count( $wp_query -> posts ) > 0 ){
            return true;
        }else{
            return false;
        }
    }
    
    
    static function filter_where( $where = '' ) {
        global $wpdb;
        if( self::$post_id > 0 ){
            $where .= " AND  ".$wpdb->prefix."posts.ID < " . self::$post_id;
        }
        return $where;
    }
        
    static function random_posts($no_ajax = false) {
        /*returns permalink to a random post*/
        global $wp_query;
        if ((int) get_query_var('paged') > 0) {
            $paged = get_query_var('paged');
        } else {
            if ((int) get_query_var('page') > 0) {
                $paged = get_query_var('page');
            } else {
                $paged = 1;
            }
        }

        $wp_query = new WP_Query(array('post_status' => 'publish', 'post_type' => 'post', 'posts_per_page' => 1, 'orderby' => 'rand', 'paged' => $paged));

        if ($wp_query->found_posts > 0) {
            $k = 0;
            foreach ($wp_query->posts as $post) {
                $wp_query->the_post();
                $result = get_permalink($post->ID);
            }
        }

        if (isset($no_ajax) && $no_ajax) {
            return $result;
        } else {
            echo $result;
            exit;
        }
    }
    
        
    static function search(){ 
        /*used for search inputs to search for posts when user types something*/
        
        $query = isset( $_GET['params'] ) ? (array)json_decode( stripslashes( $_GET['params'] )) : exit;
        $query['s'] = isset( $_GET['query'] ) ? $_GET['query'] : exit;
        
        global $wp_query;
        $result = array();
        $result['query'] = $query['s'];
        
        $wp_query = new WP_Query( $query );
        
        if( $wp_query -> have_posts() ){
            foreach( $wp_query -> posts as $post ){
                $result['suggestions'][] = $post -> post_title;
                $result['data'][] =  $post -> ID;
            }
        }
        
        echo json_encode( $result );
        exit();
    }

    /**
       render list view for products
    */
    static function list_view_products($post, $additional_hidden_class_for_load_more = '',  $show_full_content= false, $hide_excerpt= false){

        

        global  $product;

        $product = get_product($post->ID);

        if( !has_post_thumbnail($post->ID)){
            /*if thumbs are disabled for this particular post, it will act the same as 'no_thumb' option*/
            $list_view_thumbs_size = 'no_thumb';

            $content_class = ' twelve columns ';
            $header_class = '';

        }else{

            $size = 'list_view';     
                        
            
            $img_url = wp_get_attachment_url( get_post_thumbnail_id( $post -> ID )  ,'full'); //get img URL
                   
            $img_src = aq_resize( $img_url, get_aqua_size($size), get_aqua_size($size, 'height'), true, false); //crop img
            
            
            $list_view_thumbs_size = '';

            $content_class = ' six columns ';
            $header_class = ' six columns ';
        }


    ?>  
        <article class="woocommerce product-list-view">
            <div class="row">

                <?php if(strlen($header_class)) { ?>
                <div class=" <?php echo $header_class; ?> ">
                    <header>
                        <div class="featimg">
                            <a href="<?php echo get_permalink($post -> ID); ?>">
                                <img src="<?php echo $img_src[0]; ?>" alt="<?php echo $post->post_title; ?>" />
                                
                                <?php if ($product->is_on_sale()) : ?>
     
                                    <?php echo apply_filters('woocommerce_sale_flash', '<span class="onsale">'.__( 'Sale!', 'woocommerce' ).'</span>', $post, $product); ?>
                                
                                <?php endif; ?>
                            </a>
                            
                        </div>  
                    </header>   
                </div>
                <?php } ?>
                <div class=" <?php echo $content_class; ?> ">
                    <section>
                            <div class="title">
                                <a href="<?php echo get_permalink($post -> ID); ?>">
                                    <h2><?php echo $post->post_title; ?></h2>
                                </a>
                            </div>
                            <?php
                                //Get rating
                                $average = $product->get_average_rating();
                                $count = $product->get_rating_count();

                                if(strlen($average)){
                                    if(get_option( 'woocommerce_frontend_css' ) == 'yes'){
                                        $rating_class = ' default-woo-styles ';
                                    }else{
                                        $rating_class = '';
                                    }   
                                    echo '<div class="rating '.$rating_class.' "><div class=" woocommerce"><div class="star-rating" title="'.sprintf(__('Rated %s out of 5', 'woocommerce'), $average).'"><span style="width:'.($average*16).'px"><span itemprop="ratingValue" class="rating">'.$average.'</span> '.__('out of 5', 'woocommerce').'</span></div><div itemprop="ratingCount" class="count">'.sprintf( _n('%s review', '%s reviews', $count, 'woocommerce'), $count ).'</div><div class="clr"></div></div></div>';
                                }
                            ?>
                            
                            <div class="excerpt">
                                <?php
                                if(!$hide_excerpt){
                                    if ($show_full_content || get_post_format($post->ID)=="quote" ) {
                                        echo apply_filters('the_content', $post->post_content);
                                    }else{ /*show the excerpt (first 400 characters)*/
                                        $ln = options::get_value( 'blog_post' , 'excerpt_lenght_list' );
                                        
                                        echo '<p>';
                                        post::get_excerpt($post, $ln = $ln);
                                        echo '</p>';
                                    }
                                }
                                
                                ?>
                                
                            </div>

                    </section>

                    <footer>
                        <div class="row">
                            <div class="five columns">
                                <?php
                                    $price = $product->get_price_html();

                                    if($price){
                                ?>
                                <div class="price">
                                    <?php echo $price; ?>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="seven columns ">
                                <div class="buttons">
                                    <ul>
                                        <?php echo wishlist_btn($product->id, $margin_elem_start = '<li>', $margin_elem_end = '</li>'); ?>
                                        <li> 
                                            <div class="cart-button">
                                                <?php get_template_part('/woocommerce/loop/add-to-cart'); ?>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>  
                             
                        </div>
                    </footer>

                </div>
            </div>
        </article>
    <?php   
    
    
    }

    /**
       render list view for non products posts
    */
    static function list_view($post, $template = 'blog_page', $additional_hidden_class_for_load_more = '', $list_view_thumbs_size = '', $show_full_content = false, $hide_excerpt = false ) {
            
            if( !post::is_feat_enabled($post->ID)  || !has_post_thumbnail($post->ID)){
                /*if thumbs are disabled for this particular post, it will act the same as 'no_thumb' option*/
                if(get_post_format($post->ID)!="gallery") $list_view_thumbs_size = 'no_thumb';
            }
            $arabic_to_word = array( 0 => '', 1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six', 7 => 'seven', 8 => 'eight', 9 => 'nine', 10 => 'ten', 11 => 'eleven', 12 => 'twelve' );
            
            $thumb_sizes = array( 'no_thumb' => 0, 'medium_width_thumb' => 6, 'full_width_thumb' => 12 );
            $text_sizes = array( 'no_thumb' => 12, 'medium_width_thumb' => 6, 'full_width_thumb' => 12 );

            if (isset($text_sizes[ $list_view_thumbs_size ] ) && isset($arabic_to_word[ $text_sizes[ $list_view_thumbs_size ] ])) {
                $content_class = $arabic_to_word[ $text_sizes[ $list_view_thumbs_size ] ] . ' columns';
            }else{
                $content_class = ' twelve columns ';
            }
            //$content_class = $arabic_to_word[ $text_sizes[ $list_view_thumbs_size ] ] . ' columns';
            if( (isset($thumb_sizes[ $list_view_thumbs_size ]) && ($thumb_sizes[ $list_view_thumbs_size ] == 0 || !self::is_feat_enabled($post->ID) || !has_post_thumbnail($post->ID) ) ) || !isset($thumb_sizes[ $list_view_thumbs_size ]) ){
                $header_class = '';
                $content_class = 'twelve columns';
            }else{
                $header_class = $arabic_to_word[ $thumb_sizes[ $list_view_thumbs_size ] ] . ' columns';
            }
                        
            if($list_view_thumbs_size == 'full_width_thumb'){
                $size = 'single_cropped';     
            }else{
                $size = 'list_view';         
            }            
            

            $onclick = self::video_post_click($post);

            /* Set the class for different image sizes */

            if($list_view_thumbs_size == 'full_width_thumb'){
                $list_image_class = 'list-large-image';
            }elseif ('medium_width_thumb' == $list_view_thumbs_size) {
                $list_image_class = 'list-medium-image';
            }else{
                $list_image_class = 'list-no-image';
            }

            if ( get_post_type( $post -> ID) == 'gallery') {
                 $meta = meta::get_meta( $post -> ID  , 'gallerytype') ;
            } else {
                $meta = meta::get_meta( $post -> ID  , 'settings' );
            }
            
            if (isset($meta["thumb_link"]) && !empty($meta["thumb_link"])) {
                $thumblink = $meta["thumb_link"];
            } else {
                $thumblink = get_permalink($post->ID);
            }

             $link_tab = isset( $meta['thumb_link_tab'] ) ? $meta['thumb_link_tab'] : 'no';
            if ( 'yes' == $link_tab ) {
                $newtab = ' target="_blank" ';
            } else {
                $newtab = '';
            }

        ?>
 
        <div class="list-elem <?php echo $list_image_class; echo ' '.$additional_hidden_class_for_load_more.' ' ;?>" >
            <div class="row">
                <?php if( strlen( $header_class ) ){ ?>
                <div class="<?php echo $header_class; ?>">
                    <header class="list-elem-header  <?php if(options::logic( 'blog_post' , 'disable_hover_effect' )) { echo 'simple-hover';} ?>">
                        <?php if( self::is_feat_enabled($post->ID) ){ ?>
                            <div class="featimg">
                                <?php echo '<a class="list-hover-link" '. $newtab .' href="'. $thumblink .'"></a>'; ?>
                                <?php
                                    if (has_post_thumbnail($post->ID)) {
                            
                                        $img_url = wp_get_attachment_url( get_post_thumbnail_id( $post -> ID )  ,'full'); //get img URL
                                   
                                        $src = aq_resize( $img_url, get_aqua_size($size), get_aqua_size($size, 'height'), true, false); //crop img
                                        
                                        //$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) ,  $size ); 
                                        
                                        ?>

                                        <img src="<?php echo $src[0]; ?>" alt="<?php echo $post->post_title; ?>" />

                                        <?php
                                        
                                    } else {
                                        
                                        ?>

                                        <img src="<?php echo get_template_directory_uri() ?>/images/no.image.570x380.png" alt="<?php echo $post->post_title; ?>" />

                                        <?php
                                        
                                    }

                                ?>
                                <?php if (options::logic('styling', 'stripes')) {  ?>
                                    <div class="stripes" >&nbsp;</div>
                                <?php }?>
                               
                            </div>
                            <div class="hover-effect">
                                <ul class="hover-effect-meta">
                                    <?php  
                                        if(get_post_type($post -> ID) == 'post'){
                                            $cat_tax = 'category';    
                                        }elseif(get_post_type( $post -> ID) == 'gallery') {
                                            $cat_tax = 'gallery-category';   
                                        }

                                        if(isset($cat_tax)){
                                            $the_categories = post::get_post_categories($post->ID, $only_first_cat = false, $taxonomy = $cat_tax, $margin_elem_start = '<li class="entry-content-category-list-elem">', $margin_elem_end = '</li> ', $delimiter = ', '); 
                                        }else{
                                            $the_categories = '';
                                        }
                                    ?>                    
                                       
                                    <?php 
                                        if( options::logic( 'likes' , 'enb_likes' ) && ( !isset($meta['love'])  || meta::logic( $post , 'settings' , 'love' ) )  ){ 
                                    ?>              
                                    <li class="entry-content-meta">
                                        <?php like::content($post->ID,$return = false, $show_icon = true, $show_label = false);  ?>
                                    </li>
                                    <li class="hover-effect-meta-delimiter"></li>
                                    <?php } ?>  
                                    <?php if(strlen(trim($the_categories))){ ?>
                                    <li class="hover-effect-meta-category">
                                        <ul class="hover-effect-meta-category-list">
                                            <?php echo $the_categories; ?>
                                        </ul>
                                    </li>
                                    <?php } ?> 
                                    
                                </ul>
                            </div>
                        <?php } ?>  
                    </header> 
                </div>
                <?php } ?>  

                <div class="<?php echo $content_class; ?>">
                    <section class="list-elem-section <?php if(get_post_type( $post -> ID ) == 'gallery' && $list_view_thumbs_size == 'full_width_thumb') { echo 'gallery-full-thumb'; } ?>">
                        <ul class="entry-content-list">
                            <li class="entry-content-title"><h2><a href="<?php echo $thumblink; ?>"<?php echo $newtab; ?>title="<?php _e('', 'cosmotheme'); ?> <?php echo $post->post_title; ?>" rel="bookmark"><?php echo $post->post_title; ?></a></h2></li>
                            <li class="entry-content-meta">
                                <ul class="entry-content-meta-list">
                                    <li class="entry-content-meta-author">
                                        <?php echo '<a href="'.get_author_posts_url($post->post_author).'"><i class="icon-author"></i> '.get_the_author_meta('display_name', $post->post_author).'</a>'; ?>
                                    </li>
                                    <li class="entry-content-meta-date">
                                        <a href="<?php echo get_permalink($post->ID); ?>"><i class="icon-date"></i> <?php echo post::get_post_date($post -> ID);?></a> 
                                    </li>                                    
                                </ul>
                            </li>
                            <?php if(empty($post->post_password)) { ?>
                                <?php if(get_post_type( $post -> ID ) != 'gallery'){ ?>
                                    <?php if(!$hide_excerpt && !($list_image_class== 'list-no-image' || $list_image_class== 'list-small-image')){?><li class="entry-content-excerpt"> <?php } ?>
                                        <?php
                                            if(!$hide_excerpt && !($list_image_class== 'list-small-image')){
                                                if (get_post_format($post->ID) == 'audio') {
                                                    echo do_shortcode( self::get_audio_file( $post -> ID ) );
                                                    
                                                }
                                            }
                                        ?>
                                        <?php
                                        if(!$hide_excerpt){
                                            if ($show_full_content || get_post_format($post->ID)=="quote") {
                                                echo apply_filters('the_content', $post->post_content);
                                            }else{ /*show the excerpt (first 400 characters)*/
                                                $ln = options::get_value( 'blog_post' , 'excerpt_lenght_list' );
                                                post::get_excerpt($post, $ln = $ln);
                                            }
                                        }
                                        
                                        ?>
                                    <?php if(!$hide_excerpt && !($list_image_class== 'list-no-image' || $list_image_class== 'list-small-image')){?></li><?php } ?>                               
                                <?php } else { 
                                            if($list_view_thumbs_size != 'full_width_thumb') {
                                ?>  
                                    <?php if(!$hide_excerpt && !($list_image_class== 'list-no-image' || $list_image_class== 'list-small-image')){?><li class="entry-content-excerpt"> <?php } ?>
                                        <?php
                                            if(!$hide_excerpt && !($list_image_class== 'list-small-image')){
                                                if (get_post_format($post->ID) == 'audio') {
                                                    echo do_shortcode( self::get_audio_file( $post -> ID ) );
                                                    
                                                }
                                            }
                                        ?>
                                        <?php
                                        if(!$hide_excerpt){
                                            if ($show_full_content || get_post_format($post->ID)=="quote") {
                                                echo apply_filters('the_content', $post->post_content);
                                            }else{ /*show the excerpt (first 400 characters)*/
                                                $ln = options::get_value( 'blog_post' , 'excerpt_lenght_list' );
                                                post::get_excerpt($post, $ln = $ln);
                                            }
                                        }
                                        
                                        ?>
                                    <?php if(!$hide_excerpt && !($list_image_class== 'list-no-image' || $list_image_class== 'list-small-image')){?></li><?php } ?>   
                                <?php } } ?> 
                            <?php } ?>                                    
                        </ul>
                    </section>
                </div>
            </div>
        </div>              
        <?php
    }

    static function grid_view_thumbnails($post,  $width = 'three columns', $additiona_class = '', $filter_type = '', $taxonomy = 'category',$element_type = 'article', $is_masonry = false) {
        $nofeat_article_class = '';
        if( ! post::is_feat_enabled( $post->ID ) ){
            $nofeat_article_class = 'nofeat';    
        }

        if(options::logic( 'blog_post' , 'disable_hover_effect' )){
            $disable_hover_effect = '';
        } else { $disable_hover_effect = 'hovermove'; }


        $post_id = $post->ID;
        $formatclass = custom_get_post_format($post->ID);

        $no_img_class = '';


        if ( get_post_type( $post -> ID) == 'gallery') {
             $meta = meta::get_meta( $post -> ID  , 'gallerytype') ;
        } else {
            $meta = meta::get_meta( $post -> ID  , 'settings' );
        }

        if ( isset( $meta["thumb_link"] ) && ! empty( $meta["thumb_link"]) ) {
            $thumblink = $meta["thumb_link"];
        } else {
            $thumblink = get_permalink($post->ID);
        };

        $newtab = isset( $meta["thumb_link_tab"] ) ? $meta["thumb_link_tab"] : 'no';
        if ( 'yes' == $newtab ) {
            $newtab = ' target="_blank" ';
        } else {
            $newtab = '';
        }

    ?>
        <?php if(strlen($filter_type)){?>
        <div class=" all-elements <?php if ($is_masonry) echo 'masonry_elem '; echo $width; echo get_distinct_post_terms( $post->ID, $taxonomy, $return_names = true, $filter_type ); ?> " data-id="id-<?php echo $post->ID; ?>" >
        <?php } ?>
        <div class="thumb-elem <?php echo $disable_hover_effect?>">
            <header class="thumb-elem-header">
                <div class="featimg">
                    <?php
                    if (has_post_thumbnail($post->ID) && post::is_feat_enabled($post->ID) ) {
                        
                        $size = 'grid_big';     
                            
                        $img_url = wp_get_attachment_url( get_post_thumbnail_id( $post -> ID )  ,'full'); //get img URL
                   
                        $img_src = aq_resize( $img_url, get_aqua_size($size), get_aqua_size($size, 'height'), true, false); //crop img
                    
                    ?>
                        <img class="the-thumb" src="<?php echo $img_src[0]; ?>" alt="<?php echo $post->post_title; ?>" style="position:absolute" />
                        <img src="<?php echo get_template_directory_uri() ?>/images/thumb-transparent-img.png" alt="<?php echo $post->post_title; ?>"  />       
                    <?php } else{ 
                            $no_img_class = ' no-feat-img ';
                    ?>
                        <img  src="<?php echo get_template_directory_uri() ?>/images/thumb-transparent-img.png" alt="<?php echo $post->post_title; ?>" />

                    <?php } ?>

                    <?php 
                    if (options::logic('styling', 'stripes') && has_post_thumbnail($post->ID) && post::is_feat_enabled($post->ID)) {
                        ?><div class="stripes">&nbsp;</div><?php
                    }
                    
                    ?>
                    
                </div>
            </header> 

            <section class="thumb-elem-section <?php echo $no_img_class; ?>">
                <a href="<?php echo $thumblink; ?>"  <?php echo $newtab; ?>title="<?php _e('', 'cosmotheme'); ?> <?php echo $post->post_title; ?>" rel="bookmark" class="thumb-hover-link"></a>
                <ul class="entry-content-list">
                    <li class="entry-content-title"><a href="<?php echo $thumblink; ?>" <?php echo $newtab; ?> ><h2><?php echo $post->post_title; ?></h2></a></li>
                    <li class="entry-content-delimiter"></li>
                    <?php  
                        if(get_post_type($post -> ID) == 'post'){
                            $cat_tax = 'category';    
                        } elseif(get_post_type( $post -> ID) == 'gallery') {
                            $cat_tax = 'gallery-category';   
                        }

                        if(isset($cat_tax)){
                            $the_categories = post::get_post_categories($post->ID, $only_first_cat = false, $taxonomy = $cat_tax, $margin_elem_start = '<li class="entry-content-category-list-elem">', $margin_elem_end = '</li> ', $delimiter = ', '); 
                        }else{
                            $the_categories = '';
                        }

                        if(strlen(trim($the_categories))){
                    ?>
                    <li class="entry-content-category">
                        <ul class="entry-content-category-list">
                            <?php echo $the_categories; ?>
                        </ul>
                    </li>
                    <?php  
                        }
                    ?>  
                    <?php 
                        if( options::logic( 'likes' , 'enb_likes' ) && ( !isset($meta['love'])  || meta::logic( $post , 'settings' , 'love' ) )  ){ 
                    ?>              
                    <li class="entry-content-meta">
                        <?php like::content($post->ID,$return = false, $show_icon = true, $show_label = false);  ?>
                    </li>
                    <?php } ?>                                      
                </ul>
            </section>
        </div>
        <?php if(strlen($filter_type)){?>
        </div>
        <?php } ?>
    <?php    
    }

    /**
        get the info for the mosaic element depending on hte order of element 
        For example if the item will be the first one -  it will have container width "six columns" and thumb size 'tlist'
    **/
    static function get_mosaicinfo_by_order($item_number){
        $position_properties = array(
            '0' => array('width' => ' six ', 'thumb_size' => 'grid_big', 'container_class' => ' large-mosaic-elem '),
            '1' => array('width' => ' three ', 'thumb_size' => 'grid_small', 'container_class' => ' small-mosaic-elem '),
            '2' => array('width' => ' three ', 'thumb_size' => 'mosaic_long', 'container_class' => ' long-mosaic-elem '),
            '3' => array('width' => ' three ', 'thumb_size' => 'grid_small', 'container_class' => ' small-mosaic-elem '),
            '5' => array('width' => ' three ', 'thumb_size' => 'mosaic_long', 'container_class' => ' long-mosaic-elem '),
            '4' => array('width' => ' three ', 'thumb_size' => 'grid_small', 'container_class' => ' small-mosaic-elem '),
            '6' => array('width' => ' three ', 'thumb_size' => 'grid_small', 'container_class' => ' small-mosaic-elem '),
            '7' => array('width' => ' three ', 'thumb_size' => 'grid_small', 'container_class' => ' small-mosaic-elem '),
            '8' => array('width' => ' three ', 'thumb_size' => 'grid_small', 'container_class' => ' small-mosaic-elem '),
            '9' => array('width' => ' six ', 'thumb_size' => 'grid_big', 'container_class' => ' large-mosaic-elem '),
            '10' => array('width' => ' three ', 'thumb_size' => 'grid_small', 'container_class' => ' small-mosaic-elem '),
            '11' => array('width' => ' three ', 'thumb_size' => 'grid_small', 'container_class' => ' small-mosaic-elem '),
        );

        if(isset($position_properties[$item_number])){
            return $position_properties[$item_number];
        }else{
            $position_properties[0];
        }
    }

    /**
        =============== Mosaic view ===============
    **/
    static function mosaic_view($post, $options ){

        $default_options = array('post_number' => 0); /*default options*/
        $post_id = $post->ID;

        extract( $options ); /*extract the passed options*/
        extract( $default_options, EXTR_PREFIX_SAME, "default"); /* eXtract default options with 'default' prefix in case the option with the same name was already passed */
        
        if(options::logic( 'blog_post' , 'disable_hover_effect' )){
            $disable_hover_effect = '';
        } else { $disable_hover_effect = 'hovermove'; }


        $formatclass = custom_get_post_format($post->ID);

        $position_info = post::get_mosaicinfo_by_order($post_number % 12);
        $container_width = $position_info['width'];
        $thumb_size = $position_info['thumb_size'];
        $container_class = $position_info['container_class'];

        if( trim($container_class) == 'large-mosaic-elem'){
            $thumb_width = 720;
            $thumb_height = 720;
            $thumb_no_img = 'thumb-transparent-img.png';
        }elseif(trim($container_class) == 'long-mosaic-elem'){
            $thumb_width = 340;
            $thumb_height = 720;
            $thumb_no_img = 'no-img-long.png';
        }else{
            $thumb_width = 340;
            $thumb_height = 340;
            $thumb_no_img = 'thumb-transparent-img.png';
        }

        $no_img_class = '';

        if ( get_post_type( $post -> ID) == 'gallery') {
            $meta = meta::get_meta( $post -> ID  , 'gallerytype') ;
        } else {
            $meta = meta::get_meta( $post -> ID  , 'settings' );
        }

        if (isset($meta["thumb_link"]) && !empty($meta["thumb_link"])) {
            $thumblink = $meta["thumb_link"];
        } else {
            $thumblink = get_permalink($post->ID);
        }

        if ( isset($meta["thumb_link_tab"]) && 'yes' == $meta["thumb_link_tab"]) {
            $newtab = ' target="_blank" ';
        } else {
            $newtab = '';
        }

    ?>
        <div class="masonry_elem movable <?php echo $container_width; ?> columns">
            <div class="thumb-elem  <?php echo $container_class; echo ' '. $disable_hover_effect; ?> large-mosaic-elem">
                
                <header class="thumb-elem-header">
                    <div  class="featimg <?php if (!(has_post_thumbnail($post->ID) && post::is_feat_enabled($post->ID)) ) echo 'z_index_neg'; ?>">
                        
                        <?php

                        if (has_post_thumbnail($post->ID) && post::is_feat_enabled($post->ID) ) {
                            
                            $size = 'grid_small';     
                            
                            $img_url = wp_get_attachment_url( get_post_thumbnail_id( $post -> ID )  ,'full'); //get img URL
                       
                            $img_src = aq_resize( $img_url, get_aqua_size($thumb_size), get_aqua_size($thumb_size, 'height'), true, false); //crop img
                            //====================
                            //$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ) , $thumb_size );
                        
                            $img_width = $img_src[1];
                            $img_height = $img_src[2];
                            
                            if($img_width != $thumb_width || $img_height != $thumb_height){
                                /*if the image doesn't have the requested size then we will add a transparent square image and will give position absolute to the original image*/
                                $original_img_style = 'style="position:absolute"';
                            }else{
                                $original_img_style = '';
                            }
                        ?>
                            <img class="the-thumb" src="<?php echo $img_src[0]; ?>" alt="<?php echo $post->post_title; ?>"  style="position:absolute" />
                            <img src="<?php echo get_template_directory_uri() ?>/images/<?php echo $thumb_no_img;  ?>" alt="<?php echo $post->post_title; ?>" />
                          
                              
                        <?php } else{ 
                                    $no_img_class = ' no-feat-img ';
                        ?>
                            <img src="<?php echo get_template_directory_uri() ?>/images/<?php echo $thumb_no_img;  ?>" alt="<?php echo $post->post_title; ?>" />
                        <?php } ?>

                        <?php 
                        if (options::logic('styling', 'stripes') && has_post_thumbnail($post->ID) && post::is_feat_enabled($post->ID)) {
                            ?><div class="stripes">&nbsp;</div><?php
                        }
                        
                        ?>
                    </div>
                </header>
                <section class="thumb-elem-section <?php echo $no_img_class; ?>">
                    <a href="<?php echo $thumblink; ?>" <?php echo $newtab; ?> title="<?php _e('', 'cosmotheme'); ?> <?php echo $post->post_title; ?>" rel="bookmark" class="mosaic-hover-link"></a>
                    <ul class="entry-content-list">
                        <li class="entry-content-title"><a href="<?php echo $thumblink; ?>" <?php echo $newtab; ?> ><h2><?php echo $post->post_title; ?></h2></a></li>
                        <li class="entry-content-delimiter"></li>
                        <?php  
                            if(get_post_type($post -> ID) == 'post'){
                                $cat_tax = 'category';    
                            } elseif(get_post_type( $post -> ID) == 'gallery') {
                                $cat_tax = 'gallery-category';   
                            }

                            if(isset($cat_tax)){
                                $the_categories = post::get_post_categories($post->ID, $only_first_cat = false, $taxonomy = $cat_tax, $margin_elem_start = '<li>', $margin_elem_end = '</li> ', $delimiter = ', '); 
                            }else{
                                $the_categories = '';
                            }

                            if(strlen(trim($the_categories))){
                        ?>
                        <li class="entry-content-category">
                            <ul class="entry-content-category-list">
                                <?php echo $the_categories; ?>
                            </ul>
                        </li>
                        <?php 
                            } 

                            if( options::logic( 'likes' , 'enb_likes' ) && ( !isset($meta['love'])  || meta::logic( $post , 'settings' , 'love' ) )  ){ 
                        ?>
                        <li class="entry-content-meta">
                            <?php like::content($post->ID,$return = false, $show_icon = true, $show_label = false);  ?>
                        </li>
                        <?php } ?>
                    </ul>
                </section>

            </div>
        </div>
        
    <?php    

    }


    static function banner_view($post){


        $info_meta = meta::get_meta( $post -> ID , 'info' );
        
        if( (isset($info_meta['script']) && strlen($info_meta['script']) ) || (isset($info_meta['banner_img']) && strlen($info_meta['banner_img']) ) ){
            $custom_class = '';    
            if(isset($info_meta['class']) && strlen($info_meta['class'])){
                $custom_class = $info_meta['class'];    
            }

            if(isset($info_meta['img_link']) && strlen($info_meta['img_link'])){
                $start_link = '<a href="'.$info_meta['img_link'].'">';
                $end_link = '</a>';
            }else{
                $start_link = '';
                $end_link = '';
            }

            $banner_script = '';
            if(isset($info_meta['script']) && strlen($info_meta['script'])){
                $banner_script = $info_meta['script'];
            }
            $banner_image = '';
            if(isset($info_meta['banner_img']) && strlen($info_meta['banner_img'])){
                $banner_image = $start_link . '<img src="'.$info_meta['banner_img'].'"/>' . $end_link;
            }

    ?>
        <div class="<?php echo $custom_class; ?>">
            <?php
                echo $banner_script;
                echo $banner_image;   
            ?>
        </div>
    <?php    
        } /*EOF if exists script or image*/
    }

    static function grid_view($post,  $width = 'three columns', $additiona_class = '', $show_excerpt = true, $show_meta = true, $element_type = 'article', $is_masonry = false, $is_carousel = false, $is_cross_sells = false) {
    
            $nofeat_article_class = '';
            if(!post::is_feat_enabled($post->ID)){
                $nofeat_article_class = 'nofeat';    
            }
            $post_id = $post->ID;
            $onclick = self::video_post_click($post);
            $no_img_class = '';
            
            global $product;
            if (function_exists('get_product')) {
                $product = get_product($post->ID);
            } else {
                $product = '';
            }

            if(options::logic( 'blog_post' , 'disable_hover_effect' )){
            $disable_hover_effect = '';
        } else { $disable_hover_effect = 'hovermove'; }

            if ( get_post_type( $post -> ID) == 'gallery') {
                $meta = meta::get_meta( $post -> ID  , 'gallerytype') ;
            } else {
                $meta = meta::get_meta( $post -> ID  , 'settings' );
            }

            if (isset($meta["thumb_link"]) && !empty($meta["thumb_link"])) {
                $thumblink = $meta["thumb_link"];
            } else {
                $thumblink = get_permalink($post->ID);
            }

            $link_tab = isset( $meta['thumb_link_tab'] ) ? $meta['thumb_link_tab'] : 'no';
            if ( 'yes' == $link_tab ) {
                $newtab = ' target="_blank" ';
            } else {
                $newtab = '';
            }

        ?>
        <div data-id="id-<?php echo $post->ID; ?>" class="<?php if ($is_masonry) echo 'masonry_elem '; echo $width.' '.$additiona_class; ?>">
            <div class="grid-elem <?php if(get_post_type($post -> ID) == 'product'){ ?>product-grid<?php }?>  <?php echo ' '.$disable_hover_effect; ?>">
                <?php if (has_post_thumbnail($post->ID) && post::is_feat_enabled($post->ID) ) { ?>
                <header class="grid-elem-header">

                    <div class="featimg">
                        <?php if (get_post_type($post -> ID) == 'product' && $product->is_on_sale()) : ?>
                            <?php echo apply_filters('woocommerce_sale_flash', '<span class="onsale">'.__( 'Sale!', 'woocommerce' ).'</span>', $post, $product); ?>
                        <?php endif; ?>
                        <a href="<?php echo $thumblink; ?>" <?php echo $newtab; ?> class="grid-hover-link"></a>
                        <?php
                        if (has_post_thumbnail($post->ID) && post::is_feat_enabled($post->ID) ) {
                            
                            $size = 'grid_big';     
                            
                            $img_url = wp_get_attachment_url( get_post_thumbnail_id( $post -> ID )  ,'full'); //get img URL

                       if ($is_masonry) {
                            $img_src = aq_resize( $img_url, get_aqua_size($size), get_aqua_size($size, 'height'), false, false); //uncrop img
                       } else {
                            $img_src = aq_resize( $img_url, get_aqua_size($size), get_aqua_size($size, 'height'), true, false); //crop img
                       }
                        
                        ?>
                            <img class="the-thumb" src="<?php echo $img_src[0]; ?>" alt="<?php echo $post->post_title; ?>" style="position:absolute"/>
                            <img src="<?php echo get_template_directory_uri() ?>/images/thumb-transparent-img.png" alt="<?php echo $post->post_title; ?>"  />         
                        <?php } else{ 
                                $no_img_class = ' no-feat-img ';
                        ?>
                            <img src="<?php echo get_template_directory_uri() ?>/images/thumb-transparent-img.png" alt="<?php echo $post->post_title; ?>" />
                        <?php } ?>

                        <?php 
                        if (options::logic('styling', 'stripes') && has_post_thumbnail($post->ID) && post::is_feat_enabled($post->ID)) {
                            ?><div class="stripes">&nbsp;</div><?php
                        }
                        
                        ?>
                        
                    </div>
                    <div class="hover-effect">                       
                        <ul class="hover-effect-meta">
                            <?php  
                                if(get_post_type($post -> ID) == 'post'){
                                    $cat_tax = 'category';    
                                } elseif(get_post_type( $post -> ID) == 'gallery') {
                                    $cat_tax = 'gallery-category';   
                                }else if(get_post_type($post -> ID) == 'product'){
                                    $cat_tax = 'product_cat';  
                                }

                                if(isset($cat_tax)){
                                    $the_categories = post::get_post_categories($post->ID, $only_first_cat = false, $taxonomy = $cat_tax, $margin_elem_start = '<li class="entry-content-category-list-elem">', $margin_elem_end = '</li> ', $delimiter = ', '); 
                                }else{
                                    $the_categories = '';
                                }

                                if(strlen(trim($the_categories))){
                            ?>
                           
                            <li class="hover-effect-meta-category">
                                <ul class="hover-effect-meta-category-list">
                                    <?php echo $the_categories; ?>
                                </ul>
                            </li>
                            
                            <?php  
                                }
                            ?>  

                            <?php 
                                if(get_post_type($post -> ID) != 'product' && options::logic( 'likes' , 'enb_likes' ) && ( !isset($meta['love'])  || meta::logic( $post , 'settings' , 'love' ) )  ){ 
                            ?>              
                            <li class="entry-content-meta">
                                <?php like::content($post->ID,$return = false, $show_icon = true, $show_label = false);  ?>
                            </li>
                            <li class="hover-effect-meta-delimiter"></li>
                            <?php } ?>                             
                        </ul>

                    </div>                    
                </header>   
                <?php } ?>              
                <section class="grid-elem-section <?php echo  $no_img_class  ?>">
                    <ul class="entry-content-list">
                        <li class="entry-content-title"><h2><a href="<?php echo $thumblink; ?>" <?php echo $newtab; ?> ><?php echo $post->post_title; ?></a></h2></li>
                        <?php if(get_post_type($post -> ID) == 'product'){
                                $product = get_product($post -> ID);
                                $price = $product->get_price_html();
                        ?>
                                <li class="entry-content-price">
                                    <?php echo $price; ?>
                                </li> 
                            <?php }  ?>
                        <?php if(get_post_type($post -> ID) != 'product' ){ ?>
                        <li class="entry-content-meta">
                            <ul class="entry-content-meta-list">
                                <li class="entry-content-meta-author">
                                    <?php echo '<a href="'.get_author_posts_url($post->post_author).'"><i class="icon-author"></i> '.get_the_author_meta('display_name', $post->post_author).'</a>'; ?>
                                </li>
                                <li class="entry-content-meta-date">
                                    <a href="<?php echo get_permalink($post->ID); ?>"><i class="icon-date"></i> <?php echo post::get_post_date($post -> ID);?></a> 
                                </li>                                 
                            </ul>
                        </li>
                        <li class="entry-content-excerpt">
                            <div class="player_grid_container"> 
                                <?php 
                                if( get_post_format( $post -> ID ) == 'audio' ){
                                    echo do_shortcode( self::get_audio_file( $post -> ID ) );
                                }
                                ?>
                            </div>

                            <?php
                                if( get_post_format($post->ID)=="quote" ){ /*for 'quote' posts we show the entire content*/
                                    echo apply_filters('the_content', $post->post_content);
                                }else{
                                    $ln = options::get_value( 'blog_post' , 'excerpt_lenght_grid' );
                                    post::get_excerpt($post, $ln = $ln);
                                }   
                            ?>
                        </li>
                        <?php } ?>
                    </ul>

                </section>
                <?php if(get_post_type($post -> ID) == 'product' && !$is_cross_sells){ ?>
                    <div class="cart-options">
                        <ul>
                            <li><?php get_template_part('/woocommerce/loop/add-to-cart'); ?></li>
                            <?php echo wishlist_btn($product->id, $margin_elem_start = '<li>', $margin_elem_end = '</li> '); ?>
                        </ul>
                    </div>
                <?php } ?>

            </div>
        </div>
        <?php
    }

    static function show_meta_author_box($post){
		$meta = meta::get_meta( $post -> ID , 'settings' );

		  
		if( isset( $meta[ 'author' ] ) && strlen( $meta[ 'author' ] ) && !is_author() ){
			$show_author = meta::logic( $post , 'settings' , 'author' );
		}else{
			if( is_single() ){
				$show_author = options::logic( 'blog_post' , 'post_author_box' );
			}

			if( is_page() ){
				$show_author = options::logic( 'blog_post' , 'page_author_box' );
			}

			if( !( is_single() || is_page() ) ){
				$show_author = true;
			}
		}
        if(1==2){ the_tags(); }
		return $show_author;
	}
  
       
        static function get_embeded_video($video_id,$video_type,$autoplay = 0,$width = 570,$height = 414){
        	
        	$embeded_video = '';
        	if($video_type == 'youtube'){
        		$embeded_video	= '<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$video_id.'?wmode=transparent&autoplay='.$autoplay.'" wmode="opaque" frameborder="0" allowfullscreen></iframe>';
        	}elseif($video_type == 'vimeo'){
        		$embeded_video	= '<iframe src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;autoplay='.$autoplay.'&amp;byline=0&amp;portrait=0" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>';
        	}
        	
        	return $embeded_video;
        }
        
		static function get_local_video($video_url, $width = 570, $height = 414, $autoplay = false ){
			
            $result = '';    
			
            if($autoplay){
                $auto_play = 'true';
            }else{
                $auto_play = 'false';
            }
            
            $result = do_shortcode('[mejsvideo src="'.urldecode($video_url).'" type="video/mp4" width="'.$width.'" height="'.$height.'"  ]');
			//$result = do_shortcode('[video mp4="'.$video_url.'" width="'.$width.'" height="'.$height.'"  autoplay="'.$auto_play.'"]');
			
			return $result;	
		}
  
        static function get_video_thumbnail($video_id,$video_type){
        	$thumbnail_url = '';
        	if($video_type == 'youtube'){
				$thumbnail_url = 'http://i1.ytimg.com/vi/'.$video_id.'/hqdefault.jpg';
        	}elseif($video_type == 'vimeo'){
        		
				$hash = wp_remote_get("http://vimeo.com/api/v2/video/$video_id.php");
				$hash = unserialize($hash['body']);
				
				$thumbnail_url = $hash[0]['thumbnail_large'];  
        	}
        	
        	return $thumbnail_url;
        }
        
    	static function get_youtube_video_id($url){
	        /*
	         *   @param  string  $url    URL to be parsed, eg:  
	 		*  http://youtu.be/zc0s358b3Ys,  
	 		*  http://www.youtube.com/embed/zc0s358b3Ys
	 		*  http://www.youtube.com/watch?v=zc0s358b3Ys 
	 		*  
	 		*  returns
	 		*  */	
        	$id=0;
        	
        	/*if there is a slash at the en we will remove it*/
        	$url = rtrim($url, " /");
        	if(strpos($url, 'youtu')){
	        	$urls = parse_url($url); 
	     
			    /*expect url is http://youtu.be/abcd, where abcd is video iD*/
			    if(isset($urls['host']) && $urls['host'] == 'youtu.be'){  
			        $id = ltrim($urls['path'],'/'); 
			    } 
			    /*expect  url is http://www.youtube.com/embed/abcd*/ 
			    else if(strpos($urls['path'],'embed') == 1){  
			        $id = end(explode('/',$urls['path'])); 
			    } 
			     
			    /*expect url is http://www.youtube.com/watch?v=abcd */
			    else if( isset($urls['query']) ){ 
			        parse_str($urls['query']); 
			        $id = $v; 
			    }else{
					$id=0;
				} 
        	}	
			
			return $id;
        }
        
        static function  get_vimeo_video_id($url){
        	/*if there is a slash at the en we will remove it*/
        	$url = rtrim($url, " /");
        	$id = 0;
        	if(strpos($url, 'vimeo')){
				$urls = parse_url($url); 
				if(isset($urls['host']) && $urls['host'] == 'vimeo.com'){  
					$id = ltrim($urls['path'],'/'); 
					if(!is_numeric($id) || $id < 0){
						$id = 0;
					}
				}else{
					$id = 0;
				} 
        	}	
			return $id;
		}
        

	    static function isValidURL($url)
		{
			return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
		}

        static function remove_post(){

			if(isset($_POST['post_id']) && is_numeric($_POST['post_id'])){
				$post = get_post($_POST['post_id']);
				if(get_current_user_id() == $post->post_author){
					wp_delete_post($_POST['post_id']);
				}
			}  

			exit;
		}
        
        static function get_source($post_id){
        	/*returns 'post_source' meta data*/
        	$source = '';
  			$source_meta = meta::get_meta( $post_id , 'source' );
  			
  			if(is_array($source_meta) && sizeof($source_meta) && isset($source_meta['post_source']) && trim($source_meta['post_source']) != ''){
  				$source = $source_meta['post_source'];
        		
  			}else{
  				$source = ''; //'<div class="source no_source"><p>'.__('Unknown source','cosmotheme').'</p></div>';
  			}
  			
        
        			
  			return $source;      	
        }

        static function get_client($post_id){
            /*returns 'post_client' meta data*/
            $client = '';
            $source_meta = meta::get_meta( $post_id , 'source' );
            
            if( isset($source_meta['post_client']) && trim($source_meta['post_client']) != ''){
                $client = $source_meta['post_client'];
            }
                
            return $client;         
        }

        static function get_services($post_id){
            /*returns 'post_services' meta data*/
            $services = '';
            $source_meta = meta::get_meta( $post_id , 'source' );
            
            if(isset($source_meta['post_services']) && trim($source_meta['post_services']) != ''){
                $services = $source_meta['post_services'];
            }
                
            return $services;         
        }

        static function get_custom_meta($post_id){
            $custom_meta = meta::get_meta( $post_id, 'source' );
            if(isset($custom_meta['custominfometa']) && is_array($custom_meta['custominfometa']) && sizeof($custom_meta['custominfometa'])){
                return $custom_meta['custominfometa'];
            }else{
                return false;
            }

        }

        static function render_custom_meta($post_id){
            $custom_meta = post::get_custom_meta($post_id);
            if(is_array($custom_meta)){
                foreach ($custom_meta as $key => $value) {
        ?>
                    <li>
                        <div class="meta_name"><?php echo $key; ?></div>
                        <div class="meta_value"><?php echo $value; ?></div>
                    </li>
        <?php            
                }
            }
        }

		static function get_attached_file($post_id){
        	
        	$attached_file = '';
  			$attached_file_meta = meta::get_meta( $post_id , 'format' );

            $attached_file = '<div class="attached-files">';
  			
			if(is_array($attached_file_meta) && sizeof($attached_file_meta) && isset($attached_file_meta['link_id']) && is_array($attached_file_meta['link_id'])){
				foreach($attached_file_meta['link_id'] as $file_id)
				  {
					$attachment_url = explode('/',wp_get_attachment_url($file_id));
					$file_name = '';
					if(sizeof($attachment_url)){
					  $file_name = $attachment_url[sizeof($attachment_url) - 1];
					}	
					$attached_file .= '<div class="attached-files-elem">';
					$attached_file .= '<a href="'.wp_get_attachment_url($file_id).'">';
                    $attached_file .= '<div class="attached-files-elem-icon"><i class="icon-attachment"></i></div>';
                    $attached_file .= '<div class="attached-files-elem-title">'. $file_name .'</div>';
                    $attached_file .= '</a>';
					$attached_file .= '</div>';
				  }
			}else if(is_array($attached_file_meta) && sizeof($attached_file_meta) && isset($attached_file_meta['link_id']))
			  {
				$file_id=$attached_file_meta['link_id'];
				$attachment_url = explode('/',wp_get_attachment_url($file_id));
					$file_name = '';
					if(sizeof($attachment_url)){
					  $file_name = $attachment_url[sizeof($attachment_url) - 1];
					}	
					$attached_file .= '<div class="attached-files-elem">';
                    $attached_file .= '<a href="'.wp_get_attachment_url($file_id).'">';
                    $attached_file .= '<div class="attached-files-elem-icon"><i class="icon-attachment"></i></div>';
                    $attached_file .= '<div class="attached-files-elem-title">'. $file_name .'</div>';
                    $attached_file .= '</a>';
					$attached_file .= '</div>';
			  }
  			$attached_file .= '</div>';

  			return $attached_file;      	
        }

		static function get_audio_file($post_id){
        	$attached_file = '';
  			$attached_file_meta = meta::get_meta( $post_id , 'format' );
  			
			if(is_array($attached_file_meta) && sizeof($attached_file_meta) && isset($attached_file_meta['audio']) && is_array($attached_file_meta['audio'])){

				foreach($attached_file_meta['audio'] as $audio_id)
				  {
					//$attached_file .= '[audio:'.wp_get_attachment_url($audio_id).']';
                    $attached_file .= '[mejsaudio src='.wp_get_attachment_url($audio_id).']';
				  }				
			}else if(is_array($attached_file_meta) && sizeof($attached_file_meta) && isset($attached_file_meta['audio']) && $attached_file_meta['audio'] != '' ){
			  
                //$attached_file .= '[audio:'.$attached_file_meta['audio'].']';
                $attached_file .= '[mejsaudio src='.$attached_file_meta['audio'].']';
			}
  					
  			return $attached_file;      	
        }
        
        static function play_video($width=570, $height=414){
            $result = '';   

            if(isset($_POST['width']) && is_numeric($_POST['width']) && isset($_POST['height']) && is_numeric($_POST['height'])){
                $width = $_POST['width'];
                $height = $_POST['height'];
            }

            if(isset($_POST['video_id']) && isset($_POST['video_type']) && $_POST['video_type'] != 'self_hosted'){  
                $result = self::get_embeded_video($_POST['video_id'],$_POST['video_type'],1,$width, $height);
            }else{
                $video_url = urldecode($_POST['video_id']);
                $result = self::get_local_video($video_url, $width, $height, true );
            }   
            
            echo $result;
            exit;
        }        
        static function list_tags($post_id){
            $tag_list = '';
            $tags = wp_get_post_terms($post_id, 'post_tag');

            if (!empty($tags)) {
                    $i = 1;
                    foreach ($tags as $tag) { 
                        if($i==1){
                            $tag_list .= $tag->name;
                        }else{
                            $tag_list .= ', '.$tag->name;
                        }    
                        $i++;
                    }
            }
            
            return $tag_list;
        }

         /*check if showing featured image on archive pages is enabled*/
        static public function is_feat_enabled($post_id){
            
            if(options::get_value( 'blog_post' , 'show_feat_on_archive' ) == 'no'){
                return false;
            }else{
                $meta = meta::get_meta( $post_id , 'settings' );
                if(isset($meta['show_feat_on_archive']) && $meta['show_feat_on_archive'] == 'yes'){
            
                    return true;
                }elseif(isset($meta['show_feat_on_archive']) && $meta['show_feat_on_archive'] == 'no'){
                    return false;
                }else{
                    return true;
                }
            }

        }

        static function get_post_date($post_id){
            if (options::logic('general', 'time')) {
                 $post_date = human_time_diff(get_the_time('U', $post_id), current_time('timestamp')) . ' ' . __('ago', 'cosmotheme'); 
            } else {
                $post_date = __('on','cosmotheme'). ' '.date_i18n(get_option('date_format'), get_the_time('U', $post_id)); 
            }

            return $post_date .' ';
        }

        
        static function get_post_categories($post_id, $only_first_cat = false, $taxonomy = 'category', $margin_elem_start = '', $margin_elem_end = '', $delimiter = ', ',  $a_class = '', $show_cat_name = true){

            
                            
            $cat = '';
            $categories = wp_get_post_terms($post_id, $taxonomy );
            if (!empty($categories)) {
                
                $ind = 1;
                foreach ($categories as $category) {
                //    $categ = get_category($category);
                    if($ind != count($categories) && !$only_first_cat){
                        $cat_delimiter = $delimiter;   
                    }else{
                        $cat_delimiter = '';   
                    }

                    if ($show_cat_name) {
                        $name =  $category->name;
                    }else{
                        $name = '';
                    }
                    $cat .= $margin_elem_start . '<a href="' . get_category_link($category) . '" class="'.$a_class.'">' . $name . $cat_delimiter . '</a>' . $margin_elem_end;
                    
                    if($only_first_cat){
                        break;    
                    }
                    

                    $ind ++;
                }
                
                
                //$cat = __('in','cosmotheme').' '.   $cat;   
            }
                            
              return $cat .' ' ;
        }

        
        static function load_more(){
            $response = array();
            if(isset($_POST['action']) ){

                $id = $_POST[ 'id' ];
                $row_id = $_POST[ 'row_id' ];
                $template_id = $_POST[ 'template_id' ];

                $all_templates = get_option( 'templates' );
                $data = $all_templates[$template_id];

                $template = new LBTemplate( $data );
                $element = $template -> rows[ $row_id ] -> elements[ $id ];

                $is_ajax = true;

                $nonce = $_POST['getMoreNonce'];

                // check to see if the submitted nonce matches with the
                // generated nonce we created earlier
                if ( ! wp_verify_nonce( $nonce, 'myajax-getMore-nonce' ) )
                    die ( 'Busted! Wrong Nonce');

                /*Done with check, now let's do some real work*/

                $element -> view = $_POST['view']; 
                $element -> carousel = 'no'; 
                $element ->  paged = $_POST['current_page'] + 1;
                $element ->  is_ajax = true;

                
                $type = $_POST['type'];
                global $wp_query;
                ob_start();
                ob_clean();
                if( $element -> row -> is_additional ){
                    $element -> restore_query();
                    $element -> render_frontend_posts( $wp_query -> posts );
                }else{
                    call_user_func( array ( $element, "render_frontend_$type" ) );
                }
                $content = ob_get_clean();
                $response['content'] = $content;
                $response['current_page'] = $element ->  paged;
                $response['need_load_more'] = ( $wp_query -> query_vars[ 'paged' ] < $wp_query -> max_num_pages );
                wp_reset_query();
            }

            echo json_encode($response);
            exit;    
        }

        /*generates content for gallery slider when 'sly' mode is set*/
        static function get_post_img_slideshow($post_id, $size="gallery_format_slider"){

            /*check the meta data where the attached image ids are stored*/

            $post_image_gallery_meta = get_post_meta( $post_id, '_post_image_gallery', true );

            if(strlen($post_image_gallery_meta) && 'Array' != $post_image_gallery_meta){
                $product_image_gallery = $post_image_gallery_meta;

                $img_id_array = array_filter( explode( ',', $product_image_gallery ) );
            }else{
                //backward compatibility with version prev to 1.1
                $attachet_gallery_ids = meta::get_meta( $post_id, 'imagesattached' );

                if(isset($attachet_gallery_ids['img_ids']) && strlen($attachet_gallery_ids['img_ids'])){
                    /*mata is stored as a string of numbers separated by comma (ex: 909,914,913,912,911,910,908)*/
                    $img_id_array =  explode(',', $attachet_gallery_ids['img_ids']);  //create an array from the string
                    
                }
            }
            
            if(isset($img_id_array) && is_array($img_id_array)){
                foreach ($img_id_array as $value) {
                    $attachments[$value] = $value; // create attachments array in hte format that will work for us                    
                }
            }

            if( ! isset($attachments)){ // if no meta is attached to the post then the gallery wil be created from attached images
                $thumb_ID = get_post_thumbnail_id($post_id);   
                $attachments = get_children(array('post_parent' => $post_id,
                        'post_status' => 'inherit',
                        'post_type' => 'attachment',
                        'post_mime_type' => 'image',
                        'order' => 'ASC',
                        'exclude' => $thumb_ID,
                        'orderby' => 'menu_order ID'));    

                $format = get_post_format( $post_id ); 
                $new_attachments = array();
                if ( $format === 'gallery' ) { // only for posts format Gallery
                    $attached_imgs = meta::get_meta( $post_id, 'format' );
                    if ( is_array( $attached_imgs[ "images" ] ) && is_array( $attachments ) ) {
                        foreach ($attached_imgs[ "images" ] as $i => $imgID) {
                            $new_attachments[ $imgID ] = $attachments[ $imgID ];
                        }
                        $attachments = $new_attachments;
                    }
                }

            }
                  
            if(count($attachments) > 0){

                $pretty_colection_id = mt_rand(0,9999);
                
                if($size== "gallery_format_slider"){
                    $images_to_show_first = 9;
                }else{
                    $images_to_show_first = 5;
                }
                
                $additional_items = ''; /*in this string we will store the images that are left after loading the number of images defined in $images_to_show_first var*/
                $counter = 0;

                if ( get_post_type( $post_id ) == 'gallery') {
                    $meta = meta::get_meta( $post_id , 'gallerytype') ;
                } else { // for gallery posts we do not have these options
                    $meta = array(
                        'randomize_image' => '',
                        'reverse_order' => '',
                        'show_slide_btn' => '',
                    );
                }

                if ('yes' == $meta['randomize_image']) {
                    $attachments = post::shuffle_assoc($attachments);
                }

                if ('yes' == $meta['reverse_order']) {
                    $attachments = array_reverse($attachments, true);
                }

                if ('yes' == $meta['show_slide_btn']) {
                    self::show_gallery_slideshow($attachments);
                }
            ?>
                <div class="entry-header" >
                    <?php 
                    if ('yes' == $meta['show_slide_btn']) { ?>
                        <div id="show-gal-slideshow" class="icon-play shake animated"></div>
                    <?php 
                    } ?>
                    <div class="frame" id="centered">

                        <ul class="clearfix">
                            <?php          
                                foreach($attachments as $att_id => $attachment) {
                                    $full_img_url = wp_get_attachment_url($att_id);

                                    $thumbnail_url = aq_resize( $full_img_url, get_aqua_size($size), get_aqua_size($size, 'height'), false, false ); //resize img, Return an array containing url, width, and height.

                                    //$thumbnail_url= wp_get_attachment_image_src( $att_id, $size);
                                    
                                    
                                    if($counter < $images_to_show_first){
                                        $src = $thumbnail_url[0]; // for the first X images we will give original img src
                                    }else{
                                        $src = get_template_directory_uri().'/images/grey.gif';  // for the rest of the images we will load a 1px image to not load the page
                                    }

                                    $caption = post::check_alt_text($att_id);
                                   
                                    global $wp_query;
                                    $post_now = $wp_query -> queried_object;

                                    /* video update*/


                                   // $alt = get_post_meta($att_id, '_wp_attachment_image_alt', true);
                                    $custom_fields = get_post_custom($att_id);
                                    $video_link_db = '';
                                    if (isset($custom_fields['video_link'])) {
                                        $video_link_db = $custom_fields['video_link'][0];
                                       // var_dump($video_link_db);
                                    }
                            
                                    $pos = '';
                                    if( !empty( $video_link_db )){
                                        $pos = strpos($video_link_db, 'iframe');
                                    }

                                    //checking if $caption is a link or an iframe
                                    $embed_code = '';

                                    if( !empty($video_link_db) && filter_var($video_link_db, FILTER_VALIDATE_URL)){ 

                                        $embed_code = wp_oembed_get($video_link_db); //it's a link

                                        preg_match("/(?<=width=\")\d+(?=\")/", $embed_code, $width_int);

                                        preg_match("/(?<=height=\")\d+(?=\")/", $embed_code, $height_int);

                                        $iframe_height = intval($height_int[0]);
                                        $iframe_width  = intval($width_int[0]); 

                                        $ratio = round($iframe_width / $iframe_height , 2);
                                        
                                        if ($ratio < 1.79 && $ratio > 1.76) {
                                           $ratio = 1.60;
                                        }

                                       if ($ratio < 2.4 && $ratio > 2.38) {
                                           $ratio = 1.60;
                                        }

                                        $setting_height = intval(get_aqua_size($size, 'height'));
                                        
                                        $setting_width = round($setting_height * $ratio , 2);

                                       
                                      //check if it's an iframe
                                    } else if ( isset($pos) && $pos == 1 ) {

                                        $embed_code = $video_link_db; //it's an iframe

                                    }

                                    //deb::e($custom_fields);
                                    $custom_link_db = '';
                                    $custom_link_tab = '';
                                    $tab = '';
                                    if (isset($custom_fields['custom_link'])) {
                                        $custom_link_db = $custom_fields['custom_link'][0];
                                        $custom_link_tab = $custom_fields['custom_link_tab'][0];

                                        $tab = $custom_link_tab == 'yes' ? 'target="_blank"' : '';
                                    }


                                    ob_start();
                                    ob_clean();
                            
                            ?>  
                                    <li class="relative">


                                        <?php //if there is a video, we print the video instead the image
                                        if ($embed_code != FALSE && $embed_code != '') {
                                           ?> 
                                           <img class="lazy video-inside" src="<?php echo $src; ?>" width="<?php echo $setting_width; ?>" height="<?php echo $setting_height; ?>" data-width="<?php echo $setting_width; ?>" data-height="<?php echo $setting_height; ?>" />
                                           <div class="video-container"> 
                                                <?php echo $embed_code;?> 
                                           </div>
                                        <?php } else {
                                                if ( get_post_type( $post_now -> ID) == 'gallery') {
                                                    $cap = meta::logic( $post_now , 'gallerytype' , 'show_sly_caption' );
                                                } else {
                                                    $cap = meta::logic( $post_now , 'settings' , 'show_sly_caption' );
                                                }

                                            if ( options::logic('blog_post', 'show_sly_caption')  && $cap ) {  ?>
                                                <div class="sly-caption"><?php echo $caption; ?></div>
                                            <?php }?>

                                            <img class="lazy" src="<?php echo $src; ?>"  data-original="<?php echo $thumbnail_url[0]; ?>" alt="<?php echo $caption; ?>" width="<?php echo $thumbnail_url[1]; ?>" height="<?php echo $thumbnail_url[2]; ?>" data-width="<?php echo $thumbnail_url[1]; ?>" data-height="<?php echo $thumbnail_url[2]; ?>" />
                                        
                                            <?php if( options::logic( 'blog_post' , 'enb_lightbox' )  && $custom_link_db == ''){ ?>
                                            <div class="zoom-image">
                                                <a href="<?php echo $full_img_url; ?>" data-rel="prettyPhoto[<?php echo $pretty_colection_id; ?>]" title="<?php echo $caption; ?>">&nbsp;</a>
                                            </div>
                                            <?php } else if ($custom_link_db != '') { ?>
                                                       
                                                    <div class="custom-link">
                                                        <div class="icon-link"></div>
                                                        <a  href="<?php echo $custom_link_db;?>" <?php echo $tab; ?> >&nbsp;</a>
                                                    </div>

                                            <?php    }

                                            if (options::logic('styling', 'stripes')) {  ?>
                                                <div class="stripes" >&nbsp;</div>
                                            <?php }?>
                                        <?php }?>
                                    </li>   
                            <?php      
                                    $li_item = ob_get_clean();

                                    if($counter < $images_to_show_first){
                                        // we output the first X images
                                        $src = $thumbnail_url[0]; 
                                        echo $li_item;
                                    }else{
                                        // the other images are stored into a string
                                        $additional_items .= $li_item;
                                        
                                    }
                                    $counter++;      
                                }
                            ?>  
                        </ul>
                        <?php
                            if( strlen( $additional_items) ){
                                //if there are any images in the additional items, then we will create a hidded DIV with this images
                                echo '<div class="additional_items" style="display:none">'.$additional_items.'</div>';
                            }
                        ?>
                    </div>
                    <div class="scrollbar">
                        <div class="handle">
                            <div class="mousearea"></div>
                        </div>
                    </div>
                    <div class="controls center">
                        <button class="btn prev"><i class="icon-prev"></i></button>
                        <button class="btn next"><i class="icon-next"></i></button>
                    </div>
                </div>
            <?php    
            }else{
                ?>
                    <div class="entry-header noimages" >
                        <div class="frame" id="centered">
                            <h3><?php _e('There are no images attached to this gallery','cosmotheme'); ?></h3>
                            
                        </div>
                    </div>
                <?php
            }    
        
        }


        /*generates content for gallery slider when 'mosaic' mode is set*/
        static function get_post_img_mosaic($post_id){


            /*check the meta data where the attached image ids are stored*/

            $post_image_gallery_meta = get_post_meta( $post_id, '_post_image_gallery', true );

            if(strlen($post_image_gallery_meta) && 'Array' != $post_image_gallery_meta){
                $product_image_gallery = $post_image_gallery_meta;

                $img_id_array = array_filter( explode( ',', $product_image_gallery ) );
            }else{
                //backward compatibility with version prev to 1.1
                $attachet_gallery_ids = meta::get_meta( $post_id, 'imagesattached' );

                if(isset($attachet_gallery_ids['img_ids']) && strlen($attachet_gallery_ids['img_ids'])){
                    /*mata is stored as a string of numbers separated by comma (ex: 909,914,913,912,911,910,908)*/
                    $img_id_array =  explode(',', $attachet_gallery_ids['img_ids']);  //create an array from the string

                    
                }
            }

            if(isset($img_id_array) && is_array($img_id_array)){
                foreach ($img_id_array as $value) {
                    $attachments[$value] = $value; // create attachments array in the format that will work for us                    
                }
            }
                

            if(!isset($attachments)){ // if no meta is attached to the post then the gallery wil be created from attached images
                $attachments = get_children(array('post_parent' => $post_id,
                        'post_status' => 'inherit',
                        'post_type' => 'attachment',
                        'post_mime_type' => 'image',
                        'order' => 'ASC',
                        'orderby' => 'menu_order ID'));    
            }

            if( isset($attachments) && count($attachments) > 0){


                $meta = meta::get_meta( $post_id , 'gallerytype') ;

                if ('yes' == $meta['show_slide_btn']) {
                    self::show_gallery_slideshow($attachments);
                }

            ?>
                <div class=" row mosaic-view thumb-view gallery-mosaic-view">
                <?php
                 if ('yes' == $meta['show_slide_btn']) { ?>
                    <div id="show-gal-slideshow" class="icon-play shake animated"></div>
                <?php 
                } ?>
            
                    <div class="twelve columns">
                        <div class="row masonry for-mosaic" >
            <?php
                        $counter = 0;
                        $pretty_colection_id = mt_rand(0,99999);     

                        if ('yes' == $meta['randomize_image']) {
                            $attachments = post::shuffle_assoc($attachments);
                        }

                         if ('yes' == $meta['reverse_order']) {
                            $attachments = array_reverse($attachments, true);
                        }


                        foreach($attachments as $att_id => $attachment) {
                            $options =  array('post_number' => $counter);

                            $caption = post::check_alt_text($att_id); 

                            //------------------------------------
                            $default_options = array('post_number' => 0); /*default options*/
                            
                            extract( $options ); /*extract the passed options*/
                            extract( $default_options, EXTR_PREFIX_SAME, "default"); /* eXtract default options with 'default' prefix in case the option with the same name was already passed */
                            

                            
                            $position_info = post::get_mosaicinfo_by_order($post_number % 12);
                            $container_width = $position_info['width'];
                            $thumb_size = $position_info['thumb_size'];
                            $container_class = $position_info['container_class'];

                            if( trim($container_class) == 'large-mosaic-elem'){
                                $thumb_width = 720;
                                $thumb_height = 720;
                                $thumb_no_img = 'thumb-transparent-img.png';
                            }elseif(trim($container_class) == 'long-mosaic-elem'){
                                $thumb_width = 340;
                                $thumb_height = 720;
                                $thumb_no_img = 'no-img-long.png';
                            }else{
                                $thumb_width = 340;
                                $thumb_height = 340;
                                $thumb_no_img = 'thumb-transparent-img.png';
                            }

                            $no_img_class = '';

                            if(options::logic( 'blog_post' , 'disable_hover_effect' )){
                                $disable_hover_effect = '';
                            } else { $disable_hover_effect = 'hovermove'; }

                            $custom_fields = get_post_custom($att_id);
                            //deb::e($custom_fields);
                            $custom_link_db = '';
                            $custom_link_tab = '';
                            $tab = '';
                            if (isset($custom_fields['custom_link'])) {
                                $custom_link_db = $custom_fields['custom_link'][0];
                                $custom_link_tab = $custom_fields['custom_link_tab'][0];

                                $tab = $custom_link_tab == 'yes' ? 'target="_blank"' : '';
                            }

                        ?>
                            <div class="masonry_elem <?php echo $container_width; ?> columns">
                                <div class="thumb-elem  <?php echo $disable_hover_effect?> <?php echo $container_class; ?> large-mosaic-elem">
                                    
                                    <header class="thumb-elem-header">
                                        <div  class="featimg ">
                                            
                                            <?php

                                                
                                                $size = 'grid_small';     
                                                
                                                $img_url = wp_get_attachment_url( $att_id ,'full'); //get img URL
                                           
                                                $img_src = aq_resize( $img_url, get_aqua_size($thumb_size), get_aqua_size($thumb_size, 'height'), true, false); //crop img
                                                //====================
                                                //$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ) , $thumb_size );
                                            
                                                $img_width = $img_src[1];
                                                $img_height = $img_src[2];
                                                
                                                if($img_width != $thumb_width || $img_height != $thumb_height){
                                                    /*if the image doesn't have the requested size then we will add a transparent square image and will give position absolute to the original image*/
                                                    $original_img_style = 'style="position:absolute"';
                                                }else{
                                                    $original_img_style = '';
                                                }
                                            ?>
                                                <img class="the-thumb" src="<?php echo $img_src[0]; ?>" alt=""  style="position:absolute" />
                                                <img src="<?php echo get_template_directory_uri() ?>/images/<?php echo $thumb_no_img;  ?>" alt="<?php echo $caption; ?>" />
                                                
                                                <?php if( options::logic( 'blog_post' , 'enb_lightbox' )  && $custom_link_db == ''){ ?>
                                                <div class="zoom-image">
                                                    <a href="<?php echo $img_url; ?>" data-rel="prettyPhoto[<?php echo $pretty_colection_id; ?>]" title="<?php echo $caption; ?>">&nbsp;</a>
                                                </div>
                                                <?php } else if ($custom_link_db != '') { ?>
                                                   
                                                <div class="custom-link">
                                                    <div class="icon-link"></div>
                                                    <a  href="<?php echo $custom_link_db;?>" <?php echo $tab; ?> >&nbsp;</a>
                                                </div>

                                            <?php    } ?>
                                              
                                            
                                        </div>
                                    </header>
                                
                                </div>
                            </div>
                        <?php

                        
                            $counter ++;
                        }

            ?>
                        </div>
                    </div>
                </div>
            <?php
            }else{
                _e('This gallery has no images attached', 'cosmotheme');
            }
        } 

        /*generates content for gallery slider when 'image flow' mode is set*/
        static function get_post_img_flow_slide($post_id, $size="single_gallery"){
            /*check the meta data where the attached image ids are stored*/

            if ( metadata_exists( 'post', $post_id, '_post_image_gallery' ) ) {

                $product_image_gallery = get_post_meta( $post_id, '_post_image_gallery', true );

                $img_id_array = array_filter( explode( ',', $product_image_gallery ) );
            }else{
                //backward compatibility with version prev to 1.1
                $attachet_gallery_ids = meta::get_meta( $post_id, 'imagesattached' );

                if(isset($attachet_gallery_ids['img_ids']) && strlen($attachet_gallery_ids['img_ids'])){
                    /*mata is stored as a string of numbers separated by comma (ex: 909,914,913,912,911,910,908)*/
                    $img_id_array =  explode(',', $attachet_gallery_ids['img_ids']);  //create an array from the string

                    
                }
            }

            
            if(isset($img_id_array) && is_array($img_id_array)){
                foreach ($img_id_array as $value) {
                    $attachments[$value] = $value; // create attachments array in hte format that will work for us                    
                }
            }
                

            if(!isset($attachments)){ // if no meta is attached to the post then the gallery wil be created from attached images
                $attachments = get_children(array('post_parent' => $post_id,
                        'post_status' => 'inherit',
                        'post_type' => 'attachment',
                        'post_mime_type' => 'image',
                        'order' => 'ASC',
                        'orderby' => 'menu_order ID'));    
            }
            


            
            if(count($attachments) > 0){

                $meta = meta::get_meta( $post_id , 'gallerytype') ;

                if ('yes' == $meta['show_slide_btn']) {
                    self::show_gallery_slideshow($attachments);
                }

                if ('yes' == $meta['show_slide_btn']) { ?>
                    <div id="show-gal-slideshow" class="icon-play shake animated"></div>
                <?php 
                } 

               ?>
                <div id="cosmoImageFlow" class="imageflow">
               <?php 


                if ('yes' == $meta['randomize_image']) {
                    $attachments = post::shuffle_assoc($attachments);
                }

                if ('yes' == $meta['reverse_order']) {
                    $attachments = array_reverse($attachments, true);
                }

                foreach($attachments as $att_id => $attachment) {
                    $full_img_url = wp_get_attachment_url($att_id);

                    $thumbnail_url = aq_resize( $full_img_url, get_aqua_size($size), get_aqua_size($size, 'height'), false, false ); //resize img, Return an array containing url, width, and height.

                    //$thumbnail_url= wp_get_attachment_image_src( $att_id, $size);
                    //deb::e($thumbnail_url);
                    $src = $thumbnail_url[0]; // for the first X images we will give original img src

                    $caption = post::check_alt_text($att_id); 

                    ?>
                        <img src="<?php echo $src; ?>" longdesc="<?php echo $full_img_url; ?>" width="<?php echo $thumbnail_url[1]; ?>" height="<?php echo $thumbnail_url[2]; ?>" alt="<?php echo $caption; ?>" />

                    <?php

                }
                ?>
                </div>
                <?php 
            
            }
        }

        /* generates content for vertical image scroll gallery */
        static function get_post_img_vertical_scroll($post_id, $size="gallery_format_slider"){

        if( strlen(options::get_value( 'blog_post' , 'vertical_gallery_img_margin' ) ) ){
            echo '<style> .vertical-gallery .verticalslider .vertical-image:not(:first-child) { margin-top: '. options::get_value( 'blog_post' , 'vertical_gallery_img_margin' )  .'px; } </style>';
        }else{
            //images will have no space between
        }

            /*check the meta data where the attached image ids are stored*/
            if ( metadata_exists( 'post', $post_id, '_post_image_gallery' ) ) {

                $product_image_gallery = get_post_meta( $post_id, '_post_image_gallery', true );

                $img_id_array = array_filter( explode( ',', $product_image_gallery ) );
            }else{
                //backward compatibility with version prev to 1.1
                $attachet_gallery_ids = meta::get_meta( $post_id, 'imagesattached' );

                if(isset($attachet_gallery_ids['img_ids']) && strlen($attachet_gallery_ids['img_ids'])){
                    /*mata is stored as a string of numbers separated by comma (ex: 909,914,913,912,911,910,908)*/
                    $img_id_array =  explode(',', $attachet_gallery_ids['img_ids']);  //create an array from the string

                    
                }
            }

            
            if(isset($img_id_array) && is_array($img_id_array)){
                foreach ($img_id_array as $value) {
                    $attachments[$value] = $value; // create attachments array in hte format that will work for us                    
                }
            }
                

            if(!isset($attachments)){ // if no meta is attached to the post then the gallery wil be created from attached images
                $attachments = get_children(array('post_parent' => $post_id,
                        'post_status' => 'inherit',
                        'post_type' => 'attachment',
                        'post_mime_type' => 'image',
                        'order' => 'ASC',
                        'orderby' => 'menu_order ID'));    
            }

            if(count($attachments) > 0){

                $pretty_colection_id = mt_rand(0,9999);
               ?>
                <noscript>
                    <style>
                        body.single-gallery .main-container {
                            opacity: 1;
                        }
                    </style>
                </noscript>
                <div class="vertical-gallery columns" class="entry-header">
                    <div class="verticalslider">
                       <?php 

                        $meta = meta::get_meta( $post_id , 'gallerytype') ;

                        if ('yes' == $meta['show_slide_btn']) {
                            self::show_gallery_slideshow($attachments);
                        }

                        if ('yes' == $meta['show_slide_btn']) { ?>
                            <div id="show-gal-slideshow" class="icon-play shake animated"></div>
                        <?php 
                        } 

                        if ('yes' == $meta['randomize_image']) {
                            $attachments = post::shuffle_assoc($attachments);
                        }

                        if ('yes' == $meta['reverse_order']) {
                            $attachments = array_reverse($attachments, true);
                        }

                
                        foreach($attachments as $att_id => $attachment) {
                            $full_img_url = wp_get_attachment_url($att_id);

                            $thumbnail_url = aq_resize( $full_img_url, get_aqua_size($size), get_aqua_size($size, 'height'), false, false ); //resize img, Return an array containing url, width, and height.

                                $src = $thumbnail_url[0]; // for the first X images we will give original img src
                                //$dumb_src = get_template_directory_uri().'/images/grey.gif';  // for the rest of the images we will load a 1px image to not load the page

                            $attachment_info = get_post($att_id); //deb::e($attachment_info);
                            $alt = get_post_meta($att_id, '_wp_attachment_image_alt', true);

                            $caption = post::check_alt_text($att_id); 
                            

                            $custom_fields = get_post_custom($att_id);
                            $video_link_db = '';
                            if (isset($custom_fields['video_link'])) {
                                $video_link_db = $custom_fields['video_link'][0];
                               // var_dump($video_link_db);
                            }
                    
                            $pos = '';
                            if( !empty( $video_link_db )){
                                $pos = strpos($video_link_db, 'iframe');
                            }

                            //checking if $caption is a link or an iframe
                            $embed_code = '';

                            if( !empty($video_link_db) && filter_var($video_link_db, FILTER_VALIDATE_URL)){ 

                                $embed_code = wp_oembed_get($video_link_db); //it's a link
                              
                              //check if it's an iframe
                            } else if ( isset($pos) && $pos == 1 ) {

                                $embed_code = $video_link_db; //it's an iframe

                            }

                            $custom_link_db = '';
                            $custom_link_tab = '';
                            $tab = '';

                            if (isset($custom_fields['custom_link'])) {
                                $custom_link_db = $custom_fields['custom_link'][0];
                                $custom_link_tab = $custom_fields['custom_link_tab'][0];

                                $tab = $custom_link_tab == 'yes' ? 'target="_blank"' : '';
                            }

                            ob_start();
                            ob_clean(); 
                            ?>

                            
                            <div class="vertical-image">

                                    <?php //if there is a video, we print the video instead the image
                                    if ($embed_code != FALSE && $embed_code != '') {
                                       ?>
                                        <div class="video-container">
                                            <?php echo $embed_code; ?>
                                        </div>
                                   <?php } else { ?>
                                        <div class="image-container">
                                            <img class="slide-image" src="<?php echo $src; ?>" data-original="<?php echo $src; ?>"  alt="<?php echo $alt; ?>" />

                                            <?php if( options::logic( 'blog_post' , 'enb_lightbox' )  && $custom_link_db == ''){ ?>
                                                <div class="zoom-image">
                                                    <a href="<?php echo $full_img_url; ?>" data-rel="prettyPhoto[<?php echo $pretty_colection_id; ?>]" title="<?php echo $caption; ?>">&nbsp;</a>
                                                </div>
                                                <?php } else if ($custom_link_db != '') { ?>
                                                   
                                                <div class="custom-link">
                                                    <div class="icon-link"></div>
                                                    <a  href="<?php echo $custom_link_db;?>" <?php echo $tab; ?> >&nbsp;</a>
                                                </div>

                                            <?php } ?>
                                        </div> 
                                    <?php }?>
                                    
                            </div>
                            <?php

                            $li_item = ob_get_clean();
                            
                            echo $li_item;


                        }
                
                        ?>
                    </div>
                </div>
                <?php 
            
            } 

        }


        /*generates content for gallery slider when 'clasic' or 'folio' mode is set*/
        static function get_post_gallery_slide($post_id, $size="gallery_format_slider"){

            /*check the meta data where the attached image ids are stored*/
            if ( metadata_exists( 'post', $post_id, '_post_image_gallery' ) ) {

                $product_image_gallery = get_post_meta( $post_id, '_post_image_gallery', true );

                $img_id_array = array_filter( explode( ',', $product_image_gallery ) );
            }else{
                //backward compatibility with version prev to 1.1
                $attachet_gallery_ids = meta::get_meta( $post_id, 'imagesattached' );

                if(isset($attachet_gallery_ids['img_ids']) && strlen($attachet_gallery_ids['img_ids'])){
                    /*mata is stored as a string of numbers separated by comma (ex: 909,914,913,912,911,910,908)*/
                    $img_id_array =  explode(',', $attachet_gallery_ids['img_ids']);  //create an array from the string

                    
                }
            }

            
            if(isset($img_id_array) && is_array($img_id_array)){
                foreach ($img_id_array as $value) {
                    $attachments[$value] = $value; // create attachments array in hte format that will work for us                    
                }
            }

            if(!isset($attachments)){ // if no meta is attached to the post then the gallery wil be created from attached images
                $attachments = get_children(array('post_parent' => $post_id,
                        'post_status' => 'inherit',
                        'post_type' => 'attachment',
                        'post_mime_type' => 'image',
                        'order' => 'ASC',
                        'orderby' => 'menu_order ID'));    
            }
            
            
            if(count($attachments) > 0){

                $settings = meta::get_meta( $post_id , 'settings' );

                $meta = meta::get_meta( $post_id , 'gallerytype') ;

                if ('yes' == $meta['show_slide_btn']) {
                    self::show_gallery_slideshow($attachments);
                }

                if ('yes' == $meta['show_slide_btn']) { ?>
                    <div id="show-gal-slideshow" class="icon-play shake animated"></div>
                <?php 
                }  

                if( options::logic( 'blog_post' , 'enb_lightbox' ) ){ ?>
                    <div class="zoom-image hiddenq">
                        <a href="#" data-rel="prettyPhoto[123]" title="title">&nbsp;</a>
                    </div>
                <?php } ?>                  
            <div id="galleria">

                        
            <?php          

                if ('yes' == $meta['randomize_image']) {
                    $attachments = post::shuffle_assoc($attachments);
                }
                if ('yes' == $meta['reverse_order']) {
                    $attachments = array_reverse($attachments, true);
                }

                foreach($attachments as $att_id => $attachment) {
                    $full_img_url = wp_get_attachment_url($att_id);
                    $thumbnail_url = aq_resize( $full_img_url, get_aqua_size($size), get_aqua_size($size, 'height'), false, false ); //resize img, Return an array containing url, width, and height.

                    $attachment_info = get_post($att_id);
                    $img_title = $attachment_info->post_title;

                    $img_caption = post::check_alt_text($att_id);
                    if ( get_posts_gallery_type($post_id) == 'clasic') {
                        $thumbnail_src = wp_get_attachment_image_src( $att_id  , 'thumbnail' );
                    }else{
                        $thumbnail_src = aq_resize( $full_img_url, get_aqua_size('gallery_folio'), get_aqua_size('gallery_folio', 'height'), false, false ); 
                    }
                
            ?>            
                    <a href="<?php echo $thumbnail_url[0]; ?>">
                        <img style="opacity:0;" src="" data-big="<?php echo $thumbnail_url[0]; ?>" data-title="<?php echo $img_title;?>" data-description="<?php echo $img_caption; ?>" alt="<?php echo $img_caption; ?>" />
                    </a> 

            <?php    
                }
            ?>
                    </div>
            <?php  

            }   
        
        }

        static function get_excerpt($post, $ln, $output = true){
            if (!empty($post->post_excerpt)) {
                if (strlen(strip_tags(strip_shortcodes($post->post_excerpt))) > $ln) {
                    $excerpt = mb_substr(strip_tags(strip_shortcodes($post->post_excerpt)), 0, $ln) . '<a href='.get_permalink($post->ID).'> [...]</a>';
                } else {
                    $excerpt = strip_tags(strip_shortcodes($post->post_excerpt));
                }
            } else {
                if (strlen(strip_tags(strip_shortcodes($post->post_content))) > $ln) {
                    $excerpt = mb_substr(strip_tags(strip_shortcodes($post->post_content)), 0, $ln) . '<a href='.get_permalink($post->ID).'> [...]</a>';
                } else {
                    $excerpt = strip_tags(strip_shortcodes($post->post_content));
                }
            }
            if ($output == true) {
                echo $excerpt;
            }else{
                return $excerpt;
            }
            
        }

        static function get_post_views($post_id){
            /*if if stats module from JetPack plugin is enabled, we save number of views in a meta data for the given post */
            if ( function_exists('stats_get_csv')   ){ 
                
                $post_stats = stats_get_csv( 'postviews' , "&post_id=" . $post_id);    
                
                if ( is_array( $post_stats ) && sizeof( $post_stats ) ) { 
                    foreach ( $post_stats as $post ){ 
                        if( isset($post['views']) ){
                            update_post_meta($post_id, 'nr_views', $post['views']);
                        }
                    }
                }
            }
        }


        /*outputs the number of comments for a given post */
        static function get_post_comment_number($post_id,$show_label = false){
            if (comments_open($post_id)) {
                $comments_label = __('replies','cosmotheme');
                if (options::logic('general', 'fb_comments')) {
                    ?>
                            <li class="replies" title="">
                                <a href="<?php echo get_comments_link($post_id); ?>" >
                                    <span></span>
                                    <fb:comments-count href="<?php echo get_permalink($post_id) ?>"></fb:comments-count>
                                    <?php if($show_label){ ?>
                                    <span><?php echo $comments_label; ?></span>
                                    <?php } ?>
                                </a>
                            </li>
                    <?php
                } else {
                    if(get_comments_number($post_id) == 1){
                        $comments_label = __('reply','cosmotheme');    
                    }
                    ?>
                            <li class="comments" title="<?php echo get_comments_number($post_id); ?> Comments">
                                <a href="<?php echo get_comments_link($post_id); ?>" >
                                    <span></span>
                                    <?php echo get_comments_number($post_id) ?>
                                    <?php if($show_label){ ?>
                                    <span class="comments_label"><?php echo $comments_label; ?></span>
                                    <?php } ?>
                                </a>
                            </li>
                    <?php
                }
            }
        }

        /*outputs the number of views for a given post */
        static function get_views_number_html($post_id,$show_label = false){

            if ( function_exists( 'stats_get_csv' ) ){  
            $views = stats_get_csv( 'postviews' , "&post_id=" . $post_id);    
        ?>
            <li class="views">
                <a href="<?php echo get_permalink($post_id); ?>" class="views">    
                    <span></span>
                    <?php echo (int)$views[0]['views']; ?>

                    <?php if($show_label){ ?>
                    <span class="views_label">
                    <?php
                        if( (int)$views[0]['views'] == 1) {
                            _e( 'view' , 'cosmotheme');
                        }else{
                            _e( 'views' , 'cosmotheme' );
                        } 
                    ?>
                    </span>
                    <?php } ?>
                </a>
            </li>
        <?php }
        }

        static function box_view($post,  $width = 'three columns', $additiona_class = '') {

            $info_meta = meta::get_meta( $post -> ID , 'info' );

            /*if(isset($info_meta['background_color'])){
                $box_bg_color = $info_meta['background_color'];
            }else{
                $box_bg_color = ' #f5f5f5 ';
            }

            if(isset($info_meta['text_color']) && strlen(trim($info_meta['text_color']))){
                $box_text_color = $info_meta['text_color'];
            }else{
                $box_text_color = '  #000 ';
            }*/

            if( has_post_thumbnail( $post -> ID  ) ){ 
                $box_img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ), 'tlist' );
                $box_img_src = $box_img_src[0];
            }else{
                $box_img_src = '';
            }

            $link_start = '';
            $link_end = '';
            if(isset($info_meta['box_link']) && post::isValidURL($info_meta['box_link']) ){
                $link_start = '<a href="'.$info_meta['box_link'].'">';
                $link_end = '</a>';
            }

            $custom_class = '';
            if(isset($info_meta['custom_css']) && strlen(trim($info_meta['custom_css'])) ){
                $custom_class = $info_meta['custom_css'];
            }
            ?>
        <div class="cosmobox <?php echo $width .' '.$additiona_class.' '.$custom_class; ?>">
            <article class="box ">
                <?php if(strlen($box_img_src)){ ?>
                    <header>
                        <div class="featimg">
                            <?php
                            echo $link_start;
                            ?>
                            <img src="<?php echo $box_img_src; ?>" alt="<?php echo $post->post_title; ?>"/>
                            <?php
                            echo $link_end;
                            ?>
                        </div>
                    </header>
                
                <?php } ?>
                <div class="entry-content">
                    <ul>
                        <li class="entry-content-title"><h4><?php echo $link_start . $post -> post_title . $link_end; ?></h4></li>
                        <li class="entry-content-excerpt"><?php echo $post -> post_content; ?></li>
                    </ul>
                </div>
            </article>
        </div>

        <?php
        }


    static function render_team( $team, $options, $is_first_child ){
        extract( $options );

        $default_meta = array(
            'img_id' => 0            
        );
        $meta = meta::get_meta( $team -> ID, 'info' );
        foreach( $meta as $entry_key => $entry_value ){
            if( strlen( $entry_value ) ){
                $default_meta[ $entry_key ] = $entry_value;
            }
        }


        extract( $default_meta );
        if( has_post_thumbnail( $team -> ID  ) ){ 

            $size = 'grid_small';     
                            
            $img_url = wp_get_attachment_url( get_post_thumbnail_id( $team -> ID )  ,'full'); //get img URL
       
            $img = aq_resize( $img_url, get_aqua_size($size), get_aqua_size($size, 'height'), true, true); //crop img

        }else{
            $img = get_template_directory_uri() . '/images/default_avatar_100.jpg';
        }

           $networks = array();
           $networks = $default_meta; 
           unset($networks['img_id']); 
        ?>
        <div class="<?php echo $columns;?> columns">
            <article class="team-text-main">
                <header>
                    <div class="featimg">
                        <img src="<?php echo $img;?>" alt="<?php echo $team -> post_title;?>" />
                        <?php if( !empty($networks) ){ ?>
                        <div class="socialicons">
                            <ul class="cosmo-social"> <?php 

                                foreach ($networks as $key => $value) { 
                                    if ( strlen($value) < 2) continue;
                                    ?>
                                    <li>
                                        <a href="<?php echo $value;?>" class="<?php echo $key; ?>"><i class="icon-<?php echo $key;  ?>"></i></a>
                                    </li>

                                <?php } ?>   
                            </ul>
                        </div>
                        <?php } ?>
                    </div>
                </header>
                <div class="entry-content">
                    <ul>
                        <li class="entry-content-name"><h4><?php echo $team -> post_title;?></h4></li>
                        <li class="entry-content-function"><?php echo $team -> post_content;?></li>
                    </ul>
                </div>
            </article>
        </div>
        <?php
    }

        static function list_meta_single($post){
            $post_id = $post -> ID;
            if (comments_open($post -> ID) || function_exists( 'stats_get_csv' ) || options::logic( 'likes' , 'enb_likes' ) ) {
            ?>    
            <div class="entry-info">
                <ul class="">
                    <?php
                        if (comments_open($post_id)) {
                            if (options::logic('general', 'fb_comments')) {
                                ?>
                                        <li class="metas-big" title="">
                                            <a href="<?php echo get_comments_link($post_id); ?>" >
                                                <span class="comments">
                                                    <em><?php _e('Comments','cosmotheme'); ?></em>
                                                    <i><fb:comments-count href="<?php echo get_permalink($post_id) ?>"></fb:comments-count></i>
                                                </span>
                                            </a>
                                        </li>
                                <?php
                            } else {
                                if(get_comments_number($post_id) == 1){
                                    $comments_label = __('reply','cosmotheme');    
                                }
                                ?>
                                    <li class="metas-big" title="">
                                        <a href="<?php echo get_comments_link($post_id); ?>" >
                                            <span class="comments">
                                                <em><?php _e('Comments','cosmotheme'); ?></em>
                                                <i><?php echo get_comments_number($post_id) ?></i>
                                            </span>
                                        </a>
                                    </li>    
                                <?php
                            }
                        }
                    ?>
                    
                    <?php
                        if ( function_exists( 'stats_get_csv' ) ){  
                        $views = stats_get_csv( 'postviews' , "&post_id=" . $post_id);    
                    ?>
                    <li class="metas-big">
                        <a href="<?php echo get_permalink($post_id); ?>" >
                            <span class="views">
                                <em><?php _e('Views','cosmotheme'); ?></em>
                                <i><?php echo (int)$views[0]['views']; ?></i>
                            </span>
                        </a>
                    </li>
                    <?php } ?>
                    <?php 
                        if( options::logic( 'likes' , 'enb_likes' ) ){ 
                        //$icon_type = options::get_value( 'likes' , 'icons' ); /*for example heart, star or thumbs*/  
                    ?>
                    
                    <li class="metas-big <?php //echo $icon_type; ?>">
                        <?php like::content($post->ID,$return = false, $show_icon = true, $show_label = true);  ?>
                    </li>
                    <?php } ?>
                </ul>
            </div>

            <?php                            
            }
        }

        
        /**
         * This function will receive the skin name entered by user and will return a 'clean'  name
         * that can be used as a css class
         *
         * @param int $post_id - the ID of the option  -> will be used to create class name
         * @param string $setting_name - the name of the setting you want to receive
         * @param string $default_value - the default value that will be returned if the needed setting was not saved yet (posts were created before installing the theme)
         *      
         * @return various - the value of the requested option
         */
        static function get_post_setting($post_id, $setting_name, $default_value){
            $meta = meta::get_meta( $post_id, 'settings' );
            if(isset($meta[$setting_name]) && strlen($meta[$setting_name])){
                return $meta[$setting_name];
            }else{
                return $default_value;
            }
        }

        static function get_post_format_link($post_id){
      
            $result = '';    
            $format = get_post_format( $post_id );
            $format_link = get_post_format_link($format);
            if(!strlen($format_link)){
                $format_link = "javascript:void(0);";
            }

            switch ($format) {
                case 'video':
                    $result = '<a class="entry-format" href="'.$format_link.'"><i class="icon-video"></i></a>';
                    break;
                case 'image':
                    $result = '<a class="entry-format" href="'.$format_link.'"><i class="icon-image"></i></a>';
                    break;
                case 'audio':
                    $result = '<a class="entry-format" href="'.$format_link.'"><i class="icon-audio"></i></a>';
                    break;
                case 'link':
                    $result = '<a class="entry-format" href="'.$format_link.'"><i class="icon-attachment"></i></a>';
                    break;    
                case 'gallery':
                    $result = '<a class="entry-format" href="'.$format_link.'"><i class="icon-gallery"></i></a>';
                    break;  
                case 'quote':
                    $result = '<a class="entry-format" href="'.$format_link.'"><i class="icon-quote"></i></a>';
                    break;                            
                default:
                    $result = '<a class="entry-format" href="'.$format_link.'"><i class="icon-standard"></i></a>';
                    break;
            }

            return $result;
        }  

        static function video_post_click($post){
            /* check and initialize play action for video posts, if not video post the function will return false */

            if( get_post_format( $post -> ID ) == 'video' ){
                $format = meta::get_meta( $post -> ID , 'format' );

                if( isset( $format['feat_id'] ) && !empty( $format['feat_id'] ) )
                  {
                    $video_id = $format['feat_id'];
                    $video_type = 'self_hosted';
                    if(isset($format['feat_url']) && post::isValidURL($format['feat_url']))
                      {
                        $vimeo_id = post::get_vimeo_video_id( $format['feat_url'] );
                        $youtube_id = post::get_youtube_video_id( $format['feat_url'] );
                        
                        if( $vimeo_id != '0' ){
                          $video_type = 'vimeo';
                          $video_id = $vimeo_id;
                        }

                        if( $youtube_id != '0' ){
                          $video_type = 'youtube';
                          $video_id = $youtube_id;
                        }
                      }
    
                    if($video_type == 'self_hosted'){
                        $onclick = 'playVideo("'.urlencode(wp_get_attachment_url($video_id)).'","'.$video_type.'",jQuery(this).parents(".featimg"),jQuery(this).parent().width(),jQuery(this).parent().width())';
                    }else{
                        $onclick = 'playVideo("'.$video_id.'","'.$video_type.'",jQuery(this).parents(".featimg"),jQuery(this).parent().width(),jQuery(this).parent().width())';
                    }    
                    
                }
            }

            if(isset($onclick)){
                return  $onclick;
            }else{
                return  false;
            }
        }

        static function add_to_wishlist(){
            global $product;
            $response = array();
            $product = get_product($_POST[ 'product_id' ]);
            //var_dump($product);
            if(isset($_POST['action']) ){
                $product_info = $product->post;
                $id = $_POST[ 'product_id' ];

                $response['product_row'] = '<tr id="rowid_'.$product_info -> ID .'">';
                $response['product_row'] .= '<td class="product-remove"><div><a href="javascript:void(0)" onClick="remove_item_from_wlist(rowid_'.$product_info -> ID.');" class="remove" title="'. __("Remove this item", "cosmotheme").'">&times;</a></td>';
                $response['product_row'] .= '<td class="product-thumbnail">
                                        <a href="'. esc_url( get_permalink(apply_filters('woocommerce_in_cart_product', $product_info -> ID)) ).'">
                                        '. $product->get_image().'
                                        </a>
                                    </td>';
                $response['product_row'] .= '<td class="product-name">
                                        <a href="'. esc_url( get_permalink(apply_filters('woocommerce_in_cart_product', $product_info -> ID)) ).'">'.$product_info -> post_title.'</a>

                                    </td>';
                $response['product_row'] .= '<td class="product-price">';
                                            
                if (get_option('woocommerce_display_cart_prices_excluding_tax')==true) :
                    $price = apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $product->get_price_excluding_tax() ), $product, '' ); 
                else :
                    $price = apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $product->get_price() ), $product, '' ); 
                endif;

                if($price){
                    $response['product_row'] .= $price; 
                }

                $response['product_row'] .= '</td>';
                $response['product_row'] .= '<td>';
                                       
                $availability = $product->get_availability();
                $stock_status = $availability['class'];
                
                if($stock_status == 'out-of-stock' ) {
                    $stock_status="Out";
                    $response['product_row'] .= "Out Of Stock";
                } else {
                    $stock_status="In";
                        $response['product_row'] .= "In Stock";
                }
                                        
                                        
                $response['product_row'] .= '</td>';
                ob_start();
                ob_clean();
                get_template_part('/woocommerce/loop/add-to-cart');
                $add_to_cart_btn = ob_get_clean();

                $response['product_row'] .= '<td>'.$add_to_cart_btn.'</td>';
                $response['product_row'] .= '</tr>';

                $response['product_id'] = $id;
                $response['post_title'] = $product_info->post_title;
            }

            echo json_encode($response);
            exit;    
        }

        static function remove_from_wishlist(){
            global $product;
            $response = array();
            $product = get_product($_GET[ 'product_id' ]);

            if(isset($_GET['action']) ){

                $product_info = $product->post;
                $id = $_GET[ 'product_id' ];   
                $response['product_id'] = $id;
                $response['post_title'] = $product_info->post_title;
                if (get_page_by_title( 'shop' )) {
                    $shop_page = get_page_by_title( 'shop' );
                    $url = __('Browse the ', 'cosmotheme') .'<a href="'. get_permalink( $shop_page -> ID) .'">'. __('shop page', 'cosmotheme').'</a>'; 
                }else{
                    $url = '';
                }
                
                $response['no_prod'] = '<tr><td colspan="6"><center> '.__('No products were added to wish list. ' , 'cosmotheme') . $url . '</center></td></tr> ';  
            }

            echo json_encode($response);
            exit;    
        }


        /*shuffle an associative array preserving keys*/

        static function shuffle_assoc($array) {
            $keys = array_keys($array);

            shuffle($keys);

            foreach($keys as $key) {
                $new[$key] = $array[$key];
            }

            return $new;
        }


        static function show_gallery_slideshow($attachments = false){
            if ($attachments){ ?>
                <div class="slideshow-gal-full">
                    <div class="next-slide-image icon-next"></div>
                    <div class="prev-slide-image icon-prev"></div>
                    <div class="slide-close icon-close"></div>
                    <div class="slide-playpause icon-pause"></div>
                    <div id="maximage">

                        <?php
                        wp_enqueue_script( 'maximage_handle' );
                        wp_enqueue_script( 'cycle_handle' );

                        foreach($attachments as $att_id => $attachment) {
                            $full_img_url = wp_get_attachment_url($att_id);
                            ?>
                           
                            <img data-src="<?php echo $full_img_url; ?>" src="" alt=""  />
                        

                        <?php    
                        }?>
                    </div>
                </div>

                <?php
            } else {
                return '';
            }

        }

        static function check_alt_text($att_id){
                $attachment_info = get_post($att_id);

                $alt_text_from = options::get_value( 'blog_post' , 'image_alt' );
                switch ($alt_text_from) {
                    case 'title':
                        $result = $attachment_info->post_title; 
                        break;

                    case 'caption':
                        $result = $attachment_info->post_excerpt; 
                        break;
                    
                    default:
                        $result = get_post_meta($att_id , '_wp_attachment_image_alt', true);
                        break;
                }


                return $result;

        }


    }

  
?>