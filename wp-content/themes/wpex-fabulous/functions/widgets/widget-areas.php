<?php
/**
 * Define sidebars for use in this theme
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */

// Sidebar
register_sidebar( array(
	'name'			=> __( 'Sidebar', 'wpex' ),
	'id'			=> 'sidebar',
	'description'	=> __( 'Widgets in this area are used in the sidebar region.', 'wpex' ),
	'before_widget'	=> '<div class="sidebar-widget %2$s clr">',
	'after_widget'	=> '</div>',
	'before_title'	=> '<span class="widget-title">',
	'after_title'	=> '</span>',
) );

// Footer 1
register_sidebar( array(
	'name'			=> __( 'Footer 1', 'wpex' ),
	'id'			=> 'footer-one',
	'description'	=> __( 'Widgets in this area are used in the first footer region.', 'wpex' ),
	'before_widget'	=> '<div class="footer-widget %2$s clr">',
	'after_widget'	=> '</div>',
	'before_title'	=> '<span class="widget-title">',
	'after_title'	=> '</span>',
) );

// Footer 2
if ( get_theme_mod( 'wpex_footer_columns', '4' ) > '1' ) {
	register_sidebar( array(
		'name'			=> __( 'Footer 2', 'wpex' ),
		'id'			=> 'footer-two',
		'description'	=> __( 'Widgets in this area are used in the second footer region.', 'wpex' ),
		'before_widget'	=> '<div class="footer-widget %2$s clr">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<span class="widget-title">',
		'after_title'	=> '</span>',
	) );
}

// Footer 3
if ( get_theme_mod( 'wpex_footer_columns', '4' ) > '2' ) {
	register_sidebar( array(
		'name'			=> __( 'Footer 3', 'wpex' ),
		'id'			=> 'footer-three',
		'description'	=> __( 'Widgets in this area are used in the third footer region.', 'wpex' ),
		'before_widget'	=> '<div class="footer-widget %2$s clr">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<span class="widget-title">',
		'after_title'	=> '</span>',
	) );
}

// Footer 4
if ( get_theme_mod( 'wpex_footer_columns', '4' ) > '3' ) {
	register_sidebar( array(
		'name'			=> __( 'Footer 4', 'wpex' ),
		'id'			=> 'footer-four',
		'description'	=> __( 'Widgets in this area are used in the fourth footer region.', 'wpex' ),
		'before_widget'	=> '<div class="footer-widget %2$s clr">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<span class="widget-title">',
		'after_title'	=> '</span>',
	) );
}