<?php $bsn_footer_brand_links = function_exists('bsn_racing_get_navbar_brands') ? bsn_racing_get_navbar_brands() : []; ?>

<footer class="site-footer">
  <div class="bsn-container">
    <div class="site-footer__grid">
      <div>
        <p class="site-footer__eyebrow">Wann wir fuer Sie da sind</p>
        <p>Sonntag - Montag:</p>
        <p>Dienstag - Freitag:</p>
        <p>Samstag:</p>
        <p>Geschlossen<br>9:00-12:00 13:30-18:30<br>Nach Vereinbarung</p>
      </div>

      <div>
        <p class="site-footer__eyebrow">Unsere Adresse</p>
        <p>Off Road Shop Metzler GmbH<br>Zuercherstrasse 330<br>8500 Frauenfeld<br>CH Schweiz</p>
        <p class="site-footer__eyebrow">Wie Sie uns erreichen</p>
        <p>Telefon: +41 52 721 47 08<br>E-Mail: info@offroadshop-metzler.com</p>
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
      <?php if (!empty($bsn_footer_brand_links)) : ?>
        <div class="site-footer__brands" aria-label="<?php esc_attr_e('Partner brands', 'bsn-racing'); ?>">
          <?php foreach ($bsn_footer_brand_links as $brand) : ?>
            <a class="site-footer__brand" href="<?php echo esc_url($brand['url']); ?>" target="_blank" rel="noreferrer noopener">
              <img
                src="<?php echo esc_url($brand['image_url']); ?>"
                alt="<?php echo esc_attr($brand['label']); ?>"
                loading="lazy"
              >
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <div class="site-footer__bottom-right">
        <div class="site-footer__legal">
          <a href="<?php echo esc_url(home_url('/datenschutz/')); ?>">Datenschutz</a>
          <a href="<?php echo esc_url(home_url('/impressum/')); ?>">Impressum</a>
        </div>
        
      </div>
      <div class="site-footer__copyright">
        <p>&copy; <?php echo esc_html(date_i18n('Y')); ?> offroadshop-metzler.com</p>
      </div>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
