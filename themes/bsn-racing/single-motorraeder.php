<?php get_header(); ?>

<main class="site-main">
  <?php while (have_posts()) : the_post(); ?>
    <?php
    $subtitle = function_exists('get_field') ? (string) get_field('subtitle') : '';
    $price = function_exists('get_field') ? (string) get_field('price') : '';
    $brand_logo = function_exists('get_field') ? get_field('brand_logo') : null;
    $vehicle_gallery = function_exists('get_field') ? get_field('vehicle_gallery') : [];
    $engine = function_exists('get_field') ? (string) get_field('engine') : '';
    $power = function_exists('get_field') ? (string) get_field('power') : '';
    $weight = function_exists('get_field') ? (string) get_field('weight') : '';
    $seat_height = function_exists('get_field') ? (string) get_field('seat_height') : '';
    $tank_capacity = function_exists('get_field') ? (string) get_field('tank_capacity') : '';
    $cta_text = function_exists('get_field') ? (string) get_field('cta_text') : '';
    $cta_link = function_exists('get_field') ? (string) get_field('cta_link') : '';

    $highlights = array_values(array_filter([
        function_exists('get_field') ? (string) get_field('highlight_1') : '',
        function_exists('get_field') ? (string) get_field('highlight_2') : '',
        function_exists('get_field') ? (string) get_field('highlight_3') : '',
    ]));

    $conditions = get_the_terms(get_the_ID(), 'vehicle_condition');
    $condition_label = (!empty($conditions) && !is_wp_error($conditions)) ? $conditions[0]->name : __('Motorrad', 'bsn-racing');
    $featured_image_id = get_post_thumbnail_id();
    $hero_image_id = $featured_image_id ?: (!empty($vehicle_gallery[0]['ID']) ? (int) $vehicle_gallery[0]['ID'] : 0);

    $intro_heading = $subtitle ?: __('Leicht, agil, leistungsstark und mit echter Rally-DNA', 'bsn-racing');
    $intro_subheading = get_the_excerpt() ?: __('Ein fokussiertes Offroad-Bike fuer Fahrer, die Performance, Kontrolle und Abenteuer suchen.', 'bsn-racing');
    $main_content = get_the_content();

    $gallery_ids = [];

    if ($hero_image_id) {
        $gallery_ids[] = $hero_image_id;
    }

    foreach ($vehicle_gallery as $gallery_item) {
        if (!empty($gallery_item['ID'])) {
            $gallery_ids[] = (int) $gallery_item['ID'];
        }
    }

    $gallery_ids = array_values(array_unique(array_filter($gallery_ids)));

    $stats = array_filter([
        ['label' => __('Motor', 'bsn-racing'), 'value' => $engine],
        ['label' => __('Leistung', 'bsn-racing'), 'value' => $power],
        ['label' => __('Gewicht', 'bsn-racing'), 'value' => $weight],
        ['label' => __('Sitzhoehe', 'bsn-racing'), 'value' => $seat_height],
        ['label' => __('Tank', 'bsn-racing'), 'value' => $tank_capacity],
    ], static fn ($item) => !empty($item['value']));

    $faq_items = [
        [
            'question' => __('Fuer wen ist dieses Motorrad geeignet?', 'bsn-racing'),
            'answer' => __('Ideal fuer Fahrer, die echtes Adventure- und Rally-Feeling suchen und ein fokussiertes Motorrad fuer anspruchsvolle Strecken wollen.', 'bsn-racing'),
        ],
        [
            'question' => __('Ist eine Probefahrt moeglich?', 'bsn-racing'),
            'answer' => __('Ja, Probefahrten sind nach Absprache moeglich. Nutze dazu die Kontakt- oder Probefahrt-Seite.', 'bsn-racing'),
        ],
        [
            'question' => __('Gibt es Service und Ersatzteile?', 'bsn-racing'),
            'answer' => __('BSN Racing kombiniert Fahrzeugverkauf mit Werkstatt, Beratung und laufender Betreuung.', 'bsn-racing'),
        ],
    ];

    $related_models = new WP_Query([
        'post_type' => 'motorraeder',
        'posts_per_page' => 3,
        'post__not_in' => [get_the_ID()],
    ]);
    ?>

    <section class="vehicle-detail-hero">
      <div class="bsn-container">
        <div class="vehicle-breadcrumbs">
          <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Startseite', 'bsn-racing'); ?></a>
          <span>/</span>
          <a href="<?php echo esc_url(get_post_type_archive_link('motorraeder')); ?>"><?php esc_html_e('KOVE Motorrader', 'bsn-racing'); ?></a>
          <span>/</span>
          <span><?php the_title(); ?></span>
        </div>

        <div class="vehicle-detail-hero__grid">
          <div class="vehicle-detail-hero__content">
            <?php if ($brand_logo && !empty($brand_logo['ID'])) : ?>
              <div class="vehicle-detail-hero__logo">
                <?php echo wp_get_attachment_image($brand_logo['ID'], 'medium'); ?>
              </div>
            <?php endif; ?>

            <p class="section-kicker"><?php echo esc_html($condition_label); ?></p>
            <h1><?php the_title(); ?></h1>

            <?php if ($price) : ?>
              <p class="vehicle-detail-hero__price"><?php echo esc_html(sprintf(__('Preis: %s', 'bsn-racing'), $price)); ?></p>
            <?php endif; ?>

            <div class="vehicle-detail-hero__media-mobile">
              <?php if ($hero_image_id) : ?>
                <?php echo wp_get_attachment_image($hero_image_id, 'large'); ?>
              <?php else : ?>
                <div class="vehicle-detail-hero__placeholder">BSN Racing</div>
              <?php endif; ?>
            </div>

            <div class="vehicle-detail-video">
              <?php if (!empty($gallery_ids[1])) : ?>
                <?php echo wp_get_attachment_image($gallery_ids[1], 'large'); ?>
              <?php elseif ($hero_image_id) : ?>
                <?php echo wp_get_attachment_image($hero_image_id, 'large'); ?>
              <?php else : ?>
                <div class="vehicle-detail-video__placeholder"><?php esc_html_e('Video / Hero Visual', 'bsn-racing'); ?></div>
              <?php endif; ?>
            </div>
          </div>

          <div class="vehicle-detail-hero__media">
            <?php if ($hero_image_id) : ?>
              <?php echo wp_get_attachment_image($hero_image_id, 'large'); ?>
            <?php else : ?>
              <div class="vehicle-detail-hero__placeholder">BSN Racing</div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>

    <section class="vehicle-detail-intro">
      <div class="bsn-container vehicle-detail-intro__grid">
        <div>
          <h2><?php echo esc_html($intro_heading); ?></h2>
          <p class="vehicle-detail-intro__lead"><?php echo esc_html($intro_subheading); ?></p>
          <div class="vehicle-richtext">
            <?php the_content(); ?>
          </div>
        </div>

        <aside class="vehicle-colors-card">
          <h3><?php esc_html_e('Verfuegbare Farben', 'bsn-racing'); ?></h3>
          <div class="vehicle-colors-card__swatches">
            <span class="vehicle-color-swatch vehicle-color-swatch--light"></span>
            <span class="vehicle-color-swatch vehicle-color-swatch--dark"></span>
          </div>
          <?php if (!empty($stats)) : ?>
            <ul class="vehicle-stats-list">
              <?php foreach ($stats as $stat) : ?>
                <li>
                  <strong><?php echo esc_html($stat['label']); ?></strong>
                  <span><?php echo esc_html($stat['value']); ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </aside>
      </div>
    </section>

    <section class="vehicle-story-section">
      <div class="bsn-container vehicle-story-section__grid">
        <div>
          <p class="section-kicker"><?php esc_html_e('Gebaut fuer Rally und Abenteuer', 'bsn-racing'); ?></p>
          <h2><?php esc_html_e('Ein Konzept mit Fokus auf Performance, Kontrolle und Reichweite.', 'bsn-racing'); ?></h2>
        </div>
        <div class="vehicle-richtext">
          <?php if ($main_content) : ?>
            <?php the_content(); ?>
          <?php else : ?>
            <p><?php esc_html_e('Diese Modellseite ist fuer eine Kombination aus Storytelling, Technik und Verkaufsargumenten gedacht.', 'bsn-racing'); ?></p>
          <?php endif; ?>
        </div>
      </div>
      <div class="bsn-container vehicle-story-section__cta">
        <a class="button button--primary" href="#technische-daten"><?php esc_html_e('Zu den technischen Daten', 'bsn-racing'); ?></a>
      </div>
    </section>

    <?php if (!empty($highlights)) : ?>
      <section class="vehicle-highlights-section">
        <div class="bsn-container">
          <div class="section-heading section-heading--stacked">
            <p class="section-kicker"><?php esc_html_e('Highlights', 'bsn-racing'); ?></p>
            <h2><?php esc_html_e('Die staerksten Argumente dieses Modells.', 'bsn-racing'); ?></h2>
          </div>

          <div class="vehicle-highlight-grid">
            <?php foreach ($highlights as $index => $highlight) : ?>
              <article class="vehicle-highlight-card">
                <div class="vehicle-highlight-card__media">
                  <?php if (!empty($gallery_ids[$index])) : ?>
                    <?php echo wp_get_attachment_image($gallery_ids[$index], 'large'); ?>
                  <?php else : ?>
                    <div class="vehicle-highlight-card__placeholder"></div>
                  <?php endif; ?>
                </div>
                <div class="vehicle-highlight-card__body">
                  <h3><?php echo esc_html($highlight); ?></h3>
                  <p><?php esc_html_e('Diesen Punkt kannst du spaeter noch mit eigenem ACF-Text pro Highlight erweitern.', 'bsn-racing'); ?></p>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
    <?php endif; ?>

    <?php if (!empty($gallery_ids)) : ?>
      <section class="vehicle-gallery-section">
        <div class="bsn-container">
          <div class="vehicle-gallery-mosaic">
            <?php foreach ($gallery_ids as $gallery_id) : ?>
              <div class="vehicle-gallery-mosaic__item">
                <?php echo wp_get_attachment_image($gallery_id, 'large'); ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
    <?php endif; ?>

    <section class="vehicle-video-section">
      <div class="bsn-container">
        <div class="section-heading section-heading--stacked">
          <p class="section-kicker"><?php esc_html_e('Videos & Interviews', 'bsn-racing'); ?></p>
          <h2><?php esc_html_e('Eindruecke aus Praxis, Technik und Community.', 'bsn-racing'); ?></h2>
        </div>

        <div class="vehicle-video-grid">
          <article class="vehicle-video-card">
            <h3><?php esc_html_e('Die Dakar zum Einstieg', 'bsn-racing'); ?></h3>
            <p><?php esc_html_e('Hier kann spaeter ein YouTube-Link oder Embed aus ACF eingebunden werden.', 'bsn-racing'); ?></p>
          </article>
          <article class="vehicle-video-card">
            <h3><?php esc_html_e('Sind KOVE Motorraeder wirklich gut?', 'bsn-racing'); ?></h3>
            <p><?php esc_html_e('Dieses Layout ist bereits fuer mehrere Video-Teaser vorbereitet.', 'bsn-racing'); ?></p>
          </article>
          <article class="vehicle-video-card">
            <h3><?php esc_html_e('Wie sieht es mit Ersatzteilen aus?', 'bsn-racing'); ?></h3>
            <p><?php esc_html_e('Falls gewuenscht, bauen wir im naechsten Schritt ein Repeater-Feld dafuer.', 'bsn-racing'); ?></p>
          </article>
        </div>
      </div>
    </section>

    <section class="vehicle-tech-section" id="technische-daten">
      <div class="bsn-container">
        <div class="section-heading section-heading--stacked">
          <p class="section-kicker"><?php esc_html_e('Technische Daten', 'bsn-racing'); ?></p>
          <h2><?php esc_html_e('Die wichtigsten Daten im Ueberblick.', 'bsn-racing'); ?></h2>
        </div>

        <div class="vehicle-tech-grid">
          <div class="vehicle-tech-card">
            <h3><?php esc_html_e('Abmessungen', 'bsn-racing'); ?></h3>
            <ul class="vehicle-tech-list">
              <?php if ($seat_height) : ?><li><strong><?php esc_html_e('Sitzhoehe', 'bsn-racing'); ?></strong><span><?php echo esc_html($seat_height); ?></span></li><?php endif; ?>
              <?php if ($tank_capacity) : ?><li><strong><?php esc_html_e('Tankinhalt', 'bsn-racing'); ?></strong><span><?php echo esc_html($tank_capacity); ?></span></li><?php endif; ?>
              <?php if ($weight) : ?><li><strong><?php esc_html_e('Gewicht', 'bsn-racing'); ?></strong><span><?php echo esc_html($weight); ?></span></li><?php endif; ?>
            </ul>
          </div>

          <div class="vehicle-tech-card">
            <h3><?php esc_html_e('Motor', 'bsn-racing'); ?></h3>
            <ul class="vehicle-tech-list">
              <?php if ($engine) : ?><li><strong><?php esc_html_e('Motor', 'bsn-racing'); ?></strong><span><?php echo esc_html($engine); ?></span></li><?php endif; ?>
              <?php if ($power) : ?><li><strong><?php esc_html_e('Leistung', 'bsn-racing'); ?></strong><span><?php echo esc_html($power); ?></span></li><?php endif; ?>
            </ul>
          </div>

          <div class="vehicle-tech-card">
            <h3><?php esc_html_e('Ausstattung', 'bsn-racing'); ?></h3>
            <ul class="vehicle-tech-list">
              <?php foreach ($highlights as $highlight) : ?>
                <li><strong><?php esc_html_e('Highlight', 'bsn-racing'); ?></strong><span><?php echo esc_html($highlight); ?></span></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section class="vehicle-cta-section">
      <div class="bsn-container vehicle-cta-section__inner">
        <div>
          <p class="section-kicker"><?php esc_html_e('Jetzt Probefahrt vereinbaren', 'bsn-racing'); ?></p>
          <h2><?php esc_html_e('Auf nach Burgthann. Dein KOVE Erlebnis wartet schon.', 'bsn-racing'); ?></h2>
          <p><?php esc_html_e('Auch im Winter moeglich, wenn die Bedingungen passen.', 'bsn-racing'); ?></p>
        </div>
        <div class="vehicle-cta-section__actions">
          <?php if ($cta_text && $cta_link) : ?>
            <a class="button button--primary" href="<?php echo esc_url($cta_link); ?>"><?php echo esc_html($cta_text); ?></a>
          <?php endif; ?>
          <a class="button button--secondary" href="<?php echo esc_url(home_url('/probefahrt/')); ?>"><?php esc_html_e('Probefahrt', 'bsn-racing'); ?></a>
        </div>
      </div>
    </section>

    <section class="vehicle-faq-section">
      <div class="bsn-container">
        <div class="section-heading section-heading--stacked">
          <p class="section-kicker"><?php esc_html_e('Haeufige Fragen', 'bsn-racing'); ?></p>
          <h2><?php esc_html_e('Antworten rund um Technik, Service und Einsatzbereich.', 'bsn-racing'); ?></h2>
        </div>

        <div class="vehicle-faq-list">
          <?php foreach ($faq_items as $faq_item) : ?>
            <details class="vehicle-faq-item">
              <summary><?php echo esc_html($faq_item['question']); ?></summary>
              <p><?php echo esc_html($faq_item['answer']); ?></p>
            </details>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <?php if ($related_models->have_posts()) : ?>
      <section class="vehicle-related-section">
        <div class="bsn-container">
          <div class="section-heading section-heading--stacked">
            <p class="section-kicker"><?php esc_html_e('Weitere KOVE Modelle', 'bsn-racing'); ?></p>
            <h2><?php esc_html_e('Weitere Fahrzeuge aus dem Sortiment.', 'bsn-racing'); ?></h2>
          </div>

          <div class="inventory-grid">
            <?php while ($related_models->have_posts()) : $related_models->the_post(); ?>
              <?php $related_price = function_exists('get_field') ? get_field('price') : ''; ?>
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
                  <?php if ($related_price) : ?>
                    <p class="inventory-card__price"><?php echo esc_html($related_price); ?></p>
                  <?php endif; ?>
                  <a class="text-link" href="<?php the_permalink(); ?>"><?php esc_html_e('Mehr', 'bsn-racing'); ?></a>
                </div>
              </article>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
          </div>
        </div>
      </section>
    <?php endif; ?>
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
