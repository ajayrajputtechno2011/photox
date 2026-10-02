<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PhotoX | Work in Progress</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,600;0,9..40,700;1,9..40,400&family=DM+Mono:wght@500&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <style>
    * { box-sizing: border-box; }
    body {
      background: radial-gradient(circle at 50% 20%, #0d2238 0%, #06101a 55%, #03080e 100%);
      color: #ffffff;
      font-family: 'DM Sans', sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }
    .wip-header {
      padding: 28px 0;
      border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    }
    .brand-logo {
      font-size: 1.85rem;
      font-weight: 800;
      letter-spacing: -0.04em;
      color: #ffffff;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 2px;
    }
    .brand-logo .brand-x {
      color: #ff8a00;
    }
    .brand-logo .brand-tag {
      font-size: 0.55rem;
      letter-spacing: 0.15em;
      text-transform: uppercase;
      font-family: 'DM Mono', monospace;
      color: #94a3b8;
      display: block;
      line-height: 1;
      margin-top: 2px;
    }
    .wip-content {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 60px 20px;
    }
    .wip-card {
      background: rgba(14, 27, 43, 0.7);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border: 1px solid rgba(255, 255, 255, 0.12);
      border-radius: 24px;
      padding: 52px 42px;
      text-align: center;
      max-width: 620px;
      width: 100%;
      box-shadow: 0 25px 60px rgba(0, 0, 0, 0.6), 0 0 80px rgba(255, 138, 0, 0.08);
      position: relative;
    }
    .pulse-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(255, 138, 0, 0.14);
      border: 1px solid rgba(255, 138, 0, 0.35);
      color: #ff9d2e;
      padding: 7px 16px;
      border-radius: 999px;
      font-size: 0.76rem;
      font-family: 'DM Mono', monospace;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      margin-bottom: 24px;
    }
    .pulse-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: #ff8a00;
      box-shadow: 0 0 0 4px rgba(255, 138, 0, 0.25);
      animation: pulseAnim 2s infinite ease-in-out;
    }
    @keyframes pulseAnim {
      0%, 100% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.4); opacity: 0.6; }
    }
    .wip-title {
      font-size: clamp(2.1rem, 4vw, 3rem);
      font-weight: 800;
      letter-spacing: -0.04em;
      line-height: 1.1;
      margin-bottom: 16px;
    }
    .wip-desc {
      color: #94a3b8;
      font-size: 1.05rem;
      line-height: 1.6;
      margin-bottom: 32px;
    }
    .feature-pills {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 10px;
      margin-bottom: 36px;
    }
    .feature-pill {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.08);
      padding: 6px 14px;
      border-radius: 999px;
      font-size: 0.80rem;
      color: #cbd5e1;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }
    .wip-contact {
      padding-top: 24px;
      border-top: 1px solid rgba(255, 255, 255, 0.08);
      font-size: 0.88rem;
      color: #64748b;
    }
    .wip-contact a {
      color: #ff8a00;
      text-decoration: none;
      font-weight: 600;
    }
    .wip-contact a:hover {
      text-decoration: underline;
    }
    .wip-footer {
      padding: 24px 0;
      text-align: center;
      font-size: 0.78rem;
      color: #475569;
      border-top: 1px solid rgba(255, 255, 255, 0.04);
    }
  </style>
</head>
<body>

  <!-- Top Brand Navigation -->
  <header class="wip-header">
    <div class="container text-center">
      <div class="brand-logo">
        photo<span class="brand-x">X</span>
      </div>
      <div class="brand-tag">Photography Marketplace</div>
    </div>
  </header>

  <!-- Main Center Banner -->
  <main class="wip-content">
    <div class="wip-card">
      <div class="pulse-badge">
        <span class="pulse-dot"></span>
        <span>Platform Setup in Progress</span>
      </div>
      
      <h1 class="wip-title">
        Great Moments Are <br><span style="color: #ff8a00;">In the Making.</span>
      </h1>

      <p class="wip-desc">
        We are currently configuring and fine-tuning the PhotoX production environment. 
        High-resolution sports and event galleries will be officially available shortly.
      </p>

      <div class="feature-pills">
        <span class="feature-pill"><i class="bi bi-camera-fill text-warning"></i> Event Galleries</span>
        <span class="feature-pill"><i class="bi bi-person-bounding-box text-info"></i> Bib & Face Search</span>
        <span class="feature-pill"><i class="bi bi-shield-check text-success"></i> Instant Licensing</span>
      </div>

      <div class="wip-contact">
        Questions or inquiries? Reach us at <a href="mailto:photox.co.za@gmail.com">photox.co.za@gmail.com</a>
      </div>
    </div>
  </main>

  <!-- Bottom Footer -->
  <footer class="wip-footer">
    <div class="container">
      &copy; {{ date('Y') }} PhotoX Marketplace (Pty) Ltd. All rights reserved.
    </div>
  </footer>

</body>
</html>
