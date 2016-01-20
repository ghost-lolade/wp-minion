<?php
/**
 * @package Minion
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
        if (is_home() || is_front_page() || get_theme_mod('minion_header_visibility')) {
            the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
        } else {
            the_title(sprintf('<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h1>');
        }

        if ('post' === get_post_type()) {
            ?>
			<div class="entry-meta">
				<?php minion_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
        }
?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
if (has_post_thumbnail()) {
    the_post_thumbnail();
}

if (get_theme_mod('minion_blog_content') <> 'excerpt') {
    /* Translators: %s: Name of current post. */
    the_content(sprintf(__('Continue reading %s', 'minion'), get_the_title()));

    wp_link_pages(
        array(
            'before' => '<div class="page-links">' . __('Pages:', 'minion'),
            'after'  => '</div>',
        )
    );
} else {
    the_excerpt();
}
?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php minion_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
