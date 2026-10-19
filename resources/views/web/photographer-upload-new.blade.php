<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="PhotoX photographer upload page.">
  <title>PhotoX | Upload new</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <script defer src="site-ad.js"></script>
  
</head>
<body class="page-photographer-upload-new">
  <nav aria-label="Main navigation" class="navbar navbar-expand-lg py-2">
    <div class="container-xl">
      <a class="navbar-brand d-flex align-items-center gap-2" href="/"><img alt="PhotoX" src="logo.png"></a>
      <button aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler border-0 p-0" data-bs-target="#mainNav" data-bs-toggle="collapse" type="button"><i class="bi bi-list fs-2"></i></button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav mx-auto gap-lg-3 mt-3 mt-lg-0">
          <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/events">Explore</a></li>
          <li class="nav-item"><a class="nav-link" href="/photographers">Photographers</a></li>
          <li class="nav-item"><a class="nav-link" href="/membership">Membership</a></li>
          <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
        </ul>
        <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
          <div class="header-search d-none d-xl-flex"><i class="bi bi-search"></i><input aria-label="Search" placeholder="Search gallery" type="search"></div>
          <a class="header-cart" href="/cart" aria-label="Open cart"><i class="bi bi-cart3"></i><span>0</span></a>
          <button class="icon-button notification-button" aria-label="Notifications"><i class="bi bi-bell"></i><span>3</span></button>
          <div class="account-menu">
            <button class="profile-trigger" aria-label="Open account menu"><span class="avatar">AD</span><span class="d-none d-sm-inline">Aiden Daniels</span><i class="bi bi-chevron-down"></i></button>
            <div class="account-dropdown" role="menu">
              <div class="account-dropdown-user"><span class="avatar">AD</span><div><strong>Aiden Daniels</strong><small>aiden@photosouth.com</small></div></div>
              <a href="/photographer-profile" role="menuitem"><i class="bi bi-person"></i> Profile & settings</a>
              <a href="/" role="menuitem"><i class="bi bi-box-arrow-left"></i> Log out</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <main class="container-xl photographer-shell">
    <aside class="photographer-sidebar" aria-label="Photographer navigation">
      <div class="workspace-greeting">
        <span class="eyebrow-blue">PHOTOGRAPHER WORKSPACE</span>
        <h1>Frame the<br><em>moment.</em></h1>
      </div>
      <nav class="workspace-nav">
        <a class="workspace-nav-link" href="/photographer-dashboard"><i class="bi bi-grid-1x2"></i><span>Overview</span></a>
        <a class="workspace-nav-link" href="/photographer-bookings"><i class="bi bi-calendar-event"></i><span>Events</span><b>12</b></a>
        <a class="workspace-nav-link active" href="/photographer-gallery"><i class="bi bi-images"></i><span>Gallery</span></a>
        <a class="workspace-nav-link" href="/photographer-earnings"><i class="bi bi-wallet2"></i><span>Earnings</span></a>
        <a class="workspace-nav-link" href="/photographer-payouts"><i class="bi bi-bank"></i><span>Payouts &amp; Bank</span></a>
        <a class="workspace-nav-link" href="/photographer-messages"><i class="bi bi-chat-left-text"></i><span>Messages</span></a>
        <a class="workspace-nav-link" href="/photographer-profile"><i class="bi bi-person-circle"></i><span>Profile</span></a>
      </nav>
      <div class="workspace-side-note"><i class="bi bi-shield-check"></i><div><strong>Coverage secured</strong><span>3 client galleries are still pending final delivery.</span></div></div>
      <a class="workspace-logout" href="/"><i class="bi bi-box-arrow-left"></i> Sign out</a>
    </aside>

    <section class="workspace-main">
      <div class="workspace-topbar">
        <div>
          <span class="eyebrow-blue">GALLERY</span>
          <h2>Upload new work</h2>
        </div>
        <a class="btn btn-outline-primary rounded-pill px-4" href="/photographer-gallery"><i class="bi bi-arrow-left me-2"></i>Back</a>
      </div>

      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
          <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
          <i class="bi bi-exclamation-triangle me-2"></i>{{ $errors->first() }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <form class="upload-card" action="{{ route('photographer.upload.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="upload-area" onclick="document.getElementById('galleryPhotosInput').click();" style="cursor: pointer;">
          <div>
            <i class="bi bi-cloud-arrow-up fs-1 text-primary"></i>
            <h4 class="mt-3 mb-2">Drop files here or click to browse</h4>
            <p class="mb-0 text-muted">PNG, JPG, WebP photos (drag multiple photos at once)</p>
            <div id="fileSelectedBadge" class="mt-2 badge bg-success fs-6 py-2 px-3 d-none">
              <i class="bi bi-check2-circle me-1"></i> <span id="fileCountText">0</span> files selected
            </div>
          </div>
          <input type="file" id="galleryPhotosInput" name="photos[]" multiple accept="image/*" class="d-none" onchange="handleFilesSelected(this)">
        </div>

        <div class="form-grid">
          <div>
            <label class="form-label" for="album_name">Album / Event name <span class="text-danger">*</span></label>
            <input class="form-control" id="album_name" name="album_name" type="text" placeholder="e.g. Cape Town Marathon 2026" required value="{{ old('album_name') }}">
          </div>
          <div>
            <label class="form-label" for="category">Category / Sport</label>
            @php
              $uploadCategories = \App\Models\Category::where('is_active', true)->orderBy('name')->get();
            @endphp
            <select class="form-select" id="category" name="category">
              @forelse($uploadCategories as $cat)
                <option value="{{ $cat->slug ?: $cat->name }}" {{ old('category') == ($cat->slug ?: $cat->name) ? 'selected' : '' }}>{{ $cat->name }}</option>
              @empty
                <option value="sports" selected>Sports</option>
                <option value="events">Events</option>
                <option value="schools">Schools</option>
              @endforelse
            </select>
          </div>
          <div>
            <label class="form-label" for="event_date">Event Date</label>
            <input class="form-control" id="event_date" name="event_date" type="date" value="{{ old('event_date', date('Y-m-d')) }}">
          </div>
          <div>
            <label class="form-label" for="location">Location / Venue</label>
            <input class="form-control" id="location" name="location" type="text" placeholder="e.g. Green Point Stadium, Cape Town" value="{{ old('location', $photographer->location ?? '') }}">
          </div>
          <div>
            <label class="form-label" for="starting_price">Single Photo Price (ZAR)</label>
            <div class="input-group">
              <span class="input-group-text">R</span>
              <input class="form-control" id="starting_price" name="starting_price" type="number" step="0.50" min="10" placeholder="75.00" value="{{ old('starting_price', '75.00') }}">
            </div>
          </div>
          <div class="full-span">
            <label class="form-label" for="caption">Description / Caption</label>
            <textarea class="form-control" id="caption" name="caption" rows="2" placeholder="Brief event description, highlights, crowd energy...">{{ old('caption') }}</textarea>
          </div>
        </div>

        <div class="actions">
          <a class="btn btn-outline-secondary rounded-pill px-4" href="{{ route('photographer.gallery') }}">Cancel</a>
          <button class="btn btn-lime rounded-pill px-4" type="submit"><i class="bi bi-cloud-arrow-up me-2"></i>Publish gallery</button>
        </div>
      </form>

      <script>
        function handleFilesSelected(input) {
          const badge = document.getElementById('fileSelectedBadge');
          const text = document.getElementById('fileCountText');
          if (input.files && input.files.length > 0) {
            text.textContent = input.files.length;
            badge.classList.remove('d-none');
          } else {
            badge.classList.add('d-none');
          }
        }
      </script>
    </section>
  </main>

  @include('web.partials.footer')
</body>
</html>
