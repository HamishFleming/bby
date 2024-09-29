<?php 
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
add_theme_support('wc-product-gallery-zoom');
add_theme_support('woocommerce');

add_theme_support( 'woocommerce', array(

'single_image_width' => 524,
) );
add_action('init','change_woocommerce_action');
function change_woocommerce_action() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
    remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
    remove_action( 'woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart', 10 );
    remove_action( 'woocommerce_before_single_product_summary' , 'woocommerce_show_product_sale_flash', 10 );
    // remove_action( 'woocommerce_before_single_product_summary' , 'woocommerce_show_product_sale_flash', 10 );
    
    remove_action( 'woocommerce_after_single_product_summary' , 'woocommerce_output_product_data_tabs', 10 );
    remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
    remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );  
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );   
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );  
    remove_action( 'woocommerce_single_product_summary', 'jws_banner_product', 50 );    
    add_filter( 'woocommerce_product_tabs', 'jws_woo_remove_reviews_tab', 98 );
    add_action('woocommerce_single_product_summary', 'woocommerce_show_product_loop_sale_flash', 10);
    add_action('woocommerce_single_product_summary', 'custom_get_availability', 15);
}

add_action('init','add_woocommerce_action');
function add_woocommerce_action() {

 $layout = jws_checkout_layout(); 
 add_filter('woocommerce_checkout_fields', 'jws_checkout_email_first');
 add_filter('woocommerce_checkout_fields', 'jws_override_billing_checkout_fields', 20, 1);

}
// Add to cart text
function single_add_to_cart_text() {
    return apply_filters( 'woocommerce_product_single_add_to_cart_text', esc_html__( 'Add to cart', 'ochahouse' ), $this );
  }
  
//Stock

function custom_get_availability() {
  global $product;
    if ( ! $product->managing_stock() && ! $product->is_in_stock() ){
         echo '<div class="availability"><p class="stock out-of-stock">'.esc_html__('Out of Stock','ochahouse').'</p></div>'; 
    }else{
      echo '<div class="availability"><p class="stock in-stock">'.esc_html__('Instock','ochahouse').'</p></div>';   
    }
      
}
//Sales
add_filter( 'woocommerce_sale_flash', 'woocommerce_custom_badge', 10, 3 );
function woocommerce_custom_badge( $output_html, $post, $product ) {


  if( $product->is_type('variable')){
      $percentages = array();

      // Get all variation prices
      $prices = $product->get_variation_prices();

      // Loop through variation prices
      foreach( $prices['price'] as $key => $price ){
          // Only on sale variations
          if( $prices['regular_price'][$key] !== $price ){
              // Calculate and set in the array the percentage for each variation on sale
              $percentages[] = round( 100 - ( floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100 ) );
          }
      }
      // We keep the highest value
      $percentage = max($percentages) . '%';

  } elseif( $product->is_type('grouped') ){
      $percentages = array();

      // Get all variation prices
      $children_ids = $product->get_children();

      // Loop through variation prices
      foreach( $children_ids as $child_id ){
          $child_product = wc_get_product($child_id);

          $regular_price = (float) $child_product->get_regular_price();
          $sale_price    = (float) $child_product->get_sale_price();

          if ( $sale_price != 0 || ! empty($sale_price) ) {
              // Calculate and set in the array the percentage for each child on sale
              $percentages[] = round(100 - ($sale_price / $regular_price * 100));
          }
      }
      // We keep the highest value
      $percentage = max($percentages) . '%';

  } else {
      $regular_price = (float) $product->get_regular_price();
      $sale_price    = (float) $product->get_sale_price();

      if ( $sale_price != 0 || ! empty($sale_price) ) {
          $percentage    = round(100 - ($sale_price / $regular_price * 100)) . '%';
      } else {
          return $html;
      }
  }
  return '<span class="sale">' . esc_html__( 'Save', 'ochahouse' ) . ' ' . $percentage . '</span>';

}
// Filter product by price
// Change Price Filter Widget Increment
function jws_change_price_filter_step() {
        return 1;
}
add_filter( 'woocommerce_price_filter_widget_step', 'jws_change_price_filter_step', 10, 3 );
//Navigation

 
function jws_prev_next_product(){
 
echo '<div class="prev_next_buttons">';
 
   // 'product_cat' will make sure to return next/prev from current category
    echo ''.$next = previous_post_link('%link', '<i class="jws-icon-expand_left"></i>', TRUE, ' ', 'product_cat');
    echo   ''.$shop ='<a class="view-product-2 sel-active" data-id="3" href="'.get_permalink( wc_get_page_id( 'shop' ) ).'"></a>';
    echo   ''.$previous = next_post_link('%link', '<i class="jws-icon-expand_right"></i>', TRUE, ' ', 'product_cat');
 
 

    
echo '</div>';
         
}
// Add tabs
add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );  
function woo_new_product_tab( $tabs ) {
    	$ingredient_tab = get_post_meta( get_the_ID(), 'ingredient', true );
        $shipping_tab = get_post_meta( get_the_ID(), 'shipping', true );

        if(!empty($ingredient_tab)) {
           $tabs['ingredient_tab'] = array(
            		'title' 	=> esc_html__( 'Ingredient', 'ochahouse' ),
            		'callback' 	=> 'woo_new_product_ingredient_tab'
            ); 
        }
        
        if(!empty($shipping_tab)) { 
            $tabs['shipping_tab'] = array(
        		'title' 	=> esc_html__( 'Shipping & Returns', 'ochahouse' ),
        		'callback' 	=> 'woo_new_product_shipping_tab'
           ); 
        }



    return $tabs;    
}

