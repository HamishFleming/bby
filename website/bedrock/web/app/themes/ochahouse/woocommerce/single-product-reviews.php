<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}
$cc_args = array(
    'posts_per_page'   => 3,
    'post_type'        => 'questions',
    'meta_key'         => 'product_questions',
    'meta_value'       => get_the_ID()
);
$cc_query = new WP_Query( $cc_args );
$average_rate  = number_format( $product->get_average_rating(), 1 );
$display_rate  = $average_rate * 20;
$count         = $product->get_review_count();
?>
  <h4 class="comments-heading"><?php echo esc_html__('Customer Reviews','ochahouse'); ?></h4>
  <?php  if ( !have_comments() ) : ?>
            <p class="star"></p>
           
			<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet!. Be the first to review.', 'ochahouse' ); ?></p>
  	 <?php 
    endif; ?>
<div id="reviews" class="woocommerce-Reviews">
 <?php if($count>0):?>
    <div class="row review-based">
   
        	<div class="col-xl-6 col-lg-6 col-12">
				<div class="product-reviews">
					<div class="avg-rating-container">
						<mark><?php echo '' . $average_rate; ?></mark>
						<span class="avg-rating">
							<span class="star-rating">
								<span style="width: <?php echo  esc_attr($display_rate)  . '%'; ?>;">Rated</span>
							</span>
							<span class="ratings-review"><?php echo sprintf( esc_html__( 'Based on %1$s Reviews', 'ochahouse' ), $count );?></span>
						</span>
					</div>
					<div class="ratings-list">
						<?php
						$ratings_count      = $product->get_rating_counts();
						$total_rating_value = 0;

						foreach ( $ratings_count as $key => $value ) {
							$total_rating_value += intval( $key ) * intval( $value );
						}

						for ( $i = 5; $i > 0; $i-- ) {
							$rating_value = isset( $ratings_count[ $i ] ) ? $ratings_count[ $i ] : 0;
							?>
							<div class="ratings-item" data-rating="<?php echo esc_attr( $i ); ?>">
								<div class="star-rating">
									<span style="width: <?php echo absint( $i ) * 20 . '%'; ?>">Rated</span>
								</div>
								<div class="rating-percent">
									<span style="width: 
									<?php
									if ( ! intval( $rating_value ) == 0 ) {
										echo round( floatval( number_format( ( $rating_value * $i ) / $total_rating_value, 3 ) * 100 ), 1 ) . '%';
									} else {
										echo '0%';
									}
									?>
									;"></span>
								</div>
                                <span class="count">(<?php echo esc_attr($rating_value); ?>)</span>
							</div>
							<?php
						}
						?>
					</div>
				
				</div>
               
			</div>
            <div class="col-xl-6 col-lg-6 col-12">
                <div class="jws_action_review">
                   <span class="active" data-tabs="reviews" href="#"><?php echo esc_html__('Write a review','ochahouse'); ?></span>
                  
                </div>
            </div>
         </div>

 <?php endif; ?>
		<div id="review_form_wrapper" class=" <?php if($count>0){echo 'review_form_wrapper';}?> active">
        	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
			<div id="review_form">
				<?php
				$commenter    = wp_get_current_commenter();
				$comment_form = array(
					/* translators: %s is product title */
					'title_reply'         => have_comments() ? esc_html__( '', 'ochahouse' ) : sprintf( esc_html__( '', 'ochahouse' ), get_the_title() ),
					/* translators: %s is product title */
					'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'ochahouse' ),
					'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
					'title_reply_after'   => '</span>',
					'comment_notes_after' => '',
					'label_submit'        => esc_html__( 'Submit review', 'ochahouse' ),
					'logged_in_as'        => '',
					'comment_field'       => '',
                    'fields'               => array(
						'author' => '<div class="row"><p class="comment-form-author col-xl-6">' .
										'<label>'.esc_html__('Name *','ochahouse').'</label><input id="author" class="field-simple" name="author" placeholder="'.esc_attr__('Your Name','ochahouse').'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
						'email'  => '<p class="comment-form-email col-xl-6">' .
										'<label>'.esc_html__('Email *','ochahouse').'</label><input id="email" class="field-simple" name="email" placeholder="'.esc_attr__('Email Address','ochahouse').'" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p></div>',
					
                    ),
				);

				$name_email_required = (bool) get_option( 'require_name_email', 1 );

	

				$account_page_url = wc_get_page_permalink( 'myaccount' );
				if ( $account_page_url ) {
					/* translators: %s opening and closing link tags respectively */
					$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'ochahouse' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
				}

		

				$comment_form['comment_field'] .= '<p class="comment-form-comment"><label>'.esc_html__('Review','ochahouse').'</label><textarea id="comment" placeholder="'.esc_attr__('Type your comment here...','ochahouse').'" type="email" name="comment" cols="45" rows="8" required></textarea></p>
                <p class="recommend-form-review"><label>'.esc_html__('Do you recommend this product?','ochahouse').'</label>
                                        <label for="recommend_field " class="jws-form-label jws-form-label-recommend-yes"> <input class="jws-form-input"  id="recommend_field" type="radio" name="recommend_field" value="true" aria-label="Yes, I recommend this product"> Yes </label>
                                      <label  for="recommend_field "class="jws-form-label jws-form-label-recommend-no"> <input class="jws-form-input" id="recommend_field" type="radio" name="recommend_field" value="false" aria-label="No, I do not recommend this product"> No </label>
                                     </p>';
	          
				comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
            <?php else : ?>
		          <p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'ochahouse' ); ?></p>
        	<?php endif; ?>
		</div>
	<?php if($count>0):?>
        <div class="tabs_review_questios">
  
            <div class="jws-reviewsAggregate-controls-item">
                    <div class="jws-reviews-controls-select">
                    <span class="jws-select js-jws-select">
                    <label for="jws-reviews-controls-sort" class="jws-a11yText">Sort by</label>
                        <select id="jws-reviews-controls-sort" name="jws_shorting_review" class="jws-shorting-review" data-oke-ga-change-action="Review Sort">
                        <option value="date-DESC" selected="selected">Most Recent</option>
                        <option value="date-ASC" >Oldest</option>
                        <option value="rating-DESC" >Highest Rating</option>
                        <option value="rating-ASC"  >Lowest Rating</option>
    
                        </select>

                    </span>
                </div>
               </div> 
            <div class="tabs_review_nav">
                <h5 class="active" data-tabs="reviews"><?php echo sprintf( esc_html__( 'Reviews (%1$s)', 'ochahouse' ), $count ); ?></h5>
            </div>
         
    	<div id="comments" class="active">
		<h2 class="woocommerce-Reviews-title">

			<?php
			$count = $product->get_review_count();
			if ( $count && wc_review_ratings_enabled() ) {
				/* translators: 1: reviews count 2: product name */
				$reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'ochahouse' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
				echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // WPCS: XSS ok.
			} else {
				esc_html_e( 'Reviews', 'ochahouse' );
			}
			?>
		</h2>

		<?php  if ( have_comments() ) : ?>
			<ol class="commentlist ct_ul_ol">
              <!--        <script>
      jQuery(function($) {
         $( "select" ).change(function() {
            var str = "";
            $( "select option:selected" ).each(function() {
              alert('choose')
            });
            $( "div" ).text( str );
          })
          .trigger( "change" );
          });
        </script>-->
				<?php 
          
                   wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments') ) );  
                 
                 
                 ?>
			</ol>

			<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="jws-pagination-number">';
				paginate_comments_links(
					apply_filters(
						'woocommerce_comment_pagination_args',
						array(
							'prev_text' => '<i class="jws-icon-expand_right_double"></i>',
							'next_text' => '<i class="jws-icon-expand_right_double"></i>',
							'type'      => 'list',
						)
					)
				);
				echo '</nav>';
			endif;
			?>
		<?php endif; ?>
	</div>

	<div class="clear"></div>
</div>
<?php endif; ?>