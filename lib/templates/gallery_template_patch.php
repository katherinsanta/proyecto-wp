<?php
	$gallery_template = array(
        'name' => __( 'Galleries', 'cosmotheme' ),
        'id' => 'gallery_layout',
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
            
            'copyright' => array(
                'id' => 'copyright',
                'row_width' => 'full_width_yes',
                'row_content_width' => 'full_width_content_yes',
                'row_bottom_margin_removed' => 'yes',
                '_elements' => array(
                    'copyright' => array(
                        'id' => 'copyright',
                        'type' => 'copyright',
                        'element_columns' => 6
                    )
                )
            )
        )
    );

	$all_templates = get_option( 'templates' );

	$all_templates['gallery_layout'] = $gallery_template;

	update_option( 'templates', $all_templates );


	$gallery_layout = array(
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
	            'columns' => 12,
	            'disabled' => false
	        )
	    ),
	    'template' => 'gallery_layout'
	);


	update_option('gallery_layout', $gallery_layout);
	
?>