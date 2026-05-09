<?php

if (!defined('ABSPATH')) {
    exit;
}

function bsn_racing_maybe_import_navbar_brand_logo(string $filename, string $title): int
{
    $source_path = get_template_directory() . '/assets/img/navbar/' . $filename;

    if (!file_exists($source_path)) {
        return 0;
    }

    $existing_attachment = get_page_by_title($title, OBJECT, 'attachment');

    if ($existing_attachment instanceof WP_Post) {
        return (int) $existing_attachment->ID;
    }

    $file_contents = file_get_contents($source_path);

    if (false === $file_contents) {
        return 0;
    }

    $upload = wp_upload_bits(wp_basename($source_path), null, $file_contents);

    if (!empty($upload['error']) || empty($upload['file'])) {
        return 0;
    }

    $filetype = wp_check_filetype($upload['file']);
    $attachment_id = wp_insert_attachment([
        'guid' => $upload['url'],
        'post_mime_type' => $filetype['type'] ?? '',
        'post_title' => $title,
        'post_content' => '',
        'post_status' => 'inherit',
    ], $upload['file']);

    if (is_wp_error($attachment_id) || !$attachment_id) {
        return 0;
    }

    require_once ABSPATH . 'wp-admin/includes/image.php';

    $metadata = wp_generate_attachment_metadata($attachment_id, $upload['file']);
    wp_update_attachment_metadata($attachment_id, $metadata);

    return (int) $attachment_id;
}

function bsn_racing_seed_navbar_brands(): void
{
    if (!is_admin() || !post_type_exists('navbar_marke')) {
        return;
    }

    $brands = [
        [
            'title' => 'Sherco',
            'slug' => 'sherco',
            'filename' => 'sherco_thumb.jpg',
            'link' => 'https://www.sherco.com/en/',
        ],
        [
            'title' => 'TM Moto',
            'slug' => 'tm-moto',
            'filename' => 'tm_moyo.png',
            'link' => 'https://mercant-moto.ch/',
        ],
        [
            'title' => 'Husaberg',
            'slug' => 'husaberg',
            'filename' => 'Husaberg_logo.png',
            'link' => 'https://www.motoscout24.ch/fr/s/mk-husaberg',
        ],
        [
            'title' => 'CF Moto',
            'slug' => 'cf-moto',
            'filename' => 'CFMOTO_logo_black_HORIZ.svg',
            'link' => 'https://cfmoto-schweiz.ch/de/',
        ],
        [
            'title' => 'Nerva',
            'slug' => 'nerva',
            'filename' => 'nerva-negro-logo.png',
            'link' => 'https://www.nerva.ch/',
        ],
        [
            'title' => 'Beta',
            'slug' => 'beta',
            'filename' => 'betamoto-logo-dark.png',
            'link' => 'https://www.betamotor.com/fr-fr/',
        ],
    ];

    foreach ($brands as $index => $brand) {
        $existing_post = get_page_by_path($brand['slug'], OBJECT, 'navbar_marke');
        $post_args = [
            'post_type' => 'navbar_marke',
            'post_status' => 'publish',
            'post_title' => $brand['title'],
            'post_name' => $brand['slug'],
            'menu_order' => $index + 1,
        ];

        if ($existing_post instanceof WP_Post) {
            $post_args['ID'] = $existing_post->ID;
            $post_id = wp_update_post($post_args, true);
        } else {
            $post_id = wp_insert_post($post_args, true);
        }

        if (is_wp_error($post_id) || !$post_id) {
            continue;
        }

        $attachment_id = bsn_racing_maybe_import_navbar_brand_logo(
            $brand['filename'],
            $brand['title'] . ' Navbar Logo'
        );

        if (function_exists('update_field')) {
            update_field('field_bsn_navbar_brand_link', $brand['link'], $post_id);

            if ($attachment_id) {
                update_field('field_bsn_navbar_brand_logo', $attachment_id, $post_id);
            }
        }
    }
}

add_action('admin_init', 'bsn_racing_seed_navbar_brands');

