  /*jshint unused:false, jquery:true, browser:true, strict: false*/
/*global logo:true, Sly:true, prettyPhoto_enb: true, cosmo_woocommerce_cripts:true, cookies_prefix: true, FB: true, MyAjax:true, login_localize:true*, gallery_speed:true*/


// Global variables
var logoContent;
var sly;
var gallery_speed;

if (typeof logo !== 'undefined') {
    addLogoToMenu(logo.logoContent);
}  

/*Google fonts api */

(function() {

  var wf = document.createElement('script');
  wf.src = ('https:' === document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
  wf.type = 'text/javascript';
  wf.async = 'true';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(wf, s);
})();

/* End of Google fonts api*/


function setCookie(c_name,value,exdays)
{
  "use strict";
  var exdate=new Date();
  exdate.setDate(exdate.getDate() + exdays);
  var c_value=window.escape(value) + ((exdays===null) ? "" : "; expires="+exdate.toUTCString());
  document.cookie=c_name + "=" + c_value;
}

function resizeVideo(){
  "use strict";
  if(jQuery('.embedded_videos').length){
  jQuery('.embedded_videos iframe ').each(function(){
        var iframe_width = jQuery(this).parents('.embedded_videos').parent().width();
        var iframe_height = iframe_width/1.37;  
      jQuery(this).attr('width',iframe_width);
      jQuery(this).attr('height',iframe_height);
  });

  jQuery('.embedded_videos div.video-js ').each(function(){
        var iframe_width = jQuery(this).parents('.embedded_videos').parent().width();
        var iframe_height = iframe_width/1.37;  
        
            jQuery(this).attr('width',iframe_width);
            jQuery(this).attr('height',iframe_height);
            jQuery(this).css('width',iframe_width);
            jQuery(this).css('height',iframe_height);
          });
  }
}


/* Mobile menu */


(function($){
  "use strict";
$.fn.mobileMenu = function(options) {

  var defaults = {
      defaultText: 'Navigate to...',
      className: 'select-menu',
      subMenuClass: 'sub-menu',
      subMenuDash: '&ndash;'
    },
    settings = $.extend( defaults, options ),
    el = jQuery(this);

  this.each(function(){
    // ad class to submenu list
    el.find('ul').addClass(settings.subMenuClass);

    // Create base menu
    jQuery('<select />',{
      'class' : settings.className
    }).insertAfter( el );

    // Create default option
    jQuery('<option />', {
      "value"   : '#',
      "text"    : settings.defaultText
    }).appendTo( '.' + settings.className );

    // Create select option from menu
    var el_text;
    el.find('a').each(function(){
      if(jQuery(this).html().indexOf("<span>") !== -1){
        el_text = jQuery(this).html().replace(/<span>.*<\/span>/gi,'');
      } else{
        el_text = jQuery(this).text();
      }

      
      
      var $this   = jQuery(this),
          optText = '&nbsp;' + el_text,
          optSub  = $this.parents( '.' + settings.subMenuClass ),
          len     = optSub.length,
          dash;

      // if menu has sub menu
      if( $this.parents('ul').hasClass( settings.subMenuClass ) ) {
        dash = new Array( len+1 ).join( settings.subMenuDash );
        optText = dash + optText;
      }

      // Now build menu and append it
      jQuery('<option />', {
        "value" : this.href,
        "html"  : optText
      }).appendTo( '.' + settings.className );

    }); // End el.find('a').each

    // Change event on select element
    jQuery('.' + settings.className).change(function(){
      var locations = $(this).val();
      if( locations !== '#' ) {
        window.location.href = jQuery(this).val();
      }
    });

  }); // End this.each

  return this;

};
})(jQuery);

jQuery(document).ready(function($) {
"use strict";
  
  $('.top_menu nav.top-menu').mobileMenu({
      defaultText: 'Top menu',
      className: 'mobile-select-top-sub-menu',
      subMenuDash: '&ndash;'
    });
  
});

/* Masonry */

jQuery(document).ready(function() {
  "use strict";
    jQuery( window ).resize( function(){
        if( jQuery(window).width() > 767 ){

            var mosaic_small_col_width = parseInt(jQuery('.masonry.for-mosaic').width()/4,10);
            var mosaic_big_col_width = parseInt(jQuery('.masonry.for-mosaic').width()/2,10) - 30;
            jQuery('.mosaic-view .masonry').isotope({
                // options
                itemSelector : '.masonry .masonry_elem',
                
                masonry : {
                  columnWidth : mosaic_small_col_width
                },
                masonryHorizontal : {
                  rowHeight: mosaic_small_col_width
                },
                cellsByRow : {
                  columnWidth : mosaic_big_col_width,
                  rowHeight : mosaic_big_col_width
                },
                cellsByColumn : {
                  columnWidth : mosaic_big_col_width,
                  rowHeight : mosaic_big_col_width
                }

            });

            jQuery('.masonry:not(.for-mosaic)').isotope({
                // options
                itemSelector : '.masonry .masonry_elem'
            });

            //for wooshop
            if (cosmo_woocommerce_cripts.is_enabled) { 
                jQuery(document).on("mouseenter", ".gbtr_little_shopping_bag_wrapper", function () {
                    if (!jQuery(this).data('init')) {
                        jQuery(this).data('init', true);
                        jQuery(this).hoverIntent(function () {
                                jQuery('.gbtr_minicart_wrapper').fadeIn(200);
                            },
                            function () {
                                jQuery('.gbtr_minicart_wrapper').fadeOut(200);
                            });
                        jQuery(this).trigger('mouseenter');
                    }
                });
            }

        }
    });
     
});

//Add logo to the center of all menu item list (Tripod theme)
function addLogoToMenu(logoContent){
    var middle = Math.round(jQuery(".menu-with-logo nav.main-menu > ul.sf-menu > li").length / 2);
    jQuery(".menu-with-logo nav.main-menu > ul.sf-menu > li:nth-child(" + middle + ")").after(jQuery('<li class="logo">'+logoContent+'</li>'));
    if (typeof logo !== 'undefined') {
        jQuery(".sticky-menu-container nav.main-menu > ul.sf-menu > li:nth-child(" + middle + ")").after(jQuery('<li class="logo">'+logoContent+'</li>'));
    }
}
function getGalleryHeight(){

    var headerHeight = jQuery('.single-gallery header#top').outerHeight();
    var windowHeight = jQuery(window).outerHeight();
    var footerHeight = jQuery('#colophon').outerHeight();
    if(jQuery('.single-gallery #header-container').is(':visible') && jQuery('#colophon').is(':visible')){
      var contentHeight = windowHeight - headerHeight - footerHeight - 4;
    } else{
       var contentHeight = windowHeight;
    }

    return contentHeight;
}

function initHeaderVerticalAlign(){
    "use strict";
    if(jQuery(window).width()>768){
        jQuery('header #header-container .align-middle, footer#colophon .align-middle').each(function(){
            var thisElem = jQuery(this);

            var parentHeight = thisElem.parent().parent().innerHeight();
            var selfHeight = thisElem.innerHeight();
            var margintop = (parentHeight/2) - (selfHeight/2);

            thisElem.css('margin-top',margintop);
        });

        jQuery('header #header-container .align-bottom, footer#colophon .align-bottom').each(function(){
            var thisElem = jQuery(this);

            var parentHeight = thisElem.parent().parent().innerHeight();
            var selfHeight = thisElem.innerHeight();
            var margintop = parentHeight - selfHeight;

            thisElem.css('margin-top',margintop);
        }); 
    }
}

function initSly(){
    var $frame = jQuery('#centered');
    var $wrap  = $frame.parent();
    var frame = new Sly('#centered', {
      horizontal: 1,
      itemNav: 'centered',
      smart: 1,
      activateOn: 'click',
      activateMiddle: 1,
      mouseDragging: 1,
      touchDragging: 1,
      releaseSwing: 1,
      startAt: 0,
      scrollBar: $wrap.find('.scrollbar'),
      scrollBy: 0,
      speed: gallery_speed,
      elasticBounds: 1,
      easing: 'easeOutExpo',
      dragHandle: 1,
      dynamicHandle: 1,
      clickBar: 1,
      keyboardNavBy: 0,

     /* Automated cycling */
  //   cycleBy:       'items',  // Enable automatic cycling by 'items' or 'pages'.
  //   cycleInterval: 3000,  // Delay between cycles in milliseconds.
  //  pauseOnHover:  1, // Pause cycling when mouse hovers over the FRAME.

        /* Mixed options */
  //  speed:         3000,       // Animations speed in milliseconds. 0 to disable animations.
  //  easing:        'linear', // Easing for duration based (tweening) animations.
     
      /* Buttons */
  //  prev: $wrap.find('.prev'),
  //  next: $wrap.find('.next')

    });
        frame.on( 'active', function(){
        if( jQuery('div.additional_items li').length){ //if there are images inside div.additional_items
            var hz = jQuery('div.additional_items li:first-child'); // get the first image

            if ( jQuery(hz).find('iframe').length > 0 ) { // FOR VIDEO
                var $this = jQuery(hz).find('iframe');

                var h = jQuery('.frame ul').height();
                var ifH = jQuery($this).attr('height');

                var ifW = jQuery($this).attr('width');

                var w = h*(ifW/ifH);

                jQuery(hz).find('.video-container').css({
                    width : '100%',
                    height : '100%',
                    padding: 0, 
                    margin: 0
                });
                jQuery(hz).width(w);
                this.add(hz); // add this image

            } else { // FOR IMAGES

                var original_image_src = jQuery(hz).find('img').data('original'); // find the original source of the first image
                var img_width = jQuery(hz).find('img').attr('width');
                var img_height = jQuery(hz).find('img').attr('height');
                var container_height = jQuery('.entry-header div.frame').height();
                if(img_height > container_height){
                    var resized_width = container_height*img_width/img_height;
                    jQuery(hz).css('width',parseInt(resized_width));
                    jQuery(hz).css('height',parseInt(container_height));
                }else{
                    jQuery(hz).css('width',parseInt(img_width));
                    jQuery(hz).css('height',parseInt(img_height));
                }
                jQuery(hz).find('img').attr('src',original_image_src); // replace teh dummy source with the original image source
                this.add(hz); // add this image

            }
        }
    });
    
    return frame;
}


// added Next/previous functionalities apart from Sly framework, via Next / Prev buttons

jQuery(window).ready(function(){
     newxt_prev_custom_sly ();
});

function newxt_prev_custom_sly (){
  jQuery('.btn.next').click(function(){
    var list = jQuery('.frame ul li.active');
    var position = jQuery('.frame ul li').index(list);
    var length = jQuery('.frame ul li').length;
    var next_position = position + 1;
    if (next_position < length) {
      var sel = '.frame ul li:eq('+ next_position +')';
      jQuery(sel).click();
    }
  });

  jQuery('.btn.prev').click(function(){
    var list = jQuery('.frame ul li.active');
    var position = jQuery('.frame ul li').index(list);
    var prev_position = position - 1;
    if (prev_position > -1) {
      var sel = '.frame ul li:eq('+ prev_position +')';
      jQuery(sel).click();
    }
  });

  /* left/right key*/

  jQuery('html body.sly').on('keydown', function(event){

    if (event.which == 39) {
      var list = jQuery('.frame ul li.active');
      var position = jQuery('.frame ul li').index(list);
      var length = jQuery('.frame ul li').length;
      var next_position = position + 1;
      if (next_position < length) {
        var sel = '.frame ul li:eq('+ next_position +')';
        jQuery(sel).click();
      }
    } else if (event.which == 37) {
      var list = jQuery('.frame ul li.active');
      var position = jQuery('.frame ul li').index(list);
      var prev_position = position - 1;
      if (prev_position > -1) {
        var sel = '.frame ul li:eq('+ prev_position +')';
        jQuery(sel).click();
      }
    }
  });
}


jQuery( window ).load( function(){
  "use strict";
    
    initHeaderVerticalAlign();

    var gallery_type = '';

    if(typeof(galleria) != "undefined" && galleria.gallery_type){
        gallery_type = galleria.gallery_type;
    }

   if((jQuery('body').hasClass('single-gallery') && jQuery('body').hasClass('sly')  && gallery_type == 'sly' && !jQuery('.main-container').hasClass('protected-gallery')) || (jQuery('body').hasClass('single-format-gallery') && jQuery('body').hasClass('single-post') && !jQuery('.main-container .post-password-form').length)){
        sly = initSly();
        sly.init();
        sly.on('load change',function(){
            if(this.rel.activeItem==0){
                jQuery('.controls .btn.prev').css('display','none');
            }else if(this.rel.activeItem==this.items.length-1){
                jQuery('.controls .btn.next').css('display','none');
            }else{
                jQuery('.controls .btn.prev').css('display','block');
                jQuery('.controls .btn.next').css('display','block');
            }
        });
        
    }


    jQuery('.single-gallery #main.sly .main-container').not('.protected-gallery').height(getGalleryHeight());
    

    //jQuery('.single-gallery .main-container').css( 'min-height', getGalleryHeight()-30-jQuery('#colophon').height());
    setTimeout(function() {
      jQuery('.single-gallery .frame').height( getGalleryHeight());
      jQuery('.single-gallery #main.sly .main-container').not('.protected-gallery').height(getGalleryHeight()+5);
      jQuery(window).trigger('resize');
    }, 500);

    // Initialize Galleria
    var enb_gall = '';

    if( typeof(enb_Galleria) != "undefined" && enb_Galleria.gallery_enb){
        enb_gall = true;
    }else{
        enb_gall = false;
    }

    if ( typeof(enb_Galleria) == "undefined" ) {
        var enb_Galleria = {};
        enb_Galleria.gallery_enb = false;
        enb_Galleria.password_protected = false;
    }

    //console.log(enb_gall);
    if ((jQuery('body').hasClass('single-gallery') || enb_gall ) && gallery_type != 'sly' &&  !enb_Galleria.password_protected) {
        if(galleria.gallery_type == 'clasic'){
            Galleria.run('#galleria', {responsive:true, height: getGalleryHeight(), debug:false, swipe: true, transition: 'fadeslide', imageMargin: 0}); 
        }else if(galleria.gallery_type == 'folio'){

            Galleria.run('#galleria', {
              imageCrop:false, 
              imageMargin:60, 
              preload: 3,
            });
        }
    }


    /* init horizontal scrollbar */
    if(jQuery('.frame').length && gallery_type == 'sly'){

        var scrollArea =  jQuery('#scrollbar');

        var imagesParentWidth = 0;
        var imageProportions = 0;

        jQuery('.frame ul li.relative').each(function(){
          imagesParentWidth += parseInt(jQuery(this).parent().parent().height()*imageProportions,10);
          imageProportions = jQuery(this).find('img').data('width')/jQuery(this).find('img').data('height');

          if(jQuery(this).find('img').data('height') > jQuery(this).parent().parent().height()){
            jQuery(this).height(jQuery(this).parent().parent().height());
            jQuery(this).width(parseInt(jQuery(this).parent().parent().height()*imageProportions,10));

            jQuery(this).find('img').height(jQuery(this).parent().parent().height());
            jQuery(this).find('img').width(jQuery(this).parent().parent().height()*imageProportions);
          } else{
            jQuery(this).height(jQuery(this).parent().parent().height());
            jQuery(this).width(jQuery(this).find('img').data('width'));
            jQuery(this).find('img').height(jQuery(this).find('img').data('height'));
            jQuery(this).find('img').width(jQuery(this).find('img').data('height')*imageProportions);
          }
        });
        jQuery('.single-format-gallery .frame ul').width(imagesParentWidth);
        jQuery('.single-gallery .frame ul').width(imagesParentWidth);

        sly.reload();

        jQuery(window).on('resize',function(){
            sly.reload();
        });

          ////////////////////////////////////////////////////////////jQuery("img.lazy").lazyload();


    }
      
    jQuery(window).on('resize',function(){
        jQuery('.single-gallery #main.sly .main-container').not('.protected-gallery').height(getGalleryHeight()+5);
        jQuery('.single-gallery .frame').height( getGalleryHeight());
        if(jQuery('.frame').length){
            setTimeout(function(){
              var imagesParentWidth = 0;

              jQuery('.frame ul li.relative').each(function(){
                imagesParentWidth += parseInt(jQuery(this).parent().parent().height()*imageProportions,10)+10;
                imageProportions = jQuery(this).find('img').data('width')/jQuery(this).find('img').data('height');
                
                if(jQuery(this).find('img').data('height') > jQuery(this).parent().parent().height()){
                  jQuery(this).height(jQuery(this).parent().parent().height());
                  jQuery(this).width(parseInt(jQuery(this).parent().parent().height()*imageProportions,10));

                  jQuery(this).find('img').height(jQuery(this).parent().parent().height());
                  jQuery(this).find('img').width(jQuery(this).parent().parent().height()*imageProportions);
                } else{
                  jQuery(this).height(jQuery(this).parent().parent().height());
                  jQuery(this).width(jQuery(this).find('img').data('width'));
                  jQuery(this).find('img').height(jQuery(this).find('img').data('height'));
                  jQuery(this).find('img').width(jQuery(this).find('img').data('height')*imageProportions);
                }
              });
              jQuery('.single-format-gallery .frame ul').width(imagesParentWidth-10);
              jQuery('.single-gallery .frame ul').width(imagesParentWidth-10);

              sly.reload();
              jQuery(window).on('resize',function(){
                  sly.reload();
              });
            },200);
            }
        });
 

});
jQuery(window).bind("orientationchange", function(e){
    jQuery('.single-gallery #main.sly .main-container').not('.protected-gallery').height(getGalleryHeight()+5);
        jQuery('.single-gallery .frame').height( getGalleryHeight());
        if(jQuery('.frame').length){
            setTimeout(function(){
              var imagesParentWidth = 0;

              jQuery('.frame ul li.relative').each(function(){
                imagesParentWidth += parseInt(jQuery(this).parent().parent().height()*imageProportions,10)+10;
                imageProportions = jQuery(this).find('img').data('width')/jQuery(this).find('img').data('height');
                if(jQuery(this).find('img').data('height') > jQuery(this).parent().parent().height()){
                  jQuery(this).height(jQuery(this).parent().parent().height());
                  jQuery(this).width(parseInt(jQuery(this).parent().parent().height()*imageProportions,10));

                  jQuery(this).find('img').height(jQuery(this).parent().parent().height());
                  jQuery(this).find('img').width(jQuery(this).parent().parent().height()*imageProportions);
                } else{
                  jQuery(this).height(jQuery(this).parent().parent().height());
                  jQuery(this).width(jQuery(this).find('img').data('width'));
                  jQuery(this).find('img').height(jQuery(this).find('img').data('height'));
                  jQuery(this).find('img').width(jQuery(this).find('img').data('height')*imageProportions);
                }
              });
              jQuery('.single-format-gallery .frame ul').width(imagesParentWidth-10);
              jQuery('.single-gallery .frame ul').width(imagesParentWidth-10);

              sly.reload();
              jQuery(window).on('resize',function(){
                  sly.reload();
              });
            },200);
            

            }
});
function getContainerWidth(){
    var maxWidth = jQuery('.level-one').data('max-length')*300;
    return maxWidth;
}

/* ###### Filters ##### */

/* thumbs filter */
jQuery(function(){
  "use strict";
    var $container = jQuery('.filter-on');

    // $container.isotope({
    //   itemSelector : '.masonry_elem'
    // });
    
    var $optionSets = jQuery('.thumbs-splitter'),
        $optionLinks = $optionSets.find('a');

    $optionLinks.click(function(){
        var $this = jQuery(this);
        // don't proceed if already selected
        if ( $this.hasClass('selected') ) {
          return false;
        }
        var $optionSet = $this.parents('.thumbs-splitter');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');

        // make option object dynamically, i.e. { filter: '.my-filter-class' }
        var options = {},
            key = $optionSet.attr('data-option-key'),
            value = $this.attr('data-option-value');
        // parse 'false' as false boolean
        value = value === 'false' ? false : value;
        options[ key ] = value;
          // otherwise, apply new options
          $container.isotope( options );
        
        return false;
    });

  
});

jQuery(document).ready(function(){
"use strict";

    /*init showing the mobile menu*/
    jQuery(".small-device-menu-link").pageslide({ direction: "right", modal: true });
    jQuery(window).load(function(){
      jQuery('.small-device-menu-link').click(function(){
        jQuery('body').toggleClass('mobile-menu-open');
        if ( jQuery('body').hasClass('mobile-menu-open') ) {
          jQuery('.small-device-menu-link').removeClass('open-menu').addClass('close-menu')
        }else {
          jQuery('.small-device-menu-link').removeClass('close-menu').addClass('open-menu')
        }
      });
    });
    if(galleria.gallery_type == 'image_flow'){
      hs.graphicsDir = themeurl + '/images/imageflow/';
    }
    
    jQuery('.collapse-btn').click( function(){    

        if (jQuery('.collapse-btn i').hasClass('icon-prev')) {
            jQuery('.gallery-info').fadeOut(500);
            jQuery('.single-gallery .entry-header').animate({ marginLeft: '0px'}, 500, function(){
              if (jQuery('.single-gallery.sly').length > 0) {
                sly.reload();
              } 
            });


            jQuery('.collapse-btn i').removeClass('icon-prev').addClass('icon-next');
            jQuery('.collapse-btn').animate({ marginLeft: '-60px'}, 800, function(){});
            jQuery('.collapse-btn span').html('Click to display');
            jQuery('#main.folio #galleria, #main.clasic #galleria, #main.image_flow #cosmoImageFlow').css('margin-left','0px');
            if ( (jQuery('body').hasClass('single-gallery') || enb_gall ) && !enb_Galleria.password_protected) {
                if(galleria.gallery_type == 'clasic'){
                    Galleria.run('#galleria', {responsive:true, height: getGalleryHeight(), debug:false, swipe: true, transition: 'fadeslide', imageMargin: 0}); 
                }else if(galleria.gallery_type == 'folio'){
                    Galleria.run('#galleria', {imageCrop:false, imageMargin:60, });
                }
            }

        }else if (jQuery('.collapse-btn i').hasClass('icon-next')){
            jQuery('.single-gallery .entry-header').animate({ marginLeft: '300px'}, 500, function(){
              if (jQuery('.single-gallery.sly').length > 0) {
                  sly.reload();
              } 
            });
            jQuery('.gallery-info').fadeIn(500);
            jQuery('.collapse-btn i').removeClass('icon-next').addClass('icon-prev');
            jQuery('.collapse-btn').animate({ marginLeft: '0px'}, 800, function(){});
            jQuery('.collapse-btn span').html('Click to collapse');
            jQuery('#main.folio #galleria, #main.clasic #galleria, #main.image_flow #cosmoImageFlow').css('margin-left','300px');
            if ( (jQuery('body').hasClass('single-gallery') || enb_gall ) && !enb_Galleria.password_protected) {
                if(galleria.gallery_type == 'clasic'){
                    Galleria.run('#galleria', {responsive:true, height: getGalleryHeight(), debug:false, swipe: true, transition: 'fadeslide', imageMargin: 0}); 
                }else if(galleria.gallery_type == 'folio'){
                    Galleria.run('#galleria', {imageCrop:false, imageMargin:60, });
                }
            }
        }
    }); 


    /* Related tabs */
    jQuery('.related-tabs li a').click(function(){
        var element_id =  jQuery(this).attr('href');
        jQuery(this).parents('li').parent().find('.active').removeClass('active');
        jQuery(this).parents('li').addClass('active');
        jQuery(this).parents('li').parent().next().find(' > div:visible').fadeOut(400);
        jQuery(this).parents('li').parent().next().find(element_id).delay(400).fadeIn(400);
        return false;
    });


    

    jQuery('.tabs-controller > li > a').click(function(){
        var this_id = jQuery(this).attr('href'); // Get the id of the div to show
        var tabs_container_divs = '.' + jQuery(this).parent().parent().next().attr('class') + ' >  div'; // All of elements to hide
        jQuery(tabs_container_divs).hide(); // Hide all other divs
        jQuery(this).parent().parent().next().find(this_id).show(); // Show the selected element
        jQuery(this).parent().parent().find('.active').removeClass('active'); // Remove '.active' from elements
        jQuery(this).addClass('active'); // Add class '.active' to the active element
        return false;
    }); 
  
  /*resize FB comments depending on viewport*/

setTimeout(function(){
    viewPort();
  },3000); 

  
  resizeVideo();

  jQuery( window ).resize( function(){
  resizeVideo();
   viewPort();
    });
  
  /* Accordion */
  jQuery('.cosmo-acc-container').hide();
  jQuery('.cosmo-acc-trigger:first').addClass('active').next().show();
  jQuery('.cosmo-acc-trigger').click(function(){
    if( jQuery(this).next().is(':hidden') ) {
      jQuery('.cosmo-acc-trigger').removeClass('active').next().slideUp();
      jQuery(this).toggleClass('active').next().slideDown();
    }
    return false;
  });


  
  /* Hide Tooltip */
  jQuery(function() {
    jQuery('a.close').click(function() {
      jQuery(jQuery(this).attr('href')).slideUp();
            jQuery.cookie(cookies_prefix + "_tooltip" , 'closed' , {expires: 365, path: '/'});
            jQuery('.header-delimiter').removeClass('hidden');
      return false;
    });
  });
  
  
  /* initialize tabs */
  jQuery('.cosmo-tabs').each(function(){
    // Set default active classes
    jQuery(this).find('.tabs-container').not(':first').css('display','none');
    jQuery(this).find('ul li:first').addClass('tabs-selected');

     jQuery(this).find('ul li a').click(function(){
      if( jQuery(this).parent().hasClass('tabs-selected') ){
        return false;
      }
      var tabId = jQuery(this).attr('href');

      // We clear all active clasees
      jQuery(this).parent().parent().find('.tabs-selected').removeClass('tabs-selected');


      jQuery(this).parent().addClass('tabs-selected');
      jQuery(this).parents('.cosmo-tabs').find('.tabs-container').not(tabId).css('display','none');
      jQuery(this).parents('.cosmo-tabs').find(tabId).css('display','block');
      return false;
    })

  });

  
  jQuery(document).ready(function() {
    jQuery('aside.widget').append('<div class="clear"></div>');
  });


  /* widget tabber */
    jQuery( 'ul.widget_tabber li a' ).click(function(){
        jQuery(this).parent('li').parent('ul').find('li').removeClass('active');
        jQuery(this).parent('li').parent('ul').parent('div').find( 'div.tab_menu_content.tabs-container').fadeTo( 200 , 0 );
        jQuery(this).parent('li').parent('ul').parent('div').find( 'div.tab_menu_content.tabs-container').hide();
        jQuery( jQuery( this ).attr('href') + '_panel' ).fadeTo( 600 , 1 );
        jQuery( this ).parent('li').addClass('active');
    });
  
    
    /*toogle*/
    /*Case when by default the toggle is closed */
  jQuery('.open_title').click(function(){
    if (jQuery(this).find('a').hasClass('show')) {
      jQuery(this).find('a').removeClass('show');
      jQuery(this).find('a').addClass('toggle_close'); 
      jQuery(this).find('.title_closed').hide();
      jQuery(this).find('.title_open').show();
    } else {
      jQuery(this).find('a').removeClass('toggle_close');
      jQuery(this).find('a').addClass('show');     
      jQuery(this).find('.title_open').hide();
      jQuery(this).find('.title_closed').show();
    }
    jQuery(this).next('.cosmo-toggle-container').slideToggle("slow");
  });
  
    /*Case when by default the toggle is oppened */
  jQuery('.close_title').click(function(){
    if (jQuery(this).find('a').hasClass('hide')) {
      jQuery(this).find('a').removeClass('toggle_close');
      jQuery(this).find('a').addClass('show');     
      jQuery(this).find('.title_open').hide();
      jQuery(this).find('.title_closed').show();
    } else {
      jQuery(this).find('a').removeClass('show');
      jQuery(this).find('a').addClass('toggle_close');
      jQuery(this).find('.title_closed').hide();
      jQuery(this).find('.title_open').show();
    }
    jQuery(this).next('.cosmo-toggle-container').slideToggle("slow");
  });
  
  /*Accordion*/
  jQuery('.cosmo-acc-container').hide();
  jQuery('.cosmo-acc-trigger:first').addClass('active').next().show();
  jQuery('.cosmo-acc-trigger').click(function(){
  if( jQuery(this).next().is(':hidden') ) {
    jQuery('.cosmo-acc-trigger').removeClass('active').next().slideUp();
    jQuery(this).toggleClass('active').next().slideDown();
  }
  return false;
  }); 
  
});

/* grid / list switch */



/*EOF functions for style switcher*/

function viewPort(){ 
  "use strict";
  /* Determine screen resolution */
  //var $body = jQuery('body');
  var wSizes = [1200, 960, 768, 480, 320, 240];

  //$body.removeClass(wSizesClasses.join(' '));
  var size = jQuery(window).width();
  //alert(size);
  for (var i=0; i<wSizes.length; i++) { 
    if (size >= wSizes[i] ) { 
      //$body.addClass(wSizesClasses[i]);

      
      jQuery('.cosmo-comments .fb_iframe_widget iframe,.cosmo-comments .fb_iframe_widget span').css({'width':jQuery('.cosmo-comments.twelve.columns').width() });   
      
      break;
    }
  }
  if(typeof(FB) !== 'undefined' ){
    FB.Event.subscribe('xfbml.render', function(response) {
      FB.Canvas.setAutoGrow();
    });
  }  

}



jQuery(document).ready(function() {
"use strict";
  /*Tweets widget*/
   var delay = 4000; //millisecond delay between cycles
   function cycleThru(variable, j){
           var jmax = jQuery(variable + " div").length;
           jQuery(variable + " div:eq(" + j + ")")
                   .css('display', 'block')
                   .animate({opacity: 1}, 600)
                   .animate({opacity: 1}, delay)
                   .animate({opacity: 0}, 800, function(){
                     if(j+1 === jmax){ 
      j=0;
                     }else{ 
      j++; 
                     }
                           jQuery(this).css('display', 'none').animate({opacity: 0}, 10);
                           cycleThru(variable, j);
                   });
           }
           
   jQuery('.tweets').each(function(index, val) {
     //iterate through array or object
     var parent_tweets = jQuery(val).parent().attr('id');
     var actioner = '#' + parent_tweets + ' .tweets .dynamic .cosmo_twitter .slides_container';
     cycleThru(actioner, 0);
   });
   

    /* list view tabs */

    jQuery('.tabment-tabs li:first-child a').addClass('active'); // Set the class for active state
    jQuery('.tabment-tabs li a').click(function( event ){ // When link is clicked
      if(!jQuery(this).hasClass('active')){
        var tabment_id = jQuery(this).attr('href'); // Set currentTab to value of href attribute
        jQuery(this).parent().parent().find('.active').removeClass('active');
        jQuery(this).parent().parent().parent().parent().next().find('.tabment-tabs-container').find('li.tabs-container').hide();
        jQuery(this).parent().parent().parent().parent().next().find('.tabment-tabs-container').find(tabment_id).fadeIn(500);
        jQuery(window).trigger('resize');
        jQuery(this).addClass('active');
      }
      event.preventDefault();
      return false;
    });


    jQuery('.flickr_badge_image').each(function(index){
      var x = index % 3;
      if(index !==1 && x === 2){
        
        jQuery(this).addClass('last');
      } 
    });
  

 });

/*========================================================================*/   


//init hover on thumb view with image main
function hoverThumbImg(){
  "use strict";
  var thisElem;

  jQuery('.thumb-image-main').mouseenter(function(){
    thisElem = jQuery(this);

    jQuery('.entry-content', thisElem).css('opacity','1');
  }).mouseleave(function(){
    thisElem = jQuery(this);

    jQuery('.entry-content', thisElem).css('opacity','0');
  });
}

//init hover on thumb view with text main 
function hoverThumbText(){
  "use strict";
  jQuery('.thumb-text-main').mouseenter(function(){
  var thisElem = jQuery(this);

    jQuery('.featimg', thisElem).css('opacity','1');
  }).mouseleave(function(){
    var thisElem = jQuery(this);

    jQuery('.featimg', thisElem).css('opacity','0');
  });
}



jQuery(function(){
"use strict";
  hoverThumbImg();
  hoverThumbText();

  if(navigator.platform.match('Mac') !== null) {
    jQuery(document.body).addClass('OSX');
  }

});

//Global variables
var calculatedStickyMenu = false;

function searchAction(activeBoth){
  "use strict";
  if(jQuery('.search-btn').hasClass('searching')){
    jQuery('#main>.search-container').fadeOut(function(){
      jQuery('#main>.main-container').fadeIn();
      jQuery('.search-btn').removeClass('searching');
    });
  }else if(activeBoth){
    if(jQuery(window).width()<768){
      jQuery('body').animate({scrollTop: jQuery('#main>.main-container').offset().top-30},'slow','swing', 
        function(){
          jQuery('#main>.main-container').fadeOut(function(){
          jQuery('#main>.search-container').fadeIn(function(){
            jQuery('#main>.search-container form input.input').focus();
          });
          jQuery('.search-btn').addClass('searching');
        });
      });
    }else{
      jQuery('body').animate({scrollTop: 0},'slow','swing', 
        function(){
          jQuery('#main>.main-container').fadeOut(function(){
          jQuery('#main>.search-container').fadeIn(function(){
            jQuery('#main>.search-container form input.input').focus();
          });
          jQuery('.search-btn').addClass('searching');
        });
      });
    }
  }
}

//init Search btn to toggle the content
function initSearchBtn(){
  "use strict";
  jQuery('.search-btn').click(function(){
    searchAction(true);
  });

  jQuery(document).keyup(function(e) {
    if (e.keyCode === 27) {
      searchAction(false);
    }
  });
}

//init menu - you need just to give him the menu class
function initMenu(menu){
  "use strict";
  jQuery(menu).supersubs({ 
        minWidth:    14,   // minimum width of sub-menus in em units 
        maxWidth:    35,   // maximum width of sub-menus in em units
        animation: {height:'show'}  // slide-down effect without fade-in 
                           // due to slight rounding differences and font-family 
    }).superfish({
      dropShadows:   false
    });  // call supersubs first, then superfish, so that subs are 
   // not display:none when measuring. Call before initialising 
   // containing tabs for same reason. 
}

function initStickyMenu(){
  "use strict";
  jQuery(document).on('scroll',function(){
    if( jQuery(document).scrollTop() >= jQuery('.menu > .main-menu, .menu-with-logo > .main-menu').offset().top-15){
      //jQuery('#page').animate({paddingTop: '40px'}, 500);
      jQuery('header#top #header-container .sticky-menu-container').show();
      if(!calculatedStickyMenu){
        initMenu('.sticky-menu-container ul.sf-menu');
        calculatedStickyMenu=true;
      }
    }else{
      jQuery('header#top #header-container .sticky-menu-container').hide();
    }
  });
}

function initTestimonialsCarousel(){
"use strict";
  //jQuery('.testimonials-view ul.testimonials-carousel').height(jQuery('.testimonials-carousel-elem.active').height());

  jQuery('.testimonials-view ul.testimonials-carousel, .widget ul.testimonials-carousel').each(function(){
    if(jQuery(this).children().length<=1){
      jQuery('.testimonials-carousel-nav', jQuery(this).parent()).css('display', 'none');
    }
  });

  

  jQuery('.testimonials-view ul.testimonials-carousel-nav > li, .widget ul.testimonials-carousel-nav > li').click(function(){
    var thisElem = jQuery(this);
    var thisTestimonialContainer = jQuery(this).parent().parent();
    var activeTestimonial = jQuery('.testimonials-carousel-elem.active', thisTestimonialContainer);
    var indexOfActiveElem = jQuery('.testimonials-carousel-elem', thisTestimonialContainer).index(jQuery('.testimonials-carousel-elem.active', thisTestimonialContainer));

    var listOfTestimonials = jQuery('.testimonials-carousel-elem', thisTestimonialContainer).toArray();
    var lengthOfList = listOfTestimonials.length-1;
    var IndexOfNextTestimonial;
    var IndexOfPrevTestimonial;
    var nextTestimonial;
    var prevTestimonial;


    if(indexOfActiveElem+1 > lengthOfList){
      IndexOfNextTestimonial = 0;
    }else{
      IndexOfNextTestimonial = indexOfActiveElem+1;
    }

    if(indexOfActiveElem-1 < 0){
      IndexOfPrevTestimonial = lengthOfList;
    }else{
      IndexOfPrevTestimonial = indexOfActiveElem-1;
    }

    nextTestimonial = listOfTestimonials[IndexOfNextTestimonial];
    prevTestimonial = listOfTestimonials[IndexOfPrevTestimonial];


    if( thisElem.hasClass('testimonials-carousel-nav-left') ){

      activeTestimonial.fadeOut('fast', function(){
        activeTestimonial.removeClass('active');
        jQuery(prevTestimonial).addClass('active');
        jQuery(prevTestimonial).fadeIn();
      });

    }else{

      activeTestimonial.fadeOut('fast', function(){
        activeTestimonial.removeClass('active');
        jQuery(nextTestimonial).addClass('active');
        jQuery(nextTestimonial).fadeIn();
      });

    }
  });

}

function initCarousel(){
  "use strict";
  jQuery('.carousel-wrapper').each(function(){
    var thisElem = jQuery(this);
    var numberOfElems = parseInt(jQuery('.carousel-container', thisElem).children().length, 10);
    var oneElemWidth;
    var numberOfColumns = [['two',6],['three',4],['four',3],['six',2],['twelve',1]];
    var curentNumberOfColumns;
    var moveMargin;
    var leftHiddenElems = 0;
    var rightHiddenElems; 
    var curentMargin = 0;
    var numberOfElemsDisplayed;
    var index = 0;
    var carouselContainerWidth;
    var carouselContainerWidthPercentage;
    var elemWidth;
    var elemWidthPercentage;

    while( index < numberOfColumns.length){
      if ( jQuery('.carousel-container>.columns', thisElem).hasClass(numberOfColumns[index][0]) ){
        curentNumberOfColumns = numberOfColumns[index][1];
        break;
      }
      index ++;
    }

    elemWidth = 100/numberOfElems;
    elemWidth = elemWidth.toFixed(4);
    elemWidthPercentage = elemWidth + '%';

    reinitCarousel();

    jQuery(window).resize(function() {
      reinitCarousel();
    });

    function showHideArrows(){
      if(curentNumberOfColumns>=numberOfElems){
        jQuery('ul.carousel-nav > li.carousel-nav-left', thisElem).css('display','none');
        jQuery('ul.carousel-nav > li.carousel-nav-right', thisElem).css('display','none');
      }else if(curentMargin===0){
        jQuery('ul.carousel-nav > li.carousel-nav-left', thisElem).css('display','none');
        jQuery('ul.carousel-nav > li.carousel-nav-right', thisElem).css('display','block');
      }else if(rightHiddenElems===0){
        jQuery('ul.carousel-nav > li.carousel-nav-left', thisElem).css('display','block');
        jQuery('ul.carousel-nav > li.carousel-nav-right', thisElem).css('display','none');
      }else{
        jQuery('ul.carousel-nav > li.carousel-nav-left', thisElem).css('display','block');
        jQuery('ul.carousel-nav > li.carousel-nav-right', thisElem).css('display','block');
      }
    }

    function reinitCarousel(){

      showHideArrows();

      jQuery('.carousel-container', thisElem).css('margin-left',0);
      leftHiddenElems = 0;
      jQuery('ul.carousel-nav > li', thisElem).unbind('click');

      if(jQuery(window).width()<=767){

        carouselContainerWidth = 100 * numberOfElems;
        carouselContainerWidthPercentage = carouselContainerWidth + '%';
        rightHiddenElems = numberOfElems - 1;
        moveMargin = 100;

        curentMargin = 0;

        jQuery('ul.carousel-nav > li', thisElem).unbind('click');

        jQuery('ul.carousel-nav > li', thisElem).click(function(){



          if( jQuery(this).hasClass('carousel-nav-left') ){

            if (leftHiddenElems!==0){

              curentMargin = curentMargin + moveMargin;
              jQuery('.carousel-container', thisElem).css('margin-left',curentMargin+'%');
              rightHiddenElems++;
              leftHiddenElems--;
            }

            showHideArrows();

          }else{

            if (rightHiddenElems!==0){
              curentMargin = curentMargin - moveMargin;
              jQuery('.carousel-container', thisElem).css('margin-left', curentMargin+'%');
              rightHiddenElems--;
              leftHiddenElems++;
            }

            showHideArrows();

          }

        });

      }else{

        while( index < numberOfColumns.length){
          if ( jQuery('.carousel-container>.columns', thisElem).hasClass(numberOfColumns[index][0]) ){
            numberOfElemsDisplayed = numberOfColumns[index][1];
            moveMargin = 100/numberOfElemsDisplayed;
            rightHiddenElems = numberOfElems - numberOfElemsDisplayed;
            oneElemWidth = 100 / numberOfColumns[index][1];
            break;
          }
          index ++;
        }

        carouselContainerWidth = oneElemWidth * numberOfElems;
        carouselContainerWidthPercentage  = carouselContainerWidth + '%';

        curentMargin = 0;

        jQuery('ul.carousel-nav > li', thisElem).click(function(){

          if( jQuery(this).hasClass('carousel-nav-left') ){

            if (leftHiddenElems!==0){
              curentMargin = curentMargin + moveMargin;
              jQuery('.carousel-container', thisElem).css('margin-left',curentMargin+'%');
              rightHiddenElems++;
              leftHiddenElems--;
            }

            showHideArrows();

          }else{

            if (rightHiddenElems!==0){
              curentMargin = curentMargin - moveMargin;
              jQuery('.carousel-container', thisElem).css('margin-left', curentMargin+'%');
              rightHiddenElems--;
              leftHiddenElems++;
            }

            showHideArrows();

          }

        });

      }

      //set container width
      jQuery('.carousel-container', thisElem).width(carouselContainerWidthPercentage).css({'max-height':'999px', 'opacity':'1'});


      //set eachelem width
      jQuery('.carousel-container>.columns', thisElem).each(function(){
        jQuery(this).attr('style','width: '+elemWidthPercentage+' !important; float:left;');
      });
      
    }

  });
}


function initHoverEffectForThumbView() {
    jQuery('.thumb-elem, .grid-elem header').each(function(){
      var thisElem = jQuery(this);
      var getElemWidth = thisElem.width();
      var getElemHeight = thisElem.height();
      var centerX = getElemWidth/2;
      var centerY = getElemHeight/2;

      thisElem.mouseenter(function(){
        thisElem.on('mousemove', function (e) {
          var mouseX = e.pageX - thisElem.offset().left;
                var mouseY = e.pageY - thisElem.offset().top;
                var mouseDistX = (mouseX / centerX) * 100 - 100;
                var mouseDistY = (mouseY / centerY) * 100 - 100;
                thisElem.find('img.the-thumb').css({
                  'left': -(mouseDistX/6.64) - 15 + "%",
                    'top':  -(mouseDistY/6.64) - 15 + "%"
                });
        });

        thisElem.find('.thumb-elem-section:not(.no-feat-img)').fadeIn('fast');
      }).mouseleave(function(){
        thisElem.find('.thumb-elem-section:not(.no-feat-img)').fadeOut('fast');
      });
    });
}

if (cosmo_woocommerce_cripts.is_enabled) { 
//if registration is enabled on My account page wi will need the following code

    jQuery('.customer-register').click(function () {
            jQuery('#customer_login > div.myaccount-register').fadeOut(300, function () {
                    jQuery('#customer_login').find('.myaccount-login').fadeIn(400);
                });
            jQuery('.account-toggle-login').fadeOut(300, function () {
                    jQuery('.account-toggle-register').fadeIn(300);
                });
            return false;
        });
    jQuery('.customer-login').click(function () {
            jQuery('#customer_login > div.myaccount-login').fadeOut(300, function () {
                    jQuery('#customer_login').find('.myaccount-register').fadeIn(400);
                });
            jQuery('.account-toggle-register').fadeOut(300, function () {
                    jQuery('.account-toggle-login').fadeIn(300);
                });
            return false;
        });
}

function initSimpleHoverEffectForThumbView() {
    jQuery('.thumb-elem, .grid-elem header').each(function(){
      var thisElem = jQuery(this);
      thisElem.mouseenter(function(){
        thisElem.find('.thumb-elem-section:not(.no-feat-img)').fadeIn('fast');
      }).mouseleave(function(){
        thisElem.find('.thumb-elem-section:not(.no-feat-img)').fadeOut('fast');
      });
    });
}

jQuery(window).load(function() {
  "use strict";
    initSearchBtn();
    initStickyMenu();
    initTestimonialsCarousel();
    initCarousel();

    if ( ! hoverEffect.disable_hover_effect && jQuery(window).width() > 768 ) {
     // jQuery('.thumb-elem, .grid-elem header').addClass('hovermove');
      if ( jQuery('.grid-elem').parent().hasClass('masonry_elem') ) return;
      if ( jQuery('.thumb-elem').parent().hasClass('masonry_elem')&& (!jQuery('.thumb-elem').parent().hasClass('movable') )) {
        initSimpleHoverEffectForThumbView();
        return;
      }

          initHoverEffectForThumbView();
    }else{
        initSimpleHoverEffectForThumbView();
    }

    jQuery('.filter-on').isotope();

    jQuery(window).trigger('resize');

    if( jQuery( '#galleria' ).length > 0 ){
      jQuery( '#galleria' ).animate({opacity: 1}, 500);
    }
});

jQuery(document).ready(function(){
  "use strict";
  initMenu('.menu ul.sf-menu, .menu_and_logo ul.sf-menu, .login-menu.sf-menu');
  setTimeout(function(){
      jQuery('.single article.post .featimg .featbg').css('display','inline-block'); /* This fix the bug on safari (iamge too small when is set inline-block parent) */
    }, 1000);
});


/*==========================================BOF   Photo Settings===============================*/

if (prettyPhoto_enb.enb_lightbox) { 
  jQuery(document).ready(function(){
    "use strict";
      /* show images inserted in gallery */
      jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
              autoplay_slideshow: false,
              theme: 'light_square',
              social_tools:'<div class="pp_social"><div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&href='+location.href+'&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"></iframe></div></div>', 
              deeplinking: true,
              hook: 'data-rel' 

      });

      /* show images inserted into post in LightBox */
      jQuery("[class*='wp-image-']").parents('a').not("a[data-rel^='attachment']").prettyPhoto({
              autoplay_slideshow: false,
              theme: 'light_square',
              deeplinking: true ,
              hook: 'data-rel'

      });
      
      jQuery("a[data-rel^='keyboardtools']").prettyPhoto({
              autoplay_slideshow: false,
              theme: 'light_square',
              social_tools : '<div class="pp_social"><div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&href='+location.href+'&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"></iframe></div></div>' /* html or false to disable */,
              deeplinking: true,
              hook: 'data-rel' 

      });
  });
}
/*==========================================EOF Pretty Photo Settings===============================*/


