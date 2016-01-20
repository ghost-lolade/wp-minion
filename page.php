<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
                get_template_part('content', 'page');

                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

            endwhile; // end of the loop.
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
