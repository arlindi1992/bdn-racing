<?php get_header(); ?>

<main class="site-main">
  <section class="inventory-hero">
    <div class="bsn-container">
      <p class="section-kicker">Motorrader</p>
      <h1><?php post_type_archive_title(); ?></h1>
      <p class="inventory-hero__lead">
        Neue und gebrauchte Fahrzeuge, sauber getrennt und spaeter bereit fuer ACF-Daten wie Preis,
        Galerie und technische Spezifikationen.
      </p>
    </div>
  </section>

  <section class="inventory-section">
    <div class="bsn-container">
      <?php
      $conditions = get_terms([
          'taxonomy' => 'vehicle_condition',
          'hide_empty' => true,
      ]);
      ?>

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
              <section class="inventory-group">
                <div class="section-heading section-heading--stacked">
                  <p class="section-kicker"><?php echo esc_html($condition->name); ?></p>
                  <h2><?php echo esc_html($condition->description ?: sprintf(__('Fahrzeuge im Bereich %s', 'bsn-racing'), $condition->name)); ?></h2>
                </div>

                <div class="inventory-grid">
                  <?php while ($motorraeder_query->have_posts()) : $motorraeder_query->the_post(); ?>
                    <article <?php post_class('inventory-card'); ?>>
                      <a class="inventory-card__media" href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                          <?php the_post_thumbnail('large'); ?>
                        <?php else : ?>
                          <span class="inventory-card__placeholder">BSN</span>
                        <?php endif; ?>
                      </a>
                      <div class="inventory-card__body">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <?php if (has_excerpt()) : ?>
                          <p><?php echo esc_html(get_the_excerpt()); ?></p>
                        <?php else : ?>
                          <p><?php echo esc_html(wp_trim_words(get_the_content(), 20)); ?></p>
                        <?php endif; ?>
                        <a class="text-link" href="<?php the_permalink(); ?>"><?php esc_html_e('Fahrzeug ansehen', 'bsn-racing'); ?></a>
                      </div>
                    </article>
                  <?php endwhile; ?>
                </div>
              </section>
              <?php wp_reset_postdata(); ?>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      <?php elseif (have_posts()) : ?>
        <div class="inventory-grid">
          <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class('inventory-card'); ?>>
              <a class="inventory-card__media" href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()) : ?>
                  <?php the_post_thumbnail('large'); ?>
                <?php else : ?>
                  <span class="inventory-card__placeholder">BSN</span>
                <?php endif; ?>
              </a>
              <div class="inventory-card__body">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p><?php echo esc_html(wp_trim_words(get_the_content(), 20)); ?></p>
              </div>
            </article>
          <?php endwhile; ?>
        </div>
      <?php else : ?>
        <p><?php esc_html_e('Noch keine Motorrader vorhanden.', 'bsn-racing'); ?></p>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>
