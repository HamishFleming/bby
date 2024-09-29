<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
} 
// **********************************************************************// 
// ! Add favicon 
// **********************************************************************// 
if (!function_exists('jws_favicon')) {
    function jws_favicon()
    {

        if (function_exists('has_site_icon') && has_site_icon()) return '';

        // Get the favicon.
        $favicon = '';


        global $jws_option;
        
        if(isset($jws_option['favicon']) && !empty($jws_option['favicon'])) {
            $favicon = $jws_option['favicon']['url'];
        }

        ?>
        <link rel="shortcut icon" href="<?php echo esc_attr($favicon); ?>">
        <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo esc_attr($favicon); ?>">
        <?php
    }

    add_action('wp_head', 'jws_favicon');
}

if (!function_exists('jws_logo_url')) {
    function jws_logo_url()
    {

        $logo = '';
        global $jws_option;
        
        if(isset($jws_option['logo']) && !empty($jws_option['logo'])) {
            if(!empty($jws_option['logo'])) {
                $logo = $jws_option['logo']['url'];
            }
        }
        
        return $logo;

      
    }
}

//Lets add Open Graph Meta Info
 
function jws_insert_fb_in_head() {
    global $post;
    if ( !is_singular()) //if it is not a post or a page
        return;
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
        echo '<meta property="og:type" content="article"/>';
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
        echo '<meta property="og:site_name" content="'.get_bloginfo( 'name' ).'"/>';
    if(has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
        echo '<meta property="og:image" content="' . esc_attr( !empty($thumbnail_src[0]) ? $thumbnail_src[0] : '' ) . '"/>';
        echo '<meta property="og:image:secure_url" content="' . esc_attr( !empty($thumbnail_src[0]) ? $thumbnail_src[0] : ''  ) . '">';
        echo '<meta property="og:image:width" content="500">';
        echo '<meta property="og:image:height" content="400">';
        echo '<meta property="og:description" content="'.get_the_excerpt().'">';
    }

    echo "
";
}
add_action( 'wp_head', 'jws_insert_fb_in_head', 5 );

add_filter('pre_option_default_role', function($default_role){
    return 'private_seller'; // This is changed
    return $default_role; // This allows default
});


function jws_update_custom_roles() {
    add_role(
       'private_seller',
       'Private seller',
        array( 'read' => true, 'level_0' => true , 'edit_profile' => false ) 
    );
    add_role(
       'business_seller',
       'Business seller',
        array( 'read' => true, 'level_0' => true , 'edit_profile' => false ) 
    );
}
add_action( 'init', 'jws_update_custom_roles' );



/**
 * Add extra initialisation for Contact 7 Form in Elementor popups.
 **/
add_action( 'wp_footer', 'jws_back_top_top'); 
function jws_back_top_top() {
    global $jws_option;
    $layout = (isset($jws_option['to-top-layout'])) ? $jws_option['to-top-layout'] : 'with-shadow';
    $class = 'backToTop fas fa-arrow-up ';
    $class .= $layout;
    if(isset($jws_option['box-change-style']) && $jws_option['box-change-style']) {
        require_once JWS_ABS_PATH.'/inc/box-style.php';
    }
    ?>
        <a href="#" class="<?php echo esc_attr($class); ?>"></a>
    <?php
}

/**
 * Add toolbar for mobile.
 **/
 


/**
 * Add toolbar for mobile.
 **/
add_action( 'wp_footer', 'jws_form_login_popup'); 
function jws_form_login_popup() {
    global $jws_option;
    ?>
        <div class="jws-form-login-popup">
            <div class="jws-form-overlay"></div>
            <div class="jws-form-content">
                <div class="jws-close"><i aria-hidden="true" class="jws-icon-cross"></i></div>
                <?php jws_get_content_form_login(true,true,'login'); ?>
            </div>
        </div>
    <?php
}





/**
 * Add extra initialisation for Contact 7 Form in Elementor popups.
 **/
function jws_ct_body_classes( $classes ) {
    global $jws_option;
    $layout = (isset($jws_option['button-layout'])) ? $jws_option['button-layout'] : 'default';
    $classes[] = 'button-'.$layout;
    if ( !is_user_logged_in() ) {
            $classes[] = 'user-not-logged-in';
    }

    $layoutcars = (isset($jws_option['cars-detail-layout'])) ? $jws_option['cars-detail-layout'] : 'layout1';
    
    if(isset($_GET['car_layout']) && $_GET['car_layout'] == 'layout2') {
         $layoutcars =  'layout2';
    }
    if($layoutcars == 'layout2') {
       $classes[] = 'hidden-title-bar'; 
    }
    
    if(isset($jws_option['shop_single_layout'])) {
       $classes[] = 'single-product-'.$jws_option['shop_single_layout']; 
    }
    
    if(!did_action( 'elementor/loaded' )) {
       $classes[] = 'not-elementor';  
    }
    /** Footer **/
    if(isset($jws_option['footer-switch-parallax']) && $jws_option['footer-switch-parallax']) {
    $classes[] = 'footer-parallax';
    }
    /** rtl **/
    $classes[] = (isset($jws_option['rtl']) && $jws_option['rtl']) ? 'rtl' : '';
    
      
    return $classes;
}
add_filter( 'body_class','jws_ct_body_classes' );

