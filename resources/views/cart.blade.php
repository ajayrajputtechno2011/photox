<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Review your PhotoX photo cart before checkout.">
  <title>PhotoX | Cart</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <script defer src="site-ad.js"></script>
</head>
<body class="page-cart">
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
          <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
        </ul>
        <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
          <div class="header-search d-none d-xl-flex"><i class="bi bi-search"></i><input aria-label="Search photos" placeholder="Search photos, people, teams or events..." type="search"></div>
          <a class="header-cart active" href="cart.html" aria-label="Open cart"><i class="bi bi-cart3"></i><span>0</span></a>
          <a class="text-link d-none d-sm-inline" href="login.html"><i class="bi bi-person me-1"></i>Login</a>
          <a class="btn btn-lime rounded-pill px-4" href="signup.html">Sign Up <i class="bi bi-arrow-up-right ms-1"></i></a>
        </div>
      </div>
    </div>
  </nav>

  <main class="cart-page-main">
    <section class="cart-hero">
      <aside class="hero-ad-carousel" aria-label="Sponsored placements">
        <div class="hero-ad-slide active"><img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=700&h=1200&q=88" alt="Adventure vehicle on an open road"><span class="hero-ad-slide-copy"><strong>BUILT FOR MORE<br>THAN ROADS</strong><small>Explore the range</small></span></div><div class="hero-ad-slide"><img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=700&h=1200&q=88" alt="Red running shoe"><span class="hero-ad-slide-copy"><strong>KEEP MOVING.</strong><small>Performance partner</small></span></div><div class="hero-ad-slide"><img src="https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=700&h=1200&q=88" alt="Swimmer in a pool"><span class="hero-ad-slide-copy"><strong>MAKE A SPLASH.</strong><small>Discover the next event</small></span></div><div class="hero-ad-controls"><button data-ad-prev type="button" aria-label="Previous ad"><i class="bi bi-chevron-left"></i></button><div class="hero-ad-dots"><button class="active" data-ad-slide="0" type="button" aria-label="Ad 1"></button><button data-ad-slide="1" type="button" aria-label="Ad 2"></button><button data-ad-slide="2" type="button" aria-label="Ad 3"></button></div><button data-ad-next type="button" aria-label="Next ad"><i class="bi bi-chevron-right"></i></button></div>
      </aside>
      <div class="container-xl">
        <span class="section-kicker">YOUR CART</span>
        <h1>Keep the moments<br><em>you want to take home.</em></h1>
        <p>Your selected digital photos will appear here. Cart count is currently ready for the development flow.</p>
      </div>
    </section>

    <section class="cart-section">
      <div class="container-xl cart-layout">
        <div class="cart-list-card">
          <div class="cart-section-heading"><div><span class="panel-label">PHOTO SELECTION</span><h2>Your cart is empty</h2></div><span class="cart-count-label">0 items</span></div>
          <div class="cart-empty-state"><i class="bi bi-cart3"></i><h3>No photos added yet</h3><p>Browse an event gallery and use the cart icon on any photo to start your selection.</p><a class="btn btn-lime rounded-pill px-4" href="browse-photos.html">Browse photos <i class="bi bi-arrow-right ms-2"></i></a></div>
        </div>
        <aside class="cart-summary-card">
          <span class="panel-label">ORDER SUMMARY</span>
          <h2>Ready when you are.</h2>
          <div class="summary-line"><span>Photos</span><strong>0</strong></div>
          <div class="summary-line"><span>Subtotal</span><strong>R0</strong></div>
          <div class="summary-total"><span>Total</span><strong>R0</strong></div>
          <a class="btn btn-lime rounded-pill w-100 mt-3 disabled" href="checkout.html" aria-disabled="true">Continue to checkout</a>
          <p class="summary-note"><i class="bi bi-shield-check"></i> Secure digital delivery through PhotoX.</p>
        </aside>
      </div>
    </section>
    <aside class="site-ad-banner" aria-label="Sponsored placement">
      <a class="site-ad-link" href="events.html"><img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&h=360&q=88" alt="Adventure vehicle on an open road"><span class="site-ad-overlay"></span><span class="site-ad-copy"><small>PHOTOX PARTNER</small><strong>BUILT FOR MORE<br>THAN ROADS</strong><span>Explore events <i class="bi bi-arrow-up-right"></i></span></span></a>
    </aside>
  </main>

  <footer class="footer footer-premium">
    <div class="container-xl"><div class="row g-5 footer-main">
      <div class="col-lg-5"><a class="footer-logo" href="index.html"><img src="logo.png" alt="PhotoX" style="width:150px"></a><p class="footer-copy">The feeling of being there,<br>kept in a frame.</p></div>
      <div class="col-6 col-lg-2"><p class="footer-label">Explore</p><a href="events.html">Events</a><a href="browse-photos.html">Browse photos</a><a href="photographers.html">Photographers</a><a href="contact.html">Contact</a></div>
      <div class="col-6 col-lg-2"><p class="footer-label">Your order</p><a href="cart.html">Cart</a><a href="checkout.html">Checkout</a><a href="login.html">Login</a></div>
      <div class="col-12 col-lg-3"><p class="footer-label">Stay in the frame</p><p class="footer-small">New events, fresh galleries and stories from the field.</p></div>
    </div><div class="footer-bottom"><span>© 2026 PhotoX</span><span>Privacy · Terms ·</span><span>Made for the moments <i class="bi bi-stars"></i></span></div></div>
  </footer>
</body>
</html>
