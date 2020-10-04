<?php
/**
 * Used to output post meta info
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */


if ( ! function_exists( 'wpex_post_meta' ) ) {

	function wpex_post_meta() {

		/**
			Singular Posts
		**/
		if ( is_singular('post') && !post_password_required() ) { ?>
		
			<div class="post-meta clr">
				<?php if ( '1' == get_theme_mod( 'wpex_post_author', '1' ) ) { ?>
					<div class="post-meta-author">
						<span class="strong"><?php _e('Author','wpex'); ?>:</span> <?php the_author_posts_link(); ?></a>
					</div>
				<?php } ?>
				<?php if ( '1' == get_theme_mod( 'wpex_post_date', '1' ) ) { ?>
					<div class="post-meta-date">
						<span class="strong"><?php _e('Published','wpex'); ?>:</span> <?php echo get_the_date(); ?>
					</div>
				<?php } ?>
				<?php if ( '1' == get_theme_mod( 'wpex_post_category', '1' ) ) { ?>
					<div class="post-meta-category">
						<span class="strong"><?php _e('Categories','wpex'); ?>:</span> <?php the_category(', '); ?>
					</div>
				<?php } ?>
				<?php if ( '1' == get_theme_mod( 'wpex_post_tags', '1' ) ) { ?>
					<?php the_tags('<div class="post-meta-tags"><span class="strong">'. __('Tags','wpex').':</span> ', ', ', '</div>'); ?> 
				<?php } ?>
			</div><!-- .post-meta -->

		<?php }
		/**
			Post Entries
		**/
		if ( !is_singular('post') ) {
				if ( !get_theme_mod( 'wpex_blog_meta', '1' ) ) return; ?>

			<div class="loop-entry-meta clr">
				<div class="loop-entry-meta-date">
					<span class="strong"><?php _e('Published','wpex'); ?>:</span> <?php echo get_the_date(); ?>
				</div>
				<div class="loop-entry-meta-category">
					<span class="strong"><?php _e('Categories','wpex'); ?>:</span> <?php the_category(', '); ?>
				</div>
			</div><!-- .loop-entry-meta -->

		<?php } ?>
		
		<?php
		
	} // End function
	
} // End if