const toastElement = document.getElementById('photoToast');
const toastMessage = toastElement ? toastElement.querySelector('span') : null;
const toast = toastElement && window.bootstrap ? new bootstrap.Toast(toastElement, { delay: 2600 }) : null;

document.querySelectorAll('.navbar-toggler[data-bs-target="#mainNav"]').forEach((toggle) => {
  toggle.addEventListener('click', () => {
    const navigation = document.getElementById('mainNav');
    if (!navigation) return;
    const isOpen = navigation.classList.toggle('mobile-nav-open');
    navigation.classList.toggle('show', isOpen);
    toggle.setAttribute('aria-expanded', String(isOpen));
  });
});

function showToast(message) {
  if (!toast || !toastMessage) return;
  toastMessage.textContent = message;
  toast.show();
}

const eventTrack = document.getElementById('eventGrid');
const eventItems = [...document.querySelectorAll('.event-item')];
const eventPrev = document.getElementById('eventsPrev');
const eventNext = document.getElementById('eventsNext');
const eventProgress = document.getElementById('eventsProgressBar');
let eventSlide = 0;

const heroSlides = [
  {
    caption: 'Cape Town<br>City Marathon',
    images: [
      ['https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=1000&q=85', 'Runner crossing a finish line'],
      ['https://images.unsplash.com/photo-1517466787929-bc90951d0974?auto=format&fit=crop&w=600&q=85', 'Football player on a field'],
      ['https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=600&q=85', 'Rugby player in action'],
      ['https://images.unsplash.com/photo-1541625602330-2277a4c46182?auto=format&fit=crop&w=600&q=85', 'Cyclist riding outdoors'],
      ['https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=600&q=85', 'Swimmer racing in a pool']
    ]
  },
  {
    caption: 'Winelands<br>Cycle Tour',
    images: [
      ['https://images.unsplash.com/photo-1541625602330-2277a4c46182?auto=format&fit=crop&w=1000&q=85', 'Cyclist riding through the countryside'],
      ['https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=600&q=85', 'Runner crossing a finish line'],
      ['https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=600&q=85', 'Swimmer racing in a pool'],
      ['https://images.unsplash.com/photo-1517466787929-bc90951d0974?auto=format&fit=crop&w=600&q=85', 'Football player on a field'],
      ['https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=600&q=85', 'Rugby player in action']
    ]
  },
  {
    caption: 'Cape Town<br>Open Water Series',
    images: [
      ['https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=1000&q=85', 'Swimmer racing in a pool'],
      ['https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=600&q=85', 'Rugby player in action'],
      ['https://images.unsplash.com/photo-1541625602330-2277a4c46182?auto=format&fit=crop&w=600&q=85', 'Cyclist riding outdoors'],
      ['https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=600&q=85', 'Runner crossing a finish line'],
      ['https://images.unsplash.com/photo-1517466787929-bc90951d0974?auto=format&fit=crop&w=600&q=85', 'Football player on a field']
    ]
  }
];
const heroImageElements = [...document.querySelectorAll('#heroMainImage')];
const heroImageCaption = document.getElementById('heroImageCaption');
const heroDots = [...document.querySelectorAll('[data-hero-slide]')];
let heroImageIndex = 0;

function showHeroImage(index) {
  if (!heroImageElements.length || !heroImageCaption || !heroDots.length) return;
  heroImageIndex = (index + heroSlides.length) % heroSlides.length;
  const nextSlide = heroSlides[heroImageIndex];
  heroImageElements.forEach((image) => image.classList.add('is-changing'));
  window.setTimeout(() => {
    heroImageElements.forEach((image) => {
      image.src = nextSlide.images[0][0];
      image.alt = nextSlide.images[0][1];
      image.classList.remove('is-changing');
    });
    heroImageCaption.innerHTML = heroImageIndex === 0 ? 'Real<em>Moments</em><br>Lasting Stories.' : nextSlide.caption;
  }, 700);
  heroDots.forEach((dot, dotIndex) => dot.classList.toggle('active', dotIndex === heroImageIndex));
}

const heroPrevious = document.getElementById('heroPrev');
const heroNext = document.getElementById('heroNext');
if (heroPrevious && heroNext && heroImageElements.length && heroImageCaption && heroDots.length) {
  heroPrevious.addEventListener('click', () => showHeroImage(heroImageIndex - 1));
  heroNext.addEventListener('click', () => showHeroImage(heroImageIndex + 1));
  heroDots.forEach((dot) => dot.addEventListener('click', () => showHeroImage(Number(dot.dataset.heroSlide))));
  window.setInterval(() => showHeroImage(heroImageIndex + 1), 7000);
}

function visibleEventItems() {
  return eventItems.filter((item) => !item.classList.contains('d-none'));
}

function eventItemsPerView() {
  if (window.innerWidth <= 575) return 1;
  if (window.innerWidth <= 1199) return 2;
  return 4;
}

function moveEvents(direction = 0) {
  if (!eventTrack || !eventPrev || !eventNext || !eventProgress) return;
  const visibleItems = visibleEventItems();
  const perView = eventItemsPerView();
  const maxSlide = Math.max(0, visibleItems.length - perView);
  eventSlide = Math.min(Math.max(eventSlide + direction, 0), maxSlide);
  const firstItem = visibleItems[0];
  const step = firstItem ? firstItem.getBoundingClientRect().width + (window.innerWidth <= 575 ? 16 : 24) : 0;
  eventTrack.style.transform = `translateX(-${eventSlide * step}px)`;
  eventProgress.style.width = `${maxSlide ? ((eventSlide + perView) / visibleItems.length) * 100 : 100}%`;
  eventPrev.disabled = eventSlide === 0;
  eventNext.disabled = eventSlide === maxSlide;
}

