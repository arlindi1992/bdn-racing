<?php
get_header();

$featured_models = new WP_Query([
    'post_type' => 'motorraeder',
    'posts_per_page' => 2,
]);

$secondary_models = new WP_Query([
    'post_type' => 'motorraeder',
    'posts_per_page' => 3,
    'offset' => 2,
]);

$latest_news = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 2,
]);
?>

<main class="site-main">
  <section class="hero-section">
    <div class="bsn-container hero-section__inner">
      <div class="hero-section__copy">
        <p class="section-kicker section-kicker--light">Welcome to</p>
        <h1>BSN RACING GERMANY</h1>
        <p class="hero-section__subtitle">Deine Adresse fuer KOVE Motorrader in Bayern.</p>
      </div>
      <a class="hero-section__badge" href="<?php echo esc_url(home_url('/probefahrt/')); ?>">ZU KOVE</a>
    </div>
  </section>

  <section class="intro-section">
    <div class="bsn-container intro-section__grid">
      <article class="intro-card">
        <h2>Ihr KOVE Haendler in Bayern</h2>
        <p>
          Von Burgthann aus betreuen wir Adventure- und Rally-Fahrer mit Verkauf, Werkstatt,
          Beratung und Probefahrt. Die Struktur orientiert sich am gelieferten Screenshot:
          klarer Hero, Info-Box, Model-Sektion, News und Footer mit Akzentflaechen.
        </p>
        <a class="text-link" href="<?php echo esc_url(home_url('/ueber-uns/')); ?>">Mehr ueber uns</a>
      </article>

      <div class="intro-media">
        <div class="image-tile image-tile--workshop"></div>
      </div>
    </div>
  </section>

  <section class="catalog-section catalog-section--dark">
    <div class="bsn-container">
      <div class="section-heading section-heading--stacked">
        <p class="section-kicker">Entdecke unsere KOVE Modelle</p>
        <h2>Adventure Spirit mit Rally-DNA.</h2>
      </div>

      <?php if ($featured_models->have_posts()) : ?>
        <div class="product-grid product-grid--two">
          <?php while ($featured_models->have_posts()) : $featured_models->the_post(); ?>
            <?php
            $price = function_exists('get_field') ? (string) get_field('price') : '';
            $subtitle = function_exists('get_field') ? (string) get_field('subtitle') : '';
            ?>
            <article <?php post_class('product-card'); ?>>
              <a class="product-card__media" href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()) : ?>
                  <?php the_post_thumbnail('large'); ?>
                <?php else : ?>
                  <div class="image-tile image-tile--bike-red"></div>
                <?php endif; ?>
              </a>
              <div class="product-card__body">
                <h3><?php the_title(); ?></h3>
                <p><?php echo esc_html($subtitle ?: get_the_excerpt() ?: wp_trim_words(get_the_content(), 20)); ?></p>
                <?php if ($price) : ?>
                  <p class="product-card__price"><?php echo esc_html($price); ?></p>
                <?php endif; ?>
                <a class="text-link text-link--accent" href="<?php the_permalink(); ?>">Mehr erfahren</a>
              </div>
            </article>
          <?php endwhile; ?>
        </div>
        <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <div class="product-grid product-grid--two">
          <article class="product-card">
            <div class="image-tile image-tile--bike-red"></div>
            <div class="product-card__body">
              <h3>450 Rally</h3>
              <p>Lege jetzt die ersten Motorrader im Admin an, damit die Startseite automatisch befuellt wird.</p>
              <a class="text-link text-link--accent" href="<?php echo esc_url(get_post_type_archive_link('motorraeder')); ?>">Alle Modelle</a>
            </div>
          </article>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <section class="catalog-section">
    <div class="bsn-container">
      <div class="section-heading section-heading--stacked">
        <p class="section-kicker">Weitere KOVE Bikes</p>
        <h2>Vom Touring bis zur sportlichen Reiseenduro.</h2>
      </div>

      <div class="product-grid">
        <?php if ($secondary_models->have_posts()) : ?>
          <?php while ($secondary_models->have_posts()) : $secondary_models->the_post(); ?>
            <?php $subtitle = function_exists('get_field') ? (string) get_field('subtitle') : ''; ?>
            <article <?php post_class('product-card product-card--light'); ?>>
              <a class="product-card__media" href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()) : ?>
                  <?php the_post_thumbnail('large'); ?>
                <?php else : ?>
                  <div class="image-tile image-tile--desert"></div>
                <?php endif; ?>
              </a>
              <div class="product-card__body">
                <h3><?php the_title(); ?></h3>
                <p><?php echo esc_html($subtitle ?: get_the_excerpt() ?: wp_trim_words(get_the_content(), 18)); ?></p>
                <a class="text-link" href="<?php the_permalink(); ?>">Details ansehen</a>
              </div>
            </article>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        <?php endif; ?>

        <article class="product-card product-card--light product-card--text">
          <div class="product-card__body">
            <p class="section-kicker">Community und Touren</p>
            <h3>Reisen, testen, Erfahrungen teilen</h3>
            <p>
              Neben den Bikes bleiben Probefahrten, News und gefuehrte Touren zentrale Elemente
              der Startseite. Genau das bildet auch der Screenshot sichtbar ab.
            </p>
            <a class="button button--primary" href="<?php echo esc_url(get_post_type_archive_link('motorraeder')); ?>">Alle Modelle</a>
          </div>
        </article>
      </div>
    </div>
  </section>

  <section class="news-section">
    <div class="bsn-container">
      <div class="section-heading section-heading--stacked">
        <p class="section-kicker">Aktuelles</p>
        <h2>News aus Werkstatt, Szene und Saisonstart.</h2>
      </div>

      <?php if ($latest_news->have_posts()) : ?>
        <div class="news-grid">
          <?php $news_index = 0; ?>
          <?php while ($latest_news->have_posts()) : $latest_news->the_post(); ?>
            <article <?php post_class('news-card' . (0 === $news_index ? ' news-card--highlight' : '')); ?>>
              <a class="news-card__media<?php echo has_post_thumbnail() ? '' : ' image-tile image-tile--news'; ?>" href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()) : ?>
                  <?php the_post_thumbnail('large'); ?>
                <?php elseif (0 === $news_index) : ?>
                  <span class="news-card__media news-card__media--stat"><span><?php echo esc_html(get_the_date('d')); ?></span></span>
                <?php endif; ?>
              </a>
              <div class="news-card__body">
                <p class="news-card__meta"><?php echo esc_html(get_the_date('d.m.Y')); ?></p>
                <h3><?php the_title(); ?></h3>
                <p><?php echo esc_html(get_the_excerpt() ?: wp_trim_words(get_the_content(), 24)); ?></p>
                <a class="text-link" href="<?php the_permalink(); ?>">Beitrag lesen</a>
              </div>
            </article>
            <?php $news_index++; ?>
          <?php endwhile; ?>
        </div>
        <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <div class="news-grid">
          <article class="news-card news-card--highlight">
            <div class="news-card__media news-card__media--stat">
              <span>BSN</span>
            </div>
            <div class="news-card__body">
              <p class="news-card__meta">Aktuelles</p>
              <h3>News-Bereich ist vorbereitet</h3>
              <p>Lege im WordPress-Admin die ersten Beitraege an, dann erscheint dieser Bereich automatisch mit echten Inhalten.</p>
            </div>
          </article>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <section class="features-section">
    <div class="bsn-container">
      <div class="section-heading section-heading--stacked">
        <p class="section-kicker">Fuer uns auf Mission</p>
        <h2>Beratung, Service und Probefahrt aus einer Hand.</h2>
      </div>

      <div class="features-grid">
        <article class="feature-card">
          <div class="feature-card__icon">Zu</div>
          <h3>Fahrzeuge & Beratung</h3>
        </article>
        <article class="feature-card">
          <div class="feature-card__icon">Me</div>
          <h3>Werkstatt & Service</h3>
        </article>
        <article class="feature-card">
          <div class="feature-card__icon">Ho</div>
          <h3>Touren & Probefahrt</h3>
        </article>
      </div>
    </div>
  </section>

  <section class="banner-section">
    <div class="banner-section__image">
      <div class="bsn-container banner-section__content">
        <p class="section-kicker section-kicker--light">Adventure starts here</p>
        <h2>Ride into the horizon.</h2>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
