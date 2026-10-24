@extends('web.layouts.app')

@section('title', 'PhotoX | Shopping Cart')
@section('body-class', 'page-cart')

@section('styles')
  <style>
    /* Base Cart Item Styling */
    .cart-item-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      padding: 14px 16px;
      margin-bottom: 12px;
      border: 1px solid rgba(11, 45, 91, 0.1);
      border-radius: 14px;
      background: #ffffff;
      box-shadow: 0 2px 8px rgba(11, 45, 91, 0.03);
      transition: all 0.2s ease;
      width: 100%;
      box-sizing: border-box;
    }
    .cart-item-row:hover {
      background: #f8fbff;
      border-color: rgba(11, 45, 91, 0.2);
      box-shadow: 0 4px 14px rgba(11, 45, 91, 0.06);
    }
    .cart-item-main {
      display: flex;
      align-items: center;
      gap: 14px;
      flex: 1;
      min-width: 0; /* Prevents overflow */
    }
    /* Thumbnail Box: Full uncropped photo preview */
    .cart-item-thumb-box {
      width: 96px;
      height: 74px;
      min-width: 96px;
      border-radius: 10px;
      background: #081426;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      border: 1px solid rgba(11, 45, 91, 0.15);
      flex-shrink: 0;
      position: relative;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      cursor: pointer;
    }
    .cart-item-thumb-box:hover::after {
      content: '\F3E0';
      font-family: 'bootstrap-icons';
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.45);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
    }
    .cart-item-thumb {
      max-width: 100%;
      max-height: 100%;
      width: auto;
      height: auto;
      object-fit: contain; /* Complete photo always visible, NEVER CROPPED */
      display: block;
      border-radius: 4px;
    }
    .cart-item-info {
      flex: 1;
      min-width: 0; /* Prevents overflow */
      overflow: hidden;
    }
    .cart-item-title {
      font-weight: 700;
      color: #0b2d5b;
      font-size: 0.98rem;
      margin-bottom: 4px;
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
      word-break: break-word;
      overflow-wrap: anywhere;
    }
    .cart-item-meta {
      font-size: 0.78rem;
      color: #59708f;
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
      line-height: 1.4;
      word-break: break-word;
    }
    .cart-item-meta span {
      display: inline-flex;
      align-items: center;
    }
    .cart-item-price-col {
      text-align: right;
      flex-shrink: 0;
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      justify-content: center;
      min-width: 85px;
    }
    .cart-item-price {
      font-size: 1.15rem;
      font-weight: 800;
      color: #0b2d5b;
      line-height: 1.2;
    }
    .cart-item-remove-btn {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      font-size: 0.78rem;
      color: #ef4444;
      background: rgba(239, 68, 68, 0.08);
      border: none;
      border-radius: 6px;
      padding: 4px 8px;
      margin-top: 6px;
      cursor: pointer;
      font-weight: 500;
      transition: all 0.15s ease;
    }
    .cart-item-remove-btn:hover {
      background: rgba(239, 68, 68, 0.18);
      color: #dc2626;
    }

    /* Tablet Responsive (< 992px) */
    @media (max-width: 991.98px) {
      body.page-cart .cart-layout {
        grid-template-columns: 1fr !important;
        gap: 24px;
      }
    }

    /* Mobile Responsive (< 768px) */
    @media (max-width: 767.98px) {
      body.page-cart .cart-list-card,
      body.page-cart .cart-summary-card {
        padding: 18px 14px !important;
        border-radius: 16px;
      }
      body.page-cart .cart-section-heading {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }
      body.page-cart .cart-section-heading h2 {
        font-size: 1.3rem;
      }
    }

    /* Small Mobile Responsive (< 576px) */
    @media (max-width: 575.98px) {
      .cart-item-row {
        flex-direction: column;
        align-items: stretch;
        padding: 12px;
        gap: 10px;
      }
      .cart-item-main {
        align-items: flex-start;
        gap: 12px;
      }
      .cart-item-thumb-box {
        width: 84px;
        height: 68px;
        min-width: 84px;
        border-radius: 8px;
      }
      .cart-item-title {
        font-size: 0.92rem;
      }
      .cart-item-meta {
        font-size: 0.72rem;
        gap: 6px;
      }
      .cart-item-price-col {
        width: 100%;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        padding-top: 8px;
        margin-top: 2px;
        border-top: 1px dashed rgba(11, 45, 91, 0.12);
      }
      .cart-item-price {
        font-size: 1.05rem;
      }
      .cart-item-remove-btn {
        margin-top: 0;
        padding: 4px 10px;
      }
    }
  </style>
