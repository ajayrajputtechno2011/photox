<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
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
		@include('admin.partials.sidebar')
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
					<h1>{{ isset($event) ? 'Edit Event: '.$event->title : 'Create event' }}</h1>
					<p class="intro-copy">Set up event information, sports categories, assigned photographer, publishing rules and delivery settings.</p>
				</div>

				@if(isset($errors) && $errors->any())
					<div class="alert alert-danger mb-4">
						<ul class="mb-0">
							@foreach($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif

				<form action="{{ isset($event) ? route('admin.events.update', $event) : route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="ops-form">
					@csrf
					@if(isset($event))
						@method('PUT')
					@endif
					<section class="ops-panel">
						<div class="section-heading">
							<div>
								<p class="eyebrow">01 / Event identity &amp; Photographer Assignment</p>
								<h3>Event information &amp; Branding</h3>
							</div><span class="form-step">Required</span>
						</div>
						<div class="row g-3">
							<div class="col-md-8">
								<label class="form-label" for="event-name">Event name <span class="text-danger">*</span></label>
								<input class="form-control" id="event-name" name="title" value="{{ old('title', $event->title ?? '') }}" placeholder="e.g. City Marathon 2026 or School A Rugby Day" required>
							</div>
							<div class="col-md-4">
								<label class="form-label" for="category-id">Sport / Category <span class="text-danger">*</span></label>
								<select class="form-select" id="category-id" name="category_id" required>
									<option value="">Select sport category...</option>
									@foreach($categories as $cat)
										<option value="{{ $cat->id }}" {{ old('category_id', $event->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-6">
								<label class="form-label" for="photographer_id">
									<i class="bi bi-camera-fill text-warning me-1"></i> Lead Photographer &amp; Watermark Creator
								</label>
								<select class="form-select" id="photographer_id" name="photographer_id">
									<option value="">— PhotoX Platform Default (Admin Watermark) —</option>
									@foreach($photographers as $p)
										<option value="{{ $p->id }}" {{ old('photographer_id', $event->photographer_id ?? '') == $p->id ? 'selected' : '' }}>
											{{ $p->name }} ({{ $p->email }})
										</option>
									@endforeach
								</select>
								<div class="form-text text-muted small">
									Proofs and photos uploaded to this event will display this photographer's custom watermark.
								</div>
							</div>
							<div class="col-md-6">
								<label class="form-label" for="location">Location / City <span class="text-danger">*</span></label>
								<input class="form-control" id="location" name="location" value="{{ old('location', $event->location ?? '') }}" placeholder="e.g. Cape Town, Stellenbosch, Durban" required>
							</div>
							<div class="col-md-6">
								<label class="form-label" for="event_date">Event Date</label>
								<input class="form-control" id="event_date" name="event_date" type="date" value="{{ old('event_date', isset($event) && $event->event_date ? $event->event_date->format('Y-m-d') : date('Y-m-d')) }}">
							</div>
							<div class="col-md-6">
								<label class="form-label" for="starting_price">Pricing Starting From (Display Label)</label>
								<input class="form-control" id="starting_price" name="starting_price" value="{{ old('starting_price', $event->starting_price ?? 'From R90') }}" placeholder="e.g. From R90">
							</div>
							<div class="col-md-6">
								<label class="form-label" for="commercial_price">Commercial License (Single Photo)</label>
								<div class="input-group">
									<span class="input-group-text">R</span>
									<input type="number" step="0.01" min="0" class="form-control" id="commercial_price" name="commercial_price" value="{{ old('commercial_price', isset($event) && $event->commercial_price !== null ? $event->commercial_price : '') }}" placeholder="e.g. 350.00 (Leave blank to hide)">
								</div>
								<small class="text-muted">Leave blank if commercial license is not offered for this event.</small>
							</div>
							<div class="col-md-6">
								<label class="form-label" for="selfie_bundle_price">Selfie / Athlete Bundle Price</label>
								<div class="input-group">
									<span class="input-group-text">R</span>
									<input type="number" step="0.01" min="0" class="form-control" id="selfie_bundle_price" name="selfie_bundle_price" value="{{ old('selfie_bundle_price', isset($event) && $event->selfie_bundle_price !== null ? $event->selfie_bundle_price : '') }}" placeholder="e.g. 150.00 (Leave blank to hide)">
								</div>
								<small class="text-muted">Flat rate for matched bib/selfie photos. Leave blank to hide.</small>
							</div>
							<div class="col-md-6">
								<label class="form-label" for="full_gallery_price">Buy Complete Gallery Price</label>
								<div class="input-group">
									<span class="input-group-text">R</span>
									<input type="number" step="0.01" min="0" class="form-control" id="full_gallery_price" name="full_gallery_price" value="{{ old('full_gallery_price', isset($event) && $event->full_gallery_price !== null ? $event->full_gallery_price : '') }}" placeholder="e.g. 450.00 (Leave blank to hide)">
								</div>
								<small class="text-muted">Flat rate for all captures in this event. Leave blank to hide.</small>
							</div>
							<div class="col-12">
								<label class="form-label" for="cover_image">Cover Image URL</label>
								<input class="form-control" id="cover_image" name="cover_image" value="{{ old('cover_image', $event->cover_image ?? '') }}" placeholder="https://images.unsplash.com/...">
								<div class="text-center my-2 text-muted small">— OR UPLOAD FILE —</div>
								<input type="file" name="cover_file" class="form-control" accept="image/*">
							</div>
							<div class="col-12">
								<label class="form-label" for="description">Description</label>
								<textarea class="form-control" id="description" name="description" placeholder="Add the event description shown to customers and athletes" rows="3">{{ old('description', $event->description ?? '') }}</textarea>
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
									<option value="published" {{ old('status', $event->status ?? 'published') === 'published' ? 'selected' : '' }}>Published (Live on website)</option>
									<option value="draft" {{ old('status', $event->status ?? '') === 'draft' ? 'selected' : '' }}>Draft (Private)</option>
									<option value="archived" {{ old('status', $event->status ?? '') === 'archived' ? 'selected' : '' }}>Archived</option>
								</select>
							</div>
							<div class="col-md-6 d-flex align-items-center pt-4">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" name="is_featured" value="1" id="isFeaturedSwitch" {{ old('is_featured', $event->is_featured ?? false) ? 'checked' : '' }}>
									<label class="form-check-label fw-bold" for="isFeaturedSwitch">Feature on Explore page hero/latest</label>
								</div>
							</div>
						</div>
					</section>

					<div class="ops-form-actions">
						<a class="btn btn-outline-secondary" href="/admin/events">Cancel</a>
						<button class="btn btn-primary" type="submit"><i class="bi bi-broadcast"></i> {{ isset($event) ? 'Update Event & Watermark' : 'Create & Save Event' }}</button>
					</div>
				</form>
			</main>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="{{ asset('admin-assets/js/app.js') }}"></script>
</body>
</html>