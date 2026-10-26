<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<title>PhotoX Admin | Watermark Studio</title>
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
	<link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
	<style>
		.watermark-studio-admin {
			background: #151f2e;
			border-radius: 16px;
			padding: 28px;
			color: #fff;
		}
		.watermark-controls-admin {
			background: #1c2a3b;
			padding: 24px;
			border-radius: 14px;
			border: 1px solid rgba(255,255,255,0.08);
		}
		.watermark-field input, .watermark-control-row select {
			background: #111a26;
			color: #fff;
			border: 1px solid rgba(255,255,255,0.15);
			padding: 8px 12px;
			border-radius: 8px;
			width: 100%;
		}
		.watermark-field input:focus, .watermark-control-row select:focus {
			border-color: #ff8a00;
			outline: none;
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
						<span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><strong>Watermark Studio</strong>
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
				<div class="page-intro d-flex align-items-end justify-content-between gap-3 flex-wrap mb-4">
					<div>
						<p class="eyebrow">Digital Rights &amp; Media Protection</p>
						<h1>Watermark Studio</h1>
						<p class="intro-copy">Live interactive laboratory to configure, preview and test watermark overlays across galleries. Prevents unauthorized downloads and inspect-element theft.</p>
					</div>
					<div class="d-flex gap-2">
						<button id="btnSaveWatermark" class="btn btn-primary px-4" type="button" onclick="saveAdminWatermarks()">
							<i class="bi bi-shield-check me-1"></i> Save Watermark Profile
						</button>
					</div>
				</div>

				<section class="row g-3 mb-4">
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-shield-lock"></i></span>
							</div>
							<p>Protection Mode</p>
							<h2>Server-Side</h2>
							<small>Watermark burned into preview files</small>
						</article>
					</div>
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-grid-3x3"></i></span>
							</div>
							<p>Default Pattern</p>
							<h2>Diagonal Tile</h2>
							<small>Repeated anti-crop coverage</small>
						</article>
					</div>
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-eye-slash"></i></span>
							</div>
							<p>Clean Original</p>
							<h2>Private Disk</h2>
							<small>Released only post-purchase</small>
						</article>
					</div>
					<div class="col-xl-3 col-md-6">
						<article class="ops-stat">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-lightning-charge"></i></span>
							</div>
							<p>Inspect Defense</p>
							<h2>Active</h2>
							<small>Protected against DevTools extraction</small>
						</article>
					</div>
				</section>

				<section class="watermark-studio-admin">
					<div class="watermark-studio-grid">
						<div class="watermark-preview-shell">
							<div class="d-flex align-items-center justify-content-between mb-3 px-2 flex-wrap gap-2">
								<div class="d-flex align-items-center gap-2">
									<span class="small text-uppercase fw-bold text-muted"><i class="bi bi-broadcast me-1 text-warning"></i> Real-Time Canvas View</span>
									<div class="btn-group btn-group-sm ms-2" role="group">
										<button type="button" class="btn btn-outline-warning btn-sm active" id="btnOrientLandscape" onclick="switchPreviewOrientation('landscape')">
											<i class="bi bi-aspect-ratio me-1"></i> Landscape (4:3)
										</button>
										<button type="button" class="btn btn-outline-warning btn-sm" id="btnOrientPortrait" onclick="switchPreviewOrientation('portrait')">
											<i class="bi bi-phone me-1"></i> Portrait (3:4)
										</button>
									</div>
								</div>
								<span class="badge bg-dark border text-warning"><i class="bi bi-shield-check me-1"></i> Anti-Theft Protected</span>
							</div>
							<div class="watermark-preview" id="watermarkPreview" style="min-height: 480px; height: 520px;">
								<img id="watermarkPhoto" src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=1200&q=88" alt="Runner crossing a finish line">
								<div class="watermark-overlay" id="watermarkOverlay"></div>
								<div class="watermark-preview-note">
									<i class="bi bi-info-circle"></i>
									<span>Live preview. Changes below instantly update the protection watermark.</span>
								</div>
							</div>
						</div>

						<div class="watermark-controls-admin">
							<div class="watermark-control-header mb-3">
								<span class="text-warning small text-uppercase fw-bold">Live Parameter Control</span>
								<strong>Watermark Settings</strong>
							</div>

							<div class="mb-3 watermark-field">
								<span class="small text-muted mb-1 d-block">Test with your own photo:</span>
								<input accept="image/*" id="watermarkImageInput" type="file" class="form-control form-control-sm">
							</div>

							<div class="mb-3 watermark-field">
								<span class="small text-muted mb-1 d-block">Brand / Signature text:</span>
								<input id="watermarkText" type="text" value="PhotoX © 2026" maxlength="28">
							</div>

							<div class="watermark-control-row mb-3">
								<span class="small text-muted mb-1 d-block">Watermark Type:</span>
								<div class="watermark-segmented">
									<button class="active" data-watermark-type="logo" type="button"><i class="bi bi-diamond me-1"></i> Logo</button>
									<button data-watermark-type="text" type="button"><i class="bi bi-fonts me-1"></i> Text</button>
								</div>
							</div>

							<div class="watermark-control-row mb-3">
								<span class="small text-muted mb-1 d-block">Overlay Position:</span>
								<select id="watermarkPosition">
									<option value="center">Center (Recommended for maximum protection)</option>
									<option value="bottom-right">Bottom right</option>
									<option value="bottom-left">Bottom left</option>
									<option value="top-right">Top right</option>
								</select>
							</div>

							<label class="watermark-range mb-3 d-block">
								<span class="d-flex justify-content-between small text-muted mb-1">
									<span>Opacity</span>
									<output id="watermarkOpacityValue" class="text-warning fw-bold">65%</output>
								</span>
								<input id="watermarkOpacity" max="100" min="10" type="range" value="65" class="w-100">
							</label>

							<label class="watermark-range mb-3 d-block">
								<span class="d-flex justify-content-between small text-muted mb-1">
									<span>Font Size</span>
									<output id="watermarkSizeValue" class="text-warning fw-bold">28px</output>
								</span>
								<input id="watermarkSize" max="54" min="12" type="range" value="28" class="w-100">
							</label>

							<label class="watermark-range mb-3 d-block">
								<span class="d-flex justify-content-between small text-muted mb-1">
									<span>Rotation Angle</span>
									<output id="watermarkRotationValue" class="text-warning fw-bold">-12°</output>
								</span>
								<input id="watermarkRotation" max="25" min="-25" type="range" value="-12" class="w-100">
							</label>

							<div class="pt-2 border-top border-secondary">
								<label class="watermark-toggle d-flex justify-content-between align-items-center mb-2" style="cursor:pointer;">
									<span>
										<strong>Anti-AI Blur &amp; Frosted Shield</strong><br>
										<small class="text-muted">Dynamic frosted blur mask breaking AI inpainting &amp; unwatermark tools</small>
									</span>
									<input id="watermarkAntiAi" type="checkbox" {{ ($setting->has_anti_ai_lines ?? false) ? 'checked' : '' }} style="width: 20px; height: 20px;">
								</label>

								<label class="watermark-toggle d-flex justify-content-between align-items-center mb-2" style="cursor:pointer;">
									<span>
										<strong>Diagonal Tile Pattern</strong><br>
										<small class="text-muted">Repeats across the entire image to prevent cropping</small>
									</span>
									<input id="watermarkTile" type="checkbox" {{ ($setting->is_tiled ?? true) ? 'checked' : '' }} style="width: 20px; height: 20px;">
								</label>

								<label class="watermark-toggle d-flex justify-content-between align-items-center" style="cursor:pointer;">
									<span>
										<strong>Glass Motion Protection (WaterMotion)</strong><br>
										<small class="text-muted">Dynamic liquid lens &amp; glimmer effect against screenshot bots</small>
									</span>
									<input id="watermarkMotion" type="checkbox" {{ ($setting->is_motion_mask_enabled ?? false) ? 'checked' : '' }} style="width: 20px; height: 20px;">
								</label>
							</div>
						</div>
					</div>
				</section>
			</main>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="{{ asset('admin-assets/js/app.js') }}"></script>
	<script>
	(() => {
		const preview = document.getElementById('watermarkPreview');
		const overlay = document.getElementById('watermarkOverlay');
		const photo = document.getElementById('watermarkPhoto');
		const textInput = document.getElementById('watermarkText');
		const positionInput = document.getElementById('watermarkPosition');
		const opacityInput = document.getElementById('watermarkOpacity');
		const sizeInput = document.getElementById('watermarkSize');
		const rotationInput = document.getElementById('watermarkRotation');
		const tileInput = document.getElementById('watermarkTile');
		const motionInput = document.getElementById('watermarkMotion');
		let watermarkType = 'logo';

		function renderWatermark() {
			const value = textInput.value.trim() || 'PhotoX © 2026';
			const count = tileInput.checked ? 16 : 1;
			overlay.innerHTML = Array.from({ length: count }, () => `<span class="watermark-mark">${value}</span>`).join('');
			overlay.dataset.type = watermarkType;
			overlay.dataset.position = positionInput.value;
			overlay.style.setProperty('--watermark-opacity', Number(opacityInput.value) / 100);
			overlay.style.setProperty('--watermark-size', `${sizeInput.value}px`);
			overlay.style.setProperty('--watermark-rotation', `${rotationInput.value}deg`);
			overlay.classList.toggle('is-tiled', tileInput.checked);
			preview.classList.toggle('has-motion', motionInput.checked);
			document.getElementById('watermarkOpacityValue').textContent = `${opacityInput.value}%`;
			document.getElementById('watermarkSizeValue').textContent = `${sizeInput.value}px`;
			document.getElementById('watermarkRotationValue').textContent = `${rotationInput.value}°`;
		}

		document.querySelectorAll('[data-watermark-type]').forEach((button) => button.addEventListener('click', () => {
			document.querySelectorAll('[data-watermark-type]').forEach((item) => item.classList.remove('active'));
			button.classList.add('active');
			watermarkType = button.dataset.watermarkType;
			renderWatermark();
		}));

		[textInput, positionInput, opacityInput, sizeInput, rotationInput, tileInput, motionInput].forEach((control) => control.addEventListener('input', renderWatermark));
		
		document.getElementById('watermarkImageInput').addEventListener('change', (event) => {
			const file = event.target.files[0];
			if (file) {
				photo.src = URL.createObjectURL(file);
			}
		});

		renderWatermark();

		window.switchPreviewOrientation = function(orientation) {
			const btnLandscape = document.getElementById('btnOrientLandscape');
			const btnPortrait = document.getElementById('btnOrientPortrait');
			const previewBox = document.getElementById('watermarkPreview');

			if (orientation === 'portrait') {
				photo.src = 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?auto=format&fit=crop&w=800&h=1200&q=88';
				previewBox.style.maxWidth = '380px';
				previewBox.style.margin = '0 auto';
				if (btnPortrait) btnPortrait.classList.add('active');
				if (btnLandscape) btnLandscape.classList.remove('active');
			} else {
				photo.src = 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=1200&q=88';
				previewBox.style.maxWidth = '100%';
				previewBox.style.margin = '0';
				if (btnLandscape) btnLandscape.classList.add('active');
				if (btnPortrait) btnPortrait.classList.remove('active');
			}
			renderWatermark();
		};

		window.saveAdminWatermarks = function() {
			const btn = document.getElementById('btnSaveWatermark');
			const originalHtml = btn.innerHTML;
			btn.disabled = true;
			btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Saving...';

			const formData = new FormData();
			formData.append('_token', '{{ csrf_token() }}');
			formData.append('is_watermark_enabled', 1);
			formData.append('watermark_type', watermarkType || 'logo');
			formData.append('watermark_text', textInput.value.trim() || 'PhotoX © 2026');
			formData.append('font_size', sizeInput.value || 25);
			formData.append('opacity', opacityInput.value || 65);
			formData.append('rotation', rotationInput.value || -12);
			formData.append('is_tiled', tileInput.checked ? 1 : 0);
			formData.append('has_anti_ai_lines', document.getElementById('watermarkAntiAi').checked ? 1 : 0);
			formData.append('is_motion_mask_enabled', motionInput.checked ? 1 : 0);

			fetch('{{ route("admin.watermarks.save") }}', {
				method: 'POST',
				body: formData
			})
			.then(r => r.json())
			.then(data => {
				btn.disabled = false;
				btn.innerHTML = originalHtml;
				alert(data.message || 'Watermark settings profile saved successfully!');
			})
			.catch(err => {
				btn.disabled = false;
				btn.innerHTML = originalHtml;
				alert('Error saving watermark settings.');
			});
		};
	})();
	</script>
</body>
</html>
