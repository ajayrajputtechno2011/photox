<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Sign in to PhotoX Admin">
  <title>PhotoX Admin | Sign in</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet">
</head>
<body class="login-page">
  <main class="login-shell">
    <section class="login-visual" aria-label="PhotoX studio administration">
      <div class="visual-topline">
        <a class="brand login-brand" href="/admin/login" aria-label="PhotoX Admin home">
          <img class="brand-logo" src="{{ asset('admin-assets/logo.png') }}" alt="PhotoX Admin">
        </a>
        <span class="secure-label"><i class="bi bi-shield-lock"></i> Secure admin portal</span>
      </div>
      <div class="visual-content">
        <p class="eyebrow">PhotoX studio platform</p>
        <h1>Bring every frame<br><span>into focus.</span></h1>
        <p>Manage your creative business, galleries, customers, and payments from one calm workspace.</p>
      </div>
      
    </section>

    <section class="login-form-side">
      <div class="login-card-wrap">
        <div class="mobile-brand-wrap">
          <a class="brand login-brand" href="/admin/login" aria-label="PhotoX Admin home">
            <img class="brand-logo" src="{{ asset('admin-assets/logo.png') }}" alt="PhotoX Admin">
          </a>
        </div>
        <div class="login-heading">
          <p class="eyebrow">Welcome back</p>
          <h2>Sign in to your workspace</h2>
          <p>Enter your details to continue to PhotoX Admin.</p>
        </div>
        <form class="login-form" action="{{ route('login.post') }}" method="POST">
          @csrf
          @if(session('error'))
            <div class="alert alert-danger py-2 small mb-3">{{ session('error') }}</div>
          @endif
          @if($errors->any())
            <div class="alert alert-danger py-2 small mb-3">{{ $errors->first() }}</div>
          @endif
          <div class="field-group">
            <label for="email">Email address</label>
            <div class="field-control">
              <i class="bi bi-envelope"></i>
              <input id="email" name="email" value="{{ old('email') }}" required type="email" placeholder="you@studio.com" autocomplete="email">
            </div>
          </div>
          <div class="field-group">
            <div class="field-label-row">
              <label for="password">Password</label>
              <a href="#forgot-password">Forgot password?</a>
            </div>
            <div class="field-control">
              <i class="bi bi-lock"></i>
              <input id="password" name="password" required type="password" placeholder="Enter your password" autocomplete="current-password">
            </div>
          </div>
          <div class="remember-row">
            <label class="remember-label"><input type="checkbox" name="remember"><span class="remember-box"></span><span>Remember me</span></label>
          </div>
          <button class="btn btn-primary login-button" type="submit">Sign in <i class="bi bi-arrow-right"></i></button>
        </form>
        <p class="login-help">Need help signing in? <a href="#support">Contact support</a></p>
      </div>
    </section>
  </main>
</body>
</html>

