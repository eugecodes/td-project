<?php
/**
 * Tweaks for the pre_get_posts action hook
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */

if ( ! function_exists( 'wpex_pre_get_posts' ) ) {
	function wpex_pre_get_posts( $query ) {
		if ($query->is_search && !is_admin()) {
			$query->set( 'post_type', 'post' );
		}
		return $query;
	}
}
add_action( 'pre_get_posts', 'wpex_pre_get_posts', 1 );