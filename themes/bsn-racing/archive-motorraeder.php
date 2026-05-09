<?php get_header(); ?>

<?php
$archive_link = get_post_type_archive_link('motorraeder');
$conditions = get_terms([
    'taxonomy' => 'vehicle_condition',
    'hide_empty' => true,
]);
$total_inventory = (int) wp_count_posts('motorraeder')->publish;
?>

<main class="site-main inventory-page">
  <section class="inventory-page__hero">
    <div class="bsn-container">
      <div class="inventory-breadcrumbs">
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Startseite', 'bsn-racing'); ?></a>
        <span>/</span>
        <span><?php post_type_archive_title(); ?></span>
      </div>

      <div class="inventory-page__hero-grid">
        <div class="inventory-page__hero-copy">
          <p class="section-kicker"><?php esc_html_e('BSN Racing', 'bsn-racing'); ?></p>
          <h1><?php post_type_archive_title(); ?></h1>
          <p class="inventory-page__lead">
            <?php esc_html_e('Neue und gebrauchte Modelle in einer klaren Uebersicht mit direktem Einstieg in Details, Zustand und Anfrage.', 'bsn-racing'); ?>
          </p>
        </div>

        <aside class="inventory-page__hero-card">
          <p class="inventory-page__eyebrow"><?php esc_html_e('Schnellueberblick', 'bsn-racing'); ?></p>
          <ul class="inventory-page__stats">
            <li>
              <strong><?php echo esc_html(number_format_i18n($total_inventory)); ?></strong>
              <span><?php esc_html_e('Modelle im Bestand', 'bsn-racing'); ?></span>
            </li>
            <li>
              <strong><?php echo esc_html(!empty($conditions) && !is_wp_error($conditions) ? number_format_i18n(count($conditions)) : '0'); ?></strong>
              <span><?php esc_html_e('Bereiche', 'bsn-racing'); ?></span>
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
          <a class="inventory-chip inventory-chip--active" href="<?php echo esc_url($archive_link ?: home_url('/motorraeder/')); ?>">
            <?php esc_html_e('Alle Modelle', 'bsn-racing'); ?>
          </a>

          <?php foreach ($conditions as $condition) : ?>
            <a class="inventory-chip" href="<?php echo esc_url(get_term_link($condition)); ?>">
              <?php echo esc_html($condition->name); ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <section class="inventory-page__groups">
    <div class="bsn-container">
      <?php if (!empty($conditions) && !is_wp_error($conditions)) : ?>
        <div class="inventory-groups">
          <?php foreach ($conditions as $condition) : ?>
            <?php
            $motorraeder_query = new WP_Query([
                'post_type' => 'motorraeder',
                'posts_per_page' => -1,
                'tax_query' => [
                    [
                        'taxonomy' => 'vehicle_condition',
                        'field' => 'term_id',
                        'terms' => $condition->term_id,
                    ],
                ],
            ]);
            ?>

            <?php if ($motorraeder_query->have_posts()) : ?>
              <section class="inventory-group" id="<?php echo esc_attr('inventory-' . $condition->slug); ?>">
                <div class="inventory-group__header">
                  <div class="section-heading section-heading--stacked">
                    <p class="section-kicker"><?php echo esc_html($condition->name); ?></p>
                    <h2>
                      <?php
                      echo esc_html(
                          $condition->description !== ''
                              ? $condition->description
                              : sprintf(__('Modelle im Bereich %s.', 'bsn-racing'), $condition->name)
                      );
                      ?>
                    </h2>
                  </div>

                  <div class="inventory-group__meta">
                    <span><?php echo esc_html(number_format_i18n((int) $motorraeder_query->found_posts)); ?></span>
                    <a class="text-link" href="<?php echo esc_url(get_term_link($condition)); ?>"><?php esc_html_e('Bereich ansehen', 'bsn-racing'); ?></a>
                  </div>
                </div>

                <div class="inventory-grid">
                  <?php while ($motorraeder_query->have_posts()) : $motorraeder_query->the_post(); ?>
                    <?php
                    $price = function_exists('get_field') ? (string) get_field('price') : '';
                    $subtitle = function_exists('get_field') ? (string) get_field('subtitle') : '';
                    $card_excerpt_source = get_the_excerpt() ?: $subtitle ?: get_the_content();
                    $card_excerpt = wp_trim_words(wp_strip_all_tags($card_excerpt_source), 15, '...');
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
                          <span class="inventory-card__condition"><?php echo esc_html($condition->name); ?></span>
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

                <?php wp_reset_postdata(); ?>
              </section>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      <?php elseif (have_posts()) : ?>
        <div class="inventory-grid">
          <?php while (have_posts()) : the_post(); ?>
            <?php
            $price = function_exists('get_field') ? (string) get_field('price') : '';
            $subtitle = function_exists('get_field') ? (string) get_field('subtitle') : '';
            $card_excerpt_source = get_the_excerpt() ?: $subtitle ?: get_the_content();
            $card_excerpt = wp_trim_words(wp_strip_all_tags($card_excerpt_source), 15, '...');
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
                <?php if ($price) : ?>
                  <p class="inventory-card__price"><?php echo esc_html($price); ?></p>
                <?php endif; ?>
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
          <h2><?php esc_html_e('Noch keine Motorraeder vorhanden.', 'bsn-racing'); ?></h2>
          <p><?php esc_html_e('Lege im WordPress-Admin neue Modelle an oder ordne bestehende Fahrzeuge den Bereichen Neu und Occasion zu.', 'bsn-racing'); ?></p>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>
