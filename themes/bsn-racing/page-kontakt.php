<?php get_header(); ?>

<main class="site-main">
  <?php while (have_posts()) : the_post(); ?>
    <?php
    $page_intro = has_excerpt() ? get_the_excerpt() : '';
    $page_content_class = 'page-content page-content--contact';
    ?>

    <section class="page-hero">
      <div class="page-hero__media">
        <?php if (has_post_thumbnail()) : ?>
          <?php the_post_thumbnail('full'); ?>
        <?php else : ?>
          <div class="page-hero__fallback"></div>
        <?php endif; ?>

        <div class="page-hero__overlay">
          <div class="bsn-container page-hero__inner">
            <div class="page-hero__content">
              <p class="section-kicker section-kicker--light"><?php esc_html_e('Off Road Shop Metzler', 'bsn-racing'); ?></p>
              <h1><?php the_title(); ?></h1>

              <?php if ($page_intro) : ?>
                <p class="page-hero__lead"><?php echo esc_html($page_intro); ?></p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="page-content-section">
      <div class="bsn-container">
        <div class="page-breadcrumbs">
          <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Startseite', 'bsn-racing'); ?></a>
          <span>/</span>
          <span><?php the_title(); ?></span>
        </div>

        <article <?php post_class('page-content-card'); ?>>
          <div class="<?php echo esc_attr($page_content_class); ?>">
            <?php the_content(); ?>

            <section class="contact-page__supplement" aria-labelledby="contact-page-details-title">
              <div class="contact-page__intro">
                <p class="section-kicker"><?php esc_html_e('Direkter Kontakt', 'bsn-racing'); ?></p>
                <h2 id="contact-page-details-title"><?php esc_html_e('Persoenlich erreichbar, schnell vor Ort, klar im Austausch.', 'bsn-racing'); ?></h2>
                <p><?php esc_html_e('Nutzen Sie das Formular oder kontaktieren Sie uns direkt per Telefon oder E-Mail. Vor Ort beraten wir Sie zu Modellen, Verfuegbarkeit, Service und dem naechsten Schritt.', 'bsn-racing'); ?></p>
              </div>

              <div class="contact-page__details-grid">
                <article class="contact-detail-card">
                  <p class="contact-detail-card__eyebrow"><?php esc_html_e('Adresse', 'bsn-racing'); ?></p>
                  <h3><?php esc_html_e('Off Road Shop Metzler GmbH', 'bsn-racing'); ?></h3>
                  <p>Zuercherstrasse 330<br>8500 Frauenfeld<br>CH Schweiz</p>
                </article>

                <article class="contact-detail-card">
                  <p class="contact-detail-card__eyebrow"><?php esc_html_e('Kontakt', 'bsn-racing'); ?></p>
                  <h3><?php esc_html_e('Schnell erreichbar', 'bsn-racing'); ?></h3>
                  <p><a href="tel:+41527214708">+41 52 721 47 08</a><br><a href="mailto:info@offroadshop-metzler.com">info@offroadshop-metzler.com</a></p>
                </article>

                <article class="contact-detail-card">
                  <p class="contact-detail-card__eyebrow"><?php esc_html_e('Oeffnungszeiten', 'bsn-racing'); ?></p>
                  <h3><?php esc_html_e('Wann wir fuer Sie da sind', 'bsn-racing'); ?></h3>
                  <p>Sonntag - Montag: <?php esc_html_e('Geschlossen', 'bsn-racing'); ?><br>Dienstag - Freitag: 9:00-12:00 / 13:30-18:30<br>Samstag: <?php esc_html_e('Nach Vereinbarung', 'bsn-racing'); ?></p>
                </article>
              </div>

              <div class="contact-page__map-wrap">
                <div
                  class="contact-page__map-consent"
                  data-consent-map
                  data-map-src="https://www.google.com/maps?q=Zuercherstrasse%20330%2C%208500%20Frauenfeld%2C%20Schweiz&output=embed"
                  data-map-title="<?php echo esc_attr__('Standort von Off Road Shop Metzler', 'bsn-racing'); ?>"
                >
                  <div class="contact-page__map-placeholder">
                    <p class="section-kicker"><?php esc_html_e('Google Maps', 'bsn-racing'); ?></p>
                    <h3><?php esc_html_e('Karte erst nach Zustimmung laden.', 'bsn-racing'); ?></h3>
                    <p><?php esc_html_e('Mit dem Laden der Karte stimmen Sie der Datenuebermittlung an Google zu. Die Karte wird erst nach Ihrer Einwilligung aktiviert.', 'bsn-racing'); ?></p>
                    <button class="button button--primary" type="button" data-consent-map-accept><?php esc_html_e('Karte laden', 'bsn-racing'); ?></button>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </article>
      </div>
    </section>
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
