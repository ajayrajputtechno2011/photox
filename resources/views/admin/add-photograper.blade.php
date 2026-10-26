<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <title>PhotoX Admin | Add Photographer</title>
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
            <a class="breadcrumb-muted" href="/admin/photographers">Photographers</a><i class="bi bi-chevron-right"></i><strong>Add photographer</strong>
          </div>
        </div>
      </header>
      <main class="content-area module-page">
        <div class="page-intro">
          <p class="eyebrow">Account onboarding</p>
          <h1>Add photographer</h1>
          <p class="intro-copy">Create an account with the contact, verification and payout details needed for marketplace access.</p>
        </div>
        <form action="/admin/photographers" class="photographer-form">
          <section class="panel detail-card">
            <div class="section-heading">
              <div>
                <p class="eyebrow">Profile details</p>
                <h3>Identity and contact</h3>
              </div><span class="form-step">01 / 03</span>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label" for="full-name">Full name</label><input class="form-control" id="full-name" placeholder="e.g. Jordan Miller" required="">
              </div>
              <div class="col-md-6">
                <label class="form-label" for="email">Email address</label><input class="form-control" id="email" placeholder="name@studio.co" required="" type="email">
              </div>
              <div class="col-md-6">
                <label class="form-label" for="phone">Phone number</label><input class="form-control" id="phone" placeholder="+27 82 000 0000">
              </div>
              <div class="col-md-6">
                <label class="form-label" for="location">City / location</label><input class="form-control" id="location" placeholder="Cape Town, South Africa">
              </div>
              <div class="col-12">
                <label class="form-label" for="bio">Profile bio</label>
                <textarea class="form-control" id="bio" placeholder="Short introduction shown on the photographer profile" rows="4"></textarea>
              </div>
            </div>
          </section>
          <section class="panel detail-card">
            <div class="section-heading">
              <div>
                <p class="eyebrow">Marketplace setup</p>
                <h3>Access and commercial details</h3>
              </div><span class="form-step">02 / 03</span>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label" for="membership">Membership plan</label><select class="form-select" id="membership">
                  <option>
                    Starter
                  </option>
                  <option>
                    Pro Studio
                  </option>
                  <option>
                    Enterprise
                  </option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label" for="status">Initial account status</label><select class="form-select" id="status">
                  <option>
                    Pending review
                  </option>
                  <option>
                    Verified and active
                  </option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label" for="commission">Commission rate</label>
                <div class="input-group">
                  <input class="form-control" id="commission" value="20"><span class="input-group-text">%</span>
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label" for="payout">Payout email</label><input class="form-control" id="payout" placeholder="payouts@studio.co" type="email">
              </div>
              <div class="col-12">
                <label class="form-label" for="note">Internal onboarding note</label>
                <textarea class="form-control" id="note" placeholder="Add context for the verification team" rows="3"></textarea>
              </div>
            </div>
          </section>
          <section class="panel detail-card">
            <div class="section-heading">
              <div>
                <p class="eyebrow">Verification</p>
                <h3>Required account documents</h3>
              </div><span class="form-step">03 / 03</span>
            </div>
            <div class="upload-zone">
              <i class="bi bi-cloud-arrow-up"></i>
              <div>
                <strong>Upload identity or business documents</strong>
                <p>PDF, JPG or PNG · up to 10 MB each</p>
              </div><button class="btn btn-outline-light" type="button">Choose files</button>
            </div>
            <div class="form-check mt-3">
              <input class="form-check-input" id="invite" type="checkbox"><label class="form-check-label" for="invite">Send an email invitation with setup instructions</label>
            </div>
          </section>
          <div class="detail-actions form-actions">
            <a class="btn btn-outline-light" href="/admin/photographers">Cancel</a><button class="btn btn-primary" type="submit"><i class="bi bi-person-check"></i> Create photographer</button>
          </div>
        </form>
      </main>
    </div>
  </div>
  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
  <script src="{{ asset('admin-assets/js/app.js') }}">
  </script>
</body>
</html>