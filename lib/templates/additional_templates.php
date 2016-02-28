<?php
	global $galleries_list, $galleries, $blog_large_list, $blog_medium_list, $blog_grid_view, $blog_thumb_view, $blog_full_thumb; 
	$galleries_list = array(
        'name' => __( 'Galleries list', 'cosmotheme' ),
        'id' => 'galleries_list',
        '_header_rows' => array(
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
        ),
        '_rows' => array(
        	'the_content' => array(
                'id' => 'additional_content',
                'is_additional' => 0,
                'deactivate_row' => 'yes',
                '_elements' => array(
                    '136488479366' => array(
		                'id' => 1364884793662,
		                'element_columns' => 12,
		                'name' => __('List view','cosmotheme'),
		                'label_description' => __('no sidebars and load more option','cosmotheme'),
		                'show_title' => 'yes',
		                'type' => 'latest_galleries',
		                'view' => 'list_view',
		                'enb_masonry' => 'no',
		                'remove_gutter' => 'no',
		                'list_view_excerpt' => 'excerpt',
		                'numberposts' => 6,
		                'list_view_thumb_size' => 'full_width_thumb',
		                'columns' => 3,
		                'behaviour' => 'load_more',
		                'orderby' => 'date',
		                'order' => 'desc'
		            )
                )
            ),
        	
        	
            'additional' => array(
                'id' => 'additional',
                'is_additional' => 1,
                'deactivate_row' => 'yes',
                '_elements' => array(
                    'default' => array(
                        'id' => 'default',
                        'behaviour' => 'pagination'
                    )
                )
            )
        ),
        '_footer_rows' => array(
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
        )
    );

/********************/

	$galleries = array(
        'name' => __( 'Galleries', 'cosmotheme' ),
        'id' => 'galleries',
        '_header_rows' => array(
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
        ),
        '_rows' => array(
        	'the_content' => array(
                'id' => 'additional_content',
                'is_additional' => 0,
                'deactivate_row' => 'yes',
                '_elements' => array(
                    '136488479366' => array(
		                'id' => 1364884793662,
		                'element_columns' => 12,
		                'name' => __('Mosaic-view','cosmotheme'),
		                'label_description' => __('12 posts with no pagination','cosmotheme'),
		                'show_title' => 'yes',
		                'type' => 'latest_galleries',
		                'view' => 'mosaic_view',
		                'enb_masonry' => 'no',
		                'remove_gutter' => 'no',
		                'numberposts' => 12,
		                'behaviour' => 'none',
		                'orderby' => 'date',
		                'order' => 'desc'
		            )
                )
            ),
        	
        	
            'additional' => array(
                'id' => 'additional',
                'is_additional' => 1,
                'deactivate_row' => 'yes',
                '_elements' => array(
                    'default' => array(
                        'id' => 'default',
                        'behaviour' => 'pagination'
                    )
                )
            )
        ),
        '_footer_rows' => array(
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
        )
    );
/*********************/

 
	$blog_large_list = array(
        'name' => __( 'Blog large list view', 'cosmotheme' ),
        'id' => 'blog_large_list',
        '_header_rows' => array(
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
        ),
        '_rows' => array(
        	'the_content' => array(
                'id' => 'additional_content',
                'is_additional' => 0,
                'deactivate_row' => 'yes',
                '_elements' => array(
                    '136488479366' => array(
		                'id' => 1364884793662,
		                'element_columns' => 12,
		                'name' => __('List view','cosmotheme'),
		                'label_description' => __('5 posts with load more','cosmotheme'),
		                'show_title' => 'yes',
		                'type' => 'latest',
		                'view' => 'list_view',
		                'enb_masonry' => 'no',
		                'remove_gutter' => 'no',
		                'list_view_excerpt' => 'excerpt',
		                'numberposts' => 5,
		                'list_view_thumb_size' => 'full_width_thumb',
		                'behaviour' => 'load_more',
		                'orderby' => 'date',
		                'order' => 'desc'
		            )
                )
            ),
        	
        	
            'additional' => array(
                'id' => 'additional',
                'is_additional' => 1,
                'deactivate_row' => 'yes',
                '_elements' => array(
                    'default' => array(
                        'id' => 'default',
                        'behaviour' => 'pagination'
                    )
                )
            )
        ),
        '_footer_rows' => array(
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
        )
    );
