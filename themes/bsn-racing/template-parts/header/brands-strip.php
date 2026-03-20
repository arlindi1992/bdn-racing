<?php $bsn_brand_links = function_exists('bsn_racing_get_navbar_brands') ? bsn_racing_get_navbar_brands() : []; ?>

<?php if (!empty($bsn_brand_links)) : ?>
  <div class="brands-strip" aria-label="<?php esc_attr_e('Motorcycle brands', 'bsn-racing'); ?>">
    <div class="brands-strip__track">
      <?php foreach ($bsn_brand_links as $brand) : ?>
        <a class="brands-strip__item" href="<?php echo esc_url($brand['url']); ?>" target="_blank" rel="noreferrer noopener">
          <img
            src="<?php echo esc_url($brand['image_url']); ?>"
            alt="<?php echo esc_attr($brand['label']); ?>"
            loading="lazy"
          >
        </a>
      <?php endforeach; ?>

      <?php foreach ($bsn_brand_links as $brand) : ?>
        <a class="brands-strip__item" href="<?php echo esc_url($brand['url']); ?>" target="_blank" rel="noreferrer noopener" aria-hidden="true" tabindex="-1">
          <img
            src="<?php echo esc_url($brand['image_url']); ?>"
            alt=""
            loading="lazy"
          >
        </a>
      <?php endforeach; ?>
    </div>
  </div>
<?php endif; ?>
