<div class="<?php echo LBRenderable::$words[ $this -> element_columns ];?> columns resizable" data-id="<?php echo $this -> id;?>">
    <input type="hidden" name="<?php echo $this -> get_prefix();?>[id]" value="<?php echo $this -> id;?>" class="element-id">
    <input type="hidden" name="<?php echo $this -> get_prefix();?>[element_columns]" value="<?php echo $this -> element_columns;?>" class="element-columns">
    
    <div class="fl">
        <div class="tools">
            <a class="edit-element has-popup" data-element-id="<?php echo $this -> id;?>" href="javascript:void(0);">
                <div class="popup">
                    <?php echo __( 'Edit content', 'cosmotheme' );?>
                    <div class="maybe-pointer"></div>
                </div>

            </a>
            <?php if( !$this -> row -> is_additional ){ ?>

                <a class="delete-column has-popup" href="javascript:void(0);">
                    <div class="popup">
                        <?php echo __( 'Delete these columns', 'cosmotheme' );?>
                        <div class="maybe-pointer"></div>
                    </div>
                </a>
                <a class="add-element has-popup" href="javascript:void(0);">
                    <div class="popup">
                        <?php echo __( 'Add content', 'cosmotheme' );?>
                        <div class="maybe-pointer"></div>
                    </div>
                </a>
            <?php } ?>
        </div>
        <?php if( $this -> row -> is_additional ){ ?>
            <div class="default-row-hint">
                <h4><?php echo __( 'Default', 'cosmotheme' );?></h4>
                <?php echo __( <<<endhtml
This row loads the default WordPress content for each page. You cannot delete it or split it into several columns.<br />
If assigned for such pages as Author archives or Category it will represent the author's posts or posts belonging to a given category. Feel free to edit it and choose content layout.<br />
If assigned for Pages or Posts - it will represent the page content. Editing it will have no effect.
endhtml
                );?>
            </div>
        <?php } ?>
    </div>

    <div class="display_hint" id="<?php echo $this -> id;?>"><?php echo __( 'Click the <b>edit elements</b> icon to add content', 'cosmotheme' );?></div>
    
    <div class="relative-wrapper">
        <a class="handle has-popup">
            <div class="popup">
                <?php echo __( 'Drag left and right to resize the neighbours', 'cosmotheme' );?>
                <div class="maybe-pointer"></div>
            </div>
        </a>
    </div>

    <div class="element-container">
        <?php
            $this -> print_taxonomy_inputs( 'banners', $this -> banners );
            $this -> print_taxonomy_inputs( 'testimonials', $this -> testimonials );
        ?>
        <!-- shows previous selected sidebar -->
        <div class="select-box sidebars hidden">
            <input type="radio" name="<?php echo $this -> get_prefix();?>[sidebar]" value="<?php echo $this -> sidebar;?>" checked="checked">
        </div>
        <div class="on-overview">
            <div class="element-description"></div>
        </div>
        <div class="on-edit">
            <header>
                <span class="title fpb add_fpb">
                    <a href="javascript:void(0);" class="fpb_icon">&nbsp;</a>
                    <a href="javascript:void(0);" class="fpb_label">
                        <?php echo $this -> name; ?>
                    </a>
                </span>
                <span class="fr">
                    <span class="fpb discard button">
                        <a href="javascript:void(0);" class="fpb_icon">&nbsp;</a>
                        <a href="javascript:void(0);" class="fpb_label">
                            <?php echo __( 'Discard' , 'cosmotheme' );?>
                        </a>
                    </span>
                    <span class="fpb apply button">
                        <a href="javascript:void(0);" class="fpb_icon">&nbsp;</a>
                        <a href="javascript:void(0);" class="fpb_label">
                            <?php echo __( 'Save' , 'cosmotheme' );?>
                        </a>
                    </span>
                </span>
            </header>
            <div class="panel the-settings">
                
                <div class="standard-generic-field generic-field-header">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Choose element type', 'cosmotheme' );?>
                        </label>
                    </div>
                    <div class="generic-field generic-field-image-select element-type">
                        <label>
                            <?php echo __( 'Logo' , 'cosmotheme' );?>
                            <input type="radio" value="logo" name="<?php echo $this -> get_prefix();?>[type]" class="logo-type" <?php checked( $this -> type, 'logo' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Main menu' , 'cosmotheme' );?>
                            <input type="radio" value="menu" name="<?php echo $this -> get_prefix();?>[type]" class="menu-type" <?php checked( $this -> type, 'menu' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Menu with centered logo' , 'cosmotheme' );?>
                            <input type="radio" value="menu_and_logo" name="<?php echo $this -> get_prefix();?>[type]" class="menu-type" <?php checked( $this -> type, 'menu_and_logo' );?>>
                        </label>                        
                        <label>
                            <?php echo __( 'Top menu' , 'cosmotheme' );?>
                            <input type="radio" value="top_menu" name="<?php echo $this -> get_prefix();?>[type]" class="menu-type" <?php checked( $this -> type, 'top_menu' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Breadcrumbs' , 'cosmotheme' );?>
                            <input type="radio" value="breadcrumbs" name="<?php echo $this -> get_prefix();?>[type]" class="breadcrumbs-type" <?php checked( $this -> type, 'breadcrumbs' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Searchbar', 'cosmotheme' );?>
                            <input type="radio" value="searchbar" name="<?php echo $this -> get_prefix();?>[type]" class="searchbar-type" <?php checked( $this -> type, 'searchbar' );?>>
                        </label>
                        <?php 
                            /**
                            * Check if WooCommerce is active
                            **/

                            if ( class_exists( 'WooCommerce' ) ) {
                                global $woocommerce;
                            ?>
                            <label>
                                <?php echo __( 'Login / My Account', 'cosmotheme' );?>
                                <input type="radio" value="login" name="<?php echo $this -> get_prefix();?>[type]" class="login-type" <?php checked( $this -> type, 'login' );?>>
                            </label>                        
                            <label>
                                <?php echo __( 'Dynamic shopping cart', 'cosmotheme' );?>
                                <input type="radio" value="dynamicart" name="<?php echo $this -> get_prefix();?>[type]" class="dynamicart-type" <?php checked( $this -> type, 'dynamicart' );?>>
                            </label>
                       <?php } ?>
                        <label>
                            <?php echo __( 'Banners', 'cosmotheme' );?>
                            <input type="radio" value="banners" name="<?php echo $this -> get_prefix();?>[type]" class="banner-type" <?php checked( $this -> type, 'banners' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Testimonials', 'cosmotheme' );?>
                            <input type="radio" value="testimonials" name="<?php echo $this -> get_prefix();?>[type]" class="testimonial-type" <?php checked( $this -> type, 'testimonials' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Text / Shortcodes' , 'cosmotheme' );?>
                            <input type="radio" value="textelement" name="<?php echo $this -> get_prefix();?>[type]" class="textelement-type" <?php checked( $this -> type, 'textelement' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Social icons' , 'cosmotheme' );?>
                            <input type="radio" value="socialicons" name="<?php echo $this -> get_prefix();?>[type]" class="socialicons-type" <?php checked( $this -> type, 'socialicons' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Widgets' , 'cosmotheme' );?>
                            <input type="radio" value="widget_zone" name="<?php echo $this -> get_prefix();?>[type]" class="widget-type" <?php checked( $this -> type, 'widget_zone' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Delimiter' , 'cosmotheme' );?>
                            <input type="radio" value="delimiter" name="<?php echo $this -> get_prefix();?>[type]" class="delimiter-type" <?php checked( $this -> type, 'delimiter' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Empty' , 'cosmotheme' );?>
                            <input type="radio" value="empty" name="<?php echo $this -> get_prefix();?>[type]" class="empty-type" <?php checked( $this -> type, 'empty' );?>>
                        </label>
                    </div>
                </div>
  
                <div class="standard-generic-field generic-field-header element_type_list hidden"></div>
                
<!--                 <div class="standard-generic-field generic-field-header option-menustyles menu_options">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Styling', 'cosmotheme' );?>
                        </label>
                    </div>

                    <div class="generic-field generic-menustyles generic-field-image-select">
                        <label>
                            <?php echo __( 'Default' , 'cosmotheme' );?>
                            <input type="radio" value="default" name="<?php echo $this -> get_prefix();?>[main_menustyles]" <?php checked( $this -> main_menustyles, 'default' );?>>
                        </label>
                        <label>
                            <?php echo __( 'With description' , 'cosmotheme' );?>
                            <input type="radio" value="with_description" name="<?php echo $this -> get_prefix();?>[main_menustyles]" <?php checked( $this -> main_menustyles, 'with_description' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Vertical' , 'cosmotheme' );?>
                            <input type="radio" value="vertical" name="<?php echo $this -> get_prefix();?>[main_menustyles]" <?php checked( $this -> main_menustyles, 'vertical' );?>>
                        </label>
                    </div>

                </div> -->

                <div class="standard-generic-field generic-field-header option-columns header">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Number of columns', 'cosmotheme' );?>
                        </label>
                    </div>
                    <div class="generic-field generic-field-image-select">
                        <label class="columns-2">
                            <?php echo __( 'One' , 'cosmotheme' );?>
                            <input type="radio" value="1" name="<?php echo $this -> get_prefix();?>[columns]" <?php checked( $this -> columns, 1 );?>>
                        </label>
                        <label class="columns-3">
                            <?php echo __( 'Two' , 'cosmotheme' );?>
                            <input type="radio" value="2" name="<?php echo $this -> get_prefix();?>[columns]" <?php checked( $this -> columns, 2 );?>>
                        </label>
                        <label class="columns-4">
                            <?php echo __( 'Three' , 'cosmotheme' );?>
                            <input type="radio" value="3" name="<?php echo $this -> get_prefix();?>[columns]" <?php checked( $this -> columns, 3 );?>>
                        </label>
                        <label class="columns-6">
                            <?php echo __( 'Four' , 'cosmotheme' );?>
                            <input type="radio" value="4" name="<?php echo $this -> get_prefix();?>[columns]" <?php checked( $this -> columns, 4 );?>>
                        </label>
                        
                    </div>
                </div>
                <div class="standard-generic-field generic-field-header option-numberposts menu_options">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Number of visible menus items', 'cosmotheme' );?>
                        </label>
                    </div>
                    <div class="generic-field">
                        <input name="<?php echo $this -> get_prefix();?>[numberposts]" value="<?php echo $this -> numberposts;?>">
                    </div>
                    <div class="hint"><?php echo __( 'Set the number of visible menu items. Remaining menu items will be shown in the drop down menu item "More"', 'cosmotheme' );?>.</div>
                </div>

                <div class="standard-generic-field generic-field-header option-text">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Enter text you wish to display.', 'cosmotheme' );?>
                        </label>
                    </div>
                    <div class="generic-field">
                        <textarea name="<?php echo $this -> get_prefix();?>[text]"><?php echo $this->text;?></textarea>
                    </div>
                </div>

                <div class="standard-generic-field generic-field-header option-social_hint">
                    <div class="generic-label">
                        <label>
                            <?php 
                                echo  sprintf(__( 'Set %s here %s the social profiles you wish to display' , 'cosmotheme' ), '<a href="?page=cosmothemes__settings&tab=social" target="_blank">','</a>')  ;
                            ?>
                        </label>
                    </div>
                </div>

                <div class="standard-generic-field generic-field-header option-delimiter_hint">
                    <div class="generic-label">
                        <label>
                            <?php 
                                echo  sprintf(__( 'We recommend to use this element only between rows' , 'cosmotheme' )) ;
                            ?>
                        </label>
                    </div>
                    <div class="generic-field generic-field-image-select delimiter-type">
                        <label class="columns-2">
                            <?php echo __( 'White space' , 'cosmotheme' );?>
                            <input type="radio" value="white_space" name="<?php echo $this -> get_prefix();?>[delimiter_type]" <?php checked( $this -> delimiter_type, 'white_space' );?>>
                        </label>
                        <label class="columns-3">
                            <?php echo __( 'Pointed delimiter' , 'cosmotheme' );?>
                            <input type="radio" value="pointed" name="<?php echo $this -> get_prefix();?>[delimiter_type]" <?php checked( $this -> delimiter_type, 'pointed' );?>>
                        </label>
                        <label class="columns-3">
                            <?php echo __( 'Doublepointed delimiter' , 'cosmotheme' );?>
                            <input type="radio" value="doublepointed" name="<?php echo $this -> get_prefix();?>[delimiter_type]" <?php checked( $this -> delimiter_type, 'doublepointed' );?>>
                        </label>
                        <label class="columns-3">
                            <?php echo __( 'Line delimiter' , 'cosmotheme' );?>
                            <input type="radio" value="line" name="<?php echo $this -> get_prefix();?>[delimiter_type]" <?php checked( $this -> delimiter_type, 'line' );?>>
                        </label>
                        <label class="columns-3">
                            <?php echo __( 'Doubleline delimiter' , 'cosmotheme' );?>
                            <input type="radio" value="doubleline" name="<?php echo $this -> get_prefix();?>[delimiter_type]" <?php checked( $this -> delimiter_type, 'doubleline' );?>>
                        </label>
                    </div>
                    <div class="generic-label">
                        <label>
                            <?php 
                                echo  sprintf(__( 'Select margin distance for this delimiter' , 'cosmotheme' ))  ;
                            ?>
                        </label>
                    </div>                     
                    <div class="generic-field generic-field-image-select">
                        <label class="columns-2">
                            <?php echo __( '15px' , 'cosmotheme' );?>
                            <input type="radio" value="margin_15px" name="<?php echo $this -> get_prefix();?>[delimiter_margin]" <?php checked( $this -> delimiter_margin, 'margin_15px' );?>>
                        </label>
                        <label class="columns-3">
                            <?php echo __( '30px' , 'cosmotheme' );?>
                            <input type="radio" value="margin_30px" name="<?php echo $this -> get_prefix();?>[delimiter_margin]" <?php checked( $this -> delimiter_margin, 'margin_30px' );?>>
                        </label>
                        <label class="columns-3">
                            <?php echo __( '60px' , 'cosmotheme' );?>
                            <input type="radio" value="margin_60px" name="<?php echo $this -> get_prefix();?>[delimiter_margin]" <?php checked( $this -> delimiter_margin, 'margin_60px' );?>>
                        </label>
                    </div>
                    <div class="clear"></div>

                    <div class="delimiter_color">
                        <div class="generic-label">
                            <label>
                                <?php 
                                    echo  sprintf(__( 'Select color for this delimiter' , 'cosmotheme' ))  ;
                                ?>
                            </label>
                        </div>                      
                        <div class="generic-field delimiter_color_picker">
                            <input type="text" name="<?php echo $this->get_prefix();?>[delimiter_text_color]" value="<?php echo $this->delimiter_text_color;?>" class="my-color-field" />
                        </div>
                    </div>

                </div>
                <div class="standard-generic-field generic-field-header option-empty_hint">
                    <div class="generic-label">
                        <label>
                            <?php 
                                echo  sprintf(__( 'Use this element if you need to have empty columns' , 'cosmotheme' )) ;
                            ?>
                        </label>
                    </div>
                </div> 

                
                <!-- BOF text align OPTIONS -->
                <div class="standard-generic-field generic-field-header  text_align_options">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Text align', 'cosmotheme' );?>
                        </label>
                    </div>
                    
                    <div class="generic-field generic-field-image-select">
                        <label>
                            <?php echo __( 'Left' , 'cosmotheme' );?>
                            <input class="align_left" type="radio" value="left" name="<?php echo $this -> get_prefix();?>[text_align]" <?php checked( $this -> text_align, 'left' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Center' , 'cosmotheme' );?>
                            <input class="align_center" type="radio" value="center" name="<?php echo $this -> get_prefix();?>[text_align]" <?php checked( $this -> text_align, 'center' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Right' , 'cosmotheme' );?>
                            <input class="align_right" type="radio" value="right" name="<?php echo $this -> get_prefix();?>[text_align]" <?php checked( $this -> text_align, 'right' );?>>
                        </label>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Vertical align', 'cosmotheme' );?>
                        </label>
                    </div>
                    
                    <div class="generic-field generic-field-image-select">
                        <label>
                            <?php echo __( 'Top' , 'cosmotheme' );?>
                            <input class="align_top" type="radio" value="top" name="<?php echo $this -> get_prefix();?>[vertical_align]" <?php checked( $this -> vertical_align, 'top' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Middle' , 'cosmotheme' );?>
                            <input class="align_middle" type="radio" value="middle" name="<?php echo $this -> get_prefix();?>[vertical_align]" <?php checked( $this -> vertical_align, 'middle' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Bottom' , 'cosmotheme' );?>
                            <input class="align_bottom" type="radio" value="bottom" name="<?php echo $this -> get_prefix();?>[vertical_align]" <?php checked( $this -> vertical_align, 'bottom' );?>>
                        </label>
                    </div>                     
                </div>
                <!-- EOF text align OPTIONS -->

                <!-- BOF login / my-account OPTIONS -->
                <?php
                // if woocommerce is enabled
                if ( class_exists( 'WooCommerce' ) ) {
                ?>
                <div class="standard-generic-field generic-field-header option-login-label login_options">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Sign In label', 'cosmotheme' );?>
                        </label>
                    </div>
                    <div class="generic-field">
                        <input name="<?php echo $this -> get_prefix();?>[login_label]" value="<?php echo $this -> login_label;?>">
                    </div>
                    <div class="hint"><?php echo __( 'Set the User "Sign In" menu label', 'cosmotheme' );?>.</div>
                </div>

                <div class="standard-generic-field generic-field-header option-login-label login_options">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Register label', 'cosmotheme' );?>
                        </label>
                    </div>
                    <div class="generic-field">
                        <input name="<?php echo $this -> get_prefix();?>[register_label]" value="<?php echo $this -> register_label;?>">
                    </div>
                    <div class="hint"><?php echo __( 'Set the User "Registration" menu label', 'cosmotheme' );?>.</div>
                </div>

                <div class="standard-generic-field generic-field-header option-login-label login_options">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'My Account label', 'cosmotheme' );?>
                        </label>
                    </div>
                    <div class="generic-field">
                        <input name="<?php echo $this -> get_prefix();?>[my_account_label]" value="<?php echo $this -> my_account_label;?>">
                    </div>
                    <div class="hint"><?php echo __( 'Set "My Account" menu label', 'cosmotheme' );?>.</div>
                </div>

                <!-- EOF login / my-account OPTIONS -->
                <?php
                    }
                ?>
                <!-- BOF testimonial OPTIONS -->
                <div class="standard-generic-field generic-field-header testimonial_options">
                    <div class="generic-label">
                        <label>
                            <?php echo __( 'Display testimonial as:', 'cosmotheme' );?>
                        </label>
                    </div>
                    
                    <div class="generic-field generic-field-image-select">
                        <label>
                            <?php echo __( 'List' , 'cosmotheme' );?>
                            <input class="testimonials_list" type="radio" value="list" name="<?php echo $this -> get_prefix();?>[testimonial_options]" <?php checked( $this -> testimonial_options, 'list' );?>>
                        </label>
                        <label>
                            <?php echo __( 'Slide' , 'cosmotheme' );?>
                            <input class="testimonials_slide" type="radio" value="slide" name="<?php echo $this -> get_prefix();?>[testimonial_options]" <?php checked( $this -> testimonial_options, 'slide' );?>>
                        </label>
                    </div>
                    <div class="clear"></div>                 
                </div>
                <!-- EOF testimonial OPTIONS -->

            </div>
        </div>
    </div>
</div>