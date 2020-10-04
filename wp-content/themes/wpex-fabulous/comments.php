 <?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments and the comment
 * form. The actual display of comments is handled by a callback to
 * wpex_comment() which is located at functions/comments-callback.php
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */


// Bail if password protected and user hasn't entered password
if ( post_password_required() ) return;

// Comments are closed and empty, do nothing
if ( !comments_open() && get_comment_pages_count() == 0 ) return; ?>

<div id="comments" class="comments-area clr">
	<?php if ( have_comments() ) { ?>
		<div class="comments-title">
			<span class="fa fa-comments"></span>
			<?php
				printf( _nx( 'There is 1 comment for this article', 'There are %1$s comments for this article', '', 'comments title', 'wpex' ),
					number_format_i18n( get_comments_number() ), get_the_title() );
			?>
		</div>
	<?php } ?>
	<div class="comments-inner clr">
		<?php if ( have_comments() ) { ?>
			<ol class="commentlist">
				<?php wp_list_comments( array(
					'callback'	=> 'wpex_comment',
				) ); ?>
			</ol><!-- .commentlist -->
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
				<nav class="comment-navigation clr" role="navigation">
						<?php if ( is_rtl() ) { ?>
							<div class="nav-next span_1_of_2 col col-1">
								<?php next_comments_link( __( 'Newer Comments &larr;', 'wpex' ) ); ?>
							</div>
							<div class="nav-previous span_1_of_2 col">
								<?php previous_comments_link( __( '&rarr; Older Comments', 'wpex' ) ); ?>
							</div>
						<?php } else { ?>
							<div class="nav-previous span_1_of_2 col col-1">
								<?php previous_comments_link( __( '&larr; Older Comments', 'wpex' ) ); ?>
							</div>
							<div class="nav-next span_1_of_2 col">
								<?php next_comments_link( __( 'Newer Comments &rarr;', 'wpex' ) ); ?>
							</div>
						<?php } ?>
				</nav>
			<?php } ?>
		<?php } // have_comments() ?>
		<?php
		// The comment form
		comment_form( array(
			'cancel_reply_link'	=> '<i class="fa fa-times"></i>'. __('Cancel comment reply','wpex'),
		) ); ?>
	</div><!-- .comments-inner -->
</div><!-- #comments -->