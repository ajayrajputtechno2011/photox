@extends('web.layouts.app')

@section('title', 'PhotoX | ' . ($event->title ?? 'Event Gallery'))
@section('body-class', 'page-event-gallery bg-light')

@section('styles')
<style>
  /* 1. Event Gallery Header Bar */
  .event-top-bar {
    background: #091724;
    color: #fff;
    padding: 24px 0 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }
  .event-back-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    text-decoration: none;
    transition: background 0.2s;
  }
  .event-back-btn:hover {
    background: #ff8a00;
    color: #07131f;
  }

  /* 2. Find Your Photos Card (Matching ZebraSnap Screenshot 1) */
  .find-photos-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 16px rgba(11, 45, 91, 0.05);
    margin: 28px 0 24px;
  }
  .search-method-tab {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 18px;
    border-radius: 999px;
    font-size: 0.88rem;
    font-weight: 600;
    cursor: pointer;
    border: 1px solid transparent;
    transition: all 0.2s;
  }
  .search-method-tab.active {
    background: #a3e635;
    color: #0f172a;
    border-color: #84cc16;
  }
  .search-method-tab:not(.active) {
    background: #f1f5f9;
    color: #475569;
  }

  /* 3. Event Gallery Photo Grid (Matching ZebraSnap Screenshot 2 & 4) */
  .photo-gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
  }
  .event-photo-card {
    position: relative;
    border-radius: 14px;
    overflow: hidden;
    background: #0f172a;
    aspect-ratio: 4 / 3;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
    cursor: pointer;
    transition: transform 0.25s cubic-bezier(0.2, 0.8, 0.2, 1), box-shadow 0.25s;
  }
  .event-photo-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.22);
  }
  .event-photo-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    user-select: none !important;
    -webkit-user-drag: none !important;
  }

  /* Watermark grid overlay */
  .anti-theft-overlay {
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 50% 50%, transparent 60%, rgba(0,0,0,0.3) 100%);
    pointer-events: none;
    z-index: 3;
  }

  /* Card Header Pills */
  .card-avatar-pill {
    position: absolute;
    top: 10px;
    left: 10px;
    width: 34px;
    height: 34px;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid #ffffff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    z-index: 5;
    pointer-events: none;
  }
  .card-avatar-pill img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .card-price-pill {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(15, 23, 42, 0.88);
    color: #ffffff;
    font-size: 0.78rem;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 8px;
    backdrop-filter: blur(4px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    z-index: 5;
    pointer-events: none;
  }

  /* Bottom flag */
  .card-flag-btn {
    position: absolute;
    bottom: 10px;
    right: 10px;
    background: rgba(15, 23, 42, 0.75);
    color: rgba(255, 255, 255, 0.75);
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.82rem;
    border: none;
    z-index: 5;
    transition: all 0.2s;
  }
  .card-flag-btn:hover {
    color: #ff8a00;
    background: rgba(15, 23, 42, 0.95);
  }

  /* Hover Overlay Controls (Matching ZebraSnap Screenshot 4) */
  .card-hover-actions {
    position: absolute;
    inset: 0;
    background: rgba(15, 23, 42, 0.45);
    backdrop-filter: blur(2px);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 12px;
    opacity: 0;
    transition: opacity 0.25s ease;
    z-index: 4;
  }
  .event-photo-card:hover .card-hover-actions {
    opacity: 1;
  }
  .hover-action-row {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .hover-circle-btn {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.92);
    color: #0f172a;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    transition: transform 0.2s, background 0.2s;
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
  }
  .hover-circle-btn:hover {
    transform: scale(1.1);
    background: #ffffff;
    color: #ff8a00;
  }
  .hover-cart-btn {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #a3e635;
    color: #0f172a;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    transition: transform 0.2s;
    box-shadow: 0 4px 12px rgba(163, 230, 53, 0.4);
  }
  .hover-cart-btn:hover {
    transform: scale(1.12);
    background: #84cc16;
  }

  /* 4. Fullscreen Dark Lightbox / Inspector (Matching ZebraSnap Screenshots 3 & 5) */
  #zebraLightboxModal .modal-dialog {
    max-width: 100vw !important;
    width: 100vw !important;
    height: 100vh !important;
    margin: 0 !important;
  }
  #zebraLightboxModal .modal-content {
    height: 100vh !important;
    border-radius: 0 !important;
    background: #080c12 !important;
    color: #ffffff;
    display: flex;
    flex-direction: column;
  }
  .lightbox-topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 24px;
    background: #04070b;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    z-index: 10;
  }
  .lightbox-stage {
    flex: 1;
    display: flex;
    overflow: hidden;
    position: relative;
  }
  .lightbox-image-container {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #000000;
    padding: 16px;
    position: relative;
    overflow: hidden;
  }
  .lightbox-image-container img {
    max-height: 80vh;
    max-width: 100%;
    object-fit: contain;
    display: block;
    border-radius: 6px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.8);
    user-select: none !important;
    -webkit-user-drag: none !important;
  }
  .lightbox-sidebar {
    width: 360px;
    background: #0c121a;
    border-left: 1px solid rgba(255, 255, 255, 0.08);
    padding: 28px 24px;
    overflow-y: auto;
  }
  .lightbox-bottombar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 24px;
    background: #04070b;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    z-index: 10;
  }
  .btn-lime {
    background: #a3e635 !important;
    color: #0f172a !important;
    border: none !important;
    font-weight: 700 !important;
  }
  .btn-lime:hover {
    background: #84cc16 !important;
  }

  /* License Option Selector Card Styling (Matching Image 2 Prototype) */
  .license-option-card {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 14px;
    border-radius: 10px;
    background: rgba(15, 23, 42, 0.6);
    border: 1px solid rgba(255, 255, 255, 0.12);
    cursor: pointer;
    transition: all 0.2s ease;
  }
  .license-option-card:hover {
    background: rgba(15, 23, 42, 0.9);
    border-color: rgba(255, 138, 0, 0.4);
  }
  .license-option-card.active {
    background: rgba(255, 138, 0, 0.12);
    border-color: #ff8a00 !important;
    box-shadow: 0 0 0 1px #ff8a00;
  }

  /* MOBILE RESPONSIVE LIGHTBOX (Screens under 992px) - Fixes Squeezed Photo Bug */
  @media (max-width: 991.98px) {
    #zebraLightboxModal .lightbox-topbar {
      padding: 10px 14px !important;
      flex-wrap: nowrap !important;
      gap: 10px;
    }
    #zebraLightboxModal .lightbox-topbar .btn-group {
      display: none !important; /* Hide desktop zoom buttons on mobile; native pinch-to-zoom is supported */
    }
    #zebraLightboxModal .lightbox-stage {
      flex-direction: column !important;
      overflow-y: auto !important;
      -webkit-overflow-scrolling: touch;
      flex: 1 1 auto;
    }
    #zebraLightboxModal .lightbox-image-container {
      width: 100% !important;
      min-height: 280px !important;
      max-height: 50vh !important;
      height: 48vh !important;
      flex: 0 0 auto !important;
      padding: 10px 8px !important;
      background: #000000 !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      position: relative !important;
    }
    #zebraLightboxModal .lightbox-image-container img {
      max-height: 100% !important;
      max-width: 100% !important;
      width: auto !important;
      height: auto !important;
      object-fit: contain !important;
      display: block !important;
      margin: 0 auto !important;
    }
    #zebraLightboxModal .lightbox-sidebar {
      width: 100% !important;
      max-width: 100% !important;
      border-left: none !important;
      border-top: 1px solid rgba(255, 255, 255, 0.12) !important;
      padding: 20px 16px 28px !important;
      overflow-y: visible !important;
      flex: 1 0 auto !important;
      background: #0c121a !important;
    }
    #zebraLightboxModal .lightbox-bottombar {
      padding: 10px 14px !important;
      flex-wrap: wrap !important;
      gap: 10px;
    }
    #zebraLightboxModal .lightbox-bottombar > .d-flex:first-child {
      display: none !important; /* Hide duplicate avatar pill to give full space to cart button */
    }
    #zebraLightboxModal .lightbox-bottombar > .d-flex:last-child {
      width: 100% !important;
      justify-content: space-between !important;
    }
    #zebraLightboxModal #lbAddToCartBtn {
      flex: 1 !important;
      text-align: center !important;
      padding: 10px 14px !important;
      font-size: 0.95rem !important;
    }
  }

  /* Toast for Right-Click Defense */
  .toast-protection {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 99999;
  }
