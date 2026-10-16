@extends('web.layouts.app')

@section('title', 'PhotoX | Saved Events')
@section('body-class', 'customer-app events-page page-saved-events')

@section('content')
  <main class="workspace-layout container-xl py-4">
    @include('web.partials.customer-sidebar', ['activeTab' => 'events'])

    <section class="workspace-content">
      <div class="workspace-view active">
        <div class="workspace-view-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
          <div>
            <span class="eyebrow-blue">SAVED EVENTS</span>
            <h2 class="fs-3 fw-bold mb-1">Bookmarked events &amp; derbies</h2>
            <p class="text-muted small mb-0">Keep an eye on events and galleries you care about.</p>
          </div>
          <a class="btn btn-lime rounded-pill px-4 flex-shrink-0" href="{{ url('/events') }}"><i class="bi bi-compass me-2"></i>Explore more</a>
        </div>

        <div class="row g-3 g-md-4 mt-2">
          @forelse($events as $evt)
            <div class="col-12 col-md-6">
              <div class="card h-100 border rounded-4 overflow-hidden shadow-sm d-flex flex-row align-items-center p-3 gap-3">
                <img src="{{ $evt->cover_image ?: ($evt->photos->first()?->thumbnail_url ?: 'https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=400&q=80') }}" alt="{{ $evt->title }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 12px; flex-shrink: 0;">
                <div class="flex-grow-1 overflow-hidden">
                  <span class="badge bg-primary-subtle text-primary border small font-monospace mb-1">{{ strtoupper($evt->category_name ?: 'SPORTS') }}</span>
                  <h6 class="fw-bold mb-1 text-truncate text-dark">{{ $evt->title }}</h6>
                  <small class="text-muted d-block text-truncate">{{ $evt->photos()->count() }} photos &bull; {{ $evt->location ?: 'South Africa' }}</small>
                </div>
                <a href="{{ route('events.show', $evt->slug ?: $evt->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 flex-shrink-0">
                  View
                </a>
              </div>
            </div>
          @empty
            <div class="col-12 text-center py-5 text-muted">
              <p>No saved events in your watchlist yet.</p>
              <a href="{{ url('/events') }}" class="btn btn-lime rounded-pill px-4 mt-2">Explore Events</a>
            </div>
          @endforelse
        </div>
      </div>
    </section>
  </main>
@endsection