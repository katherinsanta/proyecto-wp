<?php

    /* related posts by herarchical taxonomy */
    /* get tax slugs and number of similar posts  */ 
    function similar_query( $post_id , $taxonomy , $nr ){
        if( $nr > 0 ){
            $topics = wp_get_post_terms( $post_id , $taxonomy );

            $terms = array();
            if( !empty( $topics ) ){
                foreach ( $topics as $topic ) {
                    $term =  $topic;
                    array_push( $terms, $term -> slug );
                }
            }
 
            if( !empty( $terms ) ){
                $query = new WP_Query( array(
                    'post__not_in' => array( $post_id ) ,
                    'posts_per_page' => $nr,
                    'orderby' => 'rand',
                    'post_type' => get_post_type($post_id),
                    'tax_query' => array(
                        array(
                        'taxonomy' => $taxonomy ,
                        'field' => 'slug',
                        'terms' => $terms ,
                        )
                    )
                ));
            }else{
                $query = array();
            }
        }else{
            $query = array();
        }

        return $query;
    }


    $similar_posts_all = array(); 
    $symilar_criteria = options::get_value( 'blog_post' , 'similar_type' );

   // foreach ($symilar_criteria as $criteria) {
        /* post taxonomy */
        $tax = $symilar_criteria;

         

        /*for gallery change taxonimies values*/
        if(get_post_type($post -> ID) == 'gallery'){
            if($tax == 'post_tag'){
                $tax = 'gallery-tag';
            }elseif($tax == 'category'){
                $tax = 'gallery-category';
            }           
        }

        if(strpos($tax,'category') !== false){
            $categ_tax = $tax;
        } 
        
        
        $nr = 3;
        $nr_columns = 4;
            
        if($tax == 'same_author'){
            
            $label = sprintf(__('More projects by %s','cosmotheme'), '<a href="'.get_author_posts_url($post->post_author).'">'.get_the_author_meta('display_name', $post->post_author)).'</a>';
            
            $query = $more_from_same_author = new WP_Query( array(
                                                'author' => $post -> post_author,
                                                'posts_per_page' => $nr,
                                                'post_type' => get_post_type($post -> ID),
                                                'post__not_in' => array($post->ID)
                                                ) );
        }else{
            $label  = __( 'Related Posts' , 'cosmotheme' );
            $query  = similar_query( $post -> ID , $tax , $nr );
            
        }
        
        
        if( !empty( $query ) ){
            if( $query -> found_posts < $nr ){
                $nr = $query -> found_posts;
            }

            $result = $query -> posts;
            $similar_posts_all[] = $result;
        }else{
            $similar_posts_all[] = array();
        }
    //}

    
    
    
    /*test if there are any related posts*/
    $have_related = false;
    foreach ($similar_posts_all as $sim_posts) {
        if( (is_array($sim_posts) && sizeof($sim_posts)) ){
            $have_related = true; 
            break;
        }
    }    


    if( !empty( $similar_posts_all) && $have_related && options::logic( 'blog_post' , 'show_similar' )  &&  meta::logic( $post , 'settings' , 'related' ) || 
        ( get_post_type($post -> ID) == 'gallery' && options::logic( 'blog_post' , 'gallery_related' ) && meta::logic( $post , 'gallerytype' , 'related' ) )  ){

       // $symilar_criteria = options::get_value( 'blog_post' , 'similar_type' );
?>
    <div class="row bottom-separator">
        <div class="twelve columns">
            <div class="related-tabs">
                <?php
                

                    /*get the name of the one of the category*/        
                    $categ = '';
                    if(isset($categ_tax)){  
                               
                        $topics = wp_get_post_terms( $post -> ID , $categ_tax );

                        $terms = array();
                        if( !empty( $topics ) ){
                            foreach ( $topics as $topic ) {
                                $term = $topic;
                                $categ = $term -> name;
                                break;  
                            }
                        }
                    }

                    $same_category_name = sprintf(__('More from %s','cosmotheme'),$categ);
                    $same_author_name = sprintf(__('More by %s','cosmotheme'), get_the_author_meta('display_name', $post->post_author) );

                    $criteria_tab = array('post_tag' => __('Related posts','cosmotheme'),'category' => $same_category_name, 'same_author' => $same_author_name );
                    
                    $tab_label = $criteria_tab[$symilar_criteria] ;
                ?>
                    <h3 class="related-title"><span><?php echo $tab_label; ?></span></h3>    

                <?php        
                ?>
            </div>
            <?php
                if(options::get_value( 'blog_post' , 'similar_view_type' ) == 'thumbnails_view'){
                    $container_class = 'thumb-view';
                }else{
                    $container_class = 'grid-view';
                }
            ?>
            <div class="row <?php echo $container_class; ?> related-posts">
                
                <?php
                    $index = 0;

                    $column_width = 'four';
                ?>
                      
                    <?php
                        if(isset($similar_posts_all[$index]) && is_array($similar_posts_all[$index]) && count($similar_posts_all[$index])){
                    ?>      <div id="related-<?php echo $symilar_criteria; ?>">  
                    <?php            
                            $counter = 1;
                            foreach ($similar_posts_all[$index] as $similar) {
                                
                                if(options::get_value( 'blog_post' , 'similar_view_type' ) == 'thumbnails_view'){
                                    
                                    post::grid_view_thumbnails( $similar, $width = $column_width.' columns', $additiona_class = '', $filter_type = 'sss' );
                                }elseif(options::get_value( 'blog_post' , 'similar_view_type' ) == 'grid_view'){
                                    post::grid_view( $similar, $width = $column_width.' columns', $additiona_class = '', $show_excerpt = true, $show_meta = true, $element_type = 'article', $is_masonry = false, $is_carousel = true );
                                }
                                if( ($counter % $nr_columns) == 0){
                                    echo '<div class="clear"></div>';
                                }
                                $counter ++; 
                            } 
                    ?>
                            </div>
                    <?php                
                        }
                    ?>    
                        
                <?php  
                        $index++;      
                ?>
                
            </div>
        </div>
    </div>

    
<?php

        wp_reset_postdata();
    }
?>