<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="PhotoX is the sports and event photography marketplace for finding your moments." name="description">
  <title>PhotoX | Find your moment</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <script defer src="site-ad.js"></script>
</head>
<body>
  <nav aria-label="Main navigation" class="navbar navbar-expand-lg py-2">
    <div class="container-xl">
      <a aria-label="PhotoX home" class="navbar-brand d-flex align-items-center gap-2" href="index.html"><img alt="PhotoX" src="logo.png"></a> <button aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler border-0 p-0" data-bs-target="#mainNav" data-bs-toggle="collapse" type="button"><i class="bi bi-list fs-2"></i></button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav mx-auto gap-lg-3 mt-3 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="index.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="events.html">Explore</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="photographers.html">Photographers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="membership.html">Membership</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.html">About</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
        </ul>
        <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
          <div class="header-search d-none d-xl-flex"><i class="bi bi-search"></i><input aria-label="Search photos, people, teams or events" placeholder="Search photos, people, teams or events..." type="search"></div>
          <a class="header-cart" href="cart.html" aria-label="Open cart"><i class="bi bi-cart3"></i><span>0</span></a>
          <a class="text-link d-none d-sm-inline" href="login.html"><i class="bi bi-person me-1"></i>Login</a> <a class="btn btn-lime rounded-pill px-4" href="signup.html">Sign Up <i class="bi bi-arrow-up-right ms-1"></i></a>
        </div>
      </div>
    </div>
  </nav>
  <main id="top">
    <section class="hero-section reference-hero">
      <div class="hero-slider" aria-label="Featured PhotoX stories">
        <div class="hero-slide active" id="heroSlide">
          <img alt="Rugby player carrying a ball during a match" id="heroMainImage" src="https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=1800&q=88">
          <div class="hero-shade"></div>
          <div class="hero-copy"><p class="eyebrow"><span class="live-dot"></span>South Africa's professional photography marketplace</p><h1 id="heroImageCaption">Real<em>Moments</em><br>Lasting Stories.</h1><p class="hero-intro">Marketplace for sport, events and more.</p><div class="hero-actions d-flex flex-wrap gap-3"><a class="btn btn-lime btn-lg rounded-pill px-4" href="browse-photos.html"><i class="bi bi-camera me-2"></i>Browse Photos</a><a class="btn btn-outline-light btn-lg rounded-pill px-4" href="events.html">Find an Event</a></div><div class="hero-trust"><span><i class="bi bi-camera"></i> Professional<br>Photographers</span><span><i class="bi bi-shield-check"></i> Secure<br>Payments</span><span><i class="bi bi-people"></i> Support<br>Local Talent</span></div></div>
          <div class="hero-story-mark">Good Photos<br><em>Brighter<br>Stories</em></div>
          <button aria-label="Previous featured story" class="hero-arrow hero-prev" id="heroPrev"><i class="bi bi-chevron-left"></i></button><button aria-label="Next featured story" class="hero-arrow hero-next" id="heroNext"><i class="bi bi-chevron-right"></i></button>
          <div class="hero-dots" aria-label="Featured stories"><button class="active" aria-label="Show story 1" data-hero-slide="0"></button><button aria-label="Show story 2" data-hero-slide="1"></button><button aria-label="Show story 3" data-hero-slide="2"></button></div>
        </div>
        <aside class="hero-ad"><img alt="Adventure vehicle on an open road" src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=700&h=1200&q=88"><div class="hero-ad-copy"><span class="hero-ad-brand">FORD</span><strong>BUILT FOR MORE<br>THAN ROADS</strong><small>Next-gen adventure lives here.</small><a href="#events">Explore the range <i class="bi bi-arrow-right"></i></a></div></aside>
      </div>
    </section>
   <!--  <section class="search-section" id="find">
      <div class="container-xl">
        <div class="section-kicker">
          Find your photos
        </div>
        <div class="row align-items-end g-4">
          <div class="col-lg-6">
            <h2>Your moment is<br>
            <span>already here.</span></h2>
          </div>
          <div class="col-lg-6">
            <p class="muted-copy">Search the PhotoX archive by event, number or selfie. No account needed to start exploring.</p>
          </div>
        </div>
        <div class="finder-panel mt-4">
          <div aria-label="Photo search options" class="finder-tabs" role="tablist">
            <button class="finder-tab active" data-mode="event" type="button"><i class="bi bi-calendar-event"></i><span>Event</span></button> <button class="finder-tab" data-mode="number" type="button"><i class="bi bi-hash"></i><span>Bib / jersey</span></button> <button class="finder-tab" data-mode="selfie" type="button"><i class="bi bi-person-bounding-box"></i><span>Selfie search</span><small>AI</small></button>
          </div>
          <div class="finder-form">
            <div class="finder-input-wrap">
              <i class="bi bi-search"></i><input aria-label="Search PhotoX" id="searchInput" placeholder="Search events, schools or locations" type="search">
            </div><button class="btn btn-lime rounded-pill px-4" id="searchButton" type="button">Search <i class="bi bi-arrow-right ms-2"></i></button>
          </div>
          <div class="finder-meta">
            <span><i class="bi bi-shield-check"></i> Private & secure</span><span><i class="bi bi-lightning-charge"></i> 12,480 photos added this week</span>
          </div>
        </div>
      </div>
    </section> -->

    <section class="events-section" id="events">
      <div class="container-xl">
        <div class="rc-event">
        <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4">
          <div>
            <div class="section-kicker">
              Live archive
            </div>
            <h2 class="section-title">Recent events</h2>
          </div><a class="text-link text-dark" href="events.html">View all events <i class="bi bi-arrow-up-right"></i></a>
        </div>
        <div class="filter-row d-flex gap-2 mb-4 flex-wrap">
          <button class="filter-chip active" data-filter="all" type="button">All events</button> <button class="filter-chip" data-filter="running" type="button">Running</button> <button class="filter-chip" data-filter="rugby" type="button">Rugby</button> <button class="filter-chip" data-filter="cycling" type="button">Cycling</button> <button class="filter-chip" data-filter="school" type="button">School sport</button>
        </div>
        <div class="events-carousel" id="eventsCarousel">
          <div class="events-track" id="eventGrid">
            <div class="col-md-6 col-xl-3 event-item" data-category="running">
              <article class="event-card">
                <div class="event-image">
                  <img alt="Runners at a marathon" src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=800&q=85"><span class="event-tag">Running</span><button aria-label="Save event" class="save-button"><i class="bi bi-bookmark"></i></button>
                </div>
                <div class="event-details">
                  <p class="event-date">14 SEP 2026 <span>·</span> Cape Town</p>
                  <h3>City Marathon 2026</h3>
                  <p class="event-stats">24,812 photos <i class="bi bi-arrow-up-right"></i></p>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-xl-3 event-item" data-category="rugby">
              <article class="event-card">
                <div class="event-image">
                  <img alt="Rugby player in action" src="https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=800&q=85"><span class="event-tag">Rugby</span><button aria-label="Save event" class="save-button"><i class="bi bi-bookmark"></i></button>
                </div>
                <div class="event-details">
                  <p class="event-date">12 SEP 2026 <span>·</span> Stellenbosch</p>
                  <h3>Maties vs Ikeys</h3>
                  <p class="event-stats">8,430 photos <i class="bi bi-arrow-up-right"></i></p>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-xl-3 event-item" data-category="cycling">
              <article class="event-card">
                <div class="event-image">
                  <img alt="Cyclist riding outdoors" src="https://images.unsplash.com/photo-1541625602330-2277a4c46182?auto=format&fit=crop&w=800&q=85"><span class="event-tag">Cycling</span><button aria-label="Save event" class="save-button"><i class="bi bi-bookmark"></i></button>
                </div>
                <div class="event-details">
                  <p class="event-date">06 SEP 2026 <span>·</span> Paarl</p>
                  <h3>Winelands Cycle Tour</h3>
                  <p class="event-stats">16,205 photos <i class="bi bi-arrow-up-right"></i></p>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-xl-3 event-item" data-category="school">
              <article class="event-card">
                <div class="event-image">
                  <img alt="School football game" src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?auto=format&fit=crop&w=800&q=85"><span class="event-tag">School sport</span><button aria-label="Save event" class="save-button"><i class="bi bi-bookmark"></i></button>
                </div>
                <div class="event-details">
                  <p class="event-date">04 SEP 2026 <span>·</span> Pretoria</p>
                  <h3>Inter-Schools Finals</h3>
                  <p class="event-stats">5,982 photos <i class="bi bi-arrow-up-right"></i></p>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-xl-3 event-item" data-category="running">
              <article class="event-card">
                <div class="event-image">
                  <img alt="Athlete sprinting on a track" src="https://images.unsplash.com/photo-1508614999368-9260051292e5?auto=format&fit=crop&w=800&q=85"><span class="event-tag">Running</span><button aria-label="Save event" class="save-button"><i class="bi bi-bookmark"></i></button>
                </div>
                <div class="event-details">
                  <p class="event-date">30 AUG 2026 <span>·</span> Durban</p>
                  <h3>Golden Mile Run</h3>
                  <p class="event-stats">11,640 photos <i class="bi bi-arrow-up-right"></i></p>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-xl-3 event-item" data-category="rugby">
              <article class="event-card">
                <div class="event-image">
                  <img alt="Team playing rugby outdoors" src="https://images.unsplash.com/photo-1518609878373-06d740f60d8b?auto=format&fit=crop&w=800&q=85"><span class="event-tag">Rugby</span><button aria-label="Save event" class="save-button"><i class="bi bi-bookmark"></i></button>
                </div>
                <div class="event-details">
                  <p class="event-date">28 AUG 2026 <span>·</span> Johannesburg</p>
                  <h3>Highveld Rugby Cup</h3>
                  <p class="event-stats">9,214 photos <i class="bi bi-arrow-up-right"></i></p>
                </div>
              </article>
            </div>
          </div>
        </div>
        <div class="events-carousel-footer">
          <div class="events-progress">
            <span id="eventsProgressBar"></span>
          </div>
          <div class="events-carousel-controls">
            <button aria-label="Previous events" id="eventsPrev"><i class="bi bi-arrow-left"></i></button><button aria-label="Next events" id="eventsNext"><i class="bi bi-arrow-right"></i></button>
          </div>
        </div>
      </div>
    </div>
    </section>
    <section aria-labelledby="sponsor-title" class="sponsor-slot">
      <div class="container-xl">
        <div class="sponsor-heading d-flex justify-content-between align-items-end flex-wrap gap-3">
          <div>
            <div class="section-kicker">
              Sponsor spotlight
            </div>
            <h2 id="sponsor-title">Good things<br>
            <span>back the action.</span></h2>
          </div>
          <div class="sponsor-tools">
            <span class="rotation-status"><i class="bi bi-broadcast-pin"></i> 3 live sponsor placements</span><span class="format-note">Responsive · Square · Vertical</span>
          </div>
        </div>
        <div class="sponsor-carousel" id="sponsorCarousel">
          <article class="sponsor-banner sponsor-slide active format-responsive" data-brand="Gilbert Rugby Balls" data-slide="0">
            <div class="sponsor-art sponsor-art-gilbert">
              <img alt="Rugby player in action" src="https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=900&q=85"><span class="sponsor-rings"></span><span class="sponsor-label">Official partner</span>
              <div class="sponsor-monogram">
                G<span>R</span>
              </div>
            </div>
            <div class="sponsor-copy">
              <p class="banner-kicker">Gilbert Rugby Balls <span>·</span> Supporting school sport</p>
              <h3>Built for the<br>
              <em>next generation.</em></h3>
              <p>Gear for the game, made to go the distance. Discover the new training range.</p><a class="btn btn-light rounded-pill px-4 sponsor-cta" href="#events">Explore partner <i class="bi bi-arrow-up-right ms-2"></i></a>
            </div>
            <div class="sponsor-metrics">
              <div>
                <strong>15,450</strong><span>Impressions</span>
              </div>
              <div>
                <strong>1,204</strong><span>Clicks</span>
              </div>
              <div>
                <strong>7.79%</strong><span>CTR</span>
              </div>
            </div><span class="banner-count">01 <i class="bi bi-dash"></i> 03</span>
          </article>
          <article class="sponsor-banner sponsor-slide format-responsive" data-brand="ASICS" data-slide="1">
            <div class="sponsor-art sponsor-art-asics">
              <img alt="Runner crossing a finish line" src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=900&q=85"><span class="sponsor-label">Performance partner</span>
              <div class="sponsor-monogram">
                AS<span>ICS</span>
              </div>
            </div>
            <div class="sponsor-copy">
              <p class="banner-kicker">ASICS <span>·</span> Move your mind</p>
              <h3>Run your<br>
              <em>own race.</em></h3>
              <p>Find your next stride with performance gear made for the road ahead.</p><a class="btn btn-light rounded-pill px-4 sponsor-cta" href="#events">Discover ASICS <i class="bi bi-arrow-up-right ms-2"></i></a>
            </div>
            <div class="sponsor-metrics">
              <div>
                <strong>21,840</strong><span>Impressions</span>
              </div>
              <div>
                <strong>1,682</strong><span>Clicks</span>
              </div>
              <div>
                <strong>7.70%</strong><span>CTR</span>
              </div>
            </div><span class="banner-count">02 <i class="bi bi-dash"></i> 03</span>
          </article>
          <article class="sponsor-banner sponsor-slide format-responsive" data-brand="Red Bull" data-slide="2">
            <div class="sponsor-art sponsor-art-redbull">
              <img alt="Swimmer racing in a pool" src="https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=900&q=85"><span class="sponsor-label">Energy partner</span>
              <div class="sponsor-monogram">
                RB<span>+</span>
              </div>
            </div>
            <div class="sponsor-copy">
              <p class="banner-kicker">Red Bull <span>·</span> Gives you wings</p>
              <h3>Make the<br>
              <em>moment bigger.</em></h3>
              <p>Fuel the finish, the comeback, and every impossible-looking goal.</p><a class="btn btn-light rounded-pill px-4 sponsor-cta" href="#events">Meet the movement <i class="bi bi-arrow-up-right ms-2"></i></a>
            </div>
            <div class="sponsor-metrics">
              <div>
                <strong>18,220</strong><span>Impressions</span>
              </div>
              <div>
                <strong>1,510</strong><span>Clicks</span>
              </div>
              <div>
                <strong>8.29%</strong><span>CTR</span>
              </div>
            </div><span class="banner-count">03 <i class="bi bi-dash"></i> 03</span>
          </article>
        </div>
        <div class="sponsor-carousel-controls">
          <div aria-label="Sponsor banners" class="sponsor-dots">
            <button aria-label="Show Gilbert Rugby Balls banner" class="sponsor-dot active" data-slide-to="0"></button><button aria-label="Show ASICS banner" class="sponsor-dot" data-slide-to="1"></button><button aria-label="Show Red Bull banner" class="sponsor-dot" data-slide-to="2"></button>
          </div>
          <div class="sponsor-arrows">
            <button aria-label="Previous sponsor banner" id="sponsorPrev"><i class="bi bi-arrow-left"></i></button><button aria-label="Next sponsor banner" id="sponsorNext"><i class="bi bi-arrow-right"></i></button>
          </div>
        </div>
      </div>
    </section>

     <section class="how-it-works-section" id="how-it-works" aria-labelledby="how-title">
      <div class="container-xl">
         <div class="rc-event">
        <div class="how-intro row align-items-end g-4">
          <div class="col-lg-7"><div class="section-kicker">How PhotoX works</div><h2 id="how-title">From race day<br><span>to your hands.</span></h2></div>
          <div class="col-lg-5"><p class="muted-copy">A simple way to discover, choose and keep the moments that matter, whether you are in the frame or behind the camera.</p></div>
        </div>
        <div class="how-steps row g-3 mt-4">
          <div class="col-md-6 col-lg"><article class="how-step"><span class="how-number">01</span><i class="bi bi-search how-icon"></i><h3>Search</h3><p>Search events by sport, school, location or date.</p><a href="events.html">Search events <i class="bi bi-arrow-up-right"></i></a></article></div>
          <div class="col-md-6 col-lg"><article class="how-step"><span class="how-number">02</span><i class="bi bi-person-bounding-box how-icon"></i><h3>Find your photos</h3><p>Use selfie, bib or jersey search to find your moments.</p><a href="find-my-photos.html">Find photos <i class="bi bi-arrow-up-right"></i></a></article></div>
          <div class="col-md-6 col-lg"><article class="how-step"><span class="how-number">03</span><i class="bi bi-cart-plus how-icon"></i><h3>Add to cart</h3><p>Choose your favourite frames and usage option.</p><a href="gallery.html">Browse gallery <i class="bi bi-arrow-up-right"></i></a></article></div>
          <div class="col-md-6 col-lg"><article class="how-step how-step-dark"><span class="how-number">04</span><i class="bi bi-credit-card how-icon"></i><h3>Buy &amp; download</h3><p>Pay securely, then receive your high-resolution photos by download link.</p><a href="checkout.html">Go to checkout <i class="bi bi-arrow-up-right"></i></a></article></div>
        </div>
        <div class="how-footnote"><span><i class="bi bi-shield-check"></i> Secure delivery</span><span><i class="bi bi-lightning-charge"></i> No account needed to browse</span><span><i class="bi bi-heart"></i> Every frame has a story</span></div>
      </div>
    </div>
    </section>
    <section class="feature-section" id="photographers">
      <div class="container-xl">
        <div class="feature-block row align-items-center g-5">
          <div class="col-lg-6 order-lg-2">
            <div class="feature-image">
              <img alt="Sports photographer preparing a camera at an event" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=1200&q=88"><span class="image-label"><i class="bi bi-camera2"></i> Photographers<br>
              <strong>behind the moment</strong></span><span class="image-stamp">PHOTOX<br>
              <b></b></span>
            </div>
          </div>
          <div class="col-lg-6 order-lg-1">
            <div class="section-kicker">
              Made by humans
            </div>
            <h2 class="feature-title">Every frame has<br>
            <em>a point of view.</em></h2>
            <p class="muted-copy mb-4">Meet the photographers who know where to stand, when to wait, and how to catch the split second that says everything.</p><a class="btn btn-lime rounded-pill px-4" href="#photographers">Meet the photographers <i class="bi bi-arrow-up-right ms-2"></i></a>
          </div>
        </div>
      </div>
    </section>
    <section aria-labelledby="testimonials-title" class="testimonials-section" id="testimonials">
      <div class="container-xl">
        <div class="testimonial-heading d-flex justify-content-between align-items-end flex-wrap gap-3">
          <div>
            <div class="section-kicker">
              The feeling after
            </div>
            <h2 id="testimonials-title">Loved by the<br>
            <span>people in frame.</span></h2>
          </div>
          <div class="testimonial-controls">
            <button aria-label="Previous testimonial" class="testimonial-arrow" id="testimonialPrev"><i class="bi bi-arrow-left"></i></button><button aria-label="Next testimonial" class="testimonial-arrow" id="testimonialNext"><i class="bi bi-arrow-right"></i></button>
          </div>
        </div>
        <div class="testimonial-window">
          <div class="testimonial-track" id="testimonialTrack">
            <article class="testimonial-slide active">
              <div class="testimonial-portrait"><img alt="Thandi Mokoena" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=500&q=88"></div>
              <div class="testimonial-content">
                <div class="testimonial-mark">
                  “
                </div>
                <blockquote>
                  Finding my marathon photos took less than a minute. I searched my bib number, and suddenly I had the whole story of race day in front of me.
                </blockquote>
                <div class="testimonial-person">
                  <strong>Thandi Mokoena</strong><span>Runner · Cape Town Marathon</span>
                </div>
              </div>
              <div class="testimonial-meta">
                <span>PhotoX customer</span><span></span>
              </div>
            </article>
            <article class="testimonial-slide">
              <div class="testimonial-portrait"><img alt="Daniel Jacobs" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=500&q=88"></div>
              <div class="testimonial-content">
                <div class="testimonial-mark">
                  “
                </div>
                <blockquote>
                  PhotoX gives me a beautiful way to deliver thousands of images without losing the human side of event photography.
                </blockquote>
                <div class="testimonial-person">
                  <strong>Daniel Jacobs</strong><span>Photographer · Frame South</span>
                </div>
              </div>
              <div class="testimonial-meta">
                <span>PhotoX creator</span><span></span>
              </div>
            </article>
            <article class="testimonial-slide">
              <div class="testimonial-portrait"><img alt="Naledi Williams" src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=500&q=88"></div>
              <div class="testimonial-content">
                <div class="testimonial-mark">
                  “
                </div>
                <blockquote>
                  The school parents now find their children’s match photos on their own. It feels simple, thoughtful and made for real events.
                </blockquote>
                <div class="testimonial-person">
                  <strong>Naledi Williams</strong><span>Sports coordinator · School A</span>
                </div>
              </div>
              <div class="testimonial-meta">
                <span>PhotoX partner</span><span></span>
              </div>
            </article>
            <article class="testimonial-slide">
              <div class="testimonial-portrait"><img alt="Sipho Dlamini" src="https://images.unsplash.com/photo-1504593811423-6dd665756598?auto=format&fit=crop&w=500&q=88"></div>
              <div class="testimonial-content"><div class="testimonial-mark">“</div><blockquote>Our team finally has one beautiful place for every match-day memory. Parents find the images, and we get back to the sport.</blockquote><div class="testimonial-person"><strong>Sipho Dlamini</strong><span>Coach · Maties Rugby</span></div></div>
              <div class="testimonial-meta"><span>PhotoX partner</span><span></span></div>
            </article>
            <article class="testimonial-slide">
              <div class="testimonial-portrait"><img alt="Ayesha Khan" src="https://images.unsplash.com/photo-1531123897727-8f129e1688ce?auto=format&fit=crop&w=500&q=88"></div>
              <div class="testimonial-content"><div class="testimonial-mark">“</div><blockquote>The quality is beautiful, the download was instant, and I found photos I did not even know had been taken.</blockquote><div class="testimonial-person"><strong>Ayesha Khan</strong><span>Customer · Winelands Cycle Tour</span></div></div>
              <div class="testimonial-meta"><span>PhotoX customer</span><span></span></div>
            </article>
          </div>
        </div>
        <div aria-label="Testimonials" class="testimonial-dots">
          <button aria-label="Show first testimonial" class="testimonial-dot active" data-testimonial="0"></button><button aria-label="Show second testimonial" class="testimonial-dot" data-testimonial="1"></button><button aria-label="Show third testimonial" class="testimonial-dot" data-testimonial="2"></button><button aria-label="Show fourth testimonial" class="testimonial-dot" data-testimonial="3"></button><button aria-label="Show fifth testimonial" class="testimonial-dot" data-testimonial="4"></button>
        </div>
      </div>
    </section>
    

    
   
    <section class="app-section py-3" id="download-app" aria-labelledby="app-title">
      <div class="container-xl">
        <div class="app-panel">
          <div class="app-store-badges"><a href="#" class="store-badge" aria-label="Download on the App Store"><i class="bi bi-apple"></i><span><small>Download on the</small>App Store</span></a><a href="#" class="store-badge" aria-label="Get it on Google Play"><i class="bi bi-google-play"></i><span><small>Get it on</small>Google Play</span></a></div>
          <div class="app-web-copy"><div class="section-kicker">PhotoX online</div><h2>Your best moments<br><em>live on the web.</em></h2><p>Find your event photos online, search by selfie or bib number, choose your favourite frames and download them securely from any device.</p><div class="store-buttons"></div></div>
          <div class="app-copy"><div class="section-kicker">PhotoX in your pocket</div><h2 id="app-title">The best moments<br><em>travel with you.</em></h2><p>Get event alerts, find your photos faster and keep your favourite frames close wherever the day takes you.</p><div class="store-buttons"><a href="#" class="store-button" aria-label="Download on the App Store"><i class="bi bi-apple"></i><span><small>Download on the</small>App Store</span></a><a href="#" class="store-button" aria-label="Get it on Google Play"><i class="bi bi-google-play"></i><span><small>Get it on</small>Google Play</span></a></div><div class="app-notes"><span><i class="bi bi-bell"></i> Event alerts</span><span><i class="bi bi-phone"></i> Mobile galleries</span></div></div><div class="app-device"><div class="phone-frame"><div class="phone-speaker"></div><div class="phone-screen"><div class="phone-topline"><span>PHOTO<span>X</span></span><i class="bi bi-bell"></i></div><div class="phone-heading">Your moments<br><strong>are here.</strong></div><div class="phone-photo"><img src="https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=600&q=85" alt="Runner on a track"></div><div class="phone-card"><span>City Marathon</span><strong>87 photos found</strong></div></div></div><span class="app-orbit orbit-one"></span><span class="app-orbit orbit-two"></span><span class="app-badge"><i class="bi bi-stars"></i> Built for<br>the moment</span></div>
        </div>
      </div>
    </section>
    <section class="stories-section" id="stories">
      <div class="container-xl">
        <div class="section-kicker">
          From the field
        </div>
        <div class="d-flex justify-content-between align-items-end mb-4">
          <h2 class="section-title">The PhotoX journal</h2><a class="text-link d-none d-sm-block text-dark" href="blog.html">Read all stories <i class="bi bi-arrow-up-right"></i></a>
        </div>
        <div class="row g-4">
          <div class="col-lg-7">
            <article class="story-card story-large">
              <img alt="Athlete running on a track" src="https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=1200&q=85">
              <div class="story-overlay">
                <span>FIELD NOTES / 08.09.26</span>
                <h3>Why the finish line is never the whole story.</h3><a aria-label="Read story" href="article.html"><i class="bi bi-arrow-up-right"></i></a>
              </div>
            </article>
          </div>
          <div class="col-lg-5">
            <article class="story-card story-small">
              <img alt="Cyclist climbing a road" src="https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=800&q=85">
              <div class="story-overlay">
                <span>THE LONG RIDE</span>
                <h3>Chasing light up Ou Kaapse Weg.</h3><a aria-label="Read story" href="article.html"><i class="bi bi-arrow-up-right"></i></a>
              </div>
            </article>
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer class="footer footer-premium"><div class="container-xl">
   <div class="row g-5 footer-main"><div class="col-lg-5"><a class="footer-logo" href="index.html"><img src="logo.png" alt="PhotoX" style="width:150px"></a><p class="footer-copy">The feeling of being there,<br>kept in a frame.</p><div class="footer-social d-flex gap-3"><a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a><a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a><a href="#" aria-label="Linkedin"><i class="bi bi-linkedin"></i></a></div></div><div class="col-6 col-lg-2"><p class="footer-label">Explore</p><a href="events.html">Events</a><a href="photographers.html">Photographers</a><a href="blog.html">Journal</a><a href="sponsors.html">Sponsors</a></div><div class="col-6 col-lg-2"><p class="footer-label">For creators</p><a href="photographer-dashboard.html">Creator login</a><a href="upload.html">Upload photos</a><a href="photographers.html">Join PhotoX</a><a href="messages.html">Support</a></div><div class="col-12 col-lg-3"><p class="footer-label">Stay in the frame</p><p class="footer-small">New events, fresh galleries and stories from the field.</p><div class="newsletter"><input aria-label="Email address" placeholder="Your email address" type="email"><button aria-label="Subscribe"><i class="bi bi-arrow-up-right"></i></button></div></div></div><div class="footer-bottom"><span>© 2026 PhotoX</span><span>Privacy · Terms ·</span><span>Made for the moments <i class="bi bi-stars"></i></span></div></div></footer>
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div aria-live="polite" class="toast" id="photoToast" role="status">
      <div class="toast-body d-flex align-items-center gap-2">
        <i class="bi bi-check-circle-fill"></i><span>Search ready.</span>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
  </script> 
  <script src="app.js">
  </script>
</body>
</html>