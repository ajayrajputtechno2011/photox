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
        <a class="workspace-nav-link active" href="/photographer-bookings"><i class="bi bi-calendar-event"></i><span>Events</span><b>12</b></a>
        <a class="workspace-nav-link" href="/photographer-gallery"><i class="bi bi-images"></i><span>Gallery</span></a>
        <a class="workspace-nav-link" href="{{ route('photographer.watermark') }}"><i class="bi bi-shield-lock"></i><span>Watermark Studio</span></a>
        <a class="workspace-nav-link" href="/photographer-earnings"><i class="bi bi-wallet2"></i><span>Earnings</span></a>
        <a class="workspace-nav-link" href="/photographer-payouts"><i class="bi bi-bank"></i><span>Payouts &amp; Bank</span></a>
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
          <span class="eyebrow-blue">EVENTS</span>
          <h2>Event schedule</h2>
        </div>
        <a class="btn btn-lime rounded-pill px-4" href="/photographer-upload-new"><i class="bi bi-plus-lg me-2"></i>Add new gallery</a>
      </div>

      <div class="booking-toolbar">
        <button type="button" class="filter-pill active">All</button>
        <button type="button" class="filter-pill">Confirmed</button>
        <button type="button" class="filter-pill">Pending</button>
        <button type="button" class="filter-pill">Action needed</button>
      </div>

      <div class="table-card">
        @forelse($events as $evt)
          <div class="booking-row">
            <div class="booking-main">
              <img alt="{{ $evt->title }}" src="{{ $evt->cover_image ?: ($evt->photos->first()?->thumbnail_url ?: 'https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=400&q=80') }}" style="object-fit: cover;">
              <div>
                <strong>{{ $evt->title }}</strong>
                <span>{{ $evt->event_date?->format('l, d M Y') ?? 'Recent Shoot' }}</span>
              </div>
            </div>
            <div>
              <div class="table-label">Location</div>
              <div class="table-value">{{ $evt->location ?: 'South Africa' }}</div>
            </div>
            <div>
              <div class="table-label">Category</div>
              <div class="table-value">{{ $evt->category_name ?: 'Sports' }}</div>
            </div>
            <div>
              <div class="table-label">Photos / Coverage</div>
              <div class="table-value">{{ $evt->photos_count ?? $evt->photos()->count() }} photos</div>
            </div>
            <div>
              <a href="{{ route('events.show', $evt->slug ?: $evt->id) }}" target="_blank" class="mini-btn text-decoration-none">View Event</a>
            </div>
          </div>
        @empty
          <div class="p-4 text-center text-muted">
            <i class="bi bi-calendar-x fs-2 d-block mb-2"></i>
            No events currently scheduled.
          </div>
        @endforelse
      </div>
    </section>
  </main>

  @include('web.partials.footer')
</body>
</html>
