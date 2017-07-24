<?php
/**
 * KMA DEMO functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package KMA_DEMO
 */
@ini_set( 'upload_max_size' , '12M' );
if ( ! function_exists( 'kdemo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function kdemo_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on KMA DEMO, use a find and replace
	 * to change 'kdemo' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'kdemo', get_template_directory() . '/languages' );

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
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in these locations.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'kdemo' ),
		'menu-2' => esc_html__( 'Footer', 'kdemo' ),
		'menu-3' => esc_html__( 'Mobile Menu', 'kdemo' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

    //require('inc/vendor/autoload.php');
	require('inc/session.php');
    require('inc/bootstrap-wp-navwalker.php');
    require('inc/cpt.php');
    require('inc/honeypot.php');
    require('inc/editor.php');

}
endif;
add_action( 'after_setup_theme', 'kdemo_setup' );

function kdemo_scripts() {

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js', false, false, true );

	//styles
	wp_register_style( 'fullcalendar-style', '//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.1/fullcalendar.min.css', null,'0.0.1');
	wp_register_style( 'lightbox-styles', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/css/lightbox.min.css', false, '0.0.2' );
	wp_register_style( 'select2-styles', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css', false, '0.0.2' );

    //scripts
    //wp_register_script( 'jquery-331', 'https://code.jquery.com/jquery-3.1.1.slim.min.js', array('jquery'), '0.0.1', true );
    wp_register_script( 'tether', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js', array('jquery'), '0.0.1', true );
    wp_register_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js', array('jquery'), '0.0.1', true );
	wp_register_script( 'images-loaded', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.1/imagesloaded.min.js', array('jquery'), '0.0.1', true );
	wp_register_script( 'moment-js', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js','jquery', array(), true);
	wp_register_script( 'fullcalendar-js', '//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.3.1/fullcalendar.min.js' , 'jquery' , array(), '1.0.0', true );
    wp_register_script( 'custom-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '0.0.2', true );
	wp_register_script( 'masonry', 'https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', array('jquery','images-loaded'), '0.0.1', true );
	wp_register_script( 'lightbox', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/js/lightbox.min.js', array('jquery'), '0.0.1', true );
	wp_register_script( 'idx-js', get_template_directory_uri() . '/modules/idx/idx.js', array('jquery'), '0.0.1', true );
	wp_register_script( 'lazy-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.4/jquery.lazy.min.js', array('jquery'), '0.0.1', true );
	wp_register_script( 'select2-js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js', array('jquery'), '0.0.1', true );

	//wp ajax scripts
	wp_register_script( "ajax-scripts", get_template_directory_uri() . '/js/ajax.js', array('jquery'), '0.0.2' , true );
	wp_localize_script( 'ajax-scripts', 'wpAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
	wp_register_script( "events-ajax", get_template_directory_uri() . '/modules/events/events.js', array('jquery'), '0.0.2' , true );
	wp_localize_script( 'events-ajax', 'wpAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
	wp_register_script( "idx-ajax", get_template_directory_uri() . '/modules/idx/idx.ajax.js', array('jquery'), '0.0.0' , true );
	wp_localize_script( 'idx-ajax', 'wpAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
    wp_register_script( "weather-ajax", get_template_directory_uri() . '/modules/weather/weather.js', array('jquery'), '0.0.0' , true );
    wp_localize_script( 'weather-ajax', 'wpAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'tether' );
	wp_enqueue_script( 'bootstrap-js' );
	//wp_enqueue_script( 'images-loaded' );
	//wp_enqueue_script( 'moment-js' );
	//wp_enqueue_script( 'fullcalendar-js' );
	wp_enqueue_script( 'custom-scripts' );
	//wp_enqueue_script( 'ajax-scripts' );
	wp_enqueue_script( 'events-ajax' );
}
add_action( 'wp_enqueue_scripts', 'kdemo_scripts' );

function prefix_add_footer_styles() {
	wp_enqueue_style( 'kdemo-footer-styles', get_template_directory_uri() . '/style.css', false, '0.0.3' );
};
add_action( 'get_footer', 'prefix_add_footer_styles' );

function disable_wp_stuff() {
	remove_action('wp_head', 'rsd_link'); // Removes the Really Simple Discovery link
	remove_action('wp_head', 'wlwmanifest_link'); // Removes the Windows Live Writer link
	remove_action('wp_head', 'wp_generator'); // Removes the WordPress version
	remove_action('wp_head', 'start_post_rel_link'); // Removes the random post link
	remove_action('wp_head', 'index_rel_link'); // Removes the index page link
	remove_action('wp_head', 'adjacent_posts_rel_link'); // Removes the next and previous post links
	remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
	//remove_action('wp_head', 'feed_links', 2); // remove rss feed links *** RSS ***
	//remove_action('wp_head', 'feed_links_extra', 3); // removes all rss feed links
	//remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );

	//all things emoji
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	// Remove oEmbed discovery links.
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
}
add_action( 'init', 'disable_wp_stuff' );

/*
* Pull in our favorite KMA add-ons.
* uncomment to enable. :)
*/

function loadModules (){
    //modules
    require('modules/leads/leads.php');
    //require('modules/services/services.php');
    //require('modules/sidebars.php');
    //require('modules/team/team.php');
    require('modules/weather/weather.php');
    require('modules/testimonials/testimonials.php');
    require('modules/social/sociallinks.php');
    //require('modules/events/events.php');
    require('modules/photogallery/photogallery.php');
    require('modules/slider/slider.php');
    //require('modules/idx/idx.php');

    /*CUSTOM POST TYPES HERE*/

    //add meta boxes to pages
    $page = new Custom_Post_Type('Page');
    $page->add_meta_box(
        'Page Information',
        array(
            'Headline' 			=> 'text',
            'Header Image'      => 'image'
        )
    );
	$page->add_meta_box(
		'Sidebar',
		array(
			'Include Weather'	    => 'boolean',
			'Include Beach Cam'     => 'boolean',
			'Custom Sidebar Text'   => 'wysiwyg'
		)
	);

}
add_action( 'after_setup_theme', 'loadModules' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Enqueue scripts and styles.
 */
if ( ! function_exists( 'kdemo_inline' ) ) :
	function kdemo_inline() {
		?>
        <style type="text/css">
            <?php echo file_get_contents('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css' ) ?>
        </style>
        <style type="text/css">
            <?php echo file_get_contents(get_template_directory_uri() . '/modules/modulestyles.php?ver=0.0.1') ?>
        </style>
        <style type="text/css">
            <?php echo file_get_contents(get_template_directory_uri() . '/css/inline.css?ver=0.0.3' ) ?>
        </style>
		<?php
	}
endif;
add_action( 'wp_head', 'kdemo_inline' );

add_action('wp_ajax_get_info', 'get_info');
add_action('wp_ajax_nopriv_get_info', 'get_info');
function get_info(){

    //php request
    $something = 'something in wordpress';
	$result[] = $something;

	//result
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		$result = json_encode($result);
		echo $result;
	}

	die();

}