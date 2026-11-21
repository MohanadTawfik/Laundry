# Laundry Management System

A PHP and MySQL laundry service management system for browsing services, placing orders, managing items and categories, and handling user accounts.

## Features

- Customer and staff user types
- Laundry service and item browsing
- Shopping cart and order placement
- Order status and notification management
- Category and item management
- User profiles and avatar uploads
- Arabic and English language support
- Responsive Bootstrap interface

## Technologies

- PHP
- MySQL / MariaDB
- PDO
- HTML, CSS, JavaScript
- Bootstrap
- Font Awesome
- DataTables
- Swiper

## Requirements

- XAMPP, WAMP, or another Apache + PHP environment
- PHP 8.x
- MySQL or MariaDB
- PHP PDO MySQL extension

## Installation

1. Place the project in the XAMPP `htdocs` directory.
2. Start Apache and MySQL from the XAMPP control panel.
3. Open phpMyAdmin at `http://localhost/phpmyadmin`.
4. Create a database named `laundry`.
5. Import `data/database/laundry.sql` into the database.
6. Confirm that the database settings in `includes/template/connect.php` match your local MySQL configuration:

   ```php
   $dsn = 'mysql:host=localhost;dbname=laundry';
   $user = 'root';
   $pass = '';
   ```

7. Open the project in a browser, for example:

   ```text
   http://localhost/LAUNDRY/
   ```

## Default Account

The database dump includes a staff account:

- Username: `admin`
- Password: `admin`

Change the default password before deploying the application.

## Project Structure

- `*.php` — Application pages and actions
- `includes/` — Shared templates, functions, database connection, and languages
- `layout/` — CSS, JavaScript, fonts, and image assets
- `data/database/` — MySQL database dump
- `data/uploads/` — Uploaded item photos and user avatars
- `data/logs/` — Application log storage

## Notes

- The application is configured for the `laundry` database and the default XAMPP MySQL user.
- The source uses relative paths, so the folder name is expected to remain `LAUNDRY` unless routes are updated.
