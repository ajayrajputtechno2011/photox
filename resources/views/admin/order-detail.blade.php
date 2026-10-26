<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<title>PhotoX Admin | Order Detail</title>
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
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
						<a class="breadcrumb-muted" href="/admin/orders">Orders</a><i class="bi bi-chevron-right"></i><strong>#PX-2098</strong>
					</div>
				</div>
				<div class="topbar-actions">
					<button aria-label="Notifications" class="icon-button notification-button" type="button"><i class="bi bi-bell"></i><span></span></button>
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
						<p class="eyebrow">Order detail</p>
						<h1>#{{ $order->order_number }}</h1>
						<p class="intro-copy">Placed {{ $order->created_at ? $order->created_at->format('d M Y \a\t h:i A') : 'N/A' }} by {{ $order->customer_name ?: 'Customer' }}.</p>
					</div>
					<div class="detail-actions d-flex gap-2 align-items-center">
						<a class="btn btn-outline-light" href="{{ route('admin.orders.index') }}"><i class="bi bi-arrow-left"></i> Back to orders</a>
						@if($order->payment_status !== 'refunded')
							<form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Mark this order as refunded?');">
								@csrf
								<input type="hidden" name="payment_status" value="refunded">
								<button class="btn btn-outline-danger" type="submit"><i class="bi bi-arrow-counterclockwise"></i> Mark Refunded</button>
							</form>
						@else
							<form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="d-inline">
								@csrf
								<input type="hidden" name="payment_status" value="completed">
								<button class="btn btn-outline-success" type="submit"><i class="bi bi-check-circle"></i> Restore Paid</button>
							</form>
						@endif
					</div>
				</div>

				@if(session('success'))
					<div class="alert alert-success alert-dismissible fade show rounded-3 my-3" role="alert">
						<i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				@endif

				<section class="ops-hero">
					<div class="ops-detail-hero">
						<span class="ops-hero-icon"><i class="bi bi-receipt"></i></span>
						<div>
							<h2>Order #{{ $order->order_number }}</h2>
							<p>{{ $order->items->first()?->event?->title ?? 'Digital Photo Purchase' }} · {{ $order->items->count() }} {{ Str::plural('item', $order->items->count()) }}</p>
						</div>
					</div>
					@if(in_array($order->payment_status, ['paid', 'completed']))
						<span class="ops-pill green"><i class="bi bi-check-circle"></i> Paid</span>
					@elseif($order->payment_status === 'pending')
						<span class="ops-pill blue">Pending</span>
					@elseif($order->payment_status === 'refunded')
						<span class="ops-pill orange">Refunded</span>
					@else
						<span class="ops-pill red">{{ ucfirst($order->payment_status) }}</span>
					@endif
				</section>
				<div class="ops-grid-2">
					<section class="ops-panel">
						<div class="section-heading">
							<div>
								<p class="eyebrow">Purchased items</p>
								<h3>Gallery and fulfilment</h3>
							</div>
							@if($order->items->first()?->event_id)
								<a class="view-link" href="{{ route('events.show', $order->items->first()->event_id) }}" target="_blank">Open gallery <i class="bi bi-arrow-up-right"></i></a>
							@endif
						</div>
						<div class="ops-table-wrap">
							<table class="table ops-table">
								<thead>
									<tr>
										<th>Item / Photo</th>
										<th>License</th>
										<th>Event</th>
										<th>Price</th>
									</tr>
								</thead>
								<tbody>
									@forelse($order->items as $item)
										<tr>
											<td>
												<div class="d-flex align-items-center gap-2">
													@php
														$thumbSrc = null;
														$rawPath = $item->photo?->watermarked_path ?: ($item->photo?->file_path ?: $item->file_path);
														if ($rawPath) {
															if (str_starts_with($rawPath, 'http://') || str_starts_with($rawPath, 'https://')) {
																$thumbSrc = $rawPath;
															} elseif (str_starts_with($rawPath, '/uploads/')) {
																$thumbSrc = $rawPath;
															} else {
																$thumbSrc = asset('storage/' . ltrim($rawPath, '/'));
															}
														}
													@endphp
													@if($thumbSrc)
														<img src="{{ $thumbSrc }}" alt="Photo" class="rounded-2" style="width: 48px; height: 36px; object-fit: cover;" onerror="this.onerror=null; this.src='/logo.png';">
													@else
														<div class="rounded-2 bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 48px; height: 36px; font-size: 11px;">PX</div>
													@endif
													<div>
														<strong>{{ $item->title ?: ($item->photo->file_name ?? 'Photo Item #' . $item->id) }}</strong>
														<br>
														<small class="text-muted">Digital Download</small>
													</div>
												</div>
											</td>
											<td><span class="ops-pill blue">{{ ucfirst($item->license_type ?? 'Standard') }}</span></td>
											<td><small>{{ $item->event?->title ?? 'PhotoX Event' }}</small></td>
											<td><strong>R {{ number_format($item->price, 2) }}</strong></td>
										</tr>
									@empty
										<tr>
											<td colspan="4" class="text-center py-3 text-muted">No line items in this order.</td>
										</tr>
									@endforelse
								</tbody>
							</table>
						</div>
						<div class="ops-info-grid">
							<div class="ops-info-item">
								<span>Subtotal</span><strong>R {{ number_format($order->total_amount, 2) }}</strong>
							</div>
							<div class="ops-info-item">
								<span>Payment Gateway</span><strong>{{ strtoupper($order->payment_gateway ?? 'Yoco') }}</strong>
							</div>
							<div class="ops-info-item">
								<span>Fulfilment</span><strong>Digital Vault (Instant)</strong>
							</div>
							<div class="ops-info-item">
								<span>Total paid</span><strong>R {{ number_format($order->total_amount, 2) }}</strong>
							</div>
						</div>
					</section>
					<aside class="ops-panel">
						<div class="section-heading">
							<div>
								<p class="eyebrow">Customer</p>
								<h3>{{ $order->customer_name ?: 'Guest Buyer' }}</h3>
							</div><span class="ops-avatar">{{ strtoupper(substr($order->customer_name ?: 'CU', 0, 2)) }}</span>
						</div>
						<div class="ops-info-grid">
							<div class="ops-info-item">
								<span>Email</span><strong>{{ $order->customer_email }}</strong>
							</div>
							<div class="ops-info-item">
								<span>Transaction ID</span><strong><small>{{ $order->transaction_id ?: 'Direct Checkout' }}</small></strong>
							</div>
							<div class="ops-info-item">
								<span>Payment gateway</span><strong>{{ strtoupper($order->payment_gateway ?? 'Yoco') }}</strong>
							</div>
							<div class="ops-info-item">
								<span>Payment status</span>
								<strong>
									@if(in_array($order->payment_status, ['paid', 'completed']))
										<span class="ops-pill green">Paid</span>
									@else
										<span class="ops-pill orange">{{ ucfirst($order->payment_status) }}</span>
									@endif
								</strong>
							</div>
						</div>
						@if($order->user_id)
							<div class="detail-actions">
								<a class="btn btn-outline-light" href="{{ route('admin.customers.show', $order->user_id) }}"><i class="bi bi-person"></i> Customer profile</a>
							</div>
						@endif
					</aside>
				</div>
				<section class="ops-panel mt-3">
					<div class="section-heading">
						<div>
							<p class="eyebrow">Order history</p>
							<h3>Audit timeline</h3>
						</div>
					</div>
					<div class="ops-timeline">
						<div>
							<i class="bi bi-check2-circle"></i><span><strong>Payment captured</strong><small>Visa payment authorised successfully</small></span><time>10:12 AM</time>
						</div>
						<div>
							<i class="bi bi-box-seam"></i><span><strong>Order sent to fulfilment</strong><small>Digital delivery ready; print set queued</small></span><time>10:13 AM</time>
						</div>
						<div>
							<i class="bi bi-person-check"></i><span><strong>Order reviewed by Alex Lee</strong><small>Admin verification complete</small></span><time>10:16 AM</time>
						</div>
					</div>
				</section>
			</main>
		</div>
	</div>
	<div class="sidebar-backdrop" id="sidebarBackdrop"></div>
	<script src="{{ asset('admin-assets/js/app.js') }}">
	</script>
</body>
</html>