	<div id="footer_widgets">
		<div class="block-group">
			<div class="b1 block"><?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer1')) : endif; ?></div>
			<div class="b2 block"><?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer2')) : endif; ?></div>
			<div class="b3 block"><?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer3')) : endif; ?></div>
			<div class="b4 block"><?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer4')) : endif; ?></div>
		</div>
	</div>

	<?php

		if(has_nav_menu( 'bottom')){
		?>

			<div id="bottom" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'bottom','container_id' => 'cssmenu-bottom','walker' => new CSS_Menu_Maker_Walker() ) ); ?>
			</div>

		<?php
		} 

	?> 

	<footer>
		<p>&copy; <?php echo date('Y'); ?> <?php echo esc_attr(get_bloginfo('name')); ?> | Theme "phaziz" by <a target="_blank" href="http://phaziz.com">Christian Becher | phaziz.com</a></p>
	</footer>
	<script>
		$(".phaziz_gallery").justifiedGallery({'rowHeight':250,'maxRowHeight':350,'rel':'phaziz_lightbox','lastRow':'justify'}).on('jg.complete',function(){$('.phaziz_gallery a').swipebox();});
		$('.phaziz_gallery').each(function (i,el){$(el).justifiedGallery({rel: 'phaziz-item-' + i})});
	</script>
	<?php wp_footer(); ?>

</body>
</html>