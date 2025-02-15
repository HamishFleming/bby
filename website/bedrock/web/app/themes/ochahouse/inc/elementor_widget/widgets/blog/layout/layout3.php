<?php 
    $archive_year  = get_the_time('Y'); 
	$archive_month = get_the_time('m'); 
	$archive_day   = get_the_time('d');
    $format = has_post_format() ? get_post_format() : 'no_format'; 
?>
<div class="jws_post_wap <?php echo ''.$format;?>">
    <div class="jws_post_image">
    <span class="number"><?php echo ''.$num++;?></span>
    <a href="<?php echo get_the_permalink(); ?>">
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
    </div>
    <div class="jws_post_content">
           <h6 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6> 
           <div class="jws_post_meta">
                <span class="entry-date"><a href="<?php echo esc_url(get_day_link($archive_year, $archive_month, $archive_day)); ?>"><?php echo get_the_date(); ?></a></span> 
           </div>
           <?php if($settings['enable_exerpt']=='yes'): ?>
           <div class="jws_post_excerpt">
                    <?php  echo (!empty($settings['excerpt_length'])) ? wp_trim_words( get_the_excerpt(), $settings['excerpt_length'], $settings['excerpt_more'] ) : get_the_excerpt();?>
           </div>
           <?php endif; ?>
           <?php if($settings['show_readmore']): ?>
           <a href="<?php the_permalink(); ?>" class="jws_post_readmore">
                <?php echo esc_html($settings['readmore_text']); ?>
           </a>
           <?php endif; ?>
    </div>
</div>

  
