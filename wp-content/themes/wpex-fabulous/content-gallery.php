<?php
/**
 * The default template for displaying gallery post formats.
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */



/**
	Entries
**/
global $wpex_query;

if ( is_singular() && !$wpex_query ) { ?>

	<?php
	// Display Gallery = see functions/post-gallery.php
	wpex_post_gallery(); ?>

<?php }

/**
	Posts
**/
else { ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
		// Display Gallery = see functions/post-gallery.php
		wpex_post_gallery(); ?>
		<div class="loop-entry-content clr">
			<header>
				<h2 class="loop-entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
			</header>
			<div class="loop-entry-excerpt entry clr">
				<?php if ( get_theme_mod( 'wpex_entry_content_excerpt','excerpt' ) == 'content' ) {
					the_content();
				} else {
					// Display custom excerpt : see functions/excerpts.php
					$wpex_readmore = get_theme_mod( 'wpex_blog_readmore', '1' ) ? true : false;
					wpex_excerpt( 52, $wpex_readmore );
				} ?>
			</div><!-- .loop-entry-excerpt -->
		</div><!-- .loop-entry-content -->
		<?php
		// Display post meta details
		wpex_post_meta() ;?>
	</article><!-- .loop-entry -->

<?php } ?>