function jws_mini_cart_content2() { ?>
        <div class="jws-mini-cart-wrapper">
            <div class="jws-cart-sidebar">
                <div class="jws_cart_content">
                </div>
            </div>
            <div class="jws-cart-overlay"></div>
        </div>   
<?php }
if (class_exists('Woocommerce')) { 
   add_action( 'wp_footer', 'jws_mini_cart_content2' ); 
}

function jws_filter_backups_demos($demos)
	{
		$demos_array = array(
			'ochahouse' => array(
				'title' => esc_html__('Ochahouse', 'ochahouse'),
				'screenshot' => 'https://jwsuperthemes.com/import_demo/ochahouse/screenshot.jpg',
				'preview_link' => 'http://ochahouse.jwsuperthemes.com/',
			),
     
		);
        $download_url = 'https://jwsuperthemes.com/import_demo/ochahouse/download-script/';
		foreach ($demos_array as $id => $data) {
			$demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
				'url' => $download_url,
				'file_id' => $id,
			));
			$demo->set_title($data['title']);
			$demo->set_screenshot($data['screenshot']);
			$demo->set_preview_link($data['preview_link']);
			$demos[$demo->get_id()] = $demo;
			unset($demo);
		}
		return $demos;
}
add_filter('fw:ext:backups-demo:demos', 'jws_filter_backups_demos');
if (!function_exists('jws_deactivate_plugins')){
	function jws_deactivate_plugins() {
		deactivate_plugins(array(
			'brizy/brizy.php'
		));    
		
	}
}
add_action( 'admin_init', 'jws_deactivate_plugins' );


if(class_exists('jws_theme_jwsLove') && !function_exists('post_favorite') ) {
    function post_favorite($return = '',$unit = '',$show_icon = true) {
    	global $post_favorite , $post;
        $love_count = get_post_meta(get_the_ID(), '_jws_love', true);
        if($love_count == '1') {
           $unit = esc_html__(' like','ochahouse'); 
        }else{
           $unit = esc_html__(' likes','ochahouse');  
        }
    	if($return == 'return') {
    		return $post_favorite->add_love($unit,$show_icon);
    	} else {
    		echo ''.$post_favorite->add_love($unit,$show_icon);
    	}
    }    
}

function jws_store_location_search($atts) {
     $a = shortcode_atts( array(
		'url' => '',
	), $atts );
    ob_start();
    ?>
        <form class="jws-wpsl-search" action="<?php  echo ''.$a['url']; ?>" method="get">
            <input name="search-location" type="text" autocomplete="off" placeholder="<?php echo esc_attr__('Enter Starting Address...','ochahouse'); ?>" />
            <button type="submit"><?php echo esc_html__('Find Us','ochahouse'); ?></button>
        </form>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return ent2ncr($output);
}   

if(function_exists('insert_shortcode')) {
    insert_shortcode('wpsl_search','jws_store_location_search');
}

add_action('wp_dropdown_users_args', 'filter_authors');
function filter_authors( $args ) {
	if ( isset( $args['who'])) {
		$args['role__in'] = ['author', 'editor', 'administrator', 'manager' , 'private_seller' , 'business_seller'];
		unset( $args['who']);
	}
	return $args;
}

if (defined('ochahousecore')) {

add_action( 'admin_menu', 'jws_add_menu_page' );


}

if(!function_exists('jws_add_menu_page')) {
  function jws_add_menu_page() {
    add_menu_page( 'Jws Settings', 'Jws Settings', 'manage_options', 'jws_settings.php', 'jws_settings', '', 3 );
  
  }  
}


// Hide all posts from users who are not logged-in or are not administrators or members
function jws_exclude_posts($query) {
  global $jws_option;
  if(isset($jws_option['exclude-blog']) && !empty($jws_option['exclude-blog'])) {
     $result = array_map('intval', array_filter($jws_option['exclude-blog'], 'is_numeric'));
     if(!is_admin() && $query->is_main_query()){
        set_query_var('post__not_in', $result);
    }  
  }
}
add_action('pre_get_posts', 'jws_exclude_posts');


