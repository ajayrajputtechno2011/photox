<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PhotoX Admin | Coupons &amp; Discounts</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet" />
  <style>
    .coupon-badge {
      font-family: 'Space Grotesk', monospace;
      font-weight: 700;
      letter-spacing: 0.05em;
      padding: 4px 10px;
      border-radius: 6px;
      font-size: 0.82rem;
      background: #0f172a;
      color: #38bdf8;
      border: 1px dashed #38bdf8;
      display: inline-block;
    }
    .modal-content {
      background: #ffffff !important;
      color: #0f172a !important;
    }
    .modal-content .modal-title {
      color: #0f172a !important;
    }
    .modal-content .form-label {
      color: #334155 !important;
    }
    .modal-content .form-check-label {
      color: #0f172a !important;
    }
    .modal-content .form-control,
    .modal-content .form-select {
      background: #f8fafc !important;
      border: 1px solid #cbd5e1 !important;
      color: #0f172a !important;
    }
    .modal-content .form-control:focus,
    .modal-content .form-select:focus {
      background: #ffffff !important;
      border-color: #0284c7 !important;
      color: #0f172a !important;
    }
    .modal-content .form-text {
      color: #64748b !important;
    }
    .ops-table-panel select.form-select-sm {
      background-color: #101e2c;
      border-color: #26384a;
      color: #e7eef7;
    }
  </style>
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
          <a class="nav-link" href="/admin/media"><i class="bi bi-images"></i><span>Media Manager</span></a>
          <a class="nav-link" href="/admin/storage"><i class="bi bi-cloud-arrow-up"></i><span>Storage</span></a>
          <a class="nav-link" href="/admin/watermarks"><i class="bi bi-droplet"></i><span>Watermarks</span></a>
        </nav>
        <div class="nav-label nav-label-spaced">Business</div>
        <nav class="nav flex-column sidebar-nav">
          <a class="nav-link" href="/admin/payments"><i class="bi bi-credit-card"></i><span>Payments</span></a>
          <a class="nav-link active" href="/admin/coupons-discounts"><i class="bi bi-tags"></i><span>Coupons &amp; Discounts</span></a>
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
          <a class="nav-link" href="/admin/news"><i class="bi bi-newspaper"></i><span>News</span></a>
          <a class="nav-link" href="/admin/messages"><i class="bi bi-chat-left-text"></i><span>Messages</span></a>
          <a class="nav-link" href="/admin/notifications"><i class="bi bi-bell"></i><span>Notifications</span></a>
        </nav>
      </div>
    </aside>

    <div class="main-panel">
      <header class="topbar">
        <div class="topbar-left">
          <button class="btn btn-sm btn-outline-secondary d-md-none" id="sidebarToggle" type="button"><i class="bi bi-list"></i></button>
          <div class="search-wrap">
            <i class="bi bi-search"></i>
            <input aria-label="Search" placeholder="Search codes, promos..." type="search" />
          </div>
        </div>
        <div class="topbar-right">
          <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 py-2 px-3 rounded-pill">
            <i class="bi bi-check-circle-fill me-1"></i> Discount Engine Live
          </span>
        </div>
      </header>

      <main class="content-body">
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <div class="page-intro d-flex align-items-end justify-content-between gap-3 flex-wrap">
          <div>
            <p class="eyebrow">Store Promotions &amp; Volume Pricing</p>
            <h1>Coupons &amp; Discounts</h1>
            <p class="intro-copy">Create promo coupon codes (e.g. PHOTOX30 for R100 off) and automated volume bundles (e.g. Buy 5 images get 10% off).</p>
          </div>
          <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#createCouponModal">
            <i class="bi bi-plus-lg me-1"></i> New Promo / Bundle
          </button>
        </div>

        <section class="row g-3 mb-4">
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon"><i class="bi bi-tags-fill"></i></span>
              </div>
              <p>Total Rules</p>
              <h2>{{ $stats['total'] }}</h2>
              <small>Configured promo rules</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="background: rgba(34, 197, 94, 0.15); color: #22c55e;"><i class="bi bi-check-circle-fill"></i></span>
              </div>
              <p>Active Promos</p>
              <h2>{{ $stats['active'] }}</h2>
              <small>Available at checkout</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="background: rgba(245, 158, 11, 0.15); color: #f59e0b;"><i class="bi bi-collection-fill"></i></span>
              </div>
              <p>Volume Bundles</p>
              <h2>{{ $stats['bundle'] }}</h2>
              <small>Automatic cart quantity tiers</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="background: rgba(56, 189, 248, 0.15); color: #0284c7;"><i class="bi bi-receipt"></i></span>
              </div>
              <p>Total Redeemed</p>
              <h2>{{ $stats['total_redeemed'] }}</h2>
              <small>Times discounts applied</small>
            </article>
          </div>
        </section>

        <section class="ops-table-panel">
          <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
            <div>
              <p class="eyebrow">Active Discount Rules</p>
              <h3>All Promos &amp; Coupons</h3>
            </div>
            <form method="GET" action="{{ route('admin.coupons.index') }}" class="d-flex align-items-center gap-2">
              <select name="type" class="form-select form-select-sm" style="width: 170px;" onchange="this.form.submit()">
                <option value="">All Types</option>
                <option value="fixed" {{ request('type') === 'fixed' ? 'selected' : '' }}>Fixed Amount (ZAR)</option>
                <option value="percent" {{ request('type') === 'percent' ? 'selected' : '' }}>Percentage (%)</option>
                <option value="bundle_volume" {{ request('type') === 'bundle_volume' ? 'selected' : '' }}>Volume Bundle</option>
              </select>
              <div class="search-field" style="max-width: 240px;">
                <i class="bi bi-search"></i>
                <input name="search" value="{{ request('search') }}" placeholder="Search code..." type="search">
              </div>
            </form>
          </div>

          <div class="table-responsive">
            <table class="table ops-table">
              <thead>
                <tr>
                  <th>Promo Code</th>
                  <th>Title / Rule Name</th>
                  <th>Discount Type</th>
                  <th>Discount Value</th>
                  <th>Min Requirement</th>
                  <th>Redeemed</th>
                  <th>Status</th>
                  <th class="text-end">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($coupons as $coupon)
                  <tr>
                    <td>
                      <span class="coupon-badge">{{ $coupon->code }}</span>
                    </td>
                    <td>
                      <strong>{{ $coupon->title }}</strong>
                    </td>
                    <td>
                      @if($coupon->type === 'fixed')
                        <span class="badge" style="background: rgba(56, 189, 248, 0.15); color: #38bdf8; border: 1px solid rgba(56, 189, 248, 0.35); font-weight: 600;">Fixed ZAR Off</span>
                      @elseif($coupon->type === 'percent')
                        <span class="badge" style="background: rgba(14, 165, 233, 0.15); color: #7dd3fc; border: 1px solid rgba(14, 165, 233, 0.35); font-weight: 600;">Percentage % Off</span>
                      @else
                        <span class="badge" style="background: rgba(245, 158, 11, 0.15); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.35); font-weight: 600;">Volume Bundle</span>
                      @endif
                    </td>
                    <td>
                      @if($coupon->type === 'fixed')
                        <strong style="color: #4ade80; font-size: 0.88rem; font-weight: 700;">R {{ number_format($coupon->discount_value, 2) }} OFF</strong>
                      @else
                        <strong style="color: #4ade80; font-size: 0.88rem; font-weight: 700;">{{ number_format($coupon->discount_value, 0) }}% OFF</strong>
                      @endif
                    </td>
                    <td>
                      @if($coupon->min_items > 0)
                        <span class="text-white-50">Min {{ $coupon->min_items }} {{ Str::plural('photo', $coupon->min_items) }}</span>
                      @elseif($coupon->min_order_amount > 0)
                        <span class="text-white-50">Min order R {{ number_format($coupon->min_order_amount, 2) }}</span>
                      @else
                        <span class="text-white-50 opacity-50">None</span>
                      @endif
                    </td>
                    <td>
                      <span class="fw-semibold text-white">{{ $coupon->used_count }}</span> <small class="text-white-50">{{ $coupon->max_uses ? '/ ' . $coupon->max_uses : '' }}</small>
                    </td>
                    <td>
                      @if($coupon->is_active)
                        <span class="badge rounded-pill px-3 py-1 d-inline-flex align-items-center gap-1" style="background: rgba(34, 197, 94, 0.22); color: #4ade80; border: 1px solid rgba(74, 222, 128, 0.45); font-size: 0.78rem; font-weight: 700; letter-spacing: 0.03em;">
                          <i class="bi bi-check-circle-fill" style="font-size: 0.75rem;"></i> Active
                        </span>
                      @else
                        <span class="badge rounded-pill px-3 py-1 d-inline-flex align-items-center gap-1" style="background: rgba(148, 163, 184, 0.2); color: #cbd5e1; border: 1px solid rgba(148, 163, 184, 0.4); font-size: 0.78rem; font-weight: 700; letter-spacing: 0.03em;">
                          <i class="bi bi-pause-circle-fill" style="font-size: 0.75rem;"></i> Paused
                        </span>
                      @endif
                    </td>
                    <td class="text-end">
                      <div class="d-inline-flex gap-2">
                        <form action="{{ route('admin.coupons.toggle', $coupon->id) }}" method="POST">
                          @csrf
                          <button type="submit" class="btn btn-sm" title="{{ $coupon->is_active ? 'Pause Promo' : 'Activate Promo' }}" style="background: #102131; border: 1px solid #203447; color: {{ $coupon->is_active ? '#fbbf24' : '#4ade80' }}; border-radius: 6px; padding: 4px 10px;">
                            <i class="bi {{ $coupon->is_active ? 'bi-pause-fill' : 'bi-play-fill' }}"></i>
                          </button>
                        </form>
                        <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" onsubmit="return confirm('Delete coupon {{ $coupon->code }}?')">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm" title="Delete Promo" style="background: #102131; border: 1px solid #3b2027; color: #f87171; border-radius: 6px; padding: 4px 10px;">
                            <i class="bi bi-trash"></i>
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="8" class="text-center py-4 text-muted">No coupons or discount rules configured yet.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div class="mt-3">
            {{ $coupons->links('admin.partials.pagination') }}
          </div>
        </section>
      </main>
    </div>
  </div>

  <!-- Create Coupon Modal -->
  <div class="modal fade" id="createCouponModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
        <form action="{{ route('admin.coupons.store') }}" method="POST">
          @csrf
          <div class="modal-header border-0 pb-0">
            <h5 class="modal-title fw-bold">Create Coupon / Bundle Rule</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label small fw-bold text-uppercase text-muted">Promo Code</label>
              <input type="text" name="code" class="form-control" placeholder="e.g. PHOTOX30 or BUNDLE5" style="text-transform: uppercase;" required>
              <div class="form-text">What users will type at checkout (auto-uppercased).</div>
            </div>
            <div class="mb-3">
              <label class="form-label small fw-bold text-uppercase text-muted">Title / Description</label>
              <input type="text" name="title" class="form-control" placeholder="e.g. R100 Off Checkout or Buy 5 get 10% off" required>
            </div>
            <div class="row g-3 mb-3">
              <div class="col-6">
                <label class="form-label small fw-bold text-uppercase text-muted">Discount Type</label>
                <select name="type" class="form-select" id="couponTypeSelect" required>
                  <option value="fixed">Fixed Amount (ZAR Off)</option>
                  <option value="percent">Percentage (% Off)</option>
                  <option value="bundle_volume">Volume Bundle (% Off on Quantity)</option>
                </select>
              </div>
              <div class="col-6">
                <label class="form-label small fw-bold text-uppercase text-muted">Discount Value</label>
                <input type="number" step="0.01" min="0.01" name="discount_value" class="form-control" placeholder="e.g. 100 or 10" required>
              </div>
            </div>
            <div class="row g-3 mb-3">
              <div class="col-6">
                <label class="form-label small fw-bold text-uppercase text-muted">Min Images / Quantity</label>
                <input type="number" name="min_items" class="form-control" value="0" placeholder="e.g. 5 for buy 5 images">
                <div class="form-text">0 for any quantity.</div>
              </div>
              <div class="col-6">
                <label class="form-label small fw-bold text-uppercase text-muted">Min Order Total (ZAR)</label>
                <input type="number" step="0.01" name="min_order_amount" class="form-control" value="0.00" placeholder="e.g. 100.00">
              </div>
            </div>
            <div class="form-check form-switch mt-2">
              <input class="form-check-input" type="checkbox" name="is_active" value="1" id="activeSwitch" checked>
              <label class="form-check-label fw-semibold" for="activeSwitch">Activate immediately at checkout</label>
            </div>
          </div>
          <div class="modal-footer border-0 pt-0">
            <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Create Rule</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
