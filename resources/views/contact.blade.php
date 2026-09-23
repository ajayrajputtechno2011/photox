<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Contact PhotoX for support, partnerships and event photography enquiries.">
  <title>PhotoX | Contact</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <script defer src="site-ad.js"></script>
  
</head>
<body class="page-events  page-contact">
  <nav aria-label="Main navigation" class="navbar navbar-expand-lg py-2">
    <div class="container-xl">
      <a aria-label="PhotoX home" class="navbar-brand d-flex align-items-center gap-2" href="index.html"><img alt="PhotoX" src="logo.png"></a>
      <button aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler border-0 p-0" data-bs-target="#mainNav" data-bs-toggle="collapse" type="button"><i class="bi bi-list fs-2"></i></button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav mx-auto gap-lg-3 mt-3 mt-lg-0">
          <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="events.html">Explore</a></li>
          <li class="nav-item"><a class="nav-link" href="photographers.html">Photographers</a></li>
          <li class="nav-item"><a class="nav-link" href="membership.html">Membership</a></li>
          <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
          <li class="nav-item"><a class="nav-link active" href="contact.html">Contact</a></li>
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

  <main class="contact-page-main">
    <section class="events-page-hero">
      <aside class="hero-ad-carousel" aria-label="Sponsored placements">
        <div class="hero-ad-slide active"><img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=700&h=1200&q=88" alt="Adventure vehicle on an open road"><span class="hero-ad-slide-copy"><strong>BUILT FOR MORE<br>THAN ROADS</strong><small>Explore the range</small></span></div><div class="hero-ad-slide"><img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=700&h=1200&q=88" alt="Red running shoe"><span class="hero-ad-slide-copy"><strong>KEEP MOVING.</strong><small>Performance partner</small></span></div><div class="hero-ad-slide"><img src="https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=700&h=1200&q=88" alt="Swimmer in a pool"><span class="hero-ad-slide-copy"><strong>MAKE A SPLASH.</strong><small>Discover the next event</small></span></div><div class="hero-ad-controls"><button data-ad-prev type="button" aria-label="Previous ad"><i class="bi bi-chevron-left"></i></button><div class="hero-ad-dots"><button class="active" data-ad-slide="0" type="button" aria-label="Ad 1"></button><button data-ad-slide="1" type="button" aria-label="Ad 2"></button><button data-ad-slide="2" type="button" aria-label="Ad 3"></button></div><button data-ad-next type="button" aria-label="Next ad"><i class="bi bi-chevron-right"></i></button></div>
      </aside>
      <div class="container-xl contact-hero-inner">
        <div class="contact-badge"><i class="bi bi-chat-heart"></i> Contact PhotoX</div>
        <h1>Let’s talk about<br><em>your next frame.</em></h1>
        <p>Questions about a gallery, a photographer membership or your next event? Our team is ready to help.</p>

         <div class="hero-actions">
         
          <a class="btn btn-lime rounded-pill px-4" href="#contact">Contact Us</a>
        </div>
      </div>
    </section>

    <section class="contact-section" id="contact">
      <div class="container-xl contact-grid">
        <div class="contact-panel">
          <div class="panel-label">SEND A MESSAGE</div>
          <h2>Tell us what you need.</h2>
          <p class="contact-panel-intro">Share a few details and the right person will get back to you.</p>
          <form class="contact-form" action="contact.html" method="get">
            <div class="contact-form-grid">
              <label><span>Your name</span><input name="name" type="text" placeholder="Your full name" required></label>
              <label><span>Email address</span><input name="email" type="email" placeholder="you@example.com" required></label>
              <label><span>I am a</span><select name="role"><option>Customer</option><option>Photographer</option><option>Event organiser</option><option>School or club</option><option>Sponsor</option></select></label>
              <label><span>Subject</span><input name="subject" type="text" placeholder="What can we help with?"></label>
              <label class="contact-form-wide"><span>Message</span><textarea name="message" placeholder="Tell us a little more..." required></textarea></label>
            </div>
            <button class="btn btn-lime rounded-pill px-4" type="submit">Send enquiry <i class="bi bi-arrow-up-right ms-2"></i></button>
          </form>
        </div>

        <aside class="contact-details" aria-label="Contact details">
          <div class="panel-label">GET IN TOUCH</div>
          <h2>We’re close by.</h2>
          <p>For quick questions, reach us through any of the channels below.</p>
          <div class="info-stack">
            <a class="info-item" href="mailto:hello@photox.co.za"><i class="bi bi-envelope"></i><span><strong>Email us</strong><small>hello@photox.co.za</small></span><i class="bi bi-arrow-up-right info-arrow"></i></a>
            <a class="info-item" href="tel:+27214567890"><i class="bi bi-telephone"></i><span><strong>Call the team</strong><small>+27 21 456 7890</small></span><i class="bi bi-arrow-up-right info-arrow"></i></a>
            <div class="info-item"><i class="bi bi-geo-alt"></i><span><strong>Head office</strong><small>42 Long Street, Cape Town</small></span></div>
            <div class="info-item"><i class="bi bi-clock-history"></i><span><strong>Support hours</strong><small>Mon–Fri · 08:00–17:00 SAST</small></span></div>
          </div>
          <div class="contact-response"><i class="bi bi-stars"></i><span><strong>Typical response time</strong><small>Within one business day.</small></span></div>
        </aside>
      </div>
    </section>

    <section class="contact-bottom-section">
      <div class="container-xl contact-bottom-card">
        <div><span class="panel-label">FOR CREATORS & EVENTS</span><h2>Ready to put your moments in motion?</h2></div>
        <a class="btn btn-lime rounded-pill px-4" href="signup.html">Join PhotoX <i class="bi bi-arrow-up-right ms-2"></i></a>
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
          <div class="footer-social d-flex gap-3"><a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a><a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a><a href="#" aria-label="Linkedin"><i class="bi bi-linkedin"></i></a></div>
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
