<?php
	// attched images management
	
function cosmo_meta_boxes() {
	global $post;

	// add meta box that will hold attached images
	add_meta_box( 'lala-post-images', __( 'Attached Images', 'cosmotheme' ), 'cosmo_product_images_box', 'gallery', 'normal' );

}

add_action( 'add_meta_boxes', 'cosmo_meta_boxes' );	

	/**
 * Product Images
 *
 * Function for displaying the product images meta box.
 *
 */


/**
 * Display the product images meta box.
 *
 * @access public
 * @return void
 */
function cosmo_product_images_box() {
	global $post;
	?>
	<div id="post_images_container">
		<ul class="product_images">
			<?php
			
				
				$product_image_gallery_meta = get_post_meta( $post->ID, '_post_image_gallery', true ); 
				if(strlen($product_image_gallery_meta) && 'Array' != $product_image_gallery_meta){

					$product_image_gallery = $product_image_gallery_meta;

					$attachments = array_filter( explode( ',', $product_image_gallery ) );	
				} else if ( metadata_exists( 'post', $post->ID, 'imagesattached' ) ) {
					// Backwards compat
					$product_image_gallery = get_post_meta( $post->ID, 'imagesattached', true );
					if(isset($product_image_gallery['img_ids']) ){
						$attachments = array_filter( explode( ',', $product_image_gallery['img_ids'] ) );
					}
				}
				

				if(!isset($attachments)){ // if no meta is attached to the post then the gallery wil be created from attached images // Backwards compatibily with even older version
	                $attached_images = get_children(array('post_parent' => $post->ID,
	                        'post_status' => 'inherit',
	                        'post_type' => 'attachment',
	                        'post_mime_type' => 'image',
	                        'order' => 'ASC',
	                        'orderby' => 'menu_order ID'));    

	                foreach ($attached_images as $key => $value) {
	                	$attachments[] = $key;
	                	$product_image_gallery = implode(",", $attachments); // transform the array into a string that will be used as value for the hidden input
	                }
	                
	            }
	            
				if ( isset( $attachments ) )
					foreach ( $attachments as $attachment_id ) {
						$custom_fields = get_post_custom($attachment_id);
						
						$video_tag = "";
						 if (isset($custom_fields['video_link']) && !empty($custom_fields['video_link'][0]) ) {
						 	//deb::e($custom_fields['video_link']) ;
						 	$video_tag = "video-image";
						 }

						 if (isset($custom_fields['custom_link']) && !empty($custom_fields['custom_link'][0]) ) {
						 	//deb::e($custom_fields['video_link']) ;
						 	$video_tag = "link-image";
						 }
						

						echo '<li class="image '. $video_tag .'" data-attachment_id="' . $attachment_id . '">
							' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '
							<ul class="actions">
								<li><a href="#" class=" icon-delete" title="' . __( 'Delete image', 'cosmotheme' ) . '"></a></li>
								<li><a href="#" class=" icon-video" title="' . __( 'Video', 'cosmotheme' ) . '"></a></li>
								<li class="image-link"><a href="#" class=" icon-link" title="' . __( 'link', 'cosmotheme' ) . '"></a></li>
							</ul>
						</li>';
					}


				if(!isset($product_image_gallery)){
					$product_image_gallery = '';
				}
			?>
		</ul>

		<input type="hidden" id="product_image_gallery" name="product_image_gallery" value="<?php echo esc_attr( $product_image_gallery ); ?>" />

	</div>
	<p class="add_product_images hide-if-no-js">
		<a href="#"><?php _e( 'Add gallery images', 'cosmotheme' ); ?></a>
	</p>
	<p class="add_product_video hide-if-no-js">
		<a href="#"><?php _e( 'Add video to gallery', 'cosmotheme' ); ?></a>
	</p>


	<script type="text/javascript">
		jQuery(document).ready(function($){

			// Uploading files
			var product_gallery_frame;
			var $image_gallery_ids = $('#product_image_gallery');
			var $product_images = $('#post_images_container ul.product_images');

			jQuery('.add_product_images').on( 'click', 'a', function( event ) {

				var $el = $(this);
				var attachment_ids = $image_gallery_ids.val();

				event.preventDefault();

				// If the media frame already exists, reopen it.
				if ( product_gallery_frame ) {
					product_gallery_frame.open();
					return;
				}

				// Create the media frame.
				product_gallery_frame = wp.media.frames.downloadable_file = wp.media({
					// Set the title of the modal.
					title: '<?php _e( 'Add Images to Gallery', 'cosmotheme' ); ?>',
					button: {
						text: '<?php _e( 'Add to gallery', 'cosmotheme' ); ?>',
					},
					multiple: true
				});

				// When an image is selected, run a callback.
				product_gallery_frame.on( 'select', function() {
					
					var selection = product_gallery_frame.state().get('selection');

					selection.map( function( attachment ) {

						attachment = attachment.toJSON();

						if ( attachment.id ) {
							attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;

							$product_images.append('\
								<li class="image" data-attachment_id="' + attachment.id + '">\
									<img src="' + attachment.url + '" />\
									<ul class="actions">\
										<li><a href="#" class=" icon-delete" title="<?php _e( 'Delete image', 'cosmotheme' ); ?>"><?php //_e( 'Delete', 'cosmotheme' ); ?></a></li>\
										<li><a href="#" class=" icon-video" title="<?php _e( 'Video', 'cosmotheme' ); ?>"><?php //_e( 'Video', 'cosmotheme' ); ?></a></li>\
										<li class="image-link"><a href="#" class=" icon-link" title="<?php _e( 'Custom URL', 'cosmotheme' ); ?>"><?php //_e( 'Custom URL', 'cosmotheme' ); ?></a></li>\
									</ul>\
								</li>');
						}

					} );

					$image_gallery_ids.val( attachment_ids );
				});

				// Finally, open the modal.
				product_gallery_frame.open();
			});

			// Image ordering
			$product_images.sortable({
				items: 'li.image',
				cursor: 'move',
				scrollSensitivity:40,
				forcePlaceholderSize: true,
				forceHelperSize: false,
				helper: 'clone',
				opacity: 0.65,
				placeholder: 'wc-metabox-sortable-placeholder',
				start:function(event,ui){
					ui.item.css('background-color','#f6f6f6');
				},
				stop:function(event,ui){
					ui.item.removeAttr('style');
				},
				update: function(event, ui) {
					var attachment_ids = '';

					$('#post_images_container ul li.image').css('cursor','default').each(function() {
						var attachment_id = jQuery(this).attr( 'data-attachment_id' );
						attachment_ids = attachment_ids + attachment_id + ',';
					});

					$image_gallery_ids.val( attachment_ids );
				}
			});

			// Remove images
			$('#post_images_container').on( 'click', 'a.icon-delete', function(event) {

				$(this).closest('li.image').remove();

				var attachment_ids = '';

				$('#post_images_container ul li.image').css('cursor','default').each(function() {
					var attachment_id = jQuery(this).attr( 'data-attachment_id' );
					attachment_ids = attachment_ids + attachment_id + ',';
				});

				$image_gallery_ids.val( attachment_ids );

				return false;
			} );

			// add video links to image meta
			$('#post_images_container').on( 'click', 'a.icon-video', function(event) {
				event.preventDefault();


				var image_id = $(this).closest('li.image').attr('data-attachment_id');
				//console.log(image_id);

				var video_link;
				//checking the previous links
				var data = {
						action: 'retrieve_video_link',
						postid: image_id
					};

					$.post(ajaxurl, data, function(response) {
						//console.log(response);

						var videoprompt = {
							state0: {
								title: 'Add video',
								html:'<label>Please add the video link or the iframe/object code: <input type="text" name="clink" value="'+response+'"></label><br />',

								buttons: { Done: 1 },
								focus: 1,
								submit:function(e,v,m,f){ 
									//console.log(f);
									
										if (true){

											var data = {
												action: 'video_link',
												link: f.clink, 
												postid: image_id
											};

											$.post(ajaxurl, data, function(response) {
												//console.log(response);
												//console.log(f.clink);
												if ( f.clink && f.clink.length) {
													$( "li[data-attachment_id='" + response + "']" ).addClass('video-image');
												} else {
													$( "li[data-attachment_id='" + response + "']" ).removeClass('video-image');
												}

											});
									    }

									e.preventDefault();
									if(v==1) $.prompt.close();
								}
							},
						};
						$.prompt(videoprompt);


					});


				return false;
			} );

			// add custom links to image meta
			$('#post_images_container').on( 'click', 'a.icon-link', function(event) {
				event.preventDefault();

				var image_id = $(this).closest('li.image').attr('data-attachment_id');
				//console.log(image_id);

				var custom_link;
				//checking the previous links
				var data = {
						action: 'retrieve_custom_link',
						postid: image_id,
						dataType: "json"
					};

					$.post(ajaxurl, data, function(response) {
						//console.log(response.custom_link);
						if (response.newtab == 'yes') {
							var check = 'checked';
						} else {
							var check = '';
						}


						var custompromp = {
							state0: {
								title: 'Custom link for the image',
								html:'<label>Custom Link. Add the full link, with http:// <input type="text" name="clink" value="'+response.custom_link+'"></label><br />'+
								     '<label>Open link in a new tab <input type="checkbox" name="newtab" '+check+' value="yes"></label><br />',
								buttons: { Done: 1 },
								focus: 1,
								submit:function(e,v,m,f){ 
									//console.log(f);

									if (f.newtab == 'yes') {
										var tab = 'yes';
									} else {
										var tab = 'no';
									}

										var data = {
											action: 'custom_link',
											link: f.clink, 
											postid: image_id,
											newtab: tab
										};

										$.post(ajaxurl, data, function(response) {
											//console.log(response);
											if (response !== 'error' && f.clink && f.clink.length > 0) {
												$( "li[data-attachment_id='" + response + "']" ).addClass('link-image');
											} else {
												$( "li[data-attachment_id='" + response + "']" ).removeClass('link-image');
											}

										});

									e.preventDefault();
									if(v==1) $.prompt.close();
								}
							},
						};
						$.prompt(custompromp);

					});


				return false;
			} );



			/*
			* ADD VIDEO USING THE LINK, with automatic image adding
			*/

			jQuery('.add_product_video').on( 'click', 'a', function( event ) {
				event.preventDefault();

				var videoprompt = {
					state0: {
						title: 'Add video',
						html:'<label>Please add the video link or the iframe/object code: <input type="text" name="clink" value=""></label><br />',

						buttons: { Done: 1 },
						focus: 1,
						submit:function(e,v,m,f){ 
							//console.log(f);

							if (true){
								
								var data = {
									action: 'video_link_image',
									link: f.clink, 
								};

								$.post(ajaxurl, data, function(response) {
									//console.log(response);
									var attachment = response;

									//console.log(attachment[0]);

									if ( attachment[0] ) {

										var $image_gallery_ids = $('#product_image_gallery');
										var attachment_ids = $image_gallery_ids.val();

										attachment_ids = attachment_ids ? attachment_ids + "," + attachment[0] : attachment[0];

										$image_gallery_ids.val( attachment_ids );

										var $product_images = $('#post_images_container ul.product_images');

											$product_images.append('\
												<li class="image video-image" data-attachment_id="' + attachment[0] + '">\
													<img src="' + attachment[1] + '" />\
													<ul class="actions">\
														<li><a href="#" class=" icon-delete" title="<?php _e( 'Delete image', 'cosmotheme' ); ?>"><?php //_e( 'Delete', 'cosmotheme' ); ?></a></li>\
														<li><a href="#" class=" icon-video" title="<?php _e( 'Video', 'cosmotheme' ); ?>"><?php //_e( 'Video', 'cosmotheme' ); ?></a></li>\
														<li class="image-link"><a href="#" class=" icon-link" title="<?php _e( 'Custom URL', 'cosmotheme' ); ?>"><?php //_e( 'Custom URL', 'cosmotheme' ); ?></a></li>\
													</ul>\
												</li>');
									}
								});

							}



							e.preventDefault();
							if(v==1) $.prompt.close();
						}
					},
				};
				$.prompt(videoprompt);

			});




		});
	</script>
	<?php
}


