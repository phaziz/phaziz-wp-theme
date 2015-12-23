	<?php get_header(); ?>

	<div id="main_content">

		<div class="archive">

			<?php

				if ( is_tag() ) :
					?> Archivo Explosivo Tag: <?php single_tag_title();

				else :
					_e( 'Archivo Explosivo', 'phaziz' );

				endif;
			?>

		</div>

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

						<h3 class="the_title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
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
		        			<?php the_time( get_option( 'date_format' ) ); ?> <?php the_author_posts_link(); ?><br>
		        			<?php the_category( ' &bull; ' ); ?><br />
		        			<?php the_tags( '', ' &bull; ', '' ); ?>
	        			</div>
					</div>

		<?php endwhile; else : ?>

			<div class="no">
 				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			</div>
	
		<?php endif; ?>
	
		<div class="the_pagination">
	
			<?php
		
				global $wp_query;
			
				$big = 999999999; // need an unlikely integer
				$translated = __( ' ', 'phaziz' ); // Supply translatable string
				
				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $wp_query->max_num_pages,
				        'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'
				) );
		
			?>
	
		</div><!--EOF DIV ID THE_PAGINATION-->

	</div><!--EOF DIV ID MAIN_CONTENT-->

	<?php get_footer(); ?>
