<?php
/**
 * firsttheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package firsttheme
 */

//Redux connection
require_once get_template_directory() . '/inc/redux-options.php';

//register the required plugins for this theme.
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

function firsttheme_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin bundled with a theme.
        array(
            'name'               => 'Firsttheme Core', // The plugin name.
            'slug'               => 'firsttheme-core', // The plugin slug (typically the folder name).
            'source'             => get_template_directory() . '/plugins/firsttheme-core.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
            'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'Advanced Custom Fields',
            'slug'      => 'advanced-custom-fields',
            'required'  => true,
        ),

        array(
            'name'      => 'Redux Framework',
            'slug'      => 'redux-framework',
            'required'  => true,
        ),
    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id'           => 'firsttheme',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );

    tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'firsttheme_register_required_plugins' );


function firsttheme_paginate(object $query): void
{
    $big = 99999999999;

    $paged = (is_singular() === true) ? get_query_var('page') : get_query_var('paged');

    echo paginate_links(
        array(
            'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format'  => '?paged=%#%',
            'current' => max(1, $paged),
            'total'   => $query->max_num_pages
        )
    );
}

function firsttheme_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'firsttheme'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'firsttheme'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__('Car Pages Sidebar', 'firsttheme'),
            'id'            => 'carsidebar',
            'description'   => esc_html__('Appear as a Sidebar on Car Pages', 'firsttheme'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

}
add_action('widgets_init', 'firsttheme_widgets_init');

function firsttheme_enqueue_scripts()
{
    $cssFile = get_template_directory() . '/assets/css/general.css';
    wp_enqueue_style(
        'firsttheme-general',
        get_template_directory_uri() . '/assets/css/general.css',
        array(),
        filemtime($cssFile),
        'all'
    );

    wp_enqueue_script(
        'firsttheme-script',
        get_template_directory_uri() . '/assets/js/script.js',
        array('jquery'),
        '1.0',
        true
    );

    wp_enqueue_script(
        'firsttheme-ajax',
        get_template_directory_uri() . '/assets/js/ajax.js',
        array('jquery'),
        '1.0',
        true
    );

    wp_localize_script(
        'firsttheme-ajax',
        'firsttheme_ajax_script',
        array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('ajax-nonce'),
        )
    );

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'firsttheme_enqueue_scripts');

function firsttheme_ajax_example()
{
    if (wp_verify_nonce($_REQUEST['nonce'], 'ajax-nonce') === false) {
        die;
    }

    $cars = new WP_Query(array(
        'post_type' => 'car',
        'posts_per_page' => -1,
    ));

    if ($cars->have_posts() === true) {
        while ($cars->have_posts() === true) {
            $cars->the_post();
            get_template_part('partials/content');
        }
    } else {
        get_template_part('partials/content-none', 'none');
    }
    wp_reset_postdata();

    die; //there should always be 'die' at the end of the AJAX function
}
add_action('wp_ajax_firsttheme_ajax_example', 'firsttheme_ajax_example'); // ajax for authorised users
add_action('wp_ajax_nopriv_firsttheme_ajax_example', 'firsttheme_ajax_example'); // ajax for unauthorised users

function firsttheme_show_meta_data()
{
    echo "<meta name='author' content='test content'>";
}
add_action('wp_head', 'firsttheme_show_meta_data');

function firsttheme_init()
{
    register_nav_menus(array(
        'header_nav' => 'Header Navigation',
        'footer_nav' => 'Footer Navigation',
    ));

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

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
    * Let WordPress manage the document title.
    * By adding theme support, we declare that this theme does not use a
    * hard-coded <title> tag in the document head, and expect WordPress to
    * provide it for us.
    */
    add_theme_support('title-tag');

    // add multilingual support
    load_theme_textdomain('firsttheme', get_template_directory() . '/languages');

    // add thumb support
    add_theme_support('post-thumbnails');
    add_image_size('car-cover', 240, 180);

    add_theme_support(
        'post-formats',
        array(
            'video',
            'quote',
            'image',
            'gallery',
        )
    );

    add_post_type_support('car', 'post-formats');
}
add_action('after_setup_theme', 'firsttheme_init', 0);

//после создания post type должен быть данный хук, для решения проблемы 404
function firsttheme_rewrite_rules()
{
    firsttheme_register_post_type();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'firsttheme_rewrite_rules');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function firsttheme_content_width()
{
    $GLOBALS['content_width'] = apply_filters('firsttheme_content_width', 640);
}
add_action('after_setup_theme', 'firsttheme_content_width', 0);

/**
 * Enqueue scripts and styles.
 */
function firsttheme_scripts()
{
}
add_action('wp_enqueue_scripts', 'firsttheme_scripts');

function firsttheme_custom_comments($comment, $args, $depth)
{
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php
    if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
    } ?>
    <div class="comment-author vcard"><?php
    if ( $args['avatar_size'] != 0 ) {
        echo get_avatar( $comment, $args['avatar_size'] );
    }
    printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
    </div><?php
    if ( $comment->comment_approved == '0' ) { ?>
        <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php
    } ?>
    <div class="comment-meta commentmetadata">
        <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
            /* translators: 1: date, 2: time */
            printf(
                __('%1$s at %2$s'),
                get_comment_date(),
                get_comment_time()
            ); ?>
        </a><?php
        edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>
    </div>

    <?php comment_text(); ?>

    <div class="reply"><?php
    comment_reply_link(
        array_merge(
            $args,
            array(
                'add_below' => $add_below,
                'depth'     => $depth,
                'max_depth' => $args['max_depth']
            )
        )
    ); ?>
    </div><?php
    if ( 'div' != $args['style'] ) : ?>
        </div><?php
    endif;
}