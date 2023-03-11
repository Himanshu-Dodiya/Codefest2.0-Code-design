<?php
/**
 * Theme Palace functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Theme Palace
 * @subpackage Travel Insight
 * @since Travel Insight 0.1
 */

if ( ! function_exists( 'travel_insight_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function travel_insight_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Theme Palace, use a find and replace
		 * to change 'travel-insight' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'travel-insight', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-formats', array( 'gallery' ) );

		add_theme_support( "responsive-embeds" );

		add_theme_support( 'register_block_pattern' ); 

		add_theme_support( 'register_block_style' ); 

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 500, 500, true );
		add_image_size( 'travel-insight-blog', 145, 345, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' 	=> esc_html__( 'Primary', 'travel-insight' ),
			'social' 	=> esc_html__( 'Social', 'travel-insight' ),
			'footer' 	=> esc_html__( 'Footer', 'travel-insight' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'travel_insight_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// This setup supports logo, site-title & site-description
		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'width'       => 120,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );

		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'assets/css/editor-style' . $min . '.css', travel_insight_fonts_url() ) );

		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Gutenberg support
		add_theme_support( 'editor-color-palette', array(
	       	array(
				'name' => esc_html__( 'Blue', 'travel-insight' ),
				'slug' => 'blue',
				'color' => '#20aec8',
	       	),
	       	array(
	           	'name' => esc_html__( 'Black', 'travel-insight' ),
	           	'slug' => 'black',
	           	'color' => '#303c48',
	       	),
	       	array(
	           	'name' => esc_html__( 'Grey', 'travel-insight' ),
	           	'slug' => 'grey',
	           	'color' => '#404040',
	       	),
	   	));

		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-font-sizes', array(
		   	array(
		       	'name' => esc_html__( 'small', 'travel-insight' ),
		       	'shortName' => esc_html__( 'S', 'travel-insight' ),
		       	'size' => 12,
		       	'slug' => 'small'
		   	),
		   	array(
		       	'name' => esc_html__( 'regular', 'travel-insight' ),
		       	'shortName' => esc_html__( 'M', 'travel-insight' ),
		       	'size' => 16,
		       	'slug' => 'regular'
		   	),
		   	array(
		       	'name' => esc_html__( 'larger', 'travel-insight' ),
		       	'shortName' => esc_html__( 'L', 'travel-insight' ),
		       	'size' => 36,
		       	'slug' => 'larger'
		   	),
		   	array(
		       	'name' => esc_html__( 'huge', 'travel-insight' ),
		       	'shortName' => esc_html__( 'XL', 'travel-insight' ),
		       	'size' => 48,
		       	'slug' => 'huge'
		   	)
		));
		add_theme_support('editor-styles');
		add_theme_support( 'wp-block-styles' );
		
	}
endif;
add_action( 'after_setup_theme', 'travel_insight_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function travel_insight_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'travel_insight_content_width', 640 );
}
add_action( 'after_setup_theme', 'travel_insight_content_width', 0 );

if ( ! function_exists( 'travel_insight_fonts_url' ) ) :
	/**
	 * Register Google fonts
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function travel_insight_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		// Header Font
		
		/* translators: If there are characters in your language that are not supported by Playfair Display, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Playfair Display font: on or off', 'travel-insight' ) ) {
			$fonts[] = 'Playfair Display:400,700,900';
		}

		// Body Fonts

		/* translators: If there are characters in your language that are not supported by Oxygen, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Oxygen font: on or off', 'travel-insight' ) ) {
			$fonts[] = 'Oxygen:300,400,700';
		}


		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}
endif;

/**
 * Enqueue scripts and styles.
 */
function travel_insight_scripts() {
	$options = travel_insight_get_theme_options();
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'travel-insight-fonts', wptt_get_webfont_url( travel_insight_fonts_url() ), array(), null );

	// magnific-popup
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup' . $min . '.css' );

	// blocks
	wp_enqueue_style( 'travel-insight-blocks', get_template_directory_uri() . '/assets/css/blocks' . $min . '.css' );
	
	// slick
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick' . $min . '.css' );

	// slick theme
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/css/slick-theme' . $min . '.css' );
	
	wp_enqueue_style( 'travel-insight-style', get_stylesheet_uri() );

	// color style
	wp_enqueue_style( 'travel-insight-color', get_template_directory_uri() . '/assets/css/blue' . $min . '.css' );

	// jquery slick
	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/assets/js/slick' . $min . '.js', array( 'jquery' ), '', true );

	// jquery magnific popup
	wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/assets/js/jquery-magnific-popup' . $min . '.js', array( 'jquery' ), '', true );

	// jquery isotope pkgd
	wp_enqueue_script( 'jquery-isotope-pkgd', get_template_directory_uri() . '/assets/js/isotope-pkgd' . $min . '.js', array( 'jquery' ), '', true );

	// jquery packery-mode pkgd
	wp_enqueue_script( 'jquery-packery-mode', get_template_directory_uri() . '/assets/js/packery-mode-pkgd' . $min . '.js', array( 'jquery' ), '', true );

	// jquery parallax
	wp_enqueue_script( 'jquery-parallax', get_template_directory_uri() . '/assets/js/jquery-parallax' . $min . '.js', array( 'jquery' ), '', true );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_template_directory_uri() . '/assets/js/html5' . $min . '.js', array(), '3.7.3' );

	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'travel-insight-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' . $min . '.js', array(), '20160412', true );

	wp_enqueue_script( 'travel-insight-navigation', get_template_directory_uri() . '/assets/js/navigation' . $min . '.js', array(), '20151215', true );

	wp_localize_script( 'travel-insight-navigation', 'travelInsightProScreenReaderText', array(
        'expand'   => esc_html__( 'expand child menu', 'travel-insight' ),
        'collapse' => esc_html__( 'collapse child menu', 'travel-insight' ),
        'icon'     => travel_insight_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) )
    ) );

	// Custom Script
	wp_enqueue_script( 'travel-insight-custom', get_template_directory_uri() . '/assets/js/custom' . $min . '.js', array( 'jquery' ), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'travel_insight_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 *
 * @since Travel Insight 1.0.0
 */
function travel_insight_block_editor_styles() {
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Block styles.
	wp_enqueue_style( 'travel-insight-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks' . $min . '.css' ) );
	// Add custom fonts.
	wp_enqueue_style( 'travel-insight-fonts', wptt_get_webfont_url( travel_insight_fonts_url() ), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'travel_insight_block_editor_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load core file
 */
require get_template_directory() . '/inc/core.php';