function woo_new_product_ingredient_tab() {
   $content = get_post_meta( get_the_ID(), 'ingredient', true );
   // The new tab content
    if(!empty($content)) {
       echo wpautop($content); 
    }	
}
function woo_new_product_shipping_tab() {
   $content = get_post_meta( get_the_ID(), 'shipping', true );
   // The new tab content
   if(!empty($content)) {
       echo wpautop($content); 
   }	
}

function jws_shipping_method_modern() {
    ?>
    <div id="jws-shipping-methods">
            <h3><?php echo esc_html__('Shipping Methods', 'ochahouse'); ?></h3>
            <div class="jws-shipping-wrap"><div></div></div>
    </div>
    <?php
}


function jws_override_billing_checkout_fields($fields)
{

    $fields['billing']['billing_first_name']['label'] = esc_html__('First Name','ochahouse');
    $fields['billing']['billing_last_name']['placeholder'] = esc_html__('','ochahouse');
    $fields['billing']['billing_company']['placeholder'] = esc_html__('','ochahouse');
    $fields['billing']['billing_address_1']['placeholder'] = esc_html__('House number and street name','ochahouse');
     $fields['billing']['billing_address_2']['label'] = '';
    $fields['billing']['billing_address_2']['placeholder'] = esc_html__('Apartment, suite, unit, etc. (optional)','ochahouse');
    $fields['billing']['billing_postcode']['placeholder'] = esc_html__('','ochahouse');
    $fields['billing']['billing_phone']['placeholder'] = esc_html__('','ochahouse');
    $fields['billing']['billing_city']['placeholder'] = esc_html__('','ochahouse');
    $fields['billing']['billing_state']['placeholder'] = esc_html__('','ochahouse');
        $fields['billing']['billing_email']['placeholder'] = esc_html__('','ochahouse');



    $fields['shipping']['shipping_first_name']['placeholder'] = esc_html__('First Name*','ochahouse');
    $fields['shipping']['shipping_last_name']['placeholder'] = esc_html__('Last Name*','ochahouse');
    $fields['shipping']['shipping_company']['placeholder'] = esc_html__('Company name (optional)','ochahouse');
    $fields['shipping']['shipping_address_1']['placeholder'] = esc_html__('Street address*','ochahouse');
    $fields['shipping']['shipping_address_2']['placeholder'] = esc_html__('Street address*','ochahouse');
    $fields['shipping']['shipping_postcode']['placeholder'] = esc_html__('Postcode / ZIP','ochahouse');
    $fields['shipping']['shipping_city']['placeholder'] = esc_html__('Town / City*','ochahouse');
    $fields['shipping']['shipping_state']['placeholder'] = esc_html__(' State*','ochahouse');
    
 



	return $fields;
}




/**
 * Add Filter 'woocommerce_update_order_review_fragments'.
 */
if (!function_exists('jws_update_order_review_fragments')) :
    function jws_update_order_review_fragments($fragments) {

        
        /**
         * Total price
         */
        ob_start();
        wc_cart_totals_order_total_html();
        $total = ob_get_clean();
        $fragments['.your-order-price'] = '<span class="your-order-price">' . $total . '</span>';
        
        /**
         * Shipping Method
         */
        ob_start();
        wc_cart_totals_shipping_html();
        $shipping = ob_get_clean();
        $fragments['.jws-shipping-wrap div'] = $shipping;
        
        return $fragments;
    }
endif;


/**
 * Add Filter 'woocommerce_checkout_fields'.
 */
if (!function_exists('jws_checkout_email_first')) :
    function jws_checkout_email_first($checkout_fields) {
        $checkout_fields['billing']['billing_email']['priority'] = 5;
        
        return $checkout_fields;
    }
endif;

if (!function_exists('jws_checkout_layout')) :
    function jws_checkout_layout() {
        global $jws_option; 
        $layout = 'classic';
      

        return $layout;
    }
endif;





function jws_woo_remove_reviews_tab($tabs) {
unset($tabs['reviews']);
return $tabs;
}

function jws_shop_single_info_more() {
    global $jws_option;
    
    if(isset($jws_option['shop_single_info_more']) && !empty($jws_option['shop_single_info_more'])) {
        echo '<div class="shop_info_more">'.$jws_option['shop_single_info_more'].'</div>';
    }
}
add_action( 'woocommerce_single_product_summary', 'jws_shop_single_info_more', 25 );  






function jwsChangeProductsTitle() {
   echo '<div class="woocommerce-loop-product__title"><a href="'.get_the_permalink().'">' . get_the_title() . '</a></div>';
}
add_action('woocommerce_shop_loop_item_title', 'jwsChangeProductsTitle', 10 );

add_action( 'woocommerce_before_shop_loop_item_title', 'jws_product_label', 10 ); 

add_action( 'woocommerce_before_shop_loop_item_title', 'jws_product_thumbnail_gallery', 15 ); 

function jws_product_thumbnail_gallery() {
    

    global $product;
    if ( version_compare( WC_VERSION, '3.0.0', '<' ) ) {
    	$attachment_ids = $product->get_gallery_image_ids();
    } else {
    	$attachment_ids = $product->get_gallery_image_ids();
    }
    if ( isset( $attachment_ids[0] ) ) {

		$attachment_id = $attachment_ids[0];

		$title = get_the_title();
		$link  = get_the_permalink();
        $size_img = 'woocommerce_thumbnail';
		$image = wp_get_attachment_image( $attachment_id, $size_img );

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<span  class="gallery" title="%s">%s</span>', $title, $image ), $attachment_id, get_the_ID() );
	}
 
    
}
    		


/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter('loop_shop_per_page', 'jws_new_loop_shop_per_page', 20);

