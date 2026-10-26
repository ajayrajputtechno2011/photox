<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PhotoX Admin | Add Sponsor</title>
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
            <a class="breadcrumb-muted" href="/admin/sponsors">Sponsors</a>
            <i class="bi bi-chevron-right"></i>
            <strong>Add sponsor</strong>
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

      <main class="content-area module-page">
        <div class="page-intro">
          <p class="eyebrow">Partnership onboarding</p>
          <h1>Add sponsor</h1>
          <p class="intro-copy">Create a sponsor profile and define the commercial relationship managed by Admin.</p>
        </div>
        <form action="/admin/sponsors" method="GET" class="ops-form">
          <section class="ops-panel">
            <div class="section-heading">
              <div>
                <p class="eyebrow">Sponsor profile</p>
                <h3>Company and contact details</h3>
              </div>
              <span class="form-step">01 / 03</span>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label" for="sponsor-name">Sponsor name</label>
                <input class="form-control" id="sponsor-name" name="sponsor-name" placeholder="e.g. Gilbert Rugby" required />
              </div>
              <div class="col-md-6">
                <label class="form-label" for="sponsor-type">Partnership type</label>
                <select class="form-select" id="sponsor-type" name="sponsor-type">
                  <option>Commercial sponsor</option>
                  <option>Product partner</option>
                  <option>Community partner</option>
                  <option>Media partner</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label" for="contact-name">Primary contact</label>
                <input class="form-control" id="contact-name" name="contact-name" placeholder="Full name" required />
              </div>
              <div class="col-md-6">
                <label class="form-label" for="contact-email">Contact email</label>
                <input class="form-control" id="contact-email" name="contact-email" type="email" placeholder="partnerships@company.co" required />
              </div>
              <div class="col-md-6">
                <label class="form-label" for="contact-phone">Contact phone</label>
                <input class="form-control" id="contact-phone" name="contact-phone" placeholder="+27 82 000 0000" />
              </div>
              <div class="col-md-6">
                <label class="form-label" for="website">Website</label>
                <input class="form-control" id="website" name="website" type="url" placeholder="https://company.co" />
              </div>
            </div>
          </section>

          <section class="ops-panel">
            <div class="section-heading">
              <div>
                <p class="eyebrow">Commercial setup</p>
                <h3>Campaign and relationship details</h3>
              </div>
              <span class="form-step">02 / 03</span>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label" for="account-status">Account status</label>
                <select class="form-select" id="account-status" name="account-status">
                  <option>Pending approval</option>
                  <option>Active</option>
                  <option>Paused</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label" for="campaign-owner">PhotoX account owner</label>
                <select class="form-select" id="campaign-owner" name="campaign-owner">
                  <option>Alex Lee</option>
                  <option>Jordan Miller</option>
                  <option>Sarah Kim</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label" for="campaign-count">Initial campaign count</label>
                <input class="form-control" id="campaign-count" name="campaign-count" type="number" min="0" value="0" />
              </div>
              <div class="col-md-6">
                <label class="form-label" for="spend-limit">Quarterly spend target</label>
                <div class="input-group">
                  <span class="input-group-text">R</span>
                  <input class="form-control" id="spend-limit" name="spend-limit" type="number" min="0" placeholder="0" />
                </div>
              </div>
              <div class="col-12">
                <label class="form-label" for="relationship-notes">Internal relationship notes</label>
                <textarea class="form-control" id="relationship-notes" name="relationship-notes" rows="4" placeholder="Add commercial notes, placement commitments or renewal context"></textarea>
              </div>
            </div>
          </section>

          <section class="ops-panel">
            <div class="section-heading">
              <div>
                <p class="eyebrow">Brand assets</p>
                <h3>Sponsor identity</h3>
              </div>
              <span class="form-step">03 / 03</span>
            </div>
            <div class="upload-zone">
              <i class="bi bi-image"></i>
              <div>
                <strong>Upload sponsor logo</strong>
                <p>PNG, JPG or SVG · recommended 800 x 800px</p>
              </div>
              <button class="btn btn-outline-light" type="button">Choose file</button>
            </div>
            <div class="form-check mt-3">
              <input class="form-check-input" id="notify-contact" name="notify-contact" type="checkbox" />
              <label class="form-check-label" for="notify-contact">Send the primary contact a welcome email</label>
            </div>
          </section>

          <div class="ops-form-actions">
            <a class="btn btn-outline-light" href="/admin/sponsors">Cancel</a>
            <button class="btn btn-primary" type="submit">
              <i class="bi bi-award"></i> Create sponsor
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
