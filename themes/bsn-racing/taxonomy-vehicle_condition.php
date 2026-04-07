<?php get_header(); ?>

<?php
$current_term = get_queried_object();
$current_term_name = $current_term instanceof WP_Term ? $current_term->name : __('Motorrader', 'bsn-racing');
$current_term_description = $current_term instanceof WP_Term ? trim((string) $current_term->description) : '';
$archive_link = get_post_type_archive_link('motorraeder');
$conditions = get_terms([
    'taxonomy' => 'vehicle_condition',
    'hide_empty' => true,
]);
?>

<main class="site-main inventory-page">
  <section class="inventory-page__hero">
    <div class="bsn-container">
      <div class="inventory-breadcrumbs">
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Startseite', 'bsn-racing'); ?></a>
        <span>/</span>
        <a href="<?php echo esc_url($archive_link ?: home_url('/motorraeder/')); ?>"><?php esc_html_e('Motorrader', 'bsn-racing'); ?></a>
        <span>/</span>
        <span><?php echo esc_html($current_term_name); ?></span>
      </div>

      <div class="inventory-page__hero-grid">
        <div class="inventory-page__hero-copy">
          <p class="section-kicker"><?php esc_html_e('Zustand', 'bsn-racing'); ?></p>
          <h1><?php echo esc_html($current_term_name); ?></h1>
          <p class="inventory-page__lead">
            <?php
            echo esc_html(
                $current_term_description !== ''
                    ? $current_term_description
                    : sprintf(__('Modelle im Bereich %s.', 'bsn-racing'), $current_term_name)
            );
            ?>
          </p>
        </div>

        <aside class="inventory-page__hero-card">
          <p class="inventory-page__eyebrow"><?php esc_html_e('Bereich', 'bsn-racing'); ?></p>
          <ul class="inventory-page__stats">
            <li>
              <strong><?php echo esc_html(number_format_i18n((int) $wp_query->found_posts)); ?></strong>
              <span><?php esc_html_e('Modelle in diesem Zustand', 'bsn-racing'); ?></span>
            </li>
          </ul>
        </aside>
      </div>
    </div>
  </section>

  <?php if (!empty($conditions) && !is_wp_error($conditions)) : ?>
    <section class="inventory-page__filters">
      <div class="bsn-container">
        <div class="inventory-page__filter-row">
          <a class="inventory-chip" href="<?php echo esc_url($archive_link ?: home_url('/motorraeder/')); ?>">
            <?php esc_html_e('Alle Modelle', 'bsn-racing'); ?>
          </a>

          <?php foreach ($conditions as $condition) : ?>
            <a class="inventory-chip<?php echo $current_term instanceof WP_Term && $condition->term_id === $current_term->term_id ? ' inventory-chip--active' : ''; ?>" href="<?php echo esc_url(get_term_link($condition)); ?>">
              <?php echo esc_html($condition->name); ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <section class="inventory-page__groups">
    <div class="bsn-container">
      <?php if (have_posts()) : ?>
        <div class="inventory-grid">
          <?php while (have_posts()) : the_post(); ?>
            <?php
            $price = function_exists('get_field') ? (string) get_field('price') : '';
            $subtitle = function_exists('get_field') ? (string) get_field('subtitle') : '';
            $card_excerpt = get_the_excerpt() ?: $subtitle ?: wp_trim_words(get_the_content(), 22);
            ?>
            <article <?php post_class('inventory-card'); ?>>
              <a class="inventory-card__media" href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()) : ?>
                  <?php the_post_thumbnail('large'); ?>
                <?php else : ?>
                  <span class="inventory-card__placeholder">Off Road Shop Metzler</span>
                <?php endif; ?>
              </a>
              <div class="inventory-card__body">
                <div class="inventory-card__topline">
                  <span class="inventory-card__condition"><?php echo esc_html($current_term_name); ?></span>
                  <?php if ($price) : ?>
                    <p class="inventory-card__price"><?php echo esc_html($price); ?></p>
                  <?php endif; ?>
                </div>
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php if ($card_excerpt) : ?>
                  <p><?php echo esc_html($card_excerpt); ?></p>
                <?php endif; ?>
                <a class="text-link" href="<?php the_permalink(); ?>"><?php esc_html_e('Mehr erfahren', 'bsn-racing'); ?></a>
              </div>
            </article>
          <?php endwhile; ?>
        </div>
      <?php else : ?>
        <div class="inventory-empty">
          <p class="section-kicker"><?php esc_html_e('Aktuell leer', 'bsn-racing'); ?></p>
          <h2><?php esc_html_e('Noch keine Motorraeder in diesem Bereich vorhanden.', 'bsn-racing'); ?></h2>
          <p><?php esc_html_e('Ordne einem Motorrad im Admin diesen Zustand zu, damit es hier sichtbar wird.', 'bsn-racing'); ?></p>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>
