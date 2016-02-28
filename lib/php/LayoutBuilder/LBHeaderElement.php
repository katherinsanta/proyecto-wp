<?php
class LBHeaderElement extends LBElement{
    private $words_full_width = array( 0 => 'twelve', 1 => 'twelve', 2 => 'six', 3 => 'four', 4 => 'three', 5 => 'three', 6 => 'two', 7 => 'two', 8 => 'one', 9 => 'one', 10 => 'one', 11 => 'one', 12 => 'one' );
    function columns_arabic_to_word( $arabic ){
        return $this -> words_full_width[ $arabic ];
    }

    function __construct( $data ){
        parent::__construct( $data );
        $this -> element_columns = 12;
        $this -> id = '_id_';
        $this -> name = __( 'New element' , 'cosmotheme' );
        $this -> type = 'empty';
        $this -> show_title = 'no';
        $this -> main_menustyles = 'default';
        $this -> popular_tags_period = '7';
        $this -> popular_tags_criteria = 'most_used_tags';
        $this -> number_tags = 6;
        $this -> text_align = 'left';
        $this -> vertical_align = 'top';
        $this -> testimonial_options = 'slide';
        $this -> login_label = 'Sign In';
        $this -> register_label = 'Register';
        $this -> my_account_label = 'My Account';
        
        foreach( $data as $identifier => $value ){
            $this ->{ $identifier } = $value;
        }
    }

    function get_prefix(){
        return $this -> row -> get_prefix() . "[_elements][$this->id]";
    }

    function render_backend(){
        include get_template_directory() . '/lib/templates/headerelement.php';
    }

