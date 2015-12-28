<!--functions.php-->
<?php

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-excerpts' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	add_theme_support( 'title-tag' );

	function new_excerpt_more( $more ) {
		return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'phaziz') . '</a>';
	}
	add_filter( 'excerpt_more', 'new_excerpt_more' );

	add_action('wp_enqueue_scripts', 'phaziz_enqueue_scripts');
	function phaziz_enqueue_scripts() {
	  wp_enqueue_style('theme-style', get_template_directory_uri() . '/style.css', array());
	  wp_enqueue_style('roboto-mono', 'https://fonts.googleapis.com/css?family=Roboto+Mono:300', array());
	  wp_enqueue_script('main', get_template_directory_uri() . '/main.js');
	}

	function phaziz_theme_customizer( $wp_customize ) {
		$wp_customize->add_section( 'phaziz_logo_section' , array(
		    'title'       => __( 'Logo', 'phaziz' ),
		    'priority'    => 30,
		    'description' => 'Upload a logo to replace the default site name and description in the header',
		) );

		$wp_customize->add_setting( 'phaziz_logo' );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'phaziz_logo', array(
		    'label'    => __( 'Logo', 'phaziz' ),
		    'section'  => 'phaziz_logo_section',
		    'settings' => 'phaziz_logo',
		) ) );

	}

	add_action( 'customize_register', 'phaziz_theme_customizer' );

	function phaziz_customize_register( $wp_customize ) {
		$colors = array();
	
		$colors[0] = array(
		  'slug'=>'background', 
		  'default' => '#fff',
		  'label' => __('Background Color', 'phaziz')
		);
	
		$colors[1] = array(
		  'slug'=>'link', 
		  'default' => '#0000ff',
		  'label' => __('Link Color', 'phaziz')
		);
	
		$colors[2] = array(
		  'slug'=>'linkhover', 
		  'default' => '#ff0066',
		  'label' => __('Link Hover Color', 'phaziz')
		);
	
		foreach( $colors as $color ) {
		  $wp_customize->add_setting(
		    $color['slug'], array(
		      'default' => $color['default'],
		      'type' => 'option', 
		      'capability' => 
		      'edit_theme_options'
		    )
		  );
		  $wp_customize->add_control(
		    new WP_Customize_Color_Control(
		      $wp_customize,
		      $color['slug'], 
		      array('label' => $color['label'], 
		      'section' => 'colors',
		      'settings' => $color['slug'])
		    )
		  );
		}
	}
	add_action( 'customize_register', 'phaziz_customize_register' );
	
	if (function_exists('register_sidebar')) {
		register_sidebar(array(
			'name'=> 'Footer1',
			'id' => 'footer1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h6 >',
			'after_title' => '</h6>',
		));
		register_sidebar(array(
			'name'=> 'Footer2',
			'id' => 'footer2',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h6 >',
			'after_title' => '</h6>',
		));
		register_sidebar(array(
			'name'=> 'Footer3',
			'id' => 'footer3',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h6 >',
			'after_title' => '</h6>',
		));
		register_sidebar(array(
			'name'=> 'Footer4',
			'id' => 'footer4',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h6 >',
			'after_title' => '</h6>',
		));
	}

	function regNav() {
	  register_nav_menus(
	    array(
	      'top' => __( 'Top' ),
	      'bottom' => __( 'Footer' )
	    )
	  );
	}
	add_action( 'init', 'regNav' );
	
	class CSS_Menu_Maker_Walker extends Walker {
	
	  var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
	  
	  function start_lvl( &$output, $depth = 0, $args = array() ) {
	    $indent = str_repeat("\t", $depth);
	    $output .= "\n$indent<ul>\n";
	  }
	  
	  function end_lvl( &$output, $depth = 0, $args = array() ) {
	    $indent = str_repeat("\t", $depth);
	    $output .= "$indent</ul>\n";
	  }
	  
	  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
	  
	    global $wp_query;
	    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	    $class_names = $value = ''; 
	    $classes = empty( $item->classes ) ? array() : (array) $item->classes;

	    if(in_array('current-menu-item', $classes)) {
	      $classes[] = 'active';
	      unset($classes['current-menu-item']);
	    }

	    $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
	    if (!empty($children)) {
	      $classes[] = 'has-sub';
	    }
	    
	    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
	    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
	    
	    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
	    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
	    
	    $output .= $indent . '<li' . $id . $value . $class_names .'>';
	    
	    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
	    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	    
	    $item_output = $args->before;
	    $item_output .= '<a'. $attributes .'><span>';
	    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
	    $item_output .= '</span></a>';
	    $item_output .= $args->after;
	    
	    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	  }
	  
	  function end_el( &$output, $item, $depth = 0, $args = array() ) {
	    $output .= "</li>\n";
	  }
	}

	add_action('after_setup_theme', 'phaziz_language_setup');
	function phaziz_language_setup(){
    	load_theme_textdomain('phaziz', get_template_directory() . '/languages');
	}