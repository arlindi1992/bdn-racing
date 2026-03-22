'use strict';

document.addEventListener('DOMContentLoaded', () => {
  const carousel = document.querySelector('[data-hero-carousel]');
  const time = 2000;

  if (!carousel) {
    return;
  }

  const slides = Array.from(carousel.querySelectorAll('.hero-section__slide'));
  const dots = Array.from(carousel.querySelectorAll('[data-hero-dot]'));
  // const prevButton = carousel.querySelector('[data-hero-prev]');
  // const nextButton = carousel.querySelector('[data-hero-next]');
  const heading = carousel.querySelector('[data-hero-heading]');
  const subtitle = carousel.querySelector('[data-hero-subtitle]');

  if (slides.length <= 1) {
    return;
  }

  let activeIndex = 0;
  let autoplayId;

  const renderSlide = (index) => {
    slides.forEach((slide, slideIndex) => {
      slide.classList.toggle('is-active', slideIndex === index);
    });

    dots.forEach((dot, dotIndex) => {
      dot.classList.toggle('is-active', dotIndex === index);
    });

    const activeSlide = slides[index];

    if (heading && activeSlide?.dataset.heroTitle) {
      heading.textContent = activeSlide.dataset.heroTitle;
    }

    if (subtitle && activeSlide?.dataset.heroSubtitle) {
      subtitle.textContent = activeSlide.dataset.heroSubtitle;
    }

    activeIndex = index;
  };

  const startAutoplay = () => {
    window.clearInterval(autoplayId);
    autoplayId = window.setInterval(() => {
      const nextIndex = activeIndex === slides.length - 1 ? 0 : activeIndex + 1;
      renderSlide(nextIndex);
    }, time);
  };

  // prevButton?.addEventListener('click', () => {
  //   const nextIndex = activeIndex === 0 ? slides.length - 1 : activeIndex - 1;
  //   renderSlide(nextIndex);
  //   startAutoplay();
  // });

  // nextButton?.addEventListener('click', () => {
  //   const nextIndex = activeIndex === slides.length - 1 ? 0 : activeIndex + 1;
  //   renderSlide(nextIndex);
  //   startAutoplay();
  // });

  dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
      renderSlide(index);
      startAutoplay();
    });
  });

  startAutoplay();
  renderSlide(0);
});
