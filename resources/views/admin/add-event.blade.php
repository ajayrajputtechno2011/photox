<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<title>PhotoX Admin | Create Event</title>
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
						<span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><a href="/admin/events" class="text-decoration-none text-muted">Events</a><i class="bi bi-chevron-right"></i><strong>Create event</strong>
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
				<div class="page-intro">
					<p class="eyebrow">Event workspace</p>
					<h1>Create event</h1>
					<p class="intro-copy">Set up event information, sports categories, publishing rules and photographer delivery settings.</p>
				</div>

				@if($errors->any())
					<div class="alert alert-danger mb-4">
						<ul class="mb-0">
							@foreach($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif

				<form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="ops-form">
					@csrf
					<section class="ops-panel">
						<div class="section-heading">
							<div>
								<p class="eyebrow">01 / Event identity</p>
								<h3>Event information</h3>
							</div><span class="form-step">Required</span>
						</div>
						<div class="row g-3">
							<div class="col-md-8">
								<label class="form-label" for="event-name">Event name <span class="text-danger">*</span></label>
								<input class="form-control" id="event-name" name="title" value="{{ old('title') }}" placeholder="e.g. City Marathon 2026 or School A Rugby Day" required>
							</div>
							<div class="col-md-4">
								<label class="form-label" for="category-id">Sport / Category <span class="text-danger">*</span></label>
								<select class="form-select" id="category-id" name="category_id" required>
									<option value="">Select sport category...</option>
									@foreach($categories as $cat)
										<option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-6">
								<label class="form-label" for="location">Location / City <span class="text-danger">*</span></label>
								<input class="form-control" id="location" name="location" value="{{ old('location') }}" placeholder="e.g. Cape Town, Stellenbosch, Durban" required>
							</div>
							<div class="col-md-6">
								<label class="form-label" for="event_date">Event Date</label>
								<input class="form-control" id="event_date" name="event_date" type="date" value="{{ old('event_date', date('Y-m-d')) }}">
							</div>
							<div class="col-md-6">
								<label class="form-label" for="starting_price">Pricing Starting From</label>
								<input class="form-control" id="starting_price" name="starting_price" value="{{ old('starting_price', 'From R90') }}" placeholder="e.g. From R90">
							</div>
							<div class="col-md-6">
								<label class="form-label" for="photographers_count">Assigned Photographers</label>
								<input class="form-control" id="photographers_count" name="photographers_count" type="number" value="{{ old('photographers_count', 1) }}">
							</div>
							<div class="col-12">
								<label class="form-label" for="cover_image">Cover Image URL</label>
								<input class="form-control" id="cover_image" name="cover_image" value="{{ old('cover_image') }}" placeholder="https://images.unsplash.com/...">
								<div class="text-center my-2 text-muted small">— OR UPLOAD FILE —</div>
								<input type="file" name="cover_file" class="form-control" accept="image/*">
							</div>
							<div class="col-12">
								<label class="form-label" for="description">Description</label>
								<textarea class="form-control" id="description" name="description" placeholder="Add the event description shown to customers and athletes" rows="3">{{ old('description') }}</textarea>
							</div>
						</div>
					</section>

					<section class="ops-panel">
						<div class="section-heading">
							<div>
								<p class="eyebrow">02 / Publishing settings</p>
								<h3>Visibility &amp; Features</h3>
							</div><span class="form-step">Configuration</span>
						</div>
						<div class="row g-3">
							<div class="col-md-6">
								<label class="form-label" for="status">Event Status</label>
								<select class="form-select" id="status" name="status">
									<option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published (Live on website)</option>
									<option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft (Private)</option>
									<option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived</option>
								</select>
							</div>
							<div class="col-md-6 d-flex align-items-center pt-4">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" name="is_featured" value="1" id="isFeaturedSwitch" {{ old('is_featured') ? 'checked' : '' }}>
									<label class="form-check-label fw-bold" for="isFeaturedSwitch">Feature on Explore page hero/latest</label>
								</div>
							</div>
						</div>
					</section>

					<div class="ops-form-actions">
						<a class="btn btn-outline-secondary" href="/admin/events">Cancel</a>
						<button class="btn btn-primary" type="submit"><i class="bi bi-broadcast"></i> Create &amp; Save Event</button>
					</div>
				</form>
			</main>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="{{ asset('admin-assets/js/app.js') }}"></script>
</body>
</html>