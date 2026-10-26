@php
  $pagePartnerAds = \App\Models\Banner::where('is_active', true)
      ->whereIn('placement', ['home_before_featured', 'event_detail', 'marketplace', 'image_preview'])
      ->orderBy('sort_order')
      ->get();

  if ($pagePartnerAds->isEmpty()) {
      $fallback = \App\Models\Banner::where('is_active', true)->where('placement', '!=', 'events_hero')->get();
      if ($fallback->isNotEmpty()) {
          $pagePartnerAds = $fallback;
      }
  }
@endphp

@if($pagePartnerAds->isNotEmpty())
  @php $uniqueAdId = 'siteAdCarousel_' . uniqid(); @endphp
  <div class="container-xl my-4">
    <aside class="site-ad-banner" id="{{ $uniqueAdId }}" aria-label="Sponsored placement" style="height: auto !important; max-height: 200px !important; min-height: unset !important; overflow: hidden; border-radius: 15px; background: #07152b; position: relative;">
      @foreach($pagePartnerAds as $idx => $ad)
        @php
          $pageAdHref = (!empty($ad->link_url) && $ad->link_url !== '/events') ? $ad->link_url : '/#latest-events';
          $adInterval = ($ad->rotation_interval && $ad->rotation_interval > 0) ? ($ad->rotation_interval * 1000) : 5000;
        @endphp
        <div class="site-partner-slide {{ $loop->first ? 'active' : '' }}" data-interval="{{ $adInterval }}" style="{{ $loop->first ? 'display: block;' : 'display: none;' }}">
          <a class="site-ad-link" href="{{ $pageAdHref }}" target="_blank" style="height: auto !important; max-height: 200px !important; display: block; line-height: 0; position: relative;">
            <img src="{{ $ad->image_url }}" alt="{{ $ad->title ?: 'Sponsored Partner' }}" style="width: 100%; height: 200px; max-height: 200px; display: block; object-fit: cover; object-position: center; position: relative; background: #07152b;">
          </a>
        </div>
      @endforeach
    </aside>
  </div>

  @if($pagePartnerAds->count() > 1)
    <script>
      (function() {
        const wrap = document.getElementById('{{ $uniqueAdId }}');
        if (!wrap) return;
        const slides = wrap.querySelectorAll('.site-partner-slide');
        if (slides.length <= 1) return;
        let activeIdx = 0;
        let slideTimer = null;

        function nextSlide() {
          if (slideTimer) clearTimeout(slideTimer);
          const current = slides[activeIdx];
          const interval = parseInt(current?.getAttribute('data-interval')) || 5000;

          slideTimer = setTimeout(function() {
            slides[activeIdx].style.display = 'none';
            slides[activeIdx].classList.remove('active');
            activeIdx = (activeIdx + 1) % slides.length;
            slides[activeIdx].style.display = 'block';
            slides[activeIdx].classList.add('active');
            nextSlide();
          }, interval);
        }
        nextSlide();
      })();
    </script>
  @endif
@endif
