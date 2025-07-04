var Cyber_Security_Services_Whizzie = (function($){
    var t;
	var current_step = '';
	var step_pointer = '';

    // callbacks from form button clicks.
    var callbacks = {
		cyber_security_services_do_next_step: function( btn ) {
			cyber_security_services_do_next_step( btn );
		},
        install_plugins: function(btn){
            var plugins = new cyber_security_services_PluginManager();
            plugins.init( btn );
        },
		cyber_security_services_install_widgets: function( btn ) {
			var widgets = new cyber_security_services_WidgetManager();
			widgets.init( btn );
		},
        cyber_security_services_install_content: function(btn){
            var content = new cyber_security_services_ContentManager();
            content.init( btn );
        }
    };

    function cyber_security_services_window_loaded() {
		var maxHeight = 0;
		
		$( '.whizzie-menu li.step' ).each( function( index ) {
			$(this).attr( 'data-height', $(this).innerHeight() );
			if( $(this).innerHeight() > maxHeight ) {
				maxHeight = $(this).innerHeight();
			}
		});
		
		$( '.whizzie-menu li .detail' ).each( function( index ) {
			$(this).attr( 'data-height', $(this).innerHeight() );
			$(this).addClass( 'scale-down' );
		});
		

		$( '.whizzie-menu li.step' ).css( 'height', '100%' );
		$( '.whizzie-menu li.step:first-child' ).addClass( 'active-step' );
		$( '.whizzie-nav li:first-child' ).addClass( 'active-step' );
		
		$( '.whizzie-wrap' ).addClass( 'loaded' );
		
        // init button clicks:
        $('.do-it').on( 'click', function(e) {
			e.preventDefault();
			step_pointer = $(this).data('step');
			current_step = $('.step-' + $(this).data('step'));
			$('.whizzie-wrap').addClass( 'spinning' );
            if($(this).data('callback') && typeof callbacks[$(this).data('callback')] != 'undefined'){
                // we have to process a callback before continue with form submission
                callbacks[$(this).data('callback')](this);
                return false;
            } else {
                cyber_security_services_loading_content();
                return true;
            }
        });
        $('.button-upload').on( 'click', function(e) {
            e.preventDefault();
            renderMediaUploader();
        });
        $('.theme-presets a').on( 'click', function(e) {
            e.preventDefault();
            var $ul = $(this).parents('ul').first();
            $ul.find('.current').removeClass('current');
            var $li = $(this).parents('li').first();
            $li.addClass('current');
            var newcolor = $(this).data('style');
            $('#new_style').val(newcolor);
            return false;
        });
    }

    function cyber_security_services_loading_content(){}
	
    function cyber_security_services_do_next_step( btn ) {
		current_step.removeClass( 'active-step' );
		$( '.nav-step-' + step_pointer ).removeClass( 'active-step' );
		current_step.addClass( 'done-step' );
		$( '.nav-step-' + step_pointer ).addClass( 'done-step' );
		current_step.fadeOut( 500, function() {
			current_step = current_step.next();
			step_pointer = current_step.data( 'step' );
			current_step.fadeIn();
			current_step.addClass( 'active-step' );
			$( '.nav-step-' + step_pointer ).addClass( 'active-step' );
			$('.whizzie-wrap').removeClass( 'spinning' );
		});
    }

    function cyber_security_services_PluginManager(){

        var complete;
        var items_completed = 0;
        var current_item = '';
        var $current_node;
        var current_item_hash = '';
		
        function ajax_callback(response){
            if(typeof response == 'object' && typeof response.message != 'undefined'){
                $current_node.find('span').text(response.message);
                if(typeof response.url != 'undefined'){
                    // we have an ajax url action to perform.

                    if(response.hash == current_item_hash){
                        $current_node.find('span').text("failed");
                        cyber_security_services_find_next();
                    }else {
                        current_item_hash = response.hash;
                        jQuery.post(response.url, response, function(response2) {
                            cyber_security_services_process_current();
                            $current_node.find('span').text(response.message + whizzie_params.verify_text);
                        }).fail(ajax_callback);
                    }

                }else if(typeof response.done != 'undefined'){
                    // finished processing this plugin, move onto next
                    cyber_security_services_find_next();
                }else{
                    // error processing this plugin
                    cyber_security_services_find_next();
                }
            }else{
                // error - try again with next plugin
                $current_node.find('span').text("ajax error");
                cyber_security_services_find_next();
            }
        }
        function cyber_security_services_process_current() {
            if(current_item){
                // query our ajax handler to get the ajax to send to TGM
                // if we don't get a reply we can assume everything worked and continue onto the next one.
                jQuery.post(whizzie_params.ajaxurl, {
                    action: 'setup_plugins',
                    wpnonce: whizzie_params.wpnonce,
                    slug: current_item
                }, ajax_callback).fail(ajax_callback);
            }
        }
        function cyber_security_services_find_next(){
            var do_next = false;
            if($current_node){
                if(!$current_node.data('done_item')){
                    items_completed++;
                    $current_node.data('done_item',1);
                }
                $current_node.find('.spinner').css('visibility','hidden');
            }
            var $li = $('.whizzie-do-plugins li');
            $li.each(function(){
                if(current_item == '' || do_next){
                    current_item = $(this).data('slug');
                    $current_node = $(this);
                    cyber_security_services_process_current();
                    do_next = false;
                }else if($(this).data('slug') == current_item){
                    do_next = true;
                }
            });
            if(items_completed >= $li.length){
                // finished all plugins!
                complete();
            }
        }
        
        return {
            init: function(btn){
                $('.envato-wizard-plugins').addClass('installing');
                complete = function(){
                    cyber_security_services_do_next_step();
                };
                cyber_security_services_find_next();
            }
        }
    }
	
	function cyber_security_services_WidgetManager() {
		function cyber_security_services_import_widgets(){
            jQuery.post(
				whizzie_params.ajaxurl,
				{
					action: 'cyber_security_services_setup_widgets',
					wpnonce: whizzie_params.wpnonce
				},
				complete
			);
		}
		return {
			init: function( btn ) {
				complete = function() {
					cyber_security_services_do_next_step();
				}
				cyber_security_services_import_widgets();
			}
		}
	}

    function cyber_security_services_ContentManager(){

        var complete;
        var items_completed = 0;
        var current_item = '';
        var $current_node;
        var current_item_hash = '';

        function ajax_callback(response) {
            if(typeof response == 'object' && typeof response.message != 'undefined'){
                $current_node.find('span').text(response.message);
                if(typeof response.url != 'undefined'){
                    // we have an ajax url action to perform.
                    if(response.hash == current_item_hash){
                        $current_node.find('span').text("failed");
                        cyber_security_services_find_next();
                    }else {
                        current_item_hash = response.hash;
                        jQuery.post(response.url, response, ajax_callback).fail(ajax_callback); // recuurrssionnnnn
                    }
                }else if(typeof response.done != 'undefined'){
                    // finished processing this plugin, move onto next
                    cyber_security_services_find_next();
                }else{
                    // error processing this plugin
                    cyber_security_services_find_next();
                }
            }else{
                // error - try again with next plugin
                $current_node.find('span').text("ajax error");
                cyber_security_services_find_next();
            }
        }

        function cyber_security_services_process_current(){
            if(current_item){

                var $check = $current_node.find('input:checkbox');
                if($check.is(':checked')) {
                    // process htis one!
                    jQuery.post(whizzie_params.ajaxurl, {
                        action: 'envato_setup_content',
                        wpnonce: whizzie_params.wpnonce,
                        content: current_item
                    }, ajax_callback).fail(ajax_callback);
                }else{
                    $current_node.find('span').text("Skipping");
                    setTimeout(cyber_security_services_find_next,300);
                }
            }
        }
        

        return {
            init: function(btn){
                $('.envato-setup-pages').addClass('installing');
                $('.envato-setup-pages').find('input').prop("disabled", true);
                complete = function(){
                    cyber_security_services_loading_content();
                    window.location.href=btn.href;
                };
                cyber_security_services_find_next();
            }
        }
    }

    /**
     * Callback function for the 'click' event of the 'Set Footer Image'
     * anchor in its meta box.
     *
     * Displays the media uploader for selecting an image.
     *
     * @since 0.1.0
     */
    function renderMediaUploader() {
        'use strict';

        var file_frame, attachment;

        if ( undefined !== file_frame ) {
            file_frame.open();
            return;
        }

        file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Upload Logo',//jQuery( this ).data( 'uploader_title' ),
            button: {
                text: 'Select Logo' //jQuery( this ).data( 'uploader_button_text' )
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });

        // When an image is selected, run a callback.
        file_frame.on( 'select', function() {
            // We set multiple to false so only get one image from the uploader
            attachment = file_frame.state().get('selection').first().toJSON();

            jQuery('.site-logo').attr('src',attachment.url);
            jQuery('#new_logo_id').val(attachment.id);
            // Do something with attachment.id and/or attachment.url here
        });
        // Now display the actual file_frame
        file_frame.open();

    }

    return {
        init: function(){
			t = this;
			$(cyber_security_services_window_loaded);
        },
        callback: function(func){
            console.log(func);
            console.log(this);
        }
    }

})(jQuery);

