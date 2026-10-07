<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<title>PhotoX Admin | Customer Profile</title>
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
	<link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet">
</head>
<body>
	<div class="app-shell">
		<aside class="sidebar" id="sidebar" aria-label="Main navigation">
      <div class="sidebar-inner">
		<a class="brand" href="/admin/dashboard" aria-label="PhotoX Admin home"><img class="brand-logo" src="{{ asset('admin-assets/logo.png') }}" alt="PhotoX Admin"></a>
        <div class="workspace-switcher"><span class="workspace-avatar">PS</span><span class="workspace-copy"><small>Workspace</small><strong>Photo Studio</strong></span><i class="bi bi-chevron-down"></i></div>
         <a class="dashboard-link nav-link" href="/admin/dashboard"><i class="bi bi-grid-1x2-fill"></i><span>Dashboard</span></a>
        <div class="nav-label nav-label-spaced">Marketplace</div>
        <nav class="nav flex-column sidebar-nav">
          <a class="nav-link" href="/admin/events"><i class="bi bi-calendar-event"></i><span>Events</span></a>
          <a class="nav-link" href="/admin/galleries"><i class="bi bi-collection"></i><span>Galleries</span></a>
          <a class="nav-link" href="/admin/images"><i class="bi bi-image"></i><span>Images</span></a>
          <a class="nav-link" href="/admin/orders"><i class="bi bi-bag-check"></i><span>Orders</span></a>
          <a class="nav-link active" href="/admin/customers"><i class="bi bi-people"></i><span>Customers</span></a>
        </nav>
        <div class="nav-label nav-label-spaced">Photographers</div>
        <nav class="nav flex-column sidebar-nav">
          <a class="nav-link" href="/admin/photographers"><i class="bi bi-camera2"></i><span>Photographers</span></a>
          <a class="nav-link" href="/admin/memberships"><i class="bi bi-person-vcard"></i><span>Memberships</span></a>
          <a class="nav-link" href="/admin/commissions"><i class="bi bi-percent"></i><span>Commissions</span></a>
          <a class="nav-link" href="/admin/payouts"><i class="bi bi-wallet2"></i><span>Payouts</span></a>
        </nav>
        <div class="nav-label nav-label-spaced">AI &amp; Media</div>
        <nav class="nav flex-column sidebar-nav">
          <a class="nav-link" href="/admin/ai-processing"><i class="bi bi-stars"></i><span>AI Processing</span></a>
          <a class="nav-link" href="/admin/storage"><i class="bi bi-cloud-arrow-up"></i><span>Storage</span></a>
          <a class="nav-link" href="/admin/watermarks"><i class="bi bi-droplet"></i><span>Watermarks</span></a>
        </nav>
        <div class="nav-label nav-label-spaced">Business</div>
        <nav class="nav flex-column sidebar-nav">
          <a class="nav-link" href="/admin/payments"><i class="bi bi-credit-card"></i><span>Payments</span></a>
          <a class="nav-link" href="/admin/coupons-discounts"><i class="bi bi-tags"></i><span>Coupons &amp; Discounts</span></a>
          <a class="nav-link" href="/admin/sponsors"><i class="bi bi-award"></i><span>Sponsors</span></a>
          <a class="nav-link" href="/admin/banners"><i class="bi bi-layout-text-window"></i><span>Banners</span></a>
        </nav>
        <div class="nav-label nav-label-spaced">Organisations</div>
        <nav class="nav flex-column sidebar-nav">
          <a class="nav-link" href="/admin/sports"><i class="bi bi-trophy"></i><span>Sports</span></a>
          <a class="nav-link" href="/admin/categories"><i class="bi bi-tags"></i><span>Categories</span></a>
          <a class="nav-link" href="/admin/schools"><i class="bi bi-mortarboard"></i><span>Schools</span></a>
          <a class="nav-link" href="/admin/companies"><i class="bi bi-buildings"></i><span>Companies</span></a>
          <a class="nav-link" href="/admin/vendors"><i class="bi bi-shop"></i><span>Vendors</span></a>
        </nav>
        <div class="nav-label nav-label-spaced">Content</div>
        <nav class="nav flex-column sidebar-nav">
          <a class="nav-link" href="/admin/blog"><i class="bi bi-pencil-square"></i><span>Blog</span></a>
          <a class="nav-link" href="/admin/announcements"><i class="bi bi-megaphone"></i><span>Announcements</span></a>
          <a class="nav-link" href="/admin/messages"><i class="bi bi-chat-left-text"></i><span>Messages</span></a>
          <a class="nav-link" href="/admin/notifications"><i class="bi bi-bell"></i><span>Notifications</span></a>
          <a class="nav-link" href="/admin/email-templates"><i class="bi bi-envelope-paper"></i><span>Email Templates</span></a>
        </nav>
        <div class="nav-label nav-label-spaced">Reporting</div>
        <nav class="nav flex-column sidebar-nav">
          <a class="nav-link" href="/admin/reports"><i class="bi bi-bar-chart"></i><span>Reports</span></a>
          <a class="nav-link" href="/admin/banner-analytics"><i class="bi bi-graph-up-arrow"></i><span>Banner Analytics</span></a>
        </nav>
        <div class="nav-label nav-label-spaced">System</div>
        <nav class="nav flex-column sidebar-nav">
          <a class="nav-link" href="/admin/settings"><i class="bi bi-sliders2"></i><span>Settings</span></a>
          <a class="nav-link" href="/admin/audit-logs"><i class="bi bi-shield-check"></i><span>Audit Logs</span></a>
        </nav>      </div>
    </aside>
		<div class="main-panel">
			<header class="topbar">
				<div class="d-flex align-items-center gap-3">
					<button aria-controls="sidebar" aria-expanded="false" aria-label="Open navigation" class="icon-button menu-trigger" id="menuToggle" type="button"><i class="bi bi-list"></i></button>
					<div class="breadcrumb-wrap">
						<a class="breadcrumb-muted" href="/admin/customers">Customers</a><i class="bi bi-chevron-right"></i><strong>Nadia Maseko</strong>
					</div>
				</div>
				<div class="topbar-actions">
					<button aria-label="Notifications" class="icon-button notification-button" type="button"><i class="bi bi-bell"></i><span></span></button>
					<div class="topbar-divider"></div>
					<div class="profile-menu-wrap">
						<button class="profile-button" type="button" aria-haspopup="true" aria-expanded="false"><span class="profile-avatar">AL</span><span class="profile-copy"><strong>Alex Lee</strong><small>Administrator</small></span><i class="bi bi-chevron-down"></i></button>
						<div class="profile-dropdown-menu" role="menu">
							<form action="{{ route('logout') }}" method="POST" class="d-inline">
  @csrf
  <button type="submit" class="profile-menu-item danger border-0 bg-transparent w-100 text-start py-2 px-3" role="menuitem" style="cursor:pointer;">
    <i class="bi bi-box-arrow-right"></i><span class="ms-2">Logout</span>
  </button>