/*==========================================BOF Login Settings===============================*/
var user_archives_link;

function redirect(){
  "use strict";
  //document.location = user_archives_link;
  location.reload();
}

jQuery( '#register_form' ).ready( function(){
  "use strict";
  jQuery( '#register_form' ).submit( function( event ){
    jQuery.ajax({
      url: MyAjax.ajaxurl,
      data: '&action=cosmo_register&'+jQuery( '#register_form' ).serialize(),
      type: 'POST',
      dataType: "json",
      cache: false,
      success: function (json) {

        if(json.status && json.status === 'success'){
          if(json.url){
            user_archives_link = json.url; 
          }
          
          jQuery( '#registration_error' ).removeClass( 'login-error' );
          jQuery( '#registration_error' ).addClass( 'login-success' );
          jQuery( '#registration_error' ).html( json.msg ).fadeIn();


          setTimeout( redirect , 1000 );
        }else{
          jQuery( '#registration_error' ).html( json.msg ).fadeIn();
        }

        
      }
    });
  event.preventDefault();
  });
});

    
jQuery( '#cosmo-loginform' ).ready( function(){
  "use strict";
  jQuery( '#cosmo-loginform' ).submit( function(event){
        jQuery( '#ajax-indicator' ).show();
    jQuery.ajax({
      url: MyAjax.ajaxurl,
      data: '&action=cosmo_login&'+jQuery( '#cosmo-loginform' ).serialize(),
      type: 'POST',
      dataType: "json",
      cache: false,
      success: function (json) {
                jQuery( '#ajax-indicator' ).hide();

                if(json.status && json.status === 'success'){
                  user_archives_link = json.url;
                  jQuery( '#registration_error' ).removeClass( 'login-error' );
          jQuery( '#registration_error' ).addClass( 'login-success' );
                    
          jQuery( '#registration_error' ).html( json.msg ).fadeIn();
          setTimeout( redirect , 1000 );
                }else{
                  jQuery( '#registration_error' ).html( json.msg ).fadeIn();
                }

        
      }
    });
    event.preventDefault();
  });
});

