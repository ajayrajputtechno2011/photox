#!/bin/bash
set -e

echo "=== Copying Nginx Config for photox.aitechnotech.in ==="
cp /home/phpteam/public_webpage/php84/photox/photox.aitechnotech.in.conf /etc/nginx/conf.d/

echo "=== Testing Nginx Configuration ==="
nginx -t

echo "=== Reloading Nginx ==="
systemctl reload nginx

echo "=== Setting Up SSL Certificate (Certbot) ==="
certbot --nginx -d photox.aitechnotech.in --non-interactive --agree-tos --register-unsafely-without-email || certbot --nginx -d photox.aitechnotech.in

echo "=== Setup Complete! Open https://photox.aitechnotech.in ==="
