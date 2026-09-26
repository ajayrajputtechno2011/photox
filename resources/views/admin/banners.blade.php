<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<title>PhotoX Admin | Banner Ads</title>
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
	<link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet">
	<style>
		/* High contrast, ultra-clear modal styles */
		.modal-content {
			background-color: #ffffff !important;
			color: #0f172a !important;
			border-radius: 12px;
			box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
			border: 1px solid #cbd5e1;
		}
		.modal-header {
			background-color: #f8fafc !important;
			border-bottom: 1px solid #e2e8f0 !important;
			padding: 1rem 1.25rem;
		}
		.modal-title {
			color: #0f172a !important;
			font-weight: 700 !important;
			font-size: 1.15rem;
		}
		.modal-footer {
			background-color: #f8fafc !important;
			border-top: 1px solid #e2e8f0 !important;
			padding: 0.85rem 1.25rem;
		}
		.modal-body {
			padding: 1.25rem;
			color: #1e293b !important;
		}
		.modal .form-label {
			color: #0f172a !important;
			font-weight: 700 !important;
			font-size: 0.875rem !important;
			margin-bottom: 0.35rem;
			display: block;
			letter-spacing: 0.01em;
		}
		.modal .text-muted, 
		.modal small.text-muted,
		.modal .form-text {
			color: #64748b !important;
			font-size: 0.78rem !important;
			font-weight: 400;
		}
		.modal .form-control, 
		.modal .form-select {
			color: #0f172a !important;
			background-color: #ffffff !important;
			border: 1px solid #cbd5e1 !important;
			border-radius: 6px;
			font-size: 0.875rem;
			padding: 0.55rem 0.75rem;
		}
		.modal .form-control::placeholder {
			color: #94a3b8 !important;
			opacity: 1;
		}
		.modal .form-control:focus, 
		.modal .form-select:focus {
			border-color: #ff8a00 !important;
			box-shadow: 0 0 0 3px rgba(255, 138, 0, 0.18) !important;
		}
		.modal .form-check-label {
			color: #0f172a !important;
			font-weight: 600;
			font-size: 0.875rem;
		}
		.modal .divider-text {
			color: #64748b !important;
			font-weight: 600;
			font-size: 0.75rem;
			text-transform: uppercase;
			letter-spacing: 0.05em;
		}
		.modal img {
			max-width: 100% !important;
			height: auto;
		}
	</style>
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
          <a class="nav-link active" href="/admin/banners"><i class="bi bi-layout-text-window"></i><span>Banners</span></a>
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
						<span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><strong>Banners</strong>
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

				@if(session('error'))
					<div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
						<i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				@endif

				<div class="page-intro d-flex align-items-end justify-content-between gap-3 flex-wrap">
					<div>
						<p class="eyebrow">Marketing &amp; Advertising</p>
						<h1>Banner Ads</h1>
						<p class="intro-copy">Manage dynamic hero ad carousels on the Explore/Events page and site-wide sponsor placements.</p>
					</div>
					<div class="d-flex gap-2 flex-wrap">
						<a class="btn create-button" href="/admin/add-banner">
							<i class="bi bi-layout-text-window"></i> Create Banner
						</a>
						<button class="btn create-button" type="button" data-bs-toggle="modal" data-bs-target="#addBannerModal">
							<i class="bi bi-plus-lg"></i> Quick Add
						</button>
					</div>
				</div>

				<section class="row g-3 mb-3">
					<div class="col-xl-4 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-layout-text-window"></i></span>
							</div>
							<p>Total Banners</p>
							<h2>{{ $totalCount }}</h2>
							<small>Configured advertisement banners</small>
						</article>
					</div>
					<div class="col-xl-4 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-broadcast"></i></span>
							</div>
							<p>Active Live Slides</p>
							<h2>{{ $activeCount }}</h2>
							<small>Rotating on public pages</small>
						</article>
					</div>
					<div class="col-xl-4 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-eye-slash"></i></span>
							</div>
							<p>Inactive Banners</p>
							<h2>{{ $totalCount - $activeCount }}</h2>
							<small>Draft / archived ads</small>
						</article>
					</div>
				</section>

				<section class="ops-table-panel">
					<div class="d-flex align-items-start justify-content-between gap-3 mb-3">
						<div>
							<p class="eyebrow">Placements / Ad Inventory</p>
							<h3>All Banners</h3>
						</div>
					</div>

					<form method="GET" action="{{ route('admin.banners.index') }}" class="ops-toolbar">
						<select name="placement" class="management-select" onchange="this.form.submit()">
							<option value="">All Placements</option>
							<option value="events_hero" {{ request('placement') === 'events_hero' ? 'selected' : '' }}>Explore Hero (Carousel)</option>
							<option value="home_top" {{ request('placement') === 'home_top' ? 'selected' : '' }}>Home Top</option>
							<option value="event_detail" {{ request('placement') === 'event_detail' ? 'selected' : '' }}>Event Detail</option>
							<option value="marketplace" {{ request('placement') === 'marketplace' ? 'selected' : '' }}>Marketplace</option>
							<option value="sidebar" {{ request('placement') === 'sidebar' ? 'selected' : '' }}>Sidebar</option>
							<option value="image_preview" {{ request('placement') === 'image_preview' ? 'selected' : '' }}>Image Preview (Lightbox Ad)</option>
						</select>
						<select name="status" class="management-select" onchange="this.form.submit()">
							<option value="">All Statuses</option>
							<option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
							<option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
						</select>
						@if(request()->hasAny(['placement', 'status']))
							<a href="{{ route('admin.banners.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
						@endif
					</form>

					<div class="ops-table-wrap">
						<table class="table ops-table">
							<thead>
								<tr>
									<th>Preview</th>
									<th>Title &amp; Subtitle</th>
									<th>Badge</th>
									<th>Placement</th>
									<th>Target Category</th>
									<th>Sort Order</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@forelse($banners as $banner)
									<tr>
										<td style="width: 100px;">
											<div class="rounded overflow-hidden border shadow-sm" style="width: 80px; height: 90px; background: #000;">
												<img src="{{ $banner->image_url }}" alt="{{ $banner->title }}" style="width: 100%; height: 100%; object-fit: cover;">
											</div>
										</td>
										<td>
											<strong class="d-block" style="white-space: pre-line;">{{ $banner->title }}</strong>
											<small class="text-muted">{{ $banner->subtitle }}</small>
											@if($banner->link_url)
												<div class="mt-1"><a href="{{ $banner->link_url }}" target="_blank" class="small text-decoration-none text-primary"><i class="bi bi-box-arrow-up-right me-1"></i>{{ Str::limit($banner->link_url, 30) }}</a></div>
											@endif
										</td>
										<td><span class="badge bg-secondary">{{ $banner->badge_text }}</span></td>
										<td><code>{{ $banner->placement }}</code></td>
										<td>
											@if($banner->category_name)
												<span class="badge bg-primary-subtle text-primary border"><i class="bi bi-tag me-1"></i>{{ $banner->category_name }}</span>
											@else
												<span class="badge bg-secondary-subtle text-secondary border">All Sports (Global)</span>
											@endif
										</td>
										<td>{{ $banner->sort_order }}</td>
										<td>
											<form action="{{ route('admin.banners.toggle', $banner) }}" method="POST" class="d-inline">
												@csrf
												@method('PATCH')
												<button type="submit" class="border-0 bg-transparent p-0" title="Click to toggle status">
													@if($banner->is_active)
														<span class="ops-pill green" style="cursor:pointer;"><i class="bi bi-check-circle"></i> Active</span>
													@else
														<span class="ops-pill orange" style="cursor:pointer;"><i class="bi bi-x-circle"></i> Inactive</span>
													@endif
												</button>
											</form>
										</td>
										<td>
											<div class="ops-actions">
												<button type="button" class="row-action border-0 bg-transparent" title="Edit Banner"
													data-bs-toggle="modal" data-bs-target="#editBannerModal{{ $banner->id }}">
													<i class="bi bi-pencil"></i>
												</button>
												<form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this banner?');">
													@csrf
													@method('DELETE')
													<button type="submit" class="row-action border-0 bg-transparent text-danger" title="Delete Banner">
														<i class="bi bi-trash"></i>
													</button>
												</form>
											</div>

											<!-- Edit Banner Modal -->
											<div class="modal fade" id="editBannerModal{{ $banner->id }}" tabindex="-1" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered">
													<div class="modal-content">
														<form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
															@csrf
															@method('PUT')
															<div class="modal-header">
																<h5 class="modal-title">Edit Banner Ad</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
															</div>
															<div class="modal-body text-start">
																<div class="mb-3">
																	<label class="form-label">Banner name / Title <small class="text-muted fw-normal">(Optional — leave blank for designed graphic banners)</small></label>
																	<textarea name="title" class="form-control" rows="2" placeholder="e.g. Gilbert Rugby (Optional)">{{ $banner->title }}</textarea>
																	<small class="text-muted d-block mt-1">Leave blank if the graphic banner already contains text. Use Enter for line breaks.</small>
																</div>
																<div class="mb-3">
																	<label class="form-label">Subtitle <small class="text-muted fw-normal">(Optional)</small></label>
																	<input type="text" name="subtitle" class="form-control" value="{{ $banner->subtitle }}" placeholder="e.g. Official Match Gear 2026">
																</div>
																<div class="mb-3">
																	<label class="form-label">Sponsor / Company <small class="text-muted fw-normal">(Optional)</small></label>
																	<input type="text" name="badge_text" class="form-control" value="{{ $banner->badge_text }}" placeholder="e.g. Gilbert Rugby, Peak Energy">
																</div>
																<div class="mb-3">
																	<label class="form-label">Current Image</label>
																	<div class="mb-2 p-2 rounded w-100 text-center" style="background: #f8fafc; border: 1px solid #e2e8f0; overflow: hidden; max-width: 100%;">
																		<img src="{{ $banner->image_url }}" alt="Preview" style="max-width: 100%; max-height: 140px; width: auto; height: auto; border-radius: 6px; object-fit: contain; display: block; margin: 0 auto;">
																	</div>
																	<label class="form-label mt-2">Update Image URL</label>
																	<input type="text" name="image_url" class="form-control" value="{{ $banner->image_url }}" placeholder="https://... or /storage/...">
																	<div class="text-center my-2 text-muted small fw-semibold">— OR UPLOAD FILE —</div>
																	<input type="file" name="image_file" class="form-control" accept="image/*">
																</div>
																<div class="row">
																	<div class="col-6 mb-3">
																		<label class="form-label">Link URL</label>
																		<input type="text" name="link_url" class="form-control" value="{{ $banner->link_url }}" placeholder="https://... or /events">
																	</div>
																	<div class="col-6 mb-3">
																		<label class="form-label">Placement</label>
																		<select name="placement" class="form-select">
																			<option value="events_hero" {{ in_array($banner->placement, ['events_hero', 'explore_hero']) ? 'selected' : '' }}>Explore Hero (Carousel)</option>
																			<option value="image_preview" {{ $banner->placement === 'image_preview' ? 'selected' : '' }}>Image Preview (Lightbox Ad)</option>
																			<option value="home_top" {{ $banner->placement === 'home_top' ? 'selected' : '' }}>Home Top</option>
																			<option value="event_detail" {{ $banner->placement === 'event_detail' ? 'selected' : '' }}>Event Detail</option>
																			<option value="marketplace" {{ $banner->placement === 'marketplace' ? 'selected' : '' }}>Marketplace</option>
																			<option value="sidebar" {{ $banner->placement === 'sidebar' ? 'selected' : '' }}>Sidebar</option>
																		</select>
																	</div>
																	<div class="col-12 mb-3">
																		<label class="form-label">Target Sport Category</label>
																		<select name="category_id" class="form-select">
																			<option value="">All Sports / Display Everywhere</option>
																			@foreach($categories as $cat)
																				<option value="{{ $cat->id }}" {{ $banner->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
																			@endforeach
																		</select>
																		<small class="text-muted d-block mt-1">Target this ad to a specific sport (e.g. Rugby) or show everywhere.</small>
																	</div>
																</div>
																<div class="row">
																	<div class="col-6 mb-3">
																		<label class="form-label">Sort Order</label>
																		<input type="number" name="sort_order" class="form-control" value="{{ $banner->sort_order }}">
																	</div>
																	<div class="col-6 mb-3 d-flex align-items-center pt-4">
																		<div class="form-check form-switch">
																			<input class="form-check-input" type="checkbox" name="is_active" value="1" id="bannerActiveSwitch{{ $banner->id }}" {{ $banner->is_active ? 'checked' : '' }}>
																			<label class="form-check-label ms-2" for="bannerActiveSwitch{{ $banner->id }}">Active</label>
																		</div>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
																<button type="submit" class="btn btn-primary">Save Changes</button>
															</div>
														</form>
													</div>
												</div>
											</div>
										</td>
									</tr>
								@empty
									<tr>
										<td colspan="7" class="text-center py-4 text-muted">
											<i class="bi bi-inbox fs-2 d-block mb-2"></i>
											No banners found.
										</td>
									</tr>
								@endforelse
							</tbody>
						</table>
					</div>

					<div class="p-3">
						{{ $banners->links('admin.partials.pagination') }}
					</div>
				</section>
			</main>
		</div>
	</div>

	<!-- Add Banner Modal -->
	<div class="modal fade" id="addBannerModal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="modal-header">
						<h5 class="modal-title">Create New Banner Ad</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body text-start">
						<div class="mb-3">
							<label class="form-label">Banner name / Title <small class="text-muted fw-normal">(Optional — leave blank for designed graphic banners)</small></label>
							<textarea name="title" class="form-control" rows="2" placeholder="e.g. Gilbert Rugby (Optional)"></textarea>
							<small class="text-muted d-block mt-1">Leave blank if your banner artwork already contains text/branding. Use Enter for line breaks.</small>
						</div>
						<div class="mb-3">
							<label class="form-label">Subtitle <small class="text-muted fw-normal">(Optional)</small></label>
							<input type="text" name="subtitle" class="form-control" placeholder="e.g. Official Match Gear 2026">
						</div>
						<div class="mb-3">
							<label class="form-label">Sponsor / Company <small class="text-muted fw-normal">(Optional)</small></label>
							<input type="text" name="badge_text" class="form-control" placeholder="e.g. Gilbert Rugby, Peak Energy">
						</div>
						<div class="mb-3">
							<label class="form-label">Image URL <small class="text-muted fw-normal">(or upload file below)</small></label>
							<input type="text" name="image_url" class="form-control" placeholder="https://images.unsplash.com/... or /storage/...">
							<div class="text-center my-2 text-muted small fw-semibold">— OR UPLOAD FILE —</div>
							<input type="file" name="image_file" class="form-control" accept="image/*">
						</div>
						<div class="row">
							<div class="col-6 mb-3">
								<label class="form-label">Target Link URL</label>
								<input type="text" name="link_url" class="form-control" value="/events" placeholder="https://... or /events">
							</div>
							<div class="col-6 mb-3">
								<label class="form-label">Placement</label>
								<select name="placement" class="form-select">
									<option value="events_hero" selected>Explore Hero (Carousel)</option>
									<option value="image_preview">Image Preview (Lightbox Ad)</option>
									<option value="home_top">Home Top</option>
									<option value="event_detail">Event Detail</option>
									<option value="marketplace">Marketplace</option>
									<option value="sidebar">Sidebar</option>
								</select>
							</div>
							<div class="col-12 mb-3">
								<label class="form-label">Target Sport Category</label>
								<select name="category_id" class="form-select">
									<option value="" selected>All Sports / Display Everywhere</option>
									@foreach($categories as $cat)
										<option value="{{ $cat->id }}">{{ $cat->name }}</option>
									@endforeach
								</select>
								<small class="text-muted d-block mt-1">Target this ad to a specific sport (e.g. Rugby) or show everywhere.</small>
							</div>
						</div>
						<div class="row">
							<div class="col-6 mb-3">
								<label class="form-label">Sort Order</label>
								<input type="number" name="sort_order" class="form-control" value="0">
							</div>
							<div class="col-6 mb-3 d-flex align-items-center pt-4">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" name="is_active" value="1" id="newBannerActive" checked>
									<label class="form-check-label ms-2" for="newBannerActive">Active</label>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary">Create Banner</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="{{ asset('admin-assets/js/app.js') }}"></script>
</body>
</html>
