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
			$navbar = get_option( 'navbar' );
			$navbarBottom = get_option( 'navbarBottom' );
			$navbarColor = get_option( 'navbarColor' );
			$navbarBottomColor = get_option( 'navbarBottomColor' );
			$footerBackgroundColor = get_option( 'footerBackgroundColor' );
		?>
		<style>body{background:<?php echo $background; ?>} a:link,a:active,a:visited{color:<?php echo $link; ?>}a:hover{color:<?php echo $linkhover; ?>}#menu-main{background:<?php echo $navbar; ?>}#menu-main-1{background:<?php echo $navbarBottom; ?>}#cssmenu-top ul ul a{background:<?php echo $navbar; ?>;color:<?php echo $navbarColor; ?>;border:1px solid <?php echo $navbar; ?>;border-top:0 none;line-height:150%;padding:16px 20px;font-size:12px}#cssmenu-top ul ul li:first-child > a{border-top:1px solid <?php echo $navbar; ?>}#cssmenu-top ul ul li:hover > a{background:<?php echo $navbar; ?>;color:<?php echo $linkhover; ?>}#cssmenu-top ul ul li:last-child > a{-moz-border-radius:0 0 3px 3px;-webkit-border-radius:0 0 3px 3px;border-radius:0 0 3px 3px;-moz-background-clip:padding;-webkit-background-clip:padding-box;background-clip:padding-box;-moz-box-shadow:0 1px 0 <?php echo $navbar; ?>;-webkit-box-shadow:0 1px 0 <?php echo $navbar; ?>;box-shadow:0 1px 0 <?php echo $navbar; ?>}#cssmenu-top ul li:hover > a,#cssmenu-top ul li.active > a{background:<?php echo $navbar; ?>;color:<?php echo $linkhover; ?>}#cssmenu-top a{background:<?php echo $navbar; ?>;color:<?php echo $navbarColor; ?>;padding:0 20px}#cssmenu-bottom ul ul a{background:<?php echo $navbarBottom; ?>;color:<?php echo $navbarBottomColor; ?>;border:1px solid <?php echo $navbarBottom; ?>;border-top:0 none;line-height:150%;padding:16px 20px;font-size:12px}#cssmenu-bottom ul ul li:first-child > a{border-top:1px solid <?php echo $navbarBottom; ?>}#cssmenu-bottom ul ul li:hover > a{background:<?php echo $navbarBottom; ?>;color:<?php echo $linkhover; ?>}#cssmenu-bottom ul ul li:last-child > a{-moz-border-radius:0 0 3px 3px;-webkit-border-radius:0 0 3px 3px;border-radius:0 0 3px 3px;-moz-background-clip:padding;-webkit-background-clip:padding-box;background-clip:padding-box;-moz-box-shadow:0 1px 0 <?php echo $navbarBottom; ?>;-webkit-box-shadow:0 1px 0 <?php echo $navbarBottom; ?>;box-shadow:0 1px 0 <?php echo $navbarBottom; ?>}#cssmenu-bottom ul li:hover > a,#cssmenu-bottom ul li.active > a{background:<?php echo $navbarBottom; ?>;color:<?php echo $linkhover; ?>}#cssmenu-bottom a{background:<?php echo $navbarBottom; ?>;color:<?php echo $navbarBottomColor; ?>;padding:0 20px}#footer_widgets{background: <?php echo $footerBackgroundColor; ?>}</style>
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