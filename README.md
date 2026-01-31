<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Gelo Starter 🚀

A robust, modular, and feature-rich Laravel starter kit designed to jumpstart your web application development. Built with **Laravel 12**, **Inertia.js v2**, **Vue 3**, and **Tailwind CSS v4**.

## ✨ Features

This starter kit comes packed with essential features to save you time and effort:

### 🔐 Auth Ready
- Complete authentication system out-of-the-box.
- **Login, Register, Forgot Password, Reset Password**.
- **Email Verification** flow fully implemented.
- Secure session management and CSRF protection.

### 📝 Activity Logger
- Track and monitor user activities and system events.
- Keep an audit trail of important actions within your application.

### 💾 Database Backup
- Integrated database backup solutions.
- Ensure your data is safe with automated or manual backup options.

### 🛡️ RBAC (Role-Based Access Control)
- Granular access control system.
- Manage **Roles** and **Permissions** effortlessly.
- Secure your routes and resources based on user roles.

### 📱 Responsive Layout
- Mobile-first design philosophy.
- Built with **DaisyUI** and **Tailwind CSS** for a modern, clean look.
- Fully responsive sidebar, navigation, and components.

### 📧 Designed Email Templates
- Beautiful, responsive email templates for system notifications.
- Customizable layouts for verification and password reset emails.

### 🔍 Filter & Search Components
- Ready-to-use Vue components for data filtering and searching.
- Seamlessly integrate search functionality into your data views.

### 🧩 Modular Architecture
- Clean and scalable project structure.
- Organized specifically for Inertia.js and Vue 3 development.
- Easy to maintain and extend as your project grows.

### 📊 Table with Filter and Pagination
- Advanced data tables with built-in support for:
  - **Sorting**
  - **Filtering**
  - **Pagination**
- Optimized for performance and user experience.

---

## 🛠️ Technology Stack