eventPrev?.addEventListener('click', () => moveEvents(-1));
eventNext?.addEventListener('click', () => moveEvents(1));
window.addEventListener('resize', () => moveEvents());

const sponsorSlides = [...document.querySelectorAll('.sponsor-slide')];
const sponsorDots = [...document.querySelectorAll('.sponsor-dot')];
let activeSponsor = 0;
let sponsorFormat = 'responsive';

function showSponsor(index) {
  if (!sponsorSlides.length) return;
  activeSponsor = (index + sponsorSlides.length) % sponsorSlides.length;
  sponsorSlides.forEach((slide, slideIndex) => {
    slide.classList.toggle('active', slideIndex === activeSponsor);
    slide.classList.remove('format-responsive', 'format-square', 'format-vertical');
    slide.classList.add(`format-${sponsorFormat}`);
  });
  sponsorDots.forEach((dot, dotIndex) => dot.classList.toggle('active', dotIndex === activeSponsor));
}

document.querySelectorAll('.format-button').forEach((button) => {
  button.addEventListener('click', () => {
    document.querySelectorAll('.format-button').forEach((item) => item.classList.remove('active'));
    button.classList.add('active');
    sponsorFormat = button.dataset.format;
    showSponsor(activeSponsor);
    showToast(`${button.textContent} sponsor format preview selected.`);
  });
});

sponsorDots.forEach((dot) => dot.addEventListener('click', () => showSponsor(Number(dot.dataset.slideTo))));
document.getElementById('sponsorPrev')?.addEventListener('click', () => showSponsor(activeSponsor - 1));
document.getElementById('sponsorNext')?.addEventListener('click', () => showSponsor(activeSponsor + 1));
document.querySelectorAll('.sponsor-cta').forEach((link) => link.addEventListener('click', () => showToast('Sponsor campaign opened.')));
window.setInterval(() => showSponsor(activeSponsor + 1), 6500);

document.querySelectorAll('.finder-tab').forEach((tab) => {
  tab.addEventListener('click', () => {
    document.querySelectorAll('.finder-tab').forEach((item) => item.classList.remove('active'));
    tab.classList.add('active');
    const mode = tab.dataset.mode;
    const input = document.getElementById('searchInput');
    input.placeholder = mode === 'selfie' ? 'Upload a selfie to find your photos' : mode === 'number' ? 'Enter your bib or jersey number' : 'Search events, schools or locations';
    if (mode === 'selfie') showToast('Selfie search is ready for AI-enabled galleries.');
  });
});

const searchButton = document.getElementById('searchButton');
const searchInput = document.getElementById('searchInput');
searchButton?.addEventListener('click', () => {
  const value = searchInput?.value.trim() || '';
  showToast(value ? `Searching PhotoX for “${value}”.` : 'Try an event, school, location or number.');
});

document.querySelectorAll('.filter-chip').forEach((chip) => {
  chip.addEventListener('click', () => {
    document.querySelectorAll('.filter-chip').forEach((item) => item.classList.remove('active'));
    chip.classList.add('active');
    const filter = chip.dataset.filter;
    document.querySelectorAll('.event-item').forEach((event) => {
      event.classList.toggle('d-none', filter !== 'all' && event.dataset.category !== filter);
    });
    eventSlide = 0;
    moveEvents();
  });
});

document.querySelectorAll('.save-button').forEach((button) => {
  button.addEventListener('click', () => {
    button.classList.toggle('saved');
    button.innerHTML = button.classList.contains('saved') ? '<i class="bi bi-bookmark-fill"></i>' : '<i class="bi bi-bookmark"></i>';
    showToast(button.classList.contains('saved') ? 'Event saved to your favourites.' : 'Event removed from your favourites.');
  });
});

document.querySelectorAll('a[href="#find"]').forEach((link) => {
  link.addEventListener('click', () => setTimeout(() => searchInput?.focus(), 500));
});

moveEvents();

const testimonialSlides = [...document.querySelectorAll('.testimonial-slide')];
const testimonialDots = [...document.querySelectorAll('.testimonial-dot')];
let activeTestimonial = 0;

function testimonialsPerView() {
  if (window.innerWidth <= 575) return 1;
  if (window.innerWidth <= 991) return 2;
  return 3;
}

function showTestimonial(index) {
  if (!testimonialSlides.length || !testimonialDots.length) return;
  const maxIndex = Math.max(0, testimonialSlides.length - testimonialsPerView());
  activeTestimonial = Math.min(Math.max(index, 0), maxIndex);
  const firstSlide = testimonialSlides[0];
  const gap = window.innerWidth <= 575 ? 16 : 24;
  const step = firstSlide.getBoundingClientRect().width + gap;
  document.getElementById('testimonialTrack').style.transform = `translateX(-${activeTestimonial * step}px)`;
  testimonialDots.forEach((dot, dotIndex) => dot.classList.toggle('active', dotIndex === activeTestimonial));
}

document.getElementById('testimonialPrev')?.addEventListener('click', () => showTestimonial(activeTestimonial - 1));
document.getElementById('testimonialNext')?.addEventListener('click', () => showTestimonial(activeTestimonial + 1));
testimonialDots.forEach((dot) => dot.addEventListener('click', () => showTestimonial(Number(dot.dataset.testimonial))));
window.addEventListener('resize', () => showTestimonial(activeTestimonial));
window.setInterval(() => {
  const maxIndex = Math.max(0, testimonialSlides.length - testimonialsPerView());
  showTestimonial(activeTestimonial >= maxIndex ? 0 : activeTestimonial + 1);
}, 6500);
showTestimonial(0);
