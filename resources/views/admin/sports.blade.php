<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PhotoX Admin | Sports</title>
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
          <a class="nav-link" href="/admin/banners"><i class="bi bi-layout-text-window"></i><span>Banners</span></a>
        </nav>
        <div class="nav-label nav-label-spaced">Organisations</div>
        <nav class="nav flex-column sidebar-nav">
          <a class="nav-link active" href="/admin/sports"><i class="bi bi-trophy"></i><span>Sports</span></a>
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
            <span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><strong>Sports</strong>
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
            <p class="eyebrow">Organisation settings</p>
            <h1>Sports</h1>
            <p class="intro-copy">
              Manage supported sports and see their marketplace activity.
            </p>
          </div>
          <button class="create-button" type="button" data-bs-toggle="modal" data-bs-target="#createSportModal">
            <i class="bi bi-plus-lg"></i> Create sport
          </button>
        </div>

        <section class="row g-3 mb-3" aria-label="Sports summary">
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="color: #ffc47c; background: rgba(255, 138, 0, 0.16)">
                  <i class="bi bi-trophy"></i>
                </span>
              </div>
              <p>Supported sports</p>
              <h2>18</h2>
              <small>Across the marketplace</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="color: #8fe0c4; background: rgba(43, 190, 144, 0.16)">
                  <i class="bi bi-check2-circle"></i>
                </span>
              </div>
              <p>Active sports</p>
              <h2>14</h2>
              <small>Visible to customers</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="color: #9ac8ff; background: rgba(66, 139, 255, 0.16)">
                  <i class="bi bi-calendar-event"></i>
                </span>
              </div>
              <p>Related events</p>
              <h2>86</h2>
              <small>Upcoming and live</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="color: #c8b6ff; background: rgba(132, 95, 255, 0.16)">
                  <i class="bi bi-camera2"></i>
                </span>
              </div>
              <p>Photographers</p>
              <h2>428</h2>
              <small>With sport coverage</small>
            </article>
          </div>
        </section>

        <section class="ops-table-panel">
          <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <div>
              <p class="eyebrow">Sport directory</p>
              <h3 class="mb-0">Supported sports</h3>
            </div>
            <button class="create-button" type="button">
              <i class="bi bi-file-earmark-excel"></i> Export Excel
            </button>
          </div>
          <div class="ops-toolbar">
            <div class="search-field">
              <i class="bi bi-search"></i>
              <input type="search" placeholder="Search sports..." aria-label="Search sports" />
            </div>
            <select class="management-select" aria-label="Filter sport status">
              <option>All statuses</option>
              <option>Active</option>
              <option>Draft</option>
            </select>
          </div>
          <div class="ops-table-wrap">
            <table class="table ops-table">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Sport name</th>
                  <th>Category</th>
                  <th>Events</th>
                  <th>Photographers</th>
                  <th>Status</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <img class="ops-thumbnail" style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px;" src="https://images.unsplash.com/photo-1517466787929-bc90951d0974?w=160&h=160&fit=crop" alt="Rugby thumbnail" />
                  </td>
                  <td><strong>Rugby</strong></td>
                  <td>Team sports</td>
                  <td>24</td>
                  <td>86</td>
                  <td><span class="ops-pill green">Active</span></td>
                  <td>
                    <button class="row-action" type="button" aria-label="Edit Rugby">
                      <i class="bi bi-pencil"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <img class="ops-thumbnail" style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px;" src="https://images.unsplash.com/photo-1530549387789-4c1017266635?w=160&h=160&fit=crop" alt="Athletics thumbnail" />
                  </td>
                  <td><strong>Athletics</strong></td>
                  <td>Track &amp; field</td>
                  <td>18</td>
                  <td>64</td>
                  <td><span class="ops-pill green">Active</span></td>
                  <td>
                    <button class="row-action" type="button" aria-label="Edit Athletics">
                      <i class="bi bi-pencil"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <img class="ops-thumbnail" style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px;" src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?w=160&h=160&fit=crop" alt="Cycling thumbnail" />
                  </td>
                  <td><strong>Cycling</strong></td>
                  <td>Endurance</td>
                  <td>12</td>
                  <td>42</td>
                  <td><span class="ops-pill green">Active</span></td>
                  <td>
                    <button class="row-action" type="button" aria-label="Edit Cycling">
                      <i class="bi bi-pencil"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <img class="ops-thumbnail" style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px;" src="https://images.unsplash.com/photo-1530549387789-4c1017266635?w=160&h=160&fit=crop" alt="Swimming thumbnail" />
                  </td>
                  <td><strong>Swimming</strong></td>
                  <td>Aquatics</td>
                  <td>10</td>
                  <td>28</td>
                  <td><span class="ops-pill gray">Draft</span></td>
                  <td>
                    <button class="row-action" type="button" aria-label="Edit Swimming">
                      <i class="bi bi-pencil"></i>
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

  <!-- Create Sport Modal -->
  <div class="modal fade" id="createSportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0" style="background:#131827; border:1px solid rgba(255,255,255,0.08); color:#f3f4f6; border-radius:16px;">
        <div class="modal-header border-bottom border-secondary border-opacity-25">
          <h5 class="modal-title font-space-grotesk fw-bold">Create New Sport</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form onsubmit="event.preventDefault(); alert('Sport configuration saved.'); bootstrap.Modal.getInstance(document.getElementById('createSportModal')).hide();">
          <div class="modal-body p-4">
            <div class="mb-3">
              <label class="form-label text-secondary small fw-bold">Sport Name</label>
              <input type="text" class="form-control" style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); color:#fff;" placeholder="e.g. Cricket, Tennis" required>
            </div>
            <div class="mb-3">
              <label class="form-label text-secondary small fw-bold">Category</label>
              <input type="text" class="form-control" style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); color:#fff;" placeholder="e.g. Team sports, Racquet sports" required>
            </div>
            <div class="mb-3">
              <label class="form-label text-secondary small fw-bold">Status</label>
              <select class="form-select" style="background:#1a2035; border:1px solid rgba(255,255,255,0.1); color:#fff;">
                <option value="Active">Active</option>
                <option value="Draft">Draft</option>
              </select>
            </div>
          </div>
          <div class="modal-footer border-top border-secondary border-opacity-25">
            <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" style="background:#ff8a00; border:none;">Create Sport</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('admin-assets/js/app.js') }}"></script>
</body>
</html>
