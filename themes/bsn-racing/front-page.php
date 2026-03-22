<?php
get_header();

$front_page_id = (int) get_option('page_on_front');

if (!$front_page_id) {
    $front_page_id = (int) get_queried_object_id();
}

$resolve_hero_image_url = static function ($image): string {
    if (is_array($image)) {
        if (!empty($image['url']) && is_string($image['url'])) {
            return $image['url'];
        }

        if (!empty($image['ID'])) {
            $image_url = wp_get_attachment_image_url((int) $image['ID'], 'full');

            return $image_url ?: '';
        }

        return '';
    }

    if (is_numeric($image)) {
        $image_url = wp_get_attachment_image_url((int) $image, 'full');

        return $image_url ?: '';
    }

    return is_string($image) ? $image : '';
};

$hero_slides = function_exists('get_field') ? get_field('hero_slides', $front_page_id) : [];
$hero_slides = is_array($hero_slides) ? array_values(array_filter(array_map(static function ($slide) use ($resolve_hero_image_url): ?array {
    if (!is_array($slide)) {
        return null;
    }

    $slide['image_url'] = $resolve_hero_image_url($slide['image'] ?? null);

    return !empty($slide['image_url']) ? $slide : null;
}, $hero_slides))) : [];

$featured_models = new WP_Query([
    'post_type' => 'motorraeder',
    'posts_per_page' => 2,
]);

$secondary_models = new WP_Query([
    'post_type' => 'motorraeder',
    'posts_per_page' => 3,
    'offset' => 2,
]);

$latest_news = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 2,
]);
?>

<main class="site-main">
  <?php get_template_part('template-parts/front-page/hero', null, ['hero_slides' => $hero_slides]); ?>
  <?php get_template_part('template-parts/front-page/intro'); ?>
  <?php get_template_part('template-parts/front-page/catalog-featured', null, ['featured_models' => $featured_models]); ?>
  <?php get_template_part('template-parts/front-page/catalog-secondary', null, ['secondary_models' => $secondary_models]); ?>
  <?php get_template_part('template-parts/front-page/news', null, ['latest_news' => $latest_news]); ?>
  <?php get_template_part('template-parts/front-page/features'); ?>
  <?php get_template_part('template-parts/front-page/banner'); ?>
</main>

<?php get_footer(); ?>
