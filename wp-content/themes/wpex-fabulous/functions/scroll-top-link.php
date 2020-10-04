<?php
/**
 * Scroll to top link
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.1
*/



// Outputs the scroll to top link in the footer
if ( ! function_exists( 'wpex_scroll_top' ) ) {
	function wpex_scroll_top() {
		// If it's disabled lets bail
		if ( !get_theme_mod( 'wpex_scroll_top', '1' ) ) return;
		// Return the link
		echo '<a href="#" class="site-scroll-top"><span class="fa fa-arrow-up"></span></a>';
	} // End function
} // End if
add_action('wp_footer','wpex_scroll_top');