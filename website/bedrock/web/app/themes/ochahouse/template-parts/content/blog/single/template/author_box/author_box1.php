<?php
/*Author*/
$bio = get_the_author_meta('description');
      //  if(empty($bio)) return;
		?>
		
		<div class="post-about-author">
      
			<div class="post-author-avatar "><?php  echo get_avatar( get_the_author_meta( 'ID' ), 138 ); ?></div>
			<div class="post-author-info ">
            <p><?php echo esc_html__('Author','ochahouse'); ?></p>
                <h5 class="at-name"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></h5>
				<div class="description"><?php echo ''.$bio; ?></div>
			</div>
       
		</div>