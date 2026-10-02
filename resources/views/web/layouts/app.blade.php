<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="PhotoX is the sports and event photography marketplace for finding your moments." name="description">
  <title>@yield('title', 'PhotoX | Find your moment')</title>
  <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="{{ asset('css/styles.css') }}?v={{ file_exists(public_path('css/styles.css')) ? filemtime(public_path('css/styles.css')) : time() }}" rel="stylesheet">
  <script defer src="{{ asset('site-ad.js') }}?v={{ file_exists(public_path('site-ad.js')) ? filemtime(public_path('site-ad.js')) : time() }}"></script>
  @yield('styles')
</head>
<body class="@yield('body-class', '')">

  @include('web.partials.header')

  {{-- Global Flash Notifications --}}
  @if(session('success'))
    <div class="container-xl mt-3">
      <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
        <i class="bi bi-check-circle-fill fs-5"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
  @endif

  @if(session('error'))
    <div class="container-xl mt-3">
      <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
        <i class="bi bi-exclamation-triangle-fill fs-5"></i>
        <div>{{ session('error') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
  @endif

  @if(isset($errors) && $errors->any())
    <div class="container-xl mt-3">
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="d-flex align-items-center gap-2 mb-1">
          <i class="bi bi-exclamation-octagon-fill fs-5"></i>
          <strong>Please check the following errors:</strong>
        </div>
        <ul class="mb-0 ps-4">
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
  @endif

  @yield('content')

  @include('web.partials.footer')

  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div aria-live="polite" class="toast" id="photoToast" role="status">
      <div class="toast-body d-flex align-items-center gap-2">
        <i class="bi bi-check-circle-fill"></i><span>PhotoX ready.</span>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('app.js') }}"></script>
  @yield('scripts')
</body>
</html>
