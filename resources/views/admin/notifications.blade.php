<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PhotoX Admin | Notifications</title>
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
            <span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><strong>Notifications</strong>
          </div>
        </div>
        <div class="topbar-actions">
          <button class="icon-button" type="button" aria-label="Search">
            <i class="bi bi-search"></i>
          </button>
          <button class="icon-button notification-button active" type="button" aria-label="Notifications">
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
            <p class="eyebrow">Platform communication</p>
            <h1>System Notifications</h1>
            <p class="intro-copy">
              Manage system notification broadcasts, automated alerts and user subscription triggers.
            </p>
          </div>
          <button class="create-button" type="button" onclick="alert('Notification broadcast modal');">
            <i class="bi bi-send"></i> Send Broadcast
          </button>
        </div>

        <section class="row g-3 mb-3">
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="color: #9ac8ff; background: rgba(66, 139, 255, 0.16)">
                  <i class="bi bi-bell"></i>
                </span>
              </div>
              <p>Total Sent</p>
              <h2>48,250</h2>
              <small>Last 30 days</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="color: #8fe0c4; background: rgba(43, 190, 144, 0.16)">
                  <i class="bi bi-check-circle"></i>
                </span>
              </div>
              <p>Delivery Rate</p>
              <h2>99.2%</h2>
              <small>Push &amp; in-app</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="color: #ffc47c; background: rgba(255, 138, 0, 0.16)">
                  <i class="bi bi-envelope"></i>
                </span>
              </div>
              <p>Email Triggers</p>
              <h2>14,820</h2>
              <small>Transactional emails</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="color: #c8b6ff; background: rgba(132, 95, 255, 0.16)">
                  <i class="bi bi-broadcast"></i>
                </span>
              </div>
              <p>Active Channels</p>
              <h2>6</h2>
              <small>In-app, SMS, Email</small>
            </article>
          </div>
        </section>

        <section class="ops-table-panel">
          <div class="d-flex align-items-start justify-content-between gap-3 flex-wrap">
            <div>
              <p class="eyebrow">Recent broadcasts</p>
              <h3>Broadcast History</h3>
            </div>
          </div>
          <div class="ops-table-wrap mt-3">
            <table class="table ops-table">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Target Audience</th>
                  <th>Channel</th>
                  <th>Sent Date</th>
                  <th>Delivered</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><strong>Platform Maintenance Notice</strong><br><small>Scheduled upgrade</small></td>
                  <td>All Users</td>
                  <td>In-app + Email</td>
                  <td>01 Oct 2026</td>
                  <td>12,450</td>
                  <td><span class="ops-pill green">Sent</span></td>
                </tr>
                <tr>
                  <td><strong>Watermark System Update</strong><br><small>New dynamic grid release</small></td>
                  <td>Photographers</td>
                  <td>In-app</td>
                  <td>28 Sep 2026</td>
                  <td>428</td>
                  <td><span class="ops-pill green">Sent</span></td>
                </tr>
                <tr>
                  <td><strong>Spring Athletics Gallery Live</strong><br><small>Event photos published</small></td>
                  <td>Event Attendees</td>
                  <td>Push Notification</td>
                  <td>25 Sep 2026</td>
                  <td>1,840</td>
                  <td><span class="ops-pill green">Sent</span></td>
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
