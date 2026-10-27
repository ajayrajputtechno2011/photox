# PhotoX – Client Feedback & Implementation Tracker

> **Last Updated:** 2026-10-27  
> **Production VPS:** `168.231.79.67` (`https://photox.co.za`)  
> **Staging Domain:** `https://photox.aitechnotech.in`  
> **Repository:** `https://github.com/ajayrajputtechno2011/photox.git` (`main` branch)

---

## 📌 Status Summary Table

| # | Feedback Item / Task | Module / Page | Status | Priority | Verified on VPS |
|---|----------------------|---------------|--------|----------|-----------------|
| 1 | **6-Month Digital License Clarification:** Review the "6-Month Digital License Active" badge and expiration policy on purchased downloads | Customer Downloads (`/orders-downloads`) | **Pending** | Medium | ⏳ Pending |
| 2 | **"Sell Complete Gallery ONLY" Mode Enforcement (Screenshots 1 & 2):** When selected, HIDE Personal Single, Commercial Single, and Selfie Bundle entirely so ONLY "Buy Complete Gallery" shows | Event Details & Lightbox Modal (`/event-details/{slug}`) | **Complete** | Critical | ✅ Ready to Deploy |
| 3 | **Personal License Only Disclaimer on Bundles:** Add explicit line/badge under Selfie/Athlete Bundle and Complete Gallery: *"Personal License Only (Commercial licenses must be bought individually)"* | Event Details & Lightbox Modal (`/event-details/{slug}`) | **Complete** | High | ✅ Ready to Deploy |
| 4 | **Banners, Ad Spots, Placements & Sizes Audit:** Review all banner slots, ad positions, dimensions, and aspect ratios across the site | Site Banners, Event Details & Lightbox (`banners`, `/events`) | **Pending** | High | ⏳ Pending |
| 5 | **Homepage Banner Container Fix (Screenshot 1 & 2):** Change the full-width edge-to-edge black bar on Homepage into a clean, contained 1200px rounded card frame with padding (matching Screenshot 2) | Homepage Ad Banner (`index.blade.php`, `site-ad-banner.blade.php`) | **Pending** | High | ⏳ Pending |
| 6 | **Admin FAQ Manager & About Page Accordion (Screenshot 1):** Add "FAQs" under CONTENT section in Admin Sidebar (`/admin/faqs`) to manage FAQs; render accordion on About page (`/about`) explaining selfie bundles, licenses, etc. | Admin Sidebar & About Page (`/admin/faqs`, `/about`) | **Pending** | High | ⏳ Pending |
| 7 | **South African Bank Dropdown & Clear Default Bank Details (Screenshot):** Restore the Bank Name selection dropdown; REMOVE all hardcoded fake account numbers/branch codes so fields start clean/empty | Photographer Payouts (`/photographer-payouts`, `/photographer-profile`) | **Complete** | High | ✅ Ready to Deploy |
| 8 | **Photographer Vanity Handle / Slug (`@handle`) with Unique Validation:** Allow photographer to set their profile handle in Creator Studio and validate uniqueness before saving | Photographer Profile (`/photographer-profile`, `PhotographerPortalController`) | **Pending** | High | ⏳ Pending |
| 9 | **Watermark Studio Access Restricted by Membership Tier (Gated on Free Tier):** Watermark Studio must not be active by default on Free tier; controlled via membership tier settings with upgrade prompt | Watermark Studio & Memberships (`/photographer-watermark`, `/memberships`) | **Pending** | High | ⏳ Pending |
| 10 | **Default Fallback Logo to Official PhotoX Logo & Disabled State Fix:** Replace `swirl_logo.png` fallback with official PhotoX logo; when watermark is disabled for an account, respect the disabled state cleanly | Watermark Studio (`/photographer-watermark`, `DemoController`, `web.php`) | **Complete** | Critical | ✅ Ready to Deploy |
| 11 | **Fix Hardcoded "Aiden Daniels" in Top Navbar & Account Dropdown (Screenshot):** Replace all static "Aiden Daniels" and "aiden@photosouth.com" with dynamic authenticated user data (`Auth::user()`) | Site Header & Photographer Navbars (`header.blade.php`, `photographer-*.blade.php`) | **Complete** | Critical | ✅ Ready to Deploy |
| 12 | **Photographer Sidebar Redesign (Match Customer Sidebar Look & Feel - Screenshot 1 & 2):** Restyle photographer sidebar into clean white floating card with top profile block, rounded pills, and matching UI | Creator Studio Views (`web/photographer-*.blade.php`) | **Pending** | High | ⏳ Pending |
| 13 | **Add "Edit Event" Action on Event Schedule Page (Screenshot 3):** Add an "Edit Event" button next to "View Event" on `/photographer-bookings` so photographers can edit albums directly | Photographer Events (`/photographer-bookings`, `PhotographerPortalController`) | **Pending** | High | ⏳ Pending |
| 14 | **Photographer Gallery Filters Upgrade (Screenshot 2):** Replace horizontal category pill badges with a clean Category Select Dropdown next to the search input, plus a "Sort by: Latest / Oldest" dropdown | Photographer Gallery (`/photographer-gallery`, `photographer-gallery.blade.php`) | **Pending** | High | ⏳ Pending |
| 15 | **AI Features (Bib & Face Recognition) Opt-in Toggle with +5% Commission Surcharge:** Ask photographer on event creation if they want AI features; if NO, skip AI scan & hide selfie/bib search; if YES, enable search and add +5% commission | Event Creation & Gallery (`/photographer-upload-new`, `/event-details/{slug}`) | **Pending** | Critical | ⏳ Pending |
| 16 | **Google Analytics Tab in Admin Settings (Screenshot 1):** Add a dedicated "Google Analytics" tab in `/admin/settings` to input Measurement ID / Script and inject dynamically in `<head>` | Admin Settings & Layout (`/admin/settings`, `app.blade.php`, etc.) | **Pending** | High | ⏳ Pending |
| 17 | **Gallery Grid Image Loading & Performance Optimization (Screenshot 2):** Fix slow loading & blank photo placeholders on gallery grid; implement optimized compressed thumbnails and `loading="lazy"` | Public Event Gallery (`/event-details/{slug}`, `event-details.blade.php`) | **Pending** | Critical | ⏳ Pending |
| 18 | **Header PhotoX Logo Visual Polish (Screenshot 3):** Fix "flat" appearance of the PhotoX logo in the main navbar; make it crisp, vibrant, and properly proportioned | Main Header (`header.blade.php`, `style.css`) | **Pending** | Medium | ⏳ Pending |
| 19 | **Default Fallback Banner Support for Empty Ad Spots:** Ensure any ad spot without an active banner assigned displays a clean default fallback banner instead of breaking or showing blank gaps | Site Banners System (`site-ad-banner.blade.php`, Banner model) | **Pending** | Medium | ⏳ Pending |
| 20 | **Remove Banner from Photographer Sidebar (Screenshot 1):** Keep banner in the main dashboard content area; remove cramped ad banner from the bottom of the photographer sidebar | Creator Studio Views (`web/photographer-*.blade.php`) | **Complete** | Medium | ✅ Ready to Deploy |
| 21 | **Clickable Links for Terms and Privacy Policy on Signup / Checkout (Screenshot 2):** Link "PhotoX terms and privacy policy" text to actual legal pages (`/terms` & `/privacy`) with `target="_blank"` | Signup & Checkout (`signup.blade.php`, `checkout.blade.php`) | **Complete** | High | ✅ Ready to Deploy |
| 22 | **Customer Checkout Banner Spot Identification (Screenshot 3):** Clearly label and manage the checkout bottom banner spot (`checkout_bottom`) in Admin Banners | Admin Banners & Checkout (`admin/banners.blade.php`, `checkout.blade.php`) | **Pending** | Medium | ⏳ Pending |
| 23 | **Upcoming Client Feedback Points:** Additional points to be shared by client | Project-wide | **Pending** | - | ⏳ Pending |