</form>
						</div>
					</div>
				</div>
			</header>
			<main class="content-area module-page ops-page">
				<div class="page-intro d-flex align-items-end justify-content-between gap-3 flex-wrap">
					<div>
						<p class="eyebrow">Customer account</p>
						<h1>Nadia Maseko</h1>
						<p class="intro-copy">Contact information, account activity and marketplace purchase history.</p>
					</div><a class="btn btn-outline-light" href="/admin/customers"><i class="bi bi-arrow-left"></i> Back to customers</a>
				</div>
				<section class="ops-hero">
					<div class="ops-detail-hero">
						<span class="ops-avatar">NM</span>
						<div>
							<h2>Nadia Maseko</h2>
							<p>nadia@email.co · Cape Town, South Africa</p>
							<div class="profile-meta">
								<span><i class="bi bi-phone"></i> +27 82 420 1108</span><span><i class="bi bi-calendar3"></i> Customer since Jan 2024</span>
							</div>
						</div>
					</div><span class="ops-pill green"><i class="bi bi-check-circle"></i> Active account</span>
				</section>
				<section class="row g-3 mb-3">
					<div class="col-md-3">
						<article class="ops-stat">
							<p>Total orders</p>
							<h2>18</h2><small>6 galleries purchased</small>
						</article>
					</div>
					<div class="col-md-3">
						<article class="ops-stat">
							<p>Lifetime spend</p>
							<h2>R 4,820</h2><small>+24% this year</small>
						</article>
					</div>
					<div class="col-md-3">
						<article class="ops-stat">
							<p>Average order</p>
							<h2>R 268</h2><small>Above marketplace average</small>
						</article>
					</div>
					<div class="col-md-3">
						<article class="ops-stat">
							<p>Last active</p>
							<h2>Today</h2><small>10:14 AM</small>
						</article>
					</div>
				</section>
				<div class="ops-grid-2">
					<section class="ops-panel">
						<div class="section-heading">
							<div>
								<p class="eyebrow">Purchase history</p>
								<h3>Recent orders</h3>
							</div><a class="view-link" href="/admin/admin-orders">View all <i class="bi bi-arrow-up-right"></i></a>
						</div>
						<div class="ops-timeline">
							<div>
								<i class="bi bi-bag-check"></i><span><strong>#PX-2098 · Rugby Day Main Field</strong><small>12 digital images + 4 prints · R 840</small></span><time>Today</time>
							</div>
							<div>
								<i class="bi bi-bag-check"></i><span><strong>#PX-2074 · City Cycle Finish Line</strong><small>8 digital images · R 320</small></span><time>12 Sep</time>
							</div>
							<div>
								<i class="bi bi-bag-check"></i><span><strong>#PX-1981 · Summer Athletics</strong><small>14 digital images · R 560</small></span><time>22 Aug</time>
							</div>
						</div>
					</section>
					<aside class="ops-panel">
						<div class="section-heading">
							<div>
								<p class="eyebrow">Account control</p>
								<h3>Customer status</h3>
							</div><i class="bi bi-shield-lock control-heading-icon"></i>
						</div><label class="form-label" for="customer-status">Status</label><select class="form-select" id="customer-status">
							<option>
								Active account
							</option>
							<option>
								Inactive
							</option>
							<option>
								Blocked
							</option>
						</select><label class="form-label mt-3" for="customer-note">Internal note</label>
						<textarea class="form-control" id="customer-note" placeholder="Record support or account context" rows="3"></textarea>
						<div class="detail-actions">
							<button class="btn btn-primary" type="button"><i class="bi bi-check2"></i> Save status</button><button class="btn btn-outline-danger" type="button">Block account</button>
						</div>
					</aside>
				</div>
				<section class="ops-panel mt-3">
					<div class="section-heading">
						<div>
							<p class="eyebrow">Contact information</p>
							<h3>Customer profile</h3>
						</div><button class="btn btn-outline-light" type="button"><i class="bi bi-pencil"></i> Edit profile</button>
					</div>
					<div class="ops-info-grid">
						<div class="ops-info-item">
							<span>Full name</span><strong>Nadia Maseko</strong>
						</div>
						<div class="ops-info-item">
							<span>Email address</span><strong>nadia@email.co</strong>
						</div>
						<div class="ops-info-item">
							<span>Phone number</span><strong>+27 82 420 1108</strong>
						</div>
						<div class="ops-info-item">
							<span>Preferred location</span><strong>Cape Town, South Africa</strong>
						</div>
					</div>
				</section>
			</main>
		</div>
	</div>
	<div class="sidebar-backdrop" id="sidebarBackdrop"></div>
	<script src="{{ asset('admin-assets/js/app.js') }}">
	</script>
</body>
</html>