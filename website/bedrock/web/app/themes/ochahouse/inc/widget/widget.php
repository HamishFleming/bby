<?php 	
    require_once 'post-rent.php';
if (class_exists('Woocommerce')) { 
  require_once 'woocommerce-filter-attr.php';
  require_once 'product-category-list.php';
  require_once 'product-search.php';  
  require_once 'widget-filter-product.php';  
  require_once 'reset_filter.php'; 
  require_once 'class-wc-widget-layered-nav-filters.php';
  require_once 'product_checkbox_filter.php';
 
}