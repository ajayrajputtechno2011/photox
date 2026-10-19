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
<a class="nav-link" href="/admin/categories"><i class="bi bi-tags"></i><span>Categories</span></a>
          <a class="nav-link" href="/admin/schools"><i class="bi bi-mortarboard"></i><span>Schools</span></a>
          <a class="nav-link" href="/admin/companies"><i class="bi bi-buildings"></i><span>Companies</span></a>
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
          <p class="intro-copy">Search customer accounts, contact details and marketplace activity.</p>
        </div>

        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show border-0 bg-success bg-opacity-25 text-white mb-3 d-flex align-items-center justify-content-between px-3 py-2 rounded" role="alert">
            <div><i class="bi bi-check-circle-fill me-2 text-success"></i> {{ session('success') }}</div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show border-0 bg-danger bg-opacity-25 text-white mb-3 d-flex align-items-center justify-content-between px-3 py-2 rounded" role="alert">
            <div><i class="bi bi-exclamation-triangle-fill me-2 text-danger"></i> {{ session('error') }}</div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <section class="row g-3 mb-3">
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon"><i class="bi bi-people"></i></span><span class="trend positive">Live</span>
              </div>
              <p>Total customers</p>
              <h2>{{ number_format($totalCustomers) }}</h2><small>{{ $newThisMonth }} joined this month</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon"><i class="bi bi-person-check"></i></span>
              </div>
              <p>Active customers</p>
              <h2>{{ number_format($activeCustomers) }}</h2><small>{{ $totalCustomers > 0 ? round(($activeCustomers / $totalCustomers) * 100) : 0 }}% of all accounts</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon"><i class="bi bi-person-x"></i></span>
              </div>
              <p>Inactive / Blocked</p>
              <h2>{{ number_format($inactiveCustomers) }}</h2><small>Requires attention</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon"><i class="bi bi-person-plus"></i></span>
              </div>
              <p>New this month</p>
              <h2>{{ number_format($newThisMonth) }}</h2><small>Registered customers</small>
            </article>
          </div>
        </section>

        <section class="ops-table-panel">
          <div class="d-flex align-items-start justify-content-between gap-3">
            <div>
              <p class="eyebrow">Account directory</p>
              <h3>All customers</h3>
            </div>
          </div>

          <form method="GET" action="{{ route('admin.customers.index') }}" class="ops-toolbar d-flex align-items-center gap-2 flex-wrap">
            <div class="search-field flex-grow-1" style="min-width: 250px;">
              <i class="bi bi-search"></i>
              <input name="search" aria-label="Search customers" placeholder="Search name, email, phone or customer ID..." type="search" value="{{ request('search') }}">
            </div>

            <select name="status" aria-label="Filter customer status" class="management-select" onchange="this.form.submit()">
              <option value="all" {{ request('status') === 'all' || !request('status') ? 'selected' : '' }}>All statuses</option>
              <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
              <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
              <option value="blocked" {{ request('status') === 'blocked' ? 'selected' : '' }}>Blocked</option>
            </select>

            <button class="btn btn-sm btn-primary px-3" type="submit"><i class="bi bi-filter"></i> Apply</button>

            @if(request()->filled('search') || (request()->filled('status') && request('status') !== 'all'))
              <a href="{{ route('admin.customers.index') }}" class="btn btn-sm btn-outline-secondary px-3"><i class="bi bi-x-circle"></i> Reset</a>
            @endif
          </form>

          <div class="ops-table-wrap">
            <table class="table ops-table">
              <thead>
                <tr>
                  <th>Customer</th>
                  <th>Contact</th>
                  <th>Location</th>
                  <th>Member Since</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($customers as $customer)
                  @php
                    $initials = strtoupper(substr($customer->name, 0, 2));
                  @endphp
                  <tr>
                    <td>
                      <div class="ops-person">
                        <span class="ops-avatar">{{ $initials }}</span>
                        <span>
                          <strong>{{ $customer->name }}</strong>
                          <small>Customer ID PX-{{ str_pad($customer->id, 5, '0', STR_PAD_LEFT) }}</small>
                        </span>
                      </div>
                    </td>
                    <td>
                      <strong>{{ $customer->email }}</strong>
                      <small>{{ $customer->phone ?: 'No phone provided' }}</small>
                    </td>
                    <td>
                      <strong>{{ $customer->location ?: 'South Africa' }}</strong>
                    </td>
                    <td>
                      <strong>{{ $customer->created_at ? $customer->created_at->format('d M Y') : 'N/A' }}</strong>
                      <small>{{ $customer->created_at ? $customer->created_at->diffForHumans() : '' }}</small>
                    </td>
                    <td>
                      @if($customer->status === 'active')
                        <span class="ops-pill green"><i class="bi bi-check-circle"></i> Active</span>
                      @elseif($customer->status === 'blocked')
                        <span class="ops-pill" style="color:#ef4444; border-color:rgba(239,68,68,0.3); background:rgba(239,68,68,0.1);"><i class="bi bi-slash-circle"></i> Blocked</span>
                      @else
                        <span class="ops-pill orange"><i class="bi bi-clock"></i> Inactive</span>
                      @endif
                    </td>
                    <td>
                      <div class="ops-actions d-flex align-items-center gap-1">
                        <a aria-label="Open {{ $customer->name }}" class="row-action" href="{{ route('admin.customers.show', $customer->id) }}" title="View & Edit Customer">
                          <i class="bi bi-eye"></i>
                        </a>

                        <form action="{{ route('admin.customers.toggle', $customer->id) }}" method="POST" class="d-inline">
                          @csrf
                          <button type="submit" class="row-action border-0 bg-transparent" title="{{ $customer->status === 'active' ? 'Block customer account' : 'Activate customer account' }}" style="cursor:pointer;">
                            <i class="bi {{ $customer->status === 'active' ? 'bi-lock text-warning' : 'bi-unlock text-success' }}"></i>
                          </button>
                        </form>

                        <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete customer {{ $customer->name }}?');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="row-action border-0 bg-transparent text-danger" title="Delete customer" style="cursor:pointer;">
                            <i class="bi bi-trash"></i>
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                      <i class="bi bi-people display-6 d-block mb-2 opacity-50"></i>
                      No customers found matching the search criteria.
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div class="ops-pagination d-flex align-items-center justify-content-between p-3 flex-wrap gap-2">
            <span>
              Showing {{ $customers->firstItem() ?? 0 }}–{{ $customers->lastItem() ?? 0 }} of {{ $customers->total() }} customers
            </span>
            @if($customers->hasPages())
              <div>
                {{ $customers->links() }}
              </div>
            @endif
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