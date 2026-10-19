@extends('web.layouts.app')

@section('title', 'PhotoX | Secure Checkout')
@section('body-class', 'page-checkout')

@section('styles')
  <style>
    .checkout-layout {
      display: grid;
      grid-template-columns: 1fr 380px;
      gap: 32px;
      align-items: start;
    }
    @media (max-width: 991.98px) {
      .checkout-layout {
        grid-template-columns: 1fr;
      }
    }
    .checkout-card {
      background: #ffffff;
      border: 1px solid rgba(11, 45, 91, 0.12);
      border-radius: 16px;
      padding: 24px;
      margin-bottom: 24px;
      box-shadow: 0 4px 16px rgba(11, 45, 91, 0.04);
    }
    .checkout-card-heading {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 20px;
      padding-bottom: 16px;
      border-bottom: 1px solid rgba(11, 45, 91, 0.08);
    }
    .step-number {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: #0b2d5b;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 0.95rem;
      flex-shrink: 0;
    }
    .checkout-card-heading h2 {
      font-size: 1.15rem;
      font-weight: 700;
      color: #0b2d5b;
      margin-bottom: 2px;
    }
    .checkout-card-heading p {
      font-size: 0.82rem;
      color: #64748b;
      margin-bottom: 0;
    }
    .yoco-badge-box {
      background: #f8fafc;
      border: 1.5px solid #0b2d5b;
      border-radius: 12px;
      padding: 16px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
    }
    .summary-item-row {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 0;
      border-bottom: 1px dashed rgba(11, 45, 91, 0.1);
    }
    .summary-item-thumb {
      width: 52px;
      height: 42px;
      border-radius: 6px;
      object-fit: cover;
      background: #081426;
      flex-shrink: 0;
    }
    .summary-total-box {
      padding-top: 16px;
      margin-top: 16px;
      border-top: 2px solid #0b2d5b;
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 1.15rem;
      font-weight: 700;
      color: #0b2d5b;
    }
  </style>
@endsection

