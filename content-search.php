<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Minion
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

		<?php if ('post' == get_post_type()) : ?>
			<div class="entry-meta">
				<?php minion_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php minion_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
