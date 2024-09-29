<?php $img_atts = isset($item['image']['id']) ? \Elementor\Group_Control_Image_Size::get_attachment_image_src( $item['image']['id'], 'image', $item ) : '';?>
<div class="jws-banner-inner">
<div class="<?php if($settings['enable_overlay_bg']=='yes'){ echo 'bg_overlay';}?>"></div>
    <a <?php echo ''.$this->get_render_attribute_string($link_key); ?>>
        <div style="background-image: url(<?php echo ''.$img_atts ?>);" class="banner-image"></div>
        <div class="jws-banner-content">
            <<?php echo ''.$settings['heading_banner_text1'];?> class="text-1">
                <?php echo esc_html($item['text1']); ?>
            </<?php echo ''.$settings['heading_banner_text1'];?>>
            <<?php echo ''.$settings['heading_banner_text2'];?> class="text-2"><?php echo esc_html($item['text2']); ?></<?php echo ''.$settings['heading_banner_text2'];?>>
            <?php if(!empty($item['text3'])):?>
            <div class="read_more">
                <button class="jws_button"><?php echo esc_html($item['text3']); ?></button>
            </div>
            <?php endif;?>
        </div>
    </a>
</div>