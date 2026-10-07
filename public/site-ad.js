(() => {
  const isDashboardPage = !!document.querySelector('.workspace-sidebar');
  const isHomePage = window.location.pathname === '/' || /(?:^|\/)index(?:\.html)?$/i.test(window.location.pathname);
  const isAuthPage = /(?:^|\/)(?:login|signup)(?:\.html)?$/i.test(window.location.pathname);

  document.querySelectorAll('.hero-ad-carousel').forEach((carousel) => {
    const slides = [...carousel.querySelectorAll('.hero-ad-slide')];
    const dots = [...carousel.querySelectorAll('[data-ad-slide]')];
    const previous = carousel.querySelector('[data-ad-prev]');
    const next = carousel.querySelector('[data-ad-next]');
    let activeIndex = 0;

    const showSlide = (index) => {
      activeIndex = (index + slides.length) % slides.length;
      slides.forEach((slide, slideIndex) => slide.classList.toggle('active', slideIndex === activeIndex));
      dots.forEach((dot, dotIndex) => dot.classList.toggle('active', dotIndex === activeIndex));
    };

    previous?.addEventListener('click', () => showSlide(activeIndex - 1));
    next?.addEventListener('click', () => showSlide(activeIndex + 1));
    dots.forEach((dot) => dot.addEventListener('click', () => showSlide(Number(dot.dataset.adSlide))));
    showSlide(0);
    window.setInterval(() => showSlide(activeIndex + 1), 5200);
  });

  const isPhotographerDetails = document.body.classList.contains('page-photographer-details');

  if (isHomePage || isAuthPage || isPhotographerDetails) return;

  const adClass = isDashboardPage ? ' dashboard-ad' : '';
  const adMarkup = `
    <aside class="site-ad-banner${adClass}" aria-label="Sponsored placement">
      <a class="site-ad-link" href="/events">
        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&h=360&q=88" alt="Adventure vehicle on an open road">
        <span class="site-ad-overlay"></span>
        <span class="site-ad-copy"><small>PHOTOX PARTNER</small><strong>BUILT FOR MORE<br>THAN ROADS</strong><span>Explore events <i class="bi bi-arrow-up-right"></i></span></span>
      </a>
    </aside>`;

  document.body.classList.add('has-site-ad');
  if (document.querySelector('.hero-ad-carousel')) return;
  const existingAd = document.querySelector('.site-ad-banner');
  if (existingAd) existingAd.remove();

  const dashboardSidebar = isDashboardPage
    ? document.querySelector('.workspace-sidebar')
    : null;
  if (dashboardSidebar) {
    dashboardSidebar.insertAdjacentHTML('beforeend', adMarkup);
    return;
  }

  const page = document.body;
  const middlePageSelectors = {
    'page-blog': 'main > section:nth-of-type(2)',
    'page-cart': 'main > section:nth-of-type(2)',
    'page-checkout': '.checkout-main .checkout-layout'
  };
  const middleSelector = Object.keys(middlePageSelectors).find((pageClass) => page.classList.contains(pageClass));
  const middleTarget = middleSelector ? document.querySelector(middlePageSelectors[middleSelector]) : null;
  if (middleTarget) {
    middleTarget.insertAdjacentHTML('afterend', adMarkup);
    return;
  }

  const hero = page.classList.contains('page-photographers')
    ? document.querySelector('.people-hero')
    : document.querySelector('.events-page-hero, .hero-section');
  if (hero) {
    hero.insertAdjacentHTML('afterend', adMarkup);
    return;
  }

  const firstSection = document.querySelector('main > section');
  if (firstSection) {
    firstSection.insertAdjacentHTML('afterend', adMarkup);
  } else {
    document.body.insertAdjacentHTML('afterbegin', adMarkup);
  }
})();
