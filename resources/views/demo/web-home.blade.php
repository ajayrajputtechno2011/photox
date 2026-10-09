@extends('web.layouts.app')

@section('title', 'PhotoX | Find the moment. Then keep it.')
@section('body-class', 'page-events page-home')

@section('content')
  @php
    $latestEvents = $latestEvents ?? collect();
    $galleryPhotos = $galleryPhotos ?? collect();
    $categories = $categories ?? collect();
    $popularCategories = $popularCategories ?? collect();
    $events = $latestEvents;
  @endphp

@section('styles')
  <style>
    /* Clean client presentation mode: hide admin pills and admin panel links */
    .page-home .dropdown .badge.bg-danger,
    .page-home .dropdown a[href*="/admin"] {
      display: none !important;
    }

    /* Responsive Percentage Scaling for Photo Inspector Modal (Requested by Client for large screens) */
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
      min-height: 560px !important;
      padding: 1.5rem !important;
      background: #02070d !important;
      position: relative !important;
    }

    #photoInspectorModal #modalPhotoContainer {
      position: relative !important;
      display: inline-block !important;
      max-height: 62vh !important;
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
      max-height: 62vh !important;
      max-width: 100% !important;
      width: auto !important;
      height: auto !important;
      display: block !important;
      object-fit: contain !important;
      border-radius: 8px !important;
      margin: 0 auto !important;
    }

    #photoInspectorModal #modalPhotoImgBlur {
      width: 100% !important;
      height: 100% !important;
      max-width: 100% !important;
      max-height: 100% !important;
      object-fit: fill !important;
      display: block !important;
      filter: blur(3.5px) contrast(1.05) brightness(0.98);
      pointer-events: none;
      user-select: none;
    }

    /* Hero Section: Compact Height & Balanced 50% - 50% Split (Client Requested) */
    body.page-home .events-page-hero {
      padding: 50px 0 42px !important;
      padding-right: 0 !important;
    }
    body.page-home .events-page-hero .hero-intro-col {
      max-width: 100% !important;
      padding-right: 15px;
    }
    body.page-home .events-page-hero h1,
    body.page-home .events-page-hero .hero-title {
      font-size: clamp(2.3rem, 3.6vw, 3.7rem) !important;
      line-height: 1.05 !important;
      letter-spacing: -0.04em !important;
      max-width: 100% !important;
      margin-bottom: 16px !important;
    }
    body.page-home .events-page-hero p,
    body.page-home .events-page-hero .hero-desc {
      font-size: 1.05rem !important;
      line-height: 1.55 !important;
      color: rgba(255, 255, 255, 0.88) !important;
      max-width: 100% !important;
      margin-bottom: 22px !important;
    }
    body.page-home .events-page-hero .hero-banner-col {
      display: flex;
      justify-content: center;
      align-items: center;
    }
    body.page-home .events-page-hero .hero-banner-frame {
      width: 100%;
      max-width: 620px;
    }
    body.page-home .events-page-hero .hero-ad-carousel {
      position: relative !important;
      top: auto !important;
      right: auto !important;
      left: auto !important;
      bottom: auto !important;
      transform: none !important;
      width: 100% !important;
      max-width: 100% !important;
      height: auto !important;
      aspect-ratio: 16 / 9.5 !important;
      border-radius: 14px !important;
      overflow: hidden !important;
      box-shadow: 0 16px 38px rgba(0, 0, 0, 0.35) !important;
      border: 1px solid rgba(255, 255, 255, 0.12) !important;
      margin: 0 !important;
    }
    body.page-home .events-page-hero .hero-ad-slide img {
      border-radius: 14px !important;
      object-fit: cover !important;
    }
    @media (max-width: 991.98px) {
      body.page-home .events-page-hero {
        padding: 38px 0 34px !important;
      }
      body.page-home .events-page-hero .hero-intro-col {
        padding-right: 0;
      }
      body.page-home .events-page-hero .hero-banner-frame {
        max-width: 520px;
        margin-top: 10px;
      }
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
  </style>
@endsection

  <main>
    <!-- 1. HERO SECTION (Balanced 50/50 Split & Compact Height - Client Requested) -->
    <section class="events-page-hero">
      @php
        $hero = $pageHeroes['home'] ?? ($pageHeroes['events'] ?? null);
      @endphp
      <div class="container-xl position-relative" style="z-index: 2;">
        <div class="row align-items-center g-4 g-lg-5">
          <!-- Left 50%: Hero Kicker, Title, Description, and Actions -->
          <div class="col-lg-6 hero-intro-col">
            <div class="section-kicker"><span class="live-dot"></span>{{ $hero->kicker ?? 'Live archive' }}</div>
            <h1 class="hero-title">{!! !empty($hero->title) ? nl2br($hero->title) : 'Find the moment. <br><em>Then keep it.</em>' !!}</h1>
            <p class="hero-desc">{{ $hero->description ?? 'Explore premium sports and event galleries across the country. From city marathons to school finals, every listing is designed to make browsing and buying photos simple, secure and fast.' }}</p>
            <div class="hero-actions">
              <a class="btn btn-lime rounded-pill px-4 py-2 fw-semibold" href="#latest-events">Browse events</a>
              <a class="btn btn-outline-light rounded-pill px-4 py-2 fw-semibold" href="#browse-gallery">Browse gallery</a>
            </div>
          </div>
          <!-- Right 50%: Prominent Banner Ad Carousel -->
          <div class="col-lg-6 hero-banner-col">
            <div class="hero-banner-frame">
              @include('web.partials.hero-ad-carousel')
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- 2. SEARCH BAR -->
    <section class="search-wrap" id="discover">
      <div class="container-xl">
        <div class="search-card">
          <form action="#browse-gallery" method="GET" class="search-grid" onsubmit="handleSearchSubmit(event)">
            <input type="search" id="heroSearchInput" name="q" placeholder="Search by event, venue, school or photographer">
            <select id="heroCategorySelect" name="category" aria-label="Sport type" onchange="onCategorySelectChange(this.value)">
              <option value="all">All categories</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->name }}">{{ $cat->name }}</option>
              @endforeach
            </select>
            <button type="submit">Filter Gallery <i class="bi bi-arrow-down ms-2"></i></button>
          </form>
        </div>
      </div>
    </section>

    <!-- 3. LATEST EVENTS SECTION -->
    <section class="content-section" id="latest-events">
      <div class="container-xl">
        <div class="section-header">
          <div>
            <div class="section-kicker" style="background:#eaf3ff;color:#0b2d5b;border-color:rgba(11,45,91,.08);">
              Featured archive
            </div>
            <h2 class="section-title">Latest events</h2>
            <p class="text-muted small mb-0 mt-1">Browse high-impact tournament and race photography. Click any event to filter the gallery below.</p>
          </div>
          <div class="d-flex align-items-center gap-2">
            <a class="inline-link" href="#browse-gallery">View full gallery <i class="bi bi-arrow-down"></i></a>
          </div>
        </div>

        <div class="event-grid">
          @forelse($latestEvents as $item)
            <article class="event-card" style="cursor: pointer;" onclick="filterByEvent({{ $item->id }}, '{{ addslashes($item->title) }}')">
              <a href="javascript:void(0)" onclick="filterByEvent({{ $item->id }}, '{{ addslashes($item->title) }}')" class="text-decoration-none text-reset d-block">
                <div class="position-relative overflow-hidden" style="aspect-ratio: 16 / 10; background: #0b1a29;">
                  <img src="{{ $item->cover_image }}" alt="{{ $item->title }}" class="w-100 h-100 object-fit-cover" loading="lazy">
                  <span class="position-absolute top-0 end-0 m-2 badge bg-dark bg-opacity-75 text-warning border border-warning" style="font-size: 0.70rem;">
                    <i class="bi bi-images me-1"></i> {{ number_format($item->photos_count ?? $item->total_photos ?? 24) }} photos
                  </span>
                </div>
                <div class="body">
                  <div class="meta-row">
                    <span class="tag">{{ $item->category_name }}</span>
                    <span class="date">{{ $item->event_date ? \Carbon\Carbon::parse($item->event_date)->format('d M Y') : '' }}</span>
                  </div>
                  <h3>{{ $item->title }}</h3>
                  <p>{{ $item->location }} · {{ number_format($item->photos_count ?? $item->total_photos ?? 24) }} photos @if($item->photographer || $item->photographer_name) · {{ $item->photographer?->name ?? $item->photographer_name }} @endif</p>
                  <div class="card-bottom">
                    <span class="price">{{ $item->starting_price ?? 'From R50' }}</span>
                    <a class="cta text-decoration-none text-center" href="/event-details/{{ $item->slug }}" onclick="event.stopPropagation();">
                      View gallery
                    </a>
                  </div>
                </div>
              </a>
            </article>
          @empty
            <div class="col-12 text-center py-5 bg-light rounded-4 border">
              <i class="bi bi-calendar-event fs-1 text-muted"></i>
              <h4 class="mt-3">Events archive</h4>
              <p class="text-muted">Featured event galleries will be published here.</p>
            </div>
          @endforelse
        </div>
      </div>
    </section>

    <!-- 4. BROWSE EVERY GALLERY (Live Watermarked Photos with Interactive Category / Event Filter) -->
    <section class="content-section" id="browse-gallery" style="background: rgba(230,240,255,.75);">
      <div class="container-xl">
        <div class="section-header">
          <div>
            <div class="section-kicker" style="background:#eaf3ff;color:#0b2d5b;border-color:rgba(11,45,91,.08);">
              Protected Galleries
            </div>
            <h2 class="section-title">Browse every gallery</h2>
            <p class="text-muted small mb-0 mt-1">Photos rendered dynamically with protected security overlays. Click any photo to open the inspector with Next/Previous navigation.</p>
          </div>
          <div class="d-flex align-items-center gap-3">
            <a class="inline-link" href="#popular-categories">View categories <i class="bi bi-arrow-down"></i></a>
          </div>
        </div>

        <!-- CATEGORY PILLS BAR -->
        <div class="mb-4 d-flex align-items-center gap-2 flex-wrap" id="categoryPillsContainer">
          <button type="button" class="btn btn-sm rounded-pill px-3 py-1 fw-bold category-pill-btn active" data-cat="all" onclick="filterByCategory('all')">
            All Categories <span class="badge bg-secondary ms-1" id="totalPhotoCountBadge">{{ $galleryPhotos->count() }}</span>
          </button>

          @php
            $catsWithCounts = $categories->map(function($c) use ($galleryPhotos) {
                $count = $galleryPhotos->filter(function($p) use ($c) {
                    return ($p->event && $p->event->category_name === $c->name);
                })->count();
                return ['name' => $c->name, 'count' => $count];
            })->filter(function($item) {
                return $item['count'] > 0;
            });
          @endphp

          @foreach($catsWithCounts as $catItem)
            <button type="button" class="btn btn-sm rounded-pill px-3 py-1 category-pill-btn" data-cat="{{ $catItem['name'] }}" onclick="filterByCategory('{{ addslashes($catItem['name']) }}')">
              {{ $catItem['name'] }} <span class="badge bg-light text-dark border ms-1">{{ $catItem['count'] }}</span>
            </button>
          @endforeach
        </div>

        <!-- ACTIVE FILTER STATUS INDICATOR -->
        <div id="activeFilterBanner" class="alert alert-info d-none align-items-center justify-content-between mb-4 py-2 px-3 rounded-3 shadow-sm" style="background: #eaf3ff; border: 1px solid #bfdbfe; color: #0b2d5b;">
          <div class="d-flex align-items-center gap-2">
            <i class="bi bi-funnel-fill text-primary"></i>
            <span id="activeFilterText" class="small">Filtered by: <strong>All</strong></span>
            <span class="badge bg-primary text-white font-monospace" id="filteredCountBadge">0 photos</span>
          </div>
          <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-0" style="font-size: 0.75rem;" onclick="clearAllFilters()">
            <i class="bi bi-x-circle me-1"></i> Clear Filter
          </button>
        </div>

        <!-- GALLERY PHOTO GRID -->
        <div class="row g-4" id="galleryPhotoGrid">
          @forelse($galleryPhotos as $index => $photo)
            <div class="col-12 col-md-6 col-lg-4 photo-card-wrapper" 
                 data-photo-id="{{ $photo->id }}"
                 data-event-id="{{ $photo->event_id }}"
                 data-category="{{ $photo->event->category_name ?? 'General' }}"
                 data-index="{{ $index }}">
              <div class="card h-100 shadow-sm border-0 photo-display-card" style="background: #ffffff; border-radius: 16px; overflow: hidden; border: 1px solid rgba(11,45,91,0.08) !important; transition: all 0.25s ease;" onmouseenter="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)';" onmouseleave="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.04)';">
                
                <!-- Watermarked Photo Stage with Anti-Theft Shield -->
                <div class="position-relative overflow-hidden photo-thumb-box" style="aspect-ratio: 4 / 3; background: #0b1a29; cursor: pointer;" onclick="openPhotoModalByIndex({{ $index }})">
                  <!-- Server-burned Watermarked Photo -->
                  <img src="/protected-photo/{{ $photo->id }}" 
                       alt="{{ $photo->title }}" 
                       class="w-100 h-100 object-fit-cover" 
                       draggable="false" 
                       oncontextmenu="return false;" 
                       loading="lazy">

                  <!-- Anti-Theft Transparent Interceptor Shield -->
                  <div class="position-absolute top-0 start-0 w-100 h-100" 
                       style="z-index: 5; background: transparent; cursor: pointer;" 
                       title="Protected by PhotoX Rights Protection · Click to inspect metadata" 
                       oncontextmenu="showProtectedToast(event); return false;" 
                       ondragstart="return false;">
                  </div>

                  <!-- Badge Overlay -->
                  <div class="position-absolute top-0 end-0 m-2 px-2 py-1 rounded" style="background: rgba(0,0,0,0.75); backdrop-filter: blur(4px); font-size: 0.70rem; color: #ff8a00; font-weight: 700; z-index: 6; pointer-events: none;">
                    <i class="bi bi-shield-shaded me-1"></i> PHOTOX PROOF
                  </div>

                  <div class="position-absolute top-0 start-0 m-2 px-2 py-1 rounded" style="background: rgba(0,0,0,0.75); backdrop-filter: blur(4px); font-size: 0.70rem; color: #cbd5e1; font-weight: 600; z-index: 6; pointer-events: none;">
                    <i class="bi bi-tag me-1 text-warning"></i> {{ $photo->event->category_name ?? 'Sports' }}
                  </div>

                  <!-- Hover Hint -->
                  <div class="position-absolute bottom-0 start-0 w-100 p-2 text-center text-white" style="background: linear-gradient(to top, rgba(0,0,0,0.9), transparent); font-size: 0.75rem; z-index: 6; pointer-events: none;">
                    <i class="bi bi-zoom-in me-1"></i> Click to inspect &amp; browse next/previous
                  </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-3 d-flex flex-column justify-content-between">
                  <div>
                    <div class="d-flex justify-content-between align-items-center mb-1">
                      <h4 class="text-dark fs-6 fw-bold mb-0 text-truncate" title="{{ $photo->title }}">{{ $photo->title }}</h4>
                      <span class="badge bg-light text-secondary border font-monospace" style="font-size: 0.70rem;">{{ $photo->dimensions ?? 'Original' }}</span>
                    </div>
                    <p class="text-secondary small mb-0 text-truncate" style="font-size: 0.76rem;">
                      <i class="bi bi-calendar-event me-1"></i> {{ $photo->event->title ?? 'Official Event' }}
                    </p>
                  </div>

                  <div class="pt-2 mt-2 border-top d-flex justify-content-between align-items-center">
                    <div>
                      <span class="text-muted small d-block" style="font-size: 0.70rem;">Personal / Commercial</span>
                      <strong class="text-dark" style="font-size: 0.95rem;">R{{ number_format($photo->personal_price, 2) }}</strong>
                      <small class="text-success ms-1">/ R{{ number_format($photo->commercial_price, 2) }}</small>
                    </div>
                    <button class="btn btn-sm btn-outline-primary rounded-pill px-3" type="button" onclick="openPhotoModalByIndex({{ $index }})">
                      <i class="bi bi-eye me-1"></i> Inspect
                    </button>
                  </div>
                </div>
              </div>
            </div>
          @empty
            <div class="col-12 text-center py-5 my-3 bg-white rounded-4 border">
              <i class="bi bi-camera-fill fs-1 text-primary mb-3 d-block"></i>
              <h4 class="text-dark fw-bold">No photos available yet</h4>
              <p class="text-muted small mb-0" style="max-width: 500px; margin: 0 auto;">
                New sports galleries are coming soon. Check back shortly!
              </p>
            </div>
          @endforelse
        </div>
      </div>
    </section>

    <!-- 5. POPULAR CATEGORIES (100% Identical to Live Homepage) -->
    @if(isset($categories) && $categories->isNotEmpty())
      <section class="content-section" id="popular-categories">
        <div class="container-xl">
          <div class="section-header">
            <div>
              <div class="section-kicker" style="background:#eaf3ff;color:#0b2d5b;border-color:rgba(11,45,91,.08);">Discover</div>
              <h2 class="section-title">Popular categories</h2>
            </div>
            <a class="inline-link" href="#browse-gallery" onclick="filterByCategory('all')">View all sports <i class="bi bi-arrow-right"></i></a>
          </div>
          <div class="sports-grid">
            @foreach(($popularCategories->isNotEmpty() ? $popularCategories : $categories)->take(4) as $cat)
              <a href="#browse-gallery" class="sport-card text-decoration-none text-reset" onclick="filterByCategory('{{ addslashes($cat->name) }}')">
                <div class="sport-icon">
                  <i class="bi {{ $cat->icon ?? 'bi-trophy' }}"></i>
                </div>
                <h3>{{ $cat->name }}</h3>
                <p>{{ $cat->description ?? 'Official fixtures, finals and tournament photo highlights.' }}</p>
              </a>
            @endforeach
          </div>
        </div>
      </section>
    @endif

    <!-- 6. WHY PHOTOX FEATURE BAND (100% Identical to Live Homepage) -->
    <section class="content-section">
      <div class="container-xl">
        <div class="section-header">
          <div>
            <div class="section-kicker" style="background:#eaf3ff;color:#0b2d5b;border-color:rgba(11,45,91,.08);">Why PhotoX</div>
            <h2 class="section-title">A cleaner event marketplace</h2>
          </div>
        </div>
        <div class="feature-band">
          <div class="feature-grid">
            <div class="feature-item">
              <i class="bi bi-search-heart"></i>
              <h4>AI search</h4>
              <p>Search by event, bib number, team or athlete when galleries enable AI recognition.</p>
            </div>
            <div class="feature-item">
              <i class="bi bi-shield-check"></i>
              <h4>Secure checkout</h4>
              <p>Protected purchase flow, proper pricing rules and instant order confirmation.</p>
            </div>
            <div class="feature-item">
              <i class="bi bi-cloud-arrow-down"></i>
              <h4>Fast delivery</h4>
              <p>Download selected photos instantly with secure access links and protected originals.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- 6B. THE VERIFIED PHOTOGRAPHERS (Dynamic 6 Photographers Showcase) -->
    <section class="content-section" id="featured-photographers" style="background: #ffffff; padding: 70px 0;">
      <div class="container-xl">
        <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4">
          <div>
            <div class="section-kicker" style="background:#eaf3ff;color:#0b2d5b;border-color:rgba(11,45,91,.08);">
              PhotoX Creators
            </div>
            <h2 class="section-title mb-1">Meet our verified photographers</h2>
            <p class="text-muted small mb-0">Professional sports & action creators capturing live moments across South Africa.</p>
          </div>
          <a href="/photographers" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-semibold">
            View all photographers <i class="bi bi-arrow-right ms-1"></i>
          </a>
        </div>

        <div class="row g-4">
          @if(isset($photographers) && $photographers->isNotEmpty())
            @foreach($photographers as $creator)
              @php
                $isGuild = strtolower($creator->tier ?? '') === 'photoguild' || ($creator->membership && $creator->membership->slug === 'photoguild');
                $isPro = strtolower($creator->tier ?? '') === 'pro' || ($creator->membership && $creator->membership->slug === 'pro');
                $isStandard = strtolower($creator->tier ?? '') === 'standard' || ($creator->membership && $creator->membership->slug === 'standard');
              @endphp
              <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative p-3" style="background: #f8fafc; transition: transform 0.2s, box-shadow 0.2s;">
                  <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="position-relative">
                      <img src="{{ $creator->avatar ?: 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=200&q=90' }}" alt="{{ $creator->name }}" class="rounded-circle object-fit-cover shadow-sm" width="64" height="64">
                      @if($isGuild)
                        <span class="position-absolute bottom-0 end-0 badge rounded-pill bg-warning text-dark border border-white" title="PhotoGuild SA Member"><i class="bi bi-award-fill"></i></span>
                      @elseif($isPro)
                        <span class="position-absolute bottom-0 end-0 badge rounded-pill bg-success border border-white" title="Pro Member"><i class="bi bi-patch-check-fill"></i></span>
                      @endif
                    </div>
                    <div class="flex-grow-1 min-w-0">
                      <h4 class="h6 mb-0 fw-bold text-truncate">{{ $creator->name }}</h4>
                      <p class="small text-muted mb-1 text-truncate">{{ $creator->specialty ?: 'Sports & Action' }}</p>
                      <span class="badge {{ $isGuild ? 'bg-warning text-dark' : ($isPro ? 'bg-success' : 'bg-primary') }} py-1 px-2 rounded-pill" style="font-size: 0.65rem;">
                        {{ $creator->effective_badge_heading }}
                      </span>
                    </div>
                  </div>
                  <p class="small text-muted mb-3 flex-grow-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.45;">
                    {{ $creator->bio ?: 'Documentary sports photography covering race days, finals and high energy moments.' }}
                  </p>
                  <div class="d-flex align-items-center justify-content-between pt-2 border-top border-light-subtle">
                    <span class="small text-secondary"><i class="bi bi-calendar-event me-1"></i> {{ $creator->events_count ?? $creator->events->count() }} active events</span>
                    <a href="/photographer-details/{{ $creator->id }}" class="btn btn-sm btn-lime rounded-pill px-3 fw-semibold">
                      View profile <i class="bi bi-arrow-up-right ms-1"></i>
                    </a>
                  </div>
                </div>
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </section>

    <!-- 7. TESTIMONIALS SLIDER (100% Identical to Live Homepage) -->
    <section aria-labelledby="testimonials-title" class="testimonials-section" id="testimonials">
      <div class="container-xl">
        <div class="testimonial-heading d-flex justify-content-between align-items-end flex-wrap gap-3">
          <div>
            <div class="section-kicker" style="background:#eaf3ff;color:#0b2d5b;border-color:rgba(11,45,91,.08);">
              The feeling after
            </div>
            <h2 id="testimonials-title">Loved by the<br>
            <span>people in frame.</span></h2>
          </div>
          <div class="testimonial-controls">
            <button aria-label="Previous testimonial" class="testimonial-arrow" id="testimonialPrev"><i class="bi bi-arrow-left"></i></button><button aria-label="Next testimonial" class="testimonial-arrow" id="testimonialNext"><i class="bi bi-arrow-right"></i></button>
          </div>
        </div>
        <div class="testimonial-window">
          <div class="testimonial-track" id="testimonialTrack">
            <article class="testimonial-slide active">
              <div class="testimonial-portrait"><img alt="Thandi Mokoena" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=500&q=88"></div>
              <div class="testimonial-content">
                <div class="testimonial-mark">“</div>
                <blockquote>
                  Finding my marathon photos took less than a minute. I searched my bib number, and suddenly I had the whole story of race day in front of me.
                </blockquote>
                <div class="testimonial-person">
                  <strong>Thandi Mokoena</strong><span>Runner · Cape Town Marathon</span>
                </div>
              </div>
              <div class="testimonial-meta">
                <span>PhotoX customer</span><span></span>
              </div>
            </article>
            <article class="testimonial-slide">
              <div class="testimonial-portrait"><img alt="Daniel Jacobs" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=500&q=88"></div>
              <div class="testimonial-content">
                <div class="testimonial-mark">“</div>
                <blockquote>
                  PhotoX gives me a beautiful way to deliver thousands of images without losing the human side of event photography.
                </blockquote>
                <div class="testimonial-person">
                  <strong>Daniel Jacobs</strong><span>Photographer · Frame South</span>
                </div>
              </div>
              <div class="testimonial-meta">
                <span>PhotoX creator</span><span></span>
              </div>
            </article>
            <article class="testimonial-slide">
              <div class="testimonial-portrait"><img alt="Naledi Williams" src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=500&q=88"></div>
              <div class="testimonial-content">
                <div class="testimonial-mark">“</div>
                <blockquote>
                  The school parents now find their children’s match photos on their own. It feels simple, thoughtful and made for real events.
                </blockquote>
                <div class="testimonial-person">
                  <strong>Naledi Williams</strong><span>Sports coordinator · School A</span>
                </div>
              </div>
              <div class="testimonial-meta">
                <span>PhotoX partner</span><span></span>
              </div>
            </article>
            <article class="testimonial-slide">
              <div class="testimonial-portrait"><img alt="Sipho Dlamini" src="https://images.unsplash.com/photo-1504593811423-6dd665756598?auto=format&fit=crop&w=500&q=88"></div>
              <div class="testimonial-content">
                <div class="testimonial-mark">“</div>
                <blockquote>
                  Our team finally has one beautiful place for every match-day memory. Parents find the images, and we get back to the sport.
                </blockquote>
                <div class="testimonial-person">
                  <strong>Sipho Dlamini</strong><span>Coach · Maties Rugby</span>
                </div>
              </div>
              <div class="testimonial-meta">
                <span>PhotoX partner</span><span></span>
              </div>
            </article>
            <article class="testimonial-slide">
              <div class="testimonial-portrait"><img alt="Ayesha Khan" src="https://images.unsplash.com/photo-1531123897727-8f129e1688ce?auto=format&fit=crop&w=500&q=88"></div>
              <div class="testimonial-content">
                <div class="testimonial-mark">“</div>
                <blockquote>
                  The quality is beautiful, the download was instant, and I found photos I did not even know had been taken.
                </blockquote>
                <div class="testimonial-person">
                  <strong>Ayesha Khan</strong><span>Customer · Winelands Cycle Tour</span>
                </div>
              </div>
              <div class="testimonial-meta">
                <span>PhotoX customer</span><span></span>
              </div>
            </article>
          </div>
        </div>
        <div aria-label="Testimonials" class="testimonial-dots">
          <button aria-label="Show first testimonial" class="testimonial-dot active" data-testimonial="0"></button><button aria-label="Show second testimonial" class="testimonial-dot" data-testimonial="1"></button><button aria-label="Show third testimonial" class="testimonial-dot" data-testimonial="2"></button><button aria-label="Show fourth testimonial" class="testimonial-dot" data-testimonial="3"></button><button aria-label="Show fifth testimonial" class="testimonial-dot" data-testimonial="4"></button>
        </div>
      </div>
    </section>

    <!-- 8. THE PHOTOX JOURNAL (100% Identical to Live Homepage) -->
    <section class="stories-section" id="stories">
      <div class="container-xl">
        <div class="section-kicker" style="background:#eaf3ff;color:#0b2d5b;border-color:rgba(11,45,91,.08);">
          From the field
        </div>
        <div class="d-flex justify-content-between align-items-end mb-4">
          <h2 class="section-title">The PhotoX journal</h2><a class="text-link d-none d-sm-block text-dark" href="/blog">Read all stories <i class="bi bi-arrow-up-right"></i></a>
        </div>
        <div class="row g-4">
          <div class="col-lg-7">
            <article class="story-card story-large">
              <img alt="Athlete running on a track" src="https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=1200&q=85">
              <div class="story-overlay">
                <span>FIELD NOTES / 08.09.26</span>
                <h3>Why the finish line is never the whole story.</h3><a aria-label="Read story" href="/blog"><i class="bi bi-arrow-up-right"></i></a>
              </div>
            </article>
          </div>
          <div class="col-lg-5">
            <article class="story-card story-small">
              <img alt="Cyclist climbing a road" src="https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=800&q=85">
              <div class="story-overlay">
                <span>THE LONG RIDE</span>
                <h3>Chasing light up Ou Kaapse Weg.</h3><a aria-label="Read story" href="/blog"><i class="bi bi-arrow-up-right"></i></a>
              </div>
            </article>
          </div>
        </div>
      </div>
    </section>

    <!-- 9. READY TO LAUNCH (100% Identical to Live Homepage) -->
    <section class="content-section pt-0">
      <div class="container-xl">
        <div class="cta-panel">
          <div>
            <div class="section-kicker" style="background:#eaf3ff;color:#0b2d5b;border-color:rgba(11,45,91,.08);">Ready to launch</div>
            <h3>Bring your next event to PhotoX.</h3>
            <p>Photographers, schools and sponsors can upload galleries, publish event pages and sell memories in minutes.</p>
          </div>
          <a class="btn btn-lime rounded-pill px-4" href="/signup">Join now</a>
        </div>
      </div>
    </section>
  </main>

  <!-- ========================================================================= -->
  <!-- HIGH SECURITY PIXIESET-STYLE PHOTO INSPECTOR MODAL WITH NEXT / PREVIOUS   -->
  <!-- ========================================================================= -->
  <div class="modal fade" id="photoInspectorModal" tabindex="-1" aria-labelledby="modalPhotoTitle" aria-hidden="true" style="backdrop-filter: blur(8px);">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content border-0 shadow-2xl" style="background: #07131f; color: #fff; border-radius: 18px; overflow: hidden; border: 1px solid #1c354d !important;">
        
        <!-- Modal Top Bar -->
        <div class="modal-header border-bottom border-secondary border-opacity-25 px-4 py-3" style="background: #040c14;">
          <div class="d-flex align-items-center gap-2 flex-wrap">
            <span class="badge" style="background: #ff8a00; color: #fff; font-size: 0.72rem; text-transform: uppercase;">
              <i class="bi bi-shield-check me-1"></i> Anti-Theft Watermark
            </span>
            <h5 class="modal-title fs-6 fw-bold mb-0 text-white" id="modalPhotoTitle">Photo Inspector</h5>
            <span class="badge bg-dark border border-secondary text-warning font-monospace" id="modalIndexCounter">Photo 1 of 1</span>

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
                     oncontextmenu="return false;">

                <!-- 1. WaterMotion Liquid Glass Lenses & Fluid Waves (Active when enabled in admin) -->
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
                <!-- Renders blurred image ONLY within the clipped triangle, leaving the other triangle 100% crystal clear! -->
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

                <!-- 3. Invisible Transparent Shield Overlay (captures mousemove for triangle flip & blocks right-click) -->
                <div class="position-absolute top-0 start-0 w-100 h-100" 
                     id="modalTransparentShield"
                     style="z-index: 18; background: transparent; cursor: crosshair;" 
                     oncontextmenu="showProtectedToast(event); return false;" 
                     ondragstart="return false;" 
                     onselectstart="return false;">
                </div>

                <!-- Floating PREVIOUS Button -->
                <button type="button" 
                        class="btn position-absolute top-50 start-0 translate-middle-y ms-2 rounded-circle d-flex align-items-center justify-content-center shadow-lg modal-nav-btn" 
                        id="modalPrevBtn"
                        onclick="prevModalPhoto()" 
                        title="Previous Photo (Left Arrow Key)"
                        style="width: 44px; height: 44px; background: rgba(13, 30, 46, 0.85); color: #fff; border: 1.5px solid rgba(255,138,0,0.5); backdrop-filter: blur(6px); z-index: 25; transition: all 0.2s;">
                  <i class="bi bi-chevron-left fs-5"></i>
                </button>

                <!-- Floating NEXT Button -->
                <button type="button" 
                        class="btn position-absolute top-50 end-0 translate-middle-y me-2 rounded-circle d-flex align-items-center justify-content-center shadow-lg modal-nav-btn" 
                        id="modalNextBtn"
                        onclick="nextModalPhoto()" 
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

              <!-- SPONSOR BANNER (Placement: Image Preview - Red Box Location Requested by Client) -->
              @php
                $previewAd = $imagePreviewBanner ?? \App\Models\Banner::where('is_active', true)->where('placement', 'image_preview')->first();
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

            <!-- Right: Commercial Pricing & License Panel (No Camera / EXIF metadata) -->
            <div class="col-lg-5 modal-info-col p-4 d-flex flex-column justify-content-between" style="background: #091724; border-left: 1px solid #1a3248;">
              <div>
                
                <!-- License & Bundle Selector (Single Personal, Single Commercial, Selfie Bundle, Buy Complete Gallery) -->
                <div class="mb-4 p-3 rounded" style="background: #0c1e30; border: 1px solid #1e3e5c;">
                  <label class="form-label text-warning small fw-bold text-uppercase mb-2 d-flex align-items-center gap-1" style="letter-spacing: 0.05em; font-size: 0.82rem;">
                    <i class="bi bi-tag-fill me-1"></i> SELECT PURCHASE OPTION
                  </label>
                  
                  <div class="d-flex flex-column gap-2">
                    <!-- Option 1: Personal Single Photo -->
                    <label class="d-flex align-items-center justify-content-between p-2 p-md-3 rounded cursor-pointer border" style="background: #0e243a; border-color: #2b5680 !important; cursor: pointer;">
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
                    <label class="d-flex align-items-center justify-content-between p-2 p-md-3 rounded cursor-pointer border" style="background: #0e243a; border-color: #2b5680 !important; cursor: pointer;">
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
                    <label class="d-flex align-items-center justify-content-between p-2 p-md-3 rounded cursor-pointer border" style="background: #0e243a; border-color: #2b5680 !important; cursor: pointer;">
                      <div class="d-flex align-items-center gap-3">
                        <input type="radio" name="license_type" value="selfie" onchange="updateModalPrice('selfie')" style="transform: scale(1.25); accent-color: #ff8a00;">
                        <div>
                          <div class="d-flex align-items-center gap-2">
                            <strong class="text-white" style="font-size: 0.92rem;">Selfie / Athlete Bundle</strong>
                            <span class="badge bg-warning text-dark px-2 py-0" style="font-size: 0.65rem; font-weight: 700;">FLAT RATE</span>
                          </div>
                          <small style="font-size: 0.76rem; color: #cbd5e1;">All your matched photos from bib/selfie search (1 or 100+)</small>
                        </div>
                      </div>
                      <span class="fs-6 fw-bold text-info" id="modalSelfieBundlePriceLabel">R150.00</span>
                    </label>

                    <!-- Option 4: Buy Complete Gallery (All Photos in Event) -->
                    <label class="d-flex align-items-center justify-content-between p-2 p-md-3 rounded cursor-pointer border" style="background: #0e243a; border-color: #2b5680 !important; cursor: pointer;">
                      <div class="d-flex align-items-center gap-3">
                        <input type="radio" name="license_type" value="full_gallery" onchange="updateModalPrice('full_gallery')" style="transform: scale(1.25); accent-color: #ff8a00;">
                        <div>
                          <div class="d-flex align-items-center gap-2">
                            <strong class="text-white" style="font-size: 0.92rem;">Buy Complete Gallery</strong>
                            <span class="badge bg-success text-white px-2 py-0" style="font-size: 0.65rem; font-weight: 700;">ALL PHOTOS</span>
                          </div>
                          <small style="font-size: 0.76rem; color: #cbd5e1;">Instant high-res bundle of all captures in this event</small>
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
                  <a href="/events" id="modalEventLink" class="text-white text-decoration-none d-flex align-items-center justify-content-between fs-6 fw-bold mb-1 p-2 rounded" style="background: rgba(255,255,255,0.05); transition: all 0.2s; border: 1px solid rgba(255,138,0,0.3);" onmouseover="this.style.background='rgba(255,138,0,0.18)'; this.style.borderColor='#ff8a00';" onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.borderColor='rgba(255,138,0,0.3)';" title="Click to view full event gallery page">
                    <span id="modalEventName">PhotoX Event Gallery</span>
                    <span class="badge bg-warning text-dark d-flex align-items-center gap-1" style="font-size: 0.72rem; font-weight: 700;">
                      View Gallery <i class="bi bi-box-arrow-up-right"></i>
                    </span>
                  </a>
                  <span class="small d-block mt-2" id="modalCopyright" style="font-size: 0.78rem; color: #cbd5e1;">© {{ date('Y') }} PhotoX All Rights Reserved. Clean original master without watermark delivered upon license purchase.</span>
                </div>

              </div>

              <!-- Action Footer with Next / Previous & Purchase Button -->
              <div class="pt-3 border-top border-secondary border-opacity-25">
                <div class="d-flex align-items-center justify-content-between mb-3">
                  <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="prevModalPhoto()">
                      <i class="bi bi-chevron-left me-1"></i> Prev
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="nextModalPhoto()">
                      Next <i class="bi bi-chevron-right ms-1"></i>
                    </button>
                  </div>
                  <div class="text-end">
                    <span class="small d-block" style="font-size: 0.72rem; color: #cbd5e1; font-weight: 600;">TOTAL DUE</span>
                    <span class="fs-4 fw-bold text-warning" id="modalActionPrice">R50.00</span>
                  </div>
                </div>

                <button class="btn btn-warning w-100 py-3 fw-bold rounded-pill text-dark d-flex align-items-center justify-content-center gap-2 shadow" onclick="triggerSimulatedPurchase()">
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

  <!-- TOAST NOTIFICATION FOR RIGHT CLICK DEFENSE -->
  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 2000">
    <div id="protectionToast" class="toast align-items-center text-white bg-dark border-warning" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body d-flex align-items-center gap-2">
          <i class="bi bi-shield-lock-fill text-warning fs-5"></i>
          <div>
            <strong>PhotoX Rights Defense:</strong> Direct image saving is restricted. Clean high-resolution copies are available via official licensing.
          </div>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>

  <!-- PURCHASE SIMULATION MODAL -->
  <div class="modal fade" id="purchaseSuccessModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0" style="background: #081726; color: #fff; border-radius: 16px; border: 1px solid #1e3a54 !important;">
        <div class="modal-body text-center p-4">
          <div class="my-3 d-inline-flex p-3 rounded-circle bg-success bg-opacity-25 text-success">
            <i class="bi bi-check-circle-fill fs-1"></i>
          </div>
          <h4 class="fw-bold text-white mb-2">Photo License Granted!</h4>
          <p class="text-secondary small mb-4">
            Your high-resolution original image has been unlocked and prepared for high-speed download.
          </p>
          <button type="button" class="btn btn-warning rounded-pill px-4 fw-bold text-dark" data-bs-dismiss="modal">
            Done
          </button>
        </div>
      </div>
    </div>
  </div>

  <style>
    .category-pill-btn {
      background: #ffffff;
      color: #0b2d5b;
      border: 1px solid rgba(11,45,91,0.15);
      transition: all 0.2s ease;
    }
    .category-pill-btn:hover {
      background: #eaf3ff;
      color: #0b2d5b;
      border-color: #0b2d5b;
    }
    .category-pill-btn.active {
      background: #0b2d5b !important;
      color: #ffffff !important;
      border-color: #0b2d5b !important;
    }
    .category-pill-btn.active .badge {
      background: #a3e635 !important;
      color: #000000 !important;
    }
    .modal-nav-btn:hover {
      background: #ff8a00 !important;
      color: #000 !important;
      transform: translateY(-50%) scale(1.1);
    }

    /* Realistic WaterMotion & Liquid Glass Lens System */
    :root {
      --water-lens-size: 180px;
      --water-motion-speed: 10s;
      --water-lens-blur: 1.5px;
    }
    .wm-motion-mask-layer {
      position: absolute;
      inset: 0;
      display: none;
      pointer-events: none;
      z-index: 14;
      overflow: hidden;
      border-radius: 8px;
    }
    .wm-motion-mask-layer.active {
      display: block;
    }
    .wm-water-lens {
      position: absolute;
      border-radius: 50%;
      pointer-events: none;
      user-select: none;
      will-change: transform, left, top;
      transform-origin: center center;
      box-sizing: border-box;
      transition: width 0.25s ease, height 0.25s ease;
    }
    .wm-water-lens-primary {
      width: var(--water-lens-size, 180px);
      height: var(--water-lens-size, 180px);
      top: 35%;
      left: 45%;
      animation: waterMotionFloat1 var(--water-motion-speed, 10s) cubic-bezier(0.45, 0.05, 0.55, 0.95) infinite alternate;
    }
    .wm-water-lens-secondary {
      width: calc(var(--water-lens-size, 180px) * 0.68);
      height: calc(var(--water-lens-size, 180px) * 0.68);
      top: 55%;
      left: 20%;
      animation: waterMotionFloat2 calc(var(--water-motion-speed, 10s) * 0.85) cubic-bezier(0.45, 0.05, 0.55, 0.95) infinite alternate;
    }
    .wm-lens-inner-glass {
      position: absolute;
      inset: 0;
      border-radius: 50%;
      background: radial-gradient(circle at 35% 30%, rgba(255, 255, 255, 0.35) 0%, rgba(255, 255, 255, 0.08) 50%, rgba(56, 189, 248, 0.12) 75%, rgba(255, 255, 255, 0.3) 100%);
      backdrop-filter: blur(var(--water-lens-blur, 1.5px)) contrast(1.18) saturate(1.22) brightness(1.06);
      -webkit-backdrop-filter: blur(var(--water-lens-blur, 1.5px)) contrast(1.18) saturate(1.22) brightness(1.06);
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
      top: 8%;
      left: 14%;
      width: 46%;
      height: 28%;
      background: radial-gradient(ellipse at 40% 30%, rgba(255, 255, 255, 0.98) 0%, rgba(255, 255, 255, 0.6) 45%, rgba(255, 255, 255, 0) 80%);
      transform: rotate(-32deg);
      filter: blur(0.5px);
    }
    .wm-lens-glint-bottom {
      bottom: 11%;
      right: 15%;
      width: 34%;
      height: 18%;
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
      top: 50%;
      left: 50%;
      width: 100%;
      height: 100%;
      transform: translate(-50%, -50%);
      pointer-events: none;
    }
    .wm-ripple-ring {
      position: absolute;
      top: 50%;
      left: 50%;
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
  </style>

  <script>
    // All photos available in the gallery passed directly from server
    const rawPhotosData = @json($galleryPhotos);
    
    // Active filtered photos list
    let currentGalleryPhotos = [...rawPhotosData];
    let currentModalIndex = 0;
    let currentActivePhoto = null;
    let currentSelectedLicense = 'personal';

    // Anti-theft right-click defense toast
    function showProtectedToast(event) {
      if (event) event.preventDefault();
      const toastEl = document.getElementById('protectionToast');
      if (toastEl && window.bootstrap) {
        const toast = new bootstrap.Toast(toastEl, { delay: 3500 });
        toast.show();
      }
    }

    // Filter gallery by Category (Cricket, Cycling, etc.)
    function filterByCategory(categoryName) {
      // Update UI pills
      document.querySelectorAll('.category-pill-btn').forEach(btn => {
        if (btn.getAttribute('data-cat') === categoryName) {
          btn.classList.add('active');
        } else {
          btn.classList.remove('active');
        }
      });

      // Filter photos array
      if (categoryName === 'all') {
        currentGalleryPhotos = [...rawPhotosData];
        hideFilterBanner();
      } else {
        currentGalleryPhotos = rawPhotosData.filter(p => {
          return p.event && p.event.category_name && p.event.category_name.toLowerCase() === categoryName.toLowerCase();
        });
        showFilterBanner(`Category: <strong>${categoryName}</strong>`);
      }

      renderGalleryGrid();
    }

    // Filter gallery by specific Event
    function filterByEvent(eventId, eventTitle) {
      currentGalleryPhotos = rawPhotosData.filter(p => Number(p.event_id) === Number(eventId));
      
      // Update Category pills to none active
      document.querySelectorAll('.category-pill-btn').forEach(btn => btn.classList.remove('active'));

      showFilterBanner(`Event: <strong>${eventTitle}</strong>`);
      renderGalleryGrid();

      // Smooth scroll to gallery
      const el = document.getElementById('browse-gallery');
      if (el) {
        el.scrollIntoView({ behavior: 'smooth' });
      }
    }

    function showFilterBanner(labelHtml) {
      const banner = document.getElementById('activeFilterBanner');
      const text = document.getElementById('activeFilterText');
      const badge = document.getElementById('filteredCountBadge');
      if (banner && text && badge) {
        text.innerHTML = `Showing photos for: ${labelHtml}`;
        badge.textContent = `${currentGalleryPhotos.length} photo(s)`;
        banner.classList.remove('d-none');
        banner.classList.add('d-flex');
      }
    }

    function hideFilterBanner() {
      const banner = document.getElementById('activeFilterBanner');
      if (banner) {
        banner.classList.add('d-none');
        banner.classList.remove('d-flex');
      }
    }

    function clearAllFilters() {
      document.getElementById('heroSearchInput').value = '';
      document.getElementById('heroCategorySelect').value = 'all';
      filterByCategory('all');
    }

    function onCategorySelectChange(val) {
      filterByCategory(val);
      const el = document.getElementById('browse-gallery');
      if (el) el.scrollIntoView({ behavior: 'smooth' });
    }

    function handleSearchSubmit(e) {
      e.preventDefault();
      const q = (document.getElementById('heroSearchInput').value || '').trim().toLowerCase();
      const cat = document.getElementById('heroCategorySelect').value;

      currentGalleryPhotos = rawPhotosData.filter(p => {
        let matchesCat = (cat === 'all') || (p.event && p.event.category_name && p.event.category_name.toLowerCase() === cat.toLowerCase());
        let matchesQuery = true;
        if (q) {
          const title = (p.title || '').toLowerCase();
          const cam = (p.camera_model || '').toLowerCase();
          const evTitle = (p.event && p.event.title ? p.event.title : '').toLowerCase();
          matchesQuery = title.includes(q) || cam.includes(q) || evTitle.includes(q);
        }
        return matchesCat && matchesQuery;
      });

      showFilterBanner(q ? `Search: "${q}"` : `Category: ${cat}`);
      renderGalleryGrid();

      const el = document.getElementById('browse-gallery');
      if (el) el.scrollIntoView({ behavior: 'smooth' });
    }

    // Re-render gallery grid based on currentGalleryPhotos
    function renderGalleryGrid() {
      const container = document.getElementById('galleryPhotoGrid');
      if (!container) return;

      if (currentGalleryPhotos.length === 0) {
        container.innerHTML = `
          <div class="col-12 text-center py-5 my-3 bg-white rounded-4 border">
            <i class="bi bi-camera-fill fs-1 text-primary mb-3 d-block"></i>
            <h4 class="text-dark fw-bold">No photos match the selected filter</h4>
            <p class="text-muted small mb-4">Try selecting "All Categories" or clearing the active filter.</p>
            <button class="btn btn-primary rounded-pill px-4 fw-bold" onclick="clearAllFilters()">
              <i class="bi bi-arrow-repeat me-1"></i> Reset All Filters
            </button>
          </div>
        `;
        return;
      }

      container.innerHTML = currentGalleryPhotos.map((photo, idx) => {
        const catName = photo.event && photo.event.category_name ? photo.event.category_name : 'Sports';
        const evTitle = photo.event && photo.event.title ? photo.event.title : 'Championship Event';
        const pPrice = parseFloat(photo.personal_price || 50).toFixed(2);
        const cPrice = parseFloat(photo.commercial_price || 250).toFixed(2);

        return `
          <div class="col-12 col-md-6 col-lg-4 photo-card-wrapper">
            <div class="card h-100 shadow-sm border-0 photo-display-card" style="background: #ffffff; border-radius: 16px; overflow: hidden; border: 1px solid rgba(11,45,91,0.08) !important; transition: all 0.25s ease;" onmouseenter="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)';" onmouseleave="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.04)';">
              <div class="position-relative overflow-hidden photo-thumb-box" style="aspect-ratio: 4 / 3; background: #0b1a29; cursor: pointer;" onclick="openPhotoModalByIndex(${idx})">
                <img src="/protected-photo/${photo.id}" 
                     alt="${photo.title || 'Official Photo'}" 
                     class="w-100 h-100 object-fit-cover" 
                     draggable="false" 
                     oncontextmenu="return false;" 
                     loading="lazy">
                <div class="position-absolute top-0 start-0 w-100 h-100" 
                     style="z-index: 5; background: transparent; cursor: pointer;" 
                     title="Protected by PhotoX Rights Protection · Click to inspect metadata" 
                     oncontextmenu="showProtectedToast(event); return false;" 
                     ondragstart="return false;">
                </div>
                <div class="position-absolute top-0 end-0 m-2 px-2 py-1 rounded" style="background: rgba(0,0,0,0.75); backdrop-filter: blur(4px); font-size: 0.70rem; color: #ff8a00; font-weight: 700; z-index: 6; pointer-events: none;">
                  <i class="bi bi-shield-shaded me-1"></i> PHOTOX PROOF
                </div>
                <div class="position-absolute top-0 start-0 m-2 px-2 py-1 rounded" style="background: rgba(0,0,0,0.75); backdrop-filter: blur(4px); font-size: 0.70rem; color: #cbd5e1; font-weight: 600; z-index: 6; pointer-events: none;">
                  <i class="bi bi-tag me-1 text-warning"></i> ${catName}
                </div>
                <div class="position-absolute bottom-0 start-0 w-100 p-2 text-center text-white" style="background: linear-gradient(to top, rgba(0,0,0,0.9), transparent); font-size: 0.75rem; z-index: 6; pointer-events: none;">
                  <i class="bi bi-zoom-in me-1"></i> Click to inspect &amp; browse next/previous
                </div>
              </div>
              <div class="card-body p-3 d-flex flex-column justify-content-between">
                <div>
                  <div class="d-flex justify-content-between align-items-center mb-1">
                    <h4 class="text-dark fs-6 fw-bold mb-0 text-truncate" title="${photo.title || 'Photo'}">${photo.title || 'Photo'}</h4>
                    <span class="badge bg-light text-secondary border font-monospace" style="font-size: 0.70rem;">${photo.dimensions || 'Original'}</span>
                  </div>
                  <p class="text-secondary small mb-0 text-truncate" style="font-size: 0.76rem;">
                    <i class="bi bi-calendar-event me-1"></i> ${evTitle}
                  </p>
                </div>
                <div class="pt-2 mt-2 border-top d-flex justify-content-between align-items-center">
                  <div>
                    <span class="text-muted small d-block" style="font-size: 0.70rem;">Personal / Commercial</span>
                    <strong class="text-dark" style="font-size: 0.95rem;">R${pPrice}</strong>
                    <small class="text-success ms-1">/ R${cPrice}</small>
                  </div>
                  <button class="btn btn-sm btn-outline-primary rounded-pill px-3" type="button" onclick="openPhotoModalByIndex(${idx})">
                    <i class="bi bi-eye me-1"></i> Inspect
                  </button>
                </div>
              </div>
            </div>
          </div>
        `;
      }).join('');
    }

    // =========================================================================
    // MODAL AD WIDTH SYNCHRONIZATION (Matches Preview Image Width)
    // =========================================================================
    function syncPreviewAdWidth() {
      const photoImg = document.getElementById('modalPhotoImg');
      const adWrapper = document.getElementById('modalPreviewAdWrapper');
      const secInfo = document.getElementById('modalSecurityInfoBar');

      if (!photoImg) return;

      // Only synchronize ad and security info wrappers if photo is rendered with valid dimensions
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

    // =========================================================================
    // MODAL NAVIGATION (NEXT / PREVIOUS) LOGIC
    // =========================================================================
    function openPhotoModalByIndex(index) {
      if (!currentGalleryPhotos || currentGalleryPhotos.length === 0) return;
      
      // Ensure index is within range
      if (index < 0) index = currentGalleryPhotos.length - 1;
      if (index >= currentGalleryPhotos.length) index = 0;

      currentModalIndex = index;
      const photo = currentGalleryPhotos[currentModalIndex];
      currentActivePhoto = photo;
      currentSelectedLicense = 'personal';

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
      document.getElementById('modalPhotoTitle').textContent = photo.title || 'Official Photo';
      document.getElementById('modalIndexCounter').textContent = `Photo ${currentModalIndex + 1} of ${currentGalleryPhotos.length}`;

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

      // Fill Event Details & Rights info (Camera EXIF removed per client request)
      const evNameEl = document.getElementById('modalEventName');
      const evLinkEl = document.getElementById('modalEventLink');
      const eventTitle = photo.event && photo.event.title ? photo.event.title : (photo.event_title || 'PhotoX Championship Event');
      const eventSlug = photo.event && photo.event.slug ? photo.event.slug : '';
      if (evNameEl) {
        evNameEl.innerHTML = eventTitle;
      }
      if (evLinkEl) {
        evLinkEl.href = eventSlug ? `/event-details/${eventSlug}` : '/events';
      }
      const copyEl = document.getElementById('modalCopyright');
      if (copyEl) {
        copyEl.textContent = photo.copyright || '© 2026 PhotoX All Rights Reserved. Clean original master without watermark delivered upon license purchase.';
      }

      // Pricing labels
      const personalPrice = parseFloat(photo.personal_price || 75).toFixed(2);
      const commercialPrice = parseFloat(photo.commercial_price || 350).toFixed(2);
      const personalTag = document.getElementById('modalPersonalPriceLabel');
      if (personalTag) personalTag.textContent = `R${personalPrice}`;
      const commercialTag = document.getElementById('modalCommercialPriceLabel');
      if (commercialTag) commercialTag.textContent = `R${commercialPrice}`;

      // Default to personal license or current choice
      const personalRadio = document.querySelector(`input[name="license_type"][value="${currentSelectedLicense || 'personal'}"]`);
      if (personalRadio) personalRadio.checked = true;
      updateModalPrice(currentSelectedLicense || 'personal');

      // Update Nav Buttons visibility (disable if only 1 photo)
      const prevBtn = document.getElementById('modalPrevBtn');
      const nextBtn = document.getElementById('modalNextBtn');
      if (currentGalleryPhotos.length <= 1) {
        if (prevBtn) prevBtn.style.display = 'none';
        if (nextBtn) nextBtn.style.display = 'none';
      } else {
        if (prevBtn) prevBtn.style.display = 'flex';
        if (nextBtn) nextBtn.style.display = 'flex';
      }

      // Show Modal if not already shown
      const modalEl = document.getElementById('photoInspectorModal');
      const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
      modalInstance.show();
      setTimeout(syncPreviewAdWidth, 250);
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

    function nextModalPhoto() {
      if (currentGalleryPhotos.length <= 1) return;
      const nextIdx = (currentModalIndex + 1) % currentGalleryPhotos.length;
      openPhotoModalByIndex(nextIdx);
    }

    function prevModalPhoto() {
      if (currentGalleryPhotos.length <= 1) return;
      const prevIdx = (currentModalIndex - 1 + currentGalleryPhotos.length) % currentGalleryPhotos.length;
      openPhotoModalByIndex(prevIdx);
    }

    function updateModalPrice(type) {
      currentSelectedLicense = type;
      if (!currentActivePhoto) return;
      const personalPrice = parseFloat(currentActivePhoto.personal_price || 75).toFixed(2);
      const commercialPrice = parseFloat(currentActivePhoto.commercial_price || 350).toFixed(2);
      const selfieBundlePrice = (150).toFixed(2);
      const fullGalleryPrice = (450).toFixed(2);

      let chosenPrice = personalPrice;
      if (type === 'commercial') {
        chosenPrice = commercialPrice;
      } else if (type === 'selfie') {
        chosenPrice = selfieBundlePrice;
      } else if (type === 'full_gallery') {
        chosenPrice = fullGalleryPrice;
      }

      const actionPriceEl = document.getElementById('modalActionPrice');
      if (actionPriceEl) {
        actionPriceEl.textContent = `R${chosenPrice}`;
      }

      const radio = document.querySelector(`input[name="license_type"][value="${type}"]`);
      if (radio) radio.checked = true;
    }

    function triggerSimulatedPurchase() {
      const inspectorModal = bootstrap.Modal.getInstance(document.getElementById('photoInspectorModal'));
      if (inspectorModal) inspectorModal.hide();
      setTimeout(() => {
        const successModal = new bootstrap.Modal(document.getElementById('purchaseSuccessModal'));
        successModal.show();
      }, 400);
    }

    // =========================================================================
    // ANTI-AI OPPOSING TRIANGLE BLUR & WATERMOTION SYSTEM
    // =========================================================================
    let antiAiBlurEnabled = true;
    let isTopLeftClear = true; // true: Top-Left (ABD) is clear, Bottom-Right (BCD) is blurred

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

        // Normalized relative coordinates (0 to 1)
        const u = (e.clientX - rect.left) / rect.width;
        const v = (e.clientY - rect.top) / rect.height;

        // Diagonal BD connects B(1, 0) and D(0, 1) -> line equation u + v = 1
        // If u + v < 1: Cursor is in Top-Left triangle ABD
        // -> User is inspecting Top-Left, so ABD is CLEAR, opposite BCD is BLURRED!
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
        } 
        // If u + v >= 1: Cursor is in Bottom-Right triangle BCD
        // -> User is inspecting Bottom-Right, so BCD is CLEAR, opposite ABD is BLURRED!
        else {
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

    // Keyboard navigation (ArrowLeft = Prev, ArrowRight = Next)
    document.addEventListener('keydown', function(e) {
      const modalEl = document.getElementById('photoInspectorModal');
      if (!modalEl || !modalEl.classList.contains('show')) return;

      if (e.key === 'ArrowRight') {
        e.preventDefault();
        nextModalPhoto();
      } else if (e.key === 'ArrowLeft') {
        e.preventDefault();
        prevModalPhoto();
      } else if (e.key === 'Escape' || e.key === 'Esc') {
        e.preventDefault();
        closePhotoInspectorModal();
      }
    });

    // Initialize triangle blur and ad width synchronization once DOM is ready
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
  </script>
@endsection
