<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="PhotoX is the sports and event photography marketplace for finding your moments.">
  <title>PhotoX | Find your moment</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
</head>
<body class="page-login">
  <nav aria-label="Main navigation" class="navbar navbar-expand-lg py-2">
    <div class="container-xl">
      <a aria-label="PhotoX home" class="navbar-brand d-flex align-items-center gap-2" href="index.html"><img alt="PhotoX" src="logo.png"></a> <button aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler border-0 p-0" data-bs-target="#mainNav" data-bs-toggle="collapse" type="button"><i class="bi bi-list fs-2"></i></button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav mx-auto gap-lg-3 mt-3 mt-lg-0">
          <li class="nav-item"><a class="nav-link active" href="index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="events.html">Explore</a></li>
          <li class="nav-item"><a class="nav-link" href="photographers.html">Photographers</a></li>
          <li class="nav-item"><a class="nav-link" href="membership.html">Membership</a></li>
          <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
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

  <main class="login-page">
    <div class="login-shell">
      <section class="login-visual" aria-label="PhotoX welcome">
        <div class="login-count">PhotoX / Member access</div>
        <div><h1>Your moments,<br><em>waiting.</em></h1><p class="login-quote mt-4">Sign in to revisit your galleries, track orders, and keep every finish line close.</p></div>
        <div class="d-flex justify-content-between align-items-end"><span class="login-count">Find. Feel. Keep.</span><i class="bi bi-arrow-up-right fs-3 text-warning"></i></div>
      </section>
      <section class="login-form-panel">
        <div class="eyebrow-blue">Welcome back</div>
        <h2 class="mt-2">Log in to PhotoX.</h2>
        <p class="login-help mt-2">Access your saved photos and creator workspace.</p>
        <div class="login-tabs mt-4">
          <input checked class="login-tab-input" id="customerTab" name="login-tab" type="radio">
          <label class="login-tab-label" for="customerTab"><i class="bi bi-person-heart"></i> Customer</label>
          <input class="login-tab-input" id="photographerTab" name="login-tab" type="radio">
          <label class="login-tab-label" for="photographerTab"><i class="bi bi-camera"></i> Photographer</label>

          <div class="login-tab-panel customer-login-panel">
            <p class="login-tab-help">Sign in to view saved photos, orders and favourite events.</p>
            <form action="customer-dashboard.html" method="get">
              <label class="form-label" for="customerEmail">Email address</label>
              <input class="form-control" id="customerEmail" name="email" type="email" placeholder="you@example.com" autocomplete="email">
              <label class="form-label mt-3" for="customerPassword">Password</label>
              <input class="form-control" id="customerPassword" name="password" type="password" placeholder="Enter your password" autocomplete="current-password">
              <div class="form-check mt-3"><input class="form-check-input" id="customerRemember" name="remember" type="checkbox"><label class="form-check-label small text-secondary" for="customerRemember">Keep me signed in</label></div>
              <button class="btn login-submit rounded-pill w-100 mt-4" type="submit">Log In <i class="bi bi-arrow-right ms-2"></i></button>
            </form>
          </div>

          <div class="login-tab-panel photographer-login-panel">
            <p class="login-tab-help">Sign in to manage bookings, galleries, earnings and your creator profile.</p>
            <form action="photographer-dashboard.html" method="get">
              <label class="form-label" for="photographerEmail">Photographer email</label>
              <input class="form-control" id="photographerEmail" name="email" type="email" placeholder="you@example.com" autocomplete="email">
              <label class="form-label mt-3" for="photographerPassword">Password</label>
              <input class="form-control" id="photographerPassword" name="password" type="password" placeholder="Enter your password" autocomplete="current-password">
              <div class="form-check mt-3"><input class="form-check-input" id="photographerRemember" name="remember" type="checkbox"><label class="form-check-label small text-secondary" for="photographerRemember">Keep me signed in</label></div>
              <button class="btn login-submit rounded-pill w-100 mt-4" type="submit">Log In<i class="bi bi-arrow-right ms-2"></i></button>
            </form>
          </div>
        </div>
        <div class="login-divider">or continue with</div>
        <button class="btn social-login rounded-pill w-100" type="button" data-toast="Google login selected"><i class="bi bi-google me-2"></i> Continue with Google</button>
        <p class="text-center login-help mt-4 mb-0">New to PhotoX? <a href="signup.html">Create an account</a></p>
        <div class="login-trust mt-4"><span><i class="bi bi-shield-check"></i> Secure access</span><span><i class="bi bi-lock"></i> POPIA aware</span></div>
      </section>
    </div>
      <aside class="site-ad-banner" aria-label="Sponsored placement">
        <a class="site-ad-link" href="events.html"><img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&h=360&q=88" alt="Adventure vehicle on an open road"><span class="site-ad-overlay"></span><span class="site-ad-copy"><small>PHOTOX PARTNER</small><strong>BUILT FOR MORE<br>THAN ROADS</strong><span>Explore events <i class="bi bi-arrow-up-right"></i></span></span></a>
      </aside>
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