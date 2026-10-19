@extends('web.layouts.app')

@section('title', 'PhotoX | ' . ($currentPage->title ?? 'Legal Policies'))
@section('body-class', 'page-legal')

@section('styles')
<style>
  .legal-hero {
    background: radial-gradient(circle at 80% 20%, rgba(255, 138, 0, 0.12), transparent 45%),
                linear-gradient(135deg, #07152b 0%, #0b2244 50%, #07152b 100%);
    padding: 70px 0 60px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  }
  .legal-badge-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 138, 0, 0.15);
    border: 1px solid rgba(255, 138, 0, 0.35);
    color: #ffaa40;
    padding: 5px 14px;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    margin-bottom: 18px;
  }
  .legal-title {
    font-size: clamp(2.2rem, 4vw, 3.4rem);
    font-weight: 700;
    color: #ffffff;
    line-height: 1.15;
    margin-bottom: 16px;
  }
  .legal-subtitle {
    color: rgba(255, 255, 255, 0.72);
    font-size: 1.1rem;
    max-width: 640px;
    line-height: 1.6;
  }

  /* Policy Content Section */
  .legal-content-wrap {
    background: #f8fafc;
    padding: 60px 0 90px;
    min-height: 60vh;
  }
  .legal-nav-card {
    background: #ffffff;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 20px rgba(11, 45, 91, 0.05);
    padding: 20px;
    position: sticky;
    top: 100px;
  }
  .legal-nav-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    margin-bottom: 6px;
    border-radius: 10px;
    color: #334155;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.92rem;
    transition: all 0.2s ease;
  }
  .legal-nav-link:hover {
    background: #f1f5f9;
    color: #0b2d5b;
  }
  .legal-nav-link.active {
    background: #0b2d5b;
    color: #ffffff;
    font-weight: 600;
  }
  .legal-nav-link.active i {
    color: #ff8a00;
  }

  .legal-article-card {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 10px 30px rgba(11, 45, 91, 0.04);
    padding: 44px 50px;
  }
  @media (max-width: 767.98px) {
    .legal-article-card {
      padding: 26px 20px;
    }
  }

  .legal-meta-bar {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding-bottom: 24px;
    margin-bottom: 30px;
    border-bottom: 1px solid #e2e8f0;
    font-size: 0.85rem;
    color: #64748b;
  }
  .legal-body {
    color: #1e293b;
    font-size: 1.02rem;
    line-height: 1.75;
  }
  .legal-body h3 {
    font-size: 1.28rem;
    font-weight: 700;
    color: #0b2d5b;
    margin-top: 36px;
    margin-bottom: 12px;
  }
  .legal-body p {
    margin-bottom: 16px;
  }
  .legal-body ul, .legal-body ol {
    margin-bottom: 20px;
    padding-left: 24px;
  }
  .legal-body li {
    margin-bottom: 8px;
  }
  .legal-body strong {
    color: #0b2d5b;
  }
  .legal-body a {
    color: #0b2d5b;
    text-decoration: underline;
    font-weight: 600;
  }
</style>
@endsection

@section('content')
<main>
  <!-- Hero Section -->
  <section class="legal-hero">
    <div class="container-xl position-relative" style="z-index: 2;">
      <div class="row align-items-center g-4">
        <div class="col-lg-6 hero-intro-col">
          <div class="legal-badge-pill">
            <i class="bi bi-shield-check"></i> Legal Compliance & Transparency
          </div>
          <h1 class="legal-title">{{ $currentPage->title }}</h1>
          <p class="legal-subtitle">{{ $currentPage->subtitle ?? 'Official policies, licensing guidelines, and POPIA privacy disclosures for PhotoX users, athletes, and photographers.' }}</p>
        </div>
        <div class="col-lg-6 hero-banner-col">
          @include('web.partials.hero-partner-frame')
        </div>
      </div>
    </div>
  </section>

  <!-- Content Section -->
  <section class="legal-content-wrap">
    <div class="container-xl">
      <div class="row g-4">
        <!-- Sidebar Navigation -->
        <aside class="col-lg-4 col-xl-3">
          <div class="legal-nav-card">
            <div class="text-uppercase fw-bold text-muted small mb-3 letter-spacing">Policies & Terms</div>
            <nav class="nav flex-column">
              <a href="/terms" class="legal-nav-link {{ $slug === 'terms' ? 'active' : '' }}">
                <span><i class="bi bi-file-earmark-text me-2"></i> Terms of Service</span>
                <i class="bi bi-chevron-right small"></i>
              </a>
              <a href="/privacy" class="legal-nav-link {{ $slug === 'privacy' ? 'active' : '' }}">
                <span><i class="bi bi-shield-lock me-2"></i> Privacy (POPIA)</span>
                <i class="bi bi-chevron-right small"></i>
              </a>
              <a href="/licensing" class="legal-nav-link {{ $slug === 'licensing' ? 'active' : '' }}">
                <span><i class="bi bi-camera me-2"></i> Photo Licensing</span>
                <i class="bi bi-chevron-right small"></i>
              </a>
            </nav>

            <hr class="my-4 text-muted opacity-25">

            <div class="p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
              <div class="fw-semibold text-dark small mb-1"><i class="bi bi-info-circle text-primary me-1"></i> Questions or Takedowns?</div>
              <p class="text-muted small mb-2" style="font-size: 0.8rem; line-height: 1.4;">
                Have an inquiry about commercial rights or requesting photo removal under South African POPIA regulations?
              </p>
              <a href="/contact" class="btn btn-outline-dark btn-sm rounded-pill w-100 fw-semibold" style="font-size: 0.78rem;">
                Contact Support <i class="bi bi-arrow-right ms-1"></i>
              </a>
            </div>
          </div>
        </aside>

        <!-- Main Document Body -->
        <article class="col-lg-8 col-xl-9">
          <div class="legal-article-card">
            <div class="legal-meta-bar">
              <div>
                <i class="bi bi-calendar3 me-1"></i> Effective: <strong>{{ $currentPage->last_updated ?: 'October 2026' }}</strong>
                <span class="mx-2">•</span>
                <i class="bi bi-geo-alt me-1"></i> Jurisdiction: <strong>Republic of South Africa</strong>
              </div>
              <div>
                <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-3" onclick="window.print()">
                  <i class="bi bi-printer me-1"></i> Print / Save PDF
                </button>
              </div>
            </div>

            <div class="legal-body">
              {!! $currentPage->content !!}
            </div>
          </div>
        </article>
      </div>
    </div>
  </section>
</main>
@endsection
