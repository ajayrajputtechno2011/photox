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
        <p class="creator-note">Find the right eye for your event. Search by name, location or specialty, then explore the creators who turn race days, matches and community moments into images worth keeping.</p>
        <div class="people-filters">
          <button class="people-filter active" data-filter="all">Everyone</button><button class="people-filter" data-filter="sport">Sports</button><button class="people-filter" data-filter="event">Events</button><button class="people-filter" data-filter="portrait">Portraits</button>
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
            @endphp
            <article class="person-card {{ $isPro || $isGuild ? 'person-featured' : '' }}" data-name="{{ strtolower($creator->name . ' ' . ($creator->specialty ?? '') . ' ' . ($creator->location ?? '')) }}" data-type="{{ $filterType }}">
              <div class="person-image">
                <img alt="{{ $creator->name }}" src="{{ $creator->avatar ?: 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=900&q=90' }}">
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
                <a aria-label="{{ $creator->name }} profile" href="{{ route('photographers.show', $creator->id) }}"><i class="bi bi-arrow-up-right"></i></a>
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
      const q = search.value.toLowerCase();
      let n = 0;
      cards.forEach(c => {
        const show = (type === 'all' || c.dataset.type === type) && (!q || c.dataset.name.includes(q));
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
