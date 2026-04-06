<?php get_header(); ?>

<main class="site-main news-page">
  <section class="news-page__hero">
    <div class="bsn-container">
      <p class="section-kicker">Aktuelles</p>
      <h1><?php echo esc_html(get_the_title((int) get_option('page_for_posts')) ?: __('News', 'bsn-racing')); ?></h1>
      <p class="news-page__intro"><?php esc_html_e('Neuigkeiten aus Werkstatt, Szene, Service und Saisonstart.', 'bsn-racing'); ?></p>
    </div>
  </section>

  <section class="news-page__content">
    <div class="bsn-container">
      <?php if (have_posts()) : ?>
        <div class="news-list">
          <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class('news-list__item'); ?>>
              <a class="news-list__media<?php echo has_post_thumbnail() ? '' : ' image-tile image-tile--news'; ?>" href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()) : ?>
                  <?php the_post_thumbnail('large'); ?>
                <?php endif; ?>
              </a>

              <div class="news-list__body">
                <p class="news-list__meta"><?php echo esc_html(get_the_date('d.m.Y')); ?></p>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p><?php echo esc_html(get_the_excerpt() ?: wp_trim_words(get_the_content(), 30)); ?></p>
                <a class="text-link" href="<?php the_permalink(); ?>"><?php esc_html_e('Beitrag lesen', 'bsn-racing'); ?></a>
              </div>
            </article>
          <?php endwhile; ?>
        </div>

        <div class="news-pagination">
          <?php the_posts_pagination(); ?>
        </div>
      <?php else : ?>
        <p><?php esc_html_e('No posts found.', 'bsn-racing'); ?></p>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>
