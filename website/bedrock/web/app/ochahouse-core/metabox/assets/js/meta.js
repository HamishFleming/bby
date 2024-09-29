
/*
 * A custom function that checks if element is in array, we'll need it later
 */
function in_array(el, arr) {
	for(var i in arr) {
		if(arr[i] == el) return true;
	}
	return false;
}
 
jQuery( function( $ ) {
    
    function field_gallery() {
       /*
    	 * Sortable images
    	 */
    	$('ul.misha_gallery_mtb').sortable({
    		items:'li',
    		cursor:'-webkit-grabbing', /* mouse cursor */
    		scrollSensitivity:40,
    		/*
    		You can set your custom CSS styles while this element is dragging
    		start:function(event,ui){
    			ui.item.css({'background-color':'grey'});
    		},
    		*/
    		stop:function(event,ui){
    			ui.item.removeAttr('style');
     
    			var sort = new Array(), /* array of image IDs */
    			    gallery = $(this); /* ul.misha_gallery_mtb */
     
    			/* each time after dragging we resort our array */
    			gallery.find('li').each(function(index){
    				sort.push( $(this).attr('data-id') );
    			});
    			/* add the array value to the hidden input field */
    			gallery.parent().next().val( sort.join() );
    			/* console.log(sort); */
    		}
    	});
    	/*
    	 * Multiple images uploader
    	 */
    	$('.misha_upload_gallery_button').click( function(e){ /* on button click*/
    		e.preventDefault();
    
    		var button = $(this),
    		    hiddenfield = button.prev(),
    		    hiddenfieldvalue = hiddenfield.val().split(","), /* the array of added image IDs */
    	    	    custom_uploader = wp.media({
    			title: 'Insert images', /* popup title */
    			library : {type : 'image'},
    			button: {text: 'Use these images'}, /* "Insert" button text */
    			multiple: true
    		    }).on('select', function() {
     
    			var attachments = custom_uploader.state().get('selection').map(function( a ) {
    				a.toJSON();
                			return a;
    			}),
    			thesamepicture = false,
    			i;
                
            
     
    			/* loop through all the images */
              		for (i = 0; i < attachments.length; ++i) {
     
    				/* if you don't want the same images to be added multiple time */
    				if( !in_array( attachments[i].id, hiddenfieldvalue ) ) {
     
    					/* add HTML element with an image */
    					$('ul.misha_gallery_mtb').append('<li data-id="' + attachments[i].id + '"><span><img src="' + attachments[i].attributes.url + '"></span><a href="#" class="misha_gallery_remove">×</a></li>');
    					/* add an image ID to the array of all images */
    					hiddenfieldvalue.push( attachments[i].id );
                        hiddenfieldvalue = hiddenfieldvalue.filter((item) => item);
    				} else {
    					thesamepicture = true;
    				}
              		}
                    
                        console.log(hiddenfieldvalue.join());
    			/* refresh sortable */
    			$( "ul.misha_gallery_mtb" ).sortable( "refresh" );
    			/* add the IDs to the hidden field value */
    			hiddenfield.val( hiddenfieldvalue.join() );
    			/* you can print a message for users if you want to let you know about the same images */
    			if( thesamepicture == true ) alert('The same images are not allowed.');
    		}).open();
    	});
     
    	/*
    	 * Remove certain images
    	 */
    	$('body').on('click', '.misha_gallery_remove', function(){
    		var id = $(this).parent().attr('data-id'),
    		    gallery = $(this).parent().parent(),
    		    hiddenfield = gallery.parent().next(),
    		    hiddenfieldvalue = hiddenfield.val().split(","),
    		    i = hiddenfieldvalue.indexOf(id);
     
    		$(this).parent().remove();
  
    		/* remove certain array element */
    		if(i != -1) {
    			hiddenfieldvalue.splice(i, 1);
    		}
  
    		/* add the IDs to the hidden field value */
    		hiddenfield.val( hiddenfieldvalue.join() );
     
    		/* refresh sortable */
    		gallery.sortable( "refresh" );
     
    		return false;
    	});
    	/*
    	 * Selected item
    	 */
    	$('body').on('mousedown', 'ul.misha_gallery_mtb li', function(){
    		var el = $(this);
    		el.parent().find('li').removeClass('misha-active');
    		el.addClass('misha-active');
    	}); 
    }
    field_gallery();
    function field_images() { 
       	$('.misha_upload_images_button').click( function(e){ /* on button click*/
    		e.preventDefault();
    		var button = $(this),
    		    hiddenfield = button.prev(),
    		    hiddenfieldvalue = hiddenfield.val(), /* the array of added image IDs */
    	    	    custom_uploader = wp.media({
    			title: 'Insert images', /* popup title */
    			library : {type : 'image'},
    			button: {text: 'Use these images'}, /* "Insert" button text */
    			multiple: false
    		    }).on('select', function() {
     
    			var attachments = custom_uploader.state().get('selection').map(function( a ) {
    				a.toJSON();
                			return a;
    			}),
    			thesamepicture = false;
 
				/* if you don't want the same images to be added multiple time */
				if( attachments[0].id != hiddenfieldvalue ) {
 
					/* add HTML element with an image */
				button.parents('.term-image-wrap').find('ul.misha_images_mtb').html('<li data-id="' + attachments[0].id + '"><span><img src="' + attachments[0].attributes.url + '"></span><a href="#" class="misha_images_remove">×</a></li>');
					/* add an image ID to the array of all images */
					hiddenfieldvalue =  attachments[0].id ;
				} else {
					thesamepicture = true;
				}
           
    			/* add the IDs to the hidden field value */
    			hiddenfield.val( hiddenfieldvalue );
    			/* you can print a message for users if you want to let you know about the same images */
    			if( thesamepicture == true ) alert('The same images are not allowed.');
    		}).open();
    	});  
        	/*
    	 * Remove certain images
    	 */
    	$('body').on('click', '.misha_images_remove', function(){
    		var 
    		    images = $(this).parent().parent(),
    		    hiddenfield = images.parent().next();
    
    		   
     
    		$(this).parent().remove();
     
    	
    		/* add the IDs to the hidden field value */
    		hiddenfield.val('');
  
     
    		return false;
    	});     
    }
    field_images();
    
    function field_upload() {
        	$('.misha_upload_file_button').click( function(e){ /* on button click*/
    		e.preventDefault();
    		var button = $(this),
    		    hiddenfield = button.prev(),
                type = button.data('type'),
    		    hiddenfieldvalue = hiddenfield.val(), /* the array of added image IDs */
    	    	    custom_uploader = wp.media({
    			title: 'Insert file', /* popup title */
    			library : {type :  type},
    			button: {text: 'Use these file'}, /* "Insert" button text */
    			multiple: false
    		    }).on('select', function() {
 
    			var attachments = custom_uploader.state().get('selection').map(function( a ) {
    				a.toJSON();
                			return a;
    			}),
        
    			thesamepicture = false;
            
 
				/* if you don't want the same file to be added multiple time */
				if( attachments[0].id != hiddenfieldvalue ) {
 
					/* add HTML element with an image */
					$('ul.misha_file_mtb').html('<li data-id="' + attachments[0].id + '"><div class="file-info"><p class="file-name"><strong>File name:</strong>' + attachments[0].attributes.filename + '</p><p class="file-type"><strong>File type:</strong>' + attachments[0].attributes.mime + '</p></div><a href="#" class="misha_file_remove">×</a></li>');
					/* add an image ID to the array of all file */
					hiddenfieldvalue =  attachments[0].id ;
				} else {
					thesamepicture = true;
				}
           
    			/* add the IDs to the hidden field value */
    			hiddenfield.val( hiddenfieldvalue );
    			/* you can print a message for users if you want to let you know about the same file */
    			if( thesamepicture == true ) alert('The same file are not allowed.');
    		}).open();
            console.log(type);
    	});  
        
            
        	/*
    	 * Remove certain file
    	 */
    	$('body').on('click', '.misha_file_remove', function(){
    		var 
    		    file = $(this).parent().parent(),
    		    hiddenfield = file.parent().next();
    
    		   
     
    		$(this).parent().remove();
     
    	
    		/* add the IDs to the hidden field value */
    		hiddenfield.val('');
  
     
    		return false;
    	}); 
    }
    field_upload();
    
    function field_checkbox() { 
        $('.filed-checkbox').on('change',function(){
          var isChecked=$(this).is(":checked");
          
              $(this).next().val(isChecked?'1':'0');
        });
    }
    field_checkbox();
    
    function field_checkbox_munti() { 
        $('.filed-checkbox-munti').on('change',function(){
          var isChecked=$(this).is(":checked"),
          value = $(this).val(),
          hidden_filed =  $(this).parents('.jws_theme_metabox_field').find('.checkbox-munti-value'),
          hiddenvalue = hidden_filed.val().split(",");
          $total_id = '';  
            
            if(isChecked) {
               hiddenvalue.push(value ); 
            }else {
                hiddenvalue.pop(value ); 
            }
            
            console.log(hiddenvalue.join());
            
            hidden_filed.val(hiddenvalue.join());
       
        });
    }
    field_checkbox_munti();
   
    
    function field_map() { 
          if($('#map-canvas').length < 1 ){
            return false;
          }  
    

                    var latitude = jQuery('.location_lon').val();
                    var longitude = jQuery('.location_lat').val()


                    var latlng = jQuery("#cordinats2").val();
                    if (latlng != undefined && latlng.length > 10) {
                        re = /\s*,\s*/;
                        arr = latlng.split(re);
                        var myLatLng = {lat: parseFloat(arr[0]), lng: parseFloat(arr[1])};
                        latitude = parseFloat(arr[0]);
                        longitude = parseFloat(arr[1]);
                    }


                    var mapOptions = {center: new google.maps.LatLng(latitude, longitude), zoom: 17};
                    var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

                    if (latlng != undefined && latlng.length > 10) {

                        var marker2 = new google.maps.Marker({
                            position: myLatLng,
                            map: map,
                            draggable: true,
                            title: ''
                        });

                        google.maps.event.addListener(marker2, "drag", function () {
                            jQuery.getJSON("http://maps.googleapis.com/maps/api/geocode/json?latlng=" + marker2.getPosition().lat() + "," + marker2.getPosition().lng() + "&sensor=true_or_false", function (data, textStatus) {
                                var adress1 = data.results[0].formatted_address;
                                infowindow.setContent("<div><strong>" + adress1 + "</strong><br>" + data.results[1].formatted_address);
                                jQuery("#formatted_address").val(adress1);
                                jQuery("#location_lon").val(marker2.getPosition().lng());
                                jQuery("#location_lat").val(marker2.getPosition().lat());

                                jQuery("#cordinats2").val(marker2.getPosition().lat() + "," + marker2.getPosition().lng());

                            });
                            infowindow.open(map, marker);
                        });
                    }
                   
                    var input = (document.getElementById("map-input"));
                    var types = document.getElementById("type-selector");
                   // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                    //map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);
                    var autocomplete = new google.maps.places.Autocomplete(input);
                    autocomplete.bindTo("bounds", map);
                    var infowindow = new google.maps.InfoWindow();
                    var marker = new google.maps.Marker({
                        map: map,
                        draggable: true,
                        anchorPoint: new google.maps.Point(0, -29)
                    });


                    google.maps.event.addListener(autocomplete, "place_changed",
                        function () {

                            infowindow.close();
                            marker.setVisible(false);
                            var place = autocomplete.getPlace();
                            if (!place.geometry) {
                                return;
                            }


                            if (place.geometry.viewport) {
                                map.fitBounds(place.geometry.viewport);
                            } else {
                                map.setCenter(place.geometry.location);
                                map.setZoom(17);
                            }

                            marker.setIcon(({
                                url: place.icon,
                                size: new google.maps.Size(71, 71),
                                origin: new google.maps.Point(0, 0),
                                anchor: new google.maps.Point(17, 34),
                                scaledSize: new google.maps.Size(35, 35)
                            }));
                            marker.setPosition(place.geometry.location);
                            marker.setVisible(true);

                            jQuery("#location_lon").val(place.geometry.location.lng());
                            jQuery("#location_lat").val(place.geometry.location.lat());

                            var crtt = place.geometry.location.lat() + "," + place.geometry.location.lng();
                            
                            console.log(place);
                            
                            var foradre = place.formatted_address;
                            jQuery("#cordinats2").val(crtt);
                            jQuery("#cordinats2").trigger("change");
                            jQuery("#formatted_address").val(foradre);

                            var address = "";
                            if (place.address_components) {
                                address = [(place.address_components[0] && place.address_components[0].short_name || ""), (place.address_components[1] && place.address_components[1].short_name || ""), (place.address_components[2] && place.address_components[2].short_name || "")].join(" ");
                            }
                            infowindow.setContent("<div><strong>" + place.name + "</strong><br>" + address);
                            infowindow.open(map, marker);
                        }
                    );
                    /*************************/

                    google.maps.event.addListener(marker, "drag", function () {
                        jQuery.getJSON("http://maps.googleapis.com/maps/api/geocode/json?latlng=" + marker.getPosition().lat() + "," + marker.getPosition().lng() + "&sensor=true_or_false", function (data, textStatus) {
                            var adress1 = data.results[0].formatted_address;
                            infowindow.setContent("<div><strong>" + adress1 + "</strong><br>" + data.results[1].formatted_address);
                            jQuery("#formatted_address").val(adress1);
                            jQuery("#location_lon").val(marker.getPosition().lng());
                            jQuery("#location_lat").val(marker.getPosition().lat());

                            jQuery("#cordinats2").val(marker.getPosition().lat() + "," + marker.getPosition().lng());

                        });
                        infowindow.open(map, marker);
                    });


                    function setupClickListener(id, types) {
                        var radioButton = document.getElementById(id);
                        google.maps.event.addDomListener(radioButton, "click", function () {
                            autocomplete.setTypes(types);
                        });
                    }

                    //setupClickListener("changetype-all", []);
                    /* setupClickListener("changetype-address", ["address"]);
					 setupClickListener("changetype-establishment", ["establishment"]);
					 setupClickListener("changetype-geocode", ["geocode"]);*/

                    /****************************/


              
        
    }
    field_map();
   
    function meta_orther() { 
      if(typeof($.fn.wpColorPicker) != 'undefined') {
      	$('.jws-color-field').wpColorPicker();  
      } 
      
      if(typeof($.fn.tabs) != 'undefined') { 
         $( ".tabs" ).tabs(); 
      }
      
      $('.jws_theme_metabox_field select').select2(); 
     
    }   
     meta_orther();	
});
