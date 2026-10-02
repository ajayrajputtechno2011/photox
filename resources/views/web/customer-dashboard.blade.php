<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Your PhotoX customer workspace for saved photos, orders and events.">
  <title>PhotoX | My workspace</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <script defer src="site-ad.js"></script>
</head>
<body class="customer-app dashboard-page">
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
          <li class="nav-item"><a class="nav-link" href="/blog">About</a></li>
          <li class="nav-item"><a class="nav-link" href="/#contact">Contact</a></li>
        </ul>
        <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
          <div class="header-search d-none d-xl-flex"><i class="bi bi-search"></i><input aria-label="Search photos, people, teams or events" placeholder="Search photos, people, teams or events..." type="search"></div>
          <a class="header-cart" href="/cart" aria-label="Open cart"><i class="bi bi-cart3"></i><span>0</span></a>
          <button class="icon-button notification-button" aria-label="Notifications"><i class="bi bi-bell"></i><span>2</span></button>
          <div class="account-menu">
            <button class="profile-trigger" aria-label="Open account menu"><span class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}</span><span class="d-none d-sm-inline">{{ Auth::user()->name ?? 'Customer' }}</span><i class="bi bi-chevron-down"></i></button>
            <div class="account-dropdown" role="menu">
              <div class="account-dropdown-user"><span class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}</span><div><strong>{{ Auth::user()->name ?? 'Customer' }}</strong><small>{{ Auth::user()->email ?? 'customer@example.com' }}</small></div></div>
              <a href="{{ url('/profile-settings') }}" role="menuitem"><i class="bi bi-person"></i> Profile & settings</a>
              <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="dropdown-item text-danger py-2 w-100 text-start border-0 bg-transparent px-3"><i class="bi bi-box-arrow-left me-2"></i> Log out</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <main class="workspace-layout container-xl">
    <aside class="workspace-sidebar" aria-label="Account navigation">
      <div class="workspace-greeting"><span class="eyebrow-blue">YOUR WORKSPACE</span><h1>Keep the<br><em>good ones.</em></h1></div>
      <nav class="workspace-nav" id="workspaceNav">
        <a class="workspace-nav-link active" href="/customer-dashboard"><i class="bi bi-grid-1x2"></i><span>Overview</span></a>
        <a class="workspace-nav-link" href="/my-photos"><i class="bi bi-images"></i><span>My photos</span><b>24</b></a>
        <a class="workspace-nav-link" href="/saved-events"><i class="bi bi-bookmark"></i><span>Saved events</span></a>
        <a class="workspace-nav-link" href="/orders-downloads"><i class="bi bi-bag"></i><span>Orders & downloads</span></a>
        <a class="workspace-nav-link" href="/profile-settings"><i class="bi bi-person"></i><span>Profile & settings</span></a>
      </nav>
      <div class="workspace-side-note"><i class="bi bi-shield-check"></i><div><strong>Your privacy matters</strong><span>AI search is only active on galleries where the photographer enables it.</span></div></div>
      <a class="workspace-logout" href="/"><i class="bi bi-box-arrow-left"></i> Sign out</a>
    </aside>

    <section class="workspace-content">
      <div class="workspace-mobile-heading"><span class="eyebrow-blue">THURSDAY, 17 SEPTEMBER 2026</span><h2>Good morning, Lebo.</h2><p>Your moments are never far away.</p></div>
      <section class="workspace-view active" data-panel="overview">
        <div class="workspace-view-header"><div><span class="eyebrow-blue">OVERVIEW</span><h2>Your photo world.</h2><p>Pick up where you left off or find something new.</p></div><a class="btn btn-lime rounded-pill px-4" href="/#find"><i class="bi bi-search me-2"></i>Find my photos</a></div>
        <div class="workspace-metrics"><div class="workspace-metric"><span>Saved photos</span><strong>24</strong><i class="bi bi-images"></i></div><div class="workspace-metric"><span>Events followed</span><strong>06</strong><i class="bi bi-calendar-event"></i></div><div class="workspace-metric"><span>Orders placed</span><strong>03</strong><i class="bi bi-bag-check"></i></div><div class="workspace-metric accent"><span>Ready to download</span><strong>12</strong><i class="bi bi-cloud-arrow-down"></i></div></div>
        <div class="workspace-section-heading"><div><span class="eyebrow-blue">RECENTLY SAVED</span><h3>Back to the action.</h3></div><a class="plain-action" href="/my-photos">View all <i class="bi bi-arrow-up-right"></i></a></div>
        <div class="saved-photo-grid"><div class="saved-photo-gallery"><article class="saved-photo-card featured"><img src="https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=900&q=85" alt="Rugby player in action"><div><span>MATIES VS IKEYS</span><strong>Match-day moments</strong><small>12 photos saved · 12 Sep 2026</small></div><button aria-label="Remove saved photo"><i class="bi bi-bookmark-fill"></i></button></article><article class="saved-photo-card"><img src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=800&q=85" alt="Runner crossing a finish line"><div><span>CITY MARATHON 2026</span><strong>Finish line feeling</strong><small>8 photos saved</small></div><button aria-label="Remove saved photo"><i class="bi bi-bookmark-fill"></i></button></article><article class="saved-photo-card"><img src="https://images.unsplash.com/photo-1541625602330-2277a4c46182?auto=format&fit=crop&w=800&q=85" alt="Cyclist riding outdoors"><div><span>WINELANDS CYCLE TOUR</span><strong>Open road, open frame</strong><small>4 photos saved</small></div><button aria-label="Remove saved photo"><i class="bi bi-bookmark-fill"></i></button></article></div><a class="dashboard-ad-banner" href="/events"><span class="dashboard-ad-label">Sponsor spotlight</span><div class="dashboard-ad-art"><img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=700&q=85" alt="Red running shoe for sponsor advertisement"><div class="dashboard-ad-art-copy"><i class="bi bi-lightning-charge-fill"></i><strong>ASICS<br>Keep moving.</strong></div></div><div class="dashboard-ad-copy"><span>PERFORMANCE PARTNER</span><strong>Find your next stride.</strong><small>Discover the events and stories moving your way.</small><b>Discover partner <i class="bi bi-arrow-up-right"></i></b></div></a></div>
        <div class="workspace-section-heading upcoming-heading"><div><span class="eyebrow-blue">UP NEXT</span><h3>Events you may want to see.</h3></div><a class="plain-action" href="/saved-events">See saved events <i class="bi bi-arrow-up-right"></i></a></div>
        <div class="mini-event-list"><article><div class="mini-event-date"><strong>20</strong><span>SEP</span></div><div><strong>Stellenbosch Spring Run</strong><span>Running · Stellenbosch</span></div><button aria-label="Save event"><i class="bi bi-bookmark"></i></button></article><article><div class="mini-event-date"><strong>27</strong><span>SEP</span></div><div><strong>School A Rugby Day</strong><span>School sport · Cape Town</span></div><button aria-label="Save event"><i class="bi bi-bookmark"></i></button></article></div>
      </section>

    </section>
  </main>
  <nav class="workspace-bottom-nav" id="bottomNav" aria-label="Mobile account navigation"><a class="active" href="/customer-dashboard"><i class="bi bi-grid-1x2"></i><span>Home</span></a><a href="/my-photos"><i class="bi bi-images"></i><span>Photos</span></a><a href="/saved-events"><i class="bi bi-bookmark"></i><span>Saved</span></a><a href="/orders-downloads"><i class="bi bi-bag"></i><span>Orders</span></a><a href="/profile-settings"><i class="bi bi-person"></i><span>Profile</span></a></nav>
   <footer class="footer footer-premium"><div class="container-xl">
   <div class="row g-5 footer-main"><div class="col-lg-5"><a class="footer-logo" href="/"><img src="logo.png" alt="PhotoX" style="width:150px"></a><p class="footer-copy">The feeling of being there,<br>kept in a frame.</p><div class="footer-social d-flex gap-3"><a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a><a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a><a href="#" aria-label="Linkedin"><i class="bi bi-linkedin"></i></a></div></div><div class="col-6 col-lg-2"><p class="footer-label">Explore</p><a href="/events">Events</a><a href="/photographers">Photographers</a><a href="/blog">Journal</a><a href="/sponsors">Sponsors</a></div><div class="col-6 col-lg-2"><p class="footer-label">For creators</p><a href="/photographer-dashboard">Creator login</a><a href="/upload">Upload photos</a><a href="/photographers">Join PhotoX</a><a href="/messages">Support</a></div><div class="col-12 col-lg-3"><p class="footer-label">Stay in the frame</p><p class="footer-small">New events, fresh galleries and stories from the field.</p><div class="newsletter"><input aria-label="Email address" placeholder="Your email address" type="email"><button aria-label="Subscribe"><i class="bi bi-arrow-up-right"></i></button></div></div></div><div class="footer-bottom"><span>© 2026 PhotoX</span><span>Privacy · Terms ·</span><span>Made for the moments <i class="bi bi-stars"></i></span></div></div></footer>
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