<?php
    /* register pages */
    
    $current_theme_name = wp_get_theme();
    

    options::$menu[ 'cosmothemes' ][ 'general' ]        = array( 'label' => __( 'General' , 'cosmotheme' ) , 'title' => __( 'General settings' , 'cosmotheme' ) , 'description' => __( 'General page description.' , 'cosmotheme' ) , 'type' => 'main' , 'main_label' => $current_theme_name . ' ' );
        options::$menu[ 'cosmothemes' ][ 'settings' ]       = array( 'label' => __( 'Settings', 'cosmotheme' ), 'title' => __( 'Setttings', 'cosmotheme' ), 'description' => __( 'General theme settings', 'cosmotheme' ) );
            //options::$menu[ 'cosmothemes' ][ 'settings' ][ 'contains' ][ 'welcome' ] = array( 'label' => __( 'Welcome' , 'cosmotheme' ) , 'title' => __( 'Welcome' , 'cosmotheme' ), 'update' => false );
            options::$menu[ 'cosmothemes' ][ 'settings' ][ 'contains' ][ 'general' ] = array( 'label' => __( 'General' , 'cosmotheme' ) , 'title' => __( 'General settings' , 'cosmotheme' ) , 'description' => __( 'General page description.' , 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'settings' ][ 'contains' ][ 'styling' ] = array( 'label' => __( 'Styling' , 'cosmotheme' )  , 'title' => __( 'Styling settings' , 'cosmotheme' )  , 'description' => __( 'The basic layout structure for color and background effects' , 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'settings' ][ 'contains' ][ 'typography' ] = array( 'label' => __( 'Typography' , 'cosmotheme' )  , 'title' => __( 'Typography settings' , 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'settings' ][ 'contains' ][ 'likes' ] = array( 'label' => __( 'Likes' , 'cosmotheme' ) , 'title' => __( 'Likes settings' , 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'settings' ][ 'contains' ][ 'blog_post' ] = array( 'label' => __( 'Post settings' , 'cosmotheme' ) , 'title' => __( 'Post settings' , 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'settings' ][ 'contains' ][ 'social' ] = array( 'label' => __( 'Social' , 'cosmotheme' ) , 'title' => __( 'Social' , 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'settings' ][ 'contains' ][ 'imagesizes' ] = array( 'label' => __( 'Image sizes' , 'cosmotheme' ) , 'title' => __( 'Image sizes' , 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'settings' ][ 'contains' ][ 'tooltips' ] = array( 'label' => __( 'Tooltips' , 'cosmotheme' )  , 'title' => __( 'Tooltips manager' , 'cosmotheme' ) );
        options::$menu[ 'cosmothemes' ][ 'templates' ]      = array( 'label' => __( 'Templates', 'cosmotheme' ), 'title' => __( 'Templates', 'cosmotheme' ), 'description' => __( 'Templates settings', 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'templates' ][ 'contains' ][ 'mainpage' ] = array( 'label' => __( 'Main page' , 'cosmotheme' )  , 'title' => __( 'Main page' , 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'templates' ][ 'contains' ][ 'blogpage' ] = array( 'label' => __( 'Blog page' , 'cosmotheme' )  , 'title' => __( 'Blog page' , 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'templates' ][ 'contains' ][ 'archive' ] = array( 'label' => __( 'Archive' , 'cosmotheme' )  , 'title' => __( 'Archive' , 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'templates' ][ 'contains' ][ 'category' ] = array( 'label' => __( 'Category' , 'cosmotheme' )  , 'title' => __( 'Category' , 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'templates' ][ 'contains' ][ 'searchpage' ] = array( 'label' => __( 'Search results' , 'cosmotheme' )  , 'title' => __( 'Search results' , 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'templates' ][ 'contains' ][ 'tag' ] = array( 'label' => __( 'Tag listing' , 'cosmotheme' )  , 'title' => __( 'Tag listing' , 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'templates' ][ 'contains' ][ 'author' ] = array( 'label' => __( 'Author posts' , 'cosmotheme' )  , 'title' => __( 'Author posts' , 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'templates' ][ 'contains' ][ '404' ] = array( 'label' => __( '404' , 'cosmotheme' )  , 'title' => __( '404' , 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'templates' ][ 'contains' ][ 'gallery_category' ] = array( 'label' => __( 'Gallery categories' , 'cosmotheme' )  , 'title' => __( 'Gallery categories' , 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'templates' ][ 'contains' ][ 'gallery_tag' ] = array( 'label' => __( 'Gallery tags' , 'cosmotheme' )  , 'title' => __( 'Gallery tags' , 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'templates' ][ 'contains' ][ 'single' ] = array( 'label' => __( 'Single page' , 'cosmotheme' )  , 'title' => __( 'Single page' , 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'templates' ][ 'contains' ][ 'page' ] = array( 'label' => __( 'Page' , 'cosmotheme' )  , 'title' => __( 'Page' , 'cosmotheme' ) );

        options::$menu[ 'cosmothemes' ][ 'layouts' ] = array( 'label' => __( 'Layouts', 'cosmotheme' ), 'title' => __( 'Layouts', 'cosmotheme' ), 'description' => __( 'Layouts', 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'layouts' ][ 'contains' ][ '404_layout' ] = array( 'label' => __( '404', 'cosmotheme' ), 'title' => __( '404', 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'layouts' ][ 'contains' ][ 'archive_layout' ] = array( 'label' => __( 'Archives by date', 'cosmotheme' ), 'title' => __( 'Archive', 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'layouts' ][ 'contains' ][ 'archive_format_layout' ] = array( 'label' => __( 'Post format archive', 'cosmotheme' ), 'title' => __( 'Post format archive', 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'layouts' ][ 'contains' ][ 'archive_post_type_layout' ] = array( 'label' => __( 'Post type archive', 'cosmotheme' ), 'title' => __( 'Post type archive', 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'layouts' ][ 'contains' ][ 'attachment_layout' ] = array( 'label' => __( 'Attachment', 'cosmotheme' ), 'title' => __( 'Attachment', 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'layouts' ][ 'contains' ][ 'author_layout' ] = array( 'label' => __( 'Author archives', 'cosmotheme' ), 'title' => __( 'Author archives', 'cosmotheme' ) );
            /*  check if woocommerce is installed*/    
            if ( class_exists( 'WooCommerce' ) ) {
                options::$menu[ 'cosmothemes' ][ 'layouts' ][ 'contains' ][ 'woo_shop_layout' ] = array( 'label' => __( 'Shop page', 'cosmotheme' ), 'title' => __( 'Shop page', 'cosmotheme' ) );
                
                options::$menu[ 'cosmothemes' ][ 'layouts' ][ 'contains' ][ 'product_layout' ] = array( 'label' => __( 'Products', 'cosmotheme' ), 'title' => __( 'Products', 'cosmotheme' ) );
                options::$menu[ 'cosmothemes' ][ 'layouts' ][ 'contains' ][ 'product_category_layout' ] = array( 'label' => __( 'Product categories', 'cosmotheme' ), 'title' => __( 'Product categories', 'cosmotheme' ) );
                options::$menu[ 'cosmothemes' ][ 'layouts' ][ 'contains' ][ 'product_tag_layout' ] = array( 'label' => __( 'Product tags', 'cosmotheme' ), 'title' => __( 'Product tags', 'cosmotheme' ) );

            }
            options::$menu[ 'cosmothemes' ][ 'layouts' ][ 'contains' ][ 'category_layout' ] = array( 'label' => __( 'Categories', 'cosmotheme' ), 'title' => __( 'Categories', 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'layouts' ][ 'contains' ][ 'front_page_layout' ] = array( 'label' => __( 'Front page', 'cosmotheme' ), 'title' => __( 'Front page', 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'layouts' ][ 'contains' ][ 'index_layout' ] = array( 'label' => __( 'Index', 'cosmotheme' ), 'title' => __( 'Index', 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'layouts' ][ 'contains' ][ 'gallery_category_layout' ] = array( 'label' => __( 'Gallery categories', 'cosmotheme' ), 'title' => __( 'Gallery categories', 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'layouts' ][ 'contains' ][ 'gallery_tag_layout' ] = array( 'label' => __( 'Gallery tags', 'cosmotheme' ), 'title' => __( 'Gallery tags', 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'layouts' ][ 'contains' ][ 'tag_layout' ] = array( 'label' => __( 'Tags', 'cosmotheme' ), 'title' => __( 'Tags', 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'layouts' ][ 'contains' ][ 'search_layout' ] = array( 'label' => __( 'Search', 'cosmotheme' ), 'title' => __( 'Search', 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'layouts' ][ 'contains' ][ 'page_layout' ] = array( 'label' => __( 'Pages', 'cosmotheme' ), 'title' => __( 'Pages', 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'layouts' ][ 'contains' ][ 'single_layout' ] = array( 'label' => __( 'Posts', 'cosmotheme' ), 'title' => __( 'Posts', 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'layouts' ][ 'contains' ][ 'gallery_layout' ] = array( 'label' => __( 'Gallery posts', 'cosmotheme' ), 'title' => __( 'Gallery posts', 'cosmotheme' ) );
            
        options::$menu[ 'cosmothemes' ][ 'extra' ]          = array( 'label' => __( 'Extra', 'cosmotheme' ), 'title' => __( 'Extra', 'cosmotheme' ), 'description' => __( 'Extra settings', 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'extra' ][ 'contains' ][ '_sidebar' ] = array( 'label' => __( 'Sidebars' , 'cosmotheme' )  , 'title' => __( 'Sidebar manager' , 'cosmotheme' ), 'update' => false );
            options::$menu[ 'cosmothemes' ][ 'extra' ][ 'contains' ][ 'custom_css' ] = array( 'label' => __( 'Custom CSS' , 'cosmotheme' )  , 'title' => __( 'Custom CSS' , 'cosmotheme' ) , 'update' => true );
            options::$menu[ 'cosmothemes' ][ 'extra' ][ 'contains' ][ 'cosmothemes' ] = array( 'label' => __( 'Notifications' , 'cosmotheme' )  , 'title' => __( 'Notifications' , 'cosmotheme' ) );
            options::$menu[ 'cosmothemes' ][ 'extra' ][ 'contains' ][ 'io' ] = array( 'label' => __( 'Import / Export' , 'cosmotheme' )  , 'title' => __( 'Import/Export' , 'cosmotheme' ) );
//            options::$menu[ 'cosmothemes' ][ 'extra' ][ 'contains' ][ 'themes' ] = array( 'label' => __( 'Themes' , 'cosmotheme' )  , 'title' => __( 'Themes' , 'cosmotheme' ), 'update' => false );

    /*
        options::$menu['cosmothemes']['menu']               = array( 'label' => __( 'Menus' , 'cosmotheme' )  , 'title' => __( 'Menu settings' , 'cosmotheme' )  , 'description' => __( 'Menu page description.' , 'cosmotheme' ) );
    */;


    options::$fields[ 'mainpage' ][ 'mainpage' ] = array( 'type' => 'no--layout-builder' );
    options::$fields[ 'blogpage' ][ 'builder' ] = array( 'type' => 'no--layout-builder' );
    options::$fields[ 'archive' ][ 'builder' ] = array( 'type' => 'no--layout-builder' );
    options::$fields[ 'category' ][ 'builder' ] = array( 'type' => 'no--layout-builder' );
    options::$fields[ 'searchpage' ][ 'builder' ] = array( 'type' => 'no--layout-builder' );
    options::$fields[ 'tag' ][ 'builder' ] = array( 'type' => 'no--layout-builder' );
    options::$fields[ 'author' ][ 'mainpage' ] = array( 'type' => 'no--layout-builder' );
    options::$fields[ '404' ][ 'builder' ] = array( 'type' => 'no--layout-builder' );
    options::$fields[ 'gallery_category' ][ 'builder' ] = array( 'type' => 'no--layout-builder' );
    options::$fields[ 'gallery_tag' ][ 'builder' ] = array( 'type' => 'no--layout-builder' );
    options::$fields[ 'single' ][ 'builder' ] = array( 'type' => 'no--layout-builder' );
    options::$fields[ 'page' ][ 'builder' ] = array( 'type' => 'no--layout-builder' );

    /* OPTIONS */
    /* GENERAL DEFAULT VALUE */
    options::$default['likes']['enb_likes']             = 'yes';
    options::$default['likes']['min_likes']             =  50;
    //options::$default[ 'likes' ][ 'icons' ]             = 'heart';
    options::$default[ 'likes' ][ 'show_count' ]        = 'yes';
    options::$default['general']['user_register']       = 'yes';

    options::$default['general']['time']                = 'yes';
    options::$default['general']['fb_comments']         = 'no';
    options::$default['general']['show_admin_bar']      = 'no';

    /* GENERAL OPTIONS */
    
    options::$fields['general']['time']                 = array( 'type' => 'st--logic-radio' , 'label' => __( 'Use human time' , 'cosmotheme') ,  'hint' => __( 'If set No will use WordPress time format'  , 'cosmotheme' ) );
    options::$fields['general']['fb_comments']          = array( 'type' => 'st--logic-radio' , 'label' => __( 'Use Facebook comments' , 'cosmotheme' ), 'action' => "act.check( this , { 'yes' : '.fb_app_id ' , 'no' : '' } , 'sh' );" );
    options::$fields['general']['fb_app_id_note']       = array( 'type' => 'st--hint' , 'value' => __( 'You can set Facebook application ID' , 'cosmotheme' ) . ' <a href="admin.php?page=cosmothemes__settings&tab=social">' . __( 'here' , 'cosmotheme') . '</a> ' );
    options::$fields['general']['show_admin_bar']       = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show WordPress admin bar' , 'cosmotheme' ));

    
    if( options::logic( 'general' , 'fb_comments' ) ){
        options::$fields['general']['fb_app_id_note']['classes']     = 'fb_app_id';
    }else{
        options::$fields['general']['fb_app_id_note']['classes']     = 'fb_app_id hidden';
    }

    // if woocommerce is enabled
    if ( class_exists( 'WooCommerce' ) ) {
        options::$fields['general']['new_customer']         = array('type' => 'st--textarea' , 'label' => __( 'I\'m a new customer text' , 'cosmotheme' ) , 'hint' => __( 'Type here the text that will appear below <br />I\'M A NEW CUSTOMER label' , 'cosmotheme' ) );
        options::$fields['general']['returning_customer']   = array('type' => 'st--textarea' , 'label' => __( 'I\'m a returning customer text' , 'cosmotheme' ) , 'hint' => __( 'Type here the text that will appear below <br />I\'M A RETURNING CUSTOMER label' , 'cosmotheme' ) );

        options::$default['general']['new_customer']        = __( 'Praesent pellentesque sodales ante, et molestie nisi mattis non. Suspendisse ullamcorper aliquam pharetra. Maecenas interdum consequat feugiat. Aliquam erat volutpat.' , 'cosmotheme' );
        options::$default['general']['returning_customer']  = __( 'Praesent pellentesque sodales ante, et molestie nisi mattis non. Suspendisse ullamcorper aliquam pharetra. Maecenas interdum consequat feugiat. Aliquam erat volutpat.' , 'cosmotheme' );

    }

    options::$fields['general']['tracking_code']        = array('type' => 'st--textarea' , 'label' => __( 'Tracking code' , 'cosmotheme' ) , 'hint' => __( 'Paste your Google Analytics or other tracking code here.<br />It will be added into the footer of this theme' , 'cosmotheme' ) );
    options::$fields['general']['copy_right']           = array('type' => 'st--textarea' , 'label' => __( 'Copyright text' , 'cosmotheme' ) , 'hint' => __( 'Type here the Copyright text that will appear in the footer.<br />To display the current year use "%year%"' , 'cosmotheme' ) );
    

    options::$default['general']['copy_right']          = 'Copyright &copy; %year% <a href="http://cosmothemes.com" target="_blank">CosmoThemes</a>. All rights reserved.';


    /*LIKES OPTIONS*/
    options::$fields['likes']['enb_likes']            = array( 'type' => 'st--logic-radio' , 'label' => __( 'Enable Likes for posts' , 'cosmotheme') , 'action' => "act.check( this , { 'yes' : '.g_like , .g_l_register' , 'no' : '' } , 'sh' );" , 'iclasses' => 'g_e_likes');
    options::$fields['likes']['min_likes']            = array( 'type' => 'st--digit-like' , 'label' => __( 'Minimum number of Likes to set Featured' , 'cosmotheme' ) , 'hint' => __( 'Set minimum number of post likes to change it into a featured post' , 'cosmotheme' ) , 'id' => 'nr_min_likes' ,'action' => "act.min_likes(  jQuery( '#nr_min_likes').val() , 1 );"  );
    options::$fields['likes']['sim_likes']            = array( 'type' => 'st--button' , 'value' => __( 'Generate' , 'cosmotheme' ) , 'label' => __( 'Generate random number of Likes for posts' , 'cosmotheme' ) , 'action' => "act.sim_likes( 1 );" , 'hint' => __( 'WARNING! This will reset all current Loves.' , 'cosmotheme' ) );
    options::$fields['likes']['reset_likes']          = array( 'type' => 'st--button' , 'value' => __( 'Reset' , 'cosmotheme' ) , 'label' => __( 'Reset Likes' , 'cosmotheme' ) , 'action' =>"act.reset_likes(1);" , 'hint' => __( 'WARNING! This will reset all the likes for all the posts!', 'cosmotheme'  ) );
    options::$fields['likes'][ 'show_count' ]         = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show votes count?' , 'cosmotheme') );
/*    options::$fields['likes'][ 'icons' ]            = array(
        'type' => 'st--preview-select', 'value' => array(
            'heart' => __( 'Heart', 'cosmotheme' ),
            'star' => __( 'Star', 'cosmotheme' ),
            'thumb' => __( 'Thumb', 'cosmotheme' )
        ),
        'label' => __( 'Icon style', 'cosmotheme' ),
        'action' => 'act.preview_select( this );',
        'hint' => __( 'You may choose between a heart, a star or a thumb up for "like it" icon','cosmotheme' )
    );*/
   
    if( options::logic( 'likes' , 'enb_likes' ) ){
        options::$fields['likes']['min_likes']['classes']     = 'g_like';
        options::$fields['general']['like_register']['classes'] = 'g_l_register';
        options::$fields['likes']['sim_likes']['classes']     = 'g_like generate_likes';
        options::$fields['likes']['reset_likes']['classes']   = 'g_like reset_likes';
        //options::$fields[ 'likes' ][ 'icons' ][ 'classes' ]   = 'like_icon';
    }else{
        options::$fields['likes']['min_likes']['classes']     = 'g_like hidden';
        options::$fields['general']['like_register']['classes'] = 'g_l_register hidden';
        options::$fields['likes']['sim_likes']['classes']     = 'g_like generate_likes hidden';
        options::$fields['likes']['reset_likes']['classes']   = 'g_like reset_likes hidden';
        //options::$fields[ 'likes' ][ 'icons' ][ 'classes' ]   = 'like_icon hidden';
    }

    /*Front end tabs settings*/
    $subcategories = get_categories( array( 'hide_empty' => false ) );
    $select_subcategories = array();
    $all_categ = array();
    foreach( $subcategories as $subcategory ){
        $select_subcategories[ $subcategory -> cat_ID ] = $subcategory -> name;
        $all_categ[] = $subcategory -> cat_ID;
    }

    $galleries = get_terms( 'gallery-category', array('hide_empty' => 0) );
    $select_galleries_category = array();
    $all_gallery_categ = array();
    
    foreach($galleries as $gallery){
        $select_galleries_category[ $gallery -> term_id ] = $gallery -> name;  
        $all_gallery_categ[] = $gallery -> term_id;     
    }

   
    /* LAYOUT OPTIONS */
    $layouts                                            = array('left' => __( 'Left sidebar' , 'cosmotheme' ) , 'right' => __( 'Right sidebar' , 'cosmotheme' ) , 'full' => __( 'Full width' , 'cosmotheme' ) );
    $view                                               = array('list_view' => __( 'List view' , 'cosmotheme' ) , 'grid_view' => __( 'Grid view' , 'cosmotheme' ), 'thumbnails_view' => __( 'Thumbnails view' , 'cosmotheme' ) ); 
    $sidebars_record = options::get_value( '_sidebar' );
    if( !is_array( $sidebars_record ) || empty( $sidebars_record ) ){
        $sidebar = array( '' => 'main' );
    }else{
        foreach( $sidebars_record as $sidebars ){
            $sidebar[ trim( strtolower( str_replace( ' ' , '-' , $sidebars['title'] ) ) ) ] = $sidebars['title'];
        }
        $sidebar[''] = 'main';
    }

    $sidebar_columns = array(
        3 => __( 'Three columns' , 'cosmotheme' ),
        9 => __( 'Nine columns' , 'cosmotheme' )
    );

    $no_sidebar_columns = array(
        2 => __( 'Two columns' , 'cosmotheme' ),
        3 => __( 'Three columns' , 'cosmotheme' ),
        4 => __( 'Four columns' , 'cosmotheme' ),
        6 => __( 'Six columns' , 'cosmotheme' )
    );


    $thumbs_options = array(
        'no_thumb' => __( 'No thumbnail' , 'cosmotheme' ),
        'small_thumb' => __( 'Small thumbnail' , 'cosmotheme' ),
        'large_thumb' => __( 'Large thumbnail' , 'cosmotheme' ),
        'full_width_thumb' => __( 'Full-width thumbnail' , 'cosmotheme' )  
    );

    $title_options = array(
        'above_content' => __( 'Title above content' , 'cosmotheme' ),
        'above_excerpt' => __( 'Title above excerpt' , 'cosmotheme' )
    );

    $hint = '<div class="template-description">';
        $hint.= '<div class="align-left">';
            $hint.= __( "This page lets you assign custom templates for your site's sections.", 'cosmotheme' );
            $hint.= '<br>';
            $hint.= __( "Please, select from the list the custom template you have created. To create a new template visit ", 'cosmotheme' );
            $hint.= '<a href="?page=cosmothemes__templates">' . __( 'Templates', 'cosmotheme' ) . '</a> ' . __( 'page.', 'cosmotheme' );
        $hint .= '</div>';
    $hint.= '</div>';

    options::$fields[ 'front_page_layout' ][ 'hint' ] = array( 'type' => 'cd--whatever', 'content' => $hint );
    options::$fields[ 'front_page_layout' ][ 'sidebars' ] = array( 'type' => 'st--sidebar-resizer', 'templatename' => 'front_page' );

    options::$fields[ 'category_layout' ][ 'hint' ] = options::$fields[ 'front_page_layout' ][ 'hint' ];
    options::$fields[ 'category_layout' ][ 'sidebars' ] = array( 'type' => 'st--sidebar-resizer', 'templatename' => 'category' );

    options::$fields[ 'tag_layout' ][ 'hint' ] = options::$fields[ 'front_page_layout' ][ 'hint' ];
    options::$fields[ 'tag_layout' ][ 'sidebars' ] = array( 'type' => 'st--sidebar-resizer', 'templatename' => 'tag' );

    options::$fields[ 'author_layout' ][ 'hint' ] = options::$fields[ 'front_page_layout' ][ 'hint' ];
    options::$fields[ 'author_layout' ][ 'sidebars' ] = array( 'type' => 'st--sidebar-resizer', 'templatename' => 'author' );

    /*  check if woocommerce is installed*/    
    if ( class_exists( 'WooCommerce' ) ) {
        options::$fields[ 'woo_shop_layout' ][ 'sidebars' ] = array( 'type' => 'st--sidebar-resizer', 'templatename' => 'woo_shop' );

        options::$fields[ 'product_layout' ][ 'hint' ] = options::$fields[ 'front_page_layout' ][ 'hint' ];
        options::$fields[ 'product_layout' ][ 'sidebars' ] = array( 'type' => 'st--sidebar-resizer', 'templatename' => 'product' );

        options::$fields[ 'product_category_layout' ][ 'hint' ] = options::$fields[ 'front_page_layout' ][ 'hint' ];
        options::$fields[ 'product_category_layout' ][ 'sidebars' ] = array( 'type' => 'st--sidebar-resizer', 'templatename' => 'product_category' );

        options::$fields[ 'product_tag_layout' ][ 'hint' ] = options::$fields[ 'front_page_layout' ][ 'hint' ];
        options::$fields[ 'product_tag_layout' ][ 'sidebars' ] = array( 'type' => 'st--sidebar-resizer', 'templatename' => 'product_tag' );
    }

    options::$fields[ 'search_layout' ][ 'hint' ] = options::$fields[ 'front_page_layout' ][ 'hint' ];
    options::$fields[ 'search_layout' ][ 'sidebars' ] = array( 'type' => 'st--sidebar-resizer', 'templatename' => 'search' );

    options::$fields[ 'single_layout' ][ 'hint' ] = options::$fields[ 'front_page_layout' ][ 'hint' ];
    options::$fields[ 'single_layout' ][ 'sidebars' ] = array( 'type' => 'st--sidebar-resizer', 'templatename' => 'single' );

    options::$fields[ 'gallery_layout' ][ 'hint' ] = options::$fields[ 'front_page_layout' ][ 'hint' ];
    options::$fields[ 'gallery_layout' ][ 'sidebars' ] = array( 'type' => 'st--sidebar-resizer', 'templatename' => 'gallery' );

    options::$fields[ 'page_layout' ][ 'hint' ] = options::$fields[ 'front_page_layout' ][ 'hint' ];
    options::$fields[ 'page_layout' ][ 'sidebars' ] = array( 'type' => 'st--sidebar-resizer', 'templatename' => 'page' );

    options::$fields[ 'gallery_tag_layout' ][ 'hint' ] = options::$fields[ 'front_page_layout' ][ 'hint' ];
    options::$fields[ 'gallery_tag_layout' ][ 'sidebars' ] = array( 'type' => 'st--sidebar-resizer', 'templatename' => 'gallery_tag' );

    options::$fields[ 'gallery_category_layout' ][ 'hint' ] = options::$fields[ 'front_page_layout' ][ 'hint' ];
    options::$fields[ 'gallery_category_layout' ][ 'sidebars' ] = array( 'type' => 'st--sidebar-resizer', 'templatename' => 'gallery_category' );

    options::$fields[ 'archive_layout' ][ 'hint' ] = options::$fields[ 'front_page_layout' ][ 'hint' ];
    options::$fields[ 'archive_layout' ][ 'sidebars' ] = array( 'type' => 'st--sidebar-resizer', 'templatename' => 'archive' );

    options::$fields[ 'archive_format_layout' ][ 'hint' ] = options::$fields[ 'front_page_layout' ][ 'hint' ];
    options::$fields[ 'archive_format_layout' ][ 'sidebars' ] = array( 'type' => 'st--sidebar-resizer', 'templatename' => 'archive_format' ); /*for post format archive*/

    options::$fields[ 'archive_post_type_layout' ][ 'hint' ] = options::$fields[ 'front_page_layout' ][ 'hint' ];
    options::$fields[ 'archive_post_type_layout' ][ 'sidebars' ] = array( 'type' => 'st--sidebar-resizer', 'templatename' => 'archive_post_type' );


    options::$fields[ '404_layout' ][ 'hint' ] = options::$fields[ 'front_page_layout' ][ 'hint' ];
    options::$fields[ '404_layout' ][ 'sidebars' ] = array( 'type' => 'st--sidebar-resizer', 'templatename' => '404' );

    options::$fields[ 'attachment_layout' ][ 'hint' ] = options::$fields[ 'front_page_layout' ][ 'hint' ];
    options::$fields[ 'attachment_layout' ][ 'sidebars' ] = array( 'type' => 'st--sidebar-resizer', 'templatename' => 'attachment' );

    options::$fields[ 'index_layout' ][ 'hint' ] = options::$fields[ 'front_page_layout' ][ 'hint' ];
    options::$fields[ 'index_layout' ][ 'sidebars' ] = array( 'type' => 'st--sidebar-resizer', 'templatename' => 'index' );



    /* STYLING DEFAULT VALUES */
    
    options::$default['styling']['viewport_width']              = '1170px';
    options::$default['styling']['background']          = 's.pattern.none.png';
    
    options::$default['styling']['footer_bg_color']     = '#414B52';
   


    options::$default[ 'styling' ][ 'menu_bg_color_opacity' ]  = '90';
    
    options::$default['styling']['stripes']             = 'no';

    options::$default[ 'styling' ][ 'logo_type' ]               = 'image';
    options::$default[ 'styling' ][ 'show_sticky_header' ]  = 'no';
    options::$default[ 'styling' ][ 'show_sticky_menu' ]        = 'no';
    options::$default[ 'styling' ][ 'enb_site_description' ]    = 'no';
    options::$default[ 'styling' ][ 'logo_text_color' ]         = '#EB4C4C';
    options::$default[ 'styling' ][ 'background_position_100' ] = 'yes';
    options::$default[ 'styling' ][ 'use_retina_logo' ]         = 'no';
    options::$default[ 'styling' ][ 'use_black_version' ]         = 'no';
    options::$default[ 'styling' ][ 'menu_swipe' ]         = 'no';

    
    /* STYLING OPTIONS */
    
    $viewport_width_options = array('1170px'=>'1170px', '960px'=>'960px', '800px' =>'800px', '100%' =>'100%');
    options::$fields['styling']['viewport_width']   = array('type' => 'st--select' , 'label' => __( 'Choose viewport width' , 'cosmotheme' ), 'value' => $viewport_width_options );

    options::$fields['styling']['mobile_view']      = array('type' => 'st--logic-radio' , 'label' => __( 'Disable mobile view' , 'cosmotheme' ), 'hint' => __( 'If enabled, all tablets and mobile devices display your site exactly like desktops.' , 'cosmotheme' ) );
    options::$fields['styling']['mobile_collapse_button']      = array('type' => 'st--logic-radio' , 'label' => __( 'Disable mobile collapse button' , 'cosmotheme' ), 'hint' => __( 'If enabled, all tablets and mobile devices will not display collapse button.' , 'cosmotheme' ) );
    options::$fields['styling']['menu_swipe']      = array('type' => 'st--logic-radio' , 'label' => __( 'Enable mobile menu swiping' , 'cosmotheme' ) );
    
    
    $pattern_path = 'pattern/s.pattern.';
    $pattern = array(
        "dots2"=>"dots2.png" , "squares3"=>"squares3.png" , "pluses"=>"pluses.png" , "opacity"=>"opacity.png" ,"circles"=>"circles.png","dots"=>"dots.png","grid"=>"grid.png","noise"=>"noise.png",
        "paper"=>"paper.png","rectangle"=>"rectangle.png","squares_1"=>"squares_1.png","squares_2"=>"squares_2.png","thicklines"=>"thicklines.png","thinlines"=>"thinlines.png" , "none"=>"none.png"
    );

    options::$fields['styling']['bg_title']             = array( 'type' => 'ni--title' , 'title' => __( 'Select body background' , 'cosmotheme' ) );
    options::$fields['styling']['background']           = array( 'type' => 'ni--radio-icon' ,  'value' => $pattern , 'path' => $pattern_path , 'in_row' => 5 );
    
    options::$fields['styling']['background_image']     = array( 'type' => 'st--hint' , 'value' => __( 'To set a background image go to' , 'cosmotheme' ) . ' <a href="themes.php?page=custom-background">' . __( 'Appearence - Background'  , 'cosmotheme' ) . '</a>' );

    options::$fields['styling']['background_position_100']      = array('type' => 'st--logic-radio' , 'label' => __( 'Background size 100%' , 'cosmotheme' ), 'hint' => __( 'This setting will be applied when you upload a background image with "no repeat" and "fixed" options.' , 'cosmotheme' ) );

    options::$fields['styling']['use_black_version']      = array('type' => 'st--logic-radio' , 'label' => __( 'Use black version of the site' , 'cosmotheme' ), 'hint' => __( 'Enable the black ersion of the site. By default it\'s set to White.' , 'cosmotheme' ) );

    options::$fields['styling']['colors_delimiter_p']             = array( 'type' => 'ni--delimiter'  );
 
    options::$fields[ 'styling' ][ 'triangle_color' ] = array(
        'label' => __( "Menu arrow color" , 'cosmotheme' ),
        'type' => 'st--color-picker',
        'hint' => __( "Set the collor for the menu and widgets arrow, Sly gallery scroll bar." , 'cosmotheme' )
    );

    options::$fields[ 'styling' ][ 'heart_color' ] = array(
        'label' => __( "Heart color" , 'cosmotheme' ),
        'type' => 'st--color-picker',
        'hint' => __( "Set the color for heart/likes." , 'cosmotheme' )
    );

    options::$fields[ 'styling' ][ 'link_color' ] = array(
        'label' => __( "Content link color" , 'cosmotheme' ),
        'type' => 'st--color-picker',
        'hint' => __( "Set the color for links in page/post content." , 'cosmotheme' )
    );

    options::$fields[ 'styling' ][ 'link_hover_color' ] = array(
        'label' => __( "Content link color on hover" , 'cosmotheme' ),
        'type' => 'st--color-picker',
        'hint' => __( "Set the color for links in page/post content, on hover." , 'cosmotheme' )
    );

    options::$fields[ 'styling' ][ 'menu_hover_color' ] = array(
        'label' => __( "Menu item color on hover" , 'cosmotheme' ),
        'type' => 'st--color-picker',
        'hint' => __( "Set the color for menu items on hover." , 'cosmotheme' )
    );

    options::$fields['styling']['menu_delimiter_top']             = array( 'type' => 'ni--delimiter'  );

    options::$fields['styling']['show_sticky_header']      = array(
        'type' => 'st--logic-radio' , 
        'label' => __( 'Enable sticky header' , 'cosmotheme' ) , 
        'action' => "act.check( this , { 'no' : '.enb_sticky_menu_option'  } , 'sh' );" , 
        'hint' => __( "If you want to make only the menu sticky, not the whole header, disable this option" , 'cosmotheme' )

    );

    options::$fields['styling']['show_sticky_menu']      = array(
        'type' => 'st--logic-radio' , 
        'label' => __( 'Enable sticky menu' , 'cosmotheme' ) , 
        'classes' => 'enb_sticky_menu_option '
    );

    if ( options::logic ( 'styling' , 'show_sticky_header' ) ) {
        options::$fields['styling']['show_sticky_menu']['classes'] = 'enb_sticky_menu_option hidden';
    }

    options::$fields['styling']['colors_delimiter_bottom']             = array( 'type' => 'ni--delimiter' );
    

    $path_parts = pathinfo( options::get_value( 'styling' , 'favicon' ) );
    if( strlen( options::get_value( 'styling' , 'favicon' ) ) && $path_parts['extension'] != 'ico' ){
        $ico_hint = '<span style="color:#cc0000;">' . __( 'Error, please select "ico" type media file' , 'cosmotheme' ) . '</span>';
    }else{
        $ico_hint = __( "Please select 'ico' type media file. Make sure you allow uploading 'ico' type in General Settings -> Upload file types" , 'cosmotheme' );
    }

    options::$fields['styling']['favicon']              = array('type' => 'st--upload' , 'label' => __( 'Custom favicon' , 'cosmotheme' ) , 'id' => 'favicon_path' , 'hint' => $ico_hint );
    options::$fields['styling']['stripes']              = array('type' => 'st--logic-radio' , 'label' => __( 'Enable stripes effect for post images' , 'cosmotheme' ) );
    options::$fields['styling']['logo_type']            = array('type' => 'st--select' , 'label' => __( 'Logo type ' , 'cosmotheme' ) , 'value' => array( 'text' => 'Text logo' , 'image' => 'Image logo' ) , 'hint' => __( 'Enable text-based site title and tagline.' , 'cosmotheme' ) , 'action' => "act.select( '.g_logo_type' , { 'text':'.g_logo_text' , 'image':'.g_logo_image' } , 'sh_' );" , 'iclasses' => 'g_logo_type' );

    options::$fields['styling']['enb_site_description'] = array('type' => 'st--logic-radio' , 'label' => __( 'Enable site description' , 'cosmotheme' ), 'hint' => __( 'This will add the blog description bellow the logo.' , 'cosmotheme' ) );
    options::$fields[ 'styling' ][ 'logo_text_color' ] = array(
        'label' => __( "Logo text color" , 'cosmotheme' ),
        'type' => 'st--color-picker'
    ); 

    /* fields for general -> logo_type */
    options::$fields['styling']['logo_url']             = array('type' => 'st--upload' , 'label' => __( 'Custom logo URL' , 'cosmotheme' ) , 'id' => 'logo_path' );
    options::$fields['styling']['use_retina_logo']      = array('type' => 'st--logic-radio' , 'label' => __( 'Use retina logo' , 'cosmotheme' ));

    /* hide not used fields */
    if( options::get_value( 'styling' , 'logo_type') == 'image' ){
        options::$fields['styling']['logo_url']['classes']  = 'g_logo_image';
        options::$fields['styling']['use_retina_logo']['classes']  = 'g_retina_logo';
        options::$fields['styling']['enb_site_description']['classes']  = 'generic-hint g_logo_text hidden';
        options::$fields['styling']['logo_text_color']['classes']  = 'generic-hint g_logo_text hidden';
        text::fields( 'styling' , 'logo' ,  'g_logo_text hidden' , get_option( 'blogname' ) );
        options::$fields['styling']['hint']                 = array('type' => 'st--hint' , 'classes' => 'g_logo_text hidden' ,'value' => __( 'To change blog title go to <a href="options-general.php">General settings</a> ' , 'cosmotheme') );
    }else{
        options::$fields['styling']['logo_url']['classes']  = 'generic-hint g_logo_image hidden';
        options::$fields['styling']['enb_site_description']['classes']  = 'g_logo_text';
        options::$fields['styling']['use_retina_logo']['classes']  = 'generic-hint g_retina_logo hidden';
        options::$fields['styling']['logo_text_color']['classes']  = 'g_logo_text';
        text::fields( 'styling' , 'logo' ,  'g_logo_text' , get_option( 'blogname' ) );
        options::$fields['styling']['hint']                 = array('type' => 'st--hint' , 'classes' => 'generic-hint g_logo_text' , 'value' => __( 'To change blog title go to <a href="options-general.php">General settings </a> ' , 'cosmotheme') );
    }
    
    options::$fields['styling']['use_mask_effect']      = array('type' => 'st--logic-radio' , 'label' => __( 'Use mask effect for featured images' , 'cosmotheme' ), 'hint' => __( 'If this option is enabled, then the diagonal mask effect will be used on single post page for featured image.' , 'cosmotheme' ));
    options::$default['styling']['use_mask_effect']                 = 'yes';

    /*TYPOGRAPHY OPTIONS*/ 
    options::$fields['typography']['headings_title']             = array( 'type' => 'ni--title' , 'title' => __( 'Headings ' , 'cosmotheme' ), 'hint' => __( 'Select and style your site\'s heading tags (H1, H2, H3...)' , 'cosmotheme' ) );
    text::fields( 'typography' , 'headings_font' ,  'g_headings_text' , 'Lorem ipsum dolor sit amet',  $default = array( '' , 24 , 'normal' ), $show_font_weight = false, $show_font_size = false  );

    options::$fields['typography']['primary_title']             = array( 'type' => 'ni--title' , 'title' => __( 'Primary text ' , 'cosmotheme' ), 'hint' => __( 'Select and style the standard font used in your site (body)' , 'cosmotheme' ) );
    text::fields( 'typography' , 'primary_font' ,  'g_primary_text' , 'Lorem ipsum dolor sit amet',  $default = array( '' , 24 , 'normal' ), $show_font_weight = false, $show_font_size = false  );

    options::$fields['typography']['menu_title']             = array( 'type' => 'ni--title' , 'title' => __( 'Menu items ' , 'cosmotheme' ), 'hint' => __( 'Select and style the standard font used in menu items' , 'cosmotheme' ) );
    text::fields( 'typography' , 'menu_font' ,  'g_menu_text' , 'Lorem ipsum dolor sit amet',  $default = array( '' , 24 , 'normal' ), $show_font_weight = false, $show_font_size = false  );

    options::$fields['typography']['new_font_title']             = array( 'type' => 'ni--title' , 'title' => __( 'Add new fonts ' , 'cosmotheme' ) );
    options::$fields['typography']['add_font']         = array(
        'type' => 'st--textarea' , 
        'label' => __( 'Add new Google Fonts links' , 'cosmotheme' ) , 
        'hint' => __( 'Click this link for more Google fonts: <a href="https://www.google.com/fonts" title="Google fonts" target="_blank" >www.google.com/fonts</a>. <br>
            Demo format: http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic&subset=latin,latin-ext <br> For more fonts, add ONE LINK PER LINE <br>
            After saving, just find it in the font list by name.' , 'cosmotheme' ) );
    
/*    options::$fields['typography']['secondary_title']             = array( 'type' => 'ni--title' , 'title' => __( 'Secondary text ' , 'cosmotheme' ), 'hint' => __( 'Select and style your site\'s secondary or sub title text (metabar, sub titles, etc.)' , 'cosmotheme' ) );
    text::fields( 'typography' , 'secondary_font' ,  'g_secondary_text' , 'Lorem ipsum dolor sit amet',  $default = array( '' , 24 , 'normal' ), $show_font_weight = false, $show_font_size = false  );
*/
    /* MENU DEFAULT VALUES */
    options::$default['menu']['header']                 = 8;
    options::$default['menu']['footer']                 = 4;
    
            
    /* MENU OPTIONS */
    
    options::$fields['menu']['custom_menu']             = array('type' => 'ni--title' , 'title' => __( 'Custom menu' , 'cosmotheme' ) );
    options::$fields['menu']['header']                  = array('type' => 'st--select' , 'value' => fields::digit_array( 20 ) , 'label' => __( 'Set limit for main menu' , 'cosmotheme' ) , 'hint' => __( 'Set the number of visible menu items. Remaining menu items<br />will be shown in the drop down menu item "More"' , 'cosmotheme' ) );
    options::$fields['menu']['footer']                  = array('type' => 'st--select' , 'value' => fields::digit_array( 20 ) , 'label' => __( 'Set limit for footer menu' , 'cosmotheme' ) , 'hint' => __( 'Set the number of visible menu items' , 'cosmotheme' ) );
    
    /* POSTS OPTIONS */
    options::$fields['blog_post']['post_title0']        = array('type' => 'ni--title' , 'title' => __( 'General Posts Settings' , 'cosmotheme' ) );

    options::$fields['blog_post']['show_similar']       = array('type' => 'st--logic-radio' , 'label' => __( 'Enable similar posts' , 'cosmotheme' ), 'action' => "act.check( this , { 'yes' : '.similar_type_class ' , 'no' : '' } , 'sh' );" );
    
    $similar_type_options = array('same_author' => __('Same user','cosmotheme'), 'post_tag'=>__('Same tags','cosmotheme'), 'category'=> __('Same category','cosmotheme') );
    
    options::$fields['blog_post']['similar_type']       = array( 'type' => 'st--select' , 'value' => $similar_type_options ,  'label' => __( 'Similar posts criteria','cosmotheme' ) );        
    $similar_type_view_options = array('grid_view' => __( 'Grid view' , 'cosmotheme' ), 'thumbnails_view' => __( 'Thumbnails view' , 'cosmotheme' ) ); 
    options::$fields['blog_post']['similar_view_type']  = array('type' => 'st--select' , 'value' => $similar_type_view_options , 'label' => __( 'Similar posts view type' , 'cosmotheme' ) );


    options::$fields['blog_post']['menu_delimiter_right_bottom']       = array( 'type' => 'ni--delimiter'  );
    
    options::$fields['blog_post']['post_sharing']       = array('type' => 'st--logic-radio' , 'label' => __( 'Enable social sharing for posts' , 'cosmotheme' ) );
    options::$fields['blog_post']['meta']               = array('type' => 'st--logic-radio' , 'label' => __( 'Show entry meta' , 'cosmotheme' ) );

    options::$fields['blog_post']['enb_cropp_img']        = array('type' => 'st--logic-radio' , 'label' => __( 'Use cropped thumbnail on single post page.' , 'cosmotheme' ) , 'hint' => __( 'By default a cropped image of size 1900x525 px is used. By disabling this option a proportionaly resized image will be used instead. Please regenerate thumbnails after selecting option using Regenerate Thumbnails plugin. ' , 'cosmotheme' ) );
    options::$fields['blog_post']['enb_featmask']        = array('type' => 'st--logic-radio' , 'label' => __( 'Use mask effect for post featured images.' , 'cosmotheme' ));
 

    options::$fields['blog_post']['enb_featured']         = array('type' => 'st--logic-radio' , 'label' => __( 'Display featured image inside the post' , 'cosmotheme' ) , 'hint' => __( 'If enabled featured images will be displayed on post page' , 'cosmotheme' ) );
    options::$fields['blog_post']['enb_lightbox']         = array('type' => 'st--logic-radio' , 'label' => __( 'Enable pretty-photo ligthbox' , 'cosmotheme' ) , 'hint' => __( 'Images inside posts will open inside a fancy lightbox' , 'cosmotheme' ) );

    options::$fields['blog_post']['show_feat_on_archive'] = array('type' => 'st--logic-radio' , 'label' => __( 'Display featured image on archive pages' , 'cosmotheme' )  );
    options::$fields['blog_post']['show_next_prev']   = array('type' => 'st--logic-radio' , 'label' => __( 'Display Next/Prev buttons on single page' , 'cosmotheme' )  );
    options::$fields['blog_post']['disable_hover_effect']   = array( 'type' => 'st--logic-radio' , 'label' => __( 'Disable hover effect for posts thumbnail' , 'cosmotheme' )); 

    
    $image_alt = array('title' => __( 'Image title' , 'cosmotheme' ), 'caption' => __( 'Image caption' , 'cosmotheme' ), 'alt' => __( 'Image alt' , 'cosmotheme' ) ); 
    options::$fields['blog_post']['image_alt']  = array('type' => 'st--select' , 'value' => $image_alt , 'label' => __( 'What should contain images in their "alt" attribute?'  , 'cosmotheme' ), 'hint' => __( 'Images do have an "alt" attribute, used for SEO, or used to display different info in lightboxes, etc.' , 'cosmotheme' )  );

    options::$fields['blog_post']['menu_delimiter_gallery_settings']       = array( 'type' => 'ni--delimiter'  );
    options::$fields['blog_post']['post_title01']        = array('type' => 'ni--title' , 'title' => __( 'General Gallery Settings' , 'cosmotheme' ) );


    options::$fields['blog_post']['hide_gallery_info']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Hide left sidebar on gallery page' , 'cosmotheme' ), 'hint' => __( 'If enabled, gallery info will be hidden ' , 'cosmotheme' ), 'action' => "act.check( this , { 'no' : '.show_collapse_btn ' , 'yes' : '' } , 'sh' );");  
    options::$fields['blog_post']['show_collapse_btn']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show collapse button on gallery page' , 'cosmotheme' )); 

    options::$fields['blog_post']['gallery_related']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show related galleries for gallery posts' , 'cosmotheme' ) );     
  
    options::$fields['blog_post']['show_sly_caption']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show top-left image caption for Sly gallery' , 'cosmotheme' ), 'hint' => __( 'If enabled, every image will display it\'s caption, if it has one' , 'cosmotheme' ) );   


    $gallery_type = array('sly' => 'Sly', 'clasic' => 'Clasic', 'folio' => 'Folio', 'image_flow' => 'Image Flow','mosaic' => __('Mosaic view','cosmotheme'), 'vertical-scroll' => __('Vertical Image Scroll','cosmotheme')); 
    options::$fields['blog_post']['gallery_type']         = array('type' => 'st--select' , 'value' => $gallery_type , 'label' => __( 'Select gallery type' , 'cosmotheme' ), 'action' => "act.select( '.gallery_type' , { 'sly':'.sly_slider_speed', 'vertical-scroll':'.vertscroll_distance'  } , 'sh_' );" , 'iclasses' => 'gallery_type' );

    options::$fields['blog_post']['gallery_slider_speed']   = array( 'type' => 'st--slider' , 'min_val' => 1, 'max_val' => 4000,  'label' => __( 'Set the gallery slider speed' , 'cosmotheme' ) );

    options::$fields['blog_post']['mobile_gallery_type']         = array(
        'type' => 'st--select' , 
        'value' => $gallery_type , 
        'label' => __( 'Select gallery type for mobile devices' , 'cosmotheme' ) , 
        'hint' => __( 'When accessing your galleries from a mobile device, this gallery type will be displayed. Tip: use "Vertical Scroll" - it\'s the lightest.' , 'cosmotheme' ) , 
    );
    options::$default['blog_post']['mobile_gallery_type']         = 'vertical-scroll';

    
    if( options::get_value( 'blog_post' , 'gallery_type') == 'sly' ){
        options::$fields['blog_post']['gallery_slider_speed']['classes']  = 'sly_slider_speed';
    }else{
        options::$fields['blog_post']['gallery_slider_speed']['classes']  = 'sly_slider_speed hidden';
    }

    options::$fields['blog_post']['vertical_gallery_img_margin']= array('type' => 'st--digit' , 'label' => __( 'Distances between images in Vertical scroll' , 'cosmotheme' ) , 'hint' => __('Set the number of pixels for the space between the images in Vertical Scroll gallery','cosmotheme') );
   

    if( options::get_value( 'blog_post' , 'gallery_type') == 'vertical-scroll' ){
        options::$fields['blog_post']['vertical_gallery_img_margin']['classes']  = 'vertscroll_distance';
    }else{
        options::$fields['blog_post']['vertical_gallery_img_margin']['classes']  = 'vertscroll_distance hidden';
    }

    //options::$fields['blog_post']['enb-next-prev']      = array('type' => 'st--logic-radio' , 'label' => __( 'Enable navigation for posts' , 'cosmotheme' ) , 'hint' => __( 'If enabled the post will show links to the next and previous posts' , 'cosmotheme' ) );
    
    options::$fields['blog_post']['menu_delimiter_page_settings']       = array( 'type' => 'ni--delimiter'  );

    options::$fields['blog_post']['post_title1']        = array('type' => 'ni--title' , 'title' => __( 'General Page Settings' , 'cosmotheme' ) );
    options::$fields['blog_post']['page_sharing']       = array('type' => 'st--logic-radio' , 'label' => __( 'Enable social sharing for page' , 'cosmotheme' ) );
    options::$fields['blog_post']['page_meta']          = array('type' => 'st--logic-radio' , 'label' => __( 'Show entry meta for pages' , 'cosmotheme' ) );

    /*  check if woocommerce is installed*/    
   if ( class_exists( 'WooCommerce' ) ) {
        options::$fields['blog_post']['menu_delimiter_product_settings']       = array( 'type' => 'ni--delimiter'  );

        options::$fields['blog_post']['post_title_prod']        = array('type' => 'ni--title' , 'title' => __( 'General Products Settings' , 'cosmotheme' ) );
        options::$fields['blog_post']['new_products_page']      = array( 'type' => 'st--select' , 'label' => __( 'Select New products page' , 'cosmotheme' ) , 'value' => get__pages() , 'hint' => __('Make sure the selected page has "New products" template assigned. Choose "Select item" to disable this page.','cosmotheme'));
        options::$fields['blog_post']['wish_page']              = array( 'type' => 'st--select' , 'label' => __( 'Select Wishlist page' , 'cosmotheme' ) , 'value' => get__pages() , 'hint' => __('Make sure the selected page has "Wishlist" template assigned. Choose "Select item" to disable this page.','cosmotheme'));
        options::$fields['blog_post']['enb_wish_btn']           = array('type' => 'st--logic-radio' , 'label' => __( 'Enable "Add to wishlist" button' , 'cosmotheme' ) );
    }

    options::$fields['blog_post']['post_title2']        = array('type' => 'ni--title' , 'title' => __( 'General Archive Settings' , 'cosmotheme' ) );
    options::$fields['blog_post']['excerpt_lenght_grid']= array('type' => 'st--digit' , 'label' => __( 'Excerpt length (grid view)' , 'cosmotheme' ), 'hint' => __('Set number of characters that will be displayed on archive pages for each post','cosmotheme') );
    options::$fields['blog_post']['excerpt_lenght_list']= array('type' => 'st--digit' , 'label' => __( 'Excerpt length (list view)' , 'cosmotheme' ) , 'hint' => __('Set number of characters that will be displayed on archive pages for each post','cosmotheme') );
    
    /* POSTS DEFAULT VALUE */
    options::$default['blog_post']['show_similar']          = 'yes';
    options::$default['blog_post']['post_sharing']          = 'no';
    options::$default['blog_post']['meta']                  = 'yes'; /*enable meta for posts & galleries*/
    options::$default['blog_post']['post_author_box']       = 'no';
    options::$default['blog_post']['show_source']           = 'yes';
    options::$default['blog_post']['show_feat_on_archive']  = 'yes'; 
    options::$default['blog_post']['show_next_prev']        = 'yes'; 
    options::$default['blog_post']['enb_featmask']          = 'yes'; 
    
    //options::$default['blog_post']['enb-next-prev']       = 'yes';
    options::$default['blog_post']['page_sharing']          = 'no';
    options::$default['blog_post']['page_meta']             = 'yes';
    options::$default['blog_post']['page_author_box']       = 'no';
    options::$default['blog_post']['similar_type']          = 'post_tag';
    options::$default['blog_post']['similar_type_right']    = 'post_tag';
    options::$default['blog_post']['similar_view_type']     = 'thumbnails_view';
    options::$default['blog_post' ][ 'navigation_posts' ]   = 'yes';
    options::$default['blog_post']['enb_featured']          = 'yes';
    options::$default['blog_post']['enb_cropp_img']         = 'yes';
    options::$default['blog_post']['enb_lightbox']          = 'yes';
    options::$default['blog_post']['hide_gallery_info']     = 'no';
    options::$default['blog_post']['disable_hover_effect']  = 'no';
    options::$default['blog_post']['show_collapse_btn']     = 'yes';
    options::$default['blog_post']['gallery_slider_speed']  = '300';
    options::$default['blog_post']['vertical_gallery_img_margin']  = '5';

    options::$default['blog_post']['image_alt']     = 'caption'; 

    options::$default['blog_post']['gallery_type']  = 'sly';

    if ( class_exists( 'WooCommerce' ) ) {
        options::$default['blog_post']['enb_wish_btn']          = 'yes';
        $new_products_page = get_page_by_title( __('New products','cosmotheme') );
        if($new_products_page && isset($new_products_page->ID)){
            options::$default['blog_post']['new_products_page']       = $new_products_page->ID;
        }
        
        $wishlist_page = get_page_by_title( __('Wishlist','cosmotheme') );
        if($wishlist_page && isset($wishlist_page->ID)){
            options::$default['blog_post']['wish_page']       = $wishlist_page->ID;
        }

    }
    
    if( options::logic( 'blog_post' , 'show_similar' ) ){
        options::$fields['blog_post']['similar_type']['classes']     = 'similar_type_class';
    }else{ 
        options::$fields['blog_post']['similar_type']['classes']     = 'similar_type_class hidden';
    }

    options::$default[ 'blog_post' ][ 'excerpt_lenght_grid' ]= '120';
    options::$default[ 'blog_post' ][ 'excerpt_lenght_list' ]= '300';

    if(!options::logic( 'blog_post' , 'hide_gallery_info' )){ 
        options::$fields['blog_post']['show_collapse_btn']['classes']     = 'show_collapse_btn';
    }else{
        options::$fields['blog_post']['show_collapse_btn']['classes']     = 'show_collapse_btn hidden';
    }
    
    /* SOCIAL OPTIONS */
    
    options::$fields['social']['facebook_app_id']       = array('type' => 'st--text' , 'label' => __( 'Facebook Application ID' , 'cosmotheme' ) , 'hint' => __( 'You can create a fb application from <a href="https://developers.facebook.com/apps">here</a>' , 'cosmotheme' ) );
    options::$fields['social']['facebook_secret']       = array('type' => 'st--text' , 'label' => __( 'Facebook Secret key' , 'cosmotheme' ) , 'hint' => __( 'Needed for Facebook Connect' , 'cosmotheme' ) );
    options::$fields['social']['fb_og_image']           = array('type' => 'st--upload' , 'label' => __( 'Facebook open graph image' , 'cosmotheme' ) ,'hint' => __('This is the image that will show up when your site is shared via Facebook. Make sure the image size is at lease 200X200px.','cosmotheme'),  'id' => 'fb_og_image_path' );
    options::$fields['social']['fb_delimiter_top']             = array( 'type' => 'ni--delimiter'  );   
    
    options::$default[ 'social' ][ 'rss' ]              = 'yes';


    options::$fields[ 'social' ][ 'rss' ]               = array('type' => 'st--logic-radio' , 'label' => __( 'Show RSS icon' , 'cosmotheme' )  );
    options::$fields['social']['facebook']              = array('type' => 'st--text' , 'label' => __( 'Facebook profile ID' , 'cosmotheme' ), 'hint' => __( '(i.e. cosmo.theme)' , 'cosmotheme' )  );
    options::$fields['social']['twitter']               = array('type' => 'st--text' , 'label' => __( 'Twitter ID' , 'cosmotheme' ), 'hint' => __( '(i.e. cosmothemes)' , 'cosmotheme' ) );

    options::$fields['social']['gplus']                 = array('type' => 'st--text' , 'label' => __( 'G+ public profile URL' , 'cosmotheme' ), 'hint' => __( '(i.e. https://plus.google.com/u/0/b/103218861385999897717/)' , 'cosmotheme' ) );
    options::$fields['social']['yahoo']                 = array('type' => 'st--text' , 'label' => __( 'Yahoo public profile URL' , 'cosmotheme' ), 'hint' => __( '(i.e. http://profile.yahoo.com/56W6RBFOFVLLSUQBHREPTDQW4U/)' , 'cosmotheme' ) );
    options::$fields['social']['dribbble']              = array('type' => 'st--text' , 'label' => __( 'Dribbble public profile URL' , 'cosmotheme' ), 'hint' => __( '(i.e. http://dribbble.com/cosmothemes)' , 'cosmotheme' ) );
    options::$fields['social']['linkedin']              = array('type' => 'st--text' , 'label' => __( 'LinkedIn public profile URL' , 'cosmotheme' ) , 'hint' => __( '(i.e. http://www.linkedin.com/company/cosmothemes)' , 'cosmotheme' ) );

    options::$fields['social']['vimeo']                 = array('type' => 'st--text' , 'label' => __( 'Vimeo public profile URL' , 'cosmotheme' ) , 'hint' => __( '(i.e. http://vimeo.com/user10929709)' , 'cosmotheme' ) );
    options::$fields['social']['youtube']               = array('type' => 'st--text' , 'label' => __( 'Youtube public profile URL' , 'cosmotheme' ) , 'hint' => __( '(i.e. http://www.youtube.com/user/vasilerusnac)' , 'cosmotheme' ) );
    options::$fields['social']['tumblr']                = array('type' => 'st--text' , 'label' => __( 'Tumblr public profile URL' , 'cosmotheme' ) , 'hint' => __( '(i.e. http://virusnac.tumblr.com/)' , 'cosmotheme' ) );
    options::$fields['social']['delicious']             = array('type' => 'st--text' , 'label' => __( 'Delicious public profile URL' , 'cosmotheme' ) , 'hint' => __( '(i.e. https://delicious.com/cosmothemes)' , 'cosmotheme' ) );
    options::$fields['social']['flickr']                = array('type' => 'st--text' , 'label' => __( 'Flickr public profile URL' , 'cosmotheme' ) , 'hint' => __( '(i.e. http://www.flickr.com/photos/cosmothemes/)' , 'cosmotheme' ) );
    options::$fields['social']['instagram']             = array('type' => 'st--text' , 'label' => __( 'Instagram public profile URL' , 'cosmotheme' ) , 'hint' => __( '(i.e. http://instagram.com/yourname)' , 'cosmotheme' ) );
    options::$fields['social']['pinterest']             = array('type' => 'st--text' , 'label' => __( 'Pinterest public profile URL' , 'cosmotheme' ) , 'hint' => __( '(i.e. http://pinterest.com/cosmothemes)' , 'cosmotheme' ) );

    options::$fields['social']['email']                 = array('type' => 'st--text' , 'label' => __( 'Contact email' , 'cosmotheme' )  );
    options::$fields['social']['skype']                 = array('type' => 'st--text' , 'label' => __( 'Skype Name' , 'cosmotheme' )  );
    
    /* image size manager */
    /*9999 tsingle_gallery*/
    options::$default['imagesizes']['single_gallery_width']      = '9999';
    options::$fields['imagesizes']['single_gallery_width'] = array('type' => 'st--digit' , 'label' => __( 'Gallery - image width' , 'cosmotheme' ), 'hint' => __( 'Gallery images width. 9999 means it will be resized proportionaly by height. We strongly recommend not to change this size.' , 'cosmotheme' ) );
    /*900*/
    options::$default['imagesizes']['single_gallery_height']      = '900';
    options::$fields['imagesizes']['single_gallery_height'] = array('type' => 'st--digit' , 'label' => __( 'Gallery - image height' , 'cosmotheme' ), 'hint' => __( 'Gallery images height. 900px by default.' , 'cosmotheme' ) );
    options::$fields['imagesizes']['delimiter_1']             = array( 'type' => 'ni--delimiter' );
    /*9999 t_gallery*/
    options::$default['imagesizes']['gallery_format_slider_width']      = '9999';
    options::$fields['imagesizes']['gallery_format_slider_width'] = array('type' => 'st--digit' , 'label' => __( 'Post-format Gallery  - image width ' , 'cosmotheme' ), 'hint' => __( 'Blog posts images width for gallery post-format. 9999 means it will be resized proportionaly by height. We strongly recommend not to change this size.' , 'cosmotheme' ) );
    /*400*/
    options::$default['imagesizes']['gallery_format_slider_height']      = '400';
    options::$fields['imagesizes']['gallery_format_slider_height'] = array('type' => 'st--digit' , 'label' => __( 'Post-format Gallery - image height' , 'cosmotheme' ), 'hint' => __( 'Blog posts images height for gallery post-format. 400px by default.' , 'cosmotheme' ) );
    options::$fields['imagesizes']['delimiter_2']             = array( 'type' => 'ni--delimiter' );
    /*265 t_attached_gallery*/
    options::$default['imagesizes']['image_format_width']      = '265';
    options::$fields['imagesizes']['image_format_width'] = array('type' => 'st--digit' , 'label' => __( 'Post-format Image - image width' , 'cosmotheme' ), 'hint' => __( 'Blog posts images width for image post-format. 265px by default.' , 'cosmotheme' ) );
    /*165*/
    options::$default['imagesizes']['image_format_height']      = '165';
    options::$fields['imagesizes']['image_format_height'] = array('type' => 'st--digit' , 'label' => __( 'Post-format Image - image height' , 'cosmotheme' ), 'hint' => __( 'Blog posts images height for image post format. 165px by default.' , 'cosmotheme' ) );
    options::$fields['imagesizes']['delimiter_3']             = array( 'type' => 'ni--delimiter' );
    /*640 tlist_view*/
    options::$default['imagesizes']['list_view_width']      = '640';
    options::$fields['imagesizes']['list_view_width'] = array('type' => 'st--digit' , 'label' => __( 'List-view - image width' , 'cosmotheme' ), 'hint' => __( 'Archives images width for list-view. 640px by default.' , 'cosmotheme' ) );
    /*340*/
    options::$default['imagesizes']['list_view_height']      = '340';
    options::$fields['imagesizes']['list_view_height'] = array('type' => 'st--digit' , 'label' => __( 'List-view - image height' , 'cosmotheme' ), 'hint' => __( 'Archives images height for list-view. 340px by default.' , 'cosmotheme' ) );
    options::$fields['imagesizes']['delimiter_4']             = array( 'type' => 'ni--delimiter' );
    
    /*400 tlist_view*/
    options::$default['imagesizes']['gallery_folio_width']      = '400';
    options::$fields['imagesizes']['gallery_folio_width'] = array('type' => 'st--digit' , 'label' => __( 'Gallery type folio - image width' , 'cosmotheme' ), 'hint' => __( 'Folio gallery images width. 400px by default.' , 'cosmotheme' ) );
    /*550*/
    options::$default['imagesizes']['gallery_folio_height']      = '550';
    options::$fields['imagesizes']['gallery_folio_height'] = array('type' => 'st--digit' , 'label' => __( 'Gallery type folio - image height' , 'cosmotheme' ), 'hint' => __( 'Folio gallery images height. 550px by default.' , 'cosmotheme' ) );
    options::$fields['imagesizes']['delimiter_4ewr']             = array( 'type' => 'ni--delimiter' );
    
    /*340 'mosaic_long' */
    options::$default['imagesizes']['mosaic_long_width']      = '340';
    options::$fields['imagesizes']['mosaic_long_width'] = array('type' => 'st--digit' , 'label' => __( 'Mosaic-view long image - image width' , 'cosmotheme' ), 'hint' => __( 'Archives images width for mosaic-view (the long image). 340px by default.' , 'cosmotheme' ) );
    /*720*/
    options::$default['imagesizes']['mosaic_long_height']      = '720';
    options::$fields['imagesizes']['mosaic_long_height'] = array('type' => 'st--digit' , 'label' => __( 'Mosaic-view long image - image height' , 'cosmotheme' ), 'hint' => __( 'Archives images height for mosaic-view (the long image). 720px by default.' , 'cosmotheme' ) );
    options::$fields['imagesizes']['delimiter_5']             = array( 'type' => 'ni--delimiter' );
    /*340 'tgrid_small' */
    options::$default['imagesizes']['grid_small_width']      = '340';
    options::$fields['imagesizes']['grid_small_width'] = array('type' => 'st--digit' , 'label' => __( 'Mosaic-view small image - image width' , 'cosmotheme' ), 'hint' => __( 'Archives images width for mosaic-view (the small square image). 340px by default.' , 'cosmotheme' ) );
    /*340*/
    options::$default['imagesizes']['grid_small_height']      = '340';
    options::$fields['imagesizes']['grid_small_height'] = array('type' => 'st--digit' , 'label' => __( 'Mosaic-view small image - image height' , 'cosmotheme' ), 'hint' => __( 'Archives images height for mosaic-view (the small square image). 340px by default.' , 'cosmotheme' ) );
    options::$fields['imagesizes']['delimiter_6']             = array( 'type' => 'ni--delimiter' );
    /*720 'tlist' */   /* used for grid, thumb and mosaic view - crop */
    options::$default['imagesizes']['grid_big_width']      = '720';
    options::$fields['imagesizes']['grid_big_width'] = array('type' => 'st--digit' , 'label' => __( 'Grid/thumb-view, mosaic-view large image - image width' , 'cosmotheme' ), 'hint' => __( 'Archives images width for grid, thumb and mosaic-view (the big square image). 720px by default.' , 'cosmotheme' ) );
    /*720*/
    options::$default['imagesizes']['grid_big_height']      = '720';
    options::$fields['imagesizes']['grid_big_height'] = array('type' => 'st--digit' , 'label' => __( 'Grid/thumb-view, mosaic-view large image - image height' , 'cosmotheme' ), 'hint' => __( 'Archives images height for grid, thumb and mosaic-view (the big square image). 720px by default.' , 'cosmotheme' ) );
    options::$fields['imagesizes']['delimiter_7']             = array( 'type' => 'ni--delimiter' );
    
    /*'1905 single featured cropped'   */ /* used on single page when cropped version is selected from theme options */
    options::$default['imagesizes']['single_cropped_width']      = '1905';
    options::$fields['imagesizes']['single_cropped_width'] = array('type' => 'st--digit' , 'label' => __( 'Single page thumbnails, cropped version - image width' , 'cosmotheme' ), 'hint' => __( 'Featured image width for single blog post when using cropped-version (settable in general options). 1905px by default.' , 'cosmotheme' ) );
    /*525*/
    options::$default['imagesizes']['single_cropped_height']      = '525';
    options::$fields['imagesizes']['single_cropped_height'] = array('type' => 'st--digit' , 'label' => __( 'Single page thumbnails, cropped version - image height' , 'cosmotheme' ), 'hint' => __( 'Featured image height for single blog post when using cropped-version (settable in general options). 525px by default.' , 'cosmotheme' ) );
    options::$fields['imagesizes']['delimiter_9']           = array( 'type' => 'ni--delimiter' );

    /*'1170 single featured cropped'   */ /* used on single page when cropped version is selected from theme options */
    options::$default['imagesizes']['single_resized_width']      = '1170';
    options::$fields['imagesizes']['single_resized_width'] = array('type' => 'st--digit' , 'label' => __( 'Single page thumbnails, resized version - image width' , 'cosmotheme' ), 'hint' => __( 'Featured image width for single blog post when using resized-version (settable in general options). 1170px by default.' , 'cosmotheme' ) );
    /*9999*/
    options::$default['imagesizes']['single_resized_height']      = '9999';
    options::$fields['imagesizes']['single_resized_height'] = array('type' => 'st--digit' , 'label' => __( 'Single page thumbnails, resized version - image height' , 'cosmotheme' ), 'hint' => __( 'Featured image height for single blog post when using resized-version (settable in general options). 9999 means  it will be resized proportionaly by width. We strongly recommend not to change this size.' , 'cosmotheme' ) );
    //options::$fields['imagesizes']['delimiter_99']           = array( 'type' => 'ni--delimiter' );


    /* sidebar manager */
    $struct = array(
        'layout' => 'A',
        'check-column' => array(
            'name' => 'idrow[]',
            'type' => 'hidden'
        ),
        'info-column-0' => array(
            0 => array(
                'name' => 'title',
                'type' => 'text',
                'label' => 'Sidebar Title',
                'classes' => 'sidebar-title'
            )
        ),
        'select' => 'title',
        'actions' => array( 'sortable' => true )
    );

    /* delete_option( '_sidebar' ); */
    /* SOCIAL OPTIONS */
    $hint = '<div class="template-description">';
        $hint.= '<div class="align-left">';
            $hint .= __( 'This page lets you create new sidebar areas and assign them for your templates or posts.', 'cosmotheme' );
            $hint .= '<br>';
            $hint .= __( "The newly created sidebar will be available at ", 'cosmotheme' );
            $hint .= '<a href="widgets.php">' . __( 'Appearence - Widgets', 'cosmotheme' ) . '</a> ';
            $hint .= __( 'and', 'cosmotheme' ) . ' ';
            $hint .= '<a href="?page=cosmothemes__layouts">' . __( 'Layouts', 'cosmotheme' ) . '</a> ';
        $hint .= '</div>';
    $hint.= '</div>';
    options::$fields['_sidebar']['idrow']               = array('type' => 'st--m-hidden' , 'value' => 1 , 'id' => 'sidebar_title_id' , 'single' => true );
    options::$fields[ '_sidebar' ][ 'hinsat' ]            = array(
        'type' => 'cd--whatever',
        'content' => $hint
    );
    options::$fields['_sidebar']['title']               = array('type' => 'st--text' , 'label' => __( 'Set title for new sidebar','cosmotheme' ) , 'id' => 'sidebar_title' , 'single' => true );
    options::$fields['_sidebar']['save']                = array('type' => 'st--button' , 'value' => 'Add new sidebar' , 'action' => "extra.add( '_sidebar' , { 'input' : [ 'sidebar_title_id' , 'sidebar_title'] })" );

    options::$fields['_sidebar']['struct']              = $struct;
    options::$fields['_sidebar']['hint']                = __( 'List of generic dynamic sidebars<br />Drag and drop blocks to rearrange position' , 'cosmotheme' );

    options::$fields['_sidebar']['list']                = array( 'type' => 'ex--extra' , 'cid' => 'container__sidebar');
    
    /* Custom css */
    options::$fields['custom_css']['css']               = array('type' => 'st--textarea' , 'label' => __( 'Add your custom CSS' , 'cosmotheme' )  );
    

    /*Cosmothemes options*/

    options::$default['cosmothemes']['show_new_version']      = 'yes';
    options::$default['cosmothemes']['show_cosmo_news']      = 'yes';
    options::$fields['cosmothemes']['show_new_version'] = array( 'type' => 'st--logic-radio' , 'label' => __( 'Enable notification about new theme version' , 'cosmotheme' ) );
    options::$fields['cosmothemes']['show_cosmo_news']  = array( 'type' => 'st--logic-radio' , 'label' => __( 'Enable Cosmothemes news notification' , 'cosmotheme' ) );

    /* tooltips */
    $type = array( 'left' => __( 'Left' , 'cosmotheme' ) , 'right' => __( 'Right' , 'cosmotheme' ) , 'top' => __( 'Top' , 'cosmotheme' ) );
    $res_type = array( 'front_page' => __( 'On front page' , 'cosmotheme' ) , 'single' => __( 'On single post' , 'cosmotheme' ) , 'page' => __( 'On simple page' , 'cosmotheme' ) );
    $res_pages = get__pages( __( 'Select Page' , 'cosmotheme' ) );
    $tooltips = array(
        'layout' => 'A',
        'check-column' => array(
            'name' => 'idrow',
            'type' => 'hidden',
            'classes' => 'idrow'
        ),
        'info-column-0' => array(
            0 => array(
                'name' => 'title',
                'type' => 'text',
                'label' => 'Tooltip title',
                'classes' => 'tooltip-title',
                'before' => '<strong>',
                'after' => '</strong>',
            ),
            1 => array(
                'name' => 'description',
                'type' => 'textarea',
                'label' => 'Tooltip description',
                'classes' => 'tooltip-description'
            ),

            3 => array(
                'name' => 'res_posts',
                'type' => 'search',
                'query' => array( 'post_type' => 'post' , 'post_status' => 'publish' ),
                'label' => '',
                'lvisible' => false,
                'classes' => 'tooltip-res-posts',
                'linked' => array( 'res_type' , 'single' ),
            ),
            4 => array(
                'name' => 'res_pages',
                'type' => 'select',
                'assoc' => $res_pages,
                'label' => '',
                'lvisible' => false,
                'classes' => 'tooltip-res-pages',
                'linked' => array( 'res_type' , 'page' ),
            ),
            5 => array(
                'name' => 'top',
                'type' => 'text',
                'label' => 'Top position',
                'lvisible' => false,
                'classes' => 'tooltip-top'
            ),
            6 => array(
                'name' => 'left',
                'type' => 'text',
                'label' => 'Left position',
                'lvisible' => false,
                'classes' => 'tooltip-left'
            ),
            7 => array(
                'name' => 'type',
                'type' => 'select',
                'assoc' => $type,
                'label' => 'Arrow position',
                'lvisible' => false,
                'classes' => 'tooltip-type'
            ),
        ),
        'actions' => array( 'sortable' => true )
    );
    
    $res_action = "act.select( '#tooltip_res_type' , { 'single' : '.res_posts' , 'page': '.res_pages'  } , 'sh_' )";

    options::$fields[ 'tooltips' ][ 'builder' ]         = array(
        'type' => 'cd--whatever',
        'content' => new TooltipBuilder()
    );
    if( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'cosmothemes__extra' && isset( $_GET[ 'tab' ] ) && 'io' == $_GET['tab'] ){
        $export = array();
        foreach( options::$menu['cosmothemes'] as $option_group_name => $option_group ){
            if( isset($option_group[ 'contains' ] )){
                if( 'templates' == $option_group_name ){
                    $export[$option_group_name] = get_option($option_group_name);
                } else {
                    foreach($option_group[ 'contains' ] as $option_name => $option) {
                        $export[$option_group_name][$option_name] = get_option($option_name);
                    }
                }
            }
        }
        $exportdata = base64_encode( json_encode( $export ) );
    }else{
        $exportdata = '';
    }

    options::$fields[ 'io' ][ 'warning' ] = array(
        'type' => 'cd--whatever',
        'content' => '<h2 class="import-warning">' . __( 'Warning! You WILL lose all your current settings FOREVER', 'cosmotheme' ) . '<br>'
                            . __( 'if you paste the import data and click "Update settings".', 'cosmotheme' ) . '<br>'
                            . __( 'Double check everything!', 'cosmotheme' ) . '</h2><b class="import-warning">' . __( 'Please check settings where pages are assigned. If there is something wrong set them manually.', 'cosmotheme' ) . '</b><div class="clear">&nbsp;</div>'
    );

    options::$fields[ 'io' ][ 'export' ] = array(
        'label' => __( 'This is the export data', 'cosmotheme' ),
        'hint' => __( 'Just copy-paste it', 'cosmotheme' ),
        'type' => 'st--textarea',
        'value' => $exportdata
    );

    options::$fields[ 'io' ][ 'import' ] = array(
        'label' => __( 'This is the import zone', 'cosmotheme' ),
        'hint' => __( 'Paste the import data here', 'cosmotheme' ),
        'type' => 'st--textarea',
        'value' => ''
    );

    if( isset( $_POST[ 'io' ] ) && isset( $_POST[ 'io' ][ 'import' ] ) && strlen( trim( $import = $_POST[ 'io' ][ 'import' ] ) ) ){
        $import = json_decode( base64_decode( $import ), true );
        if( is_array( $import ) && count( $import ) ){
            foreach($import as $option_group_name => $option_group){
                if( 'templates' == $option_group_name ){
                    update_option($option_group_name, $option_group);
                    $builder = new LBTemplateBuilder();
                    $builder->load_all();
                } else {
                    foreach($option_group as $option_name => $option) {
                        update_option( $option_name, $option );
                    }
                }
            }
        }
    }

    ob_start(); 
    ob_clean();
    get_template_part( '/lib/templates/our_themes' );
    $our_themes = ob_get_clean();
    options::$fields['themes']['list_themes'] = array(
        'type' => 'no--our_themes'
        
    );
    
    options::$register['cosmothemes']                   = options::$fields;
?>