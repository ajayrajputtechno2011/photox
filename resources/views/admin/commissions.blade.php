<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PhotoX Admin | Commissions</title>
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
            <span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><strong>Commissions</strong>
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
            <p class="eyebrow">Photographer earnings</p>
            <h1>Commissions</h1>
            <p class="intro-copy">
              Reconcile marketplace sales, PhotoX commission and photographer earnings.
            </p>
          </div>
        </div>

        <section class="row g-3 mb-3" aria-label="Commission summary">
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="color: #8fe0c4; background: rgba(43, 190, 144, 0.16)">
                  <i class="bi bi-currency-dollar"></i>
                </span>
              </div>
              <p>Gross marketplace sales</p>
              <h2>R {{ number_format($stats['gross_sales'], 2) }}</h2>
              <small>All completed orders</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="color: #ffc47c; background: rgba(255, 138, 0, 0.16)">
                  <i class="bi bi-percent"></i>
                </span>
              </div>
              <p>PhotoX commission</p>
              <h2>R {{ number_format($stats['platform_commission'], 2) }}</h2>
              <small>{{ $stats['commission_rate'] }}% configured platform fee</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="color: #9ac8ff; background: rgba(66, 139, 255, 0.16)">
                  <i class="bi bi-wallet2"></i>
                </span>
              </div>
              <p>Photographer earnings</p>
              <h2>R {{ number_format($stats['photographer_earnings'], 2) }}</h2>
              <small>Creator net payout pool</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="color: #c8b6ff; background: rgba(132, 95, 255, 0.16)">
                  <i class="bi bi-clock"></i>
                </span>
              </div>
              <p>Pending settlement</p>
              <h2>R {{ number_format($stats['pending_settlement'], 2) }}</h2>
              <small>Pending order amount</small>
            </article>
          </div>
        </section>

        <section class="ops-table-panel">
          <div class="d-flex align-items-start justify-content-between gap-3 flex-wrap">
            <div>
              <p class="eyebrow">Financial reconciliation</p>
              <h3>Commission records</h3>
            </div>
            <a href="{{ route('admin.payouts.export') }}" class="create-button text-decoration-none">
              <i class="bi bi-file-earmark-excel"></i> Export Payouts CSV
            </a>
          </div>
          <form method="GET" action="{{ route('admin.commissions.index') }}" class="ops-toolbar">
            <div class="search-field">
              <i class="bi bi-search"></i>
              <input type="search" name="search" value="{{ request('search') }}" placeholder="Search order number or customer..." aria-label="Search commissions" />
            </div>
            @if(request('search'))
              <a href="{{ route('admin.commissions.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">Reset</a>
            @endif
          </form>
          <div class="ops-table-wrap">
            <table class="table ops-table">
              <thead>
                <tr>
                  <th>Order</th>
                  <th>Photographer / Event</th>
                  <th>Gross amount</th>
                  <th>PhotoX commission ({{ $commissionRate }}%)</th>
                  <th>Photographer earnings ({{ 100 - $commissionRate }}%)</th>
                  <th>Settlement</th>
                  <th>Details</th>
                </tr>
              </thead>
              <tbody>
                @forelse($orders as $ord)
                  @php
                    $firstItem = $ord->items->first();
                    $photographerName = $firstItem?->event?->photographer?->name ?? 'Platform Marketplace';
                    $eventTitle = $firstItem?->event?->title ?? 'Photo Purchase';
                    $gross = (float) $ord->total_amount;
                    $comm = round($gross * ($commissionRate / 100), 2);
                    $net = round($gross - $comm, 2);
                  @endphp
                  <tr>
                    <td>
                      <strong>#{{ $ord->order_number }}</strong><br />
                      <small class="text-muted">{{ $ord->created_at ? $ord->created_at->format('d M Y') : 'Recent' }}</small>
                    </td>
                    <td>
                      <strong>{{ $photographerName }}</strong><br />
                      <small class="text-muted">{{ Str::limit($eventTitle, 30) }}</small>
                    </td>
                    <td><strong>R {{ number_format($gross, 2) }}</strong></td>
                    <td><strong class="text-success">R {{ number_format($comm, 2) }}</strong></td>
                    <td><strong>R {{ number_format($net, 2) }}</strong></td>
                    <td>
                      @if(in_array($ord->payment_status, ['paid', 'completed']))
                        <span class="ops-pill green"><i class="bi bi-check-circle"></i> Paid</span>
                      @else
                        <span class="ops-pill orange">Pending</span>
                      @endif
                    </td>
                    <td>
                      <a class="row-action" href="{{ route('admin.orders.show', $ord->id) }}" title="View Order Details">
                        <i class="bi bi-arrow-up-right"></i>
                      </a>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="7" class="text-center py-4 text-muted">
                      No settled commission records found.
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="mt-3">
            {{ $orders->links() }}
          </div>
        </section>
      </main>
    </div>
  </div>
  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
  <script src="{{ asset('admin-assets/js/app.js') }}"></script>
</body>
</html>
