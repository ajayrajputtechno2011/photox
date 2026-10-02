@extends('web.layouts.app')

@section('title', 'PhotoX | ' . ($photographer->name ?? 'Aiden Daniels'))
@section('body-class', 'page-photographer-details')

@section('content')
  <main>
    <!-- 1. HERO COVER & SHOWCASE HEADER -->
    <section aria-labelledby="photographer-showcase-title" class="photographer-showcase">
      <div class="photographer-cover">
        <div class="container-xl photographer-cover-content">
          <div class="photographer-hero-kicker">
            <span class="live-dot"></span> Professional photographer profile
          </div>
          <h1>The eye behind<br>
          <em>the moment.</em></h1>
        </div>
      </div>

      <div class="container-xl photographer-showcase-body">
        <div class="photographer-showcase-heading">
          <!-- Avatar Column -->
          <div class="photographer-showcase-avatar-column">
            <div class="photographer-showcase-avatar">
              <img alt="{{ $photographer->name }}" src="{{ $photographer->avatar ?: 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=260&q=90' }}">
            </div>
            <div class="photographer-avatar-facts">
              <span><strong>Member</strong><small>Since {{ $photographer->created_at ? $photographer->created_at->format('Y') : '2024' }}</small></span>
            </div>
          </div>

          <!-- Identity & Dynamic Verification Badge -->
          <div class="photographer-showcase-identity">
            @php
              $tierSlug = strtolower($photographer->tier ?? 'pro');
              if ($tierSlug === 'photoguild' || str_contains($tierSlug, 'guild')) {
                  $tierHeading = 'Photo Guild Member';
                  $tierBadgeStyle = 'background: linear-gradient(135deg, #f59e0b, #d97706); color: #000; font-weight: 700;';
                  $tierIcon = 'bi-award-fill';
              } elseif ($tierSlug === 'pro') {
                  $tierHeading = 'Pro Member';
                  $tierBadgeStyle = 'background: rgba(25, 135, 84, 0.85); color: #fff; font-weight: 600;';
                  $tierIcon = 'bi-patch-check-fill';
              } elseif ($tierSlug === 'standard') {
                  $tierHeading = 'Standard Member';
                  $tierBadgeStyle = 'background: rgba(13, 110, 253, 0.85); color: #fff; font-weight: 600;';
                  $tierIcon = 'bi-shield-check';
              } else {
                  $tierHeading = ucfirst($tierSlug) . ' Member';
                  $tierBadgeStyle = 'background: rgba(108, 117, 125, 0.85); color: #fff; font-weight: 600;';
                  $tierIcon = 'bi-person-check-fill';
              }
            @endphp

            <div class="d-flex align-items-center flex-wrap gap-2">
              <h1 id="photographer-showcase-title" class="mb-0">{{ $photographer->name }}</h1>
              <span class="badge py-1 px-2.5 rounded-pill shadow-sm" style="{{ $tierBadgeStyle }} font-size: 0.78rem;">
                <i class="bi {{ $tierIcon }} text-warning me-1"></i> {{ $tierHeading }}
              </span>
            </div>
            <p class="mt-1 mb-2">{{ $photographer->bio ? Str::limit($photographer->bio, 80) : 'Sports & event photographer · Cape Town' }}</p>
            <div class="photographer-showcase-meta">
              <span><i class="bi bi-geo-alt"></i> Cape Town, South Africa</span>
              <span><i class="bi bi-calendar-check"></i> Member since {{ $photographer->created_at ? $photographer->created_at->format('Y') : '2024' }}</span>
              <span><i class="bi bi-star-fill text-warning"></i> 4.9 rating</span>
            </div>
            <a class="photographer-profile-albums" href="#albums">View albums <i class="bi bi-arrow-down-right"></i></a>
          </div>

          <button class="photographer-showcase-contact" id="openPhotographerMessage" type="button">
            <i class="bi bi-envelope"></i> Contact photographer
          </button>
        </div>

        <!-- Albums Toolbar -->
        <div class="photographer-showcase-toolbar" id="albums">
          <div>
            <span class="showcase-eyebrow">{{ strtoupper($photographer->name) }}</span>
            <h2>{{ $albums->count() }} albums</h2>
          </div>
          <button type="button" onclick="document.getElementById('albumsGridContainer').scrollIntoView({behavior:'smooth'})">
            <i class="bi bi-filter"></i> Filter albums
          </button>
        </div>

        <!-- Dynamic Album Grid -->
        <div class="photographer-album-grid" id="albumsGridContainer">
          @forelse($albums as $album)
            @php
              $coverImg = 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=700&q=88';
              if ($album->photos && $album->photos->isNotEmpty()) {
                  $coverImg = '/protected-photo/' . $album->photos->first()->id;
              } elseif (!empty($album->banner_image)) {
                  $coverImg = $album->banner_image;
              }
              $count = $album->photos_count ?? ($album->photos ? $album->photos->count() : 0);
            @endphp
            <a class="photographer-album-card" href="{{ route('events.show', $album->slug) }}">
              <img alt="{{ $album->title }}" src="{{ $coverImg }}" loading="lazy">
              <div>
                <strong>{{ $album->title }}</strong>
                <span>{{ $album->category_name ?? 'Sports' }} · {{ number_format($count > 0 ? $count : 180) }} photos</span>
              </div>
            </a>
          @empty
            <p class="text-muted">No albums published yet.</p>
          @endforelse
        </div>

        <!-- About Showcase Snippet -->
        <div class="photographer-showcase-about" id="about">
          <span class="showcase-eyebrow">ABOUT THE PHOTOGRAPHER</span>
          <p>{{ $photographer->bio ?: 'Documentary sports photography for the split second, the quiet build-up and everything that happens after the finish line.' }}</p>
        </div>
      </div>
    </section>

    <!-- 2. SECTION 01: THE PHOTOGRAPHER -->
    <section class="photographer-detail-section photographer-about-section">
      <div class="container-xl photographer-about-grid">
        <div>
          <span class="section-kicker">01 · The photographer</span>
          <h2>An eye for the moment before it happens.</h2>
        </div>
        <div class="photographer-about-copy">
          <p>{{ $photographer->bio ?: 'Aiden captures decisive movement, athlete emotion and the atmosphere of live events with a documentary approach that keeps every frame honest and alive.' }}</p>
          <p>Based in Cape Town, he works across road running, rugby, school sport, team portraits and high-energy community events. His galleries are immediate, organised and easy to share.</p>
          <div class="photographer-tags">
            @if(isset($categories) && $categories->isNotEmpty())
              @foreach($categories->take(5) as $cat)
                <span>{{ $cat->name }}</span>
              @endforeach
            @else
              <span>Sports</span>
              <span>Events</span>
              <span>Portraits</span>
              <span>Marathons</span>
              <span>Rugby</span>
            @endif
          </div>
        </div>
      </div>
    </section>

    <!-- 3. SECTION 02: SELECTED WORK -->
    <section class="photographer-detail-section photographer-portfolio-section" id="portfolio">
      <div class="container-xl">
        <div class="photographer-section-heading">
          <div>
            <span class="section-kicker">02 · Selected work</span>
            <h2>Frames from the field.</h2>
          </div>
          <a class="section-link" href="#albums">Open full gallery <i class="bi bi-arrow-up-right"></i></a>
        </div>
        <div class="photographer-portfolio-grid">
          @if(isset($photos) && $photos->isNotEmpty())
            @foreach($photos->take(4) as $p)
              <figure class="{{ $loop->first ? 'portfolio-feature' : '' }}">
                <img alt="{{ $p->title }}" src="/protected-photo/{{ $p->id }}" loading="lazy">
                <figcaption>
                  <strong>{{ $p->title ?: 'Action Moment' }}</strong>
                  <span>{{ $p->event->title ?? 'Official Event' }} · {{ $p->event && $p->event->event_date ? \Carbon\Carbon::parse($p->event->event_date)->format('Y') : '2026' }}</span>
                </figcaption>
              </figure>
            @endforeach
          @else
            <figure class="portfolio-feature">
              <img alt="Runner crossing the finish line" src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=1200&q=90">
              <figcaption>
                <strong>Finish line energy</strong><span>Cape Town Marathon · 2026</span>
              </figcaption>
            </figure>
            <figure>
              <img alt="Rugby action" src="https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=900&q=90">
              <figcaption>
                <strong>Matchday action</strong><span>School rugby · Stellenbosch</span>
              </figcaption>
            </figure>
            <figure>
              <img alt="Portrait session" src="https://images.unsplash.com/photo-1521412644187-c49fa049e84d?auto=format&fit=crop&w=900&q=90">
              <figcaption>
                <strong>Portrait set</strong><span>Waterfront sessions</span>
              </figcaption>
            </figure>
            <figure>
              <img alt="Cyclist on an open road" src="https://images.unsplash.com/photo-1541625602330-2277a4c46182?auto=format&fit=crop&w=900&q=90">
              <figcaption>
                <strong>Open roads</strong><span>Winelands Cycle Tour</span>
              </figcaption>
            </figure>
          @endif
        </div>
      </div>
    </section>

    <!-- 4. SECTION 03: SERVICES & PACKAGES -->
    <section class="photographer-detail-section photographer-services-section">
      <div class="container-xl">
        <div class="photographer-section-heading">
          <div>
            <span class="section-kicker">03 · Services & packages</span>
            <h2>Coverage that fits the day.</h2>
          </div>
        </div>
        <div class="photographer-service-grid">
          <article>
            <i class="bi bi-stopwatch"></i>
            <h3>Event coverage</h3>
            <p>From arrival to awards, with an edited gallery ready for your community.</p>
            <strong>From R2,500</strong>
          </article>
          <article class="featured-service">
            <i class="bi bi-people"></i>
            <h3>Team & club stories</h3>
            <p>Match action, portraits and shared gallery delivery for teams and schools.</p>
            <strong>From R1,800</strong>
            <span>Most requested</span>
          </article>
          <article>
            <i class="bi bi-person-bounding-box"></i>
            <h3>Portrait sessions</h3>
            <p>Natural portraits for athletes, founders, families and creative teams.</p>
            <strong>From R950</strong>
          </article>
        </div>
      </div>
    </section>

    <!-- 5. SECTION 04: CLIENT FEEDBACK & REVIEWS -->
    <section class="photographer-detail-section photographer-review-section">
      <div class="container-xl photographer-review-grid">
        <div>
          <span class="section-kicker">04 · Client feedback</span>
          <h2>Good work travels<br>
          <em>by word of mouth.</em></h2>
          <div class="photographer-rating">
            <strong>4.9</strong>
            <span>★★★★★<small>126 verified reviews</small></span>
          </div>
        </div>
        <div class="photographer-review-list">
          <blockquote>
            <div>★★★★★</div>
            <p>“Aiden understood exactly when to wait and when to move. The gallery felt like being back at the race.”</p>
            <cite>Ayesha Khan <span>· Cape Town Marathon</span></cite>
          </blockquote>
          <blockquote>
            <div>★★★★★</div>
            <p>“The team portraits and action shots gave our whole club something to be proud of.”</p>
            <cite>Lebo Mokoena <span>· School sports organiser</span></cite>
          </blockquote>
        </div>
      </div>
    </section>

    <!-- 6. CONTACT PHOTOGRAPHER MODAL -->
    <div aria-labelledby="photographerMessageTitle" class="photographer-message-modal" hidden="" id="photographerMessageModal" role="dialog">
      <div class="photographer-message-backdrop" data-close-message=""></div>
      <div class="photographer-message-panel">
        <button aria-label="Close message form" class="photographer-message-close" data-close-message="" type="button">
          <i class="bi bi-x-lg"></i>
        </button>
        <div class="photographer-message-heading">
          <img alt="{{ $photographer->name }}" src="{{ $photographer->avatar ?: 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=160&q=85' }}">
          <div>
            <span class="showcase-eyebrow">PHOTOGRAPHER CONTACT</span>
            <h2 id="photographerMessageTitle">Message {{ $photographer->name }}</h2>
          </div>
        </div>
        <form id="photographerMessageForm" name="photographerMessageForm">
          <div class="photographer-message-fields">
            <label>Your name<input name="name" placeholder="How should they call you?" required="" type="text"></label>
            <label>Your email<input name="email" placeholder="you@example.com" required="" type="email"></label>
          </div>
          <label>Your message
            <textarea name="message" placeholder="Tell {{ explode(' ', $photographer->name)[0] }} what you need photographed..." required="" rows="5"></textarea>
          </label>
          <p class="photographer-message-note"><i class="bi bi-shield-check"></i> Your message will be sent securely through PhotoX.</p>
          <button class="btn btn-lime rounded-pill px-4" type="submit">Send message <i class="bi bi-send ms-2"></i></button>
        </form>
      </div>
    </div>

    <!-- 7. SPONSORED PARTNER BANNER -->
    <aside class="site-ad-banner" aria-label="Sponsored placement">
      @if(isset($imagePreviewBanner) && $imagePreviewBanner)
        <a class="site-ad-link" href="{{ $imagePreviewBanner->target_url ?: '/events' }}">
          <img src="{{ $imagePreviewBanner->image_path ?: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&h=360&q=88' }}" alt="Sponsored partner banner">
          <span class="site-ad-overlay"></span>
          <span class="site-ad-copy">
            <small>PHOTOX PARTNER</small>
            <strong>{{ $imagePreviewBanner->title ?: 'BUILT FOR MORE THAN ROADS' }}</strong>
            <span>Explore events <i class="bi bi-arrow-up-right"></i></span>
          </span>
        </a>
      @else
        <a class="site-ad-link" href="/events">
          <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&h=360&q=88" alt="Adventure vehicle on an open road">
          <span class="site-ad-overlay"></span>
          <span class="site-ad-copy">
            <small>PHOTOX PARTNER</small>
            <strong>BUILT FOR MORE<br>THAN ROADS</strong>
            <span>Explore events <i class="bi bi-arrow-up-right"></i></span>
          </span>
        </a>
      @endif
    </aside>
  </main>
