<div class="hero-banner-frame">
  @php
    $firstBanner = (isset($heroBanners) && $heroBanners->isNotEmpty()) ? $heroBanners->first() : ((isset($banners) && $banners->isNotEmpty()) ? $banners->first() : null);
    $initialBadge = !empty($firstBanner->badge_text) ? $firstBanner->badge_text : 'OFFICIAL SPONSOR';
    $initialSubtitle = !empty($firstBanner->subtitle) ? $firstBanner->subtitle : 'Featured Partner';
  @endphp
  <div class="hero-banner-frame-header" id="heroBannerFrameHeader">
    <span class="frame-label" id="heroBannerFrameLabel"><span class="frame-dot"></span> {{ $initialSubtitle }}</span>
    <span class="badge bg-secondary bg-opacity-50 text-white font-monospace" id="heroBannerBadge" style="font-size: 0.65rem;">{{ $initialBadge }}</span>
  </div>
  @include('web.partials.hero-ad-carousel')
</div>
