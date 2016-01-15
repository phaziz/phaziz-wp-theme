<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<link rel="icon" href="<?php echo esc_url(home_url()); ?>/favicon.png" type="image/x-icon">
		<link rel="shortcut icon" href="<?php echo esc_url(home_url()); ?>/favicon.png" type="image/x-icon">
		<?php wp_head(); ?>
		<?php
			$background = get_option( 'background' );
			$link = get_option( 'link' );
			$linkhover = get_option( 'linkhover' );
		?>
		<style>body{background:<?php echo $background; ?>}a:link,a:active,a:visited{color:<?php echo $link; ?>}a:hover{color:<?php echo $linkhover; ?>}</style>
	</head>
	<body <?php body_class(); ?>>

		<?php

			if(has_nav_menu('top')){
			?>
				<div id="navigation-toggle"><a href="#">NAVIGATION</a></div>
			
				<div id="top" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'top','container_id' => 'cssmenu-top','walker' => new CSS_Menu_Maker_Walker() ) ); ?>
				</div>
			<?php
			} 

		?>

		<div id="header">
			
			<?php if ( get_theme_mod( 'phaziz_logo' ) ) : ?>
		    	<h1><a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url( get_theme_mod( 'phaziz_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" height="268" width="268"></a></h1>
			<?php else : ?>
		        <h1><a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><?php bloginfo( 'name' ); ?></a></h1>
				<?php $DESCRIPTION = esc_attr(get_bloginfo('description')); ?>

				<?php

					if($DESCRIPTION){
						?>
							<h2 id="subheader"><?php echo $DESCRIPTION; ?></h2>					
						<?php
					}

				?>
			<?php endif; ?>

		</div>