<?php $bsn_brand_links = function_exists('bsn_racing_get_navbar_brands') ? bsn_racing_get_navbar_brands() : []; ?>

<?php if (!empty($bsn_brand_links)) : ?>
  <div class="brands-strip" aria-label="<?php esc_attr_e('Motorcycle brands', 'bsn-racing'); ?>">
    <div class="brands-strip__track">
      <div class="brands-strip__group">
        <?php for ($i = 0; $i < 2; $i++) : ?>
          <?php foreach ($bsn_brand_links as $brand) : ?>
            <a class="brands-strip__item" href="<?php echo esc_url($brand['url']); ?>" target="_blank" rel="noreferrer noopener">
              <img
                src="<?php echo esc_url($brand['image_url']); ?>"
                alt="<?php echo esc_attr($brand['label']); ?>"
                loading="lazy"
              >
            </a>
          <?php endforeach; ?>
        <?php endfor; ?>
      </div>

      <div class="brands-strip__group" aria-hidden="true">
        <?php for ($i = 0; $i < 2; $i++) : ?>
          <?php foreach ($bsn_brand_links as $brand) : ?>
            <a class="brands-strip__item" href="<?php echo esc_url($brand['url']); ?>" target="_blank" rel="noreferrer noopener" tabindex="-1">
              <img
                src="<?php echo esc_url($brand['image_url']); ?>"
                alt=""
                loading="lazy"
              >
            </a>
          <?php endforeach; ?>
        <?php endfor; ?>
      </div>
    </div>
  </div>
<?php endif; ?>
