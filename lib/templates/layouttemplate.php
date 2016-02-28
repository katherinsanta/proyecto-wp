<div class="template" id="template_<?php echo $this -> id;?>" style="display: none;" data-id="<?php echo $this -> id;?>">
    <input class="copy" name="copy" type="button" onClick="copy1(template_<?php echo $this -> id;?>, '<?php echo $this -> id;?>','<?php echo $this -> name;?>'); " value="Copy Template" />
    <input class= "paste hidden" name="paste" type="button" onClick="paste1(template_<?php echo $this -> id;?>, '<?php echo $this -> id;?>'); " value="Paste Template" />
    <div class="title has-hidden-input">
        <h2 class="dbl-clickable-text"><span class="text" title="<?php echo __( 'Double-click this text to edit the title', 'cosmotheme' );?>"><?php echo $this -> name;?></span><span class="hint"><?php echo __( 'Double-click this text to edit the title', 'cosmotheme' );?></span></h2>
        <input class="hidden-input hidden" name="<?php echo $this -> get_prefix();?>[name]" value="<?php echo $this -> name;?>">
    </div>
    <div class="template-description">
        <div class="align-left">
            <?php echo __( "This page lets you create custom templates and assign them for your site's sections (posts, categories, tags list, archive, etc).", 'cosmotheme' );?><br>
            <?php echo __( "First, create and customize your template, save settings, then finally go to", 'cosmotheme' );?>
            <a href="?page=cosmothemes__layouts"><?php echo __( 'Layouts', 'cosmotheme' );?></a>
            <?php echo __( 'and select from the list the newly created template.', 'cosmotheme' );?>
        </div>
    </div>
    <input type="hidden" name="<?php echo $this -> get_prefix();?>[id]" value="<?php echo $this -> id;?>">
    <header class="region">
        <div class="region-inside">
            <div class="region-header">
                <span><?php echo __( 'Header', 'cosmotheme' );?></span>
                <!-- <a class="edit-header edit-element has-popup">
                    <div class="popup">
                        <?php echo __( 'Customize the header', 'cosmotheme' );?>
                        <div class="maybe-pointer"></div>
                    </div>
                </a> -->
<!--                 <a class="edit-header edit-header-slideshow edit-element has-popup">
                    <div class="popup">
                        <?php echo __( 'Click to select the slideshow', 'cosmotheme' );?>
                        <div class="maybe-pointer"></div>
                    </div>
                </a>
                <?php echo __( '( Slideshow settings )', 'cosmotheme' );?>    -->             
            </div>
            <div class="element-container">
                <div class="on-edit">
                    <header>
                        <span class="title fpb add_fpb">
                            <a href="javascript:void(0);" class="fpb_icon">&nbsp;</a>
                            <a href="javascript:void(0);" class="fpb_label">
                                <?php echo __( 'New element', 'cosmotheme' );?>
                            </a>
                        </span>
                        <span class="fr">
                            <span class="fpb discard button">
                                <a href="javascript:void(0);" class="fpb_icon">&nbsp;</a>
                                <a href="javascript:void(0);" class="fpb_label">
                                    <?php echo __( 'Discard', 'cosmotheme' );?>
                                </a>
                            </span>
                            <span class="fpb apply button">
                                <a href="javascript:void(0);" class="fpb_icon">&nbsp;</a>
                                <a href="javascript:void(0);" class="fpb_label">
                                    <?php echo __( 'Save', 'cosmotheme' );?>
                                </a>
                            </span>
                        </span>
                    </header> 
                    <div class="panel the-settings generic-field">
                        <!--YOU ADD HEADER SETTING HERE. DON'T FORGET TO SET A DEFAULT IN LBTemplate::__construct OR YOURE GONNA GET A NOTICE-->
                        
