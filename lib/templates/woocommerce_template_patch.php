<?php

    $header_rows = array(
        'delimiter_top' => array(
            'id' => 'delimiter_top123',
            '_elements' => array(
                
                'delimiter_top' => array(
                    'id' => 'delimiter_top123',
                    'delimiter_margin' => 'margin_30px',
                    'delimiter_type' => 'white_space',
                    'type' => 'delimiter'
                )
            )
        ),

        'topmenu' => array(
            'id' => 'topmenu123',
            '_elements' => array(
                
                'delimiter_top' => array(
                    'id' => 'topmenu123_logo',
                    'type' => 'menu_and_logo',
                    'element_columns' => 12,
                    'numberposts' => 6,
                    'text_align' => 'center',
                )
            )
        ),
        
        
    );

    $footer_rows = array(
        'delimiter123' => array(
            'id' => 'delimiter123',
            'row_bottom_margin_removed' => 'yes',
            '_elements' => array(
                'delimiter123' => array(
                    'id' => 'delimiter44',
                    'type' => 'delimiter',
                    'delimiter_type' => 'pointed',
                    'delimiter_text_color' => '#cecece',
                    'delimiter_margin' => 'margin_30px',
                    'element_columns' => 12
                )
            )
        ),
        
        'copyright' => array(
            'id' => 'copyright',
            '_elements' => array(
                'copyright' => array(
                    'id' => 'copyright',
                    'type' => 'copyright',
                    'element_columns' => 6
                ),
                'social_footer' => array(
                    'id' => 'social_footer',
                    'type' => 'socialicons',
                    'element_columns' => 6,
                    'text_align' => 'right',
                )
            )
        )
    );

	$wooshop_template = array(
        'name' => __( 'Woo shop', 'cosmotheme' ),
        'id' => 'shop123',
        '_header_rows' => $header_rows,
        ////////////////////////////////////
        '_rows' => array(
            'shop' => array(
                'id' => 'default1',
                'row_width' => 'full_width_no',
                
                'is_additional' => 0,
                '_elements' => array(
                    'latest' => array(
                        'id' => 'latest',
                        'type' => 'woo_shop',
                        'view' => 'grid_view',
                        'numberposts' => 12,
                        'columns' => 4,
                        'enb_masonry' => 'yes',
                        'behaviour' => 'none'
                    )
                )
            ),
            'additional' => array(
                'id' => 'additional',
                'row_width' => 'full_width_no',
                'top_margin'=> 'margin_top_0',
                'is_additional' => 1,
                'deactivate_row' => 'yes',
                '_elements' => array(
                    'default' => array(
                        'id' => 'default'
                    )
                )
            )
        ),
        ////////////////////////////////////
        '_footer_rows' => $footer_rows
    );


	$all_templates = get_option( 'templates' );

	$all_templates['shop123'] = $wooshop_template;
    

	update_option( 'templates', $all_templates );



    /*-------------------*/
    $posts_layout = array(
        'layout_type' => 'one_right_sidebar',
        'elements' => array(
            'first' => array(
                'id' => 'first',
                'columns' => 3,
                'disabled' => true,
                'sidebar' => 'main'
            ),
            'main' => array(
                'id' => 'main',
                'columns' => 9,
                'disabled' => false
            ),
            'second' => array(
                'id' => 'second',
                'columns' => 3,
                'disabled' => false,
                'sidebar' => 'main'
            )
        ),
        'template' => 'posts123'
    );

    $archive_layout = array(
        'layout_type' => 'full_width',
        'elements' => array(
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
        ),
        'template' => 'default123'
    );

    $shop_layout = array(
        'layout_type' => 'full_width',
        'elements' => array(
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
        ),
        'template' => 'shop123'
    );
	update_option('woo_shop_layout', $shop_layout);
    update_option('product_layout', $posts_layout);
    update_option('product_category_layout', $archive_layout);
    update_option('product_tag_layout', $archive_layout);
    
	
?>