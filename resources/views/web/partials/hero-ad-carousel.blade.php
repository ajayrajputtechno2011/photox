<aside class="hero-ad-carousel" aria-label="Sponsored placements">
  @php
    $displayBanners = (isset($heroBanners) && $heroBanners->isNotEmpty()) ? $heroBanners : ((isset($banners) && $banners->isNotEmpty()) ? $banners : collect());
  @endphp
  @if($displayBanners->isNotEmpty())
    @foreach($displayBanners as $index => $banner)
      @php
        $hasText = !empty(trim($banner->title ?? '')) || !empty(trim($banner->subtitle ?? ''));
        $badge = !empty(trim($banner->badge_text ?? '')) ? $banner->badge_text : 'OFFICIAL SPONSOR';
        $sub = !empty(trim($banner->subtitle ?? '')) ? $banner->subtitle : 'Featured Partner';
      @endphp
      <div class="hero-ad-slide {{ $loop->first ? 'active' : '' }} {{ $hasText ? 'has-copy' : 'clean-banner' }}" data-badge="{{ $badge }}" data-subtitle="{{ $sub }}" data-interval="{{ $banner->rotation_interval ?? 5 }}">
        <a href="{{ $banner->link_url ?: '#' }}" class="d-block w-100 h-100 text-decoration-none" style="color: inherit;">
          <img src="{{ $banner->image_url }}" alt="{{ $banner->title ?: 'Sponsored Banner' }}" class="hero-ad-img">
          @if($hasText)
            <span class="hero-ad-slide-copy">
              @if(!empty(trim($banner->title ?? '')))
                <strong>{!! nl2br(e($banner->title)) !!}</strong>
              @endif
              @if(!empty(trim($banner->subtitle ?? '')))
                <small>{{ $banner->subtitle }}</small>
              @endif
            </span>
          @endif
        </a>
      </div>
    @endforeach
    @if($displayBanners->count() > 1)
      <div class="hero-ad-controls">
        <button data-ad-prev type="button" aria-label="Previous ad"><i class="bi bi-chevron-left"></i></button>
        <div class="hero-ad-dots">
          @foreach($displayBanners as $index => $banner)
            <button class="{{ $loop->first ? 'active' : '' }}" data-ad-slide="{{ $index }}" type="button" aria-label="Ad {{ $index + 1 }}"></button>
          @endforeach
        </div>
        <button data-ad-next type="button" aria-label="Next ad"><i class="bi bi-chevron-right"></i></button>
      </div>
    @endif
  @else
    <div class="hero-ad-slide active has-copy" data-interval="5">
      <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=700&h=1200&q=88" alt="Adventure vehicle on an open road" class="hero-ad-img">
      <span class="hero-ad-slide-copy"><strong>BUILT FOR MORE<br>THAN ROADS</strong><small>Explore the range</small></span>
    </div>
  @endif
</aside>
