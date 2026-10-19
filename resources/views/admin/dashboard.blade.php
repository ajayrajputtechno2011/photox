<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="PhotoX Admin dashboard">
  <title>PhotoX Admin | Dashboard</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet">
</head>
<body>
  <div class="app-shell">
    <aside class="sidebar" id="sidebar" aria-label="Main navigation">
      <div class="sidebar-inner">
                <a class="brand" href="/admin/dashboard" aria-label="PhotoX Admin home"><img class="brand-logo" src="{{ asset('admin-assets/logo.png') }}" alt="PhotoX Admin"></a>
        <div class="workspace-switcher"><span class="workspace-avatar">PS</span><span class="workspace-copy"><small>Workspace</small><strong>Photo Studio</strong></span><i class="bi bi-chevron-down"></i></div>
                <a class="dashboard-link nav-link active" href="/admin/dashboard"><i class="bi bi-grid-1x2-fill"></i><span>Dashboard</span></a>
        <div class="nav-label nav-label-spaced">Marketplace</div>
        <nav class="nav flex-column sidebar-nav">
          <a class="nav-link" href="/admin/events"><i class="bi bi-calendar-event"></i><span>Events</span></a>
          <a class="nav-link" href="/admin/galleries"><i class="bi bi-collection"></i><span>Galleries</span></a>
          <a class="nav-link" href="/admin/images"><i class="bi bi-image"></i><span>Images</span></a>
          <a class="nav-link" href="/admin/orders"><i class="bi bi-bag-check"></i><span>Orders</span></a>
          <a class="nav-link" href="/admin/customers"><i class="bi bi-people"></i><span>Customers</span></a>
        </nav>
        <div class="nav-label nav-label-spaced">Photographers</div>
        <nav class="nav flex-column sidebar-nav">
          <a class="nav-link" href="/admin/photographers"><i class="bi bi-camera2"></i><span>Photographers</span></a>
          <a class="nav-link" href="/admin/memberships"><i class="bi bi-person-vcard"></i><span>Memberships</span></a>
          <a class="nav-link" href="/admin/commissions"><i class="bi bi-percent"></i><span>Commissions</span></a>
          <a class="nav-link" href="/admin/payouts"><i class="bi bi-wallet2"></i><span>Payouts</span></a>
        </nav>
        <div class="nav-label nav-label-spaced">AI &amp; Media</div>
        <nav class="nav flex-column sidebar-nav">
          <a class="nav-link" href="/admin/ai-processing"><i class="bi bi-stars"></i><span>AI Processing</span></a>
          <a class="nav-link" href="/admin/storage"><i class="bi bi-cloud-arrow-up"></i><span>Storage</span></a>
          <a class="nav-link" href="/admin/watermarks"><i class="bi bi-droplet"></i><span>Watermarks</span></a>
        </nav>
        <div class="nav-label nav-label-spaced">Business</div>
        <nav class="nav flex-column sidebar-nav">
          <a class="nav-link" href="/admin/payments"><i class="bi bi-credit-card"></i><span>Payments</span></a>
          <a class="nav-link" href="/admin/coupons-discounts"><i class="bi bi-tags"></i><span>Coupons &amp; Discounts</span></a>
          <a class="nav-link" href="/admin/sponsors"><i class="bi bi-award"></i><span>Sponsors</span></a>
          <a class="nav-link" href="/admin/banners"><i class="bi bi-layout-text-window"></i><span>Banners</span></a>
        </nav>
        <div class="nav-label nav-label-spaced">Organisations</div>
        <nav class="nav flex-column sidebar-nav">
<a class="nav-link" href="/admin/categories"><i class="bi bi-tags"></i><span>Categories</span></a>
          <a class="nav-link" href="/admin/schools"><i class="bi bi-mortarboard"></i><span>Schools</span></a>
          <a class="nav-link" href="/admin/companies"><i class="bi bi-buildings"></i><span>Companies</span></a>
