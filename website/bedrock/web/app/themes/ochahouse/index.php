<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage ochahouse
 * @since 1.0.0
 */

get_header();
wp_enqueue_script( 'stick-content', JWS_URI_PATH. '/assets/js/sticky_content.js', array(), '', true );
global $jws_option;

$jws_option['position_sidebar'] = isset($_GET['sidebar']) ? $_GET['sidebar'] : (isset($jws_option['position_sidebar']) ? $jws_option['position_sidebar'] : 'right');
 
if((isset($jws_option['position_sidebar']) && $jws_option['position_sidebar'] == 'full') ) {
   $content_col = ' col-12 jws-blog-element'; 
   $sidebar_col = 'postt_sidebar';
   $class = ' no_sidebar';
}else {
   $content_col = 'post_content col-xl-8 col-lg-12 col-12 jws-blog-element';
   $sidebar_col = 'post_sidebar col-xl-4 col-lg-12 col-12'; 
   $class = ' has_sidebar'; 
}
$layout = isset($_GET['layout']) ? $_GET['layout'] : (isset($jws_option['blog_layout']) ? $jws_option['blog_layout'] : 'layout1');
?>
<div id="primary" class="content-area">
		<main id="main" class="site-main jws-blog-archive <?php echo 'sidebar-'.esc_attr($jws_option['position_sidebar']); ?>">
        <div class="container">
        <div class="row">
             <?php if(isset($jws_option['position_sidebar']) && $jws_option['position_sidebar'] == 'left') : ?>
                <div class="<?php echo esc_attr($sidebar_col); ?>">
                    <div class="main-sidebar">
                        	<?php
                                if (isset($jws_option['select-sidebar-post']) && !empty($jws_option['select-sidebar-post'])) { 
                                             echo do_shortcode('[hf_template id="' . $jws_option['select-sidebar-post'] . '"]'); 
                                }else {
                                   if ( is_active_sidebar( 'sidebar-main' ) ) {
                        			     dynamic_sidebar( 'sidebar-main' );
                        		   } 
                                }	
    		                 ?>
                    </div>
                </div>
            <?php endif; ?> 
            <div class="<?php echo esc_attr($content_col); ?>">
                <div class="jws_blog_grid jws_blog_layout1 <?php echo esc_attr($layout); ?>">
                	<?php if ( have_posts() ) :
            			while ( have_posts() ) :
            				the_post();
      
            				/*
            				 * Include the Post-Format-specific template for the content.
            				 * If you want to override this in a child theme, then include a file
            				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
            				 */
            				get_template_part( 'template-parts/content/content' );
            
            				// End the loop.
            			endwhile;
            
            
            			// If no content, include the "No posts found" template.
            		else :
            			get_template_part( 'template-parts/content/content', 'none' );
            
            		endif;
            		?>
                    </div> 
                    <?php global $wp_query;   echo function_exists('jws_query_pagination') ? jws_query_pagination($wp_query) : ''; ?>
            </div>
            <?php if((isset($jws_option['position_sidebar']) && $jws_option['position_sidebar'] == 'right') ) : ?>
                <div class="<?php echo esc_attr($sidebar_col); ?>">
                    <div class="main-sidebar jws_sticky_move">
                        	<?php
                                if (isset($jws_option['select-sidebar-post']) && !empty($jws_option['select-sidebar-post'])) { 
                                             echo do_shortcode('[hf_template id="' . $jws_option['select-sidebar-post'] . '"]'); 
                                }else {
                                   if ( is_active_sidebar( 'sidebar-main' ) ) {
                        			     dynamic_sidebar( 'sidebar-main' );
                        		   } 
                                }	
    		                 ?>
                    </div>
                </div>
            <?php endif; ?>    
        </div>
	
        </div>
		</main><!-- #main -->
	</div><!-- #primary -->  
<?php
get_footer();