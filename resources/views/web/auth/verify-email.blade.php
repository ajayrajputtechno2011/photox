@extends('web.layouts.app')

@section('title', 'PhotoX | Verify Your Email')
@section('body-class', 'page-login')

@section('content')
  <main class="login-page py-5">
    <div class="login-shell" style="max-width: 960px; margin: 0 auto;">
      <section class="login-visual" aria-label="PhotoX POPIA Verification" style="background: radial-gradient(circle at top right, rgba(234, 179, 8, 0.15), transparent 70%), #111827;">
        <div class="login-count d-flex align-items-center gap-2">
          <i class="bi bi-shield-check text-warning fs-5"></i>
          <span>POPIA Compliance & Account Security</span>
        </div>
        <div>
          <h1>Verify your<br><em style="color: #eab308;">email address.</em></h1>
          <p class="login-quote mt-4">
            Under South Africa's <strong>Protection of Personal Information Act (POPIA)</strong>, we ensure that every account owner authenticates their contact information before accessing private event albums and financial transactions.
          </p>
        </div>
        <div class="d-flex justify-content-between align-items-end">
          <span class="login-count">Safe. Compliant. Verified.</span>
          <i class="bi bi-check-circle-fill fs-3 text-warning"></i>
        </div>
      </section>

      <section class="login-form-panel p-4 p-md-5">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-warning-subtle text-warning fw-semibold small mb-3 border border-warning-subtle">
          <i class="bi bi-envelope-exclamation"></i>
          <span>Verification Pending</span>
        </div>

        <h2 class="h3 fw-bold mb-2">Check your inbox</h2>
        <p class="text-secondary small mb-4">
          We have dispatched a verification link to <strong class="text-white">{{ auth()->user()->email }}</strong>. Please click the link inside that email to activate your account.
        </p>

        @if (session('status'))
          <div class="alert alert-success rounded-4 border-0 shadow-sm py-3 px-4 small d-flex align-items-center gap-3 mb-4" style="background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.3) !important; color: #86efac;">
            <i class="bi bi-check2-circle fs-4 text-success flex-shrink-0"></i>
            <div>{{ session('status') }}</div>
          </div>
        @endif

        @if ($errors->any())
          <div class="alert alert-danger rounded-4 border-0 shadow-sm py-3 px-4 small d-flex align-items-center gap-3 mb-4" style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3) !important; color: #fca5a5;">
            <i class="bi bi-exclamation-octagon-fill fs-4 text-danger flex-shrink-0"></i>
            <div>{{ $errors->first() }}</div>
          </div>
        @endif

        <div class="p-4 rounded-4 mb-4" style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08);">
          <div class="d-flex align-items-start gap-3">
            <div class="p-2 rounded-3 bg-dark text-warning border border-secondary border-opacity-25 flex-shrink-0">
              <i class="bi bi-info-circle fs-5"></i>
            </div>
            <div class="small text-secondary">
              <strong class="text-white d-block mb-1">Haven't received the email yet?</strong>
              Check your Spam/Junk folder. If it hasn't arrived within 2 minutes, you can click below to request a new link.
            </div>
          </div>
        </div>

        <div class="d-flex flex-column flex-sm-row align-items-center gap-3">
          <form method="POST" action="{{ route('verification.send') }}" class="w-100 w-sm-auto">
            @csrf
            <button type="submit" class="btn btn-warning w-100 px-4 py-2 fw-semibold rounded-pill d-flex align-items-center justify-content-center gap-2">
              <i class="bi bi-send-fill"></i>
              <span>Resend Verification Email</span>
            </button>
          </form>

          <a href="{{ auth()->user()->role === 'photographer' ? url('/photographer-dashboard') : url('/customer-dashboard') }}" class="btn btn-outline-secondary w-100 w-sm-auto px-4 py-2 rounded-pill text-nowrap">
            Continue to Dashboard
          </a>
        </div>

        <div class="mt-4 pt-4 border-top border-secondary border-opacity-25 d-flex justify-content-between align-items-center small text-secondary">
          <span>Wrong account?</span>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link text-secondary p-0 text-decoration-none small hover-underline">
              <i class="bi bi-box-arrow-right me-1"></i>Sign out
            </button>
          </form>
        </div>
      </section>
    </div>
  </main>
@endsection