jQuery( '#lostpasswordform' ).ready( function(){
  "use strict";
  jQuery( '#lostpasswordform' ).submit( function(){
    //jQuery( '#registration_error' ).html(  'Please check your email'  ).fadeIn();
    jQuery( '#registration_error' ).html( login_localize.check_email ).fadeIn();
    
  });
});

function get_login_box(action){ 
  "use strict";
  jQuery('.not_logged_msg').fadeOut();

  if(jQuery('.login_box').is(':hidden')){
    //jQuery('.login_box').removeClass("hide"); //show login box
    jQuery('.login_box').slideToggle(600);

  }
  //if(action != ''){
    jQuery('.'+action+'_warning').fadeIn();   
    jQuery('body,html').animate({scrollTop:0},300);
  //}

  //e.preventDefault();
} 
/*==========================================EOF Login Settings===============================*/

/* Sharing effect */
jQuery('.share-opened').click(function(){
    jQuery(this).next().slideToggle(300);
});


/* Single overlay effect */

// Check if is single
var featmask_enb;

if(jQuery('body').hasClass('single-post') && featmask_enb == true ) {
    
    //Check if we have feat img
    if(jQuery('.featimg > .featbg').length > 0){
      
      // Do on scroll effect

      jQuery(window).bind('scroll', function() {
          var windowTop = jQuery(document).scrollTop();
          var featmaskTop = jQuery('.featmask').offset().top+30;
              var newCoord = windowTop * 3;
              jQuery('.featmask').css({
                  "top":  newCoord + "px"
              });
      });
    }

}

