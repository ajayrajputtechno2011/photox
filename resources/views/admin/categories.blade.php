<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<title>PhotoX Admin | Categories</title>
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
          <a class="nav-link active" href="/admin/categories"><i class="bi bi-tags"></i><span>Categories</span></a>
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
						<span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><strong>Categories</strong>
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
						<p class="eyebrow">Category &amp; Taxonomy Management</p>
						<h1>Categories</h1>
						<p class="intro-copy">Configure sports categories displayed on the Explore events page and search filters.</p>
					</div>
					<button class="btn create-button" type="button" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
						<i class="bi bi-plus-lg"></i> Add Category
					</button>
				</div>

				<section class="row g-3 mb-3">
					<div class="col-xl-4 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-tags"></i></span>
							</div>
							<p>Total Categories</p>
							<h2>{{ $totalCount }}</h2>
							<small>Configured sports &amp; event types</small>
						</article>
					</div>
					<div class="col-xl-4 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-check-circle"></i></span>
							</div>
							<p>Active on Website</p>
							<h2>{{ $activeCount }}</h2>
							<small>Visible in public navigation &amp; filters</small>
						</article>
					</div>
					<div class="col-xl-4 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-eye-slash"></i></span>
							</div>
							<p>Inactive</p>
							<h2>{{ $totalCount - $activeCount }}</h2>
							<small>Draft / hidden categories</small>
						</article>
					</div>
				</section>

				<section class="ops-table-panel">
					<div class="d-flex align-items-start justify-content-between gap-3 mb-3">
						<div>
							<p class="eyebrow">Organisations / Categories</p>
							<h3>All Categories</h3>
						</div>
					</div>

					<form method="GET" action="{{ route('admin.categories.index') }}" class="ops-toolbar">
						<div class="search-field">
							<i class="bi bi-search"></i>
							<input name="search" value="{{ request('search') }}" aria-label="Search categories" placeholder="Search category name or description..." type="search">
						</div>
						<select name="status" class="management-select" onchange="this.form.submit()">
							<option value="">All Statuses</option>
							<option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
							<option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
						</select>
						@if(request()->hasAny(['search', 'status']))
							<a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
						@endif
					</form>

					<div class="ops-table-wrap">
						<table class="table ops-table">
							<thead>
								<tr>
									<th>Icon</th>
									<th>Category Name</th>
									<th>Slug</th>
									<th>Description</th>
									<th>Events Count</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@forelse($categories as $category)
									<tr>
										<td style="width: 60px;">
											<div class="d-flex align-items-center justify-content-center bg-light rounded" style="width: 40px; height: 40px; font-size: 1.25rem; color: #0b2d5b;">
												<i class="bi {{ $category->icon ?: 'bi-trophy' }}"></i>
											</div>
										</td>
										<td>
											<strong>{{ $category->name }}</strong>
											<small class="text-muted d-block">Sort order: {{ $category->sort_order }}</small>
										</td>
										<td><code>{{ $category->slug }}</code></td>
										<td style="max-width: 280px;">
											<span class="text-truncate d-inline-block" style="max-width: 280px;" title="{{ $category->description }}">
												{{ $category->description ?: 'No description' }}
											</span>
										</td>
										<td>
											<span class="badge bg-light text-dark border px-2 py-1">
												{{ $category->events_count }} events
											</span>
										</td>
										<td>
											<form action="{{ route('admin.categories.toggle', $category) }}" method="POST" class="d-inline">
												@csrf
												@method('PATCH')
												<button type="submit" class="border-0 bg-transparent p-0" title="Click to toggle status">
													@if($category->is_active)
														<span class="ops-pill green" style="cursor:pointer;"><i class="bi bi-check-circle"></i> Active</span>
													@else
														<span class="ops-pill orange" style="cursor:pointer;"><i class="bi bi-x-circle"></i> Inactive</span>
													@endif
												</button>
											</form>
										</td>
										<td>
											<div class="ops-actions">
												<button type="button" class="row-action border-0 bg-transparent" title="Edit Category"
													data-bs-toggle="modal" data-bs-target="#editModal{{ $category->id }}">
													<i class="bi bi-pencil"></i>
												</button>
												<form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete category \'{{ $category->name }}\'?');">
													@csrf
													@method('DELETE')
													<button type="submit" class="row-action border-0 bg-transparent text-danger" title="Delete Category">
														<i class="bi bi-trash"></i>
													</button>
												</form>
											</div>

											<!-- Edit Modal -->
											<div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered">
													<div class="modal-content">
														<form action="{{ route('admin.categories.update', $category) }}" method="POST">
															@csrf
															@method('PUT')
															<div class="modal-header">
																<h5 class="modal-title font-monospace">Edit Category: {{ $category->name }}</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
															</div>
															<div class="modal-body text-start">
																<div class="mb-3">
																	<label class="form-label">Category Name <span class="text-danger">*</span></label>
																	<input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
																</div>
																<div class="mb-3">
																	<label class="form-label">Slug</label>
																	<input type="text" name="slug" class="form-control" value="{{ $category->slug }}">
																	<small class="text-muted">Unique URL identifier</small>
																</div>
																<div class="mb-3">
																	<label class="form-label">Bootstrap Icon Class</label>
																	<div class="input-group">
																		<span class="input-group-text"><i class="bi {{ $category->icon ?: 'bi-trophy' }}"></i></span>
																		<input type="text" name="icon" class="form-control" value="{{ $category->icon }}">
																	</div>
																	<small class="text-muted">e.g. bi-trophy, bi-lightning-charge, bi-bicycle, bi-people</small>
																</div>
																<div class="mb-3">
																	<label class="form-label">Description</label>
																	<textarea name="description" class="form-control" rows="2">{{ $category->description }}</textarea>
																</div>
																<div class="row">
																	<div class="col-6 mb-3">
																		<label class="form-label">Sort Order</label>
																		<input type="number" name="sort_order" class="form-control" value="{{ $category->sort_order }}">
																	</div>
																	<div class="col-6 mb-3 d-flex align-items-center pt-4">
																		<div class="form-check form-switch">
																			<input class="form-check-input" type="checkbox" name="is_active" value="1" id="activeSwitch{{ $category->id }}" {{ $category->is_active ? 'checked' : '' }}>
																			<label class="form-check-label" for="activeSwitch{{ $category->id }}">Active</label>
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
											No categories found.
										</td>
									</tr>
								@endforelse
							</tbody>
						</table>
					</div>

					<div class="p-3">
						{{ $categories->links('admin.partials.pagination') }}
					</div>
				</section>
			</main>
		</div>
	</div>

	<!-- Add Category Modal -->
	<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form action="{{ route('admin.categories.store') }}" method="POST">
					@csrf
					<div class="modal-header">
						<h5 class="modal-title">Create New Category</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body text-start">
						<div class="mb-3">
							<label class="form-label">Category Name <span class="text-danger">*</span></label>
							<input type="text" name="name" class="form-control" placeholder="e.g. Rugby, Running, Swimming" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Slug (Optional)</label>
							<input type="text" name="slug" class="form-control" placeholder="Auto-generated from name if left empty">
						</div>
						<div class="mb-3">
							<label class="form-label">Bootstrap Icon Class</label>
							<input type="text" name="icon" class="form-control" placeholder="e.g. bi-trophy, bi-bicycle, bi-people" value="bi-trophy">
							<small class="text-muted">Use standard Bootstrap icons like <code>bi-trophy</code>, <code>bi-lightning-charge</code>, <code>bi-bicycle</code></small>
						</div>
						<div class="mb-3">
							<label class="form-label">Description</label>
							<textarea name="description" class="form-control" rows="2" placeholder="Brief summary shown on popular categories cards..."></textarea>
						</div>
						<div class="row">
							<div class="col-6 mb-3">
								<label class="form-label">Sort Order</label>
								<input type="number" name="sort_order" class="form-control" value="0">
							</div>
							<div class="col-6 mb-3 d-flex align-items-center pt-4">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" name="is_active" value="1" id="addActiveSwitch" checked>
									<label class="form-check-label" for="addActiveSwitch">Active</label>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary">Create Category</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="{{ asset('admin-assets/js/app.js') }}"></script>
</body>
</html>
