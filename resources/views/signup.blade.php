<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Create your PhotoX account to save galleries, track orders and keep your favourite moments.">
  <title>PhotoX | Create your account</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
</head>
<body class="page-signup">
  <nav aria-label="Main navigation" class="navbar navbar-expand-lg py-2">
    <div class="container-xl">
      <a aria-label="PhotoX home" class="navbar-brand d-flex align-items-center gap-2" href="index.html"><img alt="PhotoX" src="logo.png"></a> <button aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler border-0 p-0" data-bs-target="#mainNav" data-bs-toggle="collapse" type="button"><i class="bi bi-list fs-2"></i></button>
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
          <div class="header-search d-none d-xl-flex"><i class="bi bi-search"></i><input aria-label="Search photos, people, teams or events" placeholder="Search photos, people, teams or events..." type="search"></div>
          <a class="header-cart" href="cart.html" aria-label="Open cart"><i class="bi bi-cart3"></i><span>0</span></a>
          <a class="text-link d-none d-sm-inline" href="login.html"><i class="bi bi-person me-1"></i>Login</a> <a class="btn btn-lime rounded-pill px-4" href="signup.html" aria-current="page">Sign Up <i class="bi bi-arrow-up-right ms-1"></i></a>
        </div>
      </div>
    </div>
  </nav>

  <main class="login-page">
    <div class="login-shell">
      <section class="login-visual" aria-label="PhotoX account benefits">
        <div class="login-count">PhotoX / Join the frame</div>
        <div>
          <h1>Keep your<br><em>best moments.</em></h1>
          <p class="login-quote mt-4">Create your free account to save galleries, track orders and return to the moments worth keeping.</p>
        </div>
        <div class="d-flex justify-content-between align-items-end"><span class="login-count">Find. Feel. Keep.</span><i class="bi bi-arrow-up-right fs-3 text-warning"></i></div>
      </section>
      <section class="login-form-panel">
        <div class="eyebrow-blue">Welcome to PhotoX</div>
        <h2 class="mt-2 mb-2">Create your account.</h2>
        
        <form id="signupForm" action="signup.html" method="get">
          <fieldset class="signup-choice">
            <legend>Choose your PhotoX account</legend>
            <div class="signup-choice-grid">
              <label class="signup-choice-card">
                <input checked name="account-type" type="radio" value="member">
                <span class="signup-choice-content">
                  <i class="bi bi-person-heart"></i>
                  <strong>PhotoX member</strong>
                  <small>Free to join. Browse and buy photos.</small>
                </span>
              </label>
              <label class="signup-choice-card">
                <input name="account-type" type="radio" value="photographer">
                <span class="signup-choice-content">
                  <i class="bi bi-camera"></i>
                  <strong>Photographer</strong>
                  <small>Choose a creator plan for your workspace.</small>
                </span>
              </label>
            </div>
          </fieldset>

          <label class="form-label mt-4" for="signupName">Full name</label>
          <input class="form-control" id="signupName" type="text" placeholder="Your full name" autocomplete="name" required>
          <label class="form-label mt-3" for="signupEmail">Email address</label>
          <input class="form-control" id="signupEmail" type="email" placeholder="you@example.com" autocomplete="email" required>

          <fieldset class="signup-tiers mt-4" id="photographerTiers" hidden>
            <legend>Choose your photographer membership tier</legend>
            <p class="signup-section-help">Photographers can choose a membership plan for their creator workspace.</p>
            <div class="tier-grid">
              <label class="tier-card">
                <input checked name="photographer-tier" type="radio" value="starter">
                <span class="tier-card-content">
                  <span class="tier-name">Starter</span>
                  <strong>Free</strong>
                  <small>Basic portfolio and booking enquiries.</small>
                </span>
              </label>
              <label class="tier-card tier-card-featured">
                <input name="photographer-tier" type="radio" value="pro">
                <span class="tier-card-content">
                  <span class="tier-name">Pro</span>
                  <strong>R 299 <small>/ month</small></strong>
                  <small>More gallery space</small>
                </span>
                <b class="tier-badge">Popular</b>
              </label>
              <label class="tier-card">
                <input name="photographer-tier" type="radio" value="studio">
                <span class="tier-card-content">
                  <span class="tier-name">Studio</span>
                  <strong>R 599 <small>/ month</small></strong>
                  <small>Unlimited galleries</small>
                </span>
              </label>
            </div>
          </fieldset>

          <label class="form-label mt-3" for="signupPassword">Password</label>
          <div class="input-group"><input class="form-control" id="signupPassword" type="password" placeholder="Create a password" autocomplete="new-password" minlength="8" required><button class="btn btn-outline-secondary" type="button" aria-label="Show password" id="toggleSignupPassword"><i class="bi bi-eye"></i></button></div>
          <div class="form-check mt-3"><input class="form-check-input" id="terms" type="checkbox" required><label class="form-check-label small text-secondary" for="terms">I agree to the PhotoX terms and privacy policy.</label></div>
          <button class="btn login-submit rounded-pill w-100 mt-4" type="submit">Create account <i class="bi bi-arrow-right ms-2"></i></button>
        </form>
        <div class="login-divider">or continue with</div>
        <button class="btn social-login rounded-pill w-100" type="button"><i class="bi bi-google me-2"></i> Continue with Google</button>
        <p class="text-center login-help mt-4 mb-0">Already have an account? <a href="login.html">Log in here</a></p>
        <div class="login-trust mt-4"><span><i class="bi bi-shield-check"></i> Secure account</span><span><i class="bi bi-heart"></i> Free to join</span></div>
      </section>
    </div>
    <aside class="site-ad-banner" aria-label="Sponsored placement">
      <a class="site-ad-link" href="events.html"><img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&h=360&q=88" alt="Adventure vehicle on an open road"><span class="site-ad-overlay"></span><span class="site-ad-copy"><small>PHOTOX PARTNER</small><strong>BUILT FOR MORE<br>THAN ROADS</strong><span>Explore events <i class="bi bi-arrow-up-right"></i></span></span></a>
    </aside>
  </main>

  <footer class="footer footer-premium"><div class="container-xl">
    <div class="row g-5 footer-main"><div class="col-lg-5"><a class="footer-logo" href="index.html"><img src="logo.png" alt="PhotoX" style="width:150px"></a><p class="footer-copy">The feeling of being there,<br>kept in a frame.</p><div class="footer-social d-flex gap-3"><a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a><a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a><a href="#" aria-label="Linkedin"><i class="bi bi-linkedin"></i></a></div></div><div class="col-6 col-lg-2"><p class="footer-label">Explore</p><a href="events.html">Events</a><a href="photographers.html">Photographers</a><a href="blog.html">Journal</a><a href="sponsors.html">Sponsors</a></div><div class="col-6 col-lg-2"><p class="footer-label">For creators</p><a href="photographer-dashboard.html">Creator login</a><a href="upload.html">Upload photos</a><a href="photographers.html">Join PhotoX</a><a href="messages.html">Support</a></div><div class="col-12 col-lg-3"><p class="footer-label">Stay in the frame</p><p class="footer-small">New events, fresh galleries and stories from the field.</p><div class="newsletter"><input aria-label="Email address" placeholder="Your email address" type="email"><button aria-label="Subscribe"><i class="bi bi-arrow-up-right"></i></button></div></div></div><div class="footer-bottom"><span>© 2026 PhotoX</span><span>Privacy · Terms ·</span><span>Made for the moments <i class="bi bi-stars"></i></span></div></div></footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const passwordToggle = document.getElementById('toggleSignupPassword');
    const passwordInput = document.getElementById('signupPassword');
    const accountTypeInputs = document.querySelectorAll('input[name="account-type"]');
    const photographerTiers = document.getElementById('photographerTiers');

    function updateSignupType() {
      const isPhotographer = document.querySelector('input[name="account-type"]:checked').value === 'photographer';
      photographerTiers.hidden = !isPhotographer;
      photographerTiers.querySelectorAll('input[name="photographer-tier"]').forEach((input) => {
        input.disabled = !isPhotographer;
      });
    }

    accountTypeInputs.forEach((input) => input.addEventListener('change', updateSignupType));
    updateSignupType();

    passwordToggle.addEventListener('click', () => {
      const isPassword = passwordInput.type === 'password';
      passwordInput.type = isPassword ? 'text' : 'password';
      passwordToggle.innerHTML = `<i class="bi bi-eye${isPassword ? '-slash' : ''}"></i>`;
    });
  </script>
</body>
</html>
