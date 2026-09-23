<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Discover upcoming sports and event photo galleries on PhotoX.">
  <title>PhotoX | Events</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <script defer src="site-ad.js"></script>
  
</head>
<body class="page-events">
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
    <section class="events-page-hero">
      <aside class="hero-ad-carousel" aria-label="Sponsored placements">
        <div class="hero-ad-slide active"><img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=700&h=1200&q=88" alt="Adventure vehicle on an open road"><span class="hero-ad-slide-copy"><strong>BUILT FOR MORE<br>THAN ROADS</strong><small>Explore the range</small></span></div>
        <div class="hero-ad-slide"><img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=700&h=1200&q=88" alt="Red running shoe"><span class="hero-ad-slide-copy"><strong>KEEP MOVING.</strong><small>Performance partner</small></span></div>
        <div class="hero-ad-slide"><img src="https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=700&h=1200&q=88" alt="Swimmer in a pool"><span class="hero-ad-slide-copy"><strong>MAKE A SPLASH.</strong><small>Discover the next event</small></span></div>
        <div class="hero-ad-controls"><button data-ad-prev type="button" aria-label="Previous ad"><i class="bi bi-chevron-left"></i></button><div class="hero-ad-dots"><button class="active" data-ad-slide="0" type="button" aria-label="Ad 1"></button><button data-ad-slide="1" type="button" aria-label="Ad 2"></button><button data-ad-slide="2" type="button" aria-label="Ad 3"></button></div><button data-ad-next type="button" aria-label="Next ad"><i class="bi bi-chevron-right"></i></button></div>
      </aside>
      <div class="container-xl">
        <div class="section-kicker"><span class="live-dot"></span>Live archive</div>
        <h1>Find the moment. <em>Then keep it.</em></h1>
        <p>Explore premium sports and event galleries across the country. From city marathons to school finals, every listing is designed to make browsing and buying photos simple, secure and fast.</p>
        <div class="hero-actions">
          <a class="btn btn-lime rounded-pill px-4" href="#discover">Browse events</a>
          <a class="btn btn-outline-light rounded-pill px-4" href="signup.html">Create account</a>
        </div>
      <!--   <div class="stats-row">
          <div class="stat-box"><span>Events</span><strong>1,240</strong></div>
          <div class="stat-box"><span>Galleries</span><strong>8.4k</strong></div>
          <div class="stat-box"><span>Photos</span><strong>3.2M</strong></div>
          <div class="stat-box"><span>Downloads</span><strong>96k</strong></div>
        </div> -->
      </div>
    </section>

    <section class="search-wrap" id="discover">
      <div class="container-xl">
        <div class="search-card">
          <div class="search-grid">
            <input type="search" placeholder="Search by event, venue, school or photographer">
            <select aria-label="Sport type">
              <option>All categories</option>
              <option>Rugby</option>
              <option>Running</option>
              <option>Cycling</option>
              <option>School sport</option>
              <option>Hockey</option>
            </select>
            <select aria-label="Date range">
              <option>Upcoming events</option>
              <option>Past 30 days</option>
              <option>Past 90 days</option>
              <option>All dates</option>
            </select>
            <button type="button">Search <i class="bi bi-arrow-right ms-2"></i></button>
          </div>
        </div>
      </div>
    </section>

    <section class="content-section">
      <div class="container-xl">
        <div class="section-header">
          <div>
            <div class="section-kicker" style="background:#eaf3ff;color:#0b2d5b;border-color:rgba(11,45,91,.08);">Featured archive</div>
            <h2 class="section-title">Latest events</h2>
          </div>
          <a class="inline-link" href="#all-events">View all events <i class="bi bi-arrow-down"></i></a>
        </div>

        <div class="event-grid">
          <article class="event-card">
            <a href="event-details.html" class="text-decoration-none text-reset d-block">
              <img src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=900&q=80" alt="City Marathon event">
              <div class="body">
                <div class="meta-row">
                  <span class="tag">Running</span>
                  <span class="date">14 Sep 2026</span>
                </div>
                <h3>City Marathon 2026</h3>
                <p>Cape Town · 24,812 photos · 8 photographers</p>
                <div class="card-bottom">
                  <span class="price">From R90</span>
                  <button class="cta" type="button">View gallery</button>
                </div>
              </div>
            </a>
          </article>

          <article class="event-card">
            <a href="event-details.html" class="text-decoration-none text-reset d-block">
              <img src="https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=900&q=80" alt="Rugby match event">
              <div class="body">
                <div class="meta-row">
                  <span class="tag">Rugby</span>
                  <span class="date">12 Sep 2026</span>
                </div>
                <h3>Maties vs Ikeys</h3>
                <p>Stellenbosch · 8,430 photos · 5 photographers</p>
                <div class="card-bottom">
                  <span class="price">From R120</span>
                  <button class="cta" type="button">View gallery</button>
                </div>
              </div>
            </a>
          </article>

          <article class="event-card">
            <a href="event-details.html" class="text-decoration-none text-reset d-block">
              <img src="https://images.unsplash.com/photo-1541625602330-2277a4c46182?auto=format&fit=crop&w=900&q=80" alt="Cycle tour event">
              <div class="body">
                <div class="meta-row">
                  <span class="tag">Cycling</span>
                  <span class="date">06 Sep 2026</span>
                </div>
                <h3>Winelands Cycle Tour</h3>
                <p>Paarl · 16,205 photos · 10 photographers</p>
                <div class="card-bottom">
                  <span class="price">From R95</span>
                  <button class="cta" type="button">View gallery</button>
                </div>
              </div>
            </a>
          </article>
        </div>
      </div>
    </section>

    <section class="content-section" id="all-events" style="background: rgba(230,240,255,.75);">
      <div class="container-xl">
        <div class="section-header">
          <div>
            <div class="section-kicker" style="background:#eaf3ff;color:#0b2d5b;border-color:rgba(11,45,91,.08);">All events</div>
            <h2 class="section-title">Browse every gallery</h2>
          </div>
          <a class="inline-link" href="contact.html">Need help? Contact us <i class="bi bi-arrow-up-right"></i></a>
        </div>

        <div class="event-list-wrapper">
          <article class="event-list-item">
            <img class="mini-thumb" src="https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=900&q=80" alt="Youth football final">
            <div class="top-row"><span class="tag">Football</span><span class="location">Johannesburg</span></div>
            <h3>U18 Final Cup</h3>
            <p>4,680 photos · 6 photographers · Final day highlights</p>
            <div class="foot"><span class="price">From R75</span><a class="cta text-decoration-none" href="event-details.html">Open <i class="bi bi-arrow-up-right ms-1"></i></a></div>
          </article>

          <article class="event-list-item">
            <img class="mini-thumb" src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?auto=format&fit=crop&w=900&q=80" alt="School sport match">
            <div class="top-row"><span class="tag">School sport</span><span class="location">Pretoria</span></div>
            <h3>Varsity Clash</h3>
            <p>7,120 photos · 9 photographers · Full match coverage</p>
            <div class="foot"><span class="price">From R82</span><a class="cta text-decoration-none" href="event-details.html">Open <i class="bi bi-arrow-up-right ms-1"></i></a></div>
          </article>

          <article class="event-list-item">
            <img class="mini-thumb" src="https://images.unsplash.com/photo-1517466787929-bc90951d0974?auto=format&fit=crop&w=900&q=80" alt="Rugby tournament">
            <div class="top-row"><span class="tag">Rugby</span><span class="location">Durban</span></div>
            <h3>Coastal Rugby 7s</h3>
            <p>9,405 photos · 11 photographers · Tournament action</p>
            <div class="foot"><span class="price">From R99</span><a class="cta text-decoration-none" href="event-details.html">Open <i class="bi bi-arrow-up-right ms-1"></i></a></div>
          </article>

          <article class="event-list-item">
            <img class="mini-thumb" src="https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=900&q=80" alt="Swimming event">
            <div class="top-row"><span class="tag">Swimming</span><span class="location">Cape Town</span></div>
            <h3>Open Water Sprint</h3>
            <p>2,776 photos · 4 photographers · Race-day moments</p>
            <div class="foot"><span class="price">From R68</span><a class="cta text-decoration-none" href="event-details.html">Open <i class="bi bi-arrow-up-right ms-1"></i></a></div>
          </article>

          <article class="event-list-item">
            <img class="mini-thumb" src="https://images.unsplash.com/photo-1521412644187-c49fa049e84d?auto=format&fit=crop&w=900&q=80" alt="Cycling event">
            <div class="top-row"><span class="tag">Cycling</span><span class="location">Paarl</span></div>
            <h3>Mountain Trail Classic</h3>
            <p>5,890 photos · 7 photographers · Epic trail portraits</p>
            <div class="foot"><span class="price">From R88</span><a class="cta text-decoration-none" href="event-details.html">Open <i class="bi bi-arrow-up-right ms-1"></i></a></div>
          </article>

          <article class="event-list-item">
            <img class="mini-thumb" src="https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=900&q=80" alt="Cross-country event">
            <div class="top-row"><span class="tag">Cross country</span><span class="location">Gqeberha</span></div>
            <h3>Coastal Cross Challenge</h3>
            <p>3,410 photos · 5 photographers · Athlete portraits</p>
            <div class="foot"><span class="price">From R72</span><a class="cta text-decoration-none" href="event-details.html">Open <i class="bi bi-arrow-up-right ms-1"></i></a></div>
          </article>
        </div>
      </div>
    </section>

    <section class="content-section">
      <div class="container-xl">
        <div class="section-header">
          <div>
            <div class="section-kicker" style="background:#eaf3ff;color:#0b2d5b;border-color:rgba(11,45,91,.08);">Discover</div>
            <h2 class="section-title">Popular categories</h2>
          </div>
        </div>
        <div class="sports-grid">
          <div class="sport-card">
            <div class="sport-icon"><i class="bi bi-trophy"></i></div>
            <h3>Rugby</h3>
            <p>School finals, club fixtures and tournament highlights.</p>
          </div>
          <div class="sport-card">
            <div class="sport-icon"><i class="bi bi-lightning-charge"></i></div>
            <h3>Running</h3>
            <p>Road races, relay events and finish-line stories.</p>
          </div>
          <div class="sport-card">
            <div class="sport-icon"><i class="bi bi-bicycle"></i></div>
            <h3>Cycling</h3>
            <p>Open-road rides, mountain trails and endurance races.</p>
          </div>
          <div class="sport-card">
            <div class="sport-icon"><i class="bi bi-people"></i></div>
            <h3>School sport</h3>
            <p>Community fixtures, finals and campus event photos.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="content-section">
      <div class="container-xl">
        <div class="section-header">
          <div>
            <div class="section-kicker" style="background:#eaf3ff;color:#0b2d5b;border-color:rgba(11,45,91,.08);">Why PhotoX</div>
            <h2 class="section-title">A cleaner event marketplace</h2>
          </div>
        </div>
        <div class="feature-band">
          <div class="feature-grid">
            <div class="feature-item">
              <i class="bi bi-search-heart"></i>
              <h4>AI search</h4>
              <p>Search by event, bib number, team or athlete when galleries enable AI recognition.</p>
            </div>
            <div class="feature-item">
              <i class="bi bi-shield-check"></i>
              <h4>Secure checkout</h4>
              <p>Protected purchase flow, proper pricing rules and instant order confirmation.</p>
            </div>
            <div class="feature-item">
              <i class="bi bi-cloud-arrow-down"></i>
              <h4>Fast delivery</h4>
              <p>Download selected photos instantly with secure access links and protected originals.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="content-section" style="padding-top:0;">
      <div class="container-xl">
        <div class="cta-panel">
          <div>
            <div class="section-kicker" style="background:#eaf3ff;color:#0b2d5b;border-color:rgba(11,45,91,.08);">Ready to launch</div>
            <h3>Bring your next event to PhotoX.</h3>
            <p>Photographers, schools and sponsors can upload galleries, publish event pages and sell memories in minutes.</p>
          </div>
          <a class="btn btn-lime rounded-pill px-4" href="signup.html">Join now</a>
        </div>
      </div>
    </section>
    <aside class="site-ad-banner" aria-label="Sponsored placement">
      <a class="site-ad-link" href="events.html"><img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&h=360&q=88" alt="Adventure vehicle on an open road"><span class="site-ad-overlay"></span><span class="site-ad-copy"><small>PHOTOX PARTNER</small><strong>BUILT FOR MORE<br>THAN ROADS</strong><span>Explore events <i class="bi bi-arrow-up-right"></i></span></span></a>
    </aside>
  </main>

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
        <div class="col-6 col-lg-2"><p class="footer-label">Explore</p><a href="events.html">Events</a><a href="photographers.html">Photographers</a><a href="blog.html">Journal</a><a href="contact.html">Contact</a></div>
        <div class="col-6 col-lg-2"><p class="footer-label">For creators</p><a href="login.html">Creator login</a><a href="signup.html">Join PhotoX</a><a href="events.html">Upload photos</a><a href="blog.html">Support</a></div>
        <div class="col-12 col-lg-3"><p class="footer-label">Stay in the frame</p><p class="footer-small">New events, fresh galleries and stories from the field.</p><div class="newsletter"><input aria-label="Email address" placeholder="Your email address" type="email"><button aria-label="Subscribe"><i class="bi bi-arrow-up-right"></i></button></div></div>
      </div>
      <div class="footer-bottom"><span>© 2026 PhotoX</span><span>Privacy · Terms ·</span><span>Made for the moments <i class="bi bi-stars"></i></span></div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
