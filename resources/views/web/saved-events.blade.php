@extends('web.layouts.app')

@section('title', 'PhotoX | Followed Events & Watchlist')
@section('body-class', 'customer-app events-page page-saved-events')

@section('content')
  <main class="workspace-layout container-xl py-4">
    @include('web.partials.customer-sidebar', ['activeTab' => 'events'])

    <section class="workspace-content">
      <div class="workspace-view active">
        
        <!-- Header -->
        <div class="workspace-view-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
          <div>
            <span class="eyebrow-blue">EVENT WATCHLIST</span>
            <h2 class="fs-3 fw-bold mb-1">Followed Events</h2>
            <p class="text-muted small mb-0">Sporting events and galleries you follow. You will receive notifications when new photos are published.</p>
          </div>
          <a class="btn btn-warning text-dark fw-bold rounded-pill px-4 flex-shrink-0 shadow-sm" href="{{ url('/events') }}">
            <i class="bi bi-compass me-2"></i>Explore All Events
          </a>
        </div>

        @if($events->isNotEmpty())
          <!-- Grid of Followed Events -->
          <div class="row g-3 g-md-4" id="followedEventsGrid">
            @foreach($events as $evt)
              <div class="col-12 col-md-6" id="followed-event-card-{{ $evt->id }}">
                <div class="card h-100 border rounded-4 overflow-hidden shadow-sm" style="background: #ffffff;">
                  <div class="p-3 d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-3">
                    <div style="width: 100px; height: 90px; border-radius: 12px; overflow: hidden; background: #081426; flex-shrink: 0; position: relative;">
                      <img src="{{ $evt->cover_image ?: ($evt->photos->first()?->thumbnail_url ?: asset('logo.png')) }}" 
                           alt="{{ $evt->title }}" 
                           style="width: 100%; height: 100%; object-fit: cover;">
                      @if($evt->event_date)
                        <span class="badge bg-dark bg-opacity-75 text-white position-absolute bottom-0 start-0 m-1 font-monospace" style="font-size: 0.65rem;">
                          {{ $evt->event_date->format('d M') }}
                        </span>
                      @endif
                    </div>
                    
                    <div class="flex-grow-1 overflow-hidden">
                      <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle font-monospace" style="font-size: 0.68rem;">
                          {{ strtoupper($evt->category_name ?: 'SPORTS') }}
                        </span>
                        <span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size: 0.68rem;">
                          <i class="bi bi-broadcast me-1"></i>Live Gallery
                        </span>
                      </div>
                      <h6 class="fw-bold mb-1 text-truncate text-dark" title="{{ $evt->title }}">{{ $evt->title }}</h6>
                      <small class="text-muted d-block text-truncate mb-2">
                        <i class="bi bi-geo-alt me-1"></i>{{ $evt->location ?: 'South Africa' }} &bull; {{ $evt->photos()->count() }} photos
                      </small>
                      
                      <div class="d-flex align-items-center gap-2 flex-wrap pt-1 border-top">
                        <button type="button" 
                                onclick="toggleFollowEvent({{ $evt->id }}, this, 'followed-event-card-{{ $evt->id }}')" 
                                class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1 font-monospace" 
                                style="font-size: 0.78rem;" 
                                title="Unfollow event">
                          <i class="bi bi-check-circle-fill me-1 text-success"></i>Following <span class="text-muted">(Click to Unfollow)</span>
                        </button>
                        <a href="{{ route('events.show', $evt->slug ?: $evt->id) }}" class="btn btn-sm btn-lime rounded-pill px-3 py-1 fw-bold shadow-sm" style="font-size: 0.78rem;">
                          <i class="bi bi-images me-1"></i>View Photos
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>

          @if(method_exists($events, 'hasPages') && $events->hasPages())
            <div class="mt-4 d-flex justify-content-center">
              {{ $events->links() }}
            </div>
          @endif

        @else
          <!-- Empty State -->
          <div class="text-center py-5 border rounded-4 bg-white shadow-sm p-4 mb-4">
            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; background: rgba(255, 193, 7, 0.15); color: #ff8a00; font-size: 1.8rem;">
              <i class="bi bi-calendar-check"></i>
            </div>
            <h5 class="fw-bold text-dark mb-2">You Aren't Following Any Events Yet</h5>
            <p class="text-muted small mx-auto mb-4" style="max-width: 480px;">
              Follow upcoming tournaments, races, and schools to get real-time email alerts and easy access whenever photographers upload new event photos.
            </p>
            <a href="{{ url('/events') }}" class="btn btn-warning text-dark fw-bold rounded-pill px-4 shadow-sm">
              <i class="bi bi-compass me-1"></i>Browse Available Events
            </a>
          </div>

          <!-- Suggested Events to Follow -->
          @if(isset($suggestedEvents) && $suggestedEvents->isNotEmpty())
            <div class="mt-4">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                  <span class="text-primary fw-semibold small text-uppercase" style="letter-spacing: 0.5px;">SUGGESTED FOR YOU</span>
                  <h5 class="fw-bold mb-0 text-dark">Popular Events You Can Follow</h5>
                </div>
                <a class="text-decoration-none fw-semibold small text-primary" href="{{ url('/events') }}">
                  View all <i class="bi bi-arrow-right"></i>
                </a>
              </div>

              <div class="row g-3">
                @foreach($suggestedEvents as $sEvt)
                  <div class="col-12 col-md-6 col-lg-4" id="suggested-event-{{ $sEvt->id }}">
                    <div class="card h-100 border rounded-4 overflow-hidden shadow-sm" style="background: #ffffff;">
                      <div style="height: 140px; background: #081426; position: relative;">
                        <img src="{{ $sEvt->cover_image ?: asset('logo.png') }}" alt="{{ $sEvt->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                        <span class="badge bg-primary position-absolute top-0 start-0 m-2 font-monospace">
                          {{ strtoupper($sEvt->category_name ?: 'SPORTS') }}
                        </span>
                        @if($sEvt->event_date)
                          <span class="badge bg-dark bg-opacity-75 text-white position-absolute top-0 end-0 m-2 font-monospace">
                            {{ $sEvt->event_date->format('d M Y') }}
                          </span>
                        @endif
                      </div>
                      <div class="card-body p-3">
                        <strong class="d-block text-truncate text-dark mb-1" title="{{ $sEvt->title }}">{{ $sEvt->title }}</strong>
                        <small class="text-muted d-block text-truncate mb-3">
                          <i class="bi bi-geo-alt me-1"></i>{{ $sEvt->location ?: 'South Africa' }}
                        </small>
                        <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                          <button type="button" 
                                  onclick="toggleFollowEvent({{ $sEvt->id }}, this, null)" 
                                  class="btn btn-sm btn-outline-warning text-dark fw-bold rounded-pill px-3 shadow-sm" 
                                  style="font-size: 0.8rem;">
                            <i class="bi bi-bookmark-plus me-1 text-warning"></i>Follow
                          </button>
                          <a href="{{ route('events.show', $sEvt->slug ?: $sEvt->id) }}" class="btn btn-sm btn-lime rounded-pill px-3 fw-bold" style="font-size: 0.8rem;">
                            View Gallery
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endif
        @endif

      </div>
    </section>
  </main>

  <script>
    function toggleFollowEvent(eventId, btn, cardId) {
      const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
      btn.disabled = true;

      fetch('/api/events/' + eventId + '/toggle-save', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrf,
          'Accept': 'application/json'
        }
      })
      .then(res => res.json())
      .then(data => {
        btn.disabled = false;
        if (data.success) {
          // Update sidebar counter
          const sidebarCounter = document.querySelector('.customer-sidebar-link[href*="saved-events"] .customer-sidebar-count');
          if (sidebarCounter) sidebarCounter.innerText = data.count;

          if (!data.saved) {
            // If unfollowed and has a card in followed list, remove it
            if (cardId) {
              const card = document.getElementById(cardId);
              if (card) {
                card.style.transition = 'all 0.3s ease';
                card.style.opacity = '0';
                card.style.transform = 'scale(0.95)';
                setTimeout(() => {
                  card.remove();
                  const remaining = document.querySelectorAll('#followedEventsGrid > div');
                  if (remaining.length === 0) {
                    window.location.reload();
                  }
                }, 300);
              }
            } else {
              btn.innerHTML = '<i class="bi bi-bookmark-plus me-1 text-warning"></i>Follow';
              btn.className = 'btn btn-sm btn-outline-warning text-dark fw-bold rounded-pill px-3 shadow-sm';
            }
          } else {
            btn.innerHTML = '<i class="bi bi-check-circle-fill me-1 text-success"></i>Following';
            btn.className = 'btn btn-sm btn-warning text-dark fw-bold rounded-pill px-3 shadow-sm';
          }
        }
      })
      .catch(err => {
        btn.disabled = false;
        console.error(err);
      });
    }
  </script>
@endsection