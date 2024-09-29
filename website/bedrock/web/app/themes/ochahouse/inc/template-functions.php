<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
} 
/**
 * Render header layout.
 *
 * @return string
 */
if (!function_exists('jws_header')) {
    function jws_header()
    {
        global $jws_option;
        
        
        ob_start();
        if(isset($jws_option['select-header']) && !empty($jws_option['select-header'])) {
          get_template_part('template-parts/header/header');  
        }else {
          get_template_part('template-parts/header/header_none');  
        }
        
        $output = ob_get_clean();
        echo apply_filters('jws_header', $output);
    }
}

/**
 * Render footer layout.
 *
 * @return string
 */
if (!function_exists('jws_footer')) {
    function jws_footer()
    {
        global $jws_option;
        
        
        ob_start();
        if(isset($jws_option['select-footer']) && !empty($jws_option['select-footer'])) {
          get_template_part('template-parts/footer/footer');  
        }else {
          get_template_part('template-parts/footer/footer_none');  
        }
        
        $output = ob_get_clean();
        echo apply_filters('footer', $output);
    }
}
function jws_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'jws_mime_types');
/**
* Get post title by ID
*
* @since 1.1.0
*/
function jws_get_posts_title_by_id() {

		$ids = isset( $_POST['id'] ) ? $_POST['id'] : array();

		$results = [];

		$query = new \WP_Query(
			[
				'post_type'      => 'any',
				'post__in'       => $ids,
				'posts_per_page' => -1,
			]
		);

		foreach ( $query->posts as $post ) {
			$results[ $post->ID ] = $post->post_title;
		}

		// return the results in json.
		wp_send_json( $results );
	}  
    
    
    	/**
	 * Get post by search
	 *
	 * @since 1.1.0
	 */
	function jws_get_posts_by_query() {

		$search_string = isset( $_POST['q'] ) ? sanitize_text_field( $_POST['q'] ) : '';
		$req_post_type = isset( $_POST['post_type'] ) ? sanitize_text_field( $_POST['post_type'] ) : 'all';

		$data   = array();
		$result = array();

		$args = array(
			'public'   => true,
			'_builtin' => false,
		);

		$output   = 'names'; // names or objects, note names is the default.
		$operator = 'and'; // also supports 'or'.

		if ( 'all' === $req_post_type ) {
			$post_types = get_post_types( $args, $output, $operator );

			$post_types['Posts'] = 'post';
			$post_types['Pages'] = 'page';
		} else {
			$post_types[ $req_post_type ] = $req_post_type;
		}

		foreach ( $post_types as $key => $post_type ) {

			$data = array();


			$query = new \WP_Query(
				array(
					's'              => $search_string,
					'post_type'      => $post_type,
					'posts_per_page' => - 1,
				)
			);

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$title  = get_the_title();
					$title .= ( 0 != $query->post->post_parent ) ? ' (' . get_the_title( $query->post->post_parent ) . ')' : '';
					$id     = get_the_id();
					$data[] = array(
						'id'   => $id,
						'text' => $title,
					);
				}
			}

			if ( is_array( $data ) && ! empty( $data ) ) {
				$result[] = array(
					'text'     => $key,
					'children' => $data,
				);
			}
		}

		$data = array();

		wp_reset_postdata();

		// return the result in json.
		wp_send_json( $result );
	}  
    
    
add_action( 'wp_ajax_jws_get_posts_by_query', 'jws_get_posts_by_query');
add_action( 'wp_ajax_jws_get_posts_title_by_id', 'jws_get_posts_title_by_id' );

/**
 * Searches for term parents' IDs of hierarchical taxonomies, including current term.
 * This function is similar to the WordPress function get_category_parents() but handles any type of taxonomy.
 * Modified from Hybrid Framework
 *
 * @param int|string    $term_id  The term ID
 * @param object|string $taxonomy The taxonomy of the term whose parents we want.
 *
 * @return array Array of parent terms' IDs.
 */
