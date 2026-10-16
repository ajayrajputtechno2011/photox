<!-- Universal Media Library Picker Modal -->
<div class="modal fade" id="mediaLibraryPickerModal" tabindex="-1" aria-labelledby="mediaLibraryPickerTitle" aria-hidden="true" style="z-index: 1060;">
  <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
    <div class="modal-content shadow-lg border-0" style="border-radius: 14px; overflow: hidden;">
      <div class="modal-header py-3 px-4" style="background: #0f172a; color: #fff;">
        <div class="d-flex align-items-center gap-2">
          <i class="bi bi-images fs-5 text-primary"></i>
          <div>
            <h5 class="modal-title mb-0 fs-6 fw-bold" id="mediaLibraryPickerTitle">Media Library Asset Picker</h5>
            <small class="text-white-50" style="font-size: 0.75rem;">Select an existing banner artwork to reuse, or upload a new asset</small>
          </div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body p-4" style="background: #f8fafc;">
        <!-- Top Toolbar inside Picker -->
        <div class="d-flex justify-content-between align-items-center gap-3 mb-3 flex-wrap">
          <div class="input-group input-group-sm" style="max-width: 320px;">
            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
            <input type="text" id="pickerSearchInput" class="form-control border-start-0 ps-0" placeholder="Filter media by name..." onkeyup="filterPickerMedia(this.value)">
          </div>

          <div class="d-flex gap-2 align-items-center">
            <span id="pickerCountText" class="text-muted small fw-semibold">Loading media...</span>
            <button type="button" class="btn btn-sm btn-primary" onclick="document.getElementById('pickerInlineUploadInput').click();">
              <i class="bi bi-cloud-arrow-up me-1"></i> Upload New to Library
            </button>
            <input type="file" id="pickerInlineUploadInput" accept="image/*" style="display: none;" onchange="uploadFromPicker(this.files[0])">
          </div>
        </div>

        <!-- Upload Progress Indicator -->
        <div id="pickerUploadProgress" class="alert alert-info py-2 px-3 small d-none align-items-center gap-2 mb-3">
          <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
          <span>Uploading image to Media Library...</span>
        </div>

        <!-- Media Grid -->
        <div id="pickerMediaGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 14px; max-height: 480px; overflow-y: auto; padding: 4px;">
          <!-- Dynamically populated via JS -->
        </div>

        <div id="pickerEmptyState" class="text-center py-5 text-muted d-none">
          <i class="bi bi-inbox fs-2 d-block mb-2"></i>
          <p class="mb-0">No media assets match your search.</p>
        </div>
      </div>

      <div class="modal-footer py-2 px-4 bg-white d-flex justify-content-between align-items-center">
        <span class="text-muted small"><i class="bi bi-info-circle me-1"></i> Click on any thumbnail to select it for your banner</span>
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<style>
  .picker-media-item {
    background: #fff;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    transition: all .16s ease;
    display: flex;
    flex-direction: column;
    position: relative;
  }
  .picker-media-item:hover {
    border-color: #3b82f6;
    transform: translateY(-2px);
    box-shadow: 0 8px 18px rgba(15, 23, 42, 0.08);
  }
  .picker-media-item.selected {
    border-color: #10b981 !important;
    background: #ecfdf5;
  }
  .picker-thumb-box {
    width: 100%;
    height: 120px;
    background: #09121f;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    position: relative;
  }
  .picker-thumb-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .picker-item-label {
    padding: 8px;
    font-size: 0.72rem;
    font-weight: 600;
    color: #1e293b;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    border-top: 1px solid #f1f5f9;
  }
  .picker-badge-size {
    position: absolute;
    bottom: 4px;
    right: 4px;
    background: rgba(0,0,0,0.7);
    color: #fff;
    font-size: 0.60rem;
    padding: 1px 4px;
    border-radius: 4px;
    font-family: monospace;
  }
</style>

