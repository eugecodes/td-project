<?php
/**
 * Adds classes to entries
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */


add_filter('post_class', 'wpex_post_entry_classes');

if ( ! function_exists( 'wpex_post_entry_classes' ) ) {

	function wpex_post_entry_classes( $classes ) {
		
		// Post Data
		global $post, $wpex_count, $wpex_entry_columns;
		$post_id = $post->ID;
		$post_type = get_post_type($post_id);
		if ( $wpex_entry_columns ) {
			$grid_class = wpex_grid_class( $wpex_entry_columns );
		} else {
			$grid_class = wpex_grid_class( wpex_entry_grid_class() );
		}

		// Custom class for non standard post types
		if ( $post_type !== 'post' && !is_singular() ) {
			$classes[] = $post_type .'-entry';
		}

		// All other posts
		if ( !is_singular() && 'post' == $post_type ) {
			$classes[] = $grid_class;
			$classes[] = 'masonry-entry';
			$classes[] = 'col-'. $wpex_count;
			$classes[] = 'loop-entry col clr';
		}

		// Search
		if ( !is_singular() && is_search() ) {
			$classes[] = $grid_class;
			$classes[] = 'masonry-entry';
			$classes[] = 'col-'. $wpex_count;
			$classes[] = 'loop-entry col clr';
		}

		// Return classes
		return $classes;
		
	} // End function
	
} // End if