<?php get_header(); ?>

<div id="main_content">

	<div class="search">

		<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
			<label>
				<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
				<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
			</label>
			<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
		</form>

	</div>

	<?php 

		if ( have_posts() ) : while ( have_posts() ) : the_post();

			?>

				<div class="the_whole_post" id="post-<?php the_ID(); ?>">
					<?php

						if(has_post_thumbnail()){
							?>
								<div class="the_thumbnail"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('full'); ?></a></div>
							<?php
						}
					
					?>
					<h3 class="the_title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php _e('Permanent Link to ','phaziz') . the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
	        		<div class="the_content">

		        		<?php

						    the_content();

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
			<p><?php _e('Sorry, no posts matched your criteria.', 'phaziz'); ?></p>
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
