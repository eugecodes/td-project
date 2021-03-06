<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area clr">
		<div id="content" class="site-content left-content clr" role="main">
			<header class="archive-header clr">
				<h1 class="archive-header-title"><?php printf( __( 'Resultados para: %s', 'wpex' ), get_search_query() ); ?></h1>
			</header>
			<?php if ( have_posts() ) { ?>
				<div id="blog-wrap" class="clr <?php if ( '1' != wpex_entry_grid_class() ) echo 'masonry-grid'; ?>">
					<?php
					// Begin loop
					while ( have_posts() ) : the_post();
						get_template_part( 'content', 'search' );
					endwhile; ?>
				</div><!-- #blog-wrap -->
				<?php wpex_get_pagination(); ?>
			<?php } else { ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php } ?>
		</div><!-- #content -->
		<?php get_sidebar(); ?>
	</div><!-- #primary -->

<?php get_footer(); ?>