<?php

if (!defined('ABSPATH')) {
    exit;
}

function bsn_racing_get_navbar_brands(): array
{
    $brands = [];

    // Kjo query merr te gjitha "navbar_marke" posts te publikuara, te renditura fillimisht sipas "menu_order" (per te lejuar rregullim manual ne admin
    $navbar_brand_query = new WP_Query([
        'post_type' => 'navbar_marke',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => [
            'menu_order' => 'ASC',
            'title' => 'ASC',
        ],
        'order' => 'ASC',
    ]);

    // Loop neper rezultatet e query-t dhe nderto nje array me te dhenat e nevojshme per secilen marke (label, image_url, url)
    if ($navbar_brand_query->have_posts()) {
        while ($navbar_brand_query->have_posts()) {
            $navbar_brand_query->the_post();

            $brand_logo = function_exists('get_field') ? get_field('navbar_brand_logo') : null;
            $brand_link = function_exists('get_field') ? (string) get_field('navbar_brand_link') : '';

            if (empty($brand_logo['url'])) {
                continue;
            }

            $brands[] = [
                'label' => get_the_title(),
                'image_url' => $brand_logo['url'],
                'url' => $brand_link ?: '#',
            ];
        }

        wp_reset_postdata();
    }

    if (!empty($brands)) {
        return $brands;
    }

    return [
        [
            'label' => 'Sherco',
            'image_url' => get_template_directory_uri() . '/assets/img/navbar/sherco_thumb.jpg',
            'url' => 'https://www.sherco.com/en/',
        ],
        [
            'label' => 'TM Moto',
            'image_url' => get_template_directory_uri() . '/assets/img/navbar/tm_moyo.png',
            'url' => 'https://mercant-moto.ch/',
        ],
        [
            'label' => 'Husaberg',
            'image_url' => get_template_directory_uri() . '/assets/img/navbar/Husaberg_logo.png',
            'url' => 'https://www.motoscout24.ch/fr/s/mk-husaberg',
        ],
        [
            'label' => 'CF Moto',
            'image_url' => get_template_directory_uri() . '/assets/img/navbar/CFMOTO_logo_black_HORIZ.svg',
            'url' => 'https://cfmoto-schweiz.ch/de/',
        ],
        [
            'label' => 'Nerva',
            'image_url' => get_template_directory_uri() . '/assets/img/navbar/nerva-negro-logo.png',
            'url' => 'https://www.nerva.ch/',
        ],
        [
            'label' => 'Beta',
            'image_url' => get_template_directory_uri() . '/assets/img/navbar/betamoto-logo-dark.png',
            'url' => 'https://www.betamotor.com/fr-fr/',
        ],
    ];
}
