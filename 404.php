<?php
/**
 * The template for displaying 404 pages (not found).
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

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'minion'); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'minion'); ?></p>

					<?php get_search_form(); ?>
					<br/><br/>
					<?php the_widget('WP_Widget_Recent_Posts'); ?>

					<?php
                        /* translators: %1$s: smiley */
                        $archive_content = '<p>' . sprintf(__('Try looking in the monthly archives. %1$s', 'minion'), convert_smilies(':)')) . '</p>';
the_widget('WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content");
?>

					<?php the_widget('WP_Widget_Tag_Cloud'); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

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