function jws_get_term_parents( $term_id = '', $taxonomy = 'category' ) {
	// Set up some default arrays.
	$list = array();

	// If no term ID or taxonomy is given, return an empty array.
	if ( empty( $term_id ) || empty( $taxonomy ) ) {
		return $list;
	}

	do {
		$list[] = $term_id;

		// Get next parent term
		$term    = get_term( $term_id, $taxonomy );
		$term_id = $term->parent;
	} while ( $term_id );

	// Reverse the array to put them in the proper order for the trail.
	$list = array_reverse( $list );
	array_pop( $list );

	return $list;
}
/** Add Function Crop Images   **/
/** Add Function Crop Images   **/
function jws_getImageBySize($params = array())
{
    $params = array_merge( array(
    		'post_id' => null,
    		'attach_id' => null,
    		'thumb_size' => 'thumbnail',
    		'class' => '',
    	), $params );
    
    	if ( ! $params['thumb_size'] ) {
    		$params['thumb_size'] = 'thumbnail';
    	}
    
    	if ( ! $params['attach_id'] && ! $params['post_id'] ) {
    		return false;
    	}
    
    	$post_id = $params['post_id'];
    
    	$attach_id = $post_id ? get_post_thumbnail_id( $post_id ) : $params['attach_id'];
    	$attach_id = apply_filters( 'vc_object_id', $attach_id );
    	$thumb_size = $params['thumb_size'];
    	$thumb_class = ( isset( $params['class'] ) && '' !== $params['class'] ) ? $params['class'] . ' ' : '';
    
    	global $_wp_additional_image_sizes;
    	$thumbnail = '';
    
    	$sizes = array(
    		'thumbnail',
    		'thumb',
    		'medium',
    		'large',
    		'full',
    	);
    	if ( is_string( $thumb_size ) && ( ( ! empty( $_wp_additional_image_sizes[ $thumb_size ] ) && is_array( $_wp_additional_image_sizes[ $thumb_size ] ) ) || in_array( $thumb_size, $sizes, true ) ) ) {
    		$attributes = array( 'class' => $thumb_class . 'attachment-' . $thumb_size );
    		$thumbnail = wp_get_attachment_image( $attach_id, $thumb_size, false, $attributes );
    	} elseif ( $attach_id ) {
    		if ( is_string( $thumb_size ) ) {
    			preg_match_all( '/\d+/', $thumb_size, $thumb_matches );
    			if ( isset( $thumb_matches[0] ) ) {
    				$thumb_size = array();
    				$count = count( $thumb_matches[0] );
    				if ( $count > 1 ) {
    					$thumb_size[] = $thumb_matches[0][0]; // width
    					$thumb_size[] = $thumb_matches[0][1]; // height
    				} elseif ( 1 === $count ) {
    					$thumb_size[] = $thumb_matches[0][0]; // width
    					$thumb_size[] = $thumb_matches[0][0]; // height
    				} else {
    					$thumb_size = false;
    				}
    			}
    		}
    		if ( is_array( $thumb_size ) ) {
    			// Resize image to custom size
    			$p_img = jws_resize( $attach_id, null, $thumb_size[0], $thumb_size[1], true );
    			$alt = trim( wp_strip_all_tags( get_post_meta( $attach_id, '_wp_attachment_image_alt', true ) ) );
    			$attachment = get_post( $attach_id );
    			if ( ! empty( $attachment ) ) {
    				$title = trim( wp_strip_all_tags( $attachment->post_title ) );
    
    				if ( empty( $alt ) ) {
    					$alt = trim( wp_strip_all_tags( $attachment->post_excerpt ) ); // If not, Use the Caption
    				}
    				if ( empty( $alt ) ) {
    					$alt = $title;
    				}
    				if ( $p_img ) {
    
    					$attributes = jws_stringify_attributes( array(
    						'class' => $thumb_class,
    						'src' => $p_img['url'],
    						'width' => $p_img['width'],
    						'height' => $p_img['height'],
    						'alt' => $alt,
    						'title' => $title,
    					) );
    
    					$thumbnail = '<img ' . $attributes . ' />';
    				}
    			}
    		}
    	}
    
    	$p_img_large = wp_get_attachment_image_src( $attach_id, 'large' );
    
    	return apply_filters( 'vc_wpb_getimagesize', array(
    		'thumbnail' => $thumbnail,
    		'p_img_large' => $p_img_large,
    	), $attach_id, $params );
}
if (!function_exists('jws_resize')) {
    /**
     * @param int $attach_id
     * @param string $img_url
     * @param int $width
     * @param int $height
     * @param bool $crop
     *
     * @since 4.2
     * @return array
     */
    function jws_resize($attach_id, $img_url, $width, $height, $crop = false)
    {
        // this is an attachment, so we have the ID
		$image_src = array();
		if ( $attach_id ) {
			$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
			$actual_file_path = get_attached_file( $attach_id );
			// this is not an attachment, let's use the image url
		} elseif ( $img_url ) {
			$file_path = wp_parse_url( $img_url );
			$actual_file_path = rtrim( ABSPATH, '/' ) . $file_path['path'];
			$orig_size = getimagesize( $actual_file_path );
			$image_src[0] = $img_url;
			$image_src[1] = $orig_size[0];
			$image_src[2] = $orig_size[1];
		}
		if ( ! empty( $actual_file_path ) ) {
			$file_info = pathinfo( $actual_file_path );
			$extension = '.' . $file_info['extension'];

			// the image path without the extension
			$no_ext_path = $file_info['dirname'] . '/' . $file_info['filename'];

			$cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . $extension;

			// checking if the file size is larger than the target size
			// if it is smaller or the same size, stop right here and return
			if ( $image_src[1] > $width || $image_src[2] > $height ) {

				// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
				if ( file_exists( $cropped_img_path ) ) {
					$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
					$vt_image = array(
						'url' => $cropped_img_url,
						'width' => $width,
						'height' => $height,
					);

					return $vt_image;
				}

				if ( ! $crop ) {
					// calculate the size proportionaly
					$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
					$resized_img_path = $no_ext_path . '-' . $proportional_size[0] . 'x' . $proportional_size[1] . $extension;

					// checking if the file already exists
					if ( file_exists( $resized_img_path ) ) {
						$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

						$vt_image = array(
							'url' => $resized_img_url,
							'width' => $proportional_size[0],
							'height' => $proportional_size[1],
						);

						return $vt_image;
					}
				}

				// no cache files - let's finally resize it
				$img_editor = wp_get_image_editor( $actual_file_path );

				if ( is_wp_error( $img_editor ) || is_wp_error( $img_editor->resize( $width, $height, $crop ) ) ) {
					return array(
						'url' => '',
						'width' => '',
						'height' => '',
					);
				}

				$new_img_path = $img_editor->generate_filename();

				if ( is_wp_error( $img_editor->save( $new_img_path ) ) ) {
					return array(
						'url' => '',
						'width' => '',
						'height' => '',
					);
				}
				if ( ! is_string( $new_img_path ) ) {
					return array(
						'url' => '',
						'width' => '',
						'height' => '',
					);
				}

				$new_img_size = getimagesize( $new_img_path );
				$new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

				// resized output
				$vt_image = array(
					'url' => $new_img,
					'width' => $new_img_size[0],
					'height' => $new_img_size[1],
				);

				return $vt_image;
			}

			// default output - without resizing
			$vt_image = array(
				'url' => $image_src[0],
				'width' => $image_src[1],
				'height' => $image_src[2],
			);

			return $vt_image;
		}

		return false;
    }
}
function jws_stringify_attributes($attributes)
{
    $atts = array();
    foreach ($attributes as $name => $value) {
        $atts[] = $name . '="' . esc_attr($value) . '"';
    }
    return implode(' ', $atts);
}