</nav>
        <div class="nav-label nav-label-spaced">Content</div>
        <nav class="nav flex-column sidebar-nav">
          <a class="nav-link" href="/admin/page-banners"><i class="bi bi-card-heading"></i><span>Page Banners</span></a>
          <a class="nav-link" href="/admin/blog"><i class="bi bi-pencil-square"></i><span>Blog</span></a>
          <a class="nav-link" href="/admin/announcements"><i class="bi bi-megaphone"></i><span>Announcements</span></a>
          <a class="nav-link" href="/admin/messages"><i class="bi bi-chat-left-text"></i><span>Messages</span></a>
          <a class="nav-link" href="/admin/notifications"><i class="bi bi-bell"></i><span>Notifications</span></a>
          <a class="nav-link" href="/admin/email-templates"><i class="bi bi-envelope-paper"></i><span>Email Templates</span></a>
        </nav>
        <div class="nav-label nav-label-spaced">Reporting</div>
        <nav class="nav flex-column sidebar-nav">
          <a class="nav-link" href="/admin/reports"><i class="bi bi-bar-chart"></i><span>Reports</span></a>
          <a class="nav-link" href="/admin/banner-analytics"><i class="bi bi-graph-up-arrow"></i><span>Banner Analytics</span></a>
        </nav>
        <div class="nav-label nav-label-spaced">System</div>
        <nav class="nav flex-column sidebar-nav">
          <a class="nav-link" href="/admin/settings"><i class="bi bi-sliders2"></i><span>Settings</span></a>
          <a class="nav-link" href="/admin/audit-logs"><i class="bi bi-shield-check"></i><span>Audit Logs</span></a>
        </nav>      </div>
    </aside>

    <div class="main-panel">
      <header class="topbar"><div class="d-flex align-items-center gap-3"><button class="icon-button menu-trigger" id="menuToggle" type="button" aria-label="Open navigation" aria-controls="sidebar" aria-expanded="false"><i class="bi bi-list"></i></button><div class="breadcrumb-wrap"><span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><strong>Dashboard</strong></div></div><div class="topbar-actions"><button class="icon-button" type="button" aria-label="Search"><i class="bi bi-search"></i></button><button class="icon-button notification-button" type="button" aria-label="Notifications"><i class="bi bi-bell"></i><span></span></button><div class="topbar-divider"></div><div class="profile-menu-wrap"><button class="profile-button" type="button" aria-haspopup="true" aria-expanded="false"><span class="profile-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'AL', 0, 2)) }}</span><span class="profile-copy"><strong>{{ auth()->user()->name ?? 'Administrator' }}</strong><small>Super Admin</small></span><i class="bi bi-chevron-down"></i></button><div class="profile-dropdown-menu" role="menu"><form action="{{ route('logout') }}" method="POST" class="d-inline">
  @csrf
  <button type="submit" class="profile-menu-item danger border-0 bg-transparent w-100 text-start py-2 px-3" role="menuitem" style="cursor:pointer;">
    <i class="bi bi-box-arrow-right"></i><span class="ms-2">Logout</span>
  </button>
