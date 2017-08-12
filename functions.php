<?php
/*
 * NotePress backend functions and definitions
 */

//load js and css dependencies for initial main page
function notepress_dependencies() {
	if ( !is_admin() ) {  
		wp_enqueue_style( 'notepressCss', get_stylesheet_uri() );
		if ( is_user_logged_in() ) {
			//fix layout height for logged in users
	    	wp_enqueue_style( 'userFixCss', get_template_directory_uri() . '/css/user-fix.css' );
	    }
	    wp_register_script( 'VueJs', get_template_directory_uri() . '/js/vue.js', [], '', true );  
	    wp_enqueue_script( 'VueJs' );  
	    wp_register_script( 'HelperJs', get_template_directory_uri() . '/js/helper.js', [ 'VueJs' ], '', true );  
	    wp_enqueue_script( 'HelperJs' );
	    wp_register_script( 
	    	'NotepressJs', get_template_directory_uri() . '/js/notepress.js', [ 'VueJs', 'HelperJs' ], '', true 
	    );  
	    wp_enqueue_script( 'NotepressJs' );
    }  
}
add_action( 'wp_enqueue_scripts', 'notepress_dependencies' );  






//change info formats for list of notes
function cleanListInfo( $list ) {
	foreach ( $list as $key => $post ) {
		$post->post_date = substr( $post->post_date, 0, 10 );
		$post->post_content = wp_trim_words( $post->post_content, 16, ' ...' );
	}
	return $list;
}







function readBook()
{

		if ($_POST["nt_action"] == 'readBook') {
			$args = [
				'category' => $_POST["read_cat"],
				'tag_id' => $_POST["read_tag"],
				'post_type' => 'post'
			];
			$content = get_posts( $args );
			foreach ($content as $c) {
				$c->post_content = wpautop( $c->post_content );
			}
    	echo json_encode($content);
		}
	
    if ($_POST["nt_action"] == 'readNote') {
			$note = $_POST["readNote_id"];
			$cate = wp_get_post_categories($note);
			$tag = wp_get_post_tags($note);
      echo json_encode([$cate, $tag]);
    }
		
		if ($_POST["nt_action"] == 'getCatName') {
			$name = get_category($_POST["getCatName_id"]);
			echo  json_encode($name);
		}
	
    die;
}
add_action('wp_ajax_nopriv_readBook', 'readBook');
add_action('wp_ajax_readBook', 'readBook');




if ( ! function_exists( 'notepress_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function notepress_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on NotePress, use a find and replace
	 * to change 'notepress' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'notepress', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'notepress' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'notepress_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'notepress_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function notepress_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'notepress_content_width', 640 );
}
add_action( 'after_setup_theme', 'notepress_content_width', 0 );




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
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
