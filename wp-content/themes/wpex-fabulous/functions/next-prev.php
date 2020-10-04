<?php
/**
 * Used for next and previous post links
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
*/


// Display next/previous links
if ( ! function_exists( 'wpex_next_prev' ) ) {
	function wpex_next_prev() {
		global $post;
		if ( !is_singular() ) return;
		if ( !get_theme_mod( 'wpex_next_prev', '1' ) ) return; ?>
		<?php
		// Output the next/previous links ?>
		<ul class="single-post-pagination clr">
			<?php if ( is_rtl() ) { ?>
				<?php previous_post_link( '<li class="post-next">%link</li>', '<span class="strong">'. __('Next Post:','wpex') .'</span> %title &#8592;' ); ?>
				<?php next_post_link( '<li class="post-prev">%link</li>', '&#8594; <span class="strong">'. __('Previous Post:','wpex') .'</span> %title' ); ?>
			<?php } else { ?>
				<?php previous_post_link( '<li class="post-next">%link</li>', '<span class="strong">'. __('Next Post:','wpex') .'</span> %title &#8594;' ); ?>
				<?php next_post_link( '<li class="post-prev">%link</li>', '&#8592; <span class="strong">'. __('Previous Post:','wpex') .'</span> %title' ); ?>
			<?php } ?>
		</ul><!-- .post-post-pagination -->
	<?php }
}