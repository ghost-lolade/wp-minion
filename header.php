<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Minion
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
if (function_exists('wp_body_open')) {
    wp_body_open();
} else {
    do_action('wp_body_open');
}
?>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'minion'); ?></a>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="menu" aria-expanded="false">
				<span class="screen-reader-text"><?php esc_html_e('Primary Menu', 'minion'); ?></span>
			</button>
			<?php
            wp_nav_menu(
    array(
                                'theme_location' => 'header',
                                'fallback_cb'    => false,
                                'depth'          => 2,
                            )
);
?>
		</nav><!-- #site-navigation -->

		<?php
        if (is_home() || is_front_page() || get_theme_mod('minion_header_visibility')) {
            ?>
			<header id="masthead" class="site-header" role="banner">
			<?php
            if (display_header_text()) {
                ?>
				<div class="site-branding">
					<?php the_custom_logo(); ?>
					<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
					<div class="site-description"><?php bloginfo('description'); ?></div>
				</div><!-- .site-branding -->
				<?php
            }

            the_custom_header_markup();

            if (get_theme_mod('minion_social_footer') !== 1 && has_nav_menu('social')) {
                ?>
				<nav class="social-menu" role="navigation" aria-label="<?php esc_attr_e('Social Media', 'minion'); ?>">
					<?php
                    wp_nav_menu(
                    array(
                                'theme_location' => 'social',
                                'fallback_cb'    => false,
                                'depth'          => 1,
                                'link_before'    => '<span class="screen-reader-text">',
                                'link_after'     => '</span>',
                            )
                );
                ?>
				</nav><!-- #social-menu -->
				<?php
            }
            ?>

			</header><!-- #masthead -->
			<?php
        }
?>
	<div id="content" class="site-content">
