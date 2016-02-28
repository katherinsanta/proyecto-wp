<?php get_header(); ?>
<?php
    $template = 'author';
    global $wp_query;
    $curauth = $wp_query->get_queried_object();

    $author_id = $curauth->ID;
    $author_info = get_userdata($author_id);
?>
<section id="main">
    <div class="main-container">
        <div class="row">
            <div class="twelve columns cat-title">
                <?php
                    add_filter( 'pre_get_posts', 'namespace_add_custom_types' ); /*add filter that will show all post types on author pages*/

                    
                ?>
                        <h2 >
                            <span>
                            <?php 
                                _e( 'Author archives: ' , 'cosmotheme' );  
                                echo $author_info -> display_name;
                            ?>
                            </span>
                        </h2>
                <?php
                    
                ?> 
            </div>
        </div>
        <?php
            

            $layout = new LBSidebarResizer( 'author' );
            $layout -> render_frontend();

            remove_filter( 'pre_get_posts', 'namespace_add_custom_types' ); /*remove filter that will show all post types on author pages*/
        ?>
    </div>
</section>
<?php get_footer(); ?>