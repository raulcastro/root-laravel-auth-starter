# ~/root/ Laravel Admin Auth Starter

![License](https://img.shields.io/badge/license-MIT-blue.svg) ![Laravel](https://img.shields.io/badge/laravel-v12.42.0-red) ![AdminLTE](https://img.shields.io/badge/AdminLTE-v3-blue)

Welcome to the **~/root/** Admin Authentication Starter Kit. This repository serves as the backend scaffolding for our small company's internal tools and websites, featuring a robust authentication system and a polished dashboard interface.

## 🚀 Tech Stack

* **Framework:** Laravel 12.42.0
* **Language:** PHP 8.2+
* **Database:** MySQL
* **Frontend:** Blade Templates + Bootstrap
* **Admin Theme:** [AdminLTE v3](https://github.com/jeroennoten/Laravel-AdminLTE) (Integrated via `jeroennoten/laravel-adminlte`)
* **Scaffolding:** Laravel UI

## 🛠 Progress & Features Implemented

We have successfully initialized the project with the following features:

1.  **Fresh Architecture:** Clean installation of the Laravel 12 framework.
2.  **Authentication Scaffolding:** Implemented standard `laravel/ui` auth (Login, Register, Password Reset).
3.  **AdminLTE Integration:**
    * Replaced default Laravel views with professional AdminLTE 3 templates.
    * Configured auth views (Login/Register) to match the AdminLTE theme.
4.  **Branding Customization:**
    * Updated `config/adminlte.php` to reflect **~/root/** branding.
    * Customized window titles and sidebar logos.
5.  **Smart Routing:**
    * Modified `routes/web.php` to handle smart redirects.
    * `guest` users hitting `/` are redirected to `/login`.
    * `auth` users hitting `/` are redirected to `/home`.

## 🔧 Configuration & Customization

The core configuration for the admin panel looks and behavior is located in `config/adminlte.php`.

### 1. Disabling Registration
To hide the "Register a new membership" link on the login page and disable the route:

1.  **In `routes/web.php`**:
    ```php
    Auth::routes(['register' => false]);
    ```
2.  **In `config/adminlte.php`** (Locate the `URLs` section):
    ```php
    'register_url' => null, // Setting this to null hides the link in the view
    ```

### 2. Common Auth Toggles
These settings in `config/adminlte.php` control the visibility of authentication features:

| Feature | Config Key | Default | Description |
| :--- | :--- | :--- | :--- |
| **Login Link** | `login_url` | `'login'` | Route for the login page. |
| **Password Reset** | `password_reset_url` | `'password/reset'` | Set to `null` to hide "I forgot my password". |
| **Logout** | `logout_url` | `'logout'` | Route for the logout action. |
| **Dashboard** | `dashboard_url` | `'home'` | Where users go after login/clicking logo. |

### 3. User Menu & Branding
Control the top-right user dropdown and logos:

* **User Menu:** Toggle the entire top-right user menu.
    ```php
    'usermenu_enabled' => true, // Set false to hide
    ```
* **Auth Logo:** Use a different logo specifically for the Login/Register box.
    ```php
    'auth_logo' => [
        'enabled' => false, // Set true to show a specific logo above the login box
        // ...
    ],
    ```

## ⚙️ Installation & Setup

If you are setting this up for the first time:

1.  **Clone the repository**
    ```bash
    git clone git@github.com:raulcastro/root-laravel-auth-starter.git
    cd root-laravel-auth-starter
    ```

2.  **Install PHP Dependencies**
    ```bash
    composer install
    ```

3.  **Install JS Dependencies & Compile Assets**
    ```bash
    npm install && npm run build
    ```

4.  **Environment Setup**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Configure your database credentials in `.env`.*

5.  **Run Migrations**
    ```bash
    php artisan migrate
    ```

6.  **Launch**
    ```bash
    php artisan serve
    ```

## 📄 License

This software is open-sourced software licensed under the [MIT license](LICENSE).

---
*Developed with ❤️ by ~/root/*
