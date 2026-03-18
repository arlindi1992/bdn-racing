<?php get_header(); ?>

<main class="site-main">
  <div class="bsn-container">
    <h1><?php the_archive_title(); ?></h1>
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
          <h2>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h2>
        </article>
      <?php endwhile; ?>
    <?php else : ?>
      <p><?php esc_html_e('No posts found.', 'bsn-racing'); ?></p>
    <?php endif; ?>
  </div>
</main>

<?php get_footer(); ?>
