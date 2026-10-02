<nav aria-label="Main navigation" class="navbar navbar-expand-lg py-2">
  <div class="container-xl">
    <a aria-label="PhotoX home" class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
      <img alt="PhotoX" src="{{ asset('logo.png') }}">
    </a>
    <button aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler border-0 p-0" data-bs-target="#mainNav" data-bs-toggle="collapse" type="button">
      <i class="bi bi-list fs-2"></i>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav mx-auto gap-lg-3 mt-3 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
        </li>
        {{-- Explore is hidden for now as homepage serves as Explore --}}
        {{--
        <li class="nav-item">
          <a class="nav-link {{ request()->is('events*') ? 'active' : '' }}" href="{{ url('/events') }}">Explore</a>
        </li>
        --}}
        <li class="nav-item">
          <a class="nav-link {{ request()->is('photographers*') ? 'active' : '' }}" href="{{ url('/photographers') }}">Photographers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('membership*') ? 'active' : '' }}" href="{{ url('/membership') }}">Membership</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('about*') ? 'active' : '' }}" href="{{ url('/about') }}">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('contact*') ? 'active' : '' }}" href="{{ url('/contact') }}">Contact</a>
        </li>
      </ul>
      <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
        <div class="header-search d-none d-xl-flex">
          <i class="bi bi-search"></i>
          <input aria-label="Search photos, people, teams or events" placeholder="Search photos, people, teams or events..." type="search">
        </div>
        <a class="header-cart" href="{{ url('/cart') }}" aria-label="Open cart">
          <i class="bi bi-cart3"></i><span>0</span>
        </a>

        @guest
          <a class="text-link d-none d-sm-inline" href="{{ route('login') }}">
            <i class="bi bi-person me-1"></i>Login
          </a>
          <a class="btn btn-lime rounded-pill px-4" href="{{ route('signup') }}">
            Sign Up <i class="bi bi-arrow-up-right ms-1"></i>
          </a>
        @else
          <div class="dropdown">
            <button class="btn btn-dark rounded-pill px-3 py-1 dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid rgba(255,255,255,0.2);">
              <i class="bi bi-person-circle fs-5 text-warning"></i>
              <span class="small fw-semibold">{{ Auth::user()->name }}</span>
              <span class="badge {{ Auth::user()->role === 'admin' ? 'bg-danger' : (Auth::user()->role === 'photographer' ? 'bg-info' : 'bg-secondary') }} text-uppercase" style="font-size: 0.65rem;">
                {{ Auth::user()->role }}
              </span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow mt-2" style="min-width: 200px;">
              <li>
                <div class="px-3 py-2 border-bottom">
                  <small class="text-muted d-block">Signed in as</small>
                  <strong class="text-truncate d-block">{{ Auth::user()->email }}</strong>
                </div>
              </li>
              @if(Auth::user()->role === 'admin')
                <li><a class="dropdown-item py-2" href="{{ url('/admin') }}"><i class="bi bi-speedometer2 me-2 text-danger"></i>Admin Panel</a></li>
              @elseif(Auth::user()->role === 'photographer')
                <li><a class="dropdown-item py-2" href="{{ url('/photographer-dashboard') }}"><i class="bi bi-camera me-2 text-info"></i>Creator Studio</a></li>
                <li><a class="dropdown-item py-2" href="{{ url('/photographer-earnings') }}"><i class="bi bi-wallet2 me-2 text-success"></i>Earnings & Payouts</a></li>
                <li><a class="dropdown-item py-2" href="{{ url('/photographer-gallery') }}"><i class="bi bi-images me-2"></i>My Galleries</a></li>
              @else
                <li><a class="dropdown-item py-2" href="{{ url('/customer-dashboard') }}"><i class="bi bi-grid me-2 text-primary"></i>My Dashboard</a></li>
                <li><a class="dropdown-item py-2" href="{{ url('/orders-downloads') }}"><i class="bi bi-download me-2 text-success"></i>My Downloads</a></li>
                <li><a class="dropdown-item py-2" href="{{ url('/my-photos') }}"><i class="bi bi-heart me-2 text-danger"></i>Saved Photos</a></li>
              @endif
              <li><a class="dropdown-item py-2" href="{{ url('/profile-settings') }}"><i class="bi bi-gear me-2"></i>Profile Settings</a></li>
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
    </div>
  </div>
</nav>
