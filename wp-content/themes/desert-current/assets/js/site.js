document.documentElement.classList.add('has-js');

const menuToggle = document.querySelector('.site-header__menu-toggle');
const navPanel = document.querySelector('.site-header__nav-panel');

if (menuToggle && navPanel) {
  const closeMenu = () => {
    menuToggle.setAttribute('aria-expanded', 'false');
    navPanel.classList.remove('is-open');
  };

  menuToggle.addEventListener('click', () => {
    const isOpen = menuToggle.getAttribute('aria-expanded') === 'true';

    menuToggle.setAttribute('aria-expanded', String(!isOpen));
    navPanel.classList.toggle('is-open', !isOpen);
  });

  window.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
      closeMenu();
    }
  });

  window.addEventListener('resize', () => {
    if (window.innerWidth > 640) {
      closeMenu();
    }
  });
}
