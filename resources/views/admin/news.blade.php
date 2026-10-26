<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <title>PhotoX Admin | News &amp; Articles</title>
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
            <span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><strong>News &amp; Journal Articles</strong>
          </div>
        </div>
        <div class="topbar-actions">
          <a class="btn btn-sm btn-outline-secondary rounded-pill px-3" href="/news" target="_blank"><i class="bi bi-box-arrow-up-right me-1"></i> View Live News</a>
          <button class="btn btn-sm btn-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#createArticleModal">
            <i class="bi bi-plus-lg me-1"></i> New Article
          </button>
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
            <p class="eyebrow">Content &amp; Editorial</p>
            <h1>News &amp; Articles</h1>
            <p class="intro-copy">Publish and manage news stories, photography techniques, school features and editorial highlights.</p>
          </div>
        </div>

        <section class="row g-3 mb-4">
          <div class="col-xl-4 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon"><i class="bi bi-newspaper"></i></span>
              </div>
              <p>Total Articles</p>
              <h2>{{ number_format($stats['total']) }}</h2>
              <small>All stories in database</small>
            </article>
          </div>
          <div class="col-xl-4 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="background: rgba(34, 197, 94, 0.15); color: #22c55e;"><i class="bi bi-check2-circle"></i></span>
              </div>
              <p>Published Stories</p>
              <h2>{{ number_format($stats['published']) }}</h2>
              <small>Live on /news</small>
            </article>
          </div>
          <div class="col-xl-4 col-md-6">
            <article class="ops-stat">
              <div class="ops-stat-top">
                <span class="ops-stat-icon" style="background: rgba(204, 255, 0, 0.2); color: #166534;"><i class="bi bi-star-fill"></i></span>
              </div>
              <p>Featured Stories</p>
              <h2>{{ number_format($stats['featured']) }}</h2>
              <small>Hero banner placement</small>
            </article>
          </div>
        </section>

        <section class="ops-table-panel">
          <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
            <div>
              <p class="eyebrow">Article Directory</p>
              <h3>All Stories</h3>
            </div>
            <form method="GET" action="{{ route('admin.news.index') }}" class="d-flex align-items-center gap-2 flex-wrap">
              <div class="search-field" style="max-width: 280px;">
                <i class="bi bi-search"></i>
                <input name="search" value="{{ request('search') }}" aria-label="Search articles" placeholder="Search title or category..." type="search">
              </div>
              <select name="category" class="management-select" onchange="this.form.submit()">
                <option value="">All categories</option>
                <option value="Editorial" {{ request('category') === 'Editorial' ? 'selected' : '' }}>Editorial</option>
                <option value="Community" {{ request('category') === 'Community' ? 'selected' : '' }}>Community</option>
                <option value="Marketing" {{ request('category') === 'Marketing' ? 'selected' : '' }}>Marketing</option>
                <option value="Photography" {{ request('category') === 'Photography' ? 'selected' : '' }}>Photography</option>
                <option value="Legal" {{ request('category') === 'Legal' ? 'selected' : '' }}>Legal</option>
              </select>
            </form>
          </div>

          <div class="ops-table-wrap">
            <table class="table ops-table">
              <thead>
                <tr>
                  <th>Cover</th>
                  <th>Title &amp; Excerpt</th>
                  <th>Category</th>
                  <th>Author</th>
                  <th>Read Time</th>
                  <th>Published</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($articles as $art)
                  <tr>
                    <td style="width: 80px;">
                      <img src="{{ $art->image_url ?: 'https://images.unsplash.com/photo-1517466787929-bc90951d0974?auto=format&fit=crop&w=200&q=80' }}" alt="{{ $art->title }}" class="rounded-3" style="width: 70px; height: 50px; object-fit: cover;">
                    </td>
                    <td>
                      <strong>{{ $art->title }}</strong>
                      @if($art->is_featured)
                        <span class="badge bg-warning text-dark ms-1 small">Featured</span>
                      @endif
                      <br>
                      <small class="text-muted">{{ Str::limit($art->summary, 80) }}</small>
                    </td>
                    <td>
                      <span class="badge rounded-pill bg-light text-dark border px-2 py-1">{{ $art->category }}</span>
                    </td>
                    <td>{{ $art->author_name }}</td>
                    <td><small class="text-muted">{{ $art->read_time }}</small></td>
                    <td><small class="text-muted">{{ $art->published_at ? $art->published_at->format('d M Y') : 'Draft' }}</small></td>
                    <td>
                      @if($art->is_published)
                        <span class="ops-pill green"><i class="bi bi-check-circle"></i> Live</span>
                      @else
                        <span class="ops-pill gray">Draft</span>
                      @endif
                    </td>
                    <td>
                      <div class="ops-actions">
                        <a href="{{ route('news.show', $art->slug) }}" target="_blank" class="row-action" title="View on site"><i class="bi bi-eye"></i></a>
                        
                        <button type="button" class="row-action edit-article-btn" 
                                data-id="{{ $art->id }}"
                                data-title="{{ $art->title }}"
                                data-category="{{ $art->category }}"
                                data-readtime="{{ $art->read_time }}"
                                data-author="{{ $art->author_name }}"
                                data-image="{{ $art->image_url }}"
                                data-summary="{{ $art->summary }}"
                                data-content="{{ $art->content }}"
                                data-featured="{{ $art->is_featured ? '1' : '0' }}"
                                title="Edit article">
                          <i class="bi bi-pencil"></i>
                        </button>

                        <form action="{{ route('admin.news.toggle', $art->id) }}" method="POST" class="d-inline">
                          @csrf
                          <button type="submit" class="row-action" title="{{ $art->is_published ? 'Unpublish' : 'Publish' }}">
                            <i class="bi {{ $art->is_published ? 'bi-toggle-on text-success' : 'bi-toggle-off text-muted' }}"></i>
                          </button>
                        </form>

                        <form action="{{ route('admin.news.destroy', $art->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this article?');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="row-action text-danger" title="Delete article">
                            <i class="bi bi-trash"></i>
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="8" class="text-center py-5">
                      <div class="text-muted">
                        <i class="bi bi-journal-x fs-1 d-block mb-2 text-secondary"></i>
                        <p class="mb-0 fs-6">No articles found.</p>
                      </div>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div class="mt-3">
            {{ $articles->links() }}
          </div>
        </section>
      </main>
    </div>
  </div>

  <!-- Create Article Modal -->
  <div class="modal fade" id="createArticleModal" tabindex="-1" aria-labelledby="createArticleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content" style="border-radius: 16px; border: 1px solid #e2e8f0;">
        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-header border-bottom px-4 py-3">
            <h5 class="modal-title fw-bold" id="createArticleModalLabel"><i class="bi bi-plus-circle me-2 text-primary"></i> Create News Article</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body px-4 py-4">
            <div class="mb-3">
              <label class="form-label fw-bold">Article Title <span class="text-danger">*</span></label>
              <input type="text" name="title" class="form-control rounded-3" placeholder="e.g. 5 Tips for Action Sports Photography" required>
            </div>
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                <select name="category" class="form-select rounded-3" required>
                  <option value="Editorial">Editorial</option>
                  <option value="Community">Community</option>
                  <option value="Marketing">Marketing</option>
                  <option value="Photography">Photography</option>
                  <option value="Legal">Legal &amp; POPIA</option>
                  <option value="Product">Product Updates</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold">Read Time</label>
                <input type="text" name="read_time" class="form-control rounded-3" placeholder="e.g. 5 min read" value="5 min read">
              </div>
            </div>
            <div class="row g-3 mb-3">
              <div class="col-md-4">
                <label class="form-label fw-bold">Author Name</label>
                <input type="text" name="author_name" class="form-control rounded-3" placeholder="PhotoX Editorial" value="PhotoX Editorial">
              </div>
              <div class="col-md-4">
                <label class="form-label fw-bold">Upload Cover Photo</label>
                <input type="file" name="cover_image_file" class="form-control rounded-3" accept="image/*">
                <small class="text-muted" style="font-size: 0.72rem;">Upload from computer</small>
              </div>
              <div class="col-md-4">
                <label class="form-label fw-bold">Or Image URL</label>
                <input type="text" name="image_url" class="form-control rounded-3" placeholder="https://images.unsplash...">
                <small class="text-muted" style="font-size: 0.72rem;">Or paste external link</small>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold">Summary / Excerpt <span class="text-danger">*</span></label>
              <textarea name="summary" rows="2" class="form-control rounded-3" placeholder="Brief summary shown on cards..." required></textarea>
            </div>
            <div class="mb-3">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <label class="form-label fw-bold mb-0">Full Article Content (Story Text &amp; Photos)</label>
                <div class="d-flex align-items-center gap-1">
                  <label class="btn btn-outline-primary btn-sm rounded-pill px-2 py-0" style="font-size: 0.75rem; cursor: pointer;" title="Upload photo directly into story body">
                    <i class="bi bi-image me-1"></i>+ Insert In-Article Photo
                    <input type="file" accept="image/*" class="d-none" onchange="uploadStoryInlineImage(this, 'createContentArea')">
                  </label>
                  <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-2 py-0" style="font-size: 0.75rem;" onclick="insertQuoteSnippet('createContentArea')">
                    <i class="bi bi-quote"></i> Quote
                  </button>
                  <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-2 py-0" style="font-size: 0.75rem;" onclick="insertSubheadingSnippet('createContentArea')">
                    <i class="bi bi-type-h2"></i> Heading
                  </button>
                </div>
              </div>
              <textarea id="createContentArea" name="content" rows="7" class="form-control rounded-3" placeholder="Full story text or paragraphs... You can use the button above to insert photos throughout your story!"></textarea>
              <small class="text-muted" style="font-size: 0.72rem;">Photos uploaded via '+ Insert In-Article Photo' will appear directly within the story text.</small>
            </div>
            <div class="form-check form-switch mt-2">
              <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="isFeaturedCheck">
              <label class="form-check-label fw-medium" for="isFeaturedCheck">Mark as Featured Hero Story</label>
            </div>
          </div>
          <div class="modal-footer border-top px-4 py-3 d-flex justify-content-between">
            <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary rounded-pill px-4">Publish Article</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Article Modal -->
  <div class="modal fade" id="editArticleModal" tabindex="-1" aria-labelledby="editArticleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content" style="border-radius: 16px; border: 1px solid #e2e8f0;">
        <form id="editArticleForm" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="modal-header border-bottom px-4 py-3">
            <h5 class="modal-title fw-bold" id="editArticleModalLabel"><i class="bi bi-pencil-square me-2 text-primary"></i> Edit News Article</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body px-4 py-4">
            <div class="mb-3">
              <label class="form-label fw-bold">Article Title <span class="text-danger">*</span></label>
              <input type="text" id="editTitle" name="title" class="form-control rounded-3" required>
            </div>
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                <select id="editCategory" name="category" class="form-select rounded-3" required>
                  <option value="Editorial">Editorial</option>
                  <option value="Community">Community</option>
                  <option value="Marketing">Marketing</option>
                  <option value="Photography">Photography</option>
                  <option value="Legal">Legal &amp; POPIA</option>
                  <option value="Product">Product Updates</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-bold">Read Time</label>
                <input type="text" id="editReadTime" name="read_time" class="form-control rounded-3">
              </div>
            </div>
            <div class="row g-3 mb-3">
              <div class="col-md-4">
                <label class="form-label fw-bold">Author Name</label>
                <input type="text" id="editAuthor" name="author_name" class="form-control rounded-3">
              </div>
              <div class="col-md-4">
                <label class="form-label fw-bold">Upload New Cover Photo</label>
                <input type="file" name="cover_image_file" class="form-control rounded-3" accept="image/*">
                <small class="text-muted" style="font-size: 0.72rem;">Choose new file to replace</small>
              </div>
              <div class="col-md-4">
                <label class="form-label fw-bold">Or Image URL</label>
                <input type="text" id="editImage" name="image_url" class="form-control rounded-3">
                <small class="text-muted" style="font-size: 0.72rem;">Or update image link</small>
              </div>
            </div>
            <div id="editImagePreviewWrap" class="mb-3 d-none">
              <label class="form-label fw-bold d-block small text-muted">Current Cover Photo Preview:</label>
              <img id="editImagePreview" src="" alt="Cover" class="rounded-3 border" style="max-height: 100px; max-width: 180px; object-fit: cover;">
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold">Summary / Excerpt <span class="text-danger">*</span></label>
              <textarea id="editSummary" name="summary" rows="2" class="form-control rounded-3" required></textarea>
            </div>
            <div class="mb-3">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <label class="form-label fw-bold mb-0">Full Article Content (Story Text &amp; Photos)</label>
                <div class="d-flex align-items-center gap-1">
                  <label class="btn btn-outline-primary btn-sm rounded-pill px-2 py-0" style="font-size: 0.75rem; cursor: pointer;" title="Upload photo directly into story body">
                    <i class="bi bi-image me-1"></i>+ Insert In-Article Photo
                    <input type="file" accept="image/*" class="d-none" onchange="uploadStoryInlineImage(this, 'editContent')">
                  </label>
                  <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-2 py-0" style="font-size: 0.75rem;" onclick="insertQuoteSnippet('editContent')">
                    <i class="bi bi-quote"></i> Quote
                  </button>
                  <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-2 py-0" style="font-size: 0.75rem;" onclick="insertSubheadingSnippet('editContent')">
                    <i class="bi bi-type-h2"></i> Heading
                  </button>
                </div>
              </div>
              <textarea id="editContent" name="content" rows="7" class="form-control rounded-3"></textarea>
              <small class="text-muted" style="font-size: 0.72rem;">Photos uploaded via '+ Insert In-Article Photo' will appear directly within the story text.</small>
            </div>
            <div class="form-check form-switch mt-2">
              <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="editIsFeatured">
              <label class="form-check-label fw-medium" for="editIsFeatured">Mark as Featured Hero Story</label>
            </div>
          </div>
          <div class="modal-footer border-top px-4 py-3 d-flex justify-content-between">
            <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary rounded-pill px-4">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const editModalEl = document.getElementById('editArticleModal');
      const editModal = new bootstrap.Modal(editModalEl);
      const editForm = document.getElementById('editArticleForm');

      document.querySelectorAll('.edit-article-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          const id = this.getAttribute('data-id');
          const title = this.getAttribute('data-title');
          const category = this.getAttribute('data-category');
          const readTime = this.getAttribute('data-readtime');
          const author = this.getAttribute('data-author');
          const image = this.getAttribute('data-image');
          const summary = this.getAttribute('data-summary');
          const content = this.getAttribute('data-content');
          const featured = this.getAttribute('data-featured');

          editForm.action = `/admin/news/${id}`;
          document.getElementById('editTitle').value = title || '';
          document.getElementById('editCategory').value = category || 'Editorial';
          document.getElementById('editReadTime').value = readTime || '';
          document.getElementById('editAuthor').value = author || '';
          document.getElementById('editImage').value = image || '';
          document.getElementById('editSummary').value = summary || '';
          document.getElementById('editContent').value = content || '';
          document.getElementById('editIsFeatured').checked = (featured === '1');

          const previewWrap = document.getElementById('editImagePreviewWrap');
          const previewImg = document.getElementById('editImagePreview');
          if (image) {
            previewImg.src = image;
            previewWrap.classList.remove('d-none');
          } else {
            previewWrap.classList.add('d-none');
          }

          editModal.show();
        });
      });
    });

    function uploadStoryInlineImage(input, targetTextareaId) {
      if (!input.files || !input.files[0]) return;
      const file = input.files[0];
      const formData = new FormData();
      formData.append('image', file);

      const textarea = document.getElementById(targetTextareaId);
      const originalValue = textarea.value;

      // Temporary placeholder in textarea
      textarea.value += "\n\n<!-- Uploading story image... please wait -->\n\n";

      fetch('/admin/news/upload-inline', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        if (data.success && data.url) {
          const imageSnippet = `\n<figure class="my-4 text-center">\n  <img src="${data.url}" class="img-fluid rounded-4 shadow-sm" alt="Story photo" style="max-height: 480px; width: 100%; object-fit: cover;">\n  <figcaption class="text-muted small mt-2">Add caption here...</figcaption>\n</figure>\n`;
          textarea.value = textarea.value.replace("<!-- Uploading story image... please wait -->", imageSnippet.trim());
          alert("Photo uploaded and inserted into article story successfully!");
        } else {
          textarea.value = originalValue;
          alert(data.message || 'Failed to upload photo.');
        }
      })
      .catch(err => {
        textarea.value = originalValue;
        alert('Upload failed. Please check file format and size.');
      });
    }

    function insertQuoteSnippet(targetTextareaId) {
      const textarea = document.getElementById(targetTextareaId);
      const snippet = `\n<blockquote class="p-3 my-4 bg-light border-start border-4 border-warning rounded-end fst-italic">\n  "Add your highlight quote here..."\n  <footer class="blockquote-footer mt-1 small">Speaker Name</footer>\n</blockquote>\n`;
      textarea.value += snippet;
      textarea.focus();
    }

    function insertSubheadingSnippet(targetTextareaId) {
      const textarea = document.getElementById(targetTextareaId);
      const snippet = `\n<h3 class="fw-bold mt-4 mb-3 text-dark">Section Subheading Title</h3>\n<p>Write your detailed story paragraphs here...</p>\n`;
      textarea.value += snippet;
      textarea.focus();
    }
  </script>
</body>
</html>
