<?php

if (!defined('ABSPATH')) {
    exit;
}

function bsn_racing_register_acf_fields(): void
{
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_bsn_motorrad_details',
        'title' => 'Motorrad Details',
        'fields' => [
            [
                'key' => 'field_bsn_subtitle',
                'label' => 'Subtitle',
                'name' => 'subtitle',
                'type' => 'text',
            ],
            [
                'key' => 'field_bsn_price',
                'label' => 'Price',
                'name' => 'price',
                'type' => 'text',
            ],
            [
                'key' => 'field_bsn_brand_logo',
                'label' => 'Brand Logo',
                'name' => 'brand_logo',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ],
            [
                'key' => 'field_bsn_vehicle_gallery',
                'label' => 'Vehicle Gallery',
                'name' => 'vehicle_gallery',
                'type' => 'gallery',
                'return_format' => 'array',
                'library' => 'all',
                'preview_size' => 'medium',
            ],
            [
                'key' => 'field_bsn_engine',
                'label' => 'Engine',
                'name' => 'engine',
                'type' => 'text',
            ],
            [
                'key' => 'field_bsn_power',
                'label' => 'Power',
                'name' => 'power',
                'type' => 'text',
            ],
            [
                'key' => 'field_bsn_weight',
                'label' => 'Weight',
                'name' => 'weight',
                'type' => 'text',
            ],
            [
                'key' => 'field_bsn_seat_height',
                'label' => 'Seat Height',
                'name' => 'seat_height',
                'type' => 'text',
            ],
            [
                'key' => 'field_bsn_tank_capacity',
                'label' => 'Tank Capacity',
                'name' => 'tank_capacity',
                'type' => 'text',
            ],
            [
                'key' => 'field_bsn_cta_text',
                'label' => 'CTA Text',
                'name' => 'cta_text',
                'type' => 'text',
            ],
            [
                'key' => 'field_bsn_cta_link',
                'label' => 'CTA Link',
                'name' => 'cta_link',
                'type' => 'url',
            ],
            [
                'key' => 'field_bsn_highlight_1',
                'label' => 'Highlight 1',
                'name' => 'highlight_1',
                'type' => 'text',
            ],
            [
                'key' => 'field_bsn_highlight_2',
                'label' => 'Highlight 2',
                'name' => 'highlight_2',
                'type' => 'text',
            ],
            [
                'key' => 'field_bsn_highlight_3',
                'label' => 'Highlight 3',
                'name' => 'highlight_3',
                'type' => 'text',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'motorraeder',
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

add_action('acf/init', 'bsn_racing_register_acf_fields');
