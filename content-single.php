<?php
/**
 * The template part for displaying single posts.
 *
 * @package Minion
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title('<h1 class="entry-title">', '</h1>'); ?>

		<div class="entry-meta">
			<?php minion_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
        if (has_post_thumbnail()) {
            the_post_thumbnail();
        }

        the_content();

wp_link_pages(
    array(
        'before' => '<div class="page-links">' . __('Pages:', 'minion'),
        'after'  => '</div>',
    )
);
?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php minion_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
