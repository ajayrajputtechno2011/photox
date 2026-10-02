@extends('web.layouts.app')

@section('title', 'PhotoX | Yoco Payment Gateway Testing Sandbox')
@section('body-class', 'page-yoco-test bg-light')

@section('styles')
<style>
  .yoco-sandbox-card {
    background: #ffffff;
    border-radius: 16px;
    border: 1px solid rgba(11, 45, 91, 0.08);
    box-shadow: 0 10px 30px rgba(11, 45, 91, 0.06);
    overflow: hidden;
  }
  .yoco-badge-mode {
    background: #00d2d3;
    color: #0b1a29;
    font-weight: 800;
    font-size: 0.72rem;
    letter-spacing: 0.06em;
    padding: 4px 10px;
    border-radius: 20px;
  }
  .test-card-box {
    background: linear-gradient(135deg, #0984e3, #00cec9);
    color: #ffffff;
    border-radius: 14px;
    padding: 20px;
    box-shadow: 0 8px 24px rgba(9, 132, 227, 0.25);
    position: relative;
    overflow: hidden;
  }
  .test-card-box::after {
    content: "YOCO TEST";
    position: absolute;
    right: -15px;
    bottom: -15px;
    font-size: 3rem;
    font-weight: 900;
    color: rgba(255, 255, 255, 0.12);
    pointer-events: none;
  }
  .amount-option-card {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 14px;
    cursor: pointer;
    transition: all 0.2s ease;
  }
  .amount-option-card:hover {
    border-color: #0984e3;
    background: #f8fafc;
  }
  .amount-option-card.selected {
    border-color: #0984e3;
    background: rgba(9, 132, 227, 0.05);
  }
</style>
@endsection

@section('content')
<main class="py-5">
  <div class="container-xl">

    <!-- Top Breadcrumb & Title -->
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
      <div>
        <div class="d-flex align-items-center gap-2 mb-1">
          <span class="yoco-badge-mode"><i class="bi bi-shield-check me-1"></i> YOCO SANDBOX (TEST MODE)</span>
          <span class="badge bg-dark text-white font-monospace">API v1</span>
        </div>
        <h1 class="h2 fw-bold text-dark mb-0">Yoco Payment Gateway Testing Suite</h1>
        <p class="text-muted small mb-0">Test real payment processing flows with South African Rand (ZAR) before launching to production.</p>
      </div>

      <div class="d-flex align-items-center gap-2">
        <a href="/" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
          <i class="bi bi-arrow-left me-1"></i> Back to Home
        </a>
      </div>
    </div>

    <!-- Status Alert if redirected from Yoco -->
    @if(request('status') === 'success')
      <div class="alert alert-success border-success bg-success bg-opacity-10 d-flex align-items-center gap-3 p-3 rounded-4 mb-4 shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill fs-2 text-success"></i>
        <div>
          <h5 class="fw-bold text-success mb-1">Yoco Payment Successful!</h5>
          <p class="small text-dark mb-0">The hosted checkout transaction was approved by Yoco Sandbox. Your order is confirmed.</p>
          @if(isset($checkoutData) && $checkoutData)
            <div class="mt-2 font-monospace small bg-white p-2 rounded border">
              <strong>Checkout ID:</strong> {{ $checkoutData['id'] ?? '' }} &nbsp;|&nbsp; 
              <strong>Amount:</strong> R{{ number_format(($checkoutData['amount'] ?? 0) / 100, 2) }} {{ $checkoutData['currency'] ?? 'ZAR' }} &nbsp;|&nbsp;
              <strong>Status:</strong> <span class="badge bg-success">{{ $checkoutData['status'] ?? 'completed' }}</span>
            </div>
          @endif
        </div>
      </div>
    @elseif(request('status') === 'cancelled')
      <div class="alert alert-warning border-warning bg-warning bg-opacity-10 d-flex align-items-center gap-3 p-3 rounded-4 mb-4 shadow-sm" role="alert">
        <i class="bi bi-exclamation-triangle-fill fs-2 text-warning"></i>
        <div>
          <h5 class="fw-bold text-dark mb-1">Yoco Checkout Cancelled</h5>
          <p class="small text-muted mb-0">The customer cancelled the payment session before entering card details.</p>
        </div>
      </div>
    @elseif(request('status') === 'failed' || request('status') === 'error')
      <div class="alert alert-danger border-danger bg-danger bg-opacity-10 d-flex align-items-center gap-3 p-3 rounded-4 mb-4 shadow-sm" role="alert">
        <i class="bi bi-x-circle-fill fs-2 text-danger"></i>
        <div>
          <h5 class="fw-bold text-danger mb-1">Payment Failed or Declined</h5>
          <p class="small text-dark mb-0">{{ session('error') ?: 'The transaction could not be processed. Please check card credentials.' }}</p>
        </div>
      </div>
    @endif

    <div class="row g-4">
      
      <!-- LEFT COLUMN: Payment Execution Modes -->
      <div class="col-lg-7">
        
        <!-- MODE 1: YOCO HOSTED CHECKOUT (Recommended) -->
        <div class="yoco-sandbox-card p-4 mb-4">
          <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3">
            <div>
              <span class="badge bg-primary bg-opacity-10 text-primary fw-bold mb-1">RECOMMENDED FLOW</span>
              <h4 class="fw-bold text-dark mb-0">1. Yoco Hosted Checkout</h4>
              <p class="text-muted small mb-0">Redirects customer to Yoco's official secure payment page and returns back.</p>
            </div>
            <img src="https://images.unsplash.com/photo-1556742049-0a67c5574f73?auto=format&fit=crop&w=80&q=80" class="rounded-circle border" style="width: 44px; height: 44px; object-fit: cover;" alt="Secure Yoco">
          </div>

          <form action="{{ route('yoco.checkout.create') }}" method="POST" id="yocoHostedForm">
            @csrf
            
            <label class="form-label fw-bold text-dark small text-uppercase">Select Test Product / Fee:</label>
            <div class="row g-2 mb-3">
              <div class="col-sm-6">
                <div class="amount-option-card selected" onclick="selectAmountOption(this, 50, 'High-Res Photo Download License')">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <strong class="d-block text-dark">Photo Download</strong>
                      <small class="text-muted">Single digital master</small>
                    </div>
                    <span class="fw-bold text-primary fs-5">R50.00</span>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="amount-option-card" onclick="selectAmountOption(this, 199, 'Standard Photographer Membership')">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <strong class="d-block text-dark">Standard Tier</strong>
                      <small class="text-muted">Monthly membership</small>
                    </div>
                    <span class="fw-bold text-primary fs-5">R199.00</span>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="amount-option-card" onclick="selectAmountOption(this, 399, 'Pro Photographer Membership')">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <strong class="d-block text-dark">Pro Tier</strong>
                      <small class="text-muted">High storage & 10% comm</small>
                    </div>
                    <span class="fw-bold text-primary fs-5">R399.00</span>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="amount-option-card" onclick="selectCustomAmount(this)">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <strong class="d-block text-dark">Custom Amount</strong>
                      <small class="text-muted">Enter custom ZAR</small>
                    </div>
                    <span class="fw-bold text-secondary fs-6">Custom</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Amount Input -->
            <div class="mb-3">
              <label for="yocoAmountInput" class="form-label fw-bold small text-muted">Amount to Charge (ZAR):</label>
              <div class="input-group">
                <span class="input-group-text bg-white fw-bold">R</span>
                <input type="number" step="1" min="2" class="form-control form-control-lg fw-bold" id="yocoAmountInput" name="amount" value="50" required>
              </div>
            </div>

            <input type="hidden" name="product_name" id="yocoProductName" value="High-Res Photo Download License">

            <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill fw-bold shadow py-3">
              <i class="bi bi-shield-lock-fill me-2"></i> Pay with Yoco Hosted Checkout →
            </button>
            <p class="text-center text-muted small mt-2 mb-0">
              <i class="bi bi-lock me-1"></i> Secure 256-bit SSL encrypted via official Yoco Checkout API
            </p>
          </form>
        </div>

        <!-- MODE 2: YOCO POPUP MODAL (Web SDK) -->
        <div class="yoco-sandbox-card p-4">
          <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3">
            <div>
              <span class="badge bg-secondary bg-opacity-10 text-secondary fw-bold mb-1">SDK POPUP FLOW</span>
              <h4 class="fw-bold text-dark mb-0">2. Yoco Popup Web SDK</h4>
              <p class="text-muted small mb-0">Opens Yoco's inline modal directly on page without redirecting.</p>
            </div>
            <i class="bi bi-window-stack fs-2 text-muted"></i>
          </div>

          <p class="text-muted small">
            Click the button below to trigger Yoco's JavaScript popup modal on this page. Enter the test card details provided on the right.
          </p>

          <button type="button" class="btn btn-dark btn-lg w-100 rounded-pill fw-bold shadow py-3" onclick="triggerYocoSdkPopup()">
            <i class="bi bi-credit-card-2-front-fill me-2"></i> Open Yoco SDK Popup Modal
          </button>

          <!-- Live Result Box for SDK -->
          <div id="sdkResultBox" class="mt-3 d-none">
            <div class="p-3 rounded-3 border bg-light font-monospace small" id="sdkResultContent"></div>
          </div>
        </div>

      </div>

      <!-- RIGHT COLUMN: Test Card & Credentials Info -->
      <div class="col-lg-5">
        
        <!-- Test Card Details (Client Screenshot Card) -->
        <div class="test-card-box mb-4">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="fw-bold fs-4" style="letter-spacing: 0.1em;">YOCO</span>
            <span class="badge bg-white text-primary fw-bold">Test card</span>
          </div>

          <div class="my-4">
            <label class="d-block small text-white text-opacity-75 mb-1">CARD NUMBER</label>
            <div class="d-flex align-items-center justify-content-between">
              <h3 class="font-monospace fw-bold mb-0 text-white" id="testCardNumber">4111 1111 1111 1111</h3>
              <button class="btn btn-sm btn-light py-0 px-2 rounded-pill shadow-sm" type="button" onclick="copyText('4111111111111111', this)">
                <i class="bi bi-copy"></i>
              </button>
            </div>
          </div>

          <div class="row pt-2 border-top border-white border-opacity-25">
            <div class="col-6">
              <span class="d-block small text-white text-opacity-75">EXPIRY</span>
              <strong class="font-monospace fs-5">10/27</strong>
            </div>
            <div class="col-6">
              <span class="d-block small text-white text-opacity-75">CVV</span>
              <strong class="font-monospace fs-5">123</strong>
            </div>
          </div>
        </div>

        <!-- Credentials Info Box -->
        <div class="yoco-sandbox-card p-4 mb-4">
          <h5 class="fw-bold text-dark mb-3"><i class="bi bi-key-fill text-warning me-2"></i>Active Credentials</h5>
          
          <div class="mb-3">
            <label class="form-label small text-muted fw-bold mb-1">Public Key:</label>
            <div class="input-group input-group-sm">
              <input type="text" class="form-control font-monospace bg-light" value="{{ $publicKey }}" readonly>
              <button class="btn btn-outline-secondary" type="button" onclick="copyText('{{ $publicKey }}', this)">
                <i class="bi bi-copy"></i>
              </button>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label small text-muted fw-bold mb-1">Secret Key:</label>
            <div class="input-group input-group-sm">
              <input type="text" class="form-control font-monospace bg-light" value="{{ substr($secretKey, 0, 10) }}••••••••••••••••" readonly>
              <span class="input-group-text bg-success bg-opacity-10 text-success fw-bold">Active</span>
            </div>
          </div>

          <div class="p-3 rounded-3 bg-light border small text-muted">
            <i class="bi bi-info-circle-fill text-primary me-1"></i>
            These are the test credentials provided by your Yoco merchant account. Live transactions will not be charged on this test card.
          </div>
        </div>

        <!-- How It Works Note -->
        <div class="yoco-sandbox-card p-4">
          <h5 class="fw-bold text-dark mb-2"><i class="bi bi-diagram-3-fill text-primary me-2"></i>Testing Checklist</h5>
          <ul class="list-unstyled small text-muted mb-0">
            <li class="py-1 d-flex align-items-start gap-2">
              <i class="bi bi-check-circle-fill text-success mt-1"></i>
              <span><strong>Create Session:</strong> Backend creates checkout with Yoco's ZAR currency API.</span>
            </li>
            <li class="py-1 d-flex align-items-start gap-2">
              <i class="bi bi-check-circle-fill text-success mt-1"></i>
              <span><strong>Redirect to Yoco:</strong> Customer enters test card securely on Yoco.</span>
            </li>
            <li class="py-1 d-flex align-items-start gap-2">
              <i class="bi bi-check-circle-fill text-success mt-1"></i>
              <span><strong>Return to PhotoX:</strong> Customer is redirected back with confirmation receipt.</span>
            </li>
          </ul>
        </div>

      </div>

    </div>

  </div>
</main>
@endsection

@section('scripts')
<!-- Official Yoco Web SDK -->
<script src="https://js.yoco.com/sdk/v1/yoco-sdk-web.js"></script>
<script>
  // Amount selection helper
  function selectAmountOption(el, amount, productName) {
    document.querySelectorAll('.amount-option-card').forEach(card => card.classList.remove('selected'));
    el.classList.add('selected');
    document.getElementById('yocoAmountInput').value = amount;
    document.getElementById('yocoProductName').value = productName;
  }

  function selectCustomAmount(el) {
    document.querySelectorAll('.amount-option-card').forEach(card => card.classList.remove('selected'));
    el.classList.add('selected');
    const input = document.getElementById('yocoAmountInput');
    input.focus();
    input.select();
    document.getElementById('yocoProductName').value = 'PhotoX Custom Payment';
  }

  function copyText(text, btn) {
    navigator.clipboard.writeText(text);
    const original = btn.innerHTML;
    btn.innerHTML = '<i class="bi bi-check2 text-success"></i>';
    setTimeout(() => { btn.innerHTML = original; }, 1500);
  }

  // --- Yoco Web SDK Popup Execution ---
  const yocoPublicKey = "{{ $publicKey }}";
  let yoco = null;

  try {
    if (window.YocoSDK) {
      yoco = new window.YocoSDK({ publicKey: yocoPublicKey });
    }
  } catch (e) {
    console.warn('Yoco SDK init error:', e);
  }

  function triggerYocoSdkPopup() {
    if (!yoco) {
      alert('Yoco SDK is still loading or unavailable. Please try again.');
      return;
    }

    const amountInRands = parseFloat(document.getElementById('yocoAmountInput').value || 50);
    const amountInCents = Math.round(amountInRands * 100);
    const productName = document.getElementById('yocoProductName').value;

    const resultBox = document.getElementById('sdkResultBox');
    const resultContent = document.getElementById('sdkResultContent');

    yoco.showPopup({
      amountInCents: amountInCents,
      currency: 'ZAR',
      name: 'PhotoX Marketplace',
      description: productName,
      callback: function (result) {
        resultBox.classList.remove('d-none');
        if (result.error) {
          resultContent.innerHTML = `<span class="text-danger">❌ Error: ${result.error.message}</span>`;
        } else {
          resultContent.innerHTML = `<span class="text-primary">⏳ Token created: <strong>${result.id}</strong>. Charging backend...</span>`;
          
          // Send token to server for processing
          fetch('{{ route("yoco.charge.token") }}', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
              token: result.id,
              amountInCents: amountInCents,
              currency: 'ZAR'
            })
          })
          .then(res => res.json())
          .then(data => {
            if (data.success) {
              resultContent.innerHTML = `
                <div class="text-success mb-2">✅ <strong>Payment Successful via SDK!</strong></div>
                <div>Charge ID: <strong>${data.data.id || 'N/A'}</strong></div>
                <div>Status: <strong>${data.data.status}</strong></div>
                <div>Amount: <strong>R${(data.data.amountInCents / 100).toFixed(2)}</strong></div>
                <pre class="mt-2 text-dark bg-white p-2 rounded">${JSON.stringify(data.data, null, 2)}</pre>
              `;
            } else {
              resultContent.innerHTML = `<span class="text-danger">❌ Server Charge Failed: ${data.message}</span>`;
            }
          })
          .catch(err => {
            resultContent.innerHTML = `<span class="text-danger">❌ Network Error: ${err.message}</span>`;
          });
        }
      }
    });
  }
</script>
@endsection
