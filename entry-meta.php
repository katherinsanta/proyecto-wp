<ul class="meta-details-list">
    <li class="meta-details-author"><i class="icon-author"></i> <?php echo sprintf(__('%s','cosmotheme'),'<a href="'.get_author_posts_url($post->post_author).'">'.get_the_author_meta('display_name', $post->post_author).'</a>')?></li>    
    <li class="meta-details-date"><i class="icon-date"></i> <?php echo post::get_post_date($post -> ID); ?>  </li>

    <?php
    global $post_id;
    if (comments_open($post_id)) {
        if (options::logic('general', 'fb_comments')) {
            ?>
                    <li class="meta-details-comments">
                        <i class="icon-omments"></i>
                        <a href="<?php echo get_comments_link($post_id); ?>" >
                            <span class="comments">
                                <fb:comments-count href="<?php echo get_permalink($post_id) ?>"></fb:comments-count>
                                <?php _e('Comments','cosmotheme'); ?>
                            </span>
                        </a>
                    </li>
            <?php
        } else {
            if(get_comments_number($post_id) == 1){
                $comments_label = __('reply','cosmotheme');    
            }
            ?>
                <li class="meta-details-comments">
                    <a href="<?php echo get_comments_link($post_id); ?>" >
                        <i class="icon-comments"></i>
                        <span class="comments">
                            <?php echo get_comments_number($post_id) ?>
                            <?php _e('Comments','cosmotheme'); ?>
                        </span>
                    </a>
                </li>    
            <?php
            }
        }
    ?>

    <?php
        if ( function_exists( 'stats_get_csv' ) ){  
        $views = stats_get_csv( 'postviews' , "&post_id=" . $post_id, "&days=-1");  
    ?>
    <li class="meta-details-views">
        <a href="<?php echo get_permalink($post_id); ?>" >
            <i class="icon-views"></i>
            <?php echo (int)$views[0]['views']; ?>
            <?php _e('Views','cosmotheme'); ?>
        </a>
    </li>
    <?php } ?>
    <?php if(strlen(trim($the_categories))){ ?>
    <li class="meta-category">
        <i class="icon-category"></i>
        <ul class="meta-category-list">
            <?php echo $the_categories; ?>
        </ul>
    </li>
    <?php }?> 

    <?php   
        $tags = wp_get_post_terms($post->ID, 'gallery-tag');

        if (!empty($tags) && get_post_type( $post -> ID ) == 'gallery') { ?>
            <li class="meta-tags">
                <i class="icon-tag"></i>
                <ul  class="meta-tag-list">
                    <?php
                        foreach ($tags as $tag) {
                          //  $t = get_tag($tag);
                            echo '<li><a href="' . get_tag_link($tag) . '" rel="tag" class="tag">' . $tag->name . '</a></li> ';
                        }
                    ?>
                </ul>
            </li>
    <?php }?>     
</ul>
