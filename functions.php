<?php
/**
 * Minion functions and definitions.
 *
 * @package Minion
 */

if (! function_exists('minion_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function minion_setup()
    {
        add_theme_support('automatic-feed-links');

        add_editor_style();

        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/reference/functions/add_theme_support/#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');

        add_theme_support(
            'custom-logo',
            array(
                'height'      => 200,
                'width'       => 200,
                'flex-height' => true,
                'flex-width'  => true,
            )
        );

        register_nav_menus(
            array(
                'header' => __('Primary Menu', 'minion'),
                'social' => __('Social Menu', 'minion'),
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );

        add_theme_support(
            'custom-background',
            array(
                'default-color' => '#fff',
            )
        );

        add_theme_support('customize-selective-refresh-widgets');

        add_theme_support('jetpack-responsive-videos');

        add_theme_support(
            'infinite-scroll',
            array(
                'container' => 'main',
                'footer'    => 'page',
            )
        );

        add_theme_support('responsive-embeds');

        add_theme_support('wp-block-styles');

        add_theme_support(
            'starter-content',
            array(
                'nav_menus' => array(
                    'main'  => array(
                        'name'  => __('Main Menu (Header)', 'minion'),
                        'items' => array(
                            'page_about',
                            'page_contact',
                        ),
                    ),
                    'social' => array(
                        'name'  => __('Social Menu (Footer)', 'minion'),
                        'items' => array(
                            'link_facebook',
                            'link_twitter',
                            'link_instagram',
                        ),
                    ),
                ),
                'posts' => array(
                    'about',
                    'contact',
                    'blog',
                    'news',
                ),

            )
        );
    }
endif; // End minion_setup.

add_action('after_setup_theme', 'minion_setup');

if (! function_exists('minion_content_width')) {
    /**
     * Set the content width in pixels, based on the theme's design and stylesheet.
     *
     * Priority 0 to make it available to lower priority callbacks.
     *
     * @global int $content_width
     */
    function minion_content_width()
    {
        $GLOBALS['content_width'] = apply_filters('minion_content_width', 640);
    }
    add_action('after_setup_theme', 'minion_content_width', 0);
}

/**
 * Register widget area.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function minion_widgets_init()
{
    register_sidebar(
        array(
            'name'          => __('Sidebar 1 (left)', 'minion'),
            'id'            => 'sidebar-1',
            'description'   => '',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => __('Sidebar 2 (right)', 'minion'),
            'id'            => 'sidebar-2',
            'description'   => '',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => __('Footer widget area', 'minion'),
            'id'            => 'sidebar-3',
            'description'   => '',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'minion_widgets_init');

if (! function_exists('minion_fonts_url')) {
    /**
     * Register custom fonts.
     * Credits:
     * Twenty Seventeen WordPress Theme, Copyright 2016 WordPress.org
     * Twenty Seventeen is distributed under the terms of the GNU GPL
     */
    function minion_fonts_url()
    {
        $fonts_url = '';

        $font_families = array();
        $font_families[] = get_theme_mod('minion_body_font', 'Open Sans');
        $font_families[] = get_theme_mod('minion_title_font');
        $font_families[] = get_theme_mod('minion_description_font');
        $font_families[] = get_theme_mod('minion_post_title_font');

        $font_families = array_unique($font_families);

        $query_args = array(
            'family' => urlencode(implode('|', $font_families)),
            'subset' => urlencode('latin,latin-ext'),
        );

        $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');

        return esc_url_raw($fonts_url);
    }
}

/**
 * Add preconnect for Google Fonts.
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function minion_resource_hints($urls, $relation_type)
{
    if (wp_style_is('minion-fonts', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}
add_filter('wp_resource_hints', 'minion_resource_hints', 10, 2);
/**
 * Enqueue scripts and styles.
 */
function minion_scripts()
{
    wp_enqueue_style('minion-fonts', minion_fonts_url(), array(), null);
    wp_enqueue_style('minion-style', get_stylesheet_uri(), array( 'dashicons' ));
    wp_style_add_data('minion-style', 'rtl', 'replace');

    wp_enqueue_script('minion-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20120206', true);

    wp_enqueue_script('minion-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'minion_scripts');

/**
 * Add styles and fonts for the new editor.
 */
function minion_gutenberg_assets()
{
    wp_enqueue_style('minion-gutenberg', get_theme_file_uri('gutenberg-editor.css'), false);
    wp_enqueue_script('minion-block-styles-script', get_theme_file_uri('/js/block-styles.js'), array( 'wp-blocks', 'wp-i18n' ));
    wp_set_script_translations('minion-block-styles-script', 'minion');
}
add_action('enqueue_block_editor_assets', 'minion_gutenberg_assets');

/**
 * Add custom block styles.
 */
function minion_block_styles()
{
    wp_enqueue_style('minion-block-styles', get_theme_file_uri('/inc/custom-block-styles.css'), false);
}
add_action('enqueue_block_assets', 'minion_block_styles');


/**
 * Custom header for this theme.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/customizer-fonts.php';

add_filter('the_title', 'minion_post_title');
/**
 * Add a title to posts that are missing title.
 *
 * @param mixed $title -The post title.
 */
function minion_post_title($title)
{
    if ('' === $title) {
        return __('Untitled', 'minion');
    } else {
        return $title;
    }
}

add_filter('body_class', 'minion_classes');
/**
 * Add extra classes to the body tag.
 */
function minion_classes($classes)
{
    if (! is_page_template() || is_page_template('page-template-default')) {
        if (is_active_sidebar('sidebar-1') && is_active_sidebar('sidebar-2')) {
            $classes[] = 'has-both-sidebars';
        } elseif (is_active_sidebar('sidebar-1')) {
            $classes[] = 'has-left-sidebar';
        } elseif (is_active_sidebar('sidebar-2')) {
            $classes[] = 'has-right-sidebar';
        } elseif (! is_active_sidebar('sidebar-1')) {
            $classes[] = 'no-sidebar';
        }
    }

    if (is_page_template('sidebar-left.php') && is_active_sidebar('sidebar-1')) {
        $classes[] = 'has-left-sidebar';
    }

    if (is_page_template('sidebar-right.php') && is_active_sidebar('sidebar-2')) {
        $classes[] = 'has-right-sidebar';
    }

    if (is_page_template('no-sidebar.php')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}

/**
 * Add support for changing the accent color.
 */
function minion_customize_css()
{
    echo '<style type="text/css">';
    echo "\n.site-title,
		.site-title a,
	.site-description{color: #" . esc_attr(get_header_textcolor()) . ";}\n";

    echo '#header{background:url("' . esc_url(get_header_image()) . '"); height:' . esc_attr(get_custom_header()->height) . 'px; }';
    echo "\n";
    echo '.widget-title{border-bottom:3px solid ' . esc_attr(get_theme_mod('minion_color', '#861a50')) . ';}';
    echo "\n";

    echo '.social-navigation li a:before,
	.plus:before,
	.more-link:after,
	.nav-next:after,
	.nav-previous:before,
	.entry-title,
	.entry-title a {color: ' . esc_attr(get_theme_mod('minion_color', '#861a50')) . ';}';
    echo "\n";

    echo '.main-navigation ul ul a:hover,
	.main-navigation ul ul a:focus,
	.main-navigation ul li ul :hover > a {
		border-left: 3px solid ' . esc_attr(get_theme_mod('minion_color', '#861a50')) . ';
		border-right: 3px solid ' . esc_attr(get_theme_mod('minion_color', '#861a50')) . ';
	}';
    echo "\n";

    echo '.main-navigation a:hover,
	.main-navigation a:focus {border-bottom: 3px solid ' . esc_attr(get_theme_mod('minion_color', '#861a50')) . ';}';
    echo "\n";

    echo '.social-menu li a:before, .menu-toggle:before, .bypostauthor .fn,.bypostauthor .says{color: ' . esc_attr(get_theme_mod('minion_color', '#861a50')) . ';}';
    echo "\n";

    /* Fonts */
    echo 'html, body, button, input, select, textarea { font-family:' . esc_attr(get_theme_mod('minion_body_font', "Open Sans, BlinkMacSystemFont, -apple-system, Roboto, Helvetica, Arial, sans-serif")) . ';}';
    echo '.site-title, site-title a{ font-family:' . esc_attr(get_theme_mod('minion_title_font', "Open Sans, BlinkMacSystemFont, -apple-system, Roboto, Helvetica, Arial, sans-serif")) . ';}';
    echo '.site-description { font-family:' . esc_attr(get_theme_mod('minion_description_font', "Open Sans, BlinkMacSystemFont, -apple-system, Roboto, Helvetica, Arial, sans-serif")) . ';}';
    echo '.entry-title, .entry-title a { font-family:' . esc_attr(get_theme_mod('minion_post_title_font', "Open Sans, BlinkMacSystemFont, -apple-system, Roboto, Helvetica, Arial, sans-serif")) . ';}';

    echo '</style>';
}
add_action('wp_head', 'minion_customize_css');
