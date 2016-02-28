<?php
    class LBTemplate{
        public $callback = false;
        function __construct( $data = array() ){
            $this -> id = '__template__';
            $this -> _rows = array();
            $this -> rows = array();
            $this -> _header_rows = array();
            $this -> header_rows = array();
            $this -> _footer_rows = array();
            $this -> footer_rows = array();
            $this -> example = "Example value";
            $this -> enable_slideshow = 'yes';
            $this -> slideshowID = 0;
            $this -> slideshow_type = 'limited';
            $this -> slideshow_autoplay = 'yes';
            $this -> slide_speed = 5; 
            $this -> transition_speed = 7;                        
            $this -> header_bg_color = '';
            $this -> menu_text_color  = '';
            $this -> menu_hover_bg_color  = '';
            $this -> menu_hover_text_color  = '';
            $this -> name = __( 'New template', 'cosmotheme' );
            foreach( $data as $identifier => $value ){
                $this ->{ $identifier } = $value;
            }

            foreach( $this -> _header_rows as $data ){
                $row = new LBHeaderRow( $data );
                $row -> template =& $this;
                $this -> header_rows[] = $row;
            }

            foreach( $this -> _rows as $data ){
                $row = new LBRow( $data );
                $row -> template =& $this;
                $this -> rows[ $row -> id ] = $row;
            }

            foreach( $this -> _footer_rows as $data ){
                $row = new LBFooterRow( $data );
                $row -> template =& $this;
                $this -> footer_rows[] = $row;
            }
        }

        function slideshows_list($name, $checked){
            $slideshow = new LBTemplateBuilder();
            $slideshow->list_slideshows($name, $checked);
        }

        function get_prefix(){
            return $this -> builder -> get_prefix() . "[$this->id]";
        }

        function render_backend(){
            include get_template_directory() . '/lib/templates/layouttemplate.php';
        }

        static function figure_out_template(){
            if( is_front_page() ){
                return self::get_template( 'front_page' );
            }else if( is_404() ){
                return self::get_template( '404' );
            }else if( is_category() ){
                return self::get_template( 'category' );
            }else if( is_tag() ){
                return self::get_template( 'tag' );
            }else if( is_tax('gallery-tag') ){
                return self::get_template( 'gallery_tag' );    
            }else if( is_tax('gallery-category') ){
                return self::get_template( 'gallery_category' );        
            }else if( is_tax('product_tag') ){            // for product tag
                return self::get_template( 'product_tag' );    
            }else if( is_tax('product_cat') ){                  // for product cat
                return self::get_template( 'product_category' );        
            }else if( is_attachment() ){
                return self::get_template( 'attachment' );
            }else if( is_author() ){
                return self::get_template( 'author' );
            }else if( is_search() ){
                return self::get_template( 'search' );    
            }else if( function_exists('is_shop') && is_shop() ){   // for shop page
                return self::get_template( 'woo_shop' );
            }else if( is_archive() ){
                return self::get_template( 'archive' );
            }else if( is_home() ){
                return self::get_template( 'index' );
            }else if(is_singular('gallery')){
                return self::get_template( 'gallery' );
            }else if( is_singular() ){
                $resizer = new LBPageResizer();
                $resizer -> load_all();
                return $resizer -> get_builder();
            }
        }

        static function get_template( $template ){

            /* we use this for update action for default templates */
            $templateID = options::get_value( $template . '_layout', 'template' );

            /* fix for compatibility with migration from v 0.1 to 0.2 */
            if(!strlen(trim($templateID))){ /*this usually should happen for the event if the default telate for it was not assigned on first install*/
                $templateID = options::get_value( 'single_layout', 'template' ); /*if template ID is not defined we will use template assigned for single */
            }

            $all_templates = get_option( 'templates' );
            $data = $all_templates[$templateID];

            if( is_array( $data ) && isset( $data[ 'id' ] ) ){
                return new LBTemplate( $data );
            }else{
                $defaults = array(
                    'id' => 'default',
                    '_rows' => array(
                        array(
                            'id' => 'default',
                            'is_additional' => true,
                            '_elements' => array(
                                array(
                                    'id' => 'default'
                                )
                            )
                        )
                    )
                );
                if( 'front_page' == $template ){
                    $defaults[ '_rows' ][ 1 ] = array();
                    $defaults[ '_rows' ][ 1 ][ '_elements' ] = array(
                        array(
                            'id' => 'default',
                            'type' => 'latest'
                        )
                    );
                }
                return new LBTemplate( $defaults );
            }
        }

        static function get_template_by_id( $id ){
            /* we use this for update action for new created templates */
            $all_templates = get_option( 'templates' );
            $data = $all_templates[$id];
            
            if( is_array( $data ) && isset( $data[ 'id' ] ) ){
                return new LBTemplate( $data );
            }else{
                $defaults = array(
                    'id' => 'default',
                    '_rows' => array(
                        array(
                            'id' => 'default',
                            'is_additional' => true,
                            '_elements' => array(
                                array(
                                    'id' => 'default'
                                )
                            )
                        )
                    )
                );
                
                return new LBTemplate( $defaults );
            }
        }

        function render_header(){
            foreach( $this -> header_rows as $index => $row ){ //deb::e($row);
                $row -> render_content();
            }
        }

        function render_footer(){
            foreach( $this -> footer_rows as $index => $row ){
                $row -> render_content();
            }
        }

        function render_content(){
            foreach( $this -> rows as $row ){
                $row -> render_content();
            }
        }
    }
?>