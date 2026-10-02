@extends('web.layouts.app')

@section('title', 'PhotoX | Find the moment. Then keep it.')
@section('body-class', 'page-events')

@section('styles')
  <style>
    body.page-events .events-page-hero {
      padding: 50px 0 42px !important;
      padding-right: 0 !important;
    }
    body.page-events .events-page-hero .hero-intro-col {
      max-width: 100% !important;
      padding-right: 15px;
    }
    body.page-events .events-page-hero h1,
    body.page-events .events-page-hero .hero-title {
      font-size: clamp(2.3rem, 3.6vw, 3.7rem) !important;
      line-height: 1.05 !important;
      letter-spacing: -0.04em !important;
      max-width: 100% !important;
      margin-bottom: 16px !important;
    }
    body.page-events .events-page-hero p,
    body.page-events .events-page-hero .hero-desc {
      font-size: 1.05rem !important;
      line-height: 1.55 !important;
      color: rgba(255, 255, 255, 0.88) !important;
      max-width: 100% !important;
      margin-bottom: 22px !important;
    }
    body.page-events .events-page-hero .hero-banner-col {
      display: flex;
      justify-content: center;
      align-items: center;
    }
    body.page-events .events-page-hero .hero-banner-frame {
      width: 100%;
      max-width: 620px;
    }
    body.page-events .events-page-hero .hero-ad-carousel {
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
    body.page-events .events-page-hero .hero-ad-slide img {
      border-radius: 14px !important;
      object-fit: cover !important;
    }
    @media (max-width: 991.98px) {
      body.page-events .events-page-hero {
        padding: 38px 0 34px !important;
      }
      body.page-events .events-page-hero .hero-intro-col {
        padding-right: 0;
      }
      body.page-events .events-page-hero .hero-banner-frame {
        max-width: 520px;
        margin-top: 10px;
      }
    }
  </style>
@endsection

@section('content')
  @php
    $events = $events ?? collect();
  @endphp
  <main>
    <section class="events-page-hero">
      @php
        $hero = $pageHeroes['home'] ?? ($pageHeroes['events'] ?? null);
      @endphp
      <div class="container-xl position-relative" style="z-index: 2;">
        <div class="row align-items-center g-4 g-lg-5">
          <div class="col-lg-6 hero-intro-col">
            <div class="section-kicker"><span class="live-dot"></span>{{ $hero->kicker ?? 'Live archive' }}</div>
            <h1 class="hero-title">{!! !empty($hero->title) ? nl2br($hero->title) : 'Find the moment. <br><em>Then keep it.</em>' !!}</h1>
            <p class="hero-desc">{{ $hero->description ?? 'Explore premium sports and event galleries across the country. From city marathons to school finals, every listing is designed to make browsing and buying photos simple, secure and fast.' }}</p>
            <div class="hero-actions">
              <a class="btn btn-lime rounded-pill px-4 py-2 fw-semibold" href="{{ $hero->primary_button_url ?? '#discover' }}">{{ $hero->primary_button_text ?? 'Browse events' }}</a>
              <a class="btn btn-outline-light rounded-pill px-4 py-2 fw-semibold" href="{{ $hero->secondary_button_url ?? '/signup' }}">{{ $hero->secondary_button_text ?? 'Create account' }}</a>
            </div>
          </div>
          <div class="col-lg-6 hero-banner-col">
            <div class="hero-banner-frame">
              @include('web.partials.hero-ad-carousel')
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="search-wrap" id="discover">
      <div class="container-xl">
        <div class="search-card">
          <form action="/#discover" method="GET" class="search-grid">
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

    <!-- Featured latest events -->
    @if(isset($featuredEvents) && $featuredEvents->isNotEmpty() && !request()->hasAny(['q', 'category', 'date']))
      <section class="content-section">
        <div class="container-xl">
          <div class="section-header">
            <div>
              <div class="section-kicker" style="background:#eaf3ff;color:#0b2d5b;border-color:rgba(11,45,91,.08);">Featured archive</div>
              <h2 class="section-title">Latest events</h2>
            </div>
            <a class="inline-link" href="#all-events">View all events <i class="bi bi-arrow-down"></i></a>
          </div>

          <div class="event-grid">
            @foreach($featuredEvents as $item)
              <article class="event-card">
                <a href="/event-details/{{ $item->slug }}" class="text-decoration-none text-reset d-block">
                  <img src="{{ $item->cover_image }}" alt="{{ $item->title }}">
                  <div class="body">
                    <div class="meta-row">
                      <span class="tag">{{ $item->category_name }}</span>
                      <span class="date">{{ $item->event_date ? $item->event_date->format('d M Y') : '' }}</span>
                    </div>
                    <h3>{{ $item->title }}</h3>
                    <p>{{ $item->location }} · {{ number_format($item->total_photos) }} photos · {{ $item->photographers_count }} photographers</p>
                    <div class="card-bottom">
                      <span class="price">{{ $item->starting_price }}</span>
                      <button class="cta" type="button">View gallery</button>
                    </div>
                  </div>
                </a>
              </article>
            @endforeach
          </div>
        </div>
      </section>
    @endif

    <!-- All Events List -->
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
              <a class="btn btn-sm btn-outline-secondary rounded-pill" href="/#discover"><i class="bi bi-x-circle me-1"></i>Clear filter</a>
            @endif
            <a class="inline-link" href="/contact">Need help? Contact us <i class="bi bi-arrow-up-right"></i></a>
          </div>
        </div>

        <div class="event-list-wrapper">
          @forelse($events as $item)
            <article class="event-list-item">
              <img class="mini-thumb" src="{{ $item->cover_image }}" alt="{{ $item->title }}">
              <div class="top-row">
                <span class="tag">{{ $item->category_name }}</span>
                <span class="location">{{ $item->location }}</span>
              </div>
              <h3>{{ $item->title }}</h3>
              <p>{{ number_format($item->total_photos) }} photos · {{ $item->photographers_count }} photographers · {{ Str::limit($item->description, 60) }}</p>
              <div class="foot">
                <span class="price">{{ $item->starting_price }}</span>
                <a class="cta text-decoration-none" href="/event-details/{{ $item->slug }}">Open <i class="bi bi-arrow-up-right ms-1"></i></a>
              </div>
            </article>
          @empty
            <div class="text-center py-5 w-100">
              <i class="bi bi-calendar-x fs-1 text-muted"></i>
              <h4 class="mt-3">No events found</h4>
              <p class="text-muted">Try clearing your search query or category filters.</p>
              <a href="/#discover" class="btn btn-sm btn-outline-primary rounded-pill">Reset filters</a>
            </div>
          @endforelse
        </div>
      </div>
    </section>

    <!-- Popular categories -->
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
              <a href="/?category={{ urlencode($cat->name) }}#discover" class="sport-card text-decoration-none text-reset">
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

    <!-- Why PhotoX Feature Band -->
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

    <!-- Testimonials Slider -->
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

    <!-- Stories / Journal Section -->
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

    <!-- Ready to Launch CTA -->
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
@endsection
