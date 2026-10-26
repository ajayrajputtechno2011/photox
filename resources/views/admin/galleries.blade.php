<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<title>PhotoX Admin | Galleries</title>
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
						<span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><strong>Galleries</strong>
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
				<div class="page-intro d-flex align-items-end justify-content-between gap-3 flex-wrap">
					<div>
						<p class="eyebrow">Media library</p>
						<h1>Galleries</h1>
						<p class="intro-copy">Monitor gallery publishing, AI settings and image delivery across events.</p>
					</div><a class="btn create-button" href="/admin/add-event"><i class="bi bi-plus-lg"></i> Create gallery</a>
				</div>
				<section class="row g-3 mb-3">
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-collection"></i></span>
							</div>
							<p>Total galleries</p>
							<h2>1,284</h2><small>Across 86 events</small>
						</article>
					</div>
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-broadcast"></i></span>
							</div>
							<p>Published</p>
							<h2>1,108</h2><small>86.3% visibility rate</small>
						</article>
					</div>
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-stars"></i></span><span class="trend positive">68%</span>
							</div>
							<p>AI enabled</p>
							<h2>874</h2><small>Smart delivery active</small>
						</article>
					</div>
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-hourglass-split"></i></span>
							</div>
							<p>Expiring soon</p>
							<h2>42</h2><small>Within the next 14 days</small>
						</article>
					</div>
				</section>
				<section class="ops-table-panel">
					<div>
						<p class="eyebrow">Gallery directory</p>
						<h3>Event galleries</h3>
					</div>
					<div class="ops-toolbar">
						<div class="search-field">
							<i class="bi bi-search"></i><input aria-label="Search galleries" placeholder="Search gallery or event" type="search">
						</div><select aria-label="Filter gallery status" class="management-select">
							<option>
								All statuses
							</option>
							<option>
								Published
							</option>
							<option>
								Draft
							</option>
							<option>
								Expiring
							</option>
						</select><select aria-label="Filter AI setting" class="management-select">
							<option>
								AI: Any
							</option>
							<option>
								AI enabled
							</option>
							<option>
								AI disabled
							</option>
						</select>
					</div>
					<div class="ops-table-wrap">
						<table class="table ops-table">
							<thead>
								<tr>
									<th>Gallery</th>
									<th>Event</th>
									<th>Photographer</th>
									<th>Images</th>
									<th>AI</th>
									<th>Visibility</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><strong>Rugby Day · Main Field</strong><small>Updated 18 min ago</small></td>
									<td><strong>School A Rugby Day</strong><small>24 Sep 2026</small></td>
									<td><strong>Jordan Miller</strong><small>Pro Studio</small></td>
									<td><strong>2,450</strong><small>48.9 GB</small></td>
									<td><span class="ops-pill blue"><i class="bi bi-stars"></i> Enabled</span></td>
									<td><span class="ops-pill green">Published</span></td>
									<td>
										<div class="ops-actions">
											<a aria-label="Open gallery" class="row-action" href="/admin/gallery-detail"><i class="bi bi-eye"></i></a><a aria-label="Manage images" class="row-action" href="/admin/admin-images"><i class="bi bi-images"></i></a>
										</div>
									</td>
								</tr>
								<tr>
									<td><strong>City Cycle · Finish Line</strong><small>Updated yesterday</small></td>
									<td><strong>City Cycle Classic</strong><small>02 Oct 2026</small></td>
									<td><strong>Sarah Kim</strong><small>Pro Studio</small></td>
									<td><strong>1,820</strong><small>32.6 GB</small></td>
									<td><span class="ops-pill gray">Disabled</span></td>
									<td><span class="ops-pill orange">Draft</span></td>
									<td>
										<div class="ops-actions">
											<a aria-label="Open gallery" class="row-action" href="/admin/gallery-detail"><i class="bi bi-eye"></i></a><a aria-label="Manage images" class="row-action" href="/admin/admin-images"><i class="bi bi-images"></i></a>
										</div>
									</td>
								</tr>
								<tr>
									<td><strong>Spring Athletics · Track</strong><small>Updated 2 days ago</small></td>
									<td><strong>Spring Athletics Meet</strong><small>18 Oct 2026</small></td>
									<td><strong>Michael Adams</strong><small>Starter</small></td>
									<td><strong>1,240</strong><small>18.1 GB</small></td>
									<td><span class="ops-pill blue"><i class="bi bi-stars"></i> Enabled</span></td>
									<td><span class="ops-pill orange">Private</span></td>
									<td>
										<div class="ops-actions">
											<a aria-label="Open gallery" class="row-action" href="/admin/gallery-detail"><i class="bi bi-eye"></i></a><a aria-label="Manage images" class="row-action" href="/admin/admin-images"><i class="bi bi-images"></i></a>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="ops-pagination">
						<span>Showing 1–3 of 1,284 galleries</span>
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