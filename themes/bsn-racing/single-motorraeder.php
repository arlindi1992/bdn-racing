<?php get_header(); ?>

<main class="site-main vehicle-single">
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
    $featured_image_id = (int) get_post_thumbnail_id();

    $gallery_ids = [];
    foreach ($vehicle_gallery as $gallery_item) {
        if (!empty($gallery_item['ID'])) {
            $gallery_ids[] = (int) $gallery_item['ID'];
        }
    }
    $gallery_ids = array_values(array_unique(array_filter($gallery_ids)));

    $hero_image_id = $featured_image_id ?: (!empty($gallery_ids[0]) ? (int) $gallery_ids[0] : 0);

    $gallery_display_ids = $gallery_ids;
    if ($featured_image_id && !in_array($featured_image_id, $gallery_display_ids, true)) {
        array_unshift($gallery_display_ids, $featured_image_id);
    }

    $summary_specs = array_values(array_filter([
        ['label' => __('Motor', 'bsn-racing'), 'value' => $engine],
        ['label' => __('Leistung', 'bsn-racing'), 'value' => $power],
        ['label' => __('Gewicht', 'bsn-racing'), 'value' => $weight],
        ['label' => __('Sitzhoehe', 'bsn-racing'), 'value' => $seat_height],
        ['label' => __('Tank', 'bsn-racing'), 'value' => $tank_capacity],
    ], static fn ($item) => !empty($item['value'])));

    $lead_text = get_the_excerpt() ?: $subtitle;
    $has_main_content = trim((string) get_the_content()) !== '';

    $related_models = new WP_Query([
        'post_type' => 'motorraeder',
        'posts_per_page' => 3,
        'post__not_in' => [get_the_ID()],
    ]);
    $hero_image_url = $hero_image_id ? wp_get_attachment_image_url($hero_image_id, 'full') : '';
    ?>

    <section class="vehicle-single__hero"<?php echo $hero_image_url ? ' style="background-image: linear-gradient(135deg, rgba(15, 23, 32, 0.72) 0%, rgba(15, 23, 32, 0.42) 45%, rgba(15, 23, 32, 0.68) 100%), url(' . esc_url($hero_image_url) . ');"' : ''; ?>>
      <div class="bsn-container">
        <div class="vehicle-breadcrumbs">
          <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Startseite', 'bsn-racing'); ?></a>
          <span>/</span>
          <a href="<?php echo esc_url(get_post_type_archive_link('motorraeder')); ?>"><?php esc_html_e('Motorrader', 'bsn-racing'); ?></a>
          <span>/</span>
          <span><?php the_title(); ?></span>
        </div>

        <div class="vehicle-single__hero-grid">
          <div class="vehicle-single__hero-copy">
            <p class="section-kicker"><?php echo esc_html($condition_label); ?></p>
            <h1><?php the_title(); ?></h1>

            <?php if ($price) : ?>
              <p class="vehicle-single__price"><?php echo esc_html($price); ?></p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>

    <section class="vehicle-single__overview">
      <div class="bsn-container vehicle-single__overview-grid">
        <div class="vehicle-single__content-card">
          <?php if ($brand_logo && !empty($brand_logo['ID'])) : ?>
            <div class="vehicle-single__brand">
              <?php echo wp_get_attachment_image($brand_logo['ID'], 'medium'); ?>
            </div>
          <?php endif; ?>

          <div class="section-heading section-heading--stacked">
            <p class="section-kicker"><?php esc_html_e('Modellueberblick', 'bsn-racing'); ?></p>
            <h2><?php esc_html_e('Fokus auf Fahrgefuehl, Einsatzbereich und Charakter.', 'bsn-racing'); ?></h2>
          </div>

          <?php if ($subtitle || $lead_text) : ?>
            <div class="vehicle-single__intro-text">
              <?php if ($subtitle) : ?>
                <p class="vehicle-single__subtitle"><?php echo esc_html($subtitle); ?></p>
              <?php endif; ?>
              <?php if ($lead_text) : ?>
                <p class="vehicle-single__lead"><?php echo esc_html($lead_text); ?></p>
              <?php endif; ?>
            </div>
          <?php endif; ?>

          <div class="vehicle-single__richtext">
            <?php if ($has_main_content) : ?>
              <?php the_content(); ?>
            <?php else : ?>
              <p><?php esc_html_e('Ergaenze hier im WordPress-Editor die Story, Einsatzbereiche und die wichtigsten Verkaufsargumente dieses Modells.', 'bsn-racing'); ?></p>
            <?php endif; ?>
          </div>
        </div>

        <aside class="vehicle-single__specs-card">
          <div class="section-heading section-heading--stacked">
            <p class="section-kicker"><?php esc_html_e('Technische Daten', 'bsn-racing'); ?></p>
            <h2><?php esc_html_e('Wichtige Kennzahlen auf einen Blick.', 'bsn-racing'); ?></h2>
          </div>

          <?php if (!empty($summary_specs)) : ?>
            <ul class="vehicle-single__specs-list">
              <?php foreach ($summary_specs as $spec) : ?>
                <li>
                  <span><?php echo esc_html($spec['label']); ?></span>
                  <strong><?php echo esc_html($spec['value']); ?></strong>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php else : ?>
            <p><?php esc_html_e('Technische Daten koennen hier ueber ACF gepflegt werden.', 'bsn-racing'); ?></p>
          <?php endif; ?>

          <div class="vehicle-single__actions">
            <?php if ($cta_text && $cta_link) : ?>
              <a class="button button--primary" href="<?php echo esc_url($cta_link); ?>"><?php echo esc_html($cta_text); ?></a>
            <?php endif; ?>
            <a class="button button--secondary" href="<?php echo esc_url(home_url('/probefahrt/')); ?>"><?php esc_html_e('Probefahrt', 'bsn-racing'); ?></a>
          </div>
        </aside>
      </div>
    </section>

    <?php if (!empty($highlights)) : ?>
      <section class="vehicle-single__highlights">
        <div class="bsn-container">
          <div class="section-heading section-heading--stacked">
            <p class="section-kicker"><?php esc_html_e('Highlights', 'bsn-racing'); ?></p>
            <h2><?php esc_html_e('Die wichtigsten Verkaufsargumente dieses Modells.', 'bsn-racing'); ?></h2>
          </div>

          <div class="vehicle-single__highlight-grid">
            <?php foreach ($highlights as $highlight) : ?>
              <article class="vehicle-single__highlight-card">
                <h3><?php echo esc_html($highlight); ?></h3>
              </article>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
    <?php endif; ?>

    <?php if (!empty($gallery_display_ids)) : ?>
      <section class="vehicle-single__gallery">
        <div class="bsn-container">
          <div class="section-heading section-heading--stacked">
            <p class="section-kicker"><?php esc_html_e('Galerie', 'bsn-racing'); ?></p>
            <h2><?php esc_html_e('Bilder dieses Motorrads.', 'bsn-racing'); ?></h2>
          </div>

          <div class="vehicle-single__gallery-grid">
            <?php foreach ($gallery_display_ids as $gallery_id) : ?>
              <div class="vehicle-single__gallery-item">
                <button
                  class="vehicle-single__gallery-trigger"
                  type="button"
                  data-lightbox-group="motorraeder-gallery"
                  data-lightbox-src="<?php echo esc_url(wp_get_attachment_image_url($gallery_id, 'full')); ?>"
                  data-lightbox-alt="<?php echo esc_attr(get_the_title()); ?>"
                >
                  <?php echo wp_get_attachment_image($gallery_id, 'large'); ?>
                </button>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
    <?php endif; ?>

    <section class="vehicle-single__cta">
      <div class="bsn-container vehicle-single__cta-inner">
        <div>
          <p class="section-kicker"><?php esc_html_e('Beratung & Probefahrt', 'bsn-racing'); ?></p>
          <h2><?php esc_html_e('Interesse an diesem Modell?', 'bsn-racing'); ?></h2>
          <p><?php esc_html_e('Wir helfen dir bei Verfuegbarkeit, Beratung und dem naechsten Schritt zur Probefahrt oder Anfrage.', 'bsn-racing'); ?></p>
        </div>

        <div class="vehicle-single__actions">
          <?php if ($cta_text && $cta_link) : ?>
            <a class="button button--primary" href="<?php echo esc_url($cta_link); ?>"><?php echo esc_html($cta_text); ?></a>
          <?php endif; ?>
          <a class="button button--secondary" href="<?php echo esc_url(home_url('/kontakt/')); ?>"><?php esc_html_e('Kontakt', 'bsn-racing'); ?></a>
        </div>
      </div>
    </section>

    <?php if ($related_models->have_posts()) : ?>
      <section class="vehicle-single__related">
        <div class="bsn-container">
          <div class="section-heading section-heading--stacked">
            <p class="section-kicker"><?php esc_html_e('Weitere Modelle', 'bsn-racing'); ?></p>
            <h2><?php esc_html_e('Weitere Fahrzeuge aus dem Sortiment.', 'bsn-racing'); ?></h2>
          </div>

          <div class="inventory-grid">
            <?php while ($related_models->have_posts()) : $related_models->the_post(); ?>
              <?php $related_price = function_exists('get_field') ? (string) get_field('price') : ''; ?>
              <article <?php post_class('inventory-card'); ?>>
                <a class="inventory-card__media" href="<?php the_permalink(); ?>">
                  <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('large'); ?>
                  <?php else : ?>
                    <span class="inventory-card__placeholder">Off Road Shop Metzler</span>
                  <?php endif; ?>
                </a>
                <div class="inventory-card__body">
                  <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                  <?php if ($related_price) : ?>
                    <p class="inventory-card__price"><?php echo esc_html($related_price); ?></p>
                  <?php endif; ?>
                  <a class="text-link" href="<?php the_permalink(); ?>"><?php esc_html_e('Mehr erfahren', 'bsn-racing'); ?></a>
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