---

## 📝 Detailed Feedback Points & Implementation Notes

### Task 1: 6-Month Digital License Clarification
- **Client Note:** *"I saw somewhere the 6 Month Lic…just need to chat about that."*
- **Location in Code:** `resources/views/web/orders-downloads.blade.php` (Lines 56 & 92)
- **Status:** **Pending** (Awaiting client chat / confirmation)

---

### Task 2: "Sell Complete Gallery ONLY" Mode Enforcement (Screenshots 1 & 2)
- **Client Note / Visual Reference:**
  - When event sales rule is "Sell Complete Gallery ONLY", the lightbox purchase modal in `/event-details/{slug}` must **completely hide** Options 1, 2, and 3 (Personal Single, Commercial Single, Selfie Bundle).
  - ONLY Option 4: **Buy Complete Gallery (All Photos)** should be shown and auto-selected.
- **Status:** **Complete** (Implemented & Deployed to Live VPS)

---

### Task 3: Restrict Selfie & Bundle Options to Personal License
- **Client Note:** *"I think we need to include a line in Selfie/Athlete bundle and Complete gallery that says its Personal Lic only. that solves that issue. I feel commercial lic should be bought individually"*
- **Required Behavior:**
  - Add clear notice under Selfie Bundle and Complete Gallery stating:  
    `Personal License Only (Commercial licenses must be purchased individually)`
