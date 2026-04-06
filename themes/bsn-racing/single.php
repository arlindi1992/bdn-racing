<?php get_header(); ?>

<main class="site-main news-single">
  <?php while (have_posts()) : the_post(); ?>
    <article <?php post_class('news-single__article'); ?>>
      <section class="news-single__hero">
        <div class="bsn-container">
          <div class="news-single__hero-inner">
            <p class="section-kicker">News</p>
            <p class="news-single__meta"><?php echo esc_html(get_the_date('d.m.Y')); ?></p>
            <h1><?php the_title(); ?></h1>
            <?php if (has_excerpt()) : ?>
              <p class="news-single__lead"><?php echo esc_html(get_the_excerpt()); ?></p>
            <?php endif; ?>
          </div>
        </div>
      </section>

      <section class="news-single__content-wrap">
        <div class="bsn-container">
          <div class="news-single__content-card">
            <?php if (has_post_thumbnail()) : ?>
              <div class="news-single__media">
                <?php the_post_thumbnail('full'); ?>
              </div>
            <?php endif; ?>

            <div class="news-single__content">
              <?php the_content(); ?>
            </div>

            <div class="news-single__actions">
              <a class="button button--secondary" href="<?php echo esc_url(get_permalink((int) get_option('page_for_posts')) ?: home_url('/news/')); ?>">
                <?php esc_html_e('Zurueck zu News', 'bsn-racing'); ?>
              </a>
            </div>
          </div>
        </div>
      </section>
    </article>
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
