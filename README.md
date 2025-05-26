# Testimony Creator

[![Laravel Forge Site Deployment Status](https://img.shields.io/endpoint?url=https%3A%2F%2Fforge.laravel.com%2Fsite-badges%2F369ec21c-2860-46e0-a628-5ded897a238a%3Flabel%3D1&style=plastic)](https://forge.laravel.com/servers/922188/sites/2728199)

A lightweight web app for creating and managing Christian testimonies. Built with **Laravel**, **Livewire**, **MySQL**, and **Tailwind CSS**.

## 🔧 Tech Stack

-   **Backend:** Laravel 10+
-   **Frontend:** Livewire 3, Blade templates
-   **Styling:** Tailwind CSS 3
-   **Database:** MySQL
-   **Others:** PHP 8.2+, Composer, Laravel Artisan CLI

## ✨ Features

-   ✍️ Create, edit, and manage testimonies with support for:
    -   **Public Testimonies**: Viewable by everyone.
    -   **Private Testimonies** (Premium): Only accessible to logged-in users.
    -   **Published Testimonies**: A personal wall showing all of a user’s own testimonies (both public and private).
-   🔒 Authentication system with registration and login
-   📊 Personalized dashboard with counters and a listing of all authored testimonies
-   ⚡ Livewire-powered interactive components
-   🎨 Fully responsive UI styled with Tailwind CSS
-   🔌 Clean, modular Laravel structure for easy customization

## 🗂️ Page Structure

| Page Type     | URL Pattern                                  | Access Level                      | Description                                                                                             |
| ------------- | -------------------------------------------- | --------------------------------- | ------------------------------------------------------------------------------------------------------- |
| **Public**    | `/` and `/testimony/{id}`                    | Anyone (guest or logged-in)       | Lists and displays testimonies marked as "public". Users can register to create their own.              |
| **Private**   | `/private` and `/private/{id}`               | Logged-in users with subscription | Displays _all_ private + public testimonies. Premium feature.                                           |
| **Published** | `/me/testimonies` and `/me/testimonies/{id}` | Logged-in users only              | Shows the logged-in user’s own testimonies (public and private) in a clean layout.                      |
| **Dashboard** | `/me/dashboard`                              | Logged-in users only              | Provides a summary (counts) of all their testimonies and a full listing with links to manage/view them. |

## 🚀 Getting Started

### Prerequisites

-   PHP 8.2+
-   Composer
-   Node.js + npm
-   MySQL

### Installation

```bash
# Clone the repo
git clone https://github.com/yourusername/testimony-creator.git
cd testimony-creator

# Install backend dependencies
composer install

# Copy .env and set DB credentials
cp .env.example .env
php artisan key:generate

# Configure your MySQL database in .env
# Then run:
php artisan migrate

# Install frontend dependencies
npm install && npm run dev

# Serve the app
php artisan serve
```

## 🛡️ License

This project is open-sourced under the [MIT License](LICENSE).

## 🙌 Author

Made with ❤️ by **Davina Leong**
