<?php
class jws_theme_FrameworkMetaboxes {
	public function __construct(){
		global $smof_data;
		$this->data = $smof_data;
		add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
		add_action('save_post', array($this, 'save_meta_boxes'));
		add_action('admin_enqueue_scripts', array($this, 'admin_script_loader'));
	}
	function admin_script_loader() {
		global $pagenow;
		if (is_admin() && ($pagenow=='post-new.php' || $pagenow=='post.php' || $pagenow=='edit-tags.php' || $pagenow=='term.php' || $pagenow=='profile.php' || $pagenow=='user-edit.php' )) {
			wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('jquery-ui-sortable');
             wp_enqueue_style( 'jquery-ui-core', plugin_dir_url( __FILE__ ) . 'assets/css/jquery-ui.css', array(), '1.2.1' , 'all' );  
            wp_enqueue_style('metabox', plugin_dir_url( __FILE__ ).'assets/css/meta.css');
            wp_enqueue_script('meta-box', plugin_dir_url( __FILE__ ).'assets/js/meta.js');
		}
	}
	public function add_meta_boxes()
	{
	    $this->add_meta_box('post_product', __('Product Setting','autopro'), 'product');    
	    $this->add_meta_box('post_page', __('Page Setting','autopro'), 'page');   
        $this->add_meta_box('post_blog', __('Blog Setting','autopro'), 'post');
        $this->add_meta_box('post_questions', __('Questions Setting','autopro'), 'questions');    
	}
	public function save_meta_boxes($post_id)
	{
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}
		foreach($_POST as $key => $value) {

          
            if(strstr($key, 'taxonomy_') && !strstr($key, 'multiple_taxonomy_')) {
                $key = str_replace('taxonomy_', '', $key);
                wp_set_object_terms($post_id, $value, $key);  
			}elseif(strstr($key, 'multiple_taxonomy_')) {
			        $key = str_replace('multiple_taxonomy_', '', $key);
                    update_post_meta( $post_id, $key, $value);
			}elseif(strstr($key, 'checkbox_')) {
			        $key = str_replace('checkbox_', '', $key);
			        update_post_meta( $post_id, $key, $value); 
                   
			}else {
			    if(strstr($key, 'gallery_')) {
			       $key = str_replace('gallery_', '', $key);  
			       $value = explode(",",$value);
                   $value = array_filter($value);   
		      	}
				update_post_meta($post_id, $key, $value);
			}
		}
	}
	public function add_meta_box($id, $label, $post_type)
	{
		add_meta_box(
		$id,
		$label,
		array($this, $id),
		$post_type
		);
	}
    
    public function post_product(){
		include 'meta-posttype/meta-box-product.php';
	}

    
    public function post_page(){
		include 'meta-posttype/meta-box-page.php';
	}
    
    public function post_blog(){
		include 'meta-posttype/meta-box-blog.php';
	}
    
    public function post_questions(){
		include 'meta-posttype/meta-box-questions.php';
	}




	public function hidden($id){
		global $post;
		$html = '<input type="hidden" id="' . $id . '" name="' . $id . '" value="' . get_post_meta($post->ID, $id, true) . '" />';
		echo $html;
	}


	public function multiple($id, $label, $options, $desc = '')
	{
		global $post;

		$html = '';
		$html .= '<div id="jws_theme_metabox_field_'.$id.'" class="jws_theme_metabox_field">';
		$html .= '<label for="' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		$html .= '<div class="field">';
		$html .= '<select multiple="multiple" id="' . $id . '" name="' . $id . '[]">';
		foreach($options as $key => $option) {
			if(is_array(get_post_meta($post->ID, $id, true)) && in_array($key, get_post_meta($post->ID, $id, true))) {
				$selected = 'selected="selected"';
			} else {
				$selected = '';
			}

			$html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
		}
		$html .= '</select>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}

	
    public function colorpicker($arg)
	{
		global $post;
        

       $id = isset($arg['id']) ? $arg['id'] : '';
       $label = isset($arg['label']) ? $arg['label'] : '';
       $default = isset($arg['default']) ? $arg['default'] : '';
       $desc = isset($arg['desc']) ? $arg['desc'] : '';
  
		$value = get_post_meta($post->ID, $id, true);

		if (!$value){
			$value = $default;
		}
		$html = '';
		$html .= '<div id="jws_theme_metabox_field_'.$id.'">';
		$html .= '<label for="' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		$html .= '<div class="field">';
		$html .= '<input class="jws-color-field" type="text" id="' . $id . '" name="' . $id . '" value="' . $value . '" />';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}
	
    
    
    public function select($arg)
	{

       $taxonamy = isset($arg['taxonomy']) ? $arg['taxonomy'] : '';
       $id = isset($arg['id']) ? $arg['id'] : '';
       $label = isset($arg['label']) ? $arg['label'] : '';
       $options = isset($arg['option']) ? $arg['option'] : '';
       $default = isset($arg['default']) ? $arg['default'] : '';
       $desc = isset($arg['desc']) ? $arg['desc'] : '';
       $post_type = isset($arg['post_type']) ? $arg['post_type'] : ''; 
   
   
    
        $taxonamy_slug = (!empty($taxonamy)) ? 'taxonomy_' : ''; 
      
		global $post;

        
        $value = get_post_meta($post->ID, $id, true);
       

		$html = null;
		$html .= '<div id="jws_theme_metabox_field_'.$id.'" class="jws_theme_metabox_field">';
		$html .= '<label for="' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		$html .= '<div class="field">';
		$html .= '<select class="select2" id="' . $id . '" name="' . $taxonamy_slug . $id . '">';  
        if(!empty($taxonamy)) { 
          $value   = get_the_terms($post->ID, $id );
          $value = isset($value[0]) ? $value[0]->slug : '';
          $default = $value == '' ? $default ='global': $value;
        }else {
          $value = get_post_meta($post->ID, $id, true);
          $default = $value == '' ? $default ='global': $value;
        }              
		

        if(!empty($taxonamy)) {
            $options =  get_terms( array(
                'taxonomy' => $taxonamy,
                'hide_empty' => false,
            ) );
            if(!empty($options)) {
                $html .= '<option value="">none</option>';
                foreach($options as $key => $option) {
                        $selected = $default === (string)$option->slug?'selected="selected"':null;
                        $html .= '<option ' . $selected . 'value="' . $option->slug . '">' . $option->name . '</option>';
    		   }  
            }
            
        }elseif(!empty($post_type)){
        
            $args = array(
              'numberposts' => -1,
              'post_type'   => $post_type
            );
            $options = get_posts($args);
           
            if(!empty($options)) {
                $html .= '<option value="">none</option>';
                foreach($options as $key => $option) {
                        $selected = $default === (string)$option->ID?'selected="selected"':null;
                        $html .= '<option ' . $selected . 'value="' . $option->ID . '">' . $option->post_title . '</option>';
    		   }  
            }  
        }else {
          foreach($options as $key => $option) {
                    $selected = $default === (string)$key?'selected="selected"':null;
                    $html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
		  }  
        }        
		
		$html .= '</select>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}
    
    
    public function gallery($arg) {
       global $post;
       $id = isset($arg['id']) ? $arg['id'] : '';
       $label = isset($arg['label']) ? $arg['label'] : '';
       $desc = isset($arg['desc']) ? $arg['desc'] : '';
                
                
                
                $default = get_post_meta($post->ID, $id, true); 
      
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
    
    
     public function images($arg) {
       global $post;
       $id = isset($arg['id']) ? $arg['id'] : '';
       $label = isset($arg['label']) ? $arg['label'] : '';
       $desc = isset($arg['desc']) ? $arg['desc'] : '';
                
                
                
                $default = get_post_meta($post->ID, $id, true); 
            
         
                $html = '<div id="jws_theme_metabox_field_'.$id.'" class="jws_theme_metabox_field">';
                $html .= '<div><label for="' . $id . '">';
        		$html .= $label;
        		$html .= '</label>';
            	$html .= '<ul class="misha_images_mtb">';
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
            	$html .= '<input type="hidden" name="'.$id.'" value="' . join(',',$hidden) . '" /><a href="#" class="button misha_upload_images_button">'.esc_html__('Add Images','idealauto').'</a>';
                $html .= '</div>';
            	echo $html;

    }
    
    public function number($arg)
	{
	   global $post;
       $id = isset($arg['id']) ? $arg['id'] : '';
       $label = isset($arg['label']) ? $arg['label'] : '';
       $desc = isset($arg['desc']) ? $arg['desc'] : '';
       
		$value = get_post_meta($post->ID, $id, true);

		$html = '';
		$html .= '<div id="jws_theme_metabox_field_'.$id.'" class="jws_theme_metabox_field">';
		$html .= '<label for="' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		$html .= '<div class="field">';
		$html .= '<input type="number" id="' . $id . '" name="' . $id . '" value="' . $value . '" step="0.01" />';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}
    
    public function text($arg)
	{
		global $post;
       $id = isset($arg['id']) ? $arg['id'] : '';
       $label = isset($arg['label']) ? $arg['label'] : '';
       $desc = isset($arg['desc']) ? $arg['desc'] : '';
		$value = get_post_meta($post->ID, $id, true);

		$html = '';
		$html .= '<div id="jws_theme_metabox_field_'.$id.'" class="jws_theme_metabox_field">';
		$html .= '<label for="' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		$html .= '<div class="field">';
		$html .= '<input type="text" id="' . $id . '" name="' . $id . '" value="' . $value . '" />';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}
    
    
    public function textarea($arg)
	{
	global $post;
       $id = isset($arg['id']) ? $arg['id'] : '';
       $label = isset($arg['label']) ? $arg['label'] : '';
       $desc = isset($arg['desc']) ? $arg['desc'] : '';
	   $value = get_post_meta($post->ID, $id, true);

		$html = '';
		$html = '';
		$html .= '<div id="jws_theme_metabox_field_'.$id.'" class="jws_theme_metabox_field">';
		$html .= '<label for="' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		$html .= '<div class="field">';
		$html .= '<textarea class="widefat" style="max-width:480px" cols="30" rows="5" id="' . $id . '" name="' . $id . '">' . $value . '</textarea>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}
    
    
    
    public function upload($arg)
	{
	  global $post;
       $id = isset($arg['id']) ? $arg['id'] : '';
       $label = isset($arg['label']) ? $arg['label'] : '';
       $desc = isset($arg['desc']) ? $arg['desc'] : '';
       $type = isset($arg['type']) ? implode(",",$arg['type']) : ''; 
        $default = get_post_meta($post->ID, $id, true); 

    	$html = '<div><ul class="misha_file_mtb">';
    	/* array with image IDs for hidden field */
    	$hidden = array();

          if( $file = get_posts( array(
        		'post_type' => 'attachment',
        		'orderby' => 'post__in', /* we have to save the order */
        		'order' => 'ASC',
        		'post__in' => explode(",",$default), /* $value is the image IDs comma separated */
        		'numberposts' => -1,
        		'post_mime_type' => $type
        	) ) ) {
         
        		foreach( $file as $image ) {
        			$hidden[] = $image->ID;
        			$image_src = wp_get_attachment_image_src( $image->ID, array( 280, 280 ) );
        			$html .= '<li data-id="' . $image->ID .  '">
                                <div class="file-info">
                                    <p class="file-name"><strong>'.esc_html__('File name:','idealauto').'</strong>'.$image->post_title.'</p>
                                    <p class="file-type"><strong>'.esc_html__('File type:','idealauto').'</strong>'.$image->post_mime_type.'</p>
                                </div>
                                <a href="#" class="misha_file_remove"><i class="jws-icon-icon_close-1"></i></a></li>';
        		}
         
        	}  

    	
     
    	$html .= '</ul><div style="clear:both"></div></div>';
    	$html .= '<input type="hidden" name="'.$id.'" value="' . join(',',$hidden) . '" /><a data-type="'.$type.'" href="#" class="button misha_upload_file_button">'.esc_html__('Add file','idealauto').'</a>';
     
    	echo $html;
	}
    
    
    public function checkbox($arg)
	{
	   global $post;
       $id = isset($arg['id']) ? $arg['id'] : '';
       $label = isset($arg['label']) ? $arg['label'] : '';
       $desc = isset($arg['desc']) ? $arg['desc'] : '';
       $taxonomy = isset($arg['taxonomy']) ? $arg['taxonomy'] : '';
       $multiple =  (isset($arg['multiple']) && $arg['multiple']) ? $arg['multiple'] : false;  
 
       
      
      
        if(!empty($taxonomy)) {
           if($multiple) {
                $before = 'multiple_taxonomy_';
                $value = get_post_meta($post->ID, $id, true); 
   
            }else {
                $before = 'taxonomy_';
                $value   = get_the_terms($post->ID, $id );
            }  
        }else {
            
            if($multiple) { 
                
            }else {
               $value = get_post_meta($post->ID, $id, true); 
            }
             
        }

      
       $value2  = ($value) ? 'checked="checked"' : '';

        if(!empty($taxonomy)) {
              $value_array = explode(",",$value);

            wp_set_object_terms( $post->ID, $value_array , $id );

    
            $options =  get_terms( array(
                'taxonomy' => $taxonomy,
                'hide_empty' => false,
                'parent' => 0
            ) );
            if(!empty($options)) {
                $not_child = array();
                $html = '';
        		$html .= '<div id="jws_theme_metabox_field_'.$id.'" class="jws_theme_metabox_field">';
        		$html .= '<label for="' . $id . '">';
        		$html .= $label;
        		$html .= '</label>';
        		$html .= '<div class="field">';
                $html .= '<div class="row">';
                $ids = '';
                $has_child = '';
                foreach($options as $key => $option) {
                      
                        
                        $category = get_term_by( 'slug', $option->slug, $taxonomy );
    
                        $ids = $category->term_id;
                        $label = $category->name;
                    
                        $childrens = get_categories(
                          array(
                            'taxonomy' => $taxonomy,
                            'parent' =>$ids,
                            'hide_empty' => false
                          )
                        );
                     
                        
                        if ( $childrens ) { 
                            $html.= '<div class="cat-item col-xl-4 col-lg-4">';
                            $html.= '<h4 class="parent-cat">'.$label.'</h4>';
                            foreach( $childrens as $children )
                            { 
                                $value2 = in_array($children->slug,$value_array) ? 'checked="checked"' : ''; 
                                $html .= '<label for="' . $children->slug . '">';
                                $html .= '<input class="filed-checkbox-munti" type="checkbox" id="' . $children->slug . '" value="' . $children->slug . '" '.$value2.'/>';
                                $html .= $children->name;
                                $html .= '</label>';    
                            }
                            $html .= '</div>'; 
                            $has_child = 'yes';
                        }else {
                            $not_child[] = (object) array('slug' => $option->slug,'name' => $option->name);
                          
                        }
    		   }  
               if(!empty($not_child)) {
                    
                    if($has_child == 'yes') {
                        $html.= '<div class="cat-item col-xl-4 col-lg-4">';     
                        $html.= '<h4 class="parent-cat">'.esc_html__('Other','idealauto').'</h4>';    
                    }
                    foreach( $not_child as $children )
                    { 
                        
                        if($has_child != 'yes') { 
                            $html.= '<div class="col-xl-3 col-lg-3">';  
                        }
                        
                        $value2 = in_array($children->slug,$value_array) ? 'checked="checked"' : ''; 
                        $html .= '<label for="' . $children->slug . '">';
                        $html .= '<input class="filed-checkbox-munti" type="checkbox" id="' . $children->slug . '" value="' . $children->slug . '" '.$value2.'/>';
                        $html .= $children->name;
                        $html .= '</label>';  
                        
                        if($has_child != 'yes') { 
                            $html.= '</div>';  
                        }
                         
                    }
                    if($has_child == 'yes') {
                        $html .= '</div>'; 
                    }

                } 
                $html .= '</div>';
     
                $html .= '<input class="checkbox-munti-value" type="hidden" id="' . $id . '" name="'.$before. $id . '" value="'.$value.'"/>';
                
                if($desc) {
    			$html .= '<p>' . $desc . '</p>';
        		}
        		$html .= '</div>';
        		$html .= '</div>';
        
        		echo $html;
            }
        
        
       }else {
        
            $html = '';
    		$html .= '<div id="jws_theme_metabox_field_'.$id.'" class="jws_theme_metabox_field">';
    		$html .= '<label for="' . $id . '">';
    		$html .= $label;
    		$html .= '</label>';
    		$html .= '<div class="field">';
            $html .= '<label for="' . $id . '">';
            $html .= '<input class="filed-checkbox" type="checkbox" id="' . $id . '" '.$value2.'/>';
            $html .= '<input type="hidden" id="' . $id . '" name="checkbox_' . $id . '" value="'.$value.'"/>';
            $html .= '</label>'; 
            if($desc) {
			$html .= '<p>' . $desc . '</p>';
    		}
    		$html .= '</div>';
    		$html .= '</div>';
    
    		echo $html;
        
       }

		
	}
    
    public function wp_editor($arg)
	{
		global $post;
       $id = isset($arg['id']) ? $arg['id'] : '';
       $label = isset($arg['label']) ? $arg['label'] : '';
       $desc = isset($arg['desc']) ? $arg['desc'] : '';
		$value = get_post_meta($post->ID, $id, true);
        
 
          $args = array (
                'tinymce' => true,
                'quicktags' => true,
                'textarea_rows' => 6, 
                'editor_height' => 555, // In pixels, takes precedence and has no default value
          );

		$html = '';
		$html .= '<div id="jws_theme_metabox_field_'.$id.'" class="jws_theme_metabox_field">';
		$html .= '<label for="' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		$html .= '<div class="field">';
		wp_editor( $value,$id, $args );
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}
    
    public function map($arg)
	{
		global $post;
        
        $address = ''; 
        $short_address = '';
        $lat = '43.656081'; 
        $lng = '-79.380171';
        
       $id = isset($arg['id']) ? $arg['id'] : '';
       $label = isset($arg['label']) ? $arg['label'] : '';
       $desc = isset($arg['desc']) ? $arg['desc'] : '';
		$value = get_post_meta($post->ID, $id, true);
       
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
    
    
}
$metaboxes = new jws_theme_FrameworkMetaboxes();