// Check if is single-format-gallery
if(jQuery('body').hasClass('single-format-gallery')){
    
    // add loading effect
    jQuery( window ).load(function(){
        jQuery('.featimg.resized-img').animate({opacity: 1},500);
    });

}

// Check if is single-gallery
if(jQuery('body').hasClass('single-gallery')){
    
    // add loading effect
    jQuery( window ).load(function(){
      setTimeout(function() {
        jQuery('.main-container').animate({opacity: 1}, 700);
        jQuery('#colophon').animate({opacity: 1}, 700);
      }, 600);
    })

}

jQuery('.header-collapser').click(function(){
  jQuery('#header-container').slideToggle(300);
  jQuery('#colophon').slideToggle(300);
  if ( jQuery(this).hasClass('icon-bottom') ){
    jQuery(this).removeClass('icon-bottom').addClass('icon-top');
  } else{
    jQuery(this).removeClass('icon-top').addClass('icon-bottom');
  }
  setTimeout(function(){
        if(jQuery('.frame').length){
          jQuery('.single-gallery #main.sly .main-container').not('.protected-gallery').height(getGalleryHeight()+5);
          jQuery('.single-gallery .frame').height( getGalleryHeight());
            
              var imagesParentWidth = 0;

              jQuery('.frame ul li.relative').each(function(){
                imagesParentWidth += parseInt(jQuery(this).find('img').width(),10)+10;
                jQuery(this).width(jQuery(this).find('img').width());
                jQuery(this).height(jQuery(this).parent().parent().height());
              });
              jQuery('.single-format-gallery .frame ul').width(imagesParentWidth-10);
              jQuery('.single-gallery .frame ul').width(imagesParentWidth-10);

              sly.reload();
              jQuery(window).trigger('resize');
        }
            },400);
})


