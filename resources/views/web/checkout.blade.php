<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Complete your PhotoX photo order securely.">
  <title>PhotoX | Checkout</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
</head>
<body class="page-checkout">
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
          <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
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

  <main class="checkout-main">
    <div class="container-xl">
      <div class="checkout-heading"><span class="section-kicker">CHECKOUT</span><h1>Complete your order.</h1><p>Your photos will be delivered digitally after payment confirmation.</p></div>
      <div class="checkout-layout">
        <form class="checkout-form" action="/orders-downloads" method="get">
          <section class="checkout-card">
            <div class="checkout-card-heading"><span class="step-number">1</span><div><h2>Contact details</h2><p>Where should we send your receipt?</p></div></div>
            <div class="checkout-form-grid">
              <label><span>First name</span><input name="first-name" type="text" placeholder="Aiden" required></label>
              <label><span>Last name</span><input name="last-name" type="text" placeholder="Daniels" required></label>
              <label class="wide-field"><span>Email address</span><input name="email" type="email" placeholder="you@example.com" required></label>
            </div>
          </section>
          <section class="checkout-card">
            <div class="checkout-card-heading"><span class="step-number">2</span><div><h2>Payment method</h2><p>Payment details will be securely processed.</p></div></div>
            <div class="payment-options"><label class="payment-option"><input checked name="payment" type="radio" value="card"><i class="bi bi-credit-card"></i><span>Card payment</span></label><label class="payment-option"><input name="payment" type="radio" value="eft"><i class="bi bi-bank"></i><span>Instant EFT</span></label></div>
            <div class="checkout-form-grid payment-fields">
              <label class="wide-field"><span>Card number</span><input name="card-number" inputmode="numeric" type="text" placeholder="1234 5678 9012 3456"></label>
              <label><span>Expiry date</span><input name="expiry" type="text" placeholder="MM / YY"></label>
              <label><span>CVV</span><input name="cvv" inputmode="numeric" type="text" placeholder="123"></label>
            </div>
          </section>
          <label class="checkout-consent"><input name="terms" type="checkbox" required><span>I agree to the PhotoX terms and understand that digital photo purchases are delivered to my email address.</span></label>
          <button class="btn btn-lime rounded-pill px-4 checkout-submit" type="submit">Place secure order <i class="bi bi-arrow-right ms-2"></i></button>
        </form>
        <aside class="checkout-summary">
          <div class="checkout-card"><div class="checkout-card-heading"><span class="step-number">3</span><div><h2>Order summary</h2><p>0 photos selected</p></div></div><div class="checkout-empty"><i class="bi bi-images"></i><p>Your selected photos will appear here.</p><a href="/browse-photos">Browse photos</a></div><div class="summary-total"><span>Total</span><strong>R0</strong></div></div>
          <div class="checkout-trust"><i class="bi bi-shield-check"></i><div><strong>Protected checkout</strong><p>PhotoX uses secure payment processing and private digital delivery.</p></div></div>
        </aside>
      </div>
    </div>
    <aside class="site-ad-banner" aria-label="Sponsored placement">
      <a class="site-ad-link" href="/events"><img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&h=360&q=88" alt="Adventure vehicle on an open road"><span class="site-ad-overlay"></span><span class="site-ad-copy"><small>PHOTOX PARTNER</small><strong>BUILT FOR MORE<br>THAN ROADS</strong><span>Explore events <i class="bi bi-arrow-up-right"></i></span></span></a>
    </aside>
  </main>

  <footer class="footer footer-premium"><div class="container-xl"><div class="footer-bottom"><span>© 2026 PhotoX</span><span>Privacy · Terms ·</span><span><i class="bi bi-lock-fill"></i> Secure checkout</span></div></div></footer>
</body>
</html>
