<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Learn about PhotoX and how we help communities preserve the moments that matter most.">
  <title>PhotoX | About</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <script defer src="site-ad.js"></script>
  <style>
    body.page-blog .hero-layout {
      display: grid;
      grid-template-columns: 1.1fr 0.9fr;
      gap: 36px;
      align-items: center;
    }
    body.page-blog .hero-ad-slot {
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    body.page-blog .hero-ad-carousel {
      position: relative !important;
      top: auto !important;
      right: auto !important;
      transform: none !important;
      width: 100% !important;
      max-width: 540px !important;
      height: 330px !important;
      margin: 0 !important;
      box-shadow: 0 16px 36px rgba(0, 0, 0, 0.4);
    }
    @media (max-width: 991px) {
      body.page-blog .hero-layout {
        grid-template-columns: 1fr;
      }
      body.page-blog .hero-ad-carousel {
        margin: 24px auto 0 !important;
        height: auto !important;
        aspect-ratio: 16 / 9 !important;
      }
    }
  </style>
</head>
<body class="page-blog">
  <nav aria-label="Main navigation" class="navbar navbar-expand-lg py-2">
    <div class="container-xl">
      <a aria-label="PhotoX home" class="navbar-brand d-flex align-items-center gap-2" href="/"><img alt="PhotoX" src="logo.png"></a>
      <button aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler border-0 p-0" data-bs-target="#mainNav" data-bs-toggle="collapse" type="button"><i class="bi bi-list fs-2"></i></button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav mx-auto gap-lg-3 mt-3 mt-lg-0">
          <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/events">Explore</a></li>
          <li class="nav-item"><a class="nav-link" href="/photographers">Photographers</a></li>
          <li class="nav-item"><a class="nav-link" href="/membership">Membership</a></li>
          <li class="nav-item"><a class="nav-link active" href="/about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
        </ul>
        <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
          <div class="header-search d-none d-xl-flex"><i class="bi bi-search"></i><input aria-label="Search photos, people, teams or events" placeholder="Search photos, people, teams or events..." type="search"></div>
          <a class="header-cart" href="/cart" aria-label="Open cart"><i class="bi bi-cart3"></i><span>0</span></a>
          <a class="text-link d-none d-sm-inline" href="/login"><i class="bi bi-person me-1"></i>Login</a>
          <a class="btn btn-lime rounded-pill px-4" href="/signup">Sign Up <i class="bi bi-arrow-up-right ms-1"></i></a>
        </div>
      </div>
    </div>
  </nav>

  <main>
    <section class="about-hero">
      <div class="container-xl hero-layout">
        <div>
          <div class="section-kicker" style="background:rgba(255,255,255,.08);border-color:rgba(255,255,255,.13);color:#dfeafe;">About PhotoX</div>
          <h1>Stories that <em>last longer.</em></h1>
          <p>PhotoX brings athletes, families, clubs, schools and sponsors into one elegant digital storefront for sports and event photography. Our focus is simple: make outstanding images easy to discover, easy to buy, and easy to revisit.</p>
          <div class="hero-actions">
            <a class="btn btn-lime rounded-pill px-4" href="/events">Explore events</a>
            <a class="btn btn-outline-light rounded-pill px-4" href="/photographers">Meet creators</a>
          </div>
        </div>

        <div class="hero-ad-slot">
          @include('web.partials.hero-ad-carousel')
        </div>
      </div>
    </section>

    <section class="section-wrap">
      <div class="container-xl">
        <div class="section-header">
          <div>
            <div class="section-kicker">Our focus</div>
            <h2 class="section-title">A platform designed for action and access</h2>
          </div>
        </div>
        <div class="stats-panel">
          <div class="stats-grid">
            <div class="stat-box"><span>Photographers</span><strong>480+</strong></div>
            <div class="stat-box"><span>Events</span><strong>1,240</strong></div>
            <div class="stat-box"><span>Photos</span><strong>3.2M</strong></div>
            <div class="stat-box"><span>Customer love</span><strong>98%</strong></div>
          </div>
          <div class="tag-list">
            <span>School sport</span>
            <span>Running</span>
            <span>Rugby</span>
            <span>Cycling</span>
            <span>Corporate events</span>
            <span>Hockey</span>
          </div>
        </div>
      </div>
    </section>

    <section class="section-wrap" style="background: rgba(232,240,255,.75);">
      <div class="container-xl">
        <div class="section-header">
          <div>
            <div class="section-kicker">What we believe</div>
            <h2 class="section-title">Better access, lasting memories</h2>
          </div>
        </div>
        <div class="mission-grid">
          <article class="mission-card">
            <i class="bi bi-camera-fill"></i>
            <h3>Beautiful storytelling</h3>
            <p>We help photographers present galleries in a way that feels premium and easy to explore on any screen.</p>
          </article>
          <article class="mission-card">
            <i class="bi bi-wallet2"></i>
            <h3>Simple commerce</h3>
            <p>Buying, saving and downloading images should feel effortless for families, athletes and event organisers.</p>
          </article>
          <article class="mission-card">
            <i class="bi bi-people-fill"></i>
            <h3>Community connection</h3>
            <p>We build digital spaces where schools, clubs and communities can gather around shared moments.</p>
          </article>
        </div>
      </div>
    </section>

    <section class="section-wrap">
      <div class="container-xl">
        <div class="section-header">
          <div>
            <div class="section-kicker">Latest insights</div>
            <h2 class="section-title">From the PhotoX journal</h2>
          </div>
          <a class="inline-link" href="/contact">Request editorial</a>
        </div>
        <div class="story-grid">
          <article class="story-card">
            <img src="https://images.unsplash.com/photo-1517466787929-bc90951d0974?auto=format&fit=crop&w=800&q=80" alt="Football match">
            <div class="body">
              <div class="meta">Community · 5 min</div>
              <h3>Why schools choose a dedicated event archive.</h3>
              <p>It creates a lasting digital legacy for players, families and supporters.</p>
              <a href="/contact">Read article <i class="bi bi-arrow-up-right"></i></a>
            </div>
          </article>
          <article class="story-card">
            <img src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=800&q=80" alt="Runner crossing finish line">
            <div class="body">
              <div class="meta">Marketing · 4 min</div>
              <h3>A smarter way to sell race-day memories.</h3>
              <p>Better discovery and cleaner pricing improve conversion and engagement.</p>
              <a href="/contact">Read article <i class="bi bi-arrow-up-right"></i></a>
            </div>
          </article>
          <article class="story-card">
            <img src="https://images.unsplash.com/photo-1541625602330-2277a4c46182?auto=format&fit=crop&w=800&q=80" alt="Cyclist racing">
            <div class="body">
              <div class="meta">Photography · 6 min</div>
              <h3>What makes a gallery feel premium on mobile.</h3>
              <p>Responsive storytelling, secure previews and simple ordering create trust.</p>
              <a href="/contact">Read article <i class="bi bi-arrow-up-right"></i></a>
            </div>
          </article>
        </div>
      </div>
    </section>

    <section class="section-wrap" style="background: rgba(232,240,255,.75); padding-top:0;">
      <div class="container-xl">
        <div class="section-header">
          <div>
            <div class="section-kicker">Our journey</div>
            <h2 class="section-title">How PhotoX grew</h2>
          </div>
        </div>
        <div class="timeline">
          <div class="timeline-box">
            <div class="year">2019</div>
            <h4>Started with one idea</h4>
            <p>We set out to make sports galleries easier to view and buy.</p>
          </div>
          <div class="timeline-box">
            <div class="year">2021</div>
            <h4>Schools joined in</h4>
            <p>Community events and school fixtures became a major part of our network.</p>
          </div>
          <div class="timeline-box">
            <div class="year">2023</div>
            <h4>Scaled across regions</h4>
            <p>We expanded across sporting communities and event publishers.</p>
          </div>
          <div class="timeline-box">
            <div class="year">2026</div>
            <h4>Built for premium experiences</h4>
            <p>Today we focus on elegant discovery, trust and memorable digital access.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="section-wrap" style="padding-top:0;">
      <div class="container-xl">
        <div class="cta-panel">
          <div>
            <div class="section-kicker" style="color:#dfeafe;">Join the network</div>
            <h3>Start building the stories behind the action.</h3>
            <p>Photographers, clubs and sponsors use PhotoX to publish galleries with more clarity and better reach.</p>
          </div>
          <a class="btn btn-lime rounded-pill px-4" href="/signup">Join PhotoX</a>
        </div>
      </div>
    </section>
    <aside class="site-ad-banner" aria-label="Sponsored placement">
      <a class="site-ad-link" href="/events"><img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&h=360&q=88" alt="Adventure vehicle on an open road"><span class="site-ad-overlay"></span><span class="site-ad-copy"><small>PHOTOX PARTNER</small><strong>BUILT FOR MORE<br>THAN ROADS</strong><span>Explore events <i class="bi bi-arrow-up-right"></i></span></span></a>
    </aside>
  </main>

  <footer class="footer footer-premium">
    <div class="container-xl">
      <div class="row g-5 footer-main">
        <div class="col-lg-5">
          <a class="footer-logo" href="/"><img src="logo.png" alt="PhotoX" style="width:150px"></a>
          <p class="footer-copy">The feeling of being there,<br>kept in a frame.</p>
          <div class="footer-social d-flex gap-3">
            <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" aria-label="Linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
        <div class="col-6 col-lg-2"><p class="footer-label">Explore</p><a href="/events">Events</a><a href="/photographers">Photographers</a><a href="/blog">Journal</a><a href="/contact">Contact</a></div>
        <div class="col-6 col-lg-2"><p class="footer-label">For creators</p><a href="/login">Creator login</a><a href="/signup">Join PhotoX</a><a href="/events">Upload photos</a><a href="/blog">Support</a></div>
        <div class="col-12 col-lg-3"><p class="footer-label">Stay in the frame</p><p class="footer-small">New events, fresh galleries and stories from the field.</p><div class="newsletter"><input aria-label="Email address" placeholder="Your email address" type="email"><button aria-label="Subscribe"><i class="bi bi-arrow-up-right"></i></button></div></div>
      </div>
      <div class="footer-bottom"><span>© 2026 PhotoX</span><span>Privacy · Terms ·</span><span>Made for the moments <i class="bi bi-stars"></i></span></div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
