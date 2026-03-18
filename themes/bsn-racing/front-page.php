<?php get_header(); ?>

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

      <div class="product-grid product-grid--two">
        <article class="product-card">
          <div class="image-tile image-tile--bike-red"></div>
          <div class="product-card__body">
            <h3>450 Rally</h3>
            <p>Extrem leichte Rally-Maschine fuer Enduro, Roadbook und echte Fernreise-Abenteuer.</p>
            <a class="text-link text-link--accent" href="<?php echo esc_url(home_url('/kove/450-rally/')); ?>">Mehr erfahren</a>
          </div>
        </article>

        <article class="product-card">
          <div class="image-tile image-tile--bike-black"></div>
          <div class="product-card__body">
            <h3>800X Rally</h3>
            <p>Adventure Bike mit Offroad-Fokus, grossem Auftritt und Setup fuer lange Etappen.</p>
            <a class="text-link text-link--accent" href="<?php echo esc_url(home_url('/kove/800x-rally/')); ?>">Mehr erfahren</a>
          </div>
        </article>
      </div>
    </div>
  </section>

  <section class="catalog-section">
    <div class="bsn-container">
      <div class="section-heading section-heading--stacked">
        <p class="section-kicker">Weitere KOVE Bikes</p>
        <h2>Vom Touring bis zur sportlichen Reiseenduro.</h2>
      </div>

      <div class="product-grid">
        <article class="product-card product-card--light">
          <div class="image-tile image-tile--desert"></div>
          <div class="product-card__body">
            <h3>800X Pro</h3>
            <p>Die ausgewogene Variante zwischen Alltag, Schotter und Reisetauglichkeit.</p>
          </div>
        </article>

        <article class="product-card product-card--light">
          <div class="image-tile image-tile--green"></div>
          <div class="product-card__body">
            <h3>V 525 DSX</h3>
            <p>Zweizylinder mit sportlichem Charakter und auffaelligem Auftritt.</p>
          </div>
        </article>

        <article class="product-card product-card--light product-card--text">
          <div class="product-card__body">
            <p class="section-kicker">Community und Touren</p>
            <h3>Reisen, testen, Erfahrungen teilen</h3>
            <p>
              Neben den Bikes bleiben Probefahrten, News und gefuehrte Touren zentrale Elemente
              der Startseite. Genau das bildet auch der Screenshot sichtbar ab.
            </p>
            <a class="button button--primary" href="<?php echo esc_url(home_url('/touren/')); ?>">Touren ansehen</a>
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

      <div class="news-grid">
        <article class="news-card news-card--highlight">
          <div class="news-card__media news-card__media--stat">
            <span>300</span>
          </div>
          <div class="news-card__body">
            <p class="news-card__meta">Community</p>
            <h3>300-mal Danke</h3>
            <p>Ein aufmerksamkeitsstarker Statistik-Teaser wie im Screenshot funktioniert hier gut als erster News-Block.</p>
          </div>
        </article>

        <article class="news-card">
          <div class="news-card__media image-tile image-tile--news"></div>
          <div class="news-card__body">
            <p class="news-card__meta">Modelle 2026</p>
            <h3>Neue Bikes sind eingetroffen</h3>
            <p>Lieferung, Erstaufbau und Verfuegbarkeit werden auf der Startseite direkt sichtbar gemacht.</p>
          </div>
        </article>
      </div>
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
