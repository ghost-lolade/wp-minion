<?php
/**
 * The template for displaying all single posts.
 *
 * @package Minion
 */

get_header();

if (is_active_sidebar('sidebar-1')) {
    ?>
	<div class="widget-area sidebar-1" role="complementary">
		<h2 class="screen-reader-text"><?php esc_html_e('Sidebar', 'minion'); ?></h2>
		<?php dynamic_sidebar('sidebar-1'); ?>
	</div>
	<?php
}
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
            while (have_posts()) :
                the_post();

                if (get_theme_mod('minion_navigation_position') === 'both' || get_theme_mod('minion_navigation_position') === 'above') {
                    the_post_navigation();
                }

                get_template_part('content', 'single');

                if (get_theme_mod('minion_navigation_position') === 'both' || get_theme_mod('minion_navigation_position') === 'below') {
                    the_post_navigation();
                }

                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
if (is_active_sidebar('sidebar-2')) {
    ?>
	<div class="widget-area sidebar-2" role="complementary">
		<h2 class="screen-reader-text"><?php esc_html_e('Sidebar', 'minion'); ?></h2>
		<?php dynamic_sidebar('sidebar-2'); ?>
	</div>
	<?php
}

get_footer();
