<?php
    
	function ilove__autoload( $class_name ){
        if( substr( $class_name , 0 , 6 ) == 'widget'){
            $class_name = str_replace( 'widget_' , '' ,  $class_name );
            if( is_file( get_template_directory() . '/lib/php/widget/' . $class_name . '.php' ) ){
                include get_template_directory() . '/lib/php/widget/' . $class_name . '.php';

            }
        }
		if( is_file( get_template_directory() . '/lib/php/' . $class_name . '.class.php' ) ){
			include_once get_template_directory() . '/lib/php/' . $class_name . '.class.php';
            if( is_file( get_template_directory() . '/lib/php/' . $class_name . '.register.php' ) ){
				include_once get_template_directory() . '/lib/php/' . $class_name . '.register.php';
			}
		}else if( substr( $class_name, 0, 2 ) == 'LB' ){
            include_once get_template_directory() . '/lib/php/LayoutBuilder/' . $class_name . '.php';
        }
    }

     
	spl_autoload_register ("ilove__autoload");
	
	
    /*register tags and categories taxonomies for gallery posts*/
    $gallery_category = array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x( 'Gallery Category', 'taxonomy general name' ,'cosmotheme' ),
            'singular_name' => _x( 'Gallery Categories', 'taxonomy singular name','cosmotheme' ),
            'search_items' =>  __( 'Search Categories', 'cosmotheme' ),
            'all_items' => __( 'All Categories', 'cosmotheme' ),
            'parent_item' => __( 'Parent Category', 'cosmotheme' ),
            'parent_item_colon' => __( 'Parent Category:', 'cosmotheme' ),
            'edit_item' => __( 'Edit Category', 'cosmotheme' ), 
            'update_item' => __( 'Update Category', 'cosmotheme' ),
            'add_new_item' => __( 'Add New Category', 'cosmotheme' ),
            'new_item_name' => __( 'New Category Name', 'cosmotheme' ),
            'menu_name' => __( 'Category', 'cosmotheme' ),
        ),  
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'gallery-category' ),
    );

    $gallery_tag = array(
        'hierarchical' => false,
        'labels' => array(
            'name' => _x( 'Gallery Tags', 'taxonomy general name','cosmotheme' ),
            'singular_name' => _x( 'Gallery Tag', 'taxonomy singular name','cosmotheme' ),
            'search_items' =>  __( 'Search Tags', 'cosmotheme' ),
            'popular_items' => __( 'Popular Tags', 'cosmotheme' ),
            'all_items' => __( 'All Tags', 'cosmotheme' ),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __( 'Edit Tag', 'cosmotheme' ),
            'update_item' => __( 'Update Tag', 'cosmotheme' ),
            'add_new_item' => __( 'Add New Tag', 'cosmotheme' ),
            'new_item_name' => __( 'New Tag Name', 'cosmotheme' ),
            'separate_items_with_commas' => __( 'Separate tags with commas', 'cosmotheme' ),
            'add_or_remove_items' => __( 'Add or remove tags', 'cosmotheme' ),
            'choose_from_most_used' => __( 'Choose from the most used tags', 'cosmotheme' ),
            'menu_name' => __( 'Tags', 'cosmotheme' ),
          ),
        'show_ui' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array( 'slug' => 'gallery-tag' ),
    );

    register_taxonomy('gallery-category', 'gallery', $gallery_category);
    register_taxonomy('gallery-tag', 'gallery', $gallery_tag);
    /* EOF register tags and categories taxonomies for gallery posts */
     
    
    $labels = array(
        'name' => _x( 'Box Sets', 'taxonomy general name', 'cosmotheme' ),
        'singular_name' => _x( 'Box Set', 'taxonomy singular name', 'cosmotheme' ),
        'search_items' =>  __( 'Search Box Set', 'cosmotheme' ),
        'all_items' => __( 'All Box Sets', 'cosmotheme' ),
        'parent_item' => __( 'Parent Box Set', 'cosmotheme' ),
        'parent_item_colon' => __( 'Parent Box Set:', 'cosmotheme' ),
        'edit_item' => __( 'Edit Box Set', 'cosmotheme' ), 
        'update_item' => __( 'Update Box Set', 'cosmotheme' ),
        'add_new_item' => __( 'Add New Box Set', 'cosmotheme' ),
        'new_item_name' => __( 'New Box Set Name', 'cosmotheme' ),
        'menu_name' => __( 'Box Sets', 'cosmotheme' ),
      );    


    register_taxonomy(
        
    'box-sets',
        'box',
        array(
            'labels' => $labels,
            'rewrite' => array( 'slug' => 'box-sets' ),
            'hierarchical' => true
        )
    );


     $labels = array(
        'name' => _x( 'Groups', 'taxonomy general name', 'cosmotheme' ),
        'singular_name' => _x( 'Group', 'taxonomy singular name', 'cosmotheme' ),
        'search_items' =>  __( 'Search group', 'cosmotheme' ),
        'all_items' => __( 'All group', 'cosmotheme' ),
        'parent_item' => __( 'Parent group', 'cosmotheme' ),
        'parent_item_colon' => __( 'Parent group:', 'cosmotheme' ),
        'edit_item' => __( 'Edit group', 'cosmotheme' ),
        'update_item' => __( 'Update group', 'cosmotheme' ),
        'add_new_item' => __( 'Add new group', 'cosmotheme' ),
        'new_item_name' => __( 'New new Name', 'cosmotheme' ),
        'menu_name' => __( 'Groups', 'cosmotheme' ),
    );

    register_taxonomy(
        'team-group',
        'team',
        array(
            'labels' => $labels,
            'rewrite' => array( 'slug' => 'team-grup' ),
            'hierarchical' => true
        )
    );
                
	    
    
    function get_item_label( $item ){
        $item = basename( $item );
        $item = str_replace( '-' , ' ' , $item );
        return $item;
    }

    function get_item_slug( $item ){
        $item = basename( $item );
        $item = str_replace( '-', '_' , str_replace( ' ', '__' , $item ) );
        return $item;
    }

    function get_subitem_slug( $item , $subitem ){
        $item = get_item_slug( $item );
        $subitem = get_item_slug( $subitem );
        $subitem = $item . FN_DELIM . $subitem;
        return $subitem;
    }

    function get_items( $slug ){
        $items = explode( FN_DELIM , $slug );
        $result = array();
        if( is_array( $items ) ){
            foreach( $items as $item ){
                $result[] = str_replace( '_', '-' , str_replace( '__', ' ' , $item ) );
            }
        }else{
            $result = str_replace( '_', '-' , str_replace( '__', ' ' , $item ) );
        }

        return $result;
    }

    function get_item( $slug ){
        $item = str_replace( '_', '-' , str_replace( '__', ' ' , $slug ) );
        return $item;
    }

    function get_path( $slug ){
        $item = str_replace( '_', '-' , str_replace( '__', ' ' , str_replace( FN_DELIM, '/' , $slug ) ) );
        return $item;
    }

    
    function get__pages( $first_label = 'Select item' ){
        $pages = get_pages();
        $result = array();
        if( is_array( $first_label ) ){
            $result = $first_label;
        }else{
            if( strlen( $first_label ) ){
                $result[] = $first_label;
            }
        }
        foreach($pages as $page){
            $result[ $page -> ID ] = $page -> post_title;
        }

        return $result;
    }

    function get_testimonials($get_testimonials = array(), $testimonial_option = 'slide' ){

        $args = array('post_type' => 'testimonial', 'post__in' => $get_testimonials, 'posts_per_page' => -1);
        $testimonials = new WP_Query($args);
        $rand = mt_rand(0,9999); /*will use this val to avoid having duplicated IDs if 2 testimonials elements are used on the page*/
        if(count($testimonials -> posts)){
            if($testimonial_option == 'slide'){
                $result =  '<ul class="testimonials-carousel">';
                $first_avatar = '';
                
                foreach( $testimonials -> posts as $key => $post ){
                    if( has_post_thumbnail( $post -> ID  ) ){ 
                        $img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ), 'thumbnail' );
                        $img_url = $img_url[0];
                    }else{
                        $img_url = DEFAULT_AVATAR;
                    }

                    $testimonial_info = meta::get_meta( $post->ID, 'info' );

                    if(!strlen($first_avatar)){
                        $first_avatar = $img_url;
                    }
                    if($key == 0) {
                        $first_elem_active = 'active';
                    }else {
                        $first_elem_active = '';
                    }

                    
                    $result .= '<li class="testimonials-carousel-elem '. $first_elem_active. '">';
                    $result .= '<article class="testimonials-elem ">';
                        $result .= '<div class="testimonials-elem-wrapper">';

                            $result .= '<div class="entry-content-excerpt">';
                            $result .= apply_filters('the_content', $post->post_content);
                            $result .= '</div>';

                            $result .= '<div class="entry-content">';
                                $result .= '<div class="featimg"><img src="'. $img_url .'" alt="'. $post->post_title.'" /></div>';
                                $result .= '<ul class="entry-content-list">';                        
                                    $result .= '<li class="entry-content-name"><h4>' . $testimonial_info['name'] . '</h4></li>';
                                    $result .= '<li class="entry-content-function">' . $testimonial_info['title'] . '</li>';
                                $result .= '</ul>';
                            $result .= '<div class="clear"></div></div>';
                        $result .= '</div>';
                    $result .= '<div class="clear"></div></article>'; 
                    $result .= '</li>';                 
                }            

                $result .= '</ul>';
                if (count($testimonials -> posts) > 1 ) {
                    $result .= '<ul class="testimonials-carousel-nav">';
                    $result .= '<li class="testimonials-carousel-nav-left">&larr;</li> ';
                    $result .= '<li class="testimonials-carousel-nav-right">&rarr;</li>';
                    $result .= '</ul>';
                }
                
                echo $result; 
            } else {
                $result =  '<div class="testimonials-list">';
                $first_avatar = '';
                
                foreach( $testimonials -> posts as $key => $post ){
                    if( has_post_thumbnail( $post -> ID  ) ){ 
                        

                        $size = 'grid_small';     
                            
                        $img_url1 = wp_get_attachment_url( get_post_thumbnail_id( $post -> ID )  ,'full'); //get img URL
                   
                        $img_url = aq_resize( $img_url1, get_aqua_size($size), get_aqua_size($size, 'height'), true, true); //crop img

                    }else{
                        $img_url = DEFAULT_AVATAR;
                    }

                    $testimonial_info = meta::get_meta( $post->ID, 'info' );

                    if(!strlen($first_avatar)){
                        $first_avatar = $img_url;
                    }

                    $result .= '<article class="testimonials-elem ">';
                        $result .= '<div class="testimonials-elem-wrapper">';
                            $result .= '<div class="three columns">';
                                $result .= '<div class="featimg"><img src="'. $img_url .'" alt="'. $post->post_title.'" /></div>';
                            $result .= '</div>';

                            $result .= '<div class="nine columns">';
                                $result .= '<ul class="entry-content-list">';                        
                                    $result .= '<li class="entry-content-name"><h4>' . $testimonial_info['name'] . '</h4></li>';
                                    $result .= '<li class="entry-content-function">' . $testimonial_info['title'] . '</li>';
                                $result .= '</ul>';
                                
                                $result .= '<div class="entry-content-excerpt">';
                                $result .= apply_filters('the_content', $post->post_content);
                                $result .= '</div>';
                            $result .= '</div>';


                        $result .= '<div class="clear"></div></div>';
                    $result .= '</article>'; 
                }            

                $result .= '</div>';               
                echo $result; 
            }   
        }else{
            echo '<p class="select">' . __( 'There are no testimonials' , 'cosmotheme' ) . '</p>';
        }
    }

    function get__posts( $args = array() , $first_label = 'Select item' ){
        $posts = get_posts( $args );
        $result = array();
        
        if( is_array( $first_label ) ){
            $result = $first_label;
        }else{
            if( strlen( $first_label ) ){
                $result[] = $first_label;
            }
        }
        if( is_array( $posts ) && !empty( $posts ) ){
            foreach( $posts as $post ){
                $result[ $post -> ID  ] = $post -> post_title;
            }
        }

        return $result;
    }

    function menu( $id ,  $args = array() ){

        $menu = new menu( $args );
        if ($args['container_class'] == 'top-menu cosmo-menu') {
            $container_class = 'top-menu cosmo-menu';
        }elseif ($args['container_class'] == 'top-menu cosmo-menu align-top') {
            $container_class = 'top-menu cosmo-menu align-top';
        }elseif ($args['container_class'] == 'top-menu cosmo-menu align-middle') {
            $container_class = 'top-menu cosmo-menu align-middle';
        }elseif ($args['container_class'] == 'top-menu cosmo-menu align-bottom') {
            $container_class = 'top-menu cosmo-menu align-bottom';
        }elseif ($args['container_class'] == 'main-menu cosmo-menu align-top') {
            $container_class = 'main-menu cosmo-menu align-top';
        }elseif ($args['container_class'] == 'main-menu cosmo-menu align-middle') {
            $container_class = 'main-menu cosmo-menu align-middle';
        }elseif ($args['container_class'] == 'main-menu cosmo-menu align-bottom') {
            $container_class = 'main-menu cosmo-menu align-bottom';
        }elseif ($args['container_class'] == 'footer-menu cosmo-menu align-top') {
            $container_class = 'footer-menu cosmo-menu align-top';
        }elseif ($args['container_class'] == 'footer-menu cosmo-menu align-middle') {
            $container_class = 'footer-menu cosmo-menu align-middle';
        }elseif ($args['container_class'] == 'footer-menu cosmo-menu align-bottom') {
            $container_class = 'footer-menu cosmo-menu align-bottom';
        }

        $vargs = array(
            'menu'            => '',
            'container'       => 'nav',
            'container_class' => $container_class,
            'container_id'    => '',
            'menu_class'      => isset( $args['class'] ) ? $args['class'] : '',
            'menu_id'         => '',
            'echo'            => false,
            'fallback_cb'     => '',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'depth'           => 0,
            'walker'          => $menu,
            'theme_location'  => $id ,
            'menu_style' =>  isset( $args['menu_style'] ) ? $args['menu_style'] : 'default', /*menu style from template (default, with_description or vertical) */
            'nr_columns' =>  isset( $args['nr_columns'] ) ? $args['nr_columns'] : '', /*1,2,3 or 4 columns  Defined in the template*/
        );

        $result = wp_nav_menu( $vargs );
        $result = str_replace('</ul>', '</ul><div class="clear"></div>', $result);

        if(!strlen($result)){

            $result = $menu -> get_terms_menu();
            
            //var_dump($result);
        }

        // if( $menu -> need_more &&  $id != 'megusta' ){
        //         $result .="</li></ul>".$menu -> aftersubm ;
        // }
        
        return $result;
    }

    
    function page(){
        if( (int)get_query_var('paged') > (int)get_query_var('page') ){
            $result = (int)get_query_var('paged');
        }else{

            if( (int)get_query_var('page') == 0 ){
                $result = 1;
            }else{
                $result = (int)get_query_var('page');
            }
        }

        return $result;
    }

    function clear_meta( $post_id ){

        $resources = array( 'conference' => array( 'sponsor' , 'presentation' , 'exhibitor' )  , 'presentation' => array( 'speaker' )  );
        foreach( $resources as $res => $boxes ){
            $posts = get_posts( array( 'post_type' => $res ));
            foreach( $posts as $post ){
                foreach( $boxes as $box ){
                    $box_meta = meta::get_meta( $post -> ID , $box );
                    foreach( $box_meta as $index => $meta ){
                        if( $meta['idrecord'] == $post_id ){
                            meta::delete( $res , $box ,  $post -> ID , '' , $index );
                        }
                    }
                }
            }
        }
    }

	function dimox_breadcrumbs() {

	  $delimiter = '';
	  $home = __('Home','cosmotheme'); // text for the 'Home' link

      $start_container = '<ul>';
      $end_container = '</ul>';
	  $before = '<li>'; // tag before the current crumb
	  $after = '</li>'; // tag after the current crumb

	  if (  !is_front_page() || is_paged() ) {

	    /*echo '<div id="crumbs">';*/

	    global $post;
	    $homeLink = home_url();
        echo $start_container;
	    echo '<li><a href="' . $homeLink . '">' . $home . '</a> </li>' . $delimiter . ' ';

	    if ( is_category() ) {
	      global $wp_query;
	      $cat_obj = $wp_query->get_queried_object();
	      $thisCat = $cat_obj->term_id;
	      $thisCat = get_category($thisCat);
	      $parentCat = get_category($thisCat->parent);
	      if ($thisCat->parent != 0) echo($before .get_category_parents($parentCat, TRUE, ' ' . '</li><li>' . ' '). $after);
	      echo $before . __('Archive by category','cosmotheme').' "' . single_cat_title('', false) . '"' . $after;

	    } elseif ( is_day() ) {
	      echo $before.'<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> '. $after . $delimiter . ' ';
	      echo $before.'<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> '. $after . $delimiter . ' ';
	      echo $before . get_the_time('d') . $after;

	    } elseif ( is_month() ) {
	      echo $before . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> '. $after . $delimiter . ' ';
	      echo $before . get_the_time('F') . $after;

	    } elseif ( is_year() ) {
	      echo $before . get_the_time('Y') . $after;

	    } elseif ( is_single() && !is_attachment() ) {
	      if ( get_post_type() != 'post' ) {

	        $post_type = get_post_type_object(get_post_type());
	        $slug = $post_type->rewrite;
	        echo $before . '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> '. $after . $delimiter . ' ';
	        echo $before . get_the_title() . $after;
	      } else {
	        $cat = get_the_category(); $cat = $cat[0];
	        //echo $before . get_category_parents($cat, TRUE, ' ' . '</li><li>' . ' ') . $after;
            echo $before . get_category_parents($cat, TRUE, ' ' ) . $after;
	        echo $before . get_the_title() . $after;
	      }

	    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
	      $post_type = get_post_type_object(get_post_type()); 
          if($post_type){
            echo $before . $post_type->labels->singular_name . $after;
          }  

	    } elseif ( is_attachment() ) {
	      $parent = get_post($post->post_parent);
	      /*$cat = get_the_category($parent->ID); $cat = $cat[0];*/
	      /*echo $before . get_category_parents($cat, TRUE, ' ' . $delimiter . ' ') . $after;*/
	      echo $before . '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> '. $after . $delimiter . ' ';
	      echo $before . get_the_title() . $after;

	    } elseif ( is_page() && !$post->post_parent ) {
	      echo $before . get_the_title() . $after;

	    } elseif ( is_page() && $post->post_parent ) {
	      $parent_id  = $post->post_parent;
	      $breadcrumbs = array();
	      while ($parent_id) {
	        $page = get_page($parent_id);
	        $breadcrumbs[] = $before .'<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>'.$after ;
	        $parent_id  = $page->post_parent;
	      }
	      $breadcrumbs = array_reverse($breadcrumbs);
	      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
	      echo $before . get_the_title() . $after;

	    } elseif ( is_search() ) {
	      echo $before . __('Search results for','cosmotheme').' "' . get_search_query() . '"' . $after;

	    } elseif ( is_tag() ) {
	      echo $before . __('Posts tagged','cosmotheme').' "' . single_tag_title('', false) . '"' . $after;

	    } elseif ( is_author() ) {
	       global $author;
	      $userdata = get_userdata($author);
	      echo $before . __('Articles posted by ','cosmotheme') . $userdata->display_name . $after;

	    } elseif ( is_404() ) {
	      echo $before . __('Error 404','cosmotheme') . $after;
	    }

	    if ( get_query_var('paged') ) {
	      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
	      echo __('Page','cosmotheme') . ' ' . get_query_var('paged');
	      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
	    }

	  	if(is_home()){
			echo $before . __('Blog','cosmotheme'). $after;
		}
        echo $end_container;
	    /*echo '</div>';*/

	  }
	} /* end dimox_breadcrumbs()*/

    function remove_post_custom_fields() {
        remove_meta_box( 'postcustom' , 'post' , 'normal' );
    }
	
	function get_bg_image(){
            $pattern = explode( '.' , options::get_value( 'styling' , 'background' ) ) ; 
            if( isset( $pattern[ count( $pattern ) - 1 ] ) && $pattern[ count( $pattern ) - 1 ] == 'none'  || get_background_image() != '' ){
                $background_img = '';
            }else{
                $background_img_url = str_replace( 's.pattern.' , 'pattern.' , options::get_value( 'styling' , 'background' ) );
                if(strpos($background_img_url,'day') || strpos($background_img_url,'night')) { 
                    $background_img_url = str_replace( '.jpg' , '.png' , $background_img_url );  
                }
                $pieces = explode("/", $background_img_url);
                $background_img = $pieces[count($pieces) -1 ];
                    if (strpos($background_img, 'none')) {
                        $background_img = '' ;
                    }   	
            }
            
			/*if cookies are set we overite the settings*/ 
			if( isset($_COOKIE[ZIP_NAME."_bg_image"]) ){  
				$background_img = 'pattern.'.trim($_COOKIE[ZIP_NAME."_bg_image"].'.png');  
			}
			
			return $background_img;
	}
	
	function get_content_bg_color(){

            $background_color = options::get_value( 'styling' , 'background_color' );
            
			/*if cookies are set we ovewrite the settings*/
			if(isset($_COOKIE[ZIP_NAME."_content_bg_color"])){ 
				$background_color = trim($_COOKIE[ZIP_NAME."_content_bg_color"]); 
			}
			
			return $background_color;
	}
	
	function get_footer_bg_color(){
		if(isset($_COOKIE[ZIP_NAME."_footer_bg_color"])){ 
			$footer_background_color = trim($_COOKIE[ZIP_NAME."_footer_bg_color"]);
		}else{
			$footer_background_color = options::get_value( 'styling' , 'footer_bg_color' );
		}
		
		return $footer_background_color;
	}

	function cosmo_avatar( $user_info, $size, $default = DEFAULT_AVATAR ) {
		
		$avatar = '';
        if( is_numeric( $user_info ) ){
            if( get_user_meta( $user_info , 'custom_avatar' , true ) == -1 ){
                $avatar = '<img src="' . $default . '" height="' . $size . '" width="' . $size . '" alt="" class="photo avatar" />';
            }else{
                if(  get_user_meta( $user_info , 'custom_avatar' , true ) > 0 ){
                    $cusom_avatar = wp_get_attachment_image_src( get_user_meta( $user_info , 'custom_avatar' , true ) , array( $size , $size ) );
                    $avatar = '<img src="' . $cusom_avatar[0] . '" height="' . $size . '" width="' . $size . '" alt="" class="photo avatar" />';
                }else{
                    $avatar = get_avatar( $user_info , $size , $default );
                }
            }
            
        }else{
            if( is_object( $user_info ) ){
                if( isset( $user_info -> user_id ) && is_numeric( $user_info -> user_id ) && $user_info -> user_id > 0 ){
                    if( get_user_meta( $user_info -> user_id , 'custom_avatar' , true ) == -1 ){
                        $avatar = '<img src="' . $default . '" height="' . $size . '" width="' . $size . '" alt="" class="photo avatar" />';
                    }else{
                        if( get_user_meta( $user_info -> user_id , 'custom_avatar' , true ) > 0 ){
                            $cusom_avatar = wp_get_attachment_image_src( get_user_meta( $user_info -> user_id , 'custom_avatar' , true ) , array( $size , $size ) );
                            $avatar = '<img src="' . $cusom_avatar[0] . '" height="' . $size . '" width="' . $size . '" alt="" class="photo avatar" />';
                        }else{
                            $avatar = get_avatar( $user_info , $size , $default );
                        }
                    }
                }else{
                    $avatar = get_avatar( $user_info , $size , $default );
                }
            }else{
                $avatar = get_avatar( $user_info , $size , $default );
            }
        }
		
        return $avatar;
	}

    
    function get_distinct_post_terms($post_id, $taxonomy, $return_names = false, $filter_type = '' ){
        /*
            Returns distinct taxonomies for a given post, or nothig if nothing found.
        */
        $ids = array();
        $names = '';

        $terms = wp_get_post_terms( $post_id , $taxonomy );

        if(is_array($terms)){
            foreach ($terms as $term) {
                if(!in_array($term->term_id, $ids) ){
                    $ids[] = $term->term_id;

                    $names .= ' '.$term->term_id.'-'.$filter_type.' ';
                }
            }
        }

        if($return_names){
            return $names;
        }else{
            return $ids;    
        }
    }

     function get_distinct_terms($posts,$taxonomy ){
        /*
            Returns distinct taxonomies for given posts, or empty array if nothing found.
        */
        $ids = array();
        
        foreach ($posts as $post) { 
            $galleries = '';            
            
            if(isset($post -> ID)){

                $galleries = wp_get_post_terms( $post -> ID , $taxonomy );
            }
            
            if(is_array($galleries)){
                foreach ($galleries as $gallery) {
                    if(!in_array($gallery->term_id, $ids) ){
                        $ids[] = $gallery->term_id;
                        
                    }
                }
            }
        }
    
        return $ids;    
        
    }

    function get_filters($term_ids,$taxonomy, $filter_type = 'thumbs', $title = ''){
        /*
            this function returns the filter by taxonomy 
            Params:
            $term_ids - and array or term IDs
            $taxonomy -  for example 'category' or 'gallery'
            $filter_type - we need that to have distinct data-value, to not affect other filters
        */
        $result = '';    
        if(is_array($term_ids) && sizeof($term_ids)){
            $result .= $title;
            $result .= '<ul class="thumbs-splitter" data-option-key="filter">';
            $result .= '    <li class="segment-0 selected-0 selected">
                                <a href="#filter" data-option-value="*" class="selected">'.__('All','cosmotheme').'</a>
                            </li>';
            $i = 0;
            foreach ($term_ids as $term_id) {
                $i++;
                $term = get_term( $term_id, $taxonomy );
                
                $result .= '<li class="segment-'.$i.'">
                                <a href="#filter" data-option-value=".'.$term -> term_id.'-'.$filter_type.'">'.$term->name.'</a>
                            </li>';
            }
            $result .= '</ul>';
        }

        return $result;
    }

    function link_souce($text){
        /*if gicen text is a valid URL we will return the linked url
            else we will return the given text
        */

        if(post::isValidURL($text)){
            $text = '<a href="'.$text.'">'.$text.'</a>';
        }    
        return $text;
    }
  
    function custom_get_post_format($post_id){
        if(strlen(get_post_format($post_id) )){
            return 'format-'.get_post_format($post_id);
        }else{
            return 'format-standard';
        }
    }      

    function load_google_fonts(){
        $protocol = is_ssl() ? 'https' : 'http';
        

        $result = '';
        $fonts = array();
        $settings_fonts = array(
            'Lato:300,400,700&v1', /*we need this one always*/
            options::get_value( 'typography' , 'headings_font_font_family' ),
            options::get_value( 'typography' , 'primary_font_font_family' ),
            options::get_value( 'typography' , 'menu_font_font_family' ),
            //options::get_value( 'typography' , 'secondary_font_font_family' )

        );
        if( options::get_value( 'styling' , 'logo_type' ) == 'text' ) { 
            $settings_fonts[] = options::get_value( 'styling' , 'logo_font_family' );
        }

        foreach ($settings_fonts as $font) {
            if(!empty($font)){
                if(strpos($font, '&v1') === false){
                    $font .= '&v1';
                }
            }
            
            if(!in_array($font, $fonts)){ 
                
                $fonts[] = $font; /*append each font only 1 time*/
            }
        }

        $counter = 1;
        foreach ($fonts as $g_font) {
            if(!empty($g_font)){
                $the_font = str_replace(' ' , '+' , trim( $g_font ) );
                wp_enqueue_style( 'cosmo-gfont-'.$counter, "$protocol://fonts.googleapis.com/css?subset=latin-ext&family=$the_font' rel='stylesheet' type='text/css" );
                                                          
            }
            $counter ++;
        }

    }

    /*function to set automatically first attached image as featured image on image format post*/
    function autoset_featured() {
        if(is_admin()){
          global $post;
          if (isset($post->ID)) {
          $already_has_thumb = has_post_thumbnail($post->ID);
              if (!$already_has_thumb)  {
              $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
                          if ($attached_image && get_post_format() == 'image') {
                                foreach ($attached_image as $attachment_id => $attachment) {
                                set_post_thumbnail($post->ID, $attachment_id);
                                }
                           } else {}
              }          
          }
        }
    }  //end function

    /*modify_attachment_link function add prettyPhoto to wordpress galleries*/
    function modify_attachment_link( $markup, $id, $size, $permalink ) {
        global $post;
        if ( ! $permalink ) {
            $markup = str_replace( '<a href', '<a class="view" data-rel="prettyPhoto[slides]-'. $post->ID .'" href', $markup );
        }
        return $markup;
    }

    function cosmo_hex2rgb($hex) {
       $hex = str_replace("#", "", $hex);

       if(strlen($hex) == 3) {
          $r = hexdec(substr($hex,0,1).substr($hex,0,1));
          $g = hexdec(substr($hex,1,1).substr($hex,1,1));
          $b = hexdec(substr($hex,2,1).substr($hex,2,1));
       } else {
          $r = hexdec(substr($hex,0,2));
          $g = hexdec(substr($hex,2,2));
          $b = hexdec(substr($hex,4,2));
       }
       //$rgb = array($r, $g, $b);
       $rgb = $r.','. $g.','. $b.', ';

       //return implode(",", $rgb); // returns the rgb values separated by commas
       return $rgb; // returns an array with the rgb values
    }

    /*
     * this function checks if a given element is used in the passed Rows
     * params:
      $rows: array -> that contains the rows information
      $element_name: string -> the element that we are looking for
      return: boolean - true if the element is used and false if it is not used
     */
    function is_element_used($rows, $element_name){
        $result = false;
        foreach ($rows as $key => $template_part) {
            foreach ($template_part['_elements'] as $key => $element) {
                # code...
                //var_dump($element['type'] );
                if(isset($element['type']) && $element['type'] == $element_name){
                    $result = true;
                    break;
                }
            }
    
        }

        return $result;
    }

    function get_element_info($rows, $element_name){
        $result = array();
        foreach ($rows as $key => $template_part) {
            foreach ($template_part['_elements'] as $key => $element) {
                # code...
                //var_dump($element['type'] );
                if(isset($element['type']) && $element['type'] == $element_name){
                    $result = $template_part['_elements'][$key];
                    break;
                }
            }
    
        }

        return $result;
    }


    /*
     * this function returns the current URL
     */
    function curPageURL() {
        $pageURL = 'http';
        if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
        $pageURL .= "://";
        
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

    
    /**
    * Title     : Aqua Resizer
    * Description   : this function will return the image size that will be passed to aq_resize function
    * 
    *
    * @param    string $size_name - (required) the name of the size option, for example 'single_cropped'
    * @param    int $width_or_height - (not required) specifyes what demention we want to get, the width or the height of the image (default - width)
    * 
    * @return str|array
    *****/

    function get_aqua_size($size_name, $width_or_height = 'width'){
        
        $result = options::get_value( 'imagesizes' , $size_name.'_'.$width_or_height );
        
        if(is_numeric($result)){
           return $result; 
        }else{
            /*if the omption is empty or not numeric for some reason, we return the default*/
            return options::$default['imagesizes'][$size_name.'_'.$width_or_height];
        }
    }


    
    function get_custom_css() { ?>
    <!--Custom CSS-->
        <style type="text/css">
            <?php if (strlen(options::get_value( 'typography' , 'headings_font_font_family' ))){ ?>
            /*headings*/
            h1, h2, h3, h4, h5, h6{font-family: "<?php echo str_replace('&v1','', str_replace('+' , ' ' , trim( options::get_value( 'typography' , 'headings_font_font_family' ) ) ) ); ?>" !important ;  }
            <?php } ?>
            <?php if (strlen(options::get_value( 'typography' , 'primary_font_font_family' ))){ ?>
            /*primary text*/
            article, .post > .excerpt, .widget, p{font-family: "<?php echo str_replace('&v1','', str_replace('+' , ' ' , trim( options::get_value( 'typography' , 'primary_font_font_family' ) ) ) ); ?>" ;}
            <?php } ?>
            <?php if (strlen(options::get_value( 'typography' , 'menu_font_font_family' ))){ ?>
            /*menu text*/
            nav.main-menu{font-family: "<?php echo str_replace('&v1','', str_replace('+' , ' ' , trim( options::get_value( 'typography' , 'menu_font_font_family' ) ) ) ); ?>";}
            <?php } ?>

            <?php echo options::get_value( 'custom_css' , 'css' ); ?>

            <?php 
                $menu_arrow_color = options::get_value( 'styling' , 'triangle_color' );
                if(strlen($menu_arrow_color) ){
            ?>
                /*FAVICON menu*/
                nav.main-menu > ul > li.selected:before, nav.main-menu > ul > li.active:before  { border-top: 4px solid <?php echo $menu_arrow_color; ?>; /*#f8a0e4*/ }
                nav.main-menu > ul.sf-menu li:hover:before, nav.main-menu > ul.sf-menu li.sfHover:before{
                    border-top-color:<?php echo $menu_arrow_color; ?>; /*#f8a0e4*/
                }

                .widget h5.widget-title span:before, #reply-title span:before, #comments-title span:before, .related-title span:before { border-top: 5px solid <?php echo $menu_arrow_color; ?>; }


                .content-title span:before{
                display: block;
                position: absolute;
                content: '';
                border-top: 5px solid <?php echo $menu_arrow_color; ?>;}

                .scrollbar .handle { background: <?php echo $menu_arrow_color; ?>; }
            <?php        
                } 

                $heart_color = options::get_value( 'styling' , 'heart_color' );

                if(strlen($heart_color)){
            ?>
                /*LIKES*/
                span.like em:before{
                    color: <?php echo $heart_color; ?>; /*color: #f8a0e4;*/
                }
                span.like.voted em:before{
                    color: <?php echo $heart_color; ?>; /*color: #E04D45;*/
                }
                span.like:hover em:before{
                    color: <?php echo $heart_color; ?>; /*color: #F47069;*/
                }
                span.like.voted:hover em:before{
                    color: <?php echo $heart_color; ?>; /*color: #F76F67;*/
                }
            <?php
                }

                $link_color = options::get_value( 'styling' , 'link_color' );
                $link_hover_color = options::get_value( 'styling' , 'link_hover_color' );

                if( strlen($link_color) ){ ?>
                    .single-post .excerpt a, .single .content a, .entry-content-excerpt a {
                        color: <?php echo $link_color; ?>;
                    }
            <?php }

                if ( strlen($link_hover_color) ) { ?>
                    .single-post .excerpt a:hover, .single .content a:hover, .entry-content-excerpt a:hover {
                        color: <?php echo $link_hover_color; ?>;
                        text-decoration: underline;
                    }
               <?php }

            ?>    

            <?php 
                if (options::logic( 'styling' , 'use_mask_effect' )) {
            ?>
                .single #main >.featimg>.featmask{
                    position: absolute;
                    width: 140%;
                    height: 1000px;
                    -webkit-transform: rotate(15deg);
                    -moz-transform: rotate(15deg);
                    -o-transform: rotate(15deg);
                    -ms-transform: rotate(15deg);
                    transform: rotate(15deg);
                    left: 0;
                    background: #FFF;
                    margin-top: -1400px;
                }
            <?php } 
                $menu_color = options::get_value( 'styling' , 'menu_hover_color' );
                if ( strlen($menu_color) ) {
            ?>
                .sf-menu li li a:hover { 
                    color: <?php echo $menu_color; ?>; 
                }
            <?php } ?>
        </style>
          

    <?php if( options::get_value( 'styling' , 'logo_type' ) == 'text' ) {
        $logo_font_family = explode('&',options::get_value('styling' , 'logo_font_family'));
        $logo_font_family = $logo_font_family[0];
        $logo_font_family = str_replace( '+',' ',$logo_font_family );

        if( strlen(options::get_value( 'styling' , 'logo_text_color' ) ) ){
            $logo_color = options::get_value( 'styling' , 'logo_text_color' );
        }
    ?>
        <style type="text/css">
            .logo a h1 {
            font-family: '<?php echo $logo_font_family ?>','Helvetica', 'Helvetica Neue', arial, serif !important;
            font-weight: <?php echo options::get_value('styling' , 'logo_font_weight')?>;
            font-size: <?php echo options::get_value('styling' , 'logo_font_size')?>px;
            color: <?php echo $logo_color; ?>; 
        }
        </style>
    <?php } 
    }  

    function assign_template_to_post($post_id, $template, $layout = '', $layout_type = ''){


        if($layout_type == ''){
            $layout_type = 'full_width';
        }

        if($layout == ''){
            $layout = array(
                    'first' => array(
                            'id' => 'first',
                            'columns' => 3,
                            'disabled' => true,
                            'sidebar' => 'main'
                        ),

                    'main' => array(
                            'id' => 'main',
                            'columns' => 12,
                            'disabled' => false
                        ),

                    'second' => array(
                            'id' => 'second',
                            'columns' => 3,
                            'disabled' => true,
                            'sidebar' => 'main'
                        )

                );
        }

        $template_layout = array(
            'layout_type' => $layout_type,
            'elements' => $layout,
            'template' => $template
        );
//deb::e($template_layout);
        update_post_meta( $post_id, 'layout', $template_layout ); 
        //deb::e('ww');
    }

    

    // returns the gallery type assigned for a given gallery, or the default setting if the given post does not have that setting. 
    function get_posts_gallery_type($post_id){
        
        if ( wp_is_mobile() ) {
            $mobile_gallerytype = meta::get_meta( $post_id , 'gallerytype' );
            if( isset($mobile_gallerytype['mobile_gallery_type']) && strlen($mobile_gallerytype['mobile_gallery_type']) ){
               return $mobile_gallerytype['mobile_gallery_type'];
            }else{
               return options::get_value( 'blog_post' , 'mobile_gallery_type' );      
            }
        }
        
       
        $gallerytype = meta::get_meta( $post_id , 'gallerytype' );

        if(isset($gallerytype['value']) && strlen($gallerytype['value'])){
            return $gallerytype['value'];
        }else{
            return options::get_value( 'blog_post' , 'gallery_type' );
        }
        
    }

    // adding the gallery manager form
    get_template_part('/lib/php/attached_images_manager'); 


    /**
     * Creating meta tags - used in header.php
     */
    function cosmo_get_site_meta() {

        ob_start();
        ob_clean();

        if( is_single() || is_page() ){ 
            global $post; ?>
            <meta name="description" content="<?php echo strip_tags( post::get_excerpt( $post, $ln=150 ) ); ?>" /> 
            <meta property="og:title" content="<?php the_title() ?>" />
            <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
            <meta property="og:url" content="<?php the_permalink() ?>" />
            <meta property="og:type" content="article" />
            <meta property="og:locale" content="en_US" /> 
            <meta property="og:description" content="<?php echo get_bloginfo('description'); ?>"/>
            <?php

        } else { ?>
            <meta name="description" content="<?php echo get_bloginfo('description'); ?>" /> 
            <meta property="og:title" content="<?php echo get_bloginfo('name'); ?>"/>
            <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>"/>
            <meta property="og:url" content="<?php echo home_url() ?>/"/>
            <meta property="og:type" content="blog"/>
            <meta property="og:locale" content="en_US"/>
            <meta property="og:description" content="<?php echo get_bloginfo('description'); ?>"/>
            <?php
        }

        return ob_get_clean();

    }
?>