/* Title Bar */
if ( ! function_exists( 'jws_title_bar' ) ) {
	function jws_title_bar() {
		global $jws_option;
          
        $page_titlebar = get_post_meta(get_the_ID(), 'page_select_titlebar', true);
		$delimiter = '/';
        $tle_bar_build = (did_action( 'elementor/loaded' )) ? Jws_Elementor::get_titlebar_id() : '';
        if(((isset($jws_option['title-bar-switch']) && $jws_option['title-bar-switch']) ) || !isset($jws_option['title-bar-switch']) ) :
        echo '<div class="jws-title-bar-wrap">';
        if(!empty($tle_bar_build)) {
           Jws_Elementor::display_titlebar(); 
        }else {
          ?>
			<div class="jws-title-bar-wrap-inner">
				<div class="container">
					<div class="jws-title-bar">
					<h1 class="jws-text-ellipsis"><?php echo jws_page_title(); ?></h1>
					<div class="jws-path">
							<div class="jws-path-inner">
								<?php echo jws_page_breadcrumb($delimiter); ?>
							</div>
					</div>
					</div>
				</div>
		    </div>
	      <?php  
            
        }
        echo '</div>';
        endif;
	}
}

/* Page breadcrumb */
add_filter( 'breadcrumb_trail_items', 'my_filter_last_crumb' );

