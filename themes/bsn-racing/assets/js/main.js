'use strict';

const CONSENT_KEY = 'bsnConsent';
const CONSENT_ACCEPTED = 'accepted';
const CONSENT_REJECTED = 'rejected';

const getConsentState = () => window.localStorage.getItem(CONSENT_KEY);

const setConsentState = (value) => {
  window.localStorage.setItem(CONSENT_KEY, value);
  document.documentElement.dataset.consentState = value;
};

const loadUmami = (banner) => {
  if (!banner || document.querySelector('script[data-bsn-umami]')) {
    return;
  }

  const src = banner.dataset.umamiSrc || '';
  const websiteId = banner.dataset.umamiWebsiteId || '';

  if (!src || !websiteId) {
    return;
  }

  const script = document.createElement('script');
  script.defer = true;
  script.dataset.websiteId = websiteId;
  script.dataset.bsnUmami = 'true';
  script.src = src;
  document.head.appendChild(script);
};

const unloadUmami = () => {
  const script = document.querySelector('script[data-bsn-umami]');
  if (script) {
    script.remove();
  }

  if ('umami' in window) {
    try {
      delete window.umami;
    } catch (error) {
      window.umami = undefined;
    }
  }
};

const activateMaps = () => {
  const mapWrappers = Array.from(document.querySelectorAll('[data-consent-map]'));

  mapWrappers.forEach((wrapper) => {
    if (wrapper.dataset.mapLoaded === 'true') {
      return;
    }

    const src = wrapper.dataset.mapSrc || '';
    const title = wrapper.dataset.mapTitle || 'Google Maps';

    if (!src) {
      return;
    }

    const iframe = document.createElement('iframe');
    iframe.className = 'contact-page__map';
    iframe.src = src;
    iframe.loading = 'lazy';
    iframe.referrerPolicy = 'no-referrer-when-downgrade';
    iframe.allowFullscreen = true;
    iframe.title = title;

    wrapper.innerHTML = '';
    wrapper.appendChild(iframe);
    wrapper.dataset.mapLoaded = 'true';
  });
};

const deactivateMaps = () => {
  const mapWrappers = Array.from(document.querySelectorAll('[data-consent-map]'));

  mapWrappers.forEach((wrapper) => {
    const placeholderHtml = wrapper.dataset.placeholderHtml || '';

    if (!placeholderHtml) {
      return;
    }

    wrapper.innerHTML = placeholderHtml;
    wrapper.dataset.mapLoaded = 'false';
  });
};

const applyConsentState = (state, banner) => {
  document.documentElement.dataset.consentState = state || '';

  if (state === CONSENT_ACCEPTED) {
    loadUmami(banner);
    activateMaps();
  }

  if (state === CONSENT_REJECTED) {
    unloadUmami();
    deactivateMaps();
  }

  if (banner) {
    banner.hidden = state !== null;
  }
};

const initConsent = () => {
  const banner = document.querySelector('[data-cookie-consent]');
  if (!banner) {
    return;
  }

  const acceptButton = banner.querySelector('[data-cookie-consent-accept]');
  const rejectButton = banner.querySelector('[data-cookie-consent-reject]');
  const openButtons = Array.from(document.querySelectorAll('[data-cookie-consent-open]'));
  const mapAcceptButtons = Array.from(document.querySelectorAll('[data-consent-map-accept]'));
  const mapWrappers = Array.from(document.querySelectorAll('[data-consent-map]'));
  const storedConsent = getConsentState();

  mapWrappers.forEach((wrapper) => {
    if (!wrapper.dataset.placeholderHtml) {
      wrapper.dataset.placeholderHtml = wrapper.innerHTML;
    }
  });

  applyConsentState(storedConsent, banner);

  acceptButton?.addEventListener('click', () => {
    setConsentState(CONSENT_ACCEPTED);
    applyConsentState(CONSENT_ACCEPTED, banner);
  });

  rejectButton?.addEventListener('click', () => {
    setConsentState(CONSENT_REJECTED);
    applyConsentState(CONSENT_REJECTED, banner);
  });

  openButtons.forEach((button) => {
    button.addEventListener('click', (event) => {
      event.preventDefault();
      banner.hidden = false;
    });
  });

  mapAcceptButtons.forEach((button) => {
    button.addEventListener('click', () => {
      setConsentState(CONSENT_ACCEPTED);
      applyConsentState(CONSENT_ACCEPTED, banner);
    });
  });
};

const initLightbox = () => {
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
};

document.addEventListener('DOMContentLoaded', () => {
  initConsent();
  initLightbox();
});