Cyber_Security_Services_Whizzie.init();

jQuery(document).ready(function(){

    jQuery('#cyber-security-services-demo-setup-guid .cyber-security-services-setup-menu').attr("checked","checked");

    jQuery('#cyber-security-services-setup-menu').click(function(){
        jQuery('#cyber-security-services-demo-setup-guid .cyber-security-services-setup-menu').css("display","block");
        jQuery('#cyber-security-services-demo-setup-guid .cyber-security-services-setup-contact').css("display","none");
        jQuery('#cyber-security-services-demo-setup-guid .cyber-security-services-setup-widget').css("display","none");
        jQuery('#cyber-security-services-demo-setup-guid .cyber-security-services-setup-social-icon').css("display","none");
    });

    jQuery('#cyber-security-services-setup-contact').click(function(){
        jQuery('#cyber-security-services-demo-setup-guid .cyber-security-services-setup-menu').css("display","none");
        jQuery('#cyber-security-services-demo-setup-guid .cyber-security-services-setup-contact').css("display","block");
        jQuery('#cyber-security-services-demo-setup-guid .cyber-security-services-setup-widget').css("display","none");
        jQuery('#cyber-security-services-demo-setup-guid .cyber-security-services-setup-social-icon').css("display","none");
    });

    jQuery('#cyber-security-services-setup-widget').click(function(){
        jQuery('#cyber-security-services-demo-setup-guid .cyber-security-services-setup-menu').css("display","none");
        jQuery('#cyber-security-services-demo-setup-guid .cyber-security-services-setup-contact').css("display","none");
        jQuery('#cyber-security-services-demo-setup-guid .cyber-security-services-setup-widget').css("display","block");
        jQuery('#cyber-security-services-demo-setup-guid .cyber-security-services-setup-social-icon').css("display","none");
    });

    jQuery('#cyber-security-services-setup-social').click(function(){
        jQuery('#cyber-security-services-demo-setup-guid .cyber-security-services-setup-menu').css("display","none");
        jQuery('#cyber-security-services-demo-setup-guid .cyber-security-services-setup-contact').css("display","none");
        jQuery('#cyber-security-services-demo-setup-guid .cyber-security-services-setup-widget').css("display","none");
        jQuery('#cyber-security-services-demo-setup-guid .cyber-security-services-setup-social-icon').css("display","block");
    });
});