///////  Wishlist

if (cosmo_woocommerce_cripts.is_enabled) { 
    var cookieList = function (cookieName) {
        //When the cookie is saved the items will be a comma seperated string
        //So we will split the cookie by comma to get the original array
        var cookie = jQuery.cookie(cookieName);
        //Load the items or a new array if null.
        var items = cookie ? cookie.split(/,/) : [];

        //Return a object that we can use to access the array.
        //while hiding direct access to the declared items array
        return {
            "add": function (val) {
                //Add to the items.
                items.push(val);
                //Save the items to a cookie.
                jQuery.cookie(cookieName, items, {
                        path: '/',
                        expires: 365
                    });
            },
            "remove": function (val) {
                /** indexOf not support in IE, and I add the below code **/
                if (!Array.prototype.indexOf) {
                    Array.prototype.indexOf = function (obj, start) {
                        for (var i = (start || 0), j = this.length; i < j; i++) {
                            if (this[i] === obj) {
                                return i;
                            }
                        }
                        return -1;
                    };
                }
                var indx = items.indexOf(val);
                if (indx !== -1) {
                    items.splice(indx, 1);
                }
                jQuery.cookie(cookieName, items.join(','), {
                        path: '/'
                    });
            },
            "clear": function () {
                //clear the cookie.
                jQuery.cookie(cookieName, null, {
                        path: '/'
                    });
            },
            "items": function () {
                //Get all the items.
                return items;
            }
        };
    };


    //Checkout tabs
    jQuery('.checkout-control-wrapper ul li > div').click(function () {
            if (jQuery(this).parent().hasClass('active')) {
                return false;
            }
            jQuery(this).parent().parent().find('.active').removeClass('active');
            jQuery(this).parent().addClass('active');
            if (jQuery(this).hasClass('checkout_billing')) {
                jQuery('.checkout > div').fadeOut(300);
                jQuery('.checkout > .checkout_billing').delay(300).fadeIn(300);
            } else if (jQuery(this).hasClass('checkout_shipping')) {
                jQuery('.checkout > div').fadeOut(300);
                jQuery('.checkout > .checkout_shipping').delay(300).fadeIn(300);
            } else if (jQuery(this).hasClass('checkout_order_review')) {
                jQuery('.checkout > div').fadeOut(300);
                jQuery('.checkout > .checkout_order_review').delay(300).fadeIn(300);
            }
            return false;
        });
    jQuery('.checkout-continue').click(function () {
        jQuery('.checkout-control-wrapper ul li.active').removeClass('active').next().find('.checkout-button').trigger('click');
        return false;
    });

    jQuery( window ).load( function(){
        "use strict";

        //single product gallery
        // The slider being synced must be initialized first
        jQuery('#carousel').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: 83,
                itemMargin: 0,
                asNavFor: '#slider'
            });

        jQuery('#slider').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                smoothHeight: true,
                sync: "#carousel"
            });

    });
}