- **Status:** **Complete** (Implemented & Deployed to Live VPS)

---

### Task 4: Banners, Ad Spots, Placements & Sizes Audit
- **Client Note:** *"We also need to go through the banners, spots, sizes etc"*
- **Status:** **Pending**

---

### Task 5: Homepage Banner Container Fix (Screenshot 1 vs Screenshot 2)
- **Client Note / Visual Reference:**
  - Change full-width edge-to-edge black bar on Homepage into a clean, contained 1200px rounded card frame with padding (matching Screenshot 2).
- **Status:** **Pending**

---

### Task 6: Admin FAQ Manager & About Page Accordion (Screenshot 1)
- **Client Note / Visual Reference:**
  - Add **`FAQs`** under `CONTENT` section of Admin Sidebar (`/admin/faqs`).
  - Render dynamic FAQ accordion dropdown on the **About page** (`/about`) explaining features, selfie bundles, licenses, and downloads.
- **Status:** **Pending**

---

### Task 7: South African Bank Selection Dropdown & Clean Default Form
- **Client Note / Visual Reference:**
  - Convert `Bank Name` into a clean **Select Dropdown** of major SA banks.
  - **Remove hardcoded default values:** Do NOT pre-fill fake test data (like `1014829034` or `051001`). Fields must start empty.
- **Status:** **Complete** (Implemented & Deployed to Live VPS)

---

### Task 8: Photographer Vanity Handle (`@handle` / Unique Slug Validation)
- **Client Note:** *"Also the option where the photographer chooses their profile page @samplephotographer is not there, but I know it's in admin - we need to check that a page name is not already registered before they can save."*
- **Status:** **Pending**

---

### Task 9: Watermark Studio Tier Gating (Restricted on Free Tier)
- **Client Note:** *"watermark studio must not be available by default on the free tier. We decide who gets this when we setup the membership tier"*
- **Status:** **Pending**

---

### Task 10: Default Fallback Logo to Official PhotoX Logo & Disabled State Fix
- **Client Note:** *"I disabled the watermark option for this account and it still showed up with these logos - we should have photoX default logos for anything that does not have logos please"*
- **Required Behavior:**
  - Replace all `swirl_logo.png` fallbacks with the **official PhotoX default logo** (`/logo.png`).
  - When the watermark toggle is disabled (`is_watermark_enabled = false`), the live canvas and generated proofs must respect that state.
- **Status:** **Complete** (Implemented & Deployed to Live VPS)

---

### Task 11: Fix Hardcoded "Aiden Daniels" in Top Navbar & Account Dropdown
- **Client Note / Visual Reference:**
  - Statically displays `Aiden Daniels` / `aiden@photosouth.com` instead of the active `Auth::user()`.
- **Status:** **Complete** (Implemented & Deployed to Live VPS)

---

### Task 12: Photographer Sidebar Redesign (Match Customer Sidebar Look & Feel - Screenshot 1 & 2)
- **Client Note / Visual Reference:**
  - Restyle photographer sidebar to match the clean white floating card aesthetic of the Customer sidebar (Screenshot 2).
- **Status:** **Pending**

---

### Task 13: Add "Edit Event" Action on Event Schedule Page (Screenshot 3)
- **Client Note / Visual Reference:**
  - Add an **"EDIT EVENT"** button next to `VIEW EVENT` on `/photographer-bookings` so photographers can edit events directly.
