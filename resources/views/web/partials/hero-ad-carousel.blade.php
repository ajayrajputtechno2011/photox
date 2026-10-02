<aside class="hero-ad-carousel" aria-label="Sponsored placements">
  @if(isset($heroBanners) && $heroBanners->isNotEmpty())
    @foreach($heroBanners as $index => $banner)
      @php
        $hasText = !empty(trim($banner->title ?? '')) || !empty(trim($banner->subtitle ?? ''));
      @endphp
      <div class="hero-ad-slide {{ $loop->first ? 'active' : '' }} {{ $hasText ? 'has-copy' : 'clean-banner' }}">
        <a href="{{ $banner->link_url ?: '#' }}" class="d-block w-100 h-100 text-decoration-none" style="color: inherit;">
          <img src="{{ $banner->image_url }}" alt="{{ $banner->title ?: 'Sponsored Banner' }}" style="width: 100%; height: 100%; object-fit: cover;">
          @if(!empty($banner->badge_text))
            <span class="hero-ad-badge-tag">{{ $banner->badge_text }}</span>
          @endif
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
  @else
    <div class="hero-ad-slide active has-copy">
      <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=700&h=1200&q=88" alt="Adventure vehicle on an open road" style="width: 100%; height: 100%; object-fit: cover;">
      <span class="hero-ad-badge-tag">BANNER ADS</span>
      <span class="hero-ad-slide-copy"><strong>BUILT FOR MORE<br>THAN ROADS</strong><small>Explore the range</small></span>
    </div>
  @endif
</aside>
