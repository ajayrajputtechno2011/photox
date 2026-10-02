<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<title>PhotoX Admin | Photographer Detail</title>
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
          <a class="nav-link" href="/admin/customers"><i class="bi bi-people"></i><span>Customers</span></a>
        </nav>
        <div class="nav-label nav-label-spaced">Photographers</div>
        <nav class="nav flex-column sidebar-nav">
          <a class="nav-link active" href="/admin/photographers"><i class="bi bi-camera2"></i><span>Photographers</span></a>
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
						<a class="breadcrumb-muted" href="/admin/photographers">Photographers</a><i class="bi bi-chevron-right"></i><strong>Jordan Miller</strong>
					</div>
				</div>
			</header>
			<main class="content-area module-page">
				<div class="page-intro detail-intro">
					<p class="eyebrow">Photographer account</p>
					<h1>Jordan Miller</h1>
					<p class="intro-copy">Profile, verification, marketplace activity and account controls.</p>
					<div class="detail-actions">
						<a class="btn btn-outline-light" href="/admin/photographers"><i class="bi bi-arrow-left"></i> Back to directory</a><a class="btn btn-primary" href="add-photograper.html?edit=jordan"><i class="bi bi-pencil"></i> Edit profile</a>
					</div>
				</div>
				<section class="profile-hero panel">
					<img alt="Jordan Miller" src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&amp;fit=crop&amp;w=180&amp;q=80">
					<div class="profile-hero-copy">
						<div class="profile-title-row">
							<div>
								<h2>Jordan Miller</h2>
								<p>jordan@lens.co · Cape Town, South Africa</p>
							</div><span class="status-pill status-verified"><i class="bi bi-check-circle-fill"></i> Verified</span>
						</div>
						<div class="profile-meta">
							<span><i class="bi bi-phone"></i> +27 82 441 9082</span><span><i class="bi bi-person-vcard"></i> Pro Studio member</span><span><i class="bi bi-calendar3"></i> Joined 12 Jan 2024</span>
						</div>
					</div>
				</section>
				<section class="row g-3 detail-metrics">
					<div class="col-md-3">
						<article class="stat-card">
							<p>Events covered</p>
							<h2>24</h2><small>8 active this season</small>
						</article>
					</div>
					<div class="col-md-3">
						<article class="stat-card">
							<p>Galleries</p>
							<h2>86</h2><small>48,920 images uploaded</small>
						</article>
					</div>
					<div class="col-md-3">
						<article class="stat-card">
							<p>Marketplace sales</p>
							<h2>R 8,420</h2><small class="sales-up">+18.4% this month</small>
						</article>
					</div>
					<div class="col-md-3">
						<article class="stat-card">
							<p>Pending payout</p>
							<h2>R 1,260</h2><small>Next payout 30 Sep</small>
						</article>
					</div>
				</section>
				<div class="admin-detail-grid">
					<section class="panel detail-card">
						<div class="section-heading">
							<div>
								<p class="eyebrow">Marketplace activity</p>
								<h3>Recent work and sales</h3>
							</div><a class="view-link" href="/admin/galleries">View galleries <i class="bi bi-arrow-up-right"></i></a>
						</div>
						<div class="activity-list">
							<div>
								<span class="activity-icon blue"><i class="bi bi-collection"></i></span><span><strong>School A Rugby Day</strong><small>Gallery published · 2,450 images</small></span><b>Today</b>
							</div>
							<div>
								<span class="activity-icon orange"><i class="bi bi-bag-check"></i></span><span><strong>Print order #PX-2098</strong><small>12 prints · customer order completed</small></span><b>Yesterday</b>
							</div>
							<div>
								<span class="activity-icon green"><i class="bi bi-calendar-event"></i></span><span><strong>City Sports Finals</strong><small>Event assignment confirmed</small></span><b>18 Sep</b>
							</div>
						</div>
					</section>
					<aside class="panel detail-card">
						<div class="section-heading">
							<div>
								<p class="eyebrow">Admin control</p>
								<h3>Account status</h3>
							</div><i class="bi bi-shield-lock control-heading-icon"></i>
						</div><label class="form-label" for="account-status">Status</label><select class="form-select" id="account-status">
							<option>
								Verified and active
							</option>
							<option>
								Pending verification
							</option>
							<option>
								Suspended
							</option>
						</select><label class="form-label mt-3" for="admin-note">Internal note</label>
						<textarea class="form-control" id="admin-note" placeholder="Record reason for account changes" rows="3"></textarea>
						<div class="detail-actions">
							<button class="btn btn-primary" type="button"><i class="bi bi-check2"></i> Save status</button><button class="btn btn-outline-danger" type="button"><i class="bi bi-pause-circle"></i> Suspend</button>
						</div>
					</aside>
				</div>
				<section class="panel detail-card account-info">
					<div class="section-heading">
						<div>
							<p class="eyebrow">Account information</p>
							<h3>Verification and payout details</h3>
						</div>
					</div>
					<dl class="summary-list">
						<dd>
							<div>
								<dl>
									<dt>Verification documents</dt>
									<dd><span class="status-pill status-verified">Approved</span></dd>
								</dl>
							</div>
							<div>
								<dl>
									<dt>Commission rate</dt>
									<dd>20% marketplace commission</dd>
								</dl>
							</div>
							<div>
								<dl>
									<dt>Payout method</dt>
									<dd>Bank transfer · ending 4821</dd>
								</dl>
							</div>
							<div>
								<dl>
									<dt>Last admin review</dt>
									<dd>Alex Lee · 18 Sep 2026</dd>
								</dl>
							</div>
						</dd>
					</dl>
				</section>
			</main>
		</div>
	</div>
	<div class="sidebar-backdrop" id="sidebarBackdrop"></div>
	<script src="{{ asset('admin-assets/js/app.js') }}">
	</script>
</body>
</html>