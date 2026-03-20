<?php

if (!defined('ABSPATH')) {
    exit;
}

function bsn_racing_register_navbar_marke_acf_fields(): void
{
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_bsn_navbar_marke',
        'title' => 'Navbar Marke',
        'fields' => [
            [
                'key' => 'field_bsn_navbar_brand_logo',
                'label' => 'Logo',
                'name' => 'navbar_brand_logo',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
                'instructions' => 'Logo e markes per dropdown-in e Motorrader.',
            ],
            [
                'key' => 'field_bsn_navbar_brand_link',
                'label' => 'Link',
                'name' => 'navbar_brand_link',
                'type' => 'url',
                'instructions' => 'URL ku duhet te shkoje klikimi i logos.',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'navbar_marke',
                ],
            ],
        ],
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
        'show_in_rest' => 1,
    ]);
}

add_action('acf/init', 'bsn_racing_register_navbar_marke_acf_fields');
