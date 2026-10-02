@extends('web.layouts.app')

@section('title', 'PhotoX | Cart')
@section('body-class', 'page-cart')

@section('content')
  <main class="cart-page-main">
    <section class="cart-hero">
      @include('web.partials.hero-ad-carousel')
      <div class="container-xl">
        <div class="hero-intro-col">
          <span class="section-kicker">YOUR CART</span>
          <h1>Keep the moments<br><em>you want to take home.</em></h1>
          <p>Your selected digital photos will appear here. Cart count is currently ready for the development flow.</p>
        </div>
      </div>
    </section>

    <section class="cart-section">
      <div class="container-xl cart-layout">
        <div class="cart-list-card">
          <div class="cart-section-heading"><div><span class="panel-label">PHOTO SELECTION</span><h2>Your cart is empty</h2></div><span class="cart-count-label">0 items</span></div>
          <div class="cart-empty-state"><i class="bi bi-cart3"></i><h3>No photos added yet</h3><p>Browse an event gallery and use the cart icon on any photo to start your selection.</p><a class="btn btn-lime rounded-pill px-4" href="/browse-photos">Browse photos <i class="bi bi-arrow-right ms-2"></i></a></div>
        </div>
        <aside class="cart-summary-card">
          <span class="panel-label">ORDER SUMMARY</span>
          <h2>Ready when you are.</h2>
          <div class="summary-line"><span>Photos</span><strong>0</strong></div>
          <div class="summary-line"><span>Subtotal</span><strong>R0</strong></div>
          <div class="summary-total"><span>Total</span><strong>R0</strong></div>
          <a class="btn btn-lime rounded-pill w-100 mt-3 disabled" href="/checkout" aria-disabled="true">Continue to checkout</a>
          <p class="summary-note"><i class="bi bi-shield-check"></i> Secure digital delivery through PhotoX.</p>
        </aside>
      </div>
    </section>
    <aside class="site-ad-banner" aria-label="Sponsored placement">
      <a class="site-ad-link" href="/events"><img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&h=360&q=88" alt="Adventure vehicle on an open road"><span class="site-ad-overlay"></span><span class="site-ad-copy"><small>PHOTOX PARTNER</small><strong>BUILT FOR MORE<br>THAN ROADS</strong><span>Explore events <i class="bi bi-arrow-up-right"></i></span></span></a>
    </aside>
  </main>
@endsection
