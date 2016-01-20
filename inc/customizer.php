<?php
/**
 * Minion Theme Customizer
 *
 * @package Minion
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function minion_customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';

    /**
    * Add sections to the WordPress customizer.
    * Accessibility info:
    */
    $wp_customize->get_section('colors')->description  = __('Please note that changing the colors can affect the accessibility.', 'minion');

    $wp_customize->add_setting(
        'minion_color',
        array(
            'default'           => '#861a50',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'minion_color',
            array(
                'label'    => __('Accent color:', 'minion'),
                'section'  => 'colors',
                'settings' => 'minion_color',
            )
        )
    );

    $wp_customize->add_section(
        'minion_section',
        array(
            'title'    => __('Advanced settings', 'minion'),
            'priority' => 100,
        )
    );

    $wp_customize->add_setting(
        'minion_social_footer',
        array(
            'sanitize_callback' => 'minion_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'minion_social_footer',
        array(
            'type'     => 'checkbox',
            'label'    => __('By default, the social menu is placed in the header. Check this box to show the social menu in the footer instead.', 'minion'),
            'section'  => 'minion_section',
            'settings' => 'minion_social_footer',
        )
    );

    $wp_customize->add_setting(
        'minion_header_visibility',
        array(
            'sanitize_callback' => 'minion_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'minion_header_visibility',
        array(
            'type'     => 'checkbox',
            'label'    => __('By default, the header is only shown on the front page. Check this box to show the header on all posts and pages.', 'minion'),
            'section'  => 'minion_section',
            'settings' => 'minion_header_visibility',
        )
    );

    $wp_customize->add_setting(
        'minion_navigation_position',
        array(
            'default'           => 'both',
            'sanitize_callback' => 'minion_sanitize_select',
        )
    );

    $wp_customize->add_control(
        'minion_navigation_position',
        array(
            'type'        => 'select',
            'label'       => __('Post navigation', 'minion'),
            'description' => __('By default, the navigation for the next and previous posts is visible both above and below the posts. You can change the position of the navigation here:', 'minion'),
            'section'     => 'minion_section',
            'settings'    => 'minion_navigation_position',
            'choices'   => array(
                'both'  => __('Both above and below the post', 'minion'),
                'above' => __('Above the post', 'minion'),
                'below' => __('Below the post', 'minion'),
                'hide'  => __('Do not show the navigation', 'minion'),
            ),
        )
    );

    $wp_customize->add_setting(
        'minion_blog_content',
        array(
            'default'           => 'full',
            'sanitize_callback' => 'minion_sanitize_select',
        )
    );

    $wp_customize->add_control(
        'minion_blog_content',
        array(
            'type'        => 'select',
            'label'       => __('Blog and Archive content', 'minion'),
            'description' => __('By default, the blog and the archives shows the full content of the posts. You can select what to show here:', 'minion'),
            'section'     => 'minion_section',
            'settings'    => 'minion_blog_content',
            'choices'   => array(
                'full'  => __('Full content', 'minion'),
                'excerpt' => __('Excerpt', 'minion'),
            ),
        )
    );

    $wp_customize->add_setting(
        'minion_hide_credits',
        array(
            'sanitize_callback' => 'minion_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'minion_hide_credits',
        array(
            'type'    => 'checkbox',
            'label'   => __('Check this box to hide the Theme Author credit in the footer =(.', 'minion'),
            'section' => 'minion_section',
        )
    );
}
add_action('customize_register', 'minion_customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function minion_customize_preview_js()
{
    wp_enqueue_script('minion_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true);
}
add_action('customize_preview_init', 'minion_customize_preview_js');

/**
 * Sanitize the checkbox options.
 */
function minion_sanitize_checkbox($input)
{
    if (1 == $input) {
        return 1;
    } else {
        return '';
    }
}

/**
 * Sanitization callback for 'select' and 'radio' type controls. This callback sanitizes `$input`
 * as a slug, and then validates `$input` against the choices defined for the control.
 *
 * @see sanitize_text_field()        https://developer.wordpress.org/reference/functions/sanitize_text_field/
 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
 *
 * @param string               $input   Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function minion_sanitize_select($input, $setting)
{
    // Ensure input is a slug.
    $input = sanitize_text_field($input);
    // Get list of choices from the control associated with the setting.
    $choices = $setting->manager->get_control($setting->id)->choices;
    // If the input is a valid key, return it; otherwise, return the default.
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}
