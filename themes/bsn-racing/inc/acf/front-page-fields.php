<?php

if (!defined('ABSPATH')) {
    exit;
}

function bsn_racing_register_front_page_acf_fields(): void
{
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_bsn_front_page_hero',
        'title' => 'Front Page Hero',
        'fields' => [
            [
                'key' => 'field_bsn_front_hero_slides',
                'label' => 'Hero Slides',
                'name' => 'hero_slides',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Hero Slide',
                'sub_fields' => [
                    [
                        'key' => 'field_bsn_front_hero_slide_image',
                        'label' => 'Slide Image',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                        'library' => 'all',
                    ],
                    [
                        'key' => 'field_bsn_front_hero_slide_title',
                        'label' => 'Slide Title',
                        'name' => 'title',
                        'type' => 'text',
                        'required' => 1,
                    ],
                    [
                        'key' => 'field_bsn_front_hero_slide_subtitle',
                        'label' => 'Slide Subtitle',
                        'name' => 'subtitle',
                        'type' => 'textarea',
                        'rows' => 3,
                        'new_lines' => 'br',
                        'required' => 1,
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
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

add_action('acf/init', 'bsn_racing_register_front_page_acf_fields');