/**************************/
$blog_medium_list = array(
        'name' => __( 'Blog medium list view', 'cosmotheme' ),
        'id' => 'blog_medium_list',
        '_header_rows' => array(
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
        ),
        '_rows' => array(
        	'the_content' => array(
                'id' => 'additional_content',
                'is_additional' => 0,
                'deactivate_row' => 'yes',
                '_elements' => array(
                    '136488479366' => array(
		                'id' => 1364884793662,
		                'element_columns' => 12,
		                'name' => __('List-view','cosmotheme'),
		                'label_description' => __('5 posts with pagination','cosmotheme'),
		                'show_title' => 'yes',
		                'type' => 'latest',
		                'view' => 'list_view',
		                'enb_masonry' => 'no',
		                'remove_gutter' => 'no',
		                'list_view_excerpt' => 'excerpt',
		                'numberposts' => 5,
		                'list_view_thumb_size' => 'medium_width_thumb',
		                'behaviour' => 'pagination',
		                'orderby' => 'date',
		                'order' => 'desc'
		            )
                )
            ),
        	
        	
            'additional' => array(
                'id' => 'additional',
                'is_additional' => 1,
                'deactivate_row' => 'yes',
                '_elements' => array(
                    'default' => array(
                        'id' => 'default',
                        'behaviour' => 'pagination'
                    )
                )
            )
        ),
        '_footer_rows' => array(
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
        )
    );
/**********************/

$blog_grid_view = array(
        'name' => __( 'Blog grid-view', 'cosmotheme' ),
        'id' => 'blog_grid_view',
        '_header_rows' => array(
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
        ),
        '_rows' => array(
        	'the_content' => array(
                'id' => 'additional_content',
                'is_additional' => 0,
                'deactivate_row' => 'yes',
                '_elements' => array(
                    '136488479366' => array(
		                'id' => 1364884793662,
		                'element_columns' => 12,
		                'name' => __('Grid-view','cosmotheme'),
		                'label_description' => __('3 columns sorted by date','cosmotheme'),
		                'show_title' => 'yes',
		                'type' => 'latest',
		                'view' => 'grid_view',
		                'enb_masonry' => 'yes',
		                'remove_gutter' => 'no',
		                'list_view_excerpt' => 'excerpt',
		                'numberposts' => 12,
		                'columns' => 3,
		                'list_view_thumb_size' => 'medium_width_thumb',
		                'behaviour' => 'pagination',
		                'orderby' => 'date',
		                'order' => 'desc'
		            )
                )
            ),
        	
        	
            'additional' => array(
                'id' => 'additional',
                'is_additional' => 1,
                'deactivate_row' => 'yes',
                '_elements' => array(
                    'default' => array(
                        'id' => 'default',
                        'behaviour' => 'pagination'
                    )
                )
            )
        ),
        '_footer_rows' => array(
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
        )
    );
/*******************/

$blog_thumb_view = array(
        'name' => __( 'Blog thumb-view', 'cosmotheme' ),
        'id' => 'blog_thumb_view',
        '_header_rows' => array(
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
        ),
        '_rows' => array(
        	'the_content' => array(
                'id' => 'additional_content',
                'is_additional' => 0,
                'deactivate_row' => 'yes',
                '_elements' => array(
                    '136488479366' => array(
		                'id' => 1364884793662,
		                'element_columns' => 12,
		                'name' => __('Thumb-view','cosmotheme'),
		                'label_description' => __('4 columns ordered by date','cosmotheme'),
		                'show_title' => 'yes',
		                'type' => 'latest',
		                'view' => 'grid_view_thumbnails',
		                'enb_masonry' => 'no',
		                'remove_gutter' => 'no',
		                'list_view_excerpt' => 'excerpt',
		                'numberposts' => 12,
		                'columns' => 4,
		                'behaviour' => 'none',
		                'orderby' => 'date',
		                'order' => 'desc'
		            )
                )
            ),
        	
        	
            'additional' => array(
                'id' => 'additional',
                'is_additional' => 1,
                'deactivate_row' => 'yes',
                '_elements' => array(
                    'default' => array(
                        'id' => 'default',
                        'behaviour' => 'pagination'
                    )
                )
            )
        ),
        '_footer_rows' => array(
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
        )
    );
/*************/

$blog_full_thumb = array(
        'name' => __( 'Blog full thumb', 'cosmotheme' ),
        'id' => 'pos2asdasdsadf3',
        '_header_rows' => array(
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
        ),
        '_rows' => array(
        	'the_content' => array(
                'id' => 'additional_content',
                'is_additional' => 0,
                'deactivate_row' => 'yes',
                '_elements' => array(
                    '136488479366' => array(
		                'id' => 1364884793662,
		                'element_columns' => 12,
		                'name' => __('Thumb-view','cosmotheme'),
		                'label_description' => __(' ','cosmotheme'),
		                'show_title' => 'yes',
		                'type' => 'latest',
		                'view' => 'grid_view_thumbnails',
		                'enb_masonry' => 'no',
		                'remove_gutter' => 'yes',
		                'list_view_excerpt' => 'excerpt',
		                'numberposts' => 18,
		                'columns' => 6,
		                'behaviour' => 'none',
		                'orderby' => 'date',
		                'order' => 'desc'
		            )
                )
            ),
        	
        	
            'additional' => array(
                'id' => 'additional',
                'is_additional' => 1,
                'deactivate_row' => 'yes',
                '_elements' => array(
                    'default' => array(
                        'id' => 'default',
                        'behaviour' => 'pagination'
                    )
                )
            )
        ),
        '_footer_rows' => array(
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
        )
    );
?>