function jws_new_loop_shop_per_page($cols)
{
    global $jws_option;
    // $cols contains the current number of products per page based on the value stored on Options -> Reading
    // Return the number of products you wanna show per page.
    $cols = (isset($jws_option['product_per_page']) && !empty($jws_option['product_per_page'][0])) ? $jws_option['product_per_page'][0] : 9;
    if(isset($_GET['number']) && $_GET['number']) {  
      $cols = $_GET['number'];  
    }
    return $cols;
}


function jws_button_product_grid($cart, $wishlist , $quickview) {
      global $jws_option;
    ?>
        <ul class="ct_ul_ol">
            <?php if($cart) : ?>
            <li><?php woocommerce_template_loop_add_to_cart(); ?></li>
            <?php endif; ?>
            <?php if(jws_theme_get_option('wishlist')): if($wishlist) : ?>
            <li><?php jws_add_to_wishlist_btn(); ?></li>
            <?php endif;endif; ?>
            <?php if($quickview) : ?>
            <li>
                <a data-product_id="<?php echo get_the_ID(); ?>" class="quickview-button"><span><?php echo esc_html__('Quick view','ochahouse') ?></span></a>
            </li>
            <?php endif; ?>
        </ul>
    <?php
}

if ( ! function_exists( 'jws_product_quickview_button' ) ) {
	/**
	 * Add wishlist Button to Product Image
	 */
	function jws_product_quickview_button() {

		?>
		<div class="quickview-icon">
			<button data-product_id="<?php echo get_the_ID(); ?>" class="quickview-button is-outline circle icon">
				<span class="lnr lnr-eye"></span>
                <div class="quickview-popup">
				    <?php echo esc_html__( 'Quick View', 'ochahouse' ); ?>
			    </div>
			</button>
		</div>
		<?php
	}
}
   
if( ! function_exists( 'jws_ajax_load_product_quickview' ) ) {
    	function jws_ajax_load_product_quickview($id = false) {
    		if( isset($_GET['id']) ) {
    			$id = (int) $_GET['id'];
    		}
    
    
    		global $post, $product;
    
    
    		$args = array( 'post__in' => array($id), 'post_type' => 'product' );
    
    		$quick_posts = get_posts( $args );
    
    	
    
    		foreach( $quick_posts as $post ) :
    			setup_postdata($post);
    			$product = wc_get_product($post);
                wc_get_template_part( 'quickview/content', 'quickview' );
    		endforeach; 
    
    		wp_reset_postdata(); 
    
    		die();
    	}
    
        
        // Note: Keep default AJAX actions in case WooCommerce endpoint URL is unavailable
        add_action('wp_ajax_jws_ajax_load_product_quickview', 'jws_ajax_load_product_quickview');
        add_action('wp_ajax_nopriv_jws_ajax_load_product_quickview', 'jws_ajax_load_product_quickview');
    
} 


if( ! function_exists( 'jws_product_label' ) ) {
	function jws_product_label() {
		global $product;

		$output = array();


		if ( $product->is_on_sale() ) {

			$percentage = '';

			if ( $product->get_type() == 'variable' ) {

				$available_variations = $product->get_variation_prices();
				$max_percentage = 0;

				foreach( $available_variations['regular_price'] as $key => $regular_price ) {
					$sale_price = $available_variations['sale_price'][$key];

					if ( $sale_price < $regular_price ) {
						$percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );

						if ( $percentage > $max_percentage ) {
							$max_percentage = $percentage;
						}
					}
				}

				$percentage = $max_percentage;
			} elseif ( ( $product->get_type() == 'simple' || $product->get_type() == 'external' ) ) {
				$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
			}

			if ( $percentage ) {
				$output[] = '<span class="onsale jws_pr_label">-'.$percentage . '%' . '</span>';
			}else{
				$output[] = '<span class="onsale jws_pr_label">' . esc_html__( 'Sale', 'ochahouse' ) . '</span>';
			}
		}
		
		if( !$product->is_in_stock() && $product->get_type() != 'variable' ){
			$output[] = '<span class="out-of-stock jws_pr_label">' . esc_html__( 'Sold', 'ochahouse' ) . '</span>';
		}

		if ( $product->is_featured()) {
			$output[] = '<span class="featured jws_pr_label">' . esc_html__( 'Hot', 'ochahouse' ) . '</span>';
		}
        
		if ( get_post_meta( get_the_ID(), 'jws_new_enabled', true )== 'yes') {
			$output[] = '<span class="new jws_pr_label">' . esc_html__( 'New', 'ochahouse' ) . '</span>';
		}
		

		
		if ( $output ) {
			echo '<div class="jws_pr_labels">' . implode( '', $output ) . '</div>';
		}
	}
}
  

add_filter( 'woocommerce_output_related_products_args', 'jws_related_products_args', 20 );
  function jws_related_products_args( $args ) {
	$args['posts_per_page'] = 100; // 4 related products
	return $args;
}



