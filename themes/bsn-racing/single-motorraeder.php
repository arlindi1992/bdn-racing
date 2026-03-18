<?php get_header(); ?>

<main class="site-main">
  <?php while (have_posts()) : the_post(); ?>
    <?php
    $conditions = get_the_terms(get_the_ID(), 'vehicle_condition');
    $condition_label = (!empty($conditions) && !is_wp_error($conditions)) ? $conditions[0]->name : __('Motorrad', 'bsn-racing');
    ?>
    <section class="vehicle-hero">
      <div class="bsn-container vehicle-hero__grid">
        <div class="vehicle-hero__content">
          <p class="section-kicker"><?php echo esc_html($condition_label); ?></p>
          <h1><?php the_title(); ?></h1>
          <?php if (has_excerpt()) : ?>
            <p class="vehicle-hero__lead"><?php echo esc_html(get_the_excerpt()); ?></p>
          <?php endif; ?>
          <div class="vehicle-hero__actions">
            <a class="button button--primary" href="<?php echo esc_url(home_url('/kontakt/')); ?>"><?php esc_html_e('Anfrage senden', 'bsn-racing'); ?></a>
            <a class="button button--secondary" href="<?php echo esc_url(home_url('/probefahrt/')); ?>"><?php esc_html_e('Probefahrt buchen', 'bsn-racing'); ?></a>
          </div>
        </div>

        <div class="vehicle-hero__media">
          <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('large'); ?>
          <?php else : ?>
            <div class="vehicle-hero__placeholder">BSN Racing</div>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <section class="vehicle-content">
      <div class="bsn-container vehicle-content__grid">
        <article class="vehicle-content__main">
          <h2><?php esc_html_e('Beschreibung', 'bsn-racing'); ?></h2>
          <?php the_content(); ?>
        </article>

        <aside class="vehicle-specs">
          <h2><?php esc_html_e('Auf einen Blick', 'bsn-racing'); ?></h2>
          <ul class="vehicle-specs__list">
            <li><?php esc_html_e('Preis, Leistung, Gewicht und weitere Daten werden im naechsten Schritt ueber ACF angebunden.', 'bsn-racing'); ?></li>
            <li><?php esc_html_e('Neu / Occasion kommt aus der Taxonomy vehicle_condition.', 'bsn-racing'); ?></li>
            <li><?php esc_html_e('Galerie und CTA-Felder koennen spaeter hier ergaenzt werden.', 'bsn-racing'); ?></li>
          </ul>
        </aside>
      </div>
    </section>
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
