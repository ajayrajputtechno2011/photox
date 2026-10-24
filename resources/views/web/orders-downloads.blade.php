@extends('web.layouts.app')

@section('title', 'PhotoX | Orders & Downloads')
@section('body-class', 'customer-app page-orders-downloads')

@section('content')
  <main class="workspace-layout container-xl py-3 py-md-4">
    @include('web.partials.customer-sidebar', ['activeTab' => 'orders'])

    <section class="workspace-content">
      @if($status === 'success')
        <div class="alert alert-success d-flex align-items-center gap-3 p-3 rounded-4 mb-4 border-0 shadow-sm" style="background: #e8f9ee;" role="alert">
          <i class="bi bi-patch-check-fill fs-1 text-success flex-shrink-0"></i>
          <div>
            <h4 class="alert-heading mb-1 fw-bold text-success fs-5">Payment Received Successfully via Yoco!</h4>
            <p class="mb-0 small text-dark">Thank you for your purchase. Total amount: <strong>R{{ number_format($amount ?: 75, 2) }}</strong>. Your original digital photos are unlocked below.</p>
          </div>
        </div>

        <script>
          // Thoroughly wipe client cart storage and reset header badges on successful payment
          (function() {
            try {
              localStorage.removeItem('photox_user_cart');
              localStorage.removeItem('photox_cart');
            } catch(e) {}
            if (window.PhotoXCart) {
              window.PhotoXCart.clear();
              window.PhotoXCart.updateBadge();
            }
            document.querySelectorAll('.header-cart span').forEach(function(el) {
              el.textContent = '0';
            });
          })();
        </script>
      @endif

      <div class="workspace-view-header mb-3 mb-md-4">
        <div>
          <span class="eyebrow-blue">ORDERS &amp; DOWNLOADS</span>
          <h2 class="fs-3 fw-bold mb-1">Your purchases &amp; files</h2>
          <p class="text-muted small mb-0">Download the high-resolution files you have bought, whenever you need them.</p>
        </div>
      </div>

      @if(isset($purchaseGroups) && $purchaseGroups->isNotEmpty())
        <!-- Master Summary Banner -->
        <div class="download-banner mb-4 p-3 p-sm-4 rounded-4 text-white" style="background: linear-gradient(135deg, #0b2d5b, #194680);">
          <div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch align-items-md-center gap-3">
            <div class="d-flex align-items-start align-items-sm-center gap-3">
              <i class="bi bi-cloud-check fs-1 text-warning flex-shrink-0"></i>
              <div>
                <strong class="fs-5 d-block">{{ $purchasedPhotos->count() }} Digital {{ Str::plural('Download', $purchasedPhotos->count()) }} Ready</strong>
                <div class="d-flex flex-wrap align-items-center gap-1 gap-sm-2 mt-1">
                  <span class="badge rounded-pill bg-warning text-dark font-monospace py-1 px-2 small"><i class="bi bi-bag-check me-1"></i>{{ $purchaseGroups->count() }} {{ Str::plural('Purchase', $purchaseGroups->count()) }}</span>
                  <span class="badge rounded-pill bg-success text-white font-monospace py-1 px-2 small"><i class="bi bi-shield-check me-1"></i>6-Month Digital License Active</span>
                </div>
                <small class="text-white-50 d-block mt-1">Download each purchase date separately below, or download all files together.</small>
              </div>
            </div>
            <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-2 flex-shrink-0 w-100 w-md-auto mt-2 mt-md-0">
              <a class="btn btn-warning rounded-pill px-3 px-sm-4 py-2 fw-bold shadow-sm text-center flex-fill flex-sm-grow-0" href="{{ route('orders.download.zip') }}" title="Download all purchased files across all dates">
                <i class="bi bi-file-earmark-zip-fill me-1"></i>Download All (All {{ $purchasedPhotos->count() }} Photos)
              </a>
              <a class="btn btn-outline-light rounded-pill px-3 px-sm-4 py-2 text-center flex-fill flex-sm-grow-0" href="{{ route('customer.my_photos') }}">
                <i class="bi bi-images me-1"></i>View All Photos
              </a>
            </div>
          </div>
        </div>

        <!-- Groups sorted by purchase date (newest first) -->
        @foreach($purchaseGroups as $group)
          <div class="purchase-group-section mb-5 p-3 p-md-4 rounded-4 bg-white border shadow-sm">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center pb-3 mb-3 border-bottom gap-3">
              <div class="d-flex align-items-center gap-2 flex-wrap">
                <span class="badge bg-primary rounded-pill px-3 py-2 fs-6 fw-semibold d-inline-flex align-items-center gap-1 shadow-sm">
                  <i class="bi bi-calendar2-check-fill text-warning"></i>
                  <span>Purchased on {{ $group->date }}</span>
                </span>
                @if($group->order_number)
                  <span class="badge bg-light text-dark border font-monospace py-1 px-2 small">
                    <i class="bi bi-receipt me-1 text-primary"></i>Order #{{ $group->order_number }}
                  </span>
                @endif
                @php
                  $purchaseCarbon = rescue(fn() => \Carbon\Carbon::parse($group->date), now());
                  $validUntil = $purchaseCarbon->copy()->addMonths(6);
                  $daysLeft = max(0, (int) now()->diffInDays($validUntil, false));
                @endphp
                <span class="badge rounded-pill bg-success bg-opacity-10 text-success border border-success border-opacity-25 font-monospace py-1 px-2 small">
                  <i class="bi bi-clock-history me-1"></i>6-Month Digital License &bull; {{ $daysLeft }} days left (Valid until {{ $validUntil->format('M d, Y') }})
                </span>
                <span class="text-muted small fw-medium">
                  &bull; {{ $group->items_count }} {{ Str::plural('Photo', $group->items_count) }}
                  @if($group->total_amount)
                    (R{{ number_format($group->total_amount, 2) }})
                  @endif
                </span>
              </div>
              <div class="w-100 w-md-auto">
                <a href="{{ $group->download_zip_url }}" class="btn btn-warning btn-sm rounded-pill px-3 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-1 w-100 justify-content-center">
                  <i class="bi bi-file-earmark-zip-fill text-dark"></i>
                  <span>Download {{ $group->date }} ZIP ({{ $group->items_count }} {{ Str::plural('Photo', $group->items_count) }})</span>
                </a>
              </div>
            </div>

            <!-- Photos in this specific purchase group -->
            <div class="row g-3 g-md-4">
              @foreach($group->items as $photo)
                @php
                  $photoRealId = $photo->photo?->id ?: ($photo->event_photo_id ?: $photo->id);
                  $eventTitle = $photo->event?->title ?: ($photo->photo?->event?->title ?: 'PhotoX Sports Gallery');
                  $downloadUrl = route('orders.download.single', $photo->id);
                  $previewImg = $photo->thumbnail_url ?: $photo->file_path;
                  $fullImg = $photo->file_path;
                @endphp
                <div class="col-12 col-sm-6 col-lg-4">
                  <div class="card h-100 border rounded-4 overflow-hidden shadow-sm photo-download-card">
                    <div class="photo-card-thumb-wrap" 
                         onclick="openPhotoPopup(this)" 
                         data-img-src="{{ $fullImg }}" 
                         data-title="{{ $photo->title ?: 'Action Photo' }}" 
                         data-event="{{ $eventTitle }}" 
                         data-download-url="{{ $downloadUrl }}"
                         title="Click to view full photo popup">
                      <img src="{{ $previewImg }}" alt="{{ $photo->title }}" loading="lazy">
                      <span class="badge bg-success position-absolute top-0 end-0 m-2 font-monospace shadow-sm" style="font-size: 0.68rem;">
                        <i class="bi bi-patch-check-fill me-1"></i>PAID &bull; 6-MO LICENSE
                      </span>
                      <div class="photo-thumb-overlay">
                        <i class="bi bi-arrows-fullscreen fs-5"></i>
                        <span>Preview &amp; Download</span>
                      </div>
                    </div>
                    <div class="card-body p-3">
                      <strong class="d-block text-truncate mb-1 text-dark" title="{{ $photo->title }}">{{ $photo->title ?: 'Action Photo' }}</strong>
                      <small class="text-muted d-block text-truncate mb-3">{{ $eventTitle }}</small>
                      <div class="d-flex justify-content-between align-items-center pt-2 border-top gap-2">
                        <button type="button" 
                                class="btn btn-sm btn-outline-secondary rounded-pill px-3 flex-fill text-center" 
                                onclick="openPhotoPopup(this.closest('.photo-download-card').querySelector('.photo-card-thumb-wrap'))">
                          <i class="bi bi-eye me-1"></i>Preview
                        </button>
                        <a href="{{ $downloadUrl }}" download="PhotoX_{{ $photoRealId }}.jpg" class="btn btn-sm btn-lime rounded-pill px-3 shadow-sm fw-semibold flex-fill text-center">
                          <i class="bi bi-download me-1"></i>Download
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endforeach
      @elseif($purchasedPhotos->isNotEmpty())
        <div class="download-banner mb-4 p-3 p-sm-4 rounded-4 text-white" style="background: linear-gradient(135deg, #0b2d5b, #194680);">
          <div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch align-items-md-center gap-3">
            <div class="d-flex align-items-start align-items-sm-center gap-3">
              <i class="bi bi-cloud-check fs-1 text-warning flex-shrink-0"></i>
              <div>
                <strong class="fs-5 d-block">{{ $purchasedPhotos->count() }} Digital {{ Str::plural('Download', $purchasedPhotos->count()) }} Ready</strong>
                <div class="d-flex flex-wrap align-items-center gap-1 gap-sm-2 mt-1">
                  <span class="badge rounded-pill bg-warning text-dark font-monospace py-1 px-2 small"><i class="bi bi-file-earmark-zip me-1"></i>ZIP Bundle Available</span>
                  <span class="badge rounded-pill bg-white text-dark font-monospace py-1 px-2 small"><i class="bi bi-clock-history me-1"></i>Permanent Vault Access</span>
                </div>
                <small class="text-white-50 d-block mt-1">Original full-resolution photography files unwatermarked for print &amp; web use.</small>
              </div>
            </div>
            <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-2 flex-shrink-0 w-100 w-md-auto mt-2 mt-md-0">
              <a class="btn btn-warning rounded-pill px-3 px-sm-4 py-2 fw-bold shadow-sm text-center flex-fill flex-sm-grow-0" href="{{ route('orders.download.zip') }}">
                <i class="bi bi-file-earmark-zip-fill me-1"></i>Download All (ZIP)
              </a>
              <a class="btn btn-outline-light rounded-pill px-3 px-sm-4 py-2 text-center flex-fill flex-sm-grow-0" href="{{ route('customer.my_photos') }}">
                <i class="bi bi-images me-1"></i>View All Photos
              </a>
            </div>
          </div>
        </div>

        <div class="row g-3 g-md-4 mb-4">
          @foreach($purchasedPhotos as $photo)
            @php
              $photoRealId = $photo->photo?->id ?: ($photo->event_photo_id ?: $photo->id);
              $eventTitle = $photo->event?->title ?: ($photo->photo?->event?->title ?: 'PhotoX Sports Gallery');
              $downloadUrl = route('orders.download.single', $photo->id);
              $previewImg = $photo->thumbnail_url ?: $photo->file_path;
              $fullImg = $photo->file_path;
            @endphp
            <div class="col-12 col-sm-6 col-lg-4">
              <div class="card h-100 border rounded-4 overflow-hidden shadow-sm photo-download-card">
                <div class="photo-card-thumb-wrap" 
                     onclick="openPhotoPopup(this)" 
                     data-img-src="{{ $fullImg }}" 
                     data-title="{{ $photo->title ?: 'Action Photo' }}" 
                     data-event="{{ $eventTitle }}" 
                     data-download-url="{{ $downloadUrl }}"
                     title="Click to view full photo popup">
                  <img src="{{ $previewImg }}" alt="{{ $photo->title }}" loading="lazy">
                  <span class="badge bg-success position-absolute top-0 end-0 m-2 font-monospace shadow-sm">
                    <i class="bi bi-patch-check-fill me-1"></i>PAID
                  </span>
                  <div class="photo-thumb-overlay">
                    <i class="bi bi-arrows-fullscreen fs-5"></i>
                    <span>Preview &amp; Download</span>
                  </div>
                </div>
                <div class="card-body p-3">
                  <strong class="d-block text-truncate mb-1 text-dark" title="{{ $photo->title }}">{{ $photo->title ?: 'Action Photo' }}</strong>
                  <small class="text-muted d-block text-truncate mb-3">{{ $eventTitle }}</small>
                  <div class="d-flex justify-content-between align-items-center pt-2 border-top gap-2">
                    <button type="button" 
                            class="btn btn-sm btn-outline-secondary rounded-pill px-3 flex-fill text-center" 
                            onclick="openPhotoPopup(this.closest('.photo-download-card').querySelector('.photo-card-thumb-wrap'))">
                      <i class="bi bi-eye me-1"></i>Preview
                    </button>
                    <a href="{{ $downloadUrl }}" download="PhotoX_{{ $photoRealId }}.jpg" class="btn btn-sm btn-lime rounded-pill px-3 shadow-sm fw-semibold flex-fill text-center">
                      <i class="bi bi-download me-1"></i>Download
                    </a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <div class="card border rounded-4 p-4 p-sm-5 text-center mb-4 shadow-sm bg-light-subtle">
          <div class="mb-3">
            <div class="d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle" style="width: 70px; height: 70px;">
              <i class="bi bi-cloud-arrow-down fs-1"></i>
            </div>
          </div>
          <h4 class="fw-bold text-dark fs-5">No Purchased Photos Yet</h4>
          <p class="text-muted mx-auto mb-4 small" style="max-width: 480px;">
            Once you purchase photos through Yoco checkout, your original unwatermarked high-resolution downloads will be unlocked here.
          </p>
          <div>
            <a class="btn btn-primary rounded-pill px-4 py-2 fw-semibold" href="{{ url('/events') }}">
              <i class="bi bi-compass me-2"></i>Browse Events &amp; Find Photos
            </a>
          </div>
        </div>
      @endif

      <!-- Order History Card (Desktop Table + Mobile Cards) -->
      <div class="card border rounded-4 p-3 p-sm-4 shadow-sm bg-white">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="fw-bold mb-0 fs-6">Order History</h5>
          <span class="text-muted small">{{ $orders->count() }} {{ Str::plural('order', $orders->count()) }}</span>
        </div>

        @if($orders->isNotEmpty())
          <!-- Desktop Table View (>= 768px) -->
          <div class="table-responsive d-none d-md-block">
            <table class="table align-middle mb-0">
              <thead>
                <tr class="text-secondary small font-monospace border-bottom">
                  <th>ORDER ID</th>
                  <th>EVENT / PRODUCT</th>
                  <th>DATE</th>
                  <th>AMOUNT</th>
                  <th>STATUS</th>
                </tr>
              </thead>
              <tbody>
                @foreach($orders as $order)
                  <tr>
                    <td><strong class="font-monospace text-dark">{{ $order->order_number ?: 'PX-'.$order->id }}</strong></td>
                    <td>
                      <span class="text-dark">{{ $order->items->first()?->title ?: 'Digital Photography Bundle' }}</span>
                      @if($order->items->count() > 1)
                        <span class="badge bg-secondary-subtle text-secondary small ms-1">+{{ $order->items->count() - 1 }} more</span>
                      @endif
                    </td>
                    <td class="text-muted small">{{ $order->created_at ? $order->created_at->format('d M Y') : '-' }}</td>
                    <td><strong class="text-dark">R{{ number_format($order->total_amount, 2) }}</strong></td>
                    <td>
                      <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-semibold small">
                        <i class="bi bi-check-circle-fill me-1"></i>{{ strtoupper($order->payment_status ?: 'COMPLETED') }}
                      </span>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <!-- Mobile Cards View (< 768px) -->
          <div class="d-md-none order-mobile-list">
            @foreach($orders as $order)
              <div class="order-mobile-card border rounded-3 p-3 mb-2 bg-light bg-opacity-50">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <strong class="font-monospace text-dark small">{{ $order->order_number ?: 'PX-'.$order->id }}</strong>
                  <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 small fw-semibold" style="font-size: 0.72rem;">
                    <i class="bi bi-check-circle-fill me-1"></i>{{ strtoupper($order->payment_status ?: 'COMPLETED') }}
                  </span>
                </div>
                <div class="text-dark fw-semibold small mb-2">
                  {{ $order->items->first()?->title ?: 'Digital Photography Bundle' }}
                  @if($order->items->count() > 1)
                    <span class="badge bg-secondary-subtle text-secondary small ms-1">+{{ $order->items->count() - 1 }} more</span>
                  @endif
                </div>
                <div class="d-flex justify-content-between align-items-center text-muted small pt-2 border-top border-secondary border-opacity-10">
                  <span><i class="bi bi-calendar3 me-1"></i>{{ $order->created_at ? $order->created_at->format('d M Y') : '-' }}</span>
                  <strong class="text-primary fs-6">R{{ number_format($order->total_amount, 2) }}</strong>
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div class="text-center py-4 py-sm-5 text-muted">
            <i class="bi bi-receipt fs-1 d-block mb-2 text-secondary opacity-50"></i>
            <h6 class="fw-bold text-dark mb-1">No Orders Placed Yet</h6>
            <small class="text-muted">When you make a payment for photos via Yoco, your invoice and transaction history will be listed here.</small>
          </div>
        @endif
      </div>
    </section>
  </main>

  <!-- Photo Preview & Download Modal -->
  <div class="modal fade" id="photoDownloadModal" tabindex="-1" aria-labelledby="photoDownloadModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
      <div class="modal-content border-0 shadow-lg" style="background: #081426; border-radius: 20px; overflow: hidden; color: #fff;">
        <div class="modal-header border-bottom border-light border-opacity-10 px-3 px-sm-4 py-3" style="background: #0b1a30;">
          <div class="d-flex align-items-center gap-3">
            <div class="d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle" style="width: 38px; height: 38px;">
              <i class="bi bi-image fs-6"></i>
            </div>
            <div>
              <h5 class="modal-title fw-bold text-white mb-0 fs-6" id="photoDownloadModalTitle">Photo Preview</h5>
              <small class="text-white-50" id="photoDownloadModalEvent" style="font-size: 0.75rem;">PhotoX Gallery</small>
            </div>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-2 p-sm-3 text-center position-relative d-flex align-items-center justify-content-center" style="min-height: 220px; max-height: 65vh; background: #030811;">
          <img id="photoDownloadModalImg" src="" alt="Photo Preview" class="img-fluid rounded-3" style="max-height: 60vh; max-width: 100%; object-fit: contain; box-shadow: 0 10px 40px rgba(0,0,0,0.6);">
        </div>
        <div class="modal-footer border-top border-light border-opacity-10 px-3 px-sm-4 py-3 d-flex flex-column flex-sm-row justify-content-between align-items-stretch align-items-sm-center gap-2" style="background: #0b1a30;">
          <div class="d-flex flex-wrap align-items-center gap-1 gap-sm-2">
            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill font-monospace small">
              <i class="bi bi-patch-check-fill me-1"></i>Purchased &bull; Original Clean High-Res
            </span>
          </div>
          <div class="d-flex align-items-center gap-2">
            <button type="button" class="btn btn-outline-light rounded-pill px-3 py-2 flex-fill flex-sm-grow-0" data-bs-dismiss="modal">
              Close
            </button>
            <a id="modalDownloadBtn" href="#" class="btn btn-lime rounded-pill px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center justify-content-center gap-2 flex-fill flex-sm-grow-0">
              <i class="bi bi-download"></i>
              <span>Download Image</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <style>
    .photo-download-card {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .photo-download-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 24px rgba(11, 45, 91, 0.12) !important;
    }
    .photo-card-thumb-wrap {
      height: 210px;
      background: #081426;
      position: relative;
      cursor: pointer;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    @media (max-width: 575.98px) {
      .photo-card-thumb-wrap {
        height: 190px;
      }
    }
    .photo-card-thumb-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s ease;
    }
    .photo-card-thumb-wrap:hover img {
      transform: scale(1.05);
    }
    .photo-thumb-overlay {
      position: absolute;
      inset: 0;
      background: rgba(8, 20, 38, 0.6);
      backdrop-filter: blur(2px);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transition: opacity 0.2s ease;
      color: #fff;
      font-weight: 600;
      gap: 6px;
      font-size: 0.88rem;
    }
    .photo-card-thumb-wrap:hover .photo-thumb-overlay {
      opacity: 1;
    }
  </style>

  <script>
    // Global cart cleanup on order page
    document.addEventListener('DOMContentLoaded', function() {
      @if($status === 'success')
        try {
          localStorage.removeItem('photox_user_cart');
          localStorage.removeItem('photox_cart');
        } catch(e) {}
        if (window.PhotoXCart) {
          window.PhotoXCart.clear();
          window.PhotoXCart.updateBadge();
        }
        document.querySelectorAll('.header-cart span').forEach(function(el) {
          el.textContent = '0';
        });
      @endif

      // Clean out any photo IDs from cart that are already completed in user orders
      @php
        $purchasedIds = $purchasedPhotos->pluck('photo.id')->merge($purchasedPhotos->pluck('event_photo_id'))->filter()->unique()->values()->toArray();
      @endphp
      const purchasedPhotoIds = @json($purchasedIds);
      if (window.PhotoXCart && purchasedPhotoIds.length > 0) {
        let items = window.PhotoXCart.getItems();
        let changed = false;
        items = items.filter(item => {
          if (purchasedPhotoIds.includes(parseInt(item.id)) || purchasedPhotoIds.includes(String(item.id))) {
            changed = true;
            return false;
          }
          return true;
        });
        if (changed) {
          window.PhotoXCart.saveItems(items);
          window.PhotoXCart.updateBadge();
        }
      }
    });

    function openPhotoPopup(thumbEl) {
      if (!thumbEl) return;
      const imgSrc = thumbEl.dataset.imgSrc || '';
      const title = thumbEl.dataset.title || 'Purchased Photo';
      const event = thumbEl.dataset.event || 'PhotoX Gallery';
      const downloadUrl = thumbEl.dataset.downloadUrl || '#';

      document.getElementById('photoDownloadModalTitle').textContent = title;
      document.getElementById('photoDownloadModalEvent').textContent = event;

      const modalImg = document.getElementById('photoDownloadModalImg');
      modalImg.src = imgSrc;
      modalImg.alt = title;

      const downloadBtn = document.getElementById('modalDownloadBtn');
      downloadBtn.href = downloadUrl;

      const modalEl = document.getElementById('photoDownloadModal');
      const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
      modal.show();
    }
  </script>
@endsection