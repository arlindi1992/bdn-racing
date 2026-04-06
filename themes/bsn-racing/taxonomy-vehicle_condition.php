<?php get_header(); ?>

<?php
$current_term = get_queried_object();
$current_term_name = $current_term instanceof WP_Term ? $current_term->name : __('Motorrader', 'bsn-racing');
$current_term_description = $current_term instanceof WP_Term ? trim((string) $current_term->description) : '';
?>

<main class="site-main">
  <section class="inventory-hero">
    <div class="bsn-container">
      <p class="section-kicker">Motorrader</p>
      <h1><?php echo esc_html($current_term_name); ?></h1>
      <p class="inventory-hero__lead">
        <?php
        echo esc_html(
            $current_term_description !== ''
                ? $current_term_description
                : sprintf(__('Modelle im Bereich %s.', 'bsn-racing'), $current_term_name)
        );
        ?>
      </p>
    </div>
  </section>

  <section class="inventory-section">
    <div class="bsn-container">
      <?php if (have_posts()) : ?>
        <div class="inventory-grid">
          <?php while (have_posts()) : the_post(); ?>
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
                <?php if (has_excerpt()) : ?>
                  <p><?php echo esc_html(get_the_excerpt()); ?></p>
                <?php else : ?>
                  <p><?php echo esc_html(wp_trim_words(get_the_content(), 20)); ?></p>
                <?php endif; ?>
                <a class="text-link" href="<?php the_permalink(); ?>"><?php esc_html_e('Fahrzeug ansehen', 'bsn-racing'); ?></a>
              </div>
            </article>
          <?php endwhile; ?>
        </div>
      <?php else : ?>
        <p><?php esc_html_e('Noch keine Motorrader in diesem Bereich vorhanden.', 'bsn-racing'); ?></p>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>