//handles ajax call add to wishlist

function add_to_wishlist(id) {

    if (!jQuery('.safe-for-later a.product_' + id).hasClass('disabled')) {
        var list = new cookieList("cookie_products");
        jQuery('.save-product').addClass('disabled');
        jQuery('.safe-for-later a.product_' + id).parent().find('.ajax-loading-img').fadeIn();

        jQuery.ajax({
                type: 'POST',
                url: MyAjax.ajaxurl,
                data: '&action=add_to_wishlist&product_id=' + id,
                success: function (response) {
                    var json = eval("(" + response + ")");
                    if (json.product_row && json.product_row !== '') {
                        list.add(id);
                        var the_content_obj = json.product_row;
                        jQuery('.safe-for-later a.product_' + id).hide();
                        jQuery('.safe-for-later a.product_' + id).parent().find('.browse_wishlist').show();
                    }

                    var loading = jQuery('.ajax-loading-img');
                    loading.fadeOut();
                    jQuery('.save-product').removeClass('disabled');
                },
                error: function (xhr) {
                    jQuery('.save-product').removeClass('disabled');
                }

            });

    }
}
//handles ajax call remove from wishlist

function remove_from_wishlist(rowid) {
    if (!jQuery('.product-remove a.product_' + rowid).hasClass('disabled')) {

        jQuery('.remove').addClass('disabled');
        var list = cookieList("cookie_products");

        jQuery('.product-remove').parent('#rowid_' + rowid).find('.ajax-loading-img').fadeIn();
        jQuery.ajax({
                type: 'GET',
                url: MyAjax.ajaxurl,
                data: '&action=remove_from_wishlist&product_id=' + rowid,
                success: function (response) {
                    var json = eval("(" + response + ")");
                    list.remove(rowid);
                    jQuery("#rowid_" + rowid).remove();
                    if (list.items().length === 0) {
                        jQuery('.wishlist_table tbody').append(json.no_prod);
                    }

                    var loading = jQuery('.ajax-loading-img');
                    loading.fadeOut();
                    jQuery('.remove').removeClass('disabled');
                },
                error: function (xhr) {
                    jQuery('.remove').removeClass('disabled');
                }

            });
    }
}