function jws_filter_last_crumb( $items ) {

$string = array_pop( $items );

$string = strlen( $string ) > 10 ? substr( $string, 0, 10 ) .'&hellip;' : $string;

$items[] = $string;

return $items;
}
if (!function_exists('jws_page_breadcrumb')) {
    function jws_page_breadcrumb($delimiter) {
		ob_start();

		$home = esc_html__('Home', 'ochahouse');

		global $post;
		$homeLink = home_url('/');
		if( is_home() ){
			_e('Home', 'ochahouse');
		}else{
			echo '<a href="' . $homeLink . '">' . $home . '</a> ' . '<span class="delimiter">'. $delimiter . '</span>' . ' ';
		}

		if ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
			echo '<span class="current">' . esc_html__('Archive by category: ', 'ochahouse') . single_cat_title('', false) . '</span>';

		} elseif ( is_search() ) {
			echo '<span class="current">' . esc_html__('Search results for: ', 'ochahouse') . get_search_query() . '</span>';

		} elseif ( is_post_type_archive( 'product' ) ) {
			echo '<span class="current">' . esc_html__('Shop', 'ochahouse') . '</span>';

		} elseif ( is_day() ) {
			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F').' '. get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<span class="current">' . get_the_time('d') . '</span>';

		} elseif ( is_month() ) {
			echo '<span class="current">' . get_the_time('F'). ' '. get_the_time('Y') . '</span>';

		} 
        elseif ( is_month() ) {
			echo '<span class="current">' . get_the_time('F'). ' '. get_the_time('Y') . '</span>';

		}
        elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				if(get_post_type() == 'product'){
					$terms = get_the_terms(get_the_ID(), 'product_cat', '' , '' );
										if($terms) {
                		if( $terms ) {
                			$term    = current( $terms );
                			$terms   = jws_get_term_parents( $term->term_id, 'product_cat' );
                			$terms[] = $term->term_id;
                
                			foreach ( $terms as $term_id ) {
                				$term    = get_term( $term_id, 'product_cat'  );

								echo '<a href="'.get_term_link( $term, 'product_cat'  ).'" class="breadcrumb-link-last">'.$term->name.'</a>';
                                echo '<span class="delimiter">'.' ' . $delimiter . ' ' . '</span>';
                			}
                		}
						echo ''  . '<span class="current">' .mb_strimwidth(get_the_title(), 0, 45, '...'). '</span>';
					}else{
						echo '<span class="current">' .mb_strimwidth(get_the_title(), 0, 45, '...'). '</span>';
					}
				}else{
				    
						$post_type = get_post_type_object(get_post_type());

						$slug = $post_type->rewrite;
                
						echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
						echo ' ' . $delimiter . ' ' . '<span class="current">' .mb_strimwidth(get_the_title(), 0, 45, '...'). '</span>';
				}

			} else {
			 				$terms = get_the_terms(get_the_ID(), 'category', '' , '' );
                            
                            if ( get_option( 'page_for_posts' ) ) {
                               echo '<a href="'.esc_url(get_permalink( get_option( 'page_for_posts' ) )).'">'.esc_html__( 'Blog', 'ochahouse' ).'</a>';
                                	echo '<span class="delimiter">'.' ' .$delimiter.' '.'</span>';                               
                            } else {
                               echo '<a href="'.esc_url( home_url( '/' ) ).'">'.esc_html__( 'Blog', 'ochahouse' ).'</a>';
                                	echo '<span class="delimiter">'.' ' .$delimiter.' '.'</span>';                               
                            }
			if($terms) {
                		if( $terms ) {
                			$term    = current( $terms );
                			$terms   = jws_get_term_parents( $term->term_id, 'category' );
                			$terms[] = $term->term_id;
                
                			foreach ( $terms as $term_id ) {
                				$term    = get_term( $term_id, 'category'  );

								echo '<a href="'.get_term_link( $term, 'category'  ).'" class="breadcrumb-link-last">'.$term->name.'</a>';
                			}
                		}
                        	echo '<span class="delimiter">'.' ' .$delimiter.' '.'</span>';
						echo ''  . '<span class="current">' .mb_strimwidth(get_the_title(), 0, 45, '...'). '</span>';
					}else{
					echo '<span class="current">'.mb_strimwidth(get_the_title(), 0, 45, '...').'</span>';
					}
				
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			if($post_type) echo '<span class="current">' . $post_type->labels->singular_name . '</span>';
		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
			echo ' ' . $delimiter . ' ' . '<span class="current">' .mb_strimwidth(get_the_title(), 0, 45, '...'). ' </span>';
		} elseif ( is_page() && !$post->post_parent ) {
			echo '<span class="current">'.mb_strimwidth(get_the_title(), 0, 45, '...').'</span>';

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo ''.$breadcrumbs[$i];
				if ($i != count($breadcrumbs) - 1)
					echo ' ' . $delimiter . ' ';
			}
			echo ' ' . $delimiter . ' ' . '<span class="current">' .mb_strimwidth(get_the_title(), 0, 45, '...'). ' hello</span>';

		} elseif ( is_tag() ) {
			echo '<span class="current">' . esc_html__('Posts tagged: ', 'ochahouse') . single_tag_title('', false) . '</span>';
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo '<span class="current">' . esc_html__('Articles posted by ', 'ochahouse') . $userdata->display_name . '</span>';
		} elseif ( is_404() ) {
			echo '<span class="current">' . esc_html__('Error 404', 'ochahouse') . '</span>';
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				echo ' '.'<span class="delimiter">'.$delimiter.'</span> ' . ' '.'<span class="paged-number">'.__('Page', 'ochahouse') . ' ' . get_query_var('paged').'</span>';
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}
			
		return ob_get_clean();
    }
}
/* Page title */
if (!function_exists('jws_page_title')) {
    function jws_page_title() { 
            ob_start();
			if( is_home() ){
				esc_html_e('Home', 'ochahouse');
			}elseif(is_search()){
                esc_html_e('Search Keyword: ', 'ochahouse'); echo get_search_query();
            }elseif(is_post_type_archive( 'product' )){
                esc_html_e('Shop', 'ochahouse');
            }else {
                if (is_category()){
                    single_cat_title();
                }elseif(get_post_type() == 'event' || get_post_type() == 'jwsdonations'  || get_post_type() == 'testimonial' ){
                    single_term_title();
                }
                elseif (is_tag()){
                    single_tag_title();
                }elseif (is_author()){
                    printf(__('Author: %s', 'ochahouse'), '<span class="vcard">' . get_the_author() . '</span>');
                }elseif (is_day()){
                    printf(__('Day: %s', 'ochahouse'), '<span>' . get_the_date() . '</span>');
                }elseif (is_month()){
                    printf(__('Month: %s', 'ochahouse'), '<span>' . get_the_date() . '</span>');
                }elseif (is_year()){
                    printf(__('Year: %s', 'ochahouse'), '<span>' . get_the_date() . '</span>');
                }elseif (is_tax('post_format', 'post-format-aside')){
                    esc_html_e('Asides', 'ochahouse');
                }elseif (is_tax('post_format', 'post-format-gallery')){
                    esc_html_e('Galleries', 'ochahouse');
                }elseif (is_tax('post_format', 'post-format-image')){
                    esc_html_e('Images', 'ochahouse');
                }elseif (is_tax('post_format', 'post-format-video')){
                    esc_html_e('Videos', 'ochahouse');
                }elseif (is_tax('post_format', 'post-format-quote')){
                    esc_html_e('Quotes', 'ochahouse');
                }elseif (is_tax('post_format', 'post-format-link')){
                    esc_html_e('Links', 'ochahouse');
                }elseif (is_tax('post_format', 'post-format-status')){
                    esc_html_e('Statuses', 'ochahouse');
                }elseif (is_tax('post_format', 'post-format-audio')){
                    esc_html_e('Audios', 'ochahouse');
                }elseif (is_tax('post_format', 'post-format-chat')){
                    esc_html_e('Chats', 'ochahouse');
                }
                elseif(get_post_type() == 'product' && !is_single()){
                   single_term_title();
                }else{
                    the_title();
                }
            }
                
            return ob_get_clean();
    }
}

