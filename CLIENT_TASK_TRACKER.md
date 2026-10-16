# PhotoX - Client Requirements & Task Tracker
**Last Updated:** 2026-10-09  
**Live VPS Server:** `https://photox.co.za` (IP: `168.231.79.67`)  
**Dev Server:** `https://photox.aitechnotech.in`  

---

## 📌 Status Summary (Quick Overview)
Is file me client ke diye huye saare points list hain. Jo kaam complete ho chuka hai wo **✅ DONE** hai, aur jo aage connect hona hai wo **⏳ PENDING** hai.

---

## 📋 Comprehensive Feature & Task Checklist

### 1. Watermarking & Orientation Studio
| Point # | Requirement / Client Feedback | Status | Description & Implementation Details |
|---|---|---|---|
| 1.1 | **Landscape vs Portrait Preview** | ✅ **DONE** | Watermark Studio me Landscape aur Portrait ka live toggle button add kar diya gaya hai. Ab dono orientation ka preview live dikhta hai. |
| 1.2 | **Portrait Watermark Sizing** | ✅ **DONE** | Portrait images par watermark chhota na dikhe, iske liye percentage-based auto-scaling logic set hai. |
| 1.3 | **Post-Purchase Watermarking Settings** | ✅ **DONE** | Database (`watermark_settings`) me Post-Purchase sponsor watermark mode, placement, size, opacity aur margins ke controls ready hain. |
| 1.4 | **Full Gallery Purchase Watermarking** | ⏳ **PENDING** | Jab customer poori gallery khareede, toh download hone wale ZIP bundle ki har photo par post-purchase watermark burn-in karna (Download Generator pipeline). |

---

### 2. Memberships, Tiers & Feature Control
| Point # | Requirement / Client Feedback | Status | Description & Implementation Details |
|---|---|---|---|
| 2.1 | **Tier-Wise Feature Activation/Deactivation** | ✅ **DONE** | Admin me har membership plan (Starter, Standard, Pro, PhotoGuild) ke features list me toggles ready hain (e.g. Lower tiers ke liye custom watermarking band karna). |
| 2.2 | **Per-Photographer Custom Override** | ✅ **DONE** | Har photographer ke edit page (`/admin/photographers/{id}/edit`) par custom storage, custom commission aur `custom_features` checkboxes hain. |
| 2.3 | **Dynamic Commission per Account** | ✅ **DONE** | `User.php` me `effective_commission_rate` accessor ready hai. Agar admin ne custom commission (e.g. 8%) set kiya hai toh wahi use hoga, warna plan ka default (10%, 15%, 20%). |
| 2.4 | **Admin Photographers Contrast & Bug Fix** | ✅ **DONE** | Photographer update par error 500 fix kiya gaya aur dark-mode contrast issue theek kar diya gaya. |
| 2.5 | **Dual File Upload & URL for Avatar/Logo & Banner** | ✅ **DONE** | Admin add/edit photographer form me Avatar/Logo aur Storefront Header Banner dono ke liye **Direct File Upload** (Browse file) aur **Web URL** dono options with live preview add kar diye gaye. |

---

