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
}

add_action('wp_enqueue_scripts', 'bsn_racing_assets');