function jws_gt_get_post_view() {
   
    $count = get_post_meta( get_the_ID(), 'post_views_count', true );

    if(!empty( $count)) {
        return "$count";
    }else {
        return "0";
    }
    
}
function jws_gt_set_post_view() {
    $key = 'post_views_count';
    $post_id = get_the_ID();
    $count = (int) get_post_meta( $post_id, $key, true );
    $count++;
    update_post_meta( $post_id, $key, $count );
}
function gt_posts_column_views( $columns ) {
    $columns['post_views'] = 'Views';
    return $columns;
}
function gt_posts_custom_column_views( $column ) {
    if ( $column === 'post_views') {
        echo jws_gt_get_post_view();
    }
}
add_filter( 'manage_posts_columns', 'gt_posts_column_views' );
add_action( 'manage_posts_custom_column', 'gt_posts_custom_column_views' );


function jws_gt_set_post_time() {
    $content = get_post_field( 'post_content', get_the_ID() );
    $word_count = str_word_count( strip_tags( $content ) );
    $readingtime = ceil($word_count / 200);

    if ($readingtime == 1) {
      $timer = esc_html__(' min read','ochahouse');
    } else {
      $timer = esc_html__(' mins read','ochahouse');
    }
    $totalreadingtime = $readingtime . $timer;
    $key = 'time_read';
    $post_id = get_the_ID();
    update_post_meta( $post_id, $key, $totalreadingtime );
}