</style>
@endsection

@section('content')
<main oncontextmenu="triggerProtectionToast(event); return false;">

  <!-- 1. EVENT GALLERY HEADER BAR -->
  <section class="event-top-bar">
    <div class="container-xl">
      <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
          <a href="/#latest-events" class="event-back-btn" title="Back to Events">
            <i class="bi bi-arrow-left fs-5"></i>
          </a>
          <div>
            <h1 class="h3 fw-bold text-white mb-0">{{ $event->title }}</h1>
            <p class="text-white-50 small mb-0 mt-1">
              @php
                $evPhotographer = $event->photographer ?? ($photos->first()?->photographer ?? null);
              @endphp
              <i class="bi bi-camera me-1 text-warning"></i>
              @if($evPhotographer)
                <a href="{{ route('photographers.show', $evPhotographer->id) }}" class="text-warning text-decoration-none fw-semibold">
                  {{ $evPhotographer->name }}
                </a>
              @else
                <span>{{ $event->photographer_name ?? ($photos->first()?->photographer_name ?? 'PhotoX Pro') }}</span>
              @endif
              &nbsp;·&nbsp; 
              <i class="bi bi-calendar-event me-1"></i> {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d M, Y') : 'Oct 6, 2026' }}
              &nbsp;·&nbsp; 
              <i class="bi bi-geo-alt me-1"></i> {{ $event->location ?? 'Cape Town, South Africa' }}
            </p>
          </div>
        </div>

        <div class="d-flex align-items-center gap-2">
          <a href="/#latest-events" class="btn btn-lime rounded-pill btn-sm px-3">
            All Events <i class="bi bi-arrow-right ms-1"></i>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- 2. MAIN GALLERY CONTAINER -->
  <div class="container-xl py-4">

    <!-- SPONSORED PARTNER BANNER PLACEMENT (Matching Client Screenshot) -->
    @php
      $eventPartnerAd = $sponsorBanner ?? \App\Models\Banner::where('is_active', true)->where('placement', 'image_preview')->first();
    @endphp
    @if($eventPartnerAd)
    <aside class="site-ad-banner mb-4" aria-label="Sponsored placement">
      <a class="site-ad-link" href="{{ $eventPartnerAd->link_url ?: '#' }}">
        <img src="{{ $eventPartnerAd->image_url }}" alt="{{ $eventPartnerAd->title ?: 'Sponsored Partner' }}">
        <span class="site-ad-overlay"></span>
        <span class="site-ad-copy">
          <small>{{ $eventPartnerAd->badge_text ?: 'PHOTOX PARTNER' }}</small>
          <strong>{!! !empty($eventPartnerAd->title) ? nl2br(e($eventPartnerAd->title)) : 'BUILT FOR MORE<br>THAN ROADS' !!}</strong>
          <span>Explore events <i class="bi bi-arrow-up-right"></i></span>
        </span>
      </a>
    </aside>
    @endif

    <!-- FIND YOUR PHOTOS TOOLBAR (Search by Bib Number) -->
    <div class="find-photos-card">
      <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
        <div>
          <h5 class="fw-bold text-dark mb-1">Find your photos</h5>
          <span class="text-muted small">Filter captures by athlete bib number or selfie</span>
        </div>
        <div class="d-flex align-items-center gap-2 flex-column flex-sm-row justify-content-md-end flex-shrink-0">
          <div class="input-group" style="width: 270px;">
            <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control border-start-0" id="bibSearchInput" placeholder="Bib search..." onkeyup="filterPhotosByBib(this.value)">
            <button class="btn btn-dark px-3 fw-semibold" type="button" onclick="filterPhotosByBib(document.getElementById('bibSearchInput').value)">Search</button>
          </div>
          <button type="button" class="btn btn-lime rounded-pill px-3 py-2 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm text-nowrap" style="height: 38px;" onclick="openSelfieSearchModal()">
            <i class="bi bi-camera-fill"></i>
            <span>Search by Selfie</span>
          </button>
        </div>
      </div>
    </div>

    <!-- GALLERY SUBHEADER & VIEW CONTROLS (Matching ZebraSnap Screenshot 2) -->
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
      <div>
        <h2 class="h4 fw-bold text-dark mb-0">
          <span id="photoCountDisplay">{{ number_format($event->total_photos > 0 ? $event->total_photos : $photos->count()) }}</span> photos
        </h2>
        <span class="text-muted small">High-resolution event captures protected by PhotoX server watermarking</span>
      </div>

      <div class="d-flex align-items-center gap-2">
        <div class="btn-group btn-group-sm" role="group">
          <button type="button" class="btn btn-outline-secondary active" onclick="setGridColumns(4)"><i class="bi bi-grid-3x3-gap-fill"></i></button>
          <button type="button" class="btn btn-outline-secondary" onclick="setGridColumns(3)"><i class="bi bi-grid-fill"></i></button>
        </div>
        <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-3 dropdown-toggle" data-bs-toggle="dropdown">
          <i class="bi bi-funnel me-1"></i> Filters
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow">
          <li><a class="dropdown-item" href="javascript:void(0)" onclick="filterPhotosByBib('')">Show All Photos</a></li>
          <li><a class="dropdown-item" href="javascript:void(0)" onclick="filterPhotosBySubAlbum('Start Line')">Start Line</a></li>
          <li><a class="dropdown-item" href="javascript:void(0)" onclick="filterPhotosBySubAlbum('Course Action')">Course Action</a></li>
          <li><a class="dropdown-item" href="javascript:void(0)" onclick="filterPhotosBySubAlbum('Finish Arch')">Finish Arch</a></li>
        </ul>
      </div>
    </div>

    <!-- 3. PHOTO GALLERY GRID (Matching ZebraSnap Screenshot 2 & 4) -->
    <div class="photo-gallery-grid" id="eventPhotosGrid">
      @forelse($photos as $photo)
        <div class="event-photo-card" 
             data-index="{{ $loop->index }}" 
             data-bib="{{ $photo->bib_number ?? '' }}" 
             data-title="{{ $photo->title }}"
             onclick="openZebraLightbox({{ $loop->index }})">
          
          <!-- Protected Watermarked Image -->
          <img src="/protected-photo/{{ $photo->id }}" 
               alt="{{ $photo->title }}" 
               loading="lazy" 
               draggable="false">

          <!-- Watermark security gradient & pattern overlay -->
          <div class="anti-theft-overlay"></div>

          <!-- Top-Left: Photographer Avatar Circle -->
          <div class="card-avatar-pill" title="{{ $photo->photographer?->name ?? ($event->photographer?->name ?? 'PhotoX Creator') }}">
            <img src="{{ $photo->photographer?->avatar ?: ($event->photographer?->avatar ?: asset('logo.png')) }}" alt="{{ $photo->photographer?->name ?? ($event->photographer?->name ?? 'Photographer') }}" style="{{ ($photo->photographer?->avatar || $event->photographer?->avatar) ? '' : 'background: #0b1a29; padding: 2px; object-fit: contain;' }}">
          </div>

          <!-- Top-Right: Price Tag (Matching Screenshot 2: e.g. R50.00) -->
          <span class="card-price-pill">
            R{{ number_format($photo->personal_price ?: 50, 2) }}
          </span>

          <!-- Bottom-Right Flag Button -->
          <button class="card-flag-btn" type="button" title="Flag photo" onclick="event.stopPropagation(); alert('Photo reported for review.');">
            <i class="bi bi-flag"></i>
          </button>

          <!-- Hover Overlay Controls (Matching ZebraSnap Screenshot 4) -->
          <div class="card-hover-actions">
            <span class="text-white small fw-bold mb-1 px-3 py-1 rounded bg-dark bg-opacity-75">
              {{ $photo->title ?: 'Event Action' }}
            </span>
            <div class="hover-action-row">
              <button type="button" class="hover-circle-btn" title="Add to wishlist" onclick="event.stopPropagation(); toggleWishlist(this);">
                <i class="bi bi-heart"></i>
              </button>
              <button type="button" class="hover-circle-btn" title="Inspect Photo" onclick="event.stopPropagation(); openZebraLightbox({{ $loop->index }});">
                <i class="bi bi-search"></i>
              </button>
              <button type="button" class="hover-circle-btn" title="Share" onclick="event.stopPropagation(); shareSinglePhoto({{ $photo->id }});">
                <i class="bi bi-share"></i>
              </button>
              <button type="button" class="hover-cart-btn" title="Add to cart" onclick="event.stopPropagation(); quickAddToCart({{ $photo->id }});">
                <i class="bi bi-cart3"></i>
              </button>
            </div>
            @if(!empty($photo->bib_number))
              <span class="badge bg-warning text-dark font-monospace mt-1">BIB #{{ $photo->bib_number }}</span>
            @endif
          </div>
        </div>
      @empty
        <div class="col-12 py-5 text-center text-muted">
          <i class="bi bi-camera-fill text-warning display-4 mb-3 d-block"></i>
          <h4>Photos are currently uploading for this event</h4>
          <p>Official photographers are currently processing watermarked proofs. Check back shortly.</p>
        </div>
      @endforelse
    </div>

  </div>

  <!-- 4. FULLSCREEN DARK LIGHTBOX / INSPECTOR (Matching ZebraSnap Screenshots 3 & 5) -->
  <div class="modal fade p-0" id="zebraLightboxModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">

        <!-- Top Bar: Close, Creator Info, Zoom, Navigation -->
        <div class="lightbox-topbar">
          <div class="d-flex align-items-center gap-3">
            <button type="button" class="btn btn-outline-light rounded-circle p-2" data-bs-dismiss="modal" style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
              <i class="bi bi-x-lg"></i>
            </button>
            <div class="d-flex align-items-center gap-2">
              <div class="rounded-circle border border-warning d-flex align-items-center justify-content-center bg-dark overflow-hidden shadow-sm" style="width: 36px; height: 36px; min-width: 36px;">
                <img src="{{ $event->photographer?->avatar ?: asset('logo.png') }}" 
                     alt="Creator" 
                     id="lbPhotographerAvatar"
                     style="width: 100%; height: 100%; object-fit: contain; padding: {{ $event->photographer?->avatar ? '0' : '4px' }};">
              </div>
              <div>
                <strong class="d-block text-white small" id="lbPhotographerName">{{ $event->photographer?->name ?? ($photos->first()?->photographer_name ?? 'Aiden Daniels') }}</strong>
                <span class="text-white-50" style="font-size: 0.70rem;" id="lbPhotographerBadge">{{ $event->photographer?->effective_badge_heading ?? 'Verified Creator' }}</span>
              </div>
            </div>
          </div>

          <div class="d-flex align-items-center gap-3">
            <!-- Zoom buttons -->
            <div class="btn-group btn-group-sm">
              <button type="button" class="btn btn-outline-secondary text-white" onclick="zoomLightbox(-0.15)"><i class="bi bi-zoom-out"></i></button>
              <button type="button" class="btn btn-outline-secondary text-white" onclick="zoomLightbox(0.15)"><i class="bi bi-zoom-in"></i></button>
            </div>

            <!-- Previous / Next Counter (e.g. < 1 / 2008 >) -->
            <div class="d-flex align-items-center gap-2 font-monospace text-white small">
              <button type="button" class="btn btn-sm btn-outline-secondary text-white" onclick="prevLightboxPhoto()">
                <i class="bi bi-chevron-left"></i>
              </button>
              <span id="lbCounterDisplay">1 / {{ $photos->count() }}</span>
              <button type="button" class="btn btn-sm btn-outline-secondary text-white" onclick="nextLightboxPhoto()">
                <i class="bi bi-chevron-right"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Center Stage: Photo & Details Sidebar -->
        <div class="lightbox-stage">
          <!-- Main Photo Viewer Container -->
          <div class="lightbox-image-container">
            <img id="lbMainImage" 
                 src="" 
                 alt="Event Photo" 
                 draggable="false" 
                 oncontextmenu="triggerProtectionToast(event); return false;">

            <!-- SPONSOR BANNER (Bottom of Photo Preview - Mobile & Desktop) -->
            @php
              $previewAd = $sponsorBanner ?? \App\Models\Banner::where('is_active', true)->where('placement', 'image_preview')->first();
            @endphp
            @if($previewAd)
              <div class="position-absolute bottom-0 start-50 translate-middle-x mb-2 px-3 py-1 rounded-3 d-flex align-items-center gap-2 gap-md-3 shadow-lg" 
                   style="background: rgba(6, 16, 25, 0.94); border: 1px solid rgba(255, 138, 0, 0.4); max-width: 95%; z-index: 15; backdrop-filter: blur(8px);">
                <span class="badge bg-warning text-dark font-monospace text-uppercase" style="font-size: 0.60rem;">
                  {{ $previewAd->badge_text ?: 'Sponsor' }}
                </span>
                <a href="{{ $previewAd->link_url ?: '#' }}" target="_blank" class="d-inline-flex align-items-center gap-2 text-white text-decoration-none">
                  @if(!empty($previewAd->image_url))
                    <img src="{{ $previewAd->image_url }}" alt="{{ $previewAd->title ?: 'Sponsor' }}" style="height: 30px; width: auto; max-width: 120px; object-fit: contain; border-radius: 4px;">
                  @endif
                  <span class="small fw-semibold text-truncate" style="max-width: 220px; font-size: 0.78rem;">{{ $previewAd->title ?: 'Built for more than roads' }}</span>
                  <i class="bi bi-box-arrow-up-right text-warning small ms-1"></i>
                </a>
              </div>
            @endif
          </div>

          <!-- Right Details Sidebar (Matching Screenshot 3 & 5) -->
          <div class="lightbox-sidebar">
            <!-- 1. SELECT USAGE LICENSE (Prominently Placed at the Top) -->
            <div class="mb-4">
              <span class="text-warning small fw-bold text-uppercase d-flex align-items-center gap-1 mb-2" style="letter-spacing: 0.08em; font-size: 0.75rem;">
                <i class="bi bi-tag-fill me-1"></i> SELECT USAGE LICENSE
              </span>
              <div class="d-flex flex-column gap-2">
                <div class="license-option-card active" id="licenseOptPersonal" onclick="setLightboxLicense('personal')">
                  <div class="d-flex align-items-center gap-2">
                    <input type="radio" name="lb_license_choice" value="personal" checked style="accent-color: #ff8a00; transform: scale(1.15);">
                    <div>
                      <strong class="text-white d-block small">Personal License</strong>
                      <span class="text-white-50 d-block" style="font-size: 0.70rem;">Social media, phone wallpaper, personal prints</span>
                    </div>
                  </div>
                  <strong class="text-warning fs-6" id="lbPersonalPriceTag">R50.00</strong>
                </div>

                <div class="license-option-card" id="licenseOptCommercial" onclick="setLightboxLicense('commercial')">
                  <div class="d-flex align-items-center gap-2">
                    <input type="radio" name="lb_license_choice" value="commercial" style="accent-color: #a3e635; transform: scale(1.15);">
                    <div>
                      <strong class="text-white d-block small">Commercial License</strong>
                      <span class="text-white-50 d-block" style="font-size: 0.70rem;">Marketing, brand sponsorships, editorial publishing</span>
                    </div>
                  </div>
                  <strong class="text-success fs-6" id="lbCommercialPriceTag">R250.00</strong>
                </div>
              </div>
            </div>

            <!-- 2. SPONSOR BANNER PLACEMENT (Sidebar) -->
            @if($previewAd)
              <div class="mb-4 p-2 rounded bg-dark bg-opacity-75 border border-secondary border-opacity-25 text-center">
                <span class="d-block text-white-50 text-uppercase fw-semibold mb-1" style="font-size: 0.65rem; letter-spacing: 0.08em;">
                  {{ $previewAd->badge_text ?? 'Official Event Sponsor' }}
                </span>
                <a href="{{ $previewAd->link_url ?: '#' }}" target="_blank" class="d-block text-decoration-none">
                  <img src="{{ $previewAd->image_url }}" alt="{{ $previewAd->title ?: 'Sponsor' }}" class="img-fluid rounded" style="max-height: 75px; object-fit: contain;">
                  @if(!empty($previewAd->title))
                    <div class="text-white small fw-bold mt-1 text-truncate">{{ $previewAd->title }}</div>
                  @endif
                </a>
              </div>
            @endif

            <!-- 3. WHAT'S INCLUDED -->
            <div class="mb-4 pt-2 border-top border-secondary border-opacity-25">
              <span class="text-warning small fw-bold text-uppercase" style="letter-spacing: 0.08em; font-size: 0.75rem;">
                WHAT'S INCLUDED
              </span>
              <ul class="list-unstyled mt-2 mb-0">
                <li class="d-flex align-items-center gap-2 text-white small py-1">
                  <i class="bi bi-check2 text-success fs-5"></i> Instant download
                </li>
                <li class="d-flex align-items-center gap-2 text-white small py-1">
                  <i class="bi bi-check2 text-success fs-5"></i> Highest available resolution
                </li>
                <li class="d-flex align-items-center gap-2 text-white small py-1">
                  <i class="bi bi-check2 text-success fs-5"></i> Clean original master without watermarks
                </li>
              </ul>
            </div>

            <!-- 4. DETAILS -->
            <div class="pt-3 border-top border-secondary border-opacity-25 mb-3">
              <span class="text-warning small fw-bold text-uppercase" style="letter-spacing: 0.08em; font-size: 0.75rem;">
                DETAILS
              </span>
              <div class="mt-2 text-white-50 small">
                <div class="d-flex justify-content-between py-1 border-bottom border-dark">
                  <span>File</span>
                  <strong class="text-white" id="lbMetaFile">IMG_9998.jpg</strong>
                </div>
                <div class="d-flex justify-content-between py-1 border-bottom border-dark">
                  <span>Resolution</span>
                  <strong class="text-white" id="lbMetaResolution">1667 × 2500</strong>
                </div>
                <div class="d-flex justify-content-between py-1 border-bottom border-dark">
                  <span>Size</span>
                  <strong class="text-white" id="lbMetaSize">1.96 MB</strong>
                </div>
                <div class="d-flex justify-content-between py-1 border-bottom border-dark">
                  <span>Event</span>
                  <strong class="text-white text-truncate ms-2" id="lbMetaEvent">{{ $event->title }}</strong>
                </div>
                <div class="d-flex justify-content-between py-1 border-bottom border-dark">
                  <span>Bib Number</span>
                  <strong class="text-warning" id="lbMetaBib">Not Assigned</strong>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Bottom Bar: Person Icon, Wishlist, Share, Add to Cart (Matching Screenshot 3 & 5) -->
        <div class="lightbox-bottombar">
          <div class="d-flex align-items-center gap-2">
            <div class="rounded-circle bg-dark border border-secondary border-opacity-50 d-flex align-items-center justify-content-center p-1" style="width: 28px; height: 28px;">
              <img src="{{ asset('logo.png') }}" 
                   class="rounded-circle" 
                   style="width: 100%; height: 100%; object-fit: contain;">
            </div>
            <span class="text-white-50 small" id="lbPersonCount">1 person in the photo</span>
          </div>

          <div class="d-flex align-items-center gap-3">
            <button type="button" class="btn btn-outline-secondary text-white rounded-circle" style="width: 38px; height: 38px;" onclick="toggleWishlist(this)">
              <i class="bi bi-heart"></i>
            </button>
            <button type="button" class="btn btn-outline-secondary text-white rounded-circle" style="width: 38px; height: 38px;" onclick="shareCurrentModalPhoto()">
              <i class="bi bi-share"></i>
            </button>
            <button type="button" class="btn btn-outline-secondary text-white rounded-circle" style="width: 38px; height: 38px;" onclick="alert('Multi-layer security: clean master delivered upon license purchase.')">
              <i class="bi bi-info-circle"></i>
            </button>
            <button type="button" class="btn btn-outline-secondary text-white rounded-circle" style="width: 38px; height: 38px;" onclick="alert('Photo flagged for review.')">
              <i class="bi bi-flag"></i>
            </button>

            <!-- Lime Green Cart Button (Matching Screenshot 3 & 5) -->
            <button type="button" class="btn btn-lime rounded-3 px-4 py-2 fs-6 shadow" id="lbAddToCartBtn" onclick="triggerPurchase()">
              <i class="bi bi-cart-fill me-1"></i> Add to cart - R50.00
            </button>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- 5. TOAST NOTIFICATION FOR RIGHT-CLICK THEFT PROTECTION -->
  <div class="toast-protection">
    <div class="toast align-items-center text-white bg-dark border border-warning shadow-lg" id="eventProtectedToast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body d-flex align-items-center gap-2">
          <i class="bi bi-shield-fill-exclamation text-warning fs-5"></i>
          <span><strong>PhotoX Anti-Theft Defense:</strong> Right-click image saving is disabled. Watermarked master is protected.</span>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>

  <!-- 6. SELFIE SEARCH MODAL -->
  <div class="modal fade" id="selfieSearchModal" tabindex="-1" aria-labelledby="selfieSearchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-4 shadow-lg border-0 overflow-hidden" style="background: #0f172a; color: #fff;">
        <div class="modal-header border-bottom border-secondary border-opacity-25 py-3 px-4">
          <div class="d-flex align-items-center gap-2">
            <div class="p-2 rounded-circle bg-warning bg-opacity-25 text-warning">
              <i class="bi bi-camera-fill fs-5"></i>
            </div>
            <div>
              <h5 class="modal-title fw-bold text-white mb-0" id="selfieSearchModalLabel">Find Photos by Selfie</h5>
              <span class="text-white-50 small">PhotoX AI Face & Bib Recognition</span>
            </div>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" onclick="stopSelfieCamera()"></button>
        </div>
        
        <div class="modal-body p-4 text-center">
          <!-- State 1: Choose Option -->
          <div id="selfieInitialState">
            <p class="text-white-50 small mb-4">
              Take a quick selfie or upload a photo from your device. Our AI will scan all event captures to find every shot of you.
            </p>

            <div class="row g-3">
              <div class="col-6">
                <button type="button" class="btn btn-outline-light w-100 p-3 rounded-3 d-flex flex-column align-items-center gap-2 border-secondary border-opacity-50 h-100" onclick="startSelfieCamera()">
                  <i class="bi bi-webcam fs-1 text-warning"></i>
                  <span class="fw-semibold">Take a Selfie</span>
                  <small class="text-white-50" style="font-size: 0.72rem;">Use device camera</small>
                </button>
              </div>
              <div class="col-6">
                <label for="selfieFileInput" class="btn btn-outline-light w-100 p-3 rounded-3 d-flex flex-column align-items-center gap-2 border-secondary border-opacity-50 h-100 mb-0" style="cursor: pointer;">
                  <i class="bi bi-cloud-arrow-up fs-1 text-success"></i>
                  <span class="fw-semibold">Upload Photo</span>
                  <small class="text-white-50" style="font-size: 0.72rem;">From phone / PC</small>
                </label>
                <input type="file" id="selfieFileInput" accept="image/*" class="d-none" onchange="handleSelfieFileSelect(this)">
              </div>
            </div>
          </div>

          <!-- State 2: Camera View -->
          <div id="selfieCameraState" class="d-none">
            <div class="position-relative rounded-3 overflow-hidden bg-black mb-3" style="aspect-ratio: 4/3;">
              <video id="selfieVideo" autoplay playsinline class="w-100 h-100 object-fit-cover"></video>
              <canvas id="selfieCanvas" class="d-none"></canvas>
              <div class="position-absolute top-50 start-50 translate-middle border border-2 border-warning rounded-circle" style="width: 140px; height: 180px; opacity: 0.6; pointer-events: none;"></div>
            </div>
            <div class="d-flex justify-content-center gap-2">
              <button type="button" class="btn btn-secondary rounded-pill px-3" onclick="stopSelfieCamera()">Cancel</button>
              <button type="button" class="btn btn-warning rounded-pill px-4 fw-bold" onclick="captureSelfieFromCamera()">
                <i class="bi bi-camera me-1"></i> Capture & Search
              </button>
            </div>
          </div>

          <!-- State 3: AI Scanning Animation -->
          <div id="selfieScanningState" class="d-none py-4">
            <div class="spinner-border text-warning mb-3" style="width: 3rem; height: 3rem;" role="status">
              <span class="visually-hidden">Scanning...</span>
            </div>
            <h6 class="text-white fw-bold mb-1">Scanning Event Gallery with AI...</h6>
            <p class="text-white-50 small mb-0">Analyzing facial landmarks & athlete bib numbers across {{ $photos->count() }} event captures.</p>
          </div>

          <!-- State 4: Match Result -->
          <div id="selfieResultState" class="d-none py-2 text-start">
            <div class="alert alert-success bg-success bg-opacity-25 border-success text-white d-flex align-items-center gap-2 py-2 mb-3">
              <i class="bi bi-check-circle-fill text-success fs-5"></i>
              <span class="small" id="selfieMatchText">Matches found in this event!</span>
            </div>
            <div class="d-flex justify-content-end gap-2">
              <button type="button" class="btn btn-outline-light rounded-pill btn-sm px-3" onclick="resetSelfieModal()">Search Again</button>
              <button type="button" class="btn btn-lime rounded-pill btn-sm px-4 fw-semibold" data-bs-dismiss="modal">View Results</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>
@endsection

@section('scripts')
<script>
  // All photos loaded from server
  const rawEventPhotos = @json($photos);
  let currentEventPhotos = [...rawEventPhotos];
  let currentPhotoIndex = 0;
  let currentZoom = 1;

  // Trigger Anti-Theft Toast on Right-Click Attempt
  function triggerProtectionToast(e) {
    if (e) {
      e.preventDefault();
      e.stopPropagation();
    }
    const toastEl = document.getElementById('eventProtectedToast');
    if (toastEl) {
      const toast = bootstrap.Toast.getOrCreateInstance(toastEl, { delay: 3500 });
      toast.show();
    }
  }

  // Dynamic License Selection (Matching Prototype Screenshot 2)
  let currentLicenseChoice = 'personal';

  function setLightboxLicense(type) {
    currentLicenseChoice = type;
    const photo = (currentEventPhotos && currentEventPhotos[currentPhotoIndex]) ? currentEventPhotos[currentPhotoIndex] : {};
    const personalPrice = parseFloat(photo.personal_price || 50).toFixed(2);
    const commercialPrice = parseFloat(photo.commercial_price || 250).toFixed(2);
    const chosenPrice = type === 'commercial' ? commercialPrice : personalPrice;

    const cartBtn = document.getElementById('lbAddToCartBtn');
    if (cartBtn) {
      cartBtn.innerHTML = `<i class="bi bi-cart-fill me-1"></i> Add to cart - R${chosenPrice}`;
    }

    document.querySelectorAll('.license-option-card').forEach(el => el.classList.remove('active'));
    const targetCard = document.getElementById(type === 'commercial' ? 'licenseOptCommercial' : 'licenseOptPersonal');
    if (targetCard) targetCard.classList.add('active');

    const radio = document.querySelector(`input[name="lb_license_choice"][value="${type}"]`);
    if (radio) radio.checked = true;
  }

  // Open the Lightbox modal (matching Screenshots 3 & 5)
  function openZebraLightbox(index) {
    if (!currentEventPhotos || currentEventPhotos.length === 0) return;
    
    if (index < 0) index = currentEventPhotos.length - 1;
    if (index >= currentEventPhotos.length) index = 0;

    currentPhotoIndex = index;
    const photo = currentEventPhotos[currentPhotoIndex];
    currentZoom = 1;

    // Load watermarked image without cache buster for ultra-fast browser caching
    const mainImg = document.getElementById('lbMainImage');
    mainImg.style.transform = 'scale(1)';
    mainImg.src = `/protected-photo/${photo.id}`;

    // Update Counter
    document.getElementById('lbCounterDisplay').textContent = `${currentPhotoIndex + 1} / ${currentEventPhotos.length}`;

    // Update Sidebar Meta
    document.getElementById('lbPhotographerName').textContent = photo.photographer_name || 'Aiden Daniels';
    const avatarEl = document.getElementById('lbPhotographerAvatar');
    if (avatarEl) {
      avatarEl.src = photo.photographer_avatar || '{{ asset("logo.png") }}';
    }
    document.getElementById('lbMetaFile').textContent = photo.original_name || `IMG_${photo.id + 9000}.jpg`;
    document.getElementById('lbMetaResolution').textContent = photo.dimensions || '1667 × 2500';
    document.getElementById('lbMetaSize').textContent = photo.file_size || '1.96 MB';
    document.getElementById('lbMetaBib').textContent = photo.bib_number ? `#${photo.bib_number}` : 'Not Assigned';
    
    const personalPrice = parseFloat(photo.personal_price || 50).toFixed(2);
    const commercialPrice = parseFloat(photo.commercial_price || 250).toFixed(2);

    const personalTag = document.getElementById('lbPersonalPriceTag');
    if (personalTag) personalTag.textContent = `R${personalPrice}`;

    const commercialTag = document.getElementById('lbCommercialPriceTag');
    if (commercialTag) commercialTag.textContent = `R${commercialPrice}`;

    setLightboxLicense(currentLicenseChoice || 'personal');

    if (photo.bib_number) {
      document.getElementById('lbPersonCount').textContent = `Bib #${photo.bib_number} detected in frame`;
    } else {
      document.getElementById('lbPersonCount').textContent = '1 person in the photo';
    }

    const modalEl = document.getElementById('zebraLightboxModal');
    const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
    modalInstance.show();
  }

  function nextLightboxPhoto() {
    if (currentEventPhotos.length <= 1) return;
    openZebraLightbox((currentPhotoIndex + 1) % currentEventPhotos.length);
  }

  function prevLightboxPhoto() {
    if (currentEventPhotos.length <= 1) return;
    openZebraLightbox((currentPhotoIndex - 1 + currentEventPhotos.length) % currentEventPhotos.length);
  }

  function zoomLightbox(delta) {
    currentZoom = Math.max(0.6, Math.min(2.5, currentZoom + delta));
    const mainImg = document.getElementById('lbMainImage');
    if (mainImg) {
      mainImg.style.transform = `scale(${currentZoom})`;
      mainImg.style.transition = 'transform 0.2s ease';
    }
  }

  // Keyboard navigation
  document.addEventListener('keydown', function(e) {
    const modalEl = document.getElementById('zebraLightboxModal');
    if (!modalEl || !modalEl.classList.contains('show')) return;

    if (e.key === 'ArrowRight') {
      e.preventDefault();
      nextLightboxPhoto();
    } else if (e.key === 'ArrowLeft') {
      e.preventDefault();
      prevLightboxPhoto();
    } else if (e.key === 'Escape' || e.key === 'Esc') {
      e.preventDefault();
      const modalInstance = bootstrap.Modal.getInstance(modalEl);
      if (modalInstance) modalInstance.hide();
    }
  });

  // Filter photos by Bib Number input
  function filterPhotosByBib(query) {
    const cards = document.querySelectorAll('.event-photo-card');
    let visibleCount = 0;
    const cleanQuery = query.trim().toLowerCase();

    cards.forEach(card => {
      const bib = (card.getAttribute('data-bib') || '').toLowerCase();
      const title = (card.getAttribute('data-title') || '').toLowerCase();
      if (!cleanQuery || bib.includes(cleanQuery) || title.includes(cleanQuery)) {
        card.style.display = '';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    document.getElementById('photoCountDisplay').textContent = visibleCount;
  }

  function filterPhotosBySubAlbum(albumName) {
    filterPhotosByBib(albumName);
  }

  function setGridColumns(cols) {
    const grid = document.getElementById('eventPhotosGrid');
    if (cols === 3) {
      grid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(350px, 1fr))';
    } else {
      grid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(280px, 1fr))';
    }
  }

  function toggleWishlist(btn) {
    const icon = btn.querySelector('i');
    if (icon.classList.contains('bi-heart')) {
      icon.className = 'bi bi-heart-fill text-danger';
    } else {
      icon.className = 'bi bi-heart';
    }
  }

  function quickAddToCart(photoId) {
    alert('Photo #' + photoId + ' added to cart. Clean high-resolution unwatermarked file ready for download upon checkout.');
  }

  function triggerPurchase() {
    alert('License checkout initialized. In production, this completes payment and delivers the original uncompressed master without watermark.');
  }

  function shareEvent() {
    if (navigator.share) {
      navigator.share({
        title: document.title,
        url: window.location.href
      });
    } else {
      navigator.clipboard.writeText(window.location.href);
      alert('Event gallery link copied to clipboard!');
    }
  }

  function shareSinglePhoto(id) {
    const link = window.location.origin + '/protected-photo/' + id;
    navigator.clipboard.writeText(window.location.href);
    alert('Photo link copied to clipboard!');
  }

  function shareCurrentModalPhoto() {
    if (currentEventPhotos[currentPhotoIndex]) {
      shareSinglePhoto(currentEventPhotos[currentPhotoIndex].id);
    }
  }

  // --- Selfie Search Modal Handlers ---
  let selfieStream = null;

  function openSelfieSearchModal() {
    resetSelfieModal();
    const modalEl = document.getElementById('selfieSearchModal');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    modal.show();
  }

  function resetSelfieModal() {
    stopSelfieCamera();
    document.getElementById('selfieInitialState').classList.remove('d-none');
    document.getElementById('selfieCameraState').classList.add('d-none');
    document.getElementById('selfieScanningState').classList.add('d-none');
    document.getElementById('selfieResultState').classList.add('d-none');
  }

  function startSelfieCamera() {
    document.getElementById('selfieInitialState').classList.add('d-none');
    document.getElementById('selfieCameraState').classList.remove('d-none');

    const video = document.getElementById('selfieVideo');
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
      navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } })
        .then(function(stream) {
          selfieStream = stream;
          video.srcObject = stream;
        })
        .catch(function(err) {
          console.warn('Camera error:', err);
          alert('Could not access camera. Please use the "Upload Photo" option.');
          resetSelfieModal();
        });
    } else {
      alert('Camera access is not supported by your browser.');
      resetSelfieModal();
    }
  }

  function stopSelfieCamera() {
    if (selfieStream) {
      selfieStream.getTracks().forEach(track => track.stop());
      selfieStream = null;
    }
    const video = document.getElementById('selfieVideo');
    if (video) video.srcObject = null;
  }

  function captureSelfieFromCamera() {
    stopSelfieCamera();
    simulateSelfieScan();
  }

  function handleSelfieFileSelect(input) {
    if (input.files && input.files[0]) {
      simulateSelfieScan();
    }
  }

  function simulateSelfieScan() {
    document.getElementById('selfieInitialState').classList.add('d-none');
    document.getElementById('selfieCameraState').classList.add('d-none');
    document.getElementById('selfieScanningState').classList.remove('d-none');

    setTimeout(() => {
      document.getElementById('selfieScanningState').classList.add('d-none');
      document.getElementById('selfieResultState').classList.remove('d-none');
      
      // Filter gallery to show matched athlete photos
      const matchCount = Math.min(currentEventPhotos.length, 6);
      document.getElementById('selfieMatchText').textContent = `AI Matched ${matchCount} photos featuring you in this event!`;
      
      // Show first matched photos in grid
      const cards = document.querySelectorAll('.event-photo-card');
      cards.forEach((card, idx) => {
        if (idx < matchCount) {
          card.style.display = '';
        } else {
          card.style.display = 'none';
        }
      });
      document.getElementById('photoCountDisplay').textContent = matchCount;
    }, 1400);
  }
</script>
@endsection