@section('content')
  @php
    $nameParts = explode(' ', $user?->name ?? '');
    $firstName = $nameParts[0] ?? '';
    $lastName = isset($nameParts[1]) ? implode(' ', array_slice($nameParts, 1)) : '';
  @endphp

  <main class="checkout-main py-5" style="background: #f4f7fb; min-height: 80vh;">
    <div class="container-xl">
      <div class="mb-4">
        <span class="badge bg-primary-subtle text-primary border px-3 py-2 rounded-pill font-monospace mb-2">SECURE PAYMENT</span>
        <h1 class="h2 fw-bold text-dark">Complete your order</h1>
        <p class="text-secondary">Your photos will be instantly unlocked for high-resolution download upon payment.</p>
      </div>

      @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
          <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="checkout-layout">
        <form class="checkout-form" id="checkoutForm" action="{{ route('checkout.process') }}" method="POST">
          @csrf
          <input type="hidden" name="amount" id="checkoutAmountInput" value="75.00">
          <input type="hidden" name="cart_items" id="checkoutCartItemsInput" value="[]">

          <!-- Step 1: Contact Details -->
          <section class="checkout-card">
            <div class="checkout-card-heading">
              <span class="step-number">1</span>
              <div>
                <h2>Contact details</h2>
                <p>Where should we send your receipt and digital download links?</p>
              </div>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-semibold small text-secondary">First name <span class="text-danger">*</span></label>
                <input class="form-control" name="first_name" type="text" placeholder="e.g. John" value="{{ old('first_name', $firstName) }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold small text-secondary">Last name <span class="text-danger">*</span></label>
                <input class="form-control" name="last_name" type="text" placeholder="e.g. Doe" value="{{ old('last_name', $lastName) }}" required>
              </div>
              <div class="col-12">
                <label class="form-label fw-semibold small text-secondary">Email address <span class="text-danger">*</span></label>
                <input class="form-control" name="email" type="email" placeholder="you@example.com" value="{{ old('email', $user?->email) }}" required>
                <small class="text-muted">High-res download link will be emailed immediately.</small>
              </div>
            </div>
          </section>

          <!-- Step 2: Payment Gateway -->
          <section class="checkout-card">
            <div class="checkout-card-heading">
              <span class="step-number">2</span>
              <div>
                <h2>Payment method</h2>
                <p>Secured with Yoco 256-bit encryption.</p>
              </div>
            </div>

            <div class="yoco-badge-box">
              <div class="d-flex align-items-center gap-3">
                <i class="bi bi-shield-lock-fill fs-2 text-primary"></i>
                <div>
                  <strong class="d-block text-dark">Yoco Secure Payment Gateway</strong>
                  <small class="text-muted">Cards, Visa, Mastercard, Apple Pay &amp; Instant EFT supported.</small>
                </div>
              </div>
              <span class="badge bg-success-subtle text-success border px-3 py-2 rounded-pill font-monospace">ACTIVE</span>
            </div>

            <div class="form-check mt-4">
              <input class="form-check-input" id="termsCheck" name="terms" type="checkbox" required checked>
              <label class="form-check-label small text-secondary" for="termsCheck">
                I agree to PhotoX terms and understand digital photos are delivered immediately after successful payment.
              </label>
            </div>

            <button class="btn btn-lime rounded-pill px-5 py-3 fw-bold w-100 mt-4 d-flex align-items-center justify-content-center gap-2 shadow-sm" id="btnSubmitPayment" type="submit">
              <span>Pay Securely with Yoco &bull;</span>
              <span id="btnPayAmount">R75.00</span>
              <i class="bi bi-arrow-right"></i>
            </button>
          </section>
        </form>

        <!-- Step 3: Order Summary Sidebar -->
        <aside class="checkout-summary">
          <div class="checkout-card">
            <div class="checkout-card-heading">
              <span class="step-number">3</span>
              <div>
                <h2>Order summary</h2>
                <p id="summaryItemsCountLabel">0 photos selected</p>
              </div>
            </div>

            <div id="checkoutItemsList">
              <!-- Dynamically populated from cart -->
            </div>

            <div class="summary-total-box">
              <span>Grand Total</span>
              <span id="checkoutTotalDisplay">R75.00</span>
            </div>
          </div>

          <div class="p-3 bg-white rounded-3 border d-flex align-items-center gap-3">
            <i class="bi bi-patch-check-fill text-success fs-3"></i>
            <div>
              <strong class="small d-block text-dark">Instant Digital Unlock</strong>
              <small class="text-muted">High-resolution files without watermarks.</small>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      let cart = [];
      try {
        if (window.PhotoXCart && window.PhotoXCart.getItems().length > 0) {
          cart = window.PhotoXCart.getItems();
        } else {
          cart = JSON.parse(localStorage.getItem('photox_user_cart') || localStorage.getItem('photox_cart') || '[]');
        }
      } catch (e) {
        cart = [];
      }

      // If cart has items, render them
      const listContainer = document.getElementById('checkoutItemsList');
      const countLabel = document.getElementById('summaryItemsCountLabel');
      const totalDisplay = document.getElementById('checkoutTotalDisplay');
      const btnPayAmount = document.getElementById('btnPayAmount');
      const amountInput = document.getElementById('checkoutAmountInput');
      const itemsInput = document.getElementById('checkoutCartItemsInput');

      let total = 0;
      let html = '';

      if (cart.length > 0) {
        cart.forEach(item => {
          const price = parseFloat(item.price) || 75.0;
          total += price;
          html += `
            <div class="summary-item-row">
              <img src="${item.image || 'https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=300&q=80'}" class="summary-item-thumb" alt="Thumbnail">
              <div class="flex-grow-1 overflow-hidden">
                <strong class="d-block text-truncate small">${item.title || 'Event Photo'}</strong>
                <small class="text-muted font-monospace">${item.licenseName || 'Personal License'}</small>
              </div>
              <strong class="small text-dark">R${price.toFixed(2)}</strong>
            </div>
          `;
        });
      } else {
        // Fallback demo photo so checkout is always testable
        total = 75.0;
        html = `
          <div class="summary-item-row">
            <img src="https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=300&q=80" class="summary-item-thumb" alt="Thumbnail">
            <div class="flex-grow-1 overflow-hidden">
              <strong class="d-block text-truncate small">Cape Town Sports Highlights #01</strong>
              <small class="text-muted font-monospace">Personal License</small>
            </div>
            <strong class="small text-dark">R75.00</strong>
          </div>
        `;
      }

      listContainer.innerHTML = html;
      countLabel.textContent = `${cart.length || 1} photo${(cart.length || 1) === 1 ? '' : 's'} selected`;
      totalDisplay.textContent = `R${total.toFixed(2)}`;
      btnPayAmount.textContent = `R${total.toFixed(2)}`;
      amountInput.value = total.toFixed(2);
      itemsInput.value = JSON.stringify(cart);
    });
  </script>
@endsection
