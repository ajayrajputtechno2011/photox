<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="PhotoX photographer bookings dashboard.">
  <title>PhotoX | Photographer bookings</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <script defer src="site-ad.js"></script>
  
</head>
<body class="page-photographer-bookings">
  <nav aria-label="Main navigation" class="navbar navbar-expand-lg py-2">
    <div class="container-xl">
      <a class="navbar-brand d-flex align-items-center gap-2" href="/"><img alt="PhotoX" src="logo.png"></a>
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
          <div class="header-search d-none d-xl-flex"><i class="bi bi-search"></i><input aria-label="Search" placeholder="Search bookings" type="search"></div>
          <a class="header-cart" href="/cart" aria-label="Open cart"><i class="bi bi-cart3"></i><span>0</span></a>
          <button class="icon-button notification-button" aria-label="Notifications"><i class="bi bi-bell"></i><span>2</span></button>
          <div class="account-menu">
            <button class="profile-trigger" aria-label="Open account menu"><span class="avatar">AD</span><span class="d-none d-sm-inline">Aiden Daniels</span><i class="bi bi-chevron-down"></i></button>
            <div class="account-dropdown" role="menu">
              <div class="account-dropdown-user"><span class="avatar">AD</span><div><strong>Aiden Daniels</strong><small>aiden@photosouth.com</small></div></div>
              <a href="/photographer-profile" role="menuitem"><i class="bi bi-person"></i> Profile & settings</a>
              <a href="/" role="menuitem"><i class="bi bi-box-arrow-left"></i> Log out</a>
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
        <a class="workspace-nav-link" href="/photographer-dashboard"><i class="bi bi-grid-1x2"></i><span>Overview</span></a>
        <a class="workspace-nav-link active" href="/photographer-bookings"><i class="bi bi-calendar-event"></i><span>Bookings</span><b>12</b></a>
        <a class="workspace-nav-link" href="/photographer-gallery"><i class="bi bi-images"></i><span>Gallery</span></a>
        <a class="workspace-nav-link" href="/photographer-earnings"><i class="bi bi-wallet2"></i><span>Earnings</span></a>
        <a class="workspace-nav-link" href="/photographer-messages"><i class="bi bi-chat-left-text"></i><span>Messages</span></a>
        <a class="workspace-nav-link" href="/photographer-profile"><i class="bi bi-person-circle"></i><span>Profile</span></a>
      </nav>
      <div class="workspace-side-note">
        <i class="bi bi-shield-check"></i>
        <div>
          <strong>Coverage secured</strong>
          <span>3 client galleries are still pending final delivery.</span>
        </div>
      </div>
      <a class="workspace-logout" href="/"><i class="bi bi-box-arrow-left"></i> Sign out</a>
    </aside>

    <section class="workspace-main">
      <div class="workspace-topbar">
        <div>
          <span class="eyebrow-blue">BOOKINGS</span>
          <h2>Event schedule</h2>
        </div>
        <a class="btn btn-lime rounded-pill px-4" href="/photographer-new-booking"><i class="bi bi-plus-lg me-2"></i>New booking</a>
      </div>

      <div class="booking-toolbar">
        <button type="button" class="filter-pill active">All</button>
        <button type="button" class="filter-pill">Confirmed</button>
        <button type="button" class="filter-pill">Pending</button>
        <button type="button" class="filter-pill">Action needed</button>
      </div>

      <div class="table-card">
        <div class="booking-row">
          <div class="booking-main">
            <img alt="Marathon event" src="https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=400&q=80">
            <div>
              <strong>Stellenbosch Spring Run</strong>
              <span>Saturday · 8:00 AM</span>
            </div>
          </div>
          <div>
            <div class="table-label">Location</div>
            <div class="table-value">Cape Town</div>
          </div>
          <div>
            <div class="table-label">Client</div>
            <div class="table-value">Run Collective</div>
          </div>
          <div>
            <div class="table-label">Package</div>
            <div class="table-value">Premium coverage</div>
          </div>
          <div>
            <span class="status confirmed">Confirmed</span>
          </div>
        </div>

        <div class="booking-row">
          <div class="booking-main">
            <img alt="Rugby event" src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=400&q=80">
            <div>
              <strong>School A Rugby Day</strong>
              <span>Tuesday · 10:30 AM</span>
            </div>
          </div>
          <div>
            <div class="table-label">Location</div>
            <div class="table-value">Green Point</div>
          </div>
          <div>
            <div class="table-label">Client</div>
            <div class="table-value">Greys Pass</div>
          </div>
          <div>
            <div class="table-label">Package</div>
            <div class="table-value">Team event</div>
          </div>
          <div>
            <span class="status pending">Pending</span>
          </div>
        </div>

        <div class="booking-row">
          <div class="booking-main">
            <img alt="Portrait session" src="https://images.unsplash.com/photo-1521412644187-c49fa049e84d?auto=format&fit=crop&w=400&q=80">
            <div>
              <strong>Family portrait session</strong>
              <span>Thursday · 3:00 PM</span>
            </div>
          </div>
          <div>
            <div class="table-label">Location</div>
            <div class="table-value">Waterfront</div>
          </div>
          <div>
            <div class="table-label">Client</div>
            <div class="table-value">M. Van Wyk</div>
          </div>
          <div>
            <div class="table-label">Package</div>
            <div class="table-value">Portrait pack</div>
          </div>
          <div>
            <button class="mini-btn" type="button">Review</button>
          </div>
        </div>

        <div class="booking-row">
          <div class="booking-main">
            <img alt="Awards event" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=400&q=80">
            <div>
              <strong>City Marathon Awards</strong>
              <span>Sunday · 1:15 PM</span>
            </div>
          </div>
          <div>
            <div class="table-label">Location</div>
            <div class="table-value">Mowbray</div>
          </div>
          <div>
            <div class="table-label">Client</div>
            <div class="table-value">Cape Sports</div>
          </div>
          <div>
            <div class="table-label">Package</div>
            <div class="table-value">Award shoot</div>
          </div>
          <div>
            <span class="status action">Needs edit</span>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="footer footer-premium">
    <div class="container-xl">
      <div class="row g-5 footer-main">
        <div class="col-lg-5"><a class="footer-logo" href="/"><img src="logo.png" alt="PhotoX" style="width:150px"></a><p class="footer-copy">The feeling of being there,<br>kept in a frame.</p><div class="footer-social d-flex gap-3"><a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a><a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a><a href="#" aria-label="Linkedin"><i class="bi bi-linkedin"></i></a></div></div>
        <div class="col-6 col-lg-2"><p class="footer-label">Explore</p><a href="/events">Events</a><a href="/photographers">Photographers</a><a href="/blog">Journal</a><a href="/contact">Contact</a></div>
        <div class="col-6 col-lg-2"><p class="footer-label">For creators</p><a href="/photographer-dashboard">Creator login</a><a href="/photographer-upload-new">Upload photos</a><a href="/photographers">Join PhotoX</a><a href="#">Support</a></div>
        <div class="col-12 col-lg-3"><p class="footer-label">Stay in the frame</p><p class="footer-small">New events, fresh galleries and stories from the field.</p><div class="newsletter"><input aria-label="Email address" placeholder="Your email address" type="email"><button aria-label="Subscribe"><i class="bi bi-arrow-up-right"></i></button></div></div>
      </div>
      <div class="footer-bottom"><span>© 2026 PhotoX</span><span>Privacy · Terms ·</span><span>Made for the moments <i class="bi bi-stars"></i></span></div>
    </div>
  </footer>
</body>
</html>
