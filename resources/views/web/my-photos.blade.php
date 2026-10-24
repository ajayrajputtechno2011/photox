@extends('web.layouts.app')

@section('title', 'PhotoX | My Photos & Downloads')
@section('body-class', 'customer-app photos-page')

@section('content')
  <main class="workspace-layout container-xl py-4">
    @include('web.partials.customer-sidebar', ['activeTab' => 'photos'])

    <section class="workspace-content">
      <div class="workspace-view active">
        
        <!-- Header with Tab Navigation -->
        <div class="workspace-view-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
          <div>
            <span class="eyebrow-blue">YOUR DIGITAL PHOTO VAULT</span>
            <h2 class="fs-3 fw-bold mb-1">My Photos &amp; Downloads</h2>
            <p class="text-muted small mb-0">Access all your purchased full-resolution clean masters and saved wishlist previews.</p>
          </div>
          <div class="d-flex align-items-center gap-2 flex-wrap">
            @if(isset($purchasedPhotos) && $purchasedPhotos->isNotEmpty())
              <a href="{{ route('orders.download.zip') }}" class="btn btn-success rounded-pill px-4 fw-bold shadow-sm">
                <i class="bi bi-file-earmark-zip-fill me-2"></i>Download All (ZIP Archive)
              </a>
            @endif
            <a class="btn btn-outline-secondary rounded-pill px-4" href="{{ url('/events') }}">
              <i class="bi bi-compass me-1"></i>Explore Events
            </a>
          </div>
        </div>

        <style>
          #myPhotosTab .nav-link {
            background-color: #f1f5f9;
            color: #334155;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease-in-out;
          }
          #myPhotosTab .nav-link:hover {
            background-color: #e2e8f0;
            color: #0f172a;
          }
          #myPhotosTab .nav-link.active {
            background-color: #ffc107 !important;
            color: #000000 !important;
            border-color: #ffc107 !important;
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.35);
          }
        </style>

        <!-- Tab Pills: Purchased vs Saved -->
        <ul class="nav nav-pills mb-4 gap-2" id="myPhotosTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link rounded-pill px-4 py-2 fw-bold {{ (isset($purchasedPhotos) && $purchasedPhotos->isNotEmpty()) ? 'active' : '' }}" 
                    id="purchased-tab" 
                    data-bs-toggle="pill" 
                    data-bs-target="#purchased-pane" 
                    type="button" 
                    role="tab" 
                    aria-controls="purchased-pane" 
                    aria-selected="{{ (isset($purchasedPhotos) && $purchasedPhotos->isNotEmpty()) ? 'true' : 'false' }}">
              <i class="bi bi-patch-check-fill text-success me-2"></i>Purchased &amp; Unlocked ({{ isset($purchasedPhotos) ? $purchasedPhotos->count() : 0 }})
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link rounded-pill px-4 py-2 fw-bold {{ (isset($purchasedPhotos) && $purchasedPhotos->isNotEmpty()) ? '' : 'active' }}" 
                    id="wishlist-tab" 
                    data-bs-toggle="pill" 
                    data-bs-target="#wishlist-pane" 
                    type="button" 
                    role="tab" 
                    aria-controls="wishlist-pane" 
                    aria-selected="{{ (isset($purchasedPhotos) && $purchasedPhotos->isNotEmpty()) ? 'false' : 'true' }}">
              <i class="bi bi-bookmark-star-fill text-warning me-2"></i>Saved Wishlist ({{ $savedCount ?? 0 }})
            </button>
          </li>
        </ul>

        <div class="tab-content" id="myPhotosTabContent">
          
          <!-- TAB 1: PURCHASED PHOTOS & COMPLETE GALLERIES -->
          <div class="tab-pane fade {{ (isset($purchasedPhotos) && $purchasedPhotos->isNotEmpty()) ? 'show active' : '' }}" 
               id="purchased-pane" 
               role="tabpanel" 
               aria-labelledby="purchased-tab" 
               tabindex="0">

            @if(isset($purchasedPhotos) && $purchasedPhotos->isNotEmpty())
              <!-- Bulk Download Action Bar -->
              <div class="p-3 mb-4 rounded-4 shadow-sm d-flex justify-content-between align-items-center flex-wrap gap-3" style="background: linear-gradient(135deg, #0b1a29, #132a42); border: 1.5px solid #234b73; color: #fff;">
                <div class="d-flex align-items-center gap-3">
                  <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: rgba(16, 185, 129, 0.2); color: #10b981; font-size: 1.3rem;">
                    <i class="bi bi-cloud-arrow-down-fill"></i>
                  </div>
                  <div>
                    <h5 class="fw-bold mb-0 text-white">{{ $purchasedPhotos->count() }} Purchased Photos Ready for Download</h5>
                    <small class="text-secondary">Clean unwatermarked high-resolution original files with print &amp; digital rights.</small>
                  </div>
                </div>
                <a href="{{ route('orders.download.zip') }}" class="btn btn-success rounded-pill px-4 fw-bold shadow-sm">
                  <i class="bi bi-file-earmark-zip-fill me-2"></i>Download All in ZIP Archive
                </a>
              </div>

              <!-- Purchased Photo Grid -->
              <div class="row g-3 g-md-4">
                @foreach($purchasedPhotos as $photo)
                  @php
                    $rawTitle = trim($photo->title ?? '');
                    $isFilename = empty($rawTitle)
                      || preg_match('/^(clint|dsc|img|samples|cruiser|safariprojek|p\d+|\d+)/i', $rawTitle)
                      || preg_match('/\.(jpg|jpeg|png|webp|cr2|nef|arw|dng|raw)$/i', $rawTitle)
                      || preg_match('/-\d{3,}/', $rawTitle);
                    $displayTitle = (!$isFilename && !empty($rawTitle)) 
                      ? $rawTitle 
                      : (!empty($photo->bib_number) ? 'Athlete #' . $photo->bib_number : (($photo->event?->title ?: 'PhotoX') . ' · Photo #' . $photo->id));
                  @endphp
                  <div class="col-12 col-sm-6 col-lg-4" id="purchased-photo-card-{{ $photo->id }}">
                    <div class="card h-100 border rounded-4 overflow-hidden shadow-sm" style="background: #ffffff;">
                      <div style="height: 220px; background: #081426; position: relative;">
                        <!-- Clean Master Photo Image -->
                        <img src="{{ $photo->file_path }}" alt="{{ $displayTitle }}" style="width: 100%; height: 100%; object-fit: cover;">
                        <span class="badge bg-success position-absolute top-0 start-0 m-2 font-monospace shadow-sm">
                          <i class="bi bi-patch-check-fill me-1"></i>Unlocked Clean Master
                        </span>
                        @if($photo->bib_number)
                          <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2 font-monospace">BIB #{{ $photo->bib_number }}</span>
                        @endif
                      </div>
                      <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                          <strong class="d-block text-truncate text-dark" title="{{ $displayTitle }}">{{ $displayTitle }}</strong>
                          <span class="badge bg-success-subtle text-success border border-success-subtle font-monospace small">PAID</span>
                        </div>
                        <small class="text-muted d-block mb-3 text-truncate">{{ $photo->event?->title ?: 'PhotoX Event' }}</small>
                        <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                          <span class="small font-monospace text-muted">
                            <i class="bi bi-aspect-ratio me-1"></i>High-Res Clean
                          </span>
                          <a href="{{ route('orders.download.single', $photo->id) }}" class="btn btn-sm btn-success rounded-pill px-3 fw-bold shadow-sm">
                            <i class="bi bi-download me-1"></i>Download Clean
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            @else
              <div class="text-center py-5 text-muted border rounded-4 bg-white shadow-sm p-4">
                <i class="bi bi-bag-x fs-1 text-secondary opacity-50 d-block mb-2"></i>
                <h5 class="fw-bold text-dark">No Purchased Photos Yet</h5>
                <p class="small text-muted mb-3">When you purchase individual action photos or complete gallery bundles, clean full-resolution downloads will appear here.</p>
                <a href="{{ url('/events') }}" class="btn btn-warning text-dark fw-bold rounded-pill px-4">Explore Event Galleries</a>
              </div>
            @endif

          </div>

          <!-- TAB 2: SAVED WISHLIST PREVIEWS -->
          <div class="tab-pane fade {{ (!isset($purchasedPhotos) || $purchasedPhotos->isEmpty()) ? 'show active' : '' }}" 
               id="wishlist-pane" 
               role="tabpanel" 
               aria-labelledby="wishlist-tab" 
               tabindex="0">

            <div class="row g-3 g-md-4">
              @forelse($photos as $photo)
                @php
                  $isPurchased = $user ? $user->orderItems()->whereHas('order', fn ($q) => $q->where('payment_status', 'completed'))->where('event_photo_id', $photo->id)->exists() : false;
                  $rawTitle = trim($photo->title ?? '');
                  $isFilename = empty($rawTitle)
                    || preg_match('/^(clint|dsc|img|samples|cruiser|safariprojek|p\d+|\d+)/i', $rawTitle)
                    || preg_match('/\.(jpg|jpeg|png|webp|cr2|nef|arw|dng|raw)$/i', $rawTitle)
                    || preg_match('/-\d{3,}/', $rawTitle);
                  $displayTitle = (!$isFilename && !empty($rawTitle)) 
                    ? $rawTitle 
                    : (!empty($photo->bib_number) ? 'Athlete #' . $photo->bib_number : (($photo->event?->title ?: 'PhotoX') . ' · Photo #' . $photo->id));
                  $photoPrice = (float) ($photo->personal_price ?: 75.0);
                  $photoImg = $photo->watermarked_path ? asset($photo->watermarked_path) : ($photo->file_path ?: '/protected-photo/'.$photo->id);
                  $eventTitle = $photo->event?->title ?: 'Sports Event';
                  $photographerName = $photo->photographer_name ?: ($photo->photographer?->name ?: 'PhotoX Creator');
                @endphp
                <div class="col-12 col-sm-6 col-lg-4" id="photo-card-{{ $photo->id }}">
                  <div class="card h-100 border rounded-4 overflow-hidden shadow-sm">
                    <div style="height: 220px; background: #081426; position: relative;">
                      <img src="/protected-photo/{{ $photo->id }}" alt="{{ $displayTitle }}" style="width: 100%; height: 100%; object-fit: contain;">
                      @if($photo->bib_number)
                        <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2 font-monospace">BIB #{{ $photo->bib_number }}</span>
                      @endif
                      <button type="button" class="btn btn-sm btn-light rounded-circle text-danger border position-absolute top-0 end-0 m-2 shadow-sm" onclick="removeSavedPhoto({{ $photo->id }}, this)" title="Remove from wishlist">
                        <i class="bi bi-trash"></i>
                      </button>
                    </div>
                    <div class="card-body p-3">
                      <div class="d-flex justify-content-between align-items-start mb-1">
                        <strong class="d-block text-truncate text-dark" title="{{ $displayTitle }}">{{ $displayTitle }}</strong>
                        <span class="text-primary fw-bold font-monospace small">R{{ number_format($photoPrice, 2) }}</span>
                      </div>
                      <small class="text-muted d-block mb-3 text-truncate">{{ $eventTitle }}</small>
                      <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                        @if($isPurchased)
                          <span class="small font-monospace text-success"><i class="bi bi-patch-check-fill me-1"></i>Purchased &bull; Clean</span>
                          <a href="{{ route('orders.download.single', $photo->id) }}" class="btn btn-sm btn-success rounded-pill px-3">
                            <i class="bi bi-download me-1"></i>Download
                          </a>
                        @else
                          <span class="small font-monospace text-muted"><i class="bi bi-shield-lock me-1 text-warning"></i>Protected</span>
                          <button type="button" 
                                  class="btn btn-sm btn-warning text-dark fw-bold rounded-pill px-3 shadow-sm"
                                  data-photo-id="{{ $photo->id }}"
                                  data-title="{{ $displayTitle }}"
                                  data-price="{{ $photoPrice }}"
                                  data-image="{{ $photoImg }}"
                                  data-event="{{ $eventTitle }}"
                                  data-photographer="{{ $photographerName }}"
                                  onclick="addSavedPhotoToCart(this)">
                            <i class="bi bi-cart-plus me-1"></i>Buy Clean Copy
                          </button>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              @empty
                <div class="col-12 text-center py-5 text-muted border rounded-4 bg-white shadow-sm p-4">
                  <i class="bi bi-heart fs-1 text-secondary opacity-50 d-block mb-2"></i>
                  <h5 class="fw-bold text-dark">No Photos Saved in Wishlist</h5>
                  <p class="small text-muted mb-3">When browsing galleries, click the bookmark icon to save favorite photos to your wishlist.</p>
                  <a href="{{ url('/events') }}" class="btn btn-lime rounded-pill px-4 mt-2">Browse Events</a>
                </div>
              @endforelse
            </div>
            
            @if(method_exists($photos, 'hasPages') && $photos->hasPages())
              <div class="mt-4 d-flex justify-content-center">
                {{ $photos->links() }}
              </div>
            @endif

          </div>

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

    function addSavedPhotoToCart(target, title, price, img, eventTitle, photographer) {
      let photoId = target;
      let itemTitle = title;
      let itemPrice = price;
      let itemImg = img;
      let itemEvent = eventTitle;
      let itemPhotographer = photographer || 'PhotoX Creator';

      if (target instanceof HTMLElement || (typeof target === 'object' && target !== null && target.getAttribute)) {
        photoId = target.getAttribute('data-photo-id');
        itemTitle = target.getAttribute('data-title') || `Photo #${photoId}`;
        itemPrice = parseFloat(target.getAttribute('data-price')) || 75.0;
        itemImg = target.getAttribute('data-image') || `/protected-photo/${photoId}`;
        itemEvent = target.getAttribute('data-event') || 'Saved Photos';
        itemPhotographer = target.getAttribute('data-photographer') || 'PhotoX Creator';
      }

      const item = {
        id: String(photoId),
        title: itemTitle || `Photo #${photoId}`,
        price: parseFloat(itemPrice) || 75.0,
        licenseType: 'personal',
        licenseName: 'Personal Digital License',
        image: itemImg || `/protected-photo/${photoId}`,
        eventTitle: itemEvent || 'Saved Photos',
        eventSlug: '',
        photographer: itemPhotographer,
        addedAt: new Date().toISOString()
      };

      if (window.PhotoXCart) {
        window.PhotoXCart.addItem(item);
      } else {
        try {
          const storageKey = 'photox_user_cart';
          let items = JSON.parse(localStorage.getItem(storageKey) || '[]');
          const existingIdx = items.findIndex(i => String(i.id) === String(photoId) && i.licenseType === 'personal');
          if (existingIdx > -1) {
            items[existingIdx].price = item.price;
            items[existingIdx].title = item.title;
          } else {
            items.push(item);
          }
          localStorage.setItem(storageKey, JSON.stringify(items));
        } catch (e) {
          console.error('PhotoX cart error:', e);
        }
      }

      window.location.href = '/cart';
    }
  </script>
@endsection
