<?php
/**
 * School Site functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package School_Site
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'school_site_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function school_site_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on School Site, use a find and replace
		 * to change 'school-site' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'school-site', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'portrait-blog', 200, 250, true );
		add_image_size( 'landscape-blog', 400, 200, true );
		add_image_size( 'portrait-person', 200, 300, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'school-site' ),
				'header' => esc_html__( 'Header Menu Location', 'fwd' ),
				'social' => esc_html__('Social Menu Location', 'fwd'),
				'footer' => esc_html__('Footer Menu Location', 'fwd'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'school_site_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );
	}
endif;
add_action( 'after_setup_theme', 'school_site_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function school_site_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'school_site_content_width', 640 );
}
add_action( 'after_setup_theme', 'school_site_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function school_site_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'school-site' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'school-site' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'school_site_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function school_site_scripts() {
	wp_enqueue_style('school-site-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter&family=Oswald&display=swap', array(), null);
	wp_enqueue_style( 'school-site-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'school-site-style', 'rtl', 'replace' );

	wp_enqueue_script( 'school-site-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'school_site_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/inc/cpt-taxonomy.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
function school_site_new_excerpt_length($length){
	if(is_page('students')){
		$length = 25;
	}else{
		$length = 150;
	}
	return $length;
}
add_filter('excerpt_length', 'school_site_new_excerpt_length', 999);
function school_site_excerpt_more($more){
	if(is_page('students')){
		$more = '... <a class="read-more" href="'.get_permalink().'">Read more about the student</a>';
	} else{
		$more = '... <a class="read-more" href="'.get_permalink().'">Continue Reading</a>';
	}
	return $more;
}
add_filter('excerpt_more', 'school_site_excerpt_more');

function school_site_get_post_terms( $post_id = 0, $taxonomy = 'post_tag', $args = array() ) {
    $post_id = (int) $post_id;
 
    $defaults = array( 'fields' => 'all' );
    $args     = wp_parse_args( $args, $defaults );
 
    $tags = wp_get_object_terms( $post_id, $taxonomy, $args );
 
    return $tags;
}

