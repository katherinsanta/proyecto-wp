<?php
    class image{
        static $size = array(
            //'tsignin'               => array( 32  , 32   , true ),
                'tlist'                 => array( 720 , 720 , true  ),  /* used for grid, thumb and mosaic view - crop */
                'tgrid_small'           => array( 340 , 340 , true  ),  /* used for grid, thumb and mosaic view - crop small version */
                'mosaic_long'           => array( 340 , 720 , true  ),  /* used for mosaic view - crop long version */
                'tlist_view'            => array( 640 , 340 , true  ),  /* used for list view - crop */
            
                'single_crop'           => array( 1905 , 525 , true  ),  /* used for single feat img cropped version*/
            
                't_attached_gallery'    => array( 265 , 165 , true  ),
                't_gallery'             => array( 9999, 400, false),
                'tsingle_gallery'       => array( 9999, 900, false)
        );

        /*static function add_size(){
            $size =array();
            if( function_exists( 'add_image_size' ) ){
                foreach( self::$size as $label => $args ){
                    $labels = explode( ',' , $label );
                    if( (int)$args[2] > 1 ){
                        add_image_size( $labels[0]  , $args[0] , $args[1] );
                    }else{
                        
                        add_image_size( $labels[0]  , $args[0] , $args[1] , $args[2] );
                    }
                }
            }
        }*/

        static function asize( $type ){
            foreach( self::$size as $label => $args ){
                $labels = explode( ',' , $label );
                if( count( $labels ) > 1 ){
                    foreach( $labels as $label ){
                        $size[ $label ] = $args;
                        if( $type == $label ){
                            if( $args[1] == 9999 ){
                                return array( $args[0] , $args[2] );
                            }else{
                                return array( $args[0] , $args[1] );
                            }
                        }
                    }
                }else{
                    $size[ $label ] = $args;
                    if( $type == $label ){
                        if( $args[1] == 9999 ){
                            return array( $args[0] , $args[2] );
                        }else{
                            return array( $args[0] , $args[1] );
                        }
                    }
                }
            }
        }

        static function tsize( $type ){
            foreach( self::$size as $label => $args ){
                $labels = explode( ',' , $label );
                if( count( $labels ) > 1 ){
                    foreach( $labels as $label ){
                        $size[ $label ] = $args;
                        if( $type == $label ){
                            if( $args[1] == 9999 ){
                                return $args[0] . 'x' . $args[2];
                            }else{
                                return $args[0] . 'x' . $args[1];
                            }
                        }
                    }
                }else{
                    $size[ $label ] = $args;
                    if( $type == $label ){
                        if( $args[1] == 9999 ){
                            return $args[0] . 'x' . $args[2];
                        }else{
                            return $args[0] . 'x' . $args[1];
                        }
                    }
                }
            }
        }

        static function caption( $post_id ){
            $result = '';
            $args = array(
                'numberposts' => -1,
                'post_type' => 'attachment',
                'status' => 'publish',
                'post_mime_type' => 'image',
                'post_parent' => $post_id
            );

            $images = get_children( $args );

            if( isset( $images[ get_post_thumbnail_id( $post_id ) ] ) ){
                $result = $images[ get_post_thumbnail_id( $post_id ) ] -> post_excerpt;
            }else{
                $args = array(
                    'numberposts' => -1,
                    'post_type' => 'attachment',
                    'status' => 'publish',
                    'post_mime_type' => 'image',
                    'post_parent' => 0
                );

                $images = get_children($args);

                if( isset( $images[  get_post_thumbnail_id( $post_id ) ] ) ){
                    $result = $images[ get_post_thumbnail_id( $post_id ) ] -> post_excerpt;
                }else{
                    $result = '';
                }
            }

            return $result;
        }

        static function thumbnail( $post_id , $template , $size = '' ){
            return wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ) , 'full' );
        }

        static function mis( $post_id , $template , $size = '' , $classes = '' , $side = 'no.image' ){
            return '<img src="' . get_template_directory_uri() . '/images/' . $side . '.' . self::tsize( self::size( $post_id , $template , $size ) ) . '.png" class="' . $classes . '" />';
        }

        static function get_post_imag_src($post_id, $size){
            /*will return the source for featured images OR no_img */
            
            if(has_post_thumbnail($post_id)) {
                $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ) ,  $size );
                $src = $src[0];
            }else{
                $src = get_template_directory_uri() .'/images/no.image.570x380.png';
            }  

            return $src; 
        }

    }
?>