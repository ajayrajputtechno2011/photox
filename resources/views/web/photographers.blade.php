@extends('web.layouts.app')

@section('title', 'PhotoX | The Photographers')
@section('body-class', 'page-events page-photographers')

@section('styles')
  <style>
    body.page-photographers .events-page-hero {
      min-height: 480px;
      position: relative;
      overflow: hidden;
    }
    body.page-photographers .hero-intro-col {
      max-width: 520px;
      position: relative;
      z-index: 2;
    }
    body.page-photographers .events-page-hero h1 {
      font-size: clamp(2.4rem, 4vw, 4.6rem);
      letter-spacing: -.08em;
      line-height: .95;
      margin: 18px 0 16px;
      max-width: 520px;
      word-break: break-word;
      overflow-wrap: break-word;
    }
    body.page-photographers .events-page-hero p {
      max-width: 500px;
      color: rgba(255, 255, 255, .8);
      font-size: 1rem;
      line-height: 1.5;
    }
    @media (min-width: 1200px) and (max-width: 1399.98px) {
      .hero-ad-carousel {
        width: 440px !important;
        max-width: 38vw !important;
        height: 275px !important;
        right: 3% !important;
      }
      body.page-photographers .hero-intro-col,
      body.page-photographers .events-page-hero h1,
      body.page-photographers .events-page-hero p {
        max-width: calc(100% - 460px) !important;
      }
      body.page-photographers .events-page-hero h1 {
        font-size: clamp(2.2rem, 3.4vw, 3.2rem) !important;
      }
    }
    @media (max-width: 1199.98px) {
      .hero-ad-carousel {
        position: relative !important;
        top: auto !important;
        left: auto !important;
        right: auto !important;
        bottom: auto !important;
        width: calc(100% - 32px) !important;
        max-width: 580px !important;
        height: auto !important;
        aspect-ratio: 16 / 9 !important;
        transform: none !important;
        order: 2 !important;
        margin: 28px auto 0 !important;
      }
      body.page-photographers .events-page-hero {
        display: flex !important;
        flex-direction: column !important;
        padding-right: 0 !important;
        padding-bottom: 40px !important;
        min-height: auto !important;
      }
      body.page-photographers .events-page-hero > .container-xl {
        order: 1 !important;
        max-width: 100% !important;
      }
      body.page-photographers .hero-intro-col,
      body.page-photographers .events-page-hero h1,
      body.page-photographers .events-page-hero p {
        max-width: 100% !important;
      }
    }

    body.page-photographers .person-card {
      display: flex !important;
      flex-direction: column !important;
      background: #ffffff !important;
      border-radius: 16px !important;
      overflow: hidden !important;
      box-shadow: 0 10px 25px rgba(11, 45, 91, .06) !important;
      border: 1px solid rgba(11, 45, 91, .08) !important;
      height: 100% !important;
      transition: transform 0.25s ease, box-shadow 0.25s ease !important;
    }
    body.page-photographers .person-card:hover {
      transform: translateY(-5px) !important;
      box-shadow: 0 16px 36px rgba(11, 45, 91, .12) !important;
    }
    body.page-photographers .person-image {
      height: 310px !important;
      padding: 12px !important;
      background: #f8fafc !important;
      position: relative !important;
      overflow: hidden !important;
    }
    body.page-photographers .person-image img {
      width: 100% !important;
      height: 100% !important;
      object-fit: cover !important;
      border-radius: 10px !important;
    }
    body.page-photographers .person-info {
      height: auto !important;
      min-height: 175px !important;
      padding: 18px 20px 20px !important;
      display: flex !important;
      flex-direction: column !important;
      flex-grow: 1 !important;
      justify-content: space-between !important;
      background: #ffffff !important;
      position: relative !important;
      box-sizing: border-box !important;
    }
    body.page-photographers .person-info h3 {
      font-size: 1.45rem !important;
      margin-bottom: 6px !important;
      line-height: 1.2 !important;
      color: #0b2d5b !important;
    }
    body.page-photographers .person-info p {
      font-size: 0.82rem !important;
      line-height: 1.45 !important;
      color: #64748b !important;
      margin-bottom: 14px !important;
      flex-grow: 1 !important;
    }
    body.page-photographers .person-footer-row {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      padding-top: 12px !important;
      border-top: 1px solid rgba(11, 45, 91, 0.1) !important;
      margin-top: auto !important;
      width: 100% !important;
    }
    body.page-photographers .events-pill {
      display: inline-flex !important;
      align-items: center !important;
      gap: 6px !important;
      color: #0b2d5b !important;
      font-weight: 700 !important;
      font-size: 0.85rem !important;
      background: #eaf3ff !important;
      padding: 5px 12px !important;
      border-radius: 20px !important;
      border: 1px solid rgba(11, 45, 91, 0.12) !important;
    }
    body.page-photographers .person-footer-row a {
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      width: 36px !important;
      height: 36px !important;
      border-radius: 50% !important;
      background: #0b2d5b !important;
      color: #ffffff !important;
      text-decoration: none !important;
      transition: all 0.2s ease !important;
    }
    body.page-photographers .person-footer-row a:hover {
      background: #ff8a00 !important;
      color: #ffffff !important;
      transform: scale(1.1) !important;
    }
  </style>
