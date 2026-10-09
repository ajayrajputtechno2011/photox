<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <title>PhotoX Admin | {{ isset($photographer) ? 'Edit Photographer' : 'Add Photographer' }}</title>
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
            <strong>{{ isset($photographer) ? 'Edit Photographer' : 'Add photographer' }}</strong>
          </div>
        </div>
      </header>

      <main class="content-area module-page">
        <div class="page-intro">
          <p class="eyebrow">Creator Onboarding &amp; Tier Controls</p>
          <h1>{{ isset($photographer) ? 'Edit: ' . $photographer->name : 'Add Photographer' }}</h1>
          <p class="intro-copy">Manage account information, assign membership tiers, and configure custom storage and commission overrides.</p>
        </div>

        @if($errors->any())
          <div class="alert alert-danger mb-4" style="background: rgba(220,53,69,0.15); border: 1px solid rgba(220,53,69,0.3); color: #ff6b6b; border-radius: 10px;">
            <ul class="mb-0">
              @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ isset($photographer) ? route('admin.photographers.update', $photographer->id) : route('admin.photographers.store') }}" method="POST" enctype="multipart/form-data" class="photographer-form">
          @csrf
          @if(isset($photographer))
            @method('PUT')
          @endif

          <!-- Section 1: Profile Details -->
          <section class="panel detail-card mb-4">
            <div class="section-heading">
              <div>
                <p class="eyebrow">Profile details</p>
                <h3>Identity and contact</h3>
              </div>
              <span class="form-step">01 / 03</span>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label" for="full-name">Full name *</label>
                <input class="form-control" name="name" id="full-name" value="{{ old('name', $photographer->name ?? '') }}" placeholder="e.g. Jordan Miller" required>
              </div>
              <div class="col-md-6">
                <label class="form-label" for="email">Email address *</label>
                <input class="form-control" name="email" id="email" value="{{ old('email', $photographer->email ?? '') }}" placeholder="name@studio.co" required type="email">
              </div>
              <div class="col-md-6">
                <label class="form-label" for="phone">Phone number</label>
                <input class="form-control" name="phone" id="phone" value="{{ old('phone', $photographer->phone ?? '') }}" placeholder="+27 82 000 0000">
              </div>
              <div class="col-md-6">
                <label class="form-label" for="location">City / Location</label>
                <input class="form-control" name="location" id="location" value="{{ old('location', $photographer->location ?? '') }}" placeholder="Cape Town, South Africa">
              </div>
              <div class="col-12">
                <label class="form-label" for="specialty">Specialty / Coverage</label>
                <input class="form-control" name="specialty" id="specialty" value="{{ old('specialty', $photographer->specialty ?? '') }}" placeholder="e.g. Running, Rugby &amp; Cycling">
              </div>

              <!-- Media Option 1: Avatar / Profile Photo or Logo (Upload + URL) -->
              <div class="col-md-6">
                <div class="p-3 rounded border" style="background: rgba(15, 23, 42, 0.45); border-color: rgba(255,255,255,0.1) !important;">
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <label class="form-label mb-0 fw-semibold text-white">
                      <i class="bi bi-person-bounding-box text-warning me-1"></i> Avatar / Profile Photo or Logo
                    </label>
                    <span class="badge bg-secondary" style="font-size: 0.72rem;">Upload or URL</span>
                  </div>
                  
                  <!-- File Upload Input -->
                  <div class="mb-2">
                    <label class="form-label text-muted small mb-1" for="avatar_file"><i class="bi bi-cloud-arrow-up me-1"></i> Choose file to upload:</label>
                    <input class="form-control form-control-sm" type="file" name="avatar_file" id="avatar_file" accept="image/png,image/jpeg,image/webp,image/gif">
                  </div>

                  <div class="d-flex align-items-center gap-2 my-2">
                    <hr class="flex-grow-1 border-secondary m-0">
                    <span class="text-muted small text-uppercase" style="font-size: 0.7rem;">OR</span>
                    <hr class="flex-grow-1 border-secondary m-0">
                  </div>

                  <!-- Direct URL Input -->
                  <div>
                    <label class="form-label text-muted small mb-1" for="avatar"><i class="bi bi-link-45deg me-1"></i> Image / Logo Web URL:</label>
                    <input class="form-control form-control-sm" name="avatar" id="avatar" value="{{ old('avatar', $photographer->avatar ?? '') }}" placeholder="https://images.unsplash.com/... or /storage/...">
                  </div>

                  @if(!empty($photographer?->avatar))
                  <div class="d-flex align-items-center gap-3 mt-3 pt-2 border-top border-secondary">
                    <img src="{{ $photographer->avatar }}" alt="Avatar Preview" class="rounded-circle object-fit-cover border border-warning" style="width: 50px; height: 50px;">
                    <div>
                      <small class="text-white-50 d-block">Current Avatar / Logo</small>
                      <small class="text-truncate d-inline-block text-muted" style="max-width: 220px;">{{ basename($photographer->avatar) }}</small>
                    </div>
                  </div>
                  @endif
                </div>
              </div>

              <!-- Media Option 2: Storefront Header Banner (Upload + URL) -->
              <div class="col-md-6">
                <div class="p-3 rounded border" style="background: rgba(15, 23, 42, 0.45); border-color: rgba(255,255,255,0.1) !important;">
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <label class="form-label mb-0 fw-semibold text-white">
                      <i class="bi bi-image-fill text-warning me-1"></i> Storefront Header Banner
                    </label>
                    <span class="badge bg-secondary" style="font-size: 0.72rem;">Upload or URL</span>
                  </div>

                  <!-- File Upload Input -->
                  <div class="mb-2">
                    <label class="form-label text-muted small mb-1" for="banner_file"><i class="bi bi-cloud-arrow-up me-1"></i> Choose file to upload:</label>
                    <input class="form-control form-control-sm" type="file" name="banner_file" id="banner_file" accept="image/png,image/jpeg,image/webp">
                  </div>

                  <div class="d-flex align-items-center gap-2 my-2">
                    <hr class="flex-grow-1 border-secondary m-0">
                    <span class="text-muted small text-uppercase" style="font-size: 0.7rem;">OR</span>
                    <hr class="flex-grow-1 border-secondary m-0">
                  </div>

                  <!-- Direct URL Input -->
                  <div>
                    <label class="form-label text-muted small mb-1" for="banner_image"><i class="bi bi-link-45deg me-1"></i> Banner Web URL:</label>
                    <input class="form-control form-control-sm" name="banner_image" id="banner_image" value="{{ old('banner_image', $photographer->banner_image ?? '') }}" placeholder="https://images.unsplash.com/... (1600x450)">
                  </div>

                  @if(!empty($photographer?->banner_image))
                  <div class="mt-3 pt-2 border-top border-secondary">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                      <small class="text-white-50">Current Banner Preview</small>
                      <small class="text-warning small"><i class="bi bi-check-circle-fill me-1"></i> Active</small>
                    </div>
                    <img src="{{ $photographer->banner_image }}" alt="Banner Preview" class="rounded w-100 object-fit-cover border border-secondary" style="height: 50px;">
                  </div>
                  @endif
                </div>
              </div>
              <div class="col-12">
                <label class="form-label" for="bio">Profile bio</label>
                <textarea class="form-control" name="bio" id="bio" placeholder="Short introduction shown on the photographer profile" rows="3">{{ old('bio', $photographer->bio ?? '') }}</textarea>
              </div>
            </div>
          </section>

          <!-- Section 2: Membership Tier & Admin Custom Overrides (Key Feature) -->
          <section class="panel detail-card mb-4" style="border: 1px solid rgba(245, 158, 11, 0.35); background: linear-gradient(180deg, rgba(245, 158, 11, 0.04), rgba(0,0,0,0));">
            <div class="section-heading">
              <div>
                <p class="eyebrow text-warning">Marketplace &amp; Membership</p>
                <h3>Plan Selection &amp; Custom Overrides</h3>
              </div>
              <span class="badge bg-warning text-dark fw-bold px-3 py-1">Admin Privilege</span>
            </div>

            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label" for="membership_id">Base Membership Plan</label>
                <select class="form-select" name="membership_id" id="membership_id">
                  @foreach($memberships as $m)
                    <option value="{{ $m->id }}" {{ (old('membership_id', $photographer->membership_id ?? '') == $m->id || (isset($photographer) && $photographer->tier === $m->slug)) ? 'selected' : '' }}>
                      {{ $m->name }} ({{ $m->commission_rate }} Comm · {{ $m->storage_limit }} Storage)
                    </option>
                  @endforeach
                </select>
                <small class="text-muted">Select base plan (Starter, Standard, Pro, PhotoGuild SA, Custom).</small>
              </div>

              <div class="col-md-6">
                <label class="form-label" for="verification_badge">Verification Badge Heading</label>
                <input class="form-control" name="verification_badge" id="verification_badge" value="{{ old('verification_badge', $photographer->verification_badge ?? '') }}" placeholder="e.g. Pro Member, Photo Guild Member">
                <small class="text-muted">Displayed on photographer profile and public roster.</small>
              </div>

              <!-- VIP Custom Overrides Callout -->
              <div class="col-12 mt-4">
                <div class="p-3 rounded" style="background: rgba(0,0,0,0.3); border: 1px dashed rgba(245, 158, 11, 0.4);">
                  <div class="d-flex align-items-center gap-2 mb-3">
                    <i class="bi bi-sliders text-warning fs-5"></i>
                    <strong class="text-white">Admin Custom Override (Overrides Preset Tier Defaults):</strong>
                  </div>

                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label" for="custom_storage_limit">Custom Storage Limit</label>
                      <input class="form-control" name="custom_storage_limit" id="custom_storage_limit" value="{{ old('custom_storage_limit', $photographer->custom_storage_limit ?? '') }}" placeholder="e.g. 200 GB, 1 TB, Unlimited (leave empty for plan default)">
                    </div>

                    <div class="col-md-6">
                      <label class="form-label" for="custom_commission_rate">Custom Marketplace Commission %</label>
                      <input class="form-control" name="custom_commission_rate" id="custom_commission_rate" value="{{ old('custom_commission_rate', $photographer->custom_commission_rate ?? '') }}" placeholder="e.g. 8%, 5%, 0% (leave empty for plan default)">
                    </div>

                    <div class="col-12 mt-3">
                      <label class="form-label d-block text-white mb-2">Feature Privileges Override:</label>
                      @php
                        $featuresList = [
                          'ai_search' => 'AI Face & Bib Recognition',
                          'custom_watermark' => 'Custom Watermark Studio & Presets',
                          'direct_messages' => 'Direct Client Messages',
                          'custom_domain' => 'Custom Profile Domain',
                          'priority_support' => 'Priority VIP Support',
                        ];
                        $selectedFeats = old('custom_features', $photographer->custom_features ?? ['ai_search', 'custom_watermark', 'direct_messages']);
                        if (!is_array($selectedFeats)) $selectedFeats = [];
                      @endphp

                      <div class="d-flex flex-wrap gap-4">
                        @foreach($featuresList as $fKey => $fLabel)
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="custom_features[]" value="{{ $fKey }}" id="feat_{{ $fKey }}" {{ in_array($fKey, $selectedFeats) ? 'checked' : '' }}>
                            <label class="form-check-label text-white-50" for="feat_{{ $fKey }}">
                              {{ $fLabel }}
                            </label>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <!-- Section 3: Commercial & Account Controls -->
          <section class="panel detail-card mb-4">
            <div class="section-heading">
              <div>
                <p class="eyebrow">Account verification</p>
                <h3>Access and commercial details</h3>
              </div>
              <span class="form-step">03 / 03</span>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label" for="status">Account status</label>
                <select class="form-select" name="status" id="status">
                  <option value="active" {{ old('status', $photographer->status ?? '') === 'active' ? 'selected' : '' }}>Verified and active</option>
                  <option value="pending_approval" {{ old('status', $photographer->status ?? '') === 'pending_approval' ? 'selected' : '' }}>Pending review</option>
                  <option value="suspended" {{ old('status', $photographer->status ?? '') === 'suspended' ? 'selected' : '' }}>Suspended</option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label" for="payout_email">Payout email</label>
                <input class="form-control" name="payout_email" id="payout_email" value="{{ old('payout_email', $photographer->payout_email ?? '') }}" placeholder="payouts@studio.co" type="email">
              </div>

              <div class="col-md-6">
                <label class="form-label" for="payout_method">Payout method</label>
                <input class="form-control" name="payout_method" id="payout_method" value="{{ old('payout_method', $photographer->payout_method ?? '') }}" placeholder="e.g. Bank Transfer · Standard Bank">
              </div>

              <div class="col-md-6">
                <label class="form-label" for="password">{{ isset($photographer) ? 'Reset Password (optional)' : 'Account Password' }}</label>
                <input class="form-control" name="password" id="password" type="password" placeholder="{{ isset($photographer) ? 'Leave empty to keep existing' : 'Minimum 6 characters (default: photox2026)' }}">
              </div>

              <div class="col-12">
                <label class="form-label" for="admin_notes">Internal onboarding note</label>
                <textarea class="form-control" name="admin_notes" id="admin_notes" placeholder="Add context for verification, special tier reasons, or custom pricing arrangements" rows="3">{{ old('admin_notes', $photographer->admin_notes ?? '') }}</textarea>
              </div>
            </div>
          </section>

          <div class="detail-actions form-actions">
            <a class="btn btn-outline-light" href="{{ route('admin.photographers.index') }}">Cancel</a>
            <button class="btn btn-primary" type="submit">
              <i class="bi bi-person-check"></i> {{ isset($photographer) ? 'Save Photographer & Overrides' : 'Create Photographer' }}
            </button>
          </div>
        </form>
      </main>
    </div>
  </div>
  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
  <script src="{{ asset('admin-assets/js/app.js') }}"></script>
</body>
</html>
