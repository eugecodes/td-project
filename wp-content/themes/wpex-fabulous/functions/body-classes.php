<?php
/**
 * Adds classes to the body tag for various page/post layout styles
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/

add_filter( 'body_class', 'wpex_body_classes' );
if ( !function_exists('wpex_body_classes') ) {
	function wpex_body_classes( $classes ) {

		global $post;
		
		// WPExplorer class
		$classes[] = 'wpex-theme';

		// Skin
		$classes[] = get_theme_mod( 'wpex_theme_skin', 'dark' ) .'-skin';

		// Mobile
		if ( '1' == wp_is_mobile() ) {
			$classes[] = 'is-mobile';
		}

		//Layout Classes
		if ( is_singular() ) {
			if ( $post_layout = get_post_meta( $post->ID, 'wpex_post_layout', true ) ) {
				$classes[] = $post_layout;
			}
		} else {
			$classes[] = get_theme_mod( 'wpex_archives_layout' );
		}

		// Grid Classes
		$classes[] = 'entry-columns-'. wpex_entry_grid_class();

		// Sidebar
		if ( wpex_sidebar_display() ) {
			$classes[] = 'with-sidebar';
		} else {
			$classes[] = 'no-sidebar';
		}

		// Breadcrumbs
		if ( '1' == get_theme_mod( 'wpex_breadcrumbs', '1' ) ) {
			if ( is_singular() && 'on' != get_post_meta( $post->ID, 'wpex_disable_breadcrumbs', true ) ) {
				$classes[] = 'breadcrumbs-enabled';
			} else {
				$classes[] = 'breadcrumbs-enabled';
			}
		}

		// Optimize Images
		if ( get_theme_mod( 'wpex_image_optimize') ) {
			$classes[] = 'image-rendering';
		}
		
		return $classes;
	}
}
?>