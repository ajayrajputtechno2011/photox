# PhotoX Project Master Handover & State Reference

> **Last Updated:** 2026-10-07  
> **Repository:** `https://github.com/ajayrajputtechno2011/photox.git` (`main` branch)  
> **Production VPS:** `168.231.79.67` (AlmaLinux 9.8 / Hostinger KVM 4 / UK Datacenter)  
> **Production Domain:** `https://photox.co.za` (SSL active)  
> **Development Domain:** `https://photox.aitechnotech.in`  

---

## 1. Production Website Status
The live website is **LIVE & ACTIVE** serving the full PhotoX Explore marketplace, events, galleries, photographer portals, and Yoco payments.

To switch back to holding mode anytime if needed:
```bash
ssh root@168.231.79.67 "cp /etc/nginx/conf.d/photox.conf.holding /etc/nginx/conf.d/photox.conf && nginx -s reload"
```

To switch back to live mode:
```bash
ssh root@168.231.79.67 "cp /etc/nginx/conf.d/photox.conf.live /etc/nginx/conf.d/photox.conf && nginx -s reload"
```

---

## 2. Server Infrastructure & Stack
- **OS:** AlmaLinux 9.8 64-bit
- **Root SSH Host:** `168.231.79.67`
- **Root SSH User:** `root`
- **Root SSH Password:** `PhotoX@VpsSecure2026!`
- **Web Server:** Nginx 1.20 (`/etc/nginx/`)
- **PHP:** PHP 8.4.27 (`php-fpm`, Remi repo - updated Oct 23, 2026 for upstream security advisory) with `gd`, `imagick`, `pdo_mysql`, `opcache`, `intl`, `mbstring`, `zip`, `xml`, `curl`
- **Database:** MariaDB 10.5
  - **Database Name:** `photox_db`
  - **User:** `photox_user`
  - **Password:** `Photox@Secure2026!`
- **Application Root:** `/var/www/photox`
- **Holding Page Root:** `/var/www/holding`
- **SSL Certificate:** Let's Encrypt Certbot (`/etc/letsencrypt/live/photox.co.za/`)
- **Permissions:** `chown -R nginx:nginx /var/www/photox/storage /var/www/photox/bootstrap/cache`

---

## 3. Cloudflare R2 Object Storage
- **Bucket:** `photox-production`
- **Endpoint:** `https://310705f0aa67ce203fe0b2400e4708ff.r2.cloudflarestorage.com`
- **Configured via:** Laravel Flysystem S3 driver (`FILESYSTEM_DISK=r2`)
- **Credentials:** Injected in `/var/www/photox/.env` on the VPS.

---

## 4. Yoco Payment Gateway (South Africa ZAR)
- **Integration:** Custom Yoco SDK controller in `app/Http/Controllers/Web/YocoTestController.php`.
- **Sandbox Test URL:** `https://photox.aitechnotech.in/yoco-test`
- **Public & Secret Keys:** Defined in `.env` and `config/services.php`.

---

## 5. GitHub Repository & Commit History
- **Remote:** `git@github.com:ajayrajputtechno2011/photox.git`
- **SSH Key:** `~/.ssh/photox_github` (Added as deploy key on GitHub repo)
- **Commit History:** Date-wise commits starting from **2026-09-23** to **2026-10-07**:
  - `Sep 23`: Initial setup & base Laravel architecture
  - `Sep 24`: User roles, photographer fields, AuthController
  - `Sep 25`: Event categories & models
  - `Sep 26`: Page heroes & dynamic banners
  - `Sep 27`: Membership plans database schema
  - `Sep 28`: Dynamic pricing & subscription UI
  - `Sep 29`: Watermark settings engine & admin studio
  - `Sep 30`: Event photo upload & watermark density controls
  - `Oct 01`: Sponsor branding & partner logos
  - `Oct 02`: Photographer upload portal & album management
  - `Oct 04`: Seeders, sample photos & database SQL
  - `Oct 05`: Bib number search & sub-album filtering
  - `Oct 06`: Yoco payment sandbox & Cloudflare R2 driver
  - `Oct 07`: Hostinger VPS deployment & holding page setup

---

## 6. Key Files & Paths
- **Routes:** `routes/web.php`
- **Home View:** `resources/views/web/index.blade.php` (and `demo/web-home.blade.php`)
- **Event Details:** `resources/views/web/event-details.blade.php`
- **Watermark Studio:** `resources/views/demo/watermark-studio.blade.php`
- **Yoco Test View:** `resources/views/web/yoco-test.blade.php`
- **Nginx Configs on VPS:**
  - Active: `/etc/nginx/conf.d/photox.conf`
  - Live backup: `/etc/nginx/conf.d/photox.conf.live`
  - Holding backup: `/etc/nginx/conf.d/photox.conf.holding`

---

## 7. Client Feedback & Pending Tasks (Pending Backlog)

The following points were provided by the client and are recorded in the backlog for completion:

1. **Remove Stray Floater Arrow (`/photographers`):**
   - **Client Note:** *"1 - we have a floater lol"*
   - **Details:** A stray left arrow (`<`) floating element appears at the left edge of the screen on the Photographers page. Needs removal or proper containment within the slider track.

2. **Spacing Reference Confirmed (`/membership`):**
   - **Client Note:** *"2 - this spacing works best I think"*
   - **Details:** The hero layout and banner frame spacing on `/membership` is approved by client and serves as the visual benchmark.

3. **Lightbox Modal Banner Width (Portrait Photos):**
   - **Client Note:** *"3 - I think we need to keep the banner full width of the black frame same as the landscape orientation. It becomes a bit small like this"*
   - **Details:** In `#photoInspectorModal`, when viewing a vertical/portrait photo, the sponsor banner at the bottom shrinks to the portrait width. Fix so the banner always stays 100% full width of the black frame, identical to landscape orientation.

4. **Landscape Lightbox Verification:**
   - **Client Note:** *"4 - This is great, we can still shot the portrait orientation here"*
   - **Details:** Landscape orientation preview is approved.

5. **Conditional Banner Text Overlay (Event Details & Partner Frames):**
   - **Client Note:** *"5 - text overlay still there even when I keep it blank"*
   - **Details:** When the client uploads an image with pre-baked graphics and leaves the text/title empty in Admin, the template must NOT render default overlay text (`PHOTOX PARTNER`, `Explore events ↗`). Hide all overlay text elements whenever title/badge text is empty.

6. **Payment Gateway Live Activation:**
   - Yoco payment gateway is fully operational on dev (`https://photox.aitechnotech.in`).
   - Kept in client presentation mode on live domain (`https://photox.co.za`) until final client instruction to enable live transactions.

7. **Media Manager & Banner Dynamic Rotation (October 2026):**
   - Added `rotation_interval` column to `banners` table; ad carousel rotates dynamically based on configured seconds per slide with hover pause/resume.
   - Added `media_assets` table, `MediaAsset` model, and centralized Media Library at `/admin/media`.
   - Integrated reusable Media Picker modal (`media-picker-modal.blade.php`) into Banner Add/Edit modals for seamless 1-click asset reuse without re-uploading.
   - Synced and migrated on local dev and live VPS (`168.231.79.67`).

