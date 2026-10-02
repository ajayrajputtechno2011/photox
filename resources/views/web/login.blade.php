@extends('web.layouts.app')

@section('title', 'PhotoX | Log in to your account')
@section('body-class', 'page-login')

@section('content')
  <main class="login-page">
    <div class="login-shell">
      <section class="login-visual" aria-label="PhotoX welcome">
        <div class="login-count">PhotoX / Member access</div>
        <div>
          <h1>Your moments,<br><em>waiting.</em></h1>
          <p class="login-quote mt-4">Sign in to revisit your galleries, track orders, and keep every finish line close.</p>
        </div>
        <div class="d-flex justify-content-between align-items-end">
          <span class="login-count">Find. Feel. Keep.</span>
          <i class="bi bi-arrow-up-right fs-3 text-warning"></i>
        </div>
      </section>

      <section class="login-form-panel">
        <div class="eyebrow-blue">Welcome back</div>
        <h2 class="mt-2">Log in to PhotoX.</h2>
        <p class="login-help mt-2">Access your saved photos and creator workspace.</p>

        <div class="login-tabs mt-4">
          <input checked class="login-tab-input" id="customerTab" name="login-tab" type="radio">
          <label class="login-tab-label" for="customerTab"><i class="bi bi-person-heart"></i> Customer</label>
          <input class="login-tab-input" id="photographerTab" name="login-tab" type="radio">
          <label class="login-tab-label" for="photographerTab"><i class="bi bi-camera"></i> Photographer</label>

          {{-- Customer Login Panel --}}
          <div class="login-tab-panel customer-login-panel">
            <p class="login-tab-help">Sign in to view saved photos, orders and favourite events.</p>
            <form action="{{ route('login.post') }}" method="POST">
              @csrf
              <label class="form-label" for="customerEmail">Email address</label>
              <input class="form-control @error('email') is-invalid @enderror" id="customerEmail" name="email" type="email" placeholder="you@example.com" value="{{ old('email') }}" required autocomplete="email">
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror

              <label class="form-label mt-3" for="customerPassword">Password</label>
              <input class="form-control @error('password') is-invalid @enderror" id="customerPassword" name="password" type="password" placeholder="Enter your password" required autocomplete="current-password">
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror

              <div class="form-check mt-3">
                <input class="form-check-input" id="customerRemember" name="remember" type="checkbox">
                <label class="form-check-label small text-secondary" for="customerRemember">Keep me signed in</label>
              </div>
              <button class="btn login-submit rounded-pill w-100 mt-4" type="submit">Log In as Customer <i class="bi bi-arrow-right ms-2"></i></button>
            </form>
          </div>

          {{-- Photographer Login Panel --}}
          <div class="login-tab-panel photographer-login-panel">
            <p class="login-tab-help">Sign in to manage bookings, galleries, earnings and your creator profile.</p>
            <form action="{{ route('login.post') }}" method="POST">
              @csrf
              <label class="form-label" for="photographerEmail">Photographer email</label>
              <input class="form-control @error('email') is-invalid @enderror" id="photographerEmail" name="email" type="email" placeholder="creator@example.com" value="{{ old('email') }}" required autocomplete="email">
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror

              <label class="form-label mt-3" for="photographerPassword">Password</label>
              <input class="form-control @error('password') is-invalid @enderror" id="photographerPassword" name="password" type="password" placeholder="Enter your password" required autocomplete="current-password">
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror

              <div class="form-check mt-3">
                <input class="form-check-input" id="photographerRemember" name="remember" type="checkbox">
                <label class="form-check-label small text-secondary" for="photographerRemember">Keep me signed in</label>
              </div>
              <button class="btn login-submit rounded-pill w-100 mt-4" type="submit">Log In as Creator <i class="bi bi-arrow-right ms-2"></i></button>
            </form>
          </div>
        </div>

        <div class="login-divider">or continue with</div>
        <button class="btn social-login rounded-pill w-100" type="button" data-toast="Google login integration coming soon"><i class="bi bi-google me-2"></i> Continue with Google</button>
        <p class="text-center login-help mt-4 mb-0">New to PhotoX? <a href="{{ route('signup') }}">Create an account</a></p>
        <div class="login-trust mt-4">
          <span><i class="bi bi-shield-check"></i> Secure access</span>
          <span><i class="bi bi-lock"></i> POPIA aware</span>
        </div>
      </section>
    </div>

    <aside class="site-ad-banner" aria-label="Sponsored placement">
      <a class="site-ad-link" href="{{ url('/events') }}">
        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&h=360&q=88" alt="Adventure vehicle on an open road">
        <span class="site-ad-overlay"></span>
        <span class="site-ad-copy">
          <small>PHOTOX PARTNER</small>
          <strong>BUILT FOR MORE<br>THAN ROADS</strong>
          <span>Explore events <i class="bi bi-arrow-up-right"></i></span>
        </span>
      </a>
    </aside>
  </main>
@endsection