<?php
/**
 * The default template for displaying post content.
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */



/**
	Entries
**/
global $wpex_query;

if ( is_singular() && !$wpex_query ) {

	// Display post featured image
	// See functions/post-featured-image.php
	wpex_post_featured_image();

}

/**
	Posts
**/
else { ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
			echo the_content();
		?>
	</article><!-- .loop-entry -->

<?php } ?>