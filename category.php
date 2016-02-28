<?php get_header(); ?>


<?php
    $template = 'category';
?>

<section id="main">
    <div class="main-container">    
        <div class="row">
            <div class="twelve columns  cat-title">
                <?php
                    if( have_posts () ){
                        ?><h2 ><span><?php _e( 'Category archives: ' , 'cosmotheme' ); echo get_cat_name( get_query_var('cat') ); ?></span></h2><?php
                    }else{
                        ?><h2 ><span><?php _e( 'Sorry, no posts found' , 'cosmotheme' ); ?></span></h2><?php
                    }
                ?> 
            </div>
        </div>
        <?php
            $layout = new LBSidebarResizer( 'category' );
            $layout -> render_frontend();
        ?>
    </div>
</section>
<?php get_footer(); ?>
