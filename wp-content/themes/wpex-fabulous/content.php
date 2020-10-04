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
else { 
	// Tomo el tipo de clase de la nota
	$clase = get_post_meta( get_the_ID(), 'clase', true );
	?>


<?php if ($clase == 'a' || $clase == 'b') : ?>


	<article id="post-<?php the_ID(); ?>" <?php post_class($clase); ?>>
			<?php
			// Display post thumbnail
			if ( has_post_thumbnail() && get_theme_mod( 'wpex_blog_entry_thumb', '1' ) == '1' ) { ?>
				<div class="loop-entry-thumbnail">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>">
						<img src="<?php echo wpex_get_featured_img_url(); ?>" alt="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" />
					</a>
				</div><!-- .post-entry-thumbnail -->
			<?php } ?>
	<div class="loop-entry-contentA clr">
		<header>
			<h2 class="loop-entry-titleA"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
		</header>
		<div class="loop-entry-excerptA entry clr">
	<?php if ( get_theme_mod( 'wpex_entry_content_excerpt','excerpt' ) == 'content' ) {
						//the_content( '<br/>Leer Mas...' );
						//the_content();
			} else {
				$wpex_readmore = get_theme_mod( 'wpex_blog_readmore', '1' ) ? true : false;
				$readmore_link = '<br/><br/><a href="'. get_permalink( $id ) .'" title="'. __('Leer Más', 'wpex' ) .'" rel="bookmark" class="readmore">'. __('Leer Más', 'wpex' ) .'<span class="icon-chevron-right"></span></a>';
				//$output .= apply_filters( 'wpex_readmore_link', $readmore_link );
				//wpex_excerpt( 52, $wpex_readmore );
				echo get_the_excerpt();
				echo $readmore_link;
				//the_content();
				} ?>
<a href="https://twitter.com/share?source=tweetbutton&text=<?php echo get_the_title(); ?>&url=<?php the_permalink(); ?>&via=grupodeboss"><img class="social" src="<?php echo get_bloginfo('template_url'); ?>/images/sociales/1410825980_square-twitter-20.png" width="20" height="20" alt="twitter" style="opacity: 1;"></a>
<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&t=<?php echo get_the_title(); ?>"><img class="social" src="<?php echo get_bloginfo('template_url'); ?>/images/sociales/1410825984_square-facebook-20.png" width="20" height="20" alt="twitter" style="opacity: 1;"></a>
		</div><!-- .loop-entry-excerpt -->
	</div><!-- .loop-entry-content -->
	</article>

<?php endif; ?>	




<?php if ($clase == 'c' || empty($clase)) : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class($clase); ?>>
		<?php
		// Display post thumbnail
		if ( has_post_thumbnail() && get_theme_mod( 'wpex_blog_entry_thumb', '1' ) == '1' ) { ?>
			<div class="loop-entry-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>">
					<img src="<?php echo wpex_get_featured_img_url(); ?>" alt="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" />
				</a>
			</div><!-- .post-entry-thumbnail -->
		<?php } ?>
		<div class="loop-entry-content clr">
			<header>
				<h2 class="loop-entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
			</header>
			<?php if ( get_theme_mod( 'wpex_entry_content_excerpt','excerpt' ) == 'content' ) {
						//the_content( '<br/>Leer Mas...' );
						//the_content();
			} else {
				$wpex_readmore = get_theme_mod( 'wpex_blog_readmore', '1' ) ? true : false;
				$readmore_link = '<br/><br/><a href="'. get_permalink( $id ) .'" title="'. __('Leer Más', 'wpex' ) .'" rel="bookmark" class="readmore">'. __('Leer Más', 'wpex' ) .'<span class="icon-chevron-right"></span></a>';
				//$output .= apply_filters( 'wpex_readmore_link', $readmore_link );
				//wpex_excerpt( 52, $wpex_readmore );
				//echo get_the_excerpt();
				echo $readmore_link;
				//the_content();
				} ?>
			<a href="https://twitter.com/share?source=tweetbutton&text=<?php echo get_the_title(); ?>&url=<?php the_permalink(); ?>&via=grupodeboss"><img class="social" src="<?php echo get_bloginfo('template_url'); ?>/images/sociales/1410825980_square-twitter-20.png" width="20" height="20" alt="twitter" style="opacity: 1;"></a>
			<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&t=<?php echo get_the_title(); ?>"><img class="social" src="<?php echo get_bloginfo('template_url'); ?>/images/sociales/1410825984_square-facebook-20.png" width="20" height="20" alt="twitter" style="opacity: 1;"></a>
		</div><!-- .loop-entry-content -->
		<?php
		// Display post meta details
		//wpex_post_meta() ;?>
	</article><!-- .loop-entry -->
<?php endif; ?>	

<?php 
// Forzamos a que si es d y está en archive mostramos c
if ($clase == 'd' and is_archive()) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('c'); ?>>
<div class="sidebar-widget widget_recent_entries clr">			<ul>
					<li><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></li>
					
				</ul>
		</div>
</article>
<?php endif; ?>

<?php if ($clase == 'd') : ?>
<!--article id="post-<?php the_ID(); ?>" <?php post_class($clase); ?>>
<div class="sidebar-widget widget_recent_entries clr">			<ul>
					<li><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></li>
					
				</ul>
		</div>
</article-->
<?php endif; ?>


<?php } ?>