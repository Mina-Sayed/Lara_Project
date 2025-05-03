# Laravel Product API

A simple RESTful API built with Laravel 12 to manage products (Create, Read, Update, Delete).

## Project Overview

This project provides basic CRUD functionality for a `Product` resource. It demonstrates core Laravel concepts including Eloquent models, resource controllers, routing, migrations, and environment configuration.

## Features

*   **List Products:** Retrieve all products.
*   **Create Product:** Add a new product with name and price.
*   **Show Product:** View details of a specific product.
*   **Update Product:** Modify the name and price of an existing product.
*   **Delete Product:** Remove a product.
*   **Validation:** Ensures `name` (required, string) and `price` (required, numeric) are provided correctly.

## Setup Instructions

1.  **Clone the Repository:**
    ```bash
    git clone [https://github.com/Mina-Sayed/Lara_Project.git](https://github.com/Mina-Sayed/Lara_Project.git)
    cd Lara_Project
    ```

2.  **Install Dependencies:**
    ```bash
    composer install
    npm install # Optional, if you plan to use frontend assets
    ```

3.  **Configure Environment:**
    *   Copy the example environment file:
        ```bash
        cp .env.example .env
        ```
    *   Generate an application key:
        ```bash
        php artisan key:generate
        ```
    *   **Edit the `.env` file** and update the `DB_` variables to match your database credentials (e.g., for PostgreSQL):
        ```dotenv
        DB_CONNECTION=pgsql
        DB_HOST=127.0.0.1 # Or your database host (e.g., Railway URL)
        DB_PORT=5432      # Or your database port
        DB_DATABASE=your_db_name
        DB_USERNAME=your_db_user
        DB_PASSWORD=your_db_password

        # Ensure these are set to avoid database dependency issues
        SESSION_DRIVER=file
        CACHE_STORE=file
        QUEUE_CONNECTION=sync
        ```

4.  **Run Database Migrations:** Create the `products` table in your configured database.
    ```bash
    php artisan migrate
    ```
    *(Note: If you encounter issues or want a clean start, you can use `php artisan migrate:fresh` to drop all tables and re-migrate)*

5.  **Start the Development Server:**
    ```bash
    php artisan serve --port=8080 # Or any available port
    ```
    The API will typically be available at `http://127.0.0.1:8080`.

## API Endpoints

**Base URL:** `http://127.0.0.1:8080/api` (Assuming server running on port 8080)

| Method      | URL                     | Description            | Request Body (JSON)                   | Success Response (JSON)                  |
| :---------- | :---------------------- | :--------------------- | :------------------------------------ | :--------------------------------------- |
| **GET**     | `/products`             | List all products      | *N/A*                                 | Array of product objects                 |
| **POST**    | `/products`             | Create a new product   | `{ "name": "...", "price": ... }`    | Created product object (Status `201`)    |
| **GET**     | `/products/{product}`   | Show specific product  | *N/A*                                 | Single product object                    |
| **PUT/PATCH** | `/products/{product}`   | Update a product     | `{ "name": "...", "price": ... }`    | Updated product object                   |
| **DELETE**  | `/products/{product}`   | Delete a product     | *N/A*                                 | *Empty* (Status `204`)                   |

*(Replace `{product}` with the actual ID of the product)*

**Headers:**
*   For `GET`, `DELETE`: `Accept: application/json`
*   For `POST`, `PUT`, `PATCH`: `Accept: application/json`, `Content-Type: application/json`

## Key Technologies

*   PHP
*   Laravel 12
*   Composer
*   PostgreSQL (or other configured SQL database)