add_action('save_post', 'lala_save_attached_images');

// save attached images meta data
function lala_save_attached_images($post_id){
	//// GLOBAL $POST
	global $post;

	// Gallery Images
	if(isset($_POST['product_image_gallery'] )){
		$attachment_ids = array_filter( explode( ',', lala_clean( $_POST['product_image_gallery'] ) ) );
		update_post_meta( $post_id, '_post_image_gallery', implode( ',', $attachment_ids ) );
	
	}
	
}


//// REGISTER OUR STYLES for attached images AND PUTS IN OUR ADMIN PAGE
function lala_attached_images_style() {
	wp_register_style('AttachedImagesStyle', get_template_directory_uri().'/lib/css/attached_images.css');
	wp_enqueue_style('AttachedImagesStyle');
}


//// ADDS STYLE IN OUR HEAD SO THE attached images look nice
	add_action('admin_init', 'lala_attached_images_style');

/**
 * Clean variables
 *
 * @access public
 * @param string $var
 * @return string
 */
function lala_clean( $var ) {
	return sanitize_text_field( $var );
}


/*
adding videos to images using existing images
*/

add_action( 'wp_ajax_video_link', 'video_link_callback' );

function video_link_callback() {
	global $wpdb; // this is how you get access to the database

	$video_link =  $_POST['link'];
	$post_id = intval( $_POST['postid'] );

	update_post_meta( $post_id, 'video_link', $video_link);

        echo $post_id;

	die(); // this is required to return a proper result
}

