'use strict';

/**
 * JavaScript për menunë naviguese të temës BSN Racing. 
 * Ky skript trajton hapjen dhe mbylljen e menuve, si dhe menaxhimin e submenuve 
 * për pajisje me ekran të vogël. Ai siguron që menuja të jetë e aksesueshme dhe 
 * funksionale në të gjitha madhësitë e ekranit, duke përdorur klasa CSS dhe atribute 
 * ARIA për të përmirësuar përvojën e përdoruesit.
 */
document.addEventListener('DOMContentLoaded', () => {
  const navigation = document.querySelector('.site-navigation');
  const menuToggle = document.querySelector('.site-navigation__menu-toggle');

  if (!navigation) {
    return;
  }

  if (menuToggle) {
    menuToggle.addEventListener('click', () => {
      const isOpen = navigation.classList.toggle('is-open');
      menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      menuToggle.classList.toggle('is-active', isOpen);
    });
  }

  const itemsWithChildren = navigation.querySelectorAll('.menu-item-has-children');

  const updateSubmenuAlignment = () => {
    if (window.innerWidth <= 960) {
      itemsWithChildren.forEach((item) => item.classList.remove('submenu-align-right'));
      return;
    }

    itemsWithChildren.forEach((item) => {
      const submenu = item.querySelector(':scope > .sub-menu');

      if (!submenu) {
        return;
      }

      item.classList.remove('submenu-align-right');

      const submenuRect = submenu.getBoundingClientRect();

      if (submenuRect.right > window.innerWidth - 16) {
        item.classList.add('submenu-align-right');
      }
    });
  };

  itemsWithChildren.forEach((item, index) => {
    const link = item.querySelector(':scope > a');
    const submenu = item.querySelector(':scope > .sub-menu');

    if (!link || !submenu) {
      return;
    }

    let toggle = item.querySelector(':scope > .site-navigation__toggle');

    if (!toggle) {
      toggle = document.createElement('button');
      toggle.type = 'button';
      toggle.className = 'site-navigation__toggle';
      toggle.setAttribute('aria-expanded', 'false');
      toggle.setAttribute('aria-controls', `submenu-${index + 1}`);
      toggle.setAttribute('aria-label', `${link.textContent.trim()} submenu umschalten`);
      item.insertBefore(toggle, submenu);
    }

    submenu.id = `submenu-${index + 1}`;

    link.addEventListener('click', (event) => {
      event.preventDefault();
      toggle.click();
    });

    toggle.addEventListener('click', (event) => {
      event.preventDefault();
      event.stopPropagation();

      const isOpen = item.classList.contains('is-open');

      itemsWithChildren.forEach((menuItem) => {
        menuItem.classList.remove('is-open');
        const submenuToggle = menuItem.querySelector(':scope > .site-navigation__toggle');

        if (submenuToggle) {
          submenuToggle.setAttribute('aria-expanded', 'false');
        }
      });

      if (!isOpen) {
        item.classList.add('is-open');
        toggle.setAttribute('aria-expanded', 'true');
        updateSubmenuAlignment();
      }
    });
  });

  updateSubmenuAlignment();

  document.addEventListener('click', (event) => {
    if (navigation.contains(event.target) || (menuToggle && menuToggle.contains(event.target))) {
      return;
    }

    navigation.classList.remove('is-open');

    if (menuToggle) {
      menuToggle.setAttribute('aria-expanded', 'false');
      menuToggle.classList.remove('is-active');
    }

    itemsWithChildren.forEach((item) => {
      item.classList.remove('is-open');
      const toggle = item.querySelector(':scope > .site-navigation__toggle');

      if (toggle) {
        toggle.setAttribute('aria-expanded', 'false');
      }
    });
  });

  window.addEventListener('resize', () => {
    updateSubmenuAlignment();

    if (window.innerWidth > 960) {
      navigation.classList.remove('is-open');

      if (menuToggle) {
        menuToggle.setAttribute('aria-expanded', 'false');
        menuToggle.classList.remove('is-active');
      }
    }
  });
});
