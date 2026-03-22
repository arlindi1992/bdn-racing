<?php

$secondary_models = $args['secondary_models'] ?? null;
?>
<section class="catalog-section">
  <div class="bsn-container">
    <div class="section-heading section-heading--stacked">
      <p class="section-kicker">Weitere KOVE Bikes</p>
      <h2>Vom Touring bis zur sportlichen Reiseenduro.</h2>
    </div>

    <div class="product-grid">
      <?php if ($secondary_models instanceof WP_Query && $secondary_models->have_posts()) : ?>
        <?php while ($secondary_models->have_posts()) : $secondary_models->the_post(); ?>
          <?php $subtitle = function_exists('get_field') ? (string) get_field('subtitle') : ''; ?>
          <article <?php post_class('product-card product-card--light'); ?>>
            <a class="product-card__media" href="<?php the_permalink(); ?>">
              <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('large'); ?>
              <?php else : ?>
                <div class="image-tile image-tile--desert"></div>
              <?php endif; ?>
            </a>
            <div class="product-card__body">
              <h3><?php the_title(); ?></h3>
              <p><?php echo esc_html($subtitle ?: get_the_excerpt() ?: wp_trim_words(get_the_content(), 18)); ?></p>
              <a class="text-link" href="<?php the_permalink(); ?>">Details ansehen</a>
            </div>
          </article>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      <?php endif; ?>

      <article class="product-card product-card--light product-card--text">
        <div class="product-card__body">
          <p class="section-kicker">Community und Touren</p>
          <h3>Reisen, testen, Erfahrungen teilen</h3>
          <p>
            Neben den Bikes bleiben Probefahrten, News und gefuehrte Touren zentrale Elemente
            der Startseite. Genau das bildet auch der Screenshot sichtbar ab.
          </p>
          <a class="button button--primary" href="<?php echo esc_url(get_post_type_archive_link('motorraeder')); ?>">Alle Modelle</a>
        </div>
      </article>
    </div>
  </div>
</section>
