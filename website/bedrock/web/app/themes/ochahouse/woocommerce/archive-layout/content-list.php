  
     <?php 
    global $product; 
  
  if(!$product->is_in_stock()){
   
    $btn = 'out_of';
    }else{
       $btn = ''; 
    }?>
  <div class="product-item-inner list">
    <div class="product-image">
       
        <?php 
            /**
        	 * Hook: woocommerce_before_shop_loop_item.
        	 *
        	 * @hooked woocommerce_template_loop_product_link_open - 10
        	 */
        	do_action( 'woocommerce_before_shop_loop_item' );
        
        	/**
        	 * Hook: woocommerce_before_shop_loop_item_title.
        	 *
        	 * @hooked woocommerce_show_product_loop_sale_flash - 10
        	 * @hooked woocommerce_template_loop_product_thumbnail - 10
        	 */
        	do_action( 'woocommerce_before_shop_loop_item_title' );
            $size = isset($image_size) ? $image_size : 'woocommerce_thumbnail';
            echo woocommerce_get_product_thumbnail($size);
            
        	/**
        	 * Hook: woocommerce_after_shop_loop_item.
        	 *
        	 * @hooked woocommerce_template_loop_product_link_close - 5
        	 * @hooked woocommerce_template_loop_add_to_cart - 10
        	 */
        	do_action( 'woocommerce_after_shop_loop_item' );
            ?>
            <div class="buttton-inner buttton-inner_vertical">
                    <?php jws_button_product_grid($cart = false , $wishlist = true , $quickview = true); ?>
            </div>
  
          
    </div>
    <div class="product-content">
       
    	<?php
         woocommerce_template_loop_rating();
            do_action( 'woocommerce_shop_loop_item_title' );
            woocommerce_template_loop_price();
            echo '<div class="product_description">'.get_the_excerpt().'</div>';
    	?>
        <div class="product-buy layout3 <?php echo ''.$btn;?>">
            
       <?php
       	  global $product; 
  
      if ($product->get_type() != 'simple' || !$product->is_in_stock() ) {
       woocommerce_template_loop_add_to_cart();
      }else{
        woocommerce_template_single_add_to_cart(); 
      }

        

       ?>
       

        </div>
       
    </div>
  </div>  