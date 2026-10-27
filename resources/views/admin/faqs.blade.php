<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<title>PhotoX Admin | FAQ Management</title>
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
	<link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet">
	<style>
		.faq-cat-badge {
			font-size: 0.75rem;
			font-weight: 600;
			padding: 0.35rem 0.75rem;
			border-radius: 999px;
			text-transform: uppercase;
			letter-spacing: 0.05em;
		}
		.cat-general { background: #e0f2fe; color: #0369a1; }
		.cat-selfie_bundles { background: #fef3c7; color: #b45309; }
		.cat-licenses { background: #ede9fe; color: #6d28d9; }
		.cat-orders { background: #dcfce7; color: #15803d; }
		.cat-photographers { background: #fee2e2; color: #b91c1c; }
		.faq-question-title {
			font-weight: 600;
			color: #0f172a;
			font-size: 0.95rem;
			margin-bottom: 0.25rem;
		}
		.faq-answer-snippet {
			color: #64748b;
			font-size: 0.85rem;
			line-height: 1.5;
			display: -webkit-box;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
			overflow: hidden;
		}
		.stat-card-clean {
			background: #ffffff;
			border: 1px solid #e2e8f0;
			border-radius: 14px;
			padding: 1.25rem 1.5rem;
			display: flex;
			align-items: center;
			gap: 1.25rem;
			box-shadow: 0 1px 3px rgba(0,0,0,0.03);
		}
		.stat-icon-box {
			width: 48px;
			height: 48px;
			border-radius: 12px;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 1.35rem;
		}
	</style>
</head>
<body>
	<div class="app-shell">
		@include('admin.partials.sidebar')

		<div class="app-main">
			<header class="topbar">
				<div class="topbar-left">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0">
							<li class="breadcrumb-item"><a href="/admin/dashboard" class="text-decoration-none text-muted">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">FAQs Management</li>
						</ol>
					</nav>
				</div>
				<div class="topbar-right d-flex align-items-center gap-3">
					<a href="{{ url('/about') }}#faqs" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
						<i class="bi bi-box-arrow-up-right me-1"></i> Preview on About Page
					</a>
				</div>
			</header>

			<main class="content-body p-4">
				{{-- Page Header --}}
				<div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
					<div>
						<h1 class="h3 fw-bold text-dark mb-1">Frequently Asked Questions</h1>
						<p class="text-muted mb-0">Manage customer &amp; photographer FAQs rendered on the About page and help centers.</p>
					</div>
					<button class="btn btn-primary rounded-pill px-4 fw-semibold" data-bs-toggle="modal" data-bs-target="#createFaqModal">
						<i class="bi bi-plus-lg me-1"></i> Add New FAQ
					</button>
				</div>

				{{-- Alert Messages --}}
				@if(session('success'))
					<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center mb-4" role="alert">
						<i class="bi bi-check-circle-fill text-success fs-5 me-2"></i>
						<div>{{ session('success') }}</div>
						<button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				@endif

				@if($errors->any())
					<div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
						<i class="bi bi-exclamation-triangle-fill text-danger fs-5 me-2"></i>
						<span>{{ $errors->first() }}</span>
						<button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				@endif

				{{-- Stats Strip --}}
				<div class="row g-3 mb-4">
					<div class="col-md-4">
						<div class="stat-card-clean">
							<div class="stat-icon-box bg-primary bg-opacity-10 text-primary">
								<i class="bi bi-question-circle"></i>
							</div>
							<div>
								<div class="text-muted small fw-medium">Total Questions</div>
								<div class="fs-4 fw-bold text-dark">{{ $stats['total'] }}</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="stat-card-clean">
							<div class="stat-icon-box bg-success bg-opacity-10 text-success">
								<i class="bi bi-check2-circle"></i>
							</div>
							<div>
								<div class="text-muted small fw-medium">Active (Published)</div>
								<div class="fs-4 fw-bold text-dark">{{ $stats['active'] }}</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="stat-card-clean">
							<div class="stat-icon-box bg-warning bg-opacity-10 text-warning">
								<i class="bi bi-tags"></i>
							</div>
							<div>
								<div class="text-muted small fw-medium">FAQ Categories</div>
								<div class="fs-4 fw-bold text-dark">{{ $stats['categories'] }}</div>
							</div>
						</div>
					</div>
				</div>

				{{-- Filter Bar --}}
				<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
					<div class="card-body p-3">
						<form action="{{ route('admin.faqs.index') }}" method="GET" class="row g-2 align-items-center">
							<div class="col-md-6 col-lg-7">
								<div class="input-group">
									<span class="input-group-text bg-light border-0"><i class="bi bi-search text-muted"></i></span>
									<input type="text" name="search" class="form-control bg-light border-0" placeholder="Search questions or keywords..." value="{{ request('search') }}">
								</div>
							</div>
							<div class="col-md-4 col-lg-3">
								<select name="category" class="form-select bg-light border-0" onchange="this.form.submit()">
									<option value="">All Categories</option>
									<option value="general" {{ request('category') === 'general' ? 'selected' : '' }}>General &amp; Platform</option>
									<option value="selfie_bundles" {{ request('category') === 'selfie_bundles' ? 'selected' : '' }}>Selfie / Athlete Bundles</option>
									<option value="licenses" {{ request('category') === 'licenses' ? 'selected' : '' }}>Licenses &amp; Rights</option>
									<option value="orders" {{ request('category') === 'orders' ? 'selected' : '' }}>Orders &amp; Downloads</option>
									<option value="photographers" {{ request('category') === 'photographers' ? 'selected' : '' }}>Photographers</option>
								</select>
							</div>
							<div class="col-md-2 col-lg-2 d-flex gap-2">
								<button type="submit" class="btn btn-secondary flex-grow-1 rounded-pill">Filter</button>
								@if(request()->filled('search') || request()->filled('category'))
									<a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary rounded-pill" title="Clear Filters"><i class="bi bi-x-lg"></i></a>
								@endif
							</div>
						</form>
					</div>
				</div>

				{{-- FAQ List Table --}}
				<div class="card border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
					<div class="table-responsive">
						<table class="table align-middle table-hover mb-0">
							<thead class="table-light">
								<tr>
									<th style="width: 70px;" class="text-center">Order</th>
									<th>Question &amp; Answer</th>
									<th style="width: 170px;">Category</th>
									<th style="width: 120px;" class="text-center">Status</th>
									<th style="width: 140px;" class="text-end pe-4">Actions</th>
								</tr>
							</thead>
							<tbody>
								@forelse($faqs as $faq)
									<tr>
										<td class="text-center">
											<span class="badge bg-light text-dark border px-2 py-1 font-monospace">#{{ $faq->order }}</span>
										</td>
										<td>
											<div class="faq-question-title">{{ $faq->question }}</div>
											<div class="faq-answer-snippet">{{ $faq->answer }}</div>
										</td>
										<td>
											@php
												$catClass = match($faq->category) {
													'general' => 'cat-general',
													'selfie_bundles' => 'cat-selfie_bundles',
													'licenses' => 'cat-licenses',
													'orders' => 'cat-orders',
													'photographers' => 'cat-photographers',
													default => 'bg-secondary bg-opacity-10 text-secondary'
												};
												$catLabel = match($faq->category) {
													'general' => 'General',
													'selfie_bundles' => 'Selfie Bundle',
													'licenses' => 'Licenses',
													'orders' => 'Orders &amp; Downloads',
													'photographers' => 'Photographers',
													default => ucfirst(str_replace('_', ' ', $faq->category))
												};
											@endphp
											<span class="faq-cat-badge {{ $catClass }}">{!! $catLabel !!}</span>
										</td>
										<td class="text-center">
											<form action="{{ route('admin.faqs.toggle', $faq->id) }}" method="POST" class="d-inline">
												@csrf
												<button type="submit" class="badge rounded-pill border-0 px-3 py-2 text-decoration-none {{ $faq->is_active ? 'bg-success bg-opacity-10 text-success' : 'bg-danger bg-opacity-10 text-danger' }}" style="cursor: pointer;" title="Click to toggle status">
													<i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>
													{{ $faq->is_active ? 'Active' : 'Draft' }}
												</button>
											</form>
										</td>
										<td class="text-end pe-4">
											<button class="btn btn-sm btn-outline-primary rounded-pill px-3 me-1 edit-faq-btn"
												data-id="{{ $faq->id }}"
												data-question="{{ $faq->question }}"
												data-answer="{{ $faq->answer }}"
												data-category="{{ $faq->category }}"
												data-order="{{ $faq->order }}"
												data-is-active="{{ $faq->is_active ? '1' : '0' }}">
												<i class="bi bi-pencil-square me-1"></i> Edit
											</button>
											<button class="btn btn-sm btn-outline-danger rounded-pill px-2 delete-faq-btn"
												data-id="{{ $faq->id }}"
												data-question="{{ $faq->question }}">
												<i class="bi bi-trash"></i>
											</button>
										</td>
									</tr>
								@empty
									<tr>
										<td colspan="5" class="text-center py-5">
											<div class="text-muted mb-3"><i class="bi bi-question-circle" style="font-size: 3rem;"></i></div>
											<h5 class="fw-bold">No FAQs found</h5>
											<p class="text-muted mb-3">Add questions to guide customers and photographers on the About page.</p>
											<button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#createFaqModal">
												<i class="bi bi-plus-lg me-1"></i> Add First FAQ
											</button>
										</td>
									</tr>
								@endforelse
							</tbody>
						</table>
					</div>

					@if($faqs->hasPages())
						<div class="p-3 border-top">
							{{ $faqs->links() }}
						</div>
					@endif
				</div>
			</main>
		</div>
	</div>

	{{-- Create FAQ Modal --}}
	<div class="modal fade" id="createFaqModal" tabindex="-1" aria-labelledby="createFaqModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
				<div class="modal-header border-0 pb-0 pt-4 px-4">
					<h5 class="modal-title fw-bold" id="createFaqModalLabel"><i class="bi bi-plus-circle text-primary me-2"></i>Add New FAQ</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{ route('admin.faqs.store') }}" method="POST">
					@csrf
					<div class="modal-body p-4">
						<div class="mb-3">
							<label class="form-label fw-semibold text-dark">Question <span class="text-danger">*</span></label>
							<input type="text" name="question" class="form-control" placeholder="e.g. How does the Selfie / Athlete Bundle work?" required>
						</div>

						<div class="row g-3 mb-3">
							<div class="col-md-6">
								<label class="form-label fw-semibold text-dark">Category <span class="text-danger">*</span></label>
								<select name="category" class="form-select" required>
									<option value="general">General &amp; Platform</option>
									<option value="selfie_bundles">Selfie / Athlete Bundles</option>
									<option value="licenses">Licenses &amp; Rights</option>
									<option value="orders">Orders &amp; Downloads</option>
									<option value="photographers">Photographers</option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="form-label fw-semibold text-dark">Display Order</label>
								<input type="number" name="order" class="form-control" placeholder="e.g. 1 (auto-increments if empty)">
							</div>
						</div>

						<div class="mb-3">
							<label class="form-label fw-semibold text-dark">Answer <span class="text-danger">*</span></label>
							<textarea name="answer" rows="5" class="form-control" placeholder="Provide a detailed, helpful answer..." required></textarea>
						</div>

						<div class="form-check form-switch mt-3">
							<input class="form-check-input" type="checkbox" role="switch" id="createIsActive" name="is_active" value="1" checked>
							<label class="form-check-label fw-medium text-dark" for="createIsActive">Publish immediately on website</label>
						</div>
					</div>
					<div class="modal-footer border-0 pt-0 pb-4 px-4">
						<button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold"><i class="bi bi-check-lg me-1"></i> Save FAQ</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	{{-- Edit FAQ Modal --}}
	<div class="modal fade" id="editFaqModal" tabindex="-1" aria-labelledby="editFaqModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
				<div class="modal-header border-0 pb-0 pt-4 px-4">
					<h5 class="modal-title fw-bold" id="editFaqModalLabel"><i class="bi bi-pencil-square text-primary me-2"></i>Edit FAQ</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form id="editFaqForm" method="POST">
					@csrf
					@method('PUT')
					<div class="modal-body p-4">
						<div class="mb-3">
							<label class="form-label fw-semibold text-dark">Question <span class="text-danger">*</span></label>
							<input type="text" name="question" id="editQuestion" class="form-control" required>
						</div>

						<div class="row g-3 mb-3">
							<div class="col-md-6">
								<label class="form-label fw-semibold text-dark">Category <span class="text-danger">*</span></label>
								<select name="category" id="editCategory" class="form-select" required>
									<option value="general">General &amp; Platform</option>
									<option value="selfie_bundles">Selfie / Athlete Bundles</option>
									<option value="licenses">Licenses &amp; Rights</option>
									<option value="orders">Orders &amp; Downloads</option>
									<option value="photographers">Photographers</option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="form-label fw-semibold text-dark">Display Order</label>
								<input type="number" name="order" id="editOrder" class="form-control">
							</div>
						</div>

						<div class="mb-3">
							<label class="form-label fw-semibold text-dark">Answer <span class="text-danger">*</span></label>
							<textarea name="answer" id="editAnswer" rows="5" class="form-control" required></textarea>
						</div>

						<div class="form-check form-switch mt-3">
							<input class="form-check-input" type="checkbox" role="switch" id="editIsActive" name="is_active" value="1">
							<label class="form-check-label fw-medium text-dark" for="editIsActive">Active &amp; visible on website</label>
						</div>
					</div>
					<div class="modal-footer border-0 pt-0 pb-4 px-4">
						<button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold"><i class="bi bi-check-lg me-1"></i> Update FAQ</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	{{-- Delete FAQ Modal --}}
	<div class="modal fade" id="deleteFaqModal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-sm">
			<div class="modal-content border-0 shadow-lg text-center p-3" style="border-radius: 16px;">
				<div class="modal-body">
					<div class="text-danger mb-3"><i class="bi bi-exclamation-circle" style="font-size: 2.5rem;"></i></div>
					<h5 class="fw-bold mb-2">Delete this FAQ?</h5>
					<p class="text-muted small mb-4" id="deleteFaqQuestionText"></p>
					<form id="deleteFaqForm" method="POST">
						@csrf
						@method('DELETE')
						<div class="d-flex gap-2 justify-content-center">
							<button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-danger rounded-pill px-3">Yes, Delete</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			// Edit Modal Handling
			const editModal = new bootstrap.Modal(document.getElementById('editFaqModal'));
			document.querySelectorAll('.edit-faq-btn').forEach(button => {
				button.addEventListener('click', function () {
					const id = this.getAttribute('data-id');
					document.getElementById('editFaqForm').action = `/admin/faqs/${id}`;
					document.getElementById('editQuestion').value = this.getAttribute('data-question');
					document.getElementById('editAnswer').value = this.getAttribute('data-answer');
					document.getElementById('editCategory').value = this.getAttribute('data-category');
					document.getElementById('editOrder').value = this.getAttribute('data-order');
					document.getElementById('editIsActive').checked = this.getAttribute('data-is-active') === '1';
					editModal.show();
				});
			});

			// Delete Modal Handling
			const deleteModal = new bootstrap.Modal(document.getElementById('deleteFaqModal'));
			document.querySelectorAll('.delete-faq-btn').forEach(button => {
				button.addEventListener('click', function () {
					const id = this.getAttribute('data-id');
					const question = this.getAttribute('data-question');
					document.getElementById('deleteFaqForm').action = `/admin/faqs/${id}`;
					document.getElementById('deleteFaqQuestionText').textContent = question;
					deleteModal.show();
				});
			});
		});
	</script>
</body>
</html>
