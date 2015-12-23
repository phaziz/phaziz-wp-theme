	<?php get_header(); ?>

	<div id="main_content">
		<?php 

			if ( have_posts() ) : while ( have_posts() ) : the_post();

				?>

					<div class="the_whole_post" id="post-<?php the_ID(); ?>">

						<?php

							if(has_post_thumbnail())
							{
								echo '<div class="the_thumbnail">';
								the_post_thumbnail('full');
								echo '</div>';
							}
						
						?>

						<h3 class="the_title"><?php the_title(); ?></h3>
		        		<div class="the_content">

			        		<?php
	
							    the_content();
	
			        		?>

	        			</div>

						<div class="link_pages">

							<?php

							 	$defaults = array(
									'before'           => '<p>' . __( 'Pages:' ),
									'after'            => '</p>',
									'link_before'      => '',
									'link_after'       => '',
									'next_or_number'   => 'number',
									'separator'        => ' ',
									'nextpagelink'     => __( 'Next page >' ),
									'previouspagelink' => __( '< Previous page' ),
									'pagelink'         => '%',
									'echo'             => 1
								);

						        wp_link_pages( $defaults );

							?>

						</div>

		        		<div class="the_meta">
		        			<?php the_time( get_option( 'date_format' ) ); ?> <?php the_author_posts_link(); ?><br>
		        			<?php the_category( ' &bull; ' ); ?><br />
		        			<?php the_tags( '', ' &bull; ', '' ); ?>
	        			</div>

						<div class="comments">
							<?php comments_template( '/short-comments.php' ); ?>
						</div>

	        			<div class="previous_next">
 							<?php previous_post_link('%link', '<&#160;<&#160;<'); ?>&#160;&#160;&#160;&bull;&#160;&#160;&#160;<?php next_post_link('%link', '>&#160;>&#160;>'); ?>
	        			</div>

					</div>

		<?php endwhile; else : ?>

			<div class="no">
 				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			</div>
	
	<?php endif; ?>

	</div><!--EOF DIV ID MAIN_CONTENT-->

	<?php get_footer(); ?>
