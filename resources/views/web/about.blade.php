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

    {{-- FAQ ACCORDION SECTION (Client Feedback Task 6) --}}
    <section class="section-wrap" id="faqs" style="background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%); padding: 5.5rem 0;">
      <div class="container-xl" style="max-width: 960px;">
        <div class="text-center mb-5">
          <div class="section-kicker" style="color: #ff8a00; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase;">Got Questions?</div>
          <h2 class="section-title" style="font-size: 2.5rem; font-weight: 800; color: #0b2d5b; margin-top: 0.5rem;">Frequently Asked <em style="font-style: normal; color: #ff8a00;">Questions</em></h2>
          <p class="text-muted" style="max-width: 650px; margin: 0.75rem auto 0; font-size: 1.05rem;">
            Everything you need to know about purchasing event photos, finding yourself with AI Selfie Search, digital licenses, and photographer storefronts.
          </p>
        </div>

        @if(isset($faqs) && $faqs->isNotEmpty())
          <div class="accordion custom-faq-accordion" id="aboutFaqAccordion">
            @foreach($faqs as $index => $faq)
              @php
                $catBadge = match($faq->category) {
                  'general' => 'General',
                  'selfie_bundles' => 'Selfie Bundle',
                  'licenses' => 'Digital Licenses',
                  'orders' => 'Orders &amp; Downloads',
                  'photographers' => 'Photographers',
                  default => ucfirst(str_replace('_', ' ', $faq->category))
                };
              @endphp
              <div class="accordion-item mb-3 border-0 shadow-sm" style="border-radius: 14px; overflow: hidden; background: #ffffff;">
                <h3 class="accordion-header" id="headingFaq{{ $faq->id }}">
                  <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }} fw-bold p-4 text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaq{{ $faq->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapseFaq{{ $faq->id }}" style="font-size: 1.05rem; background: transparent; box-shadow: none;">
                    <span class="d-flex align-items-center gap-2 flex-wrap text-start">
                      <span class="badge rounded-pill bg-warning bg-opacity-10 text-warning px-2 py-1 small fw-bold" style="font-size: 0.75rem; letter-spacing: 0.05em;">{!! $catBadge !!}</span>
                      <span>{{ $faq->question }}</span>
                    </span>
                  </button>
                </h3>
                <div id="collapseFaq{{ $faq->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="headingFaq{{ $faq->id }}" data-bs-parent="#aboutFaqAccordion">
                  <div class="accordion-body px-4 pb-4 pt-0 text-muted" style="line-height: 1.7; font-size: 0.98rem; border-top: 1px solid rgba(0,0,0,0.04); padding-top: 1rem !important;">
                    {!! nl2br(e($faq->answer)) !!}
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @else
          {{-- Fallback default FAQs if DB table is unpopulated --}}
          <div class="accordion custom-faq-accordion" id="aboutFaqAccordionFallback">
            <div class="accordion-item mb-3 border-0 shadow-sm" style="border-radius: 14px; overflow: hidden; background: #ffffff;">
              <h3 class="accordion-header" id="headingFaqFallback1">
                <button class="accordion-button fw-bold p-4 text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaqFallback1" aria-expanded="true" style="font-size: 1.05rem; background: transparent; box-shadow: none;">
                  <span class="d-flex align-items-center gap-2 flex-wrap text-start">
                    <span class="badge rounded-pill bg-warning bg-opacity-10 text-warning px-2 py-1 small fw-bold" style="font-size: 0.75rem;">Selfie Bundle</span>
                    <span>How does the Selfie / Athlete Bundle work?</span>
                  </span>
                </button>
              </h3>
              <div id="collapseFaqFallback1" class="accordion-collapse collapse show" data-bs-parent="#aboutFaqAccordionFallback">
                <div class="accordion-body px-4 pb-4 pt-0 text-muted" style="line-height: 1.7; font-size: 0.98rem; border-top: 1px solid rgba(0,0,0,0.04); padding-top: 1rem !important;">
                  Upload a selfie or enter your bib number. Our biometric facial recognition and bib detection AI instantly matches every photo where you appear across the entire event gallery. You can then download all your matched photos together as a single discounted bundle under a Personal Digital License.
                </div>
              </div>
            </div>

            <div class="accordion-item mb-3 border-0 shadow-sm" style="border-radius: 14px; overflow: hidden; background: #ffffff;">
              <h3 class="accordion-header" id="headingFaqFallback2">
                <button class="accordion-button collapsed fw-bold p-4 text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaqFallback2" aria-expanded="false" style="font-size: 1.05rem; background: transparent; box-shadow: none;">
                  <span class="d-flex align-items-center gap-2 flex-wrap text-start">
                    <span class="badge rounded-pill bg-warning bg-opacity-10 text-warning px-2 py-1 small fw-bold" style="font-size: 0.75rem;">Licenses</span>
                    <span>What is the difference between Personal and Commercial licenses?</span>
                  </span>
                </button>
              </h3>
              <div id="collapseFaqFallback2" class="accordion-collapse collapse" data-bs-parent="#aboutFaqAccordionFallback">
                <div class="accordion-body px-4 pb-4 pt-0 text-muted" style="line-height: 1.7; font-size: 0.98rem; border-top: 1px solid rgba(0,0,0,0.04); padding-top: 1rem !important;">
                  A <strong>Personal License</strong> covers personal social media, personal prints, and family keepsakes. A <strong>Commercial License</strong> is required for marketing, brand sponsorships, commercial websites, advertising campaigns, and editorial media. Note: Selfie / Athlete bundles are strictly for Personal License only; commercial licenses must be purchased individually.
                </div>
              </div>
            </div>

            <div class="accordion-item mb-3 border-0 shadow-sm" style="border-radius: 14px; overflow: hidden; background: #ffffff;">
              <h3 class="accordion-header" id="headingFaqFallback3">
                <button class="accordion-button collapsed fw-bold p-4 text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaqFallback3" aria-expanded="false" style="font-size: 1.05rem; background: transparent; box-shadow: none;">
                  <span class="d-flex align-items-center gap-2 flex-wrap text-start">
                    <span class="badge rounded-pill bg-warning bg-opacity-10 text-warning px-2 py-1 small fw-bold" style="font-size: 0.75rem;">Orders</span>
                    <span>How do I receive my purchased digital photos?</span>
                  </span>
                </button>
              </h3>
              <div id="collapseFaqFallback3" class="accordion-collapse collapse" data-bs-parent="#aboutFaqAccordionFallback">
                <div class="accordion-body px-4 pb-4 pt-0 text-muted" style="line-height: 1.7; font-size: 0.98rem; border-top: 1px solid rgba(0,0,0,0.04); padding-top: 1rem !important;">
                  Downloads are delivered instantly upon completing checkout via our secure Yoco payment gateway. You receive direct high-resolution download links on your confirmation screen, via email, and saved forever under your customer account dashboard.
                </div>
              </div>
            </div>
          </div>
        @endif
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
