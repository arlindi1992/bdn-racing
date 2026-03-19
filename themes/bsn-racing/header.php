<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
  <div class="bsn-container site-header__inner">
    <div class="site-branding">
      <a href="<?php echo esc_url(home_url('/')); ?>">
        <span class="site-branding__mark">BSN</span>
        <span class="site-branding__text">Racing</span>
      </a>
    </div>

    <nav class="site-navigation" aria-label="<?php esc_attr_e('Primary navigation', 'bsn-racing'); ?>">
      <?php
      wp_nav_menu([
          'theme_location' => 'primary',
          'container' => false,
          'menu_class' => 'site-navigation__menu',
          'fallback_cb' => static function (): void {
              ?>
              <ul class="site-navigation__menu">
                <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                <li><a href="<?php echo esc_url(home_url('/motorraeder/')); ?>">Motorraeder</a></li>
                <li><a href="<?php echo esc_url(home_url('/touren/')); ?>">Touren</a></li>
                <li><a href="<?php echo esc_url(home_url('/news/')); ?>">News</a></li>
                <li><a href="<?php echo esc_url(home_url('/kontakt/')); ?>">Kontakt</a></li>
              </ul>
              <?php
          },
      ]);
      ?>
    </nav>

    <a class="site-header__cta" href="<?php echo esc_url(home_url('/probefahrt/')); ?>">
      Probefahrt
    </a>
  </div>
</header>
