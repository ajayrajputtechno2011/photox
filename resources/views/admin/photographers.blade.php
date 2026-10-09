<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <title>PhotoX Admin | Photographers</title>
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet">
  <style>
    /* Dark Theme High-Contrast Text Overrides for Photographer Directory */
    .photographer-table {
      --bs-table-bg: transparent !important;
      --bs-table-color: #f8fafc !important;
    }
    .photographer-table th {
      color: #94a3b8 !important;
      font-size: 0.76rem !important;
      font-weight: 700 !important;
      letter-spacing: 0.06em !important;
      text-transform: uppercase !important;
      border-bottom: 1px solid rgba(255, 255, 255, 0.12) !important;
    }
    .photographer-table td {
      color: #e2e8f0 !important;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    }
    .photographer-table td strong {
      color: #ffffff !important;
      font-weight: 600 !important;
      font-size: 0.92rem !important;
    }
    .photographer-table td small,
    .photographer-table .subtext,
    .photographer-table .text-muted,
    .photographer-person small {
      color: #94a3b8 !important; /* Crisp, easily readable light slate silver */
      font-size: 0.82rem !important;
      font-weight: 400 !important;
    }
    .photographer-location {
      color: #94a3b8 !important;
      font-size: 0.8rem !important;
    }

    /* Modern, High-Contrast Status Pills */
    .status-pill {
      display: inline-flex !important;
      align-items: center !important;
      gap: 5px !important;
      padding: 4px 10px !important;
      border-radius: 20px !important;
      font-size: 0.76rem !important;
      font-weight: 600 !important;
      letter-spacing: 0.02em !important;
      white-space: nowrap !important;
    }
    .status-pill.status-verified {
      background: rgba(16, 185, 129, 0.18) !important;
      color: #34d399 !important;
      border: 1px solid rgba(16, 185, 129, 0.45) !important;
    }
    .status-pill.status-pending {
      background: rgba(245, 158, 11, 0.18) !important;
      color: #fbbf24 !important;
      border: 1px solid rgba(245, 158, 11, 0.45) !important;
    }
    .status-pill.status-suspended {
      background: rgba(239, 68, 68, 0.18) !important;
      color: #f87171 !important;
      border: 1px solid rgba(239, 68, 68, 0.45) !important;
    }

    /* High-Contrast Membership Badges */
    .badge-tier-guild {
      background: linear-gradient(135deg, #f59e0b, #d97706) !important;
      color: #0f172a !important;
      font-weight: 700 !important;
    }
    .badge-tier-pro {
      background: rgba(16, 185, 129, 0.22) !important;
      color: #34d399 !important;
      border: 1px solid rgba(16, 185, 129, 0.4) !important;
      font-weight: 600 !important;
    }
    .badge-tier-standard {
      background: rgba(59, 130, 246, 0.22) !important;
      color: #60a5fa !important;
      border: 1px solid rgba(59, 130, 246, 0.4) !important;
      font-weight: 600 !important;
    }
    .badge-tier-starter {
      background: rgba(148, 163, 184, 0.2) !important;
      color: #cbd5e1 !important;
      border: 1px solid rgba(148, 163, 184, 0.35) !important;
      font-weight: 600 !important;
    }
    .badge-vip {
      background: linear-gradient(135deg, #fbbf24, #f59e0b) !important;
      color: #0f172a !important;
      font-weight: 700 !important;
      font-size: 0.68rem !important;
      padding: 2px 7px !important;
      border-radius: 6px !important;
    }

    /* Privilege stats styling */
    .privilege-label {
      color: #94a3b8 !important;
      font-size: 0.8rem !important;
    }
    .privilege-val {
      color: #38bdf8 !important;
      font-weight: 600 !important;
    }

    /* Table Action Buttons */
    .table-actions .row-action {
      color: #cbd5e1 !important;
      background: rgba(255, 255, 255, 0.05) !important;
      border: 1px solid rgba(255, 255, 255, 0.12) !important;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 32px;
      height: 32px;
      border-radius: 8px;
      transition: all 0.2s ease;
    }
    .table-actions .row-action:hover {
      color: #ffffff !important;
      background: rgba(59, 130, 246, 0.28) !important;
      border-color: rgba(59, 130, 246, 0.55) !important;
    }
    .table-actions .row-action.text-danger:hover {
      color: #ffffff !important;
      background: rgba(239, 68, 68, 0.28) !important;
      border-color: rgba(239, 68, 68, 0.55) !important;
    }

    /* Filter & Search Bar */
    .management-toolbar .search-field input {
      color: #ffffff !important;
    }
    .management-toolbar .search-field input::placeholder {
      color: #64748b !important;
    }
    .management-toolbar .management-select {
      background-color: #0f172a !important;
      color: #ffffff !important;
      border: 1px solid rgba(255, 255, 255, 0.15) !important;
    }
    .management-toolbar .management-select option {
      background-color: #0f172a !important;
      color: #ffffff !important;
    }
  </style>
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
          <a class="nav-link active" href="{{ route('admin.photographers.index') }}"><i class="bi bi-camera2"></i><span>Photographers</span></a>
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
        </nav>
      </div>
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
          <div class="profile-menu-wrap">
            <button class="profile-button" type="button" aria-haspopup="true" aria-expanded="false">
              <span class="profile-avatar"><i class="bi bi-person-fill"></i></span>
              <span class="profile-copy"><strong>{{ Auth::user()->name ?? 'PhotoX Admin' }}</strong><small>Administrator</small></span>
            </button>
          </div>
        </div>
      </header>

      <main class="content-area module-page">
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-4" role="alert" style="background: rgba(25,135,84,0.15); border: 1px solid rgba(25,135,84,0.3); color: #2ecc71; border-radius: 10px;">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <div class="page-intro row align-items-end g-3">
          <div class="col-lg-8">
            <p class="eyebrow">Account operations</p>
            <h1>Photographers Directory</h1>
            <p class="intro-copy">Manage real photographer profiles, membership plans, custom overrides, and marketplace access.</p>
          </div>
          <div class="col-lg-4 d-flex justify-content-lg-end gap-2">
            <a class="btn btn-primary create-button" href="{{ route('admin.photographers.create') }}"><i class="bi bi-person-plus"></i> Add photographer</a>
          </div>
        </div>

        <section class="row g-3 module-stats">
          <div class="col-xl-3 col-md-6">
            <article class="stat-card">
              <div class="stat-top">
                <span class="stat-icon blue"><i class="bi bi-people"></i></span><span class="trend positive">Live</span>
              </div>
              <p>Total photographers</p>
              <h2>{{ $totalCount }}</h2><small>All creator accounts</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="stat-card">
              <div class="stat-top">
                <span class="stat-icon green"><i class="bi bi-shield-check"></i></span><span class="trend positive">Active</span>
              </div>
              <p>Verified &amp; active</p>
              <h2>{{ $verifiedCount }}</h2><small>Ready for marketplace</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="stat-card">
              <div class="stat-top">
                <span class="stat-icon orange"><i class="bi bi-hourglass-split"></i></span>
                <span class="trend {{ $pendingCount > 0 ? 'neutral' : 'positive' }}">{{ $pendingCount }} pending</span>
              </div>
              <p>Needs review</p>
              <h2>{{ $pendingCount }}</h2><small>Verification checks pending</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="stat-card">
              <div class="stat-top">
                <span class="stat-icon violet"><i class="bi bi-person-vcard"></i></span><span class="trend positive">Tiers</span>
              </div>
              <p>Active Tiers</p>
              <h2>{{ $memberships->count() }}</h2><small>Includes PhotoGuild SA</small>
            </article>
          </div>
        </section>

        <section class="panel module-table-panel">
          <div class="panel-header">
            <div>
              <p class="eyebrow">Database roster</p>
              <h3>All photographer accounts</h3>
            </div>
            @if(request()->anyFilled(['search', 'status', 'membership']))
              <a href="{{ route('admin.photographers.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-x-circle"></i> Clear Filters
              </a>
            @endif
          </div>

          <!-- Dynamic Filter Toolbar -->
          <form method="GET" action="{{ route('admin.photographers.index') }}" class="management-toolbar">
            <div class="search-field">
              <i class="bi bi-search"></i>
              <input aria-label="Search photographers" name="search" value="{{ request('search') }}" placeholder="Search name, email, phone or city..." type="search">
            </div>

            <select aria-label="Filter by status" name="status" class="management-select" onchange="this.form.submit()">
              <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>All statuses</option>
              <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Verified & Active</option>
              <option value="pending_approval" {{ request('status') === 'pending_approval' ? 'selected' : '' }}>Pending review</option>
              <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
            </select>

            <select aria-label="Filter by membership" name="membership" class="management-select" onchange="this.form.submit()">
              <option value="all" {{ request('membership') === 'all' ? 'selected' : '' }}>All memberships</option>
              @foreach($memberships as $m)
                <option value="{{ $m->id }}" {{ request('membership') == $m->id ? 'selected' : '' }}>
                  {{ $m->name }} ({{ $m->commission_rate }})
                </option>
              @endforeach
            </select>

            <button class="btn btn-sm btn-primary px-3" type="submit">Filter</button>
          </form>

          <div class="table-responsive">
            <table class="table management-table photographer-table align-middle">
              <thead>
                <tr>
                  <th>Photographer</th>
                  <th>Contact</th>
                  <th>Status</th>
                  <th>Membership & Privileges</th>
                  <th>Joined</th>
                  <th class="text-end">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($photographers as $p)
                  @php
                    $isGuild = strtolower($p->tier ?? '') === 'photoguild' || ($p->membership && $p->membership->slug === 'photoguild');
                    $isPro = strtolower($p->tier ?? '') === 'pro' || ($p->membership && $p->membership->slug === 'pro');
                    $isStandard = strtolower($p->tier ?? '') === 'standard' || ($p->membership && $p->membership->slug === 'standard');
                  @endphp
                  <tr>
                    <td>
                      <div class="photographer-person">
                        <img alt="{{ $p->name }}" src="{{ $p->avatar ?: 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=96&q=80' }}" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover; border: 2px solid rgba(255,255,255,0.18);">
                        <span>
                          <strong style="color: #ffffff !important; font-size: 0.95rem;">{{ $p->name }}</strong>
                          <div class="d-flex align-items-center gap-1 flex-wrap mt-1">
                            @if($isGuild)
                              <span class="badge badge-tier-guild py-1 px-2 rounded-pill">PhotoGuild SA</span>
                            @elseif($isPro)
                              <span class="badge badge-tier-pro py-1 px-2 rounded-pill">Pro Member</span>
                            @elseif($isStandard)
                              <span class="badge badge-tier-standard py-1 px-2 rounded-pill">Standard</span>
                            @else
                              <span class="badge badge-tier-starter py-1 px-2 rounded-pill">{{ $p->effective_badge_heading }}</span>
                            @endif
                            <small class="photographer-location">· {{ $p->location ?: 'South Africa' }}</small>
                          </div>
                        </span>
                      </div>
                    </td>
                    <td>
                      <strong class="d-block text-white" style="font-size: 0.92rem;">{{ $p->email }}</strong>
                      <small class="subtext d-block mt-0.5" style="color: #94a3b8 !important;">{{ $p->phone ?: 'No phone added' }}</small>
                    </td>
                    <td>
                      @if($p->status === 'active')
                        <span class="status-pill status-verified"><i class="bi bi-check-circle-fill"></i> Active</span>
                        <small class="subtext d-block mt-1" style="color: #94a3b8 !important;">Verified creator</small>
                      @elseif($p->status === 'pending_approval')
                        <span class="status-pill status-pending"><i class="bi bi-clock-fill"></i> Pending</span>
                        <small class="subtext d-block mt-1" style="color: #94a3b8 !important;">Review required</small>
                      @else
                        <span class="status-pill status-suspended"><i class="bi bi-pause-circle-fill"></i> Suspended</span>
                        <small class="subtext d-block mt-1" style="color: #94a3b8 !important;">Access locked</small>
                      @endif
                    </td>
                    <td>
                      <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                        <strong class="text-white" style="font-size: 0.92rem;">{{ $p->membership?->name ?: ucfirst($p->tier ?: 'Starter') }}</strong>
                        @if($p->custom_storage_limit || $p->custom_commission_rate || !empty($p->custom_features))
                          <span class="badge badge-vip" title="Admin Custom Override">
                            <i class="bi bi-sliders"></i> Custom VIP
                          </span>
                        @endif
                      </div>
                      <div class="privilege-label" style="color: #94a3b8 !important;">
                        Storage: <span class="privilege-val">{{ $p->effective_storage_limit }}</span> · 
                        Comm: <span class="privilege-val">{{ $p->effective_commission_rate }}</span>
                      </div>
                    </td>
                    <td>
                      <strong class="text-white d-block" style="font-size: 0.92rem;">{{ $p->created_at ? $p->created_at->format('d M Y') : 'N/A' }}</strong>
                      <small class="subtext d-block mt-0.5" style="color: #94a3b8 !important;">{{ $p->created_at ? $p->created_at->diffForHumans() : '' }}</small>
                    </td>
                    <td class="text-end">
                      <div class="table-actions justify-content-end">
                        <a aria-label="View {{ $p->name }}" class="row-action" href="{{ route('admin.photographers.show', $p->id) }}" title="View Profile & Overrides">
                          <i class="bi bi-eye"></i>
                        </a>
                        <a aria-label="Edit {{ $p->name }}" class="row-action" href="{{ route('admin.photographers.edit', $p->id) }}" title="Edit Membership & Features">
                          <i class="bi bi-pencil"></i>
                        </a>
                        <a aria-label="Public Profile" class="row-action" href="{{ route('photographers.show', $p->id) }}" target="_blank" title="View Public Profile">
                          <i class="bi bi-box-arrow-up-right"></i>
                        </a>
                        <form action="{{ route('admin.photographers.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete photographer {{ $p->name }}?');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="row-action border-0 bg-transparent text-danger" title="Delete">
                            <i class="bi bi-trash"></i>
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-center py-5">
                      <i class="bi bi-camera2 fs-1 text-muted d-block mb-2"></i>
                      <h4 class="text-white">No photographers found</h4>
                      <p class="text-muted">Try adjusting your search or filters.</p>
                      <a href="{{ route('admin.photographers.create') }}" class="btn btn-primary btn-sm mt-2">
                        <i class="bi bi-plus"></i> Add new photographer
                      </a>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div class="p-3 border-top border-secondary border-opacity-25 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <span class="text-muted small">
              Showing {{ $photographers->firstItem() ?? 0 }} to {{ $photographers->lastItem() ?? 0 }} of {{ $photographers->total() }} photographers
            </span>
            <div>
              {!! $photographers->links('pagination::bootstrap-5') !!}
            </div>
          </div>
        </section>
      </main>
    </div>
  </div>
  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
  <script src="{{ asset('admin-assets/js/app.js') }}"></script>
</body>
</html>