if (!function_exists('jws_shop_page_link')) {
    function jws_shop_page_link($keep_query = false, $taxonomy = '')
    {
        // Base Link decided by current page
        if (defined('SHOP_IS_ON_FRONT')) {
            $link = home_url();
        } elseif (is_post_type_archive('product') || is_page(wc_get_page_id('shop'))) {
            $link = get_post_type_archive_link('product');

        } elseif (is_product_category()) {
            $link = get_term_link(get_query_var('product_cat'), 'product_cat');
        } elseif (is_product_tag()) {
            $link = get_term_link(get_query_var('product_tag'), 'product_tag');
        } else {
            $link = get_term_link(get_query_var('term'), get_query_var('taxonomy'));
        }

        if ($keep_query) {

            
            
            $link_array_slug = array(
                'min_price','max_price' ,'orderby','lay_style','shop_layout'
                
            );
            
            
            foreach($link_array_slug as $get_slug) {
                if (isset($_GET[$get_slug])) {
                    $link = add_query_arg($get_slug, $_GET[$get_slug], $link);
                } 
            }
            
             // All current filters
            if ($_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes()) {

                foreach ($_chosen_attributes as $name => $data) {
                    if ($name === $taxonomy) {
                        continue;
                    }

                    $filter_name = sanitize_title(str_replace('pa_', '', $name));
                    if (!empty($data['terms'])) {
                        $link = add_query_arg('filter_' . $filter_name, implode(',', $data['terms']), $link);

                    }
                    if ('or' == $data['query_type']) {
                        $link = add_query_arg('query_type_' . $filter_name, 'or', $link);

                    }
                }
            }

            /**
             * Search Arg.
             * To support quote characters, first they are decoded from &quot; entities, then URL encoded.
             */
            if (get_search_query()) {
                $link = add_query_arg('s', rawurlencode(wp_specialchars_decode(get_search_query())), $link);
            }

            
        }

        return $link;
    }
}



//move comment field to bottom of form
function wpb_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
 
add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );



//add comment meta field

function add_custom_comment_field( $comment_id ) {
   if(isset($_POST['title_comment'])) {
    add_comment_meta( $comment_id, 'title_comment', $_POST['title_comment'] );
   } 
}
add_action( 'comment_post', 'add_custom_comment_field' );

function extend_comment_edit_metafields( $comment_id ) {
    if( ! isset( $_POST['extend_comment_update'] ) || ! wp_verify_nonce( $_POST['extend_comment_update'], 'extend_comment_update' ) ) return;
 
	if ( ( isset( $_POST['title_comment'] ) ) && ( $_POST['title_comment'] != '') ) :
	$title_comment = wp_filter_nohtml_kses($_POST['title_comment']);
	update_comment_meta( $comment_id, 'title_comment', $phone );
	else :
	delete_comment_meta( $comment_id, 'title_comment');
	endif;

}
add_action( 'edit_comment', 'extend_comment_edit_metafields' );


function add_custom_recommend_comment_field( $comment_id ) {
   if(isset($_POST['recommend_field'])) {
    add_comment_meta( $comment_id, 'recommend_field', $_POST['recommend_field'] );
   } 
}
add_action( 'comment_post', 'add_custom_recommend_comment_field' );

function extend_comment_edit_recommendfields( $comment_id ) {
    if( ! isset( $_POST['extend_comment_update'] ) || ! wp_verify_nonce( $_POST['extend_comment_update'], 'extend_comment_update' ) ) return;
 
	if ( ( isset( $_POST['recommend_field'] ) ) && ( $_POST['recommend_field'] != '') ) :
	$recommend_field = wp_filter_nohtml_kses($_POST['recommend_field']);
	update_comment_meta( $comment_id, 'recommend_field', $phone );
	else :
	delete_comment_meta( $comment_id, 'recommend_field');
	endif;

}
add_action( 'edit_comment', 'extend_comment_edit_recommendfields' );

// add field 
//add_action( 'comment_form_submit_field', 'additional_recommend_field' ); 

function additional_recommend_field () {
          
   echo '<p class="recommend-form-review"><label>'.esc_html__('Do you recommend this product?','ochahouse').'</label>
                                        <label for="recommend_field " class="jws-form-label jws-form-label-recommend-yes"> <input class="jws-form-input"  id="recommend_field" type="radio" name="recommend_field" value="true" aria-label="Yes, I recommend this product"> Yes </label>
                                      <label  for="recommend_field "class="jws-form-label jws-form-label-recommend-no"> <input class="jws-form-input" id="recommend_field" type="radio" name="recommend_field" value="false" aria-label="No, I do not recommend this product"> No </label>
                                     </p>';
        
      
}
// add field when logined
add_action( 'comment_form_logged_in_after', 'additional_fields' );
add_action( 'comment_form_after_fields', 'additional_fields' );
 
function additional_fields () {
     global $post_type;
  if($post_type =='product'){
     	if ( wc_review_ratings_enabled() ) {
     echo '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Rating', 'ochahouse' ) . ( wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '' ) . '</label><select name="rating" id="rating" required>
		<option value="">' . esc_html__( 'Rate&hellip;', 'ochahouse' ) . '</option>
		<option value="5">' . esc_html__( 'Perfect', 'ochahouse' ) . '</option>
		<option value="4">' . esc_html__( 'Good', 'ochahouse' ) . '</option>
		<option value="3">' . esc_html__( 'Average', 'ochahouse' ) . '</option>
		<option value="2">' . esc_html__( 'Not that bad', 'ochahouse' ) . '</option>
		<option value="1">' . esc_html__( 'Very poor', 'ochahouse' ) . '</option>
	</select></div>';
    }
    if ( wc_review_ratings_enabled() ) {
    echo '<p class="comment-form-title_comment">';
	echo '<label for="title_comment">' . __( 'Title of Review *','ochahouse' ) . '</label>';
	echo '<input id="title_comment" name="title_comment" placeholder="'.esc_attr__('Give your review a title','ochahouse').'" type="text"   tabindex="4" aria-required="true"/></p>';
    echo '</p>';
    }

   }
}
//Review


