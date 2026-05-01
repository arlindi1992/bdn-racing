<?php
/**
 * Enqueue theme assets (CSS & JS)
 */
if (!defined('ABSPATH')) {
    exit;
}

function bsn_racing_assets(): void
{
    $theme = wp_get_theme();

    wp_enqueue_style(
        'bsn-racing-navbar',
        get_template_directory_uri() . '/assets/css/navbar.css',
        [],
        $theme->get('Version')
    );

    wp_enqueue_style(
        'bsn-racing-main',
        get_template_directory_uri() . '/assets/css/main.css',
        ['bsn-racing-navbar'],
        $theme->get('Version')
    );

    wp_enqueue_style(
        'bsn-racing-footer',
        get_template_directory_uri() . '/assets/css/footer.css',
        ['bsn-racing-main'],
        $theme->get('Version')
    );

    wp_enqueue_style(
        'bsn-racing-lightbox',
        get_template_directory_uri() . '/assets/css/lightbox.css',
        ['bsn-racing-main'],
        $theme->get('Version')
    );

    wp_enqueue_style(
        'bsn-racing-cookies',
        get_template_directory_uri() . '/assets/css/cookies.css',
        ['bsn-racing-main'],
        $theme->get('Version')
    );

    if (is_page() || is_home()) {
        wp_enqueue_style(
            'bsn-racing-page',
            get_template_directory_uri() . '/assets/css/page.css',
            ['bsn-racing-main'],
            $theme->get('Version')
        );
    }

    if (is_page('kontakt')) {
        wp_enqueue_style(
            'bsn-racing-contact-form',
            get_template_directory_uri() . '/assets/css/contact-form.css',
            ['bsn-racing-page'],
            $theme->get('Version')
        );
    }

    if (is_home() || (is_archive() && !is_post_type_archive('motorraeder') && !is_tax('vehicle_condition'))) {
        wp_enqueue_style(
            'bsn-racing-news',
            get_template_directory_uri() . '/assets/css/news.css',
            ['bsn-racing-main'],
            $theme->get('Version')
        );
    }

    if (is_post_type_archive('motorraeder') || is_tax('vehicle_condition') || is_singular('motorraeder')) {
        wp_enqueue_style(
            'bsn-racing-motorraeder',
            get_template_directory_uri() . '/assets/css/motorraeder.css',
            ['bsn-racing-main'],
            $theme->get('Version')
        );
    }

    if (is_singular('motorraeder')) {
        wp_enqueue_style(
            'bsn-racing-vehicle-single',
            get_template_directory_uri() . '/assets/css/vehicle-single.css',
            ['bsn-racing-motorraeder'],
            $theme->get('Version')
        );
    }

    if (is_single() && !is_singular('motorraeder')) {
        wp_enqueue_style(
            'bsn-racing-single',
            get_template_directory_uri() . '/assets/css/single.css',
            ['bsn-racing-main'],
            $theme->get('Version')
        );
    }

    wp_enqueue_script(
        'bsn-racing-navbar',
        get_template_directory_uri() . '/assets/js/navbar.js',
        [],
        $theme->get('Version'),
        true
    );

    wp_enqueue_script(
        'bsn-racing-main',
        get_template_directory_uri() . '/assets/js/main.js',
        ['bsn-racing-navbar'],
        $theme->get('Version'),
        true
    );

    wp_enqueue_script(
        'bsn-racing-hero',
        get_template_directory_uri() . '/assets/js/hero.js',
        ['bsn-racing-main'],
        $theme->get('Version'),
        true
    );
}

add_action('wp_enqueue_scripts', 'bsn_racing_assets');
