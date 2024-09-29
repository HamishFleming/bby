<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product , $jws_option;
$layout = (isset($jws_option['shop_layout']) && !empty($jws_option['shop_layout']) ) ? $jws_option['shop_layout'] : 'layout4';
$columns = (isset($jws_option['shop_columns']) && !empty($jws_option['shop_columns']) ) ? $jws_option['shop_columns'] : '3';
$getlayout   = isset($_GET['lay_style']) ? $_GET['lay_style'] : $columns; 

$skel = 'skel-mask';
if($getlayout == '1') {
    $columns = ' col-12';
    $skel .= ' skel-list';
}
if($getlayout == '4') {
    $columns = ' col-xl-3 col-lg-6 col-12';
}
if($getlayout == '2') {
    $columns = ' col-xl-6 col-lg-6 col-12';
}
if($getlayout == '3') {
    $columns = ' col-xl-4 col-lg-6 col-12';
}

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

if(isset($_GET['shop_layout']) && $_GET['shop_layout'] == '1' ) {
  $layout = 'layout1';  
}elseif(isset($_GET['shop_layout']) && $_GET['shop_layout'] == '2') {
  $layout = 'layout2';   
}elseif(isset($_GET['shop_layout']) && $_GET['shop_layout'] == '3') {
  $layout = 'layout3';   
}
elseif(isset($_GET['shop_layout']) && $_GET['shop_layout'] == '4') {
  $layout = 'layout4';   
}


?>

<div class="product-item product <?php echo esc_attr($columns);?>">
    <script type="text/template" class="load-template">
    <?php 
        ob_start();
        if(!empty($layout) && $getlayout != '1') {
            wc_get_template_part( 'archive-layout/content-'.$layout.'');  
        }else {
           wc_get_template_part( 'archive-layout/content-list');   
        } 
        echo json_encode( ob_get_clean() )
    ?>
    </script>
    <div class="<?php echo esc_attr($skel); ?>"></div>
</div>