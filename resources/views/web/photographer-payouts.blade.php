<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="PhotoX photographer payouts and banking details.">
  <title>PhotoX | Photographer Payouts & Banking</title>
  <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
  <script defer src="{{ asset('site-ad.js') }}"></script>
</head>
<body class="page-photographer-profile">
  <nav aria-label="Main navigation" class="navbar navbar-expand-lg py-2">
    <div class="container-xl">
      <a class="navbar-brand d-flex align-items-center gap-2" href="/"><img alt="PhotoX" src="{{ asset('logo.png') }}"></a>
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
            <button class="profile-trigger" aria-label="Open account menu"><span class="avatar">{{ strtoupper(substr($photographer->name, 0, 2)) }}</span><span class="d-none d-sm-inline">{{ $photographer->name }}</span><i class="bi bi-chevron-down"></i></button>
            <div class="account-dropdown" role="menu">
              <div class="account-dropdown-user"><span class="avatar">{{ strtoupper(substr($photographer->name, 0, 2)) }}</span><div><strong>{{ $photographer->name }}</strong><small>{{ $photographer->email }}</small></div></div>
              <a href="/photographer-profile" role="menuitem"><i class="bi bi-person"></i> Profile & settings</a>
              <a href="/photographer-payouts" role="menuitem"><i class="bi bi-bank"></i> Payouts & Banking</a>
              <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="border-0 bg-transparent text-start w-100 p-2 text-danger" style="cursor:pointer;"><i class="bi bi-box-arrow-left me-2"></i> Log out</button>
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
        <span class="eyebrow-blue">CREATOR WORKSPACE</span>
        <h1>Frame the<br><em>moment.</em></h1>
      </div>
      <nav class="workspace-nav">
        <a class="workspace-nav-link" href="/photographer-dashboard"><i class="bi bi-grid-1x2"></i><span>Overview</span></a>
        <a class="workspace-nav-link" href="/photographer-bookings"><i class="bi bi-calendar-event"></i><span>Events</span><b>12</b></a>
        <a class="workspace-nav-link" href="/photographer-gallery"><i class="bi bi-images"></i><span>Gallery</span></a>
        <a class="workspace-nav-link" href="/photographer-earnings"><i class="bi bi-wallet2"></i><span>Earnings</span></a>
        <a class="workspace-nav-link active" href="/photographer-payouts"><i class="bi bi-bank"></i><span>Payouts &amp; Bank</span></a>
        <a class="workspace-nav-link" href="{{ route('photographers.details', $photographer->id) }}" target="_blank"><i class="bi bi-globe"></i><span>Public Storefront</span></a>
        <a class="workspace-nav-link" href="/photographer-messages"><i class="bi bi-chat-left-text"></i><span>Messages</span></a>
        <a class="workspace-nav-link" href="/photographer-profile"><i class="bi bi-person-circle"></i><span>Profile</span></a>
        <a class="workspace-nav-link" href="/notifications"><i class="bi bi-bell"></i><span>Notifications</span></a>
      </nav>
      <div class="workspace-side-note">
        <i class="bi bi-shield-check"></i>
        <div>
          <strong>Direct EFT Payouts</strong>
          <span>Weekly automated clearance to your verified South African bank account.</span>
        </div>
      </div>
      <form action="{{ route('logout') }}" method="POST" class="mt-3">
        @csrf
        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 w-100" style="cursor:pointer;"><i class="bi bi-box-arrow-left me-1"></i>Sign out</button>
      </form>
    </aside>

    <section class="workspace-main">
      <div class="workspace-topbar">
        <div>
          <span class="eyebrow-blue">PAYOUT PREFERENCES</span>
          <h2>Banking details &amp; Automated payouts</h2>
        </div>
        <div class="d-flex align-items-center gap-2">
          <span class="badge bg-success bg-opacity-25 text-success px-3 py-2 border border-success border-opacity-25 rounded-pill">
            <i class="bi bi-shield-check me-1"></i> Bank Account Linked
          </span>
        </div>
      </div>

      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 border-0 bg-success bg-opacity-25 text-white" role="alert">
          <i class="bi bi-check-circle-fill me-2 text-success"></i>{{ session('success') }}
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4 border-0 bg-danger bg-opacity-25 text-white" role="alert">
          <i class="bi bi-exclamation-triangle-fill me-2 text-danger"></i>{{ $errors->first() }}
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="summary-grid mb-4">
        <div class="summary-card accent">
          <span class="label"><i class="bi bi-wallet2"></i> Available Payout Balance</span>
          <strong>R {{ number_format($netEarnings, 2) }}</strong>
          <small><span>Cleared revenue ready for payout</span><b>Direct EFT</b></small>
        </div>
        <div class="summary-card">
          <span class="label"><i class="bi bi-calendar3"></i> Payout Frequency</span>
          <strong>Weekly (Every Monday)</strong>
          <small><span>Automated direct batch transfer</span><b>Scheduled</b></small>
        </div>
        <div class="summary-card">
          <span class="label"><i class="bi bi-percent"></i> Your Net Commission</span>
          <strong>{{ 100 - (float) $commissionRate }}% Take-Home</strong>
          <small><span>Platform fee: {{ $commissionRate }}%</span><b>Tier Standard</b></small>
        </div>
      </div>

      <form action="{{ route('photographer.payouts.update') }}" class="profile-card" method="POST">
        @csrf

        {{-- Section 1: Payout Method --}}
        <section class="profile-section">
          <div class="profile-section-heading">
            <i class="bi bi-credit-card-2-front"></i>
            <div>
              <h3>Payout Method</h3>
              <p>Choose how PhotoX should deliver your photo sales earnings.</p>
            </div>
          </div>
          <div class="row g-3">
            <div class="col-md-4">
              <label class="p-3 border rounded-3 d-block h-100" style="background: rgba(255,255,255,0.02); cursor: pointer; border-color: rgba(255,255,255,0.1) !important;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <strong class="text-white"><i class="bi bi-bank text-warning me-2"></i>South African EFT</strong>
                  <input type="radio" name="payout_method" value="eft" {{ old('payout_method', $photographer->payout_method ?: 'eft') === 'eft' ? 'checked' : '' }}>
                </div>
                <small class="text-muted d-block">Direct electronic funds transfer into any South African bank account. No additional fee.</small>
              </label>
            </div>
            <div class="col-md-4">
              <label class="p-3 border rounded-3 d-block h-100" style="background: rgba(255,255,255,0.02); cursor: pointer; border-color: rgba(255,255,255,0.1) !important;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <strong class="text-white"><i class="bi bi-lightning-charge text-primary me-2"></i>Yoco Payout</strong>
                  <input type="radio" name="payout_method" value="yoco" {{ old('payout_method', $photographer->payout_method) === 'yoco' ? 'checked' : '' }}>
                </div>
                <small class="text-muted d-block">Instant automated merchant disbursement via Yoco Gateway network.</small>
              </label>
            </div>
            <div class="col-md-4">
              <label class="p-3 border rounded-3 d-block h-100" style="background: rgba(255,255,255,0.02); cursor: pointer; border-color: rgba(255,255,255,0.1) !important;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <strong class="text-white"><i class="bi bi-paypal text-info me-2"></i>PayPal / International</strong>
                  <input type="radio" name="payout_method" value="paypal" {{ old('payout_method', $photographer->payout_method) === 'paypal' ? 'checked' : '' }}>
                </div>
                <small class="text-muted d-block">For international creators operating outside South Africa.</small>
              </label>
            </div>
          </div>
        </section>

        {{-- Section 2: South African Bank Account Details --}}
        <section class="profile-section">
          <div class="profile-section-heading">
            <i class="bi bi-bank2"></i>
            <div>
              <h3>South African Banking Details</h3>
              <p>Enter your local bank account details. These will be verified before your first weekly payout.</p>
            </div>
          </div>

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label text-muted small" for="bank_name">Bank Name <span class="text-danger">*</span></label>
              <select name="bank_name" id="bank_name" class="form-select" onchange="autoFillBranchCode(this)">
                <option value="">Select your bank...</option>
                @foreach($saBanks as $bank => $code)
                  <option value="{{ $bank }}" data-branch="{{ $code }}" {{ old('bank_name', $photographer->bank_name ?: 'Standard Bank') === $bank ? 'selected' : '' }}>
                    {{ $bank }} (Branch: {{ $code }})
                  </option>
                @endforeach
                <option value="Other Bank" data-branch="" {{ old('bank_name', $photographer->bank_name) === 'Other Bank' ? 'selected' : '' }}>Other Bank (Enter below)</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label text-muted small" for="account_holder_name">Account Holder Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" value="{{ old('account_holder_name', $photographer->account_holder_name ?: $photographer->name) }}" placeholder="e.g. Aiden Daniels" required>
              <small class="text-muted">Must match the legal account name with your financial institution.</small>
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted small" for="account_number">Account Number <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="account_number" name="account_number" value="{{ old('account_number', $photographer->account_number ?: '1014829034') }}" placeholder="e.g. 1014829034" required>
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted small" for="branch_code">Branch Code <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="branch_code" name="branch_code" value="{{ old('branch_code', $photographer->branch_code ?: '051001') }}" placeholder="Universal 6-digit branch code" required>
            </div>

            <div class="col-md-4">
              <label class="form-label text-muted small" for="account_type">Account Type <span class="text-danger">*</span></label>
              <select name="account_type" id="account_type" class="form-select">
                <option value="cheque" {{ old('account_type', $photographer->account_type ?: 'cheque') === 'cheque' ? 'selected' : '' }}>Cheque / Current Account</option>
                <option value="savings" {{ old('account_type', $photographer->account_type) === 'savings' ? 'selected' : '' }}>Savings Account</option>
                <option value="transmission" {{ old('account_type', $photographer->account_type) === 'transmission' ? 'selected' : '' }}>Transmission Account</option>
              </select>
            </div>

            <div class="col-md-12">
              <label class="form-label text-muted small" for="payout_email">Payment Confirmation &amp; Remittance Email</label>
              <input type="email" class="form-control" id="payout_email" name="payout_email" value="{{ old('payout_email', $photographer->payout_email ?: $photographer->email) }}" placeholder="email@address.com">
              <small class="text-muted">EFT payment proof of payment (POP) and remittance advices will be emailed here.</small>
            </div>
          </div>
        </section>

        {{-- POPIA Compliance Alert --}}
        <div class="p-3 rounded-3 mb-4 d-flex align-items-start gap-3" style="background: rgba(255, 138, 0, 0.05); border: 1px solid rgba(255, 138, 0, 0.2);">
          <i class="bi bi-shield-lock text-warning fs-4"></i>
          <div>
            <strong class="text-white d-block mb-1">Encrypted &amp; POPIA Compliant Security</strong>
            <small class="text-muted">Your banking credentials are protected with bank-grade encryption and stored strictly under the South African Protection of Personal Information Act (POPIA No. 4 of 2013). PhotoX will never share your banking details with any third party.</small>
          </div>
        </div>

        <div class="profile-actions d-flex align-items-center justify-content-between flex-wrap gap-3">
          <a class="btn btn-outline-secondary rounded-pill px-4" href="{{ route('photographer.dashboard') }}">Back to Workspace</a>
          <button class="btn btn-lime rounded-pill px-4" type="submit">
            <i class="bi bi-check2 me-2"></i>Save Banking Details
          </button>
        </div>
      </form>
    </section>
  </main>

  @include('web.partials.footer')

  <script>
    function autoFillBranchCode(select) {
      const selectedOption = select.options[select.selectedIndex];
      const branch = selectedOption.getAttribute('data-branch');
      if (branch) {
        document.getElementById('branch_code').value = branch;
      }
    }
  </script>
</body>
</html>
