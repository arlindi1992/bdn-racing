<?php get_header(); ?>

<main class="site-main">
  <?php while (have_posts()) : the_post(); ?>
    <?php
    $page_intro = has_excerpt() ? get_the_excerpt() : '';
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
          <div class="page-content">
            <?php the_content(); ?>
          </div>
        </article>
      </div>
    </section>

    <section class="page-cta-section">
      <div class="bsn-container">
        <div class="page-cta-card">
          <div>
            <p class="section-kicker"><?php esc_html_e('Kontakt & Beratung', 'bsn-racing'); ?></p>
            <h2><?php esc_html_e('Fragen zum Angebot oder Interesse an einer Probefahrt?', 'bsn-racing'); ?></h2>
            <p><?php esc_html_e('Wir helfen dir bei Modellen, Verfuegbarkeit, Service und dem naechsten Schritt zur Anfrage.', 'bsn-racing'); ?></p>
          </div>

          <div class="page-cta-card__actions">
            <a class="button button--primary" href="<?php echo esc_url(home_url('/kontakt/')); ?>"><?php esc_html_e('Kontakt', 'bsn-racing'); ?></a>
            <a class="button button--secondary" href="<?php echo esc_url(home_url('/probefahrt/')); ?>"><?php esc_html_e('Probefahrt', 'bsn-racing'); ?></a>
          </div>
        </div>
      </div>
    </section>
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
