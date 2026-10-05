<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>PhotoX Admin | Dummy Event &amp; Photo Studio</title>
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
		.sandbox-badge {
			display: inline-flex;
			align-items: center;
			gap: 6px;
			padding: 4px 12px;
			border-radius: 999px;
			background: rgba(255, 138, 0, 0.18);
			border: 1px solid rgba(255, 138, 0, 0.4);
			color: #ff8a00;
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

		.ops-layout {
			display: flex;
			min-height: 100vh;
		}
		.ops-sidebar {
			width: 260px;
			min-width: 260px;
			background: #09141f;
			border-right: 1px solid #192a39;
			padding: 24px 16px;
			display: flex;
			flex-direction: column;
		}
		.ops-main {
			flex: 1;
			display: flex;
			flex-direction: column;
			min-width: 0;
			background: #060e17;
		}
		.ops-topbar {
			background: #0a1622;
			border-bottom: 1px solid #192a39;
			padding: 16px 28px;
			display: flex;
			align-items: center;
			justify-content: space-between;
			flex-wrap: wrap;
			gap: 16px;
		}
		.ops-title {
			font-size: 1.35rem;
			font-weight: 700;
			color: #fff;
			font-family: 'Space Grotesk', sans-serif;
		}
		.sidebar-toggle {
			background: transparent;
			border: 1px solid #1e3346;
			color: #94a3b8;
			border-radius: 8px;
			padding: 6px 10px;
			font-size: 1.1rem;
			display: none;
		}
		@media (max-width: 991px) {
			.ops-sidebar { display: none; }
			.ops-sidebar.show { display: block; position: fixed; inset: 0 auto 0 0; z-index: 1050; }
			.sidebar-toggle { display: inline-block; }
		}
	</style>
</head>
<body>
	<div class="ops-layout">
		<!-- Admin Sidebar -->
		<aside class="ops-sidebar" id="sidebar">
			<a class="brand d-block mb-4" href="/admin/dashboard" aria-label="PhotoX Admin home">
				<img src="{{ asset('admin-assets/logo.png') }}" alt="PhotoX Admin" style="max-height: 38px;">
			</a>
			<div class="mb-3 p-2 rounded" style="background: #112233; color: #fff; display: flex; align-items: center; gap: 10px;">
				<span style="background: var(--px-orange); color: #fff; width: 32px; height: 32px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; font-weight: bold;">PS</span>
				<span style="font-size: 0.85rem;"><small class="d-block text-muted" style="font-size: 0.7rem;">Active Sandbox</small><strong>Dummy Studio</strong></span>
			</div>
			
			<div class="text-uppercase text-muted fw-bold px-2 mt-2 mb-2" style="font-size: 0.68rem; letter-spacing: 0.08em;">Sandbox Testing</div>
			<nav class="nav flex-column gap-1">
				<a class="nav-link py-2 px-3 rounded d-flex align-items-center gap-2 active" href="/admin/dummy-event" style="background: var(--px-orange); color: #fff; font-weight: 600;">
					<i class="bi bi-calendar-event"></i><span>Dummy Events &amp; Photos</span>
				</a>
				<a class="nav-link py-2 px-3 rounded d-flex align-items-center gap-2 text-secondary" href="/admin/watermarks">
					<i class="bi bi-droplet"></i><span>Watermark Studio</span>
				</a>
				<a class="nav-link py-2 px-3 rounded d-flex align-items-center gap-2 text-secondary" href="/dummy-home_testing" target="_blank">
					<i class="bi bi-globe"></i><span>Dummy Home Page <i class="bi bi-box-arrow-up-right ms-auto small"></i></span>
				</a>
			</nav>

			<div class="text-uppercase text-muted fw-bold px-2 mt-4 mb-2" style="font-size: 0.68rem; letter-spacing: 0.08em;">Live Admin Management</div>
			<nav class="nav flex-column gap-1">
				<a class="nav-link py-2 px-3 rounded d-flex align-items-center gap-2 text-secondary" href="/admin/dashboard">
					<i class="bi bi-grid-1x2-fill"></i><span>Dashboard</span>
				</a>
				<a class="nav-link py-2 px-3 rounded d-flex align-items-center gap-2 text-secondary" href="/admin/events">
					<i class="bi bi-calendar-event"></i><span>Live Events</span>
				</a>
				<a class="nav-link py-2 px-3 rounded d-flex align-items-center gap-2 text-secondary" href="/admin/categories">
					<i class="bi bi-tag"></i><span>Categories</span>
				</a>
				<a class="nav-link py-2 px-3 rounded d-flex align-items-center gap-2 text-secondary" href="/admin/banners">
					<i class="bi bi-layout-text-window"></i><span>Banners</span>
				</a>
				<a class="nav-link py-2 px-3 rounded d-flex align-items-center gap-2 text-secondary" href="/admin/memberships">
					<i class="bi bi-person-vcard"></i><span>Memberships</span>
				</a>
			</nav>

			<div class="mt-auto pt-4">
				<a href="/" target="_blank" class="btn btn-outline-px w-100 btn-sm text-center">
					<i class="bi bi-box-arrow-up-right me-1"></i> View Live Site
				</a>
			</div>
		</aside>

		<div class="ops-main">
			<header class="ops-topbar">
				<div class="d-flex align-items-center gap-3">
					<button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Toggle navigation">
						<i class="bi bi-list"></i>
					</button>
					<div>
						<h1 class="ops-title mb-0">Dummy Event &amp; Photo Studio</h1>
						<small class="text-muted">Testing Sandbox · Watermark Verification · EXIF Metadata</small>
					</div>
				</div>
				<div class="d-flex align-items-center gap-2">
					<span class="sandbox-badge"><i class="bi bi-shield-check"></i> Safe Sandbox</span>
					<a href="{{ route('dummy.home') }}" target="_blank" class="btn btn-outline-px btn-sm">
						<i class="bi bi-box-arrow-up-right me-1"></i> Preview Dummy Home
					</a>
					<a href="{{ route('admin.dummy') }}" class="btn btn-primary-px btn-sm">
						<i class="bi bi-droplet-half me-1"></i> Watermark Studio
					</a>
				</div>
			</header>

			<main class="ops-content p-4">
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

				<!-- Top Sandbox Notice Card -->
				<div class="ops-card" style="background: linear-gradient(135deg, #0e1e2d 0%, #08131d 100%); border-left: 4px solid var(--px-orange);">
					<div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
						<div>
							<h4 class="mb-1 text-white fw-bold"><i class="bi bi-info-circle text-warning me-2"></i>Isolated Testing Sandbox</h4>
							<p class="mb-0 text-muted" style="font-size: 0.9rem;">
								Yahan banaye gaye dummy events aur upload ki gayi photos <strong>Live Homepage par bilkul show nahi hongi</strong>. Unko sirf 
								<a href="/dummy-home_testing" target="_blank" class="text-warning text-decoration-none fw-semibold">Dummy Home Page (/dummy-home_testing)</a> par test aur verify kiya ja sakta hai.
							</p>
						</div>
						<div class="d-flex gap-2">
							<a href="#createEventSection" class="btn btn-outline-px btn-sm"><i class="bi bi-plus-circle me-1"></i> New Dummy Event</a>
							<a href="#uploadPhotosSection" class="btn btn-primary-px btn-sm"><i class="bi bi-cloud-arrow-up me-1"></i> Upload Test Photos</a>
						</div>
					</div>
				</div>

				<div class="row g-4">
					<!-- Left Column: Event Creator & Event Selector -->
					<div class="col-lg-5">
						<!-- Event Selector -->
						<div class="ops-card">
							<div class="ops-card-header">
								<h3 class="ops-card-title"><i class="bi bi-collection"></i> Select Dummy Event</h3>
								<span class="badge bg-secondary">{{ $dummyEvents->count() }} Events</span>
							</div>
							@if($dummyEvents->isNotEmpty())
								<form method="GET" action="{{ route('admin.dummy.event') }}">
									<label class="form-label">Active Sandbox Event</label>
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
										<div class="d-flex gap-3 align-items-center justify-content-between">
											<div class="d-flex gap-3 align-items-center">
												<img src="{{ $selectedEvent->cover_image }}" alt="{{ $selectedEvent->title }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
												<div>
													<h6 class="mb-1 text-white fw-bold">{{ $selectedEvent->title }}</h6>
													<span class="badge bg-primary" style="font-size: 0.7rem;">{{ $selectedEvent->category_name }}</span>
													<small class="text-muted d-block mt-1"><i class="bi bi-calendar3 me-1"></i>{{ $selectedEvent->event_date ? $selectedEvent->event_date->format('M d, Y') : '' }} · {{ $selectedEvent->location }}</small>
												</div>
											</div>
											<form action="{{ route('admin.dummy.event.delete', $selectedEvent->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event and all its photos from the server?');">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-sm btn-outline-danger" title="Delete event and all photos">
													<i class="bi bi-trash me-1"></i> Delete Event
												</button>
											</form>
										</div>
									</div>
								@endif
							@else
								<p class="text-muted mb-0 small">No dummy events created yet. Use the form below to create one!</p>
							@endif
						</div>

						<!-- Create Dummy Event Form -->
						<div class="ops-card" id="createEventSection">
							<div class="ops-card-header">
								<h3 class="ops-card-title"><i class="bi bi-calendar-plus"></i> Create New Dummy Event</h3>
							</div>
							<form action="{{ route('admin.dummy.event.store') }}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="mb-3">
									<label class="form-label">Event Title *</label>
									<input type="text" name="title" class="form-control" placeholder="e.g. Cape Town Marathon 2026 Test" required value="{{ old('title') }}">
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
									<textarea name="description" rows="2" class="form-control" placeholder="Brief event summary...">{{ old('description', 'Official sandbox testing event for watermarks and EXIF extraction.') }}</textarea>
								</div>

								<div class="mb-4">
									<label class="form-label">Cover Image (Upload or URL)</label>
									<input type="file" name="cover_image" class="form-control mb-2" accept="image/*">
									<input type="url" name="cover_image_url" class="form-control" placeholder="Or paste image URL...">
								</div>

								<button type="submit" class="btn btn-primary-px w-100">
									<i class="bi bi-check-lg me-1"></i> Save Dummy Event
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
												Bulk Upload · Automated Pixieset EXIF &amp; Server-Burned Watermarks
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
									Please select or create a dummy event first before uploading photos.
								</div>
							@endif
						</div>

						<!-- Photos Grid with Live Watermark & Pixieset Metadata -->
						<div class="ops-card">
							<div class="ops-card-header flex-wrap gap-2">
								<div>
									<h3 class="ops-card-title"><i class="bi bi-images"></i> Uploaded Photos &amp; Watermark Verification</h3>
									<small class="text-muted">Test watermark overlay &amp; EXIF metadata on photos</small>
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
										<div class="col-md-6 photo-col">
											<div class="photo-card">
												<!-- Photo Preview with Watermark Overlay -->
												<div class="photo-preview-box">
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
															<span class="price-pill personal me-1">Personal: R{{ number_format($photo->personal_price, 0) }}</span>
															<span class="price-pill commercial">Commercial: R{{ number_format($photo->commercial_price, 0) }}</span>
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

													<div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top border-secondary">
														<small class="text-muted"><i class="bi bi-calendar3 me-1"></i>{{ $photo->captured_at ? $photo->captured_at->format('M d, Y · g:i A') : 'Aug 18, 2026' }}</small>
														<form action="{{ route('admin.dummy.photo.delete', $photo->id) }}" method="POST" onsubmit="return confirm('Delete this test photo?')">
															@csrf
															@method('DELETE')
															<button type="submit" class="btn btn-sm btn-link text-danger p-0 text-decoration-none">
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
									<h5>No test photos uploaded yet for this event</h5>
									<p class="small">Upload 1 or more photos using the form above to see the live watermark overlay and extracted EXIF metadata!</p>
								</div>
							@endif
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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

			const formData = new FormData();
			formData.append('event_id', eventId);
			formData.append('personal_price', personalPrice);
			formData.append('commercial_price', commercialPrice);
			formData.append('_token', csrfToken);

			queuedFiles.forEach(file => {
				formData.append('photos[]', file);
			});

			progressText.textContent = `Uploading ${total} photo(s) to server...`;
			progressBar.style.width = '10%';
			progressPercent.textContent = '10%';

			const xhr = new XMLHttpRequest();
			xhr.open('POST', "{{ route('admin.dummy.photos.upload') }}", true);
			xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
			xhr.setRequestHeader('Accept', 'application/json');
			xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

			xhr.upload.onprogress = function(e) {
				if (e.lengthComputable) {
					const pct = Math.min(85, Math.round((e.loaded / e.total) * 85));
					progressBar.style.width = pct + '%';
					progressPercent.textContent = pct + '%';
					if (pct >= 85) {
						progressText.textContent = 'Server extracting EXIF metadata & burning Fotto watermarks...';
					} else {
						progressText.textContent = `Uploading ${total} photo(s) (${pct}%)...`;
					}
				}
			};

			xhr.onload = function() {
				if (xhr.status >= 200 && xhr.status < 300) {
					try {
						const result = JSON.parse(xhr.responseText);
						if (result.success) {
							progressBar.style.width = '100%';
							progressPercent.textContent = '100%';
							progressText.textContent = result.message || 'Photos uploaded & watermarked successfully!';
							setTimeout(() => {
								window.location.reload();
							}, 800);
							return;
						} else {
							alert('Upload failed: ' + (result.message || 'Unknown error.'));
						}
					} catch(err) {
						// Server returned non-JSON 200 (redirect or HTML)
						window.location.reload();
						return;
					}
				} else if (xhr.status === 419) {
					alert('Session expired! Please refresh this page and try uploading again.');
				} else if (xhr.status === 413) {
					alert('File upload too large! Total payload exceeds server limits.');
				} else {
					let errorMsg = 'Server returned HTTP ' + xhr.status;
					try {
						const errData = JSON.parse(xhr.responseText);
						if (errData && errData.message) errorMsg = errData.message;
					} catch(e) {}
					alert('Upload Failed: ' + errorMsg);
				}

				startBtn.disabled = false;
				startBtn.innerHTML = '<i class="bi bi-shield-lock-fill me-1"></i> Upload Queue &amp; Generate Watermarked Proofs';
				progressContainer.classList.add('d-none');
			};

			xhr.onerror = function() {
				alert('Network error occurred while uploading. Please check connection and try again.');
				startBtn.disabled = false;
				startBtn.innerHTML = '<i class="bi bi-shield-lock-fill me-1"></i> Upload Queue &amp; Generate Watermarked Proofs';
				progressContainer.classList.add('d-none');
			};

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
