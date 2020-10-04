<?php
/**
 * Template Name: Archives
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */

get_header(); ?>
	<div id="primary" class="content-area clr">
		<div id="content" class="site-content left-content" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" class="clr">
					<?php if ( !is_front_page() ) { ?>
						<?php
						if ( !wpex_sidebar_display() ) {
							wpex_page_featured_image();
						} ?>
						<header class="page-header clr">
							<h1 class="page-header-title"><?php the_title(); ?></h1>
						</header><!-- #page-header -->
						<?php
						if ( wpex_sidebar_display() ) {
							wpex_page_featured_image();
						} ?>
					<?php } ?>
					<div class="entry clr">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links clr">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!-- .entry-content -->
					<div class="archives-template clr">
						<div class="archives-template-box">
							<h2><?php _e( 'Latest Posts', 'wpex' ); ?></h2>
							<ul>
								<?php
								query_posts( array(
									'post_type'			=> 'post',
									'posts_per_page'	=> '10',
									'no_found_rows'		=> true,
								) );
								$count=0;
								while ( have_posts() ) : the_post(); $count++; ?>
									<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
								<?php endwhile; wp_reset_query(); ?>
							</ul>
						</div><!-- .archives-template-box -->
						<div class="archives-template-box">
							<h2><?php _e( 'Archives by Month', 'wpex' ); ?></h2>
							<ul><?php wp_get_archives('type=monthly'); ?></ul>
						</div><!-- .archives-template-box -->
						<div class="archives-template-box">
							<h2><?php _e( 'Archives by Format', 'wpex' ); ?></h2>
							<ul>
								<li><a href="<?php echo get_post_format_link( 'gallery' ); ?>" title="<?php _e( 'Gallery', 'wpex' ); ?>"><?php _e( 'Gallery', 'wpex' ); ?></a></li>
								<li><a href="<?php echo get_post_format_link( 'video' ); ?>" title="<?php _e( 'Video', 'wpex' ); ?>"><?php _e( 'Video', 'wpex' ); ?></a></li>
								<li><a href="<?php echo get_post_format_link( 'audio' ); ?>" title="<?php _e( 'Audio', 'wpex' ); ?>"><?php _e( 'Audio', 'wpex' ); ?></a></li>
								<li><a href="<?php echo get_post_format_link( 'quote' ); ?>" title="<?php _e( 'Quotes', 'wpex' ); ?>"><?php _e( 'Quotes', 'wpex' ); ?></a></li>
							</ul>
						</div><!-- .archives-template-box -->
						<div class="archives-template-box">
							<h2><?php _e( 'Archives by Category', 'wpex' ); ?></h2>
							<ul><?php wp_list_categories( 'title_li=&hierarchical=0' ); ?></ul>
						</div><!-- .archives-template-box -->
					</div><!-- .archives-template -->
				</article><!-- #post -->
			<?php endwhile; ?>
			<?php if ( is_user_logged_in() && current_user_can('edit_post', get_the_ID() ) ) { ?>
			<footer class="entry-footer">
				<?php edit_post_link( __( 'Edit this page', 'wpex' ) .' &#8594;', '<span class="edit-link clr">', '</span>' ); ?>
			</footer><!-- .entry-footer -->
			<?php } ?>
		</div><!-- #content -->
		<?php get_sidebar(); ?>
	</div><!-- #primary -->
<?php get_footer(); ?>