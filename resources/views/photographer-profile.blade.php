<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="PhotoX photographer profile page.">
  <title>PhotoX | Photographer profile</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <script defer src="site-ad.js"></script>
  
</head>
<body class="page-photographer-profile">
  <nav aria-label="Main navigation" class="navbar navbar-expand-lg py-2">
    <div class="container-xl">
      <a class="navbar-brand d-flex align-items-center gap-2" href="index.html"><img alt="PhotoX" src="logo.png"></a>
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
          <div class="header-search d-none d-xl-flex"><i class="bi bi-search"></i><input aria-label="Search" placeholder="Search settings" type="search"></div>
          <a class="header-cart" href="cart.html" aria-label="Open cart"><i class="bi bi-cart3"></i><span>0</span></a>
          <button class="icon-button notification-button" aria-label="Notifications"><i class="bi bi-bell"></i><span>1</span></button>
          <div class="account-menu">
            <button class="profile-trigger" aria-label="Open account menu"><span class="avatar">AD</span><span class="d-none d-sm-inline">Aiden Daniels</span><i class="bi bi-chevron-down"></i></button>
            <div class="account-dropdown" role="menu">
              <div class="account-dropdown-user"><span class="avatar">AD</span><div><strong>Aiden Daniels</strong><small>aiden@photosouth.com</small></div></div>
              <a href="photographer-profile.html" role="menuitem"><i class="bi bi-person"></i> Profile & settings</a>
              <a href="index.html" role="menuitem"><i class="bi bi-box-arrow-left"></i> Log out</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <main class="container-xl photographer-shell">
    <aside class="photographer-sidebar" aria-label="Photographer navigation">
      <div class="workspace-greeting">
        <span class="eyebrow-blue">PHOTOGRAPHER WORKSPACE</span>
        <h1>Frame the<br><em>moment.</em></h1>
      </div>
      <nav class="workspace-nav">
        <a class="workspace-nav-link" href="photographer-dashboard.html"><i class="bi bi-grid-1x2"></i><span>Overview</span></a>
        <a class="workspace-nav-link" href="photographer-bookings.html"><i class="bi bi-calendar-event"></i><span>Bookings</span><b>12</b></a>
        <a class="workspace-nav-link" href="photographer-gallery.html"><i class="bi bi-images"></i><span>Gallery</span></a>
        <a class="workspace-nav-link" href="photographer-earnings.html"><i class="bi bi-wallet2"></i><span>Earnings</span></a>
        <a class="workspace-nav-link" href="photographer-messages.html"><i class="bi bi-chat-left-text"></i><span>Messages</span></a>
        <a class="workspace-nav-link active" href="photographer-profile.html"><i class="bi bi-person-circle"></i><span>Profile</span></a>
      </nav>
      <div class="workspace-side-note"><i class="bi bi-shield-check"></i><div><strong>Coverage secured</strong><span>3 client galleries are still pending final delivery.</span></div></div>
      <a class="workspace-logout" href="index.html"><i class="bi bi-box-arrow-left"></i> Sign out</a>
    </aside>

    <section class="workspace-main">
      <div class="workspace-topbar">
        <div>
          <span class="eyebrow-blue">PROFILE</span>
          <h2>Photographer account</h2>
        </div>
        
      </div>

      <form action="photographer-profile.html" class="profile-card" id="profileForm" method="get">
        <section class="profile-section">
          <div class="profile-header">
            <div class="profile-avatar">AD</div>
            <div>
              <h3>Aiden Daniels</h3>
              <div class="profile-meta">Sports & event photographer · Cape Town</div>
              <span class="profile-status"><i class="bi bi-circle-fill"></i> Profile visible to clients</span>
            </div>
          </div>
        </section>

        <section class="profile-section">
          <div class="profile-section-heading">
            <i class="bi bi-person-vcard"></i>
            <div>
              <h3>Personal information</h3>
              <p>The details clients use when they contact you.</p>
            </div>
          </div>
          <div class="info-grid">
            <label class="profile-field">
              <span class="field-label">Full name</span>
              <input class="profile-input" name="name" type="text" value="Aiden Daniels">
            </label>
            <label class="profile-field">
              <span class="field-label">Email address</span>
              <input class="profile-input" name="email" type="email" value="aiden@photosouth.com">
            </label>
            <label class="profile-field">
              <span class="field-label">Phone number</span>
              <input class="profile-input" name="phone" type="tel" value="+27 82 456 7821">
            </label>
            <label class="profile-field">
              <span class="field-label">Location</span>
              <input class="profile-input" name="location" type="text" value="Cape Town, South Africa">
            </label>
          </div>
        </section>

        <section class="profile-section">
          <div class="profile-section-heading">
            <i class="bi bi-camera"></i>
            <div>
              <h3>Creator profile</h3>
              <p>Tell clients what makes your work distinct.</p>
            </div>
          </div>
          <div class="profile-field">
            <label class="field-label" for="bio">Bio</label>
            <textarea class="profile-textarea" id="bio" name="bio">Aiden captures decisive movement, athlete emotion and the atmosphere of live events with a documentary approach that keeps every frame honest and alive.</textarea>
            <div class="profile-helper">This introduction appears on your public photographer profile.</div>
          </div>
          <div class="tag-row">
            <label class="tag"><input checked name="specialty" type="checkbox" value="Sports"> Sports</label>
            <label class="tag"><input checked name="specialty" type="checkbox" value="Events"> Events</label>
            <label class="tag"><input checked name="specialty" type="checkbox" value="Portraits"> Portraits</label>
            <label class="tag"><input checked name="specialty" type="checkbox" value="Marathons"> Marathons</label>
            <label class="tag"><input checked name="specialty" type="checkbox" value="Rugby"> Rugby</label>
          </div>
        </section>

        <section class="profile-section">
          <div class="profile-section-heading">
            <i class="bi bi-calendar-check"></i>
            <div>
              <h3>Availability & services</h3>
              <p>Help clients understand when and where you work.</p>
            </div>
          </div>
          <div class="info-grid">
            <label class="profile-field">
              <span class="field-label">Availability</span>
              <select class="profile-select" name="availability">
                <option selected>Weekends and selected weekdays</option>
                <option>Available most weekdays</option>
                <option>Weekends only</option>
                <option>Currently unavailable</option>
              </select>
            </label>
            <label class="profile-field">
              <span class="field-label">Travel range</span>
              <select class="profile-select" name="travel-range">
                <option selected>Cape Town and surrounding areas</option>
                <option>Western Cape</option>
                <option>South Africa wide</option>
                <option>Remote editing only</option>
              </select>
            </label>
          </div>
        </section>

        <section class="profile-section">
          <div class="profile-section-heading">
            <i class="bi bi-shield-lock"></i>
            <div>
              <h3>Privacy & security</h3>
              <p>Your account access and client visibility settings.</p>
            </div>
          </div>
          <div class="info-grid">
            <label class="profile-field">
              <span class="field-label">Profile visibility</span>
              <select class="profile-select" name="visibility">
                <option selected>Visible to PhotoX clients</option>
                <option>Hidden from search</option>
              </select>
              <small>Clients can discover your creator profile.</small>
            </label>
            <div class="profile-field">
              <span class="field-label">Account security</span>
              <div class="field-value">Password protected</div>
              <small>Last updated 28 days ago.</small>
            </div>
          </div>
        </section>

        <div class="profile-actions">
          <a class="btn btn-outline-secondary rounded-pill px-4" href="photographer-dashboard.html">Cancel</a>
          <button class="btn btn-lime rounded-pill px-4" type="submit"><i class="bi bi-check2 me-2"></i>Save profile</button>
        </div>
      </form>
    </section>
  </main>

  <footer class="footer footer-premium">
    <div class="container-xl">
      <div class="row g-5 footer-main">
        <div class="col-lg-5"><a class="footer-logo" href="index.html"><img src="logo.png" alt="PhotoX" style="width:150px"></a><p class="footer-copy">The feeling of being there,<br>kept in a frame.</p><div class="footer-social d-flex gap-3"><a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a><a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a><a href="#" aria-label="Linkedin"><i class="bi bi-linkedin"></i></a></div></div>
        <div class="col-6 col-lg-2"><p class="footer-label">Explore</p><a href="events.html">Events</a><a href="photographers.html">Photographers</a><a href="blog.html">Journal</a><a href="contact.html">Contact</a></div>
        <div class="col-6 col-lg-2"><p class="footer-label">For creators</p><a href="photographer-dashboard.html">Creator login</a><a href="photographer-upload-new.html">Upload photos</a><a href="photographers.html">Join PhotoX</a><a href="#">Support</a></div>
        <div class="col-12 col-lg-3"><p class="footer-label">Stay in the frame</p><p class="footer-small">New events, fresh galleries and stories from the field.</p><div class="newsletter"><input aria-label="Email address" placeholder="Your email address" type="email"><button aria-label="Subscribe"><i class="bi bi-arrow-up-right"></i></button></div></div>
      </div>
      <div class="footer-bottom"><span>© 2026 PhotoX</span><span>Privacy · Terms ·</span><span>Made for the moments <i class="bi bi-stars"></i></span></div>
    </div>
  </footer>
</body>
</html>
