<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Your saved and purchased PhotoX images.">
  <title>PhotoX | My photos</title>
  <link href="favicon.png" rel="icon">
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <script defer src="site-ad.js"></script>
</head>
<body class="customer-app photos-page">
  <nav aria-label="Main navigation" class="navbar navbar-expand-lg py-2">
    <div class="container-xl">
      <a aria-label="PhotoX home" class="navbar-brand" href="index.html"><img alt="PhotoX" src="logo.png"></a><button aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler border-0 p-0" data-bs-target="#mainNav" data-bs-toggle="collapse" type="button"><i class="bi bi-list fs-2"></i></button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav mx-auto gap-lg-3 mt-3 mt-lg-0">
          <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="events.html">Explore</a></li>
          <li class="nav-item"><a class="nav-link" href="photographers.html">Photographers</a></li>
          <li class="nav-item"><a class="nav-link" href="membership.html">Membership</a></li>
          <li class="nav-item"><a class="nav-link" href="blog.html">About</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
        </ul>
        <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
          <div class="header-search d-none d-xl-flex"><i class="bi bi-search"></i><input aria-label="Search photos" placeholder="Search photos, people, teams or events..." type="search"></div><a class="header-cart" href="cart.html" aria-label="Open cart"><i class="bi bi-cart3"></i><span>0</span></a><button aria-label="Notifications" class="icon-button notification-button"><i class="bi bi-bell"></i><span>2</span></button>
          <div class="account-menu">
            <button aria-label="Open account menu" class="profile-trigger"><span class="avatar">LM</span><span class="d-none d-sm-inline">Lebo Mokoena</span><i class="bi bi-chevron-down"></i></button>
            <div class="account-dropdown" role="menu">
              <div class="account-dropdown-user"><span class="avatar">LM</span><div><strong>Lebo Mokoena</strong><small>lebo.mokoena@example.com</small></div></div><a href="profile-settings.html" role="menuitem"><i class="bi bi-person"></i> Profile & settings</a><a href="index.html" role="menuitem"><i class="bi bi-box-arrow-left"></i> Log out</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <main class="workspace-layout container-xl">
    <aside aria-label="Account navigation" class="workspace-sidebar">
      <div class="workspace-greeting"><span class="eyebrow-blue">YOUR WORKSPACE</span><h1>Keep the<br><em>good ones.</em></h1></div>
      <nav class="workspace-nav">
        <a class="workspace-nav-link" href="customer-dashboard.html"><i class="bi bi-grid-1x2"></i><span>Overview</span></a>
        <a class="workspace-nav-link active" href="my-photos.html"><i class="bi bi-images"></i><span>My photos</span><b>24</b></a>
        <a class="workspace-nav-link" href="saved-events.html"><i class="bi bi-bookmark"></i><span>Saved events</span></a>
        <a class="workspace-nav-link" href="orders-downloads.html"><i class="bi bi-bag"></i><span>Orders & downloads</span></a>
        <a class="workspace-nav-link" href="profile-settings.html"><i class="bi bi-person"></i><span>Profile & settings</span></a>
      </nav>
      <div class="workspace-side-note"><i class="bi bi-shield-check"></i><div><strong>Your privacy matters</strong><span>AI search is only active on galleries where the photographer enables it.</span></div></div><a class="workspace-logout" href="index.html"><i class="bi bi-box-arrow-left"></i> Sign out</a>
    </aside>
    <section class="workspace-content">
      <div class="workspace-mobile-heading"><span class="eyebrow-blue">YOUR WORKSPACE</span><h2>My photos.</h2><p>Every frame you chose to keep.</p></div>
      <section class="workspace-view active">
        <div class="workspace-view-header"><div><span class="eyebrow-blue">MY PHOTOS</span><h2>Your collected moments.</h2><p>Saved previews and purchased images, organised by event.</p></div><a class="btn btn-lime rounded-pill px-4" href="events.html"><i class="bi bi-camera me-2"></i>Search again</a></div>
        <div class="view-toolbar"><div class="segmented-control"><a class="active" href="my-photos.html">All photos</a><a href="orders-downloads.html">Purchased</a><a href="my-photos.html">Saved</a></div><button class="filter-button"><i class="bi bi-sliders2"></i> Filter</button></div>
        <div class="photos-gallery-layout"><div class="photo-wall">
          <img alt="Rugby action" src="https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=700&q=85">
          <img alt="Marathon runner" src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=700&q=85">
          <img alt="School football match" src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?auto=format&fit=crop&w=700&q=85">
          <img alt="Football player" src="https://images.unsplash.com/photo-1517466787929-bc90951d0974?auto=format&fit=crop&w=700&q=85">
          <img alt="Cyclist" src="https://images.unsplash.com/photo-1541625602330-2277a4c46182?auto=format&fit=crop&w=700&q=85">
          <img alt="Swimmer" src="https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=700&q=85">
        </div><a class="photos-sponsor-banner" href="events.html"><span class="photos-sponsor-label">Sponsor spotlight</span><img alt="Red running shoe for sponsor advertisement" src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=900&q=85"><span class="photos-sponsor-overlay"></span><div class="photos-sponsor-copy"><span>PERFORMANCE PARTNER</span><strong>Keep moving.</strong><small>Find your next stride with ASICS.</small><b>Discover partner <i class="bi bi-arrow-up-right"></i></b></div></a></div>
      </section>
    </section>
  </main>

  <footer class="footer footer-premium"><div class="container-xl"><div class="row g-5 footer-main"><div class="col-lg-5"><a class="footer-logo" href="index.html"><img src="logo.png" alt="PhotoX" style="width:150px"></a><p class="footer-copy">The feeling of being there,<br>kept in a frame.</p><div class="footer-social d-flex gap-3"><a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a><a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a><a href="#" aria-label="Linkedin"><i class="bi bi-linkedin"></i></a></div></div><div class="col-6 col-lg-2"><p class="footer-label">Explore</p><a href="events.html">Events</a><a href="photographers.html">Photographers</a><a href="blog.html">Journal</a><a href="contact.html">Contact</a></div><div class="col-6 col-lg-2"><p class="footer-label">For creators</p><a href="login.html">Creator login</a><a href="signup.html">Join PhotoX</a><a href="events.html">Upload photos</a><a href="blog.html">Support</a></div><div class="col-12 col-lg-3"><p class="footer-label">Stay in the frame</p><p class="footer-small">New events, fresh galleries and stories from the field.</p><div class="newsletter"><input aria-label="Email address" placeholder="Your email address" type="email"><button aria-label="Subscribe"><i class="bi bi-arrow-up-right"></i></button></div></div></div><div class="footer-bottom"><span>© 2026 PhotoX</span><span>Privacy · Terms ·</span><span>Made for the moments <i class="bi bi-stars"></i></span></div></div></footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
