<?php

    $sidebar_value = extra::select_value( '_sidebar' );

    if(!( is_array( $sidebar_value ) || !empty( $sidebar_value ) ) ){
        $sidebar_value = array();
    }

    /* hide if is full width */
    $classes = 'sidebar_list';

    $position = array( 'left' => __( 'Align Left' , 'cosmotheme' ) , 'right' => __( 'Align Right' , 'cosmotheme' ) );


    /* post type gallery */
    $res[ 'gallery' ][ 'labels' ] = array(
        'name' => _x('Galleries', 'post type general name','cosmotheme'),
        'singular_name' => _x(__('Gallery','cosmotheme'), 'post type singular name'),
        'add_new' => _x('Add New', __('Gallery','cosmotheme')),
        'add_new_item' => __('Add New Gallery','cosmotheme'),
        'edit_item' => __('Edit Gallery','cosmotheme'),
        'new_item' => __('New Gallery','cosmotheme'),
        'view_item' => __('View Gallery','cosmotheme'),
        'search_items' => __('Search Gallery','cosmotheme'),
        'not_found' =>  __('Nothing found','cosmotheme'),
        'not_found_in_trash' => __('Nothing found in Trash','cosmotheme')
    );
    $res[ 'gallery' ][ 'args' ] = array(
        'public' => true,
        'hierarchical' => false,
        'rewrite' => array( 'slug' => __('gallery','cosmotheme'), 'with_front' => true ),
        'menu_position' => 3,
        '__on_front_page' => true,
        'supports' => array('title','thumbnail', 'editor', 'author', 'comments'),
        'menu_icon' => get_template_directory_uri() . '/lib/images/custom.portfolio.png',
        'has_archive' => true
    );

    $gallery_type = array('sly' => 'Sly', 'clasic' => 'Clasic', 'folio' => 'Folio', 'image_flow' => 'Image Flow','mosaic' => __('Mosaic view','cosmotheme'), 'vertical-scroll' => __('Vertical Image scroll','cosmotheme')); 
    $form[ 'gallery' ][ 'gallerytype' ][ 'value' ]   = array( 'type' => 'st--select' , 'label' => __( 'Select gallery type' , 'cosmotheme' ), 'value' => $gallery_type, 'cvalue' => options::get_value( 'blog_post' , 'gallery_type' )  );
    $form[ 'gallery' ][ 'gallerytype' ][ 'show_title' ]   = array( 'type' => 'st--logic-radio' , 'label' => __( 'Hide gallery title' , 'cosmotheme' ) );
    $form[ 'gallery' ][ 'gallerytype' ][ 'show_sly_caption' ]   = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show top-left image caption for Sly gallery' , 'cosmotheme' ), 'hint' =>__( 'If enabled, every image will display it\'s caption, if it has one' , 'cosmotheme' ), 'cvalue' => options::get_value( 'blog_post' , 'show_sly_caption' )  );
    $form[ 'gallery' ][ 'gallerytype' ]['thumb_link']  = array( 'type' => 'st--text' , 'label' => __( 'Add custom link to post\'s thumbnail.' , 'cosmotheme' ), 'hint' => __( 'If a link is added, the thumbnail will not link the actual post, but will redirect to the inserted link. Insert with http://example.com' , 'cosmotheme' )   );
    $form[ 'gallery' ][ 'gallerytype' ]['thumb_link_tab']  = array(
     'type' => 'st--logic-radio', 
     'label' => __( 'Open thumbnail link in a new tab' , 'cosmotheme' )  );


    $form[ 'gallery' ][ 'gallerytype' ]['mobile_gallery_type'] = array( 
        'type' => 'st--select' , 
        'value' => $gallery_type , 
        'label' => __( 'Select gallery type for mobile devices' , 'cosmotheme' ) ,
        'hint' => __( 'When accessing your galleries from a mobile device, this gallery type will be displayed. Tip: use "Vertical Scroll" - it\'s the lightest.' , 'cosmotheme' ) ,
        'cvalue' => options::get_value( 'blog_post' , 'mobile_gallery_type' ) ); 
    $form[ 'gallery' ][ 'gallerytype' ][ 'sharing' ] = array( 'type' => 'st--logic-radio' , 'label' => __( 'Enable social sharing for this gallery' , 'cosmotheme' ), 'hint' =>__( 'If enabled, you\'ll have social sharing for this gallery'  , 'cosmotheme' ), 'cvalue' => options::get_value( 'blog_post' , 'post_sharing' )  );


    $form[ 'gallery' ][ 'gallerytype' ]['randomize_image']  = array( 'type' => 'st--logic-radio', 'label' => __( 'Display images in random order, on every refresh' , 'cosmotheme' )  );

    $form[ 'gallery' ][ 'gallerytype' ][ 'hide_gallery_info' ]   = array( 'type' => 'st--logic-radio' , 'label' => __( 'Hide left sidebar on gallery page' , 'cosmotheme' ), 'hint' =>__( 'If enabled, gallery info will be hidden ' , 'cosmotheme' ), 'cvalue' => options::get_value( 'blog_post' , 'hide_gallery_info' )  );
   
    $form['gallery'  ][ 'gallerytype' ][ 'show_collapse_btn']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show collapse button' , 'cosmotheme' )); 
    $form['gallery'  ][ 'gallerytype' ][ 'show_slide_btn']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show Slideshow icon' , 'cosmotheme' ), 'hint' =>__( 'If enabled, users will have the ability to view your gallery in a full-screen slideshow, by clicking the play icon.' , 'cosmotheme' ) ); 
    $form['gallery'  ][ 'gallerytype' ][ 'reverse_order']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show images in reverse order' , 'cosmotheme' ) ); 
    $form['gallery'  ][ 'gallerytype' ][ 'related']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show related galleries' , 'cosmotheme' ) , 'hint' => __( 'Show related galleries on this gallery' , 'cosmotheme' ) , 'cvalue' => options::get_value(  'blog_post' , 'gallery_related' ) );
    

    $box['gallery']['gallerytype']   = array( __('Gallery type' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['gallery']['gallerytype'] , 'box' => 'gallerytype' , 'update' => true );
    

   

    //$form['gallery']['imagesattached']['img_ids']       = array( 'type' => 'st--text' , 'label' => __( 'Add attachments IDs here separated by comma.' , 'cosmotheme' ), 'hint' => __( 'If this field is left blank then images attached to this post will be showed' , 'cosmotheme' )   );
    //$box['gallery']['imagesattached']                   = array( __( 'Attached image IDs' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['gallery']['imagesattached'] , 'box' => 'imagesattached', 'update' => true );


    resources::$labels['gallery']         = $res['gallery']['labels'];
    resources::$type['gallery']           = $res['gallery']['args'];

    resources::$box['gallery']                 = $box['gallery'];
    /*=====================================================*/
    
    /* post type testimonials */
    $res['testimonial']['labels'] = array(
        'name' => _x('Testimonials', 'post type general name','cosmotheme'),
        'singular_name' => _x('Testimonial', 'post type singular name','cosmotheme'),
        'add_new' => _x('Add New', __('Testimonial','cosmotheme')),
        'add_new_item' => __('Add New Testimonial','cosmotheme'),
        'edit_item' => __('Edit Testimonial','cosmotheme'),
        'new_item' => __('New Testimonial','cosmotheme'),
        'view_item' => __('View Testimonial','cosmotheme'),
        'search_items' => __('Search Testimonial','cosmotheme'),
        'not_found' =>  __('Nothing found','cosmotheme'),
        'not_found_in_trash' => __('Nothing found in Trash','cosmotheme')
    );
    $res['testimonial']['args'] = array(
        'menu_icon' => get_template_directory_uri() . '/lib/images/custom.testimonial.png',
        'public' => true,
        'hierarchical' => false,
        'rewrite' => array( 'slug' => __('testimonial','cosmotheme'), 'with_front' => true ),
        'menu_position' => 7,
        'supports' => array('title','editor','thumbnail'),
        '__on_front_page' => true
    );

    /* box for testimonial */
    $form['testimonial']['info']['name']                = array( 'type' => 'st--text' , 'label' => '<strong>' . __( 'Author name' , 'cosmotheme') . '</strong>' );
    $form['testimonial']['info']['title']               = array( 'type' => 'st--text' , 'label' => '<strong>' . __( 'Author title' , 'cosmotheme') . '</strong>' );
    
    $box['testimonial']['info']                         = array( __('Add testimoniall additional info' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['testimonial']['info'] , 'box' => 'info', 'update' => true );
    $box['testimonial']['shcode']                  = array( __('Shortcodes' , 'cosmotheme' ) , 'normal' , 'high'  , 'box' => 'shcode' , 'includes' => 'shcode/main.php' );


    resources::$labels['testimonial']         = $res['testimonial']['labels'];
    resources::$type['testimonial']           = $res['testimonial']['args'];
    resources::$box['testimonial']            = $box['testimonial'];

    /*---------------------BOF "banner" post type--------------------------*/
    $res['banner']['labels'] = array( 
        'name' => _x('Banners', 'post type general name','cosmotheme'),
        'singular_name' => _x('Banner', 'post type singular name','cosmotheme'),
        'add_new' => _x('Add New', __('Banner','cosmotheme')),
        'add_new_item' => __('Add New Banner','cosmotheme'),
        'edit_item' => __('Edit Banner','cosmotheme'),
        'new_item' => __('New Banner','cosmotheme'),
        'view_item' => __('View Banner','cosmotheme'),
        'search_items' => __('Search Banner','cosmotheme'),
        'not_found' =>  __('Nothing found','cosmotheme'),
        'not_found_in_trash' => __('Nothing found in Trash','cosmotheme')
    );
    $res['banner']['args'] = array(
        'menu_icon' => get_template_directory_uri() . '/lib/images/custom.banners.png',
        'public' => true,
        'rewrite' => array( 'slug' => __('banner','cosmotheme'), 'with_front' => true ),
        'hierarchical' => false,
        'menu_position' => 8,
        'supports' => array('title'),
        'exclude_from_search' => true,
        '__on_front_page' => false
    );

    /* box for banner */
    $form['banner']['info']['script']            = array( 'type' => 'st--textarea' , 'label' => __( 'Banner code' , 'cosmotheme'), 'hint' => __('You can insert your advertisement code here, or just any text or HTML code.','cosmotheme') );

    $form['banner']['info']['banner_img']       = array( 'type' => 'st--upload' , 'label' => __( 'Banner image' , 'cosmotheme') , 'id' => 'post_background' , 'hint' => __( 'Upload or choose image from media library.' , 'cosmotheme' ) );
    $form['banner']['info']['img_link']         = array( 'type' => 'st--text' , 'label' => __( 'Banner image link' , 'cosmotheme') , 'hint' => __('This URL is used if the above image is uploaded, and if available, the image will link to it.','cosmotheme') );
    $form['banner']['info']['class']            = array( 'type' => 'st--text' , 'label' => __( 'Banner class' , 'cosmotheme') , 'hint' => __('Add custom css class if you need it.','cosmotheme') );
    
    $box['banner']['info']                      = array( __('Banner content' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['banner']['info'] , 'box' => 'info', 'update' => true );
    //$box['banner']['shcode']                  = array( __('Shortcodes' , 'cosmotheme' ) , 'normal' , 'high'  , 'box' => 'shcode' , 'includes' => 'shcode/main.php' );


    resources::$labels['banner']         = $res['banner']['labels'];
    resources::$type['banner']           = $res['banner']['args'];
    resources::$box['banner']            = $box['banner'];

    /*---------------------EOF banner post type--------------------------*/


    /*---------------------BOF teams post type--------------------------*/
    $res[ 'team' ][ 'labels' ] = array(
        'name' => __( 'Teams', 'cosmotheme' ),
        'singular_name' => __( 'Team', 'cosmotheme' ),
        'add_new' => __( 'Add New Team', 'cosmotheme' ),
        'add_new_item' => __( 'Add New Team', 'cosmotheme' ),
        'edit_item' => __( 'Edit Team', 'cosmotheme' ),
        'new_item' => __( 'New Team', 'cosmotheme' ),
        'view_item' => __( 'View Team', 'cosmotheme' ),
        'search_items' => __( 'Search Team', 'cosmotheme' ),
        'not_found' =>  __( 'Nothing found', 'cosmotheme' ),
        'not_found_in_trash' => __( 'Nothing found in Trash', 'cosmotheme' )
    );
    $res[ 'team' ][ 'args' ] = array(
        'menu_icon' => get_template_directory_uri() . '/lib/images/custom.team.png',
        'public' => true,
        'hierarchical' => false,
        'rewrite' => array( 'team' => __('banner','cosmotheme'), 'with_front' => true ),
        'menu_position' => 9,
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'exclude_from_search' => true,
        '__on_front_page' => false
    );

    $form[ 'team' ][ 'settings' ][ 'facebook' ]            = array( 'type' => 'st--text' , 'label' => __( 'Facebook' , 'cosmotheme') , 'id' => 'team_facebook', 'hint' => '(i.e. https://www.facebook.com/CosmoThemes)' );
    $form[ 'team' ][ 'settings' ][ 'twitter' ]             = array( 'type' => 'st--text' , 'label' => __( 'Twitter' , 'cosmotheme') , 'id' => 'team_twitter', 'hint' => '(i.e. https://twitter.com/cosmothemes)' );
    $form[ 'team' ][ 'settings' ][ 'linkedin' ]            = array( 'type' => 'st--text' , 'label' => __( 'LinkedIn' , 'cosmotheme') , 'id' => 'team_linkedin', 'hint' => '(i.e. http://www.linkedin.com/company/cosmothemes)' );
   

    $form[ 'team' ][ 'settings' ]['gplus']                 = array('type' => 'st--text' , 'label' => __( 'Google+' , 'cosmotheme' ), 'id' => 'team_google', 'hint' => __( '(i.e. https://plus.google.com/u/0/b/103218861385999897717/)' , 'cosmotheme' ) );
    $form[ 'team' ][ 'settings' ]['yahoo']                 = array('type' => 'st--text' , 'label' => __( 'Yahoo' , 'cosmotheme' ), 'id' => 'team_yahoo','hint' => __( '(i.e. http://profile.yahoo.com/56W6RBFOFVLLSUQBHREPTDQW4U/)' , 'cosmotheme' ) );
    $form[ 'team' ][ 'settings' ]['dribbble']              = array('type' => 'st--text' , 'label' => __( 'Dribbble ' , 'cosmotheme' ), 'id' => 'team_dribbble','hint' => __( '(i.e. http://dribbble.com/cosmothemes)' , 'cosmotheme' ) );
  
    $form[ 'team' ][ 'settings' ]['vimeo']                 = array('type' => 'st--text' , 'label' => __( 'Vimeo' , 'cosmotheme' ) , 'id' => 'team_vimeo','hint' => __( '(i.e. http://vimeo.com/user10929709)' , 'cosmotheme' ) );
    $form[ 'team' ][ 'settings' ]['youtube']               = array('type' => 'st--text' , 'label' => __( 'Youtube' , 'cosmotheme' ) , 'id' => 'team_youtube', 'hint' => __( '(i.e. http://www.youtube.com/user/vasilerusnac)' , 'cosmotheme' ) );
    $form[ 'team' ][ 'settings' ]['tumblr']                = array('type' => 'st--text' , 'label' => __( 'Tumblr ' , 'cosmotheme' ) , 'id' => 'team_tumblr', 'hint' => __( '(i.e. http://virusnac.tumblr.com/)' , 'cosmotheme' ) );
    $form[ 'team' ][ 'settings' ]['delicious']             = array('type' => 'st--text' , 'label' => __( 'Delicious ' , 'cosmotheme' ) , 'id' => 'team_delicious', 'hint' => __( '(i.e. https://delicious.com/cosmothemes)' , 'cosmotheme' ) );
    $form[ 'team' ][ 'settings' ]['flickr']                = array('type' => 'st--text' , 'label' => __( 'Flickr' , 'cosmotheme' ) , 'id' => 'team_flickr', 'hint' => __( '(i.e. http://www.flickr.com/photos/cosmothemes/)' , 'cosmotheme' ) );
    $form[ 'team' ][ 'settings' ]['instagram']             = array('type' => 'st--text' , 'label' => __( 'Instagram' , 'cosmotheme' ) , 'id' => 'team_instagram', 'hint' => __( '(i.e. http://instagram.com/yourname)' , 'cosmotheme' ) );
    $form[ 'team' ][ 'settings' ]['pinterest']             = array('type' => 'st--text' , 'label' => __( 'Pinterest' , 'cosmotheme' ) , 'id' => 'team_pinterest', 'hint' => __( '(i.e. http://pinterest.com/cosmothemes)' , 'cosmotheme' ) );

    $form[ 'team' ][ 'settings' ]['email']                 = array('type' => 'st--text' , 'label' => __( 'Contact email' , 'cosmotheme' ) , 'id' => 'team_email');
    $form[ 'team' ][ 'settings' ]['skype']                 = array('type' => 'st--text' , 'label' => __( 'Skype Name' , 'cosmotheme' ) ,'id' => 'team_skype' );
      






    $box[ 'team' ][ 'settings' ]                   = array( __( 'Team settings' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form[ 'team' ][ 'settings' ] , 'box' => 'info', 'update' => true );

    resources::$labels[ 'team' ]         = $res[ 'team' ][ 'labels' ];
    resources::$type[ 'team' ]           = $res[ 'team' ][ 'args' ];
    resources::$box[ 'team' ]            = $box[ 'team' ];

    /*---------------------EOF teams post type--------------------------*/

    /*get post type*/
    if( isset($_GET['post']) && is_numeric($_GET['post']) ) {
        $this_post_type = get_post_type($_GET['post']);
    }elseif(isset($_GET['post_type'])){
        $this_post_type = $_GET['post_type'];
    }else{
        $this_post_type = '';
    }
    
    
    $sliders = get__posts( array( 'post_status' => 'publish' , 'post_type' => 'slideshow' ) , '' );
    $form['post']['settings']['show_title']       = array('type' => 'st--logic-radio' , 'label' => __( 'Hide post title' , 'cosmotheme' ) );
    $form['post']['settings']['featured']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Display featured image inside the post' , 'cosmotheme' ) , 'hint' => __( 'If enabled featured images will be displayed on post page' , 'cosmotheme' ) , 'cvalue' => options::get_value(  'blog_post' , 'enb_featured' ) );
    $form['post']['settings']['related']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show related posts' , 'cosmotheme' ) , 'hint' => __( 'Show related posts on this post' , 'cosmotheme' ) , 'cvalue' => options::get_value(  'blog_post' , 'show_similar' ) );
    
    if (options::logic( 'blog_post' , 'meta' )) {
        $form['post']['settings']['meta']       = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show post meta' , 'cosmotheme' ) , 'hint' => __( 'Show post meta on this post' , 'cosmotheme' ) , 'cvalue' => options::get_value(  'blog_post' , 'meta' ) );
        $meta_view_type = array('horizontal' => __('Horizontal','cosmotheme'), 'vertical' => __('Vertical','cosmotheme') );  
        if (isset($_GET['post']) && is_admin()) {
            $settings = meta::get_meta( $_GET['post'] , 'settings' );

            if(isset($settings['meta']) && $settings['meta'] == 'yes'){
                $form['post']['settings']['love']       = array( 'type' => 'st--logic-radio' , 'classes' => 'post_love', 'label' => __( 'Show post like' , 'cosmotheme' ) , 'hint' => __( 'Show post like on this post' , 'cosmotheme' )  , 'cvalue' => options::get_value(  'likes' , 'enb_likes' ) );
            }else{
                $form['post']['settings']['love']       = array( 'type' => 'st--logic-radio' , 'classes' => 'post_love hidden', 'label' => __( 'Show post like' , 'cosmotheme' ) , 'hint' => __( 'Show post like on this post' , 'cosmotheme' )  , 'cvalue' => options::get_value(  'likes' , 'enb_likes' ) );
            }
        } elseif(!isset($_GET['post']) && is_admin()){
             $form['post']['settings']['love']       = array( 'type' => 'st--logic-radio' , 'classes' => 'post_love', 'label' => __( 'Show post like' , 'cosmotheme' ) , 'hint' => __( 'Show post like on this post' , 'cosmotheme' )  , 'cvalue' => options::get_value(  'likes' , 'enb_likes' ) );
        }
    }

    $form['post']['settings']['sharing']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show social sharing' , 'cosmotheme' ) , 'hint' => __( 'Show social sharing on this post'  , 'cosmotheme' ) , 'cvalue' => options::get_value( 'blog_post' , 'post_sharing' ) );
    //$form['post']['settings']['author']     = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show author box' , 'cosmotheme' ) , 'hint' => __( 'Show author box on this post'  , 'cosmotheme' ) , 'cvalue' => options::get_value( 'blog_post' , 'post_author_box' ) );
    $form['post']['settings']['show_feat_on_archive'] = array( 'type' => 'st--logic-radio' , 'label' => __( 'Display featured image on archive pages' , 'cosmotheme' ) ,  'cvalue' => options::get_value( 'blog_post' , 'show_feat_on_archive' ) );
    //$form[ 'post' ][ 'settings' ][ 'enb_navigation' ] = array( 'type' => 'st--logic-radio' , 'label' => __( 'Enable navigation for this post' , 'cosmotheme' ) , 'hint' => __( 'If enabled, this post will show links to the next and previous posts.' , 'cosmotheme' )  ,  'cvalue' => options::get_value( 'blog_post', 'enb-next-prev' ) );
    $form['post']['settings']['thumb_link']       = array( 'type' => 'st--text' , 'label' => __( 'Add custom link to post\'s thumbnail.' , 'cosmotheme' ), 'hint' => __( 'If a link is added, the thumbnail will not link the actual post, but will redirect to the inserted link. Insert with http://example.com' , 'cosmotheme' )   );
    $form['post']['settings']['thumb_link_tab']  = array( 'type' => 'st--logic-radio', 'label' => __( 'Open thumbnail link in a new tab' , 'cosmotheme' )  );

    $form['post']['settings']['post_bg']    = array( 'type' => 'st--upload' , 'label' => __( 'Upload or choose image from media library' , 'cosmotheme') , 'id' => 'post_background' , 'hint' => __( 'This will be the background image for this post' , 'cosmotheme' ) );
    $form['post']['settings']['position']   = array( 'type' => 'st--select' , 'label' => __( 'Image background position' , 'cosmotheme' ) , 'value' => array( 'left' => __( 'Left' , 'cosmotheme' ) , 'center' => __( 'Center' , 'cosmotheme' ) , 'right' => __( 'Right' , 'cosmotheme' ) ) );
    $form['post']['settings']['repeat']     = array( 'type' => 'st--select' , 'label' => __( 'Image background repeat' , 'cosmotheme' ) , 'value' => array( 'no-repeat' => __( 'No Repeat' , 'cosmotheme' ) , 'repeat' => __( 'Tile' , 'cosmotheme' ) , 'repeat-x' => __( 'Tile Horizontally' , 'cosmotheme' ) , 'repeat-y' => __( 'Tile Vertically' , 'cosmotheme' ) ) );
    $form['post']['settings']['attachment'] = array( 'type' => 'st--select' , 'label' => __( 'Image background attachment type' , 'cosmotheme' ) , 'value' => array( 'scroll' => __( 'Scroll' , 'cosmotheme' ) , 'fixed' => __( 'Fixed' , 'cosmotheme' ) ) );
    $form['post']['settings']['color']      = array( 'type' => 'st--color-picker' , 'label' => __( 'Set background color for this post' , 'cosmotheme' ) );

    $form['post']['settings'][ 'show_sly_caption' ]   = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show top-left image caption for gallery posts' , 'cosmotheme' ), 'hint' =>__( 'If enabled, every image will display it\'s caption, if it has one' , 'cosmotheme' ), 'cvalue' => options::get_value( 'blog_post' , 'show_sly_caption' )  );
  
    if( isset( $_GET['post'] ) ){
        $post_format = get_post_format( $_GET['post'] );
    }else{
        $post_format = 'standard';
    }

    $form['post']['format']['type']         = array( 'type' => 'st--select' , 'label' => __( 'Select post format' , 'cosmotheme' ) , 'value' => array(  'standard' => __( 'Standard' , 'cosmotheme' ) , 'video' => __( 'Video' , 'cosmotheme' ) , 'image' => __( 'Image' , 'cosmotheme' ) , 'audio' => __( 'Audio' , 'cosmotheme' )  , 'link' => __( 'Attachment' , 'cosmotheme' ), 'gallery' => __( 'Gallery' , 'cosmotheme' ), 'quote' => __( 'Quote' , 'cosmotheme' ) )  , 'action' => "act.select( '.post_format_type' , { 'video' : '.post_format_video' , 'image' : '.post_format_image' , 'audio' : '.post_format_audio' , 'link' : '.post_format_link', 'gallery' : '.post_format_gallery' } , 'sh_' );" , 'iclasses' => 'post_format_type' , 'ivalue' =>  $post_format );

    if( isset( $_GET['post'] ) && get_post_format( $_GET['post'] ) == 'video' ){
        $form['post']['format']['video']=array('type'=>'ni--form-upload', 'format'=>'video', 'classes'=>"post_format_video", 'post_id'=>$_GET['post']);
    }else{
        $form['post']['format']['video']=array('type'=>'ni--form-upload', 'format'=>'video', 'classes'=>"hidden post_format_video");
    }

    
    $form['post']['format']['init']=array('type'=>"no--form-upload-init");

    if( isset( $_GET['post'] ) && get_post_format( $_GET['post'] ) == 'image' ){
        $form['post']['format']['image']=array('type'=>'ni--form-upload', 'format'=>'image', 'classes'=>"post_format_image", 'post_id'=>$_GET['post']);
    }else{
        $form['post']['format']['image']=array('type'=>'ni--form-upload', 'format'=>'image', 'classes'=>"post_format_image hidden");
    }

    if( isset( $_GET['post'] ) && get_post_format( $_GET['post'] ) == 'gallery' ){
        $form['post']['format']['gallery']=array('type'=>'ni--form-upload', 'format'=>'gallery', 'classes'=>"post_format_gallery", 'post_id'=>$_GET['post']);
    }else{
        $form['post']['format']['gallery']=array('type'=>'ni--form-upload', 'format'=>'gallery', 'classes'=>"post_format_gallery hidden");
    }


    $form['post']['format']['init']=array('type'=>"no--form-upload-init");

    

    if( isset( $_GET['post'] ) && get_post_format( $_GET['post'] ) == 'audio' ){
        $form['post']['format']['audio']=array('type'=>'ni--form-upload', 'format'=>'audio', 'classes'=>"post_format_audio", 'post_id'=>$_GET['post']);
    }else{
        $form['post']['format']['audio']=array('type'=>'ni--form-upload', 'format'=>'audio', 'classes'=>"post_format_audio hidden");
    }
    
    if( isset( $_GET['post'] ) && get_post_format( $_GET['post'] ) == 'link' ){
        $form['post']['format']['link']=array('type'=>'ni--form-upload', 'format'=>'link', 'classes'=>"post_format_link", 'post_id'=>$_GET['post']);
    }else{
        $form['post']['format']['link']=array('type'=>'ni--form-upload', 'format'=>'link', 'classes'=>"post_format_link hidden");
    }

    $box['post']['shcode']                  = array( __('Shortcodes' , 'cosmotheme' ) , 'normal' , 'high'  , 'box' => 'shcode' , 'includes' => 'shcode/main.php' );
    $box['post']['settings']                = array( __('Post Settings' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['post']['settings'] , 'box' => 'settings' , 'update' => true  );
    $box['post']['format']                  = array( __('Post Format' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['post']['format'] , 'box' => 'format' , 'update' => true );
    
        

    $box['post']['layout']                 = array(
        __( 'Page Builder' , 'cosmotheme' ),
        'normal',
        'high',
        'content' => array(
            array(
                'type' => 'cd--whatever',
                'content' => new LBPageResizer()
            )
        ) ,
        'box' => 'builder',
        'update' => true
    );
    
    resources::$type['post']                = array();
    resources::$box['post']                 = $box['post'];

    //resources::$box[ 'gallery' ]          = $box[ 'post' ];

    
  
    if(isset($_GET['post'])){
        $the_source = post::get_source($_GET['post']);
    }
    
    
    if (options::logic( 'blog_post' , 'meta' )) {
        $form['post']['settings']['meta']       = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show post meta' , 'cosmotheme' ) , 'hint' => __( 'Show post meta on this post' , 'cosmotheme' ) , 'cvalue' => options::get_value(  'blog_post' , 'meta' ) );
        $meta_view_type = array('horizontal' => __('Horizontal','cosmotheme'), 'vertical' => __('Vertical','cosmotheme') );  
        if (isset($_GET['post']) && is_admin()) {
            $settings = meta::get_meta( $_GET['post'] , 'settings' );

            if(isset($settings['meta']) && $settings['meta'] == 'yes'){
                $form['post']['settings']['love']       = array( 'type' => 'st--logic-radio' , 'classes' => 'post_love', 'label' => __( 'Show post like' , 'cosmotheme' ) , 'hint' => __( 'Show post like on this post' , 'cosmotheme' )  , 'cvalue' => options::get_value(  'likes' , 'enb_likes' ) );
            }else{
                $form['post']['settings']['love']       = array( 'type' => 'st--logic-radio' , 'classes' => 'post_love hidden', 'label' => __( 'Show post like' , 'cosmotheme' ) , 'hint' => __( 'Show post like on this post' , 'cosmotheme' )  , 'cvalue' => options::get_value(  'likes' , 'enb_likes' ) );
            }
        } elseif(!isset($_GET['post']) && is_admin()){
             $form['post']['settings']['love']       = array( 'type' => 'st--logic-radio' , 'classes' => 'post_love', 'label' => __( 'Show post like' , 'cosmotheme' ) , 'hint' => __( 'Show post like on this post' , 'cosmotheme' )  , 'cvalue' => options::get_value(  'likes' , 'enb_likes' ) );
        }
    }

    if (options::logic( 'blog_post' , 'page_meta' )) {
        $form['page']['settings']['meta']       = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show page meta' , 'cosmotheme' ) , 'hint' => 'Show post meta on this page' , 'cvalue' => options::get_value(  'blog_post' , 'page_meta' ));
        
        if (isset($_GET['post']) && is_admin()) {
            $settings = meta::get_meta( $_GET['post'] , 'settings' );

            if(isset($settings['meta']) && $settings['meta'] == 'yes'){
                $form[ 'page' ][ 'settings' ][ 'love' ] = array( 
                    'type' => 'st--logic-radio' , 
                    'label' => __( 'Show post like' , 'cosmotheme' ) , 
                    'hint' => __( 'Show post like on this post' , 'cosmotheme' )  ,
                    'cvalue' => options::get_value(  'likes' , 'enb_likes' ),
                    'classes' => 'page_love'
                ); 
            }else{
                $form[ 'page' ][ 'settings' ][ 'love' ] = array( 
                    'type' => 'st--logic-radio' , 
                    'label' => __( 'Show post like' , 'cosmotheme' ) , 
                    'hint' => __( 'Show post like on this post' , 'cosmotheme' )  ,
                    'cvalue' => options::get_value(  'likes' , 'enb_likes' ),
                    'classes' => 'page_love hidden'
                );                 
            }
        } elseif(!isset($_GET['post']) && is_admin()){
            $form[ 'page' ][ 'settings' ][ 'love' ] = array( 
                'type' => 'st--logic-radio' , 
                'label' => __( 'Show post like' , 'cosmotheme' ) , 
                'hint' => __( 'Show post like on this post' , 'cosmotheme' )  ,
                'cvalue' => options::get_value(  'likes' , 'enb_likes' ),
                'classes' => 'page_love'
            );            
        }
      
    }
    $form['page']['settings']['show_title']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Hide page title' , 'cosmotheme' ) );
    $form['page']['settings']['sharing']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show social sharing' , 'cosmotheme' ) , 'hint' => 'Show social sharing on this page' , 'cvalue' => options::get_value( 'blog_post' , 'page_sharing' ) );
    //$form[ 'page' ][ 'settings' ][ 'enb_navigation' ] = array( 'type' => 'st--logic-radio' , 'label' => __( 'Enable navigation for this page' , 'cosmotheme' ) , 'hint' => __( 'If enabled, this page will show links to the next and previous pages.' , 'cosmotheme' )  ,  'cvalue' => options::get_value( 'blog_post', 'navigation_page' ) );
    //$form['page']['settings']['author']     = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show author box' , 'cosmotheme' ) , 'hint' => 'Show author box on this page' , 'cvalue' => options::get_value( 'blog_post' , 'page_author_box' ) );
    $form['page']['settings']['post_bg']    = array( 'type' => 'st--upload' , 'label' => __( 'Upload image, or choose from media library.' , 'cosmotheme') , 'id' => 'post_background' , 'hint' => __( 'This will be the background image for this page' , 'cosmotheme' ) );
    $form['page']['settings']['position']   = array( 'type' => 'st--select' , 'label' => __( 'Background position' , 'cosmotheme' ) , 'value' => array( 'left' => __( 'Left' , 'cosmotheme' ) , 'center' => __( 'Center' , 'cosmotheme' ) , 'right' => __( 'Right' , 'cosmotheme' ) ) );
    $form['page']['settings']['repeat']     = array( 'type' => 'st--select' , 'label' => __( 'Background repeat' , 'cosmotheme' ) , 'value' => array( 'no-repeat' => __( 'No Repeat' , 'cosmotheme' ) , 'repeat' => __( 'Tile' , 'cosmotheme' ) , 'repeat-x' => __( 'Tile Horizontally' , 'cosmotheme' ) , 'repeat-y' => __( 'Tile Vertically' , 'cosmotheme' ) ) );
    $form['page']['settings']['attachment'] = array( 'type' => 'st--select' , 'label' => __( 'Background attachment type' , 'cosmotheme' ) , 'value' => array( 'scroll' => __( 'Scroll' , 'cosmotheme' ) , 'fixed' => __( 'Fixed' , 'cosmotheme' ) ) );
    $form['page']['settings']['color']      = array( 'type' => 'st--color-picker' , 'label' => __( 'Set background color for this post' , 'cosmotheme' ) );

    $box['page']['shcode']                  = array( __('Shortcodes' , 'cosmotheme' ) , 'normal' , 'high'  , 'box' => 'shcode' , 'includes' => 'shcode/main.php' );
    $box['page']['settings']                = array( __('Page Settings' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['page']['settings'] , 'box' => 'settings' , 'update' => true  );
    $box['page']['builder']                 = array(
        __( 'Page Builder' , 'cosmotheme' ) ,
        'normal' ,
        'high' ,
        'content' => array(
            array(
                'type' => 'cd--whatever',
                'content' => new LBPageResizer()
            )
        ) ,
        'box' => 'builder' ,
        'update' => true
    );
    
    
    resources::$type['page']                = array();
    resources::$box['page']                 = $box['page'];


    /*  check if woocommerce is installed*/    
    if ( class_exists( 'WooCommerce' ) ) {
        /*boxes for product post type that comes from woocomerce plugin*/
        $product_box = $box[ 'page' ];
        /*we want to unset the settings box for products*/
        unset($product_box['settings']);
        
        resources::$box[ 'product' ]          = $product_box;
    }
?>