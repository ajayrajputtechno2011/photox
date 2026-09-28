@extends('web.layouts.app')

@section('title', 'PhotoX | Membership Plans')
@section('body-class', 'page-membership')

@section('content')
  <main>
    <section class="membership-page-hero">
      @include('web.partials.hero-ad-carousel')

      @php
        $hero = $pageHeroes['membership'] ?? null;
      @endphp
      <div class="container-xl">
        <div class="section-kicker"><span class="live-dot"></span>{{ $hero->kicker ?? 'Membership plans' }}</div>
        <h1>{!! $hero->title ?? 'Pick a plan that grows with your work.' !!}</h1>
        <p>{{ $hero->description ?? 'PhotoX buyer accounts are free. These creator plans are for photographers and studios who want to showcase, sell and scale with confidence.' }}</p>
        <div class="hero-actions">
          <a class="btn btn-lime rounded-pill px-4" href="{{ $hero->primary_button_url ?? '#plans' }}">{{ $hero->primary_button_text ?? 'Compare plans' }}</a>
          <a class="btn btn-outline-light rounded-pill px-4" href="{{ $hero->secondary_button_url ?? '/signup' }}">{{ $hero->secondary_button_text ?? 'Create a free account' }}</a>
        </div>
      </div>
    </section>

    <section class="content-section" id="plans">
      <div class="container-xl">
        <div class="membership-billing" role="group" aria-label="Billing period">
          <button class="billing-option active" data-billing="monthly" type="button">Monthly</button>
          <button class="billing-option" data-billing="yearly" type="button">Yearly</button>
          <span class="billing-save">Save 17%</span>
        </div>

        <div class="pricing-grid reference-pricing-grid">
          @forelse($plans as $plan)
            <article class="pricing-card {{ $plan->theme_style === 'featured' ? 'pricing-card-featured' : ($plan->theme_style === 'custom' ? 'pricing-card-custom' : 'pricing-card-light') }} reference-pricing-card" data-plan="{{ $plan->slug }}">
              <div class="pricing-badge-row">
                <span class="pricing-badge">{{ $plan->badge ?: $plan->name }}</span>
              </div>
              <p class="pricing-card-intro">{{ $plan->tagline }}</p>
              
              <div class="price-line">
                @if($plan->monthly_price !== null && $plan->monthly_price > 0)
                  <strong data-price 
                    data-monthly="{{ $plan->currency }} {{ number_format($plan->monthly_price, 0) }}" 
                    data-yearly="{{ $plan->currency }} {{ number_format($plan->yearly_price ?? ($plan->monthly_price * 10), 0) }}">
                    {{ $plan->currency }} {{ number_format($plan->monthly_price, 0) }}
                  </strong>
                  <span data-period>/ month</span>
                @elseif($plan->monthly_price === 0.00 || $plan->monthly_price === '0.00' || $plan->monthly_price === 0 || $plan->price_display === 'forever')
                  <strong data-price>{{ $plan->currency }} 0</strong>
                  <span data-period>{{ $plan->price_display ?: 'forever' }}</span>
                @else
                  <strong data-price>{{ $plan->name === 'Custom' ? 'Custom' : 'Contact' }}</strong>
                  <span data-period>{{ $plan->price_display ?: 'quote' }}</span>
                @endif
              </div>

              <div class="pricing-stats">
                <span>
                  <small>COMMISSION</small>
                  <strong>{{ $plan->commission_rate }}</strong>
                </span>
                <span>
                  <small>STORAGE</small>
                  <strong>{{ $plan->storage_limit }}</strong>
                </span>
              </div>

              <p class="pricing-list-label">{{ $plan->features_included_title ?: ('INCLUDED IN ' . strtoupper($plan->name) . ':') }}</p>
              <ul>
                @foreach($plan->features ?? [] as $feature)
                  <li>
                    @if(str_contains(strtolower($feature), 'support'))
                      <i class="bi bi-headset"></i>
                    @else
                      <i class="bi bi-check2"></i>
                    @endif
                    {{ $feature }}
                  </li>
                @endforeach
              </ul>

              <a class="btn pricing-cta" href="{{ $plan->button_url ?: '/signup' }}">
                {{ $plan->button_text ?: 'Choose Plan' }} <i class="bi bi-arrow-right"></i>
              </a>
            </article>
          @empty
            <div class="col-12 text-center py-5 text-muted">
              <i class="bi bi-person-vcard fs-1 d-block mb-3"></i>
              <h4>No membership plans currently available.</h4>
              <p>Please check back soon or contact support for customized packages.</p>
            </div>
          @endforelse
        </div>
      </div>
    </section>

    <aside class="site-ad-banner" aria-label="Sponsored placement">
      <a class="site-ad-link" href="/events">
        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&h=360&q=88" alt="Adventure vehicle on an open road">
        <span class="site-ad-overlay"></span>
        <span class="site-ad-copy">
          <small>PHOTOX PARTNER</small>
          <strong>BUILT FOR MORE<br>THAN ROADS</strong>
          <span>Explore events <i class="bi bi-arrow-up-right"></i></span>
        </span>
      </a>
    </aside>
  </main>
@endsection

@section('scripts')
  <script>
    (() => {
      const billingOptions = document.querySelectorAll('.billing-option');
      const priceElements = document.querySelectorAll('[data-price][data-monthly]');
      const periodElements = document.querySelectorAll('[data-period]');

      function setBillingPeriod(period) {
        billingOptions.forEach((option) => option.classList.toggle('active', option.dataset.billing === period));
        priceElements.forEach((price) => {
          price.textContent = price.dataset[period];
        });
        periodElements.forEach((label) => {
          if (label.closest('[data-plan="starter"]') || label.closest('[data-plan="custom"]')) return;
          label.textContent = period === 'yearly' ? '/ year' : '/ month';
        });
      }

      billingOptions.forEach((option) => {
        option.addEventListener('click', () => {
          setBillingPeriod(option.dataset.billing);
        });
      });
    })();
  </script>
@endsection
