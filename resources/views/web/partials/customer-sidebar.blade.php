@php
  $currentUser = $user ?? auth()->user();
  $sidebarSavedCount = $currentUser ? $currentUser->savedPhotos()->count() : 0;
  $sidebarDownloadsCount = $currentUser ? $currentUser->orderItems()->whereHas('order', fn ($q) => $q->where('payment_status', 'completed'))->count() : 0;
  $sidebarEventsCount = $currentUser ? $currentUser->savedEvents()->count() : 0;
  $currentTab = $activeTab ?? 'overview';
@endphp

<aside class="customer-sidebar-panel" aria-label="Customer Account Navigation">
  {{-- Customer Profile Card (Visible on desktop) --}}
  <div class="customer-user-badge-card d-none d-lg-block">
    <div class="customer-avatar-circle">
      {{ $currentUser ? strtoupper(substr($currentUser->name, 0, 2)) : 'PX' }}
    </div>
    <div class="customer-name text-truncate" title="{{ $currentUser?->name }}">{{ $currentUser?->name ?: 'Customer' }}</div>
    <div class="customer-email text-truncate" title="{{ $currentUser?->email }}">{{ $currentUser?->email ?: 'customer@photox.co.za' }}</div>
    <span class="customer-role-pill">
      <i class="bi bi-patch-check-fill"></i> Customer Account
    </span>
  </div>

  {{-- Navigation Links (Sleek Horizontal Scroll on Mobile, Vertical Stack on Desktop) --}}
  <nav class="customer-sidebar-nav" id="customerSidebarNav">
    <a class="customer-sidebar-link {{ $currentTab === 'overview' ? 'active' : '' }}" href="{{ route('customer.dashboard') }}">
      <i class="bi bi-grid-fill"></i>
      <span>Overview</span>
    </a>
    <a class="customer-sidebar-link {{ $currentTab === 'photos' ? 'active' : '' }}" href="{{ route('customer.my_photos') }}">
      <i class="bi bi-heart-fill"></i>
      <span>Saved Photos</span>
      <span class="customer-sidebar-count">{{ $sidebarSavedCount }}</span>
    </a>
    <a class="customer-sidebar-link {{ $currentTab === 'orders' ? 'active' : '' }}" href="{{ route('orders.downloads') }}">
      <i class="bi bi-bag-check-fill"></i>
      <span>Orders &amp; Downloads</span>
      <span class="customer-sidebar-count">{{ $sidebarDownloadsCount }}</span>
    </a>
    <a class="customer-sidebar-link {{ $currentTab === 'events' ? 'active' : '' }}" href="{{ route('customer.saved_events') }}">
      <i class="bi bi-bookmark-star-fill"></i>
      <span>Followed Events</span>
      <span class="customer-sidebar-count">{{ $sidebarEventsCount }}</span>
    </a>
    <a class="customer-sidebar-link {{ $currentTab === 'profile' ? 'active' : '' }}" href="{{ route('customer.profile') }}">
      <i class="bi bi-person-fill-gear"></i>
      <span>Profile &amp; Settings</span>
    </a>
  </nav>

  {{-- Sidebar Footer Actions (Desktop Only) --}}
  <div class="customer-sidebar-cta d-none d-lg-block">
    <a class="customer-find-btn" href="{{ url('/#find') }}">
      <i class="bi bi-search"></i>
      <span>Find My Photos</span>
    </a>

    <div class="customer-vault-box">
      <div class="d-flex align-items-center gap-2 mb-1">
        <i class="bi bi-shield-check text-success fs-5"></i>
        <strong>Protected Vault</strong>
      </div>
      <span>High-resolution unwatermarked photos are safely stored in your account.</span>
    </div>

    <form action="{{ route('logout') }}" method="POST" class="m-0">
      @csrf
      <button type="submit" class="customer-logout-btn">
        <i class="bi bi-box-arrow-left"></i>
        <span>Sign out</span>
      </button>
    </form>
  </div>
</aside>

<style>
  @media (max-width: 991.98px) {
    .customer-app .workspace-layout {
      grid-template-columns: 1fr !important;
      gap: 1rem !important;
      padding-top: 1rem !important;
    }
    .customer-sidebar-panel {
      position: static !important;
      top: auto !important;
      background: transparent !important;
      border: none !important;
      box-shadow: none !important;
      padding: 0 !important;
      margin-bottom: 0.5rem !important;
    }
    .customer-sidebar-nav {
      display: flex !important;
      flex-direction: row !important;
      flex-wrap: nowrap !important;
      overflow-x: auto !important;
      -webkit-overflow-scrolling: touch !important;
      gap: 0.5rem !important;
      padding: 4px 2px 8px 2px !important;
      scrollbar-width: none;
    }
    .customer-sidebar-nav::-webkit-scrollbar {
      display: none;
    }
    .customer-sidebar-link {
      white-space: nowrap !important;
      flex-shrink: 0 !important;
      padding: 0.55rem 0.95rem !important;
      font-size: 0.82rem !important;
      border-radius: 50px !important;
      background: #ffffff !important;
      border: 1px solid rgba(11, 45, 91, 0.1) !important;
      box-shadow: 0 2px 8px rgba(11, 45, 91, 0.04) !important;
    }
    .customer-sidebar-link.active {
      background: #0b2d5b !important;
      color: #ffffff !important;
      border-color: #0b2d5b !important;
      box-shadow: 0 4px 12px rgba(11, 45, 91, 0.2) !important;
    }
    .customer-sidebar-link.active i {
      color: #lime !important;
    }
  }
</style>
