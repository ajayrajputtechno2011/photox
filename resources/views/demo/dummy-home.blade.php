@extends('web.layouts.app')

@section('title', 'PhotoX Sandbox | Dummy Home & Anti-Theft Watermark Studio')
@section('body-class', 'page-events dummy-home-sandbox')

@section('content')
  @php
    $events = $events ?? collect();
    $dummyPhotos = $dummyPhotos ?? collect();
  @endphp

  <!-- TOP SANDBOX TEST NOTIFICATION BAR -->
  <aside aria-label="Sandbox notification" style="background: linear-gradient(90deg, #091522 0%, #112233 100%); border-bottom: 2px solid #ff8a00; color: #fff; padding: 10px 16px; font-size: 0.86rem; position: sticky; top: 0; z-index: 1040; box-shadow: 0 4px 15px rgba(0,0,0,0.25);">
    <div class="container-xl d-flex justify-content-between align-items-center flex-wrap gap-2">
      <div class="d-flex align-items-center gap-2">
        <span class="badge" style="background: #ff8a00; color: #fff; font-weight: 700; letter-spacing: 0.05em; padding: 5px 10px; font-size: 0.72rem; text-transform: uppercase;">
          <i class="bi bi-shield-check me-1"></i> Sandbox Test Mode
        </span>
        <span class="text-white-50 d-none d-md-inline">|</span>
        <span class="small text-light">
          <strong>Anti-Theft Watermark &amp; EXIF Metadata Studio.</strong> Live homepage (<a href="/" target="_blank" class="text-warning text-decoration-underline">/</a>) is 100% untouched and safe.
        </span>
      </div>
      <div class="d-flex align-items-center gap-2">
        <a href="{{ route('admin.dummy.event') }}" class="btn btn-sm btn-outline-warning rounded-pill px-3" style="font-size: 0.78rem;">
          <i class="bi bi-cloud-arrow-up me-1"></i> Upload Photos in Admin Studio
        </a>
        <a href="{{ route('admin.dummy') }}" class="btn btn-sm btn-warning rounded-pill px-3 text-dark fw-bold" style="font-size: 0.78rem;">
          <i class="bi bi-droplet-half me-1"></i> Watermark Settings
        </a>
      </div>
    </div>
  </aside>

  <main>
    <!-- HERO SECTION (Identical to Live Homepage) -->
    <section class="events-page-hero">
      @include('web.partials.hero-ad-carousel')

      @php
        $hero = $pageHeroes['home'] ?? ($pageHeroes['events'] ?? null);
      @endphp
      <div class="container-xl">
        <div class="hero-intro-col" style="max-width: 560px; position: relative; z-index: 2;">
          <div class="section-kicker"><span class="live-dot"></span>{{ $hero->kicker ?? 'Live archive' }}</div>
          <h1>{!! !empty($hero->title) ? nl2br($hero->title) : 'Find the moment. <br><em>Then keep it.</em>' !!}</h1>
          <p>{{ $hero->description ?? 'Explore premium sports and event galleries across the country. From city marathons to school finals, every listing is designed to make browsing and buying photos simple, secure and fast.' }}</p>
          <div class="hero-actions">
            <a class="btn btn-lime rounded-pill px-4" href="{{ $hero->primary_button_url ?? '#discover' }}">{{ $hero->primary_button_text ?? 'Browse events' }}</a>
            <a class="btn btn-outline-light rounded-pill px-4" href="{{ $hero->secondary_button_url ?? '/signup' }}">{{ $hero->secondary_button_text ?? 'Create account' }}</a>
          </div>
        </div>
      </div>
    </section>

    <!-- SEARCH & CATEGORY FILTER SECTION -->
    <section class="search-wrap" id="discover">
      <div class="container-xl">
        <div class="search-card">
          <form action="/dummy-home#discover" method="GET" class="search-grid">
            <input type="search" name="q" value="{{ request('q') }}" placeholder="Search by event, venue, school or photographer">
            @php
              $categoryOptions = (isset($categories) && $categories->isNotEmpty())
                  ? $categories
                  : \App\Models\Category::where('is_active', true)->orderBy('name', 'asc')->get();
            @endphp
            <select name="category" aria-label="Sport type">
              <option value="">All categories</option>
              @foreach($categoryOptions as $cat)
                <option value="{{ $cat->name }}" {{ request('category') === $cat->name ? 'selected' : '' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
            <select name="date" aria-label="Date range">
              <option value="">All dates</option>
              <option value="upcoming" {{ request('date') === 'upcoming' ? 'selected' : '' }}>Upcoming events</option>
              <option value="past30" {{ request('date') === 'past30' ? 'selected' : '' }}>Past 30 days</option>
              <option value="past90" {{ request('date') === 'past90' ? 'selected' : '' }}>Past 90 days</option>
            </select>
            <button type="submit">Search <i class="bi bi-arrow-right ms-2"></i></button>
          </form>
        </div>
      </div>
    </section>

    <!-- DEDICATED SANDBOX PHOTO GALLERY BAND (Direct Watermark & Pixieset Inspector) -->
    @if(isset($dummyPhotos) && $dummyPhotos->isNotEmpty())
      <section class="content-section" style="background: #07121d; color: #fff; padding: 48px 0; border-top: 1px solid #14283b; border-bottom: 1px solid #14283b;">
        <div class="container-xl">
          <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
            <div>
              <span class="badge px-3 py-2 rounded-pill mb-2" style="background: rgba(255, 138, 0, 0.18); border: 1px solid rgba(255, 138, 0, 0.4); color: #ff8a00; font-size: 0.78rem;">
                <i class="bi bi-shield-lock-fill me-1"></i> Anti-Theft Watermark &amp; EXIF Showcase
              </span>
              <h2 class="text-white fw-bold mb-1" style="font-size: 1.85rem; font-family: 'Space Grotesk', sans-serif;">
                Protected Sandbox Photos
              </h2>
              <p class="text-secondary mb-0 small" style="max-width: 680px;">
                Photos served below are protected with server-burned watermarks. Click any photo to test the Pixieset camera settings inspector, anti-theft defense, and commercial usage pricing.
              </p>
            </div>
            <div class="d-flex align-items-center gap-2">
              <span class="text-muted small"><i class="bi bi-info-circle me-1"></i> Right-click &amp; direct download disabled</span>
            </div>
          </div>

          <div class="row g-4">
            @foreach($dummyPhotos as $photo)
              <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0" style="background: #0d1e2e; border-radius: 14px; overflow: hidden; border: 1px solid #1c354d !important; transition: transform 0.2s;" onmouseenter="this.style.transform='translateY(-3px)'" onmouseleave="this.style.transform='translateY(0)'">
                  
                  <!-- Protected Photo Container with Anti-Inspection Shield -->
                  <div class="position-relative overflow-hidden" style="aspect-ratio: 4 / 3; background: #000; cursor: pointer;" onclick="openPhotoModal({{ $photo->toJson() }})">
                    
                    <!-- Server-burned Watermarked Image (Even if opened in new tab, this URL serves the watermarked image) -->
                    <img src="/protected-photo/{{ $photo->id }}" 
                         alt="{{ $photo->title }}" 
                         class="w-100 h-100 object-fit-cover" 
                         draggable="false" 
                         oncontextmenu="return false;" 
                         loading="lazy">

                    <!-- Invisible Transparent Shield Overlay to Block Right-Click 'Save Image As' -->
                    <div class="position-absolute top-0 start-0 w-100 h-100" 
                         style="z-index: 5; background: transparent; cursor: pointer;" 
                         title="Protected by PhotoX Rights Protection · Click to view metadata" 
                         oncontextmenu="showProtectedAlert(event); return false;" 
                         ondragstart="return false;">
                    </div>
                    <!-- Fotto Pro Watermark Layer Matching Client Screenshot -->
                    <div class="wm-fotto-overlay position-absolute top-0 start-0 w-100 h-100 pointer-events-none" style="z-index: 4; overflow: hidden;">
                      <!-- Translucent Orange Brand Rings on Lower Left (No White Box) -->
                      <svg style="position: absolute; inset: 0; width: 100%; height: 100%; pointer-events: none;">
                        <circle cx="16%" cy="78%" r="14%" fill="none" stroke="rgba(255, 120, 0, 0.28)" stroke-width="14" />
                        <circle cx="32%" cy="78%" r="7%" fill="none" stroke="rgba(255, 120, 0, 0.20)" stroke-width="8" />
                      </svg>

                      <!-- Diagonal Intersecting SVG Lines with Diamond & Target Rings -->
                      <svg style="position: absolute; inset: 0; width: 100%; height: 100%; stroke: rgba(255,255,255,0.45); stroke-width: 1.5; pointer-events: none;">
                        <!-- Full X -->
                        <line x1="0" y1="0" x2="100%" y2="100%" />
                        <line x1="0" y1="100%" x2="100%" y2="0%" />
                        <!-- Inner Diamond -->
                        <line x1="50%" y1="0" x2="0" y2="50%" />
                        <line x1="50%" y1="0" x2="100%" y2="50%" />
                        <line x1="0" y1="50%" x2="50%" y2="100%" />
                        <line x1="100%" y1="50%" x2="50%" y2="100%" />
                        <!-- Vertical Guide Tracks -->
                        <line x1="28%" y1="0" x2="28%" y2="100%" stroke="rgba(255,255,255,0.30)" />
                        <line x1="72%" y1="0" x2="72%" y2="100%" stroke="rgba(255,255,255,0.30)" />
                        <!-- Target Rings -->
                        <circle cx="28%" cy="28%" r="14" fill="none" stroke="rgba(255,255,255,0.40)" stroke-width="1.5" />
                        <circle cx="72%" cy="28%" r="14" fill="none" stroke="rgba(255,255,255,0.40)" stroke-width="1.5" />
                        <circle cx="28%" cy="72%" r="14" fill="none" stroke="rgba(255,255,255,0.40)" stroke-width="1.5" />
                        <circle cx="72%" cy="72%" r="14" fill="none" stroke="rgba(255,255,255,0.40)" stroke-width="1.5" />
                        <circle cx="6%" cy="50%" r="16" fill="none" stroke="rgba(255,255,255,0.40)" stroke-width="1.5" />
                        <circle cx="94%" cy="50%" r="16" fill="none" stroke="rgba(255,255,255,0.40)" stroke-width="1.5" />
                      </svg>

                      <!-- Repeating White PhotoX Marks (5 Grid Positions: Center, TL, TR, BL, BR) -->
                      <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: #ffffff; font-weight: 800; font-size: 1.5rem; text-shadow: 0 2px 8px rgba(0,0,0,0.85); letter-spacing: -0.5px; opacity: 0.88; font-family: 'DM Sans', sans-serif;">PhotoX</div>
                      <div style="position: absolute; top: 18%; left: 24%; transform: translate(-50%, -50%); color: #ffffff; font-weight: 800; font-size: 1.25rem; text-shadow: 0 2px 8px rgba(0,0,0,0.85); letter-spacing: -0.5px; opacity: 0.88; font-family: 'DM Sans', sans-serif;">PhotoX</div>
                      <div style="position: absolute; top: 18%; left: 76%; transform: translate(-50%, -50%); color: #ffffff; font-weight: 800; font-size: 1.25rem; text-shadow: 0 2px 8px rgba(0,0,0,0.85); letter-spacing: -0.5px; opacity: 0.88; font-family: 'DM Sans', sans-serif;">PhotoX</div>
                      <div style="position: absolute; bottom: 12%; left: 24%; transform: translate(-50%, 50%); color: #ffffff; font-weight: 800; font-size: 1.25rem; text-shadow: 0 2px 8px rgba(0,0,0,0.85); letter-spacing: -0.5px; opacity: 0.88; font-family: 'DM Sans', sans-serif;">PhotoX</div>
                      <div style="position: absolute; bottom: 12%; left: 76%; transform: translate(-50%, 50%); color: #ffffff; font-weight: 800; font-size: 1.25rem; text-shadow: 0 2px 8px rgba(0,0,0,0.85); letter-spacing: -0.5px; opacity: 0.88; font-family: 'DM Sans', sans-serif;">PhotoX</div>

                      <!-- Bottom Center "Do not screenshot" Pill Badge -->
                      <div style="position: absolute; bottom: 12%; left: 50%; transform: translateX(-50%); background: rgba(0,0,0,0.50); border: 1.5px solid rgba(255,255,255,0.70); backdrop-filter: blur(4px); padding: 3px 18px; border-radius: 999px; color: #ffffff; font-size: 0.72rem; font-weight: 600; text-shadow: 0 1px 4px rgba(0,0,0,0.85); letter-spacing: 0.04em; white-space: nowrap;">
                        Do not screenshot
                      </div>
                    </div>

                    <!-- Watermark Proof Badge Overlay -->
                    <div class="position-absolute top-0 end-0 m-2 px-2 py-1 rounded" style="background: rgba(0,0,0,0.7); backdrop-filter: blur(4px); font-size: 0.70rem; color: #ff8a00; font-weight: 700; z-index: 6; pointer-events: none;">
                      <i class="bi bi-shield-shaded me-1"></i> PHOTOX PROOF ACTIVE
                    </div>

                    <!-- Click to inspect hint -->
                    <div class="position-absolute bottom-0 start-0 w-100 p-2 text-center text-white" style="background: linear-gradient(to top, rgba(0,0,0,0.85), transparent); font-size: 0.75rem; z-index: 6; pointer-events: none;">
                      <i class="bi bi-zoom-in me-1"></i> Click for Pixieset Camera EXIF &amp; Pricing
                    </div>
                  </div>

                  <div class="card-body p-3 d-flex flex-column justify-content-between">
                    <div>
                      <div class="d-flex justify-content-between align-items-center mb-1">
                        <h4 class="text-white fs-6 fw-bold mb-0 text-truncate" title="{{ $photo->title }}">{{ $photo->title }}</h4>
                        <span class="badge bg-secondary font-monospace" style="font-size: 0.70rem;">{{ $photo->dimensions ?? 'Original' }}</span>
                      </div>
                      <p class="text-muted small mb-2 text-truncate">
                        <i class="bi bi-camera me-1 text-warning"></i> {{ $photo->camera_model ?? 'Sports Camera' }} · {{ $photo->lens ?? 'Zoom Lens' }}
                      </p>
                    </div>

                    <div class="pt-2 border-top border-secondary border-opacity-25 d-flex justify-content-between align-items-center">
                      <div>
                        <span class="text-muted small d-block" style="font-size: 0.70rem;">Personal / Commercial</span>
                        <strong class="text-white" style="font-size: 0.95rem;">R{{ number_format($photo->personal_price, 2) }}</strong>
                        <small class="text-success ms-1">/ R{{ number_format($photo->commercial_price, 2) }}</small>
                      </div>
                      <button class="btn btn-sm btn-outline-warning rounded-pill px-3" type="button" onclick="openPhotoModal({{ $photo->toJson() }})">
                        <i class="bi bi-sliders me-1"></i> Inspect
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </section>
    @endif

    <!-- FEATURED LATEST EVENTS (Identical to Live Homepage) -->
    @if(isset($featuredEvents) && $featuredEvents->isNotEmpty())
      <section class="content-section">
        <div class="container-xl">
          <div class="section-header">
            <div>
              <div class="section-kicker" style="background:#eaf3ff;color:#0b2d5b;border-color:rgba(11,45,91,.08);">Featured archive</div>
              <h2 class="section-title">Featured events</h2>
            </div>
            <a class="inline-link" href="#all-events">View all events <i class="bi bi-arrow-down"></i></a>
          </div>

          <div class="event-grid">
            @foreach($featuredEvents as $item)
              <article class="event-card position-relative {{ $item->is_demo ? 'border border-warning border-2' : '' }}">
                @if($item->is_demo)
                  <div class="position-absolute top-0 start-0 m-3 z-3">
                    <span class="badge bg-warning text-dark font-monospace fw-bold px-2 py-1 shadow-sm">
                      <i class="bi bi-lightning-charge-fill me-1"></i> SANDBOX DEMO
                    </span>
                  </div>
                @endif
                <a href="#discover" onclick="{{ $item->is_demo ? 'scrollToSandboxPhotos(); return false;' : '' }}" class="text-decoration-none text-reset d-block">
                  <img src="{{ $item->cover_image }}" alt="{{ $item->title }}" oncontextmenu="return false;" draggable="false">
                  <div class="body">
                    <div class="meta-row">
                      <span class="tag">{{ $item->category_name }}</span>
                      <span class="date">{{ $item->event_date ? $item->event_date->format('d M Y') : '' }}</span>
                    </div>
                    <h3>{{ $item->title }}</h3>
                    <p>{{ $item->location }} · {{ number_format($item->total_photos) }} photos · {{ $item->photographers_count }} photographers</p>
                    <div class="card-bottom">
                      <span class="price">{{ $item->starting_price }}</span>
                      <button class="cta" type="button">{{ $item->is_demo ? 'Test protection' : 'View gallery' }}</button>
                    </div>
                  </div>
                </a>
              </article>
            @endforeach
          </div>
        </div>
      </section>
    @endif

    <!-- ALL EVENTS LIST (Identical to Live Homepage) -->
    <section class="content-section" id="all-events" style="background: rgba(230,240,255,.75);">
      <div class="container-xl">
        <div class="section-header">
          <div>
            <div class="section-kicker" style="background:#eaf3ff;color:#0b2d5b;border-color:rgba(11,45,91,.08);">All events</div>
            <h2 class="section-title">
              @if(request('category'))
                {{ request('category') }} Events
              @elseif(request('q'))
                Search results for "{{ request('q') }}"
              @else
                Browse every gallery
              @endif
            </h2>
          </div>
          <div class="d-flex align-items-center gap-3">
            @if(request()->hasAny(['q', 'category', 'date']))
              <a class="btn btn-sm btn-outline-secondary rounded-pill" href="/dummy-home#discover"><i class="bi bi-x-circle me-1"></i>Clear filter</a>
            @endif
            <a class="inline-link" href="/contact">Need help? Contact us <i class="bi bi-arrow-up-right"></i></a>
          </div>
        </div>

        <div class="event-list-wrapper">
          @forelse($events as $item)
            <article class="event-list-item {{ $item->is_demo ? 'border border-warning' : '' }}">
              <img class="mini-thumb" src="{{ $item->cover_image }}" alt="{{ $item->title }}" oncontextmenu="return false;" draggable="false">
              <div class="top-row">
                <span class="tag">{{ $item->category_name }}</span>
                @if($item->is_demo)
                  <span class="badge bg-warning text-dark font-monospace py-1 px-2">SANDBOX</span>
                @endif
                <span class="location">{{ $item->location }}</span>
              </div>
              <h3>{{ $item->title }}</h3>
              <p>{{ number_format($item->total_photos) }} photos · {{ $item->photographers_count }} photographers · {{ Str::limit($item->description, 60) }}</p>
              <div class="foot">
                <span class="price">{{ $item->starting_price }}</span>
                <a class="cta text-decoration-none" href="#discover" onclick="{{ $item->is_demo ? 'scrollToSandboxPhotos(); return false;' : '' }}">
                  {{ $item->is_demo ? 'Inspect Sandbox' : 'Open' }} <i class="bi bi-arrow-up-right ms-1"></i>
                </a>
              </div>
            </article>
          @empty
            <div class="text-center py-5 w-100">
              <i class="bi bi-calendar-x fs-1 text-muted"></i>
              <h4 class="mt-3">No events found</h4>
              <p class="text-muted">Try clearing your search query or category filters.</p>
              <a href="/dummy-home#discover" class="btn btn-sm btn-outline-primary rounded-pill">Reset filters</a>
            </div>
          @endforelse
        </div>
      </div>
    </section>

    <!-- POPULAR CATEGORIES (Identical to Live Homepage) -->
    @if(isset($categories) && $categories->isNotEmpty())
      <section class="content-section">
        <div class="container-xl">
          <div class="section-header">
            <div>
              <div class="section-kicker" style="background:#eaf3ff;color:#0b2d5b;border-color:rgba(11,45,91,.08);">Discover</div>
              <h2 class="section-title">Popular categories</h2>
            </div>
            <a class="inline-link" href="#discover">View all sports <i class="bi bi-arrow-right"></i></a>
          </div>
          <div class="sports-grid">
            @foreach(($popularCategories ?? $categories)->take(4) as $cat)
              <a href="/dummy-home?category={{ urlencode($cat->name) }}#discover" class="sport-card text-decoration-none text-reset">
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

    <!-- WHY PHOTOX (Identical to Live Homepage) -->
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
              <i class="bi bi-shield-shaded"></i>
              <h4>Anti-Theft Protection</h4>
              <p>Watermarks are burned directly into image pixels server-side. Inspecting or opening in new tabs blocks photo theft.</p>
            </div>
            <div class="feature-item">
              <i class="bi bi-camera"></i>
              <h4>Pixieset EXIF Metadata</h4>
              <p>Camera settings, lens, ISO, shutter speed, aperture and copyright automatically extracted upon photo upload.</p>
            </div>
            <div class="feature-item">
              <i class="bi bi-briefcase"></i>
              <h4>Commercial Licensing</h4>
              <p>Flexible pricing for personal vs commercial usage rights, giving sponsors and media proper commercial licenses.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- TESTIMONIALS (Identical to Live Homepage) -->
    <section aria-labelledby="testimonials-title" class="testimonials-section" id="testimonials">
      <div class="container-xl">
        <div class="testimonial-heading d-flex justify-content-between align-items-end flex-wrap gap-3">
          <div>
            <div class="section-kicker" style="background:#eaf3ff;color:#0b2d5b;border-color:rgba(11,45,91,.08);">The feeling after</div>
            <h2 id="testimonials-title">Loved by the<br><span>people in frame.</span></h2>
          </div>
          <div class="testimonial-controls">
            <button aria-label="Previous testimonial" class="testimonial-arrow" id="testimonialPrev"><i class="bi bi-arrow-left"></i></button>
            <button aria-label="Next testimonial" class="testimonial-arrow" id="testimonialNext"><i class="bi bi-arrow-right"></i></button>
          </div>
        </div>
        <div class="testimonial-window">
          <div class="testimonial-track" id="testimonialTrack">
            <article class="testimonial-slide active">
              <div class="testimonial-portrait"><img alt="Thandi Mokoena" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=500&q=88" oncontextmenu="return false;" draggable="false"></div>
              <div class="testimonial-content">
                <div class="testimonial-mark">“</div>
                <blockquote>Finding my marathon photos took less than a minute. The anti-theft proofing gave our event organizers peace of mind while browsing.</blockquote>
                <div class="testimonial-person"><strong>Thandi Mokoena</strong><span>Runner · Cape Town Marathon</span></div>
              </div>
              <div class="testimonial-meta"><span>PhotoX customer</span><span></span></div>
            </article>
            <article class="testimonial-slide">
              <div class="testimonial-portrait"><img alt="Daniel Jacobs" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=500&q=88" oncontextmenu="return false;" draggable="false"></div>
              <div class="testimonial-content">
                <div class="testimonial-mark">“</div>
                <blockquote>PhotoX gives me a beautiful way to deliver thousands of images without losing the human side of event photography.</blockquote>
                <div class="testimonial-person"><strong>Daniel Jacobs</strong><span>Photographer · Frame South</span></div>
              </div>
              <div class="testimonial-meta"><span>PhotoX creator</span><span></span></div>
            </article>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA SECTION -->
    <section class="content-section pt-0">
      <div class="container-xl">
        <div class="cta-panel">
          <div>
            <div class="section-kicker" style="background:#eaf3ff;color:#0b2d5b;border-color:rgba(11,45,91,.08);">Ready to launch</div>
            <h3>Bring your next event to PhotoX.</h3>
            <p>Photographers, schools and sponsors can upload galleries, publish event pages and sell memories in minutes.</p>
          </div>
          <a class="btn btn-lime rounded-pill px-4" href="{{ route('admin.dummy.event') }}">Open Admin Upload Studio</a>
        </div>
      </div>
    </section>
  </main>

  <!-- HIGH-SECURITY PHOTO INSPECTOR MODAL -->
  <div class="modal fade" id="photoInspectorModal" tabindex="-1" aria-labelledby="photoInspectorTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content border-0 shadow-lg text-light" style="background: #081420; border-radius: 16px; overflow: hidden; border: 1px solid #1c354d !important;">
        
        <div class="modal-header border-bottom border-secondary border-opacity-25 py-3 px-4" style="background: #0c1c2c;">
          <div class="d-flex align-items-center gap-2">
            <span class="badge" style="background: #ff8a00; color: #fff; font-size: 0.72rem; text-transform: uppercase;">
              <i class="bi bi-shield-check me-1"></i> Anti-Theft Watermark Active
            </span>
            <h5 class="modal-title fs-6 fw-bold mb-0 text-white" id="modalPhotoTitle">Photo Inspector</h5>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" onclick="closePhotoInspectorModal()" aria-label="Close" style="cursor: pointer; opacity: 0.95; z-index: 1056; position: relative;"></button>
        </div>

        <div class="modal-body p-0">
          <div class="row g-0">
            <!-- Left: High Security Image Viewer -->
            <div class="col-lg-7 d-flex flex-column align-items-center justify-content-center p-4 position-relative" style="background: #03080e; min-height: 480px;">
              
              <!-- Anti-theft Protected Photo Frame -->
              <div class="position-relative overflow-hidden rounded shadow" style="max-height: 460px; max-width: 100%;">
                
                <!-- The Server-Watermarked Image -->
                <img id="modalPhotoImg" 
                     src="" 
                     alt="Photo Preview" 
                     class="img-fluid rounded" 
                     style="max-height: 460px; object-fit: contain; display: block;" 
                     draggable="false" 
                     oncontextmenu="return false;">

                <!-- Invisible Transparent Shield Overlay to completely block Right-Click 'Save Image As' -->
                <div class="position-absolute top-0 start-0 w-100 h-100" 
                     style="z-index: 10; background: transparent; cursor: default;" 
                     oncontextmenu="showProtectedAlert(event); return false;" 
                     ondragstart="return false;" 
                     onselectstart="return false;">
                </div>

                <!-- Watermark corner emblem -->
                <div class="position-absolute bottom-0 end-0 m-3 px-2 py-1 rounded" style="background: rgba(0,0,0,0.75); color: #ff8a00; font-size: 0.72rem; font-weight: 700; z-index: 11; pointer-events: none;">
                  <i class="bi bi-shield-lock me-1"></i> PHOTOX PROOF · ANTI-THEFT
                </div>
              </div>

              <!-- Security Info Notification below preview -->
              <div class="mt-3 px-3 py-2 rounded text-center w-100" style="background: rgba(255,138,0,0.08); border: 1px dashed rgba(255,138,0,0.35); font-size: 0.76rem; color: #cbd5e1;">
                <i class="bi bi-shield-fill-check text-warning me-1"></i>
                <strong>Security Protection:</strong> Inspecting DevTools or opening this image in a new tab will ONLY yield the burned-in watermarked proof. The clean original is securely restricted to licensed buyers.
              </div>
            </div>

            <!-- Right: Pixieset EXIF Metadata & Commercial Pricing Panel -->
            <div class="col-lg-5 p-4 d-flex flex-column justify-content-between" style="background: #0a1826; border-left: 1px solid #1a3248;">
              <div>
                
                <!-- License Usage Selector (Commercial vs Personal) -->
                <div class="mb-4 p-3 rounded" style="background: #0d1f30; border: 1px solid #1e3e5c;">
                  <label class="form-label text-warning small fw-bold text-uppercase mb-2 d-flex align-items-center gap-1" style="letter-spacing: 0.05em; font-size: 0.82rem;">
                    <i class="bi bi-tag-fill me-1"></i> SELECT USAGE LICENSE
                  </label>
                  
                  <div class="d-flex flex-column gap-2">
                    <label class="d-flex align-items-center justify-content-between p-3 rounded cursor-pointer border" style="background: #0d2136; border-color: #2b5680 !important; cursor: pointer;">
                      <div class="d-flex align-items-center gap-3">
                        <input type="radio" name="license_type" value="personal" checked onchange="updateModalPrice('personal')" style="transform: scale(1.25); accent-color: #ff8a00;">
                        <div>
                          <strong class="text-white d-block" style="font-size: 0.95rem; font-weight: 700; letter-spacing: 0.01em;">Personal License</strong>
                          <span class="d-block" style="color: #cbd5e1; font-size: 0.80rem; margin-top: 2px;">Social media, phone/laptop wallpaper, family prints</span>
                        </div>
                      </div>
                      <span class="fw-bold fs-5" style="color: #ff8a00;" id="modalPersonalPriceLabel">R50.00</span>
                    </label>

                    <label class="d-flex align-items-center justify-content-between p-3 rounded cursor-pointer border" style="background: #0d2136; border-color: #2b5680 !important; cursor: pointer;">
                      <div class="d-flex align-items-center gap-3">
                        <input type="radio" name="license_type" value="commercial" onchange="updateModalPrice('commercial')" style="transform: scale(1.25); accent-color: #4ade80;">
                        <div>
                          <strong class="text-white d-block" style="font-size: 0.95rem; font-weight: 700; letter-spacing: 0.01em;">Commercial &amp; Sponsor License</strong>
                          <span class="d-block" style="color: #cbd5e1; font-size: 0.80rem; margin-top: 2px;">Marketing, brand sponsorships, advertising &amp; editorial usage</span>
                        </div>
                      </div>
                      <span class="fw-bold fs-5" style="color: #4ade80;" id="modalCommercialPriceLabel">R250.00</span>
                    </label>
                  </div>
                </div>

                <!-- Pixieset Style Camera Settings & EXIF Card -->
                <div class="mb-3">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-uppercase fw-bold" style="color: #38bdf8; font-size: 0.84rem; letter-spacing: 0.06em;">
                      <i class="bi bi-camera-reels me-1 text-warning"></i> PIXIESET EXIF METADATA
                    </span>
                    <span class="badge" style="background: rgba(56, 189, 248, 0.18); color: #38bdf8; border: 1px solid rgba(56, 189, 248, 0.4); font-family: monospace; font-size: 0.72rem; padding: 4px 8px;">Auto-Extracted</span>
                  </div>

                  <div class="p-3 rounded" style="background: #071421; border: 1px solid #1c3a57; font-size: 0.82rem;">
                    
                    <div class="row g-2 mb-2 pb-2" style="border-bottom: 1px solid #18334d;">
                      <div class="col-6">
                        <span class="d-block text-uppercase fw-bold" style="color: #38bdf8; font-size: 0.75rem; letter-spacing: 0.06em; margin-bottom: 3px;">Camera</span>
                        <strong class="text-white d-block" style="font-size: 0.90rem; font-weight: 600;" id="modalCamera">-</strong>
                      </div>
                      <div class="col-6">
                        <span class="d-block text-uppercase fw-bold" style="color: #38bdf8; font-size: 0.75rem; letter-spacing: 0.06em; margin-bottom: 3px;">Lens</span>
                        <strong class="text-white d-block text-truncate" style="font-size: 0.90rem; font-weight: 600;" id="modalLens">-</strong>
                      </div>
                    </div>

                    <div class="row g-2 mb-2 pb-2" style="border-bottom: 1px solid #18334d;">
                      <div class="col-4">
                        <span class="d-block text-uppercase fw-bold" style="color: #38bdf8; font-size: 0.75rem; letter-spacing: 0.06em; margin-bottom: 3px;">Shutter</span>
                        <strong class="text-white font-monospace d-block" style="font-size: 0.90rem; font-weight: 600;" id="modalShutter">-</strong>
                      </div>
                      <div class="col-4">
                        <span class="d-block text-uppercase fw-bold" style="color: #38bdf8; font-size: 0.75rem; letter-spacing: 0.06em; margin-bottom: 3px;">Aperture</span>
                        <strong class="text-white font-monospace d-block" style="font-size: 0.90rem; font-weight: 600;" id="modalAperture">-</strong>
                      </div>
                      <div class="col-4">
                        <span class="d-block text-uppercase fw-bold" style="color: #38bdf8; font-size: 0.75rem; letter-spacing: 0.06em; margin-bottom: 3px;">ISO</span>
                        <strong class="text-white font-monospace d-block" style="font-size: 0.90rem; font-weight: 600;" id="modalIso">-</strong>
                      </div>
                    </div>

                    <div class="row g-2">
                      <div class="col-6">
                        <span class="d-block text-uppercase fw-bold" style="color: #38bdf8; font-size: 0.75rem; letter-spacing: 0.06em; margin-bottom: 3px;">Dimensions</span>
                        <strong class="text-white font-monospace d-block" style="font-size: 0.90rem; font-weight: 600;" id="modalDimensions">-</strong>
                      </div>
                      <div class="col-6">
                        <span class="d-block text-uppercase fw-bold" style="color: #38bdf8; font-size: 0.75rem; letter-spacing: 0.06em; margin-bottom: 3px;">File Size</span>
                        <strong class="text-white font-monospace d-block" style="font-size: 0.90rem; font-weight: 600;" id="modalFileSize">-</strong>
                      </div>
                    </div>

                    <div class="mt-2 pt-2" style="border-top: 1px solid #18334d; font-size: 0.75rem;">
                      <i class="bi bi-c-circle me-1 text-warning"></i> <span id="modalCopyright" style="color: #cbd5e1;">© 2026 PhotoX All Rights Reserved</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Price Checkout Action -->
              <div class="pt-3 border-top border-secondary border-opacity-25">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <div>
                    <span class="text-muted small d-block">Selected License Price:</span>
                    <h3 class="text-warning fw-bold mb-0" id="modalActivePrice">R50.00</h3>
                  </div>
                  <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-50 px-3 py-2">
                    <i class="bi bi-check-circle me-1"></i> High-Res Clean Delivery on Purchase
                  </span>
                </div>

                <div class="d-flex gap-2">
                  <button type="button" class="btn btn-warning flex-grow-1 fw-bold text-dark py-2 rounded-pill" onclick="simulateCheckout()">
                    <i class="bi bi-cart-check-fill me-1"></i> Add to Cart (Demo Checkout)
                  </button>
                  <button type="button" class="btn btn-outline-secondary rounded-pill px-3" data-bs-dismiss="modal" onclick="closePhotoInspectorModal()">
                    Close / Cancel
                  </button>
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Protected Right-Click Toast Notification -->
  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11000">
    <div id="protectionToast" class="toast align-items-center text-white bg-dark border border-warning" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body d-flex align-items-center gap-2">
          <i class="bi bi-shield-fill-exclamation text-warning fs-5"></i>
          <div>
            <strong>Right-Click Protected!</strong><br>
            <small class="text-white-50">Images on PhotoX are protected by anti-theft copyright shields.</small>
          </div>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>

  <script>
    let currentActivePhoto = null;
    let currentSelectedLicense = 'personal';

    function scrollToSandboxPhotos() {
      const section = document.querySelector('section[style*="#07121d"]');
      if (section) {
        section.scrollIntoView({ behavior: 'smooth' });
      }
    }

    function openPhotoModal(photo) {
      currentActivePhoto = photo;
      currentSelectedLicense = 'personal';

      document.getElementById('modalPhotoTitle').textContent = photo.title || 'Sandbox Photo';
      
      // Load protected watermarked image (always served with burned-in watermark)
      const photoImg = document.getElementById('modalPhotoImg');
      photoImg.src = `/protected-photo/${photo.id}`;

      // Fill Pixieset Camera & Photo Details
      document.getElementById('modalCamera').textContent = (photo.camera_make || '') + ' ' + (photo.camera_model || 'Sports DSLR');
      document.getElementById('modalLens').textContent = photo.lens || 'Prime / Zoom Lens';
      document.getElementById('modalShutter').textContent = photo.shutter_speed || '1/2000s';
      document.getElementById('modalAperture').textContent = photo.aperture || 'f/2.8';
      document.getElementById('modalIso').textContent = photo.iso ? `ISO ${photo.iso}` : 'ISO 400';
      document.getElementById('modalDimensions').textContent = photo.dimensions || 'High Resolution';
      document.getElementById('modalFileSize').textContent = photo.file_size || '15 MB';
      document.getElementById('modalCopyright').textContent = photo.copyright || '© 2026 PhotoX All Rights Reserved';

      // Pricing labels
      const personalPrice = parseFloat(photo.personal_price || 50).toFixed(2);
      const commercialPrice = parseFloat(photo.commercial_price || 250).toFixed(2);
      document.getElementById('modalPersonalPriceLabel').textContent = `R${personalPrice}`;
      document.getElementById('modalCommercialPriceLabel').textContent = `R${commercialPrice}`;
      
      // Default to personal
      document.querySelector('input[name="license_type"][value="personal"]').checked = true;
      updateModalPrice('personal');

      const modalEl = document.getElementById('photoInspectorModal');
      const bsModal = new bootstrap.Modal(modalEl);
      bsModal.show();
    }

    function updateModalPrice(type) {
      currentSelectedLicense = type;
      if (!currentActivePhoto) return;

      const price = (type === 'commercial') 
        ? parseFloat(currentActivePhoto.commercial_price || 250).toFixed(2)
        : parseFloat(currentActivePhoto.personal_price || 50).toFixed(2);

      const priceEl = document.getElementById('modalActivePrice');
      priceEl.textContent = `R${price}`;
      priceEl.className = (type === 'commercial') ? 'text-success fw-bold mb-0' : 'text-warning fw-bold mb-0';
    }

    function simulateCheckout() {
      if (!currentActivePhoto) return;
      const type = currentSelectedLicense.toUpperCase();
      const price = (currentSelectedLicense === 'commercial') 
        ? currentActivePhoto.commercial_price || 250 
        : currentActivePhoto.personal_price || 50;

      alert(`✅ [DEMO SANDBOX CHECKOUT]\n\nPhoto: "${currentActivePhoto.title}"\nLicense: ${type} USAGE RIGHTS\nAmount: R${price}\n\nUpon checkout completion, the buyer receives a secure, time-limited clean download link without any watermarks!`);
    }

    function showProtectedAlert(event) {
      if (event) event.preventDefault();
      const toastEl = document.getElementById('protectionToast');
      if (toastEl && window.bootstrap) {
        const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
        toast.show();
      }
    }

    function closePhotoInspectorModal() {
      const modalEl = document.getElementById('photoInspectorModal');
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

    // Global right click defense on protected images
    document.addEventListener('contextmenu', function(e) {
      if (e.target.closest('.photo-shield') || e.target.closest('[oncontextmenu]')) {
        e.preventDefault();
        showProtectedAlert(e);
      }
    });
  </script>
@endsection
