<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="PhotoX photographer create event and batch upload page.">
  <title>PhotoX | Create Event &amp; Upload Gallery</title>
  <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
  <script defer src="{{ asset('site-ad.js') }}"></script>

  <style>
    /* Clean Light Theme for Photographer Upload (Matching Customer Dashboard & ZebraSnap) */
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
    .clean-panel {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 16px;
      box-shadow: 0 4px 16px rgba(11, 45, 91, 0.05);
      padding: 28px;
      margin-bottom: 24px;
      transition: box-shadow 0.2s ease;
    }
    .clean-panel:hover {
      box-shadow: 0 8px 24px rgba(11, 45, 91, 0.08);
    }
    .section-heading-clean {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 22px;
      padding-bottom: 14px;
      border-bottom: 1px solid #f1f5f9;
    }
    .section-heading-clean h3 {
      margin: 0;
      color: #0b2d5b;
      font-size: 1.15rem;
      font-weight: 700;
    }
    .badge-step {
      font-size: 0.75rem;
      padding: 4px 12px;
      background: rgba(255, 138, 0, 0.12);
      color: #d97706;
      border: 1px solid rgba(255, 138, 0, 0.25);
      border-radius: 20px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    .form-label-clean {
      font-size: 0.82rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.4px;
      color: #475569;
      margin-bottom: 6px;
    }
    .form-control-clean, .form-select-clean {
      border: 1px solid #cbd5e1;
      border-radius: 10px;
      padding: 10px 14px;
      font-size: 0.92rem;
      color: #0b2d5b;
      background-color: #ffffff;
      transition: all 0.2s ease;
    }
    .form-control-clean:focus, .form-select-clean:focus {
      border-color: #ff8a00;
      box-shadow: 0 0 0 3px rgba(255, 138, 0, 0.15);
      outline: none;
    }
    /* Drag & Drop Upload Zone */
    .drop-clean-box {
      border: 2px dashed #94a3b8;
      background: #f8fafc;
      border-radius: 14px;
      padding: 36px 20px;
      text-align: center;
      cursor: pointer;
      transition: all 0.25s ease;
    }
    .drop-clean-box:hover, .drop-clean-box.dragover {
      background: #fff8f0;
      border-color: #ff8a00;
      transform: translateY(-2px);
    }
    .drop-clean-box i {
      font-size: 42px;
      color: #ff8a00;
      display: block;
      margin-bottom: 8px;
    }
    /* Queue card & items */
    .queue-clean-card {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      padding: 16px;
      margin-top: 16px;
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
    /* Progress Box */
    .progress-clean-box {
      background: #ffffff;
      border: 1px solid #ff8a00;
      border-radius: 12px;
      padding: 18px 22px;
      margin-top: 18px;
      box-shadow: 0 4px 16px rgba(255, 138, 0, 0.12);
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
    .btn-create-submit {
      background: #ff8a00;
      color: #ffffff;
      font-weight: 700;
      border: none;
      border-radius: 50rem;
      padding: 12px 36px;
      font-size: 0.95rem;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.2s ease;
      box-shadow: 0 4px 14px rgba(255, 138, 0, 0.25);
    }
    .btn-create-submit:hover {
      background: #e67c00;
      color: #ffffff;
      transform: translateY(-1px);
      box-shadow: 0 6px 18px rgba(255, 138, 0, 0.35);
    }
  </style>
</head>
<body class="customer-app dashboard-page photographer-dashboard-page page-photographer-dashboard">
  <!-- Top Navigation -->
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
          <a class="header-cart text-dark" href="/cart" aria-label="Open cart"><i class="bi bi-cart3 fs-5"></i></a>
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
        <span class="text-uppercase fw-bold text-primary small d-block mb-1">PHOTOGRAPHER WORKSPACE</span>
        <h1 class="h3 fw-bold text-dark">Frame the<br><em>moment.</em></h1>
      </div>
      <nav class="workspace-nav d-flex flex-column gap-1 mb-4">
        <a class="workspace-nav-link text-decoration-none px-3 py-2 rounded-3 text-secondary d-flex align-items-center gap-2" href="/photographer-dashboard"><i class="bi bi-grid-1x2"></i><span>Overview</span></a>
        <a class="workspace-nav-link text-decoration-none px-3 py-2 rounded-3 text-secondary d-flex align-items-center gap-2" href="/photographer-bookings"><i class="bi bi-calendar-event"></i><span>Events</span></a>
        <a class="workspace-nav-link active text-decoration-none px-3 py-2 rounded-3 bg-white text-primary fw-bold shadow-sm d-flex align-items-center gap-2" href="/photographer-gallery"><i class="bi bi-images text-warning"></i><span>Gallery</span></a>
        <a class="workspace-nav-link text-decoration-none px-3 py-2 rounded-3 text-secondary d-flex align-items-center gap-2" href="{{ route('photographer.watermark') }}"><i class="bi bi-shield-lock"></i><span>Watermark Studio</span></a>
        <a class="workspace-nav-link text-decoration-none px-3 py-2 rounded-3 text-secondary d-flex align-items-center gap-2" href="/photographer-earnings"><i class="bi bi-wallet2"></i><span>Earnings</span></a>
        <a class="workspace-nav-link text-decoration-none px-3 py-2 rounded-3 text-secondary d-flex align-items-center gap-2" href="/photographer-payouts"><i class="bi bi-bank"></i><span>Payouts &amp; Bank</span></a>
        <a class="workspace-nav-link text-decoration-none px-3 py-2 rounded-3 text-secondary d-flex align-items-center gap-2" href="/photographer-profile"><i class="bi bi-person-circle"></i><span>Profile</span></a>
      </nav>
      <div class="p-3 bg-white rounded-3 border mb-3 shadow-sm">
        <div class="d-flex gap-2 align-items-center text-dark">
          <i class="bi bi-shield-check text-success fs-5"></i>
          <div>
            <strong class="d-block small">Coverage Secured</strong>
            <span class="text-muted" style="font-size: 0.78rem;">Watermarks auto-applied on upload.</span>
          </div>
        </div>
      </div>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-sm btn-link text-secondary text-decoration-none p-0"><i class="bi bi-box-arrow-left me-1"></i> Sign out</button>
      </form>
    </aside>

    <!-- Main Upload Workspace Content -->
    <section class="workspace-content">
      <!-- Breadcrumb & Header -->
      <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <div class="d-flex align-items-center gap-2 text-muted small">
          <a href="/photographer-dashboard" class="text-decoration-none text-muted">Photographer</a>
          <i class="bi bi-chevron-right" style="font-size: 10px;"></i>
          <a href="/photographer-gallery" class="text-decoration-none text-muted">Galleries</a>
          <i class="bi bi-chevron-right" style="font-size: 10px;"></i>
          <strong class="text-dark">Create Album &amp; Upload</strong>
        </div>
        <a class="btn btn-outline-secondary rounded-pill px-3 py-1 btn-sm" href="/photographer-gallery">
          <i class="bi bi-arrow-left me-1"></i> Back to galleries
        </a>
      </div>

      <div class="mb-4">
        <span class="text-uppercase fw-bold text-primary small" style="letter-spacing: 1px;">ZEBRASNAP ALBUM SETUP</span>
        <h2 class="h3 fw-bold text-dark mb-1">Create Event &amp; Upload Photos</h2>
        <p class="text-muted small mb-0">Set up album pricing, privacy locks, photographer notes, and upload full-resolution photos with live watermarking.</p>
      </div>

      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm" role="alert">
          <i class="bi bi-check-circle-fill me-2 text-success"></i>{{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if(isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4 shadow-sm" role="alert">
          <i class="bi bi-exclamation-triangle-fill me-2 text-danger"></i>
          <strong>Please check the following errors:</strong>
          <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <!-- Creation Form -->
      <form id="createEventForm" action="{{ route('photographer.upload.store') }}" method="POST" enctype="multipart/form-data" onsubmit="handleFormSubmit(event)">
        @csrf

        <!-- STEP 1: Album Details & Basic Info -->
        <section class="clean-panel">
          <div class="section-heading-clean">
            <div>
              <span class="text-uppercase fw-bold text-muted small d-block">Step 1 / 3</span>
              <h3>Album Details &amp; Base Pricing</h3>
            </div>
            <span class="badge-step">Required</span>
          </div>

          <div class="row g-3">
            <div class="col-md-8">
              <label class="form-label-clean" for="event-title">Album Name / Event Title <span class="text-danger">*</span></label>
              <input class="form-control form-control-clean" id="event-title" name="title" value="{{ old('title', old('album_name')) }}" placeholder="e.g. Maties vs Ikeys Derby or Stellenbosch Spring Run" required>
            </div>

            <div class="col-md-4">
              <label class="form-label-clean" for="category-id">Sport / Category <span class="text-danger">*</span></label>
              <select class="form-select form-select-clean" id="category-id" name="category_id" required>
                <option value="">Select sport category...</option>
                @foreach($categories as $cat)
                  <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label-clean" for="location">Location / Venue <span class="text-danger">*</span></label>
              <input class="form-control form-control-clean" id="location" name="location" value="{{ old('location', $photographer->location ?? 'Cape Town, South Africa') }}" placeholder="e.g. Green Point Stadium, Cape Town" required>
            </div>

            <div class="col-md-6">
              <label class="form-label-clean" for="event_date">Event Date</label>
              <input class="form-control form-control-clean" id="event_date" name="event_date" type="date" value="{{ old('event_date', date('Y-m-d')) }}">
            </div>

            <!-- Licensing Pricing Controls -->
            <div class="col-md-6">
              <label class="form-label-clean" for="personal_price">Price Per Photo (Personal License ZAR) <span class="text-danger">*</span></label>
              <div class="input-group">
                <span class="input-group-text bg-light fw-bold border-end-0">R</span>
                <input class="form-control form-control-clean" id="personal_price" name="personal_price" type="number" step="0.50" min="5" value="{{ old('personal_price', old('starting_price', '75.00')) }}" placeholder="75.00" required>
              </div>
              <small class="text-muted" style="font-size: 0.75rem;">Price athletes and parents pay for personal downloads</small>
            </div>

            <div class="col-md-6">
              <label class="form-label-clean" for="commercial_price">Price Per Photo (Commercial License ZAR)</label>
              <div class="input-group">
                <span class="input-group-text bg-light fw-bold border-end-0">R</span>
                <input class="form-control form-control-clean" id="commercial_price" name="commercial_price" type="number" step="1.00" min="20" value="{{ old('commercial_price', '185.00') }}" placeholder="185.00">
              </div>
              <small class="text-muted" style="font-size: 0.75rem;">Price corporate sponsors pay for advertising usage</small>
            </div>

            <div class="col-12">
              <label class="form-label-clean" for="description">Album Description</label>
              <textarea class="form-control form-control-clean" id="description" name="description" placeholder="Add highlights, distance, event atmosphere, or venue notes..." rows="2">{{ old('description', old('caption')) }}</textarea>
            </div>
          </div>
        </section>

        <!-- STEP 2: Multi-Photo Queue & Batch Dropzone -->
        <section class="clean-panel">
          <div class="section-heading-clean">
            <div>
              <span class="text-uppercase fw-bold text-muted small d-block">Step 2 / 3</span>
              <h3>Photo Queue &amp; Multi-Photo Upload</h3>
            </div>
            <span class="badge-step">Batch Upload</span>
          </div>

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label-clean" for="status">Album Visibility</label>
              <select class="form-select form-select-clean" id="status" name="status">
                <option value="published" {{ old('status', 'published') === 'published' ? 'selected' : '' }}>Published (Live on website immediately)</option>
                <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft (Private - upload &amp; organize first)</option>
              </select>
            </div>

            <div class="col-md-6 d-flex align-items-center pt-md-4">
              <div class="small text-muted">
                <i class="bi bi-shield-lock-fill text-warning me-1"></i>
                Proofs will be stamped automatically using your Watermark Studio configuration.
              </div>
            </div>

            <!-- Drag & Drop Zone -->
            <div class="col-12 mt-3">
              <div class="drop-clean-box" id="dropArea" onclick="document.getElementById('galleryPhotosInput').click();">
                <i class="bi bi-cloud-arrow-up"></i>
                <h5 class="fw-bold text-dark mb-1">Drag &amp; Drop multiple photos here</h5>
                <p class="text-muted small mb-3">Support for JPG, PNG, and WebP (select 10, 50, or 100+ photos at once)</p>
                <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-4 text-dark fw-bold">
                  <i class="bi bi-folder2-open me-1"></i> Browse Files from Computer
                </button>
              </div>
              <input type="file" id="galleryPhotosInput" multiple accept="image/*" class="d-none" onchange="handleFilesSelected(this.files)">
            </div>

            <!-- Queue Display (Revealed when files picked) -->
            <div class="col-12 d-none" id="queueCardContainer">
              <div class="queue-clean-card">
                <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                  <div class="d-flex align-items-center gap-2">
                    <span class="fw-bold text-dark fs-6">
                      <i class="bi bi-collection-play text-warning me-1"></i> Selected Queue:
                    </span>
                    <span class="badge bg-primary rounded-pill" id="queueCountBadge">0 photos</span>
                    <span class="text-muted small" id="queueSizeText">· 0 MB</span>
                  </div>
                  <button type="button" class="btn btn-sm btn-link text-danger text-decoration-none p-0 fw-semibold" onclick="clearAllQueue()">
                    <i class="bi bi-trash3 me-1"></i> Clear all
                  </button>
                </div>

                <div class="queue-list" id="queueListEl" style="max-height: 280px; overflow-y: auto;">
                  <!-- Injected dynamically -->
                </div>
              </div>
            </div>

            <!-- Live Upload Progress Bar Container -->
            <div class="col-12 d-none" id="uploadProgressBox">
              <div class="progress-clean-box">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <div class="d-flex align-items-center gap-2">
                    <span class="spinner-border spinner-border-sm text-warning" role="status"></span>
                    <strong class="text-dark" id="progressStatusTitle">Uploading photos...</strong>
                  </div>
                  <span class="text-warning fw-bold font-monospace fs-5" id="progressPercentText">0%</span>
                </div>

                <div class="progress-bar-custom">
                  <div class="progress-bar-fill-custom" id="progressBarFill"></div>
                </div>

                <div class="d-flex justify-content-between align-items-center text-muted small mt-1">
                  <span id="progressLoadedText">0 MB / 0 MB uploaded</span>
                  <span id="progressPhotosCountText">0 / 0 photos</span>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- STEP 3: ZebraSnap Extra Settings & Toggles -->
        <section class="clean-panel">
          <div class="section-heading-clean">
            <div>
              <span class="text-uppercase fw-bold text-muted small d-block">Step 3 / 3</span>
              <h3>Extra Settings &amp; Privacy Toggles (ZebraSnap)</h3>
            </div>
            <span class="badge bg-light text-dark border">Settings</span>
          </div>

          <!-- Toggle 1: Password-protected album -->
          <div class="p-3 bg-light rounded-3 border mb-3">
            <div class="form-check form-switch mb-1">
              <input class="form-check-input" type="checkbox" name="is_password_protected" id="togglePasswordProtect" value="1" {{ old('is_password_protected') ? 'checked' : '' }} onchange="document.getElementById('passwordInputWrapper').classList.toggle('d-none', !this.checked);">
              <label class="form-check-label fw-bold text-dark" for="togglePasswordProtect">
                <i class="bi bi-lock-fill text-primary me-1"></i> Password-protected album
              </label>
            </div>
            <p class="text-muted small mb-0 ms-4">Require visitors to enter an access password before viewing and purchasing photos.</p>

            <div class="{{ old('is_password_protected') ? '' : 'd-none' }} mt-3 ms-4" id="passwordInputWrapper">
              <label class="form-label-clean" for="access_password">Event Access Password</label>
              <input type="text" class="form-control form-control-clean" style="max-width: 320px;" id="access_password" name="access_password" value="{{ old('access_password') }}" placeholder="e.g. Derby2026 or SecretPass">
            </div>
          </div>

          <!-- Toggle 2: Photographer's notes -->
          <div class="p-3 bg-light rounded-3 border mb-3">
            <div class="form-check form-switch mb-1">
              <input class="form-check-input" type="checkbox" id="togglePhotographerNotes" onchange="document.getElementById('notesInputWrapper').classList.toggle('d-none', !this.checked);" {{ old('photographer_notes') ? 'checked' : '' }}>
              <label class="form-check-label fw-bold text-dark" for="togglePhotographerNotes">
                <i class="bi bi-chat-left-text-fill text-warning me-1"></i> Photographer's notes
              </label>
            </div>
            <p class="text-muted small mb-0 ms-4">Add a custom message, delivery instructions, or thank-you note shown prominently on this album's public page.</p>

            <div class="{{ old('photographer_notes') ? '' : 'd-none' }} mt-3 ms-4" id="notesInputWrapper">
              <label class="form-label-clean" for="photographer_notes">Notes / Instructions for visitors</label>
              <textarea class="form-control form-control-clean" id="photographer_notes" name="photographer_notes" rows="3" placeholder="e.g. Thank you for attending! High-resolution files without watermark are delivered immediately after checkout.">{{ old('photographer_notes') }}</textarea>
            </div>
          </div>

          <!-- Toggle 3: Show only each person's photos (Privacy mode) -->
          <div class="p-3 bg-light rounded-3 border mb-3">
            <div class="form-check form-switch mb-1">
              <input class="form-check-input" type="checkbox" name="privacy_mode" id="togglePrivacyMode" value="1" {{ old('privacy_mode') ? 'checked' : '' }}>
              <label class="form-check-label fw-bold text-dark" for="togglePrivacyMode">
                <i class="bi bi-eye-slash-fill text-success me-1"></i> Show only each person's photos
              </label>
            </div>
            <p class="text-muted small mb-0 ms-4">When enabled, visitors only see the photos they were tagged in or matched with via selfie / bib search.</p>
          </div>

          <!-- Bundle Pricing Options (Optional) -->
          <div class="p-3 bg-light rounded-3 border">
            <label class="form-label-clean mb-2 d-block"><i class="bi bi-box-seam-fill text-warning me-1"></i> Package Bundle Pricing (Optional)</label>
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label text-muted small fw-bold">Selfie Bundle Price (ZAR)</label>
                <div class="input-group">
                  <span class="input-group-text bg-white fw-bold border-end-0">R</span>
                  <input type="number" step="1.00" min="0" name="selfie_bundle_price" class="form-control form-control-clean" value="{{ old('selfie_bundle_price', '250.00') }}" placeholder="250.00">
                </div>
                <small class="text-muted" style="font-size: 0.72rem;">Leave empty if not offering a selfie bundle</small>
              </div>

              <div class="col-sm-6">
                <label class="form-label text-muted small fw-bold">Complete Gallery Price (ZAR)</label>
                <div class="input-group">
                  <span class="input-group-text bg-white fw-bold border-end-0">R</span>
                  <input type="number" step="1.00" min="0" name="full_gallery_price" class="form-control form-control-clean" value="{{ old('full_gallery_price', '450.00') }}" placeholder="450.00">
                </div>
                <small class="text-muted" style="font-size: 0.72rem;">Download access to all photos in this gallery</small>
              </div>
            </div>
          </div>
        </section>

        <!-- Hidden input for selected cover photo index from queue -->
        <input type="hidden" name="cover_queue_index" id="coverQueueIndex" value="-1">

        <!-- Form Actions -->
        <div class="d-flex justify-content-end align-items-center gap-3 mt-4 mb-5">
          <a class="btn btn-outline-secondary rounded-pill px-4" href="/photographer-gallery">Cancel</a>
          <button class="btn btn-create-submit" id="submitBtn" type="submit">
            <i class="bi bi-cloud-arrow-up-fill"></i> Create &amp; Upload Album
          </button>
        </div>
      </form>
    </section>
  </main>

  @include('web.partials.footer')

  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script>
    // State management for uploaded files
    let fileQueue = [];
    let selectedCoverIndex = -1;

    // Drag and drop event listeners
    const dropArea = document.getElementById('dropArea');
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
        handleFilesSelected(dt.files);
      }
    });

    function handleFilesSelected(files) {
      if (!files || files.length === 0) return;

      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        if (file.type.startsWith('image/')) {
          fileQueue.push(file);
        }
      }

      renderQueue();
    }

    function renderQueue() {
      const container = document.getElementById('queueCardContainer');
      const list = document.getElementById('queueListEl');
      const countBadge = document.getElementById('queueCountBadge');
      const sizeText = document.getElementById('queueSizeText');

      if (fileQueue.length === 0) {
        container.classList.add('d-none');
        return;
      }

      container.classList.remove('d-none');
      countBadge.textContent = `${fileQueue.length} photo${fileQueue.length > 1 ? 's' : ''}`;

      let totalBytes = 0;
      fileQueue.forEach(f => totalBytes += f.size);
      const totalMb = (totalBytes / (1024 * 1024)).toFixed(1);
      sizeText.textContent = `· Total ${totalMb} MB`;

      list.innerHTML = '';
      fileQueue.forEach((file, index) => {
        const item = document.createElement('div');
        item.className = 'queue-clean-item';

        const sizeMb = (file.size / (1024 * 1024)).toFixed(2);
        const thumbUrl = URL.createObjectURL(file);
        const isCover = (selectedCoverIndex === index);

        item.innerHTML = `
          <img src="${thumbUrl}" class="queue-clean-thumb" alt="Preview">
          <div class="flex-grow-1 min-w-0">
            <div class="fw-bold text-dark text-truncate small" title="${file.name}">${file.name}</div>
            <div class="text-muted small" style="font-size: 0.75rem;">
              <span>${sizeMb} MB</span> · 
              <span class="badge ${isCover ? 'bg-warning text-dark' : 'bg-light text-secondary border'}">
                ${isCover ? 'Cover Photo' : 'Watermark Ready'}
              </span>
            </div>
          </div>
          <div class="d-flex align-items-center gap-2">
            <button type="button" class="btn btn-sm ${isCover ? 'btn-warning text-dark' : 'btn-outline-secondary'} rounded-pill px-2 py-0" style="font-size: 0.72rem;" onclick="setAsCover(${index})">
              <i class="bi bi-star${isCover ? '-fill' : ''}"></i> ${isCover ? 'Cover' : 'Set Cover'}
            </button>
            <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="removeFromQueue(${index})">
              <i class="bi bi-x-circle fs-5"></i>
            </button>
          </div>
        `;

        list.appendChild(item);
      });
    }

    function setAsCover(index) {
      selectedCoverIndex = index;
      document.getElementById('coverQueueIndex').value = index;
      renderQueue();
    }

    function removeFromQueue(index) {
      if (selectedCoverIndex === index) {
        selectedCoverIndex = -1;
        document.getElementById('coverQueueIndex').value = -1;
      } else if (selectedCoverIndex > index) {
        selectedCoverIndex--;
        document.getElementById('coverQueueIndex').value = selectedCoverIndex;
      }
      fileQueue.splice(index, 1);
      renderQueue();
    }

    function clearAllQueue() {
      fileQueue = [];
      selectedCoverIndex = -1;
      document.getElementById('coverQueueIndex').value = -1;
      renderQueue();
    }

    function handleFormSubmit(e) {
      e.preventDefault();

      const form = document.getElementById('createEventForm');
      const submitBtn = document.getElementById('submitBtn');
      const progressBox = document.getElementById('uploadProgressBox');
      const fill = document.getElementById('progressBarFill');
      const percentText = document.getElementById('progressPercentText');
      const titleText = document.getElementById('progressStatusTitle');
      const loadedText = document.getElementById('progressLoadedText');
      const countText = document.getElementById('progressPhotosCountText');

      const titleInput = document.getElementById('event-title');
      const categoryInput = document.getElementById('category-id');
      const locationInput = document.getElementById('location');

      if (!titleInput.value.trim() || !categoryInput.value || !locationInput.value.trim()) {
        alert('Please fill out all required fields: Event name, Category, and Location.');
        return;
      }

      const totalFiles = fileQueue.length;
      const batchSize = 15;
      const csrfMeta = document.querySelector('meta[name="csrf-token"]');
      const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '{{ csrf_token() }}';

      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Uploading &amp; Processing...';
      progressBox.classList.remove('d-none');

      // Step 1: Initial event creation with first batch of up to 15 photos
      const initialBatch = fileQueue.slice(0, batchSize);
      const formData = new FormData(form);
      formData.delete('photos[]');

      initialBatch.forEach((file) => {
        formData.append('photos[]', file);
      });

      if (selectedCoverIndex >= 0 && fileQueue[selectedCoverIndex]) {
        formData.set('cover_file', fileQueue[selectedCoverIndex]);
      }

      const totalBatches = Math.max(1, Math.ceil(totalFiles / batchSize));
      titleText.textContent = totalFiles > 0 
        ? `Uploading batch 1 of ${totalBatches} (${Math.min(initialBatch.length, totalFiles)} of ${totalFiles} photos)...`
        : 'Creating album details...';
      countText.textContent = `${initialBatch.length} / ${totalFiles} photos queued`;

      const xhr = new XMLHttpRequest();
      xhr.open('POST', form.action, true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      xhr.setRequestHeader('Accept', 'application/json');

      xhr.upload.onprogress = function(event) {
        if (event.lengthComputable) {
          const batchFraction = event.loaded / event.total;
          const currentUploaded = (initialBatch.length * batchFraction);
          const percent = totalFiles > 0 ? Math.min(95, Math.round((currentUploaded / totalFiles) * 100)) : 100;
          fill.style.width = percent + '%';
          percentText.textContent = percent + '%';

          const loadedMb = (event.loaded / (1024 * 1024)).toFixed(1);
          const totalMb = (event.total / (1024 * 1024)).toFixed(1);
          loadedText.textContent = `Batch 1: ${loadedMb} MB of ${totalMb} MB uploaded`;
        }
      };

      xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 400) {
          let res = {};
          try {
            res = JSON.parse(xhr.responseText);
          } catch(err) {
            res = {};
          }

          const eventId = res.event_id;
          let uploadedSoFar = initialBatch.length;

          // If all files uploaded in first batch or no more files, wrap up
          if (uploadedSoFar >= totalFiles || !eventId) {
            fill.style.width = '100%';
            percentText.textContent = '100%';
            titleText.innerHTML = '<i class="bi bi-check2-circle text-success me-1"></i> Album Created &amp; Photos Watermarked!';
            countText.textContent = `${totalFiles} / ${totalFiles} photos completed`;
            setTimeout(() => {
              window.location.href = res.redirect || '/photographer-gallery';
            }, 600);
            return;
          }

          // Step 2: Upload remaining files in batches of 15 (matching Superadmin chunking loop)
          const personalPriceVal = document.getElementById('personal-price') ? document.getElementById('personal-price').value : '';
          const commercialPriceVal = document.getElementById('commercial-price') ? document.getElementById('commercial-price').value : '';

          function uploadBatch(startIndex) {
            if (startIndex >= totalFiles) {
              fill.style.width = '100%';
              percentText.textContent = '100%';
              titleText.innerHTML = '<i class="bi bi-check2-circle text-success me-1"></i> All ' + totalFiles + ' photos uploaded &amp; watermarked!';
              countText.textContent = `${totalFiles} / ${totalFiles} photos completed`;
              setTimeout(() => {
                window.location.href = res.redirect || '/photographer-gallery';
              }, 700);
              return;
            }

            const endIndex = Math.min(startIndex + batchSize, totalFiles);
            const batchFiles = fileQueue.slice(startIndex, endIndex);
            const batchNum = Math.floor(startIndex / batchSize) + 1;

            titleText.textContent = `Uploading batch ${batchNum} of ${totalBatches} (${startIndex + 1}–${endIndex} of ${totalFiles} photos)...`;
            countText.textContent = `${startIndex} / ${totalFiles} photos completed`;

            const batchForm = new FormData();
            batchForm.append('_token', csrfToken);
            if (personalPriceVal) batchForm.append('personal_price', personalPriceVal);
            if (commercialPriceVal) batchForm.append('commercial_price', commercialPriceVal);

            batchFiles.forEach(f => {
              batchForm.append('photos[]', f);
            });

            const batchXhr = new XMLHttpRequest();
            batchXhr.open('POST', `/photographer-gallery/${eventId}/upload-photos`, true);
            batchXhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            batchXhr.setRequestHeader('Accept', 'application/json');

            batchXhr.upload.onprogress = function(be) {
              if (be.lengthComputable) {
                const bFrac = be.loaded / be.total;
                const progressFiles = startIndex + (batchFiles.length * bFrac);
                const overallPct = Math.min(98, Math.round((progressFiles / totalFiles) * 100));
                fill.style.width = overallPct + '%';
                percentText.textContent = overallPct + '%';

                const bLoadedMb = (be.loaded / (1024 * 1024)).toFixed(1);
                const bTotalMb = (be.total / (1024 * 1024)).toFixed(1);
                loadedText.textContent = `Batch ${batchNum}: ${bLoadedMb} MB of ${bTotalMb} MB uploaded`;
              }
            };

            batchXhr.onload = function() {
              if (batchXhr.status >= 200 && batchXhr.status < 400) {
                uploadedSoFar = endIndex;
                const donePct = Math.round((uploadedSoFar / totalFiles) * 100);
                fill.style.width = donePct + '%';
                percentText.textContent = donePct + '%';
                uploadBatch(endIndex);
              } else {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="bi bi-cloud-arrow-up-fill"></i> Resume Upload';
                alert(`Upload error on batch ${batchNum} (Status ${batchXhr.status}). Your event was saved with ${uploadedSoFar} photos. You can upload the rest anytime from the gallery.`);
              }
            };

            batchXhr.onerror = function() {
              submitBtn.disabled = false;
              submitBtn.innerHTML = '<i class="bi bi-cloud-arrow-up-fill"></i> Resume Upload';
              alert(`Network error on batch ${batchNum}. Your event was saved with ${uploadedSoFar} photos. Please check your internet connection.`);
            };

            batchXhr.send(batchForm);
          }

          // Start uploading batch 2
          uploadBatch(batchSize);

        } else {
          submitBtn.disabled = false;
          submitBtn.innerHTML = '<i class="bi bi-cloud-arrow-up-fill"></i> Create &amp; Upload Album';
          progressBox.classList.add('d-none');
          alert('Upload error (Status ' + xhr.status + '). Please check form fields or file sizes.');
        }
      };

      xhr.onerror = function() {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="bi bi-cloud-arrow-up-fill"></i> Create &amp; Upload Album';
        progressBox.classList.add('d-none');
        alert('Network connection error while uploading. Please check your internet connection.');
      };

      xhr.send(formData);
    }
  </script>
</body>
</html>
