<?php
$bsn_footer_brand_links = function_exists('bsn_racing_get_navbar_brands') ? bsn_racing_get_navbar_brands() : [];
$bsn_umami_src = defined('BSN_UMAMI_SCRIPT_URL') ? (string) BSN_UMAMI_SCRIPT_URL : '';
$bsn_umami_website_id = defined('BSN_UMAMI_WEBSITE_ID') ? (string) BSN_UMAMI_WEBSITE_ID : '';
?>

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
          <a href="#" data-cookie-consent-open><?php esc_html_e('Cookie-Einstellungen', 'bsn-racing'); ?></a>
          <a href="<?php echo esc_url(home_url('/impressum/')); ?>">Impressum</a>
        </div>
        
      </div>
      <div class="site-footer__copyright">
        <p>&copy; <?php echo esc_html(date_i18n('Y')); ?> offroadshop-metzler.com</p>
      </div>
    </div>
  </div>
</footer>
<div
  class="cookie-consent"
  data-cookie-consent
  data-umami-src="<?php echo esc_attr($bsn_umami_src); ?>"
  data-umami-website-id="<?php echo esc_attr($bsn_umami_website_id); ?>"
  hidden
>
  <div class="cookie-consent__inner">
    <div class="cookie-consent__copy">
      <p class="cookie-consent__eyebrow"><?php esc_html_e('Datenschutz', 'bsn-racing'); ?></p>
      <h2><?php esc_html_e('Externe Inhalte und Statistik erst nach Ihrer Zustimmung.', 'bsn-racing'); ?></h2>
      <p><?php esc_html_e('Wir verwenden Umami fuer datenschutzfreundliche Besuchsstatistiken und Google Maps fuer die Standortanzeige. Beide Dienste werden erst nach Ihrer Einwilligung geladen.', 'bsn-racing'); ?></p>
      <p><a href="<?php echo esc_url(home_url('/datenschutz/')); ?>"><?php esc_html_e('Datenschutzerklaerung ansehen', 'bsn-racing'); ?></a></p>
    </div>

    <div class="cookie-consent__actions">
      <button class="button button--primary" type="button" data-cookie-consent-accept><?php esc_html_e('Akzeptieren', 'bsn-racing'); ?></button>
      <button class="button button--secondary" type="button" data-cookie-consent-reject><?php esc_html_e('Ablehnen', 'bsn-racing'); ?></button>
    </div>
  </div>
</div>
<div class="lightbox" data-lightbox hidden>
  <div class="lightbox__backdrop" data-lightbox-backdrop></div>
  <div class="lightbox__dialog" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e('Image viewer', 'bsn-racing'); ?>">
    <button class="lightbox__close" type="button" data-lightbox-close aria-label="<?php esc_attr_e('Close image viewer', 'bsn-racing'); ?>">×</button>
    <button class="lightbox__nav lightbox__nav--prev" type="button" data-lightbox-prev aria-label="<?php esc_attr_e('Previous image', 'bsn-racing'); ?>">‹</button>
    <figure class="lightbox__figure">
      <img src="" alt="" data-lightbox-image>
    </figure>
    <button class="lightbox__nav lightbox__nav--next" type="button" data-lightbox-next aria-label="<?php esc_attr_e('Next image', 'bsn-racing'); ?>">›</button>
  </div>
</div>
<?php wp_footer(); ?>
</body>
</html>
