<?php
/**
 * Outputs the site logo 
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */

if ( ! function_exists( 'wpex_logo' ) ) {
	
	function wpex_logo() {

		// Vars
		$logo_img = get_theme_mod( 'wpex_logo', get_template_directory_uri(). '/images/logo.png' );
		$blog_name = get_bloginfo( 'name' );
		$blog_description = get_bloginfo( 'description' );
		$home_url = home_url(); ?>

		<div id="logo" class="clr">
			<?php if ( $logo_img ) { ?>
				<a href="<?php echo $home_url; ?>" title="<?php echo $blog_name; ?>" rel="home"><img src="<?php echo $logo_img; ?>" alt="<?php echo $blog_name; ?>" /></a>
				<?php if ( $blog_description && get_theme_mod( 'wpex_logo_subheading', '1' ) ) { ?>
					<div class="blog-description"><?php echo $blog_description; ?></div>
				<?php } ?>
			<?php } else { ?>
				<div class="site-text-logo clr">
					<a href="<?php echo $home_url; ?>" title="<?php echo $blog_name; ?>" rel="home"><?php echo $blog_name; ?></a>
					<?php if ( $blog_description && get_theme_mod( 'wpex_logo_subheading', '1' ) ) { ?>
						<div class="blog-description"><?php echo $blog_description; ?></div>
					<?php } ?>
				</div>
			<?php } ?>
		</div><!-- #logo -->

		<?php
	} // end wpex_copyright

} // end function_exists 