@endsection

@section('content')
  @php
    $isLiveDomain = in_array(request()->getHost(), ['photox.co.za', 'www.photox.co.za']);
  @endphp
  <main class="cart-page-main">
    <section class="events-page-hero">
      <div class="container-xl position-relative" style="z-index: 2;">
        <div class="row align-items-center g-4">
          <div class="col-lg-6 hero-intro-col">
            <div class="section-kicker"><span class="live-dot"></span>YOUR CART</div>
            <h1>Keep the moments<br><em>you want to take home.</em></h1>
            <p>Review your selected digital photos below. Clean high-resolution files without watermarks will be delivered instantly upon checkout.</p>
          </div>
          <div class="col-lg-6 hero-banner-col">
            @include('web.partials.hero-partner-frame')
          </div>
        </div>
      </div>
    </section>

    <section class="cart-section py-5">
      <div class="container-xl cart-layout">
        
        <!-- CART ITEMS LIST -->
        <div class="cart-list-card">
          <div class="cart-section-heading">
            <div>
              <span class="panel-label">PHOTO SELECTION</span>
              <h2 id="cartHeading">Your Cart</h2>
            </div>
            <div class="d-flex align-items-center gap-2">
              <span class="cart-count-label" id="cartCountLabel">0 items</span>
              <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill d-none" id="btnClearCart" onclick="clearFullCart()">
                <i class="bi bi-trash3 me-1"></i> Clear all
              </button>
            </div>
          </div>

          <!-- Empty State (Shown when cart is empty) -->
          <div class="cart-empty-state" id="cartEmptyState">
            <i class="bi bi-cart3"></i>
            <h3>No photos added yet</h3>
            @if($isLiveDomain)
              <p>Browse any event gallery and click the cart button on any photo to start your collection.</p>
              <a class="btn btn-lime rounded-pill px-4 mt-2" href="{{ url('/#browse-gallery') }}">
                Browse photos <i class="bi bi-arrow-right ms-2"></i>
              </a>
            @else
              <p>Browse any event gallery and click the cart button on any photo to start your collection, or test payment directly below.</p>
              <div class="d-flex flex-wrap justify-content-center gap-2 mt-3">
                <button type="button" class="btn btn-lime rounded-pill px-4 fw-bold shadow-sm" onclick="loadDemoPhotosAndCheckout()">
                  <i class="bi bi-lightning-charge-fill me-1"></i> Add Demo Photo & Test Yoco Checkout
                </button>
                <a class="btn btn-outline-secondary rounded-pill px-4" href="{{ url('/#browse-gallery') }}">
                  Browse Photos <i class="bi bi-arrow-right ms-1"></i>
                </a>
              </div>
            @endif
          </div>

          <!-- Items Container (Populated dynamically via JS) -->
          <div id="cartItemsContainer" class="mt-3 d-none">
            <!-- Dynamic Rows Injected Here -->
          </div>
        </div>

        <!-- ORDER SUMMARY -->
        <aside class="cart-summary-card">
          <span class="panel-label">ORDER SUMMARY</span>
          <h2>Ready when you are.</h2>
          <div class="summary-line">
            <span>Photos selected</span>
            <strong id="summaryPhotoCount">0</strong>
          </div>
          <div class="summary-line">
            <span>Subtotal</span>
            <strong id="summarySubtotal">R0.00</strong>
          </div>
          <div class="summary-total">
            <span>Total</span>
            <strong class="text-primary fs-4" id="summaryTotal">R0.00</strong>
          </div>

          <button type="button" class="btn btn-lime rounded-pill w-100 mt-3 py-2 fw-bold" id="btnContinueCheckout" onclick="proceedToYocoCheckout()">
            Continue to checkout <i class="bi bi-arrow-right ms-1"></i>
          </button>

          <a href="{{ url('/#browse-gallery') }}" class="btn btn-outline-secondary rounded-pill w-100 mt-2 py-2 text-decoration-none" style="font-size: 0.85rem;">
            <i class="bi bi-search me-1"></i> Continue browsing
          </a>

          <p class="summary-note mt-3">
            <i class="bi bi-shield-check text-success"></i> Instant clean high-resolution download upon checkout. 100% secure payment via Yoco.
          </p>
        </aside>

      </div>
    </section>

    <!-- SPONSORED BANNER -->
    <div class="container-xl my-4">
      @include('web.partials.site-ad-banner')
    </div>
  </main>

  <!-- CHECKOUT SUCCESS / SIMULATION MODAL -->
  <div class="modal fade" id="cartCheckoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-4 border-0 shadow-lg text-dark bg-white overflow-hidden">
        <div class="modal-header border-0 pb-0">
          <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2">
            <i class="bi bi-bag-check-fill text-success fs-4"></i> Checkout Complete
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body py-4 text-center">
          <div class="rounded-circle bg-success bg-opacity-10 text-success d-inline-flex p-3 mb-3">
            <i class="bi bi-check-circle-fill" style="font-size: 3rem;"></i>
          </div>
          <h4 class="fw-bold mb-2">Order Confirmed!</h4>
          <p class="text-muted small mb-4" id="checkoutModalMessage">
            Your high-resolution unwatermarked files are prepared. In production, this completes payment via Yoco and provides your download bundle.
          </p>
          <div class="p-3 bg-light rounded-3 text-start mb-3 border">
            <div class="d-flex justify-content-between mb-1 small">
              <span class="text-muted">Total Paid:</span>
              <strong id="modalTotalPaid">R0.00</strong>
            </div>
            <div class="d-flex justify-content-between small">
              <span class="text-muted">Delivery:</span>
              <span class="text-success fw-semibold">Instant High-Res ZIP</span>
            </div>
          </div>
          <button type="button" class="btn btn-lime rounded-pill w-100 py-2 fw-semibold" onclick="finishCheckoutAndClear()">
            Download ZIP & Clear Cart
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- PHOTO FULL VIEW LIGHTBOX MODAL -->
  <div class="modal fade" id="cartPhotoPreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content rounded-4 border-0 shadow-2xl bg-dark text-white overflow-hidden" style="background: #091220 !important;">
        <div class="modal-header border-0 pb-0">
          <div class="d-flex align-items-center gap-2">
            <span class="badge bg-warning text-dark font-monospace" id="cartPreviewModalLicense">Personal License</span>
            <span class="fw-bold text-white fs-6" id="cartPreviewModalTitle">Photo Preview</span>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center p-3">
          <div style="max-height: 70vh; display: flex; align-items: center; justify-content: center; background: #030810; border-radius: 12px; overflow: hidden; padding: 10px;">
            <img src="" id="cartPreviewModalImg" alt="Selected photo" style="max-width: 100%; max-height: 65vh; width: auto; height: auto; object-fit: contain; border-radius: 6px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
          </div>
          <div class="d-flex justify-content-between align-items-center mt-3 px-2">
            <span class="text-white-50 small"><i class="bi bi-shield-check text-success me-1"></i> Full clean unwatermarked master file delivered on checkout</span>
            <strong class="text-warning fs-5" id="cartPreviewModalPrice">R75.00</strong>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    function renderCartPage() {
      if (!window.PhotoXCart) return;

      const items = window.PhotoXCart.getItems();
      const emptyState = document.getElementById('cartEmptyState');
      const container = document.getElementById('cartItemsContainer');
      const heading = document.getElementById('cartHeading');
      const countLabel = document.getElementById('cartCountLabel');
      const summaryCount = document.getElementById('summaryPhotoCount');
      const summarySubtotal = document.getElementById('summarySubtotal');
      const summaryTotal = document.getElementById('summaryTotal');
      const btnCheckout = document.getElementById('btnContinueCheckout');
      const btnClear = document.getElementById('btnClearCart');

      if (!items || items.length === 0) {
        if (emptyState) emptyState.classList.remove('d-none');
        if (container) {
          container.classList.add('d-none');
          container.innerHTML = '';
        }
        if (heading) heading.textContent = 'Your cart is empty';
        if (countLabel) countLabel.textContent = '0 items';
        if (summaryCount) summaryCount.textContent = '0';
        if (summarySubtotal) summarySubtotal.textContent = 'R0.00';
        if (summaryTotal) summaryTotal.textContent = 'R0.00';
        if (btnCheckout) {
          btnCheckout.classList.add('disabled');
          btnCheckout.setAttribute('aria-disabled', 'true');
        }
        if (btnClear) btnClear.classList.add('d-none');
        return;
      }

      // We have items!
      if (emptyState) emptyState.classList.add('d-none');
      if (container) container.classList.remove('d-none');
      if (btnClear) btnClear.classList.remove('d-none');
      if (heading) heading.textContent = 'Your Selected Photos';
      if (countLabel) countLabel.textContent = `${items.length} ${items.length === 1 ? 'item' : 'items'}`;

      let total = 0;
      let html = '';

      items.forEach((item, index) => {
        const itemPrice = parseFloat(item.price) || 75.0;
        total += itemPrice;

        const thumbSrc = item.image || 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=300&q=80';

        const rawTitle = (item.title || 'Photo').trim();
        const isRawFile = /^(clint|dsc|img|samples|cruiser|safariprojek|p\d+|\d+)/i.test(rawTitle)
          || /\.(jpg|jpeg|png|webp|cr2|nef|arw|dng|raw)$/i.test(rawTitle)
          || /-\d{3,}/.test(rawTitle);
        const displayItemTitle = isRawFile ? `${item.eventTitle || 'Event'} · Photo #${item.id}` : rawTitle;

        html += `
          <div class="cart-item-row" id="cartRow_${item.id}_${item.licenseType}">
            <div class="cart-item-main">
              <div class="cart-item-thumb-box" onclick="previewCartPhoto('${thumbSrc}', '${displayItemTitle.replace(/'/g, "\\'")}', '${(item.licenseName || '').replace(/'/g, "\\'")}', 'R${itemPrice.toFixed(2)}')" title="Click to view full photo">
                <img src="${thumbSrc}" alt="${displayItemTitle}" class="cart-item-thumb" loading="lazy">
              </div>
              <div class="cart-item-info">
                <div class="cart-item-title">
                  <span>${displayItemTitle}</span>
                  <span class="badge bg-secondary bg-opacity-25 text-dark font-monospace" style="font-size: 0.68rem; font-weight: 600;">
                    ${item.licenseName || 'Personal License'}
                  </span>
                  ${(purchasedPhotoIds && (purchasedPhotoIds.includes(parseInt(item.id)) || purchasedPhotoIds.includes(String(item.id)))) ? '<span class="badge bg-info bg-opacity-25 text-primary ms-1" style="font-size: 0.68rem;"><i class="bi bi-patch-check-fill me-1"></i>In Your Vault</span>' : ''}
                </div>
                <div class="cart-item-meta">
                  <span><i class="bi bi-calendar-event me-1"></i>${item.eventTitle || 'Event Gallery'}</span>
                  <span><i class="bi bi-camera me-1"></i>${item.photographer || 'PhotoX Creator'}</span>
                  <span class="badge bg-light text-muted border">High-Res Unwatermarked</span>
                </div>
              </div>
            </div>
            <div class="cart-item-price-col">
              <div class="cart-item-price">R${itemPrice.toFixed(2)}</div>
              <button type="button" class="cart-item-remove-btn" onclick="removeSingleItem('${item.id}', '${item.licenseType}')" title="Remove from cart">
                <i class="bi bi-trash3"></i><span>Remove</span>
              </button>
            </div>
          </div>
        `;
      });

      if (container) container.innerHTML = html;

      // Update Summary
      if (summaryCount) summaryCount.textContent = items.length;
      if (summarySubtotal) summarySubtotal.textContent = `R${total.toFixed(2)}`;
      if (summaryTotal) summaryTotal.textContent = `R${total.toFixed(2)}`;
      if (btnCheckout) {
        btnCheckout.classList.remove('disabled');
        btnCheckout.removeAttribute('aria-disabled');
      }
    }

    function removeSingleItem(id, licenseType) {
      if (!window.PhotoXCart) return;
      window.PhotoXCart.removeItem(id, licenseType);
      renderCartPage();
      if (typeof showToast === 'function') {
        showToast('Item removed from your cart.');
      }
    }

    function clearFullCart() {
      if (!confirm('Are you sure you want to remove all items from your cart?')) return;
      if (!window.PhotoXCart) return;
      window.PhotoXCart.clear();
      renderCartPage();
      if (typeof showToast === 'function') {
        showToast('Cart cleared.');
      }
    }

    function proceedToYocoCheckout() {
      // Proceed to full Yoco payment checkout
      if (window.PhotoXCart) {
        const items = window.PhotoXCart.getItems();
        if (!items || items.length === 0) {
          window.PhotoXCart.addItem({
            id: '1',
            title: 'Cape Town Marathon - High Speed Capture #01',
            price: '75.00',
            licenseType: 'personal',
            licenseName: 'Personal Digital License',
            image: 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=600&q=80',
            eventTitle: 'Cape Town Marathon 2026',
            photographer: 'Sipho Dlamini'
          });
        }
      }
      window.location.href = "{{ route('checkout') }}";
    }

    function proceedToCheckoutModal() {
      if (!window.PhotoXCart) return;
      const items = window.PhotoXCart.getItems();
      if (!items.length) {
        if (typeof showToast === 'function') {
          showToast('Please add at least one photo from the gallery.');
        }
        return;
      }

      const total = items.reduce((sum, item) => sum + (parseFloat(item.price) || 0), 0);
      const modalTotalPaid = document.getElementById('modalTotalPaid');
      if (modalTotalPaid) modalTotalPaid.textContent = `R${total.toFixed(2)}`;

      const modalEl = document.getElementById('cartCheckoutModal');
      if (modalEl) {
        const modal = new bootstrap.Modal(modalEl);
        modal.show();
      }
    }

    function finishCheckoutAndClear() {
      if (window.PhotoXCart) {
        window.PhotoXCart.clear();
      }
      const modalEl = document.getElementById('cartCheckoutModal');
      if (modalEl) {
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();
      }
      renderCartPage();
      if (typeof showToast === 'function') {
        showToast('✓ Thank you! Download bundle initiated.');
      }
    }

    function loadDemoPhotosAndCheckout() {
      if (window.PhotoXCart) {
        window.PhotoXCart.addItem({
          id: '1',
          title: 'Cape Town Marathon - High Speed Capture #01',
          price: '75.00',
          licenseType: 'personal',
          licenseName: 'Personal Digital License',
          image: 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=600&q=80',
          eventTitle: 'Cape Town Marathon 2026',
          photographer: 'Sipho Dlamini'
        });
      }
      window.location.href = "{{ route('checkout') }}";
    }

    function previewCartPhoto(src, title, license, price) {
      const modalEl = document.getElementById('cartPhotoPreviewModal');
      if (!modalEl) return;
      const imgEl = document.getElementById('cartPreviewModalImg');
      if (imgEl) imgEl.src = src;
      const titleEl = document.getElementById('cartPreviewModalTitle');
      if (titleEl) titleEl.textContent = title;
      const licenseEl = document.getElementById('cartPreviewModalLicense');
      if (licenseEl) licenseEl.textContent = license;
      const priceEl = document.getElementById('cartPreviewModalPrice');
      if (priceEl) priceEl.textContent = price;

      const modal = new bootstrap.Modal(modalEl);
      modal.show();
    }

    const purchasedPhotoIds = @json($purchasedPhotoIds ?? []);

    document.addEventListener('DOMContentLoaded', function() {
      // 1. Clear cart only after explicit successful payment redirect
      const params = new URLSearchParams(window.location.search);
      const shouldClear = params.get('status') === 'success';
      if (shouldClear) {
        try {
          localStorage.removeItem('photox_user_cart');
          localStorage.removeItem('photox_cart');
        } catch(e) {}
        if (window.PhotoXCart) {
          window.PhotoXCart.clear();
          window.PhotoXCart.updateBadge();
        }
      }

      renderCartPage();
    });
  </script>
@endsection