function jws_add_question() {
$response = array();  
if(empty( $_POST['jws-product-questions'] ) || empty( $_POST['q-name'] ) || empty( $_POST['q-email'] )) {  
    $error_note = esc_html__('Please fill out required fields.','ochahouse');
    $response['note'] = $error_note;
    $response['status'] = 'error';
} else {
    // Add the content of the form to $post as an array
    $new_post = array(
        'post_title'    => $_POST['jws-product-questions'],
        'post_content'  => '',
        'tags_input'    => array($tags),
        'post_status'   => 'publish',           // Choose: publish, preview, future, draft, etc.
        'post_type' => 'questions'  //'post',page' or use a custom post type if you want to
    );
    
    if($pid = wp_insert_post($new_post)) { 
        
      update_post_meta($pid, 'product_questions', $_POST['product_id']);
      update_post_meta($pid, 'product_name', $_POST['q-name']);
      update_post_meta($pid, 'product_email', $_POST['q-email']);
      
      if ( is_user_logged_in() ) {
           $userid = get_current_user_id();
           update_post_meta($pid, 'user_id', $userid);
      }
    }
    
    $response['status'] = 'no_error';
 
}  
    
wp_send_json( $response );

  
}
add_action('wp_ajax_jws_add_question', 'jws_add_question');
add_action('wp_ajax_nopriv_jws_add_question', 'jws_add_question');

function wc_get_rating_html_compare( $rating ) { 
    if ( $rating > 0 ) { 
        $rating_html = '<div class="star-rating" title="' . sprintf( esc_attr__( 'Rated %s out of 5','ochahouse' ), $rating ) . '">'; 
        $rating_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . esc_html__( 'out of 5','ochahouse' ) . '</span>'; 
        $rating_html .= '</div>'; 
    } else { 
        $rating_html = ''; 
    } 
    return $rating_html; 
}

function jws_is_shop() {
	if ( class_exists( 'WooCommerce' ) && is_shop() ) { // Shop Page
		return 'shop';
	}

	return apply_filters( 'jws_is_shop', false );
}

function jws_get_page_base_url() {
    	if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
    		$link = home_url();
    	} elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id( 'shop' ) ) ) {
    		$link = get_post_type_archive_link( 'product' );
    	} elseif ( is_product_category() ) {
    		$link = get_term_link( get_query_var( 'product_cat' ), 'product_cat' );
    	} elseif ( is_product_tag() ) {
    		$link = get_term_link( get_query_var( 'product_tag' ), 'product_tag' );
    	} else {
    		$queried_object = get_queried_object();
    		$link   = get_term_link( $queried_object->slug, $queried_object->taxonomy );
    	}
    
    	return $link;
    }


function shop_banner_content() {
  global $jws_option;
  if ( isset($jws_option['select-banner-before-product']) ) {
  $id = $jws_option['select-banner-before-product']; 
  if(isset($_GET['shop_layout']) && ($_GET['shop_layout'] == '3' || $_GET['shop_layout'] == '4')) { 
    $id = ''; 
  } 
  ?>
    <div class="shop-banner-content">
        <?php
            echo do_shortcode('[hf_template id="'.$id.'"]');
        ?>
    </div>
  <?php  
  }  
}


function jws_short_text_after_title($id,$return) {
   if(isset($id) && !empty($id)) {
     $id = $id;
   } else {
     $id = get_the_ID();
   }
   
   global $jws_option; 
   if ( isset($jws_option['choose-attr-after-title']) ) { 
      
       $post_terms = wp_get_post_terms( $id, $jws_option['choose-attr-after-title'] );
    
       $content = '<p class="product-short-text">'; 
       foreach ( $post_terms as $term ) {
          $content .= esc_html($term->name);  
       }
    
       $content .= '</p>'; 
       if($return) {
        return $content;
       }else {
        echo ''.$content;
       }
   }  
}



function add_parameter_after_custom_link($link) {

		if ( isset( $_GET['layout'] ) ) {
			$link = add_query_arg( 'layout', wc_clean( $_GET['layout'] ), $link );
		}
        
        if ( isset( $_GET['lay_style'] ) ) {
			$link = add_query_arg( 'lay_style', wc_clean( $_GET['lay_style'] ), $link );
		}
        if ( isset( $_GET['shop_layout'] ) ) {
			$link = add_query_arg( 'shop_layout', wc_clean( $_GET['shop_layout'] ), $link );
		}  
        return $link;
}
if( ! function_exists( 'jws_product_product_summary_custom' ) ) {
	function jws_product_product_summary_custom() { 
    global $jws_option;
	   ?>
       <div class="product-meta-custom">
                    <?php if( class_exists('YITH_WCWL_Shortcode')) echo YITH_WCWL_Shortcode::add_to_wishlist(array());?>
	   </div>
    <?php } 
}
function jws_wc_waitlist_form() {
    global $product, $jws_option;
?>
    <div class="jws-waitlist-register">

    <form class="cart" action="<?php echo esc_url($product->get_permalink()); ?>" method="get">
            <?php jws_add_to_wishlist_single_btn(); ?>
          
            
    </form>

    </div>
    <?php
}

function jws_send_mail_waitlist($product_id) {
    $email_added = get_post_meta($product_id,'stock_email',true);
    if(!isset($email_added) || empty($email_added)) return false;
    global $jws_option;
    $subject_waitlist_email = (isset($jws_option['subject_waitlist_email']) && $jws_option['subject_waitlist_email'] ) ? $jws_option['subject_waitlist_email'] : 'A product you are waiting for is back in stock'; 
    $email_heading_waitlist = (isset($jws_option['email_heading_waitlist']) && $jws_option['email_heading_waitlist'] ) ? $jws_option['email_heading_waitlist'] : '{product_title} is now back in stock on {blogname}';  
    $email_content_waitlist = (isset($jws_option['email_content_waitlist']) && $jws_option['email_content_waitlist'] ) ? $jws_option['email_content_waitlist'] : 'Hi, {product_title} is now back in stock on {blogname}. You have been sent this email because your email address was registered in a waiting list for this product. If you would like to purchase {product_title}, please visit the following link: {product_link}';
    $url = get_permalink($product_id);
    $fields = array(
		'product_title'         => get_the_title($product_id),
		'product_link'        => $url,
		'blogname'         => get_bloginfo(),
	);
    foreach ( $fields as $tag => $value ) {
		if ( strpos( $email_content_waitlist, '{' . $tag . '}' ) !== false ) {
			$email_content_waitlist = str_replace( '{' . $tag . '}', $value, $email_content_waitlist );
		}
	} 
   
    $body = $email_content_waitlist;
    $headers = ['Content-Type: text/html; charset=UTF-8'];
    foreach($email_added as $to) {
        if(function_exists('jws_sv_ct3')) {
            $sent =   jws_sv_ct3($to, $subject_waitlist_email , $body, $headers );
            delete_post_meta($product_id, 'stock_email',$email_added);
        }      
    }      
}

	   

