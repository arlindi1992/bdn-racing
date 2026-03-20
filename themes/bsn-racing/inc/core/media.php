<?php

if (!defined('ABSPATH')) {
    exit;
}

function bsn_racing_allow_svg_uploads(array $mimes): array
{
    if (current_user_can('upload_files')) {
        $mimes['svg'] = 'image/svg+xml';
    }

    return $mimes;
}

add_filter('upload_mimes', 'bsn_racing_allow_svg_uploads');

function bsn_racing_fix_svg_filetype(array $data, string $file, string $filename, ?array $mimes = null): array
{
    $filetype = wp_check_filetype($filename, $mimes ?? []);

    if ('svg' === ($filetype['ext'] ?? '')) {
        $data['ext'] = 'svg';
        $data['type'] = 'image/svg+xml';
        $data['proper_filename'] = $filename;
    }

    return $data;
}

add_filter('wp_check_filetype_and_ext', 'bsn_racing_fix_svg_filetype', 10, 4);
