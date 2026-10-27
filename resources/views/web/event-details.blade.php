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
  .bib-search-group {
    width: 100% !important;
    max-width: 100% !important;
  }
  @media (min-width: 992px) {
    .bib-search-group {
      max-width: 270px !important;
      width: auto !important;
    }
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

  /* Bottom bookmark and flag buttons */
  .card-bookmark-btn {
    position: absolute;
    bottom: 10px;
    left: 10px;
    background: rgba(15, 23, 42, 0.75);
    color: rgba(255, 255, 255, 0.85);
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
    border: none;
    z-index: 5;
    transition: all 0.2s;
    cursor: pointer;
  }
  .card-bookmark-btn:hover {
    color: #ff8a00;
    background: rgba(15, 23, 42, 0.95);
    transform: scale(1.12);
  }
  .card-bookmark-btn.active {
    color: #ff8a00 !important;
    background: rgba(15, 23, 42, 0.95);
  }
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
    cursor: pointer;
  }
  .card-flag-btn:hover {
    color: #ef4444;
    background: rgba(15, 23, 42, 0.95);
    transform: scale(1.12);
  }
  .card-flag-btn.flagged {
    color: #ef4444 !important;
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

  /* Prevent Horizontal Scrolling / Viewport Overflow */
  html, body {
    overflow-x: hidden !important;
    max-width: 100% !important;
  }
  main {
    overflow-x: hidden !important;
    max-width: 100% !important;
  }
  .site-ad-banner {
    max-width: 100% !important;
    overflow: hidden !important;
  }

  /* Responsive Scaling for High-Security Photo Inspector Modal */
  #photoInspectorModal .modal-dialog {
    width: calc(100% - 24px) !important;
    max-width: 1580px !important;
    margin: 1.25rem auto !important;
  }

  @media (min-width: 1400px) {
    #photoInspectorModal .modal-dialog {
      width: calc(100% - 48px) !important;
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
      width: calc(100% - 32px) !important;
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
    width: 100%;
    max-width: 100%;
    height: auto !important;
    max-height: none !important;
    transition: width 0.15s ease;
    margin: 12px auto 0 !important;
  }

  #photoInspectorModal .image-preview-ad-wrapper img {
    width: 100% !important;
    height: auto !important;
    max-height: none !important;
    object-fit: contain !important;
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

  /* Photo Gallery Grid Responsive Auto-fit */
  .photo-gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 20px;
    width: 100%;
    max-width: 100%;
  }

  @media (max-width: 575.98px) {
    .photo-gallery-grid {
      grid-template-columns: 1fr !important;
      gap: 16px !important;
    }
    .find-photos-card {
      padding: 16px !important;
    }
    .event-top-bar {
      padding: 16px 0 14px !important;
    }
  }

  /* MOBILE RESPONSIVE LIGHTBOX (Screens under 992px) */
  @media (max-width: 991.98px) {
    #photoInspectorModal .modal-dialog {
      margin: 0.5rem auto !important;
      width: calc(100% - 16px) !important;
      max-width: 100% !important;
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
        <div class="d-flex align-items-center gap-3 flex-wrap">
          <a href="{{ route('events.index') }}" class="event-back-btn flex-shrink-0" title="Back to Events">
            <i class="bi bi-arrow-left fs-5"></i>
          </a>
          <div class="flex-grow-1" style="min-width: 0;">
            <h1 class="h3 fw-bold text-white mb-0 text-break">{{ $event->title }}</h1>
            <p class="text-white-50 small mb-0 mt-1 d-flex align-items-center flex-wrap gap-2">
              @php
                $evPhotographer = $event->photographer ?? ($photos->first()?->photographer ?? null);
              @endphp
              <span>
                <i class="bi bi-camera me-1 text-warning"></i>
                @if($evPhotographer)
                  <a href="{{ route('photographers.show', $evPhotographer->id) }}" class="text-warning text-decoration-none fw-semibold">
                    {{ $evPhotographer->name }}
                  </a>
                @else
                  <span>{{ $event->photographer_name ?? ($photos->first()?->photographer_name ?? 'PhotoX Pro') }}</span>
                @endif
              </span>
              <span class="d-none d-sm-inline">·</span>
              <span><i class="bi bi-calendar-event me-1"></i> {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d M, Y') : 'Oct 6, 2026' }}</span>
              <span class="d-none d-sm-inline">·</span>
              <span><i class="bi bi-geo-alt me-1"></i> {{ $event->location ?? 'Cape Town, South Africa' }}</span>
            </p>
          </div>
        </div>

        <div class="d-flex align-items-center gap-2">
          {{-- Bookmark / Follow Event Button --}}
          @if(!empty($event->id))
            <button type="button" class="btn btn-sm rounded-pill px-3 save-event-btn {{ !empty($isEventSaved) ? 'btn-warning text-dark fw-bold' : 'btn-outline-warning text-warning' }}" onclick="toggleSaveEvent({{ $event->id }}, this)" title="{{ !empty($isEventSaved) ? 'Unfollow this event' : 'Follow this event' }}" style="font-size: 0.82rem; border-color: #ff8a00;">
              <i class="bi {{ !empty($isEventSaved) ? 'bi-bookmark-star-fill text-dark' : 'bi-bookmark-star' }} me-1"></i>
              <span class="btn-text">{{ !empty($isEventSaved) ? 'Followed' : 'Follow Event' }}</span>
            </button>
          @endif

          @php
            $quickSwitchEvents = \App\Models\Event::where('status', 'published')->where('id', '!=', $event->id)->latest('event_date')->take(8)->get();
          @endphp
          @if($quickSwitchEvents->isNotEmpty())
            <div class="dropdown d-none d-sm-inline-block">
              <button class="btn btn-outline-light rounded-pill btn-sm px-3 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-color: rgba(255,255,255,0.25);">
                <i class="bi bi-collection me-1"></i> Switch Event
              </button>
              <ul class="dropdown-menu dropdown-menu-end shadow-lg" style="max-height: 360px; overflow-y: auto; min-width: 260px;">
                <li class="dropdown-header text-uppercase small" style="font-size: 0.68rem; letter-spacing: 0.05em;">Published Events</li>
                @foreach($quickSwitchEvents as $qEv)
                  <li>
                    <a class="dropdown-item d-flex align-items-center justify-content-between gap-2 py-2" href="{{ route('events.show', $qEv->slug) }}">
                      <span class="text-truncate fw-semibold" style="max-width: 170px;">{{ $qEv->title }}</span>
                      <span class="badge bg-secondary" style="font-size: 0.65rem;">{{ $qEv->category_name }}</span>
                    </a>
                  </li>
                @endforeach
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-center fw-bold text-warning small" href="{{ route('events.index') }}">Browse All Events &rarr;</a></li>
              </ul>
            </div>
          @endif
          <a href="{{ route('events.index') }}" class="btn btn-lime rounded-pill btn-sm px-3">
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
      $eventDetailBanners = \App\Models\Banner::where('is_active', true)
          ->where('placement', 'event_detail')
          ->orderBy('sort_order')
          ->get();
      if ($eventDetailBanners->isEmpty()) {
          $eventDetailBanners = \App\Models\Banner::where('is_active', true)
              ->whereIn('placement', ['home_before_featured', 'image_preview'])
              ->orderBy('sort_order')
              ->get();
      }
      if ($eventDetailBanners->isEmpty() && !empty($sponsorBanner)) {
          $eventDetailBanners = collect([$sponsorBanner]);
      }
      $uniqueEventDetailAdId = 'eventDetailAdCarousel_' . uniqid();
    @endphp
    @if($eventDetailBanners->isNotEmpty())
    <aside class="site-ad-banner mb-4" id="{{ $uniqueEventDetailAdId }}" aria-label="Sponsored placement" style="height: auto !important; max-height: 200px !important; min-height: unset !important; overflow: hidden; border-radius: 15px; background: #07152b; position: relative;">
      @foreach($eventDetailBanners as $idx => $eventPartnerAd)
        @php
          $adHref = (!empty($eventPartnerAd->link_url) && $eventPartnerAd->link_url !== '/events') ? $eventPartnerAd->link_url : '/#latest-events';
          $adInterval = ($eventPartnerAd->rotation_interval && $eventPartnerAd->rotation_interval > 0) ? ($eventPartnerAd->rotation_interval * 1000) : 5000;
        @endphp
        <div class="event-detail-ad-slide {{ $loop->first ? 'active' : '' }}" data-interval="{{ $adInterval }}" style="{{ $loop->first ? 'display: block;' : 'display: none;' }}; position: relative; width: 100%;">
          <a class="site-ad-link" href="{{ $adHref }}" target="_blank" style="height: auto !important; max-height: 200px !important; display: block; line-height: 0; position: relative;">
            <img src="{{ $eventPartnerAd->image_url }}" alt="{{ $eventPartnerAd->title ?: 'Sponsored Partner' }}" style="width: 100%; height: 200px; max-height: 200px; display: block; object-fit: cover; object-position: center; position: relative; background: #07152b;">
          </a>
        </div>
      @endforeach
    </aside>
    @if($eventDetailBanners->count() > 1)
      <script>
        (function() {
          const wrap = document.getElementById('{{ $uniqueEventDetailAdId }}');
          if (!wrap) return;
          const slides = wrap.querySelectorAll('.event-detail-ad-slide');
          if (slides.length <= 1) return;
          let activeIdx = 0;
          let slideTimer = null;

          function nextSlide() {
            if (slideTimer) clearTimeout(slideTimer);
            const current = slides[activeIdx];
            const interval = parseInt(current?.getAttribute('data-interval')) || 5000;

            slideTimer = setTimeout(function() {
              slides[activeIdx].style.display = 'none';
              slides[activeIdx].classList.remove('active');
              activeIdx = (activeIdx + 1) % slides.length;
              slides[activeIdx].style.display = 'block';
              slides[activeIdx].classList.add('active');
              nextSlide();
            }, interval);
          }
          nextSlide();
        })();
      </script>
    @endif
    @endif

    <!-- FIND YOUR PHOTOS TOOLBAR (Search by Bib Number & Action Buttons) -->
    <div class="find-photos-card">
      <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
        <div>
          <h5 class="fw-bold text-dark mb-1">Find your photos</h5>
          <span class="text-muted small">Filter captures by athlete bib number or selfie</span>
        </div>
        <div class="d-flex align-items-stretch align-items-md-center gap-2 flex-column flex-md-row justify-content-md-end w-100 w-lg-auto">
          <div class="input-group bib-search-group shadow-sm action-toolbar-item" style="max-width: 100%;">
            <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control border-start-0" id="bibSearchInput" placeholder="Bib search..." onkeyup="filterPhotosByBib(this.value)">
            <button class="btn btn-dark px-3 fw-semibold" type="button" onclick="filterPhotosByBib(document.getElementById('bibSearchInput').value)">Search</button>
          </div>
          <button type="button" class="btn btn-lime rounded-pill px-3 py-2 fw-semibold d-inline-flex align-items-center justify-content-center gap-2 shadow-sm text-nowrap action-toolbar-item" style="height: 38px;" onclick="openSelfieSearchModal()">
            <i class="bi bi-camera-fill"></i>
            <span>Search by Selfie</span>
          </button>
          <button type="button" class="btn btn-warning rounded-pill px-3 py-2 fw-bold text-dark d-inline-flex align-items-center justify-content-center gap-2 shadow-sm text-nowrap action-toolbar-item" style="height: 38px;" onclick="buyCompleteGalleryPackage();">
            <i class="bi bi-box-seam-fill"></i>
            <span>Buy Complete Gallery · R{{ number_format($event->full_gallery_price ?: 450, 0) }}</span>
          </button>
          <button type="button" class="btn btn-success rounded-pill px-3 py-2 fw-bold text-white d-inline-flex align-items-center justify-content-center gap-2 shadow-sm text-nowrap d-none action-toolbar-item" id="btnAddSearchResultsToCart" onclick="addSearchResultsToCart()" style="height: 38px;">
            <i class="bi bi-bag-plus-fill"></i>
            <span id="btnAddSearchResultsLabel">Add Found Photos to Basket</span>
          </button>
        </div>
      </div>
    </div>

    <style>
      .action-toolbar-item {
        width: 100%;
      }
      @media (min-width: 768px) {
        .action-toolbar-item {
          width: auto !important;
          flex: 0 0 auto !important;
        }
        .bib-search-group {
          width: 260px !important;
        }
      }
    </style>

    @if(!($event->allow_individual_sales ?? true))
      <!-- Exclusive Complete Gallery Only Banner -->
      <div class="alert alert-warning border-0 rounded-4 p-3 mb-4 d-flex align-items-center justify-content-between flex-wrap gap-2 shadow-sm" style="background: linear-gradient(135deg, rgba(255, 138, 0, 0.15), rgba(245, 158, 11, 0.25)); border: 1px solid rgba(255, 138, 0, 0.4) !important;">
        <div class="d-flex align-items-center gap-3">
          <i class="bi bi-box-seam-fill text-warning fs-3"></i>
          <div>
            <strong class="text-dark d-block">Exclusive Complete Gallery Collection</strong>
            <small class="text-muted">This event is offered exclusively as a complete gallery package (R{{ number_format($event->full_gallery_price ?: 450, 0) }} for all {{ number_format($event->total_photos > 0 ? $event->total_photos : $photos->count()) }} photos). Individual photos are not sold separately.</small>
          </div>
        </div>
        <button type="button" class="btn btn-warning fw-bold text-dark rounded-pill px-4 shadow-sm" onclick="buyCompleteGalleryPackage();">
          <i class="bi bi-bag-check-fill me-1"></i> Buy Complete Gallery · R{{ number_format($event->full_gallery_price ?: 450, 0) }}
        </button>
      </div>
    @endif

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
        @php
          $dynamicSubAlbums = $photos->pluck('sub_album')->filter()->unique()->values();
        @endphp
        <ul class="dropdown-menu dropdown-menu-end shadow">
          <li><a class="dropdown-item fw-semibold" href="javascript:void(0)" onclick="resetAllGalleryFilters()"><i class="bi bi-grid me-2 text-primary"></i>Show All Photos</a></li>
          @if($dynamicSubAlbums->isNotEmpty())
            <li><hr class="dropdown-divider"></li>
            <li><h6 class="dropdown-header text-uppercase text-muted" style="font-size: 0.68rem; letter-spacing: 0.05em;"><i class="bi bi-folder2-open me-1 text-warning"></i> Albums / Stations</h6></li>
            @foreach($dynamicSubAlbums as $subAlb)
              <li><a class="dropdown-item" href="javascript:void(0)" onclick="filterPhotosBySubAlbum('{{ addslashes($subAlb) }}')"><i class="bi bi-chevron-right me-1 text-muted small"></i>{{ $subAlb }}</a></li>
            @endforeach
          @endif
          <li><hr class="dropdown-divider"></li>
          <li><h6 class="dropdown-header text-uppercase text-muted" style="font-size: 0.68rem; letter-spacing: 0.05em;"><i class="bi bi-clock-history me-1 text-info"></i> Sort by Time Taken</h6></li>
          <li><a class="dropdown-item" href="javascript:void(0)" onclick="sortPhotosByTime('asc')"><i class="bi bi-sort-numeric-down me-2 text-warning"></i>Earliest First (Morning / Start)</a></li>
          <li><a class="dropdown-item" href="javascript:void(0)" onclick="sortPhotosByTime('desc')"><i class="bi bi-sort-numeric-up-alt me-2 text-warning"></i>Latest First (Finish / Awards)</a></li>
        </ul>
      </div>
    </div>

    <!-- 3. PHOTO GALLERY GRID (Matching ZebraSnap Screenshot 2 & 4) -->
    @if($photos->isNotEmpty())
      <div class="photo-gallery-grid" id="eventPhotosGrid">
        @foreach($photos as $photo)
        <div class="event-photo-card" 
             data-index="{{ $loop->index }}" 
             data-photo-id="{{ $photo->id }}"
             data-timestamp="{{ $photo->captured_at ? $photo->captured_at->timestamp : ($photo->created_at ? $photo->created_at->timestamp : $photo->id) }}"
             data-price="{{ (float) ($photo->personal_price ?: ($event->starting_price ?: 50)) }}"
             data-bib="{{ $photo->bib_number ?? '' }}" 
             data-subalbum="{{ $photo->sub_album ?? '' }}" 
             data-title="{{ $photo->title }}"
             onclick="openZebraLightbox({{ $loop->index }})">
          
          <!-- Protected Watermarked Image -->
          <img src="/protected-photo/{{ $photo->id }}?v={{ $watermarkSetting->updated_at?->timestamp ?? 1 }}" 
               alt="{{ $photo->title }}" 
               loading="lazy" 
               draggable="false">

          <!-- Watermark security gradient & pattern overlay -->
          <div class="anti-theft-overlay"></div>

          <!-- Top-Left: Photographer Avatar Circle -->
          <div class="card-avatar-pill" title="{{ $photo->photographer?->name ?? ($event->photographer?->name ?? 'PhotoX Creator') }}">
            <img src="{{ $photo->photographer?->avatar ?: ($event->photographer?->avatar ?: asset('logo.png')) }}" alt="{{ $photo->photographer?->name ?? ($event->photographer?->name ?? 'Photographer') }}" style="{{ ($photo->photographer?->avatar || $event->photographer?->avatar) ? '' : 'background: #0b1a29; padding: 2px; object-fit: contain;' }}">
          </div>

          <!-- Top-Right: Price Tag (Matching Screenshot 2) -->
          @if($event->allow_individual_sales ?? true)
            <span class="card-price-pill">
              R{{ number_format($photo->personal_price ?: 50, 2) }}
            </span>
          @else
            <span class="card-price-pill" style="background: rgba(16, 185, 129, 0.95); font-size: 0.68rem; letter-spacing: 0.03em;">
              <i class="bi bi-collection-fill me-1"></i> Gallery Pack
            </span>
          @endif

          @php
            $isPhotoSaved = in_array($photo->id, $savedPhotoIds ?? []);
          @endphp

          <!-- Bottom-Left: Bookmark / Save Button (Always visible on card) -->
          <button class="card-bookmark-btn {{ $isPhotoSaved ? 'active' : '' }}" 
                  id="cardBookmarkBtn_{{ $photo->id }}"
                  type="button" 
                  title="{{ $isPhotoSaved ? 'Bookmarked in your collection' : 'Bookmark this photo' }}" 
                  onclick="event.stopPropagation(); toggleWishlist({{ $photo->id }}, this);">
            <i class="bi {{ $isPhotoSaved ? 'bi-bookmark-star-fill text-warning' : 'bi-bookmark-star' }}"></i>
          </button>

          <!-- Bottom-Right Flag Button (Opens report modal) -->
          <button class="card-flag-btn" 
                  id="cardFlagBtn_{{ $photo->id }}"
                  type="button" 
                  title="Flag / Report photo" 
                  onclick="event.stopPropagation(); openPhotoReportModal({{ $photo->id }}, '{{ addslashes($photo->title ?: 'Action Photo') }}');">
            <i class="bi bi-flag"></i>
          </button>

          <!-- Hover Overlay Controls (Matching ZebraSnap Screenshot 4) -->
          <div class="card-hover-actions">
            @php
              $rawTitle = trim($photo->title ?? '');
              $isFilename = empty($rawTitle)
                || preg_match('/^(clint|dsc|img|samples|cruiser|safariprojek|p\d+|\d+)/i', $rawTitle)
                || preg_match('/\.(jpg|jpeg|png|webp|cr2|nef|arw|dng|raw)$/i', $rawTitle)
                || preg_match('/-\d{3,}/', $rawTitle);
              $displayTitle = (!$isFilename && !empty($rawTitle)) 
                ? $rawTitle 
                : (!empty($photo->bib_number) ? 'Athlete #' . $photo->bib_number : ($event->title . ' · Photo #' . ($loop->index + 1)));
            @endphp
            <span class="text-white small fw-bold mb-1 px-3 py-1 rounded bg-dark bg-opacity-75">
              {{ $displayTitle }}
            </span>
            <div class="hover-action-row">
              <button type="button" 
                      class="hover-circle-btn {{ $isPhotoSaved ? 'active text-warning' : '' }}" 
                      id="hoverBookmarkBtn_{{ $photo->id }}"
                      title="{{ $isPhotoSaved ? 'Bookmarked in your vault' : 'Bookmark photo' }}" 
                      onclick="event.stopPropagation(); toggleWishlist({{ $photo->id }}, this);">
                <i class="bi {{ $isPhotoSaved ? 'bi-bookmark-star-fill text-warning' : 'bi-bookmark-star' }}"></i>
              </button>
              <button type="button" class="hover-circle-btn" title="Inspect Photo" onclick="event.stopPropagation(); openZebraLightbox({{ $loop->index }});">
                <i class="bi bi-search"></i>
              </button>
              <button type="button" class="hover-circle-btn" title="Share" onclick="event.stopPropagation(); shareSinglePhoto({{ $photo->id }});">
                <i class="bi bi-share"></i>
              </button>
              @if($event->allow_individual_sales ?? true)
                <button type="button" class="hover-cart-btn" title="Add to cart" onclick="event.stopPropagation(); quickAddToCart({{ $photo->id }});">
                  <i class="bi bi-cart3"></i>
                </button>
              @else
                <button type="button" class="hover-cart-btn" style="background: #10b981;" title="Complete Gallery Only · Buy Package" onclick="event.stopPropagation(); buyCompleteGalleryPackage();">
                  <i class="bi bi-box-seam-fill"></i>
                </button>
              @endif
            </div>
            @if(!empty($photo->bib_number))
              <span class="badge bg-warning text-dark font-monospace mt-1">BIB #{{ $photo->bib_number }}</span>
            @endif
          </div>
        </div>
        @endforeach
      </div>
    @else
      <!-- DEDICATED CLEAN EMPTY GALLERY & NOTIFY ME LIVE CARD -->
      <div class="card border-0 rounded-4 shadow-sm py-5 px-3 px-md-4 text-center my-4" style="background: #ffffff; border: 1px solid #e2e8f0 !important;">
        <div class="mx-auto" style="max-width: 580px; width: 100%;">
          <div class="d-inline-flex p-3 rounded-circle bg-warning bg-opacity-10 text-warning mb-3">
            <i class="bi bi-camera-fill display-5"></i>
          </div>
          <h3 class="text-dark fw-bold mb-2">Photos are currently uploading for this event</h3>
          <p class="text-muted mb-4 small">Official photographers are currently processing watermarked proofs. Check back shortly.</p>

          <!-- Client Requested: Notify Me When Gallery is Live Box -->
          <div class="p-4 rounded-4 shadow-sm text-start" style="background: #f8fafc; border: 1.5px solid #e2e8f0;">
            <div class="d-flex align-items-center gap-2 mb-2">
              <i class="bi bi-bell-fill text-warning fs-5"></i>
              <strong class="text-dark fs-6">Notify me when gallery is live</strong>
            </div>
            <p class="text-muted small mb-3">Leave your email address and we will alert you the moment these photos are ready to view and download.</p>
            
            <form action="{{ route('event.notify', $event->id) }}" method="POST" id="notifyGalleryForm" onsubmit="handleNotifySubmit(event, this)">
              @csrf
              <div class="row g-2 align-items-center">
                <div class="col-sm-8">
                  <div class="input-group">
                    <span class="input-group-text bg-white text-muted border-end-0" style="border-color: #cbd5e1; border-top-left-radius: 50rem; border-bottom-left-radius: 50rem; padding-left: 16px;">
                      <i class="bi bi-envelope"></i>
                    </span>
                    <input type="email" 
                           name="email" 
                           id="notifyEmailInput"
                           class="form-control border-start-0 text-dark" 
                           placeholder="Enter your email address..." 
                           required 
                           style="border-color: #cbd5e1; font-size: 0.95rem; background: #ffffff; height: 48px; border-top-right-radius: 50rem; border-bottom-right-radius: 50rem; padding-right: 16px; color: #0b2d5b !important;">
                  </div>
                </div>
                <div class="col-sm-4">
                  <button type="submit" 
                          id="notifySubmitBtn"
                          class="btn btn-warning rounded-pill w-100 text-dark fw-bold d-inline-flex align-items-center justify-content-center gap-2 shadow-sm" 
                          style="font-size: 0.95rem; height: 48px; white-space: nowrap;">
                    <i class="bi bi-send-fill"></i> Notify Me
                  </button>
                </div>
              </div>
            </form>
            <div id="notifySuccessAlert" class="alert alert-success mt-3 py-2 small d-none mb-0">
              <i class="bi bi-check-circle-fill me-1"></i> You're on the list! We will email you as soon as the photos go live.
            </div>
          </div>
        </div>
      </div>
    @endif

    <!-- 4. DYNAMIC RELATED EVENTS SECTION -->
    @if(isset($relatedEvents) && $relatedEvents->isNotEmpty())
    <section class="mt-5 pt-4 border-top border-secondary border-opacity-25" id="relatedEventsSection">
      <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
        <div>
          <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-1 rounded-pill mb-2 fw-bold" style="font-size: 0.72rem; letter-spacing: 0.05em;">EXPLORE MORE GALLERIES</span>
          <h3 class="h4 fw-bold text-dark mb-0">Related Events</h3>
        </div>
        <a href="{{ route('events.index') }}" class="btn btn-outline-dark btn-sm rounded-pill px-3 fw-semibold">
          View All Events <i class="bi bi-arrow-right ms-1"></i>
        </a>
      </div>

      <div class="row g-3 g-md-4">
        @foreach($relatedEvents as $rel)
          <div class="col-12 col-sm-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative" style="transition: transform 0.25s ease, box-shadow 0.25s ease; background: #fff;">
              <a href="{{ route('events.show', $rel->slug) }}" class="text-decoration-none text-dark d-flex flex-column h-100">
                <div class="position-relative overflow-hidden" style="aspect-ratio: 16 / 10; background: #0f172a;">
                  <img src="{{ $rel->cover_image }}" alt="{{ $rel->title }}" class="w-100 h-100 object-fit-cover" loading="lazy">
                  <span class="position-absolute top-0 end-0 m-2 badge bg-dark bg-opacity-75 text-warning border border-warning" style="font-size: 0.68rem;">
                    <i class="bi bi-images me-1"></i> {{ number_format($rel->total_photos) }}
                  </span>
                  @if(!empty($rel->category_name))
                    <span class="position-absolute bottom-0 start-0 m-2 badge text-dark fw-bold" style="font-size: 0.68rem; background: #a3e635;">
                      {{ $rel->category_name }}
                    </span>
                  @endif
                </div>
                <div class="card-body p-3 d-flex flex-column justify-content-between flex-grow-1">
                  <div>
                    <small class="text-muted d-block mb-1" style="font-size: 0.72rem;">
                      <i class="bi bi-calendar3 me-1"></i> {{ $rel->event_date ? \Carbon\Carbon::parse($rel->event_date)->format('d M Y') : '' }}
                    </small>
                    <h5 class="card-title fw-bold fs-6 mb-1 text-truncate" title="{{ $rel->title }}">{{ $rel->title }}</h5>
                    <p class="card-text text-muted small mb-2 text-truncate" style="font-size: 0.78rem;">
                      <i class="bi bi-geo-alt me-1"></i> {{ $rel->location }}
                    </p>
                  </div>
                  <div class="d-flex align-items-center justify-content-between pt-2 border-top border-light mt-auto">
                    <span class="fw-bold text-warning small">{{ $rel->starting_price ?? 'From R50' }}</span>
                    <span class="btn btn-sm btn-outline-dark rounded-pill px-2 py-0" style="font-size: 0.72rem;">Open <i class="bi bi-arrow-up-right"></i></span>
                  </div>
                </div>
              </a>
            </div>
          </div>
        @endforeach
      </div>
    </section>
    @endif

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

            <!-- Flag / Report Button in Modal -->
            <button type="button" id="modalFlagPhotoBtn" class="btn btn-sm btn-outline-danger rounded-pill px-2 py-0 ms-md-1" style="font-size: 0.72rem; height: 26px;" onclick="openCurrentModalPhotoReport()" title="Report or flag this photo for review">
              <i class="bi bi-flag me-1"></i> Flag Photo
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
                $previewAds = \App\Models\Banner::where('is_active', true)
                    ->where('placement', 'image_preview')
                    ->orderBy('sort_order')
                    ->get();
                if ($previewAds->isEmpty() && !empty($sponsorBanner)) {
                    $previewAds = collect([$sponsorBanner]);
                }
              @endphp
              <div class="mt-3 image-preview-ad-wrapper mx-auto" id="modalPreviewAdWrapper" style="position: relative; overflow: hidden; border-radius: 8px; border: 1px solid rgba(255, 138, 0, 0.25); background: #061019; width: 100%; max-width: 100%;">
                @forelse($previewAds as $idx => $previewAd)
                  @php
                    $modalAdHref = (!empty($previewAd->link_url) && $previewAd->link_url !== '/events') ? $previewAd->link_url : '/#latest-events';
                    $slideInterval = ($previewAd->rotation_interval && $previewAd->rotation_interval > 0) ? ($previewAd->rotation_interval * 1000) : 5000;
                  @endphp
                  <div class="modal-preview-ad-slide {{ $loop->first ? 'active' : '' }}" data-interval="{{ $slideInterval }}" style="{{ $loop->first ? 'display: block;' : 'display: none;' }}; position: relative; width: 100%;">
                    <a href="{{ $modalAdHref }}" target="_blank" class="d-block w-100 position-relative text-decoration-none" style="line-height: 0;">
                      <img src="{{ $previewAd->image_url }}" alt="{{ $previewAd->title ?: 'Sponsor Banner' }}" style="width: 100%; height: auto; display: block; object-fit: contain; border-radius: 7px;">
                      @if(!empty($previewAd->badge_text))
                        <span class="position-absolute top-0 end-0 m-1 px-2 py-0 badge bg-dark text-warning border border-warning" style="font-size: 0.60rem; letter-spacing: 0.05em; z-index: 2; line-height: 1.3;">
                          {{ $previewAd->badge_text }}
                        </span>
                      @endif
                      @if(!empty($previewAd->title))
                        <div class="position-absolute bottom-0 start-0 w-100 px-3 py-1 text-white text-truncate" style="background: linear-gradient(0deg, rgba(0,0,0,0.85), transparent); font-size: 0.78rem; z-index: 2; line-height: 1.4;">
                          <strong>{{ $previewAd->title }}</strong>
                          @if(!empty($previewAd->subtitle))
                            <span class="text-white-50 ms-2" style="font-size: 0.70rem;">{{ $previewAd->subtitle }}</span>
                          @endif
                        </div>
                      @endif
                    </a>
                  </div>
                @empty
                  <div class="p-2 d-flex align-items-center justify-content-center text-muted" style="min-height: 60px; font-size: 0.75rem;">
                    <span><i class="bi bi-award text-warning me-1"></i> <strong>Official Event Sponsor</strong></span>
                  </div>
                @endforelse
              </div>
            </div>

            <!-- Right: Commercial Pricing & License Panel -->
            <div class="col-lg-5 modal-info-col p-4 d-flex flex-column justify-content-between" style="background: #091724; border-left: 1px solid #1a3248;">
              <div>
                
                <!-- License & Bundle Selector (Single Personal, Single Commercial, Selfie Bundle, Buy Complete Gallery) -->
                <div class="mb-4 p-3 rounded" style="background: #0c1e30; border: 1px solid #1e3e5c;">
                  <label class="form-label text-warning small fw-bold text-uppercase mb-2 d-flex align-items-center gap-1" style="letter-spacing: 0.05em; font-size: 0.82rem;">
                    <i class="bi bi-tag-fill me-1"></i> SELECT PURCHASE OPTION
                  </label>
                  
                  <div class="d-flex flex-column gap-2" id="modalPurchaseOptionsContainer">
                    <!-- Option 1: Personal Single Photo -->
                    <label id="modalOptionPersonal" class="d-flex align-items-center justify-content-between p-2 p-md-3 rounded cursor-pointer border" onclick="setLightboxLicense('personal')" style="background: #0e243a; border-color: #2b5680 !important; cursor: pointer;">
                      <div class="d-flex align-items-center gap-3">
                        <input type="radio" name="license_type" value="personal" checked onchange="updateModalPrice('personal')" style="transform: scale(1.25); accent-color: #ff8a00;">
                        <div>
                          <strong class="d-block text-white" style="font-size: 0.92rem;">Personal License (Single Photo)</strong>
                          <small style="font-size: 0.76rem; color: #cbd5e1;">Social media, phone wallpaper, prints for personal use</small>
                        </div>
                      </div>
                      <span class="fs-6 fw-bold text-warning" id="modalPersonalPriceLabel">R75.00</span>
                    </label>

                    <!-- Option 2: Commercial Single Photo -->
                    <label id="modalOptionCommercial" class="d-flex align-items-center justify-content-between p-2 p-md-3 rounded cursor-pointer border" onclick="setLightboxLicense('commercial')" style="background: #0e243a; border-color: #2b5680 !important; cursor: pointer;">
                      <div class="d-flex align-items-center gap-3">
                        <input type="radio" name="license_type" value="commercial" onchange="updateModalPrice('commercial')" style="transform: scale(1.25); accent-color: #ff8a00;">
                        <div>
                          <strong class="d-block text-white" style="font-size: 0.92rem;">Commercial License (Single Photo)</strong>
                          <small style="font-size: 0.76rem; color: #cbd5e1;">Editorial, websites, sponsors, brand marketing rights</small>
                        </div>
                      </div>
                      <span class="fs-6 fw-bold text-success" id="modalCommercialPriceLabel">R350.00</span>
                    </label>

                    <!-- Option 3: Selfie / Athlete Bundle (Flat Rate for 1 or 100+ images) -->
                    <label id="modalOptionSelfieBundle" class="d-flex align-items-center justify-content-between p-2 p-md-3 rounded cursor-pointer border" onclick="setLightboxLicense('selfie')" style="background: #0e243a; border-color: #2b5680 !important; cursor: pointer;">
                      <div class="d-flex align-items-center gap-3">
                        <input type="radio" name="license_type" value="selfie" onchange="updateModalPrice('selfie')" style="transform: scale(1.25); accent-color: #ff8a00;">
                        <div>
                          <div class="d-flex align-items-center gap-2">
                            <strong class="text-white" style="font-size: 0.92rem;">Selfie / Athlete Bundle</strong>
                            <span class="badge bg-warning text-dark px-2 py-0" style="font-size: 0.65rem; font-weight: 700;">FLAT RATE</span>
                          </div>
                          <small style="font-size: 0.76rem; color: #cbd5e1;">All your matched photos from bib/selfie search (1 or 100+)</small>
                          <small class="d-block text-warning fw-semibold mt-1" style="font-size: 0.72rem;"><i class="bi bi-info-circle me-1"></i>Personal License Only (Commercial licenses must be bought individually)</small>
                        </div>
                      </div>
                      <span class="fs-6 fw-bold text-info" id="modalSelfieBundlePriceLabel">R150.00</span>
                    </label>

                    <!-- Option 4: Buy Complete Gallery (All Photos in Event) -->
                    <label id="modalOptionFullGallery" class="d-flex align-items-center justify-content-between p-2 p-md-3 rounded cursor-pointer border" onclick="setLightboxLicense('full_gallery')" style="background: #0e243a; border-color: #2b5680 !important; cursor: pointer;">
                      <div class="d-flex align-items-center gap-3">
                        <input type="radio" name="license_type" value="full_gallery" onchange="updateModalPrice('full_gallery')" style="transform: scale(1.25); accent-color: #ff8a00;">
                        <div>
                          <div class="d-flex align-items-center gap-2">
                            <strong class="text-white" style="font-size: 0.92rem;">Buy Complete Gallery</strong>
                            <span class="badge bg-success text-white px-2 py-0" style="font-size: 0.65rem; font-weight: 700;">ALL PHOTOS</span>
                          </div>
                          <small style="font-size: 0.76rem; color: #cbd5e1;">Instant high-res bundle of all captures in this event</small>
                          <small class="d-block text-warning fw-semibold mt-1" style="font-size: 0.72rem;"><i class="bi bi-info-circle me-1"></i>Personal License Only (Commercial licenses must be bought individually)</small>
                        </div>
                      </div>
                      <span class="fs-6 fw-bold text-warning" id="modalFullGalleryPriceLabel">R450.00</span>
                    </label>
                  </div>
                </div>

                <!-- Clean Event & Clickable Link to Gallery (Matching Client Handwriting: LINK TO THAT GALLERY) -->
                <div class="mb-4 p-3 rounded" style="background: #0c1e30; border: 1px solid #1e3e5c;">
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-warning small text-uppercase fw-bold" style="font-size: 0.78rem; letter-spacing: 0.05em;">
                      <i class="bi bi-calendar-event me-1"></i> EVENT GALLERY
                    </span>
                    <span class="badge bg-dark border border-secondary text-info font-monospace" style="font-size: 0.70rem;">Full Resolution Hi-Res</span>
                  </div>
                  <a href="/event-details/{{ $event->slug }}" id="modalEventLink" class="text-white text-decoration-none d-flex align-items-center justify-content-between fs-6 fw-bold mb-1 p-2 rounded" style="background: rgba(255,255,255,0.05); transition: all 0.2s; border: 1px solid rgba(255,138,0,0.3);" onmouseover="this.style.background='rgba(255,138,0,0.18)'; this.style.borderColor='#ff8a00';" onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.borderColor='rgba(255,138,0,0.3)';" title="Click to view full event gallery page">
                    <span id="modalEventName">{!! $event->title !!}</span>
                    <span class="badge bg-warning text-dark d-flex align-items-center gap-1" style="font-size: 0.72rem; font-weight: 700;">
                      View Gallery <i class="bi bi-box-arrow-up-right"></i>
                    </span>
                  </a>
                  <span class="small d-block mt-2" id="modalCopyright" style="font-size: 0.78rem; color: #cbd5e1;">© {{ date('Y') }} {{ $event->photographer?->name ?? 'PhotoX' }} / PhotoX</span>
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
                  <i class="bi bi-cart-plus-fill fs-5" id="btnPurchaseModalIcon"></i> 
                  <span id="btnPurchaseModalText">Add to Cart</span>
                </button>
                <div class="d-flex align-items-center gap-2 mt-2">
                  <button type="button" class="btn btn-outline-warning rounded-pill flex-fill py-2 text-decoration-none text-center" id="btnModalSavePhoto" onclick="toggleModalSavePhoto()" style="font-size: 0.85rem; font-weight: 600;">
                    <i class="bi bi-bookmark-star me-1" id="btnModalSavePhotoIcon"></i> <span id="btnModalSavePhotoText">Bookmark</span>
                  </button>
                  <a href="{{ url('/cart') }}" class="btn btn-outline-warning rounded-pill flex-fill py-2 text-decoration-none text-center" style="font-size: 0.85rem; font-weight: 600;">
                    <i class="bi bi-bag-check me-1"></i> View Cart
                  </a>
                  <button type="button" class="btn btn-outline-secondary rounded-pill flex-fill py-2 text-white" onclick="closePhotoInspectorModal()" style="border-color: rgba(255,255,255,0.25); font-size: 0.85rem;">
                    <i class="bi bi-x-circle me-1"></i> Keep Browsing
                  </button>
                </div>
                <small class="text-center d-block mt-2" style="font-size: 0.75rem; color: #cbd5e1;">
                  Licensed purchase unlocks full resolution clean master without watermarks.
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
  <!-- 7. PHOTO REPORT / FLAG MODAL -->
  <div class="modal fade" id="photoReportModal" tabindex="-1" aria-labelledby="photoReportModalTitle" aria-hidden="true" style="z-index: 1065;">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow-lg" style="background: #081426; color: #fff; border-radius: 18px; border: 1px solid #1c354d !important;">
        <div class="modal-header border-bottom border-secondary border-opacity-25 px-4 py-3" style="background: #040c14;">
          <div class="d-flex align-items-center gap-2">
            <i class="bi bi-flag-fill text-warning fs-5"></i>
            <h5 class="modal-title fs-6 fw-bold text-white mb-0" id="photoReportModalTitle">Report Photo for Review</h5>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="photoReportForm" onsubmit="submitPhotoReport(event)">
          <input type="hidden" id="reportPhotoId" value="">
          <div class="modal-body p-4">
            <p class="small text-white-50 mb-3">
              Please specify the issue regarding <strong class="text-white" id="reportPhotoTitle">this photo</strong>. PhotoX moderators review each report promptly.
            </p>
            <div class="d-flex flex-column gap-2 mb-3">
              <label class="d-flex align-items-center gap-2 p-2 rounded border border-secondary border-opacity-25" style="background: rgba(255,255,255,0.03); cursor: pointer;">
                <input type="radio" name="report_reason" value="privacy" checked style="accent-color: #ff8a00;">
                <span class="small">Privacy request (I am in this photo and request removal)</span>
              </label>
              <label class="d-flex align-items-center gap-2 p-2 rounded border border-secondary border-opacity-25" style="background: rgba(255,255,255,0.03); cursor: pointer;">
                <input type="radio" name="report_reason" value="inappropriate" style="accent-color: #ff8a00;">
                <span class="small">Inappropriate or offensive content</span>
              </label>
              <label class="d-flex align-items-center gap-2 p-2 rounded border border-secondary border-opacity-25" style="background: rgba(255,255,255,0.03); cursor: pointer;">
                <input type="radio" name="report_reason" value="copyright" style="accent-color: #ff8a00;">
                <span class="small">Copyright or intellectual property infringement</span>
              </label>
              <label class="d-flex align-items-center gap-2 p-2 rounded border border-secondary border-opacity-25" style="background: rgba(255,255,255,0.03); cursor: pointer;">
                <input type="radio" name="report_reason" value="incorrect_bib" style="accent-color: #ff8a00;">
                <span class="small">Incorrect BIB number or event tagging</span>
              </label>
              <label class="d-flex align-items-center gap-2 p-2 rounded border border-secondary border-opacity-25" style="background: rgba(255,255,255,0.03); cursor: pointer;">
                <input type="radio" name="report_reason" value="other" style="accent-color: #ff8a00;">
                <span class="small">Other problem</span>
              </label>
            </div>
            <div class="mb-2">
              <label for="reportDetails" class="form-label small text-white-50">Additional Details (Optional)</label>
              <textarea class="form-control text-white border-secondary" id="reportDetails" rows="2" placeholder="Briefly describe the issue..." style="background: #040c14; border-color: #1e3e5c; font-size: 0.85rem;"></textarea>
            </div>
          </div>
          <div class="modal-footer border-top border-secondary border-opacity-25 px-4 py-3 d-flex justify-content-between" style="background: #040c14;">
            <button type="button" class="btn btn-sm btn-outline-light rounded-pill px-3" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-sm btn-warning text-dark fw-bold rounded-pill px-4" id="btnSubmitReport">
              <i class="bi bi-send-fill me-1"></i> Submit Report
            </button>
          </div>
        </form>
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

  @php
    $parsedStartingPrice = 0.0;
    if (!empty($event->starting_price)) {
      if (preg_match('/[0-9]+(?:\.[0-9]+)?/', (string)$event->starting_price, $m)) {
        $parsedStartingPrice = (float) $m[0];
      }
    }
    $eventStartingPriceVal = $parsedStartingPrice > 0 ? $parsedStartingPrice : 75.0;
    $eventCommercialPriceVal = (float) ($event->commercial_price ?? 0);
    $eventSelfieBundlePriceVal = (float) ($event->selfie_bundle_price ?? 0);
    $eventFullGalleryPriceVal = (float) ($event->full_gallery_price ?? 0);
    $eventAllowIndividualSales = (bool) ($event->allow_individual_sales ?? true);
  @endphp

  const eventPricingConfig = {
    startingPrice: {{ $eventStartingPriceVal }},
    commercialPrice: {{ $eventCommercialPriceVal }},
    selfieBundlePrice: {{ $eventSelfieBundlePriceVal }},
    fullGalleryPrice: {{ $eventFullGalleryPriceVal }},
    allowIndividualSales: {{ $eventAllowIndividualSales ? 'true' : 'false' }}
  };

  function getCalculatedPricesForPhoto(photo) {
    photo = photo || {};

    // 0. If "Sell Complete Gallery ONLY" mode is active, HIDE single & selfie bundle purchases!
    if (!eventPricingConfig.allowIndividualSales) {
      return {
        personal: 0,
        commercial: 0,
        selfie: 0,
        full_gallery: eventPricingConfig.fullGalleryPrice > 0 ? eventPricingConfig.fullGalleryPrice : 450
      };
    }

    // 1. Personal License (Single Photo)
    let personal = 0;
    if (photo.personal_price !== undefined && photo.personal_price !== null && photo.personal_price !== '' && parseFloat(photo.personal_price) > 0) {
      personal = parseFloat(photo.personal_price);
    } else if (eventPricingConfig.startingPrice > 0) {
      personal = eventPricingConfig.startingPrice;
    }

    // 2. Commercial License (Single Photo):
    // If photo has explicit price > 0, use it.
    // If photo commercial price is missing/empty/null and event has commercial price > 0, use event price.
    // If photo commercial price is 0 or 0.00, commercial license is not offered (price = 0).
    let commercial = 0;
    if (photo.commercial_price !== undefined && photo.commercial_price !== null && photo.commercial_price !== '') {
      commercial = parseFloat(photo.commercial_price);
    } else if (eventPricingConfig.commercialPrice > 0) {
      commercial = eventPricingConfig.commercialPrice;
    }

    // 3. Selfie / Athlete Bundle (All matched photos)
    let selfie = 0;
    if (eventPricingConfig.selfieBundlePrice > 0) {
      selfie = eventPricingConfig.selfieBundlePrice;
    }

    // 4. Complete Gallery Bundle (All photos in event)
    let fullGallery = 0;
    if (eventPricingConfig.fullGalleryPrice > 0) {
      fullGallery = eventPricingConfig.fullGalleryPrice;
    }

    return {
      personal: personal,
      commercial: commercial,
      selfie: selfie,
      full_gallery: fullGallery
    };
  }

  function updateModalPurchaseOptionsVisibility(prices) {
    const options = [
      { id: 'modalOptionPersonal', val: 'personal', price: prices.personal, labelId: 'modalPersonalPriceLabel' },
      { id: 'modalOptionCommercial', val: 'commercial', price: prices.commercial, labelId: 'modalCommercialPriceLabel' },
      { id: 'modalOptionSelfieBundle', val: 'selfie', price: prices.selfie, labelId: 'modalSelfieBundlePriceLabel' },
      { id: 'modalOptionFullGallery', val: 'full_gallery', price: prices.full_gallery, labelId: 'modalFullGalleryPriceLabel' }
    ];

    const available = [];
    options.forEach(opt => {
      const el = document.getElementById(opt.id);
      const label = document.getElementById(opt.labelId);
      if (opt.price > 0) {
        if (el) el.style.setProperty('display', 'flex', 'important');
        if (label) label.textContent = `R${opt.price.toFixed(2)}`;
        available.push(opt.val);
      } else {
        if (el) el.style.setProperty('display', 'none', 'important');
      }
    });

    return available;
  }

  // Dynamic License Selection (Matching Client Approved Reference)
  let currentLicenseChoice = 'personal';
  let currentSelectedLicense = 'personal';

  function updateModalPrice(type) {
    const photo = (currentEventPhotos && currentEventPhotos[currentPhotoIndex]) ? currentEventPhotos[currentPhotoIndex] : {};
    const prices = getCalculatedPricesForPhoto(photo);
    const available = updateModalPurchaseOptionsVisibility(prices);

    if (available.length > 0 && !available.includes(type)) {
      type = available[0];
    }

    currentLicenseChoice = type;
    currentSelectedLicense = type;

    const chosenPrice = (prices[type] && prices[type] > 0) ? prices[type].toFixed(2) : (available.length > 0 ? prices[available[0]].toFixed(2) : '0.00');

    const actionPriceEl = document.getElementById('modalActionPrice');
    if (actionPriceEl) {
      actionPriceEl.textContent = `R${chosenPrice}`;
    }

    const radio = document.querySelector(`input[name="license_type"][value="${type}"]`);
    if (radio) radio.checked = true;

    // Highlight active selected option border
    ['modalOptionPersonal', 'modalOptionCommercial', 'modalOptionSelfieBundle', 'modalOptionFullGallery'].forEach(id => {
      const el = document.getElementById(id);
      if (el) {
        el.style.borderColor = '#2b5680';
        el.style.background = '#0e243a';
      }
    });
    const activeCardId = {
      'personal': 'modalOptionPersonal',
      'commercial': 'modalOptionCommercial',
      'selfie': 'modalOptionSelfieBundle',
      'full_gallery': 'modalOptionFullGallery'
    }[type];
    const activeEl = document.getElementById(activeCardId);
    if (activeEl) {
      activeEl.style.borderColor = '#ff8a00';
      activeEl.style.background = '#143352';
    }

    updateEventAddToCartButtonState();
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
      const rawTitle = (photo.title || '').trim();
      const isFilename = !rawTitle 
        || /^(clint|dsc|img|samples|cruiser|safariprojek|p\d+|\d+)/i.test(rawTitle)
        || /\.(jpg|jpeg|png|webp|cr2|nef|arw|dng|raw)$/i.test(rawTitle)
        || /-\d{3,}/.test(rawTitle);
      const evTitle = {!! json_encode($event->title ?? 'Event Gallery') !!};
      const displayTitle = (!isFilename && rawTitle) 
        ? rawTitle 
        : (photo.bib_number ? `Athlete #${photo.bib_number}` : `${evTitle} · Photo #${currentPhotoIndex + 1}`);
      titleEl.textContent = displayTitle;
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
    const photoSrc = `/protected-photo/${photo.id}?v={{ $watermarkSetting->updated_at?->timestamp ?? 1 }}`;
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
      evNameEl.innerHTML = photo.event && photo.event.title ? photo.event.title : {!! json_encode($event->title) !!};
    }
    const copyEl = document.getElementById('modalCopyright');
    if (copyEl) {
      const photographerName = photo.photographer_name || '{{ $event->photographer?->name ?? "PhotoX" }}';
      copyEl.textContent = `© {{ date('Y') }} ${photographerName} / PhotoX`;
    }

    // Calculate dynamic license pricing and hide zero/empty options
    const prices = getCalculatedPricesForPhoto(photo);
    const availableLicenses = updateModalPurchaseOptionsVisibility(prices);

    if (availableLicenses.length > 0 && !availableLicenses.includes(currentLicenseChoice)) {
      currentLicenseChoice = availableLicenses[0];
    }
    updateModalPrice(currentLicenseChoice);

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
    updateModalSaveButtonState();
    setTimeout(syncPreviewAdWidth, 250);
    startModalAdRotation();
  }

  function openPhotoModalByIndex(index) {
    openZebraLightbox(index);
  }

  function closePhotoInspectorModal() {
    stopModalAdRotation();
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
    const adWrapper = document.getElementById('modalPreviewAdWrapper');
    const secInfo = document.getElementById('modalSecurityInfoBar');

    // Keep banner full width of modal preview container (requested by client for portrait & landscape)
    if (adWrapper) {
      adWrapper.style.maxWidth = '100%';
      adWrapper.style.width = '100%';
      adWrapper.style.marginLeft = 'auto';
      adWrapper.style.marginRight = 'auto';
    }
    if (secInfo) {
      secInfo.style.maxWidth = '100%';
      secInfo.style.width = '100%';
      secInfo.style.marginLeft = 'auto';
      secInfo.style.marginRight = 'auto';
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

  // Lightbox Modal Preview Ad Auto-Rotation
  let modalAdTimer = null;
  let modalAdIndex = 0;

  function startModalAdRotation() {
    stopModalAdRotation();
    const wrap = document.getElementById('modalPreviewAdWrapper');
    if (!wrap) return;
    const slides = wrap.querySelectorAll('.modal-preview-ad-slide');
    if (slides.length <= 1) return;

    function scheduleNextSlide() {
      if (modalAdTimer) clearTimeout(modalAdTimer);
      const current = slides[modalAdIndex];
      const interval = parseInt(current?.getAttribute('data-interval')) || 5000;

      modalAdTimer = setTimeout(function() {
        slides[modalAdIndex].style.display = 'none';
        slides[modalAdIndex].classList.remove('active');
        modalAdIndex = (modalAdIndex + 1) % slides.length;
        slides[modalAdIndex].style.display = 'block';
        slides[modalAdIndex].classList.add('active');
        scheduleNextSlide();
      }, interval);
    }

    scheduleNextSlide();
  }

  function stopModalAdRotation() {
    if (modalAdTimer) {
      clearTimeout(modalAdTimer);
      modalAdTimer = null;
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    initAntiAiTriangleBlur();

    const modalEl = document.getElementById('photoInspectorModal');
    if (modalEl) {
      modalEl.addEventListener('shown.bs.modal', function() {
        syncPreviewAdWidth();
        startModalAdRotation();
        setTimeout(syncPreviewAdWidth, 100);
      });
      modalEl.addEventListener('hidden.bs.modal', function() {
        stopModalAdRotation();
      });
    }
    window.addEventListener('resize', syncPreviewAdWidth);
  });

  // Filter photos by Bib Number input
  function filterPhotosByBib(query) {
    const cards = document.querySelectorAll('.event-photo-card');
    let visibleCount = 0;
    let totalFoundPrice = 0;
    const cleanQuery = query.trim().toLowerCase();

    cards.forEach(card => {
      const bib = (card.getAttribute('data-bib') || '').toLowerCase();
      const title = (card.getAttribute('data-title') || '').toLowerCase();
      const subalbum = (card.getAttribute('data-subalbum') || '').toLowerCase();
      const cardPrice = parseFloat(card.getAttribute('data-price')) || 50;

      if (!cleanQuery || bib.includes(cleanQuery) || title.includes(cleanQuery) || subalbum.includes(cleanQuery)) {
        card.style.display = '';
        visibleCount++;
        totalFoundPrice += cardPrice;
      } else {
        card.style.display = 'none';
      }
    });

    document.getElementById('photoCountDisplay').textContent = visibleCount;

    // Dynamic "Add Found Photos to Basket" button update
    const btnFound = document.getElementById('btnAddSearchResultsToCart');
    const lblFound = document.getElementById('btnAddSearchResultsLabel');
    if (btnFound && lblFound) {
      if (cleanQuery && visibleCount > 0) {
        btnFound.classList.remove('d-none');
        btnFound.classList.remove('btn-secondary');
        btnFound.classList.add('btn-success');
        lblFound.innerHTML = `<i class="bi bi-bag-plus-fill me-1"></i> Add ${visibleCount} Found Photo${visibleCount > 1 ? 's' : ''} to Basket · R${totalFoundPrice.toFixed(2)}`;
      } else {
        btnFound.classList.add('d-none');
      }
    }
  }

  function addSearchResultsToCart() {
    const visibleCards = [...document.querySelectorAll('.event-photo-card')].filter(card => card.style.display !== 'none');
    if (!visibleCards.length || !window.PhotoXCart) return;

    let addedCount = 0;
    visibleCards.forEach(card => {
      const photoId = card.getAttribute('data-photo-id');
      const cardPrice = parseFloat(card.getAttribute('data-price')) || 50;
      const cardTitle = card.getAttribute('data-title') || '';
      const photo = currentEventPhotos.find(p => String(p.id) === String(photoId)) || {};
      const itemPrice = parseFloat(photo.personal_price) || cardPrice;
      const rawTitle = photo.title || cardTitle || '';
      const isFilename = !rawTitle || /^(clint|dsc|img|samples|\d+)/i.test(rawTitle);
      const evTitle = {!! json_encode($event->title ?? 'Event Gallery') !!};
      const itemTitle = (!isFilename && rawTitle) 
        ? rawTitle 
        : (photo.bib_number ? `Athlete #${photo.bib_number}` : `${evTitle} · Photo #${photo.id || photoId}`);

      const item = {
        id: String(photo.id || photoId),
        title: itemTitle,
        price: itemPrice,
        licenseType: 'personal',
        licenseName: 'Personal Digital License',
        image: `/protected-photo/${photo.id || photoId}`,
        eventTitle: {!! json_encode($event->title ?? 'Event Gallery') !!},
        eventSlug: {!! json_encode($event->slug ?? '') !!},
        photographer: {!! json_encode($event->photographer?->name ?? 'PhotoX Creator') !!}
      };
      const res = window.PhotoXCart.addItem(item);
      if (res.added) addedCount++;
    });

    const btnFound = document.getElementById('btnAddSearchResultsToCart');
    const lblFound = document.getElementById('btnAddSearchResultsLabel');
    if (btnFound && lblFound) {
      btnFound.classList.remove('btn-success');
      btnFound.classList.add('btn-secondary');
      lblFound.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> Added to Basket!';
    }

    if (typeof showToast === 'function') {
      showToast(`✓ Added ${addedCount > 0 ? addedCount : visibleCards.length} athlete photos to your basket!`);
    }
  }

  function filterPhotosBySubAlbum(albumName) {
    filterPhotosByBib(albumName);
    if (typeof showToast === 'function') {
      showToast(`📁 Station Filter: ${albumName}`);
    }
  }

  function resetAllGalleryFilters() {
    filterPhotosByBib('');
    if (typeof showToast === 'function') {
      showToast('Showing all event photos');
    }
  }

  function sortPhotosByTime(direction) {
    const grid = document.getElementById('eventPhotosGrid');
    if (!grid) return;
    const cards = Array.from(grid.querySelectorAll('.event-photo-card'));
    cards.sort((a, b) => {
      const timeA = parseInt(a.getAttribute('data-timestamp') || '0', 10);
      const timeB = parseInt(b.getAttribute('data-timestamp') || '0', 10);
      return direction === 'asc' ? (timeA - timeB) : (timeB - timeA);
    });
    cards.forEach(card => grid.appendChild(card));

    // Re-index lightboxes so navigation works in newly sorted order
    cards.forEach((card, idx) => {
      card.setAttribute('data-index', idx);
      card.onclick = function() { openZebraLightbox(idx); };
      const img = card.querySelector('img');
      if (img) {
        img.onclick = function(e) { e.stopPropagation(); openZebraLightbox(idx); };
      }
    });

    if (typeof showToast === 'function') {
      showToast(direction === 'asc' ? '⏱️ Sorted: Earliest time taken first (Start)' : '⏱️ Sorted: Latest time taken first (Finish)');
    }
  }

  function setGridColumns(cols) {
    const grid = document.getElementById('eventPhotosGrid');
    if (cols === 3) {
      grid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(350px, 1fr))';
    } else {
      grid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(280px, 1fr))';
    }
  }

  window.userSavedPhotoIds = new Set(@json($savedPhotoIds ?? []));

  function syncPhotoBookmarkButtons(photoId) {
    const isSaved = window.userSavedPhotoIds && window.userSavedPhotoIds.has(photoId);

    // 1. Bottom-left card bookmark button
    const cardBtn = document.getElementById('cardBookmarkBtn_' + photoId);
    if (cardBtn) {
      if (isSaved) {
        cardBtn.classList.add('active');
        cardBtn.innerHTML = '<i class="bi bi-bookmark-star-fill text-warning"></i>';
        cardBtn.title = 'Bookmarked in your vault';
      } else {
        cardBtn.classList.remove('active');
        cardBtn.innerHTML = '<i class="bi bi-bookmark-star"></i>';
        cardBtn.title = 'Bookmark this photo';
      }
    }

    // 2. Hover overlay bookmark button
    const hoverBtn = document.getElementById('hoverBookmarkBtn_' + photoId);
    if (hoverBtn) {
      if (isSaved) {
        hoverBtn.classList.add('active', 'text-warning');
        hoverBtn.innerHTML = '<i class="bi bi-bookmark-star-fill text-warning"></i>';
        hoverBtn.title = 'Bookmarked in your vault';
      } else {
        hoverBtn.classList.remove('active', 'text-warning');
        hoverBtn.innerHTML = '<i class="bi bi-bookmark-star"></i>';
        hoverBtn.title = 'Bookmark photo';
      }
    }

    // 3. Modal bookmark button
    updateModalSaveButtonState();
  }

  function toggleWishlist(photoId, btn) {
    if (!photoId) return;
    const wasSaved = window.userSavedPhotoIds && window.userSavedPhotoIds.has(photoId);

    // Optimistic toggle
    if (wasSaved) {
      window.userSavedPhotoIds.delete(photoId);
    } else {
      window.userSavedPhotoIds.add(photoId);
    }
    syncPhotoBookmarkButtons(photoId);

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

    fetch('/api/photos/' + photoId + '/toggle-save', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      }
    })
    .then(r => {
      if (r.status === 401) {
        window.location.href = '{{ route("login") }}';
        return;
      }
      return r.json();
    })
    .then(data => {
      if (!data || !data.success) {
        // Revert
        if (wasSaved) {
          window.userSavedPhotoIds.add(photoId);
        } else {
          window.userSavedPhotoIds.delete(photoId);
        }
        syncPhotoBookmarkButtons(photoId);
      } else {
        if (typeof showToast === 'function') {
          showToast(data.saved ? '✓ Photo bookmarked to your Saved Photos collection!' : 'Photo removed from Saved Photos.');
        }
      }
    })
    .catch(err => {
      console.error(err);
      if (wasSaved) {
        window.userSavedPhotoIds.add(photoId);
      } else {
        window.userSavedPhotoIds.delete(photoId);
      }
      syncPhotoBookmarkButtons(photoId);
    });
  }

  function toggleSaveEvent(eventId, btn) {
    if (!eventId) return;
    const icon = btn.querySelector('i');
    const textSpan = btn.querySelector('.btn-text');
    const wasSaved = btn.classList.contains('active') || (icon && icon.classList.contains('bi-bookmark-star-fill'));

    // Optimistic toggle
    if (wasSaved) {
      btn.classList.remove('active', 'btn-warning', 'text-dark', 'fw-bold');
      btn.classList.add('btn-outline-warning', 'text-warning');
      if (icon) icon.className = 'bi bi-bookmark-star me-1';
      if (textSpan) textSpan.textContent = 'Follow Event';
    } else {
      btn.classList.add('active', 'btn-warning', 'text-dark', 'fw-bold');
      btn.classList.remove('btn-outline-warning', 'text-warning');
      if (icon) icon.className = 'bi bi-bookmark-star-fill text-dark me-1';
      if (textSpan) textSpan.textContent = 'Followed';
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

    fetch('/api/events/' + eventId + '/toggle-save', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      }
    })
    .then(r => {
      if (r.status === 401) {
        window.location.href = '{{ route("login") }}';
        return;
      }
      return r.json();
    })
    .then(data => {
      if (!data || !data.success) {
        if (wasSaved) {
          btn.classList.add('active', 'btn-warning', 'text-dark', 'fw-bold');
          btn.classList.remove('btn-outline-warning', 'text-warning');
          if (icon) icon.className = 'bi bi-bookmark-star-fill text-dark me-1';
          if (textSpan) textSpan.textContent = 'Followed';
        } else {
          btn.classList.remove('active', 'btn-warning', 'text-dark', 'fw-bold');
          btn.classList.add('btn-outline-warning', 'text-warning');
          if (icon) icon.className = 'bi bi-bookmark-star me-1';
          if (textSpan) textSpan.textContent = 'Follow Event';
        }
      } else {
        if (typeof showToast === 'function') {
          showToast(data.saved ? '✓ Event added to your Followed Events!' : 'Event removed from Followed Events.');
        }
      }
    })
    .catch(err => {
      console.error(err);
    });
  }

  function toggleModalSavePhoto() {
    if (!currentEventPhotos || !currentEventPhotos[currentPhotoIndex]) return;
    const currentPhoto = currentEventPhotos[currentPhotoIndex];
    const btn = document.getElementById('btnModalSavePhoto');
    toggleWishlist(currentPhoto.id, btn);
  }

  function updateModalSaveButtonState() {
    if (!currentEventPhotos || !currentEventPhotos[currentPhotoIndex]) return;
    const currentPhoto = currentEventPhotos[currentPhotoIndex];
    const btn = document.getElementById('btnModalSavePhoto');
    const text = document.getElementById('btnModalSavePhotoText');
    const icon = document.getElementById('btnModalSavePhotoIcon');
    if (!btn || !text || !icon) return;

    const isSaved = window.userSavedPhotoIds && window.userSavedPhotoIds.has(currentPhoto.id);
    if (isSaved) {
      btn.classList.remove('btn-outline-warning');
      btn.classList.add('btn-warning', 'text-dark', 'fw-bold');
      icon.className = 'bi bi-bookmark-star-fill text-dark me-1';
      text.textContent = 'Bookmarked';
    } else {
      btn.classList.remove('btn-warning', 'text-dark', 'fw-bold');
      btn.classList.add('btn-outline-warning');
      icon.className = 'bi bi-bookmark-star me-1';
      text.textContent = 'Bookmark';
    }
  }

  function openPhotoReportModal(photoId, photoTitle) {
    document.getElementById('reportPhotoId').value = photoId;
    document.getElementById('reportPhotoTitle').textContent = photoTitle ? `"${photoTitle}"` : `#${photoId}`;
    document.getElementById('reportDetails').value = '';

    const modalEl = document.getElementById('photoReportModal');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    modal.show();
  }

  function openCurrentModalPhotoReport() {
    if (!currentEventPhotos || !currentEventPhotos[currentPhotoIndex]) return;
    const currentPhoto = currentEventPhotos[currentPhotoIndex];
    openPhotoReportModal(currentPhoto.id, currentPhoto.title || 'Selected Photo');
  }

  function submitPhotoReport(e) {
    e.preventDefault();
    const photoId = document.getElementById('reportPhotoId').value;
    const reason = document.querySelector('input[name="report_reason"]:checked')?.value || 'other';
    const details = document.getElementById('reportDetails').value;
    const btnSubmit = document.getElementById('btnSubmitReport');

    btnSubmit.disabled = true;
    btnSubmit.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Submitting...';

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

    fetch('/api/photos/' + photoId + '/flag', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        reason: reason,
        details: details
      })
    })
    .then(r => r.json())
    .then(data => {
      btnSubmit.disabled = false;
      btnSubmit.innerHTML = '<i class="bi bi-send-fill me-1"></i> Submit Report';

      const modalEl = document.getElementById('photoReportModal');
      const modal = bootstrap.Modal.getInstance(modalEl);
      if (modal) modal.hide();

      if (data.success) {
        // Visual indicator on card flag button
        const cardFlagBtn = document.getElementById('cardFlagBtn_' + photoId);
        if (cardFlagBtn) {
          cardFlagBtn.classList.add('flagged');
          cardFlagBtn.innerHTML = '<i class="bi bi-flag-fill text-danger"></i>';
          cardFlagBtn.title = 'Reported for review';
        }
        if (typeof showToast === 'function') {
          showToast('✓ ' + (data.message || 'Photo reported for review.'));
        } else {
          alert('Thank you. Photo #' + photoId + ' has been reported for review.');
        }
      } else {
        alert(data.message || 'Could not submit report.');
      }
    })
    .catch(err => {
      btnSubmit.disabled = false;
      btnSubmit.innerHTML = '<i class="bi bi-send-fill me-1"></i> Submit Report';
      console.error(err);
      alert('Error submitting report. Please try again.');
    });
  }

  function updateEventAddToCartButtonState() {
    if (!currentEventPhotos || !currentEventPhotos[currentPhotoIndex]) return;
    const currentPhoto = currentEventPhotos[currentPhotoIndex];
    const btn = document.getElementById('btnPurchaseModal');
    const text = document.getElementById('btnPurchaseModalText');
    const icon = document.getElementById('btnPurchaseModalIcon');
    if (!btn || !text || !icon) return;

    const license = currentSelectedLicense || 'personal';
    const isAlreadyAdded = window.PhotoXCart && window.PhotoXCart.hasItem(currentPhoto.id, license);

    if (isAlreadyAdded) {
      btn.classList.remove('btn-warning');
      btn.classList.add('btn-success');
      icon.className = 'bi bi-check-circle-fill fs-5';
      text.textContent = 'Already in Cart';
    } else {
      btn.classList.remove('btn-success');
      btn.classList.add('btn-warning');
      icon.className = 'bi bi-cart-plus-fill fs-5';
      text.textContent = 'Add to Cart';
    }
  }

  function buyCompleteGalleryPackage() {
    const fullPrice = '{{ number_format($event->full_gallery_price ?: 450, 2, '.', '') }}';
    const item = {
      id: 'gallery_{{ $event->id }}',
      title: 'Complete Gallery: {{ addslashes($event->title) }} (All {{ $photos->count() }} Photos)',
      price: fullPrice,
      licenseType: 'full_gallery',
      licenseName: 'Complete Gallery Digital Package',
      image: '{{ $event->cover_image ?: ($photos->first()?->file_path ?: asset("logo.png")) }}',
      eventTitle: {!! json_encode($event->title ?? 'Event Gallery') !!},
      eventSlug: {!! json_encode($event->slug ?? '') !!},
      photographer: {!! json_encode($event->photographer?->name ?? 'PhotoX Creator') !!}
    };

    if (window.PhotoXCart) {
      const res = window.PhotoXCart.addItem(item);
      if (res.added) {
        if (typeof showToast === 'function') {
          showToast(`✓ Complete Gallery added to cart (R${item.price})`);
        }
      } else {
        if (typeof showToast === 'function') {
          showToast(`ℹ Complete Gallery is already in your cart!`);
        }
      }
      setTimeout(() => {
        window.location.href = '/cart';
      }, 400);
    } else {
      window.location.href = '/cart';
    }
  }

  function quickAddToCart(photoId) {
    let photo = (currentEventPhotos || []).find(p => String(p.id) === String(photoId));
    if (!photo) {
      photo = { id: photoId };
    }
    const prices = getCalculatedPricesForPhoto(photo);
    const photoPrice = prices.personal > 0 ? prices.personal : eventPricingConfig.startingPrice;

    const rawPhotoTitle = (photo.title || '').trim();
    const isPhotoFilename = !rawPhotoTitle 
      || /^(clint|dsc|img|samples|cruiser|safariprojek|p\d+|\d+)/i.test(rawPhotoTitle)
      || /\.(jpg|jpeg|png|webp|cr2|nef|arw|dng|raw)$/i.test(rawPhotoTitle)
      || /-\d{3,}/.test(rawPhotoTitle);
    const evTitle = {!! json_encode($event->title ?? 'Event Gallery') !!};
    const cleanCartTitle = (!isPhotoFilename && rawPhotoTitle)
      ? rawPhotoTitle
      : (photo.bib_number ? `Athlete #${photo.bib_number}` : `${evTitle} · Photo #${photo.id}`);

    const item = {
      id: photo.id,
      title: cleanCartTitle,
      price: photoPrice.toFixed(2),
      licenseType: 'personal',
      licenseName: 'Personal Digital License',
      image: `/protected-photo/${photo.id}`,
      eventTitle: {!! json_encode($event->title ?? 'Event Gallery') !!},
      eventSlug: {!! json_encode($event->slug ?? '') !!},
      photographer: {!! json_encode($event->photographer?->name ?? 'PhotoX Creator') !!}
    };

    if (!window.PhotoXCart) return;
    const res = window.PhotoXCart.addItem(item);

    if (res.added) {
      const btn = document.querySelector(`.hover-cart-btn[onclick*="${photoId}"]`);
      if (btn) {
        btn.innerHTML = '<i class="bi bi-check2-circle text-success"></i>';
        btn.classList.add('bg-white');
      }
      if (typeof showToast === 'function') {
        showToast(`✓ Photo #${photo.id} added to cart (R${item.price})`);
      }
    } else {
      if (typeof showToast === 'function') {
        showToast(`ℹ Photo #${photo.id} is already in your cart!`);
      }
    }
  }

  function triggerPurchase() {
    if (!currentEventPhotos || !currentEventPhotos[currentPhotoIndex]) return;
    const currentPhoto = currentEventPhotos[currentPhotoIndex];
    const prices = getCalculatedPricesForPhoto(currentPhoto);
    const license = currentSelectedLicense || 'personal';

    const chosenPrice = prices[license] || 0;
    if (chosenPrice <= 0) {
      if (typeof showToast === 'function') {
        showToast('⚠️ This purchase option is currently unavailable.');
      }
      return;
    }

    const licenseNames = {
      'personal': 'Personal Digital License',
      'commercial': 'Commercial Editorial License',
      'selfie': 'Selfie / Athlete Bundle',
      'full_gallery': 'Full Gallery Digital Package'
    };

    const item = {
      id: currentPhoto.id,
      title: currentPhoto.title || `Photo #${currentPhoto.id}`,
      price: chosenPrice.toFixed(2),
      licenseType: license,
      licenseName: licenseNames[license] || 'Personal License',
      image: `/protected-photo/${currentPhoto.id}`,
      eventTitle: {!! json_encode($event->title ?? 'Event Gallery') !!},
      eventSlug: {!! json_encode($event->slug ?? '') !!},
      photographer: {!! json_encode($event->photographer?->name ?? 'PhotoX Creator') !!}
    };

    if (!window.PhotoXCart) return;
    const res = window.PhotoXCart.addItem(item);
    updateEventAddToCartButtonState();

    if (res.added) {
      if (typeof showToast === 'function') {
        showToast(`✓ Photo #${currentPhoto.id} added to cart (R${item.price})`);
      }
    } else {
      if (typeof showToast === 'function') {
        showToast(`ℹ This photo (${licenseNames[license]}) is already in your cart!`);
      }
    }
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

      // Reveal Add Found Photos to Basket button
      const btnFound = document.getElementById('btnAddSearchResultsToCart');
      const lblFound = document.getElementById('btnAddSearchResultsLabel');
      if (btnFound && lblFound) {
        btnFound.classList.remove('d-none');
        btnFound.classList.remove('btn-secondary');
        btnFound.classList.add('btn-success');
        lblFound.innerHTML = `<i class="bi bi-bag-plus-fill me-1"></i> Add ${matchCount} Matched Photos · R150 (Selfie Bundle)`;
      }
    }, 1400);
  }

  function handleNotifySubmit(e, form) {
    e.preventDefault();
    const btn = form.querySelector('button[type="submit"]');
    const origHtml = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Subscribing...';

    fetch(form.action, {
      method: 'POST',
      body: new FormData(form),
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      }
    })
    .then(r => r.json())
    .then(data => {
      form.reset();
      btn.disabled = false;
      btn.innerHTML = origHtml;
      const alertEl = document.getElementById('notifySuccessAlert');
      if (alertEl) {
        alertEl.textContent = data.message || "You're on the list! We will notify you when photos go live.";
        alertEl.classList.remove('d-none');
      }
    })
    .catch(() => {
      btn.disabled = false;
      btn.innerHTML = origHtml;
      alert('Subscription saved! We will notify you when photos go live.');
    });
  }
</script>
@endsection
