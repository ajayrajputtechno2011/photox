<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="PhotoX photographer gallery management page.">
  <title>PhotoX | Portfolio Library</title>
  <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
  <script defer src="{{ asset('site-ad.js') }}"></script>

  <style>
    /* Clean Light Theme for Portfolio Library */
    body.customer-app {
      background: #f4f7fb !important;
      color: #0b2d5b;
      font-family: 'Space Grotesk', -apple-system, BlinkMacSystemFont, sans-serif;
    }
    .workspace-layout {
      display: grid;
      grid-template-columns: 280px 1fr;
      gap: 32px;
      margin-top: 24px;
      margin-bottom: 60px;
    }
    @media (max-width: 991px) {
      .workspace-layout {
        grid-template-columns: 1fr;
      }
    }
    .gallery-clean-card {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 16px;
      box-shadow: 0 4px 16px rgba(11, 45, 91, 0.05);
      overflow: hidden;
      transition: all 0.25s ease;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .gallery-clean-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px rgba(11, 45, 91, 0.1);
      border-color: #cbd5e1;
    }
    .gallery-clean-card .card-thumb-wrap {
      position: relative;
      height: 200px;
      background: #0f1f2e;
      overflow: hidden;
    }
    .gallery-clean-card .card-thumb-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.35s ease;
    }
    .gallery-clean-card:hover .card-thumb-wrap img {
      transform: scale(1.04);
    }
    .gallery-clean-table {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 14px;
      box-shadow: 0 4px 14px rgba(11, 45, 91, 0.04);
      overflow: hidden;
    }
    .gallery-clean-table thead th {
      background: #f8fafc;
      color: #475569;
      font-size: 0.78rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      font-weight: 700;
      border-bottom: 1px solid #e2e8f0;
      padding: 14px 16px;
    }
    .gallery-clean-table tbody td {
      padding: 14px 16px;
      vertical-align: middle;
      border-bottom: 1px solid #f1f5f9;
      font-size: 0.88rem;
    }
    .gallery-clean-table tbody tr:hover {
      background: #f8fafc;
    }
    .btn-pricing-quick {
      background: rgba(255, 138, 0, 0.1);
      color: #d97706;
      border: 1px solid rgba(255, 138, 0, 0.3);
      font-weight: 600;
      transition: all 0.2s ease;
    }
    .btn-pricing-quick:hover {
      background: #ff8a00;
      color: #ffffff;
      border-color: #ff8a00;
    }
    .modal-light .modal-content {
      background: #ffffff;
      color: #0b2d5b;
      border: 1px solid #e2e8f0;
      border-radius: 16px;
      box-shadow: 0 20px 40px rgba(0,0,0,0.12);
    }
    .modal-light .modal-header {
      background: #f8fafc;
      border-bottom: 1px solid #e2e8f0;
      border-top-left-radius: 16px;
      border-top-right-radius: 16px;
    }
    .modal-light .nav-pills .nav-link {
      color: #64748b;
      font-weight: 600;
      border-radius: 8px;
    }
    .modal-light .nav-pills .nav-link.active {
      background: #ff8a00;
      color: #ffffff;
    }
    /* Drag & Drop in modal */
    .drop-clean-box {
      border: 2px dashed #cbd5e1;
      border-radius: 14px;
      padding: 32px 20px;
      text-align: center;
      background: #f8fafc;
      cursor: pointer;
      transition: all 0.2s ease;
    }
    .drop-clean-box:hover, .drop-clean-box.dragover {
      border-color: #ff8a00;
      background: rgba(255, 138, 0, 0.05);
    }
    .drop-clean-box i {
      font-size: 38px;
      color: #ff8a00;
      display: block;
      margin-bottom: 6px;
    }
    /* Queue card & items in modal */
    .queue-clean-card {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      padding: 14px;
      margin-top: 14px;
      text-align: start;
    }
    .queue-clean-item {
      display: flex;
      align-items: center;
      gap: 12px;
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 10px;
      padding: 8px 12px;
      margin-bottom: 8px;
    }
    .queue-clean-thumb {
      width: 52px;
      height: 40px;
      object-fit: cover;
      border-radius: 6px;
      border: 1px solid #e2e8f0;
    }
    /* Progress Box in modal */
    .progress-clean-box {
      background: #ffffff;
      border: 1px solid #ff8a00;
      border-radius: 12px;
      padding: 16px 20px;
      margin-top: 16px;
      box-shadow: 0 4px 16px rgba(255, 138, 0, 0.12);
      text-align: start;
    }
    .progress-bar-custom {
      height: 12px;
      background: #f1f5f9;
      border-radius: 6px;
      overflow: hidden;
      margin: 10px 0;
    }
    .progress-bar-fill-custom {
      height: 100%;
      background: linear-gradient(90deg, #ff8a00, #ffb03a);
      width: 0%;
      transition: width 0.2s ease;
    }
  </style>
</head>
<body class="customer-app dashboard-page photographer-dashboard-page page-photographer-dashboard">
  <!-- Main Header -->
  <nav aria-label="Main navigation" class="navbar navbar-expand-lg py-2 bg-white border-bottom shadow-sm">
    <div class="container-xl">
      <a aria-label="PhotoX home" class="navbar-brand d-flex align-items-center gap-2" href="/"><img alt="PhotoX" src="{{ asset('logo.png') }}" style="height: 38px;"></a>
      <button aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler border-0 p-0" data-bs-target="#mainNav" data-bs-toggle="collapse" type="button"><i class="bi bi-list fs-2"></i></button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav mx-auto gap-lg-3 mt-3 mt-lg-0">
          <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/events">Explore</a></li>
          <li class="nav-item"><a class="nav-link" href="/photographers">Photographers</a></li>
          <li class="nav-item"><a class="nav-link" href="/membership">Membership</a></li>
          <li class="nav-item"><a class="nav-link" href="/blog">About</a></li>
          <li class="nav-item"><a class="nav-link" href="/#contact">Contact</a></li>
        </ul>
        <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
          <a class="header-cart position-relative text-dark" href="/cart" aria-label="Open cart"><i class="bi bi-cart3 fs-5"></i></a>
          <div class="account-menu">
            <button class="profile-trigger d-flex align-items-center gap-2 border-0 bg-transparent text-dark fw-semibold" aria-label="Open account menu">
              <span class="avatar bg-warning text-dark rounded-circle px-2 py-1 fw-bold">{{ strtoupper(substr(Auth::user()->name ?? 'P', 0, 2)) }}</span>
              <span class="d-none d-sm-inline">{{ Auth::user()->name ?? 'Creator' }}</span>
              <i class="bi bi-chevron-down small text-muted"></i>
            </button>
            <div class="account-dropdown" role="menu">
              <div class="account-dropdown-user p-2 border-bottom">
                <strong>{{ Auth::user()->name ?? 'Creator' }}</strong>
                <small class="d-block text-muted">{{ Auth::user()->email ?? '' }}</small>
              </div>
              <a href="{{ url('/photographer-profile') }}" class="dropdown-item py-2"><i class="bi bi-person me-2"></i> Profile &amp; Settings</a>
              <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="dropdown-item text-danger py-2 w-100 text-start border-0 bg-transparent"><i class="bi bi-box-arrow-left me-2"></i> Log out</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <main class="container-xl workspace-layout">
    <!-- Left Sidebar -->
    <aside class="workspace-sidebar" aria-label="Photographer navigation">
      <div class="workspace-greeting mb-4">
        <span class="eyebrow-blue text-uppercase fw-bold text-primary small d-block mb-1">PHOTOGRAPHER WORKSPACE</span>
        <h1 class="h3 fw-bold text-dark">Frame the<br><em>moment.</em></h1>
      </div>
      <nav class="workspace-nav d-flex flex-column gap-1 mb-4">
        <a class="workspace-nav-link text-decoration-none px-3 py-2 rounded-3 text-secondary d-flex align-items-center gap-2" href="/photographer-dashboard"><i class="bi bi-grid-1x2"></i><span>Overview</span></a>
        <a class="workspace-nav-link text-decoration-none px-3 py-2 rounded-3 text-secondary d-flex align-items-center gap-2" href="/photographer-bookings"><i class="bi bi-calendar-event"></i><span>Events</span></a>
        <a class="workspace-nav-link active text-decoration-none px-3 py-2 rounded-3 bg-white text-primary fw-bold shadow-sm d-flex align-items-center gap-2" href="/photographer-gallery"><i class="bi bi-images text-warning"></i><span>Gallery</span></a>
        <a class="workspace-nav-link text-decoration-none px-3 py-2 rounded-3 text-secondary d-flex align-items-center gap-2" href="{{ route('photographer.watermark') }}"><i class="bi bi-shield-lock"></i><span>Watermark Studio</span></a>
        <a class="workspace-nav-link text-decoration-none px-3 py-2 rounded-3 text-secondary d-flex align-items-center gap-2" href="/photographer-earnings"><i class="bi bi-wallet2"></i><span>Earnings</span></a>
        <a class="workspace-nav-link text-decoration-none px-3 py-2 rounded-3 text-secondary d-flex align-items-center gap-2" href="/photographer-payouts"><i class="bi bi-bank"></i><span>Payouts &amp; Bank</span></a>
        <a class="workspace-nav-link text-decoration-none px-3 py-2 rounded-3 text-secondary d-flex align-items-center gap-2" href="/photographer-messages"><i class="bi bi-chat-left-text"></i><span>Messages</span></a>
        <a class="workspace-nav-link text-decoration-none px-3 py-2 rounded-3 text-secondary d-flex align-items-center gap-2" href="/photographer-profile"><i class="bi bi-person-circle"></i><span>Profile</span></a>
        <a class="workspace-nav-link text-decoration-none px-3 py-2 rounded-3 text-secondary d-flex align-items-center gap-2" href="/notifications"><i class="bi bi-bell"></i><span>Notifications</span></a>
      </nav>
      <div class="p-3 bg-white rounded-3 border mb-3 shadow-sm">
        <div class="d-flex gap-2 align-items-center text-dark">
          <i class="bi bi-shield-check text-success fs-5"></i>
          <div>
            <strong class="d-block small">Coverage Secured</strong>
            <span class="text-muted" style="font-size: 0.78rem;">Watermarks &amp; pricing active.</span>
          </div>
        </div>
      </div>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-sm btn-link text-secondary text-decoration-none p-0"><i class="bi bi-box-arrow-left me-1"></i> Sign out</button>
      </form>
    </aside>

    <!-- Main Content Area -->
    <section class="workspace-content">
      <!-- Top Title Bar -->
      <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
        <div>
          <span class="text-uppercase fw-bold text-primary small" style="letter-spacing: 1px;">PORTFOLIO LIBRARY</span>
          <h2 class="h3 fw-bold text-dark mb-0">Galleries &amp; Events</h2>
          <p class="text-muted small mb-0">Manage albums, configure instant photo pricing, and customize cover images.</p>
        </div>
        <div class="d-flex gap-2">
          <a class="btn btn-outline-warning rounded-pill px-3 shadow-sm text-dark fw-semibold" href="{{ route('photographer.watermark') }}">
            <i class="bi bi-shield-lock me-1 text-warning"></i> Watermark Studio
          </a>
          <a class="btn btn-warning rounded-pill px-4 shadow-sm text-dark fw-bold" href="/photographer-upload-new">
            <i class="bi bi-cloud-arrow-up me-2"></i> Upload New Gallery
          </a>
        </div>
      </div>

      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm" role="alert">
          <i class="bi bi-check-circle-fill me-2 text-success"></i>{{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <!-- Search, Categories & View Mode Toolbar -->
      <div class="bg-white p-3 rounded-4 border shadow-sm mb-4">
        <div class="row g-3 align-items-center justify-content-between">
          <!-- Search input -->
          <div class="col-md-5">
            <form method="GET" action="{{ route('photographer.gallery') }}" class="d-flex gap-2">
              <input type="hidden" name="category" value="{{ $selectedCategory }}">
              <input type="hidden" name="view" value="{{ $viewMode ?? 'grid' }}">
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-search"></i></span>
                <input type="search" name="search" value="{{ $search }}" class="form-control border-start-0 bg-light" placeholder="Search galleries by name or location...">
                @if(!empty($search))
                  <a href="{{ route('photographer.gallery', ['view' => $viewMode ?? 'grid']) }}" class="btn btn-light border" title="Clear search"><i class="bi bi-x-lg"></i></a>
                @endif
              </div>
            </form>
          </div>

          <!-- View Mode Switcher & Public Storefront -->
          <div class="col-md-7 d-flex align-items-center justify-content-md-end gap-3 flex-wrap">
            <div class="btn-group" role="group" aria-label="View mode">
              <a href="{{ route('photographer.gallery', array_merge(request()->query(), ['view' => 'grid'])) }}" class="btn btn-sm {{ ($viewMode ?? 'grid') === 'grid' ? 'btn-primary' : 'btn-outline-secondary' }}">
                <i class="bi bi-grid-fill me-1"></i> Grid
              </a>
              <a href="{{ route('photographer.gallery', array_merge(request()->query(), ['view' => 'list'])) }}" class="btn btn-sm {{ ($viewMode ?? 'grid') === 'list' ? 'btn-primary' : 'btn-outline-secondary' }}">
                <i class="bi bi-list-ul me-1"></i> List
              </a>
            </div>

            <a class="text-decoration-none fw-semibold small text-primary d-inline-flex align-items-center gap-1" href="{{ route('photographers.details', $photographer->id) }}" target="_blank">
              View Public Storefront <i class="bi bi-arrow-up-right"></i>
            </a>
          </div>
        </div>

        <!-- Category Filter Pills -->
        <div class="d-flex gap-2 mt-3 pt-3 border-top overflow-x-auto flex-nowrap pb-1">
          <a href="{{ route('photographer.gallery', array_merge(request()->query(), ['category' => 'all'])) }}" class="btn btn-sm rounded-pill px-3 {{ empty($selectedCategory) || $selectedCategory === 'all' ? 'btn-dark' : 'btn-light border' }}">
            All Categories
          </a>
          @foreach($categories as $cat)
            <a href="{{ route('photographer.gallery', array_merge(request()->query(), ['category' => $cat->slug ?: $cat->name])) }}" class="btn btn-sm rounded-pill px-3 {{ $selectedCategory === ($cat->slug ?: $cat->name) ? 'btn-dark' : 'btn-light border' }}">
              {{ $cat->name }}
            </a>
          @endforeach
        </div>
      </div>

      @if($galleries->isEmpty())
        <div class="bg-white p-5 rounded-4 border text-center shadow-sm">
          <i class="bi bi-images display-3 text-muted mb-3 d-block"></i>
          <h4 class="fw-bold text-dark">No galleries found</h4>
          <p class="text-muted mb-4">{{ !empty($search) ? "No results matching '{$search}'. Try clearing filters." : 'Start building your portfolio by uploading your first event gallery.' }}</p>
          <a href="{{ route('photographer.upload') }}" class="btn btn-warning rounded-pill px-4 fw-bold">
            <i class="bi bi-cloud-arrow-up me-2"></i> Upload New Gallery
          </a>
        </div>
      @elseif(($viewMode ?? 'grid') === 'list')
        <!-- LIST VIEW -->
        <div class="table-responsive gallery-clean-table mb-4">
          <table class="table mb-0 align-middle">
            <thead>
              <tr>
                <th>Gallery &amp; Location</th>
                <th>Category</th>
                <th>Event Date</th>
                <th>Photos</th>
                <th>Pricing Structure</th>
                <th>Security / Mode</th>
                <th class="text-end">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($galleries as $gallery)
                @php
                  $photoFirst = $gallery->photos->first();
                  $singlePrice = $photoFirst?->personal_price ?: ($gallery->starting_price ?: 75);
                @endphp
                <tr>
                  <td>
                    <div class="d-flex align-items-center gap-3">
                      <img src="{{ $gallery->cover_image ?: ($photoFirst?->file_path ?: 'https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=300&q=80') }}" alt="{{ $gallery->title }}" style="width: 64px; height: 50px; object-fit: cover; border-radius: 8px;" class="border">
                      <div>
                        <a href="{{ route('events.show', $gallery->slug ?: $gallery->id) }}" target="_blank" class="fw-bold text-dark text-decoration-none d-block">
                          {{ $gallery->title }}
                        </a>
                        <small class="text-muted"><i class="bi bi-geo-alt me-1"></i>{{ $gallery->location ?: 'South Africa' }}</small>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="badge bg-light text-dark border">{{ $gallery->category_name ?: 'Sports' }}</span>
                  </td>
                  <td class="text-muted small">
                    {{ $gallery->event_date?->format('d M Y') ?? 'Recent' }}
                  </td>
                  <td>
                    <span class="badge bg-primary bg-opacity-10 text-primary fw-bold font-monospace px-2 py-1">
                      {{ $gallery->photos_count }} photos
                    </span>
                  </td>
                  <td>
                    <div class="d-flex flex-column gap-1" style="font-size: 0.82rem;">
                      <div><strong class="text-secondary">Single:</strong> <span class="fw-bold text-dark">R{{ number_format((float)$singlePrice, 0) }}</span></div>
                      @if($gallery->full_gallery_price)
                        <div><strong class="text-secondary">Complete:</strong> <span class="fw-bold text-success">R{{ number_format($gallery->full_gallery_price, 0) }}</span></div>
                      @endif
                      @if($gallery->selfie_bundle_price)
                        <div><strong class="text-secondary">Selfie:</strong> <span class="fw-bold text-warning">R{{ number_format($gallery->selfie_bundle_price, 0) }}</span></div>
                      @endif
                    </div>
                  </td>
                  <td>
                    <div class="d-flex flex-column gap-1">
                      @if($gallery->allow_individual_sales ?? true)
                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25" style="font-size: 0.72rem;">Individual &amp; Bundle</span>
                      @else
                        <span class="badge bg-warning text-dark fw-bold" style="font-size: 0.72rem;">Complete Only</span>
                      @endif
                      @if(!empty($gallery->is_password_protected))
                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25" style="font-size: 0.72rem;"><i class="bi bi-lock-fill me-1"></i>Protected</span>
                      @endif
                    </div>
                  </td>
                  <td class="text-end">
                    <div class="d-inline-flex gap-1">
                      <button type="button" class="btn btn-sm btn-warning rounded-pill px-3 fw-bold text-dark" onclick="openUploadTab({{ $gallery->id }})" title="Upload more photos to this event">
                        <i class="bi bi-cloud-arrow-up-fill me-1"></i> + Upload
                      </button>
                      <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-2" onclick="openPhotosTab({{ $gallery->id }})" title="Manage Photos &amp; Settings">
                        <i class="bi bi-images me-1"></i> Photos
                      </button>
                      <button type="button" class="btn btn-sm btn-pricing-quick rounded-pill px-2" onclick="openPricingModal({{ $gallery->id }})" title="Edit Pricing">
                        <i class="bi bi-currency-dollar"></i>
                      </button>
                      <a href="{{ route('events.show', $gallery->slug ?: $gallery->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-2" title="View Public Gallery">
                        <i class="bi bi-eye"></i>
                      </a>
                      <form action="{{ route('photographer.gallery.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Delete this gallery permanently?');" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-2 border-0" title="Delete Gallery"><i class="bi bi-trash"></i></button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <!-- GRID VIEW -->
        <div class="row g-4 mb-4">
          @foreach($galleries as $gallery)
            @php
              $photoFirst = $gallery->photos->first();
              $singlePrice = $photoFirst?->personal_price ?: ($gallery->starting_price ?: 75);
            @endphp
            <div class="col-md-6 col-lg-4">
              <article class="gallery-clean-card h-100">
                <div>
                  <div class="card-thumb-wrap">
                    <img src="{{ $gallery->cover_image ?: ($photoFirst?->file_path ?: 'https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=800&q=80') }}" alt="{{ $gallery->title }}">
                    @if($gallery->cover_photo_id)
                      <span class="position-absolute top-0 start-0 m-2 badge bg-warning text-dark fw-bold shadow-sm" style="font-size: 0.68rem;">
                        <i class="bi bi-star-fill me-1"></i> HOMEPAGE COVER
                      </span>
                    @endif
                    @if(!empty($gallery->is_password_protected))
                      <span class="position-absolute top-0 end-0 m-2 badge bg-danger shadow-sm" style="font-size: 0.68rem;">
                        <i class="bi bi-lock-fill me-1"></i> PASSWORD PROTECTED
                      </span>
                    @endif
                    <div class="position-absolute bottom-0 start-0 w-100 p-2 d-flex justify-content-between align-items-center" style="background: linear-gradient(0deg, rgba(0,0,0,0.7) 0%, transparent 100%);">
                      <span class="badge bg-dark bg-opacity-75 text-white font-monospace" style="font-size: 0.72rem;">
                        <i class="bi bi-camera me-1"></i> {{ $gallery->photos_count }} photos
                      </span>
                      <span class="badge bg-dark bg-opacity-75 text-white-50" style="font-size: 0.72rem;">
                        {{ $gallery->event_date?->format('d M Y') ?? 'Recent' }}
                      </span>
                    </div>
                  </div>

                  <div class="p-3">
                    <div class="d-flex justify-content-between align-items-start mb-2 gap-2">
                      <strong class="text-truncate text-dark fw-bold fs-6" style="max-width: 75%;" title="{{ $gallery->title }}">{{ $gallery->title }}</strong>
                      <span class="badge bg-light text-dark border">{{ $gallery->category_name ?: 'Sports' }}</span>
                    </div>
                    <span class="text-muted small d-block mb-3"><i class="bi bi-geo-alt me-1 text-danger"></i>{{ $gallery->location ?: 'South Africa' }}</span>

                    <!-- Quick Pricing Summary Box -->
                    <div class="p-2 bg-light rounded-3 border d-flex justify-content-around text-center mb-2">
                      <div>
                        <span class="text-muted d-block" style="font-size: 0.7rem;">SINGLE</span>
                        <strong class="text-dark">R{{ number_format((float)$singlePrice, 0) }}</strong>
                      </div>
                      @if($gallery->selfie_bundle_price)
                        <div class="border-start ps-2">
                          <span class="text-muted d-block" style="font-size: 0.7rem;">SELFIE</span>
                          <strong class="text-warning">R{{ number_format($gallery->selfie_bundle_price, 0) }}</strong>
                        </div>
                      @endif
                      <div class="border-start ps-2">
                        <span class="text-muted d-block" style="font-size: 0.7rem;">COMPLETE</span>
                        <strong class="text-success">R{{ number_format($gallery->full_gallery_price ?: 450, 0) }}</strong>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="p-3 bg-light border-top d-flex justify-content-between align-items-center gap-1">
                  <div class="d-flex gap-1 flex-wrap">
                    <button type="button" class="btn btn-sm btn-warning rounded-pill px-3 py-1 fw-bold text-dark" style="font-size: 0.78rem;" onclick="openUploadTab({{ $gallery->id }})" title="Upload more photos to this event">
                      <i class="bi bi-cloud-arrow-up-fill me-1"></i> + Upload
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-2 py-1" style="font-size: 0.78rem;" onclick="openPhotosTab({{ $gallery->id }})" title="Photos &amp; Settings">
                      <i class="bi bi-images me-1"></i> Photos ({{ $gallery->photos_count }})
                    </button>
                    <button type="button" class="btn btn-sm btn-pricing-quick rounded-pill px-2 py-1" style="font-size: 0.78rem;" onclick="openPricingModal({{ $gallery->id }})" title="Edit Pricing">
                      <i class="bi bi-currency-dollar me-1"></i> Pricing
                    </button>
                    <a href="{{ route('events.show', $gallery->slug ?: $gallery->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-2 py-1" style="font-size: 0.78rem;" title="View public gallery">
                      <i class="bi bi-eye"></i> View
                    </a>
                  </div>
                  <form action="{{ route('photographer.gallery.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Delete this gallery permanently?');" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-2 py-1 border-0" title="Delete Gallery"><i class="bi bi-trash"></i></button>
                  </form>
                </div>
              </article>
            </div>
          @endforeach
        </div>
      @endif

      <!-- Modals for each gallery -->
      @foreach($galleries as $gallery)
        @php
          $photoFirst = $gallery->photos->first();
          $singlePrice = $photoFirst?->personal_price ?: ($gallery->starting_price ?: 75);
          $commercialPrice = $photoFirst?->commercial_price ?: ($gallery->commercial_price ?: 185);
        @endphp

        <!-- 1. DEDICATED QUICK EDIT PRICING MODAL -->
        <div class="modal fade modal-light" id="pricingModal_{{ $gallery->id }}" tabindex="-1" aria-labelledby="pricingModalLabel_{{ $gallery->id }}" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <div>
                  <h5 class="modal-title fw-bold text-dark mb-0" id="pricingModalLabel_{{ $gallery->id }}">
                    <i class="bi bi-currency-dollar text-warning me-1"></i> Quick Edit Pricing
                  </h5>
                  <small class="text-muted">{{ $gallery->title }}</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="{{ route('photographer.gallery.update', $gallery->id) }}" method="POST">
                @csrf
                <input type="hidden" name="title" value="{{ $gallery->title }}">
                <div class="modal-body p-4">
                  <div class="alert alert-warning py-2 px-3 small mb-3">
                    <i class="bi bi-lightning-charge-fill me-1"></i>
                    Updates price across all {{ $gallery->photos_count }} photos in this album instantly.
                  </div>

                  <div class="row g-3 mb-3">
                    <div class="col-sm-6">
                      <label class="form-label text-dark small fw-bold text-uppercase">Single Personal (ZAR)</label>
                      <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 fw-bold">R</span>
                        <input type="number" step="0.50" min="0" name="personal_price" class="form-control" value="{{ (float)$singlePrice }}" required>
                      </div>
                      <small class="text-muted" style="font-size: 0.72rem;">Parents &amp; athletes</small>
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label text-dark small fw-bold text-uppercase">Single Commercial (ZAR)</label>
                      <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 fw-bold">R</span>
                        <input type="number" step="1.00" min="0" name="commercial_price" class="form-control" value="{{ (float)$commercialPrice }}">
                      </div>
                      <small class="text-muted" style="font-size: 0.72rem;">Corporate &amp; brands</small>
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label text-dark small fw-bold text-uppercase">Selfie Bundle (ZAR)</label>
                      <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 fw-bold">R</span>
                        <input type="number" step="1.00" min="0" name="selfie_bundle_price" class="form-control" value="{{ $gallery->selfie_bundle_price ?: '' }}" placeholder="e.g. 250">
                      </div>
                      <small class="text-muted" style="font-size: 0.72rem;">Leave empty if disabled</small>
                    </div>

                    <div class="col-sm-6">
                      <label class="form-label text-dark small fw-bold text-uppercase">Complete Gallery (ZAR)</label>
                      <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 fw-bold">R</span>
                        <input type="number" step="1.00" min="0" name="full_gallery_price" class="form-control" value="{{ $gallery->full_gallery_price ?: 450.00 }}">
                      </div>
                      <small class="text-muted" style="font-size: 0.72rem;">All event photos</small>
                    </div>
                  </div>

                  <!-- Sales Mode Selection -->
                  <div class="p-3 bg-light rounded-3 border">
                    <label class="form-label text-dark small fw-bold text-uppercase mb-2">Sales Mode</label>
                    <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="allow_individual_sales" id="priceModeBoth_{{ $gallery->id }}" value="1" {{ ($gallery->allow_individual_sales ?? true) ? 'checked' : '' }}>
                      <label class="form-check-label text-dark small fw-semibold" for="priceModeBoth_{{ $gallery->id }}">
                        Allow Individual Photos + Bundles
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="allow_individual_sales" id="priceModeOnly_{{ $gallery->id }}" value="0" {{ !($gallery->allow_individual_sales ?? true) ? 'checked' : '' }}>
                      <label class="form-check-label text-dark small fw-semibold text-warning" for="priceModeOnly_{{ $gallery->id }}">
                        Sell Complete Gallery ONLY (No Single Image Purchases)
                      </label>
                    </div>
                  </div>
                </div>
                <div class="modal-footer bg-light">
                  <button type="button" class="btn btn-outline-secondary rounded-pill px-3" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-warning rounded-pill px-4 fw-bold text-dark">Save Pricing</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- 2. PHOTOS & FULL SETTINGS MODAL -->
        <div class="modal fade modal-light" id="galleryManageModal_{{ $gallery->id }}" tabindex="-1" aria-labelledby="manageModalLabel_{{ $gallery->id }}" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <div>
                  <h5 class="modal-title fw-bold text-dark mb-0" id="manageModalLabel_{{ $gallery->id }}">
                    <i class="bi bi-images text-warning me-2"></i>{{ $gallery->title }}
                  </h5>
                  <small class="text-muted">{{ $gallery->photos_count }} photos · {{ $gallery->location }}</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <div class="modal-body p-4">
                <!-- Nav Pills for Management Tabs -->
                <ul class="nav nav-pills nav-fill mb-4 p-1 rounded-3 bg-light border" role="tablist">
                  <li class="nav-item">
                    <button class="nav-link active py-2" data-bs-toggle="pill" data-bs-target="#tabPhotos_{{ $gallery->id }}" type="button" role="tab">
                      <i class="bi bi-grid me-1"></i> Photos &amp; Best Cover (<span class="fw-bold">{{ $gallery->photos->count() }}</span>)
                    </button>
                  </li>
                  <li class="nav-item">
                    <button class="nav-link py-2" data-bs-toggle="pill" data-bs-target="#tabUpload_{{ $gallery->id }}" type="button" role="tab">
                      <i class="bi bi-cloud-arrow-up me-1"></i> Upload More
                    </button>
                  </li>
                  <li class="nav-item">
                    <button class="nav-link py-2" data-bs-toggle="pill" data-bs-target="#tabSettings_{{ $gallery->id }}" type="button" role="tab">
                      <i class="bi bi-sliders me-1"></i> Full Album Settings
                    </button>
                  </li>
                </ul>

                <div class="tab-content">
                  <!-- Tab 1: Photos & Cover Selector -->
                  <div class="tab-pane fade show active" id="tabPhotos_{{ $gallery->id }}" role="tabpanel">
                    <div class="p-3 mb-3 rounded bg-warning bg-opacity-10 border border-warning border-opacity-25">
                      <strong class="text-dark d-block small mb-1"><i class="bi bi-star-fill text-warning me-1"></i> Homepage Best Cover Photo</strong>
                      <span class="text-muted small">Click "Best Cover" on any photo below to choose the primary featured cover image displayed on the explore and home pages.</span>
                    </div>

                    @if($gallery->photos->isNotEmpty())
                      <div class="row g-3">
                        @foreach($gallery->photos as $photo)
                          @php
                            $isBest = ($gallery->cover_photo_id == $photo->id) || (!empty($photo->is_featured));
                          @endphp
                          <div class="col-sm-6 col-md-4">
                            <div class="card h-100 position-relative border {{ $isBest ? 'border-warning border-2' : '' }} shadow-sm" style="border-radius: 10px; overflow: hidden;">
                              <div class="position-relative">
                                <img src="/protected-photo/{{ $photo->id }}" alt="{{ $photo->title }}" style="width: 100%; height: 130px; object-fit: cover;">
                                @if($isBest)
                                  <span class="position-absolute top-0 start-0 m-1 badge bg-warning text-dark fw-bold" style="font-size: 0.65rem;">
                                    <i class="bi bi-star-fill me-1"></i> BEST COVER
                                  </span>
                                @endif
                              </div>
                              <div class="p-2 d-flex flex-column justify-content-between flex-grow-1 bg-white">
                                <span class="text-truncate text-dark small fw-semibold mb-2" title="{{ $photo->title }}">{{ $photo->title ?: 'Photo #' . $photo->id }}</span>
                                <div class="d-flex justify-content-between align-items-center gap-1 border-top pt-2">
                                  @if($isBest)
                                    <span class="badge bg-warning text-dark py-1 px-2" style="font-size: 0.65rem; font-weight: 700;">
                                      <i class="bi bi-check-circle-fill me-1"></i> Active Cover
                                    </span>
                                  @else
                                    <form action="{{ route('photographer.gallery.photo.cover', $photo->id) }}" method="POST">
                                      @csrf
                                      <button type="submit" class="btn btn-sm btn-outline-warning py-0 px-2 text-dark" style="font-size: 0.68rem;" title="Feature on homepage">
                                        <i class="bi bi-star me-1"></i> Best Cover
                                      </button>
                                    </form>
                                  @endif

                                  <form action="{{ route('photographer.gallery.photo.delete', $photo->id) }}" method="POST" onsubmit="return confirm('Delete this photo from gallery?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-link text-danger p-0 text-decoration-none" style="font-size: 0.72rem;">
                                      <i class="bi bi-trash"></i>
                                    </button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    @else
                      <div class="text-center py-4 text-muted">
                        <i class="bi bi-camera fs-2 d-block mb-2"></i>
                        <p class="small mb-0">No photos in this gallery yet. Use the Upload tab to add photos!</p>
                      </div>
                    @endif
                  </div>

                  <!-- Tab 2: Upload More Photos (Drag & Drop + 15-Photo Batch Chunking for 500-1000+ Photos) -->
                  <div class="tab-pane fade" id="tabUpload_{{ $gallery->id }}" role="tabpanel">
                    <!-- Drag & Drop Box -->
                    <div class="drop-clean-box mb-3" id="dropArea_{{ $gallery->id }}" onclick="document.getElementById('photosInput_{{ $gallery->id }}').click();">
                      <i class="bi bi-cloud-arrow-up"></i>
                      <h5 class="fw-bold text-dark mb-1">Drag &amp; Drop photos here to add to "{{ $gallery->title }}"</h5>
                      <p class="text-muted small mb-3">Support for JPG, PNG, and WebP (select 50, 100, 500, or 1000+ photos at once)</p>
                      <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-4 text-dark fw-bold">
                        <i class="bi bi-folder2-open me-1"></i> Browse Files from Computer
                      </button>
                    </div>
                    <input type="file" id="photosInput_{{ $gallery->id }}" multiple accept="image/*" class="d-none" onchange="handleModalFilesSelected({{ $gallery->id }}, this.files)">

                    <!-- Selected Queue (Previews & Counter) -->
                    <div class="queue-clean-card d-none mb-3" id="queueCardContainer_{{ $gallery->id }}">
                      <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                        <div class="d-flex align-items-center gap-2">
                          <span class="fw-bold text-dark fs-6">
                            <i class="bi bi-collection-play text-warning me-1"></i> Selected Queue:
                          </span>
                          <span class="badge bg-primary rounded-pill" id="queueCountBadge_{{ $gallery->id }}">0 photos</span>
                          <span class="text-muted small" id="queueSizeText_{{ $gallery->id }}">· 0 MB</span>
                        </div>
                        <button type="button" class="btn btn-sm btn-link text-danger text-decoration-none p-0 fw-semibold" onclick="clearModalQueue({{ $gallery->id }})">
                          <i class="bi bi-trash3 me-1"></i> Clear all
                        </button>
                      </div>
                      <div class="queue-list" id="queueListEl_{{ $gallery->id }}" style="max-height: 220px; overflow-y: auto;">
                        <!-- Injected dynamically -->
                      </div>
                    </div>

                    <!-- Live Upload Progress Box (Matching Add Event page) -->
                    <div class="progress-clean-box d-none mb-3" id="uploadProgressBox_{{ $gallery->id }}">
                      <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center gap-2">
                          <span class="spinner-border spinner-border-sm text-warning" role="status"></span>
                          <strong class="text-dark" id="progressStatusTitle_{{ $gallery->id }}">Uploading photos...</strong>
                        </div>
                        <span class="text-warning fw-bold font-monospace fs-5" id="progressPercentText_{{ $gallery->id }}">0%</span>
                      </div>

                      <div class="progress-bar-custom">
                        <div class="progress-bar-fill-custom" id="progressBarFill_{{ $gallery->id }}"></div>
                      </div>

                      <div class="d-flex justify-content-between align-items-center text-muted small mt-1">
                        <span id="progressLoadedText_{{ $gallery->id }}">Batch 0: 0 MB / 0 MB uploaded</span>
                        <span id="progressPhotosCountText_{{ $gallery->id }}">0 / 0 photos</span>
                      </div>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex justify-content-end align-items-center gap-2">
                      <button type="button" class="btn btn-outline-secondary rounded-pill px-3" data-bs-dismiss="modal">Cancel</button>
                      <button type="button" id="uploadStartBtn_{{ $gallery->id }}" class="btn btn-warning fw-bold text-dark rounded-pill px-4 shadow-sm" onclick="startModalBatchUpload({{ $gallery->id }})" disabled>
                        <i class="bi bi-cloud-arrow-up-fill me-1"></i> Start Upload &amp; Watermark
                      </button>
                    </div>
                  </div>

                  <!-- Tab 3: Edit Gallery Settings & ZebraSnap Toggles -->
                  <div class="tab-pane fade" id="tabSettings_{{ $gallery->id }}" role="tabpanel">
                    <form action="{{ route('photographer.gallery.update', $gallery->id) }}" method="POST">
                      @csrf
                      <div class="mb-3">
                        <label class="form-label text-dark small text-uppercase fw-bold">Gallery Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $gallery->title }}" required>
                      </div>

                      <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                          <label class="form-label text-dark small text-uppercase fw-bold">Category</label>
                          <select name="category_id" class="form-select">
                            @foreach($categories as $cat)
                              <option value="{{ $cat->id }}" {{ $gallery->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-sm-6">
                          <label class="form-label text-dark small text-uppercase fw-bold">Event Date</label>
                          <input type="date" name="event_date" class="form-control" value="{{ $gallery->event_date ? $gallery->event_date->format('Y-m-d') : date('Y-m-d') }}">
                        </div>
                      </div>

                      <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                          <label class="form-label text-dark small text-uppercase fw-bold">Location</label>
                          <input type="text" name="location" class="form-control" value="{{ $gallery->location }}">
                        </div>
                        <div class="col-sm-6">
                          <label class="form-label text-dark small text-uppercase fw-bold">Starting Price Display</label>
                          <input type="text" name="starting_price" class="form-control" value="{{ $gallery->starting_price }}">
                        </div>
                      </div>

                      <!-- ZebraSnap Extra Settings: Password Protect & Notes -->
                      <div class="p-3 mb-3 rounded bg-light border">
                        <h6 class="fw-bold text-dark mb-2"><i class="bi bi-shield-lock me-1 text-primary"></i> ZebraSnap Privacy &amp; Access</h6>

                        <div class="form-check form-switch mb-2">
                          <input class="form-check-input" type="checkbox" name="is_password_protected" id="editPassCheck_{{ $gallery->id }}" value="1" {{ !empty($gallery->is_password_protected) ? 'checked' : '' }} onchange="document.getElementById('editPassWrap_{{ $gallery->id }}').classList.toggle('d-none', !this.checked);">
                          <label class="form-check-label text-dark fw-semibold" for="editPassCheck_{{ $gallery->id }}">Password-protected album</label>
                        </div>
                        <div class="{{ empty($gallery->is_password_protected) ? 'd-none' : '' }} mb-3" id="editPassWrap_{{ $gallery->id }}">
                          <label class="form-label text-muted small fw-bold">Access Password</label>
                          <input type="text" name="access_password" class="form-control" value="{{ $gallery->access_password }}" placeholder="e.g. VIP2026 or SecretPass">
                        </div>

                        <div class="form-check form-switch mb-2">
                          <input class="form-check-input" type="checkbox" name="privacy_mode" id="editPrivacyCheck_{{ $gallery->id }}" value="1" {{ !empty($gallery->privacy_mode) ? 'checked' : '' }}>
                          <label class="form-check-label text-dark fw-semibold" for="editPrivacyCheck_{{ $gallery->id }}">Show only each person's photos (Privacy mode)</label>
                        </div>

                        <div class="mt-3">
                          <label class="form-label text-dark small fw-bold text-uppercase">Photographer's Notes (Shown on Event Gallery)</label>
                          <textarea name="photographer_notes" rows="2" class="form-control" placeholder="Leave a thank-you note or instruction for customers...">{{ $gallery->photographer_notes }}</textarea>
                        </div>
                      </div>

                      <div class="mb-3">
                        <label class="form-label text-dark small text-uppercase fw-bold">Description</label>
                        <textarea name="description" rows="2" class="form-control">{{ $gallery->description }}</textarea>
                      </div>

                      <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning fw-bold text-dark px-4">Save Gallery Settings</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach

      <!-- Pagination -->
      <div class="mt-4">
        {{ $galleries->links() }}
      </div>
    </section>
  </main>

  @include('web.partials.footer')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    if (typeof bootstrap === 'undefined') {
      document.write('<script src="{{ asset('js/bootstrap.bundle.min.js') }}"><\/script>');
    }
  </script>
  <script>
    const modalQueues = {};

    function getQueue(galleryId) {
      if (!modalQueues[galleryId]) {
        modalQueues[galleryId] = [];
      }
      return modalQueues[galleryId];
    }

    function setupModalDragDrop(galleryId) {
      const dropArea = document.getElementById('dropArea_' + galleryId);
      if (!dropArea || dropArea.dataset.dragInit) return;
      dropArea.dataset.dragInit = 'true';

      ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, (e) => {
          e.preventDefault();
          e.stopPropagation();
          dropArea.classList.add('dragover');
        }, false);
      });

      ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, (e) => {
          e.preventDefault();
          e.stopPropagation();
          dropArea.classList.remove('dragover');
        }, false);
      });

      dropArea.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        if (dt && dt.files && dt.files.length > 0) {
          handleModalFilesSelected(galleryId, dt.files);
        }
      });
    }

    function handleModalFilesSelected(galleryId, files) {
      if (!files || files.length === 0) return;
      const queue = getQueue(galleryId);
      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        if (file.type.startsWith('image/')) {
          queue.push(file);
        }
      }
      renderModalQueue(galleryId);
    }

    function renderModalQueue(galleryId) {
      const queue = getQueue(galleryId);
      const container = document.getElementById('queueCardContainer_' + galleryId);
      const list = document.getElementById('queueListEl_' + galleryId);
      const countBadge = document.getElementById('queueCountBadge_' + galleryId);
      const sizeText = document.getElementById('queueSizeText_' + galleryId);
      const startBtn = document.getElementById('uploadStartBtn_' + galleryId);

      if (queue.length === 0) {
        if (container) container.classList.add('d-none');
        if (startBtn) startBtn.disabled = true;
        return;
      }

      if (container) container.classList.remove('d-none');
      if (startBtn) startBtn.disabled = false;
      if (countBadge) countBadge.textContent = `${queue.length} photo${queue.length > 1 ? 's' : ''}`;

      let totalBytes = 0;
      queue.forEach(f => totalBytes += f.size);
      const totalMb = (totalBytes / (1024 * 1024)).toFixed(1);
      if (sizeText) sizeText.textContent = `· Total ${totalMb} MB`;

      if (list) {
        list.innerHTML = '';
        const showLimit = Math.min(queue.length, 25);
        for (let index = 0; index < showLimit; index++) {
          const file = queue[index];
          const item = document.createElement('div');
          item.className = 'queue-clean-item';
          const sizeMb = (file.size / (1024 * 1024)).toFixed(2);
          const thumbUrl = URL.createObjectURL(file);

          item.innerHTML = `
            <img src="${thumbUrl}" class="queue-clean-thumb" alt="Preview">
            <div class="flex-grow-1 min-w-0">
              <div class="fw-bold text-dark text-truncate small" title="${file.name}">${file.name}</div>
              <div class="text-muted small" style="font-size: 0.75rem;">
                <span>${sizeMb} MB</span> · <span class="badge bg-light text-secondary border">Ready</span>
              </div>
            </div>
            <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="removeModalQueueItem(${galleryId}, ${index})">
              <i class="bi bi-x-circle fs-5"></i>
            </button>
          `;
          list.appendChild(item);
        }
        if (queue.length > showLimit) {
          const moreNote = document.createElement('div');
          moreNote.className = 'text-center text-muted small py-2';
          moreNote.textContent = `...and ${queue.length - showLimit} more photos queued for upload`;
          list.appendChild(moreNote);
        }
      }
    }

    function removeModalQueueItem(galleryId, index) {
      const queue = getQueue(galleryId);
      queue.splice(index, 1);
      renderModalQueue(galleryId);
    }

    function clearModalQueue(galleryId) {
      modalQueues[galleryId] = [];
      const fileInput = document.getElementById('photosInput_' + galleryId);
      if (fileInput) fileInput.value = '';
      renderModalQueue(galleryId);
    }

    function openUploadTab(galleryId) {
      const modalEl = document.getElementById('galleryManageModal_' + galleryId);
      if (!modalEl) return;
      setupModalDragDrop(galleryId);
      const uploadTabBtn = modalEl.querySelector('[data-bs-target="#tabUpload_' + galleryId + '"]');
      if (uploadTabBtn) {
        if (typeof bootstrap !== 'undefined' && bootstrap.Tab) {
          bootstrap.Tab.getOrCreateInstance(uploadTabBtn).show();
        } else {
          uploadTabBtn.click();
        }
      }
      if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
        bootstrap.Modal.getOrCreateInstance(modalEl).show();
      }
    }

    function openPhotosTab(galleryId) {
      const modalEl = document.getElementById('galleryManageModal_' + galleryId);
      if (!modalEl) return;
      const photosTabBtn = modalEl.querySelector('[data-bs-target="#tabPhotos_' + galleryId + '"]');
      if (photosTabBtn) {
        if (typeof bootstrap !== 'undefined' && bootstrap.Tab) {
          bootstrap.Tab.getOrCreateInstance(photosTabBtn).show();
        } else {
          photosTabBtn.click();
        }
      }
      if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
        bootstrap.Modal.getOrCreateInstance(modalEl).show();
      }
    }

    function openPricingModal(galleryId) {
      const modalEl = document.getElementById('pricingModal_' + galleryId);
      if (!modalEl) return;
      if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
        bootstrap.Modal.getOrCreateInstance(modalEl).show();
      }
    }

    function startModalBatchUpload(galleryId) {
      const queue = getQueue(galleryId);
      if (!queue || queue.length === 0) {
        alert('Please drag and drop or browse photos first.');
        return;
      }

      const startBtn = document.getElementById('uploadStartBtn_' + galleryId);
      const progressBox = document.getElementById('uploadProgressBox_' + galleryId);
      const titleText = document.getElementById('progressStatusTitle_' + galleryId);
      const percentText = document.getElementById('progressPercentText_' + galleryId);
      const fill = document.getElementById('progressBarFill_' + galleryId);
      const loadedText = document.getElementById('progressLoadedText_' + galleryId);
      const countText = document.getElementById('progressPhotosCountText_' + galleryId);
      const fileInput = document.getElementById('photosInput_' + galleryId);

      const totalFiles = queue.length;
      const batchSize = 15;
      const totalBatches = Math.ceil(totalFiles / batchSize);
      const csrfMeta = document.querySelector('meta[name="csrf-token"]');
      const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '{{ csrf_token() }}';

      startBtn.disabled = true;
      startBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Uploading...';
      if (fileInput) fileInput.disabled = true;
      progressBox.classList.remove('d-none');

      let uploadedSoFar = 0;

      function uploadBatch(startIndex) {
        if (startIndex >= totalFiles) {
          fill.style.width = '100%';
          percentText.textContent = '100%';
          titleText.innerHTML = '<i class="bi bi-check2-circle text-success me-1"></i> All ' + totalFiles + ' photos uploaded &amp; watermarked!';
          countText.textContent = `${totalFiles} / ${totalFiles} photos completed`;
          setTimeout(() => {
            window.location.reload();
          }, 800);
          return;
        }

        const endIndex = Math.min(startIndex + batchSize, totalFiles);
        const batchFiles = queue.slice(startIndex, endIndex);
        const batchNum = Math.floor(startIndex / batchSize) + 1;

        titleText.textContent = `Uploading batch ${batchNum} of ${totalBatches} (${startIndex + 1}–${endIndex} of ${totalFiles} photos)...`;
        countText.textContent = `${uploadedSoFar} / ${totalFiles} photos completed`;

        const formData = new FormData();
        formData.append('_token', csrfToken);
        batchFiles.forEach(f => {
          formData.append('photos[]', f);
        });

        const xhr = new XMLHttpRequest();
        xhr.open('POST', `/photographer-gallery/${galleryId}/upload-photos`, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('Accept', 'application/json');

        xhr.upload.onprogress = function(evt) {
          if (evt.lengthComputable) {
            const frac = evt.loaded / evt.total;
            const currentTotalUploaded = startIndex + (batchFiles.length * frac);
            const pct = Math.min(98, Math.round((currentTotalUploaded / totalFiles) * 100));
            fill.style.width = pct + '%';
            percentText.textContent = pct + '%';

            const bLoadedMb = (evt.loaded / (1024 * 1024)).toFixed(1);
            const bTotalMb = (evt.total / (1024 * 1024)).toFixed(1);
            loadedText.textContent = `Batch ${batchNum}: ${bLoadedMb} MB of ${bTotalMb} MB uploaded`;
          }
        };

        xhr.onload = function() {
          if (xhr.status >= 200 && xhr.status < 400) {
            uploadedSoFar = endIndex;
            const donePct = Math.round((uploadedSoFar / totalFiles) * 100);
            fill.style.width = donePct + '%';
            percentText.textContent = donePct + '%';
            uploadBatch(endIndex);
          } else {
            startBtn.disabled = false;
            if (fileInput) fileInput.disabled = false;
            startBtn.innerHTML = '<i class="bi bi-arrow-repeat me-1"></i> Resume Upload';
            let errDetail = 'HTTP ' + xhr.status;
            try {
              const errRes = JSON.parse(xhr.responseText);
              if (errRes.message) errDetail = errRes.message;
            } catch(e) {}
            alert(`Upload error on batch ${batchNum} (${errDetail}). ${uploadedSoFar} photos were saved. You can upload the remaining photos anytime.`);
          }
        };

        xhr.onerror = function() {
          startBtn.disabled = false;
          if (fileInput) fileInput.disabled = false;
          startBtn.innerHTML = '<i class="bi bi-arrow-repeat me-1"></i> Resume Upload';
          alert(`Network connection error on batch ${batchNum}. ${uploadedSoFar} photos were saved. Please check your connection and resume.`);
        };

        xhr.send(formData);
      }

      uploadBatch(0);
    }

    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('[id^="dropArea_"]').forEach(el => {
        const gid = el.id.replace('dropArea_', '');
        setupModalDragDrop(gid);
      });
    });
  </script>
</body>
</html>
