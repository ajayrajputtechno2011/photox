<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PhotoX Admin | Payments</title>
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
          <a class="nav-link active" href="/admin/payments"><i class="bi bi-credit-card"></i><span>Payments</span></a>
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
            <span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><strong>Payments</strong>
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

      <main class="content-area module-page ops-page">
        <div class="page-intro d-flex align-items-start justify-content-between gap-3 flex-wrap">
          <div>
            <p class="eyebrow">Financial Operations</p>
            <h1>Payments &amp; Transactions</h1>
            <p class="intro-copy">
              Monitor real-time payments, gateway transactions, customer charges and settlement status.
            </p>
          </div>
          <button class="create-button" type="button">
            <i class="bi bi-file-earmark-excel"></i> Export Report
          </button>
        </div>

        <section class="row g-3 mb-3" aria-label="Payment summary">
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="color: #8fe0c4; background: rgba(43, 190, 144, 0.16)">
                  <i class="bi bi-credit-card"></i>
                </span>
                <span class="trend positive"><i class="bi bi-arrow-up-right"></i> 18.2%</span>
              </div>
              <p>Total Processed</p>
              <h2>R 142,850</h2>
              <small>Last 30 days volume</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="color: #9ac8ff; background: rgba(66, 139, 255, 0.16)">
                  <i class="bi bi-check2-all"></i>
                </span>
                <span class="trend positive">98.4%</span>
              </div>
              <p>Success Rate</p>
              <h2>1,215</h2>
              <small>Completed payments</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="color: #ffc47c; background: rgba(255, 138, 0, 0.16)">
                  <i class="bi bi-hourglass-split"></i>
                </span>
              </div>
              <p>Pending Clearance</p>
              <h2>R 3,420</h2>
              <small>8 transactions awaiting bank</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="color: #ff8a8a; background: rgba(255, 68, 68, 0.16)">
                  <i class="bi bi-exclamation-octagon"></i>
                </span>
              </div>
              <p>Failed / Disputed</p>
              <h2>R 680</h2>
              <small>3 declined by issuer</small>
            </article>
          </div>
        </section>

        <section class="ops-table-panel">
          <div class="d-flex align-items-start justify-content-between gap-3 flex-wrap">
            <div>
              <p class="eyebrow">Transaction Ledger</p>
              <h3>Payment Records</h3>
            </div>
          </div>
          <div class="ops-toolbar">
            <div class="search-field">
              <i class="bi bi-search"></i>
              <input type="search" placeholder="Search transaction ID, customer or order..." aria-label="Search payments" />
            </div>
            <select class="management-select" aria-label="Filter payment status">
              <option>All statuses</option>
              <option>Completed</option>
              <option>Pending</option>
              <option>Failed</option>
            </select>
          </div>
          <div class="ops-table-wrap">
            <table class="table ops-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Transaction ID</th>
                  <th>Customer</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td><strong>TXN-001</strong></td>
                  <td>Jane Doe</td>
                  <td><strong>R 25.50</strong></td>
                  <td>2026-01-15</td>
                  <td><span class="ops-pill green">Completed</span></td>
                  <td>
                    <button class="row-action" type="button" aria-label="View TXN-001" onclick="alert('Transaction TXN-001: Completed. Amount: R 25.50');">
                      <i class="bi bi-eye"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td><strong>TXN-002</strong></td>
                  <td>John Smith</td>
                  <td><strong>R 18.75</strong></td>
                  <td>2026-01-16</td>
                  <td><span class="ops-pill green">Completed</span></td>
                  <td>
                    <button class="row-action" type="button" aria-label="View TXN-002" onclick="alert('Transaction TXN-002: Completed. Amount: R 18.75');">
                      <i class="bi bi-eye"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>3</td>
                  <td><strong>TXN-003</strong></td>
                  <td>Priya Kumar</td>
                  <td><strong>R 32.00</strong></td>
                  <td>2026-01-17</td>
                  <td><span class="ops-pill orange">Pending</span></td>
                  <td>
                    <button class="row-action" type="button" aria-label="View TXN-003" onclick="alert('Transaction TXN-003: Pending clearance.');">
                      <i class="bi bi-eye"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>4</td>
                  <td><strong>TXN-004</strong></td>
                  <td>Aarav Patel</td>
                  <td><strong>R 15.20</strong></td>
                  <td>2026-01-18</td>
                  <td><span class="ops-pill green">Completed</span></td>
                  <td>
                    <button class="row-action" type="button" aria-label="View TXN-004" onclick="alert('Transaction TXN-004: Completed. Amount: R 15.20');">
                      <i class="bi bi-eye"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>5</td>
                  <td><strong>TXN-005</strong></td>
                  <td>Sofia Lee</td>
                  <td><strong>R 28.90</strong></td>
                  <td>2026-01-19</td>
                  <td><span class="ops-pill green">Completed</span></td>
                  <td>
                    <button class="row-action" type="button" aria-label="View TXN-005" onclick="alert('Transaction TXN-005: Completed. Amount: R 28.90');">
                      <i class="bi bi-eye"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>6</td>
                  <td><strong>TXN-006</strong></td>
                  <td>Mohit Singh</td>
                  <td><strong>R 22.45</strong></td>
                  <td>2026-01-20</td>
                  <td><span class="ops-pill" style="color: #ff8a8a; background: rgba(255, 68, 68, 0.16);">Failed</span></td>
                  <td>
                    <button class="row-action" type="button" aria-label="View TXN-006" onclick="alert('Transaction TXN-006: Failed - Insufficient funds.');">
                      <i class="bi bi-eye"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </section>
      </main>
    </div>
  </div>
  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
  <script src="{{ asset('admin-assets/js/app.js') }}"></script>
</body>
</html>
