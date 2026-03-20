<?php

if (!defined('ABSPATH')) {
    exit;
}

function bsn_racing_register_motorraeder_post_type(): void
{
    $labels = [
        'name' => __('Motorrader', 'bsn-racing'),
        'singular_name' => __('Motorrad', 'bsn-racing'),
        'menu_name' => __('Motorrader', 'bsn-racing'),
        'add_new' => __('Neues Motorrad', 'bsn-racing'),
        'add_new_item' => __('Neues Motorrad hinzufuegen', 'bsn-racing'),
        'edit_item' => __('Motorrad bearbeiten', 'bsn-racing'),
        'new_item' => __('Neues Motorrad', 'bsn-racing'),
        'view_item' => __('Motorrad ansehen', 'bsn-racing'),
        'search_items' => __('Motorrader durchsuchen', 'bsn-racing'),
        'not_found' => __('Keine Motorrader gefunden', 'bsn-racing'),
        'not_found_in_trash' => __('Keine Motorrader im Papierkorb gefunden', 'bsn-racing'),
        'all_items' => __('Alle Motorrader', 'bsn-racing'),
    ];

    register_post_type('motorraeder', [
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-superhero',
        'has_archive' => true,
        'rewrite' => ['slug' => 'motorraeder'],
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
    ]);
}

add_action('init', 'bsn_racing_register_motorraeder_post_type');

function bsn_racing_register_motorraeder_taxonomy(): void
{
    $labels = [
        'name' => __('Zustand', 'bsn-racing'),
        'singular_name' => __('Zustand', 'bsn-racing'),
        'search_items' => __('Zustaende durchsuchen', 'bsn-racing'),
        'all_items' => __('Alle Zustaende', 'bsn-racing'),
        'edit_item' => __('Zustand bearbeiten', 'bsn-racing'),
        'update_item' => __('Zustand aktualisieren', 'bsn-racing'),
        'add_new_item' => __('Neuen Zustand hinzufuegen', 'bsn-racing'),
        'new_item_name' => __('Neuer Zustand', 'bsn-racing'),
        'menu_name' => __('Neu / Occasion', 'bsn-racing'),
    ];

    register_taxonomy('vehicle_condition', ['motorraeder'], [
        'labels' => $labels,
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'zustand'],
    ]);
}

add_action('init', 'bsn_racing_register_motorraeder_taxonomy');
