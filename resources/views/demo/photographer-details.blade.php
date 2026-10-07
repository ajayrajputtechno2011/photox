@extends('web.layouts.app')

@section('title', 'PhotoX | Aiden Daniels')
@section('body-class', 'page-photographer-details')

@section('content')
  <main>
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
          <div class="photographer-showcase-avatar-column">
            <div class="photographer-showcase-avatar"><img alt="Aiden Daniels" src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=260&q=90"></div>
            <div class="photographer-avatar-facts">
              <span><strong>Member</strong><small>Since 2024</small></span>
            </div>
          </div>
          <div class="photographer-showcase-identity">
            <div class="d-flex align-items-center flex-wrap gap-2">
              <h1 id="photographer-showcase-title" class="mb-0">Aiden Daniels</h1>
              <span class="badge bg-success bg-opacity-75 text-white fw-normal py-1 px-2" style="font-size: 0.78rem;">
                <i class="bi bi-patch-check-fill text-warning me-1"></i> Verified Pro Member
              </span>
            </div>
            <p class="mt-1 mb-2">Sports & event photographer · Cape Town</p>
            <div class="photographer-showcase-meta">
              <span><i class="bi bi-geo-alt"></i> Cape Town, South Africa</span><span><i class="bi bi-calendar-check"></i> Member since 2024</span><span><i class="bi bi-star-fill"></i> 4.9 rating</span>
            </div><a class="photographer-profile-albums" href="#albums">View albums <i class="bi bi-arrow-down-right"></i></a>
          </div><button class="photographer-showcase-contact" id="openPhotographerMessage" type="button"><i class="bi bi-envelope"></i> Contact photographer</button>
        </div>
        <div class="photographer-showcase-toolbar" id="albums">
          <div>
            <span class="showcase-eyebrow">AIDEN DANIELS</span>
            <h2>17 albums</h2>
          </div><button type="button"><i class="bi bi-filter"></i> Filter albums</button>
        </div>
        <div class="photographer-album-grid">
          <a class="photographer-album-card" href="/browse-photos"><img alt="City marathon runners" src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=700&q=88">
          <div>
            <strong>City Marathon 2026</strong><span>Running · 248 photos</span>
          </div></a> <a class="photographer-album-card" href="/browse-photos"><img alt="Rugby match" src="https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=700&q=88">
          <div>
            <strong>Maties vs Ikeys</strong><span>Rugby · 186 photos</span>
          </div></a> <a class="photographer-album-card" href="/browse-photos"><img alt="Runner on track" src="https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=700&q=88">
          <div>
            <strong>Running Season</strong><span>Track & field · 312 photos</span>
          </div></a> <a class="photographer-album-card" href="/browse-photos"><img alt="Portrait session" src="https://images.unsplash.com/photo-1521412644187-c49fa049e84d?auto=format&fit=crop&w=700&q=88">
          <div>
            <strong>Portrait Sessions</strong><span>Portraits · 94 photos</span>
          </div></a> <a class="photographer-album-card" href="/browse-photos"><img alt="Cyclist on an open road" src="https://images.unsplash.com/photo-1541625602330-2277a4c46182?auto=format&fit=crop&w=700&q=88">
          <div>
            <strong>Winelands Cycle Tour</strong><span>Cycling · 204 photos</span>
          </div></a> <a class="photographer-album-card" href="/browse-photos"><img alt="Football match" src="https://images.unsplash.com/photo-1517466787929-bc90951d0974?auto=format&fit=crop&w=700&q=88">
          <div>
            <strong>School Sport Finals</strong><span>Football · 156 photos</span>
          </div></a>
        </div>
        <div class="photographer-showcase-about" id="about">
          <span class="showcase-eyebrow">ABOUT THE PHOTOGRAPHER</span>
          <p>Documentary sports photography for the split second, the quiet build-up and everything that happens after the finish line.</p>
        </div>
      </div>
    </section>

    <section class="photographer-detail-section photographer-about-section">
      <div class="container-xl photographer-about-grid">
        <div>
          <span class="section-kicker">01 · The photographer</span>
          <h2>An eye for the moment before it happens.</h2>
        </div>
        <div class="photographer-about-copy">
          <p>Aiden captures decisive movement, athlete emotion and the atmosphere of live events with a documentary approach that keeps every frame honest and alive.</p>
          <p>Based in Cape Town, he works across road running, rugby, school sport, team portraits and high-energy community events. His galleries are immediate, organised and easy to share.</p>
          <div class="photographer-tags">
            <span>Sports</span><span>Events</span><span>Portraits</span><span>Marathons</span><span>Rugby</span>
          </div>
        </div>
      </div>
    </section>

    <section class="photographer-detail-section photographer-portfolio-section" id="portfolio">
      <div class="container-xl">
        <div class="photographer-section-heading">
          <div>
            <span class="section-kicker">02 · Selected work</span>
            <h2>Frames from the field.</h2>
          </div><a class="section-link" href="/browse-photos">Open full gallery <i class="bi bi-arrow-up-right"></i></a>
        </div>
        <div class="photographer-portfolio-grid">
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
        </div>
      </div>
    </section>

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
            <p>From arrival to awards, with an edited gallery ready for your community.</p><strong>From R2,500</strong>
          </article>
          <article class="featured-service">
            <i class="bi bi-people"></i>
            <h3>Team & club stories</h3>
            <p>Match action, portraits and shared gallery delivery for teams and schools.</p><strong>From R1,800</strong><span>Most requested</span>
          </article>
          <article>
            <i class="bi bi-person-bounding-box"></i>
            <h3>Portrait sessions</h3>
            <p>Natural portraits for athletes, founders, families and creative teams.</p><strong>From R950</strong>
          </article>
        </div>
      </div>
    </section>

    <section class="photographer-detail-section photographer-review-section">
      <div class="container-xl photographer-review-grid">
        <div>
          <span class="section-kicker">04 · Client feedback</span>
          <h2>Good work travels<br>
          <em>by word of mouth.</em></h2>
          <div class="photographer-rating">
            <strong>4.9</strong><span>★★★★★<small>126 verified reviews</small></span>
          </div>
        </div>
        <div class="photographer-review-list">
          <blockquote>
            <div>
              ★★★★★
            </div>
            <p>“Aiden understood exactly when to wait and when to move. The gallery felt like being back at the race.”</p><cite>Ayesha Khan <span>· Cape Town Marathon</span></cite>
          </blockquote>
          <blockquote>
            <div>
              ★★★★★
            </div>
            <p>“The team portraits and action shots gave our whole club something to be proud of.”</p><cite>Lebo Mokoena <span>· School sports organiser</span></cite>
          </blockquote>
        </div>
      </div>
    </section>

    <div aria-labelledby="photographerMessageTitle" class="photographer-message-modal" hidden="" id="photographerMessageModal" role="dialog">
      <div class="photographer-message-backdrop" data-close-message=""></div>
      <div class="photographer-message-panel">
        <button aria-label="Close message form" class="photographer-message-close" data-close-message="" type="button"><i class="bi bi-x-lg"></i></button>
        <div class="photographer-message-heading">
          <img alt="Aiden Daniels" src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=160&q=85">
          <div>
            <span class="showcase-eyebrow">PHOTOGRAPHER CONTACT</span>
            <h2 id="photographerMessageTitle">Message Aiden Daniels</h2>
          </div>
        </div>
        <form id="photographerMessageForm" name="photographerMessageForm">
          <div class="photographer-message-fields">
            <label>Your name<input name="name" placeholder="How should they call you?" required="" type="text"></label><label>Your email<input name="email" placeholder="you@example.com" required="" type="email"></label>
          </div><label>Your message
          <textarea name="message" placeholder="Tell Aiden what you need photographed..." required="" rows="5"></textarea></label>
          <p class="photographer-message-note"><i class="bi bi-shield-check"></i> Your message will be sent securely through PhotoX.</p><button class="btn btn-lime rounded-pill px-4" type="submit">Send message <i class="bi bi-send ms-2"></i></button>
        </form>
      </div>
    </div>

    <aside class="site-ad-banner" aria-label="Sponsored placement">
      <a class="site-ad-link" href="/events"><img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&h=360&q=88" alt="Adventure vehicle on an open road"><span class="site-ad-overlay"></span><span class="site-ad-copy"><small>PHOTOX PARTNER</small><strong>BUILT FOR MORE<br>THAN ROADS</strong><span>Explore events <i class="bi bi-arrow-up-right"></i></span></span></a>
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
     messageTrigger.addEventListener('click', () => {
       messageModal.hidden = false;
       document.body.classList.add('message-modal-open');
       messageModal.querySelector('input').focus();
     });
     messageModal.querySelectorAll('[data-close-message]').forEach((element) => element.addEventListener('click', closeMessageModal));
     document.addEventListener('keydown', (event) => {
       if (event.key === 'Escape' && !messageModal.hidden) closeMessageModal();
     });
     messageForm.addEventListener('submit', (event) => {
       event.preventDefault();
       messageForm.innerHTML = '<div class="photographer-message-success"><i class="bi bi-check-circle-fill"><\/i><h3>Message ready to send.<\/h3><p>Aiden will be able to reply to your email once messaging is connected.<\/p><button class="btn btn-dark rounded-pill px-4" data-close-message type="button">Close<\/button><\/div>';
       messageForm.querySelector('[data-close-message]').addEventListener('click', closeMessageModal);
     });
  </script>
@endsection