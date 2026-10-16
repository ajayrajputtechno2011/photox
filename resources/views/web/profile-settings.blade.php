@extends('web.layouts.app')

@section('title', 'PhotoX | Profile & Settings')
@section('body-class', 'customer-app profile-page')

@section('content')
  <main class="workspace-layout container-xl py-4">
    @include('web.partials.customer-sidebar', ['activeTab' => 'profile'])

    <section class="workspace-content">
      <div class="workspace-view active">
        <div class="workspace-view-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
          <div>
            <span class="eyebrow-blue">PROFILE &amp; SETTINGS</span>
            <h2 class="fs-3 fw-bold mb-1">Account details</h2>
            <p class="text-muted small mb-0">Keep your PhotoX profile complete and your preferences in your hands.</p>
          </div>
          <button class="btn btn-lime rounded-pill px-4 flex-shrink-0" form="profileForm" type="submit">
            <i class="bi bi-check2 me-2"></i>Save changes
          </button>
        </div>

        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if($errors->any())
          <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <div class="settings-layout">
          <form action="{{ route('customer.profile.update') }}" class="settings-form" id="profileForm" method="POST">
            @csrf

            <!-- Section 1: Personal info -->
            <section class="settings-section">
              <div class="settings-section-title">
                <i class="bi bi-person-vcard"></i>
                <div>
                  <h3>Personal information</h3>
                  <p>The basics that appear on your PhotoX account.</p>
                </div>
              </div>
              <div class="settings-form-grid">
                <label>Full name <span class="text-danger">*</span>
                  <input name="name" type="text" value="{{ old('name', $user->name) }}" required>
                </label>
                <label>Email address
                  <input type="email" value="{{ $user->email }}" disabled style="opacity: 0.65; cursor: not-allowed;">
                </label>
                <label>Mobile number
                  <input name="phone" placeholder="+27 82 000 0000" type="tel" value="{{ old('phone', $user->phone) }}">
                </label>
                <label>City / Location
                  <input name="location" type="text" value="{{ old('location', $user->location ?: 'Cape Town, South Africa') }}">
                </label>
              </div>
            </section>

            <!-- Section 2: Security & Password -->
            <section class="settings-section">
              <div class="settings-section-title">
                <i class="bi bi-shield-lock"></i>
                <div>
                  <h3>Security &amp; Password</h3>
                  <p>Leave password fields blank if you do not want to change it.</p>
                </div>
              </div>
              <div class="settings-form-grid">
                <label>New Password (Optional)
                  <input name="password" type="password" placeholder="Min. 8 characters" autocomplete="new-password">
                </label>
                <label>Confirm New Password
                  <input name="password_confirmation" type="password" placeholder="Repeat new password" autocomplete="new-password">
                </label>
              </div>
            </section>

            <div class="d-flex justify-content-end gap-3 mt-4">
              <a href="{{ route('customer.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
              <button class="btn btn-lime rounded-pill px-4" type="submit"><i class="bi bi-check2 me-2"></i>Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </main>
@endsection