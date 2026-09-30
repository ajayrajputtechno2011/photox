<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<title>PhotoX Admin | Gallery Detail</title>
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
          <a class="nav-link active" href="/admin/galleries"><i class="bi bi-collection"></i><span>Galleries</span></a>
          <a class="nav-link" href="/admin/images"><i class="bi bi-image"></i><span>Images</span></a>
          <a class="nav-link" href="/admin/orders"><i class="bi bi-bag-check"></i><span>Orders</span></a>
          <a class="nav-link" href="/admin/customers"><i class="bi bi-people"></i><span>Customers</span></a>
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
						<a class="breadcrumb-muted" href="/admin/galleries">Galleries</a><i class="bi bi-chevron-right"></i><strong>Rugby Day · Main Field</strong>
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
						<p class="eyebrow">Gallery overview</p>
						<h1>Rugby Day · Main Field</h1>
						<p class="intro-copy">School A Rugby Day · Jordan Miller · Updated 18 minutes ago.</p>
					</div>
					<div class="detail-actions">
						<a class="btn btn-outline-light" href="/admin/galleries"><i class="bi bi-arrow-left"></i> Back</a><a class="btn btn-primary" href="/admin/images"><i class="bi bi-images"></i> Manage images</a>
					</div>
				</div>
				<section class="ops-hero">
					<div class="ops-detail-hero">
						<span class="ops-hero-icon"><i class="bi bi-collection"></i></span>
						<div>
							<h2>Rugby Day · Main Field</h2>
							<p>2,450 images · 48.9 GB · Created 24 Sep 2026</p>
						</div>
					</div><span class="ops-pill green"><i class="bi bi-eye"></i> Published</span>
				</section>
				<section class="row g-3 mb-3">
					<div class="col-md-3">
						<article class="ops-stat">
							<p>Image count</p>
							<h2>2,450</h2><small>48.9 GB storage</small>
						</article>
					</div>
					<div class="col-md-3">
						<article class="ops-stat">
							<p>AI status</p>
							<h2>Ready</h2><small>Face matching complete</small>
						</article>
					</div>
					<div class="col-md-3">
						<article class="ops-stat">
							<p>Customer views</p>
							<h2>12.4k</h2><small>+18% this week</small>
						</article>
					</div>
					<div class="col-md-3">
						<article class="ops-stat">
							<p>Expires</p>
							<h2>24 Dec</h2><small>90-day retention</small>
						</article>
					</div>
				</section>
				<div class="ops-grid-2">
					<section class="ops-panel">
						<div class="section-heading">
							<div>
								<p class="eyebrow">Gallery metadata</p>
								<h3>Linked event and photographer</h3>
							</div><i class="bi bi-info-circle control-heading-icon"></i>
						</div>
						<div class="ops-info-grid">
							<div class="ops-info-item">
								<span>Linked event</span><strong>School A Rugby Day</strong>
							</div>
							<div class="ops-info-item">
								<span>Photographer</span><strong>Jordan Miller</strong>
							</div>
							<div class="ops-info-item">
								<span>Gallery type</span><strong>Sports event · Main field</strong>
							</div>
							<div class="ops-info-item">
								<span>Created</span><strong>24 Sep 2026 · 16:42</strong>
							</div>
						</div>
						<div class="detail-actions">
							<a class="btn btn-primary" href="/admin/images"><i class="bi bi-images"></i> Open image manager</a>
						</div>
					</section>
					<aside class="ops-panel">
						<div class="section-heading">
							<div>
								<p class="eyebrow">Gallery controls</p>
								<h3>Visibility and AI</h3>
							</div><i class="bi bi-sliders2 control-heading-icon"></i>
						</div><label class="form-label" for="gallery-visibility">Visibility</label><select class="form-select" id="gallery-visibility">
							<option>
								Published · public
							</option>
							<option>
								Private · invite only
							</option>
							<option>
								Draft
							</option>
						</select><label class="form-label mt-3" for="ai-status">AI processing</label><select class="form-select" id="ai-status">
							<option>
								Enabled · processed
							</option>
							<option>
								Disabled
							</option>
						</select><label class="form-label mt-3" for="expiry-date">Expiry date</label><input class="form-control" id="expiry-date" type="date" value="2026-12-24">
						<div class="detail-actions">
							<button class="btn btn-primary" type="button"><i class="bi bi-check2"></i> Save settings</button>
						</div>
					</aside>
				</div>
				<section class="ops-panel mt-3">
					<div class="section-heading">
						<div>
							<p class="eyebrow">Recent media</p>
							<h3>Gallery preview</h3>
						</div><a class="view-link" href="/admin/images">View all images <i class="bi bi-arrow-up-right"></i></a>
					</div>
					<div class="row g-2">
						<div class="col-6 col-md-3"><img alt="Rugby gallery preview" class="w-100 ops-thumbnail" src="https://images.unsplash.com/photo-1566577739112-5180d4bf9390?auto=format&fit=crop&w=320&q=80" style="height:130px"></div>
						<div class="col-6 col-md-3"><img alt="Sports gallery preview" class="w-100 ops-thumbnail" src="https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=320&q=80" style="height:130px"></div>
						<div class="col-6 col-md-3"><img alt="Field gallery preview" class="w-100 ops-thumbnail" src="https://images.unsplash.com/photo-1518609878373-06d740f60d8b?auto=format&fit=crop&w=320&q=80" style="height:130px"></div>
						<div class="col-6 col-md-3"><img alt="Team gallery preview" class="w-100 ops-thumbnail" src="https://images.unsplash.com/photo-1521412644187-c49fa049e84d?auto=format&fit=crop&w=320&q=80" style="height:130px"></div>
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