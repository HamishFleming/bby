<?php
/**
 * Render custom styles.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jws_custom_css' ) ) {
	function jws_custom_css( $css = array() ) {
    $page_id     = get_queried_object_id();
		if(is_shop()){
		 $page_id     = 	wc_get_page_id( 'shop' );
		}
		
            $background_page = get_post_meta($page_id, 'page_select_background_color', true);

    $main_color_custom = get_post_meta($page_id, 'main_color', true);
    $bg_btn_color_custom = get_post_meta($page_id, 'button-bgcolor', true);
    $bg_btn_color2_custom = get_post_meta($page_id, 'button-bgcolor2', true);
    global $jws_option;
        /* Main Width */
        
        $website_width = (isset($jws_option['container-width']) && $jws_option['container-width']) ? $jws_option['container-width'] : '1200';
        $website_laptop_width = (isset($jws_option['container-laptop-width']) && $jws_option['container-laptop-width']) ? $jws_option['container-laptop-width'] : '1200';
        $website_ipad_width = (isset($jws_option['container-ipad-width']) && $jws_option['container-ipad-width']) ? $jws_option['container-ipad-width'] : '86';
        $website_mobile_width = (isset($jws_option['container-mobile-width']) && $jws_option['container-mobile-width']) ? $jws_option['container-mobile-width'] : '82';
        
        
        $main_color = (isset($jws_option['main-color']) && $jws_option['main-color']) ? $jws_option['main-color'] : '#2E524A';
		 $secondary_color = (isset($jws_option['secondary-color']) && $jws_option['secondary-color']) ? $jws_option['secondary-color'] : '';
		 $color_accent = (isset($jws_option['color_accent']) && $jws_option['color_accent']) ? $jws_option['color_accent'] : '';
		$color_accent_secondary = (isset($jws_option['color_accent_secondary']) && $jws_option['color_accent_secondary']) ? $jws_option['color_accent_secondary'] : '';
		         $heading_color = (isset($jws_option['color_heading']) && $jws_option['color_heading']) ? $jws_option['color_heading'] : '#151b26';

        $body_color = (isset($jws_option['color_body']) && $jws_option['color_body']) ? $jws_option['color_body'] : '';
        $light_color = (isset($jws_option['color_light']) && $jws_option['color_light']) ? $jws_option['color_light'] : '#ffffff';
        $bg_btn_color = (isset($jws_option['button-bgcolor']) && $jws_option['button-bgcolor']) ? $jws_option['button-bgcolor'] : '';
        $bg_btn_color2 = (isset($jws_option['button-bgcolor2']) && $jws_option['button-bgcolor2']) ? $jws_option['button-bgcolor2'] : '';
        $btn_color = (isset($jws_option['button-color']) && $jws_option['button-color']) ? $jws_option['button-color'] : '';
        $body_color_dark = (isset($jws_option['color_body_dark']) && $jws_option['color_body_dark']) ? $jws_option['color_body_dark'] : '';
       
        $background_thumbnail = (isset($jws_option['color_thumbnail']) && $jws_option['color_thumbnail']) ? $jws_option['color_thumbnail'] : '';
        if ( $website_width ) { 
            	      $css[] = '@media only screen and (min-width: 1441px) {.container , .elementor-section.elementor-section-boxed > .elementor-container { max-width: ' . esc_attr( $website_width ) . 'px !important}}';  
        }
        if ( $website_laptop_width ) { 
            	      $css[] = '@media only screen and (max-width: 1440px) {.container , .elementor-section.elementor-section-boxed > .elementor-container { max-width: ' . esc_attr( $website_laptop_width ) . 'px !important}}';  
        }
           if ( $website_ipad_width ) { 
            	      $css[] = '@media only screen and (max-width: 820px) {.container , .elementor-section.elementor-section-boxed > .elementor-container.jws_section_  { max-width: ' . esc_attr( $website_ipad_width ) . '% !important}}';  
        }
           if ( $website_mobile_width ) { 
            	      $css[] = '@media only screen and (max-width: 480px) {.container , .elementor-section.elementor-section-boxed > .elementor-container.jws_section_ { max-width: ' . esc_attr( $website_mobile_width ) . '% !important}}';  
        }

    
	
        
    
   
     
     
        
          $css[] = ':root{
            --e-global-color-primary:' . esc_attr( $main_color ) . '; 
            --main: ' . esc_attr( $main_color ).';
            --e-global-color-secondary:'.esc_attr($secondary_color).';
			--secondary:'.esc_attr($secondary_color).';
			--accent:'.esc_attr($color_accent).';
			--e-global-color-accent:'.esc_attr($color_accent).';
			--accent_second:'.esc_attr($color_accent_secondary).';
            --body:' . esc_attr( $body_color ) . ';
            --text:'. esc_attr( $body_color ) . ';
            --light:' . esc_attr( $light_color ) . ';
            --btn-color:' . esc_attr( $btn_color ) . ';
            --btn-bgcolor:' . esc_attr( $bg_btn_color ) . ';
            --btn-bgcolor2:' . esc_attr( $bg_btn_color2 ) . ';
            --heading:'.esc_attr($heading_color).';
			--bacground_thumbnail:'.esc_attr($background_thumbnail).';
			--body-dark:'.esc_attr($body_color_dark).';
          }';
        
        
        /* Custom Page Color */
        
        if($background_page=='color_body') {
          $css[] = 'body {background-color:var(--body) !important;'. '}';   
        }elseif($background_page=='color_body_dark'){
          $css[] = 'body {background-color:var(--body-dark) !important;'. '}';     
        }
        if(!empty($main_color_custom)) {
          $css[] = 'body {--e-global-color-primary:' . esc_attr( $main_color_custom ) . ' !important; --main: ' . esc_attr( $main_color_custom ) . '}';   
        }
        if(!empty($bg_btn_color_custom)) {
          $css[] = 'body {--btn-bgcolor: ' . esc_attr( $bg_btn_color_custom ) . '}';   
        }
        if(!empty($bg_btn_color2_custom)) {
          $css[] = 'body {--btn-bgcolor2: ' . esc_attr( $bg_btn_color2_custom ) . '}';   
        }
        
         /* Custom Font Family */
         $font2 = (isset($jws_option['opt-typography-font2']['font-family']) && $jws_option['opt-typography-font2']['font-family']) ? $jws_option['opt-typography-font2']['font-family'] : 'betterworks';
         $body_font = (isset($jws_option['opt-typography-body']['font-family']) && $jws_option['opt-typography-body']['font-family']) ? $jws_option['opt-typography-body']['font-family'] : 'Urbanist';
         $css[] = 'body {--body-font: ' . esc_attr( $body_font ) . ';--font2: ' . esc_attr( $font2 ) . ';}'; 

        $header_absolute = (isset($jws_option['choose-header-absolute']) && $jws_option['choose-header-absolute']) ? $jws_option['choose-header-absolute'] : '';
         if(!empty($header_absolute)) {
            foreach($header_absolute as $value) {
               $css[] ='.jws_header > .elementor-'.$value.'{position:absolute;width:100%;left:0;top:0;}' ;  
            }
         }

		return preg_replace( '/\n|\t/i', '', implode( '', $css ) );
	}
}