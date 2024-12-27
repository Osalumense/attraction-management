<p>Laravel Attraction Management Application</p>

## Overview
Application was developed using Laravel and TailwindCSS with Blade template

## Implemented Features
- CRUD Operations: Create, Read, Update, and Delete attractions. (Create, Update and Delete are only accessible to admin users)
- File Uploads & Mail: Upload images for attractions and send a notification email.
- Third-Party API Integration: Fetch and display weather information for the attraction's location using the OpenWeather API.
- Real-Time Broadcasting: Broadcast a WebSocket event when a new attraction is created.
- Testing: Feature tests for CRUD operations and the API integration.

## Setup Instructions
- Clone repository
- cd into attraction-management
- Copy .env.example to .env using `cp .env.example .env`
- Run `composer install` to install all composer dependencies
- Run `npm install`
- Compile frontend assets using `npm run dev`
- For production builds using `npm run build`
- Run all migrations: `php artisan migrate`
- Seed the DB with the predefined users for test: `php artisan db:seed`
- Setup and run queues `php artisan queue:work` or run it as a daemon to keep it running in the background `php artisan queue:work --daemon`
- To run all the tests: `php artisan test`

## Default user Login Details
- Admin Login
    - Email: admin@gmail.com
    - Password: AdminP8ssw0rd

- User Login
    - Email: user@gmail.com
    - Password: AdminP8ssw0rd

