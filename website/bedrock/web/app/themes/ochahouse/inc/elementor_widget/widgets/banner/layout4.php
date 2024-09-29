<div class="jws-banner-inner">
<div class="<?php if($settings['enable_overlay_bg']=='yes'){ echo 'bg_overlay';}?>"></div>
    <a <?php echo ''.$this->get_render_attribute_string($link_key); ?>>
        <div class="jws-banner-image">
            <?php if(!empty($item['image']['id'])) echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item );?> 
        </div>
        <div class="jws-banner-content">
        <<?php echo ''.$settings['heading_banner_text1'];?> class="text-1">
            <?php echo esc_html($item['text1']); ?>
        </<?php echo ''.$settings['heading_banner_text1'];?>>
        <<?php echo ''.$settings['heading_banner_text2'];?> class="text-2"><?php echo esc_html($item['text2']); ?></<?php echo ''.$settings['heading_banner_text2'];?>>
        <button><?php echo esc_html($item['text3']); ?><span class="jws-icon-arrow_right"></span></button>
        </div>
    </a>
</div>