    function render_frontend(){
        //$this -> is_fullwidth = ( 12 == $this -> element_columns ) && !( $this -> row -> template -> layout_has_sidebars );
        if ($this -> type == 'dynamicart' || $this -> type == 'login' || $this -> type == 'widget_zone' ||  $this -> type == 'textelement' || $this -> type == 'menu' || $this -> type == 'top_menu' || $this -> type == 'socialicons' || $this -> type == 'searchbar' || $this -> type == 'logo' || $this -> type == 'menu_and_logo' ) {
        
            if ($this -> text_align == 'left') {
                $text_align_class = 'align-left';
            }elseif ($this -> text_align == 'center'){
                $text_align_class = 'align-center';
            }elseif ($this -> text_align == 'right'){
                $text_align_class = 'align-right';
            }
        }else { $text_align_class = ''; }        
        $type = $this -> type;
        
        echo '<div class="' . $this -> type . ' ' . $text_align_class . ' ' . LBRenderable::$words[ $this -> element_columns ] . ' columns">';
            call_user_func( array ( $this, "render_frontend_$type" ) );
        echo '</div>';
        
        if (($this->type == 'menu' || $this->type == 'menu_and_logo') && options::logic( 'styling' , 'show_sticky_menu' )) {
            echo '<div class="no-padding">';
            echo '<div class="sticky-menu-container">';
            echo '<div class="sticky-content ' . $text_align_class . '">';
            $this -> render_frontend_menu($is_stiky = true);
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        
    }

    function render_frontend_popular_tags(){
        /* Defaults
        $this -> popular_tags_period = '7';
        $this -> number_tags = 6;
        $this -> popular_tags_label = __('In the news','cosmotheme');
        $this -> popular_tags_criteria = 'most_used_tags';  //or tags_in_popular_posts
        */

        

        $GLOBALS['nr_days'] = $this -> popular_tags_period;    
        $tags_in = array();
            
        if($this -> popular_tags_criteria ==  'tags_in_popular_posts' &&  function_exists( 'stats_get_csv' )  ){
            /* in this case we will get posts ordered by  'nr_views' meta*/

            $args = array('posts_per_page' => -1, 'post_status' => 'publish','meta_key' => 'nr_views','orderby' => 'meta_value_num' ,'order' => 'DESC');
            add_filter( 'posts_where', array('LBHeaderElement',"filter_where_last_x_days") );

            $wp_query = new WP_Query( $args );

            /* remove filter where*/
            remove_filter( 'posts_where', array('LBHeaderElement',"filter_where_last_x_days") );
           
            if(isset( $wp_query -> posts) && count($wp_query->posts) ){
                foreach ($wp_query -> posts as $post) {
                    if(sizeof($tags_in) >= $this -> number_tags ) {break;}

                    $tags = wp_get_post_terms($post -> ID, 'post_tag');

                    foreach ($tags as $tag) {
                        if(sizeof($tags_in) >= $this -> number_tags ) {break;}

                        if(!in_array($tag -> term_id, $tags_in)){
                            $tags_in[] = $tag -> term_id;     
                        }  
                    }    
                    
                }
            }

        }else{ /*$this -> popular_tags_criteria == 'most_used_tags'*/
            /*we will get posts from the specified period of time*/
            
            $args = array('posts_per_page' => -1, 'post_status' => 'publish');
            
            add_filter( 'posts_where', array('LBHeaderElement',"filter_where_last_x_days") );

            $wp_query = new WP_Query( $args );

            /* remove filter where*/
            remove_filter( 'posts_where', array('LBHeaderElement',"filter_where_last_x_days") );
            
            if(isset( $wp_query -> posts) && count($wp_query->posts) ){
                foreach ($wp_query -> posts as $post) {
                    $tags = wp_get_post_terms($post -> ID, 'post_tag');

                    foreach ($tags as $tag) {
                        if(!in_array($tag -> term_id, $tags_in)){
                            $tags_in[] = $tag -> term_id;     
                        }  
                    }    
                    
                }
            }

        }    

        $include_tags = implode( ',', $tags_in);
        $tags_found = get_tags( array('orderby' => 'count', 'order' => 'DESC','number' => $this -> number_tags, 'include' => $include_tags) );


        if(sizeof($tags_found)){
        ?>
            <div class="popular-tags">
                <?php echo $this -> popular_tags_label; ?>
                <ul>
                    <?php foreach ($tags_found as $tag) { ?> 
                        <li><a href="<?php echo get_tag_link($tag -> term_id); ?>"><?php echo $tag -> name; ?></a></li>
                    <?php } ?>
                    
                </ul>
            </div>
        <?php
        } /*EOF if*/
    }

    function render_frontend_logo(){
        if( 'image' == options::get_value( 'styling' , 'logo_type' ) ){
            $this -> src = strlen( trim( options::get_value( 'styling' , 'logo_url' ) ) ) ? options::get_value( 'styling' , 'logo_url' ) : get_template_directory_uri() . '/images/logo.png';
            
            $logo_src = wp_get_attachment_image_src( options::get_value( 'styling' , 'logo_url_id' ) , 'full' ); 

            if (options::logic( 'styling' , 'use_retina_logo' )) {
                $size = getimagesize($this -> src);
                $retina_size = 'width="' .round($logo_src[1] / 2) .'"';
                $retina_size_class = 'style="width:'. round($size[0] / 2 ). 'px"';
            }else{
                $retina_size = '';
                $retina_size_class = '';
            }

            ?>
            <div class="align-<?php echo $this -> vertical_align; ?>">
                <a <?php echo $retina_size_class;?> href="<?php echo home_url();?>">
                    <img alt="<?php bloginfo('name'); ?>" <?php echo $retina_size;?> src="<?php echo $this -> src;?>" />
                </a>
            </div>
            <?php
        }else{
            ?>
            <div class="<?php echo $this -> vertical_align; ?>">
                <a href="<?php echo home_url();?>">    
                    <h1 >
                        <span ><?php echo get_bloginfo( 'name' );?></span>
                    </h1>
                    <?php if (options::logic( 'styling' , 'enb_site_description' )) { ?>
                        <span><?php echo get_bloginfo( 'description' );?></span>
                    <?php } ?>
                </a> 
            </div>   
            <?php
        }
    }

    function render_frontend_menu_and_logo(){

        if( options::get_value( 'styling' , 'logo_type' ) == 'text' ) { 
            ob_start();
            ob_clean();
            bloginfo('name');
            $blog_name = ob_get_clean();

            $logo_content = '<a href="'.home_url().'" class="hover"><h1>' . $blog_name . '</h1>';

            if (options::logic( 'styling' , 'enb_site_description' )) {
                $logo_content .= '<span>'. get_bloginfo( 'description' ). '</span></a>';
            }
                
        }elseif(options::get_value( 'styling' , 'logo_type' ) == 'image' && options::get_value( 'styling' , 'logo_url' ) == '' ){ 

            if (options::logic( 'styling' , 'use_retina_logo' )) {
                $size = getimagesize(get_template_directory_uri().'/images/logo.png');
                $retina_size = 'width="' .$size[0] / 2 .'"';
                $retina_size_class = 'style="width:'. $size[0] / 2 . 'px"';
            }else{
                $retina_size = '';
                $retina_size_class = '';
            }
            
            $logo_content = '
                <a '. $retina_size_class .' href="'.home_url().'" class="hover">
                    <img alt="'. get_bloginfo('name').'" '. $retina_size .' src="'.get_template_directory_uri().'/images/logo.png" />
                </a>';
        }else{

            $logo_src = options::get_value( 'styling' , 'logo_url' ); 
           
            if (options::logic( 'styling' , 'use_retina_logo' )) {
                $size = getimagesize($logo_src);
                $retina_size = 'width="'. $size[0] / 2 .'"';
                $retina_size_class = 'style="width:'. $size[0] / 2 . 'px"';
            }else{
                $retina_size = '';
                $retina_size_class = '';
            }
            
            $logo_content = '
            <a '. $retina_size_class .' href="'.home_url().'" class="hover">
                <img alt="'.get_bloginfo('name').'" '. $retina_size .' src="'.$logo_src.'" >
            </a>';

        }

        wp_localize_script( 'functions', 'logo', array(
            // localize logo that will be inserted in hte bidlle of the menu
            'logoContent'          => $logo_content,
            )
        );

        echo '<div class="menu-with-logo">';
        echo self::render_frontend_menu();
        echo '</div>';
    }

    function render_frontend_menu($is_stiky = false){

        if($is_stiky){
            $prepend_id = '_stiky';
        }else{
            $prepend_id = '';
        }

        /*mobile menu*/    
?>
        <div id="small-device-nav<?php echo $prepend_id ?>" class="small-device-nav <?php if( options::logic( 'styling' , 'menu_swipe' ) ) {echo 'swipe';} ?>">
            <ul id="small-menuid<?php echo $prepend_id ?>">
                <li class="small-device-menu"><a href="#modal-menu" class="small-device-menu-link open-menu"><i class="icon-menu"></i></a></li>
            </ul>
        </div>
        <?php if ( ( get_post_type() == 'gallery' ) && ( wp_is_mobile() ) ) { ?>
            <a class="mobile-info "href="#"><i class="icon-info"></i></a>
        <?php } ?>
        <div id="modal-menu<?php echo $prepend_id ?>" class="modal-menu">
            <?php 

            echo menu( 'header_menu' , array( 

                'container'       => 'div',
                'container_class' => 'main-menu cosmo-menu align-'. $this -> vertical_align,
                'number-items' => 70,
                'current-class' => 'selected',
                'type' => 'category',
                'class' => 'mobile-menu',
                'menu_id' => 'mobile_menu'.$prepend_id

                ) 
            ); 

            ?>

                
        </div>
<?php
        if($this->main_menustyles == 'vertical'){
            $columns_class = $this -> columns_arabic_to_word( $this -> columns ).' columns'; 
        }else{
            $columns_class = '';
        }
        echo menu( 'header_menu' , array(
            'container'       => 'nav',
            'container_class' => 'main-menu cosmo-menu align-'. $this -> vertical_align,
            'number-items' => $this -> numberposts,
            'current-class' => 'selected',
            'type' => 'category',
            'class' => 'sf-menu',
            'menu_id' => 'main-menu'.$prepend_id,
            'menu_style' =>  $this -> main_menustyles,
            'nr_columns' =>  $columns_class
        ));
    }

    function render_frontend_top_menu(){
        if($this->main_menustyles == 'vertical'){
            $columns_class = $this -> columns_arabic_to_word( $this -> columns ).' columns'; 
        }else{
            $columns_class = '';
        }
        echo menu( 'top_menu' , array(
            'container'       => 'nav',
            'container_class' => 'top-menu cosmo-menu align-'. $this -> vertical_align,   
            'number-items' => $this -> numberposts,
            'current-class' => 'active',
            'type' => 'category',
            'class' => 'sf-menu top-menu',
            'menu_id' => 'nav-menu-top',
            'menu_style' =>  $this -> main_menustyles,
            'nr_columns' =>  $columns_class
        ));
    }

    function get_menu_item_from_option( $class, $label, $tab, $option_name, $icon_class ){
        $page_id = (int) options::get_value( $tab , $option_name );
        if( $page_id > 0 ){
            return $this -> get_menu_item( $class, get_page_link( $page_id ), $label, $icon_class );
        }
    }

    function get_menu_item( $class, $url, $label, $icon_class ){
        return <<<endhtml
                <li class="$class">
                	<a href="$url">
                        <i class="$icon_class"></i>
                		$label
                	</a>
            	</li>
endhtml;
    }

    function render_frontend_breadcrumbs(){
        dimox_breadcrumbs();
    }

    function render_frontend_textelement(){
        echo '<div class="align-'. $this -> vertical_align .'">';
        echo do_shortcode($this -> text); 
        echo '</div>';        
    }

    ////////// Woocommerce



    function render_frontend_login(){ 
        echo '<div class="align-'.$this -> vertical_align.'">';

        $myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
        $my_account_link = get_permalink( $myaccount_page_id );
        $logout_url = wp_logout_url( get_permalink( $myaccount_page_id ) );

        /*
            WooCommerce 2.1+ endpoint slug options
            
                    // Checkout actions
                    'order-pay'          => get_option( 'woocommerce_checkout_pay_endpoint', 'order-pay' ),
                    'order-received'     => get_option( 'woocommerce_checkout_order_received_endpoint', 'order-received' ),

                    // My account actions
                    'view-order'         => get_option( 'woocommerce_myaccount_view_order_endpoint', 'view-order' ),
                    'edit-account'       => get_option( 'woocommerce_myaccount_edit_account_endpoint', 'edit-account' ),
                    'edit-address'       => get_option( 'woocommerce_myaccount_edit_address_endpoint', 'edit-address' ),
                    'lost-password'      => get_option( 'woocommerce_myaccount_lost_password_endpoint', 'lost-password' ),
                    'customer-logout'    => get_option( 'woocommerce_logout_endpoint', 'customer-logout' ),
                    'add-payment-method' => get_option( 'woocommerce_myaccount_add_payment_method_endpoint', 'add-payment-method' ),
        */
        
        if ( is_user_logged_in() ) { ?>
            <ul class="login-menu sf-menu">
                <li>
                    <?php 
                    if ( wp_is_mobile() ) { ?>
                        <a class="mobile-my-account" title="<?php echo $this -> my_account_label; ?>"><i class="icon-author"></i><?php echo $this -> my_account_label; ?></a>
                        <?php 
                    } else { ?>
                        <a href="<?php echo $my_account_link; ?>" title="<?php echo $this -> my_account_label; ?>"><i class="icon-author"></i><?php echo $this -> my_account_label; ?></a>
                        <?php
                    } ?>
                    <ul>
                        <?php

                            if ( wp_is_mobile() ) { ?>
                                <li><a href="<?php echo $my_account_link; ?>"><?php echo __( 'Go to ', 'cosmotheme' ) . $this -> my_account_label; ?></a></li>
                            <?php 
                            }

                            if (options::get_value( 'blog_post' , 'wish_page' ) != 0) {
                                $url = get_permalink(options::get_value( 'blog_post' , 'wish_page' ));
                                echo $this -> get_menu_item( 'wishlist',$url, __( 'My wishlist' , 'cosmotheme' ), '' );
                            }

                            echo $this -> get_menu_item( 'orders', $my_account_link . get_option( 'woocommerce_myaccount_view_order_endpoint', 'view-order' ), __( 'View Order' , 'cosmotheme' ), '' );
                            echo $this -> get_menu_item( 'edit-address', $my_account_link . get_option( 'woocommerce_myaccount_edit_address_endpoint', 'edit-address' ), __( 'My address' , 'cosmotheme' ), '' );
                            echo $this -> get_menu_item( 'change-password', wc_customer_edit_account_url() , __( 'Change password' , 'cosmotheme' ), '' );


                            if ( $myaccount_page_id && get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' ) {
                                $logout_url = str_replace( 'http:', 'https:', $logout_url );
                            }

                            if ( strlen($logout_url) ) {
                               echo $this -> get_menu_item( 'my-logout', $logout_url, __( 'Log out' , 'cosmotheme' ), '' );
                            }
                        ?>
                    </ul>
                    <div class="clear"></div>
                </li>
            </ul>
        <?php } else { ?>

            <ul class="login-menu sf-menu">
                <li>
                    <a class="signin" href="<?php echo $my_account_link ?>" title="<?php echo $this -> login_label.'-'.$this -> register_label; ?>"><i class="icon-author"></i><span><?php echo $this -> login_label; ?></span> <span class="login-delimiter"></span> <span><?php echo $this -> register_label; ?></span></a>
                </li>
            </ul>
        <?php } 
        echo '</div>';
    }

    function render_frontend_dynamicart(){
        echo '<div class="align-'.$this -> vertical_align.'">';
        get_template_part('/woocustomtemplates/dynamic-shopping-bag');
        echo '</div>';
    }



    /////////////
    function render_frontend_socialicons(){
        $this->get_social_icons();
    }

    function render_frontend_searchbar(){
        ?>
        <div class="align-<?php echo $this -> vertical_align;?>">
            <form id="searchform" method="get" action="<?php echo home_url(); ?>/">
                <fieldset>
                    <input type="text" onblur="if (this.value == '') {this.value = '<?php echo __( 'type something and click enter', 'cosmotheme' );?>'}" onfocus="if (this.value == '<?php echo __( 'type something and click enter', 'cosmotheme' );?>'){this.value = '';}" value="<?php echo __( 'type something and click enter', 'cosmotheme' );?>" id="keywords" name="s" class="input" />
                    <input type="submit" value="<?php _e('Search','cosmotheme') ?>" class="button" id="header-search-submit" />
                </fieldset>
            </form>
        </div>
        <?php

    }

    function get_social_icons(){
    ?>    
        <ul class="cosmo-social <?php if(isset($this -> vertical_align)) { echo 'align-' . $this -> vertical_align; } ?>">
        <?php        
        $fb_id = options::get_value( 'social' , 'facebook' );
        if( strlen( trim( $fb_id ) ) ){
            ?>
            <li><a href="<?php echo 'http://facebook.com/people/@/'  . $fb_id ; ?>" target="_blank" class="fb hover-menu"><i class="icon-facebook"></i></a></li>
            <?php
        }

        if( strlen( options::get_value( 'social' , 'twitter' ) ) ){
            ?>
            <li><a href="http://twitter.com/<?php echo options::get_value( 'social' , 'twitter' ) ?>" target="_blank" class="twitter hover-menu"><i class="icon-twitter"></i></a></li>
            <?php
        }
        ?>
        <?php
        if( strlen( options::get_value( 'social' , 'gplus' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'gplus' ) ?>" target="_blank" class="gplus hover-menu"><i class="icon-gplus"></i></a></li>
            <?php
        }
        if( strlen( options::get_value( 'social' , 'yahoo' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'yahoo' ) ?>" target="_blank" class="yahoo hover-menu"><i class="icon-yahoo"></i></a></li>
            <?php
        }
        if( strlen( options::get_value( 'social' , 'dribbble' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'dribbble' ) ?>" target="_blank" class="dribbble hover-menu"><i class="icon-dribbble"></i></a></li>
            <?php
        }
        if( strlen( options::get_value( 'social' , 'linkedin' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'linkedin' ) ?>" target="_blank" class="linkedin hover-menu"><i class="icon-linkedin"></i></a></li>
            <?php
        }

        if( strlen( options::get_value( 'social' , 'vimeo' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'vimeo' ) ?>" target="_blank" class="vimeo hover-menu"><i class="icon-vimeo"></i></a></li>
            <?php
        }
        
        if( strlen( options::get_value( 'social' , 'youtube' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'youtube' ) ?>" target="_blank" class="yt hover-menu"><i class="icon-youtube"></i></a></li>
            <?php
        }
        
        if( strlen( options::get_value( 'social' , 'tumblr' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'tumblr' ) ?>" target="_blank" class="tumblr hover-menu"><i class="icon-tumblr"></i></a></li>
            <?php
        }
        
        if( strlen( options::get_value( 'social' , 'delicious' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'delicious' ) ?>" target="_blank" class="delicious hover-menu"><i class="icon-delicious"></i></a></li>
            <?php
        }
        
        if( strlen( options::get_value( 'social' , 'flickr' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'flickr' ) ?>" target="_blank" class="flickr hover-menu"><i class="icon-flickr"></i></a></li>
            <?php
        }

        if( strlen( options::get_value( 'social' , 'instagram' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'instagram' ) ?>" target="_blank" class="instagram hover-menu"><i class="icon-instagram"></i></a></li>
            <?php
        }

        if( strlen( options::get_value( 'social' , 'pinterest' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'pinterest' ) ?>" target="_blank" class="pinterest hover-menu"><i class="icon-pinterest"></i></a></li>
            <?php
        }
        
        if( strlen( options::get_value( 'social' , 'skype' ) ) ){
            ?>
            <li><a href="skype:<?php echo options::get_value( 'social' , 'skype' ) ?>?call" target="_blank" class="skype hover-menu"><i class="icon-skype"></i></a></li>
            <?php
        }

        if( strlen( options::get_value( 'social' , 'email' ) ) ){
            ?>
            <li><a href="mailto:<?php echo options::get_value( 'social' , 'email' ); ?>" target="_blank" class="email hover-menu"><i class="icon-email"></i></a></li>
            <?php
        }

        if( options::logic( 'social' , 'rss' ) ){
            ?>
            <li><a href="<?php bloginfo('rss2_url'); ?>" class="rss hover-menu"><i class="icon-rss"></i></a></li>
            <?php
        }
        ?>    
            </ul>
        <?php
        
    }

    /*retrieves posts from last x days*/
    function filter_where_last_x_days($where = '', $days = 7 ){
        $days = $GLOBALS['nr_days']; /*use the global variable that is set before the filter*/
        $where .= " AND post_date > '" . date('Y-m-d', strtotime('-'.$days.' days')) . "'";  
        return $where;
    }

    /*retrieves posts from last x hours*/
    function filter_where_last_x_hours($where = '', $hours = 7 ){
        $hours = options::get_value( 'blog_post' , 'breaking_news_expiration_time' );
        $where .= " AND post_date > '" . date('Y-m-d h:i', strtotime('-'.$hours.' hours')) . "'";  
        return $where;
    }
}
?>