<?php

$hero_slides = $args['hero_slides'] ?? [];
?>
<section class="hero-section">
  <?php if (!empty($hero_slides)) : ?>
    <?php
    $initial_slide = $hero_slides[0];
    $initial_slide_title = !empty($initial_slide['title']) ? (string) $initial_slide['title'] : 'Off Road Shop Metzler';
    $initial_slide_subtitle = !empty($initial_slide['subtitle']) ? (string) $initial_slide['subtitle'] : 'Deine Adresse fuer KOVE Motorrader in Bayern.';
    ?>
    <div class="hero-section__media" data-hero-carousel>
      <div class="hero-section__slides">
        <?php foreach ($hero_slides as $index => $slide) : ?>
          <?php
          $slide_image = $slide['image'] ?? [];
          $slide_image_url = (string) ($slide['image_url'] ?? '');
          $slide_title = !empty($slide['title']) ? (string) $slide['title'] : 'Off Road Shop Metzler';
          $slide_subtitle = !empty($slide['subtitle']) ? (string) $slide['subtitle'] : 'Deine Adresse fuer KOVE Motorrader in Bayern.';
          $slide_alt = is_array($slide_image) && !empty($slide_image['alt']) ? (string) $slide_image['alt'] : $slide_title;
          ?>
          <div
            class="hero-section__slide<?php echo 0 === $index ? ' is-active' : ''; ?>"
            data-hero-title="<?php echo esc_attr($slide_title); ?>"
            data-hero-subtitle="<?php echo esc_attr($slide_subtitle); ?>"
            style="background-image: url('<?php echo esc_url($slide_image_url); ?>');"
          >
            <img
              src="<?php echo esc_url($slide_image_url); ?>"
              alt="<?php echo esc_attr($slide_alt); ?>"
              <?php echo 0 === $index ? 'fetchpriority="high"' : 'loading="lazy"'; ?>
            >
          </div>
        <?php endforeach; ?>
      </div>

      <div class="bsn-container hero-section__inner">
        <div class="hero-section__copy">
          <h1 data-hero-heading><?php echo esc_html($initial_slide_title); ?></h1>
          <p class="hero-section__subtitle" data-hero-subtitle><?php echo wp_kses_post($initial_slide_subtitle); ?></p>
        </div>
      </div>

      <?php if (count($hero_slides) > 1) : ?>
        <div class="hero-section__pagination">
          <?php foreach ($hero_slides as $index => $slide) : ?>
            <button
              class="hero-section__dot<?php echo 0 === $index ? ' is-active' : ''; ?>"
              type="button"
              data-hero-dot="<?php echo esc_attr((string) $index); ?>"
              aria-label="<?php echo esc_attr(sprintf(__('Go to hero image %d', 'bsn-racing'), $index + 1)); ?>"
            ></button>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  <?php else : ?>
    <div class="bsn-container hero-section__inner">
      <div class="hero-section__copy">
        <h1>ADD TITLE</h1>
        <p class="hero-section__subtitle">Add subtitle.</p>
      </div>
    </div>
  <?php endif; ?>
</section>
