
   
    <div class="jws-box-content">
        <div class="box-sub">
        <?php echo esc_html($settings['sub_title']); ?>
    </div>
    <div class="jws-box-title-heading">
     <span class="box-icon left">
        <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );  ?>  
    </span>
    <<?php echo $settings['tag'] ?> class="box-title">
        <?php echo esc_html($settings['info_title']); ?>
    </<?php echo $settings['tag'] ?>>
         <span class="box-icon right">
        <?php \Elementor\Icons_Manager::render_icon( $settings['icon2'], [ 'aria-hidden' => 'true' ] );  ?>  
    </span>
    </div>
    <div class="box-content">
        <?php echo ''.$settings['info_content']; ?>
    </div>
    <?php if($settings['jws_enable_button']=='yes'):?>

    <a class="box-more" href="<?php echo esc_url($url); ?>" <?php echo esc_attr($target.$nofollow); ?>>
       <?php echo esc_html($settings['info_readmore']); ?> 
       <?php if($settings['jws_enable_icon']=='yes'):?> <span class="jws-icon-arrow_right"></span><?php endif;?>
    </a>

    <?php endif; ?>
    </div>