<script>
  let activeTargetUrlInput = null;
  let activeTargetPreviewImg = null;
  let pickerMediaCache = [];

  function openMediaLibraryPicker(targetUrlInputSelector, targetPreviewImgSelector) {
    activeTargetUrlInput = document.querySelector(targetUrlInputSelector);
    activeTargetPreviewImg = targetPreviewImgSelector ? document.querySelector(targetPreviewImgSelector) : null;

    const modalEl = document.getElementById('mediaLibraryPickerModal');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    modal.show();

    loadPickerMedia();
  }

  function loadPickerMedia(searchQuery = '') {
    const grid = document.getElementById('pickerMediaGrid');
    const countText = document.getElementById('pickerCountText');
    const emptyState = document.getElementById('pickerEmptyState');

    countText.innerText = 'Loading...';

    fetch('/admin/api/media' + (searchQuery ? '?q=' + encodeURIComponent(searchQuery) : ''))
      .then(res => res.json())
      .then(res => {
        if (res.success && res.data) {
          pickerMediaCache = res.data;
          renderPickerGrid(pickerMediaCache);
        } else {
          grid.innerHTML = '';
          emptyState.classList.remove('d-none');
          countText.innerText = '0 items';
        }
      })
      .catch(err => {
        console.error('Failed to load media picker:', err);
        countText.innerText = 'Error loading media';
      });
  }

  function renderPickerGrid(items) {
    const grid = document.getElementById('pickerMediaGrid');
    const countText = document.getElementById('pickerCountText');
    const emptyState = document.getElementById('pickerEmptyState');

    grid.innerHTML = '';
    countText.innerText = `${items.length} item(s) found`;

    if (items.length === 0) {
      emptyState.classList.remove('d-none');
      return;
    }
    emptyState.classList.add('d-none');

    items.forEach(item => {
      const card = document.createElement('div');
      card.className = 'picker-media-item';
      card.title = 'Click to select: ' + (item.title || item.filename);

      const sizeStr = item.formatted_size || (item.file_size ? Math.round(item.file_size/1024) + ' KB' : '');
      const dimStr = item.dimensions ? ` · ${item.dimensions}` : '';

      card.innerHTML = `
        <div class="picker-thumb-box">
          <img src="${item.url}" alt="${item.filename}" loading="lazy">
          <span class="picker-badge-size">${sizeStr}${dimStr}</span>
        </div>
        <div class="picker-item-label">${item.title || item.filename}</div>
      `;

      card.addEventListener('click', () => {
        selectMediaItem(item);
      });

      grid.appendChild(card);
    });
  }

  function selectMediaItem(item) {
    if (activeTargetUrlInput) {
      activeTargetUrlInput.value = item.url;
      // Trigger change event
      activeTargetUrlInput.dispatchEvent(new Event('change'));
      activeTargetUrlInput.dispatchEvent(new Event('input'));
    }

    if (activeTargetPreviewImg) {
      activeTargetPreviewImg.src = item.url;
      activeTargetPreviewImg.style.display = 'block';
    }

    // Dismiss modal
    const modalEl = document.getElementById('mediaLibraryPickerModal');
    const modalInstance = bootstrap.Modal.getInstance(modalEl);
    if (modalInstance) {
      modalInstance.hide();
    }
  }

  function filterPickerMedia(query) {
    if (!query) {
      renderPickerGrid(pickerMediaCache);
      return;
    }
    const q = query.toLowerCase();
    const filtered = pickerMediaCache.filter(item => {
      return (item.filename && item.filename.toLowerCase().includes(q)) ||
             (item.title && item.title.toLowerCase().includes(q)) ||
             (item.original_name && item.original_name.toLowerCase().includes(q));
    });
    renderPickerGrid(filtered);
  }

  function uploadFromPicker(file) {
    if (!file) return;

    const progress = document.getElementById('pickerUploadProgress');
    progress.classList.remove('d-none');
    progress.classList.add('d-flex');

    const formData = new FormData();
    formData.append('file', file);
    formData.append('folder', 'banners');

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                      document.querySelector('input[name="_token"]')?.value;

    fetch('/admin/media', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      },
      body: formData
    })
    .then(res => res.json())
    .then(res => {
      progress.classList.add('d-none');
      progress.classList.remove('d-flex');
      if (res.success && res.uploaded && res.uploaded.length > 0) {
        // Auto select newly uploaded file!
        selectMediaItem(res.uploaded[0]);
      } else {
        alert(res.message || 'Upload failed');
      }
    })
    .catch(err => {
      progress.classList.add('d-none');
      progress.classList.remove('d-flex');
      console.error(err);
      alert('Error uploading file. Please try again.');
    });
  }
</script>
