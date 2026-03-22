<?php

$featured_models = $args['featured_models'] ?? null;
?>
<section class="catalog-section catalog-section--dark">
  <div class="bsn-container">
    <div class="section-heading section-heading--stacked">
      <p class="section-kicker">Entdecke unsere KOVE Modelle</p>
      <h2>Adventure Spirit mit Rally-DNA.</h2>
    </div>

    <?php if ($featured_models instanceof WP_Query && $featured_models->have_posts()) : ?>
      <div class="product-grid product-grid--two">
        <?php while ($featured_models->have_posts()) : $featured_models->the_post(); ?>
          <?php
          $price = function_exists('get_field') ? (string) get_field('price') : '';
          $subtitle = function_exists('get_field') ? (string) get_field('subtitle') : '';
          ?>
          <article <?php post_class('product-card'); ?>>
            <a class="product-card__media" href="<?php the_permalink(); ?>">
              <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('large'); ?>
              <?php else : ?>
                <div class="image-tile image-tile--bike-red"></div>
              <?php endif; ?>
            </a>
            <div class="product-card__body">
              <h3><?php the_title(); ?></h3>
              <p><?php echo esc_html($subtitle ?: get_the_excerpt() ?: wp_trim_words(get_the_content(), 20)); ?></p>
              <?php if ($price) : ?>
                <p class="product-card__price"><?php echo esc_html($price); ?></p>
              <?php endif; ?>
              <a class="text-link text-link--accent" href="<?php the_permalink(); ?>">Mehr erfahren</a>
            </div>
          </article>
        <?php endwhile; ?>
      </div>
      <?php wp_reset_postdata(); ?>
    <?php else : ?>
      <div class="product-grid product-grid--two">
        <article class="product-card">
          <div class="image-tile image-tile--bike-red"></div>
          <div class="product-card__body">
            <h3>450 Rally</h3>
            <p>Lege jetzt die ersten Motorrader im Admin an, damit die Startseite automatisch befuellt wird.</p>
            <a class="text-link text-link--accent" href="<?php echo esc_url(get_post_type_archive_link('motorraeder')); ?>">Alle Modelle</a>
          </div>
        </article>
      </div>
    <?php endif; ?>
  </div>
</section>
