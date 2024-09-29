<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/result-count.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $jws_option;
if(isset($_GET['layout']) && $_GET['layout']) { 
  $position = $_GET['layout'];  
}else{
  $position = (isset($jws_option['shop_position_sidebar']) && $jws_option['shop_position_sidebar']) ? $jws_option['shop_position_sidebar'] : 'no_sidebar';  
}



?>
<div class="row shop-nav-top">
    <div class="col-xl-7 col-lg-7 col-6">


     
         <p class="woocommerce-result-count">
        	<?php
            	// phpcs:disable WordPress.Security
            	if ( 1 === intval( $total ) ) {
            		_e( 'Single result', 'ochahouse' );
            	} elseif ( $total <= $per_page || -1 === $per_page ) {
            		/* translators: %d: total results */
            		printf( _n( '%d product', '%d products', $total, 'ochahouse' ), $total );
            	} else {
            		$first = ( $per_page * $current ) - $per_page + 1;
            		$last  = min( $total, $per_page * $current );
                  
            		/* translators: 1: first result 2: last result 3: total results */
            		printf( _nx( 'Showing %1$d&ndash;%2$d of %3$d result', 'Showing %1$d&ndash;%2$d of %3$d results', $total, 'with first and last result', 'ochahouse' ), $first, $last, $total );
            	}
            	// phpcs:enable WordPress.Security
        	?>
        </p>
        <?php
       
            if($position != 'left' && $position != 'right') { ?>
                <button class="show_filter_shop"><span class="jws_filter"></span><span><?php echo esc_html__('Filter','ochahouse'); ?></span></button> 
        <?php } else {?>
            <button class="show_filter_shop hidden_dektop"><span class="jws_filter"></span><span><?php echo esc_html__('Sidebar','ochahouse'); ?></span></button> 
        <?php }
        
        ?>
</div>