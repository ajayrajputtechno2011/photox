@extends('web.layouts.app')

@section('title', 'PhotoX | ' . ($event->title ?? 'Event Gallery'))
@section('body-class', 'page-event-gallery')

@section('styles')
<style>
  .event-gallery-hero {
    background: linear-gradient(180deg, #0b1a29 0%, #060e17 100%);
    color: #fff;
    padding: 44px 0 32px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    position: relative;
    overflow: hidden;
  }
  .event-gallery-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 85% 20%, rgba(255, 138, 0, 0.12) 0%, transparent 60%);
    pointer-events: none;
  }
  .gallery-kicker {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 138, 0, 0.15);
    color: #ff8a00;
    border: 1px solid rgba(255, 138, 0, 0.35);
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    padding: 4px 12px;
    border-radius: 999px;
  }
  .event-gallery-title {
    font-size: clamp(2.2rem, 4.2vw, 3.8rem);
    font-weight: 800;
    letter-spacing: -0.04em;
    line-height: 1.05;
    margin: 12px 0 10px;
    color: #ffffff;
  }
  .event-gallery-title em {
    color: #ff8a00;
    font-style: normal;
  }
  .gallery-meta-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.92rem;
  }
  .gallery-meta-pills span {
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }
  .event-switcher-select {
    background: #0f2238;
    color: #fff;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 999px;
    padding: 8px 18px;
    font-size: 0.88rem;
    font-weight: 600;
  }
  .event-switcher-select:focus {
    background: #142c47;
    color: #fff;
    border-color: #ff8a00;
    box-shadow: 0 0 0 3px rgba(255, 138, 0, 0.25);
    outline: none;
  }

  /* Filter & Discovery Bar */
  .discovery-card {
    background: #ffffff;
    border: 1px solid rgba(11, 45, 91, 0.08);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(11, 45, 91, 0.05);
    padding: 24px;
    margin-top: -24px;
    position: relative;
    z-index: 10;
  }
  .bib-input-wrap {
    position: relative;
  }
  .bib-input-wrap i {
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    color: #64748b;
    font-size: 1.1rem;
  }
  .bib-input-wrap input {
    width: 100%;
    padding: 12px 18px 12px 46px;
    border-radius: 999px;
    border: 1.5px solid #cbd5e1;
    font-size: 0.95rem;
    transition: all 0.2s;
  }
  .bib-input-wrap input:focus {
    border-color: #ff8a00;
    outline: none;
    box-shadow: 0 0 0 4px rgba(255, 138, 0, 0.15);
  }
  .album-pill {
    background: #f1f5f9;
    color: #334155;
    border: 1px solid #e2e8f0;
    border-radius: 999px;
    padding: 6px 14px;
    font-size: 0.84rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
  }
  .album-pill:hover, .album-pill.active {
    background: #ff8a00;
    color: #ffffff;
    border-color: #ff8a00;
  }

  /* Gallery Grid Cards */
  .gallery-photo-card {
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid rgba(11, 45, 91, 0.08);
    box-shadow: 0 4px 16px rgba(11, 45, 91, 0.04);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    cursor: pointer;
  }
  .gallery-photo-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 16px 32px rgba(11, 45, 91, 0.12);
  }
  .photo-stage-wrapper {
    position: relative;
    aspect-ratio: 4 / 3;
    background: #090e17;
    overflow: hidden;
  }
  .photo-stage-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    user-select: none;
    -webkit-user-drag: none;
  }
  .badge-bib-number {
    position: absolute;
    top: 10px;
    left: 10px;
    background: rgba(0, 0, 0, 0.82);
    color: #facc15;
    border: 1px solid rgba(250, 204, 21, 0.6);
    backdrop-filter: blur(4px);
    padding: 3px 9px;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 800;
    letter-spacing: 0.05em;
    z-index: 4;
  }
  .badge-proof-tag {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(0, 0, 0, 0.82);
    color: #ff8a00;
    border: 1px solid rgba(255, 138, 0, 0.6);
    backdrop-filter: blur(4px);
    padding: 3px 9px;
    border-radius: 6px;
    font-size: 0.72rem;
    font-weight: 700;
    z-index: 4;
  }
  .photo-card-info {
    padding: 14px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .photo-card-title {
    font-size: 0.95rem;
    font-weight: 700;
    color: #0b2d5b;
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 190px;
  }
  .photo-card-sub {
    font-size: 0.78rem;
    color: #64748b;
    margin: 2px 0 0;
  }
  .photo-card-price {
    font-size: 0.98rem;
    font-weight: 800;
    color: #0b2d5b;
    text-align: right;
  }

  /* Lightbox Modal */
  .gallery-modal .modal-content {
    background: #080f18;
    color: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 20px;
    overflow: hidden;
  }
  .lightbox-stage {
    background: #03070d;
    border-radius: 12px;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 480px;
    max-height: 68vh;
    overflow: hidden;
  }
  .lightbox-stage img {
    max-width: 100%;
    max-height: 68vh;
    object-fit: contain;
    user-select: none;
    -webkit-user-drag: none;
  }
  .lightbox-ad-container {
    margin-top: 14px;
    background: #0f1c2d;
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 10px;
    overflow: hidden;
    transition: width 0.2s ease;
  }
  .license-box {
    background: #0f1e31;
    border: 1.5px solid rgba(255, 255, 255, 0.14);
    border-radius: 12px;
    padding: 14px 16px;
    cursor: pointer;
    transition: all 0.2s ease;
  }
  .license-box:hover {
    border-color: rgba(255, 138, 0, 0.5);
    background: #14273d;
  }
  .license-box.active {
    border-color: #ff8a00 !important;
    background: rgba(255, 138, 0, 0.12) !important;
    box-shadow: 0 0 0 1px #ff8a00;
  }
  .license-box strong {
    color: #ffffff;
    font-size: 0.98rem;
    font-weight: 700;
  }
  .license-box small {
    color: #cbd5e1 !important;
    font-size: 0.82rem;
    display: block;
    margin-top: 3px;
    line-height: 1.35;
  }
  .watermark-notice-box {
    background: rgba(255, 138, 0, 0.10);
    border: 1px solid rgba(255, 138, 0, 0.35);
    border-radius: 12px;
    padding: 14px;
  }
  .watermark-notice-box small {
    color: #e2e8f0 !important;
    font-size: 0.80rem;
    line-height: 1.45;
  }
  .modal-subtitle-text {
    color: #94a3b8 !important;
    font-size: 0.84rem;
  }
  .modal-section-label {
    color: #f59e0b !important;
    font-size: 0.76rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
  }
</style>
@endsection

@section('content')
  <!-- 1. EVENT HERO HEADER (Clean Cover Image, No Watermark on Header) -->
  <section class="event-gallery-hero">
    <div class="container-xl">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0 small" style="opacity: 0.7;">
          <li class="breadcrumb-item"><a href="/" class="text-white text-decoration-none">Home</a></li>
          <li class="breadcrumb-item"><a href="/events" class="text-white text-decoration-none">Events</a></li>
          <li class="breadcrumb-item active text-warning" aria-current="page">{{ $event->title }}</li>
        </ol>
      </nav>

      <div class="row align-items-center g-4">
        <div class="col-lg-8">
          <div class="gallery-kicker">
            <i class="bi bi-camera-fill"></i> Official Event Gallery
          </div>
          <h1 class="event-gallery-title">{{ $event->title }}</h1>
          
          <div class="gallery-meta-pills mb-3">
            <span><i class="bi bi-geo-alt-fill text-warning"></i> {{ $event->location }}</span>
            <span><i class="bi bi-calendar3 text-info"></i> {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d F Y') : '18 October 2026' }}</span>
            <span><i class="bi bi-images text-success"></i> {{ number_format($photos->count()) }} photos ready</span>
            <span><i class="bi bi-shield-check text-warning"></i> PhotoX Protected</span>
          </div>

          <div class="d-flex align-items-center gap-2 pt-2">
            <span class="small text-muted">Photographer:</span>
            <span class="badge bg-light text-dark fw-bold px-3 py-1" style="font-size: 0.82rem;">
              <i class="bi bi-person-fill me-1"></i> Aiden Daniels
            </span>
            <span class="badge bg-success bg-opacity-75 text-white fw-normal px-2 py-1" style="font-size: 0.78rem;">
              <i class="bi bi-patch-check-fill text-warning me-1"></i> Verified Pro Member
            </span>
          </div>
        </div>

        <!-- Right Side: Event Switcher -->
        <div class="col-lg-4 text-lg-end">
          <label class="d-block small text-muted mb-1 text-uppercase fw-bold">Switch Event Gallery:</label>
          <select class="event-switcher-select" onchange="window.location.href='/dummy-event-gallery?event_id=' + this.value">
            @foreach($otherEvents as $oe)
              <option value="{{ $oe->id }}" {{ $oe->id == $event->id ? 'selected' : '' }}>
                {{ $oe->title }} ({{ $oe->category_name }})
              </option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
  </section>

  <!-- 2. SEARCH & DISCOVERY BAR -->
  <section class="container-xl">
    <div class="discovery-card">
      <div class="row g-3 align-items-center">
        <!-- Bib Search Input -->
        <div class="col-md-6 col-lg-5">
          <div class="bib-input-wrap">
            <i class="bi bi-hash"></i>
            <input type="text" id="bibSearchInput" placeholder="Search by bib number (e.g. 412, 104, 884) or keyword..." oninput="handleGalleryFilter()">
          </div>
        </div>

        <!-- Quick Sub-album Filters -->
        <div class="col-md-6 col-lg-7">
          <div class="d-flex flex-wrap gap-2 justify-content-md-end" id="subAlbumContainer">
            <button class="album-pill active" data-album="all" onclick="filterBySubAlbum('all')">
              All Photos ({{ $photos->count() }})
            </button>
            @php
              $subAlbums = $photos->pluck('sub_album')->filter()->unique();
            @endphp
            @foreach($subAlbums as $sub)
              @php
                $subCount = $photos->where('sub_album', $sub)->count();
              @endphp
              <button class="album-pill" data-album="{{ $sub }}" onclick="filterBySubAlbum('{{ addslashes($sub) }}')">
                {{ $sub }} ({{ $subCount }})
              </button>
            @endforeach
          </div>
        </div>
      </div>

      <!-- Active Filter Status -->
      <div id="filterResultNotice" class="mt-3 pt-3 border-top d-flex align-items-center justify-content-between small d-none">
        <span class="text-muted">Showing <strong id="visibleCount" class="text-dark">{{ $photos->count() }}</strong> matching photos</span>
        <button type="button" class="btn btn-link btn-sm p-0 text-decoration-none text-danger" onclick="resetAllFilters()">
          <i class="bi bi-x-circle me-1"></i> Reset filters
        </button>
      </div>
    </div>
  </section>

  <!-- 3. PHOTO GALLERY GRID -->
  <main class="container-xl py-5">
    <div class="row g-4" id="galleryGrid">
      @forelse($photos as $index => $photo)
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 gallery-photo-col" 
             data-bib="{{ $photo->bib_number ?? '' }}" 
             data-sub="{{ $photo->sub_album ?? '' }}" 
             data-title="{{ strtolower($photo->title) }}">
          <div class="gallery-photo-card h-100" onclick="openLightboxModal({{ $index }})">
            <!-- Stage with Watermarked Image -->
            <div class="photo-stage-wrapper">
              <img src="/protected-photo/{{ $photo->id }}?v={{ time() }}" 
                   alt="{{ $photo->title }}" 
                   loading="lazy">

              @if(!empty($photo->bib_number))
                <span class="badge-bib-number">
                  <i class="bi bi-hash"></i> BIB {{ $photo->bib_number }}
                </span>
              @endif

              <span class="badge-proof-tag">
                <i class="bi bi-shield-lock-fill me-1"></i> PHOTOX PROOF
              </span>
            </div>

            <!-- Card Bottom Info -->
            <div class="photo-card-info">
              <div>
                <h3 class="photo-card-title">{{ $photo->title }}</h3>
                <p class="photo-card-sub">{{ $photo->sub_album ?: 'Event Gallery' }}</p>
              </div>
              <div class="photo-card-price">
                <span class="d-block text-muted" style="font-size: 0.68rem; font-weight: normal;">FROM</span>
                R{{ number_format($photo->personal_price ?? 50, 0) }}
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center py-5">
          <i class="bi bi-images fs-1 text-muted"></i>
          <h4 class="mt-3 text-muted">No photos in this gallery yet</h4>
        </div>
      @endforelse
    </div>

    <!-- Empty Search State -->
    <div id="noResultsBox" class="text-center py-5 d-none">
      <i class="bi bi-search fs-1 text-muted"></i>
      <h4 class="mt-3">No matching photos found</h4>
      <p class="text-muted">Try entering a different bib number or selecting another sub-album.</p>
      <button class="btn btn-outline-primary rounded-pill px-4" onclick="resetAllFilters()">Show All Photos</button>
    </div>
  </main>

  <!-- 4. LIGHTBOX MODAL WITH SPONSOR AD & LICENSE (NO EXIF CLUTTER) -->
  <div class="modal fade gallery-modal" id="photoLightboxModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header border-0 pb-0 pt-3 px-4">
          <div class="d-flex align-items-center gap-2">
            <span class="badge bg-warning text-dark fw-bold" id="modalBibBadge">BIB #412</span>
            <span class="small text-muted" id="modalPhotoCounter">Photo 1 of 12</span>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" onclick="closeLightboxModal()" aria-label="Close" style="cursor: pointer; opacity: 0.95; z-index: 1056; position: relative;"></button>
        </div>

        <div class="modal-body p-4 pt-2">
          <div class="row g-4">
            <!-- Left: Photo Stage + Sponsor Ad -->
            <div class="col-lg-8 text-center">
              <div class="lightbox-stage" id="lightboxStage">
                <img id="modalPreviewImg" src="" alt="Watermarked Preview">
              </div>

              <!-- Sponsor Banner (Width matches preview image) -->
              @php
                $previewAd = \App\Models\Banner::where('is_active', true)->where('placement', 'image_preview')->first();
              @endphp
              <div class="lightbox-ad-container mx-auto" id="lightboxAdBox" style="background: #061019; border: 1px solid rgba(255, 138, 0, 0.25); border-radius: 8px; overflow: hidden; display: flex; align-items: center; justify-content: center; min-height: 55px;">
                @if($previewAd)
                  <a href="{{ $previewAd->link_url ?: '#' }}" target="_blank" class="d-flex align-items-center justify-content-center w-100 position-relative text-decoration-none p-1">
                    <img src="{{ $previewAd->image_url }}" alt="{{ $previewAd->title ?: 'Sponsor Banner' }}" style="max-width: 100%; max-height: 90px; width: auto; height: auto; object-fit: contain; display: block; margin: 0 auto; border-radius: 6px;">
                    @if(!empty($previewAd->badge_text))
                      <span class="position-absolute top-0 end-0 m-1 px-2 py-0 badge bg-dark text-warning border border-warning" style="font-size: 0.60rem; letter-spacing: 0.05em; z-index: 2;">
                        {{ $previewAd->badge_text }}
                      </span>
                    @endif
                  </a>
                @else
                  <a href="/events" class="d-flex align-items-center justify-content-between p-2 px-3 text-decoration-none text-white w-100" style="font-size: 0.82rem;">
                    <span class="badge bg-warning text-dark text-uppercase fw-bold" style="font-size: 0.65rem;">Official Sponsor</span>
                    <span class="fw-semibold">BUILT FOR MORE THAN ROADS · Performance Partner</span>
                    <span class="text-warning">Explore <i class="bi bi-arrow-right"></i></span>
                  </a>
                @endif
              </div>
            </div>

            <!-- Right: Details & License Checkout -->
            <div class="col-lg-4 d-flex flex-column justify-content-between">
              <div>
                <h3 class="h4 fw-bold mb-1 text-white" id="modalPhotoTitle">Finish Line Breakthrough</h3>
                <p class="modal-subtitle-text mb-3" id="modalPhotoSub">Cape Town Marathon · Aiden Daniels</p>

                <!-- License Selection -->
                <div class="mb-4">
                  <label class="modal-section-label mb-2 d-block text-warning small fw-bold text-uppercase" style="letter-spacing: 0.06em; color: #f59e0b !important;">SELECT USAGE LICENSE:</label>
                  
                  <!-- Personal -->
                  <div class="license-box active mb-2" id="licPersonal" onclick="selectLicense('personal', 50)">
                    <div class="d-flex justify-content-between align-items-center">
                      <div>
                        <strong class="d-block text-white" style="color: #ffffff !important; font-size: 0.98rem; font-weight: 700;">Personal License</strong>
                        <small class="d-block mt-1" style="color: #cbd5e1 !important; font-size: 0.82rem; line-height: 1.35;">Social media, mobile wallpaper, personal print</small>
                      </div>
                      <span class="fw-bold fs-5 text-warning">R50.00</span>
                    </div>
                  </div>

                  <!-- Commercial -->
                  <div class="license-box" id="licCommercial" onclick="selectLicense('commercial', 250)">
                    <div class="d-flex justify-content-between align-items-center">
                      <div>
                        <strong class="d-block text-white" style="color: #ffffff !important; font-size: 0.98rem; font-weight: 700;">Commercial License</strong>
                        <small class="d-block mt-1" style="color: #cbd5e1 !important; font-size: 0.82rem; line-height: 1.35;">Editorial, website, sponsor &amp; brand marketing</small>
                      </div>
                      <span class="fw-bold fs-5" style="color: #4ade80 !important;">R250.00</span>
                    </div>
                  </div>
                </div>

                <!-- Anti-Theft Watermark Notice -->
                <div class="watermark-notice-box mb-4">
                  <div class="d-flex gap-2 align-items-start">
                    <i class="bi bi-shield-lock-fill text-warning fs-5 mt-1"></i>
                    <small style="color: #e2e8f0 !important; font-size: 0.82rem; line-height: 1.45; display: block;">
                      Preview is protected with PhotoX digital watermarking. Purchased digital files are delivered in clean original high-resolution without watermarks.
                    </small>
                  </div>
                </div>
              </div>

              <!-- Modal Bottom Actions -->
              <div>
                <div class="d-flex gap-2 mb-3">
                  <button type="button" class="btn btn-outline-light rounded-pill flex-fill" onclick="prevPhoto()">
                    <i class="bi bi-chevron-left me-1"></i> Prev
                  </button>
                  <button type="button" class="btn btn-outline-light rounded-pill flex-fill" onclick="nextPhoto()">
                    Next <i class="bi bi-chevron-right ms-1"></i>
                  </button>
                </div>

                <button type="button" class="btn btn-lime rounded-pill w-100 py-3 fw-bold fs-6" onclick="addToCartCurrentPhoto()">
                  <i class="bi bi-cart-plus me-1"></i> Add to Cart · <span id="modalBuyPrice">R50.00</span>
                </button>
                <button type="button" class="btn btn-outline-secondary rounded-pill w-100 py-2 mt-2 text-white" onclick="closeLightboxModal()" style="border-color: rgba(255,255,255,0.25); font-size: 0.85rem;">
                  <i class="bi bi-x-circle me-1"></i> Close / Cancel
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
  const galleryData = @json($photos->values());
  let currentIndex = 0;
  let currentSelectedLicense = 'personal';
  let currentSelectedPrice = 50;

  function filterBySubAlbum(album) {
    document.querySelectorAll('.album-pill').forEach(btn => {
      btn.classList.toggle('active', btn.dataset.album === album);
    });
    handleGalleryFilter();
  }

  function handleGalleryFilter() {
    const activePill = document.querySelector('.album-pill.active');
    const selectedAlbum = activePill ? activePill.dataset.album : 'all';
    const bibQuery = document.getElementById('bibSearchInput').value.trim().toLowerCase();

    let visibleCount = 0;
    const cards = document.querySelectorAll('.gallery-photo-col');

    cards.forEach(card => {
      const cardBib = (card.dataset.bib || '').toLowerCase();
      const cardSub = card.dataset.sub || '';
      const cardTitle = card.dataset.title || '';

      const matchAlbum = (selectedAlbum === 'all' || cardSub === selectedAlbum);
      const matchBib = (!bibQuery || cardBib.includes(bibQuery) || cardTitle.includes(bibQuery));

      if (matchAlbum && matchBib) {
        card.classList.remove('d-none');
        visibleCount++;
      } else {
        card.classList.add('d-none');
      }
    });

    const notice = document.getElementById('filterResultNotice');
    const noResults = document.getElementById('noResultsBox');
    const countEl = document.getElementById('visibleCount');

    if (bibQuery !== '' || selectedAlbum !== 'all') {
      notice.classList.remove('d-none');
      countEl.textContent = visibleCount;
    } else {
      notice.classList.add('d-none');
    }

    if (visibleCount === 0) {
      noResults.classList.remove('d-none');
    } else {
      noResults.classList.add('d-none');
    }
  }

  function resetAllFilters() {
    document.getElementById('bibSearchInput').value = '';
    filterBySubAlbum('all');
  }

  function openLightboxModal(index) {
    currentIndex = index;
    const photo = galleryData[index];
    if (!photo) return;

    const modalImg = document.getElementById('modalPreviewImg');
    modalImg.src = '/protected-photo/' + photo.id;
    
    document.getElementById('modalPhotoTitle').textContent = photo.title;
    document.getElementById('modalPhotoSub').textContent = (photo.sub_album || 'Event Gallery') + ' · ' + (photo.photographer_name || 'Aiden Daniels');
    document.getElementById('modalPhotoCounter').textContent = `Photo ${index + 1} of ${galleryData.length}`;
    
    const bibBadge = document.getElementById('modalBibBadge');
    if (photo.bib_number) {
      bibBadge.textContent = 'BIB #' + photo.bib_number;
      bibBadge.style.display = 'inline-block';
    } else {
      bibBadge.style.display = 'none';
    }

    selectLicense('personal', 50);

    const modalEl = document.getElementById('photoLightboxModal');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    modal.show();

    // Sync sponsor ad banner width with preview photo
    modalImg.onload = syncModalAdWidth;
    setTimeout(syncModalAdWidth, 200);
  }

  function closeLightboxModal() {
    const modalEl = document.getElementById('photoLightboxModal');
    if (modalEl) {
      try {
        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.hide();
      } catch(err) {
        console.warn('Modal hide warning:', err);
      }
      setTimeout(() => {
        modalEl.classList.remove('show');
        modalEl.style.display = 'none';
        document.body.classList.remove('modal-open');
        document.body.style.removeProperty('padding-right');
        document.body.style.removeProperty('overflow');
        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
      }, 120);
    }
  }

  function syncModalAdWidth() {
    const modalImg = document.getElementById('modalPreviewImg');
    const adBox = document.getElementById('lightboxAdBox');
    if (modalImg && adBox && modalImg.clientWidth > 100) {
      adBox.style.width = modalImg.clientWidth + 'px';
    }
  }

  window.addEventListener('resize', syncModalAdWidth);

  document.addEventListener('keydown', function(e) {
    const modalEl = document.getElementById('photoLightboxModal');
    if (!modalEl || !modalEl.classList.contains('show')) return;

    if (e.key === 'ArrowRight') {
      e.preventDefault();
      nextPhoto();
    } else if (e.key === 'ArrowLeft') {
      e.preventDefault();
      prevPhoto();
    } else if (e.key === 'Escape' || e.key === 'Esc') {
      e.preventDefault();
      closeLightboxModal();
    }
  });

  function prevPhoto() {
    if (currentIndex > 0) {
      openLightboxModal(currentIndex - 1);
    } else {
      openLightboxModal(galleryData.length - 1);
    }
  }

  function nextPhoto() {
    if (currentIndex < galleryData.length - 1) {
      openLightboxModal(currentIndex + 1);
    } else {
      openLightboxModal(0);
    }
  }

  // Keyboard navigation
  document.addEventListener('keydown', (e) => {
    const modalEl = document.getElementById('photoLightboxModal');
    if (modalEl && modalEl.classList.contains('show')) {
      if (e.key === 'ArrowLeft') prevPhoto();
      if (e.key === 'ArrowRight') nextPhoto();
    }
  });

  function selectLicense(type, price) {
    currentSelectedLicense = type;
    currentSelectedPrice = price;
    document.getElementById('licPersonal').classList.toggle('active', type === 'personal');
    document.getElementById('licCommercial').classList.toggle('active', type === 'commercial');
    document.getElementById('modalBuyPrice').textContent = `R${price}.00`;
  }

  function addToCartCurrentPhoto() {
    const photo = galleryData[currentIndex];
    const cartCounter = document.querySelector('.header-cart span');
    if (cartCounter) {
      let count = parseInt(cartCounter.textContent.trim()) || 0;
      cartCounter.textContent = count + 1;
    }

    const toastEl = document.getElementById('photoToast');
    if (toastEl) {
      toastEl.querySelector('span').textContent = `Added "${photo.title}" (${currentSelectedLicense} license) to cart!`;
      const toast = new bootstrap.Toast(toastEl);
      toast.show();
    }

    const modal = bootstrap.Modal.getInstance(document.getElementById('photoLightboxModal'));
    if (modal) modal.hide();
  }
</script>
@endsection
