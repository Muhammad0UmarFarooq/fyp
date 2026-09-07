# InvestBridge — Deployment Guide

## Table of Technologies / Development Stack

| Layer | Technology | Version |
|-------|-----------|---------|
| **Language** | PHP | 8.4 |
| **Framework** | Laravel | 13.7.0 |
| **Frontend Build** | Vite | 8.0.10 |
| **CSS** | Tailwind CSS | 4.2.4 |
| **JS Plugins** | Laravel Vite Plugin | 3.1.0 |
| **Database** | MySQL | 8.x |
| **Session / Cache / Queue** | Database driver | — |
| **Web Server** | Apache (mod_rewrite) | 2.4+ |
| **SSL** | Let's Encrypt (Certbot) | — |
| **File Storage** | Local (`storage/app/public`) | — |
| **Testing** | Pest | 4.7.0 |
| **Code Style** | Laravel Pint | 1.29.1 |

---

## Steps to Deploy

### 1. Server Setup

- Amazon Linux 2023 or Ubuntu 22.04 LTS
- Open Security Group ports: **22 (SSH)**, **80 (HTTP)**, **443 (HTTPS)**

### 2. Connect and Update the Server

```bash
ssh -i your-key.pem ec2-user@<PUBLIC_IP>

sudo yum update -y        # Amazon Linux
# OR
sudo apt update && sudo apt upgrade -y   # Ubuntu
```

### 3. Install Required Packages

```bash
# Amazon Linux 2023
sudo yum install -y httpd php php-cli php-mbstring php-xml php-zip php-curl \
  php-mysqlnd php-bcmath php-gd php-intl php-tokenizer unzip git

# Ubuntu
sudo apt install -y apache2 libapache2-mod-php php php-cli php-mbstring php-xml \
  php-zip php-curl php-mysql php-bcmath php-gd php-intl php-tokenizer unzip git
```

Install Composer:

```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### 4. Configure MySQL

Install and start MySQL Server:

```bash
# Amazon Linux 2023
sudo yum install -y mysql-server
sudo systemctl enable mysqld
sudo systemctl start mysqld

# Ubuntu
sudo apt install -y mysql-server
sudo systemctl enable mysql
sudo systemctl start mysql
```

Connect and create the database:

```bash
sudo mysql
```

```sql
CREATE DATABASE fyp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'investbridge_user' IDENTIFIED BY '<STRONG_PASSWORD>';
GRANT ALL PRIVILEGES ON fyp.* TO 'investbridge_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### 5. Run Database Migrations

```bash
php artisan migrate --force
```

> The `--force` flag is required in production to prevent the `are you sure?` prompt.

### 6. Run the Database Seeder

```bash
php artisan db:seed --force
```

This seeds:
- **Admin account** — `admin@investbridge.com` / `password`
- **Sample entrepreneur accounts** with profiles and pitches
- **Sample investor accounts** with profiles

### 7. Install Frontend Dependencies

```bash
npm ci
npm run build
```

This compiles Blade assets via Vite and outputs to `public/build/`.

### 8. Create the Storage Link

```bash
php artisan storage:link
```

Symlinks `public/storage` → `storage/app/public` so uploaded files (profile images, pitch videos, agreement PDFs) are web-accessible.

### 9. Set Laravel Permissions

```bash
sudo chown -R apache:apache storage bootstrap/cache    # Amazon Linux
# OR
sudo chown -R www-data:www-data storage bootstrap/cache  # Ubuntu

sudo chmod -R 775 storage bootstrap/cache
```

### 10. Configure Apache

Create the virtual host file:

```bash
sudo nano /etc/httpd/conf.d/investbridge.conf   # Amazon Linux
# OR
sudo nano /etc/apache2/sites-available/investbridge.conf  # Ubuntu
```

```apache
<VirtualHost *:80>
    ServerName investbridge.example.com
    DocumentRoot /var/www/investbridge/public

    <Directory /var/www/investbridge/public>
        AllowOverride All
        Require all granted
        FallbackResource /index.php
    </Directory>

    ErrorLog /var/log/httpd/investbridge-error.log
    CustomLog /var/log/httpd/investbridge-access.log combined
</VirtualHost>
```

Enable the site and mod_rewrite:

