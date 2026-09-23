<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="PhotoX photographer earnings dashboard.">
  <title>PhotoX | Photographer earnings</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
  <link href="css/styles.css" rel="stylesheet">
  <script defer src="site-ad.js"></script>
  
</head>
<body class="page-photographer-earnings">
  <nav aria-label="Main navigation" class="navbar navbar-expand-lg py-2">
    <div class="container-xl">
      <a class="navbar-brand d-flex align-items-center gap-2" href="index.html"><img alt="PhotoX" src="logo.png"></a>
      <button aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler border-0 p-0" data-bs-target="#mainNav" data-bs-toggle="collapse" type="button"><i class="bi bi-list fs-2"></i></button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav mx-auto gap-lg-3 mt-3 mt-lg-0">
          <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="events.html">Explore</a></li>
          <li class="nav-item"><a class="nav-link" href="photographers.html">Photographers</a></li>
          <li class="nav-item"><a class="nav-link" href="membership.html">Membership</a></li>
          <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
        </ul>
        <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
          <div class="header-search d-none d-xl-flex"><i class="bi bi-search"></i><input aria-label="Search" placeholder="Search accounts" type="search"></div>
          <a class="header-cart" href="cart.html" aria-label="Open cart"><i class="bi bi-cart3"></i><span>0</span></a>
          <button class="icon-button notification-button" aria-label="Notifications"><i class="bi bi-bell"></i><span>4</span></button>
          <div class="account-menu">
            <button class="profile-trigger" aria-label="Open account menu"><span class="avatar">AD</span><span class="d-none d-sm-inline">Aiden Daniels</span><i class="bi bi-chevron-down"></i></button>
            <div class="account-dropdown" role="menu">
              <div class="account-dropdown-user"><span class="avatar">AD</span><div><strong>Aiden Daniels</strong><small>aiden@photosouth.com</small></div></div>
              <a href="photographer-profile.html" role="menuitem"><i class="bi bi-person"></i> Profile & settings</a>
              <a href="index.html" role="menuitem"><i class="bi bi-box-arrow-left"></i> Log out</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <main class="container-xl photographer-shell">
    <aside class="photographer-sidebar" aria-label="Photographer navigation">
      <div class="workspace-greeting">
        <span class="eyebrow-blue">PHOTOGRAPHER WORKSPACE</span>
        <h1>Frame the<br><em>moment.</em></h1>
      </div>
      <nav class="workspace-nav">
        <a class="workspace-nav-link" href="photographer-dashboard.html"><i class="bi bi-grid-1x2"></i><span>Overview</span></a>
        <a class="workspace-nav-link" href="photographer-bookings.html"><i class="bi bi-calendar-event"></i><span>Bookings</span><b>12</b></a>
        <a class="workspace-nav-link" href="photographer-gallery.html"><i class="bi bi-images"></i><span>Gallery</span></a>
        <a class="workspace-nav-link active" href="photographer-earnings.html"><i class="bi bi-wallet2"></i><span>Earnings</span></a>
        <a class="workspace-nav-link" href="photographer-messages.html"><i class="bi bi-chat-left-text"></i><span>Messages</span></a>
        <a class="workspace-nav-link" href="photographer-profile.html"><i class="bi bi-person-circle"></i><span>Profile</span></a>
      </nav>
      <div class="workspace-side-note"><i class="bi bi-shield-check"></i><div><strong>Coverage secured</strong><span>3 client galleries are still pending final delivery.</span></div></div>
      <a class="workspace-logout" href="index.html"><i class="bi bi-box-arrow-left"></i> Sign out</a>
    </aside>

    <section class="workspace-main">
      <div class="workspace-topbar">
        <div>
          <span class="eyebrow-blue">EARNINGS</span>
          <h2>Revenue overview</h2>
        </div>
        <a class="btn btn-lime rounded-pill px-4" href="#"><i class="bi bi-arrow-down-circle me-2"></i>Withdraw</a>
      </div>

      <div class="summary-grid">
        <div class="summary-card accent">
          <span class="label"><i class="bi bi-wallet2"></i> Balance</span>
          <strong>R 18,350</strong>
          <small><span>Available now</span><b>+R 2,860</b></small>
        </div>
        <div class="summary-card">
          <span class="label"><i class="bi bi-currency-dollar"></i> This month</span>
          <strong>R 42,800</strong>
          <small><span>Gross revenue</span><b>+18.4%</b></small>
        </div>
        <div class="summary-card">
          <span class="label"><i class="bi bi-bank"></i> Payouts</span>
          <strong>R 8,600</strong>
          <small><span>Paid out</span><b>2 transfers</b></small>
        </div>
      </div>

      <div class="stats-row">
        <div class="panel">
          <div class="panel-head">
            <div>
              <span class="eyebrow-blue">TREND</span>
              <h3>Monthly income</h3>
            </div>
          </div>
          <canvas id="earningsChart" aria-label="Earnings graph"></canvas>
        </div>

        <div class="panel">
          <div class="panel-head">
            <div>
              <span class="eyebrow-blue">PAYOUTS</span>
              <h3>Recent transfers</h3>
            </div>
          </div>
          <div class="payout-list">
            <div class="payout-item">
              <div>
                <strong>Stellenbosch Spring Run</strong>
                <span>23 Sep 2026</span>
              </div>
              <div class="amount">R 6,450</div>
              <span class="status-pill paid">Paid</span>
            </div>
            <div class="payout-item">
              <div>
                <strong>School A Rugby Day</strong>
                <span>18 Sep 2026</span>
              </div>
              <div class="amount">R 2,150</div>
              <span class="status-pill pending">Pending</span>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="footer footer-premium">
    <div class="container-xl">
      <div class="row g-5 footer-main">
        <div class="col-lg-5"><a class="footer-logo" href="index.html"><img src="logo.png" alt="PhotoX" style="width:150px"></a><p class="footer-copy">The feeling of being there,<br>kept in a frame.</p><div class="footer-social d-flex gap-3"><a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a><a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a><a href="#" aria-label="Linkedin"><i class="bi bi-linkedin"></i></a></div></div>
        <div class="col-6 col-lg-2"><p class="footer-label">Explore</p><a href="events.html">Events</a><a href="photographers.html">Photographers</a><a href="blog.html">Journal</a><a href="contact.html">Contact</a></div>
        <div class="col-6 col-lg-2"><p class="footer-label">For creators</p><a href="photographer-dashboard.html">Creator login</a><a href="photographer-upload-new.html">Upload photos</a><a href="photographers.html">Join PhotoX</a><a href="#">Support</a></div>
        <div class="col-12 col-lg-3"><p class="footer-label">Stay in the frame</p><p class="footer-small">New events, fresh galleries and stories from the field.</p><div class="newsletter"><input aria-label="Email address" placeholder="Your email address" type="email"><button aria-label="Subscribe"><i class="bi bi-arrow-up-right"></i></button></div></div>
      </div>
      <div class="footer-bottom"><span>© 2026 PhotoX</span><span>Privacy · Terms ·</span><span>Made for the moments <i class="bi bi-stars"></i></span></div>
    </div>
  </footer>

  <script>
    const earningsChart = document.getElementById('earningsChart');

    if (earningsChart) {
      new Chart(earningsChart, {
        type: 'line',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
          datasets: [{
            label: 'Revenue',
            data: [8, 12, 10, 16, 18, 22, 26],
            borderColor: '#0b2d5b',
            backgroundColor: 'rgba(11, 45, 91, 0.12)',
            pointBackgroundColor: '#ff8a00',
            pointBorderColor: '#fff',
            borderWidth: 3,
            pointRadius: 4,
            fill: true,
            tension: 0.35
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: { legend: { display: false } },
          scales: {
            x: { grid: { display: false }, ticks: { color: '#59708f' } },
            y: { beginAtZero: false, grid: { color: 'rgba(11,45,91,.08)' }, ticks: { color: '#59708f' } }
          }
        }
      });
    }
  </script>
</body>
</html>
