'use strict';

document.addEventListener('DOMContentLoaded', () => {
  const triggers = Array.from(document.querySelectorAll('[data-lightbox-src]'));

  if (!triggers.length) {
    return;
  }

  const root = document.querySelector('[data-lightbox]');
  const image = root?.querySelector('[data-lightbox-image]');
  const closeButton = root?.querySelector('[data-lightbox-close]');
  const prevButton = root?.querySelector('[data-lightbox-prev]');
  const nextButton = root?.querySelector('[data-lightbox-next]');

  if (!root || !image || !closeButton || !prevButton || !nextButton) {
    return;
  }

  let activeGroup = [];
  let activeIndex = 0;

  const sync = () => {
    const current = activeGroup[activeIndex];
    if (!current) {
      return;
    }

    image.src = current.dataset.lightboxSrc || '';
    image.alt = current.dataset.lightboxAlt || '';
    prevButton.disabled = activeGroup.length <= 1;
    nextButton.disabled = activeGroup.length <= 1;
  };

  const open = (trigger) => {
    const groupName = trigger.dataset.lightboxGroup || '';
    activeGroup = triggers.filter((item) => (item.dataset.lightboxGroup || '') === groupName);

    if (!activeGroup.length) {
      activeGroup = [trigger];
    }

    activeIndex = Math.max(activeGroup.indexOf(trigger), 0);
    sync();
    root.hidden = false;
    document.body.classList.add('has-lightbox-open');
  };

  const close = () => {
    root.hidden = true;
    image.src = '';
    image.alt = '';
    document.body.classList.remove('has-lightbox-open');
  };

  const step = (direction) => {
    if (activeGroup.length <= 1) {
      return;
    }

    activeIndex = (activeIndex + direction + activeGroup.length) % activeGroup.length;
    sync();
  };

  triggers.forEach((trigger) => {
    trigger.addEventListener('click', () => open(trigger));
  });

  closeButton.addEventListener('click', close);
  prevButton.addEventListener('click', () => step(-1));
  nextButton.addEventListener('click', () => step(1));

  root.addEventListener('click', (event) => {
    if (event.target === root || event.target.hasAttribute('data-lightbox-backdrop')) {
      close();
    }
  });

  document.addEventListener('keydown', (event) => {
    if (root.hidden) {
      return;
    }

    if (event.key === 'Escape') {
      close();
    }

    if (event.key === 'ArrowLeft') {
      step(-1);
    }

    if (event.key === 'ArrowRight') {
      step(1);
    }
  });
});
