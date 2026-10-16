@extends('web.layouts.app')

@section('title', 'PhotoX | Saved Photos')
@section('body-class', 'customer-app photos-page')

@section('content')
  <main class="workspace-layout container-xl py-4">
    @include('web.partials.customer-sidebar', ['activeTab' => 'photos'])

    <section class="workspace-content">
      <div class="workspace-view active">
        <div class="workspace-view-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
          <div>
            <span class="eyebrow-blue">SAVED PHOTOS &amp; WISHLIST</span>
            <h2 class="fs-3 fw-bold mb-1">Your collected moments</h2>
            <p class="text-muted small mb-0">Saved previews from events. Purchase photos with instant checkout to unlock full-resolution unwatermarked files.</p>
          </div>
          <a class="btn btn-lime rounded-pill px-4 flex-shrink-0" href="{{ url('/events') }}"><i class="bi bi-search me-1"></i>Explore Events</a>
        </div>

        <div class="row g-3 g-md-4 mt-1">
          @forelse($photos as $photo)
            @php
              $isPurchased = $user ? $user->orderItems()->whereHas('order', fn ($q) => $q->where('payment_status', 'completed'))->where('event_photo_id', $photo->id)->exists() : false;
            @endphp
            <div class="col-12 col-sm-6 col-lg-4" id="photo-card-{{ $photo->id }}">
              <div class="card h-100 border rounded-4 overflow-hidden shadow-sm">
                <div style="height: 220px; background: #081426; position: relative;">
                  <img src="/protected-photo/{{ $photo->id }}" alt="{{ $photo->title }}" style="width: 100%; height: 100%; object-fit: contain;">
                  @if($photo->bib_number)
                    <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2 font-monospace">BIB #{{ $photo->bib_number }}</span>
                  @endif
                  <button type="button" class="btn btn-sm btn-light rounded-circle text-danger border position-absolute top-0 end-0 m-2 shadow-sm" onclick="removeSavedPhoto({{ $photo->id }}, this)" title="Remove from wishlist">
                    <i class="bi bi-trash"></i>
                  </button>
                </div>
                <div class="card-body p-3">
                  <div class="d-flex justify-content-between align-items-start mb-1">
                    <strong class="d-block text-truncate text-dark">{{ $photo->title ?: 'Action Photo' }}</strong>
                    <span class="text-primary fw-bold font-monospace small">R{{ number_format($photo->personal_price ?: 75, 2) }}</span>
                  </div>
                  <small class="text-muted d-block mb-3">{{ $photo->event?->title ?: 'Sports Event' }}</small>
                  <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                    @if($isPurchased)
                      <span class="small font-monospace text-success"><i class="bi bi-patch-check-fill me-1"></i>Purchased &bull; Clean</span>
                      <a href="{{ $photo->file_path }}" download="PhotoX_{{ $photo->id }}.jpg" target="_blank" class="btn btn-sm btn-success rounded-pill px-3">
                        <i class="bi bi-download me-1"></i>Download
                      </a>
                    @else
                      <span class="small font-monospace text-muted"><i class="bi bi-shield-lock me-1 text-warning"></i>Protected</span>
                      <button type="button" 
                              onclick="addSavedPhotoToCart({{ $photo->id }}, {!! json_encode($photo->title ?: 'Action Photo') !!}, {{ $photo->personal_price ?: 75 }}, {!! json_encode($photo->thumbnail_url ?: $photo->file_path) !!}, {!! json_encode($photo->event?->title ?: 'Sports Event') !!})" 
                              class="btn btn-sm btn-warning text-dark fw-bold rounded-pill px-3 shadow-sm">
                        <i class="bi bi-cart-plus me-1"></i>Buy Clean Copy
                      </button>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          @empty
            <div class="col-12 text-center py-5 text-muted">
              <i class="bi bi-heart fs-1 text-secondary opacity-50 d-block mb-2"></i>
              <h5 class="fw-bold text-dark">No Photos Saved in Your Collection</h5>
              <p class="small text-muted mb-3">When browsing galleries, click the heart icon to save favorite photos to your wishlist.</p>
              <a href="{{ url('/events') }}" class="btn btn-lime rounded-pill px-4 mt-2">Browse Events</a>
            </div>
          @endforelse
        </div>
      </div>
    </section>
  </main>

  <script>
    function removeSavedPhoto(photoId, btn) {
      if (!confirm('Remove this photo from your saved wishlist?')) return;
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
        if (data.success && !data.saved) {
          const card = document.getElementById('photo-card-' + photoId);
          if (card) card.remove();
          const sidebarCounter = document.querySelector('.customer-sidebar-link[href*="my-photos"] .customer-sidebar-count');
          if (sidebarCounter) sidebarCounter.innerText = data.count;
        }
      })
      .catch(err => console.error(err));
    }

    function addSavedPhotoToCart(photoId, title, price, img, eventTitle) {
      if (window.PhotoXCart) {
        const item = {
          id: String(photoId),
          title: title || `Photo #${photoId}`,
          price: parseFloat(price) || 75.0,
          licenseType: 'personal',
          licenseName: 'Personal Digital License',
          image: img || `/protected-photo/${photoId}`,
          eventTitle: eventTitle || 'Saved Photos',
          eventSlug: '',
          photographer: 'PhotoX Creator'
        };
        window.PhotoXCart.addItem(item);
      }
      window.location.href = '/cart';
    }
  </script>
@endsection
