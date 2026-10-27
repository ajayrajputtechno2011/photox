<aside class="sidebar" id="sidebar" aria-label="Main navigation">
  <div class="sidebar-inner">
    <a class="brand" href="/admin/dashboard" aria-label="PhotoX Admin home">
      <img class="brand-logo" src="{{ asset('admin-assets/logo.png') }}" alt="PhotoX Admin">
    </a>
    <div class="workspace-switcher">
      <span class="workspace-avatar">PS</span>
      <span class="workspace-copy"><small>Workspace</small><strong>Photo Studio</strong></span>
      <i class="bi bi-chevron-down"></i>
    </div>
    
    <a class="dashboard-link nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="/admin/dashboard">
      <i class="bi bi-grid-1x2-fill"></i><span>Dashboard</span>
    </a>
    
    <div class="nav-label nav-label-spaced">Marketplace</div>
    <nav class="nav flex-column sidebar-nav">
      <a class="nav-link {{ request()->is('admin/events*', 'admin/admin-events*') ? 'active' : '' }}" href="/admin/events"><i class="bi bi-calendar-event"></i><span>Events</span></a>
      <a class="nav-link {{ request()->is('admin/galleries*', 'admin/admin-galleries*', 'admin/gallery-detail*') ? 'active' : '' }}" href="/admin/galleries"><i class="bi bi-collection"></i><span>Galleries</span></a>
      <a class="nav-link {{ request()->is('admin/images*', 'admin/admin-images*') ? 'active' : '' }}" href="/admin/images"><i class="bi bi-image"></i><span>Images</span></a>
      <a class="nav-link {{ request()->is('admin/orders*', 'admin/order-detail*') ? 'active' : '' }}" href="/admin/orders"><i class="bi bi-bag-check"></i><span>Orders</span></a>
      <a class="nav-link {{ request()->is('admin/customers*') ? 'active' : '' }}" href="/admin/customers"><i class="bi bi-people"></i><span>Customers</span></a>
    </nav>
    
    <div class="nav-label nav-label-spaced">Photographers</div>
    <nav class="nav flex-column sidebar-nav">
      <a class="nav-link {{ request()->is('admin/photographers*') ? 'active' : '' }}" href="/admin/photographers"><i class="bi bi-camera2"></i><span>Photographers</span></a>
      <a class="nav-link {{ request()->is('admin/memberships*') ? 'active' : '' }}" href="/admin/memberships"><i class="bi bi-person-vcard"></i><span>Memberships</span></a>
      <a class="nav-link {{ request()->is('admin/commissions*') ? 'active' : '' }}" href="/admin/commissions"><i class="bi bi-percent"></i><span>Commissions</span></a>
      <a class="nav-link {{ request()->is('admin/payouts*') ? 'active' : '' }}" href="/admin/payouts"><i class="bi bi-wallet2"></i><span>Payouts</span></a>
    </nav>

    <div class="nav-label nav-label-spaced">AI &amp; Media</div>
    <nav class="nav flex-column sidebar-nav">
      <a class="nav-link {{ request()->is('admin/ai-processing*') ? 'active' : '' }}" href="/admin/ai-processing"><i class="bi bi-stars"></i><span>AI Processing</span></a>
      <a class="nav-link {{ request()->is('admin/media*') ? 'active' : '' }}" href="/admin/media"><i class="bi bi-images"></i><span>Media Manager</span></a>
      <a class="nav-link {{ request()->is('admin/storage*') ? 'active' : '' }}" href="/admin/storage"><i class="bi bi-cloud-arrow-up"></i><span>Storage</span></a>
      <a class="nav-link {{ request()->is('admin/watermarks*', 'admin/watermark*') ? 'active' : '' }}" href="/admin/watermarks"><i class="bi bi-droplet"></i><span>Watermarks</span></a>
    </nav>

    <div class="nav-label nav-label-spaced">Business</div>
    <nav class="nav flex-column sidebar-nav">
      <a class="nav-link {{ request()->is('admin/payments*') ? 'active' : '' }}" href="/admin/payments"><i class="bi bi-credit-card"></i><span>Payments</span></a>
      <a class="nav-link {{ request()->is('admin/coupons*') ? 'active' : '' }}" href="/admin/coupons-discounts"><i class="bi bi-tags"></i><span>Coupons &amp; Discounts</span></a>
      <a class="nav-link {{ request()->is('admin/sponsors*') ? 'active' : '' }}" href="/admin/sponsors"><i class="bi bi-award"></i><span>Sponsors</span></a>
      <a class="nav-link {{ request()->is('admin/banners*') ? 'active' : '' }}" href="/admin/banners"><i class="bi bi-layout-text-window"></i><span>Banners</span></a>
    </nav>

    <div class="nav-label nav-label-spaced">Organisations</div>
    <nav class="nav flex-column sidebar-nav">
      <a class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}" href="/admin/categories"><i class="bi bi-tags"></i><span>Categories</span></a>
      <a class="nav-link {{ request()->is('admin/schools*') ? 'active' : '' }}" href="/admin/schools"><i class="bi bi-mortarboard"></i><span>Schools</span></a>
      <a class="nav-link {{ request()->is('admin/companies*') ? 'active' : '' }}" href="/admin/companies"><i class="bi bi-buildings"></i><span>Companies</span></a>
    </nav>

    <div class="nav-label nav-label-spaced">Content</div>
    <nav class="nav flex-column sidebar-nav">
      <a class="nav-link {{ request()->is('admin/page-banners*') ? 'active' : '' }}" href="/admin/page-banners"><i class="bi bi-card-heading"></i><span>Page Banners</span></a>
      <a class="nav-link {{ request()->is('admin/legal-pages*') ? 'active' : '' }}" href="/admin/legal-pages"><i class="bi bi-shield-check"></i><span>Legal &amp; POPIA</span></a>
      <a class="nav-link {{ request()->is('admin/faqs*') ? 'active' : '' }}" href="/admin/faqs"><i class="bi bi-question-circle"></i><span>FAQs</span></a>
      <a class="nav-link {{ request()->is('admin/news*', 'admin/blog*') ? 'active' : '' }}" href="/admin/news"><i class="bi bi-pencil-square"></i><span>Blog &amp; News</span></a>
      <a class="nav-link {{ request()->is('admin/announcements*') ? 'active' : '' }}" href="/admin/announcements"><i class="bi bi-megaphone"></i><span>Announcements</span></a>
      <a class="nav-link {{ request()->is('admin/messages*') ? 'active' : '' }}" href="/admin/messages"><i class="bi bi-chat-left-text"></i><span>Messages</span></a>
      <a class="nav-link {{ request()->is('admin/notifications*') ? 'active' : '' }}" href="/admin/notifications"><i class="bi bi-bell"></i><span>Notifications</span></a>
      <a class="nav-link {{ request()->is('admin/email-templates*') ? 'active' : '' }}" href="/admin/email-templates"><i class="bi bi-envelope-paper"></i><span>Email Templates</span></a>
    </nav>

    <div class="nav-label nav-label-spaced">Reporting</div>
    <nav class="nav flex-column sidebar-nav">
      <a class="nav-link {{ request()->is('admin/reports*') ? 'active' : '' }}" href="/admin/reports"><i class="bi bi-bar-chart"></i><span>Reports</span></a>
      <a class="nav-link {{ request()->is('admin/banner-analytics*') ? 'active' : '' }}" href="/admin/banner-analytics"><i class="bi bi-graph-up-arrow"></i><span>Banner Analytics</span></a>
    </nav>

    <div class="nav-label nav-label-spaced">System</div>
    <nav class="nav flex-column sidebar-nav">
      <a class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}" href="/admin/settings"><i class="bi bi-sliders2"></i><span>Settings</span></a>
      {{-- 
        =============================================================================
        [FUTURE FEATURE NOTE / TEMPORARILY HIDDEN PER CLIENT REQUEST]:
        Audit Logs menu item is hidden for now. Uncomment the block below to show it:
        
        <a class="nav-link {{ request()->is('admin/audit-logs*') ? 'active' : '' }}" href="/admin/audit-logs">
          <i class="bi bi-shield-check"></i><span>Audit Logs</span>
        </a>
        =============================================================================
      --}}
    </nav>
  </div>
</aside>
