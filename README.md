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


