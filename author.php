	<?php get_header(); ?>

	<div id="main_content">
		
		<div class="archive">

			<?php

				if ( is_author() ) :
					printf( __( 'Archivo Explosivo Author: %s', 'phaziz' ), '<span class="vcard">' . get_the_author() . '</span>' );
				else :
					_e( 'Archivo Explosivo', 'phaziz' );
				endif;
			?>

		</div>

		<?php 

			if ( have_posts() ) : while ( have_posts() ) : the_post();

				?>

					<div <?php post_class( 'the_whole_post' ); ?> id="post-<?php the_ID(); ?>">
						<?php

							if(has_post_thumbnail()){
								?>
									<div class="the_thumbnail"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('full',array('class'=>'lazyload')); ?></a></div>
								<?php
							}
						
						?>
						<h3 class="the_title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php _e('Permanent Link to ','phaziz') . the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
		        		<div class="the_content">

			        		<?php
	
								if ( has_excerpt( $post->ID ) ) {
								    the_excerpt();
								} else {
								    the_content();
								}
	
			        		?>

	        			</div>

		        		<div class="the_meta">
		        			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo __( 'Permalink', 'phaziz' ); ?></a><br>
		        			<?php the_time( get_option( 'date_format' ) ); ?> <?php the_author_posts_link(); ?><br>
		        			<?php the_category( ' &bull; ' ); ?><br />
		        			<?php the_tags( '', ' &bull; ', '' ); ?>
	        			</div>
					</div>

		<?php endwhile; else : ?>

			<div class="no">
 				<p><?php _e('Sorry, no posts matched your criteria.','phaziz'); ?></p>
			</div>
	
		<?php endif; ?>
	
		<div class="the_pagination">
	
			<?php
		
				global $wp_query;
				$big = 999999999;
				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $wp_query->max_num_pages,
				        'before_page_number' => ''
				) );
		
			?>
	
		</div><!--EOF DIV ID THE_PAGINATION-->

	</div><!--EOF DIV ID MAIN_CONTENT-->

	<?php get_footer(); ?>