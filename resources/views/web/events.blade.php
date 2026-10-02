<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Discover upcoming sports and event photo galleries on PhotoX.">
  <title>PhotoX | Explore Events</title>
  <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
  <script defer src="{{ asset('site-ad.js') }}"></script>
</head>
<body class="page-events">
  <nav aria-label="Main navigation" class="navbar navbar-expand-lg py-2">
    <div class="container-xl">
      <a aria-label="PhotoX home" class="navbar-brand d-flex align-items-center gap-2" href="/"><img alt="PhotoX" src="{{ asset('logo.png') }}"></a>
      <button aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler border-0 p-0" data-bs-target="#mainNav" data-bs-toggle="collapse" type="button"><i class="bi bi-list fs-2"></i></button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav mx-auto gap-lg-3 mt-3 mt-lg-0">
          <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="/events">Explore</a></li>
          <li class="nav-item"><a class="nav-link" href="/photographers">Photographers</a></li>
          <li class="nav-item"><a class="nav-link" href="/membership">Membership</a></li>
          <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
        </ul>
        <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
          <form action="/events#discover" method="GET" class="header-search d-none d-xl-flex">
            <i class="bi bi-search"></i>
            <input aria-label="Search photos, people, teams or events" name="q" value="{{ request('q') }}" placeholder="Search photos, people, teams or events..." type="search">
          </form>
          <a class="header-cart" href="/cart" aria-label="Open cart"><i class="bi bi-cart3"></i><span>0</span></a>
          @auth
            <div class="dropdown">
              <button class="btn btn-outline-light rounded-pill px-3 dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                @if(Auth::user()->role === 'admin')
                  <li><a class="dropdown-item" href="/admin/dashboard"><i class="bi bi-speedometer2 me-2"></i>Admin Dashboard</a></li>
                @elseif(Auth::user()->role === 'photographer')
                  <li><a class="dropdown-item" href="/photographer-dashboard"><i class="bi bi-camera me-2"></i>Creator Workspace</a></li>
                @else
                  <li><a class="dropdown-item" href="/customer-dashboard"><i class="bi bi-person me-2"></i>My Dashboard</a></li>
                @endif
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                  </form>
                </li>
              </ul>
            </div>
          @else
            <a class="text-link d-none d-sm-inline" href="/login"><i class="bi bi-person me-1"></i>Login</a>
            <a class="btn btn-lime rounded-pill px-4" href="/signup">Sign Up <i class="bi bi-arrow-up-right ms-1"></i></a>
          @endauth
        </div>
      </div>
    </div>
  </nav>

  <main>
    <section class="events-page-hero">
      @include('web.partials.hero-ad-carousel')

      @php
        $hero = $pageHeroes['events'] ?? null;
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

    <section class="search-wrap" id="discover">
      <div class="container-xl">
        <div class="search-card">
          <form action="/events#discover" method="GET" class="search-grid">
            <input type="search" name="q" value="{{ request('q') }}" placeholder="Search by event, venue, school or photographer">
            <select name="category" aria-label="Sport type">
              <option value="">All categories</option>
              @foreach($categories as $cat)
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
    @if($featuredEvents->isNotEmpty() && !request()->hasAny(['q', 'category', 'date']))
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
              <a class="btn btn-sm btn-outline-secondary rounded-pill" href="/events#discover"><i class="bi bi-x-circle me-1"></i>Clear filter</a>
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
            <div class="p-5 text-center text-muted w-100 bg-white rounded-3 shadow-sm my-3">
              <i class="bi bi-search fs-1 d-block mb-3 text-secondary"></i>
              <h4>No events found matching your criteria</h4>
              <p class="text-muted">Try searching with a different keyword or selecting "All categories".</p>
              <a href="/events#discover" class="btn btn-lime rounded-pill px-4 mt-2">Reset &amp; Show All Events</a>
            </div>
          @endforelse
        </div>
      </div>
    </section>

    <!-- Popular categories section -->
    <section class="content-section">
      <div class="container-xl">
        <div class="section-header">
          <div>
            <div class="section-kicker" style="background:#eaf3ff;color:#0b2d5b;border-color:rgba(11,45,91,.08);">Discover</div>
            <h2 class="section-title">Popular categories</h2>
          </div>
        </div>
        <div class="sports-grid">
          @foreach($categories as $category)
            <a href="/events?category={{ urlencode($category->name) }}#discover" class="sport-card text-decoration-none text-reset">
              <div class="sport-icon"><i class="bi {{ $category->icon ?: 'bi-trophy' }}"></i></div>
              <h3>{{ $category->name }}</h3>
              <p>{{ $category->description ?: 'School finals, fixtures and tournament highlights.' }}</p>
            </a>
          @endforeach
        </div>
      </div>
    </section>

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
  </main>

  <footer class="footer footer-premium">
    <div class="container-xl">
      <div class="row g-5 footer-main">
        <div class="col-lg-5">
          <a class="footer-logo" href="/"><img src="{{ asset('logo.png') }}" alt="PhotoX" style="width:150px"></a>
          <p class="footer-copy">The feeling of being there,<br>kept in a frame.</p>
          <div class="footer-social d-flex gap-3">
            <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" aria-label="Linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
        <div class="col-6 col-lg-2"><p class="footer-label">Explore</p><a href="/events">Events</a><a href="/photographers">Photographers</a><a href="/blog">Journal</a><a href="/contact">Contact</a></div>
        <div class="col-6 col-lg-2"><p class="footer-label">For creators</p><a href="/login">Creator login</a><a href="/signup">Join PhotoX</a><a href="/events">Upload photos</a><a href="/blog">Support</a></div>
        <div class="col-12 col-lg-3"><p class="footer-label">Stay in the frame</p><p class="footer-small">New events, fresh galleries and stories from the field.</p><div class="newsletter"><input aria-label="Email address" placeholder="Your email address" type="email"><button aria-label="Subscribe"><i class="bi bi-arrow-up-right"></i></button></div></div>
      </div>
      <div class="footer-bottom"><span>© 2026 PhotoX</span><span>Privacy · Terms ·</span><span>Made for the moments <i class="bi bi-stars"></i></span></div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
