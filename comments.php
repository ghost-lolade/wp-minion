<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Minion
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
	<?php if (have_comments()) : ?>
		<h2 class="comments-title">
			<?php
            printf(
                /* translators: 1: the number of comments, 2: post title */
                esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'minion')),
    number_format_i18n(get_comments_number()),
    '<span>' . get_the_title() . '</span>'
);
	    ?>
		</h2>
			<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
	    wp_list_comments(
	        array(
	            'style'      => 'ol',
	            'short_ping' => true,
	        )
	    );
	    ?>
		</ol><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
