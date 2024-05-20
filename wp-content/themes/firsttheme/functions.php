<?php
/**
 * firsttheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package firsttheme
 */


function firsttheme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'firsttheme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'firsttheme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Car Pages Sidebar', 'firsttheme' ),
			'id'            => 'carsidebar',
			'description'   => esc_html__( 'Appear as a Sidebar on Car Pages', 'firsttheme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'firsttheme_widgets_init' );

function firsttheme_enqueue_scripts() {
	wp_enqueue_style(
		'firsttheme-general',
		get_template_directory_uri() . '/assets/css/general.css',
		array(),
		'1.0',
		'all'
	);

	wp_enqueue_script(
		'firsttheme-script',
		get_template_directory_uri() . '/assets/js/script.js',
		array(),
		'1.0',
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'firsttheme_enqueue_scripts' );

function firsttheme_show_meta_data() {
	echo "<meta name='author' content='test content'>";
}

add_action( 'wp_head', 'firsttheme_show_meta_data' );

function firsttheme_init() {
	register_nav_menus( array(
		'header_nav' => 'Header Navigation',
		'footer_nav' => 'Footer Navigation',
	) );

	//HTML5 tags support
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

	// add multilingual support
	load_theme_textdomain( 'firsttheme', get_template_directory() . '/languages' );

	// add thumb support
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'post-formats',
		array(
			'video',
			'quote',
			'image',
			'gallery',
		)
	);

	add_post_type_support( 'car', 'post-formats' );
}

add_action( 'after_setup_theme', 'firsttheme_init', 0 );

function firsttheme_register_post_type() {
	$args = array(
		'hierarchical'      => false,
		'labels'            => array(
			'name'              => esc_html_x( 'Brands', 'taxonomy general name', 'firsttheme' ),
			'singular_name'     => esc_html_x( 'Brand', 'taxonomy singular name', 'firsttheme' ),
			'search_items'      => esc_html__( 'Search Brands', 'firsttheme' ),
			'all_items'         => esc_html__( 'All Brands', 'firsttheme' ),
			'parent_item'       => esc_html__( 'Parent Brand', 'firsttheme' ),
			'parent_item_colon' => esc_html__( 'Parent Brand:', 'firsttheme' ),
			'edit_item'         => esc_html__( 'Edit Brand', 'firsttheme' ),
			'update_item'       => esc_html__( 'Update Brand', 'firsttheme' ),
			'add_new_item'      => esc_html__( 'Add New Brand', 'firsttheme' ),
			'new_item_name'     => esc_html__( 'New Brand Name', 'firsttheme' ),
			'menu_name'         => esc_html__( 'Brand', 'firsttheme' ),
		),
		'show_ui'           => true,
		'rewrite'           => array( 'slug' => 'brands' ),
		'query_var'         => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
	);

	register_taxonomy( 'brand', array( 'car' ), $args );

	unset( $args );

	$args = array(
		'hierarchical'      => true,
		'labels'            => array(
			'name'              => esc_html_x( 'Manufactures', 'taxonomy general name', 'firsttheme' ),
			'singular_name'     => esc_html_x( 'Manufacture', 'taxonomy singular name', 'firsttheme' ),
			'search_items'      => esc_html__( 'Search Manufactures', 'firsttheme' ),
			'all_items'         => esc_html__( 'All Manufactures', 'firsttheme' ),
			'parent_item'       => esc_html__( 'Parent Manufacture', 'firsttheme' ),
			'parent_item_colon' => esc_html__( 'Parent Manufacture:', 'firsttheme' ),
			'edit_item'         => esc_html__( 'Edit Manufacture', 'firsttheme' ),
			'update_item'       => esc_html__( 'Update Manufacture', 'firsttheme' ),
			'add_new_item'      => esc_html__( 'Add New Manufacture', 'firsttheme' ),
			'new_item_name'     => esc_html__( 'New Manufacture Name', 'firsttheme' ),
			'menu_name'         => esc_html__( 'Manufacture', 'firsttheme' ),
		),
		'show_ui'           => true,
		'rewrite'           => array( 'slug' => 'manufactures' ),
		'query_var'         => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
	);

	register_taxonomy( 'manufacture', array( 'car' ), $args );

	unset( $args );

	$args = array(
		'label'              => esc_html__( 'Cars', 'firsttheme' ),
		'labels'             => array(
			'add_new'      => esc_html__( 'Add New', 'firsttheme' ),
			'all_items'    => esc_html__( 'All Cars', 'firsttheme' ),
			'not_found'    => esc_html__( 'No Cars Found', 'firsttheme' ),
			'search_items' => esc_html__( 'Search Cars', 'firsttheme' ),
		),
		'supports'           => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'comments',
			'revisions',
			'page-attributes'
		),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'has_archive'        => true,
		'rewrite'            => array( 'slug' => 'cars' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'car', $args );
}

add_action( 'init', 'firsttheme_register_post_type' );

//после создания post type должен быть данный хук, для решения проблемы 404
function firsttheme_rewrite_rules() {
	firsttheme_register_post_type();
	flush_rewrite_rules();
}

add_action( 'after_switch_theme', 'firsttheme_rewrite_rules' );


if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function firsttheme_setup() {
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
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'firsttheme_custom_background_args',
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
}

add_action( 'after_setup_theme', 'firsttheme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function firsttheme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'firsttheme_content_width', 640 );
}

add_action( 'after_setup_theme', 'firsttheme_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function firsttheme_scripts() {

}

add_action( 'wp_enqueue_scripts', 'firsttheme_scripts' );

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

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

