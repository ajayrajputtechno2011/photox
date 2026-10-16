@if(auth()->check() && !auth()->user()->hasVerifiedEmail())
  <div class="alert alert-warning border-0 shadow-sm rounded-4 p-3 mb-4 d-flex flex-wrap align-items-center justify-content-between gap-3" style="background: linear-gradient(90deg, rgba(234, 179, 8, 0.15), rgba(245, 158, 11, 0.08)); border-left: 4px solid #eab308 !important;">
    <div class="d-flex align-items-start gap-3">
      <div class="p-2 rounded-circle bg-warning text-dark flex-shrink-0 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
        <i class="bi bi-shield-exclamation fs-5"></i>
      </div>
      <div>
        <div class="d-flex align-items-center gap-2">
          <strong class="text-dark fw-bold">POPIA Compliance Notice</strong>
          <span class="badge bg-warning text-dark rounded-pill" style="font-size: 0.65rem;">Unverified</span>
        </div>
        <p class="mb-0 text-muted small mt-1">
          Your email address (<strong>{{ auth()->user()->email }}</strong>) has not been verified yet. Under South Africa's POPIA Act, please verify your email to secure your account and access downloads.
        </p>
      </div>
    </div>
    <div class="d-flex align-items-center gap-2 ms-auto ms-sm-0">
      <form method="POST" action="{{ route('verification.send') }}" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-warning btn-sm rounded-pill px-3 fw-semibold shadow-sm d-flex align-items-center gap-1">
          <i class="bi bi-send-fill" style="font-size: 0.75rem;"></i>
          <span>Resend Email</span>
        </button>
      </form>
      <a href="{{ route('verification.notice') }}" class="btn btn-outline-dark btn-sm rounded-pill px-3">
        Details
      </a>
    </div>
  </div>
@endif
