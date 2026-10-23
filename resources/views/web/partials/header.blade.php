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
      <!-- Mobile Live Search Form -->
      <form action="{{ url('/events') }}" method="GET" class="d-xl-none my-3 px-1" role="search">
        <div class="position-relative d-flex align-items-center bg-white rounded-pill px-3 py-1 shadow-sm" style="height: 38px;">
          <i class="bi bi-search me-2 text-primary" style="font-size: 0.9rem;"></i>
          <input type="search" name="q" value="{{ request('q') }}" class="form-control border-0 bg-transparent p-0 shadow-none text-dark" placeholder="Search photos, people, teams or events..." style="font-size: 0.82rem;" autocomplete="off" aria-label="Search">
          <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3 py-1 ms-1 fw-semibold" style="font-size: 0.75rem;">Search</button>
        </div>
      </form>
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
        <form action="{{ url('/events') }}" method="GET" class="header-search d-none d-xl-flex position-relative m-0" id="topNavSearchForm" role="search" autocomplete="off">
          <button type="submit" class="border-0 bg-transparent p-0 d-flex align-items-center" style="cursor: pointer;" aria-label="Search">
            <i class="bi bi-search" style="font-size: 0.85rem; color: #0b2d5b;"></i>
          </button>
          <input aria-label="Search photos, people, teams or events" placeholder="Search photos, people, teams or events..." type="search" name="q" id="topNavSearchInput" value="{{ request('q') }}" autocomplete="off">
          <span id="topSearchSpinner" class="spinner-border spinner-border-sm text-primary d-none ms-auto" role="status" style="width: 13px; height: 13px; border-width: 2px;"></span>

          <!-- Dropdown Autocomplete Menu -->
          <div id="topSearchDropdown" class="top-search-dropdown shadow-lg d-none">
            <div id="topSearchResults"></div>
          </div>
        </form>
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

  /* Top Navigation Autocomplete Dropdown */
  .top-search-dropdown {
    position: absolute;
    top: calc(100% + 10px);
    left: 0;
    width: 380px;
    max-width: 92vw;
    max-height: 480px;
    overflow-y: auto;
    background: #0b1a29;
    border: 1px solid rgba(255, 255, 255, 0.18);
    border-radius: 14px;
    box-shadow: 0 18px 45px rgba(0, 0, 0, 0.7);
    z-index: 999999;
    padding: 0;
    font-size: 0.85rem;
    color: #fff;
  }
  .top-search-dropdown::-webkit-scrollbar {
    width: 6px;
  }
  .top-search-dropdown::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 4px;
  }
  .top-search-header {
    padding: 7px 14px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #8fa6c4;
    background: rgba(255, 255, 255, 0.04);
    border-bottom: 1px solid rgba(255, 255, 255, 0.06);
  }
  .top-search-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 14px;
    color: #e2e8f0;
    text-decoration: none;
    transition: background 0.15s ease, color 0.15s ease;
    border-bottom: 1px solid rgba(255, 255, 255, 0.04);
  }
  .top-search-item:hover,
  .top-search-item:focus {
    background: #172d47;
    color: #ffffff;
    text-decoration: none;
  }
  .top-search-thumb {
    width: 38px;
    height: 38px;
    border-radius: 8px;
    object-fit: cover;
    background: #1e3a5f;
    flex-shrink: 0;
  }
  .top-search-avatar {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    object-fit: cover;
    background: #1e3a5f;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }
  .top-search-footer-btn {
    display: block;
    width: 100%;
    padding: 10px 14px;
    text-align: center;
    background: rgba(13, 110, 253, 0.15);
    color: #60a5fa;
    font-weight: 600;
    font-size: 0.8rem;
    text-decoration: none;
    transition: background 0.15s ease;
  }
  .top-search-footer-btn:hover {
    background: #0d6efd;
    color: #fff;
    text-decoration: none;
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

    // Top Navigation Autocomplete Dropdown Logic
    function initTopSearch() {
      const input = document.getElementById('topNavSearchInput');
      const dropdown = document.getElementById('topSearchDropdown');
      const resultsContainer = document.getElementById('topSearchResults');
      const spinner = document.getElementById('topSearchSpinner');
      if (!input || !dropdown || !resultsContainer) return;

      let debounceTimer = null;
      let abortController = null;

      function renderResults(data, query) {
        if (!data || data.total === 0) {
          resultsContainer.innerHTML = `
            <div class="p-3 text-center text-white-50">
              <i class="bi bi-search text-white-50 d-block fs-4 mb-2"></i>
              <div class="small">No matches found for <strong class="text-white">"${escapeHtml(query)}"</strong></div>
              <div style="font-size: 0.75rem;" class="mt-1">Press <strong>Enter</strong> to search all events.</div>
            </div>
            <a href="{{ url('/events') }}?q=${encodeURIComponent(query)}" class="top-search-footer-btn">
              Search all events for "${escapeHtml(query)}" &rarr;
            </a>
          `;
          dropdown.classList.remove('d-none');
          return;
        }

        let html = '';

        // Events
        if (data.events && data.events.length > 0) {
          html += '<div class="top-search-header"><i class="bi bi-calendar-event me-1"></i> Events</div>';
          data.events.forEach(item => {
            const imgHtml = item.image 
              ? `<img src="${item.image}" alt="" class="top-search-thumb">` 
              : `<div class="top-search-thumb d-flex align-items-center justify-content-center text-white-50"><i class="bi bi-image"></i></div>`;
            const dateLoc = [item.date, item.location]
              .filter(Boolean)
              .map(val => escapeHtml(val))
              .join(' <span class="opacity-50">&bull;</span> ');
            html += `
              <a href="${item.url}" class="top-search-item">
                ${imgHtml}
                <div class="overflow-hidden flex-grow-1">
                  <div class="fw-semibold text-truncate text-white" style="font-size: 0.85rem;">${escapeHtml(item.title)}</div>
                  <div class="text-white-50 text-truncate" style="font-size: 0.72rem;">${dateLoc}</div>
                </div>
                ${item.category ? `<span class="badge bg-secondary bg-opacity-50 text-white-50 small ms-auto" style="font-size: 0.65rem;">${escapeHtml(item.category)}</span>` : ''}
              </a>
            `;
          });
        }

        // Photographers
        if (data.photographers && data.photographers.length > 0) {
          html += '<div class="top-search-header"><i class="bi bi-camera me-1"></i> Photographers</div>';
          data.photographers.forEach(p => {
            const avatarHtml = p.avatar 
              ? `<img src="${p.avatar}" alt="" class="top-search-avatar">` 
              : `<div class="top-search-avatar text-warning"><i class="bi bi-camera-fill" style="font-size: 0.85rem;"></i></div>`;
            html += `
              <a href="${p.url}" class="top-search-item">
                ${avatarHtml}
                <div class="overflow-hidden flex-grow-1">
                  <div class="fw-semibold text-truncate text-white" style="font-size: 0.85rem;">${escapeHtml(p.name)}</div>
                  <div class="text-white-50 text-truncate" style="font-size: 0.72rem;">${escapeHtml(p.specialty || 'Creator')}</div>
                </div>
                <span class="badge bg-info bg-opacity-25 text-info small ms-auto" style="font-size: 0.65rem;">Creator</span>
              </a>
            `;
          });
        }

        // Categories / Sports
        if (data.categories && data.categories.length > 0) {
          html += '<div class="top-search-header"><i class="bi bi-tag me-1"></i> Sports &amp; Categories</div>';
          data.categories.forEach(c => {
            html += `
              <a href="${c.url}" class="top-search-item">
                <div class="top-search-avatar text-info"><i class="bi bi-trophy"></i></div>
                <div class="fw-semibold text-truncate text-white flex-grow-1" style="font-size: 0.85rem;">${escapeHtml(c.name)}</div>
                <i class="bi bi-arrow-right text-white-50 small ms-auto"></i>
              </a>
            `;
          });
        }

        // View All Link
        html += `
          <a href="${data.view_all_url || ('{{ url('/events') }}?q=' + encodeURIComponent(query))}" class="top-search-footer-btn">
            View all results for "${escapeHtml(query)}" &rarr;
          </a>
        `;

        resultsContainer.innerHTML = html;
        dropdown.classList.remove('d-none');
      }

      function doSearch(query) {
        if (abortController) {
          abortController.abort();
        }
        abortController = new AbortController();

        if (spinner) spinner.classList.remove('d-none');

        fetch('{{ url('/api/quick-search') }}?q=' + encodeURIComponent(query), {
          signal: abortController.signal,
          headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
        .then(res => res.json())
        .then(data => {
          if (spinner) spinner.classList.add('d-none');
          renderResults(data, query);
        })
        .catch(err => {
          if (err.name === 'AbortError') return;
          if (spinner) spinner.classList.add('d-none');
        });
      }

      input.addEventListener('input', function() {
        const query = this.value.trim();
        clearTimeout(debounceTimer);
        if (query.length < 2) {
          dropdown.classList.add('d-none');
          if (spinner) spinner.classList.add('d-none');
          return;
        }
        debounceTimer = setTimeout(() => doSearch(query), 250);
      });

      input.addEventListener('focus', function() {
        const query = this.value.trim();
        if (query.length >= 2 && resultsContainer.innerHTML.trim() !== '') {
          dropdown.classList.remove('d-none');
        }
      });

      // Close dropdown on outside click
      document.addEventListener('click', function(e) {
        if (!e.target.closest('#topNavSearchForm')) {
          dropdown.classList.add('d-none');
        }
      });

      // Close on Escape
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
          dropdown.classList.add('d-none');
        }
      });

      function escapeHtml(str) {
        if (!str) return '';
        return String(str)
          .replace(/&/g, '&amp;')
          .replace(/</g, '&lt;')
          .replace(/>/g, '&gt;')
          .replace(/"/g, '&quot;')
          .replace(/'/g, '&#039;');
      }
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', function() {
        initUserDropdown();
        initTopSearch();
      });
    } else {
      initUserDropdown();
      initTopSearch();
    }
  })();
</script>