function jws_banner_product() {
    if (defined('ochahousecore') ) jws_product_share();
    $banner_meta = get_post_meta(get_the_ID(),'banner_product_image',true);
    if(!empty($banner_meta)) {
        echo '<img class="product_banner" src="'.$banner_meta.'">';
    }
}

add_action( 'woocommerce_single_product_summary', 'jws_banner_product', 50 ); 


/** Woocommerce CountDown Tabs Extention **/


add_filter( 'woocommerce_product_write_panel_tabs', 'jws_add_countdown_tab', 98 );
add_action( 'woocommerce_product_data_panels', 'jws_write_tab_options');


function jws_add_countdown_tab() {

    ?>
    
    <li class="product_countdown_options product_countdown_tab hide_if_grouped hide_if_external">
    	<a href="#product_countdown_tab"><span><?php esc_html_e( 'Product Countdown', 'ochahouse' ); ?></span></a>
    </li>

<?php

		}

function jws_write_tab_options() {

		global $post;

		$product = wc_get_product( $post );
		$sale_price_dates_from =  get_post_meta( $product->get_id(), '_jwspc_sale_price_dates_from', true );
		$sale_price_dates_to   =  get_post_meta( $product->get_id(), '_jwspc_sale_price_dates_to', true );


		?>

		<div id="product_countdown_tab" class="panel woocommerce_options_panel">

			<div class="options_group sales_countdown">

				<?php

				woocommerce_wp_checkbox(
					array(
						'id'            => '_jwspc_enabled',
						'wrapper_class' => '',
						'label'         => esc_html__( 'Enable ', 'ochahouse' ),
						'description'   => esc_html__( 'Enable Jws WooCommerce Product Countdown for this product', 'ochahouse' )
					)
				);
				?>
				<p class="form-field jwspc-dates">
					<label for="_jwspc_sale_price_dates_from"><?php esc_html_e( 'Countdown Dates', 'ochahouse' ) ?></label>
					<input type="text" autocomplete="off" class="short jwspc_sale_price_dates_from" name="_jwspc_sale_price_dates_from" id="_jwspc_sale_price_dates_from" value="<?php echo esc_attr( $sale_price_dates_from ) ?>" placeholder="<?php esc_html_e( 'From&hellip;', 'ochahouse' ) ?> YYYY-MM-DD" maxlength="10" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" />
					<input type="text" autocomplete="off" class="short jwspc_sale_price_dates_to" name="_jwspc_sale_price_dates_to" id="_jwspc_sale_price_dates_to" value="<?php echo esc_attr( $sale_price_dates_to ) ?>" placeholder="<?php esc_html_e( 'To&hellip;', 'ochahouse' ) ?>  YYYY-MM-DD" maxlength="10" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" />
					<?php echo esc_html__( 'The sale will end at the beginning of the set date.', 'ochahouse' ); ?>
				</p>
				<?php

				woocommerce_wp_text_input(
					array(
						'id'                => '_jwspc_discount_qty',
						'label'             => esc_html__( 'Discounted products', 'ochahouse' ),
						'placeholder'       => '',
						'desc_tip'          => 'true',
						'description'       => esc_html__( 'The number of discounted products.', 'ochahouse' ),
						'default'           => '0',
						'type'              => 'number',
						'custom_attributes' => array(
							'step' => 'any',
							'min'  => '0'
						)
					)
				);
				woocommerce_wp_text_input(
					array(
						'id'                => '_jwspc_sold_qty',
						'label'             => esc_html__( 'Already sold products', 'ochahouse' ),
						'placeholder'       => '',
						'desc_tip'          => 'true',
						'description'       => esc_html__( 'The number of already sold products.', 'ochahouse' ),
						'type'              => 'number',
						'custom_attributes' => array(
							'step' => 'any',
							'min'  => '0'
						)
					)
				);


				?>

			</div>
            
            <script>
            jQuery(function ($) {
     
                
                $("#_jwspc_sale_price_dates_from").datepicker({
                     dateFormat: 'yy-mm-dd',
                    onSelect: function() {
                        //- get date from another datepicker without language dependencies
                        var minDate = $('#_jwspc_sale_price_dates_from').datepicker('getDate');
                        $("#_jwspc_sale_price_dates_to").datepicker("change", { minDate: minDate , dateFormat: 'yy-mm-dd' });
                    }
                });
                
                $("#_jwspc_sale_price_dates_to").datepicker({
                     dateFormat: 'yy-mm-dd',
                    onSelect: function() {
                        //- get date from another datepicker without language dependencies
                        var maxDate = $('#_jwspc_sale_price_dates_to').datepicker('getDate');
                        $("#_jwspc_sale_price_dates_from").datepicker("change", { maxDate: maxDate , dateFormat: 'yy-mm-dd' });
                    }
                });
                
               
             } );
             </script>

		</div>

		<?php

	}
    
add_action( 'woocommerce_process_product_meta', 'jws_woocommerce_product_custom_fields_save' );   