@endsection

@section('content')
  <main>
    <section class="events-page-hero">
      @include('web.partials.hero-ad-carousel')

      @php
        $hero = $pageHeroes['photographers'] ?? null;
      @endphp
      <div class="container-xl">
        <div class="hero-intro-col">
          <div class="section-kicker"><span class="live-dot"></span>{{ $hero->kicker ?? 'PhotoX / The Photographers' }}</div>
          <h1>{!! $hero->title ?? 'Good eyes. <br><em>see more.</em>' !!}</h1>
          <p>{{ $hero->description ?? 'Meet the photographers behind the moments. From race days to match days, they capture movement, emotion and stories that last. Find the right creative eye for your next event.' }}</p>
          <div class="hero-actions">
            <a class="btn btn-lime rounded-pill px-4" href="{{ $hero->primary_button_url ?? '#roster' }}">{{ $hero->primary_button_text ?? 'Meet the roster' }}</a>
            @if(!empty($hero->secondary_button_text))
              <a class="btn btn-outline-light rounded-pill px-4" href="{{ $hero->secondary_button_url ?? '/signup' }}">{{ $hero->secondary_button_text }}</a>
            @endif
          </div>
        </div>
      </div>
    </section>

    <section class="people-roster" id="roster" style="background: rgba(230, 240, 255, .75);">
      <div class="container-xl">
        <div class="people-roster-heading">
          <div>
            <span class="people-label dark">THE PHOTOX ROSTER</span>
            <h2>Meet the<br>
            <em>Photographers.</em></h2>
          </div>
          <label class="people-search"><i class="bi bi-search"></i><input aria-label="Search photographers" id="search" placeholder="Search names or specialties"></label>
        </div>
        <p class="creator-note">Find the right eye for your event. Search by sport (e.g. Rugby, Running, Cycling), name or location, then explore the verified creators capturing your moments.</p>
        <div class="people-filters">
          <button class="people-filter active" data-filter="all">Everyone</button>
          <button class="people-filter" data-filter="rugby">Rugby</button>
          <button class="people-filter" data-filter="running">Running</button>
          <button class="people-filter" data-filter="cycling">Cycling</button>
          <button class="people-filter" data-filter="sport">All Sports</button>
          <button class="people-filter" data-filter="portrait">Portraits</button>
        </div>
        <div class="people-grid" id="grid">
          @forelse($photographers as $index => $creator)
            @php
              $isGuild = strtolower($creator->tier ?? '') === 'photoguild' || ($creator->membership && $creator->membership->slug === 'photoguild');
              $isPro = strtolower($creator->tier ?? '') === 'pro' || ($creator->membership && $creator->membership->slug === 'pro');
              $isStandard = strtolower($creator->tier ?? '') === 'standard' || ($creator->membership && $creator->membership->slug === 'standard');
              $spec = strtolower($creator->specialty ?? '');
              $filterType = 'sport';
              if (str_contains($spec, 'portrait')) {
                  $filterType = 'portrait';
              } elseif (str_contains($spec, 'event')) {
                  $filterType = 'event';
              }
              $creatorSportsList = $creator->events->pluck('category_name')->filter()->unique()->implode(' ');
              $searchBlob = strtolower($creator->name . ' ' . ($creator->specialty ?? '') . ' ' . ($creator->location ?? '') . ' ' . $creatorSportsList);
            @endphp
            <article class="person-card {{ $isPro || $isGuild ? 'person-featured' : '' }}" 
                     data-name="{{ $searchBlob }}" 
                     data-sports="{{ strtolower($creatorSportsList) }}"
                     data-type="{{ $filterType }}">
              <div class="person-image">
                <img alt="{{ $creator->name }}" src="{{ $creator->avatar ?: asset('logo.png') }}" style="{{ $creator->avatar ? '' : 'background: #0b1a29; object-fit: contain; padding: 24px;' }}">
                <span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
              </div>
              <div class="person-info">
                <div class="d-flex align-items-center justify-content-between mb-1">
                  <small>{{ strtoupper($creator->specialty ?: 'SPORT') }} / {{ strtoupper(explode(',', $creator->location ?? 'South Africa')[0]) }}</small>
                  @if($isGuild)
                    <span class="badge py-1 px-2 rounded-pill" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: #000; font-size: 0.65rem; font-weight: 700;">
                      <i class="bi bi-award-fill"></i> Guild
                    </span>
                  @elseif($isPro)
                    <span class="badge bg-success py-1 px-2 rounded-pill" style="font-size: 0.65rem;">
                      <i class="bi bi-patch-check-fill"></i> Pro
                    </span>
                  @elseif($isStandard)
                    <span class="badge bg-primary py-1 px-2 rounded-pill" style="font-size: 0.65rem;">
                      <i class="bi bi-shield-check"></i> Standard
                    </span>
                  @endif
                </div>
                <h3>{{ $creator->name }}</h3>
                <p>{{ Str::limit($creator->bio ?: 'Sports & action photographer covering moments that matter.', 75) }}</p>
                <div class="person-footer-row">
                  <span class="events-pill">
                    <i class="bi bi-calendar-event text-primary"></i> {{ $creator->events_count ?? $creator->events->count() }} events
                  </span>
                  <a aria-label="{{ $creator->name }} profile" href="{{ route('photographers.show', $creator->id) }}">
                    <i class="bi bi-arrow-up-right"></i>
                  </a>
                </div>
              </div>
            </article>
          @empty
            <div class="col-12 text-center py-5">
              <p class="text-muted">No verified creators available right now.</p>
            </div>
          @endforelse
        </div>
        <p class="people-empty" hidden="" id="empty">No creators found.</p>
      </div>
    </section>

    <section class="creator-benefits" style="background-color: #f4f8ff;">
      <div class="container-xl">
        <div class="creator-benefits-heading"><span class="people-label dark">WHY CREATORS CHOOSE PHOTOX</span><h2>More time making. <em>Less time managing.</em></h2></div>
        <div class="benefit-grid">
          <article class="benefit-item"><i class="bi bi-window-stack"></i><h3>A polished storefront</h3><p>Present every event with a beautiful gallery that feels considered on desktop and mobile.</p></article>
          <article class="benefit-item"><i class="bi bi-lightning-charge"></i><h3>Simple delivery</h3><p>Upload, organise and deliver secure event galleries without losing time to repetitive admin.</p></article>
          <article class="benefit-item"><i class="bi bi-people"></i><h3>A wider audience</h3><p>Reach athletes, families, schools and sponsors already looking for their next moment.</p></article>
        </div>
      </div>
    </section>

    <section class="people-footer-cta">
      <div class="container-xl">
        <span class="people-label">FOR THE PEOPLE BEHIND THE CAMERA</span>
        <h2>Your view<br>
        <em>belongs here.</em></h2><a href="/signup">Join PhotoX <i class="bi bi-arrow-up-right"></i></a>
      </div>
    </section>

    <aside class="site-ad-banner" aria-label="Sponsored placement">
      <a class="site-ad-link" href="/events"><img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&h=360&q=88" alt="Adventure vehicle on an open road"><span class="site-ad-overlay"></span><span class="site-ad-copy"><small>PHOTOX PARTNER</small><strong>BUILT FOR MORE<br>THAN ROADS</strong><span>Explore events <i class="bi bi-arrow-up-right"></i></span></span></a>
    </aside>
  </main>
