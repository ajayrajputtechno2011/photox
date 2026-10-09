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

  /* Responsive Scaling for High-Security Photo Inspector Modal (Matching Client Approved Reference) */
  #photoInspectorModal .modal-dialog {
    width: 95vw !important;
    max-width: 1580px !important;
    margin: 1.5rem auto !important;
  }

  @media (min-width: 1400px) {
    #photoInspectorModal .modal-dialog {
      width: 92vw !important;
      max-width: 1720px !important;
    }
    #photoInspectorModal .modal-photo-col {
      flex: 0 0 68% !important;
      max-width: 68% !important;
    }
    #photoInspectorModal .modal-info-col {
      flex: 0 0 32% !important;
      max-width: 32% !important;
    }
  }

  @media (min-width: 992px) and (max-width: 1399.98px) {
    #photoInspectorModal .modal-dialog {
      width: 94vw !important;
      max-width: 1380px !important;
    }
    #photoInspectorModal .modal-photo-col {
      flex: 0 0 65% !important;
      max-width: 65% !important;
    }
    #photoInspectorModal .modal-info-col {
      flex: 0 0 35% !important;
      max-width: 35% !important;
    }
  }

  #photoInspectorModal .modal-photo-col {
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    justify-content: center !important;
    min-height: 520px !important;
    padding: 1.5rem !important;
    background: #02070d !important;
    position: relative !important;
  }

  #photoInspectorModal #modalPhotoContainer {
    position: relative !important;
    display: inline-block !important;
    max-height: 60vh !important;
    max-width: 100% !important;
    width: auto !important;
    height: auto !important;
    margin: 0 auto !important;
    line-height: 0 !important;
    overflow: hidden !important;
    border-radius: 8px !important;
    text-align: center !important;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7) !important;
  }

  #photoInspectorModal #modalPhotoImg {
    max-height: 60vh !important;
    max-width: 100% !important;
    width: auto !important;
    height: auto !important;
    display: block !important;
    object-fit: contain !important;
    border-radius: 8px !important;
    margin: 0 auto !important;
  }

  #photoInspectorModal .image-preview-ad-wrapper {
    max-height: 110px !important;
    width: 100%;
    max-width: 100%;
    transition: width 0.15s ease;
    margin: 12px auto 0 !important;
  }

  #photoInspectorModal .image-preview-ad-wrapper img {
    width: 100% !important;
    max-height: 95px !important;
    object-fit: cover !important;
    display: block;
    border-radius: 8px;
  }

  #photoInspectorModal #modalSecurityInfoBar {
    max-width: 100%;
    transition: width 0.15s ease;
    margin: 12px auto 0 !important;
  }

  /* Anti-AI Opposing Triangle Frosted Shield (Professional 3.5px Soft Glass Filter) */
  .anti-ai-triangle-blur-wrap {
    position: absolute;
    inset: 0;
    pointer-events: none;
    z-index: 15;
    overflow: hidden;
    clip-path: polygon(100% 0, 100% 100%, 0 100%);
    transition: clip-path 0.22s cubic-bezier(0.2, 0.8, 0.2, 1);
    display: block;
    border-radius: 8px;
  }
  .anti-ai-blurred-img {
    width: 100%;
    height: 100%;
    object-fit: fill;
    display: block;
    filter: blur(3.5px) contrast(1.05) brightness(0.98);
    pointer-events: none;
    user-select: none;
  }
  .anti-ai-diagonal-svg {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 16;
  }
  .anti-ai-shield-tag {
    position: absolute;
    font-size: 0.68rem;
    font-weight: 600;
    letter-spacing: 0.03em;
    padding: 4px 12px;
    border-radius: 20px;
    background: rgba(7, 19, 31, 0.82);
    color: #e2e8f0;
    border: 1px solid rgba(255, 138, 0, 0.45);
    backdrop-filter: blur(6px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.35);
    pointer-events: none;
    transition: all 0.25s ease;
    white-space: nowrap;
    z-index: 17;
  }

  /* WaterMotion Liquid Glass Dynamic Lens Layers */
  .wm-motion-mask-layer {
    position: absolute;
    inset: 0;
    pointer-events: none;
    overflow: hidden;
    z-index: 14;
    display: none;
  }
  .wm-motion-mask-layer.active {
    display: block;
  }
  .wm-water-lens {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
  }
  .wm-water-lens-primary {
    width: 180px; height: 180px;
    top: 25%; left: 30%;
    animation: waterMotionFloat1 9s ease-in-out infinite;
  }
  .wm-water-lens-secondary {
    width: 140px; height: 140px;
    top: 55%; left: 55%;
    animation: waterMotionFloat2 12s ease-in-out infinite;
  }
  .wm-lens-inner-glass {
    position: absolute;
    inset: 0;
    border-radius: 50%;
    background: radial-gradient(circle at 35% 30%, rgba(255, 255, 255, 0.35) 0%, rgba(255, 255, 255, 0.08) 50%, rgba(56, 189, 248, 0.12) 75%, rgba(255, 255, 255, 0.3) 100%);
    backdrop-filter: blur(1.5px) contrast(1.18) saturate(1.22) brightness(1.06);
    -webkit-backdrop-filter: blur(1.5px) contrast(1.18) saturate(1.22) brightness(1.06);
    border: 2px solid rgba(255, 255, 255, 0.85);
    box-shadow: 
      inset 0 0 25px rgba(255, 255, 255, 0.6),
      inset 3px 5px 16px rgba(255, 255, 255, 0.95),
      inset -2px -4px 14px rgba(186, 230, 253, 0.45),
      0 14px 38px rgba(0, 0, 0, 0.28),
      0 0 16px rgba(56, 189, 248, 0.35);
  }
  .wm-lens-glint {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
  }
  .wm-lens-glint-top {
    top: 8%; left: 14%; width: 46%; height: 28%;
    background: radial-gradient(ellipse at 40% 30%, rgba(255, 255, 255, 0.98) 0%, rgba(255, 255, 255, 0.6) 45%, rgba(255, 255, 255, 0) 80%);
    transform: rotate(-32deg);
    filter: blur(0.5px);
  }
  .wm-lens-glint-bottom {
    bottom: 11%; right: 15%; width: 34%; height: 18%;
    background: radial-gradient(ellipse at center, rgba(255, 255, 255, 0.7) 0%, rgba(255, 255, 255, 0.25) 50%, rgba(255, 255, 255, 0) 80%);
    transform: rotate(-18deg);
    filter: blur(0.5px);
  }
  .wm-lens-ring {
    position: absolute;
    inset: 3px;
    border-radius: 50%;
    border: 1px solid rgba(255, 255, 255, 0.4);
    opacity: 0.85;
    pointer-events: none;
  }
  .wm-water-ripple-layer {
    position: absolute;
    top: 50%; left: 50%; width: 100%; height: 100%;
    transform: translate(-50%, -50%);
    pointer-events: none;
  }
  .wm-ripple-ring {
    position: absolute;
    top: 50%; left: 50%;
    border-radius: 50%;
    border: 2px solid rgba(255, 255, 255, 0.6);
    box-shadow: 0 0 16px rgba(56, 189, 248, 0.4), inset 0 0 16px rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%) scale(0.2);
    opacity: 0;
    pointer-events: none;
  }
  .wm-ripple-ring.ring-1 {
    width: 260px; height: 260px;
    animation: rippleWave 4s cubic-bezier(0.25, 1, 0.5, 1) infinite;
  }
  .wm-ripple-ring.ring-2 {
    width: 260px; height: 260px;
    animation: rippleWave 4s cubic-bezier(0.25, 1, 0.5, 1) infinite 1.35s;
  }
  .wm-ripple-ring.ring-3 {
    width: 260px; height: 260px;
    animation: rippleWave 4s cubic-bezier(0.25, 1, 0.5, 1) infinite 2.7s;
  }
  @keyframes rippleWave {
    0% { transform: translate(-50%, -50%) scale(0.2); opacity: 0.9; }
    70% { opacity: 0.35; }
    100% { transform: translate(-50%, -50%) scale(2.2); opacity: 0; }
  }
  @keyframes waterMotionFloat1 {
    0% { transform: translate(0, 0) scale(1) rotate(0deg); }
    25% { transform: translate(75px, -45px) scale(1.06) rotate(4deg); }
    50% { transform: translate(110px, 40px) scale(0.96) rotate(-3deg); }
    75% { transform: translate(-60px, 55px) scale(1.05) rotate(5deg); }
    100% { transform: translate(-30px, -35px) scale(0.98) rotate(-4deg); }
  }
  @keyframes waterMotionFloat2 {
    0% { transform: translate(0, 0) scale(1) rotate(0deg); }
    33% { transform: translate(-80px, -55px) scale(1.08) rotate(-5deg); }
    66% { transform: translate(55px, -30px) scale(0.94) rotate(4deg); }
    100% { transform: translate(30px, 65px) scale(1.05) rotate(-3deg); }
  }

  /* MOBILE RESPONSIVE LIGHTBOX (Screens under 992px) */
  @media (max-width: 991.98px) {
    #photoInspectorModal .modal-dialog {
      margin: 0.5rem auto !important;
      width: 98vw !important;
    }
    #photoInspectorModal .modal-photo-col {
      min-height: auto !important;
      padding: 1rem !important;
    }
    #photoInspectorModal #modalPhotoContainer {
      max-height: 48vh !important;
    }
    #photoInspectorModal #modalPhotoImg {
      max-height: 48vh !important;
    }
    #photoInspectorModal .modal-info-col {
      border-left: none !important;
      border-top: 1px solid #1a3248 !important;
      padding: 1.25rem !important;
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

  <!-- 4. HIGH-SECURITY PHOTO INSPECTOR MODAL (Matching Client Approved Reference) -->
  <div class="modal fade" id="photoInspectorModal" tabindex="-1" aria-labelledby="modalPhotoTitle" aria-hidden="true" style="backdrop-filter: blur(8px);">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content border-0 shadow-2xl" style="background: #07131f; color: #fff; border-radius: 18px; overflow: hidden; border: 1px solid #1c354d !important;">
        
        <!-- Modal Top Bar -->
        <div class="modal-header border-bottom border-secondary border-opacity-25 px-4 py-3" style="background: #040c14;">
          <div class="d-flex align-items-center gap-2 flex-wrap">
            <span class="badge" style="background: #ff8a00; color: #fff; font-size: 0.72rem; text-transform: uppercase;">
              <i class="bi bi-shield-check me-1"></i> Anti-Theft Watermark
            </span>
            <h5 class="modal-title fs-6 fw-bold mb-0 text-white" id="modalPhotoTitle">Beach Sprint Splash</h5>
            <span class="badge bg-dark border border-secondary text-warning font-monospace" id="modalIndexCounter">Photo 1 of {{ $photos->count() }}</span>

            <!-- Anti-AI Triangle Blur Live Toggle -->
            <button type="button" id="toggleAntiAiBlurBtn" class="btn btn-sm btn-outline-warning rounded-pill px-2 py-0 ms-md-2" style="font-size: 0.72rem; height: 26px;" onclick="toggleAntiAiBlur()" title="Toggle Opposing Triangle Anti-AI Blur Mask">
              <i class="bi bi-shield-slash-fill me-1"></i> Anti-AI Blur: <span id="antiAiBlurStateText" class="fw-bold">ON</span>
            </button>

            <!-- WaterMotion Live Toggle -->
            <button type="button" id="toggleWaterMotionBtn" class="btn btn-sm {{ ($watermarkSetting->is_motion_mask_enabled ?? false) ? 'btn-outline-info' : 'btn-outline-secondary' }} rounded-pill px-2 py-0" style="font-size: 0.72rem; height: 26px;" onclick="toggleWaterMotion()" title="Toggle WaterMotion Dynamic Liquid Glass Lens">
              <i class="bi bi-droplet-half me-1"></i> WaterMotion: <span id="waterMotionStateText" class="fw-bold">{{ ($watermarkSetting->is_motion_mask_enabled ?? false) ? 'ON' : 'OFF' }}</span>
            </button>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" onclick="closePhotoInspectorModal()" aria-label="Close" style="cursor: pointer; opacity: 0.95; z-index: 1056; position: relative;"></button>
        </div>

        <div class="modal-body p-0">
          <div class="row g-0">
            <!-- Left: Watermarked Image Viewer with Floating Next / Previous Buttons -->
            <div class="col-lg-7 modal-photo-col d-flex flex-column align-items-center justify-content-center p-3 p-md-4 position-relative" style="background: #02070d; min-height: 560px;">
              
              <!-- Anti-theft Protected Photo Frame -->
              <div class="position-relative overflow-hidden rounded-3 shadow" id="modalPhotoContainer" style="display: inline-block; line-height: 0; margin: 0 auto; max-height: 62vh; max-width: 100%; position: relative;">
                
                <!-- The Server-Watermarked Image -->
                <img id="modalPhotoImg" 
                     src="" 
                     alt="Photo Preview" 
                     class="img-fluid rounded" 
                     style="max-height: 62vh; max-width: 100%; width: auto; height: auto; object-fit: contain; display: block; margin: 0 auto;" 
                     draggable="false" 
                     oncontextmenu="triggerProtectionToast(event); return false;">

                <!-- 1. WaterMotion Liquid Glass Lenses & Fluid Waves -->
                <div class="wm-motion-mask-layer {{ ($watermarkSetting->is_motion_mask_enabled ?? false) ? 'active' : '' }}" id="modalWaterMotionLayer">
                  <div class="wm-water-lens wm-water-lens-primary" id="modalWaterLens1">
                    <div class="wm-lens-inner-glass"></div>
                    <div class="wm-lens-glint wm-lens-glint-top"></div>
                    <div class="wm-lens-glint wm-lens-glint-bottom"></div>
                    <div class="wm-lens-ring"></div>
                  </div>
                  <div class="wm-water-lens wm-water-lens-secondary" id="modalWaterLens2">
                    <div class="wm-lens-inner-glass"></div>
                    <div class="wm-lens-glint wm-lens-glint-top"></div>
                    <div class="wm-lens-ring"></div>
                  </div>
                  <div class="wm-water-ripple-layer">
                    <div class="wm-ripple-ring ring-1"></div>
                    <div class="wm-ripple-ring ring-2"></div>
                    <div class="wm-ripple-ring ring-3"></div>
                  </div>
                </div>

                <!-- 2. Interactive Anti-AI Opposing Triangle Blur Mask (Diagonal BD) -->
                <div id="antiAiTriangleBlurLayer" class="anti-ai-triangle-blur-wrap active">
                  <img id="modalPhotoImgBlur" 
                       src="" 
                       alt="Anti-AI Blurred Layer" 
                       class="anti-ai-blurred-img" 
                       draggable="false">
                  <svg class="anti-ai-diagonal-svg" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <line x1="100" y1="0" x2="0" y2="100" stroke="rgba(255, 138, 0, 0.45)" stroke-width="0.8" stroke-dasharray="4, 4" />
                  </svg>
                  <div class="anti-ai-shield-tag" id="antiAiShieldTag" style="bottom: 16px; right: 16px;">
                    <i class="bi bi-shield-check text-warning me-1"></i> <span id="antiAiShieldTagText">Anti-AI Frosted Shield · Hover to Reveal</span>
                  </div>
                </div>

                <!-- 3. Invisible Transparent Shield Overlay -->
                <div class="position-absolute top-0 start-0 w-100 h-100" 
                     id="modalTransparentShield"
                     style="z-index: 18; background: transparent; cursor: crosshair;" 
                     oncontextmenu="triggerProtectionToast(event); return false;" 
                     ondragstart="return false;" 
                     onselectstart="return false;">
                </div>

                <!-- Floating PREVIOUS Button -->
                <button type="button" 
                        class="btn position-absolute top-50 start-0 translate-middle-y ms-2 rounded-circle d-flex align-items-center justify-content-center shadow-lg modal-nav-btn" 
                        id="modalPrevBtn"
                        onclick="prevLightboxPhoto()" 
                        title="Previous Photo (Left Arrow Key)"
                        style="width: 44px; height: 44px; background: rgba(13, 30, 46, 0.85); color: #fff; border: 1.5px solid rgba(255,138,0,0.5); backdrop-filter: blur(6px); z-index: 25; transition: all 0.2s;">
                  <i class="bi bi-chevron-left fs-5"></i>
                </button>

                <!-- Floating NEXT Button -->
                <button type="button" 
                        class="btn position-absolute top-50 end-0 translate-middle-y me-2 rounded-circle d-flex align-items-center justify-content-center shadow-lg modal-nav-btn" 
                        id="modalNextBtn"
                        onclick="nextLightboxPhoto()" 
                        title="Next Photo (Right Arrow Key)"
                        style="width: 44px; height: 44px; background: rgba(13, 30, 46, 0.85); color: #fff; border: 1.5px solid rgba(255,138,0,0.5); backdrop-filter: blur(6px); z-index: 25; transition: all 0.2s;">
                  <i class="bi bi-chevron-right fs-5"></i>
                </button>

                <!-- Watermark corner emblem -->
                <div class="position-absolute bottom-0 start-0 m-3 px-2 py-1 rounded" style="background: rgba(0,0,0,0.75); color: #ff8a00; font-size: 0.72rem; font-weight: 700; z-index: 19; pointer-events: none;">
                  <i class="bi bi-shield-lock me-1"></i> PHOTOX PROOF · ANTI-THEFT
                </div>
              </div>

              <!-- Security Info Notification below preview -->
              <div class="mt-3 px-3 py-2 rounded text-center" id="modalSecurityInfoBar" style="background: rgba(255,138,0,0.08); border: 1px dashed rgba(255,138,0,0.35); font-size: 0.76rem; color: #cbd5e1; width: 100%;">
                <i class="bi bi-shield-fill-check text-warning me-1"></i>
                <strong>Multi-Layer Defense Active:</strong> Server watermark + <strong>Anti-AI Opposing Triangle Blur</strong> (Hover blurred part to reveal) + <strong>WaterMotion Floating Glass Caustics</strong>. Clean master restricted to licensed purchase.
              </div>

              <!-- Keyboard navigation hint -->
              <div class="text-muted small mt-2 d-none d-md-block" style="font-size: 0.72rem;">
                <kbd class="bg-dark text-warning border border-secondary px-1">←</kbd> Previous Photo &nbsp;|&nbsp; 
                <kbd class="bg-dark text-warning border border-secondary px-1">→</kbd> Next Photo &nbsp;|&nbsp; 
                <kbd class="bg-dark text-warning border border-secondary px-1">Esc</kbd> Close
              </div>

              <!-- SPONSOR BANNER (Placement: Image Preview - Wide Banner Requested by Client) -->
              @php
                $previewAd = \App\Models\Banner::where('is_active', true)->where('placement', 'image_preview')->first() ?: ($sponsorBanner ?? null);
              @endphp
              <div class="mt-3 image-preview-ad-wrapper mx-auto" id="modalPreviewAdWrapper" style="position: relative; overflow: hidden; border-radius: 8px; border: 1px solid rgba(255, 138, 0, 0.25); background: #061019; width: 100%; display: flex; align-items: center; justify-content: center; min-height: 60px;">
                @if($previewAd)
                  <a href="{{ $previewAd->link_url ?: '#' }}" target="_blank" class="d-flex align-items-center justify-content-center w-100 position-relative text-decoration-none p-1" style="display: flex;">
                    <img src="{{ $previewAd->image_url }}" alt="{{ $previewAd->title ?: 'Sponsor Banner' }}" style="max-width: 100%; max-height: 90px; width: auto; height: auto; object-fit: contain; display: block; margin: 0 auto; border-radius: 6px;">
                    @if(!empty($previewAd->badge_text))
                      <span class="position-absolute top-0 end-0 m-1 px-2 py-0 badge bg-dark text-warning border border-warning" style="font-size: 0.60rem; letter-spacing: 0.05em; z-index: 2;">
                        {{ $previewAd->badge_text }}
                      </span>
                    @endif
                    @if(!empty($previewAd->title))
                      <div class="position-absolute bottom-0 start-0 w-100 px-3 py-1 text-white text-truncate" style="background: linear-gradient(0deg, rgba(0,0,0,0.85), transparent); font-size: 0.78rem; z-index: 2;">
                        <strong>{{ $previewAd->title }}</strong>
                        @if(!empty($previewAd->subtitle))
                          <span class="text-white-50 ms-2" style="font-size: 0.70rem;">{{ $previewAd->subtitle }}</span>
                        @endif
                      </div>
                    @endif
                  </a>
                @else
                  <div class="p-2 d-flex align-items-center justify-content-center text-muted" style="min-height: 60px; font-size: 0.75rem;">
                    <span><i class="bi bi-award text-warning me-1"></i> <strong>Official Event Sponsor</strong></span>
                  </div>
                @endif
              </div>
            </div>

            <!-- Right: Commercial Pricing & License Panel -->
            <div class="col-lg-5 modal-info-col p-4 d-flex flex-column justify-content-between" style="background: #091724; border-left: 1px solid #1a3248;">
              <div>
                
                <!-- License Usage Selector (Commercial vs Personal) -->
                <div class="mb-4 p-3 rounded" style="background: #0c1e30; border: 1px solid #1e3e5c;">
                  <label class="form-label text-warning small fw-bold text-uppercase mb-2 d-flex align-items-center gap-1" style="letter-spacing: 0.05em; font-size: 0.82rem;">
                    <i class="bi bi-tag-fill me-1"></i> SELECT USAGE LICENSE
                  </label>
                  
                  <div class="d-flex flex-column gap-2">
                    <label class="d-flex align-items-center justify-content-between p-3 rounded cursor-pointer border" style="background: #0e243a; border-color: #2b5680 !important; cursor: pointer;">
                      <div class="d-flex align-items-center gap-3">
                        <input type="radio" name="license_type" value="personal" checked onchange="updateModalPrice('personal')" style="transform: scale(1.25); accent-color: #ff8a00;">
                        <div>
                          <strong class="d-block text-white" style="font-size: 0.95rem;">Personal License</strong>
                          <small style="font-size: 0.78rem; color: #cbd5e1;">Social media, phone wallpaper, prints for personal use</small>
                        </div>
                      </div>
                      <span class="fs-6 fw-bold text-warning" id="modalPersonalPriceLabel">R75.00</span>
                    </label>

                    <label class="d-flex align-items-center justify-content-between p-3 rounded cursor-pointer border" style="background: #0e243a; border-color: #2b5680 !important; cursor: pointer;">
                      <div class="d-flex align-items-center gap-3">
                        <input type="radio" name="license_type" value="commercial" onchange="updateModalPrice('commercial')" style="transform: scale(1.25); accent-color: #ff8a00;">
                        <div>
                          <strong class="d-block text-white" style="font-size: 0.95rem;">Commercial License</strong>
                          <small style="font-size: 0.78rem; color: #cbd5e1;">Editorial, websites, sponsors, brand marketing rights</small>
                        </div>
                      </div>
                      <span class="fs-6 fw-bold text-success" id="modalCommercialPriceLabel">R350.00</span>
                    </label>
                  </div>
                </div>

                <!-- Clean Event & Protection Note -->
                <div class="mb-4 p-3 rounded" style="background: #0c1e30; border: 1px solid #1e3e5c;">
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-warning small text-uppercase fw-bold" style="font-size: 0.78rem; letter-spacing: 0.05em;">
                      <i class="bi bi-calendar-event me-1"></i> EVENT GALLERY
                    </span>
                    <span class="badge bg-dark border border-secondary text-info font-monospace" style="font-size: 0.70rem;">Full Resolution Hi-Res</span>
                  </div>
                  <strong class="text-white d-block fs-6 mb-1" id="modalEventName">{{ $event->title }}</strong>
                  <span class="small d-block" id="modalCopyright" style="font-size: 0.78rem; color: #cbd5e1;">© {{ date('Y') }} {{ $event->photographer?->name ?? 'PhotoX' }} / PhotoX</span>
                </div>

              </div>

              <!-- Action Footer with Next / Previous & Purchase Button -->
              <div class="pt-3 border-top border-secondary border-opacity-25">
                <div class="d-flex align-items-center justify-content-between mb-3">
                  <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="prevLightboxPhoto()">
                      <i class="bi bi-chevron-left me-1"></i> Prev
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="nextLightboxPhoto()">
                      Next <i class="bi bi-chevron-right ms-1"></i>
                    </button>
                  </div>
                  <div class="text-end">
                    <span class="small d-block" style="font-size: 0.72rem; color: #cbd5e1; font-weight: 600;">TOTAL DUE</span>
                    <span class="fs-4 fw-bold text-warning" id="modalActionPrice">R75.00</span>
                  </div>
                </div>

                <button class="btn btn-warning w-100 py-3 fw-bold rounded-pill text-dark d-flex align-items-center justify-content-center gap-2 shadow" id="btnPurchaseModal" onclick="triggerPurchase()">
                  <i class="bi bi-bag-check-fill fs-5"></i> 
                  <span>Purchase Hi-Res</span>
                </button>
                <button type="button" class="btn btn-outline-secondary rounded-pill w-100 py-2 mt-2 text-white" onclick="closePhotoInspectorModal()" style="border-color: rgba(255,255,255,0.25); font-size: 0.85rem;">
                  <i class="bi bi-x-circle me-1"></i> Close / Cancel
                </button>
                <small class="text-center d-block mt-2" style="font-size: 0.75rem; color: #cbd5e1;">
                  Licensed purchase unlocks full resolution without watermarks.
                </small>
              </div>

            </div>
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

  // Dynamic License Selection (Matching Client Approved Reference)
  let currentLicenseChoice = 'personal';

  function updateModalPrice(type) {
    currentLicenseChoice = type;
    const photo = (currentEventPhotos && currentEventPhotos[currentPhotoIndex]) ? currentEventPhotos[currentPhotoIndex] : {};
    const personalPrice = parseFloat(photo.personal_price || 75).toFixed(2);
    const commercialPrice = parseFloat(photo.commercial_price || 350).toFixed(2);
    const chosenPrice = type === 'commercial' ? commercialPrice : personalPrice;

    const actionPriceEl = document.getElementById('modalActionPrice');
    if (actionPriceEl) {
      actionPriceEl.textContent = `R${chosenPrice}`;
    }

    const radio = document.querySelector(`input[name="license_type"][value="${type}"]`);
    if (radio) radio.checked = true;
  }

  function setLightboxLicense(type) {
    updateModalPrice(type);
  }

  // Open the High-Security Lightbox modal (matching Client Approved Screenshots)
  function openZebraLightbox(index) {
    if (!currentEventPhotos || currentEventPhotos.length === 0) return;
    
    if (index < 0) index = currentEventPhotos.length - 1;
    if (index >= currentEventPhotos.length) index = 0;

    currentPhotoIndex = index;
    const photo = currentEventPhotos[currentPhotoIndex];

    // Clear any previous inline styles on container to allow natural responsive rendering
    const container = document.getElementById('modalPhotoContainer');
    if (container) {
      container.style.width = '';
      container.style.height = '';
    }
    const blurLayer = document.getElementById('antiAiTriangleBlurLayer');
    if (blurLayer) {
      blurLayer.style.width = '';
      blurLayer.style.height = '';
    }
    const shield = document.getElementById('modalTransparentShield');
    if (shield) {
      shield.style.width = '';
      shield.style.height = '';
    }
    const photoImgBlurEl = document.getElementById('modalPhotoImgBlur');
    if (photoImgBlurEl) {
      photoImgBlurEl.style.width = '';
      photoImgBlurEl.style.height = '';
    }

    // Update Header info
    const titleEl = document.getElementById('modalPhotoTitle');
    if (titleEl) {
      titleEl.textContent = photo.title || 'Beach Sprint Splash';
    }
    const counterEl = document.getElementById('modalIndexCounter');
    if (counterEl) {
      counterEl.textContent = `Photo ${currentPhotoIndex + 1} of ${currentEventPhotos.length}`;
    }

    // Reset Anti-AI Blur state to default rest position
    resetAntiAiBlurState();

    // Load protected watermarked image
    const photoImg = document.getElementById('modalPhotoImg');
    const photoImgBlur = document.getElementById('modalPhotoImgBlur');
    const photoSrc = `/protected-photo/${photo.id}`;
    if (photoImg) {
      photoImg.onload = function() {
        requestAnimationFrame(syncPreviewAdWidth);
      };
      photoImg.src = photoSrc;
      if (photoImg.complete && photoImg.naturalWidth > 0) {
        requestAnimationFrame(syncPreviewAdWidth);
      }
    }
    if (photoImgBlur) photoImgBlur.src = photoSrc;

    // Fill Event Details & Rights info
    const evNameEl = document.getElementById('modalEventName');
    if (evNameEl) {
      evNameEl.textContent = photo.event && photo.event.title ? photo.event.title : '{{ $event->title }}';
    }
    const copyEl = document.getElementById('modalCopyright');
    if (copyEl) {
      const photographerName = photo.photographer_name || '{{ $event->photographer?->name ?? "PhotoX" }}';
      copyEl.textContent = `© {{ date('Y') }} ${photographerName} / PhotoX`;
    }

    // Pricing labels
    const personalPrice = parseFloat(photo.personal_price || 75).toFixed(2);
    const commercialPrice = parseFloat(photo.commercial_price || 350).toFixed(2);
    const personalTag = document.getElementById('modalPersonalPriceLabel');
    if (personalTag) personalTag.textContent = `R${personalPrice}`;
    const commercialTag = document.getElementById('modalCommercialPriceLabel');
    if (commercialTag) commercialTag.textContent = `R${commercialPrice}`;

    // Default to selected license
    const personalRadio = document.querySelector(`input[name="license_type"][value="${currentLicenseChoice}"]`);
    if (personalRadio) personalRadio.checked = true;
    updateModalPrice(currentLicenseChoice || 'personal');

    // Update Nav Buttons visibility (disable if only 1 photo)
    const prevBtn = document.getElementById('modalPrevBtn');
    const nextBtn = document.getElementById('modalNextBtn');
    if (currentEventPhotos.length <= 1) {
      if (prevBtn) prevBtn.style.display = 'none';
      if (nextBtn) nextBtn.style.display = 'none';
    } else {
      if (prevBtn) prevBtn.style.display = 'flex';
      if (nextBtn) nextBtn.style.display = 'flex';
    }

    const modalEl = document.getElementById('photoInspectorModal');
    const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
    modalInstance.show();
    setTimeout(syncPreviewAdWidth, 250);
  }

  function openPhotoModalByIndex(index) {
    openZebraLightbox(index);
  }

  function closePhotoInspectorModal() {
    const modalEl = document.getElementById('photoInspectorModal');
    const container = document.getElementById('modalPhotoContainer');
    if (container) {
      container.style.width = '';
      container.style.height = '';
    }
    if (modalEl) {
      try {
        const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
        modalInstance.hide();
      } catch(err) {
        console.warn('Bootstrap modal hide warning:', err);
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

  function nextLightboxPhoto() {
    if (currentEventPhotos.length <= 1) return;
    openZebraLightbox((currentPhotoIndex + 1) % currentEventPhotos.length);
  }

  function prevLightboxPhoto() {
    if (currentEventPhotos.length <= 1) return;
    openZebraLightbox((currentPhotoIndex - 1 + currentEventPhotos.length) % currentEventPhotos.length);
  }

  function nextModalPhoto() {
    nextLightboxPhoto();
  }

  function prevModalPhoto() {
    prevLightboxPhoto();
  }

  function syncPreviewAdWidth() {
    const photoImg = document.getElementById('modalPhotoImg');
    const adWrapper = document.getElementById('modalPreviewAdWrapper');
    const secInfo = document.getElementById('modalSecurityInfoBar');

    if (!photoImg) return;

    const w = photoImg.clientWidth || photoImg.offsetWidth;
    if (w && w >= 200) {
      if (adWrapper) {
        adWrapper.style.maxWidth = w + 'px';
        adWrapper.style.width = '100%';
        adWrapper.style.marginLeft = 'auto';
        adWrapper.style.marginRight = 'auto';
      }
      if (secInfo) {
        secInfo.style.maxWidth = Math.max(w, 520) + 'px';
        secInfo.style.width = '100%';
        secInfo.style.marginLeft = 'auto';
        secInfo.style.marginRight = 'auto';
      }
    }
  }

  // Anti-AI Opposing Triangle Blur Interaction
  let antiAiBlurEnabled = true;
  let isTopLeftClear = true;

  function initAntiAiTriangleBlur() {
    const container = document.getElementById('modalPhotoContainer');
    const shield = document.getElementById('modalTransparentShield');
    const blurLayer = document.getElementById('antiAiTriangleBlurLayer');
    const tag = document.getElementById('antiAiShieldTag');
    const tagText = document.getElementById('antiAiShieldTagText');

    if (!container || !shield || !blurLayer) return;

    shield.addEventListener('mousemove', function(e) {
      if (!antiAiBlurEnabled) return;

      const rect = container.getBoundingClientRect();
      if (rect.width <= 0 || rect.height <= 0) return;

      const u = (e.clientX - rect.left) / rect.width;
      const v = (e.clientY - rect.top) / rect.height;

      if (u + v < 1) {
        if (!isTopLeftClear) {
          isTopLeftClear = true;
          blurLayer.style.clipPath = 'polygon(100% 0, 100% 100%, 0 100%)';
          if (tag) {
            tag.style.top = 'auto';
            tag.style.left = 'auto';
            tag.style.bottom = '16px';
            tag.style.right = '16px';
          }
          if (tagText) {
            tagText.innerHTML = 'Anti-AI Frosted Half · Hover to Reveal';
          }
        }
      } else {
        if (isTopLeftClear) {
          isTopLeftClear = false;
          blurLayer.style.clipPath = 'polygon(0 0, 100% 0, 0 100%)';
          if (tag) {
            tag.style.bottom = 'auto';
            tag.style.right = 'auto';
            tag.style.top = '16px';
            tag.style.left = '16px';
          }
          if (tagText) {
            tagText.innerHTML = 'Anti-AI Frosted Half · Hover to Reveal';
          }
        }
      }
    });

    shield.addEventListener('mouseleave', function() {
      if (!antiAiBlurEnabled) return;
      resetAntiAiBlurState();
    });
  }

  function resetAntiAiBlurState() {
    isTopLeftClear = true;
    const blurLayer = document.getElementById('antiAiTriangleBlurLayer');
    const tag = document.getElementById('antiAiShieldTag');
    const tagText = document.getElementById('antiAiShieldTagText');
    if (blurLayer) blurLayer.style.clipPath = 'polygon(100% 0, 100% 100%, 0 100%)';
    if (tag) {
      tag.style.top = 'auto';
      tag.style.left = 'auto';
      tag.style.bottom = '16px';
      tag.style.right = '16px';
    }
    if (tagText) tagText.innerHTML = 'Anti-AI Frosted Half · Hover to Reveal';
  }

  function toggleAntiAiBlur() {
    antiAiBlurEnabled = !antiAiBlurEnabled;
    const blurLayer = document.getElementById('antiAiTriangleBlurLayer');
    const text = document.getElementById('antiAiBlurStateText');
    const btn = document.getElementById('toggleAntiAiBlurBtn');
    if (blurLayer) {
      if (antiAiBlurEnabled) {
        blurLayer.classList.remove('d-none');
        blurLayer.classList.add('active');
        resetAntiAiBlurState();
        if (text) text.textContent = 'ON';
        if (btn) {
          btn.classList.remove('btn-outline-secondary');
          btn.classList.add('btn-outline-warning');
        }
      } else {
        blurLayer.classList.add('d-none');
        blurLayer.classList.remove('active');
        if (text) text.textContent = 'OFF';
        if (btn) {
          btn.classList.remove('btn-outline-warning');
          btn.classList.add('btn-outline-secondary');
        }
      }
    }
  }

  function toggleWaterMotion() {
    const layer = document.getElementById('modalWaterMotionLayer');
    const text = document.getElementById('waterMotionStateText');
    const btn = document.getElementById('toggleWaterMotionBtn');
    if (!layer) return;

    const isCurrentlyActive = layer.classList.contains('active');
    if (isCurrentlyActive) {
      layer.classList.remove('active');
      if (text) text.textContent = 'OFF';
      if (btn) {
        btn.classList.remove('btn-outline-info');
        btn.classList.add('btn-outline-secondary');
      }
    } else {
      layer.classList.add('active');
      if (text) text.textContent = 'ON';
      if (btn) {
        btn.classList.remove('btn-outline-secondary');
        btn.classList.add('btn-outline-info');
      }
    }
  }

  // Keyboard navigation
  document.addEventListener('keydown', function(e) {
    const modalEl = document.getElementById('photoInspectorModal');
    if (!modalEl || !modalEl.classList.contains('show')) return;

    if (e.key === 'ArrowRight') {
      e.preventDefault();
      nextLightboxPhoto();
    } else if (e.key === 'ArrowLeft') {
      e.preventDefault();
      prevLightboxPhoto();
    } else if (e.key === 'Escape' || e.key === 'Esc') {
      e.preventDefault();
      closePhotoInspectorModal();
    }
  });

  document.addEventListener('DOMContentLoaded', function() {
    initAntiAiTriangleBlur();

    const modalEl = document.getElementById('photoInspectorModal');
    if (modalEl) {
      modalEl.addEventListener('shown.bs.modal', function() {
        syncPreviewAdWidth();
        setTimeout(syncPreviewAdWidth, 100);
      });
    }
    window.addEventListener('resize', syncPreviewAdWidth);
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
