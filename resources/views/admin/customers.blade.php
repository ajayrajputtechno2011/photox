<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <title>PhotoX Admin | Customers</title>
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
          <a class="nav-link active" href="/admin/customers"><i class="bi bi-people"></i><span>Customers</span></a>
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
            <span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><strong>Customers</strong>
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
      <main class="content-area module-page ops-page">
        <div class="page-intro">
          <p class="eyebrow">Customer relationships</p>
          <h1>Customers</h1>
          <p class="intro-copy">Search customer accounts, purchase history and marketplace activity.</p>
        </div>
        <section class="row g-3 mb-3">
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon"><i class="bi bi-people"></i></span><span class="trend positive">+8.4%</span>
              </div>
              <p>Total customers</p>
              <h2>8,642</h2><small>286 joined this month</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon"><i class="bi bi-bag-check"></i></span>
              </div>
              <p>Active buyers</p>
              <h2>3,284</h2><small>38% of all accounts</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon"><i class="bi bi-currency-dollar"></i></span>
              </div>
              <p>Average spend</p>
              <h2>R 486</h2><small>Per customer lifetime</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon"><i class="bi bi-person-plus"></i></span>
              </div>
              <p>New this month</p>
              <h2>286</h2><small>12.6% conversion rate</small>
            </article>
          </div>
        </section>
        <section class="ops-table-panel">
          <div class="d-flex align-items-start justify-content-between gap-3">
            <div>
              <p class="eyebrow">Account directory</p>
              <h3>All customers</h3>
            </div><button aria-label="Filter customers" class="filter-button" type="button"><i class="bi bi-sliders2"></i></button>
          </div>
          <div class="ops-toolbar">
            <div class="search-field">
              <i class="bi bi-search"></i><input aria-label="Search customers" placeholder="Search name, email or customer ID" type="search">
            </div><select aria-label="Filter customer status" class="management-select">
              <option>
                All statuses
              </option>
              <option>
                Active
              </option>
              <option>
                Inactive
              </option>
              <option>
                Blocked
              </option>
            </select><select aria-label="Filter customer activity" class="management-select">
              <option>
                Any activity
              </option>
              <option>
                Purchased
              </option>
              <option>
                No orders
              </option>
            </select><button class="export-button" type="button"><i class="bi bi-download"></i> Export</button>
          </div>
          <div class="ops-table-wrap">
            <table class="table ops-table">
              <thead>
                <tr>
                  <th>Customer</th>
                  <th>Contact</th>
                  <th>Orders</th>
                  <th>Total spend</th>
                  <th>Last active</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="ops-person">
                      <span class="ops-avatar">NM</span><span><strong>Nadia Maseko</strong><small>Customer ID PX-10842</small></span>
                    </div>
                  </td>
                  <td><strong>nadia@email.co</strong><small>+27 82 420 1108</small></td>
                  <td><strong>18 orders</strong><small>6 galleries</small></td>
                  <td><strong>R 4,820</strong><small class="sales-up">+24% this year</small></td>
                  <td><strong>Today</strong><small>10:14 AM</small></td>
                  <td><span class="ops-pill green"><i class="bi bi-check-circle"></i> Active</span></td>
                  <td>
                    <div class="ops-actions">
                      <a aria-label="Open Nadia Maseko" class="row-action" href="/admin/customer-detail"><i class="bi bi-eye"></i></a><a aria-label="Open Nadia orders" class="row-action" href="/admin/admin-orders"><i class="bi bi-bag"></i></a>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="ops-person">
                      <span class="ops-avatar">TM</span><span><strong>Thabo Mokoena</strong><small>Customer ID PX-10791</small></span>
                    </div>
                  </td>
                  <td><strong>thabo@studio.co</strong><small>+27 71 904 2231</small></td>
                  <td><strong>11 orders</strong><small>4 galleries</small></td>
                  <td><strong>R 2,960</strong><small>Last purchase 2 days ago</small></td>
                  <td><strong>Yesterday</strong><small>04:22 PM</small></td>
                  <td><span class="ops-pill green"><i class="bi bi-check-circle"></i> Active</span></td>
                  <td>
                    <div class="ops-actions">
                      <a aria-label="Open Thabo Mokoena" class="row-action" href="/admin/customer-detail"><i class="bi bi-eye"></i></a><a aria-label="Open Thabo orders" class="row-action" href="/admin/admin-orders"><i class="bi bi-bag"></i></a>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="ops-person">
                      <span class="ops-avatar">LW</span><span><strong>Lerato Williams</strong><small>Customer ID PX-10644</small></span>
                    </div>
                  </td>
                  <td><strong>lerato@events.co</strong><small>+27 79 441 0092</small></td>
                  <td><strong>4 orders</strong><small>2 galleries</small></td>
                  <td><strong>R 980</strong><small>Last purchase 8 days ago</small></td>
                  <td><strong>8 days ago</strong><small>09:41 AM</small></td>
                  <td><span class="ops-pill orange"><i class="bi bi-clock"></i> Inactive</span></td>
                  <td>
                    <div class="ops-actions">
                      <a aria-label="Open Lerato Williams" class="row-action" href="/admin/customer-detail"><i class="bi bi-eye"></i></a><a aria-label="Open Lerato orders" class="row-action" href="/admin/admin-orders"><i class="bi bi-bag"></i></a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="ops-pagination">
            <span>Showing 1–3 of 8,642 customers</span>
            <div>
              <span class="active">1</span><button type="button">2</button><button type="button">3</button><span>...</span><button type="button"><i class="bi bi-chevron-right"></i></button>
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