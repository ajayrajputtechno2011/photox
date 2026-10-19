<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PhotoX Admin | Creator Automated Payouts &amp; Banking</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet" />
  <style>
    .bank-card {
      background: rgba(15, 23, 42, 0.65);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 12px;
      transition: all 0.2s ease;
    }
    .bank-card:hover {
      border-color: rgba(56, 189, 248, 0.35);
    }
    .eft-badge-ready {
      background: rgba(16, 185, 129, 0.15);
      color: #34d399;
      border: 1px solid rgba(16, 185, 129, 0.3);
      font-size: 0.75rem;
      padding: 3px 8px;
      border-radius: 6px;
      font-weight: 600;
    }
    .eft-badge-pending {
      background: rgba(245, 158, 11, 0.15);
      color: #fbbf24;
      border: 1px solid rgba(245, 158, 11, 0.3);
      font-size: 0.75rem;
      padding: 3px 8px;
      border-radius: 6px;
      font-weight: 600;
    }
    .copy-btn {
      background: rgba(255, 255, 255, 0.06);
      border: 1px solid rgba(255, 255, 255, 0.12);
      color: #94a3b8;
      border-radius: 6px;
      padding: 2px 7px;
      font-size: 0.75rem;
      cursor: pointer;
      transition: all 0.15s ease;
    }
    .copy-btn:hover {
      background: rgba(56, 189, 248, 0.2);
      color: #38bdf8;
      border-color: rgba(56, 189, 248, 0.4);
    }
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
          <a class="nav-link active" href="/admin/payouts"><i class="bi bi-wallet2"></i><span>Payouts</span></a>
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
            <a class="breadcrumb-muted" href="/admin/photographers">Photographers</a>
            <i class="bi bi-chevron-right"></i>
            <strong>Creator Payouts &amp; Banking</strong>
          </div>
        </div>
        <div class="topbar-actions">
          <a href="{{ route('admin.payouts.export') }}" class="btn btn-sm btn-outline-info">
            <i class="bi bi-download me-1"></i> Export EFT Batch CSV
          </a>
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

        <div class="page-intro detail-intro mb-4">
          <div>
            <p class="eyebrow text-info">Settlement &amp; Commercial Operations</p>
            <h1>Creator Automated Payouts</h1>
            <p class="intro-copy">Manage South African creator banking details, EFT batch files, commission splits, and automated bank settlements.</p>
          </div>
          <div class="detail-actions">
            <a class="btn btn-outline-light" href="/admin/photographers"><i class="bi bi-people"></i> Photographers Roster</a>
            <a class="btn btn-primary" href="{{ route('admin.payouts.export') }}"><i class="bi bi-file-earmark-spreadsheet"></i> Download EFT Batch</a>
          </div>
        </div>

        <!-- Metrics Overview Grid -->
        <section class="row g-3 profile-stats-grid mb-4">
          <div class="col-md-3">
            <article class="stat-card">
              <p>Registered Creators</p>
              <h2 class="text-white">{{ $totalPhotographers }}</h2>
              <small class="text-muted">Active marketplace sellers</small>
            </article>
          </div>
          <div class="col-md-3">
            <article class="stat-card">
              <p>EFT Ready Accounts</p>
              <h2 class="text-success">{{ $readyCount }}</h2>
              <small class="text-success"><i class="bi bi-check2-circle me-1"></i> Banking configured</small>
            </article>
          </div>
          <div class="col-md-3">
            <article class="stat-card">
              <p>Incomplete Details</p>
              <h2 class="text-warning">{{ $missingCount }}</h2>
              <small class="text-warning"><i class="bi bi-clock-history me-1"></i> Awaiting bank details</small>
            </article>
          </div>
          <div class="col-md-3">
            <article class="stat-card">
              <p>Settlement Rails</p>
              <h2 class="text-info" style="font-size: 1.25rem;">SA National EFT</h2>
              <small class="text-muted">Standard Bank, FNB, Capitec, ABSA</small>
            </article>
          </div>
        </section>

        <!-- Search & Filter Controls -->
        <section class="panel detail-card mb-4 p-3">
          <form method="GET" action="{{ route('admin.payouts.index') }}" class="row g-2 align-items-center">
            <div class="col-md-5">
              <div class="input-group">
                <span class="input-group-text bg-dark border-secondary text-muted"><i class="bi bi-search"></i></span>
                <input type="text" name="search" class="form-control bg-dark text-white border-secondary" placeholder="Search by name, email, bank or account..." value="{{ request('search') }}">
              </div>
            </div>
            <div class="col-md-3">
              <select name="bank" class="form-select bg-dark text-white border-secondary">
                <option value="all">All South African Banks</option>
                @foreach($banks as $b)
                  <option value="{{ $b }}" {{ request('bank') === $b ? 'selected' : '' }}>{{ $b }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-2">
              <select name="status" class="form-select bg-dark text-white border-secondary">
                <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>All Statuses</option>
                <option value="ready" {{ request('status') === 'ready' ? 'selected' : '' }}>EFT Ready Only</option>
                <option value="missing" {{ request('status') === 'missing' ? 'selected' : '' }}>Missing Banking</option>
              </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
              <button type="submit" class="btn btn-outline-info w-100"><i class="bi bi-funnel"></i> Filter</button>
              @if(request()->hasAny(['search', 'bank', 'status']))
                <a href="{{ route('admin.payouts.index') }}" class="btn btn-outline-secondary" title="Clear Filters"><i class="bi bi-x-lg"></i></a>
              @endif
            </div>
          </form>
        </section>

        <!-- Photographers Banking Ledger Table -->
        <section class="panel detail-card p-0 overflow-hidden">
          <div class="p-3 border-bottom border-secondary d-flex align-items-center justify-content-between">
            <h4 class="mb-0 text-white fs-6 fw-semibold">
              <i class="bi bi-bank2 text-info me-2"></i> Creator Banking &amp; Settlement Register
            </h4>
            <span class="text-muted small">Showing {{ $photographers->firstItem() ?? 0 }}-{{ $photographers->lastItem() ?? 0 }} of {{ $photographers->total() }}</span>
          </div>

          <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0" style="background: transparent;">
              <thead>
                <tr class="text-muted text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px; border-bottom: 1px solid rgba(255,255,255,0.08);">
                  <th class="ps-3 py-3">Photographer</th>
                  <th>Bank / Universal Code</th>
                  <th>Account Number</th>
                  <th>Account Holder</th>
                  <th>Type</th>
                  <th>Commission</th>
                  <th>Status</th>
                  <th class="text-end pe-3">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($photographers as $p)
                  @php
                    $hasBanking = !empty($p->bank_name) && !empty($p->account_number);
                  @endphp
                  <tr style="border-bottom: 1px solid rgba(255,255,255,0.04);">
                    <td class="ps-3 py-3">
                      <div class="d-flex align-items-center gap-3">
                        <img src="{{ $p->avatar ?: 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=80&q=80' }}" class="rounded-circle border border-secondary" style="width: 38px; height: 38px; object-fit: cover;" alt="{{ $p->name }}">
                        <div>
                          <strong class="text-white d-block">{{ $p->name }}</strong>
                          <small class="text-muted">{{ $p->email }}</small>
                        </div>
                      </div>
                    </td>
                    <td>
                      @if(!empty($p->bank_name))
                        <span class="text-white fw-semibold d-block"><i class="bi bi-bank text-info me-1"></i> {{ $p->bank_name }}</span>
                        <small class="text-muted font-monospace">Code: {{ $p->branch_code ?: 'Universal' }}</small>
                      @else
                        <span class="text-muted fst-italic">Not specified</span>
                      @endif
                    </td>
                    <td>
                      @if(!empty($p->account_number))
                        <div class="d-flex align-items-center gap-1">
                          <span class="font-monospace text-white">{{ $p->account_number }}</span>
                          <button type="button" class="copy-btn" onclick="copyToClipboard('{{ $p->account_number }}')" title="Copy Account Number">
                            <i class="bi bi-clipboard"></i>
                          </button>
                        </div>
                      @else
                        <span class="text-muted">—</span>
                      @endif
                    </td>
                    <td>
                      @if(!empty($p->account_holder_name))
                        <span class="text-white-50">{{ $p->account_holder_name }}</span>
                      @else
                        <span class="text-muted">—</span>
                      @endif
                    </td>
                    <td>
                      <span class="badge bg-secondary-subtle text-light border border-secondary" style="font-size: 0.72rem;">
                        {{ $p->account_type ?: 'Current' }}
                      </span>
                    </td>
                    <td>
                      <span class="text-info fw-semibold">{{ $p->effective_commission_rate }}</span>
                      <small class="text-muted d-block" style="font-size: 0.7rem;">{{ ucfirst($p->tier ?: 'Starter') }}</small>
                    </td>
                    <td>
                      @if($hasBanking)
                        <span class="eft-badge-ready"><i class="bi bi-shield-check me-1"></i> EFT Ready</span>
                      @else
                        <span class="eft-badge-pending"><i class="bi bi-exclamation-circle me-1"></i> Missing Info</span>
                      @endif
                    </td>
                    <td class="text-end pe-3">
                      <div class="table-actions d-inline-flex gap-1">
                        @if($hasBanking)
                          <button type="button" class="row-action" title="Copy Full EFT Details" onclick="copyEftDetails('{{ $p->name }}', '{{ $p->bank_name }}', '{{ $p->account_holder_name ?: $p->name }}', '{{ $p->account_number }}', '{{ $p->branch_code }}')">
                            <i class="bi bi-copy"></i>
                          </button>
                        @endif
                        <a href="{{ route('admin.photographers.edit', $p->id) }}" class="row-action" title="Edit Bank Details &amp; Profile">
                          <i class="bi bi-pencil"></i>
                        </a>
                        <a href="{{ route('admin.photographers.show', $p->id) }}" class="row-action" title="View Full Account">
                          <i class="bi bi-eye"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="8" class="text-center py-5 text-muted">
                      <i class="bi bi-wallet2 fs-2 d-block mb-2 text-white-50"></i>
                      No photographers matched the search query or bank filter.
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          @if($photographers->hasPages())
            <div class="p-3 border-top border-secondary d-flex justify-content-end">
              {{ $photographers->links('pagination::bootstrap-5') }}
            </div>
          @endif
        </section>
      </main>
    </div>
  </div>

  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
  <script src="{{ asset('admin-assets/js/app.js') }}"></script>
  <script>
    function copyToClipboard(text) {
      navigator.clipboard.writeText(text).then(() => {
        alert('Copied to clipboard: ' + text);
      });
    }

    function copyEftDetails(name, bank, holder, acc, code) {
      const details = `PhotoX EFT Payout\nRecipient: ${name}\nBank: ${bank}\nAccount Holder: ${holder}\nAccount Number: ${acc}\nBranch Code: ${code || 'Universal'}\nRef: PhotoX-${name.replace(/\\s+/g, '')}`;
      navigator.clipboard.writeText(details).then(() => {
        alert('EFT Payment Information copied to clipboard!\n\n' + details);
      });
    }
  </script>
</body>
</html>
