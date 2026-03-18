<?php get_header(); ?>

<main class="site-main">
  <div class="bsn-container">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
          <h1><?php the_title(); ?></h1>
          <div>
            <?php the_content(); ?>
          </div>
        </article>
      <?php endwhile; ?>
    <?php else : ?>
      <p><?php esc_html_e('No content found.', 'bsn-racing'); ?></p>
    <?php endif; ?>
  </div>
</main>

<?php get_footer(); ?>
