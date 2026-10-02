<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Manage PhotoX photographer accounts" name="description">
  <title>PhotoX Admin | Photographers</title>
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect">
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
        <a class="dashboard-link nav-link" href="/admin/dashboard"><i class="bi bi-grid-1x2-fill"></i><span>Dashboard</span></a>
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
          <a class="nav-link active" href="/admin/photographers"><i class="bi bi-camera2"></i><span>Photographers</span></a>
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
          <a class="nav-link" href="/admin/sports"><i class="bi bi-trophy"></i><span>Sports</span></a>
          <a class="nav-link" href="/admin/categories"><i class="bi bi-tags"></i><span>Categories</span></a>
          <a class="nav-link" href="/admin/schools"><i class="bi bi-mortarboard"></i><span>Schools</span></a>
          <a class="nav-link" href="/admin/companies"><i class="bi bi-buildings"></i><span>Companies</span></a>
          <a class="nav-link" href="/admin/vendors"><i class="bi bi-shop"></i><span>Vendors</span></a>
        </nav>
        <div class="nav-label nav-label-spaced">Content</div>
        <nav class="nav flex-column sidebar-nav">
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
      <header class="topbar">
        <div class="d-flex align-items-center gap-3">
          <button aria-controls="sidebar" aria-expanded="false" aria-label="Open navigation" class="icon-button menu-trigger" id="menuToggle" type="button"><i class="bi bi-list"></i></button>
          <div class="breadcrumb-wrap">
            <span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><strong>Photographers</strong>
          </div>
        </div>
        <div class="topbar-actions">
          <button aria-label="Search" class="icon-button" type="button"><i class="bi bi-search"></i></button><button aria-label="Notifications" class="icon-button notification-button" type="button"><i class="bi bi-bell"></i><span></span></button>
          <div class="topbar-divider"></div>
          <div class="profile-menu-wrap">
            <button class="profile-button" type="button" aria-haspopup="true" aria-expanded="false"><span class="profile-avatar">AL</span><span class="profile-copy"><strong>Alex Lee</strong><small>Administrator</small></span><i class="bi bi-chevron-down"></i></button>
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
        <div class="page-intro row align-items-end g-3">
          <div class="col-lg-8">
            <p class="eyebrow">Account operations</p>
            <h1>Photographers</h1>
            <p class="intro-copy">Review profiles, marketplace performance and account access from one workspace.</p>
          </div>
          <div class="col-lg-4 d-flex justify-content-lg-end">
            <a class="btn btn-primary create-button" href="/admin/add-photograper"><i class="bi bi-person-plus"></i> Add photographer</a>
          </div>
        </div>
        <section class="row g-3 module-stats">
          <div class="col-xl-3 col-md-6">
            <article class="stat-card">
              <div class="stat-top">
                <span class="stat-icon blue"><i class="bi bi-people"></i></span><span class="trend positive">+8.4%</span>
              </div>
              <p>Total accounts</p>
              <h2>428</h2><small>All photographer accounts</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="stat-card">
              <div class="stat-top">
                <span class="stat-icon green"><i class="bi bi-shield-check"></i></span><span class="trend positive">92%</span>
              </div>
              <p>Verified &amp; active</p>
              <h2>394</h2><small>Ready for marketplace work</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="stat-card">
              <div class="stat-top">
                <span class="stat-icon orange"><i class="bi bi-hourglass-split"></i></span><span class="trend neutral">12 new</span>
              </div>
              <p>Needs review</p>
              <h2>18</h2><small>Verification checks pending</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="stat-card">
              <div class="stat-top">
                <span class="stat-icon violet"><i class="bi bi-graph-up-arrow"></i></span><span class="trend positive">+14.2%</span>
              </div>
              <p>Sales this month</p>
              <h2>R 184k</h2><small>Photographer marketplace sales</small>
            </article>
          </div>
        </section>
        <section class="panel module-table-panel">
          <div class="panel-header">
            <div>
              <p class="eyebrow">Photographer directory</p>
              <h3>All photographer accounts</h3>
            </div>
          </div>
          <div class="management-toolbar">
            <div class="search-field">
              <i class="bi bi-search"></i><input aria-label="Search photographers" placeholder="Search name, email or location" type="search">
            </div><select aria-label="Filter by status" class="management-select">
              <option>
                All statuses
              </option>
              <option>
                Verified
              </option>
              <option>
                Pending review
              </option>
              <option>
                Suspended
              </option>
            </select><select aria-label="Filter by membership" class="management-select">
              <option>
                All memberships
              </option>
              <option>
                Pro Studio
              </option>
              <option>
                Starter
              </option>
              <option>
                Enterprise
              </option>
            </select><button class="export-button" type="button"><i class="bi bi-download"></i> Export</button>
          </div>
          <div class="table-responsive">
            <table class="table management-table photographer-table">
              <thead>
                <tr>
                  <th>Photographer</th>
                  <th>Contact</th>
                  <th>Status</th>
                  <th>Activity</th>
                  <th>Sales</th>
                  <th>Last active</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="photographer-person">
                      <img alt="Jordan Miller" src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&amp;fit=crop&amp;w=96&amp;q=80"><span><strong>Jordan Miller</strong><small>Pro Studio · Cape Town</small></span>
                    </div>
                  </td>
                  <td><strong>jordan@lens.co</strong><small>+27 82 441 9082</small></td>
                  <td><span class="status-pill status-verified"><i class="bi bi-check-circle-fill"></i> Verified</span><small>Active account</small></td>
                  <td><strong>24 events</strong><small>86 galleries · 48.9k images</small></td>
                  <td><strong>R 8,420</strong><small class="sales-up">+18.4% this month</small></td>
                  <td><strong>Today</strong><small>09:42 AM</small></td>
                  <td>
                    <div class="table-actions">
                      <a aria-label="View Jordan Miller" class="row-action" href="/admin/photographer-detail"><i class="bi bi-eye"></i></a><a aria-label="Edit Jordan Miller" class="row-action" href="add-photograper.html?edit=jordan"><i class="bi bi-pencil"></i></a><button aria-label="More actions" class="row-action" type="button"><i class="bi bi-three-dots"></i></button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="photographer-person">
                      <img alt="Sarah Kim" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&amp;fit=crop&amp;w=96&amp;q=80"><span><strong>Sarah Kim</strong><small>Pro Studio · Johannesburg</small></span>
                    </div>
                  </td>
                  <td><strong>sarah@capture.co</strong><small>+27 72 118 6304</small></td>
                  <td><span class="status-pill status-verified"><i class="bi bi-check-circle-fill"></i> Verified</span><small>Active account</small></td>
                  <td><strong>18 events</strong><small>54 galleries · 31.2k images</small></td>
                  <td><strong>R 6,890</strong><small class="sales-up">+9.8% this month</small></td>
                  <td><strong>Yesterday</strong><small>04:18 PM</small></td>
                  <td>
                    <div class="table-actions">
                      <a aria-label="View Sarah Kim" class="row-action" href="photographer-detail.html?photographer=sarah"><i class="bi bi-eye"></i></a><a aria-label="Edit Sarah Kim" class="row-action" href="add-photograper.html?edit=sarah"><i class="bi bi-pencil"></i></a><button aria-label="More actions" class="row-action" type="button"><i class="bi bi-three-dots"></i></button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="photographer-person">
                      <img alt="Michael Adams" src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&amp;fit=crop&amp;w=96&amp;q=80"><span><strong>Michael Adams</strong><small>Starter · Durban</small></span>
                    </div>
                  </td>
                  <td><strong>michael@frame.io</strong><small>+27 83 224 7710</small></td>
                  <td><span class="status-pill status-pending"><i class="bi bi-clock-fill"></i> Pending review</span><small>Documents needed</small></td>
                  <td><strong>7 events</strong><small>19 galleries · 8.4k images</small></td>
                  <td><strong>R 2,140</strong><small>Last sale 3 days ago</small></td>
                  <td><strong>2 days ago</strong><small>11:06 AM</small></td>
                  <td>
                    <div class="table-actions">
                      <a aria-label="View Michael Adams" class="row-action" href="photographer-detail.html?photographer=michael"><i class="bi bi-eye"></i></a><a aria-label="Edit Michael Adams" class="row-action" href="add-photograper.html?edit=michael"><i class="bi bi-pencil"></i></a><button aria-label="More actions" class="row-action" type="button"><i class="bi bi-three-dots"></i></button>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="photographer-person">
                      <img alt="Thandi Mokoena" src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&amp;fit=crop&amp;w=96&amp;q=80"><span><strong>Thandi Mokoena</strong><small>Enterprise · Pretoria</small></span>
                    </div>
                  </td>
                  <td><strong>thandi@studio.co</strong><small>+27 71 906 2281</small></td>
                  <td><span class="status-pill status-suspended"><i class="bi bi-pause-circle-fill"></i> Suspended</span><small>Admin action required</small></td>
                  <td><strong>31 events</strong><small>112 galleries · 74.6k images</small></td>
                  <td><strong>R 11,760</strong><small>Last sale 8 days ago</small></td>
                  <td><strong>8 days ago</strong><small>02:30 PM</small></td>
                  <td>
                    <div class="table-actions">
                      <a aria-label="View Thandi Mokoena" class="row-action" href="photographer-detail.html?photographer=thandi"><i class="bi bi-eye"></i></a><a aria-label="Edit Thandi Mokoena" class="row-action" href="add-photograper.html?edit=thandi"><i class="bi bi-pencil"></i></a><button aria-label="More actions" class="row-action" type="button"><i class="bi bi-three-dots"></i></button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="table-pagination">
            <span>Showing 1–4 of 428 photographers</span>
            <div class="table-pagination-controls">
              <button aria-label="Previous page" type="button"><i class="bi bi-chevron-left"></i></button><span class="active-page">1</span><button type="button">2</button><button type="button">3</button><span>...</span><button aria-label="Next page" type="button"><i class="bi bi-chevron-right"></i></button>
            </div>
          </div>
        </section>
      </main>
    </div>
  </div>
  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
  <script src="{{ asset('admin-assets/js/app.js') }}">
  </script>
</body>
</html>