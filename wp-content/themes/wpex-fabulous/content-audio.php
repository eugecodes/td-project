<?php
/**
 * The default template for displaying audio post format content.
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */


/**
  Posts
**/

global $wpex_query;

if ( is_singular() && !$wpex_query ) {

	// Display post featured image
	// See functions/post-featured-image.php
	wpex_post_featured_image();

	// Display post audio
	// See functions/commons.php
	wpex_post_audio();

}

/**
  Entries
**/
else { ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
		// Display post thumbnail
		if ( has_post_thumbnail() && get_theme_mod( 'wpex_blog_entry_thumb', '1' ) ) { ?>
			<div class="loop-entry-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>">
					<img src="<?php echo wpex_get_featured_img_url(); ?>" alt="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" />
				</a>
			</div><!-- .post-entry-thumbnail -->
		<?php } ?>
		<?php
		// Display post audio
		// See functions/commons.php
		wpex_post_audio(); ?>
		<div class="loop-entry-content clr">
			<header>
				<h2 class="loop-entry-title">
					<?php if ( !get_theme_mod( 'wpex_entry_embeds', '1' ) || 'on' == get_post_meta( get_the_ID(), 'wpex_disable_entry_embed', true ) ) { ?>
						<span class="fa fa-music music-title-icon"></span>
					<?php } ?>
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
				</h2>
			</header>
			<div class="loop-entry-excerpt entry clr">
				<?php if ( get_theme_mod( 'wpex_entry_content_excerpt','excerpt' ) == 'content' ) {
					the_content();
				} else {
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