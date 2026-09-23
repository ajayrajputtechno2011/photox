<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="PhotoX is the sports and event photography marketplace for finding your moments." name="description">
  <title>PhotoX | Find your moment</title>
  <link rel="icon" type="image/png" href="favicon.png">
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<script defer src="site-ad.js"></script>
	
</head>
<body class="page-events page-photographers">
  <nav aria-label="Main navigation" class="navbar navbar-expand-lg py-2">
    <div class="container-xl">
      <a aria-label="PhotoX home" class="navbar-brand d-flex align-items-center gap-2" href="index.html"><img alt="PhotoX" src="logo.png"></a> <button aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler border-0 p-0" data-bs-target="#mainNav" data-bs-toggle="collapse" type="button"><i class="bi bi-list fs-2"></i></button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav mx-auto gap-lg-3 mt-3 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="events.html">Explore</a>
          </li>
					<li class="nav-item">
						<a class="nav-link active" href="photographers.html">Photographers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="membership.html">Membership</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.html">About</a>
          </li>
		  <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
        </ul>
        <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
          <div class="header-search d-none d-xl-flex"><i class="bi bi-search"></i><input aria-label="Search photos, people, teams or events" placeholder="Search photos, people, teams or events..." type="search"></div>
		  <a class="header-cart" href="cart.html" aria-label="Open cart"><i class="bi bi-cart3"></i><span>0</span></a>
          <a class="text-link d-none d-sm-inline" href="login.html"><i class="bi bi-person me-1"></i>Login</a> <a class="btn btn-lime rounded-pill px-4" href="signup.html">Sign Up <i class="bi bi-arrow-up-right ms-1"></i></a>
        </div>
      </div>
    </div>
  </nav>

	<main>
		<section class="events-page-hero">
			<aside class="hero-ad-carousel" aria-label="Sponsored placements">
				<div class="hero-ad-slide active"><img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=700&h=1200&q=88" alt="Adventure vehicle on an open road"><span class="hero-ad-slide-copy"><strong>BUILT FOR MORE<br>THAN ROADS</strong><small>Explore the range</small></span></div><div class="hero-ad-slide"><img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=700&h=1200&q=88" alt="Red running shoe"><span class="hero-ad-slide-copy"><strong>KEEP MOVING.</strong><small>Performance partner</small></span></div><div class="hero-ad-slide"><img src="https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=700&h=1200&q=88" alt="Swimmer in a pool"><span class="hero-ad-slide-copy"><strong>MAKE A SPLASH.</strong><small>Discover the next event</small></span></div><div class="hero-ad-controls"><button data-ad-prev type="button" aria-label="Previous ad"><i class="bi bi-chevron-left"></i></button><div class="hero-ad-dots"><button class="active" data-ad-slide="0" type="button" aria-label="Ad 1"></button><button data-ad-slide="1" type="button" aria-label="Ad 2"></button><button data-ad-slide="2" type="button" aria-label="Ad 3"></button></div><button data-ad-next type="button" aria-label="Next ad"><i class="bi bi-chevron-right"></i></button></div>
			</aside>
      <div class="container-xl">
        <div class="section-kicker"><span class="live-dot"></span>PhotoX / The Photographers</div>
        <h1>Good eyes. <em>see more.</em></h1>
		<p>Meet the photographers behind the moments.From race days to match days, they capture movement, emotion and stories that last. Find the right creative eye for your next event.</p>
        <div class="hero-actions">
          <a class="btn btn-lime rounded-pill px-4" href="#discover">Meet the roster</a>
         
        </div>
       <!--  <div class="stats-row">
          <div class="stat-box"><span>Events</span><strong>1,240</strong></div>
          <div class="stat-box"><span>Galleries</span><strong>8.4k</strong></div>
          <div class="stat-box"><span>Photos</span><strong>3.2M</strong></div>
          <div class="stat-box"><span>Downloads</span><strong>96k</strong></div>
        </div> -->
      </div>
    </section>
		
		<!-- <section class="creator-stats" aria-label="PhotoX creator network statistics">
			<div class="container-xl creator-stats-grid">
				<div class="creator-stat"><strong>480+</strong><span>Creators in the network</span></div>
				<div class="creator-stat"><strong>1,240</strong><span>Events covered</span></div>
				<div class="creator-stat"><strong>3.2M</strong><span>Moments archived</span></div>
				<div class="creator-stat"><strong>98%</strong><span>Customer satisfaction</span></div>
			</div>
		</section> -->
		<section class="people-roster" id="roster" style="    background: rgba(230, 240, 255, .75);">
			<div class="container-xl">
				<div class="people-roster-heading">
					<div>
						<span class="people-label dark">THE PHOTOX ROSTER</span>
						<h2>Meet the<br>
						<em>Photographers.</em></h2>
					</div><label class="people-search"><i class="bi bi-search"></i><input aria-label="Search photographers" id="search" placeholder="Search names or specialties"></label>
				</div>
				<p class="creator-note">Find the right eye for your event. Search by name, location or specialty, then explore the creators who turn race days, matches and community moments into images worth keeping.</p>
				<div class="people-filters">
					<button class="people-filter active" data-filter="all">Everyone</button><button class="people-filter" data-filter="sport">Sports</button><button class="people-filter" data-filter="event">Events</button><button class="people-filter" data-filter="portrait">Portraits</button>
				</div>
				<div class="people-grid" id="grid">
					<article class="person-card" data-name="maya naidoo running cape town" data-type="sport">
						<div class="person-image">
							<img alt="Maya Naidoo" src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=900&q=90"><span>01</span>
						</div>
						<div class="person-info">
							<small>SPORT / CAPE TOWN</small>
							<h3>Aiden Daniels</h3>
							<p>Running, endurance and the quiet drama before the finish.</p><a aria-label="Maya Naidoo profile" href="photographer-details.html"><i class="bi bi-arrow-up-right"></i></a>
						</div>
					</article>
					<article class="person-card person-featured" data-name="daniel jacobs rugby stellenbosch" data-type="event">
						<div class="person-image">
							<img alt="Daniel Jacobs" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=500&q=88"><span>02</span>
						</div>
						<div class="person-info">
							<small>EVENTS / STELLENBOSCH</small>
							<h3>Daniel Jacobs</h3>
							<p>Match-day energy, honest reactions and the frame after the frame.</p><a aria-label="Daniel Jacobs profile" href="photographer-details.html"><i class="bi bi-arrow-up-right"></i></a>
						</div>
					</article>
					<article class="person-card" data-name="naledi williams portrait johannesburg" data-type="portrait">
						<div class="person-image">
							<img alt="Naledi Williams" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=900&q=90"><span>03</span>
						</div>
						<div class="person-info">
							<small>PORTRAITS / JOHANNESBURG</small>
							<h3>Naledi Williams</h3>
							<p>Faces, focus and the details that make a team feel like one.</p><a aria-label="Naledi Williams profile" href="photographer-details.html"><i class="bi bi-arrow-up-right"></i></a>
						</div>
					</article>
					<article class="person-card" data-name="sipho dlamini rugby durban" data-type="sport">
						<div class="person-image">
							<img alt="Sipho Dlamini" src="https://images.unsplash.com/photo-1504593811423-6dd665756598?auto=format&fit=crop&w=900&q=90"><span>04</span>
						</div>
						<div class="person-info">
							<small>SPORT / DURBAN</small>
							<h3>Sipho Dlamini</h3>
							<p>Power, movement and the beautiful mess of competition.</p><a aria-label="Sipho Dlamini profile" href="photographer-details.html"><i class="bi bi-arrow-up-right"></i></a>
						</div>
					</article>
					<article class="person-card" data-name="ayesha khan cycling paarl" data-type="event">
						<div class="person-image">
							<img alt="Ayesha Khan" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=900&q=90"><span>05</span>
						</div>
						<div class="person-info">
							<small>EVENTS / PAARL</small>
							<h3>Ayesha Khan</h3>
							<p>Long rides, open roads and stories found between the miles.</p><a aria-label="Ayesha Khan profile" href="photographer-details.html"><i class="bi bi-arrow-up-right"></i></a>
						</div>
					</article>
					<article class="person-card" data-name="thandi mokoena portrait cape town" data-type="portrait">
						<div class="person-image">
							<img alt="Thandi Mokoena" src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=900&q=90"><span>06</span>
						</div>
						<div class="person-info">
							<small>PORTRAITS / CAPE TOWN</small>
							<h3>Thandi Mokoena</h3>
							<p>Warm light and the real people inside every big event.</p><a aria-label="Thandi Mokoena profile" href="photographer-details.html"><i class="bi bi-arrow-up-right"></i></a>
						</div>
					</article>
				</div>
				<p class="people-empty" hidden="" id="empty">No creators found.</p>
			</div>
		</section>
		<section class="creator-benefits" style="background-color: #f4f8ff;">
			<div class="container-xl">
				<div class="creator-benefits-heading"><span class="people-label dark">WHY CREATORS CHOOSE PHOTOX</span><h2>More time making. <em>Less time managing.</em></h2></div>
				<div class="benefit-grid">
					<article class="benefit-item"><i class="bi bi-window-stack"></i><h3>A polished storefront</h3><p>Present every event with a beautiful gallery that feels considered on desktop and mobile.</p></article>
					<article class="benefit-item"><i class="bi bi-lightning-charge"></i><h3>Simple delivery</h3><p>Upload, organise and deliver secure event galleries without losing time to repetitive admin.</p></article>
					<article class="benefit-item"><i class="bi bi-people"></i><h3>A wider audience</h3><p>Reach athletes, families, schools and sponsors already looking for their next moment.</p></article>
				</div>
			</div>
		</section>
		<section class="people-footer-cta">
			<div class="container-xl">
				<span class="people-label">FOR THE PEOPLE BEHIND THE CAMERA</span>
				<h2>Your view<br>
				<em>belongs here.</em></h2><a href="signup.html">Join PhotoX <i class="bi bi-arrow-up-right"></i></a>
			</div>
		</section>
		<aside class="site-ad-banner" aria-label="Sponsored placement">
			<a class="site-ad-link" href="events.html"><img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&h=360&q=88" alt="Adventure vehicle on an open road"><span class="site-ad-overlay"></span><span class="site-ad-copy"><small>PHOTOX PARTNER</small><strong>BUILT FOR MORE<br>THAN ROADS</strong><span>Explore events <i class="bi bi-arrow-up-right"></i></span></span></a>
		</aside>
		<!-- <section class="watermark-studio" id="watermarkStudio">
			<div class="container-xl">
				<div class="watermark-studio-heading"><div><span class="people-label dark">YOUR CREATOR TOOLKIT</span><h2>Every photo carries<br><em>your signature.</em></h2></div><p>Preview your watermark before publishing a gallery. Upload a logo or use your brand name, then fine-tune how it appears on every image.</p></div>
				<div class="watermark-studio-grid">
					<div class="watermark-preview-shell"><div class="watermark-preview" id="watermarkPreview"><img id="watermarkPhoto" src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=1200&q=88" alt="Runner crossing a finish line"><div class="watermark-overlay" id="watermarkOverlay"></div><div class="watermark-preview-note"><i class="bi bi-info-circle"></i><span>Live preview. This watermark will appear on your published gallery images.</span></div></div></div>
					<div class="watermark-controls"><div class="watermark-control-header"><span>05 · YOUR BRAND</span><strong>Watermark settings</strong></div><label class="watermark-field"><span>Preview image</span><input accept="image/*" id="watermarkImageInput" type="file"></label><label class="watermark-field"><span>Brand text</span><input id="watermarkText" type="text" value="Your brand" maxlength="28"></label><div class="watermark-control-row"><span>TYPE</span><div class="watermark-segmented"><button class="active" data-watermark-type="logo" type="button">Logo</button><button data-watermark-type="text" type="button">Text</button></div></div><div class="watermark-control-row"><span>POSITION</span><select id="watermarkPosition"><option value="bottom-right">Bottom right</option><option value="bottom-left">Bottom left</option><option value="center">Center</option><option value="top-right">Top right</option></select></div><label class="watermark-range"><span>OPACITY <output id="watermarkOpacityValue">65%</output></span><input id="watermarkOpacity" max="100" min="10" type="range" value="65"></label><label class="watermark-range"><span>SIZE <output id="watermarkSizeValue">24px</output></span><input id="watermarkSize" max="54" min="12" type="range" value="24"></label><label class="watermark-range"><span>ROTATION <output id="watermarkRotationValue">-8°</output></span><input id="watermarkRotation" max="20" min="-20" type="range" value="-8"></label><label class="watermark-toggle"><span>TILE PATTERN</span><input id="watermarkTile" type="checkbox"><i></i></label><label class="watermark-toggle"><span>GLASS MOTION MAGIC <small>(OPTIONAL)</small></span><input id="watermarkMotion" type="checkbox"><i></i></label></div>
				</div>
			</div>
		</section> -->
	</main>
	<footer class="footer footer-premium"><div class="container-xl">
	<div class="row g-5 footer-main"><div class="col-lg-5"><a class="footer-logo" href="index.html"><img src="logo.png" alt="PhotoX" style="width:150px"></a><p class="footer-copy">The feeling of being there,<br>kept in a frame.</p><div class="footer-social d-flex gap-3"><a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a><a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a><a href="#" aria-label="Linkedin"><i class="bi bi-linkedin"></i></a></div></div><div class="col-6 col-lg-2"><p class="footer-label">Explore</p><a href="events.html">Events</a><a href="photographers.html">Photographers</a><a href="about.html">About</a><a href="contact.html">Contact</a></div><div class="col-6 col-lg-2"><p class="footer-label">For creators</p><a href="login.html">Creator login</a><a href="events.html">Upload photos</a><a href="signup.html">Join PhotoX</a><a href="contact.html">Support</a></div><div class="col-12 col-lg-3"><p class="footer-label">Stay in the frame</p><p class="footer-small">New events, fresh galleries and stories from the field.</p><div class="newsletter"><input aria-label="Email address" placeholder="Your email address" type="email"><button aria-label="Subscribe"><i class="bi bi-arrow-up-right"></i></button></div></div></div><div class="footer-bottom"><span>Â© 2026 PhotoX</span><span>Privacy Â· Terms Â·</span><span>Made for the moments <i class="bi bi-stars"></i></span></div></div></footer>
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div aria-live="polite" class="toast" id="photoToast" role="status">
      <div class="toast-body d-flex align-items-center gap-2">
        <i class="bi bi-check-circle-fill"></i><span>Search ready.</span>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
  </script> 

	<script>
	const cards=[...document.querySelectorAll('.person-card')],tabs=[...document.querySelectorAll('.people-filter')],search=document.getElementById('search');function filter(){const type=document.querySelector('.people-filter.active').dataset.filter,q=search.value.toLowerCase();let n=0;cards.forEach(c=>{const show=(type==='all'||c.dataset.type===type)&&(!q||c.dataset.name.includes(q));c.hidden=!show;if(show)n++});document.getElementById('empty').hidden=n>0}tabs.forEach(t=>t.onclick=()=>{tabs.forEach(x=>x.classList.remove('active'));t.classList.add('active');filter()});search.oninput=filter;
	</script>
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
			const value = textInput.value.trim() || 'Your brand';
			const count = tileInput.checked ? 18 : 1;
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
			if (file) photo.src = URL.createObjectURL(file);
		});
		renderWatermark();
	})();
	</script>
</body>
</html>
