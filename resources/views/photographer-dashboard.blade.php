<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="PhotoX photographer dashboard workspace for bookings, galleries, earnings and schedules.">
  <title>PhotoX | Photographer dashboard</title>
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
<body class="customer-app dashboard-page photographer-dashboard-page page-photographer-dashboard">
  <nav aria-label="Main navigation" class="navbar navbar-expand-lg py-2">
    <div class="container-xl">
      <a aria-label="PhotoX home" class="navbar-brand d-flex align-items-center gap-2" href="index.html"><img alt="PhotoX" src="logo.png"></a>
      <button aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler border-0 p-0" data-bs-target="#mainNav" data-bs-toggle="collapse" type="button"><i class="bi bi-list fs-2"></i></button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav mx-auto gap-lg-3 mt-3 mt-lg-0">
          <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="events.html">Explore</a></li>
          <li class="nav-item"><a class="nav-link" href="photographers.html">Photographers</a></li>
          <li class="nav-item"><a class="nav-link" href="membership.html">Membership</a></li>
          <li class="nav-item"><a class="nav-link" href="blog.html">About</a></li>
          <li class="nav-item"><a class="nav-link" href="index.html#contact">Contact</a></li>
        </ul>
        <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
          <div class="header-search d-none d-xl-flex"><i class="bi bi-search"></i><input aria-label="Search dashboard" placeholder="Search jobs, clients, galleries..." type="search"></div>
          <a class="header-cart" href="cart.html" aria-label="Open cart"><i class="bi bi-cart3"></i><span>0</span></a>
          <button class="icon-button notification-button" aria-label="Notifications"><i class="bi bi-bell"></i><span>3</span></button>
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

  <main class="container-xl workspace-layout photographer-dash">
    <aside class="workspace-sidebar" aria-label="Photographer navigation">
      <div class="workspace-greeting">
        <span class="eyebrow-blue">PHOTOGRAPHER WORKSPACE</span>
        <h1>Frame the<br><em>moment.</em></h1>
      </div>
      <nav class="workspace-nav" id="workspaceNav">
        <a class="workspace-nav-link active" href="photographer-dashboard.html"><i class="bi bi-grid-1x2"></i><span>Overview</span></a>
        <a class="workspace-nav-link" href="photographer-bookings.html"><i class="bi bi-calendar-event"></i><span>Bookings</span><b>12</b></a>
        <a class="workspace-nav-link" href="photographer-gallery.html"><i class="bi bi-images"></i><span>Gallery</span></a>
        <a class="workspace-nav-link" href="photographer-earnings.html"><i class="bi bi-wallet2"></i><span>Earnings</span></a>
        <a class="workspace-nav-link" href="photographer-messages.html"><i class="bi bi-chat-left-text"></i><span>Messages</span></a>
        <a class="workspace-nav-link" href="photographer-profile.html"><i class="bi bi-person-circle"></i><span>Profile</span></a>
      </nav>
      <div class="workspace-side-note">
        <i class="bi bi-shield-check"></i>
        <div>
          <strong>Coverage secured</strong>
          <span>3 client galleries are still pending final delivery.</span>
        </div>
      </div>
      <a class="workspace-logout" href="index.html"><i class="bi bi-box-arrow-left"></i> Sign out</a>
    </aside>

    <section class="workspace-content">
      <div class="workspace-view active">
        <div class="workspace-view-header">
          <div>
            <span class="eyebrow-blue">OVERVIEW</span>
            <h2>Welcome back, Aiden.</h2>
          </div>
          <a class="btn btn-lime rounded-pill px-4" href="photographer-new-booking.html"><i class="bi bi-plus-lg me-2"></i>New booking</a>
        </div>

        <div class="summary-grid">
          <div class="summary-card accent">
            <span class="card-label"><i class="bi bi-graph-up-arrow"></i> Revenue</span>
            <strong>R 42.8k</strong>
            <small><span>vs last month</span><b>+18.4%</b></small>
          </div>
          <div class="summary-card">
            <span class="card-label"><i class="bi bi-camera"></i> Deliveries</span>
            <strong>268</strong>
            <small><span>this month</span><b>18 pending</b></small>
          </div>
          <div class="summary-card">
            <span class="card-label"><i class="bi bi-people"></i> Clients</span>
            <strong>84</strong>
            <small><span>active bookings</span><b>+7</b></small>
          </div>
          <div class="summary-card">
            <span class="card-label"><i class="bi bi-star"></i> Rating</span>
            <strong>4.9</strong>
            <small><span>average review</span><b>126 reviews</b></small>
          </div>
        </div>

        <div class="dashboard-grid">
          <div class="panel">
            <div class="panel-head">
              <div>
                <span class="eyebrow-blue">UPCOMING</span>
                <h3>Booking schedule</h3>
              </div>
              <a class="plain-action" href="photographer-bookings.html">View all <i class="bi bi-arrow-up-right"></i></a>
            </div>

            <div class="booking-list">
              <div class="booking-item">
                <div class="booking-date"><strong>24</strong><span>Sep</span></div>
                <div class="booking-meta">
                  <strong>Stellenbosch Spring Run</strong>
                  <span>8:00 AM • Cape Town • 1 team</span>
                </div>
                <span class="tag">Confirmed</span>
              </div>

              <div class="booking-item">
                <div class="booking-date"><strong>27</strong><span>Sep</span></div>
                <div class="booking-meta">
                  <strong>School A Rugby Day</strong>
                  <span>10:30 AM • Green Point • 3 bookings</span>
                </div>
                <span class="tag pending">Pending</span>
              </div>

              <div class="booking-item">
                <div class="booking-date"><strong>02</strong><span>Oct</span></div>
                <div class="booking-meta">
                  <strong>Family portrait session</strong>
                  <span>3:00 PM • Waterfront • 1 booking</span>
                </div>
                <span class="tag alert">Needs edit</span>
              </div>
            </div>
          </div>

          <div class="panel performance-card">
            <div class="chart-box">
              <div class="chart-head">
                <div>
                  <span class="eyebrow-blue">PERFORMANCE</span>
                  <h4>Bookings</h4>
                </div>
                <a class="small-cta" href="#">This month</a>
              </div>
              <div class="chart-meta">Last 7 weeks</div>
              <canvas id="bookingsChart" aria-label="Booking chart"></canvas>
            </div>
            <div class="chart-legend">
              <span><i class="bi bi-circle-fill" style="color:#7cb8ff"></i> Bookings</span>
              <span><i class="bi bi-circle-fill" style="color:#ff8a00"></i> Revenue</span>
            </div>
          </div>
        </div>

        <div class="dashboard-grid">
          <div class="panel">
            <div class="panel-head">
              <div>
                <span class="eyebrow-blue">GALLERY</span>
                <h3>Recent uploads</h3>
              </div>
              <a class="plain-action" href="photographer-gallery.html">Open gallery <i class="bi bi-arrow-up-right"></i></a>
            </div>

            <div class="gallery-strip">
              <div class="gallery-card">
                <img src="https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=900&q=85" alt="Rugby action">
                <div class="overlay">
                  <strong>Matchday action</strong>
                  <span>Dusty Field • 18 shots</span>
                </div>
              </div>
              <div class="gallery-card">
                <img src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=900&q=85" alt="Marathon finish line">
                <div class="overlay">
                  <strong>Finish line</strong>
                  <span>City Marathon • 26 shots</span>
                </div>
              </div>
              <div class="gallery-card">
                <img src="https://images.unsplash.com/photo-1521412644187-c49fa049e84d?auto=format&fit=crop&w=900&q=85" alt="Portrait session">
                <div class="overlay">
                  <strong>Portrait set</strong>
                  <span>Waterfront • 14 shots</span>
                </div>
              </div>
            </div>
          </div>

          <div class="panel">
            <div class="panel-head">
              <div>
                <span class="eyebrow-blue">REVIEWS</span>
                <h3>Recent client feedback</h3>
              </div>
            </div>

            <div class="review-list">
              <div class="review-item">
                <div class="review-avatar">LM</div>
                <div class="review-meta">
                  <strong>Lebo Mokoena</strong>
                  <span>School sports event</span>
                  <div class="stars">★★★★★</div>
                </div>
              </div>

              <div class="review-item">
                <div class="review-avatar">SK</div>
                <div class="review-meta">
                  <strong>Sophie Kgomo</strong>
                  <span>Family portrait set</span>
                  <div class="stars">★★★★★</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="dashboard-grid">
          <div class="panel">
            <div class="panel-head">
              <div>
                <span class="eyebrow-blue">TASKS</span>
                <h3>Quick actions</h3>
              </div>
            </div>

            <div class="task-list">
              <div class="task-item">
                <div class="task-icon"><i class="bi bi-upload"></i></div>
                <div class="task-text">
                  <strong>Upload final gallery</strong>
                  <span>School A Rugby Day</span>
                </div>
                <a class="small-cta" href="#">Upload</a>
              </div>

              <div class="task-item">
                <div class="task-icon"><i class="bi bi-credit-card"></i></div>
                <div class="task-text">
                  <strong>Payout review</strong>
                  <small>Settlement due 29 Sep</small>
                </div>
                <a class="small-cta" href="#">Review</a>
              </div>

              <div class="task-item">
                <div class="task-icon"><i class="bi bi-envelope"></i></div>
                <div class="task-text">
                  <strong>Respond to client</strong>
                  <span>3 unread messages</span>
                </div>
                <a class="small-cta" href="#">Reply</a>
              </div>
            </div>
          </div>

          <div class="panel">
            <div class="panel-head">
              <div>
                <span class="eyebrow-blue">EARNINGS</span>
                <h3>Monthly payout</h3>
              </div>
            </div>
            <div class="summary-card accent" style="margin-bottom: 0;">
              <span class="card-label"><i class="bi bi-wallet2"></i> Available balance</span>
              <strong>R 18,350</strong>
              <small><span>Paid this month</span><b>R 8,600</b></small>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <nav class="workspace-bottom-nav" id="bottomNav" aria-label="Mobile photographer navigation">
    <a class="active" href="photographer-dashboard.html"><i class="bi bi-grid-1x2"></i><span>Home</span></a>
    <a href="photographer-bookings.html"><i class="bi bi-calendar-event"></i><span>Bookings</span></a>
    <a href="photographer-gallery.html"><i class="bi bi-images"></i><span>Gallery</span></a>
    <a href="photographer-earnings.html"><i class="bi bi-wallet2"></i><span>Earnings</span></a>
    <a href="photographer-profile.html"><i class="bi bi-person"></i><span>Profile</span></a>
  </nav>

  <footer class="footer footer-premium">
    <div class="container-xl">
      <div class="row g-5 footer-main">
        <div class="col-lg-5">
          <a class="footer-logo" href="index.html"><img src="logo.png" alt="PhotoX" style="width:150px"></a>
          <p class="footer-copy">The feeling of being there,<br>kept in a frame.</p>
          <div class="footer-social d-flex gap-3">
            <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" aria-label="Linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
        <div class="col-6 col-lg-2">
          <p class="footer-label">Explore</p>
          <a href="events.html">Events</a>
          <a href="photographers.html">Photographers</a>
          <a href="blog.html">Journal</a>
          <a href="contact.html">Contact</a>
        </div>
        <div class="col-6 col-lg-2">
          <p class="footer-label">For creators</p>
          <a href="photographer-dashboard.html">Creator login</a>
          <a href="photographer-upload-new.html">Upload photos</a>
          <a href="photographers.html">Join PhotoX</a>
          <a href="#">Support</a>
        </div>
        <div class="col-12 col-lg-3">
          <p class="footer-label">Stay in the frame</p>
          <p class="footer-small">New events, fresh galleries and stories from the field.</p>
          <div class="newsletter">
            <input aria-label="Email address" placeholder="Your email address" type="email">
            <button aria-label="Subscribe"><i class="bi bi-arrow-up-right"></i></button>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <span>© 2026 PhotoX</span>
        <span>Privacy · Terms ·</span>
        <span>Made for the moments <i class="bi bi-stars"></i></span>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const bookingsChart = document.getElementById('bookingsChart');

    if (bookingsChart) {
      new Chart(bookingsChart, {
        type: 'bar',
        data: {
          labels: ['W1', 'W2', 'W3', 'W4', 'W5', 'W6', 'W7'],
          datasets: [{
            label: 'Bookings',
            data: [5, 9, 7, 12, 15, 11, 18],
            backgroundColor: ['#7cb8ff', '#7cb8ff', '#7cb8ff', '#0b2d5b', '#0b2d5b', '#ff8a00', '#ff8a00'],
            borderRadius: 8,
            borderSkipped: false
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: { legend: { display: false } },
          scales: {
            x: { grid: { display: false }, ticks: { color: '#59708f' } },
            y: { beginAtZero: true, grid: { color: 'rgba(11,45,91,.08)' }, ticks: { color: '#59708f' } }
          }
        }
      });
    }
  </script>
  <script src="app.js"></script>
</body>
</html>
