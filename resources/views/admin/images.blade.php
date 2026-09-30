<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<title>PhotoX Admin | Images</title>
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
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
          <a class="nav-link active" href="/admin/images"><i class="bi bi-image"></i><span>Images</span></a>
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
						<span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><strong>Images</strong>
					</div>
				</div>
				<div class="topbar-actions">
					<button aria-label="Search" class="icon-button" type="button"><i class="bi bi-search"></i></button><button aria-label="Notifications" class="icon-button notification-button" type="button"><i class="bi bi-bell"></i><span></span></button>
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
				<div class="page-intro">
					<p class="eyebrow">Media inventory</p>
					<h1>Images</h1>
					<p class="intro-copy">Review image inventory, moderation state and AI processing across every gallery.</p>
				</div>
				<section class="row g-3 mb-3">
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-images"></i></span>
							</div>
							<p>Total images</p>
							<h2>2.4M</h2><small>Across 1,284 galleries</small>
						</article>
					</div>
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-check2-circle"></i></span>
							</div>
							<p>Approved</p>
							<h2>2.31M</h2><small>96.2% of inventory</small>
						</article>
					</div>
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-stars"></i></span>
							</div>
							<p>AI processed</p>
							<h2>1.8M</h2><small>74% complete</small>
						</article>
					</div>
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-flag"></i></span>
							</div>
							<p>Needs review</p>
							<h2>128</h2><small>Moderation queue</small>
						</article>
					</div>
				</section>
				<section class="ops-table-panel">
					<div>
						<p class="eyebrow">Image inventory</p>
						<h3>Recent image activity</h3>
					</div>
					<div class="ops-toolbar">
						<div class="search-field">
							<i class="bi bi-search"></i><input aria-label="Search images" placeholder="Search image ID, gallery or photographer" type="search">
						</div><select aria-label="Filter moderation status" class="management-select">
							<option>
								All states
							</option>
							<option>
								Approved
							</option>
							<option>
								Review
							</option>
							<option>
								Hidden
							</option>
						</select><select aria-label="Filter processing state" class="management-select">
							<option>
								All processing
							</option>
							<option>
								Processed
							</option>
							<option>
								Processing
							</option>
							<option>
								Failed
							</option>
						</select>
					</div>
					<div class="ops-table-wrap">
						<table class="table ops-table">
							<thead>
								<tr>
									<th>Image</th>
									<th>Gallery</th>
									<th>Photographer</th>
									<th>File</th>
									<th>AI processing</th>
									<th>Visibility</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<div class="ops-person">
											<img alt="Rugby action thumbnail" class="ops-thumbnail" src="https://images.unsplash.com/photo-1566577739112-5180d4bf9390?auto=format&fit=crop&w=84&q=80"><span><strong>IMG-842910</strong><small>Uploaded 10 min ago</small></span>
										</div>
									</td>
									<td><strong>Rugby Day · Main Field</strong><small>School A Rugby Day</small></td>
									<td><strong>Jordan Miller</strong><small>Cape Town</small></td>
									<td><strong>4.8 MB</strong><small>JPG · 6048×4024</small></td>
									<td><span class="ops-pill blue"><i class="bi bi-stars"></i> Complete</span></td>
									<td><span class="ops-pill green">Visible</span></td>
									<td>
										<div class="ops-actions">
											<a aria-label="View image" class="row-action" href="/admin/gallery-detail"><i class="bi bi-eye"></i></a><button aria-label="More actions" class="row-action" type="button"><i class="bi bi-three-dots"></i></button>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="ops-person">
											<img alt="Cycling action thumbnail" class="ops-thumbnail" src="https://images.unsplash.com/photo-1532297253105-62e3c224b4b1?auto=format&fit=crop&w=84&q=80"><span><strong>IMG-842861</strong><small>Uploaded 24 min ago</small></span>
										</div>
									</td>
									<td><strong>City Cycle · Finish Line</strong><small>City Cycle Classic</small></td>
									<td><strong>Sarah Kim</strong><small>Johannesburg</small></td>
									<td><strong>5.1 MB</strong><small>JPG · 6048×4024</small></td>
									<td><span class="ops-pill orange"><i class="bi bi-arrow-repeat"></i> Processing</span></td>
									<td><span class="ops-pill green">Visible</span></td>
									<td>
										<div class="ops-actions">
											<a aria-label="View image" class="row-action" href="/admin/gallery-detail"><i class="bi bi-eye"></i></a><button aria-label="More actions" class="row-action" type="button"><i class="bi bi-three-dots"></i></button>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="ops-person">
											<img alt="Athletics action thumbnail" class="ops-thumbnail" src="https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=84&q=80"><span><strong>IMG-842712</strong><small>Uploaded yesterday</small></span>
										</div>
									</td>
									<td><strong>Spring Athletics · Track</strong><small>Spring Athletics Meet</small></td>
									<td><strong>Michael Adams</strong><small>Durban</small></td>
									<td><strong>3.9 MB</strong><small>JPG · 5184×3456</small></td>
									<td><span class="ops-pill red"><i class="bi bi-exclamation-circle"></i> Failed</span></td>
									<td><span class="ops-pill orange">Review</span></td>
									<td>
										<div class="ops-actions">
											<a aria-label="View image" class="row-action" href="/admin/gallery-detail"><i class="bi bi-eye"></i></a><button aria-label="More actions" class="row-action" type="button"><i class="bi bi-three-dots"></i></button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="ops-pagination">
						<span>Showing 3 of 2.4M images</span>
						<div>
							<span class="active">1</span><button type="button">2</button><button type="button">3</button><span>...</span><button type="button"><i class="bi bi-chevron-right"></i></button>
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