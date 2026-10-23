@extends('web.layouts.app')

@section('title', 'PhotoX | Explore Events')

@section('body-class', 'page-events')

@section('content')
<main>
  <!-- 1. HERO SECTION -->
  <section class="events-page-hero">
    @php
      $hero = $pageHeroes['events'] ?? ($pageHeroes['home'] ?? null);
    @endphp
    <div class="container-xl position-relative" style="z-index: 2;">
      <div class="row align-items-center g-4">
        <div class="col-lg-6 hero-intro-col">
          <div class="section-kicker"><span class="live-dot"></span>{{ $hero->kicker ?? 'Live archive' }}</div>
          <h1>{!! !empty($hero->title) ? nl2br($hero->title) : 'Find the moment. <br><em>Then keep it.</em>' !!}</h1>
          <p>{{ $hero->description ?? 'Explore premium sports and event galleries across the country. From city marathons to school finals, every listing is designed to make browsing and buying photos simple, secure and fast.' }}</p>
          <div class="hero-actions">
            <a class="btn btn-lime rounded-pill px-4" href="{{ $hero->primary_button_url ?? '#all-events' }}">{{ $hero->primary_button_text ?? 'Browse events' }}</a>
            <a class="btn btn-outline-light rounded-pill px-4" href="{{ $hero->secondary_button_url ?? '/signup' }}">{{ $hero->secondary_button_text ?? 'Create account' }}</a>
          </div>
        </div>
        <div class="col-lg-6 hero-banner-col">
          @include('web.partials.hero-partner-frame')
        </div>
      </div>
    </div>
  </section>

  <!-- 2. SEARCH WRAPPER -->
  <section class="search-wrap" id="discover">
    <div class="container-xl">
      <div class="search-card">
        <form action="/events#all-events" method="GET" class="search-grid" id="homeMainSearchForm">
          <div class="position-relative home-main-search-wrap">
            <input type="search" id="homeMainSearchInput" name="q" value="{{ request('q') }}" placeholder="Search by event, venue, school or photographer" autocomplete="off" aria-label="Search events or creators">
            <div id="homeMainSearchSpinner" class="spinner-border spinner-border-sm text-primary position-absolute d-none" style="right: 18px; top: 20px; width: 1.1rem; height: 1.1rem;" role="status"></div>
            <div id="homeMainSearchDropdown" class="home-main-search-dropdown d-none">
              <div id="homeMainSearchResults"></div>
            </div>
          </div>
          <select name="category" aria-label="Sport type">
            <option value="">All categories</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->name }}" {{ request('category') === $cat->name ? 'selected' : '' }}>
                {{ $cat->name }}
              </option>
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

  <!-- 3. FEATURED LATEST EVENTS -->
  @if($featuredEvents->isNotEmpty() && !request()->hasAny(['q', 'category', 'date']))
    <section class="content-section" style="padding-bottom: 28px !important;">
      <div class="container-xl">
        <div class="section-header">
          <div>
            <div class="section-kicker" style="background:#eaf3ff;color:#0b2d5b;border-color:rgba(11,45,91,.08);">Featured archive</div>
            <h2 class="section-title">Latest events</h2>
            <p class="text-muted small mb-0 mt-1">Browse high-impact tournament and race photography.</p>
          </div>
          <a class="inline-link" href="#all-events">View all events <i class="bi bi-arrow-down"></i></a>
        </div>

        <div class="event-grid">
          @foreach($featuredEvents as $item)
            <article class="event-card">
              <a href="/event-details/{{ $item->slug }}" class="text-decoration-none text-reset d-block">
                <div class="position-relative overflow-hidden" style="aspect-ratio: 16 / 10; background: #0b1a29;">
                  <img src="{{ $item->cover_image }}" alt="{{ $item->title }}" class="w-100 h-100 object-fit-cover" loading="lazy">
                  <span class="position-absolute top-0 end-0 m-2 badge bg-dark bg-opacity-75 text-warning border border-warning" style="font-size: 0.70rem;">
                    <i class="bi bi-images me-1"></i> {{ number_format($item->photos_count ?? $item->total_photos ?? 0) }} photos
                  </span>
                </div>
                <div class="body">
                  <div class="meta-row">
                    <span class="tag">{{ $item->category_name }}</span>
                    <span class="date">{{ $item->event_date ? \Carbon\Carbon::parse($item->event_date)->format('d M Y') : '' }}</span>
                  </div>
                  <h3>{{ $item->title }}</h3>
                  <p>{{ $item->location }} · {{ number_format($item->photos_count ?? $item->total_photos ?? 0) }} photos @if($item->photographer || $item->photographer_name) · {{ $item->photographer?->name ?? $item->photographer_name }} @endif</p>
                  <div class="card-bottom">
                    <span class="price">{{ $item->starting_price ?? 'From R50' }}</span>
                    <span class="cta text-decoration-none text-center">
                      View gallery
                    </span>
                  </div>
                </div>
              </a>
            </article>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  <!-- 4. SPONSOR BANNER (With Dynamic Auto-Rotation) -->
  @php
    $activeSponsors = (isset($sponsorBanners) && $sponsorBanners->isNotEmpty()) ? $sponsorBanners : ((isset($sponsorBanner) && $sponsorBanner) ? collect([$sponsorBanner]) : collect());
  @endphp
  @if($activeSponsors->isNotEmpty())
    <aside class="container-xl my-4" aria-label="Sponsored placement" style="padding-top: 0; padding-bottom: 0;">
      <div id="eventsPageSponsorCarousel" class="w-100 overflow-hidden shadow-sm position-relative" style="border-radius: 16px; border: 1px solid rgba(11,45,91,0.08); background: #061019; max-height: 200px;">
        @foreach($activeSponsors as $idx => $sBanner)
          <div class="sponsor-slide {{ $loop->first ? 'active' : '' }}" data-sponsor-index="{{ $idx }}" style="{{ $loop->first ? 'display: block;' : 'display: none;' }}">
            <a href="{{ $sBanner->link_url ?: '#' }}" target="_blank" class="d-block w-100 text-decoration-none position-relative" style="line-height: 0;">
              <img src="{{ $sBanner->image_url }}" 
                   alt="{{ $sBanner->title ?: 'Sponsored Banner' }}" 
                   class="w-100 d-block" 
                   style="width: 100%; height: auto; max-height: 220px; object-fit: contain; border-radius: 16px; background: #061019;" 
                   loading="lazy">
              @if(!empty($sBanner->badge_text))
                <span class="position-absolute top-0 end-0 m-2 m-md-3 px-2 py-1 badge bg-dark text-warning border border-warning" style="font-size: 0.68rem; letter-spacing: 0.05em; z-index: 2; line-height: 1.2;">
                  {{ $sBanner->badge_text }}
                </span>
              @endif
            </a>
          </div>
        @endforeach
      </div>
    </aside>

    @if($activeSponsors->count() > 1)
      <script>
        (function() {
          const slides = document.querySelectorAll('#eventsPageSponsorCarousel .sponsor-slide');
          if (slides.length <= 1) return;
          let current = 0;
          setInterval(function() {
            slides[current].style.display = 'none';
            slides[current].classList.remove('active');
            current = (current + 1) % slides.length;
            slides[current].style.display = 'block';
            slides[current].classList.add('active');
          }, 5000);
        })();
      </script>
    @endif
  @endif

  <!-- 5. ALL EVENTS & DYNAMIC CATEGORY PILLS BAR (Identical to Home style) -->
  <section class="content-section" id="all-events" style="background: rgba(230,240,255,.75); padding-top: 36px !important;">
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
          <p class="text-muted small mb-0 mt-1">Select any sport category below to instantly filter tournaments and race albums.</p>
        </div>
        <div class="d-flex align-items-center gap-3">
          @if(request()->hasAny(['q', 'category', 'date']))
            <a class="btn btn-sm btn-outline-secondary rounded-pill" href="/events#all-events"><i class="bi bi-x-circle me-1"></i>Clear filter</a>
          @endif
          <a class="inline-link" href="#popular-categories">View sport categories <i class="bi bi-arrow-down"></i></a>
        </div>
      </div>

      <!-- CATEGORY PILLS BAR -->
      <div class="mb-4 d-flex align-items-center gap-2 flex-wrap" id="categoryPillsContainer">
        <a href="/events#all-events" class="btn btn-sm rounded-pill px-3 py-1 fw-bold category-pill-btn {{ !request('category') ? 'active' : '' }}" style="{{ !request('category') ? 'background:#ff8a00; border-color:#ff8a00; color:#000;' : 'background:#fff; border:1px solid rgba(11,45,91,0.12); color:#0b2d5b;' }}">
          All Categories
        </a>
        @foreach($categories->where('events_count', '>', 0) as $catItem)
          <a href="/events?category={{ urlencode($catItem->name) }}#all-events" class="btn btn-sm rounded-pill px-3 py-1 fw-medium category-pill-btn {{ request('category') === $catItem->name ? 'active' : '' }}" style="{{ request('category') === $catItem->name ? 'background:#ff8a00; border-color:#ff8a00; color:#000;' : 'background:#fff; border:1px solid rgba(11,45,91,0.12); color:#0b2d5b;' }}">
            {{ $catItem->name }}
          </a>
        @endforeach
      </div>

      <!-- EVENT CARDS GRID (100% Matching Home Card Structure) -->
      <div class="event-grid">
        @forelse($events as $item)
          <article class="event-card">
            <a href="/event-details/{{ $item->slug }}" class="text-decoration-none text-reset d-block">
              <div class="position-relative overflow-hidden" style="aspect-ratio: 16 / 10; background: #0b1a29;">
                <img src="{{ $item->cover_image }}" alt="{{ $item->title }}" class="w-100 h-100 object-fit-cover" loading="lazy">
                <span class="position-absolute top-0 end-0 m-2 badge bg-dark bg-opacity-75 text-warning border border-warning" style="font-size: 0.70rem;">
                  <i class="bi bi-images me-1"></i> {{ number_format($item->photos_count ?? $item->total_photos ?? 0) }} photos
                </span>
              </div>
              <div class="body">
                <div class="meta-row">
                  <span class="tag">{{ $item->category_name }}</span>
                  <span class="date">{{ $item->event_date ? \Carbon\Carbon::parse($item->event_date)->format('d M Y') : '' }}</span>
                </div>
                <h3>{{ $item->title }}</h3>
                <p>{{ $item->location }} · {{ number_format($item->photos_count ?? $item->total_photos ?? 0) }} photos @if($item->photographer || $item->photographer_name) · {{ $item->photographer?->name ?? $item->photographer_name }} @endif</p>
                <div class="card-bottom">
                  <span class="price">{{ $item->starting_price ?? 'From R50' }}</span>
                  <span class="cta text-decoration-none text-center">
                    View gallery
                  </span>
                </div>
              </div>
            </a>
          </article>
        @empty
          <div class="col-12 text-center py-5 bg-white rounded-4 border shadow-sm my-3 w-100">
            <i class="bi bi-search fs-1 d-block mb-3 text-secondary"></i>
            <h4>No events found matching your criteria</h4>
            <p class="text-muted">Try selecting "All Categories" or searching with a broader keyword.</p>
            <a href="/events#all-events" class="btn btn-lime rounded-pill px-4 mt-2">Reset &amp; Show All Events</a>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- 6. POPULAR CATEGORIES (Dynamic sports grid from database with active event counts) -->
  @if(isset($popularCategories) && $popularCategories->isNotEmpty())
    <section class="content-section" id="popular-categories">
      <div class="container-xl">
        <div class="section-header">
          <div>
            <div class="section-kicker" style="background:#eaf3ff;color:#0b2d5b;border-color:rgba(11,45,91,.08);">Discover</div>
            <h2 class="section-title">Popular categories</h2>
          </div>
          <a class="inline-link" href="/events#all-events">Browse all sports <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="sports-grid">
          @foreach($popularCategories as $category)
            <a href="/events?category={{ urlencode($category->name) }}#all-events" class="sport-card text-decoration-none text-reset">
              <div class="sport-icon"><i class="bi {{ $category->icon ?: 'bi-trophy' }}"></i></div>
              <h3>{{ $category->name }}</h3>
              <p>{{ $category->description ?: 'School finals, fixtures and tournament highlights.' }}</p>
              @if($category->events_count > 0)
                <span class="badge bg-light text-dark border mt-2" style="font-size: 0.72rem;">
                  <i class="bi bi-calendar-check me-1 text-warning"></i> {{ $category->events_count }} {{ Str::plural('Event', $category->events_count) }}
                </span>
              @endif
            </a>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  <!-- 7. WHY PHOTOX FEATURE BAND -->
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

  <!-- 8. READY TO LAUNCH CTA -->
  <section class="content-section" style="padding-top:0;">
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

  @include('web.partials.site-ad-banner')
