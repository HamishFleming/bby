<?php
/**
 * Checkout coupon form Clone
 * 
 * @author  JwsTheme
 * @package Jws-theme/WooCommerce
 * Since 1.0
 */
defined('ABSPATH') || exit;

if (!wc_coupons_enabled()) {
    return;
}
?>
<tr><td colspan="2" class="coupon-clone-td">
<a href="javascript:void(0);" class="showcoupon-clone" rel="nofollow"><?php echo esc_html__('Have a coupon code?', 'ochahouse'); ?></a>
<div class="form-row coupon-clone-wrap hidden">
        <input type="text" name="coupon_code_clone" class="input-text" placeholder="<?php esc_attr_e('Coupon code', 'ochahouse'); ?>" id="coupon_code-clone" value="" />
        <button  class="button" name="apply_coupon_clone" value="<?php esc_attr_e('Apply coupon', 'ochahouse'); ?>" id="apply_coupon_clone"><?php esc_html_e('Apply', 'ochahouse'); ?></button>
</div>
</td></tr>
