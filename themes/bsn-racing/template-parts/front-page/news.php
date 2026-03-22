<?php

$latest_news = $args['latest_news'] ?? null;
?>
<section class="news-section">
  <div class="bsn-container">
    <div class="section-heading section-heading--stacked">
      <p class="section-kicker">Aktuelles</p>
      <h2>News aus Werkstatt, Szene und Saisonstart.</h2>
    </div>

    <?php if ($latest_news instanceof WP_Query && $latest_news->have_posts()) : ?>
      <div class="news-grid">
        <?php $news_index = 0; ?>
        <?php while ($latest_news->have_posts()) : $latest_news->the_post(); ?>
          <article <?php post_class('news-card' . (0 === $news_index ? ' news-card--highlight' : '')); ?>>
            <a class="news-card__media<?php echo has_post_thumbnail() ? '' : ' image-tile image-tile--news'; ?>" href="<?php the_permalink(); ?>">
              <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('large'); ?>
              <?php elseif (0 === $news_index) : ?>
                <span class="news-card__media news-card__media--stat"><span><?php echo esc_html(get_the_date('d')); ?></span></span>
              <?php endif; ?>
            </a>
            <div class="news-card__body">
              <p class="news-card__meta"><?php echo esc_html(get_the_date('d.m.Y')); ?></p>
              <h3><?php the_title(); ?></h3>
              <p><?php echo esc_html(get_the_excerpt() ?: wp_trim_words(get_the_content(), 24)); ?></p>
              <a class="text-link" href="<?php the_permalink(); ?>">Beitrag lesen</a>
            </div>
          </article>
          <?php $news_index++; ?>
        <?php endwhile; ?>
      </div>
      <?php wp_reset_postdata(); ?>
    <?php else : ?>
      <div class="news-grid">
        <article class="news-card news-card--highlight">
          <div class="news-card__media news-card__media--stat">
            <span>BSN</span>
          </div>
          <div class="news-card__body">
            <p class="news-card__meta">Aktuelles</p>
            <h3>News-Bereich ist vorbereitet</h3>
            <p>Lege im WordPress-Admin die ersten Beitraege an, dann erscheint dieser Bereich automatisch mit echten Inhalten.</p>
          </div>
        </article>
      </div>
    <?php endif; ?>
  </div>
</section>
