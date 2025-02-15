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
		$delimiter = '/';

    $comments_number = get_comments_number();
    $archive_year  = get_the_time('Y'); 
	$archive_month = get_the_time('m'); 
	$archive_day   = get_the_time('d');
    $gallery = get_post_meta( get_the_ID(), 'blog_gallery', true );
    $image_size = (isset($jws_option['single_blog_imagesize']) && !empty($jws_option['single_blog_imagesize'])) ? $jws_option['single_blog_imagesize'] : 'full';
    
    if(isset($_GET['sidebar']) && $_GET['sidebar'] == 'full') {
        $image_size = '1300x500'; 
    }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="jws-path">
							<div class="jws-path-inner">
                                            
								<?php echo jws_page_breadcrumb($delimiter); ?>
							</div>
					</div>
            <header>
                   <div class="jws-post-info">
                            <span class="post_cat"><?php echo get_the_term_list(get_the_ID(), 'category', '', ', '); ?></span> 
                        <h2 class="entry_title">
                            <?php echo get_the_title(); ?>
                        </h2>
                    <div class="jws_post_meta">
                        <span class="post_author"><?php echo get_avatar( get_the_author_meta( 'ID' ), 30 ).'<span>'.esc_html__('by ','ochahouse').'</span><a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author(); ?></a></span>  
                         <span class="dot"></span>
                        <span class="time-read"><?php echo esc_html(get_post_meta(get_the_ID(), 'blog_time', true)); ?> <?php echo esc_html_e('min read','ochahouse'); ?> </span>
                        <span class="dot"></span>
                        <a href="<?php echo get_the_permalink().'#comments'; ?>" class="entry-comment"><?php echo sprintf( _n( '%s comment', '%s comments', $comments_number, 'ochahouse' ), $comments_number ); ?></span></a>
                   </div>
                </div>   
                  <div class="jws_post_image<?php if(!has_post_thumbnail()) echo esc_attr(' post-no-thumbnail'); ?>">
                    <span class="entry-date"><a href="<?php echo esc_url(get_day_link($archive_year , $archive_month , $archive_day)); ?>"><?php echo '<span class="jws-date-element">'.get_the_date('M').'</span><span class="vertical_line"></span><span class="jws-date-element">'.$archive_day.'</span><span class="vertical_line"></span><span class="jws-date-element">'.$archive_year;?></span></a></span>
                       <div class="jws_post_image_inner<?php if(!empty($gallery)) echo esc_attr(' post-image-slider'); ?>">
                        <?php 
                            
                           echo !empty($gallery) ? '<div class="slick-slide">' : '<div>';
                               if (function_exists('jws_getImageBySize')) {
                                     $attach_id = get_post_thumbnail_id();
                                     $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                                     echo ''.(!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '';
                               } 
                           echo '</div>'; 
                          if(!empty($gallery)) {
                               foreach($gallery as $image_id) {
                                    echo '<div class="slick-slide">'; 
                                        if (function_exists('jws_getImageBySize')) {
                                             $img = jws_getImageBySize(array('attach_id' => $image_id, 'thumb_size' => $image_size, 'class' => 'blog-gallery'));
                                             echo ''.(!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '';
                                        }
                                    echo '</div>';      
                               } 
                          }
                         
                      ?>
                    </div>
                </div>  
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
