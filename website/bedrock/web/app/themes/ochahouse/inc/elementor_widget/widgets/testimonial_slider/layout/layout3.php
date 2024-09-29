<div class="slider-content">
        <span class="testimonials-icon"><i class="jws-icon-quote-icon-2"></i></span>
        <?php if(!empty($item['list_title'])):?>
        <div class="testimonials_title"><?php echo ''.$item['list_title']; ?></div>
        <?php endif;?>
        <div class="testimonials-description"><?php echo ''.$item['list_description']; ?></div>
       <?php if(!empty($item['image']['id'])) echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item );?> 
       <div class="testimonials-info">
           <h6 class="testimonials-title"><?php echo ''.$item['list_name']; ?></h6>
           <p class="testimonials-job"><?php echo ''.$item['list_job']; ?></p>  
       </div>  
           
</div>

