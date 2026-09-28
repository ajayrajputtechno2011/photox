<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<title>PhotoX Admin | Memberships</title>
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
					<a class="nav-link active" href="/admin/memberships"><i class="bi bi-person-vcard"></i><span>Memberships</span></a>
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
						<span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><strong>Memberships</strong>
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

				@if($errors->any())
					<div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
						<ul class="mb-0">
							@foreach($errors->all() as $err)
								<li>{{ $err }}</li>
							@endforeach
						</ul>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				@endif

				<div class="page-intro d-flex align-items-end justify-content-between gap-3 flex-wrap">
					<div>
						<p class="eyebrow">Creator Monetisation &amp; Tiers</p>
						<h1>Membership Plans</h1>
						<p class="intro-copy">Configure subscription tiers, commission splits, storage allocations, and pricing shown on the public Membership page.</p>
					</div>
					<div class="d-flex gap-2">
						<a href="/membership" target="_blank" class="btn btn-outline-secondary">
							<i class="bi bi-box-arrow-up-right me-1"></i> View on Website
						</a>
						<button class="btn create-button" type="button" data-bs-toggle="modal" data-bs-target="#addPlanModal">
							<i class="bi bi-plus-lg"></i> Add Plan
						</button>
					</div>
				</div>

				<section class="row g-3 mb-3">
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-person-vcard"></i></span>
							</div>
							<p>Total Plans</p>
							<h2>{{ $totalPlans }}</h2>
							<small>Configured subscription tiers</small>
						</article>
					</div>
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-check-circle"></i></span>
							</div>
							<p>Active on Website</p>
							<h2>{{ $activePlans }}</h2>
							<small>Live on public pricing table</small>
						</article>
					</div>
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-people"></i></span>
							</div>
							<p>Active Subscribers</p>
							<h2>{{ number_format($totalSubscribers) }}</h2>
							<small>Photographers &amp; studios</small>
						</article>
					</div>
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-stars"></i></span>
							</div>
							<p>Pro Plan (Flagship)</p>
							<h2>R 399<small class="fs-6 text-muted">/mo</small></h2>
							<small>Most popular creator tier</small>
						</article>
					</div>
				</section>

				<section class="ops-table-panel">
					<div class="d-flex align-items-start justify-content-between gap-3">
						<div>
							<p class="eyebrow">Plan Directory</p>
							<h3>All Membership Tiers</h3>
						</div>
					</div>

					<div class="ops-table-wrap mt-3">
						<table class="table ops-table">
							<thead>
								<tr>
									<th>Plan</th>
									<th>Monthly Price</th>
									<th>Yearly Price</th>
									<th>Commission</th>
									<th>Storage</th>
									<th>Features</th>
									<th>Theme Style</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@forelse($memberships as $plan)
									<tr>
										<td>
											<div class="d-flex align-items-center gap-2">
												<span class="badge {{ $plan->is_featured ? 'bg-primary' : 'bg-secondary' }} px-2 py-1">
													{{ $plan->badge ?: $plan->name }}
												</span>
												<div>
													<strong>{{ $plan->name }}</strong>
													@if($plan->is_featured)
														<span class="badge bg-warning text-dark ms-1">Featured</span>
													@endif
													<small class="d-block text-muted">{{ Str::limit($plan->tagline, 40) }}</small>
												</div>
											</div>
										</td>
										<td>
											@if($plan->monthly_price !== null && $plan->monthly_price > 0)
												<strong class="text-success">{{ $plan->currency }} {{ number_format($plan->monthly_price, 0) }}</strong>
												<small class="text-muted d-block">/ month</small>
											@elseif($plan->monthly_price === 0.00 || $plan->monthly_price === '0.00' || $plan->monthly_price === 0)
												<strong class="text-primary">{{ $plan->currency }} 0</strong>
												<small class="text-muted d-block">forever</small>
											@else
												<span class="badge bg-light text-dark border">{{ $plan->price_display ?: 'Custom' }}</span>
											@endif
										</td>
										<td>
											@if($plan->yearly_price !== null && $plan->yearly_price > 0)
												<strong>{{ $plan->currency }} {{ number_format($plan->yearly_price, 0) }}</strong>
												<small class="text-muted d-block">/ year</small>
											@elseif($plan->yearly_price === 0.00 || $plan->yearly_price === '0.00' || $plan->yearly_price === 0)
												<span class="text-muted">Free</span>
											@else
												<span class="badge bg-light text-dark border">{{ $plan->price_display ?: 'Quote' }}</span>
											@endif
										</td>
										<td>
											<span class="badge bg-light text-dark border px-2 py-1">
												{{ $plan->commission_rate }}
											</span>
										</td>
										<td>
											<span class="badge bg-info-subtle text-info-emphasis border px-2 py-1">
												{{ $plan->storage_limit }}
											</span>
										</td>
										<td>
											<small class="text-muted">{{ count($plan->features ?? []) }} perks included</small>
										</td>
										<td>
											<span class="badge {{ $plan->theme_style === 'featured' ? 'bg-warning text-dark' : ($plan->theme_style === 'custom' ? 'bg-dark text-white' : 'bg-light text-dark border') }} text-capitalize">
												{{ $plan->theme_style }}
											</span>
										</td>
										<td>
											<form action="{{ route('admin.memberships.toggle', $plan) }}" method="POST" class="d-inline">
												@csrf
												@method('PATCH')
												<button type="submit" class="border-0 bg-transparent p-0" title="Click to toggle status">
													@if($plan->is_active)
														<span class="ops-pill green" style="cursor:pointer;"><i class="bi bi-check-circle"></i> Active</span>
													@else
														<span class="ops-pill orange" style="cursor:pointer;"><i class="bi bi-x-circle"></i> Inactive</span>
													@endif
												</button>
											</form>
										</td>
										<td>
											<div class="ops-actions">
												<button type="button" class="row-action border-0 bg-transparent" title="Edit Plan"
													data-bs-toggle="modal" data-bs-target="#editModal{{ $plan->id }}">
													<i class="bi bi-pencil"></i>
												</button>
												<form action="{{ route('admin.memberships.destroy', $plan) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete \'{{ $plan->name }}\' plan?');">
													@csrf
													@method('DELETE')
													<button type="submit" class="row-action border-0 bg-transparent text-danger" title="Delete Plan">
														<i class="bi bi-trash"></i>
													</button>
												</form>
											</div>

											<!-- Edit Plan Modal -->
											<div class="modal fade" id="editModal{{ $plan->id }}" tabindex="-1" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-lg">
													<div class="modal-content">
														<form action="{{ route('admin.memberships.update', $plan) }}" method="POST">
															@csrf
															@method('PUT')
															<div class="modal-header">
																<h5 class="modal-title font-monospace">Edit Plan: {{ $plan->name }}</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
															</div>
															<div class="modal-body text-start">
																<div class="row g-3">
																	<div class="col-md-6">
																		<label class="form-label fw-semibold">Plan Name <span class="text-danger">*</span></label>
																		<input type="text" name="name" class="form-control" value="{{ $plan->name }}" required>
																	</div>
																	<div class="col-md-6">
																		<label class="form-label fw-semibold">Badge Label</label>
																		<input type="text" name="badge" class="form-control" value="{{ $plan->badge }}" placeholder="e.g. Pro, Most Popular">
																	</div>
																	<div class="col-12">
																		<label class="form-label fw-semibold">Tagline / Description</label>
																		<input type="text" name="tagline" class="form-control" value="{{ $plan->tagline }}" placeholder="Short pitch for this plan">
																	</div>
																	<div class="col-md-4">
																		<label class="form-label fw-semibold">Monthly Price (R)</label>
																		<input type="number" step="0.01" name="monthly_price" class="form-control" value="{{ $plan->monthly_price }}" placeholder="Leave blank if Custom">
																	</div>
																	<div class="col-md-4">
																		<label class="form-label fw-semibold">Yearly Price (R)</label>
																		<input type="number" step="0.01" name="yearly_price" class="form-control" value="{{ $plan->yearly_price }}" placeholder="Leave blank if Custom">
																	</div>
																	<div class="col-md-4">
																		<label class="form-label fw-semibold">Price Display Note</label>
																		<input type="text" name="price_display" class="form-control" value="{{ $plan->price_display }}" placeholder="e.g. forever or quote">
																	</div>
																	<div class="col-md-6">
																		<label class="form-label fw-semibold">Commission Split</label>
																		<input type="text" name="commission_rate" class="form-control" value="{{ $plan->commission_rate }}" placeholder="e.g. 7%">
																	</div>
																	<div class="col-md-6">
																		<label class="form-label fw-semibold">Storage Allocation</label>
																		<input type="text" name="storage_limit" class="form-control" value="{{ $plan->storage_limit }}" placeholder="e.g. 500 GB or 2 TB">
																	</div>
																	<div class="col-md-6">
																		<label class="form-label fw-semibold">Theme Style</label>
																		<select name="theme_style" class="form-select">
																			<option value="light" {{ $plan->theme_style === 'light' ? 'selected' : '' }}>Light Card</option>
																			<option value="featured" {{ $plan->theme_style === 'featured' ? 'selected' : '' }}>Featured Card (Dark &amp; Highlighted)</option>
																			<option value="custom" {{ $plan->theme_style === 'custom' ? 'selected' : '' }}>Custom Quote Card</option>
																		</select>
																	</div>
																	<div class="col-md-6">
																		<label class="form-label fw-semibold">Features Section Header</label>
																		<input type="text" name="features_included_title" class="form-control" value="{{ $plan->features_included_title }}" placeholder="e.g. INCLUDED IN PRO:">
																	</div>
																	<div class="col-12">
																		<label class="form-label fw-semibold">Features List <small class="text-muted">(Write one feature per line)</small></label>
																		<textarea name="features_text" class="form-control font-monospace" rows="6" placeholder="Bulk photo upload&#10;AI face &amp; bib number recognition&#10;Email support">{{ is_array($plan->features) ? implode("\n", $plan->features) : '' }}</textarea>
																	</div>
																	<div class="col-md-6">
																		<label class="form-label fw-semibold">Button Text</label>
																		<input type="text" name="button_text" class="form-control" value="{{ $plan->button_text }}" placeholder="e.g. Choose Pro">
																	</div>
																	<div class="col-md-6">
																		<label class="form-label fw-semibold">Button URL</label>
																		<input type="text" name="button_url" class="form-control" value="{{ $plan->button_url }}" placeholder="e.g. /signup or /contact">
																	</div>
																	<div class="col-md-4">
																		<label class="form-label fw-semibold">Sort Order</label>
																		<input type="number" name="sort_order" class="form-control" value="{{ $plan->sort_order }}">
																	</div>
																	<div class="col-md-4 d-flex align-items-center pt-3">
																		<div class="form-check form-switch">
																			<input class="form-check-input" type="checkbox" name="is_featured" value="1" id="editFeatured{{ $plan->id }}" {{ $plan->is_featured ? 'checked' : '' }}>
																			<label class="form-check-label fw-semibold" for="editFeatured{{ $plan->id }}">Highlight as Featured</label>
																		</div>
																	</div>
																	<div class="col-md-4 d-flex align-items-center pt-3">
																		<div class="form-check form-switch">
																			<input class="form-check-input" type="checkbox" name="is_active" value="1" id="editActive{{ $plan->id }}" {{ $plan->is_active ? 'checked' : '' }}>
																			<label class="form-check-label fw-semibold" for="editActive{{ $plan->id }}">Active on Website</label>
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
										<td colspan="9" class="text-center py-4 text-muted">
											<i class="bi bi-inbox fs-2 d-block mb-2"></i>
											No membership plans found.
										</td>
									</tr>
								@endforelse
							</tbody>
						</table>
					</div>
				</section>
			</main>
		</div>
	</div>

	<!-- Add Plan Modal -->
	<div class="modal fade" id="addPlanModal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<form action="{{ route('admin.memberships.store') }}" method="POST">
					@csrf
					<div class="modal-header">
						<h5 class="modal-title font-monospace">Add New Membership Plan</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body text-start">
						<div class="row g-3">
							<div class="col-md-6">
								<label class="form-label fw-semibold">Plan Name <span class="text-danger">*</span></label>
								<input type="text" name="name" class="form-control" placeholder="e.g. Studio Premium" required>
							</div>
							<div class="col-md-6">
								<label class="form-label fw-semibold">Badge Label</label>
								<input type="text" name="badge" class="form-control" placeholder="e.g. Studio Premium">
							</div>
							<div class="col-12">
								<label class="form-label fw-semibold">Tagline / Description</label>
								<input type="text" name="tagline" class="form-control" placeholder="e.g. Built for commercial photography teams.">
							</div>
							<div class="col-md-4">
								<label class="form-label fw-semibold">Monthly Price (R)</label>
								<input type="number" step="0.01" name="monthly_price" class="form-control" placeholder="e.g. 599">
							</div>
							<div class="col-md-4">
								<label class="form-label fw-semibold">Yearly Price (R)</label>
								<input type="number" step="0.01" name="yearly_price" class="form-control" placeholder="e.g. 5990">
							</div>
							<div class="col-md-4">
								<label class="form-label fw-semibold">Price Display Note</label>
								<input type="text" name="price_display" class="form-control" placeholder="e.g. / month">
							</div>
							<div class="col-md-6">
								<label class="form-label fw-semibold">Commission Split</label>
								<input type="text" name="commission_rate" class="form-control" value="6%" placeholder="e.g. 6%">
							</div>
							<div class="col-md-6">
								<label class="form-label fw-semibold">Storage Allocation</label>
								<input type="text" name="storage_limit" class="form-control" value="1 TB" placeholder="e.g. 1 TB">
							</div>
							<div class="col-md-6">
								<label class="form-label fw-semibold">Theme Style</label>
								<select name="theme_style" class="form-select">
									<option value="light">Light Card</option>
									<option value="featured">Featured Card (Dark &amp; Highlighted)</option>
									<option value="custom">Custom Quote Card</option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="form-label fw-semibold">Features Section Header</label>
								<input type="text" name="features_included_title" class="form-control" value="INCLUDED IN PLAN:">
							</div>
							<div class="col-12">
								<label class="form-label fw-semibold">Features List <small class="text-muted">(Write one feature per line)</small></label>
								<textarea name="features_text" class="form-control font-monospace" rows="6" placeholder="Bulk photo upload&#10;AI facial &amp; bib recognition&#10;Unlimited galleries&#10;Dedicated account manager"></textarea>
							</div>
							<div class="col-md-6">
								<label class="form-label fw-semibold">Button Text</label>
								<input type="text" name="button_text" class="form-control" value="Choose Plan">
							</div>
							<div class="col-md-6">
								<label class="form-label fw-semibold">Button URL</label>
								<input type="text" name="button_url" class="form-control" value="/signup">
							</div>
							<div class="col-md-4">
								<label class="form-label fw-semibold">Sort Order</label>
								<input type="number" name="sort_order" class="form-control" value="5">
							</div>
							<div class="col-md-4 d-flex align-items-center pt-3">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" name="is_featured" value="1" id="addFeatured">
									<label class="form-check-label fw-semibold" for="addFeatured">Highlight as Featured</label>
								</div>
							</div>
							<div class="col-md-4 d-flex align-items-center pt-3">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" name="is_active" value="1" id="addActive" checked>
									<label class="form-check-label fw-semibold" for="addActive">Active on Website</label>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary">Create Plan</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="{{ asset('admin-assets/js/app.js') }}"></script>
</body>
</html>