function bsn_racing_seed_primary_menu(): void
{
    if (!is_admin()) {
        return;
    }

    $menu_name = 'Primary Menu';
    $menu_object = wp_get_nav_menu_object($menu_name);
    $menu_id = $menu_object ? (int) $menu_object->term_id : 0;

    if (!$menu_id) {
        $menu_id = (int) wp_create_nav_menu($menu_name);
    }

    if (!$menu_id || is_wp_error($menu_id)) {
        return;
    }

    // Kjo eshte struktura e meny-se qe do te krijohet nese nuk ekziston; gjithashtu perdoret per te upsert-uar itemet e meny-se ne meny-n ekzistuese, bazuar ne title, url dhe parent_id (per te shmangur duplikimet ne cdo rrun)
    $items = [
        [
            'key' => 'home',
            'title' => 'Home',
            'url' => '/',
        ],
        [
            'key' => 'news',
            'title' => 'News',
            'url' => '/news/',
        ],
        [
            'key' => 'bsn',
            'title' => 'Off Road Metzler',
            'url' => '/offroad-shop-metzler/',
            'children' => [
                [
                    'key' => 'bsn-serviceanfrage',
                    'title' => 'Serviceanfrage',
                    'url' => '/serviceanfrage/',
                ],
                [
                    'key' => 'bsn-fotos',
                    'title' => 'Fotos',
                    'url' => '/fotos/',
                ],
            ],
        ],
        [
            'key' => 'motorraeder',
            'title' => 'Motorraeder',
            'url' => '/motorraeder/',
            'children' => [
                [
                    'key' => 'motorraeder-all',
                    'title' => 'Alle Motorraeder',
                    'url' => '/motorraeder/',
                ],
                [
                    'key' => 'motorraeder-neu',
                    'title' => 'Neu',
                    'url' => '/motorraeder/neu/',
                ],
                [
                    'key' => 'motorraeder-occasion',
                    'title' => 'Occasion',
                    'url' => '/motorraeder/occasion/',
                ],
            ],
        ],
        [
            'key' => 'kontakt',
            'title' => 'Kontakt',
            'url' => '/kontakt/',
        ],
        [
            'key' => 'shop',
            'title' => 'Shop',
            'url' => '/shop/',
            'children' => [
                [
                    'key' => 'shop-fahrzeuge',
                    'title' => 'Fahrzeuge',
                    'url' => '/shop/fahrzeuge/',
                ],
                [
                    'key' => 'shop-teile',
                    'title' => 'Teile',
                    'url' => '/shop/teile/',
                ],
                [
                    'key' => 'shop-motoscout24',
                    'title' => 'Motoscout24.ch Fahrzeuge',
                    'url' => 'https://www.motoscout24.ch',
                    'target' => '_blank',
                ],
                [
                    'key' => 'shop-tutti',
                    'title' => 'Tutti.ch Teile',
                    'url' => 'https://www.tutti.ch',
                    'target' => '_blank',
                ],
            ],
        ],
    ];

    $existing_items = wp_get_nav_menu_items($menu_id, [
        'post_status' => 'any',
    ]);

    $existing_map = [];

    if (is_array($existing_items)) {
        foreach ($existing_items as $existing_item) {
            $seed_key = (string) get_post_meta((int) $existing_item->ID, '_bsn_seed_key', true);

            if ($seed_key !== '') {
                $existing_map[$seed_key] = (int) $existing_item->ID;
                continue;
            }

            $fallback_key = bsn_racing_get_seeded_menu_item_legacy_key(
                (string) $existing_item->title,
                (string) $existing_item->url,
                (int) $existing_item->menu_item_parent
            );

            $existing_map[$fallback_key] = (int) $existing_item->ID;
        }
    }

    $menu_order = 1;

    foreach ($items as $item) {
        $parent_id = bsn_racing_upsert_seeded_menu_item(
            $menu_id,
            $item,
            0,
            $menu_order,
            $existing_map
        );

        $menu_order++;

        if (!$parent_id || empty($item['children'])) {
            continue;
        }

        foreach ($item['children'] as $child) {
            bsn_racing_upsert_seeded_menu_item(
                $menu_id,
                $child,
                $parent_id,
                $menu_order,
                $existing_map
            );

            $menu_order++;
        }
    }

    $locations = get_nav_menu_locations();
    $locations['primary'] = $menu_id;
    set_theme_mod('nav_menu_locations', $locations);

    bsn_racing_delete_obsolete_seeded_menu_items($menu_id, [
        'news-aktuelle-meldungen',
    ]);
}

function bsn_racing_get_seeded_menu_item_legacy_key(string $title, string $url, int $parent_id): string
{
    return md5($title . '|' . untrailingslashit($url) . '|' . $parent_id);
}

function bsn_racing_upsert_seeded_menu_item(
    int $menu_id,
    array $item,
    int $parent_id,
    int $menu_order,
    array &$existing_map
): int {
    $seed_key = (string) ($item['key'] ?? '');
    $title = (string) ($item['title'] ?? '');
    $url = (string) ($item['url'] ?? '');

    if ($seed_key === '' || $title === '' || $url === '') {
        return 0;
    }

    $legacy_key = bsn_racing_get_seeded_menu_item_legacy_key($title, $url, $parent_id);
    $item_id = $existing_map[$seed_key]
        ?? ($existing_map[$legacy_key] ?? 0);

    $menu_item_data = [
        'menu-item-title' => $title,
        'menu-item-url' => $url,
        'menu-item-status' => 'publish',
        'menu-item-type' => 'custom',
        'menu-item-parent-id' => $parent_id,
        'menu-item-position' => $menu_order,
    ];

    if (!empty($item['target'])) {
        $menu_item_data['menu-item-target'] = (string) $item['target'];
    }

    $updated_item_id = wp_update_nav_menu_item($menu_id, $item_id, $menu_item_data);

    if (is_wp_error($updated_item_id) || !$updated_item_id) {
        return 0;
    }

    update_post_meta((int) $updated_item_id, '_bsn_seed_key', $seed_key);

    $existing_map[$seed_key] = (int) $updated_item_id;
    $existing_map[$legacy_key] = (int) $updated_item_id;

    return (int) $updated_item_id;
}

function bsn_racing_delete_obsolete_seeded_menu_items(int $menu_id, array $obsolete_seed_keys): void
{
    if (empty($obsolete_seed_keys)) {
        return;
    }

    $menu_items = wp_get_nav_menu_items($menu_id, [
        'post_status' => 'any',
    ]);

    if (!is_array($menu_items)) {
        return;
    }

    foreach ($menu_items as $menu_item) {
        $seed_key = (string) get_post_meta((int) $menu_item->ID, '_bsn_seed_key', true);

        if ($seed_key === '' || !in_array($seed_key, $obsolete_seed_keys, true)) {
            continue;
        }

        wp_delete_post((int) $menu_item->ID, true);
    }
}

function bsn_racing_sync_primary_menu_seed(): void
{
    if (!is_admin()) {
        return;
    }

    bsn_racing_seed_primary_menu();
}

add_action('admin_init', 'bsn_racing_sync_primary_menu_seed');

// Primary menu seeding now syncs on every admin request so code-level menu
// changes are reflected immediately for seeded items.
