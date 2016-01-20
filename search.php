<?php
/**
 * The template for displaying search results pages.
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
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php
        if (have_posts()) {
            ?>
			<header class="page-header">
				<h1 class="page-title">
					<?php
                    /* translators: %s: search terms */
                    printf(esc_html__('Search Results for: %s', 'minion'), '<span>' . get_search_query() . '</span>');
            ?>
				</h1>
			</header><!-- .page-header -->
			<?php
            if (get_theme_mod('minion_navigation_position') === 'both' || get_theme_mod('minion_navigation_position') === 'above') {
                the_posts_navigation();
            }

            while (have_posts()) {
                the_post();
                get_template_part('content', 'search');
            }

            if (get_theme_mod('minion_navigation_position') === 'both' || get_theme_mod('minion_navigation_position') === 'below') {
                the_posts_navigation();
            }
        } else {
            get_template_part('content', 'none');
        }
?>

		</main><!-- #main -->
	</section><!-- #primary -->

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