```bash
# Amazon Linux
sudo systemctl restart httpd

# Ubuntu
sudo a2ensite investbridge.conf
sudo a2enmod rewrite
sudo systemctl restart apache2
```

### 11. Configure Domain and HTTPS

1. Point your domain's A record to the server public IP
2. Install Certbot:

```bash
sudo yum install -y certbot python3-certbot-apache   # Amazon Linux
# OR
sudo apt install -y certbot python3-certbot-apache    # Ubuntu
```

3. Obtain and install the SSL certificate:

```bash
sudo certbot --apache -d investbridge.example.com
```

4. Auto-renewal is handled by a systemd timer (installed by Certbot).

### 12. Clear and Optimize Laravel

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

> The cache, queue, and session drivers are all set to `database`, so no Redis or separate queue worker is required. (The app does not dispatch any queued jobs.)

### 13. Verify the Application

1. Open `https://investbridge.example.com` in a browser
2. Confirm the landing page loads correctly
3. Test login with seeder credentials (see below)
4. Test file uploads (profile image, pitch video)
5. Check Apache logs for errors: `sudo tail -f /var/log/httpd/investbridge-error.log`

---

## Testing Credentials (From the Seeder)

| Role | Email | Password |
|------|-------|----------|
| Admin | `admin@investbridge.com` | `password` |
| Entrepreneur | seeded via `PitchSeeder` | `password` |
| Investor | seeded via `PitchSeeder` | `password` |

> Credentials may vary depending on the seeder state. Check `database/seeders/` for exact values.

---

## Dependencies of the Tech Stack

### PHP / Composer Dependencies

| Package | Version | Purpose |
|---------|---------|---------|
| `laravel/framework` | 13.7.0 | Core framework |
| `laravel/tinker` | 3.0.2 | Interactive REPL for debugging |
| `doctrine/dbal` | 4.4.3 | Schema changes for nullable columns in migrations |
| `guzzlehttp/guzzle` | 7.10.0 | HTTP client (transitive dependency) |

### Composer Development Dependencies

| Package | Version | Purpose |
|---------|---------|---------|
| `fakerphp/faker` | 1.24.1 | Fake data generation for testing and seeding |
| `laravel/pail` | 1.2.6 | Real-time log tailing |
| `laravel/pint` | 1.29.1 | Code style formatter |
| `laravel/pao` | 1.0.6 | Dev tooling |
| `mockery/mockery` | 1.6.12 | Mock objects for unit tests |
| `nunomaduro/collision` | 8.9.4 | Error reporting for CLI |
| `pestphp/pest` | 4.7.0 | Testing framework |
| `pestphp/pest-plugin-laravel` | 4.1.0 | Pest Laravel integrations |
| `laravel/boost` | 2.4.6 | AI agent tooling for development |

### JavaScript / npm Dependencies

| Package | Version | Purpose |
|---------|---------|---------|
| `tailwindcss` | 4.2.4 | Utility-first CSS framework |
| `@tailwindcss/vite` | 4.2.4 | Tailwind CSS Vite plugin |
| `vite` | 8.0.10 | Frontend build tool |
| `laravel-vite-plugin` | 3.1.0 | Laravel + Vite integration |
| `concurrently` | 9.2.1 | Run multiple dev commands simultaneously |

### Server / Infrastructure Dependencies

| Service | Details |
|---------|---------|
| **Web Server** | Apache 2.4+ with `mod_rewrite` |
| **PHP Runtime** | PHP 8.4 with extensions: mbstring, xml, zip, curl, mysql, bcmath, gd, intl |
| **Database** | MySQL 8.x |
| **SSL/TLS** | Let's Encrypt via Certbot |
| **Composer** | 2.x |
| **Node.js / npm** | 18+ / 9+ |
| **Git** | 2.x+ |

### Browser Dependencies

| Browser | Minimum Version | Notes |
|---------|----------------|-------|
| Chrome | 90+ | Full Tailwind v4 support |
| Firefox | 88+ | Full Tailwind v4 support |
| Safari | 15+ | CSS container queries supported |
| Edge | 90+ | Chromium-based, same as Chrome |

> No specific JavaScript framework is required on the client side. Alpine.js is loaded from CDN in some views for reactive UI components.
