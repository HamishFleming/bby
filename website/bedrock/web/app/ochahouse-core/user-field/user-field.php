<?php 

    add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
    add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );
    
    function save_extra_user_profile_fields( $user_id ) {
        if ( empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'update-user_' . $user_id ) ) {
            return;
        }
        
        if ( !current_user_can( 'edit_user', $user_id ) ) { 
            return false; 
        }

		foreach($_POST as $key => $value) {

            if(strstr($key, 'multiple_taxonomy_')) {
			        $key = str_replace('multiple_taxonomy_', '', $key);
                    update_user_meta( $user_id, $key, $value);
			}elseif(strstr($key, 'checkbox_')) {
			        $key = str_replace('checkbox_', '', $key);
			        update_user_meta( $user_id, $key, $value); 
                   
			}else {
			    if(strstr($key, 'gallery_')) {
			       $key = str_replace('gallery_', '', $key);  
			       $value = explode(",",$value);
                   $value = array_values(array_filter($value));   
		      	}
				update_user_meta($user_id, $key, $value);
			}
		}
    }


    add_action( 'show_user_profile', 'extra_user_profile_fields' );
    add_action( 'edit_user_profile', 'extra_user_profile_fields' );
    
    function extra_user_profile_fields( $user ) { ?>
        <h3><?php _e("Extra profile information", "blank"); ?></h3>
    
        <table class="form-table">
        <tr>
            <th><label for="dealer-logo"><?php echo esc_html__("Dealer logo.","idealauto"); ?></label></th>
            <td>
                <?php 
                    jws_user_filed_images(
                      array(
                        'id' => 'dealer-avatar'
                      ),  
                      $user  
                    )
                ?>
                <p class="description"><?php echo esc_html__("Please enter user logo.","idealauto"); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="dealer_phone"><?php echo esc_html__("Dealer Phone.","idealauto"); ?></label></th>
            <td>
                <input type="text" name="dealer_phone" id="dealer_phone" value="<?php echo esc_attr( get_the_author_meta( 'dealer_phone', $user->ID ) ); ?>" /><br />
                <p class="description"><?php echo esc_html__("Please enter user phone.","idealauto"); ?></p>                                                                                         
            </td>
        </tr>
        <tr>
        <th><label for="dealer_location"><?php echo esc_html__("Dealer Location","idealauto"); ?></label></th>
            <td>
                <?php 
                    jws_user_filed_maps(
                      array(
                        'id' => 'dealer_location'
                      ),  
                      $user  
                    )
                ?>
                <p class="description"><?php echo esc_html__("Please enter user location.","idealauto"); ?></p>   
            </td>
        </tr>
        <tr>
        <th><label for="dealer_images"><?php echo esc_html__("Dealer Gallery","idealauto"); ?></label></th>
            <td>
                <?php 
                    jws_user_filed_gallery(
                      array(
                        'id' => 'dealer_images'
                      ),  
                      $user  
                    )
                ?>
                <p class="description"><?php echo esc_html__("Please enter user gallery.","idealauto"); ?></p>   
            </td>
        </tr>
       
        <?php 
            $social_user = array(
                'dealer_facebook' => esc_html__("Dealer Facebook","idealauto"),
                'dealer_twitter' => esc_html__("Dealer Twitter","idealauto"),
                'dealer_whatsapp' => esc_html__("Dealer Whatsapp","idealauto"),
                'dealer_instagram' => esc_html__("Dealer Instagram","idealauto"),
            
            );
            foreach ($social_user as $slug => $label) { ?>
                 <tr class="jws_theme_metabox_field">
                    <th><label for="<?php echo esc_attr($slug); ?>"><?php echo ''.$label; ?></label></th>
                    <td>
                        <input type="text" name="<?php echo esc_attr($slug); ?>" id="<?php echo esc_attr($slug); ?>" value="<?php echo esc_attr( get_the_author_meta( $slug, $user->ID ) ); ?>" /><br />
                        <p class="description"><?php echo esc_html__("Please Enter ","idealauto").$label; ?>.</p>                                                                                         
                    </td>
                </tr>
            <?php } ?>
            <tr class="jws_theme_metabox_field">
            <th><label for="open_time"><?php echo esc_html__("Open Time","idealauto"); ?> </label></th>
            <td>
            <?php 
            $open_time_list = array(
                'monday' => esc_html__("Monday","idealauto"),
                'tuesday' => esc_html__("Tuesday","idealauto"),
                'wednesday' => esc_html__("Wednesday","idealauto"),
                'thursday' => esc_html__("Thursday","idealauto"),
                'friday' => esc_html__("Friday","idealauto"),
                'saturday' => esc_html__("Saturday","idealauto"),
                'sunday' => esc_html__("Sunday","idealauto"),
            );
            foreach ($open_time_list as $slug => $label) { ?>
  
                       <p>
                        <label for="<?php echo esc_attr($slug); ?>"><?php echo ''.$label; ?></label>
                        <input type="text" name="<?php echo esc_attr($slug); ?>" id="<?php echo esc_attr($slug); ?>" value="<?php echo esc_attr( get_the_author_meta( $slug, $user->ID ) ); ?>" />
                      </p>                                                                                       
                    
                
            <?php } ?>
            </td>
            </tr>
            <tr>
            <th><label for="banner"><?php echo esc_html__("Banner.","idealauto"); ?></label></th>
                <td>
                    <?php 
                        jws_user_filed_images(
                          array(
                            'id' => 'banner'
                          ),  
                          $user  
                        )
                    ?>
                    <p class="description"><?php echo esc_html__("Please enter user banner.","idealauto"); ?></p>
                </td>
            </tr>
            <tr>
            <th><label for="banner_url"><?php echo esc_html__("Banner Url","idealauto"); ?></label></th>
            <td>
                <input type="text" name="banner_url" id="banner_url" value="<?php echo esc_attr( get_the_author_meta( 'banner_url', $user->ID ) ); ?>" /><br />
                <p class="description"><?php echo esc_html__("Please enter user banner url.","idealauto"); ?></p>                                                                                         
            </td>
        </tr>    
        </table>
    <?php }
    


    
