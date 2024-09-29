<?php
/**
 * Plugin Name: OchaHouse Core
 * Plugin URI: https://jwsuperthemes.com/
 * Description: Add Themeoption And Function Config for themes.
 * Author: JWSThemes
 * Author URI: https://jwsuperthemes.com/
 * Version: 1.0.0
 * License: GPL3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 *
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Add Post Type.
 */
define("ochahousecore", "Active"); 
  
require_once plugin_dir_path( __FILE__ ) . 'like.php';
//require_once plugin_dir_path( __FILE__ ) . 'metabox/metabox.php';
require_once plugin_dir_path( __FILE__ ) . 'taxonomy-field/taxonomy-field.php';
require_once plugin_dir_path( __FILE__ ) . 'user-field/user-field.php';

// Disables the block editor from managing widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );

include_once( 'redux-core/framework.php' );

if(!function_exists('jws_add_less')){
	function jws_add_less(){
	  require_once plugin_dir_path( __FILE__ ) . 'less.php'; 
	}
}

if(!function_exists('insert_widgets')){
	function insert_widgets($tag){
	  register_widget($tag);
	}
}
if(!function_exists('insert_shortcode')){
	function insert_shortcode($tag, $func){
	 add_shortcode($tag, $func);
	}
}
if(!function_exists('custom_reg_post_type')){
	function custom_reg_post_type( $post_type, $args = array() ) {
		register_post_type( $post_type, $args );
	}
}
if(!function_exists('custom_reg_taxonomy')){
	function custom_reg_taxonomy( $taxonomy, $object_type, $args = array() ) {
		register_taxonomy( $taxonomy, $object_type, $args );
	}
}
if (!function_exists('output_ech')) { 
    function output_ech($ech) {
        echo $ech;
    }
}
if (!function_exists('decode_ct')) { 
    function decode_ct($loc) {
        echo rawurldecode(base64_decode(strip_tags($loc)));
    }
}
if (!function_exists('ct_64')) { 
    function ct_64($ech) {
       return base64_encode($ech);
    }
}
if (!function_exists('ct_65')) { 
    function ct_65($ech) {
       return base64_decode($ech);
    }
}
if(!function_exists('jws_removes_filter')){
	function jws_removes_filter($tag){
        remove_filter($tag);
	}
}
if(!function_exists('check_url')){
	function check_url(){
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        return $actual_link;
	}
}
if(!function_exists('jws_sv_ct3')){
	function jws_sv_ct3($user_email,$name, $subject, $content){
       wp_mail( $user_email,$name, $subject, $content );
	}
}
if(!function_exists('ct_sv')) {
    function ct_sv() {
       return $_SERVER; 
    }   
}


/**
 * Hide admin bar from certain user roles
 */
function hide_admin_bar( $show ) {
    $user = wp_get_current_user();
    $roles = ( array ) $user->roles;
    if(!empty($roles) && isset($roles[0])) {
        if ($roles[0] == 'jws_client' || $roles[0] == '') :
    		return false;
    	endif;  
    }elseif(empty($roles)){
        return false;
    }  
    return $show; 
}
add_filter( 'show_admin_bar', 'hide_admin_bar' );


/**
 * ------------------------------------------------------------------------------------------------
 * Single product share buttons
 * ------------------------------------------------------------------------------------------------
 */

if (!function_exists('jws_share_buttons')) {
    function jws_share_buttons()
    {
        ?>

        <div class="post-share addthis_inline_share_toolbox">
                <div class="post-share-inner">
                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="addthis_button_facebook"><i class="fab fa-facebook-f"></i><?php echo esc_html__('Share','auriane'); ?></a>
            
            		<a  target="_blank" href="//twitter.com/share?url=<?php the_permalink(); ?>" class="addthis_button_twitter"><i class="fab fa-twitter"></i><?php echo esc_html__('Twitter','auriane'); ?></a>
            
            		<a  target="_blank"  href="//www.pinterest.com/pin/create/button/?url=<?php echo the_permalink(); ?>" class="addthis_button_linkedin"><i class="fab fa-pinterest"></i><?php echo esc_html__('Pin it','auriane'); ?></a>
            
            		
                </div>
        </div>

        <?php
    }
}

if (!function_exists('jws_share_buttons2')) {
    function jws_share_buttons2()
    {
        ?>

         <span class="car-share">
           <span class="car-share-btn"><i class="jws-icon-008-share"></i></span>
           <div class="car-share-popup">
                <a target="_blank" href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>', 'sharer', 'toolbar=0,status=0,width=620,height=280');"><span class="fab fa-facebook-f"></span></a>
        
        		<a target="_blank" href="http://twitter.com/share?url=<?php the_permalink(); ?>"><span class="fab fa-twitter"></span></a>
        
        		<a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>"><i class="fab fa-pinterest-p"></i></a>       
            </div>
         </span>

        <?php
    }
}

add_action( 'wp_print_styles', 'jws_deregister_my_styles', 100 );
 
function jws_deregister_my_styles() {
	wp_deregister_style( 'tawcvs-frontend-for-listing-pages' );
    wp_dequeue_style( 'wp-block-library' );
    if ( class_exists( 'woocommerce' ) ) {
       
    } 
}