<?php

if (!defined('ABSPATH')) {
    exit;
}

function bsn_racing_setup(): void
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'height' => 80,
        'width' => 240,
        'flex-height' => true,
        'flex-width' => true,
        'unlink-homepage-logo' => false,
    ]);
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);

    register_nav_menus([
        'primary' => __('Primary Menu', 'bsn-racing'),
        'footer' => __('Footer Menu', 'bsn-racing'),
    ]);
}

add_action('after_setup_theme', 'bsn_racing_setup');