function jws_user_filed_images($arg , $user) {
   $id = isset($arg['id']) ? $arg['id'] : 'image';
   $label = isset($arg['label']) ? $arg['label'] : '';
   $desc = isset($arg['desc']) ? $arg['desc'] : '';
            
    if(!isset($user->ID)) {
      $id_filed = '';   
    }else {
      $id_filed = $user->ID;   
    }

    $default = get_the_author_meta( $id , $id_filed );

    $html = '<div class="form-field term-image-wrap">';
	$html .= '<div><ul class="misha_images_mtb">';
	/* array with image IDs for hidden field */
	$hidden = array();
 
    
      if( $images = get_posts( array(
    		'post_type' => 'attachment',
    		'orderby' => 'post__in', /* we have to save the order */
    		'order' => 'ASC',
    		'post__in' => explode(",",$default), /* $value is the image IDs comma separated */
    		'numberposts' => -1,
    		'post_mime_type' => 'image'
    	) ) ) {
     
    		foreach( $images as $image ) {
    			$hidden[] = $image->ID;
    			$image_src = wp_get_attachment_image_src( $image->ID, 'full' );
    			$html .= '<li data-id="' . $image->ID .  '"><span><img src="'.$image_src[0].'" alt="images"></span><a href="#" class="misha_images_remove"><i class="jws-icon-icon_close-1"></i></a></li>';
    		}
     
    	}  
  
	
 
	$html .= '</ul><div style="clear:both"></div></div>';
	$html .= '<input type="hidden" name="'.$id.'" value="' . join(',',$hidden) . '" /><a href="#" class="button misha_upload_images_button">'.esc_html__('Add Images','idealauto').'</a></div>';
 
	echo $html;
}    

