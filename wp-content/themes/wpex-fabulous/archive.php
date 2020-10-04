<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */

get_header(); 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // paginacion
$cat = get_term_by( 'name', $cat_name, 'category' );
$catID = get_cat_ID(single_term_title("", false));
$num_cols = 3;
$args = array(
			//'orderby' => 'menu_order',
			//'order' => 'ASC',
			'cat'	=> $catID, // categoria izquierda
			'paged' => $paged
			);
$colIzqQy = new WP_Query($args); 




if ($colIzqQy->have_posts()) :
  for ( $i=1 ; $i <= $num_cols; $i++ ) : ?>
	<div id="primary-home" class="content-area clr">
	<div id="content" class="site-content left-content clr" role="main">
		<div id="blog-wrap" class="clr <?php if ( '1' != wpex_entry_grid_class() ) echo 'masonry-grid'; ?>">
<?php
    $counter = $num_cols + 1 - $i;
    while ($colIzqQy->have_posts()) : $colIzqQy->the_post();
      if( $counter%$num_cols == 0 ) : ?>
        <?php get_template_part( 'content', get_post_format() ); ?>
      <?php endif;
      $counter++;
    endwhile;
    rewind_posts();
    echo '</div></div></div>';
  endfor;
else:
  echo 'no posts';
endif;
wp_reset_query();


?>
<div class="clr">
	<?php 
	// Paginado
	wpex_get_pagination();?>
</div>
<?php get_template_part( 'partials/banners', 'pie' ); ?>
<?php get_footer(); ?>