# Tager Classifieds

Tager is a basic PHP skeleton for a Haraj-like classifieds website. It provides the foundation for serving ads where users can register, log in, and post classified listings. The repository contains empty PHP pages, placeholder CSS and JS files, and a SQL dump for the database schema.

## Requirements

- **PHP** (>=7.4 recommended)
- **MySQL** or MariaDB
- A web server capable of running PHP (e.g., Apache) or the built-in PHP development server

## Installation

1. **Clone the repository**:
   ```bash
   git clone <repo-url>
   cd tager
   ```
2. **Install PHP** and **MySQL** using your platform's package manager. For example, on Ubuntu:
   ```bash
   sudo apt-get update
   sudo apt-get install php php-mysql mysql-server
   ```
3. **Create the database**:
   ```bash
   mysql -u root -p < sql/tager_db.sql
   ```
   The SQL file is currently empty and can be customized with tables for users, ads, and other data.

4. **Configure database credentials**:
   Update `includes/db.php` with your MySQL connection details.

## Running Locally

You can run the site with the built-in PHP server during development:

```bash
php -S localhost:8000
```

Then open `http://localhost:8000` in your browser.

## File Structure

```
includes/        # Database connection and helper functions
admin/           # Admin dashboard pages
css/             # Placeholder styles
js/              # Placeholder scripts
sql/             # SQL dump for the database
```

This project is only a skeleton to help you start building a classifieds website similar to Haraj.
