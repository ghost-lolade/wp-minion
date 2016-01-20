<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Minion
 */

?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<h2 class="screen-reader-text"><?php esc_html_e('Footer Content', 'minion'); ?></h2>
		<?php
        if (is_active_sidebar('sidebar-3')) {
            ?>
			<div class="widget-area" role="complementary" itemscope="itemscope" itemtype="https://schema.org/WPSideBar">
			<?php dynamic_sidebar('sidebar-3'); ?>
			</div>
			<?php
        }

        if (get_theme_mod('minion_social_footer') && has_nav_menu('social')) {
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

		<div class="site-info">
			<?php
    if (function_exists('the_privacy_policy_link')) {
        if (! get_theme_mod('minion_hide_credits')) {
            the_privacy_policy_link('', '<span class="sep"> | </span>');
        } else {
            the_privacy_policy_link('', '');
        }
    }

    if (! get_theme_mod('minion_hide_credits')) {
        ?>
				<a href="<?php echo esc_url(__('https://wordpress.org/', 'minion')); ?>"><?php printf(esc_html__('Proudly powered by %s', 'minion'), 'WordPress'); ?></a>
				<span class="sep"> | </span>
				<a href="<?php echo esc_url('https://theme.tips'); ?>" rel="nofollow">
				<?php
        /* translators: %1$s: Theme name */
        printf(esc_html__('Theme: %1$s by Carolina', 'minion'), 'Minion');
        ?>
				</a>
				<?php
    }
?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
