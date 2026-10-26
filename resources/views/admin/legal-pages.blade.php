<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<title>PhotoX Admin | Legal Policies &amp; POPIA Compliance</title>
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
	<link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet">
	<style>
		.policy-nav-pill {
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
		.policy-nav-pill:hover {
			background: #e5e7eb;
			color: #111827;
		}
		.policy-nav-pill.active {
			background: #0b2d5b;
			color: #ffffff !important;
			box-shadow: 0 4px 12px rgba(11, 45, 91, 0.2);
		}
		.ck-editor__editable_inline {
			min-height: 480px;
			max-height: 800px;
			font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif;
			font-size: 0.95rem;
			line-height: 1.65;
			color: #1e293b;
			padding: 1.25rem 1.5rem !important;
		}
		.ck.ck-toolbar {
			background: #f8fafc !important;
			border-color: #cbd5e1 !important;
			border-top-left-radius: 8px !important;
			border-top-right-radius: 8px !important;
		}
		.ck.ck-content {
			border-color: #cbd5e1 !important;
			border-bottom-left-radius: 8px !important;
			border-bottom-right-radius: 8px !important;
		}
		.ck.ck-editor__editable.ck-focused:not(.ck-editor__nested-editable) {
			border-color: #0b2d5b !important;
			box-shadow: 0 0 0 3px rgba(11, 45, 91, 0.12) !important;
		}
		.card .form-check-label {
			color: #0f172a !important;
		}
		.card .form-check-input {
			cursor: pointer;
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
						<span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><strong>Legal Policies &amp; POPIA Compliance</strong>
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

			<main class="content-area module-page ops-page p-4">
				<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
					<div>
						<h1 class="h3 fw-bold mb-1">Legal Policies &amp; POPIA Compliance</h1>
						<p class="text-muted mb-0">Manage South Africa POPIA Privacy Notices, Terms of Service, and Photo Licensing agreements.</p>
					</div>
					<div>
						<a href="/{{ $currentPage->slug ?? 'terms' }}" target="_blank" class="btn btn-outline-primary rounded-pill px-4">
							<i class="bi bi-box-arrow-up-right me-1"></i> View Live Page
						</a>
					</div>
				</div>

				@if(session('success'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
						<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
					</div>
				@endif

				<!-- Policy Tabs -->
				<div class="d-flex flex-wrap gap-2 mb-4">
					@foreach($pages as $p)
						<a href="{{ route('admin.legal.index', ['tab' => $p->slug]) }}" 
						   class="policy-nav-pill {{ $selectedSlug === $p->slug ? 'active' : '' }}">
							@if($p->slug === 'terms')
								<i class="bi bi-file-earmark-text"></i>
							@elseif($p->slug === 'privacy')
								<i class="bi bi-shield-lock"></i>
							@else
								<i class="bi bi-camera"></i>
							@endif
							{{ $p->title }}
						</a>
					@endforeach
				</div>

				<!-- Edit Policy Card -->
				<div class="card border-0 shadow-sm rounded-4">
					<div class="card-header bg-transparent border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
						<h5 class="fw-bold mb-0">Edit {{ $currentPage->title }}</h5>
						<span class="badge bg-secondary text-uppercase">{{ $currentPage->slug }}</span>
					</div>
					<div class="card-body p-4">
						<form action="{{ route('admin.legal.update', $currentPage) }}" method="POST">
							@csrf
							@method('PUT')

							<div class="row g-3">
								<div class="col-md-6">
									<label class="form-label fw-semibold">Policy Title</label>
									<input type="text" name="title" class="form-control" value="{{ old('title', $currentPage->title) }}" required>
								</div>

								<div class="col-md-6">
									<label class="form-label fw-semibold">Subtitle / Summary</label>
									<input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $currentPage->subtitle) }}">
								</div>

								<div class="col-md-6">
									<label class="form-label fw-semibold">Effective Date / Last Updated</label>
									<input type="text" name="last_updated" class="form-control" value="{{ old('last_updated', $currentPage->last_updated) }}" placeholder="e.g. October 2026">
								</div>

								<div class="col-md-6 pt-1">
									<label class="form-label fw-semibold d-block">Publication Status</label>
									<div class="p-2 px-3 rounded-3 d-flex align-items-center justify-content-between" style="background: #f8fafc; border: 1px solid #e2e8f0; min-height: 48px;">
										<label class="form-check-label fw-bold text-dark m-0 d-flex align-items-center gap-2" for="isActiveSwitch" style="color: #0f172a !important; cursor: pointer;">
											<i class="bi bi-eye-fill text-success fs-5"></i>
											<span style="color: #0f172a !important;">Active &amp; Publicly Visible</span>
										</label>
										<div class="form-check form-switch m-0 d-flex align-items-center">
											<input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActiveSwitch" {{ $currentPage->is_active ? 'checked' : '' }} style="cursor: pointer; width: 2.8em; height: 1.5em;">
										</div>
									</div>
								</div>

								<div class="col-12">
									<label class="form-label fw-semibold d-flex align-items-center justify-content-between">
										<span>Policy Content &amp; Clauses</span>
										<span class="badge bg-primary bg-opacity-10 text-primary fw-medium"><i class="bi bi-pencil-square me-1"></i> Rich WYSIWYG Editor</span>
									</label>
									<textarea id="policyContentEditor" name="content" class="form-control" rows="18" required>{{ old('content', $currentPage->content) }}</textarea>
									<small class="text-muted d-block mt-2">
										<i class="bi bi-info-circle me-1"></i> Format headings, lists, bold text, links, and tables directly using the editor toolbar above. Changes are automatically saved as compliant HTML.
									</small>
								</div>

								<div class="col-12 mt-4 text-end">
									<button type="submit" class="btn btn-primary rounded-pill px-5 fw-semibold shadow-sm">
										<i class="bi bi-check2-circle me-1"></i> Save Policy
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</main>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const editorElement = document.querySelector('#policyContentEditor');
			if (editorElement) {
				ClassicEditor
					.create(editorElement, {
						toolbar: {
							items: [
								'heading', '|',
								'bold', 'italic', 'underline', 'strikethrough', 'link', '|',
								'bulletedList', 'numberedList', '|',
								'outdent', 'indent', '|',
								'blockQuote', 'insertTable', '|',
								'undo', 'redo'
							],
							shouldNotGroupWhenFull: true
						},
						heading: {
							options: [
								{ model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
								{ model: 'heading2', view: 'h2', title: 'Heading 2 (Main Clause)', class: 'ck-heading_heading2' },
								{ model: 'heading3', view: 'h3', title: 'Heading 3 (Sub-Clause)', class: 'ck-heading_heading3' },
								{ model: 'heading4', view: 'h4', title: 'Heading 4 (Item)', class: 'ck-heading_heading4' }
							]
						},
						table: {
							contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
						}
					})
					.then(editor => {
						const form = editorElement.closest('form');
						if (form) {
							form.addEventListener('submit', () => {
								editorElement.value = editor.getData();
							});
						}
					})
					.catch(error => {
						console.error('CKEditor initialization error:', error);
					});
			}
		});
	</script>
</body>
</html>
