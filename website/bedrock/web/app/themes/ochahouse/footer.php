<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage ochahouse
 * @since 1.0.0
 */
 
 

 

 
 

$page_turn_off_footer = get_post_meta(get_the_ID(), 'turn_off_footer', true); 

global $jws_option; 
$parallax = (isset($jws_option['footer-switch-parallax']) && $jws_option['footer-switch-parallax']) ? ' footer-parallax' : '';
?>
	</div><!-- #content -->
	<footer id="colophon" class="site-footer<?php echo esc_attr($parallax); ?>">
        <?php 
     
            if((isset($page_turn_off_footer) && !$page_turn_off_footer) || is_search()) {
               if(function_exists('jws_footer')) jws_footer();   
            }
        ?>
	</footer><!-- #colophon -->

</div><!-- #page -->
   
<?php wp_footer(); ?>
</body>
</html>
