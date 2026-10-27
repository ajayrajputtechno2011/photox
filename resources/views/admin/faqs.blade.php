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
    /* Table Responsive & Text Auto-wrap */
    .ops-table-wrap {
      overflow-x: visible !important;
      width: 100% !important;
    }
    .faq-table {
      width: 100% !important;
      min-width: 100% !important;
      max-width: 100% !important;
      table-layout: fixed !important;
      margin: 0 !important;
    }
    .faq-table th,
    .faq-table td {
      white-space: normal !important;
      word-break: break-word !important;
      overflow-wrap: break-word !important;
      vertical-align: top !important;
    }
    .faq-table th {
      white-space: nowrap !important;
      padding: 12px 10px !important;
      font-size: 0.75rem !important;
      letter-spacing: 0.05em !important;
      text-transform: uppercase !important;
      color: #94a3b8 !important;
    }
    .faq-table td {
      padding: 16px 10px !important;
      border-color: rgba(255, 255, 255, 0.08) !important;
    }
    .faq-title {
      color: #ffffff !important;
      font-weight: 700 !important;
      font-size: 0.98rem !important;
      margin-bottom: 0.45rem !important;
      white-space: normal !important;
      word-break: break-word !important;
      line-height: 1.4 !important;
    }
    .faq-snippet {
      color: #cbd5e1 !important;
      font-size: 0.88rem !important;
      line-height: 1.6 !important;
      white-space: normal !important;
      word-break: break-word !important;
      display: block !important;
    }
    .faq-cat-badge {
      font-size: 0.72rem;
      font-weight: 700;
      padding: 0.35rem 0.65rem;
      border-radius: 999px;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      display: inline-block;
      white-space: nowrap;
    }
    .cat-general { background: rgba(56, 189, 248, 0.15); color: #38bdf8; border: 1px solid rgba(56, 189, 248, 0.3); }
    .cat-selfie_bundles { background: rgba(251, 191, 36, 0.15); color: #fbbf24; border: 1px solid rgba(251, 191, 36, 0.3); }
    .cat-licenses { background: rgba(167, 139, 250, 0.15); color: #c084fc; border: 1px solid rgba(167, 139, 250, 0.3); }
    .cat-orders { background: rgba(52, 211, 153, 0.15); color: #34d399; border: 1px solid rgba(52, 211, 153, 0.3); }
    .cat-photographers { background: rgba(248, 113, 113, 0.15); color: #f87171; border: 1px solid rgba(248, 113, 113, 0.3); }

    .ops-table-panel select.form-select-sm,
    .ops-table-panel select.management-select {
      background-color: #101e2c;
      border-color: #26384a;
      color: #e7eef7;
      border-radius: 8px;
      padding: 0.45rem 1rem;
    }

    /* Clean Modal Overrides (White Card with Dark Text for Highest Legibility) */
    .modal-content {
      background: #ffffff !important;
      color: #0f172a !important;
      border-radius: 16px !important;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important;
      border: 1px solid #e2e8f0 !important;
    }
    .modal-content .modal-title {
      color: #0f172a !important;
      font-weight: 700;
    }
    .modal-content .form-label {
      color: #1e293b !important;
      font-weight: 600;
      font-size: 0.9rem;
    }
    .modal-content .form-check-label {
      color: #0f172a !important;
    }
    .modal-content .form-control,
    .modal-content .form-select {
      background: #f8fafc !important;
      border: 1px solid #cbd5e1 !important;
      color: #0f172a !important;
      font-size: 0.95rem;
    }
    .modal-content .form-control:focus,
    .modal-content .form-select:focus {
      background: #ffffff !important;
      border-color: #0284c7 !important;
      color: #0f172a !important;
      box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15) !important;
    }
    .modal-content .form-text {
      color: #64748b !important;
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
            <span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><strong>FAQs Management</strong>
          </div>
        </div>
        <div class="topbar-actions d-flex align-items-center gap-3">
          <a href="{{ url('/about') }}#faqs" target="_blank" class="btn btn-outline-light btn-sm rounded-pill px-3">
            <i class="bi bi-box-arrow-up-right me-1"></i> Preview on About Page
          </a>
          <div class="profile-menu-wrap">
            <button class="profile-button" type="button" aria-haspopup="true" aria-expanded="false">
              <span class="profile-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'AD', 0, 2)) }}</span>
              <span class="profile-copy"><strong>{{ Auth::user()->name ?? 'Admin' }}</strong><small>Administrator</small></span>
              <i class="bi bi-chevron-down"></i>
            </button>
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

      <main class="content-body">
        {{-- Alert Messages --}}
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if($errors->any())
          <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        {{-- Page Intro --}}
        <div class="page-intro d-flex align-items-end justify-content-between gap-3 flex-wrap mb-4">
          <div>
            <p class="eyebrow">Content &amp; Help Center</p>
            <h1>Frequently Asked Questions</h1>
            <p class="intro-copy">Manage questions and answers displayed dynamically in the About page accordion.</p>
          </div>
          <button class="btn btn-primary rounded-pill px-4 fw-semibold" data-bs-toggle="modal" data-bs-target="#createFaqModal">
            <i class="bi bi-plus-lg me-1"></i> Add New FAQ
          </button>
        </div>

        {{-- Stats Row --}}
        <section class="row g-3 mb-4">
          <div class="col-xl-4 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon text-primary"><i class="bi bi-question-circle"></i></span>
              </div>
              <p>Total Questions</p>
              <h2>{{ $stats['total'] }}</h2>
              <small>Configured FAQ items</small>
            </article>
          </div>
          <div class="col-xl-4 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon text-success"><i class="bi bi-check2-circle"></i></span>
              </div>
              <p>Active (Published)</p>
              <h2>{{ $stats['active'] }}</h2>
              <small>Visible on public About page</small>
            </article>
          </div>
          <div class="col-xl-4 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon text-warning"><i class="bi bi-tags"></i></span>
              </div>
              <p>FAQ Categories</p>
              <h2>{{ $stats['categories'] }}</h2>
              <small>Topic groupings</small>
            </article>
          </div>
        </section>

        {{-- Table Panel --}}
        <section class="ops-table-panel">
          <div class="d-flex align-items-start justify-content-between gap-3 mb-3">
            <div>
              <p class="eyebrow">Website Content</p>
              <h3>All Questions &amp; Answers</h3>
            </div>
          </div>

          {{-- Filter Toolbar --}}
          <form method="GET" action="{{ route('admin.faqs.index') }}" class="ops-toolbar mb-3">
            <div class="search-field">
              <i class="bi bi-search"></i>
              <input name="search" value="{{ request('search') }}" aria-label="Search FAQs" placeholder="Search questions or keywords..." type="search">
            </div>
            <select name="category" class="management-select" onchange="this.form.submit()">
              <option value="">All Categories</option>
              <option value="general" {{ request('category') === 'general' ? 'selected' : '' }}>General &amp; Platform</option>
              <option value="selfie_bundles" {{ request('category') === 'selfie_bundles' ? 'selected' : '' }}>Selfie / Athlete Bundles</option>
              <option value="licenses" {{ request('category') === 'licenses' ? 'selected' : '' }}>Licenses &amp; Rights</option>
              <option value="orders" {{ request('category') === 'orders' ? 'selected' : '' }}>Orders &amp; Downloads</option>
              <option value="photographers" {{ request('category') === 'photographers' ? 'selected' : '' }}>Photographers</option>
            </select>
            @if(request()->hasAny(['search', 'category']))
              <a href="{{ route('admin.faqs.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            @endif
          </form>

          {{-- Table --}}
          <div class="ops-table-wrap">
            <table class="table ops-table faq-table">
              <thead>
                <tr>
                  <th style="width: 55px;" class="text-center">#</th>
                  <th style="width: 50%;">Question &amp; Answer</th>
                  <th style="width: 15%;">Category</th>
                  <th style="width: 14%;" class="text-center">Status</th>
                  <th style="width: 16%;" class="text-end pe-2">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($faqs as $faq)
                  <tr>
                    <td class="text-center">
                      <span class="badge bg-dark border border-secondary text-light font-monospace px-2 py-1">#{{ $faq->order }}</span>
                    </td>
                    <td>
                      <div class="faq-title">{{ $faq->question }}</div>
                      <div class="faq-snippet">{{ $faq->answer }}</div>
                    </td>
                    <td>
                      @php
                        $catClass = match($faq->category) {
                          'general' => 'cat-general',
                          'selfie_bundles' => 'cat-selfie_bundles',
                          'licenses' => 'cat-licenses',
                          'orders' => 'cat-orders',
                          'photographers' => 'cat-photographers',
                          default => 'cat-general'
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
                        <button type="submit" class="border-0 bg-transparent p-0" title="Click to toggle status" style="cursor: pointer;">
                          @if($faq->is_active)
                            <span class="ops-pill blue"><i class="bi bi-circle-fill me-1" style="font-size: 0.45rem;"></i>Active</span>
                          @else
                            <span class="ops-pill orange"><i class="bi bi-circle-fill me-1" style="font-size: 0.45rem;"></i>Draft</span>
                          @endif
                        </button>
                      </form>
                    </td>
                    <td class="text-end pe-2 text-nowrap">
                      <div class="d-inline-flex align-items-center gap-1 justify-content-end">
                        <button class="btn btn-sm btn-outline-light rounded-pill px-3 edit-faq-btn"
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
                          data-question="{{ $faq->question }}"
                          title="Delete FAQ">
                          <i class="bi bi-trash"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="text-center py-5">
                      <div class="text-muted mb-3"><i class="bi bi-question-circle" style="font-size: 3rem;"></i></div>
                      <h5 class="fw-bold text-white">No FAQs found</h5>
                      <p class="text-muted mb-3">Add questions to guide customers and athletes on the About page.</p>
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
            <div class="p-3 border-top border-secondary border-opacity-25">
              {{ $faqs->links() }}
            </div>
          @endif
        </section>
      </main>
    </div>
  </div>

  {{-- Create FAQ Modal --}}
  <div class="modal fade" id="createFaqModal" tabindex="-1" aria-labelledby="createFaqModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header border-0 pb-0 pt-4 px-4">
          <h5 class="modal-title" id="createFaqModalLabel"><i class="bi bi-plus-circle text-primary me-2"></i>Add New FAQ</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.faqs.store') }}" method="POST">
          @csrf
          <div class="modal-body p-4">
            <div class="mb-3">
              <label class="form-label">Question <span class="text-danger">*</span></label>
              <input type="text" name="question" class="form-control" placeholder="e.g. How does the Selfie / Athlete Bundle work?" required>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label">Category <span class="text-danger">*</span></label>
                <select name="category" class="form-select" required>
                  <option value="general">General &amp; Platform</option>
                  <option value="selfie_bundles">Selfie / Athlete Bundles</option>
                  <option value="licenses">Licenses &amp; Rights</option>
                  <option value="orders">Orders &amp; Downloads</option>
                  <option value="photographers">Photographers</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Display Order</label>
                <input type="number" name="order" class="form-control" placeholder="e.g. 1 (auto-calculated if empty)">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Answer <span class="text-danger">*</span></label>
              <textarea name="answer" rows="5" class="form-control" placeholder="Provide a detailed, helpful answer..." required></textarea>
            </div>

            <div class="form-check form-switch mt-3">
              <input class="form-check-input" type="checkbox" role="switch" id="createIsActive" name="is_active" value="1" checked>
              <label class="form-check-label fw-medium" for="createIsActive">Publish immediately on website</label>
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
      <div class="modal-content">
        <div class="modal-header border-0 pb-0 pt-4 px-4">
          <h5 class="modal-title" id="editFaqModalLabel"><i class="bi bi-pencil-square text-primary me-2"></i>Edit FAQ</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="editFaqForm" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-body p-4">
            <div class="mb-3">
              <label class="form-label">Question <span class="text-danger">*</span></label>
              <input type="text" name="question" id="editQuestion" class="form-control" required>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label">Category <span class="text-danger">*</span></label>
                <select name="category" id="editCategory" class="form-select" required>
                  <option value="general">General &amp; Platform</option>
                  <option value="selfie_bundles">Selfie / Athlete Bundles</option>
                  <option value="licenses">Licenses &amp; Rights</option>
                  <option value="orders">Orders &amp; Downloads</option>
                  <option value="photographers">Photographers</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Display Order</label>
                <input type="number" name="order" id="editOrder" class="form-control">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Answer <span class="text-danger">*</span></label>
              <textarea name="answer" id="editAnswer" rows="5" class="form-control" required></textarea>
            </div>

            <div class="form-check form-switch mt-3">
              <input class="form-check-input" type="checkbox" role="switch" id="editIsActive" name="is_active" value="1">
              <label class="form-check-label fw-medium" for="editIsActive">Active &amp; visible on website</label>
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
      <div class="modal-content text-center p-3">
        <div class="modal-body">
          <div class="text-danger mb-3"><i class="bi bi-exclamation-circle" style="font-size: 2.5rem;"></i></div>
          <h5 class="modal-title mb-2">Delete this FAQ?</h5>
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
