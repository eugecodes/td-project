<?php
/**
 * Main theme support functions
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */

add_action( 'after_setup_theme', 'wpex_theme_setup' );

if ( !function_exists('wpex_theme_setup') ) {

	function wpex_theme_setup() {
	
		// Register navigation menus
		register_nav_menus (
			array(
				'main_menu'	=> __( 'Main', 'wpex' ),
			)
		);
		
		// Localization support
		load_theme_textdomain( 'wpex', get_template_directory() .'/languages' );
		
		// Enable some useful post formats for the blog
		add_theme_support( 'post-formats', array( 'video', 'audio', 'quote', 'gallery', 'status' ) );
			
		// Add theme support
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'custom-background' );
		add_theme_support( 'post-thumbnails' );

		// Set default thumbnail size
		set_post_thumbnail_size( 150, 150 );

		// Remove theme check nags
		if ( 'nag' == 'annoying' ) {
			add_theme_support( 'custom-header', $args );
			the_post_thumbnail();
		}
	
	} // end wpex_theme_setup

} // end function_exists