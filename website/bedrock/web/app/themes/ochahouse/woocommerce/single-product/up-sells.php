<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $jws_option; 
$layout = (isset($jws_option['shop_layout']) && !empty($jws_option['shop_layout']) ) ? $jws_option['shop_layout'] : 'layout4';
if ( $upsells ) : ?>

	<section class="related shop-content jws_products_content-<?php echo esc_attr($layout); ?>">
		<?php
		$heading = apply_filters( 'woocommerce_product_upsells_products_heading', __( 'You may also like&hellip;', 'ochahouse' ) );

		if ( $heading ) :
			?>
			<h4><?php echo esc_html( $heading ); ?></h4>
		<?php endif; ?>
        
        
        <div class="products related-slider row" data-slick='{"slidesToShow":4 ,"slidesToScroll": 4,"arrows": false, "dots":false, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 3}},{"breakpoint": 767,"settings":{"slidesToShow": 2,"slidesToScroll": 2}},{"breakpoint": 360,"settings":{"slidesToShow": 1,"slidesToScroll": 1}}]}'>

			<?php foreach ( $upsells as $upsell ) : ?>

					<?php
					$post_object = get_post( $upsell->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product-related' );
					?>

			<?php endforeach; ?>

		</div>

	</section>

	<?php
endif;

wp_reset_postdata();