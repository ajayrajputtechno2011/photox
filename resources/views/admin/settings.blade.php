<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <title>PhotoX Admin | Platform Settings &amp; API Keys</title>
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet">
  <style>
    .settings-tab-btn {
      background: rgba(15, 27, 49, 0.7);
      border: 1px solid rgba(255, 255, 255, 0.12);
      color: #94a3b8;
      padding: 10px 18px;
      border-radius: 12px;
      font-size: 0.88rem;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.2s ease;
      cursor: pointer;
    }
    .settings-tab-btn:hover {
      background: rgba(255, 255, 255, 0.08);
      color: #ffffff;
    }
    .settings-tab-btn.active {
      background: #ff8a00;
      color: #070e1b;
      border-color: #ff8a00;
      box-shadow: 0 4px 16px rgba(255, 138, 0, 0.35);
    }
    .settings-card {
      background: rgba(15, 27, 49, 0.75);
      border: 1px solid rgba(255, 255, 255, 0.12);
      border-radius: 20px;
      padding: 26px 28px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
      margin-bottom: 24px;
    }
    .card-heading {
      display: flex;
      align-items: center;
      gap: 14px;
      margin-bottom: 22px;
      padding-bottom: 16px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }
    .card-heading-icon {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      background: rgba(255, 138, 0, 0.15);
      color: #ff8a00;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.35rem;
    }
    .form-label {
      font-size: 0.82rem;
      font-weight: 600;
      color: #e2e8f0;
      margin-bottom: 6px;
    }
    .form-control, .form-select {
      background: #091222 !important;
      border: 1px solid rgba(255, 255, 255, 0.16) !important;
      color: #ffffff !important;
      border-radius: 10px;
      padding: 10px 14px;
      font-size: 0.9rem;
      transition: all 0.2s ease;
    }
    .form-control:focus, .form-select:focus {
      border-color: #ff8a00 !important;
      box-shadow: 0 0 0 3px rgba(255, 138, 0, 0.25) !important;
      color: #ffffff !important;
    }
    .form-text {
      font-size: 0.74rem;
      color: #94a3b8;
      margin-top: 4px;
    }
    .mono-input {
      font-family: 'DM Mono', monospace;
      font-size: 0.84rem;
    }
    .btn-save-sticky {
      background: linear-gradient(135deg, #ff8a00 0%, #e06d00 100%);
      color: #ffffff;
      font-weight: 700;
      border: none;
      border-radius: 999px;
      padding: 11px 28px;
      box-shadow: 0 8px 24px rgba(255, 138, 0, 0.35);
      transition: all 0.2s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
    }
    .btn-save-sticky:hover {
      background: linear-gradient(135deg, #ffa229 0%, #eb7c0a 100%);
      transform: translateY(-2px);
      box-shadow: 0 12px 28px rgba(255, 138, 0, 0.45);
      color: #ffffff;
    }
    .password-toggle-wrap {
      position: relative;
    }
    .password-toggle-btn {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      background: transparent;
      border: none;
      color: #94a3b8;
      cursor: pointer;
      font-size: 1rem;
      padding: 4px;
    }
    .password-toggle-btn:hover {
      color: #ff8a00;
    }
  </style>
</head>
<body>
  
  <div class="app-shell">
    @include('admin.partials.sidebar')

    <div class="main-panel">
      <header class="topbar">
        <div class="d-flex align-items-center gap-3">
          <button class="icon-button menu-trigger" id="menuToggle" type="button" aria-label="Open navigation"><i class="bi bi-list"></i></button>
          <div class="breadcrumb-wrap">
            <span class="breadcrumb-muted">Admin</span>
            <i class="bi bi-chevron-right"></i>
            <strong>Platform Settings &amp; API Keys</strong>
          </div>
        </div>
        <div class="topbar-actions">
          <a href="{{ url('/') }}" target="_blank" class="btn btn-sm btn-outline-light rounded-pill px-3 me-2">
            <i class="bi bi-box-arrow-up-right me-1"></i> View Website
          </a>
          <button type="submit" form="settingsForm" class="btn-save-sticky btn-sm py-2 px-3">
            <i class="bi bi-check2-circle"></i> Save Settings
          </button>
          <div class="topbar-divider"></div>
          <div class="profile-menu-wrap">
            <button class="profile-button" type="button"><span class="profile-avatar">AL</span><span class="profile-copy"><strong>Alex Lee</strong><small>Administrator</small></span><i class="bi bi-chevron-down"></i></button>
            <div class="profile-dropdown-menu" role="menu">
              <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="profile-menu-item danger border-0 bg-transparent w-100 text-start py-2 px-3" style="cursor:pointer;">
                  <i class="bi bi-box-arrow-right"></i><span class="ms-2">Logout</span>
                </button>
              </form>
            </div>
          </div>
        </div>
      </header>

      <main class="content-area module-page ops-page" style="padding: 28px;">
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-4" role="alert" style="background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.4); color: #4ade80;">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <div class="page-intro d-flex align-items-end justify-content-between gap-3 flex-wrap mb-4">
          <div>
            <p class="eyebrow">System Configuration</p>
            <h1>Settings &amp; API Keys</h1>
            <p class="intro-copy">Manage Payment Gateway (Yoco), Cloud Storage (R2), Platform Rates, Email and Security.</p>
          </div>
          <button type="submit" form="settingsForm" class="btn-save-sticky">
            <i class="bi bi-check2-circle"></i> Save All Settings
          </button>
        </div>

        <!-- Tab Buttons -->
        <div class="d-flex gap-2 mb-4 flex-wrap">
          <button type="button" class="settings-tab-btn active" onclick="switchTab('tab-payment')">
            <i class="bi bi-credit-card-2-front"></i> Payment &amp; Yoco
          </button>
          <button type="button" class="settings-tab-btn" onclick="switchTab('tab-storage')">
            <i class="bi bi-cloud-arrow-up"></i> Cloud Storage (R2)
          </button>
          <button type="button" class="settings-tab-btn" onclick="switchTab('tab-commercial')">
            <i class="bi bi-cash-stack"></i> Pricing &amp; Commission
          </button>
          <button type="button" class="settings-tab-btn" onclick="switchTab('tab-contact')">
            <i class="bi bi-building"></i> Company &amp; Contact
          </button>
          <button type="button" class="settings-tab-btn" onclick="switchTab('tab-mail')">
            <i class="bi bi-envelope-at"></i> Email &amp; SMTP
          </button>
          <button type="button" class="settings-tab-btn" onclick="switchTab('tab-security')">
            <i class="bi bi-shield-lock"></i> Platform Controls
          </button>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" id="settingsForm">
          @csrf
          @method('PUT')

          <!-- 1. PAYMENT & YOCO TAB -->
          <div class="tab-pane-content" id="tab-payment">
            <div class="settings-card">
              <div class="card-heading">
                <div class="card-heading-icon"><i class="bi bi-credit-card-2-front"></i></div>
                <div>
                  <h3 class="h5 fw-bold mb-0">Yoco Payment Gateway (South Africa ZAR)</h3>
                  <small class="text-muted">Configure credit card processing keys for customer checkouts.</small>
                </div>
              </div>

              <div class="row g-3">
                <div class="col-md-4">
                  <label class="form-label">Gateway Environment Mode</label>
                  <select name="yoco_mode" class="form-select">
                    <option value="sandbox" {{ ($settings['yoco_mode'] ?? 'sandbox') === 'sandbox' ? 'selected' : '' }}>Sandbox (Test Mode)</option>
                    <option value="live" {{ ($settings['yoco_mode'] ?? '') === 'live' ? 'selected' : '' }}>Live (Production Mode)</option>
                  </select>
                  <div class="form-text">Toggle between sandbox test keys and real production card processing.</div>
                </div>

                <div class="col-md-4">
                  <label class="form-label">Currency Code</label>
                  <input type="text" name="currency_code" class="form-control mono-input" value="{{ $settings['currency_code'] ?? 'ZAR' }}" placeholder="ZAR">
                  <div class="form-text">Default: ZAR (South African Rand).</div>
                </div>

                <div class="col-md-4">
                  <label class="form-label">Currency Symbol</label>
                  <input type="text" name="currency_symbol" class="form-control mono-input" value="{{ $settings['currency_symbol'] ?? 'R' }}" placeholder="R">
                  <div class="form-text">Symbol displayed across customer storefront (e.g. R).</div>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Yoco Public Key (Frontend SDK)</label>
                  <input type="text" name="yoco_public_key" class="form-control mono-input" value="{{ $settings['yoco_public_key'] ?? '' }}" placeholder="pk_test_... or pk_live_...">
                  <div class="form-text">Visible in the checkout pop-up to generate secure card charge tokens.</div>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Yoco Secret Key (Backend API)</label>
                  <div class="password-toggle-wrap">
                    <input type="password" id="yocoSecretKey" name="yoco_secret_key" class="form-control mono-input pe-5" value="{{ $settings['yoco_secret_key'] ?? '' }}" placeholder="sk_test_... or sk_live_...">
                    <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('yocoSecretKey', this)">
                      <i class="bi bi-eye"></i>
                    </button>
                  </div>
                  <div class="form-text">Private server key used to execute final charges with Yoco servers.</div>
                </div>

                <div class="col-md-12">
                  <label class="form-label">Webhook Signing Secret (Optional)</label>
                  <input type="text" name="yoco_webhook_secret" class="form-control mono-input" value="{{ $settings['yoco_webhook_secret'] ?? '' }}" placeholder="whsec_...">
                  <div class="form-text">Used to verify payment success webhooks from Yoco dashboard.</div>
                </div>
              </div>
            </div>
          </div>

          <!-- 2. CLOUD STORAGE TAB -->
          <div class="tab-pane-content d-none" id="tab-storage">
            <div class="settings-card">
              <div class="card-heading">
                <div class="card-heading-icon"><i class="bi bi-cloud-arrow-up"></i></div>
                <div>
                  <h3 class="h5 fw-bold mb-0">Cloudflare R2 Object Storage (High-Res Photos)</h3>
                  <small class="text-muted">Direct S3-compatible cloud bucket for unlimited sports galleries and high-resolution photo deliveries.</small>
                </div>
              </div>

              <div class="row g-3">
                <div class="col-md-4">
                  <label class="form-label">Storage Driver</label>
                  <select name="storage_driver" class="form-select">
                    <option value="r2" {{ ($settings['storage_driver'] ?? 'r2') === 'r2' ? 'selected' : '' }}>Cloudflare R2 (Recommended)</option>
                    <option value="s3" {{ ($settings['storage_driver'] ?? '') === 's3' ? 'selected' : '' }}>Amazon AWS S3</option>
                    <option value="local" {{ ($settings['storage_driver'] ?? '') === 'local' ? 'selected' : '' }}>Local Server Disk</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <label class="form-label">Bucket Name</label>
                  <input type="text" name="r2_bucket" class="form-control mono-input" value="{{ $settings['r2_bucket'] ?? 'photox-production' }}" placeholder="photox-production">
                </div>

                <div class="col-md-4">
                  <label class="form-label">Cloudflare Account ID</label>
                  <input type="text" name="r2_account_id" class="form-control mono-input" value="{{ $settings['r2_account_id'] ?? '' }}" placeholder="310705f0aa67ce203fe0b2400e4708ff">
                </div>

                <div class="col-md-6">
                  <label class="form-label">R2 Access Key ID</label>
                  <input type="text" name="r2_access_key_id" class="form-control mono-input" value="{{ $settings['r2_access_key_id'] ?? '' }}" placeholder="Access key ID">
                </div>

                <div class="col-md-6">
                  <label class="form-label">R2 Secret Access Key</label>
                  <div class="password-toggle-wrap">
                    <input type="password" id="r2SecretKey" name="r2_secret_access_key" class="form-control mono-input pe-5" value="{{ $settings['r2_secret_access_key'] ?? '' }}" placeholder="Secret access key">
                    <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('r2SecretKey', this)">
                      <i class="bi bi-eye"></i>
                    </button>
                  </div>
                </div>

                <div class="col-md-6">
                  <label class="form-label">R2 S3-Compatible Endpoint</label>
                  <input type="text" name="r2_endpoint" class="form-control mono-input" value="{{ $settings['r2_endpoint'] ?? '' }}" placeholder="https://<account_id>.r2.cloudflarestorage.com">
                </div>

                <div class="col-md-6">
                  <label class="form-label">Public CDN Domain / Worker URL</label>
                  <input type="text" name="r2_public_domain" class="form-control mono-input" value="{{ $settings['r2_public_domain'] ?? '' }}" placeholder="https://cdn.photox.co.za">
                </div>
              </div>
            </div>
          </div>

          <!-- 3. COMMERCIALS TAB -->
          <div class="tab-pane-content d-none" id="tab-commercial">
            <div class="settings-card">
              <div class="card-heading">
                <div class="card-heading-icon"><i class="bi bi-cash-stack"></i></div>
                <div>
                  <h3 class="h5 fw-bold mb-0">Platform Commercials &amp; Default Rates</h3>
                  <small class="text-muted">Global default pricing rules when photographers do not specify custom bundle prices.</small>
                </div>
              </div>

              <div class="row g-3">
                <div class="col-md-4">
                  <label class="form-label">Default Platform Commission (%)</label>
                  <div class="input-group">
                    <input type="number" name="default_commission_rate" class="form-control" value="{{ $settings['default_commission_rate'] ?? '15' }}" min="0" max="100">
                    <span class="input-group-text bg-dark text-white border-secondary">%</span>
                  </div>
                  <div class="form-text">Used if photographer has no tier or custom override set.</div>
                </div>

                <div class="col-md-4">
                  <label class="form-label">"Buy Complete Gallery" Flat Price (ZAR)</label>
                  <div class="input-group">
                    <span class="input-group-text bg-dark text-white border-secondary">R</span>
                    <input type="number" name="default_gallery_price" class="form-control" value="{{ $settings['default_gallery_price'] ?? '450' }}">
                  </div>
                  <div class="form-text">Default bundle rate for full digital event delivery.</div>
                </div>

                <div class="col-md-4">
                  <label class="form-label">"Selfie Bundle" Rate (ZAR)</label>
                  <div class="input-group">
                    <span class="input-group-text bg-dark text-white border-secondary">R</span>
                    <input type="number" name="default_selfie_bundle_price" class="form-control" value="{{ $settings['default_selfie_bundle_price'] ?? '150' }}">
                  </div>
                  <div class="form-text">Flat rate for all AI-matched face/athlete photos.</div>
                </div>

                <div class="col-md-4">
                  <label class="form-label">Single Photo Default Price (ZAR)</label>
                  <div class="input-group">
                    <span class="input-group-text bg-dark text-white border-secondary">R</span>
                    <input type="number" name="default_single_photo_price" class="form-control" value="{{ $settings['default_single_photo_price'] ?? '65' }}">
                  </div>
                  <div class="form-text">Individual high-resolution digital file download.</div>
                </div>

                <div class="col-md-4">
                  <label class="form-label">Commercial License Surcharge (ZAR)</label>
                  <div class="input-group">
                    <span class="input-group-text bg-dark text-white border-secondary">R</span>
                    <input type="number" name="commercial_license_surcharge" class="form-control" value="{{ $settings['commercial_license_surcharge'] ?? '250' }}">
                  </div>
                  <div class="form-text">Extra fee added when commercial advertising rights are chosen.</div>
                </div>

                <div class="col-md-4">
                  <label class="form-label">Minimum Payout Withdrawal (ZAR)</label>
                  <div class="input-group">
                    <span class="input-group-text bg-dark text-white border-secondary">R</span>
                    <input type="number" name="min_payout_amount" class="form-control" value="{{ $settings['min_payout_amount'] ?? '500' }}">
                  </div>
                  <div class="form-text">Minimum accumulated earnings required before photographer payout request.</div>
                </div>
              </div>
            </div>
          </div>

          <!-- 4. COMPANY & CONTACT TAB -->
          <div class="tab-pane-content d-none" id="tab-contact">
            <div class="settings-card">
              <div class="card-heading">
                <div class="card-heading-icon"><i class="bi bi-building"></i></div>
                <div>
                  <h3 class="h5 fw-bold mb-0">Company Profile &amp; Contact Details</h3>
                  <small class="text-muted">Official business information rendered on customer storefront, invoices and footers.</small>
                </div>
              </div>

              <div class="row g-3">
                <div class="col-md-4">
                  <label class="form-label">Marketplace Platform Name</label>
                  <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? 'PhotoX' }}">
                </div>

                <div class="col-md-4">
                  <label class="form-label">Support Email Address</label>
                  <input type="email" name="contact_email" class="form-control" value="{{ $settings['contact_email'] ?? 'hello@photox.co.za' }}">
                </div>

                <div class="col-md-4">
                  <label class="form-label">Support Phone Number</label>
                  <input type="text" name="contact_phone" class="form-control" value="{{ $settings['contact_phone'] ?? '+27 21 456 7890' }}">
                </div>

                <div class="col-md-6">
                  <label class="form-label">Physical Office Address</label>
                  <input type="text" name="contact_address" class="form-control" value="{{ $settings['contact_address'] ?? '42 Long Street, Cape Town, South Africa' }}">
                </div>

                <div class="col-md-6">
                  <label class="form-label">Operating Support Hours</label>
                  <input type="text" name="support_hours" class="form-control" value="{{ $settings['support_hours'] ?? 'Mon–Fri · 08:00–17:00 SAST' }}">
                </div>

                <div class="col-md-4">
                  <label class="form-label">Instagram Profile URL</label>
                  <input type="url" name="instagram_url" class="form-control mono-input" value="{{ $settings['instagram_url'] ?? 'https://instagram.com/photox' }}">
                </div>

                <div class="col-md-4">
                  <label class="form-label">Facebook Page URL</label>
                  <input type="url" name="facebook_url" class="form-control mono-input" value="{{ $settings['facebook_url'] ?? 'https://facebook.com/photox' }}">
                </div>

                <div class="col-md-4">
                  <label class="form-label">LinkedIn Page URL</label>
                  <input type="url" name="linkedin_url" class="form-control mono-input" value="{{ $settings['linkedin_url'] ?? 'https://linkedin.com/company/photox' }}">
                </div>
              </div>
            </div>
          </div>

          <!-- 5. EMAIL & SMTP TAB -->
          <div class="tab-pane-content d-none" id="tab-mail">
            <div class="settings-card">
              <div class="card-heading">
                <div class="card-heading-icon"><i class="bi bi-envelope-at"></i></div>
                <div>
                  <h3 class="h5 fw-bold mb-0">Outgoing Email &amp; SMTP Server</h3>
                  <small class="text-muted">Credentials used to dispatch receipt emails, order downloads and notifications.</small>
                </div>
              </div>

              <div class="row g-3">
                <div class="col-md-4">
                  <label class="form-label">Mail Driver</label>
                  <select name="mail_mailer" class="form-select">
                    <option value="smtp" {{ ($settings['mail_mailer'] ?? 'smtp') === 'smtp' ? 'selected' : '' }}>SMTP</option>
                    <option value="sendmail" {{ ($settings['mail_mailer'] ?? '') === 'sendmail' ? 'selected' : '' }}>Sendmail</option>
                    <option value="log" {{ ($settings['mail_mailer'] ?? '') === 'log' ? 'selected' : '' }}>Log (Testing)</option>
                  </select>
                </div>

                <div class="col-md-5">
                  <label class="form-label">SMTP Host Server</label>
                  <input type="text" name="mail_host" class="form-control mono-input" value="{{ $settings['mail_host'] ?? 'smtp.mailgun.org' }}" placeholder="smtp.mailgun.org">
                </div>

                <div class="col-md-3">
                  <label class="form-label">SMTP Port</label>
                  <input type="text" name="mail_port" class="form-control mono-input" value="{{ $settings['mail_port'] ?? '587' }}" placeholder="587">
                </div>

                <div class="col-md-4">
                  <label class="form-label">SMTP Username</label>
                  <input type="text" name="mail_username" class="form-control mono-input" value="{{ $settings['mail_username'] ?? '' }}" placeholder="Username">
                </div>

                <div class="col-md-4">
                  <label class="form-label">SMTP Password</label>
                  <div class="password-toggle-wrap">
                    <input type="password" id="smtpPassword" name="mail_password" class="form-control mono-input pe-5" value="{{ $settings['mail_password'] ?? '' }}" placeholder="Password">
                    <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('smtpPassword', this)">
                      <i class="bi bi-eye"></i>
                    </button>
                  </div>
                </div>

                <div class="col-md-4">
                  <label class="form-label">Encryption Type</label>
                  <select name="mail_encryption" class="form-select">
                    <option value="tls" {{ ($settings['mail_encryption'] ?? 'tls') === 'tls' ? 'selected' : '' }}>TLS</option>
                    <option value="ssl" {{ ($settings['mail_encryption'] ?? '') === 'ssl' ? 'selected' : '' }}>SSL</option>
                    <option value="" {{ empty($settings['mail_encryption']) ? 'selected' : '' }}>None</option>
                  </select>
                </div>

                <div class="col-md-6">
                  <label class="form-label">"From" Email Address</label>
                  <input type="email" name="mail_from_address" class="form-control" value="{{ $settings['mail_from_address'] ?? 'no-reply@photox.co.za' }}">
                </div>

                <div class="col-md-6">
                  <label class="form-label">"From" Sender Name</label>
                  <input type="text" name="mail_from_name" class="form-control" value="{{ $settings['mail_from_name'] ?? 'PhotoX Marketplace' }}">
                </div>
              </div>
            </div>
          </div>

          <!-- 6. SECURITY & PLATFORM TAB -->
          <div class="tab-pane-content d-none" id="tab-security">
            <div class="settings-card">
              <div class="card-heading">
                <div class="card-heading-icon"><i class="bi bi-shield-lock"></i></div>
                <div>
                  <h3 class="h5 fw-bold mb-0">Platform Controls &amp; Asset Protection</h3>
                  <small class="text-muted">Master switches for marketplace security, watermarks, and maintenance mode.</small>
                </div>
              </div>

              <div class="row g-4">
                <div class="col-md-12">
                  <div class="form-check form-switch p-3 rounded-3" style="background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.08);">
                    <input class="form-check-input ms-0 me-3" type="checkbox" role="switch" id="watermarkProtectionSwitch" name="enable_watermark_protection" value="1" {{ !empty($settings['enable_watermark_protection']) ? 'checked' : '' }} style="width: 44px; height: 22px;">
                    <label class="form-check-label" for="watermarkProtectionSwitch">
                      <strong class="d-block text-white">Strict Watermark Protection on Public Previews</strong>
                      <span class="text-muted small">Prevents direct access to unwatermarked raw files before confirmed purchase.</span>
                    </label>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-check form-switch p-3 rounded-3" style="background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.08);">
                    <input class="form-check-input ms-0 me-3" type="checkbox" role="switch" id="aiSearchSwitch" name="enable_ai_search" value="1" {{ !empty($settings['enable_ai_search']) ? 'checked' : '' }} style="width: 44px; height: 22px;">
                    <label class="form-check-label" for="aiSearchSwitch">
                      <strong class="d-block text-white">Enable AI Face / Bib Number Indexing</strong>
                      <span class="text-muted small">Allows eligible photographers (Pro and Guild tiers) to run automated bib &amp; face indexing on uploads.</span>
                    </label>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-check form-switch p-3 rounded-3" style="background: rgba(239, 68, 68, 0.06); border: 1px solid rgba(239, 68, 68, 0.2);">
                    <input class="form-check-input ms-0 me-3" type="checkbox" role="switch" id="maintenanceSwitch" name="maintenance_mode" value="1" {{ !empty($settings['maintenance_mode']) ? 'checked' : '' }} style="width: 44px; height: 22px;">
                    <label class="form-check-label" for="maintenanceSwitch">
                      <strong class="d-block text-danger">Platform Maintenance Mode</strong>
                      <span class="text-muted small">When turned on, public visitors will be greeted with an elegant maintenance notice while admin access remains enabled.</span>
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn-save-sticky">
              <i class="bi bi-check2-circle"></i> Save All Settings
            </button>
          </div>
        </form>
      </main>
    </div>
  </div>

  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
  <script src="{{ asset('admin-assets/js/app.js') }}"></script>
  <script>
    function switchTab(tabId) {
      document.querySelectorAll('.tab-pane-content').forEach(el => el.classList.add('d-none'));
      document.querySelectorAll('.settings-tab-btn').forEach(btn => btn.classList.remove('active'));

      const activeTab = document.getElementById(tabId);
      if (activeTab) {
        activeTab.classList.remove('d-none');
      }

      event.currentTarget.classList.add('active');
    }

    function togglePasswordVisibility(inputId, btn) {
      const input = document.getElementById(inputId);
      if (!input) return;
      const isPassword = input.type === 'password';
      input.type = isPassword ? 'text' : 'password';
      btn.innerHTML = isPassword ? '<i class="bi bi-eye-slash text-warning"></i>' : '<i class="bi bi-eye"></i>';
    }
  </script>
</body>
</html>
