<?php get_header(); ?>

<main class="site-main">
  <?php while (have_posts()) : the_post(); ?>
    <?php
    $page_intro = has_excerpt() ? get_the_excerpt() : '';
    $page_content_class = 'page-content page-content--contact';
    $has_main_content = trim((string) get_the_content()) !== '';
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
            <?php if ($has_main_content) : ?>
              <?php the_content(); ?>
            <?php else : ?>
              <p><?php esc_html_e('Nutzen Sie diese Seite fuer einen kurzen Hinweistext und fuegen Sie darunter das Probefahrt-Formular per Contact Form 7 Shortcode ein.', 'bsn-racing'); ?></p>
            <?php endif; ?>

            <section class="contact-page__supplement" aria-labelledby="probefahrt-details-title">
              <div class="contact-page__intro">
                <p class="section-kicker"><?php esc_html_e('Probefahrt Anfrage', 'bsn-racing'); ?></p>
                <h2 id="probefahrt-details-title"><?php esc_html_e('Modell anfragen, Terminwuensche senden, Rueckmeldung erhalten.', 'bsn-racing'); ?></h2>
                <p><?php esc_html_e('Teilen Sie uns mit, welches Modell Sie probefahren moechten und wann es fuer Sie passt. Wir melden uns zur Bestaetigung und stimmen Verfuegbarkeit sowie Termin direkt mit Ihnen ab.', 'bsn-racing'); ?></p>
              </div>

              <div class="contact-page__details-grid">
                <article class="contact-detail-card">
                  <p class="contact-detail-card__eyebrow"><?php esc_html_e('Was angeben?', 'bsn-racing'); ?></p>
                  <h3><?php esc_html_e('Wichtige Angaben', 'bsn-racing'); ?></h3>
                  <p><?php esc_html_e('Modell, Wunschdatum, Uhrzeit und Ihre Kontaktdaten helfen uns, die Anfrage schnell zu bestaetigen.', 'bsn-racing'); ?></p>
                </article>

                <article class="contact-detail-card">
                  <p class="contact-detail-card__eyebrow"><?php esc_html_e('Rueckmeldung', 'bsn-racing'); ?></p>
                  <h3><?php esc_html_e('So geht es weiter', 'bsn-racing'); ?></h3>
                  <p><?php esc_html_e('Nach Eingang der Anfrage pruefen wir die Verfuegbarkeit und melden uns telefonisch oder per E-Mail mit einem passenden Termin.', 'bsn-racing'); ?></p>
                </article>

                <article class="contact-detail-card">
                  <p class="contact-detail-card__eyebrow"><?php esc_html_e('Direktkontakt', 'bsn-racing'); ?></p>
                  <h3><?php esc_html_e('Lieber direkt sprechen?', 'bsn-racing'); ?></h3>
                  <p><a href="tel:+41527214708">+41 52 721 47 08</a><br><a href="mailto:info@offroadshop-metzler.com">info@offroadshop-metzler.com</a></p>
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
                    <p class="section-kicker"><?php esc_html_e('Standort', 'bsn-racing'); ?></p>
                    <h3><?php esc_html_e('Probefahrt vor Ort planen.', 'bsn-racing'); ?></h3>
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