@endsection

@section('scripts')
  <script>
     const messageModal = document.getElementById('photographerMessageModal');
     const messageTrigger = document.getElementById('openPhotographerMessage');
     const messageForm = document.getElementById('photographerMessageForm');
     const closeMessageModal = () => {
       messageModal.hidden = true;
       document.body.classList.remove('message-modal-open');
     };
     if (messageTrigger && messageModal) {
       messageTrigger.addEventListener('click', () => {
         messageModal.hidden = false;
         document.body.classList.add('message-modal-open');
         const firstInput = messageModal.querySelector('input');
         if (firstInput) firstInput.focus();
       });
       messageModal.querySelectorAll('[data-close-message]').forEach((element) => element.addEventListener('click', closeMessageModal));
       document.addEventListener('keydown', (event) => {
         if (event.key === 'Escape' && !messageModal.hidden) closeMessageModal();
       });
     }
     if (messageForm) {
       messageForm.addEventListener('submit', (event) => {
         event.preventDefault();
         messageForm.innerHTML = '<div class="photographer-message-success text-center py-4"><i class="bi bi-check-circle-fill text-success fs-1 d-block mb-2"><\/i><h3 class="fw-bold">Message sent successfully!<\/h3><p class="text-muted small">{{ explode(" ", $photographer->name)[0] }} will receive your inquiry and reply via email shortly.<\/p><button class="btn btn-dark rounded-pill px-4 mt-2" data-close-message type="button">Close<\/button><\/div>';
         const closeBtn = messageForm.querySelector('[data-close-message]');
         if (closeBtn) closeBtn.addEventListener('click', closeMessageModal);
       });
     }
  </script>
@endsection