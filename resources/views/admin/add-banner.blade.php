<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PhotoX Admin | Create Banner</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet" />
</head>
<body>
  <div class="app-shell">
    <aside class="sidebar" id="sidebar" aria-label="Main navigation">
      <div class="sidebar-inner">
        <a class="brand" href="/admin/dashboard" aria-label="PhotoX Admin home">
          <img class="brand-logo" src="{{ asset('admin-assets/logo.png') }}" alt="PhotoX Admin" />
        </a>
        <div class="workspace-switcher">
          <span class="workspace-avatar">PS</span>
          <span class="workspace-copy"><small>Workspace</small><strong>Photo Studio</strong></span>
          <i class="bi bi-chevron-down"></i>
        </div>
        <a class="dashboard-link nav-link" href="/admin/dashboard">
          <i class="bi bi-grid-1x2-fill"></i><span>Dashboard</span>
        </a>
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
          <a class="nav-link active" href="/admin/banners"><i class="bi bi-layout-text-window"></i><span>Banners</span></a>
        </nav>
        <div class="nav-label nav-label-spaced">Organisations</div>
        <nav class="nav flex-column sidebar-nav">
          <a class="nav-link" href="/admin/sports"><i class="bi bi-trophy"></i><span>Sports</span></a>
          <a class="nav-link" href="/admin/categories"><i class="bi bi-tags"></i><span>Categories</span></a>
          <a class="nav-link" href="/admin/schools"><i class="bi bi-mortarboard"></i><span>Schools</span></a>
          <a class="nav-link" href="/admin/companies"><i class="bi bi-buildings"></i><span>Companies</span></a>
          <a class="nav-link" href="/admin/vendors"><i class="bi bi-shop"></i><span>Vendors</span></a>
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
        </nav>
      </div>
    </aside>

    <div class="main-panel">
      <header class="topbar">
        <div class="d-flex align-items-center gap-3">
          <button aria-controls="sidebar" aria-expanded="false" aria-label="Open navigation" class="icon-button menu-trigger" id="menuToggle" type="button">
            <i class="bi bi-list"></i>
          </button>
          <div class="breadcrumb-wrap">
            <a class="breadcrumb-muted" href="/admin/banners">Banners</a>
            <i class="bi bi-chevron-right"></i>
            <strong>Create banner</strong>
          </div>
        </div>
        <div class="topbar-actions">
          <button class="icon-button" type="button" aria-label="Search">
            <i class="bi bi-search"></i>
          </button>
          <button class="icon-button notification-button" type="button" aria-label="Notifications">
            <i class="bi bi-bell"></i><span></span>
          </button>
          <div class="topbar-divider"></div>
          <div class="profile-menu-wrap">
            <button class="profile-button" type="button" aria-haspopup="true" aria-expanded="false">
              <span class="profile-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'AL', 0, 2)) }}</span>
              <span class="profile-copy"><strong>{{ Auth::user()->name ?? 'Alex Lee' }}</strong><small>Administrator</small></span>
              <i class="bi bi-chevron-down"></i>
            </button>
            <div class="profile-dropdown-menu" role="menu">
              <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="profile-menu-item danger border-0 bg-transparent w-100 text-start py-2 px-3" role="menuitem" style="cursor:pointer;">
                  <i class="bi bi-box-arrow-right"></i><span class="ms-2">Logout</span>
                </button>
              </form>
            </div>
          </div>
        </div>
      </header>

      <main class="content-area module-page">
        <div class="page-intro">
          <p class="eyebrow">Advertising operations</p>
          <h1>Create banner</h1>
          <p class="intro-copy">
            Add promotional creative, placement and sponsor details for a new campaign.
          </p>
        </div>

        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="ops-form">
          @csrf
          <section class="ops-panel">
            <div class="section-heading">
              <div>
                <p class="eyebrow">Creative details</p>
                <h3>Banner identity</h3>
              </div>
              <span class="form-step">01 / 03</span>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label" for="banner-title">Banner name / Title <small class="text-muted">(Optional — leave blank for designed graphic banners)</small></label>
                <input class="form-control" id="banner-title" name="title" placeholder="e.g. Gilbert Rugby (Optional)" />
              </div>
              <div class="col-md-6">
                <label class="form-label" for="banner-subtitle">Subtitle <small class="text-muted">(Optional)</small></label>
                <input class="form-control" id="banner-subtitle" name="subtitle" placeholder="e.g. Official Match Gear 2026" />
              </div>
              <div class="col-md-6">
                <label class="form-label" for="sponsor">Sponsor / Company</label>
                <input class="form-control" id="sponsor" name="sponsor_name" placeholder="e.g. Gilbert Rugby, Peak Energy" />
              </div>
              <div class="col-md-6">
                <label class="form-label" for="placement">Placement</label>
                <select class="form-select" id="placement" name="placement">
                  <option value="explore_hero">Explore Hero (Carousel)</option>
                  <option value="home_top">Home Top</option>
                  <option value="event_detail">Event Detail</option>
                  <option value="marketplace">Marketplace</option>
                  <option value="sidebar">Sidebar</option>
                  <option value="image_preview">Image Preview (Lightbox Ad)</option>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label" for="destination">Destination Link URL</label>
                <input class="form-control" id="destination" name="link_url" type="text" placeholder="https://photox.co.za/campaign or /events" />
              </div>
            </div>
          </section>

          <section class="ops-panel">
            <div class="section-heading">
              <div>
                <p class="eyebrow">Campaign schedule</p>
                <h3>Flight dates and delivery</h3>
              </div>
              <span class="form-step">02 / 03</span>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label" for="start-date">Start date</label>
                <input class="form-control" id="start-date" name="start_date" type="date" />
              </div>
              <div class="col-md-6">
                <label class="form-label" for="end-date">End date</label>
                <input class="form-control" id="end-date" name="end_date" type="date" />
              </div>
              <div class="col-md-6">
                <label class="form-label" for="order">Sort Order</label>
                <input class="form-control" id="order" name="order" type="number" min="0" value="0" />
              </div>
              <div class="col-md-6">
                <label class="form-label" for="status">Status</label>
                <select class="form-select" id="status" name="is_active">
                  <option value="1">Active</option>
                  <option value="0">Inactive / Draft</option>
                </select>
              </div>
            </div>
          </section>

          <section class="ops-panel">
            <div class="section-heading">
              <div>
                <p class="eyebrow">Creative asset</p>
                <h3>Upload banner artwork</h3>
              </div>
              <span class="form-step">03 / 03</span>
            </div>
            <div class="upload-zone" onclick="document.getElementById('banner-image-input').click();" style="cursor: pointer;">
              <i class="bi bi-image"></i>
              <div>
                <strong>Upload banner creative</strong>
                <p>PNG, JPG or WebP · recommended 1200 x 400px or 728 x 90px</p>
              </div>
              <input type="file" id="banner-image-input" name="image" accept="image/*" style="display:none;" onchange="if(this.files[0]) document.getElementById('selected-file-name').innerText = this.files[0].name;" />
              <button class="btn btn-outline-light" type="button" onclick="document.getElementById('banner-image-input').click();">
                Choose file
              </button>
            </div>
            <div class="mt-2 text-center text-info small" id="selected-file-name"></div>
            <div class="form-check mt-3">
              <input class="form-check-input" id="approval" type="checkbox" checked />
              <label class="form-check-label" for="approval">Mark this banner ready for publication</label>
            </div>
          </section>

          <div class="ops-form-actions">
            <a class="btn btn-outline-light" href="/admin/banners">Cancel</a>
            <button class="btn btn-primary" type="submit">
              <i class="bi bi-layout-text-window"></i> Create banner
            </button>
          </div>
        </form>
      </main>
    </div>
  </div>
  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
  <script src="{{ asset('admin-assets/js/app.js') }}"></script>
</body>
</html>
