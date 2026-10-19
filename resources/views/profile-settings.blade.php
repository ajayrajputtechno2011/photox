<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="Manage your PhotoX profile, preferences and account settings." name="description">
	<title>PhotoX | Profile and settings</title>
	<link href="favicon.png" rel="icon">
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<script defer src="site-ad.js"></script>
</head>
<body class="customer-app profile-page">
	<nav aria-label="Main navigation" class="navbar navbar-expand-lg py-2">
		<div class="container-xl">
			<a aria-label="PhotoX home" class="navbar-brand" href="index.html"><img alt="PhotoX" src="logo.png"></a><button aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler border-0 p-0" data-bs-target="#mainNav" data-bs-toggle="collapse" type="button"><i class="bi bi-list fs-2"></i></button>
			<div class="collapse navbar-collapse" id="mainNav">
				<ul class="navbar-nav mx-auto gap-lg-3 mt-3 mt-lg-0">
					<li class="nav-item">
						<a class="nav-link" href="index.html">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="events.html">Explore</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="photographers.html">Photographers</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="membership.html">Membership</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="about.html">About</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="index.html#contact">Contact</a>
					</li>
				</ul>
				<div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
					<a class="header-cart" href="cart.html" aria-label="Open cart"><i class="bi bi-cart3"></i><span>0</span></a><button aria-label="Notifications" class="icon-button notification-button"><i class="bi bi-bell"></i><span>2</span></button>
					<div class="account-menu">
						<button aria-label="Open account menu" class="profile-trigger"><span class="avatar">LM</span><span class="d-none d-sm-inline">Lebo Mokoena</span><i class="bi bi-chevron-down"></i></button>
						<div class="account-dropdown" role="menu">
							<div class="account-dropdown-user">
								<span class="avatar">LM</span>
								<div>
									<strong>Lebo Mokoena</strong><small>lebo.mokoena@example.com</small>
								</div>
							</div><a href="profile-settings.html"><i class="bi bi-person"></i> Profile & settings</a><a href="index.html"><i class="bi bi-box-arrow-left"></i> Log out</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>
	<main class="workspace-layout container-xl">
		<aside aria-label="Account navigation" class="workspace-sidebar">
			<div class="workspace-greeting">
				<span class="eyebrow-blue">YOUR WORKSPACE</span>
				<h1>Keep the<br>
				<em>good ones.</em></h1>
			</div>
			<nav class="workspace-nav">
				<a class="workspace-nav-link" href="customer-dashboard.html"><i class="bi bi-grid-1x2"></i><span>Overview</span></a><a class="workspace-nav-link" href="my-photos.html"><i class="bi bi-images"></i><span>My photos</span><b>24</b></a><a class="workspace-nav-link" href="saved-events.html"><i class="bi bi-bookmark"></i><span>Saved events</span></a><a class="workspace-nav-link" href="orders-downloads.html"><i class="bi bi-bag"></i><span>Orders & downloads</span></a><a class="workspace-nav-link active" href="profile-settings.html"><i class="bi bi-person"></i><span>Profile & settings</span></a>
			</nav>
			<div class="workspace-side-note">
				<i class="bi bi-shield-check"></i>
				<div>
					<strong>Your privacy matters</strong><span>Manage your details and notification preferences here.</span>
				</div>
			</div><a class="workspace-logout" href="index.html"><i class="bi bi-box-arrow-left"></i> Sign out</a>
		</aside>
		<section class="workspace-content">
			<div class="workspace-mobile-heading">
				<span class="eyebrow-blue">YOUR WORKSPACE</span>
				<h2>Your account.</h2>
				<p>Keep your PhotoX details up to date.</p>
			</div>
			
			<section class="workspace-view active">
				<div class="workspace-view-header">
					<div>
						<span class="eyebrow-blue">PROFILE & SETTINGS</span>
						<h2>Account details.</h2>
						<p>Keep your PhotoX profile complete and your preferences in your hands.</p>
					</div><button class="btn btn-dark rounded-pill px-4" form="profileForm" type="submit"><i class="bi bi-check2 me-2"></i>Save changes</button>
				</div>
				<div class="settings-layout">
					
					<form action="profile-settings.html" class="settings-form" id="profileForm" method="get" name="profileForm">
						<section class="settings-section">
							<div class="settings-section-title">
								<i class="bi bi-person-vcard"></i>
								<div>
									<h3>Personal information</h3>
									<p>The basics that appear on your PhotoX account.</p>
								</div>
							</div>
							<div class="settings-form-grid">
								<label>First name<input autocomplete="given-name" type="text" value="Lebo"></label><label>Last name<input autocomplete="family-name" type="text" value="Mokoena"></label><label>Email address<input autocomplete="email" type="email" value="lebo.mokoena@example.com"></label><label>Mobile number<input autocomplete="tel" placeholder="+27 82 000 0000" type="tel"></label>
							</div>
						</section>
						<section class="settings-section">
							<div class="settings-section-title">
								<i class="bi bi-geo-alt"></i>
								<div>
									<h3>Location & preferences</h3>
									<p>Help us show relevant events and galleries.</p>
								</div>
							</div>
							<div class="settings-form-grid">
								<label>City<input autocomplete="address-level2" type="text" value="Cape Town"></label><label>Country<select>
									<option>
										South Africa
									</option>
									<option>
										Namibia
									</option>
									<option>
										Botswana
									</option>
								</select></label><label>Favourite sport<select>
									<option>
										Running
									</option>
									<option>
										Rugby
									</option>
									<option>
										Cycling
									</option>
									<option>
										School sport
									</option>
								</select></label><label>Display language<select>
									<option>
										English
									</option>
									<option>
										Afrikaans
									</option>
								</select></label>
							</div>
						</section>
						<section class="settings-section">
							<div class="settings-section-title">
								<i class="bi bi-bell"></i>
								<div>
									<h3>Notifications</h3>
									<p>Choose what you want PhotoX to send you.</p>
								</div>
							</div>
							<div class="settings-switch-list">
								<label class="settings-switch"><input checked type="checkbox"><span><strong>New gallery alerts</strong><small>Tell me when a saved event gets new photos.</small></span><i class="bi bi-toggle-on"></i></label><label class="settings-switch"><input checked type="checkbox"><span><strong>Order updates</strong><small>Send me payment and download notifications.</small></span><i class="bi bi-toggle-on"></i></label><label class="settings-switch"><input type="checkbox"><span><strong>PhotoX announcements</strong><small>Occasional news, offers and community stories.</small></span><i class="bi bi-toggle-off"></i></label>
							</div>
						</section>
						<section class="settings-section">
							<div class="settings-section-title">
								<i class="bi bi-shield-lock"></i>
								<div>
									<h3>Privacy & security</h3>
									<p>Manage access to your account and photo searches.</p>
								</div>
							</div>
							<div class="security-list">
								<a href="profile-settings.html"><span><strong>Change password</strong><small>Last changed more than 90 days ago</small></span><i class="bi bi-chevron-right"></i></a><a href="profile-settings.html"><span><strong>AI search privacy</strong><small>Selfie search is available only in enabled galleries</small></span><b>Protected</b><i class="bi bi-chevron-right"></i></a><a href="profile-settings.html"><span><strong>Signed-in devices</strong><small>1 active device</small></span><i class="bi bi-chevron-right"></i></a>
							</div>
						</section>
					</form>
				</div>
			</section>
		</section>
	</main>
	<nav class="workspace-bottom-nav">
		<a href="customer-dashboard.html"><i class="bi bi-grid-1x2"></i><span>Home</span></a><a href="my-photos.html"><i class="bi bi-images"></i><span>Photos</span></a><a href="saved-events.html"><i class="bi bi-bookmark"></i><span>Saved</span></a><a href="orders-downloads.html"><i class="bi bi-bag"></i><span>Orders</span></a><a class="active" href="profile-settings.html"><i class="bi bi-person"></i><span>Profile</span></a>
	</nav>
	 <footer class="footer footer-premium"><div class="container-xl">
   <div class="row g-5 footer-main"><div class="col-lg-5"><a class="footer-logo" href="index.html"><img src="logo.png" alt="PhotoX" style="width:150px"></a><p class="footer-copy">The feeling of being there,<br>kept in a frame.</p><div class="footer-social d-flex gap-3"><a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a><a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a><a href="#" aria-label="Linkedin"><i class="bi bi-linkedin"></i></a></div></div><div class="col-6 col-lg-2"><p class="footer-label">Explore</p><a href="events.html">Events</a><a href="photographers.html">Photographers</a><a href="blog.html">Journal</a><a href="sponsors.html">Sponsors</a></div><div class="col-6 col-lg-2"><p class="footer-label">For creators</p><a href="photographer-dashboard.html">Creator login</a><a href="upload.html">Upload photos</a><a href="photographers.html">Join PhotoX</a><a href="messages.html">Support</a></div><div class="col-12 col-lg-3"><p class="footer-label">Stay in the frame</p><p class="footer-small">New events, fresh galleries and stories from the field.</p><div class="newsletter"><input aria-label="Email address" placeholder="Your email address" type="email"><button aria-label="Subscribe"><i class="bi bi-arrow-up-right"></i></button></div></div></div><div class="footer-bottom"><span>© 2026 PhotoX</span><span>Privacy · Terms ·</span><span>Made for the moments <i class="bi bi-stars"></i></span></div></div></footer>
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div aria-live="polite" class="toast" id="photoToast" role="status">
      <div class="toast-body d-flex align-items-center gap-2">
        <i class="bi bi-check-circle-fill"></i><span>Search ready.</span>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
  </script> 
  <script src="app.js">
  </script>
</body>
</html>