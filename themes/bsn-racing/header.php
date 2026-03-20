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
    <div class="site-header__top">
      <div class="site-branding">
        <a href="<?php echo esc_url(home_url('/')); ?>">
          <img
            class="site-branding__logo"
            src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/navbar/bsn-racing-logo.png'); ?>"
            alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
          >
          <span class="screen-reader-text"><?php bloginfo('name'); ?></span>
        </a>
      </div>

      <button
        class="site-navigation__menu-toggle"
        type="button"
        aria-expanded="false"
        aria-controls="site-navigation-menu"
        aria-label="<?php esc_attr_e('Open menu', 'bsn-racing'); ?>"
      >
        <span class="site-navigation__menu-toggle-line"></span>
        <span class="site-navigation__menu-toggle-line"></span>
        <span class="site-navigation__menu-toggle-line"></span>
      </button>
    </div>

    <?php get_template_part('template-parts/header/navbar'); ?>
    <?php get_template_part('template-parts/header/brands-strip'); ?>
  </div>
</header>