if (!function_exists('jws_query_pagination')) {
    function jws_query_pagination($wp_query)
    {
        	$big = 999999999;
        	$pagi = '<div class="jws-pagination-number">';
        	$pagi .= paginate_links( array(
        		'prev_text'          => '<i class="jws-icon-expand_right_double"></i>',
        		'next_text'          => '<i class="jws-icon-expand_right_double"></i>',
        		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        		'format' => '?paged=%#%',
        		'current' => max( 1, get_query_var('paged') ),
        		'total' => $wp_query->max_num_pages,
                'type' => 'list'
        	) );
        	$pagi .= '</div>';
            return $pagi;
    }
}


/*Custom comment list*/

function jws_custom_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ('div' == $args['style']) {
        $tag = 'div ';
        $add_below = 'comment';
    } else {
        $tag = 'li ';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo ''.$tag; ?><?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
<?php endif; ?>

    <div class="comment-avatar">
        <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>
    </div>
    <div class="comment-info">
        <h4 class="comment-author"><?php printf(esc_html__('%s', 'ochahouse'), get_comment_author()); ?></h4>
                <div class="comment-header-info">            
            <span class="reply">
                <?php comment_reply_link(array_merge($args, array('reply_text' => __('<span><i class="fa fa-reply"></i> Reply</span>', 'ochahouse'), 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
            </span>
        </div>
        <span class="comment-date"><?php printf(esc_html__('%1$s ', 'ochahouse'), get_comment_date());?> <?php printf(esc_html__('%1$s ', 'ochahouse'), esc_html('at','ochahouse'));?> <?php printf(esc_html__('%1$s ', 'ochahouse'),get_comment_time()); ?></span>
        <?php comment_text(); ?>

        <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'ochahouse'); ?></em>
            <br/>
        <?php endif; ?>
    </div>

    <?php if ('div' != $args['style']) : ?>
    </div>
<?php endif; ?>
    <?php
}

/**
 * Render post tags.
 *
 * @since 1.0.0
 */
if (!function_exists('jws_get_tags')) :
    function jws_get_tags()
    {
        $output = '';

        // Get the tag list
        $tags_list = get_the_tag_list();
        if ($tags_list) {
            $output .= sprintf('<div class="post-tags"><span>'.esc_html__('Tags','ochahouse').'</span>%2$s' . esc_html__('%1$s', 'ochahouse') . '</div>', $tags_list, '');
        }
        return apply_filters('jws_get_tags', $output);
    }
endif;

/* Add Field To Admin User */
function jws_custom_field_user($profile_fields) {
    	// Add new fields
        $profile_fields['job'] = 'Job';
    	$profile_fields['twitter'] = 'Twitter URL';
    	$profile_fields['facebook'] = 'Facebook URL';
    	$profile_fields['linkedin'] = 'Linkedin';
    	return $profile_fields;
}
add_filter('user_contactmethods', 'jws_custom_field_user');

/**
 * ------------------------------------------------------------------------------------------------
 * Get post image
 * ------------------------------------------------------------------------------------------------
 */

if (!function_exists('jws_get_post_thumbnail')) {
    function jws_get_post_thumbnail($size = 'full', $attach_id = false)
    {
        global $post, $ochahouse_loop;
        if (has_post_thumbnail()) {

            if (function_exists('jws_getImageBySize')) {
                if (!$attach_id) $attach_id = get_post_thumbnail_id();

                $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $size, 'class' => 'attachment-large wp-post-image'));
                $img = $img['thumbnail'];

            } else {
                $img = get_the_post_thumbnail($post->ID, $size);
                
            }

            return $img;
        }
    }
}