add_action( 'wp_ajax_retrieve_video_link', 'retrieve_video_link_callback' );

function retrieve_video_link_callback() {
	global $wpdb; // this is how you get access to the database

	$post_id = intval( $_POST['postid'] );

	$custom_fields = get_post_custom($post_id);
	if (isset($custom_fields['video_link'])) {
		 echo $custom_fields['video_link'][0] ;
	} else {
		echo '';
	}

	die(); // this is required to return a proper result
}

/**
 * adding video clip inside an image
 */

add_action( 'wp_ajax_video_link_image', 'video_link_image_callback' );

function video_link_image_callback() {
	global $wpdb; // this is how you get access to the database

    $video_link_iframe = '';
	$video_link_iframe = $_POST['link'];

	if( !empty( $video_link_iframe ) && post::isValidURL( $video_link_iframe) ){
        $vimeo_id = post::get_vimeo_video_id( $video_link_iframe );
        $youtube_id = post::get_youtube_video_id( $video_link_iframe );	
    

	    $video_type = '';

	    if( $vimeo_id != '0' ){

			$image = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$vimeo_id.php"));

			$image_id = tripod_save_image_media( $image[0]['thumbnail_medium'] );

			update_post_meta( $image_id[0], 'video_link', $video_link_iframe);


	    } else if( $youtube_id != '0' ){
	        $image =  'http://img.youtube.com/vi/' . $youtube_id . '/0.jpg' ;

			$image_id = tripod_save_image_media($image);

			update_post_meta( $image_id[0], 'video_link', $video_link_iframe);


	    } else { //if no vimeo or Youtube, go to DEFAULT
	    	$image =  get_template_directory_uri() . '/images/video_thumb.jpeg' ;

			$image_id = tripod_save_image_media($image);

			update_post_meta( $image_id[0], 'video_link', $video_link_iframe);

	    }

	} else { //if  either there is a different link, either an iframe, we same a default image

		$image =  get_template_directory_uri() . '/images/video_thumb.jpeg' ;

		$image_id = tripod_save_image_media($image);

		update_post_meta( $image_id[0], 'video_link', $video_link_iframe);

	}

	if (isset($image_id)) {

		// response output
	    header( "Content-Type: application/json" );
	    echo json_encode($image_id);  
	} 

	die(); // this is required to return a proper result
}