function jws_user_filed_maps($arg , $user) { 
  	   global $post;
        
       $address = ''; 
       $short_address = '';
       $lat = '43.656081'; 
       $lng = '-79.380171';
        
       $id = isset($arg['id']) ? $arg['id'] : '';
       $label = isset($arg['label']) ? $arg['label'] : '';
       $desc = isset($arg['desc']) ? $arg['desc'] : '';

       if(!isset($user->ID)) {
          $id_filed = '';   
        }else {
          $id_filed = $user->ID;   
        }

        $value = get_the_author_meta( $id , $id_filed );
        if(!empty($value)) {
            $address = $value['address'];
            $lat = $value['lat']; 
            $lng = $value['lng'];
        }
        
 
        $html = '';
        $html .= '<div id="jws_theme_metabox_field_'.$id.'" class="jws_theme_metabox_field">';
        $html .= '<div class="map_container">';
            $html .= '<input id="map-input" class="controls" type="text" value="'.esc_attr($address).'" placeholder="'.esc_html_e( "Enter a location", "idealauto" ).'">';
               $html .= '<input id="cordinats2" type="hidden" value="'.esc_attr( $lat.','.$lng ).'"/>';
    
               $html .= ' <input id="formatted_address" data-geo="formatted_address"  name="'.$id.'[address]"  type="hidden" value="'.esc_attr($address ).'">';

    
               $html .= ' <input type="hidden" id="location_lon" name="'.$id.'[lng]" value="'.esc_attr( $lng ).'">';
               
               $html .= ' <input type="hidden" id="location_lat" name="'.$id.'[lat]" value="'.esc_attr( $lat ).'">';
            $html .= '<div style="height: 500px;" id="map-canvas"></div>';
        $html .= '</div>';
        $html .= '</div>';
		echo $html;   
}

function jws_user_filed_gallery($arg , $user) {  
   
       global $post;
       $id = isset($arg['id']) ? $arg['id'] : '';
       $label = isset($arg['label']) ? $arg['label'] : '';
       $desc = isset($arg['desc']) ? $arg['desc'] : '';
        
        if(!isset($user->ID)) {
          $id_filed = '';   
        }else {
          $id_filed = $user->ID;   
        }
    
        $default = get_the_author_meta( $id , $id_filed );

      
                $html = '<div id="jws_theme_metabox_field_'.$id.'" class="jws_theme_metabox_field">';
                 $html .= '<div><label for="' . $id . '">';
        		$html .= $label;
        		$html .= '</label>';
            	$html .= '<ul class="misha_gallery_mtb">';
               
            	/* array with image IDs for hidden field */
            	$hidden = array();
             
                  if(!empty($default)) {
                    if( $images = get_posts( array(
                		'post_type' => 'attachment',
                		'orderby' => 'post__in', /* we have to save the order */
                		'order' => 'ASC',
                		'post__in' => $default, /* $value is the image IDs comma separated */
                		'numberposts' => -1,
                		'post_mime_type' => 'image'
                	) ) ) {
                 
                		foreach( $images as $image ) {
                			$hidden[] = $image->ID;
                			$image_src = wp_get_attachment_image_src( $image->ID, 'full' );
                			$html .= '<li data-id="' . $image->ID .  '"><span><img src="'.$image_src[0].'" alt="images"></span><a href="#" class="misha_gallery_remove"><i class="jws-icon-icon_close-1"></i></a></li>';
                		}
                 
                	} 
                  }  

            	$html .= '</ul><div style="clear:both"></div></div>';
            	$html .= '<input type="hidden" name="gallery_'.$id.'" value="' . join(',',$hidden) . '" /><a href="#" class="button misha_upload_gallery_button">'.esc_html__('Add Gallery','idealauto').'</a>';
                $html .= '</div>';
            	echo $html; 
    
    
}
