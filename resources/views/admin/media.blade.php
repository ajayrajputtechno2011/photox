<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PhotoX Admin · Media Manager</title>
	<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<link rel="stylesheet" href="{{ asset('admin-assets/css/styles.css') }}">
	<style>
		.media-grid {
			display: grid;
			grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
			gap: 16px;
		}
		.media-card {
			background: #ffffff;
			border: 1px solid #e2e8f0;
			border-radius: 12px;
			overflow: hidden;
			transition: transform .18s ease, box-shadow .18s ease;
			display: flex;
			flex-direction: column;
			position: relative;
		}
		.media-card:hover {
			transform: translateY(-2px);
			box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
			border-color: #cbd5e1;
		}
		.media-thumb-wrap {
			position: relative;
			width: 100%;
			height: 150px;
			background: #09121f;
			display: flex;
			align-items: center;
			justify-content: center;
			overflow: hidden;
		}
		.media-thumb-wrap img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			transition: transform .25s ease;
		}
		.media-card:hover .media-thumb-wrap img {
			transform: scale(1.04);
		}
		.media-meta-badge {
			position: absolute;
			bottom: 8px;
			right: 8px;
			background: rgba(0, 0, 0, 0.72);
			color: #fff;
			font-size: 0.68rem;
			padding: 2px 6px;
			border-radius: 6px;
			font-family: 'DM Mono', monospace;
		}
		.media-info {
			padding: 12px;
			display: flex;
			flex-direction: column;
			flex-grow: 1;
		}
		.media-title {
			font-size: 0.85rem;
			font-weight: 600;
			color: #0f172a;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			margin-bottom: 4px;
		}
		.media-sub {
			font-size: 0.72rem;
			color: #64748b;
			margin-bottom: 10px;
			display: flex;
			justify-content: space-between;
			align-items: center;
		}
		.media-actions {
			display: flex;
			gap: 6px;
			margin-top: auto;
			padding-top: 8px;
			border-top: 1px solid #f1f5f9;
		}
		.media-actions .btn {
			font-size: 0.74rem;
			padding: 4px 8px;
			border-radius: 6px;
		}
		.dropzone-box {
			background: #f8fafc;
			border: 2px dashed #cbd5e1;
			border-radius: 14px;
			padding: 28px 20px;
			text-align: center;
			cursor: pointer;
			transition: all .2s ease;
		}
		.dropzone-box:hover, .dropzone-box.dragover {
			border-color: #3b82f6;
			background: #eff6ff;
		}
		.dropzone-box i {
			font-size: 2.2rem;
			color: #3b82f6;
			display: block;
			margin-bottom: 8px;
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
          <a class="nav-link active" href="/admin/media"><i class="bi bi-images"></i><span>Media Manager</span></a>
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
        </nav>
      </div>
    </aside>

		<div class="main-body">
			<header class="topbar">
				<div class="topbar-left">
					<button class="icon-button" id="sidebarToggle" type="button" aria-label="Toggle navigation">
						<i class="bi bi-list"></i>
					</button>
					<div class="global-search">
						<i class="bi bi-search"></i>
						<input aria-label="Search" placeholder="Search media assets..." type="search" />
					</div>
				</div>
				<div class="topbar-right">
					<div class="profile-menu">
						<button class="profile-trigger" id="profileTrigger" type="button" aria-expanded="false" aria-haspopup="true">
							<span class="user-avatar">{{ substr(auth()->user()->name ?? 'A', 0, 2) }}</span>
							<span class="user-meta">
								<strong>{{ auth()->user()->name ?? 'Admin User' }}</strong>
								<small>{{ auth()->user()->role ?? 'Administrator' }}</small>
							</span>
							<i class="bi bi-chevron-down"></i>
						</button>
						<div class="profile-dropdown" id="profileDropdown" role="menu">
							<a class="profile-menu-item" href="/admin/settings" role="menuitem">
								<i class="bi bi-gear"></i><span>Settings</span>
							</a>
							<form method="POST" action="{{ route('logout') }}">
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
						<p class="eyebrow">Digital Assets &amp; Creatives</p>
						<h1>Media Manager</h1>
						<p class="intro-copy">Central repository for banner artworks, promotional graphics, and sponsor creatives. Reuse media across campaigns to save storage and time.</p>
					</div>
					<div class="d-flex gap-2 flex-wrap">
						<a class="btn btn-outline-secondary" href="/admin/banners">
							<i class="bi bi-layout-text-window me-1"></i> Go to Banners
						</a>
						<button class="btn create-button" type="button" onclick="document.getElementById('directUploadInput').click();">
							<i class="bi bi-cloud-arrow-up me-1"></i> Upload Images
						</button>
					</div>
				</div>

				<section class="row g-3 mb-4">
					<div class="col-xl-4 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-images"></i></span>
							</div>
							<p>Total Media Assets</p>
							<h2>{{ $totalCount }}</h2>
							<small>Available to select &amp; reuse</small>
						</article>
					</div>
					<div class="col-xl-4 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-hdd-network"></i></span>
							</div>
							<p>Storage Used</p>
							<h2>{{ $totalMb }} <span class="fs-6 fw-normal text-muted">MB</span></h2>
							<small>Public asset footprint</small>
						</article>
					</div>
					<div class="col-xl-4 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-repeat"></i></span>
							</div>
							<p>Campaign Reusability</p>
							<h2>100%</h2>
							<small>Direct integration with Banners</small>
						</article>
					</div>
				</section>

				<!-- Upload Dropzone Section -->
				<section class="ops-table-panel mb-4 p-4">
					<form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" id="mediaUploadForm">
						@csrf
						<input type="file" name="files[]" id="directUploadInput" multiple accept="image/*" style="display:none;" onchange="this.form.submit();">
						<div class="dropzone-box" onclick="document.getElementById('directUploadInput').click();" id="dropArea">
							<i class="bi bi-cloud-arrow-up"></i>
							<h5 class="fw-bold mb-1">Click to Upload or Drag &amp; Drop Media Assets</h5>
							<p class="text-muted small mb-0">Supports JPG, PNG, WebP or SVG up to 15MB each · Uploaded files will be stored in Media Library</p>
						</div>
					</form>
				</section>

				<!-- Toolbar & Filter -->
				<section class="ops-table-panel p-3">
					<form method="GET" action="{{ route('admin.media.index') }}" class="ops-toolbar mb-4">
						<div class="d-flex gap-2 flex-grow-1 max-w-sm">
							<input type="text" name="q" class="form-control form-control-sm" value="{{ request('q') }}" placeholder="Search by title or filename...">
							<button type="submit" class="btn btn-sm btn-primary px-3">Search</button>
						</div>
						<select name="folder" class="management-select" onchange="this.form.submit()">
							<option value="all">All Folders</option>
							<option value="banners" {{ request('folder') === 'banners' ? 'selected' : '' }}>Banners</option>
							<option value="general" {{ request('folder') === 'general' ? 'selected' : '' }}>General</option>
						</select>
						@if(request()->hasAny(['q', 'folder']))
							<a href="{{ route('admin.media.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
						@endif
					</form>

					<!-- Media Cards Grid -->
					<div class="media-grid">
						@forelse($assets as $asset)
							<div class="media-card">
								<div class="media-thumb-wrap">
									<img src="{{ $asset->url }}" alt="{{ $asset->title ?: $asset->filename }}" loading="lazy" onclick="previewImage('{{ $asset->url }}', '{{ addslashes($asset->title ?: $asset->filename) }}')" style="cursor: pointer;">
									@if($asset->dimensions)
										<span class="media-meta-badge">{{ $asset->dimensions }}</span>
									@endif
								</div>
								<div class="media-info">
									<div class="media-title" title="{{ $asset->title ?: $asset->filename }}">
										{{ $asset->title ?: $asset->filename }}
									</div>
									<div class="media-sub">
										<span><i class="bi bi-file-earmark me-1"></i>{{ $asset->formatted_size }}</span>
										<span>{{ $asset->created_at ? $asset->created_at->format('d M Y') : '—' }}</span>
									</div>
									<div class="media-actions">
										<button type="button" class="btn btn-sm btn-outline-primary flex-grow-1" onclick="copyMediaUrl('{{ $asset->url }}', this)" title="Copy File URL">
											<i class="bi bi-clipboard me-1"></i> Copy URL
										</button>
										<form action="{{ route('admin.media.destroy', $asset) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this media asset?');" class="d-inline">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
												<i class="bi bi-trash"></i>
											</button>
										</form>
									</div>
								</div>
							</div>
						@empty
							<div class="col-12 text-center py-5 text-muted">
								<i class="bi bi-images fs-1 d-block mb-2 text-secondary opacity-50"></i>
								<h5>No media assets found.</h5>
								<p class="small text-muted">Upload banner artwork above to build your media library.</p>
							</div>
						@endforelse
					</div>

					<div class="pt-4">
						{{ $assets->links('admin.partials.pagination') }}
					</div>
				</section>
			</main>
		</div>
	</div>

	<!-- Image Preview Modal -->
	<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content border-0 shadow">
				<div class="modal-header">
					<h6 class="modal-title" id="previewModalTitle">Media Preview</h6>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body text-center p-2" style="background: #09121f;">
					<img src="" id="previewModalImg" style="max-height: 550px; width: auto; max-width: 100%; border-radius: 6px;" alt="Preview">
				</div>
				<div class="modal-footer d-flex justify-content-between">
					<code id="previewModalUrl" class="small text-break"></code>
					<button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="{{ asset('admin-assets/js/app.js') }}"></script>
	<script>
		function previewImage(url, title) {
			document.getElementById('previewModalImg').src = url;
			document.getElementById('previewModalTitle').innerText = title;
			document.getElementById('previewModalUrl').innerText = url;
			new bootstrap.Modal(document.getElementById('imagePreviewModal')).show();
		}

		function copyMediaUrl(url, btn) {
			navigator.clipboard.writeText(url).then(() => {
				const originalHtml = btn.innerHTML;
				btn.innerHTML = '<i class="bi bi-check-lg text-success"></i> Copied!';
				btn.classList.add('btn-light');
				setTimeout(() => {
					btn.innerHTML = originalHtml;
					btn.classList.remove('btn-light');
				}, 1800);
			}).catch(() => {
				prompt("Copy URL manually:", url);
			});
		}

		// Drag & drop support
		const dropArea = document.getElementById('dropArea');
		const uploadInput = document.getElementById('directUploadInput');

		['dragenter', 'dragover'].forEach(eventName => {
			dropArea.addEventListener(eventName, (e) => {
				e.preventDefault();
				e.stopPropagation();
				dropArea.classList.add('dragover');
			});
		});

		['dragleave', 'drop'].forEach(eventName => {
			dropArea.addEventListener(eventName, (e) => {
				e.preventDefault();
				e.stopPropagation();
				dropArea.classList.remove('dragover');
			});
		});

		dropArea.addEventListener('drop', (e) => {
			const dt = e.dataTransfer;
			const files = dt.files;
			if (files.length > 0) {
				uploadInput.files = files;
				document.getElementById('mediaUploadForm').submit();
			}
		});
	</script>
</body>
</html>
