<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $jws_option;

$columns = (isset($jws_option['shop_columns']) && !empty($jws_option['shop_columns']) ) ? $jws_option['shop_columns'] : '3';
$getlayout   = isset($_GET['lay_style']) ? $_GET['lay_style'] : $columns; 


$layout = (isset($jws_option['shop_layout']) && $getlayout != '1' ) ? $jws_option['shop_layout'] : '';

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
if($getlayout == '1') {
    $layout = '';
}


?>

<div class="products-wrap products-tab row <?php echo esc_attr($layout); ?>">

