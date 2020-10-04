<?php
/**
 * This file loads custom css and js for our theme
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
*/


add_action( 'wp_enqueue_scripts','wpex_load_scripts' );

function wpex_load_scripts() {

	/**
		CSS
	**/
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	if ( get_theme_mod( 'wpex_g_font', '1' ) ) {
		wp_enqueue_style( 'wpex-google-font-source-sans-pro', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic&subset=latin,vietnamese,latin-ext' );
		wp_enqueue_style( 'wpex-google-nunito', 'http://fonts.googleapis.com/css?family=Nunito:400,300,700' );
	}

	if ( function_exists( 'wpcf7_enqueue_styles') ) {
		wp_dequeue_style( 'contact-form-7' );
	}

	// Load media css for embeds
	if ( 'infinite-scroll' == get_theme_mod( 'wpex_pagination', 'infinite-scroll' ) && get_theme_mod( 'wpex_blog_entry_thumb', '1' ) ) {
		wp_enqueue_style( 'mediaelement' );
	}

	/**
		jQuery
	**/

	// RTL for masonry
	if ( is_rtl() ) {
		$isOriginLeft = false;
	} else {
		$isOriginLeft = true;
	}

	// Load media css for embeds
	if ( 'infinite-scroll' == get_theme_mod( 'wpex_pagination', 'infinite-scroll' ) && get_theme_mod( 'wpex_blog_entry_thumb', '1' ) ) {
		wp_enqueue_script( 'wp-mediaelement' );
	}

	// Threaded commments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Retina Support
	if ( get_theme_mod( 'wpex_retina' ) ) {
		wp_enqueue_script( 'wpex-retina', WPEX_JS_DIR_URI .'/retina.js', array( 'jquery' ), '', true );
	}

	// Main js plugins
	wp_enqueue_script( 'wpex-plugins', WPEX_JS_DIR_URI .'/plugins.js', array( 'jquery' ), '1.7.5', true );

	// Init
	wp_enqueue_script( 'wpex-global', WPEX_JS_DIR_URI .'/global.js', array( 'jquery', 'wpex-plugins' ), '1.7.5', true );
	wp_localize_script( 'wpex-global', 'wpexLocalize', array(
		'mobileMenuOpen'	=> get_theme_mod( 'wpex_mobile_menu_open_text', __( 'Click here to navigate', 'wpex' ) ),
		'mobileMenuClosed'	=> get_theme_mod( 'wpex_mobile_menu_close_text', __( 'Close navigation', 'wpex' ) ),
		'isOriginLeft'		=> $isOriginLeft,
	) );
}


/**
* Load twitter widgets.js script for AJAX support for status post formats
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
*/
add_action( 'wp_footer', 'wpex_get_twitter_widgets_js' );
if ( ! function_exists( 'wpex_get_twitter_widgets_js' ) ) {
	function wpex_get_twitter_widgets_js() {
		echo '<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>';
	}
}


/**
 * Google Font Loader
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
*/
/* if ( !function_exists( 'wpex_load_fonts_async' ) ) {
	function wpex_load_fonts_async() { ?>
		<script src="//ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
		<script>
			WebFont.load({
				google: {
					families: ['Source Sans Pro', 'Nunito']
				},
				custom: {
					families: ['FontAwesome'],
					urls: [ '<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css']
				}
			});
		</script>
	<?php }
}
add_action('wp_head', 'wpex_load_fonts_async'); */