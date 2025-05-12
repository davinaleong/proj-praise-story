# Testimony Creator

A lightweight web app for creating and managing user testimonies. Built with **Laravel**, **Livewire**, **MySQL**, and **Tailwind CSS**.

## 🔧 Tech Stack

-   **Backend:** Laravel 10+
-   **Frontend:** Livewire 3, Blade templates
-   **Styling:** Tailwind CSS 3
-   **Database:** MySQL
-   **Others:** PHP 8.2+, Composer, Laravel Artisan CLI

## ✨ Features

-   Draft, private, and public status management for testimonies
-   Livewire-powered components for real-time interactivity
-   Authentication (login/register)
-   Responsive UI with Tailwind
-   Clean and modular codebase for easy extension

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

# Configure database
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
