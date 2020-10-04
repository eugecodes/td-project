<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */

get_header(); 
 if ( is_home()) { 
    setViewsHome();
}

?>

	<div id="primary-home" class="content-area clr">
		<div id="content" class="site-content left-content clr" role="main">
			<div id="blog-wrap" class="clr <?php if ( '1' != wpex_entry_grid_class() ) echo 'masonry-grid'; ?>">
					<?php // Random Izquierda
					getPostRandom('izquierdarandom'); ?>

	<?php 
    $args = array(
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'cat'	=> '17' // categoria izquierda
    );
    $colIzqQy = new WP_Query($args); 
	?>
		<?php
			while ($colIzqQy->have_posts())
		    {
		        $colIzqQy->the_post();
		        get_template_part( 'content', get_post_format() );
		    }
		?>
				</div><!-- #blog-wrap -->
				<?php //wpex_get_pagination(); ?>
		</div><!-- #content -->
        
        
	</div><!-- #izquiera -->
	<?php wp_reset_postdata(); ?>



	<div id="primary-home" class="content-area clr">
		<div id="content" class="site-content left-content clr" role="main">


	
			<div id="blog-wrap" class="clr <?php if ( '1' != wpex_entry_grid_class() ) echo 'masonry-grid'; ?>">
				<?php // Random Izquierda
					getPostRandom('centrorandom'); ?>
		<?php 
	    $args = array(
	        'orderby' => 'menu_order',
	        'order' => 'ASC',
	        'cat'	=> '16' // categoria centro
	    );
	    $colCentroQy = new WP_Query($args); 
		?>
		<?php
			while ($colCentroQy->have_posts())
		    {
		        $colCentroQy->the_post();
		        get_template_part( 'content', get_post_format() );
		    }
		?>
				</div><!-- #blog-wrap -->
				<?php //wpex_get_pagination(); ?>
		</div><!-- #content -->
        
       
	</div><!-- #centro -->
	<?php wp_reset_postdata(); ?>




	<div id="primary-home" class="content-area clr">
		<div id="content" class="site-content left-content clr" role="main">

			<div id="blog-wrap" class="clr <?php if ( '1' != wpex_entry_grid_class() ) echo 'masonry-grid'; ?>">
				<?php // Random derecha
					getPostRandom('derecharandom'); ?>			
	<?php 
    $args = array(
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'cat'	=> '15' // categoria centro
    );
    $colIzqQy = new WP_Query($args); 
	?>
				
		<?php
			while ($colIzqQy->have_posts())
		    {
		        $colIzqQy->the_post();
		        get_template_part( 'content', get_post_format() );
		    }
		?>
				</div><!-- #blog-wrap -->
				<?php //wpex_get_pagination(); ?>
		</div><!-- #content -->
        
        
	</div><!-- #derecha -->
	<?php wp_reset_postdata(); ?>



<?php get_template_part( 'partials/banners', 'pie' ); ?>
<?php get_footer(); ?>