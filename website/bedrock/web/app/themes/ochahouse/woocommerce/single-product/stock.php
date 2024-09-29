<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<p class="stock <?php echo esc_attr( $class ); ?>">
<?php
	if ( ! $product->managing_stock() && ! $product->is_in_stock() ){
       
	} elseif( $product->is_in_stock() && ! $product->managing_stock()){
 
      
	}else{

	}
	?>
</p> 