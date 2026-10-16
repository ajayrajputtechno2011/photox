@extends('web.layouts.app')

@section('title', 'PhotoX | Customer Dashboard')
@section('body-class', 'customer-app dashboard-page customer-portal-view')

@section('styles')
<style>
  .customer-stat-card {
    background: #ffffff;
    border: 1px solid rgba(11, 45, 91, 0.08);
    border-radius: 16px;
    padding: 1.4rem 1.25rem;
    box-shadow: 0 4px 16px rgba(11, 45, 91, 0.03);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .customer-stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(11, 45, 91, 0.08);
  }
  .customer-stat-icon {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.35rem;
    margin-bottom: 0.75rem;
  }
</style>
@endsection

@section('content')
  <main class="workspace-layout container-xl py-4">
    <!-- Customer Dedicated Sidebar -->
    @include('web.partials.customer-sidebar', ['activeTab' => 'overview'])

    <!-- Customer Dashboard Content -->
    <section class="workspace-content">
      @include('web.partials.popia-verification-banner')

      <div class="workspace-view-header d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 pb-3 border-bottom">
        <div>
          <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1 mb-2 fw-semibold">
            <i class="bi bi-person-fill me-1"></i> CUSTOMER PORTAL
          </span>
          <h2 class="fw-bold mb-1">Hello, {{ $user->name }} 👋</h2>
          <p class="text-muted mb-0">Manage your saved photos, digital orders, and unwatermarked downloads.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
          <a class="btn btn-outline-primary rounded-pill px-3 py-2" href="{{ route('customer.my_photos') }}">
            <i class="bi bi-heart me-1 text-danger"></i> Saved Photos
          </a>
          <a class="btn btn-lime rounded-pill px-4 py-2 fw-semibold" href="{{ url('/#find') }}">
            <i class="bi bi-search me-1"></i> Find Photos
          </a>
        </div>
      </div>

      <!-- Customer Metric Cards (Distinct 4-Grid) -->
      <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
          <div class="customer-stat-card">
            <div class="customer-stat-icon bg-danger-subtle text-danger">
              <i class="bi bi-heart-fill"></i>
            </div>
            <span class="text-muted d-block small fw-medium">Saved Photos</span>
            <strong class="fs-3 fw-bold text-dark" id="statCardSavedCount">{{ $savedCount }}</strong>
          </div>
        </div>
        <div class="col-6 col-lg-3">
          <div class="customer-stat-card">
            <div class="customer-stat-icon bg-warning-subtle text-warning">
              <i class="bi bi-calendar-check-fill"></i>
            </div>
            <span class="text-muted d-block small fw-medium">Events Followed</span>
            <strong class="fs-3 fw-bold text-dark" id="statCardEventsCount">{{ sprintf('%02d', $eventsFollowedCount ?? 0) }}</strong>
          </div>
        </div>
        <div class="col-6 col-lg-3">
          <div class="customer-stat-card">
            <div class="customer-stat-icon bg-success-subtle text-success">
              <i class="bi bi-bag-check-fill"></i>
            </div>
            <span class="text-muted d-block small fw-medium">Orders Placed</span>
            <strong class="fs-3 fw-bold text-dark">{{ $ordersCount }}</strong>
          </div>
        </div>
        <div class="col-6 col-lg-3">
          <div class="customer-stat-card border-primary" style="background: linear-gradient(135deg, #0b2d5b, #154580); color: #fff;">
            <div class="customer-stat-icon" style="background: rgba(201, 253, 2, 0.2); color: #c9fd02;">
              <i class="bi bi-cloud-arrow-down-fill"></i>
            </div>
            <span class="d-block small text-white-50 fw-medium">Ready to Download</span>
            <strong class="fs-3 fw-bold text-white">{{ $downloadsReady }}</strong>
          </div>
        </div>
      </div>

      <!-- Digital Downloads Banner Callout -->
      <div class="p-4 rounded-4 mb-4 text-white d-flex flex-wrap justify-content-between align-items-center gap-3 shadow-sm" style="background: linear-gradient(135deg, #0b2d5b, #133a6b);">
        <div class="d-flex align-items-center gap-3">
          <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background: rgba(201, 253, 2, 0.15); width: 56px; height: 56px;">
            <i class="bi bi-cloud-check-fill fs-2" style="color: #c9fd02;"></i>
          </div>
          <div>
            <h5 class="fw-bold mb-1">Your Digital High-Res Photos are Ready</h5>
            <p class="mb-0 small text-white-50">You have original, unwatermarked photo downloads waiting in your vault.</p>
          </div>
        </div>
        <a class="btn btn-lime rounded-pill px-4 py-2 fw-semibold" href="{{ route('orders.downloads') }}">
          <i class="bi bi-download me-1"></i> Open Downloads Vault
        </a>
      </div>

      <!-- Recently Saved Photos Section -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <span class="text-primary fw-semibold small text-uppercase" style="letter-spacing: 0.5px;">RECENTLY SAVED</span>
          <h4 class="fw-bold mb-0">Your Favourites &amp; Highlights</h4>
        </div>
        <a class="text-decoration-none fw-semibold small text-primary" href="{{ route('customer.my_photos') }}">
          View all photos <i class="bi bi-arrow-up-right"></i>
        </a>
      </div>

      <div class="saved-photo-grid mb-5">
        <div class="saved-photo-gallery">
          @php
            $displayPhotos = $savedPhotos->isNotEmpty() ? $savedPhotos : ($samplePhotos ?? collect());
            $isShowingSample = $savedPhotos->isEmpty() && $displayPhotos->isNotEmpty();
          @endphp

          @if($isShowingSample)
            <div class="col-12 mb-2 p-2 bg-info-subtle border border-info-subtle rounded-3 small text-primary d-flex align-items-center gap-2">
              <i class="bi bi-info-circle-fill fs-5"></i>
              <span><strong>Sample Showcase:</strong> Click the <i class="bi bi-heart text-danger mx-1"></i> heart icon on any photo to add it to your personal Saved Photos!</span>
            </div>
          @endif

          @forelse($displayPhotos as $photo)
            @php
              $isSaved = $user->savedPhotos()->where('event_photos.id', $photo->id)->exists();
              $isPurchased = $user ? $user->orderItems()->whereHas('order', fn ($q) => $q->where('payment_status', 'completed'))->where('event_photo_id', $photo->id)->exists() : false;
            @endphp
            <article class="saved-photo-card {{ $loop->first ? 'featured' : '' }}" id="photo-card-{{ $photo->id }}">
              <img src="/protected-photo/{{ $photo->id }}" alt="{{ $photo->title }}">
              <div>
                <span>{{ strtoupper($photo->event?->category_name ?: 'SPORTS') }}</span>
                <strong>{{ $photo->title ?: 'Action Shot' }}</strong>
                <small>{{ $photo->event?->title }}</small>
                @if(!$isPurchased)
                  <div class="mt-2">
                    <a href="{{ route('events.show', $photo->event?->slug ?: $photo->event_id) }}" class="btn btn-sm btn-warning text-dark fw-bold rounded-pill px-3 py-1 shadow-sm" style="font-size: 0.75rem;">
                      <i class="bi bi-cart-plus me-1"></i>Buy Clean Copy (R{{ number_format($photo->personal_price ?: 75, 0) }})
                    </a>
                  </div>
                @endif
              </div>
              <button onclick="togglePhotoSave({{ $photo->id }}, this)" class="btn btn-sm {{ $isSaved ? 'btn-danger' : 'btn-light' }} position-absolute top-0 start-0 m-2 rounded-circle shadow" title="{{ $isSaved ? 'Saved to wishlist' : 'Click to save' }}">
                <i class="bi {{ $isSaved ? 'bi-heart-fill' : 'bi-heart text-danger' }}"></i>
              </button>
              @if($isPurchased)
                <a href="{{ $photo->file_path }}" download="PhotoX_{{ $photo->id }}.jpg" target="_blank" class="btn btn-sm btn-success position-absolute top-0 end-0 m-2 rounded-circle shadow" title="Download Clean Copy">
                  <i class="bi bi-download"></i>
                </a>
              @else
                <span class="badge bg-dark bg-opacity-75 text-warning position-absolute top-0 end-0 m-2 px-2 py-1 rounded-pill small font-monospace shadow-sm" title="Watermarked Preview - Buy to unlock clean full-resolution download">
                  <i class="bi bi-shield-lock-fill me-1"></i>Protected
                </span>
              @endif
            </article>
          @empty
            <div class="p-4 bg-white rounded-3 border text-center w-100">
              <i class="bi bi-images fs-1 text-muted d-block mb-2"></i>
              <p class="text-muted mb-2">You haven't saved any event photos yet.</p>
              <a href="{{ url('/#find') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Find My Photos</a>
            </div>
          @endforelse
        </div>
      </div>

      <!-- Upcoming & Followed Events List -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <span class="text-primary fw-semibold small text-uppercase" style="letter-spacing: 0.5px;">{{ $savedEvents->isNotEmpty() ? 'YOUR WATCHLIST' : 'UPCOMING &amp; RECENT' }}</span>
          <h4 class="fw-bold mb-0">{{ $savedEvents->isNotEmpty() ? 'Events You Are Following' : 'Events You May Want to See' }}</h4>
        </div>
        <a class="text-decoration-none fw-semibold small text-primary" href="{{ route('customer.saved_events') }}">
          See all events <i class="bi bi-arrow-up-right"></i>
        </a>
      </div>

      <div class="mini-event-list">
        @php
          $eventListToDisplay = $savedEvents->isNotEmpty() ? $savedEvents : $recentEvents;
        @endphp
        @forelse($eventListToDisplay as $evt)
          @php
            $isFollowed = $user->savedEvents()->where('events.id', $evt->id)->exists();
          @endphp
          <article class="p-3 bg-white rounded-3 border shadow-sm d-flex align-items-center justify-content-between mb-2">
            <div class="d-flex align-items-center gap-3">
              <div class="mini-event-date text-center bg-light rounded-3 p-2" style="min-width: 50px;">
                <strong class="d-block text-primary fs-5 leading-none">{{ $evt->event_date?->format('d') ?? '15' }}</strong>
                <span class="text-muted small text-uppercase fw-semibold">{{ strtoupper($evt->event_date?->format('M') ?? 'OCT') }}</span>
              </div>
              <div>
                <strong class="d-block text-dark">{{ $evt->title }}</strong>
                <small class="text-muted">{{ $evt->category_name ?: 'Sports' }} &bull; {{ $evt->location ?: 'South Africa' }}</small>
              </div>
            </div>
            <div class="d-flex align-items-center gap-2">
              <button onclick="toggleEventFollow({{ $evt->id }}, this)" class="btn btn-sm {{ $isFollowed ? 'btn-warning text-dark' : 'btn-outline-warning' }} rounded-pill px-3" title="Toggle Follow">
                <i class="bi {{ $isFollowed ? 'bi-bookmark-check-fill' : 'bi-bookmark-plus' }} me-1"></i>
                <span class="btn-text">{{ $isFollowed ? 'Following' : 'Follow' }}</span>
              </button>
              <a href="{{ route('events.show', $evt->slug ?: $evt->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                View Photos
              </a>
            </div>
          </article>
        @empty
          <p class="text-muted p-3 bg-white rounded-3 border">No events in your watchlist yet.</p>
        @endforelse
      </div>
    </section>
  </main>

  <script>
    function togglePhotoSave(photoId, btn) {
      const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
      fetch('/api/photos/' + photoId + '/toggle-save', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrf,
          'Accept': 'application/json'
        }
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          const icon = btn.querySelector('i');
          if (data.saved) {
            btn.classList.remove('btn-light');
            btn.classList.add('btn-danger');
            if (icon) icon.className = 'bi bi-heart-fill';
          } else {
            btn.classList.remove('btn-danger');
            btn.classList.add('btn-light');
            if (icon) icon.className = 'bi bi-heart text-danger';
          }
          // Update sidebar counter
          const sidebarBadge = document.querySelector('.customer-sidebar-link[href*="my-photos"] .customer-sidebar-count');
          if (sidebarBadge) sidebarBadge.innerText = data.count;
          const statBadge = document.getElementById('statCardSavedCount');
          if (statBadge) statBadge.innerText = data.count;
        }
      })
      .catch(err => console.error(err));
    }

    function toggleEventFollow(eventId, btn) {
      const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
      fetch('/api/events/' + eventId + '/toggle-save', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrf,
          'Accept': 'application/json'
        }
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          const icon = btn.querySelector('i');
          const textSpan = btn.querySelector('.btn-text');
          if (data.saved) {
            btn.classList.remove('btn-outline-warning');
            btn.classList.add('btn-warning', 'text-dark');
            if (icon) icon.className = 'bi bi-bookmark-check-fill me-1';
            if (textSpan) textSpan.innerText = 'Following';
          } else {
            btn.classList.remove('btn-warning', 'text-dark');
            btn.classList.add('btn-outline-warning');
            if (icon) icon.className = 'bi bi-bookmark-plus me-1';
            if (textSpan) textSpan.innerText = 'Follow';
          }
          // Update sidebar counter
          const sidebarBadge = document.querySelector('.customer-sidebar-link[href*="saved-events"] .customer-sidebar-count');
          if (sidebarBadge) sidebarBadge.innerText = data.count;
          const statBadge = document.getElementById('statCardEventsCount');
          if (statBadge) statBadge.innerText = String(data.count).padStart(2, '0');
        }
      })
      .catch(err => console.error(err));
    }
  </script>
@endsection