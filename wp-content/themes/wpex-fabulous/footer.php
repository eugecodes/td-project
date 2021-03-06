<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */

$wpex_footer_box_class = apply_filters( 'wpex_footer_box_class', wpex_grid_class( get_theme_mod( 'wpex_footer_columns', '4' ) ) );
?>

		</div><!--.site-main -->
	</div><!-- .site-main-wrap -->
</div><!-- #wrap -->

<footer id="footer-wrap" class="site-footer clr">
	<div id="footer" class="container clr">
	  <div id="footer-widgets" class="clr">
		  <div class="footer-box <?php echo $wpex_footer_box_class; ?> col col-1">
				<?php dynamic_sidebar( 'footer-one' ); ?>
			</div><!-- .footer-box -->
			<?php
			// Second footer area
			if ( get_theme_mod( 'wpex_footer_columns', '4' ) > '1' ) { ?>
				<div class="footer-box <?php echo $wpex_footer_box_class; ?> col col-2">
					<?php dynamic_sidebar( 'footer-two' ); ?>
				</div><!-- .footer-box -->
			<?php } ?>
			<?php
			// Third Footer Area
			if ( get_theme_mod( 'wpex_footer_columns', '4' ) > '1' ) { ?>
				<div class="footer-box <?php echo $wpex_footer_box_class; ?> col col-3">
					<?php dynamic_sidebar( 'footer-three' ); ?>
				</div><!-- .footer-box -->
			<?php } ?>
		
		</div><!-- #footer-widgets -->
        <table width="100%" height="80" border="0" align="center" cellpadding="0" cellspacing="0">
        <tbody><tr>
          <td valign="center"><p><div style="color:#999; text-align:center">Copyright 2013 Tradem Design - Todos los derechos reservados - Diseño y Desarrollo Grupo Deboss<br>
            <div style="height: 30px; font-family: \'Myriad Pro\', Calibri, sans-serif; font-size: 12px; color: #FFF; width: 250px; margin: 0 auto"> <div style="float: left; padding: 10px 5px 0 0"><a style="color: #FFF; text-decoration: none" href="http://www.grupodeboss.com" target="_blank">Diseño web y desarrollo </a></div> <div style="float:left;"><a href="http://www.grupodeboss.com" target="_blank"><img src="http://grupodeboss.com/images/logo_gd_29x30.png" alt="Grupo Deboss"></a></div> 
          <div style="float: left; padding: 10px 0 0 5px"><a href="http://www.grupodeboss.com" target="_blank" style="color: #FFF; text-decoration: none;">Grupo Deboss</a></div></div></div></td>
          
          </tr>
      </tbody></table>
	</div><!-- #footer -->
</footer><!-- #footer-wrap -->

<?php wp_footer(); 

?>
</body>
</html>