<!--                         <div class="header_slideshow_settings">
                            <div class="generic-label">
                                <label><?php _e('Enable slideshow','cosmotheme'); ?></label>
                            </div>

                            <div class="generic-field generic-field-image-select enable_slideshow">
                                <label>
                                    <?php echo __( 'Yes' , 'cosmotheme' );?>
                                    <input type="radio" value="yes" name="<?php echo $this -> get_prefix();?>[enable_slideshow]" <?php checked( $this -> enable_slideshow, 'yes' );?>>
                                </label>
                                <label>
                                    <?php echo __( 'No' , 'cosmotheme' );?>
                                    <input type="radio" value="no" name="<?php echo $this -> get_prefix();?>[enable_slideshow]" <?php checked( $this -> enable_slideshow, 'no' );?>>
                                </label>
                                <div class="clear"></div>
                            </div>
                            <div class="slideshow_options">
                                <div class="slideshow_list">
                                    <div class="generic-label">
                                        <label><?php _e('Select slideshow','cosmotheme'); ?></label>
                                    </div>

                                    <div class="generic-field generic-field-image-select">
                                        <?php $this -> slideshows_list($this -> get_prefix(), $this -> slideshowID ); ?>
                                    </div>
                                    <div class="clear"></div>
                                </div>

                                <div class="generic-label">
                                    <label><?php _e('Slideshow type','cosmotheme'); ?></label>
                                </div> 
                               
                                <div class="generic-field generic-field-image-select slideshow_type">
                                    <label>
                                        <?php echo __( 'Cropped' , 'cosmotheme' );?>
                                        <input type="radio" value="limited" name="<?php echo $this -> get_prefix();?>[slideshow_type]" <?php checked( $this -> slideshow_type, 'limited' );?>>
                                    </label>
                                    <label>
                                        <?php echo __( 'Fullwidth' , 'cosmotheme' );?>
                                        <input type="radio" value="fullwidth" name="<?php echo $this -> get_prefix();?>[slideshow_type]" <?php checked( $this -> slideshow_type, 'fullwidth' );?>>
                                    </label>
                                    <div class="clear"></div>
                                    <div class="hint"><?php echo __('Cropped version will resize uploaded images to 1300x775 , Fullwidth option will add "fixed" attribute.', 'cosmotheme') ?></div>
                                    <div class="clear"></div>
                                </div>

                                <div class="generic-label">
                                    <label><?php _e('Enable slideshow autoplay','cosmotheme'); ?></label>
                                </div> 
                               
                                <div class="generic-field generic-field-image-select slideshow_autoplay">
                                    <label>
                                        <?php echo __( 'Yes' , 'cosmotheme' );?>
                                        <input type="radio" value="yes" name="<?php echo $this -> get_prefix();?>[slideshow_autoplay]" <?php checked( $this -> slideshow_autoplay, 'yes' );?>>
                                    </label>
                                    <label>
                                        <?php echo __( 'No' , 'cosmotheme' );?>
                                        <input type="radio" value="no" name="<?php echo $this -> get_prefix();?>[slideshow_autoplay]" <?php checked( $this -> slideshow_autoplay, 'no' );?>>
                                    </label>
                                    <div class="clear"></div>
                                </div>

                                <div class="standard-generic-field generic-field-header slide_speed">
                                    <div class="generic-label">
                                        <label>
                                            <?php echo __( 'Slide speed', 'cosmotheme' );?>
                                        </label>
                                        <div class="generic-field">
                                            <input name="<?php echo $this -> get_prefix();?>[slide_speed]" value="<?php echo $this -> slide_speed;?>" class="digit">
                                            <?php echo __( 'Seconds', 'cosmotheme' );?>
                                        </div>
                                        <div class="hint"><?php echo __( 'Choose a number between 1 and 9', 'cosmotheme' );?></div>
                                    </div>
                                </div>
                                <div class="standard-generic-field generic-field-header transition_speed">
                                    <div class="generic-label">
                                        <label>
                                            <?php echo __( 'Transition speed', 'cosmotheme' );?>
                                        </label>
                                        <div class="generic-field">
                                            <input name="<?php echo $this -> get_prefix();?>[transition_speed]" value="<?php echo $this -> transition_speed;?>" class="digit">
                                            <?php echo __( 'Seconds', 'cosmotheme' );?>
                                        </div>
                                        <div class="hint"><?php echo __( 'Choose a number between 1 and 9', 'cosmotheme' );?></div>
                                    </div>
                                </div>
                            </div>
                        </div> -->                       
                    </div>

                    
                </div>
            </div>
            <div class="add-sort">
                <?php
                foreach( $this -> header_rows as $row ){
                    $row -> render_backend();
                }
                ?>
            </div>
            <span class="add-row-button button">
                <a class="add-row has-popup">
                    <div class="popup">
                        <?php echo __( 'Add row to header', 'cosmotheme' );?>
                        <div class="maybe-pointer"></div>
                    </div>
                </a>
            </span>
        </div>
    </header>
    <div class="region">
        <div class="region-inside">
            <div class="region-header">
                <span><?php echo __( 'Content', 'cosmotheme' );?></span>
            </div>
            <div class="add-sort">
                <?php
                    foreach( $this -> rows as $row ){
                        $row -> render_backend();
                    }
                ?>
            </div>
            <span class="add-row-button button">
                <a class="add-row has-popup">
                    <div class="popup">
                        <?php echo __( 'Add row to content', 'cosmotheme' );?>
                        <div class="maybe-pointer"></div>
                    </div>
                </a>
            </span>
        </div>
    </div>
    <footer class="region">
        <div class="region-inside">
            <div class="region-header">
                <span><?php echo __( 'Footer', 'cosmotheme' );?></span>
            </div>
            <div class="add-sort">
                <?php
                foreach( $this -> footer_rows as $row ){
                    $row -> render_backend();
                }
                ?>
            </div>
            <span class="add-row-button button">
                <a class="add-row has-popup">
                    <div class="popup">
                        <?php echo __( 'Add row to footer', 'cosmotheme' );?>
                        <div class="maybe-pointer"></div>
                    </div>
                </a>
            </span>
        </div>
    </footer>
</div>
