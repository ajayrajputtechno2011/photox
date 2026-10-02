@extends('web.layouts.app')

@section('title', 'PhotoX | Create your account')
@section('body-class', 'page-signup')

@section('content')
  <main class="login-page">
    <div class="login-shell">
      <section class="login-visual" aria-label="PhotoX account benefits">
        <div class="login-count">PhotoX / Join the frame</div>
        <div>
          <h1>Keep your<br><em>best moments.</em></h1>
          <p class="login-quote mt-4">Create your free account to save galleries, track orders and return to the moments worth keeping.</p>
        </div>
        <div class="d-flex justify-content-between align-items-end">
          <span class="login-count">Find. Feel. Keep.</span>
          <i class="bi bi-arrow-up-right fs-3 text-warning"></i>
        </div>
      </section>

      <section class="login-form-panel">
        <div class="eyebrow-blue">Welcome to PhotoX</div>
        <h2 class="mt-2 mb-2">Create your account.</h2>

        <form id="signupForm" action="{{ route('signup.post') }}" method="POST">
          @csrf

          <fieldset class="signup-choice">
            <legend>Choose your PhotoX account</legend>
            <div class="signup-choice-grid">
              <label class="signup-choice-card">
                <input {{ old('account-type', 'member') === 'member' ? 'checked' : '' }} name="account-type" type="radio" value="member">
                <span class="signup-choice-content">
                  <i class="bi bi-person-heart"></i>
                  <strong>PhotoX member</strong>
                  <small>Free to join. Browse and buy photos.</small>
                </span>
              </label>
              <label class="signup-choice-card">
                <input {{ old('account-type') === 'photographer' ? 'checked' : '' }} name="account-type" type="radio" value="photographer">
                <span class="signup-choice-content">
                  <i class="bi bi-camera"></i>
                  <strong>Photographer</strong>
                  <small>Choose a creator plan for your workspace.</small>
                </span>
              </label>
            </div>
          </fieldset>

          <label class="form-label mt-4" for="signupName">Full name</label>
          <input class="form-control @error('name') is-invalid @enderror" id="signupName" name="name" type="text" placeholder="Your full name" value="{{ old('name') }}" required autocomplete="name">
          @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror

          <label class="form-label mt-3" for="signupEmail">Email address</label>
          <input class="form-control @error('email') is-invalid @enderror" id="signupEmail" name="email" type="email" placeholder="you@example.com" value="{{ old('email') }}" required autocomplete="email">
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror

          <fieldset class="signup-tiers mt-4" id="photographerTiers" {{ old('account-type') === 'photographer' ? '' : 'hidden' }}>
            <legend>Choose your photographer membership tier</legend>
            <p class="signup-section-help">Photographers can choose a membership plan for their creator workspace.</p>
            <div class="tier-grid">
              <label class="tier-card">
                <input {{ old('photographer-tier', 'starter') === 'starter' ? 'checked' : '' }} name="photographer-tier" type="radio" value="starter">
                <span class="tier-card-content">
                  <span class="tier-name">Starter</span>
                  <strong>Free</strong>
                  <small>Basic portfolio and booking enquiries.</small>
                </span>
              </label>
              <label class="tier-card tier-card-featured">
                <input {{ old('photographer-tier') === 'pro' ? 'checked' : '' }} name="photographer-tier" type="radio" value="pro">
                <span class="tier-card-content">
                  <span class="tier-name">Pro</span>
                  <strong>R 299 <small>/ month</small></strong>
                  <small>More gallery space</small>
                </span>
                <b class="tier-badge">Popular</b>
              </label>
              <label class="tier-card">
                <input {{ old('photographer-tier') === 'studio' ? 'checked' : '' }} name="photographer-tier" type="radio" value="studio">
                <span class="tier-card-content">
                  <span class="tier-name">Studio</span>
                  <strong>R 599 <small>/ month</small></strong>
                  <small>Unlimited galleries</small>
                </span>
              </label>
            </div>
          </fieldset>

          <label class="form-label mt-3" for="signupPassword">Password</label>
          <div class="input-group">
            <input class="form-control @error('password') is-invalid @enderror" id="signupPassword" name="password" type="password" placeholder="Create a password (min 8 characters)" autocomplete="new-password" minlength="8" required>
            <button class="btn btn-outline-secondary" type="button" aria-label="Show password" id="toggleSignupPassword">
              <i class="bi bi-eye"></i>
            </button>
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-check mt-3">
            <input class="form-check-input @error('terms') is-invalid @enderror" id="terms" name="terms" type="checkbox" required>
            <label class="form-check-label small text-secondary" for="terms">
              I agree to the PhotoX terms and privacy policy.
            </label>
            @error('terms')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <button class="btn login-submit rounded-pill w-100 mt-4" type="submit">
            Create account <i class="bi bi-arrow-right ms-2"></i>
          </button>
        </form>

        <div class="login-divider">or continue with</div>
        <button class="btn social-login rounded-pill w-100" type="button" data-toast="Google login integration coming soon"><i class="bi bi-google me-2"></i> Continue with Google</button>
        <p class="text-center login-help mt-4 mb-0">Already have an account? <a href="{{ route('login') }}">Log in here</a></p>
        <div class="login-trust mt-4">
          <span><i class="bi bi-shield-check"></i> Secure account</span>
          <span><i class="bi bi-heart"></i> Free to join</span>
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

@section('scripts')
<script>
  const passwordToggle = document.getElementById('toggleSignupPassword');
  const passwordInput = document.getElementById('signupPassword');
  const accountTypeInputs = document.querySelectorAll('input[name="account-type"]');
  const photographerTiers = document.getElementById('photographerTiers');

  function updateSignupType() {
    const checked = document.querySelector('input[name="account-type"]:checked');
    const isPhotographer = checked && checked.value === 'photographer';
    photographerTiers.hidden = !isPhotographer;
    photographerTiers.querySelectorAll('input[name="photographer-tier"]').forEach((input) => {
      input.disabled = !isPhotographer;
    });
  }

  accountTypeInputs.forEach((input) => input.addEventListener('change', updateSignupType));
  updateSignupType();

  passwordToggle.addEventListener('click', () => {
    const isPassword = passwordInput.type === 'password';
    passwordInput.type = isPassword ? 'text' : 'password';
    passwordToggle.innerHTML = `<i class="bi bi-eye${isPassword ? '-slash' : ''}"></i>`;
  });
</script>
@endsection
