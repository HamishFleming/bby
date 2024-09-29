<?php 
    $archive_year  = get_the_time('Y'); 
	$archive_month = get_the_time('m'); 
	$archive_day   = get_the_time('d');
    $gallery = get_post_meta(get_the_ID(), 'image_gallery_list', true);
    $link_video = get_post_meta(get_the_ID(), 'blog_video', true);
    $link_audio = get_post_meta(get_the_ID(), 'audio_url_embed', true); 
     $format = has_post_format() ? get_post_format() : 'no_format';  
?>
<?php if($format == 'quote'){ ?>
     <div class="jws_post_quote">
         <i class="quote_icon"></i>
         <div class="jws_quote_content">
               <h5 class="jws_quote_excerpt">
                        <?php  echo get_the_excerpt();?>
               </h5>
               <?php 
                   $quote_name = get_post_meta(get_the_ID(), 'blog_name_quote', true); 
                   if(isset($quote_name)) echo '<div class="quote_name">'.$quote_name.'</div>';  
               ?>
         </div>
     </div>
<?php }elseif($format == 'link'){ ?>
    <div class="jws_post_link">
         <i class="jws-icon-link-bold"></i>
         <div class="jws_link_content">
               <?php $link_name = get_post_meta(get_the_ID(), 'blog_name_link', true); if(isset($link_name)) echo '<h4 class="link_name"><a href="'.get_post_meta(get_the_ID(), 'blog_url_link', true).'">'.$link_name.'</a></h4>';  ?>
         </div>
     </div>
<?php }else {?>
<div class="jws_post_wap <?php $format;?>">
    <div class="jws_post_image">
        <div class="slick-slider <?php if(!empty($gallery)) echo esc_attr(' post-image-slider'); ?>">
          <?php 
            if(!empty($gallery)){  
                foreach( $gallery as $attachment_id => $attachment_url ) {
                    echo '<div class="jws-post-gallery-item">'; 
                        if (function_exists('jws_getImageBySize')) {
                              $img = jws_getImageBySize(array('attach_id' => $attachment_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                               echo wp_kses_post($img['thumbnail']);
    
                        }
                    echo '</div>';      
               } 
              }
              ?></div>    
      <a href="<?php the_permalink(); ?>" class="">   
          <?php 

               if (function_exists('jws_getImageBySize')) {
                 $attach_id = get_post_thumbnail_id();
                 $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                 echo (!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '';
        
                 }else {
                 echo ''.$img = get_the_post_thumbnail(get_the_ID(), $settings['blog_image_size']);
              }
 

            ?>
            
        </a>
        <?php
        if($format == 'video') {
                $link_video = get_post_meta(get_the_ID(), 'blog_video', true);
                    echo '
                     <div class="video_format">
                         <a class="url" href="'.esc_url($link_video).'">
                            <span class="video_icon">
                                <i class="jws-icon-play"></i>
                            </span>
                         </a>
                     </div>
                    ';
              }
            if(!empty($link_audio)){
                echo '<figure>
                        <audio class="blog-audio-player"
                            controls
                            src="'.esc_url($link_audio).'">
                                Your browser does not support the
                                <code>audio</code> element.
                        </audio>
                    </figure>';
              }
        ?>
    </div>
    <div class="jws_post_content">
    <?php if($settings['show_categories']=='yes'):?>
            <span class="post_cat"><?php echo get_the_term_list(get_the_ID(), 'category', '', ''); ?></span>  
            <?php endif; ?>
           <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4> 
           <?php if($settings['show_excerpt']): ?>
           <div class="jws_post_excerpt">
                    <?php  echo (!empty($settings['excerpt_length'])) ? wp_trim_words( get_the_excerpt(), $settings['excerpt_length'], $settings['excerpt_more'] ) : get_the_excerpt();?>
           </div>
            <?php endif; 
            if($settings['show_date']=='yes'):
            ?>
            
           <div class="jws_post_meta">
           <?php
           $time = get_post_meta(get_the_ID(), 'blog_time', true);
            if(!empty($time)):?>
                <span class="time-read"><?php echo esc_html(get_post_meta(get_the_ID(), 'blog_time', true)); ?> <?php echo esc_html_e('min read','ochahouse'); ?> </span>
                <span class="dot"></span>
                <?php endif;?>
                <span class="entry-date"><a href="<?php echo esc_url(get_day_link($archive_year, $archive_month, $archive_day)); ?>"><?php echo get_the_date(); ?></a></span>
           </div>
           <?php endif; ?>
          
           <?php if($settings['show_readmore']): ?>
           <a href="<?php the_permalink(); ?>" class="jws_post_readmore">
           <span class="jws_text_read"> <?php echo esc_html($settings['readmore_text']); ?></span>
               
           </a>
           <?php endif; ?>
    </div>
</div>
<?php }

  
