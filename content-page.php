<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Minion
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
        if (get_theme_mod('minion_header_visibility')) {
            the_title('<h2 class="entry-title">', '</h2>');
        } else {
            the_title('<h1 class="entry-title">', '</h1>');
        }
?>
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
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