@endsection

@section('scripts')
  <script>
    const cards = [...document.querySelectorAll('.person-card')];
    const tabs = [...document.querySelectorAll('.people-filter')];
    const search = document.getElementById('search');

    function filter() {
      const type = document.querySelector('.people-filter.active').dataset.filter;
      const q = search.value.toLowerCase().trim();
      let n = 0;
      cards.forEach(c => {
        const sports = (c.dataset.sports || '').toLowerCase();
        const cType = (c.dataset.type || '').toLowerCase();
        const nameBlob = (c.dataset.name || '').toLowerCase();

        let typeMatch = false;
        if (type === 'all') {
          typeMatch = true;
        } else if (type === 'rugby' || type === 'running' || type === 'cycling') {
          typeMatch = sports.includes(type) || nameBlob.includes(type);
        } else if (type === 'sport') {
          typeMatch = (cType === 'sport') || sports.length > 0;
        } else {
          typeMatch = (cType === type) || nameBlob.includes(type);
        }

        const searchMatch = !q || nameBlob.includes(q) || sports.includes(q);
        const show = typeMatch && searchMatch;
        c.hidden = !show;
        if (show) n++;
      });
      document.getElementById('empty').hidden = n > 0;
    }

    tabs.forEach(t => t.onclick = () => {
      tabs.forEach(x => x.classList.remove('active'));
      t.classList.add('active');
      filter();
    });
    if (search) search.oninput = filter;
  </script>
@endsection
