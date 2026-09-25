<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<title>PhotoX Admin | Events</title>
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
          <a class="nav-link active" href="/admin/events"><i class="bi bi-calendar-event"></i><span>Events</span></a>
          <a class="nav-link" href="/admin/galleries"><i class="bi bi-collection"></i><span>Galleries</span></a>
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
          <a class="nav-link" href="/admin/page-banners"><i class="bi bi-card-heading"></i><span>Page Banners</span></a>
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
        </nav>
      </div>
    </aside>
		<div class="main-panel">
			<header class="topbar">
				<div class="d-flex align-items-center gap-3">
					<button aria-controls="sidebar" aria-expanded="false" aria-label="Open navigation" class="icon-button menu-trigger" id="menuToggle" type="button"><i class="bi bi-list"></i></button>
					<div class="breadcrumb-wrap">
						<span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><strong>Events</strong>
					</div>
				</div>
				<div class="topbar-actions">
					<div class="profile-menu-wrap">
						<button class="profile-button" type="button" aria-haspopup="true" aria-expanded="false"><span class="profile-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'AD', 0, 2)) }}</span><span class="profile-copy"><strong>{{ Auth::user()->name ?? 'Admin' }}</strong><small>Administrator</small></span><i class="bi bi-chevron-down"></i></button>
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
				@if(session('success'))
					<div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
						<i class="bi bi-check-circle me-2"></i>{{ session('success') }}
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				@endif

				<div class="page-intro d-flex align-items-end justify-content-between gap-3 flex-wrap">
					<div>
						<p class="eyebrow">Marketplace calendar</p>
						<h1>Events</h1>
						<p class="intro-copy">Manage event publishing, photographer assignments and gallery delivery.</p>
					</div>
					<a class="btn create-button" href="/admin/add-event"><i class="bi bi-plus-lg"></i> Create event</a>
				</div>
				<section class="row g-3 mb-3">
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-calendar-event"></i></span>
							</div>
							<p>Total events</p>
							<h2>{{ $totalEvents }}</h2>
							<small>Configured sports &amp; community events</small>
						</article>
					</div>
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-broadcast"></i></span>
							</div>
							<p>Published</p>
							<h2>{{ $publishedCount }}</h2>
							<small>Live on public marketplace</small>
						</article>
					</div>
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-clock"></i></span>
							</div>
							<p>Upcoming</p>
							<h2>{{ $upcomingCount }}</h2>
							<small>Scheduled fixtures</small>
						</article>
					</div>
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-images"></i></span>
							</div>
							<p>Photos archived</p>
							<h2>{{ number_format($totalPhotos) }}</h2>
							<small>Across all event galleries</small>
						</article>
					</div>
				</section>
				<section class="ops-table-panel">
					<div class="d-flex align-items-start justify-content-between gap-3">
						<div>
							<p class="eyebrow">Event management</p>
							<h3>All events</h3>
						</div>
					</div>
					<form method="GET" action="{{ route('admin.events.index') }}" class="ops-toolbar">
						<div class="search-field">
							<i class="bi bi-search"></i>
							<input name="search" value="{{ request('search') }}" aria-label="Search events" placeholder="Search event name, location or sport..." type="search">
						</div>
						<select name="status" class="management-select" onchange="this.form.submit()">
							<option value="">All statuses</option>
							<option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
							<option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
							<option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>
						</select>
						<select name="category" class="management-select" onchange="this.form.submit()">
							<option value="">All sports</option>
							@foreach($categories as $cat)
								<option value="{{ $cat->name }}" {{ request('category') === $cat->name ? 'selected' : '' }}>{{ $cat->name }}</option>
							@endforeach
						</select>
						@if(request()->hasAny(['search', 'status', 'category']))
							<a href="{{ route('admin.events.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
						@endif
						<a class="export-button ms-auto" href="/admin/add-event"><i class="bi bi-plus-lg"></i> New event</a>
					</form>
					<div class="ops-table-wrap">
						<table class="table ops-table">
							<thead>
								<tr>
									<th>Event</th>
									<th>Sport / date</th>
									<th>Photographers</th>
									<th>Photos</th>
									<th>Pricing</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@forelse($events as $event)
									<tr>
										<td>
											<div class="d-flex align-items-center gap-2">
												<img src="{{ $event->cover_image }}" alt="{{ $event->title }}" style="width: 44px; height: 44px; object-fit: cover; border-radius: 6px;">
												<div>
													<strong>{{ $event->title }}</strong>
													<small class="d-block text-muted">{{ $event->location }}</small>
												</div>
											</div>
										</td>
										<td>
											<strong>{{ $event->category_name }}</strong>
											<small class="d-block text-muted">{{ $event->event_date ? $event->event_date->format('d M Y') : 'Date TBD' }}</small>
										</td>
										<td>
											<strong>{{ $event->photographers_count }} assigned</strong>
										</td>
										<td>
											<strong>{{ number_format($event->total_photos) }} photos</strong>
										</td>
										<td>
											<span class="badge bg-light text-dark border">{{ $event->starting_price }}</span>
										</td>
										<td>
											@if($event->status === 'published')
												<span class="ops-pill blue">Published</span>
											@elseif($event->status === 'draft')
												<span class="ops-pill orange">Draft</span>
											@else
												<span class="ops-pill text-secondary">Archived</span>
											@endif
											@if($event->is_featured)
												<span class="badge bg-warning text-dark ms-1">Featured</span>
											@endif
										</td>
										<td>
											<div class="ops-actions">
												<a aria-label="View on site" class="row-action" href="/events" target="_blank" title="View on site"><i class="bi bi-box-arrow-up-right"></i></a>
												<form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete \'{{ $event->title }}\'?');">
													@csrf
													@method('DELETE')
													<button type="submit" class="row-action border-0 bg-transparent text-danger" title="Delete event">
														<i class="bi bi-trash"></i>
													</button>
												</form>
											</div>
										</td>
									</tr>
								@empty
									<tr>
										<td colspan="7" class="text-center py-4 text-muted">
											<i class="bi bi-inbox fs-2 d-block mb-2"></i>
											No events found.
										</td>
									</tr>
								@endforelse
							</tbody>
						</table>
					</div>
					<div class="p-3">
						{{ $events->links('admin.partials.pagination') }}
					</div>
				</section>
			</main>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="{{ asset('admin-assets/js/app.js') }}"></script>
</body>
</html>