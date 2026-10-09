<footer class="footer footer-premium">
  <div class="container-xl">
    <div class="row g-5 footer-main">
      <div class="col-lg-5">
        <a class="footer-logo" href="{{ url('/') }}">
          <img src="{{ asset('logo.png') }}" alt="PhotoX" style="width:150px">
        </a>
        <p class="footer-copy">The feeling of being there,<br>kept in a frame.</p>
        <div class="footer-social d-flex gap-3">
          <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" aria-label="Linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
      <div class="col-6 col-lg-2">
        <p class="footer-label">Explore</p>
        {{-- <a href="{{ url('/events') }}">Events</a> --}}
        <a href="{{ url('/photographers') }}">Photographers</a>
        <a href="{{ url('/blog') }}">Journal</a>
        <a href="{{ url('/sponsors') }}">Sponsors</a>
      </div>
      <div class="col-6 col-lg-2">
        <p class="footer-label">For creators</p>
        <a href="{{ url('/login') }}">Creator login</a>
        <a href="{{ url('/photographer-upload-new') }}">Upload photos</a>
        <a href="{{ url('/signup') }}">Join PhotoX</a>
        <a href="{{ url('/contact') }}">Support</a>
      </div>
      <div class="col-12 col-lg-3">
        <p class="footer-label">Stay in the frame</p>
        <p class="footer-small">New events, fresh galleries and stories from the field.</p>
        <div class="newsletter">
          <input aria-label="Email address" placeholder="Your email address" type="email">
          <button aria-label="Subscribe"><i class="bi bi-arrow-up-right"></i></button>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© 2026 PhotoX</span>
      <span>Privacy · Terms</span>
      <span>Made for the moments <i class="bi bi-stars"></i></span>
    </div>
  </div>
</footer>
