/**
 * Custom Gallery Setting
 */
( function( $ ) {
    var media = wp.media;

    // Render the inser gallery button and The custom button 'Use this images'

    media.view.MediaFrame.Post = media.view.MediaFrame.Post.extend({
        
        galleryEditToolbar: function() {
            var editing = this.state().get('editing');
            this.toolbar.set( new media.view.Toolbar({
                controller: this,
                items: {

                    //  the code bellow is the coppy from  \wp-includes\js\media-views.js , if it changes in the core, then you may want to update this
                    insert: {
                        style:    'primary',
                        text:     editing ? gallery_labels.update_gallery : gallery_labels.insert_gallery,
                        priority: 80,
                        requires: { library: true },

                        click: function() {
                            var controller = this.controller,
                                state = controller.state();

                            controller.close();
                            state.trigger( 'update', state.get('library') );

                            controller.reset();
                            // @todo: Make the state activated dynamic (instead of hardcoded).
                            controller.setState('upload');
                        }
                    },

                    // the item bellow is the custom button
                    insertIDs: {
                        style:    'secondary',
                        text:     editing ? '' : gallery_labels.use_img_ids,
                        priority: 81,
                        requires: { library: true },

                        click: function() {
                            var controller = this.controller,
                                state = controller.state();

                            controller.close();

                            if(state.attributes.library.models){
                                var imgIDs = new Array(); //we will store img IDs in this array
                                jQuery(state.attributes.library.models).each(function( index, obj ) { //iterate through each model
                                    imgIDs[index] = obj.id; // append the ID
                                });  

                                imgIDs.toString(); //convert array to string  

                                jQuery('.imagesattached-img_ids').val(imgIDs); //add IDs to the custom field
                            }
                            
                            controller.reset();
                            // @todo: Make the state activated dynamic (instead of hardcoded).
                            controller.setState('upload');
                        }
                    }
                }
            }) );
        }
    
        
    } );
    
} )( jQuery );