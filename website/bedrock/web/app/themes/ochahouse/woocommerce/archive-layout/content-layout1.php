  <div class="product-item-inner grid">
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
            $size = isset($image_size) && !empty($image_size) ? $image_size : 'woocommerce_thumbnail';
            echo woocommerce_get_product_thumbnail($size);
            
        	/**
        	 * Hook: woocommerce_after_shop_loop_item.
        	 *
        	 * @hooked woocommerce_template_loop_product_link_close - 5
        	 * @hooked woocommerce_template_loop_add_to_cart - 10
        	 */
        	do_action( 'woocommerce_after_shop_loop_item' );
            ?>
            <div class="buttton-inner">
                    <?php jws_button_product_grid($cart = true , $wishlist = false , $quickview = true); ?>
            </div>
    </div>
	<?php

    /**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
    jws_add_to_wishlist_btn(); 
	do_action( 'woocommerce_shop_loop_item_title' );

    woocommerce_template_loop_price();

    
	?>
    <?php woocommerce_template_loop_rating(); ?>
  </div>  