jQuery(window).resize(function(){
    setTimeout(function() {
        cosmoFacebookResponsive ();
    }, 500);
});

  
function cosmoFacebookResponsive (){
    if (jQuery('.single-facebook-comments').length > 0 && jQuery('.single-facebook-comments').attr('width') != jQuery('.single-facebook-comments').parent().width() ) { 
      var url_cosmo_coment = jQuery('.single-facebook-comments').attr('href');
      jQuery('.single-facebook-comments').remove();
      jQuery('<fb:comments href="' + url_cosmo_coment + '" num_posts="5" width="' + jQuery('.cosmo-comments').width() + '" height="120" class="single-facebook-comments" reverse="true"></fb:comments>').appendTo('.cosmo-comments');
      FB.XFBML.parse();
    }

}
jQuery(window).load(function(){
  jQuery( '.tabment-tabs li a' ).click( function(){
    initHoverEffectForThumbView();
  });
});

window.onload = function(){
    if (jQuery('#maximage').length > 0) {
        jQuery('#show-gal-slideshow').click(function(){
            var $slideshow =  jQuery('.slideshow-gal-full');
            jQuery('.container').append($slideshow);
            jQuery('.container > .slideshow-gal-full').fadeIn('slow');


            // Trigger maximage
            // Must be called with "try" and "catch" as it throws an error. To be revised.
      
            try {
              jQuery('#maximage').maximage({
                  cycleOptions: {
                      prev: '.prev-slide-image',
                      next: '.next-slide-image'
                  }
              });
            }
            catch(err) {
              // the library "maximage" has an error, so we'll just skip it, as the result works
            }

        });

    jQuery('.slide-close').click(function(){

        if ( jQuery('.slide-playpause').hasClass( 'icon-pause' ) ) {
            jQuery('.slide-playpause').click();
        }

        jQuery('.container > .slideshow-gal-full').fadeOut('slow');


    });

    jQuery('.slide-playpause').bind('click', function(e){
        
        jQuery('#maximage').cycle('toggle');

        jQuery('.slide-playpause').toggleClass( 'icon-pause icon-play' );        
    });

  }

    /**
    * Enabling pretty photo for Classic gallery
    **/

    if ( jQuery('.single-gallery.clasic .zoom-image').length > 0  && jQuery(document).width() > 767) { //if the gallery is Classic and the lightbox is enabled
        Galleria.on('image', function(e) {
            //console.log(e);
            var imageurl = e.galleriaData.big;
            var imagetitle = e.galleriaData.title; // change "title" into "description" to see caption in the Pretty Photo
            jQuery('.zoom-image a').attr('href', imageurl);
            jQuery('.zoom-image a').attr('title', imagetitle);
            jQuery('.zoom-image a').attr('data-rel', e.index);
            jQuery('.galleria-container .galleria-images .galleria-image img').click(function(e){
                jQuery('.zoom-image a').click();
            });

        });
    }

}

    jQuery(document).ready(function () {
      
        // Check if WooCommerce is enabled
        if (cosmo_woocommerce_cripts.is_enabled) { 

            jQuery('.initiate-checkout').click(function(){
              jQuery('.checkout-button.wc-forward').click();
            });

            // Must be called with "try" and "catch" as it throws an error. To be revised.
            try {
              if ( jQuery(window).width() > 768 ) {
                jQuery('.woocommerce-ordering select, .shipping-calculator-form select, #billing_country, #shipping_country, .widget select, #calc_shipping_state').chosen();
              }
            }

            catch(err) {
              // the library "chosen" has an error, so we\ll just skip it, as the result works
            }
        }

        // if the custom link to the post thumbnail is an image, open it to in Pretty Photo
        if (prettyPhoto_enb.enb_lightbox) {
          jQuery('.featimg > a[href], .thumb-view a.thumb-hover-link, .mosaic-view a.mosaic-hover-link').filter(function() {
            return /(jpg|gif|png)$/.test(jQuery(this).attr('href'))
            }).prettyPhoto();
        }

    });

    // Enabling the slideshow button
    jQuery(window).load(function(){
      if(jQuery('#maximage').length){
        jQuery('#show-gal-slideshow').click(function(){
          jQuery('#maximage img').each(function(){
            var link = jQuery(this).attr('data-src');
            jQuery(this).attr('src', link);
          });
        });
      }
    });

    // Content gets padding if header is sticky
    jQuery(window).ready(function(){
      if ( jQuery( '#header-container' ).hasClass( 'sticky-header' ) ){
          jQuery('.sticky-header').css('position','fixed');
          jQuery('.sticky-header-delimiter').css('height', jQuery('.sticky-header').height());
          jQuery('.sticky-header-delimiter').removeClass('hidden');
      }
        //Mobile menu swiping
        if ( ! jQuery( 'body' ).hasClass( 'single-gallery', 'sly' ) && is_mobile.logic && jQuery('.small-device-nav').hasClass('swipe') )  {
            (function ($) {
                var myElement = document.getElementById('page');
                var mc = new Hammer(myElement);
                mc.get('pan').set({ threshold:150});
                mc.on("panleft", function(ev) {
                    $.pageslide.close();
                });
                mc.on("panright", function(ev) {
                    if(!$('#small-device-nav').is(':visible') && !$('.header-collapser').is(':visible')) return;
                    $.pageslide({ href: $('.small-device-menu-link').attr('href') });
                });
            }) ( jQuery );
        }
    });
  //lazy loading for vertical scroll gallery
  if ( jQuery('body.single-gallery.vertical-scroll').length > 0 ) {
    jQuery(window).ready(function(){
      var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0)
      var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0)
      var d = jQuery(document).scrollTop();

      jQuery.each(jQuery(".vertical-gallery .vertical-image"),function(){
          p = jQuery(this).position();
          if (p.top > h + d || p.top > h - d){
              jQuery(this).find('.slide-image').addClass('lazy').removeAttr('src');
              //jQuery(this).find('.slide-image').removeAttr('src');
          };
      });
      jQuery("img.lazy").lazyload();
    });
  }
  if (jQuery('body').hasClass('single-gallery') && jQuery(window).width() < 768 ){
    jQuery('.mobile-info').click(function(){
      jQuery(".gallery-info").toggleClass('view-info');
    });
  }
  
    
  






















