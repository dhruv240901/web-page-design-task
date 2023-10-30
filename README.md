# Rendering sidebar elements and User CRUD Operation using AJAX in Laravel

This repository contains a Laravel application that demonstrates how to render sidebar elements of homepage using service provider perform CRUD operations for users using AJAX (Asynchronous JavaScript and XML). This is a step-by-step guide to help you understand and implement user management functionalities with real-time updates.

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP and Laravel installed on your system.
- A basic understanding of Laravel and AJAX.
- Composer for PHP dependencies.

## Getting Started

1. Clone this repository to your local machine (In windows go to the xampp/htdocs  
   folder):

   ```bash
   git clone https://github.com/dhruv240901/web-page-design-task

2. Change to the project directory:

    ```bash
   cd user-crud-laravel-ajax

3. Install Laravel dependencies:

   ```bash
   composer update

4. Create a .env file by copying the .env.example file and configure your database
   and mail settings:

   ```bash
   cp .env.example .env

5. Generate an application key:

   ```bash
   php artisan key:generate

6. Migrate and seed the database:

   ```bash
   php artisan migrate --seed

7. Start the Laravel development server:

   ```bash
   php artisan serve

8. Access the application in your web browser at http://localhost:8000.

## Features
1. Render Sidebar Elements: In the application hompage the sidebar elements are 
   rendered using Service Provider in Laravel.  
1. Create User: Add new users with AJAX form submission and send invitation 
   through mail to the newly added user.
2. Read User: View a list of users with pagination and sorting.
3. Update User: Edit user details using AJAX.
4. Delete User: Remove a user from the list with AJAX.

## How to Use
1. The application provides an intuitive user interface for managing users. Follow 
   the on-screen instructions to create, read, update, or delete users.
2. AJAX is used to perform these operations without reloading the entire page, 
   providing a seamless user experience.