- **Status:** **Pending**

---

### Task 14: Photographer Gallery Filters Upgrade (Screenshot 2)
- **Client Note / Visual Reference:**
  - Replace horizontal scrolling category pill strip with a clean **Category Select Dropdown** placed directly next to the search input.
  - Add a **Sort Dropdown** (`Sort by: Latest / Oldest / Title A-Z`) next to the search bar.
- **Status:** **Pending**

---

### Task 15: AI Features (Bib & Face Recognition) Opt-in Toggle with +5% Commission Surcharge
- **Client Note:** *"First option we need to ask them is if they want to make use of the AI features Bib and Face recognition. If yes, THEN only do we get it scanned, if no, we dont. This will save a lot of money. If they select NO the search option should then just not be in the gallery for selfie or bib. If they select YES we need to add 5% to the comm rate. Does this make sense?"*
- **Status:** **Pending**

---

### Task 16: Google Analytics Tab in Admin Settings (Screenshot 1)
- **Client Note / Visual Reference:**
  - Add **"Google Analytics"** tab in `/admin/settings` to input Measurement ID / Script and inject in `<head>`.
- **Status:** **Pending**

---

### Task 17: Gallery Grid Image Loading & Performance Optimization (Screenshot 2)
- **Client Note / Visual Reference:**
  - Fix slow loading & blank photo placeholders on gallery grid; implement optimized compressed thumbnails and `loading="lazy"`.
- **Status:** **Pending**

---

### Task 18: Header PhotoX Logo Visual Polish (Screenshot 3)
- **Client Note / Visual Reference:**
  - Fix "flat" appearance of PhotoX logo in the navbar; make it crisp, vibrant, and properly proportioned.
- **Status:** **Pending**

---

### Task 19: Default Fallback Banner Support for Empty Ad Spots
- **Client Note:** *"Think we need to have a default banner for incase there is no banner assigned to a spot - I will create them"*
- **Required Behavior:**
  - In `site-ad-banner.blade.php`, if no banner is assigned/active in the DB for that spot, display a fallback default PhotoX banner image instead of a broken or blank space.
- **Status:** **Pending**

---

### Task 20: Remove Banner from Photographer Sidebar (Screenshot 1)
- **Client Note / Visual Reference:**
  - *Screenshot 1:* Shows banner at top of dashboard AND another cramped banner at the bottom of the sidebar.
  - *Client Red Text:* *"banner for photographer admin there please. Dont think the sidebar is a good idea"*
- **Required Behavior:**
  - Keep the banner in the main dashboard content area.
  - Remove the awkward banner from the bottom of the photographer sidebar.
- **Status:** **Complete** (Implemented & Deployed to Live VPS)

---

### Task 21: Clickable Links for Terms and Privacy Policy on Signup / Checkout (Screenshot 2)
- **Client Note / Visual Reference:**
  - *Screenshot 2:* Checkbox says: `I agree to the PhotoX terms and privacy policy.`
  - *Client Red Text:* *"Please link to the terms and policy page so people can click on it"*
- **Required Behavior:**
  - Turn "terms" into a clickable link: `<a href="/terms" target="_blank" class="text-primary text-decoration-underline">terms</a>`
  - Turn "privacy policy" into a clickable link: `<a href="/privacy" target="_blank" class="text-primary text-decoration-underline">privacy policy</a>`
  - Apply on both `signup.blade.php` and `checkout.blade.php`.
- **Status:** **Complete** (Implemented & Deployed to Live VPS)

---

### Task 22: Customer Checkout Banner Spot Identification (Screenshot 3)
- **Client Note / Visual Reference:**
  - *Screenshot 3:* Shows banner below Yoco payment on checkout.
  - *Client Question:* *"which banner is this one? It's on the customer checkout page?"*
- **Action Plan:**
  - Ensure the checkout banner spot is clearly listed as `"Customer Checkout Bottom"` (spot key: `checkout_bottom` or `customer_checkout`) in Admin > Page Banners, so the client can easily manage it.
- **Status:** **Pending**

---

### Task 23: Upcoming Client Feedback Points
- Awaiting any additional points client may send.
- **Status:** **Pending**

---
