<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>PhotoX Admin | Event &amp; Photo Gallery Studio</title>
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
	<link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet">
	<style>
		:root {
			--px-orange: #ff8a00;
			--px-orange-hover: #e06d00;
			--px-orange-light: rgba(255, 138, 0, 0.15);
		}
		body {
			background: #060e17;
			color: #e2e8f0;
			font-family: 'DM Sans', sans-serif;
		}
		.sandbox-badge, .studio-badge {
			display: inline-flex;
			align-items: center;
			gap: 6px;
			padding: 4px 12px;
			border-radius: 999px;
			background: rgba(34, 197, 94, 0.15);
			border: 1px solid rgba(34, 197, 94, 0.4);
			color: #4ade80;
			font-weight: 600;
			font-size: 0.75rem;
			text-transform: uppercase;
			letter-spacing: 0.05em;
		}
		.ops-card {
			background: #0b1722;
			border: 1px solid #1e3346;
			border-radius: 14px;
			padding: 24px;
			margin-bottom: 24px;
		}
		.ops-card-header {
			display: flex;
			align-items: center;
			justify-content: space-between;
			margin-bottom: 20px;
			padding-bottom: 14px;
			border-bottom: 1px solid #1a2d3e;
		}
		.ops-card-title {
			font-family: 'Space Grotesk', sans-serif;
			font-size: 1.15rem;
			font-weight: 700;
			color: #fff;
			margin: 0;
			display: flex;
			align-items: center;
			gap: 10px;
		}
		.form-control, .form-select {
			background: #060f18 !important;
			border: 1px solid #203548 !important;
			color: #f1f5f9 !important;
			border-radius: 8px;
			font-size: 0.9rem;
			padding: 9px 13px;
		}
		.form-control:focus, .form-select:focus {
			border-color: var(--px-orange) !important;
			box-shadow: 0 0 0 2px rgba(255, 138, 0, 0.25) !important;
		}
		.form-label {
			font-size: 0.8rem;
			font-weight: 600;
			color: #94a3b8;
			margin-bottom: 6px;
			text-transform: uppercase;
			letter-spacing: 0.04em;
		}
		.btn-primary-px {
			background: var(--px-orange);
			border: 1px solid var(--px-orange);
			color: #fff;
			font-weight: 600;
			padding: 9px 20px;
			border-radius: 8px;
			transition: all 0.2s ease;
		}
		.btn-primary-px:hover {
			background: var(--px-orange-hover);
			border-color: var(--px-orange-hover);
			color: #fff;
		}
		.btn-outline-px {
			background: transparent;
			border: 1px solid #2d455c;
			color: #cbd5e1;
			font-weight: 500;
			padding: 8px 18px;
			border-radius: 8px;
		}
		.btn-outline-px:hover {
			border-color: var(--px-orange);
			color: #fff;
			background: rgba(255, 138, 0, 0.1);
		}
		.photo-card {
			background: #0f1f2e;
			border: 1px solid #1c3349;
			border-radius: 12px;
			overflow: hidden;
			transition: transform 0.2s ease, border-color 0.2s ease;
		}
		.photo-card:hover {
			transform: translateY(-2px);
			border-color: #ff8a00;
		}
		.photo-preview-box {
			position: relative;
			aspect-ratio: 4 / 3;
			background: #000;
			overflow: hidden;
		}
		.photo-preview-box img.main-img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			display: block;
		}
		/* Watermark overlay on preview */
		.wm-overlay-canvas {
			position: absolute;
			inset: 0;
			pointer-events: none;
			display: flex;
			align-items: center;
			justify-content: center;
			z-index: 2;
		}
		.wm-tile-pattern {
			position: absolute;
			inset: 0;
			background-repeat: repeat;
			pointer-events: none;
		}
		.sponsor-corner-badge {
			position: absolute;
			z-index: 3;
			max-width: 90px;
			max-height: 45px;
			pointer-events: none;
			filter: drop-shadow(0 2px 4px rgba(0,0,0,0.6));
		}
		.metadata-box {
			padding: 14px;
			font-size: 0.78rem;
			color: #94a3b8;
			background: #0a1622;
			border-top: 1px solid #192c3f;
		}
		.metadata-row {
			display: flex;
			align-items: center;
			gap: 8px;
			margin-bottom: 5px;
			font-family: 'DM Mono', monospace;
		}
		.metadata-row i {
			color: #ff8a00;
			font-size: 0.88rem;
			flex-shrink: 0;
		}
		.metadata-row strong {
			color: #e2e8f0;
			font-weight: 600;
		}
		.price-pill {
			display: inline-block;
			padding: 2px 8px;
			border-radius: 6px;
			font-size: 0.72rem;
			font-weight: 600;
		}
		.price-pill.personal {
			background: rgba(56, 189, 248, 0.15);
			color: #38bdf8;
			border: 1px solid rgba(56, 189, 248, 0.3);
		}
		.price-pill.commercial {
			background: rgba(34, 197, 94, 0.15);
			color: #4ade80;
			border: 1px solid rgba(34, 197, 94, 0.3);
		}
		.view-toggle-btn {
			padding: 4px 10px;
			font-size: 0.75rem;
			border-radius: 6px;
			border: 1px solid #233a4f;
			background: #09131c;
			color: #94a3b8;
			cursor: pointer;
		}
		.view-toggle-btn.active {
			background: var(--px-orange);
			border-color: var(--px-orange);
			color: #fff;
			font-weight: 600;
		}

		/* Drag & Drop Queue Styles */
		.drag-drop-zone {
			border: 2px dashed #223f5b;
			border-radius: 14px;
			background: #08131e;
			padding: 32px 20px;
			text-align: center;
			cursor: pointer;
			transition: all 0.25s ease;
		}
		.drag-drop-zone:hover, .drag-drop-zone.dragover {
			border-color: var(--px-orange);
			background: rgba(255, 138, 0, 0.08);
			transform: scale(1.005);
		}
		.queue-container {
			max-height: 280px;
			overflow-y: auto;
			background: #060e17;
			border-radius: 10px;
			border: 1px solid #1c3246;
			padding: 10px;
		}
		.queue-item {
			display: flex;
			align-items: center;
			gap: 12px;
			padding: 8px 12px;
			background: #0b1a28;
			border-radius: 8px;
			margin-bottom: 8px;
			border: 1px solid #162c40;
		}
		.queue-thumb {
			width: 44px;
			height: 44px;
			border-radius: 6px;
			object-fit: cover;
			background: #000;
		}
		.queue-info {
			flex: 1;
			min-width: 0;
		}
		.queue-name {
			font-size: 0.82rem;
			font-weight: 600;
			color: #e2e8f0;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}
		.queue-size {
			font-size: 0.70rem;
			color: #94a3b8;
		}

		.ops-page {
			background: #060e17;
			min-height: calc(100vh - 78px);
		}
	</style>
</head>
<body>
	<div class="app-shell">
		<!-- Admin Sidebar -->
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
					<a class="nav-link" href="/admin/categories"><i class="bi bi-tags"></i><span>Categories</span></a>
					<a class="nav-link" href="/admin/schools"><i class="bi bi-mortarboard"></i><span>Schools</span></a>
					<a class="nav-link" href="/admin/companies"><i class="bi bi-buildings"></i><span>Companies</span></a>
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
						<span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><a href="/admin/events" class="text-decoration-none text-muted">Events</a><i class="bi bi-chevron-right"></i><strong>Create event &amp; Gallery Studio</strong>
					</div>
				</div>
				<div class="topbar-actions">
					<div class="d-flex align-items-center gap-2 me-3">
						<span class="studio-badge"><i class="bi bi-shield-check"></i> Live Production</span>
						<a href="{{ route('events.index') }}" target="_blank" class="btn btn-outline-px btn-sm">
							<i class="bi bi-box-arrow-up-right me-1"></i> View Live Site
						</a>
						<a href="/admin/watermarks" class="btn btn-primary-px btn-sm">
							<i class="bi bi-droplet-half me-1"></i> Watermark Studio
						</a>
					</div>
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

			<main class="content-area module-page ops-page p-4">
				<div class="page-intro d-flex align-items-end justify-content-between gap-3 flex-wrap mb-4">
					<div>
						<p class="eyebrow">Event workspace</p>
						<h1>Event &amp; Photo Gallery Studio</h1>
						<p class="intro-copy">Master Event Creator · Bulk Photo Uploader · Auto Watermarking · EXIF Engine</p>
					</div>
					<div class="d-flex gap-2">
						<a href="/admin/events" class="btn btn-outline-px btn-sm"><i class="bi bi-arrow-left me-1"></i> Back to All Events</a>
						<a href="#createEventSection" class="btn btn-primary-px btn-sm"><i class="bi bi-plus-circle me-1"></i> New Event</a>
					</div>
				</div>
				@if(session('success'))
					<div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-4" role="alert" style="background: rgba(34, 197, 94, 0.12); border-color: rgba(34, 197, 94, 0.3); color: #4ade80;">
						<i class="bi bi-check-circle-fill fs-5"></i>
						<div>{{ session('success') }}</div>
						<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				@endif

				@if($errors->any())
					<div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="background: rgba(239, 68, 68, 0.12); border-color: rgba(239, 68, 68, 0.3); color: #f87171;">
						<div class="d-flex align-items-center gap-2 mb-2">
							<i class="bi bi-exclamation-triangle-fill fs-5"></i>
							<strong>Please check the following errors:</strong>
						</div>
						<ul class="mb-0 ps-3">
							@foreach($errors->all() as $err)
								<li>{{ $err }}</li>
							@endforeach
						</ul>
						<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				@endif

				<!-- Top Event Studio Notice Card -->
				<div class="ops-card" style="background: linear-gradient(135deg, #0e1e2d 0%, #08131d 100%); border-left: 4px solid var(--px-orange);">
					<div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
						<div>
							<h4 class="mb-1 text-white fw-bold"><i class="bi bi-camera-reels text-warning me-2"></i>Official Event &amp; Photo Gallery Management</h4>
							<p class="mb-0 text-muted" style="font-size: 0.9rem;">
								Create events, assign photographers with custom watermarks, drag &amp; drop high-resolution photos with automated EXIF extraction, and publish directly to the live PhotoX marketplace.
							</p>
						</div>
						<div class="d-flex gap-2">
							<a href="#createEventSection" class="btn btn-outline-px btn-sm"><i class="bi bi-plus-circle me-1"></i> Create New Event</a>
							<a href="#uploadPhotosSection" class="btn btn-primary-px btn-sm"><i class="bi bi-cloud-arrow-up me-1"></i> Bulk Upload Photos</a>
						</div>
					</div>
				</div>

				<div class="row g-4">
					<!-- Left Column: Event Creator & Event Selector -->
					<div class="col-lg-5">
						<!-- Event Selector -->
						<div class="ops-card">
							<div class="ops-card-header">
								<h3 class="ops-card-title"><i class="bi bi-collection"></i> Select Event &amp; Gallery</h3>
								<span class="badge bg-secondary">{{ $dummyEvents->count() }} Events</span>
							</div>
							@if($dummyEvents->isNotEmpty())
								<form method="GET" action="{{ route('admin.dummy.event') }}">
									<label class="form-label">Choose Active Event</label>
									<div class="d-flex gap-2">
										<select name="event_id" class="form-select" onchange="this.form.submit()">
											@foreach($dummyEvents as $dev)
												<option value="{{ $dev->id }}" {{ optional($selectedEvent)->id === $dev->id ? 'selected' : '' }}>
													{{ $dev->title }} ({{ $dev->photos_count }} photos) · {{ $dev->category_name }}
												</option>
											@endforeach
										</select>
										<button type="submit" class="btn btn-outline-px">Load</button>
									</div>
								</form>
								@if($selectedEvent)
									<div class="mt-3 p-3 rounded" style="background: rgba(255,255,255,0.03); border: 1px solid #1a2c3d;">
										<div class="d-flex gap-3 align-items-center justify-content-between flex-wrap">
											<div class="d-flex gap-3 align-items-center">
												<img src="{{ $selectedEvent->cover_image }}" alt="{{ $selectedEvent->title }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
												<div>
													<h6 class="mb-1 text-white fw-bold">{{ $selectedEvent->title }}</h6>
													<span class="badge bg-primary" style="font-size: 0.7rem;">{{ $selectedEvent->category_name }}</span>
													@if($selectedEvent->allow_individual_sales ?? true)
														<span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-50" style="font-size: 0.7rem;">
															<i class="bi bi-tag me-1"></i> Individual &amp; Bundle
														</span>
													@else
														<span class="badge bg-warning text-dark fw-bold" style="font-size: 0.7rem;">
															<i class="bi bi-box-seam-fill me-1"></i> Complete Gallery Only (R{{ number_format($selectedEvent->full_gallery_price ?: 450, 0) }})
														</span>
													@endif
													@if($selectedEvent->photographer_id)
														<span class="badge bg-warning text-dark font-monospace" style="font-size: 0.7rem;">
															<i class="bi bi-camera-fill me-1"></i> {{ $selectedEvent->photographer_name }}
														</span>
														<a href="/admin/watermarks?photographer_id={{ $selectedEvent->photographer_id }}" target="_blank" class="badge bg-dark border border-warning text-warning text-decoration-none" title="Watermark Studio" style="font-size: 0.68rem;">
															<i class="bi bi-sliders me-1"></i> Watermark
														</a>
													@else
														<span class="badge bg-secondary bg-opacity-50 text-white" style="font-size: 0.7rem;">
															<i class="bi bi-shield-lock me-1"></i> PhotoX Platform (Admin Watermark)
														</span>
													@endif
													<small class="text-muted d-block mt-1"><i class="bi bi-calendar3 me-1"></i>{{ $selectedEvent->event_date ? $selectedEvent->event_date->format('M d, Y') : '' }} · {{ $selectedEvent->location }}</small>
												</div>
											</div>
											<div class="d-flex gap-2 align-items-center">
												@if(!empty($selectedEvent->slug))
													<a href="{{ route('events.show', $selectedEvent->slug) }}" target="_blank" class="btn btn-sm btn-outline-info" title="View live event details page on website">
														<i class="bi bi-box-arrow-up-right me-1"></i> Live Page
													</a>
												@endif
												<button type="button" class="btn btn-sm btn-outline-warning" onclick="document.getElementById('editEventSettingsBox').classList.toggle('d-none');">
													<i class="bi bi-pencil-square me-1"></i> Edit Settings &amp; Pricing
												</button>
												<form action="{{ route('admin.dummy.event.delete', $selectedEvent->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event and all its photos from the server?');">
													@csrf
													@method('DELETE')
													<button type="submit" class="btn btn-sm btn-outline-danger" title="Delete event and all photos">
														<i class="bi bi-trash me-1"></i> Delete
													</button>
												</form>
											</div>
										</div>

										<!-- Collapsible Edit Gallery Form -->
										<div id="editEventSettingsBox" class="mt-3 pt-3 border-top border-secondary border-opacity-25 d-none">
											<h6 class="text-warning fw-bold mb-3"><i class="bi bi-sliders me-1"></i> Update Gallery Settings &amp; Pricing Mode</h6>
											<form action="{{ route('admin.dummy.event.update', $selectedEvent->id) }}" method="POST" enctype="multipart/form-data">
												@csrf
												<div class="mb-3">
													<label class="form-label">Event Title</label>
													<input type="text" name="title" class="form-control" value="{{ $selectedEvent->title }}" required>
												</div>

												<div class="mb-3">
													<div class="d-flex justify-content-between align-items-center mb-1">
														<label class="form-label text-warning mb-0"><i class="bi bi-camera-fill me-1"></i> Lead Photographer &amp; Watermark Creator</label>
														<a href="/admin/add-photographer" target="_blank" class="text-warning text-decoration-none small" style="font-size: 0.75rem;"><i class="bi bi-plus-circle me-1"></i> Add New Photographer</a>
													</div>
													<select name="photographer_id" class="form-select border-warning">
														<option value="">— PhotoX Platform Default (Admin Watermark) —</option>
														@foreach($photographers as $ph)
															<option value="{{ $ph->id }}" {{ (string)old('photographer_id', $selectedEvent->photographer_id) === (string)$ph->id ? 'selected' : '' }}>
																{{ $ph->name }} ({{ $ph->email }}) — {{ $ph->business_name ?? 'Photographer' }}
															</option>
														@endforeach
													</select>
													<small class="text-muted d-block mt-1">Photos and watermark proofs in this event will use this photographer's custom watermark settings.</small>
												</div>

												<div class="row g-2 mb-3">
													<div class="col-sm-6">
														<label class="form-label">Category</label>
														<select name="category_id" class="form-select" required>
															@foreach($categories as $cat)
																<option value="{{ $cat->id }}" {{ $selectedEvent->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
															@endforeach
														</select>
													</div>
													<div class="col-sm-6">
														<label class="form-label">Event Date</label>
														<input type="date" name="event_date" class="form-control" value="{{ $selectedEvent->event_date ? $selectedEvent->event_date->format('Y-m-d') : date('Y-m-d') }}" required>
													</div>
												</div>

												<div class="row g-2 mb-3">
													<div class="col-sm-6">
														<label class="form-label">Location</label>
														<input type="text" name="location" class="form-control" value="{{ $selectedEvent->location }}" required>
													</div>
													<div class="col-sm-6">
														<label class="form-label">Starting Price Display</label>
														<input type="text" name="starting_price" class="form-control" value="{{ $selectedEvent->starting_price }}">
													</div>
												</div>

												<!-- Pricing Mode: Complete Gallery Only vs Individual Sales -->
												<div class="p-3 mb-3 rounded" style="background: rgba(255, 138, 0, 0.08); border: 1px solid rgba(255, 138, 0, 0.3);">
													<label class="form-label text-warning d-block mb-2"><i class="bi bi-cash-coin me-1"></i> Gallery Sales &amp; Pricing Mode</label>
													<div class="form-check mb-2">
														<input class="form-check-input" type="radio" name="allow_individual_sales" id="modeBoth_{{ $selectedEvent->id }}" value="1" {{ ($selectedEvent->allow_individual_sales ?? true) ? 'checked' : '' }}>
														<label class="form-check-label text-white" for="modeBoth_{{ $selectedEvent->id }}">
															<strong>Allow Individual Photos &amp; Complete Bundle</strong>
															<small class="d-block text-muted">Customers can buy individual photos (e.g. R50/R75) OR buy the whole gallery.</small>
														</label>
													</div>
													<div class="form-check mb-3">
														<input class="form-check-input" type="radio" name="allow_individual_sales" id="modeGalleryOnly_{{ $selectedEvent->id }}" value="0" {{ !($selectedEvent->allow_individual_sales ?? true) ? 'checked' : '' }}>
														<label class="form-check-label text-white" for="modeGalleryOnly_{{ $selectedEvent->id }}">
															<strong class="text-warning">Sell ONLY Complete Gallery (No Individual Sales)</strong>
															<small class="d-block text-muted">Only the complete gallery price is offered. Individual photo purchase is disabled on cards.</small>
														</label>
													</div>

													<div>
														<label class="form-label text-white">Complete Gallery Package Price (ZAR)</label>
														<div class="input-group">
															<span class="input-group-text bg-dark text-warning border-secondary">R</span>
															<input type="number" step="0.01" min="0" name="full_gallery_price" class="form-control" value="{{ $selectedEvent->full_gallery_price ?: 450.00 }}">
														</div>
													</div>
												</div>

												<div class="mb-3">
													<label class="form-label">Description</label>
													<textarea name="description" rows="2" class="form-control">{{ $selectedEvent->description }}</textarea>
												</div>

												<div class="d-flex justify-content-end gap-2">
													<button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.getElementById('editEventSettingsBox').classList.add('d-none');">Cancel</button>
													<button type="submit" class="btn btn-sm btn-primary-px">Save Changes</button>
												</div>
											</form>
										</div>
									</div>
								@endif
							@else
								<p class="text-muted mb-0 small">No events created yet. Use the form below to create one!</p>
							@endif
						</div>

						<!-- Create Event Form -->
						<div class="ops-card" id="createEventSection">
							<div class="ops-card-header">
								<h3 class="ops-card-title"><i class="bi bi-calendar-plus"></i> Create New Event</h3>
							</div>
							<form action="{{ route('admin.dummy.event.store') }}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="mb-3">
									<label class="form-label">Event Title *</label>
									<input type="text" name="title" class="form-control" placeholder="e.g. Cape Town Marathon 2026" required value="{{ old('title') }}">
								</div>

								<div class="mb-3">
									<div class="d-flex justify-content-between align-items-center mb-1">
										<label class="form-label text-warning mb-0"><i class="bi bi-camera-fill me-1"></i> Lead Photographer &amp; Watermark Creator</label>
										<a href="/admin/add-photographer" target="_blank" class="text-warning text-decoration-none small" style="font-size: 0.75rem;"><i class="bi bi-plus-circle me-1"></i> Add New Photographer</a>
									</div>
									<select name="photographer_id" class="form-select border-warning">
										<option value="">— PhotoX Platform Default (Standard Admin Watermark) —</option>
										@foreach($photographers as $ph)
											<option value="{{ $ph->id }}" {{ (string)old('photographer_id') === (string)$ph->id ? 'selected' : '' }}>
												{{ $ph->name }} ({{ $ph->email }}) — {{ $ph->business_name ?? 'Photographer' }}
											</option>
										@endforeach
									</select>
									<small class="text-muted d-block mt-1">Select a photographer so their custom watermark studio settings are automatically applied to photos in this event.</small>
								</div>

								<div class="row g-2 mb-3">
									<div class="col-sm-6">
										<label class="form-label">Category *</label>
										<select name="category_id" class="form-select" required>
											<option value="">Select Category</option>
											@foreach($categories as $cat)
												<option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
											@endforeach
										</select>
									</div>
									<div class="col-sm-6">
										<label class="form-label">Event Date *</label>
										<input type="date" name="event_date" class="form-control" required value="{{ old('event_date', date('Y-m-d')) }}">
									</div>
								</div>

								<div class="row g-2 mb-3">
									<div class="col-sm-6">
										<label class="form-label">Location *</label>
										<input type="text" name="location" class="form-control" placeholder="e.g. Cape Town Stadium" required value="{{ old('location', 'Cape Town') }}">
									</div>
									<div class="col-sm-6">
										<label class="form-label">Starting Price</label>
										<input type="text" name="starting_price" class="form-control" placeholder="From R50" value="{{ old('starting_price', 'From R50') }}">
									</div>
								</div>

								<div class="mb-3">
									<label class="form-label">Description</label>
									<textarea name="description" rows="2" class="form-control" placeholder="Brief event summary...">{{ old('description', 'Official sports and event photography gallery.') }}</textarea>
								</div>

								<div class="mb-4">
									<label class="form-label">Cover Image (Upload or URL)</label>
									<input type="file" name="cover_image" class="form-control mb-2" accept="image/*">
									<input type="url" name="cover_image_url" class="form-control" placeholder="Or paste image URL...">
								</div>

								<button type="submit" class="btn btn-primary-px w-100">
									<i class="bi bi-check-lg me-1"></i> Create &amp; Publish Event
								</button>
							</form>
						</div>
					</div>

					<!-- Right Column: Photo Uploader & EXIF Metadata Inspector -->
					<div class="col-lg-7">
						<!-- Photo Upload Form -->
						<div class="ops-card" id="uploadPhotosSection">
							<div class="ops-card-header">
								<h3 class="ops-card-title"><i class="bi bi-cloud-arrow-up"></i> Upload Event Photos (With EXIF Extraction)</h3>
								@if($selectedEvent)
									<span class="badge bg-info text-dark">{{ $selectedEvent->title }}</span>
								@endif
							</div>

							@if($selectedEvent)
								<form id="queueUploadForm" action="{{ route('admin.dummy.photos.upload') }}" method="POST" enctype="multipart/form-data">
									@csrf
									<input type="hidden" name="event_id" value="{{ $selectedEvent->id }}">

									<!-- Drag & Drop Dropzone Box -->
									<div class="mb-3">
										<div class="drag-drop-zone" id="dropzoneArea" onclick="document.getElementById('fileInput').click()">
											<i class="bi bi-cloud-arrow-up text-warning" style="font-size: 2.5rem; display: block; margin-bottom: 8px;"></i>
											<h5 class="text-white fw-bold mb-1">Drag &amp; Drop Photos Here</h5>
											<p class="text-muted small mb-2">or <span class="text-warning text-decoration-underline">Browse files</span> from your computer</p>
											<span class="badge bg-secondary bg-opacity-25 text-light border border-secondary px-3 py-1 font-monospace" style="font-size: 0.72rem;">
												Bulk Upload · Automated EXIF Extraction &amp; Server-Burned Watermarks
											</span>
										</div>
										<input type="file" id="fileInput" name="photos[]" multiple accept="image/*" class="d-none" onchange="handleFileSelect(this.files)">
									</div>

									<!-- Queued Files Container -->
									<div id="queueSection" class="mb-3 d-none">
										<div class="d-flex justify-content-between align-items-center mb-2">
											<span class="text-uppercase text-secondary fw-bold" style="font-size: 0.75rem; letter-spacing: 0.05em;">
												<i class="bi bi-list-check me-1 text-warning"></i> Upload Queue (<span id="queueCount">0</span> files)
											</span>
											<button type="button" class="btn btn-sm btn-link text-danger p-0 text-decoration-none" onclick="clearQueue()" style="font-size: 0.75rem;">
												<i class="bi bi-x-circle me-1"></i> Clear all
											</button>
										</div>

										<div class="queue-container" id="queueList">
											<!-- Queued items injected dynamically -->
										</div>

										<!-- Live Progress Bar -->
										<div id="uploadProgressContainer" class="mt-2 d-none">
											<div class="d-flex justify-content-between align-items-center mb-1 small">
												<span class="text-warning fw-bold" id="progressStatusText">Processing uploads...</span>
												<span class="text-white font-monospace" id="progressPercent">0%</span>
											</div>
											<div class="progress" style="height: 6px; background: #162a3c;">
												<div id="uploadProgressBar" class="progress-bar bg-warning" role="progressbar" style="width: 0%;"></div>
											</div>
										</div>
									</div>

									<!-- Pricing per license -->
									<div class="row g-3 mb-3">
										<div class="col-sm-6">
											<label class="form-label">Personal License Price (R)</label>
											<div class="input-group">
												<span class="input-group-text bg-dark border-secondary text-muted">R</span>
												<input type="number" step="0.5" name="personal_price" id="personalPriceInput" class="form-control" value="50.00" required>
											</div>
											<small class="text-muted">For athletes/parents personal use</small>
										</div>
										<div class="col-sm-6">
											<label class="form-label">Commercial License Price (R)</label>
											<div class="input-group">
												<span class="input-group-text bg-dark border-secondary text-muted">R</span>
												<input type="number" step="1" name="commercial_price" id="commercialPriceInput" class="form-control" value="250.00" required>
											</div>
											<small class="text-muted">For brands &amp; sponsors advertising</small>
										</div>
									</div>

									<button type="button" id="startUploadBtn" class="btn btn-primary-px w-100 py-2 fw-bold" onclick="startQueueUpload()">
										<i class="bi bi-shield-lock-fill me-1"></i> Upload Queue &amp; Generate Watermarked Proofs
									</button>
								</form>
							@else
								<div class="text-center py-4 text-muted">
									<i class="bi bi-arrow-left-circle fs-2 d-block mb-2 text-warning"></i>
									Please select or create an event first before uploading photos.
								</div>
							@endif
						</div>

						<!-- Photos Grid with Live Watermark & EXIF Metadata -->
						<div class="ops-card">
							<div class="ops-card-header flex-wrap gap-2">
								<div>
									<h3 class="ops-card-title"><i class="bi bi-images"></i> Uploaded Photos &amp; Live Proofs</h3>
									<small class="text-muted">Live anti-theft protected proofs with photographer watermark overlay &amp; EXIF metadata</small>
								</div>
								<!-- Live Watermark Controls Toggle -->
								<div class="d-flex align-items-center gap-2 flex-wrap">
									<form action="{{ route('admin.dummy.photos.reapply') }}" method="POST" class="d-inline">
										@csrf
										<input type="hidden" name="event_id" value="{{ $selectedEvent->id ?? 12 }}">
										<button type="submit" class="btn btn-sm btn-warning text-dark fw-bold d-flex align-items-center gap-1 shadow-sm" title="Re-apply current Watermark Studio settings to all photos">
											<i class="bi bi-arrow-repeat"></i> Sync / Re-Apply Watermark
											<span class="badge bg-dark text-warning font-monospace ms-1">{{ strtoupper($watermarkSetting->watermark_pattern ?? 'PhotoX Pro') }}</span>
										</button>
									</form>
									<a href="/admin/watermarks" target="_blank" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1">
										<i class="bi bi-sliders2"></i> Open Studio
									</a>
									<div class="d-flex align-items-center gap-1 ms-auto">
										<button type="button" class="view-toggle-btn active" onclick="setWmMode('watermarked', this)">
											<i class="bi bi-droplet-half me-1"></i> Watermarked
										</button>
										<button type="button" class="view-toggle-btn" onclick="setWmMode('sponsor', this)">
											<i class="bi bi-award me-1"></i> Sponsor Logo
										</button>
										<button type="button" class="view-toggle-btn" onclick="setWmMode('clean', this)">
											<i class="bi bi-eye me-1"></i> Clean Original
										</button>
									</div>
								</div>
							</div>

							@if($selectedEvent && $selectedEvent->photos->isNotEmpty())
								<div class="row g-3" id="photosGrid">
									@foreach($selectedEvent->photos as $photo)
										@php
											$isBestPhoto = ($selectedEvent->cover_photo_id == $photo->id) || (!empty($photo->is_featured));
										@endphp
										<div class="col-md-6 photo-col">
											<div class="photo-card position-relative {{ $isBestPhoto ? 'border-warning border-2' : '' }}">
												<!-- Photo Preview with Watermark Overlay -->
												<div class="photo-preview-box position-relative">
													@if($isBestPhoto)
														<span class="position-absolute top-0 start-0 m-2 badge bg-warning text-dark shadow-sm fw-bold" style="z-index: 10; font-size: 0.72rem;">
															<i class="bi bi-star-fill me-1"></i> BEST COVER PHOTO (HOMEPAGE)
														</span>
													@endif
													<img class="main-img" src="/protected-photo/{{ $photo->id }}?v={{ time() }}" alt="{{ $photo->title }}" oncontextmenu="return false;" draggable="false">
													<img class="clean-img d-none position-absolute top-0 start-0 w-100 h-100 object-fit-cover" src="{{ $photo->file_path }}" alt="Clean Original" oncontextmenu="return false;" draggable="false">

													<!-- Post-Purchase Sponsor Logo (Positioned in chosen corner) -->
													<div class="sponsor-layer d-none">
														<img src="{{ $watermarkSetting->sponsor_logo_path ?? '/logo.png' }}" class="sponsor-corner-badge" style="
															@if(($watermarkSetting->sponsor_placement ?? 'bottom-right') === 'top-left')
																top: 10px; left: 10px;
															@elseif(($watermarkSetting->sponsor_placement ?? 'bottom-right') === 'top-right')
																top: 10px; right: 10px;
															@elseif(($watermarkSetting->sponsor_placement ?? 'bottom-right') === 'bottom-left')
																bottom: 10px; left: 10px;
															@elseif(($watermarkSetting->sponsor_placement ?? 'bottom-right') === 'bottom-center')
																bottom: 10px; left: 50%; transform: translateX(-50%);
															@else
																bottom: 10px; right: 10px;
															@endif
															opacity: {{ ($watermarkSetting->sponsor_opacity ?? 85) / 100 }};
														">
													</div>
													<!-- Anti-theft test link banner below preview -->
													<div class="p-2 border-top border-secondary border-opacity-25 d-flex justify-content-between align-items-center bg-black bg-opacity-40">
														<a href="/protected-photo/{{ $photo->id }}" target="_blank" class="badge bg-dark border border-warning text-warning text-decoration-none" style="font-size: 0.70rem; padding: 4px 8px;">
															<i class="bi bi-box-arrow-up-right me-1"></i> Open Protected Image in New Tab
														</a>
														<span class="badge bg-success bg-opacity-20 text-success border border-success border-opacity-40" style="font-size: 0.65rem;">
															<i class="bi bi-shield-check me-1"></i> Anti-Theft Proof
														</span>
													</div>
												</div>

												<!-- Pixieset Style Metadata Panel -->
												<div class="metadata-box">
													<div class="d-flex justify-content-between align-items-start mb-2 pb-1 border-bottom border-secondary">
														<span class="text-truncate fw-bold text-white" style="max-width: 160px;">{{ $photo->title }}</span>
														<div>
															@if($selectedEvent->allow_individual_sales ?? true)
																<span class="price-pill personal me-1">Personal: R{{ number_format($photo->personal_price, 0) }}</span>
																<span class="price-pill commercial">Commercial: R{{ number_format($photo->commercial_price, 0) }}</span>
															@else
																<span class="badge bg-warning text-dark py-1 px-2" style="font-size: 0.68rem; font-weight: 700;">
																	<i class="bi bi-box-seam-fill me-1"></i> Complete Gallery Only
																</span>
															@endif
														</div>
													</div>

													<!-- Camera & Lens -->
													<div class="metadata-row">
														<i class="bi bi-camera"></i>
														<span>{{ $photo->camera_model ?? 'Canon EOS R5' }}</span>
													</div>
													<div class="metadata-row">
														<i class="bi bi-record-circle"></i>
														<span class="text-truncate">{{ $photo->lens ?? 'RF100-300mm F2.8 L IS USM' }}</span>
													</div>

													<!-- Settings: Focal, Shutter, Aperture, ISO -->
													<div class="metadata-row text-muted" style="font-size: 0.72rem;">
														<i class="bi bi-sliders"></i>
														<span>{{ $photo->focal_length ?? '300mm' }} · {{ $photo->shutter_speed ?? '1/3200' }}s · {{ $photo->aperture ?? 'f/2.8' }} · ISO {{ $photo->iso ?? '200' }}</span>
													</div>

													<!-- Dimensions & Date -->
													<div class="metadata-row text-muted" style="font-size: 0.72rem;">
														<i class="bi bi-file-earmark-image"></i>
														<span>{{ $photo->dimensions ?? '6.1MP • 3013 x 2010' }} · {{ $photo->file_size ?? '4.2 MB' }}</span>
													</div>

													<div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top border-secondary flex-wrap gap-1">
														<div class="d-flex align-items-center gap-2">
															<small class="text-muted"><i class="bi bi-calendar3 me-1"></i>{{ $photo->captured_at ? $photo->captured_at->format('M d, Y') : 'Recent' }}</small>
															@if($isBestPhoto)
																<span class="badge bg-warning text-dark py-1 px-2" style="font-size: 0.68rem; font-weight: 700;">
																	<i class="bi bi-star-fill me-1"></i> ACTIVE HOME COVER
																</span>
															@else
																<form action="{{ route('admin.dummy.photo.cover', $photo->id) }}" method="POST" class="d-inline">
																	@csrf
																	<button type="submit" class="btn btn-sm btn-outline-warning py-0 px-2" style="font-size: 0.68rem;" title="Select this photo as the single best image to display on homepage">
																		<i class="bi bi-star me-1"></i> Set as Best Cover
																	</button>
																</form>
															@endif
														</div>
														<form action="{{ route('admin.dummy.photo.delete', $photo->id) }}" method="POST" onsubmit="return confirm('Delete this photo?')">
															@csrf
															@method('DELETE')
															<button type="submit" class="btn btn-sm btn-link text-danger p-0 text-decoration-none" style="font-size: 0.75rem;">
																<i class="bi bi-trash"></i> Delete
															</button>
														</form>
													</div>
												</div>
											</div>
										</div>
									@endforeach
								</div>
							@else
								<div class="text-center py-5 text-muted">
									<i class="bi bi-camera fs-1 d-block mb-2 text-secondary"></i>
									<h5>No photos uploaded yet for this event</h5>
									<p class="small">Upload photos using the drag-and-drop form above to automatically burn watermarks and extract camera EXIF metadata!</p>
								</div>
							@endif
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="{{ asset('admin-assets/js/app.js') }}"></script>
	<script>
		// Drag & Drop Queue Logic
		let queuedFiles = [];
		const dropzoneArea = document.getElementById('dropzoneArea');
		const fileInput = document.getElementById('fileInput');
		const queueSection = document.getElementById('queueSection');
		const queueList = document.getElementById('queueList');
		const queueCount = document.getElementById('queueCount');

		if (dropzoneArea) {
			['dragenter', 'dragover'].forEach(eventName => {
				dropzoneArea.addEventListener(eventName, (e) => {
					e.preventDefault();
					e.stopPropagation();
					dropzoneArea.classList.add('dragover');
				}, false);
			});

			['dragleave', 'drop'].forEach(eventName => {
				dropzoneArea.addEventListener(eventName, (e) => {
					e.preventDefault();
					e.stopPropagation();
					dropzoneArea.classList.remove('dragover');
				}, false);
			});

			dropzoneArea.addEventListener('drop', (e) => {
				const dt = e.dataTransfer;
				const files = dt.files;
				handleFileSelect(files);
			}, false);
		}

		function handleFileSelect(files) {
			if (!files || files.length === 0) return;

			for (let i = 0; i < files.length; i++) {
				queuedFiles.push(files[i]);
			}

			// Sync files to file input
			try {
				const dt = new DataTransfer();
				queuedFiles.forEach(f => dt.items.add(f));
				document.getElementById('fileInput').files = dt.files;
			} catch(e) {}

			renderQueue();
		}

		function renderQueue() {
			const queueSection = document.getElementById('queueSection');
			const queueList = document.getElementById('queueList');
			const queueCount = document.getElementById('queueCount');
			if (!queueSection || !queueList) return;

			if (queuedFiles.length === 0) {
				queueSection.classList.add('d-none');
				return;
			}

			queueSection.classList.remove('d-none');
			queueCount.textContent = queuedFiles.length;
			queueList.innerHTML = '';

			queuedFiles.forEach((file, index) => {
				const item = document.createElement('div');
				item.className = 'queue-item';
				item.id = `queueItem_${index}`;

				const sizeMb = (file.size / (1024 * 1024)).toFixed(2);
				const thumbUrl = URL.createObjectURL(file);

				item.innerHTML = `
					<img src="${thumbUrl}" class="queue-thumb" alt="Preview">
					<div class="queue-info">
						<div class="queue-name" title="${file.name}">${file.name}</div>
						<div class="queue-size">${sizeMb} MB · <span class="badge bg-secondary font-monospace" style="font-size: 0.65rem;">EXIF &amp; Watermark Ready</span></div>
					</div>
					<button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="removeFromQueue(${index})">
						<i class="bi bi-x-circle fs-6"></i>
					</button>
				`;

				queueList.appendChild(item);
			});
		}

		function removeFromQueue(index) {
			queuedFiles.splice(index, 1);
			renderQueue();
		}

		function clearQueue() {
			queuedFiles = [];
			renderQueue();
		}

		function startQueueUpload() {
			const fileIn = document.getElementById('fileInput');

			// If queuedFiles is empty, check if fileInput has files
			if (queuedFiles.length === 0 && fileIn && fileIn.files && fileIn.files.length > 0) {
				for (let i = 0; i < fileIn.files.length; i++) {
					queuedFiles.push(fileIn.files[i]);
				}
			}

			if (queuedFiles.length === 0) {
				alert('Please drag & drop or click "Browse files" to select photos first!');
				return;
			}

			const startBtn = document.getElementById('startUploadBtn');
			const progressContainer = document.getElementById('uploadProgressContainer');
			const progressBar = document.getElementById('uploadProgressBar');
			const progressText = document.getElementById('progressStatusText');
			const progressPercent = document.getElementById('progressPercent');

			startBtn.disabled = true;
			startBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Uploading &amp; Watermarking...';
			progressContainer.classList.remove('d-none');

			const eventIdInput = document.querySelector('input[name="event_id"]');
			if (!eventIdInput || !eventIdInput.value) {
				alert('Please select or create an event first!');
				startBtn.disabled = false;
				startBtn.innerHTML = '<i class="bi bi-shield-lock-fill me-1"></i> Upload Queue &amp; Generate Watermarked Proofs';
				progressContainer.classList.add('d-none');
				return;
			}
			const eventId = eventIdInput.value;
			const personalPrice = document.getElementById('personalPriceInput') ? document.getElementById('personalPriceInput').value : '50.00';
			const commercialPrice = document.getElementById('commercialPriceInput') ? document.getElementById('commercialPriceInput').value : '250.00';
			const csrfMeta = document.querySelector('meta[name="csrf-token"]');
			const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '{{ csrf_token() }}';

			const total = queuedFiles.length;
			const batchSize = 15;
			let processedCount = 0;

			function uploadBatch(startIndex) {
				if (startIndex >= total) {
					progressBar.style.width = '100%';
					progressPercent.textContent = '100%';
					progressText.textContent = `All ${total} photos uploaded & watermarked successfully!`;
					setTimeout(() => {
						window.location.reload();
					}, 900);
					return;
				}

				const endIndex = Math.min(startIndex + batchSize, total);
				const batchFiles = queuedFiles.slice(startIndex, endIndex);

				const formData = new FormData();
				formData.append('event_id', eventId);
				formData.append('personal_price', personalPrice);
				formData.append('commercial_price', commercialPrice);
				formData.append('_token', csrfToken);

				batchFiles.forEach(file => {
					formData.append('photos[]', file);
				});

				const batchNum = Math.floor(startIndex / batchSize) + 1;
				const totalBatches = Math.ceil(total / batchSize);
				progressText.textContent = `Uploading batch ${batchNum} of ${totalBatches} (${startIndex + 1}–${endIndex} of ${total} photos)...`;

				const xhr = new XMLHttpRequest();
				xhr.open('POST', "{{ route('admin.dummy.photos.upload') }}", true);
				xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
				xhr.setRequestHeader('Accept', 'application/json');
				xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

				xhr.upload.onprogress = function(e) {
					if (e.lengthComputable) {
						const batchPct = e.loaded / e.total;
						const overallPct = Math.min(95, Math.round(((startIndex + (batchFiles.length * batchPct)) / total) * 100));
						progressBar.style.width = overallPct + '%';
						progressPercent.textContent = overallPct + '%';
					}
				};

				xhr.onload = function() {
					if (xhr.status >= 200 && xhr.status < 300) {
						processedCount += batchFiles.length;
						const overallPct = Math.round((processedCount / total) * 100);
						progressBar.style.width = overallPct + '%';
						progressPercent.textContent = overallPct + '%';
						// Upload next batch
						uploadBatch(endIndex);
					} else if (xhr.status === 419) {
						alert('Session expired! Please refresh this page and try uploading again.');
						resetUploadBtn();
					} else if (xhr.status === 413) {
						alert('Batch payload too large! Please try uploading smaller batches.');
						resetUploadBtn();
					} else {
						let errorMsg = 'Server returned HTTP ' + xhr.status;
						try {
							const errData = JSON.parse(xhr.responseText);
							if (errData && errData.message) errorMsg = errData.message;
						} catch(e) {}
						alert('Upload Failed: ' + errorMsg);
						resetUploadBtn();
					}
				};

				xhr.onerror = function() {
					alert('Network error occurred while uploading. Please check connection and try again.');
					resetUploadBtn();
				};

				xhr.send(formData);
			}

			function resetUploadBtn() {
				startBtn.disabled = false;
				startBtn.innerHTML = '<i class="bi bi-shield-lock-fill me-1"></i> Upload Queue &amp; Generate Watermarked Proofs';
				progressContainer.classList.add('d-none');
			}

			// Start uploading first batch
			uploadBatch(0);

			xhr.send(formData);
		}

		// Switch between Watermarked, Sponsor Corner Logo, and Clean view
		function setWmMode(mode, btn) {
			document.querySelectorAll('.view-toggle-btn').forEach(b => b.classList.remove('active'));
			btn.classList.add('active');

			const wmOverlays = document.querySelectorAll('.wm-layer');
			const sponsorOverlays = document.querySelectorAll('.sponsor-layer');

			if (mode === 'watermarked') {
				wmOverlays.forEach(el => el.classList.remove('d-none'));
				sponsorOverlays.forEach(el => el.classList.add('d-none'));
			} else if (mode === 'sponsor') {
				wmOverlays.forEach(el => el.classList.add('d-none'));
				sponsorOverlays.forEach(el => el.classList.remove('d-none'));
			} else if (mode === 'clean') {
				wmOverlays.forEach(el => el.classList.add('d-none'));
				sponsorOverlays.forEach(el => el.classList.add('d-none'));
			}
		}
	</script>
</body>
</html>