/**
 * Custom link for the image, AJAX
 */

add_action( 'wp_ajax_retrieve_custom_link', 'retrieve_custom_link_callback' );

function retrieve_custom_link_callback() {
	global $wpdb; // this is how you get access to the database

	$post_id = intval( $_POST['postid'] );

	$custom_fields = get_post_custom($post_id);
	
	if (isset($custom_fields['custom_link'])) {

		$json = array(
		 			"custom_link" => $custom_fields['custom_link'][0],
		 			"newtab" => $custom_fields['custom_link_tab'][0]
		 	); 
		
	} else {
		$json = array("custom_link" => '');
	}

	wp_send_json($json);

	die(); // this is required to return a proper result
}


add_action( 'wp_ajax_custom_link', 'custom_link_image_callback' );

function custom_link_image_callback() {
	global $wpdb; // this is how you get access to the database

    $custom_link = '';
	$custom_link = $_POST['link'];
	$newtab = $_POST['newtab'];

	$post_id = intval( $_POST['postid'] );

	//if( !empty( $custom_link ) && post::isValidURL( $custom_link ) ){
	if (true) {
        
		$result = update_post_meta( $post_id, 'custom_link', $custom_link);
		$result2 = update_post_meta( $post_id, 'custom_link_tab', $newtab);

	}

	if (isset($result) && $result != false ) {

	    echo $post_id;  

	} else {
		echo 'error';
	}

	die();
}



function tripod_save_image_media($filename){

		// $filename should be the path to a file in the upload directory.
	$parent_post_id = get_the_ID(); 

	$upload  = media_sideload_image( $filename, $parent_post_id  );

//	$upload = media_sideload_image( $url, $post_id ); 

	if ( is_wp_error( $upload ) ) 
	return 'error';

	$attachments = get_posts( array( 
		'post_type' => 'attachment', 
		 'number_posts' => 1, 
		'post_status' => null, 
		'post_parent' => $parent_post_id, 
		 'orderby' => 'post_date', 
		'order' => 'DESC', 
		) ); 
	$thumbnail_id = $attachments[0]->ID; 
	$attachment_url = wp_get_attachment_image_src($thumbnail_id);

	$image = array($thumbnail_id, $attachment_url[0]);
	return $image;

}

?>