<?php

if (!defined('ABSPATH')) {
    exit;
}

$bsn_racing_includes = [
    '/inc/setup.php',
    '/inc/enqueue.php',
    '/inc/post-types.php',
    '/inc/acf-fields.php',
];

foreach ($bsn_racing_includes as $bsn_racing_file) {
    $bsn_racing_path = get_template_directory() . $bsn_racing_file;

    if (file_exists($bsn_racing_path)) {
        require_once $bsn_racing_path;
    }
}