</main>
@endsection

@section('scripts')
<script>
  (function() {
    function initHomeMainSearch() {
      const input = document.getElementById('homeMainSearchInput');
      const dropdown = document.getElementById('homeMainSearchDropdown');
      const resultsContainer = document.getElementById('homeMainSearchResults');
      const spinner = document.getElementById('homeMainSearchSpinner');
      const form = document.getElementById('homeMainSearchForm');
      if (!input || !dropdown || !resultsContainer) return;

      let debounceTimer = null;
      let abortController = null;

      function renderResults(data, query) {
        if (!data || data.total === 0) {
          resultsContainer.innerHTML = `
            <div class="p-3 text-center text-white-50">
              <i class="bi bi-search text-white-50 d-block fs-4 mb-2"></i>
              <div class="small">No matches found for <strong class="text-white">"${escapeHtml(query)}"</strong></div>
              <div style="font-size: 0.75rem;" class="mt-1">Press <strong>Search</strong> to browse all events.</div>
            </div>
            <a href="{{ url('/events') }}?q=${encodeURIComponent(query)}" class="top-search-footer-btn">
              Search all events for "${escapeHtml(query)}" &rarr;
            </a>
          `;
          dropdown.classList.remove('d-none');
          return;
        }

        let html = '';

        // Events
        if (data.events && data.events.length > 0) {
          html += '<div class="top-search-header"><i class="bi bi-calendar-event me-1"></i> Events</div>';
          data.events.forEach(item => {
            const imgHtml = item.image 
              ? `<img src="${item.image}" alt="" class="top-search-thumb">` 
              : `<div class="top-search-thumb d-flex align-items-center justify-content-center text-white-50"><i class="bi bi-image"></i></div>`;
            const dateLoc = [item.date, item.location]
              .filter(Boolean)
              .map(val => escapeHtml(val))
              .join(' <span class="opacity-50">&bull;</span> ');
            html += `
              <a href="${item.url}" class="top-search-item">
                ${imgHtml}
                <div class="overflow-hidden flex-grow-1">
                  <div class="fw-semibold text-truncate text-white" style="font-size: 0.88rem;">${escapeHtml(item.title)}</div>
                  <div class="text-white-50 text-truncate" style="font-size: 0.74rem;">${dateLoc}</div>
                </div>
                ${item.category ? `<span class="badge bg-secondary bg-opacity-50 text-white-50 small ms-auto" style="font-size: 0.65rem;">${escapeHtml(item.category)}</span>` : ''}
              </a>
            `;
          });
        }

        // Photographers
        if (data.photographers && data.photographers.length > 0) {
          html += '<div class="top-search-header"><i class="bi bi-camera me-1"></i> Photographers</div>';
          data.photographers.forEach(p => {
            const avatarHtml = p.avatar 
              ? `<img src="${p.avatar}" alt="" class="top-search-avatar">` 
              : `<div class="top-search-avatar text-warning"><i class="bi bi-camera-fill" style="font-size: 0.85rem;"></i></div>`;
            html += `
              <a href="${p.url}" class="top-search-item">
                ${avatarHtml}
                <div class="overflow-hidden flex-grow-1">
                  <div class="fw-semibold text-truncate text-white" style="font-size: 0.88rem;">${escapeHtml(p.name)}</div>
                  <div class="text-white-50 text-truncate" style="font-size: 0.74rem;">${escapeHtml(p.specialty || 'Creator')}</div>
                </div>
                <span class="badge bg-info bg-opacity-25 text-info small ms-auto" style="font-size: 0.65rem;">Creator</span>
              </a>
            `;
          });
        }

        // Categories / Sports
        if (data.categories && data.categories.length > 0) {
          html += '<div class="top-search-header"><i class="bi bi-tag me-1"></i> Sports &amp; Categories</div>';
          data.categories.forEach(c => {
            html += `
              <a href="${c.url}" class="top-search-item">
                <div class="top-search-avatar text-info"><i class="bi bi-trophy"></i></div>
                <div class="fw-semibold text-truncate text-white flex-grow-1" style="font-size: 0.88rem;">${escapeHtml(c.name)}</div>
                <i class="bi bi-arrow-right text-white-50 small ms-auto"></i>
              </a>
            `;
          });
        }

        // View All Link
        html += `
          <a href="${data.view_all_url || ('{{ url('/events') }}?q=' + encodeURIComponent(query))}" class="top-search-footer-btn">
            View all results for "${escapeHtml(query)}" &rarr;
          </a>
        `;

        resultsContainer.innerHTML = html;
        dropdown.classList.remove('d-none');
      }

      function doSearch(query) {
        if (abortController) {
          abortController.abort();
        }
        abortController = new AbortController();

        if (spinner) spinner.classList.remove('d-none');

        fetch('{{ url('/api/quick-search') }}?q=' + encodeURIComponent(query), {
          signal: abortController.signal,
          headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
        .then(res => res.json())
        .then(data => {
          if (spinner) spinner.classList.add('d-none');
          renderResults(data, query);
        })
        .catch(err => {
          if (err.name === 'AbortError') return;
          if (spinner) spinner.classList.add('d-none');
        });
      }

      input.addEventListener('input', function() {
        const query = this.value.trim();
        clearTimeout(debounceTimer);
        if (query.length < 2) {
          dropdown.classList.add('d-none');
          if (spinner) spinner.classList.add('d-none');
          return;
        }
        debounceTimer = setTimeout(() => doSearch(query), 250);
      });

      input.addEventListener('focus', function() {
        const query = this.value.trim();
        if (query.length >= 2 && resultsContainer.innerHTML.trim() !== '') {
          dropdown.classList.remove('d-none');
        }
      });

      // Close dropdown on outside click
      document.addEventListener('click', function(e) {
        if (!e.target.closest('#homeMainSearchForm')) {
          dropdown.classList.add('d-none');
        }
      });

      // Close on Escape
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
          dropdown.classList.add('d-none');
        }
      });

      function escapeHtml(str) {
        if (!str) return '';
        return String(str)
          .replace(/&/g, '&amp;')
          .replace(/</g, '&lt;')
          .replace(/>/g, '&gt;')
          .replace(/"/g, '&quot;')
          .replace(/'/g, '&#039;');
      }
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initHomeMainSearch);
    } else {
      initHomeMainSearch();
    }
  })();
</script>
@endsection
