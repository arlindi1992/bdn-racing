<footer class="site-footer">
  <div class="bsn-container">
    <div class="site-footer__grid">
      <div>
        <p class="site-footer__eyebrow">BSN-RACING</p>
        <p>Am Espen 27<br>90559 Oberferrieden<br>Germany</p>
        <p>Tel.: +49 (0) 9183 9029 494<br>Mail: info@bsn-racing.de</p>
      </div>

      <div>
        <p class="site-footer__eyebrow">Oeffnungszeiten</p>
        <p>Mo-Fr<br>10:00 - 18:00</p>
        <p>Sa<br>10:00 - 13:00</p>
      </div>

      <div>
        <p class="site-footer__eyebrow">Quicklinks</p>
        <nav aria-label="<?php esc_attr_e('Footer navigation', 'bsn-racing'); ?>">
          <?php
          wp_nav_menu([
              'theme_location' => 'footer',
              'container' => false,
              'menu_class' => 'site-footer__menu',
              'fallback_cb' => static function (): void {
                  ?>
                  <ul class="site-footer__menu">
                    <li><a href="<?php echo esc_url(home_url('/motorraeder/')); ?>">KOVE Motorrader</a></li>
                    <li><a href="<?php echo esc_url(home_url('/touren/')); ?>">Touren & Events</a></li>
                    <li><a href="<?php echo esc_url(home_url('/service/')); ?>">Service</a></li>
                    <li><a href="<?php echo esc_url(home_url('/news/')); ?>">News</a></li>
                    <li><a href="<?php echo esc_url(home_url('/ueber-uns/')); ?>">Ueber Uns</a></li>
                    <li><a href="<?php echo esc_url(home_url('/kontakt/')); ?>">Kontakt</a></li>
                  </ul>
                  <?php
              },
          ]);
          ?>
        </nav>
      </div>
    </div>

    <div class="site-footer__bottom">
      <p>&copy; <?php echo esc_html(date_i18n('Y')); ?> bsn-racing.de</p>
      <div class="site-footer__legal">
        <a href="<?php echo esc_url(home_url('/datenschutz/')); ?>">Datenschutz</a>
        <a href="<?php echo esc_url(home_url('/impressum/')); ?>">Impressum</a>
      </div>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
