<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
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
        if (have_posts()) {
            ?>
			<header class="page-header">
				<?php
                the_archive_title('<h1 class="page-title">', '</h1>');
            the_archive_description('<div class="taxonomy-description">', '</div>');
            ?>
			</header><!-- .page-header -->
			<?php
            if (get_theme_mod('minion_navigation_position') === 'both' || get_theme_mod('minion_navigation_position') === 'above') {
                the_posts_navigation();
            }

            while (have_posts()) :
                the_post();
                get_template_part('content', get_post_format());
            endwhile;

            if (get_theme_mod('minion_navigation_position') === 'both' || get_theme_mod('minion_navigation_position') === 'below') {
                the_posts_navigation();
            }
        } else {
            get_template_part('content', 'none');
        }
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
