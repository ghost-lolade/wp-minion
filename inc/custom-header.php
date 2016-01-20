<?php
/**
 * Sample implementation of the Custom Header feature
 * https://codex.wordpress.org/Custom_Headers
 *
 * @package Minion
 */

/**
 * Set up the WordPress core custom header feature.
 *
 */
function minion_custom_header_setup()
{
    add_theme_support(
        'custom-header',
        apply_filters(
            'minion_custom_header_args',
            array(
                'default-image'          => get_template_directory_uri() . '/images/rose.png',
                'default-text-color'     => '861a50',
                'width'                  => 700,
                'height'                 => 280,
                'flex-height'            => true,
                'flex-width'             => true,
                'wp-head-callback'       => 'minion_customize_css',
            )
        )
    );

    register_default_headers(
        array(
            'Rose' => array(
                'url'           => '%s/images/rose.png',
                'thumbnail_url' => '%s/images/rose-thumb.png',
                /* translators: header image description */
                'description'   => __('Rose', 'minion'),
            ),
            'Purple' => array(
                'url'           => '%s/images/purple-flower.png',
                'thumbnail_url' => '%s/images/purple-thumb.png',
                /* translators: header image description */
                'description'    => __('Purple Flower', 'minion'),
            ),
        )
    );
}
add_action('after_setup_theme', 'minion_custom_header_setup');
