@extends('web.layouts.app')

@section('title', 'PhotoX | Orders & Downloads')
@section('body-class', 'customer-app page-orders-downloads')

@section('content')
  <main class="workspace-layout container-xl py-4">
    <aside class="workspace-sidebar" aria-label="Account navigation">
      <div class="workspace-greeting">
        <span class="eyebrow-blue">YOUR WORKSPACE</span>
        <h1>Keep the<br><em>good ones.</em></h1>
      </div>
      <nav class="workspace-nav">
        <a class="workspace-nav-link" href="{{ route('customer.dashboard') }}"><i class="bi bi-grid-1x2"></i><span>Overview</span></a>
        <a class="workspace-nav-link" href="{{ route('customer.my_photos') }}"><i class="bi bi-images"></i><span>My photos</span></a>
        <a class="workspace-nav-link" href="{{ route('customer.saved_events') }}"><i class="bi bi-bookmark"></i><span>Saved events</span></a>
        <a class="workspace-nav-link active" href="{{ route('orders.downloads') }}"><i class="bi bi-bag"></i><span>Orders &amp; downloads</span></a>
        <a class="workspace-nav-link" href="{{ route('customer.profile') }}"><i class="bi bi-person"></i><span>Profile &amp; settings</span></a>
      </nav>
      <div class="workspace-side-note">
        <i class="bi bi-shield-check"></i>
        <div>
          <strong>Secure delivery</strong>
          <span>Your original files are protected with unwatermarked high-resolution downloads.</span>
        </div>
      </div>
    </aside>

    <section class="workspace-content">
      @if($status === 'success')
        <div class="alert alert-success d-flex align-items-center gap-3 p-3 rounded-4 mb-4 border-0 shadow-sm" style="background: #e8f9ee;" role="alert">
          <i class="bi bi-patch-check-fill fs-1 text-success"></i>
          <div>
            <h4 class="alert-heading mb-1 fw-bold text-success">Payment Received Successfully via Yoco!</h4>
            <p class="mb-0 small text-dark">Thank you for your purchase. Total amount: <strong>R{{ number_format($amount ?: 75, 2) }}</strong>. Your original digital photos are unlocked below.</p>
          </div>
        </div>

        <script>
          // Clear cart on successful purchase
          try {
            localStorage.removeItem('photox_cart');
          } catch(e) {}
        </script>
      @endif

      <div class="workspace-view-header">
        <div>
          <span class="eyebrow-blue">ORDERS &amp; DOWNLOADS</span>
          <h2>Your purchases &amp; files</h2>
          <p>Download the high-resolution files you have bought, whenever you need them.</p>
        </div>
      </div>

      <div class="download-banner mb-4 p-4 rounded-4 d-flex flex-wrap justify-content-between align-items-center gap-3 text-white" style="background: linear-gradient(135deg, #0b2d5b, #194680);">
        <div class="d-flex align-items-center gap-3">
          <i class="bi bi-cloud-check fs-1 text-warning"></i>
          <div>
            <strong class="fs-5 d-block">Digital Downloads Ready</strong>
            <div class="d-flex flex-wrap align-items-center gap-2 mt-1">
              <span class="badge rounded-pill bg-warning text-dark font-monospace py-1 px-2"><i class="bi bi-file-earmark-zip me-1"></i>ZIP Bundle Available</span>
              <span class="badge rounded-pill bg-white text-dark font-monospace py-1 px-2"><i class="bi bi-clock-history me-1"></i>6-Month Active Window (Valid until {{ now()->addMonths(6)->format('d M Y') }})</span>
            </div>
            <small class="text-white-50 d-block mt-1">Original full-resolution photography files unwatermarked for print & web use.</small>
          </div>
        </div>
        <div class="d-flex align-items-center gap-2">
          <a class="btn btn-warning rounded-pill px-4 fw-bold shadow-sm" href="{{ route('orders.download.zip') }}">
            <i class="bi bi-file-earmark-zip-fill me-1"></i>Download All (ZIP)
          </a>
          <a class="btn btn-outline-light rounded-pill px-4" href="{{ route('customer.my_photos') }}">
            <i class="bi bi-images me-1"></i>View All Photos
          </a>
        </div>
      </div>

      <div class="row g-4 mb-4">
        @forelse($purchasedPhotos as $photo)
          <div class="col-md-6 col-lg-4">
            <div class="card h-100 border rounded-4 overflow-hidden shadow-sm">
              <div style="height: 180px; background: #081426; position: relative;">
                <img src="{{ $photo->thumbnail_url ?: $photo->file_path }}" alt="{{ $photo->title }}" style="width: 100%; height: 100%; object-fit: contain;">
                <span class="badge bg-success position-absolute top-0 end-0 m-2 font-monospace">PAID</span>
              </div>
              <div class="card-body p-3">
                <strong class="d-block text-truncate">{{ $photo->title ?: 'Action Photo' }}</strong>
                <small class="text-muted d-block">{{ $photo->event?->title ?: 'Sports Championship' }}</small>
                <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                  <span class="small font-monospace text-primary">High-Res JPG</span>
                  <a href="{{ $photo->file_path }}" download="PhotoX_{{ $photo->id }}.jpg" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                    <i class="bi bi-download me-1"></i>Download
                  </a>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 text-center py-4 text-muted">
            <p>No orders placed yet.</p>
          </div>
        @endforelse
      </div>

      <div class="card border rounded-4 p-3 shadow-sm">
        <h5 class="fw-bold mb-3">Order History</h5>
        <div class="table-responsive">
          <table class="table align-middle">
            <thead>
              <tr class="text-secondary small font-monospace">
                <th>ORDER ID</th>
                <th>EVENT / PRODUCT</th>
                <th>DATE</th>
                <th>AMOUNT</th>
                <th>STATUS</th>
              </tr>
            </thead>
            <tbody>
              @if($status === 'success')
                <tr>
                  <td><strong>PX-{{ date('Ymd') }}-{{ rand(100, 999) }}</strong></td>
                  <td>PhotoX Digital Photos Bundle</td>
                  <td>{{ date('d M Y') }}</td>
                  <td><strong>R{{ number_format($amount ?: 75, 2) }}</strong></td>
                  <td><span class="badge bg-success rounded-pill px-3 py-1">PAID (YOCO)</span></td>
                </tr>
              @endif
              <tr>
                <td><strong>PX-202610-098</strong></td>
                <td>Maties vs Ikeys Derby</td>
                <td>12 Sep 2026</td>
                <td>R200.00</td>
                <td><span class="badge bg-success rounded-pill px-3 py-1">PAID</span></td>
              </tr>
              <tr>
                <td><strong>PX-202610-064</strong></td>
                <td>City Marathon 2026 High-Res Bundle</td>
                <td>14 Sep 2026</td>
                <td>R450.00</td>
                <td><span class="badge bg-success rounded-pill px-3 py-1">PAID</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </main>
@endsection