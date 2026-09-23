<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="PhotoX photographer messages dashboard.">
  <title>PhotoX | Photographer messages</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <script defer src="site-ad.js"></script>
  
</head>
<body class="page-photographer-messages">
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
          <div class="header-search d-none d-xl-flex"><i class="bi bi-search"></i><input aria-label="Search" placeholder="Search messages" type="search"></div>
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
        <a class="workspace-nav-link" href="photographer-earnings.html"><i class="bi bi-wallet2"></i><span>Earnings</span></a>
        <a class="workspace-nav-link active" href="photographer-messages.html"><i class="bi bi-chat-left-text"></i><span>Messages</span></a>
        <a class="workspace-nav-link" href="photographer-profile.html"><i class="bi bi-person-circle"></i><span>Profile</span></a>
      </nav>
      <div class="workspace-side-note"><i class="bi bi-shield-check"></i><div><strong>Coverage secured</strong><span>3 client galleries are still pending final delivery.</span></div></div>
      <a class="workspace-logout" href="index.html"><i class="bi bi-box-arrow-left"></i> Sign out</a>
    </aside>

    <section class="workspace-main">
      <div class="workspace-topbar">
        <div>
          <span class="eyebrow-blue">MESSAGES</span>
          <h2>Client inbox</h2>
        </div>
        <a class="btn btn-lime rounded-pill px-4" href="#"><i class="bi bi-pencil-square me-2"></i>New message</a>
      </div>

      <div class="message-layout">
        <div class="panel">
          <div class="inbox-list">
            <div class="inbox-item">
              <div class="person-dot">LM</div>
              <div>
                <strong>Lebo Mokoena</strong>
                <span>School rugby day</span>
              </div>
            </div>
            <div class="inbox-item">
              <div class="person-dot">SK</div>
              <div>
                <strong>Sophie Kgomo</strong>
                <span>Family portraits</span>
              </div>
            </div>
            <div class="inbox-item">
              <div class="person-dot">SA</div>
              <div>
                <strong>Sarah Akin</strong>
                <span>Marathon coverage</span>
              </div>
            </div>
          </div>
        </div>

        <div class="panel">
          <div class="thread">
            <div class="bubble">
              <strong>Lebo Mokoena</strong>
              <small>Today, 9:42 AM</small>
              <p>Hi Aiden, could we get the gallery link updated with the final team shots?</p>
            </div>
            <div class="bubble mine">
              <strong>You</strong>
              <small>Today, 9:48 AM</small>
              <p>Absolutely — I am finishing the final selection and will send the link before 5 PM today.</p>
            </div>
            <div class="bubble">
              <strong>Lebo Mokoena</strong>
              <small>Today, 9:51 AM</small>
              <p>Perfect, thanks so much. We will share the final event highlights with the families.</p>
            </div>
          </div>

          <div class="answer-box">
            <textarea placeholder="Write a message...">Thanks Lebo, I’ll send the updated gallery link soon.</textarea>
            <button type="button" class="btn btn-lime rounded-pill px-4 reply-btn">Send reply</button>
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
</body>
</html>