function jws_woocommerce_product_custom_fields_save($post_id)
{
    $product         = wc_get_product( $post_id );
 
    if (isset($_POST['_jwspc_sale_price_dates_from']) && !empty($_POST['_jwspc_sale_price_dates_from'])) update_post_meta($product->get_id(), '_jwspc_sale_price_dates_from', esc_attr($_POST['_jwspc_sale_price_dates_from']));
    
    if (isset($_POST['_jwspc_sale_price_dates_to']) && !empty($_POST['_jwspc_sale_price_dates_to'])) update_post_meta($product->get_id(), '_jwspc_sale_price_dates_to', esc_attr($_POST['_jwspc_sale_price_dates_to']));
    
    if (isset($_POST['_jwspc_discount_qty']) && !empty($_POST['_jwspc_discount_qty'])) update_post_meta($product->get_id(), '_jwspc_discount_qty', esc_attr($_POST['_jwspc_discount_qty']));
    
    if (isset($_POST['_jwspc_sold_qty']) && !empty($_POST['_jwspc_sold_qty'])) update_post_meta($product->get_id(), '_jwspc_sold_qty', esc_attr($_POST['_jwspc_sold_qty']));
    
    $jwspc_enabled = isset($_POST['_jwspc_enabled']) && !empty($_POST['_jwspc_enabled']) ? 'yes' : 'no';
	update_post_meta( $product->get_id(), '_jwspc_enabled', $jwspc_enabled );

}

add_action( 'woocommerce_single_product_summary', 'jws_shop_single_countdown', 15 );  

function jws_shop_single_countdown() {
      $id = get_the_ID();  
      $enble = get_post_meta( $id , '_jwspc_enabled', true ); 
      if($enble == 'yes') {
      $countdown_time = get_post_meta( get_the_ID(), '_jwspc_sale_price_dates_to', true );   
      $html = '<div class="jws_single_count_down">';
            $html .= '<div class="count_down_top">';
            $html .= '<label><i class="jws-icon-alarm"></i>Hurry up! End of sale in</label>';
            $html .= '<div class="count_down"><div class="jws-sale-time" data-d="" data-h="" data-m="" data-s="" data-countdown="'.strtotime($countdown_time).'"></div></div>';
      $html .= '</div>';
            
            
      $units_sold = get_post_meta( get_the_ID() , '_jwspc_sold_qty', true );
      $total = get_post_meta( get_the_ID() , '_jwspc_discount_qty', true );
      
      if(!empty($units_sold) && !empty($total)) {
        $result = ($units_sold / $total) * 100;
        $html .= '<div class="progress-bar-sold">';
        $html .= '<span class="sold_count"><img src="'.JWS_URI_PATH . '/assets/image/fire.png">'.sprintf( __( 'Only %s item(s) left in stock', 'ochahouse' ), '<span>'.($total - $units_sold).'</span>').'</span>';
        $html .= '<span class="available_items">'.$units_sold.'/'.$total.esc_html__(' Sold','ochahouse').'</span>';
        $html .= '<p class="line"><span style="width:'.$result.'%"></span></p>';
        $html .= '</div>';
      } 
      $html .= '</div>';
      echo ''.$html; 
      }  
      
}

 

/** Woocommerce Customize Items Extention **/


add_filter( 'woocommerce_product_write_panel_tabs', 'jws_add_customize_items_tab', 98 );
add_action( 'woocommerce_product_data_panels', 'jws_customize_items_tab_options');


function jws_add_customize_items_tab() {

    ?>
    
    <li class="customize_items_options customize_items_tab hide_if_grouped hide_if_external">
    	<a href="#customize_items_tab"><span><?php esc_html_e( 'Jws Product Setting Items', 'ochahouse' ); ?></span></a>
    </li>

<?php

}

function jws_customize_items_tab_options() {

		global $post;

		$product = wc_get_product( $post );
		$sale_price_dates_from =  get_post_meta( $product->get_id(), '_jwspc_sale_price_dates_from', true );
		$sale_price_dates_to   =  get_post_meta( $product->get_id(), '_jwspc_sale_price_dates_to', true );


		?>

		<div id="customize_items_tab" class="panel woocommerce_options_panel">

			<div class="options_group">

				<?php

                    woocommerce_wp_checkbox(
    					array(
    						'id'            => 'jws_new_enabled',
    						'wrapper_class' => '',
    						'label'         => esc_html__( 'Enable New Label', 'ochahouse' ),
    						'description'   => esc_html__( 'Enable New Label display in product item', 'ochahouse' )
    					)
    				);

				?>

			</div>
		</div>
		<?php
	}



/**
 * Save the custom field
 * @since 1.0.0
 */
function jws_save_customize_items_field( $post_id ) {
 $product = wc_get_product( $post_id );

 $new = isset( $_POST['jws_new_enabled'] ) && !empty($_POST['jws_new_enabled']) ? 'yes' : 'no';

 $product->update_meta_data( 'jws_new_enabled', $new);


 $product->save();
}
add_action( 'woocommerce_process_product_meta', 'jws_save_customize_items_field' );


/**
 * Display custom field on the front end
 * @since 1.0.0
 */
function jws_display_customize_items_field() {
 global $post;
 // Check for the custom field value
 $product = wc_get_product( $post->ID );

 
 


 
 
 }
add_action( 'woocommerce_before_add_to_cart_button', 'jws_display_customize_items_field' );


function jws_validate_customize_items_field( $passed, $product_id, $quantity, $variation_id = '' ) {
 if(isset($_POST['enable_customize']) && $_POST['enable_customize']) {
      if(empty( $_POST['jws-engrave-field'] ) ) {
         wc_add_notice( __( 'Please enter a value into the text field', 'ochahouse' ), 'error' );
         $passed = false; 
     }   
 }  
  return $passed;
}


