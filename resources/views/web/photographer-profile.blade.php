<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="PhotoX photographer profile page.">
  <title>PhotoX | Photographer profile</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <script defer src="site-ad.js"></script>
  
</head>
<body class="page-photographer-profile">
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
          <div class="header-search d-none d-xl-flex"><i class="bi bi-search"></i><input aria-label="Search" placeholder="Search settings" type="search"></div>
          <a class="header-cart" href="/cart" aria-label="Open cart"><i class="bi bi-cart3"></i><span>0</span></a>
          <button class="icon-button notification-button" aria-label="Notifications"><i class="bi bi-bell"></i><span>1</span></button>
          <div class="account-menu">
            <button class="profile-trigger" aria-label="Open account menu"><span class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'P', 0, 2)) }}</span><span class="d-none d-sm-inline">{{ Auth::user()->name ?? 'Creator' }}</span><i class="bi bi-chevron-down"></i></button>
            <div class="account-dropdown" role="menu">
              <div class="account-dropdown-user"><span class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'P', 0, 2)) }}</span><div><strong>{{ Auth::user()->name ?? 'Creator' }}</strong><small>{{ Auth::user()->email ?? '' }}</small></div></div>
              <a href="{{ url('/photographer-profile') }}" role="menuitem"><i class="bi bi-person"></i> Profile &amp; settings</a>
              <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="dropdown-item text-danger py-2 w-100 text-start border-0 bg-transparent px-3"><i class="bi bi-box-arrow-left me-2"></i> Log out</button>
              </form>
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
        <a class="workspace-nav-link" href="/photographer-gallery"><i class="bi bi-images"></i><span>Gallery</span></a>
        <a class="workspace-nav-link" href="{{ route('photographer.watermark') }}"><i class="bi bi-shield-lock"></i><span>Watermark Studio</span></a>
        <a class="workspace-nav-link" href="/photographer-earnings"><i class="bi bi-wallet2"></i><span>Earnings</span></a>
        <a class="workspace-nav-link" href="/photographer-payouts"><i class="bi bi-bank"></i><span>Payouts &amp; Bank</span></a>
        <a class="workspace-nav-link" href="/photographer-messages"><i class="bi bi-chat-left-text"></i><span>Messages</span></a>
        <a class="workspace-nav-link active" href="/photographer-profile"><i class="bi bi-person-circle"></i><span>Profile</span></a>
      </nav>
      <div class="workspace-side-note"><i class="bi bi-shield-check"></i><div><strong>Coverage secured</strong><span>3 client galleries are still pending final delivery.</span></div></div>
      <a class="workspace-logout" href="/"><i class="bi bi-box-arrow-left"></i> Sign out</a>
    </aside>

    <section class="workspace-main">
      <div class="workspace-topbar">
        <div>
          <span class="eyebrow-blue">PROFILE</span>
          <h2>Photographer account</h2>
        </div>
        
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

      <form action="{{ route('photographer.profile.update') }}" class="profile-card" id="profileForm" method="POST" enctype="multipart/form-data">
        @csrf
        <section class="profile-section">
          <div class="profile-header d-flex align-items-center gap-3">
            @if($photographer->avatar)
              <img src="{{ $photographer->avatar }}" alt="{{ $photographer->name }}" class="rounded-circle" style="width: 72px; height: 72px; object-fit: cover; border: 2px solid #ff8a00;">
            @else
              <div class="profile-avatar">{{ strtoupper(substr($photographer->name, 0, 2)) }}</div>
            @endif
            <div class="flex-grow-1">
              <div class="d-flex justify-content-between align-items-center">
                <h3>{{ $photographer->name }}</h3>
                <a href="{{ route('photographers.details', $photographer->id) }}" target="_blank" class="btn btn-sm btn-outline-light rounded-pill px-3"><i class="bi bi-box-arrow-up-right me-1"></i>View Public Storefront</a>
              </div>
              <div class="profile-meta">{{ $photographer->specialty ?: 'Sports & event photographer' }} &bull; {{ $photographer->location ?: 'South Africa' }}</div>
              <span class="profile-status"><i class="bi bi-circle-fill"></i> {{ $photographer->status === 'active' ? 'Profile visible to clients' : 'Pending activation' }}</span>
            </div>
          </div>
        </section>

        <section class="profile-section">
          <div class="profile-section-heading">
            <i class="bi bi-image"></i>
            <div>
              <h3>Profile Avatar &amp; Storefront Banner</h3>
              <p>Upload your personal photo and custom storefront header.</p>
            </div>
          </div>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Profile Avatar / Logo</label>
              <input type="file" name="avatar" class="form-control" accept="image/*">
              <small class="text-muted d-block mt-1">Recommended: 400 &times; 400 px square</small>
            </div>
            <div class="col-md-6">
              <label class="form-label">Storefront Header Banner</label>
              <input type="file" name="banner_image" class="form-control" accept="image/*">
              <small class="text-muted d-block mt-1">Recommended: 1200 &times; 400 px landscape banner</small>
            </div>
          </div>
        </section>

        <section class="profile-section">
          <div class="profile-section-heading">
            <i class="bi bi-person-vcard"></i>
            <div>
              <h3>Personal information</h3>
              <p>The details clients use when they contact you.</p>
            </div>
          </div>
          <div class="info-grid">
            <label class="profile-field">
              <span class="field-label">Full name <span class="text-danger">*</span></span>
              <input class="profile-input" name="name" type="text" value="{{ old('name', $photographer->name) }}" required>
            </label>
            <label class="profile-field">
              <span class="field-label">Email address</span>
              <input class="profile-input" name="email" type="email" value="{{ $photographer->email }}" disabled style="opacity: 0.65; cursor: not-allowed;">
              <small class="text-muted">Account email</small>
            </label>
            <label class="profile-field">
              <span class="field-label">Phone number</span>
              <input class="profile-input" name="phone" type="tel" value="{{ old('phone', $photographer->phone ?: '+27 82 456 7821') }}">
            </label>
            <label class="profile-field">
              <span class="field-label">Location / City</span>
              <input class="profile-input" name="location" type="text" value="{{ old('location', $photographer->location ?: 'Cape Town, South Africa') }}">
            </label>
          </div>
        </section>

        <section class="profile-section">
          <div class="profile-section-heading">
            <i class="bi bi-camera"></i>
            <div>
              <h3>Creator profile &amp; Bio</h3>
              <p>Tell clients what makes your sports photography distinct.</p>
            </div>
          </div>
          <div class="profile-field mb-3">
            <label class="field-label" for="specialty">Primary Speciality / Headline</label>
            <input class="profile-input" id="specialty" name="specialty" type="text" value="{{ old('specialty', $photographer->specialty ?: 'Sports & Action Photography') }}" placeholder="e.g. Rugby, Marathons, School Finals">
          </div>
          <div class="profile-field">
            <label class="field-label" for="bio">Bio / About you</label>
            <textarea class="profile-textarea" id="bio" name="bio" rows="4">{{ old('bio', $photographer->bio ?: 'Capturing decisive movement, athlete emotion and the atmosphere of live sports events with a documentary approach that keeps every frame honest and alive.') }}</textarea>
            <div class="profile-helper">This introduction appears on your public photographer storefront page.</div>
          </div>
        </section>

        <section class="profile-section">
          <div class="profile-section-heading">
            <i class="bi bi-bank"></i>
            <div>
              <h3>Payouts &amp; Bank Account (South Africa)</h3>
              <p>Configure your bank details for automated weekly photo sale disbursements.</p>
            </div>
          </div>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label text-muted small" for="bank_name">Bank Name</label>
              <select name="bank_name" id="bank_name" class="form-select" onchange="if(this.selectedOptions[0].dataset.branch){document.getElementById('branch_code').value=this.selectedOptions[0].dataset.branch;}">
                <option value="">Select your bank...</option>
                <option value="Standard Bank" data-branch="051001" {{ old('bank_name', $photographer->bank_name) === 'Standard Bank' ? 'selected' : '' }}>Standard Bank (051001)</option>
                <option value="First National Bank (FNB)" data-branch="250655" {{ old('bank_name', $photographer->bank_name) === 'First National Bank (FNB)' ? 'selected' : '' }}>First National Bank (FNB) (250655)</option>
                <option value="Absa Bank" data-branch="632005" {{ old('bank_name', $photographer->bank_name) === 'Absa Bank' ? 'selected' : '' }}>Absa Bank (632005)</option>
                <option value="Nedbank" data-branch="198765" {{ old('bank_name', $photographer->bank_name) === 'Nedbank' ? 'selected' : '' }}>Nedbank (198765)</option>
                <option value="Capitec Bank" data-branch="470010" {{ old('bank_name', $photographer->bank_name) === 'Capitec Bank' ? 'selected' : '' }}>Capitec Bank (470010)</option>
                <option value="Investec Bank" data-branch="580105" {{ old('bank_name', $photographer->bank_name) === 'Investec Bank' ? 'selected' : '' }}>Investec Bank (580105)</option>
                <option value="TymeBank" data-branch="678910" {{ old('bank_name', $photographer->bank_name) === 'TymeBank' ? 'selected' : '' }}>TymeBank (678910)</option>
                <option value="Discovery Bank" data-branch="679000" {{ old('bank_name', $photographer->bank_name) === 'Discovery Bank' ? 'selected' : '' }}>Discovery Bank (679000)</option>
                <option value="African Bank" data-branch="430000" {{ old('bank_name', $photographer->bank_name) === 'African Bank' ? 'selected' : '' }}>African Bank (430000)</option>
                <option value="Bidvest Bank" data-branch="462005" {{ old('bank_name', $photographer->bank_name) === 'Bidvest Bank' ? 'selected' : '' }}>Bidvest Bank (462005)</option>
                <option value="Other Bank" data-branch="" {{ old('bank_name', $photographer->bank_name) === 'Other Bank' ? 'selected' : '' }}>Other Bank</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label text-muted small" for="account_holder_name">Account Holder Name</label>
              <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" value="{{ old('account_holder_name', $photographer->account_holder_name) }}" placeholder="e.g. Legal Name on Account">
            </div>
            <div class="col-md-4">
              <label class="form-label text-muted small" for="account_number">Account Number</label>
              <input type="text" class="form-control" id="account_number" name="account_number" value="{{ old('account_number', $photographer->account_number) }}" placeholder="e.g. Account number">
            </div>
            <div class="col-md-4">
              <label class="form-label text-muted small" for="branch_code">Branch Code</label>
              <input type="text" class="form-control" id="branch_code" name="branch_code" value="{{ old('branch_code', $photographer->branch_code) }}" placeholder="e.g. 6-digit branch code">
            </div>
            <div class="col-md-4">
              <label class="form-label text-muted small" for="account_type">Account Type</label>
              <select name="account_type" id="account_type" class="form-select">
                <option value="">Select account type...</option>
                <option value="cheque" {{ old('account_type', $photographer->account_type) === 'cheque' ? 'selected' : '' }}>Cheque / Current</option>
                <option value="savings" {{ old('account_type', $photographer->account_type) === 'savings' ? 'selected' : '' }}>Savings</option>
                <option value="transmission" {{ old('account_type', $photographer->account_type) === 'transmission' ? 'selected' : '' }}>Transmission</option>
              </select>
            </div>
            <div class="col-12 mt-2">
              <div class="d-flex align-items-center justify-content-between p-2 rounded" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08);">
                <small class="text-muted"><i class="bi bi-shield-check text-success me-1"></i> POPIA encrypted bank storage. Automated EFT payout every Monday.</small>
                <a href="{{ route('photographer.payouts') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">Open Dedicated Payouts Portal <i class="bi bi-arrow-right ms-1"></i></a>
              </div>
            </div>
          </div>
        </section>

        <div class="profile-actions">
          <a class="btn btn-outline-secondary rounded-pill px-4" href="{{ route('photographer.dashboard') }}">Cancel</a>
          <button class="btn btn-lime rounded-pill px-4" type="submit"><i class="bi bi-check2 me-2"></i>Save profile changes</button>
        </div>
      </form>
    </section>
  </main>

  @include('web.partials.footer')
</body>
</html>