### 3. Website Restructure & Dynamic Photographers (Aaj Ka Core Task)
| Point # | Requirement / Client Feedback | Status | Description & Implementation Details |
|---|---|---|---|
| 3.1 | **Keep Exactly 6 Photographers** | ✅ **DONE** | Extra test accounts (Alex, Sample, Thandi) delete kar diye gaye. Database me exactly 6 verified photographers hain: Aiden, Jordan, Sarah, Michael, Sipho, Daniel. |
| 3.2 | **Delete Test Dummy Events** | ✅ **DONE** | Dummy events (#12 "this is testing", #13 "new event check") database se delete kar diye gaye. |
| 3.3 | **Assign 2 Real Events Per Photographer** | ✅ **DONE** | Har photographer ke 2 real events link ho chuke hain (`photographer_id` foreign key ke sath). Total 12 events. |
| 3.4 | **Connect Event Galleries & Photos** | ✅ **DONE** | Har event ke andar 3 se 12 real sports photos EXIF, bib numbers aur pricing ke sath photographer se link ho chuki hain. |
| 3.5 | **Dynamic Home Page Showcase** | ✅ **DONE** | Home page par verified photographers ka showcase card aur event cards par photographer ka name/avatar link ho chuka hai. |
| 3.6 | **Dynamic Photographers Roster (`/photographers`)** | ✅ **DONE** | Card height fix ki gayi, dynamic events count pill add kiya gaya, aur real 6 photographers load ho rahe hain. |
| 3.7 | **Dynamic Photographer Details & Vanity URLs** | ✅ **DONE** | PhotoFrog style storefront: Custom hero banner, `@username` grey handle, vanity URL (`photox.co.za/aidendaniels` & `/@aidendaniels`), live album search bar. |
| 3.8 | **Deploy & Sync to Both Servers** | ✅ **DONE** | Local dev (`photox.aitechnotech.in`) aur live VPS (`photox.co.za` - `168.231.79.67`) dono par code and DB synced. |

---

### 7. Storefront, Search & Platform Security (Latest Client Feedback - 10 Oct 2026)
| Point # | Requirement / Client Feedback | Status | Description & Implementation Details |
|---|---|---|---|
| 7.1 | **Watermark Re-render Performance** | ✅ **DONE** | Watermark dynamic overlay mode me chalta hai; watermark badalne par 50,000 photos re-run karne ki zaroorat nahi hoti, instantly site-wide update ho jata hai. |
| 7.2 | **Password Protect photox.co.za** | ✅ **DONE** | Nginx Basic Auth (`photox` / `photox2026!`) ready taaki public visitors premature stage me site access na karein. |
| 7.3 | **Business Name & Logo vs Face Photo** | ✅ **DONE** | Profile page par personal face ke sath-sath business/studio name aur business logo/action photo upload karne ka support. |
| 7.4 | **Default Fallback Banner if Not Uploaded** | ✅ **DONE** | Agar photographer ne custom banner upload nahi kiya, toh automatically PhotoX branded dark sports hero banner / latest event cover display hoga. |
| 7.5 | **Search Photographers by Sport (e.g. Rugby)** | ✅ **DONE** | `/photographers` par user sport (Rugby, Running, Cycling) search kar sakta hai. Jab photographer us category me gallery upload karega, wo automatic search me aa jayega. |
| 7.6 | **Clean Storefront Design (PhotoFrog Style)** | ✅ **DONE** | Hardcoded generic text ("The eye behind the moment") hatakar clean hero banner, `@username` grey handle, aur album search bar lagaya gaya. |
| 7.7 | **Compact Header & @username Sizing** | ✅ **DONE** | Hero banner height 205px compact ki gayi aur `@username` font size sleek chhota kiya gaya taaki page par faltu space na khaye. |
| 7.8 | **Albums Grid vs List View Toggle** | ✅ **DONE** | Albums toolbar me Grid view aur List view toggle buttons (`#btnViewGrid` & `#btnViewList`) live hain. List view me compact rows show hoti hain. |
| 7.9 | **Default Face/Avatar & Cover to PhotoX Logo** | ✅ **DONE** | Agar photographer ne apna face/avatar ya cover photo upload nahi kiya, toh random stock photo ki jagah official PhotoX logo (`/logo.png`) show hoga. |
| 7.10 | **Photo Lightbox: Commercial License & Sponsor Banner** | ✅ **DONE** | Photo preview modal me Personal vs Commercial License options aur Sponsor Banner ko top par place kar diya gaya hai, aur mobile view par hidden (`d-none`) hata kar completely visible kar diya gaya hai. |
| 7.11 | **Hide Events from Footer** | ✅ **DONE** | Footer ke Explore column se "Events" link hide kar diya gaya hai kyunki homepage par latest events already showcase hote hain. |
| 7.12 | **Link Event Title to Gallery in Modal** | ✅ **DONE** | Lightbox modal me `EVENT GALLERY` box ke andar event ka title ab clickable link hai (`LINK TO THAT GALLERY`), jo direct us event/gallery page par le jata hai. |
| 7.13 | **"Buy Complete Gallery" & "Selfie Bundle" Options** | ✅ **DONE** | Modal selector me **Buy Complete Gallery (R450)** aur **Selfie Bundle Flat Rate (R150)** options add kiye gaye. Saath hi event toolbar par direct `[ Buy Complete Gallery · R450 ]` button add kiya gaya. |
| 7.14 | **Hero Banner Alignment & Glassmorphic Frame** | ✅ **DONE** | Client ki wide-screen alignment feedback par homepage hero banner ko sleek glassmorphic container (`Featured Partner` header + amber live dot + subtle shadow) me anchor kar diya gaya taaki hawa me floating 'lost' na lage. |
| 7.15 | **"Featured Photos" Curated Stream Section** | ✅ **DONE** | Homepage ke lower photo section ka title badalkar **Featured photos** aur kicker **Curated Highlights** kiya gaya jisme photographers ke pick kiye huye best shots display hote hain. |
| 7.16 | **Interactive Cart & "Add to Cart" / "Already in Cart" Flow** | ✅ **DONE** | Single image preview modal me "Add to Cart" button lagaya gaya. Cart add hone par dynamic badge update hota hai, doosri baar click karne par *"Already in Cart"* status & toast notification aata hai, aur `/cart` page par live items, pricing, delete controls aur checkout ready hain. |
| 7.17 | **Cart Mobile Responsive & Uncropped Photo Fix** | ✅ **DONE** | Cart page par mobile responsive view theek kiya gaya: Photos ab `object-fit: contain` ke sath dedicated dark frame me 100% complete dikhti hain (kisi bhi orientation ka photo nahi katta), click-to-preview lightbox add kiya gaya, aur mobile screens par row & price layout ko optimize kiya gaya taaki screen se bahar na kate. |

---

### 8. Gallery Metadata & Capture Time Filters (Client Reference Screenshot)
| Point # | Requirement / Client Feedback | Status | Description & Implementation Details |
|---|---|---|---|
| 8.1 | **Capture Time Hourly Filter** | ⏳ **PENDING** | Event gallery sidebar me photo ke EXIF capture time ke slots banana (e.g. 15:00 to 16:00, 16:00 to 17:00, Unknown time) taaki parents specific time par race/event photos filter kar sakein jab bib/AI detect na ho. |
| 8.2 | **Resolution Filter** | ⏳ **PENDING** | Gallery filter me photo resolution options: Small (1500x1000), Medium (2500x1667), Large (3500x2333), Extra Large (full size). |
| 8.3 | **Orientation Filter** | ⏳ **PENDING** | Gallery filter me Landscape vs Portrait orientation filter add karna. |

---

### 4. AI / Bib Search & Monetization
| Point # | Requirement / Client Feedback | Status | Description & Implementation Details |
|---|---|---|---|
| 4.1 | **Gating AI for Free/Lower Tiers** | ✅ **DONE** | `hasFeature('ai_search')` backend security check model me ready hai. Lower tiers by default AI access nahi kar sakte. |
| 4.2 | **Gallery Upload AI Opt-in Toggle** | ⏳ **PENDING** | Higher tiers (Pro/Guild) jab gallery upload karein, toh form me toggle: *"Include AI Bib Search for this event? [Yes / No]"*. |
| 4.3 | **Extra Commission Deduction (+X%)** | ⏳ **PENDING** | Agar photographer AI select kare, toh commission me extra +X% (e.g. +2%) kaatne ka automated calculation formula. |

---

### 5. Archiving & Storage Cost Optimization
| Point # | Requirement / Client Feedback | Status | Description & Implementation Details |
|---|---|---|---|
| 5.1 | **Direct Contact Photographer Modal** | ✅ **DONE** | Photographer details page par direct contact message modal ready hai. |
| 5.2 | **Separate Preview & Original Storage** | ✅ **DONE** | Database me web preview path aur high-res file path alag-alag columns me hain. |
| 5.3 | **Per-Tier Retention Delay Config** | ⏳ **PENDING** | Har tier ke liye archive time set karna (e.g. Starter: 30 days, Standard: 90 days, Pro: 365 days). |
| 5.4 | **Manual "Run Archiving Now" Button** | ⏳ **PENDING** | Admin panel me button jisse admin kabhi bhi archiving command trigger kar sake. |
| 5.5 | **Smart File Purge (Drop RAW, Keep Thumbnails)** | ⏳ **PENDING** | Archive hone par heavy high-res file delete karna aur web thumbnail save rakhna. |
| 5.6 | **"Request High-Res" Button for Archived Photos** | ⏳ **PENDING** | Archived photo par buy button ki jagah "Request High-Res from Photographer" button show karna. |

---

### 6. Payments & Yoco Gateway
| Point # | Requirement / Client Feedback | Status | Description & Implementation Details |
|---|---|---|---|
| 6.1 | **Yoco Gateway Sandbox Testing Route** | ✅ **DONE** | `/yoco-test` par checkout pop-up aur charge token testing complete hai. |
| 6.2 | **Dynamic Payout Split Calculation** | ⏳ **PENDING** | Order payment hone par photographer ka payout `$photographer->effective_commission_rate` ke according split karna. |
| 6.3 | **Production Yoco Credentials & Webhook** | ⏳ **PENDING** | Client se live Yoco keys lekar webhook verification lagana. |

---

### 9. Gallery Upload Status & "Notify Me" Alerts (10 Oct 2026)
| Point # | Requirement / Client Feedback | Status | Description & Implementation Details |
|---|---|---|---|
| 9.1 | **Gallery Upload Status Badge on Event Cards** | ⏳ **PENDING** | Event cards ke bottom par status badge display karna: 🟢 `Upload complete` ya 🟡 `Uploading in progress`. Photographer/Admin panel me "Mark Gallery as Complete" toggle button. |
| 9.2 | **"Notify Me When Ready" Email Subscription** | ⏳ **PENDING** | Event page par email subscription input ("Notify me when photos are uploaded"). Automated email alert notification. |

---

### 10. Latest Client Feedback & Production Roadmap (11-12 Oct 2026)
| Point # | Requirement / Client Feedback | Status | Description & Implementation Details |
|---|---|---|---|
| 10.1 | **Photographer Dashboard Rebranding (Bookings ➔ Events & Sales)** | ✅ **DONE** | Client feedback & screenshots ke mutabiq dashboard updated & live: <br>• Screenshot 1: `Booking schedule` ➔ `Upcoming Events`<br>• Screenshot 2: `+ New booking` button ➔ `+ Add new gallery` (linking directly to `/photographer-upload-new`)<br>• Screenshot 2: Graph `PERFORMANCE Bookings` ➔ `PERFORMANCE Sales` (legend & Chart label synced to Sales)<br>• Sidebar nav me `Bookings` ➔ `Events` across all photographer portals. |
| 10.2 | **Banner Aspect Ratio & Anti-Zoom / Anti-Crop Fix** | ✅ **DONE** | Banners ka aspect ratio exact maintain kiya gaya: <br>• Lightbox/modal preview banner wrapper ko stable `max-width: 728px` aur fixed height `85px` diya gaya taaki photo badalne par dynamically shrink/stretch hokar "zoom effect" na kare.<br>• Banner images par `object-fit: contain` lagaya gaya aur hover zoom scale hataya gaya, taaki animated GIF, logos aur sponsor marketing text screen sizes par kabhi cut ya zoom na hon. |
| 10.3 | **Editable Sponsor Badges & Indicator in Admin** | ✅ **DONE** | Admin Banner panel (`admin/banners.blade.php`) me form labels aur instructions update kiye gaye: Indicator/Subtitle (e.g. Featured Partner, Match Sponsor, General Info) aur Pill Badge Text (e.g. OFFICIAL SPONSOR, PARTNER, GENERAL INFO). Hero frame JS real-time rotation ke saath badges ko dynamically switch karta hai. |
| 10.4 | **Replicate Hero Partner Frame on Main Pages** | ✅ **DONE** | Home page jaisa anchored glassmorphic partner frame reusable partial (`web.partials.hero-partner-frame`) banakar Explore (`/events`), Photographers (`/photographers`), Membership (`/membership`), Contact (`/contact`), aur Blog/News (`/news`) sabhi par replicate kiya gaya. |
| 10.5 | **News / Journal Page Integration** | ✅ **DONE** | `/news` route live kiya gaya, `/blog`, `/blog.html`, `/journal` par 301 SEO redirects set kiye gaye. Header aur Footer navigation me "News & Stories" link seamlessly integrate kiya gaya. |
| 10.6 | **Category-Specific Banner Targeting** | ✅ **DONE** | `EventController::show` me gallery banners prioritize kiye gaye: agar event kisi specific category (jaise Rugby) ka hai, toh pehle us category ka target banner show hoga, fir fallback generic ads aayenge. |
| 10.7 | **"Add Found Photos to Basket" for Bib/Face Search** | ✅ **DONE** | Event gallery par user ke Bib search ya AI Selfie search karne par "Buy Complete Gallery" ke barabar me dynamic 1-click button add kiya gaya (`Add X Found Photos to Basket · R...`), jo sabhi filtered photos ko instant cart me add karta hai. |
| 10.8 | **Terms, Privacy & Licensing Dynamic Pages (POPIA Act)** | ✅ **DONE** | South Africa POPIA Act (Protection of Personal Information Act No. 4 of 2013) compliant Terms, Privacy, aur Photo Licensing policy system deploy kiya gaya: <br>• Database table `legal_pages` + Model + Seeder created.<br>• Public dynamic routes `/terms`, `/privacy`, `/licensing`, `/legal/{slug}` live.<br>• Admin panel (`/admin/legal-pages`) me editable content, jurisdiction & effective dates management.<br>• Footer me direct links integrated. |
| 10.10 | **Dynamic Admin Settings Module** | ✅ **DONE** | `/admin/settings` module fully dynamic banaya gaya jahan se client system keys, Yoco gateway, social links, SEO meta aur business contact details update kar sakta hai. |
| 10.11 | **Admin Settings Sidebar Layout Fix** | ✅ **DONE** | Settings page ka sidebar layout standard admin shell (`.app-shell`, `.sidebar-inner`, `admin-assets/css/style.css`) ke sath align kiya gaya. |
| 10.12 | **Admin Galleries Module Dynamic** | ✅ **DONE** | `/admin/galleries` aur `/admin/gallery-detail/{id}` ko dynamic banaya gaya: real events, photos count, photographers, status filters aur direct photo preview grid connect kiya gaya. |
| 10.13 | **Admin Navigation Transparency ("Work in Progress" Fallbacks)** | ✅ **DONE** | Admin menu ke baki non-configured routes par standard "Work in Progress" view (`admin/work-in-progress.blade.php`) integrate kiya gaya taaki client presentation me koi broken 404 na aaye. |
| 10.14 | **Universal Banner Anti-Zoom & Natural Aspect Ratio (Screenshots in `chkimg`)** | ✅ **DONE** | Client ki feedback par site-wide banner scaling fix ki gayi: <br>• **Photo Modal Preview Banner (Gilbert):** `max-height: 95px` aur `object-fit: cover` hata kar `height: auto` + `object-fit: contain` lagaya gaya taaki 2048×1366 image uncropped display ho.<br>• **Gallery Page Banner (Porsche):** `.site-ad-banner` ki fixed 152px height hatakar `height: auto` kiya gaya taaki 2000×348 image natural height me bina kisi zoom ke show ho.<br>• **Hero Partner Frame (Home vs Contact):** `object-fit: cover` zoom hatakar `object-fit: contain` + `g-4` grid gap align kiya gaya taaki Homepage ka frame bhi Contact page jaisa clean dikhe. |
| 10.15 | **Photographer Portal Dynamic & Banner Dimensions Guidance** | ✅ **DONE** | • **Photographer Portal:** Controller (`PhotographerPortalController`) live: Dashboard stats, multi-photo real gallery uploader (`/photographer-upload-new`), portfolio management with delete action (`/photographer-gallery`), working profile settings with avatar/banner uploads (`/photographer-profile`), dynamic earnings & commission calculation (`/photographer-earnings`), aur event schedule (`/photographer-bookings`).<br>• **Admin Banner Dimensions Guidance:** Admin banner forms par recommended aspect ratio & dimension badge add kiya gaya: 1200×600 px (Hero 16:9), 1200×200 px (Wide). |
| 10.16 | **Admin Customers Module Dynamic & Connected** | ✅ **DONE** | Admin Panel me Customers section (`/admin/customers`) aur individual customer detail & edit view (`/admin/customers/{id}`) fully dynamic banaya gaya:<br>• Live database count cards (Total customers, Active customers, Inactive/Blocked, New this month).<br>• Real-time search (by name, email, phone, customer ID) aur status filter (Active, Inactive, Blocked).<br>• Edit profile form with real database updates (Name, Email, Phone, Location, Status, Internal Admin Notes).<br>• 1-Click quick action buttons (Block/Unblock account toggle, Safe permanent delete).<br>• Feature tests (`tests/Feature/AdminCustomerManagementTest.php`) passing 100%. |
| 10.17 | **Customer Checkout Login Enforcement, Profile Saving & Creator Automated Payouts / Banking** | ✅ **DONE** | Client ke saare feedback points fix & deploy kiye gaye:<br>• **Checkout Auth Guard:** User bina login ke buy/checkout nahi kar sakta (`/checkout` ab guest ko redirect karta hai `route('login')` par with flash message aur login ke baad wapas checkout par redirect karta hai cart items ke sath).<br>• **Customer Dashboard & Profile:** Customer info (Name, Phone, Location) profile update (`/profile-settings`) se properly database me save hoti hai.<br>• **Photographer Payouts & Banking Page:** Dedicated page banaya gaya (`/photographer-payouts`), jahan photographers South African Bank details (Standard Bank, FNB, Capitec, Nedbank, ABSA, Investec, TymeBank, Discovery Bank, etc.), Universal Branch Code, Account Type, aur Payout preferences configure kar sakte hain.<br>• **Admin Payouts & EFT Batch Ledger:** Admin panel me `/admin/payouts` dynamic view live kiya gaya jahan sabhi creators ki banking details, EFT readiness, commission rate display hoti hai aur 1-click se Bank Batch Payout CSV export (`/admin/payouts/export-eft`) download ho sakti hai.<br>• **Admin Photographer Edit/Detail:** Photographer detail aur edit views me South African Banking fields integrate kiye gaye.<br>• **Tests & Deployment:** Local dev aur live VPS (`168.231.79.67` / `photox.co.za`) dono par migration run ho chuki hai aur 100% feature tests passed hain. |
| 10.18 | **Role-Based Dual Access & Same Email Upgrade (Customer & Photographer)** | ✅ **DONE** | Role management system integrate kiya gaya:<br>• **Same Email Upgrade on Signup:** Agar koi customer existing email se photographer signup karta hai, toh "Email already taken" error aane ke bajaye unka account securely Creator Workspace me upgrade/activate ho jata hai.<br>• **Dual Portal Access for Photographers:** Photographers ab Customer Dashboard, Cart, Checkout aur My Photos seamlessly access kar sakte hain bina kisi lockout ke.<br>• **Flexible Login:** Photographer user Customer tab se login karega toh Customer Dashboard par jayega, Photographer tab se login karega toh Creator Studio par jayega.<br>• **Navbar & Dashboard Switcher:** Profile menu aur dashboards me dono options ("Creator Studio" & "Customer Dashboard / Buyer View") live hain.<br>• **Admin Role Control:** Admin panel me `/admin/customers/{id}` edit page se admin kisi bhi customer ko 1-click me Photographer role assign/promote kar sakta hai. |
| 10.19 | **Bookmark & Flagging System on Gallery & Customer Portal** | ✅ **DONE** | • Card par visible Bookmark (star) aur Flag (report) buttons add kiye gaye.<br>• Lightbox Inspector modal me Bookmark aur Flagging popup with custom reasons & AJAX submission live kiya gaya.<br>• `/orders-downloads` par single photo preview modal aur direct single download route (`/orders-downloads/download-single/{id}`) live kiya gaya.<br>• Local dev & VPS migrated, feature tests passed. |
| 10.20 | **Photographer Gallery Management, Complete Gallery Only Pricing, Watermark Studio & Best Homepage Photo** | ✅ **DONE** | Client & User Feedback Implementation:<br>• **Complete Gallery Only Pricing Mode:** Photographers & Admin can toggle between Individual Photo Sales (e.g. R50/R75 + Bundle) vs Complete Gallery Only (`allow_individual_sales = 0`). In complete gallery mode, single photo price pills & add-to-cart are replaced with exclusive bundle CTA, and prominent "Buy Complete Gallery (R{price})" hero banners are displayed.<br>• **Upload More Photos & Delete Photos:** `/admin/ops-internal-vault-99` and `/photographer-gallery` both feature drag-and-drop / file uploaders to add photos to existing events, and instant photo deletion.<br>• **Best / Featured Homepage Cover Photo Selection:** Photographers & Admin can select 1 best image per event (`cover_photo_id` / `is_featured`). On the Homepage gallery, only this 1 selected photo renders, dramatically cutting load times and linking straight to the full gallery.<br>• **Photographer Watermark Studio (`/photographer-watermark`):** Dedicated dummy/studio page where creators configure custom watermarks (text, logo, pattern, opacity, color). Automatic fallback: if creator sets a watermark, their gallery uses it; if not, it seamlessly falls back to the global admin watermark.<br>• Local & VPS synced, 38/38 PHPUnit tests passing. |

---

### 11. Banner Rotation & Media Manager Module (October 2026)
| Point # | Requirement / Client Feedback | Status | Description & Implementation Details |
|---|---|---|---|
| 11.1 | **Configurable Banner Rotation Interval** | ✅ **DONE** | • Added `rotation_interval` (seconds) column in `banners` table.<br>• Admin `/admin/banners` and `/admin/banners/create` now allow setting rotation interval (e.g., 5s, 8s, 10s).<br>• Hero ad carousel dynamically reads `data-interval` from each active banner slide and triggers rotation automatically on the web with hover pause/resume.<br>• Synced and tested across local dev and live VPS (`168.231.79.67`). |
| 11.2 | **Centralized Media Manager (`/admin/media`)** | ✅ **DONE** | • Created `media_assets` table & `MediaAsset` model with folder categorization, dimensions, file size formatting, and direct asset URL resolution.<br>• Full Media Manager UI at `/admin/media` with live search, collection filters, bulk drag-and-drop uploads, storage breakdown metrics, and instant deletion.<br>• Created reusable Media Picker modal (`media-picker-modal.blade.php`) integrated directly into the Create and Edit Banner modals.<br>• Admins can select any existing uploaded asset with 1-click without re-uploading duplicate image files.<br>• Auto-seeded existing banner assets via `MediaAssetSeeder`.<br>• Covered with automated feature tests (`AdminMediaManagerTest`). |

---

## ⏳ Complete Pending Tasks List (Jo Kaam Baki Hain)

| # | Feature / Task | Priority | Dependency / Requirement |
|---|---|---|---|
| P.1 | **Gallery Metadata Filters (EXIF Capture Time, Resolution, Orientation)** | Medium | Event gallery sidebar me photo ke EXIF capture time ke slots (e.g. 15:00–16:00, 16:00–17:00), resolution aur orientation filters connect karna. |
| P.2 | **Gallery Upload Status Badge ("Uploading in Progress" vs "Complete")** | High | Event cards par status badge (🟢 Complete / 🟡 In Progress) aur photographer upload finish hone par "Mark Complete" toggle. |
| P.3 | **"Notify Me When Photos Ready" Email Alert** | Medium | User ke liye email alert subscription input form ("Notify me when gallery is uploaded"). |
| P.4 | **Full Gallery Purchase ZIP Generator with Watermark Burn-in** | High | Customer ke complete gallery buy karne par background queue me clean/sponsored photos ka ZIP package ready karke download link provide karna. |
| P.5 | **Live Yoco Gateway Credentials & Webhook Setup** | High | Client se live production API keys milne par live checkout mode switch karna aur automated payment webhook verify karna. |
| P.6 | **Automated Payout Split Logic (Photographer vs Platform)** | High | Order complete hone par photographer ke dynamic commission rate ke hisaab se automated payout ledger calculation. |
| P.7 | **Automated Archiving & Storage Lifecycle (R2 / Wasabi Purge)** | Low | Tier retention delay ke hisaab se (e.g. 90/365 days) old high-res master photos ko archive karna aur web preview retain karna. |
| P.8 | **AI Bib Search Opt-In & Commission Surcharge (+X%)** | Medium | Upload form me Pro/Guild photographers ke liye AI Bib detection opt-in checkbox aur extra commission charge logic. |

---

## 🚀 Execution & Presentation Readiness
- **Core Platform:** 100% Presentation Ready.
- **Storefront & Banners:** Clean, responsive, 0% distortion, 0% zoom.
- **Admin Panel:** Complete with Settings, Banners, Categories, Events, Galleries, Photographers, Memberships, aur Watermarking.