function jws_custom_wpkses_post_tags( $tags, $context ) {

	if ( 'post' === $context ) {
		$tags['iframe'] = array(
			'src'             => true,
			'height'          => true,
			'width'           => true,
			'frameborder'     => true,
			'allowfullscreen' => true,
		);
	}

	return $tags;
}

add_filter( 'wp_kses_allowed_html', 'jws_custom_wpkses_post_tags', 10, 2 );





add_filter('wp_generate_tag_cloud', 'jws_myprefix_tag_cloud',10,1);

function jws_myprefix_tag_cloud($tag_string){
  return preg_replace('/style=("|\')(.*?)("|\')/','',$tag_string);
}


add_filter( 'get_the_archive_title', function ($title) {    
    if ( is_category() ) {    
            $title = single_cat_title( '', false );    
        } elseif ( is_tag() ) {    
            $title = single_tag_title( '', false );    
        } elseif ( is_author() ) {    
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;    
        } elseif ( is_tax() ) { //for custom post types
            $title = sprintf( __( '%1$s' , 'ochahouse' ), single_term_title( '', false ) );
        } elseif (is_post_type_archive()) {
            $title = post_type_archive_title( '', false );
        }elseif (is_page()) {
            $title = get_the_title( '', false );
          
        }
    return $title;    
});