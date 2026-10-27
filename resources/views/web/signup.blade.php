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

        @php
          $defaultAccountType = in_array(request('type'), ['photographer', 'creator']) ? 'photographer' : 'member';
        @endphp

        <form id="signupForm" action="{{ route('signup.post') }}" method="POST">
          @csrf

          <fieldset class="signup-choice">
            <legend>Choose your PhotoX account</legend>
            <div class="signup-choice-grid">
              <label class="signup-choice-card">
                <input {{ old('account-type', $defaultAccountType) === 'member' ? 'checked' : '' }} name="account-type" type="radio" value="member">
                <span class="signup-choice-content">
                  <i class="bi bi-person-heart"></i>
                  <strong>Customer</strong>
                  <small>Free to join. Browse and buy photos.</small>
                </span>
              </label>
              <label class="signup-choice-card">
                <input {{ old('account-type', $defaultAccountType) === 'photographer' ? 'checked' : '' }} name="account-type" type="radio" value="photographer">
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

          <fieldset class="signup-tiers mt-4" id="photographerTiers" {{ old('account-type', $defaultAccountType ?? 'member') === 'photographer' ? '' : 'hidden' }}>
            <legend>Choose your photographer membership tier</legend>
            <p class="signup-section-help">Photographers can choose a membership plan for their creator workspace.</p>
            <div class="tier-grid">
              @if(isset($publicTiers) && $publicTiers->isNotEmpty())
                @foreach($publicTiers as $tier)
                  @php
                    $isDefaultSelected = old('photographer-tier', 'starter') === $tier->slug;
                    $isFeatured = (bool) $tier->is_featured;
                    $priceFormatted = ((float) $tier->monthly_price > 0)
                      ? 'R ' . number_format($tier->monthly_price, 0) . ' <small>/ month</small>'
                      : 'Free';
                    $subtext = $tier->storage_limit ?: ($tier->tagline ?: 'Creator workspace');
                  @endphp
                  <label class="tier-card {{ $isFeatured ? 'tier-card-featured' : '' }}">
                    <input {{ $isDefaultSelected ? 'checked' : '' }} name="photographer-tier" type="radio" value="{{ $tier->slug }}">
                    <span class="tier-card-content">
                      <span class="tier-name">{{ $tier->name }}</span>
                      <strong>{!! $priceFormatted !!}</strong>
                      <small>{{ $subtext }}</small>
                    </span>
                    @if($isFeatured)
                      <b class="tier-badge">Popular</b>
                    @endif
                  </label>
                @endforeach
              @else
                <label class="tier-card">
                  <input checked name="photographer-tier" type="radio" value="starter">
                  <span class="tier-card-content">
                    <span class="tier-name">Starter</span>
                    <strong>Free</strong>
                    <small>Basic portfolio and booking enquiries.</small>
                  </span>
                </label>
                <label class="tier-card">
                  <input name="photographer-tier" type="radio" value="standard">
                  <span class="tier-card-content">
                    <span class="tier-name">Standard</span>
                    <strong>R 199 <small>/ month</small></strong>
                    <small>25,000 Photos</small>
                  </span>
                </label>
                <label class="tier-card tier-card-featured">
                  <input name="photographer-tier" type="radio" value="pro">
                  <span class="tier-card-content">
                    <span class="tier-name">Pro</span>
                    <strong>R 399 <small>/ month</small></strong>
                    <small>50,000 Photos</small>
                  </span>
                  <b class="tier-badge">Popular</b>
                </label>
              @endif
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
              I agree to the PhotoX <a href="{{ route('terms') }}" target="_blank" class="text-primary text-decoration-underline fw-semibold">terms of service</a> and <a href="{{ route('privacy') }}" target="_blank" class="text-primary text-decoration-underline fw-semibold">privacy policy</a>.
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

    @include('web.partials.site-ad-banner')
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
