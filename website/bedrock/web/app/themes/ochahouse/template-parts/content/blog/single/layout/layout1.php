<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage ochahouse
 * @since 1.0.0
 */
global $jws_option; 

    $comments_number = get_comments_number();
    $archive_year  = get_the_time('Y'); 
	$archive_month = get_the_time('m'); 
	$archive_day   = get_the_time('d');
    $gallery = get_post_meta(get_the_ID(), 'image_gallery_list', true);
   $image_size= isset($jws_option['single_blog_imagesize']) ? $jws_option['single_blog_imagesize'] : 'full';
   
     $format = has_post_format() ? get_post_format() : 'no_format'; 
    $link_video = get_post_meta(get_the_ID(), 'blog_video', true);
    $link_audio = get_post_meta(get_the_ID(), 'audio_url_embed', true); 
    
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header>
           <?php if($format == 'quote'){ ?>
     <div class="jws_post_quote">
         <i class="quote_icon"></i>
         <div class="jws_quote_content">
               <h1 class="jws_quote_excerpt">
                        <?php  echo get_the_excerpt();?>
               </h1>
               <?php $quote_name = get_post_meta(get_the_ID(), 'blog_name_quote', true); if(isset($quote_name)) echo '<div class="quote_name">'.$quote_name.'</div>';  ?>
         </div>
     </div>
<?php }elseif($format == 'link'){ ?>
    <div class="jws_post_link">
         <i class="jws-icon-link-bold"></i>
         <div class="jws_link_content">
               <?php $link_name = get_post_meta(get_the_ID(), 'blog_name_link', true); if(isset($link_name)) echo '<h1 class="link_name"><a href="'.get_post_meta(get_the_ID(), 'blog_url_link', true).'">'.$link_name.'</a></h1>';  ?>
         </div>
     </div>
<?php }else {?>
                  <div class="jws_post_image<?php if(!has_post_thumbnail()) echo esc_attr(' post-no-thumbnail'); ?>">
                         <span class="entry-date"><a href="<?php echo esc_url(get_day_link($archive_year , $archive_month , $archive_day)); ?>"><?php echo get_the_date('M').'<span class="vertical_line"></span>'.$archive_day.'<span class="vertical_line"></span>'.$archive_year;?></a></span>
                       <div class="jws_post_image_inner<?php if(!empty($gallery)) echo esc_attr(' post-image-slider'); ?>">
                        <?php 
                            
                          
                               if (function_exists('jws_getImageBySize')) {
                                     $attach_id = get_post_thumbnail_id();
                                     $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                                     echo ''.(!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '';
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
                          elseif(!empty($link_video)){
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

                          elseif(!empty($gallery)) {
                               foreach( $gallery as $attachment_id => $attachment_url ) {
                                    echo '<div class="jws-post-gallery-item">'; 
                                        if (function_exists('jws_getImageBySize')) {
                                              $img = jws_getImageBySize(array('attach_id' => $attachment_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                                               echo wp_kses_post($img['thumbnail']);

                                        }
                                    echo '</div>';      
                               } 
                          }
                         
                      ?>
                    </div>
                </div>
                <?php }?>
  <?php if($format != 'quote' && $format != 'link'){ ?>
                <div class="jws-post-info">

                        <span class="post_cat"><?php echo get_the_term_list(get_the_ID(), 'category', '', ''); ?></span> 
                    
                    <h1 class="entry_title">
                        <?php echo get_the_title(); ?>
                    </h1>
                  
                    <div class="jws_post_meta">
                        <span class="post_author"><?php echo get_avatar( get_the_author_meta( 'ID' ), 30 ).'<span>'.esc_html__('by ','ochahouse').'</span><a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author(); ?></a></span>  
                         <span class="dot"></span>
                        <span class="time-read"><?php echo esc_html(get_post_meta(get_the_ID(), 'blog_time', true)); ?> <?php echo esc_html_e('min read','ochahouse'); ?> </span>
                        <span class="dot"></span>
                        <a href="<?php echo get_the_permalink().'#comments'; ?>" class="entry-comment"><?php echo sprintf( _n( '%s comment', '%s comments', $comments_number, 'ochahouse' ), $comments_number ); ?></span></a>
                   
                   </div>
                  
                </div>
                  <?php } ?> 
           </header>
           <div class="entry_content">
                <?php the_content(); ?> 
           </div>
           <div class="clear-both"></div>
           <footer>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-12">
                        <?php echo jws_get_tags(); ?>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-12">
                        <?php if(function_exists('jws_share_buttons')) echo jws_share_buttons(); ?>
                    </div>
                </div>
                <?php 
                    get_template_part( 'template-parts/content/blog/single/template/author_box/author_box1' );
                    get_template_part( 'template-parts/content/blog/single/template/nav/nav2' ); 
                    if (did_action( 'elementor/loaded' ) ) { 
                 ?>
                <div class="post-related jws-blog-element">
                  <div class="col-xl-12 col-lg-12 col-12">
                    <h3><?php esc_html_e('Related Post','ochahouse'); ?></h3>
                  </div>
                     <div class="post_related_slider jws_blog_layout2" data-slick='{"slidesToShow":2 ,"slidesToScroll": 1, "infinite" : true, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 2}},{"breakpoint": 767,"settings":{"slidesToShow": 2}},{"breakpoint": 480,"settings":{"slidesToShow": 1}}]}'>
                        <?php get_template_part( 'template-parts/content/blog/single/template/related' ); ?>
                     </div>
                </div>
                
       
                <?php
                }
                     // If comments are open or we have at least one comment, load up the comment template.
    				if ( comments_open() || get_comments_number() ) {
    					comments_template();
    				}
                 ?>
            </footer>   
		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ochahouse' ),
				'after'  => '</div>',
			)
		);
		?>

</article><!-- #post-<?php the_ID(); ?> -->