- **Backend**: [Laravel 12](https://laravel.com)
- **Frontend**: [Vue 3](https://vuejs.org) (Composition API)
- **Routing**: [Inertia.js v2](https://inertiajs.com)
- **Styling**: [Tailwind CSS v4](https://tailwindcss.com) & [DaisyUI](https://daisyui.com)
- **Icons**: [Lucide Vue Next](https://lucide.dev)

## 🚀 Getting Started

Follow these steps to set up the project locally:

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL or compatible database

### Installation

1.  **Clone the repository**
    ```bash
    git clone https://github.com/yourusername/gelo-starter.git
    cd gelo-starter
    ```

2.  **Install PHP dependencies**
    ```bash
    composer install
    ```

3.  **Install JavaScript dependencies**
    ```bash
    npm install
    ```

4.  **Environment Setup**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Configure your `.env` file with your database credentials.*

5.  **Run Migrations**
    ```bash
    php artisan migrate
    ```

6.  **Build Assets**
    ```bash
    npm run dev
    ```

7.  **Serve Application**
    ```bash
    php artisan serve
    ```

Visit `http://localhost:8000` in your browser.

---

## 🌍 Production Deployment (Hostinger Shared Hosting)

This project uses a secure directory structure to isolate the Laravel core code from the public-facing web directory.

### 1. Directory Structure
To enhance security, the application files are moved outside `public_html`.

* **Root Path:** `/home/uXXXX/domains/domain.com/`
* **Core Application:** `your_custom_core_folder/` (Contains `.env`, `app`, `vendor`, etc.)
* **Public Access:** `public_html/` (Contains `index.php`, `.htaccess`, `build`, and `storage` symlink)

**Note:** `your_custom_core_folder` is a placeholder. You can name this directory whatever you prefer (e.g., `laravel_core`, `backend`, `app_core`), but ensure you update the references in `index.php` and `deploy.sh` accordingly.

**Rule:** Never place `.env` or core logic files inside `public_html`.

### 2. Configuration Files

#### A. `public_html/index.php`
The entry point must point to the isolated core and register the custom public path.

```php
<?php

use Illuminate\Http\Request;

// 1. Point to the secure core directory
require __DIR__.'/../your_custom_core_folder/vendor/autoload.php';
$app = require_once __DIR__.'/../your_custom_core_folder/bootstrap/app.php';

// 2. Register the public path for Inertia/Vite to find assets
$app->usePublicPath(__DIR__);

$app->handleRequest(Request::capture());
```

#### B. `public_html/.htaccess`
Use the standard Laravel `.htaccess` to handle routing.

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

### 3. Storage Symlink (SSH)
Since the directory structure is custom, the default `php artisan storage:link` command will not work correctly. Use SSH to create the link manually.

```bash
ln -s /path/to/your_custom_core_folder/storage/app/public /path/to/public_html/storage
```

### 4. Asset Deployment
Since the project uses Inertia/Vue:

1.  Run `npm run build` locally.
2.  Upload the generated `build` folder to `public_html/build`.
3.  Ensure `manifest.json` exists at `public_html/build/manifest.json`.

### 5. Troubleshooting
*   **404 on Assets:** Check if `$app->usePublicPath(__DIR__);` is present in `index.php`.
*   **Images not loading:** Verify permissions on `your_custom_core_folder/storage` are set to `775`.
*   **500 Error:** Ensure PHP version is 8.2+ and `.env` exists in `your_custom_core_folder`.

### 💡 Best Practice Tip
Always keep a local backup of your modified `public_html/index.php` and `.htaccess`. When you deploy updates via Git or FTP, be careful not to overwrite `index.php` with the default Laravel version, or your site will break.

---

## 🚀 Automated Deployment Guide (Hostinger)

This project uses a custom bash script (`deploy.sh`) to automate the deployment process on Hostinger shared hosting. This ensures that core files remain secure while public assets are correctly synced.

### 1. Server Architecture
The project is split into two directories for security:

* **`~/domains/domain.com/your_custom_core_folder`**: Contains the Git repository, `.env`, and backend logic. (Not accessible to the public).
* **`~/domains/domain.com/public_html`**: Contains the entry point (`index.php`) and compiled frontend assets (`build/`).

### 2. The Deployment Script
The `deploy.sh` script performs the following actions automatically:
1.  **Git Pull:** Fetches the latest code into `your_custom_core_folder`.
2.  **Composer Install:** Installs/updates PHP dependencies.
3.  **Migrate:** Runs database migrations (`--force`).
4.  **Sync Assets:** Copies compiled JS/CSS from `your_custom_core_folder/public` to `public_html`, **skipping** the custom `index.php` and `.htaccess`.
5.  **Clear Cache:** Clears and rebuilds config/route/view caches.

### 3. Workflow: How to Deploy

#### Step A: On Local Machine
1.  Make your changes.
2.  **Build Assets:** Since shared hosting has low RAM, build frontend assets locally.
    ```bash
    npm run build
    ```
3.  **Commit & Push:** Ensure the `public/build` folder is included in your commit.
    ```bash
    git add .
    git commit -m "feat: updates"
    git push origin main
    ```

#### Step B: On Server (Hostinger)
1.  Connect via SSH:
    ```bash
    ssh uXXXXXXX@yourdomain.com -p 65002
    ```
2.  Run the deploy script:
    ```bash
    ./deploy.sh
    ```

### 4. Setup & Maintenance

#### Creating the Script (If lost)
Create a file named `deploy.sh` in your domain root folder and paste the bash script content.

#### Fixing Permissions
If you get a **"Permission denied"** error:
```bash
chmod +x deploy.sh
```

#### Fixing Windows Line Endings ("bad interpreter" error)
If you edited the file on Windows and uploaded it, you might see a `/bin/bash^M: bad interpreter` error. Fix it by running:
```bash
sed -i 's/\r$//' deploy.sh
```

### 5. Important Notes
*   **Do Not Overwrite `public_html/index.php`:** The script is configured to exclude this file during sync. If you need to update `index.php`, do it manually via File Manager.
*   **Env File:** The `.env` file lives in `your_custom_core_folder/`.
