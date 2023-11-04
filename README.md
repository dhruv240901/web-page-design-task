# Rendering sidebar elements and User CRUD Operation using AJAX in Laravel

This repository contains a Laravel application that demonstrates how to render sidebar elements of homepage using service provider and perform CRUD operations for users using AJAX (Asynchronous JavaScript and XML). This is a step-by-step guide to help you understand and implement user management functionalities with real-time updates.

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP(v8.2) and Laravel(v10.29) are installed on your system.
- A basic understanding of Laravel and AJAX.
- Composer(v2.6.4) for PHP dependencies.

## Getting Started

1. Clone this repository to your local machine (In Windows go to the xampp/htdocs folder):

   ```bash
   git clone https://github.com/dhruv240901/web-page-design-task

2. Change to the project directory:

    ```bash
   cd user-crud-laravel-ajax

3. Install Laravel dependencies:

   ```bash
   composer install

4. Create a .env file by copying the .env.example file and configure your database
   and mail settings:

   ```bash
   cp .env.example .env

5. Generate an application key:

   ```bash
   php artisan key:generate

6. Migrate and seed the database:

   ```bash
   php artisan migrate

7. Start the Laravel development server:

   ```bash
   php artisan serve

8. Access the application in your web browser at http://localhost:8000.
9. While adding the user perform the following steps:
    1. Set Mail Credential and Queue Connection in .env file

        ```bash
        MAIL_MAILER=smtp
        MAIL_HOST=mailpit
        MAIL_PORT=1025
        MAIL_USERNAME=null
        MAIL_PASSWORD=null
        MAIL_ENCRYPTION=null
        MAIL_FROM_ADDRESS="hello@example.com"
        MAIL_FROM_NAME="${APP_NAME}"

        QUEUE_CONNECTION=database

    2. Run the following command:

        ```bash
        php artisan queue:work

## Features
1. Render Sidebar Elements: In the application homepage, the sidebar elements are 
   rendered using Service Provider in Laravel.  
1. Create User: Add new users with AJAX form submission and send invitations 
   through mail to the newly added user.
2. Read User: View a list of users with pagination and sorting.
3. Update User: Edit user details using AJAX.
4. Delete User: Remove a user from the list with AJAX.

## How to Use
1. The application provides an intuitive user interface for managing users. Follow 
   the on-screen instructions to create, read, update, or delete users.
2. AJAX is used to perform these operations without reloading the entire page, 
   providing a seamless user experience.

## Screenshots
1. Login Page

![LoginPage!](https://user-images.githubusercontent.com/146160551/280462367-63bc6319-765e-4d87-b36c-ea52006a5244.png)

Here the user Login into their account

2. Index Page

![IndexPage!](https://user-images.githubusercontent.com/146160551/280462379-1d2d8507-8086-40c1-940f-1a7161c17484.png)

This is the index page of the web application. Here the sidebar elements are rendered using service provider. The logged in user can see users table added by him/her.

3. Add User Modal

![AddModal!](https://user-images.githubusercontent.com/146160551/280462385-a1ce639a-85d9-480f-b9c3-e6f0744fce7f.png)

This is the add user modal form and by submitting this form the logged in user can add other user and the added user can get a mail with the current password. The added user can login with this password and change the password after login.

4. Edit User Modal

![EditModal!](https://user-images.githubusercontent.com/146160551/280462397-8d1cad96-95b4-42f6-8bb6-7726eb8bb70d.png)

This the edit user modal form. The logged in user can update firstname, lastname and phone number of his/her added users.

5. Delete User Alert

![DeleteUser!](https://user-images.githubusercontent.com/146160551/280462409-4f840f66-3769-4799-8ee5-1b2c4678e713.png)

This the confirm sweet alert the logged in user can get on deleting user.
