<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aube
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<section class="comments">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments__title">
			<?php
			printf(
				esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'aube' ) ),
				number_format_i18n( get_comments_number() ),
				'<span>' . get_the_title() . '</span>'
			);
			?>
		</h2><!-- .comments__title -->

		<ol class="comments__list">
			<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
			) );
			?>
		</ol><!-- .comments-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav class="comments__navigation" role="navigation">
			<h2 class="comments__navigation-title"><?php esc_html_e( 'Comment navigation', 'aube' ); ?></h2>
			<div class="comments__links">
				<div class="comments__previous">
					<?php previous_comments_link( esc_html__( 'Older Comments', 'aube' ) ); ?>
				</div>
				<div class="comments__next">
					<?php next_comments_link( esc_html__( 'Newer Comments', 'aube' ) ); ?>
				</div>
			</div><!-- .comments__links -->
		</nav><!-- .comments__navigation -->
		<?php
		endif; // Check for comment navigation.
	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( !comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="comments__closed"><?php esc_html_e( 'Comments are closed.', 'aube' ); ?></p>
	<?php
	endif;

	comment_form();
	?>

</section><!-- .comments -->
