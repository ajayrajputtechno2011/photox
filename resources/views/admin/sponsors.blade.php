<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PhotoX Admin | Sponsors</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet" />
</head>
<body>
  <div class="app-shell">
    @include('admin.partials.sidebar')

    <div class="main-panel">
      <header class="topbar">
        <div class="d-flex align-items-center gap-3">
          <button aria-controls="sidebar" aria-expanded="false" aria-label="Open navigation" class="icon-button menu-trigger" id="menuToggle" type="button">
            <i class="bi bi-list"></i>
          </button>
          <div class="breadcrumb-wrap">
            <span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><strong>Sponsors</strong>
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
            <p class="eyebrow">Admin partnerships</p>
            <h1>Sponsors</h1>
            <p class="intro-copy">
              Manage sponsor profiles, commercial activity and admin-owned relationships.
            </p>
          </div>
          <a class="create-button" href="/admin/add-sponsor">
            <i class="bi bi-plus-lg"></i> Add sponsor
          </a>
        </div>

        <section class="row g-3 mb-3" aria-label="Sponsor summary">
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="color: #ffc47c; background: rgba(255, 138, 0, 0.16)">
                  <i class="bi bi-award"></i>
                </span>
              </div>
              <p>Active sponsors</p>
              <h2>18</h2>
              <small>Across PhotoX partnerships</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="color: #c8b6ff; background: rgba(132, 95, 255, 0.16)">
                  <i class="bi bi-megaphone"></i>
                </span>
              </div>
              <p>Live campaigns</p>
              <h2>32</h2>
              <small>Commercial activity</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="color: #9ac8ff; background: rgba(66, 139, 255, 0.16)">
                  <i class="bi bi-eye"></i>
                </span>
              </div>
              <p>Impressions</p>
              <h2>2.4M</h2>
              <small>This quarter</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="color: #8fe0c4; background: rgba(43, 190, 144, 0.16)">
                  <i class="bi bi-currency-dollar"></i>
                </span>
              </div>
              <p>Tracked spend</p>
              <h2>R 184,200</h2>
              <small>Campaign investment</small>
            </article>
          </div>
        </section>

        <section class="ops-table-panel">
          <div class="d-flex align-items-start justify-content-between gap-3 flex-wrap">
            <div>
              <p class="eyebrow">Partnership directory</p>
              <h3>Sponsor profiles</h3>
            </div>
            <button class="create-button" type="button">
              <i class="bi bi-file-earmark-excel"></i> Export Excel
            </button>
          </div>
          <div class="ops-toolbar">
            <div class="search-field">
              <i class="bi bi-search"></i>
              <input type="search" placeholder="Search sponsor or contact..." aria-label="Search sponsors" />
            </div>
            <select class="management-select" aria-label="Filter sponsor status">
              <option>All statuses</option>
              <option>Active</option>
              <option>Pending</option>
            </select>
          </div>
          <div class="ops-table-wrap">
            <table class="table ops-table">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Sponsor</th>
                  <th>Contact details</th>
                  <th>Campaigns</th>
                  <th>Impressions</th>
                  <th>Spend</th>
                  <th>Status</th>
                  <th>Manage</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <img class="ops-thumbnail" style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px;" src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=160&h=160&fit=crop" alt="Gilbert Rugby thumbnail" />
                  </td>
                  <td>
                    <strong>Gilbert Rugby</strong><br /><small>Sports equipment partner</small>
                  </td>
                  <td>
                    Jordan Miller<br /><small>partnerships@gilbert.co</small>
                  </td>
                  <td>8</td>
                  <td>842,400</td>
                  <td>R 68,400</td>
                  <td><span class="ops-pill green">Active</span></td>
                  <td>
                    <button class="row-action" type="button" aria-label="Manage Gilbert Rugby">
                      <i class="bi bi-pencil"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <img class="ops-thumbnail" style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px;" src="https://images.unsplash.com/photo-1548839140-29a749e1cf4d?w=160&h=160&fit=crop" alt="Peak Energy thumbnail" />
                  </td>
                  <td>
                    <strong>Peak Energy</strong><br /><small>Hydration partner</small>
                  </td>
                  <td>Amara Jones<br /><small>brand@peakenergy.co</small></td>
                  <td>5</td>
                  <td>428,200</td>
                  <td>R 42,800</td>
                  <td><span class="ops-pill green">Active</span></td>
                  <td>
                    <button class="row-action" type="button" aria-label="Manage Peak Energy">
                      <i class="bi bi-pencil"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>
                    <img class="ops-thumbnail" style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px;" src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=160&h=160&fit=crop" alt="Stride Bank thumbnail" />
                  </td>
                  <td>
                    <strong>Stride Bank</strong><br /><small>Financial partner</small>
                  </td>
                  <td>
                    Michael Chen<br /><small>commercial@stride.co</small>
                  </td>
                  <td>2</td>
                  <td>120,800</td>
                  <td>R 18,600</td>
                  <td><span class="ops-pill orange">Pending</span></td>
                  <td>
                    <button class="row-action" type="button" aria-label="Manage Stride Bank">
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
  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
  <script src="{{ asset('admin-assets/js/app.js') }}"></script>
</body>
</html>
