<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PhotoX Admin | {{ ucfirst($type) }}s Directory</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet" />
  <style>
    .org-logo-wrap {
      width: 44px;
      height: 44px;
      border-radius: 10px;
      background: #0f172a;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      border: 1px solid #e2e8f0;
    }
    .org-logo-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .vanity-link {
      font-family: 'Space Grotesk', monospace;
      font-size: 0.8rem;
      color: #0284c7;
      text-decoration: none;
    }
    .vanity-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="app-shell">
    @include('admin.partials.sidebar')

    <div class="main-content">
      <header class="topbar">
        <div class="topbar-left">
          <button class="btn btn-sm btn-outline-secondary d-md-none" id="sidebarToggle" type="button"><i class="bi bi-list"></i></button>
          <div class="search-wrap">
            <i class="bi bi-search"></i>
            <input aria-label="Search" placeholder="Search {{ $type }}..." type="search" />
          </div>
        </div>
        <div class="topbar-right">
          <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 py-2 px-3 rounded-pill">
            <i class="bi bi-shield-check me-1"></i> Dedicated Profiles &amp; Custom URLs
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
            <p class="eyebrow">Organisations Directory</p>
            <h1>{{ ucfirst($type) }}s</h1>
            <p class="intro-copy">Manage {{ $type }} profiles with dedicated vanity URLs (e.g. photox.co.za/{{ $type === 'school' ? 'school/grey-college' : 'company/red-bull' }}) and linked event galleries.</p>
          </div>
          <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#createOrgModal">
            <i class="bi bi-plus-lg me-1"></i> Add New {{ ucfirst($type) }}
          </button>
        </div>

        <section class="row g-3 mb-4">
          <div class="col-xl-4 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon"><i class="bi {{ $type === 'school' ? 'bi-mortarboard-fill' : 'bi-buildings-fill' }}"></i></span>
              </div>
              <p>Total {{ ucfirst($type) }}s</p>
              <h2>{{ $stats['total'] }}</h2>
              <small>Profiles in directory</small>
            </article>
          </div>
          <div class="col-xl-4 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="background: rgba(34, 197, 94, 0.15); color: #22c55e;"><i class="bi bi-check-circle-fill"></i></span>
              </div>
              <p>Active Profiles</p>
              <h2>{{ $stats['active'] }}</h2>
              <small>Public vanity pages live</small>
            </article>
          </div>
          <div class="col-xl-4 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="background: rgba(245, 158, 11, 0.15); color: #f59e0b;"><i class="bi bi-collection-fill"></i></span>
              </div>
              <p>Linked Galleries</p>
              <h2>{{ $stats['total_galleries'] }}</h2>
              <small>Events assigned to {{ $type }}s</small>
            </article>
          </div>
        </section>

        <section class="ops-table-panel">
          <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
            <div>
              <p class="eyebrow">Directory</p>
              <h3>All {{ ucfirst($type) }} Profiles</h3>
            </div>
            <form method="GET" action="{{ url()->current() }}" class="d-flex align-items-center gap-2">
              <div class="search-field" style="max-width: 260px;">
                <i class="bi bi-search"></i>
                <input name="search" value="{{ request('search') }}" placeholder="Search name, city..." type="search">
              </div>
            </form>
          </div>

          <div class="table-responsive">
            <table class="table ops-table">
              <thead>
                <tr>
                  <th>{{ ucfirst($type) }}</th>
                  <th>Vanity URL</th>
                  <th>Location</th>
                  <th>Category</th>
                  <th>Linked Galleries</th>
                  <th>Status</th>
                  <th class="text-end">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($organisations as $org)
                  <tr>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <div class="org-logo-wrap">
                          @if($org->logo_url)
                            <img src="{{ $org->logo_url }}" alt="{{ $org->name }}">
                          @else
                            <span class="text-white fw-bold small">{{ strtoupper(substr($org->name, 0, 2)) }}</span>
                          @endif
                        </div>
                        <div>
                          <strong>{{ $org->name }}</strong>
                          @if($org->short_code)
                            <span class="badge bg-secondary bg-opacity-25 text-dark ms-1">{{ $org->short_code }}</span>
                          @endif
                        </div>
                      </div>
                    </td>
                    <td>
                      <a href="{{ route('organisation.profile', [$org->type, $org->slug]) }}" target="_blank" class="vanity-link">
                        /{{ $org->type }}/{{ $org->slug }} <i class="bi bi-arrow-up-right small"></i>
                      </a>
                    </td>
                    <td>
                      <span>{{ $org->city ?: 'South Africa' }}{{ $org->province ? ', ' . $org->province : '' }}</span>
                    </td>
                    <td>
                      <span class="badge bg-light text-dark border">{{ $org->category ?: 'General' }}</span>
                    </td>
                    <td>
                      <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25">
                        <i class="bi bi-images me-1"></i>{{ $org->events_count ?? 0 }} {{ Str::plural('event', (int) ($org->events_count ?? 0)) }}
                      </span>
                    </td>
                    <td>
                      @if($org->is_active)
                        <span class="badge bg-success bg-opacity-15 text-success">Active</span>
                      @else
                        <span class="badge bg-secondary bg-opacity-25 text-muted">Inactive</span>
                      @endif
                    </td>
                    <td class="text-end">
                      <div class="d-inline-flex gap-2">
                        <a href="{{ route('organisation.profile', [$org->type, $org->slug]) }}" target="_blank" class="btn btn-sm btn-outline-info" title="View Public Profile">
                          <i class="bi bi-box-arrow-up-right"></i>
                        </a>
                        <form action="{{ route('admin.organisations.toggle', $org->id) }}" method="POST">
                          @csrf
                          <button type="submit" class="btn btn-sm btn-outline-secondary" title="{{ $org->is_active ? 'Deactivate' : 'Activate' }}">
                            <i class="bi {{ $org->is_active ? 'bi-pause-fill text-warning' : 'bi-play-fill text-success' }}"></i>
                          </button>
                        </form>
                        <form action="{{ route('admin.organisations.destroy', $org->id) }}" method="POST" onsubmit="return confirm('Delete {{ $org->name }}?')">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                            <i class="bi bi-trash"></i>
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="7" class="text-center py-4 text-muted">No {{ $type }} profiles created yet. Click 'Add New {{ ucfirst($type) }}' to create one.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div class="mt-3">
            {{ $organisations->links() }}
          </div>
        </section>
      </main>
    </div>
  </div>

  <!-- Create Organisation Modal -->
  <div class="modal fade" id="createOrgModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
        <form action="{{ route('admin.organisations.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="type" value="{{ $type }}">
          <div class="modal-header border-0 pb-0">
            <h5 class="modal-title fw-bold">Add New {{ ucfirst($type) }} Profile</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row g-3 mb-3">
              <div class="col-md-8">
                <label class="form-label small fw-bold text-uppercase text-muted">{{ ucfirst($type) }} Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" placeholder="{{ $type === 'school' ? 'e.g. Grey College or Affies' : 'e.g. Red Bull South Africa' }}" required>
              </div>
              <div class="col-md-4">
                <label class="form-label small fw-bold text-uppercase text-muted">Custom URL Slug</label>
                <input type="text" name="slug" class="form-control" placeholder="e.g. grey-college">
                <div class="form-text">photox.co.za/{{ $type }}/[slug]</div>
              </div>
            </div>
            <div class="row g-3 mb-3">
              <div class="col-md-4">
                <label class="form-label small fw-bold text-uppercase text-muted">Short Code / Tag</label>
                <input type="text" name="short_code" class="form-control" placeholder="e.g. GREY or RB">
              </div>
              <div class="col-md-4">
                <label class="form-label small fw-bold text-uppercase text-muted">City</label>
                <input type="text" name="city" class="form-control" placeholder="e.g. Pretoria, Cape Town">
              </div>
              <div class="col-md-4">
                <label class="form-label small fw-bold text-uppercase text-muted">Province</label>
                <input type="text" name="province" class="form-control" placeholder="e.g. Gauteng, Western Cape">
              </div>
            </div>
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label small fw-bold text-uppercase text-muted">Upload Logo</label>
                <input type="file" name="logo_file" class="form-control" accept="image/*">
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-bold text-uppercase text-muted">Or Logo URL</label>
                <input type="text" name="logo_url" class="form-control" placeholder="https://...">
              </div>
            </div>
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label small fw-bold text-uppercase text-muted">Website Link</label>
                <input type="url" name="website" class="form-control" placeholder="https://school.co.za">
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-bold text-uppercase text-muted">Contact Email</label>
                <input type="email" name="contact_email" class="form-control" placeholder="sports@school.co.za">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label small fw-bold text-uppercase text-muted">About / Bio</label>
              <textarea name="description" rows="3" class="form-control" placeholder="Information about this school/company, sporting achievements, and history..."></textarea>
            </div>
          </div>
          <div class="modal-footer border-0 pt-0">
            <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Create {{ ucfirst($type) }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
