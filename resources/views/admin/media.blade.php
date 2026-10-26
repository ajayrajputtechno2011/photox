<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
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
	<link rel="stylesheet" href="{{ asset('admin-assets/css/style.css') }}">
	<style>
		.media-grid {
			display: grid;
			grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
			gap: 16px;
		}
		.media-card {
			background: #081a2c;
			border: 1px solid #1e3346;
			border-radius: 12px;
			overflow: hidden;
			transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
			display: flex;
			flex-direction: column;
			position: relative;
		}
		.media-card:hover {
			transform: translateY(-2px);
			box-shadow: 0 10px 24px rgba(0, 0, 0, 0.45);
			border-color: #ff8a00;
		}
		.media-thumb-wrap {
			position: relative;
			width: 100%;
			height: 155px;
			background: #050d18;
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
			background: rgba(0, 0, 0, 0.78);
			color: #fff;
			font-size: 0.68rem;
			padding: 2px 7px;
			border-radius: 6px;
			font-family: 'DM Mono', monospace;
			border: 1px solid rgba(255, 255, 255, 0.15);
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
			color: #f1f5f9;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			margin-bottom: 4px;
		}
		.media-sub {
			font-size: 0.72rem;
			color: #94a3b8;
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
			border-top: 1px solid #162a3d;
		}
		.media-actions .btn {
			font-size: 0.74rem;
			padding: 4px 8px;
			border-radius: 6px;
		}
		.dropzone-box {
			background: rgba(13, 27, 40, 0.7);
			border: 2px dashed #294158;
			border-radius: 14px;
			padding: 28px 20px;
			text-align: center;
			cursor: pointer;
			transition: all .2s ease;
		}
		.dropzone-box:hover, .dropzone-box.dragover {
			border-color: #ff8a00;
			background: rgba(255, 138, 0, 0.06);
		}
		.dropzone-box i {
			font-size: 2.2rem;
			color: #ff8a00;
			display: block;
			margin-bottom: 8px;
		}
	</style>
</head>
<body>
	<div class="app-shell">
		@include('admin.partials.sidebar')

		<div class="main-panel">
			<header class="topbar">
				<div class="d-flex align-items-center gap-3">
					<button aria-controls="sidebar" aria-expanded="false" aria-label="Open navigation" class="icon-button menu-trigger" id="menuToggle" type="button"><i class="bi bi-list"></i></button>
					<div class="breadcrumb-wrap">
						<span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><span class="breadcrumb-muted">AI &amp; Media</span><i class="bi bi-chevron-right"></i><strong>Media Manager</strong>
					</div>
				</div>
				<div class="topbar-actions">
					<div class="profile-menu-wrap">
						<button class="profile-button" type="button" aria-haspopup="true" aria-expanded="false"><span class="profile-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'AD', 0, 2)) }}</span><span class="profile-copy"><strong>{{ Auth::user()->name ?? 'Admin' }}</strong><small>Administrator</small></span><i class="bi bi-chevron-down"></i></button>
						<div class="profile-dropdown-menu" role="menu">
							<a class="profile-menu-item text-decoration-none d-block py-2 px-3 text-light" href="/admin/settings" role="menuitem">
								<i class="bi bi-gear me-2"></i><span>Settings</span>
							</a>
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
							<h5 class="fw-bold mb-1 text-white">Click to Upload or Drag &amp; Drop Media Assets</h5>
							<p class="text-muted small mb-0">Supports JPG, PNG, WebP or SVG up to 15MB each · Uploaded files will be stored in Media Library</p>
						</div>
					</form>
				</section>

				<!-- Toolbar & Filter -->
				<section class="ops-table-panel p-3">
					<form method="GET" action="{{ route('admin.media.index') }}" class="ops-toolbar mb-4">
						<div class="d-flex gap-2 flex-grow-1 max-w-sm">
							<input type="text" name="q" class="form-control form-control-sm bg-dark border-secondary text-white" value="{{ request('q') }}" placeholder="Search by title or filename...">
							<button type="submit" class="btn btn-sm btn-primary px-3">Search</button>
						</div>
						<select name="folder" class="management-select bg-dark border-secondary text-white" onchange="this.form.submit()">
							<option value="all">All Folders</option>
							<option value="banners" {{ request('folder') === 'banners' ? 'selected' : '' }}>Banners</option>
							<option value="general" {{ request('folder') === 'general' ? 'selected' : '' }}>General</option>
						</select>
						@if(request()->hasAny(['q', 'folder']))
							<a href="{{ route('admin.media.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
						@endif
					</form>

					<!-- Media Asset Grid -->
					<div class="media-grid">
						@forelse($assets as $asset)
							<div class="media-card">
								<div class="media-thumb-wrap">
									<img src="{{ $asset->url }}" alt="{{ $asset->title }}" loading="lazy">
									@if($asset->width && $asset->height)
										<span class="media-meta-badge">{{ $asset->width }}×{{ $asset->height }}</span>
									@endif
								</div>
								<div class="media-info">
									<div class="media-title" title="{{ $asset->title }}">{{ $asset->title }}</div>
									<div class="media-sub">
										<span>{{ $asset->human_size }}</span>
										<span class="badge bg-secondary bg-opacity-25 text-light" style="font-size:0.65rem;">{{ strtoupper($asset->folder) }}</span>
									</div>
									<div class="media-actions">
										<button type="button" class="btn btn-sm btn-outline-secondary flex-grow-1" onclick="copyMediaUrl('{{ $asset->url }}', this)">
											<i class="bi bi-link-45deg me-1"></i>Copy URL
										</button>
										<button type="button" class="btn btn-sm btn-outline-info" onclick="previewImage('{{ $asset->url }}', '{{ addslashes($asset->title) }}')" title="Full Preview">
											<i class="bi bi-eye"></i>
										</button>
										<form action="{{ route('admin.media.destroy', $asset) }}" method="POST" onsubmit="return confirm('Delete this media asset?');" class="d-inline">
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
							<div class="col-12 py-5 text-center text-muted" style="grid-column: 1 / -1;">
								<i class="bi bi-images fs-1 d-block mb-3 opacity-50"></i>
								<h5>No media assets found</h5>
								<p class="small">Upload banners, sponsor logos, or promotional imagery above.</p>
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
			<div class="modal-content bg-dark text-white border border-secondary shadow-lg">
				<div class="modal-header border-secondary">
					<h6 class="modal-title fw-bold" id="previewModalTitle">Media Preview</h6>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body text-center p-2" style="background: #09121f;">
					<img src="" id="previewModalImg" style="max-height: 550px; width: auto; max-width: 100%; border-radius: 6px;" alt="Preview">
				</div>
				<div class="modal-footer border-secondary d-flex justify-content-between">
					<code id="previewModalUrl" class="small text-break text-warning"></code>
					<button type="button" class="btn btn-sm btn-outline-light" data-bs-dismiss="modal">Close</button>
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

		if (dropArea && uploadInput) {
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
		}
	</script>
</body>
</html>
