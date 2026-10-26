<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<title>PhotoX Admin | Orders</title>
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
	<link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet">
</head>
<body>
	<div class="app-shell">
		@include('admin.partials.sidebar')
		<div class="main-panel">
			<header class="topbar">
				<div class="d-flex align-items-center gap-3">
					<button aria-controls="sidebar" aria-expanded="false" aria-label="Open navigation" class="icon-button menu-trigger" id="menuToggle" type="button"><i class="bi bi-list"></i></button>
					<div class="breadcrumb-wrap">
						<span class="breadcrumb-muted">Admin</span><i class="bi bi-chevron-right"></i><strong>Orders</strong>
					</div>
				</div>
				<div class="topbar-actions">
					<button aria-label="Search" class="icon-button" type="button"><i class="bi bi-search"></i></button><button aria-label="Notifications" class="icon-button notification-button" type="button"><i class="bi bi-bell"></i><span></span></button>
					<div class="topbar-divider"></div>
					<div class="profile-menu-wrap">
						<button class="profile-button" type="button" aria-haspopup="true" aria-expanded="false"><span class="profile-avatar">AL</span><span class="profile-copy"><strong>Alex Lee</strong><small>Administrator</small></span><i class="bi bi-chevron-down"></i></button>
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
				<div class="page-intro d-flex align-items-end justify-content-between gap-3 flex-wrap">
					<div>
						<p class="eyebrow">Marketplace commerce</p>
						<h1>Orders</h1>
						<p class="intro-copy">Review purchases, payment status, fulfilment and customer order activity.</p>
					</div>
				</div>
				<section class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 g-3 mb-3">
					<div class="col">
						<article class="ops-stat h-100">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-bag-check"></i></span>
							</div>
							<p>Total orders</p>
							<h2>{{ number_format($stats['total_orders'] ?? 0) }}</h2>
							<small>{{ request()->filled('date_range') ? ucfirst(str_replace('_', ' ', request('date_range'))) : 'All time purchases' }}</small>
						</article>
					</div>
					<div class="col">
						<article class="ops-stat h-100">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-currency-dollar"></i></span>
							</div>
							<p>Gross sales</p>
							<h2>R {{ number_format($stats['gross_sales'] ?? 0, 2) }}</h2>
							<small>Customer payments</small>
						</article>
					</div>
					<div class="col">
						<article class="ops-stat h-100" style="border-top: 2px solid #0dcaf0;">
							<div class="ops-stat-top">
								<span class="ops-stat-icon text-info"><i class="bi bi-pie-chart-fill"></i></span>
							</div>
							<p>Platform comm</p>
							<h2 class="text-info">R {{ number_format($stats['platform_commission'] ?? 0, 2) }}</h2>
							<small>PhotoX net revenue</small>
						</article>
					</div>
					<div class="col">
						<article class="ops-stat h-100" style="border-top: 2px solid #20c997;">
							<div class="ops-stat-top">
								<span class="ops-stat-icon text-success"><i class="bi bi-wallet2"></i></span>
							</div>
							<p>Creator payouts</p>
							<h2 class="text-success">R {{ number_format($stats['photographer_net'] ?? 0, 2) }}</h2>
							<small>Net photographer share</small>
						</article>
					</div>
					<div class="col">
						<article class="ops-stat h-100">
							<div class="ops-stat-top">
								<span class="ops-stat-icon"><i class="bi bi-images"></i></span>
							</div>
							<p>Total items sold</p>
							<h2>{{ number_format($stats['total_items_sold'] ?? 0) }}</h2>
							<small>Photos &amp; licenses</small>
						</article>
					</div>
				</section>
				<section class="ops-table-panel">
					<div>
						<p class="eyebrow">Order management</p>
						<h3>Marketplace orders</h3>
					</div>
					<form method="GET" action="{{ route('admin.orders.index') }}" class="ops-toolbar d-flex flex-wrap align-items-center gap-2" id="ordersFilterForm">
						<div class="search-field flex-grow-1" style="min-width: 220px;">
							<i class="bi bi-search"></i>
							<input name="search" value="{{ request('search') }}" aria-label="Search orders" placeholder="Search order ID, customer or email..." type="search">
						</div>

						<select name="date_range" aria-label="Filter date range" class="management-select" onchange="handleDateRangeChange(this)">
							<option value="">All Dates (All Time)</option>
							<option value="today" {{ request('date_range') === 'today' ? 'selected' : '' }}>Today</option>
							<option value="yesterday" {{ request('date_range') === 'yesterday' ? 'selected' : '' }}>Yesterday</option>
							<option value="this_week" {{ request('date_range') === 'this_week' ? 'selected' : '' }}>This Week</option>
							<option value="this_month" {{ request('date_range') === 'this_month' ? 'selected' : '' }}>This Month</option>
							<option value="last_30" {{ request('date_range') === 'last_30' ? 'selected' : '' }}>Last 30 Days</option>
							<option value="custom" {{ request('date_range') === 'custom' || request()->filled('date_from') ? 'selected' : '' }}>Custom Date Range...</option>
						</select>

						<div id="customDateWrap" class="d-flex align-items-center gap-1 {{ request('date_range') === 'custom' || request()->filled('date_from') ? '' : 'd-none' }}">
							<input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control form-control-sm bg-dark text-white border-secondary" style="font-size: 0.78rem; width: 130px;" title="From date">
							<span class="text-white-50 small">to</span>
							<input type="date" name="date_to" value="{{ request('date_to') }}" class="form-control form-control-sm bg-dark text-white border-secondary" style="font-size: 0.78rem; width: 130px;" title="To date">
							<button type="submit" class="btn btn-sm btn-primary-px px-2" style="font-size: 0.75rem;">Apply</button>
						</div>

						<select name="payment_status" aria-label="Filter payment status" class="management-select" onchange="this.form.submit()">
							<option value="">All payment statuses</option>
							<option value="paid" {{ request('payment_status') === 'paid' ? 'selected' : '' }}>Paid / Completed</option>
							<option value="pending" {{ request('payment_status') === 'pending' ? 'selected' : '' }}>Pending</option>
							<option value="failed" {{ request('payment_status') === 'failed' ? 'selected' : '' }}>Failed</option>
							<option value="refunded" {{ request('payment_status') === 'refunded' ? 'selected' : '' }}>Refunded</option>
						</select>

						@if(request()->anyFilled(['search', 'payment_status', 'date_range', 'date_from', 'date_to']))
							<a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">Reset</a>
						@endif
					</form>
					<div class="ops-table-wrap">
						<table class="table ops-table">
							<thead>
								<tr>
									<th>Order</th>
									<th>Customer</th>
									<th>Event / Photos</th>
									<th>Amount</th>
									<th>Payment</th>
									<th>Fulfilment</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@forelse($orders as $ord)
									<tr>
										<td>
											<strong>#{{ $ord->order_number }}</strong>
											<br>
											<small class="text-muted">{{ $ord->created_at ? $ord->created_at->format('d M Y · h:i A') : 'N/A' }}</small>
										</td>
										<td>
											<div class="ops-person">
												<span class="ops-avatar">{{ strtoupper(substr($ord->customer_name ?: 'CU', 0, 2)) }}</span>
												<span>
													<strong>{{ $ord->customer_name ?: 'Guest Customer' }}</strong>
													<small>{{ $ord->customer_email }}</small>
												</span>
											</div>
										</td>
										<td>
											@php
												$firstItem = $ord->items->first();
												$eventTitle = $firstItem?->event?->title ?? $firstItem?->title ?? 'Photo Purchase';
												$itemCount = $ord->items->count();
											@endphp
											<strong>{{ Str::limit($eventTitle, 35) }}</strong>
											<br>
											<small class="text-muted">{{ $itemCount }} {{ Str::plural('photo', $itemCount) }}</small>
										</td>
										<td>
											@php
												$orderComm = 0;
												foreach ($ord->items as $item) {
													$ph = $item->photo?->photographer ?: $item->event?->photographer;
													$r = $ph ? (float) str_replace('%', '', $ph->effective_commission_rate ?: '15') : 15;
													$orderComm += round(((float) $item->price) * ($r / 100), 2);
												}
												if ($ord->items->isEmpty()) {
													$orderComm = round(((float) $ord->total_amount) * 0.15, 2);
												}
											@endphp
											<strong>R {{ number_format($ord->total_amount, 2) }}</strong>
											<br>
											<small class="text-info" title="Platform Commission">Comm: R {{ number_format($orderComm, 2) }}</small>
										</td>
										<td>
											@if(in_array($ord->payment_status, ['paid', 'completed']))
												<span class="ops-pill green"><i class="bi bi-check-circle"></i> Paid</span>
											@elseif($ord->payment_status === 'pending')
												<span class="ops-pill blue">Pending</span>
											@elseif($ord->payment_status === 'refunded')
												<span class="ops-pill orange">Refunded</span>
											@else
												<span class="ops-pill red"><i class="bi bi-x-circle"></i> {{ ucfirst($ord->payment_status) }}</span>
											@endif
										</td>
										<td>
											<span class="ops-pill green"><i class="bi bi-cloud-arrow-down"></i> Ready (Vault)</span>
										</td>
										<td>
											<div class="ops-actions">
												<a aria-label="Open order" class="row-action" href="{{ route('admin.orders.show', $ord->id) }}" title="View Order Details"><i class="bi bi-eye"></i></a>
											</div>
										</td>
									</tr>
								@empty
									<tr>
										<td colspan="7" class="text-center py-5">
											<div class="text-muted">
												<i class="bi bi-bag-x fs-1 d-block mb-2 text-secondary"></i>
												<p class="mb-0 fs-6">No marketplace orders found.</p>
											</div>
										</td>
									</tr>
								@endforelse
							</tbody>
						</table>
					</div>
					<div class="mt-3">
						{{ $orders->links() }}
					</div>
				</section>
			</main>
		</div>
	</div>
	<div class="sidebar-backdrop" id="sidebarBackdrop"></div>
	<script src="{{ asset('admin-assets/js/app.js') }}"></script>
	<script>
		function handleDateRangeChange(select) {
			const customWrap = document.getElementById('customDateWrap');
			if (select.value === 'custom') {
				customWrap.classList.remove('d-none');
			} else {
				customWrap.classList.add('d-none');
				select.form.submit();
			}
		}
	</script>
</body>
</html>