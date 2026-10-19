<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <title>PhotoX Admin | {{ $pageTitle ?? 'Under Progress' }}</title>
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
  <style>
    body {
      background: #070e1b;
      color: #ffffff;
      font-family: 'Space Grotesk', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
    }
    .wip-panel {
      background: rgba(15, 27, 49, 0.75);
      border: 1px solid rgba(255, 255, 255, 0.12);
      border-radius: 24px;
      padding: 48px 40px;
      text-align: center;
      max-width: 520px;
      width: 100%;
      box-shadow: 0 24px 60px rgba(0, 0, 0, 0.6), 0 0 40px rgba(255, 138, 0, 0.08);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
    }
    .wip-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 14px;
      border-radius: 999px;
      background: rgba(255, 138, 0, 0.12);
      border: 1px solid rgba(255, 138, 0, 0.35);
      color: #ff8a00;
      font-family: 'DM Mono', monospace;
      font-size: 0.72rem;
      font-weight: 600;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      margin-bottom: 24px;
    }
    .wip-icon-circle {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(255, 138, 0, 0.2) 0%, rgba(15, 27, 49, 0) 70%);
      border: 1px solid rgba(255, 138, 0, 0.25);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 2.2rem;
      color: #ff8a00;
      margin-bottom: 20px;
      box-shadow: 0 0 24px rgba(255, 138, 0, 0.18);
    }
    .wip-title {
      font-size: 1.65rem;
      font-weight: 700;
      margin-bottom: 10px;
      letter-spacing: -0.02em;
    }
    .wip-copy {
      color: rgba(255, 255, 255, 0.65);
      font-size: 0.95rem;
      line-height: 1.6;
      margin-bottom: 28px;
    }
    .btn-return {
      background: linear-gradient(135deg, #ff8a00 0%, #e06d00 100%);
      color: #ffffff;
      font-weight: 600;
      font-size: 0.9rem;
      padding: 10px 26px;
      border-radius: 999px;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      box-shadow: 0 8px 24px rgba(255, 138, 0, 0.3);
      transition: all 0.2s ease;
      border: none;
    }
    .btn-return:hover {
      background: linear-gradient(135deg, #ffa229 0%, #eb7c0a 100%);
      color: #ffffff;
      transform: translateY(-2px);
      box-shadow: 0 12px 28px rgba(255, 138, 0, 0.4);
    }
  </style>
</head>
<body>
  <div class="wip-panel">
    <div class="wip-badge">
      <i class="bi bi-gear-wide-connected"></i> Module Under Development
    </div>
    <div>
      <div class="wip-icon-circle">
        <i class="bi bi-cone-striped"></i>
      </div>
    </div>
    <h1 class="wip-title">{{ $pageTitle ?? 'Feature in Progress' }}</h1>
    <p class="wip-copy">
      The <strong>{{ $pageTitle ?? 'this' }}</strong> management module is currently being finalized for upcoming deployment. Full controls and configurations will be available here.
    </p>
    <a href="{{ url('/admin/dashboard') }}" class="btn-return">
      <i class="bi bi-arrow-left"></i> Return to Dashboard
    </a>
  </div>
</body>
</html>
