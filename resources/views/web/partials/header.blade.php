<nav aria-label="Main navigation" class="navbar navbar-expand-lg py-2">
  <div class="container-xl">
    <a aria-label="PhotoX home" class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
      <img alt="PhotoX" src="{{ asset('logo.png') }}">
    </a>

    <!-- Mobile Top Bar Quick Actions (Visible on mobile/tablet < 992px) -->
    <div class="d-flex align-items-center gap-2 ms-auto d-lg-none me-2">
      <a class="header-cart" href="{{ url('/cart') }}" aria-label="Open cart">
        <i class="bi bi-cart3"></i><span>0</span>
      </a>

      @guest
        <a class="btn btn-outline-light rounded-pill px-2 py-1 fw-semibold text-white small" href="{{ route('login') }}" style="font-size: 0.75rem; border-color: rgba(255,255,255,0.35);">
          <i class="bi bi-person"></i> <span>Login</span>
        </a>
      @else
        <div class="dropdown mobile-top-user-dropdown position-relative">
          <button class="btn btn-dark rounded-pill px-2 py-1 dropdown-toggle d-flex align-items-center gap-1" type="button" id="mobileTopUserDropdown" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false" style="border: 1px solid rgba(255,255,255,0.25); font-size: 0.78rem;">
            <i class="bi bi-person-circle text-warning fs-6"></i>
            <span class="fw-semibold text-truncate text-white" style="max-width: 90px;">{{ Auth::user()->name }}</span>
          </button>
          <ul class="dropdown-menu dropdown-menu-end shadow mt-2" aria-labelledby="mobileTopUserDropdown" style="min-width: 230px;">
            <li>
              <div class="px-3 py-2 border-bottom border-secondary border-opacity-25">
                <small class="text-muted d-block" style="font-size: 0.7rem;">Signed in as ({{ Auth::user()->role }})</small>
                <strong class="text-truncate d-block text-white" style="font-size: 0.82rem;">{{ Auth::user()->email }}</strong>
              </div>
            </li>
            @if(Auth::user()->role === 'admin')
              <li><a class="dropdown-item py-2" href="{{ url('/admin') }}"><i class="bi bi-speedometer2 me-2 text-danger"></i>Admin Panel</a></li>
            @elseif(Auth::user()->role === 'photographer')
              <li><a class="dropdown-item py-2" href="{{ url('/photographer-dashboard') }}"><i class="bi bi-speedometer me-2 text-info"></i>Creator Studio</a></li>
              <li><a class="dropdown-item py-2" href="{{ url('/photographer-upload-new') }}"><i class="bi bi-cloud-arrow-up me-2 text-success"></i>Upload Photos</a></li>
              <li><a class="dropdown-item py-2" href="{{ url('/photographer-gallery') }}"><i class="bi bi-images me-2 text-primary"></i>My Galleries</a></li>
              <li><a class="dropdown-item py-2" href="{{ url('/photographer-payouts') }}"><i class="bi bi-bank me-2 text-warning"></i>Payouts &amp; Bank</a></li>
              <li><a class="dropdown-item py-2" href="{{ url('/photographer-profile') }}"><i class="bi bi-person-badge me-2 text-info"></i>Creator Profile</a></li>
            @else
              <li><a class="dropdown-item py-2" href="{{ url('/customer-dashboard') }}"><i class="bi bi-grid me-2 text-primary"></i>My Dashboard</a></li>
              <li><a class="dropdown-item py-2" href="{{ url('/orders-downloads') }}"><i class="bi bi-download me-2 text-success"></i>My Downloads</a></li>
              <li><a class="dropdown-item py-2" href="{{ url('/my-photos') }}"><i class="bi bi-heart me-2 text-danger"></i>Saved Photos</a></li>
              <li><a class="dropdown-item py-2" href="{{ url('/saved-events') }}"><i class="bi bi-bookmark-star me-2 text-warning"></i>Saved Events</a></li>
              <li><a class="dropdown-item py-2" href="{{ url('/profile-settings') }}"><i class="bi bi-gear me-2"></i>Account Settings</a></li>
              <li><hr class="dropdown-divider my-1"></li>
              <li><a class="dropdown-item py-2 text-info" href="{{ url('/signup') }}"><i class="bi bi-camera me-2"></i>Become a Photographer</a></li>
            @endif
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="dropdown-item text-danger py-2 w-100 text-start">
                  <i class="bi bi-box-arrow-right me-2"></i>Log Out
                </button>
              </form>
            </li>
          </ul>
        </div>
      @endguest
    </div>

    <!-- Mobile Hamburger Toggler -->
    <button aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler border-0 p-0" data-bs-target="#mainNav" data-bs-toggle="collapse" type="button">
      <i class="bi bi-list fs-2"></i>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav mx-auto gap-lg-3 mt-3 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
        </li>
        {{-- Explore / Events is hidden as homepage serves as Explore --}}
        {{--
        <li class="nav-item">
          <a class="nav-link {{ request()->is('events*') || request()->is('event-details*') ? 'active' : '' }}" href="{{ url('/events') }}">Events</a>
        </li>
        --}}
        <li class="nav-item">
          <a class="nav-link {{ request()->is('photographers*') ? 'active' : '' }}" href="{{ url('/photographers') }}">Photographers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('membership*') ? 'active' : '' }}" href="{{ url('/membership') }}">Membership</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('news*') || request()->is('blog*') ? 'active' : '' }}" href="{{ url('/news') }}">News</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('about*') ? 'active' : '' }}" href="{{ url('/about') }}">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('contact*') ? 'active' : '' }}" href="{{ url('/contact') }}">Contact</a>
        </li>

        @guest
          <li class="nav-item d-lg-none mt-2 pt-2 border-top border-secondary border-opacity-25">
            <a class="nav-link fw-semibold text-white d-flex align-items-center {{ request()->is('login*') ? 'active' : '' }}" href="{{ route('login') }}">
              <i class="bi bi-box-arrow-in-right me-2 text-warning fs-5"></i><span>Login to your account</span>
            </a>
          </li>
        @else
          {{-- Direct Mobile Drawer Account Section --}}
          <li class="nav-item d-lg-none mt-3 pt-3 border-top border-secondary border-opacity-25">
            <div class="px-2 pb-2 d-flex align-items-center justify-content-between">
              <span class="text-muted small text-uppercase fw-semibold" style="letter-spacing: 0.05em; font-size: 0.72rem;">My Account</span>
              <span class="badge {{ Auth::user()->role === 'admin' ? 'bg-danger' : (Auth::user()->role === 'photographer' ? 'bg-info' : 'bg-secondary') }} text-uppercase" style="font-size: 0.65rem;">
                {{ Auth::user()->role }}
              </span>
            </div>
          </li>
          @if(Auth::user()->role === 'admin')
            <li class="nav-item d-lg-none">
              <a class="nav-link text-white py-1 d-flex align-items-center" href="{{ url('/admin') }}">
                <i class="bi bi-speedometer2 me-2 text-danger fs-5"></i><span>Admin Panel</span>
              </a>
            </li>
          @elseif(Auth::user()->role === 'photographer')
            <li class="nav-item d-lg-none"><a class="nav-link text-white py-1" href="{{ url('/photographer-dashboard') }}"><i class="bi bi-speedometer me-2 text-info"></i>Creator Studio</a></li>
            <li class="nav-item d-lg-none"><a class="nav-link text-white py-1" href="{{ url('/photographer-upload-new') }}"><i class="bi bi-cloud-arrow-up me-2 text-success"></i>Upload Photos</a></li>
            <li class="nav-item d-lg-none"><a class="nav-link text-white py-1" href="{{ url('/photographer-gallery') }}"><i class="bi bi-images me-2 text-primary"></i>My Galleries</a></li>
            <li class="nav-item d-lg-none"><a class="nav-link text-white py-1" href="{{ url('/photographer-payouts') }}"><i class="bi bi-bank me-2 text-warning"></i>Payouts &amp; Bank</a></li>
            <li class="nav-item d-lg-none"><a class="nav-link text-white py-1" href="{{ url('/photographer-profile') }}"><i class="bi bi-person-badge me-2 text-info"></i>Creator Profile</a></li>
          @else
            <li class="nav-item d-lg-none"><a class="nav-link text-white py-1" href="{{ url('/customer-dashboard') }}"><i class="bi bi-grid me-2 text-primary"></i>My Dashboard</a></li>
            <li class="nav-item d-lg-none"><a class="nav-link text-white py-1" href="{{ url('/orders-downloads') }}"><i class="bi bi-download me-2 text-success"></i>My Downloads</a></li>
            <li class="nav-item d-lg-none"><a class="nav-link text-white py-1" href="{{ url('/my-photos') }}"><i class="bi bi-heart me-2 text-danger"></i>Saved Photos</a></li>
            <li class="nav-item d-lg-none"><a class="nav-link text-white py-1" href="{{ url('/saved-events') }}"><i class="bi bi-bookmark-star me-2 text-warning"></i>Saved Events</a></li>
            <li class="nav-item d-lg-none"><a class="nav-link text-white py-1" href="{{ url('/profile-settings') }}"><i class="bi bi-gear me-2"></i>Account Settings</a></li>
          @endif
          <li class="nav-item d-lg-none mt-2 pt-2 border-top border-secondary border-opacity-10">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="nav-link text-danger border-0 bg-transparent py-1 w-100 text-start d-flex align-items-center">
                <i class="bi bi-box-arrow-right me-2 fs-5"></i><span>Log Out</span>
              </button>
            </form>
          </li>
        @endguest
      </ul>

      <!-- Desktop Header Actions (Search, Cart & User Dropdown) -->
      <div class="d-none d-lg-flex align-items-center flex-wrap gap-2 gap-sm-3 mt-3 mt-lg-0">
        <div class="header-search d-none d-xl-flex">
          <i class="bi bi-search"></i>
          <input aria-label="Search photos, people, teams or events" placeholder="Search photos, people, teams or events..." type="search">
        </div>
        <a class="header-cart" href="{{ url('/cart') }}" aria-label="Open cart">
          <i class="bi bi-cart3"></i><span>0</span>
        </a>

        @guest
          <a class="btn btn-outline-light rounded-pill px-3 py-2 fw-semibold text-white d-inline-flex align-items-center gap-1" href="{{ route('login') }}" style="border-color: rgba(255,255,255,0.35);">
            <i class="bi bi-person"></i>
            <span>Login</span>
          </a>
          <a class="btn btn-lime rounded-pill px-3 px-sm-4 py-2 fw-semibold d-inline-flex align-items-center gap-1" href="{{ route('signup') }}">
            <span>Sign Up</span> <i class="bi bi-arrow-up-right ms-1"></i>
          </a>
        @else
          <div class="dropdown position-relative" id="userHeaderDropdownWrap">
            <button class="btn btn-dark rounded-pill px-3 py-1 d-flex align-items-center gap-2 user-menu-pill" type="button" id="desktopUserDropdown" aria-expanded="false" style="border: 1px solid rgba(255,255,255,0.25); background: #1e293b; color: #fff; cursor: pointer;">
              <i class="bi bi-person-circle fs-5 text-warning"></i>
              <span class="small fw-semibold">{{ Auth::user()->name }}</span>
              <span class="badge {{ Auth::user()->role === 'admin' ? 'bg-danger' : (Auth::user()->role === 'photographer' ? 'bg-info text-dark' : 'bg-secondary') }} text-uppercase" style="font-size: 0.65rem;">
                {{ Auth::user()->role }}
              </span>
              <i class="bi bi-chevron-down small text-white-50 ms-1"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-lg mt-2 py-2 user-header-menu" id="desktopUserDropdownMenu" style="min-width: 230px; display: none; position: absolute; right: 0; top: 100%; z-index: 999999;">
              <li>
                <div class="px-3 py-2 border-bottom border-secondary border-opacity-25">
                  <small class="text-white-50 d-block" style="font-size: 0.72rem;">Signed in as</small>
                  <strong class="text-truncate d-block text-white" style="font-size: 0.85rem;">{{ Auth::user()->email }}</strong>
                </div>
              </li>
              <li><div class="dropdown-header text-uppercase text-white-50 px-3 pt-2 pb-1" style="font-size: 0.65rem; letter-spacing: 0.05em;">Portals &amp; Dashboards</div></li>
              @if(Auth::user()->role === 'admin')
                <li><a class="dropdown-item py-2" href="{{ url('/admin') }}"><i class="bi bi-speedometer2 me-2 text-danger"></i>Admin Control Panel</a></li>
                <li><a class="dropdown-item py-2" href="{{ url('/photographer-dashboard') }}"><i class="bi bi-camera me-2 text-info"></i>Creator Studio (Photographer)</a></li>
                <li><a class="dropdown-item py-2" href="{{ url('/customer-dashboard') }}"><i class="bi bi-grid me-2 text-primary"></i>Customer Dashboard</a></li>
              @elseif(Auth::user()->role === 'photographer')
                <li><a class="dropdown-item py-2" href="{{ url('/photographer-dashboard') }}"><i class="bi bi-speedometer me-2 text-info"></i>Creator Studio</a></li>
                <li><a class="dropdown-item py-2" href="{{ url('/photographer-upload-new') }}"><i class="bi bi-cloud-arrow-up me-2 text-success"></i>Upload Photos</a></li>
                <li><a class="dropdown-item py-2" href="{{ url('/photographer-gallery') }}"><i class="bi bi-images me-2 text-primary"></i>My Galleries</a></li>
                <li><a class="dropdown-item py-2" href="{{ url('/photographer-payouts') }}"><i class="bi bi-bank me-2 text-warning"></i>Payouts &amp; Bank</a></li>
                <li><a class="dropdown-item py-2" href="{{ url('/photographer-profile') }}"><i class="bi bi-person-badge me-2 text-info"></i>Creator Profile</a></li>
              @else
                <li><a class="dropdown-item py-2" href="{{ url('/customer-dashboard') }}"><i class="bi bi-grid me-2 text-primary"></i>My Dashboard</a></li>
                <li><a class="dropdown-item py-2" href="{{ url('/orders-downloads') }}"><i class="bi bi-download me-2 text-success"></i>My Downloads</a></li>
                <li><a class="dropdown-item py-2" href="{{ url('/my-photos') }}"><i class="bi bi-heart me-2 text-danger"></i>Saved Photos</a></li>
                <li><a class="dropdown-item py-2" href="{{ url('/saved-events') }}"><i class="bi bi-bookmark-star me-2 text-warning"></i>Saved Events</a></li>
                <li><a class="dropdown-item py-2" href="{{ url('/profile-settings') }}"><i class="bi bi-gear me-2"></i>Account Settings</a></li>
                <li><hr class="dropdown-divider my-1"></li>
                <li><a class="dropdown-item py-2 text-info" href="{{ url('/signup') }}"><i class="bi bi-camera me-2"></i>Become a Photographer</a></li>
              @endif
              <li><hr class="dropdown-divider my-1 border-secondary border-opacity-25"></li>
              <li>
                <form action="{{ route('logout') }}" method="POST" class="d-block m-0 p-0">
                  @csrf
                  <button type="submit" class="dropdown-item text-danger py-2 w-100 text-start d-flex align-items-center fw-semibold" style="cursor: pointer;">
                    <i class="bi bi-box-arrow-right me-2 fs-6"></i><span>Log Out</span>
                  </button>
                </form>
              </li>
            </ul>
          </div>
        @endguest
      </div>
    </div>
  </div>
