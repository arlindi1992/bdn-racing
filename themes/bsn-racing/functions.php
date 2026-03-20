<?php

if (!defined('ABSPATH')) {
    exit;
}

$bsn_racing_includes = [
    // Core theme setup: title tag, thumbnails, menus, dhe supports baze.
    '/inc/core/setup.php',
    // Frontend assets: ngarkon CSS dhe JS te theme-s.
    '/inc/core/enqueue.php',
    // Media helpers: p.sh. lejon SVG upload ne WordPress admin.
    '/inc/core/media.php',
    // Theme helpers: logjika/query per navbar dhe pjese te tjera te theme-s.
    '/inc/theme/navbar.php',
    // Custom post types dhe taxonomies.
    '/inc/post-types/post-types.php',
    // ACF field groups qe shfaqen ne admin per content-in custom.
    '/inc/acf/acf-fields.php',
    // Seed data: krijon te dhena fillestare ne DB; hiqet pasi te jene shtuar.
    '/inc/seed/seed-data.php',
];

foreach ($bsn_racing_includes as $bsn_racing_file) {
    $bsn_racing_path = get_template_directory() . $bsn_racing_file;

    if (file_exists($bsn_racing_path)) {
        require_once $bsn_racing_path;
    }
}
