<?php

if (!defined('ABSPATH')) {
    exit;
}

function bsn_racing_register_navbar_brands_post_type(): void
{
    $labels = [
        'name' => __('Navbar Marken', 'bsn-racing'),
        'singular_name' => __('Navbar Marke', 'bsn-racing'),
        'menu_name' => __('Navbar Marken', 'bsn-racing'),
        'add_new' => __('Neue Marke', 'bsn-racing'),
        'add_new_item' => __('Neue Navbar Marke hinzufuegen', 'bsn-racing'),
        'edit_item' => __('Navbar Marke bearbeiten', 'bsn-racing'),
        'new_item' => __('Neue Navbar Marke', 'bsn-racing'),
        'view_item' => __('Navbar Marke ansehen', 'bsn-racing'),
        'search_items' => __('Navbar Marken durchsuchen', 'bsn-racing'),
        'not_found' => __('Keine Navbar Marken gefunden', 'bsn-racing'),
        'not_found_in_trash' => __('Keine Navbar Marken im Papierkorb gefunden', 'bsn-racing'),
        'all_items' => __('Alle Navbar Marken', 'bsn-racing'),
    ];

    register_post_type('navbar_marke', [
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 21,
        'menu_icon' => 'dashicons-images-alt2',
        'supports' => ['title', 'page-attributes'],
    ]);
}

add_action('init', 'bsn_racing_register_navbar_brands_post_type');
