<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<title>PhotoX Admin | Customer - {{ $customer->name }}</title>
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
						<a class="breadcrumb-muted" href="{{ route('admin.customers.index') }}">Customers</a><i class="bi bi-chevron-right"></i><strong>{{ $customer->name }}</strong>
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
						<h1>{{ $customer->name }}</h1>
						<p class="intro-copy">Contact information, account activity and administrative control.</p>
					</div>
					<a class="btn btn-outline-light" href="{{ route('admin.customers.index') }}"><i class="bi bi-arrow-left"></i> Back to customers</a>
				</div>

				@if(session('success'))
					<div class="alert alert-success alert-dismissible fade show border-0 bg-success bg-opacity-25 text-white mb-3 d-flex align-items-center justify-content-between px-3 py-2 rounded" role="alert">
						<div><i class="bi bi-check-circle-fill me-2 text-success"></i> {{ session('success') }}</div>
						<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				@endif

				@if(isset($errors) && $errors->any())
					<div class="alert alert-danger alert-dismissible fade show border-0 bg-danger bg-opacity-25 text-white mb-3 px-3 py-2 rounded" role="alert">
						<ul class="mb-0 ps-3">
							@foreach($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif

				@php
					$initials = strtoupper(substr($customer->name, 0, 2));
				@endphp

				<section class="ops-hero d-flex align-items-center justify-content-between flex-wrap gap-3">
					<div class="ops-detail-hero d-flex align-items-center gap-3">
						<span class="ops-avatar display-6">{{ $initials }}</span>
						<div>
							<h2 class="mb-1">{{ $customer->name }}</h2>
							<p class="text-muted mb-2">{{ $customer->email }} · {{ $customer->location ?: 'South Africa' }}</p>
							<div class="profile-meta d-flex gap-3 text-muted small">
								<span><i class="bi bi-phone"></i> {{ $customer->phone ?: 'No phone' }}</span>
								<span><i class="bi bi-calendar3"></i> Customer since {{ $customer->created_at ? $customer->created_at->format('M Y') : 'N/A' }}</span>
								<span><i class="bi bi-hash"></i> ID: PX-{{ str_pad($customer->id, 5, '0', STR_PAD_LEFT) }}</span>
							</div>
						</div>
					</div>
					<div>
						@if($customer->status === 'active')
							<span class="ops-pill green"><i class="bi bi-check-circle"></i> Active account</span>
						@elseif($customer->status === 'blocked')
							<span class="ops-pill" style="color:#ef4444; border-color:rgba(239,68,68,0.3); background:rgba(239,68,68,0.1);"><i class="bi bi-slash-circle"></i> Blocked account</span>
						@else
							<span class="ops-pill orange"><i class="bi bi-clock"></i> Inactive account</span>
						@endif
					</div>
				</section>

				<form action="{{ route('admin.customers.update', $customer->id) }}" method="POST">
					@csrf
					@method('PUT')

					<div class="ops-grid-2 mt-3">
						{{-- Left Column: Profile Information Form --}}
						<section class="ops-panel">
							<div class="section-heading mb-3">
								<div>
									<p class="eyebrow">Personal details</p>
									<h3>Edit customer profile</h3>
								</div>
								<i class="bi bi-person-lines-fill control-heading-icon text-muted"></i>
							</div>

							<div class="mb-3">
								<label class="form-label text-muted small" for="customer-name">Full Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="customer-name" name="name" value="{{ old('name', $customer->name) }}" required>
							</div>

							<div class="mb-3">
								<label class="form-label text-muted small" for="customer-email">Email Address <span class="text-danger">*</span></label>
								<input type="email" class="form-control" id="customer-email" name="email" value="{{ old('email', $customer->email) }}" required>
							</div>

							<div class="row g-2 mb-3">
								<div class="col-md-6">
									<label class="form-label text-muted small" for="customer-phone">Phone Number</label>
									<input type="text" class="form-control" id="customer-phone" name="phone" value="{{ old('phone', $customer->phone) }}" placeholder="+27 82 000 0000">
								</div>
								<div class="col-md-6">
									<label class="form-label text-muted small" for="customer-location">Preferred Location / City</label>
									<input type="text" class="form-control" id="customer-location" name="location" value="{{ old('location', $customer->location) }}" placeholder="Cape Town, South Africa">
								</div>
							</div>

							<div class="d-flex justify-content-end">
								<button type="submit" class="btn btn-primary px-4"><i class="bi bi-check2"></i> Save Changes</button>
							</div>
						</section>

						{{-- Right Column: Status & Admin Controls --}}
						<aside class="ops-panel">
							<div class="section-heading mb-3">
								<div>
									<p class="eyebrow">Account control</p>
									<h3>Status & Administration</h3>
								</div>
								<i class="bi bi-shield-lock control-heading-icon text-muted"></i>
							</div>

							<div class="mb-3">
								<label class="form-label text-muted small" for="customer-role">Account Role &amp; Access</label>
								<select class="form-select" id="customer-role" name="role">
									<option value="customer" {{ old('role', $customer->role) === 'customer' ? 'selected' : '' }}>Customer (Buyer &amp; Gallery Viewer)</option>
									<option value="photographer" {{ old('role', $customer->role) === 'photographer' ? 'selected' : '' }}>Photographer (Creator Studio &amp; Sales)</option>
								</select>
								<small class="text-muted d-block mt-1">Promoting to Photographer enables the Creator Studio while retaining buyer history.</small>
							</div>

							<div class="mb-3">
								<label class="form-label text-muted small" for="customer-status">Account Status</label>
								<select class="form-select" id="customer-status" name="status">
									<option value="active" {{ old('status', $customer->status) === 'active' ? 'selected' : '' }}>Active account</option>
									<option value="inactive" {{ old('status', $customer->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
									<option value="blocked" {{ old('status', $customer->status) === 'blocked' ? 'selected' : '' }}>Blocked</option>
								</select>
							</div>

							<div class="mb-3">
								<label class="form-label text-muted small" for="customer-note">Internal Administrative Notes</label>
								<textarea class="form-control" id="customer-note" name="admin_notes" placeholder="Record support notes, special tags or customer context..." rows="4">{{ old('admin_notes', $customer->admin_notes) }}</textarea>
							</div>

							<div class="detail-actions d-flex align-items-center justify-content-between pt-2">
								<button class="btn btn-primary" type="submit"><i class="bi bi-shield-check"></i> Update Status & Notes</button>
							</div>
						</aside>
					</div>
				</form>

				{{-- Danger Zone & Actions Section --}}
				<section class="ops-panel mt-3">
					<div class="section-heading">
						<div>
							<p class="eyebrow text-warning">Security & Maintenance</p>
							<h3>Quick account actions</h3>
						</div>
					</div>

					<div class="d-flex align-items-center gap-3 flex-wrap pt-2">
						<form action="{{ route('admin.customers.toggle', $customer->id) }}" method="POST">
							@csrf
							<button type="submit" class="btn {{ $customer->status === 'active' ? 'btn-outline-warning' : 'btn-outline-success' }}">
								<i class="bi {{ $customer->status === 'active' ? 'bi-lock' : 'bi-unlock' }}"></i>
								{{ $customer->status === 'active' ? 'Block this account' : 'Unblock / Activate account' }}
							</button>
						</form>

						<form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete customer {{ $customer->name }}? This action cannot be undone.');">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-outline-danger">
								<i class="bi bi-trash"></i> Permanently Delete Customer
							</button>
						</form>
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