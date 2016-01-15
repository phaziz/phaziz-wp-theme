	<?php get_header(); ?>
	
	<div id="main_content">
		<?php 
	
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				?>
	
					<div <?php post_class( 'the_whole_post' ); ?> id="post-<?php the_ID(); ?>">
						<?php
	
							if(has_post_thumbnail()){
								?>
									<div class="the_thumbnail"><?php the_post_thumbnail('full',array('class'=>'lazyload')); ?></div>
								<?php
							} else {}
						
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
									'before'           => '<p>' . __( 'Pages:', 'phaziz' ),
									'after'            => '</p>',
									'link_before'      => '',
									'link_after'       => '',
									'next_or_number'   => 'number',
									'separator'        => ' ',
									'nextpagelink'     => __( 'Next page', 'phaziz' ),
									'previouspagelink' => __( 'Previous page', 'phaziz' ),
									'pagelink'         => '%',
									'echo'             => 1
								);
	
						        wp_link_pages( $defaults );
	
							?>
	
						</div>
	
		        		<div class="the_meta">
		        			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo __( 'Permalink', 'phaziz' ); ?></a><br>
		        			<?php the_time( get_option( 'date_format' ) ); ?> <?php the_author_posts_link(); ?><br>
		        			<?php the_category( ' &bull; ' ); ?><br />
		        			<?php the_tags( '', ' &bull; ', '' ); ?>
	        			</div>
	
						<div class="comments">
							<?php comments_template( '/comments.php' ); ?>
						</div>
	
	
						<div class="related">
							<p><?php _e('Related Posts: ','phaziz'); ?></p>
							<?php
							    $orig_post = $post;
							    global $post;
							    $tags = wp_get_post_tags($post->ID);
							     
							    if ($tags) {
							    $tag_ids = array();
							    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
							    $args=array(
							    'tag__in' => $tag_ids,
							    'post__not_in' => array($post->ID),
							    'posts_per_page'=>10,
							    'caller_get_posts'=>1
							    );
							     
							    $my_query = new wp_query( $args );
							 
							    while( $my_query->have_posts() ) {
							    $my_query->the_post();
							    ?>
							     
							    <div class="relatedthumb">
							        <a class="related" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(100,100)); ?><br />
							        <?php the_title(); ?>
							        </a>
							    </div>
							     
							    <?php }
							    }
							    $post = $orig_post;
							    wp_reset_query();
						    ?>
						</div>
	
	        			<div class="previous_next">
							<?php previous_post_link('%link', '&lt;&#160;&lt;&#160;&lt;'); ?>&#160;&#160;&#160;&bull;&#160;&#160;&#160;<?php next_post_link('%link', '&gt;&#160;&gt;&#160;&gt;'); ?>
	        			</div>
	
					</div>
	
		<?php endwhile; else : ?>
	
			<div class="no">
				<p><?php _e('Sorry, no posts matched your criteria.','phaziz'); ?></p>
			</div>
	
	<?php endif; ?>
	
	</div><!--EOF DIV ID MAIN_CONTENT-->
	
	<?php get_footer(); ?>