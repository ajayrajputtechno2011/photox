<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<title>PhotoX Admin | AI Processing</title>
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
						<span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><strong>AI Processing</strong>
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
				<div class="page-intro">
					<p class="eyebrow">Automation control room</p>
					<h1>AI Processing</h1>
					<p class="intro-copy">Monitor smart image processing jobs and keep optional AI features healthy.</p>
				</div>
				<section class="ops-hero">
					<div class="ops-hero-copy">
						<p class="eyebrow">Live processing health</p>
						<h2>AI services are operating normally</h2>
						<p>Gallery owners can enable or disable AI processing independently. Current throughput is within the expected range.</p>
					</div><span class="ops-hero-icon"><i class="bi bi-stars"></i></span>
				</section>
				<section class="row g-3 mb-3">
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-list-task"></i></span>
							</div>
							<p>Jobs in queue</p>
							<h2>18</h2><small>Estimated wait 4 minutes</small>
						</article>
					</div>
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-arrow-repeat"></i></span>
							</div>
							<p>Running now</p>
							<h2>6</h2><small>Across 4 galleries</small>
						</article>
					</div>
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-check-circle"></i></span>
							</div>
							<p>Completed today</p>
							<h2>142</h2><small>18,420 images processed</small>
						</article>
					</div>
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-exclamation-triangle"></i></span>
							</div>
							<p>Failed jobs</p>
							<h2>2</h2><small>Needs admin review</small>
						</article>
					</div>
				</section>
				<div class="ops-grid-2">
					<section class="ops-table-panel">
						<div class="d-flex align-items-start justify-content-between gap-3">
							<div>
								<p class="eyebrow">Queue monitor</p>
								<h3>Processing jobs</h3>
							</div><span class="ops-pill green"><i class="bi bi-circle-fill"></i> Live</span>
						</div>
						<div class="ops-toolbar">
							<div class="search-field">
								<i class="bi bi-search"></i><input aria-label="Search AI jobs" placeholder="Search gallery or job ID" type="search">
							</div><select aria-label="Filter AI status" class="management-select">
								<option>
									All statuses
								</option>
								<option>
									Queued
								</option>
								<option>
									Running
								</option>
								<option>
									Completed
								</option>
								<option>
									Failed
								</option>
							</select>
						</div>
						<div class="ops-table-wrap">
							<table class="table ops-table">
								<thead>
									<tr>
										<th>Gallery / job</th>
										<th>Images</th>
										<th>Started</th>
										<th>Duration</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><strong>Rugby Day · Face matching</strong><small>AI-20984 · Jordan Miller</small></td>
										<td><strong>2,450</strong><small>Face grouping</small></td>
										<td><strong>10:12 AM</strong><small>Today</small></td>
										<td><strong>02:48</strong><small>Estimated 04:10</small></td>
										<td><span class="ops-pill blue">Running</span></td>
									</tr>
									<tr>
										<td><strong>City Cycle · Smart tags</strong><small>AI-20983 · Sarah Kim</small></td>
										<td><strong>1,820</strong><small>Scene tagging</small></td>
										<td><strong>09:48 AM</strong><small>Today</small></td>
										<td><strong>03:22</strong><small>Complete</small></td>
										<td><span class="ops-pill green">Completed</span></td>
									</tr>
									<tr>
										<td><strong>Athletics · Image quality</strong><small>AI-20976 · Michael Adams</small></td>
										<td><strong>1,240</strong><small>Quality scoring</small></td>
										<td><strong>Yesterday</strong><small>02:21 PM</small></td>
										<td><strong>--</strong><small>Retry available</small></td>
										<td><span class="ops-pill red">Failed</span></td>
									</tr>
								</tbody>
							</table>
						</div>
					</section>
					<aside class="ops-panel">
						<div class="section-heading">
							<div>
								<p class="eyebrow">Usage overview</p>
								<h3>Daily throughput</h3>
							</div><i class="bi bi-graph-up-arrow control-heading-icon"></i>
						</div>
						<div class="queue-total">
							<strong>18,420</strong><span>images today</span>
						</div>
						<div class="ops-chart-bar">
							<span style="--bar-height:42%"></span><span style="--bar-height:55%"></span><span style="--bar-height:48%"></span><span style="--bar-height:72%"></span><span style="--bar-height:64%"></span><span style="--bar-height:86%"></span><span style="--bar-height:76%"></span>
						</div>
						<div class="ops-chart-labels">
							<span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
						</div>
						<div class="detail-actions">
							<a class="btn btn-outline-light" href="/admin/admin-galleries"><i class="bi bi-collection"></i> View galleries</a>
						</div>
					</aside>
				</div>
			</main>
		</div>
	</div>
	<div class="sidebar-backdrop" id="sidebarBackdrop"></div>
	<script src="{{ asset('admin-assets/js/app.js') }}">
	</script>
</body>
</html>