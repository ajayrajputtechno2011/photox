<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="Manage your PhotoX email notification preferences." name="description">
	<title>PhotoX | Notification settings</title>
	<link href="{{ asset('favicon.png') }}" rel="icon">
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
	<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
	<script defer src="{{ asset('site-ad.js') }}"></script>
</head>
<body class="customer-app dashboard-page photographer-dashboard-page page-photographer-dashboard notifications-page">
	<nav aria-label="Main navigation" class="navbar navbar-expand-lg py-2">
		<div class="container-xl">
			<a aria-label="PhotoX home" class="navbar-brand d-flex align-items-center gap-2" href="/"><img alt="PhotoX" src="{{ asset('logo.png') }}"></a>
			<button aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler border-0 p-0" data-bs-target="#mainNav" data-bs-toggle="collapse" type="button"><i class="bi bi-list fs-2"></i></button>
			<div class="collapse navbar-collapse" id="mainNav">
				<ul class="navbar-nav mx-auto gap-lg-3 mt-3 mt-lg-0">
					<li class="nav-item"><a class="nav-link" href="/">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="/events">Explore</a></li>
					<li class="nav-item"><a class="nav-link" href="/photographers">Photographers</a></li>
					<li class="nav-item"><a class="nav-link" href="/membership">Membership</a></li>
					<li class="nav-item"><a class="nav-link" href="/blog">About</a></li>
					<li class="nav-item"><a class="nav-link" href="/#contact">Contact</a></li>
				</ul>
				<div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
					<div class="header-search d-none d-xl-flex"><i class="bi bi-search"></i><input aria-label="Search dashboard" placeholder="Search jobs, clients, galleries..." type="search"></div>
					<a class="header-cart" href="/cart" aria-label="Open cart"><i class="bi bi-cart3"></i><span>0</span></a>
					<a href="/notifications" class="icon-button notification-button active" aria-label="Notifications"><i class="bi bi-bell"></i><span>3</span></a>
					<div class="account-menu">
						<button aria-label="Open account menu" class="profile-trigger"><span class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'AD', 0, 2)) }}</span><span class="d-none d-sm-inline">{{ Auth::user()->name ?? 'Aiden Daniels' }}</span><i class="bi bi-chevron-down"></i></button>
						<div class="account-dropdown" role="menu">
							<div class="account-dropdown-user"><span class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'AD', 0, 2)) }}</span><div><strong>{{ Auth::user()->name ?? 'Aiden Daniels' }}</strong><small>{{ Auth::user()->email ?? 'aiden@photosouth.com' }}</small></div></div>
							<a href="/photographer-profile"><i class="bi bi-person"></i> Profile & settings</a>
							<form action="{{ route('logout') }}" method="POST" class="d-inline">
								@csrf
								<button type="submit" class="dropdown-item text-danger py-2 w-100 text-start border-0 bg-transparent px-3"><i class="bi bi-box-arrow-left me-2"></i> Log out</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>
	<main class="container-xl workspace-layout photographer-dash notifications-shell">
		<aside aria-label="Photographer navigation" class="photographer-sidebar workspace-sidebar">
			<div class="workspace-greeting"><span class="eyebrow-blue">PHOTOGRAPHER WORKSPACE</span><h1>Frame the<br><em>moment.</em></h1></div>
			<nav class="workspace-nav">
				<a class="workspace-nav-link" href="/photographer-dashboard"><i class="bi bi-grid-1x2"></i><span>Overview</span></a>
				<a class="workspace-nav-link" href="/photographer-bookings"><i class="bi bi-calendar-event"></i><span>Bookings</span><b>12</b></a>
				<a class="workspace-nav-link" href="/photographer-gallery"><i class="bi bi-images"></i><span>Gallery</span></a>
				<a class="workspace-nav-link" href="/photographer-earnings"><i class="bi bi-wallet2"></i><span>Earnings</span></a>
				<a class="workspace-nav-link" href="/photographer-messages"><i class="bi bi-chat-left-text"></i><span>Messages</span></a>
				<a class="workspace-nav-link" href="/photographer-profile"><i class="bi bi-person-circle"></i><span>Profile</span></a>
				<a class="workspace-nav-link active" href="/notifications" aria-current="page"><i class="bi bi-bell"></i><span>Notifications</span></a>
			</nav>
			<div class="workspace-side-note"><i class="bi bi-shield-check"></i><div><strong>Coverage secured</strong><span>3 client galleries are still pending final delivery.</span></div></div>
			<form action="{{ route('logout') }}" method="POST" class="d-inline">
				@csrf
				<button type="submit" class="workspace-logout border-0 bg-transparent w-100 text-start"><i class="bi bi-box-arrow-left"></i> Sign out</button>
			</form>
		</aside>
		<section class="workspace-content notifications-content">
			<div class="workspace-mobile-heading"><span class="eyebrow-blue">YOUR WORKSPACE</span><h2>Notifications.</h2><p>Choose what lands in your inbox.</p></div>
			<section class="workspace-view active">
				<div class="notifications-panel">
					<header class="notifications-heading"><span class="notifications-heading-icon"><i class="bi bi-bell"></i></span><div><span class="eyebrow-blue">PHOTOGRAPHER WORKSPACE</span><h2>Notification settings</h2><p>Choose which booking, gallery and account updates reach you.</p></div></header>
					<div class="notification-preferences" aria-label="Email notification preferences">
						<label class="notification-preference"><span class="notification-preference-copy"><strong>Email notifications</strong><small>Decide if you'd like to receive updates by email.</small></span><span class="notification-preference-control"><span>Allow email notifications</span><input type="checkbox" checked aria-label="Allow email notifications"><i aria-hidden="true"></i></span></label>
						<label class="notification-preference"><span class="notification-preference-copy"><strong>Message emails</strong><small>Get an email when someone sends you a direct message.</small></span><span class="notification-preference-control"><span>Email me about messages</span><input type="checkbox" checked aria-label="Email me about messages"><i aria-hidden="true"></i></span></label>
						<label class="notification-preference"><span class="notification-preference-copy"><strong>Announcement emails</strong><small>Receive platform announcements and important updates by email.</small></span><span class="notification-preference-control"><span>Allow announcement emails</span><input type="checkbox" checked aria-label="Allow announcement emails"><i aria-hidden="true"></i></span></label>
						<label class="notification-preference"><span class="notification-preference-copy"><strong>Tips and reminders</strong><small>Occasional emails to help you get going, like a reminder when an album is still unpublished or photos are left in your cart.</small></span><span class="notification-preference-control"><span>Allow tips and reminders</span><input type="checkbox" checked aria-label="Allow tips and reminders"><i aria-hidden="true"></i></span></label>
						<label class="notification-preference"><span class="notification-preference-copy"><strong>Gallery and order updates</strong><small>Get notified when saved events have new photos or your order is ready.</small></span><span class="notification-preference-control"><span>Email me about updates</span><input type="checkbox" checked aria-label="Email me about gallery and order updates"><i aria-hidden="true"></i></span></label>
					</div>
					<div class="notifications-footnote"><i class="bi bi-info-circle"></i><span>You can change these preferences at any time. Essential account and order emails may still be sent.</span></div>
				</div>
			</section>
		</section>
	</main>
	<nav class="workspace-bottom-nav" aria-label="Mobile photographer navigation">
		<a href="/photographer-dashboard"><i class="bi bi-grid-1x2"></i><span>Home</span></a>
		<a href="/photographer-bookings"><i class="bi bi-calendar-event"></i><span>Bookings</span></a>
		<a href="/photographer-gallery"><i class="bi bi-images"></i><span>Gallery</span></a>
		<a href="/photographer-earnings"><i class="bi bi-wallet2"></i><span>Earnings</span></a>
		<a href="/photographer-profile"><i class="bi bi-person"></i><span>Profile</span></a>
		<a href="/notifications" class="active"><i class="bi bi-bell"></i><span>Alerts</span></a>
	</nav>
	<footer class="footer footer-premium"><div class="container-xl"><div class="row g-5 footer-main"><div class="col-lg-5"><a class="footer-logo" href="/"><img src="{{ asset('logo.png') }}" alt="PhotoX" style="width:150px"></a><p class="footer-copy">The feeling of being there,<br>kept in a frame.</p></div><div class="col-6 col-lg-2"><p class="footer-label">Explore</p><a href="/events">Events</a><a href="/photographers">Photographers</a><a href="/blog">Journal</a></div><div class="col-6 col-lg-2"><p class="footer-label">For creators</p><a href="/photographer-dashboard">Creator login</a><a href="/photographers">Join PhotoX</a></div><div class="col-12 col-lg-3"><p class="footer-label">Stay in the frame</p><p class="footer-small">New events, fresh galleries and stories from the field.</p></div></div><div class="footer-bottom"><span>© 2026 PhotoX</span><span>Privacy · Terms</span><span>Made for the moments <i class="bi bi-stars"></i></span></div></div></footer>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script><script src="{{ asset('app.js') }}"></script>
</body>
</html>
