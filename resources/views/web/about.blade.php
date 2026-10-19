@extends('web.layouts.app')

@section('title', 'PhotoX | About')
@section('body-class', 'page-about')

@section('content')
  <main>
    <section class="about-hero">
      @php
        $hero = $pageHeroes['about'] ?? null;
        $storyTitle = $hero->extra_data['story_title'] ?? 'How sports clubs are turning match-day moments into lasting memories.';
        $storyDesc = $hero->extra_data['story_description'] ?? 'From grassroots school fixtures to city marathons, galleries increasingly live beyond the event itself.';
        $storyImg = $hero->image_url ?? 'https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=1200&q=80';
      @endphp
      <div class="container-xl hero-layout">
        <div>
          <div class="section-kicker" style="color:#dfeafe;">{{ $hero->kicker ?? 'About PhotoX' }}</div>
          <h1>{!! $hero->title ?? 'Stories that <em>last longer.</em>' !!}</h1>
          <p>{{ $hero->description ?? 'PhotoX brings athletes, families, clubs, schools and sponsors into one elegant digital storefront for sports and event photography. Our focus is simple: make outstanding images easy to discover, easy to buy and easy to revisit.' }}</p>
          <div class="hero-actions">
            <a class="btn btn-lime rounded-pill px-4" href="{{ $hero->primary_button_url ?? url('/events') }}">{{ $hero->primary_button_text ?? 'Explore events' }}</a>
            <a class="btn btn-outline-light rounded-pill px-4" href="{{ $hero->secondary_button_url ?? url('/photographers') }}">{{ $hero->secondary_button_text ?? 'Meet creators' }}</a>
          </div>
        </div>

        <div class="feature-story">
          <img src="{{ $storyImg }}" alt="Story image">
          <div class="meta">
            <span>{{ $hero->badge_text ?? 'Featured story' }}</span>
            <span>April 2026</span>
          </div>
          <h3>{{ $storyTitle }}</h3>
          <p>{{ $storyDesc }}</p>
        </div>
      </div>
    </section>

    <section class="section-wrap">
      <div class="container-xl about-split">
        <div class="about-image">
          <img src="https://images.unsplash.com/photo-1517466787929-bc90951d0974?auto=format&fit=crop&w=1100&q=85" alt="Athletes celebrating together after a match">
        </div>
        <div class="about-copy">
          <div class="section-kicker">Where it began</div>
          <h2>Every finish line has a <em>story.</em></h2>
          <p>PhotoX started with one belief: the best moments should not disappear into a camera roll. We built a home where a runner can find their finish, a parent can keep a season, and a club can celebrate its people.</p>
          <div class="about-points">
            <div class="about-point"><i class="bi bi-check-circle-fill"></i><span>Beautiful galleries for real communities</span></div>
            <div class="about-point"><i class="bi bi-check-circle-fill"></i><span>Simple discovery for every kind of viewer</span></div>
            <div class="about-point"><i class="bi bi-check-circle-fill"></i><span>Secure access that keeps memories close</span></div>
          </div>
        </div>
      </div>
    </section>

    <section class="section-wrap" style="background: rgba(232,240,255,.75);">
      <div class="container-xl about-split reverse">
        <div class="about-image">
          <img src="https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=1100&q=85" alt="Rugby player captured in a powerful match moment">
        </div>
        <div class="about-copy">
          <div class="section-kicker">What we believe</div>
          <h2>Premium tools, <em>human feeling.</em></h2>
          <p>Technology should make a memory easier to reach, never make it feel distant. Every PhotoX decision is shaped around the people behind the image: the photographer, the athlete, the family and the community.</p>
          <div class="impact-strip">
            <div><strong>480+</strong><span>Photographers</span></div>
            <div><strong>3.2M</strong><span>Photos archived</span></div>
            <div><strong>98%</strong><span>Happy customers</span></div>
          </div>
        </div>
      </div>
    </section>

    <section class="section-wrap">
      <div class="container-xl about-split">
        <div class="about-image">
          <img src="https://images.unsplash.com/photo-1541625602330-2277a4c46182?auto=format&fit=crop&w=1100&q=85" alt="Cyclist racing through a scenic course">
        </div>
        <div class="about-copy">
          <div class="section-kicker">For the people behind the lens</div>
          <h2>More room for the <em>creative work.</em></h2>
          <p>Photographers come to PhotoX to spend less time wrestling with delivery and more time making images that matter. We give creators a polished storefront, flexible event tools and a place for their work to be discovered.</p>
          <div class="hero-actions">
            <a class="btn btn-dark rounded-pill px-4" href="{{ url('/photographers') }}">Meet our photographers</a>
            <a class="inline-link" href="{{ url('/contact') }}">Partner with us <i class="bi bi-arrow-up-right"></i></a>
          </div>
        </div>
      </div>
    </section>

    <section class="section-wrap" style="background: rgba(232,240,255,.75); padding-top:0;">
      <div class="container-xl">
        <div class="section-header">
          <div>
            <div class="section-kicker">Our journey</div>
            <h2 class="section-title">How PhotoX grew</h2>
          </div>
        </div>
        <div class="timeline">
          <div class="timeline-box">
            <div class="year">2019</div>
            <h4>Started with one idea</h4>
            <p>We set out to make sports galleries easier to view and buy.</p>
          </div>
          <div class="timeline-box">
            <div class="year">2021</div>
            <h4>Schools joined in</h4>
            <p>Community events and school fixtures became a major part of our network.</p>
          </div>
          <div class="timeline-box">
            <div class="year">2023</div>
            <h4>Scaled across regions</h4>
            <p>We expanded across sporting communities and event publishers.</p>
          </div>
          <div class="timeline-box">
            <div class="year">2026</div>
            <h4>Built for premium experiences</h4>
            <p>Today we focus on elegant discovery, trust and memorable digital access.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="section-wrap">
      <div class="container-xl about-split reverse">
        <div class="about-image">
          <img src="https://images.unsplash.com/photo-1521412644187-c49fa049e84d?auto=format&fit=crop&w=1100&q=85" alt="Supporters sharing an unforgettable stadium moment">
        </div>
        <div class="about-copy">
          <div class="section-kicker">The bigger picture</div>
          <h2>Made for <em>shared memories.</em></h2>
          <p>A great gallery does more than sell a photograph. It gives a school a visual history, gives a sponsor a real connection, and gives a family one more reason to tell the story again.</p>
          <div class="about-points">
            <div class="about-point"><i class="bi bi-heart-fill"></i><span>Helping communities feel seen</span></div>
            <div class="about-point"><i class="bi bi-globe2"></i><span>Connecting local moments to a wider audience</span></div>
            <div class="about-point"><i class="bi bi-stars"></i><span>Keeping the feeling alive long after the event</span></div>
          </div>
        </div>
      </div>
    </section>

    <section class="section-wrap" style="padding-top:0;">
      <div class="container-xl">
        <div class="cta-panel">
          <div>
            <div class="section-kicker" style="color:#dfeafe;">Join the network</div>
            <h3>Start building the stories behind the action.</h3>
            <p>Photographers, clubs and sponsors use PhotoX to publish galleries with more clarity and better reach.</p>
          </div>
          <a class="btn btn-lime rounded-pill px-4" href="{{ route('signup') }}">Join PhotoX</a>
        </div>
      </div>
    </section>
    @include('web.partials.site-ad-banner')
  </main>
@endsection
