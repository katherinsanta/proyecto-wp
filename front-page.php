<?php
    get_header();
    global $gallery_container_class, $the_gallery_id;

?>
<?php if ( get_posts_gallery_type($the_gallery_id) == 'sly'){
    ?>
        <?php 
$mobile_collapse_button = options::get_value( 'styling' , 'mobile_collapse_button' );
if( $mobile_collapse_button == 'no'){
    ?>
<div class="header-collapser icon-top animated"></div>
<?php 
}
?>
<?php } ?>
<section id="main" class="<?php echo get_posts_gallery_type($the_gallery_id); ?>">
    <div class="main-container <?php if ( get_post_type($the_gallery_id) == 'gallery' && post_password_required($the_gallery_id) ){ echo 'protected-gallery'; } ?> <?php echo $gallery_container_class; ?>">
    <?php
        function do_nothing( $sender ){}
        $layout = new LBSidebarResizer( 'front_page' );
        $layout -> render_frontend( 'do_nothing' );
    ?>
    </div>
</section>
<?php get_footer(); ?>