<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="PhotoX photographer dashboard workspace for bookings, galleries, earnings and schedules.">
  <title>PhotoX | Photographer dashboard</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
  <link href="css/styles.css" rel="stylesheet">
  <script defer src="site-ad.js"></script>
  
</head>
<body class="customer-app dashboard-page photographer-dashboard-page page-photographer-dashboard">
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
          <div class="header-search d-none d-xl-flex"><i class="bi bi-search"></i><input aria-label="Search dashboard" placeholder="Search jobs, clients, galleries..." type="search"></div>
          <a class="header-cart" href="/cart" aria-label="Open cart"><i class="bi bi-cart3"></i><span>0</span></a>
          <button class="icon-button notification-button" aria-label="Notifications"><i class="bi bi-bell"></i><span>3</span></button>
          <div class="account-menu">
            <button class="profile-trigger" aria-label="Open account menu"><span class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'P', 0, 2)) }}</span><span class="d-none d-sm-inline">{{ Auth::user()->name ?? 'Creator' }}</span><i class="bi bi-chevron-down"></i></button>
            <div class="account-dropdown" role="menu">
              <div class="account-dropdown-user"><span class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'P', 0, 2)) }}</span><div><strong>{{ Auth::user()->name ?? 'Creator' }}</strong><small>{{ Auth::user()->email ?? 'creator@example.com' }}</small></div></div>
              <a href="{{ url('/photographer-profile') }}" role="menuitem"><i class="bi bi-person"></i> Profile & settings</a>
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

  <main class="container-xl workspace-layout photographer-dash">
    <aside class="workspace-sidebar" aria-label="Photographer navigation">
      <div class="workspace-greeting">
        <span class="eyebrow-blue">PHOTOGRAPHER WORKSPACE</span>
        <h1>Frame the<br><em>moment.</em></h1>
      </div>
      <nav class="workspace-nav" id="workspaceNav">
        <a class="workspace-nav-link active" href="/photographer-dashboard"><i class="bi bi-grid-1x2"></i><span>Overview</span></a>
        <a class="workspace-nav-link" href="/photographer-bookings"><i class="bi bi-calendar-event"></i><span>Events</span><b>{{ $activeGalleries }}</b></a>
        <a class="workspace-nav-link" href="/photographer-gallery"><i class="bi bi-images"></i><span>Gallery</span></a>
        <a class="workspace-nav-link" href="{{ route('photographer.watermark') }}"><i class="bi bi-shield-lock"></i><span>Watermark Studio</span></a>
        <a class="workspace-nav-link" href="/photographer-earnings"><i class="bi bi-wallet2"></i><span>Earnings</span></a>
        <a class="workspace-nav-link" href="/photographer-payouts"><i class="bi bi-bank"></i><span>Payouts &amp; Bank</span></a>
        <a class="workspace-nav-link" href="{{ route('photographers.details', $photographer->id) }}" target="_blank"><i class="bi bi-globe"></i><span>Public Storefront</span></a>
        <a class="workspace-nav-link" href="/photographer-messages"><i class="bi bi-chat-left-text"></i><span>Messages</span></a>
        <a class="workspace-nav-link" href="/photographer-profile"><i class="bi bi-person-circle"></i><span>Profile</span></a>
        <a class="workspace-nav-link" href="/notifications"><i class="bi bi-bell"></i><span>Notifications</span></a>
      </nav>
      <div class="workspace-side-note">
        <i class="bi bi-shield-check"></i>
        <div>
          <strong>Coverage secured</strong>
          <span>{{ $activeGalleries > 0 ? "{$activeGalleries} client galleries active." : "Ready to upload your first event gallery." }}</span>
        </div>
      </div>
      <form action="{{ route('logout') }}" method="POST" class="mt-3">
        @csrf
        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 w-100"><i class="bi bi-box-arrow-left me-1"></i>Sign out</button>
      </form>
    </aside>

    <section class="workspace-content">
      <div class="workspace-view active">
        @include('web.partials.popia-verification-banner')

        <div class="workspace-view-header">
          <div>
            <span class="eyebrow-blue">OVERVIEW</span>
            <h2>Welcome back, {{ $photographer->name }}.</h2>
          </div>
          <div class="d-flex align-items-center gap-2">
            <a class="btn btn-outline-light rounded-pill px-3 py-2" href="{{ route('photographers.details', $photographer->id) }}" target="_blank"><i class="bi bi-eye me-1"></i> Public Storefront</a>
            <a class="btn btn-lime rounded-pill px-4" href="/photographer-upload-new"><i class="bi bi-plus-lg me-2"></i>Add new gallery</a>
          </div>
        </div>

        <div class="summary-grid">
          <div class="summary-card accent">
            <span class="card-label"><i class="bi bi-graph-up-arrow"></i> Revenue</span>
            <strong>R {{ number_format($totalRevenue, 2) }}</strong>
            <small><span>estimated sales</span><b>{{ $totalRevenue > 0 ? '+18.4%' : 'R 0.00' }}</b></small>
          </div>
          <div class="summary-card">
            <span class="card-label"><i class="bi bi-camera"></i> Photos Uploaded</span>
            <strong>{{ $totalPhotos }}</strong>
            <small><span>photos in library</span><b>{{ $totalSoldPhotos }} sold</b></small>
          </div>
          <div class="summary-card">
            <span class="card-label"><i class="bi bi-collection"></i> Active Galleries</span>
            <strong>{{ $activeGalleries }}</strong>
            <small><span>published albums</span><b>live</b></small>
          </div>
          <div class="summary-card">
            <span class="card-label"><i class="bi bi-award"></i> Tier Status</span>
            <strong style="font-size: 1.15rem; line-height: 1.6;">{{ $photographer->effective_badge_heading }}</strong>
            <small><span>commission</span><b>{{ $photographer->effective_commission_rate }}</b></small>
          </div>
        </div>

        <div class="dashboard-grid">
          <div class="panel">
            <div class="panel-head">
              <div>
                <span class="eyebrow-blue">UPCOMING</span>
                <h3>Upcoming Events</h3>
              </div>
              <a class="plain-action" href="/photographer-bookings">View all <i class="bi bi-arrow-up-right"></i></a>
            </div>

            <div class="booking-list">
              @forelse($upcomingEvents as $evt)
                <div class="booking-item">
                  <div class="booking-date">
                    <strong>{{ $evt->event_date?->format('d') ?? '01' }}</strong>
                    <span>{{ $evt->event_date?->format('M') ?? 'Oct' }}</span>
                  </div>
                  <div class="booking-meta">
                    <strong>{{ $evt->title }}</strong>
                    <span>{{ $evt->location ?: 'South Africa' }} &bull; {{ $evt->category_name ?: 'Sports' }}</span>
                  </div>
                  <span class="tag">Confirmed</span>
                </div>
              @empty
                <p class="text-muted small py-3">No upcoming events scheduled.</p>
              @endforelse
            </div>
          </div>

          <div class="panel performance-card">
            <div class="chart-box">
              <div class="chart-head">
                <div>
                  <span class="eyebrow-blue">PERFORMANCE</span>
                  <h4>Sales</h4>
                </div>
                <a class="small-cta" href="#">This month</a>
              </div>
              <div class="chart-meta">Last 7 weeks</div>
              <canvas id="bookingsChart" aria-label="Sales chart"></canvas>
            </div>
            <div class="chart-legend">
              <span><i class="bi bi-circle-fill" style="color:#7cb8ff"></i> Sales</span>
              <span><i class="bi bi-circle-fill" style="color:#ff8a00"></i> Revenue</span>
            </div>
          </div>
        </div>

        <div class="dashboard-grid">
          <div class="panel">
            <div class="panel-head">
              <div>
                <span class="eyebrow-blue">GALLERY</span>
                <h3>Recent uploads</h3>
              </div>
              <a class="plain-action" href="/photographer-gallery">Open gallery <i class="bi bi-arrow-up-right"></i></a>
            </div>

            <div class="gallery-strip">
              @forelse($recentGalleries as $rec)
                <a href="{{ route('events.show', $rec->slug ?: $rec->id) }}" class="gallery-card text-decoration-none">
                  <img src="{{ $rec->cover_image ?: ($rec->photos->first()?->thumbnail_url ?: 'https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=900&q=85') }}" alt="{{ $rec->title }}" style="object-fit: cover;">
                  <div class="overlay">
                    <strong>{{ $rec->title }}</strong>
                    <span>{{ $rec->location ?: 'South Africa' }} &bull; {{ $rec->photos_count }} shots</span>
                  </div>
                </a>
              @empty
                <p class="text-muted small p-3">No recent uploads found.</p>
              @endforelse
            </div>

          <div class="panel">
            <div class="panel-head">
              <div>
                <span class="eyebrow-blue">REVIEWS</span>
                <h3>Recent client feedback</h3>
              </div>
            </div>

            <div class="review-list">
              <div class="p-4 text-center text-muted small">
                <i class="bi bi-star text-warning fs-3 mb-2 d-block"></i>
                <strong class="text-white d-block">No client reviews yet</strong>
                <span style="font-size: 0.8rem;">Customer ratings and feedback on your event photos will appear here after orders are placed.</span>
              </div>
            </div>
          </div>
        </div>

        <div class="dashboard-grid">
          <div class="panel">
            <div class="panel-head">
              <div>
                <span class="eyebrow-blue">TASKS</span>
                <h3>Quick actions</h3>
              </div>
            </div>

            <div class="task-list">
              <div class="task-item">
                <div class="task-icon"><i class="bi bi-cloud-arrow-up text-warning"></i></div>
                <div class="task-text">
                  <strong>{{ $activeGalleries > 0 ? 'Upload More Photos' : 'Upload First Gallery' }}</strong>
                  <span>{{ $activeGalleries > 0 ? 'Add more captures to your live albums' : 'Create an event and upload batch photos' }}</span>
                </div>
                <a class="small-cta" href="/photographer-upload-new">Upload</a>
              </div>

              <div class="task-item">
                <div class="task-icon"><i class="bi bi-bank text-info"></i></div>
                <div class="task-text">
                  <strong>Banking &amp; EFT Payouts</strong>
                  <small>{{ !empty($photographer->bank_name) ? ($photographer->bank_name . ' · ' . ucfirst($photographer->account_type ?? 'account')) : 'Configure SA Bank for direct settlement' }}</small>
                </div>
                <a class="small-cta" href="/photographer-payouts">Configure</a>
              </div>

              <div class="task-item">
                <div class="task-icon"><i class="bi bi-shield-lock text-success"></i></div>
                <div class="task-text">
                  <strong>Watermark Studio</strong>
                  <span>Custom logos, stamps &amp; Anti-AI proofing</span>
                </div>
                <a class="small-cta" href="/photographer-watermark">Manage</a>
              </div>
            </div>
          </div>

          <div class="panel">
            <div class="panel-head">
              <div>
                <span class="eyebrow-blue">EARNINGS</span>
                <h3>Monthly payout</h3>
              </div>
            </div>
            <div class="summary-card accent" style="margin-bottom: 0;">
              <span class="card-label"><i class="bi bi-wallet2"></i> Available balance</span>
              <strong>R {{ number_format($totalRevenue * 0.85, 2) }}</strong>
              <small><span>Banking status</span><b>{{ !empty($photographer->bank_name) ? $photographer->bank_name : 'EFT Pending' }}</b></small>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <nav class="workspace-bottom-nav" id="bottomNav" aria-label="Mobile photographer navigation">
    <a class="active" href="/photographer-dashboard"><i class="bi bi-grid-1x2"></i><span>Home</span></a>
    <a href="/photographer-bookings"><i class="bi bi-calendar-event"></i><span>Bookings</span></a>
    <a href="/photographer-gallery"><i class="bi bi-images"></i><span>Gallery</span></a>
    <a href="/photographer-earnings"><i class="bi bi-wallet2"></i><span>Earnings</span></a>
    <a href="/photographer-profile"><i class="bi bi-person"></i><span>Profile</span></a>
  </nav>

  @include('web.partials.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const bookingsChart = document.getElementById('bookingsChart');

    if (bookingsChart) {
      new Chart(bookingsChart, {
        type: 'bar',
        data: {
          labels: ['W1', 'W2', 'W3', 'W4', 'W5', 'W6', 'W7'],
          datasets: [{
            label: 'Sales',
            data: {!! json_encode(!empty($weeklySalesData) ? $weeklySalesData : [0, 0, 0, 0, 0, 0, 0]) !!},
            backgroundColor: ['#7cb8ff', '#7cb8ff', '#7cb8ff', '#0b2d5b', '#0b2d5b', '#ff8a00', '#ff8a00'],
            borderRadius: 8,
            borderSkipped: false
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: { legend: { display: false } },
          scales: {
            x: { grid: { display: false }, ticks: { color: '#59708f' } },
            y: { beginAtZero: true, grid: { color: 'rgba(11,45,91,.08)' }, ticks: { color: '#59708f' } }
          }
        }
      });
    }
  </script>
  <script src="app.js"></script>
</body>
</html>