</form></div></div></div></header>

      <main class="content-area admin-dashboard">
        <div class="page-intro row align-items-end g-3"><div class="col-lg-8"><p class="eyebrow">Platform overview</p><h1>Good morning, {{ auth()->user()->name ?? 'Administrator' }}!</h1><p class="intro-copy">Here is the real-time health of your PhotoX marketplace today.</p></div><div class="col-lg-4 d-flex justify-content-lg-end"><select class="form-select dashboard-period" aria-label="Dashboard date range"><option>Last 30 days</option><option>Last 7 days</option><option>This year</option></select></div></div>

        <section class="row g-3 dashboard-metrics" aria-label="Admin dashboard metrics">
          <div class="col-xl-3 col-md-6"><article class="stat-card"><div class="stat-top"><span class="stat-icon green"><i class="bi bi-currency-dollar"></i></span><span class="trend positive"><i class="bi bi-arrow-up-right"></i> Active</span></div><p>Total marketplace</p><h2>ZAR Live</h2><small>Yoco Gateway Ready</small></article></div>
          <div class="col-xl-3 col-md-6"><article class="stat-card"><div class="stat-top"><span class="stat-icon orange"><i class="bi bi-percent"></i></span><span class="trend positive"><i class="bi bi-shield-check"></i> Standard</span></div><p>Commission tiering</p><h2>10% - 20%</h2><small>Custom creator override enabled</small></article></div>
          <div class="col-xl-3 col-md-6"><article class="stat-card"><div class="stat-top"><span class="stat-icon blue"><i class="bi bi-wallet2"></i></span><span class="trend neutral">EFT</span></div><p>Settlement gateway</p><h2>South Africa</h2><small>Universal Branch Codes</small></article></div>
          <div class="col-xl-3 col-md-6"><article class="stat-card"><div class="stat-top"><span class="stat-icon violet"><i class="bi bi-bag-check"></i></span><span class="trend positive">POPIA</span></div><p>Compliance</p><h2>Protected</h2><small>100% Data Encryption</small></article></div>
        </section>

        <section class="row g-3 dashboard-entity-row" aria-label="Platform entities">
          <div class="col-xl-2 col-md-4 col-6"><a href="/admin/photographers" class="text-decoration-none"><article class="entity-card"><i class="bi bi-camera2"></i><span>Photographers</span><strong>{{ $photographersCount ?? 6 }}</strong><small>{{ $pendingPhotographersCount ?? 0 }} pending</small></article></a></div>
          <div class="col-xl-2 col-md-4 col-6"><a href="/admin/customers" class="text-decoration-none"><article class="entity-card"><i class="bi bi-people"></i><span>Customers</span><strong>{{ $customersCount ?? 1 }}</strong><small>+{{ $newCustomersThisMonth ?? 1 }} this month</small></article></a></div>
          <div class="col-xl-2 col-md-4 col-6"><a href="/admin/events" class="text-decoration-none"><article class="entity-card"><i class="bi bi-calendar-event"></i><span>Events</span><strong>{{ $eventsCount ?? 12 }}</strong><small>{{ $upcomingEventsCount ?? 12 }} published</small></article></a></div>
          <div class="col-xl-2 col-md-4 col-6"><a href="/admin/galleries" class="text-decoration-none"><article class="entity-card"><i class="bi bi-collection"></i><span>Galleries</span><strong>{{ $galleriesCount ?? 12 }}</strong><small>Live on store</small></article></a></div>
          <div class="col-xl-2 col-md-4 col-6"><a href="/admin/images" class="text-decoration-none"><article class="entity-card"><i class="bi bi-images"></i><span>Images</span><strong>{{ $photosCount ?? 24 }}</strong><small>Cloud indexed</small></article></a></div>
          <div class="col-xl-2 col-md-4 col-6"><a href="/admin/payouts" class="text-decoration-none"><article class="entity-card"><i class="bi bi-bank"></i><span>EFT Ready</span><strong>{{ $eftReadyCount ?? 0 }}</strong><small>{{ $missingBankingCount ?? 0 }} missing</small></article></a></div>
        </section>

        <section class="row g-4 dashboard-chart-row">
          <div class="col-xl-8"><article class="panel admin-chart-panel"><div class="panel-header"><div><p class="eyebrow">Financial performance</p><h3>Revenue and orders</h3></div><div class="chart-legend"><span><i class="legend-line revenue"></i>Revenue</span><span><i class="legend-line orders"></i>Orders</span></div></div><div class="revenue-summary"><strong>ZAR Active</strong><span class="trend positive"><i class="bi bi-arrow-up-right"></i> Marketplace</span><small>Connected with Yoco Gateway</small></div><div class="chart-wrap" aria-label="Revenue and orders chart"><div class="chart-y-labels"><span>R 30k</span><span>R 20k</span><span>R 10k</span><span>R 0</span></div><div class="chart"><div class="grid-line line-1"></div><div class="grid-line line-2"></div><div class="grid-line line-3"></div><div class="grid-line line-4"></div><svg viewBox="0 0 700 220" preserveAspectRatio="none" role="img" aria-label="Revenue trend"><defs><linearGradient id="areaFill" x1="0" x2="0" y1="0" y2="1"><stop offset="0" stop-color="#ff8a00" stop-opacity=".25"></stop><stop offset="1" stop-color="#ff8a00" stop-opacity="0"></stop></linearGradient></defs><path class="chart-area" d="M0,180 C55,168 70,154 120,162 S188,125 235,139 S290,105 340,119 S390,92 440,107 S495,70 545,86 S610,55 700,28 L700,220 L0,220 Z"></path><path class="chart-line" d="M0,180 C55,168 70,154 120,162 S188,125 235,139 S290,105 340,119 S390,92 440,107 S495,70 545,86 S610,55 700,28"></path><path class="chart-order-line" d="M0,201 C55,193 70,187 120,193 S188,169 235,178 S290,156 340,168 S390,143 440,157 S495,127 545,143 S610,119 700,102"></path><circle cx="700" cy="28" r="5" class="chart-point"></circle></svg><div class="chart-x-labels"><span>Jun</span><span>Jul</span><span>Aug</span><span>Sep</span><span>Oct</span><span>Nov</span><span>Dec</span></div></div></div></article></div>
          <div class="col-xl-4"><article class="panel dashboard-side-panel"><div class="panel-header"><div><p class="eyebrow">Marketplace leaders</p><h3>Photographers</h3></div><a class="view-link" href="/admin/photographers">View all <i class="bi bi-arrow-up-right"></i></a></div><div class="rank-list">
            @if(isset($topPhotographers) && count($topPhotographers) > 0)
              @foreach($topPhotographers as $idx => $tp)
                <div><strong>0{{ $idx + 1 }}</strong><span class="person-avatar person-blue">{{ strtoupper(substr($tp->name, 0, 2)) }}</span><span><b>{{ $tp->name }}</b><small>{{ $tp->photos_count ?? 0 }} photos · {{ ucfirst($tp->tier ?: 'Starter') }}</small></span><em>Active</em></div>
              @endforeach
            @else
              <div><strong>01</strong><span class="person-avatar person-blue">AD</span><span><b>Aiden Daniels</b><small>12 photos</small></span><em>Active</em></div>
            @endif
          </div></article></div>
        </section>

        <section class="row g-4 dashboard-bottom-row">
          <div class="col-lg-4"><article class="panel dashboard-side-panel"><div class="panel-header"><div><p class="eyebrow">Demand</p><h3>Published events</h3></div><a class="view-link" href="/admin/events">View all <i class="bi bi-arrow-up-right"></i></a></div><div class="event-ranking">
            @if(isset($topEvents) && count($topEvents) > 0)
              @foreach($topEvents as $idx => $te)
                <div><span class="event-number">0{{ $idx + 1 }}</span><span><b>{{ $te->name }}</b><small>{{ $te->location ?: 'South Africa' }} · {{ $te->photos_count ?? 0 }} photos</small></span><strong>Active</strong></div>
              @endforeach
            @else
              <div><span class="event-number">01</span><span><b>School A Rugby Day</b><small>Western Cape · 12 photos</small></span><strong>Active</strong></div>
            @endif
          </div></article></div>
          <div class="col-lg-4"><article class="panel dashboard-side-panel"><div class="panel-header"><div><p class="eyebrow">Advertising</p><h3>Banner performance</h3></div><a class="view-link" href="/admin/banners">Manage <i class="bi bi-arrow-up-right"></i></a></div><div class="banner-metric"><div><span>Impressions</span><strong>Live</strong></div><div><span>Clicks</span><strong>Tracking</strong></div><div><span>Placement</span><strong class="ctr-value">Natural Fit</strong></div></div><div class="banner-progress"><span style="width: 100%"></span></div><small class="panel-note">Gilbert &amp; Porsche Banners Active</small></article></div>
          <div class="col-lg-4"><article class="panel dashboard-side-panel"><div class="panel-header"><div><p class="eyebrow">Payouts</p><h3>Creator payouts</h3></div><a class="view-link" href="/admin/payouts">Review <i class="bi bi-arrow-up-right"></i></a></div><div class="payout-summary"><strong>SA National EFT</strong><span>Weekly disbursement</span></div><div class="payout-row"><span><i class="bi bi-shield-check text-success"></i> EFT Ready</span><strong>{{ $eftReadyCount ?? 0 }} accounts</strong></div><div class="payout-row"><span><i class="bi bi-exclamation-circle text-warning"></i> Needs Banking</span><strong>{{ $missingBankingCount ?? 0 }} accounts</strong></div><div class="payout-row"><span><i class="bi bi-file-earmark-spreadsheet"></i> Bank Export</span><strong>CSV Ready</strong></div></article></div>
        </section>
      </main>
    </div>
  </div>
  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
  <script src="{{ asset('admin-assets/js/app.js') }}"></script>
</body>
</html>

