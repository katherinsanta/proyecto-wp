<?php

get_template_part( '/lib/templates/additional_templates' );
//C:\wamp\www\wp\wp-content\themes\tripod\lib\templates\additional_templates.php

update_option( 'templates', array(
    'mainpage123' => array(
        'name' => __( 'Mainpage', 'cosmotheme' ),
        'id' => 'mainpage123',
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
            'latest' => array(
                'id' => 'default1',
                'is_additional' => 0,
                '_elements' => array(
                    'latest' => array(
                        'id' => 'latest',
                        'name' => __('Thumbnails view sample','cosmotheme'),
                        'type' => 'latest',
                        'view' => 'grid_view_thumbnails',
                        'numberposts' => 12,
                        'enb_masonry' => 'yes',
                        'behaviour' => 'load_more'
                    )
                )
            ),
            'additional' => array(
                'id' => 'additional',
                'is_additional' => 1,
                '_elements' => array(
                    'default' => array(
                        'id' => 'default'
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
    ),

    'default123' => array(
        'name' => __( 'Default', 'cosmotheme' ),
        'id' => 'default123',
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
            'additional' => array(
                'id' => 'additional',
                'is_additional' => 1,
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
           
    ),

    'posts123' => array(
        'name' => __( 'Posts', 'cosmotheme' ),
        'id' => 'posts123',
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
            'additional' => array(
                'id' => 'additional',
                'is_additional' => 1,
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
    ),

    /*additional templates*/
    'galleries_list' => $galleries_list,
    'galleries' => $galleries,
    'blog_large_list' => $blog_large_list,
    'blog_medium_list' => $blog_medium_list,
    'blog_grid_view' => $blog_grid_view,
    'blog_thumb_view' => $blog_thumb_view,
    'blog_full_thumb' => $blog_full_thumb
));

update_option( 'front_page_layout', array(
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
        'template' => 'mainpage123'
    )
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

update_option('archive_layout', $archive_layout);
update_option('archive_format_layout', $archive_layout);
update_option('archive_post_type_layout', $archive_layout);
update_option('author_layout', $archive_layout);
update_option('category_layout', $archive_layout);
update_option('index_layout', $archive_layout);
update_option('gallery_category_layout', $archive_layout);
update_option('gallery_tag_layout', $archive_layout);
update_option('tag_layout', $archive_layout);
update_option('search_layout', $archive_layout);
update_option('404_layout', $archive_layout);
update_option('attachment_layout', $archive_layout);



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


update_option('single_layout', $posts_layout);
update_option('page_layout', $posts_layout);
//update_option('gallery_layout', $posts_layout);
/*Fix for cache ------------------- */
$builder = new LBTemplateBuilder();
$builder->load_all();
