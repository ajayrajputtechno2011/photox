<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="PhotoX photographer gallery management page.">
  <title>PhotoX | Photographer gallery</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <script defer src="site-ad.js"></script>
  
</head>
<body class="page-photographer-gallery">
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
          <div class="header-search d-none d-xl-flex"><i class="bi bi-search"></i><input aria-label="Search" placeholder="Search photos" type="search"></div>
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
        <a class="workspace-nav-link" href="{{ route('photographer.watermark') }}"><i class="bi bi-shield-lock"></i><span>Watermark Studio</span></a>
        <a class="workspace-nav-link" href="/photographer-earnings"><i class="bi bi-wallet2"></i><span>Earnings</span></a>
        <a class="workspace-nav-link" href="/photographer-payouts"><i class="bi bi-bank"></i><span>Payouts &amp; Bank</span></a>
        <a class="workspace-nav-link" href="/photographer-messages"><i class="bi bi-chat-left-text"></i><span>Messages</span></a>
        <a class="workspace-nav-link" href="/photographer-profile"><i class="bi bi-person-circle"></i><span>Profile</span></a>
      </nav>
      <div class="workspace-side-note"><i class="bi bi-shield-check"></i><div><strong>Coverage secured</strong><span>Custom watermarks &amp; gallery pricing active.</span></div></div>
      <a class="workspace-logout" href="/"><i class="bi bi-box-arrow-left"></i> Sign out</a>
    </aside>

    <section class="workspace-main">
      <div class="workspace-topbar">
        <div>
          <span class="eyebrow-blue">GALLERY</span>
          <h2>Portfolio library</h2>
        </div>
        <div class="d-flex gap-2">
          <a class="btn btn-outline-warning rounded-pill px-3" href="{{ route('photographer.watermark') }}"><i class="bi bi-shield-lock me-1"></i>Watermark Studio</a>
          <a class="btn btn-lime rounded-pill px-4" href="/photographer-upload-new"><i class="bi bi-upload me-2"></i>Upload new gallery</a>
        </div>
      </div>

      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
          <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="gallery-toolbar">
        <div class="filter-row">
          <a href="{{ route('photographer.gallery') }}" class="filter-pill text-decoration-none {{ empty($selectedCategory) || $selectedCategory === 'all' ? 'active' : '' }}">All</a>
          @foreach($categories as $cat)
            <a href="{{ route('photographer.gallery', ['category' => $cat->slug ?: $cat->name]) }}" class="filter-pill text-decoration-none {{ $selectedCategory === ($cat->slug ?: $cat->name) ? 'active' : '' }}">{{ $cat->name }}</a>
          @endforeach
        </div>
        <a class="plain-action" href="{{ route('photographers.details', $photographer->id) }}" target="_blank">View Public Storefront <i class="bi bi-arrow-up-right"></i></a>
      </div>

      <div class="gallery-grid">
        @forelse($galleries as $gallery)
          <article class="gallery-item position-relative d-flex flex-column justify-content-between" style="background: #0b1a29; border: 1px solid #1a2f44; border-radius: 14px; overflow: hidden;">
            <div>
              <div class="position-relative">
                <img src="{{ $gallery->cover_image ?: ($gallery->photos->first()?->file_path ?: 'https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=900&q=85') }}" alt="{{ $gallery->title }}" style="width: 100%; height: 200px; object-fit: cover;">
                @if($gallery->cover_photo_id)
                  <span class="position-absolute top-0 start-0 m-2 badge bg-warning text-dark fw-bold shadow-sm" style="font-size: 0.68rem;">
                    <i class="bi bi-star-fill me-1"></i> FEATURED HOME COVER
                  </span>
                @endif
              </div>
              <div class="meta p-3">
                <div class="d-flex justify-content-between align-items-start mb-1 flex-wrap gap-1">
                  <strong class="text-truncate text-white" style="max-width: 65%;">{{ $gallery->title }}</strong>
                  <div class="gallery-badge"><i class="bi bi-tag-fill me-1"></i> {{ $gallery->category_name ?: 'Sports' }}</div>
                </div>
                <div class="d-flex align-items-center justify-content-between my-2 flex-wrap gap-1">
                  <span class="text-muted small">{{ $gallery->photos_count }} photos &bull; {{ $gallery->event_date?->format('d M Y') ?? 'Recent' }}</span>
                  @if($gallery->allow_individual_sales ?? true)
                    <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-50 font-monospace" style="font-size: 0.65rem;">
                      Individual &amp; Bundle
                    </span>
                  @else
                    <span class="badge bg-warning text-dark font-monospace fw-bold" style="font-size: 0.65rem;">
                      <i class="bi bi-box-seam-fill me-1"></i> Complete Only · R{{ number_format($gallery->full_gallery_price ?: 450, 0) }}
                    </span>
                  @endif
                </div>
                <span class="text-white-50 small d-block"><i class="bi bi-geo-alt me-1"></i>{{ $gallery->location ?: 'South Africa' }}</span>
              </div>
            </div>

            <div class="p-2 border-top border-secondary border-opacity-25 d-flex justify-content-between align-items-center gap-2 bg-black bg-opacity-25">
              <div class="d-flex gap-1">
                <a href="{{ route('events.show', $gallery->slug ?: $gallery->id) }}" target="_blank" class="btn btn-sm btn-outline-light rounded-pill px-2 py-1" style="font-size: 0.75rem;" title="View public gallery">
                  <i class="bi bi-eye"></i> View
                </a>
                <button type="button" class="btn btn-sm btn-outline-warning rounded-pill px-3 py-1" style="font-size: 0.75rem;" data-bs-toggle="modal" data-bs-target="#galleryManageModal_{{ $gallery->id }}">
                  <i class="bi bi-gear-fill me-1"></i> Manage Photos
                </button>
              </div>
              <form action="{{ route('photographer.gallery.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this gallery?');" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-2 py-1 border-0" title="Delete Gallery"><i class="bi bi-trash"></i></button>
              </form>
            </div>
          </article>

          <!-- Modal: Manage Photos, Upload More, Pricing Mode & Best Image -->
          <div class="modal fade" id="galleryManageModal_{{ $gallery->id }}" tabindex="-1" aria-labelledby="manageModalLabel_{{ $gallery->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content" style="background: #091522; color: #e2e8f0; border: 1px solid #1a2f44; border-radius: 16px;">
                <div class="modal-header border-bottom border-secondary border-opacity-25">
                  <div>
                    <h5 class="modal-title fw-bold text-white mb-0" id="manageModalLabel_{{ $gallery->id }}">
                      <i class="bi bi-images text-warning me-2"></i>{{ $gallery->title }}
                    </h5>
                    <small class="text-muted">{{ $gallery->photos_count }} photos · {{ $gallery->location }}</small>
                  </div>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                  <!-- Nav Pills for Management Tabs -->
                  <ul class="nav nav-pills nav-fill mb-4 p-1 rounded-3" style="background: rgba(255,255,255,0.04); border: 1px solid #162a3c;" role="tablist">
                    <li class="nav-item">
                      <button class="nav-link active text-white fw-bold py-2" data-bs-toggle="pill" data-bs-target="#tabPhotos_{{ $gallery->id }}" type="button" role="tab">
                        <i class="bi bi-grid me-1"></i> Photos &amp; Best Cover (<span class="text-warning">{{ $gallery->photos->count() }}</span>)
                      </button>
                    </li>
                    <li class="nav-item">
                      <button class="nav-link text-white fw-bold py-2" data-bs-toggle="pill" data-bs-target="#tabUpload_{{ $gallery->id }}" type="button" role="tab">
                        <i class="bi bi-cloud-arrow-up me-1"></i> Upload More Photos
                      </button>
                    </li>
                    <li class="nav-item">
                      <button class="nav-link text-white fw-bold py-2" data-bs-toggle="pill" data-bs-target="#tabSettings_{{ $gallery->id }}" type="button" role="tab">
                        <i class="bi bi-sliders me-1"></i> Settings &amp; Pricing Mode
                      </button>
                    </li>
                  </ul>

                  <div class="tab-content">
                    <!-- Tab 1: Photos & Cover Selector -->
                    <div class="tab-pane fade show active" id="tabPhotos_{{ $gallery->id }}" role="tabpanel">
                      <div class="p-3 mb-3 rounded" style="background: rgba(255, 138, 0, 0.08); border: 1px solid rgba(255, 138, 0, 0.25);">
                        <strong class="text-warning d-block small mb-1"><i class="bi bi-star-fill me-1"></i> Homepage Best Cover Photo</strong>
                        <span class="text-white-50 small">Click "Set as Best Cover" on any photo below to choose the single best image displayed on the homepage gallery.</span>
                      </div>

                      @if($gallery->photos->isNotEmpty())
                        <div class="row g-3">
                          @foreach($gallery->photos as $photo)
                            @php
                              $isBest = ($gallery->cover_photo_id == $photo->id) || (!empty($photo->is_featured));
                            @endphp
                            <div class="col-sm-6 col-md-4">
                              <div class="card h-100 position-relative {{ $isBest ? 'border-warning' : 'border-secondary' }}" style="background: #0f2133; border-width: {{ $isBest ? '2px' : '1px' }}; border-radius: 10px; overflow: hidden;">
                                <div class="position-relative">
                                  <img src="/protected-photo/{{ $photo->id }}" alt="{{ $photo->title }}" style="width: 100%; height: 130px; object-fit: cover;">
                                  @if($isBest)
                                    <span class="position-absolute top-0 start-0 m-1 badge bg-warning text-dark fw-bold" style="font-size: 0.65rem;">
                                      <i class="bi bi-star-fill me-1"></i> BEST COVER
                                    </span>
                                  @endif
                                </div>
                                <div class="p-2 d-flex flex-column justify-content-between flex-grow-1">
                                  <span class="text-truncate text-white small fw-semibold mb-2" title="{{ $photo->title }}">{{ $photo->title ?: 'Photo #' . $photo->id }}</span>
                                  <div class="d-flex justify-content-between align-items-center gap-1 border-top border-secondary border-opacity-25 pt-2">
                                    @if($isBest)
                                      <span class="badge bg-warning text-dark py-1 px-2" style="font-size: 0.65rem; font-weight: 700;">
                                        <i class="bi bi-check-circle-fill me-1"></i> Active Cover
                                      </span>
                                    @else
                                      <form action="{{ route('photographer.gallery.photo.cover', $photo->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-warning py-0 px-2" style="font-size: 0.68rem;" title="Feature on homepage">
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

                    <!-- Tab 2: Upload More Photos -->
                    <div class="tab-pane fade" id="tabUpload_{{ $gallery->id }}" role="tabpanel">
                      <form action="{{ route('photographer.gallery.upload_photos', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="p-4 mb-3 text-center rounded" style="background: rgba(255,255,255,0.02); border: 2px dashed #1e3346;">
                          <i class="bi bi-cloud-arrow-up text-warning display-5 mb-2 d-block"></i>
                          <h6 class="text-white fw-bold mb-1">Add More Photos to "{{ $gallery->title }}"</h6>
                          <p class="text-muted small mb-3">Select JPEG, PNG, or WebP high-resolution photos. Automated watermarks will be applied.</p>
                          <input type="file" name="photos[]" multiple accept="image/*" class="form-control mb-3" style="max-width: 400px; margin: 0 auto;" required>
                          <button type="submit" class="btn btn-warning fw-bold text-dark rounded-pill px-4">
                            <i class="bi bi-upload me-2"></i> Upload &amp; Watermark Photos
                          </button>
                        </div>
                      </form>
                    </div>

                    <!-- Tab 3: Edit Gallery Settings & Pricing -->
                    <div class="tab-pane fade" id="tabSettings_{{ $gallery->id }}" role="tabpanel">
                      <form action="{{ route('photographer.gallery.update', $gallery->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label class="form-label text-muted small text-uppercase fw-bold">Gallery Title</label>
                          <input type="text" name="title" class="form-control" value="{{ $gallery->title }}" required>
                        </div>

                        <div class="row g-3 mb-3">
                          <div class="col-sm-6">
                            <label class="form-label text-muted small text-uppercase fw-bold">Category</label>
                            <select name="category_id" class="form-select">
                              @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $gallery->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-sm-6">
                            <label class="form-label text-muted small text-uppercase fw-bold">Event Date</label>
                            <input type="date" name="event_date" class="form-control" value="{{ $gallery->event_date ? $gallery->event_date->format('Y-m-d') : date('Y-m-d') }}">
                          </div>
                        </div>

                        <div class="row g-3 mb-3">
                          <div class="col-sm-6">
                            <label class="form-label text-muted small text-uppercase fw-bold">Location</label>
                            <input type="text" name="location" class="form-control" value="{{ $gallery->location }}">
                          </div>
                          <div class="col-sm-6">
                            <label class="form-label text-muted small text-uppercase fw-bold">Starting Price Display</label>
                            <input type="text" name="starting_price" class="form-control" value="{{ $gallery->starting_price }}">
                          </div>
                        </div>

                        <!-- Complete Gallery Only Toggle -->
                        <div class="p-3 mb-3 rounded" style="background: rgba(255, 138, 0, 0.08); border: 1px solid rgba(255, 138, 0, 0.3);">
                          <label class="form-label text-warning d-block mb-2 fw-bold"><i class="bi bi-cash-coin me-1"></i> Gallery Sales &amp; Pricing Mode</label>
                          <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="allow_individual_sales" id="galModeBoth_{{ $gallery->id }}" value="1" {{ ($gallery->allow_individual_sales ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label text-white" for="galModeBoth_{{ $gallery->id }}">
                              <strong>Allow Individual Photo Sales + Full Gallery Bundle</strong>
                              <small class="d-block text-muted">Customers can purchase single images or the complete collection.</small>
                            </label>
                          </div>
                          <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="allow_individual_sales" id="galModeOnly_{{ $gallery->id }}" value="0" {{ !($gallery->allow_individual_sales ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label text-white" for="galModeOnly_{{ $gallery->id }}">
                              <strong class="text-warning">Sell ONLY Complete Gallery (No Individual Sales)</strong>
                              <small class="d-block text-muted">Hides individual photo prices. Only the full gallery bundle is offered to customers.</small>
                            </label>
                          </div>

                          <div>
                            <label class="form-label text-white small text-uppercase fw-bold">Complete Gallery Package Price (ZAR)</label>
                            <div class="input-group">
                              <span class="input-group-text bg-dark text-warning border-secondary">R</span>
                              <input type="number" step="0.01" min="0" name="full_gallery_price" class="form-control" value="{{ $gallery->full_gallery_price ?: 450.00 }}">
                            </div>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label class="form-label text-muted small text-uppercase fw-bold">Description</label>
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
        @empty
          <div class="col-12 text-center py-5">
            <div class="p-4 rounded-4" style="background: rgba(255,255,255,0.02); border: 1px dashed rgba(255,255,255,0.15);">
              <i class="bi bi-images fs-1 text-muted mb-3 d-block"></i>
              <h4>No galleries uploaded yet</h4>
              <p class="text-muted">Start creating your portfolio by uploading your first event gallery.</p>
              <a href="{{ route('photographer.upload') }}" class="btn btn-lime rounded-pill px-4 mt-2"><i class="bi bi-plus-lg me-2"></i>Upload your first gallery</a>
            </div>
          </div>
        @endforelse
      </div>

      <div class="mt-4">
        {{ $galleries->links() }}
      </div>
    </section>
  </main>

  @include('web.partials.footer')
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
