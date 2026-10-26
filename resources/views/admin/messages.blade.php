<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <title>PhotoX Admin | Contact Enquiries &amp; Messages</title>
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
            <span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><strong>Contact Enquiries</strong>
          </div>
        </div>
        <div class="topbar-actions">
          <a class="btn btn-sm btn-outline-secondary rounded-pill px-3" href="/contact" target="_blank"><i class="bi bi-box-arrow-up-right me-1"></i> View Live Form</a>
          <div class="topbar-divider"></div>
          <div class="profile-menu-wrap">
            <button class="profile-button" type="button"><span class="profile-avatar">AD</span><span class="profile-copy"><strong>Admin</strong><small>Administrator</small></span></button>
          </div>
        </div>
      </header>

      <main class="content-area module-page ops-page">
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <div class="page-intro d-flex align-items-end justify-content-between gap-3 flex-wrap">
          <div>
            <p class="eyebrow">Customer &amp; Partner Inquiries</p>
            <h1>Contact Messages</h1>
            <p class="intro-copy">Manage messages, general enquiries, photographer questions and partner leads sent through the website.</p>
          </div>
        </div>

        <section class="row g-3 mb-4">
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon"><i class="bi bi-envelope"></i></span>
              </div>
              <p>Total Enquiries</p>
              <h2>{{ number_format($stats['total']) }}</h2>
              <small>All time submissions</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="background: rgba(239, 68, 68, 0.15); color: #ef4444;"><i class="bi bi-envelope-exclamation"></i></span>
                <span class="trend" style="color: #ef4444; background: rgba(239, 68, 68, 0.1);">Action needed</span>
              </div>
              <p>Unread Messages</p>
              <h2>{{ number_format($stats['unread']) }}</h2>
              <small>Awaiting response</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="background: rgba(34, 197, 94, 0.15); color: #22c55e;"><i class="bi bi-envelope-check"></i></span>
              </div>
              <p>Reviewed</p>
              <h2>{{ number_format($stats['read']) }}</h2>
              <small>Marked as read</small>
            </article>
          </div>
          <div class="col-xl-3 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="background: rgba(59, 130, 246, 0.15); color: #3b82f6;"><i class="bi bi-reply-all"></i></span>
              </div>
              <p>Replied</p>
              <h2>{{ number_format($stats['replied']) }}</h2>
              <small>Resolved cases</small>
            </article>
          </div>
        </section>

        <section class="ops-table-panel">
          <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
            <div>
              <p class="eyebrow">Direct Inbox</p>
              <h3>All Submissions</h3>
            </div>
            <form method="GET" action="{{ route('admin.messages.index') }}" class="d-flex align-items-center gap-2 flex-wrap">
              <div class="search-field" style="max-width: 280px;">
                <i class="bi bi-search"></i>
                <input name="search" value="{{ request('search') }}" aria-label="Search messages" placeholder="Search sender, email, subject..." type="search">
              </div>
              <select name="status" class="management-select" onchange="this.form.submit()">
                <option value="">All statuses</option>
                <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Unread</option>
                <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
              </select>
              <select name="role" class="management-select" onchange="this.form.submit()">
                <option value="">All roles</option>
                <option value="Customer" {{ request('role') === 'Customer' ? 'selected' : '' }}>Customer</option>
                <option value="Photographer" {{ request('role') === 'Photographer' ? 'selected' : '' }}>Photographer</option>
                <option value="Event organiser" {{ request('role') === 'Event organiser' ? 'selected' : '' }}>Event organiser</option>
                <option value="School or club" {{ request('role') === 'School or club' ? 'selected' : '' }}>School or club</option>
                <option value="Sponsor" {{ request('role') === 'Sponsor' ? 'selected' : '' }}>Sponsor</option>
              </select>
              @if(request()->anyFilled(['search', 'status', 'role']))
                <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">Clear</a>
              @endif
            </form>
          </div>

          <div class="ops-table-wrap">
            <table class="table ops-table">
              <thead>
                <tr>
                  <th>Sender</th>
                  <th>Role</th>
                  <th>Subject</th>
                  <th>Message Preview</th>
                  <th>Date &amp; Time</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($messages as $msg)
                  <tr style="{{ $msg->status === 'unread' ? 'background: rgba(14, 165, 233, 0.04); font-weight: 500;' : '' }}">
                    <td>
                      <div class="ops-person">
                        <span class="ops-avatar" style="{{ $msg->status === 'unread' ? 'background: #0ea5e9; color: #fff;' : '' }}">
                          {{ strtoupper(substr($msg->name, 0, 2)) }}
                        </span>
                        <span>
                          <strong>{{ $msg->name }}</strong>
                          <small><a href="mailto:{{ $msg->email }}" class="text-muted text-decoration-none">{{ $msg->email }}</a></small>
                        </span>
                      </div>
                    </td>
                    <td>
                      <span class="badge rounded-pill bg-light text-dark border px-2 py-1">{{ $msg->role ?? 'General' }}</span>
                    </td>
                    <td>
                      <strong>{{ $msg->subject ?: 'Enquiry' }}</strong>
                    </td>
                    <td style="max-width: 260px;">
                      <span class="text-truncate d-inline-block" style="max-width: 250px;">{{ $msg->message }}</span>
                    </td>
                    <td>
                      <small class="text-muted">{{ $msg->created_at->format('d M Y · h:i A') }}</small>
                    </td>
                    <td>
                      @if($msg->status === 'unread')
                        <span class="ops-pill red"><i class="bi bi-circle-fill" style="font-size: 6px;"></i> Unread</span>
                      @else
                        <span class="ops-pill green"><i class="bi bi-check-circle"></i> Read</span>
                      @endif
                    </td>
                    <td>
                      <div class="ops-actions">
                        <button type="button" class="row-action view-btn" 
                                data-id="{{ $msg->id }}"
                                data-name="{{ $msg->name }}"
                                data-email="{{ $msg->email }}"
                                data-role="{{ $msg->role ?? 'Customer' }}"
                                data-subject="{{ $msg->subject ?? 'General Enquiry' }}"
                                data-date="{{ $msg->created_at->format('d M Y, h:i A') }}"
                                data-message="{{ $msg->message }}"
                                title="View Enquiry Details">
                          <i class="bi bi-eye"></i>
                        </button>
                        
                        <form action="{{ route('admin.messages.toggle', $msg->id) }}" method="POST" class="d-inline">
                          @csrf
                          <button type="submit" class="row-action" title="{{ $msg->status === 'unread' ? 'Mark as read' : 'Mark as unread' }}">
                            <i class="bi {{ $msg->status === 'unread' ? 'bi-check2' : 'bi-envelope' }}"></i>
                          </button>
                        </form>

                        <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this message?');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="row-action text-danger" title="Delete message">
                            <i class="bi bi-trash"></i>
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="7" class="text-center py-5">
                      <div class="text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fs-6">No contact enquiries found.</p>
                      </div>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div class="mt-3">
            {{ $messages->links() }}
          </div>
        </section>
      </main>
    </div>
  </div>

  <!-- View Message Modal -->
  <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content" style="border-radius: 16px; border: 1px solid #e2e8f0;">
        <div class="modal-header border-bottom px-4 py-3">
          <h5 class="modal-title fw-bold" id="messageModalLabel"><i class="bi bi-envelope-open me-2 text-primary"></i> Contact Enquiry Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body px-4 py-4">
          <div class="row g-3 mb-3 pb-3 border-bottom">
            <div class="col-sm-6">
              <small class="text-muted d-block">Sender Name</small>
              <strong id="modalSenderName" class="fs-6">-</strong>
            </div>
            <div class="col-sm-6">
              <small class="text-muted d-block">Sender Email</small>
              <span id="modalSenderEmail" class="fw-medium">-</span>
            </div>
            <div class="col-sm-6">
              <small class="text-muted d-block">Role / Type</small>
              <span id="modalSenderRole" class="badge rounded-pill bg-light text-dark border px-2 py-1">-</span>
            </div>
            <div class="col-sm-6">
              <small class="text-muted d-block">Received Date</small>
              <span id="modalDate" class="text-muted">-</span>
            </div>
          </div>
          <div class="mb-3">
            <small class="text-muted d-block">Subject</small>
            <h6 id="modalSubject" class="fw-bold mt-1">-</h6>
          </div>
          <div>
            <small class="text-muted d-block mb-1">Message Content</small>
            <div id="modalMessageText" class="p-3 bg-light rounded-3 text-secondary" style="white-space: pre-wrap; font-size: 0.95rem; line-height: 1.6; border: 1px solid #edf2f7;">
              -
            </div>
          </div>
        </div>
        <div class="modal-footer border-top px-4 py-3 d-flex justify-content-between">
          <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
          <a id="modalReplyBtn" href="#" class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-reply-fill me-1"></i> Reply via Email
          </a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const modal = new bootstrap.Modal(document.getElementById('messageModal'));
      document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          const id = this.getAttribute('data-id');
          const name = this.getAttribute('data-name');
          const email = this.getAttribute('data-email');
          const role = this.getAttribute('data-role');
          const subject = this.getAttribute('data-subject');
          const date = this.getAttribute('data-date');
          const msg = this.getAttribute('data-message');

          document.getElementById('modalSenderName').textContent = name;
          document.getElementById('modalSenderEmail').textContent = email;
          document.getElementById('modalSenderRole').textContent = role;
          document.getElementById('modalDate').textContent = date;
          document.getElementById('modalSubject').textContent = subject;
          document.getElementById('modalMessageText').textContent = msg;
          document.getElementById('modalReplyBtn').href = `mailto:${email}?subject=Re: ${encodeURIComponent(subject)}`;

          // Mark as read in background
          fetch(`/admin/messages/${id}`)
            .then(res => res.json())
            .catch(e => console.error(e));

          modal.show();
        });
      });
    });
  </script>
</body>
</html>