</nav>

<style>
  /* Header Dropdown Styling and High Z-Index */
  .user-header-menu {
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    background-color: #0f172a !important;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.7) !important;
    border-radius: 12px !important;
  }
  .user-header-menu.show-menu {
    display: block !important;
  }
  .user-header-menu .dropdown-item {
    color: #e2e8f0 !important;
    font-size: 0.88rem !important;
    padding: 0.55rem 1.1rem !important;
    transition: background-color 0.15s ease, color 0.15s ease;
  }
  .user-header-menu .dropdown-item:hover,
  .user-header-menu .dropdown-item:focus {
    background-color: #1e293b !important;
    color: #ffffff !important;
  }
</style>

<script>
  // Robust vanilla click toggle for user profile dropdown
  (function() {
    function initUserDropdown() {
      const btn = document.getElementById('desktopUserDropdown');
      const menu = document.getElementById('desktopUserDropdownMenu');
      if (!btn || !menu) return;

      btn.addEventListener('click', function(e) {
        e.stopPropagation();
        e.preventDefault();
        const isOpen = menu.classList.contains('show-menu');
        if (isOpen) {
          menu.classList.remove('show-menu');
          btn.setAttribute('aria-expanded', 'false');
        } else {
          menu.classList.add('show-menu');
          btn.setAttribute('aria-expanded', 'true');
        }
      });

      document.addEventListener('click', function(e) {
        if (!e.target.closest('#userHeaderDropdownWrap')) {
          menu.classList.remove('show-menu');
          btn.setAttribute('aria-expanded', 'false');
        }
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initUserDropdown);
    } else {
      initUserDropdown();
    }
  })();
</script>
