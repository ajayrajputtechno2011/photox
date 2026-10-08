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
- **Web Server:** Nginx 1.20 (`/etc/nginx/`)
- **PHP:** PHP 8.4.26 (`php-fpm`, Remi repo) with `gd`, `imagick`, `pdo_mysql`, `opcache`, `intl`, `mbstring`, `zip`, `xml`, `curl`
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
