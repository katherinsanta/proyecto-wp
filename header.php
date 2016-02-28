<!DOCTYPE html>

<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9 oldie" lang="en"> <![endif]-->

<?php
    function is_facebook(){
        if(!(stristr($_SERVER["HTTP_USER_AGENT"],'facebook') === FALSE)) {
            return true;
        }
    }
?>
<!--[if gt IE 8]><!--> <html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> <?php if(is_facebook()){ echo ' xmlns:fb="http://ogp.me/ns/fb#" ';} ?> ><!--<![endif]-->

<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="robots"  content="index, follow" />
    
    <?php  
        global $current_template, $gallery_container_class, $is_gallery_used; /*set it as global because it will be used on another templates*/
        $current_template = LBTemplate::figure_out_template(); /*initialize template*/

        $gallery_container_class = '';
        $single_gallery = '';
        if(is_element_used($current_template -> _rows, 'gallery')){ /*if in one of the rows user selected a gallery, then only that gallery will be siplayed*/
            if(options::logic( 'blog_post' , 'hide_gallery_info' )){
                $gallery_container_class .= ' no-gallery-sidebar ';
                
            } 

            if ( post_password_required() ){ 
                $gallery_container_class .= ' protected-gallery ';
            }

            $single_gallery = ' single-gallery ';

            $is_gallery_used = true;
        }
    ?>
    

    <?php 
        if( options::logic( 'blog_post' , 'post_sharing' ) || options::logic( 'blog_post' , 'page_sharing' ) || options::logic( 'general' , 'fb_comments' ) ){ 
            /*BOF if sharing or FB comments are enebled*/
            global $post;
            if ( ! in_array( 'wordpress-seo/wp-seo.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { 
                echo cosmo_get_site_meta();
            }

            if( is_single() || is_page() ){ 
                if(options::get_value( 'social' , 'facebook_app_id' ) != ''){
                    ?><meta property='fb:app_id' content='<?php echo options::get_value( 'social' , 'facebook_app_id' ); ?>'><?php
                }
                
                $src  = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , 'large' );
                if(strlen($src[0])){
                    echo '<meta property="og:image" content="'.$src[0].'"/>';     
                }else{
                    if ( strlen( trim( options::get_value( 'social' , 'fb_og_image' ) ) )  ) {
                        echo '<meta property="og:image" content="'.options::get_value( 'social' , 'fb_og_image' ).' "/>';
                    }else{
                        echo '<meta property="og:image" content="'.get_template_directory_uri().'/fb_screenshot.png"/>';
                    }
                }
                
                if(strlen($src[0])){
                    echo ' <link rel="image_src" href="'.$src[0].'" />';           
                }

                wp_reset_query();   
            }else{ 
                if ( strlen( trim( options::get_value( 'social' , 'fb_og_image' ) ) ) ) {
                    echo '<meta property="og:image" content="'.options::get_value( 'social' , 'fb_og_image' ).' "/>';
                }else{
                    echo '<meta property="og:image" content="'.get_template_directory_uri().'/fb_screenshot.png"/>';
                }
            }

        } /*EOF if sharing or FB comments are enebled*/
    ?>


    <title><?php bloginfo('name'); ?> &raquo;  <?php bloginfo('description'); ?><?php if ( is_single() ) { ?><?php } ?><?php wp_title(); ?></title>
    <?php 
    $mobile_view = options::get_value( 'styling' , 'mobile_view' );
    if ( $mobile_view == 'yes' ) {
    } else { ?>
    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    <?php } 
    
        if( strlen( options::get_value( 'styling' , 'favicon' ) ) ){
            $path_parts = pathinfo( options::get_value( 'styling' , 'favicon' ) );
            if( $path_parts['extension'] == 'ico' ){
    ?>
                <link rel="shortcut icon" href="<?php echo options::get_value( 'styling' , 'favicon' ); ?>" />
    <?php
            }else{
    ?>
                <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
    <?php
            }
        }else{
    ?>
            <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
    <?php
        }
    ?>

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link href='//fonts.googleapis.com/css?family=Gruppo' rel='stylesheet' type='text/css'>
	
    <!--[if lt IE 9]>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/autoinclude/ie.css">
    <![endif]-->

    <!-- IE Fix for HTML5 Tags -->
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <style>
            ul.header-slideshow-navigation > li.header-slideshow-navigation-elem,.flex-control-paging li a { background-color: #dfdfdf; }
            .pricing_box { background: none repeat scroll 0 0 #FFFFFF; border: 1px solid #dfdfdf; }
        </style>
    <![endif]-->    
    
    <!--[if lt IE 9]>       
        <style>
            #chrome_msg { color: #000; z-index: 999; position: fixed; top: 0; left: 0; background: #ece475; border: 2px solid #666; border-top: none; font: bold 11px Verdana, Geneva, Arial, Helvetica, sans-serif; line-height: 100%; width: 100%; text-align: center; padding: 5px 0; margin: 0 auto; }
            #chrome_msg a, #chrome_msg a:link { color: #a70101; text-decoration: none; }
            #chrome_msg a:hover { color: #a70101; text-decoration: underline; }
            #chrome_msg a#msg_hide { float: right; margin-right: 15px; cursor: pointer; }
            /* IE6 positioning fix */
            * html #chrome_msg { left: auto; margin: 0 auto; border-top: 2px solid #666;  }
        </style>
    <![endif]-->  
    <?php
        
/*        if( strlen(options::get_value( 'styling' , 'boxed_bg_color' ) ) ){
            $content_title_bg = "background-color: ".options::get_value( 'styling' , 'boxed_bg_color' )."!important";
        }else{
            $content_title_bg = '';
        }*/

        $template_directory_uri = get_template_directory_uri();
        
        $view_posrt_width = options::get_value( 'styling' , 'viewport_width' );

        if(options::logic( 'blog_post' , 'hide_gallery_info' )){
            
            $margin_left = '0px';
            
        }else{
            $margin_left = '300px';
        }
        echo <<<endhtml
            <style type="text/css">
                div.row{width:$view_posrt_width;}
                div.login-box-container{width:$view_posrt_width;}
                header #header-container .sticky-menu-container .sticky-content{ max-width:$view_posrt_width;}
                @media only screen and (min-width : 767px){
                    #main.folio #galleria, #main.clasic #galleria, #main.image_flow #cosmoImageFlow {margin-left:$margin_left;}
                }
            </style>
endhtml;
        
    ?>

    <?php wp_head(); ?>
</head>

<?php 

    $position   = '';
    $repeat     = '';
    $bgatt      = '';
    $background_color = '';
    $background_img ='';

    if( is_single() || is_page() ){
        $settings = meta::get_meta( $post -> ID , 'settings' );
        if( ( isset( $settings['post_bg'] ) && !empty( $settings['post_bg'] ) ) || ( isset( $settings['color'] ) && !empty( $settings['color'] ) ) ){
            if( isset( $settings['post_bg'] ) && !empty( $settings['post_bg'] ) ){ 
                $background_img = "background-image: url('" . $settings['post_bg'] . "');";
            }

            if( isset( $settings['color'] ) && !empty( $settings['color'] ) ){
                $background_color = "background-color: " . $settings['color'] . "; ";
            }

            if( isset( $settings['position'] ) && !empty( $settings['position'] ) ){
                $position = 'background-position: '. $settings['position'] . ';';
            }
            if( isset( $settings['repeat'] ) && !empty( $settings['repeat'] ) ){
                $repeat = 'background-repeat: '. $settings['repeat'] . ';';
            }
            if( isset( $settings['attachment'] ) && !empty( $settings['attachment'] ) ){
                $bgatt = 'background-attachment: '. $settings['attachment'] . ';';
            }
        }else{
            if(get_background_image() == '' && get_bg_image() != ''){ 
                if(get_bg_image() != 'pattern.none.png'){
                    $background_img = 'background-image: url('.get_template_directory_uri().'/lib/images/pattern/'.get_bg_image().');';
                }else{
                    $background_img = '';
                }    
                /*if day or night images are set then we will add 'background-attachment:fixed'   */
                if(strpos(get_bg_image(),'.jpg')){
                    $background_img .= ' background-attachment:fixed';
                }
            }else{
                $background_img = '';
            }
            if(get_content_bg_color() != ''){
                $background_color = "background-color: " . get_content_bg_color() . "; ";
            }
        }
    }else{
        if(get_background_image() == '' && get_bg_image() != ''){
            if(get_bg_image() != 'pattern.none.png'){
                $background_img = 'background-image: url('.get_template_directory_uri().'/lib/images/pattern/'.get_bg_image().');';
            }else{
                $background_img = '';
            }    
            /*if day or night images are set then we will add 'background-attachment:fixed'   */
            if(strpos(get_bg_image(),'.jpg')){
                $background_img .= ' background-attachment:fixed;';
            }
        }else{
            $background_img = '';
        }
        if(get_content_bg_color() != ''){
            $background_color = "background-color: " . get_content_bg_color() . "; ";
        }

        if( strlen( get_background_image() ) ){
            $background_img = '';
        }

        if( strlen( get_background_color() ) ){
            $background_color = '';
        }
    }
    $bgimage = get_background_image();
    if ((options::get_value( 'styling' , 'background_position_100' ) == 'yes') && (!empty($bgimage)) && (get_theme_mod('background_repeat', 'repeat') == 'no-repeat') && get_theme_mod('background_attachment', 'fixed') == 'fixed') {
        if(isset( $settings['post_bg'] ) && $settings['repeat'] == "no-repeat"){
            $position_100 = 'background-size: cover; -moz- background-size: cover; -webkit-background-size: cover;';
        }else if(isset( $settings['post_bg'] ) && $settings['repeat'] != "no-repeat"){
            $position_100 = '';
        }else {
            $position_100 = 'background-size: cover; -moz- background-size: cover; -webkit-background-size: cover;';
        }

    } else {
        $position_100 = '';
    }

    $clean_view_port_width = str_replace('%', '', str_replace('px', '', $view_posrt_width));

    global $post, $the_gallery_id;
    $additional_body_class = ' layout-'.$clean_view_port_width . ' '. $single_gallery . ' ' .get_posts_gallery_type($the_gallery_id) . ' ';
    
    if ( get_option( 'woocommerce_demo_store' ) == 'yes' ){
        $additional_body_class .= '  woocommerce-demo-store-notice ';
    }

    if(isset($current_template -> id)){
        $additional_body_class .= ' ' . 'template_' . $current_template -> id; // add the template ID as class
    }

    if(options::get_value( 'styling' , 'use_black_version' ) == 'yes') {
        $additional_body_class .= ' black_version ';
    }
?>
<body <?php body_class($additional_body_class); ?> style="<?php echo $position_100 ; ?> <?php echo $background_color ; ?> <?php echo $background_img ; ?>  <?php echo $position; ?> <?php echo $repeat; ?> <?php echo $bgatt; ?>">


   
    <?php  
        if( options::logic( 'blog_post' , 'post_sharing' ) || options::logic( 'blog_post' , 'page_sharing' ) || options::logic( 'general' , 'fb_comments' ) || is_element_used($current_template -> _header_rows, 'login') ){
            /*BOF if sharing or FB comments are enebled, OR login element is used in the header*/
    ?>       
    <script src="//connect.facebook.net/en_US/all.js#xfbml=1" type="text/javascript" id="fb_script"></script>
    <?php 
        } /*EOF if sharing or FB comments are enebled*/
    ?>

    <div id="page" class="container <?php //if( options::logic( 'styling', 'boxed' ) ) echo 'boxed';?>">
        <div id="fb-root"></div>
        <div class="relative row">
            <?php
                $tooltip_builder = new TooltipBuilder();
                $tooltip_builder -> render_frontend();
            ?>
        </div>
        <?php
            if( options::logic( 'general' , 'fb_comments' ) ){
                if(options::get_value( 'social' , 'facebook_app_id' ) != ''){
        ?>
                    <?php
                        if( is_user_logged_in () ){
                    ?>
                            <script type="text/javascript">
                                FB.getLoginStatus(function(response) {
                                    if( typeof response.status == 'unknown' ){
                                        jQuery(function(){
                                            jQuery.cookie('fbs_<?php echo options::get_value( 'social' , 'facebook_app_id' ); ?>' , null , {expires: 365, path: '/'} );
                                        });
                                    }else{
                                        if( response.status == 'connected' ){
                                            jQuery(function(){
                                                jQuery('#fb_script').attr( 'src' ,  document.location.protocol + '//connect.facebook.net/en_US/all.js#appId=<?php echo options::get_value( 'social' , 'facebook_app_id' ); ?>' );
                                            });
                                        }
                                    }
                                });
                            </script>
                    <?php
                        }
                }
            }
        ?> 
        
        <?php
            /*login form*/
            if(!is_user_logged_in() && is_element_used($current_template -> _header_rows, 'login')){ /*show login box only when user is not logged in and Login element is enabled in the template*/

                if(isset($_GET['action']) && ($_GET['action'] == 'login' || $_GET['action'] == 'recover' || $_GET['action'] == 'register') ){
                    $login_box_style ='display: block;';
                }else{
                    $login_box_style =' display:none; ';
                }
            ?>
                <div class="login_box" style="<?php echo $login_box_style; ?>">
                    <div class="login-box-container">
                        <span class="close_box" onclick=" jQuery('.login_box').slideToggle(); jQuery('.mobile-user-menu').animate({opacity:1},500);"></span>
                        <?php    
                            get_template_part('login');
                        ?>
                    </div>
                </div>
            <?php    
            }
            $sticky_header_option = options::logic ( 'styling' , 'show_sticky_header' );
        ?>
        
        <header id="top">
            <div id="header-container" <?php if ( $sticky_header_option ) echo 'class="sticky-header"'; ?> >
                <?php
                    /*the following commented code was moved upper because we need this initialized
                     yearlyer to get the template header BG color and template heater text color*/
                    /*$template = LBTemplate::figure_out_template();*/
                    $current_template -> render_header();
                ?>

            </div>
            <div class="sticky-header-delimiter hidden"></div>
        </header>
