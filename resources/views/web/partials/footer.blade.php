<footer class="footer footer-premium" style="background: #062852; color: #f5f1e9; padding: 65px 0 28px; position: relative; z-index: 10;">
  <div class="container-xl">
    <div class="row g-4 g-lg-5 footer-main mb-5">
      <!-- Col 1: Brand & Social -->
      <div class="col-12 col-lg-4">
        <a class="footer-logo d-inline-block mb-3 text-decoration-none" href="{{ url('/') }}">
          <img src="{{ asset('logo.png') }}" alt="PhotoX" style="width: 145px; height: auto; display: block;">
        </a>
        <p class="footer-copy text-white-50 mb-4" style="font-size: 1.05rem; line-height: 1.4; max-width: 320px;">
          The feeling of being there,<br>kept in a frame.
        </p>
        <div class="footer-social d-flex align-items-center gap-2">
          <a href="https://instagram.com" target="_blank" rel="noopener" class="footer-social-btn" aria-label="Instagram">
            <i class="bi bi-instagram"></i>
          </a>
          <a href="https://facebook.com" target="_blank" rel="noopener" class="footer-social-btn" aria-label="Facebook">
            <i class="bi bi-facebook"></i>
          </a>
          <a href="https://linkedin.com" target="_blank" rel="noopener" class="footer-social-btn" aria-label="Linkedin">
            <i class="bi bi-linkedin"></i>
          </a>
        </div>
      </div>

      <!-- Col 2: Explore Navigation (Includes News) -->
      <div class="col-6 col-md-3 col-lg-2">
        <p class="footer-label fw-bold text-uppercase mb-3" style="font: 600 0.72rem 'DM Mono', monospace; color: #22C55E; letter-spacing: 0.08em;">
          Explore
        </p>
        <ul class="list-unstyled mb-0 footer-link-list">
          <li class="mb-2"><a href="{{ url('/#latest-events') }}" class="footer-nav-link">Events</a></li>
          <li class="mb-2"><a href="{{ url('/photographers') }}" class="footer-nav-link">Photographers</a></li>
          <li class="mb-2"><a href="{{ url('/news') }}" class="footer-nav-link">News & Stories</a></li>
          <li class="mb-2"><a href="{{ url('/membership') }}" class="footer-nav-link">Membership</a></li>
        </ul>
      </div>

      <!-- Col 3: Creators & Company -->
      <div class="col-6 col-md-3 col-lg-2">
        <p class="footer-label fw-bold text-uppercase mb-3" style="font: 600 0.72rem 'DM Mono', monospace; color: #22C55E; letter-spacing: 0.08em;">
          For Creators
        </p>
        <ul class="list-unstyled mb-0 footer-link-list">
          @if(Auth::check() && Auth::user()->role === 'photographer')
            <li class="mb-2"><a href="{{ url('/photographer-dashboard') }}" class="footer-nav-link">Creator Studio</a></li>
            <li class="mb-2"><a href="{{ url('/photographer-upload-new') }}" class="footer-nav-link">Upload Photos</a></li>
            <li class="mb-2"><a href="{{ url('/photographer-gallery') }}" class="footer-nav-link">My Galleries</a></li>
          @else
            <li class="mb-2"><a href="{{ url('/login') }}" class="footer-nav-link">Creator Login</a></li>
            <li class="mb-2"><a href="{{ url('/signup') }}" class="footer-nav-link">Join PhotoX</a></li>
          @endif
          <li class="mb-2"><a href="{{ url('/about') }}" class="footer-nav-link">About Us</a></li>
          <li class="mb-2"><a href="{{ url('/contact') }}" class="footer-nav-link">Support & Contact</a></li>
        </ul>
      </div>

      <!-- Col 4: Stay in the frame (Newsletter) -->
      <div class="col-12 col-md-6 col-lg-4">
        <p class="footer-label fw-bold text-uppercase mb-3" style="font: 600 0.72rem 'DM Mono', monospace; color: #22C55E; letter-spacing: 0.08em;">
          Stay in the frame
        </p>
        <p class="text-white-50 small mb-3" style="font-size: 0.85rem; line-height: 1.45;">
          New events, fresh galleries and stories from the field delivered to your inbox.
        </p>
        <form class="newsletter-form d-flex align-items-center" onsubmit="event.preventDefault(); alert('Thank you for subscribing to PhotoX!');" style="border-bottom: 1px solid rgba(255,255,255,0.25); padding-bottom: 8px;">
          <input aria-label="Email address" placeholder="Your email address" type="email" required style="background: transparent; border: none; outline: none; color: #fff; width: 100%; font-size: 0.88rem;">
          <button type="submit" aria-label="Subscribe" class="btn p-0 border-0 text-success" style="color: #22C55E !important;">
            <i class="bi bi-arrow-up-right fs-5"></i>
          </button>
        </form>
      </div>
    </div>

    <!-- Bottom Bar: Legal & Copyright -->
    <div class="footer-bottom pt-4 d-flex flex-column flex-md-row align-items-center justify-content-between gap-3" style="border-top: 1px solid rgba(255,255,255,0.12); font: 400 0.70rem 'DM Mono', monospace; color: rgba(255,255,255,0.45); text-transform: uppercase;">
      <div>
        © {{ date('Y') }} PhotoX. All rights reserved.
      </div>
      <div class="footer-legal-links d-inline-flex align-items-center gap-2 flex-wrap justify-content-center">
        <a href="{{ url('/privacy') }}" class="footer-legal-link text-decoration-none">Privacy (POPIA)</a>
        <span>·</span>
        <a href="{{ url('/terms') }}" class="footer-legal-link text-decoration-none">Terms</a>
        <span>·</span>
        <a href="{{ url('/licensing') }}" class="footer-legal-link text-decoration-none">Licensing</a>
      </div>
      <div class="d-flex align-items-center gap-1">
        Made for the moments <i class="bi bi-stars" style="color: #22C55E;"></i>
      </div>
    </div>
  </div>
</footer>

<style>
  /* Footer Scoped Styling to guarantee flawless alignment on all pages */
  footer.footer-premium {
    background: #062852 !important;
  }
  .footer-social-btn {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 36px !important;
    height: 36px !important;
    border-radius: 50% !important;
    background: rgba(255, 255, 255, 0.08) !important;
    color: rgba(255, 255, 255, 0.8) !important;
    text-decoration: none !important;
    margin-bottom: 0 !important;
    transition: all 0.2s ease !important;
    font-size: 0.95rem !important;
  }
  .footer-social-btn:hover {
    background: #22C55E !important;
    color: #062852 !important;
    transform: translateY(-2px);
  }
  .footer-nav-link {
    color: rgba(255, 255, 255, 0.65) !important;
    text-decoration: none !important;
    font-size: 0.86rem !important;
    transition: color 0.18s ease !important;
    display: inline-block !important;
    margin-bottom: 0 !important;
  }
  .footer-nav-link:hover {
    color: #22C55E !important;
  }
  .footer-legal-link {
    color: rgba(255, 255, 255, 0.5) !important;
    display: inline !important;
    margin-bottom: 0 !important;
    transition: color 0.18s ease !important;
  }
  .footer-legal-link:hover {
    color: #22C55E !important;
  }
</style>
