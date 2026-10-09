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

## 🚀 Next Action Plan
1. Home page, Photographers Roster, aur Photographer Details pages ke frontend views ko 100% dynamic finish karna.
2. Changes ko dono servers (`photox.aitechnotech.in` & `168.231.79.67`) par sync karke live karna taaki client weekend me check kar sake.
3. Weekend review ke baad Monday ko client ke feedback ke mutabiq pending items (AI toggle, Archiving cron, Yoco live split) ko ek-ek karke **DONE** me move karna.
