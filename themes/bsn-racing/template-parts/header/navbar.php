<nav class="site-navigation" aria-label="<?php esc_attr_e('Primary navigation', 'bsn-racing'); ?>">
  <?php
  wp_nav_menu([
      'theme_location' => 'primary',
      'container' => false,
      'menu_id' => 'site-navigation-menu',
      'menu_class' => 'site-navigation__menu',
      'fallback_cb' => static function (): void {
          ?>
          <ul id="site-navigation-menu" class="site-navigation__menu">
            <li class="menu-item">
              <a href="<?php echo esc_url(home_url('/news/')); ?>">News</a>
            </li>
            <li class="menu-item menu-item-has-children">
              <a href="<?php echo esc_url(home_url('/offroad-shop-metzler/')); ?>">Off Road Shop Metzler</a>
              <ul class="sub-menu">
                <li><a href="<?php echo esc_url(home_url('/serviceanfrage/')); ?>">Serviceanfrage</a></li>
                <li><a href="<?php echo esc_url(home_url('/fotos/')); ?>">Fotos</a></li>
              </ul>
            </li>
            <li class="menu-item menu-item-has-children">
              <a href="<?php echo esc_url(home_url('/motorraeder/')); ?>">Motorraeder</a>
              <ul class="sub-menu">
                <li><a href="<?php echo esc_url(home_url('/motorraeder/neu/')); ?>">Neu</a></li>
                <li><a href="<?php echo esc_url(home_url('/motorraeder/occasion/')); ?>">Occasion</a></li>
              </ul>
            </li>
            <li class="menu-item menu-item-has-children">
              <a href="<?php echo esc_url(home_url('/kontakt/')); ?>">Kontakt</a>
              <ul class="sub-menu">
                <li><a href="<?php echo esc_url(home_url('/datenschutz/')); ?>">Datenschutz</a></li>
                <li><a href="<?php echo esc_url(home_url('/impressum/')); ?>">Impressum</a></li>
              </ul>
            </li>
            <li class="menu-item menu-item-has-children">
              <a href="<?php echo esc_url(home_url('/shop/')); ?>">Shop</a>
              <ul class="sub-menu">
                <li><a href="<?php echo esc_url(home_url('/shop/fahrzeuge/')); ?>">Fahrzeuge</a></li>
                <li><a href="<?php echo esc_url(home_url('/shop/teile/')); ?>">Teile</a></li>
                <li><a href="https://www.motoscout24.ch" target="_blank" rel="noreferrer noopener">Motoscout24.ch Fahrzeuge</a></li>
                <li><a href="https://www.tutti.ch" target="_blank" rel="noreferrer noopener">Tutti.ch Teile</a></li>
              </ul>
            </li>
          </ul>
          <?php
      },
  ]);
  ?>
</nav>
