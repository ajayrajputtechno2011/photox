(() => {
  const isDashboardPage = !!document.querySelector('.workspace-sidebar');
  const isHomePage = window.location.pathname === '/' || /(?:^|\/)index(?:\.html)?$/i.test(window.location.pathname);
  const isAuthPage = /(?:^|\/)(?:login|signup)(?:\.html)?$/i.test(window.location.pathname);

  const initHeroCarousel = () => {
    document.querySelectorAll('.hero-ad-carousel').forEach((carousel) => {
      if (carousel.dataset.initialized === 'true') return;
      carousel.dataset.initialized = 'true';

      const slides = [...carousel.querySelectorAll('.hero-ad-slide')];
      const dots = [...carousel.querySelectorAll('[data-ad-slide]')];
      const previous = carousel.querySelector('[data-ad-prev]');
      const next = carousel.querySelector('[data-ad-next]');
      let activeIndex = 0;
      let rotationTimer = null;
      let isPaused = false;

      const getSlideDuration = (slide) => {
        if (!slide) return 5000;
        const rawSec = parseFloat(slide.dataset.interval);
        if (!isNaN(rawSec) && rawSec >= 1) {
          return Math.round(rawSec * 1000);
        }
        const carouselDefault = parseFloat(carousel.dataset.defaultInterval);
        if (!isNaN(carouselDefault) && carouselDefault >= 1) {
          return Math.round(carouselDefault * 1000);
        }
        return 5000;
      };

      const scheduleNext = () => {
        if (rotationTimer) {
          clearTimeout(rotationTimer);
          rotationTimer = null;
        }
        if (slides.length <= 1 || isPaused) return;

        const currentSlide = slides[activeIndex];
        const duration = getSlideDuration(currentSlide);

        rotationTimer = setTimeout(() => {
          showSlide(activeIndex + 1);
        }, duration);
      };

      const showSlide = (index) => {
        if (slides.length === 0) return;
        activeIndex = (index + slides.length) % slides.length;
        slides.forEach((slide, slideIndex) => slide.classList.toggle('active', slideIndex === activeIndex));
        dots.forEach((dot, dotIndex) => dot.classList.toggle('active', dotIndex === activeIndex));

        const activeSlide = slides[activeIndex];
        if (activeSlide) {
          const badge = activeSlide.dataset.badge;
          const subtitle = activeSlide.dataset.subtitle;
          const badgeEl = document.getElementById('heroBannerBadge');
          const labelEl = document.getElementById('heroBannerFrameLabel');
          if (badgeEl && badge) badgeEl.textContent = badge;
          if (labelEl && subtitle) labelEl.innerHTML = `<span class="frame-dot"></span> ${subtitle}`;
        }

        scheduleNext();
      };

      previous?.addEventListener('click', (e) => {
        e.preventDefault();
        showSlide(activeIndex - 1);
      });
      next?.addEventListener('click', (e) => {
        e.preventDefault();
        showSlide(activeIndex + 1);
      });
      dots.forEach((dot) => dot.addEventListener('click', (e) => {
        e.preventDefault();
        showSlide(Number(dot.dataset.adSlide));
      }));

      carousel.addEventListener('mouseenter', () => {
        isPaused = true;
        if (rotationTimer) {
          clearTimeout(rotationTimer);
          rotationTimer = null;
        }
      });

      carousel.addEventListener('mouseleave', () => {
        isPaused = false;
        scheduleNext();
      });

      showSlide(0);
    });
  };

  const initInPageRotators = () => {
    document.querySelectorAll('.site-ad-banner-rotator').forEach((rotator) => {
      if (rotator.dataset.initialized === 'true') return;
      rotator.dataset.initialized = 'true';

      const slides = [...rotator.querySelectorAll('.site-ad-rotator-slide')];
      if (slides.length <= 1) return;

      let activeIndex = 0;
      let timer = null;
      let isPaused = false;

      const schedule = () => {
        if (timer) clearTimeout(timer);
        if (isPaused) return;

        const currentSlide = slides[activeIndex];
        const rawSec = parseFloat(currentSlide?.dataset?.interval);
        const sec = (!isNaN(rawSec) && rawSec >= 1) ? rawSec : (parseFloat(rotator.dataset.defaultInterval) || 6);

        timer = setTimeout(() => {
          activeIndex = (activeIndex + 1) % slides.length;
          slides.forEach((s, idx) => {
            s.style.display = (idx === activeIndex) ? 'block' : 'none';
            s.classList.toggle('active', idx === activeIndex);
          });
          schedule();
        }, sec * 1000);
      };

      rotator.addEventListener('mouseenter', () => {
        isPaused = true;
        if (timer) clearTimeout(timer);
      });
      rotator.addEventListener('mouseleave', () => {
        isPaused = false;
        schedule();
      });

      schedule();
    });
  };

  const initAllCarousels = () => {
    initHeroCarousel();
    initInPageRotators();
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAllCarousels);
  } else {
    initAllCarousels();
  }

  const isPhotographerDetails = document.body.classList.contains('page-photographer-details');
  const isEventDetails = window.location.pathname.includes('event-details') || document.body.classList.contains('page-event-details') || !!document.querySelector('.event-details-hero');

  if (isHomePage || isAuthPage || isPhotographerDetails || isEventDetails) return;
  if (document.querySelector('.site-ad-banner')) return;

  const adClass = isDashboardPage ? ' dashboard-ad' : '';
  const adMarkup = `
    <aside class="site-ad-banner${adClass}" aria-label="Sponsored placement">
      <a class="site-ad-link" href="/#latest-events">
        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&h=360&q=88" alt="Adventure vehicle on an open road">
        <span class="site-ad-overlay"></span>
        <span class="site-ad-copy"><small>PHOTOX PARTNER</small><strong>BUILT FOR MORE<br>THAN ROADS</strong><span>Explore events <i class="bi bi-arrow-up-right"></i></span></span>
      </a>
    </aside>`;

  document.body.classList.add('has-site-ad');
  if (document.querySelector('.hero-ad-carousel')) return;

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
