<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<div id="primary" class="content-area clr"><?php setPostViews(get_the_ID()); ?>
		<div id="content" class="site-content left-content clr" role="main">
			<?php if ( 'quote' != get_post_format() ) { ?>
				<article class="single-post-article clr">
                <header class="post-header clr">
                	<?php 
					// Se buscar el ID del cliente
					$idCliente = get_post_meta($post->ID,'cliente',true);
					$cantVistas = get_post_meta($post->ID,'views',true);
					if(count(explode('_', $idCliente))==1 && !empty($idCliente)) {
						 if ( has_post_thumbnail()) {
						 	$imgDestacada = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnails-relacionada');
						 }
						 guardarViews(get_the_ID(),$cantVistas,$idCliente,get_the_title(),get_permalink(),$imgDestacada[0]);
					}
					?>
					<h1 class="post-header-title"><?php the_title(); ?></h1>
				</header><!-- .page-header -->
					
					<div class="entry clr">
						<?php
						// Post Content
						the_content();
						// Paginate posts when using <!--nextpage-->
						wp_link_pages( array( 'before' => '<div class="page-links clr">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					
						<?php echo getDatosCliente(get_post_meta(get_the_ID(), 'cliente', true)); ?>
					</div><!-- .entry -->
					<?php
					// Display post meta
					// See functions/commons.php
					wpex_post_meta(); ?>
				</article>
			<?php } else {
				get_template_part( 'content', get_post_format() );
			} ?>
			<?php 

			//comments_template(); ?>
			<?php wpex_next_prev(); ?>
		</div><!-- #content -->
		<?php get_sidebar(); ?>
	</div><!-- #primary -->
<?php endwhile; ?>
<?php get_template_part( 'partials/banners', 'pie' ); ?>
<?php get_footer(); ?>