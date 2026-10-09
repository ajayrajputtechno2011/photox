<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <title>PhotoX Admin | {{ $photographer->name }} Details</title>
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
            <a class="breadcrumb-muted" href="{{ route('admin.photographers.index') }}">Photographers</a>
            <i class="bi bi-chevron-right"></i>
            <strong>{{ $photographer->name }}</strong>
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

        <div class="page-intro detail-intro">
          <div>
            <p class="eyebrow">Photographer account &amp; membership</p>
            <h1>{{ $photographer->name }}</h1>
            <p class="intro-copy">Profile verification, membership tier assignment, custom overrides, and account controls.</p>
          </div>
          <div class="detail-actions">
            <a class="btn btn-outline-light" href="{{ route('admin.photographers.index') }}"><i class="bi bi-arrow-left"></i> Back to directory</a>
            <a class="btn btn-outline-info" href="{{ route('photographers.show', $photographer->id) }}" target="_blank"><i class="bi bi-box-arrow-up-right"></i> Public Profile</a>
            <a class="btn btn-primary" href="{{ route('admin.photographers.edit', $photographer->id) }}"><i class="bi bi-pencil"></i> Edit Profile &amp; Membership</a>
          </div>
        </div>

        <!-- Photographer Profile Hero -->
        <section class="profile-hero panel">
          <img alt="{{ $photographer->name }}" src="{{ $photographer->avatar ?: 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=180&q=80' }}" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid rgba(255,255,255,0.2);">
          <div class="profile-hero-copy">
            <div class="profile-title-row">
              <div>
                <h2>{{ $photographer->name }}</h2>
                <p>{{ $photographer->email }} · {{ $photographer->location ?: 'South Africa' }} · {{ $photographer->phone ?: 'No phone' }}</p>
              </div>
              <div>
                <span class="badge py-2 px-3 rounded-pill" style="font-size: 0.85rem; {{ strtolower($photographer->tier ?? '') === 'photoguild' ? 'background: linear-gradient(135deg, #f59e0b, #d97706); color: #000; font-weight: 700;' : (strtolower($photographer->tier ?? '') === 'pro' ? 'background: #198754; color: #fff;' : 'background: #0d6efd; color: #fff;') }}">
                  <i class="bi bi-patch-check-fill me-1"></i> {{ $photographer->effective_badge_heading }}
                </span>
              </div>
            </div>
            <p class="mt-2 text-white-50">{{ $photographer->bio ?: 'No biography written yet.' }}</p>
          </div>
        </section>

        <!-- Stats Overview Cards -->
        <section class="row g-3 profile-stats-grid">
          <div class="col-md-3">
            <article class="stat-card">
              <p>Assigned Membership</p>
              <h2 class="text-white">{{ $photographer->membership?->name ?: ucfirst($photographer->tier ?: 'Starter') }}</h2>
              <small class="text-muted">
                {{ $photographer->membership ? 'R ' . number_format($photographer->membership->monthly_price, 0) . '/mo' : 'Custom allocation' }}
              </small>
            </article>
          </div>
          <div class="col-md-3">
            <article class="stat-card">
              <p>Effective Storage Limit</p>
              <h2 class="text-warning">{{ $photographer->effective_storage_limit }}</h2>
              <small class="{{ $photographer->custom_storage_limit ? 'text-warning fw-bold' : 'text-muted' }}">
                {{ $photographer->custom_storage_limit ? '★ Admin Custom Override' : 'Plan Default' }}
              </small>
            </article>
          </div>
          <div class="col-md-3">
            <article class="stat-card">
              <p>Platform Commission</p>
              <h2 class="text-info">{{ $photographer->effective_commission_rate }}</h2>
              <small class="{{ $photographer->custom_commission_rate ? 'text-warning fw-bold' : 'text-muted' }}">
                {{ $photographer->custom_commission_rate ? '★ Admin Custom Override' : 'Plan Default' }}
              </small>
            </article>
          </div>
          <div class="col-md-3">
            <article class="stat-card">
              <p>Account Status</p>
              @if($photographer->status === 'active')
                <h2 class="text-success">Active</h2>
                <small class="text-success">Verified Creator</small>
              @elseif($photographer->status === 'pending_approval')
                <h2 class="text-warning">Pending</h2>
                <small class="text-warning">Under Review</small>
              @else
                <h2 class="text-danger">Suspended</h2>
                <small class="text-danger">Access Locked</small>
              @endif
            </article>
          </div>
        </section>

        <!-- Detail Grid: Membership Overrides & Status Controls -->
        <div class="admin-detail-grid">
          <!-- Left: Membership Privileges & Custom Overrides Card -->
          <section class="panel detail-card">
            <div class="section-heading">
              <div>
                <p class="eyebrow">Membership Privileges</p>
                <h3>Active Features &amp; Overrides</h3>
              </div>
              <a class="view-link" href="{{ route('admin.photographers.edit', $photographer->id) }}">
                Edit Overrides <i class="bi bi-pencil"></i>
              </a>
            </div>

            <div class="p-3 rounded mb-3" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08);">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted">Membership Tier:</span>
                <span class="badge bg-light text-dark fw-bold px-3 py-1">
                  {{ $photographer->membership?->name ?: ucfirst($photographer->tier ?: 'Starter') }}
                </span>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted">Storage Quota:</span>
                <span class="fw-semibold text-white">
                  {{ $photographer->effective_storage_limit }}
                  @if($photographer->custom_storage_limit)
                    <span class="badge bg-warning text-dark ms-1" style="font-size: 0.65rem;">Override</span>
                  @endif
                </span>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted">Marketplace Commission:</span>
                <span class="fw-semibold text-white">
                  {{ $photographer->effective_commission_rate }}
                  @if($photographer->custom_commission_rate)
                    <span class="badge bg-warning text-dark ms-1" style="font-size: 0.65rem;">Override</span>
                  @endif
                </span>
              </div>
              <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted">Profile Verification Badge:</span>
                <span class="fw-semibold text-info">
                  {{ $photographer->effective_badge_heading }}
                </span>
              </div>
            </div>

            <h5 class="text-white mt-4 mb-3" style="font-size: 0.95rem;">Feature Entitlements:</h5>
            <div class="row g-2">
              @php
                $featuresList = [
                  'ai_search' => 'AI Face & Bib Recognition',
                  'custom_watermark' => 'Custom Watermark Studio',
                  'direct_messages' => 'Direct Client Messages',
                  'custom_domain' => 'Custom Profile Domain',
                  'priority_support' => 'Priority Support Escalation',
                ];
              @endphp

              @foreach($featuresList as $key => $label)
                @php
                  $hasFeat = $photographer->hasFeature($key);
                @endphp
                <div class="col-sm-6">
                  <div class="p-2 rounded d-flex align-items-center gap-2" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05);">
                    <i class="bi {{ $hasFeat ? 'bi-check-circle-fill text-success' : 'bi-dash-circle text-muted' }}"></i>
                    <span class="{{ $hasFeat ? 'text-white' : 'text-muted' }}" style="font-size: 0.85rem;">{{ $label }}</span>
                  </div>
                </div>
              @endforeach
            </div>
          </section>

          <!-- Right: Admin Status & Notes Controls -->
          <aside class="panel detail-card">
            <div class="section-heading">
              <div>
                <p class="eyebrow">Admin control</p>
                <h3>Account status &amp; notes</h3>
              </div>
              <i class="bi bi-shield-lock control-heading-icon"></i>
            </div>

            <form action="{{ route('admin.photographers.toggle-status', $photographer->id) }}" method="POST">
              @csrf
              @method('PATCH')

              <label class="form-label" for="account-status">Account Status</label>
              <select class="form-select mb-3" name="status" id="account-status">
                <option value="active" {{ $photographer->status === 'active' ? 'selected' : '' }}>Verified and active</option>
                <option value="pending_approval" {{ $photographer->status === 'pending_approval' ? 'selected' : '' }}>Pending verification</option>
                <option value="suspended" {{ $photographer->status === 'suspended' ? 'selected' : '' }}>Suspended</option>
              </select>

              <label class="form-label" for="admin-note">Internal admin note</label>
              <textarea class="form-control mb-3" name="admin_notes" id="admin-note" placeholder="Record reason for account status or custom override..." rows="4">{{ $photographer->admin_notes }}</textarea>

              <div class="detail-actions">
                <button class="btn btn-primary" type="submit"><i class="bi bi-check2"></i> Save Status &amp; Notes</button>
              </div>
            </form>
          </aside>
        </div>

        <!-- Account Verification & Payout Information -->
        <section class="panel detail-card account-info mt-4">
          <div class="section-heading">
            <div>
              <p class="eyebrow">Commercial Information</p>
              <h3>Verification and Payout Details</h3>
            </div>
          </div>
          <div class="row g-4 mt-1">
            <div class="col-md-3">
              <small class="text-muted d-block">Payout Email</small>
              <strong class="text-white">{{ $photographer->payout_email ?: $photographer->email }}</strong>
            </div>
            <div class="col-md-3">
              <small class="text-muted d-block">Payout Method</small>
              <strong class="text-white">{{ $photographer->payout_method ?: 'Bank Transfer' }}</strong>
            </div>
            <div class="col-md-3">
              <small class="text-muted d-block">Specialty Coverage</small>
              <strong class="text-white">{{ $photographer->specialty ?: 'Sports & Action Photography' }}</strong>
            </div>
            <div class="col-md-3">
              <small class="text-muted d-block">Account Created</small>
              <strong class="text-white">{{ $photographer->created_at ? $photographer->created_at->format('d M Y') : 'N/A' }}</strong>
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