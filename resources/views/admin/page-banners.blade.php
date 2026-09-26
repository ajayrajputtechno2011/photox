<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<title>PhotoX Admin | Page Banners &amp; Heroes</title>
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
	<link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet">
	<style>
		.page-nav-pill {
			padding: 0.65rem 1.25rem;
			font-weight: 600;
			font-size: 0.9rem;
			border-radius: 999px;
			color: #4b5563;
			background: #f3f4f6;
			text-decoration: none;
			transition: all 0.2s ease;
			display: inline-flex;
			align-items: center;
			gap: 0.5rem;
		}
		.page-nav-pill:hover {
			background: #e5e7eb;
			color: #111827;
		}
		.page-nav-pill.active {
			background: #0b2d5b;
			color: #ffffff !important;
			box-shadow: 0 4px 12px rgba(11, 45, 91, 0.2);
		}
		.hero-preview-box {
			background: linear-gradient(135deg, #071c38 0%, #0b2d5b 100%);
			color: #ffffff;
			border-radius: 16px;
			padding: 2.25rem;
			position: relative;
			overflow: hidden;
		}
		.hero-preview-kicker {
			display: inline-flex;
			align-items: center;
			gap: 0.4rem;
			font-size: 0.78rem;
			text-transform: uppercase;
			letter-spacing: 0.08em;
			font-weight: 700;
			color: #8be136;
			margin-bottom: 0.75rem;
		}
		.hero-preview-title {
			font-family: 'Space Grotesk', sans-serif;
			font-size: 2rem;
			font-weight: 700;
			line-height: 1.2;
			margin-bottom: 0.85rem;
		}
		.hero-preview-title em {
			font-style: italic;
			color: #8be136;
		}
		.hero-preview-desc {
			font-size: 0.95rem;
			color: rgba(255, 255, 255, 0.82);
			line-height: 1.6;
			margin-bottom: 1.5rem;
		}
		.btn-preview-lime {
			background: #8be136;
			color: #071c38;
			font-weight: 700;
			border-radius: 999px;
			padding: 0.55rem 1.4rem;
			border: none;
			display: inline-flex;
			align-items: center;
			gap: 0.35rem;
		}
		.btn-preview-outline {
			border: 1px solid rgba(255, 255, 255, 0.35);
			color: #ffffff;
			font-weight: 600;
			border-radius: 999px;
			padding: 0.55rem 1.4rem;
			background: transparent;
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
          <a class="nav-link active" href="/admin/page-banners"><i class="bi bi-card-heading"></i><span>Page Banners</span></a>
          <a class="nav-link" href="/admin/blog"><i class="bi bi-pencil-square"></i><span>Blog</span></a>
          <a class="nav-link" href="/admin/announcements"><i class="bi bi-megaphone"></i><span>Announcements</span></a>
          <a class="nav-link" href="/admin/messages"><i class="bi bi-chat-left-text"></i><span>Messages</span></a>
          <a class="nav-link" href="/admin/notifications"><i class="bi bi-bell"></i><span>Notifications</span></a>
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
						<span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><strong>Page Banners &amp; Heroes</strong>
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
						<p class="eyebrow">Content Management / Page Heroes</p>
						<h1>Page Banners &amp; Headings</h1>
						<p class="intro-copy">Customize headlines, subtexts, kickers, images and button actions across all 6 main website pages.</p>
					</div>
				</div>

				<!-- Page Navigation Pills -->
				<div class="d-flex align-items-center gap-2 flex-wrap mb-4 pb-2 border-bottom">
					@php
						$pageList = [
							'events' => ['name' => 'Explore (Events)', 'icon' => 'bi-compass'],
							'photographers' => ['name' => 'Photographers', 'icon' => 'bi-camera'],
							'membership' => ['name' => 'Membership', 'icon' => 'bi-card-checklist'],
							'about' => ['name' => 'About', 'icon' => 'bi-info-circle'],
							'contact' => ['name' => 'Contact', 'icon' => 'bi-envelope'],
							'home' => ['name' => 'Home', 'icon' => 'bi-house'],
						];
					@endphp
					@foreach($pageList as $key => $meta)
						<a href="{{ route('admin.page-banners.index', ['tab' => $key]) }}" class="page-nav-pill {{ $activeTab === $key ? 'active' : '' }}">
							<i class="bi {{ $meta['icon'] }}"></i>
							<span>{{ $meta['name'] }}</span>
						</a>
					@endforeach
				</div>

				@php
					$currentHero = $heroes[$activeTab] ?? null;
				@endphp

				@if($currentHero)
					<div class="row g-4">
						<!-- Edit Form -->
						<div class="col-lg-7">
							<section class="ops-panel p-4 shadow-sm bg-white rounded-3">
								<div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
									<div>
										<h4 class="mb-1 font-monospace">Editing: {{ $currentHero->page_name }}</h4>
										<small class="text-muted">Target Page URL: <a href="/{{ $currentHero->page_key === 'home' ? '' : ($currentHero->page_key === 'events' ? 'events' : $currentHero->page_key) }}" target="_blank" class="text-decoration-none">/{{ $currentHero->page_key === 'home' ? '' : ($currentHero->page_key === 'events' ? 'events' : $currentHero->page_key) }} <i class="bi bi-box-arrow-up-right"></i></a></small>
									</div>
									<span class="badge bg-primary px-3 py-2">Active Live</span>
								</div>

								<form action="{{ route('admin.page-banners.update', $currentHero) }}" method="POST" enctype="multipart/form-data">
									@csrf
									@method('PUT')

									<div class="row g-3">
										<div class="col-md-6">
											<label class="form-label fw-bold">Section Kicker / Badge</label>
											<input type="text" name="kicker" class="form-control" value="{{ old('kicker', $currentHero->kicker) }}" placeholder="e.g. Live archive, About PhotoX">
											<small class="text-muted">Small pill label shown above the headline</small>
										</div>

										<div class="col-md-6">
											<label class="form-label fw-bold">Badge Text</label>
											<input type="text" name="badge_text" class="form-control" value="{{ old('badge_text', $currentHero->badge_text) }}" placeholder="e.g. Live Archive">
										</div>

										<div class="col-12">
											<label class="form-label fw-bold">Hero Headline Title <span class="text-danger">*</span></label>
											<textarea name="title" class="form-control" rows="2" required placeholder="e.g. Find the moment. Then keep it.">{{ old('title', $currentHero->title) }}</textarea>
											<small class="text-muted">You can use <code>&lt;em&gt;green text&lt;/em&gt;</code> or <code>&lt;br&gt;</code> for line breaks.</small>
										</div>

										<div class="col-12">
											<label class="form-label fw-bold">Description / Intro Paragraph</label>
											<textarea name="description" class="form-control" rows="3" placeholder="Add descriptive copy...">{{ old('description', $currentHero->description) }}</textarea>
										</div>

										<div class="col-md-6">
											<label class="form-label fw-bold">Primary Button Text</label>
											<input type="text" name="primary_button_text" class="form-control" value="{{ old('primary_button_text', $currentHero->primary_button_text) }}" placeholder="e.g. Browse events">
										</div>

										<div class="col-md-6">
											<label class="form-label fw-bold">Primary Button Link</label>
											<input type="text" name="primary_button_url" class="form-control" value="{{ old('primary_button_url', $currentHero->primary_button_url) }}" placeholder="e.g. #discover or /events">
										</div>

										<div class="col-md-6">
											<label class="form-label fw-bold">Secondary Button Text</label>
											<input type="text" name="secondary_button_text" class="form-control" value="{{ old('secondary_button_text', $currentHero->secondary_button_text) }}" placeholder="e.g. Create account">
										</div>

										<div class="col-md-6">
											<label class="form-label fw-bold">Secondary Button Link</label>
											<input type="text" name="secondary_button_url" class="form-control" value="{{ old('secondary_button_url', $currentHero->secondary_button_url) }}" placeholder="e.g. /signup">
										</div>

										@if($currentHero->page_key === 'about')
											<div class="col-12 mt-4 pt-3 border-top">
												<h5 class="mb-3">Featured Story Card (Right Side of About Hero)</h5>
												<div class="mb-3">
													<label class="form-label fw-bold">Story Headline</label>
													<input type="text" name="story_title" class="form-control" value="{{ old('story_title', $currentHero->extra_data['story_title'] ?? '') }}">
												</div>
												<div class="mb-3">
													<label class="form-label fw-bold">Story Description</label>
													<textarea name="story_description" class="form-control" rows="2">{{ old('story_description', $currentHero->extra_data['story_description'] ?? '') }}</textarea>
												</div>
											</div>
										@endif

										<div class="col-12 mt-3 pt-3 border-top">
											<label class="form-label fw-bold">Hero / Feature Image URL</label>
											<input type="text" name="image_url" class="form-control mb-2" value="{{ old('image_url', $currentHero->image_url) }}" placeholder="https://images.unsplash.com/... or /storage/...">
											<div class="text-center text-muted small my-2">— OR UPLOAD NEW IMAGE —</div>
											<input type="file" name="image_file" class="form-control" accept="image/*">
										</div>
									</div>

									<div class="mt-4 pt-3 border-top d-flex gap-2">
										<button type="submit" class="btn btn-primary px-4 py-2">
											<i class="bi bi-check-lg me-1"></i> Save Changes
										</button>
										<a href="/{{ $currentHero->page_key === 'home' ? '' : ($currentHero->page_key === 'events' ? 'events' : $currentHero->page_key) }}" target="_blank" class="btn btn-outline-secondary px-3 py-2">
											<i class="bi bi-box-arrow-up-right me-1"></i> Preview on Website
										</a>
									</div>
								</form>
							</section>
						</div>

						<!-- Live Visual Preview -->
						<div class="col-lg-5">
							<div class="sticky-top" style="top: 2rem;">
								<div class="d-flex align-items-center justify-content-between mb-2">
									<h6 class="text-muted text-uppercase small fw-bold mb-0">Live Website Preview</h6>
									<span class="badge bg-success"><i class="bi bi-broadcast"></i> Live synced</span>
								</div>

								<div class="hero-preview-box shadow">
									<div class="hero-preview-kicker">
										<span class="live-dot" style="width: 8px; height: 8px; border-radius: 50%; background: #8be136; display: inline-block;"></span>
										<span>{{ $currentHero->kicker ?: 'SECTION KICKER' }}</span>
									</div>

									<div class="hero-preview-title">
										{!! $currentHero->title !!}
									</div>

									<div class="hero-preview-desc">
										{{ $currentHero->description }}
									</div>

									<div class="d-flex align-items-center gap-2 flex-wrap">
										@if($currentHero->primary_button_text)
											<span class="btn-preview-lime">
												{{ $currentHero->primary_button_text }}
											</span>
										@endif
										@if($currentHero->secondary_button_text)
											<span class="btn-preview-outline">
												{{ $currentHero->secondary_button_text }}
											</span>
										@endif
									</div>

									@if($currentHero->image_url)
										<div class="mt-4 rounded overflow-hidden border border-secondary shadow-sm">
											<img src="{{ $currentHero->image_url }}" alt="Preview" style="width: 100%; height: 160px; object-fit: cover;">
										</div>
									@endif
								</div>

								<div class="card mt-3 bg-light border p-3 small text-muted">
									<i class="bi bi-info-circle me-1 text-primary"></i>
									Right-side Ad Carousel Banners (Car, Shoe, Swimming) can be managed separately under <a href="/admin/banners" class="fw-bold text-decoration-none">Admin &gt; Banners</a>.
								</div>
							</div>
						</div>
					</div>
				@endif
			</main>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="{{ asset('admin-assets/js/app.js') }}"></script>
</body>
</html>
