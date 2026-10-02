<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="PhotoX photographer upload page.">
  <title>PhotoX | Upload new</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <script defer src="site-ad.js"></script>
  
</head>
<body class="page-photographer-upload-new">
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
          <div class="header-search d-none d-xl-flex"><i class="bi bi-search"></i><input aria-label="Search" placeholder="Search gallery" type="search"></div>
          <a class="header-cart" href="/cart" aria-label="Open cart"><i class="bi bi-cart3"></i><span>0</span></a>
          <button class="icon-button notification-button" aria-label="Notifications"><i class="bi bi-bell"></i><span>3</span></button>
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
        <a class="workspace-nav-link" href="/photographer-bookings"><i class="bi bi-calendar-event"></i><span>Bookings</span><b>12</b></a>
        <a class="workspace-nav-link active" href="/photographer-gallery"><i class="bi bi-images"></i><span>Gallery</span></a>
        <a class="workspace-nav-link" href="/photographer-earnings"><i class="bi bi-wallet2"></i><span>Earnings</span></a>
        <a class="workspace-nav-link" href="/photographer-messages"><i class="bi bi-chat-left-text"></i><span>Messages</span></a>
        <a class="workspace-nav-link" href="/photographer-profile"><i class="bi bi-person-circle"></i><span>Profile</span></a>
      </nav>
      <div class="workspace-side-note"><i class="bi bi-shield-check"></i><div><strong>Coverage secured</strong><span>3 client galleries are still pending final delivery.</span></div></div>
      <a class="workspace-logout" href="/"><i class="bi bi-box-arrow-left"></i> Sign out</a>
    </aside>

    <section class="workspace-main">
      <div class="workspace-topbar">
        <div>
          <span class="eyebrow-blue">GALLERY</span>
          <h2>Upload new work</h2>
        </div>
        <a class="btn btn-outline-primary rounded-pill px-4" href="/photographer-gallery"><i class="bi bi-arrow-left me-2"></i>Back</a>
      </div>

      <form class="upload-card" action="/photographer-gallery">
        <div class="upload-area">
          <div>
            <i class="bi bi-cloud-arrow-up"></i>
            <h4 class="mt-3 mb-2">Drop files here</h4>
            <p class="mb-0 text-muted">PNG, JPG, RAW or MP4 files up to 200MB</p>
          </div>
        </div>

        <div class="form-grid">
          <div>
            <label class="form-label" for="album-name">Album name</label>
            <input class="form-control" id="album-name" name="album-name" type="text" placeholder="Spring Run Highlights">
          </div>
          <div>
            <label class="form-label" for="category">Category</label>
            <select class="form-select" id="category" name="category">
              <option selected>Sports</option>
              <option>Events</option>
              <option>Portraits</option>
              <option>Travel</option>
            </select>
          </div>
          <div class="full-span">
            <label class="form-label" for="caption">Caption</label>
            <input class="form-control" id="caption" name="caption" type="text" placeholder="Morning session, final stretch, crowd energy">
          </div>
        </div>

        <div class="actions">
          <a class="btn btn-outline-secondary rounded-pill px-4" href="/photographer-gallery">Cancel</a>
          <button class="btn btn-lime rounded-pill px-4" type="submit">Publish gallery</button>
        </div>
      </form>
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
