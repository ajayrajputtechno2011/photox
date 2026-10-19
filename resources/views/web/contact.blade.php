@extends('web.layouts.app')

@section('title', 'PhotoX | Contact')
@section('body-class', 'page-events page-contact')

@section('content')
  <main class="contact-page-main">
    <section class="events-page-hero">
      @php
        $hero = $pageHeroes['contact'] ?? null;
      @endphp
      <div class="container-xl position-relative" style="z-index: 2;">
        <div class="row align-items-center g-4">
          <div class="col-lg-6 hero-intro-col">
            <div class="contact-badge"><i class="bi bi-chat-heart"></i> {{ $hero->kicker ?? 'Contact PhotoX' }}</div>
            <h1>{!! $hero->title ?? 'Let’s talk about<br><em>your next frame.</em>' !!}</h1>
            <p>{{ $hero->description ?? 'Questions about a gallery, a photographer membership or your next event? Our team is ready to help.' }}</p>
            <div class="hero-actions">
              <a class="btn btn-lime rounded-pill px-4" href="{{ $hero->primary_button_url ?? '#contact' }}">{{ $hero->primary_button_text ?? 'Contact Us' }}</a>
              @if(!empty($hero->secondary_button_text))
                <a class="btn btn-outline-light rounded-pill px-4" href="{{ $hero->secondary_button_url }}">{{ $hero->secondary_button_text }}</a>
              @endif
            </div>
          </div>
          <div class="col-lg-6 hero-banner-col">
            @include('web.partials.hero-partner-frame')
          </div>
        </div>
      </div>
    </section>

    <section class="contact-section" id="contact">
      <div class="container-xl contact-grid">
        <div class="contact-panel">
          <div class="panel-label">SEND A MESSAGE</div>
          <h2>Tell us what you need.</h2>
          <p class="contact-panel-intro">Share a few details and the right person will get back to you.</p>
          <form class="contact-form" action="{{ url('/contact') }}" method="get">
            <div class="contact-form-grid">
              <label><span>Your name</span><input name="name" type="text" placeholder="Your full name" required></label>
              <label><span>Email address</span><input name="email" type="email" placeholder="you@example.com" required></label>
              <label><span>I am a</span><select name="role"><option>Customer</option><option>Photographer</option><option>Event organiser</option><option>School or club</option><option>Sponsor</option></select></label>
              <label><span>Subject</span><input name="subject" type="text" placeholder="What can we help with?"></label>
              <label class="contact-form-wide"><span>Message</span><textarea name="message" placeholder="Tell us a little more..." required></textarea></label>
            </div>
            <button class="btn btn-lime rounded-pill px-4" type="submit">Send enquiry <i class="bi bi-arrow-up-right ms-2"></i></button>
          </form>
        </div>

        <aside class="contact-details" aria-label="Contact details">
          <div class="panel-label">GET IN TOUCH</div>
          <h2>We’re close by.</h2>
          <p>For quick questions, reach us through any of the channels below.</p>
          <div class="info-stack">
            <a class="info-item" href="mailto:hello@photox.co.za"><i class="bi bi-envelope"></i><span><strong>Email us</strong><small>hello@photox.co.za</small></span><i class="bi bi-arrow-up-right info-arrow"></i></a>
            <a class="info-item" href="tel:+27214567890"><i class="bi bi-telephone"></i><span><strong>Call the team</strong><small>+27 21 456 7890</small></span><i class="bi bi-arrow-up-right info-arrow"></i></a>
            <div class="info-item"><i class="bi bi-geo-alt"></i><span><strong>Head office</strong><small>42 Long Street, Cape Town</small></span></div>
            <div class="info-item"><i class="bi bi-clock-history"></i><span><strong>Support hours</strong><small>Mon–Fri · 08:00–17:00 SAST</small></span></div>
          </div>
          <div class="contact-response"><i class="bi bi-stars"></i><span><strong>Typical response time</strong><small>Within one business day.</small></span></div>
        </aside>
      </div>
    </section>

    <section class="contact-bottom-section">
      <div class="container-xl contact-bottom-card">
        <div><span class="panel-label">FOR CREATORS & EVENTS</span><h2>Ready to put your moments in motion?</h2></div>
        <a class="btn btn-lime rounded-pill px-4" href="{{ route('signup') }}">Join PhotoX <i class="bi bi-arrow-up-right ms-2"></i></a>
      </div>
    </section>
    @include('web.partials.site-ad-banner')
  </main>
@endsection