add_filter( 'woocommerce_add_to_cart_validation', 'jws_validate_customize_items_field', 21, 4 );

function jws_add_customize_items_field_item_data( $cart_item_data, $product_id, $variation_id, $quantity ) { 
 if( ! empty( $_POST['jws-engrave-field'] ) ) {
 $cart_item_data['engrave_field'] = $_POST['jws-engrave-field'];
 $cart_item_data['fonttype_field'] = $_POST['jws-fonttype-field'];
 }
 return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'jws_add_customize_items_field_item_data', 10, 4 );


function jws_customize_items_cart_item_name( $name, $cart_item, $cart_item_key ) {
 if( isset( $cart_item['engrave_field'] ) ) {
 $name .= sprintf(
 '<div class="engrave"><span>'. __( 'Font Type Text: ', 'ochahouse' ).'</span>%s</div>',
 esc_html( $cart_item['fonttype_field'] )
 );   
 $name .= sprintf(
 '<div class="engrave"><span>'. __( 'Engrave Text: ', 'ochahouse' ).'</span>%s</div>',
 esc_html( $cart_item['engrave_field'] )
 );
 }
 return $name;
}
add_filter( 'woocommerce_cart_item_name', 'jws_customize_items_cart_item_name', 10, 3 );


function jws_add_customize_items_data_to_order( $item, $cart_item_key, $values, $order ) {
 foreach( $item as $cart_item_key=>$values ) {
 if( isset( $values['engrave_field'] ) ) {
 $item->add_meta_data( __( 'Engrave Text: ', 'ochahouse' ), $values['engrave_field'], true );
 $item->add_meta_data( __( 'Font Type Text: ', 'ochahouse' ), $values['fonttype_field'], true );
 }
 }
}
add_action( 'woocommerce_checkout_create_order_line_item', 'jws_add_customize_items_data_to_order', 10, 4 );
function custom_pre_get_posts_query( $q ) {

    $tax_query = (array) $q->get( 'tax_query' );
    $meta_query = (array) $q->get( 'meta_query' );
  
    
    global $jws_option;

    if(isset($jws_option['exclude-product-in-shop']) && !empty($jws_option['exclude-product-in-shop'])) {
        $result = array_map('intval', array_filter($jws_option['exclude-product-in-shop'], 'is_numeric'));
    
       
           $q->set('post__not_in' , $result); // use integers
    
    }
    



    $q->set( 'tax_query', $tax_query );
    $q->set( 'meta_query', $meta_query );

   
}
add_action( 'woocommerce_product_query', 'custom_pre_get_posts_query' );
if(jws_theme_get_option('exclude-product-in-shop')) {
    add_filter( 'woocommerce_related_products', 'exclude_related_products', 10, 3 );
    function exclude_related_products( $related_posts, $product_id, $args ){
        global $jws_option;
        $exclude_ids = '';
       
           $result = array_map('intval', array_filter($jws_option['exclude-product-in-shop'], 'is_numeric'));
            // HERE set your product IDs to exclude
            $exclude_ids = $result;
        
            return array_diff( $related_posts, $exclude_ids );
      
    
    }
}

add_filter( 'woocommerce_should_load_paypal_standard', 'jws_load_paypal_stadard', 11, 2 );
function jws_load_paypal_stadard( $should_load, $instance ) {
    $should_load = true;
    return $should_load;
 }
 
 
 
 
 
 
 
 
 
add_filter( 'comments_template_query_args', 'filter_comments2' , 20 );

function filter_comments2( $comment_args ) {
	global $post;
	if( get_post_type() === 'product' ) {
	
			$rating = intval( '6' );
           
			if( $rating > 0 && $rating <= 6 ) {
				$comment_args['meta_query'][] = array(
					'key' => 'rating',
					'value'   => $rating,
					'compare' => '<=',
					'type'    => 'numeric'
				);
                
                if(isset($_GET['sort']) && $_GET['sort'] == 'date-ASC') {
                   $comment_args['order'] = 'DESC'; 
                }
                
                if(isset($_GET['sort']) && $_GET['sort'] == 'rating-ASC') {
                   $comment_args['order'] = 'DESC'; 
                }
                
                
                if(isset($_GET['sort']) && ($_GET['sort'] == 'rating-DESC' || $_GET['sort'] == 'rating-ASC')) { 
	                $comment_args['orderby'] = 'meta_value_num'; 
                }
                
                
                
                
                
                
				$page = (int) get_query_var( 'cpage' );
				if ( $page ) {
					$comment_args['offset'] = ( $page - 1 ) * $comment_args['number'];
				} elseif ( 'oldest' === get_option( 'default_comments_page' ) ) {
					$comment_args['offset'] = 0;
				} else {
					// If fetching the first page of 'newest', we need a top-level comment count.
					$top_level_query = new WP_Comment_Query();
					$top_level_args  = array(
						'count'   => true,
						'orderby' => false,
						'post_id' => $post->ID,
						'status'  => 'approve',
						//'meta_query' => $comment_args['meta_query']
					);

					if ( $comment_args['hierarchical'] ) {
						$top_level_args['parent'] = 0;
					}

					if ( isset( $comment_args['include_unapproved'] ) ) {
						$top_level_args['include_unapproved'] = $comment_args['include_unapproved'];
					}

					$top_level_count = $top_level_query->query( $top_level_args );
					if( isset( $comment_args['number'] ) && $comment_args['number'] > 0 ) {
						$comment_args['offset'] = ( ceil( $top_level_count / $comment_args['number'] ) - 1 ) * $comment_args['number'];
					} else {
						$comment_args['offset'] = 0;
					}
				}
			}

		
	}
	return $comment_args;
}
