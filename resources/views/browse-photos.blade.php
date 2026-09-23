<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Browse and filter PhotoX event photos by category, event and moment.">
  <title>PhotoX | Browse Photos</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <script defer src="site-ad.js"></script>
  
</head>
<body class="page-browse-photos">
  <nav aria-label="Main navigation" class="navbar navbar-expand-lg py-2">
    <div class="container-xl">
      <a aria-label="PhotoX home" class="navbar-brand d-flex align-items-center gap-2" href="index.html"><img alt="PhotoX" src="logo.png"></a>
      <button aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler border-0 p-0" data-bs-target="#mainNav" data-bs-toggle="collapse" type="button"><i class="bi bi-list fs-2"></i></button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav mx-auto gap-lg-3 mt-3 mt-lg-0">
          <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="events.html">Explore</a></li>
          <li class="nav-item"><a class="nav-link" href="photographers.html">Photographers</a></li>
          <li class="nav-item"><a class="nav-link" href="membership.html">Membership</a></li>
          <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
        </ul>
        <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
          <div class="header-search d-none d-xl-flex"><i class="bi bi-search"></i><input aria-label="Search photos, people, teams or events" placeholder="Search photos, people, teams or events..." type="search"></div>
          <a class="header-cart" href="cart.html" aria-label="Open cart"><i class="bi bi-cart3"></i><span>0</span></a>
          <a class="text-link d-none d-sm-inline" href="login.html"><i class="bi bi-person me-1"></i>Login</a>
          <a class="btn btn-lime rounded-pill px-4" href="signup.html">Sign Up <i class="bi bi-arrow-up-right ms-1"></i></a>
        </div>
      </div>
    </div>
  </nav>

  <main>
    <section class="browse-hero">
      <aside class="hero-ad-carousel" aria-label="Sponsored placements">
        <div class="hero-ad-slide active"><img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=700&h=1200&q=88" alt="Adventure vehicle on an open road"><span class="hero-ad-slide-copy"><strong>BUILT FOR MORE<br>THAN ROADS</strong><small>Explore the range</small></span></div><div class="hero-ad-slide"><img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=700&h=1200&q=88" alt="Red running shoe"><span class="hero-ad-slide-copy"><strong>KEEP MOVING.</strong><small>Performance partner</small></span></div><div class="hero-ad-slide"><img src="https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=700&h=1200&q=88" alt="Swimmer in a pool"><span class="hero-ad-slide-copy"><strong>MAKE A SPLASH.</strong><small>Discover the next event</small></span></div><div class="hero-ad-controls"><button data-ad-prev type="button" aria-label="Previous ad"><i class="bi bi-chevron-left"></i></button><div class="hero-ad-dots"><button class="active" data-ad-slide="0" type="button" aria-label="Ad 1"></button><button data-ad-slide="1" type="button" aria-label="Ad 2"></button><button data-ad-slide="2" type="button" aria-label="Ad 3"></button></div><button data-ad-next type="button" aria-label="Next ad"><i class="bi bi-chevron-right"></i></button></div>
      </aside>
      <div class="container-xl">
        <div class="section-kicker" style="color:#dfeafe;">Photo archive</div>
        <h1>Browse the <em>best moments.</em></h1>
        <p>Search all event images, shortlist your favourites and save your top moments for download. Every gallery is structured for speed, clarity and a premium viewing experience.</p>
        <div class="hero-actions">
          <a class="btn btn-lime rounded-pill px-4" href="event-details.html">Return to event</a>
          <a class="btn btn-outline-light rounded-pill px-4" href="events.html">Explore all events</a>
        </div>
      </div>
    </section>

    <section class="search-panel">
      <div class="container-xl">
        <div class="content-card">
          <div class="filter-row">
            <input type="search" placeholder="Search by athlete, school, team or event name">
            <select aria-label="Category">
              <option>All categories</option>
              <option>Marathon</option>
              <option>Rugby</option>
              <option>School sport</option>
              <option>Cycle</option>
            </select>
            <select aria-label="Sorting">
              <option>Newest</option>
              <option>Popular</option>
              <option>Price low to high</option>
            </select>
            <button type="button">Search</button>
          </div>
          <div class="filter-pills">
            <span class="filter-pill active">All</span>
            <span class="filter-pill">Finish line</span>
            <span class="filter-pill">Crowd</span>
            <span class="filter-pill">Portraits</span>
            <span class="filter-pill">Team shots</span>
            <span class="filter-pill">Highlights</span>
          </div>
        </div>
      </div>
    </section>

    <section class="content-section">
      <div class="container-xl">
        <div class="gallery-wall">
          <article class="gallery-item">
            <img src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=900&q=80" alt="Runner crossing finish line">
            <div class="gallery-meta">
              <div class="tiny">Finish line</div>
              <p class="title">City Marathon</p>
              <div class="actions"><span class="price-tag">R90</span><button class="save-btn" type="button"><i class="bi bi-bookmark"></i></button><a class="photo-cart-btn" href="cart.html" aria-label="Add City Marathon photo to cart"><i class="bi bi-cart-plus"></i></a></div>
            </div>
          </article>
          <article class="gallery-item">
            <img src="https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=900&q=80" alt="Rugby match capture">
            <div class="gallery-meta">
              <div class="tiny">Match moment</div>
              <p class="title">Rugby Match</p>
              <div class="actions"><span class="price-tag">R120</span><button class="save-btn" type="button"><i class="bi bi-bookmark"></i></button><a class="photo-cart-btn" href="cart.html" aria-label="Add Rugby Match photo to cart"><i class="bi bi-cart-plus"></i></a></div>
            </div>
          </article>
          <article class="gallery-item">
            <img src="https://images.unsplash.com/photo-1517466787929-bc90951d0974?auto=format&fit=crop&w=900&q=80" alt="Football team celebration">
            <div class="gallery-meta">
              <div class="tiny">Team shot</div>
              <p class="title">School Final</p>
              <div class="actions"><span class="price-tag">R110</span><button class="save-btn" type="button"><i class="bi bi-bookmark"></i></button><a class="photo-cart-btn" href="cart.html" aria-label="Add School Final photo to cart"><i class="bi bi-cart-plus"></i></a></div>
            </div>
          </article>
          <article class="gallery-item">
            <img src="https://images.unsplash.com/photo-1541625602330-2277a4c46182?auto=format&fit=crop&w=900&q=80" alt="Cyclist reaching the finish">
            <div class="gallery-meta">
              <div class="tiny">Cycling</div>
              <p class="title">Winelands Tour</p>
              <div class="actions"><span class="price-tag">R95</span><button class="save-btn" type="button"><i class="bi bi-bookmark"></i></button><a class="photo-cart-btn" href="cart.html" aria-label="Add Winelands Tour photo to cart"><i class="bi bi-cart-plus"></i></a></div>
            </div>
          </article>
          <article class="gallery-item">
            <img src="https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=900&q=80" alt="Swimmers in motion">
            <div class="gallery-meta">
              <div class="tiny">Open water</div>
              <p class="title">Swim Series</p>
              <div class="actions"><span class="price-tag">R85</span><button class="save-btn" type="button"><i class="bi bi-bookmark"></i></button><a class="photo-cart-btn" href="cart.html" aria-label="Add Swim Series photo to cart"><i class="bi bi-cart-plus"></i></a></div>
            </div>
          </article>
          <article class="gallery-item">
            <img src="https://images.unsplash.com/photo-1521412644187-c49fa049e84d?auto=format&fit=crop&w=900&q=80" alt="Crowd cheering at a stadium">
            <div class="gallery-meta">
              <div class="tiny">Crowd</div>
              <p class="title">Stadium Energy</p>
              <div class="actions"><span class="price-tag">R72</span><button class="save-btn" type="button"><i class="bi bi-bookmark"></i></button><a class="photo-cart-btn" href="cart.html" aria-label="Add Stadium Energy photo to cart"><i class="bi bi-cart-plus"></i></a></div>
            </div>
          </article>
          <article class="gallery-item">
            <img src="https://images.unsplash.com/photo-1526506118085-60ce8714f8c5?auto=format&fit=crop&w=900&q=80" alt="Runner portrait">
            <div class="gallery-meta">
              <div class="tiny">Portraits</div>
              <p class="title">Runner Portraits</p>
              <div class="actions"><span class="price-tag">R60</span><button class="save-btn" type="button"><i class="bi bi-bookmark"></i></button><a class="photo-cart-btn" href="cart.html" aria-label="Add Runner Portraits photo to cart"><i class="bi bi-cart-plus"></i></a></div>
            </div>
          </article>
          <article class="gallery-item">
            <img src="https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=900&q=80" alt="Football players in action">
            <div class="gallery-meta">
              <div class="tiny">Highlights</div>
              <p class="title">Last-Minute Goal</p>
              <div class="actions"><span class="price-tag">R105</span><button class="save-btn" type="button"><i class="bi bi-bookmark"></i></button><a class="photo-cart-btn" href="cart.html" aria-label="Add Last-Minute Goal photo to cart"><i class="bi bi-cart-plus"></i></a></div>
            </div>
          </article>
        </div>
      </div>
    </section>

    <section class="content-section" style="padding-top:0;">
      <div class="container-xl">
        <div class="cta-band">
          <div>
            <div class="section-kicker" style="color:#dfeafe;">Need more?</div>
            <h3>Download the full event pack.</h3>
            <p>Perfect for teams, families and sponsors who want the complete set.</p>
          </div>
          <a class="btn btn-lime rounded-pill px-4" href="signup.html">Create account</a>
        </div>
      </div>
    </section>
    <aside class="site-ad-banner" aria-label="Sponsored placement">
      <a class="site-ad-link" href="events.html"><img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&h=360&q=88" alt="Adventure vehicle on an open road"><span class="site-ad-overlay"></span><span class="site-ad-copy"><small>PHOTOX PARTNER</small><strong>BUILT FOR MORE<br>THAN ROADS</strong><span>Explore events <i class="bi bi-arrow-up-right"></i></span></span></a>
    </aside>
  </main>

  <div class="photo-lightbox" id="photoLightbox" role="dialog" aria-label="Photo preview" aria-modal="true">
    <div class="lightbox-stage">
      <button aria-label="Close photo preview" class="lightbox-close" id="lightboxClose" type="button"><i class="bi bi-x-lg"></i></button>
      <button aria-label="Previous photo" class="lightbox-arrow lightbox-prev" id="lightboxPrev" type="button"><i class="bi bi-chevron-left"></i></button>
      <img alt="" class="lightbox-image" id="lightboxImage">
      <button aria-label="Next photo" class="lightbox-arrow lightbox-next" id="lightboxNext" type="button"><i class="bi bi-chevron-right"></i></button>
      <div class="lightbox-caption" id="lightboxCaption"></div>
    </div>
  </div>

  <footer class="footer footer-premium">
    <div class="container-xl">
      <div class="row g-5 footer-main">
        <div class="col-lg-5">
          <a class="footer-logo" href="index.html"><img src="logo.png" alt="PhotoX" style="width:150px"></a>
          <p class="footer-copy">The feeling of being there,<br>kept in a frame.</p>
          <div class="footer-social d-flex gap-3">
            <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" aria-label="Linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
        <div class="col-6 col-lg-2"><p class="footer-label">Explore</p><a href="events.html">Events</a><a href="photographers.html">Photographers</a><a href="about.html">About</a><a href="contact.html">Contact</a></div>
        <div class="col-6 col-lg-2"><p class="footer-label">For creators</p><a href="login.html">Creator login</a><a href="signup.html">Join PhotoX</a><a href="events.html">Upload photos</a><a href="about.html">Support</a></div>
        <div class="col-12 col-lg-3"><p class="footer-label">Stay in the frame</p><p class="footer-small">New events, fresh galleries and stories from the field.</p><div class="newsletter"><input aria-label="Email address" placeholder="Your email address" type="email"><button aria-label="Subscribe"><i class="bi bi-arrow-up-right"></i></button></div></div>
      </div>
      <div class="footer-bottom"><span>© 2026 PhotoX</span><span>Privacy · Terms ·</span><span>Made for the moments <i class="bi bi-stars"></i></span></div>
    </div>
  </footer>

  <script>
    const galleryImages = [...document.querySelectorAll('.gallery-item img')];
    const lightbox = document.getElementById('photoLightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxCaption = document.getElementById('lightboxCaption');
    let activePhotoIndex = 0;

    function showPhoto(index) {
      activePhotoIndex = (index + galleryImages.length) % galleryImages.length;
      const source = galleryImages[activePhotoIndex];
      lightboxImage.src = source.src;
      lightboxImage.alt = source.alt;
      lightboxCaption.textContent = `${activePhotoIndex + 1} / ${galleryImages.length} · ${source.alt}`;
    }

    function openLightbox(index) {
      showPhoto(index);
      lightbox.classList.add('is-open');
      document.body.classList.add('lightbox-open');
      document.getElementById('lightboxClose').focus();
    }

    function closeLightbox() {
      lightbox.classList.remove('is-open');
      document.body.classList.remove('lightbox-open');
    }

    galleryImages.forEach((image, index) => image.addEventListener('click', () => openLightbox(index)));
    document.getElementById('lightboxPrev').addEventListener('click', () => showPhoto(activePhotoIndex - 1));
    document.getElementById('lightboxNext').addEventListener('click', () => showPhoto(activePhotoIndex + 1));
    document.getElementById('lightboxClose').addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', (event) => {
      if (event.target === lightbox) closeLightbox();
    });
    document.addEventListener('keydown', (event) => {
      if (!lightbox.classList.contains('is-open')) return;
      if (event.key === 'Escape') closeLightbox();
      if (event.key === 'ArrowLeft') showPhoto(activePhotoIndex - 1);
      if (event.key === 'ArrowRight') showPhoto(activePhotoIndex + 1);
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
